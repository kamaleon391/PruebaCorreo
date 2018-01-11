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
          case 1://Titular - DF 
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
  
   Texto like'%Roberto Ramirez de la Parra%' OR  
        Texto like 'Roberto Ramirez de la Parra' OR
        Texto like '%Ramirez de la Parra%' OR
        Texto like '%Roberto Ramirez de la Parra%' OR
        Texto like '%Ramirez de la Parra%' OR
        

        Titulo like'%Roberto Ramirez de la Parra%' OR  
        Titulo like 'Roberto Ramirez de la Parra' OR
        Titulo like '%Ramirez de la Parra%' OR
        Titulo like '%Roberto Ramirez de la Parra%' OR
        Titulo like '%Ramirez de la Parra%' OR
        
        Encabezado like'%Roberto Ramirez de la Parra%' OR  
        Encabezado like 'Roberto Ramirez de la Parra' OR
        Encabezado like '%Ramirez de la Parra%' OR
        Encabezado like '%Roberto Ramirez de la Parra%' OR
        Encabezado like '%Ramirez de la Parra%'
)
 and texto not like '%c420%'
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 2://Titular - Estados
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
  
   Texto like'%Roberto Ramirez de la Parra%' OR  
        Texto like 'Roberto Ramirez de la Parra' OR
        Texto like '%Ramirez de la Parra%' OR
        Texto like '%Roberto Ramirez de la Parra%' OR
        Texto like '%Ramirez de la Parra%' OR
        

        Titulo like'%Roberto Ramirez de la Parra%' OR  
        Titulo like 'Roberto Ramirez de la Parra' OR
        Titulo like '%Ramirez de la Parra%' OR
        Titulo like '%Roberto Ramirez de la Parra%' OR
        Titulo like '%Ramirez de la Parra%' OR
        
        Encabezado like'%Roberto Ramirez de la Parra%' OR  
        Encabezado like 'Roberto Ramirez de la Parra' OR
        Encabezado like '%Ramirez de la Parra%' OR
        Encabezado like '%Roberto Ramirez de la Parra%' OR
        Encabezado like '%Ramirez de la Parra%'
)
 and texto not like '%c420%'
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break;   

        case 3://CONAGUA - DF 
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
  Texto  like '%CONAGUA%'  OR
  Texto  like '%comision nacional del agua%' OR

  Titulo like '%CONAGUA%'OR
  Titulo like '%comision nacional del agua%' OR
                

  Encabezado like '%CONAGUA%'OR
  Encabezado like '%comision nacional del agua%' 
)
 and texto not like '%c420%'
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 4://CONAGUA - Estados
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
  Texto  like '%CONAGUA%'  OR
  Texto  like '%comision nacional del agua%' OR

  Titulo like '%CONAGUA%'OR
  Titulo like '%comision nacional del agua%' OR
                

  Encabezado like '%CONAGUA%'OR
  Encabezado like '%comision nacional del agua%' 
)
 and texto not like '%c420%'
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 5://CUTZAMALA - DF 
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
        Texto LIKE '%Cutzamala%' OR      
        Titulo LIKE '%Cutzamala%' OR
        Encabezado LIKE '%Cutzamala%' OR
        PieFoto LIKE '%Cutzamala%' OR 
        Autor LIKE '%Cutzamala%'
        )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 6://CUTZAMALA - Estados
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
        Texto LIKE '%Cutzamala%' OR      
        Titulo LIKE '%Cutzamala%' OR
        Encabezado LIKE '%Cutzamala%' OR
        PieFoto LIKE '%Cutzamala%' OR 
        Autor LIKE '%Cutzamala%'
        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 7://Presas - DF 
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
        Texto LIKE '% Presas %' OR      
        Titulo LIKE '% Presas %' OR
        Encabezado LIKE '% Presas %' OR
        PieFoto LIKE '% Presas %' OR 
        Autor LIKE '% Presas %'
        )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 8://Presas - Estados
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
        Texto LIKE '% Presas %' OR      
        Titulo LIKE '% Presas %' OR
        Encabezado LIKE '% Presas %' OR
        PieFoto LIKE '% Presas %' OR 
        Autor LIKE '% Presas %'
        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 9://Infraestructura hidraulica - DF 
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
        Texto LIKE '%Infraestructura Hidraulica%' OR      
        Titulo LIKE '%Infraestructura Hidraulica%' OR
        Encabezado LIKE '%Infraestructura Hidraulica%' OR
        PieFoto LIKE '%Infraestructura Hidraulica%' OR 
        Autor LIKE '%Infraestructura Hidraulica%'
        )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 10://Infraestructura Hidraulica - Estados
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
        Texto LIKE '%Infraestructura Hidraulica%' OR      
        Titulo LIKE '%Infraestructura Hidraulica%' OR
        Encabezado LIKE '%Infraestructura Hidraulica%' OR
        PieFoto LIKE '%Infraestructura Hidraulica%' OR 
        Autor LIKE '%Infraestructura Hidraulica%'
        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 11://-Sequias - DF 
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
        Texto LIKE '%Sequias%' OR      
        Titulo LIKE '%Sequias%' OR
        Encabezado LIKE '%Sequias%' OR
        PieFoto LIKE '%Sequias%' OR 
        Autor LIKE '%Sequias%'
        )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 12://Sequias - Estados
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
        Texto LIKE '%Sequias%' OR      
        Titulo LIKE '%Sequias%' OR
        Encabezado LIKE '%Sequias%' OR
        PieFoto LIKE '%Sequias%' OR 
        Autor LIKE '%Sequias%'
        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 13://Heladas - DF 
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
        Texto LIKE '% Heladas%' OR      
        Titulo LIKE '% Heladas%' OR
        Encabezado LIKE '% Heladas%' OR
        PieFoto LIKE '% Heladas%' OR 
        Autor LIKE '% Heladas%'
        )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 14://Heladas - Estados
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
        Texto LIKE '% Heladas%' OR      
        Titulo LIKE '% Heladas%' OR
        Encabezado LIKE '% Heladas%' OR
        PieFoto LIKE '% Heladas%' OR 
        Autor LIKE '% Heladas%'
        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 15://SMN - DF 
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
  Texto like '%sector hidraulico%' OR
        Texto like 'ANEAS' OR
        Texto like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Texto like '%uniades de riego%' OR
        Texto like '%modulo de riego%' OR
        Texto like '%modulos de riego%' OR
        Texto like '%junta municipal de agua%' OR
        Texto like '%organismos operadores%' OR
        Texto like '%comision estatal del agua%' OR
        Texto like ' CCAP ' OR
        Texto like ' CESPE ' OR
        Texto like ' CESPM ' OR
        Texto like ' CESPETE ' OR
        Texto like ' CESPT ' OR
        Texto like ' SAPA ' OR
        Texto like ' OSAGUA ' OR
        Texto like ' JMAS ' OR
        Texto like ' SIMAS ' OR
        Texto like ' SAPAM ' OR
        Texto like ' COAPATAP ' OR
        Texto like ' SMAPA ' OR
        Texto like ' SIMAS ' OR
        Texto like ' SIMAPA ' OR
        Texto like ' AGSAL ' OR
        Texto like ' CIAPACOV ' OR
        Texto like ' CAPDAM ' OR
        Texto like ' SIDEA ' OR
        Texto like ' SIDEAPAS ' OR
        Texto like ' OADAP ' OR
        Texto like ' ADAPAS ' OR
        Texto like ' OPDM ' OR
        Texto like ' AIST ' OR
        Texto like ' APAST ' OR
        Texto like ' CAPAMA ' OR
        Texto like ' CAPAMI ' OR
        Texto like ' CAPAZ ' OR
        Texto like ' JUMAPA ' OR
        Texto like ' JAMAPI ' OR
        Texto like ' SAPAL ' OR
        Texto like ' CMAPAS ' OR
        Texto like ' CAPAMIH ' OR
        Texto like ' CEAA ' OR
        Texto like ' CAAMT ' OR
        Texto like ' SIAPA ' OR
        Texto like ' SEAPAL ' OR
        Texto like ' OROMAPAS ' OR
        Texto like ' CAPALAC ' OR
        Texto like ' OOAPAS ' OR
        Texto like ' OOAPASQ ' OR
        Texto like ' OMSAP ' OR
        Texto like ' CAPASU ' OR
        Texto like ' SAPAZ ' OR
        Texto like ' SOAPSC ' OR
        Texto like ' SAPAC ' OR
        Texto like ' SMAPEZ ' OR
        Texto like ' SIAPA ' OR
        Texto like ' OOMAPPI ' OR
        Texto like ' SCAPSAT ' OR
        Texto like ' SAP ' OR
        Texto like ' SAPASXO ' OR
        Texto like ' SCAPSZ ' OR
        Texto like ' SIAPA ' OR
        Texto like ' SADM ' OR
        Texto like ' ADOSAPACO ' OR
        Texto like ' SOAPAP ' OR
        Texto like ' SOAPAIM ' OR
        Texto like ' JAPAM ' OR
        Texto like ' CEA ' OR
        Texto like ' CAPA ' OR
        Texto like ' JMM ' OR
        Texto like ' JAPAC ' OR
        Texto like ' JUMAPAG ' OR
        Texto like ' JUMAPA ' OR
        Texto like ' JUMAPAN ' OR
        Texto like ' DAPA ' OR
        Texto like ' COMAP ' OR
        Texto like ' OOMAPAS ' OR
        Texto like ' COMAPA ' OR
        Texto like ' JAD ' OR
        Texto like ' CAPAM ' OR
        Texto like ' CMAPS ' OR
        Texto like ' CRAS ' OR
        Texto like ' CAPA ' OR
        Texto like ' JAPAY ' OR
        Texto like ' SAPAMV ' OR
        Texto like ' SIAPASF ' OR
        Texto like ' JIAPAZ ' OR
        Texto like '%Agua Potable%' OR
        Texto like '%Agua Potable y alcantarillado%' OR
        Texto like '%comision ciudadana de apa%' OR
        Texto like '%comision estatal de servicios publicos%' OR
        Texto like '%organismo operador municipal del sistema de apa y smto%' OR
        Texto like '%organismo del sistema de agua%' OR
        Texto like '%junta municipal de agua y saneamiento%' OR
        Texto like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%junta municipal de agua y saneamiento%' OR
        Texto like '%sistema municipal de apa municipal%' OR
        Texto like '%comite de apa tapachula%' OR
        Texto like '%sistema municipal de apa%' OR
        Texto like '%sistemas municipal de aguas y saneamiento%' OR
        Texto like '%sistema municipal de agua y saneamiento de frontera%' OR
        Texto like '%sistemas municipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%comision de agua potable y drenaje y alcantarillado%' OR
        Texto like '%sistema descentralizado de apa y saneamiento%' OR
        Texto like '%organismo publico descentralizado municipal de apa y smto%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Texto like '%junta de apa del municipio de irapuato%' OR
        Texto like '%sistema de apa de leon%' OR
        Texto like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Texto like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Texto like '%general de comision estatal de agua y alcantarillado%' OR
        Texto like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Texto like '%sistema municipal de los servicios de APA%' OR
        Texto like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Texto like '%organismo operador municipal de apa y saneamiento%' OR
        Texto like '%organismo municipal de servicios de agua potable%' OR
        Texto like '%comision de apa y saneamiento%' OR
        Texto like '%sistema de apa%' OR
        Texto like '%sistema ordenador de agua potable y saneamiento%' OR
        Texto like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Texto like '%sistema municipal de agua potable emiliano zapata%' OR
        Texto like '%sistema de agua potable de huitzilac y tres marias%' OR
        Texto like '%sistema de conservacion de agua potable y saneamiento%' OR
        Texto like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Texto like '%sistema de agua potable y saneamiento de temixco%' OR
        Texto like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Texto like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Texto like '%sistema operador de los servicios de apa%' OR
        Texto like '%sistema operador de los servicios de apa%' OR
        Texto like '%junta de agua potable y alcantarillado municipal%' OR
        Texto like '%comision estatal de aguas%' OR
        Texto like '%comision de apa%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%junta municipal de apa de culiacan%' OR
        Texto like '%junta municipal de agua potable y alcantarillado%' OR
        Texto like '%junta de apa del mpio%' OR
        Texto like '%junta municipal de apa%' OR
        Texto like '%direccion de apa y saneamiento%' OR
        Texto like '%comision municipal de agua potable%' OR
        Texto like '%comision de apa%' OR
        Texto like '%organismo operador municipal de apa y saneamiento%' OR
        Texto like '%comision municipal de agua potable%' OR
        Texto like '%agua de hermosillo%' OR
        Texto like '%organismo operador municiapal de apa y saneamiento%' OR
        Texto like '%junta de aguas y drenaje%' OR
        Texto like '%comision municipal de apa%' OR
        Texto like '%comision de apa del municipio de tlaxcala%' OR
        Texto like '%comision municipal de agua potable y saneamiento%' OR
        Texto like '%sas metropolitano%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%junta de agua potable y alcantarillado%' OR
        Texto like '%sistema de agua potable y alcantarillado%' OR
        Texto like '%sistema de apa y smto%' OR
        Texto like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Texto like '%acueducto%' OR
        Texto like '%canal de riego%' OR
        Texto like '%planta de tratamiento de aguas residuales%' OR
        Texto like '% PTAR %' OR
        Texto like '%Carcamo%' OR
        Texto like '%planta de bombeo%' OR




        Titulo like '%sector hidraulico%' OR
        Titulo like 'ANEAS' OR
        Titulo like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Titulo like '%uniades de riego%' OR
        Titulo like '%modulo de riego%' OR
        Titulo like '%modulos de riego%' OR
        Titulo like '%junta municipal de agua%' OR
        Titulo like '%organismos operadores%' OR
        Titulo like '%comision estatal del agua%' OR

        Titulo like ' CCAP ' OR
        Titulo like ' CESPE ' OR
        Titulo like ' CESPM ' OR
        Titulo like ' CESPETE ' OR
        Titulo like ' CESPT ' OR
        Titulo like ' SAPA ' OR
        Titulo like ' OSAGUA ' OR
        Titulo like ' JMAS ' OR
        Titulo like ' SIMAS ' OR
        Titulo like ' SAPAM ' OR
        Titulo like ' COAPATAP ' OR
        Titulo like ' SMAPA ' OR
        Titulo like ' SIMAS ' OR
        Titulo like ' SIMAPA ' OR
        Titulo like ' AGSAL ' OR
        Titulo like ' CIAPACOV ' OR
        Titulo like ' CAPDAM ' OR
        Titulo like ' SIDEA ' OR
        Titulo like ' SIDEAPAS ' OR
        Titulo like ' OADAP ' OR
        Titulo like ' ADAPAS ' OR
        Titulo like ' OPDM ' OR
        Titulo like ' AIST ' OR
        Titulo like ' APAST ' OR
        Titulo like ' CAPAMA ' OR
        Titulo like ' CAPAMI ' OR
        Titulo like ' CAPAZ ' OR
        Titulo like ' JUMAPA ' OR
        Titulo like ' JAMAPI ' OR
        Titulo like ' SAPAL ' OR
        Titulo like ' CMAPAS ' OR
        Titulo like ' CAPAMIH ' OR
        Titulo like ' CEAA ' OR
        Titulo like ' CAAMT ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' SEAPAL ' OR
        Titulo like ' OROMAPAS ' OR
        Titulo like ' CAPALAC ' OR
        Titulo like ' OOAPAS ' OR
        Titulo like ' OOAPASQ ' OR
        Titulo like ' OMSAP ' OR
        Titulo like ' CAPASU ' OR
        Titulo like ' SAPAZ ' OR
        Titulo like ' SOAPSC ' OR
        Titulo like ' SAPAC ' OR
        Titulo like ' SMAPEZ ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' OOMAPPI ' OR
        Titulo like ' SCAPSAT ' OR
        Titulo like ' SAP ' OR
        Titulo like ' SAPASXO ' OR
        Titulo like ' SCAPSZ ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' SADM ' OR
        Titulo like ' ADOSAPACO ' OR
        Titulo like ' SOAPAP ' OR
        Titulo like ' SOAPAIM ' OR
        Titulo like ' JAPAM ' OR
        Titulo like ' CEA ' OR
        Titulo like ' CAPA ' OR
        Titulo like ' JMM ' OR
        Titulo like ' JAPAC ' OR
        Titulo like ' JUMAPAG ' OR
        Titulo like ' JUMAPA ' OR
        Titulo like ' JUMAPAN ' OR
        Titulo like ' DAPA ' OR
        Titulo like ' COMAP ' OR
        Titulo like ' OOMAPAS ' OR
        Titulo like ' COMAPA ' OR
        Titulo like ' JAD ' OR
        Titulo like ' CAPAM ' OR
        Titulo like ' CMAPS ' OR
        Titulo like ' CRAS ' OR
        Titulo like ' CAPA ' OR
        Titulo like ' JAPAY ' OR
        Titulo like ' SAPAMV ' OR
        Titulo like ' SIAPASF ' OR
        Titulo like ' JIAPAZ ' OR
        Titulo like '%Agua Potable%' OR
        Titulo like '%Agua Potable y alcantarillado%' OR
        Titulo like '%comision ciudadana de apa%' OR
        Titulo like '%comision estatal de servicios publicos%' OR
        Titulo like '%organismo operador municipal del sistema de apa y smto%' OR
        Titulo like '%organismo del sistema de agua%' OR
        Titulo like '%junta municipal de agua y saneamiento%' OR
        Titulo like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%junta municipal de agua y saneamiento%' OR
        Titulo like '%sistema municipal de apa municipal%' OR
        Titulo like '%comite de apa tapachula%' OR
        Titulo like '%sistema municipal de apa%' OR
        Titulo like '%sistemas municipal de aguas y saneamiento%' OR
        Titulo like '%sistema municipal de agua y saneamiento de frontera%' OR
        Titulo like '%sistemas municipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%comision de agua potable y drenaje y alcantarillado%' OR
        Titulo like '%sistema descentralizado de apa y saneamiento%' OR
        Titulo like '%organismo publico descentralizado municipal de apa y smto%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Titulo like '%junta de apa del municipio de irapuato%' OR
        Titulo like '%sistema de apa de leon%' OR
        Titulo like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Titulo like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Titulo like '%general de comision estatal de agua y alcantarillado%' OR
        Titulo like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Titulo like '%sistema municipal de los servicios de APA%' OR
        Titulo like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Titulo like '%organismo operador municipal de apa y saneamiento%' OR
        Titulo like '%organismo municipal de servicios de agua potable%' OR
        Titulo like '%comision de apa y saneamiento%' OR
        Titulo like '%sistema de apa%' OR
        Titulo like '%sistema ordenador de agua potable y saneamiento%' OR
        Titulo like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Titulo like '%sistema municipal de agua potable emiliano zapata%' OR
        Titulo like '%sistema de agua potable de huitzilac y tres marias%' OR
        Titulo like '%sistema de conservacion de agua potable y saneamiento%' OR
        Titulo like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Titulo like '%sistema de agua potable y saneamiento de temixco%' OR
        Titulo like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Titulo like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Titulo like '%sistema operador de los servicios de apa%' OR
        Titulo like '%sistema operador de los servicios de apa%' OR
        Titulo like '%junta de agua potable y alcantarillado municipal%' OR
        Titulo like '%comision estatal de aguas%' OR
        Titulo like '%comision de apa%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%junta municipal de apa de culiacan%' OR
        Titulo like '%junta municipal de agua potable y alcantarillado%' OR
        Titulo like '%junta de apa del mpio%' OR
        Titulo like '%junta municipal de apa%' OR
        Titulo like '%direccion de apa y saneamiento%' OR
        Titulo like '%comision municipal de agua potable%' OR
        Titulo like '%comision de apa%' OR
        Titulo like '%organismo operador municipal de apa y saneamiento%' OR
        Titulo like '%comision municipal de agua potable%' OR
        Titulo like '%agua de hermosillo%' OR
        Texto like '%organismo operador municiapal de apa y saneamiento%' OR
        Texto like '%junta de aguas y drenaje%' OR
        Texto like '%comision municipal de apa%' OR
        Texto like '%comision de apa del municipio de tlaxcala%' OR
        Titulo like '%comision municipal de agua potable y saneamiento%' OR
        Titulo like '%sas metropolitano%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%junta de agua potable y alcantarillado%' OR
        Titulo like '%sistema de agua potable y alcantarillado%' OR
        Titulo like '%sistema de apa y smto%' OR
        Titulo like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Titulo like '%acueducto%' OR
        Titulo like '%canal de riego%' OR
        Titulo like '%planta de tratamiento de aguas residuales%' OR
        Titulo like '% PTAR %' OR
        Titulo like '%Carcamo%' OR
        Titulo like '%planta de bombeo%' OR


        Encabezado like '%sector hidraulico%' OR
        Encabezado like 'ANEAS' OR
        Encabezado like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Encabezado like '%uniades de riego%' OR
        Encabezado like '%modulo de riego%' OR
        Encabezado like '%modulos de riego%' OR
        Encabezado like '%junta municipal de agua%' OR
        Encabezado like '%organismos operadores%' OR
        Encabezado like '%comision estatal del agua%' OR

        Encabezado like ' CCAP ' OR
        Encabezado like ' CESPE ' OR
        Encabezado like ' CESPM ' OR
        Encabezado like ' CESPETE ' OR
        Encabezado like ' CESPT ' OR
        Encabezado like ' SAPA ' OR
        Encabezado like ' OSAGUA ' OR
        Encabezado like ' JMAS ' OR
        Encabezado like ' SIMAS ' OR
        Encabezado like ' SAPAM ' OR
        Encabezado like ' COAPATAP ' OR
        Encabezado like ' SMAPA ' OR
        Encabezado like ' SIMAS ' OR
        Encabezado like ' SIMAPA ' OR
        Encabezado like ' AGSAL ' OR
        Encabezado like ' CIAPACOV ' OR
        Encabezado like ' CAPDAM ' OR
        Encabezado like ' SIDEA ' OR
        Encabezado like ' SIDEAPAS ' OR
        Encabezado like ' OADAP ' OR
        Encabezado like ' ADAPAS ' OR
        Encabezado like ' OPDM ' OR
        Encabezado like ' AIST ' OR
        Encabezado like ' APAST ' OR
        Encabezado like ' CAPAMA ' OR
        Encabezado like ' CAPAMI ' OR
        Encabezado like ' CAPAZ ' OR
        Encabezado like ' JUMAPA ' OR
        Encabezado like ' JAMAPI ' OR
        Encabezado like ' SAPAL ' OR
        Encabezado like ' CMAPAS ' OR
        Encabezado like ' CAPAMIH ' OR
        Encabezado like ' CEAA ' OR
        Encabezado like ' CAAMT ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' SEAPAL ' OR
        Encabezado like ' OROMAPAS ' OR
        Encabezado like ' CAPALAC ' OR
        Encabezado like ' OOAPAS ' OR
        Encabezado like ' OOAPASQ ' OR
        Encabezado like ' OMSAP ' OR
        Encabezado like ' CAPASU ' OR
        Encabezado like ' SAPAZ ' OR
        Encabezado like ' SOAPSC ' OR
        Encabezado like ' SAPAC ' OR
        Encabezado like ' SMAPEZ ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' OOMAPPI ' OR
        Encabezado like ' SCAPSAT ' OR
        Encabezado like ' SAP ' OR
        Encabezado like ' SAPASXO ' OR
        Encabezado like ' SCAPSZ ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' SADM ' OR
        Encabezado like ' ADOSAPACO ' OR
        Encabezado like ' SOAPAP ' OR
        Encabezado like ' SOAPAIM ' OR
        Encabezado like ' JAPAM ' OR
        Encabezado like ' CEA ' OR
        Encabezado like ' CAPA ' OR
        Encabezado like ' JMM ' OR
        Encabezado like ' JAPAC ' OR
        Encabezado like ' JUMAPAG ' OR
        Encabezado like ' JUMAPA ' OR
        Encabezado like ' JUMAPAN ' OR
        Encabezado like ' DAPA ' OR
        Encabezado like ' COMAP ' OR
        Encabezado like ' OOMAPAS ' OR
        Encabezado like ' COMAPA ' OR
        Encabezado like ' JAD ' OR
        Encabezado like ' CAPAM ' OR
        Encabezado like ' CMAPS ' OR
        Encabezado like ' CRAS ' OR
        Encabezado like ' CAPA ' OR
        Encabezado like ' JAPAY ' OR
        Encabezado like ' SAPAMV ' OR
        Encabezado like ' SIAPASF ' OR
        Encabezado like ' JIAPAZ ' OR
        Encabezado like '%Agua Potable%' OR
        Encabezado like '%Agua Potable y alcantarillado%' OR
        Encabezado like '%comision ciudadana de apa%' OR
        Encabezado like '%comision estatal de servicios publicos%' OR
        Encabezado like '%organismo operador municipal del sistema de apa y smto%' OR
        Encabezado like '%organismo del sistema de agua%' OR
        Encabezado like '%junta municipal de agua y saneamiento%' OR
        Encabezado like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%junta municipal de agua y saneamiento%' OR
        Encabezado like '%sistema municipal de apa municipal%' OR
        Encabezado like '%comite de apa tapachula%' OR
        Encabezado like '%sistema municipal de apa%' OR
        Encabezado like '%sistemas municipal de aguas y saneamiento%' OR
        Encabezado like '%sistema municipal de agua y saneamiento de frontera%' OR
        Encabezado like '%sistemas municipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%comision de agua potable y drenaje y alcantarillado%' OR
        Encabezado like '%sistema descentralizado de apa y saneamiento%' OR
        Encabezado like '%organismo publico descentralizado municipal de apa y smto%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Encabezado like '%junta de apa del municipio de irapuato%' OR
        Encabezado like '%sistema de apa de leon%' OR
        Encabezado like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Encabezado like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Encabezado like '%general de comision estatal de agua y alcantarillado%' OR
        Encabezado like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Encabezado like '%sistema municipal de los servicios de APA%' OR
        Encabezado like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
        Encabezado like '%organismo municipal de servicios de agua potable%' OR
        Encabezado like '%comision de apa y saneamiento%' OR
        Encabezado like '%sistema de apa%' OR
        Encabezado like '%sistema ordenador de agua potable y saneamiento%' OR
        Encabezado like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Encabezado like '%sistema municipal de agua potable emiliano zapata%' OR
        Encabezado like '%sistema de agua potable de huitzilac y tres marias%' OR
        Encabezado like '%sistema de conservacion de agua potable y saneamiento%' OR
        Encabezado like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Encabezado like '%sistema de agua potable y saneamiento de temixco%' OR
        Encabezado like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Encabezado like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Encabezado like '%sistema operador de los servicios de apa%' OR
        Encabezado like '%sistema operador de los servicios de apa%' OR
        Encabezado like '%junta de agua potable y alcantarillado municipal%' OR
        Encabezado like '%comision estatal de aguas%' OR
        Encabezado like '%comision de apa%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%junta municipal de apa de culiacan%' OR
        Encabezado like '%junta municipal de agua potable y alcantarillado%' OR
        Encabezado like '%junta de apa del mpio%' OR
        Encabezado like '%junta municipal de apa%' OR
        Encabezado like '%direccion de apa y saneamiento%' OR
        Encabezado like '%comision municipal de agua potable%' OR
        Encabezado like '%comision de apa%' OR
        Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
        Encabezado like '%comision municipal de agua potable%' OR
        Encabezado like '%agua de hermosillo%' OR
        Encabezado like '%organismo operador municiapal de apa y saneamiento%' OR
        Encabezado like '%junta de aguas y drenaje%' OR
        Encabezado like '%comision municipal de apa%' OR
        Encabezado like '%comision de apa del municipio de tlaxcala%' OR
        Encabezado like '%comision municipal de agua potable y saneamiento%' OR
        Encabezado like '%sas metropolitano%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%junta de agua potable y alcantarillado%' OR
        Encabezado like '%sistema de agua potable y alcantarillado%' OR
        Encabezado like '%sistema de apa y smto%' OR
        Encabezado like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Encabezado like '%acueducto%' OR
        Encabezado like '%canal de riego%' OR
        Encabezado like '%planta de tratamiento de aguas residuales%' OR
        Encabezado like '% PTAR %' OR
        Encabezado like '%Carcamo%' OR
        Encabezado like '%planta de bombeo%'

)
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 16://SMN - Estados
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
  Texto like '%sector hidraulico%' OR
        Texto like 'ANEAS' OR
        Texto like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Texto like '%uniades de riego%' OR
        Texto like '%modulo de riego%' OR
        Texto like '%modulos de riego%' OR
        Texto like '%junta municipal de agua%' OR
        Texto like '%organismos operadores%' OR
        Texto like '%comision estatal del agua%' OR
        Texto like ' CCAP ' OR
        Texto like ' CESPE ' OR
        Texto like ' CESPM ' OR
        Texto like ' CESPETE ' OR
        Texto like ' CESPT ' OR
        Texto like ' SAPA ' OR
        Texto like ' OSAGUA ' OR
        Texto like ' JMAS ' OR
        Texto like ' SIMAS ' OR
        Texto like ' SAPAM ' OR
        Texto like ' COAPATAP ' OR
        Texto like ' SMAPA ' OR
        Texto like ' SIMAS ' OR
        Texto like ' SIMAPA ' OR
        Texto like ' AGSAL ' OR
        Texto like ' CIAPACOV ' OR
        Texto like ' CAPDAM ' OR
        Texto like ' SIDEA ' OR
        Texto like ' SIDEAPAS ' OR
        Texto like ' OADAP ' OR
        Texto like ' ADAPAS ' OR
        Texto like ' OPDM ' OR
        Texto like ' AIST ' OR
        Texto like ' APAST ' OR
        Texto like ' CAPAMA ' OR
        Texto like ' CAPAMI ' OR
        Texto like ' CAPAZ ' OR
        Texto like ' JUMAPA ' OR
        Texto like ' JAMAPI ' OR
        Texto like ' SAPAL ' OR
        Texto like ' CMAPAS ' OR
        Texto like ' CAPAMIH ' OR
        Texto like ' CEAA ' OR
        Texto like ' CAAMT ' OR
        Texto like ' SIAPA ' OR
        Texto like ' SEAPAL ' OR
        Texto like ' OROMAPAS ' OR
        Texto like ' CAPALAC ' OR
        Texto like ' OOAPAS ' OR
        Texto like ' OOAPASQ ' OR
        Texto like ' OMSAP ' OR
        Texto like ' CAPASU ' OR
        Texto like ' SAPAZ ' OR
        Texto like ' SOAPSC ' OR
        Texto like ' SAPAC ' OR
        Texto like ' SMAPEZ ' OR
        Texto like ' SIAPA ' OR
        Texto like ' OOMAPPI ' OR
        Texto like ' SCAPSAT ' OR
        Texto like ' SAP ' OR
        Texto like ' SAPASXO ' OR
        Texto like ' SCAPSZ ' OR
        Texto like ' SIAPA ' OR
        Texto like ' SADM ' OR
        Texto like ' ADOSAPACO ' OR
        Texto like ' SOAPAP ' OR
        Texto like ' SOAPAIM ' OR
        Texto like ' JAPAM ' OR
        Texto like ' CEA ' OR
        Texto like ' CAPA ' OR
        Texto like ' JMM ' OR
        Texto like ' JAPAC ' OR
        Texto like ' JUMAPAG ' OR
        Texto like ' JUMAPA ' OR
        Texto like ' JUMAPAN ' OR
        Texto like ' DAPA ' OR
        Texto like ' COMAP ' OR
        Texto like ' OOMAPAS ' OR
        Texto like ' COMAPA ' OR
        Texto like ' JAD ' OR
        Texto like ' CAPAM ' OR
        Texto like ' CMAPS ' OR
        Texto like ' CRAS ' OR
        Texto like ' CAPA ' OR
        Texto like ' JAPAY ' OR
        Texto like ' SAPAMV ' OR
        Texto like ' SIAPASF ' OR
        Texto like ' JIAPAZ ' OR
        Texto like '%Agua Potable%' OR
        Texto like '%Agua Potable y alcantarillado%' OR
        Texto like '%comision ciudadana de apa%' OR
        Texto like '%comision estatal de servicios publicos%' OR
        Texto like '%organismo operador municipal del sistema de apa y smto%' OR
        Texto like '%organismo del sistema de agua%' OR
        Texto like '%junta municipal de agua y saneamiento%' OR
        Texto like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%junta municipal de agua y saneamiento%' OR
        Texto like '%sistema municipal de apa municipal%' OR
        Texto like '%comite de apa tapachula%' OR
        Texto like '%sistema municipal de apa%' OR
        Texto like '%sistemas municipal de aguas y saneamiento%' OR
        Texto like '%sistema municipal de agua y saneamiento de frontera%' OR
        Texto like '%sistemas municipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%comision de agua potable y drenaje y alcantarillado%' OR
        Texto like '%sistema descentralizado de apa y saneamiento%' OR
        Texto like '%organismo publico descentralizado municipal de apa y smto%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Texto like '%junta de apa del municipio de irapuato%' OR
        Texto like '%sistema de apa de leon%' OR
        Texto like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Texto like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Texto like '%general de comision estatal de agua y alcantarillado%' OR
        Texto like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Texto like '%sistema municipal de los servicios de APA%' OR
        Texto like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Texto like '%organismo operador municipal de apa y saneamiento%' OR
        Texto like '%organismo municipal de servicios de agua potable%' OR
        Texto like '%comision de apa y saneamiento%' OR
        Texto like '%sistema de apa%' OR
        Texto like '%sistema ordenador de agua potable y saneamiento%' OR
        Texto like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Texto like '%sistema municipal de agua potable emiliano zapata%' OR
        Texto like '%sistema de agua potable de huitzilac y tres marias%' OR
        Texto like '%sistema de conservacion de agua potable y saneamiento%' OR
        Texto like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Texto like '%sistema de agua potable y saneamiento de temixco%' OR
        Texto like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Texto like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Texto like '%sistema operador de los servicios de apa%' OR
        Texto like '%sistema operador de los servicios de apa%' OR
        Texto like '%junta de agua potable y alcantarillado municipal%' OR
        Texto like '%comision estatal de aguas%' OR
        Texto like '%comision de apa%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%junta municipal de apa de culiacan%' OR
        Texto like '%junta municipal de agua potable y alcantarillado%' OR
        Texto like '%junta de apa del mpio%' OR
        Texto like '%junta municipal de apa%' OR
        Texto like '%direccion de apa y saneamiento%' OR
        Texto like '%comision municipal de agua potable%' OR
        Texto like '%comision de apa%' OR
        Texto like '%organismo operador municipal de apa y saneamiento%' OR
        Texto like '%comision municipal de agua potable%' OR
        Texto like '%agua de hermosillo%' OR
        Texto like '%organismo operador municiapal de apa y saneamiento%' OR
        Texto like '%junta de aguas y drenaje%' OR
        Texto like '%comision municipal de apa%' OR
        Texto like '%comision de apa del municipio de tlaxcala%' OR
        Texto like '%comision municipal de agua potable y saneamiento%' OR
        Texto like '%sas metropolitano%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%junta de agua potable y alcantarillado%' OR
        Texto like '%sistema de agua potable y alcantarillado%' OR
        Texto like '%sistema de apa y smto%' OR
        Texto like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Texto like '%acueducto%' OR
        Texto like '%canal de riego%' OR
        Texto like '%planta de tratamiento de aguas residuales%' OR
        Texto like '% PTAR %' OR
        Texto like '%Carcamo%' OR
        Texto like '%planta de bombeo%' OR




        Titulo like '%sector hidraulico%' OR
        Titulo like 'ANEAS' OR
        Titulo like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Titulo like '%uniades de riego%' OR
        Titulo like '%modulo de riego%' OR
        Titulo like '%modulos de riego%' OR
        Titulo like '%junta municipal de agua%' OR
        Titulo like '%organismos operadores%' OR
        Titulo like '%comision estatal del agua%' OR

        Titulo like ' CCAP ' OR
        Titulo like ' CESPE ' OR
        Titulo like ' CESPM ' OR
        Titulo like ' CESPETE ' OR
        Titulo like ' CESPT ' OR
        Titulo like ' SAPA ' OR
        Titulo like ' OSAGUA ' OR
        Titulo like ' JMAS ' OR
        Titulo like ' SIMAS ' OR
        Titulo like ' SAPAM ' OR
        Titulo like ' COAPATAP ' OR
        Titulo like ' SMAPA ' OR
        Titulo like ' SIMAS ' OR
        Titulo like ' SIMAPA ' OR
        Titulo like ' AGSAL ' OR
        Titulo like ' CIAPACOV ' OR
        Titulo like ' CAPDAM ' OR
        Titulo like ' SIDEA ' OR
        Titulo like ' SIDEAPAS ' OR
        Titulo like ' OADAP ' OR
        Titulo like ' ADAPAS ' OR
        Titulo like ' OPDM ' OR
        Titulo like ' AIST ' OR
        Titulo like ' APAST ' OR
        Titulo like ' CAPAMA ' OR
        Titulo like ' CAPAMI ' OR
        Titulo like ' CAPAZ ' OR
        Titulo like ' JUMAPA ' OR
        Titulo like ' JAMAPI ' OR
        Titulo like ' SAPAL ' OR
        Titulo like ' CMAPAS ' OR
        Titulo like ' CAPAMIH ' OR
        Titulo like ' CEAA ' OR
        Titulo like ' CAAMT ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' SEAPAL ' OR
        Titulo like ' OROMAPAS ' OR
        Titulo like ' CAPALAC ' OR
        Titulo like ' OOAPAS ' OR
        Titulo like ' OOAPASQ ' OR
        Titulo like ' OMSAP ' OR
        Titulo like ' CAPASU ' OR
        Titulo like ' SAPAZ ' OR
        Titulo like ' SOAPSC ' OR
        Titulo like ' SAPAC ' OR
        Titulo like ' SMAPEZ ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' OOMAPPI ' OR
        Titulo like ' SCAPSAT ' OR
        Titulo like ' SAP ' OR
        Titulo like ' SAPASXO ' OR
        Titulo like ' SCAPSZ ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' SADM ' OR
        Titulo like ' ADOSAPACO ' OR
        Titulo like ' SOAPAP ' OR
        Titulo like ' SOAPAIM ' OR
        Titulo like ' JAPAM ' OR
        Titulo like ' CEA ' OR
        Titulo like ' CAPA ' OR
        Titulo like ' JMM ' OR
        Titulo like ' JAPAC ' OR
        Titulo like ' JUMAPAG ' OR
        Titulo like ' JUMAPA ' OR
        Titulo like ' JUMAPAN ' OR
        Titulo like ' DAPA ' OR
        Titulo like ' COMAP ' OR
        Titulo like ' OOMAPAS ' OR
        Titulo like ' COMAPA ' OR
        Titulo like ' JAD ' OR
        Titulo like ' CAPAM ' OR
        Titulo like ' CMAPS ' OR
        Titulo like ' CRAS ' OR
        Titulo like ' CAPA ' OR
        Titulo like ' JAPAY ' OR
        Titulo like ' SAPAMV ' OR
        Titulo like ' SIAPASF ' OR
        Titulo like ' JIAPAZ ' OR
        Titulo like '%Agua Potable%' OR
        Titulo like '%Agua Potable y alcantarillado%' OR
        Titulo like '%comision ciudadana de apa%' OR
        Titulo like '%comision estatal de servicios publicos%' OR
        Titulo like '%organismo operador municipal del sistema de apa y smto%' OR
        Titulo like '%organismo del sistema de agua%' OR
        Titulo like '%junta municipal de agua y saneamiento%' OR
        Titulo like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%junta municipal de agua y saneamiento%' OR
        Titulo like '%sistema municipal de apa municipal%' OR
        Titulo like '%comite de apa tapachula%' OR
        Titulo like '%sistema municipal de apa%' OR
        Titulo like '%sistemas municipal de aguas y saneamiento%' OR
        Titulo like '%sistema municipal de agua y saneamiento de frontera%' OR
        Titulo like '%sistemas municipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%comision de agua potable y drenaje y alcantarillado%' OR
        Titulo like '%sistema descentralizado de apa y saneamiento%' OR
        Titulo like '%organismo publico descentralizado municipal de apa y smto%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Titulo like '%junta de apa del municipio de irapuato%' OR
        Titulo like '%sistema de apa de leon%' OR
        Titulo like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Titulo like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Titulo like '%general de comision estatal de agua y alcantarillado%' OR
        Titulo like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Titulo like '%sistema municipal de los servicios de APA%' OR
        Titulo like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Titulo like '%organismo operador municipal de apa y saneamiento%' OR
        Titulo like '%organismo municipal de servicios de agua potable%' OR
        Titulo like '%comision de apa y saneamiento%' OR
        Titulo like '%sistema de apa%' OR
        Titulo like '%sistema ordenador de agua potable y saneamiento%' OR
        Titulo like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Titulo like '%sistema municipal de agua potable emiliano zapata%' OR
        Titulo like '%sistema de agua potable de huitzilac y tres marias%' OR
        Titulo like '%sistema de conservacion de agua potable y saneamiento%' OR
        Titulo like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Titulo like '%sistema de agua potable y saneamiento de temixco%' OR
        Titulo like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Titulo like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Titulo like '%sistema operador de los servicios de apa%' OR
        Titulo like '%sistema operador de los servicios de apa%' OR
        Titulo like '%junta de agua potable y alcantarillado municipal%' OR
        Titulo like '%comision estatal de aguas%' OR
        Titulo like '%comision de apa%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%junta municipal de apa de culiacan%' OR
        Titulo like '%junta municipal de agua potable y alcantarillado%' OR
        Titulo like '%junta de apa del mpio%' OR
        Titulo like '%junta municipal de apa%' OR
        Titulo like '%direccion de apa y saneamiento%' OR
        Titulo like '%comision municipal de agua potable%' OR
        Titulo like '%comision de apa%' OR
        Titulo like '%organismo operador municipal de apa y saneamiento%' OR
        Titulo like '%comision municipal de agua potable%' OR
        Titulo like '%agua de hermosillo%' OR
        Texto like '%organismo operador municiapal de apa y saneamiento%' OR
        Texto like '%junta de aguas y drenaje%' OR
        Texto like '%comision municipal de apa%' OR
        Texto like '%comision de apa del municipio de tlaxcala%' OR
        Titulo like '%comision municipal de agua potable y saneamiento%' OR
        Titulo like '%sas metropolitano%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%junta de agua potable y alcantarillado%' OR
        Titulo like '%sistema de agua potable y alcantarillado%' OR
        Titulo like '%sistema de apa y smto%' OR
        Titulo like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Titulo like '%acueducto%' OR
        Titulo like '%canal de riego%' OR
        Titulo like '%planta de tratamiento de aguas residuales%' OR
        Titulo like '% PTAR %' OR
        Titulo like '%Carcamo%' OR
        Titulo like '%planta de bombeo%' OR


        Encabezado like '%sector hidraulico%' OR
        Encabezado like 'ANEAS' OR
        Encabezado like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Encabezado like '%uniades de riego%' OR
        Encabezado like '%modulo de riego%' OR
        Encabezado like '%modulos de riego%' OR
        Encabezado like '%junta municipal de agua%' OR
        Encabezado like '%organismos operadores%' OR
        Encabezado like '%comision estatal del agua%' OR

        Encabezado like ' CCAP ' OR
        Encabezado like ' CESPE ' OR
        Encabezado like ' CESPM ' OR
        Encabezado like ' CESPETE ' OR
        Encabezado like ' CESPT ' OR
        Encabezado like ' SAPA ' OR
        Encabezado like ' OSAGUA ' OR
        Encabezado like ' JMAS ' OR
        Encabezado like ' SIMAS ' OR
        Encabezado like ' SAPAM ' OR
        Encabezado like ' COAPATAP ' OR
        Encabezado like ' SMAPA ' OR
        Encabezado like ' SIMAS ' OR
        Encabezado like ' SIMAPA ' OR
        Encabezado like ' AGSAL ' OR
        Encabezado like ' CIAPACOV ' OR
        Encabezado like ' CAPDAM ' OR
        Encabezado like ' SIDEA ' OR
        Encabezado like ' SIDEAPAS ' OR
        Encabezado like ' OADAP ' OR
        Encabezado like ' ADAPAS ' OR
        Encabezado like ' OPDM ' OR
        Encabezado like ' AIST ' OR
        Encabezado like ' APAST ' OR
        Encabezado like ' CAPAMA ' OR
        Encabezado like ' CAPAMI ' OR
        Encabezado like ' CAPAZ ' OR
        Encabezado like ' JUMAPA ' OR
        Encabezado like ' JAMAPI ' OR
        Encabezado like ' SAPAL ' OR
        Encabezado like ' CMAPAS ' OR
        Encabezado like ' CAPAMIH ' OR
        Encabezado like ' CEAA ' OR
        Encabezado like ' CAAMT ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' SEAPAL ' OR
        Encabezado like ' OROMAPAS ' OR
        Encabezado like ' CAPALAC ' OR
        Encabezado like ' OOAPAS ' OR
        Encabezado like ' OOAPASQ ' OR
        Encabezado like ' OMSAP ' OR
        Encabezado like ' CAPASU ' OR
        Encabezado like ' SAPAZ ' OR
        Encabezado like ' SOAPSC ' OR
        Encabezado like ' SAPAC ' OR
        Encabezado like ' SMAPEZ ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' OOMAPPI ' OR
        Encabezado like ' SCAPSAT ' OR
        Encabezado like ' SAP ' OR
        Encabezado like ' SAPASXO ' OR
        Encabezado like ' SCAPSZ ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' SADM ' OR
        Encabezado like ' ADOSAPACO ' OR
        Encabezado like ' SOAPAP ' OR
        Encabezado like ' SOAPAIM ' OR
        Encabezado like ' JAPAM ' OR
        Encabezado like ' CEA ' OR
        Encabezado like ' CAPA ' OR
        Encabezado like ' JMM ' OR
        Encabezado like ' JAPAC ' OR
        Encabezado like ' JUMAPAG ' OR
        Encabezado like ' JUMAPA ' OR
        Encabezado like ' JUMAPAN ' OR
        Encabezado like ' DAPA ' OR
        Encabezado like ' COMAP ' OR
        Encabezado like ' OOMAPAS ' OR
        Encabezado like ' COMAPA ' OR
        Encabezado like ' JAD ' OR
        Encabezado like ' CAPAM ' OR
        Encabezado like ' CMAPS ' OR
        Encabezado like ' CRAS ' OR
        Encabezado like ' CAPA ' OR
        Encabezado like ' JAPAY ' OR
        Encabezado like ' SAPAMV ' OR
        Encabezado like ' SIAPASF ' OR
        Encabezado like ' JIAPAZ ' OR
        Encabezado like '%Agua Potable%' OR
        Encabezado like '%Agua Potable y alcantarillado%' OR
        Encabezado like '%comision ciudadana de apa%' OR
        Encabezado like '%comision estatal de servicios publicos%' OR
        Encabezado like '%organismo operador municipal del sistema de apa y smto%' OR
        Encabezado like '%organismo del sistema de agua%' OR
        Encabezado like '%junta municipal de agua y saneamiento%' OR
        Encabezado like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%junta municipal de agua y saneamiento%' OR
        Encabezado like '%sistema municipal de apa municipal%' OR
        Encabezado like '%comite de apa tapachula%' OR
        Encabezado like '%sistema municipal de apa%' OR
        Encabezado like '%sistemas municipal de aguas y saneamiento%' OR
        Encabezado like '%sistema municipal de agua y saneamiento de frontera%' OR
        Encabezado like '%sistemas municipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%comision de agua potable y drenaje y alcantarillado%' OR
        Encabezado like '%sistema descentralizado de apa y saneamiento%' OR
        Encabezado like '%organismo publico descentralizado municipal de apa y smto%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Encabezado like '%junta de apa del municipio de irapuato%' OR
        Encabezado like '%sistema de apa de leon%' OR
        Encabezado like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Encabezado like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Encabezado like '%general de comision estatal de agua y alcantarillado%' OR
        Encabezado like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Encabezado like '%sistema municipal de los servicios de APA%' OR
        Encabezado like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
        Encabezado like '%organismo municipal de servicios de agua potable%' OR
        Encabezado like '%comision de apa y saneamiento%' OR
        Encabezado like '%sistema de apa%' OR
        Encabezado like '%sistema ordenador de agua potable y saneamiento%' OR
        Encabezado like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Encabezado like '%sistema municipal de agua potable emiliano zapata%' OR
        Encabezado like '%sistema de agua potable de huitzilac y tres marias%' OR
        Encabezado like '%sistema de conservacion de agua potable y saneamiento%' OR
        Encabezado like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Encabezado like '%sistema de agua potable y saneamiento de temixco%' OR
        Encabezado like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Encabezado like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Encabezado like '%sistema operador de los servicios de apa%' OR
        Encabezado like '%sistema operador de los servicios de apa%' OR
        Encabezado like '%junta de agua potable y alcantarillado municipal%' OR
        Encabezado like '%comision estatal de aguas%' OR
        Encabezado like '%comision de apa%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%junta municipal de apa de culiacan%' OR
        Encabezado like '%junta municipal de agua potable y alcantarillado%' OR
        Encabezado like '%junta de apa del mpio%' OR
        Encabezado like '%junta municipal de apa%' OR
        Encabezado like '%direccion de apa y saneamiento%' OR
        Encabezado like '%comision municipal de agua potable%' OR
        Encabezado like '%comision de apa%' OR
        Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
        Encabezado like '%comision municipal de agua potable%' OR
        Encabezado like '%agua de hermosillo%' OR
        Encabezado like '%organismo operador municiapal de apa y saneamiento%' OR
        Encabezado like '%junta de aguas y drenaje%' OR
        Encabezado like '%comision municipal de apa%' OR
        Encabezado like '%comision de apa del municipio de tlaxcala%' OR
        Encabezado like '%comision municipal de agua potable y saneamiento%' OR
        Encabezado like '%sas metropolitano%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%junta de agua potable y alcantarillado%' OR
        Encabezado like '%sistema de agua potable y alcantarillado%' OR
        Encabezado like '%sistema de apa y smto%' OR
        Encabezado like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Encabezado like '%acueducto%' OR
        Encabezado like '%canal de riego%' OR
        Encabezado like '%planta de tratamiento de aguas residuales%' OR
        Encabezado like '% PTAR %' OR
        Encabezado like '%Carcamo%' OR
        Encabezado like '%planta de bombeo%'

)
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 17://Organismos Cuenca - DF 
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
        Texto LIKE '%Organismos de Cuenca%' OR      
        Titulo LIKE '%Organismos de Cuenca%' OR
        Encabezado LIKE '%Organismos de Cuenca%' OR
        PieFoto LIKE '%Organismos de Cuenca%' OR 
        Autor LIKE '%Organismos de Cuenca%'
        )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 18://Organismos cuenca - Estados
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
        Texto LIKE '%Organismos de Cuenca%' OR      
        Titulo LIKE '%Organismos de Cuenca%' OR
        Encabezado LIKE '%Organismos de Cuenca%' OR
        PieFoto LIKE '%Organismos de Cuenca%' OR 
        Autor LIKE '%Organismos de Cuenca%'
        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 19://ANEAS - DF 
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
        Texto LIKE '% ANEAS %' OR   
        Texto LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%' OR   
   
        Titulo LIKE '% ANEAS %' OR
        Titulo LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%' OR

        Encabezado LIKE '% ANEAS %' OR
        Encabezado LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%' OR

        PieFoto LIKE '% ANEAS %' OR 
        PieFoto LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%' OR 

        Autor LIKE '% ANEAS %' OR
        Autor LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%'
        )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 20://ANEAS - Estados
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
        Texto LIKE '% ANEAS %' OR   
        Texto LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%' OR   
   
        Titulo LIKE '% ANEAS %' OR
        Titulo LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%' OR

        Encabezado LIKE '% ANEAS %' OR
        Encabezado LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%' OR

        PieFoto LIKE '% ANEA S%' OR 
        PieFoto LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%' OR 

        Autor LIKE '% ANEA S%' OR
        Autor LIKE '%Asociacion Nacional de Empresas de Agua y Saneamiento%'
        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 21://SEMARNAT - DF 
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
        Texto like '%SEMARNAT%' OR
	Texto like '%(semarnat)%' OR
        Texto like '%secretaria de medio ambiente y recursos naturales%' OR
        Texto like '%secretaria del medio ambiente%' OR
        Texto like '%rafael pacchiano Alaman%' OR
        Texto like '%rafael pacchiano%' OR
        Texto like '%pacchiano Alaman%' OR
        
        Titulo like '%SEMARNAT%'  OR
        Titulo like '%(semarnat)%' OR
        Titulo like '%secretaria de medio ambiente y recursos naturales%' OR
        Titulo like '%secretaria del medio ambiente%' OR
        Titulo like '%rafael pacchiano Alaman%' OR
        Titulo like '%rafael pacchiano%' OR
        Titulo like '%pacchiano Alaman%' OR
        
        Encabezado like '%SEMARNAT%' OR
        Encabezado like '%(semarnat)%' OR
        Encabezado like '%secretaria de medio ambiente y recursos naturales%' OR
        Encabezado like '%secretaria del medio ambiente%' OR
        Encabezado like '%rafael pacchiano Alaman%' OR
        Encabezado like '%rafael pacchiano%' OR
        Encabezado like '%pacchiano Alaman%'
       )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 22://SEMARNAT - Estados
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
        Texto like '%SEMARNAT%' OR
	Texto like '%(semarnat)%' OR
        Texto like '%secretaria de medio ambiente y recursos naturales%' OR
        Texto like '%secretaria del medio ambiente%' OR
        Texto like '%rafael pacchiano Alaman%' OR
        Texto like '%rafael pacchiano%' OR
        Texto like '%pacchiano Alaman%' OR
        
        Titulo like '%SEMARNAT%'  OR
        Titulo like '%(semarnat)%' OR
        Titulo like '%secretaria de medio ambiente y recursos naturales%' OR
        Titulo like '%secretaria del medio ambiente%' OR
        Titulo like '%rafael pacchiano Alaman%' OR
        Titulo like '%rafael pacchiano%' OR
        Titulo like '%pacchiano Alaman%' OR
        
        Encabezado like '%SEMARNAT%' OR
        Encabezado like '%(semarnat)%' OR
        Encabezado like '%secretaria de medio ambiente y recursos naturales%' OR
        Encabezado like '%secretaria del medio ambiente%' OR
        Encabezado like '%rafael pacchiano Alaman%' OR
        Encabezado like '%rafael pacchiano%' OR
        Encabezado like '%pacchiano Alaman%'
       )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 23://Ley Aguas - DF 
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
    Texto like'%Ley General de Aguas%' OR
    Texto like'%Ley de Aguas Nacionales%' OR
    Texto like'%Ley General de Agua Nacionales%' OR

    Titulo like'%Ley General de Aguas%' OR
    Titulo like'%Ley de Aguas Nacionales%' OR
    Titulo like'%Ley General de Agua Nacionales%' OR

    Encabezado like'%Ley General de Aguas%' OR
    Encabezado like'%Ley de Aguas Nacionales%' OR
    Encabezado like'%Ley General de Agua Nacionales%' OR

    PieFoto like'%Ley General de Aguas%' OR
    PieFoto like'%Ley de Aguas Nacionales%' OR
    PieFoto like'%Ley General de Agua Nacionales%' OR

    Autor like'%Ley General de Aguas%' OR
    Autor like'%Ley de Aguas Nacionales%' OR
    Autor like'%Ley General de Agua Nacionales%'
  )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 24://Ley Aguas - Estados
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
    Texto like'%Ley General de Aguas%' OR
    Texto like'%Ley de Aguas Nacionales%' OR
    Texto like'%Ley General de Agua Nacionales%' OR

    Titulo like'%Ley General de Aguas%' OR
    Titulo like'%Ley de Aguas Nacionales%' OR
    Titulo like'%Ley General de Agua Nacionales%' OR

    Encabezado like'%Ley General de Aguas%' OR
    Encabezado like'%Ley de Aguas Nacionales%' OR
    Encabezado like'%Ley General de Agua Nacionales%' OR

    PieFoto like'%Ley General de Aguas%' OR
    PieFoto like'%Ley de Aguas Nacionales%' OR
    PieFoto like'%Ley General de Agua Nacionales%' OR

    Autor like'%Ley General de Aguas%' OR
    Autor like'%Ley de Aguas Nacionales%' OR
    Autor like'%Ley General de Agua Nacionales%'
  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 25://Acueducto MTr - DF 
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
    Texto like'%Acueducto Monterrey 6%' OR
    Texto like'%Acueducto Monterrey VI%' OR

    Titulo like'%Acueducto Monterrey 6%' OR
    Titulo like'%Acueducto Monterrey VI%' OR

    Encabezado like'%Acueducto Monterrey 6%' OR
    Encabezado like'%Acueducto Monterrey VI%' OR

    PieFoto like'%Acueducto Monterrey 6%' OR
    PieFoto like'%Acueducto Monterrey VI%' OR

    Autor like'%Acueducto Monterrey 6%' OR
    Autor like'%Acueducto Monterrey VI%' 
  )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 26://Acueducto MTR - Estados
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
    Texto like'%Acueducto Monterrey 6%' OR
    Texto like'%Acueducto Monterrey VI%' OR

    Titulo like'%Acueducto Monterrey 6%' OR
    Titulo like'%Acueducto Monterrey VI%' OR

    Encabezado like'%Acueducto Monterrey 6%' OR
    Encabezado like'%Acueducto Monterrey VI%' OR

    PieFoto like'%Acueducto Monterrey 6%' OR
    PieFoto like'%Acueducto Monterrey VI%' OR

    Autor like'%Acueducto Monterrey 6%' OR
    Autor like'%Acueducto Monterrey VI%' 
  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        case 27://Varios - DF 
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
       
