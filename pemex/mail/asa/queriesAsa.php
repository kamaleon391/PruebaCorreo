<?php

function numberNotes($optionCase, $fecha) {

    $query = query( $optionCase, $fecha );
    $resultado = mysql_query( $query );
    if(mysql_num_rows( $resultado ) > 0) {
        return mysql_num_rows( $resultado ) ;
    }
    return false;
}

function queryResultadosSegmentados( $iteracion, $query ) {
  
  if( isset( $iteracion ) && $iteracion >= 1 ) {
    $cota_superior = 50 * $iteracion;
    $cota_inferior = ( ( $iteracion - 1 ) * 50 ) + ( $iteracion == 1 ? 0 : 1 ) ;
    return $query.' LIMIT '.$cota_inferior.', '.$cota_superior;
  } 
  return $query;
}

function query( $op, $fecha, $iteracion = null ) {
  $FechaCliente   = strtotime( $fecha );
  $fecha_actual1  = date('Y-m-d');
  $fecha_actual   = strtotime($fecha_actual1);
        
  if ($FechaCliente == $fecha_actual) {
    $Tabla="noticiasDia";
  } else {
    $Tabla="noticiasSemana";
  }

  $select_df = "SELECT n.idEditorial,
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
                   fecha =DATE('$fecha') AND ";

  switch ( $op ) {
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
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.idEditorial";
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
                    GROUP BY n.idEditorial
                    ORDER BY o.posicion
                    ";
            return $query;  
            break;// Cartones DF

        case 5:// PRESIDENCIA DF
            $query= $select_df. "(
        Texto like '%Enrique pena nieto%' OR
        Texto like '%presidente peña%' OR
        Texto like '%peña nieto%' OR
        Texto like '%pena nieto%' OR
        Texto like 'Enrique pena nieto' OR
        Texto like '%epn%' OR
        Texto like '%@EPN%' OR
        Texto like '%presidente constitucional de los estados unidos mexicanos%' OR
        Texto like '%Senor Licenciado Enrique Pena Nieto%' OR
        Texto like '%de Pena Nieto%' OR
        Texto like '% Enrique Pena %' OR
        Texto like '% quique Pena %' OR

        Titulo like '%Enrique pena nieto%' OR
        Titulo like '%presidente peña%' OR
        Titulo like '%peña nieto%' OR
        Titulo like '%pena nieto%' OR
        Titulo like 'Enrique pena nieto'  OR
        Titulo like '%presidente constitucional de los estados unidos mexicanos%' OR
        Titulo like '%Senor Licenciado enrique pena nieto%' OR
        Titulo like '%epn%' OR
        Titulo like '%@EPN%' OR

        Encabezado like '%Enrique pena nieto%' OR
        Encabezado like '%presidente peña%' OR
        Encabezado like '%peña nieto%' OR
        Encabezado like '%pena nieto%' OR
        Encabezado like 'Enrique pena nieto' OR
        Encabezado like '%epn%' OR
        Encabezado like '%presidente constitucional de los estados unidos mexicanos%' OR
        Encabezado like '%Senor Licenciado enrique pena nieto%' OR
        Encabezado like '%epn%' OR
        Encabezado like '%@EPN%' OR
        Encabezado like '% quique Pena %'
) AND (
  Texto not like '%expresidente%' OR
  Titulo not like '%expresidente%' OR
  Encabezado not like '%expresidente%' OR
  PieFoto not like '%expresidente%' OR
  Autor not like '%expresidente%'
) GROUP BY p.idPeriodico,n.PaginaPeriodico ORDER BY o.posicion ";

            return queryResultadosSegmentados( $iteracion, $query ) ;      
        break;//


  case 6:// INFORMACION INSTITUCIONAL
    $query = $select_df. "(
        Texto like '% aeropuertos y servicios auxiliares %' OR
        Titulo like '% aeropuertos y servicios auxiliares %' OR
        Encabezado like '% aeropuertos y servicios auxiliares %' OR
        Encabezado like '% aeropuertos y servicios auxiliares  %' OR

        Texto like '% ASA %' OR
        Titulo like '% ASA %' OR
        Encabezado like '% ASA %' OR
        Encabezado like '% ASA %' )  GROUP BY p.idPeriodico,n.PaginaPeriodico ORDER BY o.posicion ";
    return $query;      
    break;//INFORMACION INSTITUCIONAL

        case 7://Red de Aeropuertos y Servicios Auxiliares
           $query= $select_df . "(
        Texto like '% red de aeropuertos y servicios auxiliares %' OR
        Titulo like '% red de aeropuertos y servicios auxiliares %' OR
        PieFoto like '% red de aeropuertos y servicios auxiliares %' OR
        Encabezado like '% red de aeropuertos y servicios auxiliares %' ) GROUP BY p.idPeriodico,n.PaginaPeriodico";
            return $query;      
        break;//Red de Aeropuertos y Servicios Auxiliares


        case 8://Nuevo Aeropuerto Internacional de la Ciudad de México
           $query = $select_df . "(
    Texto like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' OR
    Titulo like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' OR
    Encabezado like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' OR
    PieFoto like '%Nuevo Aeropuerto Internacional de la Ciudad de México%' OR
    Autor like '%Nuevo Aeropuerto Internacional de la Ciudad de México%'  OR

    Texto like '%Nuevo Aeropuerto Internacional%' OR
    Titulo like '%Nuevo Aeropuerto Internacional%' OR
    Encabezado like '%Nuevo Aeropuerto Internacional%' OR
    PieFoto like '%Nuevo Aeropuerto Internacional%' OR
    Autor like '%Nuevo Aeropuerto Internacional%' ) GROUP BY p.idPeriodico,n.PaginaPeriodico ORDER BY o.posicion";
            return $query;      
            break;// Nuevo Aeropuerto Internacional de la Ciudad de México

        case 9://  Grupo Aeroportuario de la Ciudad de Mexico
           $query = $select_df . " (
    Texto like '%Grupo Aeroportuario de la Ciudad de Mexico%' OR
    Titulo like '%Grupo Aeroportuario de la Ciudad de Mexico%' OR
    Encabezado like '%Grupo Aeroportuario de la Ciudad de Mexico%' OR
    PieFoto like '%Grupo Aeroportuario de la Ciudad de Mexico%' OR
    Autor like '%Grupo Aeroportuario de la Ciudad de Mexico%' ) GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// Grupo Aeroportuario de la Ciudad de Mexico

    case 10://  Direccion General de Aeronautica Civil
           $query = $select_df . "(
        Texto like '%Direccion General de Aeronautica Civil%' OR
        Texto like '%Aeronautica Civil%' OR
        Texto like '% DGAC %' OR

        Titulo like '%Direccion General de Aeronautica Civil%' OR
        Titulo like '%Aeronautica Civil%' OR
        Titulo like '% DGAC %' OR

        Encabezado like '%Direccion General de Aeronautica Civil%' OR
        Encabezado like '%Aeronautica Civil%' OR
        Encabezado like '% DGAC %' OR

        PieFoto like '%Direccion General de Aeronautica Civil%' OR
        PieFoto like '%Aeronautica Civil%' OR
        PieFoto like '% DGAC %' OR

        Autor like '%Direccion General de Aeronautica Civil%' OR
        Autor like '%Aeronautica Civil%' OR
        Autor like '% DGAC %' 
    ) GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// Direccion General de Aeronautica Civil

    case 11://  Aeropuerto
           $query = $select_df . "(
    Texto like '%Aeropuerto%' OR
    Titulo like '%Aeropuerto%' OR
    Encabezado like '%Aeropuerto%' OR
    PieFoto like '%Aeropuerto%' OR
    Autor like '%Aeropuerto%' OR

    Texto like '% ASUR %' OR
    Titulo like '% ASUR %' OR
    Encabezado like '% ASUR %' OR
    PieFoto like '% ASUR %' OR
    Autor like '% ASUR %' OR

    Texto like '% OMA %' OR
    Titulo like '% OMA %' OR
    Encabezado like '% OMA %' OR
    PieFoto like '% OMA %' OR
    Autor like '% OMA %' OR

    Texto like '% GAP %' OR
    Titulo like '% GAP %' OR
    Encabezado like '% GAP %' OR
    PieFoto like '% GAP %' OR
    Autor like '% GAP %' OR

    Texto like '%AICM%' OR
    Titulo like '%AICM%' OR
    Encabezado like '%AICM%' OR
    PieFoto like '%AICM%' OR
    Autor like '%AICM%' 
  )  
 GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// Aeropuerto

    case 12:// Aerolineas  
           $query = $select_df . "(
    Texto like '%Southwest airlines%' OR
    Titulo like '%Southwest airlines%' OR
    Encabezado like '%Southwest airlines%' OR
    PieFoto like '%Southwest airlines%' OR
    Autor like '%Southwest airlines%' OR

    Texto like '%aircanada%' OR
    Titulo like '%aircanada%' OR
    Encabezado like '%aircanada%' OR
    PieFoto like '%aircanada%' OR
    Autor like '%aircanada%' OR

    Texto like '%air france%' OR
    Titulo like '%air france%' OR
    Encabezado like '%air france%' OR
    PieFoto like '%air france%' OR
    Autor like '%air france%' OR

    Texto like '%american airlines%' OR
    Titulo like '%american airlines%' OR
    Encabezado like '%american airlines%' OR
    PieFoto like '%american airlines%' OR
    Autor like '%american airlines%' OR

    Texto like '%delta airlines%' OR
    Titulo like '%delta airlines%' OR
    Encabezado like '%delta airlines%' OR
    PieFoto like '%delta airlines%' OR
    Autor like '%delta airlines%' OR

    Texto like '%united airlines%' OR
    Titulo like '%united airlines%' OR
    Encabezado like '%united airlines%' OR
    PieFoto like '%united airlines%' OR
    Autor like '%united airlines%' OR

    Texto like '% british airways %' OR
    Titulo like '% british airways %' OR
    Encabezado like '% british airways %' OR
    PieFoto like '% british airways %' OR
    Autor like '% british airways %' OR

    Texto like '% Lufthansa %' OR
    Titulo like '% Lufthansa %' OR
    Encabezado like '% Lufthansa %' OR
    PieFoto like '% Lufthansa %' OR
    Autor like '% Lufthansa %' OR

    Texto like '% germanwings %' OR
    Titulo like '% germanwings %' OR
    Encabezado like '% germanwings %' OR
    PieFoto like '% germanwings %' OR
    Autor like '% germanwings %' OR

    Texto like '% aerolienea %' OR
    Titulo like '% aerolienea %' OR
    Encabezado like '% aerolienea %' OR
    PieFoto like '% aerolienea %' OR
    Autor like '% aerolienea %' OR

    Texto like '%Aeromexico%' OR
    Titulo like '%Aeromexico%' OR
    Encabezado like '%Aeromexico%' OR
    PieFoto like '%Aeromexico%' OR
    Autor like '%Aeromexico%' OR

    Texto like '%aerolitoral%' OR
    Titulo like '%aerolitoral%' OR
    Encabezado like '%aerolitoral%' OR
    PieFoto like '%aerolitoral%' OR
    Autor like '%aerolitoral%' OR

    Texto like '%aerocaribe%' OR
    Titulo like '%aerocaribe%' OR
    Encabezado like '%aerocaribe%' OR
    PieFoto like '%aerocaribe%' OR
    Autor like '%aerocaribe%' OR

    Texto like '%aviacsa%' OR
    Titulo like '%aviacsa%' OR
    Encabezado like '%aviacsa%' OR
    PieFoto like '%aviacsa%' OR
    Autor like '%aviacsa%' OR

    Texto like '% avolar %' OR
    Titulo like '% avolar %' OR
    Encabezado like '% avolar %' OR
    PieFoto like '% avolar %' OR
    Autor like '% avolar %' OR

    Texto like '%aeromar%' OR
    Titulo like '%aeromar%' OR
    Encabezado like '%aeromar%' OR
    PieFoto like '%aeromar%' OR
    Autor like '%aeromar%' OR

    Texto like '%Interjet%' OR
    Titulo like '%Interjet%' OR
    Encabezado like '%Interjet%' OR
    PieFoto like '%Interjet%' OR
    Autor like '%Interjet%' OR

    Texto like '%Magnicharters%' OR
    Titulo like '%Magnicharters%' OR
    Encabezado like '%Magnicharters%' OR
    PieFoto like '%Magnicharters%' OR
    Autor like '%Magnicharters%' OR

    Texto like '% TAR Aerolíneas%' OR
    Texto like '%Transportes Aereos Regionales%' OR
    Titulo like '% TAR Aerolíneas %' OR
    Titulo like '%Transportes Aereos Regionales%' OR
    Encabezado like '% TAR Aerolíneas%' OR
    Encabezado like '%Transportes Aereos Regionales%' OR
    PieFoto like '% TAR Aerolíneas%' OR
    PieFoto like '%Transportes Aereos Regionales%' OR
    Autor like '% TAR Aerolíneas%' OR
    Autor like '%Transportes Aereos Regionales%' OR

    Texto like '%VivaAerobus%' OR
    Titulo like '%VivaAerobus %' OR
    Encabezado like '%VivaAerobus%' OR
    PieFoto like '%VivaAerobus%' OR
    Autor like '%VivaAerobus%' OR

    Texto like '%Volaris%' OR
    Titulo like '%Volaris %' OR
    Encabezado like '%Volaris%' OR
    PieFoto like '%Volaris%' OR
    Autor like '%Volaris%'
  )  GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// Aerolineas

    case 13://  Sector Aeronáutico y Aeroespacial
           $query = $select_df . "(
    Texto like '%Sector Aeronautico%' OR
    Titulo like '%Sector Aeronautico%' OR
    Encabezado like '%Sector Aeronautico%' OR
    PieFoto like '%Sector Aeronautico%' OR
    Autor like '%Sector Aeronautico%' OR

    Texto like '%Sector Aeroespacial%' OR
    Titulo like '%Sector Aeroespacial%' OR
    Encabezado like '%Sector Aeroespacial%' OR
    PieFoto like '%Sector Aeroespacial%' OR
    Autor like '%Sector Aeroespacial%'
  )  GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// Sector Aeronáutico y Aeroespacial

    case 14://  Secretaría de Gobernación
           $query = $select_df . "(
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
            Texto like '% segob %' OR
            Texto like '% secretaria de gobernacion %' OR

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
            Titulo like '% segob %' OR
            Titulo like '% secretaria de gobernacion %' OR

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
            Encabezado like '% segob %' OR
            Encabezado like '% secretaria de gobernacion %'
            
           )AND 
           Texto not like '%El gobierno de michoacan concedio a la seccion 18%' AND
            (                                   
                (Texto like '%Miguel Angel%' AND Texto like '%Osorio%') OR 
                (Texto like '%Miguel Angel %' AND Texto like '%Osorio%')OR 
                (Texto like '%Miguel%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%Miguel A.%' OR Texto like '%Osorio%' OR Texto like '%Chong%') OR
                (Texto like '%titular de la SEGOB%' OR  Texto like '%Osorio Chong%' OR Texto like '%secretario chong%' OR Texto like '%Chong%') OR 
                (Texto like '%SEGOB%' OR  Texto like '%Osorio Chong%' OR Texto like '%secretaria de gobernacion%' OR Texto like '%gobernacion%') OR 
                
                (Titulo like '%Miguel Angel%' AND Titulo like '%Osorio%') OR 
                (Titulo like '%Miguel Angel %' AND Titulo like '%Osorio%')OR 
                (Titulo like '%Miguel%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%Miguel A.%' OR Titulo like '%Osorio%' OR Titulo like '%Chong%') OR
                (Titulo like '%titular de la SEGOB%' OR  Titulo like '%Osorio Chong%' OR Titulo like '%secretario chong%') OR
                (Titulo like '%SEGOB%' OR  Titulo like '%Osorio Chong%' OR Titulo like '%secretaria de gobernacion%' OR Titulo like '%gobernacion%') OR
                
                (Encabezado like '%Miguel Angel%' AND Encabezado like '%Osorio%') OR 
                (Encabezado like '%Miguel Angel %' AND Encabezado like '%Osorio%')OR 
                (Encabezado like '%Miguel%' OR Encabezado like '%Osorio%' OR Encabezado like '%Chong%') OR
                (Encabezado like '%Miguel A.%' OR Encabezado like '%Osorio%' OR Encabezado like '%Chong%') OR
                (Encabezado like '%titular de la SEGOB%' OR  Encabezado like '%Osorio Chong%' OR Encabezado like '%secretario chong%') OR
                (Encabezado like '%SEGOB%' OR  Encabezado like '%Osorio Chong%' OR Encabezado like '%secretaria de gobernacion%' OR Encabezado like '%gobernacion%')
            )
 GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// Secretaría de Gobernación

    case 15://  Secretaría de Comunicaciones y Transportes
           $query = $select_df . "(
        Texto like'%Gerardo Ruiz Esparza%' OR
        Texto like '%Gerardo Ruiz Esparza%' OR
        Texto like '%SCT%' OR
        Texto like '%Secretaria de Comunicaciones y Transportes%' OR
        Titulo like'%Gerardo Ruiz Esparza%' OR
        Titulo like '%SCT%' OR
        Titulo like '%Secretaria de Comunicaciones y Transportes%' OR
        Encabezado like '%Gerardo Ruiz Esparza%' OR
        Encabezado like '%SCT%' OR
        Encabezado like '%Secretaria de Comunicaciones y Transportes%'
       )  GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// Secretaría de Comunicaciones y Transportes

    case 16://  Secretaría de Turismo
           $query = $select_df . " (
        Texto like'%Enrique de la Madrid%' OR
        Texto like '%SECTUR%' OR
        Texto like '%secretaria de turismo%' OR
        Titulo like'%Enrique de la Madrid%' OR
        Titulo like '%SECTUR%' OR
        Titulo like '%secretaria de turismo%' OR
        Encabezado like '%Enrique de la Madrid%' OR
        Encabezado like '%SECTUR%' OR
        Encabezado like '%secretaria de turismo%'
       ) GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// Secretaría de Turismo

    case 17:// Combustibles
           $query = $select_df . "(
        Texto like'%Turbosina%' OR
        Titulo like'%Turbosina%' OR
        Encabezado like'%Turbosina%' OR

        Texto like'%Gasavion%' OR
        Titulo like'%Gasavion%' OR
        Encabezado like'%Gasavion%'
)     GROUP BY p.idPeriodico,n.PaginaPeriodico ";

        return $query;      
        break;// 

        default:
            break;
    }
}
?>
