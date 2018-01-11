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
        case 3:// Agramont
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
                  		Texto like '%Ricardo Barroso Agramont%' OR
                  		Texto like '%Ricardo Barroso%' OR
                  		Texto like '%Barroso Agramont%' OR

                  		Titulo like '%Ricardo Barroso Agramont%' OR
                  		Titulo like '%Ricardo Barroso%' OR
                  		Titulo like '%Barroso Agramont%' OR

                  		Encabezado like '%Ricardo Barroso Agramont%' OR
                  		Encabezado like '%Ricardo Barroso%' OR
                  		Encabezado like '%Barroso Agramont%' OR

                  		PieFoto like '%Ricardo Barroso Agramont%' OR
                  		PieFoto like '%Ricardo Barroso%' OR
                  		PieFoto like '%Barroso Agramont%' OR

                  		Autor like '%Ricardo Barroso Agramont%' OR
                  		Autor like '%Ricardo Barroso%' OR
                  		Autor like '%Barroso Agramont%'
                                  )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;
        break;
        case 4://Canditato PAN
        /*
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


                        )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;  
        */
        break;    
        case 5://Candidato PRD
        /*
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


                        )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;  
        */
        break;    

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

        /***************Estados****************/

        case 12:// Ricardo Barroso Agramont
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.estado<>9 AND
                   n.Categoria<>80 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Ricardo Barroso Agramont%' OR
                      Texto like '%Ricardo Barroso%' OR
                      Texto like '%Barroso Agramont%' OR

                      Titulo like '%Ricardo Barroso Agramont%' OR
                      Titulo like '%Ricardo Barroso%' OR
                      Titulo like '%Barroso Agramont%' OR

                      Encabezado like '%Ricardo Barroso Agramont%' OR
                      Encabezado like '%Ricardo Barroso%' OR
                      Encabezado like '%Barroso Agramont%' OR

                      PieFoto like '%Ricardo Barroso Agramont%' OR
                      PieFoto like '%Ricardo Barroso%' OR
                      PieFoto like '%Barroso Agramont%' OR

                      Autor like '%Ricardo Barroso Agramont%' OR
                      Autor like '%Ricardo Barroso%' OR
                      Autor like '%Barroso Agramont%'
                                  )
                GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;
        break;
        case 13://Candidato PAN
        /*
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


                        )
                GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;  
        */
        break;    
        case 14://Candidato PRD
        /*
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


                        )
                GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;  
        */
        break;    

               case 15:// Diputados
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
        case 16:// SENADORES
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
        case 17:// Partido Revolucionario Institucional
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
        case 18:// Partido Accion Nacional
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
        case 19:// PRD
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
        case 20:// PVEM
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
       
        default:
        break;
    }
}

?>
