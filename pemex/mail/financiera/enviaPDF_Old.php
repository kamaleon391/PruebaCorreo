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
      $pdf->Ln();
      $pdf->SetFont("arial", "B", 11);
      $pdf->SetFillColor(106,188,60);
      $pdf->setTextColor(255);
      $pdf->Cell(200, 5, $titulo,0, 1, 'C', true);
    
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
            $pdf->SetFillColor(224);
            $pdf->Ln(4);
            $pdf->Cell(200, 5, $periodico ,0, 1, 'L', true);

            $pdf->SetFillColor(255);
            $pdf->Ln(2);
            $titulo =  sanear_string(utf8_decode( $row['Titulo']));
            $pdf->Cell(200, 5, correctorOrtografico2( $titulo ) ,0, 1, 'L', true);
           
          
            $pdf->Ln();
            $pdf->setTextColor(0);
            $pdf->SetFont("arial", "", 9);
            $texto = sanear_string(utf8_decode(  $row['Texto']));
            $texto = correctorOrtografico2($texto);
            
            //$texto  = ( !empty($buscar) ) ? EncuentraArreglo2($texto,$buscar): $texto;
            $texto  = EncuentraCoincidencias3($texto);
            



            $pdf->MultiCell(200,4, $texto ,0,'J');

            $pdf->Ln();
            $pdf->SetFont("arial", "", 8);
            $pdf->SetTextColor(86, 104, 239);
            $pdf->Cell(200,4, $periodico." ".utf8_decode(  $row['Estado'])." ".date("Y-m-d")." Pag. ".utf8_decode(  $row['PaginaPeriodico']) ,0,0,'L',false, $urlP ."/". $row['pdf'] );
           
            $pdf->Ln();
            $pdf->SetFont("arial", "", 7.5);
            $pdf->SetTextColor(0);
            $pdf->Cell( 150,4, $urlP ."/". $row['pdf'],0,0,'L',false, $urlP."/". $row['pdf']);
          
            $pdf->Ln(5);

          }
          

      }

     

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


