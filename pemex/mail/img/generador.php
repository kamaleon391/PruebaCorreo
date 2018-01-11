<?php
include '../../php/conexion.php';

 $query="SELECT c.periodico,c.nseccion,c.categoria,c.marca,c.fecha,c.TextoOferta,c.Color,c.Producto, 
		c.Medida,
                CONCAT('../../../../2014/Intranet/Periodicos/',c.Periodico,'/',DATE_FORMAT(c.Fecha, '%Y-%m-%d'),'/',c.Seccion,'/',c.Seccion,'_',c.NumeroPagina,'.pdf') AS pdf ,
                CONCAT('../../../../2014/Intranet/Periodicos/',c.Periodico,'/',DATE_FORMAT(c.Fecha, '%Y-%m-%d'),'/',c.Seccion,'/',c.Seccion,'_',c.NumeroPagina,'.jpg') AS pdfimg 
                  FROM comercialdia c WHERE c.periodico in(SELECT nombre FROM periodicos WHERE estado like 'Jalisco') ";
     $data=  mysql_query($query);
     
while ($row = mysql_fetch_array($data)) {
    $pdf=$row['pdf'];  
    $pdfimg=$row['pdfimg']; 
 if(file_exists($pdf))
     {
        if(file_exists($pdfimg))
        {
             echo "<span style='color:green;'>Ya esta Creado Archivo:</span> <a href='".$pdfimg."' target='_black'>$pdfimg</a><br>";   
        }else{
            
             $pathORiginal=$pdf;
             $im = new imagick($pathORiginal);
             $im->setImageFormat( "jpg" );
             $im->writeimage($pdfimg);
           
            echo "<span style='color:Yellow;'>Se creo el Archivo</span><a href='".$pdfimg."' target='_black'>$pdfimg</a><br>";   
        }
         
     }else{
          echo "<span style='color:red;'>No esta en INTRANET:</span> <a href='".$pdfimg."' target='_black'>$pdfimg</a><br>";   
     }
}

?>