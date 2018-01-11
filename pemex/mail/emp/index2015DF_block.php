<?php

require '/var/www/external/services/mail/library/Mailin.php';
require '/var/www/external/services/mail/conexion.php';
require '/var/www/external/services/mail/funciones_export.php';
require 'querysemp.php';

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
    <td colspan='3'><img src='http://187.247.253.5/external/services/mail/emp/logopdf.png' width='270'></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Presidente</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(5, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('5'))."&f=$fecha&e=9'>REPORTE PARTE 1</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  if(numberNotes(6, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('6'))."&f=$fecha&e=9'>REPORTE PARTE 2</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Primera Dama</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(7, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('7'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Funcionarios Presidencia</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(8, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('8'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
 </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Jefe EMP</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(9, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('9'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Estado Mayor Presidencial</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(10, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('10'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Primeras Planas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Columnas Políticas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Columnas Financieras</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Cartones</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
  </tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/emp'>Sistema de Información</a></div>
";

    
sendinblue($mensaje);
//echo $mensaje;
//enviaReporte($mensaje);

function sendinblue($mensaje){
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
    "to" => array(
      "segunda@emp.gob.mx" => "segunda@emp.gob.mx", 
      "enlace@emp.gob.mx" => "enlace@emp.gob.mx", 
      "marcorate3@gmail.com" => "marcorate3@gmail.com",
      "jenniferemp26@gmail.com" => "jenniferemp26@gmail.com",
      "medios.electronicos2@gmail.com"=> "medios.electronicos2@gmail.com" //solicitud de octavio, Sabado 25 Feb.  
      ),"cc" => array(),
      "bcc" => array(
        'ehb1703@gmail.com' => 'ehb1703@gmail.com',
        'sintesisga@gmail.com'=>'sintesisga@gmail.com'
      ),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos - CDMX"),
    "subject" => "Estado Mayor Presidencial - CDMX",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-emp-CDMX")
);
var_dump($mailin->send_email($data));
}


function enviaReporte($mensaje){
  /*Vamos a agregar un comentario por aqui para poder hacer un commit, saludos*/
  require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";

  $mail = new PHPMailer();
  $mail->IsSMTP();
  /********************  CODIGO COMENTADO POR ABUSO DE ENVIOS GA  **********************    
    $mail->Host     = "smtp.gacomunicacion.com";
    $mail->Port     = 587;
    $mail->SMTPAuth = true;
    $mail->Username = "gaimpresos@gacomunicacion.com";
    $mail->Password = "Gagdl1";
  ********************************************************************************************/
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
  $mail->Password   = "Gacomunicacion#@2014";   
  $mail->addAddress("segunda@emp.gob.mx");
  $mail->addAddress("enlace@emp.gob.mx");
  $mail->addAddress("marcorate3@gmail.com");
  $mail->addAddress("jenniferemp26@gmail.com");
  $mail->AddBCC('ehb1703@icloud.com');
  $mail->AddBCC('sintesisga@gmail.com');
  $mail->AddBCC('medios.electronicos2@gmail.com');    
  $mail->From = 'gaimpresos@gacomunicacion.com';
  $mail->FromName = "Monitoreo Impresos - CDMX";
  $mail->Subject  = "Estado Mayor Presidencial - CDMX";
  $mail->WordWrap = 50;
  $mail->IsHTML(TRUE);
  $mail->Body = $mensaje;
  if(!$mail->Send()) {
      echo "Error: " . $mail->ErrorInfo;
  } else {
      echo "Mensaje enviado";
  }
}
