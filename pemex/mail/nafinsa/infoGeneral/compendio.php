<?php 
	ignore_user_abort(true);
	set_time_limit(0);

	include "/var/www/external/services/mail/conexion.php";
	$fecha = date('Y-m-d');
	require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  		require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  		$query= "SELECT * FROM (

(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CREN as CREN,
	n.CostoNota,
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
	p.idPeriodico in (32) AND
	n.Categoria not in (1,3,19,20,21) AND 
	n.Activo = 1 AND
	fecha = CURDATE() AND (
		Texto like '%Banca de desarrollo%' OR
		Texto like '%Banca Comercial%' OR
		Texto like '%Asociacion de bancos de mexico%' OR
		Texto like '%Banco de mexico%' OR
		Texto like '%IEPS%' OR
		Texto like '%impuesto especial sobre produccion y servicios%' OR
		Texto like '%Gasolina%' OR
		Texto like '%Pemex%' OR
		Texto like '%SHCP%' OR
		Texto like '%secretaria de hacienda y credito publico%' OR
		Texto like '%Miguel Angel Osorio Chong%' OR
		Texto like '%Miguel Angel Osorio%' OR
		Texto like '%Miguel Osorio Chong%' OR
		Texto like '%Osorio Chong%' OR
		Texto like '% OCDE %' OR
		Texto like '% CCE %' OR
		Texto like '% ZEE %' OR
		Texto like '%Moody%' OR
		Texto like '%Raul cervantes andrade%' OR
		Texto like '%Raul cervantes%' OR
		Texto like '%cervantes andrade%' OR
		Texto like '%Camara de diputados%' OR
		Texto like '%Senado de la republica%' OR
		Texto like '%Congreso de la union%' OR
		Texto like '% PIB %' OR
		Texto like '%producto interno bruto%' OR
		Texto like '%inflacion%' OR
		Texto like '%tipo de cambio%' OR
		Texto like '%Luis Videgaray Caso%' OR
		Texto like '%Videgaray Caso%' OR
		Texto like '%Idelfonso guajardo%' OR
		Texto like '%Gerardo ruiz esparza%' OR
		Texto like '% CEESP %' OR
		Texto like '% CONSAR %' OR
		#Texto like '%Pobreza%' OR

		Titulo like '%Banca de desarrollo%' OR
		Titulo like '%Banca Comercial%' OR
		Titulo like '%Asociacion de bancos de mexico%' OR
		Titulo like '%Banco de mexico%' OR
		Titulo like '%IEPS%' OR
		Titulo like '%impuesto especial sobre produccion y servicios%' OR
		Titulo like '%Gasolina%' OR
		Titulo like '%Pemex%' OR
		Titulo like '%SHCP%' OR
		Titulo like '%secretaria de hacienda y credito publico%' OR
		Titulo like '%Miguel Angel Osorio Chong%' OR
		Titulo like '%Miguel Angel Osorio%' OR
		Titulo like '%Miguel Osorio Chong%' OR
		Titulo like '%Osorio Chong%' OR
		Titulo like '% OCDE %' OR
		Titulo like '% CCE %' OR
		Titulo like '% ZEE %' OR
		Titulo like '%Moody%' OR
		Titulo like '%Raul cervantes andrade%' OR
		Titulo like '%Raul cervantes%' OR
		Titulo like '%cervantes andrade%' OR
		Titulo like '%Camara de diputados%' OR
		Titulo like '%Senado de la republica%' OR
		Titulo like '%Congreso de la union%' OR
		Titulo like '% PIB %' OR
		Titulo like '%producto interno bruto%' OR
		Titulo like '%inflacion%' OR
		Titulo like '%tipo de cambio%' OR
		Titulo like '%Luis Videgaray Caso%' OR
		Titulo like '%Videgaray Caso%' OR
		Titulo like '%Idelfonso guajardo%' OR
		Titulo like '%Gerardo ruiz esparza%' OR
		Titulo like '% CEESP %' OR
		Titulo like '% CONSAR %' OR
		#Titulo like '%Pobreza%' OR

		Encabezado like '%Banca de desarrollo%' OR
		Encabezado like '%Banca Comercial%' OR
		Encabezado like '%Asociacion de bancos de mexico%' OR
		Encabezado like '%Banco de mexico%' OR
		Encabezado like '%IEPS%' OR
		Encabezado like '%impuesto especial sobre produccion y servicios%' OR
		Encabezado like '%Gasolina%' OR
		Encabezado like '%Pemex%' OR
		Encabezado like '%SHCP%' OR
		Encabezado like '%secretaria de hacienda y credito publico%' OR
		Encabezado like '%Miguel Angel Osorio Chong%' OR
		Encabezado like '%Miguel Angel Osorio%' OR
		Encabezado like '%Miguel Osorio Chong%' OR
		Encabezado like '%Osorio Chong%' OR
		Encabezado like '% OCDE %' OR
		Encabezado like '% CCE %' OR
		Encabezado like '% ZEE %' OR
		Encabezado like '%Moody%' OR
		Encabezado like '%Raul cervantes andrade%' OR
		Encabezado like '%Raul cervantes%' OR
		Encabezado like '%cervantes andrade%' OR
		Encabezado like '%Camara de diputados%' OR
		Encabezado like '%Senado de la republica%' OR
		Encabezado like '%Congreso de la union%' OR
		Encabezado like '% PIB %' OR
		Encabezado like '%producto interno bruto%' OR
		Encabezado like '%inflacion%' OR
		Encabezado like '%tipo de cambio%' OR
		Encabezado like '%Luis Videgaray Caso%' OR
		Encabezado like '%Videgaray Caso%' OR
		Encabezado like '%Idelfonso guajardo%' OR
		Encabezado like '%Gerardo ruiz esparza%' OR
		Encabezado like '% CEESP %' OR
		Encabezado like '% CONSAR %' OR
		#Encabezado like '%Pobreza%' OR

		PieFoto like '%Banca de desarrollo%' OR
		PieFoto like '%Banca Comercial%' OR
		PieFoto like '%Asociacion de bancos de mexico%' OR
		PieFoto like '%Banco de mexico%' OR
		PieFoto like '%IEPS%' OR
		PieFoto like '%impuesto especial sobre produccion y servicios%' OR
		PieFoto like '%Gasolina%' OR
		PieFoto like '%Pemex%' OR
		PieFoto like '%SHCP%' OR
		PieFoto like '%secretaria de hacienda y credito publico%' OR
		PieFoto like '%Miguel Angel Osorio Chong%' OR
		PieFoto like '%Miguel Angel Osorio%' OR
		PieFoto like '%Miguel Osorio Chong%' OR
		PieFoto like '%Osorio Chong%' OR
		PieFoto like '% OCDE %' OR
		PieFoto like '% CCE %' OR
		PieFoto like '% ZEE %' OR
		PieFoto like '%Moody%' OR
		PieFoto like '%Raul cervantes andrade%' OR
		PieFoto like '%Raul cervantes%' OR
		PieFoto like '%cervantes andrade%' OR
		PieFoto like '%Camara de diputados%' OR
		PieFoto like '%Senado de la republica%' OR
		PieFoto like '%Congreso de la union%' OR
		PieFoto like '% PIB %' OR
		PieFoto like '%producto interno bruto%' OR
		PieFoto like '%inflacion%' OR
		PieFoto like '%tipo de cambio%' OR
		PieFoto like '%Luis Videgaray Caso%' OR
		PieFoto like '%Videgaray Caso%' OR
		PieFoto like '%Idelfonso guajardo%' OR
		PieFoto like '%Gerardo ruiz esparza%' OR
		PieFoto like '% CEESP %' OR
		PieFoto like '% CONSAR %' #OR
		#PieFoto like '%Pobreza%'
    )
LIMIT 0,10 

) #REFORMA

