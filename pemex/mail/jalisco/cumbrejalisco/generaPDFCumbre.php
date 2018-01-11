<?php

ignore_user_abort(true);
set_time_limit(0); 


    include "/var/www/external/services/mail/conexion.php";


  $fecha = date('Y-m-d');

  /*
  portada($fecha, 'jalisco');  
  portada($fecha, 'df');
  */

    $queryJalisco = "
    SELECT 
        n.Fecha,
        p.Nombre AS 'periodico',
        s.seccion AS 'Seccion',
        c.Categoria,
        n.Autor,
        n.Titulo,
        n.Encabezado,
        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',
                p.Nombre,
                '/',
                n.Fecha,
                '/',
                NumeroPagina) AS 'pdf'
    FROM
        noticiasDia n
            JOIN
        periodicos p ON p.idPeriodico = n.Periodico
            AND n.Fecha = CURDATE()
            AND n.Activo = 1
            AND n.Categoria NOT IN (80 , 98)
            JOIN
        ordenGeneraljalisco o ON n.Periodico = o.periodico
            JOIN
        seccionesPeriodicos s ON s.idSeccion = n.Seccion
            JOIN
        categoriasPeriodicos c ON c.idCategoria = n.Categoria
            JOIN
        estados e ON p.Estado = e.idEstado
    WHERE
        (Texto LIKE '%cumbre de negocios jalisco%'
            OR Texto LIKE '%Cumbre de Negocios%'
            OR Texto LIKE '%Cumbre Inversiones%'
            OR Titulo LIKE '%cumbre de negocios jalisco%'
            OR Titulo LIKE '%Cumbre de Negocios%'
            OR Titulo LIKE '%Cumbre Inversiones%'
            OR Encabezado LIKE '%cumbre de negocios jalisco%'
            OR Encabezado LIKE '%Cumbre de Negocios%'
            OR Encabezado LIKE '%Cumbre Inversiones%'
            OR PieFoto LIKE '%cumbre de negocios jalisco%'
            OR PieFoto LIKE '%Cumbre de Negocios%'
            OR PieFoto LIKE '%Cumbre Inversiones%'
            OR Autor LIKE '%cumbre de negocios jalisco%'
            OR Autor LIKE '%Cumbre de Negocios%'
            OR Autor LIKE '%Cumbre Inversiones%')
    GROUP BY 3 , n.PaginaPeriodico
    ORDER BY n.Fecha , p.Estado , p.String_Name
    ";

    $queryDF = "
    SELECT 
        n.Fecha,
        p.Nombre AS 'periodico',
        s.seccion AS 'Seccion',
        c.Categoria,
        n.Autor,
        n.Titulo,
        n.Encabezado,
        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',
                p.Nombre,
                '/',
                n.Fecha,
                '/',
                NumeroPagina) AS 'pdf'
    FROM
        noticiasDia n
            JOIN
        periodicos p ON p.idPeriodico = n.Periodico
            AND n.Fecha = CURDATE()
            AND n.Activo = 1
            AND n.Categoria NOT IN (80 , 98)
            JOIN
        ordenGeneral o ON n.Periodico = o.periodico
            JOIN
        seccionesPeriodicos s ON s.idSeccion = n.Seccion
            JOIN
        categoriasPeriodicos c ON c.idCategoria = n.Categoria
            JOIN
        estados e ON p.Estado = e.idEstado
    WHERE
        (Texto LIKE '%cumbre de negocios jalisco%'
            OR Texto LIKE '%Cumbre de Negocios%'
            OR Texto LIKE '%Cumbre Inversiones%'
            OR Titulo LIKE '%cumbre de negocios jalisco%'
            OR Titulo LIKE '%Cumbre de Negocios%'
            OR Titulo LIKE '%Cumbre Inversiones%'
            OR Encabezado LIKE '%cumbre de negocios jalisco%'
            OR Encabezado LIKE '%Cumbre de Negocios%'
            OR Encabezado LIKE '%Cumbre Inversiones%'
            OR PieFoto LIKE '%cumbre de negocios jalisco%'
            OR PieFoto LIKE '%Cumbre de Negocios%'
            OR PieFoto LIKE '%Cumbre Inversiones%'
            OR Autor LIKE '%cumbre de negocios jalisco%'
            OR Autor LIKE '%Cumbre de Negocios%'
            OR Autor LIKE '%Cumbre Inversiones%')
    GROUP BY 3 , n.PaginaPeriodico
    ORDER BY n.Fecha , p.Estado , p.String_Name
    ";

    $queryEstados = "
    SELECT 
        n.Fecha,
        p.Nombre AS 'periodico',
        s.seccion AS 'Seccion',
        c.Categoria,
        n.Autor,
        n.Titulo,
        n.Encabezado,
        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',
                p.Nombre,
                '/',
                n.Fecha,
                '/',
                NumeroPagina) AS 'pdf'
    FROM
        noticiasDia n
            JOIN
        periodicos p ON p.idPeriodico = n.Periodico
            AND n.Fecha = CURDATE()
            AND n.Activo = 1
            AND n.Categoria NOT IN (80 , 98)
            JOIN
        seccionesPeriodicos s ON s.idSeccion = n.Seccion
            JOIN
        categoriasPeriodicos c ON c.idCategoria = n.Categoria
            JOIN
        estados e ON p.Estado = e.idEstado AND p.Estado NOT IN (9, 14)
    WHERE
        (Texto LIKE '%cumbre de negocios jalisco%'
            OR Texto LIKE '%Cumbre de Negocios%'
            OR Texto LIKE '%Cumbre Inversiones%'
            OR Titulo LIKE '%cumbre de negocios jalisco%'
            OR Titulo LIKE '%Cumbre de Negocios%'
            OR Titulo LIKE '%Cumbre Inversiones%'
            OR Encabezado LIKE '%cumbre de negocios jalisco%'
            OR Encabezado LIKE '%Cumbre de Negocios%'
            OR Encabezado LIKE '%Cumbre Inversiones%'
            OR PieFoto LIKE '%cumbre de negocios jalisco%'
            OR PieFoto LIKE '%Cumbre de Negocios%'
            OR PieFoto LIKE '%Cumbre Inversiones%'
            OR Autor LIKE '%cumbre de negocios jalisco%'
            OR Autor LIKE '%Cumbre de Negocios%'
            OR Autor LIKE '%Cumbre Inversiones%')
    GROUP BY 3 , n.PaginaPeriodico
    ORDER BY n.Fecha , p.Estado , p.String_Name
    ";

  portada($fecha, "Jalisco");
  creaPDF( $queryJalisco , $fecha, "Jalisco");

  portada($fecha, "DF");
  creaPDF( $queryDF , $fecha, "DF");

  portada($fecha, "Estados");
  creaPDF( $queryEstados, $fecha, "Estados");
      
