<?php
require_once '../includes/session.php';
require '../includes/DatabaseConnection.php';
require '../src/PHPMailer.php';
require '../src/SMTP.php';
require '../src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {
    // Get admin email from database
    $stmt = $pdo->prepare('SELECT email FROM users WHERE role = "admin" LIMIT 1');
    $stmt->execute();
    $admin = $stmt->fetch();
    $adminEmail = 'lightt100605@gmail.com'; // Fallback email

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // SSL Options to fix certificate issues
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->Username = 'thanhnguyen100605@gmail.com'; // Your Gmail
        $mail->Password = 'uqff xkky ftah yofj'; // Your App Password from Gmail

        // Email content
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress($adminEmail);
        $mail->Subject = $_POST['subject'];
        $mail->isHTML(true);
        $mail->Body = "
            <h2>Contact Form Message</h2>
            <p><strong>From:</strong> {$_POST['name']}</p>
            <p><strong>Email:</strong> {$_POST['email']}</p>
            <p><strong>Message:</strong></p>
            <p>{$_POST['message']}</p>
        ";

        if ($mail->send()) {
            $success = true;
            $title = 'Message Sent';
        }
    }
} catch (Exception $e) {
    $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$title = 'Contact Us';
ob_start();
include '../templates/contact.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
