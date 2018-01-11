<?php

if(isset($_GET['p']) && isset($_GET['f'])){
    include 'querysNafinsa.php';
     // $fecha=base64_decode(base64_decode($_GET['f'])); 
      $valor=base64_decode(base64_decode($_GET['p'])); 
      $query=query($valor, $_GET['f']);
      //$query = utf8_decode($query);
    switch ($valor){
        case 1: // NAFINSA
             $tema="NAFINSA";$subtema=" ";
             ArmaPdf($query,$tema,$subtema,"Notas");
        break;
        case 2: // Presidencia
             $tema="Presidencia";$subtema=" ";
             ArmaPdf($query,$tema,$subtema,"Notas");
        break;
        case 3:
             $tema="Primeras Planas";$subtema=" ";
             ArmaPdf($query,$tema,$subtema,"Portadas");
        break;
        case 4:
             $tema="Columnas Nafin";$subtema=" ";
             ArmaPdf($query,$tema,$subtema,"Notas");
        break;
        case 5:
             $tema="Cartones";$subtema=" ";
             ArmaPdf($query,$tema,$subtema,"Notas");
        break;
    }
}else{
    
}
        

function ArmaPdf($query,$tema,$subtema,$tipo){

require_once('../fpdf17/fpdf.php');
require_once('../FPDI-1.4.4/fpdi.php');
$pdf = new FPDI('P','mm','legal');
require '../conexion.php'; 

$data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0;//Contador de Paginas
        $periodico=array();
        $seccion=array();
        $estados=array();
        $j=0;
        while ($row = mysql_fetch_array($data)){
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['periodico'];
              $seccion[$i] = $row['seccion'];
              $estados[$i] = $row['Estado'];
              $fecha[$i] = $row['Fecha'];
              $pagina[$i] = $row['PaginaPeriodico'];
              $crel[$i] = $row['CREL'];
              $areaNota[$i] = $row['areaNota'];
              $costoNota[$i] = $row['costoNota'];
              $String_name[$i] = $row['String_name'];
            $i++;
        }
        
        $pdf->addPage();
                    //Recuadro Gris Inferior
                    $pdf->SetFillColor(245,245,245);
                    $pdf->Rect(0, 131, 250, 40, 'F');
                    $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,156,$tema." ".$subtema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");
		      $pdf-
                      $pdf->Image('logoNafinsa.jpg',5,70,80); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa($_GET['f']));   
        //
        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j]))
                {      
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      
                      if($tipo == "Notas") {
                        $y = 20;
                        $pdf->SetFont("arial", "B", 9);
                        $pdf->SetTextColor();
                        $pdf->SetXY(0, 4);
                        $pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
                        $pdf->Line(30, 12, 200, 12);
                        $pdf->Image('logoNafinsa.jpg',5,3,20); 
                      
                        $pdf->SetTextColor( 0,0,0 );
                        // x = 265 Total
                        $pdf->SetXY( 15, $y );
                        $pdf->Cell(45, 5, utf8_decode("Medio"), 1, 1, 'C', false);
                        // x = 80 
                        $pdf->SetXY( 60, $y);
                        $pdf->Cell(35, 5, utf8_decode("Sección"), 1, 1, 'C', false);
                        // x = 105 
                        $pdf->SetXY( 95, $y);
                        $pdf->Cell(15, 5, utf8_decode("Pagina"), 1, 1, 'C', false);
                        // x = 130 
                        $pdf->SetXY( 110, $y);
                        $pdf->Cell( 20, 5, utf8_decode("Fecha"), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 130, $y);
                        $pdf->Cell( 20, 5, utf8_decode("Calificación"), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 150, $y);
                        $pdf->Cell( 25, 5, utf8_decode("Area"), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 175, $y);
                        $pdf->Cell( 25, 5, utf8_decode("Costo"), 1, 1, 'C', false);
                        $y += 5;
                        $pdf->SetXY( 15, $y );
                        if(empty(trim($String_name[$j]))) {
                          $pdf->Cell(45, 5, utf8_decode($periodico[$j]), 1, 1, 'C', false);  
                        } else {
                          $pdf->Cell(45, 5, utf8_decode($String_name[$j]), 1, 1, 'C', false);  
                        }
                        // x = 80 
                        $pdf->SetXY( 60, $y);
                        $pdf->Cell(35, 5, utf8_decode($seccion[$j]), 1, 1, 'C', false);
                        // x = 105 
                        $pdf->SetXY( 95, $y);
                        $pdf->Cell(15, 5, utf8_decode($pagina[$j]), 1, 1, 'C', false);
                        // x = 130 
                        $pdf->SetXY( 110, $y);
                        $pdf->Cell( 20, 5, utf8_decode($fecha[$j]), 1, 1, 'C', false);

                        $pdf->SetXY( 130, $y);
                        $pdf->Cell( 20, 5, utf8_decode(number_format($crel[$j], 4)), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 150, $y);
                        $pdf->Cell( 25, 5, utf8_decode(number_format($areaNota[$j], 2) . " cm2"), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 175, $y);
                        $pdf->Cell( 25, 5, utf8_decode("$" . number_format($costoNota[$j], 2)), 1, 1, 'C', false);

                        $pdf->useTemplate($tplIdx, 30,30,150);
                      } else {
                        $pdf->useTemplate($tplIdx, null, null, 0, 0, true);
                      }
                  }
                else{
                    $pdf->addPage();
                    $pdf->setTextColor();
                    $pdf->SetFont("arial", "B", 10);
                    $pdf->Text(10,156,"No se Encontro : ".$variable[$j]);
                }  
             }
        $pdf->Output($tema.$subtema.".pdf", 'D');   
    }else{
        
        echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
        
        echo  "<br><br>" .mysql_error();
    }
    $periodico=array();
    $seccion=array();
    $estados=array();
    mysql_close();

}