function cintillosPDF($pdf,$sql)
{
    $y = 40;
    $i = 0;
   

    $resp=  mysql_query($sql);
    while($row= mysql_fetch_array($resp))
    {

        $i++;
        $periodico = utf8_encode($row['Periodico']);
        $periodico =  ucwords($periodico);
        $titulito = strtoupper($row['Titulo']);
       

        $titulito = correctorOrtografico2($titulito);

        $titulito = convert_Mayus($titulito);

        if(is_file("/var/www/external/services/mail/sct/Word/".ucwords(strtolower($periodico)).".png"))
        {
          $pdf->Image("/var/www/external/services/mail/sct/Word/".ucwords(strtolower($periodico).".png"),20,$y);

            if($titulito!="")
            {
              $pdf->setY( $y + 20 );
              $pdf->SetTextColor(86, 104, 239);
              $pdf->Cell(200, 5, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'C', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              
            }

          $y += 30;
        }
      

        if($i == 10){
          $i = 0;
          $pdf->AddPage();
          $y = 30; 
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
        // Logo
        $this->Image('/var/www/external/services/mail/financiera/img/logo_fdn.png',80,10);
        //color negro
        $this->SetTextColor(0);
        // Arial bold 15
        $this->SetFont('Arial','',11);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->SetXY(150,30);
        $this->Cell(50,10, "Resumen Ejecutivo / ".utf8_decode( fecha_completa2(date('Y-m-d')) ) ,0,0,'R');
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

$sql="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico, n.NumeroPagina as 'PaginaPDF', REPLACE(n.Texto,'\n',' ') Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
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
  ORDER BY o.posicion";

cintillosPDF($pdf,$sql);

$pdf->Ln(12);

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
      c.idCategoria in(3) AND
      n.Activo = 1 AND
      fecha =CURDATE()
      GROUP BY n.NumeroPagina,p.idPeriodico
      ORDER BY o.posicion";


texto($pdf, $sqlPlanas, $titulo = "PRIMERAS PLANAS", $buscar = array() );
*/


//QUERY FINANCIERA
$qryDireccion="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
          Texto like '%juan carlos cortes garcia%' OR 
          Texto like '%juan cortes garcia%' OR 
          Texto like '%juan carlos cortes%' OR 
          
          Titulo like '%juan carlos cortes garcia%' OR 
          Titulo like '%juan cortes garcia%' OR 
          Titulo like '%juan carlos cortes%' OR 
          
          Encabezado like '%juan carlos cortes garcia%' OR 
          Encabezado like '%juan cortes garcia%' OR 
          Encabezado like '%juan carlos cortes%' 
        ) 
ORDER BY o.posicion";
$buscar = array(
    "Juan Carlos Cortés García",
    "Juan Carlos Cortés",
    "Financiera Nacional de Desarrollo"
);

texto($pdf, $qryDireccion, $titulo = "Dirección General - Juan Carlos Cortés García", $buscar);


//QUERY FINANCIERA
$qryFinanciera="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
          Texto like '%Financiamiento Rural%' OR 
          Texto like '%Financiera naciónal de Desarrollo Agropecuario%' OR
          Texto like '%Financiera nacional de Desarrollo%' OR
          Texto like '%Financiera nacional%' OR
          Texto like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
          Texto like '%financiera rural%' OR
          Texto like '%finrural%' OR

          Titulo like '%Financiamiento Rural%' OR 
          Titulo like '%Financiera naciónal de Desarrollo Agropecuario%' OR
          Titulo like '%Financiera nacional de Desarrollo%' OR
          Titulo like '%Financiera nacional%' OR
          Titulo like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
          Titulo like '%financiera rural%' OR
          Titulo like '%finrural%' OR

          Encabezado like '%Financiamiento Rural%' OR 
          Encabezado like '%Financiera naciónal de Desarrollo Agropecuario%' OR
          Encabezado like '%Financiera nacional de Desarrollo%' OR
          Encabezado like '%Financiera nacional%' OR
          Encabezado like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
          Encabezado like '%financiera rural%' OR
          Encabezado like '%finrural%' 
        )
ORDER BY o.posicion";
$buscar = array("finrural","Financiera nacional","Financiera nacional de Desarrollo","Financiera Rural","Financiera naciónal de Desarrollo Agropecuario","Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero");

texto($pdf, $qryFinanciera, $titulo = "Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero", $buscar);







//QUERY PARA LA SECRETARIA DE HACIENDA Y CREDITO PUBLICO
$qrySHCP = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  REPLACE(n.Texto,'\n',' ') Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
          Texto like '%shcp%' OR
          Texto like '%Luis Videgaray Caso%' OR
          Texto like '%Luis Videgaray%' OR
          Texto like '%secretario de hacienda%' OR
          Texto like '%servicio de administracion tributaria%' OR
          Texto like '% SAT %' OR
          Texto like '%secretaria de hacienda y credito publico%' OR
          Texto like '%hacienda y credito publico%' OR
          Texto like '%secretaria de hacienda%' OR
          
          Titulo like '%shcp%' OR
          Titulo like '%Luis Videgaray Caso%' OR
          Titulo like '%secretario de hacienda%' OR
          Titulo like '%servicio de administracion tributaria%' OR
          Titulo like '% SAT %' OR
          Titulo like '%Luis Videgaray%' OR
          Titulo like '%secretaria de hacienda y credito publico%' OR
          Titulo like '%hacienda y credito publico%' OR
          Titulo like '%secretaria de hacienda%' OR
          
          Encabezado like '%shcp%' OR
          Encabezado like '%Luis Videgaray Caso%' OR
          Encabezado like '%Luis Videgaray%' OR          
          Encabezado like '%servicio de administracion tributaria%' OR
          Encabezado like '% SAT %' OR
          Encabezado like '%secretario de hacienda%' OR
          Encabezado like '%secretaria de hacienda y credito publico%' OR
          Encabezado like '%hacienda y credito publico%' OR
          Encabezado like '%secretaria de hacienda%' 
          
          ) AND Texto not like '%ex secretario de Hacienda%' 
ORDER BY o.posicion";
$buscar = array("SHCP.","subsecretario de Hacienda","Servicio de Administración Tributaria","Secretaría de Hacienda y Crédito Público","Secretaría de Hacienda","SHCP","shcp","Luis Videgaray Caso","Luis Videgaray","servicio de administracion tributaria","SAT",
              "secretario de hacienda","secretaria de hacienda y credito publico","hacienda y credito publico","secretaria de hacienda","Secretaría de Haciendaa","Comisión de Hacienda y Crédito Público","Hacienda y Crédito Público");

texto($pdf, $qrySHCP, $titulo = "SECRETARIA DE HACIENDA Y CREDITO PUBLICO", $buscar);




//QUERY PARA Secretaria de Desarrollo Agrario Territorial y Urbano
$qrySDATU = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  REPLACE(n.Texto,'\n',' ') Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
         Texto like '%Secretaria de la reforma agraria%' OR 
          Texto like '% SRA %' OR 
          Texto like '%SEDATU%' OR 

          Titulo like '%Secretaria de la reforma agraria%' OR 
          Titulo like '% SRA %' OR 
          Titulo like '%SEDATU%' OR 

          Encabezado like '%Secretaria de la reforma agraria%' OR 
          Encabezado like '% SRA %' OR
          Encabezado like '%SEDATU%' 
          
          )
