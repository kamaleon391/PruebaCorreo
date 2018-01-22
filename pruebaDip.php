    sendinblue($mensaje);
    function sendinblue($message){

        $subject="PEMEX Estados ".date("Y-m-d");
        $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
        $data   = array(
            "to" => array(
                  'fernando.martin.sanchez@pemex.com' => 'Fernando Sanchez',
          'luis.francisco.montano@pemex.com' => 'Luis Montano',
          'mauricio.suarez@pemex.com' => 'Mauricio Suarez',
            ),
            "bcc" => array(
        "sintesisga@gmail.com" => "Sintesis GA",
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