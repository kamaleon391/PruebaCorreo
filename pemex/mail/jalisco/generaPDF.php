<?php

error_reporting(E_ALL);

// Notificar todos los errores de PHP
error_reporting(-1);

require "/var/www/external/services/mail/conexion.php";
require "/var/www/external/services/mail/common.php";

mysql_query("set names 'utf8'");



function texto($pdf,$sql,$titulo, $buscar)
{
	static $ids_Array = Array();

  $urlP = "http://187.247.253.5";
  //$urlP = "http://192.168.3.154";
  mysql_query("set names 'utf8'");
  $data =  mysql_query($sql);

  if(mysql_affected_rows()>0)
  {

      /*
      $y = $pdf->GetY();
      $pdf->SetY($y+5);
      */
      //$pdf->Ln();


      $pdf->SetFont("arial", "B", 16);
      $pdf->setTextColor(179,0,0);
      $pdf->Ln(3);
      $pdf->Cell(200, 5, $titulo,0, 0, 'L', false);
      $pdf->Ln(8);
      $pdf->SetFillColor(255);


      while ($row = mysql_fetch_array($data)) 
      {
      	if(!in_array($row['idEditorial'],$ids_Array))
      	{     	

          if( !empty( trim($row['Texto'])  ) )
          {
              $periodico = utf8_decode( $row['Periodico'] );

              $autor = '';
              switch( strtolower($periodico) )
              {
                case "el milenio nacional":
                  $periodico = "Milenio";
                    $autor="Milenio";
                break;

                case "el reforma":
                  $periodico = "Reforma";
                    $autor="Reforma";
                break;

                case "la razon":
                  $periodico = utf8_decode("La Razón");
                    $autor="La Razón";
                break;

                case "la cronica":
                  $periodico = utf8_decode("La Crónica");
                    $autor="La Crónica";
                break;
            
                case "el sol de mexico":
                  $periodico = utf8_decode("El Sol de México");
                    $autor="El Sol de México";
                break;
              }

              /*
              if($ultimoPeriodico==0)
              {	
              		$ultimoPeriodico = $row['idPeriodico'];
              }
              else if($ultimoPeriodico != $row['idPeriodico'])
              {
              		$ultimoPeriodico = $row['idPeriodico'];
              		//$pdf->Image("/var/www/Imagenes/periodicos/portadas2/".ucwords(strtolower($ultimoPeriodico).".png"),0);
              }
              */
          
            
            $pdf->SetFont("arial", "B", 12);

            $titulo =  sanear_string(utf8_decode( $row['Titulo']));
       		$pdf->setTextColor(0);
            $pdf->MultiCell(200, 5, " ".correctorOrtografico2( $titulo )."" ,0, 'C', false);

            $pdf->SetFont("arial", "B", 10);
            $pdf->setTextColor(179,0,0);
            //$pdf->Ln();
            //$pdf->SetFillColor(230, 231, 237);
            //$pdf->MultiCell(200, 5, "Periodico: ".$periodico."    Fecha: ".utf8_decode( fecha_completa2($row['Fecha'])) ,0, 1, 'L', false);
            $pdf->MultiCell(200, 5, " ".utf8_decode($row["Seccion"]).", ".$periodico ,0, 'L', false);

            $pdf->SetFillColor(255);
            $pdf->Ln(2);
            
            $encabezado =  sanear_string(utf8_decode( $row['Encabezado']));
            //$pdf->MultiCell(200, 5, "TITULO: ".correctorOrtografico2( $titulo )."    ENCABEZADO: ".correctorOrtografico2( $encabezado ) ,0, 1, 'L', true);

           
          
            //$pdf->Ln();
            $pdf->setTextColor(0);
            $pdf->SetFont("arial", "", 9);
            $texto = sanear_string(utf8_decode(  $row['Texto']));
            $texto = correctorOrtografico2($texto);
            
            //$texto  = ( !empty($buscar) ) ? EncuentraArreglo2($texto,$buscar): $texto;
            //$texto  = EncuentraCoincidencias3($texto);
            


            $pdf->SetFillColor(255);
            $pdf->MultiCell(200,4, $texto ,0,'J',true);
            $pdf->SetFillColor(255);

            //$pdf->SetFont("arial", "B",11);
            //$pdf->Ln();
            //$pdf->MultiCell(200, 2, "Seccion: ".utf8_decode($row['Seccion'])."    Autor: ".utf8_decode(($row['Autor']==""?$periodico:$row['Autor'])) ,0, 1, 'L', false);


            $pdf->Ln();
            $pdf->SetFont("arial", "", 8);
            $pdf->SetTextColor(86, 104, 239);
            $pdf->Cell(20,4, "Ir al PDF",0,0,'L',false, $urlP ."/". $row['pdf'] );

            $pdf->Cell(30,4, "Ir a la Imagen",0,0,'L',false, $urlP ."/". $row['jpg'].".jpg" );
           
            $pdf->SetFont("arial", "", 7.5);
            $pdf->SetTextColor(0);
            $pdf->Cell( 150,4, "Link: ".$urlP ."/". $row['pdf'],0,0,'L',false, $urlP."/". $row['pdf']);
          
            $pdf->Ln(12);

            $ids_Array[] = $row['idEditorial'];
          }
      	}
      }
  }
  
}


