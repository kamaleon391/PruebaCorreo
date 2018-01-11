<?php


  require_once('./fpdf17/fpdf.php');
 require_once('./FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('L','mm','legal');
require '../php/conexion.php';


  $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,p.estado
                       FROM editorialdia e, periodicos p,ordenpersonalizadojalisco o
                        WHERE (
                                Texto like '%secretaria de salud%' OR
                                Texto like '%influenza%' OR
                                Texto like '%salud jalisco%' OR
                                Texto like '% SSJ %' OR
                                Texto like '% virus %' OR
                                Texto like '%embarazo en adolescentes%' OR
                                Texto like '% h1n1 %' OR
                                Texto like '% la cepa %' OR
                                Texto like '%salud publico%' OR
                                Texto like '%jorge Blackaller%' OR
                                Texto like '%jorge Blackaller ayala%' OR
                                Texto like '% ssa %' OR
                                Texto like '%A/H1N1%' OR
                                Texto like '%DGE%' OR
                                Texto like '%direccion general de epidemiologia%' OR
                                Texto like '%DGE%' OR
                                Texto like '%A/H3N2%' OR
                                Texto like '%secretaria de salud federal%' OR
                                Texto like '% intoxicados %' OR
                                Texto like '%anfetaminas%' OR
                                Texto like '%metanfetaminas%' OR

                                Titulo like '%secretaria de salud%' OR
                                Titulo like '%influenza%' OR
                                Titulo like '%salud jalisco%' OR
                                Titulo like '% SSJ %' OR
                                Titulo like '% virus %' OR
                                Titulo like '%embarazo en adolescentes%' OR
                                Titulo like '% h1n1 %' OR
                                Titulo like '% la cepa %' OR
                                Titulo like '%salud publico%' OR
                                Titulo like '%jorge Blackaller%' OR
                                Titulo like '%jorge Blackaller ayala%' OR
                                Titulo like '% ssa %' OR
                                Titulo like '%A/H1N1%' OR
                                Titulo like '%DGE%' OR
                                Titulo like '%direccion general de epidemiologia%' OR
                                Titulo like '%DGE%' OR
                                Titulo like '%A/H3N2%' OR
                                Titulo like '%secretaria de salud federal%' OR
                                Titulo like '% intoxicados %' OR
                                Titulo like '%anfetaminas%' OR
                                Titulo like '%metanfetaminas%' OR

                                Encabezado like '%secretaria de salud%' OR
                                Encabezado like '%influenza%' OR
                                Encabezado like '%salud jalisco%' OR
                                Encabezado like '% SSJ %' OR
                                Encabezado like '% virus %' OR
                                Encabezado like '%embarazo en adolescentes%' OR
                                Encabezado like '% h1n1 %' OR
                                Encabezado like '% la cepa %' OR
                                Encabezado like '%salud publico%' OR
                                Encabezado like '%jorge Blackaller%' OR
                                Encabezado like '%jorge Blackaller ayala%' OR
                                Encabezado like '% ssa %' OR
                                Encabezado like '%A/H1N1%' OR
                                Encabezado like '%DGE%' OR
                                Encabezado like '%direccion general de epidemiologia%' OR
                                Encabezado like '%DGE%' OR
                                Encabezado like '%A/H3N2%' OR
                                Encabezado like '%secretaria de salud federal%' OR
                                Encabezado like '% intoxicados %' OR
                                Encabezado like '%anfetaminas%' OR
                                Encabezado like '%metanfetaminas%'
                                )
                        AND
                        e.periodico=p.nombre AND 
                        e.periodico=o.periodico AND 
                        p.estado like 'Jalisco' AND
                        p.Tipo=0
                        GROUP BY e.periodico, e.NumeroPagina
                        ORDER BY o.posicion";
  
$tema="Seguro Popular Jalisco";    

    
    
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$j=0;
        while ($row = mysql_fetch_array($data)) {
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['periodico'];
              $estado[$i] = $row['estado'];
              $seccion[$i] = $row['Seccion'];
              $titulo[$i] = $row['Titulo'];
              $texto[$i] = $row['Texto'];
            $i++;
        } 
        
        //
        $pdf->addPage();

                    //rectangulo GRis ABAJO
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 131, 355, 40, 'F');

                     


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 20);
                      $pdf->Text(10,156,strtoupper($tema));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,"test");
                       $pdf->Image('img/LogoSalud.jpg',125,70,100);

                       $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      //$pdf->Text(230,177,mostrar_fecha_completa(date('Y-m-d')));
                      $pdf->SetY(177);
                      $pdf->Cell(0,0,mostrar_fecha_completa(date('Y-m-d')),0,0,R);   
        //
        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j])){
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(150, 0, 250, 18, 'F');


                      //rentangulo Verde
                      $pdf->SetFillColor(0,120,72);
                      $pdf->Rect(150, 10, 140, 15, 'F');

                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 20);
                      $pdf->Text(150,18,strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(150,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->Text(310,8,$tema);
                      
                      //rentangulo gris nota
                      $pdf->SetFillColor(245,245,245);
                      $pdf->Rect(150, 30, 200, 165, 'F');
                      
                      //Titulo
                      $pdf->SetXY(150,33);
                      $pdf->SetFillColor();
                       $pdf->SetFillColor(232, 232, 232);
                       $pdf->SetFont("arial","B",12);
                      $pdf->MultiCell(0,6,ucwords(strtolower(sanear_string(substr($titulo[$j],0,100)))),0,'',TRUE);
                       $pdf->SetFont();
                       
                       //Periodico-Estado
                       $pdf->SetXY(150,45);
                       $pdf->SetFont("arial","",12);
                      $pdf->MultiCell(0,6,$periodico[$j]." | ".$estado[$j],0,'',FALSE);
                       $pdf->SetFont();
                       
                      //Texto
                      $pdf->SetXY(150,55);
                      $pdf->SetFillColor();
                      $pdf->SetFont("arial", "",9);
                      $pdf->SetFillColor(232, 232, 232);
                      $pdf->MultiCell(0,4,sanear_string(wordlimit($texto[$j])),0,'J',TRUE);
                      
                      
                       $pdf->Image('img/secretaria_de_salud.png',320,200,30); 
                       
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(315,13,date('Y-m-d'));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx,3,3,135);
                  }else{ }  
             }
        $pdf->Output($tema.date('Y-m-d').".pdf","D");   
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
function sanear_string( $string){
 
    $string =  trim($string);
 
    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�', '�'),
        array('�', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
   $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('�', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
   $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('�', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�', 'Ã³'),
        array('�', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'o'),
        $string
    );
 
   $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('�', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
   $string = str_replace(
        array('�','�', '�', '�'),
        array('�', 'N', 'c', 'C',),
        $string
    );
 
    //Esta parte se encarga de eliminar cualquier caracter extra�o
    $string = str_replace(
       array("\n","\\", "�", "�", "-", "~",
             "#", "@", "|", "!", "\"",
             "�", "$", "%", "&", "/",
             "(", ")", "?", "'", "�",
             "�", "[", "^", "`", "]",
             "+", "}", "{", "�", "�",
             ">", "<", ";", ",", ":",
             ".", " ","√","√°","\n","¬",
            "Έ"," Ή","·","","●","","&","-","",'','  ','   '),
        ' ',
        $string
    );
 
 
    return $string;
    //return $string;
}
function wordlimit($string, $length = 900)
{
    $words = explode(' ', $string);
    if (count($words) > $length)
    {
            return implode(' ', array_slice($words, 0, $length))."...";
    }
    else
    {
            return $string;
    }
}
?>
