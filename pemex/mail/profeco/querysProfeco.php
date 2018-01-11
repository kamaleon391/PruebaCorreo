<?php
function query($op,$Tabla, $estado){
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
            break;//
        case 5: /*********** PROFECO  ************/
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
                   p.Estado = {$estado} AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND
                   (
                        Texto like '%PROFECO%' OR
                        Texto like '%Procuraduria federal del consumidor%' OR

                        Titulo like '%PROFECO%' OR
                        Titulo like '%Procuraduria federal del consumidor%' OR

                        Encabezado like '%PROFECO%' OR
                        Encabezado like '%Procuraduria federal del consumidor%' OR

                        Autor like '%PROFECO%' OR
                        Autor like '%Procuraduria federal del consumidor%' OR

                        PieFoto like '%PROFECO%' OR
                        PieFoto like '%Procuraduria federal del consumidor%'
                   )
                    GROUP BY p.idPeriodico,n.PaginaPeriodico
                    ORDER BY o.posicion";
            return $query;
        break;//
        case 6: /*********** PRCURADOR ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                        Texto like '%procurador profepa%' OR
                        Texto like '%titular profepa%'  OR
                        Titulo like '%procurador profepa%'  OR
                        Titulo like '%titular profepa%'  OR
                        Encabezado like '%procurador profepa%'  OR
                        Encabezado like '%titular profepa%'  OR

                        Texto like '%Guillermo Javier Haro Belchez%' OR
                        Texto like '%Guillermo Haro Belchez%' OR
                        Texto like '%Guillermo Haro%' OR
                        Texto like '%Guillermo Belchez%' OR
                        Texto like '%Haro Belchez%' OR

                        Titulo like '%Guillermo Javier Haro Belchez%' OR
                        Titulo like '%Guillermo Haro Belchez%' OR
                        Titulo like '%Guillermo Haro%' OR
                        Titulo like '%Guillermo Belchez%' OR
                        Titulo like '%Haro Belchez%' OR

                        Encabezado like '%Guillermo Javier Haro Belchez%' OR
                        Encabezado like '%Guillermo Haro Belchez%' OR
                        Encabezado like '%Guillermo Haro%' OR
                        Encabezado like '%Guillermo Belchez%' OR
                        Encabezado like '%Haro Belchez%'
                    )
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break;
        case 7: /*********** Delegaciones ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                        Texto like'%delegacion Profepa%' OR
                        Texto like'%delegaciones Profepa%' OR
                        Texto like'%delegado Profepa%' OR
                        (Texto like'%delegacion%'  AND Texto like '%Profepa%')   OR

                        Titulo like'%delegacion Profepa%' OR
                        Titulo like'%delegaciones Profepa%' OR
                        Titulo like'%delegado Profepa%' OR
                        (Titulo like'%delegacion%' AND Titulo like '%Profepa%')   OR

                        Encabezado like'%delegacion Profepa%' OR
                        Encabezado like'%delegaciones Profepa%' OR
                        Encabezado like'%delegado Profepa%' OR
                        (Encabezado like'%delegacion%' AND Encabezado like '%Profepa%')
                    )
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break;
        case 8: /*********** SEMARNAT ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (
                        Texto like '%SEMARNAT%' OR
                        Texto like '%(semarnat)%' OR
                        Texto like '%secretaria de medio ambiente y recursos naturales%' OR
                        Texto like '%secretaria del medio ambiente%' OR
                        Texto like '%rafael pacchiano Alaman%' OR
                        Texto like '%rafael pacchiano%' OR
                        Texto like '%pacchiano Alaman%' OR

                        Titulo like '%SEMARNAT%'  OR
                        Titulo like '%(semarnat)%' OR
                        Titulo like '%secretaria de medio ambiente y recursos naturales%' OR
                        Titulo like '%secretaria del medio ambiente%' OR
                        Titulo like '%rafael pacchiano Alaman%' OR
                        Titulo like '%rafael pacchiano%' OR
                        Titulo like '%pacchiano Alaman%' OR

                        Encabezado like '%SEMARNAT%' OR
                        Encabezado like '%(semarnat)%' OR
                        Encabezado like '%secretaria de medio ambiente y recursos naturales%' OR
                        Encabezado like '%secretaria del medio ambiente%' OR
                        Encabezado like '%rafael pacchiano Alaman%' OR
                        Encabezado like '%rafael pacchiano%' OR
                        Encabezado like '%pacchiano Alaman%'
                    )
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break;
        case 9: /*********** VARIOS ************/
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    p.Estado=e.idEstado AND
                    p.Estado = {$estado} AND
                    n.Activo=1 AND
                    fecha =DATE('$fecha') AND
                    (

                    /************************ COMISION NACIONAL FORESTAL**************************/

                    Texto like'%Comision Nacional Forestal%' OR
                    Texto like'%conafor%' OR

                    Titulo  like'%Comision Nacional Forestal%' OR
                    Titulo like'%conafor%' OR

                    Texto like'%Comision Nacional Forestal%' OR
                    Texto like'%conafor%' OR

                    /************************ INSTITUTO DE ECOLOGIA**************************/

                    Texto like'%Instituto de Ecologia%' OR
                    Texto like'%cesar augusto dominguez perez tejada%' OR
                    Texto like'%cesar perez tejada%' OR
                    Texto like'%cesar augusto perez tejada%' OR
                    Texto like'%cesar dominguez perez tejada%' OR
                    Texto like'%perez tejada%' AND (texto like '%ecologia%') OR

                    Titulo  like'%Instituto de Ecologia%' OR
                    Titulo like'%cesar augusto dominguez perez tejada%' OR
                    Titulo like'%cesar perez tejada%' OR
                    Titulo like'%cesar augusto perez tejada%' OR
                    Titulo like'%cesar dominguez perez tejada%' OR
                    Titulo like'%perez tejada%' AND (texto like '%ecologia%') OR

                    Encabezado like'%Instituto de Ecologia%' OR
                    Encabezado like'%cesar augusto dominguez perez tejada%' OR
                    Encabezado like'%cesar perez tejada%' OR
                    Encabezado like'%cesar augusto perez tejada%' OR
                    Encabezado like'%cesar dominguez perez tejada%' OR
                    Encabezado like'%perez tejada%' AND (texto like '%ecologia%') OR

                    /************************ COMISION NACIONAL DE AREAS NATURALES PROTEGIDAS **/

                    Texto like'%Comision Nacional de Areas Naturales Protegidas%' OR
                    Texto like'%Comision Nacional de Areas Protegidas%' OR
                    Texto like'%Conanp%' OR

                    Titulo like'%Comision Nacional de Areas Naturales Protegidas%' OR
                    Titulo like'%Comision Nacional de Areas Protegidas%' OR
                    Titulo like'%Conanp%' OR

                    Encabezado like'%Comision Nacional de Areas Naturales Protegidas%' OR
                    Encabezado like'%Comision Nacional de Areas Protegidas%' OR
                    Encabezado like'%Conanp%' OR

                    /************************ SECRETARIA DEL MEDIO AMBIENTE (df) **************/

                    Texto like'%Secretaria del medio ambiente%'AND (texto like '$DF$' or texto like '%distrito federal%') OR
                    Texto like'%SMA%' AND (texto like '$DF$' or texto like '%distrito federal%') OR

                    Titulo like'%Secretaria del medio ambiente%'AND (texto like '$DF$' or texto like '%distrito federal%') OR
                    Titulo like'%SMA%' AND (texto like '$DF$' or texto like '%distrito federal%') OR

                    Encabezado like'%Secretaria del medio ambiente%'AND (texto like '$DF$' or texto like '%distrito federal%') OR
                    Encabezado like'%SMA%' AND (texto like '$DF$' or texto like '%distrito federal%') OR

                    /************************CONAGUA*******************************************/

                    Texto like'%conagua%' OR
                    Texto like'%Roberto Ramirez de la Parra%' OR
                    Texto like'%comision nacional del agua%' OR

                    Titulo like'%conagua%' OR
                    Titulo like'%Roberto Ramirez de la Parra%' OR
                    Titulo like'%comision nacional del agua%' OR

                    Encabezado like'%conagua%' OR
                    Encabezado like'%Roberto Ramirez de la Parra%' OR
                    Encabezado like'%comision nacional del agua%' OR

                    /******************************GREENPEACE***********************************/

                    Texto like'%greenpeace%' OR
                    Titulo like'%greenpeace%' OR
                    Encabezado like'%greenpeace%' OR

                    /********Comisión Nacional para el Conocimiento y uso de la Diversidad*******/

                    Texto like'%Comision Nacional para el Conocimiento y uso de la Biodiversidad%' OR
                    Texto like'%Conabio%' OR

                    Titulo like'%Comision Nacional para el Conocimiento y uso de la Biodiversidad%' OR
                    Titulo like'%Conabio%' OR

                    Encabezado like'%Comision Nacional para el Conocimiento y uso de la Biodiversidad%' OR
                    Encabezado like'%Conabio%' OR

                    /******************Centro de Derecho Ambiental Mexicano**********************/

                    Texto like'%Centro de Derecho Ambiental Mexicano%' OR
                    Texto like'%Cemda%' OR
                    Texto like'%Gustavo Alanis Ortega%' OR

                    Texto like'%Centro de Derecho Ambiental Mexicano%' OR
                    Texto like'%Cemda%' OR
                    Texto like'%Gustavo Alanis Ortega%' OR

                    Texto like'%Centro de Derecho Ambiental Mexicano%' OR
                    Texto like'%Cemda%' OR
                    Texto like'%Gustavo Alanis Ortega%' OR

                    /****************Programa de las Naciones Unidas para el Medio Ambiente*******/

                    Texto like'%Programa de las Naciones Unidas para el Medio Ambiente%' OR
                    Texto like'%Pnuma%' OR

                    Titulo like'%Programa de las Naciones Unidas para el Medio Ambiente%' OR
                    Titulo like'%Pnuma%' OR

                    Encabezado like'%Programa de las Naciones Unidas para el Medio Ambiente%' OR
                    Encabezado like'%Pnuma%' OR

                    /***Procuraduría Ambiental y de Ordenamiento Territorial del Distrito Federal*****/

                    Texto like'%Procuraduria Ambiental y de Ordenamiento Territorial del Distrito Federal%' OR
                    Texto like'%Procuraduria Ambiental y de Ordenamiento Territorial del DF%' OR
                    Texto like'%Procuraduria Ambiental y de Ordenamiento Territorial del D.F%' OR
                    Texto like'%Procuraduria Ambiental y de Ordenamiento Territorial%' OR
                    Texto like'%Paot%' OR
                    Texto like'%Miguel Angel Cancino Aguilar%' OR
                    Texto like'%Cancino Aguilar%' OR
                    Texto like'%Miguel Cancino Aguilar%' OR
                    Texto like'%Angel Cancino Aguilar%' OR

                    titulo like'%Procuraduria Ambiental y de Ordenamiento Territorial del Distrito Federal%' OR
                    titulo like'%Procuraduria Ambiental y de Ordenamiento Territorial del DF%' OR
                    titulo like'%Procuraduria Ambiental y de Ordenamiento Territorial del D.F%' OR
                    titulo like'%Procuraduria Ambiental y de Ordenamiento Territorial%' OR
                    titulo like'%Paot%' OR
                    titulo like'%Miguel Angel Cancino Aguilar%' OR
                    titulo like'%Cancino Aguilar%' OR
                    titulo like'%Miguel Cancino Aguilar%' OR
                    titulo like'%Angel Cancino Aguilar%' OR

                    Encabezado like'%Procuraduria Ambiental y de Ordenamiento Territorial del Distrito Federal%' OR
                    Encabezado like'%Procuraduria Ambiental y de Ordenamiento Territorial del DF%' OR
                    Encabezado like'%Procuraduria Ambiental y de Ordenamiento Territorial del D.F%' OR
                    Encabezado like'%Procuraduria Ambiental y de Ordenamiento Territorial%' OR
                    Encabezado like'%Paot%' OR
                    Encabezado like'%Miguel Angel Cancino Aguilar%' OR
                    Encabezado like'%Cancino Aguilar%' OR
                    Encabezado like'%Miguel Cancino Aguilar%' OR
                    Encabezado like'%Angel Cancino Aguilar%' OR

                    /************************ Programa de las Naciones Unidas para el Medio Ambiente **************************/

                    Texto like'%Programa de las Naciones Unidas para el Medio Ambiente%' OR
                    Texto like'%PNUMA%' OR

                    Titulo like'%Programa de las Naciones Unidas para el Medio Ambiente%' OR
                    Titulo like'%PNUMA%' OR

                    Encabezado like'%Programa de las Naciones Unidas para el Medio Ambiente%' OR
                    Encabezado like'%PNUMA%' OR

                    /************************ Centro de Información y Comunicación Ambiental de Norte América**************************/

                    Texto like'%centro de informacion y comunicacion ambiental de norte america%' OR
                    Texto like'%CICEANA%' OR

                    Titulo like'%centro de informacion y comunicacion ambiental de norte america%' OR
                    Titulo like'%CICEANA%' OR

                    Encabezado like'%centro de informacion y comunicacion ambiental de norte america%' OR
                    Encabezado like'%CICEANA%' OR

                    /************************ CIRCOS Y ANIMALES		******************** **/

                    Texto like'%Circo%' OR
                    Texto like'%Animales de Circo%' OR

                    Titulo like'%Circo%' OR
                    Titulo like'%Animales de Circo%' OR

                    Encabezado like'%Circo%' OR
                    Encabezado like'%Animales de Circo%' OR

                    /***********************SECTOR ********************************************/

                    Texto like'%subprocuraduria de recursos naturales%' OR
                    Texto like'%subprocuraduria juridica%' OR
                    Texto like'%inspeccion industrial%' OR
                    Texto like'%auditoria industrial%' OR
                    Texto like '%Zofemat%' OR
                    Texto like '%inspeccion y vigilancia forestal%' OR
                    Texto like '%vigilancia forestal%' OR
                    Texto like '%vida silvestre%' OR
                    Texto like '%recursos marinos%' OR
                    Texto like '%ecosistemas costeros%' OR
                    Texto like '%Impacto Ambiental%' OR
                    Texto like '%areas naturales protegidas%' OR
                    Texto like '%profepa%' OR
                    Texto like '%inspeccion ambiental%' OR
                    Texto like '%ambiental%' OR
                    Texto like '%equilibrio ecologico%' OR
                    Texto like '%contaminantes%' OR
                    Texto like '%residuos peligrosos%' OR
                    Texto like '%programa nacional de auditorial ambiental%' OR
                    Texto like '%pnaa%' OR
                    Texto like 'ong' OR
                    Texto like '%organisaciones no gubernamentales%' OR

                    Titulo like'%subprocuraduria de recursos naturales%' OR
                    Titulo like'%subprocuraduria juridica%' OR
                    Titulo like'%inspeccion industrial%' OR
                    Titulo like'%auditoria industrial%' OR
                    Titulo like '%Zofemat%' OR
                    Titulo like '%inspeccion y vigilancia forestal%' OR
                    Titulo like '%vigilancia forestal%' OR
                    Titulo like '%vida silvestre%' OR
                    Titulo like '%recursos marinos%' OR
                    Titulo like '%ecosistemas costeros%' OR
                    Titulo like '%Impacto Ambiental%' OR
                    Titulo like '%areas naturales protegidas%' OR
                    Titulo like '%profepa%' OR
                    Titulo like ' ong ' OR
                    Titulo like '%organisaciones no gubernamentales%' OR

                    Encabezado like'%subprocuraduria de recursos naturales%' OR
                    Encabezado like'%subprocuraduria juridica%' OR
                    Encabezado like'%inspeccion industrial%' OR
                    Encabezado like'%auditoria industrial%' OR
                    Encabezado like '%Zofemat%' OR
                    Encabezado like '%inspeccion y vigilancia forestal%' OR
                    Encabezado like '%vigilancia forestal%' OR
                    Encabezado like '%vida silvestre%' OR
                    Encabezado like '%recursos marinos%' OR
                    Encabezado like '%ecosistemas costeros%' OR
                    Encabezado like '%Impacto Ambiental%' OR
                    Encabezado like '%profepa%' OR
                    Encabezado like '%areas naturales protegidas%' OR
                    Encabezado like ' ong ' OR
                    Encabezado like '%organisaciones no gubernamentales%' OR


                    Texto like '%tala de arboles%' OR
                    Texto like '%ambientalistas%' OR
                    Texto like '%contaminacion%' OR
                    Texto like ' ONG ' OR
                    Texto like '%extincion%' OR
                    Texto like '%especies%' OR
                    Texto like '%cambio climatico%' OR
                    Texto like '%medio ambiente%' OR
                    Texto like '%legislacion ambiental%' OR
                    Texto like '%vaquita marina%' OR
                    Texto like '%vaca marina%' OR
                    Texto like '%areas protegidas%' OR
                    Texto like '%partido verde ecologista%' OR
                    Texto like '%pvem%' OR
                    Texto like '%conservacion%' OR
                    Texto like '%recoleccion%' OR
                    Texto like '%basura%' OR
                    Texto like '%cucapas%' OR
                    Texto like '%pepino marino%' OR
                    Texto like '%circo%' OR
                    Texto like '%zoologico%' OR
                    Texto like '%maltrato animal%' OR
                    Texto like '%biodiversidad%' OR
                    Texto like '%transgenico%' OR
                    Texto like '%sustacias quimicas%' OR
                    Texto like '%sustancias peligrosas%' OR
                    Texto like '%mineria%' OR
                    Texto like '%minera%' OR
                    Texto like '%material quimico%' OR
                    Texto like '%explosion%' OR
                    Texto like '%explotacion%' OR
                    Texto like '%bosques%' OR
                    Texto like '%trafico ilegal%' OR
                    Texto like '%fauna flora%' OR
                    Texto like '%recoleccion de basura%'

                    )
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY p.Estado, n.Periodico";
            return $query;
        break;
        default:
            break;
    }
}
?>
