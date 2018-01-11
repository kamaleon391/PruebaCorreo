<?php
function query($op,$fechaTabla){
        $fecha=$fechaTabla;
        $FechaCliente = strtotime($fechaTabla);
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);     
        if ($FechaCliente == $fecha_actual)
        {
            $fechaTabla="editorialmensual";
        }
        else
        {
            $fechaTabla="editorialmensual";
        }
    switch ($op) {
        case 1:// PRIMERAS PLANAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,p.estado
                        FROM editorialsemanal e,  periodicos p
                        WHERE  (
                        Texto like '%Marihuana%' OR
                        Titulo like '%Marihuana%' OR
                        Encabezado like '%Marihuana%'
                        ) AND
                        fecha = '$fecha' AND 
                        p.Nombre=e.Periodico AND 
                        p.circulacion=0
                        ORDER BY p.Nombre,p.Estado";
            return $query;
        break;
   
    }
}
?>
