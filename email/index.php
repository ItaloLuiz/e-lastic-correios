<?php
require_once("PHPMailer.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Host = "mail.smtp2go.com";
$mail->Port = 2525;
$mail->Username = "";
$mail->Password = "";
$mail->CharSet = 'UTF-8';
$mail->SetFrom("", '');
//$mail->AddReplyTo("vendas6@ecorioonline.com.br", 'Reply Ecorio');