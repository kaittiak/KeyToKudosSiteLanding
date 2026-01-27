<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Instantiate PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    // Gmail SMTP settings
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'contact@keytokudos.com'; // Your Gmail address
    // Use environment variable for Gmail app password
    $mail->Password   = getenv('GMAIL_APP_PASSWORD'); // Set GMAIL_APP_PASSWORD in your environment
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use ENCRYPTION_STARTTLS for port 587
    $mail->Port       = 465; // Use 587 for TLS

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('contact@keytokudos.com'); // Your email address

    // Content
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    // Send the email
    $mail->send();

    // Send success response
    echo 'Message sent successfully';
} catch (Exception $e) {
    // Send error response
    echo 'Message could not be sent. Error: ' . $mail->ErrorInfo;
}
