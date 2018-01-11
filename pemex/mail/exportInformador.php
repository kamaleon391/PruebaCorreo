<?php

if(isset($_GET['p']) && isset($_GET['f'])){
    include './querysInformador.php';
     // $fecha=base64_decode(base64_decode($_GET['f'])); 
       $valor=base64_decode(base64_decode($_GET['p'])); 
       $query=query($valor, $_GET['f']);
      //$tabla=defineFecha($fecha);
      
    switch ($valor)
    {
        case 1: // PRIMERAS PLANAS
             $tema="PRIMERAS PLANAS DF";$subtema=" ";
             //ArmaPdf($query,$tema,$subtema);
            ArmaPortada($tema,$subtema);
        break;
    
        case 2:
             $tema="PRIMERAS PLANAS";$subtema="Gratuitos";
             ArmaPdf($query,$tema,$subtema);
        break;
    
        case 3:
             $tema="Portadas Jalisco";$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
        break;
    
        case 4:
              $tema="Portadas Jalisco";$subtema="Gratuitos ";
             ArmaPdfColumnas($query,$tema,$subtema);
        break; 
    
        case 5:
              $tema="Columnas Politicas";$subtema="Gratuitos ";
             ArmaPdfColumnas($query,$tema,$subtema);
        break; 
    }
    
}
else{
    
}

function ArmaPdf($query,$tema,$subtema){  
require_once('./fpdf17/fpdf.php');
require_once('./FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
require '../php/conexion.php';
    
    //echo $query;
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$j=0;
        while ($row = mysql_fetch_array($data)){
            $variable[$i] = $row['pdf'];
            $periodico[$i] = $row['periodico'];
            $seccion[$i] = $row['Seccion'];
            $i++;
        } 
        
        //
        $pdf->addPage();

        //rectangulo GRis ABAJO
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 131, 250, 40, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 40);
        $pdf->Text(10,156,$tema);
        $pdf->SetFont("arial", "B", 13);
        $pdf->setTextColor(255,255,255);
        $pdf->Text(10,23,"test");

        $pdf->Image('informador/logopdf.png',5,100,100); 
        $pdf->SetFont("arial", "B",15);
        $pdf->setTextColor();
        $pdf->Text(140,177,mostrar_fecha_completa(date('Y-m-d')));   
        for($j=0;$j<sizeof($periodico);$j++){
            if(file_exists($variable[$j])){
                      $pageCount=$pdf->setSourceFile($variable[$j]);
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
                      $pdf->Text(170,8,$tema);
                      $pdf->Image('informador/logopdf.png',5,340,30); 
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(182,13,date('Y-m-d'));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                }
        }
        $pdf->Output($tema.$subtema.".pdf", 'D');
    }
    else{
        
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
        
        echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
    }
}
function ArmaPdfColumnas($query,$tema,$subtema){  
require_once('./fpdf17/fpdf.php');
require_once('./FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
     require '../php/conexion.php';
    
    
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0){
         $i=0; $periodico=array();  $seccion=array(); $j=0;
         while ($row = mysql_fetch_array($data)) {
                 $variable[$i] = $row['pdf'];
                  $periodico[$i] = $row['periodico'];
                  $seccion[$i] = substr($row['Titulo'], 0, 45);
                $i++;
            }
         $pdf->addPage();

                    //rectangulo GRis ABAJO
                      $pdf->SetFillColor(245,245,245);
                      $pdf->Rect(0, 131, 250, 40, 'F');

                     


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 40);
                      $pdf->Text(10,156,$tema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,"test");

                      $pdf->Image('informador/logopdf.png',5,100,100); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(140,177,mostrar_fecha_completa(date('Y-m-d')));   
            
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
                     $pdf->setTextColor(128);
                     $pdf->Text(150,8,$tema);
                     $pdf->SetFont("arial", "", 9);
                     $pdf->setTextColor();
                     $pdf->Text(170,8,$subtema);  
                     $pdf->SetFont("arial", "B",12);
                     $pdf->setTextColor();
                     $pdf->Text(182,13,date('Y-m-d'));  
                     $pdf->Image('informador/logopdf.png',5,340,30); 
                     //$pdf->WriteHTML($html);
                     //$pdf->addPage('L'); //landscape
                     $pdf->useTemplate($tplIdx, 20,30,160);
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
        $pdf->Image('salud/logopdf.png',5,10,80);
        $pdf->Output(utf8_decode($tema).$subtema.".pdf", 'D');   */
        
        echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
    }
    

}
function ArmaPortada($tema,$subtema)
{
    require_once('./fpdf17/fpdf.php');
    require_once('./FPDI-1.4.4/fpdi.php');
 
    $pdf = new FPDI('P','mm','legal');
    require '../php/conexion.php';
    
    $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                            CONCAT('../../../testigos/Informador/Portadas/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/Nacionales/',e.Periodico,'_',e.NumeroPagina,'.jpg') AS pdfimg,
                            p.estado,
                            p.gratuito,
                            o.posicion
                            FROM editorialdia e, ordenpersonalizado o, periodicos p
                            WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                            AND e.periodico IN (SELECT periodico FROM ordenpersonalizado op) AND e.fecha='$_GET[f]' AND
                            p.gratuito=0
                            GROUP BY e.Periodico
                            ORDER BY 9,11";
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$j=0;
        while ($row = mysql_fetch_array($data)){
            $variable[$i] = $row['pdfimg'];
            $periodico[$i] = $row['periodico'];
            $seccion[$i] = $row['Seccion'];
            $i++;
        } 
        
        //
        $pdf->addPage();

        //rectangulo GRis ABAJO
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 131, 250, 40, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 40);
        $pdf->Text(10,156,$tema);
        $pdf->SetFont("arial", "B", 13);
        $pdf->setTextColor(255,255,255);
        $pdf->Text(10,23,"test");

        $pdf->Image('informador/logopdf.png',5,100,100); 
        $pdf->SetFont("arial", "B",15);
        $pdf->setTextColor();
        $pdf->Text(140,177,mostrar_fecha_completa(date('Y-m-d')));   
        for($j=0;$j<sizeof($periodico);$j++){
            if(file_exists($variable[$j])){
                      $pageCount=$pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->Image($variable[$j]);
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
                      $pdf->Text(170,8,$tema);
                      $pdf->Image('informador/logopdf.png',5,340,30); 
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(182,13,date('Y-m-d'));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                }
                else{
                    echo $variable[$j]."<br>";
                }
        }
        $pdf->Output($tema.$subtema.".pdf", 'D');
    }
    else{
        
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
        
        echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
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