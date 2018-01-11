<?php 
if( getHostName() === 'Sauron' ){
  require_once '/var/www/external/services/mail/library/Mailin.php';
  require_once '/var/www/external/services/mail/querysTamaulipas.php';
  require_once '/var/www/external/services/mail/funciones_export.php';
  require_once '/var/www/external/services/mail/conexion.php';
  require_once '/var/www/external/services/mail/Classes/message.php';

} else {
  require_once '../conexion.php';
  require_once '../library/Mailin.php';
  require_once '../querysTamaulipas.php';
  require_once '../unciones_export.php';
  require_once '../Classes/message.php';
}

/*
 * PREPARA MENSAJE QUE SERA ENVIADO
 */

/*
$message_settings =  array( 
            'state'     => 'TAMAULIPAS', 
            'id'        => 9,
            'html'      => 'tamaulipas.html',
            'directory' => 'tamaulipas',
            'image'     => 'generico.png',
            'date'      => date("Y-m-d"),
            'characters'=> array( 
              5  => 'Egidio Torre Cantu',
              6  => 'Administracion Estatal',
              7  => 'Tamaulipas Parte 1',
              8  => 'Tamaulipas Parte 2',
              9  => 'Baltazar Hinojosa Ochoa',
              10 => 'Francisco Javier García Cabeza de Vaca',
            ) 
          ); 

$message = new Message();
$message->configMessage( $message_settings );
$message->addStaticLinks();
$mensaje = $message->getMessage();

$mensaje = str_replace( '187.247.253.5/external/services/mail/Tamaulipas/generico.png', '187.247.253.5/external/services/mail/tamaulipas/generico.png', $mensaje );
*/

$fecha   = date("Y-m-d");
$mensaje = "<style>body{font-family: Century gothic;
font-size: 10px;}tr {
border-bottom: 1pt solid black;
}</style><table width='700px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;
'>
  <tr>
    <td width='3%'>&nbsp;</td>
    <td colspan='5'><img src='http://187.247.253.5/external/services/mail/tamaulipas/generico.png'></td>
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
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>ING. EGIDIO TORRE CANTÚ</td>";

if(numberNotes(5, $fecha))
    $mensaje .= "<td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('5'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td width='15%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td width='13%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>ADMINISTRACIÓN ESTATAL</td>";

if(numberNotes(6, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('6'))."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>

  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>TAMAULIPAS</td>";

if(numberNotes(7, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('7'))."&f=$fecha'>Parte 1</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

if(numberNotes(8, $fecha))
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('8'))."&f=$fecha'>Parte 2</td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
      <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Baltazar Hinojosa Ochoa</td>";
if( numberNotes( 9 , $fecha ) )
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode( base64_encode( '9' ) )."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
      <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Francisco Javier García Cabeza de Vaca</td>";
if( numberNotes( 10 , $fecha ) )
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode( base64_encode( '10' ) )."&f=$fecha'>REPORTE</a></td>";
else
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >PRIMERAS PLANAS</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >COLUMNAS FINANCIERAS</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >COLUMNAS POLÍTICAS</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >CARTONES</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
  
  <td colspan='7' style='text-align: right;'><span style='text-align: right;
font-size: 8px;
color: rgb(139, 139, 139);'>Grupo Arte y Comunicación &COPY; ".DATE('Y')."</span></td>
</td>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/tamaulipas'>Sistema de Información</a></div>
";

/*
 * PREPARA MENSAJE QUE SERA ENVIADO...
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data   = array(
    "to" => array(
        'análisis.smast@gmail.com' => 'análisis.smast@gmail.com',
        'eduardoabarc@gmail.com' => 'eduardoabarc@gmail.com'
        ),
    "bcc" => array(
      'ehb1703@gmail.com' => 'ehb1703@gmail.com',
      'sintesisga@gmail.com' => 'sintesisga@gmail.com'
    ),
    "from" => array("gaimpresos@gacomunicacion.com", "MONITOREO DE PRENSA"),
    "subject" => "TAMAULIPAS ".mostrar_fecha_completa(date("Y-m-d")),
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-TamaulipasAlterno-CDMX")
);

/*
 * ENVIANDO EMAIL...
 */

// echo $mensaje;
var_dump($mailin->send_email($data));
