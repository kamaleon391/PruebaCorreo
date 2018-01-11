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
                        FROM ".$fechaTabla." e, periodicos p,ordenpersonalizadojalisco o
                        WHERE(
                        Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                        Texto like '%Jorge Aristoteles Sandoval%' OR
                        Texto like '%Jorge Sandoval Diaz%' OR
                        Texto like '%Aristoteles Sandoval Diaz%' OR
                        Texto like '%Aristoteles Sandoval%' OR
                        Texto like '%gobernador del estado de jalisco%' OR
                        Texto like '%gobernador de jalisco%' OR
                        Texto like '%Aristoteles%' AND (Texto not like '%aristoteles nuñez%' OR Texto not like '%SAT%') OR
                        Texto like '%gobernador del estado%' AND (Texto like '%jalisco%' OR Texto like '%sandoval diaz%' OR Texto like '%guadalajara%' OR Texto like '%area metropolitana%') OR
                        Texto like '% Aris %'  OR (
                        Texto like '%gobernador%' AND (
                                  Texto like '%iprovipe%' OR 
                                  Texto like '%secretaria de movilidad%' OR 
                                  Texto like '%Armando garcia Estrada%' OR 
                                  Texto like '%Tlajomulco%' OR 
                                  Texto like '%jorge Sandoval%' OR 
                                  Texto like'%gabriel valencia%' AND
                                  Texto not like '%exgobernador de jalisco%' AND
                                  Texto not like '%ex gobernador%'
                            ) 
                         )  OR
                        Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                        Titulo like '%Jorge Aristoteles Sandoval%' OR
                        Titulo like '%Jorge Sandoval Diaz%' OR
                        Titulo like '%Aristoteles Sandoval Diaz%' OR
                        Titulo like '%Aristoteles Sandoval%' OR
                        Titulo like '%gobernador del estado de jalisco%' OR
                        Titulo like '%gobernador de jalisco%' OR
                        Titulo like '%Aristoteles%' AND (Titulo not like '%aristoteles nuñez%' OR Titulo not like '%SAT%') OR
                        Titulo like '%gobernador del estado%' AND (Titulo like '%jalisco%' OR Titulo like '%sandoval diaz%' OR Titulo like '%guadalajara%' OR Titulo like '%area metropolitana%') OR
                        Titulo like '% Aris %'  OR (
                            Titulo like '%gobernador%' AND (
                                  Titulo like '%iprovipe%' OR 
                                  Titulo like '%secretaria de movilidad%' OR 
                                  Titulo like '%Armando garcia Estrada%' OR 
                                  Titulo like '%Tlajomulco%' OR 
                                  Titulo like '%jorge Sandoval%' OR 
                                  Titulo like'%gabriel valencia%' AND
                                  Titulo not like '%exgobernador de jalisco%'
                            ) 
                         )
                        OR
                        Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                        Encabezado like '%Jorge Aristoteles Sandoval%' OR
                        Encabezado like '%Jorge Sandoval Diaz%' OR
                        Encabezado like '%Aristoteles Sandoval Diaz%' OR
                        Encabezado like '%Aristoteles Sandoval%' OR
                        Encabezado like '%gobernador del estado de jalisco%' OR
                        Encabezado like '%gobernador de jalisco%' OR
                        Encabezado like '%Aristoteles%' AND (Encabezado not like '%aristoteles nuñez%' OR Encabezado not like '%SAT%') OR
                        Encabezado like '%gobernador del estado%' AND (Encabezado like '%jalisco%' OR Encabezado like '%sandoval diaz%' OR Encabezado like '%guadalajara%' OR Encabezado like '%area metropolitana%') OR
                        Encabezado like '% Aris %'  OR (
                        Encabezado like '%gobernador%' AND (
                                  Encabezado like '%iprovipe%' OR 
                                  Encabezado like '%secretaria de movilidad%' OR 
                                  Encabezado like '%Armando garcia Estrada%' OR 
                                  Encabezado like '%Tlajomulco%' OR 
                                  Encabezado like '%jorge Sandoval%' OR 
                                  Encabezado like'%gabriel valencia%' AND
                                  Encabezado not like '%exgobernador de jalisco%'
                            ) 
                         )
                        )AND
                       (Texto not like '%exgobernador%' AND 
                        Texto not like '%exgobernador de jalisco%' AND
                        Texto not like '%servicio de administracion tributaria%' AND
                        Texto not like '%carril%' AND
                        Texto not like '%ex gobernador%' OR 
                        Texto like '%sandoval diaz%' OR 
                        Texto like '% aristoteles sandoval%')
                      AND e.periodico=p.nombre 
                      AND e.periodico=o.periodico
                      AND p.estado like 'Jalisco' AND
                     p.Tipo=0
                    order by o.posicion limit 12";
            return $query;  
            break;  
        case 6:// Primeras Planas Jalisco
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM ".$fechaTabla." e, ordenpersonalizadojalisco o, periodicos p
                    WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND (e.categoria like 'Nota Principal' OR e.categoria like 'portada')
                    AND e.periodico 
                    IN (select Nombre from periodicos where periodicos.Estado in ('jalisco') )
                    group by  e.periodico order by o.posicion";
            return $query;  
            break;  
        case 7://  CARTONES Jalisco
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM ".$fechaTabla." e, ordenpersonalizadojalisco o
                    WHERE 
                    e.periodico=o.periodico AND
                    (categoria like '%cartones%') AND 
                    e.periodico in(select Nombre from periodicos where periodicos.Estado in ('jalisco') ) 
                    order by o.posicion";
            return $query;  
            break; 
        default:
            break;
    }
}
?>
