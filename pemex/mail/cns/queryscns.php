<?php

function numberNotes($optionCase, $fecha)
{
    $query = query($optionCase, $fecha, 0);
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
) GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion LIMIT 00, 30";
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

    case 7: /***********     SECRETARIO DE GOBERNACION    ************/
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
            Texto like '%secretario De gobernacion%' OR
            Texto like '%titular de la SEGOB%' OR
            Texto like '%titular de la secretaria de gobernacion%' OR
            Texto like '%miguel angel osorio chong%' OR
            Texto like 'miguel angel osorio chong' OR
            Texto like 'miguel osorio' OR
            Texto like '%Miguel Angel osorio%' OR
            Texto like '%Osorio Chong%' OR
            Texto like '%Osorio Chong%' OR
            Texto like '%sorio Chong%' OR
            Texto like '%OsorioChong%' OR
            Texto like '%sorio C hong%' OR
            Texto like '%sorio C h on g%' OR
            Texto like '%secretario Chong%' OR
            Texto like '%gobernachong%' OR
            Texto like '% chong %' OR

            Titulo like '%secretario De gobernacion%' OR
            Titulo like '%titular de la SEGOB%' OR
            Titulo like '%titular de la secretaria de gobernacion%' OR
            Titulo like '%miguel angel osorio chong%' OR
            Titulo like 'miguel angel osorio chong' OR
            Titulo like 'miguel osorio' OR
            Titulo like '%Miguel Angel osorio%' OR
            Titulo like '%Osorio Chong%' OR
            Titulo like '%Osorio Chong%' OR
            Titulo like '%sorio Chong%' OR
            Titulo like '%OsorioChong%' OR
            Titulo like '%sorio C hong%' OR
            Titulo like '%sorio C h on g%' OR
            Titulo like '%secretario Chong%' OR
            Titulo like '%gobernachong%' OR

            Encabezado like '%secretario De gobernacion%' OR
            Encabezado like '%titular de la SEGOB%' OR
            Encabezado like '%titular de la secretaria de gobernacion%' OR
            Encabezado like '%miguel angel osorio chong%' OR
            Encabezado like 'miguel angel osorio chong' OR
            Encabezado like 'miguel osorio' OR
            Encabezado like '%Miguel Angel osorio%' OR
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%sorio Chong%' OR
            Encabezado like '%OsorioChong%' OR
            Encabezado like '%sorio C hong%' OR
            Encabezado like '%sorio C h on g%' OR
            Encabezado like '%secretario Chong%' OR
            Encabezado like '%gobernachong%'

           )AND
           Texto not like '%El gobierno de michoacan concedio a la seccion 18%' AND
            (
                (Texto like '%Miguel Angel%' AND Texto like '%Osorio%') OR
                (Texto like '%Miguel Angel %' AND Texto like '%Osorio%')OR
                (Texto like '%Miguel%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%Miguel A.%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%titular de la SEGOB%' OR  Texto like '%Osorio Chong%' OR Texto like '%secretario chong%' OR Texto like '%Chong%') OR
                (Texto like '%SEGOB%' OR  Texto like '%Osorio Chong%' OR Texto like '%secretaria de gobernacion%' OR Texto like '%gobernacion%') OR
                 (Texto like '%ex secretaria de gobernacion%' OR Texto like '%ex Secretario de gobernacion%') OR

                (Titulo like '%Miguel Angel%' AND Titulo like '%Osorio%') OR
                (Titulo like '%Miguel Angel %' AND Titulo like '%Osorio%')OR
                (Titulo like '%Miguel%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%Miguel A.%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%titular de la SEGOB%' OR  Titulo like '%Osorio Chong%' OR Titulo like '%secretario chong%') OR
                (Titulo like '%SEGOB%' OR  Titulo like '%Osorio Chong%' OR Titulo like '%secretaria de gobernacion%' OR Titulo like '%gobernacion%') OR
                (Titulo like '%ex secretario de gobernacion%' OR Titulo like '%ex secretarío de gobernación%') OR

                (Encabezado like '%Miguel Angel%' AND Encabezado like '%Osorio%') OR
                (Encabezado like '%Miguel Angel %' AND Encabezado like '%Osorio%')OR
                (Encabezado like '%Miguel%' OR Encabezado like '%Osorio%' OR Encabezado like '%Chong%') OR
                (Encabezado like '%Miguel A.%' OR Encabezado like '%Osorio%' OR Encabezado like '%Chong%') OR
                (Encabezado like '%titular de la SEGOB%' OR  Encabezado like '%Osorio Chong%' OR Encabezado like '%secretario chong%') OR
                (Encabezado like '%ex secreario de gobernacion%' OR Encabezado like '%ex secretarío de gobernación%') OR
                (Encabezado like '%SEGOB%' OR  Encabezado like '%Osorio Chong%' OR Encabezado like '%secretaria de gobernacion%' OR Encabezado like '%gobernacion%')
            ) GROUP BY n.Periodico,n.NumeroPagina  ORDER BY o.posicion";
        return $query;
        break; //
    case 8: /***********     COMISIONADO DE SEGURIDAD     ************/
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
                Texto like '%Renato Sales Heredia%' OR 
                Texto like '%Sales Heredia%' OR
                Texto like '%Renato Sales%' OR

                Titulo like '%Renato Sales Heredia%' OR 
                Titulo like '%Sales Heredia%' OR
                Titulo like '%Renato Sales%' OR
                
                Encabezado like '%Renato Sales Heredia%' OR 
                Encabezado like '%Sales Heredia%' OR
                Encabezado like '%Renato Sales%' OR
                
                PieFoto like '%Renato Sales Heredia%' OR 
                PieFoto like '%Sales Heredia%' OR
                PieFoto like '%Renato Sales%' OR
                
                Autor like '%Renato Sales Heredia%' OR 
                Autor like '%Sales Heredia%' OR
                Autor like '%Renato Sales%'
       )GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion";
        return $query;
        break; /***********     FIN COMISIONADO     ************/

    case 9: /***********     CNS     ************/
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
    Texto like '%Comision nacional de seguridad%' OR
    Texto like '% CNS %' OR

    Titulo like '%Comision nacional de seguridad%' OR
    Titulo like '% CNS %' OR

    Encabezado like '%Comision nacional de seguridad%' OR
    Encabezado like '% CNS %' OR

    PieFoto like '%Comision nacional de seguridad%' OR
    PieFoto like '% CNS %' OR

    Autor like '%Comision nacional de seguridad%' OR
    Autor like '% CNS %'
                    ) GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion";
        return $query;
        break; //
    case 10: /***********     PF     ************/
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

                    Texto like '%Policia Federal%' OR
                    Titulo like '%Policia Federal%' OR
                    Encabezado like '%Policia Federal%' OR
                    PieFoto like '%Policia Federal%' OR
                    Autor like '%Policia Federal%'
                    )  GROUP BY n.Periodico,n.NumeroPagina  ORDER BY o.posicion";
        return $query;
        break; /***********     FIN PF     ************/

    case 11: /***********     PREVENCION Y READAPTACION SOCIAL     ************/
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
                   fecha =DATE('$fecha') AND
                    (
                        Texto like '%prevencion y readaptacion social%' OR
                        Titulo like '%prevencion y readaptacion social%' OR
                        Encabezado like '%prevencion y readaptacion social%' OR
                        PieFoto like '%prevencion y readaptacion social%' OR
                        Autor like '%prevencion y readaptacion social%'
                    )  GROUP BY n.Periodico,n.NumeroPagina  ORDER BY o.posicion";
        return $query;
        break; //
    case 12: /***********     SERVICIO DE PROTECCION FEDERAL     ************/
        $query = "SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    p.idPeriodico=o.periodico AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria NOT IN (80) AND
                    p.Estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                (
                    Texto like '%servicio de proteccion federal%' OR
                    Titulo like '%servicio de proteccion federal%' OR
                    Encabezado like '%servicio de proteccion federal%' OR
                    PieFoto like '%servicio de proteccion federal%' OR
                    Autor like '%servicio de proteccion federal%'
                )  GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion";
        return $query;
        break; /***********     FIN SERVICIO PROTECCION FEDERAL     ************/

    case 13: /***********     PGR     ************/
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
                   fecha =DATE('$fecha') AND
                   (

    Texto like '%procuraduria general de la republica%' OR
    Texto like '% PGR %' OR
    Texto like '%Arely gomez gonzalez%' OR
    Titulo like '%procuraduria general de la republica%' OR
    Titulo like '% PGR %' OR
    Titulo like '%Arely gomez gonzalez%'    OR
    Encabezado like '%procuraduria general de la republica%' OR
    Encabezado like '% PGR %' OR
    Encabezado like '%Arely gomez gonzalez%'    OR
    Piefoto like '%procuraduria general de la republica%' OR
    Piefoto like '% PGR %' OR
    Piefoto like '%Arely gomez gonzalez%'   OR
    Autor like '%procuraduria general de la republica%' OR
    Autor like '% PGR %' OR
    Autor like '%Arely gomez gonzalez%'

  ) GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion";
        return $query;
        break; //
    case 14: /***********     SEDENA     ************/
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
                    fecha =DATE('$fecha') AND