UNION 

(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CREN as CREN,
	n.CostoNota,
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
	p.idPeriodico in (47) AND
	n.Categoria not in (1,3,19,20,21) AND 
	n.Activo = 1 AND
	fecha = CURDATE() AND (
		Texto like '%Banca de desarrollo%' OR
		Texto like '%Banca Comercial%' OR
		Texto like '%Asociacion de bancos de mexico%' OR
		Texto like '%Banco de mexico%' OR
		Texto like '%IEPS%' OR
		Texto like '%impuesto especial sobre produccion y servicios%' OR
		Texto like '%Gasolina%' OR
		Texto like '%Pemex%' OR
		Texto like '%SHCP%' OR
		Texto like '%secretaria de hacienda y credito publico%' OR
		Texto like '%Miguel Angel Osorio Chong%' OR
		Texto like '%Miguel Angel Osorio%' OR
		Texto like '%Miguel Osorio Chong%' OR
		Texto like '%Osorio Chong%' OR
		Texto like '% OCDE %' OR
		Texto like '% CCE %' OR
		Texto like '% ZEE %' OR
		Texto like '%Moody%' OR
		Texto like '%Raul cervantes andrade%' OR
		Texto like '%Raul cervantes%' OR
		Texto like '%cervantes andrade%' OR
		Texto like '%Camara de diputados%' OR
		Texto like '%Senado de la republica%' OR
		Texto like '%Congreso de la union%' OR
		Texto like '% PIB %' OR
		Texto like '%producto interno bruto%' OR
		Texto like '%inflacion%' OR
		Texto like '%tipo de cambio%' OR
		Texto like '%Luis Videgaray Caso%' OR
		Texto like '%Videgaray Caso%' OR
		Texto like '%Idelfonso guajardo%' OR
		Texto like '%Gerardo ruiz esparza%' OR
		Texto like '% CEESP %' OR
		Texto like '% CONSAR %' OR
		#Texto like '%Pobreza%' OR

		Titulo like '%Banca de desarrollo%' OR
		Titulo like '%Banca Comercial%' OR
		Titulo like '%Asociacion de bancos de mexico%' OR
		Titulo like '%Banco de mexico%' OR
		Titulo like '%IEPS%' OR
		Titulo like '%impuesto especial sobre produccion y servicios%' OR
		Titulo like '%Gasolina%' OR
		Titulo like '%Pemex%' OR
		Titulo like '%SHCP%' OR
		Titulo like '%secretaria de hacienda y credito publico%' OR
		Titulo like '%Miguel Angel Osorio Chong%' OR
		Titulo like '%Miguel Angel Osorio%' OR
		Titulo like '%Miguel Osorio Chong%' OR
		Titulo like '%Osorio Chong%' OR
		Titulo like '% OCDE %' OR
		Titulo like '% CCE %' OR
		Titulo like '% ZEE %' OR
		Titulo like '%Moody%' OR
		Titulo like '%Raul cervantes andrade%' OR
		Titulo like '%Raul cervantes%' OR
		Titulo like '%cervantes andrade%' OR
		Titulo like '%Camara de diputados%' OR
		Titulo like '%Senado de la republica%' OR
		Titulo like '%Congreso de la union%' OR
		Titulo like '% PIB %' OR
		Titulo like '%producto interno bruto%' OR
		Titulo like '%inflacion%' OR
		Titulo like '%tipo de cambio%' OR
		Titulo like '%Luis Videgaray Caso%' OR
		Titulo like '%Videgaray Caso%' OR
		Titulo like '%Idelfonso guajardo%' OR
		Titulo like '%Gerardo ruiz esparza%' OR
		Titulo like '% CEESP %' OR
		Titulo like '% CONSAR %' OR
		#Titulo like '%Pobreza%' OR

		Encabezado like '%Banca de desarrollo%' OR
		Encabezado like '%Banca Comercial%' OR
		Encabezado like '%Asociacion de bancos de mexico%' OR
		Encabezado like '%Banco de mexico%' OR
		Encabezado like '%IEPS%' OR
		Encabezado like '%impuesto especial sobre produccion y servicios%' OR
		Encabezado like '%Gasolina%' OR
		Encabezado like '%Pemex%' OR
		Encabezado like '%SHCP%' OR
		Encabezado like '%secretaria de hacienda y credito publico%' OR
		Encabezado like '%Miguel Angel Osorio Chong%' OR
		Encabezado like '%Miguel Angel Osorio%' OR
		Encabezado like '%Miguel Osorio Chong%' OR
		Encabezado like '%Osorio Chong%' OR
		Encabezado like '% OCDE %' OR
		Encabezado like '% CCE %' OR
		Encabezado like '% ZEE %' OR
		Encabezado like '%Moody%' OR
		Encabezado like '%Raul cervantes andrade%' OR
		Encabezado like '%Raul cervantes%' OR
		Encabezado like '%cervantes andrade%' OR
		Encabezado like '%Camara de diputados%' OR
		Encabezado like '%Senado de la republica%' OR
		Encabezado like '%Congreso de la union%' OR
		Encabezado like '% PIB %' OR
		Encabezado like '%producto interno bruto%' OR
		Encabezado like '%inflacion%' OR
		Encabezado like '%tipo de cambio%' OR
		Encabezado like '%Luis Videgaray Caso%' OR
		Encabezado like '%Videgaray Caso%' OR
		Encabezado like '%Idelfonso guajardo%' OR
		Encabezado like '%Gerardo ruiz esparza%' OR
		Encabezado like '% CEESP %' OR
		Encabezado like '% CONSAR %' OR
		#Encabezado like '%Pobreza%' OR

		PieFoto like '%Banca de desarrollo%' OR
		PieFoto like '%Banca Comercial%' OR
		PieFoto like '%Asociacion de bancos de mexico%' OR
		PieFoto like '%Banco de mexico%' OR
		PieFoto like '%IEPS%' OR
		PieFoto like '%impuesto especial sobre produccion y servicios%' OR
		PieFoto like '%Gasolina%' OR
		PieFoto like '%Pemex%' OR
		PieFoto like '%SHCP%' OR
		PieFoto like '%secretaria de hacienda y credito publico%' OR
		PieFoto like '%Miguel Angel Osorio Chong%' OR
		PieFoto like '%Miguel Angel Osorio%' OR
		PieFoto like '%Miguel Osorio Chong%' OR
		PieFoto like '%Osorio Chong%' OR
		PieFoto like '% OCDE %' OR
		PieFoto like '% CCE %' OR
		PieFoto like '% ZEE %' OR
		PieFoto like '%Moody%' OR
		PieFoto like '%Raul cervantes andrade%' OR
		PieFoto like '%Raul cervantes%' OR
		PieFoto like '%cervantes andrade%' OR
		PieFoto like '%Camara de diputados%' OR
		PieFoto like '%Senado de la republica%' OR
		PieFoto like '%Congreso de la union%' OR
		PieFoto like '% PIB %' OR
		PieFoto like '%producto interno bruto%' OR
		PieFoto like '%inflacion%' OR
		PieFoto like '%tipo de cambio%' OR
		PieFoto like '%Luis Videgaray Caso%' OR
		PieFoto like '%Videgaray Caso%' OR
		PieFoto like '%Idelfonso guajardo%' OR
		PieFoto like '%Gerardo ruiz esparza%' OR
		PieFoto like '% CEESP %' OR
		PieFoto like '% CONSAR %' #OR
		#PieFoto like '%Pobreza%'
    )
LIMIT 0,10
) # 


