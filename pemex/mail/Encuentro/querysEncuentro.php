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

function query( $op, $Tabla, $estado ) {
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
                    GROUP BY n.Periodico,n.NumeroPagina  
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
                    GROUP BY n.Periodico,n.NumeroPagina  ";
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
                    GROUP BY n.Periodico,n.NumeroPagina  
                    ORDER BY o.posicion
                    ";
            return $query;  
            break;// 
        case 5: //*********** ENCUENTRO SOCIAL - DF ************
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
    Texto      like '%Partido Encuentro Social%' OR
    Texto      like '%Encuentro Social%' OR

    Titulo      like '%Partido Encuentro Social%' OR
    Titulo      like '%Encuentro Social%' OR
   
    Encabezado      like '%Partido Encuentro Social%' OR
    Encabezado      like '%Encuentro Social%' OR
   

    Autor      like '%Partido Encuentro Social%' OR
    Autor      like '%Encuentro Social%' OR
    
    PieFoto      like '%Partido Encuentro Social%' OR
    PieFoto      like '%Encuentro Social%' 
    ) GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 6: //*********** PRI - CDMX ************
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
    Texto      like '%Partido Revolucionario Institucional%' OR
    Texto      like '%Revolucionario Institucional%' OR
    Texto      like '% PRI %' OR

    Titulo      like '%Partido Revolucionario Institucional%' OR
    Titulo      like '%Revolucionario Institucional%' OR
    Titulo      like '% PRI %' OR

    Encabezado      like '%Partido Revolucionario Institucional%' OR
    Encabezado      like '%Revolucionario Institucional%' OR
    Encabezado      like '% PRI %' OR

    Autor      like '%Partido Revolucionario Institucional%' OR
    Autor      like '%Revolucionario Institucional%' OR
    Autor      like '% PRI %' OR

    PieFoto      like '%Partido Revolucionario Institucional%' OR
    PieFoto      like '%Revolucionario Institucional%' OR
    PieFoto      like '% PRI %'
)  GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";

            return $query;  
        break;//***********  EOF PRI     ************/
        
        case 7: //***********  PAN CDMX  ************/
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
    Texto      like '%Partido Accion Nacional%' OR
    Texto      like '%Accion Nacional%' OR
    Texto      like '% PAN %' OR

    Titulo      like '%Partido Accion Nacional%' OR
    Titulo      like '%Accion Nacional%' OR
    Titulo      like '% PAN %' OR

    Encabezado      like '%Partido Accion Nacional%' OR
    Encabezado      like '%Accion Nacional%' OR
    Encabezado      like '% PAN %' OR

    Autor      like '%Partido Accion Nacional%' OR
    Autor      like '%Accion Nacional%' OR
    Autor      like '% PAN %' OR

    PieFoto      like '%Partido Accion Nacional%' OR
    PieFoto      like '%Accion Nacional%' OR
    PieFoto      like '% PAN %'
)  GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
        break;//
        case 8: //***********  PRD CDMX     ************
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
                        Texto      like '%Partido de la Revolucion Democratica' OR
                        Texto      like '%Revolucion Democratica%' OR
                        Texto      like '% PRD %' OR

                        Titulo      like '%Partido de la Revolucion Democratica%' OR
                        Titulo      like '%Revolucion Democratica%' OR
                        Titulo      like '% PRD %' OR

                        Encabezado      like '%Partido de la Revolucion Democratica%' OR
                        Encabezado      like '%Revolucion Democratica%' OR
                        Encabezado      like '% PRD %' OR

                        Autor      like '%Partido de la Revolucion Democratica%' OR
                        Autor      like '%Revolucion Democratica%' OR
                        Autor      like '% PRD %' OR

                        PieFoto      like '%Partido de la Revolucion Democratica%' OR
                        PieFoto      like '%Revolucion Democratica%' OR
                        PieFoto      like '% PRD %'
                    )   GROUP BY p.idPeriodico, n.PaginaPeriodico ORDER BY o.posicion";
            return $query;  
        break; /*********** EOF PRD CDMX ************/

        case 9: /*********** ENCUENTROS CDMX ************/
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
                  (
                      Texto      like '%Encuesta electoral' OR
                      Texto      like '%Preferencia electoral%' OR
                      Texto      like '%Sondeo de opinion%' OR
                      Texto      like '%estudio demoscopico%' OR

                      Titulo      like '%Encuesta electoral%' OR
                      Titulo      like '%Preferencia electoral%' OR
                      Titulo      like '%Sondeo de opinion%' OR
                      Titulo      like '%estudio demoscopico%' OR

                      Encabezado      like '%Encuesta electoral%' OR
                      Encabezado      like '%Preferencia electoral%' OR
                      Encabezado      like '%Sondeo de opinion%' OR
                      Encabezado      like '%estudio demoscopico%' OR

                      Autor      like '%Encuesta electoral%' OR
                      Autor      like '%Preferencia electoral%' OR
                      Autor      like '%Sondeo de opinion%' OR
                      Autor      like '%estudio demoscopico%' OR

                      PieFoto      like '%Encuesta electoral%' OR
                      PieFoto      like '%Preferencia electoral%' OR
                      PieFoto      like '%Sondeo de opinion%' OR
                      PieFoto      like '%estudio demoscopico%'
                  ) OR n.Categoria=93 )   GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;
