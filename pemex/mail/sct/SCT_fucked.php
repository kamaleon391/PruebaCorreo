<?php
include_once 'Header.php';
require "/var/www/external/services/mail/conexion.php";
require "../../corrector/correctorOrtografico.php";
    

ResumenSCT();

function ResumenSCT()
{
  mysql_query("set names 'utf8'");
   $query="SELECT idEditorial, Periodico, Fecha, Titulo, Seccion, NumeroPagina, PaginaPDF,Texto, pdf,jpg, Estado, Pagina,Autor FROM
 (
 (SELECT '1' AS idEditorial,'Secretario' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(1) AS Pagina,'' as  Autor)
   UNION ALL
     (SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
           CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf', CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg', e.Nombre AS 'Estado',(2) AS Pagina,n.Autor
       FROM noticiasDia n, periodicos p, seccionesPeriodicos s, estados e
       WHERE(
         Texto like'%Gerardo Ruiz Esparza%' OR
         Texto like '%Ruiz Esparza Gerardo%' OR
         Texto like '%Ruiz Esparza%' OR

         Titulo like'%Gerardo Ruiz Esparza%' OR
         Titulo like '%Ruiz Esparza Gerardo%' OR
         Titulo like '%Ruiz Esparza%' OR

         Encabezado like'%Gerardo Ruiz Esparza%' OR
         Encabezado like '%Ruiz Esparza Gerardo%' OR
         Encabezado like '%Ruiz Esparza%' 
      )
      AND n.Periodico=p.idPeriodico AND p.Estado = e.idEstado 
      AND s.idSeccion = n.Seccion AND Fecha=CURDATE() AND n.Categoria<>80
      AND n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626)
      AND p.Estado=9 
      GROUP BY n.PaginaPeriodico, p.Nombre)
   UNION ALL
 (SELECT '2' AS idEditorial,'Subsecretarias' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(3) AS Pagina,'' as Autor)
   UNION ALL
     (SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF',n.Texto,
           CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg', e.Nombre AS 'Estado',(4) AS Pagina,n.Autor
       FROM noticiasDia n, periodicos p, seccionesPeriodicos s, estados e
       WHERE(
     Texto      like '% SCT %' OR
         Texto      like '%Subsecretaria de Comunicaciones%' OR
     Texto      like '%Subsecretaria de Transporte%' OR
     Texto    like '%Subsecretaria de Infraestructura%' OR
     Titulo     like '%Subsecretaria de Comunicaciones%' OR
     Titulo     like '%Subsecretaria de Transporte%' OR
     Titulo     like '%Subsecretaria de Infraestructura%' OR
     Encabezado like '%Subsecretaria de Comunicaciones%' OR
     Encabezado like '%Subsecretaria de Transporte%' OR
     Encabezado like '%Subsecretaria de Infraestructura%'
      )
      AND n.Periodico=p.idPeriodico AND p.Estado = e.idEstado 
      AND s.idSeccion = n.Seccion AND Fecha=CURDATE() AND n.Categoria<>80
      AND n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626)
      AND p.Estado=9
      GROUP BY n.PaginaPeriodico, Periodico)
   UNION ALL
 (SELECT '3' AS idEditorial,'Secretaria de Comunicaciones y Transportes' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(5) AS Pagina,'' as Autor)
   UNION ALL 
     (SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
           CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',e.Nombre AS 'Estado',(6) AS Pagina,n.Autor
       FROM noticiasDia n, periodicos p, seccionesPeriodicos s, estados e
       WHERE(
      Texto like '% SCT% ' OR
           Texto like '% Secretaria de Comunicaciones y Transportes %' OR
      Titulo like '% SCT% ' OR
           Titulo like '% Secretaria de Comunicaciones y Transportes %' OR
      Titulo like '% SCT% ' OR
           Encabezado like '% Secretaria de Comunicaciones y Transportes %'
           )
      AND n.Periodico=p.idPeriodico AND p.Estado = e.idEstado 
      AND s.idSeccion = n.Seccion  AND p.tipo=1 AND Fecha=CURDATE() AND n.Categoria<>80
      AND n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626)
      AND p.Estado=9
      GROUP BY n.PaginaPeriodico, Periodico Limit 0,40)

 )Derived
 GROUP BY Periodico,NumeroPagina
 Order by Pagina";

