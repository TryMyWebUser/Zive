<?php

declare(strict_types=1);
require_once 'libs/load.php';

// Try to get order ID from multiple sources
$orderId = $_GET['order_id'] ?? 
           $_GET['merchant_transaction_id'] ?? 
           $_POST['order_id'] ?? 
           $_POST['merchant_transaction_id'] ?? null;

// Fetch order details if order ID exists
$orderDetails = null;
$products = [];
$totalAmount = 0;

if ($orderId) {
    try {
        // 1. Get the local order ID from gateway order ID
        $db = Database::getConnect();
        $stmt = $db->prepare("SELECT id, user_id, amount_paise FROM orders WHERE gateway_order_id = ?");
        $stmt->bind_param('s', $orderId);
        $stmt->execute();
        $orderDetails = $stmt->get_result()->fetch_assoc();
        
        // 2. Get ordered products if order exists
        if ($orderDetails) {
            $stmt = $db->prepare("SELECT p.title, p.price, oi.quantity FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
            $stmt->bind_param('i', $orderDetails['id']);
            $stmt->execute();
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            // Calculate total amount from products
            $totalAmount = array_reduce($products, function($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);
        }
    } catch (Exception $e) {
        error_log("Error fetching order details: " . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Thank You - Payment Status</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .product-list {
                max-height: 200px;
                overflow-y: auto;
                margin: 15px 0;
                padding: 10px;
                background: #f9f9f9;
                border-radius: 5px;
            }
            .product-item {
                display: flex;
                justify-content: space-between;
                padding: 5px 0;
                border-bottom: 1px solid #eee;
            }
            .total-amount {
                font-weight: bold;
                margin-top: 10px;
                text-align: right;
            }
        </style>
    </head>
    <body style="display: flex; align-items: center; justify-content: center; height: 100vh; background: #f5f5f5;">
        <script>
            (async () => {
                const orderId = "<?= addslashes($orderId ?? '') ?>";
                const products = <?= json_encode($products) ?>;
                const totalAmount = <?= $totalAmount ?? 0 ?>;
                
                if (!orderId) {
                    await Swal.fire({
                        icon: "error",
                        title: "Payment Failed",
                        text: "Missing order reference",
                    });
                    return (location.href = "index.php");
                }

                try {
                    const response = await fetch("libs/api/payment_verify_api.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: new URLSearchParams({ order_id: orderId }),
                    });

                    const result = await response.json();

                    if (result.ok) {
                        // Build product list HTML
                        let productList = '<div class="product-list">';
                        if (products.length > 0) {
                            products.forEach(product => {
                                productList += `
                                    <div class="product-item">
                                        <span>${product.title} (x ${product.quantity})</span>
                                        <span>₹${(product.price * product.quantity).toFixed(2)}</span>
                                    </div>
                                `;
                            });
                            productList += `<div class="total-amount">Total: ₹${totalAmount.toFixed(2)}</div>`;
                        } else {
                            productList += '<div>No product details available</div>';
                        }
                        productList += '</div>';

                        await Swal.fire({
                            icon: "success",
                            title: "Payment Successful!",
                            html: `
                                <p><strong>Order ID:</strong> ${orderId}</p>
                                ${productList}
                                <p>Thank you for your purchase!</p>
                            `,
                            confirmButtonText: "Back to Home",
                            // footer: 'A confirmation has been sent to your email'
                        });
                        
                        location.href = "index.php";
                    } else {
                        await Swal.fire({
                            icon: "error",
                            title: "Payment Verification Failed",
                            html: `
                                <p>We couldn't verify your payment for order <strong>${orderId}</strong>.</p>
                                <p>${result.msg || "The payment gateway didn't confirm your transaction."}</p>
                            `,
                            footer: 'Please contact support if you were charged'
                        });
                        location.href = "index.php";
                    }
                } catch (err) {
                    await Swal.fire({
                        icon: "error",
                        title: "Verification Error",
                        text: "Something went wrong during verification. Please check your email for confirmation.",
                    });
                    location.href = "index.php";
                }
            })();
        </script>
    </body>
</html>