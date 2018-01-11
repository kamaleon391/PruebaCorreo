<?php
function query($personaje){
	$sql="";
	switch ($personaje) {
		case 1:
			$sql="(
            Texto like '%secretario De gobernacion%' OR
            Texto like '%titular de la SEGOB%' OR
            Texto like '%titular de la secretaria de gobernacion%' OR
            Texto like '%miguel angel osorio chong%' OR  
            Texto like 'miguel angel osorio chong' OR
            Texto like 'miguel osorio' OR
            Texto like '%Miguel Ángel Osorio%' OR    
            Texto like '%Osorio Chong%' OR
            Texto like '%Osorio Chong%' OR
            Texto like '%sorio Chong%' OR
            Texto like '%OsorioChong%' OR
            Texto like '%sorio C hong%' OR
            Texto like '%sorio C h on g%' OR
            Texto like '%secretario Chong%' OR
            Texto like '%gobernachong%' OR
            Texto like '% chong %' OR
            Texto like '%chong %' OR

            Titulo like '%secretario De gobernacion%' OR
            Titulo like '%titular de la SEGOB%' OR
            Titulo like '%titular de la secretaria de gobernacion%' OR
            Titulo like '%miguel angel osorio chong%' OR  
            Titulo like 'miguel angel osorio chong' OR
            Titulo like 'miguel osorio' OR
            Titulo like '%Miguel Angel osorio%' OR    
            Titulo like '%Osorio Chong%' OR
            Titulo like '%Osorio Chong%' OR
            Titulo like '%sorio Chong%' OR
            Titulo like '%OsorioChong%' OR
            Titulo like '%sorio C hong%' OR
            Titulo like '%sorio C h on g%' OR
            Titulo like '%secretario Chong%' OR
            Titulo like '%gobernachong%' OR
            Titulo like '%chong %' OR

            Encabezado like '%secretario De gobernacion%' OR
            Encabezado like '%titular de la SEGOB%' OR
            Encabezado like '%titular de la secretaria de gobernacion%' OR
            Encabezado like '%miguel angel osorio chong%' OR  
            Encabezado like 'miguel angel osorio chong' OR
            Encabezado like 'miguel osorio' OR
            Encabezado like '%Miguel Angel osorio%' OR    
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%sorio Chong%' OR
            Encabezado like '%OsorioChong%' OR
            Encabezado like '%sorio C hong%' OR
            Encabezado like '%sorio C h on g%' OR
            Encabezado like '%secretario Chong%' OR
            Encabezado like '%gobernachong%' OR
            Encabezado like '%chong %'
           ) AND (
					Texto not like '%ex secretario De gobernacion%' AND
					Texto not like '%exsecretario De gobernacion%' AND
					Texto not like '%sub secretario De gobernacion%' AND
					Texto not like '%subsecretario De gobernacion%' AND
                                        Texto not like '%Alberto Flores Chong%' AND 
                                        Texto not like '%Flores Chong%'

			)";
		break;//Secretario 

		case 2:
			
		break;
	}
	return $sql;
}