ORDER BY o.posicion";
$buscar = array("SRA","SEDATU","Secretaria de la reforma agraria");
texto($pdf, $qrySDATU, $titulo = "Secretaria de Desarrollo Agrario Territorial y Urbano",$buscar);


//QUERY PARA Comisión Nacional Bancaria y de Valores
$qry3 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  REPLACE(n.Texto,'\n',' ') Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  Texto like '% CNBV %' OR 
  Texto like '%comision nacional bancaria y de valores%' OR 
  Texto like '%comision nacional bancaria%' OR 

  Titulo like '% CNBV %' OR 
  Titulo like '%comision nacional bancaria y de valores%' OR 
  Titulo like '%comision nacional bancaria%' OR 

  Encabezado like '% CNBV %' OR 
  Encabezado like '%comision nacional bancaria y de valores%' OR
  Encabezado like '%comision nacional bancaria%'
          
)
ORDER BY o.posicion";

$buscar = array("CNBV","comision nacional bancaria y de valores","comision nacional bancaria","Comisión Nacional Bancaria y de Valores");
texto($pdf, $qry3, $titulo = "Comisión Nacional Bancaria y de Valores", $buscar);





//QUERY PARA Banco Nacional de Credito Agricola
$qry4 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  REPLACE(n.Texto,'\n',' ') Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  (Texto like '%Banco Nacional de credito agricola%' OR 
  Texto like '%banco nacional agropecuario%' OR
  Texto like '%banrural%' OR
  Texto like '%financiera rural%' OR
  Texto like '%banco de financiera rural%' OR
  Texto like '%banco y financiera rural%' OR
  Texto like '%bancos%' OR
  Texto like '%banco%' OR
  
  Titulo like '%Banco Nacional de credito agricola%' OR 
  Titulo like '%banco nacional agropecuario%' OR
  Titulo like '%banrural%' OR
  Titulo like '%financiera rural%' OR
  Titulo like '%banco de financiera rural%' OR
  Titulo like '%banco y financiera rural%' OR
  Titulo like '%bancos%' OR
  Titulo like '%banco%' OR
  
  Encabezado like '%Banco Nacional de credito agricola%' OR 
  Encabezado like '%banco nacional agropecuario%' OR
  Encabezado like '%banrural%' OR
  Encabezado like '%financiera rural%' OR
  Encabezado like '%banco de financiera rural%' OR
  Encabezado like '%banco y financiera rural%' OR
  Encabezado like '%bancos%' OR
  Encabezado like '%banco%' )
  AND 
  (
    Texto NOT like '%Desbancó%' AND 
    Titulo NOT like '%Desbancó%' AND
    Encabezado NOT like '%Desbancó%'
  ) 
          
)
ORDER BY o.posicion";

$buscar = array("Banco Nacional de credito agricola","banco nacional agropecuario","banrural","financiera rural","banco de financiera rural","banco y financiera rural"
              ,"bancos","banco","Bancomer","Bancomext");
texto($pdf, $qry4, $titulo = "Banco Nacional de Credito Agricola", $buscar);



