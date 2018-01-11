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
        case 5:// hector pablo ramirez puga leyva
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                          WHERE(
                Texto like '%secretario De gobernacion%' OR
            Texto like '%titular de la SEGOB%' OR
            Texto like '%titular de la secretaria de gobernacion%' OR
            Texto like '%miguel angel osorio chong%' OR  
            Texto like 'miguel angel osorio chong' OR
            Texto like 'miguel osorio' OR
            Texto like '%Miguel Angel osorio%' OR    
            Texto like '%Osorio Chong%' OR
            Texto like '%Osorio Chong%' OR
            Texto like '%sorio Chong%' OR
            Texto like '%OsorioChong%' OR
            Texto like '%sorio C hong%' OR
            Texto like '%sorio C h on g%' OR
            Texto like '%secretario Chong%' OR
            Texto like '%gobernachong%' OR
            Texto like '% chong %' OR
            Texto like '%chong %' OR

            Titulo like '%secretario De gobernacion%' OR
            Titulo like '%titular de la SEGOB%' OR
            Titulo like '%titular de la secretaria de gobernacion%' OR
            Titulo like '%miguel angel osorio chong%' OR  
            Titulo like 'miguel angel osorio chong' OR
            Titulo like 'miguel osorio' OR
            Titulo like '%Miguel Angel osorio%' OR    
            Titulo like '%Osorio Chong%' OR
            Titulo like '%Osorio Chong%' OR
            Titulo like '%sorio Chong%' OR
            Titulo like '%OsorioChong%' OR
            Titulo like '%sorio C hong%' OR
            Titulo like '%sorio C h on g%' OR
            Titulo like '%secretario Chong%' OR
            Titulo like '%gobernachong%' OR
            Titulo like '%chong %' OR

            Encabezado like '%secretario De gobernacion%' OR
            Encabezado like '%titular de la SEGOB%' OR
            Encabezado like '%titular de la secretaria de gobernacion%' OR
            Encabezado like '%miguel angel osorio chong%' OR  
            Encabezado like 'miguel angel osorio chong' OR
            Encabezado like 'miguel osorio' OR
            Encabezado like '%Miguel Angel osorio%' OR    
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%sorio Chong%' OR
            Encabezado like '%OsorioChong%' OR
            Encabezado like '%sorio C hong%' OR
            Encabezado like '%sorio C h on g%' OR
            Encabezado like '%secretario Chong%' OR
            Encabezado like '%gobernachong%' OR
            Encabezado like '%chong %'
           )AND
            (
                (Texto like '%Secretario de Gobernacion%' AND Texto not like '%ex secretario de Gobernacion%') OR
                (Texto like '%Miguel Angel%' AND Texto like '%Osorio%') OR 
                (Texto like '%Miguel Angel %' AND Texto like '%Osorio%')OR 
                (Texto like '%Miguel%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%Miguel A.%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%titular de la SEGOB%' OR  Texto like '%Osorio Chong%' OR Texto like '%secretario chong%' OR Texto like '%Chong%') OR 
                
                (Titulo like '%Miguel Angel%' AND Titulo like '%Osorio%') OR 
                (Titulo like '%Miguel Angel %' AND Titulo like '%Osorio%')OR 
                (Titulo like '%Miguel%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%Miguel A.%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%titular de la SEGOB%' OR  Titulo like '%Osorio Chong%' OR Titulo like '%secretario chong%') 
          )AND 

                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,50";
            return $query;  
            break;  
        case 6:// GERENCIA
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
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
        case 9://  SEDESOL
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                              WHERE(
                                    Texto like'%Unidad Para El Desarrollo Politico%'OR
                                    Texto like'%zoad Faride Rodriguez Velasco%' OR
                                    Texto like'%zoad Faride Rodriguez%' OR 
                                    Texto like'%zoad Faride%' OR
                                    Texto like'%zoad Rodriguez Velasco%' OR
                                    Texto like'%zoad Rodriguez%' OR

                                    Titulo like'%Unidad Para El Desarrollo Politico%'OR
                                    Titulo like'%zoad Faride Rodriguez Velasco%' OR
                                    Titulo like'%zoad Faride Rodriguez%' OR
                                    Titulo like '%zoad Faride%' OR
                                    Titulo like'%zoad Rodriguez Velasco%' OR
                                    Titulo like'%zoad Rodriguez%' OR

                                    Encabezado like'%Unidad Para El Desarrollo Politico%'OR
                                    Encabezado like'%zoad Faride Rodriguez Velasco%' OR
                                    Encabezado like'%zoad Faride Rodriguez%' OR
                                    Encabezado like '%zoad Faride%' OR
                                    Encabezado like'%zoad Rodriguez Velasco%' OR
                                    Encabezado like'%zoad Rodriguez%'
                                   ) AND 
                                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                                GROUP BY n.Periodico, n.NumeroPagina
                                ORDER BY n.Periodico";
            return $query;  
            break;   
        case 10://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                       FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                            WHERE
                (
                    Texto like '%asuntos juridicos y derechos humanos%' OR
                    Texto like '%lia limon garcia%' OR
                    Texto like '%lia limon%' OR

                    Titulo like '%asuntos juridicos y derechos humanos%' OR
                    Titulo like '%lia limon garcia%' OR
                    Titulo like '%lia limon%' OR

                    Encabezado like '%asuntos juridicos y derechos humanos%' OR
                    Encabezado like '%lia limon garcia%' OR
                    Encabezado like '%lia limon%'
                )
                AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 11://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                           WHERE(
                        Texto like '%poblacion, migracion y asuntos religioso%' OR
                        Texto like '%mercedes del Carmen guillen vicente%' OR
                        Texto like '%mercedes guillen%' OR

                        Titulo like '%poblacion, migracion y asuntos religioso%' OR
                        Titulo like '%mercedes del Carmen guillen vicente%' OR
                        Titulo like '%mercedes guillen%' OR

                        Encabezado like '%poblacion, migracion y asuntos religioso%' OR
                        Encabezado like '%mercedes del Carmen guillen vicente%' OR
                        Encabezado like '%mercedes guillen%'
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
                         WHERE((
                                Texto like '%normatividad de medios%' OR
                                Texto like '%Radio, Television y Cinematografia%' OR
                                Texto like '%medios impresos%' OR
                                Texto like '%normatividad de comunicacion%' OR
                                Texto like '%eduardo sanchez hernandez%' AND (Texto like '%SEGOB%' OR Texto like '%subsecretaria%') OR
                                Texto like '%eduardo sanchez%' AND (Texto like '%SEGOB%' OR Texto like '%subsecretaria%') OR
                                Texto like '%subsecretario de Normatividad de Medios de Gobernacion%' OR


                                Titulo like '%normatividad de medios%' OR
                                Titulo like '%Radio, Television y Cinematografia%' OR
                                Titulo like '%medios impresos%' OR
                                Titulo like '%normatividad de comunicacion%' OR
                                Titulo like '%eduardo sanchez hernandez%' AND (Titulo like '%SEGOB%' OR Titulo like '%subsecretaria%') OR
                                Titulo like '%eduardo sanchez%'           AND (Titulo like '%SEGOB%' OR Titulo like '%subsecretaria%') OR
                                Titulo like '%subsecretario de Normatividad de Medios de Gobernacion%' OR



                                Encabezado like '%normatividad de medios%' OR
                                Encabezado like '%Radio, Television y Cinematografia%' OR
                                Encabezado like '%medios impresos%' OR
                                Encabezado like '%normatividad de comunicacion%' OR
                                Encabezado like '%eduardo sanchez hernandez%' AND (Encabezado like '%SEGOB%' OR Encabezado like '%subsecretaria%') OR
                                Encabezado like '%eduardo sanchez%'           AND (Encabezado like '%SEGOB%' OR Encabezado like '%subsecretaria%') OR
                                Encabezado like '%subsecretario de Normatividad de Medios de Gobernacion%'
                               ))AND (Texto like '%gobernacion%' OR Texto like '%segob%' OR Texto like '%secretaria de gobernacion%')AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 13://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                            WHERE(
                    Texto like '%subsecretaria de prevencion y participacion ciudadana%' OR
                    Texto like '%prevencion y participacion ciudadana%' OR
                    Texto like '%participacion ciudadana%' AND (Texto like '%segob%' OR Texto like '%subsecretaria%') OR
                    Texto like '%roberto campa cifiran%' OR
                    Texto like '%roberto campa%' OR

                    Titulo like '%subsecretaria de prevencion y participacion ciudadana%' OR
                    Titulo like '%prevencion y participacion ciudadana%' OR
                    Titulo like '%participacion ciudadana%' AND (Texto like '%segob%' OR Texto like '%subsecretaria%') OR
                    Titulo like '%roberto campa cifiran%' OR
                    Titulo like '%roberto campa%' OR


                    Encabezado like '%subsecretaria de prevencion y participacion ciudadana%' OR
                    Encabezado like '%prevencion y participacion ciudadana%' OR
                    Encabezado like '%participacion ciudadana%' AND (Texto like '%segob%' OR Texto like '%subsecretaria%') OR
                    Encabezado like '%roberto campa cifiran%' OR
                    Encabezado like '%roberto campa%'
                   )AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 14://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                    WHERE(
                        Texto like '%oficialia mayor%' AND (Texto like '%segob%' OR texto like '%gobernacion%') OR
                        Texto like '%Jorge Marquez Montes%' OR
                        Texto like '%Jorge Marquez%' AND (Texto like '%segob%' OR Texto like '%gobernacion%') OR


                        Titulo like '%oficialia mayor%' AND (Titulo like '%segob%' OR Titulo like '%gobernacion%') OR
                        Titulo like '%Jorge Marquez Montes%' OR
                        Titulo like '%Jorge Marquez%' AND (Titulo like '%segob%' OR Titulo like '%gobernacion%') OR

                        Encabezado like '%oficialia mayor%' AND (Encabezado like '%segob%' OR Encabezado like '%gobernacion%') OR
                        Encabezado like '%Jorge Marquez Montes%' OR
                        Encabezado like '%Jorge Marquez%' AND (Encabezado like '%segob%' OR Encabezado like '%gobernacion%')
                     )AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 15://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                      WHERE(
                            Texto like '%Coordinacion General De proteccion civil%' OR
                            Texto like '%coordinacion nacional de proteccion civil%' OR
                            Texto like '%coordinacion nacional %' AND (Texto like '%proteccion civil%') OR
                            Texto like '%luis felipe puente Espinosa%' OR
                            Texto like '%luis felipe puente%' OR
                            Texto like '%luis puente Espinosa%' OR
                            Texto like '%luisfelipepuenteEspinosa%' OR
                            Texto like '%luis f elipe p uente e spinosa%' OR
                            Texto like '%luis felipep uentee spinosa%' OR

                            Titulo like '%Coordinacion General De proteccion civil%' OR
                            Titulo like '%coordinacion nacional de proteccion civil%' OR
                            Titulo like '%coordinacion nacional %' AND (Titulo like '%proteccion civil%') OR
                            Titulo like '%luis felipe puente Espinosa%' OR
                            Titulo like '%luis felipe puente%' OR
                            Titulo like '%luis puente Espinosa%' OR
                            Titulo like '%luisfelipepuenteEspinosa%' OR
                            Titulo like '%luis f elipe p uente E spinosa%' OR
                            Titulo like '%luis felipep uenteE spinosa%' OR

                            Encabezado like '%Coordinacion General De proteccion civil%' OR
                            Encabezado like '%coordinacion nacional de proteccion civil%' OR
                            Encabezado like '%coordinacion nacional%' AND (Encabezado like '%proteccion civil%') OR
                            Encabezado like '%luis felipe puente Espinosa%' OR
                            Encabezado like '%luis felipe puente%' OR
                            Encabezado like '%luis puente Espinosa%' OR
                            Encabezado like '%luisfelipepuenteEspinosa%' OR
                            Encabezado like '%luis f elipe p uente E spinosa%' OR
                            Encabezado like '%luis felipep uenteE spinosa%'
                        )AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico";
            return $query;  
            break;        
        case 16://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                            WHERE(
                                    Texto like'%Comision para el Dialogo con los Pueblos Indigenas de Mexico%' OR
                                    Texto like'%Comision para los Pueblos Indigenas de Mexico%' OR
                                    Texto like'%juan martinez veloz%' OR
                                    Texto like'%juan martinez%' AND (Texto like '%subsecretario%' OR Texto like '%segob%') OR
                                    Texto like'%martinez veloz%' OR
                                    Texto like'%martinezveloz%' OR

                                    Titulo like'%Comision para el Dialogo con los Pueblos Indigenas de Mexico%' OR
                                    Titulo like'%Comision para los Pueblos Indigenas de Mexico%' OR
                                    Titulo like'%juan martinez veloz%' OR
                                    Titulo like'%juan martinez%' AND (Titulo like '%subsecretario%' OR Titulo like '%segob%') OR
                                    Titulo like'%martinez veloz%' OR
                                    Titulo like'%martinezveloz%' OR

                                    Encabezado like'%Comision para el Dialogo con los Pueblos Indigenas de Mexico%' OR
                                    Encabezado like'%Comision para los Pueblos Indigenas de Mexico%' OR
                                    Encabezado like'%juan martinez veloz%' OR
                                    Encabezado like'%juan martinez%' AND (Encabezado like '%subsecretario%' OR Encabezado like '%segob%') OR
                                    Encabezado like'%martinez veloz%' OR
                                    Encabezado like'%martinezveloz%'
                                   )AND 
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico";
            return $query;  
            break;        
        case 17://  CNS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                        WHERE(
                            Texto like '%CNS %' OR
                            Texto like '%(CNS)%' OR
                            Texto like '% cns,%' OR
                            Texto like '% cns.%' OR
                            Texto like '% cns:%' OR
                            Texto like '% cns?%' OR
                            Texto like '% cns!%' OR
                            Texto like '%comision nacional de seguridad%' and texto not like '%nuclear%' OR
                            Texto like 'comision nacional de seguridad' and texto not like '%nuclear%' OR
                            Texto like '%cefereso%' OR
                            Texto like '%oadprs%' OR

                            Titulo like '% CNS %' OR
                            Titulo like '% cns,%' OR
                            Titulo like '% cns.%' OR
                            Titulo like '% cns:%' OR
                            Titulo like '% cns?%' OR
                            Titulo like '% cns!%' OR
                            Titulo like '%comision nacional de seguridad%' and Titulo not like '%nuclear%' OR
                            Titulo like 'comision nacional de seguridad' and Titulo not like '%nuclear%' OR
                            Titulo like '%cefereso%' OR
                            Titulo like '%oadprs%' OR

                            Encabezado like '% CNS %' OR
                            Encabezado like '% cns,%' OR
                            Encabezado like '% cns.%' OR
                            Encabezado like '% cns:%' OR
                            Encabezado like '% cns?%' OR
                            Encabezado like '% cns!%' OR
                            Encabezado like '%comision nacional de seguridad%' and Encabezado not like '%nuclear%' OR
                            Encabezado like 'comision nacional de seguridad' and Encabezado not like '%nuclear%' OR
                            Encabezado like '%cefereso%' OR
                            Encabezado like '%oadprs%'
                        )AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico";
            return $query;  
            break;        
        case 18://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                           WHERE(
                                Texto like'%SEGOB%'OR
                                Texto like'%Gobernacion%' OR
                                Texto like'%plan nacional de desarrollo%' OR
                                Texto like'%igualdad laboral%' OR
                                Texto like'%emergencia para los municipios%' OR
                                Texto like'%fonden%' OR  
                                Texto like'%pgr%' OR 
                                Texto like'%cns%' OR 
                                Texto like'%sedena%' OR 
                                Texto like'%semar%' OR  
                                Titulo like'%SEGOB%'OR
                                Titulo like'%Gobernacion%' OR
                                Titulo like'%plan nacional de desarrollo%' OR
                                Titulo like'%igualdad laboral%' OR
                                Titulo like'%emergencia para los municipios%' OR
                                Titulo like'%fonden%' OR  
                                Titulo like'%pgr%' OR 
                                Titulo like'%cns%' OR 
                                Titulo like'%sedena%' OR 
                                Titulo like'%semar%' OR 
                                Encabezado like'%SEGOB%'OR
                                Encabezado like'%Gobernacion%' OR
                                Encabezado like'%plan nacional de desarrollo%' OR
                                Encabezado like'%igualdad laboral%' OR
                                Encabezado like'%emergencia para los municipios%' OR
                                Encabezado like'%fonden%' OR  
                                Encabezado like'%pgr%' OR 
                                Encabezado like'%cns%' OR 
                                Encabezado like'%sedena%' OR 
                                Encabezado like'%semar%'  
                            )AND 
                        n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY n.Periodico limit 0,40";
            return $query;  
            break;   


        /**********************Queries para estados**************************/

        case 19:
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                Texto like '%secretario De gobernacion%' OR
            Texto like '%titular de la SEGOB%' OR
            Texto like '%titular de la secretaria de gobernacion%' OR
            Texto like '%miguel angel osorio chong%' OR  
            Texto like 'miguel angel osorio chong' OR
            Texto like 'miguel osorio' OR
            Texto like '%Miguel Angel osorio%' OR    
            Texto like '%Osorio Chong%' OR
            Texto like '%Osorio Chong%' OR
            Texto like '%sorio Chong%' OR
            Texto like '%OsorioChong%' OR
            Texto like '%sorio C hong%' OR
            Texto like '%sorio C h on g%' OR
            Texto like '%secretario Chong%' OR
            Texto like '%gobernachong%' OR
            Texto like '% chong %' OR
            Texto like '%chong %' OR

            Titulo like '%secretario De gobernacion%' OR
            Titulo like '%titular de la SEGOB%' OR
            Titulo like '%titular de la secretaria de gobernacion%' OR
            Titulo like '%miguel angel osorio chong%' OR  
            Titulo like 'miguel angel osorio chong' OR
            Titulo like 'miguel osorio' OR
            Titulo like '%Miguel Angel osorio%' OR    
            Titulo like '%Osorio Chong%' OR
            Titulo like '%Osorio Chong%' OR
            Titulo like '%sorio Chong%' OR
            Titulo like '%OsorioChong%' OR
            Titulo like '%sorio C hong%' OR
            Titulo like '%sorio C h on g%' OR
            Titulo like '%secretario Chong%' OR
            Titulo like '%gobernachong%' OR
            Titulo like '%chong %' OR

            Encabezado like '%secretario De gobernacion%' OR
            Encabezado like '%titular de la SEGOB%' OR
            Encabezado like '%titular de la secretaria de gobernacion%' OR
            Encabezado like '%miguel angel osorio chong%' OR  
            Encabezado like 'miguel angel osorio chong' OR
            Encabezado like 'miguel osorio' OR
            Encabezado like '%Miguel Angel osorio%' OR    
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%sorio Chong%' OR
            Encabezado like '%OsorioChong%' OR
            Encabezado like '%sorio C hong%' OR
            Encabezado like '%sorio C h on g%' OR
            Encabezado like '%secretario Chong%' OR
            Encabezado like '%gobernachong%' OR
            Encabezado like '%chong %'
           )AND
            (
                (Texto like '%Secretario de Gobernacion%' AND Texto not like '%ex secretario de Gobernacion%') OR
                (Texto like '%Miguel Angel%' AND Texto like '%Osorio%') OR 
                (Texto like '%Miguel Angel %' AND Texto like '%Osorio%')OR 
                (Texto like '%Miguel%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%Miguel A.%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%titular de la SEGOB%' OR  Texto like '%Osorio Chong%' OR Texto like '%secretario chong%' OR Texto like '%Chong%') OR 
                
                (Titulo like '%Miguel Angel%' AND Titulo like '%Osorio%') OR 
                (Titulo like '%Miguel Angel %' AND Titulo like '%Osorio%')OR 
                (Titulo like '%Miguel%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%Miguel A.%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%titular de la SEGOB%' OR  Titulo like '%Osorio Chong%' OR Titulo like '%secretario chong%') 
          )AND 

                n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,50";
            return $query;  
            break;  
        case 20:// GERENCIA
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
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
               )
                AND
                 Texto not like '%ex Secretario%' AND
                 Texto not like '%ex funcionario%' AND
                n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,29";
            return $query;  
            break;  
        case 21://  LICONSA
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
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
            n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;  
            break; 
        case 22://  LECHE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
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
            n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;  
            break;  
        case 23://  SEDESOL
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                                    Texto like'%Unidad Para El Desarrollo Politico%'OR
                                    Texto like'%zoad Faride Rodriguez Velasco%' OR
                                    Texto like'%zoad Faride Rodriguez%' OR 
                                    Texto like'%zoad Faride%' OR
                                    Texto like'%zoad Rodriguez Velasco%' OR
                                    Texto like'%zoad Rodriguez%' OR

                                    Titulo like'%Unidad Para El Desarrollo Politico%'OR
                                    Titulo like'%zoad Faride Rodriguez Velasco%' OR
                                    Titulo like'%zoad Faride Rodriguez%' OR
                                    Titulo like '%zoad Faride%' OR
                                    Titulo like'%zoad Rodriguez Velasco%' OR
                                    Titulo like'%zoad Rodriguez%' OR

                                    Encabezado like'%Unidad Para El Desarrollo Politico%'OR
                                    Encabezado like'%zoad Faride Rodriguez Velasco%' OR
                                    Encabezado like'%zoad Faride Rodriguez%' OR
                                    Encabezado like '%zoad Faride%' OR
                                    Encabezado like'%zoad Rodriguez Velasco%' OR
                                    Encabezado like'%zoad Rodriguez%'
                                   ) AND 
                                n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                                GROUP BY n.Periodico, n.NumeroPagina
                                ORDER BY n.Periodico";
            return $query;  
            break;   
        case 24://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE
                (
                    Texto like '%asuntos juridicos y derechos humanos%' OR
                    Texto like '%lia limon garcia%' OR
                    Texto like '%lia limon%' OR

                    Titulo like '%asuntos juridicos y derechos humanos%' OR
                    Titulo like '%lia limon garcia%' OR
                    Titulo like '%lia limon%' OR

                    Encabezado like '%asuntos juridicos y derechos humanos%' OR
                    Encabezado like '%lia limon garcia%' OR
                    Encabezado like '%lia limon%'
                )
                AND 
                n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 25://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                        Texto like '%poblacion, migracion y asuntos religioso%' OR
                        Texto like '%mercedes del Carmen guillen vicente%' OR
                        Texto like '%mercedes guillen%' OR

                        Titulo like '%poblacion, migracion y asuntos religioso%' OR
                        Titulo like '%mercedes del Carmen guillen vicente%' OR
                        Titulo like '%mercedes guillen%' OR

                        Encabezado like '%poblacion, migracion y asuntos religioso%' OR
                        Encabezado like '%mercedes del Carmen guillen vicente%' OR
                        Encabezado like '%mercedes guillen%'
                   )AND 
               n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 26://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE((
                                Texto like '%normatividad de medios%' OR
                                Texto like '%Radio, Television y Cinematografia%' OR
                                Texto like '%medios impresos%' OR
                                Texto like '%normatividad de comunicacion%' OR
                                Texto like '%eduardo sanchez hernandez%' AND (Texto like '%SEGOB%' OR Texto like '%subsecretaria%') OR
                                Texto like '%eduardo sanchez%' AND (Texto like '%SEGOB%' OR Texto like '%subsecretaria%') OR
                                Texto like '%subsecretario de Normatividad de Medios de Gobernacion%' OR


                                Titulo like '%normatividad de medios%' OR
                                Titulo like '%Radio, Television y Cinematografia%' OR
                                Titulo like '%medios impresos%' OR
                                Titulo like '%normatividad de comunicacion%' OR
                                Titulo like '%eduardo sanchez hernandez%' AND (Titulo like '%SEGOB%' OR Titulo like '%subsecretaria%') OR
                                Titulo like '%eduardo sanchez%'           AND (Titulo like '%SEGOB%' OR Titulo like '%subsecretaria%') OR
                                Titulo like '%subsecretario de Normatividad de Medios de Gobernacion%' OR



                                Encabezado like '%normatividad de medios%' OR
                                Encabezado like '%Radio, Television y Cinematografia%' OR
                                Encabezado like '%medios impresos%' OR
                                Encabezado like '%normatividad de comunicacion%' OR
                                Encabezado like '%eduardo sanchez hernandez%' AND (Encabezado like '%SEGOB%' OR Encabezado like '%subsecretaria%') OR
                                Encabezado like '%eduardo sanchez%'           AND (Encabezado like '%SEGOB%' OR Encabezado like '%subsecretaria%') OR
                                Encabezado like '%subsecretario de Normatividad de Medios de Gobernacion%'
                               ))AND (Texto like '%gobernacion%' OR Texto like '%segob%' OR Texto like '%secretaria de gobernacion%')AND 
                n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 27://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                    Texto like '%subsecretaria de prevencion y participacion ciudadana%' OR
                    Texto like '%prevencion y participacion ciudadana%' OR
                    Texto like '%participacion ciudadana%' AND (Texto like '%segob%' OR Texto like '%subsecretaria%') OR
                    Texto like '%roberto campa cifiran%' OR
                    Texto like '%roberto campa%' OR

                    Titulo like '%subsecretaria de prevencion y participacion ciudadana%' OR
                    Titulo like '%prevencion y participacion ciudadana%' OR
                    Titulo like '%participacion ciudadana%' AND (Texto like '%segob%' OR Texto like '%subsecretaria%') OR
                    Titulo like '%roberto campa cifiran%' OR
                    Titulo like '%roberto campa%' OR


                    Encabezado like '%subsecretaria de prevencion y participacion ciudadana%' OR
                    Encabezado like '%prevencion y participacion ciudadana%' OR
                    Encabezado like '%participacion ciudadana%' AND (Texto like '%segob%' OR Texto like '%subsecretaria%') OR
                    Encabezado like '%roberto campa cifiran%' OR
                    Encabezado like '%roberto campa%'
                   )AND 
                n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 28://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                        Texto like '%oficialia mayor%' AND (Texto like '%segob%' OR texto like '%gobernacion%') OR
                        Texto like '%Jorge Marquez Montes%' OR
                        Texto like '%Jorge Marquez%' AND (Texto like '%segob%' OR Texto like '%gobernacion%') OR


                        Titulo like '%oficialia mayor%' AND (Titulo like '%segob%' OR Titulo like '%gobernacion%') OR
                        Titulo like '%Jorge Marquez Montes%' OR
                        Titulo like '%Jorge Marquez%' AND (Titulo like '%segob%' OR Titulo like '%gobernacion%') OR

                        Encabezado like '%oficialia mayor%' AND (Encabezado like '%segob%' OR Encabezado like '%gobernacion%') OR
                        Encabezado like '%Jorge Marquez Montes%' OR
                        Encabezado like '%Jorge Marquez%' AND (Encabezado like '%segob%' OR Encabezado like '%gobernacion%')
                     )AND 
                n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;        
        case 29://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                            Texto like '%Coordinacion General De proteccion civil%' OR
                            Texto like '%coordinacion nacional de proteccion civil%' OR
                            Texto like '%coordinacion nacional %' AND (Texto like '%proteccion civil%') OR
                            Texto like '%luis felipe puente Espinosa%' OR
                            Texto like '%luis felipe puente%' OR
                            Texto like '%luis puente Espinosa%' OR
                            Texto like '%luisfelipepuenteEspinosa%' OR
                            Texto like '%luis f elipe p uente e spinosa%' OR
                            Texto like '%luis felipep uentee spinosa%' OR

                            Titulo like '%Coordinacion General De proteccion civil%' OR
                            Titulo like '%coordinacion nacional de proteccion civil%' OR
                            Titulo like '%coordinacion nacional %' AND (Titulo like '%proteccion civil%') OR
                            Titulo like '%luis felipe puente Espinosa%' OR
                            Titulo like '%luis felipe puente%' OR
                            Titulo like '%luis puente Espinosa%' OR
                            Titulo like '%luisfelipepuenteEspinosa%' OR
                            Titulo like '%luis f elipe p uente E spinosa%' OR
                            Titulo like '%luis felipep uenteE spinosa%' OR

                            Encabezado like '%Coordinacion General De proteccion civil%' OR
                            Encabezado like '%coordinacion nacional de proteccion civil%' OR
                            Encabezado like '%coordinacion nacional%' AND (Encabezado like '%proteccion civil%') OR
                            Encabezado like '%luis felipe puente Espinosa%' OR
                            Encabezado like '%luis felipe puente%' OR
                            Encabezado like '%luis puente Espinosa%' OR
                            Encabezado like '%luisfelipepuenteEspinosa%' OR
                            Encabezado like '%luis f elipe p uente E spinosa%' OR
                            Encabezado like '%luis felipep uenteE spinosa%'
                        )AND 
                    n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico";
            return $query;  
            break;        
        case 30://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                                    Texto like'%Comision para el Dialogo con los Pueblos Indigenas de Mexico%' OR
                                    Texto like'%Comision para los Pueblos Indigenas de Mexico%' OR
                                    Texto like'%juan martinez veloz%' OR
                                    Texto like'%juan martinez%' AND (Texto like '%subsecretario%' OR Texto like '%segob%') OR
                                    Texto like'%martinez veloz%' OR
                                    Texto like'%martinezveloz%' OR

                                    Titulo like'%Comision para el Dialogo con los Pueblos Indigenas de Mexico%' OR
                                    Titulo like'%Comision para los Pueblos Indigenas de Mexico%' OR
                                    Titulo like'%juan martinez veloz%' OR
                                    Titulo like'%juan martinez%' AND (Titulo like '%subsecretario%' OR Titulo like '%segob%') OR
                                    Titulo like'%martinez veloz%' OR
                                    Titulo like'%martinezveloz%' OR

                                    Encabezado like'%Comision para el Dialogo con los Pueblos Indigenas de Mexico%' OR
                                    Encabezado like'%Comision para los Pueblos Indigenas de Mexico%' OR
                                    Encabezado like'%juan martinez veloz%' OR
                                    Encabezado like'%juan martinez%' AND (Encabezado like '%subsecretario%' OR Encabezado like '%segob%') OR
                                    Encabezado like'%martinez veloz%' OR
                                    Encabezado like'%martinezveloz%'
                                   )AND 
                            n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico";
            return $query;  
            break;        
        case 31://  CNS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                            Texto like '%CNS %' OR
                            Texto like '%(CNS)%' OR
                            Texto like '% cns,%' OR
                            Texto like '% cns.%' OR
                            Texto like '% cns:%' OR
                            Texto like '% cns?%' OR
                            Texto like '% cns!%' OR
                            Texto like '%comision nacional de seguridad%' and texto not like '%nuclear%' OR
                            Texto like 'comision nacional de seguridad' and texto not like '%nuclear%' OR
                            Texto like '%cefereso%' OR
                            Texto like '%oadprs%' OR

                            Titulo like '% CNS %' OR
                            Titulo like '% cns,%' OR
                            Titulo like '% cns.%' OR
                            Titulo like '% cns:%' OR
                            Titulo like '% cns?%' OR
                            Titulo like '% cns!%' OR
                            Titulo like '%comision nacional de seguridad%' and Titulo not like '%nuclear%' OR
                            Titulo like 'comision nacional de seguridad' and Titulo not like '%nuclear%' OR
                            Titulo like '%cefereso%' OR
                            Titulo like '%oadprs%' OR

                            Encabezado like '% CNS %' OR
                            Encabezado like '% cns,%' OR
                            Encabezado like '% cns.%' OR
                            Encabezado like '% cns:%' OR
                            Encabezado like '% cns?%' OR
                            Encabezado like '% cns!%' OR
                            Encabezado like '%comision nacional de seguridad%' and Encabezado not like '%nuclear%' OR
                            Encabezado like 'comision nacional de seguridad' and Encabezado not like '%nuclear%' OR
                            Encabezado like '%cefereso%' OR
                            Encabezado like '%oadprs%'
                        )AND 
                    n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico";
            return $query;  
            break;        
        case 32://  VARIOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                          WHERE(
                                Texto like'%SEGOB%'OR
                                Texto like'%Gobernacion%' OR
                                Texto like'%plan nacional de desarrollo%' OR
                                Texto like'%igualdad laboral%' OR
                                Texto like'%emergencia para los municipios%' OR
                                Texto like'%fonden%' OR  
                                Texto like'%pgr%' OR 
                                Texto like'%cns%' OR 
                                Texto like'%sedena%' OR 
                                Texto like'%semar%' OR  
                                Titulo like'%SEGOB%'OR
                                Titulo like'%Gobernacion%' OR
                                Titulo like'%plan nacional de desarrollo%' OR
                                Titulo like'%igualdad laboral%' OR
                                Titulo like'%emergencia para los municipios%' OR
                                Titulo like'%fonden%' OR  
                                Titulo like'%pgr%' OR 
                                Titulo like'%cns%' OR 
                                Titulo like'%sedena%' OR 
                                Titulo like'%semar%' OR 
                                Encabezado like'%SEGOB%'OR
                                Encabezado like'%Gobernacion%' OR
                                Encabezado like'%plan nacional de desarrollo%' OR
                                Encabezado like'%igualdad laboral%' OR
                                Encabezado like'%emergencia para los municipios%' OR
                                Encabezado like'%fonden%' OR  
                                Encabezado like'%pgr%' OR 
                                Encabezado like'%cns%' OR 
                                Encabezado like'%sedena%' OR 
                                Encabezado like'%semar%'  
                            )AND 
                        n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado!=9 AND p.tipo=1 AND n.Categoria <> 80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY n.Periodico limit 0,40";
            return $query;  
            break;
        default:
            break;
    }
}
?>
