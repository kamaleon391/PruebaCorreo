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
    switch ($op)
    {
        case 1://PRIMERAS PLANAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                    p.estado,
                    p.gratuito,
                    o.posicion
                    FROM $fechaTabla e, ordenpersonalizado o, periodicos p
                    WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                    AND e.periodico IN (SELECT periodico FROM ordenpersonalizado op) AND e.fecha='$fecha' AND
                    p.gratuito=0
                    order by 9,11";
            return $query;
        break; // DF Pagados
    
        case 2:// PRIMERAS PLANAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                    p.estado,
                    p.gratuito,
                    o.posicion
                    FROM $fechaTabla e, ordenpersonalizado o, periodicos p
                    WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                    AND e.periodico IN (SELECT periodico FROM ordenpersonalizado op) AND e.fecha='$fecha' AND
                    p.gratuito=1
                    order by 9,11
                    ";
            return $query;
        break;// DF Gratuitos
    
        case 3:// PRIMERAS PLANAS
            $query="
                    SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                    p.estado,
                    p.gratuito,
                    o.posicion
                    FROM editorialdia e, ordenpersonalizadoJalisco o, periodicos p
                    WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                    AND e.periodico IN (SELECT periodico FROM ordenpersonalizadoJalisco op) AND e.fecha='$fecha' AND
                    p.gratuito=0
                    order by 9,11";
            return $query;
        break;//Jalisco Pagados
    
        case 4:// PRIMERAS PLANAS
            $query="
                    SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                    p.estado,
                    p.gratuito,
                    o.posicion
                    FROM editorialdia e, ordenpersonalizadoJalisco o, periodicos p
                    WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                    AND e.periodico IN (SELECT periodico FROM ordenpersonalizadoJalisco op) AND e.fecha='$fecha' AND
                    p.gratuito=1
                    GROUP BY e.periodico
                    order by 9,11";
            return $query;
        break;//Jalisco Gratuitos
    
        case 5:// PRIMERAS PLANAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizado o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%Columnas Politicas%' ) AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizado op)  AND e.fecha='$fecha' GROUP BY e.Periodico, e.NumeroPagina order by o.posicion ";
            return $query;
        break;//columnas Politicas
    
        case 6://
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizadoJalisco o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%Columnas Politicas%' OR categoria like '%Opinion%') AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizadoJalisco op)  AND e.fecha='$fecha' GROUP BY e.periodico,e.NumeroPagina order by o.posicion limit 0,20";
            return $query;
        break;//columnas Politicas Jalisco 1
    
        case 6://
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizadoJalisco o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%Columnas Politicas%' OR categoria like '%Opinion%') AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizadoJalisco op)  AND e.fecha='$fecha' GROUP BY e.periodico,e.NumeroPagina order by o.posicion limit 20,20";
            return $query;
        break;//columnas Politicas Jalisco 2

    }
}
?>
