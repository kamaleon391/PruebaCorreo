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

function query($op, $Tabla)
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

        case 5: //Manuel Mondragon y Kalb
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
                      Texto like '%secretaria de salud del DF%' OR
                      Texto like '%secretaria de salud CDMX%' OR
                      Texto like '%Salud DF%' OR
                      Texto like '%secretaria de salud del distrito federal%' OR
                      Texto like '%SEDESA%' OR

                      Titulo like '%secretaria de salud del DF%' OR
                      Titulo like '%secretaria de salud CDMX%' OR
                      Titulo like '%Salud DF%' OR
                      Titulo like '%secretaria de salud del distrito federal%' OR
                      Titulo like '%SEDESA%' OR

                      Encabezado like '%secretaria de salud del DF%' OR
                      Encabezado like '%secretaria de salud CDMX%' OR
                      Encabezado like '%Salud DF%' OR
                      Encabezado like '%secretaria de salud del distrito federal%' OR
                      Encabezado like '%SEDESA%' OR

                      Autor like '%secretaria de salud del DF%' OR
                      Autor like '%secretaria de salud CDMX%' OR
                      Autor like '%Salud DF%' OR
                      Autor like '%secretaria de salud del distrito federal%' OR
                      Autor like '%SEDESA%' OR

                      PieFoto like '%secretaria de salud del DF%' OR
                      PieFoto like '%secretaria de salud CDMX%' OR
                      PieFoto like '%Salud DF%' OR
                      PieFoto like '%secretaria de salud del distrito federal%' OR
                      PieFoto like '%SEDESA%' 
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        case 6: //Manuel Mondragon y Kalb
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
                      Texto like '%Armando Ahued%' OR
                      Texto like '%Armando Ahued Ortega%' OR
                      Texto like '%secretario de salud CDMX%' OR

                      Titulo like '%Armando Ahued%' OR
                      Titulo like '%Armando Ahued Ortega%' OR
                      Titulo like '%secretario de salud CDMX%' OR

                      Encabezado like '%Armando Ahued%' OR
                      Encabezado like '%Armando Ahued Ortega%' OR
                      Encabezado like '%secretario de salud CDMX%' OR

                      Autor like '%Armando Ahued%' OR
                      Autor like '%Armando Ahued Ortega%' OR
                      Autor like '%secretario de salud CDMX%' OR

                      PieFoto like '%Armando Ahued%' OR
                      PieFoto like '%Armando Ahued Ortega%' OR
                      PieFoto like '%secretario de salud CDMX%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        case 7: //Jefe de Gobierno
            $query = "SELECT * FROM (
