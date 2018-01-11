<?php

error_reporting(E_ALL);
error_reporting(-1);
require "/var/www/external/services/mail/conexion.php";

mysql_query("set names 'utf8'");

$urlP = "http://187.247.253.5";

$mensaje ='
<!DOCTYPE html>
<html lang="es">
  <head>
        <meta content="es"/>
        <meta lang="es"/>
        <meta http-equiv="Content-Language" content="es">
  </head>
 
  <body>
<table align="center" cellspacing="0" border="0" width=699>
 <tr style="text-align: right;">
    <td align="center"><img src="http://192.168.3.154/external/services/mail/inee/inee.jpg"></td>
 </tr>
<tr style="text-align: right;font-weight: bold;font-size: 16px;">
    <td>'.utf8_decode("México, D.F., ".fecha_completa(DATE('y-m-d'))).'</td>
</tr>
<tr style="text-align: right;font-weight: bold;font-size: 16px;">
    <td>'.  utf8_decode("Unidad de Planeación, Coordinación y Comunicación Social").'</td>
</tr>
<tr style="text-align: right;font-weight: bold;font-size: 16px;">
    <td>'.  utf8_decode("Dirección General de Comunicación Social").'</td>
</tr>
';

//QUERY INEE
$qryINEE="SELECT
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
  n.Activo = 1 AND
  fecha = CURDATE() AND (
    Texto LIKE '% INEE %' OR
    Texto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Texto Like '%Instituto Nacional de Evaluación Educativa %' OR
    Texto like '%tercer estudio regional comparativo y explicativo%' OR
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


    Titulo LIKE '% INEE %' OR
    Titulo LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Titulo Like '%Instituto Nacional de Evaluación Educativa %' OR
    Titulo like '%tercer estudio regional comparativo y explicativo%' OR
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

    Encabezado LIKE '% INEE %' OR
    Encabezado LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Encabezado Like '%Instituto Nacional de Evaluación Educativa %' OR
    Encabezado like '%tercer estudio regional comparativo y explicativo%' OR
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
    
    PieFoto LIKE '% INEE %' OR
    PieFoto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    PieFoto Like '%Instituto Nacional de Evaluación Educativa %' OR
    PieFoto like '%tercer estudio regional comparativo y explicativo%' OR
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
ORDER BY o.posicion";
$buscar = array(
    " INEE ",
    " (INEE)",
    "Instituto Nacional para la Evaluacion de la Educacion",
    "Instituto Naciónal para la Evaluación de la Educación",
    "Instituto Nacional para la Evaluación Educativa",
    "Instituto Nacional para la Evaluación de la Educación",
    "Margarita Zorrilla Fierro",
    "Margarita Zorrilla",
    "Zorrilla Fierro",
    "Eduardo Backhoff Escudero",
    "Backhoff Escudero",
    "Sylvia Schmelkes del Valle",
    "Sylvia Schmelkes Del Valle",
    "Schmelkes del Valle",
    "Schmelkes Del Valle",
    "Sylvia Schmelkes"
);

//$mensaje .= recuperaDatos($qryINEE, $titulo = "INEE - Instituto Nacional para la Evaluación de la Educación", $buscar );

$qryINEEWEB="SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
    Texto LIKE '% INEE %' OR
    Texto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Texto Like '%Instituto Nacional de Evaluación Educativa %' OR
    Texto like '%tercer estudio regional comparativo y explicativo%' OR
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


    Titulo LIKE '% INEE %' OR
    Titulo LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Titulo Like '%Instituto Nacional de Evaluación Educativa %' OR
    Titulo like '%tercer estudio regional comparativo y explicativo%' OR
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

    Encabezado LIKE '% INEE %' OR
    Encabezado LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Encabezado Like '%Instituto Nacional de Evaluación Educativa %' OR
    Encabezado like '%tercer estudio regional comparativo y explicativo%' OR
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
    
    PieFoto LIKE '% INEE %' OR
    PieFoto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    PieFoto Like '%Instituto Nacional de Evaluación Educativa %' OR
    PieFoto like '%tercer estudio regional comparativo y explicativo%' OR
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
UNION
SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasSemana n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
  n.Activo = 1 AND
  fecha = (SELECT DATE_FORMAT(CURDATE() -1,'%Y-%m-%d')) AND (
    Texto LIKE '% INEE %' OR
    Texto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Texto Like '%Instituto Nacional de Evaluación Educativa %' OR
    Texto like '%tercer estudio regional comparativo y explicativo%' OR
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

    Titulo LIKE '% INEE %' OR
    Titulo LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Titulo Like '%Instituto Nacional de Evaluación Educativa %' OR
    Titulo like '%tercer estudio regional comparativo y explicativo%' OR
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

    Encabezado LIKE '% INEE %' OR
    Encabezado LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    Encabezado Like '%Instituto Nacional de Evaluación Educativa %' OR
    Encabezado like '%tercer estudio regional comparativo y explicativo%' OR
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
    
    PieFoto LIKE '% INEE %' OR
    PieFoto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
    PieFoto Like '%Instituto Nacional de Evaluación Educativa %' OR
    PieFoto like '%tercer estudio regional comparativo y explicativo%' OR
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
";
$buscar = array(
    " INEE ",
    "(INEE)",
    " (INEE)",
    "Instituto Nacional para la Evaluacion de la Educacion",
    "Instituto Naciónal para la Evaluación de la Educación",
    "Instituto Nacional para la Evaluación Educativa",
    "Instituto Nacional de Evaluación Educativa",
    "Instituto Nacional para la Evaluación de la Educación",
    "Margarita Zorrilla Fierro",
    "Margarita Zorrilla",
    "Zorrilla Fierro",
    "Eduardo Backhoff Escudero",
    "Backhoff Escudero",
    "Sylvia Schmelkes del Valle",
    "Sylvia Schmelkes Del Valle",
    "Schmelkes del Valle",
    "Schmelkes Del Valle",
    "Sylvia Schmelkes"
);

$mensaje .= recuperaDatosWEB($qryINEEWEB, $titulo = "INEE - Instituto Nacional para la Evaluación de la Educación", $buscar );

//QUERY PARA Reforma Educativa
$qryReformaEducativa = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Reforma Educativa%' OR
        Titulo LIKE '%Reforma Educativa%' OR
        Encabezado LIKE '%Reforma Educativa%'
    )
GROUP BY Periodico
ORDER BY o.posicion";
$buscar = array(
        "Reforma Educativa",
        "reforma educativa",
        "Reforma educativa",
);
// $mensaje .= recuperaDatos($qryReformaEducativa, $titulo = "Reforma Educativa", $buscar );

//QUERY PARA Reforma Educativa
$qryReformaEducativaLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Reforma Educativa%' OR
        Titulo LIKE '%Reforma Educativa%' OR
        Encabezado LIKE '%Reforma Educativa%'
    )
