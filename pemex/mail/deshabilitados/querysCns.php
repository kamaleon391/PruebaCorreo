<?php
function query($op,$fechaTabla,$estado){
        $fecha=$fechaTabla;
        $FechaCliente = strtotime($fechaTabla);
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);     
        if ($FechaCliente == $fecha_actual)
        {
            $fechaTabla="editorialdia";
        }
        else
        {
            $fechaTabla="editorialsemanal";
        }
    switch ($op)
        {

        case 1:// PRIMERAS PLANAS
            $query="SELECT e.idEditorial, e.periodico,e.categoria ,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,p.estado
                        FROM ".$fechaTabla." e, periodicos p
                        WHERE  e.periodico=p.nombre AND  e.categoria like 'Nota Principal'
                        AND p.estado = '$estado' AND e.fecha='$fecha'
                        group by e.periodico";
            return $query;
            break;

        case 2:// COLUMNAS POLITICAs  Y FINANCIERAS
            $query="SELECT e.idEditorial, e. categoria, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e
                        WHERE
                        (categoria like '%Columnas Financieras%' OR
                         categoria like '%columnas politicas%') AND
                         e.fecha='$fecha' order by e.categoria";
            return $query;
            break;

        case 3:// COLUMNAS FINANCIERAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizado o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%Columnas Financieras%' ) AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizado op) AND p.estado = '$estado'  AND fecha='$fecha' order by o.posicion";
            return $query;
            break;
            
        case 4:// CARTONES
            $query="SELECT e.idEditorial, e.periodico,e.categoria ,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,p.estado
                        FROM ".$fechaTabla." e, periodicos p
                        WHERE  e.periodico=p.nombre AND  e.categoria like 'cartones'
                        AND p.estado = '$estado' AND e.fecha='$fecha' ";
            return $query;  
            break;

        //aqui empezo jop
        case 5://Menciones del titular
            $query="SELECT e.idEditorial,e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto, p.estado,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf, 
                        CONCAT(e.Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS jpg,
                        p.estado
                        FROM  ".$fechaTabla." e, periodicos p
                       WHERE (
                            Texto like '%Monte Alejandro Rubido%' OR 
                            Texto like '%Monte Alejandro Rubido Garcia%' OR
                            Texto  like '%Alejandro Rubido Garcia%' OR
                            Texto like '%Alejandro Rubido%' OR        
                            Texto like '%comisionado nacional de seguridad%' OR        

                            Titulo like '%Monte Alejandro Rubido%' OR 
                            Titulo like '%Monte Alejandro Rubido Garcia%' OR
                            Titulo like '%Alejandro Rubido Garcia%' OR
                            Titulo like '%Alejandro Rubido%' OR        
                            Titulo like '%comisionado nacional de seguridad%' OR        

                            Encabezado like '%Monte Alejandro Rubido%' OR 
                            Encabezado like '%Monte Alejandro Rubido Garcia%' OR
                            Encabezado  like '%Alejandro Rubido Garcia%' OR
                            Encabezado  like '%comisionado nacional de seguridad%' OR
                            Encabezado like '%Alejandro Rubido%' 
                       )
                       AND p.estado = '$estado' AND
                           e.fecha='$fecha' AND
                        e.periodico = p.nombre AND 
                       p.tipo=0 group by e.periodico,e.NumeroPagina Limit 0,30";
            return $query;
            break;

        case 6://Gobierno Federal
            $query="SELECT e.idEditorial,e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf, 
                        CONCAT(e.Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS jpg,
                        p.estado
                        FROM ".$fechaTabla." e, periodicos p
                       WHERE (
                        Texto like '%Enrique pena nieto%' OR
                        Texto like '%presidente peña%' OR
                        Texto like '%presidente de la republica%' OR  
                        Texto like '%presidencia de la republica%' OR
                        Texto like '%peña nieto%' OR
                        Texto like '%pena nieto%' OR
                        Texto like 'Enrique pena nieto' OR
                        Texto like '%epn%' OR
                        Texto like '%@EPN%' OR
                        Texto like '%@presidenciaMX%' OR
                        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
                        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
                        Texto like '%de Peña Nieto%' OR

                        Titulo like '%Enrique pena nieto%' OR
                        Titulo like '%presidente peña%' OR
                        Titulo like '%presidente de la republica%' OR  
                        Titulo like '%presidencia de la republica%' OR
                        Titulo like '%peña nieto%' OR
                        Titulo like '%pena nieto%' OR
                        Titulo like 'Enrique pena nieto'  OR 
                        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
                        Titulo like '%Senor Licenciado enrique pena nieto%' OR
                        Titulo like '%epn%' OR
                        Titulo like '%@EPN%' OR
                        Titulo like '%@presidenciaMX%' OR

                        Encabezado like '%Enrique pena nieto%' OR 
                        Encabezado like '%presidente peña%' OR
                        Encabezado like '%presidente de la republica%' OR  
                        Encabezado like '%presidencia de la republica%' OR 
                        Encabezado like '%peña nieto%' OR
                        Encabezado like '%pena nieto%' OR 
                        Encabezado like 'Enrique pena nieto' OR
                        Encabezado like '%epn%' OR
                        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
                        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
                        Encabezado like '%epn%' OR
                        Encabezado like '%@EPN%' OR
                        Encabezado like '%@presidenciaMX%'  OR

                        /*SECRETARIAS*/
                        Texto like '%SEDATU%' OR
                        Texto like '%secretaria de desarrollo agrario territorial y urbano%' OR
                        Texto like '%secretaria agraria %' OR
                        Texto like '%SRE%' OR
                        Texto like '%secretaria de relaciones exteriores%' OR
                        Texto like '% SE %' OR
                        Texto like '%secretaria de economia%' OR
                        Texto like '%STPS%' OR
                        Texto like '%STPyS%' OR
                        Texto like '%secretaria de trabajo y prevision social%' OR
                        Texto like '%secretaria del trabajo y prevision social%' OR
                        Texto like '%CFE%' OR
                        Texto like '%comision federal de electricidad%' OR
                        Texto like '%ISSSTE%' OR
                        Texto like '%instituto de seguridad y serviciossociales de los trabajadores del estado%' OR
                        Texto like '%IMSS%' OR
                        Texto like '%instituto mexicano del seguro social%' OR
                        Texto like '%seguro social%' OR
                        Texto like '%SCT%' OR
                        Texto like '%Secretaria de comunicaciones y transportes%' OR
                        Texto like '%SECTUR%' OR
                        Texto like '%Secretaria de turismo%' OR
                        Texto like '%SHCP%' OR
                        Texto like '%Secretaria de hacienda y credito publico%' OR
                        Texto like '%Secretaria de hacienda%' OR
                        Texto like '%SEDESOL%' OR
                        Texto like '%secretaria de desarrollo social%' OR
                        Texto like '% SEP %' OR
                        Texto like '%Secretaria de educacion publica%' OR
                        Texto like '%SENER%' OR
                        Texto like '%Secretaria de energia%' OR
                        Texto like '%SSA%' OR
                        Texto like '%Secretaria de salud%' OR
                        Texto like '%SAGARPA%' OR
                        Texto like '%Secretaria de agricultura ganaderia desarrollo rural pesca y alimentacion%' OR
                        Texto like '%PEMEX%' OR
                        Texto like '%petroleos de mexico%' OR
                        Texto like '%CONAGUA%' OR
                        Texto like '%comision nacional del agua%' OR
                        Texto like '%SEMARNAT%' OR
                        Texto like '%secretaria de medio ambiente y recursos naturales%'
            )
             AND p.estado = '$estado' AND
                           e.fecha='$fecha'
                       AND e.periodico = p.nombre AND 
                       p.tipo=0 group by e.periodico,e.NumeroPagina Limit 0,30";
            return $query;
            break;
        
        case 7://Seguridad y Justicia
            $query="SELECT e.idEditorial,e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf, 
                        CONCAT(e.Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS jpg,
                        p.estado
                        FROM ".$fechaTabla." e, periodicos p
                        WHERE (
                        Texto like '%CNS%' OR
                        Texto like ' cns ' OR
                        Texto like '%comsion nacional de seguridad%' OR
                        Texto like 'comsion nacional de seguridad' OR
                        Texto like '%comsion de seguridad%' OR
                        Texto like '%policia federal%' OR
                        Texto like '%PFP%' OR
                        Texto like '% pf %'  OR
                        Texto like '%gendarmeria nacional%' OR
                        Texto like '%gendarmeria%' OR
                        Texto like '%secretaria de la defensa nacional %' OR
                        Texto like '%sedena%' OR
                        Texto like '%salvador cienfuegos zepeda%' OR
                        Texto like '%cienfuegos zepeda%' OR
                        Texto like '%secretaria de marina  %' OR
                        Texto like '% semar %' OR
                        Texto like '%francisco soberon sanz%' OR
                        Texto like '%soberon sanz%' OR
                        Texto like '%procuraduria general de la republica%' OR
                        Texto like '%pgr%' OR
                        Texto like '%murillo karam%' OR

                        Titulo like '% CNS %' OR
                        Titulo like ' cns ' OR
                        Titulo like '%comsion nacional de seguridad%' OR
                        Titulo like 'comsion nacional de seguridad' OR
                        Titulo like '%comsion de seguridad%'  OR
                        Titulo like '%policia federal%' OR
                        Titulo like '%PFP%' OR
                        Titulo like '% pf %' OR
                        Titulo like '%gendarmeria nacional%' OR
                        Titulo like '%gendarmeria%' OR
                        Titulo like '%procuraduria general de la republica%' OR
                        Titulo like '%pgr%' OR
                        Titulo like '%murillo karam%' OR
                        Titulo like '%secretaria de la defensa nacional%' OR
                        Titulo like '%sedena%' OR
                        Titulo like '%salvador cienfuegos zepeda%' OR
                        Titulo like '%cienfuegos zepeda%' OR
                        Titulo like '%secretaria de marina %' OR
                        Titulo like '% semar %' OR
                        Titulo like '%francisco soberon sanz%' OR
                        Titulo like '%soberon sanz%' OR

                        Encabezado like '% CNS %' OR
                        Encabezado like ' cns ' OR
                        Encabezado like '%comsion nacional de seguridad%' OR
                        Encabezado like 'comsion nacional de seguridad' OR
                        Encabezado like '%comsion de seguridad%' OR
                        Encabezado like '%policia federal%' OR
                        Encabezado like '%PFP%' OR
                        Encabezado like '% pf %' OR
                        Encabezado like '%gendarmeria nacional%' OR
                        Encabezado like '%gendarmeria%' OR
                        Encabezado like '%procuraduria general de la republica%' OR
                        Encabezado like '%pgr%' OR
                        Encabezado like '%murillo karam%' OR
                        Encabezado like '%secretaria de la defensa nacional%' OR
                        Encabezado like '%sedena%' OR
                        Encabezado like '%salvador cienfuegos zepeda%' OR
                        encabezado like '%cienfuegos zepeda%'  OR
                        Encabezado like '%secretaria de marina %' OR
                        Encabezado like '% semar %' OR
                        Encabezado like '%francisco soberon sanz%' OR
                        Encabezado like '%soberon sanz%'
            )
             AND p.estado = '$estado' AND
                           e.fecha='$fecha'
                       AND e.periodico = p.nombre AND 
                       p.tipo=0 group by e.periodico,e.NumeroPagina Limit 0,30";
            return $query;
            break;

        case 8://Gobierno Estatal
            $query="SELECT e.idEditorial,e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf, 
                        CONCAT(e.Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS jpg,
                        p.estado
                        FROM ".$fechaTabla." e, periodicos p
                        WHERE (
                        Titulo like '%gobierno%' OR
                        Titulo like '%estado%' OR
                        Titulo like '%alcalde%' OR
                        Titulo like '%municipio%' OR
                        Titulo like '%Ayuntamiento%' OR
                        Texto like '%gobierno%' OR
                        Texto like '%Jefe de Gobierno%' OR
                        Texto like '%estado%' OR
                        Texto like '%alcalde%' OR
                        Texto like '%munici%' OR
                        Texto like '%colonia%' OR
                        Texto like '%barrio%' OR
                        Texto like '%Ayuntamiento%' OR
                        Encabezado like '%gobierno%' OR
                        Encabezado like '%Ayuntamiento%' OR
                        Encabezado like '%estado%'
                        )
                        AND e.periodico=p.nombre AND
                        (
                        e.seccion like '%local%' OR
                        e.seccion like '%B%' OR 
                        e.seccion like '%Ciudad%' OR
                        e.seccion like '%La Jornada%' OR
                        e.seccion like '%munici%' OR
                        e.seccion like '%comuni%' OR
                        e.seccion like '%Est%' OR
                        e.seccion like '%loc%' OR
                        e.categoria ='local')
                      AND p.estado = '$estado' AND
                        e.fecha='$fecha'
                       AND e.periodico = p.nombre AND 
                       p.tipo=0 group by e.periodico,e.NumeroPagina Limit 0,30";
            return $query;
            break;

        default:
            break;
    }
}

?>
