<?php
require '/var/www/external/services/mail/conexion.php';
require 'querysSNR2015.php';

$fecha = date("Y-m-d");
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
    <td colspan='3'><img src='http://187.247.253.5/external/services/mail/SNR2015/logoGA2.png'></td>
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
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>DF</b></td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Claudia Artemisa Pavlovich Arellano") . "</td>";

    if(numberNotes(8, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('8')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Gobierno Estatal") . "</td>";

    if(numberNotes(9, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('9')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Manuel Acosta") . "</td>";

    if(numberNotes(10, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('10')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Hermosillo") . "</td>";

    if(numberNotes(11, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('11')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Varios") . "</td>";

    if(numberNotes(12, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('12')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Primeras Planas") . "</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('1')) . "&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Columnas Políticas") . "</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('2')) . "&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Columnas Financieras") . "</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('3')) . "&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . utf8_decode("Cartones") . "</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/SNR2015/exportSNR2015.php?p=" . base64_encode(base64_encode('4')) . "&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://187.247.253.5/siscap.la/public/boards/cpa'>Sistema de " . utf8_decode('Información') . "</a></div>
";
enviaReporte($mensaje);
//echo ( $mensaje);

function enviaReporte($mensaje)
{
  require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";
  $mail = new PHPMailer();
  $mail->IsSMTP();
/*
  $mail->Host     = "smtp.gacomunicacion.com";
  $mail->Port     = 587;
  $mail->SMTPAuth = true;
  $mail->Username = "prensa2@gacomunicacion.com";
  $mail->Password = "Periodico456";
  */
  
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
  $mail->Password   = "Gacomunicacion#@2014";   
  
  
    $mail->AddBCC("gmocarmona@gacomunicacion.com");
    $mail->AddBCC("fcocolina@gacomunicacion.com");
    $mail->AddBCC("oortiz@gacomunicacion.com");
    $mail->AddBCC("rubend@gacomunicacion.com");
    $mail->AddBCC("edgarh@gacomunicacion.com");
    $mail->AddBCC('ehb1703@icloud.com');
    $mail->AddBCC('panosalido@icloud.com', 'Pano Salido');
    $mail->AddBCC('tomasmoro17@gmail.com', 'Sergio Torres');
    $mail->AddBCC('guaymas70@gmail.com', 'Marcela Alvarado');
    $mail->AddBCC('mirnavirgen@gmail.com', 'Mirna Jiménez');
    $mail->AddBCC('hoyosjorge01@gmail.com', 'Jorge Hoyos');
    $mail->AddBCC('walacan11@gmail.com', 'Wilebaldo Alatriste');
    $mail->AddBCC('jose01047@gmail.com', 'Jose Luis Hernández');
    $mail->AddBCC('jlga@gacomunicacion.com', 'José Luis Gutiérrez Anaya');
    $mail->AddBCC('alezama@gacomunicacion.com', 'Alejandro Lezama Valdez');
    $mail->AddBCC('elsavillac@gmail.com', 'Elsa Villa Castro');
    $mail->AddBCC('mayeverduzco@gmail.com', 'Maye Verduzco');
    $mail->AddBCC('andradeivone2002@gmail.com', 'Ivone Andrade');
    $mail->AddBCC('asertiva7@gmail.com', '');
    $mail->AddBCC('eldamolinay@gmail.com', 'Elda Molina');
    $mail->AddBCC('asertiva7@gmail.com', 'Olga Morales Anaya');
    $mail->AddBCC('vmendoza1@hotmail.com', 'Victor Mendoza Lambert');
    $mail->AddBCC('eldamolinay@gmail.com');
    $mail->AddBCC("alezamavaldez@gmail.com");
    $mail->AddBCC("jorge.duran@sonora.gob.mx");
    //$mail->AddBCC('mochoa.romo@gmail.com');
    //$mail->AddBCC('juanpabloacosta81@gmail.com');
    $mail->AddBCC('patricia.meuly@sonora.gob.mx');
   
    $mail->AddBCC("mariob@gacomunicacion.com");
   
    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "Monitoreo Impresos";
    $mail->Subject = utf8_decode("Sonora - DF 2016");
    $mail->WordWrap = 50;
// Correo destino
    $mail->IsHTML(true);
    $mail->Body = $mensaje;
    if (!$mail->Send()) {
        echo "Error: " . $mail->ErrorInfo;
    } else {
        echo "Mensaje enviado";
    }
}
function mostrar_fecha_completa($fecha)
{
    $subfecha = explode("-", $fecha);
    $año = $subfecha[0];
    $mes = $subfecha[1];
    $dia = $subfecha[2];
    $dia2 = date("d", mktime(0, 0, 0, $mes, $dia, $año));
    $mes2 = date("m", mktime(0, 0, 0, $mes, $dia, $año));
    $año2 = date("Y", mktime(0, 0, 0, $mes, $dia, $año));
    $dia_sem = date("w", mktime(0, 0, 0, $mes, $dia, $año));
    switch ($dia_sem) {
    case "0": // Bloque 1
        $dia_sem3 = 'Domingo';
        break;
    case "1": // Bloque 1
        $dia_sem3 = 'Lunes';
        break;
    case "2": // Bloque 1
        $dia_sem3 = 'Martes';
        break;
    case "3": // Bloque 1
        $dia_sem3 = 'Miercoles';
        break;
    case "4": // Bloque 1
        $dia_sem3 = 'Jueves';
        break;
    case "5": // Bloque 1
        $dia_sem3 = 'Viernes';
        break;
    case "6": // Bloque 1
        $dia_sem3 = 'Sabado';
        break;
    default: // Bloque 3
    };
    switch ($mes2) {
    case "1": // Bloque 1
        $mes3 = 'Enero';
        break;
    case "2": // Bloque 1
        $mes3 = 'Febrero';
        break;
    case "3": // Bloque 1
        $mes3 = 'Marzo';
        break;
    case "4": // Bloque 1
        $mes3 = 'Abril';
        break;
    case "5": // Bloque 1
        $mes3 = 'Mayo';
        break;
    case "6": // Bloque 1
        $mes3 = 'Junio';
        break;
    case "7": // Bloque 1
        $mes3 = 'Julio';
        break;
    case "8": // Bloque 1
        $mes3 = 'Agosto';
        break;
    case "9": // Bloque 1
        $mes3 = 'Septiembre';
        break;
    case "10": // Bloque 1
        $mes3 = 'Octubre';
        break;
    case "11": // Bloque 1
        $mes3 = 'Noviembre';
        break;
    case "12": // Bloque 1
        $mes3 = 'Diciembre';
        break;
    default: // Bloque 3
        break;
    };
    $fecha_texto = $dia_sem3 . ' ' . $dia2 . ' ' . 'de' . ' ' . $mes3 . ' ' . 'de' . ' ' . $año2;
    return $fecha_texto;
};
