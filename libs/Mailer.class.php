<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/Config.php';

class Mailer
{
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP() {
        try {
            $this->mail->isSMTP();
            $this->mail->Host = "smtp.gmail.com";
            $this->mail->SMTPAuth = true;
            $this->mail->Username = "trymywebsites@gmail.com";
            $this->mail->Password = "nmhw uxqv vvpl fbvp";
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;
        } catch (Exception $e) {
            die(json_encode(["success" => false, "message" => "Mailer configuration failed: " . $e->getMessage()]));
        }
    }

    public function sendOrderConfirmationEmail($name, $email, $orderId, $products)
    {
        try {
            $this->mail->setFrom('trymywebsites@gmail.com', "Order Confirmation");
            $this->mail->addAddress($email);
            $this->mail->addBCC("saran29032004@gmail.com"); // Admin copy

            $this->mail->Subject = "Your Order #$orderId - Confirmation";

            // Adjust this to your actual public domain name
            $baseUrl = Config::env('BASE_URL'); // <-- Replace with your actual domain

            $emailBody = "<html><body>";
            $emailBody .= "<h3>Thank you, $name!</h3>";
            $emailBody .= "<p>Your payment has been received. Below are your order details:</p>";
            $emailBody .= "<p><strong>Order ID:</strong> $orderId</p>";

            $emailBody .= "<table border='1' cellpadding='8' cellspacing='0' width='100%'>";
            $emailBody .= "<tr><th>Product</th><th>Image</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>";

            $total = 0;
            foreach ($products as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;

                $imageUrl = $baseUrl . ltrim($item['img'], '/'); // Full URL to image

                $emailBody .= "<tr>
                    <td>{$item['title']}</td>
                    <td><img src='$imageUrl' width='60' height='60' style='object-fit: cover; border-radius: 5px;' /></td>
                    <td>{$item['quantity']}</td>
                    <td>₹{$item['price']}</td>
                    <td>₹" . number_format($subtotal, 2) . "</td>
                </tr>";
            }

            $emailBody .= "<tr><td colspan='4' align='right'><strong>Total:</strong></td><td><strong>₹" . number_format($total, 2) . "</strong></td></tr>";
            $emailBody .= "</table>";

            $emailBody .= "<p>If you have any questions, contact us at <a href='mailto:zivewearthecomfort@gmail.com'>zivewearthecomfort@gmail.com</a></p>";
            $emailBody .= "</body></html>";

            $this->mail->isHTML(true);
            $this->mail->Body = $emailBody;

            if ($this->mail->send()) {
                return ["success" => true];
            } else {
                return ["success" => false, "message" => "Mail failed"];
            }

        } catch (Exception $e) {
            return ["success" => false, "message" => $this->mail->ErrorInfo];
        }
    }

}