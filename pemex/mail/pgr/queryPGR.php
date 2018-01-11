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
        case 5:// procurador
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                          WHERE(
                    Texto like '%raul cervantes andrade%' OR
                    Texto like '%raul cervantes%' OR
                    Texto like '% Procurador general de la republica%' OR
                    Texto like '% cervantes andrade%' OR

                    Titulo like '%Raul Cervantes Andrade%' OR
                    Titulo like '% Procurador general de la republica%' OR
                    Titulo like '% Raul Cervantes%' OR
                    Titulo like '% Cervantes Andrade%' OR

                    Encabezado like '%Raul Cervantes Andrade%' OR
                    Encabezado like '% Procurador general de la republica%' OR
                    Encabezado like '% Raul Cervantes%' OR
                    Encabezado like '% Cervantes Andrade%' OR

                    PieFoto like '%Raul Cervantes Andrade%' OR
                    PieFoto like '% Procurador general de la republica%' OR
                    PieFoto like '% Raul Cervantes%' OR
                    PieFoto like '% Cervantes Andrade%' OR

                    Autor like '%Raul Cervantes Andrade%' OR
                    Autor like '% Procurador general de la republica%' OR
                    Autor like '% Raul Cervantes%' OR
                    Autor like '% Cervantes Andrade%'
                    )AND 

                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,50";
            return $query;  
            break;  
        case 6:// PGR
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                            WHERE
                            (
                    Texto like '%PGR%' OR
                    Texto like '%procuraduria general de la republica%' OR

                    Titulo like '%PGR%' OR
                    Titulo like '%procuraduria general de la republica%' OR

                    Encabezado like '%PGR%' OR
                    Encabezado like '%procuraduria general de la republica%' OR

                    PieFoto like '%PGR%' OR
                    PieFoto like '%procuraduria general de la republica%' OR

                    Autor like '%PGR%' OR
                    Autor like '%procuraduria general de la republica%'
                )
                AND
                 Texto not like '%ex Secretario%' AND
                 Texto not like '%ex funcionario%' AND
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                p.Estado=9 AND s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,29";
            return $query;  
            break;  
        case 7://  subprocuradurias
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                            WHERE(
                                Texto like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                                Texto like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                                Texto like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                                Texto like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                                Texto like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR

                                Titulo like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                                Titulo like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                                Titulo like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                                Titulo like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                                Titulo like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR

                                Encabezado like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                                Encabezado like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                                Encabezado like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                                Encabezado like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                                Encabezado like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR

                                PieFoto like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                                PieFoto like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                                PieFoto like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                                PieFoto like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                                PieFoto like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR

                                Autor like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                                Autor like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                                Autor like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                                Autor like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                                Autor like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%'

                            ) AND
            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;  
            break; 
        case 8://  Fiscalias
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                    WHERE (
                            Texto like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                            Texto like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                            Texto like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                            Texto like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR

                            Titulo like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                            Titulo like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                            Titulo like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                            Titulo like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
                            Encabezado like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                            Encabezado like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                            Encabezado like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                            Encabezado like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR

                            PieFoto like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                            PieFoto like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                            PieFoto like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                            PieFoto like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR

                            Autor like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                            Autor like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                            Autor like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                            Autor like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' 

                        )AND
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico";
            return $query;  
            break;  
        case 9://  Delegaciones
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                              WHERE(
                            Texto like'%delegacion PGR%' OR 
                            Texto like'%delegaciones PGR%' OR 
                            Texto like'%delegado PGR%' OR  
                            (Texto like'%delegacion%'  AND Texto like '%PGR%')   OR
                            
                            Titulo like'%delegacion PGR%' OR 
                            Titulo like'%delegaciones PGR%' OR 
                            Titulo like'%delegado PGR%' OR  
                            (Titulo like'%delegacion%' AND Titulo like '%PGR%')   OR
                            
                            Encabezado like'%delegacion PGR%' OR 
                            Encabezado like'%delegaciones PGR%' OR 
                            Encabezado like'%delegado PGR%' OR  
                            (Encabezado like'%delegacion%' AND Encabezado like '%PGR%')
                    ) AND 
                                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                                GROUP BY n.Periodico, n.NumeroPagina
                                ORDER BY n.Periodico";
            return $query;  
            break;   
        case 10://  Narcotrafico
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                       FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                            WHERE
                                (
                    Texto like '%Narcotrafico%' OR
                    Texto like '%Drogas%' OR
                    Texto like '%Carteles%' OR

                    Titulo like '%Narcotrafico%' OR
                    Titulo like '%Drogas%' OR
                    Titulo like '%Carteles%' OR

                    Encabezado like '%Narcotrafico%' OR
                    Encabezado like '%Drogas%' OR
                    Encabezado like '%Carteles%' OR

                    PieFoto like '%Narcotrafico%' OR
                    PieFoto like '%Drogas%' OR
                    PieFoto like '%Carteles%' OR

                    Autor like '%Narcotrafico%' OR
                    Autor like '%Drogas%' OR
                    Autor like '%Carteles%'

                )
                AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 11://  Secuestros
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                    WHERE(
                        Texto like '%Secuestros%' OR
                        Texto like '%Secuestrador%' OR
                        Titulo like '%Secuestros%' OR
                        Titulo like '%Secuestrador%' OR

                        Encabezado like '%Secuestros%' OR
                        Encabezado like '%Secuestrador%' OR

                        PieFoto like '%Secuestros%' OR
                        PieFoto like '%Secuestrador%' OR
                        
                        Autor like '%Secuestros%' OR
                        Autor like '%Secuestrador%'

                    )AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico";
            return $query;  
            break;        
        case 12://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                         WHERE(
                        Texto like '%Secuestros%' OR
                        Texto like '%Secuestrador%' OR
                        Texto like '%raul cervantes andrade%' OR
                        Texto like '%raul cervantes%' OR
                        Texto like '%Procurador general de la republica%' OR
                        Texto like '%cervantes andrade%' OR
                        Texto like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                        Texto like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                        Texto like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                        Texto like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                        Texto like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
                        Texto like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                        Texto like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                        Texto like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                        Texto like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
                        Texto like'%delegacion PGR%' OR 
                        Texto like'%delegaciones PGR%' OR 
                        Texto like'%delegado PGR%' OR  
                        (Texto like'%delegacion%'  AND Texto like '%PGR%')   OR
                        Texto like '%Narcotrafico%' OR
                        Texto like '%Drogas%' OR
                        Texto like '%Carteles%' OR
                        Texto like '%Secuestros%' OR
                        Texto like '%Secuestrador%' OR
                        Texto like '%Secuestradores%' OR

                        Titulo like '%Secuestros%' OR
                        Titulo like '%Secuestrador%' OR
                        Titulo like '%raul cervantes andrade%' OR
                        Titulo like '%raul cervantes%' OR
                        Titulo like '%Procurador general de la republica%' OR
                        Titulo like '%cervantes andrade%' OR
                        Titulo like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                        Titulo like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                        Titulo like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                        Titulo like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                        Titulo like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
                        Titulo like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                        Titulo like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                        Titulo like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                        Titulo like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
                        Titulo like'%delegacion PGR%' OR 
                        Titulo like'%delegaciones PGR%' OR 
                        Titulo like'%delegado PGR%' OR  
                        (Titulo like'%delegacion%'  AND Titulo like '%PGR%')   OR
                        Titulo like '%Narcotrafico%' OR
                        Titulo like '%Drogas%' OR
                        Titulo like '%Carteles%' OR
                        Titulo like '%Secuestros%' OR
                        Titulo like '%Secuestrador%' OR
                        Titulo like '%Secuestradores%' OR

                        Encabezado like '%Secuestros%' OR
                        Encabezado like '%Secuestrador%' OR
                        Encabezado like '%raul cervantes andrade%' OR
                        Encabezado like '%raul cervantes%' OR
                        Encabezado like '%Procurador general de la republica%' OR
                        Encabezado like '%cervantes andrade%' OR
                        Encabezado like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                        Encabezado like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                        Encabezado like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                        Encabezado like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                        Encabezado like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
                        Encabezado like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                        Encabezado like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                        Encabezado like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                        Encabezado like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
                        Encabezado like'%delegacion PGR%' OR 
                        Encabezado like'%delegaciones PGR%' OR 
                        Encabezado like'%delegado PGR%' OR  
                        (Encabezado like'%delegacion%'  AND Encabezado like '%PGR%')   OR
                        Encabezado like '%Narcotrafico%' OR
                        Encabezado like '%Drogas%' OR
                        Encabezado like '%Carteles%' OR
                        Encabezado like '%Secuestros%' OR
                        Encabezado like '%Secuestrador%' OR
                        Encabezado like '%Secuestradores%' OR

                        PieFoto like '%Secuestros%' OR
                        PieFoto like '%Secuestrador%' OR
                        PieFoto like '%raul cervantes andrade%' OR
                        PieFoto like '%raul cervantes%' OR
                        PieFoto like '%Procurador general de la republica%' OR
                        PieFoto like '%cervantes andrade%' OR
                        PieFoto like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                        PieFoto like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                        PieFoto like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                        PieFoto like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                        PieFoto like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
                        PieFoto like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                        PieFoto like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                        PieFoto like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                        PieFoto like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
                        PieFoto like'%delegacion PGR%' OR 
                        PieFoto like'%delegaciones PGR%' OR 
                        PieFoto like'%delegado PGR%' OR  
                        (PieFoto like'%delegacion%'  AND PieFoto like '%PGR%')   OR
                        PieFoto like '%Narcotrafico%' OR
                        PieFoto like '%Drogas%' OR
                        PieFoto like '%Carteles%' OR
                        PieFoto like '%Secuestros%' OR
                        PieFoto like '%Secuestrador%' OR
                        PieFoto like '%Secuestradores%' OR

                        Autor like '%Secuestros%' OR
                        Autor like '%Secuestrador%' OR
                        Autor like '%raul cervantes andrade%' OR
                        Autor like '%raul cervantes%' OR
                        Autor like '%Procurador general de la republica%' OR
                        Autor like '%cervantes andrade%' OR
                        Autor like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
                        Autor like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
                        Autor like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
                        Autor like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
                        Autor like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
                        Autor like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
                        Autor like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
                        Autor like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
                        Autor like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
                        Autor like'%delegacion PGR%' OR 
                        Autor like'%delegaciones PGR%' OR 
                        Autor like'%delegado PGR%' OR  
                        (Autor like'%delegacion%'  AND Autor like '%PGR%')   OR
                        Autor like '%Narcotrafico%' OR
                        Autor like '%Drogas%' OR
                        Autor like '%Carteles%' OR
                        Autor like '%Secuestros%' OR
                        Autor like '%Secuestrador%' OR
                        Autor like '%Secuestradores%' 
                    )AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;
            /************************QUERYS ESTADOS*****************************************/
            
        case 13: //Procurador Estados
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                    WHERE (
                    Texto like '%raul cervantes andrade%' OR
                    Texto like '%raul cervantes%' OR
                    Texto like '% Procurador general de la republica%' OR
                    Texto like '% cervantes andrade%' OR

                    Titulo like '%Raul Cervantes Andrade%' OR
                    Titulo like '% Procurador general de la republica%' OR
                    Titulo like '% Raul Cervantes%' OR
                    Titulo like '% Cervantes Andrade%' OR

                    Encabezado like '%Raul Cervantes Andrade%' OR
                    Encabezado like '% Procurador general de la republica%' OR
                    Encabezado like '% Raul Cervantes%' OR
                    Encabezado like '% Cervantes Andrade%' OR

                    PieFoto like '%Raul Cervantes Andrade%' OR
                    PieFoto like '% Procurador general de la republica%' OR
                    PieFoto like '% Raul Cervantes%' OR
                    PieFoto like '% Cervantes Andrade%' OR

                    Autor like '%Raul Cervantes Andrade%' OR
                    Autor like '% Procurador general de la republica%' OR
                    Autor like '% Raul Cervantes%' OR
                    Autor like '% Cervantes Andrade%'
                    )AND 
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                    AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
        break;
         case 14: //PGR Estados
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                    WHERE (
				Texto like '%PGR%' OR
				Texto like '%procuraduria general de la republica%' OR

				Titulo like '%PGR%' OR
				Titulo like '%procuraduria general de la republica%' OR

				Encabezado like '%PGR%' OR
				Encabezado like '%procuraduria general de la republica%' OR

				PieFoto like '%PGR%' OR
				PieFoto like '%procuraduria general de la republica%' OR

				Autor like '%PGR%' OR
				Autor like '%procuraduria general de la republica%'	
			)AND 
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                    AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
       break;
	case 15: //SUBPROCURADURIAS Estados
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                    WHERE (
				Texto like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				Texto like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				Texto like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				Texto like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				Texto like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR

				Titulo like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				Titulo like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				Titulo like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				Titulo like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				Titulo like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR

				Encabezado like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				Encabezado like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				Encabezado like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				Encabezado like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				Encabezado like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR

				PieFoto like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				PieFoto like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				PieFoto like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				PieFoto like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				PieFoto like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
	
				Autor like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				Autor like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				Autor like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				Autor like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				Autor like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%'
			)AND 
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                    AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
       break;
	case 16: //FISCALIAS Estados
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                    WHERE (
				Texto like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				Texto like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				Texto like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				Texto like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR

				Titulo like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				Titulo like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				Titulo like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				Titulo like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
				
				Encabezado like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				Encabezado like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				Encabezado like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				Encabezado like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR

				PieFoto like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				PieFoto like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				PieFoto like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				PieFoto like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR

				Autor like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				Autor like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				Autor like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				Autor like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%'
			)AND 
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                    AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
       break;
	case 17: //DELEGACIONES Estados
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                    WHERE (
				Texto like'%delegacion PGR%' OR 
				Texto like'%delegaciones PGR%' OR 
				Texto like'%delegado PGR%' OR  
				(Texto like'%delegacion%'  AND Texto like '%PGR%')   OR
							            
				Titulo like'%delegacion PGR%' OR 
				Titulo like'%delegaciones PGR%' OR 
				Titulo like'%delegado PGR%' OR  
				(Titulo like'%delegacion%' AND Titulo like '%PGR%')   OR
											            
				Encabezado like'%delegacion PGR%' OR 
				Encabezado like'%delegaciones PGR%' OR 
				Encabezado like'%delegado PGR%' OR  
				(Encabezado like'%delegacion%' AND Encabezado like '%PGR%')
			)AND 
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                    AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
       break;
	case 18: //NARCOTRAFICO Estados
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                    WHERE (
				Texto like '%Narcotrafico%' OR
				Texto like '%Drogas%' OR
				(Texto like '%Carteles%' AND Texto like '%Carteles%' )  OR

				Titulo like '%Narcotrafico%' OR
				Titulo like '%Drogas%' OR
				(Titulo like '%Carteles%' AND Titulo like '%Carteles%' ) OR

				Encabezado like '%Narcotrafico%' OR
				Encabezado like '%Drogas%' OR
				(Encabezado like '%Cartel%' AND Encabezado like '%Droga%' )  OR

				PieFoto like '%Narcotrafico%' OR
				PieFoto like '%Drogas%' OR
				(PieFoto like '%Cartel%' AND PieFoto like '%Droga%' )  OR

				Autor like '%Narcotrafico%' OR
				Autor like '%Drogas%' OR
				(Autor like '%Cartel%' AND Autor like '%Droga%' ) 
			)AND 
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                    AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
       break;
	case 19: //SECUESTROS Estados
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                    WHERE (
				Texto like '%Secuestros%' OR
				Texto like '%Secuestrador%' OR
	
				Titulo like '%Secuestros%' OR
				Titulo like '%Secuestrador%' OR

				Encabezado like '%Secuestros%' OR
				Encabezado like '%Secuestrador%' OR

				PieFoto like '%Secuestros%' OR
				PieFoto like '%Secuestrador%' OR
												
				Autor like '%Secuestros%' OR
				Autor like '%Secuestrador%'
			)AND 
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                    AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
       break;
	case 20: //Varios Estados
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                    WHERE (
				Texto like '%Secuestros%' OR
				Texto like '%Secuestrador%' OR
				Texto like '%raul cervantes andrade%' OR
				Texto like '%raul cervantes%' OR
				Texto like '%Procurador general de la republica%' OR
				Texto like '%cervantes andrade%' OR
				Texto like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				Texto like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				Texto like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				Texto like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				Texto like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
				Texto like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				Texto like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				Texto like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				Texto like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
				Texto like'%delegacion PGR%' OR 
				Texto like'%delegaciones PGR%' OR 
				Texto like'%delegado PGR%' OR  
				(Texto like'%delegacion%'  AND Texto like '%PGR%')   OR
				Texto like '%Narcotrafico%' OR
				Texto like '%Drogas%' OR
				Texto like '%Carteles%' OR
				Texto like '%Secuestros%' OR
				Texto like '%Secuestrador%' OR
				Texto like '%Secuestradores%' OR

				Titulo like '%Secuestros%' OR
				Titulo like '%Secuestrador%' OR
				Titulo like '%raul cervantes andrade%' OR
				Titulo like '%raul cervantes%' OR
				Titulo like '%Procurador general de la republica%' OR
				Titulo like '%cervantes andrade%' OR
				Titulo like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				Titulo like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				Titulo like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				Titulo like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				Titulo like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
				Titulo like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				Titulo like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				Titulo like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				Titulo like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
				Titulo like'%delegacion PGR%' OR 
				Titulo like'%delegaciones PGR%' OR 
				Titulo like'%delegado PGR%' OR  
				(Titulo like'%delegacion%'  AND Titulo like '%PGR%')   OR
				Titulo like '%Narcotrafico%' OR
				Titulo like '%Drogas%' OR
				Titulo like '%Carteles%' OR
				Titulo like '%Secuestros%' OR
				Titulo like '%Secuestrador%' OR
				Titulo like '%Secuestradores%' OR

				Encabezado like '%Secuestros%' OR
				Encabezado like '%Secuestrador%' OR
				Encabezado like '%raul cervantes andrade%' OR
				Encabezado like '%raul cervantes%' OR
				Encabezado like '%Procurador general de la republica%' OR
				Encabezado like '%cervantes andrade%' OR
				Encabezado like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				Encabezado like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				Encabezado like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				Encabezado like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				Encabezado like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
				Encabezado like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				Encabezado like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				Encabezado like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				Encabezado like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
				Encabezado like'%delegacion PGR%' OR 
				Encabezado like'%delegaciones PGR%' OR 
				Encabezado like'%delegado PGR%' OR  
				(Encabezado like'%delegacion%'  AND Encabezado like '%PGR%')   OR
				Encabezado like '%Narcotrafico%' OR
				Encabezado like '%Drogas%' OR
				Encabezado like '%Carteles%' OR
				Encabezado like '%Secuestros%' OR
				Encabezado like '%Secuestrador%' OR
				Encabezado like '%Secuestradores%' OR

				PieFoto like '%Secuestros%' OR
				PieFoto like '%Secuestrador%' OR
				PieFoto like '%raul cervantes andrade%' OR
				PieFoto like '%raul cervantes%' OR
				PieFoto like '%Procurador general de la republica%' OR
				PieFoto like '%cervantes andrade%' OR
				PieFoto like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				PieFoto like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				PieFoto like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				PieFoto like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				PieFoto like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
				PieFoto like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				PieFoto like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				PieFoto like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				PieFoto like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
				PieFoto like'%delegacion PGR%' OR 
				PieFoto like'%delegaciones PGR%' OR 
				PieFoto like'%delegado PGR%' OR  
				(PieFoto like'%delegacion%'  AND PieFoto like '%PGR%')   OR
				PieFoto like '%Narcotrafico%' OR
				PieFoto like '%Drogas%' OR
				PieFoto like '%Carteles%' OR
				PieFoto like '%Secuestros%' OR
				PieFoto like '%Secuestrador%' OR
				PieFoto like '%Secuestradores%' OR

				Autor like '%Secuestros%' OR
				Autor like '%Secuestrador%' OR
				Autor like '%raul cervantes andrade%' OR
				Autor like '%raul cervantes%' OR
				Autor like '%Procurador general de la republica%' OR
				Autor like '%cervantes andrade%' OR
				Autor like '%Subprocuraduria Juridica y de Asuntos Internacionales%' OR
				Autor like '%Subprocuraduria de Control Regional, Procedimientos Penales y Amparo%' OR
				Autor like '%Subprocuraduria Especializada en Investigacion de Delincuencia Organizada%' OR
				Autor like '%Subprocuraduria Especializada en Investigacion de Delitos Federales%' OR
				Autor like '%Subprocuraduria de Derechos Humanos y Prevencion del Delito y Servicios a la Comunidad%' OR
				Autor like '%Fiscalia Especial para los Delitos de Violencia contra las Mujeres y Trata de Personas%' OR
				Autor like '%Fiscalia Especializada para la Atencion de Delitos Electorales%' OR
				Autor like '%Fiscalia Especial para la Atencion de Delitos Cometidos contra la Libertad de Expresion%' OR
				Autor like '%Fiscalia Especializada en Busqueda de Personas Desaparecidas%' OR
				Autor like'%delegacion PGR%' OR 
				Autor like'%delegaciones PGR%' OR 
				Autor like'%delegado PGR%' OR  
				(Autor like'%delegacion%'  AND Autor like '%PGR%')   OR
				Autor like '%Narcotrafico%' OR
				Autor like '%Drogas%' OR
				Autor like '%Carteles%' OR
				Autor like '%Secuestros%' OR
				Autor like '%Secuestrador%' OR
				Autor like '%Secuestradores%' 
			)AND 
                    n.Periodico=p.idPeriodico AND
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                    AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
       break;








        }
    }
