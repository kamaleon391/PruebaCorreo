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
                  case "el milenio guadalajara:":
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
              $pdf->MultiCell(200, 5, " ".$periodico.":" ,0, 1, 'L', false);

              $pdf->SetFillColor(255);
              $pdf->Ln(2);
              $titulo =  sanear_string(utf8_decode( $row['Titulo']));
              $encabezado =  sanear_string(utf8_decode( $row['Encabezado']));
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
        $this->Image('/var/www/external/services/mail/villanueva/prijalisco.png',80,10,40);
        //color negro
        $this->SetTextColor(0);
        // Arial bold 15
        $this->SetFont('Arial','',11);
        // Movernos a la derecha
        $this->Cell(100);
        // Título
        $this->SetXY(150,45);
        //$this->Cell(50,10, "Resumen Ejecutivo / ".utf8_decode( fecha_completa2(date('Y-m-d')) ) ,0,0,'R');
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

    $opc=  base64_decode(base64_decode($_GET['p'])); 
    $pdf = new PDF('P','mm','legal');
    $pdf->AliasNbPages();

    $pdf->addPage();
    $pdf->SetX(10);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',11);

                    //Recuadro Gris Inferior
    $pdf->SetFillColor(245,245,245);
    $pdf->Rect(0, 131, 250, 40, 'F');
    $pdf->setTextColor();
    $pdf->SetFont("arial", "B", 25);
    $pdf->Text(10,146,  utf8_decode("Resumen Ejecutivo"));
    $pdf->Text(10,156, titulo($opc) );
    $pdf->SetFont("arial", "B", 13);
    $pdf->setTextColor(255,255,255);
    $pdf->SetFont("arial", "B",15);
    $pdf->setTextColor();
    $pdf->Text(120,177,  utf8_decode(fecha_completa2(date('Y-m-d'))));  
    $pdf->addPage();
    
    
    principal($opc,$pdf);
    
    $nombre = "Reporte ".titulo($opc)."_".DATE('Y-m-d').".pdf";

$pdf->Output($nombre, 'D'); 


