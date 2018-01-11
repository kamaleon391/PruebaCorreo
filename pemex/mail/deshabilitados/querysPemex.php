<?php
function query($op,$fechaTabla){
     switch ($op) {
        case 1:// PRIMERAS PLANAS
            $query="SELECT e.idEditorial, e.Periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                    p.estado
                    FROM editorialdia e, periodicos p 
                    WHERE(
                        Texto like '%Hospital general Pemex Cadereyta%' OR
                        Texto like '%Pemex Cadereyta%' OR
                        Texto like '%Hospital de pemex%' OR
                        Texto like '%Hospital de petroleos mexicanos%' OR

                        Titulo like '%Hospital general Pemex Cadereyta%' OR
                        Titulo like '%Pemex Cadereyta%' OR
                        Titulo like '%Hospital de pemex%' OR
                        Titulo like '%Hospital de petroleos mexicanos%' OR

                        Encabezado like '%Hospital general Pemex Cadereyta%' OR
                        Encabezado like '%Pemex Cadereyta%' OR
                        Encabezado like '%Hospital de pemex%' OR
                        Encabezado like '%Hospital de petroleos mexicanos%' 
                    )
                    AND 
                    (
                    Texto like '%Cadereyta%' OR
                    Titulo like '%Cadereyta%' OR
                    Encabezado like '%Cadereyta%'
                    )
                    AND e.periodico=p.nombre 
            group by NumeroPagina, Periodico         
            order by p.estado, p.nombre";
            return $query;
            break;
        case 2:// COLUMNAS POLITICAS
            $query="SELECT idEditorial, Periodico, Fecha, Titulo, Seccion,NumeroPagina,Texto, pdf, estado FROM
                (
        SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
       CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
       p.estado
          FROM editorialdia e, periodicos p         
		WHERE(
            Texto like '%Hospital general Pemex Cadereyta%' OR
            Texto like '%Pemex Cadereyta%' OR
            Texto like '%Hospital de pemex%' OR
            Texto like '%Hospital de petroleos mexicanos%' OR

            Titulo like '%Hospital general Pemex Cadereyta%' OR
            Titulo like '%Pemex Cadereyta%' OR
            Titulo like '%Hospital de pemex%' OR
            Titulo like '%Hospital de petroleos mexicanos%' OR

            Encabezado like '%Hospital general Pemex Cadereyta%' OR
            Encabezado like '%Pemex Cadereyta%' OR
            Encabezado like '%Hospital de pemex%' OR
            Encabezado like '%Hospital de petroleos mexicanos%' 
        )
		AND 
		(Texto like '%Cadereyta%' OR
            Titulo like '%Cadereyta%' OR
            Encabezado like '%Cadereyta%'
			)
        AND e.periodico=p.nombre 
 group by NumeroPagina, Periodico            
UNION 
SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
       CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
       p.estado
          FROM editorialsemanal e, periodicos p         
		WHERE(
            Texto like '%Hospital general Pemex Cadereyta%' OR
            Texto like '%Pemex Cadereyta%' OR
            Texto like '%Hospital de pemex%' OR
            Texto like '%Hospital de petroleos mexicanos%' OR

            Titulo like '%Hospital general Pemex Cadereyta%' OR
            Titulo like '%Pemex Cadereyta%' OR
            Titulo like '%Hospital de pemex%' OR
            Titulo like '%Hospital de petroleos mexicanos%' OR

            Encabezado like '%Hospital general Pemex Cadereyta%' OR
            Encabezado like '%Pemex Cadereyta%' OR
            Encabezado like '%Hospital de pemex%' OR
            Encabezado like '%Hospital de petroleos mexicanos%' 
        )
		AND 
		(Texto like '%Cadereyta%' OR
            Titulo like '%Cadereyta%' OR
            Encabezado like '%Cadereyta%'
			)
        AND e.periodico=p.nombre 
 group by NumeroPagina, Periodico   
UNION
SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
       CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
       p.estado
          FROM editorialmensual e, periodicos p         
		WHERE(
            Texto like '%Hospital general Pemex Cadereyta%' OR
            Texto like '%Pemex Cadereyta%' OR
            Texto like '%Hospital de pemex%' OR
            Texto like '%Hospital de petroleos mexicanos%' OR

            Titulo like '%Hospital general Pemex Cadereyta%' OR
            Titulo like '%Pemex Cadereyta%' OR
            Titulo like '%Hospital de pemex%' OR
            Titulo like '%Hospital de petroleos mexicanos%' OR

            Encabezado like '%Hospital general Pemex Cadereyta%' OR
            Encabezado like '%Pemex Cadereyta%' OR
            Encabezado like '%Hospital de pemex%' OR
            Encabezado like '%Hospital de petroleos mexicanos%' 
        )
		AND 
		(Texto like '%Cadereyta%' OR
            Titulo like '%Cadereyta%' OR
            Encabezado like '%Cadereyta%'
			)
        AND e.periodico=p.nombre 
 group by NumeroPagina, Periodico               
)
Derived 
Order by fecha";
            return $query;
            break;
           
        default:
            break;
    }
}
?>
