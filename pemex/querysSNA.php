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

            case 5://Sistema Nacional Anticorrupción SNA CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                          WHERE(
                            Texto like '%Sistema Nacional Anticorrupcion SNA%' OR
                            Texto like '%Sistema Anticorrupcion%' OR
                            Texto like '%Sistema Nacional Anticorrupcion%' OR
                            Texto like '%Nacional Anticorrupcion%' OR

                            Titulo like '%Sistema Nacional Anticorrupcion SNA%' OR
                            Titulo like '%Sistema Anticorrupcion%' OR
                            Titulo like '%Sistema Nacional Anticorrupcion%' OR
                            Titulo like '%Nacional Anticorrupcion%' OR

                            Encabezado like '%Sistema Nacional Anticorrupcion SNA%' OR
                            Encabezado like '%Sistema Anticorrupcion%' OR
                            Encabezado like '%Sistema Nacional Anticorrupcion%' OR
                            Encabezado like '%Nacional Anticorrupcion%' OR
                              
                            PieFoto like '%Sistema Nacional Anticorrupcion SNA%' OR
                            PieFoto like '%Sistema Anticorrupcion%' OR
                            PieFoto like '%Sistema Nacional Anticorrupcion%' OR
                            PieFoto like '%Nacional Anticorrupcion%'
                        )

                                
                            AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 6:// Sistema Nacional Anticorrupción SNA Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                          WHERE(
                                Texto like '%Sistema Nacional Anticorrupcion SNA%' OR
                            Texto like '%Sistema Anticorrupcion%' OR
                            Texto like '%Sistema Nacional Anticorrupcion%' OR
                            Texto like '%Nacional Anticorrupcion%' OR

                            Titulo like '%Sistema Nacional Anticorrupcion SNA%' OR
                            Titulo like '%Sistema Anticorrupcion%' OR
                            Titulo like '%Sistema Nacional Anticorrupcion%' OR
                            Titulo like '%Nacional Anticorrupcion%' OR

                            Encabezado like '%Sistema Nacional Anticorrupcion SNA%' OR
                            Encabezado like '%Sistema Anticorrupcion%' OR
                            Encabezado like '%Sistema Nacional Anticorrupcion%' OR
                            Encabezado like '%Nacional Anticorrupcion%' OR
                              
                            PieFoto like '%Sistema Nacional Anticorrupcion SNA%' OR
                            PieFoto like '%Sistema Anticorrupcion%' OR
                            PieFoto like '%Sistema Nacional Anticorrupcion%' OR
                            PieFoto like '%Nacional Anticorrupcion%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 7:// Secretaría Ejecutiva del SNA CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Secretaria Ejecutiva del SNA%' OR
                                Texto like '%Secretaria Ejecutiva del Sistema Nacional Anticorrupcion%' OR
                                Texto like '%Ejecutiva del Sistema Nacional Anticorrupcion%' OR
                                Texto like '%Secretaria Ejecutiva del SNA%' OR

                                Titulo like '%Secretaria Ejecutiva del SNA%' OR
                                Titulo like '%Secretaria Ejecutiva del Sistema Nacional Anticorrupcion%' OR
                                Titulo like '%Ejecutiva del Sistema Nacional Anticorrupcion%' OR
                                Titulo like '%Secretaria Ejecutiva del SNA%' OR

                                Encabezado like '%Secretaria Ejecutiva del SNA%' OR
                                Encabezado like '%Secretaria Ejecutiva del Sistema Nacional Anticorrupcion%' OR
                                Encabezado like '%Ejecutiva del Sistema Nacional Anticorrupcion%' OR
                                Encabezado like '%Secretaria Ejecutiva del SNA%' OR
                                  
                                PieFoto like '%Secretaria Ejecutiva del SNA%' OR
                                PieFoto like '%Secretaria Ejecutiva del Sistema Nacional Anticorrupcion%' OR
                                PieFoto like '%Ejecutiva del Sistema Nacional Anticorrupcion%' OR
                                PieFoto like '%Secretaria Ejecutiva del SNA%' 

                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 8:// Secretaría Ejecutiva del SNA estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Secretaria Ejecutiva del SNA%' OR
    Texto like '%Secretaria Ejecutiva del Sistema Nacional Anticorrupcion%' OR
    Texto like '%Ejecutiva del Sistema Nacional Anticorrupcion%' OR
    Texto like '%Secretaria Ejecutiva del SNA%' OR

    Titulo like '%Secretaria Ejecutiva del SNA%' OR
    Titulo like '%Secretaria Ejecutiva del Sistema Nacional Anticorrupcion%' OR
    Titulo like '%Ejecutiva del Sistema Nacional Anticorrupcion%' OR
    Titulo like '%Secretaria Ejecutiva del SNA%' OR

    Encabezado like '%Secretaria Ejecutiva del SNA%' OR
    Encabezado like '%Secretaria Ejecutiva del Sistema Nacional Anticorrupcion%' OR
    Encabezado like '%Ejecutiva del Sistema Nacional Anticorrupcion%' OR
    Encabezado like '%Secretaria Ejecutiva del SNA%' OR
      
    PieFoto like '%Secretaria Ejecutiva del SNA%' OR
    PieFoto like '%Secretaria Ejecutiva del Sistema Nacional Anticorrupcion%' OR
    PieFoto like '%Ejecutiva del Sistema Nacional Anticorrupcion%' OR
    PieFoto like '%Secretaria Ejecutiva del SNA%' 

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 9:// Secretario Técnico de la Secretaria Ejecutiva del SNA, Ricardo Salgado Perrilliat CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Ricardo Salgado Perrilliat%' OR
                                Texto like '%Ricardo Salgado%' OR
                                Texto like '%Salgado Perrilliat%' OR

                                Titulo like '%Ricardo Salgado Perrilliat%' OR
                                Titulo like '%Ricardo Salgado%' OR
                                Titulo like '%Salgado Perrilliat%' OR

                                Encabezado like '%Ricardo Salgado Perrilliat%' OR
                                Encabezado like '%Ricardo Salgado%' OR
                                Encabezado like '%Salgado Perrilliat%' OR
                                  
                                PieFoto like '%Ricardo Salgado Perrilliat%' OR
                                PieFoto like '%Ricardo Salgado%' OR
                                PieFoto like '%Salgado Perrilliat%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 10:// Secretario Técnico de la Secretaria Ejecutiva del SNA, Ricardo Salgado Perrilliat Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Ricardo Salgado Perrilliat%' OR
                                    Texto like '%Ricardo Salgado%' OR
                                    Texto like '%Salgado Perrilliat%' OR

                                    Titulo like '%Ricardo Salgado Perrilliat%' OR
                                    Titulo like '%Ricardo Salgado%' OR
                                    Titulo like '%Salgado Perrilliat%' OR

                                    Encabezado like '%Ricardo Salgado Perrilliat%' OR
                                    Encabezado like '%Ricardo Salgado%' OR
                                    Encabezado like '%Salgado Perrilliat%' OR
                                      
                                    PieFoto like '%Ricardo Salgado Perrilliat%' OR
                                    PieFoto like '%Ricardo Salgado%' OR
                                    PieFoto like '%Salgado Perrilliat%'
                                ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 11:// Fiscal General Anticorrupción
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Fiscal General Anticorrupcion%' OR
                                Texto like '%Fiscal Anticorrupcion%' OR
                                Texto like '%General Anticorrupcion%' OR

                                Titulo like '%Fiscal General Anticorrupcion%' OR
                                Titulo like '%Fiscal Anticorrupcion%' OR
                                Titulo like '%General Anticorrupcion%' OR

                                Encabezado like '%Fiscal General Anticorrupcion%' OR
                                Encabezado like '%Fiscal Anticorrupcion%' OR
                                Encabezado like '%General Anticorrupcion%' OR

                                PieFoto like '%Fiscal General Anticorrupcion%' OR
                                PieFoto like '%Fiscal Anticorrupcion%' OR
                                PieFoto like '%General Anticorrupcion%'
                                )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 12:// Fiscal General Anticorrupción Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Fiscal General Anticorrupcion%' OR
                            Texto like '%Fiscal Anticorrupcion%' OR
                            Texto like '%General Anticorrupcion%' OR

                            Titulo like '%Fiscal General Anticorrupcion%' OR
                            Titulo like '%Fiscal Anticorrupcion%' OR
                            Titulo like '%General Anticorrupcion%' OR

                            Encabezado like '%Fiscal General Anticorrupcion%' OR
                            Encabezado like '%Fiscal Anticorrupcion%' OR
                            Encabezado like '%General Anticorrupcion%' OR

                            PieFoto like '%Fiscal General Anticorrupcion%' OR
                            PieFoto like '%Fiscal Anticorrupcion%' OR
                            PieFoto like '%General Anticorrupcion%'
                            )AND
                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 13:// Magistrados anticorrupción
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Magistrados anticorrupcion%' OR

                                Titulo like '%Magistrados anticorrupcion%' OR

                                Encabezado like '%Magistrados anticorrupcion%' OR

                                PieFoto like '%Magistrados anticorrupcion%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 14:// Magistrados anticorrupción estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Magistrados anticorrupcion%' OR

                                Titulo like '%Magistrados anticorrupcion%' OR

                                Encabezado like '%Magistrados anticorrupcion%' OR

                                PieFoto like '%Magistrados anticorrupcion%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 15:// Ley General del Sistema Nacional Anticorrupción
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Ley General del Sistema Nacional Anticorrupcion%' OR

                                Titulo like '%Ley General del Sistema Nacional Anticorrupcion%' OR

                                Encabezado like '%Ley General del Sistema Nacional Anticorrupcion%' OR

                                PieFoto like '%Ley General del Sistema Nacional Anticorrupcion%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 16:// Ley General del Sistema Nacional Anticorrupción Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Ley General del Sistema Nacional Anticorrupcion%' OR

                                Titulo like '%Ley General del Sistema Nacional Anticorrupcion%' OR

                                Encabezado like '%Ley General del Sistema Nacional Anticorrupcion%' OR

                                PieFoto like '%Ley General del Sistema Nacional Anticorrupcion%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 17:// Comité de Participación Ciudadana
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Comite de Participacion Ciudadana%' OR

                                Titulo like '%Comite de Participacion Ciudadana%' OR

                                Encabezado like '%Comite de Participacion Ciudadana%' OR

                                PieFoto like '%Comite de Participacion Ciudadana%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 18:// Comité de Participación Ciudadana Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Comite de Participacion Ciudadana%' OR

                                Titulo like '%Comite de Participacion Ciudadana%' OR

                                Encabezado like '%Comite de Participacion Ciudadana%' OR

                                PieFoto like '%Comite de Participacion Ciudadana%'
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 19:// Sistema Local anticorrupción CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Sistema Local anticorrupcion%' OR

                                Titulo like '%Sistema Local anticorrupcion%' OR

                                Encabezado like '%Sistema Local anticorrupcion%' OR

                                PieFoto like '%Sistema Local anticorrupcion%'
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 20:// Sistema Local anticorrupción Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Sistema Local anticorrupcion%' OR

                                Titulo like '%Sistema Local anticorrupcion%' OR

                                Encabezado like '%Sistema Local anticorrupcion%' OR

                                PieFoto like '%Sistema Local anticorrupcion%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 21:// Sistema Nacional de Fiscalización CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Sistema Nacional de Fiscalizacion%' OR

                                Titulo like '%Sistema Nacional de Fiscalizacion%' OR

                                Encabezado like '%Sistema Nacional de Fiscalizacion%' OR

                                PieFoto like '%Sistema Nacional de Fiscalizacion%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 22:// Sistema Nacional de Fiscalización Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Sistema Nacional de Fiscalizacion%' OR

                                Titulo like '%Sistema Nacional de Fiscalizacion%' OR

                                Encabezado like '%Sistema Nacional de Fiscalizacion%' OR

                                PieFoto like '%Sistema Nacional de Fiscalizacion%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 23:// Jacqueline Peschard Mariscal CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Jacqueline Peschard Mariscal%' OR
                                Texto like '%Jacqueline Peschard%' OR

                                Titulo like '%Jacqueline Peschard Mariscal%' OR
                                Titulo like '%Jacqueline Peschard%' OR

                                Encabezado like '%Jacqueline Peschard Mariscal%' OR
                                Encabezado like '%Jacqueline Peschard%' OR

                                PieFoto like '%Jacqueline Peschard Mariscal%' OR
                                PieFoto like '%Jacqueline Peschard%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 24:// Jacqueline Peschard Mariscal Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Jacqueline Peschard Mariscal%' OR
                                Texto like '%Jacqueline Peschard%' OR

                                Titulo like '%Jacqueline Peschard Mariscal%' OR
                                Titulo like '%Jacqueline Peschard%' OR

                                Encabezado like '%Jacqueline Peschard Mariscal%' OR
                                Encabezado like '%Jacqueline Peschard%' OR

                                PieFoto like '%Jacqueline Peschard Mariscal%' OR
                                PieFoto like '%Jacqueline Peschard%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 25:// José Octavio López Presa CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Jose Octavio Lopez Presa%' OR
                                Texto like '%Jose Octavio Lopez%' OR
                                Texto like '%Jose Lopez Presa%' OR
                                Texto like '%Octavio Lopez Presa%' OR

                                Titulo like '%Jose Octavio Lopez Presa%' OR
                                Titulo like '%Jose Octavio Lopez%' OR
                                Titulo like '%Jose Lopez Presa%' OR
                                Titulo like '%Octavio Lopez Presa%' OR

                                Encabezado like '%Jose Octavio Lopez Presa%' OR
                                Encabezado like '%Jose Octavio Lopez%' OR
                                Encabezado like '%Jose Lopez Presa%' OR
                                Encabezado like '%Octavio Lopez Presa%' OR

                                PieFoto like '%Jose Octavio Lopez Presa%' OR
                                PieFoto like '%Jose Octavio Lopez%' OR
                                PieFoto like '%Jose Lopez Presa%' OR
                                PieFoto like '%Octavio Lopez Presa%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 26:// José Octavio López Presa Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Jose Octavio Lopez Presa%' OR
                                Texto like '%Jose Octavio Lopez%' OR
                                Texto like '%Jose Lopez Presa%' OR
                                Texto like '%Octavio Lopez Presa%' OR

                                Titulo like '%Jose Octavio Lopez Presa%' OR
                                Titulo like '%Jose Octavio Lopez%' OR
                                Titulo like '%Jose Lopez Presa%' OR
                                Titulo like '%Octavio Lopez Presa%' OR

                                Encabezado like '%Jose Octavio Lopez Presa%' OR
                                Encabezado like '%Jose Octavio Lopez%' OR
                                Encabezado like '%Jose Lopez Presa%' OR
                                Encabezado like '%Octavio Lopez Presa%' OR

                                PieFoto like '%Jose Octavio Lopez Presa%' OR
                                PieFoto like '%Jose Octavio Lopez%' OR
                                PieFoto like '%Jose Lopez Presa%' OR
                                PieFoto like '%Octavio Lopez Presa%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 27:// Mariclare Acosta CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Mariclare Acosta%' OR

                                Titulo like '%Mariclare Acosta%' OR

                                Encabezado like '%Mariclare Acosta%' OR

                                PieFoto like '%Mariclare Acosta%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 28:// Mariclare Acosta Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Mariclare Acosta%' OR

                                Titulo like '%Mariclare Acosta%' OR

                                Encabezado like '%Mariclare Acosta%' OR

                                PieFoto like '%Mariclare Acosta%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;


            case 29:// Luis Manuel Pérez de Acha CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Luis Manuel Perez de Acha%' OR
                                Texto like '%Luis Manuel Perez%' OR
                                Texto like '%Luis Perez de Acha%' OR
                                Texto like '%Manuel Perez de Acha%' OR

                                Titulo like '%Luis Manuel Perez de Acha%' OR
                                Titulo like '%Luis Manuel Perez%' OR
                                Titulo like '%Luis Perez de Acha%' OR
                                Titulo like '%Manuel Perez de Acha%' OR

                                Encabezado like '%Luis Manuel Perez de Acha%' OR
                                Encabezado like '%Luis Manuel Perez%' OR
                                Encabezado like '%Luis Perez de Acha%' OR
                                Encabezado like '%Manuel Perez de Acha%' OR

                                PieFoto like '%Luis Manuel Perez de Acha%' OR
                                PieFoto like '%Luis Manuel Perez%' OR
                                PieFoto like '%Luis Perez de Acha%' OR
                                PieFoto like '%Manuel Perez de Acha%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 30:// Luis Manuel Pérez de Acha Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Luis Manuel Perez de Acha%' OR
                                Texto like '%Luis Manuel Perez%' OR
                                Texto like '%Luis Perez de Acha%' OR
                                Texto like '%Manuel Perez de Acha%' OR

                                Titulo like '%Luis Manuel Perez de Acha%' OR
                                Titulo like '%Luis Manuel Perez%' OR
                                Titulo like '%Luis Perez de Acha%' OR
                                Titulo like '%Manuel Perez de Acha%' OR

                                Encabezado like '%Luis Manuel Perez de Acha%' OR
                                Encabezado like '%Luis Manuel Perez%' OR
                                Encabezado like '%Luis Perez de Acha%' OR
                                Encabezado like '%Manuel Perez de Acha%' OR

                                PieFoto like '%Luis Manuel Perez de Acha%' OR
                                PieFoto like '%Luis Manuel Perez%' OR
                                PieFoto like '%Luis Perez de Acha%' OR
                                PieFoto like '%Manuel Perez de Acha%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;


            case 31:// Alfonso Hernández CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Alfonso Hernandez Valdez%' OR

                                Titulo like '%Alfonso Hernandez Valdez%' OR

                                Encabezado like '%Alfonso Hernandez Valdez%' OR

                                PieFoto like '%Alfonso Hernandez Valdez%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 32:// Alfonso Hernández Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Alfonso Hernandez Valdez%' OR

                                Titulo like '%Alfonso Hernandez Valdez%' OR

                                Encabezado like '%Alfonso Hernandez Valdez%' OR

                                PieFoto like '%Alfonso Hernandez Valdez%'
                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;


            case 33:// Auditoria Superior de la Federacion CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Auditoria superior de la federacion%' OR
                                Texto like '%Auditoria superior%' OR
                                Texto like '% ASF %' OR
                                
                                Titulo like '%Auditoria superior de la federacion%' OR
                                Titulo like '%Auditoria superior%' OR
                                Titulo like '% ASF %' OR
                                
                                Encabezado like '%Auditoria superior de la federacion%' OR
                                Encabezado like '%Auditoria superior%' OR
                                Encabezado like '% ASF %' OR
                                
                                PieFoto like '%Auditoria superior de la federacion%' OR
                                PieFoto like '%Auditoria superior%' OR
                                PieFoto like '% ASF %' OR
                                
                                Autor like '%Auditoria superior de la federacion%' OR
                                Autor like '%Auditoria superior%' OR
                                Autor like '% ASF %'
                        )AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado=9 AND p.tipo=1 AND  n.Activo=1
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY n.Periodico ";
            return $query;
            break;

            case 34:// Auditoria Superior de la Federacion Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto like '%Auditoria superior de la federacion%' OR
                                Texto like '%Auditoria superior%' OR
                                Texto like '% ASF %' OR
                                
                                Titulo like '%Auditoria superior de la federacion%' OR
                                Titulo like '%Auditoria superior%' OR
                                Titulo like '% ASF %' OR
                                
                                Encabezado like '%Auditoria superior de la federacion%' OR
                                Encabezado like '%Auditoria superior%' OR
                                Encabezado like '% ASF %' OR
                                
                                PieFoto like '%Auditoria superior de la federacion%' OR
                                PieFoto like '%Auditoria superior%' OR
                                PieFoto like '% ASF %' OR
                                
                                Autor like '%Auditoria superior de la federacion%' OR
                                Autor like '%Auditoria superior%' OR
                                Autor like '% ASF %'
                        )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            default:
            break;

    }
}
?>
