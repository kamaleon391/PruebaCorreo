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

function query($op,$fechaTabla){
        $fecha=$fechaTabla;
        $FechaCliente = strtotime($fechaTabla);
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);
        if ($FechaCliente == $fecha_actual)
        {
            $fechaTabla="noticiasDia";
        }
        else
        {
            $fechaTabla="noticiasSemana";
        }
    switch ($op) {
        case 1://Gobernador Parte 1
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                      WHERE(
                          Texto like '%Pablo Escudero Morales%' OR
                          Texto like '%Pablo Escudero%' OR
                          Texto like '%Escudero Morales%' OR
                          Texto like '%Presidente del Senado%' OR
                          Texto like '%Presidente Senado%' OR

                          Titulo like '%Pablo Escudero Morales%'OR
                          Titulo like '%Pablo Escudero%' OR
                          Titulo like '%Escudero Morales%' OR
                          Titulo like '%Presidente del Senado%' OR
                          Titulo like '%Presidente Senado%' OR

                          Encabezado like '%Pablo Escudero Morales%'OR
                          Encabezado like '%Pablo Escudero%' OR
                          Encabezado like '%Escudero Morales%' OR
                          Encabezado like '%Presidente del Senado%' OR
                          Encabezado like '%Presidente Senado%' OR

                          PieFoto like '%Pablo Escudero Morales%' OR
                          PieFoto like '%Pablo Escudero%' OR
                          PieFoto like '%Escudero Morales%' OR
                          PieFoto like '%Presidente Senado%' OR
                          PieFoto like '%Presidente del Senado%' OR

                          Autor like '%Pablo Escudero Morales%' OR
                          Autor like '%Pablo Escudero%' OR
                          Autor like '%Presidente del Senado%' OR
                          Autor like '%Presidente Senado%' OR
                          Autor like '%Escudero Morales%'
                        )AND
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                AND p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,50";
            return $query;
            break;
        case 1:// PRIMERAS PLANAS
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=3
                        AND s.idSeccion = n.Seccion AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY p.idPeriodico, n.NumeroPagina  ORDER BY o.posicion";
            return $query;
            break;
        case 2:// COLUMNAS POLITICAS
            $query="SELECT
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
                $fechaTabla n,
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
                fecha =DATE('$fecha')
            GROUP BY n.Periodico,n.NumeroPagina
            ORDER BY o.id";
            return $query;
            break;
        case 3:// COLUMNAS FINANCIERAS
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=20
                        AND s.idSeccion = n.Seccion
                        AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY p.idPeriodico, n.NumeroPagina
                        ORDER BY o.posicion";
            return $query;
            break;
        case 4:// CARTONES
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=18
                        AND s.idSeccion = n.Seccion
                        AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY p.idPeriodico, n.NumeroPagina
                        ORDER BY o.posicion";
            return $query;
            break;
        case 5:// Presidente del Senado
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                      WHERE(
                          Texto like '%Pablo Escudero Morales%' OR
                          Texto like '%Pablo Escudero%' OR
                          Texto like '%Escudero Morales%' OR
                          Texto like '%Presidente del Senado%' OR
                          Texto like '%Presidente Senado%' OR

                          Titulo like '%Pablo Escudero Morales%'OR
                          Titulo like '%Pablo Escudero%' OR
                          Titulo like '%Escudero Morales%' OR
                          Titulo like '%Presidente del Senado%' OR
                          Titulo like '%Presidente Senado%' OR

                          Encabezado like '%Pablo Escudero Morales%'OR
                          Encabezado like '%Pablo Escudero%' OR
                          Encabezado like '%Escudero Morales%' OR
                          Encabezado like '%Presidente del Senado%' OR
                          Encabezado like '%Presidente Senado%' OR

                          PieFoto like '%Pablo Escudero Morales%' OR
                          PieFoto like '%Pablo Escudero%' OR
                          PieFoto like '%Escudero Morales%' OR
                          PieFoto like '%Presidente Senado%' OR
                          PieFoto like '%Presidente del Senado%' OR

                          Autor like '%Pablo Escudero Morales%' OR
                          Autor like '%Pablo Escudero%' OR
                          Autor like '%Presidente del Senado%' OR
                          Autor like '%Presidente Senado%' OR
                          Autor like '%Escudero Morales%'
                        )AND

                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                AND p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,50";
            return $query;
            break;
        case 6:// Coordinador 
           $query="SELECT
                        DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico',
                        p.Nombre AS 'Periodico',
                        n.Fecha,
                        n.Titulo,
                        n.Seccion AS 'idSeccion',
                        s.seccion AS 'Seccion',
                        n.NumeroPagina,
                        n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM
                        ".$fechaTabla." n,
                        ordenGeneral o,
                        periodicos p,
                        seccionesPeriodicos s
                    WHERE
                        (
                        Texto like '%SEGOB%' OR
                        Texto like '% secretaria de gobernacion%' OR
                        Texto like '%SEGOB%' OR
                        Texto like '%gobernacion%' OR
                        Texto like '% secretaria de gobernacion estatal%' OR
                        Texto like '% secretaria de gobernacion%' OR
                        Texto like '% secretaria de gobernacion%' OR

                        Titulo like '%SEGOB%' OR
                        Titulo like '% secretaria de gobernacion%' OR
                        Titulo like '%SEGOB%' OR
                        Titulo like '% secretaria de gobernacion estatal%' OR
                        Titulo like '% secretaria de gobernacion%' OR
                        Titulo like '% secretaria de gobernacion%' OR


                        Encabezado like '%SEGOB%' OR
                        Encabezado like '% secretaria de gobernacion%' OR
                        Encabezado like '%SEGOB%' OR
                        Encabezado like '% secretaria de gobernacion estatal%' OR
                        Encabezado like '% secretaria de gobernacion%' OR
                        Encabezado like '% secretaria de gobernacion%'
                       ) AND
                 Texto not like '%ex Secretario%' AND
                 Texto not like '%ex funcionario%' AND
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                p.Estado=9 AND s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,29";
            return $query;
            break;
        case 7://  LICONSA
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                            WHERE(
                    Texto like '%subsecretaria de gobierno%' OR
                    Texto like '%Unidad de gobierno%' OR
                    Texto like '%luis enrique miranda nava%' OR
                    Texto like '%luis enrique miranda%' OR
                    Texto like '%luis miranda nava%' OR
                    Texto like '%luis miranda%' OR

                    Titulo like '%subsecretaria de gobierno%' OR
                    Titulo like '%Unidad de gobierno%' OR
                    Titulo like '%luis enrique miranda nava%' OR
                    Titulo like '%luis enrique miranda%' OR
                    Titulo like '%luis miranda nava%' OR
                    Titulo like '%luis miranda%' OR

                    Encabezado like '%subsecretaria de gobierno%' OR
                    Encabezado like '%Unidad de gobierno%' OR
                    Encabezado like '%luis enrique miranda nava%' OR
                    Encabezado like '%luis enrique miranda%' OR
                    Encabezado like '%luis miranda nava%' OR
                    Encabezado like '%luis miranda%'
                   ) AND
            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;
            break;
        case 8://  LECHE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                           WHERE (
            Texto like '%enlace legislativo%' OR
            Texto like '%felipe solis acero%' OR
            Texto like '%felipe solis%' OR
            Texto like '%subsecretario de enlace legislativo%' OR

            Titulo like '%enlace legislativo%' OR
            Titulo like '%felipe solis acero%' OR
            Titulo like '%felipe solis%' OR
            Titulo like '%subsecretario de enlace legislativo%' OR

            Encabezado like '%enlace legislativo%' OR
            Encabezado like '%felipe solis acero%' OR
            Encabezado like '%felipe solis%'  OR
            Encabezado like '%subsecretario de enlace legislativo%'
           ) AND (Texto like '%SEGOB%' OR Texto like '%Secretaria de Gobernacion%')
            AND
            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;
            break;
        case 9://  
           $query="SELECT
                    DISTINCT(n.idEditorial),
                    n.Periodico AS 'idPeriodico',
                    p.Nombre AS 'Periodico',
                    n.Fecha,
                    n.Titulo,
                    n.Seccion AS 'idSeccion',
                    s.seccion AS 'Seccion',
                    n.NumeroPagina,
                    n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                FROM
                    ".$fechaTabla." n,
                    ordenGeneral o,
                    periodicos p,
                    seccionesPeriodicos s
                WHERE ".."
                    AND 
                    n.Periodico=o.periodico AND
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND 
                    n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico";
            return $query;
            break;
    }
}


function queryBuilderGobernador($estado){
    $where="";
    case '14':{
        $where="(
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
            )";
    }
    return $where;
}
?>
