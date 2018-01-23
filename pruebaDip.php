<?php

  require "/var/www/external/services/mail/library/Mailin.php";
  require '/var/www/external/services/mail/conexion.php';

  sendinblue($mensaje);
  function sendinblue($message){

      $subject="MONITOREO RVL ".fecha_completa(date("Y-m-d"));
      $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
      $data   = array(
          "to" => array(
                'kamaleon391@gmail.com' => 'Prueba Correo',
          ),
          "bcc" => array(
              "ehb1703@gmail.com" => "Edgar Hernandez",
          ),
          "from" => array("gaimpresos@gmail.com", "Ga Comunicacion"),
          "subject" =>$subject,
          "html" => $message,
          "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-PEMEX-ESTADOS")
      );

      /*
       * ENVIANDO EMAIL...
       */
      var_dump($mailin->send_email($data));
  }










  function correo($mensaje)
  {
      require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";


      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->Host     = "pro.turbo-smtp.com";
      $mail->Port     = 587;
      $mail->SMTPAuth = true;
      $mail->CharSet = 'UTF-8';

      $mail->Username = "gaimpresos@gacomunicacion.com";
      $mail->Password = "VBHYxToX";

      //$mail->AddBCC('d3v1an.tux@gmail.com');

      $mail->AddBCC('laura_murillo@hotmail.com');
      $mail->AddBCC('lauramurillozuniga@gmail.com');
      $mail->AddBCC('oscar.monitoreojalisco@gmail.com');
      $mail->AddBCC('huesomonitoreo2012@gmail.com');
      $mail->AddBCC('roberto@publicumestrategias.com');
      $mail->AddBCC('ivans@euristicacom.com');

      //nuevo
      $mail->AddBCC('corozita@hushmail.com');

      //Clientes Solicitados por Laura
      $mail->AddBCC('ivans@euristicacom.com');
      $mail->AddBCC('ricardomancilla@hotmail.com');
      $mail->AddBCC('roberto@publicumestrategias.com');
      $mail->AddBCC('adryanasantillan@gmail.com');
      $mail->AddBCC('alfredo@heuristicacom.com');
      $mail->AddBCC('alonsotorresvazquez@gmail.com');
      $mail->AddBCC('cesar.alvarezgdl@gmail.com');
      $mail->AddBCC('cinthya.navarrop@gmail.com');
      $mail->AddBCC('cuauhtemoc.cisneros.madrid@gmail.com,');
      $mail->AddBCC('cesar_ruv@hotmail.com');
      $mail->AddBCC('david.silva.nd@gmail.com');
      $mail->AddBCC('murillo.laura7@gmail.com');
      $mail->AddBCC('ericsepulveda25@gmail.com');
      $mail->AddBCC('fabiolalivier@gmail.com');
      $mail->AddBCC('gaxel_axgel@hotmail.com');
      $mail->AddBCC('gonzalo.gdl@gmail.com');
      $mail->AddBCC('navarro.israel@gmail.com');
      $mail->AddBCC('yanomejalisco@gmail.com');
      $mail->AddBCC('jordi.grasa@gmail.com,');
      $mail->AddBCC('jl.duran20@gmail.com');
      $mail->AddBCC('juancarlos.magallanes@gmail.com');
      $mail->AddBCC('juanjoramos7@gmail.com');
      $mail->AddBCC('lauramurillozuniga@gmail.com');
      $mail->AddBCC('huesomonitoreo2012@gmail.com');
      $mail->AddBCC('marthisthis@gmail.com');
      $mail->AddBCC('miguelcastroreynoso@hotmail.com');
      $mail->AddBCC('oscar.monitoreojalisco@gmail.com');
      $mail->AddBCC('prensaprijalisco@gmail.com');
      $mail->AddBCC('ricardovillanuevalomeli@gmail.com');
      $mail->AddBCC('RVLMONITOREO@gmail.com');
      $mail->AddBCC('scarrillogarcia@hotmail.com');

      $mail->AddBCC('angeles.arredondo2012@hotmail.com');
      $mail->AddBCC('karlagardunom@gmail.com');
      $mail->AddBCC('ratome.1120@gmail.com');
      $mail->AddBCC('grislomeligil@gmail.com');

      //CLIENTE

      $mail->AddBCC("jlga@gacomunicacion.com");
      $mail->AddBCC("gmocarmona@gacomunicacion.com");
      $mail->AddBCC("fcocolina@gacomunicacion.com");
      $mail->AddBCC("oortiz@gacomunicacion.com");
      $mail->AddBCC("alezama@gacomunicacion.com");

      $mail->AddBCC('rubend@gacomunicacion.com');
      $mail->AddBCC('edgarh@gacomunicacion.com');
      $mail->AddBCC('mariob@gacomunicacion.com');
      $mail->AddBCC('jesush@gacomunicacion.com');
      $mail->AddBCC('carloshreyes@gmail.com');

      $mail->AddBCC('ehb1703@icloud.com');

      $mail->AddBCC('ehb1703@me.com');


      $mail->From = 'gaimpresos@gacomunicacion.com';
      $mail->FromName = "MONITOREO RVL Segmentos de Notas ".date("Y-m-d");

      $mail->Subject  = "MONITOREO RVL ".fecha_completa(date("Y-m-d"));
      $mail->WordWrap = 50;

      // Correo destino

      $mail->IsHTML(TRUE);

      //$mail->Body = utf8_decode(utf8_encode($mensaje));
      $mail->Body = $mensaje;
      //$mail->AddAttachment("/var/www/external/testigos/Financiera/".DATE('Y-m-d')."Reporte Financiera.pdf");

        if(!$mail->Send()) {
            echo "Error: " . $mail->ErrorInfo;
        } else {
            echo "Mensaje enviado";
        }
  }    
?>