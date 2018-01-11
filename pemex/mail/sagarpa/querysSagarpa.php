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
        case 5: /*********** SECRETARIO SAGARPA - DF ************/
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
                     Texto like '%Jose Eduardo Calzada Rovirosa%' OR
                     Texto like '%Jose Eduardo Calzada%' OR
                     Texto like '%Jose Calzada%' OR
                     Texto like '%Eduardo Calzada Rovirosa%' OR
	             Texto like '%Secretario de Sagarpa%' OR
	             Texto like '%Pepe Calzada Rovirosa%' OR

                     Titulo like '%Jose Eduardo Calzada Rovirosa%' OR
                     Titulo like '%Jose Eduardo Calzada%' OR
                     Titulo like '%Eduardo Calzada Rovirosa%' OR
		     Titulo like '%Secretario de Sagarpa%' OR
	             Titulo like '%Pepe Calzada Rovirosa%' OR
		       
                     Encabezado like '%Jose Eduardo Calzada Rovirosa%' OR
                     Encabezado like '%Jose Eduardo Calzada%' OR
                     Encabezado like '%Eduardo Calzada Rovirosa%' OR
                     Encabezado like '%Secretario de Sagarpa%' OR
	             Encabezado like '%Pepe Calzada Rovirosa%' OR

                     Autor like '%Jose Eduardo Calzada Rovirosa%' OR
                     Autor like '%Jose Eduardo Calzada%' OR
                     Autor like '%Eduardo Calzada Rovirosa%' OR
                     Autor like '%Secretario de Sagarpa%' OR
	             Autor like '%Pepe Calzada Rovirosa%' OR

                     PieFoto like '%Jose Eduardo Calzada Rovirosa%' OR
                     PieFoto like '%Jose Eduardo Calzada%' OR
                     PieFoto like '%Eduardo Calzada Rovirosa%' OR
	             PieFoto like '%Pepe Calzada Rovirosa%' OR
                     PieFoto like '%Secretario de Sagarpa%'
                     
              ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 6: /*********** SECRETARIO SAGARPA - ESTADOS ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND  (
                     Texto like '%Jose Eduardo Calzada Rovirosa%' OR
                     Texto like '%Jose Eduardo Calzada%' OR
                     Texto like '%Jose Calzada%' OR
                     Texto like '%Eduardo Calzada Rovirosa%' OR
	             Texto like '%Secretario de Sagarpa%' OR
	             Texto like '%Pepe Calzada Rovirosa%' OR

                     Titulo like '%Jose Eduardo Calzada Rovirosa%' OR
                     Titulo like '%Jose Eduardo Calzada%' OR
                     Titulo like '%Eduardo Calzada Rovirosa%' OR
		     Titulo like '%Secretario de Sagarpa%' OR
	             Titulo like '%Pepe Calzada Rovirosa%' OR
		       
                     Encabezado like '%Jose Eduardo Calzada Rovirosa%' OR
                     Encabezado like '%Jose Eduardo Calzada%' OR
                     Encabezado like '%Eduardo Calzada Rovirosa%' OR
                     Encabezado like '%Secretario de Sagarpa%' OR
	             Encabezado like '%Pepe Calzada Rovirosa%' OR

                     Autor like '%Jose Eduardo Calzada Rovirosa%' OR
                     Autor like '%Jose Eduardo Calzada%' OR
                     Autor like '%Eduardo Calzada Rovirosa%' OR
                     Autor like '%Secretario de Sagarpa%' OR
	             Autor like '%Pepe Calzada Rovirosa%' OR

                     PieFoto like '%Jose Eduardo Calzada Rovirosa%' OR
                     PieFoto like '%Jose Eduardo Calzada%' OR
                     PieFoto like '%Eduardo Calzada Rovirosa%' OR
	             PieFoto like '%Pepe Calzada Rovirosa%' OR
                     PieFoto like '%Secretario de Sagarpa%'
              )  GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /***********  SECRETARIO SAGARPA ESTADOS     ************/
        
        case 7: /***********  SUBSECRETARIAS DF  ************/
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
                    Texto like '%Subsecretario de Desarrollo Rural%' OR
                    Texto like '%Subsecretaria de Desarrollo Rural%' OR
                    Texto like '%Hector Velasco Monroy%' OR
                    Texto like '%Subsecretario de Agricultura%' OR
                    Texto like '%Subsecretaria de Agricultura%' OR
                    Texto like '%Jorge Armando Narvaez Narvaez%' OR
                    Texto like '%Subsecretario de Alimentacion y Competitividad%' OR
                    Texto like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    Texto like '% Ricardo Aguilar Castillo %' OR
        
                    Titulo like '%Subsecretario de Desarrollo Rural%' OR
                    Titulo like '%Subsecretaria de Desarrollo Rural%' OR
                    Titulo like '%Hector Velasco Monroy%' OR
                    Titulo like '%Subsecretario de Agricultura%' OR
                    Titulo like '%Subsecretaria de Agricultura%' OR
                    Titulo like '%Jorge Armando Narvaez Narvaez%' OR
                    Titulo like '%Subsecretario de Alimentacion y Competitividad%' OR
                    Titulo like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    Titulo like '% Ricardo Aguilar Castillo %' OR
        
                    Encabezado like '%Subsecretario de Desarrollo Rural%' OR
                    Encabezado like '%Subsecretaria de Desarrollo Rural%' OR
                    Encabezado like '%Hector Velasco Monroy%' OR
                    Encabezado like '%Subsecretario de Agricultura%' OR
                    Encabezado like '%Subsecretaria de Agricultura%' OR
                    Encabezado like '%Jorge Armando Narvaez Narvaez%' OR
                    Encabezado like '%Subsecretario de Alimentacion y Competitividad%' OR
                    Encabezado like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    Encabezado like '% Ricardo Aguilar Castillo %' OR
        
                    Autor like '%Subsecretario de Desarrollo Rural%' OR
                    Autor like '%Subsecretaria de Desarrollo Rural%' OR
                    Autor like '%Hector Velasco Monroy%' OR
                    Autor like '%Subsecretario de Agricultura%' OR
                    Autor like '%Subsecretaria de Agricultura%' OR
                    Autor like '%Jorge Armando Narvaez Narvaez%' OR
                    Autor like '%Subsecretario de Alimentacion y Competitividad%' OR
                    Autor like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    Autor like '% Ricardo Aguilar Castillo %' OR
        
                    PieFoto like '%Subsecretario de Desarrollo Rural%' OR
                    PieFoto like '%Subsecretaria de Desarrollo Rural%' OR
                    PieFoto like '%Hector Velasco Monroy%' OR
                    PieFoto like '%Subsecretario de Agricultura%' OR
                    PieFoto like '%Subsecretaria de Agricultura%' OR
                    PieFoto like '%Jorge Armando Narvaez Narvaez%' OR
                    PieFoto like '%Subsecretario de Alimentacion y Competitividad%' OR
                    PieFoto like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    PieFoto like '% Ricardo Aguilar Castillo %'
            )   GROUP BY p.idPeriodico, n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;      
        break;//
        case 8: /***********  SUBSECRETARIAS  ESTADOS     ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (

                    Texto like '%Subsecretario de Desarrollo Rural%' OR
                    Texto like '%Subsecretaria de Desarrollo Rural%' OR
                    Texto like '%Hector Velasco Monroy%' OR
                    Texto like '%Subsecretario de Agricultura%' OR
                    Texto like '%Subsecretaria de Agricultura%' OR
                    Texto like '%Jorge Armando Narvaez Narvaez%' OR
                    Texto like '%Subsecretario de Alimentacion y Competitividad%' OR
                    Texto like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    Texto like '% Ricardo Aguilar Castillo %' OR
        
                    Titulo like '%Subsecretario de Desarrollo Rural%' OR
                    Titulo like '%Subsecretaria de Desarrollo Rural%' OR
                    Titulo like '%Hector Velasco Monroy%' OR
                    Titulo like '%Subsecretario de Agricultura%' OR
                    Titulo like '%Subsecretaria de Agricultura%' OR
                    Titulo like '%Jorge Armando Narvaez Narvaez%' OR
                    Titulo like '%Subsecretario de Alimentacion y Competitividad%' OR
                    Titulo like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    Titulo like '% Ricardo Aguilar Castillo %' OR
        
                    Encabezado like '%Subsecretario de Desarrollo Rural%' OR
                    Encabezado like '%Subsecretaria de Desarrollo Rural%' OR
                    Encabezado like '%Hector Velasco Monroy%' OR
                    Encabezado like '%Subsecretario de Agricultura%' OR
                    Encabezado like '%Subsecretaria de Agricultura%' OR
                    Encabezado like '%Jorge Armando Narvaez Narvaez%' OR
                    Encabezado like '%Subsecretario de Alimentacion y Competitividad%' OR
                    Encabezado like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    Encabezado like '% Ricardo Aguilar Castillo %' OR
        
                    Autor like '%Subsecretario de Desarrollo Rural%' OR
                    Autor like '%Subsecretaria de Desarrollo Rural%' OR
                    Autor like '%Hector Velasco Monroy%' OR
                    Autor like '%Subsecretario de Agricultura%' OR
                    Autor like '%Subsecretaria de Agricultura%' OR
                    Autor like '%Jorge Armando Narvaez Narvaez%' OR
                    Autor like '%Subsecretario de Alimentacion y Competitividad%' OR
                    Autor like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    Autor like '% Ricardo Aguilar Castillo %' OR
        
                    PieFoto like '%Subsecretario de Desarrollo Rural%' OR
                    PieFoto like '%Subsecretaria de Desarrollo Rural%' OR
                    PieFoto like '%Hector Velasco Monroy%' OR
                    PieFoto like '%Subsecretario de Agricultura%' OR
                    PieFoto like '%Subsecretaria de Agricultura%' OR
                    PieFoto like '%Jorge Armando Narvaez Narvaez%' OR
                    PieFoto like '%Subsecretario de Alimentacion y Competitividad%' OR
                    PieFoto like '%Subsecretaria de Alimentacion y Competitividad%' OR
                    PieFoto like '% Ricardo Aguilar Castillo %'
            )   GROUP BY p.idPeriodico, n.PaginaPeriodico
                ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** SUBSECRETARIAS - ESTADOS ************/

        case 9: /*********** FUNCIONARIOS - DF ************/
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
                    Texto like '%Marcelo Lopez Sanchez %' OR
                    Texto like '%Abelardo Martin Miranda%' OR
                    Texto like '%Francisco Jose Gurria Treviño%' OR
                    Texto like '%Mireille Roccatti%' OR
                    Texto like '%Raul Urteaga Trani%' OR
                    Texto like '% Victor Hugo Celaya Celaya %' OR

                    Titulo like '%Marcelo Lopez Sanchez %' OR
                    Titulo like '%Abelardo Martin Miranda%' OR
                    Titulo like '%Francisco Jose Gurria Treviño%' OR
                    Titulo like '%Mireille Roccatti%' OR
                    Titulo like '%Raul Urteaga Trani%' OR
                    Titulo like '% Victor Hugo Celaya Celaya %' OR

                    Encabezado like '%Marcelo Lopez Sanchez %' OR
                    Encabezado like '%Abelardo Martin Miranda%' OR
                    Encabezado like '%Francisco Jose Gurria Treviño%' OR
                    Encabezado like '%Mireille Roccatti%' OR
                    Encabezado like '%Raul Urteaga Trani%' OR
                    Encabezado like '% Victor Hugo Celaya Celaya %' OR

                    Autor like '%Marcelo Lopez Sanchez %' OR
                    Autor like '%Abelardo Martin Miranda%' OR
                    Autor like '%Francisco Jose Gurria Treviño%' OR
                    Autor like '%Mireille Roccatti%' OR
                    Autor like '%Raul Urteaga Trani%' OR
                    Autor like '% Victor Hugo Celaya Celaya %' OR

                    PieFoto like '%Marcelo Lopez Sanchez %' OR
                    PieFoto like '%Abelardo Martin Miranda%' OR
                    PieFoto like '%Francisco Jose Gurria Treviño%' OR
                    PieFoto like '%Mireille Roccatti%' OR
                    PieFoto like '%Raul Urteaga Trani%' OR
                    PieFoto like '% Victor Hugo Celaya Celaya %'
                    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 10: /*********** FUNCIONARIOS ESTADOS     ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                    Texto like '%Marcelo Lopez Sanchez %' OR
                    Texto like '%Abelardo Martin Miranda%' OR
                    Texto like '%Francisco Jose Gurria Treviño%' OR
                    Texto like '%Mireille Roccatti%' OR
                    Texto like '%Raul Urteaga Trani%' OR
                    Texto like '% Victor Hugo Celaya Celaya %' OR

                    Titulo like '%Marcelo Lopez Sanchez %' OR
                    Titulo like '%Abelardo Martin Miranda%' OR
                    Titulo like '%Francisco Jose Gurria Treviño%' OR
                    Titulo like '%Mireille Roccatti%' OR
                    Titulo like '%Raul Urteaga Trani%' OR
                    Titulo like '% Victor Hugo Celaya Celaya %' OR

                    Encabezado like '%Marcelo Lopez Sanchez %' OR
                    Encabezado like '%Abelardo Martin Miranda%' OR
                    Encabezado like '%Francisco Jose Gurria Treviño%' OR
                    Encabezado like '%Mireille Roccatti%' OR
                    Encabezado like '%Raul Urteaga Trani%' OR
                    Encabezado like '% Victor Hugo Celaya Celaya %' OR

                    Autor like '%Marcelo Lopez Sanchez %' OR
                    Autor like '%Abelardo Martin Miranda%' OR
                    Autor like '%Francisco Jose Gurria Treviño%' OR
                    Autor like '%Mireille Roccatti%' OR
                    Autor like '%Raul Urteaga Trani%' OR
                    Autor like '% Victor Hugo Celaya Celaya %' OR

                    PieFoto like '%Marcelo Lopez Sanchez %' OR
                    PieFoto like '%Abelardo Martin Miranda%' OR
                    PieFoto like '%Francisco Jose Gurria Treviño%' OR
                    PieFoto like '%Mireille Roccatti%' OR
                    PieFoto like '%Raul Urteaga Trani%' OR
                    PieFoto like '% Victor Hugo Celaya Celaya %'
                    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** FUNCIONARIOS ESTADOS ************/

        case 11: /*********** DELEGACIONES - DF ************/
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
                    Texto like '%delegacion de la sagarpa%' OR
                    Titulo like '%delegacion de la sagarpa%' OR
                    Encabezado like '%delegacion de la sagarpa%' OR
                    Autor like '%delegacion de la sagarpa%' OR
                    PieFoto like '%delegacion de la sagarpa%'
                )   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 12: /*********** DELEGACIONES - ESTADOS ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                    Texto like '%delegacion de la sagarpa%' OR
                    Titulo like '%delegacion de la sagarpa%' OR
                    Encabezado like '%delegacion de la sagarpa%' OR
                    Autor like '%delegacion de la sagarpa%' OR
                    PieFoto like '%delegacion de la sagarpa%'
                )   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** DELEGACIONES ESTADOS ************/

        case 13: /*********** AGRICULTURA DF ************/
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
                    (Texto like '%agricultura%' AND Texto NOT LIKE '%colonia%' ) OR
                    (Titulo like '%agricultura%' AND Titulo NOT LIKE '%colonia%' ) OR
                    (Encabezado like '%agricultura%' AND Encabezado NOT LIKE '%colonia%' ) OR
                    (Autor like '%agricultura%' AND Autor NOT LIKE '%colonia%' ) OR
                    PieFoto like '%agricultura%'
                )   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 14: /*********** AGRICULTURA ESTADOS ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND ( 
                    (Texto like '%agricultura%' AND Texto NOT LIKE '%colonia%' ) OR
                    (Titulo like '%agricultura%' AND Titulo NOT LIKE '%colonia%' ) OR
                    (Encabezado like '%agricultura%' AND Encabezado NOT LIKE '%colonia%' ) OR
                    (Autor like '%agricultura%' AND Autor NOT LIKE '%colonia%' ) OR
                    PieFoto like '%agricultura%'
                )
                    GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** AGRICULTURA ESTADOS ************/
        case 15: /*********** GANADERIA DF ************/
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
		        Texto like '%ganaderia%' OR
        		Titulo like '%ganaderia%' OR
        		Encabezado like '%ganaderia%' OR
        		Autor like '%ganaderia%' OR
        		PieFoto like '%ganaderia%'
    		)AND ( Texto not like '% corridas de toros %' OR Texto not like '% torero%'
		) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 16: /*********** GANADERIA ESTADOS ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
		        Texto like '%ganaderia%' OR
        		Titulo like '%ganaderia%' OR
        		Encabezado like '%ganaderia%' OR
        		Autor like '%ganaderia%' OR
        		PieFoto like '%ganaderia%'
    		)AND ( Texto not like '% corridas de toros %' OR Texto not like '% torero%'
		)  GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** GANADERIA ESTADOS ************/

        case 17: /*********** PESCA DF ************/
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
                        Texto like '% pesca %' OR
                        Titulo like '% pesca %' OR
                        Encabezado like '% pesca %' OR
                        Autor like '% pesca %' OR
                        PieFoto like '% pesca %'
                    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 18: /*********** PESCA ESTADOS ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                        Texto like '% pesca %' OR
                        Titulo like '% pesca %' OR
                        Encabezado like '% pesca %' OR
                        Autor like '% pesca %' OR
                        PieFoto like '% pesca %'
                    ) 
                    GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** PESCA ESTADOS ************/


        case 19: /*********** CAMPO DF ************/
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
                Texto like'% transformar el campo %' OR
                Texto like '% campo mexicano %' OR
                Texto like '% sector campesino %' OR
                Texto like'% procampo %' OR
                ( Texto like'% semilla %' AND Texto like'% fertilizante %' )OR
                ( Texto like'% campo %' AND Texto like'% agricultura %' )OR

                Titulo like'% transformar el campo %' OR
                Titulo like '% campo mexicano %' OR
                Titulo like '% sector campesino %' OR
                Titulo like'% procampo %' OR
                ( Titulo like'% semilla %' AND Titulo like'% fertilizante %' )OR

                Encabezado like'% transformar el campo %' OR
                Encabezado like '% campo mexicano %' OR
                Encabezado like '% sector campesino %' OR
                Encabezado like'% procampo %' OR
                ( Encabezado like'% semilla%' AND Encabezado like'% fertilizante%' ) 
   	) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 20: /*********** CAMPO ESTADOS ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                Texto like'% transformar el campo %' OR
                Texto like '% campo mexicano %' OR
                Texto like '% sector campesino %' OR
                Texto like'% procampo %' OR
                ( Texto like'% semilla %' AND Texto like'% fertilizante %' )OR
                ( Texto like'% campo %' AND Texto like'% agricultura %' )OR

                Titulo like'% transformar el campo %' OR
                Titulo like '% campo mexicano %' OR
                Titulo like '% sector campesino %' OR
                Titulo like'% procampo %' OR
                ( Titulo like'% semilla %' AND Titulo like'% fertilizante %' )OR

                Encabezado like'% transformar el campo %' OR
                Encabezado like '% campo mexicano %' OR
                Encabezado like '% sector campesino %' OR
                Encabezado like'% procampo %' OR
                ( Encabezado like'% semilla%' AND Encabezado like'% fertilizante%' ) 
   	) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
   	
            return $query;
        break; /*********** CAMPO ESTADOS ************/

        case 21: /*********** VARIOS DF ************/
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
                        Texto like '%SAGARPA%' OR
                        Texto like '%Desarrollo Rural%' OR
                        Texto like '%Agricultura%' OR
                        Texto like '%Alimentacion y Competitividad%' OR
                        Titulo like '%SAGARPA%' OR
                        Titulo like '%Desarrollo Rural%' OR
                        Titulo like '%Agricultura%' OR
                        Titulo like '%Alimentacion y Competitividad%' OR
                        Encabezado like '%SAGARPA%' OR
                        Encabezado like '%Desarrollo Rural%' OR
                        Encabezado like '%Agricultura%' OR
                        Encabezado like '%Alimentacion y Competitividad%' OR
                        Autor like '%SAGARPA%' OR
                        Autor like '%Desarrollo Rural%' OR
                        Autor like '%Agricultura%' OR
                        Autor like '%Alimentacion y Competitividad%' OR
                        PieFoto like '%SAGARPA%' OR
                        PieFoto like '%Desarrollo Rural%' OR
                        PieFoto like '%Agricultura%' OR
                        PieFoto like '%Alimentacion y Competitividad%' )
                    GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 22: /*********** VARIOS ESTADOS ************/
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
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                        Texto like '%SAGARPA%' OR
                        Texto like '%Desarrollo Rural%' OR
                        Texto like '%Agricultura%' OR
                        Texto like '%Alimentacion y Competitividad%' OR
                        Titulo like '%SAGARPA%' OR
                        Titulo like '%Desarrollo Rural%' OR
                        Titulo like '%Agricultura%' OR
                        Titulo like '%Alimentacion y Competitividad%' OR
                        Encabezado like '%SAGARPA%' OR
                        Encabezado like '%Desarrollo Rural%' OR
                        Encabezado like '%Agricultura%' OR
                        Encabezado like '%Alimentacion y Competitividad%' OR
                        Autor like '%SAGARPA%' OR
                        Autor like '%Desarrollo Rural%' OR
                        Autor like '%Agricultura%' OR
                        Autor like '%Alimentacion y Competitividad%' OR
                        PieFoto like '%SAGARPA%' OR
                        PieFoto like '%Desarrollo Rural%' OR
                        PieFoto like '%Agricultura%' OR
                        PieFoto like '%Alimentacion y Competitividad%' ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break; /*********** VARIOS ESTADOS ************/

        default:
            break;
    }
}
?>
