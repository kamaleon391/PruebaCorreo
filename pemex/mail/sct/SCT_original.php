<?php
include_once 'Header.php';
require "/var/www/external/services/mail/conexion.php";
require "../../corrector/correctorOrtografico.php";
    

ResumenSCT();

function ResumenSCT()
{
$ids_Array = Array();

  mysql_query("set names 'utf8'");
   $query="SELECT
  idEditorial,
  Periodico,
  Fecha,
  Titulo,
  Encabezado,
  Seccion,
  NumeroPagina,
  PaginaPDF,
  Texto,
  pdf,
  jpg,
  Estado,
  Pagina,
  Autor,
  rel,
  `order`
FROM 
(
  (
    SELECT
      '1' AS idEditorial,
      'Secretario' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'SCT' AS Estado,
      (1) AS Pagina,
      '' as  Autor,
      '1' AS rel,
      0 AS `order`
  )
  UNION ALL
  (
    SELECT
      DISTINCT(n.idEditorial), 
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',
      n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (2) AS Pagina,
      n.Autor,
      '1' AS rel,
      n.`order`
    FROM 
      noticiasDia n,
      ordenGeneral o,
      periodicos p,
      seccionesPeriodicos s,
      estados e
    WHERE
    (
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
    n.Activo=1 AND
    n.Categoria NOT IN (1,18,19,20)
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      DISTINCT(n.idEditorial), 
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',
      n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (2) AS Pagina,
      n.Autor,
      '1' AS rel,
      n.`order`
    FROM 
      noticiasDia n,
      ordenGeneral o,
      periodicos p,
      seccionesPeriodicos s,
      estados e
    WHERE
    (
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
    n.Activo=1  AND
    n.Categoria IN (1,18,19,20)
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '3' AS idEditorial,
      'Secretaria de Comunicaciones y Transportes' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'SCT' AS Estado,
      (3) AS Pagina,
      '' as Autor,
      '3' AS rel,
      0 AS `order`
  )
  UNION ALL 
  (
    SELECT
      n.idEditorial,
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',
      n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (3) AS Pagina,
      n.Autor,
      '3' AS rel,
      n.`order`
    FROM 
      noticiasDia n,
      ordenGeneral o,
      periodicos p,
      seccionesPeriodicos s,
      estados e
    WHERE
    (
      Texto like '% SCT % ' OR
      Texto like '% Secretaria de Comunicaciones y Transportes %' OR
      Titulo like '% SCT % ' OR
      Titulo like '% Secretaria de Comunicaciones y Transportes %' OR
      Encabezado like '% SCT % ' OR
      Encabezado like '% Secretaria de Comunicaciones y Transportes %'
    ) AND 
      n.Periodico=p.idPeriodico AND 
      n.Periodico=o.periodico AND 
      p.Estado = e.idEstado AND
      s.idSeccion = n.Seccion AND 
      p.tipo=1 AND 
      Fecha=CURDATE() AND 
      n.Categoria<>80 AND
      n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND 
      p.Estado=9 AND
      n.Activo=1 AND
      n.Categoria NOT IN (1,18,19,20)
      ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      n.idEditorial,
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',
      n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (3) AS Pagina,
      n.Autor,
      '3' AS rel,
      n.`order`
    FROM 
      noticiasDia n,
      ordenGeneral o,
      periodicos p,
      seccionesPeriodicos s,
      estados e
    WHERE
    (
      Texto like '% SCT % ' OR
      Texto like '% Secretaria de Comunicaciones y Transportes %' OR
      Titulo like '% SCT % ' OR
      Titulo like '% Secretaria de Comunicaciones y Transportes %' OR
      Encabezado like '% SCT % ' OR
      Encabezado like '% Secretaria de Comunicaciones y Transportes %'
    ) AND 
      n.Periodico=p.idPeriodico AND 
      n.Periodico=o.periodico AND 
      p.Estado = e.idEstado AND
      s.idSeccion = n.Seccion AND 
      p.tipo=1 AND 
      Fecha=CURDATE() AND 
      n.Categoria<>80 AND
      n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND 
      p.Estado=9 AND
      n.Activo=1 AND
      n.Categoria IN (1,18,19,20)
      ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '4' AS idEditorial,
      'Subsecretaria de Comunicaciones' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'SCT' AS Estado,
      (4) AS Pagina,
      '' as Autor,
      '4' AS rel,
      0 AS `order`
  )
  UNION ALL 
  (
    SELECT 
      DISTINCT(n.idEditorial),
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',
      n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (4) AS Pagina,
      n.Autor,
      '4' AS rel,
      n.`order`
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

      Titulo      like '%Subsecretaria de Comunicaciones%' OR
      Titulo      like '%Subsecretario de comunicaciones%' OR
      Titulo      like '%jose ignacio peralta sanchez%' OR
      Titulo      like '%jose ignacio peralta%' OR
      Titulo      like '%jose peralta sanchez%' OR
      Titulo      like '%peralta sanchez%' OR

      Encabezado      like '%Subsecretaria de Comunicaciones%' OR
      Encabezado      like '%Subsecretario de comunicaciones%' OR
      Encabezado      like '%jose ignacio peralta sanchez%' OR
      Encabezado      like '%jose ignacio peralta%' OR
      Encabezado      like '%jose peralta sanchez%' OR
      Encabezado      like '%peralta sanchez%'
    ) AND 
    n.Periodico=p.idPeriodico AND 
    n.Periodico=o.periodico AND 
    p.Estado = e.idEstado AND 
    s.idSeccion = n.Seccion AND
    Fecha=CURDATE() AND 
    n.Categoria<>80 AND 
    n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND
    p.Estado=9 AND
    n.Activo=1 AND
    n.Categoria NOT IN (1,18,19,20)
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT 
      DISTINCT(n.idEditorial),
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',
      n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (4) AS Pagina,
      n.Autor,
      '4' AS rel,
      n.`order`
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

      Titulo      like '%Subsecretaria de Comunicaciones%' OR
      Titulo      like '%Subsecretario de comunicaciones%' OR
      Titulo      like '%jose ignacio peralta sanchez%' OR
      Titulo      like '%jose ignacio peralta%' OR
      Titulo      like '%jose peralta sanchez%' OR
      Titulo      like '%peralta sanchez%' OR

      Encabezado      like '%Subsecretaria de Comunicaciones%' OR
      Encabezado      like '%Subsecretario de comunicaciones%' OR
      Encabezado      like '%jose ignacio peralta sanchez%' OR
      Encabezado      like '%jose ignacio peralta%' OR
      Encabezado      like '%jose peralta sanchez%' OR
      Encabezado      like '%peralta sanchez%'
    ) AND 
    n.Periodico=p.idPeriodico AND 
    n.Periodico=o.periodico AND 
    p.Estado = e.idEstado AND 
    s.idSeccion = n.Seccion AND
    Fecha=CURDATE() AND 
    n.Categoria<>80 AND 
    n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND
    p.Estado=9 AND
    n.Activo=1 AND
    n.Categoria IN (1,18,19,20)
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '5' AS idEditorial,
      'Subsecretaria de Transporte' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,'' AS jpg,
      'SCT' AS Estado,
      (5) AS Pagina,
      '' as Autor,
      '5' AS rel,
      0 AS `order`
  )
  UNION ALL 
  (
    SELECT
      DISTINCT(n.idEditorial),
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (5) AS Pagina,
      n.Autor,
      '5' AS rel,
      n.`order`
    FROM
      noticiasDia n,
      ordenGeneral o,
      periodicos p,
      seccionesPeriodicos s,
      estados e
    WHERE
    (
      Texto      like '%Subsecretaria de Transportes%' OR
      Texto      like '%Yuriria Mascot Perez%' OR  
      Texto      like '%Yuriria Mascot%' OR  
      Texto      like '%Mascot Perez%' OR

      Titulo      like '%Subsecretaria de Transportes%' OR
      Titulo      like '%Yuriria Mascot Perez%' OR   
      Titulo      like '%Yuriria Mascot%' OR   
      Titulo      like '%Mascot Perez%' OR

      Encabezado      like '%Subsecretaria de Transportes%' OR
      Encabezado      like '%Yuriria Mascot Perez%' OR   
      Encabezado      like '%Yuriria Mascot%' OR   
      Encabezado      like '%Mascot Perez%'
    ) AND
    n.Periodico=p.idPeriodico AND
    n.Periodico=o.periodico AND
    p.Estado = e.idEstado AND
    s.idSeccion = n.Seccion AND
    Fecha=CURDATE() AND
    n.Categoria<>80 AND
    n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626,436) AND
    p.Estado=9 AND
    n.Activo=1 AND
    n.Categoria NOT IN (1,18,19,20)
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      DISTINCT(n.idEditorial),
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (5) AS Pagina,
      n.Autor,
      '5' AS rel,
      n.`order`
    FROM
      noticiasDia n,
      ordenGeneral o,
      periodicos p,
      seccionesPeriodicos s,
      estados e
    WHERE
    (
      Texto      like '%Subsecretaria de Transportes%' OR
      Texto      like '%Yuriria Mascot Perez%' OR  
      Texto      like '%Yuriria Mascot%' OR  
      Texto      like '%Mascot Perez%' OR

      Titulo      like '%Subsecretaria de Transportes%' OR
      Titulo      like '%Yuriria Mascot Perez%' OR   
      Titulo      like '%Yuriria Mascot%' OR   
      Titulo      like '%Mascot Perez%' OR

      Encabezado      like '%Subsecretaria de Transportes%' OR
      Encabezado      like '%Yuriria Mascot Perez%' OR   
      Encabezado      like '%Yuriria Mascot%' OR   
      Encabezado      like '%Mascot Perez%'
    ) AND
    n.Periodico=p.idPeriodico AND
    n.Periodico=o.periodico AND
    p.Estado = e.idEstado AND
    s.idSeccion = n.Seccion AND
    Fecha=CURDATE() AND
    n.Categoria<>80 AND
    n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626,436) AND
    p.Estado=9 AND
    n.Activo=1 AND
    n.Categoria IN (1,18,19,20)
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'Subsecretaria de Infraestructura' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'SCT' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
      0 AS `order`
  )
  UNION ALL 
  (
    SELECT
      DISTINCT(n.idEditorial),
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',
      n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
    FROM
      noticiasDia n,
      periodicos p,
      seccionesPeriodicos s,
      estados e
    WHERE
    (
      Texto      like '%Subsecretaria de infraestructura%' OR
      Texto      like '%Raul Murrieta cummings%' OR
      Texto      like '%Raul Murrieta%' OR
      Texto      like '%Murrieta cummings%' OR

      Titulo      like '%Subsecretaria de infraestructura%' OR
      Titulo      like '%Raul Murrieta cummings%' OR
      Titulo      like '%Raul Murrieta%' OR
      Titulo      like '%Murrieta cummings%' OR

      Encabezado      like '%Subsecretaria de infraestructura%' OR
      Encabezado      like '%Raul Murrieta cummings%' OR
      Encabezado      like '%Raul Murrieta%' OR
      Encabezado      like '%Murrieta cummings%'

    ) AND
    n.Periodico=p.idPeriodico AND
    p.Estado = e.idEstado AND
    s.idSeccion = n.Seccion AND
    Fecha=CURDATE() AND
    n.Categoria<>80 AND
    n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND
    p.Estado=9 AND
    p.idPeriodico not in (121,149,244,315) AND
    n.Activo=1 AND
    n.Categoria NOT IN (1,18,19,20)
  )
  UNION ALL
  (
    SELECT
      DISTINCT(n.idEditorial),
      p.Nombre AS 'Periodico',
      n.Fecha,
      n.Titulo,
      n.Encabezado,
      s.seccion AS 'Seccion',
      n.PaginaPeriodico AS 'NumeroPagina',
      n.NumeroPagina as 'PaginaPDF',
      n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
    FROM
      noticiasDia n,
      periodicos p,
      seccionesPeriodicos s,
      estados e
    WHERE
    (
      Texto      like '%Subsecretaria de infraestructura%' OR
      Texto      like '%Raul Murrieta cummings%' OR
      Texto      like '%Raul Murrieta%' OR
      Texto      like '%Murrieta cummings%' OR

      Titulo      like '%Subsecretaria de infraestructura%' OR
      Titulo      like '%Raul Murrieta cummings%' OR
      Titulo      like '%Raul Murrieta%' OR
      Titulo      like '%Murrieta cummings%' OR

      Encabezado      like '%Subsecretaria de infraestructura%' OR
      Encabezado      like '%Raul Murrieta cummings%' OR
      Encabezado      like '%Raul Murrieta%' OR
      Encabezado      like '%Murrieta cummings%'

    ) AND
    n.Periodico=p.idPeriodico AND
    p.Estado = e.idEstado AND
    s.idSeccion = n.Seccion AND
    Fecha=CURDATE() AND
    n.Categoria<>80 AND
    n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND
    p.Estado=9 AND
    p.idPeriodico not in (121,149,244,315) AND
    n.Activo=1 AND
    n.Categoria IN (1,18,19,20)
  )
 ) Derived
 GROUP BY idEditorial,Periodico,NumeroPagina
 ORDER BY Pagina,`order`";