ORDER BY o.posicion";
$buscar = array(
        "Reforma Educativa",
        "reforma educativa",
        "Reforma educativa",
);
$mensaje .= recuperaDatosLINKS($qryReformaEducativaLINKS, $titulo = "Reforma Educativa", $buscar );

//QUERY PARA Reforma Educativa
$qryReformaEducativaWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Reforma Educativa%' OR
        Titulo LIKE '%Reforma Educativa%' OR
        Encabezado LIKE '%Reforma Educativa%'
    )
UNION
SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
  n.Activo = 1 AND
  fecha = (SELECT DATE_FORMAT(CURDATE() -1,'%Y-%m-%d')) AND (
        Texto LIKE '%Reforma Educativa%' OR
        Titulo LIKE '%Reforma Educativa%' OR
        Encabezado LIKE '%Reforma Educativa%'
    )
";
$buscar = array(
        "Reforma Educativa",
        "reforma educativa",
        "Reforma educativa",
);


$mensaje .= recuperaDatosWEB($qryReformaEducativaWEB, $titulo = "Reforma Educativa", $buscar );

//QUERY SEN
$qrySEN = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE 'SEN' OR
        Texto LIKE '%Sistema Educativo Nacional%' OR
        Titulo LIKE 'SEN' OR
        Titulo LIKE '%Sistema Educativo Nacional%' OR
        Encabezado LIKE 'SEN' OR
        Encabezado LIKE '%Sistema Educativo Nacional%'
    )
ORDER BY o.posicion";
$buscar = array(
        "Sistema Educativo Nacional",
        " SEN "
);

// $mensaje .= recuperaDatos($qrySEN, $titulo = "SEN - Sistema Educativo Nacional", $buscar );
//QUERY PARA Reforma Educativa
$qrySENLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SEN' OR
        Texto LIKE '%Sistema Educativo Nacional%' OR
        Titulo LIKE 'SEN' OR
        Titulo LIKE '%Sistema Educativo Nacional%' OR
        Encabezado LIKE 'SEN' OR
        Encabezado LIKE '%Sistema Educativo Nacional%'
    )
ORDER BY o.posicion";
//$mensaje .= recuperaDatosLINKS($qrySENLINKS, $titulo = "SEN - Sistema Educativo Nacional", $buscar );

//QUERY SEN
$qrySEN = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE 'SEN' OR
        Texto LIKE '%Sistema Educativo Nacional%' OR
        Titulo LIKE 'SEN' OR
        Titulo LIKE '%Sistema Educativo Nacional%' OR
        Encabezado LIKE 'SEN' OR
        Encabezado LIKE '%Sistema Educativo Nacional%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Sistema Educativo Nacional",
        " SEN "
);

$mensaje .= recuperaDatosWEB($qrySEN, $titulo = "SEN - Sistema Educativo Nacional", $buscar );


//QUERY PARA   SNEE  
$qrySNEE = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SNEE' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE 'SNEE' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE 'SNEE' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    )
ORDER BY o.posicion";
$buscar = array(" SNEE ","Sistema Nacional de Evaluacion Educativa");

// $mensaje .= recuperaDatos($qrySNEE, $titulo = "SNEE - Sistema Nacional de Evaluación Educativa", $buscar );
$qrySNEELINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SNEE' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE 'SNEE' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE 'SNEE' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    )
ORDER BY o.posicion";
$buscar = array(
        "Reforma Educativa",
        "reforma educativa",
        "Reforma educativa",
);
//$mensaje .= recuperaDatosLINKS($qrySNEELINKS, $titulo = "SNEE - Sistema Nacional de Evaluación Educativa", $buscar );

