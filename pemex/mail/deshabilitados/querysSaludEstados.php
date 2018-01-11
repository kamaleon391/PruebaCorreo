<?php
function query($op,$fechaTabla,$estado){
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
                        FROM ".$fechaTabla." e, periodicos p 
                     WHERE(
                            Texto like'%mercedes juan%' OR
                            Texto like'%mercedes juan lopez%' OR
                            Titulo like'%mercedes juan%' OR
                            Titulo like'%mercedes juan lopez%' OR
                            Encabezado like '%mercedes juan%' OR
                            Encabezado like '%mercedes juan lopez%'
                           )
                    AND e.periodico=p.nombre AND 
                    p.estado like '%$estado%' 
                    Group by e.periodico, e.numeroPagina 
                    Order by e.periodico";
            return $query;
            break;
        case 2:// COLUMNAS POLITICAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,periodicos p 
                        WHERE (
                                Texto like '% SSA %' OR
                                Texto like '% secretaria de salud %' OR
                                Texto like '% secretaria de salud federal %' OR
                                Texto like '%imss%' OR
                                Texto like '%instituto mexicano del seguro social%' OR
                                Texto like '%seguro social%' OR
                                Texto like '%jose antonio gonzalez anaya%' OR
                                Texto like '%gonzalez anaya%' OR
                                Texto like '%Director del instituto Mexicano del Seguro Social%' OR
                                Texto like '% ISSSTE %' OR
                                Texto like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Texto like '%sebastian  Lerdo de tejada covarrubias%' OR
                                Texto like '%sebastian  Lerdo de tejada%' OR
                                Texto like '%Director general del issste%' OR
                                Texto like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR

                                Titulo like '% SSA %' OR
                                Titulo like '% secretaria de salud %' OR
                                Titulo like '% secretaria de salud federal %' OR
                                Titulo like '%imss%' OR
                                Titulo like '%instituto mexicano del seguro social%' OR
                                Titulo like '%seguro social%' OR
                                Titulo like '%jose antonio gonzalez anaya%' OR
                                Titulo like '%gonzalez anaya%' OR
                                Titulo like '%Director del instituto Mexicano del Seguro Social%' OR
                                Titulo like '% ISSSTE %' OR
                                Titulo like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Titulo like '%sebastian  Lerdo de tejada covarrubias%' OR
                                Titulo like '%sebastian  Lerdo de tejada%' OR
                                Titulo like '%Director general del issste%' OR
                                Titulo like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%' OR

                                Encabezado like '% SSA %' OR
                                Encabezado like '% secretaria de salud %' OR
                                Encabezado like '% secretaria de salud federal %' OR
                                Encabezado like '%imss%' OR
                                Encabezado like '%instituto mexicano del seguro social%' OR
                                Encabezado like '%seguro social%' OR
                                Encabezado like '%jose antonio gonzalez anaya%' OR
                                Encabezado like '%gonzalez anaya%' OR
                                Encabezado like '%Director del instituto Mexicano del Seguro Social%' OR
                                Encabezado like '% ISSSTE %' OR
                                Encabezado like '%instituto de seguridad  y servicios  de los trabajadores del Estado%' OR
                                Encabezado like '%sebastian  Lerdo de tejada covarrubias%' OR
                                Encabezado like '%sebastian  Lerdo de tejada%' OR
                                Encabezado like '%Director general del issste%' OR
                                Encabezado like '%Director general del instituto de seguridad  y servicios  de los trabajadores del Estado%'

                                )AND 
                            e.periodico=p.nombre AND 
                            p.estado like '%$estado%' AND
                            p.Tipo=0    
                            GROUP BY e.periodico, e.NumeroPagina
                            ORDER BY p.nombre Limit 0,15";
            return $query;
            break;
        default:
            break;
    }
}
?>
