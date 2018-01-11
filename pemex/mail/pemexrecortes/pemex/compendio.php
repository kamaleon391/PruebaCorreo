<?php 
	ignore_user_abort(true);
	set_time_limit(0);

	include "/var/www/external/services/mail/conexion.php";
	$fecha = date('Y-m-d');
	require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  		require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  		$query= "SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CREN as CREN,
	n.CostoNota,
	e.Nombre AS estado,
	CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
	n.PaginaPeriodico,
	s.seccion,
	c.Categoria as Categoria,
	n.Autor,
	n.Texto,
	CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
	n.Categoria as 'Num.Categoria',
	n.NumeroPagina,
	n.Fecha,
	n.Hora,
	n.Encabezado,
	n.Foto,
	n.PieFoto
FROM
	noticiasDia n,
	periodicos p,
	ordenGeneral o,
	seccionesPeriodicos s,
	categoriasPeriodicos c,
	estados e
WHERE
	p.idPeriodico=n.Periodico AND
	p.idPeriodico=o.periodico AND
	s.idSeccion=n.Seccion AND
	c.idCategoria=n.Categoria AND
	p.Estado=e.idEstado AND
	n.Activo = 1 AND
	fecha = CURDATE() AND  (
        Texto like '%NAFINSA%' OR
        Texto like '%NAFIN%' OR
        Texto like '% Nacional Financiera%' OR
        Texto like '%Jacques Rogozinsky%' OR
        Texto like '%Jacques Rogozinski%' OR

        Titulo like '%NAFINSA%' OR
        Titulo like '%NAFIN%' OR
        Titulo like '% Nacional Financiera%' OR
        Titulo like '%Jacques Rogozinsky%' OR
        TItulo like '%Jacques Rogozinski%' OR

        Encabezado like '%NAFINSA%' OR
        Encabezado like '%NAFIN%' OR
        Encabezado like '% Nacional Financiera%' OR
        Encabezado like '%Jacques Rogozinsky%' OR
        Encabezado like '%Jacques Rogozinski%' OR

        Autor like '%NAFINSA%' OR
        Autor like '%NAFIN%' OR
        Autor like '% Nacional Financiera%' OR
        Autor like '%Jacques Rogozinsky%' OR
        Autor like '%Jacques Rogozinski%' OR

        PieFoto like '%NAFINSA%' OR
        PieFoto like '%NAFIN%' OR
        PieFoto like '% Nacional Financiera%' OR
        PieFoto like '%Jacques Rogozinsky%' OR
        PieFoto like '%Jacques Rogozinski%'
    )
ORDER BY o.posicion";

		$noticias = mysql_query($query);
  		$filas = mysql_affected_rows();

  		$pdf  = new FPDI('P', 'mm', 'legal');

    	$pdfs = array();
		if($filas>0){
			while($row = mysql_fetch_array($noticias)){
				if(!in_array("/var/www/external/testigos/nafinsa/nafinsa/".$fecha."/".$row['idEditorial'].".pdf", $pdfs)){
					$pdfs[] = "/var/www/external/testigos/nafinsa/nafinsa/".$fecha."/".$row['idEditorial'].".pdf";
				}
			}
		}

    	if(!empty($pdfs)){
    		$pdf->setFiles($pdfs);
    		$pdf->concat();


    		mkdir("/var/www/external/testigos/nafinsa/nafinsa/".$fecha."/compendio",true, 0777);
    		chmod("/var/www/external/testigos/nafinsa/nafinsa/".$fecha."/compendio",0777);
    		umask(umask(0));

    		$nombre = "/var/www/external/testigos/nafinsa/nafinsa/".$fecha."/compendio/".$fecha.".pdf";
    		$pdf->Output($nombre, 'F');
    	}