function cintillosPDF($pdf,$sql,$tipo)
{
    $y = 55;
    $x = $pdf->getX();
    $i = 0;
   
    $urlP = "http://187.247.253.5";

      $pdf->SetFont("arial", "B", 16);
      $pdf->setTextColor(179,0,0);
      if($tipo==0)
      {
      	$pdf->MultiCell(190,10, utf8_decode("SÍNTESIS ELECTRÓNICA DE MEDIOS IMPRESOS DE ").fecha_completa2(date('Y-m-d')) ,0,'C',false);
      	$pdf->Ln(4);

      	$pdf->SetTextColor(150,150,150);
        $pdf->Cell(200, 5, "TITULARES DE PRENSA",0, 0, 'C', false);
        $pdf->Ln(8);
      }
      else
      {
        $pdf->AddPage();
        $pdf->Cell(200, 5, "CARTONES",0, 0, 'L', false);
      }
      
      $y+=10;

    $resp=  mysql_query($sql);
    while($row= mysql_fetch_array($resp))
    {

        $i++;
        $idPeriodico = $row['idPeriodico'];
        $periodico = utf8_encode($row['Periodico']);
        $encabezado = utf8_encode($row['Encabezado']);
        $periodico =  ucwords($periodico);
        $titulito = strtoupper($row['Titulo']);
       

        $titulito = correctorOrtografico2($titulito);

        $titulito = convert_Mayus($titulito);

        if(is_file("/var/www/external/services/mail/jalisco/LogosReporte/{$idPeriodico}.png") && file_exists("/var/www/external/services/mail/jalisco/LogosReporte/{$idPeriodico}.png"))
        {
            $pdf->Image("/var/www/external/services/mail/jalisco/LogosReporte/{$idPeriodico}.png",2,$y,0,0,'PNG');

            if($titulito!="")
            {
              $pdf->setY( $y + 4);
              $pdf->setX( $x + 60);
              $pdf->SetFont("arial", "B", 11);
              $pdf->SetTextColor(0);
              $pdf->Cell(200, 5, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'L', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              //$pdf->Cell(200,5,correctorOrtografico2(utf8_decode($encabezado),0,0,'L',false));
              $pdf->setY( $y + 4);
              $pdf->setX( $x + 180);
              $pdf->Cell(20, 5, "JPG" ,0, 0, 'R', FALSE, $urlP ."/". $row['jpg'].".jpg" );
              //$pdf->Line(0,$pdf->getY()+12,220,$pdf->getY()+12);
            }

          $y += 20;
        }else{
            if($titulito!="")
            {
                
              $pdf->setY( $y + 4);
              $pdf->setX( $x + 55);
              $pdf->SetFont("arial", "B", 11);
              $pdf->SetTextColor(0);
              $pdf->Cell(200, 5, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'L', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              //$pdf->Cell(200,5,correctorOrtografico2(utf8_decode($encabezado),0,0,'L',false));
              $pdf->setY( $y + 4);
              $pdf->setX( $x + 180);
              $pdf->Cell(20, 5, "JPG" ,0, 0, 'R', FALSE, $urlP ."/". $row['jpg'].".jpg" );
              //$pdf->Line(0,$pdf->getY()+12,220,$pdf->getY()+12);
            }

          $y += 20;
        }
      

        if($i == 14){
          $i = 0;
          $pdf->AddPage();
          $y = 40; 
        } 
        
        
    }
    if($tipo==0)
      {
        $pdf->AddPage();
      }
    
}

require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
 
class PDF extends FPDI
{
    // Cabecera de página
    function Header()
    {
    	$this->SetTextColor(0);

    	$this->SetFont('Arial','',16);

    	$this->Cell(0,10, "SINTESIS DE PRENSA" ,0,0,'C');
    	
    	$this->SetLineWidth(1);

    	$this->Line(10,20,207,20);


        //$this->Image('/var/www/external/services/mail/chre/logoGA2.png',80,10);
        //color negro
        
        // Arial bold 15
        
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->SetXY(150,30);
        //$this->Cell(50,10, "Resumen Ejecutivo / ".utf8_decode( fecha_completa2(date('Y-m-d')) ) ,0,0,'R');
        
        // Salto de línea
        $this->Ln(2);
    }


    // Pie de página
    function Footer()
    {
        //color negro
        $this->SetTextColor(0);
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().' / {nb}',0,0,'C');
    }

}

$pdf = new PDF('P','mm','legal');
$pdf->AliasNbPages();

$pdf->addPage();
$pdf->SetX(10);
$pdf->SetTextColor(0);
$pdf->SetFont('Arial','B',11);

/*

$sqlPlanas = "SELECT
        n.Periodico as idPeriodico,
        n.idEditorial,
        n.Titulo,
        p.Nombre as Periodico,
        e.Nombre AS Estado,
        n.Fecha,
        n.PaginaPeriodico,
        s.seccion,
        c.Categoria as Categoria,
        n.Autor,
        REPLACE(n.Texto,'\n',' ') Texto,
        CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
        CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
        n.Categoria as 'Num.Categoria',
        n.NumeroPagina,
        n.Hora,
        n.Encabezado,
        
        n.PieFoto
      FROM 
      (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n, 
      periodicos p, 
      ordenGeneraljalisco o,
      seccionesPeriodicos s,
      categoriasPeriodicos c,
      estados e
      WHERE 
      e.idEstado=p.Estado AND
      p.idPeriodico=n.Periodico AND
      p.idPeriodico=o.periodico AND
      s.idSeccion=n.Seccion AND
      c.idCategoria=n.Categoria AND
      c.idCategoria in(3) AND
      n.Activo = 1 AND
      fecha =CURDATE()
      GROUP BY n.NumeroPagina,p.idPeriodico
      ORDER BY n.Fecha";


texto($pdf, $sqlPlanas, $titulo = "PRIMERAS PLANAS", $buscar = array() );
*/
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
  CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , 
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg', 
  e.Nombre AS 'Estado',
  n.Autor,
  n.Periodico AS 'idPeriodico',
  n.Encabezado
  FROM 
	  noticiasDia n, 
      periodicos p, 
      ordenGeneraljalisco o,
      seccionesPeriodicos s,
      categoriasPeriodicos c,
      estados e
  WHERE 
   e.idEstado=p.Estado AND
      p.idPeriodico=n.Periodico AND
      p.idPeriodico=o.periodico AND
      s.idSeccion=n.Seccion AND
      c.idCategoria=n.Categoria AND
      c.idCategoria in(3) AND
      n.Activo = 1 AND
      fecha =CURDATE()
  GROUP BY p.Nombre
  ORDER BY o.posicion";

cintillosPDF($pdf,$sql,0);

$pdf->Ln(12);

//QUERY Gobernador Aristoteles Sandoval Portadas
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  (n.Categoria=3 OR n.Categoria =21) AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
   (
	    Titulo like '%Aristoteles Sandoval Diaz%' OR
	    Titulo like '%jorge Aristoteles Sandoval%' OR
	    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
	    Titulo like '%Sandoval Diaz%' OR
	    Titulo like '%Gobernador de jalisco%' OR
	    Titulo like '%Gobernador del Estado de  jalisco%' OR

	    Texto like '%Aristoteles Sandoval Diaz%' OR
	    Texto like '%jorge Aristoteles Sandoval%' OR
	    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
	    Texto like '%Sandoval Diaz%' OR
	    Texto like '%Gobernador de jalisco%' OR
	    Texto like '%Gobernador del Estado de  jalisco%' OR

	    Encabezado like '%Aristoteles Sandoval Diaz%' OR
	    Encabezado like '%jorge Aristoteles Sandoval%' OR
	    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
	    Encabezado like '%Sandoval Diaz%' OR
	    Encabezado like '%Gobernador de jalisco%' OR
	    Encabezado like '%Gobernador del Estado de  jalisco%'
    )
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Gobernador - Portadas"), $buscar);


//QUERY Gobernador Aristoteles Sandoval Portadas
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  n.Categoria NOT IN (3,21,80) AND
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
   (
	    Titulo like '%Aristoteles Sandoval Diaz%' OR
	    Titulo like '%jorge Aristoteles Sandoval%' OR
	    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
	    Titulo like '%Sandoval Diaz%' OR
	    Titulo like '%Gobernador de jalisco%' OR
	    Titulo like '%Gobernador del Estado de  jalisco%' OR

	    Texto like '%Aristoteles Sandoval Diaz%' OR
	    Texto like '%jorge Aristoteles Sandoval%' OR
	    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
	    Texto like '%Sandoval Diaz%' OR
	    Texto like '%Gobernador de jalisco%' OR
	    Texto like '%Gobernador del Estado de  jalisco%' OR

	    Encabezado like '%Aristoteles Sandoval Diaz%' OR
	    Encabezado like '%jorge Aristoteles Sandoval%' OR
	    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
	    Encabezado like '%Sandoval Diaz%' OR
	    Encabezado like '%Gobernador de jalisco%' OR
	    Encabezado like '%Gobernador del Estado de  jalisco%'
    )
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Gobernador"), $buscar);

/**********DEPENDENCIAS************/

//QUERY Inovacion Tecnologica
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
    Texto like '%jaime reyes robles%' OR
    Texto like '%reyes robles%' OR
    Texto like '%secretario de innovacion ciencia y tecnologia%' OR

    Titulo like'%jaime reyes robles%' OR
    Titulo like'%reyes robles%' OR
    Titulo like '%secretario de innovacion ciencia y tecnologia%' OR

    Encabezado like'%jaime reyes robles%' OR
    Encabezado like'%reyes robles%' OR
    Encabezado like '%secretario de innovacion ciencia y tecnologia%'
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretario de Innovacion Tecnologica"), $buscar);


//QUERY SEDECO
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
    Texto like '%secretario de desarrollo economico jalisco%' OR
    Texto like '%secretaria de desarrollo economico de jalisco%' OR
    Texto like '%Jose Palacios Jimenez%' OR
    Texto like '%Jose Palacios%' OR
    Texto like '%Palacios Jimenez%' OR
    Texto like '%SEDECO%'  AND (Titulo like '%jalisco%' OR Texto like '%Jalisco%' OR Encabezado like '%Jalisco%')  OR
    Texto like '%titular de la SEDECO%' AND(Texto not like '%salomon Chertorivski%') OR
    Texto like '% Ciudad Creativa Digital %'
OR
	Titulo like '%secretario de desarrollo economico jalisco%' OR
	Titulo like '%secretaria de desarrollo economico de jalisco%' OR
	Titulo like '%Jose Palacios Jimenez%' OR
	Titulo like '%Jose Palacios%' OR
	Titulo like '%Palacios Jimenez%' OR
	Titulo like '%SEDECO%' AND (Titulo like '%jalisco%' OR Texto like '%Jalisco%' OR Encabezado like '%Jalisco%')  OR
	Titulo like '%titular de la SEDECO%' OR
	Titulo like '%Plan Estatal de Desarrollo del estado de jalisco%' OR
	Titulo like '% Ciudad Creativa Digital %'
 OR
	Encabezado like '%secretario de desarrollo economico jalisco%' OR
	Encabezado like '%secretaria de desarrollo economico de jalisco%' OR
	Encabezado like '%Jose Palacios Jimenez%' OR
	Encabezado like '%Jose Palacios%' OR
	Encabezado like '%Palacios Jimenez%' OR
	Encabezado like '%SEDECO%' AND (Titulo like '%jalisco%' OR Texto like '%Jalisco%' OR Encabezado like '%Jalisco%')  OR
	Encabezado like '%titular de la SEDECO%' OR
	Encabezado like '%Plan Estatal de Desarrollo%' OR
	Encabezado like '%Ciudad Creativa Digital%'
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretario de Desarrollo Economico (SEDECO)"), $buscar);

//QUERY SEDIS
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de desarrollo e integracion social%' OR
	Texto like '%secretaria de desarrollo e integracion social%' OR
	Texto like '%Salvador rizo castelo%' OR
	Texto like '%Salvador rizo%' OR
	Texto like '%rizo castelo%' OR
	Texto like '%SEDIS%' OR
	Texto like '%titular de la secretaria de desarrollo e integracion social%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de desarrollo e integracion social%' OR
	Titulo like '%secretaria de desarrollo e integracion social%' OR
	Titulo like '%Salvador rizo castelo%' OR
	Titulo like '%Salvador rizo%' OR
	Titulo like '%rizo castelo%' OR
	Titulo like '%SEDIS%' OR
	Titulo like '%titular de la secretaria de desarrollo e integracion social%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de desarrollo e integracion social%' OR
	Encabezado like '%secretaria de desarrollo e integracion social%' OR
	Encabezado like '%Salvador rizo castelo%' OR
	Encabezado like '%Salvador rizo%' OR
	Encabezado like '%rizo castelo%' OR
	Encabezado like '%SEDIS%' OR
	Encabezado like '%titular de la secretaria de desarrollo e integracion social%'
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretaria de Desarrollo e Integracion Social (SEDIS)"), $buscar);

//QUERY RURAL
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de desarrollo Rural%' OR
	Texto like '%secretaria de desarrollo Rural%' OR
	Texto like '%Hector Padilla Gutierrez%' OR
	Texto like '%Hector Padilla%' OR
	Texto like '%Padilla Gutierrez%' OR
	Texto like '%titular de la secretaria de desarrollo Rural%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de desarrollo Rural%' OR
	Titulo like '%secretaria de desarrollo Rural%' OR
	Titulo like '%Hector Padilla Gutierrez%' OR
	Titulo like '%Hector Padilla%' OR
	Titulo like '%Padilla Gutierrez%' OR
	Titulo like '%titular de la secretaria de desarrollo Rural%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de desarrollo Rural%' OR
	Encabezado like '%secretaria de desarrollo Rural%' OR
	Encabezado like '%Hector Padilla Gutierrez%' OR
	Encabezado like '%Hector Padilla%' OR
	Encabezado like '%Padilla Gutierrez%' OR
	Encabezado like '%titular de la secretaria de desarrollo Rural%'
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("EMPRESARIOS"), $buscar);