(
SELECT
  n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  p.String_Name as StringName,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Hora,
  n.Encabezado,
  n.Foto,
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
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND   (
    Texto like '%Miguel Angel Mancera Espinosa%' OR
    Texto like '%Miguel Angel Mancera%' OR
    Texto like '%Miguel Mancera Espinosa%' OR
    Texto like '%Mancera Espinosa%' OR
    Texto like '%Jefe de Gobierno%' OR

    Titulo like '%Miguel Angel Mancera Espinosa%' OR
    Titulo like '%Miguel Angel Mancera%' OR
    Titulo like '%Miguel Mancera Espinosa%' OR
    Titulo like '%Mancera Espinosa%' OR
    Titulo like '%Jefe de Gobierno%' OR

    Encabezado like '%Miguel Angel Mancera Espinosa%' OR
    Encabezado like '%Miguel Angel Mancera%' OR
    Encabezado like '%Miguel Mancera Espinosa%' OR
    Encabezado like '%Mancera Espinosa%' OR
    Encabezado like '%Jefe de Gobierno%' OR

    Autor like '%Miguel Angel Mancera Espinosa%' OR
    Autor like '%Miguel Angel Mancera%' OR
    Autor like '%Miguel Mancera Espinosa%' OR
    Autor like '%Mancera Espinosa%' OR
    Autor like '%Jefe de Gobierno%' OR

    PieFoto like '%Miguel Angel Mancera Espinosa%' OR
    PieFoto like '%Miguel Angel Mancera%' OR
    PieFoto like '%Miguel Mancera Espinosa%' OR
    PieFoto like '%Mancera Espinosa%' OR
    PieFoto like '%Jefe de Gobierno%'
  ) AND (
    Texto like '%salud%' OR
    Texto  like '%medicina%' OR
    Texto  like '%clinica%' OR
    Texto  like '%eutanasia%' OR
    Texto  like '%hospital%' OR
    Texto  like '%salubridad%' OR

    Titulo  like '%salud%' OR
    Titulo  like '%medicina%' OR
    Titulo  like '%clinica%' OR
    Titulo  like '%eutanasia%' OR
    Titulo  like '%hospital%' OR
    Titulo  like '%salubridad%' OR

    Encabezado  like '%salud%' OR
    Encabezado  like '%medicina%' OR
    Encabezado  like '%clinica%' OR
    Encabezado  like '%eutanasia%' OR
    Encabezado  like '%hospital%' OR
    Encabezado  like '%salubridad%' OR

    Autor  like '%salud%' OR
    Autor  like '%medicina%' OR
    Autor  like '%clinica%' OR
    Autor  like '%eutanasia%' OR
    Autor  like '%hospital%' OR
    Autor  like '%salubridad%' OR

    PieFoto  like '%salud%' OR
    PieFoto  like '%medicina%'OR 
    PieFoto  like '%clinica%' OR
    PieFoto  like '%eutanasia%' OR
    PieFoto  like '%hospital%' OR
    PieFoto  like '%salubridad%'

  )  
ORDER BY o.posicion
)
UNION (


SELECT
  n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  p.String_Name as StringName,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Hora,
  n.Encabezado,
  n.Foto,
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
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND   (
    Texto like '%Miguel Angel Mancera Espinosa%' OR
    Texto like '%Miguel Angel Mancera%' OR
    Texto like '%Miguel Mancera Espinosa%' OR
    Texto like '%Mancera Espinosa%' OR
    Texto like '%Jefe de Gobierno%' OR

    Titulo like '%Miguel Angel Mancera Espinosa%' OR
    Titulo like '%Miguel Angel Mancera%' OR
    Titulo like '%Miguel Mancera Espinosa%' OR
    Titulo like '%Mancera Espinosa%' OR
    Titulo like '%Jefe de Gobierno%' OR

    Encabezado like '%Miguel Angel Mancera Espinosa%' OR
    Encabezado like '%Miguel Angel Mancera%' OR
    Encabezado like '%Miguel Mancera Espinosa%' OR
    Encabezado like '%Mancera Espinosa%' OR
    Encabezado like '%Jefe de Gobierno%' OR

    Autor like '%Miguel Angel Mancera Espinosa%' OR
    Autor like '%Miguel Angel Mancera%' OR
    Autor like '%Miguel Mancera Espinosa%' OR
    Autor like '%Mancera Espinosa%' OR
    Autor like '%Jefe de Gobierno%' OR

    PieFoto like '%Miguel Angel Mancera Espinosa%' OR
    PieFoto like '%Miguel Angel Mancera%' OR
    PieFoto like '%Miguel Mancera Espinosa%' OR
    PieFoto like '%Mancera Espinosa%' OR
    PieFoto like '%Jefe de Gobierno%'
  ) AND (
    Texto not like '%salud%' AND
    Texto not like '%medicina%' AND
    Texto not like '%clinica%' AND
    Texto not like '%eutanasia%' AND
    Texto not like '%hospital%' AND
    Texto not like '%salubridad%' AND

    Titulo not like '%salud%' AND
    Titulo not like '%medicina%' AND
    Titulo not like '%clinica%' AND
    Titulo not like '%eutanasia%' AND
    Titulo not like '%hospital%' AND
    Titulo not like '%salubridad%' AND

    Encabezado not like '%salud%' AND
    Encabezado not like '%medicina%' AND
    Encabezado not like '%clinica%' AND
    Encabezado not like '%eutanasia%' AND
    Encabezado not like '%hospital%' AND
    Encabezado not like '%salubridad%' AND

    Autor not like '%salud%' AND
    Autor not like '%medicina%' AND
    Autor not like '%clinica%' AND
    Autor not like '%eutanasia%' AND
    Autor not like '%hospital%' AND
    Autor not like '%salubridad%' AND

    PieFoto not like '%salud%' AND
    PieFoto not like '%medicina%'AND 
    PieFoto not like '%clinica%' AND
    PieFoto not like '%eutanasia%' AND
    PieFoto not like '%hospital%' AND
    PieFoto not like '%salubridad%'

  )
  GROUP BY idPeriodico,PaginaPeriodico  
  ORDER BY o.posicion
)

) derived";
            return $query;
            break;

        case 8: //Gobernador
            $query = "SELECT * FROM (
