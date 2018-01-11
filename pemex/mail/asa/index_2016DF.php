<?php

require_once 'queriesAsa.php';
require_once '/var/www/external/services/mail/library/Mailin.php';
require_once '/var/www/external/services/mail/conexion.php';
require_once '/var/www/external/services/mail/funciones_export.php';

/*
 * VARIABLES NECESARIAS PARA LA CREACION DEL MENSAJE 
 */
$fecha      = date("Y-m-d");
$mensaje    = file_get_contents( '/var/www/external/services/mail/asa/cdmx.html' );
$num_notas  = numberNotes( 5, $fecha );
$bucles     = floor( $num_notas / 50 ) + 1;
$iteracion  = 0;

/*
 * INICIA PREPARACION DE LA PARTE DINAMICA DEL MENSAJE
 */
do {

  $mi_iteracion = $iteracion + 1;
  $mensaje .= "<tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Presidencia ".$mi_iteracion."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=" . base64_encode(base64_encode('5')) . "&f=$fecha&i=$mi_iteracion'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    </tr>";
  $iteracion++;

} while( $bucles > $iteracion );
  
$mensaje .= "</tr><tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Información Institucional</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

if( numberNotes( 6, $fecha ) )
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('6'))."&f=$fecha'>REPORTE</a></td>";
else
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td></tr><tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Red de Aeropuertos y Servicios Auxiliares</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

if( numberNotes( 7, $fecha ) )
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('7'))."&f=$fecha'>REPORTE</a></td>";
else
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td></tr><tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Nuevo Aeropuerto Internacional de la Ciudad de México</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

if( numberNotes( 8, $fecha ) )
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('8'))."&f=$fecha'>REPORTE</a></td>";
else
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td></tr><tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Grupo Aeroportuario de la Ciudad de México</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

if( numberNotes( 9, $fecha ) )
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('9'))."&f=$fecha'>REPORTE</a></td>";
else
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .="<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td></tr><tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Direccion General de Aeronautica Civil</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

if( numberNotes( 10, $fecha ) )
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('10'))."&f=$fecha'>REPORTE</a></td>";
else
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .=  "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td></tr><tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Aeropuertos</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

if( numberNotes( 11, $fecha ) )
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('11'))."&f=$fecha'>REPORTE</a></td>";
else
  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .=  "
      <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Aerolíneas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 12, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('12'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

  $mensaje .=  "
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Sector Aeronáutico y Aeroespacial</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 13, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('13'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

  $mensaje .=  "
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Secretaría de Gobernación</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 14, $fecha ) )
      $mensaje .= "  <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('14'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

  $mensaje .= "
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Secretaría de Comunicaciones y Transportes</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 15, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode( base64_encode( '15' ) )."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

  $mensaje .=  "
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Secretaría de Turismo</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 16, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode( base64_encode( '16' ) )."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

  $mensaje .= "
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Combustibles</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

    if( numberNotes( 17, $fecha ) )
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/asa/exportAsa.php?p=".base64_encode(base64_encode('17'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

  $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td></tr><tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td></tr></table>";

/*
 * PREPARACION DEL ENVIO
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
    //"to" => array("mariob@gacomunicacion.com" => "mariob@gacomunicacion.com", "emfrigo@hotmail.com" => "Emmanuel", "vazquezoliver@gmail.com" => "Oliver"),
    //"cc" => array("emfrigo@hotmail.com" => "CC Emmanuel"),
    "bcc" => array('oliver@gacomunicacion.com' => 'oliver@gacomunicacion.com','ehb1703@icloud.com' => 'ehb1703@icloud.com','mariob@gacomunicacion.com' => 'mariob@gacomunicacion.com'),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
    "subject" => "ASA",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8")
);

/* 
 * ENVIO DEL MENSAJE...
 */
var_dump($mailin->send_email($data));
