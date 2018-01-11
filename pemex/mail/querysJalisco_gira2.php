<?php
function query($op,$fecha){

    switch ($op) {
       
    	case 1:
    	//DF
       $query = "
       SELECT 
		'Gobernador' AS Tema,
		p.Nombre AS Periodico,
		n.Titulo,
		n.Texto,
		s.seccion,
		n.NumeroPagina,
		CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
		p.estado,
		(2) as Pagina
	FROM 
(
SELECT Titulo,Encabezado, Texto,Fecha, NumeroPagina, periodico, Seccion FROM noticiasDia WHERE Fecha = '$fecha'
UNION ALL
SELECT Titulo, Encabezado,Texto, Fecha, NumeroPagina, periodico, Seccion FROM noticiasSemana WHERE Fecha = '$fecha' 
UNION ALL
SELECT Titulo, Encabezado,Texto, Fecha, NumeroPagina, periodico, Seccion FROM noticiasMensual WHERE Fecha = '$fecha' 
) n,
		(SELECT periodico FROM ordenGeneral op ORDER BY op.posicion)  o, 
		periodicos p,
		seccionesPeriodicos s
	WHERE
		p.idPeriodico not in (149,155) AND
		n.periodico=o.periodico AND (
				Texto like '%Gobernador de Jalisco%' AND (
					Texto like '%GIRA POR ASIA%' OR
					Texto like '%Tokio%' OR
					Texto like '%Nagoya%' OR
					Texto like '%Osaka%' OR
					Texto like '%Taipei%' OR
					Texto like '%Japon%' OR
					Texto like '% asia %'
				) OR
				Texto like '%Aristoteles Sandoval%' AND (
					Texto like '%GIRA POR ASIA%' OR
					Texto like '%Tokio%' OR
					Texto like '%Nagoya%' OR
					Texto like '%Osaka%' OR
					Texto like '%Taipei%' OR
					Texto like '%Japon%' OR
					Texto like '% asia %'
				) OR
				Texto like '%jose palacios jimenez%' AND (
					Texto like '%GIRA POR ASIA%' OR
					Texto like '%Tokio%' OR
					Texto like '%Nagoya%' OR
					Texto like '%Osaka%' OR
					Texto like '%Taipei%' OR
					Texto like '%Japon%' OR
					Texto like '% asia %'
				) OR
				Titulo like '%Gobernador de Jalisco%' AND(
					Titulo like '%GIRA POR ASIA%' OR
					Titulo like '%Tokio%' OR
					Titulo like '%Nagoya%' OR
					Titulo like '%Osaka%' OR
					Titulo like '%Taipei%' OR
					Titulo like '%Japon%' OR
					Titulo like '% asia %'
				) OR
				Titulo like '%Aristoteles Sandoval%' AND(
					Titulo like '%GIRA POR ASIA%' OR
					Titulo like '%Tokio%' OR
					Titulo like '%Nagoya%' OR
					Titulo like '%Osaka%' OR
					Titulo like '%Taipei%' OR
					Titulo like '%Japon%' OR
					Titulo like '% asia %'
				) OR
				Titulo like '%jose palacios jimenez%' AND(
					Titulo like '%GIRA POR ASIA%' OR
					Titulo like '%Tokio%' OR
					Titulo like '%Nagoya%' OR
					Titulo like '%Osaka%' OR
					Titulo like '%Taipei%' OR
					Titulo like '%Japon%' OR
					Titulo like '% asia %'
				) OR
				Encabezado like '%Gobernador de Jalisco%' AND (
					Encabezado like '%GIRA POR ASIA%' OR
					Encabezado like '%Tokio%' OR
					Encabezado like '%Nagoya%' OR
					Encabezado like '%Osaka%' OR
					Encabezado like '%Taipei%' OR
					Encabezado like '%Japon%' OR
					Encabezado like '% asia %'

				) OR
				Encabezado like '%jose palacios jimenez%' AND (
					Encabezado like '%GIRA POR ASIA%' OR
					Encabezado like '%Tokio%' OR
					Encabezado like '%Nagoya%' OR
					Encabezado like '%Osaka%' OR
					Encabezado like '%Taipei%' OR
					Encabezado like '%Japon%' OR
					Encabezado like '% asia %'

				) OR
				Encabezado like '%Aristoteles Sandoval%' AND (
					Encabezado like '%GIRA POR ASIA%' OR
					Encabezado like '%Tokio%' OR
					Encabezado like '%Nagoya%' OR
					Encabezado like '%Osaka%' OR
					Encabezado like '%Taipei%' OR
					Encabezado like '%Japon%' OR
					Encabezado like '% asia %'
				)
		) AND 
		n.periodico=p.idPeriodico AND 
		s.idSeccion=n.Seccion AND
		n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND 
		fecha='".$fecha."'
		GROUP BY
		n.periodico, n.NumeroPagina
		ORDER BY Pagina
	";

		return $query;
        break;
        
        case 2:
        //JALISCO
       $query = "
       SELECT 
		'Gobernador' AS Tema,
		p.Nombre AS Periodico,
		n.Titulo,
		n.Texto,
		s.seccion,
		n.NumeroPagina,
		CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
		p.estado,
		(2) as Pagina
	FROM 
(
SELECT Titulo,Encabezado, Texto,Fecha, NumeroPagina, periodico, Seccion FROM noticiasDia WHERE Fecha = '$fecha'
UNION ALL
SELECT Titulo, Encabezado,Texto, Fecha, NumeroPagina, periodico, Seccion FROM noticiasSemana WHERE Fecha = '$fecha' 
UNION ALL
SELECT Titulo, Encabezado,Texto, Fecha, NumeroPagina, periodico, Seccion FROM noticiasMensual WHERE Fecha = '$fecha' 
) n,
		(SELECT periodico FROM ordenGeneraljalisco op ORDER BY op.posicion)  o, 
		periodicos p,
		seccionesPeriodicos s
	WHERE
		p.idPeriodico not in (149,155) AND
		n.periodico=o.periodico AND (
				Texto like '%Gobernador de Jalisco%' AND (
					Texto like '%GIRA POR ASIA%' OR
					Texto like '%Tokio%' OR
					Texto like '%Nagoya%' OR
					Texto like '%Osaka%' OR
					Texto like '%Taipei%' OR
					Texto like '%Japon%' OR
					Texto like '% asia %'
				) OR
				Texto like '%Aristoteles Sandoval%' AND (
					Texto like '%GIRA POR ASIA%' OR
					Texto like '%Tokio%' OR
					Texto like '%Nagoya%' OR
					Texto like '%Osaka%' OR
					Texto like '%Taipei%' OR
					Texto like '%Japon%' OR
					Texto like '% asia %'
				) OR
				Texto like '%jose palacios jimenez%' AND (
					Texto like '%GIRA POR ASIA%' OR
					Texto like '%Tokio%' OR
					Texto like '%Nagoya%' OR
					Texto like '%Osaka%' OR
					Texto like '%Taipei%' OR
					Texto like '%Japon%' OR
					Texto like '% asia %'
				) OR
				Titulo like '%Gobernador de Jalisco%' AND(
					Titulo like '%GIRA POR ASIA%' OR
					Titulo like '%Tokio%' OR
					Titulo like '%Nagoya%' OR
					Titulo like '%Osaka%' OR
					Titulo like '%Taipei%' OR
					Titulo like '%Japon%' OR
					Titulo like '% asia %'
				) OR
				Titulo like '%Aristoteles Sandoval%' AND(
					Titulo like '%GIRA POR ASIA%' OR
					Titulo like '%Tokio%' OR
					Titulo like '%Nagoya%' OR
					Titulo like '%Osaka%' OR
					Titulo like '%Taipei%' OR
					Titulo like '%Japon%' OR
					Titulo like '% asia %'
				) OR
				Titulo like '%jose palacios jimenez%' AND(
					Titulo like '%GIRA POR ASIA%' OR
					Titulo like '%Tokio%' OR
					Titulo like '%Nagoya%' OR
					Titulo like '%Osaka%' OR
					Titulo like '%Taipei%' OR
					Titulo like '%Japon%' OR
					Titulo like '% asia %'
				) OR
				Encabezado like '%Gobernador de Jalisco%' AND (
					Encabezado like '%GIRA POR ASIA%' OR
					Encabezado like '%Tokio%' OR
					Encabezado like '%Nagoya%' OR
					Encabezado like '%Osaka%' OR
					Encabezado like '%Taipei%' OR
					Encabezado like '%Japon%' OR
					Encabezado like '% asia %'

				) OR
				Encabezado like '%jose palacios jimenez%' AND (
					Encabezado like '%GIRA POR ASIA%' OR
					Encabezado like '%Tokio%' OR
					Encabezado like '%Nagoya%' OR
					Encabezado like '%Osaka%' OR
					Encabezado like '%Taipei%' OR
					Encabezado like '%Japon%' OR
					Encabezado like '% asia %'

				) OR
				Encabezado like '%Aristoteles Sandoval%' AND (
					Encabezado like '%GIRA POR ASIA%' OR
					Encabezado like '%Tokio%' OR
					Encabezado like '%Nagoya%' OR
					Encabezado like '%Osaka%' OR
					Encabezado like '%Taipei%' OR
					Encabezado like '%Japon%' OR
					Encabezado like '% asia %'
				)
		) AND 
		n.periodico=p.idPeriodico AND 
		s.idSeccion=n.Seccion AND
		n.Seccion NOT IN(63,21,147,765,533,22,201,1577,17,361,411,239,1611,626) AND 
		fecha='".$fecha."'
		GROUP BY
		n.periodico, n.NumeroPagina
		ORDER BY Pagina";
		
        return $query;
        break;    

        default:
            break;
    }
}
?>
