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
                                Texto like '%Financiamiento Rural%' OR 
                                Texto like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
                                Texto like '%financiera rural%' OR 

                                Titulo like '%Financiamiento Rural%' OR 
                                Titulo like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
                                Titulo like '%financiera rural%' OR 

                                Encabezado like '%Financiamiento Rural%' OR 
                                Encabezado like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
                                Encabezado like '%financiera rural%' 
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
                                Texto like '%juan carlos cortes garcia%' OR 
                                Texto like '%juan cortes garcia%' OR 
                                Texto like '%juan carlos cortes%' OR 

                                Titulo like '%juan carlos cortes garcia%' OR 
                                Titulo like '%juan cortes garcia%' OR 
                                Titulo like '%juan carlos cortes%' OR 

                                Encabezado like '%juan carlos cortes garcia%' OR 
                                Encabezado like '%juan cortes garcia%' OR 
                                Encabezado like '%juan carlos cortes%' 
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
                                Texto like '%José Salvador De La Mora Real%' OR
                                Texto like '%Omar Cuevas Montiel%' OR
                                Texto like '%Leticia Galicia Sánchez%' OR
                                Texto like '%Maria Dolores Díaz De La Serna  González %' OR
                                Texto like '%Maria Angelica Damian Villa%' OR
                                Texto like '%Héctor Fabian López Ramos%' OR
                                Texto like '%Claudia Rosas De La Rosa%' OR
                                Texto like '%Juan José Garcia  Rojas%' OR
                                Texto like '%José Alfonso Martínez Ruíz%' OR
                                Texto like '%Arturo Oscar Ortega Ramos%' OR
                                Texto like '%Hugo Gabino Rojas Hurtado%' OR
                                Texto like '%Martha Elena Alfaro Flores%' OR
                                Texto like '%Maria Alejandra  Cerón Betanzos%' OR
                                Texto like '% Evelin Flores  Torres%' OR
                                Texto like '%Daniel Martínez Vazquez%' OR
                                Texto like '%Alejandra Uribe Pérez%' OR
                                Texto like '%José Cervantes Calderón%' OR
                                Texto like '%Sergio Ortega Hernandez%' OR
                                Texto like '%Oscar Reséndiz Reséndiz%' OR
                                Texto like '%Daniela Contreras Tudon%' OR
                                Texto like '%Nallely Rioja García%' OR
                                Texto like '%Elena Amalia Hinojosa Herrera%' OR
                                Texto like '%Sandra Alvarez Cortes%' OR

                                Titulo like '%José Salvador De La Mora Real%' OR
                                Titulo like '%Omar Cuevas Montiel%' OR
                                Titulo like '%Leticia Galicia Sánchez%' OR
                                Titulo like '%Maria Dolores Díaz De La Serna  González %' OR
                                Titulo like '%Maria Angelica Damian Villa%' OR
                                Titulo like '%Héctor Fabian López Ramos%' OR
                                Titulo like '%Claudia Rosas De La Rosa%' OR
                                Titulo like '%Juan José Garcia  Rojas%' OR
                                Titulo like '%José Alfonso Martínez Ruíz%' OR
                                Titulo like '%Arturo Oscar Ortega Ramos%' OR
                                Titulo like '%Hugo Gabino Rojas Hurtado%' OR
                                Titulo like '%Martha Elena Alfaro Flores%' OR
                                Titulo like '%Maria Alejandra  Cerón Betanzos%' OR
                                Titulo like '% Evelin Flores  Torres%' OR
                                Titulo like '%Daniel Martínez Vazquez%' OR
                                Titulo like '%Alejandra Uribe Pérez%' OR
                                Titulo like '%José Cervantes Calderón%' OR
                                Titulo like '%Sergio Ortega Hernandez%' OR
                                Titulo like '%Oscar Reséndiz Reséndiz%' OR
                                Titulo like '%Daniela Contreras Tudon%' OR
                                Titulo like '%Nallely Rioja García%' OR
                                Titulo like '%Elena Amalia Hinojosa Herrera%' OR
                                Titulo like '%Sandra Alvarez Cortes%' OR

                                Encabezado like '%José Salvador De La Mora Real%' OR
                                Encabezado like '%Omar Cuevas Montiel%' OR
                                Encabezado like '%Leticia Galicia Sánchez%' OR
                                Encabezado like '%Maria Dolores Díaz De La Serna  González %' OR
                                Encabezado like '%Maria Angelica Damian Villa%' OR
                                Encabezado like '%Héctor Fabian López Ramos%' OR
                                Encabezado like '%Claudia Rosas De La Rosa%' OR
                                Encabezado like '%Juan José Garcia  Rojas%' OR
                                Encabezado like '%José Alfonso Martínez Ruíz%' OR
                                Encabezado like '%Arturo Oscar Ortega Ramos%' OR
                                Encabezado like '%Hugo Gabino Rojas Hurtado%' OR
                                Encabezado like '%Martha Elena Alfaro Flores%' OR
                                Encabezado like '%Maria Alejandra  Cerón Betanzos%' OR
                                Encabezado like '% Evelin Flores  Torres%' OR
                                Encabezado like '%Daniel Martínez Vazquez%' OR
                                Encabezado like '%Alejandra Uribe Pérez%' OR
                                Encabezado like '%José Cervantes Calderón%' OR
                                Encabezado like '%Sergio Ortega Hernandez%' OR
                                Encabezado like '%Oscar Reséndiz Reséndiz%' OR
                                Encabezado like '%Daniela Contreras Tudon%' OR
                                Encabezado like '%Nallely Rioja García%' OR
                                Encabezado like '%Elena Amalia Hinojosa Herrera%' OR
                                Encabezado like '%Sandra Alvarez Cortes%' 

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
                                    Texto like'%Enrique pena nieto%' OR  
                                    Texto like 'Enrique pena nieto' OR
                                    Texto like '% epn %' OR

                                    Titulo like'%Enrique pena nieto%' OR 
                                    Titulo like '%Enrique pena nieto%'  OR 
                                    Titulo like ' % EPN % '  OR 

                                    Encabezado like '%Enrique pena nieto%' OR 
                                    Encabezado like '%Enrique pena nieto%' OR
                                    Encabezado like ' % EPN % '
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
                                    Texto like '%shcp%' OR
                                    Texto like '%secretaria de hacienda y credito publico%' OR
                                    Texto like '%secretaria de hacienda%' OR

                                    Titulo like '%shcp%' OR
                                    Titulo like '%secretaria de hacienda y credito publico%' OR
                                    Titulo like '%secretaria de hacienda%' OR

                                    Encabezado like '%shcp%' OR
                                    Encabezado like '%secretaria de hacienda y credito publico%' OR
                                    Encabezado like '%secretaria de hacienda%' 

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
                                Texto like '% SAGARPA %' OR 
                                Texto like '%secretaria de agricultura, ganaderia, desarrollo rural, pesca y alimentacion%' OR 
                                Texto like '%secretaria de agricultura ganaderia desarrollo rural pesca y alimentacion%' OR 
                                Texto like '%secretaria de agricultura %' OR 

                                Titulo like '% SAGARPA %' OR 
                                Titulo like '%secretaria de agricultura, ganaderia, desarrollo rural, pesca y alimentacion%' OR 
                                Titulo like '%secretaria de agricultura ganaderia desarrollo rural pesca y alimentacion%' OR 
                                Titulo like '%secretaria de agricultura %' OR 

                                Encabezado like '% SAGARPA %' OR 
                                Encabezado like '%secretaria de agricultura, ganaderia, desarrollo rural, pesca y alimentacion%' OR 
                                Encabezado like '%secretaria de agricultura ganaderia desarrollo rural pesca y alimentacion%' OR 
                                Encabezado like '%secretaria de agricultura %'

                                )      
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,50";
            return $query;  
            break;        
        case 11://  SEDATU
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '%Secretaria de la reforma agraria%' OR 
                                    Texto like '% SRA %' OR 
                                    Texto like '% SEDATU %' OR 

                                    Titulo like '%Secretaria de la reforma agraria%' OR 
                                    Titulo like '% SRA %' OR 
                                    Titulo like '% SEDATU %' OR 

                                    Encabezado like '%Secretaria de la reforma agraria%' OR 
                                    Encabezado like '% SRA %' OR
                                    Encabezado like '% SEDATU %' 
                                ) 	        
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,50";
            return $query;  
            break;        
        case 12://  CNBV
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '% CNBV %' OR 
                                    Texto like '%comision nacional bancaria y de valores%' OR 

                                    Titulo like '% CNBV %' OR 
                                    Titulo like '%comision nacional bancaria y de valores%' OR 

                                    Encabezado like '% CNBV %' OR 
                                    Encabezado like '%comision nacional bancaria y de valores%'  

                                ) 	     
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,50";
            return $query;  
            break;        
        case 13://  IPAB
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '%Instituto para la proteccion al ahorro bancario%' OR 
                                    Texto like '% ipab %' OR

                                    Titulo like '%Instituto para la proteccion al ahorro bancario%' OR 
                                    Titulo like '% ipab %' OR

                                    Encabezado like '%Instituto para la proteccion al ahorro bancario%' OR 
                                    Encabezado like '% ipab %' 
                                 ) 	       
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,50";
            return $query;  
            break;        
        case 14://  Bancos
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '%Banco Nacional de credito agricola%' OR 
                                    Texto like '%banco nacional agropecuario%' OR
                                    Texto like '%banrural%' OR
                                    Texto like '%financiera rural%' OR
                                    Texto like '%banco de financiera rural%' OR
                                    Texto like '%banco y financiera rural%' OR
                                    Texto like '%bancos%' OR

                                    Titulo like '%Banco Nacional de credito agricola%' OR 
                                    Titulo like '%banco nacional agropecuario%' OR
                                    Titulo like '%banrural%' OR
                                    Titulo like '%financiera rural%' OR
                                    Titulo like '%banco de financiera rural%' OR
                                    Titulo like '%banco y financiera rural%' OR
                                    Titulo like '%bancos%' OR

                                    Encabezado like '%Banco Nacional de credito agricola%' OR 
                                    Encabezado like '%banco nacional agropecuario%' OR
                                    Encabezado like '%banrural%' OR
                                    Encabezado like '%financiera rural%' OR
                                    Encabezado like '%banco de financiera rural%' OR
                                    Encabezado like '%banco y financiera rural%' OR
                                    Encabezado like '%bancos%' 
                                )
                                AND
                                (
                                    Texto like '%financiera Rural%' OR

                                    Titulo like '%financiera Rural%' OR

                                    Encabezado like '%financiera Rural%'
                                 )	       
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,50";
            return $query;  
            break;        
        case 15://  Seguros
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '%Seguros financiera rural%' OR 
                                    Texto like '%seguros y financiera rural%' OR
                                    Texto like '%seguros con financiera rural%' OR
                                    Texto like '%seguros%' OR

                                    Titulo like '%Seguros financiera rural%' OR 
                                    Titulo like '%seguros y financiera rural%' OR
                                    Titulo like '%seguros con financiera rural%' OR
                                    Titulo like '%seguros%' OR

                                    Encabezado like '%Seguros financiera rural%' OR 
                                    Encabezado like '%seguros y financiera rural%' OR
                                    Encabezado like '%seguros con financiera rural%' OR
                                    Encabezado like '%seguros%' 
                                ) 	        
                                AND
                                (
                                    Texto like '%financiera rural%' OR
                                    Titulo like '%financiera rural%' OR
                                    Encabezado like '%financiera rural%' 
                                )	       
                            AND e.periodico=p.nombre AND p.circulacion='1' AND Tipo=0
                    group by idEditorial            
                    order by p.estado, p.nombre  LIMIT 0,50";
            return $query;  
            break;        
        case 16://  VARIOS
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM  ".$fechaTabla." e, periodicos p 
                            WHERE(
                                    Texto like '% SASA % ' OR 
                                    Texto like '%Sector Agriultor%' OR
                                    Texto like '%Sector Pecuario%' OR
                                    Texto like '%Sector Pesquero%' OR
                                    Texto like '%Sector Forestal%' OR
                                    Texto like '%Medio Ambiente%' OR

                                    Titulo like '% SASA % ' OR 
                                    Titulo like '%Sector Agriultor%' OR
                                    Titulo like '%Sector Pecuario%' OR
                                    Titulo like '%Sector Pesquero%' OR
                                    Titulo like '%Sector Forestal%' OR
                                    Titulo like '%Medio Ambiente%' OR

                                    Encabezado like '% SASA % ' OR 
                                    Encabezado like '%Sector Agriultor%' OR
                                    Encabezado like '%Sector Pecuario%' OR
                                    Encabezado like '%Sector Pesquero%' OR
                                    Encabezado like '%Sector Forestal%' OR
                                    Encabezado like '%Medio Ambiente%'

                                   ) 
                                   AND
                                   (
                                    Texto like '%financiera rural%' OR 
                                    Titulo like '%financiera rural%' OR 
                                    Encabezado like '%financiera rural%' 
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