$queryColumnasPoliticas="SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    p.idPeriodico=o.periodico AND
    n.Categoria in(19) AND
    e.idEstado=p.Estado AND
    s.idSeccion = n.Seccion AND
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
    s.idSeccion = n.Seccion AND
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
    s.idSeccion = n.Seccion AND
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
    s.idSeccion = n.Seccion AND
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
    $PHPWord->addFontStyle('estiloEncabezado', array('bold'=>true, 'arial'=>true, 'size'=>8));
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
    //$section->addImage('img/logo.png');
    
    $section->addTextBreak(1);
    $imageStyle = array('width'=>300, 'height'=>90, 'align'=>'center');
    $header->addImage('logo.png', $imageStyle);
    $header->addText('Resumen Ejecutivo'.'   '.mostrar_fecha_completa($fecha),'estiloHead');
    $footer->addPreserveText('Pagina {PAGE} de {NUMPAGES}.');
    
    $section->addText('8 COLUMNAS', 'estiloTitle2');
    $resp=  mysql_query($sql);
    
    while($row= mysql_fetch_array($resp))
    {
        $ids_Array[]=$row['idEditorial'];
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
          $ids_Array[]=$row1['idEditorial'];
            $Periodico=$row1['Periodico'];
            $Fecha=$row1['Fecha'];
            $Titulo=correctorOrtografico(strtoupper($row1['Titulo']));
            $Encabezado=correctorOrtografico(strtoupper($row1['Encabezado']));
            $Seccion=$row1['Seccion'];
            $NumeroPagina=$row1['NumeroPagina'];
            $Texto=(string)$row1['Texto'];
            $pd=$row1['pdf'];
            $Estado=$row1['Estado'];
            
            $autor=$row1['Autor'];
            $autor=  ucwords(strtolower($autor));
            if ($autor=="" && $row1['Periodico']!="Secretaria de Comunicaciones y Transportes"){
                    $autor=$row1['Periodico'];
                }
                
            
            $Per = utf8_decode($Periodico);
            switch($Per)
            {
                case "Excelsior":
                    $Per = "Excélsior";
                    $autor="Excélsior";
                break;
            
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
            
                case "Reporte Indigo Df":
                    $Per = "Reporte Índigo";
                    $autor="Reporte Índigo";
                break;
            
                case "Punto critico":
                    $Per = "Punto Crítico";
                    $autor="Punto Crítico";
                break;
            
                case "la prensa":
                    $Per = "La Prensa";
                    $autor="La Prensa";
                break;
            
                case "Mundo expres":
                    $Per = "Mundo Expres";
                    $autor="Mundo Expres";
                break;
              }
              
            $Texto = correctorOrtografico($Texto);
            $Titulo = convert_Mayus($Titulo);
            $Encabezado = convert_Mayus($Encabezado);
            
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
              $section->addText('SECRETARÍA DE COMUNICACIONES Y TRANSPORTES', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=1;
            break;
            
            case 'Subsecretaria de Comunicaciones':
              $section->addTextBreak(2); 
              $section->addText('SUBSECRETARÍA DE COMUNICACIONES', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=2;
            break;
        
            case 'Subsecretaria de Transporte':
              $section->addTextBreak(2); 
              $section->addText('SUBSECRETARÍA DE TRANSPORTE', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=3;
            break;
        
            case 'Subsecretaria de Infraestructura':
              $section->addTextBreak(2); 
              $section->addText('SUBSECRETARÍA DE INFRAESTRUCTURA', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=4;
            break;
            
            default:
                switch ($personaje)
                {
                    case 0:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(urls_amigables((textMatch($Texto,Array('Gerardo Ruíz Esparza','Ruíz Esparza','Gerardo Ruiz Esparza','Ruiz Esparza')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 1:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('SCT','Secretaría de Comunicaciones Y Transportes','Secretaria de Comunicaciones y Transportes','SCT')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 2:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('subsecretario de comunicaciones',
                                                                                                'Subsecretaría de Comunicaciones',
                                                                                                'Subsecretario de comunicaciones',
                                                                                                'jose ignacio peralta sanchez',
                                                                                                'José Ignacio Peralta Sánchez',
                                                                                                'jose ignacio peralta',
                                                                                                'jose peralta sanchez',
                                                                                                'peralta sanchez')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 3:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Yuriria Mascott',
                                                                                'Subsecretaria de Transportes'
                                                                                                    )))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 4:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Raúl Murrieta',
                                                                                'Subsecretaría de infraestructura',
                                                                                'Raul Murrieta cummings',
                                                                                'Murrieta cummings')))),'estiloTexto','pStyle');
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
        $ids_Array[]=$col['idEditorial'];
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
                case "Excelsior":
                    $Per = "Excélsior";
                    $autor="Excélsior";
                break;
            
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
            
                case "Reporte Indigo Df":
                    $Per = "Reporte Índigo";
                    $autor="Reporte Índigo";
                break;
            
                case "Punto critico":
                    $Per = "Punto Crítico";
                    $autor="Punto Crítico";
                break;
            
                case "la prensa":
                    $Per = "La Prensa";
                    $autor="La Prensa";
                break;
            
                case "Mundo expres":
                    $Per = "Mundo Expres";
                    $autor="Mundo Expres";
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
        $ids_Array[]=$row12['idEditorial'];
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
                case "Excelsior":
                    $Per = "Excélsior";
                    $autor="Excélsior";
                break;
            
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
            
                case "Reporte Indigo Df":
                    $Per = "Reporte Índigo";
                    $autor="Reporte Índigo";
                break;
            
                case "Punto critico":
                    $Per = "Punto Crítico";
                    $autor="Punto Crítico";
                break;
            
                case "la prensa":
                    $Per = "La Prensa";
                    $autor="La Prensa";
                break;
            
                case "Mundo expres":
                    $Per = "Mundo Expres";
                    $autor="Mundo Expres";
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
        while($row= mysql_fetch_array($resultCarto))
        {
          $ids_Array[]=$row['idEditorial'];
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
        /*
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
                case "Excelsior":
                    $Per = "Excélsior";
                    $autor="Excélsior";
                break;
            
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
            
                case "Reporte Indigo Df":
                    $Per = "Reporte Índigo";
                    $autor="Reporte Índigo";
                break;
            
                case "Punto critico":
                    $Per = "Punto Crítico";
                    $autor="Punto Crítico";
                break;
            
                case "la prensa":
                    $Per = "La Prensa";
                    $autor="La Prensa";
                break;
            
                case "Mundo expres":
                    $Per = "Mundo Expres";
                    $autor="Mundo Expres";
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

          *///CARTONES ANTERIOR
    }    




    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007'); 
    try {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: X-Requested-With");

        if(date("H:i:s")<"04:45:00")
        {
          $objWriter->save("Avance.docx");
          chmod("Avance.docx", 0777);
          echo json_encode(array('doc'=>'avance'));
        }
        /*else if((date("H:i:s")<"05:37:00")&&(date("H:i:s")>"04:45:00"))
        {
          $objWriter->save("Complemento_1.docx");
          chmod("Complemento_1.docx", 0777);
        }
        else if((date("H:i:s")<"06:00:00")&&(date("H:i:s")>"05:37:00"))
        {
          $objWriter->save("Complemento_2.docx");
          chmod("Complemento_2.docx", 0777);
        }*/
        else
        {
          mysql_close();


        $server="localhost";
        $username="root";
        $password="Gaddp552014";
        //$password="";
        $database="monitoreoGa";

        $conect=mysql_connect($server, $username, $password);

        mysql_select_db($database,$conect);

          echo $query_id = "INSERT INTO sct_ids (idEditorial) VALUES (".implode("),(", $ids_Array).")";
          mysql_query($query_id);
          mysql_close();
          $objWriter->save("Final.docx");
          chmod("Final.docx", 0777);
          echo json_encode(array('doc'=>'final'));

        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
//correo();
    return $objWriter; 
}

function correo(){
   
// require "/var/www/external/services/mail/PHPMailer/class.phpmailer.php";
            
       
//   $mail = new PHPMailer();
//   $mail->IsSMTP();
//   //$mail->CharSet = 'UTF-8';
//   $mail->Host     = "smtp.gacomunicacion.com";
//   $mail->Port     = 587;
//   $mail->SMTPAuth = true;
//   $mail->SMTPSecure = "tsl";
//   $mail->Username = "gaimpresos@gacomunicacion.com";
//   $mail->Password = "Gagdl1";

require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";  

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host     = "pro.turbo-smtp.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "VBHYxToX";

/*
$mail->addAddress('edgarh@gacomunicacion.com', 'Edgar Oswaldo Hernánde Barajas');
$mail->addAddress('ricardom@gacomunicacion.com', 'Ricardo Madrigal Rodriguez (Sauron)');
$mail->addAddress('mariob@gacomunicacion.com', 'Mario Alberto Badillo (Hobbit)');
$mail->addAddress('juan.a@gacomunicacion.com', 'Juan (Y los tacos?)');
*/

  $mail->From="gaimpresos@gacomunicacion.com";
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
      return $cadenaOriginal."***************";
    } 
}

function textMatch($cadena,$criterio) {

    try {

        // Salida
        $output = "";

        // Arreglo temporal
        $tmp_output = array();

        // Separacion de parrafos
        preg_match_all("#(.*)\.#U",$cadena,$multiMatch);

        if(count($multiMatch[1])>1) {
            for ($i=0; $i < count($multiMatch[1]); $i++) {
                $tmp_text = "";
                for ($y=0; $y < count($criterio); $y++) { 
                    $match = preg_match("/".$criterio[$y]."/i",preg_quote($multiMatch[1][$i]));
                    if($match===1) $tmp_text = $multiMatch[1][$i];
                }
                if($tmp_text!='') $tmp_output[] = $tmp_text . ".";
            }
            if(count($tmp_output)>0) $output = implode("(...) ", $tmp_output);
        } else {
            $tmp_text = "";
            for ($i=0; $i < count($criterio); $i++) { 
                $match = preg_match("/".$criterio[$i]."/i",preg_quote($cadena));
                if($match===1) $tmp_text = $cadena;
            }
            if($tmp_text!='') $output = $tmp_text;
        }
        return ($output=='' ? $cadena : $output);
        
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/*
SELECT idEditorial, Periodico, Fecha, Titulo,Encabezado,Seccion, NumeroPagina, PaginaPDF,Texto, pdf,jpg, Estado, Pagina,Autor FROM 
(
 (SELECT '1' AS idEditorial,'Secretario' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Encabezado,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(1) AS Pagina,'' as  Autor)
   UNION ALL
     (SELECT DISTINCT(n.idEditorial), 
	    p.Nombre AS 'Periodico',
		n.Fecha,
		n.Titulo,
		n.Encabezado,
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
		n.Activo=1  AND n.Categoria not in (1,18,19,20)
ORDER BY o.posicion)
   UNION ALL
	 (SELECT DISTINCT(n.idEditorial), 
	    p.Nombre AS 'Periodico',
		n.Fecha,
		n.Titulo,
		n.Encabezado,
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
		n.Activo=1  AND n.Categoria in (1,18,19,20)
ORDER BY o.posicion)
UNION ALL
 (SELECT '3' AS idEditorial,'Secretaria de Comunicaciones y Transportes' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Encabezado,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(3) AS Pagina,'' as Autor)
   UNION ALL 
     ( SELECT n.idEditorial,
p.Nombre AS 'Periodico',
n.Fecha,
n.Titulo,
n.Encabezado,
s.seccion AS 'Seccion',
n.PaginaPeriodico AS 'NumeroPagina',
n.NumeroPagina as 'PaginaPDF',
n.Texto,
CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
e.Nombre AS 'Estado',
(3) AS Pagina,
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
n.Activo=1   AND n.Categoria not in (1,18,19,20)
ORDER BY o.posicion
)
	
	UNION ALL
( SELECT n.idEditorial,
p.Nombre AS 'Periodico',
n.Fecha,
n.Titulo,
n.Encabezado,
s.seccion AS 'Seccion',
n.PaginaPeriodico AS 'NumeroPagina',
n.NumeroPagina as 'PaginaPDF',
n.Texto,
CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
e.Nombre AS 'Estado',
(3) AS Pagina,
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
n.Activo=1  AND n.Categoria in (1,18,19,20)
ORDER BY o.posicion
) UNION ALL
 (SELECT '4' AS idEditorial,'Subsecretaria de Comunicaciones' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Encabezado,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(4) AS Pagina,'' as Autor)
   UNION ALL 
     (SELECT 
	DISTINCT(n.idEditorial),
	p.Nombre AS 'Periodico',
	n.Fecha,
	n.Titulo,
	n.Encabezado,
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

		 Titulo      like '%Subsecretaria de Comunicaciones%' OR
		 Titulo      like '%Subsecretario de comunicaciones%' OR
		 Titulo      like '%jose ignacio peralta sanchez%' OR
		 Titulo      like '%jose ignacio peralta%' OR
		 Titulo      like '%jose peralta sanchez%' OR
		 Titulo      like '%peralta sanchez%' OR

		 Encabezado      like '%Subsecretaria de Comunicaciones%' OR
		 Encabezado      like '%Subsecretario de comunicaciones%' OR
		 Encabezado      like '%jose ignacio peralta sanchez%' OR
		 Encabezado      like '%jose ignacio peralta%' OR
		 Encabezado      like '%jose peralta sanchez%' OR
		 Encabezado      like '%peralta sanchez%'
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
 (SELECT '5' AS idEditorial,'Subsecretaria de Transporte' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Encabezado,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(5) AS Pagina,'' as Autor)
   UNION ALL 
     (SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Encabezado,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF',n.Texto,
           CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg', e.Nombre AS 'Estado',(5) AS Pagina,n.Autor
       FROM noticiasDia n, ordenGeneral o,periodicos p, seccionesPeriodicos s, estados e
       WHERE(
	   Texto      like '%Subsecretaria de Transportes%' OR
	   Texto      like '%Yuriria Mascot Perez%' OR	 
	   Texto      like '%Yuriria Mascot%' OR	 
	   Texto      like '%Mascot Perez%' OR

	   Titulo      like '%Subsecretaria de Transportes%' OR
	   Titulo      like '%Yuriria Mascot Perez%' OR	 
	   Titulo      like '%Yuriria Mascot%' OR	 
	   Titulo      like '%Mascot Perez%' OR

	   Encabezado      like '%Subsecretaria de Transportes%' OR
	   Encabezado      like '%Yuriria Mascot Perez%' OR	 
	   Encabezado      like '%Yuriria Mascot%' OR	 
	   Encabezado      like '%Mascot Perez%'
      )
      AND n.Periodico=p.idPeriodico AND n.Periodico=o.periodico AND p.Estado = e.idEstado 
      AND s.idSeccion = n.Seccion AND Fecha=CURDATE() AND n.Categoria<>80
      AND n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626,436)
      AND p.Estado=9 AND n.Activo=1
	  ORDER BY o.posicion
	  )
	UNION ALL
 (SELECT '6' AS idEditorial,'Subsecretaria de Infraestructura' AS Periodico,'' AS Fecha,'' AS Titulo,'' AS Encabezado,'' AS Seccion,'' AS NumeroPagina,'' as PaginaPDF,'' AS Texto,'' AS pdf,'' AS jpg, 'SCT' AS Estado,(6) AS Pagina,'' as Autor)
   UNION ALL 
     (SELECT DISTINCT(n.idEditorial), p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Encabezado,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF',n.Texto,
           CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg', e.Nombre AS 'Estado',(6) AS Pagina,n.Autor
       FROM noticiasDia n, periodicos p, seccionesPeriodicos s, estados e
       WHERE(
	   Texto      like '%Subsecretaria de infraestructura%' OR
	   Texto      like '%Raul Murrieta cummings%' OR
	   Texto      like '%Raul Murrieta%' OR
	   Texto      like '%Murrieta cummings%' OR

	   Titulo      like '%Subsecretaria de infraestructura%' OR
	   Titulo      like '%Raul Murrieta cummings%' OR
	   Titulo      like '%Raul Murrieta%' OR
	   Titulo      like '%Murrieta cummings%' OR

	   Encabezado      like '%Subsecretaria de infraestructura%' OR
	   Encabezado      like '%Raul Murrieta cummings%' OR
	   Encabezado      like '%Raul Murrieta%' OR
	   Encabezado      like '%Murrieta cummings%'

      )
      AND n.Periodico=p.idPeriodico AND p.Estado = e.idEstado 
      AND s.idSeccion = n.Seccion AND Fecha=CURDATE() AND n.Categoria<>80
      AND n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626)
      AND p.Estado=9 AND
	  p.idPeriodico not in (121,149,244,315) AND n.Activo=1
	  )



 )Derived
 GROUP BY idEditorial,Periodico,NumeroPagina
 Order by Pagina

 *  */

?>


