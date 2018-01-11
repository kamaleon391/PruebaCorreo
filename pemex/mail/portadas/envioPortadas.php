<?php
require "/var/www/external/services/mail/library/Mailin.php";


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
    <td colspan='8' style='background-color: rgb(252, 252, 252);' align='center'><img id='logoC' src='http://187.247.253.5/external/services/mail/saluddf/logoGA2.png'  ></td>
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
    <td colspan='5'><a href='http://187.247.253.5/external/services/mail/portadas/listaTestigos.php'>Portadas CDMX</a></td>
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
//echo $mensaje;
function correo( $mensaje ) {
	require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;
	$mail->SMTPSecure = "tls";
	$mail->Host       = "smtp.gmail.com";
	$mail->Port       = 587;
	$mail->Username   = "gaimpresos@gmail.com";
	$mail->Password   = "Gacomunicacion2016";
	$mail->From = 'gaimpresos@gacomunicacion.com';
	$mail->FromName = " Monitoreo de Medio Impresos ";
	$mail->Subject  = " Portadas CDMX- ".Date('Y-m-d');
	//----------------------------------------------------------------
	$mail->AddBCC('ehb1703@gmail.com','ehb1703@gmail.com');
	$mail->AddBCC('segunda@emp.gob.mx','segunda@emp.gob.mx');
	$mail->AddBCC('enlace@emp.gob.mx','enlace@emp.gob.mx');
	$mail->AddBCC('marcorate3@gmail.com','marcorate3@gmail.com');
	$mail->AddBCC('jenniferemp26@gmail.com','jenniferemp26@gmail.com');
	$mail->AddBCC('medios.electronicos2@gmail.com','medios.electronicos2@gmail.com');
	/********************************************************************/
	/*****************************PGR*************************************/
	$mail->AddBCC('ivruelas@hotmail.com','ivruelas@hotmail.com');
	$mail->AddBCC('iruelas@gmail.com','iruelas@gmail.com');
	$mail->AddBCC('09jerryw@gmail.com','09jerryw@gmail.com');
	/********************************************************************/
	/***************************LICONSA*********************************/
	$mail->AddBCC('rmendoza@liconsa.gob.mx','rmendoza@liconsa.gob.mx');
	$mail->AddBCC('rmendozaabelar@yahoo.com.mx','rmendozaabelar@yahoo.com.mx');
	$mail->AddBCC('liconsacomunica@gmail.com','liconsacomunica@gmail.com');
	$mail->AddBCC('eleazarjim@yahoo.com.mx','eleazarjim@yahoo.com.mx');
	$mail->AddBCC('corporativoliconsa@hotmail.com','corporativoliconsa@hotmail.com');
	$mail->AddBCC('rmendozaabelar@yahoo.com.mx','rmendozaabelar@yahoo.com.mx');
	/********************************************************************/
	/***************************CONADIC*********************************/
	$mail->AddBCC('jivermt@gmail.com','jivermt@gmail.com');
	$mail->AddBCC('rocioglezja@gmail.com','rocioglezja@gmail.com');
	$mail->AddBCC('ocruzj@gmail.com','ocruzj@gmail.com');
	$mail->AddBCC('comsoc.conadic@gmail.com','comsoc.conadic@gmail.com');
	/********************************************************************/
	/***************************SNA*********************************/
	/*$mail->AddBCC('rpg65so@yahoo.com.mx','rpg65so@yahoo.com.mx');
	$mail->AddBCC('rsalgadop@sesna.org.mx','rsalgadop@sesna.org.mx');
	$mail->AddBCC('sgarciag@sesna.org.mx','sgarciag@sesna.org.mx');
	$mail->AddBCC('lherrera@sesna.org.mx','lherrera@sesna.org.mx');
	$mail->AddBCC('rperezg@sesna.org.mx','rperezg@sesna.org.mx');
	$mail->AddBCC('aramirezs@sesna.org.mx','aramirezs@sesna.org.mx');
	$mail->AddBCC('frrosales@sesna.org.mx','frrosales@sesna.org.mx');
	$mail->AddBCC('jbrojas@sesna.org.mx','jbrojas@sesna.org.mx');
	$mail->AddBCC('fcamacho@sesna.org.mx','fcamacho@sesna.org.mx');
	$mail->AddBCC('rmartinez@sesna.org.mx','rmartinez@sesna.org.mx');
	$mail->AddBCC('dantillon@sesna.org.mx','dantillon@sesna.org.mx');
	$mail->AddBCC('ncorona@sesna.org.mx','ncorona@sesna.org.mx');
	$mail->AddBCC('msalinas@sesna.org.mx','msalinas@sesna.org.mx');
	$mail->AddBCC('smiramontes@sesna.org.mx','smiramontes@sesna.org.mx');
	$mail->AddBCC('famartinez@sesna.org.mx','famartinez@sesna.org.mx');*/
	/********************************************************************/
	/**************************INMOBILIARIA*****************************/
	$mail->AddBCC('gfriasr@investiga.com.mx','gfriasr@investiga.com.mx');
	/********************************************************************/
	/****************************SONORA*******************************/
	$mail->AddBCC('rodrigomena7@hotmail.com','rodrigomena7@hotmail.com');
	/********************************************************************/
	/****************************CNS*******************************/
	$mail->AddBCC('macarrera.segob@gmail.com','macarrera.segob@gmail.com');
	$mail->AddBCC('monitoreocomisionado@gmail.com','monitoreocomisionado@gmail.com');
	$mail->AddBCC('joserriux@hotmail.com','joserriux@hotmail.com');
	$mail->AddBCC('taniaaguilardiaz@gmail.com','taniaaguilardiaz@gmail.com');
	$mail->AddBCC('alejandro.dominguezj@gmail.com','alejandro.dominguezj@gmail.com');
	$mail->AddBCC('mariana.2.2@hotmail.com','mariana.2.2@hotmail.com');
	/********************************************************************/
	$mail->AddBCC('sintesisga@gmail.com','sintesisga@gmail.com');
	//----------------------------------------------------------------

	$mail->IsHTML(TRUE);
	$mail->Body = $mensaje;
	$Portada="/var/www/external/testigos/portadas/portadas-".Date('Y-m-d').".pdf";
	if(file_exists( $Portada ))
	{
		$mail->AddAttachment( $Portada , "portadas-".DATE('Y-m-d').".pdf");
	}
	if(!$mail->Send())
		{echo "Error: " . $mail->ErrorInfo;}else{echo "Mensaje enviado";}
}

