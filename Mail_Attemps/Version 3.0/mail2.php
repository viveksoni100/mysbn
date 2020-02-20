<?php

//    require 'phpmailer/PHPMailerAutoload.php';
    require 'phpmailer/autoload.php';

    $mail = new PHPMailer();
    $mail->Host = "smtp.gmail.com";
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = "ghanshyampande100@gmail.com";
    $mail->Password = "Vivekbarbhaya@123";
    $mail->SMTPSecure = "ssl";  //tls
    $mail->Port = 465;  //587
    $mail->Subject = "Hope's Secret";
    $mail->Body = "She is Tri-Brid";
    $mail->setFrom('ghanshyampande100@gmail.com', 'Vivek - Fullstack Developer');
    $mail->addAddress('viveksoni100@outlook.com');

    if($mail->send()){
        echo "mail is sent . . .";
    } else {
        echo "work harder . . .";
    }

?>