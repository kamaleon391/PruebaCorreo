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
                Texto like '% red de aeropuertos y servicios auxiliares %' OR
        Texto like '%aeropuerto de campeche%' OR
        Texto like '%aeropuerto de ciudad del carmen%' OR
        Texto like '%aeropuerto de ciudad obregon%' OR
        Texto like '%aeropuerto de ciudad victoria%' OR
        Texto like '%aeropuerto de chetumal%' OR
        Texto like '%aeropuerto de colima%' OR
        Texto like '%aeropuerto de guaymas%' OR 
        Texto like '%aeropuerto de loreto%' OR 
        Texto like '%aeropuerto de matamoros%' OR 
        Texto like '%aeropuerto de nogales%' OR 
        Texto like '%aeropuerto de nuevo laredo%' OR 
        Texto like '%aeropuerto de poza rica%' OR 
        Texto like '%aeropuerto de puebla%' OR 
        Texto like '%aeropuerto de puerto escondido%' OR 
        Texto like '%aeropuerto de tamuin%' OR 
        Texto like '%aeropuerto de tehuacan%' OR 
        Texto like '%aeropuerto de tepic%' OR 
        Texto like '%aeropuerto de uruapan%' OR 
        Titulo like '% red de aeropuertos y servicios auxiliares %' OR
        Titulo like '%aeropuerto de campeche%' OR
        Titulo like '%aeropuerto de ciudad del carmen%' OR
        Titulo like '%aeropuerto de ciudad obregon%' OR
        Titulo like '%aeropuerto de ciudad victoria%' OR
        Titulo like '%aeropuerto de chetumal%' OR
        Titulo like '%aeropuerto de colima%' OR
        Titulo like '%aeropuerto de guaymas%' OR 
        Titulo like '%aeropuerto de loreto%' OR 
        Titulo like '%aeropuerto de matamoros%' OR 
        Titulo like '%aeropuerto de nogales%' OR 
        Titulo like '%aeropuerto de nuevo laredo%' OR 
        Titulo like '%aeropuerto de poza rica%' OR 
        Titulo like '%aeropuerto de puebla%' OR 
        Titulo like '%aeropuerto de puerto escondido%' OR 
        Titulo like '%aeropuerto de tamuin%' OR 
        Titulo like '%aeropuerto de tehuacan%' OR 
        Titulo like '%aeropuerto de tepic%' OR 
        Titulo like '%aeropuerto de uruapan%' OR 
        Encabezado like '%aeropuerto de campeche%' OR
        Encabezado like '%aeropuerto de ciudad del carmen%' OR
        Encabezado like '%aeropuerto de ciudad obregon%' OR
        Encabezado like '%aeropuerto de ciudad victoria%' OR
        Encabezado like '%aeropuerto de chetumal%' OR
        Encabezado like '%aeropuerto de colima%' OR
        Encabezado like '%aeropuerto de guaymas%' OR 
        Encabezado like '%aeropuerto de loreto%' OR 
        Encabezado like '%aeropuerto de matamoros%' OR 
        Encabezado like '%aeropuerto de nogales%' OR 
        Encabezado like '%aeropuerto de nuevo laredo%' OR 
        Encabezado like '%aeropuerto de poza rica%' OR 
        Encabezado like '%aeropuerto de puebla%' OR 
        Encabezado like '%aeropuerto de puerto escondido%' OR 
        Encabezado like '%aeropuerto de tamuin%' OR 
        Encabezado like '%aeropuerto de tehuacan%' OR 
        Encabezado like '%aeropuerto de tepic%' OR 
        Encabezado like '%aeropuerto de uruapan%' OR 
        PieFoto like '%aeropuerto de campeche%' OR
        PieFoto like '%aeropuerto de ciudad del carmen%' OR
        PieFoto like '%aeropuerto de ciudad obregon%' OR
        PieFoto like '%aeropuerto de ciudad victoria%' OR
        PieFoto like '%aeropuerto de chetumal%' OR
        PieFoto like '%aeropuerto de colima%' OR
        PieFoto like '%aeropuerto de guaymas%' OR 
        PieFoto like '%aeropuerto de loreto%' OR 
        PieFoto like '%aeropuerto de matamoros%' OR 
        PieFoto like '%aeropuerto de nogales%' OR 
        PieFoto like '%aeropuerto de nuevo laredo%' OR 
        PieFoto like '%aeropuerto de poza rica%' OR 
        PieFoto like '%aeropuerto de puebla%' OR 
        PieFoto like '%aeropuerto de puerto escondido%' OR 
        PieFoto like '%aeropuerto de tamuin%' OR 
        PieFoto like '%aeropuerto de tehuacan%' OR 
        PieFoto like '%aeropuerto de tepic%' OR 
        PieFoto like '%aeropuerto de uruapan%' OR 
        PieFoto like '% red de aeropuertos y servicios auxiliares %' OR
        Encabezado like '% red de aeropuertos y servicios auxiliares %' OR

        Texto like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' OR
		Titulo like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' OR
		Encabezado like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' OR
		PieFoto like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' OR
		Autor like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' 
		OR
		Texto like '%Nuevo Aeropuerto Internacional%' OR
		Titulo like '%Nuevo Aeropuerto Internacional%' OR
		Encabezado like '%Nuevo Aeropuerto Internacional%' OR
		PieFoto like '%Nuevo Aeropuerto Internacional%' OR
		Autor like '%Nuevo Aeropuerto Internacional%' OR 

		Texto like '%Aeropuerto%' OR
    Titulo like '%Aeropuerto%' OR
    Encabezado like '%Aeropuerto%' OR
    PieFoto like '%Aeropuerto%' OR
    Autor like '%Aeropuerto%' OR

    Texto like '% ASUR %' OR
    Titulo like '% ASUR %' OR
    Encabezado like '% ASUR %' OR
    PieFoto like '% ASUR %' OR
    Autor like '% ASUR %' OR

    Texto like '% OMA %' OR
    Titulo like '% OMA %' OR
    Encabezado like '% OMA %' OR
    PieFoto like '% OMA %' OR
    Autor like '% OMA %' OR

    Texto like '% GAP %' OR
    Titulo like '% GAP %' OR
    Encabezado like '% GAP %' OR
    PieFoto like '% GAP %' OR
    Autor like '% GAP %' OR

    Texto like '%AICM%' OR
    Titulo like '%AICM%' OR
    Encabezado like '%AICM%' OR
    PieFoto like '%AICM%' OR
    Autor like '%AICM%' OR

