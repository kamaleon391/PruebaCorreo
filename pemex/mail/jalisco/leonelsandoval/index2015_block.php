<?php

require '/var/www/external/services/mail/library/Mailin.php';
require '/var/www/external/services/mail/conexion.php';
require '/var/www/external/services/mail/funciones_export.php';
require 'querysLeonel.php';

/*
 * PREPARA MENSAJE QUE SERA ENVIADO...
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
<table width='900px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td width='3%'>&nbsp;</td>
    <td colspan='4'><img src='http://187.247.253.5/external/services/mail/jalisco/leonelsandoval/logoGA2.png'></td>
    <td width='2%'>&nbsp;</td>
    <td width='3%'>&nbsp;</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
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
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
    <tr>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);'></td>
        <td width='10%' style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PRENSA</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'>&nbsp;</td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Leonel Sandoval Figueroa</td>";

    if(numberNotes(4, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/jalisco/leonelsandoval/exportTestigos.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >PRIMERAS PLANAS</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/jalisco/leonelsandoval/exportTestigos.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >COLUMNAS POLITÍCAS</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/jalisco/leonelsandoval/exportTestigos.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >CARTONES</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/jalisco/leonelsandoval/exportTestigos.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/jalisco'>Sistema de Información</a></div>
";

/*
 * PREPARA OBJETO ENVIO...
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data   = array(
    "to" => array(
            'impresos@info-gacomunicacion.com' => 'impresos@info-gacomunicacion.com'
      ),
    "bcc" => array(
      'chelismunguia@hotmail.com' => 'chelismunguia@hotmail.com',
      'leonelsandoval_3@hotmail.com' => 'leonelsandoval_3@hotmail.com',
      'rubendiazramirez@gmail.com' => 'rubendiazramirez@gmail.com',
      'carloshreyes@gmail.com' => 'carloshreyes@gmail.com',
      'ehb1703@icloud.com' => 'ehb1703@icloud.com',
      'ehb1703@me.com' => 'ehb1703@me.com'
      ),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
    "subject" => "Magistrado Leonel Sandoval Figueroa",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-LeonelSandoval")
);

/*
 * ENVIANDO...
 */
var_dump($mailin->send_email($data));
