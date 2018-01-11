<?php
include_once 'Header.php';
require "/var/www/external/services/mail/conexion.php";
require "/var/www/external/services/corrector/correctorOrtografico.php";
    

ResumenINEE();

function ResumenINEE()
{
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
      'INEE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (1) AS Pagina,
      '' as  Autor,
      '1' AS rel,
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
      (2) AS Pagina,
      n.Autor,
      '1' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND (
          Texto LIKE '% INEE%' OR
          Texto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Texto LIKE '%Margarita Maria zorrilla fierro%' OR
        Texto LIKE '%Margarita zorrilla fierro%' OR
        Texto LIKE '%zorrilla fierro%' OR
        Texto LIKE '%Eduardo Backhoff escudero%' OR
        Texto LIKE '%Backhoff escudero%' OR
        Texto like '%Sylvia Schmelkes%' OR
        Texto like '%Sylvia Schmelkes del valle%' OR
        Texto like '%Schmelkes del valle%' OR
        Texto like '%Gilberto Ramon Guevara Niebla%' OR
        Texto like '%Gilberto Guevara Niebla%' OR
        Texto like '%Guevara Niebla%' OR
        Texto like '%Teresa bracho gonzalez%' OR
        Texto like '%bracho gonzalez%' OR


          Titulo LIKE '% INEE%' OR
          Titulo LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Titulo LIKE '%Margarita Maria zorrilla fierro%' OR
        Titulo LIKE '%Margarita zorrilla fierro%' OR
        Titulo LIKE '%zorrilla fierro%' OR
        Titulo LIKE '%Eduardo Backhoff escudero%' OR
        Titulo LIKE '%Backhoff escudero%' OR
        Titulo like '%Sylvia Schmelkes%' OR
        Titulo like '%Sylvia Schmelkes del valle%' OR
        Titulo like '%Schmelkes del valle%' OR
        Titulo like '%Gilberto Ramon Guevara Niebla%' OR
        Titulo like '%Gilberto Guevara Niebla%' OR
        Titulo like '%Guevara Niebla%' OR
        Titulo like '%Teresa bracho gonzalez%' OR
        Titulo like '%bracho gonzalez%' OR

          Encabezado LIKE '% INEE%' OR
          Encabezado LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Encabezado LIKE '%Margarita Maria zorrilla fierro%' OR
        Encabezado LIKE '%Margarita zorrilla fierro%' OR
        Encabezado LIKE '%zorrilla fierro%' OR
        Encabezado LIKE '%Eduardo Backhoff escudero%' OR
        Encabezado LIKE '%Backhoff escudero%' OR
        Encabezado like '%Sylvia Schmelkes%' OR
        Encabezado like '%Sylvia Schmelkes del valle%' OR
        Encabezado like '%Schmelkes del valle%' OR
        Encabezado like '%Gilberto Ramon Guevara Niebla%' OR
        Encabezado like '%Gilberto Guevara Niebla%' OR
        Encabezado like '%Guevara Niebla%' OR
        Encabezado like '%Teresa bracho gonzalez%' OR
        Encabezado like '%bracho gonzalez%' OR
          
          PieFoto LIKE '% INEE%' OR
          PieFoto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          PieFoto LIKE '%Margarita Maria zorrilla fierro%' OR
        PieFoto LIKE '%Margarita zorrilla fierro%' OR
        PieFoto LIKE '%zorrilla fierro%' OR
        PieFoto LIKE '%Eduardo Backhoff escudero%' OR
        PieFoto LIKE '%Backhoff escudero%' OR
        PieFoto like '%Sylvia Schmelkes%' OR
        PieFoto like '%Sylvia Schmelkes del valle%' OR
        PieFoto like '%Schmelkes del valle%' OR
        PieFoto like '%Gilberto Ramon Guevara Niebla%' OR
        PieFoto like '%Gilberto Guevara Niebla%' OR
        PieFoto like '%Guevara Niebla%' OR
        PieFoto like '%Teresa bracho gonzalez%' OR
        PieFoto like '%bracho gonzalez%'
         )
  ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '3' AS idEditorial,
      'Funcionarios' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
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
      n.Activo = 1 AND
      fecha = CURDATE() AND(
      Texto LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Texto LIKE '%Sylvia Schmelkes del Valle%' OR
      Titulo LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Titulo LIKE '%Sylvia Schmelkes del Valle%' OR
      Encabezado LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Encabezado LIKE '%Sylvia Schmelkes del Valle%' OR

      Texto LIKE '%Margarita María Zorrilla Fierro%' OR
      Texto LIKE '%Margarita Zorrilla Fierro%' OR
      Titulo LIKE '%Margarita María Zorrilla Fierro%' OR
      Titulo LIKE '%Margarita Zorrilla Fierro%' OR
      Encabezado LIKE '%Margarita María Zorrilla Fierro%' OR
      Encabezado LIKE '%Margarita Zorrilla Fierro%' OR

      Texto LIKE '%Teresa Bracho González%' OR
      Titulo LIKE '%Teresa Bracho González%' OR
      Encabezado LIKE '%Teresa Bracho González%' OR

      Texto LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Texto LIKE '%Gilberto Guevara Niebla%' OR
      Titulo LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Titulo LIKE '%Gilberto Guevara Niebla%' OR
      Encabezado LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Encabezado LIKE '%Gilberto Guevara Niebla%' OR

      Texto LIKE '%Eduardo Backhoff Escudero%' OR
      Titulo LIKE '%Eduardo Backhoff Escudero%' OR
      Encabezado LIKE '%Eduardo Backhoff Escudero%' OR

      Texto LIKE '%Francisco Miranda López%' OR
      Titulo LIKE '%Francisco Miranda López%' OR
      Encabezado LIKE '%Francisco Miranda López%'  OR

      Texto LIKE '%Jorge Antonio Hernández Uralde%' OR
      Texto LIKE '%Jorge Hernández Uralde%' OR
      Titulo LIKE '%Jorge Antonio Hernández Uralde%' OR
      Titulo LIKE '%Jorge Hernández Uralde%' OR
      Encabezado LIKE '%Jorge Antonio Hernández Uralde%' OR
      Encabezado LIKE '%Jorge Hernández Uralde%' OR

      Texto LIKE '%Agustín Caso Raphael%' OR
      Titulo LIKE '%Agustín Caso Raphael%' OR
      Encabezado LIKE '%Agustín Caso Raphael%' OR

      Texto LIKE '%Luis Castillo Montes%' OR
      Titulo LIKE '%Luis Castillo Montes%' OR
      Encabezado LIKE '%Luis Castillo Montes%'

    )
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '4' AS idEditorial,
      'Reforma Educativa' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,'' AS jpg,
      'INEE' AS Estado,
      (4) AS Pagina,
      '' as Autor,
      '4' AS rel,
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
      n.NumeroPagina as 'PaginaPDF',n.Texto,
      CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
      CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
      e.Nombre AS 'Estado',
      (4) AS Pagina,
      n.Autor,
      '4' AS rel,
      n.`order`
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
      n.Activo = 1 AND
           n.Categoria!=80 AND
      fecha = CURDATE() AND
    (
      Texto LIKE '%Reforma Educativa%' OR

      Titulo LIKE '%Reforma Educativa%' OR

      Encabezado LIKE '%Reforma Educativa%'
    )
    GROUP BY idEditorial
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '5' AS idEditorial,
      'SEN' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (5) AS Pagina,
      '' as Autor,
      '5' AS rel,
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
      (5) AS Pagina,
      n.Autor,
      '5' AS rel,
      n.`order`
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
      n.Activo = 1 AND
      fecha = CURDATE() AND
    (
      Texto LIKE 'SEN' OR
      Texto LIKE '%Sistema Educativo Nacional%' OR
        
      Titulo LIKE 'SEN' OR
      Titulo LIKE '%Sistema Educativo Nacional%' OR
      
      Encabezado LIKE 'SEN' OR
      Encabezado LIKE '%Sistema Educativo Nacional%'
    )
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'SNEE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
      n.Activo = 1 AND
      fecha = CURDATE() AND
    (
      Texto LIKE 'SNEE' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
      Titulo LIKE 'SNEE' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
      
      Encabezado LIKE 'SNEE' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
    )
    ORDER BY o.posicion
  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'PNEE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Política Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Política Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Política Nacional de Evaluación Educativa%'
      )
      ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'SPD' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR
          
        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR
        
        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
      )
      ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'PRUEBA' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND 
      (
      Texto LIKE '%prueba enlace%' OR
      Texto LIKE '%prueba excale%' OR
      Texto LIKE '%prueba pisa%' OR
      Texto LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Texto LIKE '%Programme for International Student Assessment%' OR
      Texto LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Texto LIKE '%Exámen de la Calidad y el Logro Educativo%' OR

      Titulo LIKE '%prueba enlace%' OR
      Titulo LIKE '%prueba excale%' OR
      Titulo LIKE '%prueba pisa%' OR
      Titulo LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Titulo LIKE '%Programme for International Student Assessment%' OR
      Titulo LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Titulo LIKE '%Exámen de la Calidad y el Logro Educativo%' OR

      Encabezado LIKE '%prueba enlace%' OR
      Encabezado LIKE '%prueba excale%' OR
      Encabezado LIKE '%prueba pisa%' OR
      Encabezado LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Encabezado LIKE '%Programme for International Student Assessment%' OR
      Encabezado LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Encabezado LIKE '%Exámen de la Calidad y el Logro Educativo%'

      )
      ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'Evaluación educativa / Evaluación de la educación' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE '%Evaluación educativa%' OR
      Texto LIKE '%Evaluación de la educación%' OR
          
        Titulo LIKE '%Evaluación educativa%' OR
      Titulo LIKE '%Evaluación de la educación%' OR
        
        Encabezado LIKE '%Evaluación educativa%' OR
      Encabezado LIKE '%Evaluación de la educación%'
      )
      ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'Conferencia del Sistema Nacional de Evaluación Educativa' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
      )
      ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'CONSCEE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Texto LIKE '%CONSCEE%' OR
          
        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Titulo LIKE '%CONSCEE%' OR
        
        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Encabezado LIKE '%CONSCEE%'
      )
      ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'CONVIE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
      n.Activo = 1 AND
      fecha = CURDATE() AND
    (
      Texto LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Texto LIKE 'CONVIE' OR
        
      Titulo LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Titulo LIKE 'CONVIE' OR
      
      Encabezado LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Encabezado LIKE 'CONVIE'
    )
    ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'CONPEE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Texto LIKE 'CONPEE' OR
          
        Titulo LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Titulo LIKE 'CONPEE' OR
        
        Encabezado LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Encabezado LIKE 'CONPEE'
      )
      ORDER BY o.posicion

  )
 UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'CONTE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejos Técnicos Especializados%' OR
      Texto LIKE 'CONTE' OR
          
        Titulo LIKE '%Consejos Técnicos Especializados%' OR
      Titulo LIKE 'CONTE' OR
        
        Encabezado LIKE '%Consejos Técnicos Especializados%' OR
      Encabezado LIKE 'CONTE'
      )
      ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'SEP' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE 'SEP' OR
        Texto LIKE '%Secretaría de Educación Pública%' OR
          
        Titulo LIKE 'SEP' OR
        Titulo LIKE '%Secretaría de Educación Pública%' OR
        
        Encabezado LIKE 'SEP' OR
        Encabezado LIKE '%Secretaría de Educación Pública%'
      )
      ORDER BY o.posicion

  )
 UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'SNTE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND
      (
        Texto LIKE 'SNTE' OR
        Texto LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
          
        Titulo LIKE 'SNTE' OR
        Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
        
        Encabezado LIKE 'SNTE' OR
        Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educación%'
      )
      ORDER BY o.posicion

  )
  UNION ALL
  (
    SELECT
      '6' AS idEditorial,
      'CNTE' AS Periodico,
      '' AS Fecha,
      '' AS Titulo,
      '' AS Encabezado,
      '' AS Seccion,
      '' AS NumeroPagina,
      '' as PaginaPDF,
      '' AS Texto,
      '' AS pdf,
      '' AS jpg,
      'INEE' AS Estado,
      (6) AS Pagina,
      '' as Autor,
      '6' AS rel,
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
      (6) AS Pagina,
      n.Autor,
      '6' AS rel,
      n.`order`
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
        n.Activo = 1 AND
        fecha = CURDATE() AND (
                  Texto LIKE 'CNTE' OR
                  Texto LIKE '%CNTE%' OR
                  Texto LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%' OR

                  Titulo LIKE 'CNTE' OR
                  Titulo LIKE '%CNTE%' OR
                  Titulo LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%' OR

                  Encabezado LIKE 'CNTE' OR
                  Encabezado LIKE '%CNTE%' OR
                  Encabezado LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%'
              )
      ORDER BY o.posicion

  )      
 ) Derived
 GROUP BY idEditorial,Periodico,NumeroPagina
 ORDER BY Pagina,`order`";

