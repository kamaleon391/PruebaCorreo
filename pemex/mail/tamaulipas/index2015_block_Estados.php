<?php
if( getHostName() === 'Sauron' ){
    require_once '/var/www/external/services/mail/library/Mailin.php';
    require_once '/var/www/external/services/mail/querysTamaulipas.php';
    require_once '/var/www/external/services/mail/funciones_export.php';
    require_once '/var/www/external/services/mail/conexion.php';
    require_once '/var/www/external/services/mail/Classes/message.php';

} else {
    require '../library/Mailin.php';
    require '../querysTamaulipas.php';
    require '../funciones_export.php';
    require '../conexion.php';
}

/*
 * PREPARA MENSAJE QUE SERA ENVIADO
 */
$message_settings =  array(
    'state'     => 'Estados',
    'id'        => 28,
    'html'      => 'tamaulipas.html',
    'directory' => 'tamaulipas',
    'image'     => 'Logo.png',
    'date'      => date("Y-m-d"),
    'characters'=> array(
        11  => 'Egidio Torre Cantú - Estados',
        12  => 'Administración Estatal - Estados ',
        13  => 'Tamaulipas Parte 1 - Estados ',
        14  => 'Tamaulipas Parte 2 - Estados ',
        15  => 'Baltazar Hinojosa Ochoa - Estados ',
        16 => 'Francisco Javier García Cabeza de Vaca - Estados',
    )
);

$message = new Message();
$message->configMessage( $message_settings );
$message->addStaticLinks();
$mensaje = $message->getMessage();
//echo $mensaje;

/*
 * PREPARA MENSAJE QUE SERA ENVIADO...
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data   = array(
    "to" => array(
            'impresos@info-gacomunicacion.com' => 'impresos@info-gacomunicacion.com'
    ),
    "bcc" => array(
      'aleman.mtz.h@gmail.com' => 'aleman.mtz.h@gmail.com',
      'ehb1703@gmail.com' => 'ehb1703@gmail.com',
      'sintesisga@gmail.com' => 'sintesisga@gmail.com'
    ),
    "from" => array("gaimpresos@gacomunicacion.com", "MONITOREO DE PRENSA - ESTADOS "),
    "subject" => "ESTADOS ".mostrar_fecha_completa(date("Y-m-d")),
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-Tamaulipas-Estados")
);

/*
 * ENVIANDO EMAIL...
 */
var_dump($mailin->send_email($data));
