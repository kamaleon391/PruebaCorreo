<?php
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
<table width='900px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td width='3%'>&nbsp;</td>
    <td colspan='4'><img src='http://187.247.253.5/external/services/mail/profeco/logo.png' width='270'></td>
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
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PROFECO</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Procurador</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Delegaciones</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>SEMARNAT</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Varios</b></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >DF</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >
    <a href='http://187.247.253.5/external/services/mail/profeco/exportProfeco.php?p=".'5'."&f=$fecha&e=9'>REPORTE</a>
    </td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/profeco/exportProfeco.php?p=".'6'."&f=$fecha&e=9'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/profeco/exportProfeco.php?p=".'7'."&f=$fecha&e=9'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/profeco/exportProfeco.php?p=".'8'."&f=$fecha&e=9'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >
    <a href='http://187.247.253.5/external/services/mail/profeco/exportProfeco.php?p=".'9'."&f=$fecha&e=9'>REPORTE</a></td>

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
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://187.247.253.5/siscap.la/public/boards/profeco'>Sistema de ".utf8_decode('Información')."</a></div>
";
//enviaReporte($mensaje);
echo ( $mensaje);


function enviaReporte($mensaje){


require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";

$mail = new PHPMailer();
$mail->IsSMTP();

/*
$mail->Host     = "pro.turbo-smtp.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;

$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "VBHYxToX";
*/

$mail->Host     = "smtp.gacomunicacion.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;

$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "Gagdl1";

/*
$mail->addAddress('edgarh@gacomunicacion.com', 'Edgar Oswaldo Hernánde Barajas');
$mail->addAddress('ehb1703@icloud.com', 'Edgar Oswaldo Hernánde Barajas');
$mail->addAddress('d3v1an.tux@gmail.com', 'Ricardo Madrigal Rodriguez (Sauron)');
$mail->addAddress('mariob@gacomunicacion.com', 'Mario Alberto Badillo (Hobbit)');
*/

////Ga Guadalajara
$mail->AddBCC("edgarh@gacomunicacion.com");
$mail->AddBCC('ehb1703@icloud.com');
$mail->AddBCC("mariob@gacomunicacion.com");

//$mail->AddBCC("sintesis.stps06@gmail.com");

$mail->From = 'gaimpresos@gacomunicacion.com';
$mail->FromName = "Monitoreo Impresos";

$mail->Subject  = "PROFEPA - DF";
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