//QUERY SEJ
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de educacion%' OR
	Texto like '%secretaria de educacion%' OR
	Texto like '%francisco ayon lopez%' OR
	Texto like '%francisco ayon%' OR
	Texto like '%ayon lopez%' OR
	Texto like '%titular de la secretaria de educacion%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de educacion%' OR
	Titulo like '%secretaria de educacion%' OR
	Titulo like '%francisco ayon lopez%' OR
	Titulo like '%francisco ayon%' OR
	Titulo like '%ayon lopez%' OR
	Titulo like '%titular de la secretaria de educacion%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de educacion%' OR
	Encabezado like '%secretaria de educacion%' OR
	Encabezado like '%francisco ayon lopez%' OR
	Encabezado like '%francisco ayon%' OR
	Encabezado like '%ayon lopez%' OR
	Encabezado like '%titular de la secretaria de educacion%'
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretaria de Eduacion Jalisco"), $buscar);

//QUERY Fiscalia
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%fiscal general%' OR
	Texto like '%fiscalia general%' OR
	Texto like '%luis carlos najera%' OR
	Texto like '%Carlos Najera Gutierrez%' OR
	Texto like '%Najera Gutierrez%' OR
	Texto like '%titular de la fiscalia general%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%fiscal general%' OR
	Titulo like '%fiscalia general%' OR
	Titulo like '%luis carlos najera%' OR
	Titulo like '%Carlos Najera Gutierrez%' OR
	Titulo like '%Najera Gutierrez%' OR
	Titulo like '%titular de la fiscalia general%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%fiscal general%' OR
	Encabezado like '%fiscalia general%' OR
	Encabezado like '%luis carlos najera%' OR
	Encabezado like '%Carlos Najera Gutierrez%' OR
	Encabezado like '%Najera Gutierrez%' OR
	Encabezado like '%titular de la fiscalia general%'
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Fiscalia"), $buscar);

