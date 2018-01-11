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
     (SELECT DISTINCT(n.idEditorial), 
	    p.Nombre AS 'Periodico',
		n.Fecha,
		n.Titulo,
		s.seccion AS 'Seccion',
		n.PaginaPeriodico AS 'NumeroPagina',
		n.NumeroPagina as 'PaginaPDF',
		n.Texto,
		CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
		CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
		e.Nombre AS 'Estado',
		(2) AS Pagina,
		n.Autor
FROM 
		noticiasDia n,
		ordenGeneral o,
		periodicos p,
		seccionesPeriodicos s,
		estados e
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
      ) AND 
		n.Periodico=p.idPeriodico AND 
		n.Periodico=o.periodico AND 
		p.Estado = e.idEstado AND 
		s.idSeccion = n.Seccion AND 
		Fecha=CURDATE() AND 
		n.Categoria<>80 AND 
		n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
		p.Estado=9 AND 
		n.Activo=1
ORDER BY o.posicion)
   UNION ALL
 (SELECT '2' AS idEditorial,'Secretaria de Comunicaciones y Transportes' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(2) AS Pagina,'' as Autor)
   UNION ALL 
     (SELECT
DISTINCT(n.idEditorial),
p.Nombre AS 'Periodico',
n.Fecha,
n.Titulo,
s.seccion AS 'Seccion',
n.PaginaPeriodico AS 'NumeroPagina',
n.NumeroPagina as 'PaginaPDF',
n.Texto,
CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
e.Nombre AS 'Estado',
(6) AS Pagina,
n.Autor
FROM 
noticiasDia n,
ordenGeneral o,
periodicos p,
seccionesPeriodicos s,
estados e
WHERE(
		Texto like '% SCT % ' OR
		Texto like '% Secretaria de Comunicaciones y Transportes %' OR
		Titulo like '% SCT % ' OR
		Titulo like '% Secretaria de Comunicaciones y Transportes %' OR
		Encabezado like '% SCT % ' OR
	    Encabezado like '% Secretaria de Comunicaciones y Transportes %'
      )AND 
n.Periodico=p.idPeriodico AND 
n.Periodico=o.periodico AND 
p.Estado = e.idEstado AND
s.idSeccion = n.Seccion AND 
p.tipo=1 AND 
Fecha=CURDATE() AND 
n.Categoria<>80 AND
n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND 
p.Estado=9 AND
n.Activo=1
)
	UNION ALL
 (SELECT '3' AS idEditorial,'Comunicaciones' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(3) AS Pagina,'' as Autor)
   UNION ALL 
     (SELECT 
	DISTINCT(n.idEditorial),
	p.Nombre AS 'Periodico',
	n.Fecha,
	n.Titulo,
	s.seccion AS 'Seccion',
	n.PaginaPeriodico AS 'NumeroPagina',
	n.NumeroPagina as 'PaginaPDF',
	n.Texto,
	CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
	CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
	e.Nombre AS 'Estado',
	(4) AS Pagina,
	n.Autor
FROM 
	noticiasDia n,
	ordenGeneral o,
	periodicos p, 
	seccionesPeriodicos s, 
	estados e
 WHERE
	(
		 Texto      like '%Subsecretaria de Comunicaciones%' OR
		 Texto      like '%Subsecretario de comunicaciones%' OR
		 Texto      like '%jose ignacio peralta sanchez%' OR
		 Texto      like '%jose ignacio peralta%' OR
		 Texto      like '%jose peralta sanchez%' OR
		 Texto      like '%peralta sanchez%' OR
		 Texto      like '%Reforma de telecomunicaciones%' OR
		 Texto      like '%leyes de telecomunicaciones%' OR
		 Texto      like '%legislacion secundaria en telecomunicaciones%' OR
		 Texto      like '% IFT %' OR
		 Texto      like '%Instituto federal de telecomunicaciones%' OR
		 Texto      like '%Telecom%' OR
		 Texto      like '%Comision federal de competencia economica%' OR
		 Texto      like '%Telmex%'  AND (Texto not like '%camioneta%') OR
		 Texto      like '%televisa%' OR
		 Texto      like '%Tv Azteca%' OR
		 Texto      like '%alestra%' OR
		 Texto      like '%America Movil%' OR
		 Texto      like '%Television Digital Terrestre%' OR
		 Texto      like '% TDT %' OR
		 Texto      like '%sepomex%' OR

		 Titulo      like '%Subsecretaria de Comunicaciones%' OR
		 Titulo      like '%Subsecretario de comunicaciones%' OR
		 Titulo      like '%jose ignacio peralta sanchez%' OR
		 Titulo      like '%jose ignacio peralta%' OR
		 Titulo      like '%jose peralta sanchez%' OR
		 Titulo      like '%peralta sanchez%' OR
		 Titulo      like '%Reforma de telecomunicaciones%' OR
		 Titulo      like '%leyes de telecomunicaciones%' OR
		 Titulo      like '%legislacion secundaria en telecomunicaciones%' OR
		 Titulo      like '% IFT %' OR
		 Titulo      like '%Instituto federal de telecomunicaciones%' OR
		 Titulo      like '%Telecom%' OR
		 Titulo      like '%Comision federal de competencia econmica%' OR
		 Titulo      like '%Telmex%'   AND (Titulo not like '%camioneta%') OR
		 Titulo      like '%televisa%' OR
		 Titulo      like '%Tv Azteca%' OR
		 Titulo      like '%alestra%' OR
		 Titulo      like '%America Movil%' OR
		 Titulo      like '%Telmex%' OR
		 Titulo      like '%Television Digital Terrestre%' OR
		 Titulo      like '% TDT %' OR
		 Titulo      like '%sepomex%' OR

		 Encabezado      like '%Subsecretaria de Comunicaciones%' OR
		 Encabezado      like '%Subsecretario de comunicaciones%' OR
		 Encabezado      like '%jose ignacio peralta sanchez%' OR
		 Encabezado      like '%jose ignacio peralta%' OR
		 Encabezado      like '%jose peralta sanchez%' OR
		 Encabezado      like '%peralta sanchez%' OR
		 Encabezado      like '%Reforma de telecomunicaciones%' OR
		 Encabezado      like '%leyes de telecomunicaciones%' OR
		 Encabezado      like '%legislacion secundaria en telecomunicaciones%' OR
		 Encabezado      like '% IFT %' OR
		 Encabezado      like '%Instituto federal de telecomunicaciones%' OR
		 Encabezado      like '%Telecom%' OR
		 Encabezado      like '%Comision federal de competencia econmica%' OR
		 Encabezado      like '%Telmex%'   AND (Encabezado not like '%camioneta%') OR
		 Encabezado      like '%televisa%' OR
		 Encabezado      like '%Tv Azteca%' OR
		 Encabezado      like '%alestra%' OR
		 Encabezado      like '%America Movil%' OR
		 Encabezado      like '%Telmex%' OR
		 Encabezado      like '%Television Digital Terrestre%' OR
		 Encabezado      like '% TDT %' OR
		 Encabezado      like '%sepomex%'
      )AND 
	n.Periodico=p.idPeriodico AND 
	n.Periodico=o.periodico AND 
	p.Estado = e.idEstado AND 
	s.idSeccion = n.Seccion AND
	Fecha=CURDATE() AND 
	n.Categoria<>80 AND 
	n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND
	p.Estado=9 AND
	n.Activo=1
ORDER BY o.posicion)
	UNION ALL
 (SELECT '4' AS idEditorial,'Transporte' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(4) AS Pagina,'' as Autor)
   UNION ALL 
     (SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF',n.Texto,
           CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg', e.Nombre AS 'Estado',(4) AS Pagina,n.Autor
       FROM noticiasDia n, ordenGeneral o,periodicos p, seccionesPeriodicos s, estados e
       WHERE(
	   Texto      like '%Subsecretaria de Transportes%' OR
	   Texto      like '%Yuriria Mascot Perez%' OR	 
	   Texto      like '%Yuriria Mascot%' OR	 
	   Texto      like '%Mascot Perez%' OR
	   Texto      like '% aeropuerto %' OR
	   Texto      like '% autotransporte %' OR
	   Texto      like '% transporte de carga %' OR	 
	   Texto      like '% transporte de pasajeros %' OR
	   Texto      like '% tren %' OR	 	
	   Texto      like '% metro de la ciudad de mexico %' OR 
	   Texto      like '% tren ligero %' OR
	   Texto      like '% Linea 3 de Guadalajara %' OR
	   Texto      like '% Tren suburbano de buenavista %' OR
	   Texto      like '% teleferico %' OR
	   Texto      like '% administracion portuaria integral%' OR
	   Texto      like '% administracion portuaria%' OR
	   Texto      like '% Puerto de acapulco%' OR
	   Texto      like '% Puerto de ensenada%' OR
	   Texto      like '% Puerto de guaymas%' OR
	   Texto      like '% Puerto de topolobampo%' OR
	   Texto      like '% Puerto de mazatlan %' OR
	   Texto      like '% Puerto vallarta %' OR
	   Texto      like '% Puerto de manzanillo %' OR
	   Texto      like '% Puerto de lazaro cardenas %' OR
	   Texto      like '% Puerto de salina cruz %' OR
	   Texto      like '% Puerto de madero chiapas %' OR
	   Texto      like '% Puerto de ciudad del carmen %' OR
	   Texto      like '% Puerto de altamira %' OR
	   Texto      like '% Puerto de tampico %' OR
	   Texto      like '% Puerto de tuxpan %' OR
	   Texto      like '% Puerto de veracruz %' OR
	   Texto      like '% Puerto de coatzacoalcos %' OR
	   Texto      like '% Puerto dos bocas %' OR
	   Texto      like '% Puerto progreso %' OR
	   Texto      like '% Puerto de altura %' OR
	   Texto      like '% Puerto de cabotaje %' OR
	   Texto      like '% AICM %' OR

	   Titulo      like '%Subsecretaria de Transportes%' OR
	   Titulo      like '%Yuriria Mascot Perez%' OR	 
	   Titulo      like '%Yuriria Mascot%' OR	 
	   Titulo      like '%Mascot Perez%' OR
	   Titulo      like '% aeropuerto%' OR
	   Titulo      like '% autotransporte %' OR
	   Titulo      like '% transporte de carga %' OR	 
	   Titulo      like '% transporte de pasajeros %' OR
	   Titulo      like '% tren %' OR	 	
	   Titulo      like '% metro de la ciudad de mexico %' OR 
	   Titulo      like '% tren ligero %' OR
	   Titulo      like '% Linea 3 de Guadalajara %' OR
	   Titulo      like '% Tren suburbano de buenavista %' OR
	   Titulo      like '% teleferico %' OR
	   Titulo      like '% administracion portuaria integral%' OR
	   Titulo      like '%administracion portuaria%' OR
	   Titulo      like '%Puerto de acapulco%' OR
	   Titulo      like '%Puerto de ensenada%' OR
	   Titulo      like '%Puerto de guaymas%' OR
	   Titulo      like '%Puerto de topolobampo%' OR
	   Titulo      like '%Puerto de mazatlan%' OR
	   Titulo      like '%Puerto vallarta%' OR
	   Titulo      like '%Puerto de manzanillo%' OR
	   Titulo      like '%Puerto de lazaro cardenas%' OR
	   Titulo      like '%Puerto de salina cruz%' OR
	   Titulo      like '%Puerto de madero chiapas%' OR
	   Titulo      like '%Puerto de ciudad del carmen%' OR
	   Titulo      like '%Puerto de altamira%' OR
	   Titulo      like '%Puerto de tampico%' OR
	   Titulo      like '%Puerto de tuxpan%' OR
	   Titulo      like '%Puerto de veracruz%' OR
	   Titulo      like '%Puerto de coatzacoalcos%' OR
	   Titulo      like '%Puerto dos bocas%' OR
	   Titulo      like '%Puerto progreso%' OR
	   Titulo      like '%Puerto de altura%' OR
	   Titulo      like '%Puerto de cabotaje%' OR
	   Titulo      like '% AICM %' OR

	   Encabezado      like '%Subsecretaria de Transportes%' OR
	   Encabezado      like '%Yuriria Mascot Perez%' OR	 
	   Encabezado      like '%Yuriria Mascot%' OR	 
	   Encabezado      like '%Mascot Perez%' OR
	   Encabezado      like '% aeropuerto%' OR
	   Encabezado      like '% autotransporte %' OR
	   Encabezado      like '% transporte de carga %' OR	 
	   Encabezado      like '% transporte de pasajeros %' OR
	   Encabezado      like '% tren %' OR	 	
	   Encabezado      like '% metro de la ciudad de mexico %' OR 
	   Encabezado      like '% tren liger o%' OR
	   Encabezado      like '% Linea 3 de Guadalajara %' OR
	   Encabezado      like '% Tren suburbano de buenavista %' OR
	   Encabezado      like '% teleferico %' OR
	   Encabezado      like '%administracion portuaria integral%' OR
	   Encabezado      like '%administracion portuaria%' OR
	   Encabezado      like '%Puerto de acapulco%' OR
	   Encabezado      like '%Puerto de ensenada%' OR
	   Encabezado      like '%Puerto de guaymas%' OR
	   Encabezado      like '%Puerto de topolobampo%' OR
	   Encabezado      like '%Puerto de mazatlan%' OR
	   Encabezado      like '%Puerto vallarta%' OR
	   Encabezado      like '%Puerto de manzanillo%' OR
	   Encabezado      like '%Puerto de lazaro cardenas%' OR
	   Encabezado      like '%Puerto de salina cruz%' OR
	   Encabezado      like '%Puerto de madero chiapas%' OR
	   Encabezado      like '%Puerto de ciudad del carmen%' OR
	   Encabezado      like '%Puerto de altamira%' OR
	   Encabezado      like '%Puerto de tampico%' OR
	   Encabezado      like '%Puerto de tuxpan%' OR
	   Encabezado      like '%Puerto de veracruz%' OR
	   Encabezado      like '%Puerto de coatzacoalcos%' OR
	   Encabezado      like '%Puerto dos bocas%' OR
	   Encabezado      like '%Puerto progreso%' OR
	   Encabezado      like '%Puerto de altura%' OR
	   Encabezado      like '%Puerto de cabotaje%' OR
	   Encabezado      like '% AICM %'
      )
      AND n.Periodico=p.idPeriodico AND n.Periodico=o.periodico AND p.Estado = e.idEstado 
      AND s.idSeccion = n.Seccion AND Fecha=CURDATE() AND n.Categoria<>80
      AND n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626,436)
      AND p.Estado=9 AND n.Activo=1
	  ORDER BY o.posicion
	  )
	UNION ALL
 (SELECT '5' AS idEditorial,'Infraestructura' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(5) AS Pagina,'' as Autor)
   UNION ALL 
     (SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF',n.Texto,
           CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg', e.Nombre AS 'Estado',(4) AS Pagina,n.Autor
       FROM noticiasDia n, periodicos p, seccionesPeriodicos s, estados e
       WHERE(
	   Texto      like '%Subsecretaria de infraestructura%' OR
	   Texto      like '%Raul Murrieta cummings%' OR
	   Texto      like '%Raul Murrieta%' OR
	   Texto      like '%Murrieta cummings%' OR
	   Texto      like '%Carretera%' OR
	   Texto      like '%Autopista%' OR
	   Texto      like '%Plan Nacional de Infraestructura%' OR
	   Texto      like '%capufe%' OR
	   Texto      like '%caminos y puentes federales%' OR
	   Texto      like '%Plan Nuevo Guerrero%' OR
	   Texto      like '%camino rural%' OR

	   Titulo      like '%Subsecretaria de infraestructura%' OR
	   Titulo      like '%Raul Murrieta cummings%' OR
	   Titulo      like '%Raul Murrieta%' OR
	   Titulo      like '%Murrieta cummings%' OR
	   Titulo      like '%Carretera%' OR
	   Titulo      like '%Autopista%' OR
	   Titulo      like '%Plan Nacional de Infraestructura%' OR
	   Titulo      like '%capufe%' OR
	   Titulo      like '%caminos y puentes federales%' OR
	   Titulo      like '%Plan Nuevo Guerrero%' OR
	   Titulo      like '%camino rural%' OR

	   Encabezado      like '%Subsecretaria de infraestructura%' OR
	   Encabezado      like '%Raul Murrieta cummings%' OR
	   Encabezado      like '%Raul Murrieta%' OR
	   Encabezado      like '%Murrieta cummings%' OR
	   Encabezado      like '%Carretera%' OR
	   Encabezado      like '%Autopista%' OR
	   Encabezado      like '%Plan Nacional de Infraestructura%' OR
	   Encabezado      like '%capufe%' OR
	   Encabezado      like '%caminos y puentes federales%' OR
	   Encabezado      like '%Plan Nuevo Guerrero%' OR
	   Encabezado      like '%camino rural%'

      )
      AND n.Periodico=p.idPeriodico AND p.Estado = e.idEstado 
      AND s.idSeccion = n.Seccion AND Fecha=CURDATE() AND n.Categoria<>80
      AND n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626)
      AND p.Estado=9 AND
	  p.idPeriodico not in (121,149,244,315) AND n.Activo=1
	  )
 )Derived
 Order by Pagina";

