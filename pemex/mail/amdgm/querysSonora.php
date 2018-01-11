<?php
function query($op,$fechaTabla,$estado,$opcion){
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
            $Tabla="
              (
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasDia WHERE Fecha BETWEEN '2014-10-01' AND CURDATE()
                UNION ALL
                SELECT idEditorial,Fecha,Titulo , PaginaPeriodico, NumeroPagina , Texto, Periodico,Autor, Hora, Encabezado, Foto,PieFoto, Seccion, Categoria, Activo FROM  noticiasSemana WHERE Fecha BETWEEN '2014-10-01' AND CURDATE()
              )
            ";
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
                    GROUP BY n.idEditorial
                    ORDER BY o.id";
            return $query;
            break;
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
                    GROUP BY n.idEditorial";
            return $query;
            break;
        case 4:// Cartones
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
                    GROUP BY n.idEditorial
                    ORDER BY o.posicion";
            return $query;  
            break;
        case 5:
            switch ($opcion){
                case 1:
                    $limit1=0;
                    $limit2=15;
                    break;
                case 2:
                    $limit1=16;
                    $limit2=15;
                    break;
                case 3:
                    $limit1=32;
                    $limit2=15;
                    break;
                case 4:
                    $limit1=48;
                    $limit2=15;
                    break;

                default:
                    $limit1=0;
                    $limit2=50;
                    break;
            }
            
$query="SELECT Orden,Tema,idEditorial,Periodico,Fecha,Titulo,Texto,pdf,NoEstado,estado,NumeroPagina, Seccion FROM
(
SELECT '1' as Orden, 'Secretario' as Tema, n.idEditorial,
	   p.Nombre as 'Periodico',n.Fecha,n.Titulo,n.Texto,
	   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	   p.Estado as 'NoEstado',
	   e.Nombre as 'Estado',
	   n.NumeroPagina,
	   s.seccion
	   FROM $Tabla n, (SELECT * FROM periodicos WHERE Estado = $estado) p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
	   WHERE p.idPeriodico=n.Periodico AND
	   s.idSeccion=n.Seccion AND
	   c.idCategoria=n.Categoria AND
	   p.estado=e.idEstado AND
                  (
   Texto like'%David Korenfeld Federman%' OR  
   Texto like 'David Korenfeld Federman' OR
   Texto like '%David Korenfeld%' OR
   Texto like '%David Corenfeld%' OR
   Texto like '%Corenfeld Federman%' OR
   Texto like '%Korenfeld Federman%' OR

   Titulo like'%David Korenfeld Federman%' OR  
   Titulo like 'David Korenfeld Federman' OR
   Titulo like '%David Korenfeld%' OR
   Titulo like '%David Corenfeld%' OR
   Titulo like '%Corenfeld Federman%' OR
   Titulo like '%Korenfeld Federman%' OR 

   Encabezado like'%David Korenfeld Federman%' OR  
   Encabezado like 'David Korenfeld Federman' OR
   Encabezado like '%David Korenfeld%' OR
   Encabezado like '%David Corenfeld%' OR
   Encabezado like '%Corenfeld Federman%' OR
   Encabezado like '%Korenfeld Federman%'
  ) AND
  (
     (Texto like '%David%' AND Texto like '%Korenfeld%' OR Texto like '%Corenfeld%') OR (Texto like '%David%' AND Texto like '%Ferderman%') Or (Texto like '%Titular de la Conagua%')
   )
  group by n.Periodico,n.NumeroPagina
	
UNION ALL
	SELECT '2' as Orden, 'CONAGUA' as Tema, n.idEditorial,
	   p.Nombre as 'Periodico',n.Fecha,n.Titulo,n.Texto,
	   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	   p.Estado as 'NoEstado',
	   e.Nombre as 'Estado',
	   n.NumeroPagina,
	   s.seccion
	   FROM $Tabla n, (SELECT * FROM periodicos WHERE Estado = $estado) p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
	   WHERE p.idPeriodico=n.Periodico AND
	   s.idSeccion=n.Seccion AND
	   c.idCategoria=n.Categoria AND
	   p.estado=e.idEstado AND
                 (
   Texto  like '%CONAGUA%' OR
   Texto  like '%comision nacional del agua%' OR
   Texto  like '%jorge malagon diaz%' OR
   Texto  like '%cesar alfonso lagarda laga%' OR
   Texto  like '%ivan hillman chapoy%' OR
   Texto  like '%roberto pinzon alvarez%' OR
   Texto  like '%eduardo ledesma romo%' OR
   Texto  like '%montoya suarez%' OR
   Texto  like '%abelardo amaya enderle%' OR
   Texto  like '%jorge octavio mihangos borjja%' OR
   Texto  like '%jesus mijangos borja%' OR
   Texto  like '%jesus minon guevara%' OR
   Texto  like '%antonio gutierrez marcos%' OR
   Texto  like '%benjamin de leon mojarro%' OR

   Texto  like '%presa Zapotillo%' OR
   Texto  like '%temacapulin%' OR
   Texto  like '%Chapala%' OR
   Texto  like '%acueducto independencia%' OR
   Texto  like '%presa el novillo%' OR
   Texto  like '%Acueducto monterrey VI%' OR

   Titulo like '%CONAGUA%'OR
   Titulo like '%comision nacional del agua%' OR
   Titulo  like '%CONAGUA%' OR
   Titulo  like '%comision nacional del agua%' OR
   Titulo  like '%jorge malagon diaz%' OR
   Titulo  like '%cesar alfonso lagarda laga%' OR
   Titulo  like '%ivan hillman chapoy%' OR
   Titulo  like '%roberto pinzon alvarez%' OR
   Titulo  like '%eduardo ledesma romo%' OR
   Titulo  like '%montoya suarez%' OR
   Titulo  like '%abelardo amaya enderle%' OR
   Titulo  like '%jorge octavio mihangos borjja%' OR
   Titulo  like '%jesus mijangos borja%' OR
   Titulo  like '%jesus minon guevara%' OR
   Titulo  like '%antonio gutierrez marcos%' OR
   Titulo  like '%benjamin de leon mojarro%' OR

   Titulo  like '%presa Zapotillo%' OR
   Titulo  like '%temacapulin%' OR
   Titulo  like '%Chapala%' OR
   Titulo  like '%acueducto independencia%' OR
   Titulo  like '%presa el novillo%' OR
   Titulo  like '%Acueducto monterrey VI%' OR

   Encabezado like '%CONAGUA%'OR
   Encabezado like '%comision nacional del agua%' OR
   Encabezado  like '%CONAGUA%' OR
   Encabezado  like '%comision nacional del agua%' OR
   Encabezado  like '%jorge malagon diaz%' OR
   Encabezado  like '%cesar alfonso lagarda laga%' OR
   Encabezado  like '%ivan hillman chapoy%' OR
   Encabezado  like '%roberto pinzon alvarez%' OR
   Encabezado  like '%eduardo ledesma romo%' OR
   Encabezado  like '%montoya suarez%' OR
   Encabezado  like '%abelardo amaya enderle%' OR
   Encabezado  like '%jorge octavio mihangos borjja%' OR
   Encabezado  like '%jesus mijangos borja%' OR
   Encabezado  like '%jesus minon guevara%' OR
   Encabezado  like '%antonio gutierrez marcos%' OR
   Encabezado  like '%benjamin de leon mojarro%' OR

   Encabezado  like '%presa Zapotillo%' OR
   Encabezado  like '%temacapulin%' OR
   Encabezado  like '%Chapala%' OR
   Encabezado  like '%acueducto independencia%' OR
   Encabezado  like '%presa el novillo%' OR
   Encabezado  like '%Acueducto monterrey VI%'
  )
  group by n.Periodico,n.NumeroPagina
UNION ALL
	SELECT '3' as Orden, 'SMN' as Tema, n.idEditorial,
	   p.Nombre as 'Periodico',n.Fecha,n.Titulo,n.Texto,
	   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	   p.Estado as 'NoEstado',
	   e.Nombre as 'Estado',
	   n.NumeroPagina,
	   s.seccion
	   FROM $Tabla n, (SELECT * FROM periodicos WHERE Estado = $estado) p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
	   WHERE p.idPeriodico=n.Periodico AND
	   s.idSeccion=n.Seccion AND
	   c.idCategoria=n.Categoria AND
	   p.estado=e.idEstado AND
                 (               
	Texto like '%sistema Meteorologico nacional %' OR
	Texto like '%sistema Meteorologico nacional%' OR
       Texto like '%SMN%' OR
       Texto like '%pronostico meteorologico%' OR
       Texto like '%temporada de lluvia%' OR
       Texto like '%tormenta tropical%' OR
       Texto like '%tormentas tropicales%' OR
       Texto like '%ciclones%' OR
       Texto like '%huracan %' and texto not like '%Soriana%' OR
       Texto like '%huracanes%' OR
       Texto like '% sequia %' and texto not like '%goleadora%' OR
       Texto like '% sequias %' OR
       Texto like '%frente frio%' OR
       Texto like '%frentes frios%' OR
       Texto like '% helada%' and texto not like '%cerveza%' OR

	Titulo like '%sistema Meteorologico nacional %' OR
	Titulo like '%sistema Meteorologico nacional%' OR
       Titulo like '%SMN%' OR
       Titulo like '%pronostico meteorologico%' OR
       Titulo like '%temporada de lluvia%' OR
       Titulo like '%tormenta tropical%' OR
       Titulo like '%tormentas tropicales%' OR
       Titulo like '%ciclones%' OR
       Titulo like '%huracan%' OR
       Titulo like '%huracanes%' OR
       Titulo like '% sequia %' OR
       Titulo like '% sequias %' OR
       Titulo like '%frente frio%' OR
       Titulo like '%frentes frios%' OR
       Titulo like '% helada%' and texto not like '%cerveza%' OR

	Encabezado like '%sistema Meteorologico nacional %' OR
	Encabezado like '%sistema Meteorologico nacional%' OR
       Encabezado like '%SMN%' OR
       Encabezado like '%pronostico meteorologico%' OR
       Encabezado like '%temporada de lluvia%' OR
       Encabezado like '%tormenta tropical%' OR
       Encabezado like '%tormentas tropicales%' OR
       Encabezado like '%ciclones%' OR
       Encabezado like '%huracan%' OR
       Encabezado like '%huracanes%' OR
       Encabezado like '% sequia %' OR
       Encabezado like '% sequias %' OR
       Encabezado like '%frente frio%' OR
       Encabezado like '%frentes frios%' OR
       Encabezado like '% helada%' and texto not like '%cerveza%'
      )
	   group by n.Periodico,n.NumeroPagina
UNION ALL 
	SELECT '4' as Orden, 'Sector Hidraulico' as Tema, n.idEditorial,
	   p.Nombre as 'Periodico',n.Fecha,n.Titulo,n.Texto,
	   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	   p.Estado as 'NoEstado',
	   e.Nombre as 'Estado',
	   n.NumeroPagina,
	   s.seccion
	   FROM $Tabla n, (SELECT * FROM periodicos WHERE Estado = $estado) p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
	   WHERE p.idPeriodico=n.Periodico AND
	   s.idSeccion=n.Seccion AND
	   c.idCategoria=n.Categoria AND
	   p.estado=e.idEstado AND
	    (
               Texto like '%sector hidraulico%' OR
               Texto like 'ANEAS' OR
               Texto like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
               Texto like '%uniades de riego%' OR
               Texto like '%modulo de riego%' OR
               Texto like '%modulos de riego%' OR
               Texto like '%junta municipal de agua%' OR
               Texto like '%organismos operadores%' OR
               Texto like '%comision estatal del agua%' OR

               Texto like ' CCAP ' OR
               Texto like ' CESPE ' OR
               Texto like ' CESPM ' OR
               Texto like ' CESPETE ' OR
               Texto like ' CESPT ' OR
               Texto like ' SAPA ' OR
               Texto like ' OSAGUA ' OR
               Texto like ' JMAS ' OR
               Texto like ' SIMAS ' OR
               Texto like ' SAPAM ' OR
               Texto like ' COAPATAP ' OR
               Texto like ' SMAPA ' OR
               Texto like ' SIMAS ' OR
               Texto like ' SIMAPA ' OR
               Texto like ' AGSAL ' OR
               Texto like ' CIAPACOV ' OR
               Texto like ' CAPDAM ' OR
               Texto like ' SIDEA ' OR
               Texto like ' SIDEAPAS ' OR
               Texto like ' OADAP ' OR
               Texto like ' ADAPAS ' OR
               Texto like ' OPDM ' OR
               Texto like ' AIST ' OR
               Texto like ' APAST ' OR
               Texto like ' CAPAMA ' OR
               Texto like ' CAPAMI ' OR
               Texto like ' CAPAZ ' OR
               Texto like ' JUMAPA ' OR
               Texto like ' JAMAPI ' OR
               Texto like ' SAPAL ' OR
               Texto like ' CMAPAS ' OR
               Texto like ' CAPAMIH ' OR
               Texto like ' CEAA ' OR
               Texto like ' CAAMT ' OR
               Texto like ' SIAPA ' OR
               Texto like ' SEAPAL ' OR
               Texto like ' OROMAPAS ' OR
               Texto like ' CAPALAC ' OR
               Texto like ' OOAPAS ' OR
               Texto like ' OOAPASQ ' OR
               Texto like ' OMSAP ' OR
               Texto like ' CAPASU ' OR
               Texto like ' SAPAZ ' OR
               Texto like ' SOAPSC ' OR
               Texto like ' SAPAC ' OR
               Texto like ' SMAPEZ ' OR
               Texto like ' SIAPA ' OR
               Texto like ' OOMAPPI ' OR
               Texto like ' SCAPSAT ' OR
               Texto like ' SAP ' OR
               Texto like ' SAPASXO ' OR
               Texto like ' SCAPSZ ' OR
               Texto like ' SIAPA ' OR
               Texto like ' SADM ' OR
               Texto like ' ADOSAPACO ' OR
               Texto like ' SOAPAP ' OR
               Texto like ' SOAPAIM ' OR
               Texto like ' JAPAM ' OR
               Texto like ' CEA ' OR
               Texto like ' CAPA ' OR
               Texto like ' JMM ' OR
               Texto like ' JAPAC ' OR
               Texto like ' JUMAPAG ' OR
               Texto like ' JUMAPA ' OR
               Texto like ' JUMAPAN ' OR
               Texto like ' DAPA ' OR
               Texto like ' COMAP ' OR
               Texto like ' OOMAPAS ' OR
               Texto like ' COMAPA ' OR
               Texto like ' JAD ' OR
               Texto like ' CAPAM ' OR
               Texto like ' CMAPS ' OR
               Texto like ' CRAS ' OR
               Texto like ' CAPA ' OR
               Texto like ' JAPAY ' OR
               Texto like ' SAPAMV ' OR
               Texto like ' SIAPASF ' OR
               Texto like ' JIAPAZ ' OR
               Texto like '%Agua Potable y alcantarillado%' OR
               Texto like '%Agua Potable%' OR
               Texto like '%comision ciudadana de apa%' OR
               Texto like '%comision estatal de servicios publicos%' OR
               Texto like '%organismo operador municipal del sistema de apa y smto%' OR
               Texto like '%organismo del sistema de agua%' OR
               Texto like '%junta municipal de agua y saneamiento%' OR
               Texto like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
               Texto like '%sistema municipal de aguas y saneamiento%' OR
               Texto like '%junta municipal de agua y saneamiento%' OR
               Texto like '%sistema municipal de apa municipal%' OR
               Texto like '%comite de apa tapachula%' OR
               Texto like '%sistema municipal de apa%' OR
               Texto like '%sistemas municipal de aguas y saneamiento%' OR
               Texto like '%sistema municipal de agua y saneamiento de frontera%' OR
               Texto like '%sistemas municipal de agua potable y alcantarillado%' OR
               Texto like '%aguas de saltillo%' OR
               Texto like '%sistema municipal de aguas y saneamiento%' OR
               Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Texto like '%aguas de saltillo%' OR
               Texto like '%sistema municipal de aguas y saneamiento%' OR
               Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Texto like '%aguas de saltillo%' OR
               Texto like '%sistema municipal de aguas y saneamiento%' OR
               Texto like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Texto like '%comision de agua potable y drenaje y alcantarillado%' OR
               Texto like '%sistema descentralizado de apa y saneamiento%' OR
               Texto like '%organismo publico descentralizado municipal de apa y smto%' OR
               Texto like '%comision de agua potable y alcantarillado%' OR
               Texto like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
               Texto like '%junta de apa del municipio de irapuato%' OR
               Texto like '%sistema de apa de leon%' OR
               Texto like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
               Texto like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
               Texto like '%general de comision estatal de agua y alcantarillado%' OR
               Texto like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
               Texto like '%sistema municipal de los servicios de APA%' OR
               Texto like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
               Texto like '%organismo operador municipal de apa y saneamiento%' OR
               Texto like '%organismo municipal de servicios de agua potable%' OR
               Texto like '%comision de apa y saneamiento%' OR
               Texto like '%sistema de apa%' OR
               Texto like '%sistema ordenador de agua potable y saneamiento%' OR
               Texto like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
               Texto like '%sistema municipal de agua potable emiliano zapata%' OR
               Texto like '%sistema de agua potable de huitzilac y tres marias%' OR
               Texto like '%sistema de conservacion de agua potable y saneamiento%' OR
               Texto like '%organismo operador municipal de agua potable de puente de ixtla%' OR
               Texto like '%sistema de agua potable y saneamiento de temixco%' OR
               Texto like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
               Texto like '%sistema de aguan potable y saneamiento de zacatepec%' OR
               Texto like '%sistema operador de los servicios de apa%' OR
               Texto like '%sistema operador de los servicios de apa%' OR
               Texto like '%junta de agua potable y alcantarillado municipal%' OR
               Texto like '%comision estatal de aguas%' OR
               Texto like '%comision de apa%' OR
               Texto like '%comision de agua potable y alcantarillado%' OR
               Texto like '%junta municipal de apa de culiacan%' OR
               Texto like '%junta municipal de agua potable y alcantarillado%' OR
               Texto like '%junta de apa del mpio%' OR
               Texto like '%junta municipal de apa%' OR
               Texto like '%direccion de apa y saneamiento%' OR
               Texto like '%comision municipal de agua potable%' OR
               Texto like '%comision de apa%' OR
               Texto like '%organismo operador municipal de apa y saneamiento%' OR
               Texto like '%comision municipal de agua potable%' OR
               Texto like '%agua de hermosillo%' OR
               Texto like '%organismo operador municiapal de apa y saneamiento%' OR
               Texto like '%junta de aguas y drenaje%' OR
               Texto like '%comision municipal de apa%' OR
               Texto like '%comision de apa del municipio de tlaxcala%' OR
               Texto like '%comision municipal de agua potable y saneamiento%' OR
               Texto like '%sas metropolitano%' OR
               Texto like '%comision de agua potable y alcantarillado%' OR
               Texto like '%junta de agua potable y alcantarillado%' OR
               Texto like '%sistema de agua potable y alcantarillado%' OR
               Texto like '%sistema de apa y smto%' OR
               Texto like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
               Texto like '%acueducto%' OR
               Texto like '%canal de riego%' OR
               Texto like '%planta de tratamiento de aguas residuales%' OR
               Texto like '% PTAR %' OR
               Texto like '%Carcamo%' OR
               Texto like '%planta de bombeo%' OR

               Titulo like '%sector hidraulico%' OR
               Titulo like 'ANEAS' OR
               Titulo like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
               Titulo like '%uniades de riego%' OR
               Titulo like '%modulo de riego%' OR
               Titulo like '%modulos de riego%' OR
               Titulo like '%junta municipal de agua%' OR
               Titulo like '%organismos operadores%' OR
               Titulo like '%comision estatal del agua%' OR
               Titulo like ' CCAP ' OR
               Titulo like ' CESPE ' OR
               Titulo like ' CESPM ' OR
               Titulo like ' CESPETE ' OR
               Titulo like ' CESPT ' OR
               Titulo like ' SAPA ' OR
               Titulo like ' OSAGUA ' OR
               Titulo like ' JMAS ' OR
               Titulo like ' SIMAS ' OR
               Titulo like ' SAPAM ' OR
               Titulo like ' COAPATAP ' OR
               Titulo like ' SMAPA ' OR
               Titulo like ' SIMAS ' OR
               Titulo like ' SIMAPA ' OR
               Titulo like ' AGSAL ' OR
               Titulo like ' CIAPACOV ' OR
               Titulo like ' CAPDAM ' OR
               Titulo like ' SIDEA ' OR
               Titulo like ' SIDEAPAS ' OR
               Titulo like ' OADAP ' OR
               Titulo like ' ADAPAS ' OR
               Titulo like ' OPDM ' OR
               Titulo like ' AIST ' OR
               Titulo like ' APAST ' OR
               Titulo like ' CAPAMA ' OR
               Titulo like ' CAPAMI ' OR
               Titulo like ' CAPAZ ' OR
               Titulo like ' JUMAPA ' OR
               Titulo like ' JAMAPI ' OR
               Titulo like ' SAPAL ' OR
               Titulo like ' CMAPAS ' OR
               Titulo like ' CAPAMIH ' OR
               Titulo like ' CEAA ' OR
               Titulo like ' CAAMT ' OR
               Titulo like ' SIAPA ' OR
               Titulo like ' SEAPAL ' OR
               Titulo like ' OROMAPAS ' OR
               Titulo like ' CAPALAC ' OR
               Titulo like ' OOAPAS ' OR
               Titulo like ' OOAPASQ ' OR
               Titulo like ' OMSAP ' OR
               Titulo like ' CAPASU ' OR
               Titulo like ' SAPAZ ' OR
               Titulo like ' SOAPSC ' OR
               Titulo like ' SAPAC ' OR
               Titulo like ' SMAPEZ ' OR
               Titulo like ' SIAPA ' OR
               Titulo like ' OOMAPPI ' OR
               Titulo like ' SCAPSAT ' OR
               Titulo like ' SAP ' OR
               Titulo like ' SAPASXO ' OR
               Titulo like ' SCAPSZ ' OR
               Titulo like ' SIAPA ' OR
               Titulo like ' SADM ' OR
               Titulo like ' ADOSAPACO ' OR
               Titulo like ' SOAPAP ' OR
               Titulo like ' SOAPAIM ' OR
               Titulo like ' JAPAM ' OR
               Titulo like ' CEA ' OR
               Titulo like ' CAPA ' OR
               Titulo like ' JMM ' OR
               Titulo like ' JAPAC ' OR
               Titulo like ' JUMAPAG ' OR
               Titulo like ' JUMAPA ' OR
               Titulo like ' JUMAPAN ' OR
               Titulo like ' DAPA ' OR
               Titulo like ' COMAP ' OR
               Titulo like ' OOMAPAS ' OR
               Titulo like ' COMAPA ' OR
               Titulo like ' JAD ' OR
               Titulo like ' CAPAM ' OR
               Titulo like ' CMAPS ' OR
               Titulo like ' CRAS ' OR
               Titulo like ' CAPA ' OR
               Titulo like ' JAPAY ' OR
               Titulo like ' SAPAMV ' OR
               Titulo like ' SIAPASF ' OR
               Titulo like ' JIAPAZ ' OR
               Titulo like '%Agua Potable y alcantarillado%' OR
               Titulo like '%Agua Potable%' OR
               Titulo like '%comision ciudadana de apa%' OR
               Titulo like '%comision estatal de servicios publicos%' OR
               Titulo like '%organismo operador municipal del sistema de apa y smto%' OR
               Titulo like '%organismo del sistema de agua%' OR
               Titulo like '%junta municipal de agua y saneamiento%' OR
               Titulo like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
               Titulo like '%sistema municipal de aguas y saneamiento%' OR
               Titulo like '%junta municipal de agua y saneamiento%' OR
               Titulo like '%sistema municipal de apa municipal%' OR
               Titulo like '%comite de apa tapachula%' OR
               Titulo like '%sistema municipal de apa%' OR
               Titulo like '%sistemas municipal de aguas y saneamiento%' OR
               Titulo like '%sistema municipal de agua y saneamiento de frontera%' OR
               Titulo like '%sistemas municipal de agua potable y alcantarillado%' OR
               Titulo like '%aguas de saltillo%' OR
               Titulo like '%sistema municipal de aguas y saneamiento%' OR
               Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Titulo like '%aguas de saltillo%' OR
               Titulo like '%sistema municipal de aguas y saneamiento%' OR
               Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Titulo like '%aguas de saltillo%' OR
               Titulo like '%sistema municipal de aguas y saneamiento%' OR
               Titulo like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Titulo like '%comision de agua potable y drenaje y alcantarillado%' OR
               Titulo like '%sistema descentralizado de apa y saneamiento%' OR
               Titulo like '%organismo publico descentralizado municipal de apa y smto%' OR
               Titulo like '%comision de agua potable y alcantarillado%' OR
               Titulo like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
               Titulo like '%junta de apa del municipio de irapuato%' OR
               Titulo like '%sistema de apa de leon%' OR
               Titulo like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
               Titulo like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
               Titulo like '%general de comision estatal de agua y alcantarillado%' OR
               Titulo like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
               Titulo like '%sistema municipal de los servicios de APA%' OR
               Titulo like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
               Titulo like '%organismo operador municipal de apa y saneamiento%' OR
               Titulo like '%organismo municipal de servicios de agua potable%' OR
               Titulo like '%comision de apa y saneamiento%' OR
               Titulo like '%sistema de apa%' OR
               Titulo like '%sistema ordenador de agua potable y saneamiento%' OR
               Titulo like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
               Titulo like '%sistema municipal de agua potable emiliano zapata%' OR
               Titulo like '%sistema de agua potable de huitzilac y tres marias%' OR
               Titulo like '%sistema de conservacion de agua potable y saneamiento%' OR
               Titulo like '%organismo operador municipal de agua potable de puente de ixtla%' OR
               Titulo like '%sistema de agua potable y saneamiento de temixco%' OR
               Titulo like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
               Titulo like '%sistema de aguan potable y saneamiento de zacatepec%' OR
               Titulo like '%sistema operador de los servicios de apa%' OR
               Titulo like '%sistema operador de los servicios de apa%' OR
               Titulo like '%junta de agua potable y alcantarillado municipal%' OR
               Titulo like '%comision estatal de aguas%' OR
               Titulo like '%comision de apa%' OR
               Titulo like '%comision de agua potable y alcantarillado%' OR
               Titulo like '%junta municipal de apa de culiacan%' OR
               Titulo like '%junta municipal de agua potable y alcantarillado%' OR
               Titulo like '%junta de apa del mpio%' OR
               Titulo like '%junta municipal de apa%' OR
               Titulo like '%direccion de apa y saneamiento%' OR
               Titulo like '%comision municipal de agua potable%' OR
               Titulo like '%comision de apa%' OR
               Titulo like '%organismo operador municipal de apa y saneamiento%' OR
               Titulo like '%comision municipal de agua potable%' OR
               Titulo like '%agua de hermosillo%' OR
               Texto like '%organismo operador municiapal de apa y saneamiento%' OR
               Texto like '%junta de aguas y drenaje%' OR
               Texto like '%comision municipal de apa%' OR
               Texto like '%comision de apa del municipio de tlaxcala%' OR
               Titulo like '%comision municipal de agua potable y saneamiento%' OR
               Titulo like '%sas metropolitano%' OR
               Titulo like '%comision de agua potable y alcantarillado%' OR
               Titulo like '%junta de agua potable y alcantarillado%' OR
               Titulo like '%sistema de agua potable y alcantarillado%' OR
               Titulo like '%sistema de apa y smto%' OR
               Titulo like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
               Titulo like '%acueducto%' OR
               Titulo like '%canal de riego%' OR
               Titulo like '%planta de tratamiento de aguas residuales%' OR
               Titulo like '% PTAR %' OR
               Titulo like '%Carcamo%' OR
               Titulo like '%planta de bombeo%' OR

               Encabezado like '%sector hidraulico%' OR
               Encabezado like 'ANEAS' OR
               Encabezado like '%Asociacion Nacional De Empresas De Agua y Saneamiento%' OR
               Encabezado like '%uniades de riego%' OR
               Encabezado like '%modulo de riego%' OR
               Encabezado like '%modulos de riego%' OR
               Encabezado like '%junta municipal de agua%' OR
               Encabezado like '%organismos operadores%' OR
               Encabezado like '%comision estatal del agua%' OR

               Encabezado like ' CCAP ' OR
               Encabezado like ' CESPE ' OR
               Encabezado like ' CESPM ' OR
               Encabezado like ' CESPETE ' OR
               Encabezado like ' CESPT ' OR
               Encabezado like ' SAPA ' OR
               Encabezado like ' OSAGUA ' OR
               Encabezado like ' JMAS ' OR
               Encabezado like ' SIMAS ' OR
               Encabezado like ' SAPAM ' OR
               Encabezado like ' COAPATAP ' OR
               Encabezado like ' SMAPA ' OR
               Encabezado like ' SIMAS ' OR
               Encabezado like ' SIMAPA ' OR
               Encabezado like ' AGSAL ' OR
               Encabezado like ' CIAPACOV ' OR
               Encabezado like ' CAPDAM ' OR
               Encabezado like ' SIDEA ' OR
               Encabezado like ' SIDEAPAS ' OR
               Encabezado like ' OADAP ' OR
               Encabezado like ' ADAPAS ' OR
               Encabezado like ' OPDM ' OR
               Encabezado like ' AIST ' OR
               Encabezado like ' APAST ' OR
               Encabezado like ' CAPAMA ' OR
               Encabezado like ' CAPAMI ' OR
               Encabezado like ' CAPAZ ' OR
               Encabezado like ' JUMAPA ' OR
               Encabezado like ' JAMAPI ' OR
               Encabezado like ' SAPAL ' OR
               Encabezado like ' CMAPAS ' OR
               Encabezado like ' CAPAMIH ' OR
               Encabezado like ' CEAA ' OR
               Encabezado like ' CAAMT ' OR
               Encabezado like ' SIAPA ' OR
               Encabezado like ' SEAPAL ' OR
               Encabezado like ' OROMAPAS ' OR
               Encabezado like ' CAPALAC ' OR
               Encabezado like ' OOAPAS ' OR
               Encabezado like ' OOAPASQ ' OR
               Encabezado like ' OMSAP ' OR
               Encabezado like ' CAPASU ' OR
               Encabezado like ' SAPAZ ' OR
               Encabezado like ' SOAPSC ' OR
               Encabezado like ' SAPAC ' OR
               Encabezado like ' SMAPEZ ' OR
               Encabezado like ' SIAPA ' OR
               Encabezado like ' OOMAPPI ' OR
               Encabezado like ' SCAPSAT ' OR
               Encabezado like ' SAP ' OR
               Encabezado like ' SAPASXO ' OR
               Encabezado like ' SCAPSZ ' OR
               Encabezado like ' SIAPA ' OR
               Encabezado like ' SADM ' OR
               Encabezado like ' ADOSAPACO ' OR
               Encabezado like ' SOAPAP ' OR
               Encabezado like ' SOAPAIM ' OR
               Encabezado like ' JAPAM ' OR
               Encabezado like ' CEA ' OR
               Encabezado like ' CAPA ' OR
               Encabezado like ' JMM ' OR
               Encabezado like ' JAPAC ' OR
               Encabezado like ' JUMAPAG ' OR
               Encabezado like ' JUMAPA ' OR
               Encabezado like ' JUMAPAN ' OR
               Encabezado like ' DAPA ' OR
               Encabezado like ' COMAP ' OR
               Encabezado like ' OOMAPAS ' OR
               Encabezado like ' COMAPA ' OR
               Encabezado like ' JAD ' OR
               Encabezado like ' CAPAM ' OR
               Encabezado like ' CMAPS ' OR
               Encabezado like ' CRAS ' OR
               Encabezado like ' CAPA ' OR
               Encabezado like ' JAPAY ' OR
               Encabezado like ' SAPAMV ' OR
               Encabezado like ' SIAPASF ' OR
               Encabezado like ' JIAPAZ ' OR
               Encabezado like '%Agua Potable y alcantarillado%' OR
               Encabezado like '%Agua Potable%' OR
               Encabezado like '%comision ciudadana de apa%' OR
               Encabezado like '%comision estatal de servicios publicos%' OR
               Encabezado like '%organismo operador municipal del sistema de apa y smto%' OR
               Encabezado like '%organismo del sistema de agua%' OR
               Encabezado like '%junta municipal de agua y saneamiento%' OR
               Encabezado like '%junta municipal de agua y saneamiento de cuauhtemoc%' OR
               Encabezado like '%sistema municipal de aguas y saneamiento%' OR
               Encabezado like '%junta municipal de agua y saneamiento%' OR
               Encabezado like '%sistema municipal de apa municipal%' OR
               Encabezado like '%comite de apa tapachula%' OR
               Encabezado like '%sistema municipal de apa%' OR
               Encabezado like '%sistemas municipal de aguas y saneamiento%' OR
               Encabezado like '%sistema municipal de agua y saneamiento de frontera%' OR
               Encabezado like '%sistemas municipal de agua potable y alcantarillado%' OR
               Encabezado like '%aguas de saltillo%' OR
               Encabezado like '%sistema municipal de aguas y saneamiento%' OR
               Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Encabezado like '%aguas de saltillo%' OR
               Encabezado like '%sistema municipal de aguas y saneamiento%' OR
               Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Encabezado like '%aguas de saltillo%' OR
               Encabezado like '%sistema municipal de aguas y saneamiento%' OR
               Encabezado like '%comision intermunicipal de agua potable y alcantarillado%' OR
               Encabezado like '%comision de agua potable y drenaje y alcantarillado%' OR
               Encabezado like '%sistema descentralizado de apa y saneamiento%' OR
               Encabezado like '%organismo publico descentralizado municipal de apa y smto%' OR
               Encabezado like '%comision de agua potable y alcantarillado%' OR
               Encabezado like '%sistema municipal de agua potable y alcantarillado de guanajuato%' OR
               Encabezado like '%junta de apa del municipio de irapuato%' OR
               Encabezado like '%sistema de apa de leon%' OR
               Encabezado like '%comite municipal de agua potable y alcantarillado y saneamiento%' OR
               Encabezado like '%comision de agua potable alcantarillado y saneamiento de municipio de ixmiquilpan de hidalgo%' OR
               Encabezado like '%general de comision estatal de agua y alcantarillado%' OR
               Encabezado like '%comision de agua y alcantarillado del municipio de tepeji de ocampo%' OR
               Encabezado like '%sistema municipal de los servicios de APA%' OR
               Encabezado like '%sistema de los servicios de agua potable drenaje y alcantarillado%' OR
               Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
               Encabezado like '%organismo municipal de servicios de agua potable%' OR
               Encabezado like '%comision de apa y saneamiento%' OR
               Encabezado like '%sistema de apa%' OR
               Encabezado like '%sistema ordenador de agua potable y saneamiento%' OR
               Encabezado like '%sistema de agua potable y alcantarillado de cuernavaca%' OR
               Encabezado like '%sistema municipal de agua potable emiliano zapata%' OR
               Encabezado like '%sistema de agua potable de huitzilac y tres marias%' OR
               Encabezado like '%sistema de conservacion de agua potable y saneamiento%' OR
               Encabezado like '%organismo operador municipal de agua potable de puente de ixtla%' OR
               Encabezado like '%sistema de agua potable y saneamiento de temixco%' OR
               Encabezado like '%sistema de agua potable alcantarilladom y saneamiento de xochitepe%' OR
               Encabezado like '%sistema de aguan potable y saneamiento de zacatepec%' OR
               Encabezado like '%sistema operador de los servicios de apa%' OR
               Encabezado like '%sistema operador de los servicios de apa%' OR
               Encabezado like '%junta de agua potable y alcantarillado municipal%' OR
               Encabezado like '%comision estatal de aguas%' OR
               Encabezado like '%comision de apa%' OR
               Encabezado like '%comision de agua potable y alcantarillado%' OR
               Encabezado like '%junta municipal de apa de culiacan%' OR
               Encabezado like '%junta municipal de agua potable y alcantarillado%' OR
               Encabezado like '%junta de apa del mpio%' OR
               Encabezado like '%junta municipal de apa%' OR
               Encabezado like '%direccion de apa y saneamiento%' OR
               Encabezado like '%comision municipal de agua potable%' OR
               Encabezado like '%comision de apa%' OR
               Encabezado like '%organismo operador municipal de apa y saneamiento%' OR
               Encabezado like '%comision municipal de agua potable%' OR
               Encabezado like '%agua de hermosillo%' OR
               Encabezado like '%organismo operador municiapal de apa y saneamiento%' OR
               Encabezado like '%junta de aguas y drenaje%' OR
               Encabezado like '%comision municipal de apa%' OR
               Encabezado like '%comision de apa del municipio de tlaxcala%' OR
               Encabezado like '%comision municipal de agua potable y saneamiento%' OR
               Encabezado like '%sas metropolitano%' OR
               Encabezado like '%comision de agua potable y alcantarillado%' OR
               Encabezado like '%junta de agua potable y alcantarillado%' OR
               Encabezado like '%sistema de agua potable y alcantarillado%' OR
               Encabezado like '%sistema de apa y smto%' OR
               Encabezado like '%junta intermunicipal de agua potable y alcantarillado de zacatecas%' OR
               Encabezado like '%acueducto%' OR
               Encabezado like '%canal de riego%' OR
               Encabezado like '%planta de tratamiento de aguas residuales%' OR
               Encabezado like '% PTAR %' OR
               Encabezado like '%Carcamo%' OR
               Encabezado like '%planta de bombeo%'

              )
			group by n.Periodico,n.NumeroPagina
				
UNION ALL
	SELECT '5' as Orden, 'Sector Medioambiental' as Tema, n.idEditorial,
	   p.Nombre as 'Periodico',n.Fecha,n.Titulo,n.Texto,
	   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	   p.Estado as 'NoEstado',
	   e.Nombre as 'Estado',
	   n.NumeroPagina,
	   s.seccion
	   FROM $Tabla n, (SELECT * FROM periodicos WHERE Estado = $estado) p,seccionesPeriodicos s,categoriasPeriodicos c, estados e
	   WHERE p.idPeriodico=n.Periodico AND
	   s.idSeccion=n.Seccion AND
	   c.idCategoria=n.Categoria AND
	   p.estado=e.idEstado AND (
               Texto like '% Semarnat %' OR
               Texto like '% Secretaria de medio ambiente y recursos naturales%' OR 
               Titulo like '% Secretaria de medio ambiente y recursos naturales%' OR 
               Titulo like '% Semarnat %' OR
               Encabezado like '% Secretaria de medio ambiente y recursos naturales%' OR 
               Encabezado like '% Semarnat %' OR

               Texto like '%CONAFOR%' OR
               Titulo like '%CONAFOR%' OR
               Encabezado like '%CONAFOR%' OR

               Texto like '%CONABIO%' OR
               Titulo like '%CONABIO%' OR
               Encabezado like '%CONABIO%' OR

               Texto like'%CONANP%'OR
               Titulo like'%CONANP%' OR
               Encabezado like '%CONANP%' OR

               Texto like '%PROFEPA%' OR
               Titulo like '%PROFEPA%' OR
               Encabezado like '%PROFEPA%' OR

               Texto like'% INE %' OR
               Texto like'%instituto nacional de ecologia%' OR
               Texto like '%clima%'  AND (Texto not like '%de violencia%')OR
               Titulo like'% INE %' OR
               Titulo like'%instituto nacional de ecologia%' OR
               Encabezado like '%instituto nacional de ecologia%' OR
               Encabezado like '% INE %' OR

               Texto like '%Instituto Mexicano De Tecnologia Del Agua%' OR
               Texto like '%IMTA%' OR
               Titulo like '%Instituto Mexicano De Tecnologia Del Agua%' OR
               Encabezado like '%Instituto Mexicano De Tecnologia Del Agua%'
        )
	     group by n.Periodico,n.NumeroPagina
)Derived
WHERE 
Fecha = DATE('$fechaTabla')
Group by Periodico,NumeroPagina
Order by Orden LIMIT $limit1,$limit2
";
            return $query;
            break;
        
        default:
            break;
    }
}
?>
