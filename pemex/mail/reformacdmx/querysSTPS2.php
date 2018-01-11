<?php
function query($op,$Tabla){
       $fecha=$Tabla;
       $FechaCliente = strtotime($Tabla);
        
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);
            
        if ($FechaCliente == $fecha_actual)
        {
            $Tabla="noticiasDia";
        }
        else
        {
            $Tabla="(
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasSemana WHERE Fecha = '".$fecha."' 
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasMensual WHERE Fecha = '".$fecha."'  
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasAnual WHERE Fecha = '".$fecha."'  
                )";
        }
        switch ($op){
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
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion
                    ";
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
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico 
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
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico ";
            return $query;
            break;//Columnas Financieras
        case 4:
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
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion
                    ";
            return $query;  
            break;// Cartones DF
        case 5://NAVARETE PRIDA
           $query="SELECT n.idEditorial,
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
                   fecha =DATE('$fecha') AND
                   (
                    Texto like '%Secretario Del Trabajo%' OR
                    Texto like '%Secretario De Trabajo%' OR
                    Texto like '%titular de la STPS%' OR
                    Texto like '%titular de la secretaria del trabajo y prevision social%' OR
                    Texto like '%Alfonso Navarrete Prida%' OR  
                    Texto like 'Alfonso Navarrete Prida' OR
                    Texto like '%Alfonso Navarrete%' OR    
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%varrete Prida%' OR
                    Texto like '%varretePrida%' OR
                    Texto like '%NavarretePrida%' OR
                    Texto like '%varrete P rid%' OR
                    Texto like '%varrete P rid a%' OR

                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Alfonso Navarrete%' OR
                    Titulo like 'Alfonso Navarrete Prida'  OR 
                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Navarrete Prida%' OR
                    Titulo like '%titular de la STPS%' OR
                    Titulo like '%varrete Prida%' OR
                    Titulo like '%varretePrida%' OR
                    Titulo like '%varrete P rid%' OR
                    Titulo like '%varrete P rid a%' OR

                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Alfonso Navarrete%' OR
                    Encabezado like 'Alfonso Navarrete Prida'  OR 
                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Secretario Del Trabajo%' OR
                    encabezado like '%Secretario Del Trabajo%' OR
                    Encabezado like '%Navarrete Prida%' OR
                    Encabezado like '%titular de la STPS%' OR
                    Encabezado like '%varrete Prida%' OR
                    Encabezado like '%varretePrida%' OR
                    Encabezado like '%varrete P rid%' OR
                    Encabezado like '%varrete P rid a%'
                   )AND (
                        ( (Texto like '%Alfonso%' AND Texto like '%Prida%') OR
                          (Texto like '%Secretario Del Trabajo%') OR
                          (Texto like '%Secretario De Trabajo%') OR
                          (Texto like '%Alfonso%' AND Texto like '%Navarrete%') OR 
                           Texto like '%titular de la STPS%') OR
                        ( (Titulo like '%Alfonso%' AND Titulo like '%Prida%') OR (Titulo like '%Alfonso%' AND Titulo like '%Navarrete%') OR Titulo like '%titular de la STPS%') OR
                        ( (Encabezado like '%Alfonso%' AND Encabezado like '%Prida%') OR (Encabezado like '%Alfonso%' AND Encabezado like '%Navarrete%') OR Encabezado like '%titular de la STPS%'))


GROUP BY p.idPeriodico,n.PaginaPeriodico
ORDER BY o.posicion";
            return $query;      
        break;//Navarrete Prida
        case 6://STPS
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                    Texto like '%STPS%' OR
                    Texto like '%STPyS%' OR
                    Texto like '%STyPS%' OR
                    Texto like '%secretaria del trabajo y prevision social%' OR
                    Texto like '%STPS%' OR
                    Texto like '%secretaria del trabajo estatal%' OR
                    Texto like '%secretaria del trabajo%' OR
                    Texto like '%secretaria de trabajo%' OR
                    Texto like '%secretariadeltrabajo%' OR
                    Texto like '%secretarias del trabajo%' OR

                    Titulo like '%STPS%' OR
                    Titulo like '%STPyS%' OR
                    Titulo like '%STyPS%' OR
                    Titulo like '%secretaria del trabajo y prevision social%' OR
                    Titulo like '%STPS%' OR
                    Titulo like '%secretaria del trabajo estatal%' OR
                    Titulo like '%secretaria del trabajo%' OR
                    Titulo like '%secretaria de trabajo%' OR
                    Titulo like '%secretariadeltrabajo%' OR
                    Titulo like '%secretarias del trabajo%' OR


                    Encabezado like '%STPS%' OR
                    Encabezado like '%STPyS%' OR
                    Encabezado like '%STyPS%' OR
                    Encabezado like '%secretaria del trabajo y prevision social%' OR
                    Encabezado like '%STPS%' OR
                    Encabezado like '%secretaria del trabajo estatal%' OR
                    Encabezado like '%secretaria del trabajo%' OR
                    Encabezado like '%secretaria de trabajo%' OR
                    Encabezado like '%secretariadeltrabajo%' OR
                    Encabezado like '%secretarias del trabajo%'
                    )
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico 
                    ORDER BY o.posicion";
            return $query;  
            break; //STPS 
        case 7:// STPS | SUBSECRETARIAS
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (        
                    Texto LIKE 'subsecretario del Trabajo y Previsión Social' OR
                    Texto like '%jose adan ignacio rubi salazar%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%rubi salazar%' AND (Texto like '%STPS%' OR Texto like '%subsecretari%') OR
                    Texto like '%ignacio rubi%' AND (Texto like '%STPS%' OR Texto like '%subsecretari%') OR
                    Texto like '%flora patricia martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%flora patricia martinez%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%flora martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%niceforo guerrero reynoso%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR 
                    Texto like '%niceforo guerrero%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%guerrero reynoso%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%Canek Vaquez Gongora%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%Canek Vaquez%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%Manuel Cadena Morales%' OR
                    Texto like '%Cadena Morales%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%delegaciones federales del trabajo%' OR
                    Texto like '%Carlos flores rico%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%Servicio nacional de empleo%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%maria brenda estrada de paz%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%maria estrada de paz%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%maria estrada%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%consumo de los trabajadores%' OR
                    Texto like '%subsecretaria de inclusion laboral%' OR
                    Texto like '%Empleo y Productividad Laboral%' OR
                    Texto like '%Oficial Mayor%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Texto like '%Instituto del Fondo Nacional para el Consumo de los Trabajadores%' OR
                    Texto like '%Consumo de los Trabajadores%' OR
                    Texto like '%Unidad de Delegaciones Federales del Trabajo%' OR
                    Texto like '%Servicio Nacional de Empleo%' OR
                    Texto like '%Recursos Materiales y Servicios Generales%' OR


                    Titulo like '%jose adan ignacio rubi salazar%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%rubi salazar%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%ignacio rubi%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%flora patricia martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%flora patricia martinez%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%flora martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%niceforo guerrero reynoso%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR 
                    Titulo like '%niceforo guerrero%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%guerrero reynoso%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%Canek Vaquez Gongora%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%Canek Vaquez%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%Manuel Cadena Morales%' OR
                    Titulo like '%Cadena Morales%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%delegaciones federales del trabajo%' OR
                    Titulo like '%Carlos flores rico%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%Servicio nacional de empleo%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%maria brenda estrada de paz%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%maria estrada de paz%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%maria estrada%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%consumo de los trabajadores%' OR
                    Titulo like '%subsecretaria de inclusion laboral%' OR
                    Titulo like '%Empleo y Productividad Laboral%' OR
                    Titulo like '%Oficial Mayor%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Titulo like '%Instituto del Fondo Nacional para el Consumo de los Trabajadores%' OR
                    Titulo like '%Consumo de los Trabajadores%' OR
                    Titulo like '%Unidad de Delegaciones Federales del Trabajo%' OR
                    Titulo like '%Servicio Nacional de Empleo%' OR
                    Titulo like '%Recursos Materiales y Servicios Generales%' OR

                    Encabezado like '%jose adan ignacio rubi salazar%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%rubi salazar%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%ignacio rubi%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%flora patricia martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%flora patricia martinez%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%flora martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%martinez cranss%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%niceforo guerrero reynoso%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR 
                    Encabezado like '%niceforo guerrero%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%guerrero reynoso%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%Canek Vaquez Gongora%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%Canek Vaquez%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%Manuel Cadena Morales%' OR
                    Encabezado like '%Cadena Morales%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%delegaciones federales del trabajo%' OR
                    Encabezado like '%Carlos flores rico%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%Servicio nacional de empleo%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%maria brenda estrada de paz%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%maria estrada de paz%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%maria estrada%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%consumo de los trabajadores%' OR
                    Encabezado like '%subsecretaria de inclusion laboral%' OR
                    Encabezado like '%Empleo y Productividad Laboral%' OR
                    Encabezado like '%Oficial Mayor%' AND (Texto like '%STPS%' AND Texto like '%subsecretari%') OR
                    Encabezado like '%Instituto del Fondo Nacional para el Consumo de los Trabajadores%' OR
                    Encabezado like '%Consumo de los Trabajadores%' OR
                    Encabezado like '%Unidad de Delegaciones Federales del Trabajo%' OR
                    Encabezado like '%Servicio Nacional de Empleo%' OR
                    Encabezado like '%Recursos Materiales y Servicios Generales%'
                   )
                GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico 
                ORDER BY o.posicion";
            return $query;  //Subsecretarias      
        case 8:// STPS | ORGANISMOS DESCENTRALIZADOS
              $query="SELECT n.idEditorial,
                      n.Periodico as 'idPeriodico',
                      p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                      CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                    Texto like '%profedet%' OR
                    Texto like '%conciliacion y arbitraje%' OR
                    Texto like '%junta federal de conciliacion y arbitraje%' OR
                    Texto like '%fonacot%' OR
                    Texto like '%trabajadores y el crecimiento de su patrimonio familiar%' OR
                    Texto like '%comite nacional mixto de proteccion al salario%' OR
                    Texto like '%conampros%' 
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  
            break; //Desconcentrados 
        case 9:// STPS | DELEGACIONES FEDERALESS
             $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                    Texto like'%Manuel Cortina Reynoso%'  AND (Texto like '%delegado Federal del Trabajo%' OR Texto like '%delegado de la STPS%') OR
                    Texto like'%jose felix arango perez%' AND (Texto like '%delegado Federal del Trabajo%' OR Texto like '%delegado de la STPS%') OR
                    Texto like'%amalia camacho alvarez%'  AND (Texto like '%delegado Federal del Trabajo%' OR Texto like '%delegado de la STPS%') OR
                    Texto like'%manuel enrique adam medina%' AND (Texto like '%delegado Federal del Trabajo%' OR Texto like '%delegado de la STPS%') OR
                    Texto like'%cesar augusto rodriguez  cal y mayor%' AND (Texto like '%delegado Federal del Trabajo%' OR Texto like '%delegado de la STPS%') OR
                    Texto like'%victor hugo saenz morales%' AND (Texto like '%delegado Federal del Trabajo%' OR Texto like '%delegado de la STPS%') OR
                    Texto like'%jose daniel rodriguez herrera%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%carlos alberto uribe juarez%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%horacio alguilar alvarez de alba%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%jesus salvador salum del palacio%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%fernando Hinterholzer Diestel%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Hugo Meneses Carrasco%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Jaime Zuniga Hernandez%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Mariana Gudino Paredes%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Gabriela Gomez Orihuela %' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Efren vera Torres%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Fanny Arellanes Cervantes%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Maria Guadalupe Gonzalez Ruiz %' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Horacio Alberto Garmendia Salman%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Jose Francisco Landeras Layseca%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Rogelio Marquez Valdivia%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Santiago Maza Moheno%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%German Diaz Malacon%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Mario Abraham Armenta Montano%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Jorge Lorenzo Barragan Lanz%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Martha Elena Duran Gonzalez %' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Alfonso Vazquez Cuevas%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Luis Alberto Lopez Perez%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Gilberto Zapata Frayre%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Gilberto Zapata Fraire%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like'%Delegado Federal del Trabajo%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Texto like '%secretariodeltrabajo%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Titulo like '%Delegado Federal del Trabajo%' AND (Texto like '%delegado Federal del Trabajo%'OR Texto like '%delegado de la STPS%') OR
                    Encabezado like '%Delegado Federal del Trabajo%' OR Encabezado like '%delegado de la STPS%'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;  
            break;//Delegados 
        case 10:// STPS | CONFEDERACIONES OBRERAS Y SINDICATOS PARTE 1
              $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                        Texto like '%STPS%' OR
                        Texto like '%STPyS%' OR
                        Texto like '%secretaria del trabajo y prevision social%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%STPS%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%obrera%' OR
                        Texto like '%confederaciones obreras%' OR
                        Texto like '%manifestacion%' OR
                        Texto like '%mexicana de avicion%' OR
                        Texto like '%asociacion sindical%' OR
                        Texto like '%asociacion mexicana%' OR
                        Texto like '%instituto federal%' OR
                        Texto like '%salarios minimos%' OR
                        Texto like '%empleado%' OR
                        Texto like '%secretaria del trabajo estatal%' OR
                        Texto like '%ley laboral%' OR
                        Texto like '% SCT %' OR
                        Texto like '% SNTE %' OR
                        Texto like '% CNTE %' OR
                        Texto like '% CTM %' OR


                        Titulo like '%STPS%' OR
                        Titulo like '%STPyS%' OR
                        Titulo like '%secretaria del trabajo y prevision social%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%STPS%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%obrera%' OR
                        Titulo like '%confederaciones obreras%' OR
                        Titulo like '%manifestacion%' OR
                        Titulo like '%mexicana de avicion%' OR
                        Titulo like '%asociacion sindical%' OR
                        Titulo like '%asociacion mexicana%' OR
                        Titulo like '%instituto federal%' OR
                        Titulo like '%salarios minimos%' OR
                        Titulo like '%empleado%' OR
                        Titulo like '%secretaria del trabajo estatal%' OR
                        Titulo like '%ley laboral%' OR
                        Titulo like '% SCT %' OR
                        Titulo like '% SNTE %' OR
                        Titulo like '% CNTE %' OR
                        Titulo like '% CTM %'  OR

                        Encabezado like '%STPS%' OR
                        Encabezado like '%STPyS%' OR
                        Encabezado like '%secretaria del trabajo y prevision social%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%STPS%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%obrera%' OR
                        Encabezado like '%confederaciones obreras%' OR
                        Encabezado like '%manifestacion%' OR
                        Encabezado like '%mexicana de aviacion%' OR
                        Encabezado like '%asociacion sindical%' OR
                        Encabezado like '%asociacion mexicana%' OR
                        Encabezado like '%instituto federal%' OR
                        Encabezado like '%salarios minimos%' OR
                        Encabezado like '%empleado%' OR
                        Encabezado like '%secretaria del trabajo estatal%' OR
                        Encabezado like '%ley laboral%' OR
                        Encabezado like '% SCT %' OR
                        Encabezado like '% SNTE %' OR
                        Encabezado like '% CNTE %' OR
                        Encabezado like '% CTM %'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 0,30";
            return $query;  
            break; //Sondicatos 1      
        case 11:// STPS | CONFEDERACIONES OBRERAS Y SINDICATOS PARTE 2
              $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                        Texto like '%STPS%' OR
                        Texto like '%STPyS%' OR
                        Texto like '%secretaria del trabajo y prevision social%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%STPS%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%obrera%' OR
                        Texto like '%confederaciones obreras%' OR
                        Texto like '%manifestacion%' OR
                        Texto like '%mexicana de avicion%' OR
                        Texto like '%asociacion sindical%' OR
                        Texto like '%asociacion mexicana%' OR
                        Texto like '%instituto federal%' OR
                        Texto like '%salarios minimos%' OR
                        Texto like '%empleado%' OR
                        Texto like '%secretaria del trabajo estatal%' OR
                        Texto like '%ley laboral%' OR
                        Texto like '% SCT %' OR
                        Texto like '% SNTE %' OR
                        Texto like '% CNTE %' OR
                        Texto like '% CTM %' OR


                        Titulo like '%STPS%' OR
                        Titulo like '%STPyS%' OR
                        Titulo like '%secretaria del trabajo y prevision social%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%STPS%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%obrera%' OR
                        Titulo like '%confederaciones obreras%' OR
                        Titulo like '%manifestacion%' OR
                        Titulo like '%mexicana de avicion%' OR
                        Titulo like '%asociacion sindical%' OR
                        Titulo like '%asociacion mexicana%' OR
                        Titulo like '%instituto federal%' OR
                        Titulo like '%salarios minimos%' OR
                        Titulo like '%empleado%' OR
                        Titulo like '%secretaria del trabajo estatal%' OR
                        Titulo like '%ley laboral%' OR
                        Titulo like '% SCT %' OR
                        Titulo like '% SNTE %' OR
                        Titulo like '% CNTE %' OR
                        Titulo like '% CTM %'  OR

                        Encabezado like '%STPS%' OR
                        Encabezado like '%STPyS%' OR
                        Encabezado like '%secretaria del trabajo y prevision social%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%STPS%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%obrera%' OR
                        Encabezado like '%confederaciones obreras%' OR
                        Encabezado like '%manifestacion%' OR
                        Encabezado like '%mexicana de aviacion%' OR
                        Encabezado like '%asociacion sindical%' OR
                        Encabezado like '%asociacion mexicana%' OR
                        Encabezado like '%instituto federal%' OR
                        Encabezado like '%salarios minimos%' OR
                        Encabezado like '%empleado%' OR
                        Encabezado like '%secretaria del trabajo estatal%' OR
                        Encabezado like '%ley laboral%' OR
                        Encabezado like '% SCT %' OR
                        Encabezado like '% SNTE %' OR
                        Encabezado like '% CNTE %' OR
                        Encabezado like '% CTM %'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 30,30";
            return $query;  
            break;  //Sindicatos 2 
        case 12:// STPS | CONFEDERACIONES OBRERAS Y SINDICATOS PARTE 3
              $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                        Texto like '%STPS%' OR
                        Texto like '%STPyS%' OR
                        Texto like '%secretaria del trabajo y prevision social%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%STPS%' OR
                        Texto like '%sindicato%' OR
                        Texto like '%obrera%' OR
                        Texto like '%confederaciones obreras%' OR
                        Texto like '%manifestacion%' OR
                        Texto like '%mexicana de avicion%' OR
                        Texto like '%asociacion sindical%' OR
                        Texto like '%asociacion mexicana%' OR
                        Texto like '%instituto federal%' OR
                        Texto like '%salarios minimos%' OR
                        Texto like '%empleado%' OR
                        Texto like '%secretaria del trabajo estatal%' OR
                        Texto like '%ley laboral%' OR
                        Texto like '% SCT %' OR
                        Texto like '% SNTE %' OR
                        Texto like '% CNTE %' OR
                        Texto like '% CTM %' OR


                        Titulo like '%STPS%' OR
                        Titulo like '%STPyS%' OR
                        Titulo like '%secretaria del trabajo y prevision social%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%STPS%' OR
                        Titulo like '%sindicato%' OR
                        Titulo like '%obrera%' OR
                        Titulo like '%confederaciones obreras%' OR
                        Titulo like '%manifestacion%' OR
                        Titulo like '%mexicana de avicion%' OR
                        Titulo like '%asociacion sindical%' OR
                        Titulo like '%asociacion mexicana%' OR
                        Titulo like '%instituto federal%' OR
                        Titulo like '%salarios minimos%' OR
                        Titulo like '%empleado%' OR
                        Titulo like '%secretaria del trabajo estatal%' OR
                        Titulo like '%ley laboral%' OR
                        Titulo like '% SCT %' OR
                        Titulo like '% SNTE %' OR
                        Titulo like '% CNTE %' OR
                        Titulo like '% CTM %'  OR

                        Encabezado like '%STPS%' OR
                        Encabezado like '%STPyS%' OR
                        Encabezado like '%secretaria del trabajo y prevision social%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%STPS%' OR
                        Encabezado like '%sindicato%' OR
                        Encabezado like '%obrera%' OR
                        Encabezado like '%confederaciones obreras%' OR
                        Encabezado like '%manifestacion%' OR
                        Encabezado like '%mexicana de aviacion%' OR
                        Encabezado like '%asociacion sindical%' OR
                        Encabezado like '%asociacion mexicana%' OR
                        Encabezado like '%instituto federal%' OR
                        Encabezado like '%salarios minimos%' OR
                        Encabezado like '%empleado%' OR
                        Encabezado like '%secretaria del trabajo estatal%' OR
                        Encabezado like '%ley laboral%' OR
                        Encabezado like '% SCT %' OR
                        Encabezado like '% SNTE %' OR
                        Encabezado like '% CNTE %' OR
                        Encabezado like '% CTM %'
                    )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 60,30";
            return $query;  
            break;//Sindicatos 3
        case 13:// STPS | SECTOR LABORAL PARTE 1
              $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                    Texto like '%empleo%' OR
                    Texto like '%laboral%' OR
                    Titulo like '%laboral%' OR
                    Titulo like '%empleo%' OR
                    Texto like '%salarios minimos%' OR
                    Texto like '%empleado%' OR
                    Texto like '%secretaria del trabajo estatal%' OR
                    Texto like '%ley laboral%' OR
                    Texto like '%desempleo%' OR
                    Texto like '%OCDE%' OR
                    Texto like '%horas trabajadas%' OR
                    Texto like '%OCDE%' OR
                    Texto like '%improductivos%' OR
                    Texto like '%productividad%' OR
                    Texto like '%impc%' OR
                    Texto like '%economia informal%' OR
                    Texto like '%empleo informal%' OR
                    Texto like '%reforma financiera%' OR
                    Texto like '%trabajando.com%' OR
                    Texto like '%CTM%' OR
                    Texto like '%STPS%' OR
                    Texto like '%styps%' OR
                    Texto like '%obreros%' OR
                    Texto like '%isr%' OR
                    Texto like '%imef%' OR

                    Encabezado like '%empleo%' OR
                    Titulo like '%salarios minimos%' OR
                    Titulo like '%empleado%' OR
                    Titulo like '%secretaria del trabajo estatal%' OR
                    Titulo like '%ley laboral%' OR
                    Titulo like '%desempleo%' OR
                    Titulo like '%OCDE%' OR
                    Titulo like '%horas trabajadas%' OR
                    Titulo like '%OCDE%' OR
                    Titulo like '%improductivos%' OR
                    Titulo like '%productividad%' OR
                    Titulo like '%impc%' OR
                    Titulo like '%economia informal%' OR
                    Titulo like '%empleo informal%' OR
                    Titulo like '%reforma financiera%' OR
                    Titulo like '%trabajando.com%' OR
                    Titulo like '%CTM%' OR
                    Titulo like '%STPS%' OR
                    Titulo like '%styps%' OR
                    Titulo like '%obreros%' OR
                    Titulo like '%isr%' OR
                    Titulo like '%imef%' OR


                    Encabezado like '%salarios minimos%' OR
                    Encabezado like '%empleado%' OR
                    Encabezado like '%secretaria del trabajo estatal%' OR
                    Encabezado like '%ley laboral%' OR
                    Encabezado like '%desempleo%' OR
                    Encabezado like '%OCDE%' OR
                    Encabezado like '%horas trabajadas%' OR
                    Encabezado like '%OCDE%' OR
                    Encabezado like '%improductivos%' OR
                    Encabezado like '%productividad%' OR
                    Encabezado like '%impc%' OR
                    Encabezado like '%economia informal%' OR
                    Encabezado like '%empleo informal%' OR
                    Encabezado like '%reforma financiera%' OR
                    Encabezado like '%trabajando.com%' OR
                    Encabezado like '%CTM%' OR
                    Encabezado like '%STPS%' OR
                    Encabezado like '%styps%' OR
                    Encabezado like '%obreros%' OR
                    Encabezado like '%isr%' OR
                    Encabezado like '%imef%'
                    )

                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 0,30";
            return $query;  
            break; //Labboral        
        case 14:// STPS | SECTOR LABORAL PARTE 2
              $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                    Texto like '%empleo%' OR
                    Texto like '%laboral%' OR
                    Titulo like '%laboral%' OR
                    Titulo like '%empleo%' OR
                    Texto like '%salarios minimos%' OR
                    Texto like '%empleado%' OR
                    Texto like '%secretaria del trabajo estatal%' OR
                    Texto like '%ley laboral%' OR
                    Texto like '%desempleo%' OR
                    Texto like '%OCDE%' OR
                    Texto like '%horas trabajadas%' OR
                    Texto like '%OCDE%' OR
                    Texto like '%improductivos%' OR
                    Texto like '%productividad%' OR
                    Texto like '%impc%' OR
                    Texto like '%economia informal%' OR
                    Texto like '%empleo informal%' OR
                    Texto like '%reforma financiera%' OR
                    Texto like '%trabajando.com%' OR
                    Texto like '%CTM%' OR
                    Texto like '%STPS%' OR
                    Texto like '%styps%' OR
                    Texto like '%obreros%' OR
                    Texto like '%isr%' OR
                    Texto like '%imef%' OR

                    Encabezado like '%empleo%' OR
                    Titulo like '%salarios minimos%' OR
                    Titulo like '%empleado%' OR
                    Titulo like '%secretaria del trabajo estatal%' OR
                    Titulo like '%ley laboral%' OR
                    Titulo like '%desempleo%' OR
                    Titulo like '%OCDE%' OR
                    Titulo like '%horas trabajadas%' OR
                    Titulo like '%OCDE%' OR
                    Titulo like '%improductivos%' OR
                    Titulo like '%productividad%' OR
                    Titulo like '%impc%' OR
                    Titulo like '%economia informal%' OR
                    Titulo like '%empleo informal%' OR
                    Titulo like '%reforma financiera%' OR
                    Titulo like '%trabajando.com%' OR
                    Titulo like '%CTM%' OR
                    Titulo like '%STPS%' OR
                    Titulo like '%styps%' OR
                    Titulo like '%obreros%' OR
                    Titulo like '%isr%' OR
                    Titulo like '%imef%' OR


                    Encabezado like '%salarios minimos%' OR
                    Encabezado like '%empleado%' OR
                    Encabezado like '%secretaria del trabajo estatal%' OR
                    Encabezado like '%ley laboral%' OR
                    Encabezado like '%desempleo%' OR
                    Encabezado like '%OCDE%' OR
                    Encabezado like '%horas trabajadas%' OR
                    Encabezado like '%OCDE%' OR
                    Encabezado like '%improductivos%' OR
                    Encabezado like '%productividad%' OR
                    Encabezado like '%impc%' OR
                    Encabezado like '%economia informal%' OR
                    Encabezado like '%empleo informal%' OR
                    Encabezado like '%reforma financiera%' OR
                    Encabezado like '%trabajando.com%' OR
                    Encabezado like '%CTM%' OR
                    Encabezado like '%STPS%' OR
                    Encabezado like '%styps%' OR
                    Encabezado like '%obreros%' OR
                    Encabezado like '%isr%' OR
                    Encabezado like '%imef%'
                    )

                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion
                    Limit 30,30";
            return $query;  
            break;//Laboral 2
        case 15:// STPS | VARIOS
              $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    ( Texto like '%laboral%' OR
                        Texto like '%stps%' OR
                        Texto like '%sindicatos%' OR
                        Texto like '%gordillo%' OR
                        Texto like '%Romero Deschamps%' OR
                        Texto like '%sitatyr%' OR
                        Texto like '%ley federal del trabajo%' OR
                        Texto like '%ley del trabajo%' OR
                        Texto like '%inclusion laboral%' OR
                        Texto like '%observatorio laboral%' OR
                        Texto like '%SNTE%' OR
                        Texto like '%CNTE%' OR
                        Encabezado like '%trabajo%' )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion LIMIT 0,30";
            return $query;  
            break; //Varios 1
        case 16:// STPS | VARIOS 2
              $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.estado=e.idEstado AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    ( Texto like '%laboral%' OR
                        Texto like '%stps%' OR
                        Texto like '%sindicatos%' OR
                        Texto like '%gordillo%' OR
                        Texto like '%Romero Deschamps%' OR
                        Texto like '%sitatyr%' OR
                        Texto like '%ley federal del trabajo%' OR
                        Texto like '%ley del trabajo%' OR
                        Texto like '%inclusion laboral%' OR
                        Texto like '%observatorio laboral%' OR
                        Texto like '%SNTE%' OR
                        Texto like '%CNTE%' OR
                        Encabezado like '%trabajo%' )
                    GROUP BY n.Periodico,n.PaginaPeriodico
                    ORDER BY o.posicion LIMIT 0,30";
            return $query;  
            break;//Varios 3
        case 17://NAVARETE PRIDA
           $query="SELECT n.idEditorial,
             n.Periodico as 'idPeriodico',
            p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
            CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
            e.Nombre as 'Estado'
            FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
            WHERE p.idPeriodico=n.Periodico AND
            s.idSeccion=n.Seccion AND
            c.idCategoria=n.Categoria AND
            p.Estado!=9 AND   
            p.estado=e.idEstado AND
            n.Activo=1 AND
            fecha =DATE('$fecha') AND
            (
            Texto like '%Secretario Del Trabajo%' OR
                    Texto like '%Secretario De Trabajo%' OR
                    Texto like '%titular de la STPS%' OR
                    Texto like '%titular de la secretaria del trabajo y prevision social%' OR
                    Texto like '%Alfonso Navarrete Prida%' OR  
                    Texto like 'Alfonso Navarrete Prida' OR
                    Texto like '%Alfonso Navarrete%' OR    
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%varrete Prida%' OR
                    Texto like '%varretePrida%' OR
                    Texto like '%NavarretePrida%' OR
                    Texto like '%varrete P rid%' OR
                    Texto like '%varrete P rid a%' OR

                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Alfonso Navarrete%' OR
                    Titulo like 'Alfonso Navarrete Prida'  OR 
                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Navarrete Prida%' OR
                    Titulo like '%titular de la STPS%' OR
                    Titulo like '%varrete Prida%' OR
                    Titulo like '%varretePrida%' OR
                    Titulo like '%varrete P rid%' OR
                    Titulo like '%varrete P rid a%' OR

                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Alfonso Navarrete%' OR
                    Encabezado like 'Alfonso Navarrete Prida'  OR 
                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Secretario Del Trabajo%' OR
                    encabezado like '%Secretario Del Trabajo%' OR
                    Encabezado like '%Navarrete Prida%' OR
                    Encabezado like '%titular de la STPS%' OR
                    Encabezado like '%varrete Prida%' OR
                    Encabezado like '%varretePrida%' OR
                    Encabezado like '%varrete P rid%' OR
                    Encabezado like '%varrete P rid a%'
                   )AND (
                        ( (Texto like '%Alfonso%' AND Texto like '%Prida%') OR
                          (Texto like '%Secretario Del Trabajo%') OR
                          (Texto like '%Secretario De Trabajo%') OR
                          (Texto like '%Alfonso%' AND Texto like '%Navarrete%') OR 
                           Texto like '%titular de la STPS%') OR
                        ( (Titulo like '%Alfonso%' AND Titulo like '%Prida%') OR (Titulo like '%Alfonso%' AND Titulo like '%Navarrete%') OR Titulo like '%titular de la STPS%') OR
                        ( (Encabezado like '%Alfonso%' AND Encabezado like '%Prida%') OR (Encabezado like '%Alfonso%' AND Encabezado like '%Navarrete%') OR Encabezado like '%titular de la STPS%'))
