<?php
function query($op,$Tabla){
       $fecha=$Tabla;
       $FechaCliente = strtotime($Tabla);

        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);

        if ($FechaCliente == $fecha_actual)
        {
            $Tabla="noticiasDia";
        }
        else
        {
            $Tabla="noticiasSemana";
        }

        switch ($op){
            case 1:
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                      Texto like '%Miguel Castro Reynoso%' OR
                     Texto like '%Miguel Castro%' OR
                     Texto like '%Castro Reynoso%' OR

                     Titulo like '%Miguel Castro Reynoso%' OR
                     Titulo like '%Miguel Castro%' OR
                     Titulo like '%Castro Reynoso%' OR

                     Encabezado like '%Miguel Castro Reynoso%' OR
                     Encabezado like '%Miguel Castro%' OR
                     Encabezado like '%Castro Reynoso%' OR

                     PieFoto like '%Miguel Castro Reynoso%' OR
                     PieFoto like '%Miguel Castro%' OR
                     PieFoto like '%Castro Reynoso%' OR

                     Autor like '%Miguel Castro Reynoso%' OR
                     Autor like '%Miguel Castro%' OR
                     Autor like '%Castro Reynoso%'
                      )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;
            break;// Cartones DF
        /*
            case 4:// enrique Alfaro Ramirez
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '%Enrique Alfaro Ramirez%' OR
                            Texto like '%Enrique Alfaro%' OR
                            Texto like '%Alfaro Ramirez%' OR

                            Titulo like '%Enrique Alfaro Ramirez%' OR
                            Titulo like '%Enrique Alfaro%' OR
                            Titulo like '%Alfaro Ramirez%' OR

                            Encabezado like '%Enrique Alfaro Ramirez%' OR
                            Encabezado like '%Enrique Alfaro%' OR
                            Encabezado like '%Alfaro Ramirez%' OR

                            PieFoto like '%Enrique Alfaro Ramirez%' OR
                            PieFoto like '%Enrique Alfaro%' OR
                            PieFoto like '%Alfaro Ramirez%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  //alfaro Rmairez
        break;

            case 7://Alfonso Petersen Farah
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '%Alfonso Petersen Farah%' OR
                            Texto like '%Alfonso Petersen%' OR

                            Titulo like '%Alfonso Petersen Farah%' OR
                            Titulo like '%Alfonso Petersen%' OR

                            Encabezado like '%Alfonso Petersen Farah%' OR
                            Encabezado like '%Alfonso Petersen%' OR

                            PieFoto like '%Alfonso Petersen Farah%' OR
                            PieFoto like '%Alfonso Petersen%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  //Alfonso Petersen Farah
        break;
    */
            case 10:// Guadalajara
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '%Guadalajara%' OR
                            Texto like '% GDL %' OR

                            Titulo like '%Guadalajara%' OR
                            Titulo like '% GDL %' OR

                            Encabezado like '%Guadalajara%' OR
                            Encabezado like '% GDL %' OR

                            PieFoto like '%Guadalajara%' OR
                            PieFoto like '% GDL %'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  //Guadalajara
            break;

            case 13:
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
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o, seccionesPeriodicos s, categoriasPeriodicos c,estados e
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
            break;//Primeras Planas Jalisco
            case 14:
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
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.id
                    ";
                return $query;
            break;//Columnas

            case 16:
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
            break;//Primeras Planas DF

            case 17:
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
                    ORDER BY o.id";
            return $query;
            break;//Políticas DF

            case 18:
                $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico',
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
                    GROUP BY n.idEditorial";
                return $query;
            break;    //Financieras DF
        }

}
