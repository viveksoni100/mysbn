<?php
// Load Composer's autoloader
require 'PHPMailerAutoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer;

$mail_id = $_POST['send_mail_address'];

try {
    //Server settings
    $mail->SMTPDebug = 5;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ghanshyampande100@gmail.com';                     // SMTP username
    $mail->Password   = 'Vivekbarbhaya@123';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ghanshyampande100@gmail.com', 'Vivek - Fullstack Developer');
    $mail->addAddress($mail_id, 'Nobody');     // Add a recipient
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test Mail';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send())
      echo 'Message has been sent';
    else {
      echo 'Work harder...';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
