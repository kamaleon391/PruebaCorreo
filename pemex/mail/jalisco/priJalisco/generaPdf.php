<?php

ignore_user_abort(true);
set_time_limit(0);


    include "/var/www/external/services/mail/conexion.php";

  $fecha = date('Y-m-d');

    $query = " SELECT
  n.Fecha,
  p.Nombre as 'periodico',
  s.seccion AS 'Seccion',
  c.Categoria,
  n.Autor,
  n.Titulo,
  n.Encabezado,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf'
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c
WHERE
  n.periodico=o.periodico   AND
  c.idCategoria=n.Categoria AND
  n.periodico=p.idPeriodico AND
  n.Categoria <> 80       AND
  s.idSeccion=n.Seccion   AND
  n.Fecha = '$fecha'    AND  (
    Texto like '%Presidente PRI Jalisco%' OR
    Texto like '%Hector Pizano Ramos%' OR
    Texto like '%presidente del PRI en Jalisco%' OR
    Texto like '%Hector Pizano%' OR
    Texto like '%Pizano Ramos%' OR
    Texto like '%Mariana Fernandez Ramirez%' OR
    Texto like '%Mariana Fernandez%' OR
    Texto like '%Juan Alcala Duenas%' OR
    Texto like '%Juan Alcala%' OR
    Texto like '%Rafael Castellanos%' OR
    Texto like '%Enrique Ochoa Reza%' OR
    Texto like '%Comite Ejecutivo Nacional del PRI%' OR

    Titulo like '%Presidente PRI Jalisco%' OR
    Titulo like '%Hector Pizano Ramos%' OR
    Titulo like '%presidente del PRI en Jalisco%' OR
    Titulo like '%Hector Pizano%' OR
    Titulo like '%Pizano Ramos%' OR
    Titulo like '%Mariana Fernandez Ramirez%' OR
    Titulo like '%Mariana Fernandez%' OR
    Titulo like '%Rafael Castellanos%' OR
    Titulo like '%Enrique Ochoa Reza%' OR
    Titulo like '%Comite Ejecutivo Nacional del PRI%' OR

    Encabezado like '%Presidente PRI Jalisco%' OR
    Encabezado like '%Hector Pizano Ramos%' OR
    Encabezado like '%presidente del PRI en Jalisco%' OR
    Encabezado like '%Hector Pizano%' OR
    Encabezado like '%Pizano Ramos%' OR
    Encabezado like '%Mariana Fernandez Ramirez%' OR
    Encabezado like '%Mariana Fernandez%' OR
    Encabezado like '%Juan Alcala Duenas%' OR
    Encabezado like '%Juan Alcala%' OR
    Encabezado like '%Rafael Castellanos%' OR
    Encabezado like '%Enrique Ochoa Reza%' OR
    Encabezado like '%Comite Ejecutivo Nacional del PRI%' OR

    PieFoto like '%Presidente PRI Jalisco%' OR
    PieFoto like '%Hector Pizano Ramos%' OR
    PieFoto like '%presidente del PRI en Jalisco%' OR
    PieFoto like '%Hector Pizano%' OR
    PieFoto like '%Pizano Ramos%' OR
    PieFoto like '%Mariana Fernandez Ramirez%' OR
    PieFoto like '%Mariana Fernandez%' OR
    PieFoto like '%Juan Alcala Duenas%' OR
    PieFoto like '%Juan Alcala%' OR
    PieFoto like '%Rafael Castellanos%' OR
    PieFoto like '%Enrique Ochoa Reza%' OR
    PieFoto like '%Comite Ejecutivo Nacional del PRI%'
  )
GROUP BY n.Periodico, n.NumeroPagina
ORDER BY o.posicion";
//var_dump($query);
    creaPDF( $query , $fecha);

