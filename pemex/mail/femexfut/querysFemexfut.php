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

        case 5: /*********** FEMEXFUT - DF ************/
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
    Texto like '%FEMEXFUT%' OR 
    Texto like '%Federacion Mexicana de Futbol%' OR
    Texto like '%Decio De Maria Serrano%' OR
    Texto like '%De Maria Serrano%' OR
    
    Titulo like '%FEMEXFUT%' OR
    Titulo like '%Federacion Mexicana de Futbol%' OR
    Titulo like '%Decio De Maria Serrano%' OR
    Titulo like '%De Maria Serrano%' OR

    Encabezado like '%FEMEXFUT%' OR
    Encabezado like '%Federacion Mexicana de Futbol%' OR
    Encabezado like '%Decio De Maria Serrano%' OR
    Encabezado like '%De Maria Serrano%' OR
      
    PieFoto like '%FEMEXFUT%' OR
    PieFoto like '%Federacion Mexicana de Futbol%' OR
    PieFoto like '%Decio De Maria Serrano%' OR
    PieFoto like '%De Maria Serrano%' OR
     
    Autor like '%FEMEXFUT%'  OR
    Autor like '%Federacion Mexicana de Futbol%' OR
    Autor like '%Decio De Maria Serrano%' OR
    Autor like '%De Maria Serrano%'
) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 6: /*********** FEMEXFUT - ESTADOS ************/
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
    Texto like '%FEMEXFUT%' OR 
    Texto like '%Federacion Mexicana de Futbol%' OR
    Texto like '%Decio De Maria Serrano%' OR
    Texto like '%De Maria Serrano%' OR
    
    Titulo like '%FEMEXFUT%' OR
    Titulo like '%Federacion Mexicana de Futbol%' OR
    Titulo like '%Decio De Maria Serrano%' OR
    Titulo like '%De Maria Serrano%' OR

    Encabezado like '%FEMEXFUT%' OR
    Encabezado like '%Federacion Mexicana de Futbol%' OR
    Encabezado like '%Decio De Maria Serrano%' OR
    Encabezado like '%De Maria Serrano%' OR
      
    PieFoto like '%FEMEXFUT%' OR
    PieFoto like '%Federacion Mexicana de Futbol%' OR
    PieFoto like '%Decio De Maria Serrano%' OR
    PieFoto like '%De Maria Serrano%' OR
     
    Autor like '%FEMEXFUT%'  OR
    Autor like '%Federacion Mexicana de Futbol%' OR
    Autor like '%Decio De Maria Serrano%' OR
    Autor like '%De Maria Serrano%'
) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /***********  EOF FEMEXFUT ESTADOS     ************/
        
        case 7: /***********  SEL. NACIONAL DF  ************/
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
    Texto like '%Seleccion Nacional de Futbol%' OR 
    Texto like '%Seleccion Mexicana de Futbol%' OR
    Texto like '%Seleccion de Futbol de Mexico%' OR
    Texto like '%Seleccion Nacional%' OR
    Texto like '%juan carlos osorio%' OR
        
    Titulo like '%Seleccion Nacional de Futbol%' OR
    Titulo like '%Seleccion Mexicana de Futbol%' OR
    Titulo like '%Seleccion de Futbol de Mexico%' OR
    Titulo like '%Seleccion Nacional%' OR
    Titulo like '%juan carlos osorio%' OR

    Encabezado like '%Seleccion Nacional de Futbol%' OR
    Encabezado like '%Seleccion Mexicana de Futbol%' OR
    Encabezado like '%Seleccion de Futbol de Mexico%' OR
    Encabezado like '%Seleccion Nacional%' OR
    Encabezado like '%juan carlos osorio%' OR
      
    PieFoto like '%Seleccion Nacional de Futbol%' OR
    PieFoto like '%Seleccion Mexicana de Futbol%' OR
    PieFoto like '%Seleccion de Futbol de Mexico%' OR
    PieFoto like '%Seleccion Nacional%' OR
    PieFoto like '%juan carlos osorio%' OR
     
    Autor like '%Seleccion Nacional de Futbol%'  OR
    Autor like '%Seleccion Mexicana de Futbol%'  OR
    Autor like '%Seleccion de Futbol de Mexico%' OR
    Autor like '%Seleccion Nacional%' OR
    Autor like '%juan carlos osorio%'   
)  GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 8: /***********  SEL. NACIONAL ESTADOS     ************/
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
    Texto like '%Seleccion Nacional de Futbol%' OR 
    Texto like '%Seleccion Mexicana de Futbol%' OR
    Texto like '%Seleccion de Futbol de Mexico%' OR
    Texto like '%Seleccion Nacional%' OR
    Texto like '%juan carlos osorio%' OR
        
    Titulo like '%Seleccion Nacional de Futbol%' OR
    Titulo like '%Seleccion Mexicana de Futbol%' OR
    Titulo like '%Seleccion de Futbol de Mexico%' OR
    Titulo like '%Seleccion Nacional%' OR
    Titulo like '%juan carlos osorio%' OR

    Encabezado like '%Seleccion Nacional de Futbol%' OR
    Encabezado like '%Seleccion Mexicana de Futbol%' OR
    Encabezado like '%Seleccion de Futbol de Mexico%' OR
    Encabezado like '%Seleccion Nacional%' OR
    Encabezado like '%juan carlos osorio%' OR
      
    PieFoto like '%Seleccion Nacional de Futbol%' OR
    PieFoto like '%Seleccion Mexicana de Futbol%' OR
    PieFoto like '%Seleccion de Futbol de Mexico%' OR
    PieFoto like '%Seleccion Nacional%' OR
    PieFoto like '%juan carlos osorio%' OR
     
    Autor like '%Seleccion Nacional de Futbol%'  OR
    Autor like '%Seleccion Mexicana de Futbol%'  OR
    Autor like '%Seleccion de Futbol de Mexico%' OR
    Autor like '%Seleccion Nacional%' OR
    Autor like '%juan carlos osorio%'   
)  GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** EOF SEL. NACIONAL ESTADOS ************/

        case 9: /*********** AMERICA - DF ************/
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
    Texto like '%America' OR 
    Texto like '%Aguilas%' OR
    Texto like '%Aguila %' OR
    Texto like '%Ignacio Ambriz%' OR
    Texto like '%Nacho Ambriz%' OR
    Texto like '%Tecnico de las Aguilas%' OR
    Texto like '%Tecnico del America%' OR
    Texto like '%Benedetto%' OR
    
    Titulo like '%America' OR
    Titulo like '%Aguilas%' OR
    Titulo like '%Aguila %' OR
    Titulo like '%Ignacio Ambriz%' OR
    Titulo like '%Nacho Ambriz%' OR
    Titulo like '%Tecnico de las Aguilas%' OR
    Titulo like '%Tecnico del America%' OR
    Titulo like '%Benedetto%' OR

    Encabezado like '%America' OR
    Encabezado like '%Aguilas%' OR
    Encabezado like '%Aguila %' OR
    Encabezado like '%Ignacio Ambriz%' OR
    Encabezado like '%Nacho Ambriz%' OR
    Encabezado like '%Tecnico de las Aguilas%' OR
    Encabezado like '%Tecnico del America%' OR
    Encabezado like '%Benedetto%' OR
      
    PieFoto like '%America' OR
    PieFoto like '%Aguilas%' OR
    PieFoto like '%Aguila %' OR
    PieFoto like '%Ignacio Ambriz%' OR
    PieFoto like '%Nacho Ambriz%' OR
    PieFoto like '%Tecnico de las Aguilas%' OR
    PieFoto like '%Tecnico del America%' OR
    PieFoto like '%Benedetto%'
) AND (
    Texto not like '%Ecuador%' AND
    Texto  not like '%nfl%' AND
    Texto not like '%Copa America%'
)  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 10: /*********** AMERICA ESTADOS     ************/
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
    Texto like '%America' OR 
    Texto like '%Aguilas%' OR
    Texto like '%Aguila %' OR
    Texto like '%Ignacio Ambriz%' OR
    Texto like '%Nacho Ambriz%' OR
    Texto like '%Tecnico de las Aguilas%' OR
    Texto like '%Tecnico del America%' OR
    Texto like '%Benedetto%' OR
    
    Titulo like '%America' OR
    Titulo like '%Aguilas%' OR
    Titulo like '%Aguila %' OR
    Titulo like '%Ignacio Ambriz%' OR
    Titulo like '%Nacho Ambriz%' OR
    Titulo like '%Tecnico de las Aguilas%' OR
    Titulo like '%Tecnico del America%' OR
    Titulo like '%Benedetto%' OR

    Encabezado like '%America' OR
    Encabezado like '%Aguilas%' OR
    Encabezado like '%Aguila %' OR
    Encabezado like '%Ignacio Ambriz%' OR
    Encabezado like '%Nacho Ambriz%' OR
    Encabezado like '%Tecnico de las Aguilas%' OR
    Encabezado like '%Tecnico del America%' OR
    Encabezado like '%Benedetto%' OR
      
    PieFoto like '%America' OR
    PieFoto like '%Aguilas%' OR
    PieFoto like '%Aguila %' OR
    PieFoto like '%Ignacio Ambriz%' OR
    PieFoto like '%Nacho Ambriz%' OR
    PieFoto like '%Tecnico de las Aguilas%' OR
    PieFoto like '%Tecnico del America%' OR
    PieFoto like '%Benedetto%'
) AND (
    Texto not like '%Ecuador%' AND
    Texto  not like '%nfl%' AND
    Texto not like '%Copa America%'
) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** AMERICA ESTADOS ************/

        case 11: /*********** ATLAS - DF ************/
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
    Texto like '%Atlas%' OR 
    Texto like '%Gustavo Adolfo Costas Makeira%' OR
    Texto like '%Adolfo Costas Makeira%' OR
    Texto like '%Rafael Marquez%' OR
    
    Titulo like '%Atlas%' OR 
    Titulo like '%Gustavo Adolfo Costas Makeira%' OR
    Titulo like '%Adolfo Costas Makeira%' OR
    Titulo like '%Rafael Marquez%' OR
    
    Encabezado like '%Atlas%' OR 
    Encabezado like '%Gustavo Adolfo Costas Makeira%' OR
    Encabezado like '%Adolfo Costas Makeira%' OR
    Encabezado like '%Rafael Marquez%' OR
    
    PieFoto like '%Atlas%' OR 
    PieFoto like '%Gustavo Adolfo Costas Makeira%' OR
    PieFoto like '%Adolfo Costas Makeira%' OR
    PieFoto like '%Rafael Marquez%' OR
    

    Autor like '%Atlas%' OR 
    Autor like '%Gustavo Adolfo Costas Makeira%' OR
    Autor like '%Adolfo Costas Makeira%' OR
    Autor like '%Rafael Marquez%' 
    
) AND
(
    Texto not like '%seleccion mexicana%'
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 12: /*********** ATLAS- ESTADOS ************/
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
    Texto like '%Atlas%' OR 
    Texto like '%Gustavo Adolfo Costas Makeira%' OR
    Texto like '%Adolfo Costas Makeira%' OR
    Texto like '%Rafael Marquez%' OR
    
    Titulo like '%Atlas%' OR 
    Titulo like '%Gustavo Adolfo Costas Makeira%' OR
    Titulo like '%Adolfo Costas Makeira%' OR
    Titulo like '%Rafael Marquez%' OR
    
    Encabezado like '%Atlas%' OR 
    Encabezado like '%Gustavo Adolfo Costas Makeira%' OR
    Encabezado like '%Adolfo Costas Makeira%' OR
    Encabezado like '%Rafael Marquez%' OR
    
    PieFoto like '%Atlas%' OR 
    PieFoto like '%Gustavo Adolfo Costas Makeira%' OR
    PieFoto like '%Adolfo Costas Makeira%' OR
    PieFoto like '%Rafael Marquez%' OR
    

    Autor like '%Atlas%' OR 
    Autor like '%Gustavo Adolfo Costas Makeira%' OR
    Autor like '%Adolfo Costas Makeira%' OR
    Autor like '%Rafael Marquez%' 
    
) AND
(
    Texto not like '%seleccion mexicana%'
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** ATLAS ESTADOS ************/

        case 13: /*********** CHIVAS DF ************/
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
    Texto like '%Chivas%' OR 
    Texto like '%Rebaño%' OR
    Texto like '%Rojiblanco%' OR
    Texto like '%Omar Bravo%' OR
    Texto like '%Jaime Ordiales%' OR
    Texto like '%Matias Almeya%' OR
    Texto like '%Jorge Vergara%' OR
   Texto like '%Rodolfo Cota%' OR
    
    Titulo like '%Chivas%' OR 
    Titulo like '%Rebaño%' OR
    Titulo like '%Rojiblanco%' OR
    Titulo like '%Omar Bravo%' OR
    Titulo like '%Jaime Ordiales%' OR
    Titulo like '%Matias Almeya%' OR
    Titulo like '%Jorge Vergara%' OR
    Titulo like '%Rodolfo Cota%' OR
    
    Encabezado like '%Chivas%' OR 
    Encabezado like '%Rebaño%' OR
    Encabezado like '%Rojiblanco%' OR
    Encabezado like '%Omar Bravo%' OR
    Encabezado like '%Jaime Ordiales%' OR
    Encabezado like '%Matias Almeya%' OR
    Encabezado like '%Jorge Vergara%' OR
     Encabezado like '%Rodolfo Cota%' OR
    
    PieFoto like '%Chivas%' OR 
    PieFoto like '%Rebaño%' OR
    PieFoto like '%Rojiblanco%' OR
    PieFoto like '%Omar Bravo%' OR
    PieFoto like '%Jaime Ordiales%' OR
    PieFoto like '%Matias Almeya%' OR
    PieFoto like '%Jorge Vergara%' OR
    PieFoto like '%Rodolfo Cota%' OR
    
    Autor like '%Chivas%' OR 
    Autor like '%Rebaño%' OR
    Autor like '%Rojiblanco%' OR
    Autor like '%Omar Bravo%' OR
    Autor like '%Jaime Ordiales%' OR
    Autor like '%Matias Almeya%' OR
    Autor like '%Jorge Vergara%' OR 
   Autor like '%Rodolfo Cota%' 
    
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 14: /*********** CHIVAS ESTADOS ************/
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
    Texto like '%Chivas%' OR 
    Texto like '%Rebaño%' OR
    Texto like '%Rojiblanco%' OR
    Texto like '%Omar Bravo%' OR
    Texto like '%Jaime Ordiales%' OR
    Texto like '%Matias Almeya%' OR
    Texto like '%Jorge Vergara%' OR
   Texto like '%Rodolfo Cota%' OR
    
    Titulo like '%Chivas%' OR 
    Titulo like '%Rebaño%' OR
    Titulo like '%Rojiblanco%' OR
    Titulo like '%Omar Bravo%' OR
    Titulo like '%Jaime Ordiales%' OR
    Titulo like '%Matias Almeya%' OR
    Titulo like '%Jorge Vergara%' OR
    Titulo like '%Rodolfo Cota%' OR
    
    Encabezado like '%Chivas%' OR 
    Encabezado like '%Rebaño%' OR
    Encabezado like '%Rojiblanco%' OR
    Encabezado like '%Omar Bravo%' OR
    Encabezado like '%Jaime Ordiales%' OR
    Encabezado like '%Matias Almeya%' OR
    Encabezado like '%Jorge Vergara%' OR
     Encabezado like '%Rodolfo Cota%' OR
    
    PieFoto like '%Chivas%' OR 
    PieFoto like '%Rebaño%' OR
    PieFoto like '%Rojiblanco%' OR
    PieFoto like '%Omar Bravo%' OR
    PieFoto like '%Jaime Ordiales%' OR
    PieFoto like '%Matias Almeya%' OR
    PieFoto like '%Jorge Vergara%' OR
    PieFoto like '%Rodolfo Cota%' OR
    
    Autor like '%Chivas%' OR 
    Autor like '%Rebaño%' OR
    Autor like '%Rojiblanco%' OR
    Autor like '%Omar Bravo%' OR
    Autor like '%Jaime Ordiales%' OR
    Autor like '%Matias Almeya%' OR
    Autor like '%Jorge Vergara%' OR 
   Autor like '%Rodolfo Cota%' 
    
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** CHIVAS ESTADOS ************/
        
        case 15: /*********** CRUZ AZUL DF ************/
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
    Texto like '%Cruz Azul%' OR 
    Texto like '%Tomas Boy%' OR
    Texto like '%Jefe Boy%' OR
    Texto like '%Matias Vuoso%' OR
    Texto like '%Chaco Gimenez%' OR
    Texto like '%Christian Gimenez %' OR
    Texto like '%Joffre Guerron%' OR
    Texto like '%La Maquina Cementera%' OR
    Texto like '%La Maquina Celeste%' OR
    Texto like '%Los Cementeros%' OR
    Texto like '%Chaco' OR

     Titulo like '%Cruz Azul%' OR 
    Titulo like '%Tomas Boy%' OR
    Titulo like '%Jefe Boy%' OR
    Titulo like '%Matias Vuoso%' OR
    Titulo like '%Chaco Gimenez%' OR
    Titulo like '%Christian Gimenez %' OR
    Titulo like '%Joffre Guerron%' OR
    Titulo like '%La Maquina Cementera%' OR
    Titulo like '%La Maquina Celeste%' OR
    Titulo like '%Los Cementeros%' OR
    Titulo like '%Chaco' OR

     Encabezado like '%Cruz Azul%' OR 
    Encabezado like '%Tomas Boy%' OR
    Encabezado like '%Jefe Boy%' OR
    Encabezado like '%Matias Vuoso%' OR
    Encabezado like '%Chaco Gimenez%' OR
    Encabezado like '%Christian Gimenez %' OR
    Encabezado like '%Joffre Guerron%' OR
    Encabezado like '%La Maquina Cementera%' OR
    Encabezado like '%La Maquina Celeste%' OR
    Encabezado like '%Los Cementeros%' OR
    Encabezado like '%Chaco' OR

     PieFoto like '%Cruz Azul%' OR 
    PieFoto like '%Tomas Boy%' OR
    PieFoto like '%Jefe Boy%' OR
    PieFoto like '%Matias Vuoso%' OR
    PieFoto like '%Chaco Gimenez%' OR
    PieFoto like '%Christian Gimenez %' OR
    PieFoto like '%Joffre Guerron%' OR
    PieFoto like '%La Maquina Cementera%' OR
    PieFoto like '%La Maquina Celeste%' OR
    PieFoto like '%Los Cementeros%' OR
    PieFoto like '%Chaco' OR

     Autor like '%Cruz Azul%' OR 
    Autor like '%Tomas Boy%' OR
    Autor like '%Jefe Boy%' OR
    Autor like '%Matias Vuoso%' OR
    Autor like '%Chaco Gimenez%' OR
    Autor like '%Christian Gimenez %' OR
    Autor like '%Joffre Guerron%' OR
    Autor like '%La Maquina Cementera%' OR
    Autor like '%La Maquina Celeste%' OR
    Autor like '%Los Cementeros%' OR
    Autor like '%Chaco'   
) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 16: /*********** CRUZ AZUL ESTADOS ************/
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
    Texto like '%Cruz Azul%' OR 
    Texto like '%Tomas Boy%' OR
    Texto like '%Jefe Boy%' OR
    Texto like '%Matias Vuoso%' OR
    Texto like '%Chaco Gimenez%' OR
    Texto like '%Christian Gimenez %' OR
    Texto like '%Joffre Guerron%' OR
    Texto like '%La Maquina Cementera%' OR
    Texto like '%La Maquina Celeste%' OR
    Texto like '%Los Cementeros%' OR
    Texto like '%Chaco' OR

     Titulo like '%Cruz Azul%' OR 
    Titulo like '%Tomas Boy%' OR
    Titulo like '%Jefe Boy%' OR
    Titulo like '%Matias Vuoso%' OR
    Titulo like '%Chaco Gimenez%' OR
    Titulo like '%Christian Gimenez %' OR
    Titulo like '%Joffre Guerron%' OR
    Titulo like '%La Maquina Cementera%' OR
    Titulo like '%La Maquina Celeste%' OR
    Titulo like '%Los Cementeros%' OR
    Titulo like '%Chaco' OR

     Encabezado like '%Cruz Azul%' OR 
    Encabezado like '%Tomas Boy%' OR
    Encabezado like '%Jefe Boy%' OR
    Encabezado like '%Matias Vuoso%' OR
    Encabezado like '%Chaco Gimenez%' OR
    Encabezado like '%Christian Gimenez %' OR
    Encabezado like '%Joffre Guerron%' OR
    Encabezado like '%La Maquina Cementera%' OR
    Encabezado like '%La Maquina Celeste%' OR
    Encabezado like '%Los Cementeros%' OR
    Encabezado like '%Chaco' OR

     PieFoto like '%Cruz Azul%' OR 
    PieFoto like '%Tomas Boy%' OR
    PieFoto like '%Jefe Boy%' OR
    PieFoto like '%Matias Vuoso%' OR
    PieFoto like '%Chaco Gimenez%' OR
    PieFoto like '%Christian Gimenez %' OR
    PieFoto like '%Joffre Guerron%' OR
    PieFoto like '%La Maquina Cementera%' OR
    PieFoto like '%La Maquina Celeste%' OR
    PieFoto like '%Los Cementeros%' OR
    PieFoto like '%Chaco' OR

     Autor like '%Cruz Azul%' OR 
    Autor like '%Tomas Boy%' OR
    Autor like '%Jefe Boy%' OR
    Autor like '%Matias Vuoso%' OR
    Autor like '%Chaco Gimenez%' OR
    Autor like '%Christian Gimenez %' OR
    Autor like '%Joffre Guerron%' OR
    Autor like '%La Maquina Cementera%' OR
    Autor like '%La Maquina Celeste%' OR
    Autor like '%Los Cementeros%' OR
    Autor like '%Chaco'   
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** CRUZ AZUL ESTADOS ************/

        case 17: /*********** DORADOS DF ************/
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
    Texto like '%Dorados%' OR 
    Texto like '%El Gran Pez%' OR
    Texto like '%Jose Antonio Nuñez%' OR
    Texto like '%Jose Guadalupe Cruz%' OR
    Texto like '%Luis Michel%' OR

   Titulo like '%Dorados%' OR 
    Titulo like '%El Gran Pez%' OR
    Titulo like '%Jose Antonio Nuñez%' OR
    Titulo like '%Jose Guadalupe Cruz%' OR
    Titulo like '%Luis Michel%' OR

   Encabezado like '%Dorados%' OR 
    Encabezado like '%El Gran Pez%' OR
    Encabezado like '%Jose Antonio Nuñez%' OR
    Encabezado like '%Jose Guadalupe Cruz%' OR
    Encabezado like '%Luis Michel%' OR

   PieFoto like '%Dorados%' OR 
    PieFoto like '%El Gran Pez%' OR
    PieFoto like '%Jose Antonio Nuñez%' OR
    PieFoto like '%Jose Guadalupe Cruz%' OR
    PieFoto like '%Luis Michel%' OR

   Autor like '%Dorados%' OR 
    Autor like '%El Gran Pez%' OR
    Autor like '%Jose Antonio Nuñez%' OR
    Autor like '%Jose Guadalupe Cruz%' OR
    Autor like '%Luis Michel%' 

) AND
( 
Texto not like '%adornos%'   
)
 GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 18: /*********** DORADOS ESTADOS ************/
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
    Texto like '%Dorados%' OR 
    Texto like '%El Gran Pez%' OR
    Texto like '%Jose Antonio Nuñez%' OR
    Texto like '%Jose Guadalupe Cruz%' OR
    Texto like '%Luis Michel%' OR

   Titulo like '%Dorados%' OR 
    Titulo like '%El Gran Pez%' OR
    Titulo like '%Jose Antonio Nuñez%' OR
    Titulo like '%Jose Guadalupe Cruz%' OR
    Titulo like '%Luis Michel%' OR

   Encabezado like '%Dorados%' OR 
    Encabezado like '%El Gran Pez%' OR
    Encabezado like '%Jose Antonio Nuñez%' OR
    Encabezado like '%Jose Guadalupe Cruz%' OR
    Encabezado like '%Luis Michel%' OR

   PieFoto like '%Dorados%' OR 
    PieFoto like '%El Gran Pez%' OR
    PieFoto like '%Jose Antonio Nuñez%' OR
    PieFoto like '%Jose Guadalupe Cruz%' OR
    PieFoto like '%Luis Michel%' OR

   Autor like '%Dorados%' OR 
    Autor like '%El Gran Pez%' OR
    Autor like '%Jose Antonio Nuñez%' OR
    Autor like '%Jose Guadalupe Cruz%' OR
    Autor like '%Luis Michel%' 

) AND
( 
Texto not like '%adornos%'   
)

                    GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** DORADOS ESTADOS ************/


        case 19: /*********** GALLOS BLANCOS DF ************/
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
        Texto like '%Gallos Blancos%' OR
        Texto like '%Gallos de queretaro%' OR
        Texto like '%Club Queretaro%' OR
        Texto like '%victor manuel vucetich%' OR
        Texto like '%vucetich%' OR
                Texto like '%GALLOS BLANCOS%' OR
                Texto like '%Victor Manuel Vucetich%' OR
                Texto like '%Gallos de Queretaro%' OR
                Texto like '%Vucetich%' OR
                Texto like '%Gallos de Querétaro%' OR

        Titulo like '%Gallor Blancos%' OR
        Titulo like '%Gallos de queretaro%' OR
        Titulo like '%Club Queretaro%' OR
        Titulo like '%victor manuel vucetich%' OR
        Titulo like '%vucetich%' OR

        Encabezado like '%Gallos Blancos%' OR
        Encabezado like '%Gallos de queretaro%' OR
        Encabezado like '%Club queretaro%' OR
        Encabezado like '%victor manuel vucetich%' OR
        Encabezado like '%vucetich%' OR

        Autor like '%Gallos Blancos%' OR
        Autor like '%Gallos de queretaro%' OR
        Autor like '%Club queretaro%' OR
        Autor like '%victor manuel vucetich%' OR
        Autor like '%vucetich%' OR

        PieFoto like '%Gallos Blancos%' OR
        PieFoto like '%Gallos de queretaro%' OR
        PieFoto like '%Club queretaro%' OR
        PieFoto like '%victor manuel vucetich%' OR
        PieFoto like '%vucetich%'
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 20: /*********** GALLOS BLANCOS ESTADOS ************/
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
        Texto like '%Gallos Blancos%' OR
        Texto like '%Gallos de queretaro%' OR
        Texto like '%Club Queretaro%' OR
        Texto like '%victor manuel vucetich%' OR
        Texto like '%vucetich%' OR
                Texto like '%GALLOS BLANCOS%' OR
                Texto like '%Victor Manuel Vucetich%' OR
                Texto like '%Gallos de Queretaro%' OR
                Texto like '%Vucetich%' OR
                Texto like '%Gallos de Querétaro%' OR

        Titulo like '%Gallor Blancos%' OR
        Titulo like '%Gallos de queretaro%' OR
        Titulo like '%Club Queretaro%' OR
        Titulo like '%victor manuel vucetich%' OR
        Titulo like '%vucetich%' OR

        Encabezado like '%Gallos Blancos%' OR
        Encabezado like '%Gallos de queretaro%' OR
        Encabezado like '%Club queretaro%' OR
        Encabezado like '%victor manuel vucetich%' OR
        Encabezado like '%vucetich%' OR

        Autor like '%Gallos Blancos%' OR
        Autor like '%Gallos de queretaro%' OR
        Autor like '%Club queretaro%' OR
        Autor like '%victor manuel vucetich%' OR
        Autor like '%vucetich%' OR

        PieFoto like '%Gallos Blancos%' OR
        PieFoto like '%Gallos de queretaro%' OR
        PieFoto like '%Club queretaro%' OR
        PieFoto like '%victor manuel vucetich%' OR
        PieFoto like '%vucetich%'
    )GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
   	
            return $query;
        break; /*********** EOF GALLOS BLANCOS ESTADOS ************/

        case 21: /*********** JAGUARES DF ************/
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
    Texto like '%Jaguares%' OR
    Texto like '%Carlos Hugo Lopez Chargoy%' OR 
    Texto like '%Hugo Lopez Chargoy%' OR 
    Texto like '%Ricardo La Volpe%' OR 
    Texto like '%Jesus Rodriguez%' OR 
    Texto like '%Emiliano Armenteros%' OR
    Texto like '%Silvio Romero%' OR
    Texto like '%Francisco Silva%' OR

    Titulo like '%Jaguares%' OR
    Titulo like '%Carlos Hugo Lopez Chargoy%' OR 
    Titulo like '%Hugo Lopez Chargoy%' OR 
    Titulo like '%Ricardo La Volpe%' OR 
    Titulo like '%Jesus Rodriguez%' OR 
    Titulo like '%Emiliano Armenteros%' OR
    Titulo like '%Silvio Romero%' OR
    Titulo like '%Francisco Silva%' OR
    
     Encabezado like '%Jaguares%' OR
    Encabezado like '%Carlos Hugo Lopez Chargoy%' OR 
    Encabezado like '%Hugo Lopez Chargoy%' OR 
    Encabezado like '%Ricardo La Volpe%' OR 
    Encabezado like '%Jesus Rodriguez%' OR 
    Encabezado like '%Emiliano Armenteros%' OR
    Encabezado like '%Silvio Romero%' OR
    Encabezado like '%Francisco Silva%' OR
    
     PieFoto like '%Jaguares%' OR
    PieFoto like '%Carlos Hugo Lopez Chargoy%' OR 
    PieFoto like '%Hugo Lopez Chargoy%' OR 
    PieFoto like '%Ricardo La Volpe%' OR 
    PieFoto like '%Jesus Rodriguez%' OR 
    PieFoto like '%Emiliano Armenteros%' OR
    PieFoto like '%Silvio Romero%' OR
    PieFoto like '%Francisco Silva%' OR
    
     Autor like '%Jaguares%' OR
    Autor like '%Carlos Hugo Lopez Chargoy%' OR 
    Autor like '%Hugo Lopez Chargoy%' OR 
    Autor like '%Ricardo La Volpe%' OR 
    Autor like '%Jesus Rodriguez%' OR 
    Autor like '%Emiliano Armenteros%' OR
    Autor like '%Silvio Romero%' OR
    Autor like '%Francisco Silva%' 
) 
   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 22: /*********** JAGUARES ESTADOS ************/
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
    Texto like '%Jaguares%' OR
    Texto like '%Carlos Hugo Lopez Chargoy%' OR 
    Texto like '%Hugo Lopez Chargoy%' OR 
    Texto like '%Ricardo La Volpe%' OR 
    Texto like '%Jesus Rodriguez%' OR 
    Texto like '%Emiliano Armenteros%' OR
    Texto like '%Silvio Romero%' OR
    Texto like '%Francisco Silva%' OR

    Titulo like '%Jaguares%' OR
    Titulo like '%Carlos Hugo Lopez Chargoy%' OR 
    Titulo like '%Hugo Lopez Chargoy%' OR 
    Titulo like '%Ricardo La Volpe%' OR 
    Titulo like '%Jesus Rodriguez%' OR 
    Titulo like '%Emiliano Armenteros%' OR
    Titulo like '%Silvio Romero%' OR
    Titulo like '%Francisco Silva%' OR
    
     Encabezado like '%Jaguares%' OR
    Encabezado like '%Carlos Hugo Lopez Chargoy%' OR 
    Encabezado like '%Hugo Lopez Chargoy%' OR 
    Encabezado like '%Ricardo La Volpe%' OR 
    Encabezado like '%Jesus Rodriguez%' OR 
    Encabezado like '%Emiliano Armenteros%' OR
    Encabezado like '%Silvio Romero%' OR
    Encabezado like '%Francisco Silva%' OR
    
     PieFoto like '%Jaguares%' OR
    PieFoto like '%Carlos Hugo Lopez Chargoy%' OR 
    PieFoto like '%Hugo Lopez Chargoy%' OR 
    PieFoto like '%Ricardo La Volpe%' OR 
    PieFoto like '%Jesus Rodriguez%' OR 
    PieFoto like '%Emiliano Armenteros%' OR
    PieFoto like '%Silvio Romero%' OR
    PieFoto like '%Francisco Silva%' OR
    
     Autor like '%Jaguares%' OR
    Autor like '%Carlos Hugo Lopez Chargoy%' OR 
    Autor like '%Hugo Lopez Chargoy%' OR 
    Autor like '%Ricardo La Volpe%' OR 
    Autor like '%Jesus Rodriguez%' OR 
    Autor like '%Emiliano Armenteros%' OR
    Autor like '%Silvio Romero%' OR
    Autor like '%Francisco Silva%' 
) 
 GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** JAGUARES ESTADOS ************/

        case 23: /*********** LEON DF ************/
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
    Texto like '% El Leon %' OR
    Texto like '%Leon Club de futbol%' OR
    Texto like '%Panzas Verdes%' OR 
    Texto like '%Boselli%' OR
    Texto like '%Luis fernando tena%' OR
    Texto like '%Fernando Tena%' OR
    
    Titulo like '% El Leon %' OR
    Titulo like '%Leon Club de futbol%' OR
    Titulo like '%Panzas Verdes%' OR    
    Titulo like '%Boselli%' OR
    Titulo like '%Luis fernando tena%' OR
    Titulo like '%Fernando Tena%' OR

    Encabezado like '% El Leon %' OR
    Encabezado like '%Leon Club de futbol%' OR
    Encabezado like '%Panzas Verdes%' OR    
    Encabezado like '%Boselli%' OR
    Encabezado like '%Luis fernando tena%' OR
    Encabezado like '%Fernando Tena%' OR
          
    PieFoto like '% El Leon %' OR
    PieFoto like '%Leon Club de futbol%' OR
    PieFoto like '%Panzas Verdes%' OR   
    PieFoto like '%Boselli%' OR
    PieFoto like '%Luis fernando tena%' OR
    PieFoto like '%Fernando Tena%'    
)   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 24: /*********** LEON ESTADOS ************/
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
    Texto like '% El Leon %' OR
    Texto like '%Leon Club de futbol%' OR
    Texto like '%Panzas Verdes%' OR 
    Texto like '%Boselli%' OR
    Texto like '%Luis fernando tena%' OR
    Texto like '%Fernando Tena%' OR
    
    Titulo like '% El Leon %' OR
    Titulo like '%Leon Club de futbol%' OR
    Titulo like '%Panzas Verdes%' OR    
    Titulo like '%Boselli%' OR
    Titulo like '%Luis fernando tena%' OR
    Titulo like '%Fernando Tena%' OR

    Encabezado like '% El Leon %' OR
    Encabezado like '%Leon Club de futbol%' OR
    Encabezado like '%Panzas Verdes%' OR    
    Encabezado like '%Boselli%' OR
    Encabezado like '%Luis fernando tena%' OR
    Encabezado like '%Fernando Tena%' OR
          
    PieFoto like '% El Leon %' OR
    PieFoto like '%Leon Club de futbol%' OR
    PieFoto like '%Panzas Verdes%' OR   
    PieFoto like '%Boselli%' OR
    PieFoto like '%Luis fernando tena%' OR
    PieFoto like '%Fernando Tena%'    
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** LEON ESTADOS ************/


        case 25: /*********** MONTERREY DF ************/
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
    Texto like '%Monterrey%' OR 
    Texto like '%Rayados%' OR 
    Texto like '%Albiazules%' OR 
    Texto like '%La Pandilla%' OR 
    Texto like '%Luis Miguel Salvador%' OR 
    Texto like '%Antonio Mohamed%' OR 
    Texto like '%Neri Cardozo%' OR 
    Texto like '%Dorlan Pabon%' OR 
    Texto like '%Rogelio Funes Mori%' OR 
    Texto like '%Aldo de Nigris%' OR 

    Titulo like '%Monterrey%' OR 
    Titulo like '%Rayados%' OR 
    Titulo like '%Albiazules%' OR 
    Titulo like '%La Pandilla%' OR 
    Titulo like '%Luis Miguel Salvador%' OR 
    Titulo like '%Antonio Mohamed%' OR 
    Titulo like '%Neri Cardozo%' OR 
    Titulo like '%Dorlan Pabon%' OR 
    Titulo like '%Rogelio Funes Mori%' OR 
    Titulo like '%Aldo de Nigris%' OR 

    Encabezado like '%Monterrey%' OR 
    Encabezado like '%Rayados%' OR 
    Encabezado like '%Albiazules%' OR 
    Encabezado like '%La Pandilla%' OR 
    Encabezado like '%Luis Miguel Salvador%' OR 
    Encabezado like '%Antonio Mohamed%' OR 
    Encabezado like '%Neri Cardozo%' OR 
    Encabezado like '%Dorlan Pabon%' OR 
    Encabezado like '%Rogelio Funes Mori%' OR 
    Encabezado like '%Aldo de Nigris%' OR 

    PieFoto like '%Monterrey%' OR 
    PieFoto like '%Rayados%' OR 
    PieFoto like '%Albiazules%' OR 
    PieFoto like '%La Pandilla%' OR 
    PieFoto like '%Luis Miguel Salvador%' OR 
    PieFoto like '%Antonio Mohamed%' OR 
    PieFoto like '%Neri Cardozo%' OR 
    PieFoto like '%Dorlan Pabon%' OR 
    PieFoto like '%Rogelio Funes Mori%' OR 
    PieFoto like '%Aldo de Nigris%' OR 

    Autor like '%Monterrey%' OR 
    Autor like '%Rayados%' OR 
    Autor like '%Albiazules%' OR 
    Autor like '%La Pandilla%' OR 
    Autor like '%Luis Miguel Salvador%' OR 
    Autor like '%Antonio Mohamed%' OR 
    Autor like '%Neri Cardozo%' OR 
    Autor like '%Dorlan Pabon%' OR 
    Autor like '%Rogelio Funes Mori%' OR 
    Autor like '%Aldo de Nigris%' 
)
   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 26: /*********** MONTERREY ESTADOS ************/
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
    Texto like '%Monterrey%' OR 
    Texto like '%Rayados%' OR 
    Texto like '%Albiazules%' OR 
    Texto like '%La Pandilla%' OR 
    Texto like '%Luis Miguel Salvador%' OR 
    Texto like '%Antonio Mohamed%' OR 
    Texto like '%Neri Cardozo%' OR 
    Texto like '%Dorlan Pabon%' OR 
    Texto like '%Rogelio Funes Mori%' OR 
    Texto like '%Aldo de Nigris%' OR 

    Titulo like '%Monterrey%' OR 
    Titulo like '%Rayados%' OR 
    Titulo like '%Albiazules%' OR 
    Titulo like '%La Pandilla%' OR 
    Titulo like '%Luis Miguel Salvador%' OR 
    Titulo like '%Antonio Mohamed%' OR 
    Titulo like '%Neri Cardozo%' OR 
    Titulo like '%Dorlan Pabon%' OR 
    Titulo like '%Rogelio Funes Mori%' OR 
    Titulo like '%Aldo de Nigris%' OR 

    Encabezado like '%Monterrey%' OR 
    Encabezado like '%Rayados%' OR 
    Encabezado like '%Albiazules%' OR 
    Encabezado like '%La Pandilla%' OR 
    Encabezado like '%Luis Miguel Salvador%' OR 
    Encabezado like '%Antonio Mohamed%' OR 
    Encabezado like '%Neri Cardozo%' OR 
    Encabezado like '%Dorlan Pabon%' OR 
    Encabezado like '%Rogelio Funes Mori%' OR 
    Encabezado like '%Aldo de Nigris%' OR 

    PieFoto like '%Monterrey%' OR 
    PieFoto like '%Rayados%' OR 
    PieFoto like '%Albiazules%' OR 
    PieFoto like '%La Pandilla%' OR 
    PieFoto like '%Luis Miguel Salvador%' OR 
    PieFoto like '%Antonio Mohamed%' OR 
    PieFoto like '%Neri Cardozo%' OR 
    PieFoto like '%Dorlan Pabon%' OR 
    PieFoto like '%Rogelio Funes Mori%' OR 
    PieFoto like '%Aldo de Nigris%' OR 

    Autor like '%Monterrey%' OR 
    Autor like '%Rayados%' OR 
    Autor like '%Albiazules%' OR 
    Autor like '%La Pandilla%' OR 
    Autor like '%Luis Miguel Salvador%' OR 
    Autor like '%Antonio Mohamed%' OR 
    Autor like '%Neri Cardozo%' OR 
    Autor like '%Dorlan Pabon%' OR 
    Autor like '%Rogelio Funes Mori%' OR 
    Autor like '%Aldo de Nigris%' 
)
 GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** MONTERREY ESTADOS ************/

        case 27: /*********** MORELIA DF ************/
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
    Texto like '%Morelia%' OR 
    Texto like '%Monarcas Morelia%' OR 
    Texto like '%La Monarquia%' OR 
    Texto like '%Los Canarios%' OR 
    Texto like '%Los Ates%' OR 
    Texto like '%Gustavo Guzman Sepulveda%' OR 
    Texto like '%Enrique Meza%' OR 
    Texto like '%Pablo Velazquez%' OR 
    Texto like '%Jefferson Cuero%' OR 
    Texto like '%Alejandro Gagliardi%' OR 

    Titulo like '%Morelia%' OR 
    Titulo like '%Monarcas Morelia%' OR 
    Titulo like '%La Monarquia%' OR 
    Titulo like '%Los Canarios%' OR 
    Titulo like '%Los Ates%' OR 
    Titulo like '%Gustavo Guzman Sepulveda%' OR 
    Titulo like '%Enrique Meza%' OR 
    Titulo like '%Pablo Velazquez%' OR 
    Titulo like '%Jefferson Cuero%' OR 
    Titulo like '%Alejandro Gagliardi%' OR 

    Encabezado like '%Morelia%' OR 
    Encabezado like '%Monarcas Morelia%' OR 
    Encabezado like '%La Monarquia%' OR 
    Encabezado like '%Los Canarios%' OR 
    Encabezado like '%Los Ates%' OR 
    Encabezado like '%Gustavo Guzman Sepulveda%' OR 
    Encabezado like '%Enrique Meza%' OR 
    Encabezado like '%Pablo Velazquez%' OR 
    Encabezado like '%Jefferson Cuero%' OR 
    Encabezado like '%Alejandro Gagliardi%' OR 

    PieFoto like '%Morelia%' OR 
    PieFoto like '%Monarcas Morelia%' OR 
    PieFoto like '%La Monarquia%' OR 
    PieFoto like '%Los Canarios%' OR 
    PieFoto like '%Los Ates%' OR 
    PieFoto like '%Gustavo Guzman Sepulveda%' OR 
    PieFoto like '%Enrique Meza%' OR 
    PieFoto like '%Pablo Velazquez%' OR 
    PieFoto like '%Jefferson Cuero%' OR 
    PieFoto like '%Alejandro Gagliardi%' OR 

    Autor like '%Morelia%' OR 
    Autor like '%Monarcas Morelia%' OR 
    Autor like '%La Monarquia%' OR 
    Autor like '%Los Canarios%' OR 
    Autor like '%Los Ates%' OR 
    Autor like '%Gustavo Guzman Sepulveda%' OR 
    Autor like '%Enrique Meza%' OR 
    Autor like '%Pablo Velazquez%' OR 
    Autor like '%Jefferson Cuero%' OR 
    Autor like '%Alejandro Gagliardi%' 
    
) 
  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 28: /*********** MORELIA ESTADOS ************/
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
    Texto like '%Morelia%' OR 
    Texto like '%Monarcas Morelia%' OR 
    Texto like '%La Monarquia%' OR 
    Texto like '%Los Canarios%' OR 
    Texto like '%Los Ates%' OR 
    Texto like '%Gustavo Guzman Sepulveda%' OR 
    Texto like '%Enrique Meza%' OR 
    Texto like '%Pablo Velazquez%' OR 
    Texto like '%Jefferson Cuero%' OR 
    Texto like '%Alejandro Gagliardi%' OR 

    Titulo like '%Morelia%' OR 
    Titulo like '%Monarcas Morelia%' OR 
    Titulo like '%La Monarquia%' OR 
    Titulo like '%Los Canarios%' OR 
    Titulo like '%Los Ates%' OR 
    Titulo like '%Gustavo Guzman Sepulveda%' OR 
    Titulo like '%Enrique Meza%' OR 
    Titulo like '%Pablo Velazquez%' OR 
    Titulo like '%Jefferson Cuero%' OR 
    Titulo like '%Alejandro Gagliardi%' OR 

    Encabezado like '%Morelia%' OR 
    Encabezado like '%Monarcas Morelia%' OR 
    Encabezado like '%La Monarquia%' OR 
    Encabezado like '%Los Canarios%' OR 
    Encabezado like '%Los Ates%' OR 
    Encabezado like '%Gustavo Guzman Sepulveda%' OR 
    Encabezado like '%Enrique Meza%' OR 
    Encabezado like '%Pablo Velazquez%' OR 
    Encabezado like '%Jefferson Cuero%' OR 
    Encabezado like '%Alejandro Gagliardi%' OR 

    PieFoto like '%Morelia%' OR 
    PieFoto like '%Monarcas Morelia%' OR 
    PieFoto like '%La Monarquia%' OR 
    PieFoto like '%Los Canarios%' OR 
    PieFoto like '%Los Ates%' OR 
    PieFoto like '%Gustavo Guzman Sepulveda%' OR 
    PieFoto like '%Enrique Meza%' OR 
    PieFoto like '%Pablo Velazquez%' OR 
    PieFoto like '%Jefferson Cuero%' OR 
    PieFoto like '%Alejandro Gagliardi%' OR 

    Autor like '%Morelia%' OR 
    Autor like '%Monarcas Morelia%' OR 
    Autor like '%La Monarquia%' OR 
    Autor like '%Los Canarios%' OR 
    Autor like '%Los Ates%' OR 
    Autor like '%Gustavo Guzman Sepulveda%' OR 
    Autor like '%Enrique Meza%' OR 
    Autor like '%Pablo Velazquez%' OR 
    Autor like '%Jefferson Cuero%' OR 
    Autor like '%Alejandro Gagliardi%' 
    
) 
 GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** MORELIA ESTADOS ************/

        case 29: /*********** PACHUCA DF ************/
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
        Texto like '%Pachuca%' OR
    Texto like '%Tuzos%' OR
    Texto like '%bella airosa%' OR
    Texto like '%Oscar Perez%' OR
    Texto like '%Conejo Perez%' OR
    Texto like '%Aquivaldo Mosquera%' OR
    Texto like '%Omar Esparza%' OR
    Texto like '%John Stefan Medina%' OR
    Texto like '%Hirving Lozano%' OR
    Texto like '%Jonathan Urretaviscaya%' OR
    Texto like '%Ruben Botta%' OR
    Texto like '%Lucas Silva%' OR
    Texto like '%Ariel Nahuelpan%' OR
    Texto like '%Gustavo Ramirez%' OR
    Texto like '%Juan José Calero%' OR
    Texto like '%Franco Jara%' OR
    Texto like '%Rodolfo Pizarro%' OR
    Texto like '%Diego Martin Alonso Lopez%' OR
    Texto like '%Jesus Martinez Patiño%' OR
    
    Titulo like '%Pachuca%' OR
    Titulo like '%Tuzos%' OR
    Titulo like '%bella airosa%' OR
    Titulo like '%Oscar Perez%' OR
    Titulo like '%Conejo Perez%' OR
    Titulo like '%Aquivaldo Mosquera%' OR
    Titulo like '%Omar Esparza%' OR
    Titulo like '%John Stefan Medina%' OR
    Titulo like '%Hirving Lozano%' OR
    Titulo like '%Jonathan Urretaviscaya%' OR
    Titulo like '%Ruben Botta%' OR
    Titulo like '%Lucas Silva%' OR
    Titulo like '%Ariel Nahuelpan%' OR
    Titulo like '%Gustavo Ramirez%' OR
    Titulo like '%Juan José Calero%' OR
    Titulo like '%Franco Jara%' OR
    Titulo like '%Rodolfo Pizarro%' OR
    Titulo like '%Diego Martin Alonso Lopez%' OR
    Titulo like '%Jesus Martinez Patiño%' OR

    Encabezado like '%Pachuca%' OR
    Encabezado like '%Tuzos%' OR
    Encabezado like '%bella airosa%' OR
    Encabezado like '%Oscar Perez%' OR
    Encabezado like '%Conejo Perez%' OR
    Encabezado like '%Aquivaldo Mosquera%' OR
    Encabezado like '%Omar Esparza%' OR
    Encabezado like '%John Stefan Medina%' OR
    Encabezado like '%Hirving Lozano%' OR
    Encabezado like '%Jonathan Urretaviscaya%' OR
    Encabezado like '%Ruben Botta%' OR
    Encabezado like '%Lucas Silva%' OR
    Encabezado like '%Ariel Nahuelpan%' OR
    Encabezado like '%Gustavo Ramirez%' OR
    Encabezado like '%Juan José Calero%' OR
    Encabezado like '%Franco Jara%' OR
    Encabezado like '%Rodolfo Pizarro%' OR
    Encabezado like '%Diego Martin Alonso Lopez%' OR
    Encabezado like '%Jesus Martinez Patiño%' OR
      
    PieFoto like '%Pachuca%' OR
    PieFoto like '%Tuzos%' OR
    PieFoto like '%bella airosa%' OR
    PieFoto like '%Oscar Perez%' OR
    PieFoto like '%Conejo Perez%' OR
    PieFoto like '%Aquivaldo Mosquera%' OR
    PieFoto like '%Omar Esparza%' OR
    PieFoto like '%John Stefan Medina%' OR
    PieFoto like '%Hirving Lozano%' OR
    PieFoto like '%Jonathan Urretaviscaya%' OR
    PieFoto like '%Ruben Botta%' OR
    PieFoto like '%Lucas Silva%' OR
    PieFoto like '%Ariel Nahuelpan%' OR
    PieFoto like '%Gustavo Ramirez%' OR
    PieFoto like '%Juan José Calero%' OR
    PieFoto like '%Franco Jara%' OR
    PieFoto like '%Rodolfo Pizarro%' OR
    PieFoto like '%Diego Martin Alonso Lopez%' OR
    PieFoto like '%Jesus Martinez Patiño%' OR
     
    Autor like '%Pachuca%' OR
    Autor like '%Tuzos%' OR
    Autor like '%bella airosa%' OR
    Autor like '%Oscar Perez%' OR
    Autor like '%Conejo Perez%' OR
    Autor like '%Aquivaldo Mosquera%' OR
    Autor like '%Omar Esparza%' OR
    Autor like '%John Stefan Medina%' OR
    Autor like '%Hirving Lozano%' OR
    Autor like '%Jonathan Urretaviscaya%' OR
    Autor like '%Ruben Botta%' OR
    Autor like '%Lucas Silva%' OR
    Autor like '%Ariel Nahuelpan%' OR
    Autor like '%Gustavo Ramirez%' OR
    Autor like '%Juan José Calero%' OR
    Autor like '%Franco Jara%' OR
    Autor like '%Rodolfo Pizarro%' OR
    Autor like '%Diego Martin Alonso Lopez%' OR
    Autor like '%Jesus Martinez Patiño%' 
)

   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 30: /*********** PACHUCA ESTADOS ************/
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
        Texto like '%Pachuca%' OR
    Texto like '%Tuzos%' OR
    Texto like '%bella airosa%' OR
    Texto like '%Oscar Perez%' OR
    Texto like '%Conejo Perez%' OR
    Texto like '%Aquivaldo Mosquera%' OR
    Texto like '%Omar Esparza%' OR
    Texto like '%John Stefan Medina%' OR
    Texto like '%Hirving Lozano%' OR
    Texto like '%Jonathan Urretaviscaya%' OR
    Texto like '%Ruben Botta%' OR
    Texto like '%Lucas Silva%' OR
    Texto like '%Ariel Nahuelpan%' OR
    Texto like '%Gustavo Ramirez%' OR
    Texto like '%Juan José Calero%' OR
    Texto like '%Franco Jara%' OR
    Texto like '%Rodolfo Pizarro%' OR
    Texto like '%Diego Martin Alonso Lopez%' OR
    Texto like '%Jesus Martinez Patiño%' OR
    
    Titulo like '%Pachuca%' OR
    Titulo like '%Tuzos%' OR
    Titulo like '%bella airosa%' OR
    Titulo like '%Oscar Perez%' OR
    Titulo like '%Conejo Perez%' OR
    Titulo like '%Aquivaldo Mosquera%' OR
    Titulo like '%Omar Esparza%' OR
    Titulo like '%John Stefan Medina%' OR
    Titulo like '%Hirving Lozano%' OR
    Titulo like '%Jonathan Urretaviscaya%' OR
    Titulo like '%Ruben Botta%' OR
    Titulo like '%Lucas Silva%' OR
    Titulo like '%Ariel Nahuelpan%' OR
    Titulo like '%Gustavo Ramirez%' OR
    Titulo like '%Juan José Calero%' OR
    Titulo like '%Franco Jara%' OR
    Titulo like '%Rodolfo Pizarro%' OR
    Titulo like '%Diego Martin Alonso Lopez%' OR
    Titulo like '%Jesus Martinez Patiño%' OR

    Encabezado like '%Pachuca%' OR
    Encabezado like '%Tuzos%' OR
    Encabezado like '%bella airosa%' OR
    Encabezado like '%Oscar Perez%' OR
    Encabezado like '%Conejo Perez%' OR
    Encabezado like '%Aquivaldo Mosquera%' OR
    Encabezado like '%Omar Esparza%' OR
    Encabezado like '%John Stefan Medina%' OR
    Encabezado like '%Hirving Lozano%' OR
    Encabezado like '%Jonathan Urretaviscaya%' OR
    Encabezado like '%Ruben Botta%' OR
    Encabezado like '%Lucas Silva%' OR
    Encabezado like '%Ariel Nahuelpan%' OR
    Encabezado like '%Gustavo Ramirez%' OR
    Encabezado like '%Juan José Calero%' OR
    Encabezado like '%Franco Jara%' OR
    Encabezado like '%Rodolfo Pizarro%' OR
    Encabezado like '%Diego Martin Alonso Lopez%' OR
    Encabezado like '%Jesus Martinez Patiño%' OR
      
    PieFoto like '%Pachuca%' OR
    PieFoto like '%Tuzos%' OR
    PieFoto like '%bella airosa%' OR
    PieFoto like '%Oscar Perez%' OR
    PieFoto like '%Conejo Perez%' OR
    PieFoto like '%Aquivaldo Mosquera%' OR
    PieFoto like '%Omar Esparza%' OR
    PieFoto like '%John Stefan Medina%' OR
    PieFoto like '%Hirving Lozano%' OR
    PieFoto like '%Jonathan Urretaviscaya%' OR
    PieFoto like '%Ruben Botta%' OR
    PieFoto like '%Lucas Silva%' OR
    PieFoto like '%Ariel Nahuelpan%' OR
    PieFoto like '%Gustavo Ramirez%' OR
    PieFoto like '%Juan José Calero%' OR
    PieFoto like '%Franco Jara%' OR
    PieFoto like '%Rodolfo Pizarro%' OR
    PieFoto like '%Diego Martin Alonso Lopez%' OR
    PieFoto like '%Jesus Martinez Patiño%' OR
     
    Autor like '%Pachuca%' OR
    Autor like '%Tuzos%' OR
    Autor like '%bella airosa%' OR
    Autor like '%Oscar Perez%' OR
    Autor like '%Conejo Perez%' OR
    Autor like '%Aquivaldo Mosquera%' OR
    Autor like '%Omar Esparza%' OR
    Autor like '%John Stefan Medina%' OR
    Autor like '%Hirving Lozano%' OR
    Autor like '%Jonathan Urretaviscaya%' OR
    Autor like '%Ruben Botta%' OR
    Autor like '%Lucas Silva%' OR
    Autor like '%Ariel Nahuelpan%' OR
    Autor like '%Gustavo Ramirez%' OR
    Autor like '%Juan José Calero%' OR
    Autor like '%Franco Jara%' OR
    Autor like '%Rodolfo Pizarro%' OR
    Autor like '%Diego Martin Alonso Lopez%' OR
    Autor like '%Jesus Martinez Patiño%' 
)

 GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** PACHUCA ESTADOS ************/

        case 31: /*********** PUEBLA DF ************/
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
    Texto like '%Puebla Futbol Club%' OR 
    Texto like '%Puebla FC%' OR 
    Texto like '%Camoteros%' OR 
    Texto like '%La Franja%' OR 
    Texto like '%Fabián Villaseñor%' OR 
    Texto like '%Cristian Campestrini%' OR 
    Texto like '%Austin Guerrero%' OR 
    Texto like '%Matías Alustiza%' OR 
    
    Titulo like '%Puebla Futbol Club%' OR
    Titulo like '%Puebla FC%' OR
    Titulo like '%Camoteros%' OR
    Titulo like '%La Franja%' OR
    Titulo like '%Fabián Villaseñor%' OR
    Titulo like '%Cristian Campestrini%' OR 
    Titulo like '%Austin Guerrero%' OR 
    Titulo like '%Matías Alustiza%' OR 

    Encabezado like '%Puebla Futbol Club%' OR
    Encabezado like '%Puebla FC%' OR
    Encabezado like '%Camoteros%' OR
    Encabezado like '%La Franja%' OR
    Encabezado like '%Fabián Villaseñor%' OR
    Encabezado like '%Cristian Campestrini%' OR 
    Encabezado like '%Austin Guerrero%' OR 
    Encabezado like '%Matías Alustiza%' OR 
      
    PieFoto like '%Puebla Futbol Club%' OR
    PieFoto like '%Puebla FC%' OR
    PieFoto like '%Camoteros%' OR
    PieFoto like '%La Franja%' OR
    PieFoto like '%Fabián Villaseñor%' OR
    PieFoto like '%Cristian Campestrini%' OR 
    PieFoto like '%Austin Guerrero%' OR 
    PieFoto like '%Matías Alustiza%' OR 
     
    Autor like '%Puebla Futbol Club%' OR
    Autor like '%Puebla FC%' OR
    Autor like '%Camoteros%' OR
    Autor like '%La Franja%' OR
    Autor like '%Fabián Villaseñor%' OR
    Autor like '%Cristian Campestrini%' OR 
    Autor like '%Austin Guerrero%' OR 
    Autor like '%Matías Alustiza%' 
)  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 32: /*********** PUEBLA ESTADOS ************/
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
    Texto like '%Puebla Futbol Club%' OR 
    Texto like '%Puebla FC%' OR 
    Texto like '%Camoteros%' OR 
    Texto like '%La Franja%' OR 
    Texto like '%Fabián Villaseñor%' OR 
    Texto like '%Cristian Campestrini%' OR 
    Texto like '%Austin Guerrero%' OR 
    Texto like '%Matías Alustiza%' OR 
    
    Titulo like '%Puebla Futbol Club%' OR
    Titulo like '%Puebla FC%' OR
    Titulo like '%Camoteros%' OR
    Titulo like '%La Franja%' OR
    Titulo like '%Fabián Villaseñor%' OR
    Titulo like '%Cristian Campestrini%' OR 
    Titulo like '%Austin Guerrero%' OR 
    Titulo like '%Matías Alustiza%' OR 

    Encabezado like '%Puebla Futbol Club%' OR
    Encabezado like '%Puebla FC%' OR
    Encabezado like '%Camoteros%' OR
    Encabezado like '%La Franja%' OR
    Encabezado like '%Fabián Villaseñor%' OR
    Encabezado like '%Cristian Campestrini%' OR 
    Encabezado like '%Austin Guerrero%' OR 
    Encabezado like '%Matías Alustiza%' OR 
      
    PieFoto like '%Puebla Futbol Club%' OR
    PieFoto like '%Puebla FC%' OR
    PieFoto like '%Camoteros%' OR
    PieFoto like '%La Franja%' OR
    PieFoto like '%Fabián Villaseñor%' OR
    PieFoto like '%Cristian Campestrini%' OR 
    PieFoto like '%Austin Guerrero%' OR 
    PieFoto like '%Matías Alustiza%' OR 
     
    Autor like '%Puebla Futbol Club%' OR
    Autor like '%Puebla FC%' OR
    Autor like '%Camoteros%' OR
    Autor like '%La Franja%' OR
    Autor like '%Fabián Villaseñor%' OR
    Autor like '%Cristian Campestrini%' OR 
    Autor like '%Austin Guerrero%' OR 
    Autor like '%Matías Alustiza%' 
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** PUEBLA ESTADOS ************/

        case 33: /*********** SAN LUIS DF ************/
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
    Texto like '%Carlos Bustos%' OR 
    Texto like '%Roberto Romero%' OR 
    Texto like '%Leonin Pineda%' OR 
    Texto like '%Uriel Álvarez%' OR 
    Texto like '%Atlético San Luis%' OR 
    Texto like '%Tuneros%' OR 
    Texto like '%Auriazules%' OR 
    Texto like '%Potosinos%' OR 
    Texto like '%El San Luis%' OR 
    
    Titulo like '%Carlos Bustos%' OR
    Titulo like '%Roberto Romero%' OR
    Titulo like '%Leonin Pineda%' OR
    Titulo like '%Uriel Álvarez%' OR
    Titulo like '%Atlético San Luis%' OR
    Titulo like '%Tuneros%' OR 
    Titulo like '%Auriazules%' OR 
    Titulo like '%Potosinos%' OR 
    Titulo like '%El San Luis%' OR 

    Encabezado like '%Carlos Bustos%' OR
    Encabezado like '%Roberto Romero%' OR
    Encabezado like '%Leonin Pineda%' OR
    Encabezado like '%Uriel Álvarez%' OR
    Encabezado like '%Atlético San Luis%' OR
    Encabezado like '%Tuneros%' OR 
    Encabezado like '%Auriazules%' OR 
    Encabezado like '%Potosinos%' OR 
    Encabezado like '%El San Luis%' OR 
      
    PieFoto like '%Carlos Bustos%' OR
    PieFoto like '%Roberto Romero%' OR
    PieFoto like '%Leonin Pineda%' OR
    PieFoto like '%Uriel Álvarez%' OR
    PieFoto like '%Atlético San Luis%' OR
    PieFoto like '%Tuneros%' OR 
    PieFoto like '%Auriazules%' OR 
    PieFoto like '%Potosinos%' OR 
    PieFoto like '%El San Luis%' OR 
     
    Autor like '%Carlos Bustos%' OR
    Autor like '%Roberto Romero%' OR
    Autor like '%Leonin Pineda%' OR
    Autor like '%Uriel Álvarez%' OR
    Autor like '%Atlético San Luis%' OR
    Autor like '%Tuneros%' OR 
    Autor like '%Auriazules%' OR 
    Autor like '%Potosinos%' OR 
    Autor like '%El San Luis%' 
)  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 34: /*********** SAN LUIS ESTADOS ************/
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
    Texto like '%Carlos Bustos%' OR 
    Texto like '%Roberto Romero%' OR 
    Texto like '%Leonin Pineda%' OR 
    Texto like '%Uriel Álvarez%' OR 
    Texto like '%Atlético San Luis%' OR 
    Texto like '%Tuneros%' OR 
    Texto like '%Auriazules%' OR 
    Texto like '%Potosinos%' OR 
    Texto like '%El San Luis%' OR 
    
    Titulo like '%Carlos Bustos%' OR
    Titulo like '%Roberto Romero%' OR
    Titulo like '%Leonin Pineda%' OR
    Titulo like '%Uriel Álvarez%' OR
    Titulo like '%Atlético San Luis%' OR
    Titulo like '%Tuneros%' OR 
    Titulo like '%Auriazules%' OR 
    Titulo like '%Potosinos%' OR 
    Titulo like '%El San Luis%' OR 

    Encabezado like '%Carlos Bustos%' OR
    Encabezado like '%Roberto Romero%' OR
    Encabezado like '%Leonin Pineda%' OR
    Encabezado like '%Uriel Álvarez%' OR
    Encabezado like '%Atlético San Luis%' OR
    Encabezado like '%Tuneros%' OR 
    Encabezado like '%Auriazules%' OR 
    Encabezado like '%Potosinos%' OR 
    Encabezado like '%El San Luis%' OR 
      
    PieFoto like '%Carlos Bustos%' OR
    PieFoto like '%Roberto Romero%' OR
    PieFoto like '%Leonin Pineda%' OR
    PieFoto like '%Uriel Álvarez%' OR
    PieFoto like '%Atlético San Luis%' OR
    PieFoto like '%Tuneros%' OR 
    PieFoto like '%Auriazules%' OR 
    PieFoto like '%Potosinos%' OR 
    PieFoto like '%El San Luis%' OR 
     
    Autor like '%Carlos Bustos%' OR
    Autor like '%Roberto Romero%' OR
    Autor like '%Leonin Pineda%' OR
    Autor like '%Uriel Álvarez%' OR
    Autor like '%Atlético San Luis%' OR
    Autor like '%Tuneros%' OR 
    Autor like '%Auriazules%' OR 
    Autor like '%Potosinos%' OR 
    Autor like '%El San Luis%' 
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** SAN LUIS ESTADOS ************/

        case 35: /*********** SANTOS DF ************/
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
    Texto like '%Santos%' OR 
    Texto like '%Santos Laguna%' OR 
    Texto like '%Estadio Santos Modelo%' OR 
    Texto like '%Verdiblancos%' OR 
    Texto like '%Laguneros%' OR 
    Texto like '%Albiverdes%' OR 
    Texto like '%Alejandro Irarragorri%' OR 
    Texto like '%Luis Zubeldia%' OR 
    Texto like '%Agustin Marchesin%' OR 
    Texto like '%Jorge Villafaña%' OR 
    Texto like '%Bryan Rabello%' OR 
    Texto like '%Andres Renteria%' OR 
    Texto like '%Djaniny Tavares%' OR 
    Texto like '%Javier Orozco%' OR 
    Texto like '%Martin Bravo%' OR 
    
    Titulo like '%Santos%' OR 
    Titulo like '%Santos Laguna%' OR 
    Titulo like '%Estadio Santos Modelo%' OR 
    Titulo like '%Verdiblancos%' OR 
    Titulo like '%Laguneros%' OR 
    Titulo like '%Albiverdes%' OR 
    Titulo like '%Alejandro Irarragorri%' OR 
    Titulo like '%Luis Zubeldia%' OR 
    Titulo like '%Agustin Marchesin%' OR 
    Titulo like '%Jorge Villafaña%' OR 
    Titulo like '%Bryan Rabello%' OR 
    Titulo like '%Andres Renteria%' OR 
    Titulo like '%Djaniny Tavares%' OR 
    Titulo like '%Javier Orozco%' OR 
    Titulo like '%Martin Bravo%' OR 

    Encabezado like '%Santos%' OR 
    Encabezado like '%Santos Laguna%' OR 
    Encabezado like '%Estadio Santos Modelo%' OR 
    Encabezado like '%Verdiblancos%' OR 
    Encabezado like '%Laguneros%' OR 
    Encabezado like '%Albiverdes%' OR 
    Encabezado like '%Alejandro Irarragorri%' OR 
    Encabezado like '%Luis Zubeldia%' OR 
    Encabezado like '%Agustin Marchesin%' OR 
    Encabezado like '%Jorge Villafaña%' OR 
    Encabezado like '%Bryan Rabello%' OR 
    Encabezado like '%Andres Renteria%' OR 
    Encabezado like '%Djaniny Tavares%' OR 
    Encabezado like '%Javier Orozco%' OR 
    Encabezado like '%Martin Bravo%' OR 

    PieFoto like '%Santos%' OR 
    PieFoto like '%Santos Laguna%' OR 
    PieFoto like '%Estadio Santos Modelo%' OR 
    PieFoto like '%Verdiblancos%' OR 
    PieFoto like '%Laguneros%' OR 
    PieFoto like '%Albiverdes%' OR 
    PieFoto like '%Alejandro Irarragorri%' OR 
    PieFoto like '%Luis Zubeldia%' OR 
    PieFoto like '%Agustin Marchesin%' OR 
    PieFoto like '%Jorge Villafaña%' OR 
    PieFoto like '%Bryan Rabello%' OR 
    PieFoto like '%Andres Renteria%' OR 
    PieFoto like '%Djaniny Tavares%' OR 
    PieFoto like '%Javier Orozco%' OR 
    PieFoto like '%Martin Bravo%' OR 

    Autor like '%Santos%' OR 
    Autor like '%Santos Laguna%' OR 
    Autor like '%Estadio Santos Modelo%' OR 
    Autor like '%Verdiblancos%' OR 
    Autor like '%Laguneros%' OR 
    Autor like '%Albiverdes%' OR 
    Autor like '%Alejandro Irarragorri%' OR 
    Autor like '%Luis Zubeldia%' OR 
    Autor like '%Agustin Marchesin%' OR 
    Autor like '%Jorge Villafaña%' OR 
    Autor like '%Bryan Rabello%' OR 
    Autor like '%Andres Renteria%' OR 
    Autor like '%Djaniny Tavares%' OR 
    Autor like '%Javier Orozco%' OR 
    Autor like '%Martin Bravo%' 

) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 36: /*********** SANTOS ESTADOS ************/
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
    Texto like '%Santos%' OR 
    Texto like '%Santos Laguna%' OR 
    Texto like '%Estadio Santos Modelo%' OR 
    Texto like '%Verdiblancos%' OR 
    Texto like '%Laguneros%' OR 
    Texto like '%Albiverdes%' OR 
    Texto like '%Alejandro Irarragorri%' OR 
    Texto like '%Luis Zubeldia%' OR 
    Texto like '%Agustin Marchesin%' OR 
    Texto like '%Jorge Villafaña%' OR 
    Texto like '%Bryan Rabello%' OR 
    Texto like '%Andres Renteria%' OR 
    Texto like '%Djaniny Tavares%' OR 
    Texto like '%Javier Orozco%' OR 
    Texto like '%Martin Bravo%' OR 
    
    Titulo like '%Santos%' OR 
    Titulo like '%Santos Laguna%' OR 
    Titulo like '%Estadio Santos Modelo%' OR 
    Titulo like '%Verdiblancos%' OR 
    Titulo like '%Laguneros%' OR 
    Titulo like '%Albiverdes%' OR 
    Titulo like '%Alejandro Irarragorri%' OR 
    Titulo like '%Luis Zubeldia%' OR 
    Titulo like '%Agustin Marchesin%' OR 
    Titulo like '%Jorge Villafaña%' OR 
    Titulo like '%Bryan Rabello%' OR 
    Titulo like '%Andres Renteria%' OR 
    Titulo like '%Djaniny Tavares%' OR 
    Titulo like '%Javier Orozco%' OR 
    Titulo like '%Martin Bravo%' OR 

    Encabezado like '%Santos%' OR 
    Encabezado like '%Santos Laguna%' OR 
    Encabezado like '%Estadio Santos Modelo%' OR 
    Encabezado like '%Verdiblancos%' OR 
    Encabezado like '%Laguneros%' OR 
    Encabezado like '%Albiverdes%' OR 
    Encabezado like '%Alejandro Irarragorri%' OR 
    Encabezado like '%Luis Zubeldia%' OR 
    Encabezado like '%Agustin Marchesin%' OR 
    Encabezado like '%Jorge Villafaña%' OR 
    Encabezado like '%Bryan Rabello%' OR 
    Encabezado like '%Andres Renteria%' OR 
    Encabezado like '%Djaniny Tavares%' OR 
    Encabezado like '%Javier Orozco%' OR 
    Encabezado like '%Martin Bravo%' OR 

    PieFoto like '%Santos%' OR 
    PieFoto like '%Santos Laguna%' OR 
    PieFoto like '%Estadio Santos Modelo%' OR 
    PieFoto like '%Verdiblancos%' OR 
    PieFoto like '%Laguneros%' OR 
    PieFoto like '%Albiverdes%' OR 
    PieFoto like '%Alejandro Irarragorri%' OR 
    PieFoto like '%Luis Zubeldia%' OR 
    PieFoto like '%Agustin Marchesin%' OR 
    PieFoto like '%Jorge Villafaña%' OR 
    PieFoto like '%Bryan Rabello%' OR 
    PieFoto like '%Andres Renteria%' OR 
    PieFoto like '%Djaniny Tavares%' OR 
    PieFoto like '%Javier Orozco%' OR 
    PieFoto like '%Martin Bravo%' OR 

    Autor like '%Santos%' OR 
    Autor like '%Santos Laguna%' OR 
    Autor like '%Estadio Santos Modelo%' OR 
    Autor like '%Verdiblancos%' OR 
    Autor like '%Laguneros%' OR 
    Autor like '%Albiverdes%' OR 
    Autor like '%Alejandro Irarragorri%' OR 
    Autor like '%Luis Zubeldia%' OR 
    Autor like '%Agustin Marchesin%' OR 
    Autor like '%Jorge Villafaña%' OR 
    Autor like '%Bryan Rabello%' OR 
    Autor like '%Andres Renteria%' OR 
    Autor like '%Djaniny Tavares%' OR 
    Autor like '%Javier Orozco%' OR 
    Autor like '%Martin Bravo%' 

) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** SANTOS ESTADOS ************/

        case 37: /*********** TIGRES DF ************/
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
    Texto like '%Tigres%' OR
    Texto like '%Ferretti%' OR
    Texto like '%Tuca %' OR
    Texto like '%Gignac%' OR
    Texto like '%jurgen damm%' OR
    
    Titulo like '%Tigres%' OR
    Titulo like '%Ferretti%' OR
    Titulo like '%Tuca %' OR
    Titulo like '%Gignac%' OR
    Titulo like '%jurgen damm%' OR

    Encabezado like '%Tigres%' OR
    Encabezado like '%Ferretti%' OR
    Encabezado like '%Tuca %' OR
    Encabezado like '%Gignac%' OR
    Encabezado like '%jurgen damm%' OR
      
    PieFoto like '%Tigres%' OR
    PieFoto like '%Ferretti%' OR
    PieFoto like '%Tuca %' OR
    PieFoto like '%Gignac%' OR
    PieFoto like '%jurgen damm%'
)   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 38: /*********** TIGRES ESTADOS ************/
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
    Texto like '%Tigres%' OR
    Texto like '%Ferretti%' OR
    Texto like '%Tuca %' OR
    Texto like '%Gignac%' OR
    Texto like '%jurgen damm%' OR
    
    Titulo like '%Tigres%' OR
    Titulo like '%Ferretti%' OR
    Titulo like '%Tuca %' OR
    Titulo like '%Gignac%' OR
    Titulo like '%jurgen damm%' OR

    Encabezado like '%Tigres%' OR
    Encabezado like '%Ferretti%' OR
    Encabezado like '%Tuca %' OR
    Encabezado like '%Gignac%' OR
    Encabezado like '%jurgen damm%' OR
      
    PieFoto like '%Tigres%' OR
    PieFoto like '%Ferretti%' OR
    PieFoto like '%Tuca %' OR
    PieFoto like '%Gignac%' OR
    PieFoto like '%jurgen damm%'
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** TIGRES ESTADOS ************/

        case 39: /*********** TIJUANA DF ************/
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
    Texto like '%Tijuana%' OR
    Texto like '%Xolos%' OR
    Texto like '%Xoloitzcuintles%' OR
    Texto like '%Federico Vilar%' OR
    Texto like '%Javier Gandolfi%' OR
    Texto like '%Leiton Jimenez%' OR
    Texto like '%John Requejo%' OR
    Texto like '%Vitor Bomes Pareira%' OR  
    Texto like '%Fernando Arce%' OR
    Texto like '%Henri Martin%' OR
    Texto like '%Paul Arriola%' OR
    Texto like '%Dayro Moreno%' OR
    Texto like '%Gabirel Hauche%' OR
    Texto like '%Paul Arriola%' OR
    Texto like '%Miguel Herrera%' OR
    Texto like '%Piojo Herrera%' OR
    Texto like '%El Piojo%' OR
    Texto like '%Jorge Hank Rhon' OR

    Titulo like '%Tijuana%' OR
    Titulo like '%Xolos%' OR
    Titulo like '%Xoloitzcuintles%' OR
    Titulo like '%Federico Vilar%' OR
    Titulo like '%Javier Gandolfi%' OR
    Titulo like '%Leiton Jimenez%' OR
    Titulo like '%John Requejo%' OR
    Titulo like '%Vitor Bomes Pareira%' OR  
    Titulo like '%Fernando Arce%' OR
    Titulo like '%Henri Martin%' OR
    Titulo like '%Paul Arriola%' OR
    Titulo like '%Dayro Moreno%' OR
    Titulo like '%Gabirel Hauche%' OR
    Titulo like '%Paul Arriola%' OR
    Titulo like '%Miguel Herrera%' OR
    Titulo like '%Piojo Herrera%' OR
    Titulo like '%El Piojo%' OR
    Titulo like '%Jorge Hank Rhon' OR

    Encabezado like '%Tijuana%' OR
    Encabezado like '%Xolos%' OR
    Encabezado like '%Xoloitzcuintles%' OR
    Encabezado like '%Federico Vilar%' OR
    Encabezado like '%Javier Gandolfi%' OR
    Encabezado like '%Leiton Jimenez%' OR
    Encabezado like '%John Requejo%' OR
    Encabezado like '%Vitor Bomes Pareira%' OR  
    Encabezado like '%Fernando Arce%' OR
    Encabezado like '%Henri Martin%' OR
    Encabezado like '%Paul Arriola%' OR
    Encabezado like '%Dayro Moreno%' OR
    Encabezado like '%Gabirel Hauche%' OR
    Encabezado like '%Paul Arriola%' OR
    Encabezado like '%Miguel Herrera%' OR
    Encabezado like '%Piojo Herrera%' OR
    Encabezado like '%El Piojo%' OR
    Encabezado like '%Jorge Hank Rhon' OR
    
    PieFoto like '%Tijuana%' OR
    PieFoto like '%Xolos%' OR
    PieFoto like '%Xoloitzcuintles%' OR
    PieFoto like '%Federico Vilar%' OR
    PieFoto like '%Javier Gandolfi%' OR
    PieFoto like '%Leiton Jimenez%' OR
    PieFoto like '%John Requejo%' OR
    PieFoto like '%Vitor Bomes Pareira%' OR  
    PieFoto like '%Fernando Arce%' OR
    PieFoto like '%Henri Martin%' OR
    PieFoto like '%Paul Arriola%' OR
    PieFoto like '%Dayro Moreno%' OR
    PieFoto like '%Gabirel Hauche%' OR
    PieFoto like '%Paul Arriola%' OR
    PieFoto like '%Miguel Herrera%' OR
    PieFoto like '%Piojo Herrera%' OR
    PieFoto like '%El Piojo%' OR
    PieFoto like '%Jorge Hank Rhon' OR
    
    Autor like '%Tijuana%' OR
    Autor like '%Xolos%' OR
    Autor like '%Xoloitzcuintles%' OR
    Autor like '%Federico Vilar%' OR
    Autor like '%Javier Gandolfi%' OR
    Autor like '%Leiton Jimenez%' OR
    Autor like '%John Requejo%' OR
    Autor like '%Vitor Bomes Pareira%' OR  
    Autor like '%Fernando Arce%' OR
    Autor like '%Henri Martin%' OR
    Autor like '%Paul Arriola%' OR
    Autor like '%Dayro Moreno%' OR
    Autor like '%Gabirel Hauche%' OR
    Autor like '%Paul Arriola%' OR
    Autor like '%Miguel Herrera%' OR
    Autor like '%Piojo Herrera%' OR
    Autor like '%El Piojo%' OR
    Autor like '%Jorge Hank Rhon' 
) AND
( Texto like '%Futbol%' 
)  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 40: /*********** TIJUANA ESTADOS ************/
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
    Texto like '%Tijuana%' OR
    Texto like '%Xolos%' OR
    Texto like '%Xoloitzcuintles%' OR
    Texto like '%Federico Vilar%' OR
    Texto like '%Javier Gandolfi%' OR
    Texto like '%Leiton Jimenez%' OR
    Texto like '%John Requejo%' OR
    Texto like '%Vitor Bomes Pareira%' OR  
    Texto like '%Fernando Arce%' OR
    Texto like '%Henri Martin%' OR
    Texto like '%Paul Arriola%' OR
    Texto like '%Dayro Moreno%' OR
    Texto like '%Gabirel Hauche%' OR
    Texto like '%Paul Arriola%' OR
    Texto like '%Miguel Herrera%' OR
    Texto like '%Piojo Herrera%' OR
    Texto like '%El Piojo%' OR
    Texto like '%Jorge Hank Rhon' OR

    Titulo like '%Tijuana%' OR
    Titulo like '%Xolos%' OR
    Titulo like '%Xoloitzcuintles%' OR
    Titulo like '%Federico Vilar%' OR
    Titulo like '%Javier Gandolfi%' OR
    Titulo like '%Leiton Jimenez%' OR
    Titulo like '%John Requejo%' OR
    Titulo like '%Vitor Bomes Pareira%' OR  
    Titulo like '%Fernando Arce%' OR
    Titulo like '%Henri Martin%' OR
    Titulo like '%Paul Arriola%' OR
    Titulo like '%Dayro Moreno%' OR
    Titulo like '%Gabirel Hauche%' OR
    Titulo like '%Paul Arriola%' OR
    Titulo like '%Miguel Herrera%' OR
    Titulo like '%Piojo Herrera%' OR
    Titulo like '%El Piojo%' OR
    Titulo like '%Jorge Hank Rhon' OR

    Encabezado like '%Tijuana%' OR
    Encabezado like '%Xolos%' OR
    Encabezado like '%Xoloitzcuintles%' OR
    Encabezado like '%Federico Vilar%' OR
    Encabezado like '%Javier Gandolfi%' OR
    Encabezado like '%Leiton Jimenez%' OR
    Encabezado like '%John Requejo%' OR
    Encabezado like '%Vitor Bomes Pareira%' OR  
    Encabezado like '%Fernando Arce%' OR
    Encabezado like '%Henri Martin%' OR
    Encabezado like '%Paul Arriola%' OR
    Encabezado like '%Dayro Moreno%' OR
    Encabezado like '%Gabirel Hauche%' OR
    Encabezado like '%Paul Arriola%' OR
    Encabezado like '%Miguel Herrera%' OR
    Encabezado like '%Piojo Herrera%' OR
    Encabezado like '%El Piojo%' OR
    Encabezado like '%Jorge Hank Rhon' OR
    
    PieFoto like '%Tijuana%' OR
    PieFoto like '%Xolos%' OR
    PieFoto like '%Xoloitzcuintles%' OR
    PieFoto like '%Federico Vilar%' OR
    PieFoto like '%Javier Gandolfi%' OR
    PieFoto like '%Leiton Jimenez%' OR
    PieFoto like '%John Requejo%' OR
    PieFoto like '%Vitor Bomes Pareira%' OR  
    PieFoto like '%Fernando Arce%' OR
    PieFoto like '%Henri Martin%' OR
    PieFoto like '%Paul Arriola%' OR
    PieFoto like '%Dayro Moreno%' OR
    PieFoto like '%Gabirel Hauche%' OR
    PieFoto like '%Paul Arriola%' OR
    PieFoto like '%Miguel Herrera%' OR
    PieFoto like '%Piojo Herrera%' OR
    PieFoto like '%El Piojo%' OR
    PieFoto like '%Jorge Hank Rhon' OR
    
    Autor like '%Tijuana%' OR
    Autor like '%Xolos%' OR
    Autor like '%Xoloitzcuintles%' OR
    Autor like '%Federico Vilar%' OR
    Autor like '%Javier Gandolfi%' OR
    Autor like '%Leiton Jimenez%' OR
    Autor like '%John Requejo%' OR
    Autor like '%Vitor Bomes Pareira%' OR  
    Autor like '%Fernando Arce%' OR
    Autor like '%Henri Martin%' OR
    Autor like '%Paul Arriola%' OR
    Autor like '%Dayro Moreno%' OR
    Autor like '%Gabirel Hauche%' OR
    Autor like '%Paul Arriola%' OR
    Autor like '%Miguel Herrera%' OR
    Autor like '%Piojo Herrera%' OR
    Autor like '%El Piojo%' OR
    Autor like '%Jorge Hank Rhon' 
) AND
( Texto like '%Futbol%' 
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** TIJUANA ESTADOS ************/

        case 41: /*********** TOLUCA DF ************/
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
Texto like '%Toluca%' OR
    Texto like '%chorizeros%' OR
    Texto like '%diablos rojos%' OR
    Texto like '%Club Deportivo Toluca%' OR
    Texto like '%Nemesio Diez%' OR
    Texto like '%Alfredo Talavera%' OR
    Texto like '%Liborio Sanchez%' OR
    Texto like '%Aaron Galindo%' OR
    Texto like '%Paulo Da Silva%' OR
    Texto like '%Lucas Lobos%' OR
    Texto like '%Dario Bottinelli%' OR
    Texto like '%Richard Ortiz%' OR
    Texto like '%Christian Cueva%' OR
    Texto like '%Nicolas Saucedo%' OR
    Texto like '%Christian Cueva%' OR
    Texto like '%Fernando Uribe%' OR
    Texto like '%Enrique Triverio%' OR
    Texto like '%Omar Arellano%' OR
    Texto like '%Pina Arellano%' OR
    Texto like '%Jose Cardozo%' OR
    Texto like '%Jose Saturnino Cardozo%' OR
    Texto like '%Diablo Cardozo%' OR
    Texto like '%Jaime Leon del Toro%' OR
    Texto like '%diablos%' OR
        
    Titulo like '%Toluca%' OR
    Titulo like '%chorizeros%' OR
    Titulo like '%diablos rojos%' OR
    Titulo like '%Club Deportivo Toluca%' OR
    Titulo like '%Nemesio Diez%' OR
    Titulo like '%Alfredo Talavera%' OR
    Titulo like '%Liborio Sanchez%' OR
    Titulo like '%Aaron Galindo%' OR
    Titulo like '%Paulo Da Silva%' OR
    Titulo like '%Lucas Lobos%' OR
    Titulo like '%Dario Bottinelli%' OR
    Titulo like '%Richard Ortiz%' OR
    Titulo like '%Christian Cueva%' OR
    Titulo like '%Nicolas Saucedo%' OR
    Titulo like '%Christian Cueva%' OR
    Titulo like '%Fernando Uribe%' OR
    Titulo like '%Enrique Triverio%' OR
    Titulo like '%Omar Arellano%' OR
    Titulo like '%Pina Arellano%' OR
    Titulo like '%Jose Cardozo%' OR
    Titulo like '%Jose Saturnino Cardozo%' OR
    Titulo like '%Diablo Cardozo%' OR
    Titulo like '%Jaime Leon del Toro%' OR
    Titulo like '%diablos%' OR

    Encabezado like '%Toluca%' OR
    Encabezado like '%chorizeros%' OR
    Encabezado like '%diablos rojos%' OR
    Encabezado like '%Club Deportivo Toluca%' OR
    Encabezado like '%Nemesio Diez%' OR
    Encabezado like '%Alfredo Talavera%' OR
    Encabezado like '%Liborio Sanchez%' OR
    Encabezado like '%Aaron Galindo%' OR
    Encabezado like '%Paulo Da Silva%' OR
    Encabezado like '%Lucas Lobos%' OR
    Encabezado like '%Dario Bottinelli%' OR
    Encabezado like '%Richard Ortiz%' OR
    Encabezado like '%Christian Cueva%' OR
    Encabezado like '%Nicolas Saucedo%' OR
    Encabezado like '%Christian Cueva%' OR
    Encabezado like '%Fernando Uribe%' OR
    Encabezado like '%Enrique Triverio%' OR
    Encabezado like '%Omar Arellano%' OR
    Encabezado like '%Pina Arellano%' OR
    Encabezado like '%Jose Cardozo%' OR
    Encabezado like '%Jose Saturnino Cardozo%' OR
    Encabezado like '%Diablo Cardozo%' OR
    Encabezado like '%Jaime Leon del Toro%' OR
    Encabezado like '%diablos%' OR
      
    PieFoto like '%Toluca%' OR
    PieFoto like '%chorizeros%' OR
    PieFoto like '%diablos rojos%' OR
    PieFoto like '%Club Deportivo Toluca%' OR
    PieFoto like '%Nemesio Diez%' OR
    PieFoto like '%Alfredo Talavera%' OR
    PieFoto like '%Liborio Sanchez%' OR
    PieFoto like '%Aaron Galindo%' OR
    PieFoto like '%Paulo Da Silva%' OR
    PieFoto like '%Lucas Lobos%' OR
    PieFoto like '%Dario Bottinelli%' OR
    PieFoto like '%Richard Ortiz%' OR
    PieFoto like '%Christian Cueva%' OR
    PieFoto like '%Nicolas Saucedo%' OR
    PieFoto like '%Christian Cueva%' OR
    PieFoto like '%Fernando Uribe%' OR
    PieFoto like '%Enrique Triverio%' OR
    PieFoto like '%Omar Arellano%' OR
    PieFoto like '%Pina Arellano%' OR
    PieFoto like '%Jose Cardozo%' OR
    PieFoto like '%Jose Saturnino Cardozo%' OR
    PieFoto like '%Diablo Cardozo%' OR
    PieFoto like '%Jaime Leon del Toro%' OR
    PieFoto like '%diablos%' OR
     
    Autor like '%Toluca%' OR
    Autor like '%chorizeros%' OR
    Autor like '%diablos rojos%' OR
    Autor like '%Club Deportivo Toluca%' OR
    Autor like '%Nemesio Diez%' OR
    Autor like '%Alfredo Talavera%' OR
    Autor like '%Liborio Sanchez%' OR
    Autor like '%Aaron Galindo%' OR
    Autor like '%Paulo Da Silva%' OR
    Autor like '%Lucas Lobos%' OR
    Autor like '%Dario Bottinelli%' OR
    Autor like '%Richard Ortiz%' OR
    Autor like '%Christian Cueva%' OR
    Autor like '%Nicolas Saucedo%' OR
    Autor like '%Christian Cueva%' OR
    Autor like '%Fernando Uribe%' OR
    Autor like '%Enrique Triverio%' OR
    Autor like '%Omar Arellano%' OR
    Autor like '%Pina Arellano%' OR
    Autor like '%Jose Cardozo%' OR
    Autor like '%Jose Saturnino Cardozo%' OR
    Autor like '%Diablo Cardozo%' OR
    Autor like '%Jaime Leon del Toro%' OR
    Autor like '%diablos%'
) AND
( Texto like '%Futbol%'  
)
  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 42: /*********** TOLUCA ESTADOS ************/
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
Texto like '%Toluca%' OR
    Texto like '%chorizeros%' OR
    Texto like '%diablos rojos%' OR
    Texto like '%Club Deportivo Toluca%' OR
    Texto like '%Nemesio Diez%' OR
    Texto like '%Alfredo Talavera%' OR
    Texto like '%Liborio Sanchez%' OR
    Texto like '%Aaron Galindo%' OR
    Texto like '%Paulo Da Silva%' OR
    Texto like '%Lucas Lobos%' OR
    Texto like '%Dario Bottinelli%' OR
    Texto like '%Richard Ortiz%' OR
    Texto like '%Christian Cueva%' OR
    Texto like '%Nicolas Saucedo%' OR
    Texto like '%Christian Cueva%' OR
    Texto like '%Fernando Uribe%' OR
    Texto like '%Enrique Triverio%' OR
    Texto like '%Omar Arellano%' OR
    Texto like '%Pina Arellano%' OR
    Texto like '%Jose Cardozo%' OR
    Texto like '%Jose Saturnino Cardozo%' OR
    Texto like '%Diablo Cardozo%' OR
    Texto like '%Jaime Leon del Toro%' OR
    Texto like '%diablos%' OR
        
    Titulo like '%Toluca%' OR
    Titulo like '%chorizeros%' OR
    Titulo like '%diablos rojos%' OR
    Titulo like '%Club Deportivo Toluca%' OR
    Titulo like '%Nemesio Diez%' OR
    Titulo like '%Alfredo Talavera%' OR
    Titulo like '%Liborio Sanchez%' OR
    Titulo like '%Aaron Galindo%' OR
    Titulo like '%Paulo Da Silva%' OR
    Titulo like '%Lucas Lobos%' OR
    Titulo like '%Dario Bottinelli%' OR
    Titulo like '%Richard Ortiz%' OR
    Titulo like '%Christian Cueva%' OR
    Titulo like '%Nicolas Saucedo%' OR
    Titulo like '%Christian Cueva%' OR
    Titulo like '%Fernando Uribe%' OR
    Titulo like '%Enrique Triverio%' OR
    Titulo like '%Omar Arellano%' OR
    Titulo like '%Pina Arellano%' OR
    Titulo like '%Jose Cardozo%' OR
    Titulo like '%Jose Saturnino Cardozo%' OR
    Titulo like '%Diablo Cardozo%' OR
    Titulo like '%Jaime Leon del Toro%' OR
    Titulo like '%diablos%' OR

    Encabezado like '%Toluca%' OR
    Encabezado like '%chorizeros%' OR
    Encabezado like '%diablos rojos%' OR
    Encabezado like '%Club Deportivo Toluca%' OR
    Encabezado like '%Nemesio Diez%' OR
    Encabezado like '%Alfredo Talavera%' OR
    Encabezado like '%Liborio Sanchez%' OR
    Encabezado like '%Aaron Galindo%' OR
    Encabezado like '%Paulo Da Silva%' OR
    Encabezado like '%Lucas Lobos%' OR
    Encabezado like '%Dario Bottinelli%' OR
    Encabezado like '%Richard Ortiz%' OR
    Encabezado like '%Christian Cueva%' OR
    Encabezado like '%Nicolas Saucedo%' OR
    Encabezado like '%Christian Cueva%' OR
    Encabezado like '%Fernando Uribe%' OR
    Encabezado like '%Enrique Triverio%' OR
    Encabezado like '%Omar Arellano%' OR
    Encabezado like '%Pina Arellano%' OR
    Encabezado like '%Jose Cardozo%' OR
    Encabezado like '%Jose Saturnino Cardozo%' OR
    Encabezado like '%Diablo Cardozo%' OR
    Encabezado like '%Jaime Leon del Toro%' OR
    Encabezado like '%diablos%' OR
      
    PieFoto like '%Toluca%' OR
    PieFoto like '%chorizeros%' OR
    PieFoto like '%diablos rojos%' OR
    PieFoto like '%Club Deportivo Toluca%' OR
    PieFoto like '%Nemesio Diez%' OR
    PieFoto like '%Alfredo Talavera%' OR
    PieFoto like '%Liborio Sanchez%' OR
    PieFoto like '%Aaron Galindo%' OR
    PieFoto like '%Paulo Da Silva%' OR
    PieFoto like '%Lucas Lobos%' OR
    PieFoto like '%Dario Bottinelli%' OR
    PieFoto like '%Richard Ortiz%' OR
    PieFoto like '%Christian Cueva%' OR
    PieFoto like '%Nicolas Saucedo%' OR
    PieFoto like '%Christian Cueva%' OR
    PieFoto like '%Fernando Uribe%' OR
    PieFoto like '%Enrique Triverio%' OR
    PieFoto like '%Omar Arellano%' OR
    PieFoto like '%Pina Arellano%' OR
    PieFoto like '%Jose Cardozo%' OR
    PieFoto like '%Jose Saturnino Cardozo%' OR
    PieFoto like '%Diablo Cardozo%' OR
    PieFoto like '%Jaime Leon del Toro%' OR
    PieFoto like '%diablos%' OR
     
    Autor like '%Toluca%' OR
    Autor like '%chorizeros%' OR
    Autor like '%diablos rojos%' OR
    Autor like '%Club Deportivo Toluca%' OR
    Autor like '%Nemesio Diez%' OR
    Autor like '%Alfredo Talavera%' OR
    Autor like '%Liborio Sanchez%' OR
    Autor like '%Aaron Galindo%' OR
    Autor like '%Paulo Da Silva%' OR
    Autor like '%Lucas Lobos%' OR
    Autor like '%Dario Bottinelli%' OR
    Autor like '%Richard Ortiz%' OR
    Autor like '%Christian Cueva%' OR
    Autor like '%Nicolas Saucedo%' OR
    Autor like '%Christian Cueva%' OR
    Autor like '%Fernando Uribe%' OR
    Autor like '%Enrique Triverio%' OR
    Autor like '%Omar Arellano%' OR
    Autor like '%Pina Arellano%' OR
    Autor like '%Jose Cardozo%' OR
    Autor like '%Jose Saturnino Cardozo%' OR
    Autor like '%Diablo Cardozo%' OR
    Autor like '%Jaime Leon del Toro%' OR
    Autor like '%diablos%'
) AND
( Texto like '%Futbol%'  
)
 GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** TOLUCA ESTADOS ************/

        case 43: /*********** UNAM DF ************/
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
     Texto like '%UNAM%' OR 
    Texto like '%Pumas%' OR 
    Texto like '%Dario Veron%' OR 
    Texto like '%Guillermo Vazquez%' OR 
    Texto like '%Fidel Martinez%' OR 
    Texto like '%Mathias Vidangossy%' OR 
    Texto like '%Alejandro Palacios%' OR
    Texto like '%Picolin Palacios%' OR
    Texto like '%Memo Vazquez%' OR
    Texto like '%Eduardo Herrera Aguirre%' OR 
    Texto like '%Luis Quiñones%' OR
    Texto like '%Victor Mahbub%' OR
    Texto like '%Daniel Ludueña%' OR
    Texto like '%Hachita Ludueña%' OR
    Texto like '%Club Universidad%' OR
    Texto like '%Lalo Herrera%' OR    
    
    Titulo like '%UNAM%' OR
    Titulo like '%Pumas%' OR
    Titulo  like '%Dario Veron%' OR 
    Titulo like '%Guillermo Vazquez%' OR 
    Titulo like '%Fidel Martinez%' OR 
    Titulo like '%Mathias Vidangossy%' OR 
    Titulo like '%Alejandro Palacios%' OR
    Titulo like '%Picolin Palacios%' OR
    Titulo like '%Memo Vazquez%' OR
    Titulo like '%Eduardo Herrera Aguirre%' OR 
    Titulo like '%Luis Quiñones%' OR
    Titulo  like '%Victor Mahbub%' OR
    Titulo  like '%Daniel Ludueña%' OR
    Titulo  like '%Hachita Ludueña%' OR
    Titulo  like '%Club Universidad%' OR
    Titulo  like '%Lalo Herrera%' OR   

    Encabezado like '%UNAM%' OR
    Encabezado like '%Pumas%' OR
    Encabezado like '%Dario Veron%' OR 
    Encabezado like '%Guillermo Vazquez%' OR 
    Encabezado like '%Fidel Martinez%' OR 
    Encabezado like '%Mathias Vidangossy%' OR 
    Encabezado like '%Alejandro Palacios%' OR
    Encabezado like '%Picolin Palacios%' OR
    Encabezado like '%Memo Vazquez%' OR
    Encabezado like '%Eduardo Herrera Aguirre%' OR 
    Encabezado like '%Luis Quiñones%' OR
    Encabezado like '%Victor Mahbub%' OR
    Encabezado like '%Daniel Ludueña%' OR
    Encabezado like '%Hachita Ludueña%' OR
    Encabezado like '%Club Universidad%' OR
    Encabezado like '%Lalo Herrera%' OR    
      
    PieFoto like '%UNAM%' OR
    PieFoto like '%Pumas%' OR 
    PieFoto like '%Dario Veron%' OR 
    PieFoto  like '%Guillermo Vazquez%' OR 
    PieFoto  like '%Fidel Martinez%' OR 
    PieFoto  like '%Mathias Vidangossy%' OR 
    PieFoto  like '%Alejandro Palacios%' OR
    PieFoto  like '%Picolin Palacios%' OR
    PieFoto  like '%Memo Vazquez%' OR
    PieFoto  like '%Eduardo Herrera Aguirre%' OR 
    PieFoto  like '%Luis Quiñones%' OR
    PieFoto  like '%Victor Mahbub%' OR
    PieFoto  like '%Daniel Ludueña%' OR
    PieFoto  like '%Hachita Ludueña%' OR
    PieFoto  like '%Club Universidad%' OR
    PieFoto  like '%Lalo Herrera%' OR   
     
    Autor like '%UNAM%' OR
    Autor like '%Pumas%'  OR
    Autor like '%Dario Veron%' OR 
    Autor like '%Guillermo Vazquez%' OR 
    Autor like '%Fidel Martinez%' OR 
    Autor like '%Mathias Vidangossy%' OR 
    Autor like '%Alejandro Palacios%' OR
    Autor like '%Picolin Palacios%' OR
    Autor like '%Memo Vazquez%' OR
    Autor like '%Eduardo Herrera Aguirre%' OR 
    Autor like '%Luis Quiñones%' OR
    Autor like '%Victor Mahbub%' OR
    Autor like '%Daniel Ludueña%' OR
    Autor like '%Hachita Ludueña%' OR
    Autor like '%Club Universidad%' OR
    Autor like '%Lalo Herrera%'
) AND
( Texto like '%Futbol%' 
)
  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 44: /*********** UNAM ESTADOS ************/
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
     Texto like '%UNAM%' OR 
    Texto like '%Pumas%' OR 
    Texto like '%Dario Veron%' OR 
    Texto like '%Guillermo Vazquez%' OR 
    Texto like '%Fidel Martinez%' OR 
    Texto like '%Mathias Vidangossy%' OR 
    Texto like '%Alejandro Palacios%' OR
    Texto like '%Picolin Palacios%' OR
    Texto like '%Memo Vazquez%' OR
    Texto like '%Eduardo Herrera Aguirre%' OR 
    Texto like '%Luis Quiñones%' OR
    Texto like '%Victor Mahbub%' OR
    Texto like '%Daniel Ludueña%' OR
    Texto like '%Hachita Ludueña%' OR
    Texto like '%Club Universidad%' OR
    Texto like '%Lalo Herrera%' OR    
    
    Titulo like '%UNAM%' OR
    Titulo like '%Pumas%' OR
    Titulo  like '%Dario Veron%' OR 
    Titulo like '%Guillermo Vazquez%' OR 
    Titulo like '%Fidel Martinez%' OR 
    Titulo like '%Mathias Vidangossy%' OR 
    Titulo like '%Alejandro Palacios%' OR
    Titulo like '%Picolin Palacios%' OR
    Titulo like '%Memo Vazquez%' OR
    Titulo like '%Eduardo Herrera Aguirre%' OR 
    Titulo like '%Luis Quiñones%' OR
    Titulo  like '%Victor Mahbub%' OR
    Titulo  like '%Daniel Ludueña%' OR
    Titulo  like '%Hachita Ludueña%' OR
    Titulo  like '%Club Universidad%' OR
    Titulo  like '%Lalo Herrera%' OR   

    Encabezado like '%UNAM%' OR
    Encabezado like '%Pumas%' OR
    Encabezado like '%Dario Veron%' OR 
    Encabezado like '%Guillermo Vazquez%' OR 
    Encabezado like '%Fidel Martinez%' OR 
    Encabezado like '%Mathias Vidangossy%' OR 
    Encabezado like '%Alejandro Palacios%' OR
    Encabezado like '%Picolin Palacios%' OR
    Encabezado like '%Memo Vazquez%' OR
    Encabezado like '%Eduardo Herrera Aguirre%' OR 
    Encabezado like '%Luis Quiñones%' OR
    Encabezado like '%Victor Mahbub%' OR
    Encabezado like '%Daniel Ludueña%' OR
    Encabezado like '%Hachita Ludueña%' OR
    Encabezado like '%Club Universidad%' OR
    Encabezado like '%Lalo Herrera%' OR    
      
    PieFoto like '%UNAM%' OR
    PieFoto like '%Pumas%' OR 
    PieFoto like '%Dario Veron%' OR 
    PieFoto  like '%Guillermo Vazquez%' OR 
    PieFoto  like '%Fidel Martinez%' OR 
    PieFoto  like '%Mathias Vidangossy%' OR 
    PieFoto  like '%Alejandro Palacios%' OR
    PieFoto  like '%Picolin Palacios%' OR
    PieFoto  like '%Memo Vazquez%' OR
    PieFoto  like '%Eduardo Herrera Aguirre%' OR 
    PieFoto  like '%Luis Quiñones%' OR
    PieFoto  like '%Victor Mahbub%' OR
    PieFoto  like '%Daniel Ludueña%' OR
    PieFoto  like '%Hachita Ludueña%' OR
    PieFoto  like '%Club Universidad%' OR
    PieFoto  like '%Lalo Herrera%' OR   
     
    Autor like '%UNAM%' OR
    Autor like '%Pumas%'  OR
    Autor like '%Dario Veron%' OR 
    Autor like '%Guillermo Vazquez%' OR 
    Autor like '%Fidel Martinez%' OR 
    Autor like '%Mathias Vidangossy%' OR 
    Autor like '%Alejandro Palacios%' OR
    Autor like '%Picolin Palacios%' OR
    Autor like '%Memo Vazquez%' OR
    Autor like '%Eduardo Herrera Aguirre%' OR 
    Autor like '%Luis Quiñones%' OR
    Autor like '%Victor Mahbub%' OR
    Autor like '%Daniel Ludueña%' OR
    Autor like '%Hachita Ludueña%' OR
    Autor like '%Club Universidad%' OR
    Autor like '%Lalo Herrera%'
) AND
( Texto like '%Futbol%' 
)
 GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** UNAM ESTADOS ************/

        case 45: /*********** VERACRUZ DF ************/
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
    Texto like '%Tiburones rojos de Veracruz%' OR 
    Texto like '%Barovero%' OR
    Texto like '%Tiburones Rojos%' OR
    Texto like '%Carlos Reinoso%' OR
    Texto like '%Ferando Menesesn%' OR
    
    Titulo like '%Tiburones rojos de Veracruz%' OR 
    Titulo like '%Barovero%' OR
    Titulo like '%Tiburones Rojos%' OR
    Titulo like '%Carlos Reinoso%' OR
    Titulo like '%Ferando Menesesn%' OR
    
    Encabezado like '%Tiburones rojos de Veracruz%' OR 
    Encabezado like '%Barovero%' OR
    Encabezado like '%Tiburones Rojos%' OR
    Encabezado like '%Carlos Reinoso%' OR
    Encabezado like '%Ferando Menesesn%' OR
    
    PieFoto like '%Tiburones rojos de Veracruz%' OR 
    PieFoto like '%Barovero%' OR
    PieFoto like '%Tiburones Rojos%' OR
    PieFoto like '%Carlos Reinoso%' OR
    PieFoto like '%Ferando Menesesn%'
)  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 46: /*********** VERACRUZ ESTADOS ************/
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
    Texto like '%Tiburones rojos de Veracruz%' OR 
    Texto like '%Barovero%' OR
    Texto like '%Tiburones Rojos%' OR
    Texto like '%Carlos Reinoso%' OR
    Texto like '%Ferando Menesesn%' OR
    
    Titulo like '%Tiburones rojos de Veracruz%' OR 
    Titulo like '%Barovero%' OR
    Titulo like '%Tiburones Rojos%' OR
    Titulo like '%Carlos Reinoso%' OR
    Titulo like '%Ferando Menesesn%' OR
    
    Encabezado like '%Tiburones rojos de Veracruz%' OR 
    Encabezado like '%Barovero%' OR
    Encabezado like '%Tiburones Rojos%' OR
    Encabezado like '%Carlos Reinoso%' OR
    Encabezado like '%Ferando Menesesn%' OR
    
    PieFoto like '%Tiburones rojos de Veracruz%' OR 
    PieFoto like '%Barovero%' OR
    PieFoto like '%Tiburones Rojos%' OR
    PieFoto like '%Carlos Reinoso%' OR
    PieFoto like '%Ferando Menesesn%'
) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** VERACRUZ ESTADOS ************/

        case 47: /*********** VARIOS DF ************/
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
    Texto like '%Liga Ascenso MX%' OR
     Texto like '%Liga de Ascenso 2016%' OR

    Titulo like '%Liga Ascenso MX%' OR
     Titulo like '%Liga de Ascenso 2016%' OR

    Encabezado like '%Liga Ascenso MX%' OR
     Encabezado like '%Liga de Ascenso 2016%' OR
      
    PieFoto like '%Liga Ascenso MX%' OR
     PieFoto like '%Liga de Ascenso 2016%' OR
     
    Autor like '%Liga Ascenso MX%'  OR
     Autor like '%Liga de Ascenso 2016%' 
)   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 48: /*********** VARIOS ESTADOS ************/
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
    Texto like '%Liga Ascenso MX%' OR
     Texto like '%Liga de Ascenso 2016%' OR

    Titulo like '%Liga Ascenso MX%' OR
     Titulo like '%Liga de Ascenso 2016%' OR

    Encabezado like '%Liga Ascenso MX%' OR
     Encabezado like '%Liga de Ascenso 2016%' OR
      
    PieFoto like '%Liga Ascenso MX%' OR
     PieFoto like '%Liga de Ascenso 2016%' OR
     
    Autor like '%Liga Ascenso MX%'  OR
     Autor like '%Liga de Ascenso 2016%' 
)  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** VARIOS ESTADOS ************/

        default:
            break;
    }
}
?>
