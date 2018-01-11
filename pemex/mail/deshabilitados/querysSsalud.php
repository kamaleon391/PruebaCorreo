<?php
function query($op,$fechaTabla){
        $fecha=$fechaTabla;
        $FechaCliente = strtotime($fechaTabla);
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);     
        if ($FechaCliente == $fecha_actual)
        {
            $fechaTabla="editorialdia";
        }
        else
        {
            $fechaTabla="editorialsemanal";
        }
    switch ($op) {
        case 1:// PRIMERAS PLANAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,p.estado
                        FROM ".$fechaTabla." e, ordenpersonalizado o, periodicos p
                        WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                        AND e.periodico IN (SELECT periodico FROM ordenpersonalizado op) AND e.fecha='$fecha'
                        group by  e.periodico order by o.posicion";
            return $query;
            break;
        case 2:// COLUMNAS POLITICAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizado o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%Columnas Politicas%' ) AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizado op)  AND e.fecha='$fecha' order by o.posicion";
            return $query;
            break;
        case 3:// COLUMNAS FINANCIERAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizado o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%Columnas Financieras%' ) AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizado op)  AND fecha='$fecha' order by o.posicion";
            return $query;
            break;
        case 4:// COLUMNAS FINANCIERAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizado o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%cartones%' ) AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizado op)  AND e.fecha='$fecha' order by o.posicion";
            return $query;  
            break;
        case 5:// hector pablo ramirez puga leyva
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE(
                                Texto like'%mercedes juan%' OR
                                Texto like'%mercedes juan lopez%' OR
                                Titulo like'%mercedes juan%' OR
                                Titulo like'%mercedes juan lopez%' OR
                                Encabezado like '%mercedes juan%' OR
                                Encabezado like '%mercedes juan lopez%'
                               )
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by e.periodico, e.numeroPagina           
                    order by p.estado, p.nombre";
            return $query;  
            break;  
        case 6:// GERENCIA
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '% SSA %' OR
                                    Texto like '% secretaria de salud %' OR
                                    Texto like '% secretaria de salud federal %' OR

                                    Titulo like '% SSA %' OR
                                    Titulo like '% secretaria de salud %' OR
                                    Titulo like '% secretaria de salud federal %' OR

                                    Encabezado like '% SSA %' OR
                                    Encabezado like '% secretaria de salud %' OR
                                    Encabezado like '% secretaria de salud federal %'

                                   )
                            AND e.periodico=p.nombre AND Tipo=0
                    group by e.periodico, e.numeroPagina            
                    order by p.estado, p.nombre  LIMIT 0,30";
            return $query;  
            break;  
        case 7://  LICONSA
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '%Enrique pena nieto%' OR
                                    Texto like '%presidente peña%' OR
                                    Texto like '%presidente de la republica%' OR
                                    Texto like '%presidencia de la republica%' OR
                                    Texto like '%peña nieto%' OR
                                    Texto like '%pena nieto%' OR
                                    Texto like 'Enrique pena nieto' OR
                                    Texto like '%epn%' OR
                                    Texto like '%@EPN%' OR
                                    Texto like '%@presidenciaMX%' OR
                                    Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
                                    Texto like '%de Pena Nieto%' OR
                                    Texto like '% Enrique Pena %' OR
                                    Texto like '% quique Pena %' OR
                                    Texto like '%peñanietista%' OR
                                    Texto like '%penanietista%' OR

                                    Titulo like '%Enrique pena nieto%' OR
                                    Titulo like '%presidente peña%' OR
                                    Titulo like '%presidente de la republica%' OR
                                    Titulo like '%presidencia de la republica%' OR
                                    Titulo like '%peña nieto%' OR
                                    Titulo like '%pena nieto%' OR
                                    Titulo like 'Enrique pena nieto'  OR
                                    Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                    Titulo like '%epn%' OR
                                    Titulo like '%@EPN%' OR
                                    Titulo like '%@presidenciaMX%' OR
                                    Titulo like '% quique Pena %' OR
                                    Titulo like '%peñanietista%' OR

                                    Encabezado like '%Enrique pena nieto%' OR
                                    Encabezado like '%presidente peña%' OR
                                    Encabezado like '%presidente de la republica%' OR
                                    Encabezado like '%presidencia de la republica%' OR
                                    Encabezado like '%peña nieto%' OR
                                    Encabezado like '%pena nieto%' OR
                                    Encabezado like 'Enrique pena nieto' OR
                                    Encabezado like '%epn%' OR
                                    Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Encabezado like '%Senor Licenciado enrique pena nieto%' OR
                                    Encabezado like '%epn%' OR
                                    Encabezado like '%@EPN%' OR
                                    Encabezado like '%@presidenciaMX%' OR
                                    Encabezado like '% quique Pena %' OR
                                    Encabezado like '%peñanietista%'
                                    )AND 
                                e.periodico=p.nombre AND 
                                p.estado like 'zacatecas' AND
                                p.Tipo=0 
                                GROUP BY e.periodico, e.NumeroPagina
                                ORDER BY p.estado, p.nombre";
            return $query;  
            break; 
        case 8://  LECHE
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                    Texto like '%Gobernador del estado de Zacatecas%' OR
                                    Texto like '%Gobernador de Zacatecas%' OR
                                    Texto like '%Miguel alonso Reyes%' OR
                                    Texto like '%Gobierno del estado%' OR

                                    Titulo like '%Gobernador del estado de Zacatecas%' OR
                                    Titulo like '%Gobernador de Zacatecas%' OR
                                    Titulo like '%Miguel alonso Reyes%' OR
                                    Titulo like '%Gobierno del estado%' OR

                                    Encabezado like '%Gobernador del estado de Zacatecas%' OR
                                    Encabezado like '%Gobernador de Zacatecas%' OR
                                    Encabezado like '%Miguel alonso Reyes%' OR
                                    Encabezado like '%Gobierno del estado%'
                            )AND 
                            e.periodico=p.nombre AND 
                            p.estado like 'zacatecas' AND
                            p.Tipo=0    
                            GROUP BY e.periodico, e.NumeroPagina
                            ORDER BY p.estado, p.nombre";
            return $query;  
            break;  
        case 9://  SEDESOL
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE (
                                    Texto like '% SSM %' OR
                                    Texto like '%secretaria de salud michoacan%' OR
                                    Texto like '%secretaria de salud de michoacan%' OR
                                    Texto like '%rafael diaz rodriguez %' OR
                                    Texto like '%rafael diaz%' OR
                                    Texto like '%diaz rodriguez%' OR
                                    Texto like '%secretaria de salud%' OR
                                    Texto like '% SSA %' OR
                                    Texto like '%imss%' OR
                                    Texto like '%instituto mexicano del seguro social%' OR
                                    Texto like '%seguro social%' OR
                                    Texto like '%jose antonio gonzalez anaya%' OR
                                    Texto like '%gonzalez anaya%' OR
                                    Texto like '%Director del instituto Mexicano del Seguro Social%' OR
                                    Texto like '%ISSSTE%' OR
                                    Texto like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Texto like '%sebastian  Lerdo de tejada covarrubias%' OR
                                    Texto like '%sebastian  Lerdo de tejada%' OR
                                    Texto like '%Director general del issste%' OR
                                    Texto like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Texto like '%enfermedades%' OR
                                    Texto like '%enfermedad%' OR
                                    Texto like '%influenza%' OR
                                    Texto like '%AH1N1%' OR
                                    Texto like '%AH3N2%' OR
                                    Texto like '%centro de salud%' OR

                                    Titulo like '% SSM %' OR
                                    Titulo like '%secretaria de salud michoacan%' OR
                                    Titulo like '%secretaria de salud de michoacan%' OR
                                    Titulo like '%rafael diaz rodriguez %' OR
                                    Titulo like '%rafael diaz%' OR
                                    Titulo like '%diaz rodriguez%' OR
                                    Titulo like '%secretaria de salud%' OR
                                    Titulo like '% SSA %' OR
                                    Titulo like '%imss%' OR
                                    Titulo like '%instituto mexicano del seguro social%' OR
                                    Titulo like '%seguro social%' OR
                                    Titulo like '%jose antonio gonzalez anaya%' OR
                                    Titulo like '%gonzalez anaya%' OR
                                    Titulo like '%Director del instituto Mexicano del Seguro Social%' OR
                                    Titulo like '%ISSSTE%' OR
                                    Titulo like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Titulo like '%sebastian  Lerdo de tejada covarrubias%' OR
                                    Titulo like '%sebastian  Lerdo de tejada%' OR
                                    Titulo like '%Director general del issste%' OR
                                    Titulo like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Titulo like '%enfermedades%' OR
                                    Titulo like '%enfermedad%' OR
                                    Titulo like '%influenza%' OR
                                    Titulo like '%AH1N1%' OR
                                    Titulo like '%AH3N2%' OR
                                    Titulo like '%centro de salud%' OR

                                    Encabezado like '% SSM %' OR
                                    Encabezado like '%secretaria de salud michoacan%' OR
                                    Encabezado like '%secretaria de salud de michoacan%' OR
                                    Encabezado like '%rafael diaz rodriguez %' OR
                                    Encabezado like '%rafael diaz%' OR
                                    Encabezado like '%diaz rodriguez%' OR
                                    Encabezado like '%secretaria de salud%' OR
                                    Encabezado like '% SSA %' OR
                                    Encabezado like '%imss%' OR
                                    Encabezado like '%instituto mexicano del seguro social%' OR
                                    Encabezado like '%seguro social%' OR
                                    Encabezado like '%jose antonio gonzalez anaya%' OR
                                    Encabezado like '%gonzalez anaya%' OR
                                    Encabezado like '%Director del instituto Mexicano del Seguro Social%' OR
                                    Encabezado like '%ISSSTE%' OR
                                    Encabezado like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Encabezado like '%sebastian  Lerdo de tejada covarrubias%' OR
                                    Encabezado like '%sebastian  Lerdo de tejada%' OR
                                    Encabezado like '%Director general del issste%' OR
                                    Encabezado like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Encabezado like '%enfermedades%' OR
                                    Encabezado like '%enfermedad%' OR
                                    Encabezado like '%influenza%' OR
                                    Encabezado like '%AH1N1%' OR
                                    Encabezado like '%AH3N2%' OR
                                    Encabezado like '%centro de salud%'
                            )AND 
                            e.periodico=p.nombre AND 
                            p.estado like 'zacatecas' AND
                            p.Tipo=0    
                                    GROUP BY e.periodico, e.NumeroPagina
                            ORDER BY p.estado, p.nombre";
            return $query;  
            break;   
        case 10://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE (
                                    Texto like '%Enrique pena nieto%' OR
                                    Texto like '%presidente peña%' OR
                                    Texto like '%presidente de la republica%' OR
                                    Texto like '%presidencia de la republica%' OR
                                    Texto like '%peña nieto%' OR
                                    Texto like '%pena nieto%' OR
                                    Texto like 'Enrique pena nieto' OR
                                    Texto like '%epn%' OR
                                    Texto like '%@EPN%' OR
                                    Texto like '%@presidenciaMX%' OR
                                    Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
                                    Texto like '%de Pena Nieto%' OR
                                    Texto like '% Enrique Pena %' OR
                                    Texto like '% quique Pena %' OR
                                    Texto like '%peñanietista%' OR
                                    Texto like '%penanietista%' OR

                                    Titulo like '%Enrique pena nieto%' OR
                                    Titulo like '%presidente peña%' OR
                                    Titulo like '%presidente de la republica%' OR
                                    Titulo like '%presidencia de la republica%' OR
                                    Titulo like '%peña nieto%' OR
                                    Titulo like '%pena nieto%' OR
                                    Titulo like 'Enrique pena nieto'  OR
                                    Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                    Titulo like '%epn%' OR
                                    Titulo like '%@EPN%' OR
                                    Titulo like '%@presidenciaMX%' OR
                                    Titulo like '% quique Pena %' OR
                                    Titulo like '%peñanietista%' OR

                                    Encabezado like '%Enrique pena nieto%' OR
                                    Encabezado like '%presidente peña%' OR
                                    Encabezado like '%presidente de la republica%' OR
                                    Encabezado like '%presidencia de la republica%' OR
                                    Encabezado like '%peña nieto%' OR
                                    Encabezado like '%pena nieto%' OR
                                    Encabezado like 'Enrique pena nieto' OR
                                    Encabezado like '%epn%' OR
                                    Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Encabezado like '%Senor Licenciado enrique pena nieto%' OR
                                    Encabezado like '%epn%' OR
                                    Encabezado like '%@EPN%' OR
                                    Encabezado like '%@presidenciaMX%' OR
                                    Encabezado like '% quique Pena %' OR
                                    Encabezado like '%peñanietista%'
                                    )AND 
                        e.periodico=p.nombre AND 
                        p.estado like 'San Luis Potosi' AND
                        p.Tipo=0 
                        GROUP BY e.periodico, e.NumeroPagina
                        ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        case 11://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                Texto like '%Gobernador del estado de san luis potosi%' OR
                                Texto like '%Gobernador de san luis potosi%' OR
                                Texto like '%fernando Toranzo Fernandez%' OR
                                Texto like '%fernando Toranzo%' OR
                                Texto like '%Toranzo Fernandez%' OR
                                Texto like '%Gobierno del estado%' OR

                                Titulo like '%Gobernador del estado de san luis potosi%' OR
                                Titulo like '%Gobernador de san luis potosi%' OR
                                Titulo like '%fernando Toranzo Fernandez%' OR
                                Titulo like '%fernando Toranzo%' OR
                                Titulo like '%Toranzo Fernandez%' OR
                                Titulo like '%Gobierno del estado%' OR

                                Encabezado like '%Gobernador del estado de san luis potosi%' OR
                                Encabezado like '%Gobernador de san luis potosi%' OR
                                Titulo like '%fernando Toranzo Fernandez%' OR
                                Titulo like '%fernando Toranzo%' OR
                                Titulo like '%Toranzo Fernandez%' OR
                                Encabezado like '%Gobierno del estado%'
                        )AND 
                        e.periodico=p.nombre AND 
                        p.estado like 'San Luis Potosi' AND
                        p.Tipo=0    
                        GROUP BY e.periodico, e.NumeroPagina
                        ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        case 12://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                Texto like '% SSM %' OR
                                Texto like '%secretaria de salud michoacan%' OR
                                Texto like '%secretaria de salud de michoacan%' OR
                                Texto like '%rafael diaz rodriguez %' OR
                                Texto like '%rafael diaz%' OR
                                Texto like '%diaz rodriguez%' OR
                                Texto like '%secretaria de salud%' OR
                                Texto like '% SSA %' OR
                                Texto like '%imss%' OR
                        Texto like '%instituto mexicano del seguro social%' OR
                        Texto like '%seguro social%' OR
                        Texto like '%jose antonio gonzalez anaya%' OR
                        Texto like '%gonzalez anaya%' OR
                        Texto like '%Director del instituto Mexicano del Seguro Social%' OR
                                Texto like '%ISSSTE%' OR
                                Texto like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Texto like '%sebastian  Lerdo de tejada covarrubias%' OR
                                Texto like '%sebastian  Lerdo de tejada%' OR
                        Texto like '%Director general del issste%' OR
                        Texto like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Texto like '%enfermedades%' OR
                                Texto like '%enfermedad%' OR
                                Texto like '%influenza%' OR
                                Texto like '%AH1N1%' OR
                                Texto like '%AH3N2%' OR
                                Texto like '%centro de salud%' OR

                                Titulo like '% SSM %' OR
                                Titulo like '%secretaria de salud michoacan%' OR
                                Titulo like '%secretaria de salud de michoacan%' OR
                                Titulo like '%rafael diaz rodriguez %' OR
                                Titulo like '%rafael diaz%' OR
                                Titulo like '%diaz rodriguez%' OR
                                Titulo like '%secretaria de salud%' OR
                                Titulo like '% SSA %' OR
                                Titulo like '%imss%' OR
                        Titulo like '%instituto mexicano del seguro social%' OR
                        Titulo like '%seguro social%' OR
                        Titulo like '%jose antonio gonzalez anaya%' OR
                        Titulo like '%gonzalez anaya%' OR
                        Titulo like '%Director del instituto Mexicano del Seguro Social%' OR
                                Titulo like '%ISSSTE%' OR
                                Titulo like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Titulo like '%sebastian  Lerdo de tejada covarrubias%' OR
                                Titulo like '%sebastian  Lerdo de tejada%' OR
                        Titulo like '%Director general del issste%' OR
                        Titulo like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Titulo like '%enfermedades%' OR
                                Titulo like '%enfermedad%' OR
                                Titulo like '%influenza%' OR
                                Titulo like '%AH1N1%' OR
                                Titulo like '%AH3N2%' OR
                                Titulo like '%centro de salud%' OR

                                Encabezado like '% SSM %' OR
                                Encabezado like '%secretaria de salud michoacan%' OR
                                Encabezado like '%secretaria de salud de michoacan%' OR
                                Encabezado like '%rafael diaz rodriguez %' OR
                                Encabezado like '%rafael diaz%' OR
                                Encabezado like '%diaz rodriguez%' OR
                                Encabezado like '%secretaria de salud%' OR
                                Encabezado like '% SSA %' OR
                                Encabezado like '%imss%' OR
                        Encabezado like '%instituto mexicano del seguro social%' OR
                        Encabezado like '%seguro social%' OR
                        Encabezado like '%jose antonio gonzalez anaya%' OR
                        Encabezado like '%gonzalez anaya%' OR
                        Encabezado like '%Director del instituto Mexicano del Seguro Social%' OR
                                Encabezado like '%ISSSTE%' OR
                                Encabezado like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Encabezado like '%sebastian  Lerdo de tejada covarrubias%' OR
                                Encabezado like '%sebastian  Lerdo de tejada%' OR
                        Encabezado like '%Director general del issste%' OR
                        Encabezado like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Encabezado like '%enfermedades%' OR
                                Encabezado like '%enfermedad%' OR
                                Encabezado like '%influenza%' OR
                                Encabezado like '%AH1N1%' OR
                                Encabezado like '%AH3N2%' OR
                                Encabezado like '%centro de salud%'
                        )AND 
                e.periodico=p.nombre AND 
                p.estado like 'San Luis Potosi' AND
                p.Tipo=0    
                        GROUP BY e.periodico, e.NumeroPagina
                ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        case 13://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                Texto like '%Enrique pena nieto%' OR
                                Texto like '%presidente peña%' OR
                                Texto like '%presidente de la republica%' OR
                                Texto like '%presidencia de la republica%' OR
                                Texto like '%peña nieto%' OR
                                Texto like '%pena nieto%' OR
                                Texto like 'Enrique pena nieto' OR
                                Texto like '%epn%' OR
                                Texto like '%@EPN%' OR
                                Texto like '%@presidenciaMX%' OR
                                Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
                                Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
                                Texto like '%de Pena Nieto%' OR
                                Texto like '% Enrique Pena %' OR
                                Texto like '% quique Pena %' OR
                                Texto like '%peñanietista%' OR
                                Texto like '%penanietista%' OR

                                Titulo like '%Enrique pena nieto%' OR
                                Titulo like '%presidente peña%' OR
                                Titulo like '%presidente de la republica%' OR
                                Titulo like '%presidencia de la republica%' OR
                                Titulo like '%peña nieto%' OR
                                Titulo like '%pena nieto%' OR
                                Titulo like 'Enrique pena nieto'  OR
                                Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                Titulo like '%epn%' OR
                                Titulo like '%@EPN%' OR
                                Titulo like '%@presidenciaMX%' OR
                                Titulo like '% quique Pena %' OR
                                Titulo like '%peñanietista%' OR

                                Encabezado like '%Enrique pena nieto%' OR
                                Encabezado like '%presidente peña%' OR
                                Encabezado like '%presidente de la republica%' OR
                                Encabezado like '%presidencia de la republica%' OR
                                Encabezado like '%peña nieto%' OR
                                Encabezado like '%pena nieto%' OR
                                Encabezado like 'Enrique pena nieto' OR
                                Encabezado like '%epn%' OR
                                Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
                                Encabezado like '%Senor Licenciado enrique pena nieto%' OR
                                Encabezado like '%epn%' OR
                                Encabezado like '%@EPN%' OR
                                Encabezado like '%@presidenciaMX%' OR
                                Encabezado like '% quique Pena %' OR
                                Encabezado like '%peñanietista%'
                                )AND 
                        e.periodico=p.nombre AND 
                        p.estado like 'Durango' AND
                        p.Tipo=0 
                        GROUP BY e.periodico, e.NumeroPagina
                        ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        case 14://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                    Texto like '%Gobernador del estado de Durango%' OR
                                    Texto like '%Gobernador de Durango%' OR
                                    Texto like '%jorge herrera caldera%' OR
                                    Texto like '%jorge herrera%' OR
                                    Texto like '%herrera caldera%' OR
                                    Texto like '%Gobierno del estado%' OR

                                    Titulo like '%Gobernador del estado de Durango%' OR
                                    Titulo like '%Gobernador de Durango%' OR
                                    Titulo like '%jorge herrera caldera%' OR
                                    Titulo like '%jorge herrera%' OR
                                    Titulo like '%herrera caldera%' OR
                                    Titulo like '%Gobierno del estado%' OR

                                    Encabezado like '%Gobernador del estado de Durango%' OR
                                    Encabezado like '%Gobernador de Durango%' OR
                                    Encabezado like '%jorge herrera caldera%' OR
                                    Encabezado like '%jorge herrera%' OR
                                    Encabezado like '%herrera caldera%' OR
                                    Encabezado like '%Gobierno del estado%'
                            )AND 
                            e.periodico=p.nombre AND 
                            p.estado like 'Durango' AND
                            p.Tipo=0    
                            GROUP BY e.periodico, e.NumeroPagina
                            ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        case 15://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                    Texto like '% SSM %' OR
                                    Texto like '%secretaria de salud michoacan%' OR
                                    Texto like '%secretaria de salud de michoacan%' OR
                                    Texto like '%rafael diaz rodriguez %' OR
                                    Texto like '%rafael diaz%' OR
                                    Texto like '%diaz rodriguez%' OR
                                    Texto like '%secretaria de salud%' OR
                                    Texto like '% SSA %' OR
                                    Texto like '%imss%' OR
                            Texto like '%instituto mexicano del seguro social%' OR
                            Texto like '%seguro social%' OR
                            Texto like '%jose antonio gonzalez anaya%' OR
                            Texto like '%gonzalez anaya%' OR
                            Texto like '%Director del instituto Mexicano del Seguro Social%' OR
                                    Texto like '%ISSSTE%' OR
                                    Texto like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Texto like '%sebastian  Lerdo de tejada covarrubias%' OR
                                    Texto like '%sebastian  Lerdo de tejada%' OR
                            Texto like '%Director general del issste%' OR
                            Texto like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Texto like '%enfermedades%' OR
                                    Texto like '%enfermedad%' OR
                                    Texto like '%influenza%' OR
                                    Texto like '%AH1N1%' OR
                                    Texto like '%AH3N2%' OR
                                    Texto like '%centro de salud%' OR

                                    Titulo like '% SSM %' OR
                                    Titulo like '%secretaria de salud michoacan%' OR
                                    Titulo like '%secretaria de salud de michoacan%' OR
                                    Titulo like '%rafael diaz rodriguez %' OR
                                    Titulo like '%rafael diaz%' OR
                                    Titulo like '%diaz rodriguez%' OR
                                    Titulo like '%secretaria de salud%' OR
                                    Titulo like '% SSA %' OR
                                    Titulo like '%imss%' OR
                            Titulo like '%instituto mexicano del seguro social%' OR
                            Titulo like '%seguro social%' OR
                            Titulo like '%jose antonio gonzalez anaya%' OR
                            Titulo like '%gonzalez anaya%' OR
                            Titulo like '%Director del instituto Mexicano del Seguro Social%' OR
                                    Titulo like '%ISSSTE%' OR
                                    Titulo like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Titulo like '%sebastian  Lerdo de tejada covarrubias%' OR
                                    Titulo like '%sebastian  Lerdo de tejada%' OR
                            Titulo like '%Director general del issste%' OR
                            Titulo like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Titulo like '%enfermedades%' OR
                                    Titulo like '%enfermedad%' OR
                                    Titulo like '%influenza%' OR
                                    Titulo like '%AH1N1%' OR
                                    Titulo like '%AH3N2%' OR
                                    Titulo like '%centro de salud%' OR

                                    Encabezado like '% SSM %' OR
                                    Encabezado like '%secretaria de salud michoacan%' OR
                                    Encabezado like '%secretaria de salud de michoacan%' OR
                                    Encabezado like '%rafael diaz rodriguez %' OR
                                    Encabezado like '%rafael diaz%' OR
                                    Encabezado like '%diaz rodriguez%' OR
                                    Encabezado like '%secretaria de salud%' OR
                                    Encabezado like '% SSA %' OR
                                    Encabezado like '%imss%' OR
                            Encabezado like '%instituto mexicano del seguro social%' OR
                            Encabezado like '%seguro social%' OR
                            Encabezado like '%jose antonio gonzalez anaya%' OR
                            Encabezado like '%gonzalez anaya%' OR
                            Encabezado like '%Director del instituto Mexicano del Seguro Social%' OR
                                    Encabezado like '%ISSSTE%' OR
                                    Encabezado like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Encabezado like '%sebastian  Lerdo de tejada covarrubias%' OR
                                    Encabezado like '%sebastian  Lerdo de tejada%' OR
                            Encabezado like '%Director general del issste%' OR
                            Encabezado like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                    Encabezado like '%enfermedades%' OR
                                    Encabezado like '%enfermedad%' OR
                                    Encabezado like '%influenza%' OR
                                    Encabezado like '%AH1N1%' OR
                                    Encabezado like '%AH3N2%' OR
                                    Encabezado like '%centro de salud%'
                            )AND 
                            e.periodico=p.nombre AND 
                            p.estado like 'Durango' AND
                            p.Tipo=0    
                                    GROUP BY e.periodico, e.NumeroPagina
                            ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        case 16://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                    Texto like '%Enrique pena nieto%' OR
                                    Texto like '%presidente peña%' OR
                                    Texto like '%presidente de la republica%' OR
                                    Texto like '%presidencia de la republica%' OR
                                    Texto like '%peña nieto%' OR
                                    Texto like '%pena nieto%' OR
                                    Texto like 'Enrique pena nieto' OR
                                    Texto like '%epn%' OR
                                    Texto like '%@EPN%' OR
                                    Texto like '%@presidenciaMX%' OR
                                    Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
                                    Texto like '%de Pena Nieto%' OR
                                    Texto like '% Enrique Pena %' OR
                                    Texto like '% quique Pena %' OR
                                    Texto like '%peñanietista%' OR
                                    Texto like '%penanietista%' OR

                                    Titulo like '%Enrique pena nieto%' OR
                                    Titulo like '%presidente peña%' OR
                                    Titulo like '%presidente de la republica%' OR
                                    Titulo like '%presidencia de la republica%' OR
                                    Titulo like '%peña nieto%' OR
                                    Titulo like '%pena nieto%' OR
                                    Titulo like 'Enrique pena nieto'  OR
                                    Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                    Titulo like '%epn%' OR
                                    Titulo like '%@EPN%' OR
                                    Titulo like '%@presidenciaMX%' OR
                                    Titulo like '% quique Pena %' OR
                                    Titulo like '%peñanietista%' OR

                                    Encabezado like '%Enrique pena nieto%' OR
                                    Encabezado like '%presidente peña%' OR
                                    Encabezado like '%presidente de la republica%' OR
                                    Encabezado like '%presidencia de la republica%' OR
                                    Encabezado like '%peña nieto%' OR
                                    Encabezado like '%pena nieto%' OR
                                    Encabezado like 'Enrique pena nieto' OR
                                    Encabezado like '%epn%' OR
                                    Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
                                    Encabezado like '%Senor Licenciado enrique pena nieto%' OR
                                    Encabezado like '%epn%' OR
                                    Encabezado like '%@EPN%' OR
                                    Encabezado like '%@presidenciaMX%' OR
                                    Encabezado like '% quique Pena %' OR
                                    Encabezado like '%peñanietista%'
                                    )AND 
                                    e.periodico=p.nombre AND 
                                    p.estado like 'Michoacan' AND
                                    p.Tipo=0 
                                    GROUP BY e.periodico, e.NumeroPagina
                                    ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        case 17://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                Texto like '%Gobernador del estado de Michoacan%' OR
                                Texto like '%Gobernador de Michoacan%' OR
                                Texto like '%fausto vallejo figueroa%' OR
                                Texto like '%fausto vallejo %' OR
                                Texto like '%vallejo figueroa%' OR
                                Texto like '%Gobierno del estado%' OR

                                Titulo like '%Gobernador del estado de Michoacan%' OR
                                Titulo like '%Gobernador de Michoacan%' OR
                                Titulo like '%fausto vallejo figueroa%' OR
                                Titulo like '%fausto vallejo %' OR
                                Titulo like '%vallejo figueroa%' OR
                                Titulo like '%Gobierno del estado%' OR

                                Encabezado like '%Gobernador del estado de Michoacan%' OR
                                Encabezado like '%Gobernador de Michoacan%' OR
                                Encabezado like '%fausto vallejo figueroa%' OR
                                Encabezado like '%fausto vallejo %' OR
                                Encabezado like '%vallejo figueroa%' OR
                                Encabezado like '%Gobierno del estado%'
                        )AND 
                        e.periodico=p.nombre AND 
                        p.estado like 'Michoacan' AND
                        p.Tipo=0    
                        GROUP BY e.periodico, e.NumeroPagina
                        ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        case 18://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                        Texto like '% SSM %' OR
                                        Texto like '%secretaria de salud michoacan%' OR
                                        Texto like '%secretaria de salud de michoacan%' OR
                                        Texto like '%rafael diaz rodriguez %' OR
                                        Texto like '%rafael diaz%' OR
                                        Texto like '%diaz rodriguez%' OR
                                        Texto like '%secretaria de salud%' OR
                                        Texto like '% SSA %' OR
                                        Texto like '%imss%' OR
                                Texto like '%instituto mexicano del seguro social%' OR
                                Texto like '%seguro social%' OR
                                Texto like '%jose antonio gonzalez anaya%' OR
                                Texto like '%gonzalez anaya%' OR
                                Texto like '%Director del instituto Mexicano del Seguro Social%' OR
                                        Texto like '%ISSSTE%' OR
                                        Texto like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                        Texto like '%sebastian  Lerdo de tejada covarrubias%' OR
                                        Texto like '%sebastian  Lerdo de tejada%' OR
                                Texto like '%Director general del issste%' OR
                                Texto like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                        Texto like '%enfermedades%' OR
                                        Texto like '%enfermedad%' OR
                                        Texto like '%influenza%' OR
                                        Texto like '%AH1N1%' OR
                                        Texto like '%AH3N2%' OR
                                        Texto like '%centro de salud%' OR

                                        Titulo like '% SSM %' OR
                                        Titulo like '%secretaria de salud michoacan%' OR
                                        Titulo like '%secretaria de salud de michoacan%' OR
                                        Titulo like '%rafael diaz rodriguez %' OR
                                        Titulo like '%rafael diaz%' OR
                                        Titulo like '%diaz rodriguez%' OR
                                        Titulo like '%secretaria de salud%' OR
                                        Titulo like '% SSA %' OR
                                        Titulo like '%imss%' OR
                                Titulo like '%instituto mexicano del seguro social%' OR
                                Titulo like '%seguro social%' OR
                                Titulo like '%jose antonio gonzalez anaya%' OR
                                Titulo like '%gonzalez anaya%' OR
                                Titulo like '%Director del instituto Mexicano del Seguro Social%' OR
                                        Titulo like '%ISSSTE%' OR
                                        Titulo like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                        Titulo like '%sebastian  Lerdo de tejada covarrubias%' OR
                                        Titulo like '%sebastian  Lerdo de tejada%' OR
                                Titulo like '%Director general del issste%' OR
                                Titulo like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                        Titulo like '%enfermedades%' OR
                                        Titulo like '%enfermedad%' OR
                                        Titulo like '%influenza%' OR
                                        Titulo like '%AH1N1%' OR
                                        Titulo like '%AH3N2%' OR
                                        Titulo like '%centro de salud%' OR

                                        Encabezado like '% SSM %' OR
                                        Encabezado like '%secretaria de salud michoacan%' OR
                                        Encabezado like '%secretaria de salud de michoacan%' OR
                                        Encabezado like '%rafael diaz rodriguez %' OR
                                        Encabezado like '%rafael diaz%' OR
                                        Encabezado like '%diaz rodriguez%' OR
                                        Encabezado like '%secretaria de salud%' OR
                                        Encabezado like '% SSA %' OR
                                        Encabezado like '%imss%' OR
                                Encabezado like '%instituto mexicano del seguro social%' OR
                                Encabezado like '%seguro social%' OR
                                Encabezado like '%jose antonio gonzalez anaya%' OR
                                Encabezado like '%gonzalez anaya%' OR
                                Encabezado like '%Director del instituto Mexicano del Seguro Social%' OR
                                        Encabezado like '%ISSSTE%' OR
                                        Encabezado like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                        Encabezado like '%sebastian  Lerdo de tejada covarrubias%' OR
                                        Encabezado like '%sebastian  Lerdo de tejada%' OR
                                Encabezado like '%Director general del issste%' OR
                                Encabezado like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                        Encabezado like '%enfermedades%' OR
                                        Encabezado like '%enfermedad%' OR
                                        Encabezado like '%influenza%' OR
                                        Encabezado like '%AH1N1%' OR
                                        Encabezado like '%AH3N2%' OR
                                        Encabezado like '%centro de salud%'
                        )AND 
                e.periodico=p.nombre AND 
                p.estado like 'Michoacan' AND
                p.Tipo=0    
                        GROUP BY e.periodico, e.NumeroPagina
                ORDER BY p.estado, p.nombre";
            return $query;  
            break;        
        default:
            break;
    }
}
?>
