<?php

error_reporting(E_ALL);

// Notificar todos los errores de PHP
error_reporting(-1);

require "/var/www/external/services/mail/conexion.php";

mysql_query("set names 'utf8'");

function EncuentraCoincidencias3($cad){
   //patron para enter
  //$patron = '/\n/';

  //patron para punto .
  $patron = '/\./';

  preg_match_all($patron, $cad, $coincidencias, PREG_OFFSET_CAPTURE);

  $parrafos = $coincidencias[0];

  //DEFINIMOS QUE SEA HASTA EL SEGUNDO PARRAFO
  $parrafo = ( !empty( $parrafos[2] ) )? $parrafos[2] :''; 
  
  if( !empty( $parrafo ) ){

      $nvaCad =  substr($cad, 0, $parrafo[1] + 1);

      preg_match_all("/\./", $nvaCad, $co, PREG_OFFSET_CAPTURE);

      $puntos = ( !empty( $co[0] ) )? $co[0] : '';
    
      
      /*
      echo "<pre>";
      print_r($puntos);
      echo "</pre>";
      */
      
      //punto definimos que sea hasta el segundo punto
      if( !empty($puntos[2]) ){

          $punto = $puntos[2];  
          $nuevaCadena =  substr($nvaCad, 0, $punto[1] + 1 )."..";
       
      }else{

        $nuevaCadena = $nvaCad;
      } 
      


  }else{

    $nuevaCadena = $cad; 
  }

  return  $nuevaCadena ;
}

function EncuentraCoincidencias2($cadenaOriginal,$valorBuscado){
    $posicion=  strpos($cadenaOriginal, $valorBuscado);
    if($posicion!==false){
        if($posicion>0){
             $nuevaCadena=  substr($cadenaOriginal, $posicion-5,$posicion+400);
            return $nuevaCadena."...";      
        }else{
             $nuevaCadena=  substr($cadenaOriginal, $posicion,$posicion+400);
            return $nuevaCadena."...";      
        }
    }else if($posicion===false){
        return false;
    }
}


function EncuentraArreglo2($cadenaOriginal,$array){
    $cadena=false;
    foreach ($array as $value)
    {
        $cadena=EncuentraCoincidencias2($cadenaOriginal,$value);
        if($cadena!==false){
            break;
        }
    }
    if($cadena!==false)
    {
      return $cadena;
    }
    else
    {
      return $cadenaOriginal;
    } 
}


function sanear_string($string)
{
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "<"),
        '',
        $string
    );
    return $string;
 
}

function correctorOrtografico2($cadena)
{
    $words = "SELECT * FROM diccionarioCorrector WHERE Validado=1";

    $correctas = array();
    $incorrectas = array();

    mysql_query("SET NAMES 'utf8'");
    $palabras = mysql_query($words);

    $i = 0;
    while($rows = mysql_fetch_array($palabras))
    {
        $correctas[$i]=utf8_decode($rows['Correcto']);
        $incorrectas[$i]=utf8_decode($rows['Incorrecto']);
        $i++;
    }

    $newcadena = str_replace($incorrectas, $correctas, $cadena);

    return $newcadena;
}

