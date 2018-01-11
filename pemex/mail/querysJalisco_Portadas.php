<?php
function query($op,$fecha,$limit1,$limit2){
    switch ($op) {
        case 1:// PRIMERAS PLANAS
            $query="SELECT if( ROUND(3/20) =0,1, ROUND(3/20) ) as 'Paginas' FROM (
                    SELECT
                      n.Periodico as idPeriodico,
                      n.idEditorial,
                      n.Titulo,
                      p.Nombre as Periodico,
                      e.Nombre AS estado,
                      CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                      n.PaginaPeriodico,
                      s.seccion,
                      c.Categoria as Categoria,
                      n.Autor,
                      n.Texto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      n.Categoria as 'Num.Categoria',
                      n.NumeroPagina,
                      n.Hora,
                      n.Encabezado,
                      n.Foto,
                      n.PieFoto
                    FROM 
                    noticiasDia n, 
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
                    c.idCategoria in(3) AND
                    e.idEstado=p.Estado AND
                    Fecha='$fecha' AND (
                            Texto like '%Ayotzinapa%' OR
                            Texto like '%43 Estudiantes%' OR
                            Titulo like '%Ayotzinapa%' OR
                            Titulo like '%43 Estudiantes%' OR
                            Encabezado like '%Ayotzinapa%' OR
                            Encabezado like '%43 Estudiantes%' OR
                            PieFoto like '%Ayotzinapa%' OR
                            PieFoto like '%43 Estudiantes%'
                    )
                    ) derived
                    GROUP BY Paginas";
            return $query;
            break;
        case 2:
           $query="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
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
ordenGeneral o,
seccionesPeriodicos s,
categoriasPeriodicos c,
estados e
WHERE 
p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(3) AND
e.idEstado=p.Estado AND
Fecha='$fecha' AND (
	Texto like '%Ayotzinapa%' OR
	Texto like '%43 Estudiantes%' OR
	Titulo like '%Ayotzinapa%' OR
	Titulo like '%43 Estudiantes%' OR
	Encabezado like '%Ayotzinapa%' OR
	Encabezado like '%43 Estudiantes%' OR
	PieFoto like '%Ayotzinapa%' OR
	PieFoto like '%43 Estudiantes%'
)
GROUP BY n.NumeroPagina,p.idPeriodico
ORDER BY o.posicion";
            
            return $query;
            break;
        default:
            break;
    }
}
?>
