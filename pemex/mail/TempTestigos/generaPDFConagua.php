<?php


    include '/var/www/external/services/mail/TempTestigos/querysConagua.php';

    for($opc = 1;$opc <=5; $opc++)
    {
      $valor=$opc;
      //$fecha = date('Y-m-d');
      $fecha = "2014-12-27";
      $estado="";
      $opcion="";
      if($valor == 5)
      {
        for($estado=1; $estado<=32; $estado++)
        {
          if($estado==14)
          {
            for($opcion=1; $opcion<=4; $opcion++)
            {
              $query=query($valor,$fecha,$estado,$opcion);

              $tema="CONAGUA";
              ArmaPdfConagua($query,$tema,$fecha,$opcion);
            }
          }
          else
          {
            $query=query($valor,$fecha,$estado,$opcion);

            $tema="CONAGUA";
            ArmaPdfConagua($query,$tema,$fecha,$opcion);
          }
        }
      }
      else
      {
        $query=query($valor,$fecha,$estado,$opcion);

        switch ($valor) {
        case 1: // PRIMERAS PLANAS
             $tema="";$subtema="PRIMERAS PLANAS";
             ArmaPdf($query,$tema,$subtema,$fecha);
            break;
        case 2:
             $tema=" ";$subtema=" COLUMNAS POLITICAS";
             ArmaPdfColumnas($query,$tema,$subtema,$fecha);
            break;
        default:
        case 3:
             $tema="";$subtema=" COLUMNAS FINANCIERAS";
             ArmaPdfColumnas($query,$tema,$subtema,$fecha);
            break;
        case 4:
             $tema="";$subtema=" CARTONES";
             ArmaPdfColumnas($query,$tema,$subtema,$fecha);
            break;  
       
        default:            
            break;

      }
    }
}



function ArmaPdf($query,$tema,$subtema,$fecha){  
require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
require "/var/www/external/services/mail/conexion.php";

$antigua = umask(0);
    if(is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
    }
    else{
        mkdir("/var/www/external/testigos/Conagua/".$fecha,0777,true);
        chmod("/var/www/external/testigos/Conagua/".$fecha,0777);
        umask($antigua);
    }   
    
    
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$j=0;
        while ($row = mysql_fetch_array($data)) {
             $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['periodico'];
              $seccion[$i] = $row['Seccion'];
            $i++;
        }
        $pdf->addPage();
                    //Recuadro Gris Inferior
                    $pdf->SetFillColor(245,245,245);
                    $pdf->Rect(0, 131, 250, 40, 'F');
                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,146,$subtema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");

                      $pdf->Image('/var/www/external/services/mail/TempTestigos/coangua.jpg',5,100,100); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa($fecha));
                      
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
                      $pdf->Text(170,8,$tema.$subtema);
                       $pdf->Image('/var/www/external/services/mail/TempTestigos/coangua.jpg',5,340,30); 
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);  
         */
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(182,13,$fecha);   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }else{ }  
             }
             $nombre = "/var/www/external/testigos/Conagua/".$fecha."/".$tema.$subtema."-".$fecha.".pdf";
        $pdf->Output($nombre, 'F');   
    }

}

function ArmaPdfColumnas($query,$tema,$subtema,$fecha){  
require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
    require "/var/www/external/services/mail/conexion.php";
    
    $antigua = umask(0);
    if(is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
    }
    else{
        mkdir("/var/www/external/testigos/Conagua/".$fecha,0777,true);
        chmod("/var/www/external/testigos/Conagua/".$fecha,0777);
        umask($antigua);
    } 
    
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
                    //Recuadro Gris Inferior
                    $pdf->SetFillColor(245,245,245);
                    $pdf->Rect(0, 131, 250, 40, 'F');
                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,146,$subtema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");

                      $pdf->Image('/var/www/external/services/mail/TempTestigos/coangua.jpg',5,100,100); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa($fecha));
                      
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
                     $pdf->Text(182,13,$fecha);  
                     $pdf->Image('/var/www/external/services/mail/TempTestigos/coangua.jpg',5,340,30); 
                     //$pdf->WriteHTML($html);
                     //$pdf->addPage('L'); //landscape
                     $pdf->useTemplate($tplIdx, 20,30,160);
                 }else{ }  
                }
         $nombre = "/var/www/external/testigos/Conagua/".$fecha."/".$tema.$subtema."-".$fecha.".pdf";
        $pdf->Output($nombre, 'F');   
    }
}

function ArmaPdfConagua($query,$tema,$fecha,$opcion){  
require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
require "/var/www/external/services/mail/conexion.php";
    
    
$antigua = umask(0);
    if(is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
    }
    else{
        mkdir("/var/www/external/testigos/Conagua/".$fecha,0777,true);
        chmod("/var/www/external/testigos/Conagua/".$fecha,0777);
        umask($antigua);
    } 

     $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$Estado=array();$j=0;
        while ($row = mysql_fetch_array($data)) {
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['Periodico'];
              $seccion[$i] = $row['Seccion'];
              $tem[$i]=$row['Tema'];
              $Estado[$i]=$row['estado'];
            $i++;
        } 
        $pdf->addPage();
                    //Recuadro Gris Inferior
                    $pdf->SetFillColor(245,245,245);
                    $pdf->Rect(0, 131, 250, 40, 'F');
                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,146,$tema);
                      $pdf->Text(10,160,$Estado[0]);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");

                      $pdf->Image('/var/www/external/services/mail/TempTestigos/coangua.jpg',5,100,100); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa($fecha));
        
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
                      $pdf->Rect(0, 10, 145, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 20);
                      $pdf->Text(5,18,$Estado[0]."|");
                      $pdf->SetFont("arial", "B", 18);
                      $pdf->Text(60,18,strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(5,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->Text(150,7,"Tema : ".$tem[$j]);
                      $pdf->Text(150,12,"Estado : ".$Estado[0]);
                       $pdf->Image('/var/www/external/services/mail/TempTestigos/coangua.jpg',5,340,30);
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(150,17,mostrar_fecha_completa($fecha));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }else{ }  
             }
             if($Estado[0]=="Jalisco")
             {
              $nombre = "/var/www/external/testigos/Conagua/".$fecha."/".$tema."-".$Estado[0]." Parte ".$opcion."-".$fecha.".pdf";
             }
             else
             {
              $nombre = "/var/www/external/testigos/Conagua/".$fecha."/".$tema."-".$Estado[0]."-".$fecha.".pdf";
             }
        
        $pdf->Output($nombre, 'F');   
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