function createCuttedPDF($query,$tema,$subtema,$tipo) {

require_once('../fpdf17/fpdf.php');
require_once('../FPDI-1.4.4/fpdi.php');
$pdf = new FPDI('P','mm','legal');
require '../conexion.php'; 

$data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0;//Contador de Paginas
        $periodico=array();
        $seccion=array();
        $estados=array();
        $j=0;
        while ($row = mysql_fetch_array($data)){
             $idEditorial[$i] = $row['idEditorial'];
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['periodico'];
              $seccion[$i] = $row['seccion'];
              $estados[$i] = $row['Estado'];
              $fecha[$i] = $row['Fecha'];
              $pagina[$i] = $row['PaginaPeriodico'];
              $crel[$i] = $row['CREL'];
              $areaNota[$i] = $row['areaNota'];
              $costoNota[$i] = $row['costoNota'];
              $String_name[$i] = $row['String_name'];
            $i++;
        }
        
        $pdf->addPage();
                    //Recuadro Gris Inferior
                    $pdf->SetFillColor(245,245,245);
                    $pdf->Rect(0, 131, 250, 40, 'F');
                    $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,156,$tema." ".$subtema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");
          $pdf-
                      $pdf->Image('logoNafinsa.jpg',5,70,80); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa($_GET['f']));   
        //
        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j]))
                {      
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      
                      if($tipo == "Notas") {
                        $y = 20;
                        $pdf->SetFont("arial", "B", 9);
                        $pdf->SetTextColor();
                        $pdf->SetXY(0, 4);
                        $pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
                        $pdf->Line(30, 12, 200, 12);
                        $pdf->Image('logoNafinsa.jpg',5,3,20); 
                      
                        $pdf->SetTextColor( 0,0,0 );
                        // x = 265 Total
                        $pdf->SetXY( 15, $y );
                        $pdf->Cell(45, 5, utf8_decode("Medio"), 1, 1, 'C', false);
                        // x = 80 
                        $pdf->SetXY( 60, $y);
                        $pdf->Cell(35, 5, utf8_decode("Sección"), 1, 1, 'C', false);
                        // x = 105 
                        $pdf->SetXY( 95, $y);
                        $pdf->Cell(15, 5, utf8_decode("Pagina"), 1, 1, 'C', false);
                        // x = 130 
                        $pdf->SetXY( 110, $y);
                        $pdf->Cell( 20, 5, utf8_decode("Fecha"), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 130, $y);
                        $pdf->Cell( 20, 5, utf8_decode("Calificación"), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 150, $y);
                        $pdf->Cell( 25, 5, utf8_decode("Area"), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 175, $y);
                        $pdf->Cell( 25, 5, utf8_decode("Costo"), 1, 1, 'C', false);
                        $y += 5;
                        $pdf->SetXY( 15, $y );
                        if(empty(trim($String_name[$j]))) {
                          $pdf->Cell(45, 5, utf8_decode($periodico[$j]), 1, 1, 'C', false);  
                        } else {
                          $pdf->Cell(45, 5, utf8_decode($String_name[$j]), 1, 1, 'C', false);  
                        }
                        // x = 80 
                        $pdf->SetXY( 60, $y);
                        $pdf->Cell(35, 5, utf8_decode($seccion[$j]), 1, 1, 'C', false);
                        // x = 105 
                        $pdf->SetXY( 95, $y);
                        $pdf->Cell(15, 5, utf8_decode($pagina[$j]), 1, 1, 'C', false);
                        // x = 130 
                        $pdf->SetXY( 110, $y);
                        $pdf->Cell( 20, 5, utf8_decode($fecha[$j]), 1, 1, 'C', false);

                        $pdf->SetXY( 130, $y);
                        $pdf->Cell( 20, 5, utf8_decode(number_format($crel[$j], 4)), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 150, $y);
                        $pdf->Cell( 25, 5, utf8_decode(number_format($areaNota[$j], 2) . " cm2"), 1, 1, 'C', false);
                        
                        $pdf->SetXY( 175, $y);
                        $pdf->Cell( 25, 5, utf8_decode("$" . number_format($costoNota[$j], 2)), 1, 1, 'C', false);

                        $pdf->useTemplate($tplIdx, 30,30,150);
                      } else {
                        $pdf->useTemplate($tplIdx, null, null, 0, 0, true);
                      }
                  }
                else{
                    $pdf->addPage();
                    $pdf->setTextColor();
                    $pdf->SetFont("arial", "B", 10);
                    $pdf->Text(10,156,"No se Encontro : ".$variable[$j]);
                }  
             }
        $pdf->Output($tema.$subtema.".pdf", 'D');   
    }else{
        
        echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
        
        echo  "<br><br>" .mysql_error();
    }
    $periodico=array();
    $seccion=array();
    $estados=array();
    mysql_close();

}

function orderCutsPdf($pdf, $id) {
    $images = getCutImages($id);
}

function getCutImages($id) {
    $images = [];
    $count = 1;
    $filename = $id . '_cut_' . $count . '.png';
    while('/var/www/siscap.la/public/img/cuts/' . $filename) {
        $images[] = $filename;
        $count++;
        $filename = $id . '_cut_' . $count . '.png';
    }
    $filename = $id . '_cut_photo.png';
    if('/var/www/siscap.la/public/img/cuts/' . $filename) {
        $images[] = $filename;
    }
    return $images;
}

function mostrar_fecha_completa($fecha){
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
     break; 
  }; 
 
   
$fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;

return $fecha_texto;
};


?>
