<?php

if(isset($_GET['p']) && isset($_GET['f'])){
    include 'querysSagarpa.php';
    
$estados = array(1 => 'Aguascalientes',
    2 => 'Baja California',
    3 => 'Baja California Sur',
    4 => 'Campeche',
    5 => 'Coahuila',
    6 => 'Colima',
    7 => 'Chiapas',
    8 => 'Chihuahua',
    9 => 'Distrito Federal',
    10 => 'Durango',
    11 => 'Guanajuato',
    12 => 'Guerrero',
    13 => 'Hidalgo',
    14 => 'Jalisco',
    15 => 'Estado de México',
    16 => 'Michoacán',
    17 => 'Morelos',
    18 => 'Nayarit',
    19 => 'Nuevo Leon',
    20 => 'Oaxaca',
    21 => 'Puebla',
    22 => 'Queretaro',
    23 => 'Quintana Roo',
    24 => 'San Luis Potosi',
    25 => 'Sinaloa',
    26 => 'Sonora',
    27 => 'Tabasco',
    28 => 'Tamaulipas',
    29 => 'Tlaxcala',
    30 => 'Veracruz',
    31 => 'Yucatan',
    32 => 'Zacatecas');
                   
     

     // $fecha=base64_decode(base64_decode($_GET['f'])); 
      $valor=base64_decode(base64_decode($_GET['p'])); 
      $estado = 0;
      if(isset(  $_GET[ 'e' ] )) {
       $estado = $_GET['e'];
      }
      $query = query($valor, $_GET['f'], $estado);
      
    switch ($valor){
        case 1: // PRIMERAS PLANAS
             $tema="PRIMERAS PLANAS";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 2:
             $tema="COLUMNAS POLITICAS";$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
            break;
        case 3:
             $tema="COLUMNAS FINANCIERAS ";$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
            break;
        case 4:
             $tema="CARTONES";$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
            break;//Cartones  
        case 5:
             $tema="SECRETARIO SAGARPA - DF";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;//Navarrete   
        case 6:
             $tema=utf8_decode("SECRETARIO SAGARPA - ". $estados[$estado]); $subtema="  ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 7:
             $tema="SUBSECRETARIAS - DF";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;         
        case 8:
             $tema=utf8_decode("SUBSECRETARIAS - ". $estados[$estado]);$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;  
        case 9:
             $tema="FUNCIONARIOS - DF";$subtema="";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 10:
             $tema=utf8_decode("FUNCIONARIOS - ". $estados[$estado]);$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 11:
             $tema="DELEGACIONES - DF"; $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 12:
             $tema=utf8_decode("DELEGACIONES - ". $estados[$estado]); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 13:
             $tema="AGRICULTURA - DF";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 14:
             $tema=utf8_decode("AGRICULTURA - ". $estados[$estado]); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 15:
             $tema="GANADERIA - DF"; $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 16:
             $tema=utf8_decode("GANADERIA - ". $estados[$estado]); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 17:
             $tema="PESCA - DF"; $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 18:
             $tema=utf8_decode("PESCA - ". $estados[$estado]); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 19:
             $tema="CAMPO - DF"; $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 20:
             $tema=utf8_decode("CAMPO - ". $estados[$estado]); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 21:
             $tema="VARIOS - DF"; $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break; 
        case 22:
             $tema=utf8_decode("VARIOS - ". $estados[$estado]); $subtema=" ";
             ArmaPdf($query,$tema,$subtema);
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
    //echo $query;
    //var_dump($data);
    //echo gettype(var_dump($data));
    //var_dump("Affected: ".mysql_affected_rows() . " NUM ROWS: ".mysql_num_rows($data) . " DATA: ". $data. "TYPEOF: ". gettype($data) );
    //die("FIN");
    if(mysql_num_rows($data)>0 || $tema = 'SECRETARIO SAGARPA')
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
                      $pdf->setTextColor(0,0,0);
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,156,$tema." ".$subtema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");

                      $pdf->Image('logopdf.jpg',5,70,100); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor(0,0,0);
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
                      $pdf->Rect(0, 10, 170, 15, 'F');


                      $pdf->setTextColor(0,0,0);
                      $pdf->SetFont("arial", "B", 18);
                      $pdf->Text(10,18,$estados[$j]." | ".strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->Text( 75, 8, $tema );
                       $pdf->Image('logopdf.jpg',5,335,30); 
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(150,8,mostrar_fecha_completa(date('Y-m-d')));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
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
function ArmaPdfColumnas($query,$tema,$subtema){  
require_once('../fpdf17/fpdf.php');
require_once('../FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
     require '../conexion.php';
    
    
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0){
         $i=0; $periodico=array();  $seccion=array(); $j=0;
            while ($row = mysql_fetch_array($data)) {
                $variable[$i] = $row['pdf'];
                $periodico[$i] = $row['periodico'];
                $seccion[$i] = substr($row['Titulo'], 0, 45);
                $estados[$i] = $row['Estado'];
                $i++;
            }
            
            
                    //
        $pdf->addPage();
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 131, 250, 40, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 25);
        $pdf->Text(10,156,$tema);
        $pdf->SetFont("arial", "B", 13);
        $pdf->setTextColor(255,255,255);
        $pdf->Text(10,23,"test");

        $pdf->Image('logopdf.jpg',5,100,100); 
        $pdf->SetFont("arial", "B",15);
        $pdf->setTextColor();
        $pdf->Text(130,177,mostrar_fecha_completa(date('Y-m-d')));    
        
            
            for($j=0;$j<sizeof($periodico);$j++)
            {
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
                     $pdf->Rect(0, 10, 140, 15, 'F');
                     $pdf->setTextColor();
                     $pdf->SetFont("arial", "B", 20);
                     $pdf->Text(10,18,$estados[$j]." | ".strtoupper($periodico[$j]));
                     $pdf->SetFont("arial", "B", 13);
                     $pdf->setTextColor(255,255,255);
                     $pdf->Text(10,23,strtoupper($seccion[$j]));
                     $pdf->SetFont("arial", "B", 9);
                     $pdf->setTextColor(128);
                     $pdf->Text(150,8,$tema);
                     $pdf->SetFont("arial", "", 9);
                     $pdf->setTextColor();
                     $pdf->Text(170,8,$subtema);  
                     $pdf->SetFont("arial", "B",12);
                     $pdf->setTextColor();
                     $pdf->Text(182,13,date('Y-m-d'));  
                     $pdf->Image('logopdf.jpg',5,340,30); 
                     //$pdf->WriteHTML($html);
                     //$pdf->addPage('L'); //landscape
                     $pdf->useTemplate($tplIdx, 20,30,160);
                 }else{
                     $pdf->addPage();
                    $pdf->setTextColor();
                    $pdf->SetFont("arial", "B", 10);
                    $pdf->Text(10,156,"No se Encontro : ".$variable[$j]);
                 }  
                }
    $pdf->Output($tema.$subtema.".pdf", 'D'); 
    }else{
      /* 
       $pdf->addPage();
                      //rectangulo GRis
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 0, 250, 50, 'F'); 
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 30);
        $pdf->Text(10,180,strtoupper("NO SE ENCONTRARON RESULTADOS"));
        $pdf->Image('salud/logopdf.jpg',5,10,80);
        $pdf->Output(utf8_decode($tema).$subtema.".pdf", 'D');   */
        
        echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
    }
    

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
