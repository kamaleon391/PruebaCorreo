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
  fecha = CURDATE() AND (
    Texto like '%Sector Aeronautico%' OR
    Titulo like '%Sector Aeronautico%' OR
    Encabezado like '%Sector Aeronautico%' OR
    PieFoto like '%Sector Aeronautico%' OR

    Texto like '%Sector Aeroespacial%' OR
    Titulo like '%Sector Aeroespacial%' OR
    Encabezado like '%Sector Aeroespacial%' OR
    PieFoto like '%Sector Aeroespacial%' OR

Texto like '%AICM%' OR
    Titulo like '%AICM%' OR
    Encabezado like '%AICM%' OR
    PieFoto like '%AICM%' OR


          Texto like '% ASUR %' OR
    Titulo like '% ASUR %' OR
    Encabezado like '% ASUR %' OR
    PieFoto like '% ASUR %' OR


          Texto like '% OMA %' OR
    Titulo like '% OMA %' OR
    Encabezado like '% OMA %' OR
    PieFoto like '% OMA %' OR


          Texto like '% GAP %' OR
    Titulo like '% GAP %' OR
    Encabezado like '% GAP %' OR
    PieFoto like '% GAP %' OR


          Texto like '% Grupo Aeroportuario Chiapas %' OR
    Titulo like '% Grupo Aeroportuario Chiapas %' OR
    Encabezado like '% Grupo Aeroportuario Chiapas %' OR
    PieFoto like '% Grupo Aeroportuario Chiapas %' OR


Texto like '% Aerocaribe %' OR
    Titulo like '% Aerocaribe %' OR
    Encabezado like '% Aerocaribe %' OR
    PieFoto like '% Aerocaribe %' OR


          Texto like '% Aerolitoral %' OR
    Titulo like '% Aerolitoral %' OR
    Encabezado like '% Aerolitoral %' OR
    PieFoto like '% Aerolitoral %' OR


          Texto like '% Aeromar %' OR
    Titulo like '% Aeromar %' OR
    Encabezado like '% Aeromar %' OR
    PieFoto like '% Aeromar %' OR


Texto like '% Aeromexico %' OR
    Titulo like '% Aeromexico %' OR
    Encabezado like '% Aeromexico %' OR
    PieFoto like '% Aeromexico %' OR


          Texto like '% Alma de Mexico %' OR
    Titulo like '% Alma de Mexico %' OR
    Encabezado like '% Alma de Mexico %' OR
    PieFoto like '% Alma de Mexico %' OR


Texto like '% Aviacsa %' OR
    Titulo like '% Aviacsa %' OR
    Encabezado like '% Aviacsa %' OR
    PieFoto like '% Aviacsa %' OR


Texto like '% A Volar %' OR
    Titulo like '% A Volar %' OR
    Encabezado like '% A Volar %' OR
    PieFoto like '% A Volar %' OR

 Texto like '% Clik %' OR
    Titulo like '% Clik %' OR
    Encabezado like '% Clik %' OR
    PieFoto like '% Clik %' OR

Texto like '% Interjet %' OR
    Titulo like '% Interjet %' OR
    Encabezado like '% Interjet %' OR
    PieFoto like '% Interjet %' OR

          (Texto like '% Mexicana %' AND Texto like '%aviacion%') OR

          Texto like '% Viva Aerobus %' OR
    Titulo like '% Viva Aerobus %' OR
    Encabezado like '% Viva Aerobus %' OR

          Texto like '% Volaris %' OR
    Titulo like '% Volaris %' OR
    Encabezado like '% Volaris %' OR

 Texto like '% Lineas Aereas Azteca %' OR
    Titulo like '% Lineas Aereas Azteca %' OR
    Encabezado like '% Lineas Aereas Azteca %' OR

Texto like '% American Airlines %' OR
    Titulo like '% American Airlines %' OR
    Encabezado like '% American Airlines %' OR

 Texto like '% Air France %' OR
    Titulo like '% Air France %' OR
    Encabezado like '% Air France %' OR

Texto like '% Fly Emirates %' OR
    Titulo like '% Fly Emirates %' OR
    Encabezado like '% Fly Emirates %' 

  ) ORDER BY o.posicion";
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
		            $pdf->Image('/var/www/siscap.la/public/img/tableros/ASA.png',5,5,60);

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
		              $pdf->Cell(45, 5, $row['Periodico'], 1, 1, 'C', false);
		            } else {
		              $pdf->Cell(45, 5, $row['StringName'], 1, 1, 'C', false);
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
						              $pdf->Cell(45, 5, $row['Periodico'], 1, 1, 'C', false);
						            } else {
						              $pdf->Cell(45, 5, $row['StringName'], 1, 1, 'C', false);
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
				              $pdf->Cell(45, 5, $row['Periodico'], 1, 1, 'C', false);
				            } else {
				              $pdf->Cell(45, 5, $row['StringName'], 1, 1, 'C', false);
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
					$filename = "/var/www/external/testigos/asa/aeronautico/".$row['Fecha']."/".$ids.'.pdf';
					if(!is_dir("/var/www/external/testigos/asa/aeronautico/".$row['Fecha']."/")){

						mkdir("/var/www/external/testigos/asa/aeronautico/".$row['Fecha'],true,0777);
						chmod("/var/www/external/testigos/asa/aeronautico/".$row['Fecha'],0777);
						umask($antigua);
					}

					if(is_dir("/var/www/external/testigos/asa/aeronautico/".$row['Fecha']."/")){
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
    		if(!in_array("/var/www/external/testigos/asa/aeronautico/".$fecha."/".$x, $pdfs)){
    			$pdfs[] = "/var/www/external/testigos/asa/aeronautico/".$fecha."/".$x;
    		}
    		
    	}

    	if(!empty($pdfs)){
    		$pdf->setFiles($pdfs);
    		$pdf->concat();

    		mkdir("/var/www/external/testigos/asa/aeronautico/".$fecha."/compendio",true, 0777);
    		chmod("/var/www/external/testigos/asa/aeronautico/".$fecha."/compendio",0777);
    		umask(umask(0));

    		$nombre = "/var/www/external/testigos/asa/aeronautico/".$fecha."/compendio/".$fecha.".pdf";
    		$pdf->Output($nombre, 'F');
    	}
    }