(
    Texto like '%secretaria de la defensa nacional%' OR
    Texto like '% SEDENA %' OR
    Texto like '%Salvador cienfuegos zepeda%' OR
    Texto like '%cienfuegos zepeda%' OR

    Titulo like '%secretaria de la defensa nacional%' OR
    Titulo like '% SEDENA %' OR
    Titulo like '%Salvador cienfuegos zepeda%' OR
    Titulo like '%cienfuegos zepeda%' OR

    Encabezado like '%secretaria de la defensa nacional%' OR
    Encabezado like '% SEDENA %' OR
    Encabezado like '%Salvador cienfuegos zepeda%' OR
    Encabezado like '%cienfuegos zepeda%' OR

    PieFoto like '%secretaria de la defensa nacional%' OR
    PieFoto like '% SEDENA %' OR
    PieFoto like '%Salvador cienfuegos zepeda%' OR
    PieFoto like '%cienfuegos zepeda%' OR

    Autor like '%secretaria de la defensa nacional%' OR
    Autor like '% SEDENA %' OR
    Autor like '%Salvador cienfuegos zepeda%' OR
    Autor like '%cienfuegos zepeda%'
  )  GROUP BY n.Periodico,n.NumeroPagina   ORDER BY o.posicion";
        return $query;
        break; /***********     FIN SEDENA     ************/

    case 15: /***********     SEMAR     ************/
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
                    fecha =DATE('$fecha') AND
