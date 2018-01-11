<?php

require '/var/www/external/services/mail/library/Mailin.php';
require '/var/www/external/services/mail/conexion.php';
require '/var/www/external/services/mail/funciones_export.php';
require 'queryscns.php';

$fecha   =  date("Y-m-d");
$mensaje = "<style>
    body{
        margin:0;
        padding:0;
        background-color:#F9F9F9;
        font-family: Century gothic;
        font-size: 10px;
    }
    tr{
        border-bottom: 1pt solid black;
    }
</style>
<table style='width: auto;' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td colspan='3'><img src='http://187.247.253.5/external/services/mail/cns/logopdf.png' width='270'></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Enrique Peña Nieto</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(5, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('5'))."&f=$fecha&e=9'>REPORTE PARTE 1</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  if(numberNotes(6, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('6'))."&f=$fecha&e=9'>REPORTE PARTE 2</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Secretario de Gobernación</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(7, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('7'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Comisionado</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(8, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('8'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
 </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>CNS</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(9, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('9'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>PF</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(10, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('10'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>PREV. READ. SOC.</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(11, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('11'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
 </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>SERV. PROT. FED.</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(12, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('12'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>PGR</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(13, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('13'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>SEDENA</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(14, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('14'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>SEMAR</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(15, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('15'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Primeras Planas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Columnas Políticas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Columnas Financieras</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Cartones</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/cns/exportcns.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
  </tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/cns'>Sistema de Información</a></div>
";

//enviaReporte($mensaje);
sendinblue($mensaje);

function enviaReporte( $mensaje ){
    require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
    $mail->Password   = "Gacomunicacion#@2014";   
    $mail->addAddress('macarrera.segob@gmail.com');
    $mail->addAddress('monitoreocomisionado@gmail.com');
    $mail->addAddress('joserriux@hotmail.com');
    $mail->addAddress('taniaaguilardiaz@gmail.com');
    $mail->addAddress('alejandro.dominguezj@gmail.com');
    $mail->addAddress('mariana.2.2@hotmail.com');
    $mail->AddBCC("carloshreyes@gmail.com");
    $mail->AddBCC("ehb1703@me.com");
    $mail->AddBCC("alejandraopitalua@gmail.com");
    $mail->AddBCC("licldsilva@gmail.com");
    $mail->AddBCC("sintesisga@gmail.com");
    
    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "Monitoreo Impresos";
    $mail->Subject = utf8_decode("Monitoreo Impresos - CDMX");
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Body = $mensaje;
    if (!$mail->Send())
        echo "Error: " . $mail->ErrorInfo;
    else 
        echo "Mensaje enviado";
}

function sendinblue($mensaje){
  $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
    "to" => array(

      "macarrera.segob@gmail.com" => "macarrera.segob@gmail.com", 
      "monitoreocomisionado@gmail.com" => "monitoreocomisionado@gmail.com", 
      "joserriux@hotmail.com" => "joserriux@hotmail.com",
      "taniaaguilardiaz@gmail.com" => "taniaaguilardiaz@gmail.com",
      "alejandro.dominguezj@gmail.com" => "alejandro.dominguezj@gmail.com",
      "mariana.2.2@hotmail.com" => "mariana.2.2@hotmail.com" 
      ),
    "bcc" => array(
      'carloshreyes@gmail.com' => 'carloshreyes@gmail.com',
      'ehb1703@me.com' => 'ehb1703@me.com',
      'alejandraopitalua@gmail.com' => 'alejandraopitalua@gmail.com',
      'licldsilva@gmail.com' => 'licldsilva@gmail.com',
      'sintesisga@gmail.com'=>'sintesisga@gmail.com'
      ),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos - CDMX"),
    "subject" => "CNS - CDMX",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-CNS-CDMX")
);
var_dump($mailin->send_email($data));
}
