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
    $fecha        = $Tabla;
    $FechaCliente = strtotime($Tabla);

    $fecha_actual1 = date('Y-m-d');
    $fecha_actual  = strtotime($fecha_actual1);

    if ($FechaCliente == $fecha_actual) {
        $Tabla = "noticiasDia";
    } else {
        $Tabla = "(
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasSemana WHERE Fecha = '" . $fecha . "'
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasMensual WHERE Fecha = '" . $fecha . "'
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasAnual WHERE Fecha = '" . $fecha . "'
                )";
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
    case 5: /*********** PEÑA NIETO PARTE 1************/
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
                   c.idCategoria NOT IN (80) AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND
                   (
                        Texto like '%Enrique pena nieto%' OR
                        Texto like '%presidente peña%' OR
                        Texto like '%peña nieto%' OR
                        Texto like '%pena nieto%' OR
                        Texto like 'Enrique pena nieto' OR
                        Texto like '%epn%' OR
                        Texto like '%@EPN%' OR
                        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
                        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
                        Texto like '%de Pena Nieto%' OR
                        Texto like '% Enrique Pena %' OR
                        Texto like '% quique Pena %' OR
                        Texto like '%peñanietista%' OR
                        Texto like '%penanietista%' OR

                        Titulo like '%Enrique pena nieto%' OR
                        Titulo like '%presidente peña%' OR
                        Titulo like '%peña nieto%' OR
                        Titulo like '%pena nieto%' OR
                        Titulo like 'Enrique pena nieto'  OR
                        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                        Titulo like '%Senor Licenciado enrique pena nieto%' OR
                        Titulo like '%epn%' OR
                        Titulo like '%@EPN%' OR
                        Titulo like '% quique Pena %' OR
                        Titulo like '%peñanietista%' OR

                        Encabezado like '%Enrique pena nieto%' OR
                        Encabezado like '%presidente peña%' OR
                        Encabezado like '%peña nieto%' OR
                        Encabezado like '%pena nieto%' OR
                        Encabezado like 'Enrique pena nieto' OR
                        Encabezado like '%epn%' OR
                        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
                        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
                        Encabezado like '%epn%' OR
                        Encabezado like '%@EPN%' OR
                        Encabezado like '% quique Pena %' OR
                        Encabezado like '%peñanietista%'
                 ) AND (
                    Texto not like '%expresidente%' OR
                    Titulo not like '%expresidente%' OR
                    Encabezado not like '%expresidente%' OR
                    PieFoto not like '%expresidente%' OR
                    Autor not like '%expresidente%'
                )
GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion LIMIT 00, 30";
        return $query;
        break; //
    case 6: /*********** PEÑA NIETO PARTE 2  ************/
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
                   c.idCategoria NOT IN (80) AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND
                   (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR
        Texto like '%peñanietista%' OR
        Texto like '%penanietista%' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR
        Titulo like '% quique Pena %' OR
        Titulo like '%peñanietista%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %' OR
        Encabezado like '%peñanietista%'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion LIMIT 31, 60";
        return $query;
        break; /***********     FIN PEÑA     ************/

    case 7: /***********     PRIMERA DAMA    ************/
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria NOT IN (80) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Angelica Rivera%' OR
        Texto like '%Primera Dama de mexico%' OR

        Titulo like '%Angelica Rivera%' OR
        Titulo like '%Primera Dama de mexico%' OR

        Encabezado like '%Angelica Rivera%' OR
        Encabezado like '%Primera Dama de mexico%' OR

        Autor like '%Angelica Rivera%' OR
        Autor like '%Primera Dama de mexico%' OR

        PieFoto like '%Angelica Rivera%' OR
        PieFoto like '%Primera Dama de mexico%'
    ) AND (
        Texto not like '%Margarita Zavala%' AND
        Titulo not like '%Margarita Zavala%' AND
        Encabezado not like '%Margarita Zavala%' AND
        Autor not like '%Margarita Zavala%' AND
        PieFoto not like '%Margarita Zavala%'
    ) GROUP BY n.Periodico,n.NumeroPagina  ORDER BY o.posicion";
        return $query;
        break; //

    case 8: /***********     FUNCIONARIOS PRESIDENCIA     ************/
        $query = "SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria NOT IN (80) AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like 'Francisco Guzman Ortiz' OR
        Texto like '%oficina de la presidencia%' AND (Texto not like '%presidencia municipal%') OR 
        Texto like '%Erwin Lino zarate%' OR
        Texto like '%Lino zarate%' OR
        Texto like '%Erwin Lino%' OR
        
        Texto like '%Eduardo Sanchez Hernandez%' OR
        Texto like '%eduardo sanchez%' AND (Texto like '%presidencia de la republica%') OR
        Texto like '%coordinador de comunicacio social%' AND (Texto like '%presidencia de la republica%') OR
        Texto like '%vocero%' AND (Texto like '%presidencia de la republica%') OR
