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
            $this->mail->addBCC("zivewearthecomfort@gmail.com"); // Admin copy

            $this->mail->Subject = "Your Order #$orderId - Confirmation";

            // Adjust this to your actual public domain name
            $baseUrl = Config::env('BASE_URL'); // <-- Replace with your actual domain

            $emailBody = "<html><body style='font-family: Arial, sans-serif; background-color: #fff;'>";
            $emailBody .= "<div style='margin: auto; background-color: #fff;'>";
            
            $emailBody .= "<h2 style='color: #4CAF50;'>Thank you, $name!</h2>";
            $emailBody .= "<p style='font-size: 16px;'>Your payment has been received successfully. Below are your order details:</p>";
            
            $emailBody .= "<p style='font-size: 16px;'><strong>Order ID:</strong> <span style='color: #333;'>$orderId</span></p>";
            
            $emailBody .= "<table style='width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px;'>
                            <thead>
                                <tr style='background-color: #f2f2f2; text-align: left;'>
                                    <th style='padding: 10px; border: 1px solid #ddd;'>Product</th>
                                    <th style='padding: 10px; border: 1px solid #ddd;'>Image</th>
                                    <th style='padding: 10px; border: 1px solid #ddd;'>Quantity</th>
                                    <th style='padding: 10px; border: 1px solid #ddd;'>Price</th>
                                    <th style='padding: 10px; border: 1px solid #ddd;'>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>";
            
            $total = 0;
            foreach ($products as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            
                $imageUrl = $baseUrl . 'assets/' . ltrim($item['img'], '/');
            
                $emailBody .= "<tr>
                    <td style='padding: 10px; border: 1px solid #ddd;'>{$item['title']}</td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>
                        <img src='$imageUrl' width='60' height='60' style='object-fit: cover; border-radius: 5px;' />
                    </td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>{$item['quantity']}</td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>₹" . number_format($item['price'], 2) . "</td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>₹" . number_format($subtotal, 2) . "</td>
                </tr>";
            }
            
            $emailBody .= "<tr style='background-color: #f9f9f9;'>
                <td colspan='4' style='padding: 10px; border: 1px solid #ddd; text-align: right; font-weight: bold;'>Total:</td>
                <td style='padding: 10px; border: 1px solid #ddd; font-weight: bold;'>₹" . number_format($total, 2) . "</td>
            </tr>";
            
            $emailBody .= "</tbody></table>";
            
            $emailBody .= "<p style='margin-top: 20px; font-size: 14px;'>If you have any questions, feel free to contact us at 
            <a href='mailto:zivewearthecomfort@gmail.com' style='color: #4CAF50;'>zivewearthecomfort@gmail.com</a>.</p>";
            
            $emailBody .= "<p style='font-size: 12px; color: #888;'>Zive - Wear the Comfort</p>";
            
            $emailBody .= "</div></body></html>";


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