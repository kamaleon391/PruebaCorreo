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
            $Tabla="(
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasSemana WHERE Fecha = '".$fecha."' 
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasMensual WHERE Fecha = '".$fecha."'  
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasAnual WHERE Fecha = '".$fecha."'  
                )";
        }
        switch ($op){
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
                    FROM $Tabla n, periodicos p, 
                        ordenGeneraljalisco o,
                        seccionesPeriodicos s,
                        categoriasPeriodicos c,
                        estados e
                        WHERE 
                        p.idPeriodico=n.Periodico AND
                        p.idPeriodico=o.periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                        c.idCategoria in(3) AND
                        e.idEstado=p.Estado AND
                        Fecha=DATE('$fecha') AND
                        n.Activo=1
                        GROUP BY n.NumeroPagina,p.idPeriodico
                        ORDER BY o.posicion";
            return $query;
            break;//Primeras Planas

        case 2:// COLUMNAS 
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
            e.idEstado=p.Estado AND
            n.Fecha=DATE('$fecha') AND
            n.Activo=1
            GROUP BY n.idEditorial
            ORDER BY o.id";
            return $query;
            break;//Columnas

            case 3://Cartones
            $query = "SELECT
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
                c.idCategoria in(18) AND
                e.idEstado=p.Estado AND
                n.Activo=1
                GROUP BY n.idEditorial
                ORDER BY o.id";
                return $query;
            break;

            case 4://Leonel Sandoval Figueroa
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
                FROM $Tabla n, periodicos p, ordenGeneraljalisco o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                WHERE p.idPeriodico=n.Periodico AND
                p.idPeriodico=o.periodico AND
                s.idSeccion=n.Seccion AND
                c.idCategoria=n.Categoria AND
                p.estado=e.idEstado AND
                n.Activo=1 AND
                fecha =DATE('$fecha') AND
                (
                    Texto like '%Leonel Sandoval Figueroa%' OR
                    Texto like '%Papa Leonel%' OR
                    Texto like '%Magistrado Leonel%' OR
                    Texto like '%Leonel Sandoval%' OR

                    Titulo like '%Leonel Sandoval Figueroa%' OR
                    Titulo like '%Papa Leonel%' OR
                    Titulo like '%Magistrado Leonel%' OR
                    Titulo like '%Leonel Sandoval%' OR

                    Encabezado like '%Leonel Sandoval Figueroa%' OR
                    Encabezado like '%Papa Leonel%' OR
                    Encabezado like '%Magistrado Leonel%' OR
                    Encabezado like '%Leonel Sandoval%' OR

                    Autor like '%Leonel Sandoval Figueroa%' OR
                    Autor like '%Papa Leonel%' OR
                    Autor like '%Magistrado Leonel%' OR
                    Autor like '%Leonel Sandoval%' OR

                    PieFoto like '%Leonel Sandoval Figueroa%' OR
                    PieFoto like '%Papa Leonel%' OR
                    PieFoto like '%Magistrado Leonel%' OR
                    PieFoto like '%Leonel Sandoval%'
                )
                GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico 
                ORDER BY o.posicion";
        return $query;  
        break; //STPS 

    }
}
?>