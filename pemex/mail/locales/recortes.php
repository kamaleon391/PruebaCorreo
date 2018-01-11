    <?php

    include "/var/www/external/services/mail/conexion.php";
    
    Consulta($_GET['opc'], $_GET['f']);
    
function principal($op,$f){
    $fecha=$f;
       $FechaCliente = strtotime($fecha);
        
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
    
    $query="";
    switch ($op)
    {
        case 1:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'Periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
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
                    Encabezado like '%varrete P rid a%' OR
                    
                    PieFoto like '%Alfonso Navarrete Prida%' OR
                    PieFoto like '%Alfonso Navarrete%' OR
                    PieFoto like 'Alfonso Navarrete Prida'  OR 
                    PieFoto like '%Alfonso Navarrete Prida%' OR
                    PieFoto like '%Secretario Del Trabajo%' OR
                    PieFoto like '%Secretario Del Trabajo%' OR
                    PieFoto like '%Navarrete Prida%' OR
                    PieFoto like '%titular de la STPS%' OR
                    PieFoto like '%varrete Prida%' OR
                    PieFoto like '%varretePrida%' OR
                    PieFoto like '%varrete P rid%' OR
                    PieFoto like '%varrete P rid a%'
                   )AND (
                        ( (Texto like '%Alfonso%' AND Texto like '%Prida%') OR
                          (Texto like '%Secretario Del Trabajo%') OR
                          (Texto like '%Secretario De Trabajo%') OR
                          (Texto like '%Alfonso%' AND Texto like '%Navarrete%') OR 
                           Texto like '%titular de la STPS%') OR
                        ( (Titulo like '%Alfonso%' AND Titulo like '%Prida%') OR (Titulo like '%Alfonso%' AND Titulo like '%Navarrete%') OR Titulo like '%titular de la STPS%') OR
                        ( (Encabezado like '%Alfonso%' AND Encabezado like '%Prida%') OR (Encabezado like '%Alfonso%' AND Encabezado like '%Navarrete%') OR Encabezado like '%titular de la STPS%'))


        GROUP BY n.idEditorial
        ORDER BY o.posicion";
        break; /*NAVARRETE*/
        case 2:
            $query="SELECT n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'Periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
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
                    ORDER BY o.posicion";
        break;/*STPS*/
    
        case 3:
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,n.PaginaPeriodico,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg'
                        FROM ".$Tabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                          WHERE(
            Texto like '%secretario De gobernacion%' OR
            Texto like '%titular de la SEGOB%' OR
            Texto like '%titular de la secretaria de gobernacion%' OR
            Texto like '%miguel angel osorio chong%' OR  
            Texto like 'miguel angel osorio chong' OR
            Texto like 'miguel osorio' OR
            Texto like '%Miguel Angel osorio%' OR    
            Texto like '%Osorio Chong%' OR
            Texto like '%Osorio Chong%' OR
            Texto like '%sorio Chong%' OR
            Texto like '%OsorioChong%' OR
            Texto like '%sorio C hong%' OR
            Texto like '%sorio C h on g%' OR
            Texto like '%secretario Chong%' OR
            Texto like '%gobernachong%' OR
            Texto like '% chong %' OR
            Texto like '%chong %' OR

            Titulo like '%secretario De gobernacion%' OR
            Titulo like '%titular de la SEGOB%' OR
            Titulo like '%titular de la secretaria de gobernacion%' OR
            Titulo like '%miguel angel osorio chong%' OR  
            Titulo like 'miguel angel osorio chong' OR
            Titulo like 'miguel osorio' OR
            Titulo like '%Miguel Angel osorio%' OR    
            Titulo like '%Osorio Chong%' OR
            Titulo like '%Osorio Chong%' OR
            Titulo like '%sorio Chong%' OR
            Titulo like '%OsorioChong%' OR
            Titulo like '%sorio C hong%' OR
            Titulo like '%sorio C h on g%' OR
            Titulo like '%secretario Chong%' OR
            Titulo like '%gobernachong%' OR
            Titulo like '%chong %' OR

            Encabezado like '%secretario De gobernacion%' OR
            Encabezado like '%titular de la SEGOB%' OR
            Encabezado like '%titular de la secretaria de gobernacion%' OR
            Encabezado like '%miguel angel osorio chong%' OR  
            Encabezado like 'miguel angel osorio chong' OR
            Encabezado like 'miguel osorio' OR
            Encabezado like '%Miguel Angel osorio%' OR    
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%Osorio Chong%' OR
            Encabezado like '%sorio Chong%' OR
            Encabezado like '%OsorioChong%' OR
            Encabezado like '%sorio C hong%' OR
            Encabezado like '%sorio C h on g%' OR
            Encabezado like '%secretario Chong%' OR
            Encabezado like '%gobernachong%' OR
            Encabezado like '%chong %'
           ) AND
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' 
                AND p.Estado=9 AND p.tipo=1 AND n.Activo=1
                GROUP BY n.idEditorial
                ORDER BY n.Periodico limit 0,50";
        break;/*CHONG*/
        case 4:
            $query="SELECT DISTINCT(n.idEditorial),n.Periodico AS 'idPeriodico', p.Nombre AS 'Periodico', n.Fecha, n.Titulo,n.Seccion AS 'idSeccion', s.seccion AS 'Seccion', n.NumeroPagina, n.Texto,n.PaginaPeriodico,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg'
                        FROM ".$Tabla." n, ordenGeneral o, periodicos p, seccionesPeriodicos s 
                            WHERE
                (
                Texto like '%SEGOB%' OR
                Texto like '% secretaria de gobernacion%' OR
                Texto like '%SEGOB%' OR
                Texto like '%gobernacion%' OR
                Texto like '% secretaria de gobernacion estatal%' OR
                Texto like '% secretaria de gobernacion%' OR
                Texto like '% secretaria de gobernacion%' OR

                Titulo like '%SEGOB%' OR
                Titulo like '% secretaria de gobernacion%' OR
                Titulo like '%SEGOB%' OR
                Titulo like '% secretaria de gobernacion estatal%' OR
                Titulo like '% secretaria de gobernacion%' OR
                Titulo like '% secretaria de gobernacion%' OR

        
                Encabezado like '%SEGOB%' OR
                Encabezado like '% secretaria de gobernacion%' OR
                Encabezado like '%SEGOB%' OR
                Encabezado like '% secretaria de gobernacion estatal%' OR
                Encabezado like '% secretaria de gobernacion%' OR
                Encabezado like '% secretaria de gobernacion%'
               )
                AND
                 Texto not like '%ex Secretario%' AND
                 Texto not like '%ex funcionario%' AND
                n.Periodico=o.periodico AND n.Periodico=p.idPeriodico AND 
                p.Estado=9 AND s.idSeccion = n.Seccion AND n.Fecha='".$fecha."' AND p.tipo=1
                GROUP BY n.idEditorial
                ORDER BY n.Periodico";
        break;/*SEGOB*/
    
        case 5:
            $query="(SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'Periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
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
                        )
                        )
                        ";
        break;/*EGIDIO*/
        case 6:
            $query="(SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'Periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
                    e.Nombre as 'Estado'
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
                    ORDER BY o.posicion
                    )
                    UNION (
                    SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'Periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
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
                    )
                    ";
        break;/*TAMAULIPAS*/
    
        case 7:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'Periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                        Texto like'%Gerardo Ruiz Esparza%' OR
                        Texto like '%Ruiz Esparza Gerardo%' OR
                        Texto like '%Ruiz Esparza%' OR

                        Titulo like'%Gerardo Ruiz Esparza%' OR
                        Titulo like '%Ruiz Esparza Gerardo%' OR
                        Titulo like '%Ruiz Esparza%' OR

                        Encabezado like'%Gerardo Ruiz Esparza%' OR
                        Encabezado like '%Ruiz Esparza Gerardo%' OR
                        Encabezado like '%Ruiz Esparza%' OR

                                PieFoto like'%Gerardo Ruiz Esparza%' OR
                        PieFoto like '%Ruiz Esparza Gerardo%' OR
                        PieFoto like '%Ruiz Esparza%'

                     )
        GROUP BY n.idEditorial
        ORDER BY o.posicion";
        break;/*RUIZ ESPARZA*/
        case 8:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'Periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                        Texto  like '%Secretaria de Comunicaciones y Transportes%' OR
                        Texto  like '%SCT%' OR

                        Titulo  like '%Secretaria de Comunicaciones y Transportes%' OR
                        Titulo  like '%SCT%' OR

                        Encabezado  like '%Secretaria de Comunicaciones y Transportes%' OR
                        Encabezado  like '%SCT%' OR

                        PieFoto  like '%Secretaria de Comunicaciones y Transportes%' OR
                        PieFoto  like '%SCT%'
                     )
                    GROUP BY n.idEditorial
                    ORDER BY o.posicion";
        break;/*SCT*/
        case 9:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'Periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND (        
                        Texto like '%Hector Pablo Haro Ramirez Puga Leyva%' OR
                        Texto like '%Hector Haro Ramirez Puga%' OR
                        Texto like '%Hector Haro Ramirez%' OR
                        Texto like '%Director de la Liconsa%' OR
                        
                        Titulo like '%Hector Pablo Haro Ramirez Puga Leyva%' OR
                        Titulo like '%Hector Haro Ramirez Puga%' OR
                        Titulo like '%Hector Haro Ramirez%' OR
                        Titulo like '%Director de la Liconsa%' OR
                        
                        Encabezado like '%Hector Pablo Haro Ramirez Puga Leyva%' OR
                        Encabezado like '%Hector Haro Ramirez Puga%' OR
                        Encabezado like '%Hector Haro Ramirez%' OR
                        Encabezado like '%Director de la Liconsa%' OR
                        
                        PieFoto like '%Hector Pablo Haro Ramirez Puga Leyva%' OR
                        PieFoto like '%Hector Haro Ramirez Puga%' OR
                        PieFoto like '%Hector Haro Ramirez%' OR
                        PieFoto like '%Director de la Liconsa%'
                   )
                   GROUP BY n.idEditorial
            ORDER BY o.posicion";
        break;/*HECTOR HARO*/
        case 10:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'Periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND(
                        Texto like '%liconsa%' OR
                        Titulo like '%liconsa%' OR
                        Encabezado like '%liconsa%' OR
                        PieFoto like '%Liconsa%'
                   )
                   GROUP BY n.idEditorial
                   ORDER BY o.posicion";
        break;/*LICONSA*/
        case 11:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'Periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND (
		Texto like '%rosario robles berlanga%' OR
		Texto like '%rosario robles%' OR
		Texto like '%robles berlanga%' OR

		Titulo like '%rosario robles berlanga%' OR
		Titulo like '%rosario robles%' OR
		Titulo like '%robles berlanga%' OR

		Encabezado like '%rosario robles berlanga%' OR
		Encabezado like '%rosario robles%' OR
		Encabezado like '%robles berlanga%' OR

		PieFoto like '%rosario robles berlanga%' OR
		PieFoto like '%rosario robles%' OR
		PieFoto like '%robles berlanga%'
        )
                   GROUP BY n.idEditorial
            ORDER BY o.posicion";
        break;/*ROSARIO ROBLES*/
        case 12:
            $query="SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'Periodico',
                   n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   fecha =DATE('$fecha') AND (
                            Texto like '%sedesol%' OR
                            Texto like '%secretaria de desarrollo social%' OR
                            
                            Titulo like '%sedesol%' OR
                            Titulo like '%secretaria de desarrollo social%' OR

                            Encabezado like '%sedesol%' OR
                            Encabezado like '%secretaria de desarrollo social%' OR

                            PieFoto like '%sedesol%' OR
                            PieFoto like '%secretaria de desarrollo social%'
                    )
                   GROUP BY n.idEditorial
            ORDER BY o.posicion";
        break;/*SEDESOL*/
    }
    
    return $query;
}
function cliente($opc)
{
    $cliente="";
    switch ($opc)
    {
        case 1:
            $cliente="stps.png";
        break;    
        case 2:
            $cliente="stps.png";
        break;    
        case 3:
            $cliente="segob.jpg";
        break;    
        case 4:
            $cliente="segob.jpg";
        break;    
        case 5:
            $cliente="tamaulipas.png";
        break;    
        case 6:
            $cliente="tamaulipas.png";
        break;    
        case 7:
            $cliente='sct.png';
        break;    
        case 8:
            $cliente='sct.png';
        break;    
        case 9:
            $cliente='liconsa.png';
        break;    
        case 10:
            $cliente='liconsa.png';
        break;    
        case 11:
            $cliente="";
        break;    
        case 12:
            $cliente="";
        break;    
    }
    
    return $cliente;;
}
function titulo($opc)
{
    $cliente="";
    switch ($opc)
    {
        case 1:
            $cliente="Alfonso Navarrete Prida";
        break;    
        case 2:
            $cliente="STPS";
        break;    
        case 3:
            $cliente=  utf8_decode('Miguel Ángel Osorio Chong');
        break;    
        case 4:
            $cliente=  utf8_decode('Secretaría de Gobernación');
        break;    
        case 5:
            $cliente=  utf8_decode('Egidio Torre Cantu');
        break;    
        case 6:
            $cliente="Tamaulipas";
        break;    
        case 7:
            $cliente='Gerardo Ruiz Esparza';
        break;    
        case 8:
            $cliente='Secretaría de Comunicaciones y Transportes';
        break;    
        case 9:
            $cliente=  utf8_decode("Hector Pablo Haro Ramírez Puga Leyva");
        break;    
        case 10:
            $cliente='LICONSA';
        break;    
        case 11:
            $cliente="";
        break;    
        case 12:
            $cliente="";
        break;    
    }
    
    return $cliente;;
}