//QUERY PARA SNEE  
$qrySNEEWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SNEE' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE 'SNEE' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE 'SNEE' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(" SNEE ","Sistema Nacional de Evaluacion Educativa");

$mensaje .= recuperaDatosWEB($qrySNEEWEB, $titulo = "SNEE - Sistema Nacional de Evaluación Educativa", $buscar );

//QUERY PARA PNEE
$qryPNEE = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Politica Nacional de Evaluacion Educativa%'
     )
ORDER BY o.posicion";
$buscar = array(
        " PNEE ",
        " Politica Nacional de Evaluacion Educativa ",
);
// $mensaje .= recuperaDatos($qryPNEE, $titulo = "PNEE - Política Naciónal de Evaluación Educativa", $buscar );
$qryPNEELINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Politica Nacional de Evaluacion Educativa%'
     )
ORDER BY o.posicion";
//$mensaje .= recuperaDatosLINKS($qryPNEELINKS, $titulo = "SNEE - Sistema Nacional de Evaluación Educativa", $buscar );

//QUERY PARA PNEE
$qryPNEEWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Politica Nacional de Evaluacion Educativa%'
     )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        " PNEE ",
        " Politica Nacional de Evaluacion Educativa ",
);


$mensaje .= recuperaDatosWEB($qryPNEEWEB, $titulo = "SNEE - Sistema Nacional de Evaluación Educativa", $buscar );




//QUERY PARA SPD
$qrySPD = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR

        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR

        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
    )
ORDER BY o.posicion";
$buscar = array(
    "Servicio Profesional Docente",
    " SPD "
    );

// $mensaje .= recuperaDatos($qrySPD, $titulo = "SPD - Servicio Profesional Docente", $buscar );
$qrySPDLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR

        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR

        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
    )
ORDER BY o.posicion";
$buscar = array(
    "Servicio Profesional Docente",
    " SPD "
    );
//$mensaje .= recuperaDatosLINKS($qrySPDLINKS, $titulo = "SPD - Servicio Profesional Docente", $buscar );



//QUERY PARA SPD
$qrySPDWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR

        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR

        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
    "Servicio Profesional Docente",
    " SPD "
    );

$mensaje .= recuperaDatosWEB($qrySPDWEB, $titulo = "SPD - Servicio Profesional Docente", $buscar );


// Query para PRUEBA
$qryPRUEBA = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%prueba enlace%' OR
        Texto LIKE '%prueba excale%' OR
        Texto LIKE '%prueba pisa%' OR
        Texto LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Texto LIKE '%Programme for International Student Assessment%' OR
        Texto LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Texto LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Titulo LIKE '%prueba enlace%' OR
        Titulo LIKE '%prueba excale%' OR
        Titulo LIKE '%prueba pisa%' OR
        Titulo LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Titulo LIKE '%Programme for International Student Assessment%' OR
        Titulo LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Titulo LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Encabezado LIKE '%prueba enlace%' OR
        Encabezado LIKE '%prueba excale%' OR
        Encabezado LIKE '%prueba pisa%' OR
        Encabezado LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Encabezado LIKE '%Programme for International Student Assessment%' OR
        Encabezado LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Encabezado LIKE '%Examen de la Calidad y el Logro Educativo%'
    )
ORDER BY o.posicion";
$buscar = array(
        "prueba enlace",
        "prueba excale",
        "prueba pisa",
        "Evaluacion Nacional de Logro Academico en Centros Escolares",
        "Programme for International Student Assessment",
        "Programa para la Evaluacion Internacional de los Estudiantes",
        "Examen de la Calidad y el Logro Educativo",
    );
// $mensaje .= recuperaDatos($qryPRUEBA, $titulo = "INEE - PRUEBA", $buscar );

$qryPRUEBALINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%prueba enlace%' OR
        Texto LIKE '%prueba excale%' OR
        Texto LIKE '%prueba pisa%' OR
        Texto LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Texto LIKE '%Programme for International Student Assessment%' OR
        Texto LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Texto LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Titulo LIKE '%prueba enlace%' OR
        Titulo LIKE '%prueba excale%' OR
        Titulo LIKE '%prueba pisa%' OR
        Titulo LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Titulo LIKE '%Programme for International Student Assessment%' OR
        Titulo LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Titulo LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Encabezado LIKE '%prueba enlace%' OR
        Encabezado LIKE '%prueba excale%' OR
        Encabezado LIKE '%prueba pisa%' OR
        Encabezado LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Encabezado LIKE '%Programme for International Student Assessment%' OR
        Encabezado LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Encabezado LIKE '%Examen de la Calidad y el Logro Educativo%'
    )
ORDER BY o.posicion";

//$mensaje .= recuperaDatosLINKS($qryPRUEBA,$qryPRUEBALINKS, $titulo = "INEE - PRUEBA", $buscar );