/*$queryColumnasPoliticas="SELECT n.idEditorial, p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
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
  GROUP BY n.idEditorial
  ORDER BY o.posicion";
  */

  $queryColumnasPoliticas="SELECT
  n.idEditorial,
  p.Nombre as Periodico,
  n.Fecha,
  n.Titulo,
  s.seccion AS 'Seccion',
  n.PaginaPeriodico AS 'NumeroPagina',
  n.NumeroPagina as 'PaginaPDF',
  n.Texto,
  CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' ,
  CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' ,
  e.Nombre AS 'Estado',
  n.Autor
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
n.Periodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(19) AND
n.Activo = 1 AND
e.idEstado = p.Estado AND
fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY o.id";

/*$queryColumnasFinancieras="SELECT n.idEditorial, p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
            CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' , CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' , e.Nombre AS 'Estado',n.Autor
  FROM noticiasDia n, periodicos p, ordenGeneral o, estados e, seccionesPeriodicos s
  WHERE 
    p.idPeriodico=n.Periodico AND
    n.Categoria in(20) AND
    e.idEstado=p.Estado AND
    s.idSeccion = n.Seccion AND
    n.Activo = 1 AND
    Fecha=CURDATE() 
GROUP BY n.idEditorial";*/

$queryColumnasFinancieras="SELECT
  n.idEditorial,
  p.Nombre as Periodico,
  n.Fecha,
  n.Titulo,
  s.seccion AS 'Seccion',
  n.PaginaPeriodico AS 'NumeroPagina',
  n.NumeroPagina as 'PaginaPDF',
  n.Texto,
  CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' ,
  CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' ,
  e.Nombre AS 'Estado',
  n.Autor
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
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(20) AND
n.Activo = 1 AND
fecha =CURDATE()
GROUP BY n.idEditorial";

