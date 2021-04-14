<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$name     = (isset($_POST['fullname'])) ? strip_tags(trim($_POST['fullname'])) : '';
$email    = (isset($_POST['email'])) ? strip_tags(trim($_POST['email'])) : '';
$message  = (isset($_POST['message'])) ? strip_tags(trim($_POST['message'])) : '';

$body     = "
    <div id='content'>
        <div class='name'><strong>Nome: </strong><span>{$name}</span></div>
        <div class='email'><strong>E-mail: </strong><span>{$email}</span></div>
        <div class='message'><strong>Mensagem: <br/><p>{$message}</p></div>
    </div>
";

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->CharSet    = 'UTF-8';
    $mail->Encoding   = 'base64';
    $mail->Host       = 'p3plzcpnl458515.prod.phx3.secureserver.net';
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "ssl";
    $mail->Username   = 'atendimento@saazdistribuidora.com.br';
    $mail->Password   = 'RCuH3auf6kYt';
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('atendimento@saazdistribuidora.com.br', 'Contato Saaz Distribuidora');
    $mail->addAddress('atendimento@saazdistribuidora.com.br', 'Contato');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Formulário de contato - Saaz Distribuidora';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Menssagem Enviada!';

    header('Location: index.html#cupom-form?modal');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}