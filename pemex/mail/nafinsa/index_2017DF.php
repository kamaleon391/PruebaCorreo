<?php
include '/var/www/external/services/mail/conexion.php';
include 'querysNafinsa.php';
include '/var/www/external/services/mail/library/Mailin.php';
include '/var/www/external/services/mail/funciones_export.php';

$ip = '187.247.253.5';
//$ip = '192.168.3.4';

$fecha=  date("Y-m-d");
$mensaje="<style>
    body{
        margin:0;
        padding:0;
        background-color:#F9F9F9;
        font-family: Century gothic;
        font-size: 10px;
    } tr {
        border-bottom: 1pt solid black;
    }
</style>
<table style='width: auto;' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td colspan='3'><img src='http://$ip/external/services/mail/nafinsa/logoNafinsa.jpg'></td>
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
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>CDMX</b></td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("NAFINSA")."</td>";
    
if (query(1, $fecha)) {
        $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://$ip/external/services/mail/nafinsa/exportNafinsa.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>";
} else {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
}
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Presidencia")."</td>";

if (numberNotes(2, $fecha)) {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://$ip/external/services/mail/nafinsa/exportNafinsa.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>";
} else {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
}
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Primeras Planas")."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://$ip/external/services/mail/nafinsa/exportNafinsa.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Columnas Nafin")."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://$ip/external/services/mail/nafinsa/exportNafinsa.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Cartones")."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://$ip/external/services/mail/nafinsa/exportNafinsa.php?p=".base64_encode(base64_encode('5'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/nafinsa'>Sistema de ".('Información')."</a></div>
";
sendinBlue($mensaje);
//echo ($mensaje);

function sendinBlue($mensaje) {
/*
 * PREPARACION DEL ENVIO
 */
  $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
  $data = array(
        "to" => array(
            'clacruzperez@hotmail.com' => 'clacruzperez@hotmail.com',
            'ccruz@nafin.gob.mx' => 'ccruz@nafin.gob.mx',
            'glopez@nafin.gob.mx' => 'glopez@nafin.gob.mx'
        ),
        "cc"=> array(
            'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com'
        ),  
        "bcc" => array(
            'ehb1703@gmail.com' => 'ehb1703@gmail.com'
          ),
        "from" => array("gaimpresos@gacomunicacion.com","Monitoreo Impresos"),
        "subject" =>  "NAFINSA",
        "html" => $mensaje,
        "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-NAFINSA-CDMX")
    );
var_dump($mailin->send_email($data));
}