//QUERY Movilidad
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de movilidad%' OR
	Texto like '%secretaria de movilidad%' OR
	Texto like '%mauricio gudino coronado%' OR
	Texto like '%mauricio gudino%' OR
	Texto like '%gudiño coronado%' OR
	Texto like '%titular de la secretaria de movilidad%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de movilidad%' OR
	Titulo like '%secretaria de movilidad%' OR
	Titulo like '%mauricio gudino coronado%' OR
	Titulo like '%mauricio gudino%' OR
	Titulo like '%gudiño coronado%' OR
	Titulo like '%titular de la secretaria de movilidad%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de movilidad%' OR
	Encabezado like '%secretaria de movilidad%' OR
	Encabezado like '%mauricio gudino coronado%' OR
	Encabezado like '%mauricio gudino%' OR
	Encabezado like '%gudiño coronado%' OR
	Encabezado like '%titular de la secretaria de movilidad%'
)

)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Movilidad"), $buscar);

//QUERY Secretaria General de Gobierno
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%secretaria general de gobierno%' OR
	Texto like '%roberto lopez lara%' OR
	Texto like '%roberto lopez%' OR
	Texto like '%lopez lara%' 
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretaria general de gobierno%' OR
	Titulo like '%roberto lopez lara%' OR
	Titulo like '%roberto lopez%' OR
	Titulo like '%lopez lara%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretaria general de gobierno%' OR
	Encabezado like '%roberto lopez lara%' OR
	Encabezado like '%roberto lopez%' OR
	Encabezado like '%lopez lara%' 
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretaria General de Gobierno"), $buscar);

