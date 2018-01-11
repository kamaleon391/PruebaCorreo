<?php

require "/var/www/external/services/mail/library/Mailin.php";
include "/var/www/external/services/mail/conexion.php";
include "/var/www/external/services/mail/querysTamaulipas.php";

$fecha = date("Y-m-d");

$mensaje = "<style>body{font-family: Century gothic;
font-size: 10px;}tr {
border-bottom: 1pt solid black;
}</style><table width='700px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;
'>
  <tr>
    <td width='3%'>&nbsp;</td>
    <td colspan='5'><img src='http://187.247.253.5/external/services/mail/tamaulipas/Logo.png'></td>
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
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>ING. EGIDIO TORRE CANTU</td>";
    

if (numberNotes(5, $fecha)) {
    $mensaje .= "<td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=" . base64_encode(base64_encode('5')) . "&f=$fecha'>REPORTE</a></td>";
} else {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
}

$mensaje .= "<td width='15%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td width='13%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>ADMINISTRACION ESTATAL</td>";

if (numberNotes(6, $fecha)) {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=" . base64_encode(base64_encode('6')) . "&f=$fecha'>REPORTE</a></td>";
} else {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
}

$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
    <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>TAMAULIPAS</td>";

if (numberNotes(7, $fecha)) {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=" . base64_encode(base64_encode('7')) . "&f=$fecha'>Parte 1</a></td>";
} else {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
}

if (numberNotes(8, $fecha)) {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=" . base64_encode(base64_encode('8')) . "&f=$fecha'>Parte 2</td>";
} else {
    $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
}


$mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >Primeras Planas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=" . base64_encode(base64_encode('1')) . "&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >Columnas Financieras</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=" . base64_encode(base64_encode('3')) . "&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >Columnas Politícas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=" . base64_encode(base64_encode('2')) . "&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >Cartones</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=" . base64_encode(base64_encode('4')) . "&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
  </tr>
  <tr>
  <td colspan='7' style='text-align: right;'><span style='text-align: right;
font-size: 8px;
color: rgb(139, 139, 139);'>Grupo Arte y Comunicación &COPY; " . DATE('Y') . "</span></td>
</td>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://187.247.253.5/siscap.la/public/boards/tamaulipas'>Sistema de Información</a></div>
";

try{

$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'n1tZHY3G4fPTgqma');

/** TEST AREA **/

$data = array(
    "to" => array("mariob@gacomunicacion.com" => "mariob@gacomunicacion.com"),
    "cc" => array("emfrigo@hotmail.com" => "CC Emmanuel", "vazquezoliver@gmail.com" => "CC Oliver"),
    //"bcc" => array("vazquezoliver@gmail.com" => "BCC Oliver","badillo.oma@outlook.com" => "badillo.oma@outlook.com"),
    "from" => array("gaimpresos@gacomunicacion", "MONITOREO DE PRENSA - PDF"),
    "subject" => "TAMAULIPAS " . mostrar_fecha_completa(date("Y-m-d")),
    "html" => $mensaje,
    "attachment" => array("http://187.247.253.5/snCreator/public/api/create_pdf/07:00:00/2016-01-19/340/1"),
    "headers" => array("Content-Type"=> "Content-type:text/html; charset=UTF-8")
);

$response = $mailin->send_email($data);

echo ($response["message"]);
}catch( Exception $e ){

	echo($e->getMessage());	

}
//enviaReporte($mensaje);
//echo $mensaje;

function enviaReporte($mensaje)
{
    require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";

    $mail = new PHPMailer();
    $mail->IsSMTP();

/********************  CODIGO COMENTADO POR ABUSO DE ENVIOS GA  **********************
$mail->Host     = "smtp.gacomunicacion.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "Gagdl1";
 ********************************************************************************************/

    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "tls"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 587; // set the SMTP port for the GMAIL server
    $mail->Username = "gaimpresos@gmail.com"; // GMAIL username
    $mail->Password = "Gacomunicacion#@2014";

//$mail->addAddress('edgarh@gacomunicacion.com', 'Edgar Oswaldo Hernánde Barajas');
    //$mail->addAddress('d3v1an.tux@gmail.com', 'Ricardo Madrigal Rodriguez (Sauron)');
    //$mail->addAddress('mariob@gacomunicacion.com', 'Mario Alberto Badillo (Hobbit)');

//CLIENTE
    $mail->AddBCC("mariob@gacomunicacion.com");

    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "MONITOREO DE PRENSA - SB";

    $mail->Subject = "TAMAULIPAS " . mostrar_fecha_completa(date("Y-m-d"));
    $mail->WordWrap = 50;

// Correo destino

    $mail->IsHTML(true);

    $mail->Body = $mensaje;

    if (!$mail->Send()) {
        echo "Error: " . $mail->ErrorInfo;
    } else {
        echo "Mensaje enviado";
    }
    //
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
