<?php

function numberNotes($optionCase, $fecha)
{
    $query = query($optionCase, $fecha);
    $resultado = mysql_query($query);
    if(mysql_num_rows($resultado) > 0)
    {
        return true;
    }
    return false;
}

function query($op,$fechaTabla)
{
        $fecha=$fechaTabla;
        $FechaCliente = strtotime($fechaTabla);
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);  
        $condicionFecha = "";   

        if ($FechaCliente == $fecha_actual)
        {
            $fechaTabla="noticiasDia";
            $condicionFecha = "n.Fecha = CURDATE() AND ";  
        }
        else
        {
            $fechaTabla="noticiasSemana";
        }
  
        $query = "SELECT  'Secretario' as Tema, n.idEditorial,
                   p.Nombre as 'Periodico',n.Fecha,n.Titulo,n.Texto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   p.Estado as 'NoEstado',
                   e.Nombre as 'Estado',
                   n.NumeroPagina,
                   s.seccion
                   FROM ".$fechaTabla." n, (SELECT * FROM periodicos WHERE Estado = ".$op.") p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   n.Categoria <> 80 AND
                   ".$condicionFecha ."
                   p.estado=e.idEstado AND
                   (
                        
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
              group by n.Periodico,n.NumeroPagina";

        return $query;  
    
}
?>
