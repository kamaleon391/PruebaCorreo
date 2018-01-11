<?php
function query($op,$Tabla){
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
        case 3:// Ivonne Alvarez
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
                        Texto like '%Ivonne Alvarez Garcia%' OR
                        Texto like '%Ivonne Alvarez%' OR
                        Texto like '%Alvarez Garcia%' OR

                        Titulo like '%Ivonne Alvarez Garcia%' OR
                        Titulo like '%Ivonne Alvarez%' OR
                        Titulo like '%Alvarez Garcia%' OR

                        Encabezado like '%Ivonne Alvarez Garcia%' OR
                        Encabezado like '%Ivonne Alvarez%' OR
                        Encabezado like '%Alvarez Garcia%' OR

                        PieFoto like '%Ivonne Alvarez Garcia%' OR
                        PieFoto like '%Ivonne Alvarez%' OR
                        PieFoto like '%Alvarez Garcia%' OR

                        Autor like '%Ivonne Alvarez Garcia%' OR
                        Autor like '%Ivonne Alvarez%' OR
                        Autor like '%Alvarez Garcia%'
                )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;
        break;//Ivonne Alvarez
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
			Texto like '%Felipe de Jesus Cantu Rodriguez%' OR
			Texto like '%Felipe de Jesus Cantu%' OR
			Texto like '%Felipe Cantu Rodriguez%' OR
			Texto like '%Felipe Cantu%' OR
			Texto like '%Cantu Rodriguez%' OR

			Titulo like '%Felipe de Jesus Cantu Rodriguez%' OR
			Titulo like '%Felipe de Jesus Cantu%' OR
			Titulo like '%Felipe Cantu Rodriguez%' OR
			Titulo like '%Felipe Cantu%' OR
			Titulo like '%Cantu Rodriguez%' OR

			Encabezado like '%Felipe de Jesus Cantu Rodriguez%' OR
			Encabezado like '%Felipe de Jesus Cantu%' OR
			Encabezado like '	%Felipe Cantu Rodriguez%' OR
			Encabezado like '%Felipe Cantu%' OR
			Encabezado like '%Cantu Rodriguez%' OR

			PieFoto like '%Felipe de Jesus Cantu Rodriguez%' OR
			PieFoto like '%Felipe de Jesus Cantu%' OR
			PieFoto like '%Felipe Cantu Rodriguez%' OR
			PieFoto like '%Felipe Cantu%' OR
			PieFoto like '%Cantu Rodriguez%' OR

			Autor like '%Felipe de Jesus Cantu Rodriguez%' OR
			Autor like '%Felipe de Jesus Cantu%' OR
			Autor like '%Felipe Cantu Rodriguez%' OR
			Autor like '%Felipe Cantu%' OR
			Autor like '%Cantu Rodriguez%'
	)
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY o.posicion";
            return $query;  
        break;//Felipe de Jesus Cantu
        case 5://PRD/PT
            return $query;      
        break;//PRD/PT
        case 6://STPS
            return $query;  
        break; //Mov. Ciudadano 
        case 7://MORENA
            return $query;  //MORENA      
        case 8:// Part. Humanista
              $query="SELECT n.idEditorial,
                      n.Periodico as 'idPeriodico',
                      p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                      CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND (
                            Texto like '%Jesus Maria Elizondo Gonzalez%' OR
                            Texto like '%Jesus Maria Elizondo%' OR
                            Texto like '%Jesus Elizondo Gonzalez%' OR
                            Texto like '%Elizondo Gonzalez%' OR

                            Titulo like '%Jesus Maria Elizondo Gonzalez%' OR
                            Titulo like '%Jesus Maria Elizondo%' OR
                            Titulo like '%Jesus Elizondo Gonzalez%' OR
                            Titulo like '%Elizondo Gonzalez%' OR

                            Encabezado like '%Jesus Maria Elizondo Gonzalez%' OR
                            Encabezado like '%Jesus Maria Elizondo%' OR
                            Encabezado like '%Jesus Elizondo Gonzalez%' OR
                            Encabezado like '%Elizondo Gonzalez%' OR

                            PieFoto like '%Jesus Maria Elizondo Gonzalez%' OR
                            PieFoto like '%Jesus Maria Elizondo%' OR
                            PieFoto like '%Jesus Elizondo Gonzalez%' OR
                            PieFoto like '%Elizondo Gonzalez%' OR

                            Autor like '%Jesus Maria Elizondo Gonzalez%' OR
                            Autor like '%Jesus Maria Elizondo%' OR
                            Autor like '%Jesus Elizondo Gonzalez%' OR
                            Autor like '%Elizondo Gonzalez%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  
            break; //Jesús María Elizondo González 
        case 9:// Diputados
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
        case 10:// SENADORES
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
        case 11:// Partido Revolucionario Institucional
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
        case 12:// Partido Acción Nacional
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
        case 13:// PRD
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
        case 14:// PVEM
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
                        Texto like '%Partido Verde Ecologista de México%' OR

                        Titulo like '% PVEM %' OR
                        Titulo like '%Partido Verde Ecologista de México%' OR

                        Encabezado like '% PVEM %' OR
                        Encabezado like '%Partido Verde Ecologista de México%' OR

                        PieFoto like '% PVEM %' OR
                        PieFoto like '%Partido Verde Ecologista de México%' OR

                        Autor like '% PVEM %' OR
                        Autor like '%Partido Verde Ecologista de México%'
                )AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )	
            ORDER BY o.posicion";
            return $query;  
            break;//PVEM
        case 15://Peñanieto
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
        case 16:// Ivonne Alvarez
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
                        Texto like '%Ivonne Alvarez Garcia%' OR
                        Texto like '%Ivonne Alvarez%' OR
                        Texto like '%Alvarez Garcia%' OR

                        Titulo like '%Ivonne Alvarez Garcia%' OR
                        Titulo like '%Ivonne Alvarez%' OR
                        Titulo like '%Alvarez Garcia%' OR

                        Encabezado like '%Ivonne Alvarez Garcia%' OR
                        Encabezado like '%Ivonne Alvarez%' OR
                        Encabezado like '%Alvarez Garcia%' OR

                        PieFoto like '%Ivonne Alvarez Garcia%' OR
                        PieFoto like '%Ivonne Alvarez%' OR
                        PieFoto like '%Alvarez Garcia%' OR

                        Autor like '%Ivonne Alvarez Garcia%' OR
                        Autor like '%Ivonne Alvarez%' OR
                        Autor like '%Alvarez Garcia%'
                )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY e.idEstado,p.Nombre";
            return $query;
        break;//Ivonne Alvarez
        case 17:
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
                        Texto like '%Margarita Arellanes Cervantes%' OR
                        Texto like '%Margarita Arellanes%' OR
                        Texto like '%Arellanes Cervantes%' OR

                        Titulo like '%Margarita Arellanes Cervantes%' OR
                        Titulo like '%Margarita Arellanes%' OR
                        Titulo like '%Arellanes Cervantes%' OR

                        Encabezado like '%Margarita Arellanes Cervantes%' OR
                        Encabezado like '%Margarita Arellanes%' OR
                        Encabezado like '%Arellanes Cervantes%' OR

                        PieFoto like '%Margarita Arellanes Cervantes%' OR
                        PieFoto like '%Margarita Arellanes%' OR
                        PieFoto like '%Arellanes Cervantes%' OR

                        Autor like '%Margarita Arellanes Cervantes%' OR
                        Autor like '%Margarita Arellanes%' OR
                        Autor like '%Arellanes Cervantes%'
                )
                GROUP BY p.idPeriodico,n.PaginaPeriodico
                ORDER BY e.idEstado,p.Nombre";
            return $query;  
        break;//Margarita Arellanes
        case 18://PRD/PT
            return $query;      
        break;//PRD/PT
        case 19://STPS
            return $query;  
        break; //Mov. Ciudadano 
        case 20://MORENA
            return $query;  //MORENA      
        case 21:// Part. Humanista
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
                            Texto like '%Jesus Maria Elizondo Gonzalez%' OR
                            Texto like '%Jesus Maria Elizondo%' OR
                            Texto like '%Jesus Elizondo Gonzalez%' OR
                            Texto like '%Elizondo Gonzalez%' OR

                            Titulo like '%Jesus Maria Elizondo Gonzalez%' OR
                            Titulo like '%Jesus Maria Elizondo%' OR
                            Titulo like '%Jesus Elizondo Gonzalez%' OR
                            Titulo like '%Elizondo Gonzalez%' OR

                            Encabezado like '%Jesus Maria Elizondo Gonzalez%' OR
                            Encabezado like '%Jesus Maria Elizondo%' OR
                            Encabezado like '%Jesus Elizondo Gonzalez%' OR
                            Encabezado like '%Elizondo Gonzalez%' OR

                            PieFoto like '%Jesus Maria Elizondo Gonzalez%' OR
                            PieFoto like '%Jesus Maria Elizondo%' OR
                            PieFoto like '%Jesus Elizondo Gonzalez%' OR
                            PieFoto like '%Elizondo Gonzalez%' OR

                            Autor like '%Jesus Maria Elizondo Gonzalez%' OR
                            Autor like '%Jesus Maria Elizondo%' OR
                            Autor like '%Jesus Elizondo Gonzalez%' OR
                            Autor like '%Elizondo Gonzalez%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break; //Jesús María Elizondo González 

            case 22:// Diputados
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
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break;//Diputados 
        case 23:// SENADORES
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
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break; //Senadores
        case 24:// Partido Revolucionario Institucional
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
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break;  //PRI
        case 25:// Partido Acción Nacional
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
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break;//PAN
        case 26:// PRD
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
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break; //PRD
        case 27:// PVEM
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
                        Texto like '%Partido Verde Ecologista de México%' OR

                        Titulo like '% PVEM %' OR
                        Titulo like '%Partido Verde Ecologista de México%' OR

                        Encabezado like '% PVEM %' OR
                        Encabezado like '%Partido Verde Ecologista de México%' OR

                        PieFoto like '% PVEM %' OR
                        PieFoto like '%Partido Verde Ecologista de México%' OR

                        Autor like '% PVEM %' OR
                        Autor like '%Partido Verde Ecologista de México%'
                )AND n.Periodico in (32,50) AND(
                        n.NumeroPagina like '%A_1.pdf%' OR 
                        n.NumeroPagina like '%A_2.pdf%'
                    )   
            ORDER BY e.idEstado,p.Nombre";
            return $query;  
            break;//PVEM
        case 28://Peñanieto
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