(
SELECT
  n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  p.String_Name as StringName,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Hora,
  n.Encabezado,
  n.Foto,
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
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND   (
    Texto like '%Patricia Mercado%' OR
    Texto like '%Salomon Chertorivsk%' OR
    Texto like '%Jose Ramon Ameiva%' OR
    Texto like '%Tanya M_ller%' OR
    Texto like '%Rodolfo Rios%' OR
    Texto like '%Hector Serrano%' OR
    Texto like '%Fausto Lugo Garcia%' OR
    Texto like '%Perla Gomez%' OR
    Texto like '%Presidenta de la CDHDF%' OR
    Texto like '%SEMOVI%' OR
    Texto like '%SEDEMA%' OR
    Texto like '% SSP %' OR
    Texto like '%PGJ%' OR

    Titulo like '%Patricia Mercado%' OR
    Titulo like '%Salomon Chertorivsk%' OR
    Titulo like '%Jose Ramon Ameiva%' OR
    Titulo like '%Tanya M_ller%' OR
    Titulo like '%Rodolfo Rios%' OR
    Titulo like '%Hector Serrano%' OR
    Titulo like '%Fausto Lugo Garcia%' OR
    Titulo like '%Perla Gomez%' OR
    Titulo like '%Presidenta de la CDHDF%' OR
    Titulo like '%SEMOVI%' OR
    Titulo like '%SEDEMA%' OR
    Titulo like '%SSP%' OR
    Titulo like '%PGJ%' OR


    Encabezado like '%Patricia Mercado%' OR
    Encabezado like '%Salomon Chertorivsk%' OR
    Encabezado like '%Jose Ramon Ameiva%' OR
    Encabezado like '%Tanya M_ller%' OR
    Encabezado like '%Rodolfo Rios%' OR
    Encabezado like '%Hector Serrano%' OR
    Encabezado like '%Fausto Lugo Garcia%' OR
    Encabezado like '%Perla Gomez%' OR
    Encabezado like '%Presidenta de la CDHDF%' OR
    Encabezado like '%SEMOVI%' OR
    Encabezado like '%SEDEMA%' OR
    Encabezado like '%SSP%' OR
    Encabezado like '%PGJ%' OR

    Autor like '%Patricia Mercado%' OR
    Autor like '%Salomon Chertorivsk%' OR
    Autor like '%Jose Ramon Ameiva%' OR
    Autor like '%Tanya M_ller%' OR
    Autor like '%Rodolfo Rios%' OR
    Autor like '%Hector Serrano%' OR
    Autor like '%Fausto Lugo Garcia%' OR
    Autor like '%Perla Gomez%' OR
    Autor like '%Presidenta de la CDHDF%' OR
    Autor like '%SEMOVI%' OR
    Autor like '%SEDEMA%' OR
    Autor like '%SSP%' OR
    Autor like '%PGJ%' OR

    PieFoto like '%Patricia Mercado%' OR
    PieFoto like '%Salomon Chertorivsk%' OR
    PieFoto like '%Jose Ramon Ameiva%' OR
    PieFoto like '%Tanya M_ller%' OR
    PieFoto like '%Rodolfo Rios%' OR
    PieFoto like '%Hector Serrano%' OR
    PieFoto like '%Fausto Lugo Garcia%' OR
    PieFoto like '%Perla Gomez%' OR
    PieFoto like '%Presidenta de la CDHDF%' OR
    PieFoto like '%SEMOVI%' OR
    PieFoto like '%SEDEMA%' OR
    PieFoto like '%SSP%' OR
    PieFoto like '%PGJ%' 
  ) AND (
    Texto like '%salud%' OR
    Texto  like '%medicina%' OR
    Texto  like '%clinica%' OR
    Texto  like '%eutanasia%' OR
    Texto  like '%hospital%' OR
    Texto  like '%salubridad%' OR

    Titulo  like '%salud%' OR
    Titulo  like '%medicina%' OR
    Titulo  like '%clinica%' OR
    Titulo  like '%eutanasia%' OR
    Titulo  like '%hospital%' OR
    Titulo  like '%salubridad%' OR

    Encabezado  like '%salud%' OR
    Encabezado  like '%medicina%' OR
    Encabezado  like '%clinica%' OR
    Encabezado  like '%eutanasia%' OR
    Encabezado  like '%hospital%' OR
    Encabezado  like '%salubridad%' OR

    Autor  like '%salud%' OR
    Autor  like '%medicina%' OR
    Autor  like '%clinica%' OR
    Autor  like '%eutanasia%' OR
    Autor  like '%hospital%' OR
    Autor  like '%salubridad%' OR

    PieFoto  like '%salud%' OR
    PieFoto  like '%medicina%'OR 
    PieFoto  like '%clinica%' OR
    PieFoto  like '%eutanasia%' OR
    PieFoto  like '%hospital%' OR
    PieFoto  like '%salubridad%'

  )  
ORDER BY o.posicion
)
UNION (


SELECT
  n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  p.String_Name as StringName,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Hora,
  n.Encabezado,
  n.Foto,
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
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND   (
    Texto like '%Patricia Mercado%' OR
    Texto like '%Salomon Chertorivsk%' OR
    Texto like '%Jose Ramon Ameiva%' OR
    Texto like '%Tanya M_ller%' OR
    Texto like '%Rodolfo Rios%' OR
    Texto like '%Hector Serrano%' OR
    Texto like '%Fausto Lugo Garcia%' OR
    Texto like '%Perla Gomez%' OR
    Texto like '%Presidenta de la CDHDF%' OR
    Texto like '%SEMOVI%' OR
    Texto like '%SEDEMA%' OR
    Texto like '% SSP %' OR
    Texto like '%PGJ%' OR

    Titulo like '%Patricia Mercado%' OR
    Titulo like '%Salomon Chertorivsk%' OR
    Titulo like '%Jose Ramon Ameiva%' OR
    Titulo like '%Tanya M_ller%' OR
    Titulo like '%Rodolfo Rios%' OR
    Titulo like '%Hector Serrano%' OR
    Titulo like '%Fausto Lugo Garcia%' OR
    Titulo like '%Perla Gomez%' OR
    Titulo like '%Presidenta de la CDHDF%' OR
    Titulo like '%SEMOVI%' OR
    Titulo like '%SEDEMA%' OR
    Titulo like '%SSP%' OR
    Titulo like '%PGJ%' OR


    Encabezado like '%Patricia Mercado%' OR
    Encabezado like '%Salomon Chertorivsk%' OR
    Encabezado like '%Jose Ramon Ameiva%' OR
    Encabezado like '%Tanya M_ller%' OR
    Encabezado like '%Rodolfo Rios%' OR
    Encabezado like '%Hector Serrano%' OR
    Encabezado like '%Fausto Lugo Garcia%' OR
    Encabezado like '%Perla Gomez%' OR
    Encabezado like '%Presidenta de la CDHDF%' OR
    Encabezado like '%SEMOVI%' OR
    Encabezado like '%SEDEMA%' OR
    Encabezado like '%SSP%' OR
    Encabezado like '%PGJ%' OR

    Autor like '%Patricia Mercado%' OR
    Autor like '%Salomon Chertorivsk%' OR
    Autor like '%Jose Ramon Ameiva%' OR
    Autor like '%Tanya M_ller%' OR
    Autor like '%Rodolfo Rios%' OR
    Autor like '%Hector Serrano%' OR
    Autor like '%Fausto Lugo Garcia%' OR
    Autor like '%Perla Gomez%' OR
    Autor like '%Presidenta de la CDHDF%' OR
    Autor like '%SEMOVI%' OR
    Autor like '%SEDEMA%' OR
    Autor like '%SSP%' OR
    Autor like '%PGJ%' OR

    PieFoto like '%Patricia Mercado%' OR
    PieFoto like '%Salomon Chertorivsk%' OR
    PieFoto like '%Jose Ramon Ameiva%' OR
    PieFoto like '%Tanya M_ller%' OR
    PieFoto like '%Rodolfo Rios%' OR
    PieFoto like '%Hector Serrano%' OR
    PieFoto like '%Fausto Lugo Garcia%' OR
    PieFoto like '%Perla Gomez%' OR
    PieFoto like '%Presidenta de la CDHDF%' OR
    PieFoto like '%SEMOVI%' OR
    PieFoto like '%SEDEMA%' OR
    PieFoto like '%SSP%' OR
    PieFoto like '%PGJ%' 
  ) AND (
    Texto not like '%salud%' AND
    Texto not like '%medicina%' AND
    Texto not like '%clinica%' AND
    Texto not like '%eutanasia%' AND
    Texto not like '%hospital%' AND
    Texto not like '%salubridad%' AND

    Titulo not like '%salud%' AND
    Titulo not like '%medicina%' AND
    Titulo not like '%clinica%' AND
    Titulo not like '%eutanasia%' AND
    Titulo not like '%hospital%' AND
    Titulo not like '%salubridad%' AND

    Encabezado not like '%salud%' AND
    Encabezado not like '%medicina%' AND
    Encabezado not like '%clinica%' AND
    Encabezado not like '%eutanasia%' AND
    Encabezado not like '%hospital%' AND
    Encabezado not like '%salubridad%' AND

    Autor not like '%salud%' AND
    Autor not like '%medicina%' AND
    Autor not like '%clinica%' AND
    Autor not like '%eutanasia%' AND
    Autor not like '%hospital%' AND
    Autor not like '%salubridad%' AND

    PieFoto not like '%salud%' AND
    PieFoto not like '%medicina%'AND 
    PieFoto not like '%clinica%' AND
    PieFoto not like '%eutanasia%' AND
    PieFoto not like '%hospital%' AND
    PieFoto not like '%salubridad%'

  )
  GROUP BY idPeriodico,PaginaPeriodico  
  ORDER BY o.posicion
)

) derived";
            return $query;
            break;

        case 9: //Gobernador
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
                      Texto like '%Mercedes Juan Lopez%' OR
                      Texto like '%Juan Lopez%' OR
                      Texto like '%Mercedes Juan%' OR
                      Texto like '%Secretaria de Salud Federal%' OR
                      Texto like '%Secretaria de Salud%' OR

                      Titulo like '%Mercedes Juan Lopez%' OR
                      Titulo like '%Juan Lopez%' OR
                      Titulo like '%Mercedes Juan%' OR
                      Titulo like '%Secretaria de Salud Federal%' OR
                      Titulo like '%Secretaria de Salud%' OR

                      Encabezado like '%Mercedes Juan Lopez%' OR
                      Encabezado like '%Juan Lopez%' OR
                      Encabezado like '%Mercedes Juan%' OR
                      Encabezado like '%Secretaria de Salud Federal%' OR
                      Encabezado like '%Secretaria de Salud%' OR

                      Autor like '%Mercedes Juan Lopez%' OR
                      Autor like '%Juan Lopez%' OR
                      Autor like '%Mercedes Juan%' OR
                      Autor like '%Secretaria de Salud Federal%' OR
                      Autor like '%Secretaria de Salud%' OR

                      PieFoto like '%Mercedes Juan Lopez%' OR
                      PieFoto like '%Juan Lopez%' OR
                      PieFoto like '%Mercedes Juan%' OR
                      PieFoto like '%Secretaria de Salud Federal%' OR
                      PieFoto like '%Secretaria de Salud%'
                    ) 
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        case 10: //Gobernador
            $query = "SELECT * FROM (
