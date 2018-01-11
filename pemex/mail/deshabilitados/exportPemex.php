<?php

if(isset($_GET['p']) && isset($_GET['f'])){
    include './querysPemex.php';
     // $fecha=base64_decode(base64_decode($_GET['f'])); 
       $valor=base64_decode(base64_decode($_GET['p'])); 
       $query=query($valor, $_GET['f']);
      //$tabla=defineFecha($fecha);
      
    switch ($valor) {
        case 1: // PRIMERAS PLANAS
             $tema="PEMEX";$subtema="Dia";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 2:
             $tema="PEMEX";$subtema="Mensual";
             ArmaPdf2($query,$tema,$subtema);
            break;
        default:
      
}
    
}
else{
    
}
function ArmaPdf($query,$tema,$subtema){  
require_once('./fpdf17/fpdf.php');
require_once('./FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
require '../php/conexion.php';
    
    
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$j=0;
        while ($row = mysql_fetch_array($data)) {
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['Periodico'];
              $seccion[$i] = $row['Seccion'];
              $fecha[$i] = $row['Seccion'];
            $i++;
        } 
        
        //
        $pdf->addPage();

                    //rectangulo GRis ABAJO
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 131, 250, 40, 'F');

                     


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,156,$tema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,"test");

                       $pdf->Image('pemex/logo.png',5,110,30); 
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);  
         */
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(140,177,mostrar_fecha_completa(date('Y-m-d')));   
        //
        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j])){
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 0, 250, 18, 'F');


                      //rentangulo Azul
                      $pdf->SetFillColor(0, 191, 255);
                      $pdf->Rect(0, 10, 140, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 20);
                      $pdf->Text(10,18,strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->SetY(8);
                      $pdf->Cell(0,0,  ($tema),0,'','R');
                       $pdf->Image('pemex/logo.png',5,340,15); 
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);  
         */
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->SetY(12);
                      $pdf->Cell(0,0,mostrar_fecha_completa(date('Y-m-d')),0,'',"R");      
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }else{ }  
             }
        $pdf->Output($tema."_".date('Y-m-d').".pdf", 'D');   
    }else{
        
       /* 
       $pdf->addPage();
                      //rectangulo GRis
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 0, 250, 50, 'F'); 
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 30);
        $pdf->Text(10,180,strtoupper("NO SE ENCONTRARON RESULTADOS"));
        $pdf->Image('salud/logopdf.png',5,10,80);
        $pdf->Output(utf8_decode($tema).$subtema.".pdf", 'D');   */
        
        echo "<script>alert('No se encuentran Resultados de ".($tema)."$subtema');</script>";
    }
    

}
function ArmaPdf2($query,$tema,$subtema){  
require_once('./fpdf17/fpdf.php');
require_once('./FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
require '../php/conexion.php';
    
    
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$j=0;
        while ($row = mysql_fetch_array($data)) {
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['Periodico'];
              $seccion[$i] = $row['Seccion'];
              $fecha[$i] = $row['Fecha'];
              $titulo[$i] = $row['Titulo'];
            $i++;
        } 
        
        //
        $pdf->addPage();

                    //rectangulo GRis ABAJO
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 131, 250, 40, 'F');

                     


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,156,$tema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,"test");

                       $pdf->Image('pemex/logo.png',5,110,30); 
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);  
         */
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(140,177,mostrar_fecha_completa(date('Y-m-d')));   
        //
        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j])){
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 0, 250, 18, 'F');


                      //rentangulo Azul
                      $pdf->SetFillColor(0, 191, 255);
                      $pdf->Rect(0, 10, 140, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 20);
                      $pdf->Text(10,18,strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->SetY(8);
                      $pdf->Cell(0,0,  ($tema),0,'','R');
                       $pdf->Image('pemex/logo.png',5,340,15); 
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);  
         */
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->SetY(12);
                      $pdf->Cell(0,0,mostrar_fecha_completa($fecha[$j]),0,'',"R");    
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }else{ }  
             }
        $pdf->Output($tema."_".$subtema.".pdf", 'D');   
    }else{
        
       /* 
       $pdf->addPage();
                      //rectangulo GRis
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 0, 250, 50, 'F'); 
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 30);
        $pdf->Text(10,180,strtoupper("NO SE ENCONTRARON RESULTADOS"));
        $pdf->Image('salud/logopdf.png',5,10,80);
        $pdf->Output(utf8_decode($tema).$subtema.".pdf", 'D');   */
        
        echo "<script>alert('No se encuentran Resultados de ".($tema)."$subtema');</script>";
    }
    

}

function mostrar_fecha_completa($fecha){
    $subfecha=split("-",$fecha); 
   for($i=0;$subfecha[$i];$i++); 
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