// Query para PRUEBA
$qryPRUEBAWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
   n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
  n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%prueba enlace%' OR
        Texto LIKE '%prueba excale%' OR
        Texto LIKE '%prueba pisa%' OR
        Texto LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Texto LIKE '%Programme for International Student Assessment%' OR
        Texto LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Texto LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Titulo LIKE '%prueba enlace%' OR
        Titulo LIKE '%prueba excale%' OR
        Titulo LIKE '%prueba pisa%' OR
        Titulo LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Titulo LIKE '%Programme for International Student Assessment%' OR
        Titulo LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Titulo LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Encabezado LIKE '%prueba enlace%' OR
        Encabezado LIKE '%prueba excale%' OR
        Encabezado LIKE '%prueba pisa%' OR
        Encabezado LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Encabezado LIKE '%Programme for International Student Assessment%' OR
        Encabezado LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Encabezado LIKE '%Examen de la Calidad y el Logro Educativo%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "prueba enlace",
        "prueba excale",
        "prueba pisa",
        "Evaluacion Nacional de Logro Academico en Centros Escolares",
        "Programme for International Student Assessment",
        "Programa para la Evaluacion Internacional de los Estudiantes",
        "Examen de la Calidad y el Logro Educativo",
    );
$mensaje .= recuperaDatosWEB($qryPRUEBAWEB, $titulo = "INEE - PRUEBAS", $buscar );




/*

 

//QUERY para Evaluacion Educativa/ evaluacion para la educacion
$qryEvaluacion = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Evaluacion educativa%' OR
        Texto LIKE '%Evaluacion de la educacion%' OR

        Titulo LIKE '%Evaluacion educativa%' OR
        Titulo LIKE '%Evaluacion de la educacion%' OR

        Encabezado LIKE '%Evaluacion educativa%' OR
        Encabezado LIKE '%Evaluacion de la educacion%'
    )
ORDER BY o.posicion";
$buscar = array(
        "Evaluacion Educativa",
        "Evaluacion de la Educacion"
    );
// $mensaje .= recuperaDatos($qryEvaluacion, $titulo = "Evaluación de la Educación", $buscar );


$qryEvaluacionLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Evaluacion educativa%' OR
        Texto LIKE '%Evaluacion de la educacion%' OR

        Titulo LIKE '%Evaluacion educativa%' OR
        Titulo LIKE '%Evaluacion de la educacion%' OR

        Encabezado LIKE '%Evaluacion educativa%' OR
        Encabezado LIKE '%Evaluacion de la educacion%'
    )
ORDER BY o.posicion";

$mensaje .= recuperaDatosLINKS($qryEvaluacionLINKS,$qryEvaluacionLINKS, $titulo = "Evaluación de la Educación", $buscar );


//QUERY para Evaluacion Educativa/ evaluacion para la educacion
$qryEvaluacionWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Evaluacion educativa%' OR
        Texto LIKE '%Evaluacion de la educacion%' OR

        Titulo LIKE '%Evaluacion educativa%' OR
        Titulo LIKE '%Evaluacion de la educacion%' OR

        Encabezado LIKE '%Evaluacion educativa%' OR
        Encabezado LIKE '%Evaluacion de la educacion%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Evaluacion Educativa",
        "Evaluacion de la Educacion"
    );
$mensaje .= recuperaDatosWEB($qryEvaluacionWEB, $titulo = "", $buscar ); 
 
 *  */



//QUERY para CONFERENCIA DEL SISTEMA NACIONAL DE EVALUACIÓN EDUCATIVA      
$qryCONFERENCIA = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    ) 
ORDER BY o.posicion";
$buscar = array(
        "Conferencia del Sistema Nacional de Evaluacion Educativa",
        "Sistema Nacional de Evaluacion Educativa"
    );
// $mensaje .= recuperaDatos($qryCONFERENCIA, $titulo = "Conferencia del Sistema Nacional de Evaluación Educativa", $buscar );
$qryConferenciaLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    ) 
ORDER BY o.posicion";

//$mensaje .= recuperaDatosLINKS($qryConferenciaLINKS,$qryConferenciaLINKS, $titulo = "Conferencia del Sistema Nacional de Evaluacion Educativa", $buscar );


//QUERY para CONFERENCIA DEL SISTEMA NACIONAL DE EVALUACIÓN EDUCATIVA      
$qryCONFERENCIAWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    ) 
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Conferencia del Sistema Nacional de Evaluacion Educativa",
        "Sistema Nacional de Evaluacion Educativa"
    );
$mensaje .= recuperaDatosWEB($qryCONFERENCIAWEB, $titulo = "Conferencia del Sistema Nacional de Evaluación Educativa", $buscar );




//QUERY para Consejo Social Consultivo de Evaluacion de la Educacion    
$qryConsejo = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Texto LIKE '%CONSCEE%' OR

        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Titulo LIKE '%CONSCEE%' OR

        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Encabezado LIKE '%CONSCEE%'
    ) 
ORDER BY o.posicion";
$buscar = array(
        "CONSCEE",
        "Consejo Social Consultivo de Evaluacion de la Educacion"
    );
// $mensaje .= recuperaDatos($qryConsejo, $titulo = "CONSCEE - Consejo Social Consultivo de Evaluacion de la Educacion", $buscar );
$qryConsejoLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Texto LIKE '%CONSCEE%' OR

        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Titulo LIKE '%CONSCEE%' OR

        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Encabezado LIKE '%CONSCEE%'
    ) 