(
SELECT
  n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  p.String_Name as StringName,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Hora,
  n.Encabezado,
  n.Foto,
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
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
    Texto like '%ALDF%' OR
    Texto like '%Asamblea legislativa del DF%' OR
    Texto like '%Asamblea legislativa del Distrito Federal%' OR

    Titulo like '%ALDF%' OR
    Titulo like '%Asamblea legislativa del DF%' OR
    Titulo like '%Asamblea legislativa del Distrito Federal%' OR

    Encabezado like '%ALDF%' OR
    Encabezado like '%Asamblea legislativa del DF%' OR
    Encabezado like '%Asamblea legislativa del Distrito Federal%' OR

    Autor like '%ALDF%' OR
    Autor like '%Asamblea legislativa del DF%' OR
    Autor like '%Asamblea legislativa del Distrito Federal%' OR

    PieFoto like '%ALDF%' OR
    PieFoto like '%Asamblea legislativa del DF%' OR
    PieFoto like '%Asamblea legislativa del Distrito Federal%'
  )   AND (
    Texto like '%salud%' OR
    Texto  like '%medicina%' OR
    Texto  like '%clinica%' OR
    Texto  like '%eutanasia%' OR
    Texto  like '%hospital%' OR
    Texto  like '%salubridad%' OR

    Titulo  like '%salud%' OR
    Titulo  like '%medicina%' OR
    Titulo  like '%clinica%' OR
    Titulo  like '%eutanasia%' OR
    Titulo  like '%hospital%' OR
    Titulo  like '%salubridad%' OR

    Encabezado  like '%salud%' OR
    Encabezado  like '%medicina%' OR
    Encabezado  like '%clinica%' OR
    Encabezado  like '%eutanasia%' OR
    Encabezado  like '%hospital%' OR
    Encabezado  like '%salubridad%' OR

    Autor  like '%salud%' OR
    Autor  like '%medicina%' OR
    Autor  like '%clinica%' OR
    Autor  like '%eutanasia%' OR
    Autor  like '%hospital%' OR
    Autor  like '%salubridad%' OR

    PieFoto  like '%salud%' OR
    PieFoto  like '%medicina%'OR 
    PieFoto  like '%clinica%' OR
    PieFoto  like '%eutanasia%' OR
    PieFoto  like '%hospital%' OR
    PieFoto  like '%salubridad%'

  )  
