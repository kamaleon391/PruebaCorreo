<?php
function query($op, $fecha, $limit1, $limit2)
{
/*
noticiasDia = "(SELECT 'Gobernador' as Tema, Periodico, Titulo, Texto, Encabezado, Seccion, NumeroPagina, Fecha, PaginaPeriodico, Categoria,activo,idEditorial FROM noticiasMensual WHERE Fecha='".$fecha."'
UNION ALL
SELECT 'Gobernador' as Tema, Periodico, Titulo, Texto, Encabezado, Seccion, NumeroPagina, Fecha, PaginaPeriodico, Categoria,activo,idEditorial FROM  noticiasAnual WHERE Fecha='".$fecha."'
UNION ALL
SELECT 'Gobernador' as Tema, Periodico, Titulo, Texto, Encabezado, Seccion, NumeroPagina, Fecha, PaginaPeriodico, Categoria,activo,idEditorial FROM  noticiasSemana WHERE Fecha='".$fecha."'
)";
 */
//noticiasDia = "(SELECT 'Gobernador' as Tema, Periodico, Titulo, Texto, Encabezado, Seccion, NumeroPagina, Fecha, PaginaPeriodico, Categoria FROM noticiasAnual WHERE Fecha='".$fecha."')";

    switch ($op) {
    case 1: // PRIMERAS PLANAS
        $query = "SELECT ROUND(COUNT(*)/20) as 'Paginas' FROM
(
SELECT Tema,Periodico, Titulo, Texto, Seccion, NumeroPagina, pdf, jalisco, Pagina FROM (
SELECT 'Gobernador' as Tema,'Periodico','Titulo','Texto','' as Seccion,'NumeroPagina','../clientesPDF/jalisco/Gobernador.pdf' as pdf,'Jalisco',(1) as Pagina
UNION ALL
SELECT 'Gobernador',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
        p.estado,(2) as Pagina
		FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
		WHERE
                n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
		n.periodico=o.periodico AND
                (n.Categoria=3 OR n.Categoria =21)
				AND (
                    Titulo like '%Jalisco%' OR
                    Titulo like '%Aristoteles Sandoval Diaz%' OR
                    Titulo like '%jorge Aristoteles Sandoval%' OR
                    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Sandoval Diaz%' OR
                    Titulo like '%Gobernador de jalisco%' OR
                    Titulo like '%Gobernador del Estado de  jalisco%' OR
                    Titulo like '%Guadalajara%' OR

                    Texto like '%Jalisco%' OR
                    Texto like '%Aristoteles Sandoval Diaz%' OR
                    Texto like '%jorge Aristoteles Sandoval%' OR
                    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Texto like '%Sandoval Diaz%' OR
                    Texto like '%Gobernador de jalisco%' OR
                    Texto like '%Gobernador del Estado de  jalisco%' OR
                    Texto like '%Guadalajara%' OR

                    Encabezado like '%Jalisco%' OR
                    Encabezado like '%Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%jorge Aristoteles Sandoval%' OR
                    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Sandoval Diaz%' OR
                    Encabezado like '%Gobernador de jalisco%' OR
                    Encabezado like '%Gobernador del Estado de  jalisco%' OR
                    Encabezado like '%Guadalajara%'
                ) AND n.periodico=p.idPeriodico AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina
UNION ALL
SELECT 'Gobernador',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
        p.estado,(3) as Pagina
		FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
		WHERE
                n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
		n.periodico=o.periodico
				AND (
                    Titulo like '%Jalisco%' OR
                    Titulo like '%Aristoteles Sandoval Diaz%' OR
                    Titulo like '%jorge Aristoteles Sandoval%' OR
                    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Sandoval Diaz%' OR
                    Titulo like '%Gobernador de jalisco%' OR
                    Titulo like '%Gobernador del Estado de  jalisco%' OR
                    Titulo like '%Guadalajara%' OR

                    Texto like '%Jalisco%' OR
                    Texto like '%Aristoteles Sandoval Diaz%' OR
                    Texto like '%jorge Aristoteles Sandoval%' OR
                    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Texto like '%Sandoval Diaz%' OR
                    Texto like '%Gobernador de jalisco%' OR
                    Texto like '%Gobernador del Estado de  jalisco%' OR
                    Texto like '%Guadalajara%' OR

                    Encabezado like '%Jalisco%' OR
                    Encabezado like '%Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%jorge Aristoteles Sandoval%' OR
                    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Sandoval Diaz%' OR
                    Encabezado like '%Gobernador de jalisco%' OR
                    Encabezado like '%Gobernador del Estado de  jalisco%' OR
                    Encabezado like '%Guadalajara%'
                ) AND n.periodico=p.idPeriodico AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Innovacion y Tecnologia',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
        p.estado,(4) as Pagina
		FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
		WHERE
                n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
		n.periodico=o.periodico
				AND (
    Texto like '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%' OR
    Texto like '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%' OR
    Texto like '%Secretaria de Innovacion, Ciencia y Tecnologia del estado de jalisco%' OR
    Texto like '%Jaime Reyes Robles%' OR

    Titulo like '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%' OR
    Titulo like '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%' OR
    Titulo like '%Secretaria de Innovacion, Ciencia y Tecnologia del estado de jalisco%' OR
    Titulo like '%Jaime Reyes Robles%' OR

    Encabezado like '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%' OR
    Encabezado like '%Secretaria de Innovacion, Ciencia y Tecnologia del estado de jalisco%' OR
    Encabezado like '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%' OR
    Encabezado like '%Jaime Reyes Robles%' OR

    PieFoto like '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%' OR
    PieFoto like '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%' OR
    PieFoto like '%Secretaria de Innovacion, Ciencia y Tecnologia del estado de jalisco%' OR
    PieFoto like '%Jaime Reyes Robles%' OR

    Autor like '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%' OR
    Autor like '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%' OR
    Autor like '%Secretaria de Innovacion, Ciencia y Tecnologia del estado de jalisco%' OR
    Autor like '%Jaime Reyes Robles%'
)AND n.periodico=p.idPeriodico AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'SEDECO',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(5) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op order by op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like '%secretaria de desarrollo economico de jalisco%'
    OR
    Texto like'%secretaria de desarrollo economico jalisco%'
    OR
    Texto like'%secretaria de desarrollo economico del estado de jalisco%'
    OR
    Texto like'%jose palacios jimenez%'
    OR
    Texto like'%jose palacios%'
    OR
    Texto like'%palacios jimenez%'

    OR
    Titulo like '%secrearia de desarrollo economico de jalisco%'
    OR
    Titulo like'%secretaria de desarrollo economico jalisco%'
    OR
    Titulo like'%secretaria de desarrollo economico del estado de jalisco%'
    OR
    Titulo like'%jose palacios jimenez%'
    OR
    Titulo like'%jose palacios%'
    OR
    Titulo like'%palacios jimenez%'

    OR
    Encabezado like '%secrearia de desarrollo economico de jalisco%'
    OR
    Encabezado like'%secretaria de desarrollo economico jalisco%'
    OR
    Encabezado like'%secretaria de desarrollo economico del estado de jalisco%'
    OR
    Encabezado like'%jose palacios jimenez%'
    OR
    Encabezado like'%jose palacios%'
    OR
    Encabezado like'%palacios jimenez%'

    OR
    PieFoto like '%secrearia de desarrollo economico de jalisco%'
    OR
    PieFoto like'%secretaria de desarrollo economico jalisco%'
    OR
    PieFoto like'%secretaria de desarrollo economico del estado de jalisco%'
    OR
    PieFoto like'%jose palacios jimenez%'
    OR
    PieFoto like'%jose palacios%'
    OR
    PieFoto like'%palacios jimenez%'
) AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'SEDIS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(6) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like '%Secretaria de Desarrollo e Integracion Social Jalisco%' OR
    Texto like '%Secretaria de Desarrollo e Integracion Social de Jalisco%' OR
    Texto like '%Secretaria de Desarrollo e Integracion Social del estado de jalisco%' OR
    Texto like '%Daviel Trujillo Cuevas%' OR

    Titulo like '%Secretaria de Desarrollo e Integracion Social Jalisco%' OR
    Titulo like '%Secretaria de Desarrollo e Integracion Social de Jalisco%' OR
    Titulo like '%Secretaria de Desarrollo e Integracion Social del estado de jalisco%' OR
    Titulo like '%Daviel Trujillo Cuevas%' OR

    Encabezado like '%Secretaria de Desarrollo e Integracion Social Jalisco%' OR
    Encabezado like '%Secretaria de Desarrollo e Integracion Social del estado de jalisco%' OR
    Encabezado like '%Secretaria de Desarrollo e Integracion Social de Jalisco%' OR
    Encabezado like '%Daviel Trujillo Cuevas%' OR

    PieFoto like '%Secretaria de Desarrollo e Integracion Social Jalisco%' OR
    PieFoto like '%Secretaria de Desarrollo e Integracion Social de Jalisco%' OR
    PieFoto like '%Secretaria de Desarrollo e Integracion Social del estado de jalisco%' OR
    PieFoto like '%Daviel Trujillo Cuevas%' OR

    Autor like '%Secretaria de Desarrollo e Integracion Social Jalisco%' OR
    Autor like '%Secretaria de Desarrollo e Integracion Social de Jalisco%' OR
    Autor like '%Secretaria de Desarrollo e Integracion Social del estado de jalisco%' OR
    Autor like '%Daviel Trujillo Cuevas%'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'RURAL',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(7) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like '%Secretaria de Desarrollo Rural Jalisco%' OR
    Texto like '%Secretaria de Desarrollo Rural de Jalisco%' OR
    Texto like '%Secretaria de Desarrollo Rural del estado de jalisco%' OR
    Texto like '%Hector Padilla Gutierrez%' OR

    Titulo like '%Secretaria de Desarrollo Rural Jalisco%' OR
    Titulo like '%Secretaria de Desarrollo Rural de Jalisco%' OR
    Titulo like '%Secretaria de Desarrollo Rural del estado de jalisco%' OR
    Titulo like '%Hector Padilla Gutierrez%' OR

    Encabezado like '%Secretaria de Desarrollo Rural Jalisco%' OR
    Encabezado like '%Secretaria de Desarrollo Rural del estado de jalisco%' OR
    Encabezado like '%Secretaria de Desarrollo Rural de Jalisco%' OR
    Encabezado like '%Hector Padilla Gutierrez%' OR

    PieFoto like '%Secretaria de Desarrollo Rural Jalisco%' OR
    PieFoto like '%Secretaria de Desarrollo Rural de Jalisco%' OR
    PieFoto like '%Secretaria de Desarrollo Rural del estado de jalisco%' OR
    PieFoto like '%Hector Padilla Gutierrez%' OR

    Autor like '%Secretaria de Desarrollo Rural Jalisco%' OR
    Autor like '%Secretaria de Desarrollo Rural de Jalisco%' OR
    Autor like '%Secretaria de Desarrollo Rural del estado de jalisco%' OR
    Autor like '%Hector Padilla Gutierrez%'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'SEJ',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(8) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
        Texto like'%educacion%' AND (Texto like '%jalisco%' OR Texto like '%sandoval diaz%' OR Texto like '%sandoval%') OR
    Texto like '%Secretaria de Educacion Jalisco%' OR
    Texto like '%Secretaria de Educacion de Jalisco%' OR
    Texto like '%Secretaria de Educacion del estado de jalisco%' OR
    Texto like '%Francisco Ayon lopez%' OR
    Texto like '%Ayon lopez%' OR
    Texto like '%Paco Ayon lopez%' OR
    Texto like '%papayon lopez%' OR

    Titulo like '%Secretaria de Educacion Jalisco%' OR
    Titulo like '%Secretaria de Educacion de Jalisco%' OR
    Titulo like '%Secretaria de Educacion del estado de jalisco%' OR
    Titulo like '%Francisco Ayon lopez%' OR
    Titulo like '%Ayon lopez%' OR
    Titulo like '%Paco Ayon lopez%' OR
    Titulo like '%papayon lopez%' OR
        Titulo like 'sej'   OR

    Encabezado like '%Secretaria de Educacion Jalisco%' OR
    Encabezado like '%Secretaria de Educacion de Jalisco%' OR
    Encabezado like '%Secretaria de Educacion del estado de jalisco%' OR
    Encabezado like '%Francisco Ayon lopez%' OR
    Encabezado like '%Ayon lopez%' OR
    Encabezado like '%Paco Ayon lopez%' OR
    Encabezado like '%papayon lopez%' OR
        Encabezado like 'sej'   OR

    PieFoto like '%Secretaria de Educacion Jalisco%' OR
    PieFoto like '%Secretaria de Educacion de Jalisco%' OR
    PieFoto like '%Secretaria de Educacion del estado de jalisco%' OR
    PieFoto like '%Francisco Ayon lopez%' OR
    PieFoto like '%Ayon lopez%' OR
    PieFoto like '%Paco Ayon lopez%' OR
    PieFoto like '%papayon lopez%' OR


    Autor like '%Secretaria de Educacion Jalisco%' OR
    Autor like '%Secretaria de Educacion de Jalisco%' OR
    Autor like '%Secretaria de Educacion del estado de jalisco%' OR
    Autor like '%Francisco Ayon lopez%' OR
    Autor like '%Ayon lopez%' OR
    Autor like '%Paco Ayon lopez%' OR
    Autor like '%papayon lopez%'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina
UNION ALL
SELECT 'Fiscalia',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(9) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%fiscal general%' OR
	Texto like '%fiscalia general%' OR
	Texto like '%luis carlos najera%' OR
	Texto like '%Carlos Najera Gutierrez%' OR
	Texto like '%Najera Gutierrez%' OR
	Texto like '%titular de la fiscalia general%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%fiscal general%' OR
	Titulo like '%fiscalia general%' OR
	Titulo like '%luis carlos najera%' OR
	Titulo like '%Carlos Najera Gutierrez%' OR
	Titulo like '%Najera Gutierrez%' OR
	Titulo like '%titular de la fiscalia general%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%fiscal general%' OR
	Encabezado like '%fiscalia general%' OR
	Encabezado like '%luis carlos najera%' OR
	Encabezado like '%Carlos Najera Gutierrez%' OR
	Encabezado like '%Najera Gutierrez%' OR
	Encabezado like '%titular de la fiscalia general%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'Movilidad',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(10) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico=o.periodico
AND(
    Texto like '%secrearia de movilidad de jalisco%'
    OR
    Texto like '%movilidad jalisco%'
    OR
    Texto like'%secretaria de movilidad jalisco%'
    OR
    Texto like'%secretaria de movilidad del estado de jalisco%'
    OR
    Texto like'%mauricio gudiño coronado%'
    OR
    Texto like'%mauricio gudiño%'
    OR
    Texto like'%gudiño coronado%'

    OR
    Titulo like '%secrearia de movilidad de jalisco%'
    OR
    Titulo like '%movilidad jalisco%'
    OR
    Titulo like'%secretaria de movilidad jalisco%'
    OR
    Titulo like'%secretaria de movilidad del estado de jalisco%'
    OR
    Titulo like'%mauricio gudiño coronado%'
    OR
    Titulo like'%mauricio gudiño%'
    OR
    Titulo like'%gudiño coronado%'

    OR
    Encabezado like '%secrearia de movilidad de jalisco%'
    OR
    Encabezado like '%movilidad jalisco%'
    OR
    Encabezado like'%secretaria de movilidad jalisco%'
    OR
    Encabezado like'%secretaria de movilidad del estado de jalisco%'
    OR
    Encabezado like'%mauricio gudiño coronado%'
    OR
    Encabezado like'%mauricio gudiño%'
    OR
    Encabezado like'%gudiño coronado%'

    OR
    PieFoto like '%secrearia de movilidad de jalisco%'
    OR
    PieFoto like '%movilidad jalisco%'
    OR
    PieFoto like'%secretaria de movilidad jalisco%'
    OR
    PieFoto like'%secretaria de movilidad del estado de jalisco%'
    OR
    PieFoto like'%mauricio gudiño coronado%'
    OR
    PieFoto like'%mauricio gudiño%'
    OR
    PieFoto like'%gudiño coronado%'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Secretaria de Gobierno',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(11) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico=o.periodico
AND(
    Texto like '%secrearia general de jalisco%'
    OR
    Texto like'%secretaria general jalisco%'
    OR
    Texto like'%secretaria general del estado de jalisco%'
    OR
    Texto like'%roberto lopez lara%'
    OR
    Texto like'%chino lopez%'
    OR
    Texto like'%roberto lopez%'

    OR
    Titulo like '%secrearia general de jalisco%'
    OR
    Titulo like'%secretaria general jalisco%'
    OR
    Titulo like'%secretaria general del estado de jalisco%'
    OR
    Titulo like'%roberto lopez lara%'
    OR
    Titulo like'%chino lopez%'
    OR
    Titulo like'%roberto lopez%'

    OR
    Encabezado like '%secrearia general de jalisco%'
    OR
    Encabezado like'%secretaria general jalisco%'
    OR
    Encabezado like'%secretaria general del estado de jalisco%'
    OR
    Encabezado like'%roberto lopez lara%'
    OR
    Encabezado like'%chino lopez%'
    OR
    Encabezado like'%roberto lopez%'

    OR
    PieFoto like '%secrearia general de jalisco%'
    OR
    PieFoto like'%secretaria general jalisco%'
    OR
    PieFoto like'%secretaria general del estado de jalisco%'
    OR
    PieFoto like'%roberto lopez lara%'
    OR
    PieFoto like'%chino lopez%'
    OR
    PieFoto like'%roberto lopez%'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina



UNION ALL
SELECT 'Infraestructura',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(12) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like'%obras publicas%' AND (Texto like '%jalisco%' OR Texto like '%sandoval diaz%') OR
    Texto like'%infraestructura%' AND (Texto like '%jalisco%' OR Texto like '%sandoval diaz%') OR
    Texto like '%Secretaria de infraestructura y obra publica jalisco%' OR
    Texto like '%Secretaria de infraestructura y obra publica de jalisco%' OR
    Texto like '%Secretaria de infraestructura y obra publica del estado de jalisco%' OR
    Texto like '%Roberto Davalos Lopez%' OR
    Texto like '%Davalos Lopez%' OR
    Texto like '%Roberto Davalos%' OR

    Titulo like '%Secretaria de infraestructura y obra publica jalisco%' OR
    Titulo like '%Secretaria de infraestructura y obra publica de jalisco%' OR
    Titulo like '%Secretaria de infraestructura y obra publica del estado de jalisco%' OR
    Titulo like '%Roberto Davalos Lopez%' OR
    Titulo like '%Davalos Lopez%' OR
    Titulo like '%Roberto Davalos%' OR
    (Titulo like '%infraestructura%' AND Titulo like '%jalisco%'  )OR
    (Titulo like '%obra publica%' AND Titulo like '%jalisco%'  )OR

    Encabezado like '%Secretaria de infraestructura y obra publica jalisco%' OR
    Encabezado like '%Secretaria de infraestructura y obra publica de jalisco%' OR
    Encabezado like '%Secretaria de infraestructura y obra publica del estado de jalisco%' OR
    Encabezado like '%Roberto Davalos Lopez%' OR
    Encabezado like '%Davalos Lopez%' OR
    Encabezado like '%Roberto Davalos%' OR
    (Encabezado like '%infraestructura%' AND Encabezado like '%jalisco%'  ) OR
    (Encabezado like '%obra publica%' AND Encabezado like '%jalisco%'  ) OR

    PieFoto like '%Secretaria de infraestructura y obra publica jalisco%' OR
    PieFoto like '%Secretaria de infraestructura y obra publica de jalisco%' OR
    PieFoto like '%Secretaria de infraestructura y obra publica del estado de jalisco%' OR
    PieFoto like '%Roberto Davalos Lopez%' OR
    PieFoto like '%Davalos Lopez%' OR
    PieFoto like '%Roberto Davalos%' OR

    Autor like '%Secretaria de infraestructura y obra publica jalisco%' OR
    Autor like '%Secretaria de infraestructura y obra publica de jalisco%' OR
    Autor like '%Secretaria de infraestructura y obra publica del estado de jalisco%' OR
    Autor like '%Roberto Davalos Lopez%' OR
    Autor like '%Davalos Lopez%' OR
    Autor like '%Roberto Davalos%'
) AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina



UNION ALL
SELECT 'SEMADET',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(13) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%' OR
    Texto like '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%' OR
    Texto like '%Secretaria de Medio Ambiente y Desarrollo Territorial del estado de jalisco%' OR
    Texto like '%Maria Magdalena Ruiz Mejia%' OR
    Texto like '%Magdalena Ruiz Mejia%' OR

    Titulo like '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%' OR
    Titulo like '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%' OR
    Titulo like '%Secretaria de Medio Ambiente y Desarrollo Territorial del estado de jalisco%' OR
    Titulo like '%Maria Magdalena Ruiz Mejia%' OR
    Titulo like '%Magdalena Ruiz Mejia%' OR

    Encabezado like '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%' OR
    Encabezado like '%Secretaria de Medio Ambiente y Desarrollo Territorial del estado de jalisco%' OR
    Encabezado like '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%' OR
    Encabezado like '%Maria Magdalena Ruiz Mejia%' OR
    Encabezado like '%Magdalena Ruiz Mejia%' OR

    PieFoto like '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%' OR
    PieFoto like '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%' OR
    PieFoto like '%Secretaria de Medio Ambiente y Desarrollo Territorial del estado de jalisco%' OR
    PieFoto like '%Maria Magdalena Ruiz Mejia%' OR
    PieFoto like '%Magdalena Ruiz Mejia%' OR

    Autor like '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%' OR
    Autor like '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%' OR
    Autor like '%Secretaria de Medio Ambiente y Desarrollo Territorial del estado de jalisco%' OR
    Autor like '%Maria Magdalena Ruiz Mejia%' OR
    Autor like '%Magdalena Ruiz Mejia%'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'SEPAF',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(14) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND     (
    Texto like'%planeacion administracion y finanzas del estado de Jalisco%' OR
    Texto like'%planeacion administracion y finanzas de Jalisco%' OR
    Texto like'%planeacion administracion y finanzas Jalisco%' OR

    Texto like'%hector rafael perez partida%' OR
    Texto like'%hector rafael perez%' OR
    Texto like'%hector perez partida%' OR
    Texto like'%perez partida%' OR

    Texto like'%secretaria de planeacion Jalisco%' OR
    Texto like'%secretaria de planeacion de Jalisco%' OR
    Texto like'%secretaria de planeacion del estado de Jalisco%'

OR  Texto like '%administracion y finanzas del estado de jalisco%'
OR  Texto like '%administracion y finanzas de jalisco%'
OR  Texto like'%administracion y finanzas jalisco%'

OR  Titulo like'%planeacion administracion y finanzas del estado de Jalisco%'
OR  Titulo like'%planeacion administracion y finanzas de Jalisco%'
OR  Titulo like'%planeacion administracion y finanzas Jalisco%' OR

    Titulo like'%hector rafael perez partida%' OR
    Titulo like'%hector rafael perez%' OR
    Titulo like'%hector perez partida%' OR
    Titulo like'%perez partida%'

OR  Titulo like'%administracion y finanzas jalisco%'
OR  Titulo like 'administracion y finanzas de jalisco'
OR  Titulo like 'administracion y finanzas del estado de jalisco'

OR
    Encabezado like'%secretaria de planeacion Jalisco%' OR
    Encabezado like'%secretaria de planeacion de Jalisco%' OR
    Encabezado like'%secretaria de planeacion del estado de Jalisco%'

OR  Encabezado like '%planeacion administracion y  finanzas del estado de jalisco%'
OR  Encabezado like '%planeacion administracion de jalisco%'
OR  Encabezado like 'administracion y finanzas jalisco'

OR  Encabezado like'%hector rafael perez partida%' OR
    Encabezado like'%hector rafael perez%' OR
    Encabezado like'%hector perez partida%' OR
    Encabezado like'%perez partida%'

AND
    (
        Texto like '%jalisco%'
    )
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Procuraduria Social',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(15) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like '%procuraduria social de jalisco%'
    OR
    Texto like'%procuraduria social jalisco%'
    OR
    Texto like'%procuraduria social del estado de jalisco%'
    OR
    Texto like'%felicitas velazquez serrano%'
    OR
    Texto like'%felicitas velazquez%'
    OR
    Texto like'%velazquez serrano%'

    OR
    Titulo like '%procuraduria social de jalisco%'
    OR
    Titulo like'%procuraduria social jalisco%'
    OR
    Titulo like'%procuraduria social del estado de jalisco%'
    OR
    Titulo like'%felicitas velazquez serrano%'
    OR
    Titulo like'%felicitas velazquez%'
    OR
    Titulo like'%velazquez serrano%'

    OR
    Encabezado like '%procuraduria social de jalisco%'
    OR
    Encabezado like'%procuraduria social jalisco%'
    OR
    Encabezado like'%procuraduria social del estado de jalisco%'
    OR
    Encabezado like'%felicitas velazquez serrano%'
    OR
    Encabezado like'%felicitas velazquez%'
    OR
    Encabezado like'%velazquez serrano%'

    OR
    PieFoto like '%procuraduria social de jalisco%'
    OR
    PieFoto like'%procuraduria social jalisco%'
    OR
    PieFoto like'%procuraduria social del estado de jalisco%'
    OR
    PieFoto like'%felicitas velazquez serrano%'
    OR
    PieFoto like'%felicitas velazquez%'
    OR
    PieFoto like'%velazquez serrano%'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Salud',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(16) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
        Texto like'%SALUD%' AND (Texto like '%jalisco%' OR Texto like '%sandoval diaz%' OR Texto like '%sandoval%') OR
    Texto like '%Secretaria salud jalisco%' OR
    Texto like '%Secretaria de salud Jalisco%' OR
    Texto like '%Secretaria de salud de Jalisco%' OR
    Texto like '%Secretaria de salud del estado de jalisco%' OR
    Texto like '%Jaime Agustin Gonzalez alvarez%' OR
    Texto like '%Jaime Gonzalez alvarez%' OR
    Texto like '%Jaime Agustin Gonzalez%' OR
    Texto like '%Jaime A Gonzalez alvarez%' OR

    Titulo like '%Secretaria salud jalisco%' OR
    Titulo like '%Secretaria de salud Jalisco%' OR
    Titulo like '%Secretaria de salud de Jalisco%' OR
    Titulo like '%Secretaria de salud del estado de jalisco%' OR
    Titulo like '%Jaime Agustin Gonzalez alvarez%' OR
    Titulo like '%Jaime Gonzalez alvarez%' OR
    Titulo like '%Jaime Agustin Gonzalez%' OR
    Titulo like '%Jaime A Gonzalez alvarez%' OR

    Encabezado like '%Secretaria salud jalisco%' OR
    Encabezado like '%Secretaria de salud Jalisco%' OR
    Encabezado like '%Secretaria de salud de Jalisco%' OR
    Encabezado like '%Secretaria de salud del estado de jalisco%' OR
    Encabezado like '%Jaime Agustin Gonzalez alvarez%' OR
    Encabezado like '%Jaime Gonzalez alvarez%' OR
    Encabezado like '%Jaime Agustin Gonzalez%' OR
    Encabezado like '%Jaime A Gonzalez alvarez%' OR

    PieFoto like '%Secretaria salud jalisco%' OR
    PieFoto like '%Secretaria de salud Jalisco%' OR
    PieFoto like '%Secretaria de salud de Jalisco%' OR
    PieFoto like '%Secretaria de salud del estado de jalisco%' OR
    PieFoto like '%Jaime Agustin Gonzalez alvarez%' OR
    PieFoto like '%Jaime Gonzalez alvarez%' OR
    PieFoto like '%Jaime Agustin Gonzalez%' OR
    PieFoto like '%Jaime A Gonzalez alvarez%' OR

    Autor like '%Secretaria salud jalisco%' OR
    Autor like '%Secretaria de salud Jalisco%' OR
    Autor like '%Secretaria de salud de Jalisco%' OR
    Autor like '%Secretaria de salud del estado de jalisco%' OR
    Autor like '%Jaime Agustin Gonzalez alvarez%' OR
    Autor like '%Jaime Gonzalez alvarez%' OR
    Autor like '%Jaime Agustin Gonzalez%' OR
    Autor like '%Jaime A Gonzalez alvarez%'
)   AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'STPS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(17) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like '%secrearia del trabajo y prevision social de jalisco%'
    OR
    Texto like'%secretaria del trabajo y prevision social jalisco%'
    OR
    Texto like'%secretaria del trabajo y prevision social del estado de jalisco%'
    OR
    Texto like'%Hector Pizano Ramos%'
    OR
    Texto like'%Hector Pizano%'
    OR
    Texto like'%Pizano Ramos%'

    OR
    Titulo like '%secrearia del trabajo y prevision social de jalisco%'
    OR
    Titulo like'%secretaria del trabajo y prevision social jalisco%'
    OR
    Titulo like'%secretaria del trabajo y prevision social del estado de jalisco%'
    OR
    Titulo like'%Hector Pizano Ramos%'
    OR
    Titulo like'%Hector Pizano%'
    OR
    Titulo like'%Pizano Ramos%'

    OR
    Encabezado like '%secrearia del trabajo y prevision social de jalisco%'
    OR
    Encabezado like'%secretaria del trabajo y prevision social jalisco%'
    OR
    Encabezado like'%secretaria del trabajo y prevision social del estado de jalisco%'
    OR
    Encabezado like'%Hector Pizano Ramos%'
    OR
    Encabezado like'%Hector Pizano%'
    OR
    Encabezado like'%Pizano Ramos%'

    OR
    PieFoto like '%secrearia del trabajo y prevision social de jalisco%'
    OR
    PieFoto like'%secretaria del trabajo y prevision social jalisco%'
    OR
    PieFoto like'%secretaria del trabajo y prevision social del estado de jalisco%'
    OR
    PieFoto like'%Hector Pizano Ramos%'
    OR
    PieFoto like'%Hector Pizano%'
    OR
    PieFoto like'%Pizano Ramos%'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'Turismo',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(18) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like '%Secretaria de Turismo Jalisco%' OR
    Texto like '%Secretaria de Turismo de Jalisco%' OR
    Texto like '%Secretaria de Turismo del estado de jalisco%' OR
    Texto like '%Jesus Enrique Ramos Flores%' OR
    Texto like '%Jesus Ramos Flores%' OR
    Texto like '%Enrique Ramos Flores%' OR

    Titulo like '%Secretaria de Turismo Jalisco%' OR
    Titulo like '%Secretaria de Turismo de Jalisco%' OR
    Titulo like '%Secretaria de Turismo del estado de jalisco%' OR
    Titulo like '%Jesus Enrique Ramos Flores%' OR
    Titulo like '%Jesus Ramos Flores%' OR
    Titulo like '%Enrique Ramos Flores%' OR

    Encabezado like '%Secretaria de Turismo Jalisco%' OR
    Encabezado like '%Secretaria de Turismo del estado de jalisco%' OR
    Encabezado like '%Secretaria de Turismo de Jalisco%' OR
    Encabezado like '%Jesus Enrique Ramos Flores%' OR
    Encabezado like '%Jesus Ramos Flores%' OR
    Encabezado like '%Enrique Ramos Flores%' OR

    PieFoto like '%Secretaria de Turismo Jalisco%' OR
    PieFoto like '%Secretaria de Turismo de Jalisco%' OR
    PieFoto like '%Secretaria de Turismo del estado de jalisco%' OR
    PieFoto like '%Jesus Enrique Ramos Flores%' OR
    PieFoto like '%Jesus Ramos Flores%' OR
    PieFoto like '%Enrique Ramos Flores%' OR

    Autor like '%Secretaria de Turismo Jalisco%' OR
    Autor like '%Secretaria de Turismo de Jalisco%' OR
    Autor like '%Secretaria de Turismo del estado de jalisco%' OR
    Autor like '%Jesus Enrique Ramos Flores%' OR
    Autor like '%Jesus Ramos Flores%' OR
    Autor like '%Enrique Ramos Flores%'
) AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'Contraloria',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(19) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
    Texto like '%contraloria del estado de jalisco%'
    OR
    Texto like'%contraloria de jalisco%'
    OR
    Texto like'%juan jose bañuelos guardado%'
    OR
    Texto like'%juan jose bañuelos%'
    OR
    Texto like'%bañuelos guardado%'
    OR
    Texto like'%contraloria jalisco%'

    OR
    Titulo like '%contraloria del estado de jalisco%'
    OR
    Titulo like'%contraloria de jalisco%'
    OR
    Titulo like'%juan jose bañuelos guardado%'
    OR
    Titulo like'%juan jose bañuelos%'
    OR
    Titulo like'%bañuelos guardado%'

    OR
    Encabezado like '%contraloria del estado de jalisco%'
    OR
    Encabezado like'%contraloria de jalisco%'
    OR
    Encabezado like'%juan jose bañuelos guardado%'
    OR
    Encabezado like'%juan jose bañuelos%'
    OR
    Encabezado like'%bañuelos guardado%'

    OR
    PieFoto like '%contraloria del estado de jalisco%'
    OR
    PieFoto like'%contraloria de jalisco%'
    OR
    PieFoto like'%juan jose bañuelos guardado%'
    OR
    PieFoto like'%juan jose bañuelos%'
    OR
    PieFoto like'%bañuelos guardado%'
)
AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Municipios',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
p.estado,(19) as Pagina
FROM noticiasDia n, (SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.periodico=o.periodico
AND(
Texto like '% Guadalajara %' OR
Texto like '% Zapopan %' OR
Texto like '% Tonala %' OR
Texto like '% Tlaquepaque%' OR
Texto like '% Tlajomulco%' OR
Texto like '% ZMG%' OR
Texto like '% Chapala%' OR
Texto like '% Vallarta%' OR
Texto like '% ocotlan%' OR
Texto like '% los altos de jalisco%' OR
Texto like '% La barca jalisco%' OR
Texto like '% Pihuamo%' OR
Texto like '% tecalitlan%' OR
Texto like '% jilotlan de los dolores%' OR
Texto like '% Santa maria del oro%' OR
Texto like '% quitupan%' OR
Texto like '% valle de juarez%' OR
Texto like '%tizapan el alto%' OR
Texto like '%Jamay%' OR
Texto like '%Tenacatita%' OR
Texto like '%temacapulin%' OR
Texto like '%municipio de la huerta%' OR
Texto like '%ribera de chapala%' OR
Texto like '%ajijic%' OR
Texto like '% ZMG %' OR
Texto like '%Zona metropolitana de Guadalajara%' OR
Texto like '%El Salto Jalisco%' OR
Texto like '% ojuelos %' OR
Texto like '%Ramiro Hernande Garcia%' OR
Texto like '%Barba Mariscal%' OR
Texto like '%Jorge Arana Arana%' OR
Texto like '%Penal de Puente Grande %' OR
Texto like '%Zapotlanejo%' OR
Texto like '%Municipio de  Tala %' OR
Texto like '%Lagos de moreno%' OR
Texto like '%San juan de los lagos%' OR
Texto like '%sayula%' OR
Texto like '%ciudad guzman%' OR
Texto like '% ayutla Jalisco%' OR
Texto like '%el grullo Jalisco%' OR
Texto like '%Ayotlan%' OR
Texto like '%tomatlan Jalisco %' OR
Texto like '%villa purificacion %' OR
Texto like '%tecalitlan %' OR
Texto like '%tuxpan  %' OR

Titulo like '%Jalisco%' OR
Titulo like '%Guadalajara%' OR
Titulo like '%Zapopan%' OR
Titulo like '%Tonala%' OR
Titulo like '%Tlaquepaque%' OR
Titulo like '%Tlajomulco%' OR
Titulo like '%ZMG%' OR
Titulo like '%Chapala%' OR
Titulo like '%Vallarta%' OR
Titulo like '% ocotlan%' OR
Titulo like '%los altos de jalisco%' OR
Titulo like '%La barca jalisco%' OR
Titulo like '%Pihuamo%' OR
Titulo like '%tecalitlan%' OR
Titulo like '%jilotlan de los dolores%' OR
Titulo like '%Santa maria del oro%' OR
Titulo like '%quitupan%' OR
Titulo like '%valle de juarez%' OR
Titulo like '%tizapan el alto%' OR
Titulo like '%Jamay%' OR
Titulo like '%Tenacatita%' OR
Titulo like '%temacapulin%' OR
Titulo like '%municipio de la huerta%' OR
Titulo like '%ribera de chapala%' OR
Titulo like '%ajijic%' OR
Titulo like '% ZMG %' OR
Titulo like '%Zona metropolitana de Guadalajara%' OR
Titulo like '%El Salto Jalisco%' OR
Titulo like '% ojuelos jalisco%' OR
Titulo like '%Ramiro Hernandez Garcia%' OR
Titulo like '%Barba Mariscal%' OR
Titulo like '%Jorge Arana Arana%' OR
Titulo like '%Penal de Puente Grande %' OR
Titulo like '%Zapotlanejo%' OR
Titulo like '%Municipio de  Tala %' OR
Titulo like '%Lagos de moreno%' OR
Titulo like '%San juan de los lagos%' OR
Titulo like '%sayula%' OR
Titulo like '%ciudad guzman%' OR
Titulo like '% ayutla Jalisco%' OR
Titulo like '%el grullo %' OR
Titulo like '%Ayotlan%' OR
Titulo like '%tomatlan Jalisco %' OR
Titulo like '%villa purificacion %' OR
Titulo like '%tecalitlan %' OR
Titulo like '%tuxpan  %' OR

Encabezado like '%Jalisco%' OR
Encabezado like '%Guadalajara%' OR
Encabezado like '%Zapopan%' OR
Encabezado like '%Tonala%' OR
Encabezado like '%Tlaquepaque%' OR
Encabezado like '%Tlajomulco%' OR
Encabezado like '%ZMG%' OR
Encabezado like '%Chapala%' OR
Encabezado like '%Vallarta%' OR
Encabezado like '% ocotlan%' OR
Encabezado like '%los altos de jalisco%' OR
Encabezado like '%La barca Jalisco%' OR
Encabezado like '%Pihuamo%' OR
Encabezado like '%tecalitlan%' OR
Encabezado like '%jilotlan de los dolores%' OR
Encabezado like '%Santa maria del oro%' OR
Encabezado like '%quitupan%' OR
Encabezado like '%valle de juarez%' OR
Encabezado like '%tizapan el alto%' OR
Encabezado like '%Jamay%' OR
Encabezado like '%Tenacatita%' OR
Encabezado like '%temacapulin%' OR
Encabezado like '%municipio de la huerta%' OR
Encabezado like '%ribera de chapala%' OR
Encabezado like '%ajijic%' OR
Encabezado like '% ZMG %' OR
Encabezado like '%Zona metropolitana de Guadalajara%' OR
Encabezado like '%El Salto Jalisco%' OR
Encabezado like '% ojuelos %' OR
Encabezado like '%Ramiro Hernandez Garcia%' OR
Encabezado like '%Barba Mariscal%' OR
Encabezado like '%Jorge Arana Arana%' OR
Encabezado like '%Penal de Puente Grande %' OR
Encabezado like '%Zapotlanejo%' OR
Encabezado like '%Municipio de  Tala %' OR
Encabezado like '%Lagos de moreno%' OR
Encabezado like '%San juan de los lagos%' OR
Encabezado like '%sayula%' OR
Encabezado like '%ciudad guzman%' OR
Encabezado like '% ayutla Jalisco%' OR
Encabezado like '%el grullo %' OR
Encabezado like '%Ayotlan%' OR
Encabezado like '%tomatlan  Jalisco%' OR
Encabezado like '%villa purificacion %' OR
Encabezado like '%tecalitlan %' OR
Encabezado like '%tuxpan  %'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

)
derived GROUP BY Periodico,NumeroPagina
)
Derived
ORDER BY Pagina";
        return $query;
        break;
    case 2:
        $query = "SELECT Tema,Periodico, Titulo, Texto, Seccion, NumeroPagina, pdf,jpg,jalisco,Pagina,idEditorial,PaginaPeriodico,posicion FROM (
SELECT 'Gobernador' AS tema,p.Nombre as 'Periodico',n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
        p.estado as 'jalisco',(2) as Pagina,idEditorial,PaginaPeriodico,o.posicion
		FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
		WHERE
		n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
		n.periodico=o.periodico AND
        (n.Categoria=3 OR n.Categoria =21)
				AND (
                    Titulo like '%Jalisco%' OR
                    Titulo like '%Aristoteles Sandoval Diaz%' OR
                    Titulo like '%jorge Aristoteles Sandoval%' OR
                    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Sandoval Diaz%' OR
                    Titulo like '%Gobernador de jalisco%' OR
                    Titulo like '%Gobernador del Estado de  jalisco%' OR
                    Titulo like '%Guadalajara%' OR

                    Texto like '%Jalisco%' OR
                    Texto like '%Aristoteles Sandoval Diaz%' OR
                    Texto like '%jorge Aristoteles Sandoval%' OR
                    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Texto like '%Sandoval Diaz%' OR
                    Texto like '%Gobernador de jalisco%' OR
                    Texto like '%Gobernador del Estado de  jalisco%' OR
                    Texto like '%Guadalajara%' OR

                    Encabezado like '%Jalisco%' OR
                    Encabezado like '%Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%jorge Aristoteles Sandoval%' OR
                    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Sandoval Diaz%' OR
                    Encabezado like '%Gobernador de jalisco%' OR
                    Encabezado like '%Gobernador del Estado de  jalisco%' OR
                    Encabezado like '%Guadalajara%'
                ) AND n.periodico=p.idPeriodico AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina
UNION ALL
SELECT 'Gobernador',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
        p.estado,(3) as Pagina,idEditorial,PaginaPeriodico,o.posicion
		FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
		WHERE
        n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
		n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843) AND
                n.periodico=o.periodico
				AND (
                    Titulo like '%Jalisco%' OR
                    Titulo like '%Aristoteles Sandoval Diaz%' OR
                    Titulo like '%jorge Aristoteles Sandoval%' OR
                    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Sandoval Diaz%' OR
                    Titulo like '%Gobernador de jalisco%' OR
                    Titulo like '%Gobernador del Estado de  jalisco%' OR
                    Titulo like '%Guadalajara%' OR

                    Texto like '%Jalisco%' OR
                    Texto like '%Aristoteles Sandoval Diaz%' OR
                    Texto like '%jorge Aristoteles Sandoval%' OR
                    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Texto like '%Sandoval Diaz%' OR
                    Texto like '%Gobernador de jalisco%' OR
                    Texto like '%Gobernador del Estado de  jalisco%' OR
                    Texto like '%Guadalajara%' OR

                    Encabezado like '%Jalisco%' OR
                    Encabezado like '%Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%jorge Aristoteles Sandoval%' OR
                    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Sandoval Diaz%' OR
                    Encabezado like '%Gobernador de jalisco%' OR
                    Encabezado like '%Gobernador del Estado de  jalisco%' OR
                    Encabezado like '%Guadalajara%'
                ) AND n.periodico=p.idPeriodico AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Innovacion y Tecnologia',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
        p.estado,(4) as Pagina,idEditorial,PaginaPeriodico,o.posicion
		FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
		WHERE
        n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
		n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843) AND
                n.periodico=o.periodico
				AND (
        Texto like '%jaime reyes robles%' OR
        Texto like '%reyes robles%' OR
        Texto like '%secretario de innovacion ciencia y tecnologia%' OR

        Titulo like'%jaime reyes robles%' OR
        Titulo like'%reyes robles%' OR
        Titulo like '%secretario de innovacion ciencia y tecnologia%' OR

        Encabezado like'%jaime reyes robles%' OR
        Encabezado like'%reyes robles%' OR
        Encabezado like '%secretario de innovacion ciencia y tecnologia%'
       )AND n.periodico=p.idPeriodico AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'SEDECO',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(5) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op order by op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
    Texto like '%secretario de desarrollo economico jalisco%' OR
    Texto like '%secretaria de desarrollo economico de jalisco%' OR
    Texto like '%Jose Palacios Jimenez%' OR
    Texto like '%Jose Palacios%' OR
    Texto like '%Palacios Jimenez%' OR
    Texto like '%SEDECO%'  AND (Titulo like '%jalisco%' OR Texto like '%Jalisco%' OR Encabezado like '%Jalisco%')  OR
    Texto like '%titular de la SEDECO%' AND(Texto not like '%salomon Chertorivski%') OR
    Texto like '% Ciudad Creativa Digital %'
