<?php
function query($op, $Tabla)
{
    $fecha        = $Tabla;
    $FechaCliente = strtotime($Tabla);

    $fecha_actual1 = date('Y-m-d');
    $fecha_actual  = strtotime($fecha_actual1);

    if ($fecha == date('Y-m-d')) {
        $Tabla = "noticiasDia";
    } else {
        $Tabla = "noticiasSemana";
    }
    switch ($op) {

    /*****************DF*********************/
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
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
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
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico ";
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
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY o.posicion
                    ";
        return $query;
        break;

    /*************** Queretaro ********************/

    case 5: // PRIMERAS PLANAS SONORA
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
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s, categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    e.idEstado = 22 AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(3) AND
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.Periodico,n.NumeroPagina
                    ";
        return $query;
        break;

    case 6: // COLUMNAS DE OPINION SONORA
        $query =
        "SELECT DISTINCT(n.idEditorial),
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
              CONCAT('/var/www/Sistema-de-Captura//Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
              CONCAT('/var/www/Sistema-de-Captura//Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
              n.Categoria as 'Num.Categoria',
              n.NumeroPagina,
              n.Fecha,
              n.Hora,
              n.Encabezado,
              n.Foto,
              n.PieFoto
          FROM
            noticiasDia n,
            periodicos p,
            seccionesPeriodicos s,
            categoriasPeriodicos c,
            estados e
          WHERE
            p.idPeriodico=n.Periodico AND
            s.idSeccion=n.Seccion AND
            c.idCategoria=n.Categoria AND
            c.idCategoria in(1) AND
            e.idEstado=p.Estado AND
            e.idEstado=26 AND
            n.Fecha=CURDATE()
            GROUP BY n.Periodico,n.NumeroPagina";

        return $query;
        break;

    case 7: // CARTONES DE SONORA :)
        $query = "SELECT DISTINCT(n.idEditorial) , p.Nombre, n.idEditorial,n.Periodico as 'idPeriodico',
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
                    fecha =DATE('$fecha')
                    GROUP BY n.Periodico,n.NumeroPagina";

        return $query;
        break;

    /***************Querys de Tablero******************/

    case 8: //      SECRETARIO
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
                   p.estado = 9 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
        Texto like'%Salvador Cienfuegos Zepeda%' OR
        Texto like'%Salvador Cienfuegos%' OR
        Texto like '%Cienfuegos Zepeda%' OR
        Texto like '%secretario de la defensa nacional%' OR
        
        Titulo like'%Salvador Cienfuegos Zepeda%' OR
        Titulo like'%Salvador Cienfuegos%' OR
        Titulo like '%Cienfuegos Zepeda%' OR
        Titulo like '%secretario de la defensa nacional%' OR
        
        Encabezado like '%Salvador Cienfuegos Zepeda%' OR
        Encabezado like'%Salvador Cienfuegos%' OR
        Encabezado like '%Cienfuegos Zepeda%' OR
        Encabezado like '%secretario de la defensa nacional%' OR

        PieFoto like '%Salvador Cienfuegos Zepeda%' OR
        PieFoto like'%Salvador Cienfuegos%' OR
        PieFoto like '%Cienfuegos Zepeda%' OR
        PieFoto like '%secretario de la defensa nacional%' OR

        Autor like '%Salvador Cienfuegos Zepeda%' OR
        Autor like'%Salvador Cienfuegos%' OR
        Autor like '%Cienfuegos Zepeda%' OR
        Autor like '%secretario de la defensa nacional%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;

    case 9: // ADMINISTRACION CENTRAL
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
        Texto like '%Noe Sandoval Alcazar%' OR
        Texto like '%Noe Sandoval%' OR
        Texto like '%gilberto hernandez andreu%' OR
        Texto like '%gilberto hernandez%' OR
        Texto like '%Daniel velasco ramirez%' OR
        Texto like '%Daniel velasco%' OR
        Texto like '%roble arturo granados gallardo%' OR
        Texto like '%roble granados gallardo%' OR
        Texto like '%roble arturo granados%' OR
        Texto like '%roble granados%' OR
        Texto like '%luis cresencio sandoval gonzalez%' OR
        Texto like '%luis sandoval gonzalez%' OR
        Texto like '%luis cresencio sandoval%' OR
        Texto like '%sandoval gonzalez%' OR
        Texto like '%david cordova campos%' OR
        Texto like '%david cordova%' OR
        Texto like '%angel prior valencia%' OR
        Texto like '%prior valencia%' OR
        Texto like '%juan manuel rico gamez%' OR
        Texto like '%juan rico gamez%' OR
        Texto like '%juan manuel rico%' OR
        Texto like '%carlos antonio rodriguez munguia%' OR
        Texto like '%carlos rodriguez munguia%' OR
        Texto like '%victor manuel ruesga ramirez%' OR
        Texto like '%victor ruesga ramirez%' OR
        Texto like '%horacio ornelas garcia%' OR
        Texto like '%horacio ornelas%' OR
        Texto like '%marco antonio zaragoza vazquez%' OR
        Texto like '%marco zaragoza vazquez%' OR

        Titulo like '%Noe Sandoval Alcazar%' OR
        Titulo like '%Noe Sandoval%' OR
        Titulo like '%gilberto hernandez andreu%' OR
        Titulo like '%gilberto hernandez%' OR
        Titulo like '%Daniel velasco ramirez%' OR
        Titulo like '%Daniel velasco%' OR
        Titulo like '%roble arturo granados gallardo%' OR
        Titulo like '%roble granados gallardo%' OR
        Titulo like '%roble arturo granados%' OR
        Titulo like '%roble granados%' OR
        Titulo like '%luis cresencio sandoval gonzalez%' OR
        Titulo like '%luis sandoval gonzalez%' OR
        Titulo like '%luis cresencio sandoval%' OR
        Titulo like '%sandoval gonzalez%' OR
        Titulo like '%david cordova campos%' OR
        Titulo like '%david cordova%' OR
        Titulo like '%angel prior valencia%' OR
        Titulo like '%prior valencia%' OR
        Titulo like '%juan manuel rico gamez%' OR
        Titulo like '%juan rico gamez%' OR
        Titulo like '%juan manuel rico%' OR
        Titulo like '%carlos antonio rodriguez munguia%' OR
        Titulo like '%carlos rodriguez munguia%' OR
        Titulo like '%victor manuel ruesga ramirez%' OR
        Titulo like '%victor ruesga ramirez%' OR
        Titulo like '%horacio ornelas garcia%' OR
        Titulo like '%horacio ornelas%' OR
        Titulo like '%marco antonio zaragoza vazquez%' OR
        Titulo like '%marco zaragoza vazquez%' OR

        Encabezado like '%Noe Sandoval Alcazar%' OR
        Encabezado like '%Noe Sandoval%' OR
        Encabezado like '%gilberto hernandez andreu%' OR
        Encabezado like '%gilberto hernandez%' OR
        Encabezado like '%Daniel velasco ramirez%' OR
        Encabezado like '%Daniel velasco%' OR
        Encabezado like '%roble arturo granados gallardo%' OR
        Encabezado like '%roble granados gallardo%' OR
        Encabezado like '%roble arturo granados%' OR
        Encabezado like '%roble granados%' OR
        Encabezado like '%luis cresencio sandoval gonzalez%' OR
        Encabezado like '%luis sandoval gonzalez%' OR
        Encabezado like '%luis cresencio sandoval%' OR
        Encabezado like '%sandoval gonzalez%' OR
        Encabezado like '%david cordova campos%' OR
        Encabezado like '%david cordova%' OR
        Encabezado like '%angel prior valencia%' OR
        Encabezado like '%prior valencia%' OR
        Encabezado like '%juan manuel rico gamez%' OR
        Encabezado like '%juan rico gamez%' OR
        Encabezado like '%juan manuel rico%' OR
        Encabezado like '%carlos antonio rodriguez munguia%' OR
        Encabezado like '%carlos rodriguez munguia%' OR
        Encabezado like '%victor manuel ruesga ramirez%' OR
        Encabezado like '%victor ruesga ramirez%' OR
        Encabezado like '%horacio ornelas garcia%' OR
        Encabezado like '%horacio ornelas%' OR
        Encabezado like '%marco antonio zaragoza vazquez%' OR
        Encabezado like '%marco zaragoza vazquez%' OR

        PieFoto like '%Noe Sandoval Alcazar%' OR
        PieFoto like '%Noe Sandoval%' OR
        PieFoto like '%gilberto hernandez andreu%' OR
        PieFoto like '%gilberto hernandez%' OR
        PieFoto like '%Daniel velasco ramirez%' OR
        PieFoto like '%Daniel velasco%' OR
        PieFoto like '%roble arturo granados gallardo%' OR
        PieFoto like '%roble granados gallardo%' OR
        PieFoto like '%roble arturo granados%' OR
        PieFoto like '%roble granados%' OR
        PieFoto like '%luis cresencio sandoval gonzalez%' OR
        PieFoto like '%luis sandoval gonzalez%' OR
        PieFoto like '%luis cresencio sandoval%' OR
        PieFoto like '%sandoval gonzalez%' OR
        PieFoto like '%david cordova campos%' OR
        PieFoto like '%david cordova%' OR
        PieFoto like '%angel prior valencia%' OR
        PieFoto like '%prior valencia%' OR
        PieFoto like '%juan manuel rico gamez%' OR
        PieFoto like '%juan rico gamez%' OR
        PieFoto like '%juan manuel rico%' OR
        PieFoto like '%carlos antonio rodriguez munguia%' OR
        PieFoto like '%carlos rodriguez munguia%' OR
        PieFoto like '%victor manuel ruesga ramirez%' OR
        PieFoto like '%victor ruesga ramirez%' OR
        PieFoto like '%horacio ornelas garcia%' OR
        PieFoto like '%horacio ornelas%' OR
        PieFoto like '%marco antonio zaragoza vazquez%' OR
        PieFoto like '%marco zaragoza vazquez%' OR

        Autor like '%Noe Sandoval Alcazar%' OR
        Autor like '%Noe Sandoval%' OR
        Autor like '%gilberto hernandez andreu%' OR
        Autor like '%gilberto hernandez%' OR
        Autor like '%Daniel velasco ramirez%' OR
        Autor like '%Daniel velasco%' OR
        Autor like '%roble arturo granados gallardo%' OR
        Autor like '%roble granados gallardo%' OR
        Autor like '%roble arturo granados%' OR
        Autor like '%roble granados%' OR
        Autor like '%luis cresencio sandoval gonzalez%' OR
        Autor like '%luis sandoval gonzalez%' OR
        Autor like '%luis cresencio sandoval%' OR
        Autor like '%sandoval gonzalez%' OR
        Autor like '%david cordova campos%' OR
        Autor like '%david cordova%' OR
        Autor like '%angel prior valencia%' OR
        Autor like '%prior valencia%' OR
        Autor like '%juan manuel rico gamez%' OR
        Autor like '%juan rico gamez%' OR
        Autor like '%juan manuel rico%' OR
        Autor like '%carlos antonio rodriguez munguia%' OR
        Autor like '%carlos rodriguez munguia%' OR
        Autor like '%victor manuel ruesga ramirez%' OR
        Autor like '%victor ruesga ramirez%' OR
        Autor like '%horacio ornelas garcia%' OR
        Autor like '%horacio ornelas%' OR
        Autor like '%marco antonio zaragoza vazquez%' OR
        Autor like '%marco zaragoza vazquez%' 
    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;

    case 10: // ZONAS MILITARES
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
        Texto like'%zona militar%' OR
        Texto like'%region militar%' OR
        Texto like'%zonas militares%' OR
        Texto like'%general de Briga%' OR
        Texto like'%general de Division%' OR
        Texto like'%diplomado de Estado Mayor%' OR

        Titulo like'%zona militar%' OR
        Titulo like'%region militar%' OR
        Titulo like'%zonas militares%' OR
        Titulo like'%general de Briga%' OR
        Titulo like'%general de Division%' OR
        Titulo like'%diplomado de Estado Mayor%' OR

        Encabezado like'%zona militar%' OR
        Encabezado like'%region militar%' OR
        Encabezado like'%zonas militares%' OR
        Encabezado like'%general de Briga%' OR
        Encabezado like'%general de Division%' OR
        Encabezado like'%diplomado de Estado Mayor%' OR

        PieFoto like'%zona militar%' OR
        PieFoto like'%region militar%' OR
        PieFoto like'%zonas militares%' OR
        PieFoto like'%general de Briga%' OR
        PieFoto like'%general de Division%' OR
        PieFoto like'%diplomado de Estado Mayor%' OR

        Autor like'%zona militar%' OR
        Autor like'%region militar%' OR
        Autor like'%zonas militares%' OR
        Autor like'%general de Briga%' OR
        Autor like'%general de Division%' OR
        Autor like'%diplomado de Estado Mayor%'
    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;

    case 11: // SECRETARIO SEDENA ESTADOS
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   e.idEstado <> 9 AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
        Texto like'%Salvador Cienfuegos Zepeda%' OR
        Texto like'%Salvador Cienfuegos%' OR
        Texto like '%Cienfuegos Zepeda%' OR
        Texto like '%secretario de la defensa nacional%' OR
        
        Titulo like'%Salvador Cienfuegos Zepeda%' OR
        Titulo like'%Salvador Cienfuegos%' OR
        Titulo like '%Cienfuegos Zepeda%' OR
        Titulo like '%secretario de la defensa nacional%' OR
        
        Encabezado like '%Salvador Cienfuegos Zepeda%' OR
        Encabezado like'%Salvador Cienfuegos%' OR
        Encabezado like '%Cienfuegos Zepeda%' OR
        Encabezado like '%secretario de la defensa nacional%' OR

        PieFoto like '%Salvador Cienfuegos Zepeda%' OR
        PieFoto like'%Salvador Cienfuegos%' OR
        PieFoto like '%Cienfuegos Zepeda%' OR
        PieFoto like '%secretario de la defensa nacional%' OR

        Autor like '%Salvador Cienfuegos Zepeda%' OR
        Autor like'%Salvador Cienfuegos%' OR
        Autor like '%Cienfuegos Zepeda%' OR
        Autor like '%secretario de la defensa nacional%'
    )
                GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break;

    case 12: // Varios SEDENA
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
        Texto like '%Ejercito%' OR
        Texto like '%Militar%' OR
        Texto like '%Fuerza Aerea%' OR
        Texto like '%Defensa Nacional%' OR

        Titulo like '%Ejercito%' OR
        Titulo like '%Militar%' OR
        Titulo like '%Fuerza Aerea%' OR
        Titulo like '%Defensa Nacional%' OR

        Encabezado like '%Ejercito%' OR
        Encabezado like '%Militar%' OR
        Encabezado like '%Fuerza Aerea%' OR
        Encabezado like '%Defensa Nacional%' OR

        Autor like '%Ejercito%' OR
        Autor like '%Militar%' OR
        Autor like '%Fuerza Aerea%' OR
        Autor like '%Defensa Nacional%' OR

        PieFoto like '%Ejercito%' OR
        PieFoto like '%Militar%' OR
        PieFoto like '%Fuerza Aerea%' OR
        PieFoto like '%Defensa Nacional%'
    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
        return $query;
        break;


    case 13: // ADMINISTRACION CENTRAL ESTADOS
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado != 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Noe Sandoval Alcazar%' OR
        Texto like '%Noe Sandoval%' OR
        Texto like '%gilberto hernandez andreu%' OR
        Texto like '%gilberto hernandez%' OR
        Texto like '%Daniel velasco ramirez%' OR
        Texto like '%Daniel velasco%' OR
        Texto like '%roble arturo granados gallardo%' OR
        Texto like '%roble granados gallardo%' OR
        Texto like '%roble arturo granados%' OR
        Texto like '%roble granados%' OR
        Texto like '%luis cresencio sandoval gonzalez%' OR
        Texto like '%luis sandoval gonzalez%' OR
        Texto like '%luis cresencio sandoval%' OR
        Texto like '%sandoval gonzalez%' OR
        Texto like '%david cordova campos%' OR
        Texto like '%david cordova%' OR
        Texto like '%angel prior valencia%' OR
        Texto like '%prior valencia%' OR
        Texto like '%juan manuel rico gamez%' OR
        Texto like '%juan rico gamez%' OR
        Texto like '%juan manuel rico%' OR
        Texto like '%carlos antonio rodriguez munguia%' OR
        Texto like '%carlos rodriguez munguia%' OR
        Texto like '%victor manuel ruesga ramirez%' OR
        Texto like '%victor ruesga ramirez%' OR
        Texto like '%horacio ornelas garcia%' OR
        Texto like '%horacio ornelas%' OR
        Texto like '%marco antonio zaragoza vazquez%' OR
        Texto like '%marco zaragoza vazquez%' OR

        Titulo like '%Noe Sandoval Alcazar%' OR
        Titulo like '%Noe Sandoval%' OR
        Titulo like '%gilberto hernandez andreu%' OR
        Titulo like '%gilberto hernandez%' OR
        Titulo like '%Daniel velasco ramirez%' OR
        Titulo like '%Daniel velasco%' OR
        Titulo like '%roble arturo granados gallardo%' OR
        Titulo like '%roble granados gallardo%' OR
        Titulo like '%roble arturo granados%' OR
        Titulo like '%roble granados%' OR
        Titulo like '%luis cresencio sandoval gonzalez%' OR
        Titulo like '%luis sandoval gonzalez%' OR
        Titulo like '%luis cresencio sandoval%' OR
        Titulo like '%sandoval gonzalez%' OR
        Titulo like '%david cordova campos%' OR
        Titulo like '%david cordova%' OR
        Titulo like '%angel prior valencia%' OR
        Titulo like '%prior valencia%' OR
        Titulo like '%juan manuel rico gamez%' OR
        Titulo like '%juan rico gamez%' OR
        Titulo like '%juan manuel rico%' OR
        Titulo like '%carlos antonio rodriguez munguia%' OR
        Titulo like '%carlos rodriguez munguia%' OR
        Titulo like '%victor manuel ruesga ramirez%' OR
        Titulo like '%victor ruesga ramirez%' OR
        Titulo like '%horacio ornelas garcia%' OR
        Titulo like '%horacio ornelas%' OR
        Titulo like '%marco antonio zaragoza vazquez%' OR
        Titulo like '%marco zaragoza vazquez%' OR

        Encabezado like '%Noe Sandoval Alcazar%' OR
        Encabezado like '%Noe Sandoval%' OR
        Encabezado like '%gilberto hernandez andreu%' OR
        Encabezado like '%gilberto hernandez%' OR
        Encabezado like '%Daniel velasco ramirez%' OR
        Encabezado like '%Daniel velasco%' OR
        Encabezado like '%roble arturo granados gallardo%' OR
        Encabezado like '%roble granados gallardo%' OR
        Encabezado like '%roble arturo granados%' OR
        Encabezado like '%roble granados%' OR
        Encabezado like '%luis cresencio sandoval gonzalez%' OR
        Encabezado like '%luis sandoval gonzalez%' OR
        Encabezado like '%luis cresencio sandoval%' OR
        Encabezado like '%sandoval gonzalez%' OR
        Encabezado like '%david cordova campos%' OR
        Encabezado like '%david cordova%' OR
        Encabezado like '%angel prior valencia%' OR
        Encabezado like '%prior valencia%' OR
        Encabezado like '%juan manuel rico gamez%' OR
        Encabezado like '%juan rico gamez%' OR
        Encabezado like '%juan manuel rico%' OR
        Encabezado like '%carlos antonio rodriguez munguia%' OR
        Encabezado like '%carlos rodriguez munguia%' OR
        Encabezado like '%victor manuel ruesga ramirez%' OR
        Encabezado like '%victor ruesga ramirez%' OR
        Encabezado like '%horacio ornelas garcia%' OR
        Encabezado like '%horacio ornelas%' OR
        Encabezado like '%marco antonio zaragoza vazquez%' OR
        Encabezado like '%marco zaragoza vazquez%' OR

        PieFoto like '%Noe Sandoval Alcazar%' OR
        PieFoto like '%Noe Sandoval%' OR
        PieFoto like '%gilberto hernandez andreu%' OR
        PieFoto like '%gilberto hernandez%' OR
        PieFoto like '%Daniel velasco ramirez%' OR
        PieFoto like '%Daniel velasco%' OR
        PieFoto like '%roble arturo granados gallardo%' OR
        PieFoto like '%roble granados gallardo%' OR
        PieFoto like '%roble arturo granados%' OR
        PieFoto like '%roble granados%' OR
        PieFoto like '%luis cresencio sandoval gonzalez%' OR
        PieFoto like '%luis sandoval gonzalez%' OR
        PieFoto like '%luis cresencio sandoval%' OR
        PieFoto like '%sandoval gonzalez%' OR
        PieFoto like '%david cordova campos%' OR
        PieFoto like '%david cordova%' OR
        PieFoto like '%angel prior valencia%' OR
        PieFoto like '%prior valencia%' OR
        PieFoto like '%juan manuel rico gamez%' OR
        PieFoto like '%juan rico gamez%' OR
        PieFoto like '%juan manuel rico%' OR
        PieFoto like '%carlos antonio rodriguez munguia%' OR
        PieFoto like '%carlos rodriguez munguia%' OR
        PieFoto like '%victor manuel ruesga ramirez%' OR
        PieFoto like '%victor ruesga ramirez%' OR
        PieFoto like '%horacio ornelas garcia%' OR
        PieFoto like '%horacio ornelas%' OR
        PieFoto like '%marco antonio zaragoza vazquez%' OR
        PieFoto like '%marco zaragoza vazquez%' OR

        Autor like '%Noe Sandoval Alcazar%' OR
        Autor like '%Noe Sandoval%' OR
        Autor like '%gilberto hernandez andreu%' OR
        Autor like '%gilberto hernandez%' OR
        Autor like '%Daniel velasco ramirez%' OR
        Autor like '%Daniel velasco%' OR
        Autor like '%roble arturo granados gallardo%' OR
        Autor like '%roble granados gallardo%' OR
        Autor like '%roble arturo granados%' OR
        Autor like '%roble granados%' OR
        Autor like '%luis cresencio sandoval gonzalez%' OR
        Autor like '%luis sandoval gonzalez%' OR
        Autor like '%luis cresencio sandoval%' OR
        Autor like '%sandoval gonzalez%' OR
        Autor like '%david cordova campos%' OR
        Autor like '%david cordova%' OR
        Autor like '%angel prior valencia%' OR
        Autor like '%prior valencia%' OR
        Autor like '%juan manuel rico gamez%' OR
        Autor like '%juan rico gamez%' OR
        Autor like '%juan manuel rico%' OR
        Autor like '%carlos antonio rodriguez munguia%' OR
        Autor like '%carlos rodriguez munguia%' OR
        Autor like '%victor manuel ruesga ramirez%' OR
        Autor like '%victor ruesga ramirez%' OR
        Autor like '%horacio ornelas garcia%' OR
        Autor like '%horacio ornelas%' OR
        Autor like '%marco antonio zaragoza vazquez%' OR
        Autor like '%marco zaragoza vazquez%' 
                    )
                GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break;

    case 14: // ZONAS MILITARES ESTADOS
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado != 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like'%zona militar%' OR
        Texto like'%region militar%' OR
        Texto like'%zonas militares%' OR
        Texto like'%general de Briga%' OR
        Texto like'%general de Division%' OR
        Texto like'%diplomado de Estado Mayor%' OR

        Titulo like'%zona militar%' OR
        Titulo like'%region militar%' OR
        Titulo like'%zonas militares%' OR
        Titulo like'%general de Briga%' OR
        Titulo like'%general de Division%' OR
        Titulo like'%diplomado de Estado Mayor%' OR

        Encabezado like'%zona militar%' OR
        Encabezado like'%region militar%' OR
        Encabezado like'%zonas militares%' OR
        Encabezado like'%general de Briga%' OR
        Encabezado like'%general de Division%' OR
        Encabezado like'%diplomado de Estado Mayor%' OR

        PieFoto like'%zona militar%' OR
        PieFoto like'%region militar%' OR
        PieFoto like'%zonas militares%' OR
        PieFoto like'%general de Briga%' OR
        PieFoto like'%general de Division%' OR
        PieFoto like'%diplomado de Estado Mayor%' OR

        Autor like'%zona militar%' OR
        Autor like'%region militar%' OR
        Autor like'%zonas militares%' OR
        Autor like'%general de Briga%' OR
        Autor like'%general de Division%' OR
        Autor like'%diplomado de Estado Mayor%'
    )
                GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break;

    case 15: // VARIOS SEDENA
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado != 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%Ejercito%' OR
        Texto like '%Militar%' OR
        Texto like '%Fuerza Aerea%' OR
        Texto like '%Defensa Nacional%' OR

        Titulo like '%Ejercito%' OR
        Titulo like '%Militar%' OR
        Titulo like '%Fuerza Aerea%' OR
        Titulo like '%Defensa Nacional%' OR

        Encabezado like '%Ejercito%' OR
        Encabezado like '%Militar%' OR
        Encabezado like '%Fuerza Aerea%' OR
        Encabezado like '%Defensa Nacional%' OR

        Autor like '%Ejercito%' OR
        Autor like '%Militar%' OR
        Autor like '%Fuerza Aerea%' OR
        Autor like '%Defensa Nacional%' OR

        PieFoto like '%Ejercito%' OR
        PieFoto like '%Militar%' OR
        PieFoto like '%Fuerza Aerea%' OR
        PieFoto like '%Defensa Nacional%'
    )
                GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break;

    case 16: //Dependencias
        $query = "SELECT 
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
    $Tabla n
        JOIN
    periodicos p ON p.idPeriodico = n.Periodico
        AND n.Activo = 1
        AND n.Fecha =DATE('$fecha')
        JOIN
    seccionesPeriodicos s ON s.idSeccion = n.Seccion
        JOIN
    categoriasPeriodicos c ON c.idCategoria = n.Categoria
        AND n.Categoria NOT IN (80,98)
        JOIN
    estados e ON p.estado = e.idEstado
        AND p.Estado != 9           
