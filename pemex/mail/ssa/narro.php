<?php



$tema ="";



$opc = $_GET['option'];
$ids=$_GET['ids'];
$idsd = array($ids);
$idsr = implode($idsd);





switch ($opc) {
    case 1:
      $tema = "Dr. José Narro Robles ";
    break;

    case 2:
      $tema = "Secretaria de Salud";
    break;
    case 3:
      $tema = "8 Columnas";
    break;
    case 4:
      $tema = "IMSS, DIF, ISSSTE";
    break;
    case 5:
      $tema = "Durango, SLP y Zacatecas";
    break;
}

function condicionesWhere($opc){
    global $idsr;

    switch ($opc) {
      case 1:
      case 2:
      case 3:
        $query = "SELECT
                        DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion',
                         s.seccion AS 'Seccion',n.PaginaPeriodico as 'NumeroPagina', n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                      FROM
                        noticiasDia n,
                        ordenGeneral o,
                        periodicos p,
                        seccionesPeriodicos s
                      WHERE
                        n.Periodico=o.periodico AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND
                        n.Fecha= CURDATE() AND
                        n.idEditorial in ($idsr)
                      GROUP BY n.Periodico, n.PaginaPeriodico
                      ORDER BY n.Periodico";
      break;
      case 4:
        $query = "SELECT
                        DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion',
                         s.seccion AS 'Seccion',n.PaginaPeriodico as 'NumeroPagina', n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                      FROM
                        noticiasDia n,
                        ordenGeneral o,
                        periodicos p,
                        seccionesPeriodicos s
                      WHERE
                        n.Periodico=o.periodico AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND
                        n.Fecha= CURDATE() AND
                        (
                          n.titulo LIKE '% IMSS %' OR
                          n.titulo LIKE '%Instituto Mexicano del Seguro Social%' OR 
                          n.titulo LIKE '% ISSSTE %' OR
                          n.titulo LIKE '% DIF %' OR 
                          n.encabezado LIKE '% IMSS %' OR
                          n.encabezado LIKE '%Instituto Mexicano del Seguro Social%' OR 
                          n.encabezado LIKE '% ISSSTE %' OR
                          n.encabezado LIKE '% DIF %' OR
                          n.texto LIKE '% IMSS %' OR
                          n.texto LIKE '%Instituto Mexicano del Seguro Social%' OR 
                          n.texto LIKE '% ISSSTE %' OR
                          n.texto LIKE '% DIF %'
                        )
                      GROUP BY n.Periodico, n.PaginaPeriodico
                      ORDER BY n.Periodico";
      break;
      case 5:
        $query = "SELECT
                        DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion',
                         s.seccion AS 'Seccion',n.PaginaPeriodico as 'NumeroPagina', n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                      FROM
                        noticiasDia n,
                        ordenGeneral o,
                        periodicos p,
                        seccionesPeriodicos s
                      WHERE
                        n.Periodico=o.periodico AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND
                        n.Fecha= CURDATE() AND
                        (
                          n.titulo LIKE '%Durango%' OR
                          n.titulo LIKE '%SLP%' OR 
                          n.titulo LIKE '% Zacatecas %' OR
                          n.encabezado LIKE '%Durango%' OR
                          n.encabezado LIKE '%SLP%' OR 
                          n.encabezado LIKE '%Zacatecas%' OR
                          n.texto LIKE '%Durango%' OR
                          n.texto LIKE '%SLP%' OR 
                          n.texto LIKE '%Zacatecas%'
                        )
                      GROUP BY n.Periodico, n.PaginaPeriodico
                      ORDER BY n.Periodico";
      break;
    }
  return $query;
}

//$condicion = condicionesWhere($opc);


$query=condicionesWhere($opc);
//die();
/*"SELECT
	DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion',n.PaginaPeriodico as 'NumeroPagina', n.Texto,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
FROM
	noticiasDia n,
	ordenGeneral o,
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.Periodico=o.periodico AND
	n.Periodico=p.idPeriodico AND
	s.idSeccion = n.Seccion AND
	n.Fecha= CURDATE() AND
	$condicion
  GROUP BY n.Periodico, n.PaginaPeriodico
ORDER BY n.Periodico";*/


$tema=utf8_decode($tema);

ArmaPdf($query,$tema,"");

