<?php

error_reporting(E_ALL);

// Notificar todos los errores de PHP
error_reporting(-1);

require "/var/www/external/services/mail/conexion.php";
require "/var/www/external/services/mail/common.php";

mysql_query("set names 'utf8'");


function texto($pdf,$sql,$titulo, $buscar)
{
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
      $pdf->Ln(3);
      $pdf->SetFillColor(255);

      while ($row = mysql_fetch_array($data)) 
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

            
            $pdf->SetFont("arial", "B", 10);
            $pdf->setTextColor(0);
            $pdf->Ln(4);
            $pdf->SetFillColor(230, 231, 237);
            //$pdf->MultiCell(200, 5, "Periodico: ".$periodico."    Fecha: ".utf8_decode( fecha_completa2($row['Fecha'])) ,0, 1, 'L', false);
            $pdf->MultiCell(200, 5, " ".$periodico.": ".$row["Fecha"] ,0, 1, 'L', false);

            $pdf->SetFillColor(255);
            $pdf->Ln(2);
            $titulo =  sanear_string(utf8_decode( $row['Titulo']));
            $encabezado =  sanear_string(utf8_decode( $row['Encabezado']));
            //$pdf->MultiCell(200, 5, "TITULO: ".correctorOrtografico2( $titulo )."    ENCABEZADO: ".correctorOrtografico2( $encabezado ) ,0, 1, 'L', true);
            $pdf->MultiCell(200, 5, " ".correctorOrtografico2( $titulo )."" ,0, 1, 'L', true);
           
          
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

            $pdf->SetFont("arial", "B",11);
            $pdf->Ln();
            $pdf->MultiCell(200, 2, "Seccion: ".utf8_decode($row['Seccion'])."    Autor: ".utf8_decode(($row['Autor']==""?$periodico:$row['Autor'])) ,0, 1, 'L', false);


            $pdf->Ln();
            $pdf->SetFont("arial", "", 8);
            $pdf->SetTextColor(86, 104, 239);
            $pdf->Cell(20,4, "Ir al PDF",0,0,'L',false, $urlP ."/". $row['pdf'] );

            $pdf->Cell(30,4, "Ir a la Imagen",0,0,'L',false, $urlP ."/". $row['jpg'].".jpg" );
           
            $pdf->SetFont("arial", "", 7.5);
            $pdf->SetTextColor(0);
            $pdf->Cell( 150,4, "Link: ".$urlP ."/". $row['pdf'],0,0,'L',false, $urlP."/". $row['pdf']);
          
            $pdf->Ln(5);
          }
      }
  }
  
}


