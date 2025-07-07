<?php
declare(strict_types=1);
require_once '../load.php';
Session::start();
require_once __DIR__ . '/../Payment/HdfcGateway.php';
header('Content-Type: application/json');

$userAccount = Operations::getUser();
if (!$userAccount || !isset($userAccount['id'])) {
    http_response_code(401);
    exit(json_encode(['ok' => false, 'msg' => 'User not authenticated']));
}

$cartRaw = Cart::items();
$cart = is_string($cartRaw) ? json_decode($cartRaw, true) : $cartRaw;
if (!is_array($cart) || !($cart['ok'] ?? false) || !count($cart['items'])) {
    http_response_code(400);
    exit(json_encode(['ok' => false, 'msg' => 'Cart is empty']));
}

$amountPaise = array_reduce($cart['items'], fn($t, $i) => $t + ((int) round($i['price'] * 100) * $i['quantity']), 0);

$gateway = new HdfcGateway();
$gatewayOrder = $gateway->createOrder($amountPaise);

try {
    $localOrder = Order::create((int)$userAccount['id'], $amountPaise, 'HDFC', $gatewayOrder['order_id']);
    echo json_encode([
        'ok' => true,
        'orderId' => $gatewayOrder['order_id'],
        'local_order_id' => $localOrder['id'],
        'payload' => $gatewayOrder
    ]);
} catch (Exception $e) {
    http_response_code(500);
    exit(json_encode(['ok' => false, 'msg' => 'Order creation failed']));
}