UNION 

(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CREN as CREN,
	n.CostoNota,
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
	p.idPeriodico in (50) AND
	n.Categoria not in (1,3,19,20,21) AND 
	n.Activo = 1 AND
	fecha = CURDATE() AND (
		Texto like '%Banca de desarrollo%' OR
		Texto like '%Banca Comercial%' OR
		Texto like '%Asociacion de bancos de mexico%' OR
		Texto like '%Banco de mexico%' OR
		Texto like '%IEPS%' OR
		Texto like '%impuesto especial sobre produccion y servicios%' OR
		Texto like '%Gasolina%' OR
		Texto like '%Pemex%' OR
		Texto like '%SHCP%' OR
		Texto like '%secretaria de hacienda y credito publico%' OR
		Texto like '%Miguel Angel Osorio Chong%' OR
		Texto like '%Miguel Angel Osorio%' OR
		Texto like '%Miguel Osorio Chong%' OR
		Texto like '%Osorio Chong%' OR
		Texto like '% OCDE %' OR
		Texto like '% CCE %' OR
		Texto like '% ZEE %' OR
		Texto like '%Moody%' OR
		Texto like '%Raul cervantes andrade%' OR
		Texto like '%Raul cervantes%' OR
		Texto like '%cervantes andrade%' OR
		Texto like '%Camara de diputados%' OR
		Texto like '%Senado de la republica%' OR
		Texto like '%Congreso de la union%' OR
		Texto like '% PIB %' OR
		Texto like '%producto interno bruto%' OR
		Texto like '%inflacion%' OR
		Texto like '%tipo de cambio%' OR
		Texto like '%Luis Videgaray Caso%' OR
		Texto like '%Videgaray Caso%' OR
		Texto like '%Idelfonso guajardo%' OR
		Texto like '%Gerardo ruiz esparza%' OR
		Texto like '% CEESP %' OR
		Texto like '% CONSAR %' OR

		Titulo like '%Banca de desarrollo%' OR
		Titulo like '%Banca Comercial%' OR
		Titulo like '%Asociacion de bancos de mexico%' OR
		Titulo like '%Banco de mexico%' OR
		Titulo like '%IEPS%' OR
		Titulo like '%impuesto especial sobre produccion y servicios%' OR
		Titulo like '%Gasolina%' OR
		Titulo like '%Pemex%' OR
		Titulo like '%SHCP%' OR
		Titulo like '%secretaria de hacienda y credito publico%' OR
		Titulo like '%Miguel Angel Osorio Chong%' OR
		Titulo like '%Miguel Angel Osorio%' OR
		Titulo like '%Miguel Osorio Chong%' OR
		Titulo like '%Osorio Chong%' OR
		Titulo like '% OCDE %' OR
		Titulo like '% CCE %' OR
		Titulo like '% ZEE %' OR
		Titulo like '%Moody%' OR
		Titulo like '%Raul cervantes andrade%' OR
		Titulo like '%Raul cervantes%' OR
		Titulo like '%cervantes andrade%' OR
		Titulo like '%Camara de diputados%' OR
		Titulo like '%Senado de la republica%' OR
		Titulo like '%Congreso de la union%' OR
		Titulo like '% PIB %' OR
		Titulo like '%producto interno bruto%' OR
		Titulo like '%inflacion%' OR
		Titulo like '%tipo de cambio%' OR
		Titulo like '%Luis Videgaray Caso%' OR
		Titulo like '%Videgaray Caso%' OR
		Titulo like '%Idelfonso guajardo%' OR
		Titulo like '%Gerardo ruiz esparza%' OR
		Titulo like '% CEESP %' OR
		Titulo like '% CONSAR %' OR

		Encabezado like '%Banca de desarrollo%' OR
		Encabezado like '%Banca Comercial%' OR
		Encabezado like '%Asociacion de bancos de mexico%' OR
		Encabezado like '%Banco de mexico%' OR
		Encabezado like '%IEPS%' OR
		Encabezado like '%impuesto especial sobre produccion y servicios%' OR
		Encabezado like '%Gasolina%' OR
		Encabezado like '%Pemex%' OR
		Encabezado like '%SHCP%' OR
		Encabezado like '%secretaria de hacienda y credito publico%' OR
		Encabezado like '%Miguel Angel Osorio Chong%' OR
		Encabezado like '%Miguel Angel Osorio%' OR
		Encabezado like '%Miguel Osorio Chong%' OR
		Encabezado like '%Osorio Chong%' OR
		Encabezado like '% OCDE %' OR
		Encabezado like '% CCE %' OR
		Encabezado like '% ZEE %' OR
		Encabezado like '%Moody%' OR
		Encabezado like '%Raul cervantes andrade%' OR
		Encabezado like '%Raul cervantes%' OR
		Encabezado like '%cervantes andrade%' OR
		Encabezado like '%Camara de diputados%' OR
		Encabezado like '%Senado de la republica%' OR
		Encabezado like '%Congreso de la union%' OR
		Encabezado like '% PIB %' OR
		Encabezado like '%producto interno bruto%' OR
		Encabezado like '%inflacion%' OR
		Encabezado like '%tipo de cambio%' OR
		Encabezado like '%Luis Videgaray Caso%' OR
		Encabezado like '%Videgaray Caso%' OR
		Encabezado like '%Idelfonso guajardo%' OR
		Encabezado like '%Gerardo ruiz esparza%' OR
		Encabezado like '% CEESP %' OR
		Encabezado like '% CONSAR %' OR

		PieFoto like '%Banca de desarrollo%' OR
		PieFoto like '%Banca Comercial%' OR
		PieFoto like '%Asociacion de bancos de mexico%' OR
		PieFoto like '%Banco de mexico%' OR
		PieFoto like '%IEPS%' OR
		PieFoto like '%impuesto especial sobre produccion y servicios%' OR
		PieFoto like '%Gasolina%' OR
		PieFoto like '%Pemex%' OR
		PieFoto like '%SHCP%' OR
		PieFoto like '%secretaria de hacienda y credito publico%' OR
		PieFoto like '%Miguel Angel Osorio Chong%' OR
		PieFoto like '%Miguel Angel Osorio%' OR
		PieFoto like '%Miguel Osorio Chong%' OR
		PieFoto like '%Osorio Chong%' OR
		PieFoto like '% OCDE %' OR
		PieFoto like '% CCE %' OR
		PieFoto like '% ZEE %' OR
		PieFoto like '%Moody%' OR
		PieFoto like '%Raul cervantes andrade%' OR
		PieFoto like '%Raul cervantes%' OR
		PieFoto like '%cervantes andrade%' OR
		PieFoto like '%Camara de diputados%' OR
		PieFoto like '%Senado de la republica%' OR
		PieFoto like '%Congreso de la union%' OR
		PieFoto like '% PIB %' OR
		PieFoto like '%producto interno bruto%' OR
		PieFoto like '%inflacion%' OR
		PieFoto like '%tipo de cambio%' OR
		PieFoto like '%Luis Videgaray Caso%' OR
		PieFoto like '%Videgaray Caso%' OR
		PieFoto like '%Idelfonso guajardo%' OR
		PieFoto like '%Gerardo ruiz esparza%' OR
		PieFoto like '% CEESP %' OR
		PieFoto like '% CONSAR %'
    )
LIMIT 0,10
) #El Universal


