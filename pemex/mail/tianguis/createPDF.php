<?php

include "/var/www/external/services/mail/tianguis/querysTianguis.php";
require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
require_once('/var/www/external/services/mail/Classes/Witness.php');

$i          = 5;
$fecha      = date('Y-m-d');
$topics     = array( 
                5  => 'TIANGUIS TURÍSTICO' ,//CDMX
                6  => 'TIANGUIS TURÍSTICO' ,//Estados
                7  => 'SECRETARÍA TURISMO FEDERAL',//CDMX
                8  => 'SECRETARÍA TURISMO FEDERAL',//Estados
                9  => 'CONSEJO DE PROMOCIÓN TURÍSTICA',//CDMX
                10 => 'CONSEJO DE PROMOCIÓN TURÍSTICA',//Estados
                11 => 'PROMEXICO',//CDMX
                12 => 'PROMEXICO',//Estados
                13 => 'ENRIQUE DE LA MADRID CORDERO',//CDMX
                14 => 'ENRIQUE DE LA MADRID CORDERO',//Estados
                15 => 'ARISTÓTELES SANDOVAL',//CDMX
                16 => 'ARISTÓTELES SANDOVAL',//Estados
                17 => 'SECRETARÍA DE TURISMO JALISCO' ,//CDMX
                18 => 'SECRETARÍA DE TURISMO JALISCO' ,//Estados
                19 => 'CONSEJO NACIONAL EMPRESARIAL',//CDMX
                20 => 'CONSEJO NACIONAL EMPRESARIAL', //Estados
		21 => 'PRESIDENTE', //CDMX
		22 => 'PRESIDENTE' //Estados
                );

$hour = date('H:i');

while( $i <= 22 ) {
    if( $i % 2 == 0 && $hour > '08:30' ) { 
        $ruta = '/var/www/external/testigos/tianguis/estados';
    }
    else if( $i % 2 == 1 ) {
        $ruta = '/var/www/external/testigos/tianguis/df';
    } else {
      $i++;
      continue;
    }
    $pdf_file   = new Witness( 
                    $fecha, 
                    $topics[ $i ], 
                    $ruta, 
                    '/var/www/external/services/mail/tianguis/logopdf.png',
                    'legal' );
    $pdf_file->create_frontpage(utf8_decode($topics[ $i ]));
    $pdf_file->create_document_body( query( $i, $fecha, null ) ); //ONLY CDMX NEWSPAPERS
    $pdf_file->save_document();
    $i++;
}
