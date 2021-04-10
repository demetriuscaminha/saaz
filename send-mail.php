<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$name     = (isset($_POST['fullname'])) ? strip_tags(trim($_POST['fullname'])) : '';
$birthday = (isset($_POST['datanasc'])) ? strip_tags(trim($_POST['datanasc'])) : '';
$email    = (isset($_POST['email'])) ? strip_tags(trim($_POST['email'])) : '';
$cel      = (isset($_POST['celular'])) ? strip_tags(trim($_POST['celular'])) : '';
$news     = (isset($_POST['receiveNews']) && 'on') ? 'Sim' : 'Não';

$body     = "
    <div id='content'>
        <div class='name'><strong>Nome: </strong><span>{$name}</span></div>
        <div class='birthday'><strong>Data de Nascimento: </strong><span>{$birthday}</span></div>
        <div class='email'><strong>E-mail: </strong><span>{$email}</span></div>
        <div class='cel'><strong>Celular: </strong><span>{$cel}</span></div>
        <div class='news'><strong>Aceito receber informações do Empório do Panettone: </strong><span>{$news}</span></div>
    </div>
";

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->CharSet    = 'UTF-8';
    $mail->Encoding   = 'base64';
    $mail->Host       = 'a2plcpnl0491.prod.iad2.secureserver.net';
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "ssl";
    $mail->Username   = 'contato@emporiodopanettoneam.com.br';
    $mail->Password   = 'RCuH3auf6kYt';
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('contato@emporiodopanettoneam.com.br', 'Contato Empório do Panettone');
    $mail->addAddress('contato@emporiodopanettoneam.com.br', 'Contato');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Formulário de cadastro - Empório do Panettone';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Menssagem Enviada!';

    header('Location: index.html#cupom-form?modal');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}