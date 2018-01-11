<?php

if(isset($_GET['p']) && isset($_GET['f'])){
    include './querysRizo.php';
     // $fecha=base64_decode(base64_decode($_GET['f'])); 
      $valor=base64_decode(base64_decode($_GET['p'])); 
      
      
      $query=query($valor, $_GET['f']);
      
    switch ($valor){
       
        case 1:
             $tema= utf8_decode("Salvador Rizo Castelo"); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;//Chava Rizo    
    
        case 4:
             $tema= utf8_decode("Pablo Lemus Navarro"); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;//Pablo Lemus    
    
        case 7:
             $tema= utf8_decode("Guillermo Martínez Mora"); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;//Guillermo Martinez    
    
        case 10:
             $tema= utf8_decode("Zapopan"); $subtema="";
             ArmaPdf($query,$tema,$subtema);
        break;//Zapopan    
        
        case 13: // PRIMERAS PLANAS
             $tema="PRIMERAS PLANAS Jalisco";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break; //PP Jalisco
    
        case 14: // PRIMERAS PLANAS
             $tema="Opinion Jalisco";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break; //Columnas Jalisco
    
        case 16: // PRIMERAS PLANAS
             $tema="PRIMERAS PLANAS";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break; //PP DF
        case 17:
             $tema="COLUMNAS POLITICAS";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;  //Politicas DF
        case 18:
             $tema="COLUMNAS FINANCIERAS ";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break; //Financieras DF
        default:            
        break;
    }
}else{
    
}
        

function ArmaPdf($query,$tema,$subtema){  
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

                      $pdf->Image('prijalisco.png',5,81,50); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa(date('Y-m-d')));   
        //
        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j]))
                {
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                      $pdf->Rect(0, 0, 250, 18, 'F');


                      //rentangulo Azul
                      $pdf->SetFillColor(0, 191, 255);
                      $pdf->Rect(0, 10, 155, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 18);
                      $pdf->Text(10,18,$estados[$j]." | ".strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->Text(150,8,$tema);
                       $pdf->Image('prijalisco.png',5,320,30); 
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(152,13,mostrar_fecha_completa(date('Y-m-d')));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 15,30,185);
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
        
        echo  "<br><br>" .mysql_error()."<br> ";
    }
    $periodico=array();
    $seccion=array();
    $estados=array();
    mysql_close();

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