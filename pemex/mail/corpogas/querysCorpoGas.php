<?php

function numberNotes($optionCase, $fecha)
{
    global $conect;

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

            case 5:// Director General CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                          WHERE(
                            Texto like '%Carlos Alberto Trevino Medina%' OR
                        		Texto like '%Carlos Alberto Trevino%' OR
                        		Texto like '%Alberto Trevino Medina%' OR
                        		Texto like '%Carlos Trevino%' OR
                      			Texto like '%Director de Pemex%' OR

                        		Titulo like '%Carlos Alberto Trevino Medina%' OR
                        		Titulo like '%Carlos Alberto Trevino%' OR
                        		Titulo like '%Alberto Trevino Medina%' OR
                        		Titulo like '%Carlos Trevino%' OR
                      			Titulo like '%Director de Pemex%' OR

                        		Encabezado like '%Carlos Alberto Trevino Medina%' OR
                        		Encabezado like '%Carlos Alberto Trevino%' OR
                        		Encabezado like '%Alberto Trevino Medina%' OR
                        		Encabezado like '%Carlos Trevino%' OR
                      			Encabezado like '%Director de Pemex%' OR

                        		PieFoto like '%Carlos Alberto Trevino Medina%' OR
                        		PieFoto like '%Carlos Alberto Trevino%' OR
                        		PieFoto like '%Alberto Trevino Medina%' OR
                        		PieFoto like '%Carlos Trevino%' OR
                      			PieFoto like '%Director de Pemex%' OR

                        		Autor like '%Carlos Alberto Trevino Medina%' OR
                        		Autor like '%Carlos Alberto Trevino%' OR
                        		Autor like '%Alberto Trevino Medina%' OR
                        		Autor like '%Carlos Trevino%' OR
                      			Autor like '%Director de Pemex%'


                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 6:// Director General Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                          WHERE(
                            Texto like '%Carlos Alberto Trevino Medina%' OR
                        		Texto like '%Carlos Alberto Trevino%' OR
                        		Texto like '%Alberto Trevino Medina%' OR
                        		Texto like '%Carlos Trevino%' OR
                      			Texto like '%Director de Pemex%' OR

                        		Titulo like '%Carlos Alberto Trevino Medina%' OR
                        		Titulo like '%Carlos Alberto Trevino%' OR
                        		Titulo like '%Alberto Trevino Medina%' OR
                        		Titulo like '%Carlos Trevino%' OR
                      			Titulo like '%Director de Pemex%' OR

                        		Encabezado like '%Carlos Alberto Trevino Medina%' OR
                        		Encabezado like '%Carlos Alberto Trevino%' OR
                        		Encabezado like '%Alberto Trevino Medina%' OR
                        		Encabezado like '%Carlos Trevino%' OR
                      			Encabezado like '%Director de Pemex%' OR

                        		PieFoto like '%Carlos Alberto Trevino Medina%' OR
                        		PieFoto like '%Carlos Alberto Trevino%' OR
                        		PieFoto like '%Alberto Trevino Medina%' OR
                        		PieFoto like '%Carlos Trevino%' OR
                      			PieFoto like '%Director de Pemex%' OR

                        		Autor like '%Carlos Alberto Trevino Medina%' OR
                        		Autor like '%Carlos Alberto Trevino%' OR
                        		Autor like '%Alberto Trevino Medina%' OR
                        		Autor like '%Carlos Trevino%' OR
                      			Autor like '%Director de Pemex%'  
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 7:// Ref. Energética
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Reforma Energetica%' OR
                                Texto like '%Ref. Energetica%' OR

                                Titulo like '%Reforma Energetica%' OR
                                Titulo like '%Ref. Energetica%' OR

                                Autor like '%Reforma Energetica%' OR
                                Autor like '%Ref. Energetica%' OR

                                PieFoto like '%Reforma Energetica%' OR
                                PieFoto like '%Ref. Energetica%' OR

                                Autor like '%Reforma Energetica%' OR
                                Autor like '%Ref. Energetica%'

                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 8:// Ref. Energética estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Reforma Energetica%' OR
                                Texto like '%Ref. Energetica%' OR

                                Titulo like '%Reforma Energetica%' OR
                                Titulo like '%Ref. Energetica%' OR

                                Autor like '%Reforma Energetica%' OR
                                Autor like '%Ref. Energetica%' OR

                                PieFoto like '%Reforma Energetica%' OR
                                PieFoto like '%Ref. Energetica%' OR

                                Autor like '%Reforma Energetica%' OR
                                Autor like '%Ref. Energetica%'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 9:// Petróleo
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Petroleo%' OR

                                Titulo like '%Petroleo%' OR

                                Autor like '%Petroleo%' OR

                                PieFoto like '%Petroleo%' OR

                                Autor like '%Petroleo%'
                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 10:// Petróleo Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Petroleo%' OR

                                Titulo like '%Petroleo%' OR

                                Autor like '%Petroleo%' OR

                                PieFoto like '%Petroleo%' OR

                                Autor like '%Petroleo%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 11:// Gas
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '% Gas natural%' OR
                                Texto like '% Gas metano%' OR
                                Texto like '% Gas etano%' OR
                                Texto like '% Gas butano%' OR
                                Texto like '% Gas propano%' OR
                                Texto like '% Gas etileno%' OR
                                Texto like '% Gas propileno%' OR
                                Texto like '% Gas licuado%' OR

                                Titulo like '% Gas natural%' OR
                                Titulo like '% Gas metano%' OR
                                Titulo like '% Gas etano%' OR
                                Titulo like '% Gas butano%' OR
                                Titulo like '% Gas propano%' OR
                                Titulo like '% Gas etileno%' OR
                                Titulo like '% Gas propileno%' OR
                                Titulo like '% Gas licuado%' OR

                                Encabezado like '% Gas natural%' OR
                                Encabezado like '% Gas metano%' OR
                                Encabezado like '% Gas etano%' OR
                                Encabezado like '% Gas butano%' OR
                                Encabezado like '% Gas propano%' OR
                                Encabezado like '% Gas etileno%' OR
                                Encabezado like '% Gas propileno%' OR
                                Encabezado like '% Gas licuado%' OR

                                PieFoto like '% Gas natural%' OR
                                PieFoto like '% Gas metano%' OR
                                PieFoto like '% Gas etano%' OR
                                PieFoto like '% Gas butano%' OR
                                PieFoto like '% Gas propano%' OR
                                PieFoto like '% Gas etileno%' OR
                                PieFoto like '% Gas propileno%' OR
                                PieFoto like '% Gas licuado%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 12:// Gas Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '% Gas natural%' OR
                                Texto like '% Gas metano%' OR
                                Texto like '% Gas etano%' OR
                                Texto like '% Gas butano%' OR
                                Texto like '% Gas propano%' OR
                                Texto like '% Gas etileno%' OR
                                Texto like '% Gas propileno%' OR
                                Texto like '% Gas licuado%' OR

                                Titulo like '% Gas natural%' OR
                                Titulo like '% Gas metano%' OR
                                Titulo like '% Gas etano%' OR
                                Titulo like '% Gas butano%' OR
                                Titulo like '% Gas propano%' OR
                                Titulo like '% Gas etileno%' OR
                                Titulo like '% Gas propileno%' OR
                                Titulo like '% Gas licuado%' OR

                                Encabezado like '% Gas natural%' OR
                                Encabezado like '% Gas metano%' OR
                                Encabezado like '% Gas etano%' OR
                                Encabezado like '% Gas butano%' OR
                                Encabezado like '% Gas propano%' OR
                                Encabezado like '% Gas etileno%' OR
                                Encabezado like '% Gas propileno%' OR
                                Encabezado like '% Gas licuado%' OR

                                PieFoto like '% Gas natural%' OR
                                PieFoto like '% Gas metano%' OR
                                PieFoto like '% Gas etano%' OR
                                PieFoto like '% Gas butano%' OR
                                PieFoto like '% Gas propano%' OR
                                PieFoto like '% Gas etileno%' OR
                                PieFoto like '% Gas propileno%' OR
                                PieFoto like '% Gas licuado%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 13:// Petroquimica
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Petroquimica%' OR

                                Titulo like '%Petroquimica%' OR

                                Autor like '%Petroquimica%' OR

                                PieFoto like '%Petroquimica%' OR

                                Autor like '%Petroquimica%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 14:// Petroquimica estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Petroquimica%' OR

                                Titulo like '%Petroquimica%' OR

                                Autor like '%Petroquimica%' OR

                                PieFoto like '%Petroquimica%' OR

                                Autor like '%Petroquimica%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 15:// Gasolina
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Gasolina%' OR

                                Titulo like '%Gasolina%' OR

                                Autor like '%Gasolina%' OR

                                PieFoto like '%Gasolina%' OR

                                Autor like '%Gasolina%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 16:// Gasolina Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Gasolina%' OR

                                Titulo like '%Gasolina%' OR

                                Autor like '%Gasolina%' OR

                                PieFoto like '%Gasolina%' OR

                                Autor like '%Gasolina%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 17:// Reforma Laboral
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Reforma Laboral%' OR

                                Titulo like '%Reforma Laboral%' OR

                                Autor like '%Reforma Laboral%' OR

                                PieFoto like '%Reforma Laboral%' OR

                                Autor like '%Reforma Laboral%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 18:// Reforma Laboral Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Reforma Laboral%' OR

                                Titulo like '%Reforma Laboral%' OR

                                Autor like '%Reforma Laboral%' OR

                                PieFoto like '%Reforma Laboral%' OR

                                Autor like '%Reforma Laboral%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 19:// Refinacion
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Refinacion%' OR
                                Texto like '%Refineria%' OR

                                Titulo like '%Refinacion%' OR
                                Titulo like '%Refineria%' OR

                                Autor like '%Refinacion%' OR
                                Autor like '%Refineria%' OR

                                PieFoto like '%Refinacion%' OR
                                PieFoto like '%Refineria%' OR

                                Autor like '%Refinacion%' OR
                                Autor like '%Refineria%'

                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 20:// Refinacion estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Refinacion%' OR
                                Texto like '%Refineria%' OR

                                Titulo like '%Refinacion%' OR
                                Titulo like '%Refineria%' OR

                                Autor like '%Refinacion%' OR
                                Autor like '%Refineria%' OR

                                PieFoto like '%Refinacion%' OR
                                PieFoto like '%Refineria%' OR

                                Autor like '%Refinacion%' OR
                                Autor like '%Refineria%'

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
