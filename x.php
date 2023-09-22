<?php
require_once ("vendors/PHPMailer/PHPMailerAutoload.php");

try {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'dyunirepo@gmail.com';
    $mail->Password = '085213ERIC!';
    $mail->setFrom('no-reply@dyunirepo.com');
    $mail->Subject = 'Hello World';
    $mail->Body = "A test";
    $mail->addAddress('zetherique@gmail.com');
    $mail->send();
} catch (phpmailerException $e) {
}