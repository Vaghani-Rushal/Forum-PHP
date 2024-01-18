<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Load PHPMailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';

// Initialize PHPMailer
$mail = new PHPMailer();

// Configure your SMTP settings
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Your SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'rushal.programmer@gmail.com'; // Your email address
$mail->Password = 'jtlagpdurwujwyvf'; // Your email password
$mail->SMTPSecure = 'tls'; // Use 'tls' or 'ssl'
$mail->Port = 587; // Port number for TLS: 587, SSL: 465

// Sender and recipient information
$mail->setFrom('rushal.programmer@gmail.com', 'iSecure - Online Forum');
$mail->addAddress($_POST['userInput'], 'Dear');

// Email content
$mail->isHTML(true);
$mail->Subject = 'Your iSecure verification code is here!';
$mail->Body = '<br>Welcome to iSecure - a vibrant and dynamic community of Forumgoers across the globe. In order to make submissions on iSecure we require you to verify your account so enter the code given below into the verification box on the website.<br><br>Code:<b>' . $_SESSION['vcCode'] . '</b><br><br>Happy Threading!<br>Team iSecure';
$mail->AltBody = '<br>Welcome to iSecure - a vibrant and dynamic community of Forumgoers across the globe. In order to make submissions on iSecure we require you to verify your account so enter the code given below into the verification box on the website.<br><br>Code:<b>' . $_SESSION['vcCode'] . '</b><br><br>Happy Threading!<br>Team iSecure';

// Send the email
if ($mail->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Somthing Wrong! Please Try Again Later.';
}