Texto like '%aeropuertos en sociedad%' OR
        Texto like '%aeropuerto de cuernavaca%' OR
        Texto like '%aeropuerto de queretaro%' OR       
        Texto like '%aeropuerto de toluca%' OR       
        Texto like '%aeropuerto de tuxtla gutierrez%' OR       
       Texto like '%aeropuerto de palenque%' OR       

       Titulo like '%aeropuertos en sociedad%' OR
        Titulo like '%aeropuerto de cuernavaca%' OR
        Titulo like '%aeropuerto de queretaro%' OR       
        Titulo like '%aeropuerto de toluca%' OR       
        Titulo like '%aeropuerto de tuxtla gutierrez%' OR       
        Titulo like '%aeropuerto de palenque%' OR

        Encabezado like '%aeropuertos en sociedad%' OR
        Encabezado like '%aeropuerto de cuernavaca%' OR
        Encabezado like '%aeropuerto de queretaro%' OR       
        Encabezado like '%aeropuerto de toluca%' OR       
        Encabezado like '%aeropuerto de tuxtla gutierrez%' OR       
        Encabezado like '%aeropuerto de palenque%' OR       

        PieFoto like '%aeropuertos en sociedad%' OR
        PieFoto like '%aeropuerto de cuernavaca%' OR
        PieFoto like '%aeropuerto de queretaro%' OR       
        PieFoto like '%aeropuerto de toluca%' OR       
        PieFoto like '%aeropuerto de tuxtla gutierrez%' OR       
        PieFoto like '%aeropuerto de palenque%' OR

        Texto like '%Aeropuerto Internacional de la Ciudad de Mexico%' OR
		Titulo like '%Aeropuerto Internacional de la Ciudad de Mexico%' OR
		Encabezado like '%Aeropuerto Internacional de la Ciudad de Mexico%' OR
		PieFoto like '%Aeropuerto Internacional de la Ciudad de Mexico%' OR
		Autor like '%Aeropuerto Internacional de la Ciudad de Mexico%' OR

