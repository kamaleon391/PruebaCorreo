<?php

$dir = 'Encuentro';

if( gethostname() === 'Sauron' ){
    require_once '/var/www/external/services/mail/funciones_export.php';
    require_once '/var/www/external/services/mail/'.$dir.'/querys'.$dir.'.php';

    $path_logo  = '/var/www/external/services/mail/'.$dir.'/logopdf.jpg';

} else {
    require_once '/var/www/external/mail/'.$dir.'/querys'.$dir.'.php';
    require_once '/var/www/external/mail/funciones_export.php';

    $path_logo  = '/var/www/external/mail/'.$dir.'/logopdf.jpg';

}

if( isset($_GET['p']) && isset($_GET['f']) ) {
    $valor      = base64_decode( base64_decode($_GET['p']) ); 
    $estado     = 0;
    $query      = query($valor, $_GET['f'], $estado );

    if( isset( $_GET[ 'e' ] ) ) $estado = $_GET['e'];

    switch ( $valor ) {
        case 1: $tema = "PRIMERAS PLANAS"; $subtema = " ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;
        case 2: $tema =utf8_decode("COLUMNAS POLÍTICAS");$subtema = " ";
                ArmaPdfColumnas($query,$tema,$subtema, $path_logo );
                break;
        case 3: $tema = "COLUMNAS FINANCIERAS ";$subtema = " ";
                ArmaPdfColumnas($query,$tema,$subtema, $path_logo );
                break;
        case 4: $tema = "CARTONES"; $subtema = " ";
                ArmaPdfColumnas($query,$tema,$subtema, $path_logo );
                break;
        case 5: $tema = "Partido Encuentro Social";$subtema = " ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;
        case 6: $tema=utf8_decode("PRI"); $subtema = "  ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 7: $tema = "PAN";$subtema = " ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;         
        case 8: $tema=utf8_decode("PRD" );$subtema = " ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;  
        case 9: $tema = "Encuestas";$subtema = "";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 10: $tema = "Partido Encuentro Social - Estados";$subtema = " ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;
        case 11: $tema=utf8_decode("PRI - Estados"); $subtema = "  ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 12: $tema = "PAN - Estados";$subtema = " ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;         
        case 13: $tema=utf8_decode("PRD - Estados" );$subtema = " ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;  
        case 14: $tema = "Encuestas - Estados";$subtema = "";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
       case 15: $tema = "PT - CDMX";$subtema = "";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
       case 16: $tema = "PT - Estados";$subtema = "";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 

    }
}
