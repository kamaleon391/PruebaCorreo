<?php
require_once '/var/www/external/services/mail/conexion.php';

function numberNotes($optionCase, $fecha)
{
    $query = query($optionCase, $fecha);
    $resultado = mysql_query($query);
var_dump( $resultado ) ;
    if( $resultado && mysql_num_rows($resultado) > 0)
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
            $Tabla="noticiasDia";
        }
        else
        {
            $Tabla="noticiasSemana";
        }
    switch ($op) {
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
                    p.estado=e.idEstado
                    GROUP BY n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion";
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
                    fecha =DATE('$fecha')
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
                    p.estado=e.idEstado
                    GROUP BY n.idEditorial, n.Periodico,n.NumeroPagina";
            return $query;
            break;//Columnas Financieras
        case 4://CARTONES
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
                    fecha =DATE('$fecha')
                    GROUP BY n.idEditorial, n.Periodico,n.NumeroPagina
                    ORDER BY o.posicion";
            return $query;  
            break;//CARTONES
        case 5:// EGIDIO TORRE CANTU
              $query="(SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE p.idPeriodico=n.Periodico AND
                        p.idPeriodico=o.periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                        p.estado=e.idEstado AND
                        p.estado=9 AND
                        fecha =DATE('$fecha') AND
                        (
                        Texto like '%egidio torre cantu%' OR
                        Texto like '%egidio torre%' OR 
                        Texto like '%egidio cantu%' OR
                        Texto like'Gobernador de Tamaulipas' OR
                        Texto like'%Gobernador Constitucional del Estado de Tamaulipas%' 
                        )
                        ORDER BY o.posicion
                        )
                        UNION (
                        SELECT n.idEditorial,n.Periodico,p.Nombre,n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE 
                        p.idPeriodico=n.Periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                        fecha =DATE('$fecha') AND
                        p.estado=e.idEstado AND    
                        p.idPeriodico=34 AND (
                        Texto like '%egidio torre cantu%' OR
                        Texto like '%egidio torre%' OR 
                        Texto like '%egidio cantu%' OR
                        Texto like'Gobernador de Tamaulipas' OR
                        Texto like'%Gobernador Constitucional del Estado de Tamaulipas%' 
                        ) GROUP BY  n.Periodico,n.NumeroPagina
                        )
                        ";
            return $query;  
            break;//Egidio Torre Cantu
        case 6://Administracion Estatal
              $query="(SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM noticiasDia n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE p.idPeriodico=n.Periodico AND
                        p.idPeriodico=o.periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                         p.estado=e.idEstado AND
                        fecha =DATE('$fecha') AND
                        ( 
                        Texto like'%Herminio Garza Palacios%' OR
                        Texto like'%Rafael Lomelí Martinez%' OR
                        Texto like'%Ismael Quintanilla Acosta%' OR
                        Texto like'%Homero de la Garza%' OR
                        Texto like'%Diodoro Guerra Rodriguez%' OR
                        Texto like'%Norberto Trevino Garcia%' OR
                        Texto like'%Alfredo Gonzalez Fernandez%' OR
                        Texto like'%Jorge Silvestre Abrego%' OR
                        Texto like'%Monica Gonzalez Garcoa%' OR
                        Texto like'%Manuel Rodriguez Morales%' OR
                        Texto like'%Humberto Rene Salinas%' OR
                        Texto like'%Jorge Alberto Reyes Moreno%' OR
                        Texto like'%Gilda Cavazos Lliteras%' OR
                        Texto like'%Morelos Jaime Canseco%' OR
                        Texto like'%Enrique de la Garza Ferrer%' OR
                        Texto like'%Libertad Garcia Cabriales%' OR
                        Texto like'%Jesus Alejandro Ostos%' OR
                        Texto like'%Guillermo Martínez García%' OR
                        Texto like'%Rolando Martin Guevara%' OR
                        Texto like'%Linda Lucia Gonzalez%' OR
                        Texto like'%Jesus Serna Barella%' OR
                        Texto like'%Víctor Rodolfo Vazquez%' OR
                        Texto like'%Jose Blas Gil Contreras%'	
                        )
                        ORDER BY o.posicion
                        )
                        UNION (
                        SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM noticiasDia n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE 
                        p.idPeriodico=n.Periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                        p.estado=e.idEstado AND
                        fecha =DATE('$fecha') AND
                        p.idPeriodico=34 AND ( 
                        Texto like'%Herminio Garza Palacios%' OR
                        Texto like'%Rafael Lomelí Martinez%' OR
                        Texto like'%Ismael Quintanilla Acosta%' OR
                        Texto like'%Homero de la Garza%' OR
                        Texto like'%Diodoro Guerra Rodriguez%' OR
                        Texto like'%Norberto Trevino Garcia%' OR
                        Texto like'%Alfredo Gonzalez Fernandez%' OR
                        Texto like'%Jorge Silvestre Abrego%' OR
                        Texto like'%Monica Gonzalez Garcoa%' OR
                        Texto like'%Manuel Rodriguez Morales%' OR
                        Texto like'%Humberto Rene Salinas%' OR
                        Texto like'%Jorge Alberto Reyes Moreno%' OR
                        Texto like'%Gilda Cavazos Lliteras%' OR
                        Texto like'%Morelos Jaime Canseco%' OR
                        Texto like'%Enrique de la Garza Ferrer%' OR
                        Texto like'%Libertad Garcia Cabriales%' OR
                        Texto like'%Jesus Alejandro Ostos%' OR
                        Texto like'%Guillermo Martínez García%' OR
                        Texto like'%Rolando Martin Guevara%' OR
                        Texto like'%Linda Lucia Gonzalez%' OR
                        Texto like'%Jesus Serna Barella%' OR
                        Texto like'%Víctor Rodolfo Vazquez%' OR
                        Texto like'%Jose Blas Gil Contreras%'	
                        ) GROUP BY  n.Periodico,n.NumeroPagina
                        )