//*******************************/
        case 10: //*********** ENCUENTRO SOCIAL - EDOS ************/
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
    Texto      like '%Partido Encuentro Social%' OR
    Texto      like '%Encuentro Social%' OR

    Titulo      like '%Partido Encuentro Social%' OR
    Titulo      like '%Encuentro Social%' OR
   
    Encabezado      like '%Partido Encuentro Social%' OR
    Encabezado      like '%Encuentro Social%' OR
   

    Autor      like '%Partido Encuentro Social%' OR
    Autor      like '%Encuentro Social%' OR
    
    PieFoto      like '%Partido Encuentro Social%' OR
    PieFoto      like '%Encuentro Social%' 
    ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//
        case 11: //*********** PRI - EDOS ************/
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
    Texto      like '%Partido Revolucionario Institucional%' OR
    Texto      like '%Revolucionario Institucional%' OR
    Texto      like '% PRI %' OR

    Titulo      like '%Partido Revolucionario Institucional%' OR
    Titulo      like '%Revolucionario Institucional%' OR
    Titulo      like '% PRI %' OR

    Encabezado      like '%Partido Revolucionario Institucional%' OR
    Encabezado      like '%Revolucionario Institucional%' OR
    Encabezado      like '% PRI %' OR

    Autor      like '%Partido Revolucionario Institucional%' OR
    Autor      like '%Revolucionario Institucional%' OR
    Autor      like '% PRI %' OR

    PieFoto      like '%Partido Revolucionario Institucional%' OR
    PieFoto      like '%Revolucionario Institucional%' OR
    PieFoto      like '% PRI %'
)  GROUP BY p.idPeriodico,n.PaginaPeriodico";

            return $query;  
        break; /***********  EOF     ************/
        
        case 12: //***********  PAN EDOS  ************/
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
    Texto      like '%Partido Accion Nacional%' OR
    Texto      like '%Accion Nacional%' OR
    Texto      like '% PAN %' OR

    Titulo      like '%Partido Accion Nacional%' OR
    Titulo      like '%Accion Nacional%' OR
    Titulo      like '% PAN %' OR

    Encabezado      like '%Partido Accion Nacional%' OR
    Encabezado      like '%Accion Nacional%' OR
    Encabezado      like '% PAN %' OR

    Autor      like '%Partido Accion Nacional%' OR
    Autor      like '%Accion Nacional%' OR
    Autor      like '% PAN %' OR

    PieFoto      like '%Partido Accion Nacional%' OR
    PieFoto      like '%Accion Nacional%' OR
    PieFoto      like '% PAN %'
)  GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//
        case 13://***********  PRD EDOS     ************/
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
    Texto      like '%Partido de la Revolucion Democratica' OR
    Texto      like '%Revolucion Democratica%' OR
    Texto      like '% PRD %' OR

    Titulo      like '%Partido de la Revolucion Democratica%' OR
    Titulo      like '%Revolucion Democratica%' OR
    Titulo      like '% PRD %' OR

    Encabezado      like '%Partido de la Revolucion Democratica%' OR
    Encabezado      like '%Revolucion Democratica%' OR
    Encabezado      like '% PRD %' OR

    Autor      like '%Partido de la Revolucion Democratica%' OR
    Autor      like '%Revolucion Democratica%' OR
    Autor      like '% PRD %' OR

    PieFoto      like '%Partido de la Revolucion Democratica%' OR
    PieFoto      like '%Revolucion Democratica%' OR
    PieFoto      like '% PRD %'
)   GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;  
        break; /*********** EOF PRD  ************/

        case 14: //*********** ENCUENTRAS EDOS ************/
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND ( 
                    (
                        Texto      like '%Encuesta electoral' OR
                        Texto      like '%Preferencia electoral%' OR
                        Texto      like '%Sondeo de opinion%' OR
                        Texto      like '%estudio demoscopico%' OR

                        Titulo      like '%Encuesta electoral%' OR
                        Titulo      like '%Preferencia electoral%' OR
                        Titulo      like '%Sondeo de opinion%' OR
                        Titulo      like '%estudio demoscopico%' OR

                        Encabezado      like '%Encuesta electoral%' OR
                        Encabezado      like '%Preferencia electoral%' OR
                        Encabezado      like '%Sondeo de opinion%' OR
                        Encabezado      like '%estudio demoscopico%' OR

                        Autor      like '%Encuesta electoral%' OR
                        Autor      like '%Preferencia electoral%' OR
                        Autor      like '%Sondeo de opinion%' OR
                        Autor      like '%estudio demoscopico%' OR

                        PieFoto      like '%Encuesta electoral%' OR
                        PieFoto      like '%Preferencia electoral%' OR
                        PieFoto      like '%Sondeo de opinion%' OR
                        PieFoto      like '%estudio demoscopico%'
                    ) OR n.Categoria=93 )     GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        case 15: /*********** PT CDMX ************/
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
    Texto      like '%Partido del Trabajo%' OR
    Texto      like '% PT %' OR
    Titulo      like '%Partido del Trabajo%' OR
    Titulo      like '% PT %' OR
    Encabezado      like '%Partido del Trabajo%' OR
    Encabezado      like '% PT %' OR
    Autor      like '%Partido del Trabajo%' OR
    Autor      like '% PT %' OR
    PieFoto      like '%Partido del Trabajo%' OR
    PieFoto      like '% PT %' ) GROUP BY p.idPeriodico, n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;      
        break;//
        case 16: /*********** PT EDOS ************/
           $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                   p.estado=e.idEstado AND p.estado != 9 AND
                   p.Tipo = 1 AND
                   n.Activo = 1 AND
                   fecha =DATE('$fecha') AND (
    Texto      like '%Partido del Trabajo%' OR
    Texto      like '% PT %' OR

    Titulo      like '%Partido del Trabajo%' OR
    Titulo      like '% PT %' OR
   
    Encabezado      like '%Partido del Trabajo%' OR
    Encabezado      like '% PT %' OR
   
    Autor      like '%Partido del Trabajo%' OR
    Autor      like '% PT %' OR
    
    PieFoto      like '%Partido del Trabajo%' OR
    PieFoto      like '% PT %' ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//
  
        default:
            break;
    }
}
?>
