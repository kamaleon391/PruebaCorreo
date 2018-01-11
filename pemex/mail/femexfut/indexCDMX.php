<?php
require '/var/www/external/services/mail/library/Mailin.php';
require '/var/www/external/services/mail/conexion.php';
require '/var/www/external/services/mail/funciones_export.php';
require 'querysFemexfut.php';

/*
 * PREPARA MENSAJE PARA ENVIO
 */
$fecha   = date("Y-m-d");
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
<table width='500px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td width='25%'>&nbsp;</td>
    <td colspan='4'><img src='http://187.247.253.5/external/services/mail/femexfut/logoGA2.png' width='270'></td>
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
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>CDMX</td>
</tr>

<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>FEMEXFUT</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes(5, $fecha, 9) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('5'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>SEL. NACIONAL</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 7, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('7'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>AMERICA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 9, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('9'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>ATLAS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 11, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('11'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>CHIVAS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 13, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('13'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>CRUZ AZUL</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 15, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('15'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>DORADOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 17, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('17'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>GALLOS BLANCOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 19, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('19'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>JAGUARES</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 21, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('21'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>LEÓN</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 23, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('23'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>MONTERREY</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 25, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('25'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>MORELIA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 27, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('27'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PACHUCA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 29, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('29'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PUEBLA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 31, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('31'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>SAN LUIS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 33, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('33'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>SANTOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 35, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('35'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>TIGRES</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 37, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('37'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>TIJUANA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 39, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('39'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>TOLUCA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 41, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('41'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>UNAM</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 43, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('43'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>VERACRUZ</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 45, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('45'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>VARIOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 47, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('47'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "  
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Primeras Planas</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Columnas Políticas</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Columnas Financieras</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Cartones</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>

</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/femexfut'>Sistema de Información</a></div>";

/*
 * PREPARA OBJETO DE ENVIO...
 */

$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data   = array(
    //"to" => array("sintesis@issste.gob.mx" => "sintesis@issste.gob.mx"),
    //"cc" => array("raulbeyruti@gmail.com" => "raulbeyruti@gmail.com"),
    "bcc" => array(
      'jlga@gacomunicacion.com' => 'jlga@gacomunicacion.com',
      'gmocarmona@gacomunicacion.com' => 'gmocarmona@gacomunicacion.com',
      'fcocolina@gacomunicacion.com' => 'fcocolina@gacomunicacion.com',
      'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com',
      'rubend@gacomunicacion.com' => 'rubend@gacomunicacion.com',
      'rubendiazramirez@gmail.com' => 'rubendiazramirez@gmail.com',
      'ehb1703@icloud.com' => 'ehb1703@icloud.com',
      'edgarh@gacomunicacion.com' => 'edgarh@gacomunicacion.com',
      'paulina@gacomunicacion.com' => 'paulina@gacomunicacion.com',
      'vazquezoliver@gmail.com' => 'vazquezoliver@gmail.com',
      'carloshreyes@gmail.com' => 'carloshreyes@gmail.com',
      'mariob@gacomunicacion.com' => 'mariob@gacomunicacion.com'
      ),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos - CDMX"),
    "subject" => "FEMEXFUT - CDMX",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8")
);


var_dump($mailin->send_email($data));
