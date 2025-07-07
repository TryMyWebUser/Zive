<?php

declare(strict_types=1);

interface PaymentGateway
{
    public function createOrder(int $amountPaise): array;          // returns full payload incl. order_id
    public function verifyPayment(string $orderId): bool;          // true when CHARGED/PAID
}