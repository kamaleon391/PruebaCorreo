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
          case 1:
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
    Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
    Texto like '%Claudia Artemisa Pavlovich%' OR
    Texto like '%Claudia Pavlovich Arellano%' OR
        Texto like '%Claudia Pavlovich%' OR
    Texto like '%Pavlovich Arellano%' OR
    Texto like '%Gobernadora de Sonora%' OR

    Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
    Titulo like '%Claudia Artemisa Pavlovich%' OR
    Titulo like '%Claudia Pavlovich Arellano%' OR
        Titulo like '%Claudia Pavlovich%' OR
    Titulo like '%Pavlovich Arellano%' OR
    Titulo like '%Gobernadora de Sonora%' OR

    Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
    Encabezado like '%Claudia Artemisa Pavlovich%' OR
    Encabezado like '%Claudia Pavlovich Arellano%' OR
        Encabezado like '%Claudia Pavlovich%' OR
    Encabezado like '%Pavlovich Arellano%' OR
    Encabezado like '%Gobernadora de Sonora%' OR

    PieFoto like '%Claudia Artemisa Pavlovich Arellano%' OR
    PieFoto like '%Claudia Artemisa Pavlovich%' OR
    PieFoto like '%Claudia Pavlovich Arellano%' OR
        PieFoto like '%Claudia Pavlovich%' OR
    PieFoto like '%Pavlovich Arellano%' OR
    PieFoto like '%Gobernadora de Sonora%' OR

    Autor like '%Claudia Artemisa Pavlovich Arellano%' OR
    Autor like '%Claudia Artemisa Pavlovich%' OR
    Autor like '%Claudia Pavlovich Arellano%' OR
        Autor like '%Claudia Pavlovich%' OR
    Autor like '%Pavlovich Arellano%' OR
    Autor like '%Gobernadora de Sonora%'
    )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 2:
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Rio Sonora%' OR

                              Titulo like '%Rio Sonora%' OR

                              Encabezado like '%Rio Sonora%' OR

                              PieFoto like '%Rio Sonora%'
                              )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query; 
        break;   

        case 3:
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Mega Region Arizona-Sonora%' OR
                              Texto like '%Region Arizona-Sonora%' OR

                              Titulo like '%Mega Region Arizona-Sonora%' OR
                              Titulo like '%Region Arizona-Sonora%' OR

                              Encabezado like '%Mega Region Arizona-Sonora%' OR
                              Encabezado like '%Region Arizona-Sonora%' OR

                              PieFoto like '%Mega Region Arizona-Sonora%' OR
                              PieFoto like '%Region Arizona-Sonora%'
                              )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query;  
        break;  

        case 4:
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Procuraduría General de Justicia%' OR
                              Texto like '%PGR%' OR

                              Titulo like '%Procuraduría General de Justicia%' OR
                              Titulo like '%PGR%' OR

                              Encabezado like '%Procuraduría General de Justicia%' OR
                              Encabezado like '%PGR%' OR

                              PieFoto like '%Procuraduría General de Justicia%' OR
                              PieFoto like '%PGR%'
                            )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion Limit 0, 30";
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
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

                                  Titulo like '%Enrique pena nieto%' OR
                                  Titulo like '%presidente peña%' OR
                                  Titulo like '%peña nieto%' OR
                                  Titulo like '%pena nieto%' OR
                                  Titulo like 'Enrique pena nieto'  OR
                                  Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                  Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                  Titulo like '%epn%' OR
                                  Titulo like '%@EPN%' OR

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
                                  Encabezado like '% quique Pena %'
                               ) AND (
                                Texto not like '%expresidente%' OR
                                Titulo not like '%expresidente%' OR
                                Encabezado not like '%expresidente%' OR
                                PieFoto not like '%expresidente%' OR
                                Autor not like '%expresidente%'
                              )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion Limit 0, 30";
            return $query;  
        break;  

        case 6://CUTZAMALA - Estados
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (  
                             Texto like '%Transparencia y Rendición de Cuentas CONAGO%' OR   
                              Texto like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR  
                              Texto like '%Comision de gobiernos abiertos%' OR  
                              Texto like '% CONAGO %' OR    

                              Titulo like '%Transparencia y Rendición de Cuentas CONAGO%' OR  
                              Titulo like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR
                              Titulo like '%Comision de gobiernos abiertos%' OR   Titulo like '% CONAGO %'OR    

                              Encabezado like '%Transparencia y Rendición de Cuentas CONAGO%' OR  
                              Encabezado like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR 
                              Encabezado like '%Comision de gobiernos abiertos%' OR   
                              Encabezado like '% CONAGO %' OR   

                              PieFoto like '%Transparencia y Rendición de Cuentas CONAGO%' OR   
                              PieFoto like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR  
                              PieFoto like '%Comision de gobiernos abiertos%' OR  
                              PieFoto like '% CONAGO %'   
                              )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion";
            return $query; 
        break; 


        case 7:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado NOT IN (9,26)
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
    Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
    Texto like '%Claudia Artemisa Pavlovich%' OR
    Texto like '%Claudia Pavlovich Arellano%' OR
        Texto like '%Claudia Pavlovich%' OR
    Texto like '%Pavlovich Arellano%' OR
    Texto like '%Gobernadora de Sonora%' OR

    Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
    Titulo like '%Claudia Artemisa Pavlovich%' OR
    Titulo like '%Claudia Pavlovich Arellano%' OR
        Titulo like '%Claudia Pavlovich%' OR
    Titulo like '%Pavlovich Arellano%' OR
    Titulo like '%Gobernadora de Sonora%' OR

    Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
    Encabezado like '%Claudia Artemisa Pavlovich%' OR
    Encabezado like '%Claudia Pavlovich Arellano%' OR
        Encabezado like '%Claudia Pavlovich%' OR
    Encabezado like '%Pavlovich Arellano%' OR
    Encabezado like '%Gobernadora de Sonora%' OR

    PieFoto like '%Claudia Artemisa Pavlovich Arellano%' OR
    PieFoto like '%Claudia Artemisa Pavlovich%' OR
    PieFoto like '%Claudia Pavlovich Arellano%' OR
        PieFoto like '%Claudia Pavlovich%' OR
    PieFoto like '%Pavlovich Arellano%' OR
    PieFoto like '%Gobernadora de Sonora%' OR

    Autor like '%Claudia Artemisa Pavlovich Arellano%' OR
    Autor like '%Claudia Artemisa Pavlovich%' OR
    Autor like '%Claudia Pavlovich Arellano%' OR
        Autor like '%Claudia Pavlovich%' OR
    Autor like '%Pavlovich Arellano%' OR
    Autor like '%Gobernadora de Sonora%'
    )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query;  
        break;  

        case 8:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado NOT IN (9,26)
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Rio Sonora%' OR

                              Titulo like '%Rio Sonora%' OR

                              Encabezado like '%Rio Sonora%' OR

                              PieFoto like '%Rio Sonora%'
                              )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query; 
        break;   

        case 9:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado NOT IN (9,26)
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Mega Region Arizona-Sonora%' OR
                              Texto like '%Region Arizona-Sonora%' OR

                              Titulo like '%Mega Region Arizona-Sonora%' OR
                              Titulo like '%Region Arizona-Sonora%' OR

                              Encabezado like '%Mega Region Arizona-Sonora%' OR
                              Encabezado like '%Region Arizona-Sonora%' OR

                              PieFoto like '%Mega Region Arizona-Sonora%' OR
                              PieFoto like '%Region Arizona-Sonora%'
                              )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query;  
        break;  

        case 10:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado NOT IN (9,26)
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Procuraduría General de Justicia%' OR
                              Texto like '%PGR%' OR

                              Titulo like '%Procuraduría General de Justicia%' OR
                              Titulo like '%PGR%' OR

                              Encabezado like '%Procuraduría General de Justicia%' OR
                              Encabezado like '%PGR%' OR

                              PieFoto like '%Procuraduría General de Justicia%' OR
                              PieFoto like '%PGR%'
                            )
                   GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query; 
        break; 

        case 11:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado NOT IN (9,26)
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
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

                                  Titulo like '%Enrique pena nieto%' OR
                                  Titulo like '%presidente peña%' OR
                                  Titulo like '%peña nieto%' OR
                                  Titulo like '%pena nieto%' OR
                                  Titulo like 'Enrique pena nieto'  OR
                                  Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                  Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                  Titulo like '%epn%' OR
                                  Titulo like '%@EPN%' OR

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
                                  Encabezado like '% quique Pena %'
                               ) AND (
                                Texto not like '%expresidente%' OR
                                Titulo not like '%expresidente%' OR
                                Encabezado not like '%expresidente%' OR
                                PieFoto not like '%expresidente%' OR
                                Autor not like '%expresidente%'
                              )
                   GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query;  
        break;  

        case 12:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado NOT IN (9,26)
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
                             Texto like '%Transparencia y Rendición de Cuentas CONAGO%' OR   
                              Texto like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR  
                              Texto like '%Comision de gobiernos abiertos%' OR  
                              Texto like '% CONAGO %' OR    

                              Titulo like '%Transparencia y Rendición de Cuentas CONAGO%' OR  
                              Titulo like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR
                              Titulo like '%Comision de gobiernos abiertos%' OR   Titulo like '% CONAGO %'OR    

                              Encabezado like '%Transparencia y Rendición de Cuentas CONAGO%' OR  
                              Encabezado like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR 
                              Encabezado like '%Comision de gobiernos abiertos%' OR   
                              Encabezado like '% CONAGO %' OR   

                              PieFoto like '%Transparencia y Rendición de Cuentas CONAGO%' OR   
                              PieFoto like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR  
                              PieFoto like '%Comision de gobiernos abiertos%' OR  
                              PieFoto like '% CONAGO %'   
                              )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query; 
        break; 

        case 13:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado = 26
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
    Texto like '%Claudia Artemisa Pavlovich Arellano%' OR
    Texto like '%Claudia Artemisa Pavlovich%' OR
    Texto like '%Claudia Pavlovich Arellano%' OR
        Texto like '%Claudia Pavlovich%' OR
    Texto like '%Pavlovich Arellano%' OR
    Texto like '%Gobernadora de Sonora%' OR

    Titulo like '%Claudia Artemisa Pavlovich Arellano%' OR
    Titulo like '%Claudia Artemisa Pavlovich%' OR
    Titulo like '%Claudia Pavlovich Arellano%' OR
        Titulo like '%Claudia Pavlovich%' OR
    Titulo like '%Pavlovich Arellano%' OR
    Titulo like '%Gobernadora de Sonora%' OR

    Encabezado like '%Claudia Artemisa Pavlovich Arellano%' OR
    Encabezado like '%Claudia Artemisa Pavlovich%' OR
    Encabezado like '%Claudia Pavlovich Arellano%' OR
        Encabezado like '%Claudia Pavlovich%' OR
    Encabezado like '%Pavlovich Arellano%' OR
    Encabezado like '%Gobernadora de Sonora%' OR

    PieFoto like '%Claudia Artemisa Pavlovich Arellano%' OR
    PieFoto like '%Claudia Artemisa Pavlovich%' OR
    PieFoto like '%Claudia Pavlovich Arellano%' OR
        PieFoto like '%Claudia Pavlovich%' OR
    PieFoto like '%Pavlovich Arellano%' OR
    PieFoto like '%Gobernadora de Sonora%' OR

    Autor like '%Claudia Artemisa Pavlovich Arellano%' OR
    Autor like '%Claudia Artemisa Pavlovich%' OR
    Autor like '%Claudia Pavlovich Arellano%' OR
        Autor like '%Claudia Pavlovich%' OR
    Autor like '%Pavlovich Arellano%' OR
    Autor like '%Gobernadora de Sonora%'
    )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query;  
        break;  

        case 14:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado = 26
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Rio Sonora%' OR

                              Titulo like '%Rio Sonora%' OR

                              Encabezado like '%Rio Sonora%' OR

                              PieFoto like '%Rio Sonora%'
                              )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query; 
        break;   

        case 15:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado = 26
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Mega Region Arizona-Sonora%' OR
                              Texto like '%Region Arizona-Sonora%' OR

                              Titulo like '%Mega Region Arizona-Sonora%' OR
                              Titulo like '%Region Arizona-Sonora%' OR

                              Encabezado like '%Mega Region Arizona-Sonora%' OR
                              Encabezado like '%Region Arizona-Sonora%' OR

                              PieFoto like '%Mega Region Arizona-Sonora%' OR
                              PieFoto like '%Region Arizona-Sonora%'
                              )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query;  
        break;  

        case 16:
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado = 26
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Procuraduría General de Justicia%' OR
                              Texto like '%PGR%' OR

                              Titulo like '%Procuraduría General de Justicia%' OR
                              Titulo like '%PGR%' OR

                              Encabezado like '%Procuraduría General de Justicia%' OR
                              Encabezado like '%PGR%' OR

                              PieFoto like '%Procuraduría General de Justicia%' OR
                              PieFoto like '%PGR%'
                            )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query; 
        break; 

        case 17://CUTZAMALA - DF 
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado = 26
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
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

                                  Titulo like '%Enrique pena nieto%' OR
                                  Titulo like '%presidente peña%' OR
                                  Titulo like '%peña nieto%' OR
                                  Titulo like '%pena nieto%' OR
                                  Titulo like 'Enrique pena nieto'  OR
                                  Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                  Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                  Titulo like '%epn%' OR
                                  Titulo like '%@EPN%' OR

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
                                  Encabezado like '% quique Pena %'
                               ) AND (
                                Texto not like '%expresidente%' OR
                                Titulo not like '%expresidente%' OR
                                Encabezado not like '%expresidente%' OR
                                PieFoto not like '%expresidente%' OR
                                Autor not like '%expresidente%'
                              )
                 GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query;  
        break;  

        case 18://CUTZAMALA - Estados
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
                      seccionesPeriodicos s,
                      categoriasPeriodicos c,
                      estados e
                  WHERE
                      p.idPeriodico = n.Periodico
                          AND s.idSeccion = n.Seccion
                          AND c.idCategoria = n.Categoria
                          AND p.estado = e.idEstado
                          AND e.idEstado = 26
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98)  
                          AND fecha = DATE('$fecha')
                          AND  (
                             Texto like '%Transparencia y Rendición de Cuentas CONAGO%' OR   
                              Texto like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR  
                              Texto like '%Comision de gobiernos abiertos%' OR  
                              Texto like '% CONAGO %' OR    

                              Titulo like '%Transparencia y Rendición de Cuentas CONAGO%' OR  
                              Titulo like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR
                              Titulo like '%Comision de gobiernos abiertos%' OR   Titulo like '% CONAGO %'OR    

                              Encabezado like '%Transparencia y Rendición de Cuentas CONAGO%' OR  
                              Encabezado like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR 
                              Encabezado like '%Comision de gobiernos abiertos%' OR   
                              Encabezado like '% CONAGO %' OR   

                              PieFoto like '%Transparencia y Rendición de Cuentas CONAGO%' OR   
                              PieFoto like '%Comision de gobiernos abiertos, trnasparencia y rendicion de cuentas%' OR  
                              PieFoto like '%Comision de gobiernos abiertos%' OR  
                              PieFoto like '% CONAGO %'   
                              )
                  GROUP BY idEditorial
                  ORDER BY p.Nombre";
            return $query; 
        break; 
        case 19:
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Procuraduría General de Justicia%' OR
                              Texto like '%PGR%' OR

                              Titulo like '%Procuraduría General de Justicia%' OR
                              Titulo like '%PGR%' OR

                              Encabezado like '%Procuraduría General de Justicia%' OR
                              Encabezado like '%PGR%' OR

                              PieFoto like '%Procuraduría General de Justicia%' OR
                              PieFoto like '%PGR%'
                            )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion Limit 31, 30";
            return $query; 
        break; 
        case 20:
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
                              Texto like '%Procuraduría General de Justicia%' OR
                              Texto like '%PGR%' OR

                              Titulo like '%Procuraduría General de Justicia%' OR
                              Titulo like '%PGR%' OR

                              Encabezado like '%Procuraduría General de Justicia%' OR
                              Encabezado like '%PGR%' OR

                              PieFoto like '%Procuraduría General de Justicia%' OR
                              PieFoto like '%PGR%'
                            )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion Limit 61, 30";
            return $query; 
        break; 

         case 21://CUTZAMALA - DF 
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
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

                                  Titulo like '%Enrique pena nieto%' OR
                                  Titulo like '%presidente peña%' OR
                                  Titulo like '%peña nieto%' OR
                                  Titulo like '%pena nieto%' OR
                                  Titulo like 'Enrique pena nieto'  OR
                                  Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                  Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                  Titulo like '%epn%' OR
                                  Titulo like '%@EPN%' OR

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
                                  Encabezado like '% quique Pena %'
                               ) AND (
                                Texto not like '%expresidente%' OR
                                Titulo not like '%expresidente%' OR
                                Encabezado not like '%expresidente%' OR
                                PieFoto not like '%expresidente%' OR
                                Autor not like '%expresidente%'
                              )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion Limit 31, 30";
            return $query;  
        break;  

         case 22://CUTZAMALA - DF 
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
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

                                  Titulo like '%Enrique pena nieto%' OR
                                  Titulo like '%presidente peña%' OR
                                  Titulo like '%peña nieto%' OR
                                  Titulo like '%pena nieto%' OR
                                  Titulo like 'Enrique pena nieto'  OR
                                  Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                  Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                  Titulo like '%epn%' OR
                                  Titulo like '%@EPN%' OR

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
                                  Encabezado like '% quique Pena %'
                               ) AND (
                                Texto not like '%expresidente%' OR
                                Titulo not like '%expresidente%' OR
                                Encabezado not like '%expresidente%' OR
                                PieFoto not like '%expresidente%' OR
                                Autor not like '%expresidente%'
                              )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion Limit 61, 30";
            return $query;  
        break;  

         case 23://CUTZAMALA - DF 
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
                          AND e.idEstado = 9 
                          AND n.Activo = 1
                          AND n.Seccion NOT IN (22, 29)
                          AND n.Categoria not in (80,98) 
                          AND fecha = DATE('$fecha')
                          AND  (
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

                                  Titulo like '%Enrique pena nieto%' OR
                                  Titulo like '%presidente peña%' OR
                                  Titulo like '%peña nieto%' OR
                                  Titulo like '%pena nieto%' OR
                                  Titulo like 'Enrique pena nieto'  OR
                                  Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                                  Titulo like '%Senor Licenciado enrique pena nieto%' OR
                                  Titulo like '%epn%' OR
                                  Titulo like '%@EPN%' OR

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
                                  Encabezado like '% quique Pena %'
                               ) AND (
                                Texto not like '%expresidente%' OR
                                Titulo not like '%expresidente%' OR
                                Encabezado not like '%expresidente%' OR
                                PieFoto not like '%expresidente%' OR
                                Autor not like '%expresidente%'
                              )
                  GROUP BY n.Periodico,n.NumeroPagina
                  ORDER BY o.posicion Limit 91, 30";
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
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s, categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND 
                    s.idSeccion=n.Seccion AND 
                    c.idCategoria=n.Categoria AND 
                    c.idCategoria in(3) AND 
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1 AND
                    p.Estado=26
                    GROUP BY n.NumeroPagina,p.idPeriodico 
                    ORDER BY p.Estado,p.String_Name
                    ";
            return $query;
            break;// PRIMERAS PLANAS SONORA

        case 30:// COLUMNAS OPINION SONORA
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
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(1) AND
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1 AND
                    p.Estado=26
                    GROUP BY n.idEditorial
                    ORDER BY p.Estado,p.String_Name";
            return $query;
            break;// COLUMNAS OPINION SONORA

        case 31:// COLUMNAS FINANCIERAS DF
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

        case 32: // Cartones Sonora
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
                    c.idCategoria in(18) AND
                    p.estado=26 AND 
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.idEditorial
                    ORDER BY p.Estado,p.String_Name
                    ";
            return $query; 

            break;// Cartones Sonora
            case 33:// PRIMERAS PLANAS CDMX
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
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s, categoriasPeriodicos c,estados e, ordenGeneral o
                    WHERE p.idPeriodico=n.Periodico AND 
                    s.idSeccion=n.Seccion AND 
                    c.idCategoria=n.Categoria AND 
                    c.idCategoria in(3) AND 
                    p.idPeriodico = o.periodico AND
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1 AND
                    p.Estado= 9
                    GROUP BY n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion
                    ";
            return $query;
            break;// PRIMERAS PLANAS CDMX

        case 34:// COLUMNAS OPINION CDMX
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
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e, 
                    ordenGeneral o
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(19) AND
                    p.estado=e.idEstado AND
                    p.idPeriodico = o.periodico AND
                    fecha =DATE('$fecha') AND n.Activo=1 AND
                    p.Estado=9
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.posicion";
            return $query;
            break;// COLUMNAS OPINION SONORA

        case 35:// COLUMNAS FINANCIERAS DF
            $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM 
                    $Tabla n, 
                    periodicos p, 
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e,
                    ordenGeneral o
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(20) AND
                    p.idPeriodico = o.periodico AND
                    fecha =DATE('$fecha') AND 
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.idEditorial 
                    ORDER BY o.posicion";
            return $query;
            break;

        case 36: // Cartones CDMX
            $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM 
                    $Tabla n, 
                    periodicos p,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e,
                    ordenGeneral o
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(18) AND
                    p.estado=9 AND 
                    p.estado=e.idEstado AND
                    p.idPeriodico = o.periodico AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.idEditorial
                    ORDER BY o.posicion
                    ";
            return $query; 
            break;
    }
}

?>