$queryColumnasPoliticas="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Categoria in(19) AND
    e.idEstado=p.Estado AND
    Fecha=CURDATE() 
  GROUP BY p.Nombre
  ORDER BY o.posicion";

$queryColumnasFinancieras="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    n.Categoria in(20) AND
    e.idEstado=p.Estado AND
    Fecha=CURDATE() 
  GROUP BY p.Nombre";

$queryCartones="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Categoria in(18) AND
    e.idEstado=p.Estado AND
    p.Estado = 9 AND
    Fecha=CURDATE() 
  GROUP BY p.Nombre
  ORDER BY o.posicion";


  $sql="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Categoria in(3) AND
    e.idEstado=p.Estado AND
    Fecha=CURDATE() 
  GROUP BY p.Nombre
  ORDER BY o.posicion";


    /*querys*/
    require "/var/www/external/services/mail/conexion.php";
    include_once 'Header.php';

    \PhpOffice\PhpWord\Settings::setCompatibility(false);


  // Para declarar un nuevo documento
     
    $PHPWord = new \PhpOffice\PhpWord\PhpWord();
    // Para crear seccion para escribir en ella
    $section = $PHPWord->addSection();
    // Formatos para los textos 

    $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'italic'=>false, 'size'=>16, ));
    $PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>100));

    //$PHPWord->addParagraphStyle('pStyle2', array('align'=>'center', 'spaceAfter'=>100,'fgColor'=>PHPWord_Style_Font::FGCOLOR_DARKYELLOW ));
    $PHPWord->addFontStyle('estiloTexto', array('bold'=>false, 'arial'=>true, 'size'=>10,));
    $PHPWord->addFontStyle('estiloHead', array('bold'=>true, 'arial'=>true, 'size'=>10, 'align'=>'left'));
    $PHPWord->addFontStyle('estiloLink', array('bold'=>true, 'italic'=>false, 'size'=>12, 'color'=>'blue'));

    $PHPWord->addFontStyle('estiloLink2', array('bold'=>true, 'arial'=>false, 'size'=>10, 'color'=>'blue'));
    $PHPWord->addFontStyle('estiloTitle', array('bold'=>true, 'arial'=>true, 'size'=>12 ));
    $PHPWord->addFontStyle('estiloTitle2', array('bold'=>true, 'align'=>'center', 'arial'=>true, 'size'=>20, 'color'=>'#8F2424'));
    $PHPWord->addFontStyle('estiloTitle3', array('bold'=>true, 'arial'=>true, 'size'=>12, 'color'=>'blue'));
    $PHPWord->addParagraphStyle('pJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0)); 
    
    $header=$section->addHeader();
    $footer = $section->addFooter();
        
    $fecha=Date('Y-m-d');
    
  // $section->addImage('img/logo.png' );
    
    $section->addTextBreak(1);
    $imageStyle = array('width'=>300, 'height'=>90, 'align'=>'center');
    $header->addImage('logo.png', $imageStyle);
    $header->addText('Resumen Ejecutivo'.'   '.mostrar_fecha_completa($fecha),'estiloHead');
    $footer->addPreserveText('Pagina {PAGE} de {NUMPAGES}.');
    
    $section->addText('8 COLUMNAS', 'estiloTitle2');
    $resp=  mysql_query($sql);
    while($row= mysql_fetch_array($resp))
    {
        $periodico=utf8_encode($row['Periodico']);
        $periodico=  ucwords($periodico);
        $titulito=strtoupper($row['Titulo']);
        $pdf=$row['pdf'];

        $titulito = correctorOrtografico($titulito);

        $titulito = convert_Mayus($titulito);
      
        $imageStyle2 = array('width'=>450, 'height'=>45, 'align'=>'center');

        if(is_file("/var/www/external/services/mail/sct/Word/".ucwords(strtolower($periodico)).".png"))
        {
          $section->addImage("Word/".ucwords(strtolower($periodico).".png"), $imageStyle2);
        }
     
        if($titulito!="")
        {
          $section->addLink('http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']), utf8_decode($titulito),'estiloTitle3', 'pStyle2');
        }
        else {
            $section->addLink('http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']), utf8_decode($titulito),'estiloTitle3', 'pStyle2');
        }
        $section->addTextBreak(1);
        
    }
    $section->addPageBreak();//PRIMERAS PLANAS
   
    
     $resultTitular =mysql_query($query);
     if($resultTitular)
     {
        while ($row1 = mysql_fetch_array($resultTitular))
        {
            $Periodico=$row1['Periodico'];
            $Fecha=$row1['Fecha'];
            $Titulo=correctorOrtografico(strtoupper($row1['Titulo']));
            $Seccion=$row1['Seccion'];
            $NumeroPagina=$row1['NumeroPagina'];
            $Texto=(string)$row1['Texto'];
            $pd=$row1['pdf'];
            $Estado=$row1['Estado'];
            
            $autor=$row1['Autor'];
                $autor=  ucwords(strtolower($autor));
                if ($autor==""){
                    $autor=$row1['Periodico'];
                }
                
            
            $Per = utf8_decode($Periodico);
              switch($Per)
              {
                case "El milenio Nacional":
                  $Per = "Milenio";
                    $autor="Milenio";
                break;

                case "El Reforma":
                  $Per = "Reforma";
                    $autor="Reforma";
                break;

                case "La Razon":
                  $Per = "La Razón";
                    $autor="La Razón";
                break;

                case "La Cronica":
                  $Per = "La Crónica";
                    $autor="La Crónica";
                break;
            
                case "el sol de mexico":
                  $Per = "El Sol de México";
                    $autor="El Sol de México";
                break;
              }
              
            $Texto = correctorOrtografico($Texto);
            $Titulo = convert_Mayus($Titulo);
            
          switch($Periodico)
          {
            case 'Secretario':
              $section->addTextBreak(2); 
              $section->addText('SECRETARIO', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Subsecretarias':
              $section->addTextBreak(2); 
              $section->addText('SUBSECRETARIAS', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Delegaciones':
              $section->addTextBreak(2); 
              $section->addText('DELEGACIONES', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Puertos':
              $section->addTextBreak(2); 
              $section->addText('PUERTOS', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Telecomunicaciones':
              $section->addTextBreak(2); 
              $section->addText('TELECOMUNICACIONES', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Servicio Postal':
              $section->addTextBreak(2); 
              $section->addText('SERVICIO POSTAL', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Tren Suburbano':
              $section->addTextBreak(2); 
              $section->addText('TREN SUBURBANO', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Transporte Publico Federal':
              $section->addTextBreak(2); 
              $section->addText('TRANSPORTE PUBLICO FEDERAL', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Carreteras y Autopistas':
              $section->addTextBreak(2); 
              $section->addText('CARRETERAS Y AUTOPISTAS', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'CAPUFE':
              $section->addTextBreak(2); 
              $section->addText('CAPUFE', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Transporte Ferroviario':
              $section->addTextBreak(2); 
              $section->addText('TRANSPORTE FERROVIARIO', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            case 'Varios':
              $section->addTextBreak(2); 
              $section->addText('VARIOS', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
            break;

            default:
              $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
              $section->addText(urls_amigables(wordlimit($Texto))."...",'estiloTexto','pStyle');
              $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');


              $file1=$pd;

              //$section->addLink('http://187.247.253.5/siscap.la/public/Periodicos/'.$file1, "\"".utf8_decode($Periodico)."\" ".(utf8_decode($Seccion)=="Error"?"":utf8_decode($Seccion))." ".$Fecha." Pag." .$NumeroPagina, 'estiloLink2','pStyle');
              $section->addLink('http://187.247.253.5/external/testigos/visor.php?p='.  base64_encode($Periodico)."&f=".  base64_encode($row1['Fecha'])."&pag=".  base64_encode($row1['PaginaPDF']), "\"".utf8_decode($Per)."\" ".(utf8_decode($Seccion)=="Error"?"":utf8_decode($Seccion))." ".$Fecha." Pag." .$NumeroPagina,'estiloLink2', 'pStyle2');
              $section->addTextBreak(1);            
            break;
          }
        }
      }

      //echo mysql_error();

$section->addPageBreak();
    $resultColumn=mysql_query($queryColumnasPoliticas);
    if($resultColumn)
    {
      $section->addText('Columnas Políticas', 'estiloTitle2', 'pStyle2');
      $section->addTextBreak(1);
      while ($col = mysql_fetch_array($resultColumn))
      {
         $idEditorial=$col['idEditorial'];
          $Periodico=$col['Periodico'];
          $Fecha=$col['Fecha'];
          $Titulo=strtoupper($col['Titulo']);
          $Seccion=$col['Seccion'];
          $NumeroPagina=$col['NumeroPagina'];
          $Texto=$col['Texto'];
          $pd=$col['pdf'];
          $Estado=$col['Estado'];

          $Titulo = correctorOrtografico($Titulo);
          $Texto = correctorOrtografico($Texto);

          $Titulo = convert_Mayus($Titulo);
      
          $autor=$col['Autor'];
                $autor=  ucwords(strtolower($autor));
                if ($autor==""){
                    $autor=$col['Periodico'];
                }
                
            
            $Per = utf8_decode($Periodico);
              switch($Per)
              {
                case "El milenio Nacional":
                  $Per = "Milenio";
                break;

                case "El Reforma":
                  $Per = "Reforma";
                break;

                case "La Razon":
                  $Per = "La Razón";
                break;

                case "La Cronica":
                  $Per = "La Crónica";
                break;
            
                case "el sol de mexico":
                  $Per = "El Sol de México";
                break;
              }

          $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
          $section->addText(urls_amigables(wordlimit($Texto))."...",'estiloTexto','pStyle');
          $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');

          $file1=$pd;

          $section->addLink('http://187.247.253.5/external/testigos/visor.php?p='.base64_encode($Periodico)."&f=".base64_encode($col['Fecha'])."&pag=".base64_encode($col['PaginaPDF']),  "\"".utf8_decode($Per)."\" ".(utf8_decode($Seccion)=="Error"?"":utf8_decode($Seccion))." ".$Fecha." Pag." .$NumeroPagina, 'estiloLink2','pStyle');
          $section->addTextBreak(1);  
      } 
    }
        
    $section->addPageBreak();   
        
    $resultFinan=mysql_query($queryColumnasFinancieras);
    if($resultFinan)
    {
      $section->addText('Columnas Financieras', 'estiloTitle2', 'pStyle2');
      $section->addTextBreak(1);
      while ($row12 = mysql_fetch_array($resultFinan))
      {
          $idEditorial=$row12['idEditorial'];
          $Periodico=$row12['Periodico'];
          $Fecha=$row12['Fecha'];
          $Titulo=strtoupper($row12['Titulo']);
          $Seccion=$row12['Seccion'];
          $NumeroPagina=$row12['NumeroPagina'];
          $Texto=$row12['Texto'];
          $pd=$row12['pdf'];
          $Estado=$row12['Estado'];

          $Titulo = correctorOrtografico($Titulo);
          $Texto = correctorOrtografico($Texto);

          $Titulo = convert_Mayus($Titulo);

          $autor=$row12['Autor'];
                $autor=  ucwords(strtolower($autor));
                if ($autor==""){
                    $autor=$row12['Periodico'];
                }
                
            
            $Per = utf8_decode($Periodico);
              switch($Per)
              {
                case "El milenio Nacional":
                  $Per = "Milenio";
                    $autor="Milenio";
                break;

                case "El Reforma":
                  $Per = "Reforma";
                    $autor="Reforma";
                break;

                case "La Razon":
                  $Per = "La Razón";
                    $autor="La Razón";
                break;

                case "La Cronica":
                  $Per = "La Crónica";
                    $autor="La Crónica";
                break;
            
                case "el sol de mexico":
                  $Per = "El Sol de México";
                    $autor="El Sol de México";
                break;
              }
     
          $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
          $section->addText(urls_amigables(wordlimit($Texto))."...",'estiloTexto','pStyle');
          $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');

          $file1=$pd;
          $section->addLink('http://187.247.253.5/external/testigos/visor.php?p='.base64_encode($Periodico)."&f=".base64_encode($row12['Fecha'])."&pag=".base64_encode($row12['PaginaPDF']), "\"".utf8_decode($Per)."\" ".(utf8_decode($Seccion)=="Error"?"":utf8_decode($Seccion))." ".$Fecha." Pag." .$NumeroPagina, 'estiloLink2','pStyle');
          $section->addTextBreak(1);       
      }
    }
        $section->addPageBreak(); 
    $imageStyle3 = array('width'=>420, 'height'=>500, 'align'=>'center');   
    $resultCarto=mysql_query($queryCartones);
    if($resultCarto)
    {
      $section->addText('Cartones', 'estiloTitle2', 'pStyle2');
      $section->addTextBreak(1);
    
      while ($row13 = mysql_fetch_array($resultCarto))
      {
         $idEditorial=$row13['idEditorial'];
          $Periodico=$row13['Periodico'];
          $Fecha=$row13['Fecha'];
          $Titulo=strtoupper($row13['Titulo']);
          $Seccion=$row13['Seccion'];
          $NumeroPagina=$row13['NumeroPagina'];
          $Texto=$row13['Texto'];
          $pd=$row13['pdf'];
          $jpg=$row13['jpg'];
          $Estado=$row13['Estado'];

          $Titulo = correctorOrtografico($Titulo);
          $Texto = correctorOrtografico($Texto);

          $Titulo = convert_Mayus($Titulo);

          $autor=$row13['Autor'];
                $autor=  ucwords(strtolower($autor));
                if ($autor==""){
                    $autor=$row13['Periodico'];
                }
                
            
            $Per = utf8_decode($Periodico);
              switch($Per)
              {
                case "El milenio Nacional":
                  $Per = "Milenio";
                    $autor="Milenio";
                break;

                case "El Reforma":
                  $Per = "Reforma";
                    $autor="Reforma";
                break;

                case "La Razon":
                  $Per = "La Razón";
                    $autor="La Razón";
                break;

                case "La Cronica":
                  $Per = "La Crónica";
                    $autor="La Crónica";
                break;
            
                case "el sol de mexico":
                  $Per = "El Sol de México";
                    $autor="El Sol de México";
                break;
              }
          
          $section->addPageBreak(); 
          $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle', 'pStyle2');
          $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');

          $file1=$pd;

          $section->addLink('http://187.247.253.5/external/testigos/visor.php?p='.  base64_encode($Periodico)."&f=".  base64_encode($row13['Fecha'])."&pag=".  base64_encode($row13['PaginaPDF']),  "\"".utf8_decode($Per)."\" ".(utf8_decode($Seccion)=="Error"?"":utf8_decode($Seccion))." ".$Fecha." Pag." .$NumeroPagina, 'estiloLink2','pStyle');
          //$section->addText('http://187.247.253.5/siscap.la/public'.$file1.'.jpg', 'estiloTitle', 'pStyle2');
          if(is_file("../../periodicos/".$jpg.".jpg"))
          {
            $path="../../periodicos/".$jpg.".jpg";
            $section->addImage(utf8_decode($path), $imageStyle3);
          }   
      }  
    }    

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007'); 
    try {
        if(date("H:i:s")<"05:10:00")
        {
          $objWriter->save("Avance_SCT.docx");
          chmod("Avance_SCT.docx", 0777);
        }
        else
        {
          $objWriter->save("Completo_SCT.docx");
          chmod("Completo_SCT.docx", 0777);
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

//correo();
    return $objWriter; 
}

function correo(){
   
require "/var/www/external/services/mail/PHPMailer/class.phpmailer.php";
            
       
  $mail = new PHPMailer();
  $mail->IsSMTP();
  //$mail->CharSet = 'UTF-8';
  $mail->Host     = "smtp.gacomunicacion.com";
  $mail->Port     = 587;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "tsl";
  $mail->Username = "gaimpresos@gacomunicacion.com";
  $mail->Password = "Gagdl1";
  $mail->From="gaimpresos@gacomunicacion.com";

  $mail->AddBCC("jesush@gacomunicacion.com");
  $mail->AddBCC("mariob@gacomunicacion.com");
  $mail->AddBCC("edgarh@gacomunicacion.com");
  $mail->AddBCC("ehb1703@me.com");

/*
  
  $mail->AddBCC("ehb1703@icloud.com");
  
  $mail->AddBCC("jhgacomunicacion@outlook.com");
  $mail->AddBCC("ricardom@gacomunicacion.com");
  $mail->AddBCC("juan.a@gacomunicacion.com");
  
*/

  $mail->FromName = utf8_decode("SCT");
   
  $mail->Subject  = "Documento Generado ".date("Y-m-d")." ".DATE('H:i:s');  
  $mail->WordWrap = 50;
   
  // Correo destino

  $mail->IsHTML(TRUE);

  if(!$mail->Send()) {
      echo "Error: " . $mail->ErrorInfo;
  } else {
      echo "Mensaje enviado";
  }
}

function muestra($pdf,$page)
{
    $pdf2=$pdf."[".$page."]";

    $path="/img.jpg";
    

    $im = new imagick($pdf2);
    $im->setCompression(Imagick::COMPRESSION_JPEG);
    $im->setCompressionQuality(70);
    $im->setImageFormat( "jpg" );
    $im->writeimage($path,true);
}

function wordlimit($string, $length = 70)
{
    $words = explode(' ', $string);
    if (count($words) > $length)
    {
            return implode(' ', array_slice($words, 0, $length));
    }
    else
    {
            return $string;
    }
}

function wordlimit2($string, $length = 35)
{
    $words = explode(' ', $string);
    if (count($words) > $length)
    {
            return implode(' ', array_slice($words, 0, $length));
    }
    else
    {
            return $string;
    }
}

function mostrar_fecha_completa($fecha)
{
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
         $dia_sem3='domingo'; 
       break; 
       
       case "1":   // Bloque 1 
         $dia_sem3='lunes'; 
       break; 
       
       case "2":   // Bloque 1 
         $dia_sem3='martes'; 
       break; 
   
       case "3":   // Bloque 1 
         $dia_sem3='miercoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='sabado'; 
       break; 
   
      default:   // Bloque 3 
    };
   
    switch($mes2) 
    { 
        case "1":   // Bloque 1 
            $mes3='enero'; 
        break; 
    
        case "2":   // Bloque 1 
            $mes3='febrero';
        break; 
    
        case "3":   // Bloque 1 
            $mes3='marzo';
        break; 
    
        case "4":   // Bloque 1 
            $mes3='abril'; 
        break;  
        
        case "5":   // Bloque 1 
            $mes3='mayo';
        break;   
        
        case "6":   // Bloque 1 
            $mes3='junio';    
        break; 
        
        case "7":   // Bloque 1 
            $mes3='julio';
        break; 
    
        case "8":   // Bloque 1 
            $mes3='agosto';
        break; 
    
        case "9":   // Bloque 1 
            $mes3='septiembre';
        break; 
    
        case "10":   // Bloque 1 
            $mes3='octubre';
        break; 
    
        case "11":   // Bloque 1 
            $mes3='noviembre';
        break;           
    
        case "12":   // Bloque 1 
            $mes3='diciembre';  
        break; 
    
        default:   // Bloque 3 
     break; 
  }; 
 
   
$fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;

return $fecha_texto;
};

function mostrar_mes($mes2)
{

     switch($mes2) 
    { 
        case "01":   // Bloque 1 
            $mes3='Enero'; 
        break; 
    
        case "02":   // Bloque 1 
            $mes3='Febrero';
        break; 
    
        case "03":   // Bloque 1 
            $mes3='Marzo';
        break; 
    
        case "04":   // Bloque 1 
            $mes3='Abril'; 
        break;  
        
        case "05":   // Bloque 1 
            $mes3='Mayo';
        break;   
        
        case "06":   // Bloque 1 
            $mes3='Junio';    
        break; 
        
        case "07":   // Bloque 1 
            $mes3='Julio';
        break; 
    
        case "08":   // Bloque 1 
            $mes3='Agosto';
        break; 
    
        case "09":   // Bloque 1 
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
   
   
return $mes3;
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

function sanear_string($string)
{

    $string = trim(utf8_decode($string));

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    /*$string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "."),
        '',
        $string
    );*/

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




function urls_amigables($url) {
 
 
/*Rememplazamos caracteres especiales latinos
 
$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ','');
 
$repl = array('a', 'e', 'i', 'o', 'u', 'n');
 
$url = str_replace ($find, $repl, $url);

$url = ucfirst($url);
 
/ Eliminamos y Reemplazamos demás caracteres especiales
*/
$find = array('/[^a-zA-Z0-9\-<>,.:;¿ÁÉÍÓÚáéíóúÑñ ]/', '/[\-]+/', '/<[^>]*>/');
 
$repl = array(' ','-','');
 
$url = preg_replace ($find, $repl, $url);

return $url;
 
}


function CorrigeOrtografica($cadena)
{
     session_start();  
      for($j=0;$j<=$_SESSION['contador'];$j++)
        {
         // "<br>".$j.$palabras1[$j]." - ".$palabras2[$j]."<br>";   
             $cadena=  str_ireplace($_SESSION['palabras1'][$j],$_SESSION['palabras2'][$j], $cadena);
        }

return $cadena;
}
  
function getRealIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $ip=substr($ip, 0, 2);
   
    
        if($ip==19)
        {
            $host="192.168.3.154";
        }else{
         $host="187.247.253.5";
        }
        
   return  $host;
 
}

/*

function correo($mensaje)
{
    
require 'PHPMailer/class.phpmailer.php';
            
     

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host     = "ssl://smtp.gmail.com";
$mail->Port     = 465;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gmail.com";
$mail->Password = "gaimpresos01";

$mail->AddBCC("julio.orquiz@gmail.com");
$mail->AddBCC("julio.navarro@admonitor.com.mx");
$mail->AddBCC("contenidos@admonitor.com.mx");
$mail->AddBCC("validacion@admonitor.com.mx");
$mail->AddBCC("job.cg@icloud.com");  
$mail->AddBCC("dan.padilla@admedios.com");
$mail->AddBCC("ehb1703@admedios.com");
$mail->AddBCC("editorial@admedios.com");

$mail->FromName = "DOCUMENTO DE WORD";
 
$mail->Subject  = "YA ESTA CREADO EL DOCUMENTO DE JALISCO DF";
$mail->WordWrap = 50;
 
// Correo destino

$mail->IsHTML(TRUE);
 
$mail->Body = $mensaje;
 
if(!$mail->Send()) {
    //echo "Error: " . $mail->ErrorInfo;
} else {
    //echo "Mensaje enviado";
}
            //
}
function correo2($mensaje)
{
    
require 'PHPMailer/class.phpmailer.php';
            
     

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host     = "ssl://smtp.gmail.com";
$mail->Port     = 465;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gmail.com";
$mail->Password = "gaimpresos01";

$mail->AddBCC("julio.orquiz@gmail.com");
$mail->AddBCC("julio.navarro@admonitor.com.mx");
$mail->AddBCC("contenidos@admonitor.com.mx");
$mail->AddBCC("validacion@admonitor.com.mx");
$mail->AddBCC("job.cg@icloud.com");  
$mail->AddBCC("dan.padilla@admedios.com");
$mail->AddBCC("ehb1703@admedios.com");
$mail->AddBCC("editorial@admedios.com");

$mail->FromName = "DOCUMENTO DE WORD";
 
$mail->Subject  = "YA ESTA CREADO EL DOCUMENTO DE SEGURO POPULAR JALISCO";
$mail->WordWrap = 50;
 
// Correo destino

$mail->IsHTML(TRUE);
 
$mail->Body = $mensaje;
 
if(!$mail->Send()) {
    //echo "Error: " . $mail->ErrorInfo;
} else {
    //echo "Mensaje enviado";
}
            //
}
*/
?>
