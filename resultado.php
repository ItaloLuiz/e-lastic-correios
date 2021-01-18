<?php

require_once __DIR__ . '/vendor/autoload.php';

include 'funcoes.php';
$obj = $_REQUEST['obj'];
$objetos    = array("$obj");
$resultados = boxResultados($objetos);

$msgBox = "
<!--mpdf <!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Rastreio</title>
    <link rel='stylesheet' href='css/style.css'>
</head>
<body>

 <div id='resultados'>
       <div class='header'>
            <h3>Encomenda entregue</h3>
            <h4>Você pode acompanhar o envio com o código de rastreamento: <a href=''>$obj</a></h4>
        </div>
    <div class='box-email'>
      $resultados
    </div>
    <div class='footer'>
            <h3>Dados do Envio</h3>
            <div class='dados-cliente'>Nome: <span>Italo</span></div>
            <div class='dados-cliente'>Email: <span>italo.luis.s@gmail.com</span></div>
            <div class='dados-cliente'>Whatsapp: <span>31 9 9334 6096</span></div>
            <div class='dados-cliente'>Endereço: <span>Ipatinga/MG</span></div>
        </div>
 </div>    
</body>
</html>mpdf-->";



$mpdf = new \Mpdf\Mpdf();
ob_start();
$mpdf->WriteHTML($msgBox);
$html = ob_get_contents();
ob_end_clean();
//$mpdf->Output();
$mpdf->Output("upload/$obj.pdf", \Mpdf\Output\Destination::FILE);


$from    = 'italo.luiz@hotmail.com';
$para    = 'italo.luis.s@gmail.com';
$assunto = 'Vaga PHP';

include 'email/index.php';


$pegarPDF = 'upload/'."$obj.pdf";

$mail->Subject = $assunto;
$msg = $msgBox;
$mail->AltBody = strip_tags($msg);
$mail->MsgHTML($msg);
$mail->AddAddress($para);
$mail->AddAttachment($pegarPDF);
if(!$mail->Send()){
    echo 'erro';
}else{
    echo 'ok';
}