function creaPDF( $query , $fecha){

  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  $pdf = new FPDI('P','mm','legal');

  $lugar = 'Jalisco';

  $fechaCompleta = mostrar_fecha_completa( $fecha );

  //CODIGO PARA LA PORTADA


  $pdf->addPage();
  //$pdf->SetFillColor(245,245,245);
  //$pdf->Rect(0, 131, 250, 40, 'F');

  //$pdf->setTextColor();
  //$pdf->SetFont("arial", "B", 30);
  //$pdf->Text(10,156,strtoupper($lugar));
  //$pdf->SetFont("arial", "B", 13);
  //$pdf->setTextColor(255,255,255);
  //$pdf->Text(10,23,"test");

  $pdf->Image('/var/www/external/services/mail/jalisco/priJalisco/pri.png',5,90,100,'PNG');

  $pdf->SetFont("arial", "B",15);
  $pdf->setTextColor();
  $pdf->Text(120,177,$fechaCompleta);

    //$portada = '/var/www/external/testigos/Jalisco/portada.pdf';

    $pdfs = array();

    $i=1;
    $query1 =  mysql_query($query);
    $filas = mysql_affected_rows();

    if($filas > 0)
    {
      while( $row = mysql_fetch_array($query1) )
      {
            $variable = $row['pdf'];
            $periodico = $row['periodico'];
            $secciones = $row['Seccion'];

            if(file_exists($variable)){

                if(!in_array($variable, $pdfs))
                {
                  $pdfs[] = $row['pdf'];
                  $i++;
                }
               // if($i==1) $pdfs[] = $portada;
            }


      }
    }
    else{
      echo "No hay resultados para mostrar";
    }

        //$pdfs[]= "/var/www/Sistema-de-Captura/Periodicos/El Informador/2014-11-26/A_5.pdf";

        if( !empty($pdfs) ){

          $pdf->setFiles( $pdfs );
          $pdf->concat();

          $nombre="/var/www/external/testigos/Jalisco/SN/prijalisco.pdf";
          $pdf->Output($nombre, 'F');

        }
}


function portada($fecha, $sec)
{
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  $pdf = new FPDI('P','mm','legal');

  $pdf->addPage();
  $pdf->SetFillColor(245,245,245);
  $pdf->Rect(0, 131, 250, 40, 'F');

  $pdf->setTextColor();
  $pdf->SetFont("arial", "B", 30);
  $pdf->Text(10,156,strtoupper($sec));
  $pdf->SetFont("arial", "B", 13);
  $pdf->setTextColor(255,255,255);
  $pdf->Text(10,23,"test");

  $pdf->Image('/var/www/external/services/mail/jalisco/priJalisco/pri.png',5,90,100);
  $pdf->SetFont("arial", "B",15);
  $pdf->setTextColor();
  $pdf->Text(120,177,mostrar_fecha_completa($fecha));


   $antigua = umask(0);


    if( !is_dir("/var/www/external/testigos/Jalisco/Ayotzinapa/".$sec."/portada/")){

      mkdir("/var/www/external/testigos/Jalisco/Ayotzinapa/".$sec."/portada",true,0777);
      chmod("/var/www/external/testigos/Jalisco/Ayotzinapa/".$sec."/portada",0777);
      umask($antigua);
    }

    $nombre = "/var/www/external/testigos/Jalisco/Ayotzinapa/".$sec."/portada/portada.pdf";

    if(is_dir("/var/www/external/testigos/Jalisco/Ayotzinapa/".$sec."/portada"))
    {
        $pdf->Output($nombre, 'F');

    }else{

        echo "Error echo echo echo  Escritura<br>".__DIR__;

    }

}


function mes($fecha){
  list($a,$m,$d) = explode("-", $fecha);
  return $m;
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

function sanear_string($url) {


//Rememplazamos caracteres especiales latinos

$find = array('?');

$repl = array('');

$url = str_replace ($find, $repl, $url);

//$url = ucfirst($url);
 /*
/ Eliminamos y Reemplazamos demás caracteres especiales

$find = array('/[^a-zA-Z0-9\-<>,.:;¿ÁÉÍÓÚáéíóúÑñ ]/', '/[\-]+/', '/<[^>]*>/');

$repl = array(' ','-','');

$url = preg_replace ($find, $repl, $url);
*/
return $url;

}
