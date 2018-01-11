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
            $query = "SELECT  DISTINCT ( CONCAT( n.Periodico , n.NumeroPagina ) ), n.Periodico , n.NumeroPagina, o.posicion,
                    p.Nombre as 'periodico', s.seccion, n.Categoria as 'Num.Categoria', c.Categoria as 'Categoria',  n.Fecha,  
                    n.PaginaPeriodico,  e.Nombre as 'Estado', CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf' FROM $Tabla n 
            JOIN periodicos p ON p.idPeriodico=n.Periodico
            JOIN ordenGeneral o ON p.idPeriodico=o.periodico
            JOIN seccionesPeriodicos s ON s.idSeccion=n.Seccion
            JOIN categoriasPeriodicos c ON c.idCategoria=n.Categoria
            JOIN estados e ON p.estado=e.idEstado
            WHERE c.idCategoria = 3 AND Fecha = DATE('$fecha') AND n.Activo=1
            GROUP BY n.Periodico , p.Nombre , s.seccion, n.Categoria , c.Categoria , n.NumeroPagina, n.Fecha,  n.PaginaPeriodico,  o.posicion , e.Nombre
            ORDER BY o.posicion";
            return $query;
            break; //Primeras Planas

        case 2:// COLUMNAS POLITICAS
            $query = "SELECT DISTINCT ( CONCAT( n.Periodico , n.NumeroPagina ) ), n.Periodico , n.NumeroPagina, o.posicion,
                    p.Nombre as 'periodico', s.seccion, n.Categoria as 'Num.Categoria', c.Categoria as 'Categoria',  n.Fecha,  
                    n.PaginaPeriodico,  e.Nombre as 'Estado', CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf' FROM $Tabla n 
                JOIN periodicos p ON p.idPeriodico=n.Periodico
                JOIN ordenGeneral o ON p.idPeriodico=o.periodico
                JOIN seccionesPeriodicos s ON s.idSeccion=n.Seccion
                JOIN categoriasPeriodicos c ON c.idCategoria=n.Categoria
                JOIN estados e ON p.estado=e.idEstado
                WHERE c.idCategoria = 19 AND Fecha = DATE('$fecha') AND n.Activo=1
                GROUP BY n.Periodico , p.Nombre , s.seccion, n.Categoria , c.Categoria , n.NumeroPagina, n.Fecha,  n.PaginaPeriodico,  o.posicion , e.Nombre
                ORDER BY o.posicion";

            return $query;
            break;//Columnas Politicas

        case 3:// COLUMNAS FINANCIERAS
            $query="SELECT DISTINCT ( CONCAT( n.Periodico , n.NumeroPagina ) ), n.Periodico , n.NumeroPagina, o.posicion,
                    p.Nombre as 'periodico', s.seccion, n.Categoria as 'Num.Categoria', c.Categoria as 'Categoria',  n.Fecha,  
                    n.PaginaPeriodico,  e.Nombre as 'Estado', CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf' FROM $Tabla n 
                JOIN periodicos p ON p.idPeriodico = n.Periodico
                JOIN seccionesPeriodicos s ON s.idSeccion = n.Seccion
                JOIN categoriasPeriodicos c ON c.idCategoria = n.Categoria
                JOIN estados e ON p.estado = e.idEstado
                WHERE c.idCategoria = 20 AND Fecha = DATE('$fecha') AND n.Activo = 1
                GROUP BY n.Periodico , p.Nombre , s.seccion, n.Categoria , c.Categoria , n.NumeroPagina, n.Fecha,  n.PaginaPeriodico,  o.posicion , e.Nombre";
            return $query;
            break;//Columnas Financieras

        case 4: // CARTONES
            $query="SELECT DISTINCT ( CONCAT( n.Periodico , n.NumeroPagina ) ), n.Periodico , n.NumeroPagina, o.posicion,
                    p.Nombre as 'periodico', s.seccion, n.Categoria as 'Num.Categoria', c.Categoria as 'Categoria',  n.Fecha,  
                    n.PaginaPeriodico,  e.Nombre as 'Estado', CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf' FROM  $Tabla n
            JOIN periodicos p ON p.idPeriodico=n.Periodico
            JOIN ordenGeneral o ON p.idPeriodico=o.periodico
            JOIN seccionesPeriodicos s ON s.idSeccion=n.Seccion
            JOIN categoriasPeriodicos c ON c.idCategoria=n.Categoria
            JOIN estados e ON p.estado=e.idEstado
            WHERE c.idCategoria = 18 AND Fecha = DATE('$fecha') AND n.Activo = 1 AND p.estado = 9 
            GROUP BY n.Periodico , p.Nombre , s.seccion, n.Categoria , c.Categoria , n.NumeroPagina, n.Fecha,  n.PaginaPeriodico,  o.posicion , e.Nombre
            ORDER BY o.posicion";
            return $query;  
            break;// 

        case 5: /*********** TIANGUIS - DF ************/
           $query="SELECT DISTINCT ( CONCAT( n.Periodico , n.NumeroPagina ) ), n.Periodico , n.NumeroPagina, o.posicion,
                    p.Nombre as 'periodico', s.seccion, n.Categoria as 'Num.Categoria', c.Categoria as 'Categoria',  n.Fecha,  
                    n.PaginaPeriodico,  e.Nombre as 'Estado', CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf' FROM $Tabla n
              JOIN periodicos p ON p.idPeriodico=n.Periodico
              JOIN ordenGeneral o ON p.idPeriodico=o.periodico
              JOIN seccionesPeriodicos s ON s.idSeccion=n.Seccion
              JOIN categoriasPeriodicos c ON c.idCategoria=n.Categoria
              JOIN estados e ON p.estado=e.idEstado WHERE n.Activo = 1 AND Fecha = DATE('$fecha') AND (
                Texto like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Texto like '%TIANGUIS TURISTICO%' OR
                Texto like '%Rafael Garcia Gonzalez%' OR
                Texto like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                Texto like '%AMHM%' OR
                
                Titulo like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Titulo like '%TIANGUIS TURISTICO%' OR
                Titulo like '%Rafael Garcia Gonzalez%' OR
                Titulo like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                Titulo like '%AMHM%' OR

                Encabezado like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Encabezado like '%TIANGUIS TURISTICO%' OR
                Encabezado like '%Rafael Garcia Gonzalez%' OR
                Encabezado like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                Encabezado like '%AMHM%' OR
                  
                PieFoto like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                PieFoto like '%TIANGUIS TURISTICO%' OR
                PieFoto like '%Rafael Garcia Gonzalez%' OR
                PieFoto like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                PieFoto like '%AMHM%' OR
                 
                Autor like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Autor like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Autor like '%Rafael Garcia Gonzalez%' OR
                Autor like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                Autor like '%AMHM%'
    ) GROUP BY n.Periodico , p.Nombre , s.seccion, n.Categoria , c.Categoria , n.NumeroPagina, n.Fecha,  n.PaginaPeriodico,  o.posicion , e.Nombre ORDER BY o.posicion";
            return $query;      
        break;//
        case 6: /*********** TIANGUIS - ESTADOS ************/
            $query="SELECT DISTINCT ( CONCAT( n.Periodico , n.NumeroPagina ) ), n.Periodico , n.NumeroPagina, 
                    p.Nombre as 'periodico', s.seccion, n.Categoria as 'Num.Categoria', c.Categoria as 'Categoria',  n.Fecha,  
                    n.PaginaPeriodico,  e.Nombre as 'Estado', CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf' FROM $Tabla n
              JOIN periodicos p ON p.idPeriodico=n.Periodico
              JOIN seccionesPeriodicos s ON s.idSeccion=n.Seccion
              JOIN categoriasPeriodicos c ON c.idCategoria=n.Categoria
              JOIN estados e ON p.estado=e.idEstado 
              WHERE n.Activo = 1 AND n.Categoria != 80 AND p.Estado != 9 AND Fecha = DATE('$fecha') AND (
                Texto like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Texto like '%TIANGUIS TURISTICO%' OR
                Texto like '%Rafael Garcia Gonzalez%' OR
                Texto like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                Texto like '%AMHM%' OR
                
                Titulo like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Titulo like '%TIANGUIS TURISTICO%' OR
                Titulo like '%Rafael Garcia Gonzalez%' OR
                Titulo like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                Titulo like '%AMHM%' OR

                Encabezado like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Encabezado like '%TIANGUIS TURISTICO%' OR
                Encabezado like '%Rafael Garcia Gonzalez%' OR
                Encabezado like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                Encabezado like '%AMHM%' OR
                  
                PieFoto like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                PieFoto like '%TIANGUIS TURISTICO%' OR
                PieFoto like '%Rafael Garcia Gonzalez%' OR
                PieFoto like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                PieFoto like '%AMHM%' OR
                 
                Autor like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Autor like '%TIANGUIS TURISTICO MEXICO 2016%' OR
                Autor like '%Rafael Garcia Gonzalez%' OR
                Autor like '%Presidente de la Asociacion Mexicana de Hoteles y Moteles%' OR
                Autor like '%AMHM%'
    ) GROUP BY n.Periodico , p.Nombre , s.seccion, n.Categoria , c.Categoria , n.NumeroPagina, n.Fecha,  n.PaginaPeriodico , e.Nombre 
      ORDER BY e.Nombre, n.Periodico";
            return $query;  
        break; /***********  EOF DIRECTOR ISSSTE ESTADOS     ************/
        
        case 7: /***********  SECRETARIA TURISMO FEDERAL DF  ************/
           $query="SELECT DISTINCT ( CONCAT( n.Periodico , n.NumeroPagina ) ), n.Periodico , n.NumeroPagina, o.posicion,
                    p.Nombre as 'periodico', s.seccion, n.Categoria as 'Num.Categoria', c.Categoria as 'Categoria',  n.Fecha,  
                    n.PaginaPeriodico,  e.Nombre as 'Estado', CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf' FROM $Tabla n
              JOIN periodicos p ON p.idPeriodico=n.Periodico
              JOIN ordenGeneral o ON p.idPeriodico=o.periodico
              JOIN seccionesPeriodicos s ON s.idSeccion=n.Seccion
              JOIN categoriasPeriodicos c ON c.idCategoria=n.Categoria
              JOIN estados e ON p.estado=e.idEstado WHERE n.Activo = 1 AND Fecha = DATE('$fecha') AND  (
                Texto like '%SECRETARIA DE TURISMO FEDERAL%' OR
                Titulo like '%SECRETARIA DE TURISMO FEDERAL%' OR
                Encabezado like '%SECRETARIA DE TURISMO FEDERAL%' OR
                PieFoto like '%SECRETARIA DE TURISMO FEDERAL%' OR
                Autor like '%SECRETARIA DE TURISMO FEDERAL%' )
             GROUP BY n.Periodico , p.Nombre , s.seccion, n.Categoria , c.Categoria , n.NumeroPagina, n.Fecha,  n.PaginaPeriodico,  o.posicion , e.Nombre ORDER BY o.posicion";
            return $query;      
        break;//
        case 8: /***********  SECRETARIA TURISMO FEDERAL ESTADOS     ************/
            $query="SELECT DISTINCT ( CONCAT( n.Periodico , n.NumeroPagina ) ), n.Periodico , n.NumeroPagina, 
                    p.Nombre as 'periodico', s.seccion, n.Categoria as 'Num.Categoria', c.Categoria as 'Categoria',  n.Fecha,  
                    n.PaginaPeriodico,  e.Nombre as 'Estado', CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf' FROM $Tabla n
              JOIN periodicos p ON p.idPeriodico=n.Periodico
              JOIN seccionesPeriodicos s ON s.idSeccion=n.Seccion
              JOIN categoriasPeriodicos c ON c.idCategoria=n.Categoria
              JOIN estados e ON p.estado=e.idEstado 
              WHERE n.Activo = 1 AND n.Categoria != 80 AND p.Estado != 9 AND Fecha = DATE('$fecha') AND (
                Texto like '%SECRETARIA DE TURISMO FEDERAL%' OR
                Titulo like '%SECRETARIA DE TURISMO FEDERAL%' OR
                Encabezado like '%SECRETARIA DE TURISMO FEDERAL%' OR
                PieFoto like '%SECRETARIA DE TURISMO FEDERAL%' OR
                Autor like '%SECRETARIA DE TURISMO FEDERAL%' )
                GROUP BY n.Periodico , p.Nombre , s.seccion, n.Categoria , c.Categoria , n.NumeroPagina, n.Fecha,  n.PaginaPeriodico , e.Nombre  ORDER BY e.Nombre, n.Periodico";
            return $query;  
        break; /**********************/

        case 9: /*********** CONSEJO DE PROMOCION TURISTICA - DF ************/
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
                    Texto like '%CONSEJO DE PROMOCION TURISTICA%' OR
                    Titulo like '%CONSEJO DE PROMOCION TURISTICA%' OR
                    Encabezado like '%CONSEJO DE PROMOCION TURISTICA%' OR
                    PieFoto like '%CONSEJO DE PROMOCION TURISTICA%' OR
                    Autor like '%CONSEJO DE PROMOCION TURISTICA%' )
                    GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 10: /*********** CONSEJO DE PROMOCION ESTADOS     ************/
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
                    Texto like '%CONSEJO DE PROMOCION TURISTICA%' OR
                    Titulo like '%CONSEJO DE PROMOCION TURISTICA%' OR
                    Encabezado like '%CONSEJO DE PROMOCION TURISTICA%' OR
                    PieFoto like '%CONSEJO DE PROMOCION TURISTICA%' OR
                    Autor like '%CONSEJO DE PROMOCION TURISTICA%' )
                    GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** ESTADOS ************/

        case 11: /*********** PROMEXICO - DF ************/
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
                        Texto like '%⁠⁠⁠PROMEXICO%' OR
                        Titulo like '%⁠⁠⁠PROMEXICO%' OR
                        Encabezado like '%⁠⁠⁠PROMEXICO%' OR
                        PieFoto like '%⁠⁠⁠PROMEXICO%' OR
                        Autor like '%⁠⁠⁠PROMEXICO%' 
                    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 12: /*********** PROMEXICO ESTADOS ************/
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
                        Texto like '%⁠⁠⁠PROMEXICO%' OR
                        Titulo like '%⁠⁠⁠PROMEXICO%' OR
                        Encabezado like '%⁠⁠⁠PROMEXICO%' OR
                        PieFoto like '%⁠⁠⁠PROMEXICO%' OR
                        Autor like '%⁠⁠⁠PROMEXICO%' 
                    )GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /**************************************/

        case 13: /*********** ENRIQUE DE LA MADRID CORDERO DF ************/
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
                    Texto like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    Texto like '%ENRIQUE DE LA MADRID%' OR

                    Titulo like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    Titulo like '%ENRIQUE DE LA MADRID%' OR

                    Encabezado like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    Encabezado like '%ENRIQUE DE LA MADRID%' OR

                    PieFoto like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    PieFoto like '%ENRIQUE DE LA MADRID%' OR

                    Autor like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    Autor like '%ENRIQUE DE LA MADRID%' 
                 ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 14: /*********** ENRIQUE DE LA MADRID CORDERO ESTADOS ************/
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
                    Texto like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    Texto like '%ENRIQUE DE LA MADRID%' OR

                    Titulo like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    Titulo like '%ENRIQUE DE LA MADRID%' OR

                    Encabezado like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    Encabezado like '%ENRIQUE DE LA MADRID%' OR

                    PieFoto like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    PieFoto like '%ENRIQUE DE LA MADRID%' OR

                    Autor like '%ENRIQUE DE LA MADRID CORDERO%' OR
                    Autor like '%ENRIQUE DE LA MADRID%' 
                 ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /***********************/
        
        case 15: /*********** ARISTOTELES DF ************/
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
            Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
            Texto like '%Jorge Aristoteles Sandoval%' OR
            Texto like '%Jorge Sandoval Diaz%' OR
            Texto like '%Aristoteles Sandoval Diaz%' OR
            Texto like '%Aristoteles Sandoval%' OR
            Texto like '%gobernador del estado de jalisco%' OR
            Texto like '%gobernador de jalisco%' OR
            Texto like '%gobernador del estado Aristoteles Sandoval Diaz%'OR
            
            Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
            Titulo like '%Jorge Aristoteles Sandoval%' OR
            Titulo like '%Jorge Sandoval Diaz%' OR
            Titulo like '%Aristoteles Sandoval Diaz%' OR
            Titulo like '%Aristoteles Sandoval%' OR
            Titulo like '%gobernador del estado de jalisco%' OR
            Titulo like '%gobernador de jalisco%' OR
            Titulo like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

            Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
            Encabezado like '%Jorge Aristoteles Sandoval%' OR
            Encabezado like '%Jorge Sandoval Diaz%' OR
            Encabezado like '%Aristoteles Sandoval Diaz%' OR
            Encabezado like '%Aristoteles Sandoval%' OR
            Encabezado like '%gobernador del estado de jalisco%' OR
            Encabezado like '%gobernador de jalisco%' OR
            Encabezado like '%gobernador del estado Aristoteles Sandoval Diaz%' OR
              
            PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
            PieFoto like '%Jorge Aristoteles Sandoval%' OR
            PieFoto like '%Jorge Sandoval Diaz%' OR
            PieFoto like '%Aristoteles Sandoval Diaz%' OR
            PieFoto like '%Aristoteles Sandoval%' OR
            PieFoto like '%gobernador del estado de jalisco%' OR
            PieFoto like '%gobernador de jalisco%' OR
            PieFoto like '%gobernador del estado Aristoteles Sandoval Diaz%' OR
             
            Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
            Autor like '%Jorge Aristoteles Sandoval%' OR
            Autor like '%Jorge Sandoval Diaz%' OR
            Autor like '%Aristoteles Sandoval Diaz%' OR
            Autor like '%Aristoteles Sandoval%' OR
            Autor like '%gobernador del estado de jalisco%' OR
            Autor like '%gobernador de jalisco%' OR
            Autor like '%gobernador del estado Aristoteles Sandoval Diaz %'
            )  GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 16: /*********** aristoteles ESTADOS ************/
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
                Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                Texto like '%Jorge Aristoteles Sandoval%' OR
                Texto like '%Jorge Sandoval Diaz%' OR
                Texto like '%Aristoteles Sandoval Diaz%' OR
                Texto like '%Aristoteles Sandoval%' OR
                Texto like '%gobernador del estado de jalisco%' OR
                Texto like '%gobernador de jalisco%' OR
                Texto like '%gobernador del estado Aristoteles Sandoval Diaz%'OR
                
                Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                Titulo like '%Jorge Aristoteles Sandoval%' OR
                Titulo like '%Jorge Sandoval Diaz%' OR
                Titulo like '%Aristoteles Sandoval Diaz%' OR
                Titulo like '%Aristoteles Sandoval%' OR
                Titulo like '%gobernador del estado de jalisco%' OR
                Titulo like '%gobernador de jalisco%' OR
                Titulo like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                Encabezado like '%Jorge Aristoteles Sandoval%' OR
                Encabezado like '%Jorge Sandoval Diaz%' OR
                Encabezado like '%Aristoteles Sandoval Diaz%' OR
                Encabezado like '%Aristoteles Sandoval%' OR
                Encabezado like '%gobernador del estado de jalisco%' OR
                Encabezado like '%gobernador de jalisco%' OR
                Encabezado like '%gobernador del estado Aristoteles Sandoval Diaz%' OR
                  
                PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
                PieFoto like '%Jorge Aristoteles Sandoval%' OR
                PieFoto like '%Jorge Sandoval Diaz%' OR
                PieFoto like '%Aristoteles Sandoval Diaz%' OR
                PieFoto like '%Aristoteles Sandoval%' OR
                PieFoto like '%gobernador del estado de jalisco%' OR
                PieFoto like '%gobernador de jalisco%' OR
                PieFoto like '%gobernador del estado Aristoteles Sandoval Diaz%' OR
                 
                Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
                Autor like '%Jorge Aristoteles Sandoval%' OR
                Autor like '%Jorge Sandoval Diaz%' OR
                Autor like '%Aristoteles Sandoval Diaz%' OR
                Autor like '%Aristoteles Sandoval%' OR
                Autor like '%gobernador del estado de jalisco%' OR
                Autor like '%gobernador de jalisco%' OR
                Autor like '%gobernador del estado Aristoteles Sandoval Diaz %'
                ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** ESTADOS ************/

        case 17: /*********** SECRETARIA DE TURISMO JALISCO - DF ************/
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
                        Texto like '%SECRETARIA DE TURISMO DE JALISCO%' OR
                        Titulo like '%SECRETARIA DE TURISMO DE JALISCO%' OR
                        Encabezado like '%SECRETARIA DE TURISMO DE JALISCO%' OR
                        PieFoto like '%SECRETARIA DE TURISMO DE JALISCO%' OR
                        Autor like '%SECRETARIA DE TURISMO DE JALISCO%' 
                    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 18: /*********** SECRETARIA DE TURISMO JALISCO ESTADOS ************/
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
                        Texto like '%SECRETARIA DE TURISMO DE JALISCO%' OR
                        Titulo like '%SECRETARIA DE TURISMO DE JALISCO%' OR
                        Encabezado like '%SECRETARIA DE TURISMO DE JALISCO%' OR
                        PieFoto like '%SECRETARIA DE TURISMO DE JALISCO%' OR
                        Autor like '%SECRETARIA DE TURISMO DE JALISCO%' 
                    ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;  
        break; /*********** ESTADOS ************/


        case 19: /*********** CONSEJO NACIONAL EMPRESARIAL DF ************/
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
                    Texto like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' OR
                    Titulo like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' OR
                    Encabezado like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' OR
                    PieFoto like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' OR
                    Autor like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' 
                ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 20: /*********** CONSEJO NACIONAL EMPRESARIAL ESTADOS ************/
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
                    Texto like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' OR
                    Titulo like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' OR
                    Encabezado like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' OR
                    PieFoto like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' OR
                    Autor like '%CONSEJO NACIONAL EMPRESARIAL TURISTICO%' 
                ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY p.Estado, n.Periodico";
    
            return $query;
        break; /*********** EOF ESTADOS ************/
	
	case 21: // PRESIDENTE
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
                   fecha =DATE('$fecha') AND
                   p.estado=e.idEstado AND
                   (
                    Texto like '%Enrique pena nieto%' OR
                    Texto like '%presidente peña%' OR
                    Texto like '%presidente de la republica%' OR
                    Texto like '%presidencia de la republica%' OR
                    Texto like '%peña nieto%' OR
                    Texto like '%pena nieto%' OR
                    Texto like 'Enrique pena nieto' OR
                    Texto like '%epn%' OR
                    Texto like '%@EPN%' OR
                    Texto like '%@presidenciaMX%' OR
                    Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
                    Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
                    Texto like '%de Pena Nieto%' OR
                    Texto like '% Enrique Pena %' OR
                    Texto like '% quique Pena %' OR
                    Texto like '%peñanietista%' OR
                    Texto like '%penanietista%' OR

                    Titulo like '%Enrique pena nieto%' OR
                    Titulo like '%presidente peña%' OR
                    Titulo like '%presidente de la republica%' OR
                    Titulo like '%presidencia de la republica%' OR
                    Titulo like '%peña nieto%' OR
                    Titulo like '%pena nieto%' OR
                    Titulo like 'Enrique pena nieto'  OR
                    Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                    Titulo like '%Senor Licenciado enrique pena nieto%' OR
                    Titulo like '%epn%' OR
                    Titulo like '%@EPN%' OR
                    Titulo like '%@presidenciaMX%' OR
                    Titulo like '% quique Pena %' OR
                    Titulo like '%peñanietista%' OR

                    Encabezado like '%Enrique pena nieto%' OR
                    Encabezado like '%presidente peña%' OR
                    Encabezado like '%presidente de la republica%' OR
                    Encabezado like '%presidencia de la republica%' OR
                    Encabezado like '%peña nieto%' OR
                    Encabezado like '%pena nieto%' OR
                    Encabezado like 'Enrique pena nieto' OR
                    Encabezado like '%epn%' OR
                    Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
                    Encabezado like '%Senor Licenciado enrique pena nieto%' OR
                    Encabezado like '%epn%' OR
                    Encabezado like '%@EPN%' OR
                    Encabezado like '%@presidenciaMX%' OR
                    Encabezado like '% quique Pena %' OR
                    Encabezado like '%peñanietista%'
                )
              group by n.Periodico,n.NumeroPagina";

        	return $query;  
		break;
	case 22:  /*********** CONSEJO NACIONAL EMPRESARIAL ESTADOS ************/
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
                        
                    Texto like '%Enrique pena nieto%' OR
                    Texto like '%presidente peña%' OR
                    Texto like '%presidente de la republica%' OR
                    Texto like '%presidencia de la republica%' OR
                    Texto like '%peña nieto%' OR
                    Texto like '%pena nieto%' OR
                    Texto like 'Enrique pena nieto' OR
                    Texto like '%epn%' OR
                    Texto like '%@EPN%' OR
                    Texto like '%@presidenciaMX%' OR
                    Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
                    Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
                    Texto like '%de Pena Nieto%' OR
                    Texto like '% Enrique Pena %' OR
                    Texto like '% quique Pena %' OR
                    Texto like '%peñanietista%' OR
                    Texto like '%penanietista%' OR

                    Titulo like '%Enrique pena nieto%' OR
                    Titulo like '%presidente peña%' OR
                    Titulo like '%presidente de la republica%' OR
                    Titulo like '%presidencia de la republica%' OR
                    Titulo like '%peña nieto%' OR
                    Titulo like '%pena nieto%' OR
                    Titulo like 'Enrique pena nieto'  OR
                    Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                    Titulo like '%Senor Licenciado enrique pena nieto%' OR
                    Titulo like '%epn%' OR
                    Titulo like '%@EPN%' OR
                    Titulo like '%@presidenciaMX%' OR
                    Titulo like '% quique Pena %' OR
                    Titulo like '%peñanietista%' OR

                    Encabezado like '%Enrique pena nieto%' OR
                    Encabezado like '%presidente peña%' OR
                    Encabezado like '%presidente de la republica%' OR
                    Encabezado like '%presidencia de la republica%' OR
                    Encabezado like '%peña nieto%' OR
                    Encabezado like '%pena nieto%' OR
                    Encabezado like 'Enrique pena nieto' OR
                    Encabezado like '%epn%' OR
                    Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
                    Encabezado like '%Senor Licenciado enrique pena nieto%' OR
                    Encabezado like '%epn%' OR
                    Encabezado like '%@EPN%' OR
                    Encabezado like '%@presidenciaMX%' OR
                    Encabezado like '% quique Pena %' OR
                    Encabezado like '%peñanietista%'
                )
              group by n.Periodico,n.NumeroPagina";
		return $query;
		break;
        default:
            break;
    }
}
?>