WHERE
    (Texto LIKE '%comunicacion social del estado de Queretaro%'
        OR Texto LIKE '%comunicacion social de Queretaro%'
        OR Texto LIKE '%comunicacion social  Queretaro%'
        OR Texto LIKE '%Abel Ernesto Magaña Alvarez%'
        OR Titulo LIKE '%comunicacion social del estado de Queretaro%'
        OR Titulo LIKE '%comunicacion social de Queretaro%'
        OR Titulo LIKE '%comunicacion social Queretaro%'
        OR Titulo LIKE '%Abel Ernesto Magaña Alvarez%'
        OR Encabezado LIKE '%comunicacion social del estado de Queretaro%'
        OR Encabezado LIKE '%comunicacion social de Queretaro%'
        OR Encabezado LIKE '%comunicacion social Queretaro%'
        OR Encabezado LIKE '%Abel Ernesto Magaña Alvarez%'
        OR PieFoto LIKE '%comunicacion social del estado de Queretaro%'
        OR PieFoto LIKE '%comunicacion social de Queretaro%'
        OR PieFoto LIKE '%comunicacion social Queretaro%'
        OR PieFoto LIKE '%Abel Ernesto Magaña Alvarez%'
        OR Autor LIKE '%comunicacion social del estado de Queretaro%'
        OR Autor LIKE '%comunicacion social de Queretaro%'
        OR Autor LIKE '%comunicacion social Queretaro%'
        OR Autor LIKE '%Abel Ernesto Magaña Alvarez%')
        OR (Texto LIKE '%Despacho del C. Gobernador del estado de Queretaro%'
        OR Texto LIKE '%Despacho del C. Gobernador de Queretaro%'
        OR Texto LIKE '%Despacho del C. Gobernador  Queretaro%'
        OR Texto LIKE '%Rocio Del Carmen Ramirez Cerrillo%'
        OR Titulo LIKE '%Despacho del C. Gobernador del estado de Queretaro%'
        OR Titulo LIKE '%Despacho del C. Gobernador de Queretaro%'
        OR Titulo LIKE '%Despacho del C. Gobernador Queretaro%'
        OR Titulo LIKE '%Rocio Del Carmen Ramirez Cerrillo%'
        OR Encabezado LIKE '%Despacho del C. Gobernador del estado de Queretaro%'
        OR Encabezado LIKE '%Despacho del C. Gobernador de Queretaro%'
        OR Encabezado LIKE '%Despacho del C. Gobernador Queretaro%'
        OR Encabezado LIKE '%Rocio Del Carmen Ramirez Cerrillo%'
        OR PieFoto LIKE '%Despacho del C. Gobernador del estado de Queretaro%'
        OR PieFoto LIKE '%Despacho del C. Gobernador de Queretaro%'
        OR PieFoto LIKE '%Despacho del C. Gobernador Queretaro%'
        OR PieFoto LIKE '%Rocio Del Carmen Ramirez Cerrillo%'
        OR Autor LIKE '%Despacho del C. Gobernador del estado de Queretaro%'
        OR Autor LIKE '%Despacho del C. Gobernador de Queretaro%'
        OR Autor LIKE '%Despacho del C. Gobernador Queretaro%'
        OR Autor LIKE '%Rocio Del Carmen Ramirez Cerrillo%')
        OR (Texto LIKE '%Oficialia Mayor del estado de Queretaro%'
        OR Texto LIKE '%Oficialia Mayor de Queretaro%'
        OR Texto LIKE '%Oficialia Mayor  Queretaro%'
        OR Texto LIKE '%Miguel Angel Salinas Bautista%'
        OR Titulo LIKE '%Oficialia Mayor del estado de Queretaro%'
        OR Titulo LIKE '%Oficialia Mayor de Queretaro%'
        OR Titulo LIKE '%Oficialia Mayor Queretaro%'
        OR Titulo LIKE '%Miguel Angel Salinas Bautista%'
        OR Encabezado LIKE '%Oficialia Mayor del estado de Queretaro%'
        OR Encabezado LIKE '%Oficialia Mayor de Queretaro%'
        OR Encabezado LIKE '%Oficialia Mayor Queretaro%'
        OR Encabezado LIKE '%Miguel Angel Salinas Bautista%'
        OR PieFoto LIKE '%Oficialia Mayor del estado de Queretaro%'
        OR PieFoto LIKE '%Oficialia Mayor de Queretaro%'
        OR PieFoto LIKE '%Oficialia Mayor Queretaro%'
        OR PieFoto LIKE '%Miguel Angel Salinas Bautista%'
        OR Autor LIKE '%Oficialia Mayor del estado de Queretaro%'
        OR Autor LIKE '%Oficialia Mayor de Queretaro%'
        OR Autor LIKE '%Oficialia Mayor Queretaro%'
        OR Autor LIKE '%Miguel Angel Salinas Bautista%')
        OR (Texto LIKE '%Procuraduria General de Justicia del estado de Queretaro%'
        OR Texto LIKE '%Procuraduria General de Justicia de Queretaro%'
        OR Texto LIKE '%Procuraduria General de Justicia  Queretaro%'
        OR Texto LIKE '%Arsenio Duran Becerra%'
        OR Titulo LIKE '%Procuraduria General de Justicia del estado de Queretaro%'
        OR Titulo LIKE '%Procuraduria General de Justicia de Queretaro%'
        OR Titulo LIKE '%Procuraduria General de Justicia Queretaro%'
        OR Titulo LIKE '%Arsenio Duran Becerra%'
        OR Encabezado LIKE '%Procuraduria General de Justicia del estado de Queretaro%'
        OR Encabezado LIKE '%Procuraduria General de Justicia de Queretaro%'
        OR Encabezado LIKE '%Procuraduria General de Justicia Queretaro%'
        OR Encabezado LIKE '%Arsenio Duran Becerra%'
        OR PieFoto LIKE '%Procuraduria General de Justicia del estado de Queretaro%'
        OR PieFoto LIKE '%Procuraduria General de Justicia de Queretaro%'
        OR PieFoto LIKE '%Procuraduria General de Justicia Queretaro%'
        OR PieFoto LIKE '%Arsenio Duran Becerra%'
        OR Autor LIKE '%Procuraduria General de Justicia del estado de Queretaro%'
        OR Autor LIKE '%Procuraduria General de Justicia de Queretaro%'
        OR Autor LIKE '%Procuraduria General de Justicia Queretaro%'
        OR Autor LIKE '%Arsenio Duran Becerra%')
        OR (Texto LIKE '%Secretaria de Desarrollo Agropecuario del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Desarrollo Agropecuario de Queretaro%'
        OR Texto LIKE '%Secretaria de Desarrollo Agropecuario  Queretaro%'
        OR Texto LIKE '%Manuel Valdes Rodriguez%'
        OR Titulo LIKE '%Secretaria de Desarrollo Agropecuario del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Desarrollo Agropecuario de Queretaro%'
        OR Titulo LIKE '%Secretaria de Desarrollo Agropecuario Queretaro%'
        OR Titulo LIKE '%Manuel Valdes Rodriguez%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Agropecuario del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Agropecuario de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Agropecuario Queretaro%'
        OR Encabezado LIKE '%Manuel Valdes Rodriguez%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Agropecuario del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Agropecuario de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Agropecuario Queretaro%'
        OR PieFoto LIKE '%Manuel Valdes Rodriguez%'
        OR Autor LIKE '%Secretaria de Desarrollo Agropecuario del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Desarrollo Agropecuario de Queretaro%'
        OR Autor LIKE '%Secretaria de Desarrollo Agropecuario Queretaro%'
        OR Autor LIKE '%Manuel Valdes Rodriguez%')
        OR (Texto LIKE '%Secretaria de Desarrollo Sustentable del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Desarrollo Sustentable de Queretaro%'
        OR Texto LIKE '%Secretaria de Desarrollo Sustentable  Queretaro%'
        OR Texto LIKE '%Francisco Javier Ramirez Morales%'
        OR Titulo LIKE '%Secretaria de Desarrollo Sustentable del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Desarrollo Sustentable de Queretaro%'
        OR Titulo LIKE '%Secretaria de Desarrollo Sustentable Queretaro%'
        OR Titulo LIKE '%Francisco Javier Ramirez Morales%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Sustentable del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Sustentable de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Sustentable Queretaro%'
        OR Encabezado LIKE '%Francisco Javier Ramirez Morales%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Sustentable del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Sustentable de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Sustentable Queretaro%'
        OR PieFoto LIKE '%Francisco Javier Ramirez Morales%'
        OR Autor LIKE '%Secretaria de Desarrollo Sustentable del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Desarrollo Sustentable de Queretaro%'
        OR Autor LIKE '%Secretaria de Desarrollo Sustentable Queretaro%'
        OR Autor LIKE '%Francisco Javier Ramirez Morales%')
        OR (Texto LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas de Queretaro%'
        OR Texto LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas  Queretaro%'
        OR Texto LIKE '%Jose Pio X Salgado Tovar%'
        OR Titulo LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas de Queretaro%'
        OR Titulo LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas Queretaro%'
        OR Titulo LIKE '%Jose Pio X Salgado Tovar%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas Queretaro%'
        OR Encabezado LIKE '%Jose Pio X Salgado Tovar%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas Queretaro%'
        OR PieFoto LIKE '%Jose Pio X Salgado Tovar%'
        OR Autor LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas de Queretaro%'
        OR Autor LIKE '%Secretaria de Desarrollo Urbano y Obras Publicas Queretaro%'
        OR Autor LIKE '%Jose Pio X Salgado Tovar%')
        OR (Texto LIKE '%Secretaria de Educacion del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Educacion de Queretaro%'
        OR Texto LIKE '%Secretaria de Educacion  Queretaro%'
        OR Texto LIKE '%Fernando De la Isla Herrera%'
        OR Titulo LIKE '%Secretaria de Educacion del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Educacion de Queretaro%'
        OR Titulo LIKE '%Secretaria de Educacion Queretaro%'
        OR Titulo LIKE '%Fernando De la Isla Herrera%'
        OR Encabezado LIKE '%Secretaria de Educacion del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Educacion de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Educacion Queretaro%'
        OR Encabezado LIKE '%Fernando De la Isla Herrera%'
        OR PieFoto LIKE '%Secretaria de Educacion del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Educacion de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Educacion Queretaro%'
        OR PieFoto LIKE '%Fernando De la Isla Herrera%'
        OR Autor LIKE '%Secretaria de Educacion del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Educacion de Queretaro%'
        OR Autor LIKE '%Secretaria de Educacion Queretaro%'
        OR Autor LIKE '%Fernando De la Isla Herrera%')
        OR (Texto LIKE '%Secretaria de Gobierno del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Gobierno de Queretaro%'
        OR Texto LIKE '%Secretaria de Gobierno  Queretaro%'
        OR Texto LIKE '%Jose Maria Manriquez Huerta%'
        OR Titulo LIKE '%Secretaria de Gobierno del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Gobierno de Queretaro%'
        OR Titulo LIKE '%Secretaria de Gobierno Queretaro%'
        OR Titulo LIKE '%Jose Maria Manriquez Huerta%'
        OR Encabezado LIKE '%Secretaria de Gobierno del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Gobierno de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Gobierno Queretaro%'
        OR Encabezado LIKE '%Jose Maria Manriquez Huerta%'
        OR PieFoto LIKE '%Secretaria de Gobierno del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Gobierno de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Gobierno Queretaro%'
        OR PieFoto LIKE '%Jose Maria Manriquez Huerta%'
        OR Autor LIKE '%Secretaria de Gobierno del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Gobierno de Queretaro%'
        OR Autor LIKE '%Secretaria de Gobierno Queretaro%'
        OR Autor LIKE '%Jose Maria Manriquez Huerta%')
        OR (Texto LIKE '%Contraloria del estado de Queretaro%'
        OR Texto LIKE '%Contraloria de Queretaro%'
        OR Texto LIKE '%Contraloria  Queretaro%'
        OR Texto LIKE '%Juan Gorraez Enrile%'
        OR Titulo LIKE '%Contraloria del estado de Queretaro%'
        OR Titulo LIKE '%Contraloria de Queretaro%'
        OR Titulo LIKE '%Contraloria Queretaro%'
        OR Titulo LIKE '%Juan Gorraez Enrile%'
        OR Encabezado LIKE '%Contraloria del estado de Queretaro%'
        OR Encabezado LIKE '%Contraloria de Queretaro%'
        OR Encabezado LIKE '%Contraloria Queretaro%'
        OR Encabezado LIKE '%Juan Gorraez Enrile%'
        OR PieFoto LIKE '%Contraloria del estado de Queretaro%'
        OR PieFoto LIKE '%Contraloria de Queretaro%'
        OR PieFoto LIKE '%Contraloria Queretaro%'
        OR PieFoto LIKE '%Juan Gorraez Enrile%'
        OR Autor LIKE '%Contraloria del estado de Queretaro%'
        OR Autor LIKE '%Contraloria de Queretaro%'
        OR Autor LIKE '%Contraloria Queretaro%'
        OR Autor LIKE '%Juan Gorraez Enrile%')
        OR (Texto LIKE '%Secretaria de la Juventud del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de la Juventud de Queretaro%'
        OR Texto LIKE '%Secretaria de la Juventud  Queretaro%'
        OR Texto LIKE '%Norma Guadalupe Martinez Castañeda%'
        OR Titulo LIKE '%Secretaria de la Juventud del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de la Juventud de Queretaro%'
        OR Titulo LIKE '%Secretaria de la Juventud Queretaro%'
        OR Titulo LIKE '%Norma Guadalupe Martinez Castañeda%'
        OR Encabezado LIKE '%Secretaria de la Juventud del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de la Juventud de Queretaro%'
        OR Encabezado LIKE '%Secretaria de la Juventud Queretaro%'
        OR Encabezado LIKE '%Norma Guadalupe Martinez Castañeda%'
        OR PieFoto LIKE '%Secretaria de la Juventud del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de la Juventud de Queretaro%'
        OR PieFoto LIKE '%Secretaria de la Juventud Queretaro%'
        OR PieFoto LIKE '%Norma Guadalupe Martinez Castañeda%'
        OR Autor LIKE '%Secretaria de la Juventud del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de la Juventud de Queretaro%'
        OR Autor LIKE '%Secretaria de la Juventud Queretaro%'
        OR Autor LIKE '%Norma Guadalupe Martinez Castañeda%')
        OR (Texto LIKE '%Secretaria de Planeacion y Finanzas del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Planeacion y Finanzas de Queretaro%'
        OR Texto LIKE '%Secretaria de Planeacion y Finanzas  Queretaro%'
        OR Texto LIKE '%German Giordano Bonilla%'
        OR Titulo LIKE '%Secretaria de Planeacion y Finanzas del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Planeacion y Finanzas de Queretaro%'
        OR Titulo LIKE '%Secretaria de Planeacion y Finanzas Queretaro%'
        OR Titulo LIKE '%German Giordano Bonilla%'
        OR Encabezado LIKE '%Secretaria de Planeacion y Finanzas del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Planeacion y Finanzas de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Planeacion y Finanzas Queretaro%'
        OR Encabezado LIKE '%German Giordano Bonilla%'
        OR PieFoto LIKE '%Secretaria de Planeacion y Finanzas del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Planeacion y Finanzas de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Planeacion y Finanzas Queretaro%'
        OR PieFoto LIKE '%German Giordano Bonilla%'
        OR Autor LIKE '%Secretaria de Planeacion y Finanzas del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Planeacion y Finanzas de Queretaro%'
        OR Autor LIKE '%Secretaria de Planeacion y Finanzas Queretaro%'
        OR Autor LIKE '%German Giordano Bonilla%')
        OR (Texto LIKE '%Secretaria de Salud del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Salud de Queretaro%'
        OR Texto LIKE '%Secretaria de Salud  Queretaro%'
        OR Texto LIKE '%Mario Cesar Garcia Feregrino%'
        OR Titulo LIKE '%Secretaria de Salud del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Salud de Queretaro%'
        OR Titulo LIKE '%Secretaria de Salud Queretaro%'
        OR Titulo LIKE '%Mario Cesar Garcia Feregrino%'
        OR Encabezado LIKE '%Secretaria de Salud del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Salud de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Salud Queretaro%'
        OR Encabezado LIKE '%Mario Cesar Garcia Feregrino%'
        OR PieFoto LIKE '%Secretaria de Salud del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Salud de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Salud Queretaro%'
        OR PieFoto LIKE '%Mario Cesar Garcia Feregrino%'
        OR Autor LIKE '%Secretaria de Salud del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Salud de Queretaro%'
        OR Autor LIKE '%Secretaria de Salud Queretaro%'
        OR Autor LIKE '%Mario Cesar Garcia Feregrino%')
        OR (Texto LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR Texto LIKE '%Secretaria de Seguridad Ciudadana  Queretaro%'
        OR Texto LIKE '%Adolfo Vega Montoto%'
        OR Titulo LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR Titulo LIKE '%Secretaria de Seguridad Ciudadana Queretaro%'
        OR Titulo LIKE '%Adolfo Vega Montoto%'
        OR Encabezado LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Seguridad Ciudadana Queretaro%'
        OR Encabezado LIKE '%Adolfo Vega Montoto%'
        OR PieFoto LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Seguridad Ciudadana Queretaro%'
        OR PieFoto LIKE '%Adolfo Vega Montoto%'
        OR Autor LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR Autor LIKE '%Secretaria de Seguridad Ciudadana Queretaro%'
        OR Autor LIKE '%Adolfo Vega Montoto%')
        OR (Texto LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR Texto LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR Texto LIKE '%Secretaria de Seguridad Ciudadana  Queretaro%'
        OR Texto LIKE '%Adolfo Vega Montoto%'
        OR Titulo LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR Titulo LIKE '%Secretaria de Seguridad Ciudadana Queretaro%'
        OR Titulo LIKE '%Adolfo Vega Montoto%'
        OR Encabezado LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR Encabezado LIKE '%Secretaria de Seguridad Ciudadana Queretaro%'
        OR Encabezado LIKE '%Adolfo Vega Montoto%'
        OR PieFoto LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR PieFoto LIKE '%Secretaria de Seguridad Ciudadana Queretaro%'
        OR PieFoto LIKE '%Adolfo Vega Montoto%'
        OR Autor LIKE '%Secretaria de Seguridad Ciudadana del estado de Queretaro%'
        OR Autor LIKE '%Secretaria de Seguridad Ciudadana de Queretaro%'
        OR Autor LIKE '%Secretaria de Seguridad Ciudadana Queretaro%'
        OR Autor LIKE '%Adolfo Vega Montoto%')
        OR (Texto LIKE '%Secretaria del Trabajo del estado de Queretaro%'
        OR Texto LIKE '%Secretaria del Trabajo de Queretaro%'
        OR Texto LIKE '%Secretaria del Trabajo  Queretaro%'
        OR Texto LIKE '%Rogelio Israel Carboney Morales%'
        OR Titulo LIKE '%Secretaria del Trabajo del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria del Trabajo de Queretaro%'
        OR Titulo LIKE '%Secretaria del Trabajo Queretaro%'
        OR Titulo LIKE '%Rogelio Israel Carboney Morales%'
        OR Encabezado LIKE '%Secretaria del Trabajo del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria del Trabajo de Queretaro%'
        OR Encabezado LIKE '%Secretaria del Trabajo Queretaro%'
        OR Encabezado LIKE '%Rogelio Israel Carboney Morales%'
        OR PieFoto LIKE '%Secretaria del Trabajo del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria del Trabajo de Queretaro%'
        OR PieFoto LIKE '%Secretaria del Trabajo Queretaro%'
        OR PieFoto LIKE '%Rogelio Israel Carboney Morales%'
        OR Autor LIKE '%Secretaria del Trabajo del estado de Queretaro%'
        OR Autor LIKE '%Secretaria del Trabajo de Queretaro%'
        OR Autor LIKE '%Secretaria del Trabajo Queretaro%'
        OR Autor LIKE '%Rogelio Israel Carboney Morales%')
        OR (Texto LIKE '%Secretaria Particular del estado de Queretaro%'
        OR Texto LIKE '%Secretaria Particular de Queretaro%'
        OR Texto LIKE '%Secretaria Particular  Queretaro%'
        OR Texto LIKE '%Carlos Hale Palacios%'
        OR Titulo LIKE '%Secretaria Particular del estado de Queretaro%'
        OR Titulo LIKE '%Secretaria Particular de Queretaro%'
        OR Titulo LIKE '%Secretaria Particular Queretaro%'
        OR Titulo LIKE '%Carlos Hale Palacios%'
        OR Encabezado LIKE '%Secretaria Particular del estado de Queretaro%'
        OR Encabezado LIKE '%Secretaria Particular de Queretaro%'
        OR Encabezado LIKE '%Secretaria Particular Queretaro%'
        OR Encabezado LIKE '%Carlos Hale Palacios%'
        OR PieFoto LIKE '%Secretaria Particular del estado de Queretaro%'
        OR PieFoto LIKE '%Secretaria Particular de Queretaro%'
        OR PieFoto LIKE '%Secretaria Particular Queretaro%'
        OR PieFoto LIKE '%Carlos Hale Palacios%'
        OR Autor LIKE '%Secretaria Particular del estado de Queretaro%'
        OR Autor LIKE '%Secretaria Particular de Queretaro%'
        OR Autor LIKE '%Secretaria Particular Queretaro%'
        OR Autor LIKE '%Carlos Hale Palacios%')