function fecha_completa2($fecha)
{
    $subfecha=explode("-",$fecha); 
    $año=$subfecha[0];
    $mes=$subfecha[1];
    $dia=$subfecha[2];

    $dia2=date( "d", mktime(0,0,0,$mes,$dia,$año));
    $mes2=date( "m", mktime(0,0,0,$mes,$dia,$año));
    $año2=date( "Y", mktime(0,0,0,$mes,$dia,$año));
    $dia_sem=date( "w", mktime(0,0,0,$mes,$dia,$año));

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
         $dia_sem3='Miércoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='Sábado'; 
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
            $pdf->MultiCell(200, 5, " ".$periodico.":" ,0, 1, 'L', false);

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
            $texto  = EncuentraCoincidencias3($texto);
            


            $pdf->SetFillColor(255);
            $pdf->MultiCell(200,4, $texto ,0,'J',true);
            $pdf->SetFillColor(255);

            $pdf->SetFont("arial", "B",11);
            $pdf->Ln();
            $pdf->MultiCell(200, 2, "Seccion: ".utf8_decode($row['Seccion'])."    Autor: ".utf8_decode(ucwords(strtolower(($row['Autor']==""?$periodico:$row['Autor'])))) ,0, 1, 'L', false);


            $pdf->Ln();
            $pdf->SetFont("arial", "", 8);
            $pdf->SetTextColor(86, 104, 239);
            $pdf->Cell(20,4, "Recorte",0,0,'L',false, 'http://187.247.253.5/external/services/mail/testigoCutSCT.php?c=sct&f=2014-12-17&id='.$row['idEditorial']);
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

function MediosDF($pdf,$sql,$titulo, $buscar)
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";
    mysql_query("set names 'utf8'");
    $data =  mysql_query($sql);

    if(mysql_affected_rows()>0)
    {
      $pdf->SetFont("arial", "B", 16);
      $pdf->setTextColor(179,0,0);
      $pdf->Cell(200, 5, $titulo,0, 0, 'L', false);
      $pdf->Ln(6);
      $pdf->Cell(200, 5, "Medios DF",0, 0, 'L', false);
      $pdf->Ln(5);
      $pdf->SetFillColor(255);
      $total=0;
      while ($row = mysql_fetch_array($data)) 
      {
          $w=50;
          $total=$row['Suma'];
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

            $pdf->Ln(1);
            $pdf->SetFont("arial", "B", 10);
            $pdf->setTextColor(0);
            $pdf->Ln(1);
            $pdf->SetFillColor(230, 231, 237);
            $pdf->MultiCell($w, 5, " ".$periodico,0, 1, 'J', false);
            $x=$pdf->GetX();
            $y=$pdf->Gety();
            $pdf->SetY($y-5);
            $pdf->SetX($w+5);
            $pdf->MultiCell(8, 5, ": ".$row['total']."",0, 1, 'R', false);
            
          }
      }
      $x=$pdf->GetX();
      $y=$pdf->Gety();
      $pdf->SetY($y+5);
      $pdf->Setx($x);
      $pdf->MultiCell(45, 5, "TOTAL ",0, 1, 'R', false);
      $x=$pdf->GetX();
            $y=$pdf->Gety();
            $pdf->SetY($y-5);
            $pdf->SetX($w+5);
            $pdf->MultiCell(9, 5, ": ".$total."",0, 1, 'R', false);
      $pdf->Ln(5);
  }
  
}

function MediosEstados($pdf,$sql,$titulo, $buscar)
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";
    mysql_query("set names 'utf8'");
    $data =  mysql_query($sql);

    if(mysql_affected_rows()>0)
    {
      $pdf->SetFont("arial", "B", 16);
      $pdf->setTextColor(179,0,0);
      $pdf->Cell(200, 5, $titulo,0, 0, 'L', false);
      $pdf->Ln(6);
      $pdf->Cell(200, 5, "Medios Estados",0, 0, 'L', false);
      $pdf->Ln(5);
      $pdf->SetFillColor(255);
      $total=0;
      while ($row = mysql_fetch_array($data)) 
      {
          $w=50;
          $total=$row['Suma'];
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

            $pdf->Ln(1);
            $pdf->SetFont("arial", "B", 10);
            $pdf->setTextColor(0);
            $pdf->Ln(1);
            $pdf->SetFillColor(230, 231, 237);
            $pdf->MultiCell($w, 5, " ".$periodico,0, 1, 'J', false);
            $x=$pdf->GetX();
            $y=$pdf->Gety();
            $pdf->SetY($y-5);
            $pdf->SetX($w+5);
            $pdf->MultiCell(8, 5, ": ".$row['total']."",0, 1, 'R', false);
            
          }
      }
      $x=$pdf->GetX();
      $y=$pdf->Gety();
      $pdf->SetY($y+5);
      $pdf->Setx($x);
      $pdf->MultiCell(45, 5, "TOTAL ",0, 1, 'R', false);
      $x=$pdf->GetX();
            $y=$pdf->Gety();
            $pdf->SetY($y-5);
            $pdf->SetX($w+5);
            $pdf->MultiCell(9, 5, ": ".$total."",0, 1, 'R', false);
      $pdf->Ln(5);
  }
  
}