//QUERY Secretario de Infraestructura y Obra Publica
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de infraestrutura y obra publica%' OR
	Texto like '%secretaria de infraestrutura y obra publica%' OR
	Texto like '%roberto davalos lopez%' OR
	Texto like '%roberto davalos%' OR
	Texto like '%davalos lopez%' 
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de infraestrutura y obra publica%' OR
	Titulo like '%secretaria de infraestrutura y obra publica%' OR
	Titulo like '%roberto davalos lopez%' OR
	Titulo like '%roberto davalos%' OR
	Texto like '%davalos lopez%' 
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de infraestrutura y obra publica%' OR
	Encabezado like '%secretaria de infraestrutura y obra publica%' OR
	Encabezado like '%roberto davalos lopez%' OR
	Encabezado like '%roberto davalos%' OR
	Encabezado like '%davalos lopez%' 
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Infraestructura"), $buscar);

//QUERY SEMADET
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%secretario demedio ambiente y desarrollo territorial%' OR
	Texto like '%secretaria de medio ambiente y desarrollo territorial%' OR
	Texto like '%Maria Magdalena Ruiz Mejia%' OR
	Texto like '%Maria Magdalena Ruiz%' OR
	Texto like '%Maria Ruiz Mejia%'  OR
	Texto like '%Ruiz Mejia%'  OR
	Texto like '%SEMADET%' 
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario demedio ambiente y desarrollo territorial%' OR
	Titulo like '%secretaria de medio ambiente y desarrollo territorial%' OR
	Titulo like '%Maria Magdalena Ruiz Mejia%' OR
	Titulo like '%Maria Magdalena Ruiz%' OR
	Titulo like '%Maria Ruiz Mejia%'  OR
	Titulo like '%Ruiz Mejia%'  OR
	Titulo like '%SEMADET%' 
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario demedio ambiente y desarrollo territorial%' OR
	Encabezado like '%secretaria de medio ambiente y desarrollo territorial%' OR
	Encabezado like '%Maria Magdalena Ruiz Mejia%' OR
	Encabezado like '%Maria Magdalena Ruiz%' OR
	Encabezado like '%Maria Ruiz Mejia%'  OR
	Encabezado like '%Ruiz Mejia%'  OR
	Encabezado like '%SEMADET%' 
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretario de Medio Ambiente y Desarrollo Territorial (SEMADET)"), $buscar);

//QUERY SEPAF
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de planeacion administracion y finanzas%' OR
	Texto like '%secretaria de planeacion administracion y finanzas%' OR
	Texto like '%ricardo villanueva lomeli%' OR
	Texto like '%ricardo villanueva%' OR
	Texto like '%villanueva lomeli%'  OR
	Texto like '%SEPAF%' 
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de planeacion administracion y finanzas%' OR
	Titulo like '%secretaria de planeacion administracion y finanzas%' OR
	Titulo like '%ricardo villanueva lomeli%' OR
	Titulo like '%ricardo villanueva%' OR
	Titulo like '%villanueva lomeli%'  OR
	Titulo like '%SEPAF%' 
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de planeacion administracion y finanzas%' OR
	Encabezado like '%secretaria de planeacion administracion y finanzas%' OR
	Encabezado like '%ricardo villanueva lomeli%' OR
	Encabezado like '%ricardo villanueva%' OR
	Encabezado like '%villanueva lomeli%'  OR
	Encabezado like '%SEPAF%' 
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretario de Planeacion Administracion y Finanzas (SEPAF)"), $buscar);


