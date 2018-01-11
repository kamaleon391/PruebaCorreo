<?php
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
                        GROUP BY n.Periodico ORDER BY o.posicion";
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
                        ORDER BY o.posicion";
            return $query;  
            break;
        case 5:// CHUBB DE MEXICO
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM
                            ".$fechaTabla." n,
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
                            p.Estado=e.idEstado AND
                            n.Fecha='".$fecha."' AND 
                            n.Activo=1 AND (
                            Texto like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            Texto like '%chubb de mexico compañia de seguros%' OR

                            Titulo like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            Titulo like '%chubb de mexico compañia de seguros%' OR

                            Encabezado like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            Encabezado like '%chubb de mexico compañia de seguros%' OR

                            Autor like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            Autor like '%chubb de mexico compañia de seguros%' OR

                            PieFoto like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            PieFoto like '%chubb de mexico compañia de seguros%' )
                            ORDER BY o.posicion";            
            return $query;  
            break;  
        case 6:// FIANZAS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                    FROM
                        ".$fechaTabla." n,
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
                        p.Estado=e.idEstado AND
                        n.Fecha='".$fecha."' AND 
                        n.Activo=1 AND (
                        Texto like '% Fianza%' OR
                        Titulo like '% Fianza%' OR
                        Encabezado like '% Fianza%' OR
                        Autor like '% Fianza%' OR
                        PieFoto like '% Fianza%'
                    ) AND  (
                        Texto like '%Seguro%' OR
                        Texto like '%aseguradora%' OR
                        Texto like '% Finanza%' OR

                        Titulo like '%Seguro%' OR
                        Titulo like '%aseguradora%' OR
                        Titulo like '% Finanza%' OR

                        Encabezado like '%Seguro%' OR
                        Encabezado like '%aseguradora%' OR
                        Encabezado like '% Finanza%' OR

                        PieFoto like '%Seguro%' OR
                        PieFoto like '%aseguradora%' OR
                        PieFoto like '% Finanza%' OR

                        Autor like '%Seguro%' OR
                        Autor like '%aseguradora%' OR
                        Autor like '% Finanza%'
                    ) AND (
                        Texto not like '%PGR%' AND
                        Texto not like '%Ministerio publico%' AND
                        Texto not like '%juez%' AND 
                        Texto not like '%Bajo Fianza%' AND
                        Texto not like '%futbol%' AND

                        Titulo not like '%PGR%' AND
                        Titulo not like '%Ministerio publico%' AND
                        Titulo not like '%juez%' AND    
                        Titulo not like '%Bajo Fianza%' AND
                        Titulo not like '%futbol%' AND

                        Encabezado not like '%PGR%' AND
                        Encabezado not like '%Ministerio publico%' AND
                        Encabezado not like '%juez%' AND    
                        Encabezado not like '%Bajo Fianza%' AND
                        Encabezado not like '%futbol%' AND

                        Autor not like '%PGR%' AND
                        Autor not like '%Ministerio publico%' AND
                        Autor not like '%juez%' AND 
                        Autor not like '%Bajo Fianza%' AND
                        Autor not like '%futbol%' AND

                        PieFoto not like '%PGR%' AND
                        PieFoto not like '%Ministerio publico%' AND
                        PieFoto not like '%juez%' AND   
                        PieFoto not like '%Bajo Fianza%' AND
                        PieFoto not like '%futbol%' )
                    ORDER BY o.posicion ";
            return $query;  
            break;  
        case 7://  OBRA PUBLICA
           $query="SELECT 
	DISTINCT(n.idEditorial),
	n.Periodico AS 'idPeriodico',
	p.Nombre AS 'Periodico',
	n.Fecha,
	n.Titulo,
	n.Seccion AS 'idSeccion',
	s.seccion AS 'Seccion',
	n.NumeroPagina,
	n.Texto,
	CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