GROUP BY p.Nombre,n.PaginaPeriodico
ORDER BY p.Estado,p.Nombre
LIMIT 0,20";
            return $query;      
        break;//Navarrete Estados
        case 18://NAVARETE PRIDA
           $query="SELECT n.idEditorial,
             n.Periodico as 'idPeriodico',
            p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
            CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
            e.Nombre as 'Estado'
            FROM $Tabla n, periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e
            WHERE p.idPeriodico=n.Periodico AND
            s.idSeccion=n.Seccion AND
            c.idCategoria=n.Categoria AND
            p.Estado!=9 AND   
            p.estado=e.idEstado AND
            n.Activo=1 AND
            fecha =DATE('$fecha') AND
            (
            Texto like '%Secretario Del Trabajo%' OR
                    Texto like '%Secretario De Trabajo%' OR
                    Texto like '%titular de la STPS%' OR
                    Texto like '%titular de la secretaria del trabajo y prevision social%' OR
                    Texto like '%Alfonso Navarrete Prida%' OR  
                    Texto like 'Alfonso Navarrete Prida' OR
                    Texto like '%Alfonso Navarrete%' OR    
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%Navarrete Prida%' OR
                    Texto like '%varrete Prida%' OR
                    Texto like '%varretePrida%' OR
                    Texto like '%NavarretePrida%' OR
                    Texto like '%varrete P rid%' OR
                    Texto like '%varrete P rid a%' OR

                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Alfonso Navarrete%' OR
                    Titulo like 'Alfonso Navarrete Prida'  OR 
                    Titulo like '%Alfonso Navarrete Prida%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Secretario Del Trabajo%' OR
                    Titulo like '%Navarrete Prida%' OR
                    Titulo like '%titular de la STPS%' OR
                    Titulo like '%varrete Prida%' OR
                    Titulo like '%varretePrida%' OR
                    Titulo like '%varrete P rid%' OR
                    Titulo like '%varrete P rid a%' OR

                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Alfonso Navarrete%' OR
                    Encabezado like 'Alfonso Navarrete Prida'  OR 
                    Encabezado like '%Alfonso Navarrete Prida%' OR
                    Encabezado like '%Secretario Del Trabajo%' OR
                    encabezado like '%Secretario Del Trabajo%' OR
                    Encabezado like '%Navarrete Prida%' OR
                    Encabezado like '%titular de la STPS%' OR
                    Encabezado like '%varrete Prida%' OR
                    Encabezado like '%varretePrida%' OR
                    Encabezado like '%varrete P rid%' OR
                    Encabezado like '%varrete P rid a%'
                   )AND (
                        ( (Texto like '%Alfonso%' AND Texto like '%Prida%') OR
                          (Texto like '%Secretario Del Trabajo%') OR
                          (Texto like '%Secretario De Trabajo%') OR
                          (Texto like '%Alfonso%' AND Texto like '%Navarrete%') OR 
                           Texto like '%titular de la STPS%') OR
                        ( (Titulo like '%Alfonso%' AND Titulo like '%Prida%') OR (Titulo like '%Alfonso%' AND Titulo like '%Navarrete%') OR Titulo like '%titular de la STPS%') OR
                        ( (Encabezado like '%Alfonso%' AND Encabezado like '%Prida%') OR (Encabezado like '%Alfonso%' AND Encabezado like '%Navarrete%') OR Encabezado like '%titular de la STPS%'))
GROUP BY p.Nombre,n.PaginaPeriodico
ORDER BY p.Estado,p.Nombre
LIMIT 20,20";
            return $query;      
        break;//Navarrete Estados 2
        default:
            break;
    }
}
?>
