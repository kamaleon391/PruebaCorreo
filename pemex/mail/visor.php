<?php
require_once('./fpdf17/fpdf.php');
require_once('./FPDI-1.4.4/fpdi.php');
$tplIdx="../../../2014/Intranet/Periodicos/El milenio Nacional/2014-03-10/Politica/Politica_12.pdf";
   $pdf = new FPDI('P','mm','A4');
       $pdf->addPage();
                      $pageCount = $pdf->setSourceFile($tplIdx);
                      $tplIdx = $pdf->importPage(1);
                
                      //rectangulo GRis
                      $pdf->SetFillColor(0,0,0);
                       $pdf->Rect(0, 0, 250, 10, 'F');


                     
                  
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(168,5,"WWW.ADMONITOR.MX");
                       $pdf->SetFont("arial", "B", 7);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(175,8,"Decisiones Inteligentes");
                      
                       $pdf->Image('stps/logopdf.png',5,340,30); 
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);  
         */
                       $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 0, 50, 10, 'F');


                     
                       
                      $pdf->SetFont("arial", "B",20);
                      $pdf->setTextColor( );
                      $pdf->Text(5,8,date('Y-m-d'));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,10,150);
                       $pdf->Output($tema.$subtema.".pdf", 'I');  
?>