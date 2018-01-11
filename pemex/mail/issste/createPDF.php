<?php

include "/var/www/external/services/mail/issste/querysIssste.php";
require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
require_once('/var/www/external/services/mail/Classes/Witness.php');

$i          = 5;
$fecha      = date('Y-m-d');
$topics     = array( 
                5  => 'DIRECCION GENERAL - CDMX',
                6  => 'DIRECTOR ISSSTE - ESTADOS',
                7  => 'ADMINISTRACION ISSSTE CDMX',
                8  => 'ADMINISTRACION ISSSTE ESTADOS',
                9  => 'CLINICAS Y HOSPITALES - CDMX',
                10 => 'CLINICAS Y HOSPITALES ESTADOS',
                11 => 'PENSIONES JUBILACIONES - CDMX',
                12 => 'PENSIONES Y JUBILACIONES- ESTADOS',
                13 => 'GUARDERIA CDMX',
                14 => 'GUARDERIA ESTADOS',
                15 => 'MEDICAMENTO CDMX',
                16 => 'MEDICAMENTO ESTADOS',
                17 => 'FOVISSSTE CDMX',
                18 => 'FOVISSSTE ESTADOS',
                19 => 'FESTSE CDMX',
                20 => 'FESTSE ESTADOS',
                21 => 'ISSSTE CDMX',
                22 => 'ISSSTE ESTADOS' );
$hour = date('H:i');

while( $i <= 22 ) {
    if( $i % 2 == 0 && $hour > '08:30' ) { 
        $ruta = '/var/www/external/testigos/issste/estados';
    }
    else if( $i % 2 == 1 ) {
        $ruta = '/var/www/external/testigos/issste/df';
    } else {
      $i++;
      continue;
    }
    $pdf_file   = new Witness( 
                    $fecha, 
                    $topics[ $i ], 
                    $ruta, 
                    '/var/www/external/services/mail/issste/logopdf.jpg',
                    'legal' );
    $pdf_file->create_frontpage( 'ISSSTE - '.$topics[ $i ] );
    $pdf_file->create_document_body( query( $i, $fecha, null ) ); //ONLY CDMX NEWSPAPERS
    $pdf_file->save_document();
    $i++;
}
