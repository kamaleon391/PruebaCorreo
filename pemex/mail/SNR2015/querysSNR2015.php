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
    $fecha        = $Tabla;
    $FechaCliente = strtotime($Tabla);

    $fecha_actual1 = date('Y-m-d');
    $fecha_actual  = strtotime($fecha_actual1);

    if ($fecha == date('Y-m-d')) {
        $Tabla = "noticiasDia";
    } else {
        $Tabla = "noticiasSemana";
    }
    switch ($op) {

    /*****************DF*********************/
    case 1: // PRIMERAS PLANAS
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
                    GROUP BY n.NumeroPagina,p.idPeriodico
                    ORDER BY o.posicion
                    ";
        return $query;
        break;
    case 2: // COLUMNAS POLITICAS
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
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY o.id";
        return $query;
        break;
    case 3: // COLUMNAS FINANCIERAS
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
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico ";
        return $query;
        break;
    case 4: //CARTONES
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
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY o.posicion
                    ";
        return $query;
        break;

    /***************Sonora********************/

    case 5: // PRIMERAS PLANAS SONORA
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
                    e.idEstado = 26 AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(3) AND
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ";
        return $query;
        break;

    case 6: // COLUMNAS DE OPINION SONORA
        $query =
        "SELECT DISTINCT(n.idEditorial),
              n.Periodico as idPeriodico,
              n.idEditorial,
              n.Titulo,
              p.Nombre as Periodico,
              p.String_Name as StringName,
              e.Nombre AS estado,
              CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
              n.PaginaPeriodico,
              s.seccion,
              c.Categoria as Categoria,
              n.Autor,
              n.Texto,
              CONCAT('/var/www/Sistema-de-Captura//Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
              CONCAT('/var/www/Sistema-de-Captura//Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
            seccionesPeriodicos s,
            categoriasPeriodicos c,
            estados e
          WHERE
            p.idPeriodico=n.Periodico AND
            s.idSeccion=n.Seccion AND
            c.idCategoria=n.Categoria AND
            c.idCategoria in(1) AND
            e.idEstado=p.Estado AND
            e.idEstado=26 AND
            n.Fecha=CURDATE()
            GROUP BY n.Periodico,n.NumeroPagina";

        return $query;
        break;

    case 7: // CARTONES DE SONORA :)
        $query = "SELECT DISTINCT(n.idEditorial) , p.Nombre, n.idEditorial,n.Periodico as 'idPeriodico',
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
                    c.idCategoria in(18) AND
                    p.estado=26 AND
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha')
                    GROUP BY n.Periodico,n.NumeroPagina";

        return $query;
        break;

    /***************Querys de Tablero******************/

    case 8: //Claudia Artemisa Pavlovich Arellano
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                        Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
                        Texto like '%Claudia Artemisa Pavlovich%' OR
                        Texto like '%Claudia Pavlovich Arellano%' OR
                        Texto like '%Claudia Pavlovich%' OR
                        Texto like '%Pavlovich Arellano%' OR

                        Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
                        Titulo like '%Claudia Artemisa Pavlovich%' OR
                        Titulo like '%Claudia Pavlovich Arellano%' OR
                        Titulo like '%Claudia Pavlovich%' OR
                        Titulo like '%Pavlovich Arellano%' OR

                        Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
                        Encabezado like '%Claudia Artemisa Pavlovich%' OR
                        Encabezado like '%Claudia Pavlovich Arellano%' OR
                        Encabezado like '%Claudia Pavlovich%' OR
                        Encabezado like '%Pavlovich Arellano%' OR

                        PieFoto like '%Claudia Artemisa Pavlovich Arellano%' OR
                        PieFoto like '%Claudia Artemisa Pavlovich%' OR
                        PieFoto like '%Claudia Pavlovich Arellano%' OR
                        PieFoto like '%Claudia Pavlovich%' OR
                        PieFoto like '%Pavlovich Arellano%' OR

                        Autor like '%Claudia Artemisa Pavlovich Arellano%' OR
                        Autor like '%Claudia Artemisa Pavlovich%' OR
                        Autor like '%Claudia Pavlovich Arellano%' OR
                        Autor like '%Claudia Pavlovich%' OR
                        Autor like '%Pavlovich Arellano%'
                        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;

    case 9: //Gobierno Estatal
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                        Texto like '%Gobierno Sonora%' OR
                        Texto like '%Gobierno de Sonora%' OR
                        Texto like '%Gobierno del estado de Sonora%' OR
                        Texto like '%Guillermo Padres Elias%' OR
                        Texto like '%Guillermo Padres%' OR

                        Titulo like '%Gobierno Sonora%' OR
                        Titulo like '%Gobierno de Sonora%' OR
                        Titulo like '%Gobierno del estado de Sonora%' OR
                        Titulo like '%Guillermo Padres Elias%' OR
                        Titulo like '%Guillermo Padres%' OR

                        Encabezado like '%Gobierno Sonora%' OR
                        Encabezado like '%Gobierno de Sonora%' OR
                        Encabezado like '%Gobierno del estado de Sonora%' OR
                        Encabezado like '%Guillermo Padres Elias%' OR
                        Encabezado like '%Guillermo Padres%' OR

                        PieFoto like '%Gobierno Sonora%' OR
                        PieFoto like '%Gobierno de Sonora%' OR
                        PieFoto like '%Gobierno del estado de Sonora%' OR
                        PieFoto like '%Guillermo Padres Elias%' OR
                        PieFoto like '%Guillermo Padres%' OR

                        Autor like '%Gobierno Sonora%' OR
                        Autor like '%Gobierno de Sonora%' OR
                        Autor like '%Gobierno del estado de Sonora%' OR
                        Autor like '%Guillermo Padres Elias%' OR
                        Autor like '%Guillermo Padres%'
                        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;

    case 10: //Manuel Acosta
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                        Texto like '%Manuel Acosta Gutierrez%' OR
                        Texto like '%Manuel Ignacio Acosta Gutierrez%' OR
                        Texto like '%MALORO%' OR

                        Titulo like '%Manuel Acosta Gutierrez%' OR
                        Titulo like '%Manuel Ignacio Acosta Gutierrez%' OR
                        Titulo like '%MALORO%' OR

                        Encabezado like '%Manuel Acosta Gutierrez%' OR
                        Encabezado like '%Manuel Ignacio Acosta Gutierrez%' OR
                        Encabezado like '%MALORO%' OR

                        Autor like '%Manuel Acosta Gutierrez%' OR
                        Autor like '%Manuel Ignacio Acosta Gutierrez%' OR
                        Autor like '%MALORO%' OR

                        PieFoto like '%Manuel Acosta Gutierrez%' OR
                        PieFoto like '%Manuel Ignacio Acosta Gutierrez%' OR
                        PieFoto like '%MALORO%'

                        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;

    case 11: //Hermosillo
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Hermosillo%' OR

                      Titulo like '%Hermosillo%' OR

                      Encabezado like '%Hermosillo%' OR

                      Autor like '%Hermosillo%' OR

                      PieFoto like '%Hermosillo%'

                      )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;

    case 12: //Varios
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                        Texto like '%Sonora%' OR

                        Titulo like '%Sonora%' OR

                        Encabezado like '%Sonora%' OR

                        PieFoto like '%Sonora%'
                        ) AND
                        (
                        Texto not like '%Calle Sonora%' AND

                        Titulo not like '%Calle Sonora%' AND

                        Encabezado not like '%Calle Sonora%' AND

                        PieFoto not like '%Calle Sonora%'
                        )
                  AND n.PaginaPeriodico IN (1 , 2, 3, 4, 5, 6, 7, 8)
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;

    case 13: //Claudia Artemisa Pavlovich Arellano - Sonora
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = 26 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                        Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
                        Texto like '%Claudia Artemisa Pavlovich%' OR
                        Texto like '%Claudia Pavlovich Arellano%' OR
                        Texto like '%Pavlovich Arellano%' OR

                        Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
                        Titulo like '%Claudia Artemisa Pavlovich%' OR
                        Titulo like '%Claudia Pavlovich Arellano%' OR
                        Titulo like '%Pavlovich Arellano%' OR

                        Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
                        Encabezado like '%Claudia Artemisa Pavlovich%' OR
                        Encabezado like '%Claudia Pavlovich Arellano%' OR
                        Encabezado like '%Pavlovich Arellano%'

                        )
                GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break;

    case 14: //Gobierno Estatal - Sonora
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = 26 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                        Texto like '%Gobierno Sonora%' OR
                        Texto like '%Gobierno de Sonora%' OR
                        Texto like '%Gobierno del estado de Sonora%' OR
                        Texto like '%Guillermo Padres Elias%' OR
                        Texto like '%Guillermo Padres%' OR

                        Titulo like '%Gobierno Sonora%' OR
                        Titulo like '%Gobierno de Sonora%' OR
                        Titulo like '%Gobierno del estado de Sonora%' OR
                        Titulo like '%Guillermo Padres Elias%' OR
                        Titulo like '%Guillermo Padres%' OR

                        Encabezado like '%Gobierno Sonora%' OR
                        Encabezado like '%Gobierno de Sonora%' OR
                        Encabezado like '%Gobierno del estado de Sonora%' OR
                        Encabezado like '%Guillermo Padres Elias%' OR
                        Encabezado like '%Guillermo Padres%' OR

                        PieFoto like '%Gobierno Sonora%' OR
                        PieFoto like '%Gobierno de Sonora%' OR
                        PieFoto like '%Gobierno del estado de Sonora%' OR
                        PieFoto like '%Guillermo Padres Elias%' OR
                        PieFoto like '%Guillermo Padres%' OR

                        Autor like '%Gobierno Sonora%' OR
                        Autor like '%Gobierno de Sonora%' OR
                        Autor like '%Gobierno del estado de Sonora%' OR
                        Autor like '%Guillermo Padres Elias%' OR
                        Autor like '%Guillermo Padres%'
                        )
                GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break;

    case 15: //Manuel Acosta - Sonora
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = 26 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                        Texto like '%Manuel Acosta Gutierrez%' OR
                        Texto like '%Manuel Ignacio Acosta Gutierrez%' OR
                        Texto like '%MALORO%' OR

                        Titulo like '%Manuel Acosta Gutierrez%' OR
                        Titulo like '%Manuel Ignacio Acosta Gutierrez%' OR
                        Titulo like '%MALORO%' OR

                        Encabezado like '%Manuel Acosta Gutierrez%' OR
                        Encabezado like '%Manuel Ignacio Acosta Gutierrez%' OR
                        Encabezado like '%MALORO%' OR

                        Autor like '%Manuel Acosta Gutierrez%' OR
                        Autor like '%Manuel Ignacio Acosta Gutierrez%' OR
                        Autor like '%MALORO%' OR

                        PieFoto like '%Manuel Acosta Gutierrez%' OR
                        PieFoto like '%Manuel Ignacio Acosta Gutierrez%' OR
                        PieFoto like '%MALORO%'

                        )
                GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break;

    case 16: //Hermosillo - Sonora
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = 26 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Hermosillo%' OR

                      Titulo like '%Hermosillo%' OR

                      Encabezado like '%Hermosillo%' OR

                      Autor like '%Hermosillo%' OR

                      PieFoto like '%Hermosillo%'

                      )
                GROUP BY n.Periodico,n.NumeroPagina LIMIT 0,20";
        return $query;
        break;

    case 17: //Varios - Sonora
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = 26 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                        Texto like '%Sonora%' OR

                        Titulo like '%Sonora%' OR

                        Encabezado like '%Sonora%' OR

                        PieFoto like '%Sonora%'
                        ) AND
                        (
                        Texto not like '%Calle Sonora%' AND

                        Titulo not like '%Calle Sonora%' AND

                        Encabezado not like '%Calle Sonora%' AND

                        PieFoto not like '%Calle Sonora%'
                        )
                  AND n.PaginaPeriodico IN (1 , 2, 3, 4, 5, 6, 7, 8)
                GROUP BY n.Periodico,n.NumeroPagina LIMIT 0,20";
        return $query;
        break;

        /*
        case 6: //Información General
        $query = "SELECT n.idEditorial,
        n.Periodico as 'idPeriodico',
        p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
        e.Nombre as 'Estado'
        FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
        WHERE p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        s.idSeccion=n.Seccion AND
        c.idCategoria=n.Categoria AND
        p.estado=e.idEstado AND
        n.Activo=1 AND
        fecha =DATE('$fecha') AND (
        Texto like '%Sonora%' OR
        Texto like '%Hermosillo Sonora%' OR
        Texto like '%Ciudad Obregon%' OR
        Texto like '%Nogales%' OR
        Texto like '%Navajoa%' OR
        Texto like '%Guaymas%' OR
        Texto like '%Caborca%' OR
        Texto like '%Cananea%' OR
        Texto like '%Huatabampo%' OR
        Texto like '% Elecciones%' OR

        Titulo like '%Sonora%' OR
        Titulo like '%Hermosillo Sonora%' OR
        Titulo like '%Ciudad Obregon%' OR
        Titulo like '%Nogales%' OR
        Titulo like '%Navajoa%' OR
        Titulo like '%Guaymas%' OR
        Titulo like '%Caborca%' OR
        Titulo like '%Cananea%' OR
        Titulo like '%Huatabampo%' OR
        Titulo like '% Elecciones%' OR

        Encabezado like '%Sonora%' OR
        Encabezado like '%Hermosillo Sonora%' OR
        Encabezado like '%Ciudad Obregon%' OR
        Encabezado like '%Nogales%' OR
        Encabezado like '%Navajoa%' OR
        Encabezado like '%Guaymas%' OR
        Encabezado like '%Caborca%' OR
        Encabezado like '%Cananea%' OR
        Encabezado like '%Huatabampo%' OR
        Encabezado like '% Elecciones%'
        )
        GROUP BY n.Periodico,n.NumeroPagina
        ORDER BY o.posicion LIMIT 0,20";
        return $query;
        break;

        /***************Estados****************/
