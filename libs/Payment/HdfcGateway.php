<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/PaymentGateway.php';
require_once __DIR__ . '/../config/Config.php';

use Juspay\JuspayEnvironment;
use Juspay\Model\JuspayJWT;
use Juspay\Model\OrderSession;
use Juspay\Model\Order;
use Juspay\RequestOptions;
use Juspay\Exception\JuspayException;

class HdfcGateway implements PaymentGateway
{
    private static bool $booted = false;
    private string $merchantId;

    public function __construct() { $this->boot(); }

    private function boot(): void
    {
        if (self::$booted) return;
        $base = Config::env('HDFC_BASE_URL', 'https://smartgatewayuat.hdfcbank.com');
        $this->merchantId = Config::env('HDFC_MERCHANT_ID');
        $uuid = Config::env('HDFC_KEY_UUID');
        // $priv = file_get_contents(Config::env('HDFC_PRIVATE_KEY_PATH'));
        // $pub  = file_get_contents(Config::env('HDFC_PUBLIC_KEY_PATH'));
        $privPath = Config::env('HDFC_PRIVATE_KEY_PATH');
        $pubPath  = Config::env('HDFC_PUBLIC_KEY_PATH');

        // Convert relative → absolute if needed
        $root = dirname(__DIR__, 2);
        if ($privPath && !preg_match('/^(?:[A-Za-z]:\\\\|\\/)/', $privPath)) {
            $privPath = $root . '/' . ltrim($privPath, '/');
        }
        if ($pubPath && !preg_match('/^(?:[A-Za-z]:\\\\|\\/)/', $pubPath)) {
            $pubPath = $root . '/' . ltrim($pubPath, '/');
        }

        $privateKey = file_get_contents($privPath);
        $publicKey  = file_get_contents($pubPath);

        JuspayEnvironment::init()
            ->withBaseUrl($base)
            ->withMerchantId($this->merchantId)
            ->withJuspayJWT(new JuspayJWT($uuid, $publicKey, $privateKey));
        self::$booted = true;
    }

    /** Generate non‑sequential order ID ≤20 chars, alphanumeric */
    private function generatePayOrderId(): string
    {
        $prefix = 'ORD';                                // 3 chars
        $rand   = strtoupper(bin2hex(random_bytes(8))); // 16 chars
        return substr($prefix . $rand, 0, 20);          // max 20 total
    }

    // ---------------------------------------------------------- createOrder
    public function createOrder(int $amountPaise): array
    {
        $payOrderId = $this->generatePayOrderId();
        $amount = number_format($amountPaise / 100, 2, '.', '');

        $params = [
            'order_id' => $payOrderId,
            'amount' => $amount,
            'merchant_id' => $this->merchantId,
            'payment_page_client_id' => $this->merchantId,
            'action' => 'paymentPage',
            'customer_id' => 'cust_' . $payOrderId,
            'return_url' => Config::env('HDFC_RETURN_URL'),
            'description' => "Order #$payOrderId",
        ];

        $opts = (new RequestOptions())->withCustomerId($params['customer_id']);

        $session = OrderSession::create($params, $opts);

        return [
            'order_id'    => $payOrderId,
            'amount'      => $amountPaise,
            'sdkPayload'  => $session->sdkPayload,
            'paymentLink' => $session->paymentLinks['web'] ?? null,
        ];
    }

    // ---------------------------------------------------------- verifyPayment
    public function verifyPayment(string $orderId): bool
    {
        try {
            $order = Order::status(['order_id' => $orderId], new RequestOptions());
            $status = strtoupper($order->status);
            
            // Log the status for debugging
            error_log("Payment status for $orderId: $status");
            
            // Expanded list of successful statuses
            $successStatuses = ['CHARGED', 'PAID', 'CAPTURED', 'SUCCESS', 'COMPLETED'];
            
            return in_array($status, $successStatuses, true);
        } catch (JuspayException $e) {
            error_log("Verification error for $orderId: " . $e->getMessage());
            return false;
        }
    }
}