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
<table width='80%' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <th colspan='3' align='left'><img src='http://187.247.253.5/external/services/mail/chavarizo/chavaRizo.png'></th>
    <th width='2%'>&nbsp;</th>
  </tr>
 <tr>
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
</tr>
    <tr>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);'></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>Testigos</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PDF</b></td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>WORD</b></td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".  utf8_decode('Salvador Rizo Castelo')."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/ResumenPDF.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>&nbsp;</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".  utf8_decode('Pablo Lemus Navarro')."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/ResumenPDF.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('6'))."&f=$fecha'>&nbsp;</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".  utf8_decode('Guillermo Martínez Mora')."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('7'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/ResumenPDF.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('9'))."&f=$fecha'>&nbsp;</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".  utf8_decode('Zapopan')."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('10'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/ResumenPDF.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('12'))."&f=$fecha'>&nbsp;</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".  utf8_decode('Jalisco')."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('13'))."&f=$fecha'>Primeras Planas</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('14'))."&f=$fecha'>".  utf8_decode('Columnas')."</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('15'))."&f=$fecha'></a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>".  utf8_decode('Nacionales')."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('16'))."&f=$fecha'>Primeras Planas</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('17'))."&f=$fecha'>".  utf8_decode('Políticas')."</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/chavarizo/exportRizo.php?p=".base64_encode(base64_encode('18'))."&f=$fecha'>Financieras</a></td>
  </tr>
</table>";
enviaReporte($mensaje);
//echo ($mensaje);     


function enviaReporte($mensaje)
{
    require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";  

    $mail = new PHPMailer();
    $mail->IsSMTP();


    $mail->Host     = "pro.turbo-smtp.com";
    $mail->Port     = 587;
    $mail->SMTPAuth = true;
 
    $mail->Username = "gaimpresos@gacomunicacion.com";
    $mail->Password = "VBHYxToX";

/*
$mail->Host     = "smtp.gacomunicacion.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "Gagdl1";


$mail->addAddress('edgarh@gacomunicacion.com', 'Edgar Oswaldo Hernánde Barajas');
$mail->addAddress('ehb1703@icloud.com', 'Edgar Oswaldo Hernánde Barajas');
$mail->addAddress('ricardom@gacomunicacion.com', 'Ricardo Madrigal Rodriguez (Sauron)');
$mail->addAddress('mariob@gacomunicacion.com', 'Mario Alberto Badillo (Hobbit)');
*/
/*
    //CLIENTE
    $mail->AddCC('laura_murillo@hotmail.com');
    $mail->AddCC('lauramurillozuniga@gmail.com');
    $mail->AddCC('oscarsamuel.h@gmail.com');
    //CLIENTE
*/

    //$mail->AddCC('rubend@gacomunicacion.com');
    $mail->AddBCC('edgarh@gacomunicacion.com');
    $mail->AddBCC('mariob@gacomunicacion.com');
    //$mail->AddBCC('jesush@gacomunicacion.com');


    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "Monitoreo Impresos";
 
    $mail->Subject  = utf8_decode("Salvador Rizo Castelo");
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
