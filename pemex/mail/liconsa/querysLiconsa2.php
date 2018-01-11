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
            $Tabla="(

                  SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasSemana WHERE Fecha = '".$fecha."' 
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasMensual WHERE Fecha = '".$fecha."'
                 UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasAnual WHERE Fecha = '".$fecha."' 
                )";
        }
    switch ($op) {
        case 1:// PRIMERAS PLANAS
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
                    p.estado=e.idEstado
                    GROUP BY n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion
                    ";
            return $query;
            break;//Primeras Planas
        case 2:// COLUMNAS POLITICAS
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
                    ordenGeneral o,
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
                    fecha =DATE('$fecha')
                    GROUP BY n.idEditorial
                    ORDER BY o.id";
            return $query;
            break;//Columnas Politicas
        case 3:// COLUMNAS FINANCIERAS
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
                    p.estado=e.idEstado
                    GROUP BY n.idEditorial";
            return $query;
            break;//Columnas Financieras
        case 4:
            $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM 
                    $Tabla n, 
                    periodicos p, 
                    ordenGeneral o,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(18) AND
                    p.estado=9 AND 
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha')
                    GROUP BY n.idEditorial
                    ORDER BY o.posicion
                    ";
            return $query;  
            break;// Cartones DF
        case 5://hector pablo ramirez puga leyva
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND (
                    Texto like '%hector pablo ramirez puga leyva%' OR
                    Texto like '%hector pablo ramirez puga%' OR
                    Texto like '%hector ramirez puga leyva%' OR
                    Texto like '%hector ramirez puga%' OR
                    Texto like '%ramirez puga leyva%' OR
                    Texto like '%ramirez puga%' OR
                    Texto like '%director de liconsa%' OR

                    Titulo like '%hector pablo ramirez puga leyva%' OR
                    Titulo like '%hector pablo ramirez puga%' OR
                    Titulo like '%hector ramirez puga leyva%' OR
                    Titulo like '%hector ramirez puga%' OR
                    Titulo like '%ramirez puga leyva%' OR
                    Titulo like '%ramirez puga%' OR
                    Titulo like '%director de liconsa%' OR

                    Encabezado like '%hector pablo ramirez puga leyva%' OR
                    Encabezado like '%hector pablo ramirez puga%' OR
                    Encabezado like '%hector ramirez puga leyva%' OR
                    Encabezado like '%hector ramirez puga%' OR
                    Encabezado like '%ramirez puga leyva%' OR
                    Encabezado like '%ramirez puga%' OR
                    Encabezado like '%director de liconsa%' OR

                            PieFoto like '%hector pablo ramirez puga leyva%' OR
                    PieFoto like '%hector pablo ramirez puga%' OR
                    PieFoto like '%hector ramirez puga leyva%' OR
                    PieFoto like '%hector ramirez puga%' OR
                    PieFoto like '%ramirez puga leyva%' OR
                    PieFoto like '%ramirez puga%' OR
                    PieFoto like '%director de liconsa%'
                    )
            GROUP BY n.NumeroPagina,p.idPeriodico 
            ORDER BY o.posicion";
            return $query;  
            break;//hector pablo ramirez puga leyva
        case 6:// GERENCIA
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND (
                                    Texto like '%gerencia de liconsa%' OR
                                    Texto like '%gerencia liconsa%' OR
                                    Texto like '%gerencia estatal liconsa%' OR
                                    Titulo like '%gerencia liconsa%' OR
                                    Titulo like '%gerencia estatal liconsa%' OR
                                    Encabezado like '%gerencia liconsa%' OR
                                    Encabezado like '%gerencia estatal liconsa%'
                                   )
            GROUP BY n.NumeroPagina,p.idPeriodico 
            ORDER BY o.posicion";
            return $query;  
            break; // Gerencia Liconsa 
        case 7://  LICONSA
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND (
                                    Texto like '%liconsa%' OR
                                    Titulo like '%liconsa%' OR
                                    Encabezado like '%liconsa%'
                                 )
            GROUP BY n.NumeroPagina,p.idPeriodico 
            ORDER BY o.posicion";
            return $query;  
            break; 
        case 8://  LECHE
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND (
                   Texto like '% leche %' OR
                   Titulo like '% leche %' OR
                   Encabezado like '% leche %'
                   )
            GROUP BY n.NumeroPagina,p.idPeriodico 
            ORDER BY o.posicion";
            return $query;  
            break;  
        case 9://  SEDESOL
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND (
                            Texto like '%sedesol%' OR
                            Texto like '%secretaria de desarrollo social%' OR
                            Texto like '%rosario robles%' OR
                            Titulo like '%sedesol%' OR
                            Titulo like '%rosario robles%' OR
                            Titulo like '%secretaria de desarrollo social%' OR
                            Encabezado like '%sedesol%' OR
                            Encabezado like '%rosario robles%' OR
                            Encabezado like '%secretaria de desarrollo social%'
                            )
            GROUP BY n.NumeroPagina,p.idPeriodico 
            ORDER BY o.posicion";
            return $query;  
            break;   
        case 10://  VARIOS
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND(
                    Texto like '%sedesol%' OR
                    Texto like '%diconsa%' OR
                    Texto like '%rosario robles%' OR
                    Texto like '%responsabilidad social%' OR
                    Texto like '%productos lacteos%' OR
                    Texto like '%desarrollo social%' OR

                    Titulo like '%sedesol%' OR
                    Titulo like '%diconsa%' OR
                    Titulo like '%rosario robles%' OR
                    Titulo like '%responsabilidad social%' OR
                    Titulo like '%productos lacteos%' OR
                    Titulo like '%desarrollo social%' OR

                    Encabezado like '%sedesol%' OR
                    Encabezado like '%diconsa%' OR
                    Encabezado like '%rosario robles%' OR
                    Encabezado like '%responsabilidad social%' OR
                    Encabezado like '%productos lacteos%' OR
                    Encabezado like '%desarrollo social%'
                    )
            GROUP BY n.NumeroPagina,p.idPeriodico 
            ORDER BY o.posicion";
            return $query;  
            break;        
        default:
            break;
    }
}
?>