GROUP BY n.Periodico , n.NumeroPagina";
        return $query;
        break;

    case 17: //Varios
        $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado != 9 AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
        Texto like '%San luis potosi%' OR
        Texto like '%Hidalgo%' OR
        Texto like '%Estado de Mexico%' OR
        Texto like '%Michoacan%' OR
        Texto like '%guanajuato%' OR

        Titulo like '%San luis potosi%' OR
        Titulo like '%Hidalgo%' OR
        Titulo like '%Estado de Mexico%' OR
        Titulo like '%Michoacan%' OR
        Titulo like '%guanajuato%' OR

        Encabezado like '%San luis potosi%' OR
        Encabezado like '%Hidalgo%' OR
        Encabezado like '%Estado de Mexico%' OR
        Encabezado like '%Michoacan%' OR
        Encabezado like '%guanajuato%' OR

        PieFoto like '%San luis potosi%' OR
        PieFoto like '%Hidalgo%' OR
        PieFoto like '%Estado de Mexico%' OR
        PieFoto like '%Michoacan%' OR
        PieFoto like '%guanajuato%' OR

        Autor like '%San luis potosi%' OR
        Autor like '%Hidalgo%' OR
        Autor like '%Estado de Mexico%' OR
        Autor like '%Michoacan%' OR
        Autor like '%guanajuato%'
    )
        GROUP BY n.Periodico,n.NumeroPagina";
        return $query;
        break;

    }
}