//QUERY Procuraduria Social
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%' AND (
	Texto like '%procuraduria social%' OR
	Texto like '%procuradora social%' OR
	Texto like '%felicitas Velazquez Serrano%' OR
	Texto like '%felicitas Velazquez%' OR
	Texto like '%Velazquez Serrano%' 
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%procuraduria social%' OR
	Titulo like '%procuradora social%' OR
	Titulo like '%felicitas Velazquez Serrano%' OR
	Titulo like '%felicitas Velazquez%' OR
	Titulo like '%Velazquez Serrano%' 
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%procuraduria social%' OR
	Encabezado like '%procuradora social%' OR
	Encabezado like '%felicitas Velazquez Serrano%' OR
	Encabezado like '%felicitas Velazquez%' OR
	Encabezado like '%Velazquez Serrano%' 
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Procuraduria Social"), $buscar);




//QUERY Salud
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%'  AND (
	Texto like '%secretaria de salud jalisco%' OR
	Texto like '%secretario de salud jalisco%' OR
	Texto like '%jaime agustin gonzalez alvarez%' OR
	Texto like '%jaime agustin gonzalez%' OR
	Texto like '%jaime gonzalez alvarez%'  OR
	Texto like '%gonzalez alvarez%'  OR
	Texto like '%SSJ%'  OR
	Texto like '%Salud Jalisco%'  OR
	Texto like '%influenza%'  OR
	Texto like '%AH1N1%'  OR
	Texto like '%AH3N2%' 
) OR
Titulo like '%Jalisco%'  AND (
	Titulo like '%secretaria de salud jalisco%' OR
	Titulo like '%secretario de salud jalisco%' OR
	Titulo like '%jaime agustin gonzalez alvarez%' OR
	Titulo like '%jaime agustin gonzalez%' OR
	Titulo like '%jaime gonzalez alvarez%'  OR
	Titulo like '%gonzalez alvarez%'  OR
	Titulo like '%SSJ%'  OR
	Titulo like '%Salud Jalisco%'  OR
	Titulo like '%influenza%'  OR
	Titulo like '%AH1N1%'  OR
	Titulo like '%AH3N2%'  
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretaria de salud jalisco%' OR
	Encabezado like '%secretario de salud jalisco%' OR
	Encabezado like '%jaime agustin gonzalez alvarez%' OR
	Encabezado like '%jaime agustin gonzalez%' OR
	Encabezado like '%jaime gonzalez alvarez%'  OR
	Encabezado like '%gonzalez alvarez%'  OR
	Encabezado like '%SSJ%'  OR
	Encabezado like '%Salud Jalisco%'  OR
	Encabezado like '%influenza%'  OR
	Encabezado like '%AH1N1%'  OR
	Encabezado like '%AH3N2%'  
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretaria de Salud Jalisco"), $buscar);




//QUERY STPS
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Jalisco%'  AND (
	Texto like '%secretaria de trabajo y prevision social%' OR
	Texto like '%secretario de trabajo y prevision social%' OR
	Texto like '%jesus eduardo almaguer ramirez%' OR
	Texto like '%jesus eduardo almaguer%' OR
	Texto like '%eduardo almaguer ramirez%'  OR
	Texto like '%eduardo almaguer%'  OR
	Texto like '%(STPS) de Jalisco%'  OR
	Texto like '%STPS de Jalisco%'  OR
	Texto like '%STPS Jalisco%'  OR
	Texto like '%ocotlan Jalisco%'  OR
	Texto like '%ocotlan, Jalisco%'
) OR
Titulo like '%Jalisco%'  AND (
	Titulo like '%secretaria de trabajo y prevision social%' OR
	Titulo like '%secretario de trabajo y prevision social%' OR
	Titulo like '%jesus eduardo almaguer ramirez%' OR
	Titulo like '%jesus eduardo almaguer%' OR
	Titulo like '%eduardo almaguer ramirez%'  OR
	Titulo like '%eduardo almaguer%'  OR
	Titulo like '%(STPS) de Jalisco%'  OR
	Titulo like '%STPS de Jalisco%'  OR
	Titulo like '%STPS Jalisco%'  OR
	Titulo like '%ocotlan Jalisco%'  OR
	Titulo like '%ocotlan, Jalisco%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretaria de trabajo y prevision social%' OR
	Encabezado like '%secretario de trabajo y prevision social%' OR
	Encabezado like '%jesus eduardo almaguer ramirez%' OR
	Encabezado like '%jesus eduardo almaguer%' OR
	Encabezado like '%eduardo almaguer ramirez%'  OR
	Encabezado like '%eduardo almaguer%'  OR
	Encabezado like '%(STPS) de Jalisco%'  OR
	Encabezado like '%STPS de Jalisco%'  OR
	Encabezado like '%STPS Jalisco%'  OR
	Encabezado like '%ocotlan Jalisco%'  OR
	Encabezado like '%ocotlan, Jalisco%'
)
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretaria de Trabajo y Previcion Social (STPS)"), $buscar);




