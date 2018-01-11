<?php 
	ignore_user_abort(true);
	set_time_limit(0);

	include "/var/www/external/services/mail/conexion.php";
	$fecha = date('Y-m-d');
	$sql = "SELECT
	n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
p.String_Name as StringName,
    n.CREL as CREL,
    n.CostoNota,
    n.CREN as CREN,
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
seccionesPeriodicos s,
categoriasPeriodicos c,
estados e
WHERE 
p.idPeriodico=n.Periodico AND p.idPeriodico in (52,53,59,47,97,131,51,302,364,32,319,346,50) AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(1,19,20) AND
e.idEstado=p.Estado AND
n.Fecha=CURDATE() AND
n.Activo=1 AND
(
Autor like '%Jacques Rogozinski%' OR 
Autor like '%Alicia Salgado%' OR 
Autor like '%Maricarmen Cortes%' OR 
Autor like '%David Paramo%' OR 
Autor like '%Jose yuste%' OR 
Autor like '%Dario Celis%' OR 
Autor like '%Jesus Rangel%' OR 
Autor like '%Enrique Campos%' OR 
Autor like '%Alberto Aguilar%' OR 
Autor like '%Alberto Barranco%' OR 
				   
				   
Autor like '%Edgar Gonzalez Martinez%' OR 
Autor like '%Julio Brito%' OR 
Autor like '%Carlos Fernandez Vega%' OR 
Autor like '%Luis Soto%' OR 
Autor like '%Wilbert Torre%' OR 
Autor like '%Bartolome%' OR 
Autor like '%Salvador Garcia Soto%' OR 
Autor like '%Francisco Cardenas Cruz%' OR 
Autor like '%Jorge Castanñeda%' OR 
Autor like '%Raymundo Rivapalacio%' OR 
Autor like '%Leo Zuckermann%' OR 
Autor like '%Pascal Beltran del Rio%' OR 
Autor like '%Carlos Loret de Mola%' OR 
Autor like '%Sergio Sarmiento%' OR 
Autor like '%Denise Dresser%' OR 
Autor like '%Jesus Silva Herzog Marquez%' OR 
Autor like '%Roberto Zamarripa%' OR 
Autor like '%Caton%' OR 
Autor like '%Julio Hernandez Lopez%' OR 
Autor like '%Carlos Mota%' OR 
Autor like '%Jorge Fernandez Menendez%' OR 
Autor like '%Enrique Quintana%' OR 
Autor like '%Mauricio Flores%' OR 
Autor like '%Marco Antonio Mares%' OR 
Autor like '%Francisco Garfias%' OR 
Autor like '%Jose Cardenas%' OR 
Autor like '%Joaquin Lopez Doriga%' OR 
Autor like '%Diego Valades%' OR 
Autor like '%Jorge Alcocer%' OR 
Autor like '%Guadalupe Loaeza%' OR 
Autor like '%Sergio Aguayo%' OR 
Autor like '%German Martinez Cazares%' OR 
Autor like '%Jose Woldenberg%' OR 
Autor like '%Oscar Mario Beteta%' OR 
Autor like '%Juan Villoro%' OR 
Autor like '%Carmen Aristegui%' OR 
Autor like '%Manuel Jauregui%' OR

Titulo like '%Mitos y Mentadas%' OR 
Titulo like '%Cuenta Corriente%' OR 
Titulo like '%Desde el piso de remates%' OR 
Titulo like '%No tires tu dinero%' OR 
Titulo like '%Activo Empresarial%' OR 
Titulo like '%Tiempo de Negocios%' OR 
Titulo like '%Estira y afloja%' OR 
Titulo like '%La Gran Depresion%' OR 
Titulo like '%Desbalance%' OR 
Titulo like '%Inversiones%' OR 
Titulo like '%Nombres, nombres y nombres%' OR 
Titulo like '%Empresa%' OR 
Titulo like '%Los Capitales%' OR 
Titulo like '%Riesgos y rendimientos%' OR 
Titulo like '%Mexico SA%' OR 
Titulo like '%Agenda Confidencial%' OR 
Titulo like '%Nadie conoce a nadie%' OR 
Titulo like '%Templo Mayor%' OR 
Titulo like '%Rozones%' OR 
Titulo like '%Trascendio%' OR 
Titulo like '%Pepe Grillo%' OR 
Titulo like '%Serpiente y Escaleras%' OR 
Titulo like '%Pulso Politico%' OR 
Titulo like '%Amarres%' OR 
Titulo like '%Estrictamente profesional%' OR 
Titulo like '%Juegos de Poder%' OR 
Titulo like '%Bitacora del director%' OR 
Titulo like '%Bajo Reserva%' OR 
Titulo like '%Frentes Politicos%' OR 
Titulo like '%Historias de Reportero%' OR 
Titulo like '%Jaque Mate%' OR 
Titulo like '%Tolvanera%' OR 
Titulo like '%De politica y cosas peores %' OR 
Titulo like '%Astillero%' OR 
Titulo like '%Escritorio de negocios%' OR 
Titulo like '%Razones%' OR 
Titulo like '%Coordenadas%' OR 
Titulo like '%Gente detras del dinero%' OR 
Titulo like '%Fortuna y poder%' OR 
Titulo like '%Arsenal%' OR 
Titulo like '%Ventana%' OR 
Titulo like '%En Privado%' OR 
Titulo like '%Murmullos%' OR 
Titulo like '%Murmullos%'  
)
GROUP BY n.idEditorial
ORDER BY Periodico";
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
  					$pdf = new FPDI('P', 'mm', 'A4');
  					//Creamos PDF's individuales
  					$pdf->addPage();
  					$pdf->ln();
  					$pdf->setFont("arial", "B", 11);

  					$y = 12;
  					$pdf->SetFont("arial", "B", 9);

  					$pdf->SetXY(0, 4);
  					$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
		//           $pdf->Line(30, 12, 200, 12);
		            $pdf->Image('/var/www/siscap.la/public/img/tableros/NAFINSA.png',5,5,60);

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
		            	$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_1.png",50,25,110,25);
		            }else{
		            	if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_photo.png')){
							$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_photo.png",35,80,150,150);
							$page=true;
						}else{
							if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_full_note.png')){
								if($row['idPeriodico'] == 52){
                                    $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids.'_full_note.png',5,35,195,180);
                                }
                                $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_full_note.png",5,35,205,240);
                            }
	            		}
				}
				

		            $x= 9;
		            $ys= 55;
		            $ancho=90;

			    if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_fasle_title.png')){
					$ys = 30;
					$ax = 93;
					$ay = 170;
					$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids.'_false_title.png',30,25,110,25);
					$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_1.png',9,30,93,170);
					$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_2.png',107,30,93,170);
			    }else{
		            for ($i=2; $i < 20 ; $i++) { 
						if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_'.$i.'.png')){
							if($i%2==0){
								$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_".$i.".png",$x,$ys,93,160);
								$x= 107;
							}else{
								$pdf->Image('/var/www/siscap.la/public/img/cuts/'.$ids."_cut_".$i.".png",$x,$ys,90,150);
								$x= 9;
								$ys = 25;
								if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_'.($i+1).'.png')){
									//as
									$pdf->addPage();
				  					$pdf->ln();
				  					$pdf->setFont("arial", "B", 11);

				  					$y = 12;
				  					$pdf->SetFont("arial", "B", 9);

				  					$pdf->SetXY(0, 4);
				  					$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
						//           $pdf->Line(30, 12, 200, 12);
						            $pdf->Image('/var/www/siscap.la/public/img/tableros/NAFINSA.png',5,5,60);

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
					}
				}
					
					if(!$page){
						if(file_exists('/var/www/siscap.la/public/img/cuts/'.$ids.'_cut_photo.png')){
							$pdf->addPage();
		  					$pdf->ln();
		  					$pdf->setFont("arial", "B", 11);

		  					$y = 12;
		  					$pdf->SetFont("arial", "B", 9);

		  					$pdf->SetXY(0, 4);
		  					$pdf->Cell(0,8, utf8_decode('Dirección de Comunicación Social'), 0, 0, 'C');
				//           $pdf->Line(30, 12, 200, 12);
				            $pdf->Image('/var/www/siscap.la/public/img/tableros/NAFINSA.png',5,5,60);

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


//					$pdf->Line(0,50,216,50);
					$antigua = umask(0);
					$filename = "/var/www/external/testigos/nafinsa/columnas/".$row['Fecha']."/".$ids.'.pdf';
					if(!is_dir("/var/www/external/testigos/nafinsa/columnas/".$row['Fecha']."/")){

						mkdir("/var/www/external/testigos/nafinsa/columnas/".$row['Fecha'],true,0777);
						chmod("/var/www/external/testigos/nafinsa/columnas/".$row['Fecha'],0777);
						umask($antigua);
					}

					if(is_dir("/var/www/external/testigos/nafinsa/columnas/".$row['Fecha']."/")){
						$notas[$p] = $row['idEditorial'].'.pdf';
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

  		$pdf  = new FPDI('P', 'mm', 'A4');

    	$pdfs = array();
    	foreach ($notas as $x) {
    		if(!in_array("/var/www/external/testigos/nafinsa/columnas/".$fecha."/".$x, $pdfs)){
    			$pdfs[] = "/var/www/external/testigos/nafinsa/columnas/".$fecha."/".$x;
    		}
    		
    	}

    	if(!empty($pdfs)){
    		$pdf->setFiles($pdfs);
    		$pdf->concat();

    		mkdir("/var/www/external/testigos/nafinsa/columnas/".$fecha."/compendio",true, 0777);
    		chmod("/var/www/external/testigos/nafinsa/columnas/".$fecha."/compendio",0777);
    		umask(umask(0));

    		$nombre = "/var/www/external/testigos/nafinsa/columnas/".$fecha."/compendio/".$fecha.".pdf";
    		$pdf->Output($nombre, 'F');
    	}
    }
