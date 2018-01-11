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
            
        if ($fecha == date('Y-m-d'))
        {
            $Tabla="noticiasDia";
        }
        else
        {
            $Tabla="noticiasSemana";
        }
        switch ($op){

          case 1://Grupo GIN - DF 
            $query="SELECT 
                      n.idEditorial,
                      n.Periodico AS 'idPeriodico',
                      p.Nombre AS 'periodico',
                      n.Seccion,
                      s.seccion,
                      n.Categoria AS 'Num.Categoria',
                      c.Categoria AS 'Categoria',
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
                      CONCAT('/var/www/Sistema-de-Captura/Periodicos/',
                              p.Nombre,
                              '/',
                              n.Fecha,
                              '/',
                              NumeroPagina) AS 'pdf',
                      e.Nombre AS 'Estado'
                  FROM
                      $Tabla n,
                      periodicos p,
                      ordenGeneral o,
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND p.idPeriodico = o.periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND n.Activo = 1
                          AND fecha = DATE('$fecha')
                          AND (
                                Texto like '%Grupo GIN%' OR
                                Texto like '%outsourcing%' OR
                                
                                Titulo like '%Grupo GIN%' OR
                                Titulo like '%outsourcing%' OR

                                Encabezado like '%Grupo GIN%' OR
                                Encabezado like '%outsourcing%' OR

                                Autor like '%Grupo GIN%' OR
                                Autor like '%outsourcing%' OR

                                PieFoto like '%Grupo GIN%' OR
                                PieFoto like '%outsourcing%'
                              )
                  GROUP BY n.NumeroPagina,p.idPeriodico 
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 2://Grupo GIN - Estados
          $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.estado<>9 AND
                   n.Categoria<>80 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                                Texto like '%Grupo GIN%' OR
                                Texto like '%outsourcing%' OR
                                
                                Titulo like '%Grupo GIN%' OR
                                Titulo like '%outsourcing%' OR

                                Encabezado like '%Grupo GIN%' OR
                                Encabezado like '%outsourcing%' OR

                                Autor like '%Grupo GIN%' OR
                                Autor like '%outsourcing%' OR

                                PieFoto like '%Grupo GIN%' OR
                                PieFoto like '%outsourcing%'
                              )
                GROUP BY n.NumeroPagina,p.idPeriodico";
            return $query; 
        break;   

        case 3://Media Business - DF
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
                      Texto like '%Revista Open%' OR
                      Texto like '%forward travel%' OR
                      Texto like '%Revista El Gourmet%' OR
                      Texto like '%Revista Soy Grupero%' OR
                      Texto like '%Playboy%' OR
                      Texto like '%Revista del conejito%' OR
                      Texto like '%autobuild%' OR 
                      Texto like '%Revista Apasionado%' OR

                      Titulo like '%Revista Open%' OR
                      Titulo like '%forward travel%' OR
                      Titulo like '%Revista El Gourmet%' OR
                      Titulo like '%Revista Soy Grupero%' OR
                      Titulo like '%Playboy%' OR
                      Titulo like '%Revista del conejito%' OR
                      Titulo like '%autobuild%' OR 
                      Titulo like '%Revista Apasionado%' OR

                      Encabezado like '%Revista Open%' OR
                      Encabezado like '%forward travel%' OR
                      Encabezado like '%Revista El Gourmet%' OR
                      Encabezado like '%Revista Soy Grupero%' OR
                      Encabezado like '%Playboy%' OR
                      Encabezado like '%Revista del conejito%' OR
                      Encabezado like '%autobuild%' OR 
                      Encabezado like '%Revista Apasionado%' OR

                      Autor like '%Revista Open%' OR
                      Autor like '%forward travel%' OR
                      Autor like '%Revista El Gourmet%' OR
                      Autor like '%Revista Soy Grupero%' OR
                      Autor like '%Playboy%' OR
                      Autor like '%Revista del conejito%' OR
                      Autor like '%autobuild%' OR 
                      Autor like '%Revista Apasionado%' OR

                      PieFoto like '%Revista Open%' OR
                      PieFoto like '%forward travel%' OR
                      PieFoto like '%Revista El Gourmet%' OR
                      PieFoto like '%Revista Soy Grupero%' OR
                      PieFoto like '%Playboy%' OR
                      PieFoto like '%Revista del conejito%' OR
                      PieFoto like '%autobuild%' OR 
                      PieFoto like '%Revista Apasionado%'
                  )
                GROUP BY n.NumeroPagina,p.idPeriodico 
                ORDER BY o.posicion";
            return $query;  
        break;  

        case 4://Media Business - Estados
          $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.estado<>9 AND
                   n.Categoria<>80 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Revista Open%' OR
                      Texto like '%forward travel%' OR
                      Texto like '%Revista El Gourmet%' OR
                      Texto like '%Revista Soy Grupero%' OR
                      Texto like '%Playboy%' OR
                      Texto like '%Revista del conejito%' OR
                      Texto like '%autobuild%' OR 
                      Texto like '%Revista Apasionado%' OR

                      Titulo like '%Revista Open%' OR
                      Titulo like '%forward travel%' OR
                      Titulo like '%Revista El Gourmet%' OR
                      Titulo like '%Revista Soy Grupero%' OR
                      Titulo like '%Playboy%' OR
                      Titulo like '%Revista del conejito%' OR
                      Titulo like '%autobuild%' OR 
                      Titulo like '%Revista Apasionado%' OR

                      Encabezado like '%Revista Open%' OR
                      Encabezado like '%forward travel%' OR
                      Encabezado like '%Revista El Gourmet%' OR
                      Encabezado like '%Revista Soy Grupero%' OR
                      Encabezado like '%Playboy%' OR
                      Encabezado like '%Revista del conejito%' OR
                      Encabezado like '%autobuild%' OR 
                      Encabezado like '%Revista Apasionado%' OR

                      Autor like '%Revista Open%' OR
                      Autor like '%forward travel%' OR
                      Autor like '%Revista El Gourmet%' OR
                      Autor like '%Revista Soy Grupero%' OR
                      Autor like '%Playboy%' OR
                      Autor like '%Revista del conejito%' OR
                      Autor like '%autobuild%' OR 
                      Autor like '%Revista Apasionado%' OR

                      PieFoto like '%Revista Open%' OR
                      PieFoto like '%forward travel%' OR
                      PieFoto like '%Revista El Gourmet%' OR
                      PieFoto like '%Revista Soy Grupero%' OR
                      PieFoto like '%Playboy%' OR
                      PieFoto like '%Revista del conejito%' OR
                      PieFoto like '%autobuild%' OR 
                      PieFoto like '%Revista Apasionado%'
                  )
                GROUP BY n.NumeroPagina,p.idPeriodico";
            return $query; 
        break;   

        case 5:// PRIMERAS PLANAS
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
            break;// PRIMERAS PLANAS

        case 6:// COLUMNAS POLITICAS
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
            break;

        case 7:// COLUMNAS FINANCIERAS
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
                    GROUP BY n.Periodico,n.NumeroPagina  ";
            return $query;
            break;

        case 8: // Cartones DF
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
                    GROUP BY n.Periodico,n.NumeroPagina  
                    ORDER BY o.posicion
                    ";
            return $query;  
            break;
    }
}

?>
