<?php

require "/var/www/external/services/mail/library/Mailin.php";
require '/var/www/external/services/mail/conexion.php';
include "querysCONADIC.php";

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
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>CDMX</b></td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Manuel Mondragón y Kalb</td>";

    if(numberNotes(5, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('5')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>CONADIC</td>";

    if(numberNotes(6, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('6')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Marihuana</td>";

    if(numberNotes(7, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('7')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Tabaco</td>";

    if(numberNotes(8, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('8')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Alcohol</td>";

    if(numberNotes(9, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('9')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Drogas y Adicciones</td>";

    if(numberNotes(10, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('10')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Secretaría de Salud</td>";

    if(numberNotes(11, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('11')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Mercedes Juan López</td>";

    if(numberNotes(12, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('12')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>COFEPRIS</td>";

    if(numberNotes(13, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('13')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Centros de Integración Juvenil</td>";

    if(numberNotes(14, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('14')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Presidente EPN</td>";

    if(numberNotes(15, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('15')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Gobierno de la República</td>";

    if(numberNotes(16, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('16')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Cámara de Diputados</td>";

    if(numberNotes(17, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('17')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Cámara de Senadores</td>";

    if(numberNotes(18, $fecha))
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=" . base64_encode(base64_encode('18')) . "&f=$fecha'>REPORTE</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Primeras Planas CDMX</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Columnas Politicas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Columnas Financieras</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Cartones CDMX</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/conadic/exportCONADIC.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/conadic'>Sistema de Información</a></div>
";

sendinblue($mensaje);
//enviaReporte($mensaje);
//echo ( $mensaje);

function enviaReporte( $mensaje ) {
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
    
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
    $mail->Password   = "Gacomunicacion#@2014";   

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
    

    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "Monitoreo Impresos";

    $mail->Subject = utf8_decode("CONADIC - CDMX");
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

function sendinblue($message){

    /*
 * PREPARA EL OBJETO ENVIO
 */
    $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
    $data   = array(
        "to" => array(
  
            'jivermt@gmail.com' => 'jivermt@gmail.com',
            'rocioglezja@gmail.com' => 'rocioglezja@gmail.com',
            'ocruzj@gmail.com' => 'ocruzj@gmail.com',
            'comsoc.conadic@gmail.com' => 'comsoc.conadic@gmail.com'

        ),    
        "bcc" => array(
          /*
          --ga
            'gmocarmona@gacomunicacion.com' => 'gmocarmona@gacomunicacion.com',
            'fcocolina@gacomunicacion.com' => 'fcocolina@gacomunicacion.com',
            'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com',
            'rubend@gacomunicacion.com' => 'rubend@gacomunicacion.com',
            'edgarh@gacomunicacion.com' => 'edgarh@gacomunicacion.com',
            'jlga@gacomunicacion.com' => 'jlga@gacomunicacion.com',
            'alezama@gacomunicacion.com' => 'alezama@gacomunicacion.com',
            'mariob@gacomunicacion.com' => 'mariob@gacomunicacion.com',
            
            --clientes
            */
            'ehb1703@icloud.com' => 'ehb1703@icloud.com',
            'sintesisga@gmail.com'=>'sintesisga@gmail.com' 
        ),
        "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
        "subject" => "CONADIC - CDMX",
        "html" => $message,
        "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-Conadic-CDMX")
    );

    /*
     * ENVIANDO EMAIL...
     */
    var_dump($mailin->send_email($data));
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
