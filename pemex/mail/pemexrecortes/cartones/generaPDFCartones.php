<?php
	ignore_user_abort(true);
	set_time_limit(0);
	header("Content-Type: text/html;charset=utf-8");

	include "/var/www/external/services/mail/conexion.php";
	$fecha = date('Y-m-d');
	$sql = "SELECT
	n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
 p.String_Name as StringName,
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
e.idEstado=p.Estado AND
p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(18) AND
p.estado=9 AND
n.Activo = 1 AND
fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY o.posicion";
	createIndividualPDF($sql,$fecha);

    function createIndividualPDF($query, $fecha){
    	require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  		require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  		$p = 0;
  		$notas = array();
  		$noticias = mysql_query($query);
  		$filas = mysql_affected_rows();

  		if($filas > 0){
  			while($row = mysql_fetch_array($noticias)){
  				if($row['cutted'] > 0){
  					$pdf = new FPDI('P', 'mm', 'legal');
  					//Creamos PDF's individuales
  					$pdf->addPage();
  					$pdf->ln();
  					$pdf->setFont("arial", "B", 11);

  					$y = 12;
  					$pdf->SetFont("arial", "B", 9);

  					$pdf->SetXY(0, 4);
  		//			$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
		//           $pdf->Line(30, 12, 200, 12);
		//            $pdf->Image('/var/www/siscap.la/public/img/tableros/pemex.png',5,5,60);

		            $pdf->SetTextColor( 0,0,0 );
		            // x = 265 Total
		            $pdf->SetXY( 77, $y );
		            $pdf->Cell(45, 5, utf8_decode("Medio"), 1, 1, 'C', false);
		            // x = 80
		            $pdf->SetXY( 122, $y);
		            $pdf->Cell(35, 5, utf8_decode("Sección"), 1, 1, 'C', false);
		            // x = 105
		            $pdf->SetXY( 157, $y);
		            $pdf->Cell(15, 5, utf8_decode("Pagina"), 1, 1, 'C', false);
		            // x = 130
		            $pdf->SetXY( 172, $y);
		            $pdf->Cell( 20, 5, utf8_decode("Fecha"), 1, 1, 'C', false);
		            /*$pdf->SetXY( 130, $y);
		            $pdf->Cell( 20, 5, utf8_decode("Calificación"), 1, 1, 'C', false);

		            $pdf->SetXY( 150, $y);
		            $pdf->Cell( 25, 5, utf8_decode("Area"), 1, 1, 'C', false);

		            $pdf->SetXY( 175, $y);
		            $pdf->Cell( 25, 5, utf8_decode("Costo"), 1, 1, 'C', false);
		            $y += 5;
								--*/
		            $pdf->SetXY( 77, $y+5 );
		            if(empty(trim($row['StringName']))) {
		              $pdf->Cell(45, 5, utf8_decode($row['Periodico']), 1, 1, 'C', false);
		            } else {
		              $pdf->Cell(45, 5, utf8_decode($row['StringName']), 1, 1, 'C', false);
		            }
		            // x = 80
		            $pdf->SetXY( 122, $y+5);
		            $pdf->Cell(35, 5, utf8_decode($row['seccion']), 1, 1, 'C', false);
		            // x = 105
		            $pdf->SetXY( 157, $y+5);
		            $pdf->Cell(15, 5, utf8_decode($row['PaginaPeriodico']), 1, 1, 'C', false);
		            // x = 130
		            $pdf->SetXY( 172, $y+5);
		            $pdf->Cell( 20, 5, utf8_decode($row['Fecha']), 1, 1, 'C', false);





		            $ids = $row['idEditorial'];
		            $page = false;
		            if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_1.png')){
		            	$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_1.png",10,60,200,50);
		            }else{
		            	if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_photo.png')){
							$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_photo.png",35,80,150,150);
							$page=true;
						}
		            }

		            $x= 9;
		            $ys= 120;
		            $ancho=90;

		            for ($i=2; $i < 20 ; $i++) {
						if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_'.$i.'.png')){
							if($i%2==0){
								$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_".$i.".png",$x,$ys,90,150);
								$x= 109;
							}else{
								$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_".$i.".png",$x,$ys,90,150);
								$x= 9;
								$ys = 60;
								if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_'.($i+1).'.png')){
									//as
									$pdf->addPage();
				  					$pdf->ln();
				  					$pdf->setFont("arial", "B", 11);

				  					$y = 12;
				  					$pdf->SetFont("arial", "B", 9);

				  					$pdf->SetXY(0, 4);
				  		//			$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
						//           $pdf->Line(30, 12, 200, 12);
						//            $pdf->Image('/var/www/siscap.la/public/img/tableros/pemex.png',5,5,60);

						            $pdf->SetTextColor( 0,0,0 );
						            // x = 265 Total
						            $pdf->SetXY( 77, $y );
						            $pdf->Cell(45, 5, utf8_decode("Medio"), 1, 1, 'C', false);
						            // x = 80
						            $pdf->SetXY( 122, $y);
						            $pdf->Cell(35, 5, utf8_decode("Sección"), 1, 1, 'C', false);
						            // x = 105
						            $pdf->SetXY( 157, $y);
						            $pdf->Cell(15, 5, utf8_decode("Pagina"), 1, 1, 'C', false);
						            // x = 130
						            $pdf->SetXY( 172, $y);
						            $pdf->Cell( 20, 5, utf8_decode("Fecha"), 1, 1, 'C', false);
						            /*$pdf->SetXY( 130, $y);
						            $pdf->Cell( 20, 5, utf8_decode("Calificación"), 1, 1, 'C', false);

						            $pdf->SetXY( 150, $y);
						            $pdf->Cell( 25, 5, utf8_decode("Area"), 1, 1, 'C', false);

						            $pdf->SetXY( 175, $y);
						            $pdf->Cell( 25, 5, utf8_decode("Costo"), 1, 1, 'C', false);
						            $y += 5;
												--*/
						            $pdf->SetXY( 77, $y+5 );
						            if(empty(trim($row['StringName']))) {
						              $pdf->Cell(45, 5, utf8_decode($row['Periodico']), 1, 1, 'C', false);
						            } else {
						              $pdf->Cell(45, 5, utf8_decode($row['StringName']), 1, 1, 'C', false);
						            }
						            // x = 80
						            $pdf->SetXY( 122, $y+5);
						            $pdf->Cell(35, 5, utf8_decode($row['seccion']), 1, 1, 'C', false);
						            // x = 105
						            $pdf->SetXY( 157, $y+5);
						            $pdf->Cell(15, 5, utf8_decode($row['NumeroPagina']), 1, 1, 'C', false);
						            // x = 130
						            $pdf->SetXY( 172, $y+5);
						            $pdf->Cell( 20, 5, utf8_decode($row['Fecha']), 1, 1, 'C', false);
								}
							}
							$new_page = true;
						}else{
							//list($ancho, $alto, $tipo, $atributos) = getimagesize(URL::To('/').'/img/cuts/'.$id."_cut_".$i.".png");
							$new_page = false;;

						}





						//$imgs = Image(url('/img/cuts/'.$id.'_cut_'.$i.'.png'),5,30,$ancho_pdf, $alto_pdf);
					}

					if(!$page){
						if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_photo.png')){
							$pdf->addPage();
		  					$pdf->ln();
		  					$pdf->setFont("arial", "B", 11);

		  					$y = 12;
		  					$pdf->SetFont("arial", "B", 9);

		  					$pdf->SetXY(0, 4);
		  		//			$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
				//           $pdf->Line(30, 12, 200, 12);
				//            $pdf->Image('/var/www/siscap.la/public/img/tableros/pemex.png',5,5,60);

				            $pdf->SetTextColor( 0,0,0 );
				            // x = 265 Total
				            $pdf->SetXY( 77, $y );
				            $pdf->Cell(45, 5, utf8_decode("Medio"), 1, 1, 'C', false);
				            // x = 80
				            $pdf->SetXY( 122, $y);
				            $pdf->Cell(35, 5, utf8_decode("Sección"), 1, 1, 'C', false);
				            // x = 105
				            $pdf->SetXY( 157, $y);
				            $pdf->Cell(15, 5, utf8_decode("Pagina"), 1, 1, 'C', false);
				            // x = 130
				            $pdf->SetXY( 172, $y);
				            $pdf->Cell( 20, 5, utf8_decode("Fecha"), 1, 1, 'C', false);
				            /*$pdf->SetXY( 130, $y);
				            $pdf->Cell( 20, 5, utf8_decode("Calificación"), 1, 1, 'C', false);

				            $pdf->SetXY( 150, $y);
				            $pdf->Cell( 25, 5, utf8_decode("Area"), 1, 1, 'C', false);

				            $pdf->SetXY( 175, $y);
				            $pdf->Cell( 25, 5, utf8_decode("Costo"), 1, 1, 'C', false);
				            $y += 5;
										--*/
				            $pdf->SetXY( 77, $y+5 );
				            if(empty(trim($row['StringName']))) {
				              $pdf->Cell(45, 5, utf8_decode($row['Periodico']), 1, 1, 'C', false);
				            } else {
				              $pdf->Cell(45, 5, utf8_decode($row['StringName']), 1, 1, 'C', false);
				            }
				            // x = 80
				            $pdf->SetXY( 122, $y+5);
				            $pdf->Cell(35, 5, utf8_decode($row['seccion']), 1, 1, 'C', false);
				            // x = 105
				            $pdf->SetXY( 157, $y+5);
				            $pdf->Cell(15, 5, utf8_decode($row['NumeroPagina']), 1, 1, 'C', false);
				            // x = 130
				            $pdf->SetXY( 172, $y+5);
				            $pdf->Cell( 20, 5, utf8_decode($row['Fecha']), 1, 1, 'C', false);
							$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_photo.png",35,80,150,150);
						}
					}


					//$pdf->Line(0,50,216,50);
					$antigua = umask(0);
					$filename = "/var/www/external/testigos/pemex/cartones/".$row['Fecha']."/".$ids.'.pdf';
					if(!is_dir("/var/www/external/testigos/pemex/cartones/".$row['Fecha']."/")){

						mkdir("/var/www/external/testigos/pemex/cartones/".$row['Fecha'],true,0777);
						chmod("/var/www/external/testigos/pemex/cartones/".$row['Fecha'],0777);
						umask($antigua);
					}

					if(is_dir("/var/www/external/testigos/pemex/cartones/".$row['Fecha']."/")){
						$notas[$p] = $row['idEditorial'];
						$p++;

						$pdf->Output($filename, 'F');
					}else{
						//echo "Error echo echo echo  Escritura<br>".__DIR__;
					}
					//
  				}
  			}
  		}

  		creaPDF($fecha, $notas);
    }

    function creaPDF($fecha, $notas){
    	require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  		require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  		$query="(SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
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
	e.idEstado=p.Estado AND
	p.idPeriodico=n.Periodico AND n.Periodico in (50) AND
	p.idPeriodico=o.periodico AND
	s.idSeccion=n.Seccion AND
	c.idCategoria=n.Categoria AND
	c.idCategoria in(18) AND
	p.estado=9 AND
	n.Activo = 1 AND
	fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY o.posicion
) UNION
(SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
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
	e.idEstado=p.Estado AND
	p.idPeriodico=n.Periodico AND n.Periodico in (32) AND
	p.idPeriodico=o.periodico AND
	s.idSeccion=n.Seccion AND
	c.idCategoria=n.Categoria AND
	c.idCategoria in(18) AND
	p.estado=9 AND
	n.Activo = 1 AND
	fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY o.posicion
) UNION
(SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
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
	e.idEstado=p.Estado AND
	p.idPeriodico=n.Periodico AND n.Periodico in (47) AND
	p.idPeriodico=o.periodico AND
	s.idSeccion=n.Seccion AND
	c.idCategoria=n.Categoria AND
	c.idCategoria in(18) AND
	p.estado=9 AND
	n.Activo = 1 AND
	fecha =CURDATE()
    GROUP BY n.idEditorial
	ORDER BY n.idEditorial DESC  LIMIT 2
)
UNION
(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
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
	e.idEstado=p.Estado AND
	p.idPeriodico=n.Periodico AND n.Periodico in (59) AND
	p.idPeriodico=o.periodico AND
	s.idSeccion=n.Seccion AND
	c.idCategoria=n.Categoria AND
	c.idCategoria in(18) AND
	p.estado=9 AND
	n.Activo = 1 AND
    n.Titulo like '%RAPE%' AND
	fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY o.posicion)