function sendinblue($mensaje){
  $Portada="http://187.247.253.5/external/testigos/portadas/portadas-".Date('Y-m-d').".pdf";
  $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
  $data = array(
    "to" => array(
      'impresos@info-gacomunicacion.com'=>'impresos@info-gacomunicacion.com'
      ),
    "bcc" => array(
      /*****************************EMP*************************************/
      'ehb1703@gmail.com'             =>    'ehb1703@gmail.com',
      'segunda@emp.gob.mx'            =>    'segunda@emp.gob.mx',
      'enlace@emp.gob.mx'             =>    'enlace@emp.gob.mx',
      'marcorate3@gmail.com'          =>    'marcorate3@gmail.com',
      'jenniferemp26@gmail.com'       =>    'jenniferemp26@gmail.com',
      'medios.electronicos2@gmail.com'=>    'medios.electronicos2@gmail.com',
      /********************************************************************/
      /*****************************PGR*************************************/
      'ivruelas@hotmail.com'          =>    'ivruelas@hotmail.com',
      'iruelas@gmail.com'             =>    'iruelas@gmail.com',
      '09jerryw@gmail.com'            =>    '09jerryw@gmail.com',
      /********************************************************************/
      /***************************LICONSA*********************************/
      'rmendoza@liconsa.gob.mx'       =>    'rmendoza@liconsa.gob.mx',
      'rmendozaabelar@yahoo.com.mx'   =>    'rmendozaabelar@yahoo.com.mx',
      'liconsacomunica@gmail.com'     =>    'liconsacomunica@gmail.com',
      'eleazarjim@yahoo.com.mx'       =>    'eleazarjim@yahoo.com.mx',
      'corporativoliconsa@hotmail.com'=>    'corporativoliconsa@hotmail.com',
      'rmendozaabelar@yahoo.com.mx'   =>    'rmendozaabelar@yahoo.com.mx',
      /********************************************************************/
      /***************************CONADIC*********************************/
      'jivermt@gmail.com'             =>    'jivermt@gmail.com',
      'rocioglezja@gmail.com'         =>    'rocioglezja@gmail.com',
      'ocruzj@gmail.com'              =>    'ocruzj@gmail.com',
      'comsoc.conadic@gmail.com'      =>    'comsoc.conadic@gmail.com',
      /********************************************************************/
      /***************************SNA*********************************/
      'rpg65so@yahoo.com.mx'          =>    'rpg65so@yahoo.com.mx',
      'rsalgadop@sesna.org.mx'        =>    'rsalgadop@sesna.org.mx',
      'sgarciag@sesna.org.mx'         =>    'sgarciag@sesna.org.mx',
      'lherrera@sesna.org.mx'         =>    'lherrera@sesna.org.mx',
      'rperezg@sesna.org.mx'          =>    'rperezg@sesna.org.mx',
      'aramirezs@sesna.org.mx'        =>    'aramirezs@sesna.org.mx',
      'frrosales@sesna.org.mx'        =>    'frrosales@sesna.org.mx',
      'jbrojas@sesna.org.mx'          =>    'jbrojas@sesna.org.mx',
      'fcamacho@sesna.org.mx'         =>    'fcamacho@sesna.org.mx',
      'rmartinez@sesna.org.mx'        =>    'rmartinez@sesna.org.mx',
      /********************************************************************/
      /**************************INMOBILIARIA*****************************/
      'gfriasr@investiga.com.mx'      =>    'gfriasr@investiga.com.mx',
      /********************************************************************/
      /****************************SONORA*******************************/
      'rodrigomena7@hotmail.com'      =>    'rodrigomena7@hotmail.com',
      /********************************************************************/
      /****************************CNS*******************************/
      'macarrera.segob@gmail.com'     =>    'macarrera.segob@gmail.com',
      'monitoreocomisionado@gmail.com'=>    'monitoreocomisionado@gmail.com',
      'joserriux@hotmail.com'         =>    'joserriux@hotmail.com',
      'taniaaguilardiaz@gmail.com'    =>    'taniaaguilardiaz@gmail.com',
      'alejandro.dominguezj@gmail.com'=>    'alejandro.dominguezj@gmail.com',
      'mariana.2.2@hotmail.com'       =>    'mariana.2.2@hotmail.com',
      /********************************************************************/
      'sintesisga@gmail.com'=>'sintesisga@gmail.com' ,
      'ncorona@sesna.org.mx' => 'ncorona@sesna.org.mx',
      'msalinas@sesna.org.mx' => 'msalinas@sesna.org.mx'
      ),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
    "subject" => "Portadas CDMX - Ga Comunicacion",
    "html" => $mensaje,
    "attachment" => array($Portada),
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-PORTADAS-CDMX")
  );
  var_dump($mailin->send_email($data));
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
