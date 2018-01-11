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

function query($op, $Tabla, $estado)
{
    $fecha = $Tabla;
    $FechaCliente = strtotime($Tabla);

    $fecha_actual1 = date('Y-m-d');
    $fecha_actual = strtotime($fecha_actual1);

    if ($fecha == date('Y-m-d')) {
        $Tabla = "noticiasDia";
    } else {
        $Tabla = "noticiasSemana";
    }
    switch ($op) {

        case 1: // PRIMERAS PLANAS
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
            break;
        case 2: // COLUMNAS POLITICAS
            $query = "SELECT
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
            break;
        case 3: // COLUMNAS FINANCIERAS
            $query = "SELECT n.idEditorial,n.Periodico as 'idPeriodico',
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
                    GROUP BY n.Periodico,n.NumeroPagina  ";
            return $query;
            break;
        case 4: //CARTONES
            $query = "SELECT n.idEditorial,n.Periodico as 'idPeriodico',
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
                    GROUP BY n.Periodico,n.NumeroPagina  
                    ORDER BY o.posicion
                    ";
            return $query;
            break;

        /*****************DF*********************/

        case 5: //Ing. Carlos Morales Paulin
            $query = "SELECT n.idEditorial,
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
                   fecha =DATE('$fecha') AND   (
        Texto like '%Ing. Carlos Morales Paulin%' OR
        Texto like '%Carlos Alberto Morales Paulin%' OR
        Texto like '%Carlos Morales Paulin%' OR
        Texto like '%Morales Paulin%' OR
        Texto like '%Presidente de Movistar%' OR
        Texto like '%Presidente Movistar%' OR
        Texto like '%CEO de Movistar%' OR
        Texto like '%CEO Movistar%' OR
        
        Titulo like '%Ing. Carlos Morales Paulin%' OR
        Titulo like '%Carlos Alberto Morales Paulin%' OR
        Titulo like '%Carlos Morales Paulin%' OR
        Titulo like '%Morales Paulin%' OR
        Titulo like '%Presidente de Movistar%' OR
        Titulo like '%Presidente Movistar%' OR
        Titulo like '%CEO de Movistar%' OR
        Titulo like '%CEO Movistar%' OR
        
        Encabezado like '%Ing. Carlos Morales Paulin%' OR
        Encabezado like '%Carlos Alberto Morales Paulin%' OR
        Encabezado like '%Carlos Morales Paulin%' OR
        Encabezado like '%Morales Paulin%' OR
        Encabezado like '%Presidente de Movistar%' OR
        Encabezado like '%Presidente Movistar%' OR
        Encabezado like '%CEO de Movistar%' OR
        Encabezado like '%CEO Movistar%' OR
        
        Autor like '%Ing. Carlos Morales Paulin%' OR
        Autor like '%Carlos Alberto Morales Paulin%' OR
        Autor like '%Carlos Morales Paulin%' OR
        Autor like '%Morales Paulin%' OR
        Autor like '%Presidente de Movistar%' OR
        Autor like '%Presidente Movistar%' OR
        Autor like '%CEO de Movistar%' OR
        Autor like '%CEO Movistar%' OR
        
        PieFoto like '%Ing. Carlos Morales Paulin%' OR
        PieFoto like '%Carlos Alberto Morales Paulin%' OR
        PieFoto like '%Carlos Morales Paulin%' OR
        PieFoto like '%Morales Paulin%' OR
        PieFoto like '%Presidente de Movistar%' OR
        PieFoto like '%Presidente Movistar%' OR
        PieFoto like '%CEO de Movistar%' OR
        PieFoto like '%CEO Movistar%' 
        
 )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 6: //Francisco Gil Díaz
            $query = "SELECT n.idEditorial,
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
                   fecha =DATE('$fecha') AND   (
        Texto like '%Presidente Consejero de Movistar%' OR
        Texto like '%Francisco Gil Diaz%' OR

        Titulo like '%Presidente Consejero de Movistar%' OR
        Titulo like '%Francisco Gil Diaz%' OR

        Encabezado like '%Presidente Consejero de Movistar%' OR
        Encabezado like '%Francisco Gil Diaz%' OR

        Autor like '%Presidente Consejero de Movistar%' OR
        Autor like '%Francisco Gil Diaz%' OR

        PieFoto like '%Presidente Consejero de Movistar%' OR
        PieFoto like '%Francisco Gil Diaz%' 

 )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 7: //Movistar
            $query = "SELECT n.idEditorial,
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
                   fecha =DATE('$fecha') AND   (
        Texto like '%Movistar%' OR

        Titulo like '%Movistar%' OR

        Encabezado like '%Movistar%' OR

        Autor like '%Movistar%' OR

        PieFoto like '%Movistar%' 

 )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 8: //Grupo Telefónica Móviles
            $query = "SELECT n.idEditorial,
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
        Texto like '%Grupo Telefonica Moviles%' OR

        Titulo like '%Grupo Telefonica Moviles%' OR

        Encabezado like '%Grupo Telefonica Moviles%' OR

        Autor like '%Grupo Telefonica Moviles%' OR

        PieFoto like '%Grupo Telefonica Moviles%' 

 )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 9: //Telcel
            $query = "SELECT n.idEditorial,
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
                   fecha =DATE('$fecha') AND   (
        Texto like '%America Movil%' OR
        Texto like '%Telcel%' OR

        Titulo like '%America Movil%' OR
        Titulo like '%Telcel%' OR

        Encabezado like '%America Movil%' OR
        Encabezado like '%Telcel%' OR

        Autor like '%America Movil%' OR
        Autor like '%Telcel%' OR

        PieFoto like '%America Movil%' OR
        PieFoto like '%Telcel%'
 )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 10: //AT&T
            $query = "SELECT n.idEditorial,
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
Texto like '%AT&T%' OR
        Texto like '%Iusacell%' OR

        Titulo like '%AT&T%' OR
        Titulo like '%Iusacell%' OR

        Encabezado like '%AT&T%' OR
        Encabezado like '%Iusacell%' OR

        Autor like '%AT&T%' OR
        Autor like '%Iusacell%' OR

        PieFoto like '%AT&T%' OR
        PieFoto like '%Iusacell%' 

)
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 11: //Cámara de Diputados
            $query = "SELECT n.idEditorial,
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
                   fecha =DATE('$fecha') AND   (
        Texto like '%Telecomunicacion%' OR
        Texto like '%Telecomunicaciones%' OR

        Titulo like '%Telecomunicacion%' OR
        Titulo like '%Telecomunicaciones%' OR

        Encabezado like '%Telecomunicacion%' OR
        Encabezado like '%Telecomunicaciones%' OR

        Autor like '%Telecomunicacion%' OR
        Autor like '%Telecomunicaciones%' OR

        PieFoto like '%Telecomunicacion%' OR
        PieFoto like '%Telecomunicaciones%'        
 )AND 
 ( 
        Texto like '%Camara de Diputados%' 
 )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 12: //Cámara de Senadores
            $query = "SELECT n.idEditorial,
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
                   fecha =DATE('$fecha') AND   (
        Texto like '%Telecomunicacion%' OR
        Texto like '%Telecomunicaciones%' OR

        Titulo like '%Telecomunicacion%' OR
        Titulo like '%Telecomunicaciones%' OR

        Encabezado like '%Telecomunicacion%' OR
        Encabezado like '%Telecomunicaciones%' OR

        Autor like '%Telecomunicacion%' OR
        Autor like '%Telecomunicaciones%' OR

        PieFoto like '%Telecomunicacion%' OR
        PieFoto like '%Telecomunicaciones%'        
 )AND 
 ( 
        Texto like '%Camara de Senadores%' 
 )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 13: //SCT - Telecomunicaciones
            $query = "SELECT n.idEditorial,
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
                Texto like'%Telecomunicaciones%' OR
        Texto like '%telecom%' OR
        Texto like '%Leyes de telecomunicaciones%' OR
        Texto like '%SCT% telecomunicaciones%' OR
       
        
        Titulo like'%Telecomunicaciones%' OR
        Titulo like '%telecom%' OR
        Titulo like '%Leyes de telecomunicaciones%' OR
        Titulo like '%SCT% telecomunicaciones%' OR
            

        Encabezado like'%Telecomunicaciones%' OR
        Encabezado like '%telecom%' OR
        Encabezado like '%Leyes de telecomunicaciones%' OR
        Encabezado like '%SCT% telecomunicaciones%' OR
        
        PieFoto like'%Telecomunicaciones%' OR
        PieFoto like '%telecom%' OR
        PieFoto like '%Leyes de telecomunicaciones%' OR
        PieFoto like '%SCT% telecomunicaciones%'  

       )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 14: //IFETEL
            $query = "SELECT n.idEditorial,
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
        Texto like'%Telecomunicaciones%' OR
        Texto like '%telecom%' OR
        Texto like '%Leyes de telecomunicaciones%' OR
        Texto like '%Instituto federal de telecomunicaciones%' OR
        Texto like '%IFETEL%' OR
       Texto like '%IFT%' OR
        
        Titulo like'%Telecomunicaciones%' OR
        Titulo like '%telecom%' OR
        Titulo like '%Leyes de telecomunicaciones%' OR
        Titulo like '%Instituto federal de telecomunicaciones%' OR
        Titulo like '%IFETEL%' OR 
       Titulo like '%IFT%' OR

        Encabezado like'%Telecomunicaciones%' OR
        Encabezado like '%telecom%' OR
        Encabezado like '%Leyes de telecomunicaciones%' OR
        Encabezado like '%Instituto federal de telecomunicaciones%' OR
        Encabezado like '%IFETEL%' OR