UNION 

(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CREN as CREN,
	n.CostoNota,
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
	p.idPeriodico in (51) AND
	n.Categoria not in (1,3,19,20,21) AND 
	n.Activo = 1 AND
	fecha = CURDATE() AND (
		Texto like '%Banca de desarrollo%' OR
		Texto like '%Banca Comercial%' OR
		Texto like '%Asociacion de bancos de mexico%' OR
		Texto like '%Banco de mexico%' OR
		Texto like '%IEPS%' OR
		Texto like '%impuesto especial sobre produccion y servicios%' OR
		Texto like '%Gasolina%' OR
		Texto like '%Pemex%' OR
		Texto like '%SHCP%' OR
		Texto like '%secretaria de hacienda y credito publico%' OR
		Texto like '%Miguel Angel Osorio Chong%' OR
		Texto like '%Miguel Angel Osorio%' OR
		Texto like '%Miguel Osorio Chong%' OR
		Texto like '%Osorio Chong%' OR
		Texto like '% OCDE %' OR
		Texto like '% CCE %' OR
		Texto like '% ZEE %' OR
		Texto like '%Moody%' OR
		Texto like '%Raul cervantes andrade%' OR
		Texto like '%Raul cervantes%' OR
		Texto like '%cervantes andrade%' OR
		Texto like '%Camara de diputados%' OR
		Texto like '%Senado de la republica%' OR
		Texto like '%Congreso de la union%' OR
		Texto like '% PIB %' OR
		Texto like '%producto interno bruto%' OR
		Texto like '%inflacion%' OR
		Texto like '%tipo de cambio%' OR
		Texto like '%Luis Videgaray Caso%' OR
		Texto like '%Videgaray Caso%' OR
		Texto like '%Idelfonso guajardo%' OR
		Texto like '%Gerardo ruiz esparza%' OR
		Texto like '% CEESP %' OR
		Texto like '% CONSAR %' OR

		Titulo like '%Banca de desarrollo%' OR
		Titulo like '%Banca Comercial%' OR
		Titulo like '%Asociacion de bancos de mexico%' OR
		Titulo like '%Banco de mexico%' OR
		Titulo like '%IEPS%' OR
		Titulo like '%impuesto especial sobre produccion y servicios%' OR
		Titulo like '%Gasolina%' OR
		Titulo like '%Pemex%' OR
		Titulo like '%SHCP%' OR
		Titulo like '%secretaria de hacienda y credito publico%' OR
		Titulo like '%Miguel Angel Osorio Chong%' OR
		Titulo like '%Miguel Angel Osorio%' OR
		Titulo like '%Miguel Osorio Chong%' OR
		Titulo like '%Osorio Chong%' OR
		Titulo like '% OCDE %' OR
		Titulo like '% CCE %' OR
		Titulo like '% ZEE %' OR
		Titulo like '%Moody%' OR
		Titulo like '%Raul cervantes andrade%' OR
		Titulo like '%Raul cervantes%' OR
		Titulo like '%cervantes andrade%' OR
		Titulo like '%Camara de diputados%' OR
		Titulo like '%Senado de la republica%' OR
		Titulo like '%Congreso de la union%' OR
		Titulo like '% PIB %' OR
		Titulo like '%producto interno bruto%' OR
		Titulo like '%inflacion%' OR
		Titulo like '%tipo de cambio%' OR
		Titulo like '%Luis Videgaray Caso%' OR
		Titulo like '%Videgaray Caso%' OR
		Titulo like '%Idelfonso guajardo%' OR
		Titulo like '%Gerardo ruiz esparza%' OR
		Titulo like '% CEESP %' OR
		Titulo like '% CONSAR %' OR

		Encabezado like '%Banca de desarrollo%' OR
		Encabezado like '%Banca Comercial%' OR
		Encabezado like '%Asociacion de bancos de mexico%' OR
		Encabezado like '%Banco de mexico%' OR
		Encabezado like '%IEPS%' OR
		Encabezado like '%impuesto especial sobre produccion y servicios%' OR
		Encabezado like '%Gasolina%' OR
		Encabezado like '%Pemex%' OR
		Encabezado like '%SHCP%' OR
		Encabezado like '%secretaria de hacienda y credito publico%' OR
		Encabezado like '%Miguel Angel Osorio Chong%' OR
		Encabezado like '%Miguel Angel Osorio%' OR
		Encabezado like '%Miguel Osorio Chong%' OR
		Encabezado like '%Osorio Chong%' OR
		Encabezado like '% OCDE %' OR
		Encabezado like '% CCE %' OR
		Encabezado like '% ZEE %' OR
		Encabezado like '%Moody%' OR
		Encabezado like '%Raul cervantes andrade%' OR
		Encabezado like '%Raul cervantes%' OR
		Encabezado like '%cervantes andrade%' OR
		Encabezado like '%Camara de diputados%' OR
		Encabezado like '%Senado de la republica%' OR
		Encabezado like '%Congreso de la union%' OR
		Encabezado like '% PIB %' OR
		Encabezado like '%producto interno bruto%' OR
		Encabezado like '%inflacion%' OR
		Encabezado like '%tipo de cambio%' OR
		Encabezado like '%Luis Videgaray Caso%' OR
		Encabezado like '%Videgaray Caso%' OR
		Encabezado like '%Idelfonso guajardo%' OR
		Encabezado like '%Gerardo ruiz esparza%' OR
		Encabezado like '% CEESP %' OR
		Encabezado like '% CONSAR %' OR

		PieFoto like '%Banca de desarrollo%' OR
		PieFoto like '%Banca Comercial%' OR
		PieFoto like '%Asociacion de bancos de mexico%' OR
		PieFoto like '%Banco de mexico%' OR
		PieFoto like '%IEPS%' OR
		PieFoto like '%impuesto especial sobre produccion y servicios%' OR
		PieFoto like '%Gasolina%' OR
		PieFoto like '%Pemex%' OR
		PieFoto like '%SHCP%' OR
		PieFoto like '%secretaria de hacienda y credito publico%' OR
		PieFoto like '%Miguel Angel Osorio Chong%' OR
		PieFoto like '%Miguel Angel Osorio%' OR
		PieFoto like '%Miguel Osorio Chong%' OR
		PieFoto like '%Osorio Chong%' OR
		PieFoto like '% OCDE %' OR
		PieFoto like '% CCE %' OR
		PieFoto like '% ZEE %' OR
		PieFoto like '%Moody%' OR
		PieFoto like '%Raul cervantes andrade%' OR
		PieFoto like '%Raul cervantes%' OR
		PieFoto like '%cervantes andrade%' OR
		PieFoto like '%Camara de diputados%' OR
		PieFoto like '%Senado de la republica%' OR
		PieFoto like '%Congreso de la union%' OR
		PieFoto like '% PIB %' OR
		PieFoto like '%producto interno bruto%' OR
		PieFoto like '%inflacion%' OR
		PieFoto like '%tipo de cambio%' OR
		PieFoto like '%Luis Videgaray Caso%' OR
		PieFoto like '%Videgaray Caso%' OR
		PieFoto like '%Idelfonso guajardo%' OR
		PieFoto like '%Gerardo ruiz esparza%' OR
		PieFoto like '% CEESP %' OR
		PieFoto like '% CONSAR %'
    )
LIMIT 0,10
) #La Jornada de Mexico


