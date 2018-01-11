<?php

error_reporting(E_ALL);

// Notificar todos los errores de PHP
error_reporting(-1);

include "/var/www/external/services/mail/conexion.php";
include "/var/www/external/services/mail/common.php";

function testigo($sql, $pdf_testigo)
{
  static $ids_Array = Array();

  mysql_query("set names 'utf8'");
  $data =  mysql_query($sql);

  if(mysql_affected_rows()>0)
  {
      while ($row = mysql_fetch_array($data)) 
      {
        if(!in_array($row['pdf'],$pdf_testigo))
        {       
            $ids_Array[] = $row['idEditorial'];
            $pdf_testigo[] = $row['pdf'];
        }
      }
  }

  return $pdf_testigo;
  
}

$pdf_testigo = Array();


require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');

//PRIMERAS PLANAS

  $sql = "SELECT 
  DISTINCT(n.idEditorial), 
  p.Nombre AS 'Periodico', 
  n.Fecha, 
  n.Titulo,
  s.seccion AS 'Seccion', 
  n.PaginaPeriodico, 
  n.NumeroPagina as 'PaginaPDF', 
  REPLACE(n.Texto,'\n',' ') Texto,
  CONCAT('/var/www/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , 
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg', 
  e.Nombre AS 'Estado',
  n.Autor,
  n.Periodico AS 'idPeriodico',
  n.Encabezado
  FROM 
(SELECT Periodico,idEditorial,Titulo,Fecha,PaginaPeriodico,Seccion,Categoria,Autor,Texto,NumeroPagina,Encabezado,PieFoto,Activo FROM noticiasDia WHERE Fecha BETWEEN '2015-04-06' AND CURDATE()
  UNION ALL
 SELECT Periodico,idEditorial,Titulo,Fecha,PaginaPeriodico,Seccion,Categoria,Autor,Texto,NumeroPagina,Encabezado,PieFoto,Activo FROM noticiasSemana WHERE Fecha BETWEEN '2015-04-06' AND CURDATE()) n,
      periodicos p, 
      ordenGeneral o,
      seccionesPeriodicos s,
      categoriasPeriodicos c,
      estados e
  WHERE 
   e.idEstado=p.Estado AND
      p.idPeriodico=n.Periodico AND
      p.idPeriodico=o.periodico AND
      s.idSeccion=n.Seccion AND
      c.idCategoria=n.Categoria AND
      n.Activo = 1 AND
         (
          Texto like '%15 policias%' OR
          Texto like '%15 muertos%' 
        ) AND
      fecha BETWEEN '2015-04-06' AND CURDATE()
  ORDER BY o.posicion";

$pdf_testigo = testigo($sql, $pdf_testigo);

if( !empty($pdf_testigo) )
{
    $pdf->setFiles( $pdf_testigo );  
    $pdf->concat();

    $nombre = "/var/www/external/testigos/Jalisco/TestigosMediosJalisco/TestigosFuerzaUnica.pdf";

    $pdf->Output($nombre, 'F'); 
}
?>
