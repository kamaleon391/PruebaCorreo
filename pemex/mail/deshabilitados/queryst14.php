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
                            Texto  like '% ESSA %' OR
                            Texto  like '%exportadora de sal%' OR
                            Texto  like '%jorge humberto lopez-portillo besave%' OR
                            Texto  like '%jorge humberto lopez-portillo%' OR
                            Texto  like '%jorge lopez-portillo%' OR

                            Titulo like '% ESSA %' OR
                            Titulo like '%exportadora de sal%' OR
                            Titulo  like '%jorge humberto lopez-portillo besave%' OR
                            Titulo  like '%jorge humberto lopez-portillo%' OR
                            Titulo  like '%jorge lopez-portillo%' OR

                            Encabezado like '% ESSA %' OR
                            Encabezado like '%exportadora de sal%' OR
                            Encabezado  like '%jorge humberto lopez-portillo besave%' OR
                            Encabezado  like '%jorge humberto lopez-portillo%' OR
                            Encabezado  like '%jorge lopez-portillo%'
                            )AND (Texto not like '%kuwait%' AND Texto not like '%Kuw%') 
                            AND e.periodico=p.nombre AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre";
            return $query;  
            break;  
        case 6:// GERENCIA
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                            Texto  like '% ESSA %' OR
                            Texto  like '%exportadora de sal%' OR
                            Texto  like '%jorge humberto lopez-portillo besave%' OR
                            Texto  like '%jorge humberto lopez-portillo%' OR
                            Texto  like '%jorge lopez-portillo%' OR

                            Titulo like '% ESSA %' OR
                            Titulo like '%exportadora de sal%' OR
                            Titulo  like '%jorge humberto lopez-portillo besave%' OR
                            Titulo  like '%jorge humberto lopez-portillo%' OR
                            Titulo  like '%jorge lopez-portillo%' OR

                            Encabezado like '% ESSA %' OR
                            Encabezado like '%exportadora de sal%' OR
                            Encabezado  like '%jorge humberto lopez-portillo besave%' OR
                            Encabezado  like '%jorge humberto lopez-portillo%' OR
                            Encabezado  like '%jorge lopez-portillo%'
                            )AND (Texto not like '%kuwait%' AND Texto not like '%Kuw%')
                            AND e.periodico=p.nombre AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,30";
            return $query;  
            break;
        
        case 7://  Presidencia
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
                               )
                            AND e.periodico=p.nombre AND p.circulacion=1 AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre LIMIT 0,30";
            return $query;  
            break; //Presidencia
        
        case 8://  LECHE
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '% leche %' OR
                                    Titulo like '% leche %' OR
                                    Encabezado like '% leche %'
                                   )
                            AND e.periodico=p.nombre AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,40";
            return $query;  
            break;  
        
        case 9://  Idelfonso Guajardo Villareal
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                            Texto like '%Ildefonso Guajardo Villareal%' OR
                            Texto like '%Guajardo Villareal%' OR
                            Texto like '%Ildefonso Guajardo%' OR
                            Texto like '%Ildefonso Villareal%' OR        
                            Texto Like '%Secretaria de Economia%' OR
                            Texto Like '%Secretaria de Economia%' OR
                            Texto Like '%(se)%' OR
                            Texto Like '%Secretario de Economia%' OR

                            Titulo like '%Ildefonso Guajardo Villareal%' OR
                            Titulo like '%Guajardo Villareal%' OR
                            Titulo like '%Ildefonso Guajardo%' OR
                            Titulo like '%Ildefonso Villareal%' OR
                            Titulo Like '%Secretaria de Economia%' OR
                            Titulo Like '%Secretaria de Economia%' OR
                            Titulo Like '%(se)%' OR
                            Titulo Like '%Secretario de Economia%' OR

                            Encabezado like '%Ildefonso Guajardo Villareal%' OR
                            Encabezado like '%Guajardo Villareal%' OR
                            Encabezado like '%Ildefonso Guajardo%' OR
                            Encabezado like '%Ildefonso Villareal%' OR        
                            Encabezado Like '%Secretaria de Economia%' OR
                            Encabezado Like '%Secretaria de Economia%' OR
                            Encabezado Like '%(se)%' OR
                            Encabezado Like '%Secretario de Economia%'
                           )
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,40";
            return $query;  
        break;//  Idelfonso Guajardo Villareal 
        
        case 10://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                            Texto like '%luis videgaray caso%' OR
                            Texto like '%luis videgaray%' OR
                            Texto like '%videgaray caso%' OR
                            Texto like '%luis videgaray caso%' OR
                            Texto like '%shcp%' OR
                            Texto like '%secretaria de hacienda y credito publico%' OR

                            Titulo like '%luis videgaray caso%' OR
                            Titulo like '%luis videgaray%' OR
                            Titulo like '%videgaray caso%' OR
                            Titulo like '%luis videgaray caso%' OR
                            Titulo like '%shcp%' OR
                            Titulo like '%secretaria de hacienda y credito publico%' OR

                            Encabezado like '%luis videgaray caso%' OR
                            Encabezado like '%luis videgaray%' OR
                            Encabezado like '%videgaray caso%' OR
                            Encabezado like '%luis videgaray caso%' OR
                            Encabezado like '%shcp%' OR
                            Encabezado like '%secretaria de hacienda y credito publico%'
                           )
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,50";
            return $query;  
            break;  
        
        default:
            break;
        
    }
}
?>
