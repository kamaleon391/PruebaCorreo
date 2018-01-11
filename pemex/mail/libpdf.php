<?php

/*
$pageCount = $pdf->setSourceFile("Alfrente_2.pdf");
$tplIdx = $pdf->importPage(1, '/MediaBox');

$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 90);
*/

$query = "SELECT e.idEditorial,e.Periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf, 
        CONCAT(e.Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS jpg,
        p.estado
        FROM editorialdia e, periodicos p 
       	WHERE(
        Texto like '%STPS%' OR
        Texto like '%STPyS%' OR
        Texto like '%STyPS%' OR
        Texto like '%secretaria del trabajo y prevision social%' OR
        Texto like '%STPS%' OR
        Texto like '%secretaria del trabajo estatal%' OR
        Texto like '%secretaria del trabajo%' OR
        Texto like '%secretaria de trabajo%' OR
        Texto like '%secretariadeltrabajo%' OR
        Texto like '%secretarias del trabajo%' OR
        
        Titulo like '%STPS%' OR
        Titulo like '%STPyS%' OR
        Titulo like '%STyPS%' OR
        Titulo like '%secretaria del trabajo y prevision social%' OR
        Titulo like '%STPS%' OR
        Titulo like '%secretaria del trabajo estatal%' OR
        Titulo like '%secretaria del trabajo%' OR
        Titulo like '%secretaria de trabajo%' OR
        Titulo like '%secretariadeltrabajo%' OR
        Titulo like '%secretarias del trabajo%' OR
        
        
        Encabezado like '%STPS%' OR
        Encabezado like '%STPyS%' OR
        Encabezado like '%STyPS%' OR
        Encabezado like '%secretaria del trabajo y prevision social%' OR
        Encabezado like '%STPS%' OR
        Encabezado like '%secretaria del trabajo estatal%' OR
        Encabezado like '%secretaria del trabajo%' OR
        Encabezado like '%secretaria de trabajo%' OR
        Encabezado like '%secretariadeltrabajo%' OR
        Encabezado like '%secretarias del trabajo%'
       ) AND Texto not like '%Elizondo%'
       AND e.periodico=p.nombre AND p.circulacion=0 order by p.estado, p.nombre";
        
    ArmaPdf($query);






/*




//
for($i=0;$i<10;$i++){
 
    $pageCount = $pdf->setSourceFile("Alfrente_2.pdf");
$tplIdx = $pdf->importPage(1, '/MediaBox');

$pdf->addPage();$pdf->SetFont("arial", "B", 14);
$pdf->Text(10,10,'Some text here');
//$pdf->addPage('L'); //landscape
$pdf->useTemplate($tplIdx, 20, 5,170);
}
*/
//

//$pdf->Output();
 
function ArmaPdf($query){
require_once('./fpdf17/fpdf.php');
require_once('./FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
     require '../php/conexion.php';
    
    
    $data=  mysql_query($query);
     $i=0; $periodico=array();  $seccion=array();
    while ($row = mysql_fetch_array($data)) {
         $variable[$i] = $row['pdf'];
          $periodico[$i] = $row['Periodico'];
          $seccion[$i] = $row['Seccion'];
        $i++;
    }
    $j=0;
    
    for($j=0;$j<sizeof($periodico);$j++){
       if(file_exists($variable[$j])){
             $pageCount = $pdf->setSourceFile($variable[$j]);
             $tplIdx = $pdf->importPage(1, '/MediaBox');
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
             $pdf->SetFont("arial", "", 9);
             $pdf->setTextColor(128);
             $pdf->Text(135,8,'Secretario Del Trabajo |');
 
               $pdf->SetFont("arial", "", 9);
             $pdf->setTextColor();
             $pdf->Text(170,8,'Alfonso Navarrete Prida');  
              
             

//$pdf->Line(110, 235, 115, 240);
//$pdf->SetXY(115, 240);
//$pdf->Cell(15, 6, '110, 235', 0 , 1);
             
             
             $pdf->SetFont("arial", "B",12);
             $pdf->setTextColor();
             $pdf->Text(182,13,date('Y-m-d'));   
             //$pdf->WriteHTML($html);
             //$pdf->addPage('L'); //landscape
             $pdf->useTemplate($tplIdx, 20,30,160);
         }else{ }  
    }
    
    /*
    foreach ($variable as $pdfAux) {
        if(file_exists($pdfAux)){ 
             $pageCount = $pdf->setSourceFile($pdfAux);
             $tplIdx = $pdf->importPage(1, '/MediaBox');
             $pdf->addPage();$pdf->SetFont("arial", "B", 14);
             $pdf->Text(165,18,ucfirst($periodico[$j]));
             
             
 
             //$pdf->WriteHTML($html);
             //$pdf->addPage('L'); //landscape
             $pdf->useTemplate($tplIdx, 10,30,190);
         }else{ }
         $j++;
      //  echo $pdfAux;
    }
     * 
     */
    $pdf->Output();

}

?>