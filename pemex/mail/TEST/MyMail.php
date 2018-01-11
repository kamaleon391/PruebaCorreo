<?php

require_once( '/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php' );

class MyMail{

	private $Host     = "smtp.gacomunicacion.com";
	private $Port     = 587;
	private $SMTPAuth = true;
	private $Username = "prensa1@gacomunicacion.com";
	private $Password = "Periodico321";
 	
 	public  $mail = null;

 	public function __construct(){

 		$this->mail = new PHPMailer();
 		$this->mail->IsSMTP(); // SI, YA SE QUE ES ANTI PATTERN !!!

 	}

 	public function applyConfigurations( Array $configs ){

    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
    $mail->Password   = "Gacomunicacion#@2014";   
 		
 	}

}

/*

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
/*    
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
    
    $mail->AddBCC('mariob@gacomunicacion.com');
    //$mail->AddBCC('emfrigo@hotmail.com');
    //$mail->AddBCC('vazquezoliver@gmail.com');

    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "Monitoreo Impresos";

    $mail->Subject = utf8_decode("CONADIC - DF");
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


*/