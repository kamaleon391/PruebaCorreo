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
    <td colspan='8' style='background-color: rgb(252, 252, 252);' align='center'><img id='logoC' src='http://187.247.253.5/external/services/mail/jalisco/Logo.jpg'  ></td>
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
    <td>Testigos Jalisco</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  

  
  <tr>
    <td>&nbsp;</td>
    <td colspan='5'><a href='http://187.247.253.5/external/testigos/Jalisco/gira_asia.php'>REPORTE GIRA POR ASIA</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr bgcolor='#CCCCCC'>
    <td>&nbsp;</td>
    <td colspan='2'>&nbsp;</td>
    <td colspan='6'> ".mostrar_fecha_completa(Date('Y-m-d'))."</td>
  </tr>
</table>";

//echo $mensaje;
//correo($mensaje);

function correo($mensaje)
{
    require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";  
/*
$mail = new PHPMailer();
$mail->IsSMTP();


$mail->Host     = "pro.turbo-smtp.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "VBHYxToX";
*/
$mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host     = "pro.turbo-smtp.com";
    $mail->Port     = 587;
    $mail->SMTPAuth = true;
    $mail->CharSet = 'UTF-8';

    $mail->Username = "gaimpresos@gacomunicacion.com";
    $mail->Password = "VBHYxToX";


            $mail->From = 'gaimpresos@gacomunicacion.com';
            $mail->FromName = " Monitoreo de Medio Impresos ";
            $mail->Subject  = " Reporte Ayotzinapa ".Date('Y-m-d');
     
            //----------------------------------------------------------------
            $mail->addAddress("oscarsamuel.h@gmail.com");// Mes
            //$mail->AddBCC("monitoreojal2013@gmail.com");// Mes
            //$mail->AddBCC("monitoreojal@gmail.com");//Dia 
            
            $mail->AddBCC("mariob@gacomunicacion.com");
            //$mail->AddBCC("ehb1703@icloud.com");
            $mail->AddBCC("edgarh@gacomunicacion.com");
            //$mail->AddBCC("jesush@gacomunicacion.com");
            //$mail->AddBCC("validacion_Gacomunicacion@hotmail.com");
            //----------------------------------------------------------------
                

            $mail->IsHTML(TRUE);
            $mail->Body = $mensaje;

            /*
            #PDFS DE GIRA POR ASIA
            $gira_DF = "/var/www/external/testigos/Jalisco/gira/df/".DATE('Y-m-d')."_jalisco_gira.pdf";

            if(file_exists( $gira_DF )) $mail->AddAttachment( $gira_DF , DATE('Y-m-d').'_gira_asia_df.pdf');

            $gira_Jal = "/var/www/external/testigos/Jalisco/gira/jalisco/".DATE('Y-m-d')."_jalisco_gira.pdf";

            if(file_exists( $gira_Jal )) $mail->AddAttachment( $gira_Jal , DATE('Y-m-d').'_gira_asia_jalisco.pdf' );
            */

            #PDF DE AYOTZINAPA
/*
            $ayo_DF = "/var/www/external/testigos/Jalisco/Ayotzinapa/df/".DATE('Y-m-d')."_DF.pdf";

            if(file_exists( $ayo_DF )) $mail->AddAttachment( $ayo_DF , DATE('Y-m-d').'_ayotzinapa_df.pdf');


            $ayo_Jal = "/var/www/external/testigos/Jalisco/Ayotzinapa/jalisco/".DATE('Y-m-d')."_Jalisco.pdf";

            if(file_exists( $ayo_Jal )) $mail->AddAttachment( $ayo_Jal , DATE('Y-m-d').'_Jalisco.pdf');
                   */    

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
