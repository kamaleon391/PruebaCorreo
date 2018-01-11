<?php
function query($op,$fechaTabla){
        $fecha=$fechaTabla;
        $FechaCliente = strtotime($fechaTabla);
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);
        if ($FechaCliente == $fecha_actual)
        {
            $fechaTabla = "noticiasDia";
        }
        else
        {
            $fechaTabla = "(
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasSemana WHERE Fecha = '".$fechaTabla."'
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasMensual WHERE Fecha = '".$fechaTabla."'
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasAnual WHERE Fecha = '".$fechaTabla."'
                )";
        }
    switch ($op) {
        case 1:// PRIMERAS PLANAS
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=3
                        AND s.idSeccion = n.Seccion AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY n.Periodico ORDER BY o.posicion";
            return $query;
            break;
        case 2:// COLUMNAS POLITICAS
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=19
                        AND s.idSeccion = n.Seccion AND p.Estado=9 AND n.Fecha='".$fecha."'
                        ORDER BY o.posicion";
            return $query;
            break;
        case 3:// COLUMNAS FINANCIERAS
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=20
                        AND s.idSeccion = n.Seccion
                        AND p.Estado=9 AND n.Fecha='".$fecha."'
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
                        ORDER BY o.posicion";
            return $query;
            break;
            case 5://Scholas Occurrentes CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                          WHERE(
                                Texto like '%Scholas Occurrentes%' OR


                            Titulo like '%Scholas Occurrentes%' OR


                            Encabezado like '%Scholas Occurrentes%' OR


                            PieFoto like '%Scholas Occurrentes%' OR


                            Autor like '%Scholas Occurrentes%'


                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 6:// Scholas Occurrentes Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                          WHERE(
                                Texto like '%Scholas Occurrentes%' OR


                            Titulo like '%Scholas Occurrentes%' OR


                            Encabezado like '%Scholas Occurrentes%' OR


                            PieFoto like '%Scholas Occurrentes%' OR


                            Autor like '%Scholas Occurrentes%'


                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 7:// Papa Francisco CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Papa Francisco%' OR
                                Titulo like '%Papa Francisco%' OR
                                Autor like '%Papa Francisco%' OR
                                PieFoto like '%Papa Francisco%' OR
                                Autor like '%Papa Francisco%'
                                ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 8:// Papa Francisco estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Papa Francisco%' OR
                                Titulo like '%Papa Francisco%' OR
                                Autor like '%Papa Francisco%' OR
                                PieFoto like '%Papa Francisco%' OR
                                Autor like '%Papa Francisco%'
                                ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 9:// José María del Corral CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Jose Maria del Corral%' OR

                                Titulo like '%Jose Maria del Corral%' OR

                                Autor like '%Jose Maria del Corral%' OR

                                PieFoto like '%Jose Maria del Corral%' OR

                                Autor like '%Jose Maria del Corral%'
                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 10:// José María del Corral estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Jose Maria del Corral%' OR

                                Titulo like '%Jose Maria del Corral%' OR

                                Autor like '%Jose Maria del Corral%' OR

                                PieFoto like '%Jose Maria del Corral%' OR

                                Autor like Jose Maria del Corral%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 11:// Enrique Palmeyro CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '% Enrique Palmeyro%' OR

                                Titulo like '% Enrique Palmeyro%' OR

                                Encabezado like '% Enrique Palmeyro%' OR

                                PieFoto like '% Enrique Palmeyro%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 12:// Enrique Palmeyro  Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '% Enrique Palmeyro%' OR

                                Titulo like '% Enrique Palmeyro%' OR

                                Encabezado like '% Enrique Palmeyro%' OR

                                PieFoto like '% Enrique Palmeyro%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 13:// Héctor Sulaimán CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Hector Sulaiman%' OR

                                Titulo like '%Hector Sulaiman%' OR

                                Autor like '%Hector Sulaiman%' OR

                                PieFoto like '%Hector Sulaiman%' OR

                                Autor like '%Hector Sulaiman%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 14:// Héctor Sulaimán estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Hector Sulaiman%' OR

                                Titulo like '%Hector Sulaiman%' OR

                                Autor like '%Hector Sulaiman%' OR

                                PieFoto like '%Hector Sulaiman%' OR

                                Autor like '%Hector Sulaiman%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 15:// Mauricio Sulaimán CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Mauricio Sulaiman%' OR

                                Titulo like '%Mauricio Sulaiman%' OR

                                Autor like '%Mauricio Sulaiman%' OR

                                PieFoto like '%Mauricio Sulaiman%' OR

                                Autor like '%Mauricio Sulaiman%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 16:// Mauricio Sulaimán Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Mauricio Sulaiman%' OR

                                Titulo like '%Mauricio Sulaiman%' OR

                                Autor like '%Mauricio Sulaiman%' OR

                                PieFoto like '%Mauricio Sulaiman%' OR

                                Autor like '%Mauricio Sulaiman%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 17:// Arquata
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Arquata%' OR

                                Titulo like '%Arquata%' OR

                                Autor like '%Arquata%' OR

                                PieFoto like '%Arquata%' OR

                                Autor like '%Arquata%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 18:// Arquata Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Arquata%' OR

                                Titulo like '%Arquata%' OR

                                Autor like '%Arquata%' OR

                                PieFoto like '%Arquata%' OR

                                Autor like '%Arquata%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 19:// Fut val
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Fut Val%' OR

                                Titulo like '%Fut Val%' OR

                                Autor like '%Fut Val%' OR

                                PieFoto like '%Fut Val%' OR

                                Autor like '%Fut Val%'

                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 20:// Fut val estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Fut Val%' OR

                                Titulo like '%Fut Val%' OR

                                Autor like '%Fut Val%' OR

                                PieFoto like '%Fut Val%' OR

                                Autor like '%Fut Val%'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;


            case 21:// Box Val estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Box Val%' OR

                                Titulo like '%Box Val%' OR

                                Autor like '%Box Val%' OR

                                PieFoto like '%Box Val%' OR

                                Autor like '%Box Val%'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;



            case 22:// Box Val estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Box Val%' OR

                                Titulo like '%Box Val%' OR

                                Autor like '%Box Val%' OR

                                PieFoto like '%Box Val%' OR

                                Autor like '%Box Val%'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 23:// Scholas ciudadania
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Scholas ciudadania%' OR

                                Titulo like 'Scholas ciudadania%' OR

                                Autor like '%Scholas ciudadania%' OR

                                PieFoto like Scholas ciudadania%' OR

                                Autor like '%Scholas ciudadania%'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 24:// Scholas ciudadanía estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Scholas ciudadania%' OR

                                Titulo like 'Scholas ciudadania%' OR

                                Autor like '%Scholas ciudadania%' OR

                                PieFoto like Scholas ciudadania%' OR

                                Autor like '%Scholas ciudadania%'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            default:
            break;
    }
}
?>