//QUERY Secretaria de Turismo
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(

	Texto like '%secretaria de turismo%' OR
	Texto like '%secretario de turismo%' OR
	Texto like '%jesus enrique ramos flores%' OR
	Texto like '%jesus ramos flores%' OR
	Texto like '%enrique ramos flores%'  OR
	Texto like '%ramos flores%'  OR
	Texto like '%jalisco es mexico%' 
 OR

	Titulo like '%secretaria de turismo%' OR
	Titulo like '%secretario de turismo%' OR
	Titulo like '%jesus enrique ramos flores%' OR
	Titulo like '%jesus ramos flores%' OR
	Titulo like '%enrique ramos flores%'  OR
	Titulo like '%ramos flores%'  OR
	Titulo like '%jalisco es mexico%' 
OR

	Encabezado like '%secretaria de turismo%' OR
	Encabezado like '%secretario de turismo%' OR
	Encabezado like '%jesus enrique ramos flores%' OR
	Encabezado like '%jesus ramos flores%' OR
	Encabezado like '%enrique ramos flores%'  OR
	Encabezado like '%ramos flores%'  OR
	Encabezado like '%jalisco es mexico%' 
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretaria de Turismo"), $buscar);


//QUERY Secretaria de Turismo
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
Texto like '%Contralor de Jalisco%' OR
Texto like '%Juan Jose banuelos%' AND (
    Texto like '%Contralor%' OR
    Texto like '%El Contralor%'
    )OR
Titulo like '%Contralor de Jalisco%' OR
Titulo like '%Juan Jose banuelos%' AND (
    Titulo like '%Contralor%' OR
    Titulo like '%El Contralor%'
    )
OR
Encabezado like '%Contralor de Jalisco%' OR
Encabezado like '%Juan Jose banuelos%' AND (
    Encabezado like '%Contralor%' OR
    Encabezado like '%El Contralor%'
    )
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Secretaria de Turismo"), $buscar);

/**********DEPENDENCIAS************/


//QUERY Municipios
$qryPersonaje="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
(
	Texto like '% Guadalajara %' OR
	Texto like '% Zapopan %' OR
	Texto like '% Tonala %' OR
	Texto like '% Tlaquepaque%' OR
	Texto like '% Tlajomulco%' OR
	Texto like '% ZMG%' OR
	Texto like '% Chapala%' OR
	Texto like '% Vallarta%' OR
	Texto like '% ocotlan%' OR
	Texto like '% los altos de jalisco%' OR
	Texto like '% La barca jalisco%' OR
	Texto like '% Pihuamo%' OR
	Texto like '% tecalitlan%' OR
	Texto like '% jilotlan de los dolores%' OR
	Texto like '% Santa maria del oro%' OR
	Texto like '% quitupan%' OR
	Texto like '% valle de juarez%' OR
	Texto like '%tizapan el alto%' OR
	Texto like '%Jamay%' OR
	Texto like '%Tenacatita%' OR
	Texto like '%temacapulin%' OR
	Texto like '%municipio de la huerta%' OR
	Texto like '%ribera de chapala%' OR
	Texto like '%ajijic%' OR
	Texto like '% ZMG %' OR
	Texto like '%Zona metropolitana de Guadalajara%' OR
	Texto like '%El Salto Jalisco%' OR
	Texto like '% ojuelos %' OR
	Texto like '%Ramiro Hernande Garcia%' OR
	Texto like '%Barba Mariscal%' OR
	Texto like '%Jorge Arana Arana%' OR
	Texto like '%Penal de Puente Grande %' OR
	Texto like '%Zapotlanejo%' OR
	Texto like '%Municipio de  Tala %' OR
	Texto like '%Lagos de moreno%' OR
	Texto like '%San juan de los lagos%' OR
	Texto like '%sayula%' OR
	Texto like '%ciudad guzman%' OR
	Texto like '% ayutla Jalisco%' OR
	Texto like '%el grullo Jalisco%' OR
	Texto like '%Ayotlan%' OR
	Texto like '%tomatlan Jalisco %' OR
	Texto like '%villa purificacion %' OR
	Texto like '%tecalitlan %' OR
	Texto like '%tuxpan  %' OR

	Titulo like '%Jalisco%' OR
	Titulo like '%Guadalajara%' OR
	Titulo like '%Zapopan%' OR
	Titulo like '%Tonala%' OR
	Titulo like '%Tlaquepaque%' OR
	Titulo like '%Tlajomulco%' OR
	Titulo like '%ZMG%' OR
	Titulo like '%Chapala%' OR
	Titulo like '%Vallarta%' OR
	Titulo like '% ocotlan%' OR
	Titulo like '%los altos de jalisco%' OR
	Titulo like '%La barca jalisco%' OR
	Titulo like '%Pihuamo%' OR
	Titulo like '%tecalitlan%' OR
	Titulo like '%jilotlan de los dolores%' OR
	Titulo like '%Santa maria del oro%' OR
	Titulo like '%quitupan%' OR
	Titulo like '%valle de juarez%' OR
	Titulo like '%tizapan el alto%' OR
	Titulo like '%Jamay%' OR
	Titulo like '%Tenacatita%' OR
	Titulo like '%temacapulin%' OR
	Titulo like '%municipio de la huerta%' OR
	Titulo like '%ribera de chapala%' OR
	Titulo like '%ajijic%' OR
	Titulo like '% ZMG %' OR
	Titulo like '%Zona metropolitana de Guadalajara%' OR
	Titulo like '%El Salto Jalisco%' OR
	Titulo like '% ojuelos jalisco%' OR
	Titulo like '%Ramiro Hernandez Garcia%' OR
	Titulo like '%Barba Mariscal%' OR
	Titulo like '%Jorge Arana Arana%' OR
	Titulo like '%Penal de Puente Grande %' OR
	Titulo like '%Zapotlanejo%' OR
	Titulo like '%Municipio de  Tala %' OR
	Titulo like '%Lagos de moreno%' OR
	Titulo like '%San juan de los lagos%' OR
	Titulo like '%sayula%' OR
	Titulo like '%ciudad guzman%' OR
	Titulo like '% ayutla Jalisco%' OR
	Titulo like '%el grullo %' OR
	Titulo like '%Ayotlan%' OR
	Titulo like '%tomatlan Jalisco %' OR
	Titulo like '%villa purificacion %' OR
	Titulo like '%tecalitlan %' OR
	Titulo like '%tuxpan  %' OR

	Encabezado like '%Jalisco%' OR
	Encabezado like '%Guadalajara%' OR
	Encabezado like '%Zapopan%' OR
	Encabezado like '%Tonala%' OR
	Encabezado like '%Tlaquepaque%' OR
	Encabezado like '%Tlajomulco%' OR
	Encabezado like '%ZMG%' OR
	Encabezado like '%Chapala%' OR
	Encabezado like '%Vallarta%' OR
	Encabezado like '% ocotlan%' OR
	Encabezado like '%los altos de jalisco%' OR
	Encabezado like '%La barca Jalisco%' OR
	Encabezado like '%Pihuamo%' OR
	Encabezado like '%tecalitlan%' OR
	Encabezado like '%jilotlan de los dolores%' OR
	Encabezado like '%Santa maria del oro%' OR
	Encabezado like '%quitupan%' OR
	Encabezado like '%valle de juarez%' OR
	Encabezado like '%tizapan el alto%' OR
	Encabezado like '%Jamay%' OR
	Encabezado like '%Tenacatita%' OR
	Encabezado like '%temacapulin%' OR
	Encabezado like '%municipio de la huerta%' OR
	Encabezado like '%ribera de chapala%' OR
	Encabezado like '%ajijic%' OR
	Encabezado like '% ZMG %' OR
	Encabezado like '%Zona metropolitana de Guadalajara%' OR
	Encabezado like '%El Salto Jalisco%' OR
	Encabezado like '% ojuelos %' OR
	Encabezado like '%Ramiro Hernandez Garcia%' OR
	Encabezado like '%Barba Mariscal%' OR
	Encabezado like '%Jorge Arana Arana%' OR
	Encabezado like '%Penal de Puente Grande %' OR
	Encabezado like '%Zapotlanejo%' OR
	Encabezado like '%Municipio de  Tala %' OR
	Encabezado like '%Lagos de moreno%' OR
	Encabezado like '%San juan de los lagos%' OR
	Encabezado like '%sayula%' OR
	Encabezado like '%ciudad guzman%' OR
	Encabezado like '% ayutla Jalisco%' OR
	Encabezado like '%el grullo %' OR
	Encabezado like '%Ayotlan%' OR
	Encabezado like '%tomatlan  Jalisco%' OR
	Encabezado like '%villa purificacion %' OR
	Encabezado like '%tecalitlan %' OR
	Encabezado like '%tuxpan  %'	
)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("Municipios"), $buscar);