UNION 

(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CREN as CREN,
	n.CostoNota,
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
	p.idPeriodico in (52) AND
	n.Categoria not in (1,3,19,20,21) AND 
	n.Activo = 1 AND
	fecha = CURDATE() AND (
		Texto like '%Banca de desarrollo%' OR
		Texto like '%Banca Comercial%' OR
		Texto like '%Asociacion de bancos de mexico%' OR
		Texto like '%Banco de mexico%' OR
		Texto like '%IEPS%' OR
		Texto like '%impuesto especial sobre produccion y servicios%' OR
		Texto like '%Gasolina%' OR
		Texto like '%Pemex%' OR
		Texto like '%SHCP%' OR
		Texto like '%secretaria de hacienda y credito publico%' OR
		Texto like '%Miguel Angel Osorio Chong%' OR
		Texto like '%Miguel Angel Osorio%' OR
		Texto like '%Miguel Osorio Chong%' OR
		Texto like '%Osorio Chong%' OR
		Texto like '% OCDE %' OR
		Texto like '% CCE %' OR
		Texto like '% ZEE %' OR
		Texto like '%Moody%' OR
		Texto like '%Raul cervantes andrade%' OR
		Texto like '%Raul cervantes%' OR
		Texto like '%cervantes andrade%' OR
		Texto like '%Camara de diputados%' OR
		Texto like '%Senado de la republica%' OR
		Texto like '%Congreso de la union%' OR
		Texto like '% PIB %' OR
		Texto like '%producto interno bruto%' OR
		Texto like '%inflacion%' OR
		Texto like '%tipo de cambio%' OR
		Texto like '%Luis Videgaray Caso%' OR
		Texto like '%Videgaray Caso%' OR
		Texto like '%Idelfonso guajardo%' OR
		Texto like '%Gerardo ruiz esparza%' OR
		Texto like '% CEESP %' OR
		Texto like '% CONSAR %' OR

		Titulo like '%Banca de desarrollo%' OR
		Titulo like '%Banca Comercial%' OR
		Titulo like '%Asociacion de bancos de mexico%' OR
		Titulo like '%Banco de mexico%' OR
		Titulo like '%IEPS%' OR
		Titulo like '%impuesto especial sobre produccion y servicios%' OR
		Titulo like '%Gasolina%' OR
		Titulo like '%Pemex%' OR
		Titulo like '%SHCP%' OR
		Titulo like '%secretaria de hacienda y credito publico%' OR
		Titulo like '%Miguel Angel Osorio Chong%' OR
		Titulo like '%Miguel Angel Osorio%' OR
		Titulo like '%Miguel Osorio Chong%' OR
		Titulo like '%Osorio Chong%' OR
		Titulo like '% OCDE %' OR
		Titulo like '% CCE %' OR
		Titulo like '% ZEE %' OR
		Titulo like '%Moody%' OR
		Titulo like '%Raul cervantes andrade%' OR
		Titulo like '%Raul cervantes%' OR
		Titulo like '%cervantes andrade%' OR
		Titulo like '%Camara de diputados%' OR
		Titulo like '%Senado de la republica%' OR
		Titulo like '%Congreso de la union%' OR
		Titulo like '% PIB %' OR
		Titulo like '%producto interno bruto%' OR
		Titulo like '%inflacion%' OR
		Titulo like '%tipo de cambio%' OR
		Titulo like '%Luis Videgaray Caso%' OR
		Titulo like '%Videgaray Caso%' OR
		Titulo like '%Idelfonso guajardo%' OR
		Titulo like '%Gerardo ruiz esparza%' OR
		Titulo like '% CEESP %' OR
		Titulo like '% CONSAR %' OR

		Encabezado like '%Banca de desarrollo%' OR
		Encabezado like '%Banca Comercial%' OR
		Encabezado like '%Asociacion de bancos de mexico%' OR
		Encabezado like '%Banco de mexico%' OR
		Encabezado like '%IEPS%' OR
		Encabezado like '%impuesto especial sobre produccion y servicios%' OR
		Encabezado like '%Gasolina%' OR
		Encabezado like '%Pemex%' OR
		Encabezado like '%SHCP%' OR
		Encabezado like '%secretaria de hacienda y credito publico%' OR
		Encabezado like '%Miguel Angel Osorio Chong%' OR
		Encabezado like '%Miguel Angel Osorio%' OR
		Encabezado like '%Miguel Osorio Chong%' OR
		Encabezado like '%Osorio Chong%' OR
		Encabezado like '% OCDE %' OR
		Encabezado like '% CCE %' OR
		Encabezado like '% ZEE %' OR
		Encabezado like '%Moody%' OR
		Encabezado like '%Raul cervantes andrade%' OR
		Encabezado like '%Raul cervantes%' OR
		Encabezado like '%cervantes andrade%' OR
		Encabezado like '%Camara de diputados%' OR
		Encabezado like '%Senado de la republica%' OR
		Encabezado like '%Congreso de la union%' OR
		Encabezado like '% PIB %' OR
		Encabezado like '%producto interno bruto%' OR
		Encabezado like '%inflacion%' OR
		Encabezado like '%tipo de cambio%' OR
		Encabezado like '%Luis Videgaray Caso%' OR
		Encabezado like '%Videgaray Caso%' OR
		Encabezado like '%Idelfonso guajardo%' OR
		Encabezado like '%Gerardo ruiz esparza%' OR
		Encabezado like '% CEESP %' OR
		Encabezado like '% CONSAR %' OR

		PieFoto like '%Banca de desarrollo%' OR
		PieFoto like '%Banca Comercial%' OR
		PieFoto like '%Asociacion de bancos de mexico%' OR
		PieFoto like '%Banco de mexico%' OR
		PieFoto like '%IEPS%' OR
		PieFoto like '%impuesto especial sobre produccion y servicios%' OR
		PieFoto like '%Gasolina%' OR
		PieFoto like '%Pemex%' OR
		PieFoto like '%SHCP%' OR
		PieFoto like '%secretaria de hacienda y credito publico%' OR
		PieFoto like '%Miguel Angel Osorio Chong%' OR
		PieFoto like '%Miguel Angel Osorio%' OR
		PieFoto like '%Miguel Osorio Chong%' OR
		PieFoto like '%Osorio Chong%' OR
		PieFoto like '% OCDE %' OR
		PieFoto like '% CCE %' OR
		PieFoto like '% ZEE %' OR
		PieFoto like '%Moody%' OR
		PieFoto like '%Raul cervantes andrade%' OR
		PieFoto like '%Raul cervantes%' OR
		PieFoto like '%cervantes andrade%' OR
		PieFoto like '%Camara de diputados%' OR
		PieFoto like '%Senado de la republica%' OR
		PieFoto like '%Congreso de la union%' OR
		PieFoto like '% PIB %' OR
		PieFoto like '%producto interno bruto%' OR
		PieFoto like '%inflacion%' OR
		PieFoto like '%tipo de cambio%' OR
		PieFoto like '%Luis Videgaray Caso%' OR
		PieFoto like '%Videgaray Caso%' OR
		PieFoto like '%Idelfonso guajardo%' OR
		PieFoto like '%Gerardo ruiz esparza%' OR
		PieFoto like '% CEESP %' OR
		PieFoto like '% CONSAR %'
    )
LIMIT 0,10
) #