function Consulta($opc,$fecha)
{
    require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
    require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

    $pdf = new FPDI('P','mm','legal');
    $cliente=  cliente($opc);
    $titulo=  titulo($opc);
    
        $consu = principal($opc,$fecha);
        
    $portada = '/var/www/external/testigos/Jalisco/'.mes($fecha).'/portada/portada.pdf';
    //$sintesis = '/var/www/external/services/clientesPDF/jalisco/Gobernador.pdf';
    
    $pdfs = array();
        
$pdf->addPage();
                    //Recuadro Gris Inferior
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 131, 250, 40, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 25);
        $pdf->Text(10,156,$titulo."".$subtema);
        $pdf->SetFont("arial", "B", 13);
        $pdf->setTextColor(255,255,255);
          //$pdf->Text(10,23,"test");

        $pdf->Image($cliente,5,100,100); 
        $pdf->SetFont("arial", "B",15);
        $pdf->setTextColor();
        $pdf->Text(130,177,mostrar_fecha_completa(date('Y-m-d')));
    $i=1;
    $query1 =  mysql_query($consu);
    while ($row = mysql_fetch_array($query1)) 
    {
        
        $id=$row['idEditorial'];
        $pagina[$i]=$row['PaginaPeriodico'];
        $variable[$i] = $row['pdf'];
        $periodico[$i] = $row['Periodico'];
        $secciones[$i] = $row['Seccion'];
        $titulos[$i]= $row['Titulo'];
        $textos[$i]= $row['Texto'];
        $thumb[$i]=$row['jpg'];
        $pdf->addPage();
        $pdf->Ln();
        $pdf->SetFont("arial", "B", 11);
        
        $pdf->setTextColor(0);
        if(file_exists('/var/www/Imagenes/periodicos/portadas/'.ucwords($periodico[$i]).".png")){
            $pdf->Image('/var/www/Imagenes/periodicos/portadas/'.ucwords($periodico[$i]).".png",70,10,60); 
        }else{
            $pdf->Text(60, 10, $periodico[$i]);
        }
        
        $pdf->Ln(2);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(200, 5,"Fecha : ". utf8_decode(mostrar_fecha_completa($fecha))." |     Seccion : ".$secciones[$i]."     |      Pagina : ".$pagina[$i],1, 1, 'L', true);
        //$pdf->Cell(200, 5,"Periodico : ".$periodico[0],0, 1, 'L', true);
        $pdf->SetFillColor(255);
        
        if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg")){
            
            $pathImg='/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg";
            $tam=  getimagesize($pathImg);
            $ancho=$tam[0];
            $alto=$tam[1];
            
            if($ancho>$alto){
                $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg",25,65,170,100);      
            }else if($ancho<$alto){
                $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg",50,45,110,300);
            }
            else{
                $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg",6,45,$ancho,$alto);      
            }
        }else{
            $pdf->Text(5, 65, "Error: ".$id." ".$periodico." ".$titulos[$i]);
        }
        if(file_exists($thumb[$i]))
        {
            $pdf->Image($thumb[$i],170,270,30);
        }else{
            $pdf->Text(5, 65, "Error: ".$thumb[$i]);
        }    
        //$pdf->Image('jalisco/Logo.jpg',5,330,45);
        //$pdf->Image('jalisco/Logo.jpg',150,330,50);
        
        $i++;
    }
    
    try {
     $pdf->Output("JALISCO.pdf", 'I');     
    } catch (Exception $ex) {
       echo $ex->getMessage(); 
    } 
}