function queryBasePrensa($fecha1,$fecha2){
	$sql="SELECT n.Fecha , e.Nombre AS Estado, p.Nombre as Periodico, n.Titulo, n.PaginaPeriodico,  c.Categoria as Categoria, CASE n.Categoria WHEN 21 THEN 'Nota en Portada' WHEN 3 THEN 'Nota Principal' ELSE 'Interior' END 'Nota',  n.Autor,   n.Texto, n.Encabezado, CONCAT('http://www.gaimpresos.com/Periodicos/', replace(  p.Nombre,' ', '%20' ) ,'/',n.Fecha,'/',NumeroPagina) AS 'pdf'
			FROM
			(
			  SELECT * FROM monitoreoGa.noticiasDia  WHERE fecha BETWEEN DATE('".$fecha1."') AND DATE('".$fecha2."') AND Categoria != 80 AND Activo = 1 
			  UNION
			  SELECT * FROM monitoreoGa.noticiasSemana  WHERE fecha BETWEEN DATE('".$fecha1."') AND DATE('".$fecha2."') AND Categoria != 80 AND Activo = 1 
			  UNION
			  SELECT * FROM monitoreoGa.noticiasMensual  WHERE fecha BETWEEN DATE('".$fecha1."') AND DATE('".$fecha2."') AND Categoria != 80 AND Activo = 1 
			  UNION
			  SELECT * FROM monitoreoGa.noticiasAnual  WHERE fecha BETWEEN DATE('".$fecha1."') AND DATE('".$fecha2."') AND Categoria != 80 AND Activo = 1 

			) n JOIN monitoreoGa.periodicos p ON p.idPeriodico=n.Periodico
			JOIN  monitoreoGa.seccionesPeriodicos s ON s.idSeccion=n.Seccion 
			JOIN  monitoreoGa.categoriasPeriodicos c ON c.idCategoria=n.Categoria
			JOIN  monitoreoGa.estados e ON p.Estado=e.idEstado
			WHERE";
	return $sql;
}
//ORDER BY n.Fecha asc, 3