/*$queryCartones="SELECT n.idEditorial, p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
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
GROUP BY n.idEditorial
  ORDER BY o.posicion";
  */

  $queryCartones="SELECT
  n.idEditorial,
  p.Nombre as Periodico,
  n.Fecha,
  n.Titulo,
  s.seccion AS 'Seccion',
  n.PaginaPeriodico AS 'NumeroPagina',
  n.NumeroPagina as 'PaginaPDF',
  n.Texto,
  CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' ,
  CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' ,
  e.Nombre AS 'Estado',
  n.Autor
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
c.idCategoria in(18) AND
p.estado=9 AND
n.Activo = 1 AND
fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY o.posicion";


  $sql="SELECT n.idEditorial, p.Nombre AS 'Periodico', n.Fecha, n.Titulo,s.seccion AS 'Seccion', n.PaginaPeriodico AS 'NumeroPagina',n.NumeroPagina as 'PaginaPDF', n.Texto,
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

    $PHPWord->addParagraphStyle('pStyle2', array('align'=>'center', 'spaceAfter'=>100,'fgColor'=>\PhpOffice\PhpWord\Style\Font::FGCOLOR_DARKYELLOW ));
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
    
    /*

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
   */
    
     $resultTitular =mysql_query($query);
     if($resultTitular)
     {
        while ($row1 = mysql_fetch_array($resultTitular))
        {
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
            if ($autor=="" && $row1['Periodico']!="INEE"){
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
            case 'INEE':
              $section->addTextBreak(2); 
              $section->addText('INEE', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=0;
            break;

            case 'Funcionarios':
              $section->addTextBreak(2); 
              $section->addText('Funcionarios', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=1;
            break;
            
            case 'Reforma Educativa':
              $section->addTextBreak(2); 
              $section->addText('Reforma Educativa', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=2;
            break;
        
            case 'SEN':
              $section->addTextBreak(2); 
              $section->addText('Sistema Educativo Nacional', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=3;
            break;
        
            case 'SNEE':
              $section->addTextBreak(2); 
              $section->addText('Sistema Nacional de Evaluación Educativa', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=4;
            break;

            case 'PNEE':
              $section->addTextBreak(2); 
              $section->addText('Política Nacional de Evaluación Educativa', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=5;
            break;

            case 'SPD':
              $section->addTextBreak(2); 
              $section->addText('Servicio Profesional Docente', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=6;
            break;

            case 'PRUEBA':
              $section->addTextBreak(2); 
              $section->addText('PRUEBA', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=7;
            break;

            case 'Evaluación educativa / Evaluación de la educación':
              $section->addTextBreak(2); 
              $section->addText('Evaluación educativa / Evaluación de la educación', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=8;
            break;

            case 'Conferencia del Sistema Nacional de Evaluación Educativa':
              $section->addTextBreak(2); 
              $section->addText('Conferencia del Sistema Nacional de Evaluación Educativa', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=9;
            break;

            case 'CONSCEE':
              $section->addTextBreak(2); 
              $section->addText('Consejo Social Consultivo de Evaluación de la Educación', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=10;
            break;

            case 'CONVIE':
              $section->addTextBreak(2); 
              $section->addText('Consejo de Vinculación con las Entidades Federativas', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=11;
            break;

            case 'CONPEE':
              $section->addTextBreak(2); 
              $section->addText('Consejo Pedagógico de Evaluación Educativa', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=12;
            break;

            case 'CONTE':
              $section->addTextBreak(2); 
              $section->addText('Consejos Técnicos Especializados', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=13;
            break;

            case 'SEP':
              $section->addTextBreak(2); 
              $section->addText('Secretaría de Educación Pública', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=14;
            break;

            case 'SNTE':
              $section->addTextBreak(2); 
              $section->addText('Sindicato Nacional de Trabajadores de la Educación', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=15;
            break;

            case 'CNTE':
              $section->addTextBreak(2); 
              $section->addText('Coordinadora Nacional de Trabajadores de la Educación', 'estiloTitle2', 'pStyle2');
              $section->addTextBreak(1);
              $personaje=16;
            break;
            
            default:
                switch ($personaje)
                {
                    case 0:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(urls_amigables((textMatch($Texto,Array('INEE',
                                                                                  'Instituto Nacional para la Evaluacion de la Educacion',
                                                                                  'Margarita Maria zorrilla fierro',
                                                                                  'Margarita zorrilla fierro',
                                                                                  'zorrilla fierro',
                                                                                  'Eduardo Backhoff escudero',
                                                                                  'Backhoff escudero',
                                                                                  'Sylvia Schmelkes',
                                                                                  'Sylvia Schmelkes del valle',
                                                                                  'Schmelkes del valle',
                                                                                  'Gilberto Ramon Guevara Niebla',
                                                                                  'Gilberto Guevara Niebla',
                                                                                  'Guevara Niebla',
                                                                                  'Teresa bracho gonzalez',
                                                                                  'bracho gonzalez' )))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 1:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Sylvia Schmelkes del Valle','Sylvia Irene Schmelkes del Valle',
                                                                                  'Margarita María Zorrilla Fierro',
                                                                                  'Margarita Zorrilla Fierro',
                                                                                  'Teresa Bracho González',
                                                                                  'Gilberto Ramón Guevara Niebla',
                                                                                  'Gilberto Guevara Niebla',
                                                                                  'Eduardo Backhoff Escudero',
                                                                                  'Francisco Miranda López',
                                                                                  'Jorge Antonio Hernández Uralde',
                                                                                  'Jorge Hernández Uralde',
                                                                                  'Agustín Caso Raphael',
                                                                                  'Luis Castillo Montes')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 2:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Reforma Educativa')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 3:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('SEN','Sistema Educativo Nacional')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 4:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('SNEE','Sistema Nacional de Evaluación Educativa')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;

                    case 5:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(urls_amigables((textMatch($Texto,Array('PNEE','Política Nacional de Evaluación Educativa')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 6:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('SPD','Servicio Profesional Docente')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 7:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('prueba enlace',
                                                                                                'prueba excale',
                                                                                                'prueba pisa',
                                                                                                'Evaluación Nacional de Logro Académico en Centros Escolares',
                                                                                                'Programme for International Student Assessment',
                                                                                                'Programa para la Evaluación Internacional de los Estudiantes',
                                                                                                'Exámen de la Calidad y el Logro Educativo')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 8:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Evaluación educativa',
                                                                                'Evaluación de la educación'
                                                                                                    )))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 9:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Conferencia del Sistema Nacional de Evaluación Educativa',
                                                                                'Sistema Nacional de Evaluación Educativa')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;

                    case 10:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(urls_amigables((textMatch($Texto,Array('Consejo Social Consultivo de Evaluacion de la Educación','CONSCEE')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 11:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Consejo de Vinculación con las Entidades Federativas','CONVIE')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 12:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Consejo Pedagógico de Evaluación Educativa',
                                                                                                'CONPEE')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 13:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('Consejos Técnicos Especializados',
                                                                                'CONTE'
                                                                                                    )))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                    case 14:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('SEP',
                                                                                'Secretaría de Educación Pública')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;

                    case 15:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(urls_amigables((textMatch($Texto,Array('SNTE','Sindicato Nacional de Trabajadores de la Educación')))),'estiloTexto','pStyle');
                        $section->addText(urls_amigables(wordlimit2("Autor : ".$autor)), 'estiloTexto','pStyle');
                    break;
                
                    case 16:
                        $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
                        $section->addText(urls_amigables(wordlimit2($Encabezado)), 'estiloEncabezado');
                        $section->addText(((textMatch($Texto,Array('CNTE','Coordinadora Nacional de Trabajadores de la Educacion')))),'estiloTexto','pStyle');
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

/*
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

    */
      
    /*  
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

    */

    /*
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

            $titulito = urls_amigables(correctorOrtografico($titulito));
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

          //CARTONES ANTERIOR
    }    
    */

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007'); 
    try {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: X-Requested-With");

        $objWriter->save("ResumenINEE.docx");
        chmod("ResumenINEE.docx", 0777);
        echo json_encode(array('doc'=>'final'));

    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

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

  $url = str_replace(
        array("\x1F","\x16","&"),
        array(" ", " ","Y"),
        $url
    );
 
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

?>