ORDER BY o.posicion
)
UNION (


SELECT
  n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  p.String_Name as StringName,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Hora,
  n.Encabezado,
  n.Foto,
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
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
    Texto like '%ALDF%' OR
    Texto like '%Asamblea legislativa del DF%' OR
    Texto like '%Asamblea legislativa del Distrito Federal%' OR

    Titulo like '%ALDF%' OR
    Titulo like '%Asamblea legislativa del DF%' OR
    Titulo like '%Asamblea legislativa del Distrito Federal%' OR

    Encabezado like '%ALDF%' OR
    Encabezado like '%Asamblea legislativa del DF%' OR
    Encabezado like '%Asamblea legislativa del Distrito Federal%' OR

    Autor like '%ALDF%' OR
    Autor like '%Asamblea legislativa del DF%' OR
    Autor like '%Asamblea legislativa del Distrito Federal%' OR

    PieFoto like '%ALDF%' OR
    PieFoto like '%Asamblea legislativa del DF%' OR
    PieFoto like '%Asamblea legislativa del Distrito Federal%'
  )   AND (
    Texto not like '%salud%' AND
    Texto not like '%medicina%' AND
    Texto not like '%clinica%' AND
    Texto not like '%eutanasia%' AND
    Texto not like '%hospital%' AND
    Texto not like '%salubridad%' AND

    Titulo not like '%salud%' AND
    Titulo not like '%medicina%' AND
    Titulo not like '%clinica%' AND
    Titulo not like '%eutanasia%' AND
    Titulo not like '%hospital%' AND
    Titulo not like '%salubridad%' AND

    Encabezado not like '%salud%' AND
    Encabezado not like '%medicina%' AND
    Encabezado not like '%clinica%' AND
    Encabezado not like '%eutanasia%' AND
    Encabezado not like '%hospital%' AND
    Encabezado not like '%salubridad%' AND

    Autor not like '%salud%' AND
    Autor not like '%medicina%' AND
    Autor not like '%clinica%' AND
    Autor not like '%eutanasia%' AND
    Autor not like '%hospital%' AND
    Autor not like '%salubridad%' AND

    PieFoto not like '%salud%' AND
    PieFoto not like '%medicina%'AND 
    PieFoto not like '%clinica%' AND
    PieFoto not like '%eutanasia%' AND
    PieFoto not like '%hospital%' AND
    PieFoto not like '%salubridad%'

  )
  GROUP BY idPeriodico,PaginaPeriodico  
  ORDER BY o.posicion
)

) derived";
            return $query;
            break;

        case 11: //Gobernador
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
                      Texto like '%Diputado%' OR
                      Texto like '%Diputada%' OR
                      Texto like '%Camara de Diputados%' OR
                      Texto like '%Camara Baja%' OR

                      Titulo like '%Diputado%' OR
                      Titulo like '%Diputada%' OR
                      Titulo like '%Camara de Diputados%' OR
                      Titulo like '%Camara Baja%' OR

                      Encabezado like '%Diputado%' OR
                      Encabezado like '%Diputada%' OR
                      Encabezado like '%Camara de Diputados%' OR
                      Encabezado like '%Camara Baja%' OR

                      Autor like '%Diputado%' OR
                      Autor like '%Diputada%' OR
                      Autor like '%Camara de Diputados%' OR
                      Autor like '%Camara Baja%' OR

                      PieFoto like '%Diputado%' OR
                      PieFoto like '%Diputada%' OR
                      PieFoto like '%Camara de Diputados%' OR
                      PieFoto like '%Camara Baja%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        case 12: //Gobernador
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
                      Texto like '%Senador%' OR
                      Texto like '%Senadora%' OR
                      Texto like '%Camara de Senadores%' OR
                      Texto like '%Camara Alta%' OR

                      Titulo like '%Senador%' OR
                      Titulo like '%Senadora%' OR
                      Titulo like '%Camara de Senadores%' OR
                      Titulo like '%Camara Alta%' OR

                      Encabezado like '%Senador%' OR
                      Encabezado like '%Senadora%' OR
                      Encabezado like '%Camara de Senadores%' OR
                      Encabezado like '%Camara Alta%' OR

                      Autor like '%Senador%' OR
                      Autor like '%Senadora%' OR
                      Autor like '%Camara de Senadores%' OR
                      Autor like '%Camara Alta%' OR

                      PieFoto like '%Senador%' OR
                      PieFoto like '%Senadora%' OR
                      PieFoto like '%Camara de Senadores%' OR
                      PieFoto like '%Camara Alta%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        case 13: //Gobernador
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
                      Texto like '%Organizacion mundial de la salud%' OR
                      Texto like '%OMS%' OR
                      Texto like '%Asamblea mundial de la Salud%' OR
                      Texto like '%organizacion panamericana de la Salud%' OR
                      Texto like '%FNUP%' OR
                      Texto like '%Fondo de las naciones unidas para poblacion%' OR
                      Texto like '%COICM%' OR
                      Texto like '%Consejo de organizaciones internacionales de las ciencias medicas%' OR
                      Texto like '%FIPF%' OR
                      Texto like '%Federacion Internacional de planificacion familiar%' OR
                      Texto like '%CIIC%' OR
                      Texto like '%Centro internacional de investigacion en cancer%' OR
                      Texto like '%Cruz Roja Internacional%' OR

                      Titulo like '%Organizacion mundial de la salud%' OR
                      Titulo like '%OMS%' OR
                      Titulo like '%Asamblea mundial de la Salud%' OR
                      Titulo like '%organizacion panamericana de la Salud%' OR
                      Titulo like '%FNUP%' OR
                      Titulo like '%Fondo de las naciones unidas para poblacion%' OR
                      Titulo like '%COICM%' OR
                      Titulo like '%Consejo de organizaciones internacionales de las ciencias medicas%' OR
                      Titulo like '%FIPF%' OR
                      Titulo like '%Federacion Internacional de planificacion familiar%' OR
                      Titulo like '%CIIC%' OR
                      Titulo like '%Centro internacional de investigacion en cancer%' OR
                      Titulo like '%Cruz Roja Internacional%' OR

                      Encabezado like '%Organizacion mundial de la salud%' OR
                      Encabezado like '%OMS%' OR
                      Encabezado like '%Asamblea mundial de la Salud%' OR
                      Encabezado like '%organizacion panamericana de la Salud%' OR
                      Encabezado like '%FNUP%' OR
                      Encabezado like '%Fondo de las naciones unidas para poblacion%' OR
                      Encabezado like '%COICM%' OR
                      Encabezado like '%Consejo de organizaciones internacionales de las ciencias medicas%' OR
                      Encabezado like '%FIPF%' OR
                      Encabezado like '%Federacion Internacional de planificacion familiar%' OR
                      Encabezado like '%CIIC%' OR
                      Encabezado like '%Centro internacional de investigacion en cancer%' OR
                      Encabezado like '%Cruz Roja Internacional%' OR

                      Autor like '%Organizacion mundial de la salud%' OR
                      Autor like '%OMS%' OR
                      Autor like '%Asamblea mundial de la Salud%' OR
                      Autor like '%organizacion panamericana de la Salud%' OR
                      Autor like '%FNUP%' OR
                      Autor like '%Fondo de las naciones unidas para poblacion%' OR
                      Autor like '%COICM%' OR
                      Autor like '%Consejo de organizaciones internacionales de las ciencias medicas%' OR
                      Autor like '%FIPF%' OR
                      Autor like '%Federacion Internacional de planificacion familiar%' OR
                      Autor like '%CIIC%' OR
                      Autor like '%Centro internacional de investigacion en cancer%' OR
                      Autor like '%Cruz Roja Internacional%' OR

                      PieFoto like '%Organizacion mundial de la salud%' OR
                      PieFoto like '%OMS%' OR
                      PieFoto like '%Asamblea mundial de la Salud%' OR
                      PieFoto like '%organizacion panamericana de la Salud%' OR
                      PieFoto like '%FNUP%' OR
                      PieFoto like '%Fondo de las naciones unidas para poblacion%' OR
                      PieFoto like '%COICM%' OR
                      PieFoto like '%Consejo de organizaciones internacionales de las ciencias medicas%' OR
                      PieFoto like '%FIPF%' OR
                      PieFoto like '%Federacion Internacional de planificacion familiar%' OR
                      PieFoto like '%CIIC%' OR
                      PieFoto like '%Centro internacional de investigacion en cancer%' OR
                      PieFoto like '%Cruz Roja Internacional%'
                      
                      )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        case 14: //Gobernador
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
                      Texto like '%Pablo Kuri-Morales%' OR
                      Texto like '%Pablo Kuri Morales%' OR
                      Texto like '%Kuri Morales%' OR

                      Titulo like '%Pablo Kuri-Morales%' OR
                      Titulo like '%Pablo Kuri Morales%' OR
                      Titulo like '%Kuri Morales%' OR

                      Encabezado like '%Pablo Kuri-Morales%' OR
                      Encabezado like '%Pablo Kuri Morales%' OR
                      Encabezado like '%Kuri Morales%' OR

                      Autor like '%Pablo Kuri-Morales%' OR
                      Autor like '%Pablo Kuri Morales%' OR
                      Autor like '%Kuri Morales%' OR

                      PieFoto like '%Pablo Kuri-Morales%' OR
                      PieFoto like '%Pablo Kuri Morales%' OR
                      PieFoto like '%Kuri Morales%'
                      )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        case 15: //Gobernador
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
                       Texto like '%Manuel Mondragon y Kalb%' OR
                       Texto like '%Mondragon y Kalb%' OR
                       Texto like '%Manuel Mondragon%' OR

                       Titulo like '%Manuel Mondragon y Kalb%' OR
                       Titulo like '%Mondragon y Kalb%' OR
                       Titulo like '%Manuel Mondragon%' OR

                       Encabezado like '%Manuel Mondragon y Kalb%' OR
                       Encabezado like '%Mondragon y Kalb%' OR
                       Encabezado like '%Manuel Mondragon%' OR

                       Autor like '%Manuel Mondragon y Kalb%' OR
                       Autor like '%Mondragon y Kalb%' OR
                       Autor like '%Manuel Mondragon%' OR

                       PieFoto like '%Manuel Mondragon y Kalb%' OR
                       PieFoto like '%Mondragon y Kalb%' OR
                       PieFoto like '%Manuel Mondragon%'

                       Texto like '%Comision Nacional contra las Adicciones%' OR
                       Texto like '% Conadic %' OR
                       Texto like '%(Conadic)%' OR

                       Titulo like '%Comision Nacional contra las Adicciones%' OR
                       Titulo like '% Conadic %' OR
                       Titulo like '%(Conadic)%' OR

                       Encabezado like '%Comision Nacional contra las Adicciones%' OR
                       Encabezado like '% Conadic %' OR
                       Encabezado like '%(Conadic)%' OR

                       Autor like '%Comision Nacional contra las Adicciones%' OR
                       Autor like '% Conadic %' OR
                       Autor like '%(Conadic)%' OR

                       PieFoto like '%Comision Nacional contra las Adicciones%' OR
                       PieFoto like '% Conadic %' OR
                       PieFoto like '%(Conadic)%'
                  ) 
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        case 16: //Gobernador
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
                      Texto like '%Mikel Andoni Arriola Penalosa%' OR
                      Texto like '%Mikel Andoni Arriola%' OR
                      Texto like '%Mikel Arriola Penalosa%' OR
                      Texto like '%arriola Penalosa%' OR
                      Texto like '%cofepris%' OR

                      Titulo like '%Mikel Andoni Arriola Penalosa%' OR
                      Titulo like '%Mikel Andoni Arriola%' OR
                      Titulo like '%Mikel Arriola Penalosa%' OR
                      Titulo like '%arriola Penalosa%' OR
                      Titulo like '%cofepris%' OR

                      Encabezado like '%Mikel Andoni Arriola Penalosa%' OR
                      Encabezado like '%Mikel Andoni Arriola%' OR
                      Encabezado like '%Mikel Arriola Penalosa%' OR
                      Encabezado like '%arriola Penalosa%' OR
                      Encabezado like '%cofepris%' OR

                      Autor like '%Mikel Andoni Arriola Penalosa%' OR
                      Autor like '%Mikel Andoni Arriola%' OR
                      Autor like '%Mikel Arriola Penalosa%' OR
                      Autor like '%arriola Penalosa%' OR
                      Autor like '%cofepris%' OR

                      PieFoto like '%Mikel Andoni Arriola Penalosa%' OR
                      PieFoto like '%Mikel Andoni Arriola%' OR
                      PieFoto like '%Mikel Arriola Penalosa%' OR
                      PieFoto like '%arriola Penalosa%' OR
                      PieFoto like '%cofepris%'
                      )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;
          case 17: // PRIMERAS PLANAS Ciudad
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
                    c.idCategoria in(133) AND
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.NumeroPagina,p.idPeriodico
                    ORDER BY o.posicion
                    ";
            return $query;
            break;
            /***************Querys de Tablero Salud DF******************/
    }
}