function portada($fecha)
{
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  $pdf = new FPDI('P','mm','legal');

  $pdf->addPage();
  $pdf->SetFillColor(245,245,245);
  $pdf->Rect(0, 131, 250, 40, 'F');

  $pdf->setTextColor();
  $pdf->SetFont("arial", "B", 30);
  $pdf->Text(10,156,strtoupper('JALISCO'));
  $pdf->SetFont("arial", "B", 13);
  $pdf->setTextColor(255,255,255);
  $pdf->Text(10,23,"test");

  $pdf->Image('/var/www/external/services/mail/jalisco/Logo.jpg',5,90,100); 
  $pdf->SetFont("arial", "B",15);
  $pdf->setTextColor();
  $pdf->Text(110,177,mostrar_fecha_completa($fecha));   
         
 
   $antigua = umask(0);

    if( ! is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada/")){
    
      mkdir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada",true,0777);
      chmod("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada",0777);
      umask($antigua);
    }

    $nombre = "/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada/portada.pdf";

    if(is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada"))
    {
        $pdf->Output($nombre, 'F');

    }else{
        
        echo "Error echo echo echo  Escritura<br>".__DIR__;
    }    

}

function mes($fecha){
  list($a,$m,$d) = explode("-", $fecha);
  return $m;
}

function mostrar_fecha_completa($fecha){
    $subfecha = explode("-",$fecha); 
   
    $año=$subfecha[0];
    $mes=$subfecha[1];
    $dia=$subfecha[2];

    $dia2=date( "d", mktime(0,0,0,$mes,$dia,$año));
    $mes2=date( "m", mktime(0,0,0,$mes,$dia,$año));
    $año2=date( "Y", mktime(0,0,0,$mes,$dia,$año));
    $dia_sem=date( "w", mktime(0,0,0,$mes,$dia,$año));

   switch($dia_sem)
   { 
       case "0":   // Bloque 1 
         $dia_sem3='Domingo'; 
       break; 
       
       case "1":   // Bloque 1 
         $dia_sem3='Lunes'; 
       break; 
       
       case "2":   // Bloque 1 
         $dia_sem3='Martes'; 
       break; 
   
       case "3":   // Bloque 1 
         $dia_sem3='Miercoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='Sabado'; 
       break; 
   
      default:   // Bloque 3 
    };
   
    switch($mes2) 
    { 
        case "1":   // Bloque 1 
            $mes3='Enero'; 
        break; 
    
        case "2":   // Bloque 1 
            $mes3='Febrero';
        break; 
    
        case "3":   // Bloque 1 
            $mes3='Marzo';
        break; 
    
        case "4":   // Bloque 1 
            $mes3='Abril'; 
        break;  
        
        case "5":   // Bloque 1 
            $mes3='Mayo';
        break;   
        
        case "6":   // Bloque 1 
            $mes3='Junio';    
        break; 
        
        case "7":   // Bloque 1 
            $mes3='Julio';
        break; 
    
        case "8":   // Bloque 1 
            $mes3='Agosto';
        break; 
    
        case "9":   // Bloque 1 
            $mes3='Septiembre';
        break; 
    
        case "10":   // Bloque 1 
            $mes3='Octubre';
        break; 
    
        case "11":   // Bloque 1 
            $mes3='Noviembre';
        break;           
    
        case "12":   // Bloque 1 
            $mes3='Diciembre';  
        break; 
    
        default:   // Bloque 3 
     break; 
  }; 
 
   
$fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;

return $fecha_texto;
}