function creaPDF( $query , $fecha, $tipo){

  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
   
  $pdf = new FPDI('P','mm','legal');

  $fechaCompleta = mostrar_fecha_completa( $fecha );
        
  //CODIGO PARA LA PORTADA
  /*
  $pdf->addPage();
  $pdf->SetFillColor(245,245,245);
  $pdf->Rect(0, 131, 250, 40, 'F');

  $pdf->setTextColor();
  $pdf->SetFont("arial", "B", 30);
  $pdf->Text(10,156,strtoupper($lugar));
  $pdf->SetFont("arial", "B", 13);
  $pdf->setTextColor(255,255,255);
  $pdf->Text(10,23,"test");

  $pdf->Image('/var/www/external/services/mail/jalisco/Logo.jpg',5,90,100); 

  $pdf->SetFont("arial", "B",15);
  $pdf->setTextColor();
  $pdf->Text(120,177,$fechaCompleta);   
  */    
    //$portada = '/var/www/external/testigos/Jalisco/portada.pdf';
  
    $pdfs = array();
    $pdfs[] = "/var/www/external/testigos/Jalisco/CumbreJalisco/portada.pdf";

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
        if( !empty($pdfs) ){

          $pdf->setFiles( $pdfs );  
          $pdf->concat();

          $nombre="/var/www/external/testigos/Jalisco/CumbreJalisco/".$tipo."/Reporte Cumbre Jalisco - ".DATE('Y-m-d').".pdf";
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

  $pdf->Image('/var/www/external/services/mail/jalisco/Logo.jpg',5,90,100); 
  $pdf->SetFont("arial", "B",15);
  $pdf->setTextColor();
  $pdf->Text(120,177,mostrar_fecha_completa($fecha));   
         
 
   $antigua = umask(0);


/*
    if( !is_dir("/var/www/external/testigos/Jalisco/CumbreJalisco/".$sec."/portada/")){
    
      mkdir("/var/www/external/testigos/Jalisco/CumbreJalisco/".$sec."/portada",true,0777);
      chmod("/var/www/external/testigos/Jalisco/CumbreJalisco/".$sec."/portada",0777);
      umask($antigua);
    }
*/

    $nombre = "/var/www/external/testigos/Jalisco/CumbreJalisco/portada.pdf";
    $pdf->Output($nombre, 'F');

/*
    if(is_dir("/var/www/external/testigos/Jalisco/CumbreJalisco/".$sec."/portada"))
    {
        $pdf->Output($nombre, 'F');

    }else{

        echo "Error echo echo echo  Escritura<br>".__DIR__;

    }    
    */

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
