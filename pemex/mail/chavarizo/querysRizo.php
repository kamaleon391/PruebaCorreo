<?php
function query($op,$Tabla){
       $fecha=$Tabla;
       $FechaCliente = strtotime($Tabla);
        
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);
            
        if ($FechaCliente == $fecha_actual)
        {
            $Tabla="noticiasDia";
        }
        else
        {
            $Tabla="noticiasSemana";
        }
        
        switch ($op){
            case 1: //Salvador Rizo Castelo
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                        Texto like '%salvador rizo castelo%' OR
                        Texto like '%salvador rizo%' OR
                        Texto like '%rizo castelo%' OR
                        Texto like '%Chava Rizo%' OR

                        Titulo like '%salvador rizo castelo%' OR
                        Titulo like '%salvador rizo%' OR
                        Titulo like '%rizo castelo%' OR
                        Titulo like '%Chava Rizo%' OR

                        Encabezado like '%salvador rizo castelo%' OR
                        Encabezado like '%salvador rizo%' OR
                        Encabezado like '%rizo castelo%' OR
                        Encabezado like '%Chava Rizo%' OR

                        PieFoto like '%salvador rizo castelo%' OR
                        PieFoto like '%salvador rizo%' OR
                        PieFoto like '%rizo castelo%' OR
                        PieFoto like '%Chava Rizo%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  
            break;
        
            case 4:// Pablo lemus Navarro
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                        Texto like '%Pablo lemus Navarro%' OR
                        Texto like '%lemus Navarro%' OR
                        Texto like '%Pablo lemus%' OR

                        Titulo like '%Pablo lemus Navarro%' OR
                        Titulo like '%lemus Navarro%' OR
                        Titulo like '%Pablo lemus%' OR

                        Encabezado like '%Pablo lemus Navarro%' OR
                        Encabezado like '%lemus Navarro%' OR
                        Encabezado like '%Pablo lemus%' OR

                        PieFoto like '%Pablo lemus Navarro%' OR
                        PieFoto like '%lemus Navarro%' OR
                        PieFoto like '%Pablo lemus%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  //alfaro Rmairez      
        break;
    
            case 7://Guillermo Martinez Mora
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                        Texto like '%Guillermo Martinez Mora%' OR
                        Texto like '%Martinez Mora%' OR

                        Titulo like '%Guillermo Martinez Mora%' OR
                        Titulo like '%Martinez Mora%' OR

                        Encabezado like '%Guillermo Martinez Mora%' OR
                        Encabezado like '%Martinez Mora%' OR

                        PieFoto like '%Guillermo Martinez Mora%' OR
                        PieFoto like '%Martinez Mora%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;     
        break;
    
            case 10:// Zapopan
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                        Texto like '%zapopan%' OR

                        Titulo like '%zapopan%' OR

                        Encabezado like '%zapopan%' OR

                        PieFoto like '%zapopan%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query; 
            break;
            
            case 13:
                $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,
                    n.Autor,
                    n.Fecha,
                    n.Hora,
                    n.Titulo,
                    n.Encabezado,
                    n.Texto,
                    n.PaginaPeriodico,
                    n.Foto,
                    n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneraljalisco o, seccionesPeriodicos s, categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND 
                    p.idPeriodico=o.periodico AND 
                    s.idSeccion=n.Seccion AND 
                    c.idCategoria=n.Categoria AND 
                    c.idCategoria in(3) AND 
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion
                    ";
                return $query;
            break;//Primeras Planas Jalisco
            case 14:
                $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM 
                    $Tabla n, 
                    periodicos p, 
                    ordenGeneraljalisco o,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    n.Periodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(1) AND
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.id
                    ";
                return $query;
            break;//Columnas
            
            case 16:
                $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,
                    n.Autor,
                    n.Fecha,
                    n.Hora,
                    n.Titulo,
                    n.Encabezado,
                    n.Texto,
                    n.PaginaPeriodico,
                    n.Foto,
                    n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o, seccionesPeriodicos s, categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND 
                    p.idPeriodico=o.periodico AND 
                    s.idSeccion=n.Seccion AND 
                    c.idCategoria=n.Categoria AND 
                    c.idCategoria in(3) AND 
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion
                    ";
                return $query;
            break;//Primeras Planas DF
        
            case 17:
                $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM 
                    $Tabla n, 
                    periodicos p, 
                    ordenGeneralColumnas o,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    n.Periodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(19) AND
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.id";
            return $query;
            break;//Políticas DF  
        
            case 18:
                $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM 
                    $Tabla n, 
                    periodicos p, 
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(20) AND
                    fecha =DATE('$fecha') AND 
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.idEditorial";
                return $query;
            break;    //Financieras DF
        }

}