Texto like '%Andres Massieu Fernandez%' OR
Texto like '%Andres Massieu%' OR
Texto like '%Massieu Fernandez%' OR         
Texto like '%Carlos Perez Verdía Canales%' OR
Texto like '%Carlos Perez Verdía%' OR
Texto like '%Perez Verdía Canales%' OR
Texto like '%coordinador de asesores%' AND (Texto like '%presidencia de la republica%') OR
Texto like '%Rodrigo Gallart Juarez%' OR
Texto like '%Rodrigo Gallart%' OR
Texto like '%Gallart Juarez%' OR
Texto like '%Alejandra Lagunes Soto Ruiz%' OR
Texto like '%Alejandra Lagunes%' OR
Texto like '%Lagunes Soto Ruiz%' OR
Texto like '%Lagunes Soto%' OR
Texto like '%Carla Sanchez Armas Garcia%' OR
Texto like '%Sanchez Armas Garcia%' OR
Texto like '%Carla Sanchez Armas%' OR
Texto like '%Roberto Padilla Dominguez%' OR
Texto like '%Padilla Dominguez%' OR
Texto like '%Roberto Padilla%' AND (Texto like '%presidencia de la republica%') OR
Texto like '%Fred Rescala Jimenez%' OR
Texto like '%Fred Rescala%' OR
Texto like '%Rescala Jimenez%' OR
Texto like '%Elias Micha Zaga%' OR
Texto like '%Elias Micha%' OR
Texto like '%Micha Zaga%' OR
Texto like '%Tomas Zeron De Lucio%' OR
Texto like '%Tomas Zeron%' OR
Texto like '%Zeron De Lucio%' OR

Titulo like 'Francisco Guzman Ortiz' OR
        Titulo like '%oficina de la presidencia%' AND (Titulo not like '%presidencia municipal%') OR 
        Titulo like '%Erwin Lino zarate%' OR
        Titulo like '%Lino zarate%' OR
        Titulo like '%Erwin Lino%' OR
        
        Titulo like '%Eduardo Sanchez Hernandez%' OR
        Titulo like '%eduardo sanchez%' AND (Titulo like '%presidencia de la republica%') OR
        Titulo like '%coordinador de comunicacio social%' AND (Titulo like '%presidencia de la republica%') OR
        Titulo like '%vocero%' AND (Titulo like '%presidencia de la republica%') OR
