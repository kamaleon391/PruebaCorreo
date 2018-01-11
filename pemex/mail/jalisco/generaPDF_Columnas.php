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
      $pdf->setTextColor(150,150,150);
      $pdf->Ln(3);
      $pdf->Cell(200, 5, $titulo,0, 0, 'C', false);
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
            $pdf->MultiCell(200, 5, " ".utf8_decode($row["Seccion"])." / ".$periodico ,0, 'L', false);

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

        if(is_file("/var/www/external/services/mail/portadas/thumbs/thumb-{$idPeriodico}.jpg") && file_exists("/var/www/external/services/mail/portadas/thumbs/thumb-".$idPeriodico.".jpg"))
        {
            $pdf->Image("/var/www/external/services/mail/portadas/thumbs/thumb-{$idPeriodico}.jpg",20,$y,0,0,'PNG');

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

function cartonesPDF($pdf,$sql)
{
  $y    = 55;
  $x    = $pdf->getX();
  $i    = 0;
  
  $urlP = "http://187.247.253.5";
  
  $pdf->SetFont("arial", "B", 16);
  $pdf->setTextColor(179,0,0);
  
  $pdf->AddPage();
  $pdf->Cell(200, 5, "CARTONES",0, 0, 'L', false);
  
  $y    +=10;

  $resp=  mysql_query($sql);

  $flag = 0;

  while($row= mysql_fetch_array($resp))
  {
    if($flag == 1)
    {
      $pdf->AddPage();
    } 
    $i++;
    $idPeriodico = $row['idPeriodico'];
    $periodico   = utf8_encode($row['Periodico']);
    $encabezado  = utf8_encode($row['Encabezado']);
    $periodico   =  ucwords($periodico);
    $titulito    = strtoupper($row['Titulo']);
    
    
    $titulito    = correctorOrtografico2($titulito);
    
    $titulito    = convert_Mayus($titulito);

    if(is_file($row['jpg']) && file_exists($row['jpg']))
    {
      $pdf->Image($row['jpg'],9,30,200,290,'JPG');
      $flag = 1;
    } 
    else
    {
      $flag = 0;
    }           
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

$pdf->SetFont("arial", "B", 16);
$pdf->setTextColor(0);
$pdf->MultiCell(190,10, utf8_decode("SÍNTESIS ELECTRÓNICA DE MEDIOS IMPRESOS DE ").fecha_completa2(date('Y-m-d')) ,0,'C',false);

//Columnas

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
p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
n.Periodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(1) AND
e.idEstado=p.Estado AND
n.Fecha=CURDATE()
GROUP BY n.idEditorial
  ORDER BY o.posicion";

texto($pdf,$sql,"EDITORIALES Y COLUMNAS",Array());

$pdf->Ln(12);

// Cartones

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
  CONCAT('/var/www/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg', 
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
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Periodico=o.periodico AND
    s.idSeccion=n.Seccion AND
    c.idCategoria=n.Categoria AND
    c.idCategoria in(18) AND
    e.idEstado=p.Estado
  GROUP BY pdf
  ORDER BY o.posicion";

cartonesPDF($pdf,$sql);

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

//$nombre = "/home/badillo/Documents/Columnas Jalisco ".date('Y-m-d').".pdf";
$nombre = "/var/www/external/testigos/Jalisco/Columnas Jalisco ".date('Y-m-d').".pdf";

$pdf->Output($nombre, 'F'); 

?>