Texto like '%sistema Meteorologico nacional%' OR
        Texto like '%(SMN)%' OR
        Texto like '% SMN%' OR
        Texto like '%pronostico meteorologico%' OR
        Texto like '%huracanes%' OR
        Texto like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        Texto like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Texto like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Texto like '%temporada de lluvia%' OR
        Texto like '%tormenta tropical%' OR
        Texto like '%ciclones%' OR
        Texto like '%Fenomenos climatologicos%' OR
        Texto like '%frentes frios%' OR
        Texto like '%frente frio%' OR
        Texto like '% helada%' and texto not like '%cerveza%' OR
        
        Titulo like '%sistema Meteorologico nacional%' OR
        Titulo like '%(SMN)%' OR
        Titulo like '% SMN%' OR
        Titulo like '%pronostico meteorologico%' OR
        Titulo like '%huracanes%' OR
        Titulo like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        Titulo like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Titulo like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Titulo like '%temporada de lluvia%' OR
        Titulo like '%tormenta tropical%' OR
        Titulo like '%ciclones%' OR
        Titulo like '%Fenomenos climatologicos%' OR
        Titulo like '%frentes frios%' OR
        Titulo like '%frente frio%' OR
        Titulo like '% helada%' and texto not like '%cerveza%' OR
            
        Encabezado like '%sistema Meteorologico nacional%' OR
        Encabezado like '%(SMN)%' OR
        Encabezado like '% SMN%' OR
        Encabezado like '%pronostico meteorologico%' OR
        Encabezado like '%huracanes%' OR
        Encabezado like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        Encabezado like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Encabezado like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Encabezado like '%temporada de lluvia%' OR
        Encabezado like '%tormenta tropical%' OR
        Encabezado like '%ciclones%' OR
        Encabezado like '%Fenomenos climatologicos%' OR
        Encabezado like '%frentes frios%' OR
        Encabezado like '%frente frio%' OR
        Encabezado like '% helada%' and texto not like '%cerveza%' OR

        PieFoto like '%sistema Meteorologico nacional%' OR
        PieFoto like '%(SMN)%' OR
        PieFoto like '% SMN%' OR
        PieFoto like '%pronostico meteorologico%' OR
        PieFoto like '%huracanes%' OR
        PieFoto like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        PieFoto like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        PieFoto like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        PieFoto like '%temporada de lluvia%' OR
        PieFoto like '%tormenta tropical%' OR
        PieFoto like '%ciclones%' OR
        PieFoto like '%Fenomenos climatologicos%' OR
        PieFoto like '%frentes frios%' OR
        PieFoto like '%frente frio%' OR
        PieFoto like '% helada%' and texto not like '%cerveza%' OR

        Autor like '%sistema Meteorologico nacional%' OR
        Autor like '%(SMN)%' OR
        Autor like '% SMN%' OR
        Autor like '%pronostico meteorologico%' OR
        Autor like '%huracanes%' OR
        Autor like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        Autor like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Autor like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Autor like '%temporada de lluvia%' OR
        Autor like '%tormenta tropical%' OR
        Autor like '%ciclones%' OR
        Autor like '%Fenomenos climatologicos%' OR
        Autor like '%frentes frios%' OR
        Autor like '%frente frio%' OR
        Autor like '% helada%' and texto not like '%cerveza%' OR


        Texto like '%sector hidraulico%' OR
        Texto like 'ANEAS' OR
        Texto like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Texto like '%uniades de riego%' OR
        Texto like '%modulo de riego%' OR
        Texto like '%modulos de riego%' OR
        Texto like '%junta municipal de agua%' OR
        Texto like '%organismos operadores%' OR
        Texto like '%comision estatal del agua%' OR
        Texto like ' CCAP ' OR
        Texto like ' CESPE ' OR
        Texto like ' CESPM ' OR
        Texto like ' CESPETE ' OR
        Texto like ' CESPT ' OR
        Texto like ' SAPA ' OR
        Texto like ' OSAGUA ' OR
        Texto like ' JMAS ' OR
        Texto like ' SIMAS ' OR
        Texto like ' SAPAM ' OR
        Texto like ' COAPATAP ' OR
        Texto like ' SMAPA ' OR
        Texto like ' SIMAS ' OR
        Texto like ' SIMAPA ' OR
        Texto like ' AGSAL ' OR
        Texto like ' CIAPACOV ' OR
        Texto like ' CAPDAM ' OR
        Texto like ' SIDEA ' OR
        Texto like ' SIDEAPAS ' OR
        Texto like ' OADAP ' OR
        Texto like ' ADAPAS ' OR
        Texto like ' OPDM ' OR
        Texto like ' AIST ' OR
        Texto like ' APAST ' OR
        Texto like ' CAPAMA ' OR
        Texto like ' CAPAMI ' OR
        Texto like ' CAPAZ ' OR
        Texto like ' JUMAPA ' OR
        Texto like ' JAMAPI ' OR
        Texto like ' SAPAL ' OR
        Texto like ' CMAPAS ' OR
        Texto like ' CAPAMIH ' OR
        Texto like ' CEAA ' OR
        Texto like ' CAAMT ' OR
        Texto like ' SIAPA ' OR
        Texto like ' SEAPAL ' OR
        Texto like ' OROMAPAS ' OR
        Texto like ' CAPALAC ' OR
        Texto like ' OOAPAS ' OR
        Texto like ' OOAPASQ ' OR
        Texto like ' OMSAP ' OR
        Texto like ' CAPASU ' OR
        Texto like ' SAPAZ ' OR
        Texto like ' SOAPSC ' OR
        Texto like ' SAPAC ' OR
        Texto like ' SMAPEZ ' OR
        Texto like ' SIAPA ' OR
        Texto like ' OOMAPPI ' OR
        Texto like ' SCAPSAT ' OR
        Texto like ' SAP ' OR
        Texto like ' SAPASXO ' OR
        Texto like ' SCAPSZ ' OR
        Texto like ' SIAPA ' OR
        Texto like ' SADM ' OR
        Texto like ' ADOSAPACO ' OR
        Texto like ' SOAPAP ' OR
        Texto like ' SOAPAIM ' OR
        Texto like ' JAPAM ' OR
        Texto like ' CEA ' OR
        Texto like ' CAPA ' OR
        Texto like ' JMM ' OR
        Texto like ' JAPAC ' OR
        Texto like ' JUMAPAG ' OR
        Texto like ' JUMAPA ' OR
        Texto like ' JUMAPAN ' OR
        Texto like ' DAPA ' OR
        Texto like ' COMAP ' OR
        Texto like ' OOMAPAS ' OR
        Texto like ' COMAPA ' OR
        Texto like ' JAD ' OR
        Texto like ' CAPAM ' OR
        Texto like ' CMAPS ' OR
        Texto like ' CRAS ' OR
        Texto like ' CAPA ' OR
        Texto like ' JAPAY ' OR
        Texto like ' SAPAMV ' OR
        Texto like ' SIAPASF ' OR
        Texto like ' JIAPAZ ' OR
        Texto like '%Agua Potable%' OR
        Texto like '%Agua Potable y alcantarillado%' OR
        Texto like '%comision ciudadana de apa%' OR
        Texto like '%comision estatal de servicios publicos%' OR
        Texto like '%organismo operador municipal del sistema de apa y smto%' OR
        Texto like '%organismo del sistema de agua%' OR
        Texto like '%junta municipal de agua y saneamiento%' OR
        Texto like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%junta municipal de agua y saneamiento%' OR
        Texto like '%sistema municipal de apa municipal%' OR
        Texto like '%comite de apa tapachula%' OR
        Texto like '%sistema municipal de apa%' OR
        Texto like '%sistemas municipal de aguas y saneamiento%' OR
        Texto like '%sistema municipal de agua y saneamiento de frontera%' OR
        Texto like '%sistemas municipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%comision de agua potable y drenaje y alcantarillado%' OR
        Texto like '%sistema descentralizado de apa y saneamiento%' OR
        Texto like '%organismo publico descentralizado municipal de apa y smto%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Texto like '%junta de apa del municipio de irapuato%' OR
        Texto like '%sistema de apa de leon%' OR
        Texto like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Texto like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Texto like '%general de comision estatal de agua y alcantarillado%' OR
        Texto like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Texto like '%sistema municipal de los servicios de APA%' OR
        Texto like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Texto like '%organismo operador municipal de apa y saneamiento%' OR
        Texto like '%organismo municipal de servicios de agua potable%' OR
        Texto like '%comision de apa y saneamiento%' OR
        Texto like '%sistema de apa%' OR
        Texto like '%sistema ordenador de agua potable y saneamiento%' OR
        Texto like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Texto like '%sistema municipal de agua potable emiliano zapata%' OR
        Texto like '%sistema de agua potable de huitzilac y tres marias%' OR
        Texto like '%sistema de conservacion de agua potable y saneamiento%' OR
        Texto like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Texto like '%sistema de agua potable y saneamiento de temixco%' OR
        Texto like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Texto like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Texto like '%sistema operador de los servicios de apa%' OR
        Texto like '%sistema operador de los servicios de apa%' OR
        Texto like '%junta de agua potable y alcantarillado municipal%' OR
        Texto like '%comision estatal de aguas%' OR
        Texto like '%comision de apa%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%junta municipal de apa de culiacan%' OR
        Texto like '%junta municipal de agua potable y alcantarillado%' OR
        Texto like '%junta de apa del mpio%' OR
        Texto like '%junta municipal de apa%' OR
        Texto like '%direccion de apa y saneamiento%' OR
        Texto like '%comision municipal de agua potable%' OR
        Texto like '%comision de apa%' OR
        Texto like '%organismo operador municipal de apa y saneamiento%' OR
        Texto like '%comision municipal de agua potable%' OR
        Texto like '%agua de hermosillo%' OR
        Texto like '%organismo operador municiapal de apa y saneamiento%' OR
        Texto like '%junta de aguas y drenaje%' OR
        Texto like '%comision municipal de apa%' OR
        Texto like '%comision de apa del municipio de tlaxcala%' OR
        Texto like '%comision municipal de agua potable y saneamiento%' OR
        Texto like '%sas metropolitano%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%junta de agua potable y alcantarillado%' OR
        Texto like '%sistema de agua potable y alcantarillado%' OR
        Texto like '%sistema de apa y smto%' OR
        Texto like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Texto like '%acueducto%' OR
        Texto like '%canal de riego%' OR
        Texto like '%planta de tratamiento de aguas residuales%' OR
        Texto like '% PTAR %' OR
        Texto like '%Carcamo%' OR
        Texto like '%planta de bombeo%' OR




        Titulo like '%sector hidraulico%' OR
        Titulo like 'ANEAS' OR
        Titulo like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Titulo like '%uniades de riego%' OR
        Titulo like '%modulo de riego%' OR
        Titulo like '%modulos de riego%' OR
        Titulo like '%junta municipal de agua%' OR
        Titulo like '%organismos operadores%' OR
        Titulo like '%comision estatal del agua%' OR

        Titulo like ' CCAP ' OR
        Titulo like ' CESPE ' OR
        Titulo like ' CESPM ' OR
        Titulo like ' CESPETE ' OR
        Titulo like ' CESPT ' OR
        Titulo like ' SAPA ' OR
        Titulo like ' OSAGUA ' OR
        Titulo like ' JMAS ' OR
        Titulo like ' SIMAS ' OR
        Titulo like ' SAPAM ' OR
        Titulo like ' COAPATAP ' OR
        Titulo like ' SMAPA ' OR
        Titulo like ' SIMAS ' OR
        Titulo like ' SIMAPA ' OR
        Titulo like ' AGSAL ' OR
        Titulo like ' CIAPACOV ' OR
        Titulo like ' CAPDAM ' OR
        Titulo like ' SIDEA ' OR
        Titulo like ' SIDEAPAS ' OR
        Titulo like ' OADAP ' OR
        Titulo like ' ADAPAS ' OR
        Titulo like ' OPDM ' OR
        Titulo like ' AIST ' OR
        Titulo like ' APAST ' OR
        Titulo like ' CAPAMA ' OR
        Titulo like ' CAPAMI ' OR
        Titulo like ' CAPAZ ' OR
        Titulo like ' JUMAPA ' OR
        Titulo like ' JAMAPI ' OR
        Titulo like ' SAPAL ' OR
        Titulo like ' CMAPAS ' OR
        Titulo like ' CAPAMIH ' OR
        Titulo like ' CEAA ' OR
        Titulo like ' CAAMT ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' SEAPAL ' OR
        Titulo like ' OROMAPAS ' OR
        Titulo like ' CAPALAC ' OR
        Titulo like ' OOAPAS ' OR
        Titulo like ' OOAPASQ ' OR
        Titulo like ' OMSAP ' OR
        Titulo like ' CAPASU ' OR
        Titulo like ' SAPAZ ' OR
        Titulo like ' SOAPSC ' OR
        Titulo like ' SAPAC ' OR
        Titulo like ' SMAPEZ ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' OOMAPPI ' OR
        Titulo like ' SCAPSAT ' OR
        Titulo like ' SAP ' OR
        Titulo like ' SAPASXO ' OR
        Titulo like ' SCAPSZ ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' SADM ' OR
        Titulo like ' ADOSAPACO ' OR
        Titulo like ' SOAPAP ' OR
        Titulo like ' SOAPAIM ' OR
        Titulo like ' JAPAM ' OR
        Titulo like ' CEA ' OR
        Titulo like ' CAPA ' OR
        Titulo like ' JMM ' OR
        Titulo like ' JAPAC ' OR
        Titulo like ' JUMAPAG ' OR
        Titulo like ' JUMAPA ' OR
        Titulo like ' JUMAPAN ' OR
        Titulo like ' DAPA ' OR
        Titulo like ' COMAP ' OR
        Titulo like ' OOMAPAS ' OR
        Titulo like ' COMAPA ' OR
        Titulo like ' JAD ' OR
        Titulo like ' CAPAM ' OR
        Titulo like ' CMAPS ' OR
        Titulo like ' CRAS ' OR
        Titulo like ' CAPA ' OR
        Titulo like ' JAPAY ' OR
        Titulo like ' SAPAMV ' OR
        Titulo like ' SIAPASF ' OR
        Titulo like ' JIAPAZ ' OR
        Titulo like '%Agua Potable%' OR
        Titulo like '%Agua Potable y alcantarillado%' OR
        Titulo like '%comision ciudadana de apa%' OR
        Titulo like '%comision estatal de servicios publicos%' OR
        Titulo like '%organismo operador municipal del sistema de apa y smto%' OR
        Titulo like '%organismo del sistema de agua%' OR
        Titulo like '%junta municipal de agua y saneamiento%' OR
        Titulo like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%junta municipal de agua y saneamiento%' OR
        Titulo like '%sistema municipal de apa municipal%' OR
        Titulo like '%comite de apa tapachula%' OR
        Titulo like '%sistema municipal de apa%' OR
        Titulo like '%sistemas municipal de aguas y saneamiento%' OR
        Titulo like '%sistema municipal de agua y saneamiento de frontera%' OR
        Titulo like '%sistemas municipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%comision de agua potable y drenaje y alcantarillado%' OR
        Titulo like '%sistema descentralizado de apa y saneamiento%' OR
        Titulo like '%organismo publico descentralizado municipal de apa y smto%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Titulo like '%junta de apa del municipio de irapuato%' OR
        Titulo like '%sistema de apa de leon%' OR
        Titulo like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Titulo like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Titulo like '%general de comision estatal de agua y alcantarillado%' OR
        Titulo like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Titulo like '%sistema municipal de los servicios de APA%' OR
        Titulo like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Titulo like '%organismo operador municipal de apa y saneamiento%' OR
        Titulo like '%organismo municipal de servicios de agua potable%' OR
        Titulo like '%comision de apa y saneamiento%' OR
        Titulo like '%sistema de apa%' OR
        Titulo like '%sistema ordenador de agua potable y saneamiento%' OR
        Titulo like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Titulo like '%sistema municipal de agua potable emiliano zapata%' OR
        Titulo like '%sistema de agua potable de huitzilac y tres marias%' OR
        Titulo like '%sistema de conservacion de agua potable y saneamiento%' OR
        Titulo like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Titulo like '%sistema de agua potable y saneamiento de temixco%' OR
        Titulo like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Titulo like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Titulo like '%sistema operador de los servicios de apa%' OR
        Titulo like '%sistema operador de los servicios de apa%' OR
        Titulo like '%junta de agua potable y alcantarillado municipal%' OR
        Titulo like '%comision estatal de aguas%' OR
        Titulo like '%comision de apa%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%junta municipal de apa de culiacan%' OR
        Titulo like '%junta municipal de agua potable y alcantarillado%' OR
        Titulo like '%junta de apa del mpio%' OR
        Titulo like '%junta municipal de apa%' OR
        Titulo like '%direccion de apa y saneamiento%' OR
        Titulo like '%comision municipal de agua potable%' OR
        Titulo like '%comision de apa%' OR
        Titulo like '%organismo operador municipal de apa y saneamiento%' OR
        Titulo like '%comision municipal de agua potable%' OR
        Titulo like '%agua de hermosillo%' OR
        Texto like '%organismo operador municiapal de apa y saneamiento%' OR
        Texto like '%junta de aguas y drenaje%' OR
        Texto like '%comision municipal de apa%' OR
        Texto like '%comision de apa del municipio de tlaxcala%' OR
        Titulo like '%comision municipal de agua potable y saneamiento%' OR
        Titulo like '%sas metropolitano%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%junta de agua potable y alcantarillado%' OR
        Titulo like '%sistema de agua potable y alcantarillado%' OR
        Titulo like '%sistema de apa y smto%' OR
        Titulo like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Titulo like '%acueducto%' OR
        Titulo like '%canal de riego%' OR
        Titulo like '%planta de tratamiento de aguas residuales%' OR
        Titulo like '% PTAR %' OR
        Titulo like '%Carcamo%' OR
        Titulo like '%planta de bombeo%' OR


        Encabezado like '%sector hidraulico%' OR
        Encabezado like 'ANEAS' OR
        Encabezado like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Encabezado like '%uniades de riego%' OR
        Encabezado like '%modulo de riego%' OR
        Encabezado like '%modulos de riego%' OR
        Encabezado like '%junta municipal de agua%' OR
        Encabezado like '%organismos operadores%' OR
        Encabezado like '%comision estatal del agua%' OR

        Encabezado like ' CCAP ' OR
        Encabezado like ' CESPE ' OR
        Encabezado like ' CESPM ' OR
        Encabezado like ' CESPETE ' OR
        Encabezado like ' CESPT ' OR
        Encabezado like ' SAPA ' OR
        Encabezado like ' OSAGUA ' OR
        Encabezado like ' JMAS ' OR
        Encabezado like ' SIMAS ' OR
        Encabezado like ' SAPAM ' OR
        Encabezado like ' COAPATAP ' OR
        Encabezado like ' SMAPA ' OR
        Encabezado like ' SIMAS ' OR
        Encabezado like ' SIMAPA ' OR
        Encabezado like ' AGSAL ' OR
        Encabezado like ' CIAPACOV ' OR
        Encabezado like ' CAPDAM ' OR
        Encabezado like ' SIDEA ' OR
        Encabezado like ' SIDEAPAS ' OR
        Encabezado like ' OADAP ' OR
        Encabezado like ' ADAPAS ' OR
        Encabezado like ' OPDM ' OR
        Encabezado like ' AIST ' OR
        Encabezado like ' APAST ' OR
        Encabezado like ' CAPAMA ' OR
        Encabezado like ' CAPAMI ' OR
        Encabezado like ' CAPAZ ' OR
        Encabezado like ' JUMAPA ' OR
        Encabezado like ' JAMAPI ' OR
        Encabezado like ' SAPAL ' OR
        Encabezado like ' CMAPAS ' OR
        Encabezado like ' CAPAMIH ' OR
        Encabezado like ' CEAA ' OR
        Encabezado like ' CAAMT ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' SEAPAL ' OR
        Encabezado like ' OROMAPAS ' OR
        Encabezado like ' CAPALAC ' OR
        Encabezado like ' OOAPAS ' OR
        Encabezado like ' OOAPASQ ' OR
        Encabezado like ' OMSAP ' OR
        Encabezado like ' CAPASU ' OR
        Encabezado like ' SAPAZ ' OR
        Encabezado like ' SOAPSC ' OR
        Encabezado like ' SAPAC ' OR
        Encabezado like ' SMAPEZ ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' OOMAPPI ' OR
        Encabezado like ' SCAPSAT ' OR
        Encabezado like ' SAP ' OR
        Encabezado like ' SAPASXO ' OR
        Encabezado like ' SCAPSZ ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' SADM ' OR
        Encabezado like ' ADOSAPACO ' OR
        Encabezado like ' SOAPAP ' OR
        Encabezado like ' SOAPAIM ' OR
        Encabezado like ' JAPAM ' OR
        Encabezado like ' CEA ' OR
        Encabezado like ' CAPA ' OR
        Encabezado like ' JMM ' OR
        Encabezado like ' JAPAC ' OR
        Encabezado like ' JUMAPAG ' OR
        Encabezado like ' JUMAPA ' OR
        Encabezado like ' JUMAPAN ' OR
        Encabezado like ' DAPA ' OR
        Encabezado like ' COMAP ' OR
        Encabezado like ' OOMAPAS ' OR
        Encabezado like ' COMAPA ' OR
        Encabezado like ' JAD ' OR
        Encabezado like ' CAPAM ' OR
        Encabezado like ' CMAPS ' OR
        Encabezado like ' CRAS ' OR
        Encabezado like ' CAPA ' OR
        Encabezado like ' JAPAY ' OR
        Encabezado like ' SAPAMV ' OR
        Encabezado like ' SIAPASF ' OR
        Encabezado like ' JIAPAZ ' OR
        Encabezado like '%Agua Potable%' OR
        Encabezado like '%Agua Potable y alcantarillado%' OR
        Encabezado like '%comision ciudadana de apa%' OR
        Encabezado like '%comision estatal de servicios publicos%' OR
        Encabezado like '%organismo operador municipal del sistema de apa y smto%' OR
        Encabezado like '%organismo del sistema de agua%' OR
        Encabezado like '%junta municipal de agua y saneamiento%' OR
        Encabezado like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%junta municipal de agua y saneamiento%' OR
        Encabezado like '%sistema municipal de apa municipal%' OR
        Encabezado like '%comite de apa tapachula%' OR
        Encabezado like '%sistema municipal de apa%' OR
        Encabezado like '%sistemas municipal de aguas y saneamiento%' OR
        Encabezado like '%sistema municipal de agua y saneamiento de frontera%' OR
        Encabezado like '%sistemas municipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%comision de agua potable y drenaje y alcantarillado%' OR
        Encabezado like '%sistema descentralizado de apa y saneamiento%' OR
        Encabezado like '%organismo publico descentralizado municipal de apa y smto%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Encabezado like '%junta de apa del municipio de irapuato%' OR
        Encabezado like '%sistema de apa de leon%' OR
        Encabezado like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Encabezado like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Encabezado like '%general de comision estatal de agua y alcantarillado%' OR
        Encabezado like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Encabezado like '%sistema municipal de los servicios de APA%' OR
        Encabezado like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
        Encabezado like '%organismo municipal de servicios de agua potable%' OR
        Encabezado like '%comision de apa y saneamiento%' OR
        Encabezado like '%sistema de apa%' OR
        Encabezado like '%sistema ordenador de agua potable y saneamiento%' OR
        Encabezado like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Encabezado like '%sistema municipal de agua potable emiliano zapata%' OR
        Encabezado like '%sistema de agua potable de huitzilac y tres marias%' OR
        Encabezado like '%sistema de conservacion de agua potable y saneamiento%' OR
        Encabezado like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Encabezado like '%sistema de agua potable y saneamiento de temixco%' OR
        Encabezado like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Encabezado like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Encabezado like '%sistema operador de los servicios de apa%' OR
        Encabezado like '%sistema operador de los servicios de apa%' OR
        Encabezado like '%junta de agua potable y alcantarillado municipal%' OR
        Encabezado like '%comision estatal de aguas%' OR
        Encabezado like '%comision de apa%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%junta municipal de apa de culiacan%' OR
        Encabezado like '%junta municipal de agua potable y alcantarillado%' OR
        Encabezado like '%junta de apa del mpio%' OR
        Encabezado like '%junta municipal de apa%' OR
        Encabezado like '%direccion de apa y saneamiento%' OR
        Encabezado like '%comision municipal de agua potable%' OR
        Encabezado like '%comision de apa%' OR
        Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
        Encabezado like '%comision municipal de agua potable%' OR
        Encabezado like '%agua de hermosillo%' OR
        Encabezado like '%organismo operador municiapal de apa y saneamiento%' OR
        Encabezado like '%junta de aguas y drenaje%' OR
        Encabezado like '%comision municipal de apa%' OR
        Encabezado like '%comision de apa del municipio de tlaxcala%' OR
        Encabezado like '%comision municipal de agua potable y saneamiento%' OR
        Encabezado like '%sas metropolitano%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%junta de agua potable y alcantarillado%' OR
        Encabezado like '%sistema de agua potable y alcantarillado%' OR
        Encabezado like '%sistema de apa y smto%' OR
        Encabezado like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Encabezado like '%acueducto%' OR
        Encabezado like '%canal de riego%' OR
        Encabezado like '%planta de tratamiento de aguas residuales%' OR
        Encabezado like '% PTAR %' OR
        Encabezado like '%Carcamo%' OR
        Encabezado like '%planta de bombeo%' OR

        PieFoto like '%sector hidraulico%' OR
        PieFoto like 'ANEAS' OR
        PieFoto like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        PieFoto like '%uniades de riego%' OR
        PieFoto like '%modulo de riego%' OR
        PieFoto like '%modulos de riego%' OR
        PieFoto like '%junta municipal de agua%' OR
        PieFoto like '%organismos operadores%' OR
        PieFoto like '%comision estatal del agua%' OR
        PieFoto like ' CCAP ' OR
        PieFoto like ' CESPE ' OR
        PieFoto like ' CESPM ' OR
        PieFoto like ' CESPETE ' OR
        PieFoto like ' CESPT ' OR
        PieFoto like ' SAPA ' OR
        PieFoto like ' OSAGUA ' OR
        PieFoto like ' JMAS ' OR
        PieFoto like ' SIMAS ' OR
        PieFoto like ' SAPAM ' OR
        PieFoto like ' COAPATAP ' OR
        PieFoto like ' SMAPA ' OR
        PieFoto like ' SIMAS ' OR
        PieFoto like ' SIMAPA ' OR
        PieFoto like ' AGSAL ' OR
        PieFoto like ' CIAPACOV ' OR
        PieFoto like ' CAPDAM ' OR
        PieFoto like ' SIDEA ' OR
        PieFoto like ' SIDEAPAS ' OR
        PieFoto like ' OADAP ' OR
        PieFoto like ' ADAPAS ' OR
        PieFoto like ' OPDM ' OR
        PieFoto like ' AIST ' OR
        PieFoto like ' APAST ' OR
        PieFoto like ' CAPAMA ' OR
        PieFoto like ' CAPAMI ' OR
        PieFoto like ' CAPAZ ' OR
        PieFoto like ' JUMAPA ' OR
        PieFoto like ' JAMAPI ' OR
        PieFoto like ' SAPAL ' OR
        PieFoto like ' CMAPAS ' OR
        PieFoto like ' CAPAMIH ' OR
        PieFoto like ' CEAA ' OR
        PieFoto like ' CAAMT ' OR
        PieFoto like ' SIAPA ' OR
        PieFoto like ' SEAPAL ' OR
        PieFoto like ' OROMAPAS ' OR
        PieFoto like ' CAPALAC ' OR
        PieFoto like ' OOAPAS ' OR
        PieFoto like ' OOAPASQ ' OR
        PieFoto like ' OMSAP ' OR
        PieFoto like ' CAPASU ' OR
        PieFoto like ' SAPAZ ' OR
        PieFoto like ' SOAPSC ' OR
        PieFoto like ' SAPAC ' OR
        PieFoto like ' SMAPEZ ' OR
        PieFoto like ' SIAPA ' OR
        PieFoto like ' OOMAPPI ' OR
        PieFoto like ' SCAPSAT ' OR
        PieFoto like ' SAP ' OR
        PieFoto like ' SAPASXO ' OR
        PieFoto like ' SCAPSZ ' OR
        PieFoto like ' SIAPA ' OR
        PieFoto like ' SADM ' OR
        PieFoto like ' ADOSAPACO ' OR
        PieFoto like ' SOAPAP ' OR
        PieFoto like ' SOAPAIM ' OR
        PieFoto like ' JAPAM ' OR
        PieFoto like ' CEA ' OR
        PieFoto like ' CAPA ' OR
        PieFoto like ' JMM ' OR
        PieFoto like ' JAPAC ' OR
        PieFoto like ' JUMAPAG ' OR
        PieFoto like ' JUMAPA ' OR
        PieFoto like ' JUMAPAN ' OR
        PieFoto like ' DAPA ' OR
        PieFoto like ' COMAP ' OR
        PieFoto like ' OOMAPAS ' OR
        PieFoto like ' COMAPA ' OR
        PieFoto like ' JAD ' OR
        PieFoto like ' CAPAM ' OR
        PieFoto like ' CMAPS ' OR
        PieFoto like ' CRAS ' OR
        PieFoto like ' CAPA ' OR
        PieFoto like ' JAPAY ' OR
        PieFoto like ' SAPAMV ' OR
        PieFoto like ' SIAPASF ' OR
        PieFoto like ' JIAPAZ ' OR
        PieFoto like '%Agua Potable%' OR
        PieFoto like '%Agua Potable y alcantarillado%' OR
        PieFoto like '%comision ciudadana de apa%' OR
        PieFoto like '%comision estatal de servicios publicos%' OR
        PieFoto like '%organismo operador municipal del sistema de apa y smto%' OR
        PieFoto like '%organismo del sistema de agua%' OR
        PieFoto like '%junta municipal de agua y saneamiento%' OR
        PieFoto like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        PieFoto like '%sistema municipal de aguas y saneamiento%' OR
        PieFoto like '%junta municipal de agua y saneamiento%' OR
        PieFoto like '%sistema municipal de apa municipal%' OR
        PieFoto like '%comite de apa tapachula%' OR
        PieFoto like '%sistema municipal de apa%' OR
        PieFoto like '%sistemas municipal de aguas y saneamiento%' OR
        PieFoto like '%sistema municipal de agua y saneamiento de frontera%' OR
        PieFoto like '%sistemas municipal de agua potable y alcantarillado%' OR
        PieFoto like '%aguas de saltillo%' OR
        PieFoto like '%sistema municipal de aguas y saneamiento%' OR
        PieFoto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        PieFoto like '%aguas de saltillo%' OR
        PieFoto like '%sistema municipal de aguas y saneamiento%' OR
        PieFoto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        PieFoto like '%aguas de saltillo%' OR
        PieFoto like '%sistema municipal de aguas y saneamiento%' OR
        PieFoto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        PieFoto like '%comision de agua potable y drenaje y alcantarillado%' OR
        PieFoto like '%sistema descentralizado de apa y saneamiento%' OR
        PieFoto like '%organismo publico descentralizado municipal de apa y smto%' OR
        PieFoto like '%comision de agua potable y alcantarillado%' OR
        PieFoto like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        PieFoto like '%junta de apa del municipio de irapuato%' OR
        PieFoto like '%sistema de apa de leon%' OR
        PieFoto like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        PieFoto like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        PieFoto like '%general de comision estatal de agua y alcantarillado%' OR
        PieFoto like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        PieFoto like '%sistema municipal de los servicios de APA%' OR
        PieFoto like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        PieFoto like '%organismo operador municipal de apa y saneamiento%' OR
        PieFoto like '%organismo municipal de servicios de agua potable%' OR
        PieFoto like '%comision de apa y saneamiento%' OR
        PieFoto like '%sistema de apa%' OR
        PieFoto like '%sistema ordenador de agua potable y saneamiento%' OR
        PieFoto like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        PieFoto like '%sistema municipal de agua potable emiliano zapata%' OR
        PieFoto like '%sistema de agua potable de huitzilac y tres marias%' OR
        PieFoto like '%sistema de conservacion de agua potable y saneamiento%' OR
        PieFoto like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        PieFoto like '%sistema de agua potable y saneamiento de temixco%' OR
        PieFoto like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        PieFoto like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        PieFoto like '%sistema operador de los servicios de apa%' OR
        PieFoto like '%sistema operador de los servicios de apa%' OR
        PieFoto like '%junta de agua potable y alcantarillado municipal%' OR
        PieFoto like '%comision estatal de aguas%' OR
        PieFoto like '%comision de apa%' OR
        PieFoto like '%comision de agua potable y alcantarillado%' OR
        PieFoto like '%junta municipal de apa de culiacan%' OR
        PieFoto like '%junta municipal de agua potable y alcantarillado%' OR
        PieFoto like '%junta de apa del mpio%' OR
        PieFoto like '%junta municipal de apa%' OR
        PieFoto like '%direccion de apa y saneamiento%' OR
        PieFoto like '%comision municipal de agua potable%' OR
        PieFoto like '%comision de apa%' OR
        PieFoto like '%organismo operador municipal de apa y saneamiento%' OR
        PieFoto like '%comision municipal de agua potable%' OR
        PieFoto like '%agua de hermosillo%' OR
        PieFoto like '%organismo operador municiapal de apa y saneamiento%' OR
        PieFoto like '%junta de aguas y drenaje%' OR
        PieFoto like '%comision municipal de apa%' OR
        PieFoto like '%comision de apa del municipio de tlaxcala%' OR
        PieFoto like '%comision municipal de agua potable y saneamiento%' OR
        PieFoto like '%sas metropolitano%' OR
        PieFoto like '%comision de agua potable y alcantarillado%' OR
        PieFoto like '%junta de agua potable y alcantarillado%' OR
        PieFoto like '%sistema de agua potable y alcantarillado%' OR
        PieFoto like '%sistema de apa y smto%' OR
        PieFoto like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        PieFoto like '%acueducto%' OR
        PieFoto like '%canal de riego%' OR
        PieFoto like '%planta de tratamiento de aguas residuales%' OR
        PieFoto like '% PTAR %' OR
        PieFoto like '%Carcamo%' OR
        PieFoto like '%planta de bombeo%' OR

        Autor like '%sector hidraulico%' OR
        Autor like 'ANEAS' OR
        Autor like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Autor like '%uniades de riego%' OR
        Autor like '%modulo de riego%' OR
        Autor like '%modulos de riego%' OR
        Autor like '%junta municipal de agua%' OR
        Autor like '%organismos operadores%' OR
        Autor like '%comision estatal del agua%' OR
        Autor like ' CCAP ' OR
        Autor like ' CESPE ' OR
        Autor like ' CESPM ' OR
        Autor like ' CESPETE ' OR
        Autor like ' CESPT ' OR
        Autor like ' SAPA ' OR
        Autor like ' OSAGUA ' OR
        Autor like ' JMAS ' OR
        Autor like ' SIMAS ' OR
        Autor like ' SAPAM ' OR
        Autor like ' COAPATAP ' OR
        Autor like ' SMAPA ' OR
        Autor like ' SIMAS ' OR
        Autor like ' SIMAPA ' OR
        Autor like ' AGSAL ' OR
        Autor like ' CIAPACOV ' OR
        Autor like ' CAPDAM ' OR
        Autor like ' SIDEA ' OR
        Autor like ' SIDEAPAS ' OR
        Autor like ' OADAP ' OR
        Autor like ' ADAPAS ' OR
        Autor like ' OPDM ' OR
        Autor like ' AIST ' OR
        Autor like ' APAST ' OR
        Autor like ' CAPAMA ' OR
        Autor like ' CAPAMI ' OR
        Autor like ' CAPAZ ' OR
        Autor like ' JUMAPA ' OR
        Autor like ' JAMAPI ' OR
        Autor like ' SAPAL ' OR
        Autor like ' CMAPAS ' OR
        Autor like ' CAPAMIH ' OR
        Autor like ' CEAA ' OR
        Autor like ' CAAMT ' OR
        Autor like ' SIAPA ' OR
        Autor like ' SEAPAL ' OR
        Autor like ' OROMAPAS ' OR
        Autor like ' CAPALAC ' OR
        Autor like ' OOAPAS ' OR
        Autor like ' OOAPASQ ' OR
        Autor like ' OMSAP ' OR
        Autor like ' CAPASU ' OR
        Autor like ' SAPAZ ' OR
        Autor like ' SOAPSC ' OR
        Autor like ' SAPAC ' OR
        Autor like ' SMAPEZ ' OR
        Autor like ' SIAPA ' OR
        Autor like ' OOMAPPI ' OR
        Autor like ' SCAPSAT ' OR
        Autor like ' SAP ' OR
        Autor like ' SAPASXO ' OR
        Autor like ' SCAPSZ ' OR
        Autor like ' SIAPA ' OR
        Autor like ' SADM ' OR
        Autor like ' ADOSAPACO ' OR
        Autor like ' SOAPAP ' OR
        Autor like ' SOAPAIM ' OR
        Autor like ' JAPAM ' OR
        Autor like ' CEA ' OR
        Autor like ' CAPA ' OR
        Autor like ' JMM ' OR
        Autor like ' JAPAC ' OR
        Autor like ' JUMAPAG ' OR
        Autor like ' JUMAPA ' OR
        Autor like ' JUMAPAN ' OR
        Autor like ' DAPA ' OR
        Autor like ' COMAP ' OR
        Autor like ' OOMAPAS ' OR
        Autor like ' COMAPA ' OR
        Autor like ' JAD ' OR
        Autor like ' CAPAM ' OR
        Autor like ' CMAPS ' OR
        Autor like ' CRAS ' OR
        Autor like ' CAPA ' OR
        Autor like ' JAPAY ' OR
        Autor like ' SAPAMV ' OR
        Autor like ' SIAPASF ' OR
        Autor like ' JIAPAZ ' OR
        Autor like '%Agua Potable%' OR
        Autor like '%Agua Potable y alcantarillado%' OR
        Autor like '%comision ciudadana de apa%' OR
        Autor like '%comision estatal de servicios publicos%' OR
        Autor like '%organismo operador municipal del sistema de apa y smto%' OR
        Autor like '%organismo del sistema de agua%' OR
        Autor like '%junta municipal de agua y saneamiento%' OR
        Autor like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Autor like '%sistema municipal de aguas y saneamiento%' OR
        Autor like '%junta municipal de agua y saneamiento%' OR
        Autor like '%sistema municipal de apa municipal%' OR
        Autor like '%comite de apa tapachula%' OR
        Autor like '%sistema municipal de apa%' OR
        Autor like '%sistemas municipal de aguas y saneamiento%' OR
        Autor like '%sistema municipal de agua y saneamiento de frontera%' OR
        Autor like '%sistemas municipal de agua potable y alcantarillado%' OR
        Autor like '%aguas de saltillo%' OR
        Autor like '%sistema municipal de aguas y saneamiento%' OR
        Autor like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Autor like '%aguas de saltillo%' OR
        Autor like '%sistema municipal de aguas y saneamiento%' OR
        Autor like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Autor like '%aguas de saltillo%' OR
        Autor like '%sistema municipal de aguas y saneamiento%' OR
        Autor like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Autor like '%comision de agua potable y drenaje y alcantarillado%' OR
        Autor like '%sistema descentralizado de apa y saneamiento%' OR
        Autor like '%organismo publico descentralizado municipal de apa y smto%' OR
        Autor like '%comision de agua potable y alcantarillado%' OR
        Autor like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Autor like '%junta de apa del municipio de irapuato%' OR
        Autor like '%sistema de apa de leon%' OR
        Autor like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Autor like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Autor like '%general de comision estatal de agua y alcantarillado%' OR
        Autor like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Autor like '%sistema municipal de los servicios de APA%' OR
        Autor like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Autor like '%organismo operador municipal de apa y saneamiento%' OR
        Autor like '%organismo municipal de servicios de agua potable%' OR
        Autor like '%comision de apa y saneamiento%' OR
        Autor like '%sistema de apa%' OR
        Autor like '%sistema ordenador de agua potable y saneamiento%' OR
        Autor like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Autor like '%sistema municipal de agua potable emiliano zapata%' OR
        Autor like '%sistema de agua potable de huitzilac y tres marias%' OR
        Autor like '%sistema de conservacion de agua potable y saneamiento%' OR
        Autor like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Autor like '%sistema de agua potable y saneamiento de temixco%' OR
        Autor like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Autor like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Autor like '%sistema operador de los servicios de apa%' OR
        Autor like '%sistema operador de los servicios de apa%' OR
        Autor like '%junta de agua potable y alcantarillado municipal%' OR
        Autor like '%comision estatal de aguas%' OR
        Autor like '%comision de apa%' OR
        Autor like '%comision de agua potable y alcantarillado%' OR
        Autor like '%junta municipal de apa de culiacan%' OR
        Autor like '%junta municipal de agua potable y alcantarillado%' OR
        Autor like '%junta de apa del mpio%' OR
        Autor like '%junta municipal de apa%' OR
        Autor like '%direccion de apa y saneamiento%' OR
        Autor like '%comision municipal de agua potable%' OR
        Autor like '%comision de apa%' OR
        Autor like '%organismo operador municipal de apa y saneamiento%' OR
        Autor like '%comision municipal de agua potable%' OR
        Autor like '%agua de hermosillo%' OR
        Autor like '%organismo operador municiapal de apa y saneamiento%' OR
        Autor like '%junta de aguas y drenaje%' OR
        Autor like '%comision municipal de apa%' OR
        Autor like '%comision de apa del municipio de tlaxcala%' OR
        Autor like '%comision municipal de agua potable y saneamiento%' OR
        Autor like '%sas metropolitano%' OR
        Autor like '%comision de agua potable y alcantarillado%' OR
        Autor like '%junta de agua potable y alcantarillado%' OR
        Autor like '%sistema de agua potable y alcantarillado%' OR
        Autor like '%sistema de apa y smto%' OR
        Autor like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Autor like '%acueducto%' OR
        Autor like '%canal de riego%' OR
        Autor like '%planta de tratamiento de aguas residuales%' OR
        Autor like '% PTAR %' OR
        Autor like '%Carcamo%' OR
        Autor like '%planta de bombeo%' OR


        (
            Texto like '% Semarnat %' OR
            Texto like '% Secretaria de medio ambiente y recursos naturales%' OR
            Texto like '%Rafael Pacchiano Alaman%' OR
            Texto like '%Rafael Pacchiano%' OR
            Texto like '%Pacchiano Alaman%' OR
            Titulo like '% Secretaria de medio ambiente y recursos naturales%' OR
            Titulo like '% Semarnat %' OR
            
            Encabezado like '% Secretaria de medio ambiente y recursos naturales%' OR
            Encabezado like '% Semarnat %' OR

            Texto like '%CONAFOR%' OR
            Titulo like '%CONAFOR%' OR
            Encabezado like '%CONAFOR%' OR

            Texto like '%CONABIO%' OR
            Titulo like '%CONABIO%' OR
            Encabezado like '%CONABIO%' OR

            Texto like'%CONANP%'OR
            Titulo like'%CONANP%' OR
            Encabezado like '%CONANP%' OR

            Texto like '%PROFEPA%' OR
            Titulo like '%PROFEPA%' OR
            Encabezado like '%PROFEPA%' OR

            Texto like'%instituto nacional de ecologia%' OR
            Texto like '%clima%'  AND (Texto not like '%de violencia%')OR
            Texto like '%clima%'  AND (Texto not like '%anticlimaticos%')OR

            Titulo like'%instituto nacional de ecologia%' OR
            Encabezado like '%instituto nacional de ecologia%' OR

            Texto like '%Instituto Mexicano De Tecnologia Del Agua%' OR
            Texto like '%IMTA%' OR
            Titulo like '%Instituto Mexicano De Tecnologia Del Agua%' OR
            Encabezado like '%Instituto Mexicano De Tecnologia Del Agua%'
        ) and texto not like '%instituto nacional de electoral%'
)
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 28://Varios - Estados
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
       