Titulo like '%Andres Massieu Fernandez%' OR
Titulo like '%Andres Massieu%' OR
Titulo like '%Massieu Fernandez%' OR         
Titulo like '%Carlos Perez Verdía Canales%' OR
Titulo like '%Carlos Perez Verdía%' OR
Titulo like '%Perez Verdía Canales%' OR
Titulo like '%coordinador de asesores%' AND (Titulo like '%presidencia de la republica%') OR
Titulo like '%Rodrigo Gallart Juarez%' OR
Titulo like '%Rodrigo Gallart%' OR
Titulo like '%Gallart Juarez%' OR
Titulo like '%Alejandra Lagunes Soto Ruiz%' OR
Titulo like '%Alejandra Lagunes%' OR
Titulo like '%Lagunes Soto Ruiz%' OR
Titulo like '%Lagunes Soto%' OR
Titulo like '%Carla Sanchez Armas Garcia%' OR
Titulo like '%Sanchez Armas Garcia%' OR
Titulo like '%Carla Sanchez Armas%' OR
Titulo like '%Roberto Padilla Dominguez%' OR
Titulo like '%Padilla Dominguez%' OR
Titulo like '%Roberto Padilla%' AND (Titulo like '%presidencia de la republica%') OR
Titulo like '%Fred Rescala Jimenez%' OR
Titulo like '%Fred Rescala%' OR
Titulo like '%Rescala Jimenez%' OR
Titulo like '%Elias Micha Zaga%' OR
Titulo like '%Elias Micha%' OR
Titulo like '%Micha Zaga%' OR
Titulo like '%Tomas Zeron De Lucio%' OR
Titulo like '%Tomas Zeron%' OR
Titulo like '%Zeron De Lucio%' OR

Encabezado like 'Francisco Guzman Ortiz' OR
        Encabezado like '%oficina de la presidencia%' AND (Encabezado not like '%presidencia municipal%') OR 
        Encabezado like '%Erwin Lino zarate%' OR
        Encabezado like '%Lino zarate%' OR
        Encabezado like '%Erwin Lino%' OR
        
        Encabezado like '%Eduardo Sanchez Hernandez%' OR
        Encabezado like '%eduardo sanchez%' AND (Encabezado like '%presidencia de la republica%') OR
        Encabezado like '%coordinador de comunicacio social%' AND (Encabezado like '%presidencia de la republica%') OR
        Encabezado like '%vocero%' AND (Encabezado like '%presidencia de la republica%') OR
Encabezado like '%Andres Massieu Fernandez%' OR
Encabezado like '%Andres Massieu%' OR
Encabezado like '%Massieu Fernandez%' OR         
Encabezado like '%Carlos Perez Verdía Canales%' OR
Encabezado like '%Carlos Perez Verdía%' OR
Encabezado like '%Perez Verdía Canales%' OR
Encabezado like '%coordinador de asesores%' AND (Encabezado like '%presidencia de la republica%') OR
Encabezado like '%Rodrigo Gallart Juarez%' OR
Encabezado like '%Rodrigo Gallart%' OR
Encabezado like '%Gallart Juarez%' OR
Encabezado like '%Alejandra Lagunes Soto Ruiz%' OR
Encabezado like '%Alejandra Lagunes%' OR
Encabezado like '%Lagunes Soto Ruiz%' OR
Encabezado like '%Lagunes Soto%' OR
Encabezado like '%Carla Sanchez Armas Garcia%' OR
Encabezado like '%Sanchez Armas Garcia%' OR
Encabezado like '%Carla Sanchez Armas%' OR
Encabezado like '%Roberto Padilla Dominguez%' OR
Encabezado like '%Padilla Dominguez%' OR
Encabezado like '%Roberto Padilla%' AND (Encabezado like '%presidencia de la republica%') OR
Encabezado like '%Fred Rescala Jimenez%' OR
Encabezado like '%Fred Rescala%' OR
Encabezado like '%Rescala Jimenez%' OR
Encabezado like '%Elias Micha Zaga%' OR
Encabezado like '%Elias Micha%' OR
Encabezado like '%Micha Zaga%' OR
Encabezado like '%Tomas Zeron De Lucio%' OR
Encabezado like '%Tomas Zeron%' OR
Encabezado like '%Zeron De Lucio%' OR

