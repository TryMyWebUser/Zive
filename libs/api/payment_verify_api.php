<?php
declare(strict_types=1);

require_once '../load.php';                              // project bootstrap
require_once __DIR__ . '/../vendor/autoload.php';        // Composer
require_once __DIR__ . '/../Payment/HdfcGateway.php';    // Gateway SDK
require_once __DIR__ . '/../Mailer.class.php';           // PHPMailer wrapper

header('Content-Type: application/json');
Session::start();

/* -------------------------------------------------------
 * 1. Validate request
 * -----------------------------------------------------*/
$orderId = $_POST['order_id'] ?? $_GET['order_id'] ?? '';
if (!$orderId) {
    http_response_code(400);
    exit(json_encode(['ok' => false, 'msg' => 'Missing order_id']));
}

/* -------------------------------------------------------
 * 2. Verify with HDFC Smart Gateway
 * -----------------------------------------------------*/
$gateway  = new HdfcGateway();
$verified = $gateway->verifyPayment($orderId);

if (!$verified) {
    // mark failure in DB (optional)
    Order::markFailedByGatewayId($orderId);
    http_response_code(400);
    exit(json_encode(['ok' => false, 'msg' => 'Gateway verification failed']));
}

/* -------------------------------------------------------
 * 3. Update DB + send email (transaction)
 * -----------------------------------------------------*/
$db   = Database::getConnect();
$mail = new Mailer();

try {
    $db->begin_transaction();

    // A. Mark order paid
    $paymentId = $orderId;                 // If gateway returns a separate payment_id, use that.
    if (!Order::markPaidByGatewayId($orderId, $paymentId)) {
        throw new RuntimeException('Order not found or already paid');
    }

    // B. Fetch order, user and products
    $stmt = $db->prepare("SELECT id, user_id FROM orders WHERE gateway_order_id = ?");
    $stmt->bind_param('s', $orderId);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();

    $stmt = $db->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->bind_param('i', $order['user_id']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    $stmt = $db->prepare("
        SELECT p.img, p.title, p.price, oi.quantity
        FROM order_items oi
        JOIN products p ON p.id = oi.product_id
        WHERE oi.order_id = ?
    ");
    $stmt->bind_param('i', $order['id']);
    $stmt->execute();
    $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // C. Send confirmation email
    $emailStatus = $mail->sendOrderConfirmationEmail(
        $user['username'],
        $user['email'],
        $orderId,
        $products
    );

    // D. Clear cart (session + DB, if you store it)
    ReCart::clear();

    $db->commit();

    echo json_encode([
        'ok'       => true,
        'email_ok' => $emailStatus['success'],
        'msg'      => 'Payment captured and order email sent'
    ]);
} catch (Throwable $e) {
    // Roll back DB if anything above fails
    if ($db->in_transaction) {
        $db->rollback();
    }
    error_log('verify_api error: ' . $e->getMessage());

    http_response_code(500);
    echo json_encode([
        'ok'  => false,
        'msg' => 'Server error'
    ]);
}
