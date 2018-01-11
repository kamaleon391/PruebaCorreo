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
        case 5:// Financiera Rural
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                Texto like '%Maria teresa franco gonzalez salas%' OR 
                                Texto like '%Maria teresa franco gonzalez%' OR 
                                Texto like '%teresa franco gonzalez salas%' OR 

                                Titulo like '%Maria teresa franco gonzalez salas%' OR 
                                Titulo like '%Maria teresa franco gonzalez%' OR 
                                Titulo like '%teresa franco gonzalez salas%' OR 

                                Encabezado like '%Maria teresa franco gonzalez salas%' OR 
                                Encabezado like '%Maria teresa franco gonzalez%' OR 
                                Encabezado like '%teresa franco gonzalez salas%'  

                                )	  
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre";
            return $query;  
            break;  
        case 6:// Direccion General
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                Texto like '%INAH%' OR 
                                Texto like '%Instituto nacional de Antropologia e Historia%' OR 

                                Titulo like '%INAH%' OR 
                                Titulo like '%Instituto nacional de Antropologia e Historia%' OR 

                                Encabezado like '%INAH%' OR
                                Encabezado like '%Instituto nacional de Antropologia e Historia%' 
                                  )	   
                            AND e.periodico=p.nombre AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre LIMIT 0,50";
            return $query;  
            break; 
        case 7:// Funcionarios
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                Texto like '%conaculta%' OR
                                Texto like '%Consejo Nacional para la Cultura y las Artes%' OR

                                Titulo like '%conaculta%' OR
                                Titulo like '%Consejo Nacional para la Cultura y las Artes%' OR

                                Encabezado like '%conaculta%' OR
                                Encabezado like '%Consejo Nacional para la Cultura y las Artes%'

                                ) 
                            AND e.periodico=p.nombre AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,40";
            return $query;  
            break;  
        case 8://  Presidencia
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                Texto like'%centros prehispanicos%' OR  
                                Texto like'%prehispanicos%' OR  

                                Titulo like'%centros prehispanicos%' OR 
                                Titulo like'%prehispanicos%' OR 

                                Encabezado like '%centros prehispanicos%' OR
                                Encabezado like '%prehispanicos% '
                          ) 
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,40";
            return $query;  
            break;   
        case 9:// SHCP
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                Texto like '%Centros Historicos%' OR
                                Texto like '%Galeria de Arte%' OR
                                Texto like '%Galeria%' AND( Texto like '%historia%' OR Texto like '%historica%' OR Texto like '%historico%') OR

                                Titulo like '%Centros Historicos%' OR
                                Titulo like '%Galeria de Arte%' OR
                                Titulo like '%Galeria%' AND( Texto like '%historia%' OR Texto like '%historica%' OR Texto like '%historico%') OR

                                Encabezado like '%Centros Historicos%' OR
                                Encabezado like '%Galeria de Arte%' OR
                                Encabezado like '%Galeria%' AND( Texto like '%historia%' OR Texto like '%historica%' OR Texto like '%historico%') 

                                )      
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,40";
            return $query;  
            break;        
        case 10:// Sagarpa
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                Texto like '%Museos%' OR
                                Texto like '%Museo %' OR

                                Titulo like '%Museos%' OR
                                Titulo like '%Museo %' OR

                                Encabezado like '%Museos%' OR
                                Encabezado like '%Museo %'

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
