<?php

function numberNotes($optionCase, $fecha, $estado)
{
    $query = query($optionCase, $fecha, $estado);
    $resultado = mysql_query($query);
    if(mysql_num_rows($resultado) > 0)
    {
        return true;
    }
    return false;
}

function query($op,$Tabla, $estado){
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
                    FROM $Tabla n, periodicos p, ordenGeneral o, seccionesPeriodicos s, categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND 
                    p.idPeriodico=o.periodico AND 
                    s.idSeccion=n.Seccion AND 
                    c.idCategoria=n.Categoria AND 
                    c.idCategoria in(3) AND 
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY p.idPeriodico, n.NumeroPagina 
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
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico 
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
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico ";
            return $query;
            break;//Columnas Financieras
        case 4: // CARTONES
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
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion
                    ";
            return $query;  
            break;// 
        case 5: /*********** DIRECCION GENERAL - DF ************/
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
                   fecha =DATE('$fecha') AND (
        Texto like '%Jose Reyes Baeza Terrazas%' OR
        Texto like '%Jose Reyes Baeza%' OR
        Texto like '%Jose Baeza Terrazas%' OR
        Texto like '%Baeza Terrazas%' OR
        Texto like '%Director del ISSSTE%' OR
        Texto like '%Director General del ISSSTE%' OR

        Titulo like '%Jose Reyes Baeza Terrazas%' OR
        Titulo like '%Jose Reyes Baeza%' OR
        Titulo like '%Jose Baeza Terrazas%' OR
        Titulo like '%Baeza Terrazas%' OR
        Titulo like '%Director del ISSSTE%' OR
        Titulo like '%Director General del ISSSTE%' OR

        Encabezado like '%Jose Reyes Baeza Terrazas%' OR
        Encabezado like '%Jose Reyes Baeza%' OR
        Encabezado like '%Jose Baeza Terrazas%' OR
        Encabezado like '%Baeza Terrazas%' OR
        Encabezado like '%Director del ISSSTE%' OR
        Encabezado like '%Director General del ISSSTE%' OR

        Autor like '%Jose Reyes Baeza Terrazas%' OR
        Autor like '%Jose Reyes Baeza%' OR
        Autor like '%Jose Baeza Terrazas%' OR
        Autor like '%Baeza Terrazas%' OR
        Autor like '%Director del ISSSTE%' OR
        Autor like '%Director General del ISSSTE%' OR

        PieFoto like '%Jose Reyes Baeza Terrazas%' OR
        PieFoto like '%Jose Reyes Baeza%' OR
        PieFoto like '%Jose Baeza Terrazas%' OR
        PieFoto like '%Baeza Terrazas%' OR
        PieFoto like '%Director del ISSSTE%' OR
        PieFoto like '%Director General del ISSSTE%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 6: /*********** DIRECTOR ISSSTE - ESTADOS ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9  AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%Jose Reyes Baeza Terrazas%' OR
        Texto like '%Jose Reyes Baeza%' OR
        Texto like '%Jose Baeza Terrazas%' OR
        Texto like '%Baeza Terrazas%' OR
        Texto like '%Director del ISSSTE%' OR
        Texto like '%Director General del ISSSTE%' OR

        Titulo like '%Jose Reyes Baeza Terrazas%' OR
        Titulo like '%Jose Reyes Baeza%' OR
        Titulo like '%Jose Baeza Terrazas%' OR
        Titulo like '%Baeza Terrazas%' OR
        Titulo like '%Director del ISSSTE%' OR
        Titulo like '%Director General del ISSSTE%' OR

        Encabezado like '%Jose Reyes Baeza Terrazas%' OR
        Encabezado like '%Jose Reyes Baeza%' OR
        Encabezado like '%Jose Baeza Terrazas%' OR
        Encabezado like '%Baeza Terrazas%' OR
        Encabezado like '%Director del ISSSTE%' OR
        Encabezado like '%Director General del ISSSTE%' OR

        Autor like '%Jose Reyes Baeza Terrazas%' OR
        Autor like '%Jose Reyes Baeza%' OR
        Autor like '%Jose Baeza Terrazas%' OR
        Autor like '%Baeza Terrazas%' OR
        Autor like '%Director del ISSSTE%' OR
        Autor like '%Director General del ISSSTE%' OR

        PieFoto like '%Jose Reyes Baeza Terrazas%' OR
        PieFoto like '%Jose Reyes Baeza%' OR
        PieFoto like '%Jose Baeza Terrazas%' OR
        PieFoto like '%Baeza Terrazas%' OR
        PieFoto like '%Director del ISSSTE%' OR
        PieFoto like '%Director General del ISSSTE%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /***********  EOF DIRECTOR ISSSTE ESTADOS     ************/
        
        case 7: /***********  ADMINISTRACION ISSTE DF  ************/
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
                   fecha =DATE('$fecha') AND (
        Texto like '%administracion issste%' OR
        Texto like '%compra de medicamentos issste%' OR
        Texto like '%administrador del issste%' OR
        Texto like '%tiendas issste%' OR

        Titulo like '%administracion issste%' OR
        Titulo like '%compra de medicamentos issste%' OR
        Titulo like '%administrador del issste%' OR
        Titulo like '%tiendas issste%' OR

        Encabezado like '%administracion issste%' OR
        Encabezado like '%compra de medicamentos issste%' OR
        Encabezado like '%administrador del issste%' OR
        Encabezado like '%tiendas issste%' OR

        PieFoto like '%administracion issste%' OR
        PieFoto like '%compra de medicamentos issste%' OR
        PieFoto like '%administrador del issste%' OR
        PieFoto like '%tiendas issste%' OR

        Autor like '%administracion issste%' OR
        Autor like '%compra de medicamentos issste%' OR
        Autor like '%administrador del issste%' OR
        Autor like '%tiendas issste%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 8: /***********  ADMINISTRACION ISSTE ESTADOS     ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9  AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%administracion issste%' OR
        Texto like '%compra de medicamentos issste%' OR
        Texto like '%administrador del issste%' OR
        Texto like '%tiendas issste%' OR

        Titulo like '%administracion issste%' OR
        Titulo like '%compra de medicamentos issste%' OR
        Titulo like '%administrador del issste%' OR
        Titulo like '%tiendas issste%' OR

        Encabezado like '%administracion issste%' OR
        Encabezado like '%compra de medicamentos issste%' OR
        Encabezado like '%administrador del issste%' OR
        Encabezado like '%tiendas issste%' OR

        PieFoto like '%administracion issste%' OR
        PieFoto like '%compra de medicamentos issste%' OR
        PieFoto like '%administrador del issste%' OR
        PieFoto like '%tiendas issste%' OR

        Autor like '%administracion issste%' OR
        Autor like '%compra de medicamentos issste%' OR
        Autor like '%administrador del issste%' OR
        Autor like '%tiendas issste%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** EOF ADMINISTRACION ISSTE ESTADOS ************/

        case 9: /*********** CLINICAS Y HOSPITALES - DF ************/
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
                   fecha =DATE('$fecha') AND (
        Texto like '%clinica del issste%' OR
        Texto like '%clinicas del issste%' OR
        Texto like '%hospital del issste%' OR
        Texto like '%hospitales del issste%' OR

        Titulo like '%clinica del issste%' OR
        Titulo like '%clinicas del issste%' OR
        Titulo like '%hospital del issste%' OR
        Titulo like '%hospitales del issste%' OR

        Encabezado like '%clinica del issste%' OR
        Encabezado like '%clinicas del issste%' OR
        Encabezado like '%hospital del issste%' OR
        Encabezado like '%hospitales del issste%' OR

        Autor like '%clinica del issste%' OR
        Autor like '%clinicas del issste%' OR
        Autor like '%hospital del issste%' OR
        Autor like '%hospitales del issste%' OR

        PieFoto like '%clinica del issste%' OR
        PieFoto like '%clinicas del issste%' OR
        PieFoto like '%hospital del issste%' OR
        PieFoto like '%hospitales del issste%'

    )  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 10: /*********** CLINICAS Y HOSPITALES ESTADOS     ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9 AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%clinica del issste%' OR
        Texto like '%clinicas del issste%' OR
        Texto like '%hospital del issste%' OR
        Texto like '%hospitales del issste%' OR

        Titulo like '%clinica del issste%' OR
        Titulo like '%clinicas del issste%' OR
        Titulo like '%hospital del issste%' OR
        Titulo like '%hospitales del issste%' OR

        Encabezado like '%clinica del issste%' OR
        Encabezado like '%clinicas del issste%' OR
        Encabezado like '%hospital del issste%' OR
        Encabezado like '%hospitales del issste%' OR

        Autor like '%clinica del issste%' OR
        Autor like '%clinicas del issste%' OR
        Autor like '%hospital del issste%' OR
        Autor like '%hospitales del issste%' OR

        PieFoto like '%clinica del issste%' OR
        PieFoto like '%clinicas del issste%' OR
        PieFoto like '%hospital del issste%' OR
        PieFoto like '%hospitales del issste%'

    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** CLINICAS Y HOSPITALES ESTADOS ************/

        case 11: /*********** PENSIONES JUBILACIONES - DF ************/
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
                   fecha =DATE('$fecha') AND (
        Texto like '%jubilado%' OR
        Texto like '%pensionado%' OR

        Titulo like '%jubilado%' OR
        Titulo like '%pensionado%' OR

        Encabezado like '%jubilado%' OR
        Encabezado like '%pensionado%' OR

        PieFoto like '%jubilado%' OR
        PieFoto like '%pensionado%' OR

        Autor like '%jubilado%' OR
        Autor like '%pensionado%'
    ) AND (
        Texto like '%issste%' OR
        Titulo like '%issste%' OR
        Encabezado like '%issste%' OR
        Autor like '%issste%' OR
        PieFoto like '%issste%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 12: /*********** PENSIONES Y JUBILACIONES- ESTADOS ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9 AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%jubilado%' OR
        Texto like '%pensionado%' OR

        Titulo like '%jubilado%' OR
        Titulo like '%pensionado%' OR

        Encabezado like '%jubilado%' OR
        Encabezado like '%pensionado%' OR

        PieFoto like '%jubilado%' OR
        PieFoto like '%pensionado%' OR

        Autor like '%jubilado%' OR
        Autor like '%pensionado%'
    ) AND (
        Texto like '%issste%' OR
        Titulo like '%issste%' OR
        Encabezado like '%issste%' OR
        Autor like '%issste%' OR
        PieFoto like '%issste%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** PENSIONES Y JUBILACIONES ESTADOS ************/

        case 13: /*********** GUARDERIA DF ************/
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
                   fecha =DATE('$fecha') AND (
        Texto like '%guarderia%' OR

        Titulo like '%guarderia%' OR

        Encabezado like '%guarderia%' OR

        PieFoto like '%guarderia%' OR

        Autor like '%guarderia%'
    ) AND (
        Texto like '%issste%' OR
        Titulo like '%issste%' OR
        Encabezado like '%issste%' OR
        Autor like '%issste%' OR
        PieFoto like '%issste%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 14: /*********** GUARDERIA ESTADOS ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9 AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%guarderia%' OR

        Titulo like '%guarderia%' OR

        Encabezado like '%guarderia%' OR

        PieFoto like '%guarderia%' OR

        Autor like '%guarderia%'
    ) AND (
        Texto like '%issste%' OR
        Titulo like '%issste%' OR
        Encabezado like '%issste%' OR
        Autor like '%issste%' OR
        PieFoto like '%issste%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** GUARDERIA ESTADOS ************/
        
        case 15: /*********** MEDICAMENTO DF ************/
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
                   fecha =DATE('$fecha') AND (
        Texto like '%medicamento%' OR

        Titulo like '%medicamento%' OR

        Encabezado like '%medicamento%' OR

        PieFoto like '%medicamento%' OR

        Autor like '%medicamento%'
    ) AND (
        Texto like '%issste%' OR
        Titulo like '%issste%' OR
        Encabezado like '%issste%' OR
        Autor like '%issste%' OR
        PieFoto like '%issste%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 16: /*********** MEDICAMENTO ESTADOS ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9  AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%medicamento%' OR

        Titulo like '%medicamento%' OR

        Encabezado like '%medicamento%' OR

        PieFoto like '%medicamento%' OR

        Autor like '%medicamento%'
    ) AND (
        Texto like '%issste%' OR
        Titulo like '%issste%' OR
        Encabezado like '%issste%' OR
        Autor like '%issste%' OR
        PieFoto like '%issste%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** MEDICAMENTO ESTADOS ************/

        case 17: /*********** FOVISSSTE DF ************/
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
                   fecha =DATE('$fecha') AND (
        Texto like '%fovissste%' OR
        Texto like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%' OR

        Titulo like '%fovissste%' OR
        Titulo like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%' OR

        Encabezado like '%fovissste%' OR
        Encabezado like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%' OR

        PieFoto like '%fovissste%' OR
        PieFoto like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%' OR

        Autor like '%fovissste%' OR
        Autor like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 18: /*********** FOVISSTE ESTADOS ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9 AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%fovissste%' OR
        Texto like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%' OR

        Titulo like '%fovissste%' OR
        Titulo like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%' OR

        Encabezado like '%fovissste%' OR
        Encabezado like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%' OR

        PieFoto like '%fovissste%' OR
        PieFoto like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%' OR

        Autor like '%fovissste%' OR
        Autor like '%fondo de la vivienda del instituto de seguridad y servicios sociales de los trabajadores del estado%'
    )
                    GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** FOVISSTE ESTADOS ************/


        case 19: /*********** FESTSE DF ************/
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
                   fecha =DATE('$fecha') AND (
        Texto like '%festse%' OR
        
        Titulo like '%festse%' OR

        Encabezado like '%festse%' OR

        PieFoto like '%festse%' OR

        Autor like '%festse%' 
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 20: /*********** FESTSE ESTADOS ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9 AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%festse%' OR
        
        Titulo like '%festse%' OR

        Encabezado like '%festse%' OR

        PieFoto like '%festse%' OR

        Autor like '%festse%' 
    )GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
   	
            return $query;
        break; /*********** EOF FESTSE ESTADOS ************/

        case 21: /*********** ISSSTE DF ************/
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
                   fecha =DATE('$fecha') AND  (
        Texto like '% ISSSTE %' OR
        Texto like '%instituto de seguridad y servicios sociales de los trabajadores del estado %' OR

        Titulo like '% ISSSTE %' OR
        Titulo like '%instituto de seguridad y servicios sociales de los trabajadores del estado %' OR

        Encabezado like '% ISSSTE %' OR
        Encabezado like '%instituto de seguridad y servicios sociales de los trabajadores del estado %' OR

        Autor like '% ISSSTE %' OR
        Autor like '%instituto de seguridad y servicios sociales de los trabajadores del estado %' OR

        PieFoto like '% ISSSTE %' OR
        PieFoto like '%instituto de seguridad y servicios sociales de los trabajadores del estado %'
    )   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 22: /*********** ISSSTE ESTADOS ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Categoria != 80 AND
                    p.Estado != 9 AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND  (
        Texto like '% ISSSTE %' OR
        Texto like '%instituto de seguridad y servicios sociales de los trabajadores del estado %' OR

        Titulo like '% ISSSTE %' OR
        Titulo like '%instituto de seguridad y servicios sociales de los trabajadores del estado %' OR

        Encabezado like '% ISSSTE %' OR
        Encabezado like '%instituto de seguridad y servicios sociales de los trabajadores del estado %' OR

        Autor like '% ISSSTE %' OR
        Autor like '%instituto de seguridad y servicios sociales de los trabajadores del estado %' OR

        PieFoto like '% ISSSTE %' OR
        PieFoto like '%instituto de seguridad y servicios sociales de los trabajadores del estado %'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** ISSSTE ESTADOS ************/

        default:
            break;
    }
}
?>
