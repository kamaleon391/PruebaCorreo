<?php
    require 'Mailin.php';
    require 'conexion.php';

    $mensaje="<h1>Titulo del mensaje</h1>
    <p>Cuerpo del mensaje</p>";

    echo $mensaje."<br><br>";

    sendinblue($mensaje);
    function sendinblue($message){

        $subject="Mensaje de prueba";
        $mailin = new Mailin("https://api.sendinblue.com/v2.0", "wjSbMAENLm2TGfpW");
        $data   = array(
            "to" => array(
                  "kamaleon391@gmail.com" => "Correo de prueba",
            ),
            "cc" => array(
                "ehb1703@me.com"=>"Edgar Hernandez",
            ),            
            "bcc" => array(
                "ehb1703@gmail.com" => "Edgar Hernandez",
            ),
            "from" => array("gaimpresos@gmail.com", "Ga Comunicacion"),
            "subject" =>$subject,
            "html" => $message,
            "headers" => array("Content-Type"=> "text/html; charset=iso-8859-1s", "X-Mailin-Tag" => "Impresos")
        );

        /*
         * ENVIANDO EMAIL...
         */
        var_dump($mailin->send_email($data));
    }
?>