UNION
(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
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
	e.idEstado=p.Estado AND
	p.idPeriodico=n.Periodico AND n.Periodico in (51) AND
	p.idPeriodico=o.periodico AND
	s.idSeccion=n.Seccion AND
	c.idCategoria=n.Categoria AND
	c.idCategoria in(18) AND
	p.estado=9 AND
	n.Activo = 1 AND
	fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY o.posicion)";

		$noticias = mysql_query($query);
  		$filas = mysql_affected_rows();


  		$pdf  = new FPDI('P', 'mm', 'A4');
  		$band = false;
  		$pag = '0';
  		if($filas > 0){
  			while($row = mysql_fetch_array($noticias)){

  				switch ($pag) {
  					case '0':
  						$pdf->addPage();
		  					$pdf->ln();
		  					$pdf->setFont("arial", "B", 11);

		  					$y = 12;
		  					$pdf->SetFont("arial", "B", 9);

		  					$pdf->SetXY(0, 4);
		  		//			$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
				//           $pdf->Line(30, 12, 200, 12);
				//            $pdf->Image('/var/www/siscap.la/public/img/tableros/pemex.png',5,5,60);

				            $pdf->SetTextColor( 0,0,0 );
				            // x = 265 Total
				            $pdf->SetXY( 77, $y );
				            $pdf->Cell(45, 5, utf8_decode("Medio"), 1, 1, 'C', false);
				            // x = 80
				            $pdf->SetXY( 122, $y);
				            $pdf->Cell(35, 5, utf8_decode("Sección"), 1, 1, 'C', false);
				            // x = 105
				            $pdf->SetXY( 157, $y);
				            $pdf->Cell(15, 5, utf8_decode("Pagina"), 1, 1, 'C', false);
				            // x = 130
				            $pdf->SetXY( 172, $y);
				            $pdf->Cell( 20, 5, utf8_decode("Fecha"), 1, 1, 'C', false);
				            /*$pdf->SetXY( 130, $y);
				            $pdf->Cell( 20, 5, utf8_decode("Calificación"), 1, 1, 'C', false);

				            $pdf->SetXY( 150, $y);
				            $pdf->Cell( 25, 5, utf8_decode("Area"), 1, 1, 'C', false);

				            $pdf->SetXY( 175, $y);
				            $pdf->Cell( 25, 5, utf8_decode("Costo"), 1, 1, 'C', false);
				            $y += 5;
										--*/
				            $pdf->SetXY( 77, $y+5 );
				            if(empty(trim($row['StringName']))) {
				              $pdf->Cell(45, 5, utf8_decode($row['Periodico']), 1, 1, 'C', false);
				            } else {
				              $pdf->Cell(45, 5, $row['StringName'], 1, 1, 'C', false);
				            }
				            // x = 80
				            $pdf->SetXY( 122, $y+5);
				            $pdf->Cell(35, 5, $row['seccion'], 1, 1, 'C', false);
				            // x = 105
				            $pdf->SetXY( 157, $y+5);
				            $pdf->Cell(15, 5, utf8_decode($row['PaginaPeriodico']), 1, 1, 'C', false);
				            // x = 130
				            $pdf->SetXY( 172, $y+5);
				            $pdf->Cell( 20, 5, utf8_decode($fecha), 1, 1, 'C', false);
							$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$row['idEditorial']."_cut_photo.png",50,30,110,110);
							$pag = '1';
							break;
  					case '1':
  						if(($row['idPeriodico'] == 51) && $band == false){
  							$band = true;
  							$pag = '0';
  						}else{
  							$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$row['idEditorial']."_cut_photo.png",50,155,110,110);
  							$pag = '0';
  						}
  						break;
  				}
  			}
  		}


  		/*$pdf->addPage();
  		$pdf->ln();
  		$pdf->setFont("arial", "B", 11);

  		$y = 12;
  		$pdf->SetFont("arial", "B", 9);

  		$pdf->SetXY(0, 4);
  		$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
		//           $pdf->Line(30, 12, 200, 12);
		$pdf->Image('/var/www/siscap.la/public/img/tableros/pemex.png',5,5,60);

    	$pdfs = array();
    	$pag = '0';
    	for ($i=0; $i < count($notas); $i++) {
    		switch ($pag) {
    			case '0':
    				if(file_exists('/var/www/siscap.la/public/img/cuts/'.$notas[$i].'_cut_photo.png')){
		    			$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$notas[$i]."_cut_photo.png",35,25,130,130);
		    			$pag = '1';
		    		}
    				break;

    			case '1':
    				if(file_exists('/var/www/siscap.la/public/img/cuts/'.$notas[$i].'_cut_photo.png')){
		    			$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$notas[$i]."_cut_photo.png",35,160,130,130);
		    		}
		    		if(file_exists('/var/www/siscap.la/public/img/cuts/'.$notas[$i+1].'_cut_photo.png')){
		    			$pag = '0';
		    			$pdf->addPage();
				  		$pdf->ln();
				  		$pdf->setFont("arial", "B", 11);

				  		$y = 12;
				  		$pdf->SetFont("arial", "B", 9);

				  		$pdf->SetXY(0, 4);
				  		$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
						//           $pdf->Line(30, 12, 200, 12);
						$pdf->Image('/var/www/siscap.la/public/img/tableros/pemex.png',5,5,60);
		    		}
		    		break;
    		}
    	}

    	/*if(!empty($pdfs)){
    		$pdf->setFiles($pdfs);
    		$pdf->concat();*/

    		mkdir("/var/www/external/testigos/pemex/cartones/".$fecha."/compendio",true, 0777);
    		chmod("/var/www/external/testigos/pemex/cartones/".$fecha."/compendio",0777);
    		umask(umask(0));

    		$nombre = "/var/www/external/testigos/pemex/cartones/".$fecha."/compendio/".$fecha.".pdf";
    		$pdf->Output($nombre, 'F');
    	//}
    }