Encabezado like '%IFT%' 
       )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        /****************** Querys Estados ************************/

        case 15: //Ing. Carlos Morales Paulin
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Ing. Carlos Morales Paulin%' OR
        Texto like '%Carlos Alberto Morales Paulin%' OR
        Texto like '%Carlos Morales Paulin%' OR
        Texto like '%Morales Paulin%' OR
        Texto like '%Presidente de Movistar%' OR
        Texto like '%Presidente Movistar%' OR
        Texto like '%CEO de Movistar%' OR
        Texto like '%CEO Movistar%' OR
        
        Titulo like '%Ing. Carlos Morales Paulin%' OR
        Titulo like '%Carlos Alberto Morales Paulin%' OR
        Titulo like '%Carlos Morales Paulin%' OR
        Titulo like '%Morales Paulin%' OR
        Titulo like '%Presidente de Movistar%' OR
        Titulo like '%Presidente Movistar%' OR
        Titulo like '%CEO de Movistar%' OR
        Titulo like '%CEO Movistar%' OR
        
        Encabezado like '%Ing. Carlos Morales Paulin%' OR
        Encabezado like '%Carlos Alberto Morales Paulin%' OR
        Encabezado like '%Carlos Morales Paulin%' OR
        Encabezado like '%Morales Paulin%' OR
        Encabezado like '%Presidente de Movistar%' OR
        Encabezado like '%Presidente Movistar%' OR
        Encabezado like '%CEO de Movistar%' OR
        Encabezado like '%CEO Movistar%' OR
        
        Autor like '%Ing. Carlos Morales Paulin%' OR
        Autor like '%Carlos Alberto Morales Paulin%' OR
        Autor like '%Carlos Morales Paulin%' OR
        Autor like '%Morales Paulin%' OR
        Autor like '%Presidente de Movistar%' OR
        Autor like '%Presidente Movistar%' OR
        Autor like '%CEO de Movistar%' OR
        Autor like '%CEO Movistar%' OR
        
        PieFoto like '%Ing. Carlos Morales Paulin%' OR
        PieFoto like '%Carlos Alberto Morales Paulin%' OR
        PieFoto like '%Carlos Morales Paulin%' OR
        PieFoto like '%Morales Paulin%' OR
        PieFoto like '%Presidente de Movistar%' OR
        PieFoto like '%Presidente Movistar%' OR
        PieFoto like '%CEO de Movistar%' OR
        PieFoto like '%CEO Movistar%' 
        
 )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 16: //Francisco Gil Díaz
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Presidente Consejero de Movistar%' OR
        Texto like '%Francisco Gil Diaz%' OR

        Titulo like '%Presidente Consejero de Movistar%' OR
        Titulo like '%Francisco Gil Diaz%' OR

        Encabezado like '%Presidente Consejero de Movistar%' OR
        Encabezado like '%Francisco Gil Diaz%' OR

        Autor like '%Presidente Consejero de Movistar%' OR
        Autor like '%Francisco Gil Diaz%' OR

        PieFoto like '%Presidente Consejero de Movistar%' OR
        PieFoto like '%Francisco Gil Diaz%' 

 )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 17: //Movistar
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Movistar%' OR

        Titulo like '%Movistar%' OR

        Encabezado like '%Movistar%' OR

        Autor like '%Movistar%' OR

        PieFoto like '%Movistar%' 

 )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 18: //Grupo Telefónica Móviles
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Grupo Telefonica Moviles%' OR

        Titulo like '%Grupo Telefonica Moviles%' OR

        Encabezado like '%Grupo Telefonica Moviles%' OR

        Autor like '%Grupo Telefonica Moviles%' OR

        PieFoto like '%Grupo Telefonica Moviles%' 

 )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 19: //Telcel
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%America Movil%' OR
        Texto like '%Telcel%' OR

        Titulo like '%America Movil%' OR
        Titulo like '%Telcel%' OR

        Encabezado like '%America Movil%' OR
        Encabezado like '%Telcel%' OR

        Autor like '%America Movil%' OR
        Autor like '%Telcel%' OR

        PieFoto like '%America Movil%' OR
        PieFoto like '%Telcel%'
 )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 20: //AT&T
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
Texto like '%AT&T%' OR
        Texto like '%Iusacell%' OR

        Titulo like '%AT&T%' OR
        Titulo like '%Iusacell%' OR

        Encabezado like '%AT&T%' OR
        Encabezado like '%Iusacell%' OR

        Autor like '%AT&T%' OR
        Autor like '%Iusacell%' OR

        PieFoto like '%AT&T%' OR
        PieFoto like '%Iusacell%' 

)
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 21: //Cámara de Diputados
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Telecomunicacion%' OR
        Texto like '%Telecomunicaciones%' OR

        Titulo like '%Telecomunicacion%' OR
        Titulo like '%Telecomunicaciones%' OR

        Encabezado like '%Telecomunicacion%' OR
        Encabezado like '%Telecomunicaciones%' OR

        Autor like '%Telecomunicacion%' OR
        Autor like '%Telecomunicaciones%' OR

        PieFoto like '%Telecomunicacion%' OR
        PieFoto like '%Telecomunicaciones%'        
 )AND 
 ( 
        Texto like '%Camara de Diputados%' 
 )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 22: //Cámara de Senadores
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Telecomunicacion%' OR
        Texto like '%Telecomunicaciones%' OR

        Titulo like '%Telecomunicacion%' OR
        Titulo like '%Telecomunicaciones%' OR

        Encabezado like '%Telecomunicacion%' OR
        Encabezado like '%Telecomunicaciones%' OR

        Autor like '%Telecomunicacion%' OR
        Autor like '%Telecomunicaciones%' OR

        PieFoto like '%Telecomunicacion%' OR
        PieFoto like '%Telecomunicaciones%'        
 )AND 
 ( 
        Texto like '%Camara de Senadores%' 
 )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 23: //SCT - Telecomunicaciones
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                Texto like'%Telecomunicaciones%' OR
        Texto like '%telecom%' OR
        Texto like '%Leyes de telecomunicaciones%' OR
        Texto like '%SCT% telecomunicaciones%' OR
       
        
        Titulo like'%Telecomunicaciones%' OR
        Titulo like '%telecom%' OR
        Titulo like '%Leyes de telecomunicaciones%' OR
        Titulo like '%SCT% telecomunicaciones%' OR
            

        Encabezado like'%Telecomunicaciones%' OR
        Encabezado like '%telecom%' OR
        Encabezado like '%Leyes de telecomunicaciones%' OR
        Encabezado like '%SCT% telecomunicaciones%' OR
        
        PieFoto like'%Telecomunicaciones%' OR
        PieFoto like '%telecom%' OR
        PieFoto like '%Leyes de telecomunicaciones%' OR
        PieFoto like '%SCT% telecomunicaciones%'  

       )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 24: //IFETEL
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado <> 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like'%Telecomunicaciones%' OR
        Texto like '%telecom%' OR
        Texto like '%Leyes de telecomunicaciones%' OR
        Texto like '%Instituto federal de telecomunicaciones%' OR
        Texto like '%IFETEL%' OR
       Texto like '%IFT%' OR
        
        Titulo like'%Telecomunicaciones%' OR
        Titulo like '%telecom%' OR
        Titulo like '%Leyes de telecomunicaciones%' OR
        Titulo like '%Instituto federal de telecomunicaciones%' OR
        Titulo like '%IFETEL%' OR 
       Titulo like '%IFT%' OR

        Encabezado like'%Telecomunicaciones%' OR
        Encabezado like '%telecom%' OR
        Encabezado like '%Leyes de telecomunicaciones%' OR
        Encabezado like '%Instituto federal de telecomunicaciones%' OR
        Encabezado like '%IFETEL%' OR
Encabezado like '%IFT%' 
       )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;
            /******************Fin Querys Estados ************************/

    }
}
