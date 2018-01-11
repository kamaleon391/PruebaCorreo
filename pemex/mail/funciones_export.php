<?php 

if( gethostname() === 'Sauron' ){
  require_once '/var/www/external/services/mail/fpdf17/fpdf.php' ;
  require_once '/var/www/external/services/mail/FPDI-1.4.4/fpdi.php' ;
  require_once '/var/www/external/services/mail/conexion.php' ;
} else {
  require_once 'fpdf17/fpdf.php' ;
  require_once 'FPDI-1.4.4/fpdi.php' ;
  require_once 'conexion.php' ;
}

/*
 * ARRAY DE ESTADOS POR SI SE NECESITA EN OTRA FUNCION... PENDIENTE DE BORRAR...
 */
$estados = array(
            1 => 'Aguascalientes',   2 => 'Baja California', 3 => 'Baja California Sur', 4 => 'Campeche',
            5 => 'Coahuila',         6 => 'Colima',          7 => 'Chiapas',          8 => 'Chihuahua',
            9 => 'Distrito Federal', 10 => 'Durango',        11 => 'Guanajuato',      12 => 'Guerrero',
            13 => 'Hidalgo',         14 => 'Jalisco',        15 => 'Estado de México',16 => 'Michoacán',
            17 => 'Morelos',         18 => 'Nayarit',        19 => 'Nuevo Leon',      20 => 'Oaxaca',
            21 => 'Puebla',          22 => 'Queretaro',      23 => 'Quintana Roo',    24 => 'San Luis Potosi',
            25 => 'Sinaloa',         26 => 'Sonora',         27 => 'Tabasco',         28 => 'Tamaulipas',
            29 => 'Tlaxcala',        30 => 'Veracruz',       31 => 'Yucatan',         32 => 'Zacatecas'
        );

/*
 * FUNCION PARA OBTENER LOS ARRAYS CON LA INFORMACION NECESARIA PARA EL RENDERIZADO
 * @params $query => string
 * @return array 
 */
function getDataSql( $query, $columnas = false ) {
  $i          = 0;
  $periodico  = array();
  $seccion    = array();
  $estados    = array();
  $data       = mysql_query( $query );

  if( mysql_num_rows( $data ) > 0 ) {
    while( $row = mysql_fetch_array( $data ) ) {
      $pdf_links[$i]  = $row['pdf'];
      $periodico[$i]  = $row['periodico'];
      if ( $columnas == true ){
        $seccion[$i]    = substr($row['Titulo'], 0, 45);
      } else {
        $seccion[$i]    = $row['seccion'];
      }
      $estados[$i]    = $row['Estado'];
      $i++; 
    }

    return array(
        'conteo'    => mysql_num_rows( $data ),
        'links'     => $pdf_links,
        'periodico' => $periodico,
        'seccion'   => $seccion,
        'estados'   => $estados,
        'i'         => $i
      );

  } else {
    return array( 'conteo' => 0 );
  }
}

/*
 * FUNCION PARA CREAR UN OBJETO PDF Y RELAIZAR LA CONFIGURACION BASICA
 * @params ( $tema => string, $subtema => string, $path_logo => string )
 * @return ( Objeto FPDI )
 */
function createPdf( $tema, $subtema, $path_logo ) {

  $pdf  = new FPDI('P','mm','legal');

  $pdf->addPage();
  $pdf->SetFillColor(245,245,245);
  $pdf->Rect(0, 131, 250, 40, 'F');
  $pdf->setTextColor(0,0,0); //PARAMETROS
  $pdf->SetFont("arial", "B", 25);
  $pdf->Text(10,156,$tema." ".$subtema); //INCLUYE EL SUBTEMA
  $pdf->SetFont("arial", "B", 13);
  $pdf->setTextColor(255,255,255);
  $pdf->Image( $path_logo , 5, 70, 100 ); //POSICIONES DISTINTAS 
  $pdf->SetFont("arial", "B",15);
  $pdf->setTextColor(0,0,0);
  $pdf->Text(130,177,mostrar_fecha_completa(date('Y-m-d')));   

  return $pdf;
}

/*
 * FUNCION PARA CREAR UN PDF 
 * @params ( $query => SQL string $tema => string, $subtema => string, $path_logo => string )
 * @return ( File Pdf )
 */
