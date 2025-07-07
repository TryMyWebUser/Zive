<?php

class Order
{
    /**
     * Create a local order and return its order data including both local and gateway IDs
     */
    public static function create($userId, int $amountPaise, string $gateway, string $gatewayOrderId): array
    {
        $userId = (int)$userId;
        if ($userId <= 0) throw new InvalidArgumentException('Invalid user ID');

        $db = Database::getConnect();
        $db->begin_transaction();

        try {
            // 1. Insert into orders table
            $sql = "INSERT INTO orders (user_id, amount_paise, gateway, gateway_order_id, status, created_at)
                    VALUES (?, ?, ?, ?, 'pending', NOW())";
            $st = $db->prepare($sql);
            $st->bind_param('iiss', $userId, $amountPaise, $gateway, $gatewayOrderId);
            $st->execute();
            $orderId = $db->insert_id;

            // 2. Insert cart items into order_items table
            $cartRaw = Cart::items();
            $cart = is_string($cartRaw) ? json_decode($cartRaw, true) : $cartRaw;
            if (!is_array($cart) || !($cart['ok'] ?? false)) throw new Exception("Invalid cart");

            $itemStmt = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
            foreach ($cart['items'] as $item) {
                $itemStmt->bind_param('iii', $orderId, $item['id'], $item['quantity']);
                $itemStmt->execute();
            }

            $db->commit();
            return [
                'id' => $orderId,
                'gateway_order_id' => $gatewayOrderId
            ];
        } catch (Exception $e) {
            $db->rollback();
            error_log("Order creation failed: " . $e->getMessage());
            throw $e;
        }
    }


    /** Mark an order as paid using gateway order ID */
    public static function markPaidByGatewayId(string $gatewayOrderId, string $paymentId): bool
    {
        $db = Database::getConnect();
        $sql = "UPDATE orders SET status='paid', payment_id=?, paid_at=NOW() 
                WHERE gateway_order_id=?";
        $st = $db->prepare($sql);
        $st->bind_param('ss', $paymentId, $gatewayOrderId);
        return $st->execute();
    }

    /** Mark an order as failed using gateway order ID */
    public static function markFailedByGatewayId(string $gatewayOrderId): bool
    {
        $db = Database::getConnect();
        $sql = "UPDATE orders SET status='failed' WHERE gateway_order_id=?";
        $st = $db->prepare($sql);
        $st->bind_param('s', $gatewayOrderId);
        return $st->execute();
    }

    /** Find order by gateway order ID */
    public static function findByGatewayId(string $gatewayOrderId): ?array
    {
        $db = Database::getConnect();
        $sql = "SELECT id, user_id, status FROM orders WHERE gateway_order_id=?";
        $st = $db->prepare($sql);
        $st->bind_param('s', $gatewayOrderId);
        $st->execute();
        $result = $st->get_result();
        return $result->fetch_assoc() ?: null;
    }
}