function cintillosPDF($pdf,$sql,$tipo)
{
    $y = 40;
    $x = $pdf->getX();
    $i = 0;
   
    $urlP = "http://187.247.253.5";

      $pdf->SetFont("arial", "B", 16);
      $pdf->setTextColor(179,0,0);
      if($tipo==0)
      {
        $pdf->Cell(200, 5, "PRIMERAS PLANAS",0, 0, 'L', false);
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
        $periodico =  ucwords($periodico);
        $titulito = strtoupper($row['Titulo']);
       

        $titulito = correctorOrtografico2($titulito);

        $titulito = convert_Mayus($titulito);

        if(is_file("/var/www/Imagenes/periodicos/portadas2/".ucwords(strtolower($idPeriodico)).".png"))
        {
            $pdf->Image("/var/www/Imagenes/periodicos/portadas2/".ucwords(strtolower($idPeriodico).".png"),0,$y);

            if($titulito!="")
            {
              $pdf->setY( $y + 4);
              $pdf->setX( $x + 55);
              $pdf->SetFont("arial", "B", 11);
              $pdf->SetTextColor(86, 104, 239);
              $pdf->Cell(200, 5, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'L', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              $pdf->setY( $y + 4);
              $pdf->setX( $x + 180);
              $pdf->Cell(20, 5, "JPG" ,0, 0, 'R', FALSE, $urlP ."/". $row['jpg'].".jpg" );
              $pdf->Line(0,$pdf->getY()+12,220,$pdf->getY()+12);
            }

          $y += 20;
        }else{
            if($titulito!="")
            {
                
              $pdf->setY( $y + 4);
              $pdf->setX( $x + 55);
              $pdf->SetFont("arial", "B", 11);
              $pdf->SetTextColor(86, 104, 239);
              $pdf->Cell(200, 5, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'L', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              $pdf->setY( $y + 4);
              $pdf->setX( $x + 180);
              $pdf->Cell(20, 5, "JPG" ,0, 0, 'R', FALSE, $urlP ."/". $row['jpg'].".jpg" );
              $pdf->Line(0,$pdf->getY()+12,220,$pdf->getY()+12);
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
        // Logo
        $this->Image('/var/www/external/services/mail/chre/logoGA2.png',80,10);
        //color negro
        $this->SetTextColor(0);
        // Arial bold 15
        $this->SetFont('Arial','',11);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->SetXY(150,30);
        //$this->Cell(50,10, "Resumen Ejecutivo / ".utf8_decode( fecha_completa2(date('Y-m-d')) ) ,0,0,'R');
        $this->Cell(50,10, "Resumen Ejecutivo" ,0,0,'R');
        // Salto de línea
        $this->Ln(10);
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
  $sql = "SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico, n.NumeroPagina as 'PaginaPDF', REPLACE(n.Texto,'\n',' ') Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg', e.Nombre AS 'Estado',n.Autor,n.Periodico AS 'idPeriodico'
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
  GROUP BY p.Nombre
  ORDER BY n.Fecha";

cintillosPDF($pdf,$sql,0);

$pdf->Ln(12);


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

//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%CANACINTRA%' OR
    Texto like '%Rodrigo Alpizar Vallejo%' OR
    Texto like '%Jose Enoch Castellanos Ferez%' OR
    Texto like '%Raul Rodriguez Marquez%' OR
    Texto like '%COPARMEX%' OR
    Texto like '%Jose Medina Mora Icaza%' OR
    Texto like '%Luis Aranguren Trellez%' OR
    Texto like '%CANACO%' OR
    Texto like '%Rodrigo Arroyo Jimenez%' OR
    Texto like '%Fernando Topete Davila%' OR
    Texto like '%Carlos David Ibarra Rubio%' OR
    Texto like '%Leida Santillan Alvarez%' OR
    Texto like '%Union Ganadera Regional de Jalisco%' OR
    Texto like '%Andres Salvador Ramos Cano%' OR
    Texto like '%Alianza de Camioneros de Jalisco%' OR
    Texto like '%Hugo Higareda Macias%' OR
    Texto like '%Frente Unido de Subrogatarios y Concesionarios%' OR
    Texto like '%Jesus Arreola Ponce%' OR
    Texto like '%Mutualidad de Transporte del Estado de Jalisco%' OR
    Texto like '%MUTUJAL%' OR
    Texto like '%Fernando Soto Casillas%' OR
    Texto like '%Union de Comerciantes del Mercado de Abastos%' OR
    Texto like '%UCMA%' OR
    Texto like '%Miguel Fernando Gracian Ramirez%' OR
    Texto like '%Farmacias Guadalajara%' OR
    Texto like '%Javier Arroyo%' OR
    Texto like '%Jose Cuervo%' OR
    Texto like '%Juan Francisco Bekmann Vidal%' OR
    Texto like '%Grupo Omnilife%' OR
    Texto like '%Jorge Vergara%' OR
    Texto like '%Hilasal Mexicana%' OR
    Texto like '%Jorge Garcia Fernandez%' OR
    Texto like '%Grupo Simec%' OR
    Texto like '%Luis Garcia Limon%' OR
    Texto like '%Grupo Aeroportuario del Pacifico%' OR
    Texto like '%Fernando Bosque Mohino%' OR
    Texto like '%Rodrigo Guzman Perera%' OR
    Texto like '%Megacable%' OR
    Texto like '%Enrique Yamuni Robles%' OR
    Texto like '%Laboratorios Pisa%' OR
    Texto like '%Alfonso Alvarez Paramo%' OR
    Texto like '%Grupo Urrea%' OR
    Texto like '%Guillermo Urrea Carroll%' OR
    Texto like '%Grupo Favier%' OR
    Texto like '%Juan Jorge Favier%' OR

    Titulo like '%CANACINTRA%' OR
    Titulo like '%Rodrigo Alpizar Vallejo%' OR
    Titulo like '%Jose Enoch Castellanos Ferez%' OR
    Titulo like '%Raul Rodriguez Marquez%' OR
    Titulo like '%COPARMEX%' OR
    Titulo like '%Jose Medina Mora Icaza%' OR
    Titulo like '%Luis Aranguren Trellez%' OR
    Titulo like '%CANACO%' OR
    Titulo like '%Rodrigo Arroyo Jimenez%' OR
    Titulo like '%Fernando Topete Davila%' OR
    Titulo like '%Carlos David Ibarra Rubio%' OR
    Titulo like '%Leida Santillan Alvarez%' OR
    Titulo like '%Union Ganadera Regional de Jalisco%' OR
    Titulo like '%Andres Salvador Ramos Cano%' OR
    Titulo like '%Alianza de Camioneros de Jalisco%' OR
    Titulo like '%Hugo Higareda Macias%' OR
    Titulo like '%Frente Unido de Subrogatarios y Concesionarios%' OR
    Titulo like '%Jesus Arreola Ponce%' OR
    Titulo like '%Mutualidad de Transporte del Estado de Jalisco%' OR
    Titulo like '%MUTUJAL%' OR
    Titulo like '%Fernando Soto Casillas%' OR
    Titulo like '%Union de Comerciantes del Mercado de Abastos%' OR
    Titulo like '%UCMA%' OR
    Titulo like '%Miguel Fernando Gracian Ramirez%' OR
    Titulo like '%Farmacias Guadalajara%' OR
    Titulo like '%Javier Arroyo%' OR
    Titulo like '%Jose Cuervo%' OR
    Titulo like '%Juan Francisco Bekmann Vidal%' OR
    Titulo like '%Grupo Omnilife%' OR
    Titulo like '%Jorge Vergara%' OR
    Titulo like '%Hilasal Mexicana%' OR
    Titulo like '%Jorge Garcia Fernandez%' OR
    Titulo like '%Grupo Simec%' OR
    Titulo like '%Luis Garcia Limon%' OR
    Titulo like '%Grupo Aeroportuario del Pacifico%' OR
    Titulo like '%Fernando Bosque Mohino%' OR
    Titulo like '%Rodrigo Guzman Perera%' OR
    Titulo like '%Megacable%' OR
    Titulo like '%Enrique Yamuni Robles%' OR
    Titulo like '%Laboratorios Pisa%' OR
    Titulo like '%Alfonso Alvarez Paramo%' OR
    Titulo like '%Grupo Urrea%' OR
    Titulo like '%Guillermo Urrea Carroll%' OR
    Titulo like '%Grupo Favier%' OR
    Titulo like '%Juan Jorge Favier%' OR

        Encabezado like '%CANACINTRA%' OR
    Encabezado like '%Rodrigo Alpizar Vallejo%' OR
    Encabezado like '%Jose Enoch Castellanos Ferez%' OR
    Encabezado like '%Raul Rodriguez Marquez%' OR
    Encabezado like '%COPARMEX%' OR
    Encabezado like '%Jose Medina Mora Icaza%' OR
    Encabezado like '%Luis Aranguren Trellez%' OR
    Encabezado like '%CANACO%' OR
    Encabezado like '%Rodrigo Arroyo Jimenez%' OR
    Encabezado like '%Fernando Topete Davila%' OR
    Encabezado like '%Carlos David Ibarra Rubio%' OR
    Encabezado like '%Leida Santillan Alvarez%' OR
    Encabezado like '%Union Ganadera Regional de Jalisco%' OR
    Encabezado like '%Andres Salvador Ramos Cano%' OR
    Encabezado like '%Alianza de Camioneros de Jalisco%' OR
    Encabezado like '%Hugo Higareda Macias%' OR
    Encabezado like '%Frente Unido de Subrogatarios y Concesionarios%' OR
    Encabezado like '%Jesus Arreola Ponce%' OR
    Encabezado like '%Mutualidad de Transporte del Estado de Jalisco%' OR
    Encabezado like '%MUTUJAL%' OR
    Encabezado like '%Fernando Soto Casillas%' OR
    Encabezado like '%Union de Comerciantes del Mercado de Abastos%' OR
    Encabezado like '%UCMA%' OR
    Encabezado like '%Miguel Fernando Gracian Ramirez%' OR
    Encabezado like '%Farmacias Guadalajara%' OR
    Encabezado like '%Javier Arroyo%' OR
    Encabezado like '%Jose Cuervo%' OR
    Encabezado like '%Juan Francisco Bekmann Vidal%' OR
    Encabezado like '%Grupo Omnilife%' OR
    Encabezado like '%Jorge Vergara%' OR
    Encabezado like '%Hilasal Mexicana%' OR
    Encabezado like '%Jorge Garcia Fernandez%' OR
    Encabezado like '%Grupo Simec%' OR
    Encabezado like '%Luis Garcia Limon%' OR
    Encabezado like '%Grupo Aeroportuario del Pacifico%' OR
    Encabezado like '%Fernando Bosque Mohino%' OR
    Encabezado like '%Rodrigo Guzman Perera%' OR
    Encabezado like '%Megacable%' OR
    Encabezado like '%Enrique Yamuni Robles%' OR
    Encabezado like '%Laboratorios Pisa%' OR
    Encabezado like '%Alfonso Alvarez Paramo%' OR
    Encabezado like '%Grupo Urrea%' OR
    Encabezado like '%Guillermo Urrea Carroll%' OR
    Encabezado like '%Grupo Favier%' OR
    Encabezado like '%Juan Jorge Favier%' OR

        PieFoto like '%CANACINTRA%' OR
    PieFoto like '%Rodrigo Alpizar Vallejo%' OR
    PieFoto like '%Jose Enoch Castellanos Ferez%' OR
    PieFoto like '%Raul Rodriguez Marquez%' OR
    PieFoto like '%COPARMEX%' OR
    PieFoto like '%Jose Medina Mora Icaza%' OR
    PieFoto like '%Luis Aranguren Trellez%' OR
    PieFoto like '%CANACO%' OR
    PieFoto like '%Rodrigo Arroyo Jimenez%' OR
    PieFoto like '%Fernando Topete Davila%' OR
    PieFoto like '%Carlos David Ibarra Rubio%' OR
    PieFoto like '%Leida Santillan Alvarez%' OR
    PieFoto like '%Union Ganadera Regional de Jalisco%' OR
    PieFoto like '%Andres Salvador Ramos Cano%' OR
    PieFoto like '%Alianza de Camioneros de Jalisco%' OR
    PieFoto like '%Hugo Higareda Macias%' OR
    PieFoto like '%Frente Unido de Subrogatarios y Concesionarios%' OR
    PieFoto like '%Jesus Arreola Ponce%' OR
    PieFoto like '%Mutualidad de Transporte del Estado de Jalisco%' OR
    PieFoto like '%MUTUJAL%' OR
    PieFoto like '%Fernando Soto Casillas%' OR
    PieFoto like '%Union de Comerciantes del Mercado de Abastos%' OR
    PieFoto like '%UCMA%' OR
    PieFoto like '%Miguel Fernando Gracian Ramirez%' OR
    PieFoto like '%Farmacias Guadalajara%' OR
    PieFoto like '%Javier Arroyo%' OR
    PieFoto like '%Jose Cuervo%' OR
    PieFoto like '%Juan Francisco Bekmann Vidal%' OR
    PieFoto like '%Grupo Omnilife%' OR
    PieFoto like '%Jorge Vergara%' OR
    PieFoto like '%Hilasal Mexicana%' OR
    PieFoto like '%Jorge Garcia Fernandez%' OR
    PieFoto like '%Grupo Simec%' OR
    PieFoto like '%Luis Garcia Limon%' OR
    PieFoto like '%Grupo Aeroportuario del Pacifico%' OR
    PieFoto like '%Fernando Bosque Mohino%' OR
    PieFoto like '%Rodrigo Guzman Perera%' OR
    PieFoto like '%Megacable%' OR
    PieFoto like '%Enrique Yamuni Robles%' OR
    PieFoto like '%Laboratorios Pisa%' OR
    PieFoto like '%Alfonso Alvarez Paramo%' OR
    PieFoto like '%Grupo Urrea%' OR
    PieFoto like '%Guillermo Urrea Carroll%' OR
    PieFoto like '%Grupo Favier%' OR
    PieFoto like '%Juan Jorge Favier%' OR

        Autor like '%CANACINTRA%' OR
    Autor like '%Rodrigo Alpizar Vallejo%' OR
    Autor like '%Jose Enoch Castellanos Ferez%' OR
    Autor like '%Raul Rodriguez Marquez%' OR
    Autor like '%COPARMEX%' OR
    Autor like '%Jose Medina Mora Icaza%' OR
    Autor like '%Luis Aranguren Trellez%' OR
    Autor like '%CANACO%' OR
    Autor like '%Rodrigo Arroyo Jimenez%' OR
    Autor like '%Fernando Topete Davila%' OR
    Autor like '%Carlos David Ibarra Rubio%' OR
    Autor like '%Leida Santillan Alvarez%' OR
    Autor like '%Union Ganadera Regional de Jalisco%' OR
    Autor like '%Andres Salvador Ramos Cano%' OR
    Autor like '%Alianza de Camioneros de Jalisco%' OR
    Autor like '%Hugo Higareda Macias%' OR
    Autor like '%Frente Unido de Subrogatarios y Concesionarios%' OR
    Autor like '%Jesus Arreola Ponce%' OR
    Autor like '%Mutualidad de Transporte del Estado de Jalisco%' OR
    Autor like '%MUTUJAL%' OR
    Autor like '%Fernando Soto Casillas%' OR
    Autor like '%Union de Comerciantes del Mercado de Abastos%' OR
    Autor like '%UCMA%' OR
    Autor like '%Miguel Fernando Gracian Ramirez%' OR
    Autor like '%Farmacias Guadalajara%' OR
    Autor like '%Javier Arroyo%' OR
    Autor like '%Jose Cuervo%' OR
    Autor like '%Juan Francisco Bekmann Vidal%' OR
    Autor like '%Grupo Omnilife%' OR
    Autor like '%Jorge Vergara%' OR
    Autor like '%Hilasal Mexicana%' OR
    Autor like '%Jorge Garcia Fernandez%' OR
    Autor like '%Grupo Simec%' OR
    Autor like '%Luis Garcia Limon%' OR
    Autor like '%Grupo Aeroportuario del Pacifico%' OR
    Autor like '%Fernando Bosque Mohino%' OR
    Autor like '%Rodrigo Guzman Perera%' OR
    Autor like '%Megacable%' OR
    Autor like '%Enrique Yamuni Robles%' OR
    Autor like '%Laboratorios Pisa%' OR
    Autor like '%Alfonso Alvarez Paramo%' OR
    Autor like '%Grupo Urrea%' OR
    Autor like '%Guillermo Urrea Carroll%' OR
    Autor like '%Grupo Favier%' OR
    Autor like '%Juan Jorge Favier%'

  )
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "CANACINTRA",
    "Rodrigo Alpízar Vallejo",
    "José Enoch Castellanos Ferez",
    "Raúl Rodríguez Márquez",
    "COPARMEX",
    "José Medina Mora Icaza",
    "Luis Aranguren Trellez",
    "CANACO",
    "Rodrigo Arroyo Jiménez",
    "Fernando Topete Dávila",
    "Carlos David Ibarra Rubio",
    "Leida Santillan Álvarez",
    "Unión Ganadera Regional de Jalisco",
    "Andrés Salvador Ramos Cano",
    "Alianza de Camioneros de Jalisco",
    "Hugo Higareda Macías",
    "Frente Unido de Subrogatarios y Concesionarios",
    "Jesús Arreola Ponce",
    "Mutualidad de Transporte del Estado de Jalisco",
    "MUTUJAL",
    "Fernando Soto Casillas",
    "Unión de Comerciantes del Mercado de Abastos",
    "UCMA",
    "Miguel Fernando Gracián Ramírez",
    "Farmacias Guadalajara",
    "Javier Arroyo",
    "José Cuervo",
    "Juan Francisco Bekmann Vidal",
    "Grupo Omnilife",
    "Jorge Vergara",
    "Hilasal Mexicana",
    "Jorge García Fernández",
    "Grupo Simec",
    "Luis García Limón",
    "Grupo Aeroportuario del Pacifico",
    "Fernando Bosque Mohino",
    "Rodrigo Guzmán Perera",
    "Megacable",
    "Enrique Yamuni Robles",
    "Laboratorios Pisa",
    "Alfonso Álvarez Páramo",
    "Grupo Urrea",
    "Guillermo Urrea Carroll",
    "Grupo Favier",
    "Juan Jorge Favier"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("EMPRESARIOS"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like ' CISEN ' OR
    Texto like '%Eugenio Imaz Gispert%' OR
    Texto like '%Edna Eduviges Montoya Sanchez%' OR
    Texto like '%Javier Cruz Rivas%' OR
    Texto like '%Raul David Guillen Altuzar%' OR

        Titulo like ' CISEN ' OR
    Titulo like '%Eugenio Imaz Gispert%' OR
    Titulo like '%Edna Eduviges Montoya Sanchez%' OR
    Titulo like '%Javier Cruz Rivas%' OR
    Titulo like '%Raul David Guillen Altuzar%' OR

        Encabezado like ' CISEN ' OR
    Encabezado like '%Eugenio Imaz Gispert%' OR
    Encabezado like '%Edna Eduviges Montoya Sanchez%' OR
    Encabezado like '%Javier Cruz Rivas%' OR
    Encabezado like '%Raul David Guillen Altuzar%' OR

        PieFoto like ' CISEN ' OR
    PieFoto like '%Eugenio Imaz Gispert%' OR
    PieFoto like '%Edna Eduviges Montoya Sanchez%' OR
    PieFoto like '%Javier Cruz Rivas%' OR
    PieFoto like '%Raul David Guillen Altuzar%' OR

        Autor like ' CISEN ' OR
    Autor like '%Eugenio Imaz Gispert%' OR
    Autor like '%Edna Eduviges Montoya Sanchez%' OR
    Autor like '%Javier Cruz Rivas%' OR
    Autor like '%Raul David Guillen Altuzar%'

  )
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "CISEN",
    "Eugenio Ímaz Gispert",
    "Edna Eduviges Montoya Sánchez",
    "Javier Cruz Rivas",
    "Raúl David Guillén Altuzar" 
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("EJERCITO"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like ' COM ' OR
    Texto like ' COR ' OR
    Texto like '%Crescencio Farias Rosales%' OR
    Texto like ' CTC ' OR
    Texto like ' CTM ' OR
    Texto like '%Rafael Yerena Zambrano%' OR
    Texto like ' CROC ' OR
    Texto like '%Alfredo Barba Hernandez%' OR
    Texto like ' CROM ' OR
    Texto like '%Jose Alejandro Garcia Hernandez%' OR
    Texto like ' CGT ' OR
    Texto like '%Victor Ramirez Serna%' OR
    Texto like '%Movimiento Magisterial Jalisciense%' OR
    Texto like '%Silvia Arevalo%' OR
    Texto like ' SNTE ' OR
    Texto like '%Flavio Humberto Bernal Quezada%' OR
    Texto like '%Miguel Rodriguez Noriega%' OR

        Titulo like ' COM ' OR
    Titulo like ' COR ' OR
    Titulo like '%Crescencio Farias Rosales%' OR
    Titulo like ' CTC ' OR
    Titulo like ' CTM ' OR
    Titulo like '%Rafael Yerena Zambrano%' OR
    Titulo like ' CROC ' OR
    Titulo like '%Alfredo Barba Hernandez%' OR
    Titulo like ' CROM ' OR
    Titulo like '%Jose Alejandro Garcia Hernandez%' OR
    Titulo like ' CGT ' OR
    Titulo like '%Victor Ramirez Serna%' OR
    Titulo like '%Movimiento Magisterial Jalisciense%' OR
    Titulo like '%Silvia Arevalo%' OR
    Titulo like ' SNTE ' OR
    Titulo like '%Flavio Humberto Bernal Quezada%' OR
    Titulo like '%Miguel Rodriguez Noriega%' OR

        Encabezado like ' COM ' OR
    Encabezado like ' COR ' OR
    Encabezado like '%Crescencio Farias Rosales%' OR
    Encabezado like ' CTC ' OR
    Encabezado like ' CTM ' OR
    Encabezado like '%Rafael Yerena Zambrano%' OR
    Encabezado like ' CROC ' OR
    Encabezado like '%Alfredo Barba Hernandez%' OR
    Encabezado like ' CROM ' OR
    Encabezado like '%Jose Alejandro Garcia Hernandez%' OR
    Encabezado like ' CGT ' OR
    Encabezado like '%Victor Ramirez Serna%' OR
    Encabezado like '%Movimiento Magisterial Jalisciense%' OR
    Encabezado like '%Silvia Arevalo%' OR
    Encabezado like ' SNTE ' OR
    Encabezado like '%Flavio Humberto Bernal Quezada%' OR
    Encabezado like '%Miguel Rodriguez Noriega%' OR

        PieFoto like ' COM ' OR
    PieFoto like ' COR ' OR
    PieFoto like '%Crescencio Farias Rosales%' OR
    PieFoto like ' CTC ' OR
    PieFoto like ' CTM ' OR
    PieFoto like '%Rafael Yerena Zambrano%' OR
    PieFoto like ' CROC ' OR
    PieFoto like '%Alfredo Barba Hernandez%' OR
    PieFoto like ' CROM ' OR
    PieFoto like '%Jose Alejandro Garcia Hernandez%' OR
    PieFoto like ' CGT ' OR
    PieFoto like '%Victor Ramirez Serna%' OR
    PieFoto like '%Movimiento Magisterial Jalisciense%' OR
    PieFoto like '%Silvia Arevalo%' OR
    PieFoto like ' SNTE ' OR
    PieFoto like '%Flavio Humberto Bernal Quezada%' OR
    PieFoto like '%Miguel Rodriguez Noriega%' OR

        Autor like ' COM ' OR
    Autor like ' COR ' OR
    Autor like '%Crescencio Farias Rosales%' OR
    Autor like ' CTC ' OR
    Autor like ' CTM ' OR
    Autor like '%Rafael Yerena Zambrano%' OR
    Autor like ' CROC ' OR
    Autor like '%Alfredo Barba Hernandez%' OR
    Autor like ' CROM ' OR
    Autor like '%Jose Alejandro Garcia Hernandez%' OR
    Autor like ' CGT ' OR
    Autor like '%Victor Ramirez Serna%' OR
    Autor like '%Movimiento Magisterial Jalisciense%' OR
    Autor like '%Silvia Arevalo%' OR
    Autor like ' SNTE ' OR
    Autor like '%Flavio Humberto Bernal Quezada%' OR
    Autor like '%Miguel Rodriguez Noriega%' 
  )
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
            "COM",
    "COR",
    "Crescencio Farías Rosales",
    "CTC",
    "CTM",
    "Rafael Yerena Zambrano",
    "CROC",
    "Alfredo Barba Hernández",
    "CROM",
    "José Alejandro García Hernández",
    "CGT",
    "Víctor Ramírez Serna",
    "Movimiento Magisterial Jalisciense",
    "Silvia Arévalo",
    "SNTE",
    "Flavio Humberto Bernal Quezada",
    "Miguel Rodríguez Noriega"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("SINDICATOS"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Guillermo Cosio Vidaurri%' OR
    Texto like '%Carlos Rivera Aceves%' OR
    Texto like '%Alberto Cardenas Jimenez%' OR
    Texto like '%Francisco Ramirez Acuña%' OR
    Texto like '%Emilio Gonzalez Marquez%' OR
    Texto like '%Herbert Taylor Arthur%' OR
    Texto like '%Fernando Guzman Perez Pelaez%' OR
    Texto like '%Raul Padilla Lopez%' OR
    Texto like '%Dante Jaime Haro Reyes%' OR
    Texto like '%Jose Manuel Escamilla%' OR

        Titulo like '%Guillermo Cosio Vidaurri%' OR
    Titulo like '%Carlos Rivera Aceves%' OR
    Titulo like '%Alberto Cardenas Jimenez%' OR
    Titulo like '%Francisco Ramirez Acuña%' OR
    Titulo like '%Emilio Gonzalez Marquez%' OR
    Titulo like '%Herbert Taylor Arthur%' OR
    Titulo like '%Fernando Guzman Perez Pelaez%' OR
    Titulo like '%Raul Padilla Lopez%' OR
    Titulo like '%Dante Jaime Haro Reyes%' OR
    Titulo like '%Jose Manuel Escamilla%' OR

        Encabezado like '%Guillermo Cosio Vidaurri%' OR
    Encabezado like '%Carlos Rivera Aceves%' OR
    Encabezado like '%Alberto Cardenas Jimenez%' OR
    Encabezado like '%Francisco Ramirez Acuña%' OR
    Encabezado like '%Emilio Gonzalez Marquez%' OR
    Encabezado like '%Herbert Taylor Arthur%' OR
    Encabezado like '%Fernando Guzman Perez Pelaez%' OR
    Encabezado like '%Raul Padilla Lopez%' OR
    Encabezado like '%Dante Jaime Haro Reyes%' OR
    Encabezado like '%Jose Manuel Escamilla%' OR

        PieFoto like '%Guillermo Cosio Vidaurri%' OR
    PieFoto like '%Carlos Rivera Aceves%' OR
    PieFoto like '%Alberto Cardenas Jimenez%' OR
    PieFoto like '%Francisco Ramirez Acuña%' OR
    PieFoto like '%Emilio Gonzalez Marquez%' OR
    PieFoto like '%Herbert Taylor Arthur%' OR
    PieFoto like '%Fernando Guzman Perez Pelaez%' OR
    PieFoto like '%Raul Padilla Lopez%' OR
    PieFoto like '%Dante Jaime Haro Reyes%' OR
    PieFoto like '%Jose Manuel Escamilla%' OR

        Autor like '%Guillermo Cosio Vidaurri%' OR
    Autor like '%Carlos Rivera Aceves%' OR
    Autor like '%Alberto Cardenas Jimenez%' OR
    Autor like '%Francisco Ramirez Acuña%' OR
    Autor like '%Emilio Gonzalez Marquez%' OR
    Autor like '%Herbert Taylor Arthur%' OR
    Autor like '%Fernando Guzman Perez Pelaez%' OR
    Autor like '%Raul Padilla Lopez%' OR
    Autor like '%Dante Jaime Haro Reyes%' OR
    Autor like '%Jose Manuel Escamilla%' 


  )
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Guillermo Cosio Vidaurri",
    "Carlos Rivera Aceves",
    "Alberto Cárdenas Jiménez",
    "Francisco Ramírez Acuña",
    "Emilio González Márquez",
    "Herbert Taylor Arthur",
    "Fernando Guzmán Pérez Peláez",
    "Raúl Padilla López",
    "Dante Jaime Haro Reyes",
    "José Manuel Escamilla"

);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("NOTABLES"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Iglesia Catolica%' OR
    Texto like '%Juan Sandoval Iñiguez%' OR
    Texto like '%Francisco Robles ortega%' OR
    Texto like '%Testigos de Jehova%' OR
    Texto like '%Carlos Anaya Toribio%' OR
    Texto like '%Alberto Ruiz Lopez%' OR
    Texto like '%La Luz del Mundo%' OR
    Texto like '%Naason Joaquin Garcia%' OR
    Texto like '%Eliezer Gutierrez Avelar%' OR
    Texto like '%Sara Pozos Bravo%' OR

        Titulo like '%Iglesia Catolica%' OR
    Titulo like '%Juan Sandoval Iñiguez%' OR
    Titulo like '%Francisco Robles ortega%' OR
    Titulo like '%Testigos de Jehova%' OR
    Titulo like '%Carlos Anaya Toribio%' OR
    Titulo like '%Alberto Ruiz Lopez%' OR
    Titulo like '%La Luz del Mundo%' OR
    Titulo like '%Naason Joaquin Garcia%' OR
    Titulo like '%Eliezer Gutierrez Avelar%' OR
    Titulo like '%Sara Pozos Bravo%' OR

        Encabezado like '%Iglesia Catolica%' OR
    Encabezado like '%Juan Sandoval Iñiguez%' OR
    Encabezado like '%Francisco Robles ortega%' OR
    Encabezado like '%Testigos de Jehova%' OR
    Encabezado like '%Carlos Anaya Toribio%' OR
    Encabezado like '%Alberto Ruiz Lopez%' OR
    Encabezado like '%La Luz del Mundo%' OR
    Encabezado like '%Naason Joaquin Garcia%' OR
    Encabezado like '%Eliezer Gutierrez Avelar%' OR
    Encabezado like '%Sara Pozos Bravo%' OR

        PieFoto like '%Iglesia Catolica%' OR
    PieFoto like '%Juan Sandoval Iñiguez%' OR
    PieFoto like '%Francisco Robles ortega%' OR
    PieFoto like '%Testigos de Jehova%' OR
    PieFoto like '%Carlos Anaya Toribio%' OR
    PieFoto like '%Alberto Ruiz Lopez%' OR
    PieFoto like '%La Luz del Mundo%' OR
    PieFoto like '%Naason Joaquin Garcia%' OR
    PieFoto like '%Eliezer Gutierrez Avelar%' OR
    PieFoto like '%Sara Pozos Bravo%' OR

        Autor like '%Iglesia Catolica%' OR
    Autor like '%Juan Sandoval Iñiguez%' OR
    Autor like '%Francisco Robles ortega%' OR
    Autor like '%Testigos de Jehova%' OR
    Autor like '%Carlos Anaya Toribio%' OR
    Autor like '%Alberto Ruiz Lopez%' OR
    Autor like '%La Luz del Mundo%' OR
    Autor like '%Naason Joaquin Garcia%' OR
    Autor like '%Eliezer Gutierrez Avelar%' OR
    Autor like '%Sara Pozos Bravo%' 



  )
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Iglesia Católica",
    "Juan Sandoval Iñiguez",
    "Francisco Robles ortega",
    "Testigos de Jehová",
    "Carlos Anaya Toribio",
    "Alberto Ruiz López",
    "La Luz del Mundo",
    "Naasón Joaquín García",
    "Eliézer Gutiérrez Avelar",
    "Sara Pozos Bravo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("CLERO"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Universidad de Guadalajara%' OR
    Texto like '%Itzcoatl Tonatiuh Bravo Padilla%' OR
    Texto like '%Universidad Autonoma de Guadalajara%' OR
    Texto like '%Antonio Leaño Reyes%' OR
    Texto like ' ITESO ' OR
    Texto like '%Jose Morales Orozco%' OR
    Texto like '%Tecnologico de Monterrey%' OR
    Texto like '%Mario Adrian Flores Castro%' OR
    Texto like '%Universidad Panamericana%' OR
    Texto like '%Juan De La Borbolla Rivero%' OR
    Texto like ' UNIVA ' OR
    Texto like '%Francisco Ramirez Yañez%' OR
    Texto like ' UVM ' OR
    Texto like '%Silvia Dorantes%' OR
    Texto like '%Dario Sanchez%' OR
    Texto like '%Hector Lopez Llerenas Escalante%' OR

        Titulo like '%Universidad de Guadalajara%' OR
    Titulo like '%Itzcoatl Tonatiuh Bravo Padilla%' OR
    Titulo like '%Universidad Autonoma de Guadalajara%' OR
    Titulo like '%Antonio Leaño Reyes%' OR
    Titulo like ' ITESO ' OR
    Titulo like '%Jose Morales Orozco%' OR
    Titulo like '%Tecnologico de Monterrey%' OR
    Titulo like '%Mario Adrian Flores Castro%' OR
    Titulo like '%Universidad Panamericana%' OR
    Titulo like '%Juan De La Borbolla Rivero%' OR
    Titulo like ' UNIVA ' OR
    Titulo like '%Francisco Ramirez Yañez%' OR
    Titulo like ' UVM ' OR
    Titulo like '%Silvia Dorantes%' OR
    Titulo like '%Dario Sanchez%' OR
    Titulo like '%Hector Lopez Llerenas Escalante%' OR

        Encabezado like '%Universidad de Guadalajara%' OR
    Encabezado like '%Itzcoatl Tonatiuh Bravo Padilla%' OR
    Encabezado like '%Universidad Autonoma de Guadalajara%' OR
    Encabezado like '%Antonio Leaño Reyes%' OR
    Encabezado like ' ITESO ' OR
    Encabezado like '%Jose Morales Orozco%' OR
    Encabezado like '%Tecnologico de Monterrey%' OR
    Encabezado like '%Mario Adrian Flores Castro%' OR
    Encabezado like '%Universidad Panamericana%' OR
    Encabezado like '%Juan De La Borbolla Rivero%' OR
    Encabezado like ' UNIVA ' OR
    Encabezado like '%Francisco Ramirez Yañez%' OR
    Encabezado like ' UVM ' OR
    Encabezado like '%Silvia Dorantes%' OR
    Encabezado like '%Dario Sanchez%' OR
    Encabezado like '%Hector Lopez Llerenas Escalante%' OR

        PieFoto like '%Universidad de Guadalajara%' OR
    PieFoto like '%Itzcoatl Tonatiuh Bravo Padilla%' OR
    PieFoto like '%Universidad Autonoma de Guadalajara%' OR
    PieFoto like '%Antonio Leaño Reyes%' OR
    PieFoto like ' ITESO ' OR
    PieFoto like '%Jose Morales Orozco%' OR
    PieFoto like '%Tecnologico de Monterrey%' OR
    PieFoto like '%Mario Adrian Flores Castro%' OR
    PieFoto like '%Universidad Panamericana%' OR
    PieFoto like '%Juan De La Borbolla Rivero%' OR
    PieFoto like ' UNIVA ' OR
    PieFoto like '%Francisco Ramirez Yañez%' OR
    PieFoto like ' UVM ' OR
    PieFoto like '%Silvia Dorantes%' OR
    PieFoto like '%Dario Sanchez%' OR
    PieFoto like '%Hector Lopez Llerenas Escalante%' OR

        Autor like '%Universidad de Guadalajara%' OR
    Autor like '%Itzcoatl Tonatiuh Bravo Padilla%' OR
    Autor like '%Universidad Autonoma de Guadalajara%' OR
    Autor like '%Antonio Leaño Reyes%' OR
    Autor like ' ITESO ' OR
    Autor like '%Jose Morales Orozco%' OR
    Autor like '%Tecnologico de Monterrey%' OR
    Autor like '%Mario Adrian Flores Castro%' OR
    Autor like '%Universidad Panamericana%' OR
    Autor like '%Juan De La Borbolla Rivero%' OR
    Autor like ' UNIVA ' OR
    Autor like '%Francisco Ramirez Yañez%' OR
    Autor like ' UVM ' OR
    Autor like '%Silvia Dorantes%' OR
    Autor like '%Dario Sanchez%' OR
    Autor like '%Hector Lopez Llerenas Escalante%' 


  )
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Universidad de Guadalajara",
    "Itzcóatl Tonatiuh Bravo Padilla",
    "Universidad Autónoma de Guadalajara",
    "Antonio Leaño Reyes",
    "ITESO",
    "José Morales Orozco",
    "Tecnológico de Monterrey",
    "Mario Adrián Flores Castro",
    "Universidad Panamericana",
    "Juan De La Borbolla Rivero",
    "UNIVA",
    "Francisco Ramírez Yáñez",
    "UVM",
    "Silvia Dorantes",
    "Darío Sánchez",
    "Héctor López Llerenas Escalante"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("UNIVERSIDADES"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like ' CETI ' OR
    Texto like '%Celso Gabriel Espinosa Corona%' OR
    Texto like ' CONALEP ' OR
    Texto like '%Ildefonso Iglesias Escudero%' OR
    Texto like ' COBAEJ ' OR
    Texto like '%Alvaro Valencia Abundis%' OR
    Texto like ' FEU ' OR
    Texto like '%Jose Alberto Galarza Villaseñor%' OR
        Texto like ' COM ' OR
    Texto like ' COR ' OR
    Texto like '%Crescencio Farias Rosales%' OR
    Texto like ' CTC ' OR
    Texto like ' CTM ' OR
    Texto like '%Rafael Yerena Zambrano%' OR
    Texto like ' CROC ' OR
    Texto like '%Alfredo Barba Hernandez%' OR
    Texto like ' CROM ' OR
    Texto like '%Jose Alejandro Garcia Hernandez%' OR
    Texto like ' CGT ' OR
    Texto like '%Victor Ramirez Serna%' OR
    Texto like '%Movimiento Magisterial Jalisciense%' OR
    Texto like '%Silvia Arevalo%' OR
    Texto like ' SNTE ' OR
    Texto like '%Flavio Humberto Bernal Quezada%' OR
    Texto like '%Miguel Rodriguez Noriega%' OR

        Titulo like ' CETI ' OR
    Titulo like '%Celso Gabriel Espinosa Corona%' OR
    Titulo like ' CONALEP ' OR
    Titulo like '%Ildefonso Iglesias Escudero%' OR
    Titulo like ' COBAEJ ' OR
    Titulo like '%Alvaro Valencia Abundis%' OR
    Titulo like ' FEU ' OR
    Titulo like '%Jose Alberto Galarza Villaseñor%' OR
        Titulo like ' COM ' OR
    Titulo like ' COR ' OR
    Titulo like '%Crescencio Farias Rosales%' OR
    Titulo like ' CTC ' OR
    Titulo like ' CTM ' OR
    Titulo like '%Rafael Yerena Zambrano%' OR
    Titulo like ' CROC ' OR
    Titulo like '%Alfredo Barba Hernandez%' OR
    Titulo like ' CROM ' OR
    Titulo like '%Jose Alejandro Garcia Hernandez%' OR
    Titulo like ' CGT ' OR
    Titulo like '%Victor Ramirez Serna%' OR
    Titulo like '%Movimiento Magisterial Jalisciense%' OR
    Titulo like '%Silvia Arevalo%' OR
    Titulo like ' SNTE ' OR
    Titulo like '%Flavio Humberto Bernal Quezada%' OR
    Titulo like '%Miguel Rodriguez Noriega%' OR

        Encabezado like ' CETI ' OR
    Encabezado like '%Celso Gabriel Espinosa Corona%' OR
    Encabezado like ' CONALEP ' OR
    Encabezado like '%Ildefonso Iglesias Escudero%' OR
    Encabezado like ' COBAEJ ' OR
    Encabezado like '%Alvaro Valencia Abundis%' OR
    Encabezado like ' FEU ' OR
    Encabezado like '%Jose Alberto Galarza Villaseñor%' OR
        Encabezado like ' COM ' OR
    Encabezado like ' COR ' OR
    Encabezado like '%Crescencio Farias Rosales%' OR
    Encabezado like ' CTC ' OR
    Encabezado like ' CTM ' OR
    Encabezado like '%Rafael Yerena Zambrano%' OR
    Encabezado like ' CROC ' OR
    Encabezado like '%Alfredo Barba Hernandez%' OR
    Encabezado like ' CROM ' OR
    Encabezado like '%Jose Alejandro Garcia Hernandez%' OR
    Encabezado like ' CGT ' OR
    Encabezado like '%Victor Ramirez Serna%' OR
    Encabezado like '%Movimiento Magisterial Jalisciense%' OR
    Encabezado like '%Silvia Arevalo%' OR
    Encabezado like ' SNTE ' OR
    Encabezado like '%Flavio Humberto Bernal Quezada%' OR
    Encabezado like '%Miguel Rodriguez Noriega%' OR

        PieFoto like ' CETI ' OR
    PieFoto like '%Celso Gabriel Espinosa Corona%' OR
    PieFoto like ' CONALEP ' OR
    PieFoto like '%Ildefonso Iglesias Escudero%' OR
    PieFoto like ' COBAEJ ' OR
    PieFoto like '%Alvaro Valencia Abundis%' OR
    PieFoto like ' FEU ' OR
    PieFoto like '%Jose Alberto Galarza Villaseñor%' OR
        PieFoto like ' COM ' OR
    PieFoto like ' COR ' OR
    PieFoto like '%Crescencio Farias Rosales%' OR
    PieFoto like ' CTC ' OR
    PieFoto like ' CTM ' OR
    PieFoto like '%Rafael Yerena Zambrano%' OR
    PieFoto like ' CROC ' OR
    PieFoto like '%Alfredo Barba Hernandez%' OR
    PieFoto like ' CROM ' OR
    PieFoto like '%Jose Alejandro Garcia Hernandez%' OR
    PieFoto like ' CGT ' OR
    PieFoto like '%Victor Ramirez Serna%' OR
    PieFoto like '%Movimiento Magisterial Jalisciense%' OR
    PieFoto like '%Silvia Arevalo%' OR
    PieFoto like ' SNTE ' OR
    PieFoto like '%Flavio Humberto Bernal Quezada%' OR
    PieFoto like '%Miguel Rodriguez Noriega%' OR

        Autor like ' CETI ' OR
    Autor like '%Celso Gabriel Espinosa Corona%' OR
    Autor like ' CONALEP ' OR
    Autor like '%Ildefonso Iglesias Escudero%' OR
    Autor like ' COBAEJ ' OR
    Autor like '%Alvaro Valencia Abundis%' OR
    Autor like ' FEU ' OR
    Autor like '%Jose Alberto Galarza Villaseñor%' OR
        Autor like ' COM ' OR
    Autor like ' COR ' OR
    Autor like '%Crescencio Farias Rosales%' OR
    Autor like ' CTC ' OR
    Autor like ' CTM ' OR
    Autor like '%Rafael Yerena Zambrano%' OR
    Autor like ' CROC ' OR
    Autor like '%Alfredo Barba Hernandez%' OR
    Autor like ' CROM ' OR
    Autor like '%Jose Alejandro Garcia Hernandez%' OR
    Autor like ' CGT ' OR
    Autor like '%Victor Ramirez Serna%' OR
    Autor like '%Movimiento Magisterial Jalisciense%' OR
    Autor like '%Silvia Arevalo%' OR
    Autor like ' SNTE ' OR
    Autor like '%Flavio Humberto Bernal Quezada%' OR
    Autor like '%Miguel Rodriguez Noriega%' 



)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "CETI",
    "Celso Gabriel Espinosa Corona",
    "CONALEP",
    "Ildefonso Iglesias Escudero",
    "COBAEJ",
    "Álvaro Valencia Abundis",
    "FEU",
    "José Alberto Galarza Villaseñor",
        "COM",
    "COR",
    "Crescencio Farías Rosales",
    "CTC",
    "CTM",
    "Rafael Yerena Zambrano",
    "CROC",
    "Alfredo Barba Hernández",
    "CROM",
    "José Alejandro García Hernández",
    "CGT",
    "Víctor Ramírez Serna",
    "Movimiento Magisterial Jalisciense",
    "Silvia Arévalo",
    "SNTE",
    "Flavio Humberto Bernal Quezada",
    "Miguel Rodríguez Noriega"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("MENU 2"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Luis Carlos Najera Gutierrez de Velasco%' OR
    Texto like '%Fiscal General del Estado de Jalisco%' OR
    Texto like '%Fiscalia General del Estado de Jalisco%' OR
    Texto like '%Rafael Castellanos%' OR
    Texto like '%Fiscal Central%' OR

        Titulo like '%Luis Carlos Najera Gutierrez de Velasco%' OR
    Titulo like '%Fiscal General del Estado de Jalisco%' OR
    Titulo like '%Fiscalia General del Estado de Jalisco%' OR
    Titulo like '%Rafael Castellanos%' OR
    Titulo like '%Fiscal Central%' OR

        Encabezado like '%Luis Carlos Najera Gutierrez de Velasco%' OR
    Encabezado like '%Fiscal General del Estado de Jalisco%' OR
    Encabezado like '%Fiscalia General del Estado de Jalisco%' OR
    Encabezado like '%Rafael Castellanos%' OR
    Encabezado like '%Fiscal Central%' OR

        PieFoto like '%Luis Carlos Najera Gutierrez de Velasco%' OR
    PieFoto like '%Fiscal General del Estado de Jalisco%' OR
    PieFoto like '%Fiscalia General del Estado de Jalisco%' OR
    PieFoto like '%Rafael Castellanos%' OR
    PieFoto like '%Fiscal Central%' OR

        Autor like '%Luis Carlos Najera Gutierrez de Velasco%' OR
    Autor like '%Fiscal General del Estado de Jalisco%' OR
    Autor like '%Fiscalia General del Estado de Jalisco%' OR
    Autor like '%Rafael Castellanos%' OR
    Autor like '%Fiscal Central%'



)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Luis Carlos Nájera Gutiérrez de Velasco",
    "Fiscal General del Estado de Jalisco",
    "Fiscalía General del Estado de Jalisco",
    "Rafael Castellanos",
    "Fiscal Central"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("FISCALIA GENERAL"), $buscar);


/********************/

/*
//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Conflicto de interes%' OR
    Texto like '%Legalidad%' OR
    Texto like '%Prosperidad%' OR
    Texto like '%Impunidad%' OR

        Titulo like '%Conflicto de interes%' OR
    Titulo like '%Legalidad%' OR
    Titulo like '%Prosperidad%' OR
    Titulo like '%Impunidad%' OR

        Encabezado like '%Conflicto de interes%' OR
    Encabezado like '%Legalidad%' OR
    Encabezado like '%Prosperidad%' OR
    Encabezado like '%Impunidad%' OR

        PieFoto like '%Conflicto de interes%' OR
    PieFoto like '%Legalidad%' OR
    PieFoto like '%Prosperidad%' OR
    PieFoto like '%Impunidad%' OR

        Autor like '%Conflicto de interes%' OR
    Autor like '%Legalidad%' OR
    Autor like '%Prosperidad%' OR
    Autor like '%Impunidad%' 


)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Conflicto de interés",
    "Legalidad",
    "Prosperidad",
    "Impunidad"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("CONCEPTOS"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Ombudsman%' OR
    Texto like '%Felipe de Jesus Alvarez Cibrian%' OR
    Texto like '%Nestor Aaron Orellana Tellez%' OR
    Texto like '%Secretario Tecnico del Consejo Ciudadano%' OR
        Texto like '%Francisco Ayon%' OR
    Texto like '%Paco Ayon%' OR

        Titulo like '%Ombudsman%' OR
    Titulo like '%Felipe de Jesus Alvarez Cibrian%' OR
    Titulo like '%Nestor Aaron Orellana Tellez%' OR
    Titulo like '%Secretario Tecnico del Consejo Ciudadano%' OR
        Titulo like '%Francisco Ayon%' OR
    Titulo like '%Paco Ayon%' OR

        Encabezado like '%Ombudsman%' OR
    Encabezado like '%Felipe de Jesus Alvarez Cibrian%' OR
    Encabezado like '%Nestor Aaron Orellana Tellez%' OR
    Encabezado like '%Secretario Tecnico del Consejo Ciudadano%' OR
        Encabezado like '%Francisco Ayon%' OR
    Encabezado like '%Paco Ayon%' OR

        PieFoto like '%Ombudsman%' OR
    PieFoto like '%Felipe de Jesus Alvarez Cibrian%' OR
    PieFoto like '%Nestor Aaron Orellana Tellez%' OR
    PieFoto like '%Secretario Tecnico del Consejo Ciudadano%' OR
        PieFoto like '%Francisco Ayon%' OR
    PieFoto like '%Paco Ayon%' OR

        Autor like '%Ombudsman%' OR
    Autor like '%Felipe de Jesus Alvarez Cibrian%' OR
    Autor like '%Nestor Aaron Orellana Tellez%' OR
    Autor like '%Secretario Tecnico del Consejo Ciudadano%' OR
        Autor like '%Francisco Ayon%' OR
    Autor like '%Paco Ayon%' OR


)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Ombudsman",
    "Felipe de Jesús Álvarez Cibrián",
    "Néstor Aarón Orellana Téllez",
    "Secretario Técnico del Consejo Ciudadano",
        "Francisco Ayón",
    "Paco Ayón"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("OMDUBSMAN"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Roberto Lopez Lara%' OR
    Texto like '%Secretario General de Gobierno%' OR
    Texto like '%Jorge Arturo Vazquez Ortiz%' OR
    Texto like '%Direccion General de Gobierno%' OR
    Texto like '%Carlos Oscar Trejo Herrera%' OR
    Texto like '%Subsecretario de Asuntos Juridicos%' OR

        Titulo like '%Roberto Lopez Lara%' OR
    Titulo like '%Secretario General de Gobierno%' OR
    Titulo like '%Jorge Arturo Vazquez Ortiz%' OR
    Titulo like '%Direccion General de Gobierno%' OR
    Titulo like '%Carlos Oscar Trejo Herrera%' OR
    Titulo like '%Subsecretario de Asuntos Juridicos%' OR

        Encabezado like '%Roberto Lopez Lara%' OR
    Encabezado like '%Secretario General de Gobierno%' OR
    Encabezado like '%Jorge Arturo Vazquez Ortiz%' OR
    Encabezado like '%Direccion General de Gobierno%' OR
    Encabezado like '%Carlos Oscar Trejo Herrera%' OR
    Encabezado like '%Subsecretario de Asuntos Juridicos%' OR

        PieFoto like '%Roberto Lopez Lara%' OR
    PieFoto like '%Secretario General de Gobierno%' OR
    PieFoto like '%Jorge Arturo Vazquez Ortiz%' OR
    PieFoto like '%Direccion General de Gobierno%' OR
    PieFoto like '%Carlos Oscar Trejo Herrera%' OR
    PieFoto like '%Subsecretario de Asuntos Juridicos%' OR

        Autor like '%Roberto Lopez Lara%' OR
    Autor like '%Secretario General de Gobierno%' OR
    Autor like '%Jorge Arturo Vazquez Ortiz%' OR
    Autor like '%Direccion General de Gobierno%' OR
    Autor like '%Carlos Oscar Trejo Herrera%' OR
    Autor like '%Subsecretario de Asuntos Juridicos%' 

)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Roberto López Lara",
    "Secretario General de Gobierno",
    "Jorge Arturo Vázquez Ortiz",
    "Dirección General de Gobierno",
    "Carlos Oscar Trejo Herrera",
    "Subsecretario de Asuntos Jurídicos"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("SECRETARIA GENERAL DE GOBIERNO"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Jose Palacios Jimenez%' OR
    Texto like '%Secretario de Desarrollo Economico%' OR
    Texto like '%Oscar Plascencia Peña%' OR
    Texto like '%Eduardo Delgadillo Dominguez%' OR
    Texto like '%Director General de Proyectos de Inversion%' OR

        Titulo like '%Jose Palacios Jimenez%' OR
    Titulo like '%Secretario de Desarrollo Economico%' OR
    Titulo like '%Oscar Plascencia Peña%' OR
    Titulo like '%Eduardo Delgadillo Dominguez%' OR
    Titulo like '%Director General de Proyectos de Inversion%' OR

        Encabezado like '%Jose Palacios Jimenez%' OR
    Encabezado like '%Secretario de Desarrollo Economico%' OR
    Encabezado like '%Oscar Plascencia Peña%' OR
    Encabezado like '%Eduardo Delgadillo Dominguez%' OR
    Encabezado like '%Director General de Proyectos de Inversion%' OR

        PieFoto like '%Jose Palacios Jimenez%' OR
    PieFoto like '%Secretario de Desarrollo Economico%' OR
    PieFoto like '%Oscar Plascencia Peña%' OR
    PieFoto like '%Eduardo Delgadillo Dominguez%' OR
    PieFoto like '%Director General de Proyectos de Inversion%' OR

        Autor like '%Jose Palacios Jimenez%' OR
    Autor like '%Secretario de Desarrollo Economico%' OR
    Autor like '%Oscar Plascencia Peña%' OR
    Autor like '%Eduardo Delgadillo Dominguez%' OR
    Autor like '%Director General de Proyectos de Inversion%' 



)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "José Palacios Jiménez",
    "Secretario de Desarrollo Económico",
    "Oscar Plascencia Peña",
    "Eduardo Delgadillo Domínguez",
    "Director General de Proyectos de Inversión"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("SECRETARIA DE DESARROLLO ECONOMICO"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Jesus Eduardo Almaguer Ramirez%' OR
    Texto like '%Secretario del Trabajo y Prevision Social%' OR
    Texto like '%Veronica Quintero Santoyo%' OR
    Texto like '%Jesus Moreno Ramos%' OR
    Texto like '%Director de Control y Supervision%' OR

        Titulo like '%Jesus Eduardo Almaguer Ramirez%' OR
    Titulo like '%Secretario del Trabajo y Prevision Social%' OR
    Titulo like '%Veronica Quintero Santoyo%' OR
    Titulo like '%Jesus Moreno Ramos%' OR
    Titulo like '%Director de Control y Supervision%' OR

        Encabezado like '%Jesus Eduardo Almaguer Ramirez%' OR
    Encabezado like '%Secretario del Trabajo y Prevision Social%' OR
    Encabezado like '%Veronica Quintero Santoyo%' OR
    Encabezado like '%Jesus Moreno Ramos%' OR
    Encabezado like '%Director de Control y Supervision%' OR

        PieFoto like '%Jesus Eduardo Almaguer Ramirez%' OR
    PieFoto like '%Secretario del Trabajo y Prevision Social%' OR
    PieFoto like '%Veronica Quintero Santoyo%' OR
    PieFoto like '%Jesus Moreno Ramos%' OR
    PieFoto like '%Director de Control y Supervision%' OR

        Autor like '%Jesus Eduardo Almaguer Ramirez%' OR
    Autor like '%Secretario del Trabajo y Prevision Social%' OR
    Autor like '%Veronica Quintero Santoyo%' OR
    Autor like '%Jesus Moreno Ramos%' OR
    Autor like '%Director de Control y Supervision%' 


)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Jesús Eduardo Almaguer Ramírez",
    "Secretario del Trabajo y Previsión Social",
    "Verónica Quintero Santoyo",
    "Jesús Moreno Ramos",
    "Director de Control y Supervisión"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("SECRETARIO DEL TRABAJO Y PREVISION SOCIAL"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Daviel Trujillo Cuevas%' OR
    Texto like '%Secretaria de Desarrollo e Integracion Social%' OR
    Texto like '%Moises de Jesus Maldonado Alonso%' OR
    Texto like '%Director General de Programas Sociales%' OR
    Texto like '%Sonia Carolina Toro Morales%' OR
    Texto like '%Directora General de Politica Social%' OR

        Titulo like '%Daviel Trujillo Cuevas%' OR
    Titulo like '%Secretaria de Desarrollo e Integracion Social%' OR
    Titulo like '%Moises de Jesus Maldonado Alonso%' OR
    Titulo like '%Director General de Programas Sociales%' OR
    Titulo like '%Sonia Carolina Toro Morales%' OR
    Titulo like '%Directora General de Politica Social%' OR

        Encabezado like '%Daviel Trujillo Cuevas%' OR
    Encabezado like '%Secretaria de Desarrollo e Integracion Social%' OR
    Encabezado like '%Moises de Jesus Maldonado Alonso%' OR
    Encabezado like '%Director General de Programas Sociales%' OR
    Encabezado like '%Sonia Carolina Toro Morales%' OR
    Encabezado like '%Directora General de Politica Social%' OR

        PieFoto like '%Daviel Trujillo Cuevas%' OR
    PieFoto like '%Secretaria de Desarrollo e Integracion Social%' OR
    PieFoto like '%Moises de Jesus Maldonado Alonso%' OR
    PieFoto like '%Director General de Programas Sociales%' OR
    PieFoto like '%Sonia Carolina Toro Morales%' OR
    PieFoto like '%Directora General de Politica Social%' OR

        Autor like '%Daviel Trujillo Cuevas%' OR
    Autor like '%Secretaria de Desarrollo e Integracion Social%' OR
    Autor like '%Moises de Jesus Maldonado Alonso%' OR
    Autor like '%Director General de Programas Sociales%' OR
    Autor like '%Sonia Carolina Toro Morales%' OR
    Autor like '%Directora General de Politica Social%' 



)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Daviel Trujillo Cuevas",
    "Secretaría de Desarrollo e Integración Social",
    "Moisés de Jesús Maldonado Alonso",
    "Director General de Programas Sociales",
    "Sonia Carolina Toro Morales",
    "Directora General de Política Social"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("SECRETARIA DE DESARROLLO E INTEGRACION SOCIAL"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Instituto de Transparencia e Informacion Publica de Jalisco%' OR
    Texto like ' ITEI ' OR
    Texto like '%Cynthia Patricia Cantero Pacheco%' OR
    Texto like '%Miguel Angel Hernandez Velazquez%' OR
    Texto like '%Francisco Javier Gonzalez Vallejo%' OR

        Titulo like '%Instituto de Transparencia e Informacion Publica de Jalisco%' OR
    Titulo like ' ITEI ' OR
    Titulo like '%Cynthia Patricia Cantero Pacheco%' OR
    Titulo like '%Miguel Angel Hernandez Velazquez%' OR
    Titulo like '%Francisco Javier Gonzalez Vallejo%' OR

        Encabezado like '%Instituto de Transparencia e Informacion Publica de Jalisco%' OR
    Encabezado like ' ITEI ' OR
    Encabezado like '%Cynthia Patricia Cantero Pacheco%' OR
    Encabezado like '%Miguel Angel Hernandez Velazquez%' OR
    Encabezado like '%Francisco Javier Gonzalez Vallejo%' OR

        PieFoto like '%Instituto de Transparencia e Informacion Publica de Jalisco%' OR
    PieFoto like ' ITEI ' OR
    PieFoto like '%Cynthia Patricia Cantero Pacheco%' OR
    PieFoto like '%Miguel Angel Hernandez Velazquez%' OR
    PieFoto like '%Francisco Javier Gonzalez Vallejo%' OR

        Autor like '%Instituto de Transparencia e Informacion Publica de Jalisco%' OR
    Autor like ' ITEI ' OR
    Autor like '%Cynthia Patricia Cantero Pacheco%' OR
    Autor like '%Miguel Angel Hernandez Velazquez%' OR
    Autor like '%Francisco Javier Gonzalez Vallejo%' 

)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Instituto de Transparencia e Información Pública de Jalisco",
    "ITEI",
    "Cynthia Patricia Cantero Pacheco",
    "Miguel Ángel Hernández Velázquez",
    "Francisco Javier González Vallejo"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("ITEI"), $buscar);


/********************/

/*
//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Corrupcion%' OR
    Texto like '%Impunidad%' OR
    Texto like '%Transparencia%' OR
    Texto like '%Derechos Humanos%' OR

        Titulo like '%Corrupcion%' OR
    Titulo like '%Impunidad%' OR
    Titulo like '%Transparencia%' OR
    Titulo like '%Derechos Humanos%' OR

        Encabezado like '%Corrupcion%' OR
    Encabezado like '%Impunidad%' OR
    Encabezado like '%Transparencia%' OR
    Encabezado like '%Derechos Humanos%' OR

        PieFoto like '%Corrupcion%' OR
    PieFoto like '%Impunidad%' OR
    PieFoto like '%Transparencia%' OR
    PieFoto like '%Derechos Humanos%' OR

        Autor like '%Corrupcion%' OR
    Autor like '%Impunidad%' OR
    Autor like '%Transparencia%' OR
    Autor like '%Derechos Humanos%'



)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
        "Corrupción",
    "Impunidad",
    "Transparencia",
    "Derechos Humanos"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("CONCEPTOS"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Director de la Unidad de Investigacion contra la Corrupcion%' OR


        Titulo like '%Director de la Unidad de Investigacion contra la Corrupcion%' OR


        Encabezado like '%Director de la Unidad de Investigacion contra la Corrupcion%' OR


        PieFoto like '%Director de la Unidad de Investigacion contra la Corrupcion%' OR


        Autor like '%Director de la Unidad de Investigacion contra la Corrupcion%' 
  


)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
    "Director de la Unidad de Investigacion contra la Corrupcion" 
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("FISCALIA CONTRA LA CORRUPCION"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Supremo Tribunal de Justicia del Estado de Jalisco%' OR
    Texto like '%Luis Carlos Vega Pamanes%' OR

        Titulo like '%Supremo Tribunal de Justicia del Estado de Jalisco%' OR
    Titulo like '%Luis Carlos Vega Pamanes%' OR

        Encabezado like '%Supremo Tribunal de Justicia del Estado de Jalisco%' OR
    Encabezado like '%Luis Carlos Vega Pamanes%' OR

        PieFoto like '%Supremo Tribunal de Justicia del Estado de Jalisco%' OR
    PieFoto like '%Luis Carlos Vega Pamanes%' OR

        Autor like '%Supremo Tribunal de Justicia del Estado de Jalisco%' OR
    Autor like '%Luis Carlos Vega Pamanes%'





)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
   "Supremo Tribunal de Justicia del Estado de Jalisco",
    "Luis Carlos Vega Pamanes"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("STJEJ"), $buscar);


/********************/


//QUERY Direccion
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
  (SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticiasAnual WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31'
UNION ALL
SELECT idEditorial,Periodico,Titulo,Fecha,Hora,Encabezado,Categoria,Seccion,Activo,Autor,Texto,NumeroPagina,PaginaPeriodico,PieFoto FROM noticias2014 WHERE Fecha BETWEEN '2014-11-01' AND '2014-12-31') n,
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
    Texto like '%Leonel Sandoval Figueroa%' OR
    Texto like '%MAS x Jalisco%' OR
    Texto like '%PRI Jalisco%' OR

        Titulo like '%Leonel Sandoval Figueroa%' OR
    Titulo like '%MAS x Jalisco%' OR
    Titulo like '%PRI Jalisco%' OR

        Encabezado like '%Leonel Sandoval Figueroa%' OR
    Encabezado like '%MAS x Jalisco%' OR
    Encabezado like '%PRI Jalisco%' OR

        PieFoto like '%Leonel Sandoval Figueroa%' OR
    PieFoto like '%MAS x Jalisco%' OR
    PieFoto like '%PRI Jalisco%' OR

        Autor like '%Leonel Sandoval Figueroa%' OR
    Autor like '%MAS x Jalisco%' OR
    Autor like '%PRI Jalisco%'

)
GROUP BY n.idEditorial
ORDER BY n.Fecha,o.posicion";
$buscar = array(
    "Leonel Sandoval Figueroa",
    "MAS x Jalisco",
    "PRI Jalisco"
);

texto($pdf, $qryPersonaje, $titulo = utf8_decode("MENU 6"), $buscar);


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

//$nombre = "/home/badillo/Documents/".DATE('Y-m-d')."Reporte Chre.pdf";
$nombre = "/var/www/external/services/mail/chre/Reporte Chre Noviembre-Diciembre 2014.pdf";

$pdf->Output($nombre, 'F'); 
