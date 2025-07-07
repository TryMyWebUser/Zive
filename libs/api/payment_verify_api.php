<?php
declare(strict_types=1);
require_once '../load.php';
Session::start();
require_once __DIR__ . '/../Payment/HdfcGateway.php';

header('Content-Type: application/json');

$orderId = $_POST['order_id'] ?? $_GET['order_id'] ?? '';
if (!$orderId) {
    http_response_code(400);
    exit(json_encode(['ok' => false, 'msg' => 'Missing order_id']));
}

$gateway = new HdfcGateway();
$ok = $gateway->verifyPayment($orderId);

if ($ok) {
    $paymentId = $orderId;
    $updated = Order::markPaidByGatewayId($orderId, $paymentId);

    if ($updated) {
        ReCart::clear(); // <-- clear the cart from session/db
    }

    echo json_encode(['ok' => $updated, 'msg' => $updated ? 'Payment captured' : 'Order not found']);
} else {
    $updated = Order::markFailedByGatewayId($orderId);
    http_response_code(400);
    echo json_encode(['ok' => false, 'msg' => $updated ? 'Verification failed' : 'Order not found']);
}