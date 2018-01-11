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

function query($op, $Tabla, $estado)
{
    $fecha = $Tabla;
    $FechaCliente = strtotime($Tabla);

    $fecha_actual1 = date('Y-m-d');
    $fecha_actual = strtotime($fecha_actual1);

    if ($fecha == date('Y-m-d')) {
        $Tabla = "noticiasDia";
    } else {
        $Tabla = "noticiasSemana";
    }
    switch ($op) {

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
                    GROUP BY n.Periodico,n.NumeroPagina  
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
                    GROUP BY n.Periodico,n.NumeroPagina  ";
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
                    GROUP BY n.Periodico,n.NumeroPagina  
                    ORDER BY o.posicion
                    ";
            return $query;
            break;

        /*****************DF*********************/

        case 5: //Manuel Mondragon y Kalb
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Manuel Mondragon y Kalb%' OR
                      Texto like '%Mondragon y Kalb%' OR
                      Texto like '%Manuel Mondragon%' OR

                      Titulo like '%Manuel Mondragon y Kalb%' OR
                      Titulo like '%Mondragon y Kalb%' OR
                      Titulo like '%Manuel Mondragon%' OR

                      Encabezado like '%Manuel Mondragon y Kalb%' OR
                      Encabezado like '%Mondragon y Kalb%' OR
                      Encabezado like '%Manuel Mondragon%' OR

                      Autor like '%Manuel Mondragon y Kalb%' OR
                      Autor like '%Mondragon y Kalb%' OR
                      Autor like '%Manuel Mondragon%' OR

                      PieFoto like '%Manuel Mondragon y Kalb%' OR
                      PieFoto like '%Mondragon y Kalb%' OR
                      PieFoto like '%Manuel Mondragon%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 6: //CONADIC
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
                   fecha =DATE('$fecha') AND  (
                        Texto like '%Comision Nacional contra las Adicciones%' OR
                        Texto like '% Conadic %' OR
                        Texto like '%(Conadic)%' OR

                        Titulo like '%Comision Nacional contra las Adicciones%' OR
                        Titulo like '% Conadic %' OR
                        Titulo like '%(Conadic)%' OR

                        Encabezado like '%Comision Nacional contra las Adicciones%' OR
                        Encabezado like '% Conadic %' OR
                        Encabezado like '%(Conadic)%' OR

                        Autor like '%Comision Nacional contra las Adicciones%' OR
                        Autor like '% Conadic %' OR
                        Autor like '%(Conadic)%' OR

                        PieFoto like '%Comision Nacional contra las Adicciones%' OR
                        PieFoto like '% Conadic %' OR
                        PieFoto like '%(Conadic)%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 7: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Mariguana%' OR
                      Texto like '%Marihuana%' OR
                      Texto like '%Cannabis%' OR

                      Titulo like '%Mariguana%' OR
                      Titulo like '%Marihuana%' OR
                      Titulo like '%Cannabis%' OR

                      Encabezado like '%Mariguana%' OR
                      Encabezado like '%Marihuana%' OR
                      Encabezado like '%Cannabis%' OR

                      Autor like '%Mariguana%' OR
                      Autor like '%Marihuana%' OR
                      Autor like '%Cannabis%' OR

                      PieFoto like '%Mariguana%' OR
                      PieFoto like '%Marihuana%' OR
                      PieFoto like '%Cannabis%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 8: //Gobernador
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
                      Texto like '%Tabaco%' OR
                      Texto like '%Nicotina%' OR
                      Texto like '%Cigarro%' OR
                      Texto like '%Cigarrillo%' OR
                      Texto like '%Tabaquismo%' OR

                      Titulo like '%Tabaco%' OR
                      Titulo like '%Nicotina%' OR
                      Titulo like '%Cigarro%' OR
                      Titulo like '%Cigarrillo%' OR
                      Titulo like '%Tabaquismo%' OR

                      Encabezado like '%Tabaco%' OR
                      Encabezado like '%Nicotina%' OR
                      Encabezado like '%Cigarro%' OR
                      Encabezado like '%Cigarrillo%' OR
                      Encabezado like '%Tabaquismo%' OR

                      Autor like '%Tabaco%' OR
                      Autor like '%Nicotina%' OR
                      Autor like '%Cigarro%' OR
                      Autor like '%Cigarrillo%' OR
                      Autor like '%Tabaquismo%' OR

                      PieFoto like '%Tabaco%' OR
                      PieFoto like '%Nicotina%' OR
                      PieFoto like '%Cigarro%' OR
                      PieFoto like '%Cigarrillo%' OR
                      PieFoto like '%Tabaquismo%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 9: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Alcohol%' OR
                      Texto like '%Bebida alcoholica%' OR
                      Texto like '%Bebidas alcoholicas%' OR
                      Texto like '%Alcoholismo%' OR

                      Titulo like '%Alcohol%' OR
                      Titulo like '%Bebida alcoholica%' OR
                      Titulo like '%Bebidas alcoholicas%' OR
                      Titulo like '%Alcoholismo%' OR

                      Encabezado like '%Alcohol%' OR
                      Encabezado like '%Bebida alcoholica%' OR
                      Encabezado like '%Bebidas alcoholicas%' OR
                      Encabezado like '%Alcoholismo%' OR

                      Autor like '%Alcohol%' OR
                      Autor like '%Bebida alcoholica%' OR
                      Autor like '%Bebidas alcoholicas%' OR
                      Autor like '%Alcoholismo%' OR

                      PieFoto like '%Alcohol%' OR
                      PieFoto like '%Bebida alcoholica%' OR
                      PieFoto like '%Bebidas alcoholicas%' OR
                      PieFoto like '%Alcoholismo%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 10: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Droga%' OR
                      Texto like '%Marihuana%' OR
                      Texto like '%Cocaina%' OR
                      Texto like '%Anfetaminas%' OR
                      Texto like '%Extasis%' OR
                      Texto like '%Heroina%' OR
                      Texto like '% LSD %' OR
                      Texto like '%adiccion a las drogas%' OR
                      Texto like '%adicciones a sustancias%' OR
                      Texto like '%drogadiccion%' OR

                      Titulo like '%Droga%' OR
                      Titulo like '%Marihuana%' OR
                      Titulo like '%Cocaina%' OR
                      Titulo like '%Anfetaminas%' OR
                      Titulo like '%Extasis%' OR
                      Titulo like '%Heroina%' OR
                      Titulo like '% LSD %' OR
                      Titulo like '%adiccion a las drogas%' OR
                      Titulo like '%adicciones a sustancias%' OR
                      Titulo like '%drogadiccion%' OR

                      Encabezado like '%Droga%' OR
                      Encabezado like '%Marihuana%' OR
                      Encabezado like '%Cocaina%' OR
                      Encabezado like '%Anfetaminas%' OR
                      Encabezado like '%Extasis%' OR
                      Encabezado like '%Heroina%' OR
                      Encabezado like '% LSD %' OR
                      Encabezado like '%adiccion a las drogas%' OR
                      Encabezado like '%adicciones a sustancias%' OR
                      Encabezado like '%drogadiccion%' OR

                      Autor like '%Droga%' OR
                      Autor like '%Marihuana%' OR
                      Autor like '%Cocaina%' OR
                      Autor like '%Anfetaminas%' OR
                      Autor like '%Extasis%' OR
                      Autor like '%Heroina%' OR
                      Autor like '% LSD %' OR
                      Autor like '%adiccion a las drogas%' OR
                      Autor like '%adicciones a sustancias%' OR
                      Autor like '%drogadiccion%' OR

                      PieFoto like '%Droga%' OR
                      PieFoto like '%Marihuana%' OR
                      PieFoto like '%Cocaina%' OR
                      PieFoto like '%Anfetaminas%' OR
                      PieFoto like '%Extasis%' OR
                      PieFoto like '%Heroina%' OR
                      PieFoto like '% LSD %' OR
                      PieFoto like '%adiccion a las drogas%' OR
                      PieFoto like '%adicciones a sustancias%' OR
                      PieFoto like '%drogadiccion%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 11: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Secretaria de Salud%' OR
                      Texto like '%SSA%' OR

                      Titulo like '%Secretaria de Salud%' OR
                      Titulo like '%SSA%' OR

                      Encabezado like '%Secretaria de Salud%' OR
                      Encabezado like '%SSA%' OR

                      Autor like '%Secretaria de Salud%' OR
                      Autor like '%SSA%' OR

                      PieFoto like '%Secretaria de Salud%' OR
                      PieFoto like '%SSA%' 
                  ) AND (
                    Texto not like '%Mossa%' AND
                    Texto not like '%Assange%' AND
                    Texto not like '%Nissan%' AND
                    Texto not like '%Renaissance%' AND
                    Texto not like '%Melissa%' AND
                    Texto not like '%Issa%' AND
                    Texto not like '%Vanessa%' AND
                    Texto not like '%CervantesSainz%' AND
                    Texto not like '%quienessaben %' AND
                    Texto not like '%LariSSA%' AND
                    Texto not like '%Massachusetts%' AND
                    Texto not like '%DaruSSAlam%' AND
                    Texto not like '%Assad%' AND
                    Texto not like '%CouSSA%' AND
                    Texto not like '%croiSSAnt%' AND
                    Texto not like '%EliSSA%' AND
                    Texto not like '%MauSSAn%' AND
                    Texto not like '%OtateSSAuz%' AND
                    Texto not like '%CariSSA%' AND
                    Texto not like '%Moressanchez%' AND
                    Texto not like '%Passat%' AND
                    Texto not like '%Issac%' AND
                    Texto not like '%Fassa%' AND
                    Texto not like '%IMSSA%' AND

                    Titulo not like '%Mossa%' AND
                    Titulo not like '%Assange%' AND
                    Titulo not like '%Nissan%' AND
                    Titulo not like '%Renaissance%' AND
                    Titulo not like '%Melissa%' AND
                    Titulo not like '%Issa%' AND
                    Titulo not like '%Vanessa%' AND
                    Titulo not like '%CervantesSainz%' AND
                    Titulo not like '%quienessaben %' AND
                    Titulo not like '%LariSSA%' AND
                    Titulo not like '%Massachusetts%' AND
                    Titulo not like '%DaruSSAlam%' AND
                    Titulo not like '%Assad%' AND
                    Titulo not like '%CouSSA%' AND
                    Titulo not like '%croiSSAnt%' AND
                    Titulo not like '%EliSSA%' AND
                    Titulo not like '%MauSSAn%' AND
                    Titulo not like '%OtateSSAuz%' AND
                    Titulo not like '%CariSSA%' AND
                    Titulo not like '%Moressanchez%' AND
                    Titulo not like '%Passat%' AND
                    Titulo not like '%Issac%' AND
                    Titulo not like '%Fassa%' AND
                    Titulo not like '%IMSSA%' AND

                    Encabezado not like '%Mossa%' AND
                    Encabezado not like '%Assange%' AND
                    Encabezado not like '%Nissan%' AND
                    Encabezado not like '%Renaissance%' AND
                    Encabezado not like '%Melissa%' AND
                    Encabezado not like '%Issa%' AND
                    Encabezado not like '%Vanessa%' AND
                    Encabezado not like '%CervantesSainz%' AND
                    Encabezado not like '%quienessaben %' AND
                    Encabezado not like '%LariSSA%' AND
                    Encabezado not like '%Massachusetts%' AND
                    Encabezado not like '%DaruSSAlam%' AND
                    Encabezado not like '%Assad%' AND
                    Encabezado not like '%CouSSA%' AND
                    Encabezado not like '%croiSSAnt%' AND
                    Encabezado not like '%EliSSA%' AND
                    Encabezado not like '%MauSSAn%' AND
                    Encabezado not like '%OtateSSAuz%' AND
                    Encabezado not like '%CariSSA%' AND
                    Encabezado not like '%Moressanchez%' AND
                    Encabezado not like '%Passat%' AND
                    Encabezado not like '%Issac%' AND
                    Encabezado not like '%Fassa%' AND
                    Encabezado not like '%IMSSA%' AND

                    Autor not like '%Mossa%' AND
                    Autor not like '%Assange%' AND
                    Autor not like '%Nissan%' AND
                    Autor not like '%Renaissance%' AND
                    Autor not like '%Melissa%' AND
                    Autor not like '%Issa%' AND
                    Autor not like '%Vanessa%' AND
                    Autor not like '%CervantesSainz%' AND
                    Autor not like '%quienessaben %' AND
                    Autor not like '%LariSSA%' AND
                    Autor not like '%Massachusetts%' AND
                    Autor not like '%DaruSSAlam%' AND
                    Autor not like '%Assad%' AND
                    Autor not like '%CouSSA%' AND
                    Autor not like '%croiSSAnt%' AND
                    Autor not like '%EliSSA%' AND
                    Autor not like '%MauSSAn%' AND
                    Autor not like '%OtateSSAuz%' AND
                    Autor not like '%CariSSA%' AND
                    Autor not like '%Moressanchez%' AND
                    Autor not like '%Passat%' AND
                    Autor not like '%Issac%' AND
                    Autor not like '%Fassa%' AND
                    Autor not like '%IMSSA%' AND

                    PieFoto not like '%Mossa%' AND
                    PieFoto not like '%Assange%' AND
                    PieFoto not like '%Nissan%' AND
                    PieFoto not like '%Renaissance%' AND
                    PieFoto not like '%Melissa%' AND
                    PieFoto not like '%Issa%' AND
                    PieFoto not like '%Vanessa%' AND
                    PieFoto not like '%CervantesSainz%' AND
                    PieFoto not like '%quienessaben %' AND
                    PieFoto not like '%LariSSA%' AND
                    PieFoto not like '%Massachusetts%' AND
                    PieFoto not like '%DaruSSAlam%' AND
                    PieFoto not like '%Assad%' AND
                    PieFoto not like '%CouSSA%' AND
                    PieFoto not like '%croiSSAnt%' AND
                    PieFoto not like '%EliSSA%' AND
                    PieFoto not like '%MauSSAn%' AND
                    PieFoto not like '%OtateSSAuz%' AND
                    PieFoto not like '%CariSSA%' AND
                    PieFoto not like '%Moressanchez%' AND
                    PieFoto not like '%Passat%' AND
                    PieFoto not like '%Issac%' AND
                    PieFoto not like '%Fassa%' AND
                    PieFoto not like '%IMSSA%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 12: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Mercedes Juan Lopez%' OR
                      Texto like '%Mercedes Juan%' OR

                      Titulo like '%Mercedes Juan Lopez%' OR
                      Titulo like '%Mercedes Juan%' OR

                      Encabezado like '%Mercedes Juan Lopez%' OR
                      Encabezado like '%Mercedes Juan%' OR

                      Autor like '%Mercedes Juan Lopez%' OR
                      Autor like '%Mercedes Juan%' OR

                      PieFoto like '%Mercedes Juan Lopez%' OR
                      PieFoto like '%Mercedes Juan%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 13: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%COFEPRIS%' OR
                      Texto like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' OR

                      Titulo like '%COFEPRIS%' OR
                      Titulo like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' OR

                      Encabezado like '%COFEPRIS%' OR
                      Encabezado like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' OR

                      Autor like '%COFEPRIS%' OR
                      Autor like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' OR

                      PieFoto like '%COFEPRIS%' OR
                      PieFoto like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 14: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Centros de Integracion Juvenil%' OR
                      Texto like '% CIJ %' OR
                      Texto like '%(CIJ)%' OR

                      Titulo like '%Centros de Integracion Juvenil%' OR
                      Titulo like '% CIJ %' OR
                      Titulo like '%(CIJ)%' OR

                      Encabezado like '%Centros de Integracion Juvenil%' OR
                      Encabezado like '% CIJ %' OR
                      Encabezado like '%(CIJ)%' OR

                      Autor like '%Centros de Integracion Juvenil%' OR
                      Autor like '% CIJ %' OR
                      Autor like '%(CIJ)%' OR

                      PieFoto like '%Centros de Integracion Juvenil%' OR
                      PieFoto like '% CIJ %' OR
                      PieFoto like '%(CIJ)%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 15: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Enrique peña nieto%' OR
                      Texto like '%Presidente Peña%' OR
                      Texto like '%Peña Nieto%' OR
                      Texto like '% EPN %' OR
                      Texto like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Texto like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Texto like '%@EPN%' OR
                      Texto like '%Quique Peña%' OR

                      Titulo like '%Enrique peña nieto%' OR
                      Titulo like '%Presidente Peña%' OR
                      Titulo like '%Peña Nieto%' OR
                      Titulo like '% EPN %' OR
                      Titulo like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Titulo like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Titulo like '%@EPN%' OR
                      Titulo like '%Quique Peña%' OR

                      Encabezado like '%Enrique peña nieto%' OR
                      Encabezado like '%Presidente Peña%' OR
                      Encabezado like '%Peña Nieto%' OR
                      Encabezado like '% EPN %' OR
                      Encabezado like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Encabezado like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Encabezado like '%@EPN%' OR
                      Encabezado like '%Quique Peña%' OR

                      Autor like '%Enrique peña nieto%' OR
                      Autor like '%Presidente Peña%' OR
                      Autor like '%Peña Nieto%' OR
                      Autor like '% EPN %' OR
                      Autor like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Autor like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Autor like '%@EPN%' OR
                      Autor like '%Quique Peña%' OR

                      PieFoto like '%Enrique peña nieto%' OR
                      PieFoto like '%Presidente Peña%' OR
                      PieFoto like '%Peña Nieto%' OR
                      PieFoto like '% EPN %' OR
                      PieFoto like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      PieFoto like '%Senor Licenciado Enrique Peña Nieto%' OR
                      PieFoto like '%@EPN%' OR
                      PieFoto like '%Quique Peña%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 16: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Gobierno de la Republica%' OR
                      Texto like '%Presidencia de la Republica%' OR
                      
                      Titulo like '%Gobierno de la Republica%' OR
                      Titulo like '%Presidencia de la Republica%' OR
                      
                      Encabezado like '%Gobierno de la Republica%' OR
                      Encabezado like '%Presidencia de la Republica%' OR
                      
                      Autor like '%Gobierno de la Republica%' OR
                      Autor like '%Presidencia de la Republica%' OR
                      
                      PieFoto like '%Gobierno de la Republica%' OR
                      PieFoto like '%Presidencia de la Republica%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 17: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Camara de Diputados%' OR
                      Texto like '%Diputado%' OR
                      Texto like '%Diputada%' OR
                      
                      Titulo like '%Camara de Diputados%' OR
                      Titulo like '%Diputado%' OR
                      Titulo like '%Diputada%' OR
                      
                      Encabezado like '%Camara de Diputados%' OR
                      Encabezado like '%Diputado%' OR
                      Encabezado like '%Diputada%' OR
                      
                      Autor like '%Camara de Diputados%' OR
                      Autor like '%Diputado%' OR
                      Autor like '%Diputada%' OR
                      
                      PieFoto like '%Camara de Diputados%' OR
                      PieFoto like '%Diputado%' OR
                      PieFoto like '%Diputada%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 18: //Gobernador
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
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Camara de Senadores%' OR
                      Texto like '%Senador%' OR
                      Texto like '%Senadora%' OR
                      
                      Titulo like '%Camara de Senadores%' OR
                      Titulo like '%Senador%' OR
                      Titulo like '%Senadora%' OR
                      
                      Encabezado like '%Camara de Senadores%' OR
                      Encabezado like '%Senador%' OR
                      Encabezado like '%Senadora%' OR
                      
                      Autor like '%Camara de Senadores%' OR
                      Autor like '%Senador%' OR
                      Autor like '%Senadora%' OR
                      
                      PieFoto like '%Camara de Senadores%' OR
                      PieFoto like '%Senador%' OR
                      PieFoto like '%Senadora%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        /***************Querys de Tablero Oaxaca******************/

        /****************** Querys Estados ************************/

        case 19: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Manuel Mondragon y Kalb%' OR
                      Texto like '%Mondragon y Kalb%' OR
                      Texto like '%Manuel Mondragon%' OR

                      Titulo like '%Manuel Mondragon y Kalb%' OR
                      Titulo like '%Mondragon y Kalb%' OR
                      Titulo like '%Manuel Mondragon%' OR

                      Encabezado like '%Manuel Mondragon y Kalb%' OR
                      Encabezado like '%Mondragon y Kalb%' OR
                      Encabezado like '%Manuel Mondragon%' OR

                      Autor like '%Manuel Mondragon y Kalb%' OR
                      Autor like '%Mondragon y Kalb%' OR
                      Autor like '%Manuel Mondragon%' OR

                      PieFoto like '%Manuel Mondragon y Kalb%' OR
                      PieFoto like '%Mondragon y Kalb%' OR
                      PieFoto like '%Manuel Mondragon%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 20: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Comision Nacional contra las Adicciones%' OR
                      Texto like '% Conadic %' OR
                      Texto like '%(Conadic)%' OR

                      Titulo like '%Comision Nacional contra las Adicciones%' OR
                      Titulo like '% Conadic %' OR
                      Titulo like '%(Conadic)%' OR

                      Encabezado like '%Comision Nacional contra las Adicciones%' OR
                      Encabezado like '% Conadic %' OR
                      Encabezado like '%(Conadic)%' OR

                      Autor like '%Comision Nacional contra las Adicciones%' OR
                      Autor like '% Conadic %' OR
                      Autor like '%(Conadic)%' OR

                      PieFoto like '%Comision Nacional contra las Adicciones%' OR
                      PieFoto like '% Conadic %' OR
                      PieFoto like '%(Conadic)%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 21: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Mariguana%' OR
                      Texto like '%Marihuana%' OR
                      Texto like '%Cannabis%' OR

                      Titulo like '%Mariguana%' OR
                      Titulo like '%Marihuana%' OR
                      Titulo like '%Cannabis%' OR

                      Encabezado like '%Mariguana%' OR
                      Encabezado like '%Marihuana%' OR
                      Encabezado like '%Cannabis%' OR

                      Autor like '%Mariguana%' OR
                      Autor like '%Marihuana%' OR
                      Autor like '%Cannabis%' OR

                      PieFoto like '%Mariguana%' OR
                      PieFoto like '%Marihuana%' OR
                      PieFoto like '%Cannabis%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 22: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Tabaco%' OR
                      Texto like '%Nicotina%' OR
                      Texto like '%Cigarro%' OR
                      Texto like '%Cigarrillo%' OR
                      Texto like '%Tabaquismo%' OR

                      Titulo like '%Tabaco%' OR
                      Titulo like '%Nicotina%' OR
                      Titulo like '%Cigarro%' OR
                      Titulo like '%Cigarrillo%' OR
                      Titulo like '%Tabaquismo%' OR

                      Encabezado like '%Tabaco%' OR
                      Encabezado like '%Nicotina%' OR
                      Encabezado like '%Cigarro%' OR
                      Encabezado like '%Cigarrillo%' OR
                      Encabezado like '%Tabaquismo%' OR

                      Autor like '%Tabaco%' OR
                      Autor like '%Nicotina%' OR
                      Autor like '%Cigarro%' OR
                      Autor like '%Cigarrillo%' OR
                      Autor like '%Tabaquismo%' OR

                      PieFoto like '%Tabaco%' OR
                      PieFoto like '%Nicotina%' OR
                      PieFoto like '%Cigarro%' OR
                      PieFoto like '%Cigarrillo%' OR
                      PieFoto like '%Tabaquismo%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 23: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Alcohol%' OR
                      Texto like '%Bebida alcoholica%' OR
                      Texto like '%Bebidas alcoholicas%' OR
                      Texto like '%Alcoholismo%' OR

                      Titulo like '%Alcohol%' OR
                      Titulo like '%Bebida alcoholica%' OR
                      Titulo like '%Bebidas alcoholicas%' OR
                      Titulo like '%Alcoholismo%' OR

                      Encabezado like '%Alcohol%' OR
                      Encabezado like '%Bebida alcoholica%' OR
                      Encabezado like '%Bebidas alcoholicas%' OR
                      Encabezado like '%Alcoholismo%' OR

                      Autor like '%Alcohol%' OR
                      Autor like '%Bebida alcoholica%' OR
                      Autor like '%Bebidas alcoholicas%' OR
                      Autor like '%Alcoholismo%' OR

                      PieFoto like '%Alcohol%' OR
                      PieFoto like '%Bebida alcoholica%' OR
                      PieFoto like '%Bebidas alcoholicas%' OR
                      PieFoto like '%Alcoholismo%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 24: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Droga%' OR
                      Texto like '%Marihuana%' OR
                      Texto like '%Cocaina%' OR
                      Texto like '%Anfetaminas%' OR
                      Texto like '%Extasis%' OR
                      Texto like '%Heroina%' OR
                      Texto like '% LSD %' OR
                      Texto like '%adiccion a las drogas%' OR
                      Texto like '%adicciones a sustancias%' OR
                      Texto like '%drogadiccion%' OR

                      Titulo like '%Droga%' OR
                      Titulo like '%Marihuana%' OR
                      Titulo like '%Cocaina%' OR
                      Titulo like '%Anfetaminas%' OR
                      Titulo like '%Extasis%' OR
                      Titulo like '%Heroina%' OR
                      Titulo like '% LSD %' OR
                      Titulo like '%adiccion a las drogas%' OR
                      Titulo like '%adicciones a sustancias%' OR
                      Titulo like '%drogadiccion%' OR

                      Encabezado like '%Droga%' OR
                      Encabezado like '%Marihuana%' OR
                      Encabezado like '%Cocaina%' OR
                      Encabezado like '%Anfetaminas%' OR
                      Encabezado like '%Extasis%' OR
                      Encabezado like '%Heroina%' OR
                      Encabezado like '% LSD %' OR
                      Encabezado like '%adiccion a las drogas%' OR
                      Encabezado like '%adicciones a sustancias%' OR
                      Encabezado like '%drogadiccion%' OR

                      Autor like '%Droga%' OR
                      Autor like '%Marihuana%' OR
                      Autor like '%Cocaina%' OR
                      Autor like '%Anfetaminas%' OR
                      Autor like '%Extasis%' OR
                      Autor like '%Heroina%' OR
                      Autor like '% LSD %' OR
                      Autor like '%adiccion a las drogas%' OR
                      Autor like '%adicciones a sustancias%' OR
                      Autor like '%drogadiccion%' OR

                      PieFoto like '%Droga%' OR
                      PieFoto like '%Marihuana%' OR
                      PieFoto like '%Cocaina%' OR
                      PieFoto like '%Anfetaminas%' OR
                      PieFoto like '%Extasis%' OR
                      PieFoto like '%Heroina%' OR
                      PieFoto like '% LSD %' OR
                      PieFoto like '%adiccion a las drogas%' OR
                      PieFoto like '%adicciones a sustancias%' OR
                      PieFoto like '%drogadiccion%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 25: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Secretaria de Salud%' OR
                      Texto like '%SSA%' OR

                      Titulo like '%Secretaria de Salud%' OR
                      Titulo like '%SSA%' OR

                      Encabezado like '%Secretaria de Salud%' OR
                      Encabezado like '%SSA%' OR

                      Autor like '%Secretaria de Salud%' OR
                      Autor like '%SSA%' OR

                      PieFoto like '%Secretaria de Salud%' OR
                      PieFoto like '%SSA%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 26: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Mercedes Juan Lopez%' OR
                      Texto like '%Mercedes Juan%' OR

                      Titulo like '%Mercedes Juan Lopez%' OR
                      Titulo like '%Mercedes Juan%' OR

                      Encabezado like '%Mercedes Juan Lopez%' OR
                      Encabezado like '%Mercedes Juan%' OR

                      Autor like '%Mercedes Juan Lopez%' OR
                      Autor like '%Mercedes Juan%' OR

                      PieFoto like '%Mercedes Juan Lopez%' OR
                      PieFoto like '%Mercedes Juan%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 27: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%COFEPRIS%' OR
                      Texto like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' OR

                      Titulo like '%COFEPRIS%' OR
                      Titulo like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' OR

                      Encabezado like '%COFEPRIS%' OR
                      Encabezado like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' OR

                      Autor like '%COFEPRIS%' OR
                      Autor like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' OR

                      PieFoto like '%COFEPRIS%' OR
                      PieFoto like '%Comision Federal para la Proteccion contra Riesgos Sanitarios%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 28: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Centros de Integracion Juvenil%' OR
                      Texto like '% CIJ %' OR
                      Texto like '%(CIJ)%' OR

                      Titulo like '%Centros de Integracion Juvenil%' OR
                      Titulo like '% CIJ %' OR
                      Titulo like '%(CIJ)%' OR

                      Encabezado like '%Centros de Integracion Juvenil%' OR
                      Encabezado like '% CIJ %' OR
                      Encabezado like '%(CIJ)%' OR

                      Autor like '%Centros de Integracion Juvenil%' OR
                      Autor like '% CIJ %' OR
                      Autor like '%(CIJ)%' OR

                      PieFoto like '%Centros de Integracion Juvenil%' OR
                      PieFoto like '% CIJ %' OR
                      PieFoto like '%(CIJ)%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 29: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Enrique peña nieto%' OR
                      Texto like '%Presidente Peña%' OR
                      Texto like '%Peña Nieto%' OR
                      Texto like '% EPN %' OR
                      Texto like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Texto like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Texto like '%@EPN%' OR
                      Texto like '%Quique Peña%' OR

                      Titulo like '%Enrique peña nieto%' OR
                      Titulo like '%Presidente Peña%' OR
                      Titulo like '%Peña Nieto%' OR
                      Titulo like '% EPN %' OR
                      Titulo like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Titulo like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Titulo like '%@EPN%' OR
                      Titulo like '%Quique Peña%' OR

                      Encabezado like '%Enrique peña nieto%' OR
                      Encabezado like '%Presidente Peña%' OR
                      Encabezado like '%Peña Nieto%' OR
                      Encabezado like '% EPN %' OR
                      Encabezado like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Encabezado like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Encabezado like '%@EPN%' OR
                      Encabezado like '%Quique Peña%' OR

                      Autor like '%Enrique peña nieto%' OR
                      Autor like '%Presidente Peña%' OR
                      Autor like '%Peña Nieto%' OR
                      Autor like '% EPN %' OR
                      Autor like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Autor like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Autor like '%@EPN%' OR
                      Autor like '%Quique Peña%' OR

                      PieFoto like '%Enrique peña nieto%' OR
                      PieFoto like '%Presidente Peña%' OR
                      PieFoto like '%Peña Nieto%' OR
                      PieFoto like '% EPN %' OR
                      PieFoto like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      PieFoto like '%Senor Licenciado Enrique Peña Nieto%' OR
                      PieFoto like '%@EPN%' OR
                      PieFoto like '%Quique Peña%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 30: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Gobierno de la Republica%' OR
                      Texto like '%Presidencia de la Republica%' OR
                      
                      Titulo like '%Gobierno de la Republica%' OR
                      Titulo like '%Presidencia de la Republica%' OR
                      
                      Encabezado like '%Gobierno de la Republica%' OR
                      Encabezado like '%Presidencia de la Republica%' OR
                      
                      Autor like '%Gobierno de la Republica%' OR
                      Autor like '%Presidencia de la Republica%' OR
                      
                      PieFoto like '%Gobierno de la Republica%' OR
                      PieFoto like '%Presidencia de la Republica%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 31: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Camara de Diputados%' OR
                      Texto like '%Diputado%' OR
                      Texto like '%Diputada%' OR
                      
                      Titulo like '%Camara de Diputados%' OR
                      Titulo like '%Diputado%' OR
                      Titulo like '%Diputada%' OR
                      
                      Encabezado like '%Camara de Diputados%' OR
                      Encabezado like '%Diputado%' OR
                      Encabezado like '%Diputada%' OR
                      
                      Autor like '%Camara de Diputados%' OR
                      Autor like '%Diputado%' OR
                      Autor like '%Diputada%' OR
                      
                      PieFoto like '%Camara de Diputados%' OR
                      PieFoto like '%Diputado%' OR
                      PieFoto like '%Diputada%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 32: //Gobernador
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
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Camara de Senadores%' OR
                      Texto like '%Senador%' OR
                      Texto like '%Senadora%' OR
                      
                      Titulo like '%Camara de Senadores%' OR
                      Titulo like '%Senador%' OR
                      Titulo like '%Senadora%' OR
                      
                      Encabezado like '%Camara de Senadores%' OR
                      Encabezado like '%Senador%' OR
                      Encabezado like '%Senadora%' OR
                      
                      Autor like '%Camara de Senadores%' OR
                      Autor like '%Senador%' OR
                      Autor like '%Senadora%' OR
                      
                      PieFoto like '%Camara de Senadores%' OR
                      PieFoto like '%Senador%' OR
                      PieFoto like '%Senadora%' 
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            /******************Fin Querys Estados ************************/

    }
}
