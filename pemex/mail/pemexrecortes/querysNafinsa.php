<?php

function numberNotes($optionCase, $fecha) {
    $query = query($optionCase, $fecha);
    $resultado = mysql_query($query);
    if(mysql_num_rows($resultado) > 0) {
        return true;
    }
    return false;
}

function query($opc, $fecha) {    
    $Tabla = "noticiasDia";
    if ($fecha == date('Y-m-d')) {
        $Tabla="noticiasDia";
    } else {
        $Tabla="noticiasSemana";
    }
    switch ($opc) {
        case 1://NAFINSA - DF
            $query="SELECT 
                      n.idEditorial,
                      n.Periodico AS 'idPeriodico',
                      p.Nombre AS 'periodico',
                      n.Seccion,
                      s.seccion,
                      n.Categoria AS 'Num.Categoria',
                      c.Categoria AS 'Categoria',
                      n.NumeroPagina,
                      n.Autor,
                      n.Fecha,
                      n.Hora,
                      n.Titulo,
                      n.Encabezado,
                      n.Texto,
                      n.PaginaPeriodico,
                      n.Foto,
                      n.PieFoto,
                      CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      e.Nombre AS 'Estado',
                      n.CREL,
                      n.areaNota,
                      n.costoNota,
                      p.String_name
                    FROM
                      $Tabla n,
                      periodicos p,
                      ordenGeneral o,
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                    WHERE
                      p.idPeriodico = n.Periodico
                          AND p.idPeriodico = o.periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND n.Activo = 1
                          AND fecha = DATE('$fecha')
                          AND (
                                Texto like '%NAFINSA%' OR
                                Texto like '%NAFIN%' OR
                                Texto like '% Nacional Financiera%' OR
                                Texto like '% Jacques Rogozinsky%' OR

                                Titulo like '%NAFINSA%' OR
                                Titulo like '%NAFIN%' OR
                                Titulo like '% Nacional Financiera%' OR
                                Titulo like '% Jacques Rogozinsky%' OR

                                Encabezado like '%NAFINSA%' OR
                                Encabezado like '%NAFIN%' OR
                                Encabezado like '% Nacional Financiera%' OR
                                Encabezado like '% Jacques Rogozinsky%' OR

                                Autor like '%NAFINSA%' OR
                                Autor like '%NAFIN%' OR
                                Autor like '% Nacional Financiera%' OR
                                Autor like '% Jacques Rogozinsky%' OR

                                PieFoto like '%NAFINSA%' OR
                                PieFoto like '%NAFIN%' OR
                                PieFoto like '% Nacional Financiera%' OR
                                PieFoto like '% Jacques Rogozinsky%'
                            )
                                          GROUP BY n.Periodico,n.NumeroPagina
                                          ORDER BY o.posicion";
            return $query;
        break;  

        case 2://Presidencia - Especial
          $query="SELECT
n.idEditorial,
n.Periodico AS 'idPeriodico',
p.Nombre AS 'periodico',
n.Seccion,
s.seccion,
n.Categoria AS 'Num.Categoria',
c.Categoria AS 'Categoria',
n.NumeroPagina,
n.Autor,
n.Fecha,
n.Hora,
n.Titulo,
n.Encabezado,
n.Texto,
n.PaginaPeriodico,
n.Foto,
n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre AS 'Estado',
n.CREL,
n.areaNota,
n.costoNota,
p.String_name
FROM
  ((SELECT
    cutted,
Periodico,
idEditorial,
Titulo,
CREL,
CREN,
costoNota,
PaginaPeriodico,
Autor,
Texto,
Categoria,
Seccion,
NumeroPagina,
Fecha,
Hora,
Encabezado,
Foto,
PieFoto,
areaNota
FROM
    $Tabla
WHERE
    Periodico = 50 AND
    CREL >= 4 AND
    Activo = 1 AND
    Fecha = DATE('$fecha') AND (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY PaginaPeriodico LIMIT 2)

UNION

(SELECT
    cutted,
Periodico,
idEditorial,
Titulo,
CREL,
CREN,
costoNota,
PaginaPeriodico,
Autor,
Texto,
Categoria,
Seccion,
NumeroPagina,
Fecha,
Hora,
Encabezado,
Foto,
PieFoto,
areaNota
FROM
    $Tabla
WHERE
    Periodico = 32 AND
    CREL >= 4 AND
    Activo = 1 AND
    Fecha = DATE('$fecha') AND (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY PaginaPeriodico LIMIT 2)

UNION

(SELECT
    cutted,
Periodico,
idEditorial,
Titulo,
CREL,
CREN,
costoNota,
PaginaPeriodico,
Autor,
Texto,
Categoria,
Seccion,
NumeroPagina,
Fecha,
Hora,
Encabezado,
Foto,
PieFoto,
areaNota
FROM
    $Tabla
WHERE
    Periodico = 59 AND
    CREL >= 4 AND
    Activo = 1 AND
    Fecha = DATE('$fecha') AND (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY PaginaPeriodico LIMIT 2)

UNION

(SELECT
    cutted,
Periodico,
idEditorial,
Titulo,
CREL,
CREN,
costoNota,
PaginaPeriodico,
Autor,
Texto,
Categoria,
Seccion,
NumeroPagina,
Fecha,
Hora,
Encabezado,
Foto,
PieFoto,
areaNota
FROM
    $Tabla
WHERE
    Periodico = 51 AND
    CREL >= 4 AND
    Activo = 1 AND
    Fecha = DATE('$fecha') AND (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY PaginaPeriodico LIMIT 2)

UNION

(SELECT
    cutted,
Periodico,
idEditorial,
Titulo,
CREL,
CREN,
costoNota,
PaginaPeriodico,
Autor,
Texto,
Categoria,
Seccion,
NumeroPagina,
Fecha,
Hora,
Encabezado,
Foto,
PieFoto,
areaNota
FROM
    $Tabla
WHERE
    Periodico = 53 AND
    CREL >= 4 AND
    Activo = 1 AND
    Fecha = DATE('$fecha') AND (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY PaginaPeriodico LIMIT 2)

UNION

(SELECT
    cutted,
Periodico,
idEditorial,
Titulo,
CREL,
CREN,
costoNota,
PaginaPeriodico,
Autor,
Texto,
Categoria,
Seccion,
NumeroPagina,
Fecha,
Hora,
Encabezado,
Foto,
PieFoto,
areaNota
FROM
    $Tabla
WHERE
    Periodico = 97 AND
    CREL >= 4 AND
    Activo = 1 AND
    Fecha = DATE('$fecha') AND (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY PaginaPeriodico LIMIT 2)) n,
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
  p.Estado=e.idEstado
ORDER BY o.posicion";
            return $query; 
        break;   

        case 3:// PRIMERAS PLANAS
            $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,
                    n.Autor,
                    n.Fecha,
                    n.Hora,
                    n.Titulo,
                    n.Encabezado,
                    n.Texto,
                    n.PaginaPeriodico,
                    n.Foto,
                    n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado',
                    n.CREL,
                    n.areaNota,
                    n.costoNota,
                    p.String_name
                    FROM $Tabla n, periodicos p, ordenGeneral o, seccionesPeriodicos s, categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND 
                    p.idPeriodico=o.periodico AND 
                    s.idSeccion=n.Seccion AND 
                    c.idCategoria=n.Categoria AND 
                    c.idCategoria in(3) AND 
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion
                    ";
            return $query;
            break;// PRIMERAS PLANAS

        case 4:// Columnas Nafin
            $query="SELECT
                      n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,
                    n.Autor,
                    n.Fecha,
                    n.Hora,
                    n.Titulo,
                    n.Encabezado,
                    n.Texto,
                    n.PaginaPeriodico,
                    n.Foto,
                    n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado',
                    n.CREL,
                    n.areaNota,
                    n.costoNota,
                    p.String_name
                    FROM 
                    $Tabla n, 
                    periodicos p, 
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE 
                    p.idPeriodico=n.Periodico AND p.idPeriodico in (52,53,59,47,97,131,51,302,364,32,319,346) AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(1,19,20) AND
                    e.idEstado=p.Estado AND
                    n.Fecha=DATE('$fecha') AND
                    n.Activo=1 AND
                    (
                    Autor like '%Jacques Rogozinski%' OR 
                    Autor like '%Alicia Salgado%' OR 
                    Autor like '%Maricarmen Cortes%' OR 
                    Autor like '%David Paramo%' OR 
                    Autor like '%Jose yuste%' OR 
                    Autor like '%Dario Celis%' OR 
                    Autor like '%Jesus Rangel%' OR 
                    Autor like '%Enrique Campos%' OR 
                    Autor like '%Alberto Aguilar%' OR 
                    Autor like '%Alberto Barranco%' OR 
                    Autor like '%Edgar Gonzalez Martinez%' OR 
                    Autor like '%Julio Brito%' OR 
                    Autor like '%Carlos Fernandez Vega%' OR 
                    Autor like '%Luis Soto%' OR 
                    Autor like '%Wilbert Torre%' OR 
                    Autor like '%Bartolome%' OR 
                    Autor like '%Salvador Garcia Soto%' OR 
                    Autor like '%Francisco Cardenas Cruz%' OR 
                    Autor like '%Jorge Castanñeda%' OR 
                    Autor like '%Raymundo Rivapalacio%' OR 
                    Autor like '%Leo Zuckermann%' OR 
                    Autor like '%Pascal Beltran del Rio%' OR 
                    Autor like '%Carlos Loret de Mola%' OR 
                    Autor like '%Sergio Sarmiento%' OR 
                    Autor like '%Denise Dresser%' OR 
                    Autor like '%Jesus Silva Herzog Marquez%' OR 
                    Autor like '%Roberto Zamarripa%' OR 
                    Autor like '%Caton%' OR 
                    Autor like '%Julio Hernandez Lopez%' OR 
                    Autor like '%Carlos Mota%' OR 
                    Autor like '%Jorge Fernandez Menendez%' OR 
                    Autor like '%Enrique Quintana%' OR 
                    Autor like '%Mauricio Flores%' OR 
                    Autor like '%Marco Antonio Mares%' OR 
                    Autor like '%Francisco Garfias%' OR 
                    Autor like '%Jose Cardenas%' OR 
                    Autor like '%Joaquin Lopez Doriga%' OR 
                    Autor like '%Diego Valades%' OR 
                    Autor like '%Jorge Alcocer%' OR 
                    Autor like '%Guadalupe Loaeza%' OR 
                    Autor like '%Sergio Aguayo%' OR 
                    Autor like '%German Martinez Cazares%' OR 
                    Autor like '%Jose Woldenberg%' OR 
                    Autor like '%Oscar Mario Beteta%' OR 
                    Autor like '%Juan Villoro%' OR 
                    Autor like '%Carmen Aristegui%' OR 
                    Autor like '%Manuel Jauregui%' OR

                    Titulo like '%Mitos y Mentadas%' OR 
                    Titulo like '%Cuenta Corriente%' OR 
                    Titulo like '%Desde el piso de remates%' OR 
                    Titulo like '%No tires tu dinero%' OR 
                    Titulo like '%Activo Empresarial%' OR 
                    Titulo like '%Tiempo de Negocios%' OR 
                    Titulo like '%Estira y afloja%' OR 
                    Titulo like '%La Gran Depresion%' OR 
                    Titulo like '%Desbalance%' OR 
                    Titulo like '%Inversiones%' OR 
                    Titulo like '%Nombres, nombres y nombres%' OR 
                    Titulo like '%Empresa%' OR 
                    Titulo like '%Los Capitales%' OR 
                    Titulo like '%Riesgos y rendimientos%' OR 
                    Titulo like '%Mexico SA%' OR 
                    Titulo like '%Agenda Confidencial%' OR 
                    Titulo like '%Nadie conoce a nadie%' OR 
                    Titulo like '%Templo Mayor%' OR 
                    Titulo like '%Rozones%' OR 
                    Titulo like '%Trascendio%' OR 
                    Titulo like '%Pepe Grillo%' OR 
                    Titulo like '%Serpiente y Escaleras%' OR 
                    Titulo like '%Pulso Politico%' OR 
                    Titulo like '%Amarres%' OR 
                    Titulo like '%Estrictamente profesional%' OR 
                    Titulo like '%Juegos de Poder%' OR 
                    Titulo like '%Bitacora del director%' OR 
                    Titulo like '%Bajo Reserva%' OR 
                    Titulo like '%Frentes Politicos%' OR 
                    Titulo like '%Historias de Reportero%' OR 
                    Titulo like '%Jaque Mate%' OR 
                    Titulo like '%Tolvanera%' OR 
                    Titulo like '%De politica y cosas peores %' OR 
                    Titulo like '%Astillero%' OR 
                    Titulo like '%Escritorio de negocios%' OR 
                    Titulo like '%Razones%' OR 
                    Titulo like '%Coordenadas%' OR 
                    Titulo like '%Gente detras del dinero%' OR 
                    Titulo like '%Fortuna y poder%' OR 
                    Titulo like '%Arsenal%' OR 
                    Titulo like '%Ventana%' OR 
                    Titulo like '%En Privado%' OR 
                    Titulo like '%Murmullos%' OR 
                    Titulo like '%Murmullos%'  
                    )
                    GROUP BY n.idEditorial
                    ORDER BY Periodico";
            return $query;
            break;

        case 5: // Cartones DF
            $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado',
                    n.CREL,
                    n.areaNota,
                    n.costoNota,
                    p.String_name
                    FROM 
                    $Tabla n, 
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
                    c.idCategoria in(18) AND
                    p.estado=9 AND 
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.posicion";
            return $query;  
            break;
    }
}

?>