";
            return $query;  
            break;//Administracion Estatal  
        case 7:// TAMAULIPAS
              $query="SELECT *  FROM ( SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion AS nom_seccion ,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND
                    (
                    Titulo like '%tamaulipas%' OR
                    Titulo like '%tamaulipeco%' OR
                    Titulo like '%tamaulipeca%' OR
                    Titulo like '%reynosa%' OR
                    Titulo like '%Tampico%' OR
                    encabezado like '%tamaulipas%' OR
                    encabezado like '%tamaulipeco%' OR
                    encabezado like '%tamaulipeca%' OR
                    encabezado like '%reynosa%' OR
                    encabezado like '%Tampico%' OR
                    Texto like '%tamaulipas%' OR
                    texto like '%reynosa%' OR
                    Texto like '%tamaulipeco%' OR
                    Texto like '%tamaulipeca%' OR
                    Texto like '%Tampico%'
                    )AND (Texto not like '%mercado%')
UNION 
                    SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf', e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    fecha =DATE('$fecha') AND
                    p.estado=e.idEstado AND
                    p.idPeriodico=34 AND (
                    Titulo like '%tamaulipas%' OR
                    Titulo like '%tamaulipeco%' OR
                    Titulo like '%tamaulipeca%' OR
                    Titulo like '%reynosa%' OR
                    Titulo like '%Tampico%' OR
                    encabezado like '%tamaulipas%' OR
                    encabezado like '%tamaulipeco%' OR
                    encabezado like '%tamaulipeca%' OR
                    encabezado like '%reynosa%' OR
                    encabezado like '%Tampico%' OR
                    Texto like '%tamaulipas%' OR
                    texto like '%reynosa%' OR
                    Texto like '%tamaulipeco%' OR
                    Texto like '%tamaulipeca%' OR
                    Texto like '%Tampico%'
                    )AND (Texto not like '%mercado%') 
 ) TEMPORAL  GROUP BY  Periodico, NumeroPagina LIMIT 0,50";

            return $query;  
            break;//Tamaulipas
        case 8:// TAMAULIPAS
              $query="SELECT *  FROM ( SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion AS nom_seccion ,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND
                    (
                    Titulo like '%tamaulipas%' OR
                    Titulo like '%tamaulipeco%' OR
                    Titulo like '%tamaulipeca%' OR
                    Titulo like '%reynosa%' OR
                    Titulo like '%Tampico%' OR
                    encabezado like '%tamaulipas%' OR
                    encabezado like '%tamaulipeco%' OR
                    encabezado like '%tamaulipeca%' OR
                    encabezado like '%reynosa%' OR
                    encabezado like '%Tampico%' OR
                    Texto like '%tamaulipas%' OR
                    texto like '%reynosa%' OR
                    Texto like '%tamaulipeco%' OR
                    Texto like '%tamaulipeca%' OR
                    Texto like '%Tampico%'
                    )AND (Texto not like '%mercado%')