ORDER BY o.posicion";

//$mensaje .= recuperaDatosLINKS($qryConsejoLINKS,$qryConsejoLINKS, $titulo = "Consejo Social Consultivo de Evaluacion de la Educacion", $buscar );

//QUERY para Consejo Social Consultivo de Evaluacion de la Educacion    
$qryConsejoWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
    n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Texto LIKE '%CONSCEE%' OR

        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Titulo LIKE '%CONSCEE%' OR

        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Encabezado LIKE '%CONSCEE%'
    ) 
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CONSCEE",
        "Consejo Social Consultivo de Evaluacion de la Educacion"
    );
$mensaje .= recuperaDatosWEB($qryConsejoWEB, $titulo = "Consejo Social Consultivo de Evaluación de la Educación", $buscar );




//QUERY para Consejo de Vinculacion con las Entidades Federativas      
$qryVinculacion = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Texto LIKE 'CONVIE' OR

        Titulo LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Titulo LIKE 'CONVIE' OR

        Encabezado LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Encabezado LIKE 'CONVIE'
    )
ORDER BY o.posicion";
$buscar = array(
        "CONVIE",
        "Consejo de Vinculacion con las Entidades Federativas"
    );
// $mensaje .= recuperaDatos($qryVinculacion, $titulo = "CONVIE - Consejo de Vinculacion con las Entidades Federativas", $buscar );
$qryConsejoVinculacionLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Texto LIKE 'CONVIE' OR

        Titulo LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Titulo LIKE 'CONVIE' OR

        Encabezado LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Encabezado LIKE 'CONVIE'
    )
ORDER BY o.posicion";

//$mensaje .= recuperaDatosLINKS($qryConsejoVinculacionLINKS,$qryConsejoVinculacionLINKS, $titulo = "Consejo de Vinculacion con las Entidades Federativas", $buscar );


//QUERY para Consejo de Vinculacion con las Entidades Federativas      
$qryVinculacionWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
    n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Texto LIKE 'CONVIE' OR

        Titulo LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Titulo LIKE 'CONVIE' OR

        Encabezado LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Encabezado LIKE 'CONVIE'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CONVIE",
        "Consejo de Vinculacion con las Entidades Federativas"
    );
$mensaje .= recuperaDatosWEB($qryVinculacionWEB, $titulo = "Consejo de Vinculación con las Entidades Federativas", $buscar );




//QUERY para  Consejo Pedagogico de Evaluacion Educativa
$qryPedagogico = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Texto LIKE 'CONPEE' OR

        Titulo LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Titulo LIKE 'CONPEE' OR

        Encabezado LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Encabezado LIKE 'CONPEE'
    )
ORDER BY o.posicion";
$buscar = array(
        "CONPEE",
        "Consejo Pedagogico de Evaluacion Educativa"
    );
// $mensaje .= recuperaDatos($qryPedagogico, $titulo = "CONPEE - Consejo Pedagogico de Evaluacion Educativa", $buscar );
$qryConsejoPedagogicoLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Texto LIKE 'CONPEE' OR

        Titulo LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Titulo LIKE 'CONPEE' OR

        Encabezado LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Encabezado LIKE 'CONPEE'
    )
ORDER BY o.posicion";

//$mensaje .= recuperaDatosLINKS($qryConsejoPedagogicoLINKS,$qryConsejoPedagogicoLINKS, $titulo = "Consejo Pedagogico de Evaluacion Educativa", $buscar );


//QUERY para  Consejo Pedagogico de Evaluacion Educativa
$qryPedagogicoWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Texto LIKE 'CONPEE' OR

        Titulo LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Titulo LIKE 'CONPEE' OR

        Encabezado LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Encabezado LIKE 'CONPEE'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CONPEE",
        "Consejo Pedagogico de Evaluacion Educativa"
    );
$mensaje .= recuperaDatosWEB($qryPedagogicoWEB, $titulo = "Consejo Pedagogico de Evaluacion Educativa", $buscar );



//QUERY para Consejos Tecnicos Especializados
$qryTecnicos = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Consejos Tecnicos Especializados%' OR
        Texto LIKE 'CONTE' OR

        Titulo LIKE '%Consejos Tecnicos Especializados%' OR
        Titulo LIKE 'CONTE' OR

        Encabezado LIKE '%Consejos Tecnicos Especializados%' OR
        Encabezado LIKE 'Consejos Tecnicos Especializados'
    )
ORDER BY o.posicion";
$buscar = array(
        "CONTE",
        "Consejos Tecnicos Especializados"
    );
// $mensaje .= recuperaDatos($qryTecnicos, $titulo = "CONTE - Consejos Tecnicos Especializados", $buscar );
$qryTecnicosLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejos Tecnicos Especializados%' OR
        Texto LIKE 'CONTE' OR

        Titulo LIKE '%Consejos Tecnicos Especializados%' OR
        Titulo LIKE 'CONTE' OR

        Encabezado LIKE '%Consejos Tecnicos Especializados%' OR
        Encabezado LIKE 'Consejos Tecnicos Especializados'
    )