OR
	Titulo like '%secretario de desarrollo economico jalisco%' OR
	Titulo like '%secretaria de desarrollo economico de jalisco%' OR
	Titulo like '%Jose Palacios Jimenez%' OR
	Titulo like '%Jose Palacios%' OR
	Titulo like '%Palacios Jimenez%' OR
	Titulo like '%SEDECO%' AND (Titulo like '%jalisco%' OR Texto like '%Jalisco%' OR Encabezado like '%Jalisco%')  OR
	Titulo like '%titular de la SEDECO%' OR
	Titulo like '%Plan Estatal de Desarrollo del estado de jalisco%' OR
	Titulo like '% Ciudad Creativa Digital %'
 OR
	Encabezado like '%secretario de desarrollo economico jalisco%' OR
	Encabezado like '%secretaria de desarrollo economico de jalisco%' OR
	Encabezado like '%Jose Palacios Jimenez%' OR
	Encabezado like '%Jose Palacios%' OR
	Encabezado like '%Palacios Jimenez%' OR
	Encabezado like '%SEDECO%' AND (Titulo like '%jalisco%' OR Texto like '%Jalisco%' OR Encabezado like '%Jalisco%')  OR
	Encabezado like '%titular de la SEDECO%' OR
	Encabezado like '%Plan Estatal de Desarrollo%' OR
	Encabezado like '%Ciudad Creativa Digital%'
) AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'SEDIS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(6) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843) AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de desarrollo e integracion social%' OR
	Texto like '%secretaria de desarrollo e integracion social%' OR
	Texto like '%Salvador rizo castelo%' OR
	Texto like '%Salvador rizo%' OR
	Texto like '%rizo castelo%' OR
	Texto like '%SEDIS%' OR
	Texto like '%titular de la secretaria de desarrollo e integracion social%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de desarrollo e integracion social%' OR
	Titulo like '%secretaria de desarrollo e integracion social%' OR
	Titulo like '%Salvador rizo castelo%' OR
	Titulo like '%Salvador rizo%' OR
	Titulo like '%rizo castelo%' OR
	Titulo like '%SEDIS%' OR
	Titulo like '%titular de la secretaria de desarrollo e integracion social%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de desarrollo e integracion social%' OR
	Encabezado like '%secretaria de desarrollo e integracion social%' OR
	Encabezado like '%Salvador rizo castelo%' OR
	Encabezado like '%Salvador rizo%' OR
	Encabezado like '%rizo castelo%' OR
	Encabezado like '%SEDIS%' OR
	Encabezado like '%titular de la secretaria de desarrollo e integracion social%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'RURAL',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(7) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de desarrollo Rural%' OR
	Texto like '%secretaria de desarrollo Rural%' OR
	Texto like '%Hector Padilla Gutierrez%' OR
	Texto like '%Hector Padilla%' OR
	Texto like '%Padilla Gutierrez%' OR
	Texto like '%titular de la secretaria de desarrollo Rural%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de desarrollo Rural%' OR
	Titulo like '%secretaria de desarrollo Rural%' OR
	Titulo like '%Hector Padilla Gutierrez%' OR
	Titulo like '%Hector Padilla%' OR
	Titulo like '%Padilla Gutierrez%' OR
	Titulo like '%titular de la secretaria de desarrollo Rural%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de desarrollo Rural%' OR
	Encabezado like '%secretaria de desarrollo Rural%' OR
	Encabezado like '%Hector Padilla Gutierrez%' OR
	Encabezado like '%Hector Padilla%' OR
	Encabezado like '%Padilla Gutierrez%' OR
	Encabezado like '%titular de la secretaria de desarrollo Rural%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'SEJ',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(8) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de educacion%' OR
	Texto like '%secretaria de educacion%' OR
	Texto like '%francisco ayon lopez%' OR
	Texto like '%francisco ayon%' OR
	Texto like '%ayon lopez%' OR
	Texto like '%titular de la secretaria de educacion%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de educacion%' OR
	Titulo like '%secretaria de educacion%' OR
	Titulo like '%francisco ayon lopez%' OR
	Titulo like '%francisco ayon%' OR
	Titulo like '%ayon lopez%' OR
	Titulo like '%titular de la secretaria de educacion%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de educacion%' OR
	Encabezado like '%secretaria de educacion%' OR
	Encabezado like '%francisco ayon lopez%' OR
	Encabezado like '%francisco ayon%' OR
	Encabezado like '%ayon lopez%' OR
	Encabezado like '%titular de la secretaria de educacion%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina
UNION ALL
SELECT 'Fiscalia',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(9) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%fiscal general%' OR
	Texto like '%fiscalia general%' OR
	Texto like '%luis carlos najera%' OR
	Texto like '%Carlos Najera Gutierrez%' OR
	Texto like '%Najera Gutierrez%' OR
	Texto like '%titular de la fiscalia general%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%fiscal general%' OR
	Titulo like '%fiscalia general%' OR
	Titulo like '%luis carlos najera%' OR
	Titulo like '%Carlos Najera Gutierrez%' OR
	Titulo like '%Najera Gutierrez%' OR
	Titulo like '%titular de la fiscalia general%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%fiscal general%' OR
	Encabezado like '%fiscalia general%' OR
	Encabezado like '%luis carlos najera%' OR
	Encabezado like '%Carlos Najera Gutierrez%' OR
	Encabezado like '%Najera Gutierrez%' OR
	Encabezado like '%titular de la fiscalia general%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'Movilidad',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(10) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de movilidad%' OR
	Texto like '%secretaria de movilidad%' OR
	Texto like '%mauricio gudino coronado%' OR
	Texto like '%mauricio gudino%' OR
	Texto like '%gudiño coronado%' OR
	Texto like '%titular de la secretaria de movilidad%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de movilidad%' OR
	Titulo like '%secretaria de movilidad%' OR
	Titulo like '%mauricio gudino coronado%' OR
	Titulo like '%mauricio gudino%' OR
	Titulo like '%gudiño coronado%' OR
	Titulo like '%titular de la secretaria de movilidad%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de movilidad%' OR
	Encabezado like '%secretaria de movilidad%' OR
	Encabezado like '%mauricio gudino coronado%' OR
	Encabezado like '%mauricio gudino%' OR
	Encabezado like '%gudiño coronado%' OR
	Encabezado like '%titular de la secretaria de movilidad%'
)

)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Secretaria de Gobierno',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(11) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%secretaria general de gobierno%' OR
	Texto like '%roberto lopez lara%' OR
	Texto like '%roberto lopez%' OR
	Texto like '%lopez lara%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretaria general de gobierno%' OR
	Titulo like '%roberto lopez lara%' OR
	Titulo like '%roberto lopez%' OR
	Titulo like '%lopez lara%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretaria general de gobierno%' OR
	Encabezado like '%roberto lopez lara%' OR
	Encabezado like '%roberto lopez%' OR
	Encabezado like '%lopez lara%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina



UNION ALL
SELECT 'Infraestructura',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(12) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843) AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de infraestrutura y obra publica%' OR
	Texto like '%secretaria de infraestrutura y obra publica%' OR
	Texto like '%roberto davalos lopez%' OR
	Texto like '%roberto davalos%' OR
	Texto like '%davalos lopez%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de infraestrutura y obra publica%' OR
	Titulo like '%secretaria de infraestrutura y obra publica%' OR
	Titulo like '%roberto davalos lopez%' OR
	Titulo like '%roberto davalos%' OR
	Texto like '%davalos lopez%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de infraestrutura y obra publica%' OR
	Encabezado like '%secretaria de infraestrutura y obra publica%' OR
	Encabezado like '%roberto davalos lopez%' OR
	Encabezado like '%roberto davalos%' OR
	Encabezado like '%davalos lopez%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina



UNION ALL
SELECT 'SEMADET',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(13) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%secretario demedio ambiente y desarrollo territorial%' OR
	Texto like '%secretaria de medio ambiente y desarrollo territorial%' OR
	Texto like '%Maria Magdalena Ruiz Mejia%' OR
	Texto like '%Maria Magdalena Ruiz%' OR
	Texto like '%Maria Ruiz Mejia%'  OR
	Texto like '%Ruiz Mejia%'  OR
	Texto like '%SEMADET%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario demedio ambiente y desarrollo territorial%' OR
	Titulo like '%secretaria de medio ambiente y desarrollo territorial%' OR
	Titulo like '%Maria Magdalena Ruiz Mejia%' OR
	Titulo like '%Maria Magdalena Ruiz%' OR
	Titulo like '%Maria Ruiz Mejia%'  OR
	Titulo like '%Ruiz Mejia%'  OR
	Titulo like '%SEMADET%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario demedio ambiente y desarrollo territorial%' OR
	Encabezado like '%secretaria de medio ambiente y desarrollo territorial%' OR
	Encabezado like '%Maria Magdalena Ruiz Mejia%' OR
	Encabezado like '%Maria Magdalena Ruiz%' OR
	Encabezado like '%Maria Ruiz Mejia%'  OR
	Encabezado like '%Ruiz Mejia%'  OR
	Encabezado like '%SEMADET%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'SEPAF',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(14) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%secretario de planeacion administracion y finanzas%' OR
	Texto like '%secretaria de planeacion administracion y finanzas%' OR
	Texto like '%ricardo villanueva lomeli%' OR
	Texto like '%ricardo villanueva%' OR
	Texto like '%villanueva lomeli%'  OR
	Texto like '%SEPAF%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%secretario de planeacion administracion y finanzas%' OR
	Titulo like '%secretaria de planeacion administracion y finanzas%' OR
	Titulo like '%ricardo villanueva lomeli%' OR
	Titulo like '%ricardo villanueva%' OR
	Titulo like '%villanueva lomeli%'  OR
	Titulo like '%SEPAF%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretario de planeacion administracion y finanzas%' OR
	Encabezado like '%secretaria de planeacion administracion y finanzas%' OR
	Encabezado like '%ricardo villanueva lomeli%' OR
	Encabezado like '%ricardo villanueva%' OR
	Encabezado like '%villanueva lomeli%'  OR
	Encabezado like '%SEPAF%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Procuraduria Social',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(15) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%' AND (
	Texto like '%procuraduria social%' OR
	Texto like '%procuradora social%' OR
	Texto like '%felicitas Velazquez Serrano%' OR
	Texto like '%felicitas Velazquez%' OR
	Texto like '%Velazquez Serrano%'
) OR
Titulo like '%Jalisco%' AND (
	Titulo like '%procuraduria social%' OR
	Titulo like '%procuradora social%' OR
	Titulo like '%felicitas Velazquez Serrano%' OR
	Titulo like '%felicitas Velazquez%' OR
	Titulo like '%Velazquez Serrano%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%procuraduria social%' OR
	Encabezado like '%procuradora social%' OR
	Encabezado like '%felicitas Velazquez Serrano%' OR
	Encabezado like '%felicitas Velazquez%' OR
	Encabezado like '%Velazquez Serrano%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Salud',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(16) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%'  AND (
	Texto like '%secretaria de salud jalisco%' OR
	Texto like '%secretario de salud jalisco%' OR
	Texto like '%jaime agustin gonzalez alvarez%' OR
	Texto like '%jaime agustin gonzalez%' OR
	Texto like '%jaime gonzalez alvarez%'  OR
	Texto like '%gonzalez alvarez%'  OR
	Texto like '%SSJ%'  OR
	Texto like '%Salud Jalisco%'  OR
	Texto like '%influenza%'  OR
	Texto like '%AH1N1%'  OR
	Texto like '%AH3N2%'
) OR
Titulo like '%Jalisco%'  AND (
	Titulo like '%secretaria de salud jalisco%' OR
	Titulo like '%secretario de salud jalisco%' OR
	Titulo like '%jaime agustin gonzalez alvarez%' OR
	Titulo like '%jaime agustin gonzalez%' OR
	Titulo like '%jaime gonzalez alvarez%'  OR
	Titulo like '%gonzalez alvarez%'  OR
	Titulo like '%SSJ%'  OR
	Titulo like '%Salud Jalisco%'  OR
	Titulo like '%influenza%'  OR
	Titulo like '%AH1N1%'  OR
	Titulo like '%AH3N2%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretaria de salud jalisco%' OR
	Encabezado like '%secretario de salud jalisco%' OR
	Encabezado like '%jaime agustin gonzalez alvarez%' OR
	Encabezado like '%jaime agustin gonzalez%' OR
	Encabezado like '%jaime gonzalez alvarez%'  OR
	Encabezado like '%gonzalez alvarez%'  OR
	Encabezado like '%SSJ%'  OR
	Encabezado like '%Salud Jalisco%'  OR
	Encabezado like '%influenza%'  OR
	Encabezado like '%AH1N1%'  OR
	Encabezado like '%AH3N2%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'STPS',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(17) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Jalisco%'  AND (
	Texto like '%secretaria de trabajo y prevision social%' OR
	Texto like '%secretario de trabajo y prevision social%' OR
	Texto like '%Hector Pizano Ramos%' OR
	Texto like '%Hector Pizano%' OR
	Texto like '%Pizano Ramos%'  OR
	Texto like '%(STPS) de Jalisco%'  OR
	Texto like '%STPS de Jalisco%'  OR
	Texto like '%STPS Jalisco%'  OR
	Texto like '%ocotlan Jalisco%'  OR
	Texto like '%ocotlan, Jalisco%'
) OR
Titulo like '%Jalisco%'  AND (
	Titulo like '%secretaria de trabajo y prevision social%' OR
	Titulo like '%secretario de trabajo y prevision social%' OR
    Titulo like '%Hector Pizano Ramos%' OR
    Titulo like '%Hector Pizano%' OR
    Titulo like '%Pizano Ramos%'  OR
	Titulo like '%(STPS) de Jalisco%'  OR
	Titulo like '%STPS de Jalisco%'  OR
	Titulo like '%STPS Jalisco%'  OR
	Titulo like '%ocotlan Jalisco%'  OR
	Titulo like '%ocotlan, Jalisco%'
)OR
Encabezado like '%Jalisco%' AND (
	Encabezado like '%secretaria de trabajo y prevision social%' OR
	Encabezado like '%secretario de trabajo y prevision social%' OR
    Encabezado like '%Hector Pizano Ramos%' OR
    Encabezado like '%Hector Pizano%' OR
    Encabezado like '%Pizano Ramos%'  OR
	Encabezado like '%(STPS) de Jalisco%'  OR
	Encabezado like '%STPS de Jalisco%'  OR
	Encabezado like '%STPS Jalisco%'  OR
	Encabezado like '%ocotlan Jalisco%'  OR
	Encabezado like '%ocotlan, Jalisco%'
)
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha')
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'Turismo',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(18) as Pagina,idEditorial,PaginaPeriodico,posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(

	Texto like '%secretaria de turismo%' OR
	Texto like '%secretario de turismo%' OR
	Texto like '%jesus enrique ramos flores%' OR
	Texto like '%jesus ramos flores%' OR
	Texto like '%enrique ramos flores%'  OR
	Texto like '%ramos flores%'  OR
	Texto like '%jalisco es mexico%'
 OR

	Titulo like '%secretaria de turismo%' OR
	Titulo like '%secretario de turismo%' OR
	Titulo like '%jesus enrique ramos flores%' OR
	Titulo like '%jesus ramos flores%' OR
	Titulo like '%enrique ramos flores%'  OR
	Titulo like '%ramos flores%'  OR
	Titulo like '%jalisco es mexico%'
OR

	Encabezado like '%secretaria de turismo%' OR
	Encabezado like '%secretario de turismo%' OR
	Encabezado like '%jesus enrique ramos flores%' OR
	Encabezado like '%jesus ramos flores%' OR
	Encabezado like '%enrique ramos flores%'  OR
	Encabezado like '%ramos flores%'  OR
	Encabezado like '%jalisco es mexico%'
)AND (Texto like '%Jalisco%' OR Encabezado like '%Jalisco%' OR Titulo like '%Jalisco%') AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

UNION ALL
SELECT 'Contraloria',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(19) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '%Contralor de Jalisco%' OR
Texto like '%Juan Jose banuelos%' AND (
    Texto like '%Contralor%' OR
    Texto like '%El Contralor%'
    )OR
Titulo like '%Contralor de Jalisco%' OR
Titulo like '%Juan Jose banuelos%' AND (
    Titulo like '%Contralor%' OR
    Titulo like '%El Contralor%'
    )
OR
Encabezado like '%Contralor de Jalisco%' OR
Encabezado like '%Juan Jose banuelos%' AND (
    Encabezado like '%Contralor%' OR
    Encabezado like '%El Contralor%'
    )
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina


UNION ALL
SELECT 'Municipios',p.Nombre,n.Titulo,n.Texto,s.seccion,n.NumeroPagina,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
p.estado,(19) as Pagina,idEditorial,PaginaPeriodico,o.posicion
FROM noticiasDia n, (SELECT periodico,posicion FROM ordenGeneral op ORDER BY op.posicion)  o, periodicos p,seccionesPeriodicos s
WHERE
n.periodico not in (445,326,325,373,374,367,435,149,155,244,247,1451,1396,1526) AND
n.Seccion not in (10,21,22,68,100,101,104,127,132,147,159,171,182,188,195,199,201,222,230,235,251,252,253,259,271,275,289,294,369,371,372,388,404,420,446,491,501,502,506,513,517,520,526,533,541,550,560,599,605,1633,1838,1839,1840,1841,1842,1843)  AND
n.periodico=o.periodico
AND(
Texto like '% Guadalajara %' OR
Texto like '% Zapopan %' OR
Texto like '% Tonala %' OR
Texto like '% Tlaquepaque%' OR
Texto like '% Tlajomulco%' OR
Texto like '% ZMG%' OR
Texto like '% Chapala%' OR
Texto like '% Vallarta%' OR
Texto like '% ocotlan%' OR
Texto like '% los altos de jalisco%' OR
Texto like '% La barca jalisco%' OR
Texto like '% Pihuamo%' OR
Texto like '% tecalitlan%' OR
Texto like '% jilotlan de los dolores%' OR
Texto like '% Santa maria del oro%' OR
Texto like '% quitupan%' OR
Texto like '% valle de juarez%' OR
Texto like '%tizapan el alto%' OR
Texto like '%Jamay%' OR
Texto like '%Tenacatita%' OR
Texto like '%temacapulin%' OR
Texto like '%municipio de la huerta%' OR
Texto like '%ribera de chapala%' OR
Texto like '%ajijic%' OR
Texto like '% ZMG %' OR
Texto like '%Zona metropolitana de Guadalajara%' OR
Texto like '%El Salto Jalisco%' OR
Texto like '% ojuelos %' OR
Texto like '%Ramiro Hernande Garcia%' OR
Texto like '%Barba Mariscal%' OR
Texto like '%Jorge Arana Arana%' OR
Texto like '%Penal de Puente Grande %' OR
Texto like '%Zapotlanejo%' OR
Texto like '%Municipio de  Tala %' OR
Texto like '%Lagos de moreno%' OR
Texto like '%San juan de los lagos%' OR
Texto like '%sayula%' OR
Texto like '%ciudad guzman%' OR
Texto like '% ayutla Jalisco%' OR
Texto like '%el grullo Jalisco%' OR
Texto like '%Ayotlan%' OR
Texto like '%tomatlan Jalisco %' OR
Texto like '%villa purificacion %' OR
Texto like '%tecalitlan %' OR
Texto like '%tuxpan  %' OR

Titulo like '%Jalisco%' OR
Titulo like '%Guadalajara%' OR
Titulo like '%Zapopan%' OR
Titulo like '%Tonala%' OR
Titulo like '%Tlaquepaque%' OR
Titulo like '%Tlajomulco%' OR
Titulo like '%ZMG%' OR
Titulo like '%Chapala%' OR
Titulo like '%Vallarta%' OR
Titulo like '% ocotlan%' OR
Titulo like '%los altos de jalisco%' OR
Titulo like '%La barca jalisco%' OR
Titulo like '%Pihuamo%' OR
Titulo like '%tecalitlan%' OR
Titulo like '%jilotlan de los dolores%' OR
Titulo like '%Santa maria del oro%' OR
Titulo like '%quitupan%' OR
Titulo like '%valle de juarez%' OR
Titulo like '%tizapan el alto%' OR
Titulo like '%Jamay%' OR
Titulo like '%Tenacatita%' OR
Titulo like '%temacapulin%' OR
Titulo like '%municipio de la huerta%' OR
Titulo like '%ribera de chapala%' OR
Titulo like '%ajijic%' OR
Titulo like '% ZMG %' OR
Titulo like '%Zona metropolitana de Guadalajara%' OR
Titulo like '%El Salto Jalisco%' OR
Titulo like '% ojuelos jalisco%' OR
Titulo like '%Ramiro Hernandez Garcia%' OR
Titulo like '%Barba Mariscal%' OR
Titulo like '%Jorge Arana Arana%' OR
Titulo like '%Penal de Puente Grande %' OR
Titulo like '%Zapotlanejo%' OR
Titulo like '%Municipio de  Tala %' OR
Titulo like '%Lagos de moreno%' OR
Titulo like '%San juan de los lagos%' OR
Titulo like '%sayula%' OR
Titulo like '%ciudad guzman%' OR
Titulo like '% ayutla Jalisco%' OR
Titulo like '%el grullo %' OR
Titulo like '%Ayotlan%' OR
Titulo like '%tomatlan Jalisco %' OR
Titulo like '%villa purificacion %' OR
Titulo like '%tecalitlan %' OR
Titulo like '%tuxpan  %' OR

Encabezado like '%Jalisco%' OR
Encabezado like '%Guadalajara%' OR
Encabezado like '%Zapopan%' OR
Encabezado like '%Tonala%' OR
Encabezado like '%Tlaquepaque%' OR
Encabezado like '%Tlajomulco%' OR
Encabezado like '%ZMG%' OR
Encabezado like '%Chapala%' OR
Encabezado like '%Vallarta%' OR
Encabezado like '% ocotlan%' OR
Encabezado like '%los altos de jalisco%' OR
Encabezado like '%La barca Jalisco%' OR
Encabezado like '%Pihuamo%' OR
Encabezado like '%tecalitlan%' OR
Encabezado like '%jilotlan de los dolores%' OR
Encabezado like '%Santa maria del oro%' OR
Encabezado like '%quitupan%' OR
Encabezado like '%valle de juarez%' OR
Encabezado like '%tizapan el alto%' OR
Encabezado like '%Jamay%' OR
Encabezado like '%Tenacatita%' OR
Encabezado like '%temacapulin%' OR
Encabezado like '%municipio de la huerta%' OR
Encabezado like '%ribera de chapala%' OR
Encabezado like '%ajijic%' OR
Encabezado like '% ZMG %' OR
Encabezado like '%Zona metropolitana de Guadalajara%' OR
Encabezado like '%El Salto Jalisco%' OR
Encabezado like '% ojuelos %' OR
Encabezado like '%Ramiro Hernandez Garcia%' OR
Encabezado like '%Barba Mariscal%' OR
Encabezado like '%Jorge Arana Arana%' OR
Encabezado like '%Penal de Puente Grande %' OR
Encabezado like '%Zapotlanejo%' OR
Encabezado like '%Municipio de  Tala %' OR
Encabezado like '%Lagos de moreno%' OR
Encabezado like '%San juan de los lagos%' OR
Encabezado like '%sayula%' OR
Encabezado like '%ciudad guzman%' OR
Encabezado like '% ayutla Jalisco%' OR
Encabezado like '%el grullo %' OR
Encabezado like '%Ayotlan%' OR
Encabezado like '%tomatlan  Jalisco%' OR
Encabezado like '%villa purificacion %' OR
Encabezado like '%tecalitlan %' OR
Encabezado like '%tuxpan  %'
)AND
s.idSeccion=n.Seccion AND p.idPeriodico=n.Periodico AND
fecha=(SELECT '$fecha' )
GROUP BY n.periodico, n.NumeroPagina

)
Derived GROUP BY Periodico,NumeroPagina
ORDER BY posicion,Pagina
 LIMIT $limit1,$limit2";

        return $query;
        break;

    case 3:
        //QUERY PARA EL DF
        $query = "SELECT
