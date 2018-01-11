<?php
require "/var/www/external/services/mail/library/Mailin.php";
require '/var/www/external/services/mail/funciones_export.php';
require '/var/www/external/services/mail/conexion.php';
require 'querysemp.php';

/*
 * PREPARA EL MENSAJE QUE SERA ENVIADO...
 */

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

    if(numberNotes(16, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('16'))."&f=$fecha'>REPORTE PARTE 1</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  if(numberNotes(17, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('17'))."&f=$fecha'>REPORTE PARTE 2</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Primera Dama</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(18, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('18'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Funcionarios Presidencia</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(19, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('19'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Jefe EMP</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(20, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('20'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Estado Mayor Presidencial</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes(21, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/emp/exportemp.php?p=".base64_encode(base64_encode('21'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

  $mensaje .= "
  </tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/emp'>Sistema de Información</a></div>
";
   
sendinblue($mensaje);

//enviaReporte($mensaje);

function sendinblue($mensaje){
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
    "to" => array(
      "segunda@emp.gob.mx" => "segunda@emp.gob.mx", 
      "enlace@emp.gob.mx" => "enlace@emp.gob.mx", 
      "marcorate3@gmail.com" => "marcorate3@gmail.com",
      "jenniferemp26@gmail.com" => "jenniferemp26@gmail.com",
      "medios.electronicos2@gmail.com"=>"medios.electronicos2@gmail.com" //solicitud de octavio Sabado 25 Feb.  
      ),"cc" => array(),
      "bcc" => array(
        'ehb1703@me.com' => 'ehb1703@me.com',
        'sintesisga@gmail.com'=>'sintesisga@gmail.com'
      ),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos "),
    "subject" => "Estado Mayor Presidencial - Estados",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-emp-Edos")
);
var_dump($mailin->send_email($data));
}


function enviaReporte($mensaje){
/* Vamos a agregar un comentario por aqui para poder hacer un commit, saludos*/

require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";
//require "/var/www/external/mail/PHPMailer/PHPMailerAutoload.php";

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
$mail->Subject  = "Estado Mayor Presidencial - Estados";
$mail->WordWrap = 50;
// Correo destino
$mail->IsHTML(TRUE);
$mail->Body = $mensaje;
if(!$mail->Send()) {
    echo "Error: " . $mail->ErrorInfo;
} else {
    echo "Mensaje enviado";
}
}