UNION 

(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CREN as CREN,
	n.CostoNota,
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
	p.idPeriodico in (53) AND
	n.Categoria not in (1,3,19,20,21) AND 
	n.Activo = 1 AND
	fecha = CURDATE() AND (
		Texto like '%Banca de desarrollo%' OR
		Texto like '%Banca Comercial%' OR
		Texto like '%Asociacion de bancos de mexico%' OR
		Texto like '%Banco de mexico%' OR
		Texto like '%IEPS%' OR
		Texto like '%impuesto especial sobre produccion y servicios%' OR
		Texto like '%Gasolina%' OR
		Texto like '%Pemex%' OR
		Texto like '%SHCP%' OR
		Texto like '%secretaria de hacienda y credito publico%' OR
		Texto like '%Miguel Angel Osorio Chong%' OR
		Texto like '%Miguel Angel Osorio%' OR
		Texto like '%Miguel Osorio Chong%' OR
		Texto like '%Osorio Chong%' OR
		Texto like '% OCDE %' OR
		Texto like '% CCE %' OR
		Texto like '% ZEE %' OR
		Texto like '%Moody%' OR
		Texto like '%Raul cervantes andrade%' OR
		Texto like '%Raul cervantes%' OR
		Texto like '%cervantes andrade%' OR
		Texto like '%Camara de diputados%' OR
		Texto like '%Senado de la republica%' OR
		Texto like '%Congreso de la union%' OR
		Texto like '% PIB %' OR
		Texto like '%producto interno bruto%' OR
		Texto like '%inflacion%' OR
		Texto like '%tipo de cambio%' OR
		Texto like '%Luis Videgaray Caso%' OR
		Texto like '%Videgaray Caso%' OR
		Texto like '%Idelfonso guajardo%' OR
		Texto like '%Gerardo ruiz esparza%' OR
		Texto like '% CEESP %' OR
		Texto like '% CONSAR %' OR

		Titulo like '%Banca de desarrollo%' OR
		Titulo like '%Banca Comercial%' OR
		Titulo like '%Asociacion de bancos de mexico%' OR
		Titulo like '%Banco de mexico%' OR
		Titulo like '%IEPS%' OR
		Titulo like '%impuesto especial sobre produccion y servicios%' OR
		Titulo like '%Gasolina%' OR
		Titulo like '%Pemex%' OR
		Titulo like '%SHCP%' OR
		Titulo like '%secretaria de hacienda y credito publico%' OR
		Titulo like '%Miguel Angel Osorio Chong%' OR
		Titulo like '%Miguel Angel Osorio%' OR
		Titulo like '%Miguel Osorio Chong%' OR
		Titulo like '%Osorio Chong%' OR
		Titulo like '% OCDE %' OR
		Titulo like '% CCE %' OR
		Titulo like '% ZEE %' OR
		Titulo like '%Moody%' OR
		Titulo like '%Raul cervantes andrade%' OR
		Titulo like '%Raul cervantes%' OR
		Titulo like '%cervantes andrade%' OR
		Titulo like '%Camara de diputados%' OR
		Titulo like '%Senado de la republica%' OR
		Titulo like '%Congreso de la union%' OR
		Titulo like '% PIB %' OR
		Titulo like '%producto interno bruto%' OR
		Titulo like '%inflacion%' OR
		Titulo like '%tipo de cambio%' OR
		Titulo like '%Luis Videgaray Caso%' OR
		Titulo like '%Videgaray Caso%' OR
		Titulo like '%Idelfonso guajardo%' OR
		Titulo like '%Gerardo ruiz esparza%' OR
		Titulo like '% CEESP %' OR
		Titulo like '% CONSAR %' OR

		Encabezado like '%Banca de desarrollo%' OR
		Encabezado like '%Banca Comercial%' OR
		Encabezado like '%Asociacion de bancos de mexico%' OR
		Encabezado like '%Banco de mexico%' OR
		Encabezado like '%IEPS%' OR
		Encabezado like '%impuesto especial sobre produccion y servicios%' OR
		Encabezado like '%Gasolina%' OR
		Encabezado like '%Pemex%' OR
		Encabezado like '%SHCP%' OR
		Encabezado like '%secretaria de hacienda y credito publico%' OR
		Encabezado like '%Miguel Angel Osorio Chong%' OR
		Encabezado like '%Miguel Angel Osorio%' OR
		Encabezado like '%Miguel Osorio Chong%' OR
		Encabezado like '%Osorio Chong%' OR
		Encabezado like '% OCDE %' OR
		Encabezado like '% CCE %' OR
		Encabezado like '% ZEE %' OR
		Encabezado like '%Moody%' OR
		Encabezado like '%Raul cervantes andrade%' OR
		Encabezado like '%Raul cervantes%' OR
		Encabezado like '%cervantes andrade%' OR
		Encabezado like '%Camara de diputados%' OR
		Encabezado like '%Senado de la republica%' OR
		Encabezado like '%Congreso de la union%' OR
		Encabezado like '% PIB %' OR
		Encabezado like '%producto interno bruto%' OR
		Encabezado like '%inflacion%' OR
		Encabezado like '%tipo de cambio%' OR
		Encabezado like '%Luis Videgaray Caso%' OR
		Encabezado like '%Videgaray Caso%' OR
		Encabezado like '%Idelfonso guajardo%' OR
		Encabezado like '%Gerardo ruiz esparza%' OR
		Encabezado like '% CEESP %' OR
		Encabezado like '% CONSAR %' OR

		PieFoto like '%Banca de desarrollo%' OR
		PieFoto like '%Banca Comercial%' OR
		PieFoto like '%Asociacion de bancos de mexico%' OR
		PieFoto like '%Banco de mexico%' OR
		PieFoto like '%IEPS%' OR
		PieFoto like '%impuesto especial sobre produccion y servicios%' OR
		PieFoto like '%Gasolina%' OR
		PieFoto like '%Pemex%' OR
		PieFoto like '%SHCP%' OR
		PieFoto like '%secretaria de hacienda y credito publico%' OR
		PieFoto like '%Miguel Angel Osorio Chong%' OR
		PieFoto like '%Miguel Angel Osorio%' OR
		PieFoto like '%Miguel Osorio Chong%' OR
		PieFoto like '%Osorio Chong%' OR
		PieFoto like '% OCDE %' OR
		PieFoto like '% CCE %' OR
		PieFoto like '% ZEE %' OR
		PieFoto like '%Moody%' OR
		PieFoto like '%Raul cervantes andrade%' OR
		PieFoto like '%Raul cervantes%' OR
		PieFoto like '%cervantes andrade%' OR
		PieFoto like '%Camara de diputados%' OR
		PieFoto like '%Senado de la republica%' OR
		PieFoto like '%Congreso de la union%' OR
		PieFoto like '% PIB %' OR
		PieFoto like '%producto interno bruto%' OR
		PieFoto like '%inflacion%' OR
		PieFoto like '%tipo de cambio%' OR
		PieFoto like '%Luis Videgaray Caso%' OR
		PieFoto like '%Videgaray Caso%' OR
		PieFoto like '%Idelfonso guajardo%' OR
		PieFoto like '%Gerardo ruiz esparza%' OR
		PieFoto like '% CEESP %' OR
		PieFoto like '% CONSAR %'
    )
LIMIT 0,10
) #Excelsior