Texto like '%sistema Meteorologico nacional%' OR
        Texto like '%(SMN)%' OR
        Texto like '% SMN%' OR
        Texto like '%pronostico meteorologico%' OR
        Texto like '%huracanes%' OR
        Texto like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        Texto like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Texto like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Texto like '%temporada de lluvia%' OR
        Texto like '%tormenta tropical%' OR
        Texto like '%ciclones%' OR
        Texto like '%Fenomenos climatologicos%' OR
        Texto like '%frentes frios%' OR
        Texto like '%frente frio%' OR
        Texto like '% helada%' and texto not like '%cerveza%' OR
        
        Titulo like '%sistema Meteorologico nacional%' OR
        Titulo like '%(SMN)%' OR
        Titulo like '% SMN%' OR
        Titulo like '%pronostico meteorologico%' OR
        Titulo like '%huracanes%' OR
        Titulo like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        Titulo like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Titulo like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Titulo like '%temporada de lluvia%' OR
        Titulo like '%tormenta tropical%' OR
        Titulo like '%ciclones%' OR
        Titulo like '%Fenomenos climatologicos%' OR
        Titulo like '%frentes frios%' OR
        Titulo like '%frente frio%' OR
        Titulo like '% helada%' and texto not like '%cerveza%' OR
            
        Encabezado like '%sistema Meteorologico nacional%' OR
        Encabezado like '%(SMN)%' OR
        Encabezado like '% SMN%' OR
        Encabezado like '%pronostico meteorologico%' OR
        Encabezado like '%huracanes%' OR
        Encabezado like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        Encabezado like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Encabezado like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Encabezado like '%temporada de lluvia%' OR
        Encabezado like '%tormenta tropical%' OR
        Encabezado like '%ciclones%' OR
        Encabezado like '%Fenomenos climatologicos%' OR
        Encabezado like '%frentes frios%' OR
        Encabezado like '%frente frio%' OR
        Encabezado like '% helada%' and texto not like '%cerveza%' OR

        PieFoto like '%sistema Meteorologico nacional%' OR
        PieFoto like '%(SMN)%' OR
        PieFoto like '% SMN%' OR
        PieFoto like '%pronostico meteorologico%' OR
        PieFoto like '%huracanes%' OR
        PieFoto like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        PieFoto like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        PieFoto like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        PieFoto like '%temporada de lluvia%' OR
        PieFoto like '%tormenta tropical%' OR
        PieFoto like '%ciclones%' OR
        PieFoto like '%Fenomenos climatologicos%' OR
        PieFoto like '%frentes frios%' OR
        PieFoto like '%frente frio%' OR
        PieFoto like '% helada%' and texto not like '%cerveza%' OR

        Autor like '%sistema Meteorologico nacional%' OR
        Autor like '%(SMN)%' OR
        Autor like '% SMN%' OR
        Autor like '%pronostico meteorologico%' OR
        Autor like '%huracanes%' OR
        Autor like '%huracan %' and Texto NOT like '%Soriana%' and Texto NOT like '%seguro Social %' OR
        Autor like '%sequias%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Autor like '% sequia%' AND Texto not like '%cronicas%' AND Texto not like '%goles%' OR
        Autor like '%temporada de lluvia%' OR
        Autor like '%tormenta tropical%' OR
        Autor like '%ciclones%' OR
        Autor like '%Fenomenos climatologicos%' OR
        Autor like '%frentes frios%' OR
        Autor like '%frente frio%' OR
        Autor like '% helada%' and texto not like '%cerveza%' OR


        Texto like '%sector hidraulico%' OR
        Texto like 'ANEAS' OR
        Texto like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Texto like '%uniades de riego%' OR
        Texto like '%modulo de riego%' OR
        Texto like '%modulos de riego%' OR
        Texto like '%junta municipal de agua%' OR
        Texto like '%organismos operadores%' OR
        Texto like '%comision estatal del agua%' OR
        Texto like ' CCAP ' OR
        Texto like ' CESPE ' OR
        Texto like ' CESPM ' OR
        Texto like ' CESPETE ' OR
        Texto like ' CESPT ' OR
        Texto like ' SAPA ' OR
        Texto like ' OSAGUA ' OR
        Texto like ' JMAS ' OR
        Texto like ' SIMAS ' OR
        Texto like ' SAPAM ' OR
        Texto like ' COAPATAP ' OR
        Texto like ' SMAPA ' OR
        Texto like ' SIMAS ' OR
        Texto like ' SIMAPA ' OR
        Texto like ' AGSAL ' OR
        Texto like ' CIAPACOV ' OR
        Texto like ' CAPDAM ' OR
        Texto like ' SIDEA ' OR
        Texto like ' SIDEAPAS ' OR
        Texto like ' OADAP ' OR
        Texto like ' ADAPAS ' OR
        Texto like ' OPDM ' OR
        Texto like ' AIST ' OR
        Texto like ' APAST ' OR
        Texto like ' CAPAMA ' OR
        Texto like ' CAPAMI ' OR
        Texto like ' CAPAZ ' OR
        Texto like ' JUMAPA ' OR
        Texto like ' JAMAPI ' OR
        Texto like ' SAPAL ' OR
        Texto like ' CMAPAS ' OR
        Texto like ' CAPAMIH ' OR
        Texto like ' CEAA ' OR
        Texto like ' CAAMT ' OR
        Texto like ' SIAPA ' OR
        Texto like ' SEAPAL ' OR
        Texto like ' OROMAPAS ' OR
        Texto like ' CAPALAC ' OR
        Texto like ' OOAPAS ' OR
        Texto like ' OOAPASQ ' OR
        Texto like ' OMSAP ' OR
        Texto like ' CAPASU ' OR
        Texto like ' SAPAZ ' OR
        Texto like ' SOAPSC ' OR
        Texto like ' SAPAC ' OR
        Texto like ' SMAPEZ ' OR
        Texto like ' SIAPA ' OR
        Texto like ' OOMAPPI ' OR
        Texto like ' SCAPSAT ' OR
        Texto like ' SAP ' OR
        Texto like ' SAPASXO ' OR
        Texto like ' SCAPSZ ' OR
        Texto like ' SIAPA ' OR
        Texto like ' SADM ' OR
        Texto like ' ADOSAPACO ' OR
        Texto like ' SOAPAP ' OR
        Texto like ' SOAPAIM ' OR
        Texto like ' JAPAM ' OR
        Texto like ' CEA ' OR
        Texto like ' CAPA ' OR
        Texto like ' JMM ' OR
        Texto like ' JAPAC ' OR
        Texto like ' JUMAPAG ' OR
        Texto like ' JUMAPA ' OR
        Texto like ' JUMAPAN ' OR
        Texto like ' DAPA ' OR
        Texto like ' COMAP ' OR
        Texto like ' OOMAPAS ' OR
        Texto like ' COMAPA ' OR
        Texto like ' JAD ' OR
        Texto like ' CAPAM ' OR
        Texto like ' CMAPS ' OR
        Texto like ' CRAS ' OR
        Texto like ' CAPA ' OR
        Texto like ' JAPAY ' OR
        Texto like ' SAPAMV ' OR
        Texto like ' SIAPASF ' OR
        Texto like ' JIAPAZ ' OR
        Texto like '%Agua Potable%' OR
        Texto like '%Agua Potable y alcantarillado%' OR
        Texto like '%comision ciudadana de apa%' OR
        Texto like '%comision estatal de servicios publicos%' OR
        Texto like '%organismo operador municipal del sistema de apa y smto%' OR
        Texto like '%organismo del sistema de agua%' OR
        Texto like '%junta municipal de agua y saneamiento%' OR
        Texto like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%junta municipal de agua y saneamiento%' OR
        Texto like '%sistema municipal de apa municipal%' OR
        Texto like '%comite de apa tapachula%' OR
        Texto like '%sistema municipal de apa%' OR
        Texto like '%sistemas municipal de aguas y saneamiento%' OR
        Texto like '%sistema municipal de agua y saneamiento de frontera%' OR
        Texto like '%sistemas municipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%aguas de saltillo%' OR
        Texto like '%sistema municipal de aguas y saneamiento%' OR
        Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Texto like '%comision de agua potable y drenaje y alcantarillado%' OR
        Texto like '%sistema descentralizado de apa y saneamiento%' OR
        Texto like '%organismo publico descentralizado municipal de apa y smto%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Texto like '%junta de apa del municipio de irapuato%' OR
        Texto like '%sistema de apa de leon%' OR
        Texto like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Texto like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Texto like '%general de comision estatal de agua y alcantarillado%' OR
        Texto like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Texto like '%sistema municipal de los servicios de APA%' OR
        Texto like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Texto like '%organismo operador municipal de apa y saneamiento%' OR
        Texto like '%organismo municipal de servicios de agua potable%' OR
        Texto like '%comision de apa y saneamiento%' OR
        Texto like '%sistema de apa%' OR
        Texto like '%sistema ordenador de agua potable y saneamiento%' OR
        Texto like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Texto like '%sistema municipal de agua potable emiliano zapata%' OR
        Texto like '%sistema de agua potable de huitzilac y tres marias%' OR
        Texto like '%sistema de conservacion de agua potable y saneamiento%' OR
        Texto like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Texto like '%sistema de agua potable y saneamiento de temixco%' OR
        Texto like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Texto like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Texto like '%sistema operador de los servicios de apa%' OR
        Texto like '%sistema operador de los servicios de apa%' OR
        Texto like '%junta de agua potable y alcantarillado municipal%' OR
        Texto like '%comision estatal de aguas%' OR
        Texto like '%comision de apa%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%junta municipal de apa de culiacan%' OR
        Texto like '%junta municipal de agua potable y alcantarillado%' OR
        Texto like '%junta de apa del mpio%' OR
        Texto like '%junta municipal de apa%' OR
        Texto like '%direccion de apa y saneamiento%' OR
        Texto like '%comision municipal de agua potable%' OR
        Texto like '%comision de apa%' OR
        Texto like '%organismo operador municipal de apa y saneamiento%' OR
        Texto like '%comision municipal de agua potable%' OR
        Texto like '%agua de hermosillo%' OR
        Texto like '%organismo operador municiapal de apa y saneamiento%' OR
        Texto like '%junta de aguas y drenaje%' OR
        Texto like '%comision municipal de apa%' OR
        Texto like '%comision de apa del municipio de tlaxcala%' OR
        Texto like '%comision municipal de agua potable y saneamiento%' OR
        Texto like '%sas metropolitano%' OR
        Texto like '%comision de agua potable y alcantarillado%' OR
        Texto like '%junta de agua potable y alcantarillado%' OR
        Texto like '%sistema de agua potable y alcantarillado%' OR
        Texto like '%sistema de apa y smto%' OR
        Texto like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Texto like '%acueducto%' OR
        Texto like '%canal de riego%' OR
        Texto like '%planta de tratamiento de aguas residuales%' OR
        Texto like '% PTAR %' OR
        Texto like '%Carcamo%' OR
        Texto like '%planta de bombeo%' OR




        Titulo like '%sector hidraulico%' OR
        Titulo like 'ANEAS' OR
        Titulo like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Titulo like '%uniades de riego%' OR
        Titulo like '%modulo de riego%' OR
        Titulo like '%modulos de riego%' OR
        Titulo like '%junta municipal de agua%' OR
        Titulo like '%organismos operadores%' OR
        Titulo like '%comision estatal del agua%' OR

        Titulo like ' CCAP ' OR
        Titulo like ' CESPE ' OR
        Titulo like ' CESPM ' OR
        Titulo like ' CESPETE ' OR
        Titulo like ' CESPT ' OR
        Titulo like ' SAPA ' OR
        Titulo like ' OSAGUA ' OR
        Titulo like ' JMAS ' OR
        Titulo like ' SIMAS ' OR
        Titulo like ' SAPAM ' OR
        Titulo like ' COAPATAP ' OR
        Titulo like ' SMAPA ' OR
        Titulo like ' SIMAS ' OR
        Titulo like ' SIMAPA ' OR
        Titulo like ' AGSAL ' OR
        Titulo like ' CIAPACOV ' OR
        Titulo like ' CAPDAM ' OR
        Titulo like ' SIDEA ' OR
        Titulo like ' SIDEAPAS ' OR
        Titulo like ' OADAP ' OR
        Titulo like ' ADAPAS ' OR
        Titulo like ' OPDM ' OR
        Titulo like ' AIST ' OR
        Titulo like ' APAST ' OR
        Titulo like ' CAPAMA ' OR
        Titulo like ' CAPAMI ' OR
        Titulo like ' CAPAZ ' OR
        Titulo like ' JUMAPA ' OR
        Titulo like ' JAMAPI ' OR
        Titulo like ' SAPAL ' OR
        Titulo like ' CMAPAS ' OR
        Titulo like ' CAPAMIH ' OR
        Titulo like ' CEAA ' OR
        Titulo like ' CAAMT ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' SEAPAL ' OR
        Titulo like ' OROMAPAS ' OR
        Titulo like ' CAPALAC ' OR
        Titulo like ' OOAPAS ' OR
        Titulo like ' OOAPASQ ' OR
        Titulo like ' OMSAP ' OR
        Titulo like ' CAPASU ' OR
        Titulo like ' SAPAZ ' OR
        Titulo like ' SOAPSC ' OR
        Titulo like ' SAPAC ' OR
        Titulo like ' SMAPEZ ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' OOMAPPI ' OR
        Titulo like ' SCAPSAT ' OR
        Titulo like ' SAP ' OR
        Titulo like ' SAPASXO ' OR
        Titulo like ' SCAPSZ ' OR
        Titulo like ' SIAPA ' OR
        Titulo like ' SADM ' OR
        Titulo like ' ADOSAPACO ' OR
        Titulo like ' SOAPAP ' OR
        Titulo like ' SOAPAIM ' OR
        Titulo like ' JAPAM ' OR
        Titulo like ' CEA ' OR
        Titulo like ' CAPA ' OR
        Titulo like ' JMM ' OR
        Titulo like ' JAPAC ' OR
        Titulo like ' JUMAPAG ' OR
        Titulo like ' JUMAPA ' OR
        Titulo like ' JUMAPAN ' OR
        Titulo like ' DAPA ' OR
        Titulo like ' COMAP ' OR
        Titulo like ' OOMAPAS ' OR
        Titulo like ' COMAPA ' OR
        Titulo like ' JAD ' OR
        Titulo like ' CAPAM ' OR
        Titulo like ' CMAPS ' OR
        Titulo like ' CRAS ' OR
        Titulo like ' CAPA ' OR
        Titulo like ' JAPAY ' OR
        Titulo like ' SAPAMV ' OR
        Titulo like ' SIAPASF ' OR
        Titulo like ' JIAPAZ ' OR
        Titulo like '%Agua Potable%' OR
        Titulo like '%Agua Potable y alcantarillado%' OR
        Titulo like '%comision ciudadana de apa%' OR
        Titulo like '%comision estatal de servicios publicos%' OR
        Titulo like '%organismo operador municipal del sistema de apa y smto%' OR
        Titulo like '%organismo del sistema de agua%' OR
        Titulo like '%junta municipal de agua y saneamiento%' OR
        Titulo like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%junta municipal de agua y saneamiento%' OR
        Titulo like '%sistema municipal de apa municipal%' OR
        Titulo like '%comite de apa tapachula%' OR
        Titulo like '%sistema municipal de apa%' OR
        Titulo like '%sistemas municipal de aguas y saneamiento%' OR
        Titulo like '%sistema municipal de agua y saneamiento de frontera%' OR
        Titulo like '%sistemas municipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%aguas de saltillo%' OR
        Titulo like '%sistema municipal de aguas y saneamiento%' OR
        Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Titulo like '%comision de agua potable y drenaje y alcantarillado%' OR
        Titulo like '%sistema descentralizado de apa y saneamiento%' OR
        Titulo like '%organismo publico descentralizado municipal de apa y smto%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Titulo like '%junta de apa del municipio de irapuato%' OR
        Titulo like '%sistema de apa de leon%' OR
        Titulo like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Titulo like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Titulo like '%general de comision estatal de agua y alcantarillado%' OR
        Titulo like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Titulo like '%sistema municipal de los servicios de APA%' OR
        Titulo like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Titulo like '%organismo operador municipal de apa y saneamiento%' OR
        Titulo like '%organismo municipal de servicios de agua potable%' OR
        Titulo like '%comision de apa y saneamiento%' OR
        Titulo like '%sistema de apa%' OR
        Titulo like '%sistema ordenador de agua potable y saneamiento%' OR
        Titulo like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Titulo like '%sistema municipal de agua potable emiliano zapata%' OR
        Titulo like '%sistema de agua potable de huitzilac y tres marias%' OR
        Titulo like '%sistema de conservacion de agua potable y saneamiento%' OR
        Titulo like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Titulo like '%sistema de agua potable y saneamiento de temixco%' OR
        Titulo like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Titulo like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Titulo like '%sistema operador de los servicios de apa%' OR
        Titulo like '%sistema operador de los servicios de apa%' OR
        Titulo like '%junta de agua potable y alcantarillado municipal%' OR
        Titulo like '%comision estatal de aguas%' OR
        Titulo like '%comision de apa%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%junta municipal de apa de culiacan%' OR
        Titulo like '%junta municipal de agua potable y alcantarillado%' OR
        Titulo like '%junta de apa del mpio%' OR
        Titulo like '%junta municipal de apa%' OR
        Titulo like '%direccion de apa y saneamiento%' OR
        Titulo like '%comision municipal de agua potable%' OR
        Titulo like '%comision de apa%' OR
        Titulo like '%organismo operador municipal de apa y saneamiento%' OR
        Titulo like '%comision municipal de agua potable%' OR
        Titulo like '%agua de hermosillo%' OR
        Texto like '%organismo operador municiapal de apa y saneamiento%' OR
        Texto like '%junta de aguas y drenaje%' OR
        Texto like '%comision municipal de apa%' OR
        Texto like '%comision de apa del municipio de tlaxcala%' OR
        Titulo like '%comision municipal de agua potable y saneamiento%' OR
        Titulo like '%sas metropolitano%' OR
        Titulo like '%comision de agua potable y alcantarillado%' OR
        Titulo like '%junta de agua potable y alcantarillado%' OR
        Titulo like '%sistema de agua potable y alcantarillado%' OR
        Titulo like '%sistema de apa y smto%' OR
        Titulo like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Titulo like '%acueducto%' OR
        Titulo like '%canal de riego%' OR
        Titulo like '%planta de tratamiento de aguas residuales%' OR
        Titulo like '% PTAR %' OR
        Titulo like '%Carcamo%' OR
        Titulo like '%planta de bombeo%' OR


        Encabezado like '%sector hidraulico%' OR
        Encabezado like 'ANEAS' OR
        Encabezado like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Encabezado like '%uniades de riego%' OR
        Encabezado like '%modulo de riego%' OR
        Encabezado like '%modulos de riego%' OR
        Encabezado like '%junta municipal de agua%' OR
        Encabezado like '%organismos operadores%' OR
        Encabezado like '%comision estatal del agua%' OR

        Encabezado like ' CCAP ' OR
        Encabezado like ' CESPE ' OR
        Encabezado like ' CESPM ' OR
        Encabezado like ' CESPETE ' OR
        Encabezado like ' CESPT ' OR
        Encabezado like ' SAPA ' OR
        Encabezado like ' OSAGUA ' OR
        Encabezado like ' JMAS ' OR
        Encabezado like ' SIMAS ' OR
        Encabezado like ' SAPAM ' OR
        Encabezado like ' COAPATAP ' OR
        Encabezado like ' SMAPA ' OR
        Encabezado like ' SIMAS ' OR
        Encabezado like ' SIMAPA ' OR
        Encabezado like ' AGSAL ' OR
        Encabezado like ' CIAPACOV ' OR
        Encabezado like ' CAPDAM ' OR
        Encabezado like ' SIDEA ' OR
        Encabezado like ' SIDEAPAS ' OR
        Encabezado like ' OADAP ' OR
        Encabezado like ' ADAPAS ' OR
        Encabezado like ' OPDM ' OR
        Encabezado like ' AIST ' OR
        Encabezado like ' APAST ' OR
        Encabezado like ' CAPAMA ' OR
        Encabezado like ' CAPAMI ' OR
        Encabezado like ' CAPAZ ' OR
        Encabezado like ' JUMAPA ' OR
        Encabezado like ' JAMAPI ' OR
        Encabezado like ' SAPAL ' OR
        Encabezado like ' CMAPAS ' OR
        Encabezado like ' CAPAMIH ' OR
        Encabezado like ' CEAA ' OR
        Encabezado like ' CAAMT ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' SEAPAL ' OR
        Encabezado like ' OROMAPAS ' OR
        Encabezado like ' CAPALAC ' OR
        Encabezado like ' OOAPAS ' OR
        Encabezado like ' OOAPASQ ' OR
        Encabezado like ' OMSAP ' OR
        Encabezado like ' CAPASU ' OR
        Encabezado like ' SAPAZ ' OR
        Encabezado like ' SOAPSC ' OR
        Encabezado like ' SAPAC ' OR
        Encabezado like ' SMAPEZ ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' OOMAPPI ' OR
        Encabezado like ' SCAPSAT ' OR
        Encabezado like ' SAP ' OR
        Encabezado like ' SAPASXO ' OR
        Encabezado like ' SCAPSZ ' OR
        Encabezado like ' SIAPA ' OR
        Encabezado like ' SADM ' OR
        Encabezado like ' ADOSAPACO ' OR
        Encabezado like ' SOAPAP ' OR
        Encabezado like ' SOAPAIM ' OR
        Encabezado like ' JAPAM ' OR
        Encabezado like ' CEA ' OR
        Encabezado like ' CAPA ' OR
        Encabezado like ' JMM ' OR
        Encabezado like ' JAPAC ' OR
        Encabezado like ' JUMAPAG ' OR
        Encabezado like ' JUMAPA ' OR
        Encabezado like ' JUMAPAN ' OR
        Encabezado like ' DAPA ' OR
        Encabezado like ' COMAP ' OR
        Encabezado like ' OOMAPAS ' OR
        Encabezado like ' COMAPA ' OR
        Encabezado like ' JAD ' OR
        Encabezado like ' CAPAM ' OR
        Encabezado like ' CMAPS ' OR
        Encabezado like ' CRAS ' OR
        Encabezado like ' CAPA ' OR
        Encabezado like ' JAPAY ' OR
        Encabezado like ' SAPAMV ' OR
        Encabezado like ' SIAPASF ' OR
        Encabezado like ' JIAPAZ ' OR
        Encabezado like '%Agua Potable%' OR
        Encabezado like '%Agua Potable y alcantarillado%' OR
        Encabezado like '%comision ciudadana de apa%' OR
        Encabezado like '%comision estatal de servicios publicos%' OR
        Encabezado like '%organismo operador municipal del sistema de apa y smto%' OR
        Encabezado like '%organismo del sistema de agua%' OR
        Encabezado like '%junta municipal de agua y saneamiento%' OR
        Encabezado like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%junta municipal de agua y saneamiento%' OR
        Encabezado like '%sistema municipal de apa municipal%' OR
        Encabezado like '%comite de apa tapachula%' OR
        Encabezado like '%sistema municipal de apa%' OR
        Encabezado like '%sistemas municipal de aguas y saneamiento%' OR
        Encabezado like '%sistema municipal de agua y saneamiento de frontera%' OR
        Encabezado like '%sistemas municipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%aguas de saltillo%' OR
        Encabezado like '%sistema municipal de aguas y saneamiento%' OR
        Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Encabezado like '%comision de agua potable y drenaje y alcantarillado%' OR
        Encabezado like '%sistema descentralizado de apa y saneamiento%' OR
        Encabezado like '%organismo publico descentralizado municipal de apa y smto%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Encabezado like '%junta de apa del municipio de irapuato%' OR
        Encabezado like '%sistema de apa de leon%' OR
        Encabezado like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Encabezado like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Encabezado like '%general de comision estatal de agua y alcantarillado%' OR
        Encabezado like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Encabezado like '%sistema municipal de los servicios de APA%' OR
        Encabezado like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
        Encabezado like '%organismo municipal de servicios de agua potable%' OR
        Encabezado like '%comision de apa y saneamiento%' OR
        Encabezado like '%sistema de apa%' OR
        Encabezado like '%sistema ordenador de agua potable y saneamiento%' OR
        Encabezado like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Encabezado like '%sistema municipal de agua potable emiliano zapata%' OR
        Encabezado like '%sistema de agua potable de huitzilac y tres marias%' OR
        Encabezado like '%sistema de conservacion de agua potable y saneamiento%' OR
        Encabezado like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Encabezado like '%sistema de agua potable y saneamiento de temixco%' OR
        Encabezado like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Encabezado like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Encabezado like '%sistema operador de los servicios de apa%' OR
        Encabezado like '%sistema operador de los servicios de apa%' OR
        Encabezado like '%junta de agua potable y alcantarillado municipal%' OR
        Encabezado like '%comision estatal de aguas%' OR
        Encabezado like '%comision de apa%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%junta municipal de apa de culiacan%' OR
        Encabezado like '%junta municipal de agua potable y alcantarillado%' OR
        Encabezado like '%junta de apa del mpio%' OR
        Encabezado like '%junta municipal de apa%' OR
        Encabezado like '%direccion de apa y saneamiento%' OR
        Encabezado like '%comision municipal de agua potable%' OR
        Encabezado like '%comision de apa%' OR
        Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
        Encabezado like '%comision municipal de agua potable%' OR
        Encabezado like '%agua de hermosillo%' OR
        Encabezado like '%organismo operador municiapal de apa y saneamiento%' OR
        Encabezado like '%junta de aguas y drenaje%' OR
        Encabezado like '%comision municipal de apa%' OR
        Encabezado like '%comision de apa del municipio de tlaxcala%' OR
        Encabezado like '%comision municipal de agua potable y saneamiento%' OR
        Encabezado like '%sas metropolitano%' OR
        Encabezado like '%comision de agua potable y alcantarillado%' OR
        Encabezado like '%junta de agua potable y alcantarillado%' OR
        Encabezado like '%sistema de agua potable y alcantarillado%' OR
        Encabezado like '%sistema de apa y smto%' OR
        Encabezado like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Encabezado like '%acueducto%' OR
        Encabezado like '%canal de riego%' OR
        Encabezado like '%planta de tratamiento de aguas residuales%' OR
        Encabezado like '% PTAR %' OR
        Encabezado like '%Carcamo%' OR
        Encabezado like '%planta de bombeo%' OR

        PieFoto like '%sector hidraulico%' OR
        PieFoto like 'ANEAS' OR
        PieFoto like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        PieFoto like '%uniades de riego%' OR
        PieFoto like '%modulo de riego%' OR
        PieFoto like '%modulos de riego%' OR
        PieFoto like '%junta municipal de agua%' OR
        PieFoto like '%organismos operadores%' OR
        PieFoto like '%comision estatal del agua%' OR
        PieFoto like ' CCAP ' OR
        PieFoto like ' CESPE ' OR
        PieFoto like ' CESPM ' OR
        PieFoto like ' CESPETE ' OR
        PieFoto like ' CESPT ' OR
        PieFoto like ' SAPA ' OR
        PieFoto like ' OSAGUA ' OR
        PieFoto like ' JMAS ' OR
        PieFoto like ' SIMAS ' OR
        PieFoto like ' SAPAM ' OR
        PieFoto like ' COAPATAP ' OR
        PieFoto like ' SMAPA ' OR
        PieFoto like ' SIMAS ' OR
        PieFoto like ' SIMAPA ' OR
        PieFoto like ' AGSAL ' OR
        PieFoto like ' CIAPACOV ' OR
        PieFoto like ' CAPDAM ' OR
        PieFoto like ' SIDEA ' OR
        PieFoto like ' SIDEAPAS ' OR
        PieFoto like ' OADAP ' OR
        PieFoto like ' ADAPAS ' OR
        PieFoto like ' OPDM ' OR
        PieFoto like ' AIST ' OR
        PieFoto like ' APAST ' OR
        PieFoto like ' CAPAMA ' OR
        PieFoto like ' CAPAMI ' OR
        PieFoto like ' CAPAZ ' OR
        PieFoto like ' JUMAPA ' OR
        PieFoto like ' JAMAPI ' OR
        PieFoto like ' SAPAL ' OR
        PieFoto like ' CMAPAS ' OR
        PieFoto like ' CAPAMIH ' OR
        PieFoto like ' CEAA ' OR
        PieFoto like ' CAAMT ' OR
        PieFoto like ' SIAPA ' OR
        PieFoto like ' SEAPAL ' OR
        PieFoto like ' OROMAPAS ' OR
        PieFoto like ' CAPALAC ' OR
        PieFoto like ' OOAPAS ' OR
        PieFoto like ' OOAPASQ ' OR
        PieFoto like ' OMSAP ' OR
        PieFoto like ' CAPASU ' OR
        PieFoto like ' SAPAZ ' OR
        PieFoto like ' SOAPSC ' OR
        PieFoto like ' SAPAC ' OR
        PieFoto like ' SMAPEZ ' OR
        PieFoto like ' SIAPA ' OR
        PieFoto like ' OOMAPPI ' OR
        PieFoto like ' SCAPSAT ' OR
        PieFoto like ' SAP ' OR
        PieFoto like ' SAPASXO ' OR
        PieFoto like ' SCAPSZ ' OR
        PieFoto like ' SIAPA ' OR
        PieFoto like ' SADM ' OR
        PieFoto like ' ADOSAPACO ' OR
        PieFoto like ' SOAPAP ' OR
        PieFoto like ' SOAPAIM ' OR
        PieFoto like ' JAPAM ' OR
        PieFoto like ' CEA ' OR
        PieFoto like ' CAPA ' OR
        PieFoto like ' JMM ' OR
        PieFoto like ' JAPAC ' OR
        PieFoto like ' JUMAPAG ' OR
        PieFoto like ' JUMAPA ' OR
        PieFoto like ' JUMAPAN ' OR
        PieFoto like ' DAPA ' OR
        PieFoto like ' COMAP ' OR
        PieFoto like ' OOMAPAS ' OR
        PieFoto like ' COMAPA ' OR
        PieFoto like ' JAD ' OR
        PieFoto like ' CAPAM ' OR
        PieFoto like ' CMAPS ' OR
        PieFoto like ' CRAS ' OR
        PieFoto like ' CAPA ' OR
        PieFoto like ' JAPAY ' OR
        PieFoto like ' SAPAMV ' OR
        PieFoto like ' SIAPASF ' OR
        PieFoto like ' JIAPAZ ' OR
        PieFoto like '%Agua Potable%' OR
        PieFoto like '%Agua Potable y alcantarillado%' OR
        PieFoto like '%comision ciudadana de apa%' OR
        PieFoto like '%comision estatal de servicios publicos%' OR
        PieFoto like '%organismo operador municipal del sistema de apa y smto%' OR
        PieFoto like '%organismo del sistema de agua%' OR
        PieFoto like '%junta municipal de agua y saneamiento%' OR
        PieFoto like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        PieFoto like '%sistema municipal de aguas y saneamiento%' OR
        PieFoto like '%junta municipal de agua y saneamiento%' OR
        PieFoto like '%sistema municipal de apa municipal%' OR
        PieFoto like '%comite de apa tapachula%' OR
        PieFoto like '%sistema municipal de apa%' OR
        PieFoto like '%sistemas municipal de aguas y saneamiento%' OR
        PieFoto like '%sistema municipal de agua y saneamiento de frontera%' OR
        PieFoto like '%sistemas municipal de agua potable y alcantarillado%' OR
        PieFoto like '%aguas de saltillo%' OR
        PieFoto like '%sistema municipal de aguas y saneamiento%' OR
        PieFoto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        PieFoto like '%aguas de saltillo%' OR
        PieFoto like '%sistema municipal de aguas y saneamiento%' OR
        PieFoto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        PieFoto like '%aguas de saltillo%' OR
        PieFoto like '%sistema municipal de aguas y saneamiento%' OR
        PieFoto like '%comision intermunicipal de agua potable y alcantarillado%' OR
        PieFoto like '%comision de agua potable y drenaje y alcantarillado%' OR
        PieFoto like '%sistema descentralizado de apa y saneamiento%' OR
        PieFoto like '%organismo publico descentralizado municipal de apa y smto%' OR
        PieFoto like '%comision de agua potable y alcantarillado%' OR
        PieFoto like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        PieFoto like '%junta de apa del municipio de irapuato%' OR
        PieFoto like '%sistema de apa de leon%' OR
        PieFoto like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        PieFoto like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        PieFoto like '%general de comision estatal de agua y alcantarillado%' OR
        PieFoto like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        PieFoto like '%sistema municipal de los servicios de APA%' OR
        PieFoto like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        PieFoto like '%organismo operador municipal de apa y saneamiento%' OR
        PieFoto like '%organismo municipal de servicios de agua potable%' OR
        PieFoto like '%comision de apa y saneamiento%' OR
        PieFoto like '%sistema de apa%' OR
        PieFoto like '%sistema ordenador de agua potable y saneamiento%' OR
        PieFoto like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        PieFoto like '%sistema municipal de agua potable emiliano zapata%' OR
        PieFoto like '%sistema de agua potable de huitzilac y tres marias%' OR
        PieFoto like '%sistema de conservacion de agua potable y saneamiento%' OR
        PieFoto like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        PieFoto like '%sistema de agua potable y saneamiento de temixco%' OR
        PieFoto like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        PieFoto like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        PieFoto like '%sistema operador de los servicios de apa%' OR
        PieFoto like '%sistema operador de los servicios de apa%' OR
        PieFoto like '%junta de agua potable y alcantarillado municipal%' OR
        PieFoto like '%comision estatal de aguas%' OR
        PieFoto like '%comision de apa%' OR
        PieFoto like '%comision de agua potable y alcantarillado%' OR
        PieFoto like '%junta municipal de apa de culiacan%' OR
        PieFoto like '%junta municipal de agua potable y alcantarillado%' OR
        PieFoto like '%junta de apa del mpio%' OR
        PieFoto like '%junta municipal de apa%' OR
        PieFoto like '%direccion de apa y saneamiento%' OR
        PieFoto like '%comision municipal de agua potable%' OR
        PieFoto like '%comision de apa%' OR
        PieFoto like '%organismo operador municipal de apa y saneamiento%' OR
        PieFoto like '%comision municipal de agua potable%' OR
        PieFoto like '%agua de hermosillo%' OR
        PieFoto like '%organismo operador municiapal de apa y saneamiento%' OR
        PieFoto like '%junta de aguas y drenaje%' OR
        PieFoto like '%comision municipal de apa%' OR
        PieFoto like '%comision de apa del municipio de tlaxcala%' OR
        PieFoto like '%comision municipal de agua potable y saneamiento%' OR
        PieFoto like '%sas metropolitano%' OR
        PieFoto like '%comision de agua potable y alcantarillado%' OR
        PieFoto like '%junta de agua potable y alcantarillado%' OR
        PieFoto like '%sistema de agua potable y alcantarillado%' OR
        PieFoto like '%sistema de apa y smto%' OR
        PieFoto like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        PieFoto like '%acueducto%' OR
        PieFoto like '%canal de riego%' OR
        PieFoto like '%planta de tratamiento de aguas residuales%' OR
        PieFoto like '% PTAR %' OR
        PieFoto like '%Carcamo%' OR
        PieFoto like '%planta de bombeo%' OR

        Autor like '%sector hidraulico%' OR
        Autor like 'ANEAS' OR
        Autor like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
        Autor like '%uniades de riego%' OR
        Autor like '%modulo de riego%' OR
        Autor like '%modulos de riego%' OR
        Autor like '%junta municipal de agua%' OR
        Autor like '%organismos operadores%' OR
        Autor like '%comision estatal del agua%' OR
        Autor like ' CCAP ' OR
        Autor like ' CESPE ' OR
        Autor like ' CESPM ' OR
        Autor like ' CESPETE ' OR
        Autor like ' CESPT ' OR
        Autor like ' SAPA ' OR
        Autor like ' OSAGUA ' OR
        Autor like ' JMAS ' OR
        Autor like ' SIMAS ' OR
        Autor like ' SAPAM ' OR
        Autor like ' COAPATAP ' OR
        Autor like ' SMAPA ' OR
        Autor like ' SIMAS ' OR
        Autor like ' SIMAPA ' OR
        Autor like ' AGSAL ' OR
        Autor like ' CIAPACOV ' OR
        Autor like ' CAPDAM ' OR
        Autor like ' SIDEA ' OR
        Autor like ' SIDEAPAS ' OR
        Autor like ' OADAP ' OR
        Autor like ' ADAPAS ' OR
        Autor like ' OPDM ' OR
        Autor like ' AIST ' OR
        Autor like ' APAST ' OR
        Autor like ' CAPAMA ' OR
        Autor like ' CAPAMI ' OR
        Autor like ' CAPAZ ' OR
        Autor like ' JUMAPA ' OR
        Autor like ' JAMAPI ' OR
        Autor like ' SAPAL ' OR
        Autor like ' CMAPAS ' OR
        Autor like ' CAPAMIH ' OR
        Autor like ' CEAA ' OR
        Autor like ' CAAMT ' OR
        Autor like ' SIAPA ' OR
        Autor like ' SEAPAL ' OR
        Autor like ' OROMAPAS ' OR
        Autor like ' CAPALAC ' OR
        Autor like ' OOAPAS ' OR
        Autor like ' OOAPASQ ' OR
        Autor like ' OMSAP ' OR
        Autor like ' CAPASU ' OR
        Autor like ' SAPAZ ' OR
        Autor like ' SOAPSC ' OR
        Autor like ' SAPAC ' OR
        Autor like ' SMAPEZ ' OR
        Autor like ' SIAPA ' OR
        Autor like ' OOMAPPI ' OR
        Autor like ' SCAPSAT ' OR
        Autor like ' SAP ' OR
        Autor like ' SAPASXO ' OR
        Autor like ' SCAPSZ ' OR
        Autor like ' SIAPA ' OR
        Autor like ' SADM ' OR
        Autor like ' ADOSAPACO ' OR
        Autor like ' SOAPAP ' OR
        Autor like ' SOAPAIM ' OR
        Autor like ' JAPAM ' OR
        Autor like ' CEA ' OR
        Autor like ' CAPA ' OR
        Autor like ' JMM ' OR
        Autor like ' JAPAC ' OR
        Autor like ' JUMAPAG ' OR
        Autor like ' JUMAPA ' OR
        Autor like ' JUMAPAN ' OR
        Autor like ' DAPA ' OR
        Autor like ' COMAP ' OR
        Autor like ' OOMAPAS ' OR
        Autor like ' COMAPA ' OR
        Autor like ' JAD ' OR
        Autor like ' CAPAM ' OR
        Autor like ' CMAPS ' OR
        Autor like ' CRAS ' OR
        Autor like ' CAPA ' OR
        Autor like ' JAPAY ' OR
        Autor like ' SAPAMV ' OR
        Autor like ' SIAPASF ' OR
        Autor like ' JIAPAZ ' OR
        Autor like '%Agua Potable%' OR
        Autor like '%Agua Potable y alcantarillado%' OR
        Autor like '%comision ciudadana de apa%' OR
        Autor like '%comision estatal de servicios publicos%' OR
        Autor like '%organismo operador municipal del sistema de apa y smto%' OR
        Autor like '%organismo del sistema de agua%' OR
        Autor like '%junta municipal de agua y saneamiento%' OR
        Autor like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
        Autor like '%sistema municipal de aguas y saneamiento%' OR
        Autor like '%junta municipal de agua y saneamiento%' OR
        Autor like '%sistema municipal de apa municipal%' OR
        Autor like '%comite de apa tapachula%' OR
        Autor like '%sistema municipal de apa%' OR
        Autor like '%sistemas municipal de aguas y saneamiento%' OR
        Autor like '%sistema municipal de agua y saneamiento de frontera%' OR
        Autor like '%sistemas municipal de agua potable y alcantarillado%' OR
        Autor like '%aguas de saltillo%' OR
        Autor like '%sistema municipal de aguas y saneamiento%' OR
        Autor like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Autor like '%aguas de saltillo%' OR
        Autor like '%sistema municipal de aguas y saneamiento%' OR
        Autor like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Autor like '%aguas de saltillo%' OR
        Autor like '%sistema municipal de aguas y saneamiento%' OR
        Autor like '%comision intermunicipal de agua potable y alcantarillado%' OR
        Autor like '%comision de agua potable y drenaje y alcantarillado%' OR
        Autor like '%sistema descentralizado de apa y saneamiento%' OR
        Autor like '%organismo publico descentralizado municipal de apa y smto%' OR
        Autor like '%comision de agua potable y alcantarillado%' OR
        Autor like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
        Autor like '%junta de apa del municipio de irapuato%' OR
        Autor like '%sistema de apa de leon%' OR
        Autor like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
        Autor like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
        Autor like '%general de comision estatal de agua y alcantarillado%' OR
        Autor like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
        Autor like '%sistema municipal de los servicios de APA%' OR
        Autor like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
        Autor like '%organismo operador municipal de apa y saneamiento%' OR
        Autor like '%organismo municipal de servicios de agua potable%' OR
        Autor like '%comision de apa y saneamiento%' OR
        Autor like '%sistema de apa%' OR
        Autor like '%sistema ordenador de agua potable y saneamiento%' OR
        Autor like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
        Autor like '%sistema municipal de agua potable emiliano zapata%' OR
        Autor like '%sistema de agua potable de huitzilac y tres marias%' OR
        Autor like '%sistema de conservacion de agua potable y saneamiento%' OR
        Autor like '%organismo operador municipal de agua potable de puente de ixtla%' OR
        Autor like '%sistema de agua potable y saneamiento de temixco%' OR
        Autor like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
        Autor like '%sistema de aguan potable y saneamiento de zacatepec%' OR
        Autor like '%sistema operador de los servicios de apa%' OR
        Autor like '%sistema operador de los servicios de apa%' OR
        Autor like '%junta de agua potable y alcantarillado municipal%' OR
        Autor like '%comision estatal de aguas%' OR
        Autor like '%comision de apa%' OR
        Autor like '%comision de agua potable y alcantarillado%' OR
        Autor like '%junta municipal de apa de culiacan%' OR
        Autor like '%junta municipal de agua potable y alcantarillado%' OR
        Autor like '%junta de apa del mpio%' OR
        Autor like '%junta municipal de apa%' OR
        Autor like '%direccion de apa y saneamiento%' OR
        Autor like '%comision municipal de agua potable%' OR
        Autor like '%comision de apa%' OR
        Autor like '%organismo operador municipal de apa y saneamiento%' OR
        Autor like '%comision municipal de agua potable%' OR
        Autor like '%agua de hermosillo%' OR
        Autor like '%organismo operador municiapal de apa y saneamiento%' OR
        Autor like '%junta de aguas y drenaje%' OR
        Autor like '%comision municipal de apa%' OR
        Autor like '%comision de apa del municipio de tlaxcala%' OR
        Autor like '%comision municipal de agua potable y saneamiento%' OR
        Autor like '%sas metropolitano%' OR
        Autor like '%comision de agua potable y alcantarillado%' OR
        Autor like '%junta de agua potable y alcantarillado%' OR
        Autor like '%sistema de agua potable y alcantarillado%' OR
        Autor like '%sistema de apa y smto%' OR
        Autor like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
        Autor like '%acueducto%' OR
        Autor like '%canal de riego%' OR
        Autor like '%planta de tratamiento de aguas residuales%' OR
        Autor like '% PTAR %' OR
        Autor like '%Carcamo%' OR
        Autor like '%planta de bombeo%' OR


        (
            Texto like '% Semarnat %' OR
            Texto like '% Secretaria de medio ambiente y recursos naturales%' OR
            Titulo like '% Secretaria de medio ambiente y recursos naturales%' OR
            Titulo like '% Semarnat %' OR
            Encabezado like '% Secretaria de medio ambiente y recursos naturales%' OR
            Encabezado like '% Semarnat %' OR

            Texto like '%CONAFOR%' OR
            Titulo like '%CONAFOR%' OR
            Encabezado like '%CONAFOR%' OR

            Texto like '%CONABIO%' OR
            Titulo like '%CONABIO%' OR
            Encabezado like '%CONABIO%' OR

            Texto like'%CONANP%'OR
            Titulo like'%CONANP%' OR
            Encabezado like '%CONANP%' OR

            Texto like '%PROFEPA%' OR
            Titulo like '%PROFEPA%' OR
            Encabezado like '%PROFEPA%' OR

            Texto like'%instituto nacional de ecologia%' OR
            Texto like '%clima%'  AND (Texto not like '%de violencia%')OR
            Texto like '%clima%'  AND (Texto not like '%anticlimaticos%')OR

            Titulo like'%instituto nacional de ecologia%' OR
            Encabezado like '%instituto nacional de ecologia%' OR

            Texto like '%Instituto Mexicano De Tecnologia Del Agua%' OR
            Texto like '%IMTA%' OR
            Titulo like '%Instituto Mexicano De Tecnologia Del Agua%' OR
            Encabezado like '%Instituto Mexicano De Tecnologia Del Agua%'
        ) and texto not like '%instituto nacional de electoral%'
)
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY p.Estado";
            return $query; 
        break; 

        

        case 29:// PRIMERAS PLANAS
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

        case 30:// COLUMNAS POLITICAS
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

        case 31:// COLUMNAS FINANCIERAS
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
            break;

        case 32: // Cartones DF
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