function reporteExcel($personaje,$query){
	
	require '../conexion.php';
	//echo "Paso la conexion <br>";
	date_default_timezone_set('America/Mexico_City');
	//echo "configuracion de ciudad";
	/** Se agrega la libreria PHPExcel */
	 require_once '../PHPExcel-1.8/Classes/PHPExcel.php';
	 
	//echo "Llamado a la clase <br>";
	// Se crea el objeto PHPExcel
	 $objPHPExcel = new PHPExcel();
	 //echo "Objeto instanciado <br>";
	 // Se asignan las propiedades del libro
	$objPHPExcel->getProperties()->setCreator("Grupo Arte y Comunicacion") // Nombre del autor
			    ->setLastModifiedBy("Ga Guadalajara") //Ultimo usuario que lo modificó
			    ->setTitle($personaje) // Titulo
			    ->setSubject("Respaldo Testigos") //Asunto
			    ->setDescription("Documento con Base de datos de Respaldo de Testigos") //Descripción
			    ->setKeywords("SEGOB") //Etiquetas
			    ->setCategory("Reporte excel"); //Categorias

	$tituloReporte = "Respaldo de Testigos SEGOB - ".$personaje;
	$titulosColumnas = array('Fecha', 'Estado', 'Periodico', 'Titulo','Pagina Periodico', 'Categoria', 'Nota', 'Autor', 'Texto', 'Encabezado', 'Testigo PDF');
	
	// Se combinan las celdas A1 hasta J1, para colocar ahí el titulo del reporte
	$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:K1');

    // Se agregan los titulos del reporte
	$objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A1',$tituloReporte) // Titulo del reporte
			    ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B3',  $titulosColumnas[1])
			    ->setCellValue('C3',  $titulosColumnas[2])
			    ->setCellValue('D3',  $titulosColumnas[3])
			    ->setCellValue('E3',  $titulosColumnas[4])
			    ->setCellValue('F3',  $titulosColumnas[5])
			    ->setCellValue('G3',  $titulosColumnas[6])
			    ->setCellValue('H3',  $titulosColumnas[7])
			    ->setCellValue('I3',  $titulosColumnas[8])
			    ->setCellValue('J3',  $titulosColumnas[9])
			    ->setCellValue('K3',  $titulosColumnas[10]);
	
	$resultado=mysql_query($query);

	if(mysql_affected_rows()>0){
		//Se agregan los datos
		$i = 4; //Numero de fila donde se va a comenzar a rellenar
	 	while($fila=mysql_fetch_array($resultado)){
	 		$objPHPExcel->setActiveSheetIndex(0)
		         ->setCellValue('A'.$i, $fila['Fecha'])
		         ->setCellValue('B'.$i, utf8_encode($fila['Estado']))
		         ->setCellValue('C'.$i, utf8_encode($fila['Periodico']))
		         ->setCellValue('D'.$i, utf8_encode($fila['Titulo']))
		         ->setCellValue('E'.$i, utf8_encode($fila['PaginaPeriodico']))
		         ->setCellValue('F'.$i, utf8_encode($fila['Categoria']))
		         ->setCellValue('G'.$i, utf8_encode($fila['Nota']))
		         ->setCellValue('H'.$i, utf8_encode($fila['Autor']))
		         ->setCellValue('I'.$i, utf8_encode($fila['Texto']))
		         ->setCellValue('J'.$i, utf8_encode($fila['Encabezado']))
		         ->setCellValue('K'.$i, $fila['pdf']);

	        $i++;
	 	}
	}else{
		echo "Sin Resultados: ".mysql_error()."<br>".$resultado."<br>Consulta:".$query."<br><br>";
	}
	 ///FORMATO EXCEL
	 
		 $estiloTituloReporte = array(
	    'font' => array(
	        'name'      => 'Verdana',
	        'bold'      => true,
	        'italic'    => false,
	        'strike'    => false,
	        'size' =>16,
	        'color'     => array(
	            'rgb' => 'FFFFFF'
	        )
	    ),
	    'fill' => array(
	      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
	      'color' => array(
	            'argb' => 'FF220835')
	  ),
	    'borders' => array(
	        'allborders' => array(
	            'style' => PHPExcel_Style_Border::BORDER_NONE
	        )
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0,
	        'wrap' => TRUE
	    )
	);
	 
	$estiloTituloColumnas = array(
	    'font' => array(
	        'name'  => 'Arial',
	        'bold'  => true,
	        'color' => array(
	            'rgb' => 'FFFFFF'
	        )
	    ),
	    'fill' => array(
	        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
	  'rotation'   => 90,
	        'startcolor' => array(
	            'rgb' => 'c47cf2'
	        ),
	        'endcolor' => array(
	            'argb' => 'FF431a5d'
	        )
	    ),
	    'borders' => array(
	        'top' => array(
	            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
	            'color' => array(
	                'rgb' => '143860'
	            )
	        ),
	        'bottom' => array(
	            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
	            'color' => array(
	                'rgb' => '143860'
	            )
	        )
	    ),
	    'alignment' =>  array(
	        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'wrap'      => TRUE
	    )
	);
	 
	$estiloInformacion = new PHPExcel_Style();
	$estiloInformacion->applyFromArray( array(
	    'font' => array(
	        'name'  => 'Arial',
	        'color' => array(
	            'rgb' => '000000'
	        )
	    ),
	    'fill' => array(
	  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
	  'color' => array(
	            'argb' => 'FFd9b7f4')
	  ),
	    'borders' => array(
	        'left' => array(
	            'style' => PHPExcel_Style_Border::BORDER_THIN ,
	      'color' => array(
	              'rgb' => '3a2a47'
	            )
	        )
	    )
	));
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->applyFromArray($estiloTituloColumnas);
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:K".($i-1));
	//$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:K4");

	//Anchos de columnas
	for($i = 'A'; $i <= 'K'; $i++){
    	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
	}	
	// Se asigna el nombre a la hoja
	$objPHPExcel->getActiveSheet()->setTitle($personaje);
	 
	// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
	$objPHPExcel->setActiveSheetIndex(0);
	 
	// Inmovilizar paneles
	//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
	$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
	// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Historicos_'.$personaje.'.xlsx"');
	header('Cache-Control: max-age=0');
	 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
	
}

function main(){
	//echo "funcionando.... <br>";
	$queryBase=queryBasePrensa("2017-05-01","2017-05-30");
	$personaje=1;
	$query=query(1);
	$queryFinal=$queryBase.$query."ORDER BY n.Fecha asc, 3";
        try {
            reporteExcel("Secretario",$queryFinal);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
	
}

main();
?>