<?php
$mensaje="<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'><style type='text/css'>
a:link { color: rgb(33, 194, 65);
margin-left: 36px;
font-size: 13px; font-weight: bold;}
.especial:link { color: green; font-weight: bold;}
#logoC{
background-repeat: no-repeat;
border: white solid thin;
}
#logoC [alt]{
    font-family: Verdana, 'Lucida Grande';
    color: blue;
    font-size: 16px;
}
</style>
<table width= '500px;' border='0' cellspacing='0' style='border: #CCC solid;font-family: century gothic;font-size: 15px;-moz-border-radius: 7px;-webkit-border-radius: 7px;border-radius: 7px;' align='center' >
  <tr>
    <td colspan='8' style='background-color: rgb(252, 252, 252);' align='center'><img id='logoC' src='http://187.247.253.5/external/services/mail/jalisco/logoGA2.png'  ></td>
  </tr>
  <tr>
    <td colspan='8' align='center'><span style='font-weight: bold; font-size: 20px;'>MONITOREO DE PRENSA</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan='2'><span style='font-weight: bold;'>ACCESO A INFORMACION:</span></td>
     <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr></tr>
  <tr>
    <td>&nbsp;</td>
    <td>Testigos</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan='5'><a href='http://187.247.253.5/external/services/mail/jalisco/chapo/listaTestigosChapo.php'>REPORTE JOAQUÍN 'EL CHAPO' GUZMÁN</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor='#CCCCCC'>
    <td>&nbsp;</td>
    <td colspan='2'>&nbsp;</td>
    <td colspan='6'> ".mostrar_fecha_completa(Date('Y-m-d'))."</td>
  </tr>
</table>";

correo($mensaje);

function correo( $mensaje ) {
  require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";  
  $mail = new PHPMailer();
  $mail->IsSMTP();
/*
  $mail->Host     = "smtp.gacomunicacion.com";
  $mail->Port     = 587;
  $mail->SMTPAuth = true;
  $mail->Username = "prensa@gacomunicacion.com";
  $mail->Password = "periodico123";
*/  
  
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
  $mail->Password   = "Gacomunicacion2016";   

    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = " Monitoreo de Medio Impresos ";
    $mail->Subject  = " Reporte Chapo Guzmán - ".Date('Y-m-d');

    //----------------------------------------------------------------
    
    $mail->AddBCC("mariohuesogobierno@gmail.com");
    $mail->AddBCC("oscarsamuel.h@gmail.com");
    $mail->AddBCC("gonzalo.gdl@gmail.com");
    $mail->AddBCC("lamasalberto@hotmail.com");
    $mail->AddBCC("rubend@gacomunicacion.com");
    $mail->AddBCC('ehb1703@icloud.com', 'Edgar Oswaldo Hernánde Barajas');
    
    //----------------------------------------------------------------
        
    $mail->IsHTML(TRUE);
    $mail->Body = $mensaje;

    #PDF DE AYOTZINAPA

    $chapoReporte = "/var/www/external/testigos/Jalisco/ChapoGuzman/Reporte Chapo Guzman - ".DATE('Y-m-d').".pdf";

    if(file_exists( $chapoReporte ))
    {
      $mail->AddAttachment( $chapoReporte , "Reporte Chapo Guzman - ".DATE('Y-m-d').".pdf");
    } 

    if(!$mail->Send())
    {echo "Error: " . $mail->ErrorInfo;}else{echo "Mensaje enviado";}
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