UNION 

(
SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CREN as CREN,
	n.CostoNota,
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
	p.idPeriodico in (59) AND
	n.Categoria not in (1,3,19,20,21) AND 
	n.Activo = 1 AND
	fecha = CURDATE() AND (
		Texto like '%Banca de desarrollo%' OR
		Texto like '%Banca Comercial%' OR
		Texto like '%Asociacion de bancos de mexico%' OR
		Texto like '%Banco de mexico%' OR
		Texto like '%IEPS%' OR
		Texto like '%impuesto especial sobre produccion y servicios%' OR
		Texto like '%Gasolina%' OR
		Texto like '%Pemex%' OR
		Texto like '%SHCP%' OR
		Texto like '%secretaria de hacienda y credito publico%' OR
		Texto like '%Miguel Angel Osorio Chong%' OR
		Texto like '%Miguel Angel Osorio%' OR
		Texto like '%Miguel Osorio Chong%' OR
		Texto like '%Osorio Chong%' OR
		Texto like '% OCDE %' OR
		Texto like '% CCE %' OR
		Texto like '% ZEE %' OR
		Texto like '%Moody%' OR
		Texto like '%Raul cervantes andrade%' OR
		Texto like '%Raul cervantes%' OR
		Texto like '%cervantes andrade%' OR
		Texto like '%Camara de diputados%' OR
		Texto like '%Senado de la republica%' OR
		Texto like '%Congreso de la union%' OR
		Texto like '% PIB %' OR
		Texto like '%producto interno bruto%' OR
		Texto like '%inflacion%' OR
		Texto like '%tipo de cambio%' OR
		Texto like '%Luis Videgaray Caso%' OR
		Texto like '%Videgaray Caso%' OR
		Texto like '%Idelfonso guajardo%' OR
		Texto like '%Gerardo ruiz esparza%' OR
		Texto like '% CEESP %' OR
		Texto like '% CONSAR %' OR

		Titulo like '%Banca de desarrollo%' OR
		Titulo like '%Banca Comercial%' OR
		Titulo like '%Asociacion de bancos de mexico%' OR
		Titulo like '%Banco de mexico%' OR
		Titulo like '%IEPS%' OR
		Titulo like '%impuesto especial sobre produccion y servicios%' OR
		Titulo like '%Gasolina%' OR
		Titulo like '%Pemex%' OR
		Titulo like '%SHCP%' OR
		Titulo like '%secretaria de hacienda y credito publico%' OR
		Titulo like '%Miguel Angel Osorio Chong%' OR
		Titulo like '%Miguel Angel Osorio%' OR
		Titulo like '%Miguel Osorio Chong%' OR
		Titulo like '%Osorio Chong%' OR
		Titulo like '% OCDE %' OR
		Titulo like '% CCE %' OR
		Titulo like '% ZEE %' OR
		Titulo like '%Moody%' OR
		Titulo like '%Raul cervantes andrade%' OR
		Titulo like '%Raul cervantes%' OR
		Titulo like '%cervantes andrade%' OR
		Titulo like '%Camara de diputados%' OR
		Titulo like '%Senado de la republica%' OR
		Titulo like '%Congreso de la union%' OR
		Titulo like '% PIB %' OR
		Titulo like '%producto interno bruto%' OR
		Titulo like '%inflacion%' OR
		Titulo like '%tipo de cambio%' OR
		Titulo like '%Luis Videgaray Caso%' OR
		Titulo like '%Videgaray Caso%' OR
		Titulo like '%Idelfonso guajardo%' OR
		Titulo like '%Gerardo ruiz esparza%' OR
		Titulo like '% CEESP %' OR
		Titulo like '% CONSAR %' OR

		Encabezado like '%Banca de desarrollo%' OR
		Encabezado like '%Banca Comercial%' OR
		Encabezado like '%Asociacion de bancos de mexico%' OR
		Encabezado like '%Banco de mexico%' OR
		Encabezado like '%IEPS%' OR
		Encabezado like '%impuesto especial sobre produccion y servicios%' OR
		Encabezado like '%Gasolina%' OR
		Encabezado like '%Pemex%' OR
		Encabezado like '%SHCP%' OR
		Encabezado like '%secretaria de hacienda y credito publico%' OR
		Encabezado like '%Miguel Angel Osorio Chong%' OR
		Encabezado like '%Miguel Angel Osorio%' OR
		Encabezado like '%Miguel Osorio Chong%' OR
		Encabezado like '%Osorio Chong%' OR
		Encabezado like '% OCDE %' OR
		Encabezado like '% CCE %' OR
		Encabezado like '% ZEE %' OR
		Encabezado like '%Moody%' OR
		Encabezado like '%Raul cervantes andrade%' OR
		Encabezado like '%Raul cervantes%' OR
		Encabezado like '%cervantes andrade%' OR
		Encabezado like '%Camara de diputados%' OR
		Encabezado like '%Senado de la republica%' OR
		Encabezado like '%Congreso de la union%' OR
		Encabezado like '% PIB %' OR
		Encabezado like '%producto interno bruto%' OR
		Encabezado like '%inflacion%' OR
		Encabezado like '%tipo de cambio%' OR
		Encabezado like '%Luis Videgaray Caso%' OR
		Encabezado like '%Videgaray Caso%' OR
		Encabezado like '%Idelfonso guajardo%' OR
		Encabezado like '%Gerardo ruiz esparza%' OR
		Encabezado like '% CEESP %' OR
		Encabezado like '% CONSAR %' OR

		PieFoto like '%Banca de desarrollo%' OR
		PieFoto like '%Banca Comercial%' OR
		PieFoto like '%Asociacion de bancos de mexico%' OR
		PieFoto like '%Banco de mexico%' OR
		PieFoto like '%IEPS%' OR
		PieFoto like '%impuesto especial sobre produccion y servicios%' OR
		PieFoto like '%Gasolina%' OR
		PieFoto like '%Pemex%' OR
		PieFoto like '%SHCP%' OR
		PieFoto like '%secretaria de hacienda y credito publico%' OR
		PieFoto like '%Miguel Angel Osorio Chong%' OR
		PieFoto like '%Miguel Angel Osorio%' OR
		PieFoto like '%Miguel Osorio Chong%' OR
		PieFoto like '%Osorio Chong%' OR
		PieFoto like '% OCDE %' OR
		PieFoto like '% CCE %' OR
		PieFoto like '% ZEE %' OR
		PieFoto like '%Moody%' OR
		PieFoto like '%Raul cervantes andrade%' OR
		PieFoto like '%Raul cervantes%' OR
		PieFoto like '%cervantes andrade%' OR
		PieFoto like '%Camara de diputados%' OR
		PieFoto like '%Senado de la republica%' OR
		PieFoto like '%Congreso de la union%' OR
		PieFoto like '% PIB %' OR
		PieFoto like '%producto interno bruto%' OR
		PieFoto like '%inflacion%' OR
		PieFoto like '%tipo de cambio%' OR
		PieFoto like '%Luis Videgaray Caso%' OR
		PieFoto like '%Videgaray Caso%' OR
		PieFoto like '%Idelfonso guajardo%' OR
		PieFoto like '%Gerardo ruiz esparza%' OR
		PieFoto like '% CEESP %' OR
		PieFoto like '% CONSAR %'
    )
LIMIT 0,10
) #

)derived
";

		$noticias = mysql_query($query);
  		$filas = mysql_affected_rows();

  		$pdf  = new FPDI('P', 'mm', 'legal');

    	$pdfs = array();
		if($filas>0){
			while($row = mysql_fetch_array($noticias)){
				if(!in_array("/var/www/external/testigos/nafinsa/infoGeneral/".$fecha."/".$row['idEditorial'].".pdf", $pdfs)){
					$pdfs[] = "/var/www/external/testigos/nafinsa/infoGeneral/".$fecha."/".$row['idEditorial'].".pdf";
				}
			}
		}

    	if(!empty($pdfs)){
    		$pdf->setFiles($pdfs);
    		$pdf->concat();


    		mkdir("/var/www/external/testigos/nafinsa/infoGeneral/".$fecha."/compendio",true, 0777);
    		chmod("/var/www/external/testigos/nafinsa/infoGeneral/".$fecha."/compendio",0777);
    		umask(umask(0));

    		$nombre = "/var/www/external/testigos/nafinsa/infoGeneral/".$fecha."/compendio/".$fecha.".pdf";
    		$pdf->Output($nombre, 'F');
    	}