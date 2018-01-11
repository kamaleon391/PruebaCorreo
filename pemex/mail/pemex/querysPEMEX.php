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

            case 5:// Dir. General Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                          WHERE(
                            Texto like '%Carlos Alberto Trevino Medina%' OR
                            Texto like '%Carlos Alberto Trevino%' OR
                            Texto like '%Alberto Trevino Medina%' OR
                            Texto like '%Carlos Trevino%' OR
                            Texto like '%Director de Pemex%' OR

                            Titulo like '%Carlos Alberto Trevino Medina%' OR
                            Titulo like '%Carlos Alberto Trevino%' OR
                            Titulo like '%Alberto Trevino Medina%' OR
                            Titulo like '%Carlos Trevino%' OR
                            Titulo like '%Director de Pemex%' OR

                            Encabezado like '%Carlos Alberto Trevino Medina%' OR
                            Encabezado like '%Carlos Alberto Trevino%' OR
                            Encabezado like '%Alberto Trevino Medina%' OR
                            Encabezado like '%Carlos Trevino%' OR
                            Encabezado like '%Director de Pemex%' OR

                            PieFoto like '%Carlos Alberto Trevino Medina%' OR
                            PieFoto like '%Carlos Alberto Trevino%' OR
                            PieFoto like '%Alberto Trevino Medina%' OR
                            PieFoto like '%Carlos Trevino%' OR
                            PieFoto like '%Director de Pemex%' OR

                            Autor like '%Carlos Alberto Trevino Medina%' OR
                            Autor like '%Carlos Alberto Trevino%' OR
                            Autor like '%Alberto Trevino Medina%' OR
                            Autor like '%Carlos Trevino%' OR
                                Autor like '%Director de Pemex%'
                            ) AND (
                                    Texto not like '%Ex director%'
                            )AND
                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY p.Estado, n.Periodico";
            return $query;
            break;

            case 6:// PEMEX estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE (
                            Texto like '%Pemex%' OR
                            Texto like '%Petroleos Mexicanos%' OR
                            Texto like '%gasolineros%' OR
                                           
                            Titulo like '%Pemex%' OR
                            Titulo like '%Petroleos Mexicanos%' OR
                            Titulo like '%gasolineros%' OR

                            Encabezado like '%Pemex%' OR
                            Encabezado like '%Petroleos Mexicanos%' OR
                            Encabezado like '%gasolineros%' OR

                            Autor like '%Pemex%' OR
                            Autor like '%Petroleos Mexicanos%' OR
                            Autor like '%gasolineros%' OR

                            PieFoto like '%Pemex%' OR
                            PieFoto like '%Petroleos Mexicanos%' OR
                            PieFoto like '%gasolineros%'    
                            )  AND
                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY p.Estado, n.Periodico";
            return $query;
            break;

            case 7:// Admon. Central - Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s
                        WHERE (
                            Texto like '%rodrigo becerra mizuno%' OR
                            Texto like '%rodrigo becerra%' OR
                            Texto like '%becerra mizuno%' OR
                            Texto like '%Armando David Palacios Hernandez%' OR
                            Texto like '%Armando David Palacios%' OR
                            Texto like '%Armando Palacios Hernandez%' OR
                            Texto like '%Palacios Hernandez%' OR
                            Texto like '%Director Corporativo de Finanzas de pemex%' OR
                            Texto like '%Director Corporativo de Finanzas en pemex%' OR
                            Texto like '%juan Pablo newman aguilar%' OR
                            Texto like '%juan Pablo newman%' OR
                            Texto like '%juan newman aguilar%' OR
                            Texto like '%newman aguilar%' OR
                            Texto like '%Rodulfo Figueroa Alonso%' OR
                            Texto like '%Rodulfo Figueroa%' OR
                            Texto like '%Rodulfo Alonso%' OR
                            Texto like '%Miguel Angel Servin Diago%' OR
                            Texto like '%Miguel Angel Servin%' OR
                            Texto like '%Miguel Angel Diago%' OR
                            Texto like '%Jorge Eduardo Kim Villatoro%' OR
                            Texto like '%Jorge Eduardo Kim%' OR
                            Texto like '%Jorge Eduardo Villatoro%' OR
                            Texto like '%Director Juridico de pemex%' OR
                            Texto like '%Luis Bartolini Esparza%' OR
                            Texto like '%Luis Bartolini%' OR
                            Texto like '%Bartolini Esparza%' OR
                            Texto like '%Auditor interno de pemex%' OR
                            Texto like '%Juan Javier Hinojosa Puebla%' OR
                            Texto like '%Juan Javier Hinojosa%' OR
                            Texto like '%Juan Javier Puebla%' OR
                            Texto like '%Juan Hinojosa Puebla%' OR
                            Texto like '%Javier Hinojosa Puebla%' OR
                            Texto like '%Carlos Murrieta Cummings%' OR
                            Texto like '%Carlos Murrieta%' OR
                            Texto like '%Murrieta Cummings%' OR
                            Texto like '%Eleazar Gomez Zapata%' OR
                            Texto like '%Eleazar Zapata%' OR
                            Texto like '%jose Serrano Lozano%' OR
                            Texto like '%Serrano Lozano%' OR
                            Texto like '%Juan Lozano Tovar%' OR
                            Texto like '%Lozano Tovar%' OR
                            Texto like '%Luis Rafael Montanaro Sanchez%' OR
                            Texto like '%Luis Rafael Montanaro%' OR
                            Texto like '%Luis Rafael Sanchez%' OR
                            Texto like '%Director General de Pemex Etileno%' OR
                            Texto like '%Director General de Pemex Fertilizantes%' OR
                            Texto like '%Jose Ignacio Aguilar Alvarez Greaves%' OR
                            Texto like '%Jose Ignacio Aguilar Alvarez%' OR
                            Texto like '%Jose Aguilar Alvarez Greaves%' OR
                            Texto like '%Jose Ignacio Aguilar Greaves%' OR
                            Texto like '%Ignacio Aguilar Alvarez Greaves%' OR
                            Texto like '%Director general de Pemex Logistica%' OR
                            
                            Titulo like '%rodrigo becerra%' OR
                            Titulo like '%becerra mizuno%' OR
                            Titulo like '%Armando David Palacios Hernandez%' OR
                            Titulo like '%Armando David Palacios%' OR
                            Titulo like '%Armando Palacios Hernandez%' OR
                            Titulo like '%Palacios Hernandez%' OR
                            Titulo like '%Director Corporativo de Finanzas de pemex%' OR
                            Titulo like '%Director Corporativo de Finanzas en pemex%' OR
                            Titulo like '%juan Pablo newman aguilar%' OR
                            Titulo like '%juan Pablo newman%' OR
                            Titulo like '%juan newman aguilar%' OR
                            Titulo like '%newman aguilar%' OR
                            Titulo like '%Rodulfo Figueroa Alonso%' OR
                            Titulo like '%Rodulfo Figueroa%' OR
                            Titulo like '%Rodulfo Alonso%' OR
                            Titulo like '%Miguel Angel Servin Diago%' OR
                            Titulo like '%Miguel Angel Servin%' OR
                            Titulo like '%Miguel Angel Diago%' OR
                            Titulo like '%Jorge Eduardo Kim Villatoro%' OR
                            Titulo like '%Jorge Eduardo Kim%' OR
                            Titulo like '%Jorge Eduardo Villatoro%' OR
                            Titulo like '%Director Juridico de pemex%' OR
                            Titulo like '%Luis Bartolini Esparza%' OR
                            Titulo like '%Luis Bartolini%' OR
                            Titulo like '%Bartolini Esparza%' OR
                            Titulo like '%Auditor interno de pemex%' OR
                            Titulo like '%Juan Javier Hinojosa Puebla%' OR
                            Titulo like '%Juan Javier Hinojosa%' OR
                            Titulo like '%Juan Javier Puebla%' OR
                            Titulo like '%Juan Hinojosa Puebla%' OR
                            Titulo like '%Javier Hinojosa Puebla%' OR
                            Titulo like '%Carlos Murrieta Cummings%' OR
                            Titulo like '%Carlos Murrieta%' OR
                            Titulo like '%Murrieta Cummings%' OR
                            Titulo like '%Eleazar Gomez Zapata%' OR
                            Titulo like '%Eleazar Zapata%' OR
                            Titulo like '%jose Serrano Lozano%' OR
                            Titulo like '%Serrano Lozano%' OR
                            Titulo like '%Juan Lozano Tovar%' OR
                            Titulo like '%Lozano Tovar%' OR
                            Titulo like '%Luis Rafael Montanaro Sanchez%' OR
                            Titulo like '%Luis Rafael Montanaro%' OR
                            Titulo like '%Luis Rafael Sanchez%' OR
                            Titulo like '%Director General de Pemex Etileno%' OR
                            Titulo like '%Director General de Pemex Fertilizantes%' OR
                            Titulo like '%Jose Ignacio Aguilar Alvarez Greaves%' OR
                            Titulo like '%Jose Ignacio Aguilar Alvarez%' OR
                            Titulo like '%Jose Aguilar Alvarez Greaves%' OR
                            Titulo like '%Jose Ignacio Aguilar Greaves%' OR
                            Titulo like '%Ignacio Aguilar Alvarez Greaves%' OR
                            Titulo like '%Director general de Pemex Logistica%' OR
                            
                            Encabezado like '%rodrigo becerra%' OR
                            Encabezado like '%becerra mizuno%' OR
                            Encabezado like '%Armando David Palacios Hernandez%' OR
                            Encabezado like '%Armando David Palacios%' OR
                            Encabezado like '%Armando Palacios Hernandez%' OR
                            Encabezado like '%Palacios Hernandez%' OR
                            Encabezado like '%Director Corporativo de Finanzas de pemex%' OR
                            Encabezado like '%Director Corporativo de Finanzas en pemex%' OR
                            Encabezado like '%juan Pablo newman aguilar%' OR
                            Encabezado like '%juan Pablo newman%' OR
                            Encabezado like '%juan newman aguilar%' OR
                            Encabezado like '%newman aguilar%' OR
                            Encabezado like '%Rodulfo Figueroa Alonso%' OR
                            Encabezado like '%Rodulfo Figueroa%' OR
                            Encabezado like '%Rodulfo Alonso%' OR
                            Encabezado like '%Miguel Angel Servin Diago%' OR
                            Encabezado like '%Miguel Angel Servin%' OR
                            Encabezado like '%Miguel Angel Diago%' OR
                            Encabezado like '%Jorge Eduardo Kim Villatoro%' OR
                            Encabezado like '%Jorge Eduardo Kim%' OR
                            Encabezado like '%Jorge Eduardo Villatoro%' OR
                            Encabezado like '%Director Juridico de pemex%' OR
                            Encabezado like '%Luis Bartolini Esparza%' OR
                            Encabezado like '%Luis Bartolini%' OR
                            Encabezado like '%Bartolini Esparza%' OR
                            Encabezado like '%Auditor interno de pemex%' OR
                            Encabezado like '%Juan Javier Hinojosa Puebla%' OR
                            Encabezado like '%Juan Javier Hinojosa%' OR
                            Encabezado like '%Juan Javier Puebla%' OR
                            Encabezado like '%Juan Hinojosa Puebla%' OR
                            Encabezado like '%Javier Hinojosa Puebla%' OR
                            Encabezado like '%Carlos Murrieta Cummings%' OR
                            Encabezado like '%Carlos Murrieta%' OR
                            Encabezado like '%Murrieta Cummings%' OR
                            Encabezado like '%Eleazar Gomez Zapata%' OR
                            Encabezado like '%Eleazar Zapata%' OR
                            Encabezado like '%jose Serrano Lozano%' OR
                            Encabezado like '%Serrano Lozano%' OR
                            Encabezado like '%Juan Lozano Tovar%' OR
                            Encabezado like '%Lozano Tovar%' OR
                            Encabezado like '%Luis Rafael Montanaro Sanchez%' OR
                            Encabezado like '%Luis Rafael Montanaro%' OR
                            Encabezado like '%Luis Rafael Sanchez%' OR
                            Encabezado like '%Director General de Pemex Etileno%' OR
                            Encabezado like '%Director General de Pemex Fertilizantes%' OR
                            Encabezado like '%Jose Ignacio Aguilar Alvarez Greaves%' OR
                            Encabezado like '%Jose Ignacio Aguilar Alvarez%' OR
                            Encabezado like '%Jose Aguilar Alvarez Greaves%' OR
                            Encabezado like '%Jose Ignacio Aguilar Greaves%' OR
                            Encabezado like '%Ignacio Aguilar Alvarez Greaves%' OR
                            Encabezado like '%Director general de Pemex Logistica%' OR
                            
                            PieFoto like '%rodrigo becerra%' OR
                            PieFoto like '%becerra mizuno%' OR
                            PieFoto like '%Armando David Palacios Hernandez%' OR
                            PieFoto like '%Armando David Palacios%' OR
                            PieFoto like '%Armando Palacios Hernandez%' OR
                            PieFoto like '%Palacios Hernandez%' OR
                            PieFoto like '%Director Corporativo de Finanzas de pemex%' OR
                            PieFoto like '%Director Corporativo de Finanzas en pemex%' OR
                            PieFoto like '%juan Pablo newman aguilar%' OR
                            PieFoto like '%juan Pablo newman%' OR
                            PieFoto like '%juan newman aguilar%' OR
                            PieFoto like '%newman aguilar%' OR
                            PieFoto like '%Rodulfo Figueroa Alonso%' OR
                            PieFoto like '%Rodulfo Figueroa%' OR
                            PieFoto like '%Rodulfo Alonso%' OR
                            PieFoto like '%Miguel Angel Servin Diago%' OR
                            PieFoto like '%Miguel Angel Servin%' OR
                            PieFoto like '%Miguel Angel Diago%' OR
                            PieFoto like '%Jorge Eduardo Kim Villatoro%' OR
                            PieFoto like '%Jorge Eduardo Kim%' OR
                            PieFoto like '%Jorge Eduardo Villatoro%' OR
                            PieFoto like '%Director Juridico de pemex%' OR
                            PieFoto like '%Luis Bartolini Esparza%' OR
                            PieFoto like '%Luis Bartolini%' OR
                            PieFoto like '%Bartolini Esparza%' OR
                            PieFoto like '%Auditor interno de pemex%' OR
                            PieFoto like '%Juan Javier Hinojosa Puebla%' OR
                            PieFoto like '%Juan Javier Hinojosa%' OR
                            PieFoto like '%Juan Javier Puebla%' OR
                            PieFoto like '%Juan Hinojosa Puebla%' OR
                            PieFoto like '%Javier Hinojosa Puebla%' OR
                            PieFoto like '%Carlos Murrieta Cummings%' OR
                            PieFoto like '%Carlos Murrieta%' OR
                            PieFoto like '%Murrieta Cummings%' OR
                            PieFoto like '%Eleazar Gomez Zapata%' OR
                            PieFoto like '%Eleazar Zapata%' OR
                            PieFoto like '%jose Serrano Lozano%' OR
                            PieFoto like '%Serrano Lozano%' OR
                            PieFoto like '%Juan Lozano Tovar%' OR
                            PieFoto like '%Lozano Tovar%' OR
                            PieFoto like '%Luis Rafael Montanaro Sanchez%' OR
                            PieFoto like '%Luis Rafael Montanaro%' OR
                            PieFoto like '%Luis Rafael Sanchez%' OR
                            PieFoto like '%Director General de Pemex Etileno%' OR
                            PieFoto like '%Director General de Pemex Fertilizantes%' OR
                            PieFoto like '%Jose Ignacio Aguilar Alvarez Greaves%' OR
                            PieFoto like '%Jose Ignacio Aguilar Alvarez%' OR
                            PieFoto like '%Jose Aguilar Alvarez Greaves%' OR
                            PieFoto like '%Jose Ignacio Aguilar Greaves%' OR
                            PieFoto like '%Ignacio Aguilar Alvarez Greaves%' OR
                            PieFoto like '%Director general de Pemex Logistica%' OR
                            
                            Autor like '%rodrigo becerra%' OR
                            Autor like '%becerra mizuno%' OR
                            Autor like '%Armando David Palacios Hernandez%' OR
                            Autor like '%Armando David Palacios%' OR
                            Autor like '%Armando Palacios Hernandez%' OR
                            Autor like '%Palacios Hernandez%' OR
                            Autor like '%Director Corporativo de Finanzas de pemex%' OR
                            Autor like '%Director Corporativo de Finanzas en pemex%' OR
                            Autor like '%juan Pablo newman aguilar%' OR
                            Autor like '%juan Pablo newman%' OR
                            Autor like '%juan newman aguilar%' OR
                            Autor like '%newman aguilar%' OR
                            Autor like '%Rodulfo Figueroa Alonso%' OR
                            Autor like '%Rodulfo Figueroa%' OR
                            Autor like '%Rodulfo Alonso%' OR
                            Autor like '%Miguel Angel Servin Diago%' OR
                            Autor like '%Miguel Angel Servin%' OR
                            Autor like '%Miguel Angel Diago%' OR
                            Autor like '%Jorge Eduardo Kim Villatoro%' OR
                            Autor like '%Jorge Eduardo Kim%' OR
                            Autor like '%Jorge Eduardo Villatoro%' OR
                            Autor like '%Director Juridico de pemex%' OR
                            Autor like '%Luis Bartolini Esparza%' OR
                            Autor like '%Luis Bartolini%' OR
                            Autor like '%Bartolini Esparza%' OR
                            Autor like '%Auditor interno de pemex%' OR
                            Autor like '%Juan Javier Hinojosa Puebla%' OR
                            Autor like '%Juan Javier Hinojosa%' OR
                            Autor like '%Juan Javier Puebla%' OR
                            Autor like '%Juan Hinojosa Puebla%' OR
                            Autor like '%Javier Hinojosa Puebla%' OR
                            Autor like '%Carlos Murrieta Cummings%' OR
                            Autor like '%Carlos Murrieta%' OR
                            Autor like '%Murrieta Cummings%' OR
                            Autor like '%Eleazar Gomez Zapata%' OR
                            Autor like '%Eleazar Zapata%' OR
                            Autor like '%jose Serrano Lozano%' OR
                            Autor like '%Serrano Lozano%' OR
                            Autor like '%Juan Lozano Tovar%' OR
                            Autor like '%Lozano Tovar%' OR
                            Autor like '%Luis Rafael Montanaro Sanchez%' OR
                            Autor like '%Luis Rafael Montanaro%' OR
                            Autor like '%Luis Rafael Sanchez%' OR
                            Autor like '%Director General de Pemex Etileno%' OR
                            Autor like '%Director General de Pemex Fertilizantes%' OR
                            Autor like '%Jose Ignacio Aguilar Alvarez Greaves%' OR
                            Autor like '%Jose Ignacio Aguilar Alvarez%' OR
                            Autor like '%Jose Aguilar Alvarez Greaves%' OR
                            Autor like '%Jose Ignacio Aguilar Greaves%' OR
                            Autor like '%Ignacio Aguilar Alvarez Greaves%' OR
                            Autor like '%Director general de Pemex Logistica%' 
                    )AND

                            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80 
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY p.Estado, n.Periodico";
            return $query;
            break;

            case 8:// Reforma Energética Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                        Texto like '%Reforma Energetica%' OR
                        
                        Titulo like '%Reforma Energetica%' OR

                        Autor like '%Reforma Energetica%' OR

                        PieFoto like '%Reforma Energetica%' OR

                        Autor like '%Reforma Energetica%'
                        )AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria != 80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;

            case 9:// Instalaciones Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Refineria Ing. Hector R. Lara Sosa%' OR
                            Texto like '%Refineria Francisco I. Madero%' OR
                            Texto like '%Refineria Ing. Antonio M. Amor%' OR
                            Texto like '%Refineria Miguel Hidalgo%' OR
                            Texto like '%Refineria Gral. Lazaro Cardenas%' OR
                            Texto like '%Refineria Ing. Antonio Dovali Jaime%' OR
                            Texto like '%Complejo Petroquimico Independencia%' OR
                            Texto like '%Complejo Petroquimico Pajaritos%' OR
                            Texto like '%Complejo Petroquimico Morelos%' OR
                            Texto like '%Complejo Petroquimico Cangrejera%' OR
                            Texto like '%Complejo Petroquimico Cosoleacaque%' OR
                            
                            Titulo like '%Refineria Ing. Hector R. Lara Sosa%' OR
                            Titulo like '%Refineria Francisco I. Madero%' OR
                            Titulo like '%Refineria Ing. Antonio M. Amor%' OR
                            Titulo like '%Refineria Miguel Hidalgo%' OR
                            Titulo like '%Refineria Gral. Lazaro Cardenas%' OR
                            Titulo like '%Refineria Ing. Antonio Dovali Jaime%' OR
                            Titulo like '%Complejo Petroquimico Independencia%' OR
                            Titulo like '%Complejo Petroquimico Pajaritos%' OR
                            Titulo like '%Complejo Petroquimico Morelos%' OR
                            Titulo like '%Complejo Petroquimico Cangrejera%' OR
                            Titulo like '%Complejo Petroquimico Cosoleacaque%' OR
                            
                            Encabezado like '%Refineria Ing. Hector R. Lara Sosa%' OR
                            Encabezado like '%Refineria Francisco I. Madero%' OR
                            Encabezado like '%Refineria Ing. Antonio M. Amor%' OR
                            Encabezado like '%Refineria Miguel Hidalgo%' OR
                            Encabezado like '%Refineria Gral. Lazaro Cardenas%' OR
                            Encabezado like '%Refineria Ing. Antonio Dovali Jaime%' OR
                            Encabezado like '%Complejo Petroquimico Independencia%' OR
                            Encabezado like '%Complejo Petroquimico Pajaritos%' OR
                            Encabezado like '%Complejo Petroquimico Morelos%' OR
                            Encabezado like '%Complejo Petroquimico Cangrejera%' OR
                            Encabezado like '%Complejo Petroquimico Cosoleacaque%' OR
                            
                            PieFoto like '%Refineria Ing. Hector R. Lara Sosa%' OR
                            PieFoto like '%Refineria Francisco I. Madero%' OR
                            PieFoto like '%Refineria Ing. Antonio M. Amor%' OR
                            PieFoto like '%Refineria Miguel Hidalgo%' OR
                            PieFoto like '%Refineria Gral. Lazaro Cardenas%' OR
                            PieFoto like '%Refineria Ing. Antonio Dovali Jaime%' OR
                            PieFoto like '%Complejo Petroquimico Independencia%' OR
                            PieFoto like '%Complejo Petroquimico Pajaritos%' OR
                            PieFoto like '%Complejo Petroquimico Morelos%' OR
                            PieFoto like '%Complejo Petroquimico Cangrejera%' OR
                            PieFoto like '%Complejo Petroquimico Cosoleacaque%' OR
                            
                            Autor like '%Refineria Ing. Hector R. Lara Sosa%' OR
                            Autor like '%Refineria Francisco I. Madero%' OR
                            Autor like '%Refineria Ing. Antonio M. Amor%' OR
                            Autor like '%Refineria Miguel Hidalgo%' OR
                            Autor like '%Refineria Gral. Lazaro Cardenas%' OR
                            Autor like '%Refineria Ing. Antonio Dovali Jaime%' OR
                            Autor like '%Complejo Petroquimico Independencia%' OR
                            Autor like '%Complejo Petroquimico Pajaritos%' OR
                            Autor like '%Complejo Petroquimico Morelos%' OR
                            Autor like '%Complejo Petroquimico Cangrejera%' OR
                            Autor like '%Complejo Petroquimico Cosoleacaque%' 
                                    
                                )AND
                            n.Periodico=p.idPeriodico AND
                            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                            AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                            GROUP BY n.Periodico, n.NumeroPagina
                            ORDER BY p.Estado, n.Periodico";
            return $query;
            break;

            case 10:// Petróleo Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Petroleo%' OR
                            
                            Titulo like '%Petroleo%' OR

                            Autor like '%Petroleo%' OR

                            PieFoto like '%Petroleo%' OR

                            Autor like '%Petroleo%' 
                        )AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND n.Activo=1 AND n.Categoria!=80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;

            case 11:// GAS estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '% Gas natural%' OR
                            Texto like '% Gas metano%' OR
                            Texto like '% Gas etano%' OR
                            Texto like '% Gas butano%' OR
                            Texto like '% Gas propano%' OR
                            Texto like '% Gas etileno%' OR
                            Texto like '% Gas propileno%' OR
                            Texto like '% Gas licuado%' OR
                            
                            Titulo like '% Gas natural%' OR
                            Titulo like '% Gas metano%' OR
                            Titulo like '% Gas etano%' OR
                            Titulo like '% Gas butano%' OR
                            Titulo like '% Gas propano%' OR
                            Titulo like '% Gas etileno%' OR
                            Titulo like '% Gas propileno%' OR
                            Titulo like '% Gas licuado%' OR

                            Encabezado like '% Gas natural%' OR
                            Encabezado like '% Gas metano%' OR
                            Encabezado like '% Gas etano%' OR
                            Encabezado like '% Gas butano%' OR
                            Encabezado like '% Gas propano%' OR
                            Encabezado like '% Gas etileno%' OR
                            Encabezado like '% Gas propileno%' OR
                            Encabezado like '% Gas licuado%' OR

                            PieFoto like '% Gas natural%' OR
                            PieFoto like '% Gas metano%' OR
                            PieFoto like '% Gas etano%' OR
                            PieFoto like '% Gas butano%' OR
                            PieFoto like '% Gas propano%' OR
                            PieFoto like '% Gas etileno%' OR
                            PieFoto like '% Gas propileno%' OR
                            PieFoto like '% Gas licuado%'
                        )AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;
            
            case 12:// Petróquimica Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Petroquimica%' OR
                            Texto like '%Petroquimico%' OR
                            Texto like '%queroseno%' OR
                            Texto like '%gasoil%' OR
                            
                            Titulo like '%Petroquimica%' OR
                            Titulo like '%Petroquimico%' OR
                            Titulo like '%queroseno%' OR
                            Titulo like '%gasoil%' OR

                            Encabezado like '%Petroquimica%' OR
                            Encabezado like '%Petroquimico%' OR
                            Encabezado like '%queroseno%' OR
                            Encabezado like '%gasoil%' OR

                            PieFoto like '%Petroquimica%' OR
                            PieFoto like '%Petroquimico%' OR
                            PieFoto like '%queroseno%' OR
                            PieFoto like '%gasoil%' OR

                            Autor like '%Petroquimica%' OR
                            Autor like '%Petroquimico%' OR
                            Autor like '%queroseno%' OR
                            Autor like '%gasoil%'
                        )AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;
            
            case 13:// Gasolina Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Gasolina%' OR
                            
                            Titulo like '%Gasolina%' OR

                            Autor like '%Gasolina%' OR

                            PieFoto like '%Gasolina%' OR

                            Autor like '%Gasolina%' 
                        )AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;
            
            case 14:// Ref. Laboral Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE(
                            Texto like '%Reforma Laboral%' OR
                            
                            Titulo like '%Reforma Laboral%' OR

                            Autor like '%Reforma Laboral%' OR

                            PieFoto like '%Reforma Laboral%' OR

                            Autor like '%Reforma Laboral%' 
                        )AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;
            
            case 15:// Sindicato Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE (
                        Texto like '%sindicato de trabajadores petroleros de la república mexicana%' OR
                        Texto like '%Sindicato PEMEX%' OR
                        Texto like '% STPRM %' OR
                        
                        Titulo like '%sindicato de trabajadores petroleros de la república mexicana%' OR
                        Titulo like '%Sindicato PEMEX%' OR
                        Titulo like '% STPRM %' OR
                        
                        Encabezado like '%sindicato de trabajadores petroleros de la república mexicana%' OR
                        Encabezado like '%Sindicato PEMEX%' OR
                        Encabezado like '% STPRM %' OR
                        
                        PieFoto like '%sindicato de trabajadores petroleros de la república mexicana%' OR
                        PieFoto like '%Sindicato PEMEX%' OR
                        PieFoto like '% STPRM %' OR

                        Autor like '%sindicato de trabajadores petroleros de la república mexicana%' OR
                        Autor like '%Sindicato PEMEX%' OR
                        Autor like '% STPRM %'
                        )AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;
            
            case 16:// Refinación Estados
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE (
                            Texto like '%Refinacion%' OR
                            Texto like '%Refineria%' OR
                            
                            Titulo like '%Refinacion%' OR
                            Titulo like '%Refineria%' OR

                            Autor like '%Refinacion%' OR
                            Autor like '%Refineria%' OR

                            PieFoto like '%Refinacion%' OR
                            PieFoto like '%Refineria%' OR

                            Autor like '%Refinacion%' OR
                            Autor like '%Refineria%' 

                        ) AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;
            
            case 17:// Seguridad Industrial
                $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s
                        WHERE (
                            Texto like '%Seguridad Industrial%' OR

                            Titulo like '%Seguridad Industrial%' OR

                            Encabezado like '%Seguridad Industrial%' OR

                            PieFoto like '%Seguridad Industrial%' OR

                            Autor like '%Seguridad Industrial%' 
                        ) AND
                        n.Periodico=p.idPeriodico AND
                        s.idSeccion = n.Seccion AND n.Fecha='".$fecha."'
                        AND p.Estado!=9 AND p.tipo=1 AND  n.Activo=1 AND n.Categoria!=80
                        GROUP BY n.Periodico, n.NumeroPagina
                        ORDER BY p.Estado, n.Periodico";
            return $query;
            break;
            
            default:
            break;

    }
}
?>
