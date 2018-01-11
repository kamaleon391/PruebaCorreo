<? 

require'../../php/conexion.php';

$query="SELECT c.periodico,c.nseccion,c.categoria,c.marca,c.fecha,c.TextoOferta,c.Color,c.Producto, 
		c.Medida,
                CONCAT('../../../../',DATE_FORMAT(c.Fecha, '%Y'),'/Intranet/Periodicos/',c.Periodico,'/',DATE_FORMAT(c.Fecha, '%Y-%m-%d'),'/',c.Seccion,'/',c.Seccion,'_',c.NumeroPagina,'.pdf') AS pdf ,
                CONCAT('../../../../',DATE_FORMAT(c.Fecha, '%Y'),'/Intranet/Periodicos/',c.Periodico,'/',DATE_FORMAT(c.Fecha, '%Y-%m-%d'),'/',c.Seccion,'/',c.Seccion,'_',c.NumeroPagina,'.jpg') AS pdfimg 
                  FROM comercialdia c WHERE c.periodico in(SELECT nombre FROM periodicos WHERE estado like'Jalisco') LIMIT 0,20";
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
function creada($id){
require'../../php/conexion.php';    
$query="SELECT idAnuncio FROM comecialconversorimagen WHERE idAnuncio=$id";
$data=  mysql_query($query);
if($data){
    
}else{
    $sql="INSERT INTO comecialconversorimagen (idAnuncio, estatus)
            VALUES (id, value3,...)";
}
/*$sql="INSERT INTO comecialconversorimagen (idAnuncio, estatus)
            VALUES (id, value3,...)";
  *7  
}
  //  $im = new imagick($pdf2);
  //  $im->setImageFormat( "jpg" );
                          // header( "Content-Type: image/jpeg" );
                            //echo $im;
  //$im->writeimage($path);


?>