FROM
	".$fechaTabla." n,
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
	p.Estado=e.idEstado AND
	n.Fecha='".$fecha."'  AND
	n.Activo = 1 AND (
		Texto like '%Obra Publica%' OR
		Texto like '%Linea 12 del Metro%' OR
		Texto like '%Linea _ Metrobus%' OR
		Texto like '% metro DF%' OR
		Texto like '% STCM %' OR
		Texto like '%Autopista Urbana%' OR
		Texto like '%Línea 12%' OR

		Titulo like '%Obra Publica%' OR
		Titulo like '%Linea 12 del Metro%' OR
		Titulo like '%Linea _ Metrobus%' OR
		Titulo like '% metro DF%' OR
		Titulo like '% STCM %' OR
		Titulo like '%Autopista Urbana%' OR

		Encabezado like '%Obra Publica%' OR
		Encabezado like '%Linea 12 del Metro%' OR
		Encabezado like '%Linea _ Metrobus%' OR
		Encabezado like '% metro DF%' OR
		Encabezado like '% STCM %' OR
		Encabezado like '%Autopista Urbana%' OR

		PieFoto like '%Obra Publica%' OR
		PieFoto like '%Linea 12 del Metro%' OR
		PieFoto like '%Linea _ Metrobus%' OR
		PieFoto like '% metro DF%' OR
		PieFoto like '% STCM %' OR
		PieFoto like '%Autopista Urbana%' OR

		Autor like '%Obra Publica%' OR
		Autor like '%Linea 12 del Metro%' OR
		Autor like '%Linea _ Metrobus%' OR
		Autor like '% metro DF%' OR
		Autor like '% STCM %' OR
		Autor like '%Autopista Urbana%'
)
ORDER BY o.posicion";
            return $query;  
            break; 
        case 8://  SECRETARIA DE DESARROLLO URBANO
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s  
                        WHERE (
                            Texto like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            Texto like '% seduvi %' OR
                            Texto like '%Felipe de Jesus Gutierrez%' OR

                            Titulo like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            Titulo like '% seduvi %' OR
                            Titulo like '%Felipe de Jesus Gutierrez%' OR

                            Encabezado like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            Encabezado like '% seduvi %' OR
                            Encabezado like '%Felipe de Jesus Gutierrez%' OR

                            PieFoto like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            PieFoto like '% seduvi %' OR
                            PieFoto like '%Felipe de Jesus Gutierrez%' OR

                            Autor like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            Autor like '% seduvi %' OR
                            Autor like '%Felipe de Jesus Gutierrez%'
            ) AND
            n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=9 AND p.tipo=1 AND 
            n.Activo=1 AND
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;  
            break;  
        case 9://  CHUBB ESTADOS
           $query="FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  p.Estado=e.idEstado AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
n.Categoria!=80 AND
n.Activo =1 and
p.Tipo=1 AND
p.Estado!=9 AND
  fecha = CURDATE() AND (
                            Texto like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            Texto like '%chubb de mexico compañia de seguros%' OR

                            Titulo like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            Titulo like '%chubb de mexico compañia de seguros%' OR

                            Encabezado like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            Encabezado like '%chubb de mexico compañia de seguros%' OR

                            Autor like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            Autor like '%chubb de mexico compañia de seguros%' OR

                            PieFoto like '%chubb de mexico compañia de seguros y afianzadora%' OR
                            PieFoto like '%chubb de mexico compañia de seguros%' )
