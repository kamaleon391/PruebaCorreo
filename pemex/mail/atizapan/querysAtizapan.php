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
            case 1:// PRIMERAS PLANAS
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$Tabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=3 
                        AND s.idSeccion = n.Seccion AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY p.idPeriodico, n.NumeroPagina  ORDER BY o.posicion";
                return $query;
                break;
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
            GROUP BY n.Periodico,n.NumeroPagina   
            ORDER BY o.id";
                return $query;
                break;
            case 3:// COLUMNAS FINANCIERAS
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$Tabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=20 
                        AND s.idSeccion = n.Seccion 
                        AND p.Estado=9 AND n.Fecha='".$fecha."' 
                        GROUP BY p.idPeriodico, n.NumeroPagina
                        ORDER BY o.posicion";
                return $query;
                break;
            case 4:// CARTONES
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$Tabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=18 
                        AND s.idSeccion = n.Seccion 
                        AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY p.idPeriodico, n.NumeroPagina 
                        ORDER BY o.posicion";
                return $query;
                break;

        case 5://REFORMA POLITICA DF
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%Reforma del DF%' OR
                        Texto like '%Reforma politica de la ciudad de mexico%' OR
                        Texto like '%Reforma Politica del DF%' OR
                        Texto like '%Reforma CDMX%' OR
                        Texto like '%Ciudad de Mexico%' OR
                        Texto like '%Distrito Federal%' OR

                        Titulo like '%Reforma del DF%' OR
                        Titulo like '%Reforma politica de la ciudad de mexico%' OR
                        Titulo like '%Reforma Politica del DF%' OR
                        Titulo like '%Reforma CDMX%' OR
                        Titulo like '%Ciudad de Mexico%' OR
                        Titulo like '%Distrito Federal%' OR

                        Encabezado like '%Reforma del DF%' OR
                        Encabezado like '%Reforma politica de la ciudad de mexico%' OR
                        Encabezado like '%Reforma Politica del DF%' OR
                        Encabezado like '%Reforma CDMX%' OR
                        Encabezado like '%Ciudad de Mexico%' OR
                        Encabezado like '%Distrito Federal%' OR

                        Autor like '%Reforma del DF%' OR
                        Autor like '%Reforma politica de la ciudad de mexico%' OR
                        Autor like '%Reforma Politica del DF%' OR
                        Autor like '%Reforma CDMX%' OR
                        Autor like '%Ciudad de Mexico%' OR
                        Autor like '%Distrito Federal%' OR

                        PieFoto like '%Reforma del DF%' OR
                        PieFoto like '%Reforma politica de la ciudad de mexico%' OR
                        PieFoto like '%Reforma Politica del DF%' OR
                        PieFoto like '%Reforma CDMX%' OR
                        PieFoto like '%Ciudad de Mexico%' 
                    ) GROUP BY p.idPeriodico,n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//Reforma

        case 6://ERUVIEL AVILA DF
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%Eruviel avila%' OR
                        Texto like '%Gobernador del estado de mexico%' OR
                        Titulo like '%Eruviel avila%' OR
                        Titulo like '%Gobernador del estado de mexico%' OR
                        Encabezado like '%Eruviel avila%' OR
                        Encabezado like '%Gobernador del estado de mexico%' OR
                        Autor like '%Eruviel avila%' OR
                        Autor like '%Gobernador del estado de mexico%' OR
                        PieFoto like '%Eruviel avila%' OR
                        PieFoto like '%Gobernador del estado de mexico%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ORDER BY o.posicion";
            return $query;      

        break;//ERUVIEL AVILA DF

        case 7://ERUVIEL AVILA - EDOMEX
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado = 15 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%Eruviel avila%' OR
                        Texto like '%Gobernador del estado de mexico%' OR
                        Titulo like '%Eruviel avila%' OR
                        Titulo like '%Gobernador del estado de mexico%' OR
                        Encabezado like '%Eruviel avila%' OR
                        Encabezado like '%Gobernador del estado de mexico%' OR
                        Autor like '%Eruviel avila%' OR
                        Autor like '%Gobernador del estado de mexico%' OR
                        PieFoto like '%Eruviel avila%' OR
                        PieFoto like '%Gobernador del estado de mexico%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina";
            return $query;      
        break;//ERUVIEL AVILA EDOMEX


        case 8://ATIZAPAN - DF
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado IN ( 9 ) AND 
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%ATIZAPAN%' OR
                        Titulo like '%ATIZAPAN%' OR
                        Encabezado like '%ATIZAPAN%' OR
                        Autor like '%ATIZAPAN%' OR
                        PieFoto like '%ATIZAPAN%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ORDER BY o.posicion";
            return $query;      
            break;// ATIZAPAN

        case 9://ATIZAPAN - EDOMEX
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado IN ( 15 ) AND 
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%ATIZAPAN%' OR
                        Titulo like '%ATIZAPAN%' OR
                        Encabezado like '%ATIZAPAN%' OR
                        Autor like '%ATIZAPAN%' OR
                        PieFoto like '%ATIZAPAN%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ";
            return $query;      
        break;// ATIZAPAN

        case 10://TLALNEPANTLA - DF
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado IN ( 9 ) AND 
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%TLALNEPANTLA%' OR
                        Titulo like '%TLALNEPANTLA%' OR
                        Encabezado like '%TLALNEPANTLA%' OR
                        Autor like '%TLALNEPANTLA%' OR
                        PieFoto like '%TLALNEPANTLA%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ORDER BY o.posicion";
            return $query;      
            break;// TLALNEPANTLA

        case 11://TLALNEPANTLA - EDOMEX
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado IN ( 15 ) AND 
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%TLALNEPANTLA%' OR
                        Titulo like '%TLALNEPANTLA%' OR
                        Encabezado like '%TLALNEPANTLA%' OR
                        Autor like '%TLALNEPANTLA%' OR
                        PieFoto like '%TLALNEPANTLA%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ";
            return $query;      
        break;// TLALNEPANTLA

        case 12:// NAUCALPAN - DF
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado IN ( 9 ) AND 
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%NAUCALPAN%' OR
                        Titulo like '%NAUCALPAN%' OR
                        Encabezado like '%NAUCALPAN%' OR
                        Autor like '%NAUCALPAN%' OR
                        PieFoto like '%NAUCALPAN%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ORDER BY o.posicion";
            return $query;      
            break;// NAUCALPAN

        case 13:// NAUCALPAN - EDOMEX
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado IN ( 15 ) AND 
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%NAUCALPAN%' OR
                        Titulo like '%NAUCALPAN%' OR
                        Encabezado like '%NAUCALPAN%' OR
                        Autor like '%NAUCALPAN%' OR
                        PieFoto like '%NAUCALPAN%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ";
            return $query;      
        break;// NAUCALPAN 

        case 14:// Cuautitlan Izcalli - DF
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado IN ( 9 ) AND 
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%Cuautitlan Izcalli%' OR
                        Titulo like '%Cuautitlan Izcalli%' OR
                        Encabezado like '%Cuautitlan Izcalli%' OR
                        Autor like '%Cuautitlan Izcalli%' OR
                        PieFoto like '%Cuautitlan Izcalli%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ORDER BY o.posicion";
            return $query;      
            break;// 

        case 15:// Cuautitlan Izcalli - EDOMEX
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado IN ( 15 ) AND 
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%Cuautitlan Izcalli%' OR
                        Titulo like '%Cuautitlan Izcalli%' OR
                        Encabezado like '%Cuautitlan Izcalli%' OR
                        Autor like '%Cuautitlan Izcalli%' OR
                        PieFoto like '%Cuautitlan Izcalli%' 
                    ) GROUP BY p.idPeriodico,n.NumeroPagina ";
            return $query;      
        break;// Cuautitlan Izcalli

        default:
            break;
    }
}
?>
