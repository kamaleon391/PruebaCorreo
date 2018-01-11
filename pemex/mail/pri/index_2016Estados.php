<?php
require '../conexion.php';
include "querysCONADIC.php";
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
    16 => 'Michoacan',
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

$mensaje1 = "
<meta content='text/html; charset=utf-8' http-equiv=Content-Type>
<style>
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
    <td colspan='3'><img src='http://187.247.253.5/external/services/mail/conadic/logoGA2.png'></td>
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
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>ESTADOS</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Manuel Mondragón</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>CONADIC</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Marihuana</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Tabaco</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Alcohol</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Drogas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>";

$mensaje2 = "";

foreach ($estados as $key => $value) {
    if ($key != 9) {

        $mensaje2 .= "
      <tr>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>" . $value . "</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>";
        for ($i = 0, $topic = 19; $i < 6; $i++, $topic++) {
            $query = query($topic, $fecha, $key);
            $resultado = mysql_query($query);
            if(mysql_num_rows($resultado) > 0)
            {
                $mensaje2 .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230); text-align: center;'><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode($topic)) . "&f=" . $fecha . "&estado=" . $key . "'>Link</a></td>
                              <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";    
            }
            else
            {
                $mensaje2 .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
            }

        }
        $mensaje2 .= "</tr>";
    }
}
$mensaje2 .= "
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/conadic'>Sistema de Información</a></div>
";
//enviaReporte($mensaje1 . $mensaje2);
echo ( $mensaje1 . $mensaje2 );

function enviaReporte($mensaje)
{
    require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";

    $mail = new PHPMailer();
    $mail->IsSMTP();

/*
$mail->Host     = "smtp.gacomunicacion.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
$mail->Username = "prensa1@gacomunicacion.com";
$mail->Password = "Periodico321";
 */

    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "tls"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 587; // set the SMTP port for the GMAIL server
    $mail->Username = "gaimpresos@gmail.com"; // GMAIL username
    $mail->Password = "Gacomunicacion#@2014";

/*
    $mail->addAddress('jivermt@gmail.com');
    $mail->addAddress('rocioglezja@gmail.com');
    $mail->addAddress('ocruzj@gmail.com');
    $mail->addAddress('comsoc.conadic@gmail.com');

    $mail->AddBCC("gmocarmona@gacomunicacion.com");
    $mail->AddBCC("fcocolina@gacomunicacion.com");
    $mail->AddBCC("oortiz@gacomunicacion.com");
    $mail->AddBCC("rubend@gacomunicacion.com");
    $mail->AddBCC("edgarh@gacomunicacion.com");
    $mail->AddBCC('ehb1703@icloud.com', 'Edgar Oswaldo Hernánde Barajas');
    $mail->AddBCC('jlga@gacomunicacion.com');
    $mail->AddBCC('alezama@gacomunicacion.com');

    //$mail->AddBCC('emfrigo@hotmail.com');
    //$mail->AddBCC('vazquezoliver@gmail.com');
    $mail->AddBCC('mariob@gacomunicacion.com');
*/
    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "Monitoreo Impresos";

    $mail->Subject = utf8_decode("CONADIC - Estados");
    $mail->WordWrap = 50;

// Correo destino

    $mail->IsHTML(true);

    $mail->Body = $mensaje;

    $mail->CharSet = 'UTF-8';

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
