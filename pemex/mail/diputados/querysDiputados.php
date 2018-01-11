<?php

function numberNotes($optionCase, $fecha)
{
    global $conect;
    
    $query = query($optionCase, $fecha);
    
    $resultado = mysql_query($query);
    if(mysql_num_rows($resultado) > 0)
    {
        return true;
    }
    return false;
}

function query($op,$fechaTabla){
        $fecha=$fechaTabla;
        $FechaCliente = strtotime($fechaTabla);
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);
        if ($FechaCliente == $fecha_actual)
        {
            $fechaTabla="noticiasDia";
        }
        else
        {
            $fechaTabla="noticiasSemana";
        }
    switch ($op) {
            case 1:// PRIMERAS PLANAS
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=3
                        AND s.idSeccion = n.Seccion AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY p.idPeriodico, n.NumeroPagina  ORDER BY o.posicion";
            return $query;
            break;

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
                        $fechaTabla n,
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
                        fecha =DATE('$fecha')
                    GROUP BY n.Periodico,n.NumeroPagina
                    ORDER BY o.id";
            return $query;
            break;

            case 3:// COLUMNAS FINANCIERAS
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=20
                        AND s.idSeccion = n.Seccion
                        AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY p.idPeriodico, n.NumeroPagina
                        ORDER BY o.posicion";
            return $query;
            break;

            case 4:// CARTONES
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE  n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND n.Categoria=18
                        AND s.idSeccion = n.Seccion
                        AND p.Estado=9 AND n.Fecha='".$fecha."'
                        GROUP BY p.idPeriodico, n.NumeroPagina
                        ORDER BY o.posicion";
            return $query;
            break;

            case 5:// Junta de Coordinación Politica CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                          WHERE (
                                    Texto like '%Cesar Octavio Camacho Quiroz%' OR
                                    Texto like '%Cesar Octavio Camacho%' OR
                                    Texto like '%Camacho Quiroz%' OR
                                    Texto like '%Cesar Camacho%' OR

                                    Texto like '%Marko Antonio Cortes Mendoza%' OR
                                    Texto like '%Marko Antonio Cortes%' OR
                                    Texto like '%Marko Cortes Mendoza%' OR
                                    Texto like '%Antonio Cortes Mendoza%' OR

                                    Texto like '%Francisco Martinez Neri%' OR
                                    Texto like '%Martinez Neri%' OR

                                    Texto like '%Jesus Sesma Suarez%' OR
                                    Texto like '%Sesma Suarez%' OR

                                    Texto like '%Alejandro Gonzalez Murillo%' OR
                                    Texto like '%Gonzalez Murillo%' OR

                                    Texto like '%Clemente Castaneda Hoeflich%' OR
                                    Texto like '%Castaneda Hoeflich%' OR

                                    Texto like '%Luis Alfredo Valles Mendoza%' OR
                                    Texto like '%Luis Alfredo Valles%' OR
                                    Texto like '%Luis Valles Mendoza%' OR
                                    Texto like '%Alfredo Valles Mendoza%' OR

                                    Texto like '%Norma Rocio Nahle Garcia%' OR
                                    Texto like '%Norma Rocio Nahle%' OR
                                    Texto like '%Norma Nahle Garcia%' OR
                                    Texto like '%Rocio Nahle Garcia%' OR

                                    Titulo like '%Cesar Octavio Camacho Quiroz%' OR
                                    Titulo like '%Cesar Octavio Camacho%' OR
                                    Titulo like '%Camacho Quiroz%' OR
                                    Titulo like '%Cesar Camacho%' OR

                                    Titulo like '%Marko Antonio Cortes Mendoza%' OR
                                    Titulo like '%Marko Antonio Cortes%' OR
                                    Titulo like '%Marko Cortes Mendoza%' OR
                                    Titulo like '%Antonio Cortes Mendoza%' OR

                                    Titulo like '%Francisco Martinez Neri%' OR
                                    Titulo like '%Martinez Neri%' OR

                                    Titulo like '%Jesus Sesma Suarez%' OR
                                    Titulo like '%Sesma Suarez%' OR

                                    Titulo like '%Alejandro Gonzalez Murillo%' OR
                                    Titulo like '%Gonzalez Murillo%' OR

                                    Titulo like '%Clemente Castaneda Hoeflich%' OR
                                    Titulo like '%Castaneda Hoeflich%' OR

                                    Titulo like '%Luis Alfredo Valles Mendoza%' OR
                                    Titulo like '%Luis Alfredo Valles%' OR
                                    Titulo like '%Luis Valles Mendoza%' OR
                                    Titulo like '%Alfredo Valles Mendoza%' OR

                                    Titulo like '%Norma Rocio Nahle Garcia%' OR
                                    Titulo like '%Norma Rocio Nahle%' OR
                                    Titulo like '%Norma Nahle Garcia%' OR
                                    Titulo like '%Rocio Nahle Garcia%' OR

                                    Encabezado like '%Cesar Octavio Camacho Quiroz%' OR
                                    Encabezado like '%Cesar Octavio Camacho%' OR
                                    Encabezado like '%Camacho Quiroz%' OR
                                    Encabezado like '%Cesar Camacho%' OR

                                    Encabezado like '%Marko Antonio Cortes Mendoza%' OR
                                    Encabezado like '%Marko Antonio Cortes%' OR
                                    Encabezado like '%Marko Cortes Mendoza%' OR
                                    Encabezado like '%Antonio Cortes Mendoza%' OR

                                    Encabezado like '%Francisco Martinez Neri%' OR
                                    Encabezado like '%Martinez Neri%' OR

                                    Encabezado like '%Jesus Sesma Suarez%' OR
                                    Encabezado like '%Sesma Suarez%' OR

                                    Encabezado like '%Alejandro Gonzalez Murillo%' OR
                                    Encabezado like '%Gonzalez Murillo%' OR

                                    Encabezado like '%Clemente Castaneda Hoeflich%' OR
                                    Encabezado like '%Castaneda Hoeflich%' OR

                                    Encabezado like '%Luis Alfredo Valles Mendoza%' OR
                                    Encabezado like '%Luis Alfredo Valles%' OR
                                    Encabezado like '%Luis Valles Mendoza%' OR
                                    Encabezado like '%Alfredo Valles Mendoza%' OR

                                    Encabezado like '%Norma Rocio Nahle Garcia%' OR
                                    Encabezado like '%Norma Rocio Nahle%' OR
                                    Encabezado like '%Norma Nahle Garcia%' OR
                                    Encabezado like '%Rocio Nahle Garcia%' OR


                                    PieFoto like '%Cesar Octavio Camacho Quiroz%' OR
                                    PieFoto like '%Cesar Octavio Camacho%' OR
                                    PieFoto like '%Camacho Quiroz%' OR
                                    PieFoto like '%Cesar Camacho%' OR

                                    PieFoto like '%Marko Antonio Cortes Mendoza%' OR
                                    PieFoto like '%Marko Antonio Cortes%' OR
                                    PieFoto like '%Marko Cortes Mendoza%' OR
                                    PieFoto like '%Antonio Cortes Mendoza%' OR

                                    PieFoto like '%Francisco Martinez Neri%' OR
                                    PieFoto like '%Martinez Neri%' OR

                                    PieFoto like '%Jesus Sesma Suarez%' OR
                                    PieFoto like '%Sesma Suarez%' OR

                                    PieFoto like '%Alejandro Gonzalez Murillo%' OR
                                    PieFoto like '%Gonzalez Murillo%' OR

                                    PieFoto like '%Clemente Castaneda Hoeflich%' OR
                                    PieFoto like '%Castaneda Hoeflich%' OR

                                    PieFoto like '%Luis Alfredo Valles Mendoza%' OR
                                    PieFoto like '%Luis Alfredo Valles%' OR
                                    PieFoto like '%Luis Valles Mendoza%' OR
                                    PieFoto like '%Alfredo Valles Mendoza%' OR

                                    PieFoto like '%Norma Rocio Nahle Garcia%' OR
                                    PieFoto like '%Norma Rocio Nahle%' OR
                                    PieFoto like '%Norma Nahle Garcia%' OR
                                    PieFoto like '%Rocio Nahle Garcia%' 
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico";
            return $query;
            break;

            case 6:// Mesa Directiva CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE (
                            Texto like '%Jorge Carlos Ramirez Marin%' OR
                            Texto like '%Jorge Carlos Ramirez%' OR
                            Texto like '%Jorge Ramirez Marin%' OR
                            Texto like '%Carlos Ramirez Marin%' OR

                            Texto like '%Martha Hilda Gonzalez Calderon%' OR
                            Texto like '%Martha Hilda Gonzalez%' OR
                            Texto like '%Martha Gonzalez Calderon%' OR
                            Texto like '%Hilda Gonzalez Calderon%' OR

                            Texto like '%Edmundo Javier Bolanos Aguilar%' OR
                            Texto like '%Edmundo Javier Bolanos%' OR
                            Texto like '%Edmundo Bolanos Aguilar%' OR
                            Texto like '%Javier Bolanos Aguilar%' OR

                            Texto like '%Arturo Santana Alfaro%' OR
                            Texto like '%Santana Alfaro%' OR

                            Texto like '%Maria Avila Serna%' OR
                            Texto like '%Avila Serna%' OR

                            Texto like '%Marco Antonio Aguilar Yunes%' OR
                            Texto like '%Marco Antonio Aguilar%' OR
                            Texto like '%Marco Aguilar Yunes%' OR
                            Texto like '%Antonio Aguilar Yunes%' OR

                            Texto like '%Alejandra Noemi Reynoso Sanchez%' OR
                            Texto like '%Alejandra Noemi Reynoso%' OR
                            Texto like '%Alejandra Reynoso Sanchez%' OR
                            Texto like '%Noemi Reynoso Sanchez%' OR

                        
                            Texto like '%Isaura Ivanova Pool Pech%' OR
                            Texto like '%Isaura Ivanova Pool%' OR
                            Texto like '%Isaura Pool Pech%' OR
                            Texto like '%Ivanova Pool Pech%' OR

                            Texto like '%Andres Fernandez del Valle Laisequilla%' OR
                            Texto like '%Andres Fernandez del Valle%' OR
                            Texto like '%Andres del Valle Laisequilla%' OR
                            Texto like '%Fernandez del Valle Laisequilla%' OR

                            Texto like '%Ernestina Godoy Ramos%' OR
                            Texto like '%Godoy Ramos%' OR

                            Texto like '%Veronica Delgadillo Garcia%' OR
                            Texto like '%Delgadillo Garcia%' OR

                            Texto like '%Maria Eugenia Ocampo Bedolla%' OR
                            Texto like '%Maria Eugenia Ocampo%' OR
                            Texto like '%Maria Ocampo Bedolla%' OR
                            Texto like '%Eugenia Ocampo Bedolla%' OR

                            Texto like '%Ana Guadalupe Perea Santos%' OR
                            Texto like '%Ana Guadalupe Perea%' OR
                            Texto like '%Ana Perea Santos%' OR
                            Texto like '%Guadalupe Perea Santos%' OR

                            Titulo like '%Jorge Carlos Ramirez Marin%' OR
                            Titulo like '%Jorge Carlos Ramirez%' OR
                            Titulo like '%Jorge Ramirez Marin%' OR
                            Titulo like '%Carlos Ramirez Marin%' OR

                            Titulo like '%Martha Hilda Gonzalez Calderon%' OR
                            Titulo like '%Martha Hilda Gonzalez%' OR
                            Titulo like '%Martha Gonzalez Calderon%' OR
                            Titulo like '%Hilda Gonzalez Calderon%' OR

                            Titulo like '%Edmundo Javier Bolanos Aguilar%' OR
                            Titulo like '%Edmundo Javier Bolanos%' OR
                            Titulo like '%Edmundo Bolanos Aguilar%' OR
                            Titulo like '%Javier Bolanos Aguilar%' OR

                            Titulo like '%Arturo Santana Alfaro%' OR
                            Titulo like '%Santana Alfaro%' OR

                            Titulo like '%Maria Avila Serna%' OR
                            Titulo like '%Avila Serna%' OR

                            Titulo like '%Marco Antonio Aguilar Yunes%' OR
                            Titulo like '%Marco Antonio Aguilar%' OR
                            Titulo like '%Marco Aguilar Yunes%' OR
                            Titulo like '%Antonio Aguilar Yunes%' OR


                            Titulo like '%Alejandra Noemi Reynoso Sanchez%' OR
                            Titulo like '%Alejandra Noemi Reynoso%' OR
                            Titulo like '%Alejandra Reynoso Sanchez%' OR
                            Titulo like '%Noemi Reynoso Sanchez%' OR

                        
                            Titulo like '%Isaura Ivanova Pool Pech%' OR
                            Titulo like '%Isaura Ivanova Pool%' OR
                            Titulo like '%Isaura Pool Pech%' OR
                            Titulo like '%Ivanova Pool Pech%' OR

                            Titulo like '%Andres Fernandez del Valle Laisequilla%' OR
                            Titulo like '%Andres Fernandez del Valle%' OR
                            Titulo like '%Andres del Valle Laisequilla%' OR
                            Titulo like '%Fernandez del Valle Laisequilla%' OR

                            Titulo like '%Ernestina Godoy Ramos%' OR
                            Titulo like '%Godoy Ramos%' OR

                            Titulo like '%Veronica Delgadillo Garcia%' OR
                            Titulo like '%Delgadillo Garcia%' OR

                            Titulo like '%Maria Eugenia Ocampo Bedolla%' OR
                            Titulo like '%Maria Eugenia Ocampo%' OR
                            Titulo like '%Maria Ocampo Bedolla%' OR
                            Titulo like '%Eugenia Ocampo Bedolla%' OR

                            Titulo like '%Ana Guadalupe Perea Santos%' OR
                            Titulo like '%Ana Guadalupe Perea%' OR
                            Titulo like '%Ana Perea Santos%' OR
                            Titulo like '%Guadalupe Perea Santos%' OR

                            Encabezado like '%Jorge Carlos Ramirez Marin%' OR
                            Encabezado like '%Jorge Carlos Ramirez%' OR
                            Encabezado like '%Jorge Ramirez Marin%' OR
                            Encabezado like '%Carlos Ramirez Marin%' OR

                            Encabezado like '%Martha Hilda Gonzalez Calderon%' OR
                            Encabezado like '%Martha Hilda Gonzalez%' OR
                            Encabezado like '%Martha Gonzalez Calderon%' OR
                            Encabezado like '%Hilda Gonzalez Calderon%' OR

                            Encabezado like '%Edmundo Javier Bolanos Aguilar%' OR
                            Encabezado like '%Edmundo Javier Bolanos%' OR
                            Encabezado like '%Edmundo Bolanos Aguilar%' OR
                            Encabezado like '%Javier Bolanos Aguilar%' OR

                            Encabezado like '%Arturo Santana Alfaro%' OR
                            Encabezado like '%Santana Alfaro%' OR

                            Encabezado like '%Maria Avila Serna%' OR
                            Encabezado like '%Avila Serna%' OR

                            Encabezado like '%Marco Antonio Aguilar Yunes%' OR
                            Encabezado like '%Marco Antonio Aguilar%' OR
                            Encabezado like '%Marco Aguilar Yunes%' OR
                            Encabezado like '%Antonio Aguilar Yunes%' OR


                            Encabezado like '%Alejandra Noemi Reynoso Sanchez%' OR
                            Encabezado like '%Alejandra Noemi Reynoso%' OR
                            Encabezado like '%Alejandra Reynoso Sanchez%' OR
                            Encabezado like '%Noemi Reynoso Sanchez%' OR

                        
                            Encabezado like '%Isaura Ivanova Pool Pech%' OR
                            Encabezado like '%Isaura Ivanova Pool%' OR
                            Encabezado like '%Isaura Pool Pech%' OR
                            Encabezado like '%Ivanova Pool Pech%' OR

                            Encabezado like '%Andres Fernandez del Valle Laisequilla%' OR
                            Encabezado like '%Andres Fernandez del Valle%' OR
                            Encabezado like '%Andres del Valle Laisequilla%' OR
                            Encabezado like '%Fernandez del Valle Laisequilla%' OR

                            Encabezado like '%Ernestina Godoy Ramos%' OR
                            Encabezado like '%Godoy Ramos%' OR

                            Encabezado like '%Veronica Delgadillo Garcia%' OR
                            Encabezado like '%Delgadillo Garcia%' OR

                            Encabezado like '%Maria Eugenia Ocampo Bedolla%' OR
                            Encabezado like '%Maria Eugenia Ocampo%' OR
                            Encabezado like '%Maria Ocampo Bedolla%' OR
                            Encabezado like '%Eugenia Ocampo Bedolla%' OR

                            Encabezado like '%Ana Guadalupe Perea Santos%' OR
                            Encabezado like '%Ana Guadalupe Perea%' OR
                            Encabezado like '%Ana Perea Santos%' OR
                            Encabezado like '%Guadalupe Perea Santos%' OR

                            PieFoto like '%Jorge Carlos Ramirez Marin%' OR
                            PieFoto like '%Jorge Carlos Ramirez%' OR
                            PieFoto like '%Jorge Ramirez Marin%' OR
                            PieFoto like '%Carlos Ramirez Marin%' OR

                            PieFoto like '%Martha Hilda Gonzalez Calderon%' OR
                            PieFoto like '%Martha Hilda Gonzalez%' OR
                            PieFoto like '%Martha Gonzalez Calderon%' OR
                            PieFoto like '%Hilda Gonzalez Calderon%' OR

                            PieFoto like '%Edmundo Javier Bolanos Aguilar%' OR
                            PieFoto like '%Edmundo Javier Bolanos%' OR
                            PieFoto like '%Edmundo Bolanos Aguilar%' OR
                            PieFoto like '%Javier Bolanos Aguilar%' OR

                            PieFoto like '%Arturo Santana Alfaro%' OR
                            PieFoto like '%Santana Alfaro%' OR

                            PieFoto like '%Maria Avila Serna%' OR
                            PieFoto like '%Avila Serna%' OR

                            PieFoto like '%Marco Antonio Aguilar Yunes%' OR
                            PieFoto like '%Marco Antonio Aguilar%' OR
                            PieFoto like '%Marco Aguilar Yunes%' OR
                            PieFoto like '%Antonio Aguilar Yunes%' OR


                            PieFoto like '%Alejandra Noemi Reynoso Sanchez%' OR
                            PieFoto like '%Alejandra Noemi Reynoso%' OR
                            PieFoto like '%Alejandra Reynoso Sanchez%' OR
                            PieFoto like '%Noemi Reynoso Sanchez%' OR

                        
                            PieFoto like '%Isaura Ivanova Pool Pech%' OR
                            PieFoto like '%Isaura Ivanova Pool%' OR
                            PieFoto like '%Isaura Pool Pech%' OR
                            PieFoto like '%Ivanova Pool Pech%' OR

                            PieFoto like '%Andres Fernandez del Valle Laisequilla%' OR
                            PieFoto like '%Andres Fernandez del Valle%' OR
                            PieFoto like '%Andres del Valle Laisequilla%' OR
                            PieFoto like '%Fernandez del Valle Laisequilla%' OR

                            PieFoto like '%Ernestina Godoy Ramos%' OR
                            PieFoto like '%Godoy Ramos%' OR

                            PieFoto like '%Veronica Delgadillo Garcia%' OR
                            PieFoto like '%Delgadillo Garcia%' OR

                            PieFoto like '%Maria Eugenia Ocampo Bedolla%' OR
                            PieFoto like '%Maria Eugenia Ocampo%' OR
                            PieFoto like '%Maria Ocampo Bedolla%' OR
                            PieFoto like '%Eugenia Ocampo Bedolla%' OR

                            PieFoto like '%Ana Guadalupe Perea Santos%' OR
                            PieFoto like '%Ana Guadalupe Perea%' OR
                            PieFoto like '%Ana Perea Santos%' OR
                            PieFoto like '%Guadalupe Perea Santos%'
                        )
                        n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY n.Periodico";
            return $query;
            break;

            case 7:// Presidente de la Mesa Directiva
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE (     Texto like '%Jorge Carlos Ramirez Marin%' OR
                                        Texto like '%Jorge Carlos Ramirez%' OR
                                        Texto like '%Jorge Ramirez Marin%' OR
                                        Texto like '%Carlos Ramirez Marin%' OR

                                        Titulo like '%Jorge Carlos Ramirez Marin%' OR
                                        Titulo like '%Jorge Carlos Ramirez%' OR
                                        Titulo like '%Jorge Ramirez Marin%' OR
                                        Titulo like '%Carlos Ramirez Marin%' OR

                                        Encabezado like '%Jorge Carlos Ramirez Marin%' OR
                                        Encabezado like '%Jorge Carlos Ramirez%' OR
                                        Encabezado like '%Jorge Ramirez Marin%' OR
                                        Encabezado like '%Carlos Ramirez Marin%' OR

                                        PieFoto like '%Jorge Carlos Ramirez Marin%' OR
                                        PieFoto like '%Jorge Carlos Ramirez%' OR
                                        PieFoto like '%Jorge Ramirez Marin%' OR
                                        PieFoto like '%Carlos Ramirez Marin%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 8://Coord. Gpo. Parlamentario PRI
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto LIKE '%Cesar Octavio Camacho Quiroz%' OR
                                Texto LIKE '%Cesar Octavio Camacho%' OR
                                Texto LIKE '%Cesar Camacho Quiroz%' OR
                                Texto LIKE '%Octavio Camacho Quiroz%' OR
                                Texto LIKE '%Cesar Camacho%' OR

                                Titulo LIKE '%Cesar Octavio Camacho Quiroz%' OR
                                Titulo LIKE '%Cesar Octavio Camacho%' OR
                                Titulo LIKE '%Cesar Camacho Quiroz%' OR
                                Titulo LIKE '%Octavio Camacho Quiroz%' OR
                                Titulo LIKE '%Cesar Camacho%' OR

                                Encabezado LIKE '%Cesar Octavio Camacho Quiroz%' OR
                                Encabezado LIKE '%Cesar Octavio Camacho%' OR
                                Encabezado LIKE '%Cesar Camacho Quiroz%' OR
                                Encabezado LIKE '%Octavio Camacho Quiroz%' OR
                                Encabezado LIKE '%Cesar Camacho%' OR

                                PieFoto LIKE '%Cesar Octavio Camacho Quiroz%' OR
                                PieFoto LIKE '%Cesar Octavio Camacho%' OR
                                PieFoto LIKE '%Cesar Camacho Quiroz%' OR
                                PieFoto LIKE '%Octavio Camacho Quiroz%' OR
                                PieFoto LIKE '%Cesar Camacho%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 9:// Petróleo
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto LIKE '%Marko Antonio Cortes Mendoza%' OR
                                Texto LIKE '%Marko Antonio Cortes%' OR
                                Texto LIKE '%Marko Cortes Mendoza%' OR
                                Texto LIKE '%Antonio Cortes Mendoza%' OR

                                Titulo LIKE '%Marko Antonio Cortes Mendoza%' OR
                                Titulo LIKE '%Marko Antonio Cortes%' OR
                                Titulo LIKE '%Marko Cortes Mendoza%' OR
                                Titulo LIKE '%Antonio Cortes Mendoza%' OR

                                Encabezado LIKE '%Marko Antonio Cortes Mendoza%' OR
                                Encabezado LIKE '%Marko Antonio Cortes%' OR
                                Encabezado LIKE '%Marko Cortes Mendoza%' OR
                                Encabezado LIKE '%Antonio Cortes Mendoza%' OR

                                PieFoto LIKE '%Marko Antonio Cortes Mendoza%' OR
                                PieFoto LIKE '%Marko Antonio Cortes%' OR
                                PieFoto LIKE '%Marko Cortes Mendoza%' OR
                                PieFoto LIKE '%Antonio Cortes Mendoza%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 10://Coordinador del Grupo Parlamentario del PRD
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto LIKE '%Francisco Martinez Neri%' OR
                            Texto LIKE '%Martinez Neri%' OR

                            Titulo LIKE '%Francisco Martinez Neri%' OR
                            Titulo LIKE '%Martinez Neri%' OR

                            Encabezado LIKE '%Francisco Martinez Neri%' OR
                            Encabezado LIKE '%Martinez Neri%' OR

                            PieFoto LIKE '%Francisco Martinez Neri%' OR
                            PieFoto LIKE '%Martinez Neri%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 11://Coordinador del Grupo Parlamentario del PVEM
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE (
                            Texto LIKE '%Jesus Sesma Suarez%' OR
                            Texto LIKE '%Sesma Suarez%' OR

                            Titulo LIKE '%Jesus Sesma Suarez%' OR
                            Titulo LIKE '%Sesma Suarez%' OR

                            Encabezado LIKE '%Jesus Sesma Suarez%' OR
                            Encabezado LIKE '%Sesma Suarez%' OR

                            PieFoto LIKE '%Jesus Sesma Suarez%' OR
                            PieFoto LIKE '%Sesma Suarez%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 12:// Coordinador del Grupo Parlamentario del PES
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE (
                                Texto LIKE '%Alejandro Gonzalez Murillo%' OR
                                Texto LIKE '%Gonzalez Murillo%' OR

                                Titulo LIKE '%Alejandro Gonzalez Murillo%' OR
                                Titulo LIKE '%Gonzalez Murillo%' OR

                                Encabezado LIKE '%Alejandro Gonzalez Murillo%' OR
                                Encabezado LIKE '%Gonzalez Murillo%' OR

                                PieFoto LIKE '%Alejandro Gonzalez Murillo%' OR
                                PieFoto LIKE '%Gonzalez Murillo%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 13:// Coordinador del Grupo Parlamentaria del Movimiento Ciudadano
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto LIKE '%Clemente Castaneda Hoeflich%' OR
                                Texto LIKE '%Castaneda Hoeflich%' OR

                                Titulo LIKE '%Clemente Castaneda Hoeflich%' OR
                                Titulo LIKE '%Castaneda Hoeflich%' OR

                                Encabezado LIKE '%Clemente Castaneda  Hoeflich%' OR
                                Encabezado LIKE '%Castaneda Hoeflich%' OR

                                PieFoto LIKE '%Clemente Castaneda  Hoeflich%' OR
                                PieFoto LIKE '%Castaneda Hoeflich%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 14://Coord. Gpo. Parlamentario PANAL
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto LIKE '%Luis Alfredo Valles Mendoza%' OR
                                Texto LIKE '%Luis Alfredo Valles%' OR
                                Texto LIKE '%Luis Valles Mendoza%' OR
                                Texto LIKE '%Alfredo Valles Mendoza%' OR

                                Titulo LIKE '%Luis Alfredo Valles Mendoza%' OR
                                Titulo LIKE '%Luis Alfredo Valles%' OR
                                Titulo LIKE '%Luis Valles Mendoza%' OR
                                Titulo LIKE '%Alfredo Valles Mendoza%' OR

                                Encabezado LIKE '%Luis Alfredo Valles Mendoza%' OR
                                Encabezado LIKE '%Luis Alfredo Valles%' OR
                                Encabezado LIKE '%Luis Valles Mendoza%' OR
                                Encabezado LIKE '%Alfredo Valles Mendoza%' OR

                                PieFoto LIKE '%Luis Alfredo Valles Mendoza%' OR
                                PieFoto LIKE '%Luis Alfredo Valles%' OR
                                PieFoto LIKE '%Luis Valles Mendoza%' OR
                                PieFoto LIKE '%Alfredo Valles Mendoza%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 15://Coord. Gpo. Parlamentario MORENA
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto LIKE '%Norma Rocio Nahle Garcia%' OR
                                Texto LIKE '%Norma Rocio Nahle%' OR
                                Texto LIKE '%Norma Nahle Garcia%' OR
                                Texto LIKE '%Rocio Nahle Garcia%' OR

                                Titulo LIKE '%Norma Rocio Nahle Garcia%' OR
                                Titulo LIKE '%Norma Rocio Nahle%' OR
                                Titulo LIKE '%Norma Nahle Garcia%' OR
                                Titulo LIKE '%Rocio Nahle Garcia%' OR

                                Encabezado LIKE '%Norma Rocio Nahle Garcia%' OR
                                Encabezado LIKE '%Norma Rocio Nahle%' OR
                                Encabezado LIKE '%Norma Nahle Garcia%' OR
                                Encabezado LIKE '%Rocio Nahle Garcia%' OR

                                PieFoto LIKE '%Norma Rocio Nahle Garcia%' OR
                                PieFoto LIKE '%Norma Rocio Nahle%' OR
                                PieFoto LIKE '%Norma Nahle Garcia%' OR
                                PieFoto LIKE '%Rocio Nahle Garcia%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 16://Diputado Independiente
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto LIKE '%Manuel Jesus Clouthier Carrillo%' OR
                                Texto LIKE '%Manuel Jesus Clouthier%' OR
                                Texto LIKE '%Manuel Clouthier Carrillo%' OR
                                Texto LIKE '%Jesus Clouthier Carrillo%' OR

                                Titulo LIKE '%Manuel Jesus Clouthier Carrillo%' OR
                                Titulo LIKE '%Manuel Jesus Clouthier%' OR
                                Titulo LIKE '%Manuel Clouthier Carrillo%' OR
                                Titulo LIKE '%Jesus Clouthier Carrillo%' OR

                                Encabezado LIKE '%Manuel Jesus Clouthier Carrillo%' OR
                                Encabezado LIKE '%Manuel Jesus Clouthier%' OR
                                Encabezado LIKE '%Manuel Clouthier Carrillo%' OR
                                Encabezado LIKE '%Jesus Clouthier Carrillo%' OR

                                PieFoto LIKE '%Manuel Jesus Clouthier Carrillo%' OR
                                PieFoto LIKE '%Manuel Jesus Clouthier%' OR
                                PieFoto LIKE '%Manuel Clouthier Carrillo%' OR
                                PieFoto LIKE '%Jesus Clouthier Carrillo%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            case 17://Diputado(s) Sin Partido
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                                Texto LIKE '%Manuel de Jesus Espino%' OR
                                Texto LIKE '%Manuel Jesus Espino%' OR
                                Texto LIKE '%Javier Guerrero Garcia%' OR
                                Texto LIKE '%Guerrero Garcia%' OR
                                Texto LIKE '%Daniel Torres Cantu%' OR
                                Texto LIKE '%Torres Cantu%' OR
                                Titulo LIKE '%Manuel de Jesus Espino%' OR
                                Titulo LIKE '%Manuel Jesus Espino%' OR
                                Titulo LIKE '%Javier Guerrero Garcia%' OR
                                Titulo LIKE '%Guerrero Garcia%' OR
                                Titulo LIKE '%Daniel Torres Cantu%' OR
                                Titulo LIKE '%Torres Cantu%' OR
                                Encabezado LIKE '%Manuel de Jesus Espino%' OR
                                Encabezado LIKE '%Manuel Jesus Espino%' OR
                                Encabezado LIKE '%Javier Guerrero Garcia%' OR
                                Encabezado LIKE '%Guerrero Garcia%' OR
                                Encabezado LIKE '%Daniel Torres Cantu%' OR
                                Encabezado LIKE '%Torres Cantu%' OR
                                PieFoto LIKE '%Manuel de Jesus Espino%' OR
                                PieFoto LIKE '%Manuel Jesus Espino%' OR
                                PieFoto LIKE '%Javier Guerrero Garcia%' OR
                                PieFoto LIKE '%Guerrero Garcia%' OR
                                PieFoto LIKE '%Daniel Torres Cantu%' OR
                                PieFoto LIKE '%Torres Cantu%'
                            )AND
                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1 AND p.idPeriodico in(32,50,51,52,53,59,320) AND n.Activo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;
            
            default:
            break;

    }
}
?>
