<?php

if( gethostname() === 'Sauron' ){
    require_once '/var/www/external/services/mail/funciones_export.php';
    require_once '/var/www/external/services/mail/issste/querysIssste.php';

    $path_logo  = '/var/www/external/services/mail/issste/logopdf.jpg';

} else {
    require_once '/var/www/external/mail/issste/querysIssste.php';
    require_once '/var/www/external/mail/funciones_export.php';

    $path_logo  = '/var/www/external/mail/issste/logopdf.jpg';

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
        case 2: $tema = "COLUMNAS POLITICAS";$subtema = " ";
                ArmaPdfColumnas($query,$tema,$subtema, $path_logo );
                break;
        case 3: $tema = "COLUMNAS FINANCIERAS ";$subtema=" ";
                ArmaPdfColumnas($query,$tema,$subtema, $path_logo );
                break;
        case 4: $tema = "CARTONES"; $subtema = " ";
                ArmaPdfColumnas($query,$tema,$subtema, $path_logo );
                break;
        case 5: $tema="DIRECCION GENERAL ISSSTE - CDMX";$subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;
        case 6: $tema=utf8_decode("DIRECCION GENERAL ISSSTE - ESTADOS "); $subtema="  ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 7: $tema="ADMINISTRACION ISSTE - CDMX";$subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;         
        case 8: $tema=utf8_decode("ADMINISTRACION ISSTE - ESTADOS" );$subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;  
        case 9: $tema="CLINICAS Y HOSPITALES - CDMX";$subtema="";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 10:$tema=utf8_decode("CLINICAS Y HOSPITALES - ESTADOS" );$subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 11:$tema="PENSIONES JUBILACIONES - CDMX"; $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 12:$tema=utf8_decode("PENSIONES JUBILACIONES - ESTADOS"); $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 13:$tema="GUARDERIAS - CDMX";$subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 14:$tema=utf8_decode("GUARDERIAS - ESTADOS" ); $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 15:$tema="MEDICAMENTOS - CDMX"; $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 16:$tema=utf8_decode("MEDICAMENTO - ESTADOS"); $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 17:$tema="FOVISSSTE - CDMX"; $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 18:$tema=utf8_decode( "FOVISSSTE - ESTADOS" ); $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 19:$tema="FESTSE - CDMX"; $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 20:$tema=utf8_decode("FESTSE - ESTADOS" ); $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 21:$tema="ISSSTE - CDMX"; $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break; 
        case 22:$tema=utf8_decode("ISSSTE - ESTADOS"); $subtema=" ";
                ArmaPdf($query,$tema,$subtema, $path_logo );
                break;   
    }
}