ORDER BY o.posicion";

//$mensaje .= recuperaDatosLINKS($qryTecnicosLINKS,$qryTecnicosLINKS, $titulo = "Consejos Tecnicos Especializados", $buscar );



//QUERY para Consejos Tecnicos Especializados
$qryTecnicosWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Consejos Tecnicos Especializados%' OR
        Texto LIKE 'CONTE' OR

        Titulo LIKE '%Consejos Tecnicos Especializados%' OR
        Titulo LIKE 'CONTE' OR

        Encabezado LIKE '%Consejos Tecnicos Especializados%' OR
        Encabezado LIKE 'Consejos Tecnicos Especializados'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CONTE",
        "Consejos Tecnicos Especializados"
    );
$mensaje .= recuperaDatosWEB($qryTecnicosWEB, $titulo = "Consejos Tecnicos Especializados", $buscar );



//QUERY para Secretaria de Educacion Publica
$qrySEP = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE 'SEP' OR
        Texto LIKE '%Secretaria de Educacion Publica%' OR

        Titulo LIKE 'SEP' OR
        Titulo LIKE '%Secretaria de Educacion Publica%' OR

        Encabezado LIKE 'SEP' OR
        Encabezado LIKE '%Secretaria de Educacion Publica%'
        )
ORDER BY o.posicion";
$buscar = array(
        "Secretaria de Educacion Publica",
        "Secretaria de Educacion Pública",
        "Secretaría de Educación Pública",
        "SEP"
    );
// $mensaje .= recuperaDatos($qrySEP, $titulo = "SEP - Secretaria de Educación Pública", $buscar );
$qrySEPLINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SEP' OR
        Texto LIKE '%Secretaria de Educacion Publica%' OR

        Titulo LIKE 'SEP' OR
        Titulo LIKE '%Secretaria de Educacion Publica%' OR

        Encabezado LIKE 'SEP' OR
        Encabezado LIKE '%Secretaria de Educacion Publica%'
        )
ORDER BY o.posicion";

//$mensaje .= recuperaDatosLINKS($qrySEPLINKS,$qrySEPLINKS, $titulo = "SEP", $buscar );


//QUERY para Secretaria de Educacion Publica
$qrySEPWeb = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE 'SEP' OR
        Texto LIKE '%Secretaria de Educacion Publica%' OR

        Titulo LIKE 'SEP' OR
        Titulo LIKE '%Secretaria de Educacion Publica%' OR

        Encabezado LIKE 'SEP' OR
        Encabezado LIKE '%Secretaria de Educacion Publica%'
        )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Secretaria de Educacion Publica",
        "Secretaria de Educacion Pública",
        "Secretaría de Educación Pública",
        "Secretaría de Educación Pública",
        "SEP"
    );
$mensaje .= recuperaDatosWEB($qrySEPWeb, $titulo = "SEP", $buscar );



//QUERY para SNTE
$qrySNTE = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
	Texto LIKE 'SNTE' OR
	Texto LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
		
	Titulo LIKE 'SNTE' OR
	Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
	
	Encabezado LIKE 'SNTE' OR
	Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educacion%'
)
GROUP BY Periodico,PaginaPeriodico
ORDER BY o.posicion";
$buscar = array(
        "SNTE",
        "Sindicato Nacional de Trabajadores de la Educación"
    );
// $mensaje .= recuperaDatos($qrySNTE, $titulo = "SNTE - Sindicato Naciónal de Trabajadores de la Educación", $buscar );
$qrySNTELINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
	Texto LIKE 'SNTE' OR
	Texto LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
		
	Titulo LIKE 'SNTE' OR
	Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
	
	Encabezado LIKE 'SNTE' OR
	Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educacion%'
)
ORDER BY o.posicion";
//$mensaje .= recuperaDatosLINKS($qrySNTELINKS,$qrySNTELINKS, $titulo = "SNTE", $buscar );


//QUERY para SNTE
$qrySNTEWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
	Texto LIKE 'SNTE' OR
	Texto LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
		
	Titulo LIKE 'SNTE' OR
	Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
	
	Encabezado LIKE 'SNTE' OR
	Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educacion%'
)
UNION
SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = (SELECT DATE_FORMAT(CURDATE() -1,'%Y-%m-%d')) AND(
	Texto LIKE 'SNTE' OR
	Texto LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
		
	Titulo LIKE 'SNTE' OR
	Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
	
	Encabezado LIKE 'SNTE' OR
	Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educacion%'
)
";
$buscar = array(
        "SNTE",
        "Sindicato Nacional de Trabajadores de la Educación"
    );
$mensaje .= recuperaDatosWEB($qrySNTEWEB, $titulo = "SNTE", $buscar );



//QUERY para CNTE
$qryCNTE = "SELECT
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
  p.idPeriodico in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
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
        GROUP BY Periodico,PaginaPeriodico
ORDER BY o.posicion";
$buscar = array(
        "CNTE",
        "Coordinadora Nacional de Trabajadores de la Educación"
    );
