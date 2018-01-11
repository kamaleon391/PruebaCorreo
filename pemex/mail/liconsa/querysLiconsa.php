<?php

function numberNotes($optionCase, $fecha)
{
    $query     = query($optionCase, $fecha);
    $resultado = mysql_query($query);
    if (mysql_num_rows($resultado) > 0) {
        return true;
    }
    return false;
}

function query($op, $Tabla)
{
    $fecha         = $Tabla;
    $FechaCliente  = strtotime($Tabla);
    $fecha_actual1 = date('Y-m-d');
    $fecha_actual  = strtotime($fecha_actual1);
    if ($FechaCliente == $fecha_actual) {
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
                    p.estado=e.idEstado
                    GROUP BY n.NumeroPagina,p.idPeriodico
                    ORDER BY o.posicion
                    ";
            return $query;
            break; //Primeras Planas
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
                    fecha =DATE('$fecha')
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.id";
            return $query;
            break; //Columnas Politicas
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
                    p.estado=e.idEstado
                    GROUP BY n.idEditorial";
            return $query;
            break; //Columnas Financieras
        case 4:
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
                    fecha =DATE('$fecha')
                    GROUP BY n.idEditorial
                    ORDER BY o.posicion
                    ";
            return $query;
            break; // Cartones DF
        case 5: // hector pablo ramirez puga leyva
            $query = "SELECT n.idEditorial,
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

            ORDER BY o.posicion";
            return $query;
            break; //hector pablo ramirez puga leyva
        case 6: // GERENCIA
            $query = "SELECT n.idEditorial,
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

            ORDER BY o.posicion";
            return $query;
            break; // Gerencia Liconsa
        case 7: //  LICONSA
            $query = "SELECT n.idEditorial,
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

            ORDER BY o.posicion";
            return $query;
            break;
        case 8: //  LECHE
            $query = "SELECT n.idEditorial,
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
            ORDER BY o.posicion";
            return $query;
            break;
        case 9: //  SEDESOL
            $query = "SELECT n.idEditorial,
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
        Texto like '%Luis Enrique Miranda Nava%' OR
        Texto like '%Luis Enrique Miranda%' OR
        Titulo like '%sedesol%' OR
        Titulo like '%Luis Enrique Miranda Nava%' OR
        Titulo like '%Luis Enrique Miranda%' OR
        Titulo like '%secretaria de desarrollo social%' OR
        Encabezado like '%sedesol%' OR
        Encabezado like '%Luis Enrique Miranda Nava%' OR
        Encabezado like '%Luis Enrique Miranda%' OR
        Encabezado like '%secretaria de desarrollo social%'

)
            ORDER BY o.posicion";
            return $query;
            break;
        case 10: //  VARIOS
            $query = "SELECT n.idEditorial,
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
            ORDER BY o.posicion";
            return $query;
            break;
        case 11:
            $query = "SELECT
n.cutted,
     n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  p.String_Name AS StringName,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  n.Foto,
n.CREL as CREL,
  n.CostoNota,
  n.PieFoto
FROM
    noticiasDia n,
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
    fecha = CURDATE() AND
n.Activo = 1 AND
    p.Estado=e.idEstado AND (

        Texto like '%secretario de desarrollo social federal%' OR
        Texto like '%Luis Enrique Miranda Nava%' OR
        Texto like '%Luis Enrique Miranda%' OR
        Texto like '%Miranda Nava%' OR

        Titulo like '%secretario de desarrollo social federal%' OR
        Titulo like '%Luis Enrique Miranda Nava%' OR
        Titulo like '%Luis Enrique Miranda%' OR
        Titulo like '%Miranda Nava%' OR

        Encabezado like '%secretario de desarrollo social federal%' OR
        Encabezado like '%Luis Enrique Miranda Nava%' OR
        Encabezado like '%Luis Enrique Miranda%' OR
        Encabezado like '%Miranda Nava%' OR

        PieFoto like '%secretario de desarrollo social federal%' OR
        PieFoto like '%Luis Enrique Miranda Nava%' OR
        PieFoto like '%Luis Enrique Miranda%' OR
        PieFoto like '%Miranda Nava%' OR

        Autor like '%secretario de desarrollo social federal%' OR
        Autor like '%Luis Enrique Miranda Nava%' OR
        Autor like '%Luis Enrique Miranda%' OR
        Autor like '%Miranda Nava%'

)
GROUP BY idEditorial
ORDER BY o.posicion";
            return $query;
            break;
        default:
            break;
    }
}
