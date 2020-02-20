<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'phpmailer/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;   // Enable verbose debug output
    $mail->isSMTP();        // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';  // SMTP server
    $mail->SMTPAuth   = true;   // Enable SMTP authentication
    $mail->Username   = 'ghanshyampande100@gmail.com';  // SMTP username
    $mail->Password   = 'Vivekbarbhaya@123';    // SMTP password
    $mail->SMTPSecure = 'ssl/tls';  // Enable TLS encryption; 
    $mail->Port       = 465;    // TCP port to connect to

    //Recipients
    $mail->setFrom('ghanshyampande100@gmail.com');
    $mail->addAddress('viveksoni100@gmail.com');
    // Add a recipient
    /*$mail->addAddress('ellen@example.com');
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');*/

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Hope Michealson Secret';
    $mail->Body    = 'She is <b>Tri-Brid</b>';
    // $mail->AltBody = 'For non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
?>
