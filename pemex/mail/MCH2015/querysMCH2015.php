<?php
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
                    p.estado=e.idEstado AND n.Activo=1 AND
                    n.Periodico in (32,50,59,53,51)
                    GROUP BY n.NumeroPagina,p.idPeriodico
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
                    fecha =DATE('$fecha') AND n.Activo=1  AND(
                            n.Titulo like '%Templo Mayor%' OR
                            n.Titulo like '%Bajo Reserva%' OR
                            n.Titulo like '%Trascendio%' OR
                            n.Titulo like '%Arsenal%' OR
                            n.Titulo like '%La Historia en Breve%' OR
                            n.Titulo like '%Historias de Reportero%' OR
                            n.Titulo like '%En Privado%' OR
                            n.Titulo like '%Serpientes y Escaleras%' OR
                            n.Titulo like '%Monje Loco%' OR
                            n.Titulo like '%Juegos de Poder%' OR
                            n.Titulo like '%Estrictamente Personal%' OR
                            Autor like '%Francisco Garfias%' OR
                            Autor like '%Ciro Gomez Leyva%' OR
                            Autor like '%Carlos Loret de Mola%' OR
                            Autor like '%Joaquin Lopez Doriga%' OR
                            Autor like '%Salvador Garcia Soto%' OR
                            Autor like '%Jose Cardenas%' OR
                            Autor like '%Leo Zuckerman%' OR
                            Autor like '%Raymundo Riva Palacio%'
                    ) 
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.id";
            return $query;
            break;//Columnas Politicas
        case 3:// Jose Ascension Orihuela
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
                        Texto like '%Jose Ascension Orihuela%' OR
                        Texto like '%Jose Ascension%' OR
                        Texto like '%Ascension Orihuela%' OR
                        Texto like '%Chon Orihuela%' OR

                        Titulo like '%Jose Ascension Orihuela%' OR
                        Titulo like '%Jose Ascension%' OR
                        Titulo like '%Ascension Orihuela%' OR
                        Titulo like '%Chon Orihuela%' OR

                        Encabezado like '%Jose Ascension Orihuela%' OR
                        Encabezado like '%Jose Ascension%' OR
                        Encabezado like '%Ascension Orihuela%' OR
                        Encabezado like '%Chon Orihuela%' OR

                        PieFoto like '%Jose Ascension Orihuela%' OR
                        PieFoto like '%Jose Ascension%' OR
                        PieFoto like '%Ascension Orihuela%' OR
                        PieFoto like '%Chon Orihuela%' OR

                        Autor like '%Jose Ascension Orihuela%' OR
                        Autor like '%Jose Ascension%' OR
                        Autor like '%Ascension Orihuela%' OR
                        Autor like '%Chon Orihuela%'
                    )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;
        break;//Luisa Maria Calderon
        case 4:
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
                        Texto like '%Luisa Maria Calderon%' OR
                        Texto like '%Maria Calderon%' OR

                        Titulo like '%Luisa Maria Calderon%' OR
                        Titulo like '%Maria Calderon%' OR

                        Encabezado like '%Luisa Maria Calderon%' OR
                        Encabezado like '%Maria Calderon%' OR

                        PieFoto like '%Luisa Maria Calderon%' OR
                        PieFoto like '%Maria Calderon%' OR

                        Autor like '%Luisa Maria Calderon%' OR
                        Autor like '%Maria Calderon%'
                    )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;  
        break;//Silvano Aureoles Conejo    
        case 5:
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
                        Texto like '%Silvano Aureoles Conejo%' OR
                        Texto like '%Silvano Aureoles%' OR
                    Texto like '%Aureoles Conejo%' OR

                        Titulo like '%Silvano Aureoles Conejo%' OR
                        Titulo like '%Silvano Aureoles%' OR
                    Titulo like '%Aureoles Conejo%' OR

                        Encabezado like '%Silvano Aureoles Conejo%' OR
                        Encabezado like '%Silvano Aureoles%' OR
                    Encabezado like '%Aureoles Conejo%' OR

                        PieFoto like '%Silvano Aureoles Conejo%' OR
                        PieFoto like '%Silvano Aureoles%' OR
                    PieFoto like '%Aureoles Conejo%' OR

                        Autor like '%Silvano Aureoles Conejo%' OR
                        Autor like '%Silvano Aureoles%' OR
                    Autor like '%Aureoles Conejo%'
                    )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;  
        break;//Margarita Arellanes    
        case 6:// Diputados
             $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '%Diputado%' OR
                            Texto like '%Diputada%' OR

                            Titulo like '%Diputado%' OR
                            Titulo like '%Diputada%' OR

                            Encabezado like '%Diputado%' OR
                            Encabezado like '%Diputada%' OR

                            PieFoto like '%Diputado%' OR
                            PieFoto like '%Diputada%' OR

                            Autor like '%Diputado%' OR
                            Autor like '%Diputada%'
                    ) AND n.Periodico in (32,50) AND(
                            n.NumeroPagina like '%A_1.pdf%' OR 
                            n.NumeroPagina like '%A_2.pdf%'
                    )   
            ORDER BY o.posicion";
            return $query;  
            break;//Diputados 
        case 7:// SENADORES
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '%Senador%' OR
                            Texto like '%Senadora%' OR

                            Titulo like '%Senador%' OR
                            Titulo like '%Senadora%' OR

                            Encabezado like '%Senador%' OR
                            Encabezado like '%Senadora%' OR

                            PieFoto like '%Senador%' OR
                            PieFoto like '%Senadora%' OR

                            Autor like '%Senador%' OR
                            Autor like '%Senadora%'
                    ) AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            ORDER BY o.posicion";
            return $query;  
            break; //Senadores
        case 8:// Partido Revolucionario Institucional
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '% PRI %' OR
                            Texto like '%Partido Revolucionario Institucional%' OR

                            Titulo like '% PRI %' OR
                            Titulo like '%Partido Revolucionario Institucional%' OR

                            Encabezado like '% PRI %' OR
                            Encabezado like '%Partido Revolucionario Institucional%' OR

                            PieFoto like '% PRI %' OR
                            PieFoto like '%Partido Revolucionario Institucional%' OR

                            Autor like '% PRI %' OR
                            Autor like '%Partido Revolucionario Institucional%'
                    ) AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            ORDER BY o.posicion";
            return $query;  
            break;  //PRI
        case 9:// Partido Accion Nacional
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '% PAN %' OR
                            Texto like '%Partido Accion Nacional%' OR

                            Titulo like '% PAN %' OR
                            Titulo like '%Partido Accion Nacional%' OR

                            Encabezado like '% PAN %' OR
                            Encabezado like '%Partido Accion Nacional%' OR

                            PieFoto like '% PAN %' OR
                            PieFoto like '%Partido Accion Nacional%' OR

                            Autor like '% PAN %' OR
                            Autor like '%Partido Accion Nacional%'
                    )AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            ORDER BY o.posicion";
            return $query;  
            break;//PAN
        case 10:// PRD
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND  (
                            Texto like '% PRD %' OR
                            Texto like '%Partido de la revolucion democratica%' OR

                            Titulo like '% PRD %' OR
                            Titulo like '%Partido de la revolucion democratica%' OR

                            Encabezado like '% PRD %' OR
                            Encabezado like '%Partido de la revolucion democratica%' OR

                            PieFoto like '% PRD %' OR
                            PieFoto like '%Partido de la revolucion democratica%' OR

                            Autor like '% PRD %' OR
                            Autor like '%Partido de la revolucion democratica%'
                    )AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            ORDER BY o.posicion";
            return $query;  
            break; //PRD
        case 11:// PVEM
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                        Texto like '% PVEM %' OR
                        Texto like '%Partido Verde Ecologista de Mexico%' OR

                        Titulo like '% PVEM %' OR
                        Titulo like '%Partido Verde Ecologista de Mexico%' OR

                        Encabezado like '% PVEM %' OR
                        Encabezado like '%Partido Verde Ecologista de Mexico%' OR

                        PieFoto like '% PVEM %' OR
                        PieFoto like '%Partido Verde Ecologista de Mexico%' OR

                        Autor like '% PVEM %' OR
                        Autor like '%Partido Verde Ecologista de Mexico%'
                )AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            ORDER BY o.posicion";
            return $query;  
            break;//PVEM
        case 12://Peñanieto
              $query="SELECT 
                        n.idEditorial,
                        n.Periodico as 'idPeriodico',
                        p.Nombre as 'periodico',
                        n.Seccion,
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
                        p.estado=e.idEstado AND
                        n.Activo=1 AND
                        fecha =DATE('$fecha') AND  (
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
                 )AND n.Periodico in (32,50) AND(
                                n.NumeroPagina like '%A_1.pdf%' OR 
                                n.NumeroPagina like '%A_2.pdf%'
                        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;  
            break; //PRESIDENTE
        
        /**********Querys Estados**********/

                case 13:// Jose Ascension Orihuela
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                   fecha =DATE('$fecha') AND (
                        Texto like '%Jose Ascension Orihuela%' OR
                        Texto like '%Jose Ascension%' OR
                        Texto like '%Ascension Orihuela%' OR
                        Texto like '%Chon Orihuela%' OR

                        Titulo like '%Jose Ascension Orihuela%' OR
                        Titulo like '%Jose Ascension%' OR
                        Titulo like '%Ascension Orihuela%' OR
                        Titulo like '%Chon Orihuela%' OR

                        Encabezado like '%Jose Ascension Orihuela%' OR
                        Encabezado like '%Jose Ascension%' OR
                        Encabezado like '%Ascension Orihuela%' OR
                        Encabezado like '%Chon Orihuela%' OR

                        PieFoto like '%Jose Ascension Orihuela%' OR
                        PieFoto like '%Jose Ascension%' OR
                        PieFoto like '%Ascension Orihuela%' OR
                        PieFoto like '%Chon Orihuela%' OR

                        Autor like '%Jose Ascension Orihuela%' OR
                        Autor like '%Jose Ascension%' OR
                        Autor like '%Ascension Orihuela%' OR
                        Autor like '%Chon Orihuela%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY e.idEstado,p.Nombre";
            return $query;
        break;//Luisa Maria Calderon
        case 14:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                   fecha =DATE('$fecha') AND (
                        Texto like '%Luisa Maria Calderon%' OR
                    Texto like '%Maria Calderon%' OR

                    Titulo like '%Luisa Maria Calderon%' OR
                    Titulo like '%Maria Calderon%' OR

                    Encabezado like '%Luisa Maria Calderon%' OR
                    Encabezado like '%Maria Calderon%' OR

                    PieFoto like '%Luisa Maria Calderon%' OR
                    PieFoto like '%Maria Calderon%' OR

                    Autor like '%Luisa Maria Calderon%' OR
                    Autor like '%Maria Calderon%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY e.idEstado,p.Nombre";
            return $query;  
        break;//Silvano Aureoles Conejo    
        case 15:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                   fecha =DATE('$fecha') AND (
                        Texto like '%Silvano Aureoles Conejo%' OR
                    Texto like '%Silvano Aureoles%' OR
                    Texto like '%Aureoles Conejo%' OR

                    Titulo like '%Silvano Aureoles Conejo%' OR
                    Titulo like '%Silvano Aureoles%' OR
                    Titulo like '%Aureoles Conejo%' OR

                    Encabezado like '%Silvano Aureoles Conejo%' OR
                    Encabezado like '%Silvano Aureoles%' OR
                    Encabezado like '%Aureoles Conejo%' OR

                    PieFoto like '%Silvano Aureoles Conejo%' OR
                    PieFoto like '%Silvano Aureoles%' OR
                    PieFoto like '%Aureoles Conejo%' OR

                    Autor like '%Silvano Aureoles Conejo%' OR
                    Autor like '%Silvano Aureoles%' OR
                    Autor like '%Aureoles Conejo%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY e.idEstado,p.Nombre";
            return $query;  
        break;    
        case 16:// Diputados
             $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '%Diputado%' OR
                            Texto like '%Diputada%' OR

                            Titulo like '%Diputado%' OR
                            Titulo like '%Diputada%' OR

                            Encabezado like '%Diputado%' OR
                            Encabezado like '%Diputada%' OR

                            PieFoto like '%Diputado%' OR
                            PieFoto like '%Diputada%' OR

                            Autor like '%Diputado%' OR
                            Autor like '%Diputada%'
                    ) AND n.Periodico in (32,50) AND(
                            n.NumeroPagina like '%A_1.pdf%' OR 
                            n.NumeroPagina like '%A_2.pdf%'
                    )   
            GROUP BY n.Periodico,n.NumeroPagina
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break;//Diputados 
        case 17:// SENADORES
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '%Senador%' OR
                            Texto like '%Senadora%' OR

                            Titulo like '%Senador%' OR
                            Titulo like '%Senadora%' OR

                            Encabezado like '%Senador%' OR
                            Encabezado like '%Senadora%' OR

                            PieFoto like '%Senador%' OR
                            PieFoto like '%Senadora%' OR

                            Autor like '%Senador%' OR
                            Autor like '%Senadora%'
                    ) AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            GROUP BY n.Periodico,n.NumeroPagina
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break; //Senadores
        case 18:// Partido Revolucionario Institucional
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '% PRI %' OR
                            Texto like '%Partido Revolucionario Institucional%' OR

                            Titulo like '% PRI %' OR
                            Titulo like '%Partido Revolucionario Institucional%' OR

                            Encabezado like '% PRI %' OR
                            Encabezado like '%Partido Revolucionario Institucional%' OR

                            PieFoto like '% PRI %' OR
                            PieFoto like '%Partido Revolucionario Institucional%' OR

                            Autor like '% PRI %' OR
                            Autor like '%Partido Revolucionario Institucional%'
                    ) AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            GROUP BY n.Periodico,n.NumeroPagina
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break;  //PRI
        case 19:// Partido Accion Nacional
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '% PAN %' OR
                            Texto like '%Partido Accion Nacional%' OR

                            Titulo like '% PAN %' OR
                            Titulo like '%Partido Accion Nacional%' OR

                            Encabezado like '% PAN %' OR
                            Encabezado like '%Partido Accion Nacional%' OR

                            PieFoto like '% PAN %' OR
                            PieFoto like '%Partido Accion Nacional%' OR

                            Autor like '% PAN %' OR
                            Autor like '%Partido Accion Nacional%'
                    )AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            GROUP BY n.Periodico,n.NumeroPagina
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break;//PAN
        case 20:// PRD
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                    fecha =DATE('$fecha') AND  (
                            Texto like '% PRD %' OR
                            Texto like '%Partido de la revolucion democratica%' OR

                            Titulo like '% PRD %' OR
                            Titulo like '%Partido de la revolucion democratica%' OR

                            Encabezado like '% PRD %' OR
                            Encabezado like '%Partido de la revolucion democratica%' OR

                            PieFoto like '% PRD %' OR
                            PieFoto like '%Partido de la revolucion democratica%' OR

                            Autor like '% PRD %' OR
                            Autor like '%Partido de la revolucion democratica%'
                    )AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            GROUP BY n.Periodico,n.NumeroPagina
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break; //PRD
        case 21:// PVEM
              $query="SELECT 
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    n.Seccion,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                    fecha =DATE('$fecha') AND (
                        Texto like '% PVEM %' OR
                        Texto like '%Partido Verde Ecologista de Mexico%' OR

                        Titulo like '% PVEM %' OR
                        Titulo like '%Partido Verde Ecologista de Mexico%' OR

                        Encabezado like '% PVEM %' OR
                        Encabezado like '%Partido Verde Ecologista de Mexico%' OR

                        PieFoto like '% PVEM %' OR
                        PieFoto like '%Partido Verde Ecologista de Mexico%' OR

                        Autor like '% PVEM %' OR
                        Autor like '%Partido Verde Ecologista de Mexico%'
                )AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            GROUP BY n.Periodico,n.NumeroPagina
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break;//PVEM
        case 22://Peñanieto
              $query="SELECT 
                        n.idEditorial,
                        n.Periodico as 'idPeriodico',
                        p.Nombre as 'periodico',
                        n.Seccion,
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                    e.idEstado <> 9 AND
                    n.Categoria<>80 AND
                        fecha =DATE('$fecha') AND  (
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
                 )AND n.Periodico in (32,50) AND(
                                n.NumeroPagina like '%A_1.pdf%' OR 
                                n.NumeroPagina like '%A_2.pdf%'
                        )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break; //PRESIDENTE

        default:
            break;
    }
}

?>
