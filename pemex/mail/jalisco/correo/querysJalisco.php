<?php

function numberNotes($optionCase, $fecha)
{
    $query = query($optionCase, $fecha);
    $resultado = mysql_query($query);
    if(mysql_num_rows($resultado) > 0)
    {
        return true;
    }
    return false;
}

function query($op, $Tabla)
{
    $fecha = $Tabla;

    if ($Tabla === date('Y-m-d')) {
        $Tabla = "noticiasDia";
    } else {
        $Tabla = "(
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasSemana WHERE Fecha = '" . $fecha . "'
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasMensual WHERE Fecha = '" . $fecha . "'
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasAnual WHERE Fecha = '" . $fecha . "'
                )";
    }
    switch ($op) {
    case 1: // PRIMERAS PLANAS DF
        $query = "SELECT
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
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o, seccionesPeriodicos s, categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(3) AND
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.posicion";
        return $query;
        break; //Primeras Planas
    case 2: // COLUMNAS POLITICAS DF
        $query = "SELECT
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM
                    $Tabla n,
                    periodicos p,
                    ordenGeneralColumnas o,
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
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.posicion";
        return $query;
        break; //Columnas Politicas
    case 3: // COLUMNAS FINANCIERAS DF
        $query = "SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM
                    $Tabla n,
                    periodicos p,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(20) AND
                    fecha =DATE('$fecha') AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; //Columnas Financieras
    case 4: //Cartones DF
        $query = "SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
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
                    ORDER BY o.posicion
                    ";
        return $query;
        break;

    case 5: // PRIMERAS PLANAS Jalisco
        $query = "SELECT
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
                    e.Nombre as 'Estado'
                    FROM
                    $Tabla n,
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
                    c.idCategoria in(3) AND
                    e.idEstado=p.Estado AND
                    Fecha =DATE('$fecha') AND
                    n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.posicion
                    ";
        return $query;
        break; //Primeras Planas
    case 6: // COLUMNAS POLITICAS Jalisco
        $query = "SELECT
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM
                    $Tabla n,
                    periodicos p,
                    ordenGeneraljalisco o,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE
                    p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    n.Periodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(1) AND
                    e.idEstado=p.Estado AND
                    n.Fecha =DATE('$fecha')
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.posicion";
        return $query;
        break; //Columnas Politicas
    case 7: //Cartones Jalisco
        $query = "SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM
                    $Tabla n,
                    periodicos p,
                    ordenGeneraljalisco o,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE
                    p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    n.Periodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(18) AND
                    e.idEstado=p.Estado AND
                    n.Fecha =DATE('$fecha')
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.posicion";
        return $query;
        break;

    case 8: //Gobernador 0-20 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Texto like '%Jorge Aristoteles Sandoval%' OR
                    Texto like '%Jorge Sandoval Diaz%' OR
                    Texto like '%Aristoteles Sandoval Diaz%' OR
                    Texto like '%Aristoteles Sandoval%' OR
                    Texto like '%gobernador del estado de jalisco%' OR
                    Texto like '%gobernador de jalisco%' OR
                    Texto like '%gobernador del estado Aristoteles Sandoval Diaz%'OR

                    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Jorge Aristoteles Sandoval%' OR
                    Titulo like '%Jorge Sandoval Diaz%' OR
                    Titulo like '%Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Aristoteles Sandoval%' OR
                    Titulo like '%gobernador del estado de jalisco%' OR
                    Titulo like '%gobernador de jalisco%' OR
                    Titulo like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Jorge Aristoteles Sandoval%' OR
                    Encabezado like '%Jorge Sandoval Diaz%' OR
                    Encabezado like '%Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Aristoteles Sandoval%' OR
                    Encabezado like '%gobernador del estado de jalisco%' OR
                    Encabezado like '%gobernador de jalisco%' OR
                    Encabezado like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    PieFoto like '%Jorge Aristoteles Sandoval%' OR
                    PieFoto like '%Jorge Sandoval Diaz%' OR
                    PieFoto like '%Aristoteles Sandoval Diaz%' OR
                    PieFoto like '%Aristoteles Sandoval%' OR
                    PieFoto like '%gobernador del estado de jalisco%' OR
                    PieFoto like '%gobernador de jalisco%' OR
                    PieFoto like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Autor like '%Jorge Aristoteles Sandoval%' OR
                    Autor like '%Jorge Sandoval Diaz%' OR
                    Autor like '%Aristoteles Sandoval Diaz%' OR
                    Autor like '%Aristoteles Sandoval%' OR
                    Autor like '%gobernador del estado de jalisco%' OR
                    Autor like '%gobernador de jalisco%' OR
                    Autor like '%gobernador del estado Aristoteles Sandoval Diaz %'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 0, 30";

        return $query;
        break;

    case 9: //Gobernador 20-40 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Texto like '%Jorge Aristoteles Sandoval%' OR
                    Texto like '%Jorge Sandoval Diaz%' OR
                    Texto like '%Aristoteles Sandoval Diaz%' OR
                    Texto like '%Aristoteles Sandoval%' OR
                    Texto like '%gobernador del estado de jalisco%' OR
                    Texto like '%gobernador de jalisco%' OR
                    Texto like '%gobernador del estado Aristoteles Sandoval Diaz%'OR

                    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Jorge Aristoteles Sandoval%' OR
                    Titulo like '%Jorge Sandoval Diaz%' OR
                    Titulo like '%Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Aristoteles Sandoval%' OR
                    Titulo like '%gobernador del estado de jalisco%' OR
                    Titulo like '%gobernador de jalisco%' OR
                    Titulo like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Jorge Aristoteles Sandoval%' OR
                    Encabezado like '%Jorge Sandoval Diaz%' OR
                    Encabezado like '%Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Aristoteles Sandoval%' OR
                    Encabezado like '%gobernador del estado de jalisco%' OR
                    Encabezado like '%gobernador de jalisco%' OR
                    Encabezado like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    PieFoto like '%Jorge Aristoteles Sandoval%' OR
                    PieFoto like '%Jorge Sandoval Diaz%' OR
                    PieFoto like '%Aristoteles Sandoval Diaz%' OR
                    PieFoto like '%Aristoteles Sandoval%' OR
                    PieFoto like '%gobernador del estado de jalisco%' OR
                    PieFoto like '%gobernador de jalisco%' OR
                    PieFoto like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Autor like '%Jorge Aristoteles Sandoval%' OR
                    Autor like '%Jorge Sandoval Diaz%' OR
                    Autor like '%Aristoteles Sandoval Diaz%' OR
                    Autor like '%Aristoteles Sandoval%' OR
                    Autor like '%gobernador del estado de jalisco%' OR
                    Autor like '%gobernador de jalisco%' OR
                    Autor like '%gobernador del estado Aristoteles Sandoval Diaz %'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 30, 60";

        return $query;
        break;

    case 10: //Gobernador 40-60 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Texto like '%Jorge Aristoteles Sandoval%' OR
                    Texto like '%Jorge Sandoval Diaz%' OR
                    Texto like '%Aristoteles Sandoval Diaz%' OR
                    Texto like '%Aristoteles Sandoval%' OR
                    Texto like '%gobernador del estado de jalisco%' OR
                    Texto like '%gobernador de jalisco%' OR
                    Texto like '%gobernador del estado Aristoteles Sandoval Diaz%'OR

                    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Jorge Aristoteles Sandoval%' OR
                    Titulo like '%Jorge Sandoval Diaz%' OR
                    Titulo like '%Aristoteles Sandoval Diaz%' OR
                    Titulo like '%Aristoteles Sandoval%' OR
                    Titulo like '%gobernador del estado de jalisco%' OR
                    Titulo like '%gobernador de jalisco%' OR
                    Titulo like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Jorge Aristoteles Sandoval%' OR
                    Encabezado like '%Jorge Sandoval Diaz%' OR
                    Encabezado like '%Aristoteles Sandoval Diaz%' OR
                    Encabezado like '%Aristoteles Sandoval%' OR
                    Encabezado like '%gobernador del estado de jalisco%' OR
                    Encabezado like '%gobernador de jalisco%' OR
                    Encabezado like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
                    PieFoto like '%Jorge Aristoteles Sandoval%' OR
                    PieFoto like '%Jorge Sandoval Diaz%' OR
                    PieFoto like '%Aristoteles Sandoval Diaz%' OR
                    PieFoto like '%Aristoteles Sandoval%' OR
                    PieFoto like '%gobernador del estado de jalisco%' OR
                    PieFoto like '%gobernador de jalisco%' OR
                    PieFoto like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                    Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
                    Autor like '%Jorge Aristoteles Sandoval%' OR
                    Autor like '%Jorge Sandoval Diaz%' OR
                    Autor like '%Aristoteles Sandoval Diaz%' OR
                    Autor like '%Aristoteles Sandoval%' OR
                    Autor like '%gobernador del estado de jalisco%' OR
                    Autor like '%gobernador de jalisco%' OR
                    Autor like '%gobernador del estado Aristoteles Sandoval Diaz %'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 60, 90";

        return $query;
        break;

    case 11: //Dependencias 0-20 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                        Texto LIKE '%comunicacion social de Jalisco%'
                        OR Texto LIKE '%gonzalo sanchez garcia%'
                        OR Titulo LIKE '%comunicacion social de Jalisco%'
                        OR Titulo LIKE '%comunicacion social jalisco%'
                        OR Titulo LIKE '%gonzalo sanchez garcia%'
                        OR Encabezado LIKE '%comunicacion social de Jalisco%'
                        OR Encabezado LIKE '%comunicacion social Jalisco%'
                        OR Encabezado LIKE '%gonzalo sanchez garcia%'
                        OR Autor LIKE '%comunicacion social de Jalisco%'
                        OR Autor LIKE '%comunicacion social Jalisco%'
                        OR Autor LIKE '%gonzalo sanchez garcia%'
                        OR Texto LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Texto LIKE '%Hector Rafael Perez Partida%'
                        OR Titulo LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Titulo LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Titulo LIKE '%Hector Rafael Perez Partida%'
                        OR Titulo LIKE '%Rafael Perez Partida%'
                        OR Encabezado LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Encabezado LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Encabezado LIKE '%Héctor Rafael Pérez Partida%'
                        OR Encabezado LIKE '%Rafael Perez Partida%'
                        OR PieFoto LIKE '%Héctor Rafael Pérez Partida%'
                        OR Autor LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Autor LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Autor LIKE '%Héctor Rafael Pérez Partida%'
                        OR Autor LIKE '%Rafael Perez Partida%'
                        OR Titulo LIKE '%SEPAF%'
                        OR Encabezado LIKE '%SEPAF%'
                        OR Autor LIKE '%SEPAF%'
                        OR Titulo LIKE '% SEPAF %'
                        OR Encabezado LIKE '% SEPAF %'
                        OR Autor LIKE '% SEPAF %'
                        OR Texto LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Texto LIKE '%Francisco Ayon lopez%'
                        OR Titulo LIKE '%Secretaria de Educacion Jalisco%'
                        OR Titulo LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Titulo LIKE '%Francisco Ayon lopez%'
                        OR Titulo LIKE '%Paco Ayon lopez%'
                        OR Encabezado LIKE '%Secretaria de Educacion Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Encabezado LIKE '%Francisco Ayon lopez%'
                        OR Encabezado LIKE '%Paco Ayon lopez%'
                        OR Autor LIKE '%Secretaria de Educacion Jalisco%'
                        OR Autor LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Autor LIKE '%Francisco Ayon lopez%'
                        OR Autor LIKE '%Paco Ayon lopez%'
                        OR Autor LIKE '%papayon lopez%'
                        OR Texto LIKE '%Secretaria de salud de Jalisco%'
                        OR Texto LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Titulo LIKE '%Secretaria salud jalisco%'
                        OR Titulo LIKE '%Secretaria de salud Jalisco%'
                        OR Titulo LIKE '%Secretaria de salud de Jalisco%'
                        OR Titulo LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Titulo LIKE '%Jaime Gonzalez alvarez%'
                        OR Titulo LIKE '%Jaime A Gonzalez alvarez%'
                        OR Encabezado LIKE '%Secretaria salud jalisco%'
                        OR Encabezado LIKE '%Secretaria de salud Jalisco%'
                        OR Encabezado LIKE '%Secretaria de salud de Jalisco%'
                        OR Encabezado LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Encabezado LIKE '%Jaime Gonzalez alvarez%'
                        OR Encabezado LIKE '%Jaime A Gonzalez alvarez%'
                        OR Autor LIKE '%Secretaria salud jalisco%'
                        OR Autor LIKE '%Secretaria de salud Jalisco%'
                        OR Autor LIKE '%Secretaria de salud de Jalisco%'
                        OR Autor LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Autor LIKE '%Jaime Gonzalez alvarez%'
                        OR Autor LIKE '%Jaime A Gonzalez alvarez%'
                        OR Texto LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Texto LIKE '%Roberto Davalos Lopez%'
                        OR Titulo LIKE '%Secretaria de infraestructura y obra publica jalisco%'
                        OR Titulo LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Titulo LIKE '%Roberto Davalos Lopez%'
                        OR Encabezado LIKE '%Secretaria de infraestructura y obra publica jalisco%'
                        OR Encabezado LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Encabezado LIKE '%Roberto Davalos Lopez%'
                        OR Autor LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Autor LIKE '%Roberto Davalos Lopez%'
                        OR Titulo LIKE '%SIOP%'
                        OR Encabezado LIKE '%SIOP%'
                        OR Autor LIKE '%SIOP%'
                        OR Titulo LIKE '% SIOP %'
                        OR Encabezado LIKE '% SIOP %'
                        OR Autor LIKE '% SIOP %'
                        OR Texto LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Texto LIKE '%jose palacios jimenez%'
                        OR Titulo LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Titulo LIKE '%secretaria de desarrollo economico jalisco%'
                        OR Titulo LIKE '%jose palacios jimenez%'
                        OR Encabezado LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Encabezado LIKE '%secretaria de desarrollo economico jalisco%'
                        OR Encabezado LIKE '%jose palacios jimenez%'
                        OR Titulo LIKE '%SEDECO%'
                        OR Encabezado LIKE '%SEDECO%'
                        OR Autor LIKE '%SEDECO%'
                        OR Titulo LIKE '% SEDECO %'
                        OR Encabezado LIKE '% SEDECO %'
                        OR Autor LIKE '% SEDECO %'
                        OR Texto LIKE '%Secretaria de Turismo Jalisco%'
                        OR Texto LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Texto LIKE '%Jesus Enrique Ramos Flores%'
                        OR Texto LIKE '%Jesus e Ramos Flores%'
                        OR Texto LIKE '%Enrique Ramos Flores%'
                        OR Titulo LIKE '%Secretaria de Turismo Jalisco%'
                        OR Titulo LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Titulo LIKE '%Jesus Enrique Ramos Flores%'
                        OR Titulo LIKE '%Jesus e Ramos Flores%'
                        OR Titulo LIKE '%Enrique Ramos Flores%'
                        OR Encabezado LIKE '%Secretaria de Turismo Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Encabezado LIKE '%Jesus Enrique Ramos Flores%'
                        OR Encabezado LIKE '%Jesus e Ramos Flores%'
                        OR Encabezado LIKE '%Enrique Ramos Flores%'
                        OR Autor LIKE '%Secretaria de Turismo Jalisco%'
                        OR Autor LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Autor LIKE '%Jesus Enrique Ramos Flores%'
                        OR Autor LIKE '%Jesus e Ramos Flores%'
                        OR Autor LIKE '%Enrique Ramos Flores%'
                        OR Titulo LIKE '%SECTUR%'
                        OR Encabezado LIKE '%SECTUR%'
                        OR Autor LIKE '%SEDIS%'
                        OR Titulo LIKE '% SECTUR %'
                        OR Encabezado LIKE '% SECTUR %'
                        OR Autor LIKE '% SECTUR %'
                        OR Texto LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Texto LIKE '%Hector Padilla Gutierrez%'
                        OR Titulo LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Titulo LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Titulo LIKE '%Hector Padilla Gutierrez%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Encabezado LIKE '%Hector Padilla Gutierrez%'
                        OR Autor LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Autor LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Autor LIKE '%Hector Padilla Gutierrez%'
                        OR Titulo LIKE '%SEDER%'
                        OR Encabezado LIKE '%SEDER%'
                        OR Autor LIKE '%SEDER%'
                        OR Titulo LIKE '% SEDER %'
                        OR Encabezado LIKE '% SEDER %'
                        OR Autor LIKE '% SEDER %'
                        OR Texto LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Texto LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Titulo LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Titulo LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%Magdalena Ruiz Mejia%'
                        OR Encabezado LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Encabezado LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Encabezado LIKE '%Magdalena Ruiz Mejia%'
                        OR Autor LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Autor LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Autor LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Autor LIKE '%Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%SEMADET%'
                        OR Encabezado LIKE '%SEMADET%'
                        OR Autor LIKE '%SEMADET%'
                        OR Titulo LIKE '% SEMADET %'
                        OR Encabezado LIKE '% SEMADET %'
                        OR Autor LIKE '% SEMADET %'
                        OR Texto LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Texto LIKE '%Daviel Trujillo Cuevas%'
                        OR Titulo LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Titulo LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Titulo LIKE '%Daviel Trujillo Cuevas%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Encabezado LIKE '%Daviel Trujillo Cuevas%'
                        OR Autor LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Autor LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Autor LIKE '%Daviel Trujillo Cuevas%'
                        OR Titulo LIKE '%SEDIS%'
                        OR Encabezado LIKE '%SEDIS%'
                        OR Autor LIKE '%SEDIS%'
                        OR Titulo LIKE '% SEDIS %'
                        OR Encabezado LIKE '% SEDIS %'
                        OR Autor LIKE '% SEDIS %'
                        OR Texto LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Texto LIKE '%Jaime Reyes Robles%'
                        OR Titulo LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Titulo LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Titulo LIKE '%Jaime Reyes Robles%'
                        OR Encabezado LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Encabezado LIKE '%Jaime Reyes Robles%'
                        OR Autor LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Autor LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Autor LIKE '%Jaime Reyes Robles%'
                        OR Titulo LIKE '%SICYT%'
                        OR Encabezado LIKE '%SICYT%'
                        OR Autor LIKE '%SICYT%'
                        OR Titulo LIKE '% SICYT %'
                        OR Encabezado LIKE '% SICYT %'
                        OR Autor LIKE '% SICYT %'
                        OR Texto LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Texto LIKE '%Myriam Vachez Plagnol%'
                        OR Titulo LIKE '%Secretaria de Cultura Jalisco%'
                        OR Titulo LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Titulo LIKE '%Myriam Vachez Plagnol%'
                        OR Titulo LIKE '%Vachez Plagnol%'
                        OR Titulo LIKE '%Myriam Vachez%'
                        OR Encabezado LIKE '%Secretaria de Cultura Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Encabezado LIKE '%Myriam Vachez Plagnol%'
                        OR Encabezado LIKE '%Vachez Plagnol%'
                        OR Encabezado LIKE '%Myriam Vachez%'
                        OR Autor LIKE '%Secretaria de Cultura Jalisco%'
                        OR Autor LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Autor LIKE '%Myriam Vachez Plagnol%'
                        OR Autor LIKE '%Vachez Plagnol%'
                        OR Autor LIKE '%Myriam Vachez%'
                        OR Texto LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Texto LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Texto LIKE '%Hector Pizano Ramos%'
                        OR Texto LIKE '%Hector Pizano%'
                        OR Texto LIKE '%Pizano Ramos%'
                        OR Titulo LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Titulo LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Titulo LIKE '%Hector Pizano Ramos%'
                        OR Titulo LIKE '%Hector Pizano%'
                        OR Titulo LIKE '%Pizano Ramos%'
                        OR Encabezado LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Encabezado LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Encabezado LIKE '%Hector Pizano Ramos%'
                        OR Encabezado LIKE '%Hector Pizano%'
                        OR Encabezado LIKE '%Pizano Ramos%'
                        OR Texto LIKE '% stps jalisco %'
                        OR Titulo LIKE '% stps jalisco %'
                        OR Encabezado LIKE '% stps jalisco %'
                        OR Autor LIKE '% stps jalisco %'
                        OR Texto LIKE '%secretaria de movilidad de jalisco%'
                        OR Texto LIKE '%Servando Sepulveda Enriquez%'
                        OR Titulo LIKE '%secretaria de movilidad de jalisco%'
                        OR Titulo LIKE '%movilidad jalisco%'
                        OR Titulo LIKE '%secretaria de movilidad jalisco%'
                        OR Titulo LIKE '%Servando Sepulveda Enriquez%'
                        OR Titulo LIKE '%Servando Sepulveda%'
                        OR Titulo LIKE '%Sepulveda Enriquez%'
                        OR Encabezado LIKE '%secretaria de movilidad de jalisco%'
                        OR Encabezado LIKE '%movilidad jalisco%'
                        OR Encabezado LIKE '%secretaria de movilidad jalisco%'
                        OR Encabezado LIKE '%Servando Sepulveda Enriquez%'
                        OR Encabezado LIKE '%Servando Sepulveda%'
                        OR Encabezado LIKE '%Sepulveda Enriquez%'
                        OR Titulo LIKE '%SEMOV%'
                        OR Encabezado LIKE '%SEMOV%'
                        OR Autor LIKE '%SEMOV%'
                        OR Titulo LIKE '% SEMOV %'
                        OR Encabezado LIKE '% SEMOV %'
                        OR Autor LIKE '% SEMOV %'
                        OR Texto LIKE '%secrearia general de jalisco%'
                        OR Texto LIKE '%roberto lopez lara%'
                        OR Titulo LIKE '%secrearia general de jalisco%'
                        OR Titulo LIKE '%secretaria general jalisco%'
                        OR Titulo LIKE '%roberto lopez lara%'
                        OR Titulo LIKE '%chino lopez%'
                        OR Encabezado LIKE '%secrearia general de jalisco%'
                        OR Encabezado LIKE '%secretaria general jalisco%'
                        OR Encabezado LIKE '%roberto lopez lara%'
                        OR Encabezado LIKE '%chino lopez%'
                        OR Texto LIKE '%procuraduria social de jalisco%'
                        OR Texto LIKE '%felicitas velazquez serrano%'
                        OR Titulo LIKE '%procuraduria social de jalisco%'
                        OR Titulo LIKE '%procuraduria social jalisco%'
                        OR Titulo LIKE '%felicitas velazquez serrano%'
                        OR Encabezado LIKE '%procuraduria social de jalisco%'
                        OR Encabezado LIKE '%procuraduria social jalisco%'
                        OR Encabezado LIKE '%felicitas velazquez serrano%'
                        OR Titulo LIKE '%PROSOC%'
                        OR Encabezado LIKE '%PROSOC%'
                        OR Autor LIKE '%PROSOC%'
                        OR Titulo LIKE '% PROSOC %'
                        OR Encabezado LIKE '% PROSOC %'
                        OR Autor LIKE '% PROSOC %'
                        OR Texto LIKE '%despacho del gobernador de jalisco%'
                        OR Texto LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Titulo LIKE '%despacho del gobernador de jalisco%'
                        OR Titulo LIKE '%despacho del gobernador jalisco%'
                        OR Titulo LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Titulo LIKE '%netzahualcoyotl ornelas%'
                        OR Titulo LIKE '%despacho del gobernador de jalisco%'
                        OR Encabezado LIKE '%despacho del gobernador de jalisco%'
                        OR Encabezado LIKE '%despacho del gobernador jalisco%'
                        OR Encabezado LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Encabezado LIKE '%netzahualcoyotl ornelas%'
                        OR Encabezado LIKE '%despacho del gobernador de jalisco%'
                        OR Texto LIKE '%juan jose bañuelos guardado%'
                        OR Titulo LIKE '%contraloria de jalisco%'
                        OR Titulo LIKE '%juan jose bañuelos guardado%'
                        OR Titulo LIKE '%juan jose bañuelos%'
                        OR Encabezado LIKE '%contraloria de jalisco%'
                        OR Encabezado LIKE '%juan jose bañuelos guardado%'
                        OR Encabezado LIKE '%juan jose bañuelos%')
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 0, 30";

        return $query;
        break;

    case 12: //Dependencias 20-40 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                        Texto LIKE '%comunicacion social de Jalisco%'
                        OR Texto LIKE '%gonzalo sanchez garcia%'
                        OR Titulo LIKE '%comunicacion social de Jalisco%'
                        OR Titulo LIKE '%comunicacion social jalisco%'
                        OR Titulo LIKE '%gonzalo sanchez garcia%'
                        OR Encabezado LIKE '%comunicacion social de Jalisco%'
                        OR Encabezado LIKE '%comunicacion social Jalisco%'
                        OR Encabezado LIKE '%gonzalo sanchez garcia%'
                        OR Autor LIKE '%comunicacion social de Jalisco%'
                        OR Autor LIKE '%comunicacion social Jalisco%'
                        OR Autor LIKE '%gonzalo sanchez garcia%'
                        OR Texto LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Texto LIKE '%Hector Rafael Perez Partida%'
                        OR Titulo LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Titulo LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Titulo LIKE '%Hector Rafael Perez Partida%'
                        OR Titulo LIKE '%Rafael Perez Partida%'
                        OR Encabezado LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Encabezado LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Encabezado LIKE '%Héctor Rafael Pérez Partida%'
                        OR Encabezado LIKE '%Rafael Perez Partida%'
                        OR PieFoto LIKE '%Héctor Rafael Pérez Partida%'
                        OR Autor LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Autor LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Autor LIKE '%Héctor Rafael Pérez Partida%'
                        OR Autor LIKE '%Rafael Perez Partida%'
                        OR Titulo LIKE '%SEPAF%'
                        OR Encabezado LIKE '%SEPAF%'
                        OR Autor LIKE '%SEPAF%'
                        OR Titulo LIKE '% SEPAF %'
                        OR Encabezado LIKE '% SEPAF %'
                        OR Autor LIKE '% SEPAF %'
                        OR Texto LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Texto LIKE '%Francisco Ayon lopez%'
                        OR Titulo LIKE '%Secretaria de Educacion Jalisco%'
                        OR Titulo LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Titulo LIKE '%Francisco Ayon lopez%'
                        OR Titulo LIKE '%Paco Ayon lopez%'
                        OR Encabezado LIKE '%Secretaria de Educacion Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Encabezado LIKE '%Francisco Ayon lopez%'
                        OR Encabezado LIKE '%Paco Ayon lopez%'
                        OR Autor LIKE '%Secretaria de Educacion Jalisco%'
                        OR Autor LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Autor LIKE '%Francisco Ayon lopez%'
                        OR Autor LIKE '%Paco Ayon lopez%'
                        OR Autor LIKE '%papayon lopez%'
                        OR Texto LIKE '%Secretaria de salud de Jalisco%'
                        OR Texto LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Titulo LIKE '%Secretaria salud jalisco%'
                        OR Titulo LIKE '%Secretaria de salud Jalisco%'
                        OR Titulo LIKE '%Secretaria de salud de Jalisco%'
                        OR Titulo LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Titulo LIKE '%Jaime Gonzalez alvarez%'
                        OR Titulo LIKE '%Jaime A Gonzalez alvarez%'
                        OR Encabezado LIKE '%Secretaria salud jalisco%'
                        OR Encabezado LIKE '%Secretaria de salud Jalisco%'
                        OR Encabezado LIKE '%Secretaria de salud de Jalisco%'
                        OR Encabezado LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Encabezado LIKE '%Jaime Gonzalez alvarez%'
                        OR Encabezado LIKE '%Jaime A Gonzalez alvarez%'
                        OR Autor LIKE '%Secretaria salud jalisco%'
                        OR Autor LIKE '%Secretaria de salud Jalisco%'
                        OR Autor LIKE '%Secretaria de salud de Jalisco%'
                        OR Autor LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Autor LIKE '%Jaime Gonzalez alvarez%'
                        OR Autor LIKE '%Jaime A Gonzalez alvarez%'
                        OR Texto LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Texto LIKE '%Roberto Davalos Lopez%'
                        OR Titulo LIKE '%Secretaria de infraestructura y obra publica jalisco%'
                        OR Titulo LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Titulo LIKE '%Roberto Davalos Lopez%'
                        OR Encabezado LIKE '%Secretaria de infraestructura y obra publica jalisco%'
                        OR Encabezado LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Encabezado LIKE '%Roberto Davalos Lopez%'
                        OR Autor LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Autor LIKE '%Roberto Davalos Lopez%'
                        OR Titulo LIKE '%SIOP%'
                        OR Encabezado LIKE '%SIOP%'
                        OR Autor LIKE '%SIOP%'
                        OR Titulo LIKE '% SIOP %'
                        OR Encabezado LIKE '% SIOP %'
                        OR Autor LIKE '% SIOP %'
                        OR Texto LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Texto LIKE '%jose palacios jimenez%'
                        OR Titulo LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Titulo LIKE '%secretaria de desarrollo economico jalisco%'
                        OR Titulo LIKE '%jose palacios jimenez%'
                        OR Encabezado LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Encabezado LIKE '%secretaria de desarrollo economico jalisco%'
                        OR Encabezado LIKE '%jose palacios jimenez%'
                        OR Titulo LIKE '%SEDECO%'
                        OR Encabezado LIKE '%SEDECO%'
                        OR Autor LIKE '%SEDECO%'
                        OR Titulo LIKE '% SEDECO %'
                        OR Encabezado LIKE '% SEDECO %'
                        OR Autor LIKE '% SEDECO %'
                        OR Texto LIKE '%Secretaria de Turismo Jalisco%'
                        OR Texto LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Texto LIKE '%Jesus Enrique Ramos Flores%'
                        OR Texto LIKE '%Jesus e Ramos Flores%'
                        OR Texto LIKE '%Enrique Ramos Flores%'
                        OR Titulo LIKE '%Secretaria de Turismo Jalisco%'
                        OR Titulo LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Titulo LIKE '%Jesus Enrique Ramos Flores%'
                        OR Titulo LIKE '%Jesus e Ramos Flores%'
                        OR Titulo LIKE '%Enrique Ramos Flores%'
                        OR Encabezado LIKE '%Secretaria de Turismo Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Encabezado LIKE '%Jesus Enrique Ramos Flores%'
                        OR Encabezado LIKE '%Jesus e Ramos Flores%'
                        OR Encabezado LIKE '%Enrique Ramos Flores%'
                        OR Autor LIKE '%Secretaria de Turismo Jalisco%'
                        OR Autor LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Autor LIKE '%Jesus Enrique Ramos Flores%'
                        OR Autor LIKE '%Jesus e Ramos Flores%'
                        OR Autor LIKE '%Enrique Ramos Flores%'
                        OR Titulo LIKE '%SECTUR%'
                        OR Encabezado LIKE '%SECTUR%'
                        OR Autor LIKE '%SEDIS%'
                        OR Titulo LIKE '% SECTUR %'
                        OR Encabezado LIKE '% SECTUR %'
                        OR Autor LIKE '% SECTUR %'
                        OR Texto LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Texto LIKE '%Hector Padilla Gutierrez%'
                        OR Titulo LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Titulo LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Titulo LIKE '%Hector Padilla Gutierrez%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Encabezado LIKE '%Hector Padilla Gutierrez%'
                        OR Autor LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Autor LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Autor LIKE '%Hector Padilla Gutierrez%'
                        OR Titulo LIKE '%SEDER%'
                        OR Encabezado LIKE '%SEDER%'
                        OR Autor LIKE '%SEDER%'
                        OR Titulo LIKE '% SEDER %'
                        OR Encabezado LIKE '% SEDER %'
                        OR Autor LIKE '% SEDER %'
                        OR Texto LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Texto LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Titulo LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Titulo LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%Magdalena Ruiz Mejia%'
                        OR Encabezado LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Encabezado LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Encabezado LIKE '%Magdalena Ruiz Mejia%'
                        OR Autor LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Autor LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Autor LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Autor LIKE '%Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%SEMADET%'
                        OR Encabezado LIKE '%SEMADET%'
                        OR Autor LIKE '%SEMADET%'
                        OR Titulo LIKE '% SEMADET %'
                        OR Encabezado LIKE '% SEMADET %'
                        OR Autor LIKE '% SEMADET %'
                        OR Texto LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Texto LIKE '%Daviel Trujillo Cuevas%'
                        OR Titulo LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Titulo LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Titulo LIKE '%Daviel Trujillo Cuevas%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Encabezado LIKE '%Daviel Trujillo Cuevas%'
                        OR Autor LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Autor LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Autor LIKE '%Daviel Trujillo Cuevas%'
                        OR Titulo LIKE '%SEDIS%'
                        OR Encabezado LIKE '%SEDIS%'
                        OR Autor LIKE '%SEDIS%'
                        OR Titulo LIKE '% SEDIS %'
                        OR Encabezado LIKE '% SEDIS %'
                        OR Autor LIKE '% SEDIS %'
                        OR Texto LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Texto LIKE '%Jaime Reyes Robles%'
                        OR Titulo LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Titulo LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Titulo LIKE '%Jaime Reyes Robles%'
                        OR Encabezado LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Encabezado LIKE '%Jaime Reyes Robles%'
                        OR Autor LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Autor LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Autor LIKE '%Jaime Reyes Robles%'
                        OR Titulo LIKE '%SICYT%'
                        OR Encabezado LIKE '%SICYT%'
                        OR Autor LIKE '%SICYT%'
                        OR Titulo LIKE '% SICYT %'
                        OR Encabezado LIKE '% SICYT %'
                        OR Autor LIKE '% SICYT %'
                        OR Texto LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Texto LIKE '%Myriam Vachez Plagnol%'
                        OR Titulo LIKE '%Secretaria de Cultura Jalisco%'
                        OR Titulo LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Titulo LIKE '%Myriam Vachez Plagnol%'
                        OR Titulo LIKE '%Vachez Plagnol%'
                        OR Titulo LIKE '%Myriam Vachez%'
                        OR Encabezado LIKE '%Secretaria de Cultura Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Encabezado LIKE '%Myriam Vachez Plagnol%'
                        OR Encabezado LIKE '%Vachez Plagnol%'
                        OR Encabezado LIKE '%Myriam Vachez%'
                        OR Autor LIKE '%Secretaria de Cultura Jalisco%'
                        OR Autor LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Autor LIKE '%Myriam Vachez Plagnol%'
                        OR Autor LIKE '%Vachez Plagnol%'
                        OR Autor LIKE '%Myriam Vachez%'
                        OR Texto LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Texto LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Texto LIKE '%Hector Pizano Ramos%'
                        OR Texto LIKE '%Hector Pizano%'
                        OR Texto LIKE '%Pizano Ramos%'
                        OR Titulo LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Titulo LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Titulo LIKE '%Hector Pizano Ramos%'
                        OR Titulo LIKE '%Hector Pizano%'
                        OR Titulo LIKE '%Pizano Ramos%'
                        OR Encabezado LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Encabezado LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Encabezado LIKE '%Hector Pizano Ramos%'
                        OR Encabezado LIKE '%Hector Pizano%'
                        OR Encabezado LIKE '%Pizano Ramos%'
                        OR Texto LIKE '% stps jalisco %'
                        OR Titulo LIKE '% stps jalisco %'
                        OR Encabezado LIKE '% stps jalisco %'
                        OR Autor LIKE '% stps jalisco %'
                        OR Texto LIKE '%secretaria de movilidad de jalisco%'
                        OR Texto LIKE '%Servando Sepulveda Enriquez%'
                        OR Titulo LIKE '%secretaria de movilidad de jalisco%'
                        OR Titulo LIKE '%movilidad jalisco%'
                        OR Titulo LIKE '%secretaria de movilidad jalisco%'
                        OR Titulo LIKE '%Servando Sepulveda Enriquez%'
                        OR Titulo LIKE '%Servando Sepulveda%'
                        OR Titulo LIKE '%Sepulveda Enriquez%'
                        OR Encabezado LIKE '%secretaria de movilidad de jalisco%'
                        OR Encabezado LIKE '%movilidad jalisco%'
                        OR Encabezado LIKE '%secretaria de movilidad jalisco%'
                        OR Encabezado LIKE '%Servando Sepulveda Enriquez%'
                        OR Encabezado LIKE '%Servando Sepulveda%'
                        OR Encabezado LIKE '%Sepulveda Enriquez%'
                        OR Titulo LIKE '%SEMOV%'
                        OR Encabezado LIKE '%SEMOV%'
                        OR Autor LIKE '%SEMOV%'
                        OR Titulo LIKE '% SEMOV %'
                        OR Encabezado LIKE '% SEMOV %'
                        OR Autor LIKE '% SEMOV %'
                        OR Texto LIKE '%secrearia general de jalisco%'
                        OR Texto LIKE '%roberto lopez lara%'
                        OR Titulo LIKE '%secrearia general de jalisco%'
                        OR Titulo LIKE '%secretaria general jalisco%'
                        OR Titulo LIKE '%roberto lopez lara%'
                        OR Titulo LIKE '%chino lopez%'
                        OR Encabezado LIKE '%secrearia general de jalisco%'
                        OR Encabezado LIKE '%secretaria general jalisco%'
                        OR Encabezado LIKE '%roberto lopez lara%'
                        OR Encabezado LIKE '%chino lopez%'
                        OR Texto LIKE '%procuraduria social de jalisco%'
                        OR Texto LIKE '%felicitas velazquez serrano%'
                        OR Titulo LIKE '%procuraduria social de jalisco%'
                        OR Titulo LIKE '%procuraduria social jalisco%'
                        OR Titulo LIKE '%felicitas velazquez serrano%'
                        OR Encabezado LIKE '%procuraduria social de jalisco%'
                        OR Encabezado LIKE '%procuraduria social jalisco%'
                        OR Encabezado LIKE '%felicitas velazquez serrano%'
                        OR Titulo LIKE '%PROSOC%'
                        OR Encabezado LIKE '%PROSOC%'
                        OR Autor LIKE '%PROSOC%'
                        OR Titulo LIKE '% PROSOC %'
                        OR Encabezado LIKE '% PROSOC %'
                        OR Autor LIKE '% PROSOC %'
                        OR Texto LIKE '%despacho del gobernador de jalisco%'
                        OR Texto LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Titulo LIKE '%despacho del gobernador de jalisco%'
                        OR Titulo LIKE '%despacho del gobernador jalisco%'
                        OR Titulo LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Titulo LIKE '%netzahualcoyotl ornelas%'
                        OR Titulo LIKE '%despacho del gobernador de jalisco%'
                        OR Encabezado LIKE '%despacho del gobernador de jalisco%'
                        OR Encabezado LIKE '%despacho del gobernador jalisco%'
                        OR Encabezado LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Encabezado LIKE '%netzahualcoyotl ornelas%'
                        OR Encabezado LIKE '%despacho del gobernador de jalisco%'
                        OR Texto LIKE '%juan jose bañuelos guardado%'
                        OR Titulo LIKE '%contraloria de jalisco%'
                        OR Titulo LIKE '%juan jose bañuelos guardado%'
                        OR Titulo LIKE '%juan jose bañuelos%'
                        OR Encabezado LIKE '%contraloria de jalisco%'
                        OR Encabezado LIKE '%juan jose bañuelos guardado%'
                        OR Encabezado LIKE '%juan jose bañuelos%')
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 30, 60";

        return $query;
        break;

    case 13: //Dependencias 40-60 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                        Texto LIKE '%comunicacion social de Jalisco%'
                        OR Texto LIKE '%gonzalo sanchez garcia%'
                        OR Titulo LIKE '%comunicacion social de Jalisco%'
                        OR Titulo LIKE '%comunicacion social jalisco%'
                        OR Titulo LIKE '%gonzalo sanchez garcia%'
                        OR Encabezado LIKE '%comunicacion social de Jalisco%'
                        OR Encabezado LIKE '%comunicacion social Jalisco%'
                        OR Encabezado LIKE '%gonzalo sanchez garcia%'
                        OR Autor LIKE '%comunicacion social de Jalisco%'
                        OR Autor LIKE '%comunicacion social Jalisco%'
                        OR Autor LIKE '%gonzalo sanchez garcia%'
                        OR Texto LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Texto LIKE '%Hector Rafael Perez Partida%'
                        OR Titulo LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Titulo LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Titulo LIKE '%Hector Rafael Perez Partida%'
                        OR Titulo LIKE '%Rafael Perez Partida%'
                        OR Encabezado LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Encabezado LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Encabezado LIKE '%Héctor Rafael Pérez Partida%'
                        OR Encabezado LIKE '%Rafael Perez Partida%'
                        OR PieFoto LIKE '%Héctor Rafael Pérez Partida%'
                        OR Autor LIKE '%Secretaria de administracion, planeacion y finanzas%'
                        OR Autor LIKE '%Secretaria de administracion, planeacion y finanzas de Jalisco%'
                        OR Autor LIKE '%Héctor Rafael Pérez Partida%'
                        OR Autor LIKE '%Rafael Perez Partida%'
                        OR Titulo LIKE '%SEPAF%'
                        OR Encabezado LIKE '%SEPAF%'
                        OR Autor LIKE '%SEPAF%'
                        OR Titulo LIKE '% SEPAF %'
                        OR Encabezado LIKE '% SEPAF %'
                        OR Autor LIKE '% SEPAF %'
                        OR Texto LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Texto LIKE '%Francisco Ayon lopez%'
                        OR Titulo LIKE '%Secretaria de Educacion Jalisco%'
                        OR Titulo LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Titulo LIKE '%Francisco Ayon lopez%'
                        OR Titulo LIKE '%Paco Ayon lopez%'
                        OR Encabezado LIKE '%Secretaria de Educacion Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Encabezado LIKE '%Francisco Ayon lopez%'
                        OR Encabezado LIKE '%Paco Ayon lopez%'
                        OR Autor LIKE '%Secretaria de Educacion Jalisco%'
                        OR Autor LIKE '%Secretaria de Educacion de Jalisco%'
                        OR Autor LIKE '%Francisco Ayon lopez%'
                        OR Autor LIKE '%Paco Ayon lopez%'
                        OR Autor LIKE '%papayon lopez%'
                        OR Texto LIKE '%Secretaria de salud de Jalisco%'
                        OR Texto LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Titulo LIKE '%Secretaria salud jalisco%'
                        OR Titulo LIKE '%Secretaria de salud Jalisco%'
                        OR Titulo LIKE '%Secretaria de salud de Jalisco%'
                        OR Titulo LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Titulo LIKE '%Jaime Gonzalez alvarez%'
                        OR Titulo LIKE '%Jaime A Gonzalez alvarez%'
                        OR Encabezado LIKE '%Secretaria salud jalisco%'
                        OR Encabezado LIKE '%Secretaria de salud Jalisco%'
                        OR Encabezado LIKE '%Secretaria de salud de Jalisco%'
                        OR Encabezado LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Encabezado LIKE '%Jaime Gonzalez alvarez%'
                        OR Encabezado LIKE '%Jaime A Gonzalez alvarez%'
                        OR Autor LIKE '%Secretaria salud jalisco%'
                        OR Autor LIKE '%Secretaria de salud Jalisco%'
                        OR Autor LIKE '%Secretaria de salud de Jalisco%'
                        OR Autor LIKE '%Jaime Agustin Gonzalez alvarez%'
                        OR Autor LIKE '%Jaime Gonzalez alvarez%'
                        OR Autor LIKE '%Jaime A Gonzalez alvarez%'
                        OR Texto LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Texto LIKE '%Roberto Davalos Lopez%'
                        OR Titulo LIKE '%Secretaria de infraestructura y obra publica jalisco%'
                        OR Titulo LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Titulo LIKE '%Roberto Davalos Lopez%'
                        OR Encabezado LIKE '%Secretaria de infraestructura y obra publica jalisco%'
                        OR Encabezado LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Encabezado LIKE '%Roberto Davalos Lopez%'
                        OR Autor LIKE '%Secretaria de infraestructura y obra publica de jalisco%'
                        OR Autor LIKE '%Roberto Davalos Lopez%'
                        OR Titulo LIKE '%SIOP%'
                        OR Encabezado LIKE '%SIOP%'
                        OR Autor LIKE '%SIOP%'
                        OR Titulo LIKE '% SIOP %'
                        OR Encabezado LIKE '% SIOP %'
                        OR Autor LIKE '% SIOP %'
                        OR Texto LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Texto LIKE '%jose palacios jimenez%'
                        OR Titulo LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Titulo LIKE '%secretaria de desarrollo economico jalisco%'
                        OR Titulo LIKE '%jose palacios jimenez%'
                        OR Encabezado LIKE '%secretaria de desarrollo economico de jalisco%'
                        OR Encabezado LIKE '%secretaria de desarrollo economico jalisco%'
                        OR Encabezado LIKE '%jose palacios jimenez%'
                        OR Titulo LIKE '%SEDECO%'
                        OR Encabezado LIKE '%SEDECO%'
                        OR Autor LIKE '%SEDECO%'
                        OR Titulo LIKE '% SEDECO %'
                        OR Encabezado LIKE '% SEDECO %'
                        OR Autor LIKE '% SEDECO %'
                        OR Texto LIKE '%Secretaria de Turismo Jalisco%'
                        OR Texto LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Texto LIKE '%Jesus Enrique Ramos Flores%'
                        OR Texto LIKE '%Jesus e Ramos Flores%'
                        OR Texto LIKE '%Enrique Ramos Flores%'
                        OR Titulo LIKE '%Secretaria de Turismo Jalisco%'
                        OR Titulo LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Titulo LIKE '%Jesus Enrique Ramos Flores%'
                        OR Titulo LIKE '%Jesus e Ramos Flores%'
                        OR Titulo LIKE '%Enrique Ramos Flores%'
                        OR Encabezado LIKE '%Secretaria de Turismo Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Encabezado LIKE '%Jesus Enrique Ramos Flores%'
                        OR Encabezado LIKE '%Jesus e Ramos Flores%'
                        OR Encabezado LIKE '%Enrique Ramos Flores%'
                        OR Autor LIKE '%Secretaria de Turismo Jalisco%'
                        OR Autor LIKE '%Secretaria de Turismo de Jalisco%'
                        OR Autor LIKE '%Jesus Enrique Ramos Flores%'
                        OR Autor LIKE '%Jesus e Ramos Flores%'
                        OR Autor LIKE '%Enrique Ramos Flores%'
                        OR Titulo LIKE '%SECTUR%'
                        OR Encabezado LIKE '%SECTUR%'
                        OR Autor LIKE '%SEDIS%'
                        OR Titulo LIKE '% SECTUR %'
                        OR Encabezado LIKE '% SECTUR %'
                        OR Autor LIKE '% SECTUR %'
                        OR Texto LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Texto LIKE '%Hector Padilla Gutierrez%'
                        OR Titulo LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Titulo LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Titulo LIKE '%Hector Padilla Gutierrez%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Encabezado LIKE '%Hector Padilla Gutierrez%'
                        OR Autor LIKE '%Secretaria de Desarrollo Rural Jalisco%'
                        OR Autor LIKE '%Secretaria de Desarrollo Rural de Jalisco%'
                        OR Autor LIKE '%Hector Padilla Gutierrez%'
                        OR Titulo LIKE '%SEDER%'
                        OR Encabezado LIKE '%SEDER%'
                        OR Autor LIKE '%SEDER%'
                        OR Titulo LIKE '% SEDER %'
                        OR Encabezado LIKE '% SEDER %'
                        OR Autor LIKE '% SEDER %'
                        OR Texto LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Texto LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Titulo LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Titulo LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%Magdalena Ruiz Mejia%'
                        OR Encabezado LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Encabezado LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Encabezado LIKE '%Magdalena Ruiz Mejia%'
                        OR Autor LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial Jalisco%'
                        OR Autor LIKE '%Secretaria de Medio Ambiente y Desarrollo Territorial de Jalisco%'
                        OR Autor LIKE '%Maria Magdalena Ruiz Mejia%'
                        OR Autor LIKE '%Magdalena Ruiz Mejia%'
                        OR Titulo LIKE '%SEMADET%'
                        OR Encabezado LIKE '%SEMADET%'
                        OR Autor LIKE '%SEMADET%'
                        OR Titulo LIKE '% SEMADET %'
                        OR Encabezado LIKE '% SEMADET %'
                        OR Autor LIKE '% SEMADET %'
                        OR Texto LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Texto LIKE '%Daviel Trujillo Cuevas%'
                        OR Titulo LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Titulo LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Titulo LIKE '%Daviel Trujillo Cuevas%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Encabezado LIKE '%Daviel Trujillo Cuevas%'
                        OR Autor LIKE '%Secretaria de Desarrollo e Integracion Social Jalisco%'
                        OR Autor LIKE '%Secretaria de Desarrollo e Integracion Social de Jalisco%'
                        OR Autor LIKE '%Daviel Trujillo Cuevas%'
                        OR Titulo LIKE '%SEDIS%'
                        OR Encabezado LIKE '%SEDIS%'
                        OR Autor LIKE '%SEDIS%'
                        OR Titulo LIKE '% SEDIS %'
                        OR Encabezado LIKE '% SEDIS %'
                        OR Autor LIKE '% SEDIS %'
                        OR Texto LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Texto LIKE '%Jaime Reyes Robles%'
                        OR Titulo LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Titulo LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Titulo LIKE '%Jaime Reyes Robles%'
                        OR Encabezado LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Encabezado LIKE '%Jaime Reyes Robles%'
                        OR Autor LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia Jalisco%'
                        OR Autor LIKE '%Secretaria de Innovacion, Ciencia y Tecnologia de Jalisco%'
                        OR Autor LIKE '%Jaime Reyes Robles%'
                        OR Titulo LIKE '%SICYT%'
                        OR Encabezado LIKE '%SICYT%'
                        OR Autor LIKE '%SICYT%'
                        OR Titulo LIKE '% SICYT %'
                        OR Encabezado LIKE '% SICYT %'
                        OR Autor LIKE '% SICYT %'
                        OR Texto LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Texto LIKE '%Myriam Vachez Plagnol%'
                        OR Titulo LIKE '%Secretaria de Cultura Jalisco%'
                        OR Titulo LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Titulo LIKE '%Myriam Vachez Plagnol%'
                        OR Titulo LIKE '%Vachez Plagnol%'
                        OR Titulo LIKE '%Myriam Vachez%'
                        OR Encabezado LIKE '%Secretaria de Cultura Jalisco%'
                        OR Encabezado LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Encabezado LIKE '%Myriam Vachez Plagnol%'
                        OR Encabezado LIKE '%Vachez Plagnol%'
                        OR Encabezado LIKE '%Myriam Vachez%'
                        OR Autor LIKE '%Secretaria de Cultura Jalisco%'
                        OR Autor LIKE '%Secretaria de Cultura de Jalisco%'
                        OR Autor LIKE '%Myriam Vachez Plagnol%'
                        OR Autor LIKE '%Vachez Plagnol%'
                        OR Autor LIKE '%Myriam Vachez%'
                        OR Texto LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Texto LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Texto LIKE '%Hector Pizano Ramos%'
                        OR Texto LIKE '%Hector Pizano%'
                        OR Texto LIKE '%Pizano Ramos%'
                        OR Titulo LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Titulo LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Titulo LIKE '%Hector Pizano Ramos%'
                        OR Titulo LIKE '%Hector Pizano%'
                        OR Titulo LIKE '%Pizano Ramos%'
                        OR Encabezado LIKE '%secrearia del trabajo y prevision social de jalisco%'
                        OR Encabezado LIKE '%secretaria del trabajo y prevision social del estado de jalisco%'
                        OR Encabezado LIKE '%Hector Pizano Ramos%'
                        OR Encabezado LIKE '%Hector Pizano%'
                        OR Encabezado LIKE '%Pizano Ramos%'
                        OR Texto LIKE '% stps jalisco %'
                        OR Titulo LIKE '% stps jalisco %'
                        OR Encabezado LIKE '% stps jalisco %'
                        OR Autor LIKE '% stps jalisco %'
                        OR Texto LIKE '%secretaria de movilidad de jalisco%'
                        OR Texto LIKE '%Servando Sepulveda Enriquez%'
                        OR Titulo LIKE '%secretaria de movilidad de jalisco%'
                        OR Titulo LIKE '%movilidad jalisco%'
                        OR Titulo LIKE '%secretaria de movilidad jalisco%'
                        OR Titulo LIKE '%Servando Sepulveda Enriquez%'
                        OR Titulo LIKE '%Servando Sepulveda%'
                        OR Titulo LIKE '%Sepulveda Enriquez%'
                        OR Encabezado LIKE '%secretaria de movilidad de jalisco%'
                        OR Encabezado LIKE '%movilidad jalisco%'
                        OR Encabezado LIKE '%secretaria de movilidad jalisco%'
                        OR Encabezado LIKE '%Servando Sepulveda Enriquez%'
                        OR Encabezado LIKE '%Servando Sepulveda%'
                        OR Encabezado LIKE '%Sepulveda Enriquez%'
                        OR Titulo LIKE '%SEMOV%'
                        OR Encabezado LIKE '%SEMOV%'
                        OR Autor LIKE '%SEMOV%'
                        OR Titulo LIKE '% SEMOV %'
                        OR Encabezado LIKE '% SEMOV %'
                        OR Autor LIKE '% SEMOV %'
                        OR Texto LIKE '%secrearia general de jalisco%'
                        OR Texto LIKE '%roberto lopez lara%'
                        OR Titulo LIKE '%secrearia general de jalisco%'
                        OR Titulo LIKE '%secretaria general jalisco%'
                        OR Titulo LIKE '%roberto lopez lara%'
                        OR Titulo LIKE '%chino lopez%'
                        OR Encabezado LIKE '%secrearia general de jalisco%'
                        OR Encabezado LIKE '%secretaria general jalisco%'
                        OR Encabezado LIKE '%roberto lopez lara%'
                        OR Encabezado LIKE '%chino lopez%'
                        OR Texto LIKE '%procuraduria social de jalisco%'
                        OR Texto LIKE '%felicitas velazquez serrano%'
                        OR Titulo LIKE '%procuraduria social de jalisco%'
                        OR Titulo LIKE '%procuraduria social jalisco%'
                        OR Titulo LIKE '%felicitas velazquez serrano%'
                        OR Encabezado LIKE '%procuraduria social de jalisco%'
                        OR Encabezado LIKE '%procuraduria social jalisco%'
                        OR Encabezado LIKE '%felicitas velazquez serrano%'
                        OR Titulo LIKE '%PROSOC%'
                        OR Encabezado LIKE '%PROSOC%'
                        OR Autor LIKE '%PROSOC%'
                        OR Titulo LIKE '% PROSOC %'
                        OR Encabezado LIKE '% PROSOC %'
                        OR Autor LIKE '% PROSOC %'
                        OR Texto LIKE '%despacho del gobernador de jalisco%'
                        OR Texto LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Titulo LIKE '%despacho del gobernador de jalisco%'
                        OR Titulo LIKE '%despacho del gobernador jalisco%'
                        OR Titulo LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Titulo LIKE '%netzahualcoyotl ornelas%'
                        OR Titulo LIKE '%despacho del gobernador de jalisco%'
                        OR Encabezado LIKE '%despacho del gobernador de jalisco%'
                        OR Encabezado LIKE '%despacho del gobernador jalisco%'
                        OR Encabezado LIKE '%netzahualcoyotl ornelas plascencia%'
                        OR Encabezado LIKE '%netzahualcoyotl ornelas%'
                        OR Encabezado LIKE '%despacho del gobernador de jalisco%'
                        OR Texto LIKE '%juan jose bañuelos guardado%'
                        OR Titulo LIKE '%contraloria de jalisco%'
                        OR Titulo LIKE '%juan jose bañuelos guardado%'
                        OR Titulo LIKE '%juan jose bañuelos%'
                        OR Encabezado LIKE '%contraloria de jalisco%'
                        OR Encabezado LIKE '%juan jose bañuelos guardado%'
                        OR Encabezado LIKE '%juan jose bañuelos%')
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 60, 90";

        return $query;
        break;

    case 14: //Jalisco 0-20 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                        Texto like'%Jalisco%' AND Texto NOT like '%Estadio Jalisco%' OR
                        Titulo like'%jalisco%' OR
                        Encabezado like '%Jalisco%'
                       )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 0, 30";

        return $query;
        break;

    case 15: //Jalisco 20-40 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                        Texto like'%Jalisco%' AND Texto NOT like '%Estadio Jalisco%' OR
                        Titulo like'%jalisco%' OR
                        Encabezado like '%Jalisco%'
                       )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 30, 60";

        return $query;
        break;

    case 16: //Jalisco 40-60 Paginas
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM
                  $Tabla n,
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
                  n.Fecha =DATE('$fecha') AND (
                        Texto like'%Jalisco%' AND Texto NOT like '%Estadio Jalisco%' OR
                        Titulo like'%jalisco%' OR
                        Encabezado like '%Jalisco%'
                       )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion
                LIMIT 60, 90";

        return $query;
        break;
    }
}