(
    Texto like '%secretaria de Marina%' OR
    Texto like '% SEMAR %' OR
    Texto like '%Vidal Francisco soberon sanz%' OR
    Texto like '%soberon sanz%' OR

    Titulo like '%secretaria de Marina%' OR
    Titulo like '% SEMAR %' OR
    Titulo like '%Vidal Francisco soberon sanz%' OR
    Titulo like '%soberon sanz%' OR

    Encabezado like '%secretaria de Marina%' OR
    Encabezado like '% SEMAR %' OR
    Encabezado like '%Vidal Francisco soberon sanz%' OR
    Encabezado like '%soberon sanz%' OR

    PieFoto like '%secretaria de Marina%' OR
    PieFoto like '% SEMAR %' OR
    PieFoto like '%Vidal Francisco soberon sanz%' OR
    PieFoto like '%soberon sanz%' OR

    Autor like '%secretaria de Marina%' OR
    Autor like '% SEMAR %' OR
    Autor like '%Vidal Francisco soberon sanz%' OR
    Autor like '%soberon sanz%'
  ) GROUP BY n.Periodico,n.NumeroPagina ORDER BY o.posicion";
        return $query;
        break; /***********     FIN SEDENA     ************/

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

    case 18: /***********     SECRETARIO DE GOBERNACION ESTADOS   ************/
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
            Texto like '%secretario De gobernacion%' OR
            Texto like '%titular de la SEGOB%' OR
            Texto like '%titular de la secretaria de gobernacion%' OR
            Texto like '%miguel angel osorio chong%' OR
            Texto like 'miguel angel osorio chong' OR
            Texto like 'miguel osorio' OR
            Texto like '%Miguel Angel osorio%' OR
            Texto like '%Osorio Chong%' OR
            Texto like '%Osorio Chong%' OR
            Texto like '%sorio Chong%' OR
            Texto like '%OsorioChong%' OR
            Texto like '%sorio C hong%' OR
            Texto like '%sorio C h on g%' OR
            Texto like '%secretario Chong%' OR
            Texto like '%gobernachong%' OR
            Texto like '% chong %' OR
            Texto like '% segob %' OR
            Texto like '% secretaria de gobernacion %' OR

            Titulo like '%secretario De gobernacion%' OR
            Titulo like '%titular de la SEGOB%' OR
            Titulo like '%titular de la secretaria de gobernacion%' OR
            Titulo like '%miguel angel osorio chong%' OR
            Titulo like 'miguel angel osorio chong' OR
            Titulo like 'miguel osorio' OR
            Titulo like '%Miguel Angel osorio%' OR
            Titulo like '%Osorio Chong%' OR
            Titulo like '%Osorio Chong%' OR
            Titulo like '%sorio Chong%' OR
            Titulo like '%OsorioChong%' OR
            Titulo like '%sorio C hong%' OR
            Titulo like '%sorio C h on g%' OR
            Titulo like '%secretario Chong%' OR
            Titulo like '%gobernachong%' OR
            Titulo like '% segob %' OR
            Titulo like '% secretaria de gobernacion %' OR

            Encabezado like '%secretario De gobernacion%' OR
            Encabezado like '%titular de la SEGOB%' OR
            Encabezado like '%titular de la secretaria de gobernacion%' OR
            Encabezado like '%miguel angel osorio chong%' OR
            Encabezado like 'miguel angel osorio chong' OR
            Encabezado like 'miguel osorio' OR
            Encabezado like '%Miguel Angel osorio%' OR
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%sorio Chong%' OR
            Encabezado like '%OsorioChong%' OR
            Encabezado like '%sorio C hong%' OR
            Encabezado like '%sorio C h on g%' OR
            Encabezado like '%secretario Chong%' OR
            Encabezado like '%gobernachong%' OR
            Encabezado like '% segob %' OR
            Encabezado like '% secretaria de gobernacion %'

           )AND
           Texto not like '%El gobierno de michoacan concedio a la seccion 18%' AND
            (
                (Texto like '%Miguel Angel%' AND Texto like '%Osorio%') OR
                (Texto like '%Miguel Angel %' AND Texto like '%Osorio%')OR
                (Texto like '%Miguel%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%Miguel A.%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%titular de la SEGOB%' OR  Texto like '%Osorio Chong%' OR Texto like '%secretario chong%' OR Texto like '%Chong%') OR
                (Texto like '%SEGOB%' OR  Texto like '%Osorio Chong%' OR Texto like '%secretaria de gobernacion%' OR Texto like '%gobernacion%') OR
                 (Texto like '%ex secretaria de gobernacion%' OR Texto like '%ex Secretario de gobernacion%') OR

                (Titulo like '%Miguel Angel%' AND Titulo like '%Osorio%') OR
                (Titulo like '%Miguel Angel %' AND Titulo like '%Osorio%')OR
                (Titulo like '%Miguel%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%Miguel A.%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%titular de la SEGOB%' OR  Titulo like '%Osorio Chong%' OR Titulo like '%secretario chong%') OR
                (Titulo like '%SEGOB%' OR  Titulo like '%Osorio Chong%' OR Titulo like '%secretaria de gobernacion%' OR Titulo like '%gobernacion%') OR
                (Titulo like '%ex secretario de gobernacion%' OR Titulo like '%ex secretarío de gobernación%') OR

                (Encabezado like '%Miguel Angel%' AND Encabezado like '%Osorio%') OR
                (Encabezado like '%Miguel Angel %' AND Encabezado like '%Osorio%')OR
                (Encabezado like '%Miguel%' OR Encabezado like '%Osorio%' OR Encabezado like '%Chong%') OR
                (Encabezado like '%Miguel A.%' OR Encabezado like '%Osorio%' OR Encabezado like '%Chong%') OR
                (Encabezado like '%titular de la SEGOB%' OR  Encabezado like '%Osorio Chong%' OR Encabezado like '%secretario chong%') OR
                (Encabezado like '%ex secreario de gobernacion%' OR Encabezado like '%ex secretarío de gobernación%') OR
                (Encabezado like '%SEGOB%' OR  Encabezado like '%Osorio Chong%' OR Encabezado like '%secretaria de gobernacion%' OR Encabezado like '%gobernacion%')
            )  GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; //
    case 19: /***********     COMISIONADO DE SEGURIDAD ESTADOS    ************/
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
                        fecha = DATE('$fecha') AND  (
                Texto like '%Renato Sales Heredia%' OR 
                Texto like '%Sales Heredia%' OR
                Texto like '%Renato Sales%' OR

                Titulo like '%Renato Sales Heredia%' OR 
                Titulo like '%Sales Heredia%' OR
                Titulo like '%Renato Sales%' OR
                
                Encabezado like '%Renato Sales Heredia%' OR 
                Encabezado like '%Sales Heredia%' OR
                Encabezado like '%Renato Sales%' OR
                
                PieFoto like '%Renato Sales Heredia%' OR 
                PieFoto like '%Sales Heredia%' OR
                PieFoto like '%Renato Sales%' OR
                
                Autor like '%Renato Sales Heredia%' OR 
                Autor like '%Sales Heredia%' OR
                Autor like '%Renato Sales%'
       ) GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY e.idEstado,p.Nombre    ";
        return $query;
        break; /***********     FIN COMISIONADO     ************/

    case 20: /***********     CNS ESTADOS    ************/
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
                   fecha =DATE('$fecha') AND
                    (
    Texto like '%Comision nacional de seguridad%' OR
    Texto like '% CNS %' OR

    Titulo like '%Comision nacional de seguridad%' OR
    Titulo like '% CNS %' OR

    Encabezado like '%Comision nacional de seguridad%' OR
    Encabezado like '% CNS %' OR

    PieFoto like '%Comision nacional de seguridad%' OR
    PieFoto like '% CNS %' OR

    Autor like '%Comision nacional de seguridad%' OR
    Autor like '% CNS %'
                    ) GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; //
    case 21: /***********     PF ESTADOS    ************/
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

                    Texto like '%Policia Federal%' OR
                    Titulo like '%Policia Federal%' OR
                    Encabezado like '%Policia Federal%' OR
                    PieFoto like '%Policia Federal%' OR
                    Autor like '%Policia Federal%'
                    )  GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; /***********     FIN PF     ************/

    case 22: /***********     PREVENCION Y READAPTACION SOCIAL ESTADOS    ************/
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
                        Texto like '%prevencion y readaptacion social%' OR
                        Titulo like '%prevencion y readaptacion social%' OR
                        Encabezado like '%prevencion y readaptacion social%' OR
                        PieFoto like '%prevencion y readaptacion social%' OR
                        Autor like '%prevencion y readaptacion social%'
                    )  GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; //
    case 23: /***********     SERVICIO DE PROTECCION FEDERAL ESTADOS    ************/
        $query = "SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                    WHERE p.idPeriodico=n.Periodico AND
                   p.estado != 9 AND
                    p.idPeriodico=o.periodico AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria NOT IN (80) AND
                    p.Estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                (
                    Texto like '%servicio de proteccion federal%' OR
                    Titulo like '%servicio de proteccion federal%' OR
                    Encabezado like '%servicio de proteccion federal%' OR
                    PieFoto like '%servicio de proteccion federal%' OR
                    Autor like '%servicio de proteccion federal%'
                )  GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break; /***********     FIN SERVICIO PROTECCION FEDERAL     ************/

    case 24: /***********     PGR ESTADOS    ************/
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
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND
                   (

    Texto like '%procuraduria general de la republica%' OR
    Texto like '% PGR %' OR
    Texto like '%Arely gomez gonzalez%' OR
    Titulo like '%procuraduria general de la republica%' OR
    Titulo like '% PGR %' OR
    Titulo like '%Arely gomez gonzalez%'    OR
    Encabezado like '%procuraduria general de la republica%' OR
    Encabezado like '% PGR %' OR
    Encabezado like '%Arely gomez gonzalez%'    OR
    Piefoto like '%procuraduria general de la republica%' OR
    Piefoto like '% PGR %' OR
    Piefoto like '%Arely gomez gonzalez%'   OR
    Autor like '%procuraduria general de la republica%' OR
    Autor like '% PGR %' OR
    Autor like '%Arely gomez gonzalez%'

  ) GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; //
    case 25: /***********     SEDENA ESTADOS    ************/
        $query = "SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                    WHERE p.idPeriodico=n.Periodico AND
                   p.estado != 9 AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria NOT IN (80) AND
                    p.Estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