ORDER BY p.Estado,p.Nombre";
            return $query;  
            break;
        case 10://  FIANZA ESTADOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                            WHERE  (
                        Texto like '% Fianza%' OR
                        Titulo like '% Fianza%' OR
                        Encabezado like '% Fianza%' OR
                        Autor like '% Fianza%' OR
                        PieFoto like '% Fianza%'
                    ) AND  (
                        Texto like '%Seguro%' OR
                        Texto like '%aseguradora%' OR
                        Texto like '% Finanza%' OR

                        Titulo like '%Seguro%' OR
                        Titulo like '%aseguradora%' OR
                        Titulo like '% Finanza%' OR

                        Encabezado like '%Seguro%' OR
                        Encabezado like '%aseguradora%' OR
                        Encabezado like '% Finanza%' OR

                        PieFoto like '%Seguro%' OR
                        PieFoto like '%aseguradora%' OR
                        PieFoto like '% Finanza%' OR

                        Autor like '%Seguro%' OR
                        Autor like '%aseguradora%' OR
                        Autor like '% Finanza%'
                    ) AND (
                        Texto not like '%PGR%' AND
                        Texto not like '%Ministerio publico%' AND
                        Texto not like '%juez%' AND 
                        Texto not like '%Bajo Fianza%' AND
                        Texto not like '%futbol%' AND

                        Titulo not like '%PGR%' AND
                        Titulo not like '%Ministerio publico%' AND
                        Titulo not like '%juez%' AND    
                        Titulo not like '%Bajo Fianza%' AND
                        Titulo not like '%futbol%' AND

                        Encabezado not like '%PGR%' AND
                        Encabezado not like '%Ministerio publico%' AND
                        Encabezado not like '%juez%' AND    
                        Encabezado not like '%Bajo Fianza%' AND
                        Encabezado not like '%futbol%' AND

                        Autor not like '%PGR%' AND
                        Autor not like '%Ministerio publico%' AND
                        Autor not like '%juez%' AND 
                        Autor not like '%Bajo Fianza%' AND
                        Autor not like '%futbol%' AND

                        PieFoto not like '%PGR%' AND
                        PieFoto not like '%Ministerio publico%' AND
                        PieFoto not like '%juez%' AND   
                        PieFoto not like '%Bajo Fianza%' AND
                        PieFoto not like '%futbol%' ) AND
                n.Periodico=p.idPeriodico AND 
                p.Estado!=9 and n.Categoria != 80 AND s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND p.tipo=1 AND
                n.Activo=1
                GROUP BY n.Periodico, n.NumeroPagina
                ORDER BY n.Periodico limit 0,29;";
            return $query;  
            break;    
        case 11://  OBRA PUBLICA  ESTADOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s 
                        WHERE (
        Texto like '%Obra Publica%' OR
        Texto like '%Linea 12 del Metro%' OR
        Texto like '%Linea _ Metrobus%' OR
        Texto like '% metro DF%' OR
        Texto like '% STCM %' OR
        Texto like '%Autopista Urbana%' OR
        Texto like '%Línea 12%' OR

        Titulo like '%Obra Publica%' OR
        Titulo like '%Linea 12 del Metro%' OR
        Titulo like '%Linea _ Metrobus%' OR
        Titulo like '% metro DF%' OR
        Titulo like '% STCM %' OR
        Titulo like '%Autopista Urbana%' OR

        Encabezado like '%Obra Publica%' OR
        Encabezado like '%Linea 12 del Metro%' OR
        Encabezado like '%Linea _ Metrobus%' OR
        Encabezado like '% metro DF%' OR
        Encabezado like '% STCM %' OR
        Encabezado like '%Autopista Urbana%' OR

        PieFoto like '%Obra Publica%' OR
        PieFoto like '%Linea 12 del Metro%' OR
        PieFoto like '%Linea _ Metrobus%' OR
        PieFoto like '% metro DF%' OR
        PieFoto like '% STCM %' OR
        PieFoto like '%Autopista Urbana%' OR

        Autor like '%Obra Publica%' OR
        Autor like '%Linea 12 del Metro%' OR
        Autor like '%Linea _ Metrobus%' OR
        Autor like '% metro DF%' OR
        Autor like '% STCM %' OR
        Autor like '%Autopista Urbana%'
) AND
            n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado!=9 and n.Categoria != 80 AND p.tipo=1 AND n.Activo=1
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;  
            break;
        case 12://  CHUBB SECRETARIA DE DESAROLLO URBANO ESTADOS
           $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf'
                        FROM ".$fechaTabla." n, periodicos p, seccionesPeriodicos s  
                        WHERE (
                            Texto like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            Texto like '% seduvi %' OR
                            Texto like '%Felipe de Jesus Gutierrez%' OR

                            Titulo like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            Titulo like '% seduvi %' OR
                            Titulo like '%Felipe de Jesus Gutierrez%' OR

                            Encabezado like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            Encabezado like '% seduvi %' OR
                            Encabezado like '%Felipe de Jesus Gutierrez%' OR

                            PieFoto like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            PieFoto like '% seduvi %' OR
                            PieFoto like '%Felipe de Jesus Gutierrez%' OR

                            Autor like '%Secretaria de Desarrollo Urbano del  Gobierno del DF%' OR
                            Autor like '% seduvi %' OR
                            Autor like '%Felipe de Jesus Gutierrez%'
            ) AND
            n.Periodico=p.idPeriodico AND 
            s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND
            p.Estado=!9 and n.Categoria != 80  AND p.tipo=1 AND n.Activo=1
            GROUP BY n.Periodico, n.NumeroPagina
            ORDER BY n.Periodico";
            return $query;  
            break;     
        default:
            break;
    }
}
?>