/********************/


/********************/

//QUERY PARA Cartones
/*
$qryC = "SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico,n.NumeroPagina as 'PaginaPDF', REPLACE(n.Texto,'\n',' ') Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg', e.Nombre AS 'Estado',n.Autor,n.Encabezado,n.Periodico AS 'idPeriodico'
  FROM (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n, periodicos p, ordenGeneraljalisco o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Categoria in(18) AND
    e.idEstado=p.Estado AND
    p.Estado = 9 AND
    n.Activo = 1 AND
    s.idSeccion=n.Seccion AND
    Fecha=CURDATE() 
  ORDER BY n.Fecha";
  

$qryC = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion AS 'Seccion',
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina AS 'PaginaPDF',
  n.Fecha,
  n.Hora,
  n.Encabezado,
  
  n.PieFoto
FROM
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
  periodicos p,
  ordenGeneraljalisco o,
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
ORDER BY n.Fecha,o.posicion";

$buscar = array();
cintillosPDF($pdf,$qryC,1);
//texto($pdf, $qryC, $titulo = "Cartones", $buscar = array() );
*/

//$nombre = "/home/badillo/Documents/SintesisMedios Jalisco ".date('Y-m-d').".pdf";
$nombre = "/var/www/external/testigos/Jalisco/SintesisMediosJalisco/Sintesis Medios ".date('Y-m-d').".pdf";

$pdf->Output($nombre, 'F'); 

?>