function convert_Mayus($string)
{
  $string = trim($string);

    $string = str_replace(
        array('á', 'é', 'í', 'ó', 'ú', 'ñ'),
        array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'),
        $string
    );

  return $string;
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
        $this->Image('/var/www/external/services/mail/sct/logo.png',50,8);
        //color negro
        $this->SetTextColor(0);
        // Arial bold 15
        $this->SetFont('Arial','',11);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->SetXY(150,50);
        $this->Cell(50,10, "Resumen Ejecutivo / ".utf8_decode( fecha_completa2('2014-12-17') ) ,0,0,'R');
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

/*$sql="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico, n.NumeroPagina as 'PaginaPDF', REPLACE(n.Texto,'\n',' ') Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor,n.Periodico AS 'idPeriodico'
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Categoria in(3) AND
    e.idEstado=p.Estado AND
    n.Activo = 1 AND
    Fecha=CURDATE() 
    AND n.Periodico in (32,50,59,53,52,47,51,97,346,247)
  GROUP BY p.Nombre
  ORDER BY o.posicion";*/

//QUERY Direccion
$qryDireccion="
SELECT
n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
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
  n.PieFoto,
  COUNT(n.Periodico) as 'total',(
	SELECT
		COUNT(n.Periodico) as 'total'
		FROM
		  noticiasMensual n,
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
		 n.Activo=1 AND
		  fecha = DATE('2014-12-17') AND(
                Texto like'%Gerardo Ruiz Esparza%' OR
                Texto like '%Ruiz Esparza Gerardo%' OR
                Texto like '%Ruiz Esparza%' OR
                Texto like '%titular de la SCT%' OR

                Titulo like'%Gerardo Ruiz Esparza%' OR
                Titulo like '%Ruiz Esparza Gerardo%' OR
                Titulo like '%Ruiz Esparza%' OR
                Titulo like '%Titular de la SCT%' OR

                Encabezado like'%Gerardo Ruiz Esparza%' OR
                Encabezado like '%Ruiz Esparza Gerardo%' OR
                Encabezado like '%Ruiz Esparza%' OR
                Encabezado like '%Titular de la SCT%' OR

                PieFoto like'%Gerardo Ruiz Esparza%' OR
                PieFoto like '%Ruiz Esparza Gerardo%' OR
                PieFoto like '%Ruiz Esparza%'  OR
                PieFoto like '%Titular de la SCT%'
              )
)
as Suma
FROM
  noticiasMensual n,
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
 n.Activo=1 AND
  fecha = DATE('2014-12-17') AND(
      Texto like'%Gerardo Ruiz Esparza%' OR
      Texto like '%Ruiz Esparza Gerardo%' OR
      Texto like '%Ruiz Esparza%' OR
      Texto like '%titular de la SCT%' OR

      Titulo like'%Gerardo Ruiz Esparza%' OR
      Titulo like '%Ruiz Esparza Gerardo%' OR
      Titulo like '%Ruiz Esparza%' OR
      Titulo like '%Titular de la SCT%' OR

      Encabezado like'%Gerardo Ruiz Esparza%' OR
      Encabezado like '%Ruiz Esparza Gerardo%' OR
      Encabezado like '%Ruiz Esparza%' OR
      Encabezado like '%Titular de la SCT%' OR

      PieFoto like'%Gerardo Ruiz Esparza%' OR
      PieFoto like '%Ruiz Esparza Gerardo%' OR
      PieFoto like '%Ruiz Esparza%'  OR
      PieFoto like '%Titular de la SCT%'
    )
GROUP BY   n.Periodico
ORDER BY o.posicion";
$buscar = array(
    "Juan Carlos Cortés García",
    "Juan Carlos Cortés",
    "Financiera Nacional de Desarrollo"
);

MediosDF($pdf, $qryDireccion, $titulo = utf8_decode("Secretario - Gerardo Ruiz Esparza"), $buscar);
$pdf->addPage();
//QUERY Direccion
$queryEstados="SELECT
n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
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
  n.PieFoto,
  COUNT(n.Periodico) as 'total',(
	SELECT
		COUNT(n.Periodico) as 'total'
	FROM
	  noticiasMensual n,
	  periodicos p,
	  seccionesPeriodicos s,
	  categoriasPeriodicos c,
	  estados e
	WHERE
	  p.idPeriodico=n.Periodico AND
	  s.idSeccion=n.Seccion AND
	  c.idCategoria=n.Categoria AND
	  p.Estado=e.idEstado AND
	  p.Estado!=9 AND
	  n.Activo=1 AND
	  fecha = DATE('2014-12-17') AND(
      Texto like'%Gerardo Ruiz Esparza%' OR
      Texto like '%Ruiz Esparza Gerardo%' OR
      Texto like '%Ruiz Esparza%' OR
      Texto like '%titular de la SCT%' OR

      Titulo like'%Gerardo Ruiz Esparza%' OR
      Titulo like '%Ruiz Esparza Gerardo%' OR
      Titulo like '%Ruiz Esparza%' OR
      Titulo like '%Titular de la SCT%' OR

      Encabezado like'%Gerardo Ruiz Esparza%' OR
      Encabezado like '%Ruiz Esparza Gerardo%' OR
      Encabezado like '%Ruiz Esparza%' OR
      Encabezado like '%Titular de la SCT%' OR

      PieFoto like'%Gerardo Ruiz Esparza%' OR
      PieFoto like '%Ruiz Esparza Gerardo%' OR
      PieFoto like '%Ruiz Esparza%'  OR
      PieFoto like '%Titular de la SCT%'
    )
)as Suma
FROM
  noticiasMensual n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  p.Estado!=9 AND n.Categoria!=80 AND
 n.Activo=1 AND
  fecha = DATE('2014-12-17') AND(
      Texto like'%Gerardo Ruiz Esparza%' OR
      Texto like '%Ruiz Esparza Gerardo%' OR
      Texto like '%Ruiz Esparza%' OR
      Texto like '%titular de la SCT%' OR

      Titulo like'%Gerardo Ruiz Esparza%' OR
      Titulo like '%Ruiz Esparza Gerardo%' OR
      Titulo like '%Ruiz Esparza%' OR
      Titulo like '%Titular de la SCT%' OR

      Encabezado like'%Gerardo Ruiz Esparza%' OR
      Encabezado like '%Ruiz Esparza Gerardo%' OR
      Encabezado like '%Ruiz Esparza%' OR
      Encabezado like '%Titular de la SCT%' OR

      PieFoto like'%Gerardo Ruiz Esparza%' OR
      PieFoto like '%Ruiz Esparza Gerardo%' OR
      PieFoto like '%Ruiz Esparza%'  OR
      PieFoto like '%Titular de la SCT%'
    )
GROUP BY   n.Periodico
ORDER BY p.Estado,p.Nombre";
$buscar = array(
    "Juan Carlos Cortés García",
    "Juan Carlos Cortés",
    "Financiera Nacional de Desarrollo"
);

MediosEstados($pdf, $queryEstados, $titulo = utf8_decode("Secretario - Gerardo Ruiz Esparza"), $buscar);
$pdf->addPage();


$sqlNotas="
SELECT
n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion as Seccion,
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
  n.PieFoto,
  COUNT(n.Periodico) as 'total'
FROM
  noticiasMensual n,
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
 n.Activo=1 AND
  fecha = DATE('2014-12-17') AND(
         Texto like'%Gerardo Ruiz Esparza%' OR
         Texto like '%Ruiz Esparza Gerardo%' OR
         Texto like '%Ruiz Esparza%' OR

         Titulo like'%Gerardo Ruiz Esparza%' OR
         Titulo like '%Ruiz Esparza Gerardo%' OR
         Titulo like '%Ruiz Esparza%' OR

         Encabezado like'%Gerardo Ruiz Esparza%' OR
         Encabezado like '%Ruiz Esparza Gerardo%' OR
         Encabezado like '%Ruiz Esparza%' OR
	
		 PieFoto like'%Gerardo Ruiz Esparza%' OR
         PieFoto like '%Ruiz Esparza Gerardo%' OR
         PieFoto like '%Ruiz Esparza%'

      )
GROUP BY  n.idEditorial
ORDER BY o.posicion";
$buscar = array(
    "Juan Carlos Cortés García",
    "Juan Carlos Cortés",
    "Financiera Nacional de Desarrollo"
);

texto($pdf, $sqlNotas, $titulo = utf8_decode("Notas DF"), $buscar);

$sqlNotasEstados="
SELECT
n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion as Seccion,
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
  n.PieFoto,
  COUNT(n.Periodico) as 'total'
FROM
  noticiasMensual n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  p.Estado!=9 AND n.Categoria!=80 AND
  n.Activo=1 AND
  fecha = DATE('2014-12-17') AND(
         Texto like'%Gerardo Ruiz Esparza%' OR
         Texto like '%Ruiz Esparza Gerardo%' OR
         Texto like '%Ruiz Esparza%' OR

         Titulo like'%Gerardo Ruiz Esparza%' OR
         Titulo like '%Ruiz Esparza Gerardo%' OR
         Titulo like '%Ruiz Esparza%' OR

         Encabezado like'%Gerardo Ruiz Esparza%' OR
         Encabezado like '%Ruiz Esparza Gerardo%' OR
         Encabezado like '%Ruiz Esparza%' OR
	
		 PieFoto like'%Gerardo Ruiz Esparza%' OR
         PieFoto like '%Ruiz Esparza Gerardo%' OR
         PieFoto like '%Ruiz Esparza%'

      )
GROUP BY  n.idEditorial
ORDER BY p.estado,p.Nombre";
$buscar = array(
    "Juan Carlos Cortés García",
    "Juan Carlos Cortés",
    "Financiera Nacional de Desarrollo"
);

texto($pdf, $sqlNotasEstados, $titulo = utf8_decode("Notas Estados"), $buscar);



$nombre = "Reporte SCT .pdf";
//$nombre = "/var/www/external/services/mail/financiera/".DATE('Y-m-d')."Reporte Financiera_V2.pdf";
$pdf->Output($nombre, 'I'); 
