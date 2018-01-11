<?php

include "/var/www/external/services/mail/conexion.php";
include "querysCONAGUA2015.php";
include '/var/www/external/services/mail/library/Mailin.php';
include '/var/www/external/services/mail/funciones_export.php';

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
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>CDMX</b></td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Titular")."</td>";
    
    if(numberNotes(1, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("CONAGUA")."</td>";

    if(numberNotes(3, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("CUTZAMALA")."</td>";
    
    if(numberNotes(5, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('5'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Presas")."</td>";
    
    if(numberNotes(7, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('7'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Infraestructura Hidráulica")."</td>";
    
    if(numberNotes(9, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('9'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Sequías")."</td>";

    if(numberNotes(11, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('11'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Heladas")."</td>";
    
    if(numberNotes(13, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('13'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Servicio Meteorológico Nacional")."</td>";
    
    if(numberNotes(15, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('15'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Organismos de Cuenca")."</td>";
    
    if(numberNotes(17, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('17'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("ANEAS")."</td>";
    
    if(numberNotes(19, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('19'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("SEMARNAT")."</td>";
    
    if(numberNotes(21, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('21'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Ley General de Aguas")."</td>";

    if(numberNotes(23, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('23'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Acueducto Monterrey 6")."</td>";
    
    if(numberNotes(25, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('25'))."&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Primeras Planas")."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('29'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Columnas Políticas")."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('30'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Columnas Financieras")."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('31'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".("Cartones")."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conagua/exportCONAGUA2015.php?p=".base64_encode(base64_encode('32'))."&f=$fecha'>REPORTE</a></td>
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
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://187.247.253.5/siscap.la/public/boards/conagua'>Sistema de ".('Información')."</a></div>
";
sendinBlue($mensaje);
//echo ( $mensaje);     


function enviaReporte($mensaje){
   
    
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
//$mail->addAddress('isaac.ramirez@conagua.gob.mx');
$mail->addAddress('iruelas@gmail.com');
$mail->AddBCC("rubend@gacomunicacion.com");
$mail->AddBCC("rubendiazramirez@gmail.com");
$mail->AddBCC("edgarh@gacomunicacion.com");
$mail->AddBCC("jesush@gacomunicacion.com");
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
 
$mail->Subject  = utf8_decode("CONAGUA - CDMX 2016");
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

function sendinBlue($mensaje){


/*
 * PREPARACION DEL ENVIO
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
        "to" => array(
            'impresos@info-gacomunicacion.com' => 'impresos@info-gacomunicacion.com'
        ),
        "cc"=> array(),  
        "bcc" => array(
	        'natbriseno.conagua.monitoreo@gmail.com'=>'natbriseno.conagua.monitoreo@gmail.com',
          'gimenalara.conagua.monitoreo@gmail.com'=>'gimenalara.conagua.monitoreo@gmail.com',
          'fernando.melo@conagua.gob.mx'=>'fernando.melo@conagua.gob.mx',
          'iruelas@gmail.com'=>'iruelas@gmail.com',
          //'rubend@gacomunicacion.com'=>'rubend@gacomunicacion.com',
          'rubendiazramirez@gmail.com'=>'rubendiazramirez@gmail.com',
          //'edgarh@gacomunicacion.com'=>'edgarh@gacomunicacion.com',
          //'jesush@gacomunicacion.com'=>'jesush@gacomunicacion.com',
          //'jlga@gacomunicacion.com'=>'jlga@gacomunicacion.com',
          'jlganaya@gmail.com'=>'jlganaya@gmail.com',
          //'alezama@gacomunicacion.com'=>'alezama@gacomunicacion.com',
          //'gmocarmona@gacomunicacion.com'=>'gmocarmona@gacomunicacion.com',
          //'fcocolina@gacomunicacion.com'=>'fcocolina@gacomunicacion.com',
          //'oortiz@gacomunicacion.com'=>'oortiz@gacomunicacion.com',
          'ehb1703@icloud.com'=>'ehb1703@icloud.com',
          'alezamavaldez@gmail.com'=>'alezamavaldez@gmail.com',
          'julio.orquiz@gmail.com' => 'julio.orquiz@gmail.com',
          'sintesisga@gmail.com' => 'sintesisga@gmail.com'
          ),
        "from" => array("gaimpresos@gacomunicacion.com","Monitoreo Impresos"),
        "subject" =>  "CONAGUA - CDMX 2016",
        "html" => $mensaje,
        "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-Conagua-CDMX")
    );
/*
 * ENVIO...
 */
var_dump($mailin->send_email($data));
}

/*
function mostrar_fecha_completa($fecha)
{
    $subfecha = explode("-",$fecha); 

    $año=$subfecha[0];
    $mes=$subfecha[1];
    $dia=$subfecha[2];

    $dia2=date( "d", mktime(0,0,0,$mes,$dia,$año));
    $mes2=date( "m", mktime(0,0,0,$mes,$dia,$año));
    $año2=date( "Y", mktime(0,0,0,$mes,$dia,$año));
    $dia_sem=date( "w", mktime(0,0,0,$mes,$dia,$año));

   switch($dia_sem)
   { 
       case "0":   // Bloque 1 
         $dia_sem3='Domingo'; 
       break; 
       
       case "1":   // Bloque 1 
         $dia_sem3='Lunes'; 
       break; 
       
       case "2":   // Bloque 1 
         $dia_sem3='Martes'; 
       break; 
   
       case "3":   // Bloque 1 
         $dia_sem3='Miercoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='Sabado'; 
       break; 
   
      default:   // Bloque 3 
    };
   
    switch($mes2) 
    { 
        case "1":   // Bloque 1 
            $mes3='Enero'; 
        break; 
    
        case "2":   // Bloque 1 
            $mes3='Febrero';
        break; 
    
        case "3":   // Bloque 1 
            $mes3='Marzo';
        break; 
    
        case "4":   // Bloque 1 
            $mes3='Abril'; 
        break;  
        
        case "5":   // Bloque 1 
            $mes3='Mayo';
        break;   
        
        case "6":   // Bloque 1 
            $mes3='Junio';    
        break; 
        
        case "7":   // Bloque 1 
            $mes3='Julio';
        break; 
    
        case "8":   // Bloque 1 
            $mes3='Agosto';
        break; 
    
        case "9":   // Bloque 1 
            $mes3='Septiembre';
        break; 
    
        case "10":   // Bloque 1 
            $mes3='Octubre';
        break; 
    
        case "11":   // Bloque 1 
            $mes3='Noviembre';
        break;           
    
        case "12":   // Bloque 1 
            $mes3='Diciembre';  
        break; 
    
        default:   // Bloque 3 
     break; 
  }; 
   
   
$fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;

return $fecha_texto;
};
*/
?>
