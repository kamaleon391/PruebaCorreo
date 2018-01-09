<?php
    require 'library\Mailin.php';
    require 'conexion.php';

    $fecha=  date("Y-m-d");
    $mensaje="Hola";

    sendinblue($mensaje);
    function sendinblue($message){

        $subject="Mensaje de prueba".date("Y-m-d");
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
            "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos")
        );

        /*
         * ENVIANDO EMAIL...
         */
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
        };


        $fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;

        return $fecha_texto;
    }
?>