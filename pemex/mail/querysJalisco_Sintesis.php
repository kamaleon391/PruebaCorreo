<?php
function query($op,$limit1="",$limit2=""){


    switch ($op) {
        case 1:// PRIMERAS PLANAS
            $query="SELECT ROUND(COUNT(*)/20) as 'Paginas' FROM
(
SELECT Tema,Periodico, Titulo, Texto, Seccion, NumeroPagina, pdf, jalisco, Pagina FROM (
SELECT 'Portadas' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina','../clientesPDF/jalisco/SE CAMBIA POR PORTADAS.pdf' as pdf,'Jalisco',(1) as Pagina
UNION ALL
SELECT 'PORTADAS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
        p.estado,(2) as Pagina
		FROM noticiasDia n, (SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
		WHERE
			n.periodico=o.periodico AND
                (n.Categoria=3 OR n.Categoria =21)
				AND n.periodico=p.idPeriodico AND 
s.idSeccion=n.Seccion AND
fecha=(SELECT CURDATE() )
GROUP BY n.periodico, n.NumeroPagina

UNION SELECT 'Campañas' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina 2','../clientesPDF/jalisco/SE CAMBIA POR Campañas.pdf' as pdf,'Jalisco',(3) as Pagina
UNION 
SELECT 
	'CAMPAÑAS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(4) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	s.idSeccion not in (1,8,10,12,22,54,58,68,114,129,165,195,533,680,2350) AND
	n.Categoria not in(1) AND
	n.fecha=(SELECT CURDATE()) AND (
		Texto like '%Precampaña%' OR
		Texto like '%Campaña%'
	) AND (
		Texto not like '%michoacan%' AND
		Texto not like '%Eruviel%'
	)
GROUP BY n.periodico, n.NumeroPagina
UNION
	SELECT 'Columnas' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina 3','../clientesPDF/jalisco/SE CAMBIA POR Columnas.pdf' as pdf,'Jalisco',(5) as Pagina
UNION
SELECT 
	'COLUMNAS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(6) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s,
	categoriasPeriodicos c
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	c.idCaptura=n.Categoria AND
	c.idCategoria in(1) AND
	n.Fecha=CURDATE() AND (
    Titulo like '%Cupula%' OR
    Titulo like '%La Tremenda Corte%' OR
    Titulo like '%Alla en la Fuente%' OR
    Titulo like '%Cronos%' OR
    Titulo like '%Plaza Liberacion%' OR
    Titulo like '%En tres patadas%' OR
    Titulo like '%Radar%' OR
    Titulo like '%Contrapuntos%' OR
    Titulo like '%La Sopa%' OR
    Titulo like '%Gabriel Torres Espinoza%' OR
    Titulo like '%Quinto Patio%' OR
    Autor like  '%Gabriel Torres Espinoza%' OR
    Autor like '%Enrique Ibarra%' OR
    Autor like '%Guillermo Velasco%' OR
    Autor like '%Ivabelle arroyo%' OR
    Autor like '%Diego Petersen%' OR
    Autor like '%Quinto Patio%'
  )
UNION
	SELECT 'GOBERNADOR' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina 3','../clientesPDF/jalisco/SE CAMBIA POR Columnas.pdf' as pdf,'Jalisco',(7) as Pagina
UNION

SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(8) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=31 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR
		
		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
		
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		

		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
	

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR
		

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		

		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'	

)
UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(9) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=57 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR
		
		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
		
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR


		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
	
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR
	

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
	
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR
		
		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina

UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(10) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=33 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		


		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina

UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(11) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=55 AND
	n.Fecha=CURDATE() AND  (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		


		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina

UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(12) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=446 AND
	n.Fecha=CURDATE() AND  (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		


		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina
UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(13) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=528 AND
	n.Fecha=CURDATE() AND  (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		


		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina
UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(14) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=285 AND
	n.Fecha=CURDATE() AND  (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		


		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina
UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(15) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=73 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina
UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(16) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=321 AND
	n.Fecha=CURDATE() AND  (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina
UNION
	SELECT 'NACIONAL' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina 3','../clientesPDF/jalisco/SE CAMBIA POR Columnas.pdf' as pdf,'Jalisco',(17) as Pagina
UNION
SELECT
'NACIONAL',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(18) as Pagina
FROM
	noticiasDia n,
	(SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o,
	periodicos p,
	seccionesPeriodicos s
WHERE
	p.idPeriodico not in (149,155) AND
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=n.Periodico AND
	fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR
		
		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
		

		Texto like '%Estado de Jalisco%' OR
		Texto like '%Jalisco%' OR
		Texto like '%Guadalajara%' OR
		Texto like '%Zapopan%' OR
		Texto like '%Tlajomulco de Zuniga%' OR
		Texto like '%Tlajomulco%' OR
		Texto like '%Enrique Alfaro Ramirez%' OR
		Texto like '%Enrique Alfaro%' OR
		Texto like '%Alfaro Ramirez%' OR
		Texto like '%Hugo Luna Vazquez%' OR
		Texto like '%Hugo Luna%' OR
		Texto like '%Coordinador estatal  de Movimiento ciudadano Jalisco%' OR
		Texto like '%Movimiento Ciudadano Jalisco%' OR
		Texto like '%Movimiento Ciudadano en Jalisco%' OR
		Texto like '%Movimiento Ciudadano de Jalisco%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		


		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%'
)

)derived
)Derived";
            return $query;
            break;
        case 2:
           $query="SELECT Tema,Periodico, Titulo, Texto, Seccion, NumeroPagina, pdf, jalisco, Pagina FROM (
SELECT 'Portadas' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina','../clientesPDF/jalisco/SE CAMBIA POR PORTADAS.pdf' as pdf,'Jalisco',(1) as Pagina
UNION ALL
SELECT 'PORTADAS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
        p.estado,(2) as Pagina
		FROM noticiasDia n, (SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
		WHERE
			n.periodico=o.periodico AND
                (n.Categoria=3 OR n.Categoria =21)
				AND n.periodico=p.idPeriodico AND 
s.idSeccion=n.Seccion AND
fecha=(SELECT CURDATE() )
GROUP BY n.periodico, n.NumeroPagina

UNION SELECT 'Campañas' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina 2','../clientesPDF/jalisco/SE CAMBIA POR Campañas.pdf' as pdf,'Jalisco',(3) as Pagina
UNION 
SELECT 
	'CAMPAÑAS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(4) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	s.idSeccion not in (1,10,12,22,54,58,68,114,129,165,195,533,680,2350) AND 
	n.Categoria not in(1) AND
	n.fecha=(SELECT CURDATE()) AND (
		Texto like '%Precampaña%' OR
		Texto like '%Campaña%'
	) AND (
		Texto not like '%michoacan%' AND
		Texto not like '%Eruviel%'
	)
GROUP BY n.periodico, n.NumeroPagina
UNION
	SELECT 'Columnas' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina 3','../clientesPDF/jalisco/SE CAMBIA POR Columnas.pdf' as pdf,'Jalisco',(5) as Pagina
UNION
SELECT 
	'COLUMNAS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(6) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s,
	categoriasPeriodicos c
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	c.idCaptura=n.Categoria AND
	c.idCategoria in(1) AND
	n.Fecha=CURDATE() AND (
    Titulo like '%Cupula%' OR
    Titulo like '%La Tremenda Corte%' OR
    Titulo like '%Alla en la Fuente%' OR
    Titulo like '%Cronos%' OR
    Titulo like '%Plaza Liberacion%' OR
    Titulo like '%En tres patadas%' OR
    Titulo like '%Radar%' OR
    Titulo like '%Contrapuntos%' OR
    Titulo like '%La Sopa%' OR
    Titulo like '%Gabriel Torres Espinoza%' OR
    Titulo like '%Quinto Patio%' OR
    Autor like  '%Gabriel Torres Espinoza%' OR
    Autor like '%Enrique Ibarra%' OR
    Autor like '%Guillermo Velasco%' OR
    Autor like '%Ivabelle arroyo%' OR
    Autor like '%Diego Petersen%' OR
    Autor like '%Quinto Patio%'
  )
UNION
	SELECT 'GOBERNADOR' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina 3','../clientesPDF/jalisco/SE CAMBIA POR Columnas.pdf' as pdf,'Jalisco',(7) as Pagina
UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(8) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=31 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(9) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=57 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina

UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(10) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=33 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina

UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(11) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=55 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina

UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(12) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=446 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina
UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(13) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=528 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina


UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(14) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=285 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina


UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(15) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=73 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)

GROUP BY n.periodico, n.NumeroPagina

UNION
SELECT 
	'GOBERNADOR',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(16) as Pagina
FROM 
	noticiasDia n, 
	(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
	periodicos p,
	seccionesPeriodicos s
WHERE
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=321 AND
	n.Fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR

		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
	
		Texto like '%secretaria general de gobierno%' OR
		Texto like '%secretaria general%' OR
		Texto like '%roberto lopez lara%' OR
		Texto like '%lopez lara%' OR
		Texto like '%secretario general de gobierno%' OR
		
		Texto like '%secretaria de desarrollo e integracion social%' OR
		Texto like '% sedis %' OR
		Texto like '%Daviel Trujillo Cuevas%' OR
		Texto like '%Trujillo Cuevas%' OR
		
		Texto like '%Unidad estatal de proteccion civil y bomberos%' OR
		Texto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Texto like '%Unidad estatal de proteccion civil%' OR
		Texto like '%Jose trinidad lopez rivas%' OR
		Texto like '%trinidad lopez rivas%' OR
		Texto like '%Lopez rivas%' OR
		
		Texto like '%secretaria Salud Jalisco%' OR
		Texto like '% SSJ %' OR
		Texto like '%Jaime Agustin gonzalez alvarez%' OR
		Texto like '%Agustin gonzalez alvarez%' OR
		Texto like '%Jaime gonzalez alvarez%' OR
		Texto like '%Gonzalez Alvarez%' OR
		

		Texto like '%Fiscalia General del Estado%' OR
		Texto like '%Fiscalia General%' OR
		Texto like '%Fiscal General%' OR
		Texto like '%titular de la Fiscalía General del Estado %' OR
		Texto like '%Luis carlos najera gutierrez de velasco%' OR
		Texto like '%Luis carlos najera%' OR
		Texto like '%Luis Carlos najera gutierrez%' OR
		Texto like '%Luis Carlos najera%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR
		
		Titulo like '%secretaria general de gobierno%' OR
		Titulo like '%secretaria general%' OR
		Titulo like '%roberto lopez lara%' OR
		Titulo like '%lopez lara%' OR
		Titulo like '%secretario general de gobierno%' OR
		
		Titulo like '%secretaria de desarrollo e integracion social%' OR
		Titulo like '% sedis %' OR
		Titulo like '%Daviel Trujillo Cuevas%' OR
		Titulo like '%Trujillo Cuevas%' OR
		
		Titulo like '%Unidad estatal de proteccion civil y bomberos%' OR
		Titulo like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Titulo like '%Unidad estatal de proteccion civil%' OR
		Titulo like '%Jose trinidad lopez rivas%' OR
		Titulo like '%trinidad lopez rivas%' OR
		Titulo like '%Lopez rivas%' OR
		
	
		Titulo like '%secretaria Salud Jalisco%' OR
		Titulo like '% SSJ %' OR
		Titulo like '%Jaime Agustin gonzalez alvarez%' OR
		Titulo like '%Agustin gonzalez alvarez%' OR
		Titulo like '%Jaime gonzalez alvarez%' OR
		Titulo like '%Gonzalez Alvarez%' OR
		
		Titulo like '%Fiscalia General del Estado%' OR
		Titulo like '%Fiscalia General%' OR
		Titulo like '%Fiscal General%' OR
		Titulo like '%titular de la Fiscalía General del Estado %' OR
		Titulo like '%Luis carlos najera gutierrez de velasco%' OR
		Titulo like '%Luis carlos najera%' OR
		Titulo like '%Luis Carlos najera gutierrez%' OR
		Titulo like '%Luis Carlos najera%' OR
		

		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%' OR
		
		Encabezado like '%secretaria general de gobierno%' OR
		Encabezado like '%secretaria general%' OR
		Encabezado like '%roberto lopez lara%' OR
		Encabezado like '%lopez lara%' OR
		Encabezado like '%secretario general de gobierno%' OR
		
		Encabezado like '%secretaria de desarrollo e integracion social%' OR
		Encabezado like '% sedis %' OR
		Encabezado like '%Daviel Trujillo Cuevas%' OR
		Encabezado like '%Trujillo Cuevas%' OR
		
		Encabezado like '%Unidad estatal de proteccion civil y bomberos%' OR
		Encabezado like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Encabezado like '%Unidad estatal de proteccion civil%' OR
		Encabezado like '%Jose trinidad lopez rivas%' OR
		Encabezado like '%trinidad lopez rivas%' OR
		Encabezado like '%Lopez rivas%' OR
		
		Encabezado like '%secretaria Salud Jalisco%' OR
		Encabezado like '% SSJ %' OR
		Encabezado like '%Jaime Agustin gonzalez alvarez%' OR
		Encabezado like '%Agustin gonzalez alvarez%' OR
		Encabezado like '%Jaime gonzalez alvarez%' OR
		Encabezado like '%Gonzalez Alvarez%' OR
		
		Encabezado like '%Fiscalia General del Estado%' OR
		Encabezado like '%Fiscalia General%' OR
		Encabezado like '%Fiscal General%' OR
		Encabezado like '%titular de la Fiscalía General del Estado %' OR
		Encabezado like '%Luis carlos najera gutierrez de velasco%' OR
		Encabezado like '%Luis carlos najera%' OR
		Encabezado like '%Luis Carlos najera gutierrez%' OR
		Encabezado like '%Luis Carlos najera%' OR

		PieFoto like '% Gobernador del estado de Jalisco %' OR
		PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Jorge Aristoteles Sandoval%' OR
		PieFoto like '%Aristoteles Sandoval Diaz%' OR
		PieFoto like '%Aristoteles Sandoval%' OR
		PieFoto like '%Sandoval Diaz%' OR
		
		PieFoto like '%Gobierno del estado de Jalisco%' OR
		PieFoto like '%Gobierno del estado Jalisco%' OR
		PieFoto like '%Gobierno de Jalisco%' OR

		PieFoto like '%secretaria general de gobierno%' OR
		PieFoto like '%secretaria general%' OR
		PieFoto like '%roberto lopez lara%' OR
		PieFoto like '%lopez lara%' OR
		PieFoto like '%secretario general de gobierno%' OR
		
		PieFoto like '%secretaria de desarrollo e integracion social%' OR
		PieFoto like '% sedis %' OR
		PieFoto like '%Daviel Trujillo Cuevas%' OR
		PieFoto like '%Trujillo Cuevas%' OR
		
		PieFoto like '%Unidad estatal de proteccion civil y bomberos%' OR
		PieFoto like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		PieFoto like '%Unidad estatal de proteccion civil%' OR
		PieFoto like '%Jose trinidad lopez rivas%' OR
		PieFoto like '%trinidad lopez rivas%' OR
		PieFoto like '%Lopez rivas%' OR
		
		PieFoto like '%secretaria Salud Jalisco%' OR
		PieFoto like '% SSJ %' OR
		PieFoto like '%Jaime Agustin gonzalez alvarez%' OR
		PieFoto like '%Agustin gonzalez alvarez%' OR
		PieFoto like '%Jaime gonzalez alvarez%' OR
		PieFoto like '%Gonzalez Alvarez%' OR
		
		PieFoto like '%Fiscalia General del Estado%' OR
		PieFoto like '%Fiscalia General%' OR
		PieFoto like '%Fiscal General%' OR
		PieFoto like '%titular de la Fiscalía General del Estado %' OR
		PieFoto like '%Luis carlos najera gutierrez de velasco%' OR
		PieFoto like '%Luis carlos najera%' OR
		PieFoto like '%Luis Carlos najera gutierrez%' OR
		PieFoto like '%Luis Carlos najera%' OR
		

		Autor like '% Gobernador del estado de Jalisco %' OR
		Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
		Autor like '%Jorge Aristoteles Sandoval%' OR
		Autor like '%Aristoteles Sandoval Diaz%' OR
		Autor like '%Aristoteles Sandoval%' OR
		Autor like '%Sandoval Diaz%'  OR
		
		Autor like '%Gobierno del estado de Jalisco%' OR
		Autor like '%Gobierno del estado Jalisco%' OR
		Autor like '%Gobierno de Jalisco%' OR
		
		Autor like '%secretaria general de gobierno%' OR
		Autor like '%secretaria general%' OR
		Autor like '%roberto lopez lara%' OR
		Autor like '%lopez lara%' OR
		Autor like '%secretario general de gobierno%' OR
		
		Autor like '%secretaria de desarrollo e integracion social%' OR
		Autor like '% sedis %' OR
		Autor like '%Daviel Trujillo Cuevas%' OR
		Autor like '%Trujillo Cuevas%' OR
		
		Autor like '%Unidad estatal de proteccion civil y bomberos%' OR
		Autor like '%Unidad Estatal de Protección Civil y Bomberos de Jalisco%' OR
		Autor like '%Unidad estatal de proteccion civil%' OR
		Autor like '%Jose trinidad lopez rivas%' OR
		Autor like '%trinidad lopez rivas%' OR
		Autor like '%Lopez rivas%' OR
		
		Autor like '%secretaria Salud Jalisco%' OR
		Autor like '% SSJ %' OR
		Autor like '%Jaime Agustin gonzalez alvarez%' OR
		Autor like '%Agustin gonzalez alvarez%' OR
		Autor like '%Jaime gonzalez alvarez%' OR
		Autor like '%Gonzalez Alvarez%' OR
		
		Autor like '%Fiscalia General del Estado%' OR
		Autor like '%Fiscalia General%' OR
		Autor like '%Fiscal General%' OR
		Autor like '%titular de la Fiscalía General del Estado %' OR
		Autor like '%Luis carlos najera gutierrez de velasco%' OR
		Autor like '%Luis carlos najera%' OR
		Autor like '%Luis Carlos najera gutierrez%' OR
		Autor like '%Luis Carlos najera%'

)
GROUP BY n.periodico, n.NumeroPagina
UNION
	SELECT 'NACIONAL' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina 3','../clientesPDF/jalisco/SE CAMBIA POR Columnas.pdf' as pdf,'Jalisco',(17) as Pagina
UNION
SELECT
'NACIONAL',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	p.estado,(18) as Pagina
FROM
	noticiasDia n,
	(SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o,
	periodicos p,
	seccionesPeriodicos s
WHERE
	p.idPeriodico not in (149,155) AND
	n.periodico=o.periodico AND
	n.periodico=p.idPeriodico AND 
	s.idSeccion=n.Seccion AND
	p.idPeriodico=n.Periodico AND
	fecha=CURDATE() AND (
		Texto like '% Gobernador del estado de Jalisco %' OR
		Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
		Texto like '%Jorge Aristoteles Sandoval%' OR
		Texto like '%Aristoteles Sandoval Diaz%' OR
		Texto like '%Aristoteles Sandoval%' OR
		Texto like '%Sandoval Diaz%' OR
		
		Texto like '%Gobierno del estado de Jalisco%' OR
		Texto like '%Gobierno del estado Jalisco%' OR
		Texto like '%Gobierno de Jalisco%' OR
		

		Texto like '%Estado de Jalisco%' OR
		Texto like '%Jalisco%' OR
		Texto like '%Guadalajara%' OR
		Texto like '%Zapopan%' OR
		Texto like '%Tlajomulco de Zuniga%' OR
		Texto like '%Tlajomulco%' OR
		Texto like '%Enrique Alfaro Ramirez%' OR
		Texto like '%Enrique Alfaro%' OR
		Texto like '%Alfaro Ramirez%' OR
		Texto like '%Hugo Luna Vazquez%' OR
		Texto like '%Hugo Luna%' OR
		Texto like '%Coordinador estatal  de Movimiento ciudadano Jalisco%' OR
		Texto like '%Movimiento Ciudadano Jalisco%' OR
		Texto like '%Movimiento Ciudadano en Jalisco%' OR
		Texto like '%Movimiento Ciudadano de Jalisco%' OR

		Titulo like '% Gobernador del estado de Jalisco %' OR
		Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
		Titulo like '%Jorge Aristoteles Sandoval%' OR
		Titulo like '%Aristoteles Sandoval Diaz%' OR
		Titulo like '%Aristoteles Sandoval%' OR
		Titulo like '%Sandoval Diaz%' OR
		
		Titulo like '%Gobierno del estado de Jalisco%' OR
		Titulo like '%Gobierno del estado Jalisco%' OR
		Titulo like '%Gobierno de Jalisco%' OR


		Encabezado like '% Gobernador del estado de Jalisco %' OR
		Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Jorge Aristoteles Sandoval%' OR
		Encabezado like '%Aristoteles Sandoval Diaz%' OR
		Encabezado like '%Aristoteles Sandoval%' OR
		Encabezado like '%Sandoval Diaz%' OR
		Encabezado like '%Gobierno del estado de Jalisco%' OR
		Encabezado like '%Gobierno del estado Jalisco%' OR
		Encabezado like '%Gobierno de Jalisco%'
)


)Derived
GROUP BY Periodico,NumeroPagina
ORDER BY Pagina
 LIMIT $limit1,$limit2";
            
            return $query;
            break;
        default:
            break;
    }
}
?>
