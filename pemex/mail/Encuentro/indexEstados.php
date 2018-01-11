<?php
require "/var/www/external/services/mail/library/Mailin.php";
$_name_  = 'Encuentro';

require '/var/www/external/services/mail/conexion.php';
include "querys".$_name_.".php";
$fecha = date("Y-m-d");

$estados = array(1 => 'Aguascalientes',
    2 => 'Baja California',
    3 => 'Baja California Sur',
    4 => 'Campeche',
    5 => 'Coahuila',
    6 => 'Colima',
    7 => 'Chiapas',
    8 => 'Chihuahua',
    9 => 'Distrito Federal',
    10 => 'Durango',
    11 => 'Guanajuato',
    12 => 'Guerrero',
    13 => 'Hidalgo',
    14 => 'Jalisco',
    15 => 'Estado de México',
    16 => 'Michoacán',
    17 => 'Morelos',
    18 => 'Nayarit',
    19 => 'Nuevo Leon',
    20 => 'Oaxaca',
    21 => 'Puebla',
    22 => 'Queretaro',
    23 => 'Quintana Roo',
    24 => 'San Luis Potosi',
    25 => 'Sinaloa',
    26 => 'Sonora',
    27 => 'Tabasco',
    28 => 'Tamaulipas',
    29 => 'Tlaxcala',
    30 => 'Veracruz',
    31 => 'Yucatan',
    32 => 'Zacatecas');

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
<table width='500px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td width='25%'>&nbsp;</td>
    <td colspan='4'><img src='http://187.247.253.5/external/services/mail/".$_name_."/logopdf.jpg' width='270'></td>
    <td width='25%'>&nbsp;</td>
    <td width='25%'>&nbsp;</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Estados</td>
</tr>

<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Encuentro Social</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 10, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/".$_name_."/export".$_name_.".php?p=".base64_encode(base64_encode('10'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "    
</tr>

<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PRI</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 11, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/".$_name_."/export".$_name_.".php?p=".base64_encode(base64_encode('11'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "  
</tr>

<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PAN</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes( 12, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/".$_name_."/export".$_name_.".php?p=".base64_encode(base64_encode('12'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "  
</tr>

<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PRD</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes( 13 , $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/".$_name_."/export".$_name_.".php?p=".base64_encode(base64_encode('13'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "  
</tr>

<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Encuestas</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if(numberNotes( 14, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/".$_name_."/export".$_name_.".php?p=".base64_encode(base64_encode('14'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
$mensaje .= "</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PT</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
if( numberNotes( 16, $fecha ) )
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/".$_name_."/export".$_name_.".php?p=".base64_encode(base64_encode('16'))."&f=$fecha'>REPORTE</a></td>";
else
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "  
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Primeras Planas</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/Encuentro/exportEncuentro.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Columnas Políticas</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/Encuentro/exportEncuentro.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Columnas Financieras</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/Encuentro/exportEncuentro.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Cartones</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/Encuentro/exportEncuentro.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>

</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/encuentro'>Sistema de Información</a></div>";

sendinblue($mensaje);
//enviaReporte($mensaje);
//echo $mensaje;


function enviaReporte($mensaje){
  require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";
  //require "/var/www/external/mail/PHPMailer/PHPMailerAutoload.php";
  $mail = new PHPMailer();
  $mail->IsSMTP();

/*
$mail->Host     = "smtp.gacomunicacion.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
$mail->Username = "prensa1@gacomunicacion.com";
$mail->Password = "Periodico321";
*/

  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
  $mail->Password   = "Gacomunicacion#@2014";  

  $mail->AddBCC("javors11@hotmail.com");
  $mail->AddBCC("jrs@studiomercapol.com");

  $mail->AddBCC("vazquezoliver@gmail.com");

  $mail->AddBCC("edgarh@gacomunicacion.com");
  $mail->AddBCC("ehb1703@me.com");
  $mail->AddBCC("carloshreyes@gmail.com");
  $mail->AddBCC("jlga@gacomunicacion.com");
  $mail->AddBCC("rubend@gacomunicacion.com");
  $mail->AddBCC("rubendiazramirez@gmail.com");
  $mail->AddBCC("fcocolina@gacomunicacion.com");
  $mail->AddBCC("gmocarmona@gacomunicacion.com");
  $mail->AddBCC("oortiz@gacomunicacion.com");
  $mail->AddBCC("paulina@gacomunicacion.com");
  $mail->AddBCC("julio.orquiz@gmail.com");

  $mail->From = 'gaimpresos@gacomunicacion.com';
  $mail->FromName = "Monitoreo Impresos - Estados";

  $mail->Subject  = "Encuentro Social";
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

function sendinblue($message){

  /*
* PREPARA EL OBJETO ENVIO
*/
  $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
  $data   = array(
      "bcc" => array(
          'javors11@hotmail.com' => 'javors11@hotmail.com',
          'jrs@studiomercapol.com' => 'jrs@studiomercapol.com',
          'vazquezoliver@gmail.com' => 'vazquezoliver@gmail.com',
          'edgarh@gacomunicacion.com' => 'edgarh@gacomunicacion.com',
          'ehb1703@me.com' => 'ehb1703@me.com',
          'carloshreyes@gmail.com' => 'carloshreyes@gmail.com',
          'jlga@gacomunicacion.com' => 'jlga@gacomunicacion.com',
          'mariob@gacomunicacion.com' => 'mariob@gacomunicacion.com',
          'rubend@gacomunicacion.com' => 'rubend@gacomunicacion.com',
          'rubendiazramirez@gmail.com' => 'rubendiazramirez@gmail.com',
          'fcocolina@gacomunicacion.com' => 'fcocolina@gacomunicacion.com',
          'gmocarmona@gacomunicacion.com' => 'gmocarmona@gacomunicacion.com',
          'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com',
          'paulina@gacomunicacion.com' => 'paulina@gacomunicacion.com',
          'julio.orquiz@gmail.com' => 'julio.orquiz@gmail.com' 
      ),
      "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos - Estados"),
      "subject" => "Encuentro Social",
      "html" => $message,
      "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-Encuentro-Estados")
  );

  /*
   * ENVIANDO EMAIL...
   */
  var_dump($mailin->send_email($data));
}