function querys($opc)
{
    $query="";
    
    switch ($opc)
    {
        case 1:
            $query="SELECT
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
                n.Foto,
                n.PieFoto
              FROM
                noticiasDia n,
                periodicos p,
              ordenGeneraljalisco o,
                seccionesPeriodicos s,
                categoriasPeriodicos c,
                estados e
                WHERE p.idPeriodico=n.Periodico AND
              p.idPeriodico=o.periodico AND
              s.idSeccion=n.Seccion AND
              c.idCategoria=n.Categoria AND
              p.estado=e.idEstado AND
              n.Activo=1 AND
              fecha = CURDATE() AND (
                  Texto like '%Ricardo Villanueva Lomeli%' OR
                  Texto like '%Villanueva Lomeli%' OR
                  Texto like '%Ricardo Villanueva%' OR

                  Titulo like '%Ricardo Villanueva Lomeli%' OR
                  Titulo like '%Villanueva Lomeli%' OR
                  Titulo like '%Ricardo Villanueva%' OR

                  Encabezado like '%Ricardo Villanueva Lomeli%' OR
                  Encabezado like '%Villanueva Lomeli%' OR
                  Encabezado like '%Ricardo Villanueva%' OR

                  PieFoto like '%Ricardo Villanueva Lomeli%' OR
                  PieFoto like '%Villanueva Lomeli%' OR
                  PieFoto like '%Ricardo Villanueva%'
                )
              ORDER BY p.Estado,p.Nombre";
        break;//Villanueva
        
        case 2:
            $query="SELECT
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
                n.Foto,
                n.PieFoto
              FROM
                noticiasDia n,
                periodicos p,
              ordenGeneraljalisco o,
                seccionesPeriodicos s,
                categoriasPeriodicos c,
                estados e
                WHERE p.idPeriodico=n.Periodico AND
              p.idPeriodico=o.periodico AND
              s.idSeccion=n.Seccion AND
              c.idCategoria=n.Categoria AND
              p.estado=e.idEstado AND
              n.Activo=1 AND
              fecha = CURDATE() AND (
                    Texto like '%Enrique Alfaro Ramirez%' OR
                    Texto like '%Enrique Alfaro%' OR
                    Texto like '%Alfaro Ramirez%' OR

                    Titulo like '%Enrique Alfaro Ramirez%' OR
                    Titulo like '%Enrique Alfaro%' OR
                    Titulo like '%Alfaro Ramirez%' OR

                    Encabezado like '%Enrique Alfaro Ramirez%' OR
                    Encabezado like '%Enrique Alfaro%' OR
                    Encabezado like '%Alfaro Ramirez%' OR

                    PieFoto like '%Enrique Alfaro Ramirez%' OR
                    PieFoto like '%Enrique Alfaro%' OR
                    PieFoto like '%Alfaro Ramirez%'
              )
              ORDER BY p.Estado,p.Nombre";
        break;//Alfaro
        case 3:
            $query="SELECT
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
                n.Foto,
                n.PieFoto
              FROM
                noticiasDia n,
                periodicos p,
              ordenGeneraljalisco o,
                seccionesPeriodicos s,
                categoriasPeriodicos c,
                estados e
                WHERE p.idPeriodico=n.Periodico AND
              p.idPeriodico=o.periodico AND
              s.idSeccion=n.Seccion AND
              c.idCategoria=n.Categoria AND
              p.estado=e.idEstado AND
              n.Activo=1 AND
              fecha = CURDATE() AND (
                    Texto like '%Alfonso Petersen Farah%' OR
                    Texto like '%Alfonso Petersen%' OR

                    Titulo like '%Alfonso Petersen Farah%' OR
                    Titulo like '%Alfonso Petersen%' OR

                    Encabezado like '%Alfonso Petersen Farah%' OR
                    Encabezado like '%Alfonso Petersen%' OR

                    PieFoto like '%Alfonso Petersen Farah%' OR
                    PieFoto like '%Alfonso Petersen%' 
                )
              ORDER BY p.Estado,p.Nombre";
        break;//Petersen
        case 4:
            $query="SELECT
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
                n.Foto,
                n.PieFoto
              FROM
                noticiasDia n,
                periodicos p,
              ordenGeneraljalisco o,
                seccionesPeriodicos s,
                categoriasPeriodicos c,
                estados e
                WHERE p.idPeriodico=n.Periodico AND
              p.idPeriodico=o.periodico AND
              s.idSeccion=n.Seccion AND
              c.idCategoria=n.Categoria AND
              p.estado=e.idEstado AND
              n.Activo=1 AND
              fecha = CURDATE() AND (
                            Texto like '%Guadalajara%' OR
                            Texto like '% GDL %' OR

                            Titulo like '%Guadalajara%' OR
                            Titulo like '% GDL %' OR

                            Encabezado like '%Guadalajara%' OR
                            Encabezado like '% GDL %' OR

                            PieFoto like '%Guadalajara%' OR
                            PieFoto like '% GDL %'
                    )
              ORDER BY p.Estado,p.Nombre";
        break;//GDL
        
    }
    
    
    return $query;
}

function titulo($opc)
{
    $titulo=0;
    switch ($opc)
    {
        case 1:
            $titulo=utf8_decode("Ricardo Villanueva Lomelí");
        break;
        case 2:
            $titulo=utf8_decode("Enrique Alfaro Ramírez");
        break;
        case 3:
            $titulo=utf8_decode("Alfonso Petersen Farah");
        break;
        case 4:
            $titulo=utf8_decode("Guadalajara");
        break;
    }
    return $titulo;
}

function buscar($opc)
{
    $buscar=array();
    switch ($opc)
    {
        case 1:
            $buscar = array(
                "Ricardo Villanueva Lomelí",
                "Villanueva Lomelí"
            );
        break;
    
        case 2:
            $buscar = array(
                "Enrique Alfaro",
                "Alfaro Ramírez",
                "Alfaro Ramirez"
            );
        break;
    
        case 3:
            $buscar = array(
                "Alfonso Petersen Farah",
                "Alfonso Petersen"
            );
        break;
    
        case 4:
            $buscar = array(
                "Guadalajara",
                "GDL"
            );
        break;
    }
    
    return $buscar;
}

function principal($opc,$pdf)
{
    $SQL=querys($opc);
    $arraysearch=buscar($opc);
    texto($pdf, $query=$SQL, $titulo =titulo($opc) , $arraysearch);
}