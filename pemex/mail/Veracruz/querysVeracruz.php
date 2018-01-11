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
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
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
                    p.estado=e.idEstado AND n.Activo=1
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
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.idEditorial
                    ORDER BY o.posicion
                    ";
            return $query;  
            break;// Cartones DF

        case 5://Hector Yunes Landa - DF
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
                      Texto like '%Hector Yunes Landa%' OR
                      Texto like '%Hector Yunes%' OR

                      Titulo like '%Hector Yunes Landa%' OR
                      Titulo like '%Hector Yunes%' OR

                      Encabezado like '%Hector Yunes Landa%' OR
                      Encabezado like '%Hector Yunes%' OR

                      PieFoto like '%Hector Yunes Landa%' OR
                      PieFoto like '%Hector Yunes%' OR

                      Autor like '%Hector Yunes Landa%' OR
                      Autor like '%Hector Yunes%'
                  ) GROUP BY p.idPeriodico,n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      

        break;//Hector Yunes Landa - DF

        case 6://Hector Yunes Landa - Estados
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                      Texto like '%Hector Yunes Landa%' OR
                      Texto like '%Hector Yunes%' OR

                      Titulo like '%Hector Yunes Landa%' OR
                      Titulo like '%Hector Yunes%' OR

                      Encabezado like '%Hector Yunes Landa%' OR
                      Encabezado like '%Hector Yunes%' OR

                      PieFoto like '%Hector Yunes Landa%' OR
                      PieFoto like '%Hector Yunes%' OR

                      Autor like '%Hector Yunes Landa%' OR
                      Autor like '%Hector Yunes%'
                  ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//Hector Yunes Landa - Estados

        case 7://Miguel Angel Yunes Linares - DF
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
                      Texto like '%Miguel Angel Yunes Linares%' OR
                      Texto like '%Miguel Angel Yunes%' OR

                      Titulo like '%Miguel Angel Yunes Linares%' OR
                      Titulo like '%Miguel Angel Yunes%' OR

                      Encabezado like '%Miguel Angel Yunes Linares%' OR
                      Encabezado like '%Miguel Angel Yunes%' OR

                      PieFoto like '%Miguel Angel Yunes Linares%' OR
                      PieFoto like '%Miguel Angel Yunes%' OR

                      Autor like '%Miguel Angel Yunes Linares%' OR
                      Autor like '%Miguel Angel Yunes%'
                  ) GROUP BY p.idPeriodico,n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      

        break;//Miguel Angel Yunes Linares - DF

        case 8://Miguel Angel Yunes Linares - Estados
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                      Texto like '%Miguel Angel Yunes Linares%' OR
                      Texto like '%Miguel Angel Yunes%' OR

                      Titulo like '%Miguel Angel Yunes Linares%' OR
                      Titulo like '%Miguel Angel Yunes%' OR

                      Encabezado like '%Miguel Angel Yunes Linares%' OR
                      Encabezado like '%Miguel Angel Yunes%' OR

                      PieFoto like '%Miguel Angel Yunes Linares%' OR
                      PieFoto like '%Miguel Angel Yunes%' OR

                      Autor like '%Miguel Angel Yunes Linares%' OR
                      Autor like '%Miguel Angel Yunes%'
                  ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//Miguel Angel Yunes Linares - Estados

        case 9://Gobernador de Veracruz - DF
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
                      Texto like '%Javier Duarte de Ochoa%' OR
                      Texto like '%Javier Duarte%' OR
                      Texto like '%Gobernador de Veracruz%' OR

                      Titulo like '%Javier Duarte de Ochoa%' OR
                      Titulo like '%Javier Duarte%' OR
                      Titulo like '%Gobernador de Veracruz%' OR

                      Encabezado like '%Javier Duarte de Ochoa%' OR
                      Encabezado like '%Javier Duarte%' OR
                      Encabezado like '%Gobernador de Veracruz%' OR

                      PieFoto like '%Javier Duarte de Ochoa%' OR
                      PieFoto like '%Javier Duarte%' OR
                      PieFoto like '%Gobernador de Veracruz%' OR

                      Autor like '%Javier Duarte de Ochoa%' OR
                      Autor like '%Javier Duarte%' OR
                      Autor like '%Gobernador de Veracruz%' 
                  ) GROUP BY p.idPeriodico,n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      

        break;//Gobernador de Veracruz - DF

        case 10://Gobernador de Veracruz - Estados
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                      Texto like '%Javier Duarte de Ochoa%' OR
                      Texto like '%Javier Duarte%' OR
                      Texto like '%Gobernador de Veracruz%' OR

                      Titulo like '%Javier Duarte de Ochoa%' OR
                      Titulo like '%Javier Duarte%' OR
                      Titulo like '%Gobernador de Veracruz%' OR

                      Encabezado like '%Javier Duarte de Ochoa%' OR
                      Encabezado like '%Javier Duarte%' OR
                      Encabezado like '%Gobernador de Veracruz%' OR

                      PieFoto like '%Javier Duarte de Ochoa%' OR
                      PieFoto like '%Javier Duarte%' OR
                      PieFoto like '%Gobernador de Veracruz%' OR

                      Autor like '%Javier Duarte de Ochoa%' OR
                      Autor like '%Javier Duarte%' OR
                      Autor like '%Gobernador de Veracruz%' 
                  ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//Gobernador de Veracruz - Estados

        case 11://Veracruz - DF
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
                      Texto like '%Veracruz%' OR
                      Texto like '%desaparecidos en Tierra Blanca%' OR
                      Texto like '%secuestrados en Tierra Blanca%' OR
                      Texto like '%Tierra Blanca%' OR

                      Titulo like '%Veracruz%' OR
                      Titulo like '%desaparecidos en Tierra Blanca%' OR
                      Titulo like '%secuestrados en Tierra Blanca%' OR
                      Titulo like '%Tierra Blanca%' OR

                      Encabezado like '%Veracruz%' OR
                      Encabezado like '%desaparecidos en Tierra Blanca%' OR
                      Encabezado like '%secuestrados en Tierra Blanca%' OR
                      Encabezado like '%Tierra Blanca%' OR

                      PieFoto like '%Veracruz%' OR
                      PieFoto like '%desaparecidos en Tierra Blanca%' OR
                      PieFoto like '%secuestrados en Tierra Blanca%' OR
                      PieFoto like '%Tierra Blanca%' OR

                      Autor like '%Veracruz%' OR
                      Autor like '%desaparecidos en Tierra Blanca%' OR
                      Autor like '%secuestrados en Tierra Blanca%' OR
                      Autor like '%Tierra Blanca%'
                  ) GROUP BY p.idPeriodico,n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      

        break;//Veracruz - DF

        case 12://Veracruz - Estados
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
                      Texto like '%Veracruz%' OR
                      Texto like '%desaparecidos en Tierra Blanca%' OR
                      Texto like '%secuestrados en Tierra Blanca%' OR
                      Texto like '%Tierra Blanca%' OR

                      Titulo like '%Veracruz%' OR
                      Titulo like '%desaparecidos en Tierra Blanca%' OR
                      Titulo like '%secuestrados en Tierra Blanca%' OR
                      Titulo like '%Tierra Blanca%' OR

                      Encabezado like '%Veracruz%' OR
                      Encabezado like '%desaparecidos en Tierra Blanca%' OR
                      Encabezado like '%secuestrados en Tierra Blanca%' OR
                      Encabezado like '%Tierra Blanca%' OR

                      PieFoto like '%Veracruz%' OR
                      PieFoto like '%desaparecidos en Tierra Blanca%' OR
                      PieFoto like '%secuestrados en Tierra Blanca%' OR
                      PieFoto like '%Tierra Blanca%' OR

                      Autor like '%Veracruz%' OR
                      Autor like '%desaparecidos en Tierra Blanca%' OR
                      Autor like '%secuestrados en Tierra Blanca%' OR
                      Autor like '%Tierra Blanca%'
                  ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//Veracruz - Estados

        case 13://Partidos Politicos DF
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
                   p.estado=e.idEstado AND p.estado = 9
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
    Texto like '%Juan Eduardo Robles Castellanos%' OR
    Texto like '%Eduardo Robles Castellanos%' OR
    Texto like '% PVEM veracruz%' OR
    Titulo like '%Juan Eduardo Robles Castellanos%' OR
    Titulo like '%Eduardo Robles Castellanos%' OR
    Titulo like '% PVEM veracruz%' OR
    Encabezado like '%Juan Eduardo Robles Castellanos%' OR
    Encabezado like '%Eduardo Robles Castellanos%' OR
    Encabezado like '% PVEM veracruz%' OR
    PieFoto like '%Juan Eduardo Robles Castellanos%' OR
    PieFoto like '%Eduardo Robles Castellanos%' OR
    PieFoto like '% PVEM veracruz%' OR
    Autor like '%Juan Eduardo Robles Castellanos%' OR
    Autor like '%Eduardo Robles Castellanos%' OR
    Autor like '% PVEM veracruz%' OR

    Texto like '%Fidel Robles Guadarrama%' OR
    Texto like '%Robles Guadarrama%' OR
    Texto like '%Fidel Robles%' OR
    Texto like '% Partido del Trabajo veracruz%' OR
    Titulo like '%Fidel Robles Guadarrama%' OR
    Titulo like '%Robles Guadarrama%' OR
    Titulo like '%Fidel Robles%' OR
    Titulo like '% Partido del Trabajo veracruz%' OR
    Encabezado like '%Fidel Robles Guadarrama%' OR
    Encabezado like '%Robles Guadarrama%' OR
    Encabezado like '%Fidel Robles%' OR
    Encabezado like '% Partido del Trabajo veracruz%' OR
    PieFoto like '%Fidel Robles Guadarrama%' OR
    PieFoto like '%Robles Guadarrama%' OR
    PieFoto like '%Fidel Robles%' OR
    PieFoto like '% Partido del Trabajo veracruz%' OR
    Autor like '%Fidel Robles Guadarrama%' OR
    Autor like '%Robles Guadarrama%' OR
    Autor like '% Partido del Trabajo veracruz%' OR
    Autor like '%Fidel Robles%' OR

    Texto like '%Rogelio Franco Castan%' OR
    Texto like '%Rogelio Franco%' OR
    Texto like '%Franco Castan%' OR
    Texto like '% PRD veracruz%' OR
    Titulo like '%Rogelio Franco Castan%' OR
    Titulo like '%Rogelio Franco%' OR
    Titulo like '%Franco Castan%' OR
    Titulo like '% PRD veracruz%' OR
    Encabezado like '%Rogelio Franco Castan%' OR
    Encabezado like '%Rogelio Franco%' OR
    Encabezado like '%Franco Castan%' OR
    Encabezado like '% PRD veracruz%' OR
    PieFoto like '%Rogelio Franco Castan%' OR
    PieFoto like '%Rogelio Franco%' OR
    PieFoto like '%Franco Castan%' OR
    PieFoto like '% PRD veracruz%' OR
    Autor like '%Rogelio Franco Castan%' OR
    Autor like '%Rogelio Franco%' OR
    Autor like '% PRD veracruz%' OR
    Autor like '%Franco Castan%' OR

    Texto like '%Alberto Silva%' OR
    Texto like '%Alberto Silva Ramos%' OR
    Texto like '% PRI veracruz%' OR
    Titulo like '%Alberto Silva%' OR
    Titulo like '%Alberto Silva Ramos%' OR
    Titulo like '% PRI veracruz%' OR
    Encabezado like '%Alberto Silva%' OR
    Encabezado like '%Alberto Silva Ramos%' OR
    Encabezado like '% PRI veracruz%' OR
    PieFoto like '%Alberto Silva Ramos%' OR
    PieFoto like '%Alberto Silva%' OR
    PieFoto like '% PRI veracruz%' OR
    Autor like '%Alberto Silva%' OR
    Autor like '%Alberto Silva Ramos%' OR
    Autor like '% PRI veracruz%' OR

    Texto like '%Jose de Jesus Mancha Alarcon%' OR
    Texto like '%Jose de JesusMancha%' OR
    Texto like '%Mancha Alarcon%' OR
    Texto like '% PAN veracruz%' OR
    Titulo like '%Jose de Jesus Mancha Alarcon%' OR
    Titulo like '%Jose de JesusMancha%' OR
    Titulo like '%Mancha Alarcon%' OR
    Titulo like '% PAN veracruz%' OR
    Encabezado like '%Jose de Jesus Mancha Alarcon%' OR
    Encabezado like '%Jose de JesusMancha%' OR
    Encabezado like '%Mancha Alarcon%' OR
    Encabezado like '% PAN veracruz%' OR
    PieFoto like '%Jose de Jesus Mancha Alarcon%' OR
    PieFoto like '%Jose de JesusMancha%' OR
    PieFoto like '%Mancha Alarcon%' OR
    PieFoto like '% PAN veracruz%' OR
    Autor like '%Jose de Jesus Mancha Alarcon%' OR
    Autor like '%Jose de JesusMancha%' OR
    Autor like '% PAN veracruz%' OR
    Autor like '%Mancha Alarcon%' 
    ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//Partidos Politicos

        case 14:
          $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o ,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion = n.Seccion AND
                   c.idCategoria = n.Categoria AND n.Categoria != 80 AND
                   p.estado = e.idEstado AND p.estado = 30 AND 
                   p.Tipo = 1 AND
