<?php
if( gethostname() === 'Sauron' ){
  include "/var/www/external/services/mail/conexion.php";
  include "querysSonora_.php";
  require_once '/var/www/external/services/mail/library/Mailin.php';
  require_once '/var/www/external/services/mail/funciones_export.php';
}else{
  include "../conexion.php";
  include "querysSonora_.php";
  require_once '../library/Mailin.php';
  require_once '../funciones_export.php';
}


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
    <td colspan='3'><img src='http://187.247.253.5/external/services/mail/sonora/logoSonora2.png'></td>
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
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Sonora</b></td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Gobernadora</td>";

if(numberNotes(13, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=".base64_encode(base64_encode('13'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Rio Sonora</td>";

if(numberNotes(14, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=".base64_encode(base64_encode('14'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Mega Región Arizona-Sonora</td>";

if(numberNotes(15, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=".base64_encode(base64_encode('15'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Procuraduría General de Justicia</td>";

if(numberNotes(16, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=".base64_encode(base64_encode('16'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Enrique Peña Nieto</td>";

if(numberNotes(17, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=".base64_encode(base64_encode('17'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Comisión de Gobiernos Abiertos, Transparencia y Rendición de Cuentas</td>";

if(numberNotes(18, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=".base64_encode(base64_encode('18'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
/****************************/

$mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Primeras Planas") . "</td>";

    if(numberNotes(29, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=" . base64_encode(base64_encode('29')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Columnas") . "</td>";

    if(numberNotes(30, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=" . base64_encode(base64_encode('30')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Cartones de Sonora") . "</td>";

    if(numberNotes(32, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sonora/exportSonora.php?p=" . base64_encode(base64_encode('32')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";




/**************************/

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
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://187.247.253.5/siscap.la/public/boards/snr'>Sistema de Información</a></div>
";
// enviaReporte($mensaje);
//echo ( $mensaje);

/*
 * PREPARACION DEL ENVIO
 */

$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
    "to" => array(
      //'julio.orquiz@gmail.com'=>'julio.orquiz@gmail.com',
      //   "ehb1703@gmail.com" => "ehb1703@gmail.com"
      //  'gimenalara.conagua.monitoreo@gmail.com' => 'gimenalara.conagua.monitoreo@gmail.com',
      //  'fernando.melo@conagua.gob.mx' => 'fernando.melo@conagua.gob.mx',
      //  'iruelas@gmail.com' => 'iruelas@gmail.com'
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
        "alezamavaldez@gmail.com" => "alezamavaldez@gmail.com",
        
        'rodrigomena7@hotmail.com'=>'rodrigomena7@hotmail.com',
        'julio.orquiz@gmail.com'=>'julio.orquiz@gmail.com'   
    ),
    "from" => array("gaimpresos@gacomunicacion.com", utf8_decode("Monitoreo Impresos")),
    "subject" => "Sonora 2016",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-Sonora-Sonora")
  );

var_dump($mailin->send_email($data));



//echo $mensaje;
/*
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
/*
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
    $mail->Password   = "Gacomunicacion#@2014";


    $mail->addAddress('natbriseno.conagua.monitoreo@gmail.com');
    $mail->addAddress('gimenalara.conagua.monitoreo@gmail.com');
    $mail->addAddress('fernando.melo@conagua.gob.mx');
    //$mail->addAddress('isaac.ramirez@conagua.gob.mx');
    $mail->addAddress('iruelas@gmail.com');
    $mail->AddBCC("rubend@gacomunicacion.com");
    $mail->AddBCC("rubendiazramirez@gmail.com");
    $mail->AddBCC("edgarh@gacomunicacion.com");
    $mail->AddBCC('jlga@gacomunicacion.com');
    $mail->AddBCC('jlganaya@gmail.com');
    $mail->AddBCC('alezama@gacomunicacion.com');
    $mail->AddBCC("gmocarmona@gacomunicacion.com");
    $mail->AddBCC("fcocolina@gacomunicacion.com");
    $mail->AddBCC("oortiz@gacomunicacion.com");
    $mail->AddBCC('ehb1703@icloud.com', 'Edgar Oswaldo Hernánde Barajas');
    $mail->AddBCC("alezamavaldez@gmail.com");

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
*/
