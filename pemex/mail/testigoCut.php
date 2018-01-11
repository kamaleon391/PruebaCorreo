<?php
$data=array();
$i=0;
foreach ($_GET as $value) {
   $data[$i]=$value;
   $i++;
}
$cliente=$data[0];
$fecha=$data[1];
$id=$data[2];



    //ArmaPdf(4552735,"SCT","2014-11-19"); 
    ArmaPdf($id,$cliente,$fecha); 
    //ArmaPdf(4552368,"SCT","2014-11-19"); 

function ArmaPdf($id,$cliente,$fecha){  
require_once('./fpdf17/fpdf.php');
require_once('./FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
require 'conexion.php';


       $FechaCliente = strtotime($fecha);
        
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);
            
        if ($FechaCliente == $fecha_actual)
        {
            $Tabla="noticiasDia";
        }
        else
        {
            $Tabla="noticiasSemana";
        }
    $sql="SELECT n.idEditorial,
	   n.Periodico as 'idPeriodico',
	   p.Nombre as 'periodico',
           n.Seccion,
           s.seccion,
           n.Categoria as 'Num.Categoria',
           c.Categoria as 'Categoria',
           n.NumeroPagina,
           n.Autor,
           n.Fecha,
           n.Hora,
           n.Titulo,
           n.Encabezado,
           n.Texto,
           n.PaginaPeriodico,
	   e.Nombre as 'Estado'
	   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
	   WHERE p.idPeriodico=n.Periodico AND
	   p.idPeriodico=o.periodico AND
	   s.idSeccion=n.Seccion AND
	   c.idCategoria=n.Categoria AND
	   p.estado=e.idEstado AND
	   n.idEditorial=$id";
    $data=  mysql_query($sql);
    if(mysql_affected_rows()>0)
    {
        $i=0;//Contador de Paginas
        $periodico=array();
        $seccion=array();
        $estados=array();
        $j=0;
        $fecha;
        $pagina;
        $id="";
        while ($row = mysql_fetch_array($data)){
              $id=$row['idEditorial'];
              $fecha=$row['Fecha'];
              $pagina=$row['PaginaPeriodico'];
              $periodico[$i] = $row['periodico'];
              $seccion[$i] = $row['seccion'];
              $estados[$i] = $row['Estado'];
            $i++;
        }
        
        $pdf->addPage();
        $pdf->Ln();
        $pdf->SetFont("arial", "B", 11);
        
        $pdf->setTextColor(0);
        if(file_exists('/var/www/Imagenes/periodicos/portadas/'.ucwords($periodico[0]).".png")){
            $pdf->Image('/var/www/Imagenes/periodicos/portadas/'.ucwords($periodico[0]).".png",70,15,80); 
        }
        $pdf->Ln(2);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(200, 5,"Fecha : ". utf8_decode(mostrar_fecha_completa($fecha))." |     Seccion : ".$seccion[0]."     |      Pagina : ".$pagina,1, 1, 'L', true);
        //$pdf->Cell(200, 5,"Periodico : ".$periodico[0],0, 1, 'L', true);
        $pdf->SetFillColor(255);
        
        
        $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg",5,45);
        
        $logo="".$cliente."/logo.png";
        
        $pdf->Image($logo,5,320,50);
        $pdf->Image($logo,150,320,50);
        //$pdf->Output($cliente.".pdf", 'D');   
        $pdf->Output($cliente.".pdf", 'D');   
    }
    else{
        echo "<script>console.log('Cliente : ".$cliente."');</script>";
        echo "<script>console.log('fecha : ".$fecha."');</script>";
        echo "<script>console.log('id : ".$id."');</script>";
        echo "<script>alert('Detectamos un Problema por favor reportalo a : edgarh@gacomunicacion.com');</script>";
    }
    $periodico=array();
    $seccion=array();
    $estados=array();
    mysql_close();

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
         $dia_sem3='Miércoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='Sábado'; 
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