//QUERY PARA Seguros Financieros
$qry5 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  REPLACE(n.Texto,'\n',' ') Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  Texto like '%Seguros financiera rural%' OR 
  Texto like '%seguros y financiera rural%' OR
  Texto like '%seguros con financiera rural%' OR
  Texto like '%seguros%' OR

  Titulo like '%Seguros financiera rural%' OR 
  Titulo like '%seguros y financiera rural%' OR
  Titulo like '%seguros con financiera rural%' OR
  Titulo like '%seguros%' OR

  Encabezado like '%Seguros financiera rural%' OR 
  Encabezado like '%seguros y financiera rural%' OR
  Encabezado like '%seguros con financiera rural%' OR
  Encabezado like '%seguros%' 

  AND
  (
  Texto like '%financiera rural%' OR
  Titulo like '%financiera rural%' OR
  Encabezado like '%financiera rural%' 
  ) 
          
)
ORDER BY o.posicion";

$buscar = array("Seguros financiera rural","seguros y financiera rural",
  "seguros con financiera rural","seguros","financiera rural");
texto($pdf, $qry5, $titulo = "Seguros Financieros", $buscar);




// Query para Mercados Internacionales
$qry6 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  REPLACE(n.Texto,'\n',' ') Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  Texto like '%Mercados Internacionales%' OR 

  Titulo like '%Mercados Internacionales%' OR 

  Encabezado like '%Mercados Internacionales%'
          
)
ORDER BY o.posicion";
$buscar = array("Mercados Internacionales");
texto($pdf, $qry6, $titulo = "Mercados Internacionales",$buscar);

//QUERY para VARIOS
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  REPLACE(n.Texto,'\n',' ') Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  Texto like '% SASA % ' OR 
  Texto like '%Sector Agricultor%' OR
  Texto like '%Sector Pecuario%' OR
  Texto like '%Sector Pesquero%' OR
  Texto like '%Sector Forestal%' OR
  Texto like '%Medio Ambiente%' OR
  
  Titulo like '% SASA % ' OR 
  Titulo like '%Sector Agricultor%' OR
  Titulo like '%Sector Pecuario%' OR
  Titulo like '%Sector Pesquero%' OR
  Titulo like '%Sector Forestal%' OR
  Titulo like '%Medio Ambiente%' OR
  
  Encabezado like '% SASA % ' OR 
  Encabezado like '%Sector Agricultor%' OR
  Encabezado like '%Sector Pecuario%' OR
  Encabezado like '%Sector Pesquero%' OR
  Encabezado like '%Sector Forestal%' OR
  Encabezado like '%Medio Ambiente%'
          
)
ORDER BY o.posicion";
$buscar = array("SASA","Sector Agricultor","Sector Pecuario",
  "Sector Pesquero","Sector Forestal","Medio Ambiente");
texto($pdf, $qryV, $titulo = "VARIOS", $buscar);


//QUERY PARA Columnas Politicas
$qryPol = "SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico ,n.NumeroPagina as 'PaginaPDF', REPLACE(n.Texto,'\n',' ') Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Categoria in(19) AND
    e.idEstado=p.Estado AND
    n.Activo = 1 AND
    Fecha=CURDATE() 
  GROUP BY p.Nombre
  ORDER BY o.posicion";

$buscar = array();
texto($pdf, $qryPol, $titulo = "Columnas Politicas",$buscar = array());



//QUERY PARA Columnas Financieras
$qryF = "SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico ,n.NumeroPagina as 'PaginaPDF', REPLACE(n.Texto,'\n',' ') Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    n.Categoria in(20) AND
    e.idEstado=p.Estado AND
    n.Activo = 1 AND
    Fecha=CURDATE() 
  GROUP BY p.Nombre";
$buscar = array();
texto($pdf, $qryF, $titulo = "Columnas Financieras", $buscar );

//QUERY PARA Cartones
$qryC = "SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico,n.NumeroPagina as 'PaginaPDF', REPLACE(n.Texto,'\n',' ') Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Categoria in(18) AND
    e.idEstado=p.Estado AND
    p.Estado = 9 AND
    n.Activo = 1 AND
    Fecha=CURDATE() 
  GROUP BY p.Nombre
  ORDER BY o.posicion";
$buscar = array();
texto($pdf, $qryC, $titulo = "Cartones", $buscar = array() );




$nombre = "/var/www/external/testigos/Financiera/".DATE('Y-m-d')."Reporte Financiera.pdf";
$pdf->Output($nombre, 'F'); 
