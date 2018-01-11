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
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.NumeroPagina,p.idPeriodico 
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
                    GROUP BY n.idEditorial";
            return $query;
            break;//Columnas Financieras
        case 4:
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
                    GROUP BY n.idEditorial
                    ORDER BY o.posicion
                    ";
            return $query;  
            break;// Cartones DF
        case 5://Emilio Lozoya Austin
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
		Texto like '%Emilio Lozoya Austin%' OR
		Texto like '%Emilio Lozoya%' OR
		Texto like '%Lozoya Austin%' OR

		Titulo like '%Emilio Lozoya Austin%' OR
		Titulo like '%Emilio Lozoya%' OR
		Titulo like '%Lozoya Austin%' OR

		Encabezado like '%Emilio Lozoya Austin%' OR
		Encabezado like '%Emilio Lozoya%' OR
		Encabezado like '%Lozoya Austin%' OR

		PieFoto like '%Emilio Lozoya Austin%' OR
		PieFoto like '%Emilio Lozoya%' OR
		PieFoto like '%Lozoya Austin%' OR

		Autor like '%Emilio Lozoya Austin%' OR
		Autor like '%Emilio Lozoya%' OR
		Autor like '%Lozoya Austin%'
	)
GROUP BY p.idPeriodico,n.PaginaPeriodico
ORDER BY o.posicion";
            return $query;      
        break;//Emilio Lozoya Austin
        case 6://Admon. Central
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
                    Texto like '%Marco Antonio De la Peña Sánchez%' OR
                    Texto like '%Carlos Rafael Murrieta Cummings%' OR
                    Texto like '%Carlos Rafael Murrieta%' OR
                    Texto like '%Arturo Francisco Henríquez Autrey%' OR
                    Texto like '%Arturo Francisco Henríquez%' OR
                    Texto like '%Víctor Díaz Solís%' OR
                    Texto like '%Mario Alberto Beauregard Álvarez%' OR
                    Texto like '%Mario Alberto Beauregard%' OR
                    Texto like '%José Luis Luna Cárdenas%' OR
                    Texto like '%Gustavo Hernández García%' OR
                    Texto like '%Miguel Tame Domínguez%' OR
                    Texto like '%Alejandro Martínez Sibaja%' OR
                    Texto like '%Manuel Sánchez Guzmán%' OR
                    Texto like '%José Manuel Carrera Panizzo%' OR

                    Titulo like '%Marco Antonio De la Peña Sánchez%' OR
                    Titulo like '%Carlos Rafael Murrieta Cummings%' OR
                    Titulo like '%Carlos Rafael Murrieta%' OR
                    Titulo like '%Arturo Francisco Henríquez Autrey%' OR
                    Titulo like '%Arturo Francisco Henríquez%' OR
                    Titulo like '%Víctor Díaz Solís%' OR
                    Titulo like '%Mario Alberto Beauregard Álvarez%' OR
                    Titulo like '%Mario Alberto Beauregard%' OR
                    Titulo like '%José Luis Luna Cárdenas%' OR
                    Titulo like '%Gustavo Hernández García%' OR
                    Titulo like '%Miguel Tame Domínguez%' OR
                    Titulo like '%Alejandro Martínez Sibaja%' OR
                    Titulo like '%Manuel Sánchez Guzmán%' OR
                    Titulo like '%José Manuel Carrera Panizzo%' OR

                    Encabezado like '%Marco Antonio De la Peña Sánchez%' OR
                    Encabezado like '%Carlos Rafael Murrieta Cummings%' OR
                    Encabezado like '%Carlos Rafael Murrieta%' OR
                    Encabezado like '%Arturo Francisco Henríquez Autrey%' OR
                    Encabezado like '%Arturo Francisco Henríquez%' OR
                    Encabezado like '%Víctor Díaz Solís%' OR
                    Encabezado like '%Mario Alberto Beauregard Álvarez%' OR
                    Encabezado like '%Mario Alberto Beauregard%' OR
                    Encabezado like '%José Luis Luna Cárdenas%' OR
                    Encabezado like '%Gustavo Hernández García%' OR
                    Encabezado like '%Miguel Tame Domínguez%' OR
                    Encabezado like '%Alejandro Martínez Sibaja%' OR
                    Encabezado like '%Manuel Sánchez Guzmán%' OR
                    Encabezado like '%José Manuel Carrera Panizzo%' OR

                    PieFoto like '%Marco Antonio De la Peña Sánchez%' OR
                    PieFoto like '%Carlos Rafael Murrieta Cummings%' OR
                    PieFoto like '%Carlos Rafael Murrieta%' OR
                    PieFoto like '%Arturo Francisco Henríquez Autrey%' OR
                    PieFoto like '%Arturo Francisco Henríquez%' OR
                    PieFoto like '%Víctor Díaz Solís%' OR
                    PieFoto like '%Mario Alberto Beauregard Álvarez%' OR
                    PieFoto like '%Mario Alberto Beauregard%' OR
                    PieFoto like '%José Luis Luna Cárdenas%' OR
                    PieFoto like '%Gustavo Hernández García%' OR
                    PieFoto like '%Miguel Tame Domínguez%' OR
                    PieFoto like '%Alejandro Martínez Sibaja%' OR
                    PieFoto like '%Manuel Sánchez Guzmán%' OR
                    PieFoto like '%José Manuel Carrera Panizzo%' OR

                    Autor like '%Marco Antonio De la Peña Sánchez%' OR
                    Autor like '%Carlos Rafael Murrieta Cummings%' OR
                    Autor like '%Carlos Rafael Murrieta%' OR
                    Autor like '%Arturo Francisco Henríquez Autrey%' OR
                    Autor like '%Arturo Francisco Henríquez%' OR
                    Autor like '%Víctor Díaz Solís%' OR
                    Autor like '%Mario Alberto Beauregard Álvarez%' OR
                    Autor like '%Mario Alberto Beauregard%' OR
                    Autor like '%José Luis Luna Cárdenas%' OR
                    Autor like '%Gustavo Hernández García%' OR
                    Autor like '%Miguel Tame Domínguez%' OR
                    Autor like '%Alejandro Martínez Sibaja%' OR
                    Autor like '%Manuel Sánchez Guzmán%' OR
                    Autor like '%José Manuel Carrera Panizzo%'
            )
                    ORDER BY o.posicion";
            return $query;  
            break; //Admon. Central 
        case 7:// Rerforma Energética
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
                    fecha =DATE('$fecha') AND  (
                    Texto      like '%reforma energetica%' OR
                    Titulo     like '%reforma energetica%' OR
                    Encabezado like '%reforma energetica%' OR
                    PieFoto    like '%reforma energetica%' OR
                    Autor      like '%reforma energetica%'
                    )   
                   ORDER BY o.posicion";
            return $query; //Rerforma Energética     
        case 8://Instalaciones
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
                    fecha =DATE('$fecha') AND  (
                    Texto like '%instalaciones de pemex%' OR
                    Texto like '%instalacion de pemex%' OR
                    Texto like '%instalacion pemex%' OR
                    Texto like '%instalaciones pemex%' OR
                    Texto like '%refineria%' OR
                    Texto like '%gaseoducto%' OR
                    Texto like '%Pemex refinación%' OR

                    Titulo like '%instalaciones de pemex%' OR
                    Titulo like '%instalacion de pemex%' OR
                    Titulo like '%instalacion pemex%' OR
                    Titulo like '%instalaciones pemex%' OR
                    Titulo like '%refineria%' OR
                    Titulo like '%gaseoducto%' OR
                    Titulo like '%Pemex refinación%' OR

                    Encabezado like '%instalaciones de pemex%' OR
                    Encabezado like '%instalacion de pemex%' OR
                    Encabezado like '%instalacion pemex%' OR
                    Encabezado like '%instalaciones pemex%' OR
                    Encabezado like '%refineria%' OR
                    Encabezado like '%gaseoducto%' OR
                    Encabezado like '%Pemex refinación%' OR

                    PieFoto like '%instalaciones de pemex%' OR
                    PieFoto like '%instalacion de pemex%' OR
                    PieFoto like '%instalacion pemex%' OR
                    PieFoto like '%instalaciones pemex%' OR
                    PieFoto like '%refineria%' OR
                    PieFoto like '%gaseoducto%' OR
                    PieFoto like '%Pemex refinación%' OR

                    Autor like '%instalaciones de pemex%' OR
                    Autor like '%instalacion de pemex%' OR
                    Autor like '%instalacion pemex%' OR
                    Autor like '%instalaciones pemex%' OR
                    Autor like '%refineria%' OR
                    Autor like '%gaseoducto%' OR
                    Autor like '%Pemex refinación%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  
            break; //Instalaciones 
        case 9://Petróleo
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
                    fecha =DATE('$fecha') AND(
                        Texto      like '%petroleo%' OR
                        Titulo     like '%petroleo%' OR
                        Encabezado like '%petroleo%' OR
                        PieFoto    like '%petroleo%' OR
                        Autor      like '%petroleo%' 
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  
            break;//Petróleo 
        case 10:// GAS
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
                    fecha =DATE('$fecha') AND  (
                        Texto      like '% gas %' OR
                        Titulo     like '% gas %' OR
                        Encabezado like '% gas %' OR
                        PieFoto    like '% gas %' OR
                        Autor      like '% gas %'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 0,30";
            return $query;  
            break; // GAS
        case 11:// STPS | CONFEDERACIONES OBRERAS Y SINDICATOS PARTE 2
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
                    fecha =DATE('$fecha') AND
                    (
                        Texto like '%STPS%' OR
                        Texto like '%STPyS%' OR
                        Texto like '%secretaria del trabajo y prevision social%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%STPS%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%obrera%' OR
                        Texto like '%confederaciones obreras%' OR
                        Texto like '%manifestacion%' OR
                        Texto like '%mexicana de avicion%' OR
                        Texto like '%asociacion sindical%' OR
                        Texto like '%asociacion mexicana%' OR
                        Texto like '%instituto federal%' OR
                        Texto like '%salarios minimos%' OR
                        Texto like '%empleado%' OR
                        Texto like '%secretaria del trabajo estatal%' OR
                        Texto like '%ley laboral%' OR
                        Texto like '% SCT %' OR
                        Texto like '% SNTE %' OR
                        Texto like '% CNTE %' OR
                        Texto like '% CTM %' OR


                        Titulo like '%STPS%' OR
                        Titulo like '%STPyS%' OR
                        Titulo like '%secretaria del trabajo y prevision social%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%STPS%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%obrera%' OR
                        Titulo like '%confederaciones obreras%' OR
                        Titulo like '%manifestacion%' OR
                        Titulo like '%mexicana de avicion%' OR
                        Titulo like '%asociacion sindical%' OR
                        Titulo like '%asociacion mexicana%' OR
                        Titulo like '%instituto federal%' OR
                        Titulo like '%salarios minimos%' OR
                        Titulo like '%empleado%' OR
                        Titulo like '%secretaria del trabajo estatal%' OR
                        Titulo like '%ley laboral%' OR
                        Titulo like '% SCT %' OR
                        Titulo like '% SNTE %' OR
                        Titulo like '% CNTE %' OR
                        Titulo like '% CTM %'  OR

                        Encabezado like '%STPS%' OR
                        Encabezado like '%STPyS%' OR
                        Encabezado like '%secretaria del trabajo y prevision social%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%STPS%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%obrera%' OR
                        Encabezado like '%confederaciones obreras%' OR
                        Encabezado like '%manifestacion%' OR
                        Encabezado like '%mexicana de aviacion%' OR
                        Encabezado like '%asociacion sindical%' OR
                        Encabezado like '%asociacion mexicana%' OR
                        Encabezado like '%instituto federal%' OR
                        Encabezado like '%salarios minimos%' OR
                        Encabezado like '%empleado%' OR
                        Encabezado like '%secretaria del trabajo estatal%' OR
                        Encabezado like '%ley laboral%' OR
                        Encabezado like '% SCT %' OR
                        Encabezado like '% SNTE %' OR
                        Encabezado like '% CNTE %' OR
                        Encabezado like '% CTM %'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 30,30";
            return $query;  
            break;  //Sindicatos 2 
        case 12:// STPS | CONFEDERACIONES OBRERAS Y SINDICATOS PARTE 3
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
                    fecha =DATE('$fecha') AND
                    (
                        Texto like '%STPS%' OR
                        Texto like '%STPyS%' OR
                        Texto like '%secretaria del trabajo y prevision social%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%STPS%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%obrera%' OR
                        Texto like '%confederaciones obreras%' OR
                        Texto like '%manifestacion%' OR
                        Texto like '%mexicana de avicion%' OR
                        Texto like '%asociacion sindical%' OR
                        Texto like '%asociacion mexicana%' OR
                        Texto like '%instituto federal%' OR
                        Texto like '%salarios minimos%' OR
                        Texto like '%empleado%' OR
                        Texto like '%secretaria del trabajo estatal%' OR
                        Texto like '%ley laboral%' OR
                        Texto like '% SCT %' OR
                        Texto like '% SNTE %' OR
                        Texto like '% CNTE %' OR
                        Texto like '% CTM %' OR


                        Titulo like '%STPS%' OR
                        Titulo like '%STPyS%' OR
                        Titulo like '%secretaria del trabajo y prevision social%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%STPS%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%obrera%' OR
                        Titulo like '%confederaciones obreras%' OR
                        Titulo like '%manifestacion%' OR
                        Titulo like '%mexicana de avicion%' OR
                        Titulo like '%asociacion sindical%' OR
                        Titulo like '%asociacion mexicana%' OR
                        Titulo like '%instituto federal%' OR
                        Titulo like '%salarios minimos%' OR
                        Titulo like '%empleado%' OR
                        Titulo like '%secretaria del trabajo estatal%' OR
                        Titulo like '%ley laboral%' OR
                        Titulo like '% SCT %' OR
                        Titulo like '% SNTE %' OR
                        Titulo like '% CNTE %' OR
                        Titulo like '% CTM %'  OR

                        Encabezado like '%STPS%' OR
                        Encabezado like '%STPyS%' OR
                        Encabezado like '%secretaria del trabajo y prevision social%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%STPS%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%obrera%' OR
                        Encabezado like '%confederaciones obreras%' OR
                        Encabezado like '%manifestacion%' OR
                        Encabezado like '%mexicana de aviacion%' OR
                        Encabezado like '%asociacion sindical%' OR
                        Encabezado like '%asociacion mexicana%' OR
                        Encabezado like '%instituto federal%' OR
                        Encabezado like '%salarios minimos%' OR
                        Encabezado like '%empleado%' OR
                        Encabezado like '%secretaria del trabajo estatal%' OR
                        Encabezado like '%ley laboral%' OR
                        Encabezado like '% SCT %' OR
                        Encabezado like '% SNTE %' OR
                        Encabezado like '% CNTE %' OR
                        Encabezado like '% CTM %'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 60,30";
            return $query;  
            break;//Sindicatos 3
        case 13:// STPS | SECTOR LABORAL PARTE 1
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
                    fecha =DATE('$fecha') AND
                    (
                    Texto like '%empleo%' OR
                    Texto like '%laboral%' OR
                    Titulo like '%laboral%' OR
                    Titulo like '%empleo%' OR
                    Texto like '%salarios minimos%' OR
                    Texto like '%empleado%' OR
                    Texto like '%secretaria del trabajo estatal%' OR
                    Texto like '%ley laboral%' OR
                    Texto like '%desempleo%' OR
                    Texto like '%OCDE%' OR
                    Texto like '%horas trabajadas%' OR
                    Texto like '%OCDE%' OR
                    Texto like '%improductivos%' OR
                    Texto like '%productividad%' OR
                    Texto like '%impc%' OR
                    Texto like '%economia informal%' OR
                    Texto like '%empleo informal%' OR
                    Texto like '%reforma financiera%' OR
                    Texto like '%trabajando.com%' OR
                    Texto like '%CTM%' OR
                    Texto like '%STPS%' OR
                    Texto like '%styps%' OR
                    Texto like '%obreros%' OR
                    Texto like '%isr%' OR
                    Texto like '%imef%' OR

                    Encabezado like '%empleo%' OR
                    Titulo like '%salarios minimos%' OR
                    Titulo like '%empleado%' OR
                    Titulo like '%secretaria del trabajo estatal%' OR
                    Titulo like '%ley laboral%' OR
                    Titulo like '%desempleo%' OR
                    Titulo like '%OCDE%' OR
                    Titulo like '%horas trabajadas%' OR
                    Titulo like '%OCDE%' OR
                    Titulo like '%improductivos%' OR
                    Titulo like '%productividad%' OR
                    Titulo like '%impc%' OR
                    Titulo like '%economia informal%' OR
                    Titulo like '%empleo informal%' OR
                    Titulo like '%reforma financiera%' OR
                    Titulo like '%trabajando.com%' OR
                    Titulo like '%CTM%' OR
                    Titulo like '%STPS%' OR
                    Titulo like '%styps%' OR
                    Titulo like '%obreros%' OR
                    Titulo like '%isr%' OR
                    Titulo like '%imef%' OR


                    Encabezado like '%salarios minimos%' OR
                    Encabezado like '%empleado%' OR
                    Encabezado like '%secretaria del trabajo estatal%' OR
                    Encabezado like '%ley laboral%' OR
                    Encabezado like '%desempleo%' OR
                    Encabezado like '%OCDE%' OR
                    Encabezado like '%horas trabajadas%' OR
                    Encabezado like '%OCDE%' OR
                    Encabezado like '%improductivos%' OR
                    Encabezado like '%productividad%' OR
                    Encabezado like '%impc%' OR
                    Encabezado like '%economia informal%' OR
                    Encabezado like '%empleo informal%' OR
                    Encabezado like '%reforma financiera%' OR
                    Encabezado like '%trabajando.com%' OR
                    Encabezado like '%CTM%' OR
                    Encabezado like '%STPS%' OR
                    Encabezado like '%styps%' OR
                    Encabezado like '%obreros%' OR
                    Encabezado like '%isr%' OR
                    Encabezado like '%imef%'
                    )

                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 0,30";
            return $query;  
            break; //Labboral        
        case 14:// STPS | SECTOR LABORAL PARTE 2
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
                    fecha =DATE('$fecha') AND
                    (
                    Texto like '%empleo%' OR
                    Texto like '%laboral%' OR
                    Titulo like '%laboral%' OR
                    Titulo like '%empleo%' OR
                    Texto like '%salarios minimos%' OR
                    Texto like '%empleado%' OR
                    Texto like '%secretaria del trabajo estatal%' OR
                    Texto like '%ley laboral%' OR
                    Texto like '%desempleo%' OR
                    Texto like '%OCDE%' OR
                    Texto like '%horas trabajadas%' OR
                    Texto like '%OCDE%' OR
                    Texto like '%improductivos%' OR
                    Texto like '%productividad%' OR
                    Texto like '%impc%' OR
                    Texto like '%economia informal%' OR
                    Texto like '%empleo informal%' OR
                    Texto like '%reforma financiera%' OR
                    Texto like '%trabajando.com%' OR
                    Texto like '%CTM%' OR
                    Texto like '%STPS%' OR
                    Texto like '%styps%' OR
                    Texto like '%obreros%' OR
                    Texto like '%isr%' OR
                    Texto like '%imef%' OR

                    Encabezado like '%empleo%' OR
                    Titulo like '%salarios minimos%' OR
                    Titulo like '%empleado%' OR
                    Titulo like '%secretaria del trabajo estatal%' OR
                    Titulo like '%ley laboral%' OR
                    Titulo like '%desempleo%' OR
                    Titulo like '%OCDE%' OR
                    Titulo like '%horas trabajadas%' OR
                    Titulo like '%OCDE%' OR
                    Titulo like '%improductivos%' OR
                    Titulo like '%productividad%' OR
                    Titulo like '%impc%' OR
                    Titulo like '%economia informal%' OR
                    Titulo like '%empleo informal%' OR
                    Titulo like '%reforma financiera%' OR
                    Titulo like '%trabajando.com%' OR
                    Titulo like '%CTM%' OR
                    Titulo like '%STPS%' OR
                    Titulo like '%styps%' OR
                    Titulo like '%obreros%' OR
                    Titulo like '%isr%' OR
                    Titulo like '%imef%' OR


                    Encabezado like '%salarios minimos%' OR
                    Encabezado like '%empleado%' OR
                    Encabezado like '%secretaria del trabajo estatal%' OR
                    Encabezado like '%ley laboral%' OR
                    Encabezado like '%desempleo%' OR
                    Encabezado like '%OCDE%' OR
                    Encabezado like '%horas trabajadas%' OR
                    Encabezado like '%OCDE%' OR
                    Encabezado like '%improductivos%' OR
                    Encabezado like '%productividad%' OR
                    Encabezado like '%impc%' OR
                    Encabezado like '%economia informal%' OR
                    Encabezado like '%empleo informal%' OR
                    Encabezado like '%reforma financiera%' OR
                    Encabezado like '%trabajando.com%' OR
                    Encabezado like '%CTM%' OR
                    Encabezado like '%STPS%' OR
                    Encabezado like '%styps%' OR
                    Encabezado like '%obreros%' OR
                    Encabezado like '%isr%' OR
                    Encabezado like '%imef%'
                    )

                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 30,30";
            return $query;  
            break;//Laboral 2
        case 15:// STPS | VARIOS
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
                    fecha =DATE('$fecha') AND
                    ( Texto like '%laboral%' OR
                        Texto like '%stps%' OR
                        Texto like '%sindicatos%' OR
                        Texto like '%gordillo%' OR
                        Texto like '%Romero Deschamps%' OR
                        Texto like '%sitatyr%' OR
                        Texto like '%ley federal del trabajo%' OR
                        Texto like '%ley del trabajo%' OR
                        Texto like '%inclusion laboral%' OR
                        Texto like '%observatorio laboral%' OR
                        Texto like '%SNTE%' OR
                        Texto like '%CNTE%' OR
                        Encabezado like '%trabajo%' )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion LIMIT 0,30";
            return $query;  
            break; //Varios 1
        case 16:// STPS | VARIOS 2
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
                    fecha =DATE('$fecha') AND
                    ( Texto like '%laboral%' OR
                        Texto like '%stps%' OR
                        Texto like '%sindicatos%' OR
                        Texto like '%gordillo%' OR
                        Texto like '%Romero Deschamps%' OR
                        Texto like '%sitatyr%' OR
                        Texto like '%ley federal del trabajo%' OR
                        Texto like '%ley del trabajo%' OR
                        Texto like '%inclusion laboral%' OR
                        Texto like '%observatorio laboral%' OR
                        Texto like '%SNTE%' OR
                        Texto like '%CNTE%' OR
                        Encabezado like '%trabajo%' )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion LIMIT 0,30";
            return $query;  
            break;//Varios 3
        case 17://NAVARETE PRIDA
           $query="SELECT n.idEditorial,
             n.Periodico as 'idPeriodico',
            p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
            CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
            e.Nombre as 'Estado'
            FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
            WHERE p.idPeriodico=n.Periodico AND
            s.idSeccion=n.Seccion AND
            c.idCategoria=n.Categoria AND
            p.Estado!=9 AND   
            p.estado=e.idEstado AND
            n.Activo=1 AND 
            n.Categoria!=80 AND
            fecha =DATE('$fecha') AND
            (
            Texto like '%Secretario Del Trabajo%' OR
                    Texto like '%Secretario De Trabajo%' OR
                    Texto like '%titular de la STPS%' OR
                    Texto like '%titular de la secretaria del trabajo y prevision social%' OR
                    Texto like '%Alfonso Navarrete Prida%' OR  
                    Texto like 'Alfonso Navarrete Prida' OR
                    Texto like '%Alfonso Navarrete%' OR    
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%varrete Prida%' OR
                    Texto like '%varretePrida%' OR
                    Texto like '%NavarretePrida%' OR
                    Texto like '%varrete P rid%' OR
                    Texto like '%varrete P rid a%' OR

                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Alfonso Navarrete%' OR
                    Titulo like 'Alfonso Navarrete Prida'  OR 
                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Navarrete Prida%' OR
                    Titulo like '%titular de la STPS%' OR
                    Titulo like '%varrete Prida%' OR
                    Titulo like '%varretePrida%' OR
                    Titulo like '%varrete P rid%' OR
                    Titulo like '%varrete P rid a%' OR

                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Alfonso Navarrete%' OR
                    Encabezado like 'Alfonso Navarrete Prida'  OR 
                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Secretario Del Trabajo%' OR
                    encabezado like '%Secretario Del Trabajo%' OR
                    Encabezado like '%Navarrete Prida%' OR
                    Encabezado like '%titular de la STPS%' OR
                    Encabezado like '%varrete Prida%' OR
                    Encabezado like '%varretePrida%' OR
                    Encabezado like '%varrete P rid%' OR
                    Encabezado like '%varrete P rid a%'
                   )AND (
                        ( (Texto like '%Alfonso%' AND Texto like '%Prida%') OR
                          (Texto like '%Secretario Del Trabajo%') OR
                          (Texto like '%Secretario De Trabajo%') OR
                          (Texto like '%Alfonso%' AND Texto like '%Navarrete%') OR 
                           Texto like '%titular de la STPS%') OR
                        ( (Titulo like '%Alfonso%' AND Titulo like '%Prida%') OR (Titulo like '%Alfonso%' AND Titulo like '%Navarrete%') OR Titulo like '%titular de la STPS%') OR
                        ( (Encabezado like '%Alfonso%' AND Encabezado like '%Prida%') OR (Encabezado like '%Alfonso%' AND Encabezado like '%Navarrete%') OR Encabezado like '%titular de la STPS%'))
GROUP BY p.Nombre,n.PaginaPeriodico
ORDER BY p.Estado,p.Nombre
LIMIT 0,20";
            return $query;      
        break;//Navarrete Estados
        case 18://NAVARETE PRIDA
           $query="SELECT n.idEditorial,
             n.Periodico as 'idPeriodico',
            p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
            CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
            e.Nombre as 'Estado'
            FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
            WHERE p.idPeriodico=n.Periodico AND
            s.idSeccion=n.Seccion AND
            c.idCategoria=n.Categoria AND
            p.Estado!=9 AND   
            p.estado=e.idEstado AND
            n.Activo=1 AND
            n.Categoria!=80 AND
            fecha =DATE('$fecha') AND
            (
            Texto like '%Secretario Del Trabajo%' OR
                    Texto like '%Secretario De Trabajo%' OR
                    Texto like '%titular de la STPS%' OR
                    Texto like '%titular de la secretaria del trabajo y prevision social%' OR
                    Texto like '%Alfonso Navarrete Prida%' OR  
                    Texto like 'Alfonso Navarrete Prida' OR
                    Texto like '%Alfonso Navarrete%' OR    
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%varrete Prida%' OR
                    Texto like '%varretePrida%' OR
                    Texto like '%NavarretePrida%' OR
                    Texto like '%varrete P rid%' OR
                    Texto like '%varrete P rid a%' OR

                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Alfonso Navarrete%' OR
                    Titulo like 'Alfonso Navarrete Prida'  OR 
                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Navarrete Prida%' OR
                    Titulo like '%titular de la STPS%' OR
                    Titulo like '%varrete Prida%' OR
                    Titulo like '%varretePrida%' OR
                    Titulo like '%varrete P rid%' OR
                    Titulo like '%varrete P rid a%' OR

                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Alfonso Navarrete%' OR
                    Encabezado like 'Alfonso Navarrete Prida'  OR 
                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Secretario Del Trabajo%' OR
                    encabezado like '%Secretario Del Trabajo%' OR
                    Encabezado like '%Navarrete Prida%' OR
                    Encabezado like '%titular de la STPS%' OR
                    Encabezado like '%varrete Prida%' OR
                    Encabezado like '%varretePrida%' OR
                    Encabezado like '%varrete P rid%' OR
                    Encabezado like '%varrete P rid a%'
                   )AND (
                        ( (Texto like '%Alfonso%' AND Texto like '%Prida%') OR
                          (Texto like '%Secretario Del Trabajo%') OR
                          (Texto like '%Secretario De Trabajo%') OR
                          (Texto like '%Alfonso%' AND Texto like '%Navarrete%') OR 
                           Texto like '%titular de la STPS%') OR
                        ( (Titulo like '%Alfonso%' AND Titulo like '%Prida%') OR (Titulo like '%Alfonso%' AND Titulo like '%Navarrete%') OR Titulo like '%titular de la STPS%') OR
                        ( (Encabezado like '%Alfonso%' AND Encabezado like '%Prida%') OR (Encabezado like '%Alfonso%' AND Encabezado like '%Navarrete%') OR Encabezado like '%titular de la STPS%'))
GROUP BY p.Nombre,n.PaginaPeriodico
ORDER BY p.Estado,p.Nombre
LIMIT 20,20";
            return $query;      
        break;//Navarrete Estados 2
        default:
            break;
    }
}
?>