$queryColumnasPoliticas="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
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

$queryColumnasFinancieras="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    n.Categoria in(20) AND
    e.idEstado=p.Estado AND
    n.Activo = 1 AND
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
    n.Activo = 1 AND
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
    n.Activo = 1 AND
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
    $PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>50));

    //$PHPWord->addParagraphStyle('pStyle2', array('align'=>'center', 'spaceAfter'=>100,'fgColor'=>PHPWord_Style_Font::FGCOLOR_DARKYELLOW ));
    $PHPWord->addFontStyle('estiloTexto', array('bold'=>false, 'arial'=>true, 'size'=>10,));
    $PHPWord->addFontStyle('estiloHead', array('bold'=>true, 'arial'=>true, 'size'=>10, 'align'=>'left'));
    $PHPWord->addFontStyle('estiloLink', array('bold'=>true, 'italic'=>false, 'size'=>12, 'color'=>'blue'));

    $PHPWord->addFontStyle('estiloLink2', array('bold'=>true, 'arial'=>false, 'size'=>10, 'color'=>'blue'));
    $PHPWord->addFontStyle('estiloTitle', array('bold'=>true, 'arial'=>true, 'size'=>11 ));
    $PHPWord->addFontStyle('estiloTitle2', array('bold'=>true, 'align'=>'center', 'arial'=>true, 'size'=>20, 'color'=>'#8F2424'));
    $PHPWord->addFontStyle('estiloTitle3', array('bold'=>true, 'arial'=>true, 'size'=>12, 'color'=>'blue'));//Formato para links Primeras Planas
    $PHPWord->addParagraphStyle('pJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0)); 
    
    $header=$section->addHeader();
    $footer = $section->addFooter();
        
    $fecha=Date('Y-m-d');
    $personaje=0;//Indicador de personaje construccion del documento
    //0=> Ruiz Esparza
    //1=> SCT 
    //2=>Comunicaciones
    //3=>Transporte
    //4=>Infraestructura
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
        $imageStyle2 = array('width'=>450, 'height'=>35, 'align'=>'center');

        if(is_file("/var/www/external/services/mail/sct/Word/".ucwords(strtolower($periodico)).".png"))
        {
          $section->addImage("Word/".ucwords(strtolower($periodico).".png"),$imageStyle2);
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
              $personaje=0;
            break;

            case 'Secretaria de Comunicaciones y Transportes':
              $section->addTextBreak(2); 
              $section->addText('SECRETARIA DE COMUNICACIONES Y TRANSPORTES', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=1;
            break;
            
            case 'Comunicaciones':
              $section->addTextBreak(2); 
              $section->addText('COMUNICACIONES', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=2;
            break;
        
            case 'Transporte':
              $section->addTextBreak(2); 
              $section->addText('TRANSPORTE', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=3;
            break;
        
            case 'Infraestructura':
              $section->addTextBreak(2); 
              $section->addText('INFRAESTRUCTURA', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=4;
            break;
            
            default:
                 switch ($personaje)
                {
                    case 0:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit(EncuentraArreglo($Texto,Array('Gerardo Ruiz Esparza','Ruiz Esparza')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 1:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit(EncuentraArreglo($Texto,Array('Secretaria de Comunicaciones y Transportes','SCT')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 2:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit(EncuentraArreglo($Texto,Array('telecomunicaciones',
                                                                                                'Subsecretaria de Comunicaciones',
                                                                                                'Subsecretario de comunicaciones',
                                                                                                'jose ignacio peralta sanchez',
                                                                                                'jose ignacio peralta',
                                                                                                'jose peralta sanchez',
                                                                                                'peralta sanchez',
                                                                                                'Reforma de telecomunicaciones',
                                                                                                'leyes de telecomunicaciones',
                                                                                                'legislacion secundaria en telecomunicaciones',
                                                                                                'IFT',
                                                                                                'Instituto federal de telecomunicaciones',
                                                                                                'Telecom',
                                                                                                'Comision federal de competencia econmica',
                                                                                                'Telmex',
                                                                                                'televisa',
                                                                                                'Tv Azteca',
                                                                                                'alestra',
                                                                                                'America Movil',
                                                                                                'Television Digital Terrestre',
                                                                                                'TDT',
                                                                                                'sepomex')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 3:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit(EncuentraArreglo($Texto,Array('MéxicoQuerétaro',
                                                                                                'Transporte',
                                                                                                'Subsecretaria de Transportes',
                                                                                                'Yuriria Mascot Perez',
                                                                                                'Yuriria Mascot',
                                                                                                'Mascot Perez',
                                                                                                'Aeropuerto',
                                                                                                'aeropuerto',
                                                                                                'autotransporte',
                                                                                                'transporte de carga',
                                                                                                'transporte de pasajeros',
                                                                                                ' tren ',
                                                                                                'metro de la ciudad de mexico',
                                                                                                'tren ligero',
                                                                                                'Linea 3 de Guadalajara',
                                                                                                'Tren suburbano de buenavista',
                                                                                                'teleferico',
                                                                                                'administracion portuaria integral',
                                                                                                'administracion portuaria',
                                                                                                'Puerto de acapulco',
                                                                                                'Puerto de ensenada',
                                                                                                'Puerto de guaymas',
                                                                                                'Puerto de topolobampo',
                                                                                                'Puerto de mazatlan',
                                                                                                'Puerto vallarta',
                                                                                                'Puerto de manzanillo',
                                                                                                'Puerto de lazaro cardenas',
                                                                                                'Puerto de salina cruz',
                                                                                                'Puerto de madero chiapas',
                                                                                                'Puerto de ciudad del carmen',
                                                                                                'Puerto de altamira',
                                                                                                'Puerto de tampico',
                                                                                                'Puerto de tuxpan',
                                                                                                'Puerto de veracruz',
                                                                                                'Puerto de coatzacoalcos',
                                                                                                'Puerto dos bocas',
                                                                                                'Puerto progreso',
                                                                                                'Puerto de altura',
                                                                                                'Puerto de cabotaje',
                                                                                                ' AICM ')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 4:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit(EncuentraArreglo($Texto,Array(
                                                                                                'Subsecretaria de infraestructura',
                                                                                                'Raul Murrieta cummings',
                                                                                                'Raul Murrieta',
                                                                                                'Murrieta cummings',
                                                                                                'Carretera',
                                                                                                'Autopista',
                                                                                                'Plan Nacional de Infraestructura',
                                                                                                'capufe',
                                                                                                'caminos y puentes federales',
                                                                                                'Plan Nuevo Guerrero',
                                                                                                'camino rural')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                }


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
          $section->addTextBreak(2);  
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
          $section->addTextBreak(2);       
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
        if(date("H:i:s")<"04:45:00")
        {
          $objWriter->save("Avance.docx");
          chmod("Avance.docx", 0777);
        }
        else if((date("H:i:s")<"05:37:00")&&(date("H:i:s")>"04:45:00"))
        {
          $objWriter->save("Complemento_1.docx");
          chmod("Complemento_1.docx", 0777);
        }
        else if((date("H:i:s")<"06:00:00")&&(date("H:i:s")>"05:37:00"))
        {
          $objWriter->save("Complemento_2.docx");
          chmod("Complemento_2.docx", 0777);
        }
        else
        {
          $objWriter->save("Final.docx");
          chmod("Final.docx", 0777);
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

//echo EncuentraCoincidencias($nota, "Gerardo Ruiz Esparza");
// function EncuentraCoincidencias($cadenaOriginal,$valorBuscado){
//     $posicion=  strpos($cadenaOriginal, $valorBuscado);
//     if($posicion!==false){
//         if($posicion>0){
//              $nuevaCadena=  substr($cadenaOriginal, $posicion-5,$posicion+400);
//             return $nuevaCadena."...";      
//         }else{
//              $nuevaCadena=  substr($cadenaOriginal, $posicion,$posicion+400);
//             return $nuevaCadena."...";      
//         }
//     }else if($posicion===false){
//         return false;
//     }
// }
function EncuentraCoincidencias($cadenaOriginal,$valorBuscado){

    preg_match_all("#(.*)\. #U",$cadenaOriginal,$match);

    if(count($match[1])<1) return false;

    for($i=0;$i<count($match[1]);$i++) {

        $posicion = strpos($match[1][$i], $valorBuscado);

        if( $posicion !== false ){
            if( $i == 0 ) return $match[1][$i] . "(...)";
            else if( $i > 0 && $i < count($match[1]) ) return $match[1][$i] . "(...)" ;
            else if( $i == count($match[1]) ) return $match[1][$i];
        }
    }
}


function EncuentraArreglo($cadenaOriginal,$array){
    $cadena=false;
    foreach ($array as $value)
    {
        $cadena=EncuentraCoincidencias($cadenaOriginal,$value);
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
?>
