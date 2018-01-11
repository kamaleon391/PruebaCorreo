<?php
require '/var/www/external/services/mail/conexion.php';
include "querysSagarpa.php";
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
<table width='900px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td width='3%'>&nbsp;</td>
    <td colspan='4'><img src='http://187.247.253.5/external/services/mail/sagarpa/logopdf.jpg' width='270'></td>
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
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left' >&nbsp;</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Secretario</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Subsecretarias</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Funcionarios</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Delegaciones</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Agricultura</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>". utf8_decode( "Ganadería" ) ."</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Pesca</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Campo</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Varios</b></td>
    </tr>";

    foreach ($estados as $key => $value) {
      if ($key != 9) {
        $mensaje .= "
      <tr>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left' >&nbsp;</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode($value) . "</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>";

        if(numberNotes(6, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('6'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        if(numberNotes(8, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('8'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        if(numberNotes(10, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('10'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        if(numberNotes(12, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('12'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        if(numberNotes(14, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('14'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        if(numberNotes(16, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('16'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        if(numberNotes(18, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('18'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        if(numberNotes(20, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('20'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        if(numberNotes(22, $fecha, $key))
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/sagarpa/exportSagarpa.php?p=".base64_encode(base64_encode('22'))."&f=$fecha&e=".$key."'>Link</a></td>";
        else
          $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

        $mensaje .= "</tr>";
      }
    }

  $mensaje .= "
  <tr>
  <td>&nbsp;</td>
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
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/sagarpa'>Sistema de ".utf8_decode('Información')."</a></div>
";
enviaReporte($mensaje);
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

  $mail->addAddress( "julio.cordova@sagarpa.gob.mx" );
  $mail->addAddress( "diegoescan1@hotmail.com" );
  $mail->addAddress("smtz.ch@gmail.com");

  $mail->AddBCC("vazquezoliver@gmail.com");
  $mail->AddBCC("mariob@gacomunicacion.com");

  $mail->AddBCC("jlga@gacomunicacion.com");
  $mail->AddBCC("rubend@gacomunicacion.com");
  $mail->AddBCC("rubendiazramirez@gmail.com");
  $mail->AddBCC("carloshreyes@gmail.com");
  $mail->AddBCC("fcocolina@gacomunicacion.com");
  $mail->AddBCC("gmocarmona@gacomunicacion.com");
  $mail->AddBCC("oortiz@gacomunicacion.com");
  $mail->AddBCC("paulina@gacomunicacion.com");
  $mail->AddBCC("edgarh@gacomunicacion.com");
  
  $mail->AddBCC("ehb1703@icloud.com");
  $mail->AddBCC("francisco.vallejo@sagarpa.gob.mx");  

  $mail->From = 'gaimpresos@gacomunicacion.com';
  $mail->FromName = "Monitoreo Impresos - Estados";

  $mail->Subject  = "Sagarpa - Estados";
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

?>