PieFoto like 'Francisco Guzman Ortiz' OR
        PieFoto like '%oficina de la presidencia%' AND (PieFoto not like '%presidencia municipal%') OR 
        PieFoto like '%Erwin Lino zarate%' OR
        PieFoto like '%Lino zarate%' OR
        PieFoto like '%Erwin Lino%' OR
        
        PieFoto like '%Eduardo Sanchez Hernandez%' OR
        PieFoto like '%eduardo sanchez%' AND (PieFoto like '%presidencia de la republica%') OR
        PieFoto like '%coordinador de comunicacio social%' AND (PieFoto like '%presidencia de la republica%') OR
        PieFoto like '%vocero%' AND (PieFoto like '%presidencia de la republica%') OR
PieFoto like '%Andres Massieu Fernandez%' OR
PieFoto like '%Andres Massieu%' OR
PieFoto like '%Massieu Fernandez%' OR         
PieFoto like '%Carlos Perez Verdía Canales%' OR
PieFoto like '%Carlos Perez Verdía%' OR
PieFoto like '%Perez Verdía Canales%' OR
PieFoto like '%coordinador de asesores%' AND (PieFoto like '%presidencia de la republica%') OR
PieFoto like '%Rodrigo Gallart Juarez%' OR
PieFoto like '%Rodrigo Gallart%' OR
PieFoto like '%Gallart Juarez%' OR
PieFoto like '%Alejandra Lagunes Soto Ruiz%' OR
PieFoto like '%Alejandra Lagunes%' OR
PieFoto like '%Lagunes Soto Ruiz%' OR
PieFoto like '%Lagunes Soto%' OR
PieFoto like '%Carla Sanchez Armas Garcia%' OR
PieFoto like '%Sanchez Armas Garcia%' OR
PieFoto like '%Carla Sanchez Armas%' OR
PieFoto like '%Roberto Padilla Dominguez%' OR
PieFoto like '%Padilla Dominguez%' OR
PieFoto like '%Roberto Padilla%' AND (PieFoto like '%presidencia de la republica%') OR
PieFoto like '%Fred Rescala Jimenez%' OR
PieFoto like '%Fred Rescala%' OR
PieFoto like '%Rescala Jimenez%' OR
PieFoto like '%Elias Micha Zaga%' OR
PieFoto like '%Elias Micha%' OR
PieFoto like '%Micha Zaga%' OR
PieFoto like '%Tomas Zeron De Lucio%' OR
PieFoto like '%Tomas Zeron%' OR
PieFoto like '%Zeron De Lucio%' 

     )GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion";
        return $query;
        break; /***********     FIN FUNCIONARIOS PRESIDENCIA     ************/

    case 9: /***********     JEFE EMP     ************/
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
                   c.idCategoria NOT IN (80) AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND(
        Texto like '%Roberto Miranda Moreno%' OR
        Texto like '%Roberto Miranda%' OR
        Texto like '%Miranda Moreno%' OR
        Texto like '%Jefe del estado mayor presidencial%' OR

        Titulo like '%Roberto Miranda Moreno%' OR
        Titulo like '%Roberto Miranda%' OR
        Titulo like '%Miranda Moreno%' OR
        Titulo like '%Jefe del estado mayor presidencial%' OR

        Encabezado like '%Roberto Miranda Moreno%' OR
        Encabezado like '%Roberto Miranda%' OR
        Encabezado like '%Miranda Moreno%' OR
        Encabezado like '%Jefe del estado mayor presidencial%' OR

        Autor like '%Roberto Miranda Moreno%' OR
        Autor like '%Roberto Miranda%' OR
        Autor like '%Miranda Moreno%' OR
        Autor like '%Jefe del estado mayor presidencial%' OR

        PieFoto like '%Roberto Miranda Moreno%' OR
        PieFoto like '%Roberto Miranda%' OR
        PieFoto like '%Miranda Moreno%' OR
        PieFoto like '%Jefe del estado mayor presidencial%'
    ) GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion";
        return $query;
        break; //
    case 10: /***********     Estado Mayor Presidencial     ************/
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
                    c.idCategoria NOT IN (80) AND
                    p.Estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                    Texto like '%Estado mayor presidencial%' OR
                    Titulo like '%Estado mayor presidencial%' OR
                    Encabezado like '%Estado mayor presidencial%' OR
                    Autor like '%Estado mayor presidencial%' OR
                    PieFoto like '%Estado mayor presidencial%'
                )GROUP BY n.Periodico,n.NumeroPagina  ORDER BY o.posicion";
        return $query;
        break; /***********     FIN  Estado Mayor Presidencial     ************/


    case 16: /*********** PEÑA NIETO PARTE 1 ESTADOS ************/
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado != 9 AND
                   c.idCategoria NOT IN (80) AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND
                   (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR
        Texto like '%peñanietista%' OR
        Texto like '%penanietista%' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR
        Titulo like '% quique Pena %' OR
        Titulo like '%peñanietista%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %' OR
        Encabezado like '%peñanietista%'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY n.Periodico,n.NumeroPagina LIMIT 00, 30";
        return $query;
        break; //
    case 17: /*********** PEÑA NIETO PARTE 2 ESTADOS ************/
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.estado != 9 AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   c.idCategoria NOT IN (80) AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND
                   (
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR
        Texto like '%peñanietista%' OR
        Texto like '%penanietista%' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR
        Titulo like '% quique Pena %' OR
        Titulo like '%peñanietista%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %' OR
        Encabezado like '%peñanietista%'
 ) AND (
    Texto not like '%expresidente%' OR
    Titulo not like '%expresidente%' OR
    Encabezado not like '%expresidente%' OR
    PieFoto not like '%expresidente%' OR
    Autor not like '%expresidente%'
) GROUP BY n.Periodico,n.NumeroPagina LIMIT 31, 60";
        return $query;
        break; /***********     FIN PEÑA     ************/

    case 18: /***********     PRIMERA DAMA ESTADOS   ************/
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.estado != 9 AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   c.idCategoria NOT IN (80) AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND   (
        Texto like '%Angelica Rivera%' OR
        Texto like '%Primera Dama de mexico%' OR

        Titulo like '%Angelica Rivera%' OR
        Titulo like '%Primera Dama de mexico%' OR

        Encabezado like '%Angelica Rivera%' OR
        Encabezado like '%Primera Dama de mexico%' OR

        Autor like '%Angelica Rivera%' OR
        Autor like '%Primera Dama de mexico%' OR

        PieFoto like '%Angelica Rivera%' OR
        PieFoto like '%Primera Dama de mexico%'
    ) AND (
        Texto not like '%Margarita Zavala%' AND
        Titulo not like '%Margarita Zavala%' AND
        Encabezado not like '%Margarita Zavala%' AND
        Autor not like '%Margarita Zavala%' AND
        PieFoto not like '%Margarita Zavala%'
    )  GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; //
    case 19: /***********     FUNCIONARIOS PRESIDENCIA ESTADOS    ************/
        $query = "SELECT
                    n.idEditorial, n.Periodico as 'idPeriodico', p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf', e.Nombre as 'Estado'
                    FROM
                        noticiasDia n, periodicos p, seccionesPeriodicos s, categoriasPeriodicos c, estados e
                    WHERE
                        p.idPeriodico=n.Periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                        p.Estado=e.idEstado AND
                        c.idCategoria NOT IN (80) AND
                        e.idEstado <> 9 AND
                        n.Activo = 1 AND
                        n.Categoria<>80 AND
                        fecha = DATE('$fecha') AND (
                Texto like 'Francisco Guzman Ortiz' OR
        Texto like '%oficina de la presidencia%' AND (Texto not like '%presidencia municipal%') OR 
        Texto like '%Erwin Lino zarate%' OR
        Texto like '%Lino zarate%' OR
        Texto like '%Erwin Lino%' OR
        
        Texto like '%Eduardo Sanchez Hernandez%' OR
        Texto like '%eduardo sanchez%' AND (Texto like '%presidencia de la republica%') OR
        Texto like '%coordinador de comunicacio social%' AND (Texto like '%presidencia de la republica%') OR
        Texto like '%vocero%' AND (Texto like '%presidencia de la republica%') OR
Texto like '%Andres Massieu Fernandez%' OR
Texto like '%Andres Massieu%' OR
Texto like '%Massieu Fernandez%' OR         
Texto like '%Carlos Perez Verdía Canales%' OR
Texto like '%Carlos Perez Verdía%' OR
Texto like '%Perez Verdía Canales%' OR
Texto like '%coordinador de asesores%' AND (Texto like '%presidencia de la republica%') OR
Texto like '%Rodrigo Gallart Juarez%' OR
Texto like '%Rodrigo Gallart%' OR
Texto like '%Gallart Juarez%' OR
Texto like '%Alejandra Lagunes Soto Ruiz%' OR
Texto like '%Alejandra Lagunes%' OR
Texto like '%Lagunes Soto Ruiz%' OR
Texto like '%Lagunes Soto%' OR
Texto like '%Carla Sanchez Armas Garcia%' OR
Texto like '%Sanchez Armas Garcia%' OR
Texto like '%Carla Sanchez Armas%' OR
Texto like '%Roberto Padilla Dominguez%' OR
Texto like '%Padilla Dominguez%' OR
Texto like '%Roberto Padilla%' AND (Texto like '%presidencia de la republica%') OR
Texto like '%Fred Rescala Jimenez%' OR
Texto like '%Fred Rescala%' OR
Texto like '%Rescala Jimenez%' OR
Texto like '%Elias Micha Zaga%' OR
Texto like '%Elias Micha%' OR
Texto like '%Micha Zaga%' OR
Texto like '%Tomas Zeron De Lucio%' OR
Texto like '%Tomas Zeron%' OR
Texto like '%Zeron De Lucio%' OR

Titulo like 'Francisco Guzman Ortiz' OR
        Titulo like '%oficina de la presidencia%' AND (Titulo not like '%presidencia municipal%') OR 
        Titulo like '%Erwin Lino zarate%' OR
        Titulo like '%Lino zarate%' OR
        Titulo like '%Erwin Lino%' OR
        
        Titulo like '%Eduardo Sanchez Hernandez%' OR
        Titulo like '%eduardo sanchez%' AND (Titulo like '%presidencia de la republica%') OR
        Titulo like '%coordinador de comunicacio social%' AND (Titulo like '%presidencia de la republica%') OR
        Titulo like '%vocero%' AND (Titulo like '%presidencia de la republica%') OR
Titulo like '%Andres Massieu Fernandez%' OR
Titulo like '%Andres Massieu%' OR
Titulo like '%Massieu Fernandez%' OR         
Titulo like '%Carlos Perez Verdía Canales%' OR
Titulo like '%Carlos Perez Verdía%' OR
Titulo like '%Perez Verdía Canales%' OR
Titulo like '%coordinador de asesores%' AND (Titulo like '%presidencia de la republica%') OR
Titulo like '%Rodrigo Gallart Juarez%' OR
Titulo like '%Rodrigo Gallart%' OR
Titulo like '%Gallart Juarez%' OR
Titulo like '%Alejandra Lagunes Soto Ruiz%' OR
Titulo like '%Alejandra Lagunes%' OR
Titulo like '%Lagunes Soto Ruiz%' OR
Titulo like '%Lagunes Soto%' OR
Titulo like '%Carla Sanchez Armas Garcia%' OR
Titulo like '%Sanchez Armas Garcia%' OR
Titulo like '%Carla Sanchez Armas%' OR
Titulo like '%Roberto Padilla Dominguez%' OR
Titulo like '%Padilla Dominguez%' OR
Titulo like '%Roberto Padilla%' AND (Titulo like '%presidencia de la republica%') OR
Titulo like '%Fred Rescala Jimenez%' OR
Titulo like '%Fred Rescala%' OR
Titulo like '%Rescala Jimenez%' OR
Titulo like '%Elias Micha Zaga%' OR
Titulo like '%Elias Micha%' OR
Titulo like '%Micha Zaga%' OR
Titulo like '%Tomas Zeron De Lucio%' OR
Titulo like '%Tomas Zeron%' OR
Titulo like '%Zeron De Lucio%' OR

Encabezado like 'Francisco Guzman Ortiz' OR
        Encabezado like '%oficina de la presidencia%' AND (Encabezado not like '%presidencia municipal%') OR 
        Encabezado like '%Erwin Lino zarate%' OR
        Encabezado like '%Lino zarate%' OR
        Encabezado like '%Erwin Lino%' OR
        
        Encabezado like '%Eduardo Sanchez Hernandez%' OR
        Encabezado like '%eduardo sanchez%' AND (Encabezado like '%presidencia de la republica%') OR
        Encabezado like '%coordinador de comunicacio social%' AND (Encabezado like '%presidencia de la republica%') OR
        Encabezado like '%vocero%' AND (Encabezado like '%presidencia de la republica%') OR
Encabezado like '%Andres Massieu Fernandez%' OR
Encabezado like '%Andres Massieu%' OR
Encabezado like '%Massieu Fernandez%' OR         
Encabezado like '%Carlos Perez Verdía Canales%' OR
Encabezado like '%Carlos Perez Verdía%' OR
Encabezado like '%Perez Verdía Canales%' OR
Encabezado like '%coordinador de asesores%' AND (Encabezado like '%presidencia de la republica%') OR
Encabezado like '%Rodrigo Gallart Juarez%' OR
Encabezado like '%Rodrigo Gallart%' OR
Encabezado like '%Gallart Juarez%' OR
Encabezado like '%Alejandra Lagunes Soto Ruiz%' OR
Encabezado like '%Alejandra Lagunes%' OR
Encabezado like '%Lagunes Soto Ruiz%' OR
Encabezado like '%Lagunes Soto%' OR
Encabezado like '%Carla Sanchez Armas Garcia%' OR
Encabezado like '%Sanchez Armas Garcia%' OR
Encabezado like '%Carla Sanchez Armas%' OR
Encabezado like '%Roberto Padilla Dominguez%' OR
Encabezado like '%Padilla Dominguez%' OR
Encabezado like '%Roberto Padilla%' AND (Encabezado like '%presidencia de la republica%') OR
Encabezado like '%Fred Rescala Jimenez%' OR
Encabezado like '%Fred Rescala%' OR
Encabezado like '%Rescala Jimenez%' OR
Encabezado like '%Elias Micha Zaga%' OR
Encabezado like '%Elias Micha%' OR
Encabezado like '%Micha Zaga%' OR
Encabezado like '%Tomas Zeron De Lucio%' OR
Encabezado like '%Tomas Zeron%' OR
Encabezado like '%Zeron De Lucio%' OR

PieFoto like 'Francisco Guzman Ortiz' OR
        PieFoto like '%oficina de la presidencia%' AND (PieFoto not like '%presidencia municipal%') OR 
        PieFoto like '%Erwin Lino zarate%' OR
        PieFoto like '%Lino zarate%' OR
        PieFoto like '%Erwin Lino%' OR
        
        PieFoto like '%Eduardo Sanchez Hernandez%' OR
        PieFoto like '%eduardo sanchez%' AND (PieFoto like '%presidencia de la republica%') OR
        PieFoto like '%coordinador de comunicacio social%' AND (PieFoto like '%presidencia de la republica%') OR
        PieFoto like '%vocero%' AND (PieFoto like '%presidencia de la republica%') OR
PieFoto like '%Andres Massieu Fernandez%' OR
PieFoto like '%Andres Massieu%' OR
PieFoto like '%Massieu Fernandez%' OR         
PieFoto like '%Carlos Perez Verdía Canales%' OR
PieFoto like '%Carlos Perez Verdía%' OR
PieFoto like '%Perez Verdía Canales%' OR
PieFoto like '%coordinador de asesores%' AND (PieFoto like '%presidencia de la republica%') OR
PieFoto like '%Rodrigo Gallart Juarez%' OR
PieFoto like '%Rodrigo Gallart%' OR
PieFoto like '%Gallart Juarez%' OR
PieFoto like '%Alejandra Lagunes Soto Ruiz%' OR
PieFoto like '%Alejandra Lagunes%' OR
PieFoto like '%Lagunes Soto Ruiz%' OR
PieFoto like '%Lagunes Soto%' OR
PieFoto like '%Carla Sanchez Armas Garcia%' OR
PieFoto like '%Sanchez Armas Garcia%' OR
PieFoto like '%Carla Sanchez Armas%' OR
PieFoto like '%Roberto Padilla Dominguez%' OR
PieFoto like '%Padilla Dominguez%' OR
PieFoto like '%Roberto Padilla%' AND (PieFoto like '%presidencia de la republica%') OR
PieFoto like '%Fred Rescala Jimenez%' OR
PieFoto like '%Fred Rescala%' OR
PieFoto like '%Rescala Jimenez%' OR
PieFoto like '%Elias Micha Zaga%' OR
PieFoto like '%Elias Micha%' OR
PieFoto like '%Micha Zaga%' OR
PieFoto like '%Tomas Zeron De Lucio%' OR
PieFoto like '%Tomas Zeron%' OR
PieFoto like '%Zeron De Lucio%' 

     )GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY e.idEstado,p.Nombre    ";
        return $query;
        break; /***********     FIN FUNCIONARIOS PRESIDENCIA     ************/

    case 20: /***********     JEFE ESTADO MAYOR PRESIDENCIAL ESTADOS    ************/
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.estado != 9 AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria NOT IN (80) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
        Texto like '%Roberto Miranda Moreno%' OR
        Texto like '%Roberto Miranda%' OR
        Texto like '%Miranda Moreno%' OR
        Texto like '%Jefe del estado mayor presidencial%' OR

        Titulo like '%Roberto Miranda Moreno%' OR
        Titulo like '%Roberto Miranda%' OR
        Titulo like '%Miranda Moreno%' OR
        Titulo like '%Jefe del estado mayor presidencial%' OR

        Encabezado like '%Roberto Miranda Moreno%' OR
        Encabezado like '%Roberto Miranda%' OR
        Encabezado like '%Miranda Moreno%' OR
        Encabezado like '%Jefe del estado mayor presidencial%' OR

        Autor like '%Roberto Miranda Moreno%' OR
        Autor like '%Roberto Miranda%' OR
        Autor like '%Miranda Moreno%' OR
        Autor like '%Jefe del estado mayor presidencial%' OR

        PieFoto like '%Roberto Miranda Moreno%' OR
        PieFoto like '%Roberto Miranda%' OR
        PieFoto like '%Miranda Moreno%' OR
        PieFoto like '%Jefe del estado mayor presidencial%'
    )GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; //
    case 21: /***********     ESTADO MAYOR PRESIDENCIAL ESTADOS    ************/
        $query = "SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.estado != 9 AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria NOT IN (80) AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
        Texto like '%Estado mayor presidencial%' OR
        Titulo like '%Estado mayor presidencial%' OR
        Encabezado like '%Estado mayor presidencial%' OR
        Autor like '%Estado mayor presidencial%' OR
        PieFoto like '%Estado mayor presidencial%'
    ) GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; /***********     FIN ESTADO MAYOR PRESIDENCIAL     ************/

    default:
        break;
    }
}
