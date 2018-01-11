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
                                Texto like'%Enrique Martinez y Martinez%' OR
                                Texto like'%Martinez y Martinez%' OR
                                Texto like '%secretario de sagarapa%' OR
                                Texto like '%titular de la sagarapa%' OR
                                Texto like '%titular de la secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion%' OR
                                Texto like '%titular de la secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion (SAGARPA)%' OR 
                                (Texto like '%Titular de la secretaria%' AND (Texto like '%sagarpa%' OR texto like '%SAGARPA%')) OR

                                Titulo like'%Enrique Martinez y Martinez%' OR
                                Titulo like'%Martinez y Martinez%' OR
                                Titulo like '%secretario de sagarapa%' OR
                                Titulo like '%titular de la sagarapa%' OR
                                Titulo like '%titular de la secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion%' OR
                                Titulo like '%titular de la secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion (SAGARPA)%' OR 
                                (Titulo like '%Titular de la secretaria%' AND (Titulo like '%sagarpa%' OR Titulo like '%SAGARPA%')) OR


                                Encabezado like'%Enrique Martinez y Martinez%' OR
                                Encabezado like'%Martinez y Martinez%' OR
                                Encabezado like '%secretario de sagarapa%' OR
                                Encabezado like '%titular de la sagarapa%' OR
                                Encabezado like '%titular de la secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion%' OR
                                Encabezado like '%titular de la secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion (SAGARPA)%' OR 
                                (Encabezado like '%Titular de la secretaria%' AND (Encabezado like '%sagarpa%' OR Encabezado like '%SAGARPA%'))
                                )AND 
                            e.periodico=p.nombre AND
                            p.circulacion=1 AND 
                            p.Tipo=0
                            Group by e.periodico, e.NumeroPagina
                            order by e.periodico limit 0,50";
            return $query;  
            break;  
        case 6:// GERENCIA
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE
                                (
                                Texto like '%sagarpa%' OR
                                Texto like '%secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion%' OR
                                Texto like '%secretaria de agricultura%' OR

                                Titulo like '%sagarpa%' OR
                                Titulo like '%secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion%' OR
                                Titulo like '%secretaria de agricultura%' OR

                                Encabezado like '%sagarpa%' OR
                                Encabezado like '%secretaria de agricultura, ganaderia desarrollo rural, pesca y alimentacion%' OR
                                Encabezado like '%secretaria de agricultura%'
                                )AND
                        e.periodico=p.nombre AND
                       p.circulacion=1 AND 
                        p.Tipo=0
                        Group by e.periodico, e.NumeroPagina
                        order by e.periodico";
            return $query;  
            break;  
        case 7://  LICONSA
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                Texto like'%subsecretaria de agricultura%' OR
                                Texto like'%subsecretario de agricultura%' OR
                                Texto like '%subsecretaria de desarrollo rural%' OR
                                Texto like '%subsecretario de desarrollo rural%' OR
                                Texto like '%subsecretaria de fomento a los agronegocios%' OR
                                Texto like '%subsecretario de fomento a los agronegocios%' OR
                                Texto like '%agronegocio%' OR
                                Texto like '%subsecretario de Alimentation y Competitividad de la Sagarpa%' OR


                                Titulo like'%subsecretaria de agricultura%' OR
                                Titulo like'%subsecretario de agricultura%' OR
                                Titulo like'%subsecretaria de desarrollo rural%' OR
                                Titulo like'%subsecretario de desarrollo rural%' OR
                                Titulo like'%subsecretaria de fomento a los agronegocios%' OR
                                Titulo like'%subsecretario de fomento a los agronegocios%' OR
                                Titulo like'%agronegocio%' OR

                                Encabezado like '%subsecretaria de agricultura%'OR
                                Encabezado like '%subsecretario de agricultura%'OR
                                Encabezado like '%subsecretaria de desarrollo rural%'OR
                                Encabezado like '%subsecretario de desarrollo rural%'OR
                                Encabezado like '%subsecretaria de fomento a los agronegocios%'OR
                                Encabezado like '%subsecretario de fomento a los agronegocios%'OR
                                Encabezado like '%agronegocio%'
                               )AND
                            e.periodico=p.nombre AND
                            p.circulacion=1 AND 
                            p.Tipo=0
                            Group by e.periodico, e.NumeroPagina
                            order by e.periodico";
            return $query;  
            break; 
        case 8://  LECHE
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE (
                                    Texto like'%subsecretaria de agricultura%' OR
                                    Texto like'%subsecretario de agricultura%' OR
                                    Texto like '%subsecretaria de desarrollo rural%' OR
                                    Texto like '%subsecretario de desarrollo rural%' OR
                                    Texto like '%subsecretaria de fomento a los agronegocios%' OR
                                    Texto like '%subsecretario de fomento a los agronegocios%' OR
                                    Texto like '%agronegocio%' OR
                                    Texto like '%subsecretario de Alimentation y Competitividad de la Sagarpa%' OR


                                    Titulo like'%subsecretaria de agricultura%' OR
                                    Titulo like'%subsecretario de agricultura%' OR
                                    Titulo like'%subsecretaria de desarrollo rural%' OR
                                    Titulo like'%subsecretario de desarrollo rural%' OR
                                    Titulo like'%subsecretaria de fomento a los agronegocios%' OR
                                    Titulo like'%subsecretario de fomento a los agronegocios%' OR
                                    Titulo like'%agronegocio%' OR

                                    Encabezado like '%subsecretaria de agricultura%'OR
                                    Encabezado like '%subsecretario de agricultura%'OR
                                    Encabezado like '%subsecretaria de desarrollo rural%'OR
                                    Encabezado like '%subsecretario de desarrollo rural%'OR
                                    Encabezado like '%subsecretaria de fomento a los agronegocios%'OR
                                    Encabezado like '%subsecretario de fomento a los agronegocios%'OR
                                    Encabezado like '%agronegocio%'
                                   )
                            AND
                            e.periodico=p.nombre AND
                            p.circulacion=1 AND 
                            p.Tipo=0
                            Group by e.periodico, e.NumeroPagina
                            order by e.periodico";
            return $query;  
            break;  
        case 9://  SEDESOL
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                             WHERE
                                (
                                    Texto like'%agricultura%' OR
                                    Texto like '%masagro%' OR
                                    Texto like '%agroindustria%' OR
                                    Texto like '%fertilizantes%' OR
                                    Texto like '%agricolas%' OR
                                    Texto like '%cana de azucar%' OR
                                    Texto like '% cafe %' OR
                                    Texto like '%maguey%' OR
                                    Texto like '%mezcal%' OR
                                    Texto like '% hule %' OR
                                    Titulo like'%agricultura%' OR
                                    Titulo like '%masagro%' OR
                                    Titulo like '%agroindustria%' OR
                                    Titulo like '%fertilizantes%' OR
                                    Titulo like '%agricolas%' OR
                                    Titulo like '%cana de azucar%' OR
                                    Titulo like '% cafe %' OR
                                    Titulo like '%maguey%' OR
                                    Titulo like '%mezcal%' OR
                                    Titulo like '% hule %' OR
                                    Encabezado like'%agricultura%' OR
                                    Encabezado like '%masagro%' OR
                                    Encabezado like '%agroindustria%' OR
                                    Encabezado like '%fertilizantes%' OR
                                    Encabezado like '%agricolas%' OR
                                    Encabezado like '%cana de azucar%' OR
                                    Encabezado like '% cafe %' OR
                                    Encabezado like '%maguey%' OR
                                    Encabezado like '%mezcal%' OR
                                    Encabezado like '% hule %'
                                   )
                            AND 
                            e.periodico=p.nombre AND
                            p.circulacion=1 AND 
                            p.Tipo=0
                            Group by e.periodico, e.NumeroPagina
                            order by e.periodico limit 0,40";
            return $query;  
            break;   
        case 10://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                Texto like'%ganaderia%' OR
                                Texto like '%fomento ganadero%' OR
                                Texto like '%padron ganadero nacional%' OR
                                Texto like '%comercializacion de la leche%' OR
                                Texto like '%leche%' OR
                                Texto like '%progan%' OR
                                Texto like '%SINIIGA%' OR
                                Texto like '%forrajero%' OR
                                Texto like '%apicola%' OR
                                Texto like '%notiabeja%' OR
                                Texto like '%zoosanitarias%' OR
                                Texto like '% pecuario %' OR
                                Texto like '% bovino %' OR
                                Texto like '% porcino %' OR
                                Texto like '% pollo %' OR
                                Texto like '% ovino %' OR
                                Texto like '% caprino %' OR
                                Texto like '% pavo %' OR
                                Titulo like'%ganaderia%' OR
                                Titulo like '%fomento ganadero%' OR
                                Titulo like '%padron ganadero nacional%' OR
                                Titulo like '%comercializacion de la leche%' OR
                                Titulo like '%leche%' OR
                                Titulo like '%progan%' OR
                                Titulo like '%SINIIGA%' OR
                                Titulo like '%forrajero%' OR
                                Titulo like '%apicola%' OR
                                Titulo like '%notiabeja%' OR
                                Titulo like '%zoosanitarias%' OR
                                Titulo like '% pecuario %' OR
                                Titulo like '% bovino %' OR
                                Titulo like '% porcino %' OR
                                Titulo like '% pollo %' OR
                                Titulo like '% ovino %' OR
                                Titulo like '% caprino %' OR
                                Titulo like '% pavo %' OR
                                Encabezado like'%ganaderia%' OR
                                Encabezado like '%fomento ganadero%' OR
                                Encabezado like '%padron ganadero nacional%' OR
                                Encabezado like '%comercializacion de la leche%' OR
                                Encabezado like '%leche%' OR
                                Encabezado like '%progan%' OR
                                Encabezado like '%SINIIGA%' OR
                                Encabezado like '%forrajero%' OR
                                Encabezado like '%apicola%' OR
                                Encabezado like '%notiabeja%' OR
                                Encabezado like '%zoosanitarias%' OR
                                Encabezado like '% pecuario %' OR
                                Encabezado like '% bovino %' OR
                                Encabezado like '% porcino %' OR
                                Encabezado like '% pollo %' OR
                                Encabezado like '% ovino %' OR
                                Encabezado like '% caprino %' OR
                                Encabezado like '% pavo %' OR
                                Encabezado like '%pollo%'
                               )AND 
                        e.periodico=p.nombre AND
                        e.Fecha = '$fecha' AND 
                        p.circulacion=1 AND 
                        p.Tipo=0
                        Group by e.periodico, e.NumeroPagina
                        order by e.periodico limit 0,40";
            return $query;  
            break;        
        case 11://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE(
                                Texto like'%conapesca%' OR
                                Texto like '%comision nacional de acuacultura y pesca %' OR
                                Texto like '%disel marino%' OR
                                Texto like '%camaron%' OR
                                Texto like '%acuicola%' OR
                                Texto like '%pesquera%' OR
                                Texto like '%CDEP%' OR
                                Texto like '%componente de disminucion del esfuerzo pesquero%' OR
                                Texto like '%embarcaciones%' OR
                                Texto like '%pescados%' OR
                                Texto like '%mariscos%' OR
                                Texto like '%pesqueros%' OR
                                Texto like '%sector pesquero%' OR
                                Texto like '%sector acuicola%' OR
                                Titulo like'%conapesca%' OR
                                Titulo like '%comision nacional de acuacultura y pesca %' OR
                                Titulo like '%disel marino%' OR
                                Titulo like '%camaron%' OR
                                Titulo like '%acuicola%' OR
                                Titulo like '%pesquera%' OR
                                Titulo like '%CDEP%' OR
                                Titulo like '%componente de disminucion del esfuerzo pesquero%' OR
                                Titulo like '%embarcaciones%' OR
                                Titulo like '%pescados%' OR
                                Titulo like '%mariscos%' OR
                                Titulo like '%pesqueros%' OR
                                Titulo like '%sector pesquero%' OR
                                Titulo like '%sector acuicola%' OR
                                Encabezado like'%conapesca%' OR
                                Encabezado like '%comision nacional de acuacultura y pesca %' OR
                                Encabezado like '%disel marino%' OR
                                Encabezado like '%camaron%' OR
                                Encabezado like '%acuicola%' OR
                                Encabezado like '%pesquera%' OR
                                Encabezado like '%CDEP%' OR
                                Encabezado like '%componente de disminucion del esfuerzo pesquero%' OR
                                Encabezado like '%embarcaciones%' OR
                                Encabezado like '%pescados%' OR
                                Encabezado like '%mariscos%' OR
                                Encabezado like '%pesqueros%' OR
                                Encabezado like '%sector pesquero%' OR
                                Encabezado like '%sector acuicola%'
                               )AND 
                        e.periodico=p.nombre AND
                        p.circulacion=1 AND 
                        p.Tipo=0
                        Group by e.periodico, e.NumeroPagina
                        order by e.periodico limit 0,40";
            return $query;  
            break;        
        case 12://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                          WHERE(
                                Texto like'% campo %' OR
                                Texto like '%campo mexicano%' OR
                                Texto like '%campesino%' OR
                                Titulo like'% campo %' OR
                                Titulo like '%campo mexicano%' OR
                                Titulo like '%campesino%' OR
                                Encabezado like'% campo %' OR
                                Encabezado like '%campo mexicano%' OR
                                Encabezado like '%campesino%'
                               )AND 
                        e.periodico=p.nombre AND
                        p.circulacion=1 AND 
                        p.Tipo=0
                        Group by e.periodico, e.NumeroPagina
                        order by e.periodico limit 0,40";
            return $query;  
            break;        
        case 13://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                           WHERE(
                                Texto like'%conapesca%' OR
                                  Texto like '%comision nacional de acuacultura y pesca %' OR
                                  Texto like '%disel marino%' OR
                                  Texto like '%camaron%' OR
                                  Texto like '%acuicola%' OR
                                  Texto like '%pesquera%' OR
                                  Texto like '%CDEP%' OR
                                  Texto like '%componente de disminucion del esfuerzo pesquero%' OR
                                  Texto like '%embarcaciones%' OR
                                  Texto like '%pescados%' OR
                                  Texto like '%mariscos%' OR
                                  Texto like '%pesqueros%' OR
                                  Texto like '%sector pesquero%' OR
                                  Texto like '%sector acuicola%' OR
                                  Titulo like'%conapesca%' OR
                                  Titulo like '%comision nacional de acuacultura y pesca %' OR
                                  Titulo like '%disel marino%' OR
                                  Titulo like '%camaron%' OR
                                  Titulo like '%acuicola%' OR
                                  Titulo like '%pesquera%' OR
                                  Titulo like '%CDEP%' OR
                                  Titulo like '%componente de disminucion del esfuerzo pesquero%' OR
                                  Titulo like '%embarcaciones%' OR
                                  Titulo like '%pescados%' OR
                                  Titulo like '%mariscos%' OR
                                  Titulo like '%pesqueros%' OR
                                  Titulo like '%sector pesquero%' OR
                                  Titulo like '%sector acuicola%' OR
                                  Encabezado like'%conapesca%' OR
                                  Encabezado like '%comision nacional de acuacultura y pesca %' OR
                                  Encabezado like '%disel marino%' OR
                                  Encabezado like '%camaron%' OR
                                  Encabezado like '%acuicola%' OR
                                  Encabezado like '%pesquera%' OR
                                  Encabezado like '%CDEP%' OR
                                  Encabezado like '%componente de disminucion del esfuerzo pesquero%' OR
                                  Encabezado like '%embarcaciones%' OR
                                  Encabezado like '%pescados%' OR
                                  Encabezado like '%mariscos%' OR
                                  Encabezado like '%pesqueros%' OR
                                  Encabezado like '%sector pesquero%' OR
                                  Encabezado like '%sector acuicola%' OR

                                 Texto like'%campo%' OR
                                  Texto like '%campo mexicano%' OR
                                  Texto like '%campesino%' OR
                                  Titulo like'%campo%' OR
                                  Titulo like '%campo mexicano%' OR
                                  Titulo like '%campesino%' OR
                                  Encabezado like'%campo%' OR
                                  Encabezado like '%campo mexicano%' OR
                                  Encabezado like '%campesino%'   OR


                          Texto like'%conapesca%' OR
                                  Texto like '%comision nacional de acuacultura y pesca %' OR
                                  Texto like '%disel marino%' OR
                                  Texto like '%camaron%' OR
                                  Texto like '%acuicola%' OR
                                  Texto like '%pesquera%' OR
                                  Texto like '%CDEP%' OR
                                  Texto like '%componente de disminucion del esfuerzo pesquero%' OR
                                  Texto like '%embarcaciones%' OR
                                  Texto like '%pescados%' OR
                                  Texto like '%mariscos%' OR
                                  Texto like '%pesqueros%' OR
                                  Texto like '%sector pesquero%' OR
                                  Texto like '%sector acuicola%' OR
                                  Titulo like'%conapesca%' OR
                                  Titulo like '%comision nacional de acuacultura y pesca %' OR
                                  Titulo like '%disel marino%' OR
                                  Titulo like '%camaron%' OR
                                  Titulo like '%acuicola%' OR
                                  Titulo like '%pesquera%' OR
                                  Titulo like '%CDEP%' OR
                                  Titulo like '%componente de disminucion del esfuerzo pesquero%' OR
                                  Titulo like '%embarcaciones%' OR
                                  Titulo like '%pescados%' OR
                                  Titulo like '%mariscos%' OR
                                  Titulo like '%pesqueros%' OR
                                  Titulo like '%sector pesquero%' OR
                                  Titulo like '%sector acuicola%' OR
                                  Encabezado like'%conapesca%' OR
                                  Encabezado like '%comision nacional de acuacultura y pesca %' OR
                                  Encabezado like '%disel marino%' OR
                                  Encabezado like '%camaron%' OR
                                  Encabezado like '%acuicola%' OR
                                  Encabezado like '%pesquera%' OR
                                  Encabezado like '%CDEP%' OR
                                  Encabezado like '%componente de disminucion del esfuerzo pesquero%' OR
                                  Encabezado like '%embarcaciones%' OR
                                  Encabezado like '%pescados%' OR
                                  Encabezado like '%mariscos%' OR
                                  Encabezado like '%pesqueros%' OR
                                  Encabezado like '%sector pesquero%' OR
                                  Encabezado like '%sector acuicola%'   OR


                                  Texto like'%ganaderia%' OR
                                  Texto like '%fomento ganadero%' OR
                                  Texto like '%padron ganadero nacional%' OR
                                  Texto like '%comercializacion de la leche%' OR
                                  Texto like '%leche%' OR
                                  Texto like '%progan%' OR
                                  Texto like '%SINIIGA%' OR
                                  Texto like '%forrajero%' OR
                                  Texto like '%apicola%' OR
                                  Texto like '%notiabeja%' OR
                                  Texto like '%zoosanitarias%' OR
                                  Texto like '% pecuario %' OR
                                  Texto like '% bovino %' OR
                                  Texto like '% porcino %' OR
                                  Texto like '% pollo %' OR
                                  Texto like '% ovino %' OR
                                  Texto like '% caprino %' OR
                                  Texto like '% pavo %' OR
                                  Titulo like'%ganaderia%' OR
                                  Titulo like '%fomento ganadero%' OR
                                  Titulo like '%padron ganadero nacional%' OR
                                  Titulo like '%comercializacion de la leche%' OR
                                  Titulo like '%leche%' OR
                                  Titulo like '%progan%' OR
                                  Titulo like '%SINIIGA%' OR
                                  Titulo like '%forrajero%' OR
                                  Titulo like '%apicola%' OR
                                  Titulo like '%notiabeja%' OR
                                  Titulo like '%zoosanitarias%' OR
                                  Titulo like '% pecuario %' OR
                                  Titulo like '% bovino %' OR
                                  Titulo like '% porcino %' OR
                                  Titulo like '% pollo %' OR
                                  Titulo like '% ovino %' OR
                                  Titulo like '% caprino %' OR
                                  Titulo like '% pavo %' OR
                                  Encabezado like'%ganaderia%' OR
                                  Encabezado like '%fomento ganadero%' OR
                                  Encabezado like '%padron ganadero nacional%' OR
                                  Encabezado like '%comercializacion de la leche%' OR
                                  Encabezado like '%leche%' OR
                                  Encabezado like '%progan%' OR
                                  Encabezado like '%SINIIGA%' OR
                                  Encabezado like '%forrajero%' OR
                                  Encabezado like '%apicola%' OR
                                  Encabezado like '%notiabeja%' OR
                                  Encabezado like '%zoosanitarias%' OR
                                  Encabezado like '% pecuario %' OR
                                  Encabezado like '% bovino %' OR
                                  Encabezado like '% porcino %' OR
                                  Encabezado like '% pollo %' OR
                                  Encabezado like '% ovino %' OR
                                  Encabezado like '% caprino %' OR
                                  Encabezado like '% pavo %' OR
                                  Encabezado like '%pollo%'
                                 )AND 
                        e.periodico=p.nombre AND
                        e.Fecha = '$fecha' AND 
                        p.circulacion=1 AND 
                        p.Tipo=0
                        Group by e.periodico, e.NumeroPagina
                        order by e.periodico limit 0,25";
            return $query;  
            break;        
        default:
            break;
    }
}
?>
