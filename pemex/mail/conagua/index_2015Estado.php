<?php

include "/var/www/external/services/mail/conexion.php";
include "querysCONAGUA2015.php";
require_once '/var/www/external/services/mail/library/Mailin.php';
require_once '/var/www/external/services/mail/funciones_export.php';

$fecha=  date("Y-m-d");
$mensaje="<style>
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
    <td colspan='3'><img src='http://187.247.253.5/external/services/mail/conagua/coangua.jpg'></td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
    <tr>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);'></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Estados</b></td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Titular</td>";

if(numberNotes(2, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>CONAGUA</td>";

if(numberNotes(4, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>CUTZAMALA</td>";

if(numberNotes(6, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('6'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Presas</td>";

if(numberNotes(8, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('8'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Infraestructura Hidráulica") . "</td>";

if(numberNotes(10, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('10'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Sequías") . "</td>";

if(numberNotes(12, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('12'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Heladas</td>";

if(numberNotes(14, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('14'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Servicio Meteorológico Nacional") . "</td>";

if(numberNotes(16, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('16'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Organismos de Cuenca</td>";

if(numberNotes(18, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('18'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>ANEAS</td>";

if(numberNotes(20, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('20'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>SEMARNAT</td>";

if(numberNotes(22, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('22'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Ley General de Aguas</td>";

if(numberNotes(24, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('24'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Acueducto Monterrey 6</td>";

if(numberNotes(26, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('26'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://187.247.253.5/siscap.la/public/boards/conagua'>Sistema de" . utf8_decode("Información") . "</a></div>";
enviaReporte($mensaje);
//echo ( $mensaje);

/*
 * PREPARACION DEL ENVIO
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
    "to" => array(
        'natbriseno.conagua.monitoreo@gmail.com' => 'natbriseno.conagua.monitoreo@gmail.com',
        'gimenalara.conagua.monitoreo@gmail.com' => 'gimenalara.conagua.monitoreo@gmail.com',
        'fernando.melo@conagua.gob.mx' => 'fernando.melo@conagua.gob.mx',
        'iruelas@gmail.com' => 'iruelas@gmail.com'
    ),
    //"cc" => array("raulbeyruti@gmail.com" => "raulbeyruti@gmail.com"),
    "bcc" => array(
        "rubend@gacomunicacion.com" => "rubend@gacomunicacion.com",
        "rubendiazramirez@gmail.com" => "rubendiazramirez@gmail.com",
        "edgarh@gacomunicacion.com" => "edgarh@gacomunicacion.com",
        'jlga@gacomunicacion.com' => 'jlga@gacomunicacion.com',
        'alezama@gacomunicacion.com' => 'alezama@gacomunicacion.com',
        "gmocarmona@gacomunicacion.com" => "gmocarmona@gacomunicacion.com",
        "fcocolina@gacomunicacion.com" => "fcocolina@gacomunicacion.com",
        "oortiz@gacomunicacion.com" => "oortiz@gacomunicacion.com",
        'ehb1703@icloud.com' => 'ehb1703@icloud.com',
        'ehb1703@gmail.com' => 'ehb1703@gmail.com',
        "alezamavaldez@gmail.com" => "alezamavaldez@gmail.com",
        'julio.orquiz@gmail.com'=>'julio.orquiz@gmail.com'
    ),
    "from" => array("gaimpresos@gacomunicacion.com", utf8_decode("Monitoreo Impresos")),
    "subject" =>  utf8_decode("CONAGUA - Estados 2016"),
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-Conagua-Estados")
);
/*
 * ENVIO...
 */

//var_dump($mailin->send_email($data));

function enviaReporte($mensaje) {
    require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    /*
      $mail->Host     = "smtp.gacomunicacion.com";
      $mail->Port     = 587;
      $mail->SMTPAuth = true;
      $mail->Username = "prensa3@gacomunicacion.com";
      $mail->Password = "Periodico654";
    */

    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
    $mail->Password   = "Gacomunicacion#@2014";


    $mail->addAddress('natbriseno.conagua.monitoreo@gmail.com');
    $mail->addAddress('gimenalara.conagua.monitoreo@gmail.com');
    $mail->addAddress('fernando.melo@conagua.gob.mx');
    $mail->addAddress('iruelas@gmail.com');

    //$mail->AddBCC("rubend@gacomunicacion.com");
    $mail->AddBCC("rubendiazramirez@gmail.com");
    //$mail->AddBCC("edgarh@gacomunicacion.com");
    //$mail->AddBCC('jlga@gacomunicacion.com');
    $mail->AddBCC("alezamavaldez@gmail.com");
    //$mail->AddBCC('alezama@gacomunicacion.com');
    //$mail->AddBCC("gmocarmona@gacomunicacion.com");
    //$mail->AddBCC("fcocolina@gacomunicacion.com");
    //$mail->AddBCC("oortiz@gacomunicacion.com");
    $mail->AddBCC('ehb1703@icloud.com', 'Edgar Oswaldo Hernánde Barajas');
    $mail->AddBCC('ehb1703@gmail.com');
    $mail->AddBCC('julio.orquiz@gmail.com');
    //$mail->AddBCC('mariob@gacomunicacion.com');
    $mail->AddBCC('sintesisga@gmail.com');

    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "Monitoreo Impresos";
    $mail->Subject  = utf8_decode("CONAGUA - Estados 2016");
    $mail->WordWrap = 50;
    $mail->IsHTML(TRUE);

    $mail->Body = $mensaje;

    if(!$mail->Send()) {
        echo "Error: " . $mail->ErrorInfo;
    } else {
        echo "Mensaje enviado";
    }
}