UNION 
                    SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf', e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE 
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    fecha =DATE('$fecha') AND
                    p.estado=e.idEstado AND
                    p.idPeriodico=34 AND (
                    Titulo like '%tamaulipas%' OR
                    Titulo like '%tamaulipeco%' OR
                    Titulo like '%tamaulipeca%' OR
                    Titulo like '%reynosa%' OR
                    Titulo like '%Tampico%' OR
                    encabezado like '%tamaulipas%' OR
                    encabezado like '%tamaulipeco%' OR
                    encabezado like '%tamaulipeca%' OR
                    encabezado like '%reynosa%' OR
                    encabezado like '%Tampico%' OR
                    Texto like '%tamaulipas%' OR
                    texto like '%reynosa%' OR
                    Texto like '%tamaulipeco%' OR
                    Texto like '%tamaulipeca%' OR
                    Texto like '%Tampico%'
                    )AND (Texto not like '%mercado%') 
                 ) TEMPORAL  GROUP BY  Periodico, NumeroPagina LIMIT 50,50";
            return $query;  
            break;
        case 9: // Baltazar Hinojosa Ochoa - PRI
            $query = "SELECT n.idEditorial,n.Periodico,p.Nombre,n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE 
                        p.idPeriodico=n.Periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                        fecha =DATE('$fecha') AND
                        p.estado=e.idEstado AND n.Categoria != 80 AND p.id_region != 6 AND e.idEstado = 9 AND 
        (
        Texto      like '%Hinojosa Ochoa%' OR
        Titulo     like '%Hinojosa Ochoa%' OR
        Encabezado like '%Hinojosa Ochoa%' OR
        Autor      like '%Hinojosa Ochoa%' OR

        Texto      like '%Baltazar Hinojosa Ochoa%' OR
        Titulo     like '%Baltazar Hinojosa Ochoa%' OR
        Encabezado like '%Baltazar Hinojosa Ochoa%' OR
        Autor      like '%Baltazar Hinojosa Ochoa%'  )";
            return $query;
            break;
        case 10: // Francisco Javier Garcia Cabeza de Vaca - PAN 
            $query = "SELECT n.idEditorial,n.Periodico,p.Nombre,n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE 
                        p.idPeriodico=n.Periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                        fecha =DATE('$fecha') AND
                        p.estado=e.idEstado AND n.Categoria != 80 AND p.id_region != 6 AND e.idEstado = 9 AND 
    (   Texto      like '%Francisco Javier Cabeza de Vaca%' OR
        Titulo     like '%Francisco Javier Cabeza de Vaca%' OR
        Encabezado like '%Francisco Javier Cabeza de Vaca%' OR
        Autor      like '%Francisco Javier Cabeza de Vaca%' OR

        Texto      like '%Garcia Cabeza de Vaca%' OR
        Titulo     like '%Garcia Cabeza de Vaca%' OR
        Encabezado like '%Garcia Cabeza de Vaca%' OR
        Autor      like '%Garcia Cabeza de Vaca%' OR

        Texto      like '%Francisco Javier Garcia Cabeza de Vaca%' OR
        Titulo     like '%Francisco Javier Garcia Cabeza de Vaca%' OR
        Encabezado like '%Francisco Javier Garcia Cabeza de Vaca%' OR
        Autor      like '%Francisco Javier Garcia Cabeza de Vaca%'  ) ";
            return $query;
            break;
        case 11:// EGIDIO TORRE CANTU ESTADOS
            $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico', p.Nombre as 'periodico',n.Seccion, s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE p.idPeriodico=n.Periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                        p.estado=e.idEstado AND
                        p.estado!=9 AND
                        fecha =DATE('$fecha') AND
                        (
                        Texto like '%egidio torre cantu%' OR
                        Texto like '%egidio torre%' OR 
                        Texto like '%egidio cantu%' OR
                        Texto like'Gobernador de Tamaulipas' OR
                        Texto like'%Gobernador Constitucional del Estado de Tamaulipas%' 
                        ) GROUP BY 2, n.NumeroPagina ";
            return $query;
            break;//Egidio Torre Cantu

        case 12://Administracion Estatal ESTADOS
            $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM noticiasDia n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE p.idPeriodico=n.Periodico AND p.estado!=9 AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                         p.estado=e.idEstado AND
                        fecha =DATE('$fecha') AND
                        ( 
                        Texto like'%Herminio Garza Palacios%' OR
                        Texto like'%Rafael Lomelí Martinez%' OR
                        Texto like'%Ismael Quintanilla Acosta%' OR
                        Texto like'%Homero de la Garza%' OR
                        Texto like'%Diodoro Guerra Rodriguez%' OR
                        Texto like'%Norberto Trevino Garcia%' OR
                        Texto like'%Alfredo Gonzalez Fernandez%' OR
                        Texto like'%Jorge Silvestre Abrego%' OR
                        Texto like'%Monica Gonzalez Garcoa%' OR
                        Texto like'%Manuel Rodriguez Morales%' OR
                        Texto like'%Humberto Rene Salinas%' OR
                        Texto like'%Jorge Alberto Reyes Moreno%' OR
                        Texto like'%Gilda Cavazos Lliteras%' OR
                        Texto like'%Morelos Jaime Canseco%' OR
                        Texto like'%Enrique de la Garza Ferrer%' OR
                        Texto like'%Libertad Garcia Cabriales%' OR
                        Texto like'%Jesus Alejandro Ostos%' OR
                        Texto like'%Guillermo Martínez García%' OR
                        Texto like'%Rolando Martin Guevara%' OR
                        Texto like'%Linda Lucia Gonzalez%' OR
                        Texto like'%Jesus Serna Barella%' OR
                        Texto like'%Víctor Rodolfo Vazquez%' OR
                        Texto like'%Jose Blas Gil Contreras%'	
                        ) GROUP BY 2, n.NumeroPagina ";
            return $query;
            break;//Administracion Estatal
        case 13:// TAMAULIPAS EDOS
            $query="SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion AS nom_seccion ,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p,  seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND n.Categoria != 80 AND
                    p.estado=e.idEstado AND p.estado!=9 AND
                    fecha =DATE('$fecha') AND (
                    Titulo like '%tamaulipas%' OR
                    Titulo like '%tamaulipeco%' OR
                    Titulo like '%tamaulipeca%' OR
                    Titulo like '%reynosa%' OR
                    Titulo like '%Tampico%' OR
                    encabezado like '%tamaulipas%' OR
                    encabezado like '%tamaulipeco%' OR
                    encabezado like '%tamaulipeca%' OR
                    encabezado like '%reynosa%' OR
                    encabezado like '%Tampico%' OR
                    Texto like '%tamaulipas%' OR
                    texto like '%reynosa%' OR
                    Texto like '%tamaulipeco%' OR
                    Texto like '%tamaulipeca%' OR
                    Texto like '%Tampico%'
                    )AND (Texto not like '%mercado%') GROUP BY  Periodico, NumeroPagina LIMIT 0,50";

            return $query;
            break;//Tamaulipas
        case 14:// TAMAULIPAS ESTADOS
            $query=" SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion AS nom_seccion ,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND n.Categoria != 80 AND 
                    p.estado=e.idEstado AND p.estado!=9 AND
                    fecha =DATE('$fecha') AND
                    (
                    Titulo like '%tamaulipas%' OR
                    Titulo like '%tamaulipeco%' OR
                    Titulo like '%tamaulipeca%' OR
                    Titulo like '%reynosa%' OR
                    Titulo like '%Tampico%' OR
                    encabezado like '%tamaulipas%' OR
                    encabezado like '%tamaulipeco%' OR
                    encabezado like '%tamaulipeca%' OR
                    encabezado like '%reynosa%' OR
                    encabezado like '%Tampico%' OR
                    Texto like '%tamaulipas%' OR
                    texto like '%reynosa%' OR
                    Texto like '%tamaulipeco%' OR
                    Texto like '%tamaulipeca%' OR
                    Texto like '%Tampico%'
                    )AND (Texto not like '%mercado%') GROUP BY  Periodico, NumeroPagina LIMIT 50,50 ";
            return $query;
            break;
        case 15: // Baltazar Hinojosa Ochoa - PRI ESTADOS
            $query = "SELECT n.idEditorial,n.Periodico,p.Nombre,n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE 
                        p.idPeriodico=n.Periodico AND
                        s.idSeccion=n.Seccion AND 
                        c.idCategoria=n.Categoria AND
                        fecha =DATE('$fecha') AND
                        p.estado=e.idEstado AND n.Categoria != 80 AND p.estado!=9 AND         (
        Texto      like '%Hinojosa Ochoa%' OR
        Titulo     like '%Hinojosa Ochoa%' OR
        Encabezado like '%Hinojosa Ochoa%' OR
        Autor      like '%Hinojosa Ochoa%' OR

        Texto      like '%Baltazar Hinojosa Ochoa%' OR
        Titulo     like '%Baltazar Hinojosa Ochoa%' OR
        Encabezado like '%Baltazar Hinojosa Ochoa%' OR
        Autor      like '%Baltazar Hinojosa Ochoa%'  )";
            return $query;
            break;
        case 16: // Francisco Javier Garcia Cabeza de Vaca - PAN ESTADOS
            $query = "SELECT n.idEditorial,n.Periodico,p.Nombre,n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        e.Nombre as 'Estado'
                        FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                        WHERE 
                        p.idPeriodico=n.Periodico AND
                        s.idSeccion=n.Seccion AND
                        c.idCategoria=n.Categoria AND
                        fecha =DATE('$fecha') AND
                        p.estado=e.idEstado AND n.Categoria != 80 AND p.estado!=9 AND
    (   Texto      like '%Francisco Javier Cabeza de Vaca%' OR
        Titulo     like '%Francisco Javier Cabeza de Vaca%' OR
        Encabezado like '%Francisco Javier Cabeza de Vaca%' OR
        Autor      like '%Francisco Javier Cabeza de Vaca%' OR

        Texto      like '%Garcia Cabeza de Vaca%' OR
        Titulo     like '%Garcia Cabeza de Vaca%' OR
        Encabezado like '%Garcia Cabeza de Vaca%' OR
        Autor      like '%Garcia Cabeza de Vaca%' OR

        Texto      like '%Francisco Javier Garcia Cabeza de Vaca%' OR
        Titulo     like '%Francisco Javier Garcia Cabeza de Vaca%' OR
        Encabezado like '%Francisco Javier Garcia Cabeza de Vaca%' OR
        Autor      like '%Francisco Javier Garcia Cabeza de Vaca%'  ) ";
            return $query;
            break;


        default:
            break;
    }
}
?>
