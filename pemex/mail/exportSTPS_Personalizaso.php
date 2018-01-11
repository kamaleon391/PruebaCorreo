<?php


$query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM noticiasSemana n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
			       p.Estado!=9 AND
                   fecha =DATE('2014-11-27') AND
                   (
                    Texto like '%Secretario Del Trabajo%' OR
                    Texto like '%Secretario De Trabajo%' OR
                    Texto like '%titular de la STPS%' OR
                    Texto like '%titular de la secretaria del trabajo y prevision social%' OR
                    Texto like '%Alfonso Navarrete Prida%' OR  
                    Texto like 'Alfonso Navarrete Prida' OR
                    Texto like '%Alfonso Navarrete%' OR    
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%varrete Prida%' OR
                    Texto like '%varretePrida%' OR
                    Texto like '%NavarretePrida%' OR
                    Texto like '%varrete P rid%' OR
                    Texto like '%varrete P rid a%' OR

                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Alfonso Navarrete%' OR
                    Titulo like 'Alfonso Navarrete Prida'  OR 
                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Navarrete Prida%' OR
                    Titulo like '%titular de la STPS%' OR
                    Titulo like '%varrete Prida%' OR
                    Titulo like '%varretePrida%' OR
                    Titulo like '%varrete P rid%' OR
                    Titulo like '%varrete P rid a%' OR

                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Alfonso Navarrete%' OR
                    Encabezado like 'Alfonso Navarrete Prida'  OR 
                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Secretario Del Trabajo%' OR
                    encabezado like '%Secretario Del Trabajo%' OR
                    Encabezado like '%Navarrete Prida%' OR
                    Encabezado like '%titular de la STPS%' OR
                    Encabezado like '%varrete Prida%' OR
                    Encabezado like '%varretePrida%' OR
                    Encabezado like '%varrete P rid%' OR
                    Encabezado like '%varrete P rid a%' OR
                    
                    PieFoto like '%Alfonso Navarrete Prida%' OR
                    PieFoto like '%Alfonso Navarrete%' OR
                    PieFoto like 'Alfonso Navarrete Prida'  OR 
                    PieFoto like '%Alfonso Navarrete Prida%' OR
                    PieFoto like '%Secretario Del Trabajo%' OR
                    PieFoto like '%Secretario Del Trabajo%' OR
                    PieFoto like '%Navarrete Prida%' OR
                    PieFoto like '%titular de la STPS%' OR
                    PieFoto like '%varrete Prida%' OR
                    PieFoto like '%varretePrida%' OR
                    PieFoto like '%varrete P rid%' OR
                    PieFoto like '%varrete P rid a%'
                   )AND (
                        ( (Texto like '%Alfonso%' AND Texto like '%Prida%') OR
                          (Texto like '%Secretario Del Trabajo%') OR
                          (Texto like '%Secretario De Trabajo%') OR
                          (Texto like '%Alfonso%' AND Texto like '%Navarrete%') OR 
                           Texto like '%titular de la STPS%') OR
                        ( (Titulo like '%Alfonso%' AND Titulo like '%Prida%') OR (Titulo like '%Alfonso%' AND Titulo like '%Navarrete%') OR Titulo like '%titular de la STPS%') OR
                        ( (Encabezado like '%Alfonso%' AND Encabezado like '%Prida%') OR (Encabezado like '%Alfonso%' AND Encabezado like '%Navarrete%') OR Encabezado like '%titular de la STPS%'))
ORDER BY p.Estado,p.Nombre";
        


ArmaPdf($query, "Alfonso Navarrete Prida", "");
function ArmaPdf($query,$tema,$subtema){  
require_once('./fpdf17/fpdf.php');
require_once('./FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
require 'conexion.php';
    
    
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

                      $pdf->Image('stps/logopdf.png',5,100,100); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa('2014-11-27'));   
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
                      $pdf->Rect(0, 10, 150, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 18);
                      $pdf->Text(10,18,$estados[$j]." | ".strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->Text(150,8,$tema);
                       $pdf->Image('stps/logopdf.png',5,340,30); 
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(145,13,mostrar_fecha_completa('2014-11-27'));   
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