n.Activo = 1 AND
  fecha = CURDATE() AND 
 (
    Texto like '%Flavino Rios Alvarado%' OR
    Texto like '%Ríos Alvarado%' OR
    Texto like '%Secretario general de gobierno de veracruz%' OR
    Texto like '%Secretaria general de gobierno%' OR

    Titulo like '%Flavino Rios Alvarado%' OR
    Titulo like '%Ríos Alvarado%' OR
    Titulo like '%Secretario general de gobierno de veracruz%' OR
    Titulo like '%Secretaria general de gobierno%' OR

    Encabezado like '%Flavino Rios Alvarado%' OR
    Encabezado like '%Ríos Alvarado%' OR
    Encabezado like '%Secretario general de gobierno de veracruz%' OR
    Encabezado like '%Secretaria general de gobierno%' OR

    Autor like '%Flavino Rios Alvarado%' OR
    Autor like '%Ríos Alvarado%' OR
    Autor like '%Secretario general de gobierno de veracruz%' OR
    Autor like '%Secretaria general de gobierno%' OR

    PieFoto like '%Flavino Rios Alvarado%' OR
    PieFoto like '%Ríos Alvarado%' OR
    PieFoto like '%Secretario general de gobierno de veracruz%' OR
    PieFoto like '%Secretaria general de gobierno%' OR

    Texto like '%Arturo Bermudez Zurita%' OR
    Texto like '%Bermudez Zurita%' OR
    Texto like '%Secretario de seguridad publica de veracruz%' OR
    Texto like '%Secretaria de seguridad publica veracruz%' OR

    Titulo like '%Arturo Bermudez Zurita%' OR
    Titulo like '%Bermudez Zurita%' OR
    Titulo like '%Secretario de seguridad publica de veracruz%' OR
    Texto like '%Secretaria de seguridad publica veracruz%' OR

    Encabezado like '%Arturo Bermudez Zurita%' OR
    Encabezado like '%Bermudez Zurita%' OR
    Encabezado like '%Secretario de seguridad publica de veracruz%' OR
    Encabezado like '%Secretaria de seguridad publica veracruz%' OR

    Autor like '%Arturo Bermudez Zurita%' OR
    Autor like '%Bermudez Zurita%' OR
    Autor like '%Secretario de seguridad publica de veracruz%' OR
    Autor like '%Secretaria de seguridad publica veracruz%' OR

    PieFoto like '%Arturo Bermudez Zurita%' OR
    PieFoto like '%Bermudez Zurita%' OR
    PieFoto like '%Secretario de seguridad publica de veracruz%' OR
    PieFoto like '%Secretaria de seguridad publica veracruz%' OR 

    Texto like '%Antonio Gomez Pelegrin%' OR
    Texto like '%Gomez Pelegrin%' OR
    Texto like '%Secretario de Finanzas y planeacion de veracruz%' OR
    Texto like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    Titulo like '%Antonio Gomez Pelegrin%' OR
    Titulo like '%Gomez Pelegrin%' OR
    Titulo like '%Secretario de Finanzas y planeacion de veracruz%' OR
    Titulo like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    Encabezado like '%Antonio Gomez Pelegrin%' OR
    Encabezado like '%Gomez Pelegrin%' OR
    Encabezado like '%Secretario de Finanzas y planeacion de veracruz%' OR
    Encabezado like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    Autor like '%Antonio Gomez Pelegrin%' OR
    Autor like '%Gomez Pelegrin%' OR
    Autor like '%Secretario de Finanzas y planeacion de veracruz%' OR
    Autor like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    PieFoto like '%Antonio Gomez Pelegrin%' OR
    PieFoto like '%Gomez Pelegrin%' OR
    PieFoto like '%Secretario de Finanzas y planeacion de veracruz%' OR
    PieFoto like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    Texto like '%Xochitl Adela Osorio Martinez%' OR
    Texto like '%Xochitl Adela Osorio%' OR
    Texto like '%Xochitl Osorio Martinez%' OR
    Texto like '%Osorio Martinez%' OR
    Texto like '%Secretario de Educacion de veracruz%' OR
    Texto like '%Secretaria de Educacion veracruz%' OR

    Titulo like '%Antonio Gomez Pelegrin%' OR
    Titulo like '%Gomez Pelegrin%' OR
    Titulo like '%Secretario de Finanzas y planeacion de veracruz%' OR
    Titulo like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    Encabezado like '%Antonio Gomez Pelegrin%' OR
    Encabezado like '%Gomez Pelegrin%' OR
    Encabezado like '%Secretario de Finanzas y planeacion de veracruz%' OR
    Encabezado like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    Autor like '%Antonio Gomez Pelegrin%' OR
    Autor like '%Gomez Pelegrin%' OR
    Autor like '%Secretario de Finanzas y planeacion de veracruz%' OR
    Autor like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    PieFoto like '%Antonio Gomez Pelegrin%' OR
    PieFoto like '%Gomez Pelegrin%' OR
    PieFoto like '%Secretario de Finanzas y planeacion de veracruz%' OR
    PieFoto like '%Secretaria de Finanzas y planeacion  veracruz%' OR

    Texto like '%Gabriel Deantes Ramos%' OR
    Texto like '%Deantes Ramos%' OR
    Texto like '%Secretario del Trabajo de veracruz%' OR
    Texto like '%Secretaria de Trabajo veracruz%' OR

    Titulo like '%Gabriel Deantes Ramos%' OR
    Titulo like '%Deantes Ramos%' OR
    Titulo like '%Secretario del Trabajo de veracruz%' OR
    Titulo like '%Secretaria de Trabajo veracruz%' OR

    Encabezado like '%Gabriel Deantes Ramos%' OR
    Encabezado like '%Deantes Ramos%' OR
    Encabezado like '%Secretario del Trabajo de veracruz%' OR
    Encabezado like '%Secretaria de Trabajo veracruz%' OR

    Autor like '%Gabriel Deantes Ramos%' OR
    Autor like '%Deantes Ramos%' OR
    Autor like '%Secretario del Trabajo de veracruz%' OR
    Autor like '%Secretaria de Trabajo veracruz%' OR

    PieFoto like '%Gabriel Deantes Ramos%' OR
    PieFoto like '%Deantes Ramos%' OR
    PieFoto like '%Secretario del Trabajo de veracruz%' OR
    PieFoto like '%Secretaria de Trabajo veracruz%' OR

    Texto like '%Erik Porres Blesa%' OR
    Texto like '%Porres Blesa%' OR
    Texto like '%Secretario de desarrollo economico y portuario de veracruz%' OR
    Texto like '%Secretaria de desarrollo economico y portuario veracruz%' OR

    Titulo like '%Erik Porres Blesa%' OR
    Titulo like '%Porres Blesa%' OR
    Titulo like '%Secretario de desarrollo economico y portuario de veracruz%' OR
    Titulo like '%Secretaria de desarrollo economico y portuario veracruz%' OR

    Encabezado like '%Erik Porres Blesa%' OR
    Encabezado like '%Porres Blesa%' OR
    Encabezado like '%Secretario de desarrollo economico y portuario de veracruz%' OR
    Encabezado like '%Secretaria de desarrollo economico y portuario veracruz%' OR

    Autor like '%Erik Porres Blesa%' OR
    Autor like '%Porres Blesa%' OR
    Autor like '%Secretario de desarrollo economico y portuario de veracruz%' OR
    Autor like '%Secretaria de desarrollo economico y portuario veracruz%' OR

    PieFoto like '%Erik Porres Blesa%' OR
    PieFoto like '%Porres Blesa%' OR
    PieFoto like '%Secretario de desarrollo economico y portuario de veracruz%' OR
    PieFoto like '%Secretaria de desarrollo economico y portuario veracruz%' OR

    Texto like '%Tomas Ruiz González%' OR
    Texto like '%Ruiz González%' OR
    Texto like '%Secretario de Infraestructura y obra publica de veracruz%' OR
    Texto like '%Secretaria de Infraestructura y obra publica veracruz%' OR

    Titulo like '%Tomas Ruiz González%' OR
    Titulo like '%Ruiz González%' OR
    Titulo like '%Secretario de Infraestructura y obra publica de veracruz%' OR
    Titulo like '%Secretaria de Infraestructura y obra publica veracruz%' OR

    Encabezado like '%Tomas Ruiz González%' OR
    Encabezado like '%Ruiz González%' OR
    Encabezado like '%Secretario de Infraestructura y obra publica de veracruz%' OR
    Encabezado like '%Secretaria de Infraestructura y obra publica veracruz%' OR

    Autor like '%Tomas Ruiz González%' OR
    Autor like '%Ruiz González%' OR
    Autor like '%Secretario de Infraestructura y obra publica de veracruz%' OR
    Autor like '%Secretaria de Infraestructura y obra publica veracruz%' OR

    PieFoto like '%Tomas Ruiz González%' OR
    PieFoto like '%Ruiz González%' OR
    PieFoto like '%Secretario de Infraestructura y obra publica de veracruz%' OR
    PieFoto like '%Secretaria de Infraestructura y obra publica veracruz%' OR

    Texto like '%Victor Alvarado Martinez%' OR
    Texto like '%Alvarado Martinez%' OR
    Texto like '%Secretario de Medio Ambiente de veracruz%' OR
    Texto like '%Secretaria de Medio Ambiente veracruz%' OR

    Titulo like '%Victor Alvarado Martinez%' OR
    Titulo like '%Alvarado Martinez%' OR
    Titulo like '%Secretario de Medio Ambiente de veracruz%' OR
    Titulo like '%Secretaria de Medio Ambiente veracruz%' OR

    Encabezado like '%Victor Alvarado Martinez%' OR
    Encabezado like '%Alvarado Martinez%' OR
    Encabezado like '%Secretario de Medio Ambiente de veracruz%' OR
    Encabezado like '%Secretaria de Medio Ambiente veracruz%' OR

    Autor like '%Victor Alvarado Martinez%' OR
    Autor like '%Alvarado Martinez%' OR
    Autor like '%Secretario de Medio Ambiente de veracruz%' OR
    Autor like '%Secretaria de Medio Ambiente veracruz%' OR

    PieFoto like '%Victor Alvarado Martinez%' OR
    PieFoto like '%Alvarado Martinez%' OR
    PieFoto like '%Secretario de Medio Ambiente de veracruz%' OR
    PieFoto like '%Secretaria de Medio Ambiente veracruz%' OR

    Texto like '%Fernando Benitez Obeso%' OR
    Texto like '%Benítez Obeso%' OR
    Texto like '%Secretario de Salud de veracruz%' OR
    Texto like '%Secretaria de Salud veracruz%' OR

    Titulo like '%Fernando Benitez Obeso%' OR
    Titulo like '%Benítez Obeso%' OR
    Titulo like '%Secretario de Salud de veracruz%' OR
    Titulo like '%Secretaria de Salud veracruz%' OR

    Encabezado like '%Fernando Benitez Obeso%' OR
    Encabezado like '%Benítez Obeso%' OR
    Encabezado like '%Secretario de Salud de veracruz%' OR
    Encabezado like '%Secretaria de Salud veracruz%' OR

    Autor like '%Fernando Benitez Obeso%' OR
    Autor like '%Benítez Obeso%' OR
    Autor like '%Secretario de Salud de veracruz%' OR
    Autor like '%Secretaria de Salud veracruz%' OR

    PieFoto like '%Fernando Benitez Obeso%' OR
    PieFoto like '%Benítez Obeso%' OR
    PieFoto like '%Secretario de Salud de veracruz%' OR
    PieFoto like '%Secretaria de Salud veracruz%' OR

    Texto like '%Harry Grappa Guzman%' OR
    Texto like '%Grappa Guzmán%' OR
    Texto like '%Secretario de Secretaria de Turismo y Cultura de veracruz%' OR
    Texto like '%Secretaria de Secretaria de Turismo y Cultura veracruz%' OR

    Titulo like '%Harry Grappa Guzman%' OR
    Titulo like '%Grappa Guzmán%' OR
    Titulo like '%Secretario de Secretaria de Turismo y Cultura de veracruz%' OR
    Titulo like '%Secretaria de Secretaria de Turismo y Cultura veracruz%' OR

    Encabezado like '%Harry Grappa Guzman%' OR
    Encabezado like '%Grappa Guzmán%' OR
    Encabezado like '%Secretario de Secretaria de Turismo y Cultura de veracruz%' OR
    Encabezado like '%Secretaria de Secretaria de Turismo y Cultura veracruz%' OR

    Autor like '%Harry Grappa Guzman%' OR
    Autor like '%Grappa Guzmán%' OR
    Autor like '%Secretario de Secretaria de Turismo y Cultura de veracruz%' OR
    Autor like '%Secretaria de Secretaria de Turismo y Cultura veracruz%' OR

    PieFoto like '%Harry Grappa Guzman%' OR
    PieFoto like '%Grappa Guzmán%' OR
    PieFoto like '%Secretario de Secretaria de Turismo y Cultura de veracruz%' OR
    PieFoto like '%Secretaria de Secretaria de Turismo y Cultura veracruz%' OR

    Texto like '%Yolanda Gutierrez Carlin%' OR
    Texto like '%Gutierrez Carlin%' OR
    Texto like '%Secretario de proteccion civil de veracruz%' OR
    Texto like '%Secretaria de proteccion civil veracruz%' OR

    Titulo like '%Yolanda Gutierrez Carlin%' OR
    Titulo like '%Gutierrez Carlin%' OR
    Titulo like '%Secretario de proteccion civil de veracruz%' OR
    Titulo like '%Secretaria de proteccion civil veracruz%' OR

    Encabezado like '%Yolanda Gutierrez Carlin%' OR
    Encabezado like '%Gutierrez Carlin%' OR
    Encabezado like '%Secretario de proteccion civil de veracruz%' OR
    Encabezado like '%Secretaria de proteccion civil veracruz%' OR

    Autor like '%Yolanda Gutierrez Carlin%' OR
    Autor like '%Gutierrez Carlin%' OR
    Autor like '%Secretario de proteccion civil de veracruz%' OR
    Autor like '%Secretaria de proteccion civil veracruz%' OR

    PieFoto like '%Yolanda Gutierrez Carlin%' OR
    PieFoto like '%Gutierrez Carlin%' OR
    PieFoto like '%Secretario de proteccion civil de veracruz%' OR
    PieFoto like '%Secretaria de proteccion civil veracruz%' OR

    Texto like '%Luis Angel Bravo Contreras%' OR
    Texto like '%Luis Angel Bravo%' OR
    Texto like '%Luis Bravo Contreras%' OR
    Texto like '%Bravo Contreras%' OR
    Texto like '%Procuraduría General de Justicia de veracruz%' OR
    Texto like '%Procuraduría General de Justicia veracruz%' OR

    Titulo like '%Luis Angel Bravo Contreras%' OR
    Titulo like '%Luis Angel Bravo%' OR
    Titulo like '%Luis Bravo Contreras%' OR
    Titulo like '%Bravo Contreras%' OR
    Titulo like '%Procuraduría General de Justicia de veracruz%' OR
    Titulo like '%Procuraduría General de Justicia veracruz%' OR

    Encabezado like '%Luis Angel Bravo Contreras%' OR
    Encabezado like '%Luis Angel Bravo%' OR
    Encabezado like '%Luis Bravo Contreras%' OR
    Encabezado like '%Bravo Contreras%' OR
    Encabezado like '%Procuraduría General de Justicia de veracruz%' OR
    Encabezado like '%Procuraduría General de Justicia veracruz%' OR

    Autor like '%Luis Angel Bravo Contreras%' OR
    Autor like '%Luis Angel Bravo%' OR
    Autor like '%Luis Bravo Contreras%' OR
    Autor like '%Bravo Contreras%' OR
    Autor like '%Procuraduría General de Justicia de veracruz%' OR
    Autor like '%Procuraduría General de Justicia veracruz%' OR

    PieFoto like '%Luis Angel Bravo Contreras%' OR
    PieFoto like '%Luis Angel Bravo%' OR
    PieFoto like '%Luis Bravo Contreras%' OR
    PieFoto like '%Bravo Contreras%' OR
    PieFoto like '%Procuraduría General de Justicia de veracruz%' OR
    PieFoto like '%Procuraduría General de Justicia veracruz%' OR

    Texto like '%Alfredo Ferrari Saavedra%' OR
    Texto like '%Ferrari Saavedra%' OR
    Texto like '%Secretario de Desarrollo Social de veracruz%' OR
    Texto like '%Secretaria de Desarrollo Social veracruz%' OR

    Titulo like '%Alfredo Ferrari Saavedra%' OR
    Titulo like '%Ferrari Saavedra%' OR
    Titulo like '%Secretario de Desarrollo Social de veracruz%' OR
    Titulo like '%Secretaria de Desarrollo Social veracruz%' OR

    Encabezado like '%Alfredo Ferrari Saavedra%' OR
    Encabezado like '%Ferrari Saavedra%' OR
    Encabezado like '%Secretario de Desarrollo Social de veracruz%' OR
    Encabezado like '%Secretaria de Desarrollo Social veracruz%' OR

    Autor like '%Alfredo Ferrari Saavedra%' OR
    Autor like '%Ferrari Saavedra%' OR
    Autor like '%Secretario de Desarrollo Social de veracruz%' OR
    Autor like '%Secretaria de Desarrollo Social veracruz%' OR

    PieFoto like '%Alfredo Ferrari Saavedra%' OR
    PieFoto like '%Ferrari Saavedra%' OR
    PieFoto like '%Secretario de Desarrollo Social de veracruz%' OR
    PieFoto like '%Secretaria de Desarrollo Social veracruz%' )";
          return $query;
          break;

        case 15://Partidos Politicos Estados
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
    Texto like '%Juan Eduardo Robles Castellanos%' OR
    Texto like '%Eduardo Robles Castellanos%' OR
    Texto like '% PVEM veracruz%' OR
    Titulo like '%Juan Eduardo Robles Castellanos%' OR
    Titulo like '%Eduardo Robles Castellanos%' OR
    Titulo like '% PVEM veracruz%' OR
    Encabezado like '%Juan Eduardo Robles Castellanos%' OR
    Encabezado like '%Eduardo Robles Castellanos%' OR
    Encabezado like '% PVEM veracruz%' OR
    PieFoto like '%Juan Eduardo Robles Castellanos%' OR
    PieFoto like '%Eduardo Robles Castellanos%' OR
    PieFoto like '% PVEM veracruz%' OR
    Autor like '%Juan Eduardo Robles Castellanos%' OR
    Autor like '%Eduardo Robles Castellanos%' OR
    Autor like '% PVEM veracruz%' OR

    Texto like '%Fidel Robles Guadarrama%' OR
    Texto like '%Robles Guadarrama%' OR
    Texto like '%Fidel Robles%' OR
    Texto like '% Partido del Trabajo veracruz%' OR
    Titulo like '%Fidel Robles Guadarrama%' OR
    Titulo like '%Robles Guadarrama%' OR
    Titulo like '%Fidel Robles%' OR
    Titulo like '% Partido del Trabajo veracruz%' OR
    Encabezado like '%Fidel Robles Guadarrama%' OR
    Encabezado like '%Robles Guadarrama%' OR
    Encabezado like '%Fidel Robles%' OR
    Encabezado like '% Partido del Trabajo veracruz%' OR
    PieFoto like '%Fidel Robles Guadarrama%' OR
    PieFoto like '%Robles Guadarrama%' OR
    PieFoto like '%Fidel Robles%' OR
    PieFoto like '% Partido del Trabajo veracruz%' OR
    Autor like '%Fidel Robles Guadarrama%' OR
    Autor like '%Robles Guadarrama%' OR
    Autor like '% Partido del Trabajo veracruz%' OR
    Autor like '%Fidel Robles%' OR

    Texto like '%Rogelio Franco Castan%' OR
    Texto like '%Rogelio Franco%' OR
    Texto like '%Franco Castan%' OR
    Texto like '% PRD veracruz%' OR
    Titulo like '%Rogelio Franco Castan%' OR
    Titulo like '%Rogelio Franco%' OR
    Titulo like '%Franco Castan%' OR
    Titulo like '% PRD veracruz%' OR
    Encabezado like '%Rogelio Franco Castan%' OR
    Encabezado like '%Rogelio Franco%' OR
    Encabezado like '%Franco Castan%' OR
    Encabezado like '% PRD veracruz%' OR
    PieFoto like '%Rogelio Franco Castan%' OR
    PieFoto like '%Rogelio Franco%' OR
    PieFoto like '%Franco Castan%' OR
    PieFoto like '% PRD veracruz%' OR
    Autor like '%Rogelio Franco Castan%' OR
    Autor like '%Rogelio Franco%' OR
    Autor like '% PRD veracruz%' OR
    Autor like '%Franco Castan%' OR

    Texto like '%Alberto Silva%' OR
    Texto like '%Alberto Silva Ramos%' OR
    Texto like '% PRI veracruz%' OR
    Titulo like '%Alberto Silva%' OR
    Titulo like '%Alberto Silva Ramos%' OR
    Titulo like '% PRI veracruz%' OR
    Encabezado like '%Alberto Silva%' OR
    Encabezado like '%Alberto Silva Ramos%' OR
    Encabezado like '% PRI veracruz%' OR
    PieFoto like '%Alberto Silva Ramos%' OR
    PieFoto like '%Alberto Silva%' OR
    PieFoto like '% PRI veracruz%' OR
    Autor like '%Alberto Silva%' OR
    Autor like '%Alberto Silva Ramos%' OR
    Autor like '% PRI veracruz%' OR

    Texto like '%Jose de Jesus Mancha Alarcon%' OR
    Texto like '%Jose de JesusMancha%' OR
    Texto like '%Mancha Alarcon%' OR
    Texto like '% PAN veracruz%' OR
    Titulo like '%Jose de Jesus Mancha Alarcon%' OR
    Titulo like '%Jose de JesusMancha%' OR
    Titulo like '%Mancha Alarcon%' OR
    Titulo like '% PAN veracruz%' OR
    Encabezado like '%Jose de Jesus Mancha Alarcon%' OR
    Encabezado like '%Jose de JesusMancha%' OR
    Encabezado like '%Mancha Alarcon%' OR
    Encabezado like '% PAN veracruz%' OR
    PieFoto like '%Jose de Jesus Mancha Alarcon%' OR
    PieFoto like '%Jose de JesusMancha%' OR
    PieFoto like '%Mancha Alarcon%' OR
    PieFoto like '% PAN veracruz%' OR
    Autor like '%Jose de Jesus Mancha Alarcon%' OR
    Autor like '%Jose de JesusMancha%' OR
    Autor like '% PAN veracruz%' OR
    Autor like '%Mancha Alarcon%' 
    ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//Partidos Politicos

        default:
            break;
    }
}
?>
