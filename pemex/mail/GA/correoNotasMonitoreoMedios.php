<?php

//require '/var/www/external/services/mail/conexion.php';

include 'MailSummary.php';


$Resumen = new MailSummary();

$Resumen->start_message();

$actor = 'Monitoreo de Medios';
$criteria = "(
    Texto   like '%Monitoreo de Medios%' OR
    Texto   like '%Monitoreo de uso de tiempos oficiales%' OR
    Texto   like '%Monitoreo de tiempos oficiales%' OR
    
    Titulo  like '%Monitoreo de Medios%' OR
    Titulo  like '%Monitoreo de uso de tiempos oficiales%' OR
    Titulo  like '%Monitoreo de tiempos oficiales%' OR

    Encabezado  like '%Monitoreo de Medios%' OR
    Encabezado  like '%Monitoreo de uso de tiempos oficiales%' OR
    Encabezado  like '%Monitoreo de tiempos oficiales%' OR

    Autor like '%Monitoreo de Medios%' OR
    Autor like '%Monitoreo de uso de tiempos oficiales%' OR
    Autor like '%Monitoreo de tiempos oficiales%' OR
    
    PieFoto like '%Monitoreo de Medios%' OR
    PieFoto like '%Monitoreo de uso de tiempos oficiales%' OR
    PieFoto like '%Monitoreo de tiempos oficiales%'
    )";
$keywords = ['Monitoreo de Medios','Monitoreo de uso de tiempos oficiales','Monitoreo de tiempos oficiales'];

$Resumen->get_and_append_notes($actor, $criteria, $keywords);

$actor = 'Grupo Arte y Comunicacion';
$criteria = "(
    Texto   like '%Grupo Arte y Comunicacion%' OR
    Texto   like '%Jose Luis Gutierrez Anaya%' OR
    
    Titulo  like '%Grupo Arte y Comunicacion%' OR
    Titulo  like '%Jose Luis Gutierrez Anaya%' OR

    Encabezado  like '%Grupo Arte y Comunicacion%' OR
    Encabezado  like '%Jose Luis Gutierrez Anaya%' OR

    Autor like '%Grupo Arte y Comunicacion%' OR
    Autor like '%Jose Luis Gutierrez Anaya%' OR
    
    PieFoto like '%Grupo Arte y Comunicacion%' OR
    PieFoto like '%Jose Luis Gutierrez Anaya%' 
    )";
$keywords = ['Grupo Arte y Comunicacion','Jose Luis Gutierrez Anaya','Grupo Arte y Comunicación','José Luis Gutiérrez'];

$Resumen->get_and_append_notes($actor, $criteria, $keywords);

$actor = 'Especialistas en Medios';
$criteria = "(
    Texto   like '%Especialistas en Medios%' OR
    Texto   like '%Olga Mireles%' OR
    
    Titulo  like '%Especialistas en Medios%' OR
    Titulo  like '%Olga Mireles%' OR

    Encabezado  like '%Especialistas en Medios%' OR
    Encabezado  like '%Olga Mireles%' OR

    Autor like '%Especialistas en Medios%' OR
    Autor like '%Olga Mireles%' OR
    
    PieFoto like '%Especialistas en Medios%' OR
    PieFoto like '%Olga Mireles%' 
    )";
$keywords = ['Especialistas en Medios','Olga Mireles'];

$Resumen->get_and_append_notes($actor, $criteria, $keywords);

$actor = 'Antena Informativa';
$criteria = "(
    Texto   like '%Antena Informativa%' OR
    Texto   like '%Emilio Otero%' OR
    
    Titulo  like '%Antena Informativa%' OR
    Titulo  like '%Emilio Otero%' OR

    Encabezado  like '%Antena Informativa%' OR
    Encabezado  like '%Emilio Otero%' OR

    Autor like '%Antena Informativa%' OR
    Autor like '%Emilio Otero%' OR
    
    PieFoto like '%Antena Informativa%' OR
    PieFoto like '%Emilio Otero%' 
    )";
$keywords = ['Antena Informativa','Emilio Otero'];

$Resumen->get_and_append_notes($actor, $criteria, $keywords);

$actor = 'Varios';
$criteria = "(
    Texto   like '%SVC Internacional%' OR
    Texto   like '%EMedia Monitor%' OR
    
    Titulo  like '%SVC Internacional%' OR
    Titulo  like '%EMedia Monitor%' OR

    Encabezado  like '%SVC Internacional%' OR
    Encabezado  like '%EMedia Monitor%' OR

    Autor like '%SVC Internacional%' OR
    Autor like '%EMedia Monitor%' OR
    
    PieFoto like '%SVC Internacional%' OR
    PieFoto like '%EMedia Monitor%' 
    )";
$keywords = ['SVC Internacional','EMedia Monitor'];

$Resumen->get_and_append_notes($actor, $criteria, $keywords);

$actor = 'COFECE';
$criteria = "(
    Texto   like '%COFECE%' OR
    Texto   like '%Comision Federal de Competencia Economica%' OR
    
    Titulo  like '%COFECE%' OR
    Titulo  like '%Comision Federal de Competencia Economica%' OR

    Encabezado  like '%COFECE%' OR
    Encabezado  like '%Comision Federal de Competencia Economica%' OR

    Autor like '%COFECE%' OR
    Autor like '%Comision Federal de Competencia Economica%' OR
    
    PieFoto like '%COFECE%' OR
    PieFoto like '%Comision Federal de Competencia Economica%' 
    )";
$keywords = ['COFECE','Cofece','Comision Federal de Competencia Economica','Comisión Federal de Competencia'];

$Resumen->get_and_append_notes($actor, $criteria, $keywords);

$Resumen->close_message();

enviaReporte($Resumen->message);     
//echo $Resumen->message;

function enviaReporte($mensaje){
  require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";  
  $mail = new PHPMailer();
  $mail->IsSMTP();

/****************************************************************************
  $mail->Host     = "smtp.gacomunicacion.com";
  $mail->Port     = 587;
  $mail->SMTPAuth = true;
  $mail->Username = "prensa2@gacomunicacion.com";
  $mail->Password = "Periodico456";
****************************************************************************/
  
  
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
  $mail->Password   = "Gacomunicacion#@2014";   

  $mail->addAddress("jlga@gacomunicacion.com");
  $mail->AddCC("fcocolina@gacomunicacion.com");
  $mail->AddCC("gmocarmona@gacomunicacion.com");
  $mail->AddCC("oortiz@gacomunicacion.com");
  $mail->AddCC("rubend@gacomunicacion.com");
  $mail->AddCC("paulina@gacomunicacion.com");
  $mail->AddCC("alezama@gacomunicacion.com");
  $mail->AddCC("ricb@gacomunicacion.com");
  $mail->AddCC("creyes@gacomunicacion.com");
  $mail->AddCC("rubendiazramirez@gmail.com");
  $mail->AddCC("carloshreyes@gmail.com");
  $mail->AddCC("ehb1703@icloud.com");
  $mail->AddCC("luisenriquerh@gmail.com");
  $mail->AddCC("edgarh@gacomunicacion.com");

  $mail->AddBCC("mariob@gacomunicacion.com");
  $mail->AddBCC("vazquezoliver@gmail.com");

$mail->From = 'gaimpresos@gacomunicacion.com';
$mail->FromName = "Monitoreo Impresos ";
 
$mail->Subject  = "MONITOREO DE MEDIOS - Resumen";
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


function fecha_completa($fecha)
{
    $subfecha=explode("-",$fecha); 
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
         $dia_sem3='Miércoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='Sábado'; 
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
}