// $mensaje .= recuperaDatos($qryCNTE, $titulo = "CNTE - Coordinadora Naciónal de Trabajadores de la Educación", $buscar );
$qryCNTELINKS = "SELECT
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg'
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
  p.idPeriodico not in (50,32,59,51,53,97) AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND
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
ORDER BY o.posicion";
//$mensaje .= recuperaDatosLINKS($qryCNTELINKS,$qryCNTELINKS, $titulo = "CNTE", $buscar );



//QUERY para CNTE
$qryCNTEWEB = "SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
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
UNION
SELECT
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
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = (SELECT DATE_FORMAT(CURDATE() -1,'%Y-%m-%d')) AND(
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
";

$buscar = array(
        "CNTE",
        "Coordinadora Nacional de Trabajadores de la Educación"
    );
$mensaje .= recuperaDatosWEB($qryCNTEWEB, $titulo = "CNTE", $buscar );




$mensaje.='
</table>
</body>
</html>';

echo $mensaje;
?>


<?php
function recuperaDatosWEB($sql, $titulo, $buscar = array())
{
  $urlP = "http://187.247.253.5";
            $mensaje.='
              <tr>
                <th colspan="3" style="font-family: Arial Narrow; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;text-align:"center">'.utf8_decode($titulo).'</th>
             </tr>';

  $result =  mysql_query($sql);
  if(mysql_affected_rows() > 0)
  {
      while ( $row = mysql_fetch_array($result) ) 
        {
        $texto=  textMatchV2($row['Texto'], $buscar);
          //$texto=$row['Texto'];
        $texto = correctorOrtografico(($texto));
        $texto = ( !empty($buscar) )? highlight( $texto  , $buscar) :  $texto ; 

        //$texto = ( !empty($buscar) )? EncuentraArreglo($texto,$buscar) : $texto;

        $periodico = correctorOrtografico( $row['Periodico'] );
        $periodico = ( !empty($buscar) )? highlight( $periodico, $buscar) : $periodico;

        $autor = '';
        switch( strtolower($periodico) )
        {
                case "Excelsior":
                    $periodico = "Excélsior";
                    $autor="Excélsior";
                break;
            
                case "El milenio Nacional":
                    $periodico = "Milenio";
                    $autor="Milenio";
                break;

                case "El Reforma":
                    $periodico = "Reforma";
                    $autor="Reforma";
                break;

                case "La Razon":
                    $periodico = "La Razón";
                    $autor="La Razón";
                break;

                case "La Cronica":
                    $periodico = "La Crónica";
                    $autor="La Crónica";
                break;
            
                case "el sol de mexico":
                    $periodico = "El Sol de México";
                    $autor="El Sol de México";
                break;
            
                case "Reporte Indigo Df":
                    $periodico = "Reporte Índigo";
                    $autor="Reporte Índigo";
                break;
            
                case "Punto critico":
                    $periodico = "Punto Crítico";
                    $autor="Punto Crítico";
                break;
            
                case "la prensa":
                    $periodico = "La Prensa";
                    $autor="La Prensa";
                break;
            
                case "Mundo expres":
                    $periodico = "Mundo Expres";
                    $autor="Mundo Expres";
                break;
              }


        $titulo = correctorOrtografico( $row['Titulo'] );
        $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;

        $encabezado =$row['LINK'];
        $mensaje .='
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                  <strong>'.$periodico.":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                </td>
              </tr>
              <tr>&nbsp;</tr>
              <tr>
                <td colspan="3">
                  <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$encabezado.'" target="_blank">Ir a la Nota</a></span>
                </td>
              </tr>'; 
        
        
      }        
      
  }
  else{
  } 
  return $mensaje;
}

function recuperaDatos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";

    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        $mensaje.='
                  <tr>
                    <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.utf8_decode($titulo).'</th>
                 </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {
            $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
            $texto = correctorOrtografico(($texto));
            $texto = ( !empty($buscar) )? highlight( $texto  , $buscar) :  $texto ; 

            $periodico = correctorOrtografico( $row['Periodico'] );
            $periodico = ( !empty($buscar) )? highlight( $periodico, $buscar) : $periodico;

            $autor = '';
            switch( ($periodico) )
            {
                  case "Excelsior":
                      $periodico = "Excélsior";
                      $autor="Excélsior";
                  break;

                  case "El milenio Nacional":
                      $periodico = "Milenio";
                      $autor="Milenio";
                  break;

                  case "El Reforma":
                      $periodico = "Reforma";
                      $autor="Reforma";
                  break;

                  case "La Razon":
                      $periodico = "La Razón";
                      $autor="La Razón";
                  break;

                  case "La Cronica":
                      $periodico = "La Crónica";
                      $autor="La Crónica";
                  break;

                  case "el sol de mexico":
                      $periodico = "El Sol de México";
                      $autor="El Sol de México";
                  break;

                  case "Reporte Indigo Df":
                      $periodico = "Reporte Índigo";
                      $autor="Reporte Índigo";
                  break;

                  case "Punto critico":
                      $periodico = "Punto Crítico";
                      $autor="Punto Crítico";
                  break;

                  case "la prensa":
                      $periodico = "La Prensa";
                      $autor="La Prensa";
                  break;

                  case "Mundo expres":
                      $periodico = "Mundo Expres";
                      $autor="Mundo Expres";
                  break;
                }


            $titulo = correctorOrtografico( $row['Titulo'] );
            $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;

            $encabezado = correctorOrtografico( $row['Encabezado'] );
            $encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;

            $mensaje .='
                    <tr>
                      <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($encabezado))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                        <strong>'.utf8_decode($periodico).":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                    </td>
                    </tr>
                <tr>&nbsp;</tr>
                <tr>
                  <td colspan="3">
                     '.recorte($row['idEditorial']).'<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>
                 <tr style="height: 10px;">
                <td colspan="3"></td>
                  </tr>'; 
        }        
    }
    return $mensaje;
}