/*
case 7: // Gobernador
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Guillermo Padres Elias%' OR
Texto like '%Guillermo Padres%' OR
Texto like '%Padres Elias%' OR

Titulo like '%Guillermo Padres Elias%' OR
Titulo like '%Guillermo Padres%' OR
Titulo like '%Padres Elias%' OR

Encabezado like '%Guillermo Padres Elias%' OR
Encabezado like '%Guillermo Padres%' OR
Encabezado like '%Padres Elias%'

)
GROUP BY n.Periodico,n.NumeroPagina";
return $query;
break;
case 8: //Javier Gandara Magana
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Javier Gandara Magana%' OR
Texto like '%Javier Gandara%' OR
Texto like '%Gandara Magana%' OR

Titulo like '%Javier Gandara Magana%' OR
Titulo like '%Javier Gandara%' OR
Titulo like '%Gandara Magana%' OR

Encabezado like '%Javier Gandara Magana%' OR
Encabezado like '%Javier Gandara%' OR
Encabezado like '%Gandara Magana%' OR

Autor like '%Javier Gandara Magana%' OR
Autor like '%Javier Gandara%' OR
Autor like '%Gandara Magana%' OR

PieFoto like '%Javier Gandara Magana%' OR
PieFoto like '%Javier Gandara%' OR
PieFoto like '%Gandara Magana%'
)
GROUP BY n.Periodico,n.NumeroPagina";
return $query;
break;
case 9: //Claudia Artemisa Pavlovich Arellano
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
Texto like '%Claudia Artemisa Pavlovich%' OR
Texto like '%Claudia Pavlovich Arellano%' OR
Texto like '%Pavlovich Arellano%' OR

Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
Titulo like '%Claudia Artemisa Pavlovich%' OR
Titulo like '%Claudia Pavlovich Arellano%' OR
Titulo like '%Pavlovich Arellano%' OR

Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
Encabezado like '%Claudia Artemisa Pavlovich%' OR
Encabezado like '%Claudia Pavlovich Arellano%' OR
Encabezado like '%Pavlovich Arellano%'

)
GROUP BY n.Periodico,n.NumeroPagina LIMIT 0,20";
return $query;
break;
case 10: //Información General
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Sonora%' OR
Texto like '%Hermosillo Sonora%' OR
Texto like '%Ciudad Obregon%' OR
Texto like '%Nogales%' OR
Texto like '%Navajoa%' OR
Texto like '%Guaymas%' OR
Texto like '%Caborca%' OR
Texto like '%Cananea%' OR
Texto like '%Huatabampo%' OR
Texto like '% Elecciones%' OR

Titulo like '%Sonora%' OR
Titulo like '%Hermosillo Sonora%' OR
Titulo like '%Ciudad Obregon%' OR
Titulo like '%Nogales%' OR
Titulo like '%Navajoa%' OR
Titulo like '%Guaymas%' OR
Titulo like '%Caborca%' OR
Titulo like '%Cananea%' OR
Titulo like '%Huatabampo%' OR
Titulo like '% Elecciones%' OR

Encabezado like '%Sonora%' OR
Encabezado like '%Hermosillo Sonora%' OR
Encabezado like '%Ciudad Obregon%' OR
Encabezado like '%Nogales%' OR
Encabezado like '%Navajoa%' OR
Encabezado like '%Guaymas%' OR
Encabezado like '%Caborca%' OR
Encabezado like '%Cananea%' OR
Encabezado like '%Huatabampo%' OR
Encabezado like '% Elecciones%'
)
GROUP BY n.Periodico,n.NumeroPagina LIMIT 0,20";
return $query;
break;

/*CLAUIDA LIMITES
case 11: //Claudia Artemisa Pavlovich Arellano
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
Texto like '%Claudia Artemisa Pavlovich%' OR
Texto like '%Claudia Pavlovich Arellano%' OR
Texto like '%Pavlovich Arellano%' OR

Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
Titulo like '%Claudia Artemisa Pavlovich%' OR
Titulo like '%Claudia Pavlovich Arellano%' OR
Titulo like '%Pavlovich Arellano%' OR

Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
Encabezado like '%Claudia Artemisa Pavlovich%' OR
Encabezado like '%Claudia Pavlovich Arellano%' OR
Encabezado like '%Pavlovich Arellano%'

)
GROUP BY n.Periodico,n.NumeroPagina LIMIT 20,20";
return $query;
case 12: //Claudia Artemisa Pavlovich Arellano
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
Texto like '%Claudia Artemisa Pavlovich%' OR
Texto like '%Claudia Pavlovich Arellano%' OR
Texto like '%Pavlovich Arellano%' OR

Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
Titulo like '%Claudia Artemisa Pavlovich%' OR
Titulo like '%Claudia Pavlovich Arellano%' OR
Titulo like '%Pavlovich Arellano%' OR

Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
Encabezado like '%Claudia Artemisa Pavlovich%' OR
Encabezado like '%Claudia Pavlovich Arellano%' OR
Encabezado like '%Pavlovich Arellano%'

)
GROUP BY n.Periodico,n.NumeroPagina LIMIT 40,20";
return $query;
case 13: //Claudia Artemisa Pavlovich Arellano
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
Texto like '%Claudia Artemisa Pavlovich%' OR
Texto like '%Claudia Pavlovich Arellano%' OR
Texto like '%Pavlovich Arellano%' OR

Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
Titulo like '%Claudia Artemisa Pavlovich%' OR
Titulo like '%Claudia Pavlovich Arellano%' OR
Titulo like '%Pavlovich Arellano%' OR

Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
Encabezado like '%Claudia Artemisa Pavlovich%' OR
Encabezado like '%Claudia Pavlovich Arellano%' OR
Encabezado like '%Pavlovich Arellano%'

)
GROUP BY n.Periodico,n.NumeroPagina LIMIT 60,20";
return $query;
case 14: //Claudia Artemisa Pavlovich Arellano
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
Texto like '%Claudia Artemisa Pavlovich%' OR
Texto like '%Claudia Pavlovich Arellano%' OR
Texto like '%Pavlovich Arellano%' OR

Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
Titulo like '%Claudia Artemisa Pavlovich%' OR
Titulo like '%Claudia Pavlovich Arellano%' OR
Titulo like '%Pavlovich Arellano%' OR

Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
Encabezado like '%Claudia Artemisa Pavlovich%' OR
Encabezado like '%Claudia Pavlovich Arellano%' OR
Encabezado like '%Pavlovich Arellano%'

)
GROUP BY n.Periodico,n.NumeroPagina LIMIT 80,20";
return $query;
break;

case 15: //Javier Lamarque Cano - DF
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Javier Lamarque Cano%' OR
Texto like '%Javier Lamarque%' OR
Texto like '%Lamarque Cano%' OR

Titulo like '%Javier Lamarque Cano%' OR
Titulo like '%Javier Lamarque%' OR
Titulo like '%Lamarque Cano%' OR

Encabezado like '%Javier Lamarque Cano%' OR
Encabezado like '%Javier Lamarque%' OR
Encabezado like '%Lamarque Cano%' OR

PieFoto like '%Javier Lamarque Cano%' OR
PieFoto like '%Javier Lamarque%' OR
PieFoto like '%Lamarque Cano%' OR

Autor like '%Javier Lamarque Cano%' OR
Autor like '%Javier Lamarque%' OR
Autor like '%Lamarque Cano%'
)
GROUP BY n.Periodico,n.NumeroPagina
ORDER BY o.posicion";
return $query;
break;

case 16: //Javier Lamarque Cano - Estados
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.estado<>9 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Javier Lamarque Cano%' OR
Texto like '%Javier Lamarque%' OR
Texto like '%Lamarque Cano%' OR

Titulo like '%Javier Lamarque Cano%' OR
Titulo like '%Javier Lamarque%' OR
Titulo like '%Lamarque Cano%' OR

Encabezado like '%Javier Lamarque Cano%' OR
Encabezado like '%Javier Lamarque%' OR
Encabezado like '%Lamarque Cano%' OR

PieFoto like '%Javier Lamarque Cano%' OR
PieFoto like '%Javier Lamarque%' OR
PieFoto like '%Lamarque Cano%' OR

Autor like '%Javier Lamarque Cano%' OR
Autor like '%Javier Lamarque%' OR
Autor like '%Lamarque Cano%'
)
GROUP BY n.Periodico,n.NumeroPagina";
return $query;
break;

case 17: //Sonora - DF
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
s.idSeccion=n.Seccion AND
n.Seccion NOT IN (11,22, 29, 41) AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
n.Activo=1 AND
fecha =DATE('$fecha') AND  (
Texto like '%Sonora%' OR

Titulo like '%Sonora%' OR

Encabezado like '%Sonora%' OR

PieFoto like '%Sonora%'
) AND
(
Texto not like '%Calle Sonora%' AND

Titulo not like '%Calle Sonora%' AND

Encabezado not like '%Calle Sonora%' AND

PieFoto not like '%Calle Sonora%'
) AND n.PaginaPeriodico IN (1,2,3,4,5,6,7,8)
GROUP BY n.Periodico,n.NumeroPagina
ORDER BY o.posicion";
return $query;
break;

case 18: //Claudia Artemisa Pavlovich Arellano - Sonora
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
n.Seccion NOT IN (22, 29) AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
p.Estado = 26 AND
n.Categoria NOT IN (80,98) AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
Texto like '%Claudia Artemisa Pavlovich%' OR
Texto like '%Claudia Pavlovich Arellano%' OR
Texto like '%Pavlovich Arellano%' OR

Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
Titulo like '%Claudia Artemisa Pavlovich%' OR
Titulo like '%Claudia Pavlovich Arellano%' OR
Titulo like '%Pavlovich Arellano%' OR

Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
Encabezado like '%Claudia Artemisa Pavlovich%' OR
Encabezado like '%Claudia Pavlovich Arellano%' OR
Encabezado like '%Pavlovich Arellano%'

)
GROUP BY n.Periodico,n.NumeroPagina LIMIT 0,20";
return $query;
break;

case 19: // Sonora - Sonora
$query = "SELECT DISTINCT(n.idEditorial),
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
n.Seccion NOT IN (11,22, 29, 41) AND
c.idCategoria=n.Categoria AND
p.Estado=e.idEstado AND
p.Estado = 26 AND
n.Categoria <> 80 AND
n.Activo=1 AND
fecha =DATE('$fecha') AND  (
Texto like '%Sonora%' OR

Titulo like '%Sonora%' OR

Encabezado like '%Sonora%' OR

PieFoto like '%Sonora%'
) AND
(
Texto not like '%Calle Sonora%' AND

Titulo not like '%Calle Sonora%' AND

Encabezado not like '%Calle Sonora%' AND

PieFoto not like '%Calle Sonora%'
) AND n.PaginaPeriodico IN (1,2,3,4,5,6,7,8)
GROUP BY n.Periodico,n.NumeroPagina
ORDER BY p.Estado, p.Nombre";
return $query;
break;

case 3: // Gobernador
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Guillermo Padres Elias%' OR
Texto like '%Guillermo Padres%' OR
Texto like '%Padres Elias%' OR

Titulo like '%Guillermo Padres Elias%' OR
Titulo like '%Guillermo Padres%' OR
Titulo like '%Padres Elias%' OR

Encabezado like '%Guillermo Padres Elias%' OR
Encabezado like '%Guillermo Padres%' OR
Encabezado like '%Padres Elias%'

)
GROUP BY n.Periodico,n.NumeroPagina
ORDER BY o.posicion";
return $query;
break;
case 4: //Javier Gandara Magana
$query = "SELECT n.idEditorial,
n.Periodico as 'idPeriodico',
p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
e.Nombre as 'Estado'
FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
WHERE p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
p.estado=e.idEstado AND
n.Activo=1 AND
fecha =DATE('$fecha') AND (
Texto like '%Javier Gandara Magana%' OR
Texto like '%Javier Gandara%' OR
Texto like '%Gandara Magana%' OR

Titulo like '%Javier Gandara Magana%' OR
Titulo like '%Javier Gandara%' OR
Titulo like '%Gandara Magana%' OR

Encabezado like '%Javier Gandara Magana%' OR
Encabezado like '%Javier Gandara%' OR
Encabezado like '%Gandara Magana%' OR

Autor like '%Javier Gandara Magana%' OR
Autor like '%Javier Gandara%' OR
Autor like '%Gandara Magana%' OR

PieFoto like '%Javier Gandara Magana%' OR
PieFoto like '%Javier Gandara%' OR
PieFoto like '%Gandara Magana%'
)
GROUP BY n.Periodico,n.NumeroPagina
ORDER BY o.posicion";
return $query;
break;

default:
break;
 */
    }
}