function ArmaPdf( $query, $tema, $subtema, $path_logo = 'logopdf.jpg' ) { 
  $j    = 0;
  $data = getDataSql( $query );
  
  if( $data[ 'conteo' ] > 0 ) {
    $i          = $data[ 'i' ];
    $periodico  = $data[ 'periodico' ];
    $seccion    = $data[ 'seccion' ];
    $estados    = $data[ 'estados' ];
    $pdf_links  = $data[ 'links' ];
    $pdf        = createPdf( $tema, $subtema, $path_logo );

    for( $j=0 ; $j < sizeof( $periodico ) ; $j++ ) {
      if( file_exists( $pdf_links[$j] ) ) {
        $pageCount = $pdf->setSourceFile( $pdf_links[$j] );
        $tplIdx = $pdf->importPage(1);
        $pdf->addPage();
        //rectangulo GRis
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 0, 250, 18, 'F');
        //rentangulo Azul
        $pdf->SetFillColor(0, 191, 255);
        $pdf->Rect(0, 10, 170, 15, 'F');
        $pdf->setTextColor(0,0,0); //PARAMETROS
        $pdf->SetFont("arial", "B", 18);
        $pdf->Text(10,18,$estados[$j]." | ".strtoupper($periodico[$j]));
        $pdf->SetFont("arial", "B", 13);
        $pdf->setTextColor(255,255,255);
        $pdf->Text(10,23,strtoupper($seccion[$j]));
        $pdf->SetFont("arial", "B", 9);
        $pdf->setTextColor();
        $pdf->Text( 75, 8, $tema );
        $pdf->Image( $path_logo, 5, 335, 30 ); 
        $pdf->SetFont("arial", "B",12);
        $pdf->setTextColor();
        $pdf->Text(150,8,mostrar_fecha_completa(date('Y-m-d')));   
        $pdf->useTemplate($tplIdx, 30,30,150);

        if($pageCount > 1) {
          try {
            $tplIdx_ = $pdf->importPage(2);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx_, 30, 30, 150);
          } catch( InvalidArgumentException $e ){ }
        }
      } else {
        $pdf->addPage();
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 10);
        $pdf->Text(10,156,"No se Encontro : ".$pdf_links[$j]);
      }  
    }
    $pdf->Output($tema.$subtema.".pdf", 'D');   
  } else {
    echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
    echo  "<br><br>" .mysql_error();
  }

  $periodico  = array(); 
  $seccion    = array(); 
  $estados    = array();
  mysql_close();

}

function ArmaPdfColumnas( $query, $tema, $subtema, $path_logo = 'logopdf.jpg' ) {  
  $j    = 0;
  $data = getDataSql( $query, true );

  if( $data[ 'conteo' ] > 0 ) {
    $i          = $data[ 'i' ];
    $periodico  = $data[ 'periodico' ];
    $seccion    = $data[ 'seccion' ];
    $estados    = $data[ 'estados' ];
    $pdf_links  = $data[ 'links' ];
    $pdf        = createPdf( $tema, $subtema, $path_logo );

    for( $j = 0 ; $j < sizeof( $periodico ) ; $j++ ) {
      if( file_exists( $pdf_links[ $j ]  ) ) {
        $pageCount  = $pdf->setSourceFile($pdf_links[$j]);
        $tplIdx     = $pdf->importPage(1);

        $pdf->addPage();
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 0, 250, 18, 'F');        
        $pdf->SetFillColor(0, 191, 255);
        $pdf->Rect(0, 10, 140, 15, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 20);
        $pdf->Text( 10,18, $estados[ $j ]." | ".strtoupper( $periodico[ $j ] ) );
        $pdf->SetFont("arial", "B", 13);
        $pdf->setTextColor(255,255,255);
        $pdf->Text(10,23,strtoupper( $seccion[ $j ] ) );
        $pdf->SetFont("arial", "B", 9);
        $pdf->setTextColor(128);
        $pdf->Text(150,8,$tema);
        $pdf->SetFont("arial", "", 9);
        $pdf->setTextColor();
        $pdf->Text(170,8,$subtema);  
        $pdf->SetFont("arial", "B",12);
        $pdf->setTextColor();
        $pdf->Text(182,13,date('Y-m-d'));  
        $pdf->Image( $path_logo , 5, 340, 30 ); 
        //$pdf->WriteHTML($html);
        //$pdf->addPage('L'); //landscape
        $pdf->useTemplate($tplIdx, 20,30,160);
      } else {
        $pdf->addPage();
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 10);
        $pdf->Text(10,156,"No se Encontro : ".$pdf_links[$j]);
      }  
    }
    $pdf->Output($tema.$subtema.".pdf", 'D'); 
  } else {
    echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
  }
}

/*
 * FUNCION PARA OBTENER LA FECHA EN FORMATO DE CADENA
 * @params ( $fecha => string )
 * @return ( $fecha => string )
 */
function mostrar_fecha_completa( $fecha ) {
  
  $subfecha = explode("-",$fecha); 
  $año      = $subfecha[0]; 
  $mes      = $subfecha[1]; 
  $dia      = $subfecha[2];
  $dia2     = date( "d", mktime(0,0,0,$mes,$dia,$año) );
  $mes2     = date( "m", mktime(0,0,0,$mes,$dia,$año) );
  $año2     = date( "Y", mktime(0,0,0,$mes,$dia,$año) );
  $dia_sem  = date( "w", mktime(0,0,0,$mes,$dia,$año) );

  $dias  = array( '0' => 'Domingo', '1' => 'Lunes', 
                  '2' => 'Martes',  '3' => 'Miercoles',
                  '4' => 'Jueves',  '5' => 'Viernes',
                  '6' => 'Sabado'  );

  $meses = array( '01' => 'Enero',     '02' => 'Febrero', 
                  '03' => 'Marzo',     '04' => 'Abril', 
                  '05' => 'Mayo',      '06' => 'Junio',    
                  '07' => 'Julio',     '08' => 'Agosto',
                  '09' => 'Septiembre','10'=> 'Octubre',
                  '11'=> 'Noviembre', '12'=> 'Diciembre' );     

  if( $mes2 >= '01' && $mes2 <= '12' && $dia_sem >= '0' && $dia_sem <= '6' )
    return $dias[ $dia_sem ].' '.$dia2.' de '. $meses[ $mes2 ] .' de '.$año2;
  return '';
}
