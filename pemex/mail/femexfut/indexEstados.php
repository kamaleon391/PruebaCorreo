<?php
require '/var/www/external/services/mail/library/Mailin.php';
require '/var/www/external/services/mail/conexion.php';
require '/var/www/external/services/mail/funciones_export.php';
require 'querysFemexfut.php';

$fecha    = date("Y-m-d");
$mensaje  = "<style>
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
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Estados</td>
</tr>

<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>FEMEXFUT</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes(6, $fecha, 9) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('6'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>SEL. NACIONAL</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 8, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('8'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>AMERICA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 10, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('10'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>ATLAS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 12, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('12'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>CHIVAS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 14, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('14'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>CRUZ AZUL</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 16, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('16'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>DORADOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 18, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('18'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>GALLOS BLANCOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 20, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('20'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>JAGUARES</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 22, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('22'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>LEÓN</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 24, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('24'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>MONTERREY</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 26, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('26'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>MORELIA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 28, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('28'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PACHUCA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 30, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('30'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PUEBLA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 32, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('32'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>SAN LUIS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 34, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('34'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>SANTOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 36, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('36'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>TIGRES</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 38, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('38'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>TIJUANA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 40, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('40'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>TOLUCA</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 42, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('42'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>UNAM</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 44, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('44'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>VERACRUZ</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 46, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('46'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";


$mensaje .= "
</tr>
<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>VARIOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 48, $fecha, 9 ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/femexfut/exportFemexfut.php?p=".base64_encode(base64_encode('48'))."&f=$fecha&e=9'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "  
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
 * PREPARA OBJETO ENVIO
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
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos - Estados"),
    "subject" => "FEMEXFUT - Estados",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8")
);


/*
 * ENVIANDO...
 */
var_dump($mailin->send_email($data));