function ArmaPdf($query,$tema,$subtema){

	require_once('../fpdf17/fpdf.php');
  require_once('../FPDI-1.4.4/fpdi.php');
 	include "../conexion.php";

	$pdf = new FPDI('P','mm','A4');

    $data = mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0;
        $periodico=array();
        $seccion=array();
        $idPeriodico=array();
				$nombre=array();
				$pagina=array();
        $j=0;
        while ($row = mysql_fetch_array($data))
        {
              
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['Periodico'];
              $seccion[$i] = $row['Seccion'];
              $idPeriodico[$i] = $row['idPeriodico'];
							$pagina[$i]=$row['NumeroPagina'];
							//$nombre[$i]=$row['Periodico'];
            $i++;
        }

        //
        $pdf->addPage();

                    //rectangulo GRis ABAJO
                      $pdf->SetFillColor(245,245,245);
                      $pdf->Rect(0, 131, 250, 40, 'F');

                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,156,$tema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,"test");

                      $pdf->Image('logo.jpg',5,100,100);
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa(date('Y-m-d')));
        //
        for($j=0;$j<sizeof($periodico);$j++)
        {
            if(file_exists($variable[$j])){
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                      $pdf->Rect(0, 0, 250, 18, 'F');


                      //rentangulo Azul
                      //$pdf->SetFillColor(0, 191, 255);
                      //$pdf->Rect(0, 10, 140, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 20);
                      //$pdf->Text(10,18,strtoupper($periodico[$j]));
                      //$pdf->Image('/thumbs/thumb-'.$idPeriodico[$j].'.jpg',5,90,100);
                      $pdf->SetFont("arial", "B", 13);
                      //$pdf->setTextColor(255,255,255);
                      //$pdf->Text(0,0,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->SetY(8);
                      //$pdf->Cell(0,0,  ($tema).  ($subtema),0,'','R');
											         //Posisiiones: 1:Posx 2:Psoy 3:Ancho 4:Largo
											//$pdf->Rect(150, 20, 25, 8, 'B');
											//$pdf->Rect(125, 20, 25, 8, 'B');
											//$pdf->Cell(0,12, (' Seccion    ').('  Pagina'),0,'','R');
											//$pdf->Rect(170, 9, 50, 12, 'B');
											//$pdf->Rect(190, 9, 30, 12, 'B');
											//$pdf->Cell(0,22, ($seccion[$j]).'  '.($pagina[$j]),0,'','R');
                      $pdf->Image('logo.jpg',5,340,30);
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);
         


				 /***********************Otro codigo ********************/
				 $y = 8;
				 //$pdf->Image('/var/www/siscap.la/public/img/tableros/NAFINSA.png',5,5,60);

				 $pdf->SetTextColor( 0,0,0 );
				 // x = 265 Total
				 //$pdf->SetXY( 77, $y );
				 //$pdf->Cell(45, 5, utf8_decode("Medio"), 1, 1, 'C', false);
				 // x = 80
				 $pdf->SetFont("arial", "",10);
				 $pdf->SetXY(98, $y);
				 $pdf->Cell(40, 5, utf8_decode("Sección"), 1, 1, 'C', false);
				 // x = 105
				 $pdf->SetXY(138, $y);
				 $pdf->Cell(30, 5, utf8_decode("Pagina"), 1, 1, 'C', false);
				 // x = 130
				 $pdf->SetXY(168, $y);
				 $pdf->Cell(30, 5, utf8_decode("Fecha"), 1, 1, 'C', false);

				 $pdf->SetXY(98, $y+5);
				 $pdf->Cell(40, 5, $seccion[$j], 1, 1, 'C', false);

				 $pdf->SetXY(138, $y+5);
				 $pdf->Cell(30, 5, $pagina[$j], 1, 1, 'C', false);

				 $pdf->SetXY(168, $y+5);
				 $pdf->Cell(30, 5, date('Y-m-d'), 1, 1, 'C', false);

						/*Nomobre del periodico*/
				 $pdf->SetXY(5, $y+5);
				 //$pdf->Cell(35, 5, $periodico[$j], 1, 1, 'C', false);  //
         echo $idPeriodico[$j]."<br>";
				 $pdf->Image('thumbs/thumb-'.$idPeriodico[$j].'.jpg',5,$y,20,20);


/******************************************************************************/
				 								// Fecha para el PDF, esta en la posisio superior der
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      //$pdf->Text(182,13,date('Y-m-d'));
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }else{ }
        }

				// $tema=utf8_decode("Dr. José Narro Robles");
				$pdf->Output($tema.$subtema.".pdf", 'D');
        //$archi = '/var/www/external/services/mail/ssa/pdfs/'.$tema.$subtema'.pdf');
				//$pdf->Output('/var/www/external/services/mail/ssa/pdfs/'.$tema.$subtema'.pdf', 'D');



    }
    else
    {
        echo "<script>alert('No se encuentran Resultados de ".($tema)."$subtema');</script>";
    }
}

function mostrar_fecha_completa($fecha){
    $subfecha = explode("-",$fecha);

    $año=$subfecha[0];
    $mes=$subfecha[1];
    $dia=$subfecha[2];

    $dia2=date( "d", mktime(0,0,0,$mes,$dia,$año));
    $mes2=date( "m", mktime(0,0,0,$mes,$dia,$año));
    $año2=date( "Y", mktime(0,0,0,$mes,$dia,$año));
    $dia_sem=date( "w", mktime(0,0,0,$mes,$dia,$año));
$tema=utf8_decode("Dr. José Narro Robles");
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
         $dia_sem3='Miercoles';
       break;

       case "4":   // Bloque 1
         $dia_sem3='Jueves';
       break;

       case "5":   // Bloque 1
         $dia_sem3='Viernes';
       break;

       case "6":   // Bloque 1
         $dia_sem3='Sabado';
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
}
?>
