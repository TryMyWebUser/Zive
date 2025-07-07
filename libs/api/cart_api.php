<?php
require_once '../load.php';
header('Content-Type: application/json');

$action     = $_POST['action']      ?? '';
$productId  = (int)($_POST['product_id'] ?? 0);
$quantity   = (int)($_POST['quantity']   ?? 1);

switch ($action) {
    case 'add':
        $out = Cart::add($productId, $quantity);
        break;
    case 'update':
        $out = Cart::update($productId, $quantity);
        break;
    case 'remove':
        $out = Cart::remove($productId);
        break;
    default:
        $out = ['ok' => false, 'msg' => 'Invalid action'];
}
echo json_encode($out);