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

            case 5:// Director General CDMX
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
			WHERE(
				Texto like'%Alfredo del Mazo Maza%' OR
				Texto like'%Alfredo del Mazo%' OR
				Texto like'%del Mazo Maza%' OR
				Texto like'%Gobernador del estado de mexico%' OR

				Titulo like'%Alfredo del Mazo Maza%' OR
				Titulo like'%Alfredo del Mazo%' OR
				Titulo like'%del Mazo Maza%' OR
				Titulo like'%Gobernador del estado de mexico%' OR

				Encabezado like'%Alfredo del Mazo Maza%' OR
				Encabezado like'%Alfredo del Mazo%' OR
				Encabezado like'%del Mazo Maza%' OR
				Encabezado like'%Gobernador del estado de mexico%' OR

				PieFoto like'%Alfredo del Mazo Maza%' OR
				PieFoto like'%Alfredo del Mazo%' OR
				PieFoto like'%del Mazo Maza%' OR
				PieFoto like'%Gobernador del estado de mexico%' OR

				Autor like'%Alfredo del Mazo Maza%' OR
				Autor like'%Alfredo del Mazo%' OR
				Autor like'%del Mazo Maza%' OR
				Autor like'%Gobernador del estado de mexico%'
			)AND

			n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
			s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
			AND p.Estado=9 AND p.tipo=1
			GROUP BY n.Periodico, n.NumeroPagina
			ORDER BY n.Periodico ";
            return $query;
            break;

            case 6:// Director General Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                          WHERE(
				Texto like'%Alfredo del Mazo Maza%' OR
				Texto like'%Alfredo del Mazo%' OR
				Texto like'%del Mazo Maza%' OR
				Texto like'%Gobernador del estado de mexico%' OR

				Titulo like'%Alfredo del Mazo Maza%' OR
				Titulo like'%Alfredo del Mazo%' OR
				Titulo like'%del Mazo Maza%' OR
				Titulo like'%Gobernador del estado de mexico%' OR

				Encabezado like'%Alfredo del Mazo Maza%' OR
				Encabezado like'%Alfredo del Mazo%' OR
				Encabezado like'%del Mazo Maza%' OR
				Encabezado like'%Gobernador del estado de mexico%' OR

				PieFoto like'%Alfredo del Mazo Maza%' OR
				PieFoto like'%Alfredo del Mazo%' OR
				PieFoto like'%del Mazo Maza%' OR
				PieFoto like'%Gobernador del estado de mexico%' OR

				Autor like'%Alfredo del Mazo Maza%' OR
				Autor like'%Alfredo del Mazo%' OR
				Autor like'%del Mazo Maza%' OR
				Autor like'%Gobernador del estado de mexico%'
			
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 7://Adm. Estatal 
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Alejandro Ozuna Rivero%' OR
				Texto like '%Alejandro Ozuna%' OR
				Texto like '%Maribel Cervantes Guerrero%' OR
				Texto like '%Maribel Cervantes%' OR
				Texto like '%Rodrigo Jarque Lira%' OR
				Texto like '%Rodrigo Jarque%' OR
				Texto like '%Alejandro Fernandez Campillo%' OR
				Texto like '%Miguel Angel Torres Cabello%' OR
				Texto like '%Miguel Angel Torres%' OR
				Texto like '%Maria Lorena Marin Moreno%' OR
				Texto like '%Maria Lorena Marin%' OR
				Texto like '%Maria Mercedes Colin Guadarrama%' OR
				Texto like '%Maria Mercedes Colin%' OR
				Texto like '%Maria Marcela Gonzalez Salas y Petricioli%' OR
				Texto like '%Marcela Gonzalez Salas y Petricioli%' OR
				Texto like '%Marcela Gonzalez Salas%' OR
				Texto like '%Maria Marcela Gonzalez Salas%' OR
				Texto like '%Maria Marcela Gonzalez%' OR
				Texto like '%Paulina Alejandra Del Moral Vela%' OR
				Texto like '%Alejandra Del Moral Vela%' OR
				Texto like '%Paulina Alejandra Del Moral%' OR
				Texto like '%Paulina Alejandra Moral Vela%' OR
				Texto like '%Paulina Alejandra Moral%' OR
				Texto like '%Gabriel Jaime O`Shea Cuevas%' OR
				Texto like '%Jaime O`Shea Cuevas%' OR
				Texto like '%Jaime OShea Cuevas%' OR
				Texto like '%Gabriel Jaime O`Shea%' OR
				Texto like '%Gabriel Jaime OShea Cuevas%' OR
				Texto like '%Gabriel Jaime OShea%' OR
				Texto like '%Raymundo Martinez Carbajal%' OR
				Texto like '%Javier Vargas Zempoaltecatl%' OR
				Texto like '%Dario Zacarias Capuchino%' OR
				Texto like '%Dario Zacarias%' OR
				Texto like '%Zacarias Capuchino%' OR
				Texto like '%Jorge Rescala Perez%' OR
				Texto like '%Jorge Rescala%' OR
				Texto like '%Juan Jaffet Millan Marquez%' OR
				Texto like '%Juan Jaffet Millan%' OR
				Texto like '%Jaffet Millan%' OR
				Texto like '%Jaffet Millan Marquez%' OR
				Texto like '%Juan Millan Marquez%' OR
				Texto like '%Enrique Jacob Rocha%' OR
				Texto like '%Enrique Jacob%' OR
				Texto like '%Rodrigo Espeleta Aladro%' OR
				Texto like '%Rodrigo Espeleta%' OR
				Texto like '%Eriko Flores%' OR
				Texto like '%Jorge Perez Zamudio%' OR
				Texto like '%Jorge Zamudio%' OR
				Texto like '%Francisco Javier Eric Sevilla Montes de Oca%' OR
				Texto like '%Francisco Javier Eric Sevilla Montes%' OR
				Texto like '%Javier Eric Sevilla Montes de Oca%' OR
				Texto like '%Eric Sevilla Montes de Oca%' OR
				Texto like '%Eric Sevilla Montes%' OR

				Titulo like '%Alejandro Ozuna Rivero%' OR
				Titulo like '%Alejandro Ozuna%' OR
				Titulo like '%Maribel Cervantes Guerrero%' OR
				Titulo like '%Maribel Cervantes%' OR
				Titulo like '%Rodrigo Jarque Lira%' OR
				Titulo like '%Rodrigo Jarque%' OR
				Titulo like '%Alejandro Fernandez Campillo%' OR
				Titulo like '%Miguel Angel Torres Cabello%' OR
				Titulo like '%Miguel Angel Torres%' OR
				Titulo like '%Maria Lorena Marin Moreno%' OR
				Titulo like '%Maria Lorena Marin%' OR
				Titulo like '%Maria Mercedes Colin Guadarrama%' OR
				Titulo like '%Maria Mercedes Colin%' OR
				Titulo like '%Maria Marcela Gonzalez Salas y Petricioli%' OR
				Titulo like '%Marcela Gonzalez Salas y Petricioli%' OR
				Titulo like '%Marcela Gonzalez Salas%' OR
				Titulo like '%Maria Marcela Gonzalez Salas%' OR
				Titulo like '%Maria Marcela Gonzalez%' OR
				Titulo like '%Paulina Alejandra Del Moral Vela%' OR
				Titulo like '%Alejandra Del Moral Vela%' OR
				Titulo like '%Paulina Alejandra Del Moral%' OR
				Titulo like '%Paulina Alejandra Moral Vela%' OR
				Titulo like '%Paulina Alejandra Moral%' OR
				Titulo like '%Gabriel Jaime O`Shea Cuevas%' OR
				Titulo like '%Jaime O`Shea Cuevas%' OR
				Titulo like '%Jaime OShea Cuevas%' OR
				Titulo like '%Gabriel Jaime O`Shea%' OR
				Titulo like '%Gabriel Jaime OShea Cuevas%' OR
				Titulo like '%Gabriel Jaime OShea%' OR
				Titulo like '%Raymundo Martinez Carbajal%' OR
				Titulo like '%Javier Vargas Zempoaltecatl%' OR
				Titulo like '%Dario Zacarias Capuchino%' OR
				Titulo like '%Dario Zacarias%' OR
				Titulo like '%Zacarias Capuchino%' OR
				Titulo like '%Jorge Rescala Perez%' OR
				Titulo like '%Jorge Rescala%' OR
				Titulo like '%Juan Jaffet Millan Marquez%' OR
				Titulo like '%Juan Jaffet Millan%' OR
				Titulo like '%Jaffet Millan%' OR
				Titulo like '%Jaffet Millan Marquez%' OR
				Titulo like '%Juan Millan Marquez%' OR
				Titulo like '%Enrique Jacob Rocha%' OR
				Titulo like '%Enrique Jacob%' OR
				Titulo like '%Rodrigo Espeleta Aladro%' OR
				Titulo like '%Rodrigo Espeleta%' OR
				Titulo like '%Eriko Flores%' OR
				Titulo like '%Jorge Perez Zamudio%' OR
				Titulo like '%Jorge Zamudio%' OR
				Titulo like '%Francisco Javier Eric Sevilla Montes de Oca%' OR
				Titulo like '%Francisco Javier Eric Sevilla Montes%' OR
				Titulo like '%Javier Eric Sevilla Montes de Oca%' OR
				Titulo like '%Eric Sevilla Montes de Oca%' OR
				Titulo like '%Eric Sevilla Montes%' OR

				Encabezado like '%Alejandro Ozuna Rivero%' OR
				Encabezado like '%Alejandro Ozuna%' OR
				Encabezado like '%Maribel Cervantes Guerrero%' OR
				Encabezado like '%Maribel Cervantes%' OR
				Encabezado like '%Rodrigo Jarque Lira%' OR
				Encabezado like '%Rodrigo Jarque%' OR
				Encabezado like '%Alejandro Fernandez Campillo%' OR
				Encabezado like '%Miguel Angel Torres Cabello%' OR
				Encabezado like '%Miguel Angel Torres%' OR
				Encabezado like '%Maria Lorena Marin Moreno%' OR
				Encabezado like '%Maria Lorena Marin%' OR
				Encabezado like '%Maria Mercedes Colin Guadarrama%' OR
				Encabezado like '%Maria Mercedes Colin%' OR
				Encabezado like '%Maria Marcela Gonzalez Salas y Petricioli%' OR
				Encabezado like '%Marcela Gonzalez Salas y Petricioli%' OR
				Encabezado like '%Marcela Gonzalez Salas%' OR
				Encabezado like '%Maria Marcela Gonzalez Salas%' OR
				Encabezado like '%Maria Marcela Gonzalez%' OR
				Encabezado like '%Paulina Alejandra Del Moral Vela%' OR
				Encabezado like '%Alejandra Del Moral Vela%' OR
				Encabezado like '%Paulina Alejandra Del Moral%' OR
				Encabezado like '%Paulina Alejandra Moral Vela%' OR
				Encabezado like '%Paulina Alejandra Moral%' OR
				Encabezado like '%Gabriel Jaime O`Shea Cuevas%' OR
				Encabezado like '%Jaime O`Shea Cuevas%' OR
				Encabezado like '%Jaime OShea Cuevas%' OR
				Encabezado like '%Gabriel Jaime O`Shea%' OR
				Encabezado like '%Gabriel Jaime OShea Cuevas%' OR
				Encabezado like '%Gabriel Jaime OShea%' OR
				Encabezado like '%Raymundo Martinez Carbajal%' OR
				Encabezado like '%Javier Vargas Zempoaltecatl%' OR
				Encabezado like '%Dario Zacarias Capuchino%' OR
				Encabezado like '%Dario Zacarias%' OR
				Encabezado like '%Zacarias Capuchino%' OR
				Encabezado like '%Jorge Rescala Perez%' OR
				Encabezado like '%Jorge Rescala%' OR
				Encabezado like '%Juan Jaffet Millan Marquez%' OR
				Encabezado like '%Juan Jaffet Millan%' OR
				Encabezado like '%Jaffet Millan%' OR
				Encabezado like '%Jaffet Millan Marquez%' OR
				Encabezado like '%Juan Millan Marquez%' OR
				Encabezado like '%Enrique Jacob Rocha%' OR
				Encabezado like '%Enrique Jacob%' OR
				Encabezado like '%Rodrigo Espeleta Aladro%' OR
				Encabezado like '%Rodrigo Espeleta%' OR
				Encabezado like '%Eriko Flores%' OR
				Encabezado like '%Jorge Perez Zamudio%' OR
				Encabezado like '%Jorge Zamudio%' OR
				Encabezado like '%Francisco Javier Eric Sevilla Montes de Oca%' OR
				Encabezado like '%Francisco Javier Eric Sevilla Montes%' OR
				Encabezado like '%Javier Eric Sevilla Montes de Oca%' OR
				Encabezado like '%Eric Sevilla Montes de Oca%' OR
				Encabezado like '%Eric Sevilla Montes%' OR

				PieFoto like '%Alejandro Ozuna Rivero%' OR
				PieFoto like '%Alejandro Ozuna%' OR
				PieFoto like '%Maribel Cervantes Guerrero%' OR
				PieFoto like '%Maribel Cervantes%' OR
				PieFoto like '%Rodrigo Jarque Lira%' OR
				PieFoto like '%Rodrigo Jarque%' OR
				PieFoto like '%Alejandro Fernandez Campillo%' OR
				PieFoto like '%Miguel Angel Torres Cabello%' OR
				PieFoto like '%Miguel Angel Torres%' OR
				PieFoto like '%Maria Lorena Marin Moreno%' OR
				PieFoto like '%Maria Lorena Marin%' OR
				PieFoto like '%Maria Mercedes Colin Guadarrama%' OR
				PieFoto like '%Maria Mercedes Colin%' OR
				PieFoto like '%Maria Marcela Gonzalez Salas y Petricioli%' OR
				PieFoto like '%Marcela Gonzalez Salas y Petricioli%' OR
				PieFoto like '%Marcela Gonzalez Salas%' OR
				PieFoto like '%Maria Marcela Gonzalez Salas%' OR
				PieFoto like '%Maria Marcela Gonzalez%' OR
				PieFoto like '%Paulina Alejandra Del Moral Vela%' OR
				PieFoto like '%Alejandra Del Moral Vela%' OR
				PieFoto like '%Paulina Alejandra Del Moral%' OR
				PieFoto like '%Paulina Alejandra Moral Vela%' OR
				PieFoto like '%Paulina Alejandra Moral%' OR
				PieFoto like '%Gabriel Jaime O`Shea Cuevas%' OR
				PieFoto like '%Jaime O`Shea Cuevas%' OR
				PieFoto like '%Jaime OShea Cuevas%' OR
				PieFoto like '%Gabriel Jaime O`Shea%' OR
				PieFoto like '%Gabriel Jaime OShea Cuevas%' OR
				PieFoto like '%Gabriel Jaime OShea%' OR
				PieFoto like '%Raymundo Martinez Carbajal%' OR
				PieFoto like '%Javier Vargas Zempoaltecatl%' OR
				PieFoto like '%Dario Zacarias Capuchino%' OR
				PieFoto like '%Dario Zacarias%' OR
				PieFoto like '%Zacarias Capuchino%' OR
				PieFoto like '%Jorge Rescala Perez%' OR
				PieFoto like '%Jorge Rescala%' OR
				PieFoto like '%Juan Jaffet Millan Marquez%' OR
				PieFoto like '%Juan Jaffet Millan%' OR
				PieFoto like '%Jaffet Millan%' OR
				PieFoto like '%Jaffet Millan Marquez%' OR
				PieFoto like '%Juan Millan Marquez%' OR
				PieFoto like '%Enrique Jacob Rocha%' OR
				PieFoto like '%Enrique Jacob%' OR
				PieFoto like '%Rodrigo Espeleta Aladro%' OR
				PieFoto like '%Rodrigo Espeleta%' OR
				PieFoto like '%Eriko Flores%' OR
				PieFoto like '%Jorge Perez Zamudio%' OR
				PieFoto like '%Jorge Zamudio%' OR
				PieFoto like '%Francisco Javier Eric Sevilla Montes de Oca%' OR
				PieFoto like '%Francisco Javier Eric Sevilla Montes%' OR
				PieFoto like '%Javier Eric Sevilla Montes de Oca%' OR
				PieFoto like '%Eric Sevilla Montes de Oca%' OR
				PieFoto like '%Eric Sevilla Montes%'
                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 8:// Adm. Estatal estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Alejandro Ozuna Rivero%' OR
				Texto like '%Alejandro Ozuna%' OR
				Texto like '%Maribel Cervantes Guerrero%' OR
				Texto like '%Maribel Cervantes%' OR
				Texto like '%Rodrigo Jarque Lira%' OR
				Texto like '%Rodrigo Jarque%' OR
				Texto like '%Alejandro Fernandez Campillo%' OR
				Texto like '%Miguel Angel Torres Cabello%' OR
				Texto like '%Miguel Angel Torres%' OR
				Texto like '%Maria Lorena Marin Moreno%' OR
				Texto like '%Maria Lorena Marin%' OR
				Texto like '%Maria Mercedes Colin Guadarrama%' OR
				Texto like '%Maria Mercedes Colin%' OR
				Texto like '%Maria Marcela Gonzalez Salas y Petricioli%' OR
				Texto like '%Marcela Gonzalez Salas y Petricioli%' OR
				Texto like '%Marcela Gonzalez Salas%' OR
				Texto like '%Maria Marcela Gonzalez Salas%' OR
				Texto like '%Maria Marcela Gonzalez%' OR
				Texto like '%Paulina Alejandra Del Moral Vela%' OR
				Texto like '%Alejandra Del Moral Vela%' OR
				Texto like '%Paulina Alejandra Del Moral%' OR
				Texto like '%Paulina Alejandra Moral Vela%' OR
				Texto like '%Paulina Alejandra Moral%' OR
				Texto like '%Gabriel Jaime O`Shea Cuevas%' OR
				Texto like '%Jaime O`Shea Cuevas%' OR
				Texto like '%Jaime OShea Cuevas%' OR
				Texto like '%Gabriel Jaime O`Shea%' OR
				Texto like '%Gabriel Jaime OShea Cuevas%' OR
				Texto like '%Gabriel Jaime OShea%' OR
				Texto like '%Raymundo Martinez Carbajal%' OR
				Texto like '%Javier Vargas Zempoaltecatl%' OR
				Texto like '%Dario Zacarias Capuchino%' OR
				Texto like '%Dario Zacarias%' OR
				Texto like '%Zacarias Capuchino%' OR
				Texto like '%Jorge Rescala Perez%' OR
				Texto like '%Jorge Rescala%' OR
				Texto like '%Juan Jaffet Millan Marquez%' OR
				Texto like '%Juan Jaffet Millan%' OR
				Texto like '%Jaffet Millan%' OR
				Texto like '%Jaffet Millan Marquez%' OR
				Texto like '%Juan Millan Marquez%' OR
				Texto like '%Enrique Jacob Rocha%' OR
				Texto like '%Enrique Jacob%' OR
				Texto like '%Rodrigo Espeleta Aladro%' OR
				Texto like '%Rodrigo Espeleta%' OR
				Texto like '%Eriko Flores%' OR
				Texto like '%Jorge Perez Zamudio%' OR
				Texto like '%Jorge Zamudio%' OR
				Texto like '%Francisco Javier Eric Sevilla Montes de Oca%' OR
				Texto like '%Francisco Javier Eric Sevilla Montes%' OR
				Texto like '%Javier Eric Sevilla Montes de Oca%' OR
				Texto like '%Eric Sevilla Montes de Oca%' OR
				Texto like '%Eric Sevilla Montes%' OR

				Titulo like '%Alejandro Ozuna Rivero%' OR
				Titulo like '%Alejandro Ozuna%' OR
				Titulo like '%Maribel Cervantes Guerrero%' OR
				Titulo like '%Maribel Cervantes%' OR
				Titulo like '%Rodrigo Jarque Lira%' OR
				Titulo like '%Rodrigo Jarque%' OR
				Titulo like '%Alejandro Fernandez Campillo%' OR
				Titulo like '%Miguel Angel Torres Cabello%' OR
				Titulo like '%Miguel Angel Torres%' OR
				Titulo like '%Maria Lorena Marin Moreno%' OR
				Titulo like '%Maria Lorena Marin%' OR
				Titulo like '%Maria Mercedes Colin Guadarrama%' OR
				Titulo like '%Maria Mercedes Colin%' OR
				Titulo like '%Maria Marcela Gonzalez Salas y Petricioli%' OR
				Titulo like '%Marcela Gonzalez Salas y Petricioli%' OR
				Titulo like '%Marcela Gonzalez Salas%' OR
				Titulo like '%Maria Marcela Gonzalez Salas%' OR
				Titulo like '%Maria Marcela Gonzalez%' OR
				Titulo like '%Paulina Alejandra Del Moral Vela%' OR
				Titulo like '%Alejandra Del Moral Vela%' OR
				Titulo like '%Paulina Alejandra Del Moral%' OR
				Titulo like '%Paulina Alejandra Moral Vela%' OR
				Titulo like '%Paulina Alejandra Moral%' OR
				Titulo like '%Gabriel Jaime O`Shea Cuevas%' OR
				Titulo like '%Jaime O`Shea Cuevas%' OR
				Titulo like '%Jaime OShea Cuevas%' OR
				Titulo like '%Gabriel Jaime O`Shea%' OR
				Titulo like '%Gabriel Jaime OShea Cuevas%' OR
				Titulo like '%Gabriel Jaime OShea%' OR
				Titulo like '%Raymundo Martinez Carbajal%' OR
				Titulo like '%Javier Vargas Zempoaltecatl%' OR
				Titulo like '%Dario Zacarias Capuchino%' OR
				Titulo like '%Dario Zacarias%' OR
				Titulo like '%Zacarias Capuchino%' OR
				Titulo like '%Jorge Rescala Perez%' OR
				Titulo like '%Jorge Rescala%' OR
				Titulo like '%Juan Jaffet Millan Marquez%' OR
				Titulo like '%Juan Jaffet Millan%' OR
				Titulo like '%Jaffet Millan%' OR
				Titulo like '%Jaffet Millan Marquez%' OR
				Titulo like '%Juan Millan Marquez%' OR
				Titulo like '%Enrique Jacob Rocha%' OR
				Titulo like '%Enrique Jacob%' OR
				Titulo like '%Rodrigo Espeleta Aladro%' OR
				Titulo like '%Rodrigo Espeleta%' OR
				Titulo like '%Eriko Flores%' OR
				Titulo like '%Jorge Perez Zamudio%' OR
				Titulo like '%Jorge Zamudio%' OR
				Titulo like '%Francisco Javier Eric Sevilla Montes de Oca%' OR
				Titulo like '%Francisco Javier Eric Sevilla Montes%' OR
				Titulo like '%Javier Eric Sevilla Montes de Oca%' OR
				Titulo like '%Eric Sevilla Montes de Oca%' OR
				Titulo like '%Eric Sevilla Montes%' OR

				Encabezado like '%Alejandro Ozuna Rivero%' OR
				Encabezado like '%Alejandro Ozuna%' OR
				Encabezado like '%Maribel Cervantes Guerrero%' OR
				Encabezado like '%Maribel Cervantes%' OR
				Encabezado like '%Rodrigo Jarque Lira%' OR
				Encabezado like '%Rodrigo Jarque%' OR
				Encabezado like '%Alejandro Fernandez Campillo%' OR
				Encabezado like '%Miguel Angel Torres Cabello%' OR
				Encabezado like '%Miguel Angel Torres%' OR
				Encabezado like '%Maria Lorena Marin Moreno%' OR
				Encabezado like '%Maria Lorena Marin%' OR
				Encabezado like '%Maria Mercedes Colin Guadarrama%' OR
				Encabezado like '%Maria Mercedes Colin%' OR
				Encabezado like '%Maria Marcela Gonzalez Salas y Petricioli%' OR
				Encabezado like '%Marcela Gonzalez Salas y Petricioli%' OR
				Encabezado like '%Marcela Gonzalez Salas%' OR
				Encabezado like '%Maria Marcela Gonzalez Salas%' OR
				Encabezado like '%Maria Marcela Gonzalez%' OR
				Encabezado like '%Paulina Alejandra Del Moral Vela%' OR
				Encabezado like '%Alejandra Del Moral Vela%' OR
				Encabezado like '%Paulina Alejandra Del Moral%' OR
				Encabezado like '%Paulina Alejandra Moral Vela%' OR
				Encabezado like '%Paulina Alejandra Moral%' OR
				Encabezado like '%Gabriel Jaime O`Shea Cuevas%' OR
				Encabezado like '%Jaime O`Shea Cuevas%' OR
				Encabezado like '%Jaime OShea Cuevas%' OR
				Encabezado like '%Gabriel Jaime O`Shea%' OR
				Encabezado like '%Gabriel Jaime OShea Cuevas%' OR
				Encabezado like '%Gabriel Jaime OShea%' OR
				Encabezado like '%Raymundo Martinez Carbajal%' OR
				Encabezado like '%Javier Vargas Zempoaltecatl%' OR
				Encabezado like '%Dario Zacarias Capuchino%' OR
				Encabezado like '%Dario Zacarias%' OR
				Encabezado like '%Zacarias Capuchino%' OR
				Encabezado like '%Jorge Rescala Perez%' OR
				Encabezado like '%Jorge Rescala%' OR
				Encabezado like '%Juan Jaffet Millan Marquez%' OR
				Encabezado like '%Juan Jaffet Millan%' OR
				Encabezado like '%Jaffet Millan%' OR
				Encabezado like '%Jaffet Millan Marquez%' OR
				Encabezado like '%Juan Millan Marquez%' OR
				Encabezado like '%Enrique Jacob Rocha%' OR
				Encabezado like '%Enrique Jacob%' OR
				Encabezado like '%Rodrigo Espeleta Aladro%' OR
				Encabezado like '%Rodrigo Espeleta%' OR
				Encabezado like '%Eriko Flores%' OR
				Encabezado like '%Jorge Perez Zamudio%' OR
				Encabezado like '%Jorge Zamudio%' OR
				Encabezado like '%Francisco Javier Eric Sevilla Montes de Oca%' OR
				Encabezado like '%Francisco Javier Eric Sevilla Montes%' OR
				Encabezado like '%Javier Eric Sevilla Montes de Oca%' OR
				Encabezado like '%Eric Sevilla Montes de Oca%' OR
				Encabezado like '%Eric Sevilla Montes%' OR

				PieFoto like '%Alejandro Ozuna Rivero%' OR
				PieFoto like '%Alejandro Ozuna%' OR
				PieFoto like '%Maribel Cervantes Guerrero%' OR
				PieFoto like '%Maribel Cervantes%' OR
				PieFoto like '%Rodrigo Jarque Lira%' OR
				PieFoto like '%Rodrigo Jarque%' OR
				PieFoto like '%Alejandro Fernandez Campillo%' OR
				PieFoto like '%Miguel Angel Torres Cabello%' OR
				PieFoto like '%Miguel Angel Torres%' OR
				PieFoto like '%Maria Lorena Marin Moreno%' OR
				PieFoto like '%Maria Lorena Marin%' OR
				PieFoto like '%Maria Mercedes Colin Guadarrama%' OR
				PieFoto like '%Maria Mercedes Colin%' OR
				PieFoto like '%Maria Marcela Gonzalez Salas y Petricioli%' OR
				PieFoto like '%Marcela Gonzalez Salas y Petricioli%' OR
				PieFoto like '%Marcela Gonzalez Salas%' OR
				PieFoto like '%Maria Marcela Gonzalez Salas%' OR
				PieFoto like '%Maria Marcela Gonzalez%' OR
				PieFoto like '%Paulina Alejandra Del Moral Vela%' OR
				PieFoto like '%Alejandra Del Moral Vela%' OR
				PieFoto like '%Paulina Alejandra Del Moral%' OR
				PieFoto like '%Paulina Alejandra Moral Vela%' OR
				PieFoto like '%Paulina Alejandra Moral%' OR
				PieFoto like '%Gabriel Jaime O`Shea Cuevas%' OR
				PieFoto like '%Jaime O`Shea Cuevas%' OR
				PieFoto like '%Jaime OShea Cuevas%' OR
				PieFoto like '%Gabriel Jaime O`Shea%' OR
				PieFoto like '%Gabriel Jaime OShea Cuevas%' OR
				PieFoto like '%Gabriel Jaime OShea%' OR
				PieFoto like '%Raymundo Martinez Carbajal%' OR
				PieFoto like '%Javier Vargas Zempoaltecatl%' OR
				PieFoto like '%Dario Zacarias Capuchino%' OR
				PieFoto like '%Dario Zacarias%' OR
				PieFoto like '%Zacarias Capuchino%' OR
				PieFoto like '%Jorge Rescala Perez%' OR
				PieFoto like '%Jorge Rescala%' OR
				PieFoto like '%Juan Jaffet Millan Marquez%' OR
				PieFoto like '%Juan Jaffet Millan%' OR
				PieFoto like '%Jaffet Millan%' OR
				PieFoto like '%Jaffet Millan Marquez%' OR
				PieFoto like '%Juan Millan Marquez%' OR
				PieFoto like '%Enrique Jacob Rocha%' OR
				PieFoto like '%Enrique Jacob%' OR
				PieFoto like '%Rodrigo Espeleta Aladro%' OR
				PieFoto like '%Rodrigo Espeleta%' OR
				PieFoto like '%Eriko Flores%' OR
				PieFoto like '%Jorge Perez Zamudio%' OR
				PieFoto like '%Jorge Zamudio%' OR
				PieFoto like '%Francisco Javier Eric Sevilla Montes de Oca%' OR
				PieFoto like '%Francisco Javier Eric Sevilla Montes%' OR
				PieFoto like '%Javier Eric Sevilla Montes de Oca%' OR
				PieFoto like '%Eric Sevilla Montes de Oca%' OR
				PieFoto like '%Eric Sevilla Montes%'
   

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 9://Congreso 
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Francisco agundis arias%' OR
				Texto like '%Francisco agundis%' OR
				Texto like '%agundis arias%' OR
				Texto like '%Brenda Maria Izontli Alvarado Sanchez%' OR
				Texto like '%Brenda Maria Izontli Alvarado%' OR
				Texto like '%Brenda Maria Alvarado Sanchez%' OR
				Texto like '%Brenda Izontli Alvarado Sanchez%' OR
				Texto like '%Brenda Alvarado Sanchez%' OR
				Texto like '%Anuar roberto Azar Figueroa%' OR
				Texto like '%Anuar roberto Azar%' OR
				Texto like '%Anuar  Azar Figueroa%' OR
				Texto like '%Azar Figueroa%' OR
				Texto like '%norma Karina Bastida Guadarrama%' OR
				Texto like '%norma Karina Bastida%' OR
				Texto like '%norma Bastida Guadarrama%' OR
				Texto like '%Bastida Guadarrama%' OR
				Texto like '%Victor Manuel Bautista Lopez%' OR
				Texto like '%Victor Manuel Bautista%' OR
				Texto like '%Victor Bautista Lopez%' OR
				Texto like '%Bautista Lopez%' OR
				Texto like '%Jesus antonio becerril gasca%' OR
				Texto like '%Jesus antonio becerril%' OR
				Texto like '%Jesus becerril gasca%' OR
				Texto like '%becerril gasca%' OR
				Texto like '%Edgar Ignacio Beltran garcia%' OR
				Texto like '%Edgar Ignacio Beltran%' OR
				Texto like '%Edgar Beltran garcia%' OR
				Texto like '%Beltran garcia%' OR
				Texto like '%Sue Ellen Bernal Bolnik%' OR
				Texto like '%Sue Ellen Bernal%' OR
				Texto like '%Sue Bernal Bolnik%' OR
				Texto like '%Bernal Bolnik%' OR
				Texto like '%Martha Angelica Bernardino Rojas%' OR
				Texto like '%Martha Angelica Bernardino%' OR
				Texto like '%Martha Bernardino Rojas%' OR
				Texto like '%Bernardino Rojas%' OR
				Texto like '%Juana Bonilla Jaime%' OR
				Texto like '%Juana Bonilla%' OR
				Texto like '%Leticia Calderon Ramirez%' OR
				Texto like '%Leticia Calderon%' OR
				Texto like '%Calderon Ramirez%' OR
				Texto like '%Araceli Casasola Salazar%' OR
				Texto like '%Araceli Casasola%' OR
				Texto like '%Casasola Salazar%' OR
				Texto like '%Eleazar Centeno Ortiz%' OR
				Texto like '%Eleazar Centeno%' OR
				Texto like '%Inocencio Chavez Resendiz%' OR
				Texto like '%Inocencio Chavez%' OR
				Texto like '%Chavez Resendiz%' OR
				Texto like '%Jacobo David Cheja Alfaro%' OR
				Texto like '%Jacobo David Cheja%' OR
				Texto like '%Jacobo Cheja Alfaro%' OR
				Texto like '%Cheja Alfaro%' OR
				Texto like '%Maria Mercedes Colin Guadarrama%' OR
				Texto like '%Maria Mercedes Colin%' OR
				Texto like '%Maria Colin Guadarrama%' OR
				Texto like '%Colin Guadarrama%' OR
				Texto like '%Aquiles Cortes Lopez%' OR
				Texto like '%Aquiles Cortes%' OR
				Texto like '%Cortes Lopez%' OR
				Texto like '%Marisol Diaz Perez%' OR
				Texto like '%Marisol Diaz%' OR
				Texto like '%Diaz Perez%' OR
				Texto like '%Alberto Diaz Trujillo%' OR
				Texto like '%Alberto Diaz%' OR
				Texto like '%Diaz Trujillo%' OR
				Texto like '%Abel Dominguez Azuz%' OR
				Texto like '%Abel Dominguez%' OR
				Texto like '%Dominguez Azuz%' OR
				Texto like '%Manuel Anthony Dominguez Vargas%' OR
				Texto like '%Manuel Anthony Dominguez%' OR
				Texto like '%Manuel Dominguez Vargas%' OR
				Texto like '%Dominguez Vargas%' OR
				Texto like '%Patricia Elisa Duran Reveles%' OR
				Texto like '%Patricia Elisa Duran%' OR
				Texto like '%Patricia Duran Reveles%' OR
				Texto like '%Duran Reveles%' OR
				Texto like '%Francisco Javier Fernandez Clamont%' OR
				Texto like '%Francisco Javier Fernandez%' OR
				Texto like '%Francisco Fernandez Clamont%' OR
				Texto like '%Fernandez Clamont%' OR
				Texto like '%Josefina Aide Flores Delgado%' OR
				Texto like '%Josefina Aide Flores%' OR
				Texto like '%Josefina Flores Delgado%' OR
				Texto like '%Flores Delgado%' OR
				Texto like '%Victor Hugo Galvez Astorga%' OR
				Texto like '%Victor Hugo Galvez%' OR
				Texto like '%Victor Galvez Astorga%' OR
				Texto like '%Galvez Astorga%' OR
				Texto like '%Raymundo Garza Vilchis%' OR
				Texto like '%Raymundo Garza%' OR
				Texto like '%Garza Vilchis%' OR
				Texto like '%Irazema Gonzalez Martinez Olivares%' OR
				Texto like '%Irazema Gonzalez Martinez%' OR
				Texto like '%Irazema Martinez Olivares%' OR
				Texto like '%Fernando Gonzalez Mejia%' OR
				Texto like '%Fernando Gonzalez%' OR
				Texto like '%Gonzalez Mejia%' OR
				Texto like '%Carolina Berenice Guevara Maupome%' OR
				Texto like '%Carolina Berenice Guevara%' OR
				Texto like '%Carolina Guevara Maupome%' OR
				Texto like '%Guevara Maupome%' OR
				Texto like '%Raymundo Guzman Corrovinas%' OR
				Texto like '%Raymundo Guzman%' OR
				Texto like '%Guzman Corrovinas%' OR
				Texto like '%Ruben Hernandez Magana%' OR
				Texto like '%Ruben Hernandez%' OR
				Texto like '%Hernandez Magana%' OR
				Texto like '%Areli Hernandez Martinez%'	OR
				Texto like '%Areli Hernandez%'	OR
				Texto like '%Vladimir Hernandez Villegas%' OR
				Texto like '%Vladimir Hernandez%' OR
				Texto like '%Jose Antonio Lopez Lozano%' OR
				Texto like '%Jose Antonio Lopez%' OR
				Texto like '%Jose Lopez Lozano%' OR
				Texto like '%Lopez Lozano%' OR
				Texto like '%Raymundo Edgar Martinez Carbajal%' OR
				Texto like '%Raymundo Edgar Martinez%' OR
				Texto like '%Raymundo Martinez Carbajal%' OR
				Texto like '%Martinez Carbajal%' OR
				Texto like '%Beatriz Medina Rangel%' OR
				Texto like '%Medina Rangel%' OR
				Texto like '%Leticia Mejia Garcia%' OR
				Texto like '%Leticia Mejia%' OR
				Texto like '%Sergio Mendiola Sanchez%' OR
				Texto like '%Sergio Mendiola%' OR
				Texto like '%Mendiola Sanchez%' OR
				Texto like '%Nelyda Mocinos Jimenez%' OR
				Texto like '%Nelyda Mocinos%' OR
				Texto like '%Yomali Mondragon Arredondo%' OR
				Texto like '%Yomali Mondragon%' OR
				Texto like '%Perla Guadalupe Monroy Miranda%' OR
				Texto like '%Perla Guadalupe Monroy%' OR
				Texto like '%Perla Monroy Miranda%' OR
				Texto like '%Maria de Lourdes Montiel Paredes%' OR
				Texto like '%Maria de Lourdes Montiel%' OR
				Texto like '%Maria Montiel Paredes%' OR
				Texto like '%Montiel Paredes%' OR
				Texto like '%Jose Isidro Moreno Arcega%' OR
				Texto like '%Jose Isidro Moreno%' OR
				Texto like '%Jose Moreno Arcega%' OR
				Texto like '%Diego Eric Moreno Valle%' OR
				Texto like '%Diego Moreno Valle%' OR
				Texto like '%Diego Eric Moreno Valle%' OR
				Texto like '%Cesar Reynaldo Navarro de Alba%' OR
				Texto like '%Cesar Reynaldo Navarro%' OR
				Texto like '%Navarro de Alba%' OR
				Texto like '%Alejandro Olvera Entzana%' OR
				Texto like '%Alejandro Olvera%' OR
				Texto like '%Olvera Entzana%' OR
				Texto like '%Rafael Osornio Sanchez%' OR
				Texto like '%Rafael Osornio%' OR
				Texto like '%Bertha Padilla Chacon%' OR
				Texto like '%Jesus Pablo Peralta Garcia%' OR
				Texto like '%Jesus Pablo Peralta%' OR
				Texto like '%Jesus Peralta Garcia%' OR
				Texto like '%Peralta Garcia%' OR
				Texto like '%Maria Perez Lopez%' OR
				Texto like '%Arturo Pina Garcia%' OR
				Texto like '%Gerardo Pliego Santana%' OR
				Texto like '%Maria Pozos Parrado%' OR
				Texto like '%Tassio Benjamin Ramirez Hernandez%' OR
				Texto like '%Tassio Benjamin Ramirez%' OR
				Texto like '%Tassio Ramirez Hernandez%' OR
				Texto like '%Ramirez Hernandez%' OR
				Texto like '%Marco Antonio Ramirez Ramirez%' OR
				Texto like '%Marco Antonio Ramirez%' OR
				Texto like '%Ramirez Ramirez%' OR
				Texto like '%Tanya Rellstab Carreto%' OR
				Texto like '%Rellstab Carreto%' OR
				Texto like '%Maria Fernanda Rivera Sanchez%' OR
				Texto like '%Maria Fernanda Rivera%' OR
				Texto like '%Maria Rivera Sanchez%' OR
				Texto like '%Rivera Sanchez%' OR
				Texto like '%Cruz Juvenal Roa Sanchez%' OR
				Texto like '%Cruz Juvenal Roa%' OR
				Texto like '%Cruz Roa Sanchez%' OR
				Texto like '%Roa Sanchez%' OR
				Texto like '%Mario Salcedo Gonzalez%' OR
				Texto like '%Mario Salcedo%' OR
				Texto like '%Salcedo Gonzalez%' OR
				Texto like '%Javier Salinas Narvaez%' OR
				Texto like '%Javier Salinas%' OR
				Texto like '%Salinas Narvaez%' OR
				Texto like '%Miguel Samano Peralta%' OR
				Texto like '%Samano Peralta%' OR
				Texto like '%Roberto Sanchez Campos%' OR
				Texto like '%Sanchez Campos%' OR
				Texto like '%Jesus Sanchez Isidoro%' OR
				Texto like '%Sanchez Isidoro%' OR
				Texto like '%Mirian Sanchez Monsalvo%' OR
				Texto like '%Sanchez Monsalvo%' OR
				Texto like '%Carlos Sanchez Sanchez%' OR
				Texto like '%Lizeth Marlene Sandoval Colindres%' OR
				Texto like '%Lizeth Marlene Sandoval%' OR
				Texto like '%Lizeth Sandoval Colindres%' OR
				Texto like '%Sandoval Colindres%' OR
				Texto like '%Francisco Javier Eric Sevilla Montes De Oca%' OR
				Texto like '%Francisco Javier Eric Sevilla%' OR
				Texto like '%Francisco Javier Sevilla Montes De Oca%' OR
				Texto like '%Francisco Eric Sevilla Montes De Oca%' OR
				Texto like '%Francisco Sevilla Montes De Oca%' OR
				Texto like '%Sevilla Montes De Oca%' OR
				Texto like '%Ivette Topete Garcia%' OR
				Texto like '%Topete Garcia%' OR
				Texto like '%Abel Valle Castillo%' OR
				Texto like '%Valle Castillo%' OR
				Texto like '%Jose Francisco Vazquez Rodriguez%' OR
				Texto like '%Jose Francisco Vazquez%' OR
				Texto like '%Jose Vazquez Rodriguez%' OR
				Texto like '%Vazquez Rodriguez%' OR
				Texto like '%Jorge Omar Velazquez Ruiz%' OR
				Texto like '%Jorge Omar Velazquez%' OR
				Texto like '%Jorge Velazquez Ruiz%' OR
				Texto like '%Velazquez Ruiz%' OR
				Texto like '%oscar Vergara Gomez%' OR
				Texto like '%oscar Vergara%' OR
				Texto like '%Vergara Gomez%' OR
				Texto like '%Miguel Angel Xolalpa Molina%' OR
				Texto like '%Miguel Angel Xolalpa%' OR
				Texto like '%Miguel Xolalpa Molina%' OR
				Texto like '%Xolalpa Molina%' OR
				Texto like '%Eduardo Zarzosa Sanchez%' OR
				Texto like '%Zarzosa Sanchez%' OR
				Texto like '%Juan Zepeda Hernandez%' OR
				Texto like '%Zepeda Hernandez%'

				Titulo like '%Francisco agundis arias%' OR
				Titulo like '%Francisco agundis%' OR
				Titulo like '%agundis arias%' OR
				Titulo like '%Brenda Maria Izontli Alvarado Sanchez%' OR
				Titulo like '%Brenda Maria Izontli Alvarado%' OR
				Titulo like '%Brenda Maria Alvarado Sanchez%' OR
				Titulo like '%Brenda Izontli Alvarado Sanchez%' OR
				Titulo like '%Brenda Alvarado Sanchez%' OR
				Titulo like '%Anuar roberto Azar Figueroa%' OR
				Titulo like '%Anuar roberto Azar%' OR
				Titulo like '%Anuar  Azar Figueroa%' OR
				Titulo like '%Azar Figueroa%' OR
				Titulo like '%norma Karina Bastida Guadarrama%' OR
				Titulo like '%norma Karina Bastida%' OR
				Titulo like '%norma Bastida Guadarrama%' OR
				Titulo like '%Bastida Guadarrama%' OR
				Titulo like '%Victor Manuel Bautista Lopez%' OR
				Titulo like '%Victor Manuel Bautista%' OR
				Titulo like '%Victor Bautista Lopez%' OR
				Titulo like '%Bautista Lopez%' OR
				Titulo like '%Jesus antonio becerril gasca%' OR
				Titulo like '%Jesus antonio becerril%' OR
				Titulo like '%Jesus becerril gasca%' OR
				Titulo like '%becerril gasca%' OR
				Titulo like '%Edgar Ignacio Beltran garcia%' OR
				Titulo like '%Edgar Ignacio Beltran%' OR
				Titulo like '%Edgar Beltran garcia%' OR
				Titulo like '%Beltran garcia%' OR
				Titulo like '%Sue Ellen Bernal Bolnik%' OR
				Titulo like '%Sue Ellen Bernal%' OR
				Titulo like '%Sue Bernal Bolnik%' OR
				Titulo like '%Bernal Bolnik%' OR
				Titulo like '%Martha Angelica Bernardino Rojas%' OR
				Titulo like '%Martha Angelica Bernardino%' OR
				Titulo like '%Martha Bernardino Rojas%' OR
				Titulo like '%Bernardino Rojas%' OR
				Titulo like '%Juana Bonilla Jaime%' OR
				Titulo like '%Juana Bonilla%' OR
				Titulo like '%Leticia Calderon Ramirez%' OR
				Titulo like '%Leticia Calderon%' OR
				Titulo like '%Calderon Ramirez%' OR
				Titulo like '%Araceli Casasola Salazar%' OR
				Titulo like '%Araceli Casasola%' OR
				Titulo like '%Casasola Salazar%' OR
				Titulo like '%Eleazar Centeno Ortiz%' OR
				Titulo like '%Eleazar Centeno%' OR
				Titulo like '%Inocencio Chavez Resendiz%' OR
				Titulo like '%Inocencio Chavez%' OR
				Titulo like '%Chavez Resendiz%' OR
				Titulo like '%Jacobo David Cheja Alfaro%' OR
				Titulo like '%Jacobo David Cheja%' OR
				Titulo like '%Jacobo Cheja Alfaro%' OR
				Titulo like '%Cheja Alfaro%' OR
				Titulo like '%Maria Mercedes Colin Guadarrama%' OR
				Titulo like '%Maria Mercedes Colin%' OR
				Titulo like '%Maria Colin Guadarrama%' OR
				Titulo like '%Colin Guadarrama%' OR
				Titulo like '%Aquiles Cortes Lopez%' OR
				Titulo like '%Aquiles Cortes%' OR
				Titulo like '%Cortes Lopez%' OR
				Titulo like '%Marisol Diaz Perez%' OR
				Titulo like '%Marisol Diaz%' OR
				Titulo like '%Diaz Perez%' OR
				Titulo like '%Alberto Diaz Trujillo%' OR
				Titulo like '%Alberto Diaz%' OR
				Titulo like '%Diaz Trujillo%' OR
				Titulo like '%Abel Dominguez Azuz%' OR
				Titulo like '%Abel Dominguez%' OR
				Titulo like '%Dominguez Azuz%' OR
				Titulo like '%Manuel Anthony Dominguez Vargas%' OR
				Titulo like '%Manuel Anthony Dominguez%' OR
				Titulo like '%Manuel Dominguez Vargas%' OR
				Titulo like '%Dominguez Vargas%' OR
				Titulo like '%Patricia Elisa Duran Reveles%' OR
				Titulo like '%Patricia Elisa Duran%' OR
				Titulo like '%Patricia Duran Reveles%' OR
				Titulo like '%Duran Reveles%' OR
				Titulo like '%Francisco Javier Fernandez Clamont%' OR
				Titulo like '%Francisco Javier Fernandez%' OR
				Titulo like '%Francisco Fernandez Clamont%' OR
				Titulo like '%Fernandez Clamont%' OR
				Titulo like '%Josefina Aide Flores Delgado%' OR
				Titulo like '%Josefina Aide Flores%' OR
				Titulo like '%Josefina Flores Delgado%' OR
				Titulo like '%Flores Delgado%' OR
				Titulo like '%Victor Hugo Galvez Astorga%' OR
				Titulo like '%Victor Hugo Galvez%' OR
				Titulo like '%Victor Galvez Astorga%' OR
				Titulo like '%Galvez Astorga%' OR
				Titulo like '%Raymundo Garza Vilchis%' OR
				Titulo like '%Raymundo Garza%' OR
				Titulo like '%Garza Vilchis%' OR
				Titulo like '%Irazema Gonzalez Martinez Olivares%' OR
				Titulo like '%Irazema Gonzalez Martinez%' OR
				Titulo like '%Irazema Martinez Olivares%' OR
				Titulo like '%Fernando Gonzalez Mejia%' OR
				Titulo like '%Fernando Gonzalez%' OR
				Titulo like '%Gonzalez Mejia%' OR
				Titulo like '%Carolina Berenice Guevara Maupome%' OR
				Titulo like '%Carolina Berenice Guevara%' OR
				Titulo like '%Carolina Guevara Maupome%' OR
				Titulo like '%Guevara Maupome%' OR
				Titulo like '%Raymundo Guzman Corrovinas%' OR
				Titulo like '%Raymundo Guzman%' OR
				Titulo like '%Guzman Corrovinas%' OR
				Titulo like '%Ruben Hernandez Magana%' OR
				Titulo like '%Ruben Hernandez%' OR
				Titulo like '%Hernandez Magana%' OR
				Titulo like '%Areli Hernandez Martinez%'	OR
				Titulo like '%Areli Hernandez%'	OR
				Titulo like '%Vladimir Hernandez Villegas%' OR
				Titulo like '%Vladimir Hernandez%' OR
				Titulo like '%Jose Antonio Lopez Lozano%' OR
				Titulo like '%Jose Antonio Lopez%' OR
				Titulo like '%Jose Lopez Lozano%' OR
				Titulo like '%Lopez Lozano%' OR
				Titulo like '%Raymundo Edgar Martinez Carbajal%' OR
				Titulo like '%Raymundo Edgar Martinez%' OR
				Titulo like '%Raymundo Martinez Carbajal%' OR
				Titulo like '%Martinez Carbajal%' OR
				Titulo like '%Beatriz Medina Rangel%' OR
				Titulo like '%Medina Rangel%' OR
				Titulo like '%Leticia Mejia Garcia%' OR
				Titulo like '%Leticia Mejia%' OR
				Titulo like '%Sergio Mendiola Sanchez%' OR
				Titulo like '%Sergio Mendiola%' OR
				Titulo like '%Mendiola Sanchez%' OR
				Titulo like '%Nelyda Mocinos Jimenez%' OR
				Titulo like '%Nelyda Mocinos%' OR
				Titulo like '%Yomali Mondragon Arredondo%' OR
				Titulo like '%Yomali Mondragon%' OR
				Titulo like '%Perla Guadalupe Monroy Miranda%' OR
				Titulo like '%Perla Guadalupe Monroy%' OR
				Titulo like '%Perla Monroy Miranda%' OR
				Titulo like '%Maria de Lourdes Montiel Paredes%' OR
				Titulo like '%Maria de Lourdes Montiel%' OR
				Titulo like '%Maria Montiel Paredes%' OR
				Titulo like '%Montiel Paredes%' OR
				Titulo like '%Jose Isidro Moreno Arcega%' OR
				Titulo like '%Jose Isidro Moreno%' OR
				Titulo like '%Jose Moreno Arcega%' OR
				Titulo like '%Diego Eric Moreno Valle%' OR
				Titulo like '%Diego Moreno Valle%' OR
				Titulo like '%Diego Eric Moreno Valle%' OR
				Titulo like '%Cesar Reynaldo Navarro de Alba%' OR
				Titulo like '%Cesar Reynaldo Navarro%' OR
				Titulo like '%Navarro de Alba%' OR
				Titulo like '%Alejandro Olvera Entzana%' OR
				Titulo like '%Alejandro Olvera%' OR
				Titulo like '%Olvera Entzana%' OR
				Titulo like '%Rafael Osornio Sanchez%' OR
				Titulo like '%Rafael Osornio%' OR
				Titulo like '%Bertha Padilla Chacon%' OR
				Titulo like '%Jesus Pablo Peralta Garcia%' OR
				Titulo like '%Jesus Pablo Peralta%' OR
				Titulo like '%Jesus Peralta Garcia%' OR
				Titulo like '%Peralta Garcia%' OR
				Titulo like '%Maria Perez Lopez%' OR
				Titulo like '%Arturo Pina Garcia%' OR
				Titulo like '%Gerardo Pliego Santana%' OR
				Titulo like '%Maria Pozos Parrado%' OR
				Titulo like '%Tassio Benjamin Ramirez Hernandez%' OR
				Titulo like '%Tassio Benjamin Ramirez%' OR
				Titulo like '%Tassio Ramirez Hernandez%' OR
				Titulo like '%Ramirez Hernandez%' OR
				Titulo like '%Marco Antonio Ramirez Ramirez%' OR
				Titulo like '%Marco Antonio Ramirez%' OR
				Titulo like '%Ramirez Ramirez%' OR
				Titulo like '%Tanya Rellstab Carreto%' OR
				Titulo like '%Rellstab Carreto%' OR
				Titulo like '%Maria Fernanda Rivera Sanchez%' OR
				Titulo like '%Maria Fernanda Rivera%' OR
				Titulo like '%Maria Rivera Sanchez%' OR
				Titulo like '%Rivera Sanchez%' OR
				Titulo like '%Cruz Juvenal Roa Sanchez%' OR
				Titulo like '%Cruz Juvenal Roa%' OR
				Titulo like '%Cruz Roa Sanchez%' OR
				Titulo like '%Roa Sanchez%' OR
				Titulo like '%Mario Salcedo Gonzalez%' OR
				Titulo like '%Mario Salcedo%' OR
				Titulo like '%Salcedo Gonzalez%' OR
				Titulo like '%Javier Salinas Narvaez%' OR
				Titulo like '%Javier Salinas%' OR
				Titulo like '%Salinas Narvaez%' OR
				Titulo like '%Miguel Samano Peralta%' OR
				Titulo like '%Samano Peralta%' OR
				Titulo like '%Roberto Sanchez Campos%' OR
				Titulo like '%Sanchez Campos%' OR
				Titulo like '%Jesus Sanchez Isidoro%' OR
				Titulo like '%Sanchez Isidoro%' OR
				Titulo like '%Mirian Sanchez Monsalvo%' OR
				Titulo like '%Sanchez Monsalvo%' OR
				Titulo like '%Carlos Sanchez Sanchez%' OR
				Titulo like '%Lizeth Marlene Sandoval Colindres%' OR
				Titulo like '%Lizeth Marlene Sandoval%' OR
				Titulo like '%Lizeth Sandoval Colindres%' OR
				Titulo like '%Sandoval Colindres%' OR
				Titulo like '%Francisco Javier Eric Sevilla Montes De Oca%' OR
				Titulo like '%Francisco Javier Eric Sevilla%' OR
				Titulo like '%Francisco Javier Sevilla Montes De Oca%' OR
				Titulo like '%Francisco Eric Sevilla Montes De Oca%' OR
				Titulo like '%Francisco Sevilla Montes De Oca%' OR
				Titulo like '%Sevilla Montes De Oca%' OR
				Titulo like '%Ivette Topete Garcia%' OR
				Titulo like '%Topete Garcia%' OR
				Titulo like '%Abel Valle Castillo%' OR
				Titulo like '%Valle Castillo%' OR
				Titulo like '%Jose Francisco Vazquez Rodriguez%' OR
				Titulo like '%Jose Francisco Vazquez%' OR
				Titulo like '%Jose Vazquez Rodriguez%' OR
				Titulo like '%Vazquez Rodriguez%' OR
				Titulo like '%Jorge Omar Velazquez Ruiz%' OR
				Titulo like '%Jorge Omar Velazquez%' OR
				Titulo like '%Jorge Velazquez Ruiz%' OR
				Titulo like '%Velazquez Ruiz%' OR
				Titulo like '%oscar Vergara Gomez%' OR
				Titulo like '%oscar Vergara%' OR
				Titulo like '%Vergara Gomez%' OR
				Titulo like '%Miguel Angel Xolalpa Molina%' OR
				Titulo like '%Miguel Angel Xolalpa%' OR
				Titulo like '%Miguel Xolalpa Molina%' OR
				Titulo like '%Xolalpa Molina%' OR
				Titulo like '%Eduardo Zarzosa Sanchez%' OR
				Titulo like '%Zarzosa Sanchez%' OR
				Titulo like '%Juan Zepeda Hernandez%' OR
				Titulo like '%Zepeda Hernandez%' OR

				Encabezado like '%Francisco agundis arias%' OR
				Encabezado like '%Francisco agundis%' OR
				Encabezado like '%agundis arias%' OR
				Encabezado like '%Brenda Maria Izontli Alvarado Sanchez%' OR
				Encabezado like '%Brenda Maria Izontli Alvarado%' OR
				Encabezado like '%Brenda Maria Alvarado Sanchez%' OR
				Encabezado like '%Brenda Izontli Alvarado Sanchez%' OR
				Encabezado like '%Brenda Alvarado Sanchez%' OR
				Encabezado like '%Anuar roberto Azar Figueroa%' OR
				Encabezado like '%Anuar roberto Azar%' OR
				Encabezado like '%Anuar  Azar Figueroa%' OR
				Encabezado like '%Azar Figueroa%' OR
				Encabezado like '%norma Karina Bastida Guadarrama%' OR
				Encabezado like '%norma Karina Bastida%' OR
				Encabezado like '%norma Bastida Guadarrama%' OR
				Encabezado like '%Bastida Guadarrama%' OR
				Encabezado like '%Victor Manuel Bautista Lopez%' OR
				Encabezado like '%Victor Manuel Bautista%' OR
				Encabezado like '%Victor Bautista Lopez%' OR
				Encabezado like '%Bautista Lopez%' OR
				Encabezado like '%Jesus antonio becerril gasca%' OR
				Encabezado like '%Jesus antonio becerril%' OR
				Encabezado like '%Jesus becerril gasca%' OR
				Encabezado like '%becerril gasca%' OR
				Encabezado like '%Edgar Ignacio Beltran garcia%' OR
				Encabezado like '%Edgar Ignacio Beltran%' OR
				Encabezado like '%Edgar Beltran garcia%' OR
				Encabezado like '%Beltran garcia%' OR
				Encabezado like '%Sue Ellen Bernal Bolnik%' OR
				Encabezado like '%Sue Ellen Bernal%' OR
				Encabezado like '%Sue Bernal Bolnik%' OR
				Encabezado like '%Bernal Bolnik%' OR
				Encabezado like '%Martha Angelica Bernardino Rojas%' OR
				Encabezado like '%Martha Angelica Bernardino%' OR
				Encabezado like '%Martha Bernardino Rojas%' OR
				Encabezado like '%Bernardino Rojas%' OR
				Encabezado like '%Juana Bonilla Jaime%' OR
				Encabezado like '%Juana Bonilla%' OR
				Encabezado like '%Leticia Calderon Ramirez%' OR
				Encabezado like '%Leticia Calderon%' OR
				Encabezado like '%Calderon Ramirez%' OR
				Encabezado like '%Araceli Casasola Salazar%' OR
				Encabezado like '%Araceli Casasola%' OR
				Encabezado like '%Casasola Salazar%' OR
				Encabezado like '%Eleazar Centeno Ortiz%' OR
				Encabezado like '%Eleazar Centeno%' OR
				Encabezado like '%Inocencio Chavez Resendiz%' OR
				Encabezado like '%Inocencio Chavez%' OR
				Encabezado like '%Chavez Resendiz%' OR
				Encabezado like '%Jacobo David Cheja Alfaro%' OR
				Encabezado like '%Jacobo David Cheja%' OR
				Encabezado like '%Jacobo Cheja Alfaro%' OR
				Encabezado like '%Cheja Alfaro%' OR
				Encabezado like '%Maria Mercedes Colin Guadarrama%' OR
				Encabezado like '%Maria Mercedes Colin%' OR
				Encabezado like '%Maria Colin Guadarrama%' OR
				Encabezado like '%Colin Guadarrama%' OR
				Encabezado like '%Aquiles Cortes Lopez%' OR
				Encabezado like '%Aquiles Cortes%' OR
				Encabezado like '%Cortes Lopez%' OR
				Encabezado like '%Marisol Diaz Perez%' OR
				Encabezado like '%Marisol Diaz%' OR
				Encabezado like '%Diaz Perez%' OR
				Encabezado like '%Alberto Diaz Trujillo%' OR
				Encabezado like '%Alberto Diaz%' OR
				Encabezado like '%Diaz Trujillo%' OR
				Encabezado like '%Abel Dominguez Azuz%' OR
				Encabezado like '%Abel Dominguez%' OR
				Encabezado like '%Dominguez Azuz%' OR
				Encabezado like '%Manuel Anthony Dominguez Vargas%' OR
				Encabezado like '%Manuel Anthony Dominguez%' OR
				Encabezado like '%Manuel Dominguez Vargas%' OR
				Encabezado like '%Dominguez Vargas%' OR
				Encabezado like '%Patricia Elisa Duran Reveles%' OR
				Encabezado like '%Patricia Elisa Duran%' OR
				Encabezado like '%Patricia Duran Reveles%' OR
				Encabezado like '%Duran Reveles%' OR
				Encabezado like '%Francisco Javier Fernandez Clamont%' OR
				Encabezado like '%Francisco Javier Fernandez%' OR
				Encabezado like '%Francisco Fernandez Clamont%' OR
				Encabezado like '%Fernandez Clamont%' OR
				Encabezado like '%Josefina Aide Flores Delgado%' OR
				Encabezado like '%Josefina Aide Flores%' OR
				Encabezado like '%Josefina Flores Delgado%' OR
				Encabezado like '%Flores Delgado%' OR
				Encabezado like '%Victor Hugo Galvez Astorga%' OR
				Encabezado like '%Victor Hugo Galvez%' OR
				Encabezado like '%Victor Galvez Astorga%' OR
				Encabezado like '%Galvez Astorga%' OR
				Encabezado like '%Raymundo Garza Vilchis%' OR
				Encabezado like '%Raymundo Garza%' OR
				Encabezado like '%Garza Vilchis%' OR
				Encabezado like '%Irazema Gonzalez Martinez Olivares%' OR
				Encabezado like '%Irazema Gonzalez Martinez%' OR
				Encabezado like '%Irazema Martinez Olivares%' OR
				Encabezado like '%Fernando Gonzalez Mejia%' OR
				Encabezado like '%Fernando Gonzalez%' OR
				Encabezado like '%Gonzalez Mejia%' OR
				Encabezado like '%Carolina Berenice Guevara Maupome%' OR
				Encabezado like '%Carolina Berenice Guevara%' OR
				Encabezado like '%Carolina Guevara Maupome%' OR
				Encabezado like '%Guevara Maupome%' OR
				Encabezado like '%Raymundo Guzman Corrovinas%' OR
				Encabezado like '%Raymundo Guzman%' OR
				Encabezado like '%Guzman Corrovinas%' OR
				Encabezado like '%Ruben Hernandez Magana%' OR
				Encabezado like '%Ruben Hernandez%' OR
				Encabezado like '%Hernandez Magana%' OR
				Encabezado like '%Areli Hernandez Martinez%'	OR
				Encabezado like '%Areli Hernandez%'	OR
				Encabezado like '%Vladimir Hernandez Villegas%' OR
				Encabezado like '%Vladimir Hernandez%' OR
				Encabezado like '%Jose Antonio Lopez Lozano%' OR
				Encabezado like '%Jose Antonio Lopez%' OR
				Encabezado like '%Jose Lopez Lozano%' OR
				Encabezado like '%Lopez Lozano%' OR
				Encabezado like '%Raymundo Edgar Martinez Carbajal%' OR
				Encabezado like '%Raymundo Edgar Martinez%' OR
				Encabezado like '%Raymundo Martinez Carbajal%' OR
				Encabezado like '%Martinez Carbajal%' OR
				Encabezado like '%Beatriz Medina Rangel%' OR
				Encabezado like '%Medina Rangel%' OR
				Encabezado like '%Leticia Mejia Garcia%' OR
				Encabezado like '%Leticia Mejia%' OR
				Encabezado like '%Sergio Mendiola Sanchez%' OR
				Encabezado like '%Sergio Mendiola%' OR
				Encabezado like '%Mendiola Sanchez%' OR
				Encabezado like '%Nelyda Mocinos Jimenez%' OR
				Encabezado like '%Nelyda Mocinos%' OR
				Encabezado like '%Yomali Mondragon Arredondo%' OR
				Encabezado like '%Yomali Mondragon%' OR
				Encabezado like '%Perla Guadalupe Monroy Miranda%' OR
				Encabezado like '%Perla Guadalupe Monroy%' OR
				Encabezado like '%Perla Monroy Miranda%' OR
				Encabezado like '%Maria de Lourdes Montiel Paredes%' OR
				Encabezado like '%Maria de Lourdes Montiel%' OR
				Encabezado like '%Maria Montiel Paredes%' OR
				Encabezado like '%Montiel Paredes%' OR
				Encabezado like '%Jose Isidro Moreno Arcega%' OR
				Encabezado like '%Jose Isidro Moreno%' OR
				Encabezado like '%Jose Moreno Arcega%' OR
				Encabezado like '%Diego Eric Moreno Valle%' OR
				Encabezado like '%Diego Moreno Valle%' OR
				Encabezado like '%Diego Eric Moreno Valle%' OR
				Encabezado like '%Cesar Reynaldo Navarro de Alba%' OR
				Encabezado like '%Cesar Reynaldo Navarro%' OR
				Encabezado like '%Navarro de Alba%' OR
				Encabezado like '%Alejandro Olvera Entzana%' OR
				Encabezado like '%Alejandro Olvera%' OR
				Encabezado like '%Olvera Entzana%' OR
				Encabezado like '%Rafael Osornio Sanchez%' OR
				Encabezado like '%Rafael Osornio%' OR
				Encabezado like '%Bertha Padilla Chacon%' OR
				Encabezado like '%Jesus Pablo Peralta Garcia%' OR
				Encabezado like '%Jesus Pablo Peralta%' OR
				Encabezado like '%Jesus Peralta Garcia%' OR
				Encabezado like '%Peralta Garcia%' OR
				Encabezado like '%Maria Perez Lopez%' OR
				Encabezado like '%Arturo Pina Garcia%' OR
				Encabezado like '%Gerardo Pliego Santana%' OR
				Encabezado like '%Maria Pozos Parrado%' OR
				Encabezado like '%Tassio Benjamin Ramirez Hernandez%' OR
				Encabezado like '%Tassio Benjamin Ramirez%' OR
				Encabezado like '%Tassio Ramirez Hernandez%' OR
				Encabezado like '%Ramirez Hernandez%' OR
				Encabezado like '%Marco Antonio Ramirez Ramirez%' OR
				Encabezado like '%Marco Antonio Ramirez%' OR
				Encabezado like '%Ramirez Ramirez%' OR
				Encabezado like '%Tanya Rellstab Carreto%' OR
				Encabezado like '%Rellstab Carreto%' OR
				Encabezado like '%Maria Fernanda Rivera Sanchez%' OR
				Encabezado like '%Maria Fernanda Rivera%' OR
				Encabezado like '%Maria Rivera Sanchez%' OR
				Encabezado like '%Rivera Sanchez%' OR
				Encabezado like '%Cruz Juvenal Roa Sanchez%' OR
				Encabezado like '%Cruz Juvenal Roa%' OR
				Encabezado like '%Cruz Roa Sanchez%' OR
				Encabezado like '%Roa Sanchez%' OR
				Encabezado like '%Mario Salcedo Gonzalez%' OR
				Encabezado like '%Mario Salcedo%' OR
				Encabezado like '%Salcedo Gonzalez%' OR
				Encabezado like '%Javier Salinas Narvaez%' OR
				Encabezado like '%Javier Salinas%' OR
				Encabezado like '%Salinas Narvaez%' OR
				Encabezado like '%Miguel Samano Peralta%' OR
				Encabezado like '%Samano Peralta%' OR
				Encabezado like '%Roberto Sanchez Campos%' OR
				Encabezado like '%Sanchez Campos%' OR
				Encabezado like '%Jesus Sanchez Isidoro%' OR
				Encabezado like '%Sanchez Isidoro%' OR
				Encabezado like '%Mirian Sanchez Monsalvo%' OR
				Encabezado like '%Sanchez Monsalvo%' OR
				Encabezado like '%Carlos Sanchez Sanchez%' OR
				Encabezado like '%Lizeth Marlene Sandoval Colindres%' OR
				Encabezado like '%Lizeth Marlene Sandoval%' OR
				Encabezado like '%Lizeth Sandoval Colindres%' OR
				Encabezado like '%Sandoval Colindres%' OR
				Encabezado like '%Francisco Javier Eric Sevilla Montes De Oca%' OR
				Encabezado like '%Francisco Javier Eric Sevilla%' OR
				Encabezado like '%Francisco Javier Sevilla Montes De Oca%' OR
				Encabezado like '%Francisco Eric Sevilla Montes De Oca%' OR
				Encabezado like '%Francisco Sevilla Montes De Oca%' OR
				Encabezado like '%Sevilla Montes De Oca%' OR
				Encabezado like '%Ivette Topete Garcia%' OR
				Encabezado like '%Topete Garcia%' OR
				Encabezado like '%Abel Valle Castillo%' OR
				Encabezado like '%Valle Castillo%' OR
				Encabezado like '%Jose Francisco Vazquez Rodriguez%' OR
				Encabezado like '%Jose Francisco Vazquez%' OR
				Encabezado like '%Jose Vazquez Rodriguez%' OR
				Encabezado like '%Vazquez Rodriguez%' OR
				Encabezado like '%Jorge Omar Velazquez Ruiz%' OR
				Encabezado like '%Jorge Omar Velazquez%' OR
				Encabezado like '%Jorge Velazquez Ruiz%' OR
				Encabezado like '%Velazquez Ruiz%' OR
				Encabezado like '%oscar Vergara Gomez%' OR
				Encabezado like '%oscar Vergara%' OR
				Encabezado like '%Vergara Gomez%' OR
				Encabezado like '%Miguel Angel Xolalpa Molina%' OR
				Encabezado like '%Miguel Angel Xolalpa%' OR
				Encabezado like '%Miguel Xolalpa Molina%' OR
				Encabezado like '%Xolalpa Molina%' OR
				Encabezado like '%Eduardo Zarzosa Sanchez%' OR
				Encabezado like '%Zarzosa Sanchez%' OR
				Encabezado like '%Juan Zepeda Hernandez%' OR
				Encabezado like '%Zepeda Hernandez%' OR

				PieFoto like '%Francisco agundis arias%' OR
				PieFoto like '%Francisco agundis%' OR
				PieFoto like '%agundis arias%' OR
				PieFoto like '%Brenda Maria Izontli Alvarado Sanchez%' OR
				PieFoto like '%Brenda Maria Izontli Alvarado%' OR
				PieFoto like '%Brenda Maria Alvarado Sanchez%' OR
				PieFoto like '%Brenda Izontli Alvarado Sanchez%' OR
				PieFoto like '%Brenda Alvarado Sanchez%' OR
				PieFoto like '%Anuar roberto Azar Figueroa%' OR
				PieFoto like '%Anuar roberto Azar%' OR
				PieFoto like '%Anuar  Azar Figueroa%' OR
				PieFoto like '%Azar Figueroa%' OR
				PieFoto like '%norma Karina Bastida Guadarrama%' OR
				PieFoto like '%norma Karina Bastida%' OR
				PieFoto like '%norma Bastida Guadarrama%' OR
				PieFoto like '%Bastida Guadarrama%' OR
				PieFoto like '%Victor Manuel Bautista Lopez%' OR
				PieFoto like '%Victor Manuel Bautista%' OR
				PieFoto like '%Victor Bautista Lopez%' OR
				PieFoto like '%Bautista Lopez%' OR
				PieFoto like '%Jesus antonio becerril gasca%' OR
				PieFoto like '%Jesus antonio becerril%' OR
				PieFoto like '%Jesus becerril gasca%' OR
				PieFoto like '%becerril gasca%' OR
				PieFoto like '%Edgar Ignacio Beltran garcia%' OR
				PieFoto like '%Edgar Ignacio Beltran%' OR
				PieFoto like '%Edgar Beltran garcia%' OR
				PieFoto like '%Beltran garcia%' OR
				PieFoto like '%Sue Ellen Bernal Bolnik%' OR
				PieFoto like '%Sue Ellen Bernal%' OR
				PieFoto like '%Sue Bernal Bolnik%' OR
				PieFoto like '%Bernal Bolnik%' OR
				PieFoto like '%Martha Angelica Bernardino Rojas%' OR
				PieFoto like '%Martha Angelica Bernardino%' OR
				PieFoto like '%Martha Bernardino Rojas%' OR
				PieFoto like '%Bernardino Rojas%' OR
				PieFoto like '%Juana Bonilla Jaime%' OR
				PieFoto like '%Juana Bonilla%' OR
				PieFoto like '%Leticia Calderon Ramirez%' OR
				PieFoto like '%Leticia Calderon%' OR
				PieFoto like '%Calderon Ramirez%' OR
				PieFoto like '%Araceli Casasola Salazar%' OR
				PieFoto like '%Araceli Casasola%' OR
				PieFoto like '%Casasola Salazar%' OR
				PieFoto like '%Eleazar Centeno Ortiz%' OR
				PieFoto like '%Eleazar Centeno%' OR
				PieFoto like '%Inocencio Chavez Resendiz%' OR
				PieFoto like '%Inocencio Chavez%' OR
				PieFoto like '%Chavez Resendiz%' OR
				PieFoto like '%Jacobo David Cheja Alfaro%' OR
				PieFoto like '%Jacobo David Cheja%' OR
				PieFoto like '%Jacobo Cheja Alfaro%' OR
				PieFoto like '%Cheja Alfaro%' OR
				PieFoto like '%Maria Mercedes Colin Guadarrama%' OR
				PieFoto like '%Maria Mercedes Colin%' OR
				PieFoto like '%Maria Colin Guadarrama%' OR
				PieFoto like '%Colin Guadarrama%' OR
				PieFoto like '%Aquiles Cortes Lopez%' OR
				PieFoto like '%Aquiles Cortes%' OR
				PieFoto like '%Cortes Lopez%' OR
				PieFoto like '%Marisol Diaz Perez%' OR
				PieFoto like '%Marisol Diaz%' OR
				PieFoto like '%Diaz Perez%' OR
				PieFoto like '%Alberto Diaz Trujillo%' OR
				PieFoto like '%Alberto Diaz%' OR
				PieFoto like '%Diaz Trujillo%' OR
				PieFoto like '%Abel Dominguez Azuz%' OR
				PieFoto like '%Abel Dominguez%' OR
				PieFoto like '%Dominguez Azuz%' OR
				PieFoto like '%Manuel Anthony Dominguez Vargas%' OR
				PieFoto like '%Manuel Anthony Dominguez%' OR
				PieFoto like '%Manuel Dominguez Vargas%' OR
				PieFoto like '%Dominguez Vargas%' OR
				PieFoto like '%Patricia Elisa Duran Reveles%' OR
				PieFoto like '%Patricia Elisa Duran%' OR
				PieFoto like '%Patricia Duran Reveles%' OR
				PieFoto like '%Duran Reveles%' OR
				PieFoto like '%Francisco Javier Fernandez Clamont%' OR
				PieFoto like '%Francisco Javier Fernandez%' OR
				PieFoto like '%Francisco Fernandez Clamont%' OR
				PieFoto like '%Fernandez Clamont%' OR
				PieFoto like '%Josefina Aide Flores Delgado%' OR
				PieFoto like '%Josefina Aide Flores%' OR
				PieFoto like '%Josefina Flores Delgado%' OR
				PieFoto like '%Flores Delgado%' OR
				PieFoto like '%Victor Hugo Galvez Astorga%' OR
				PieFoto like '%Victor Hugo Galvez%' OR
				PieFoto like '%Victor Galvez Astorga%' OR
				PieFoto like '%Galvez Astorga%' OR
				PieFoto like '%Raymundo Garza Vilchis%' OR
				PieFoto like '%Raymundo Garza%' OR
				PieFoto like '%Garza Vilchis%' OR
				PieFoto like '%Irazema Gonzalez Martinez Olivares%' OR
				PieFoto like '%Irazema Gonzalez Martinez%' OR
				PieFoto like '%Irazema Martinez Olivares%' OR
				PieFoto like '%Fernando Gonzalez Mejia%' OR
				PieFoto like '%Fernando Gonzalez%' OR
				PieFoto like '%Gonzalez Mejia%' OR
				PieFoto like '%Carolina Berenice Guevara Maupome%' OR
				PieFoto like '%Carolina Berenice Guevara%' OR
				PieFoto like '%Carolina Guevara Maupome%' OR
				PieFoto like '%Guevara Maupome%' OR
				PieFoto like '%Raymundo Guzman Corrovinas%' OR
				PieFoto like '%Raymundo Guzman%' OR
				PieFoto like '%Guzman Corrovinas%' OR
				PieFoto like '%Ruben Hernandez Magana%' OR
				PieFoto like '%Ruben Hernandez%' OR
				PieFoto like '%Hernandez Magana%' OR
				PieFoto like '%Areli Hernandez Martinez%'	OR
				PieFoto like '%Areli Hernandez%'	OR
				PieFoto like '%Vladimir Hernandez Villegas%' OR
				PieFoto like '%Vladimir Hernandez%' OR
				PieFoto like '%Jose Antonio Lopez Lozano%' OR
				PieFoto like '%Jose Antonio Lopez%' OR
				PieFoto like '%Jose Lopez Lozano%' OR
				PieFoto like '%Lopez Lozano%' OR
				PieFoto like '%Raymundo Edgar Martinez Carbajal%' OR
				PieFoto like '%Raymundo Edgar Martinez%' OR
				PieFoto like '%Raymundo Martinez Carbajal%' OR
				PieFoto like '%Martinez Carbajal%' OR
				PieFoto like '%Beatriz Medina Rangel%' OR
				PieFoto like '%Medina Rangel%' OR
				PieFoto like '%Leticia Mejia Garcia%' OR
				PieFoto like '%Leticia Mejia%' OR
				PieFoto like '%Sergio Mendiola Sanchez%' OR
				PieFoto like '%Sergio Mendiola%' OR
				PieFoto like '%Mendiola Sanchez%' OR
				PieFoto like '%Nelyda Mocinos Jimenez%' OR
				PieFoto like '%Nelyda Mocinos%' OR
				PieFoto like '%Yomali Mondragon Arredondo%' OR
				PieFoto like '%Yomali Mondragon%' OR
				PieFoto like '%Perla Guadalupe Monroy Miranda%' OR
				PieFoto like '%Perla Guadalupe Monroy%' OR
				PieFoto like '%Perla Monroy Miranda%' OR
				PieFoto like '%Maria de Lourdes Montiel Paredes%' OR
				PieFoto like '%Maria de Lourdes Montiel%' OR
				PieFoto like '%Maria Montiel Paredes%' OR
				PieFoto like '%Montiel Paredes%' OR
				PieFoto like '%Jose Isidro Moreno Arcega%' OR
				PieFoto like '%Jose Isidro Moreno%' OR
				PieFoto like '%Jose Moreno Arcega%' OR
				PieFoto like '%Diego Eric Moreno Valle%' OR
				PieFoto like '%Diego Moreno Valle%' OR
				PieFoto like '%Diego Eric Moreno Valle%' OR
				PieFoto like '%Cesar Reynaldo Navarro de Alba%' OR
				PieFoto like '%Cesar Reynaldo Navarro%' OR
				PieFoto like '%Navarro de Alba%' OR
				PieFoto like '%Alejandro Olvera Entzana%' OR
				PieFoto like '%Alejandro Olvera%' OR
				PieFoto like '%Olvera Entzana%' OR
				PieFoto like '%Rafael Osornio Sanchez%' OR
				PieFoto like '%Rafael Osornio%' OR
				PieFoto like '%Bertha Padilla Chacon%' OR
				PieFoto like '%Jesus Pablo Peralta Garcia%' OR
				PieFoto like '%Jesus Pablo Peralta%' OR
				PieFoto like '%Jesus Peralta Garcia%' OR
				PieFoto like '%Peralta Garcia%' OR
				PieFoto like '%Maria Perez Lopez%' OR
				PieFoto like '%Arturo Pina Garcia%' OR
				PieFoto like '%Gerardo Pliego Santana%' OR
				PieFoto like '%Maria Pozos Parrado%' OR
				PieFoto like '%Tassio Benjamin Ramirez Hernandez%' OR
				PieFoto like '%Tassio Benjamin Ramirez%' OR
				PieFoto like '%Tassio Ramirez Hernandez%' OR
				PieFoto like '%Ramirez Hernandez%' OR
				PieFoto like '%Marco Antonio Ramirez Ramirez%' OR
				PieFoto like '%Marco Antonio Ramirez%' OR
				PieFoto like '%Ramirez Ramirez%' OR
				PieFoto like '%Tanya Rellstab Carreto%' OR
				PieFoto like '%Rellstab Carreto%' OR
				PieFoto like '%Maria Fernanda Rivera Sanchez%' OR
				PieFoto like '%Maria Fernanda Rivera%' OR
				PieFoto like '%Maria Rivera Sanchez%' OR
				PieFoto like '%Rivera Sanchez%' OR
				PieFoto like '%Cruz Juvenal Roa Sanchez%' OR
				PieFoto like '%Cruz Juvenal Roa%' OR
				PieFoto like '%Cruz Roa Sanchez%' OR
				PieFoto like '%Roa Sanchez%' OR
				PieFoto like '%Mario Salcedo Gonzalez%' OR
				PieFoto like '%Mario Salcedo%' OR
				PieFoto like '%Salcedo Gonzalez%' OR
				PieFoto like '%Javier Salinas Narvaez%' OR
				PieFoto like '%Javier Salinas%' OR
				PieFoto like '%Salinas Narvaez%' OR
				PieFoto like '%Miguel Samano Peralta%' OR
				PieFoto like '%Samano Peralta%' OR
				PieFoto like '%Roberto Sanchez Campos%' OR
				PieFoto like '%Sanchez Campos%' OR
				PieFoto like '%Jesus Sanchez Isidoro%' OR
				PieFoto like '%Sanchez Isidoro%' OR
				PieFoto like '%Mirian Sanchez Monsalvo%' OR
				PieFoto like '%Sanchez Monsalvo%' OR
				PieFoto like '%Carlos Sanchez Sanchez%' OR
				PieFoto like '%Lizeth Marlene Sandoval Colindres%' OR
				PieFoto like '%Lizeth Marlene Sandoval%' OR
				PieFoto like '%Lizeth Sandoval Colindres%' OR
				PieFoto like '%Sandoval Colindres%' OR
				PieFoto like '%Francisco Javier Eric Sevilla Montes De Oca%' OR
				PieFoto like '%Francisco Javier Eric Sevilla%' OR
				PieFoto like '%Francisco Javier Sevilla Montes De Oca%' OR
				PieFoto like '%Francisco Eric Sevilla Montes De Oca%' OR
				PieFoto like '%Francisco Sevilla Montes De Oca%' OR
				PieFoto like '%Sevilla Montes De Oca%' OR
				PieFoto like '%Ivette Topete Garcia%' OR
				PieFoto like '%Topete Garcia%' OR
				PieFoto like '%Abel Valle Castillo%' OR
				PieFoto like '%Valle Castillo%' OR
				PieFoto like '%Jose Francisco Vazquez Rodriguez%' OR
				PieFoto like '%Jose Francisco Vazquez%' OR
				PieFoto like '%Jose Vazquez Rodriguez%' OR
				PieFoto like '%Vazquez Rodriguez%' OR
				PieFoto like '%Jorge Omar Velazquez Ruiz%' OR
				PieFoto like '%Jorge Omar Velazquez%' OR
				PieFoto like '%Jorge Velazquez Ruiz%' OR
				PieFoto like '%Velazquez Ruiz%' OR
				PieFoto like '%oscar Vergara Gomez%' OR
				PieFoto like '%oscar Vergara%' OR
				PieFoto like '%Vergara Gomez%' OR
				PieFoto like '%Miguel Angel Xolalpa Molina%' OR
				PieFoto like '%Miguel Angel Xolalpa%' OR
				PieFoto like '%Miguel Xolalpa Molina%' OR
				PieFoto like '%Xolalpa Molina%' OR
				PieFoto like '%Eduardo Zarzosa Sanchez%' OR
				PieFoto like '%Zarzosa Sanchez%' OR
				PieFoto like '%Juan Zepeda Hernandez%' OR
				PieFoto like '%Zepeda Hernandez%'

                            ) AND


                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 10:// Congreso Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Francisco agundis arias%' OR
				Texto like '%Francisco agundis%' OR
				Texto like '%agundis arias%' OR
				Texto like '%Brenda Maria Izontli Alvarado Sanchez%' OR
				Texto like '%Brenda Maria Izontli Alvarado%' OR
				Texto like '%Brenda Maria Alvarado Sanchez%' OR
				Texto like '%Brenda Izontli Alvarado Sanchez%' OR
				Texto like '%Brenda Alvarado Sanchez%' OR
				Texto like '%Anuar roberto Azar Figueroa%' OR
				Texto like '%Anuar roberto Azar%' OR
				Texto like '%Anuar  Azar Figueroa%' OR
				Texto like '%Azar Figueroa%' OR
				Texto like '%norma Karina Bastida Guadarrama%' OR
				Texto like '%norma Karina Bastida%' OR
				Texto like '%norma Bastida Guadarrama%' OR
				Texto like '%Bastida Guadarrama%' OR
				Texto like '%Victor Manuel Bautista Lopez%' OR
				Texto like '%Victor Manuel Bautista%' OR
				Texto like '%Victor Bautista Lopez%' OR
				Texto like '%Bautista Lopez%' OR
				Texto like '%Jesus antonio becerril gasca%' OR
				Texto like '%Jesus antonio becerril%' OR
				Texto like '%Jesus becerril gasca%' OR
				Texto like '%becerril gasca%' OR
				Texto like '%Edgar Ignacio Beltran garcia%' OR
				Texto like '%Edgar Ignacio Beltran%' OR
				Texto like '%Edgar Beltran garcia%' OR
				Texto like '%Beltran garcia%' OR
				Texto like '%Sue Ellen Bernal Bolnik%' OR
				Texto like '%Sue Ellen Bernal%' OR
				Texto like '%Sue Bernal Bolnik%' OR
				Texto like '%Bernal Bolnik%' OR
				Texto like '%Martha Angelica Bernardino Rojas%' OR
				Texto like '%Martha Angelica Bernardino%' OR
				Texto like '%Martha Bernardino Rojas%' OR
				Texto like '%Bernardino Rojas%' OR
				Texto like '%Juana Bonilla Jaime%' OR
				Texto like '%Juana Bonilla%' OR
				Texto like '%Leticia Calderon Ramirez%' OR
				Texto like '%Leticia Calderon%' OR
				Texto like '%Calderon Ramirez%' OR
				Texto like '%Araceli Casasola Salazar%' OR
				Texto like '%Araceli Casasola%' OR
				Texto like '%Casasola Salazar%' OR
				Texto like '%Eleazar Centeno Ortiz%' OR
				Texto like '%Eleazar Centeno%' OR
				Texto like '%Inocencio Chavez Resendiz%' OR
				Texto like '%Inocencio Chavez%' OR
				Texto like '%Chavez Resendiz%' OR
				Texto like '%Jacobo David Cheja Alfaro%' OR
				Texto like '%Jacobo David Cheja%' OR
				Texto like '%Jacobo Cheja Alfaro%' OR
				Texto like '%Cheja Alfaro%' OR
				Texto like '%Maria Mercedes Colin Guadarrama%' OR
				Texto like '%Maria Mercedes Colin%' OR
				Texto like '%Maria Colin Guadarrama%' OR
				Texto like '%Colin Guadarrama%' OR
				Texto like '%Aquiles Cortes Lopez%' OR
				Texto like '%Aquiles Cortes%' OR
				Texto like '%Cortes Lopez%' OR
				Texto like '%Marisol Diaz Perez%' OR
				Texto like '%Marisol Diaz%' OR
				Texto like '%Diaz Perez%' OR
				Texto like '%Alberto Diaz Trujillo%' OR
				Texto like '%Alberto Diaz%' OR
				Texto like '%Diaz Trujillo%' OR
				Texto like '%Abel Dominguez Azuz%' OR
				Texto like '%Abel Dominguez%' OR
				Texto like '%Dominguez Azuz%' OR
				Texto like '%Manuel Anthony Dominguez Vargas%' OR
				Texto like '%Manuel Anthony Dominguez%' OR
				Texto like '%Manuel Dominguez Vargas%' OR
				Texto like '%Dominguez Vargas%' OR
				Texto like '%Patricia Elisa Duran Reveles%' OR
				Texto like '%Patricia Elisa Duran%' OR
				Texto like '%Patricia Duran Reveles%' OR
				Texto like '%Duran Reveles%' OR
				Texto like '%Francisco Javier Fernandez Clamont%' OR
				Texto like '%Francisco Javier Fernandez%' OR
				Texto like '%Francisco Fernandez Clamont%' OR
				Texto like '%Fernandez Clamont%' OR
				Texto like '%Josefina Aide Flores Delgado%' OR
				Texto like '%Josefina Aide Flores%' OR
				Texto like '%Josefina Flores Delgado%' OR
				Texto like '%Flores Delgado%' OR
				Texto like '%Victor Hugo Galvez Astorga%' OR
				Texto like '%Victor Hugo Galvez%' OR
				Texto like '%Victor Galvez Astorga%' OR
				Texto like '%Galvez Astorga%' OR
				Texto like '%Raymundo Garza Vilchis%' OR
				Texto like '%Raymundo Garza%' OR
				Texto like '%Garza Vilchis%' OR
				Texto like '%Irazema Gonzalez Martinez Olivares%' OR
				Texto like '%Irazema Gonzalez Martinez%' OR
				Texto like '%Irazema Martinez Olivares%' OR
				Texto like '%Fernando Gonzalez Mejia%' OR
				Texto like '%Fernando Gonzalez%' OR
				Texto like '%Gonzalez Mejia%' OR
				Texto like '%Carolina Berenice Guevara Maupome%' OR
				Texto like '%Carolina Berenice Guevara%' OR
				Texto like '%Carolina Guevara Maupome%' OR
				Texto like '%Guevara Maupome%' OR
				Texto like '%Raymundo Guzman Corrovinas%' OR
				Texto like '%Raymundo Guzman%' OR
				Texto like '%Guzman Corrovinas%' OR
				Texto like '%Ruben Hernandez Magana%' OR
				Texto like '%Ruben Hernandez%' OR
				Texto like '%Hernandez Magana%' OR
				Texto like '%Areli Hernandez Martinez%'	OR
				Texto like '%Areli Hernandez%'	OR
				Texto like '%Vladimir Hernandez Villegas%' OR
				Texto like '%Vladimir Hernandez%' OR
				Texto like '%Jose Antonio Lopez Lozano%' OR
				Texto like '%Jose Antonio Lopez%' OR
				Texto like '%Jose Lopez Lozano%' OR
				Texto like '%Lopez Lozano%' OR
				Texto like '%Raymundo Edgar Martinez Carbajal%' OR
				Texto like '%Raymundo Edgar Martinez%' OR
				Texto like '%Raymundo Martinez Carbajal%' OR
				Texto like '%Martinez Carbajal%' OR
				Texto like '%Beatriz Medina Rangel%' OR
				Texto like '%Medina Rangel%' OR
				Texto like '%Leticia Mejia Garcia%' OR
				Texto like '%Leticia Mejia%' OR
				Texto like '%Sergio Mendiola Sanchez%' OR
				Texto like '%Sergio Mendiola%' OR
				Texto like '%Mendiola Sanchez%' OR
				Texto like '%Nelyda Mocinos Jimenez%' OR
				Texto like '%Nelyda Mocinos%' OR
				Texto like '%Yomali Mondragon Arredondo%' OR
				Texto like '%Yomali Mondragon%' OR
				Texto like '%Perla Guadalupe Monroy Miranda%' OR
				Texto like '%Perla Guadalupe Monroy%' OR
				Texto like '%Perla Monroy Miranda%' OR
				Texto like '%Maria de Lourdes Montiel Paredes%' OR
				Texto like '%Maria de Lourdes Montiel%' OR
				Texto like '%Maria Montiel Paredes%' OR
				Texto like '%Montiel Paredes%' OR
				Texto like '%Jose Isidro Moreno Arcega%' OR
				Texto like '%Jose Isidro Moreno%' OR
				Texto like '%Jose Moreno Arcega%' OR
				Texto like '%Diego Eric Moreno Valle%' OR
				Texto like '%Diego Moreno Valle%' OR
				Texto like '%Diego Eric Moreno Valle%' OR
				Texto like '%Cesar Reynaldo Navarro de Alba%' OR
				Texto like '%Cesar Reynaldo Navarro%' OR
				Texto like '%Navarro de Alba%' OR
				Texto like '%Alejandro Olvera Entzana%' OR
				Texto like '%Alejandro Olvera%' OR
				Texto like '%Olvera Entzana%' OR
				Texto like '%Rafael Osornio Sanchez%' OR
				Texto like '%Rafael Osornio%' OR
				Texto like '%Bertha Padilla Chacon%' OR
				Texto like '%Jesus Pablo Peralta Garcia%' OR
				Texto like '%Jesus Pablo Peralta%' OR
				Texto like '%Jesus Peralta Garcia%' OR
				Texto like '%Peralta Garcia%' OR
				Texto like '%Maria Perez Lopez%' OR
				Texto like '%Arturo Pina Garcia%' OR
				Texto like '%Gerardo Pliego Santana%' OR
				Texto like '%Maria Pozos Parrado%' OR
				Texto like '%Tassio Benjamin Ramirez Hernandez%' OR
				Texto like '%Tassio Benjamin Ramirez%' OR
				Texto like '%Tassio Ramirez Hernandez%' OR
				Texto like '%Ramirez Hernandez%' OR
				Texto like '%Marco Antonio Ramirez Ramirez%' OR
				Texto like '%Marco Antonio Ramirez%' OR
				Texto like '%Ramirez Ramirez%' OR
				Texto like '%Tanya Rellstab Carreto%' OR
				Texto like '%Rellstab Carreto%' OR
				Texto like '%Maria Fernanda Rivera Sanchez%' OR
				Texto like '%Maria Fernanda Rivera%' OR
				Texto like '%Maria Rivera Sanchez%' OR
				Texto like '%Rivera Sanchez%' OR
				Texto like '%Cruz Juvenal Roa Sanchez%' OR
				Texto like '%Cruz Juvenal Roa%' OR
				Texto like '%Cruz Roa Sanchez%' OR
				Texto like '%Roa Sanchez%' OR
				Texto like '%Mario Salcedo Gonzalez%' OR
				Texto like '%Mario Salcedo%' OR
				Texto like '%Salcedo Gonzalez%' OR
				Texto like '%Javier Salinas Narvaez%' OR
				Texto like '%Javier Salinas%' OR
				Texto like '%Salinas Narvaez%' OR
				Texto like '%Miguel Samano Peralta%' OR
				Texto like '%Samano Peralta%' OR
				Texto like '%Roberto Sanchez Campos%' OR
				Texto like '%Sanchez Campos%' OR
				Texto like '%Jesus Sanchez Isidoro%' OR
				Texto like '%Sanchez Isidoro%' OR
				Texto like '%Mirian Sanchez Monsalvo%' OR
				Texto like '%Sanchez Monsalvo%' OR
				Texto like '%Carlos Sanchez Sanchez%' OR
				Texto like '%Lizeth Marlene Sandoval Colindres%' OR
				Texto like '%Lizeth Marlene Sandoval%' OR
				Texto like '%Lizeth Sandoval Colindres%' OR
				Texto like '%Sandoval Colindres%' OR
				Texto like '%Francisco Javier Eric Sevilla Montes De Oca%' OR
				Texto like '%Francisco Javier Eric Sevilla%' OR
				Texto like '%Francisco Javier Sevilla Montes De Oca%' OR
				Texto like '%Francisco Eric Sevilla Montes De Oca%' OR
				Texto like '%Francisco Sevilla Montes De Oca%' OR
				Texto like '%Sevilla Montes De Oca%' OR
				Texto like '%Ivette Topete Garcia%' OR
				Texto like '%Topete Garcia%' OR
				Texto like '%Abel Valle Castillo%' OR
				Texto like '%Valle Castillo%' OR
				Texto like '%Jose Francisco Vazquez Rodriguez%' OR
				Texto like '%Jose Francisco Vazquez%' OR
				Texto like '%Jose Vazquez Rodriguez%' OR
				Texto like '%Vazquez Rodriguez%' OR
				Texto like '%Jorge Omar Velazquez Ruiz%' OR
				Texto like '%Jorge Omar Velazquez%' OR
				Texto like '%Jorge Velazquez Ruiz%' OR
				Texto like '%Velazquez Ruiz%' OR
				Texto like '%oscar Vergara Gomez%' OR
				Texto like '%oscar Vergara%' OR
				Texto like '%Vergara Gomez%' OR
				Texto like '%Miguel Angel Xolalpa Molina%' OR
				Texto like '%Miguel Angel Xolalpa%' OR
				Texto like '%Miguel Xolalpa Molina%' OR
				Texto like '%Xolalpa Molina%' OR
				Texto like '%Eduardo Zarzosa Sanchez%' OR
				Texto like '%Zarzosa Sanchez%' OR
				Texto like '%Juan Zepeda Hernandez%' OR
				Texto like '%Zepeda Hernandez%'

				Titulo like '%Francisco agundis arias%' OR
				Titulo like '%Francisco agundis%' OR
				Titulo like '%agundis arias%' OR
				Titulo like '%Brenda Maria Izontli Alvarado Sanchez%' OR
				Titulo like '%Brenda Maria Izontli Alvarado%' OR
				Titulo like '%Brenda Maria Alvarado Sanchez%' OR
				Titulo like '%Brenda Izontli Alvarado Sanchez%' OR
				Titulo like '%Brenda Alvarado Sanchez%' OR
				Titulo like '%Anuar roberto Azar Figueroa%' OR
				Titulo like '%Anuar roberto Azar%' OR
				Titulo like '%Anuar  Azar Figueroa%' OR
				Titulo like '%Azar Figueroa%' OR
				Titulo like '%norma Karina Bastida Guadarrama%' OR
				Titulo like '%norma Karina Bastida%' OR
				Titulo like '%norma Bastida Guadarrama%' OR
				Titulo like '%Bastida Guadarrama%' OR
				Titulo like '%Victor Manuel Bautista Lopez%' OR
				Titulo like '%Victor Manuel Bautista%' OR
				Titulo like '%Victor Bautista Lopez%' OR
				Titulo like '%Bautista Lopez%' OR
				Titulo like '%Jesus antonio becerril gasca%' OR
				Titulo like '%Jesus antonio becerril%' OR
				Titulo like '%Jesus becerril gasca%' OR
				Titulo like '%becerril gasca%' OR
				Titulo like '%Edgar Ignacio Beltran garcia%' OR
				Titulo like '%Edgar Ignacio Beltran%' OR
				Titulo like '%Edgar Beltran garcia%' OR
				Titulo like '%Beltran garcia%' OR
				Titulo like '%Sue Ellen Bernal Bolnik%' OR
				Titulo like '%Sue Ellen Bernal%' OR
				Titulo like '%Sue Bernal Bolnik%' OR
				Titulo like '%Bernal Bolnik%' OR
				Titulo like '%Martha Angelica Bernardino Rojas%' OR
				Titulo like '%Martha Angelica Bernardino%' OR
				Titulo like '%Martha Bernardino Rojas%' OR
				Titulo like '%Bernardino Rojas%' OR
				Titulo like '%Juana Bonilla Jaime%' OR
				Titulo like '%Juana Bonilla%' OR
				Titulo like '%Leticia Calderon Ramirez%' OR
				Titulo like '%Leticia Calderon%' OR
				Titulo like '%Calderon Ramirez%' OR
				Titulo like '%Araceli Casasola Salazar%' OR
				Titulo like '%Araceli Casasola%' OR
				Titulo like '%Casasola Salazar%' OR
				Titulo like '%Eleazar Centeno Ortiz%' OR
				Titulo like '%Eleazar Centeno%' OR
				Titulo like '%Inocencio Chavez Resendiz%' OR
				Titulo like '%Inocencio Chavez%' OR
				Titulo like '%Chavez Resendiz%' OR
				Titulo like '%Jacobo David Cheja Alfaro%' OR
				Titulo like '%Jacobo David Cheja%' OR
				Titulo like '%Jacobo Cheja Alfaro%' OR
				Titulo like '%Cheja Alfaro%' OR
				Titulo like '%Maria Mercedes Colin Guadarrama%' OR
				Titulo like '%Maria Mercedes Colin%' OR
				Titulo like '%Maria Colin Guadarrama%' OR
				Titulo like '%Colin Guadarrama%' OR
				Titulo like '%Aquiles Cortes Lopez%' OR
				Titulo like '%Aquiles Cortes%' OR
				Titulo like '%Cortes Lopez%' OR
				Titulo like '%Marisol Diaz Perez%' OR
				Titulo like '%Marisol Diaz%' OR
				Titulo like '%Diaz Perez%' OR
				Titulo like '%Alberto Diaz Trujillo%' OR
				Titulo like '%Alberto Diaz%' OR
				Titulo like '%Diaz Trujillo%' OR
				Titulo like '%Abel Dominguez Azuz%' OR
				Titulo like '%Abel Dominguez%' OR
				Titulo like '%Dominguez Azuz%' OR
				Titulo like '%Manuel Anthony Dominguez Vargas%' OR
				Titulo like '%Manuel Anthony Dominguez%' OR
				Titulo like '%Manuel Dominguez Vargas%' OR
				Titulo like '%Dominguez Vargas%' OR
				Titulo like '%Patricia Elisa Duran Reveles%' OR
				Titulo like '%Patricia Elisa Duran%' OR
				Titulo like '%Patricia Duran Reveles%' OR
				Titulo like '%Duran Reveles%' OR
				Titulo like '%Francisco Javier Fernandez Clamont%' OR
				Titulo like '%Francisco Javier Fernandez%' OR
				Titulo like '%Francisco Fernandez Clamont%' OR
				Titulo like '%Fernandez Clamont%' OR
				Titulo like '%Josefina Aide Flores Delgado%' OR
				Titulo like '%Josefina Aide Flores%' OR
				Titulo like '%Josefina Flores Delgado%' OR
				Titulo like '%Flores Delgado%' OR
				Titulo like '%Victor Hugo Galvez Astorga%' OR
				Titulo like '%Victor Hugo Galvez%' OR
				Titulo like '%Victor Galvez Astorga%' OR
				Titulo like '%Galvez Astorga%' OR
				Titulo like '%Raymundo Garza Vilchis%' OR
				Titulo like '%Raymundo Garza%' OR
				Titulo like '%Garza Vilchis%' OR
				Titulo like '%Irazema Gonzalez Martinez Olivares%' OR
				Titulo like '%Irazema Gonzalez Martinez%' OR
				Titulo like '%Irazema Martinez Olivares%' OR
				Titulo like '%Fernando Gonzalez Mejia%' OR
				Titulo like '%Fernando Gonzalez%' OR
				Titulo like '%Gonzalez Mejia%' OR
				Titulo like '%Carolina Berenice Guevara Maupome%' OR
				Titulo like '%Carolina Berenice Guevara%' OR
				Titulo like '%Carolina Guevara Maupome%' OR
				Titulo like '%Guevara Maupome%' OR
				Titulo like '%Raymundo Guzman Corrovinas%' OR
				Titulo like '%Raymundo Guzman%' OR
				Titulo like '%Guzman Corrovinas%' OR
				Titulo like '%Ruben Hernandez Magana%' OR
				Titulo like '%Ruben Hernandez%' OR
				Titulo like '%Hernandez Magana%' OR
				Titulo like '%Areli Hernandez Martinez%'	OR
				Titulo like '%Areli Hernandez%'	OR
				Titulo like '%Vladimir Hernandez Villegas%' OR
				Titulo like '%Vladimir Hernandez%' OR
				Titulo like '%Jose Antonio Lopez Lozano%' OR
				Titulo like '%Jose Antonio Lopez%' OR
				Titulo like '%Jose Lopez Lozano%' OR
				Titulo like '%Lopez Lozano%' OR
				Titulo like '%Raymundo Edgar Martinez Carbajal%' OR
				Titulo like '%Raymundo Edgar Martinez%' OR
				Titulo like '%Raymundo Martinez Carbajal%' OR
				Titulo like '%Martinez Carbajal%' OR
				Titulo like '%Beatriz Medina Rangel%' OR
				Titulo like '%Medina Rangel%' OR
				Titulo like '%Leticia Mejia Garcia%' OR
				Titulo like '%Leticia Mejia%' OR
				Titulo like '%Sergio Mendiola Sanchez%' OR
				Titulo like '%Sergio Mendiola%' OR
				Titulo like '%Mendiola Sanchez%' OR
				Titulo like '%Nelyda Mocinos Jimenez%' OR
				Titulo like '%Nelyda Mocinos%' OR
				Titulo like '%Yomali Mondragon Arredondo%' OR
				Titulo like '%Yomali Mondragon%' OR
				Titulo like '%Perla Guadalupe Monroy Miranda%' OR
				Titulo like '%Perla Guadalupe Monroy%' OR
				Titulo like '%Perla Monroy Miranda%' OR
				Titulo like '%Maria de Lourdes Montiel Paredes%' OR
				Titulo like '%Maria de Lourdes Montiel%' OR
				Titulo like '%Maria Montiel Paredes%' OR
				Titulo like '%Montiel Paredes%' OR
				Titulo like '%Jose Isidro Moreno Arcega%' OR
				Titulo like '%Jose Isidro Moreno%' OR
				Titulo like '%Jose Moreno Arcega%' OR
				Titulo like '%Diego Eric Moreno Valle%' OR
				Titulo like '%Diego Moreno Valle%' OR
				Titulo like '%Diego Eric Moreno Valle%' OR
				Titulo like '%Cesar Reynaldo Navarro de Alba%' OR
				Titulo like '%Cesar Reynaldo Navarro%' OR
				Titulo like '%Navarro de Alba%' OR
				Titulo like '%Alejandro Olvera Entzana%' OR
				Titulo like '%Alejandro Olvera%' OR
				Titulo like '%Olvera Entzana%' OR
				Titulo like '%Rafael Osornio Sanchez%' OR
				Titulo like '%Rafael Osornio%' OR
				Titulo like '%Bertha Padilla Chacon%' OR
				Titulo like '%Jesus Pablo Peralta Garcia%' OR
				Titulo like '%Jesus Pablo Peralta%' OR
				Titulo like '%Jesus Peralta Garcia%' OR
				Titulo like '%Peralta Garcia%' OR
				Titulo like '%Maria Perez Lopez%' OR
				Titulo like '%Arturo Pina Garcia%' OR
				Titulo like '%Gerardo Pliego Santana%' OR
				Titulo like '%Maria Pozos Parrado%' OR
				Titulo like '%Tassio Benjamin Ramirez Hernandez%' OR
				Titulo like '%Tassio Benjamin Ramirez%' OR
				Titulo like '%Tassio Ramirez Hernandez%' OR
				Titulo like '%Ramirez Hernandez%' OR
				Titulo like '%Marco Antonio Ramirez Ramirez%' OR
				Titulo like '%Marco Antonio Ramirez%' OR
				Titulo like '%Ramirez Ramirez%' OR
				Titulo like '%Tanya Rellstab Carreto%' OR
				Titulo like '%Rellstab Carreto%' OR
				Titulo like '%Maria Fernanda Rivera Sanchez%' OR
				Titulo like '%Maria Fernanda Rivera%' OR
				Titulo like '%Maria Rivera Sanchez%' OR
				Titulo like '%Rivera Sanchez%' OR
				Titulo like '%Cruz Juvenal Roa Sanchez%' OR
				Titulo like '%Cruz Juvenal Roa%' OR
				Titulo like '%Cruz Roa Sanchez%' OR
				Titulo like '%Roa Sanchez%' OR
				Titulo like '%Mario Salcedo Gonzalez%' OR
				Titulo like '%Mario Salcedo%' OR
				Titulo like '%Salcedo Gonzalez%' OR
				Titulo like '%Javier Salinas Narvaez%' OR
				Titulo like '%Javier Salinas%' OR
				Titulo like '%Salinas Narvaez%' OR
				Titulo like '%Miguel Samano Peralta%' OR
				Titulo like '%Samano Peralta%' OR
				Titulo like '%Roberto Sanchez Campos%' OR
				Titulo like '%Sanchez Campos%' OR
				Titulo like '%Jesus Sanchez Isidoro%' OR
				Titulo like '%Sanchez Isidoro%' OR
				Titulo like '%Mirian Sanchez Monsalvo%' OR
				Titulo like '%Sanchez Monsalvo%' OR
				Titulo like '%Carlos Sanchez Sanchez%' OR
				Titulo like '%Lizeth Marlene Sandoval Colindres%' OR
				Titulo like '%Lizeth Marlene Sandoval%' OR
				Titulo like '%Lizeth Sandoval Colindres%' OR
				Titulo like '%Sandoval Colindres%' OR
				Titulo like '%Francisco Javier Eric Sevilla Montes De Oca%' OR
				Titulo like '%Francisco Javier Eric Sevilla%' OR
				Titulo like '%Francisco Javier Sevilla Montes De Oca%' OR
				Titulo like '%Francisco Eric Sevilla Montes De Oca%' OR
				Titulo like '%Francisco Sevilla Montes De Oca%' OR
				Titulo like '%Sevilla Montes De Oca%' OR
				Titulo like '%Ivette Topete Garcia%' OR
				Titulo like '%Topete Garcia%' OR
				Titulo like '%Abel Valle Castillo%' OR
				Titulo like '%Valle Castillo%' OR
				Titulo like '%Jose Francisco Vazquez Rodriguez%' OR
				Titulo like '%Jose Francisco Vazquez%' OR
				Titulo like '%Jose Vazquez Rodriguez%' OR
				Titulo like '%Vazquez Rodriguez%' OR
				Titulo like '%Jorge Omar Velazquez Ruiz%' OR
				Titulo like '%Jorge Omar Velazquez%' OR
				Titulo like '%Jorge Velazquez Ruiz%' OR
				Titulo like '%Velazquez Ruiz%' OR
				Titulo like '%oscar Vergara Gomez%' OR
				Titulo like '%oscar Vergara%' OR
				Titulo like '%Vergara Gomez%' OR
				Titulo like '%Miguel Angel Xolalpa Molina%' OR
				Titulo like '%Miguel Angel Xolalpa%' OR
				Titulo like '%Miguel Xolalpa Molina%' OR
				Titulo like '%Xolalpa Molina%' OR
				Titulo like '%Eduardo Zarzosa Sanchez%' OR
				Titulo like '%Zarzosa Sanchez%' OR
				Titulo like '%Juan Zepeda Hernandez%' OR
				Titulo like '%Zepeda Hernandez%' OR

				Encabezado like '%Francisco agundis arias%' OR
				Encabezado like '%Francisco agundis%' OR
				Encabezado like '%agundis arias%' OR
				Encabezado like '%Brenda Maria Izontli Alvarado Sanchez%' OR
				Encabezado like '%Brenda Maria Izontli Alvarado%' OR
				Encabezado like '%Brenda Maria Alvarado Sanchez%' OR
				Encabezado like '%Brenda Izontli Alvarado Sanchez%' OR
				Encabezado like '%Brenda Alvarado Sanchez%' OR
				Encabezado like '%Anuar roberto Azar Figueroa%' OR
				Encabezado like '%Anuar roberto Azar%' OR
				Encabezado like '%Anuar  Azar Figueroa%' OR
				Encabezado like '%Azar Figueroa%' OR
				Encabezado like '%norma Karina Bastida Guadarrama%' OR
				Encabezado like '%norma Karina Bastida%' OR
				Encabezado like '%norma Bastida Guadarrama%' OR
				Encabezado like '%Bastida Guadarrama%' OR
				Encabezado like '%Victor Manuel Bautista Lopez%' OR
				Encabezado like '%Victor Manuel Bautista%' OR
				Encabezado like '%Victor Bautista Lopez%' OR
				Encabezado like '%Bautista Lopez%' OR
				Encabezado like '%Jesus antonio becerril gasca%' OR
				Encabezado like '%Jesus antonio becerril%' OR
				Encabezado like '%Jesus becerril gasca%' OR
				Encabezado like '%becerril gasca%' OR
				Encabezado like '%Edgar Ignacio Beltran garcia%' OR
				Encabezado like '%Edgar Ignacio Beltran%' OR
				Encabezado like '%Edgar Beltran garcia%' OR
				Encabezado like '%Beltran garcia%' OR
				Encabezado like '%Sue Ellen Bernal Bolnik%' OR
				Encabezado like '%Sue Ellen Bernal%' OR
				Encabezado like '%Sue Bernal Bolnik%' OR
				Encabezado like '%Bernal Bolnik%' OR
				Encabezado like '%Martha Angelica Bernardino Rojas%' OR
				Encabezado like '%Martha Angelica Bernardino%' OR
				Encabezado like '%Martha Bernardino Rojas%' OR
				Encabezado like '%Bernardino Rojas%' OR
				Encabezado like '%Juana Bonilla Jaime%' OR
				Encabezado like '%Juana Bonilla%' OR
				Encabezado like '%Leticia Calderon Ramirez%' OR
				Encabezado like '%Leticia Calderon%' OR
				Encabezado like '%Calderon Ramirez%' OR
				Encabezado like '%Araceli Casasola Salazar%' OR
				Encabezado like '%Araceli Casasola%' OR
				Encabezado like '%Casasola Salazar%' OR
				Encabezado like '%Eleazar Centeno Ortiz%' OR
				Encabezado like '%Eleazar Centeno%' OR
				Encabezado like '%Inocencio Chavez Resendiz%' OR
				Encabezado like '%Inocencio Chavez%' OR
				Encabezado like '%Chavez Resendiz%' OR
				Encabezado like '%Jacobo David Cheja Alfaro%' OR
				Encabezado like '%Jacobo David Cheja%' OR
				Encabezado like '%Jacobo Cheja Alfaro%' OR
				Encabezado like '%Cheja Alfaro%' OR
				Encabezado like '%Maria Mercedes Colin Guadarrama%' OR
				Encabezado like '%Maria Mercedes Colin%' OR
				Encabezado like '%Maria Colin Guadarrama%' OR
				Encabezado like '%Colin Guadarrama%' OR
				Encabezado like '%Aquiles Cortes Lopez%' OR
				Encabezado like '%Aquiles Cortes%' OR
				Encabezado like '%Cortes Lopez%' OR
				Encabezado like '%Marisol Diaz Perez%' OR
				Encabezado like '%Marisol Diaz%' OR
				Encabezado like '%Diaz Perez%' OR
				Encabezado like '%Alberto Diaz Trujillo%' OR
				Encabezado like '%Alberto Diaz%' OR
				Encabezado like '%Diaz Trujillo%' OR
				Encabezado like '%Abel Dominguez Azuz%' OR
				Encabezado like '%Abel Dominguez%' OR
				Encabezado like '%Dominguez Azuz%' OR
				Encabezado like '%Manuel Anthony Dominguez Vargas%' OR
				Encabezado like '%Manuel Anthony Dominguez%' OR
				Encabezado like '%Manuel Dominguez Vargas%' OR
				Encabezado like '%Dominguez Vargas%' OR
				Encabezado like '%Patricia Elisa Duran Reveles%' OR
				Encabezado like '%Patricia Elisa Duran%' OR
				Encabezado like '%Patricia Duran Reveles%' OR
				Encabezado like '%Duran Reveles%' OR
				Encabezado like '%Francisco Javier Fernandez Clamont%' OR
				Encabezado like '%Francisco Javier Fernandez%' OR
				Encabezado like '%Francisco Fernandez Clamont%' OR
				Encabezado like '%Fernandez Clamont%' OR
				Encabezado like '%Josefina Aide Flores Delgado%' OR
				Encabezado like '%Josefina Aide Flores%' OR
				Encabezado like '%Josefina Flores Delgado%' OR
				Encabezado like '%Flores Delgado%' OR
				Encabezado like '%Victor Hugo Galvez Astorga%' OR
				Encabezado like '%Victor Hugo Galvez%' OR
				Encabezado like '%Victor Galvez Astorga%' OR
				Encabezado like '%Galvez Astorga%' OR
				Encabezado like '%Raymundo Garza Vilchis%' OR
				Encabezado like '%Raymundo Garza%' OR
				Encabezado like '%Garza Vilchis%' OR
				Encabezado like '%Irazema Gonzalez Martinez Olivares%' OR
				Encabezado like '%Irazema Gonzalez Martinez%' OR
				Encabezado like '%Irazema Martinez Olivares%' OR
				Encabezado like '%Fernando Gonzalez Mejia%' OR
				Encabezado like '%Fernando Gonzalez%' OR
				Encabezado like '%Gonzalez Mejia%' OR
				Encabezado like '%Carolina Berenice Guevara Maupome%' OR
				Encabezado like '%Carolina Berenice Guevara%' OR
				Encabezado like '%Carolina Guevara Maupome%' OR
				Encabezado like '%Guevara Maupome%' OR
				Encabezado like '%Raymundo Guzman Corrovinas%' OR
				Encabezado like '%Raymundo Guzman%' OR
				Encabezado like '%Guzman Corrovinas%' OR
				Encabezado like '%Ruben Hernandez Magana%' OR
				Encabezado like '%Ruben Hernandez%' OR
				Encabezado like '%Hernandez Magana%' OR
				Encabezado like '%Areli Hernandez Martinez%'	OR
				Encabezado like '%Areli Hernandez%'	OR
				Encabezado like '%Vladimir Hernandez Villegas%' OR
				Encabezado like '%Vladimir Hernandez%' OR
				Encabezado like '%Jose Antonio Lopez Lozano%' OR
				Encabezado like '%Jose Antonio Lopez%' OR
				Encabezado like '%Jose Lopez Lozano%' OR
				Encabezado like '%Lopez Lozano%' OR
				Encabezado like '%Raymundo Edgar Martinez Carbajal%' OR
				Encabezado like '%Raymundo Edgar Martinez%' OR
				Encabezado like '%Raymundo Martinez Carbajal%' OR
				Encabezado like '%Martinez Carbajal%' OR
				Encabezado like '%Beatriz Medina Rangel%' OR
				Encabezado like '%Medina Rangel%' OR
				Encabezado like '%Leticia Mejia Garcia%' OR
				Encabezado like '%Leticia Mejia%' OR
				Encabezado like '%Sergio Mendiola Sanchez%' OR
				Encabezado like '%Sergio Mendiola%' OR
				Encabezado like '%Mendiola Sanchez%' OR
				Encabezado like '%Nelyda Mocinos Jimenez%' OR
				Encabezado like '%Nelyda Mocinos%' OR
				Encabezado like '%Yomali Mondragon Arredondo%' OR
				Encabezado like '%Yomali Mondragon%' OR
				Encabezado like '%Perla Guadalupe Monroy Miranda%' OR
				Encabezado like '%Perla Guadalupe Monroy%' OR
				Encabezado like '%Perla Monroy Miranda%' OR
				Encabezado like '%Maria de Lourdes Montiel Paredes%' OR
				Encabezado like '%Maria de Lourdes Montiel%' OR
				Encabezado like '%Maria Montiel Paredes%' OR
				Encabezado like '%Montiel Paredes%' OR
				Encabezado like '%Jose Isidro Moreno Arcega%' OR
				Encabezado like '%Jose Isidro Moreno%' OR
				Encabezado like '%Jose Moreno Arcega%' OR
				Encabezado like '%Diego Eric Moreno Valle%' OR
				Encabezado like '%Diego Moreno Valle%' OR
				Encabezado like '%Diego Eric Moreno Valle%' OR
				Encabezado like '%Cesar Reynaldo Navarro de Alba%' OR
				Encabezado like '%Cesar Reynaldo Navarro%' OR
				Encabezado like '%Navarro de Alba%' OR
				Encabezado like '%Alejandro Olvera Entzana%' OR
				Encabezado like '%Alejandro Olvera%' OR
				Encabezado like '%Olvera Entzana%' OR
				Encabezado like '%Rafael Osornio Sanchez%' OR
				Encabezado like '%Rafael Osornio%' OR
				Encabezado like '%Bertha Padilla Chacon%' OR
				Encabezado like '%Jesus Pablo Peralta Garcia%' OR
				Encabezado like '%Jesus Pablo Peralta%' OR
				Encabezado like '%Jesus Peralta Garcia%' OR
				Encabezado like '%Peralta Garcia%' OR
				Encabezado like '%Maria Perez Lopez%' OR
				Encabezado like '%Arturo Pina Garcia%' OR
				Encabezado like '%Gerardo Pliego Santana%' OR
				Encabezado like '%Maria Pozos Parrado%' OR
				Encabezado like '%Tassio Benjamin Ramirez Hernandez%' OR
				Encabezado like '%Tassio Benjamin Ramirez%' OR
				Encabezado like '%Tassio Ramirez Hernandez%' OR
				Encabezado like '%Ramirez Hernandez%' OR
				Encabezado like '%Marco Antonio Ramirez Ramirez%' OR
				Encabezado like '%Marco Antonio Ramirez%' OR
				Encabezado like '%Ramirez Ramirez%' OR
				Encabezado like '%Tanya Rellstab Carreto%' OR
				Encabezado like '%Rellstab Carreto%' OR
				Encabezado like '%Maria Fernanda Rivera Sanchez%' OR
				Encabezado like '%Maria Fernanda Rivera%' OR
				Encabezado like '%Maria Rivera Sanchez%' OR
				Encabezado like '%Rivera Sanchez%' OR
				Encabezado like '%Cruz Juvenal Roa Sanchez%' OR
				Encabezado like '%Cruz Juvenal Roa%' OR
				Encabezado like '%Cruz Roa Sanchez%' OR
				Encabezado like '%Roa Sanchez%' OR
				Encabezado like '%Mario Salcedo Gonzalez%' OR
				Encabezado like '%Mario Salcedo%' OR
				Encabezado like '%Salcedo Gonzalez%' OR
				Encabezado like '%Javier Salinas Narvaez%' OR
				Encabezado like '%Javier Salinas%' OR
				Encabezado like '%Salinas Narvaez%' OR
				Encabezado like '%Miguel Samano Peralta%' OR
				Encabezado like '%Samano Peralta%' OR
				Encabezado like '%Roberto Sanchez Campos%' OR
				Encabezado like '%Sanchez Campos%' OR
				Encabezado like '%Jesus Sanchez Isidoro%' OR
				Encabezado like '%Sanchez Isidoro%' OR
				Encabezado like '%Mirian Sanchez Monsalvo%' OR
				Encabezado like '%Sanchez Monsalvo%' OR
				Encabezado like '%Carlos Sanchez Sanchez%' OR
				Encabezado like '%Lizeth Marlene Sandoval Colindres%' OR
				Encabezado like '%Lizeth Marlene Sandoval%' OR
				Encabezado like '%Lizeth Sandoval Colindres%' OR
				Encabezado like '%Sandoval Colindres%' OR
				Encabezado like '%Francisco Javier Eric Sevilla Montes De Oca%' OR
				Encabezado like '%Francisco Javier Eric Sevilla%' OR
				Encabezado like '%Francisco Javier Sevilla Montes De Oca%' OR
				Encabezado like '%Francisco Eric Sevilla Montes De Oca%' OR
				Encabezado like '%Francisco Sevilla Montes De Oca%' OR
				Encabezado like '%Sevilla Montes De Oca%' OR
				Encabezado like '%Ivette Topete Garcia%' OR
				Encabezado like '%Topete Garcia%' OR
				Encabezado like '%Abel Valle Castillo%' OR
				Encabezado like '%Valle Castillo%' OR
				Encabezado like '%Jose Francisco Vazquez Rodriguez%' OR
				Encabezado like '%Jose Francisco Vazquez%' OR
				Encabezado like '%Jose Vazquez Rodriguez%' OR
				Encabezado like '%Vazquez Rodriguez%' OR
				Encabezado like '%Jorge Omar Velazquez Ruiz%' OR
				Encabezado like '%Jorge Omar Velazquez%' OR
				Encabezado like '%Jorge Velazquez Ruiz%' OR
				Encabezado like '%Velazquez Ruiz%' OR
				Encabezado like '%oscar Vergara Gomez%' OR
				Encabezado like '%oscar Vergara%' OR
				Encabezado like '%Vergara Gomez%' OR
				Encabezado like '%Miguel Angel Xolalpa Molina%' OR
				Encabezado like '%Miguel Angel Xolalpa%' OR
				Encabezado like '%Miguel Xolalpa Molina%' OR
				Encabezado like '%Xolalpa Molina%' OR
				Encabezado like '%Eduardo Zarzosa Sanchez%' OR
				Encabezado like '%Zarzosa Sanchez%' OR
				Encabezado like '%Juan Zepeda Hernandez%' OR
				Encabezado like '%Zepeda Hernandez%' OR

				PieFoto like '%Francisco agundis arias%' OR
				PieFoto like '%Francisco agundis%' OR
				PieFoto like '%agundis arias%' OR
				PieFoto like '%Brenda Maria Izontli Alvarado Sanchez%' OR
				PieFoto like '%Brenda Maria Izontli Alvarado%' OR
				PieFoto like '%Brenda Maria Alvarado Sanchez%' OR
				PieFoto like '%Brenda Izontli Alvarado Sanchez%' OR
				PieFoto like '%Brenda Alvarado Sanchez%' OR
				PieFoto like '%Anuar roberto Azar Figueroa%' OR
				PieFoto like '%Anuar roberto Azar%' OR
				PieFoto like '%Anuar  Azar Figueroa%' OR
				PieFoto like '%Azar Figueroa%' OR
				PieFoto like '%norma Karina Bastida Guadarrama%' OR
				PieFoto like '%norma Karina Bastida%' OR
				PieFoto like '%norma Bastida Guadarrama%' OR
				PieFoto like '%Bastida Guadarrama%' OR
				PieFoto like '%Victor Manuel Bautista Lopez%' OR
				PieFoto like '%Victor Manuel Bautista%' OR
				PieFoto like '%Victor Bautista Lopez%' OR
				PieFoto like '%Bautista Lopez%' OR
				PieFoto like '%Jesus antonio becerril gasca%' OR
				PieFoto like '%Jesus antonio becerril%' OR
				PieFoto like '%Jesus becerril gasca%' OR
				PieFoto like '%becerril gasca%' OR
				PieFoto like '%Edgar Ignacio Beltran garcia%' OR
				PieFoto like '%Edgar Ignacio Beltran%' OR
				PieFoto like '%Edgar Beltran garcia%' OR
				PieFoto like '%Beltran garcia%' OR
				PieFoto like '%Sue Ellen Bernal Bolnik%' OR
				PieFoto like '%Sue Ellen Bernal%' OR
				PieFoto like '%Sue Bernal Bolnik%' OR
				PieFoto like '%Bernal Bolnik%' OR
				PieFoto like '%Martha Angelica Bernardino Rojas%' OR
				PieFoto like '%Martha Angelica Bernardino%' OR
				PieFoto like '%Martha Bernardino Rojas%' OR
				PieFoto like '%Bernardino Rojas%' OR
				PieFoto like '%Juana Bonilla Jaime%' OR
				PieFoto like '%Juana Bonilla%' OR
				PieFoto like '%Leticia Calderon Ramirez%' OR
				PieFoto like '%Leticia Calderon%' OR
				PieFoto like '%Calderon Ramirez%' OR
				PieFoto like '%Araceli Casasola Salazar%' OR
				PieFoto like '%Araceli Casasola%' OR
				PieFoto like '%Casasola Salazar%' OR
				PieFoto like '%Eleazar Centeno Ortiz%' OR
				PieFoto like '%Eleazar Centeno%' OR
				PieFoto like '%Inocencio Chavez Resendiz%' OR
				PieFoto like '%Inocencio Chavez%' OR
				PieFoto like '%Chavez Resendiz%' OR
				PieFoto like '%Jacobo David Cheja Alfaro%' OR
				PieFoto like '%Jacobo David Cheja%' OR
				PieFoto like '%Jacobo Cheja Alfaro%' OR
				PieFoto like '%Cheja Alfaro%' OR
				PieFoto like '%Maria Mercedes Colin Guadarrama%' OR
				PieFoto like '%Maria Mercedes Colin%' OR
				PieFoto like '%Maria Colin Guadarrama%' OR
				PieFoto like '%Colin Guadarrama%' OR
				PieFoto like '%Aquiles Cortes Lopez%' OR
				PieFoto like '%Aquiles Cortes%' OR
				PieFoto like '%Cortes Lopez%' OR
				PieFoto like '%Marisol Diaz Perez%' OR
				PieFoto like '%Marisol Diaz%' OR
				PieFoto like '%Diaz Perez%' OR
				PieFoto like '%Alberto Diaz Trujillo%' OR
				PieFoto like '%Alberto Diaz%' OR
				PieFoto like '%Diaz Trujillo%' OR
				PieFoto like '%Abel Dominguez Azuz%' OR
				PieFoto like '%Abel Dominguez%' OR
				PieFoto like '%Dominguez Azuz%' OR
				PieFoto like '%Manuel Anthony Dominguez Vargas%' OR
				PieFoto like '%Manuel Anthony Dominguez%' OR
				PieFoto like '%Manuel Dominguez Vargas%' OR
				PieFoto like '%Dominguez Vargas%' OR
				PieFoto like '%Patricia Elisa Duran Reveles%' OR
				PieFoto like '%Patricia Elisa Duran%' OR
				PieFoto like '%Patricia Duran Reveles%' OR
				PieFoto like '%Duran Reveles%' OR
				PieFoto like '%Francisco Javier Fernandez Clamont%' OR
				PieFoto like '%Francisco Javier Fernandez%' OR
				PieFoto like '%Francisco Fernandez Clamont%' OR
				PieFoto like '%Fernandez Clamont%' OR
				PieFoto like '%Josefina Aide Flores Delgado%' OR
				PieFoto like '%Josefina Aide Flores%' OR
				PieFoto like '%Josefina Flores Delgado%' OR
				PieFoto like '%Flores Delgado%' OR
				PieFoto like '%Victor Hugo Galvez Astorga%' OR
				PieFoto like '%Victor Hugo Galvez%' OR
				PieFoto like '%Victor Galvez Astorga%' OR
				PieFoto like '%Galvez Astorga%' OR
				PieFoto like '%Raymundo Garza Vilchis%' OR
				PieFoto like '%Raymundo Garza%' OR
				PieFoto like '%Garza Vilchis%' OR
				PieFoto like '%Irazema Gonzalez Martinez Olivares%' OR
				PieFoto like '%Irazema Gonzalez Martinez%' OR
				PieFoto like '%Irazema Martinez Olivares%' OR
				PieFoto like '%Fernando Gonzalez Mejia%' OR
				PieFoto like '%Fernando Gonzalez%' OR
				PieFoto like '%Gonzalez Mejia%' OR
				PieFoto like '%Carolina Berenice Guevara Maupome%' OR
				PieFoto like '%Carolina Berenice Guevara%' OR
				PieFoto like '%Carolina Guevara Maupome%' OR
				PieFoto like '%Guevara Maupome%' OR
				PieFoto like '%Raymundo Guzman Corrovinas%' OR
				PieFoto like '%Raymundo Guzman%' OR
				PieFoto like '%Guzman Corrovinas%' OR
				PieFoto like '%Ruben Hernandez Magana%' OR
				PieFoto like '%Ruben Hernandez%' OR
				PieFoto like '%Hernandez Magana%' OR
				PieFoto like '%Areli Hernandez Martinez%'	OR
				PieFoto like '%Areli Hernandez%'	OR
				PieFoto like '%Vladimir Hernandez Villegas%' OR
				PieFoto like '%Vladimir Hernandez%' OR
				PieFoto like '%Jose Antonio Lopez Lozano%' OR
				PieFoto like '%Jose Antonio Lopez%' OR
				PieFoto like '%Jose Lopez Lozano%' OR
				PieFoto like '%Lopez Lozano%' OR
				PieFoto like '%Raymundo Edgar Martinez Carbajal%' OR
				PieFoto like '%Raymundo Edgar Martinez%' OR
				PieFoto like '%Raymundo Martinez Carbajal%' OR
				PieFoto like '%Martinez Carbajal%' OR
				PieFoto like '%Beatriz Medina Rangel%' OR
				PieFoto like '%Medina Rangel%' OR
				PieFoto like '%Leticia Mejia Garcia%' OR
				PieFoto like '%Leticia Mejia%' OR
				PieFoto like '%Sergio Mendiola Sanchez%' OR
				PieFoto like '%Sergio Mendiola%' OR
				PieFoto like '%Mendiola Sanchez%' OR
				PieFoto like '%Nelyda Mocinos Jimenez%' OR
				PieFoto like '%Nelyda Mocinos%' OR
				PieFoto like '%Yomali Mondragon Arredondo%' OR
				PieFoto like '%Yomali Mondragon%' OR
				PieFoto like '%Perla Guadalupe Monroy Miranda%' OR
				PieFoto like '%Perla Guadalupe Monroy%' OR
				PieFoto like '%Perla Monroy Miranda%' OR
				PieFoto like '%Maria de Lourdes Montiel Paredes%' OR
				PieFoto like '%Maria de Lourdes Montiel%' OR
				PieFoto like '%Maria Montiel Paredes%' OR
				PieFoto like '%Montiel Paredes%' OR
				PieFoto like '%Jose Isidro Moreno Arcega%' OR
				PieFoto like '%Jose Isidro Moreno%' OR
				PieFoto like '%Jose Moreno Arcega%' OR
				PieFoto like '%Diego Eric Moreno Valle%' OR
				PieFoto like '%Diego Moreno Valle%' OR
				PieFoto like '%Diego Eric Moreno Valle%' OR
				PieFoto like '%Cesar Reynaldo Navarro de Alba%' OR
				PieFoto like '%Cesar Reynaldo Navarro%' OR
				PieFoto like '%Navarro de Alba%' OR
				PieFoto like '%Alejandro Olvera Entzana%' OR
				PieFoto like '%Alejandro Olvera%' OR
				PieFoto like '%Olvera Entzana%' OR
				PieFoto like '%Rafael Osornio Sanchez%' OR
				PieFoto like '%Rafael Osornio%' OR
				PieFoto like '%Bertha Padilla Chacon%' OR
				PieFoto like '%Jesus Pablo Peralta Garcia%' OR
				PieFoto like '%Jesus Pablo Peralta%' OR
				PieFoto like '%Jesus Peralta Garcia%' OR
				PieFoto like '%Peralta Garcia%' OR
				PieFoto like '%Maria Perez Lopez%' OR
				PieFoto like '%Arturo Pina Garcia%' OR
				PieFoto like '%Gerardo Pliego Santana%' OR
				PieFoto like '%Maria Pozos Parrado%' OR
				PieFoto like '%Tassio Benjamin Ramirez Hernandez%' OR
				PieFoto like '%Tassio Benjamin Ramirez%' OR
				PieFoto like '%Tassio Ramirez Hernandez%' OR
				PieFoto like '%Ramirez Hernandez%' OR
				PieFoto like '%Marco Antonio Ramirez Ramirez%' OR
				PieFoto like '%Marco Antonio Ramirez%' OR
				PieFoto like '%Ramirez Ramirez%' OR
				PieFoto like '%Tanya Rellstab Carreto%' OR
				PieFoto like '%Rellstab Carreto%' OR
				PieFoto like '%Maria Fernanda Rivera Sanchez%' OR
				PieFoto like '%Maria Fernanda Rivera%' OR
				PieFoto like '%Maria Rivera Sanchez%' OR
				PieFoto like '%Rivera Sanchez%' OR
				PieFoto like '%Cruz Juvenal Roa Sanchez%' OR
				PieFoto like '%Cruz Juvenal Roa%' OR
				PieFoto like '%Cruz Roa Sanchez%' OR
				PieFoto like '%Roa Sanchez%' OR
				PieFoto like '%Mario Salcedo Gonzalez%' OR
				PieFoto like '%Mario Salcedo%' OR
				PieFoto like '%Salcedo Gonzalez%' OR
				PieFoto like '%Javier Salinas Narvaez%' OR
				PieFoto like '%Javier Salinas%' OR
				PieFoto like '%Salinas Narvaez%' OR
				PieFoto like '%Miguel Samano Peralta%' OR
				PieFoto like '%Samano Peralta%' OR
				PieFoto like '%Roberto Sanchez Campos%' OR
				PieFoto like '%Sanchez Campos%' OR
				PieFoto like '%Jesus Sanchez Isidoro%' OR
				PieFoto like '%Sanchez Isidoro%' OR
				PieFoto like '%Mirian Sanchez Monsalvo%' OR
				PieFoto like '%Sanchez Monsalvo%' OR
				PieFoto like '%Carlos Sanchez Sanchez%' OR
				PieFoto like '%Lizeth Marlene Sandoval Colindres%' OR
				PieFoto like '%Lizeth Marlene Sandoval%' OR
				PieFoto like '%Lizeth Sandoval Colindres%' OR
				PieFoto like '%Sandoval Colindres%' OR
				PieFoto like '%Francisco Javier Eric Sevilla Montes De Oca%' OR
				PieFoto like '%Francisco Javier Eric Sevilla%' OR
				PieFoto like '%Francisco Javier Sevilla Montes De Oca%' OR
				PieFoto like '%Francisco Eric Sevilla Montes De Oca%' OR
				PieFoto like '%Francisco Sevilla Montes De Oca%' OR
				PieFoto like '%Sevilla Montes De Oca%' OR
				PieFoto like '%Ivette Topete Garcia%' OR
				PieFoto like '%Topete Garcia%' OR
				PieFoto like '%Abel Valle Castillo%' OR
				PieFoto like '%Valle Castillo%' OR
				PieFoto like '%Jose Francisco Vazquez Rodriguez%' OR
				PieFoto like '%Jose Francisco Vazquez%' OR
				PieFoto like '%Jose Vazquez Rodriguez%' OR
				PieFoto like '%Vazquez Rodriguez%' OR
				PieFoto like '%Jorge Omar Velazquez Ruiz%' OR
				PieFoto like '%Jorge Omar Velazquez%' OR
				PieFoto like '%Jorge Velazquez Ruiz%' OR
				PieFoto like '%Velazquez Ruiz%' OR
				PieFoto like '%oscar Vergara Gomez%' OR
				PieFoto like '%oscar Vergara%' OR
				PieFoto like '%Vergara Gomez%' OR
				PieFoto like '%Miguel Angel Xolalpa Molina%' OR
				PieFoto like '%Miguel Angel Xolalpa%' OR
				PieFoto like '%Miguel Xolalpa Molina%' OR
				PieFoto like '%Xolalpa Molina%' OR
				PieFoto like '%Eduardo Zarzosa Sanchez%' OR
				PieFoto like '%Zarzosa Sanchez%' OR
				PieFoto like '%Juan Zepeda Hernandez%' OR
				PieFoto like '%Zepeda Hernandez%'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 11:// Mpales
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Indalecio Rios Velazquez%' OR
				Texto like '%Indalecio Rios%' OR
				Texto like '%Juan Hugo de la Rosa Garcia%' OR
				Texto like '%Hugo de la Rosa Garcia%' OR
				Texto like '%Juan de la Rosa Garcia%' OR
				Texto like '%Edgar Armando Olvera Higuera%' OR
				Texto like '%Edgar Olvera Higuera%' OR
				Texto like '%Armando Olvera Higuera%' OR
				Texto like '%Aurora Denisse Ugalde Alegría%' OR
				Texto like '%Aurora Ugalde Alegria%' OR
				Texto like '%Denisse Ugalde Alegria%' OR
				Texto like '%Rosalba Pineda Ramirez%' OR
				Texto like '%Jorge Adan Barron Elizalde%' OR
				Texto like '%Adan Barron Elizalde%' OR
				Texto like '%Jorge Barron Elizalde%' OR
				Texto like '%Victor Manuel Estrada Garibay%' OR
				Texto like '%Manuel Estrada Garibay%' OR
				Texto like '%Victor Estrada Garibay%' OR
				Texto like '%Ana Maria Balderas Trejo%' OR
				Texto like '%Ana Maria Balderas%' OR
				Texto like '%Carlos Enriquez Santos%' OR
				Texto like '%Remedios Rafael Ramos Gonzalez%' OR
				Texto like '%Remedios Ramos Gonzalez%' OR
				Texto like '%Remedios Rafael Gonzalez%' OR
				Texto like '%Fernando Zamora Morales%' OR
				Texto like '%David Lopez Cardenas%' OR
				Texto like '%Manuel Castrejon Morales%' OR
				Texto like '%Adolfo Solis Gomez%' OR
				Texto like '%Jaime Cervantes Sanchez%' OR
				Texto like '%Antonio Barrera Alcantara%' OR

				Titulo like '%Indalecio Rios Velazquez%' OR
				Titulo like '%Indalecio Rios%' OR
				Titulo like '%Juan Hugo de la Rosa Garcia%' OR
				Titulo like '%Hugo de la Rosa Garcia%' OR
				Titulo like '%Juan de la Rosa Garcia%' OR
				Titulo like '%Edgar Armando Olvera Higuera%' OR
				Titulo like '%Edgar Olvera Higuera%' OR
				Titulo like '%Armando Olvera Higuera%' OR
				Titulo like '%Aurora Denisse Ugalde Alegria%' OR
				Titulo like '%Aurora Ugalde Alegria%' OR
				Titulo like '%Denisse Ugalde Alegria%' OR
				Titulo like '%Rosalba Pineda Ramirez%' OR
				Titulo like '%Jorge Adan Barron Elizalde%' OR
				Titulo like '%Adan Barron Elizalde%' OR
				Titulo like '%Jorge Barron Elizalde%' OR
				Titulo like '%Victor Manuel Estrada Garibay%' OR
				Titulo like '%Manuel Estrada Garibay%' OR
				Titulo like '%Victor Estrada Garibay%' OR
				Titulo like '%Ana Maria Balderas Trejo%' OR
				Titulo like '%Ana Maria Balderas%' OR
				Titulo like '%Carlos Enriquez Santos%' OR
				Titulo like '%Remedios Rafael Ramos Gonzalez%' OR
				Titulo like '%Remedios Ramos Gonzalez%' OR
				Titulo like '%Remedios Rafael Gonzalez%' OR
				Titulo like '%Fernando Zamora Morales%' OR
				Titulo like '%David Lopez Cardenas%' OR
				Titulo like '%Manuel Castrejon Morales%' OR
				Titulo like '%Adolfo Solis Gomez%' OR
				Titulo like '%Jaime Cervantes Sanchez%' OR
				Titulo like '%Antonio Barrera Alcantara%' OR

				Encabezado like '%Indalecio Rios Velazquez%' OR
				Encabezado like '%Indalecio Rios%' OR
				Encabezado like '%Juan Hugo de la Rosa Garcia%' OR
				Encabezado like '%Hugo de la Rosa Garcia%' OR
				Encabezado like '%Juan de la Rosa Garcia%' OR
				Encabezado like '%Edgar Armando Olvera Higuera%' OR
				Encabezado like '%Edgar Olvera Higuera%' OR
				Encabezado like '%Armando Olvera Higuera%' OR
				Encabezado like '%Aurora Denisse Ugalde Alegria%' OR
				Encabezado like '%Aurora Ugalde Alegria%' OR
				Encabezado like '%Denisse Ugalde Alegria%' OR
				Encabezado like '%Rosalba Pineda Ramirez%' OR
				Encabezado like '%Jorge Adan Barron Elizalde%' OR
				Encabezado like '%Adan Barron Elizalde%' OR
				Encabezado like '%Jorge Barron Elizalde%' OR
				Encabezado like '%Victor Manuel Estrada Garibay%' OR
				Encabezado like '%Manuel Estrada Garibay%' OR
				Encabezado like '%Victor Estrada Garibay%' OR
				Encabezado like '%Ana Maria Balderas Trejo%' OR
				Encabezado like '%Ana Maria Balderas%' OR
				Encabezado like '%Carlos Enriquez Santos%' OR
				Encabezado like '%Remedios Rafael Ramos Gonzalez%' OR
				Encabezado like '%Remedios Ramos Gonzalez%' OR
				Encabezado like '%Remedios Rafael Gonzalez%' OR
				Encabezado like '%Fernando Zamora Morales%' OR
				Encabezado like '%David Lopez Cardenas%' OR
				Encabezado like '%Manuel Castrejon Morales%' OR
				Encabezado like '%Adolfo Solis Gomez%' OR
				Encabezado like '%Jaime Cervantes Sanchez%' OR
				Encabezado like '%Antonio Barrera Alcantara%' OR

				PieFoto like '%Indalecio Rios Velazquez%' OR
				PieFoto like '%Indalecio Rios%' OR
				PieFoto like '%Juan Hugo de la Rosa Garcia%' OR
				PieFoto like '%Hugo de la Rosa Garcia%' OR
				PieFoto like '%Juan de la Rosa Garcia%' OR
				PieFoto like '%Edgar Armando Olvera Higuera%' OR
				PieFoto like '%Edgar Olvera Higuera%' OR
				PieFoto like '%Armando Olvera Higuera%' OR
				PieFoto like '%Aurora Denisse Ugalde Alegria%' OR
				PieFoto like '%Aurora Ugalde Alegria%' OR
				PieFoto like '%Denisse Ugalde Alegria%' OR
				PieFoto like '%Rosalba Pineda Ramirez%' OR
				PieFoto like '%Jorge Adan Barron Elizalde%' OR
				PieFoto like '%Adan Barron Elizalde%' OR
				PieFoto like '%Jorge Barron Elizalde%' OR
				PieFoto like '%Victor Manuel Estrada Garibay%' OR
				PieFoto like '%Manuel Estrada Garibay%' OR
				PieFoto like '%Victor Estrada Garibay%' OR
				PieFoto like '%Ana Maria Balderas Trejo%' OR
				PieFoto like '%Ana Maria Balderas%' OR
				PieFoto like '%Carlos Enriquez Santos%' OR
				PieFoto like '%Remedios Rafael Ramos Gonzalez%' OR
				PieFoto like '%Remedios Ramos Gonzalez%' OR
				PieFoto like '%Remedios Rafael Gonzalez%' OR
				PieFoto like '%Fernando Zamora Morales%' OR
				PieFoto like '%David Lopez Cardenas%' OR
				PieFoto like '%Manuel Castrejon Morales%' OR
				PieFoto like '%Adolfo Solis Gomez%' OR
				PieFoto like '%Jaime Cervantes Sanchez%' OR
				PieFoto like '%Antonio Barrera Alcantara%' OR

				Autor like '%Indalecio Rios Velazquez%' OR
				Autor like '%Indalecio Rios%' OR
				Autor like '%Juan Hugo de la Rosa Garcia%' OR
				Autor like '%Hugo de la Rosa Garcia%' OR
				Autor like '%Juan de la Rosa Garcia%' OR
				Autor like '%Edgar Armando Olvera Higuera%' OR
				Autor like '%Edgar Olvera Higuera%' OR
				Autor like '%Armando Olvera Higuera%' OR
				Autor like '%Aurora Denisse Ugalde Alegria%' OR
				Autor like '%Aurora Ugalde Alegria%' OR
				Autor like '%Denisse Ugalde Alegria%' OR
				Autor like '%Rosalba Pineda Ramirez%' OR
				Autor like '%Jorge Adan Barron Elizalde%' OR
				Autor like '%Adan Barron Elizalde%' OR
				Autor like '%Jorge Barron Elizalde%' OR
				Autor like '%Victor Manuel Estrada Garibay%' OR
				Autor like '%Manuel Estrada Garibay%' OR
				Autor like '%Victor Estrada Garibay%' OR
				Autor like '%Ana Maria Balderas Trejo%' OR
				Autor like '%Ana Maria Balderas%' OR
				Autor like '%Carlos Enriquez Santos%' OR
				Autor like '%Remedios Rafael Ramos Gonzalez%' OR
				Autor like '%Remedios Ramos Gonzalez%' OR
				Autor like '%Remedios Rafael Gonzalez%' OR
				Autor like '%Fernando Zamora Morales%' OR
				Autor like '%David Lopez Cardenas%' OR
				Autor like '%Manuel Castrejon Morales%' OR
				Autor like '%Adolfo Solis Gomez%' OR
				Autor like '%Jaime Cervantes Sanchez%' OR
				Autor like '%Antonio Barrera Alcantara%'

                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 12:// Mpales Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Indalecio Rios Velazquez%' OR
				Texto like '%Indalecio Rios%' OR
				Texto like '%Juan Hugo de la Rosa Garcia%' OR
				Texto like '%Hugo de la Rosa Garcia%' OR
				Texto like '%Juan de la Rosa Garcia%' OR
				Texto like '%Edgar Armando Olvera Higuera%' OR
				Texto like '%Edgar Olvera Higuera%' OR
				Texto like '%Armando Olvera Higuera%' OR
				Texto like '%Aurora Denisse Ugalde Alegría%' OR
				Texto like '%Aurora Ugalde Alegria%' OR
				Texto like '%Denisse Ugalde Alegria%' OR
				Texto like '%Rosalba Pineda Ramirez%' OR
				Texto like '%Jorge Adan Barron Elizalde%' OR
				Texto like '%Adan Barron Elizalde%' OR
				Texto like '%Jorge Barron Elizalde%' OR
				Texto like '%Victor Manuel Estrada Garibay%' OR
				Texto like '%Manuel Estrada Garibay%' OR
				Texto like '%Victor Estrada Garibay%' OR
				Texto like '%Ana Maria Balderas Trejo%' OR
				Texto like '%Ana Maria Balderas%' OR
				Texto like '%Carlos Enriquez Santos%' OR
				Texto like '%Remedios Rafael Ramos Gonzalez%' OR
				Texto like '%Remedios Ramos Gonzalez%' OR
				Texto like '%Remedios Rafael Gonzalez%' OR
				Texto like '%Fernando Zamora Morales%' OR
				Texto like '%David Lopez Cardenas%' OR
				Texto like '%Manuel Castrejon Morales%' OR
				Texto like '%Adolfo Solis Gomez%' OR
				Texto like '%Jaime Cervantes Sanchez%' OR
				Texto like '%Antonio Barrera Alcantara%' OR

				Titulo like '%Indalecio Rios Velazquez%' OR
				Titulo like '%Indalecio Rios%' OR
				Titulo like '%Juan Hugo de la Rosa Garcia%' OR
				Titulo like '%Hugo de la Rosa Garcia%' OR
				Titulo like '%Juan de la Rosa Garcia%' OR
				Titulo like '%Edgar Armando Olvera Higuera%' OR
				Titulo like '%Edgar Olvera Higuera%' OR
				Titulo like '%Armando Olvera Higuera%' OR
				Titulo like '%Aurora Denisse Ugalde Alegria%' OR
				Titulo like '%Aurora Ugalde Alegria%' OR
				Titulo like '%Denisse Ugalde Alegria%' OR
				Titulo like '%Rosalba Pineda Ramirez%' OR
				Titulo like '%Jorge Adan Barron Elizalde%' OR
				Titulo like '%Adan Barron Elizalde%' OR
				Titulo like '%Jorge Barron Elizalde%' OR
				Titulo like '%Victor Manuel Estrada Garibay%' OR
				Titulo like '%Manuel Estrada Garibay%' OR
				Titulo like '%Victor Estrada Garibay%' OR
				Titulo like '%Ana Maria Balderas Trejo%' OR
				Titulo like '%Ana Maria Balderas%' OR
				Titulo like '%Carlos Enriquez Santos%' OR
				Titulo like '%Remedios Rafael Ramos Gonzalez%' OR
				Titulo like '%Remedios Ramos Gonzalez%' OR
				Titulo like '%Remedios Rafael Gonzalez%' OR
				Titulo like '%Fernando Zamora Morales%' OR
				Titulo like '%David Lopez Cardenas%' OR
				Titulo like '%Manuel Castrejon Morales%' OR
				Titulo like '%Adolfo Solis Gomez%' OR
				Titulo like '%Jaime Cervantes Sanchez%' OR
				Titulo like '%Antonio Barrera Alcantara%' OR

				Encabezado like '%Indalecio Rios Velazquez%' OR
				Encabezado like '%Indalecio Rios%' OR
				Encabezado like '%Juan Hugo de la Rosa Garcia%' OR
				Encabezado like '%Hugo de la Rosa Garcia%' OR
				Encabezado like '%Juan de la Rosa Garcia%' OR
				Encabezado like '%Edgar Armando Olvera Higuera%' OR
				Encabezado like '%Edgar Olvera Higuera%' OR
				Encabezado like '%Armando Olvera Higuera%' OR
				Encabezado like '%Aurora Denisse Ugalde Alegria%' OR
				Encabezado like '%Aurora Ugalde Alegria%' OR
				Encabezado like '%Denisse Ugalde Alegria%' OR
				Encabezado like '%Rosalba Pineda Ramirez%' OR
				Encabezado like '%Jorge Adan Barron Elizalde%' OR
				Encabezado like '%Adan Barron Elizalde%' OR
				Encabezado like '%Jorge Barron Elizalde%' OR
				Encabezado like '%Victor Manuel Estrada Garibay%' OR
				Encabezado like '%Manuel Estrada Garibay%' OR
				Encabezado like '%Victor Estrada Garibay%' OR
				Encabezado like '%Ana Maria Balderas Trejo%' OR
				Encabezado like '%Ana Maria Balderas%' OR
				Encabezado like '%Carlos Enriquez Santos%' OR
				Encabezado like '%Remedios Rafael Ramos Gonzalez%' OR
				Encabezado like '%Remedios Ramos Gonzalez%' OR
				Encabezado like '%Remedios Rafael Gonzalez%' OR
				Encabezado like '%Fernando Zamora Morales%' OR
				Encabezado like '%David Lopez Cardenas%' OR
				Encabezado like '%Manuel Castrejon Morales%' OR
				Encabezado like '%Adolfo Solis Gomez%' OR
				Encabezado like '%Jaime Cervantes Sanchez%' OR
				Encabezado like '%Antonio Barrera Alcantara%' OR

				PieFoto like '%Indalecio Rios Velazquez%' OR
				PieFoto like '%Indalecio Rios%' OR
				PieFoto like '%Juan Hugo de la Rosa Garcia%' OR
				PieFoto like '%Hugo de la Rosa Garcia%' OR
				PieFoto like '%Juan de la Rosa Garcia%' OR
				PieFoto like '%Edgar Armando Olvera Higuera%' OR
				PieFoto like '%Edgar Olvera Higuera%' OR
				PieFoto like '%Armando Olvera Higuera%' OR
				PieFoto like '%Aurora Denisse Ugalde Alegria%' OR
				PieFoto like '%Aurora Ugalde Alegria%' OR
				PieFoto like '%Denisse Ugalde Alegria%' OR
				PieFoto like '%Rosalba Pineda Ramirez%' OR
				PieFoto like '%Jorge Adan Barron Elizalde%' OR
				PieFoto like '%Adan Barron Elizalde%' OR
				PieFoto like '%Jorge Barron Elizalde%' OR
				PieFoto like '%Victor Manuel Estrada Garibay%' OR
				PieFoto like '%Manuel Estrada Garibay%' OR
				PieFoto like '%Victor Estrada Garibay%' OR
				PieFoto like '%Ana Maria Balderas Trejo%' OR
				PieFoto like '%Ana Maria Balderas%' OR
				PieFoto like '%Carlos Enriquez Santos%' OR
				PieFoto like '%Remedios Rafael Ramos Gonzalez%' OR
				PieFoto like '%Remedios Ramos Gonzalez%' OR
				PieFoto like '%Remedios Rafael Gonzalez%' OR
				PieFoto like '%Fernando Zamora Morales%' OR
				PieFoto like '%David Lopez Cardenas%' OR
				PieFoto like '%Manuel Castrejon Morales%' OR
				PieFoto like '%Adolfo Solis Gomez%' OR
				PieFoto like '%Jaime Cervantes Sanchez%' OR
				PieFoto like '%Antonio Barrera Alcantara%' OR

				Autor like '%Indalecio Rios Velazquez%' OR
				Autor like '%Indalecio Rios%' OR
				Autor like '%Juan Hugo de la Rosa Garcia%' OR
				Autor like '%Hugo de la Rosa Garcia%' OR
				Autor like '%Juan de la Rosa Garcia%' OR
				Autor like '%Edgar Armando Olvera Higuera%' OR
				Autor like '%Edgar Olvera Higuera%' OR
				Autor like '%Armando Olvera Higuera%' OR
				Autor like '%Aurora Denisse Ugalde Alegria%' OR
				Autor like '%Aurora Ugalde Alegria%' OR
				Autor like '%Denisse Ugalde Alegria%' OR
				Autor like '%Rosalba Pineda Ramirez%' OR
				Autor like '%Jorge Adan Barron Elizalde%' OR
				Autor like '%Adan Barron Elizalde%' OR
				Autor like '%Jorge Barron Elizalde%' OR
				Autor like '%Victor Manuel Estrada Garibay%' OR
				Autor like '%Manuel Estrada Garibay%' OR
				Autor like '%Victor Estrada Garibay%' OR
				Autor like '%Ana Maria Balderas Trejo%' OR
				Autor like '%Ana Maria Balderas%' OR
				Autor like '%Carlos Enriquez Santos%' OR
				Autor like '%Remedios Rafael Ramos Gonzalez%' OR
				Autor like '%Remedios Ramos Gonzalez%' OR
				Autor like '%Remedios Rafael Gonzalez%' OR
				Autor like '%Fernando Zamora Morales%' OR
				Autor like '%David Lopez Cardenas%' OR
				Autor like '%Manuel Castrejon Morales%' OR
				Autor like '%Adolfo Solis Gomez%' OR
				Autor like '%Jaime Cervantes Sanchez%' OR
				Autor like '%Antonio Barrera Alcantara%'

                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 13://Justicia 
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Sergio Javier Medina Penaloza%' OR
				Texto like '%Sergio Javier Penaloza%' OR
				Texto like '%Javier Medina Penaloza%' OR
				Texto like '%Sergio Medina Penaloza%' OR
				Texto like '%Palemon Jaime Salazar Hernandez%' OR
				Texto like '%Palemon Jaime Salazar%' OR
				Texto like '%Palemon Jaime Hernandez%' OR
				Texto like '%Palemon Salazar Hernandez%' OR
				Texto like '%Juan Manuel Trujillo Cisneros%' OR
				Texto like '%Juan Manuel Cisneros%' OR
				Texto like '%Juan Trujillo Cisneros%' OR
				Texto like '%Manuel Trujillo Cisneros%' OR
				Texto like '%Juan Manuel Telles Martinez%' OR
				Texto like '%Juan Telles Martinez%' OR
				Texto like '%Manuel Telles Martinez%' OR
				Texto like '%Joel Alfonso Sierra Palacios%' OR
				Texto like '%Alfonso Sierra Palacios%' OR
				Texto like '%Joel Sierra Palacios%' OR
				Texto like '%Marco Antonio Morales Gomez%' OR
				Texto like '%Marco Morales Gomez%' OR
				Texto like '%Antonio Morales Gomez%' OR
				Texto like '%Otoniel Campiran Perez%' OR
				Texto like '%Otoniel Campiran%' OR
				Texto like '%Campiran Perez%' OR
				Texto like '%Maria Alejandra Almazan Barrera%' OR
				Texto like '%Maria Almazan Barrera%' OR
				Texto like '%Alejandra Almazan Barrera%' OR
				Texto like '%Sara Gabriela Bonilla Lopez%' OR
				Texto like '%Sara Bonilla Lopez%' OR
				Texto like '%Gabriela Bonilla Lopez%' OR
				Texto like '%Erika Icela Castillo Vega%' OR
				Texto like '%Icela Castillo Vega%' OR
				Texto like '%Edwin Milton Cruz Casares%' OR
				Texto like '%Edwin Milton Casares%' OR
				Texto like '%Edwin Cruz Casares%' OR
				Texto like '%Milton Cruz Casares%' OR
				Texto like '%Marco Antonio Diaz Rodriguez%' OR
				Texto like '%Marco Diaz Rodriguez%' OR
				Texto like '%Antonio Diaz Rodriguez%' OR
				Texto like '%Jose Luis Maya Mendoza%' OR
				Texto like '%Luis Maya Mendoza%' OR
				Texto like '%Jose Maya Mendoza%' OR
				Texto like '%Edgar Hernan Mejia Lopez%' OR
				Texto like '%Edgar Mejia Lopez%' OR
				Texto like '%Hernan Mejia Lopez%' OR
				Texto like '%Mario Eduardo Navarro Cabra%' OR
				Texto like '%Eduardo Navarro Cabra%' OR
				Texto like '%Mario Navarro Cabra%' OR
				Texto like '%Jose Luis Cervantes Martinez%' OR
				Texto like '%Jose Cervantes Martinez%' OR
				Texto like '%Luis Cervantes Martinez%' OR
				Texto like '%Fernando Diaz Juarez%' OR
				Texto like '%Jose Luis Embris Vasquez%' OR
				Texto like '%Luis Embris Vasquez%' OR
				Texto like '%Jose Embris Vasquez%' OR
				Texto like '%Arturo Marquez Gonzalez%' OR
    
				Titulo like '%Sergio Javier Medina Penaloza%' OR
				Titulo like '%Sergio Javier Penaloza%' OR
				Titulo like '%Javier Medina Penaloza%' OR
				Titulo like '%Sergio Medina Penaloza%' OR
				Titulo like '%Palemon Jaime Salazar Hernandez%' OR
				Titulo like '%Palemon Jaime Salazar%' OR
				Titulo like '%Palemon Jaime Hernandez%' OR
				Titulo like '%Palemon Salazar Hernandez%' OR
				Titulo like '%Juan Manuel Trujillo Cisneros%' OR
				Titulo like '%Juan Manuel Cisneros%' OR
				Titulo like '%Juan Trujillo Cisneros%' OR
				Titulo like '%Manuel Trujillo Cisneros%' OR
				Titulo like '%Juan Manuel Telles Martinez%' OR
				Titulo like '%Juan Telles Martinez%' OR
				Titulo like '%Manuel Telles Martinez%' OR
				Titulo like '%Joel Alfonso Sierra Palacios%' OR
				Titulo like '%Alfonso Sierra Palacios%' OR
				Titulo like '%Joel Sierra Palacios%' OR
				Titulo like '%Marco Antonio Morales Gomez%' OR
				Titulo like '%Marco Morales Gomez%' OR
				Titulo like '%Antonio Morales Gomez%' OR
				Titulo like '%Otoniel Campiran Perez%' OR
				Titulo like '%Otoniel Campiran%' OR
				Titulo like '%Campiran Perez%' OR
				Titulo like '%Maria Alejandra Almazan Barrera%' OR
				Titulo like '%Maria Almazan Barrera%' OR
				Titulo like '%Alejandra Almazan Barrera%' OR
				Titulo like '%Sara Gabriela Bonilla Lopez%' OR
				Titulo like '%Sara Bonilla Lopez%' OR
				Titulo like '%Gabriela Bonilla Lopez%' OR
				Titulo like '%Erika Icela Castillo Vega%' OR
				Titulo like '%Icela Castillo Vega%' OR
				Titulo like '%Edwin Milton Cruz Casares%' OR
				Titulo like '%Edwin Milton Casares%' OR
				Titulo like '%Edwin Cruz Casares%' OR
				Titulo like '%Milton Cruz Casares%' OR
				Titulo like '%Marco Antonio Diaz Rodriguez%' OR
				Titulo like '%Marco Diaz Rodriguez%' OR
				Titulo like '%Antonio Diaz Rodriguez%' OR
				Titulo like '%Jose Luis Maya Mendoza%' OR
				Titulo like '%Luis Maya Mendoza%' OR
				Titulo like '%Jose Maya Mendoza%' OR
				Titulo like '%Edgar Hernan Mejia Lopez%' OR
				Titulo like '%Edgar Mejia Lopez%' OR
				Titulo like '%Hernan Mejia Lopez%' OR
				Titulo like '%Mario Eduardo Navarro Cabra%' OR
				Titulo like '%Eduardo Navarro Cabra%' OR
				Titulo like '%Mario Navarro Cabra%' OR
				Titulo like '%Jose Luis Cervantes Martinez%' OR
				Titulo like '%Jose Cervantes Martinez%' OR
				Titulo like '%Luis Cervantes Martinez%' OR
				Titulo like '%Fernando Diaz Juarez%' OR
				Titulo like '%Jose Luis Embris Vasquez%' OR
				Titulo like '%Luis Embris Vasquez%' OR
				Titulo like '%Jose Embris Vasquez%' OR
				Titulo like '%Arturo Marquez Gonzalez%' OR

				Encabezado like '%Sergio Javier Medina Penaloza%' OR
				Encabezado like '%Sergio Javier Penaloza%' OR
				Encabezado like '%Javier Medina Penaloza%' OR
				Encabezado like '%Sergio Medina Penaloza%' OR
				Encabezado like '%Palemon Jaime Salazar Hernandez%' OR
				Encabezado like '%Palemon Jaime Salazar%' OR
				Encabezado like '%Palemon Jaime Hernandez%' OR
				Encabezado like '%Palemon Salazar Hernandez%' OR
				Encabezado like '%Juan Manuel Trujillo Cisneros%' OR
				Encabezado like '%Juan Manuel Cisneros%' OR
				Encabezado like '%Juan Trujillo Cisneros%' OR
				Encabezado like '%Manuel Trujillo Cisneros%' OR
				Encabezado like '%Juan Manuel Telles Martinez%' OR
				Encabezado like '%Juan Telles Martinez%' OR
				Encabezado like '%Manuel Telles Martinez%' OR
				Encabezado like '%Joel Alfonso Sierra Palacios%' OR
				Encabezado like '%Alfonso Sierra Palacios%' OR
				Encabezado like '%Joel Sierra Palacios%' OR
				Encabezado like '%Marco Antonio Morales Gomez%' OR
				Encabezado like '%Marco Morales Gomez%' OR
				Encabezado like '%Antonio Morales Gomez%' OR
				Encabezado like '%Otoniel Campiran Perez%' OR
				Encabezado like '%Otoniel Campiran%' OR
				Encabezado like '%Campiran Perez%' OR
				Encabezado like '%Maria Alejandra Almazan Barrera%' OR
				Encabezado like '%Maria Almazan Barrera%' OR
				Encabezado like '%Alejandra Almazan Barrera%' OR
				Encabezado like '%Sara Gabriela Bonilla Lopez%' OR
				Encabezado like '%Sara Bonilla Lopez%' OR
				Encabezado like '%Gabriela Bonilla Lopez%' OR
				Encabezado like '%Erika Icela Castillo Vega%' OR
				Encabezado like '%Icela Castillo Vega%' OR
				Encabezado like '%Edwin Milton Cruz Casares%' OR
				Encabezado like '%Edwin Milton Casares%' OR
				Encabezado like '%Edwin Cruz Casares%' OR
				Encabezado like '%Milton Cruz Casares%' OR
				Encabezado like '%Marco Antonio Diaz Rodriguez%' OR
				Encabezado like '%Marco Diaz Rodriguez%' OR
				Encabezado like '%Antonio Diaz Rodriguez%' OR
				Encabezado like '%Jose Luis Maya Mendoza%' OR
				Encabezado like '%Luis Maya Mendoza%' OR
				Encabezado like '%Jose Maya Mendoza%' OR
				Encabezado like '%Edgar Hernan Mejia Lopez%' OR
				Encabezado like '%Edgar Mejia Lopez%' OR
				Encabezado like '%Hernan Mejia Lopez%' OR
				Encabezado like '%Mario Eduardo Navarro Cabra%' OR
				Encabezado like '%Eduardo Navarro Cabra%' OR
				Encabezado like '%Mario Navarro Cabra%' OR
				Encabezado like '%Jose Luis Cervantes Martinez%' OR
				Encabezado like '%Jose Cervantes Martinez%' OR
				Encabezado like '%Luis Cervantes Martinez%' OR
				Encabezado like '%Fernando Diaz Juarez%' OR
				Encabezado like '%Jose Luis Embris Vasquez%' OR
				Encabezado like '%Luis Embris Vasquez%' OR
				Encabezado like '%Jose Embris Vasquez%' OR
				Encabezado like '%Arturo Marquez Gonzalez%' OR
        
				PieFoto like '%Sergio Javier Medina Penaloza%' OR
				PieFoto like '%Sergio Javier Penaloza%' OR
				PieFoto like '%Javier Medina Penaloza%' OR
				PieFoto like '%Sergio Medina Penaloza%' OR
				PieFoto like '%Palemon Jaime Salazar Hernandez%' OR
				PieFoto like '%Palemon Jaime Salazar%' OR
				PieFoto like '%Palemon Jaime Hernandez%' OR
				PieFoto like '%Palemon Salazar Hernandez%' OR
				PieFoto like '%Juan Manuel Trujillo Cisneros%' OR
				PieFoto like '%Juan Manuel Cisneros%' OR
				PieFoto like '%Juan Trujillo Cisneros%' OR
				PieFoto like '%Manuel Trujillo Cisneros%' OR
				PieFoto like '%Juan Manuel Telles Martinez%' OR
				PieFoto like '%Juan Telles Martinez%' OR
				PieFoto like '%Manuel Telles Martinez%' OR
				PieFoto like '%Joel Alfonso Sierra Palacios%' OR
				PieFoto like '%Alfonso Sierra Palacios%' OR
				PieFoto like '%Joel Sierra Palacios%' OR
				PieFoto like '%Marco Antonio Morales Gomez%' OR
				PieFoto like '%Marco Morales Gomez%' OR
				PieFoto like '%Antonio Morales Gomez%' OR
				PieFoto like '%Otoniel Campiran Perez%' OR
				PieFoto like '%Otoniel Campiran%' OR
				PieFoto like '%Campiran Perez%' OR
				PieFoto like '%Maria Alejandra Almazan Barrera%' OR
				PieFoto like '%Maria Almazan Barrera%' OR
				PieFoto like '%Alejandra Almazan Barrera%' OR
				PieFoto like '%Sara Gabriela Bonilla Lopez%' OR
				PieFoto like '%Sara Bonilla Lopez%' OR
				PieFoto like '%Gabriela Bonilla Lopez%' OR
				PieFoto like '%Erika Icela Castillo Vega%' OR
				PieFoto like '%Icela Castillo Vega%' OR
				PieFoto like '%Edwin Milton Cruz Casares%' OR
				PieFoto like '%Edwin Milton Casares%' OR
				PieFoto like '%Edwin Cruz Casares%' OR
				PieFoto like '%Milton Cruz Casares%' OR
				PieFoto like '%Marco Antonio Diaz Rodriguez%' OR
				PieFoto like '%Marco Diaz Rodriguez%' OR
				PieFoto like '%Antonio Diaz Rodriguez%' OR
				PieFoto like '%Jose Luis Maya Mendoza%' OR
				PieFoto like '%Luis Maya Mendoza%' OR
				PieFoto like '%Jose Maya Mendoza%' OR
				PieFoto like '%Edgar Hernan Mejia Lopez%' OR
				PieFoto like '%Edgar Mejia Lopez%' OR
				PieFoto like '%Hernan Mejia Lopez%' OR
				PieFoto like '%Mario Eduardo Navarro Cabra%' OR
				PieFoto like '%Eduardo Navarro Cabra%' OR
				PieFoto like '%Mario Navarro Cabra%' OR
				PieFoto like '%Jose Luis Cervantes Martinez%' OR
				PieFoto like '%Jose Cervantes Martinez%' OR
				PieFoto like '%Luis Cervantes Martinez%' OR
				PieFoto like '%Fernando Diaz Juarez%' OR
				PieFoto like '%Jose Luis Embris Vasquez%' OR
				PieFoto like '%Luis Embris Vasquez%' OR
				PieFoto like '%Jose Embris Vasquez%' OR
				PieFoto like '%Arturo Marquez Gonzalez%' OR
		
				Autor like '%Sergio Javier Medina Penaloza%' OR
				Autor like '%Sergio Javier Penaloza%' OR
				Autor like '%Javier Medina Penaloza%' OR
				Autor like '%Sergio Medina Penaloza%' OR
				Autor like '%Palemon Jaime Salazar Hernandez%' OR
				Autor like '%Palemon Jaime Salazar%' OR
				Autor like '%Palemon Jaime Hernandez%' OR
				Autor like '%Palemon Salazar Hernandez%' OR
				Autor like '%Juan Manuel Trujillo Cisneros%' OR
				Autor like '%Juan Manuel Cisneros%' OR
				Autor like '%Juan Trujillo Cisneros%' OR
				Autor like '%Manuel Trujillo Cisneros%' OR
				Autor like '%Juan Manuel Telles Martinez%' OR
				Autor like '%Juan Telles Martinez%' OR
				Autor like '%Manuel Telles Martinez%' OR
				Autor like '%Joel Alfonso Sierra Palacios%' OR
				Autor like '%Alfonso Sierra Palacios%' OR
				Autor like '%Joel Sierra Palacios%' OR
				Autor like '%Marco Antonio Morales Gomez%' OR
				Autor like '%Marco Morales Gomez%' OR
				Autor like '%Antonio Morales Gomez%' OR
				Autor like '%Otoniel Campiran Perez%' OR
				Autor like '%Otoniel Campiran%' OR
				Autor like '%Campiran Perez%' OR
				Autor like '%Maria Alejandra Almazan Barrera%' OR
				Autor like '%Maria Almazan Barrera%' OR
				Autor like '%Alejandra Almazan Barrera%' OR
				Autor like '%Sara Gabriela Bonilla Lopez%' OR
				Autor like '%Sara Bonilla Lopez%' OR
				Autor like '%Gabriela Bonilla Lopez%' OR
				Autor like '%Erika Icela Castillo Vega%' OR
				Autor like '%Icela Castillo Vega%' OR
				Autor like '%Edwin Milton Cruz Casares%' OR
				Autor like '%Edwin Milton Casares%' OR
				Autor like '%Edwin Cruz Casares%' OR
				Autor like '%Milton Cruz Casares%' OR
				Autor like '%Marco Antonio Diaz Rodriguez%' OR
				Autor like '%Marco Diaz Rodriguez%' OR
				Autor like '%Antonio Diaz Rodriguez%' OR
				Autor like '%Jose Luis Maya Mendoza%' OR
				Autor like '%Luis Maya Mendoza%' OR
				Autor like '%Jose Maya Mendoza%' OR
				Autor like '%Edgar Hernan Mejia Lopez%' OR
				Autor like '%Edgar Mejia Lopez%' OR
				Autor like '%Hernan Mejia Lopez%' OR
				Autor like '%Mario Eduardo Navarro Cabra%' OR
				Autor like '%Eduardo Navarro Cabra%' OR
				Autor like '%Mario Navarro Cabra%' OR
				Autor like '%Jose Luis Cervantes Martinez%' OR
				Autor like '%Jose Cervantes Martinez%' OR
				Autor like '%Luis Cervantes Martinez%' OR
				Autor like '%Fernando Diaz Juarez%' OR
				Autor like '%Jose Luis Embris Vasquez%' OR
				Autor like '%Luis Embris Vasquez%' OR
				Autor like '%Jose Embris Vasquez%' OR
				Autor like '%Arturo Marquez Gonzalez%' 

                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 14:// Justicia estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Sergio Javier Medina Penaloza%' OR
				Texto like '%Sergio Javier Penaloza%' OR
				Texto like '%Javier Medina Penaloza%' OR
				Texto like '%Sergio Medina Penaloza%' OR
				Texto like '%Palemon Jaime Salazar Hernandez%' OR
				Texto like '%Palemon Jaime Salazar%' OR
				Texto like '%Palemon Jaime Hernandez%' OR
				Texto like '%Palemon Salazar Hernandez%' OR
				Texto like '%Juan Manuel Trujillo Cisneros%' OR
				Texto like '%Juan Manuel Cisneros%' OR
				Texto like '%Juan Trujillo Cisneros%' OR
				Texto like '%Manuel Trujillo Cisneros%' OR
				Texto like '%Juan Manuel Telles Martinez%' OR
				Texto like '%Juan Telles Martinez%' OR
				Texto like '%Manuel Telles Martinez%' OR
				Texto like '%Joel Alfonso Sierra Palacios%' OR
				Texto like '%Alfonso Sierra Palacios%' OR
				Texto like '%Joel Sierra Palacios%' OR
				Texto like '%Marco Antonio Morales Gomez%' OR
				Texto like '%Marco Morales Gomez%' OR
				Texto like '%Antonio Morales Gomez%' OR
				Texto like '%Otoniel Campiran Perez%' OR
				Texto like '%Otoniel Campiran%' OR
				Texto like '%Campiran Perez%' OR
				Texto like '%Maria Alejandra Almazan Barrera%' OR
				Texto like '%Maria Almazan Barrera%' OR
				Texto like '%Alejandra Almazan Barrera%' OR
				Texto like '%Sara Gabriela Bonilla Lopez%' OR
				Texto like '%Sara Bonilla Lopez%' OR
				Texto like '%Gabriela Bonilla Lopez%' OR
				Texto like '%Erika Icela Castillo Vega%' OR
				Texto like '%Icela Castillo Vega%' OR
				Texto like '%Edwin Milton Cruz Casares%' OR
				Texto like '%Edwin Milton Casares%' OR
				Texto like '%Edwin Cruz Casares%' OR
				Texto like '%Milton Cruz Casares%' OR
				Texto like '%Marco Antonio Diaz Rodriguez%' OR
				Texto like '%Marco Diaz Rodriguez%' OR
				Texto like '%Antonio Diaz Rodriguez%' OR
				Texto like '%Jose Luis Maya Mendoza%' OR
				Texto like '%Luis Maya Mendoza%' OR
				Texto like '%Jose Maya Mendoza%' OR
				Texto like '%Edgar Hernan Mejia Lopez%' OR
				Texto like '%Edgar Mejia Lopez%' OR
				Texto like '%Hernan Mejia Lopez%' OR
				Texto like '%Mario Eduardo Navarro Cabra%' OR
				Texto like '%Eduardo Navarro Cabra%' OR
				Texto like '%Mario Navarro Cabra%' OR
				Texto like '%Jose Luis Cervantes Martinez%' OR
				Texto like '%Jose Cervantes Martinez%' OR
				Texto like '%Luis Cervantes Martinez%' OR
				Texto like '%Fernando Diaz Juarez%' OR
				Texto like '%Jose Luis Embris Vasquez%' OR
				Texto like '%Luis Embris Vasquez%' OR
				Texto like '%Jose Embris Vasquez%' OR
				Texto like '%Arturo Marquez Gonzalez%' OR
    
				Titulo like '%Sergio Javier Medina Penaloza%' OR
				Titulo like '%Sergio Javier Penaloza%' OR
				Titulo like '%Javier Medina Penaloza%' OR
				Titulo like '%Sergio Medina Penaloza%' OR
				Titulo like '%Palemon Jaime Salazar Hernandez%' OR
				Titulo like '%Palemon Jaime Salazar%' OR
				Titulo like '%Palemon Jaime Hernandez%' OR
				Titulo like '%Palemon Salazar Hernandez%' OR
				Titulo like '%Juan Manuel Trujillo Cisneros%' OR
				Titulo like '%Juan Manuel Cisneros%' OR
				Titulo like '%Juan Trujillo Cisneros%' OR
				Titulo like '%Manuel Trujillo Cisneros%' OR
				Titulo like '%Juan Manuel Telles Martinez%' OR
				Titulo like '%Juan Telles Martinez%' OR
				Titulo like '%Manuel Telles Martinez%' OR
				Titulo like '%Joel Alfonso Sierra Palacios%' OR
				Titulo like '%Alfonso Sierra Palacios%' OR
				Titulo like '%Joel Sierra Palacios%' OR
				Titulo like '%Marco Antonio Morales Gomez%' OR
				Titulo like '%Marco Morales Gomez%' OR
				Titulo like '%Antonio Morales Gomez%' OR
				Titulo like '%Otoniel Campiran Perez%' OR
				Titulo like '%Otoniel Campiran%' OR
				Titulo like '%Campiran Perez%' OR
				Titulo like '%Maria Alejandra Almazan Barrera%' OR
				Titulo like '%Maria Almazan Barrera%' OR
				Titulo like '%Alejandra Almazan Barrera%' OR
				Titulo like '%Sara Gabriela Bonilla Lopez%' OR
				Titulo like '%Sara Bonilla Lopez%' OR
				Titulo like '%Gabriela Bonilla Lopez%' OR
				Titulo like '%Erika Icela Castillo Vega%' OR
				Titulo like '%Icela Castillo Vega%' OR
				Titulo like '%Edwin Milton Cruz Casares%' OR
				Titulo like '%Edwin Milton Casares%' OR
				Titulo like '%Edwin Cruz Casares%' OR
				Titulo like '%Milton Cruz Casares%' OR
				Titulo like '%Marco Antonio Diaz Rodriguez%' OR
				Titulo like '%Marco Diaz Rodriguez%' OR
				Titulo like '%Antonio Diaz Rodriguez%' OR
				Titulo like '%Jose Luis Maya Mendoza%' OR
				Titulo like '%Luis Maya Mendoza%' OR
				Titulo like '%Jose Maya Mendoza%' OR
				Titulo like '%Edgar Hernan Mejia Lopez%' OR
				Titulo like '%Edgar Mejia Lopez%' OR
				Titulo like '%Hernan Mejia Lopez%' OR
				Titulo like '%Mario Eduardo Navarro Cabra%' OR
				Titulo like '%Eduardo Navarro Cabra%' OR
				Titulo like '%Mario Navarro Cabra%' OR
				Titulo like '%Jose Luis Cervantes Martinez%' OR
				Titulo like '%Jose Cervantes Martinez%' OR
				Titulo like '%Luis Cervantes Martinez%' OR
				Titulo like '%Fernando Diaz Juarez%' OR
				Titulo like '%Jose Luis Embris Vasquez%' OR
				Titulo like '%Luis Embris Vasquez%' OR
				Titulo like '%Jose Embris Vasquez%' OR
				Titulo like '%Arturo Marquez Gonzalez%' OR

				Encabezado like '%Sergio Javier Medina Penaloza%' OR
				Encabezado like '%Sergio Javier Penaloza%' OR
				Encabezado like '%Javier Medina Penaloza%' OR
				Encabezado like '%Sergio Medina Penaloza%' OR
				Encabezado like '%Palemon Jaime Salazar Hernandez%' OR
				Encabezado like '%Palemon Jaime Salazar%' OR
				Encabezado like '%Palemon Jaime Hernandez%' OR
				Encabezado like '%Palemon Salazar Hernandez%' OR
				Encabezado like '%Juan Manuel Trujillo Cisneros%' OR
				Encabezado like '%Juan Manuel Cisneros%' OR
				Encabezado like '%Juan Trujillo Cisneros%' OR
				Encabezado like '%Manuel Trujillo Cisneros%' OR
				Encabezado like '%Juan Manuel Telles Martinez%' OR
				Encabezado like '%Juan Telles Martinez%' OR
				Encabezado like '%Manuel Telles Martinez%' OR
				Encabezado like '%Joel Alfonso Sierra Palacios%' OR
				Encabezado like '%Alfonso Sierra Palacios%' OR
				Encabezado like '%Joel Sierra Palacios%' OR
				Encabezado like '%Marco Antonio Morales Gomez%' OR
				Encabezado like '%Marco Morales Gomez%' OR
				Encabezado like '%Antonio Morales Gomez%' OR
				Encabezado like '%Otoniel Campiran Perez%' OR
				Encabezado like '%Otoniel Campiran%' OR
				Encabezado like '%Campiran Perez%' OR
				Encabezado like '%Maria Alejandra Almazan Barrera%' OR
				Encabezado like '%Maria Almazan Barrera%' OR
				Encabezado like '%Alejandra Almazan Barrera%' OR
				Encabezado like '%Sara Gabriela Bonilla Lopez%' OR
				Encabezado like '%Sara Bonilla Lopez%' OR
				Encabezado like '%Gabriela Bonilla Lopez%' OR
				Encabezado like '%Erika Icela Castillo Vega%' OR
				Encabezado like '%Icela Castillo Vega%' OR
				Encabezado like '%Edwin Milton Cruz Casares%' OR
				Encabezado like '%Edwin Milton Casares%' OR
				Encabezado like '%Edwin Cruz Casares%' OR
				Encabezado like '%Milton Cruz Casares%' OR
				Encabezado like '%Marco Antonio Diaz Rodriguez%' OR
				Encabezado like '%Marco Diaz Rodriguez%' OR
				Encabezado like '%Antonio Diaz Rodriguez%' OR
				Encabezado like '%Jose Luis Maya Mendoza%' OR
				Encabezado like '%Luis Maya Mendoza%' OR
				Encabezado like '%Jose Maya Mendoza%' OR
				Encabezado like '%Edgar Hernan Mejia Lopez%' OR
				Encabezado like '%Edgar Mejia Lopez%' OR
				Encabezado like '%Hernan Mejia Lopez%' OR
				Encabezado like '%Mario Eduardo Navarro Cabra%' OR
				Encabezado like '%Eduardo Navarro Cabra%' OR
				Encabezado like '%Mario Navarro Cabra%' OR
				Encabezado like '%Jose Luis Cervantes Martinez%' OR
				Encabezado like '%Jose Cervantes Martinez%' OR
				Encabezado like '%Luis Cervantes Martinez%' OR
				Encabezado like '%Fernando Diaz Juarez%' OR
				Encabezado like '%Jose Luis Embris Vasquez%' OR
				Encabezado like '%Luis Embris Vasquez%' OR
				Encabezado like '%Jose Embris Vasquez%' OR
				Encabezado like '%Arturo Marquez Gonzalez%' OR
        
				PieFoto like '%Sergio Javier Medina Penaloza%' OR
				PieFoto like '%Sergio Javier Penaloza%' OR
				PieFoto like '%Javier Medina Penaloza%' OR
				PieFoto like '%Sergio Medina Penaloza%' OR
				PieFoto like '%Palemon Jaime Salazar Hernandez%' OR
				PieFoto like '%Palemon Jaime Salazar%' OR
				PieFoto like '%Palemon Jaime Hernandez%' OR
				PieFoto like '%Palemon Salazar Hernandez%' OR
				PieFoto like '%Juan Manuel Trujillo Cisneros%' OR
				PieFoto like '%Juan Manuel Cisneros%' OR
				PieFoto like '%Juan Trujillo Cisneros%' OR
				PieFoto like '%Manuel Trujillo Cisneros%' OR
				PieFoto like '%Juan Manuel Telles Martinez%' OR
				PieFoto like '%Juan Telles Martinez%' OR
				PieFoto like '%Manuel Telles Martinez%' OR
				PieFoto like '%Joel Alfonso Sierra Palacios%' OR
				PieFoto like '%Alfonso Sierra Palacios%' OR
				PieFoto like '%Joel Sierra Palacios%' OR
				PieFoto like '%Marco Antonio Morales Gomez%' OR
				PieFoto like '%Marco Morales Gomez%' OR
				PieFoto like '%Antonio Morales Gomez%' OR
				PieFoto like '%Otoniel Campiran Perez%' OR
				PieFoto like '%Otoniel Campiran%' OR
				PieFoto like '%Campiran Perez%' OR
				PieFoto like '%Maria Alejandra Almazan Barrera%' OR
				PieFoto like '%Maria Almazan Barrera%' OR
				PieFoto like '%Alejandra Almazan Barrera%' OR
				PieFoto like '%Sara Gabriela Bonilla Lopez%' OR
				PieFoto like '%Sara Bonilla Lopez%' OR
				PieFoto like '%Gabriela Bonilla Lopez%' OR
				PieFoto like '%Erika Icela Castillo Vega%' OR
				PieFoto like '%Icela Castillo Vega%' OR
				PieFoto like '%Edwin Milton Cruz Casares%' OR
				PieFoto like '%Edwin Milton Casares%' OR
				PieFoto like '%Edwin Cruz Casares%' OR
				PieFoto like '%Milton Cruz Casares%' OR
				PieFoto like '%Marco Antonio Diaz Rodriguez%' OR
				PieFoto like '%Marco Diaz Rodriguez%' OR
				PieFoto like '%Antonio Diaz Rodriguez%' OR
				PieFoto like '%Jose Luis Maya Mendoza%' OR
				PieFoto like '%Luis Maya Mendoza%' OR
				PieFoto like '%Jose Maya Mendoza%' OR
				PieFoto like '%Edgar Hernan Mejia Lopez%' OR
				PieFoto like '%Edgar Mejia Lopez%' OR
				PieFoto like '%Hernan Mejia Lopez%' OR
				PieFoto like '%Mario Eduardo Navarro Cabra%' OR
				PieFoto like '%Eduardo Navarro Cabra%' OR
				PieFoto like '%Mario Navarro Cabra%' OR
				PieFoto like '%Jose Luis Cervantes Martinez%' OR
				PieFoto like '%Jose Cervantes Martinez%' OR
				PieFoto like '%Luis Cervantes Martinez%' OR
				PieFoto like '%Fernando Diaz Juarez%' OR
				PieFoto like '%Jose Luis Embris Vasquez%' OR
				PieFoto like '%Luis Embris Vasquez%' OR
				PieFoto like '%Jose Embris Vasquez%' OR
				PieFoto like '%Arturo Marquez Gonzalez%' OR
		
				Autor like '%Sergio Javier Medina Penaloza%' OR
				Autor like '%Sergio Javier Penaloza%' OR
				Autor like '%Javier Medina Penaloza%' OR
				Autor like '%Sergio Medina Penaloza%' OR
				Autor like '%Palemon Jaime Salazar Hernandez%' OR
				Autor like '%Palemon Jaime Salazar%' OR
				Autor like '%Palemon Jaime Hernandez%' OR
				Autor like '%Palemon Salazar Hernandez%' OR
				Autor like '%Juan Manuel Trujillo Cisneros%' OR
				Autor like '%Juan Manuel Cisneros%' OR
				Autor like '%Juan Trujillo Cisneros%' OR
				Autor like '%Manuel Trujillo Cisneros%' OR
				Autor like '%Juan Manuel Telles Martinez%' OR
				Autor like '%Juan Telles Martinez%' OR
				Autor like '%Manuel Telles Martinez%' OR
				Autor like '%Joel Alfonso Sierra Palacios%' OR
				Autor like '%Alfonso Sierra Palacios%' OR
				Autor like '%Joel Sierra Palacios%' OR
				Autor like '%Marco Antonio Morales Gomez%' OR
				Autor like '%Marco Morales Gomez%' OR
				Autor like '%Antonio Morales Gomez%' OR
				Autor like '%Otoniel Campiran Perez%' OR
				Autor like '%Otoniel Campiran%' OR
				Autor like '%Campiran Perez%' OR
				Autor like '%Maria Alejandra Almazan Barrera%' OR
				Autor like '%Maria Almazan Barrera%' OR
				Autor like '%Alejandra Almazan Barrera%' OR
				Autor like '%Sara Gabriela Bonilla Lopez%' OR
				Autor like '%Sara Bonilla Lopez%' OR
				Autor like '%Gabriela Bonilla Lopez%' OR
				Autor like '%Erika Icela Castillo Vega%' OR
				Autor like '%Icela Castillo Vega%' OR
				Autor like '%Edwin Milton Cruz Casares%' OR
				Autor like '%Edwin Milton Casares%' OR
				Autor like '%Edwin Cruz Casares%' OR
				Autor like '%Milton Cruz Casares%' OR
				Autor like '%Marco Antonio Diaz Rodriguez%' OR
				Autor like '%Marco Diaz Rodriguez%' OR
				Autor like '%Antonio Diaz Rodriguez%' OR
				Autor like '%Jose Luis Maya Mendoza%' OR
				Autor like '%Luis Maya Mendoza%' OR
				Autor like '%Jose Maya Mendoza%' OR
				Autor like '%Edgar Hernan Mejia Lopez%' OR
				Autor like '%Edgar Mejia Lopez%' OR
				Autor like '%Hernan Mejia Lopez%' OR
				Autor like '%Mario Eduardo Navarro Cabra%' OR
				Autor like '%Eduardo Navarro Cabra%' OR
				Autor like '%Mario Navarro Cabra%' OR
				Autor like '%Jose Luis Cervantes Martinez%' OR
				Autor like '%Jose Cervantes Martinez%' OR
				Autor like '%Luis Cervantes Martinez%' OR
				Autor like '%Fernando Diaz Juarez%' OR
				Autor like '%Jose Luis Embris Vasquez%' OR
				Autor like '%Luis Embris Vasquez%' OR
				Autor like '%Jose Embris Vasquez%' OR
				Autor like '%Arturo Marquez Gonzalez%' 

                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 15://Com. Soc 
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 16://Com. Soc Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 17:// P. Politicos
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Victor Hugo Sondon Saavedra%' OR
				Texto like '%Victor Hugo Sondon %' OR
				Texto like '%Hugo Sondon Saavedra%' OR
				Texto like '%Sondon Saavedra%' OR
				Texto like '%Ernesto Nemer Alvarez%' OR
				Texto like '%Ernesto Nemer%' OR
				Texto like '%Nemer Alvarez%' OR
				Texto like '%Omar Ortega Alvarez%' OR
				Texto like '%Ortega Alvarez%' OR
				Texto like '%Oscar Gonzalez Yanez%' OR
				Texto like '%Gonzalez Yanez%' OR
				Texto like '%Francisco Agundis Aria%' OR
				Texto like '%Agundis Aria%' OR
				Texto like '%Juan Ignacio Samperio Montano%' OR
				Texto like '%Juan Ignacio Samperio%' OR
				Texto like '%Juan Ignacio Montano%' OR
				Texto like '%Ignacio  Samperio Montano%' OR
				Texto like '%Lucila Garfias Gutierrez%' OR
				Texto like '%Garfias Gutierrez%' OR
				Texto like '%Horacio Duarte Olivares%' OR
				Texto like '%Vicente Alberto Onofre Vazquez%' OR
				Texto like '%Alberto Onofre Vazquez%' OR
				Texto like '%Vicente Onofre Vazquez%' OR
				Texto like '%Onofre Vazquez%' OR
				Texto like '%Irak Vargas Ramírez%' OR

				Titulo like '%Victor Hugo Sondon Saavedra%' OR
				Titulo like '%Victor Hugo Sondon %' OR
				Titulo like '%Hugo Sondon Saavedra%' OR
				Titulo like '%Sondon Saavedra%' OR
				Titulo like '%Ernesto Nemer Alvarez%' OR
				Titulo like '%Ernesto Nemer%' OR
				Titulo like '%Nemer Alvarez%' OR
				Titulo like '%Omar Ortega Alvarez%' OR
				Titulo like '%Ortega Alvarez%' OR
				Titulo like '%Oscar Gonzalez Yanez%' OR
				Titulo like '%Gonzalez Yanez%' OR
				Titulo like '%Francisco Agundis Aria%' OR
				Titulo like '%Agundis Aria%' OR
				Titulo like '%Juan Ignacio Samperio Montano%' OR
				Titulo like '%Juan Ignacio Samperio%' OR
				Titulo like '%Juan Ignacio Montano%' OR
				Titulo like '%Ignacio  Samperio Montano%' OR
				Titulo like '%Lucila Garfias Gutierrez%' OR
				Titulo like '%Garfias Gutierrez%' OR
				Titulo like '%Horacio Duarte Olivares%' OR
				Titulo like '%Vicente Alberto Onofre Vazquez%' OR
				Titulo like '%Alberto Onofre Vazquez%' OR
				Titulo like '%Vicente Onofre Vazquez%' OR
				Titulo like '%Onofre Vazquez%' OR
				Titulo like '%Irak Vargas Ramírez%' OR

				Encabezado like '%Victor Hugo Sondon Saavedra%' OR
				Encabezado like '%Victor Hugo Sondon %' OR
				Encabezado like '%Hugo Sondon Saavedra%' OR
				Encabezado like '%Sondon Saavedra%' OR
				Encabezado like '%Ernesto Nemer Alvarez%' OR
				Encabezado like '%Ernesto Nemer%' OR
				Encabezado like '%Nemer Alvarez%' OR
				Encabezado like '%Omar Ortega Alvarez%' OR
				Encabezado like '%Ortega Alvarez%' OR
				Encabezado like '%Oscar Gonzalez Yanez%' OR
				Encabezado like '%Gonzalez Yanez%' OR
				Encabezado like '%Francisco Agundis Aria%' OR
				Encabezado like '%Agundis Aria%' OR
				Encabezado like '%Juan Ignacio Samperio Montano%' OR
				Encabezado like '%Juan Ignacio Samperio%' OR
				Encabezado like '%Juan Ignacio Montano%' OR
				Encabezado like '%Ignacio  Samperio Montano%' OR
				Encabezado like '%Lucila Garfias Gutierrez%' OR
				Encabezado like '%Garfias Gutierrez%' OR
				Encabezado like '%Horacio Duarte Olivares%' OR
				Encabezado like '%Vicente Alberto Onofre Vazquez%' OR
				Encabezado like '%Alberto Onofre Vazquez%' OR
				Encabezado like '%Vicente Onofre Vazquez%' OR
				Encabezado like '%Onofre Vazquez%' OR
				Encabezado like '%Irak Vargas Ramírez%' OR

				PieFoto like '%Victor Hugo Sondon Saavedra%' OR
				PieFoto like '%Victor Hugo Sondon %' OR
				PieFoto like '%Hugo Sondon Saavedra%' OR
				PieFoto like '%Sondon Saavedra%' OR
				PieFoto like '%Ernesto Nemer Alvarez%' OR
				PieFoto like '%Ernesto Nemer%' OR
				PieFoto like '%Nemer Alvarez%' OR
				PieFoto like '%Omar Ortega Alvarez%' OR
				PieFoto like '%Ortega Alvarez%' OR
				PieFoto like '%Oscar Gonzalez Yanez%' OR
				PieFoto like '%Gonzalez Yanez%' OR
				PieFoto like '%Francisco Agundis Aria%' OR
				PieFoto like '%Agundis Aria%' OR
				PieFoto like '%Juan Ignacio Samperio Montano%' OR
				PieFoto like '%Juan Ignacio Samperio%' OR
				PieFoto like '%Juan Ignacio Montano%' OR
				PieFoto like '%Ignacio  Samperio Montano%' OR
				PieFoto like '%Lucila Garfias Gutierrez%' OR
				PieFoto like '%Garfias Gutierrez%' OR
				PieFoto like '%Horacio Duarte Olivares%' OR
				PieFoto like '%Vicente Alberto Onofre Vazquez%' OR
				PieFoto like '%Alberto Onofre Vazquez%' OR
				PieFoto like '%Vicente Onofre Vazquez%' OR
				PieFoto like '%Onofre Vazquez%' OR
				PieFoto like '%Irak Vargas Ramírez%' OR

				Autor like '%Victor Hugo Sondon Saavedra%' OR
				Autor like '%Victor Hugo Sondon %' OR
				Autor like '%Hugo Sondon Saavedra%' OR
				Autor like '%Sondon Saavedra%' OR
				Autor like '%Ernesto Nemer Alvarez%' OR
				Autor like '%Ernesto Nemer%' OR
				Autor like '%Nemer Alvarez%' OR
				Autor like '%Omar Ortega Alvarez%' OR
				Autor like '%Ortega Alvarez%' OR
				Autor like '%Oscar Gonzalez Yanez%' OR
				Autor like '%Gonzalez Yanez%' OR
				Autor like '%Francisco Agundis Aria%' OR
				Autor like '%Agundis Aria%' OR
				Autor like '%Juan Ignacio Samperio Montano%' OR
				Autor like '%Juan Ignacio Samperio%' OR
				Autor like '%Juan Ignacio Montano%' OR
				Autor like '%Ignacio  Samperio Montano%' OR
				Autor like '%Lucila Garfias Gutierrez%' OR
				Autor like '%Garfias Gutierrez%' OR
				Autor like '%Horacio Duarte Olivares%' OR
				Autor like '%Vicente Alberto Onofre Vazquez%' OR
				Autor like '%Alberto Onofre Vazquez%' OR
				Autor like '%Vicente Onofre Vazquez%' OR
				Autor like '%Onofre Vazquez%' OR
				Autor like '%Irak Vargas Ramírez%'

                            )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 18:// P. Politicos Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Victor Hugo Sondon Saavedra%' OR
				Texto like '%Victor Hugo Sondon %' OR
				Texto like '%Hugo Sondon Saavedra%' OR
				Texto like '%Sondon Saavedra%' OR
				Texto like '%Ernesto Nemer Alvarez%' OR
				Texto like '%Ernesto Nemer%' OR
				Texto like '%Nemer Alvarez%' OR
				Texto like '%Omar Ortega Alvarez%' OR
				Texto like '%Ortega Alvarez%' OR
				Texto like '%Oscar Gonzalez Yanez%' OR
				Texto like '%Gonzalez Yanez%' OR
				Texto like '%Francisco Agundis Aria%' OR
				Texto like '%Agundis Aria%' OR
				Texto like '%Juan Ignacio Samperio Montano%' OR
				Texto like '%Juan Ignacio Samperio%' OR
				Texto like '%Juan Ignacio Montano%' OR
				Texto like '%Ignacio  Samperio Montano%' OR
				Texto like '%Lucila Garfias Gutierrez%' OR
				Texto like '%Garfias Gutierrez%' OR
				Texto like '%Horacio Duarte Olivares%' OR
				Texto like '%Vicente Alberto Onofre Vazquez%' OR
				Texto like '%Alberto Onofre Vazquez%' OR
				Texto like '%Vicente Onofre Vazquez%' OR
				Texto like '%Onofre Vazquez%' OR
				Texto like '%Irak Vargas Ramírez%' OR

				Titulo like '%Victor Hugo Sondon Saavedra%' OR
				Titulo like '%Victor Hugo Sondon %' OR
				Titulo like '%Hugo Sondon Saavedra%' OR
				Titulo like '%Sondon Saavedra%' OR
				Titulo like '%Ernesto Nemer Alvarez%' OR
				Titulo like '%Ernesto Nemer%' OR
				Titulo like '%Nemer Alvarez%' OR
				Titulo like '%Omar Ortega Alvarez%' OR
				Titulo like '%Ortega Alvarez%' OR
				Titulo like '%Oscar Gonzalez Yanez%' OR
				Titulo like '%Gonzalez Yanez%' OR
				Titulo like '%Francisco Agundis Aria%' OR
				Titulo like '%Agundis Aria%' OR
				Titulo like '%Juan Ignacio Samperio Montano%' OR
				Titulo like '%Juan Ignacio Samperio%' OR
				Titulo like '%Juan Ignacio Montano%' OR
				Titulo like '%Ignacio  Samperio Montano%' OR
				Titulo like '%Lucila Garfias Gutierrez%' OR
				Titulo like '%Garfias Gutierrez%' OR
				Titulo like '%Horacio Duarte Olivares%' OR
				Titulo like '%Vicente Alberto Onofre Vazquez%' OR
				Titulo like '%Alberto Onofre Vazquez%' OR
				Titulo like '%Vicente Onofre Vazquez%' OR
				Titulo like '%Onofre Vazquez%' OR
				Titulo like '%Irak Vargas Ramírez%' OR

				Encabezado like '%Victor Hugo Sondon Saavedra%' OR
				Encabezado like '%Victor Hugo Sondon %' OR
				Encabezado like '%Hugo Sondon Saavedra%' OR
				Encabezado like '%Sondon Saavedra%' OR
				Encabezado like '%Ernesto Nemer Alvarez%' OR
				Encabezado like '%Ernesto Nemer%' OR
				Encabezado like '%Nemer Alvarez%' OR
				Encabezado like '%Omar Ortega Alvarez%' OR
				Encabezado like '%Ortega Alvarez%' OR
				Encabezado like '%Oscar Gonzalez Yanez%' OR
				Encabezado like '%Gonzalez Yanez%' OR
				Encabezado like '%Francisco Agundis Aria%' OR
				Encabezado like '%Agundis Aria%' OR
				Encabezado like '%Juan Ignacio Samperio Montano%' OR
				Encabezado like '%Juan Ignacio Samperio%' OR
				Encabezado like '%Juan Ignacio Montano%' OR
				Encabezado like '%Ignacio  Samperio Montano%' OR
				Encabezado like '%Lucila Garfias Gutierrez%' OR
				Encabezado like '%Garfias Gutierrez%' OR
				Encabezado like '%Horacio Duarte Olivares%' OR
				Encabezado like '%Vicente Alberto Onofre Vazquez%' OR
				Encabezado like '%Alberto Onofre Vazquez%' OR
				Encabezado like '%Vicente Onofre Vazquez%' OR
				Encabezado like '%Onofre Vazquez%' OR
				Encabezado like '%Irak Vargas Ramírez%' OR

				PieFoto like '%Victor Hugo Sondon Saavedra%' OR
				PieFoto like '%Victor Hugo Sondon %' OR
				PieFoto like '%Hugo Sondon Saavedra%' OR
				PieFoto like '%Sondon Saavedra%' OR
				PieFoto like '%Ernesto Nemer Alvarez%' OR
				PieFoto like '%Ernesto Nemer%' OR
				PieFoto like '%Nemer Alvarez%' OR
				PieFoto like '%Omar Ortega Alvarez%' OR
				PieFoto like '%Ortega Alvarez%' OR
				PieFoto like '%Oscar Gonzalez Yanez%' OR
				PieFoto like '%Gonzalez Yanez%' OR
				PieFoto like '%Francisco Agundis Aria%' OR
				PieFoto like '%Agundis Aria%' OR
				PieFoto like '%Juan Ignacio Samperio Montano%' OR
				PieFoto like '%Juan Ignacio Samperio%' OR
				PieFoto like '%Juan Ignacio Montano%' OR
				PieFoto like '%Ignacio  Samperio Montano%' OR
				PieFoto like '%Lucila Garfias Gutierrez%' OR
				PieFoto like '%Garfias Gutierrez%' OR
				PieFoto like '%Horacio Duarte Olivares%' OR
				PieFoto like '%Vicente Alberto Onofre Vazquez%' OR
				PieFoto like '%Alberto Onofre Vazquez%' OR
				PieFoto like '%Vicente Onofre Vazquez%' OR
				PieFoto like '%Onofre Vazquez%' OR
				PieFoto like '%Irak Vargas Ramírez%' OR

				Autor like '%Victor Hugo Sondon Saavedra%' OR
				Autor like '%Victor Hugo Sondon %' OR
				Autor like '%Hugo Sondon Saavedra%' OR
				Autor like '%Sondon Saavedra%' OR
				Autor like '%Ernesto Nemer Alvarez%' OR
				Autor like '%Ernesto Nemer%' OR
				Autor like '%Nemer Alvarez%' OR
				Autor like '%Omar Ortega Alvarez%' OR
				Autor like '%Ortega Alvarez%' OR
				Autor like '%Oscar Gonzalez Yanez%' OR
				Autor like '%Gonzalez Yanez%' OR
				Autor like '%Francisco Agundis Aria%' OR
				Autor like '%Agundis Aria%' OR
				Autor like '%Juan Ignacio Samperio Montano%' OR
				Autor like '%Juan Ignacio Samperio%' OR
				Autor like '%Juan Ignacio Montano%' OR
				Autor like '%Ignacio  Samperio Montano%' OR
				Autor like '%Lucila Garfias Gutierrez%' OR
				Autor like '%Garfias Gutierrez%' OR
				Autor like '%Horacio Duarte Olivares%' OR
				Autor like '%Vicente Alberto Onofre Vazquez%' OR
				Autor like '%Alberto Onofre Vazquez%' OR
				Autor like '%Vicente Onofre Vazquez%' OR
				Autor like '%Onofre Vazquez%' OR
				Autor like '%Irak Vargas Ramírez%'

                            )AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 19:// Varios
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Estado de Mexico%' OR
				Texto like '%Penal de Almoloya%' OR
				Texto like '%Encanto del Bicentenario%' OR
				Texto like '%Teotihuacan%' OR
				Texto like '%Zoologico de Zacango%' OR
				Texto like '%Centro ceremonial otomi%' OR
				Texto like '%Señor de Chalma%' OR
				Texto like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				Texto like '% UAEM %' OR
				Texto like '%Tecnologico Nacional de Mexico%' OR
				Texto like '%Universidad Autónoma Chapingo (UACh)%' OR
				Texto like '% UACh %' OR
				Texto like '%Cosmovitral%' OR
				Texto like '%Jardin botanico de Toluca%' OR
				Texto like '%Tren Suburbano del Valle de Mexico%' OR
				Texto like '%Tren Interurbano Mexico-Toluca%' OR
				Texto like '%Viaducto Bicentenario%' OR
				Texto like '%Mexibus%' OR
				Texto like '%Mexicable%' OR

				Titulo like '%Estado de Mexico%' OR
				Titulo like '%Penal de Almoloya%' OR
				Titulo like '%Encanto del Bicentenario%' OR
				Titulo like '%Teotihuacan%' OR
				Titulo like '%Zoologico de Zacango%' OR
				Titulo like '%Centro ceremonial otomi%' OR
				Titulo like '%Señor de Chalma%' OR
				Titulo like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				Titulo like '% UAEM %' OR
				Titulo like '%Tecnologico Nacional de Mexico%' OR
				Titulo like '%Universidad Autónoma Chapingo (UACh)%' OR
				Titulo like '% UACh %' OR
				Titulo like '%Cosmovitral%' OR
				Titulo like '%Jardin botanico de Toluca%' OR
				Titulo like '%Tren Suburbano del Valle de Mexico%' OR
				Titulo like '%Tren Interurbano Mexico-Toluca%' OR
				Titulo like '%Viaducto Bicentenario%' OR
				Titulo like '%Mexibus%' OR
				Titulo like '%Mexicable%' OR

				Encabezado like '%Estado de Mexico%' OR
				Encabezado like '%Penal de Almoloya%' OR
				Encabezado like '%Encanto del Bicentenario%' OR
				Encabezado like '%Teotihuacan%' OR
				Encabezado like '%Zoologico de Zacango%' OR
				Encabezado like '%Centro ceremonial otomi%' OR
				Encabezado like '%Señor de Chalma%' OR
				Encabezado like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				Encabezado like '% UAEM %' OR
				Encabezado like '%Tecnologico Nacional de Mexico%' OR
				Encabezado like '%Universidad Autónoma Chapingo (UACh)%' OR
				Encabezado like '% UACh %' OR
				Encabezado like '%Cosmovitral%' OR
				Encabezado like '%Jardin botanico de Toluca%' OR
				Encabezado like '%Tren Suburbano del Valle de Mexico%' OR
				Encabezado like '%Tren Interurbano Mexico-Toluca%' OR
				Encabezado like '%Viaducto Bicentenario%' OR
				Encabezado like '%Mexibus%' OR
				Encabezado like '%Mexicable%' OR

				PieFoto like '%Estado de Mexico%' OR
				PieFoto like '%Penal de Almoloya%' OR
				PieFoto like '%Encanto del Bicentenario%' OR
				PieFoto like '%Teotihuacan%' OR
				PieFoto like '%Zoologico de Zacango%' OR
				PieFoto like '%Centro ceremonial otomi%' OR
				PieFoto like '%Señor de Chalma%' OR
				PieFoto like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				PieFoto like '% UAEM %' OR
				PieFoto like '%Tecnologico Nacional de Mexico%' OR
				PieFoto like '%Universidad Autónoma Chapingo (UACh)%' OR
				PieFoto like '% UACh %' OR
				PieFoto like '%Cosmovitral%' OR
				PieFoto like '%Jardin botanico de Toluca%' OR
				PieFoto like '%Tren Suburbano del Valle de Mexico%' OR
				PieFoto like '%Tren Interurbano Mexico-Toluca%' OR
				PieFoto like '%Viaducto Bicentenario%' OR
				PieFoto like '%Mexibus%' OR
				PieFoto like '%Mexicable%' OR

				Autor like '%Estado de Mexico%' OR
				Autor like '%Penal de Almoloya%' OR
				Autor like '%Encanto del Bicentenario%' OR
				Autor like '%Teotihuacan%' OR
				Autor like '%Zoologico de Zacango%' OR
				Autor like '%Centro ceremonial otomi%' OR
				Autor like '%Señor de Chalma%' OR
				Autor like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				Autor like '% UAEM %' OR
				Autor like '%Tecnologico Nacional de Mexico%' OR
				Autor like '%Universidad Autónoma Chapingo (UACh)%' OR
				Autor like '% UACh %' OR
				Autor like '%Cosmovitral%' OR
				Autor like '%Jardin botanico de Toluca%' OR
				Autor like '%Tren Suburbano del Valle de Mexico%' OR
				Autor like '%Tren Interurbano Mexico-Toluca%' OR
				Autor like '%Viaducto Bicentenario%' OR
				Autor like '%Mexibus%' OR
				Autor like '%Mexicable%'

                            ) AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            case 20:// Varios estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
				Texto like '%Estado de Mexico%' OR
				Texto like '%Penal de Almoloya%' OR
				Texto like '%Encanto del Bicentenario%' OR
				Texto like '%Teotihuacan%' OR
				Texto like '%Zoologico de Zacango%' OR
				Texto like '%Centro ceremonial otomi%' OR
				Texto like '%Señor de Chalma%' OR
				Texto like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				Texto like '% UAEM %' OR
				Texto like '%Tecnologico Nacional de Mexico%' OR
				Texto like '%Universidad Autónoma Chapingo (UACh)%' OR
				Texto like '% UACh %' OR
				Texto like '%Cosmovitral%' OR
				Texto like '%Jardin botanico de Toluca%' OR
				Texto like '%Tren Suburbano del Valle de Mexico%' OR
				Texto like '%Tren Interurbano Mexico-Toluca%' OR
				Texto like '%Viaducto Bicentenario%' OR
				Texto like '%Mexibus%' OR
				Texto like '%Mexicable%' OR

				Titulo like '%Estado de Mexico%' OR
				Titulo like '%Penal de Almoloya%' OR
				Titulo like '%Encanto del Bicentenario%' OR
				Titulo like '%Teotihuacan%' OR
				Titulo like '%Zoologico de Zacango%' OR
				Titulo like '%Centro ceremonial otomi%' OR
				Titulo like '%Señor de Chalma%' OR
				Titulo like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				Titulo like '% UAEM %' OR
				Titulo like '%Tecnologico Nacional de Mexico%' OR
				Titulo like '%Universidad Autónoma Chapingo (UACh)%' OR
				Titulo like '% UACh %' OR
				Titulo like '%Cosmovitral%' OR
				Titulo like '%Jardin botanico de Toluca%' OR
				Titulo like '%Tren Suburbano del Valle de Mexico%' OR
				Titulo like '%Tren Interurbano Mexico-Toluca%' OR
				Titulo like '%Viaducto Bicentenario%' OR
				Titulo like '%Mexibus%' OR
				Titulo like '%Mexicable%' OR

				Encabezado like '%Estado de Mexico%' OR
				Encabezado like '%Penal de Almoloya%' OR
				Encabezado like '%Encanto del Bicentenario%' OR
				Encabezado like '%Teotihuacan%' OR
				Encabezado like '%Zoologico de Zacango%' OR
				Encabezado like '%Centro ceremonial otomi%' OR
				Encabezado like '%Señor de Chalma%' OR
				Encabezado like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				Encabezado like '% UAEM %' OR
				Encabezado like '%Tecnologico Nacional de Mexico%' OR
				Encabezado like '%Universidad Autónoma Chapingo (UACh)%' OR
				Encabezado like '% UACh %' OR
				Encabezado like '%Cosmovitral%' OR
				Encabezado like '%Jardin botanico de Toluca%' OR
				Encabezado like '%Tren Suburbano del Valle de Mexico%' OR
				Encabezado like '%Tren Interurbano Mexico-Toluca%' OR
				Encabezado like '%Viaducto Bicentenario%' OR
				Encabezado like '%Mexibus%' OR
				Encabezado like '%Mexicable%' OR

				PieFoto like '%Estado de Mexico%' OR
				PieFoto like '%Penal de Almoloya%' OR
				PieFoto like '%Encanto del Bicentenario%' OR
				PieFoto like '%Teotihuacan%' OR
				PieFoto like '%Zoologico de Zacango%' OR
				PieFoto like '%Centro ceremonial otomi%' OR
				PieFoto like '%Señor de Chalma%' OR
				PieFoto like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				PieFoto like '% UAEM %' OR
				PieFoto like '%Tecnologico Nacional de Mexico%' OR
				PieFoto like '%Universidad Autónoma Chapingo (UACh)%' OR
				PieFoto like '% UACh %' OR
				PieFoto like '%Cosmovitral%' OR
				PieFoto like '%Jardin botanico de Toluca%' OR
				PieFoto like '%Tren Suburbano del Valle de Mexico%' OR
				PieFoto like '%Tren Interurbano Mexico-Toluca%' OR
				PieFoto like '%Viaducto Bicentenario%' OR
				PieFoto like '%Mexibus%' OR
				PieFoto like '%Mexicable%' OR

				Autor like '%Estado de Mexico%' OR
				Autor like '%Penal de Almoloya%' OR
				Autor like '%Encanto del Bicentenario%' OR
				Autor like '%Teotihuacan%' OR
				Autor like '%Zoologico de Zacango%' OR
				Autor like '%Centro ceremonial otomi%' OR
				Autor like '%Señor de Chalma%' OR
				Autor like '%Universidad Autónoma del Estado de México (UAEM)%' OR
				Autor like '% UAEM %' OR
				Autor like '%Tecnologico Nacional de Mexico%' OR
				Autor like '%Universidad Autónoma Chapingo (UACh)%' OR
				Autor like '% UACh %' OR
				Autor like '%Cosmovitral%' OR
				Autor like '%Jardin botanico de Toluca%' OR
				Autor like '%Tren Suburbano del Valle de Mexico%' OR
				Autor like '%Tren Interurbano Mexico-Toluca%' OR
				Autor like '%Viaducto Bicentenario%' OR
				Autor like '%Mexibus%' OR
				Autor like '%Mexicable%'

                            ) AND

                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY n.Periodico ";
            return $query;
            break;

            default:
            break;

    }
}
?>
