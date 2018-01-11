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
			AND n.Categoria not in (141) #Sin EDICTOS
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
			AND n.Categoria not in (141) #Sin EDICTOS
                        GROUP BY p.idPeriodico, n.NumeroPagina
                        ORDER BY o.posicion";
            return $query;
            break;

            case 5:// Be Grand CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                          WHERE (
		Texto 		like '%be grand %' OR
		Texto 		like '%begrand %' OR
		Texto 		like '%inmobiliaria be grand%' OR
		Texto 		like '%constructora be grand%' OR
		Texto 		like '%inmobiliaria begrand%' OR

		Titulo 		like '%be grand %' OR
		Titulo 		like '%begrand %' OR
		Titulo 		like '%inmobiliaria be grand%' OR
		Titulo 		like '%constructora be grand%' OR
		Titulo 		like '%inmobiliaria begrand%' OR

		Encabezado 		like '%be grand %' OR
		Encabezado 		like '%begrand %' OR
		Encabezado 		like '%inmobiliaria be grand%' OR
		Encabezado 		like '%constructora be grand%' OR
		Encabezado 		like '%inmobiliaria begrand%' OR

		Autor 		like '%be grand %' OR
		Autor 		like '%begrand %' OR
		Autor 		like '%inmobiliaria be grand%' OR
		Autor 		like '%constructora be grand%' OR
		Autor 		like '%inmobiliaria begrand%' OR

		PieFoto 		like '%be grand %' OR
		PieFoto 		like '%begrand %' OR
		PieFoto 		like '%inmobiliaria be grand%' OR
		PieFoto 		like '%constructora be grand%' OR
		PieFoto 		like '%inmobiliaria begrand%'
	)AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
			    AND n.Categoria not in (141) #Sin EDICTOS
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 6:// Be Grand Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                          WHERE(
                            Texto like '%Be Grand%' OR

                            Titulo like '%Be Grand%' OR


                            Encabezado like '%Be Grand%' OR

                            PieFoto like '%Be Grand%' OR


                            Autor like '%Be Grand%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
			    AND n.Categoria not in (141) #Sin EDICTOS
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 7:// ABILIA CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '% ABILIA %' OR

                                Titulo like '% ABILIA %' OR


                                Autor like '% ABILIA %' OR


                                PieFoto like '% ABILIA %' OR



                                Autor like '% ABILIA %'

                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
			    AND n.Categoria not in (141) #Sin EDICTOS
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 8:// ABILIA estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '% ABILIA %' OR

                            Titulo like '% ABILIA %' OR


                            Autor like '% ABILIA %' OR


                            PieFoto like '% ABILIA %' OR



                            Autor like '% ABILIA %'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
			    AND n.Categoria not in (141) #Sin EDICTOS
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 9:// inmobiliario inmobiliaria CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%inmobiliario%' OR
                                Texto like '%inmobiliaria%' OR

                                Titulo like '%inmobiliario%' OR
                                Titulo like '%inmobiliaria%' OR

                                Autor like '%inmobiliario%' OR
                                Autor like '%inmobiliaria%' OR

                                PieFoto like '%inmobiliario%' OR
                                PieFoto like '%inmobiliaria%' OR

                                Autor like '%inmobiliario%' OR
                                Autor like '%inmobiliaria%'
                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
			    AND n.Categoria not in (141) #Sin EDICTOS
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 10:// inmobiliario inmobiliaria Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%inmobiliario%' OR
                            Texto like '%inmobiliaria%' OR

                            Titulo like '%inmobiliario%' OR
                            Titulo like '%inmobiliaria%' OR

                            Autor like '%inmobiliario%' OR
                            Autor like '%inmobiliaria%' OR

                            PieFoto like '%inmobiliario%' OR
                            PieFoto like '%inmobiliaria%' OR

                            Autor like '%inmobiliario%' OR
                            Autor like '%inmobiliaria%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
			    AND n.Categoria not in (141) #Sin EDICTOS
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 11:// condominio desarrolladora de vivienda Desrrolladoras de vivienda CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%condominio%' OR
                                Texto like '%desarrolladora de vivienda%' OR
                                Texto like '%Desrrolladoras de vivienda%' OR

                                Titulo like '%condominio%' OR
                                Titulo like '%desarrolladora de vivienda%' OR
                                Titulo like '%%Desrrolladoras de vivienda%' OR

                                Encabezado like '%condominio%' OR
                                Encabezado like '%desarrolladora de vivienda%' OR
                                Encabezado like '%%Desrrolladoras de vivienda%' OR

                                PieFoto like '%condominio%' OR
                                PieFoto like '%desarrolladora de vivienda%' OR
                                PieFoto like '%%Desrrolladoras de vivienda%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
			    AND n.Categoria not in (141) #Sin EDICTOS
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 12://condominio desarrolladora de vivienda Desrrolladoras de vivienda estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                          Texto like '%condominio%' OR
                          Texto like '%desarrolladora de vivienda%' OR
                          Texto like '%Desrrolladoras de vivienda%' OR

                          Titulo like '%condominio%' OR
                          Titulo like '%desarrolladora de vivienda%' OR
                          Titulo like '%%Desrrolladoras de vivienda%' OR

                          Encabezado like '%condominio%' OR
                          Encabezado like '%desarrolladora de vivienda%' OR
                          Encabezado like '%%Desrrolladoras de vivienda%' OR

                          PieFoto like '%condominio%' OR
                          PieFoto like '%desarrolladora de vivienda%' OR
                          PieFoto like '%%Desrrolladoras de vivienda%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
			    AND n.Categoria not in (141) #Sin EDICTOS
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            default:
            break;

    }
}
?>