e.Nombre AS Estado,
  p.Nombre as Periodico,
CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d')) as Fecha,
  s.seccion as 'Sección',
  n.Titulo,
  n.Encabezado,
  n.Autor,
  n.Texto,
  n.PieFoto,
  n.NumeroPagina,
  n.Periodico,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'JPG'
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
   n.Activo = 1 AND
  p.Estado=e.idEstado AND
  fecha = CURDATE() AND (
	Titulo like '%bloqueo%' OR
	Titulo like '%codigo rojo%' OR
	Titulo like '%Operacion Jalisco%' OR
	Titulo like '%narcobloqueo%' OR
	( Titulo like '%violencia%' AND ( Titulo like '%Guadalajara%' or Titulo like '%Jalisco%' OR Titulo like '%Vallarta%' or Titulo like '%Guanajuato%' or Titulo like '%Michoacan%' ) ) OR

	( Texto like '%bloqueo%' AND Texto NOT LIKE '%Mercado Corona%' AND Texto NOT LIKE '%LGBTT%' and ( Texto like '%Guadalajara%' or Texto like '%Jalisco%' OR Texto like '%Vallarta%' or Texto like '%Guanajuato%' or Texto like '%Michoacan%' ) ) OR
	Texto like '%narcobloqueo%' OR
	Texto like '%Operacion Jalisco%' OR
	Texto like '%codigo rojo%' OR
	( Texto like '%violencia%' AND ( Texto like '%Guadalajara%' or Texto like '%Jalisco%' OR Texto like '%Vallarta%' or Texto like '%Guanajuato%' or Texto like '%Michoacan%' ) ) OR

	Encabezado like '%bloqueo%' OR
	Encabezado like '%Operacion Jalisco%' OR
	Encabezado like '%codigo rojo%' OR
	Encabezado like '%narcobloqueo%' OR
	( Encabezado like '%violencia%' AND ( Encabezado like '%Jalisco%' OR Encabezado like '%Vallarta%' or Encabezado like '%Guanajuato%' or Encabezado like '%Michoacan%' ) ) OR

	PieFoto like '%bloqueo%' OR
	PieFoto like '%narcobloqueo%' )
