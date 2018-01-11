<?php 
//correo();
//echo($mensaje);     

function correo(){
   
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
*/
// $mail->addAddress('edgarh@gacomunicacion.com', 'Edgar Oswaldo Hernánde Barajas');
// $mail->addAddress('ricardom@gacomunicacion.com', 'Ricardo Madrigal Rodriguez (Sauron)');
// $mail->addAddress('mariob@gacomunicacion.com', 'Mario Alberto Badillo (Hobbit)');

//GA
$mail->AddBCC("gmocarmona@gacomunicacion.com");
$mail->AddBCC("fcocolina@gacomunicacion.com");
$mail->AddBCC("jlga@gacomunicacion.com");
$mail->AddBCC("oortiz@gacomunicacion.com");
$mail->AddBCC("alezama@gacomunicacion.com");
//Ga Guadalajara
$mail->AddBCC("rubend@gacomunicacion.com");
$mail->AddBCC("edgarh@gacomunicacion.com");
$mail->AddBCC("ehb1703@icloud.com");
$mail->AddBCC("ehb1703@gmail.com");
$mail->AddBCC("gaimpresos@gmail.com");
$mail->AddBCC("jesush@gacomunicacion.com");
$mail->AddBCC("ricardom@gacomunicacion.com");
$mail->AddBCC("mariob@gacomunicacion.com");

//CLIENTES
$mail->AddBCC("eferiaortiz@yahoo.com");
$mail->AddBCC("rocio.sanchez@sct.gob.mx");
$mail->AddBCC("rociosanchezlagunes@yahoo.com.mx");//
$mail->AddBCC("santiagoab2012@gmail.com");
$mail->AddBCC("sintesis.sct01@gmail.com");

  $mail->From = 'gaimpresos@gacomunicacion.com';
  $mail->FromName = "MONITOREO DE PRENSA ".date("Y-m-d");
     
  $mail->WordWrap = 50;
  $mail->IsHTML(TRUE);

  if(date("H:i:s")<"04:35:00")
  {
    $mail->Subject  = "Avance SCT ".date("H:i:s");
    $mail->Body = "<a href='http://187.247.253.5/external/services/mail/sct/Avance.docx'><img src='http://187.247.253.5/external/services/mail/sct/docx.jpg' width='100' height='100'><br><br><b>Avance SCT</b></a>";
  }
  else if((date("H:i:s")<"05:35:00")&&(date("H:i:s")>"04:35:00"))
  {
    $mail->Subject  = "Complemento 1 SCT ".date("H:i:s");
    $mail->Body = "<a href='http://187.247.253.5/external/services/mail/sct/Complemento_1.docx'><img src='http://187.247.253.5/external/services/mail/sct/docx.jpg' width='100' height='100'><br><br><b>Complemento 1 SCT</b></a>";
  }
  else if((date("H:i:s")<"05:50:00")&&(date("H:i:s")>"05:35:00"))
  {
    $mail->Subject  = "Complemento 2 SCT ".date("H:i:s");
    $mail->Body = "<a href='http://187.247.253.5/external/services/mail/sct/Complemento_2.docx'><img src='http://187.247.253.5/external/services/mail/sct/docx.jpg' width='100' height='100'><br><br><b>Complemento 2 SCT</b></a>";
  }
  else
  {
    $mail->Subject  = "Final SCT ".date("H:i:s");
    $mail->Body = "<a href='http://187.247.253.5/external/services/mail/sct/Final.docx'><img src='http://187.247.253.5/external/services/mail/sct/docx.jpg' width='100' height='100'><br><br><b>Final SCT</b></a>";
  }


  if(!$mail->Send()) {
      echo "Error: " . $mail->ErrorInfo;
  } else {
      echo "Mensaje enviado";
  }
}
?>