Texto like '%Aeropuerto de la Ciudad de Mexico%' OR
                Titulo like '%Aeropuerto de la Ciudad de Mexico%' OR
                Encabezado like '%Aeropuerto de la Ciudad de Mexico%' OR
                PieFoto like '%Aeropuerto de la Ciudad de Mexico%' OR
                Autor like '%Aeropuerto de la Ciudad de Mexico%' OR

Texto like '%AICM%' OR
                Titulo like '%AICM%' OR
                Encabezado like '%AICM%' OR
                PieFoto like '%AICM%' OR
                Autor like '%AICM%' OR

               Texto like '%Aeropuerto de Ixtepec%' OR
		Titulo like '%Aeropuerto de Ixtepec%' OR
		Encabezado like '%Aeropuerto de Ixtepec%' OR
		PieFoto like '%Aeropuerto de Ixtepec%' OR
		Autor like '%Aeropuerto de Ixtepec%' OR 


Texto like '%Aeropuerto de Creel%' OR
		Titulo like '%Aeropuerto de Creel%' OR
		Encabezado like '%Aeropuerto de Creel%' OR
		PieFoto like '%Aeropuerto de Creel%' OR
		Autor like '%Aeropuerto de Creel%' OR

		Texto like '%Aeropuerto de Atlangatepec%' OR
		Titulo like '%Aeropuerto de Atlangatepec%' OR
		Encabezado like '%Aeropuerto de Atlangatepec%' OR
		PieFoto like '%Aeropuerto de Atlangatepec%' OR
		Autor like '%Aeropuerto de Atlangatepec%' OR

		Texto like '%Aeropuerto de Xalapa%' OR
		Titulo like '%Aeropuerto de Xalapa%' OR
		Encabezado like '%Aeropuerto de Xalapa%' OR
		PieFoto like '%Aeropuerto de Xalapa%' OR
		Autor like '%Aeropuerto de Xalapa%' 
 )
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
					$filename = "/var/www/external/testigos/asa/infoGeneral/".$row['Fecha']."/".$ids.'.pdf';
					if(!is_dir("/var/www/external/testigos/asa/infoGeneral/".$row['Fecha']."/")){

						mkdir("/var/www/external/testigos/asa/infoGeneral/".$row['Fecha'],true,0777);
						chmod("/var/www/external/testigos/asa/infoGeneral/".$row['Fecha'],0777);
						umask($antigua);
					}

					if(is_dir("/var/www/external/testigos/asa/infoGeneral/".$row['Fecha']."/")){
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
    		if(!in_array("/var/www/external/testigos/asa/infoGeneral/".$fecha."/".$x, $pdfs)){
    			$pdfs[] = "/var/www/external/testigos/asa/infoGeneral/".$fecha."/".$x;
    		}
    		
    	}

    	if(!empty($pdfs)){
    		$pdf->setFiles($pdfs);
    		$pdf->concat();

    		mkdir("/var/www/external/testigos/asa/infoGeneral/".$fecha."/compendio",true, 0777);
    		chmod("/var/www/external/testigos/asa/infoGeneral/".$fecha."/compendio",0777);
    		umask(umask(0));

    		$nombre = "/var/www/external/testigos/asa/infoGeneral/".$fecha."/compendio/".$fecha.".pdf";
    		$pdf->Output($nombre, 'F');
    	}
    }