GROUP BY n.Periodico,n.NumeroPagina
ORDER BY o.posicion;";
        return $query;

    case 4:
        //QUERY PARA JALISCO
        $query = "SELECT
  p.Nombre as Periodico,
CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d')) as Fecha,
  s.seccion as 'Sección',
  n.Titulo,
  n.Encabezado,
  n.Autor,
  n.Texto,
  n.PieFoto,
  n.NumeroPagina,
  n.Periodico,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'JPG'
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
   n.Activo = 1 AND
  p.Estado=e.idEstado AND
  e.idEstado = 14 AND
  fecha = CURDATE() AND (
	Titulo like '%bloqueo%' OR
	Titulo like '%codigo rojo%' OR
	Titulo like '%Operacion Jalisco%' OR
	Titulo like '%narcobloqueo%' OR
	( Titulo like '%violencia%' AND ( Titulo like '%Guadalajara%' or Titulo like '%Jalisco%' OR Titulo like '%Vallarta%' or Titulo like '%Guanajuato%' or Titulo like '%Michoacan%' ) ) OR

	( Texto like '%bloqueo%' AND Texto NOT LIKE '%Mercado Corona%' AND Texto NOT LIKE '%LGBTT%' and ( Texto like '%Guadalajara%' or Texto like '%Jalisco%' OR Texto like '%Vallarta%' or Texto like '%Guanajuato%' or Texto like '%Michoacan%' ) ) OR
	Texto like '%narcobloqueo%' OR
	Texto like '%Operacion Jalisco%' OR
	Texto like '%codigo rojo%' OR
	( Texto like '%violencia%' AND ( Texto like '%Guadalajara%' or Texto like '%Jalisco%' OR Texto like '%Vallarta%' or Texto like '%Guanajuato%' or Texto like '%Michoacan%' ) ) OR

	Encabezado like '%bloqueo%' OR
	Encabezado like '%Operacion Jalisco%' OR
	Encabezado like '%codigo rojo%' OR
	Encabezado like '%narcobloqueo%' OR
	( Encabezado like '%violencia%' AND ( Encabezado like '%Jalisco%' OR Encabezado like '%Vallarta%' or Encabezado like '%Guanajuato%' or Encabezado like '%Michoacan%' ) ) OR

	PieFoto like '%bloqueo%' OR
	PieFoto like '%narcobloqueo%' )
GROUP BY n.Periodico,n.NumeroPagina
ORDER BY o.posicion;";
        return $query;
        break;
    default:
        break;
    }
}