(
    Texto like '%secretaria de la defensa nacional%' OR
    Texto like '% SEDENA %' OR
    Texto like '%Salvador cienfuegos zepeda%' OR
    Texto like '%cienfuegos zepeda%' OR

    Titulo like '%secretaria de la defensa nacional%' OR
    Titulo like '% SEDENA %' OR
    Titulo like '%Salvador cienfuegos zepeda%' OR
    Titulo like '%cienfuegos zepeda%' OR

    Encabezado like '%secretaria de la defensa nacional%' OR
    Encabezado like '% SEDENA %' OR
    Encabezado like '%Salvador cienfuegos zepeda%' OR
    Encabezado like '%cienfuegos zepeda%' OR

    PieFoto like '%secretaria de la defensa nacional%' OR
    PieFoto like '% SEDENA %' OR
    PieFoto like '%Salvador cienfuegos zepeda%' OR
    PieFoto like '%cienfuegos zepeda%' OR

    Autor like '%secretaria de la defensa nacional%' OR
    Autor like '% SEDENA %' OR
    Autor like '%Salvador cienfuegos zepeda%' OR
    Autor like '%cienfuegos zepeda%'
  )  GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; /***********     FIN SEDENA     ************/

    case 26: /***********     SEMAR ESTADOS    ************/
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
                    p.Estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
(
    Texto like '%secretaria de Marina%' OR
    Texto like '% SEMAR %' OR
    Texto like '%Vidal Francisco soberon sanz%' OR
    Texto like '%soberon sanz%' OR

    Titulo like '%secretaria de Marina%' OR
    Titulo like '% SEMAR %' OR
    Titulo like '%Vidal Francisco soberon sanz%' OR
    Titulo like '%soberon sanz%' OR

    Encabezado like '%secretaria de Marina%' OR
    Encabezado like '% SEMAR %' OR
    Encabezado like '%Vidal Francisco soberon sanz%' OR
    Encabezado like '%soberon sanz%' OR

    PieFoto like '%secretaria de Marina%' OR
    PieFoto like '% SEMAR %' OR
    PieFoto like '%Vidal Francisco soberon sanz%' OR
    PieFoto like '%soberon sanz%' OR

    Autor like '%secretaria de Marina%' OR
    Autor like '% SEMAR %' OR
    Autor like '%Vidal Francisco soberon sanz%' OR
    Autor like '%soberon sanz%'
  ) GROUP BY n.Periodico,n.NumeroPagina ";
        return $query;
        break; /***********     FIN SEDENA     ************/

    default:
        break;
    }
}
