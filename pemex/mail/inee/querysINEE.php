<?php
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
        case 1:
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=3 
                        AND s.idSeccion = n.Seccion AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY n.Periodico ORDER BY o.posicion";
            return $query;
            break;// PRIMERAS PLANAS
        case 2:
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=19 
                        AND s.idSeccion = n.Seccion AND p.Estado=9 AND n.Fecha='".$fecha."' 
                        ORDER BY o.posicion";                      
            return $query;
            break;// COLUMNAS POLITICAS
        case 3:
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=20 
                        AND s.idSeccion = n.Seccion 
                        AND p.Estado=9 AND n.Fecha='".$fecha."' 
                        ORDER BY o.posicion";
            return $query;
            break;// COLUMNAS FINANCIERAS
        case 4:
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=18 
                        AND s.idSeccion = n.Seccion 
                        AND p.Estado=9 AND n.Fecha='".$fecha."' 
                        ORDER BY o.posicion";
            return $query;  
            break;// CARTONES
        case 5:
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                   FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                   WHERE(
                   Texto LIKE 'INEE' OR
                   Texto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR

                   Titulo LIKE 'INEE' OR
                   Titulo LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
                   
                   Encabezado LIKE 'INEE' OR
                   Encabezado LIKE '%Instituto Nacional para la Evaluacion de la Educacion%'
                   ) AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,50";
            return $query;  
            break;//INEE
        case 6:// Funcionarios
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                    WHERE (
                    Texto LIKE '%Sylvia Irene Schmelkes del Valle%' OR
                    Texto LIKE '%Sylvia Schmelkes del Valle%' OR
                    Titulo LIKE '%Sylvia Irene Schmelkes del Valle%' OR
                    Titulo LIKE '%Sylvia Schmelkes del Valle%' OR
                    Encabezado LIKE '%Sylvia Irene Schmelkes del Valle%' OR
                    Encabezado LIKE '%Sylvia Schmelkes del Valle%' OR

                    Texto LIKE '%Margarita Maria Zorrilla Fierro%' OR
                    Texto LIKE '%Margarita Zorrilla Fierro%' OR
                    Titulo LIKE '%Margarita Maria Zorrilla Fierro%' OR
                    Titulo LIKE '%Margarita Zorrilla Fierro%' OR
                    Encabezado LIKE '%Margarita Maria Zorrilla Fierro%' OR
                    Encabezado LIKE '%Margarita Zorrilla Fierro%' OR

                    Texto LIKE '%Teresa Bracho González%' OR
                    Titulo LIKE '%Teresa Bracho González%' OR
                    Encabezado LIKE '%Teresa Bracho González%' OR

                    Texto LIKE '%Gilberto Ramon Guevara Niebla%' OR
                    Texto LIKE '%Gilberto Guevara Niebla%' OR
                    Titulo LIKE '%Gilberto Ramon Guevara Niebla%' OR
                    Titulo LIKE '%Gilberto Guevara Niebla%' OR
                    Encabezado LIKE '%Gilberto Ramon Guevara Niebla%' OR
                    Encabezado LIKE '%Gilberto Guevara Niebla%' OR

                    Texto LIKE '%Eduardo Backhoff Escudero%' OR
                    Titulo LIKE '%Eduardo Backhoff Escudero%' OR
                    Encabezado LIKE '%Eduardo Backhoff Escudero%' OR

                    Texto LIKE '%Francisco Miranda Lopez%' OR
                    Titulo LIKE '%Francisco Miranda Lopez%' OR
                    Encabezado LIKE '%Francisco Miranda Lopez%'  OR

                    Texto LIKE '%Jorge Antonio Hernández Uralde%' OR
                    Texto LIKE '%Jorge Hernández Uralde%' OR
                    Titulo LIKE '%Jorge Antonio Hernández Uralde%' OR
                    Titulo LIKE '%Jorge Hernández Uralde%' OR
                    Encabezado LIKE '%Jorge Antonio Hernández Uralde%' OR
                    Encabezado LIKE '%Jorge Hernández Uralde%' OR

                    Texto LIKE '%Agustin Caso Raphael%' OR
                    Titulo LIKE '%Agustin Caso Raphael%' OR
                    Encabezado LIKE '%Agustin Caso Raphael%' OR

                    Texto LIKE '%Luis Castillo Montes%' OR
                    Titulo LIKE '%Luis Castillo Montes%' OR
                    Encabezado LIKE '%Luis Castillo Montes%'
                    ) AND
                 Texto not like '%ex Secretario%' AND
                 Texto not like '%ex funcionario%' AND
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                p.Estado=9 AND s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,29";
            return $query;  
            break;//Funcionarios  
        case 7://Reforma Educativa 
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                    WHERE(
                    Texto LIKE '%Reforma Educativa%' OR
                    Titulo LIKE '%Reforma Educativa%' OR
                    Encabezado LIKE '%Reforma Educativa%'
                    )AND
            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;  
            break;//Reforma Educativa 
        case 8://  SEN
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                    WHERE (
                    Texto LIKE 'SEN' OR
                    Texto LIKE '%Sistema Educativo Nacional%' OR
                    Titulo LIKE 'SEN' OR
                    Titulo LIKE '%Sistema Educativo Nacional%' OR
                    Encabezado LIKE 'SEN' OR
                    Encabezado LIKE '%Sistema Educativo Nacional%'
                    ) AND
            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;  
            break;//SEN  
        case 9://SNEE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                    WHERE(
                    Texto LIKE 'SNEE' OR
                    Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

                    Titulo LIKE 'SNEE' OR
                    Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

                    Encabezado LIKE 'SNEE' OR
                    Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
                ) AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;//SNEE   
        case 10://PNEE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                   FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                   WHERE (
                   Texto LIKE 'PNEE' OR
                   Texto LIKE '%Politica Nacional de Evaluacion Educativa%' OR
                   Titulo LIKE 'PNEE' OR
                   Titulo LIKE '%Politica Nacional de Evaluacion Educativa%' OR
                   Encabezado LIKE 'PNEE' OR
                   Encabezado LIKE '%Politica Nacional de Evaluacion Educativa%'
                ) AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;//PNEE        
        case 11://SPD
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                    WHERE(
                        Texto LIKE 'SPD' OR
                        Texto LIKE '%Servicio Profesional Docente%' OR

                        Titulo LIKE 'SPD' OR
                        Titulo LIKE '%Servicio Profesional Docente%' OR

                        Encabezado LIKE 'SPD' OR
                        Encabezado LIKE '%Servicio Profesional Docente%'
                    )AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;//SPD        
        case 12://PRUEBA
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                    WHERE (
                    Texto LIKE '%prueba enlace%' OR
                    Texto LIKE '%prueba excale%' OR
                    Texto LIKE '%prueba pisa%' OR
                    Texto LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
                    Texto LIKE '%Programme for International Student Assessment%' OR
                    Texto LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
                    Texto LIKE '%Exámen de la Calidad y el Logro Educativo%' OR

                    Titulo LIKE '%prueba enlace%' OR
                    Titulo LIKE '%prueba excale%' OR
                    Titulo LIKE '%prueba pisa%' OR
                    Titulo LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
                    Titulo LIKE '%Programme for International Student Assessment%' OR
                    Titulo LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
                    Titulo LIKE '%Exámen de la Calidad y el Logro Educativo%' OR

                    Encabezado LIKE '%prueba enlace%' OR
                    Encabezado LIKE '%prueba excale%' OR
                    Encabezado LIKE '%prueba pisa%' OR
                    Encabezado LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
                    Encabezado LIKE '%Programme for International Student Assessment%' OR
                    Encabezado LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
                    Encabezado LIKE '%Exámen de la Calidad y el Logro Educativo%'
                    ) AND
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;//PRUEBA        
        case 13://EVALUACIÓN EDUCATIVA/EVALUACIÓN DE LA EDUCACIÓN 
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                        WHERE(
                        Texto LIKE '%Evaluacion educativa%' OR
                        Texto LIKE '%Evaluacion de la educacion%' OR

                        Titulo LIKE '%Evaluacion educativa%' OR
                        Titulo LIKE '%Evaluacion de la educacion%' OR

                        Encabezado LIKE '%Evaluacion educativa%' OR
                        Encabezado LIKE '%Evaluacion de la educacion%'
                        )AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;//EVALUACIÓN EDUCATIVA/EVALUACIÓN DE LA EDUCACIÓN        
        case 14://CONFERENCIA DEL SISTEMA NACIONAL DE EVALUACIÓN EDUCATIVA
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                    WHERE(
                    Texto LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
                    Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

                    Titulo LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
                    Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

                    Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
                    Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
                    ) AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;//CONFERENCIA DEL SISTEMA NACIONAL DE EVALUACIÓN EDUCATIVA        
        case 15://CONSCEE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                    WHERE(
                    Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
                    Texto LIKE '%CONSCEE%' OR

                    Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
                    Titulo LIKE '%CONSCEE%' OR

                    Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
                    Encabezado LIKE '%CONSCEE%'
                    ) AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico";
            return $query;  
            break;//CONSCEE        
        case 16://CONVIE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                   FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                   WHERE(
                    Texto LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
                    Texto LIKE 'CONVIE' OR

                    Titulo LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
                    Titulo LIKE 'CONVIE' OR

                    Encabezado LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
                    Encabezado LIKE 'CONVIE'
                )AND 
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                p.Estado=9 AND p.tipo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico";
            return $query;  
            break;//CONVIE        
        case 17://CONPEE    
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                        WHERE(
                            Texto LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
                            Texto LIKE 'CONPEE' OR

                            Titulo LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
                            Titulo LIKE 'CONPEE' OR

                            Encabezado LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
                            Encabezado LIKE 'CONPEE'
                        ) AND 
                        n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                        p.Estado=9 AND p.tipo=1
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY n.Periodico";
            return $query;  
            break;//CONPEE        
        case 18://CONTE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                    WHERE(
                        Texto LIKE '%Consejos Tecnicos Especializados%' OR
                        Texto LIKE 'CONTE' OR

                        Titulo LIKE '%Consejos Tecnicos Especializados%' OR
                        Titulo LIKE 'CONTE' OR

                        Encabezado LIKE '%Consejos Tecnicos Especializados%' OR
                        Encabezado LIKE 'CONTE'
                    )AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,40";
            return $query;  
            break;//CONTE  
        case 19://SEP
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                    WHERE(
                    Texto LIKE 'SEP' OR
                    Texto LIKE '%Secretaria de Educacion Publica%' OR

                    Titulo LIKE 'SEP' OR
                    Titulo LIKE '%Secretaria de Educacion Publica%' OR

                    Encabezado LIKE 'SEP' OR
                    Encabezado LIKE '%Secretaria de Educacion Publica%'
                    )AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,40";
            return $query;  
            break;//SEP  
        case 20://SNTE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                    WHERE(
	Texto LIKE 'SNTE' OR
	Texto LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
		
	Titulo LIKE 'SNTE' OR
	Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
	
	Encabezado LIKE 'SNTE' OR
	Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educacion%'
)AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,40";
            return $query;  
            break;//SNTE  
        case 21://CNTE
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s   
                    WHERE(
                    Texto LIKE 'CNTE' OR
                    Texto LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%' OR

                    Titulo LIKE 'CNTE' OR
                    Titulo LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%' OR

                    Encabezado LIKE 'CNTE' OR
                    Encabezado LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%'
                    )AND 
                    n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                    s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
                    p.Estado=9 AND p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,40";
            return $query;  
            break;//CNTE  
        default:
            break;
    }
}
?>