function recuperaDatosLINKS($sqlBase,$sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
     //$urlP = "http://192.168.3.154";
    
    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        
        $result =  mysql_query($sql);
        while ( $row = mysql_fetch_array($result) ) 
        {


           $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
          $texto = correctorOrtografico(($texto));
          $texto = ( !empty($buscar) )? highlight( $texto  , $buscar) :  $texto ; 

          $periodico = correctorOrtografico( $row['Periodico'] );
          $periodico = ( !empty($buscar) )? highlight( $periodico, $buscar) : $periodico;

          $autor = '';
          switch( ($periodico) )
          {
                  case "Excelsior":
                      $periodico = "Excélsior";
                      $autor="Excélsior";
                  break;

                  case "El milenio Nacional":
                      $periodico = "Milenio";
                      $autor="Milenio";
                  break;

                  case "El Reforma":
                      $periodico = "Reforma";
                      $autor="Reforma";
                  break;

                  case "La Razon":
                      $periodico = "La Razón";
                      $autor="La Razón";
                  break;

                  case "La Cronica":
                      $periodico = "La Crónica";
                      $autor="La Crónica";
                  break;

                  case "el sol de mexico":
                      $periodico = "El Sol de México";
                      $autor="El Sol de México";
                  break;

                  case "Reporte Indigo Df":
                      $periodico = "Reporte Índigo";
                      $autor="Reporte Índigo";
                  break;

                  case "Punto critico":
                      $periodico = "Punto Crítico";
                      $autor="Punto Crítico";
                  break;

                  case "la prensa":
                      $periodico = "La Prensa";
                      $autor="La Prensa";
                  break;

                  case "Mundo expres":
                      $periodico = "Mundo Expres";
                      $autor="Mundo Expres";
                  break;
                }


          $titulo = correctorOrtografico( $row['Titulo'] );
          $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;

          $encabezado = correctorOrtografico( $row['Encabezado'] );
          $encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;

          $mensaje .='
                <tr>
                  <td colspan="3">
                    <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>'; 
        }        

    }
    else{
  //      $mensaje.='
  //               <tr>
  //                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
  //                <th width=""></th>
  //                <th width="">&nbsp;</th>
  //              </tr>';
    } 
    return $mensaje;
}



function recorte($id)
{
    if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg"))
    {
        return '<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="http://187.247.253.5/external/services/mail/testigoCut.php?c=inee&f='.DATE('Y-m-d').'&id='.$id.'" target="_blank">Recorte </a></span> &nbsp; ';
    }else{
        
    }    
}

function highlight($cadena, $arr_palabras) {
  if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
    return false;
  }
  $str_palabras = implode ('|', $arr_palabras);
  //return preg_replace ('/'.$str_palabras.'/si', '<strong style="background-color:yellow">$1</strong>', $cadena);
  return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
}

function fecha_completa($fecha)
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

function EncuentraCoincidencias($cadenaOriginal,$valorBuscado){
    $posicion=  strpos($cadenaOriginal, $valorBuscado);
    if($posicion!==false){
        if($posicion>0){
             $nuevaCadena=  substr($cadenaOriginal, $posicion-95,$posicion+100);
            return $nuevaCadena." ... ";      
        }else{
             $nuevaCadena=  substr($cadenaOriginal, $posicion,$posicion+100);
            return $nuevaCadena."...";      
        }
    }else if($posicion===false){
        return false;
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
      return wordlimit($cadena)." ... ";
    }
    else
    {
      return wordlimit($cadenaOriginal)." ... ";
    } 
}

function wordlimit($string, $length = 70)
{
    $words = explode(' ', $string);
    if (count($words) > $length)
    {
            return implode(' ', array_slice($words, 0, $length+5))." ... ";
    }
    else
    {
            return $string;
    }
}

function textMatchV2($cadena,$criterio) {
    // Salida
    $output = array();

    // Separacion de parrafos
    preg_match_all("#(.*)\.#U",$cadena,$multiMatch);

    if(count($multiMatch[0])>0) {
        for ($i=0; $i < count($multiMatch[0]); $i++) {
            for ($y=0; $y < count($criterio); $y++) {
                if(preg_match("/".$criterio[$y]."/i",preg_quote($multiMatch[0][$i]))===1) {
                    $output[] = $multiMatch[0][$i];
                    break;
                }
            }
        }
    }

    if(count($output)<1) $output = $cadena;

    return (is_array($output) ? implode("(...) ", $output) : $output);
}

function sanear_string2($url) {
 
 
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

function correctorOrtografico($cadena)
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


?>