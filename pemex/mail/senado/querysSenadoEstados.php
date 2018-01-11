<?php

function numberNotes($optionCase, $fecha)
{
    $query = query($optionCase, $fecha);
    $resultado = mysql_query($query);
    if(mysql_num_rows($resultado) > 0)
    {
        return true;
    }
    return false;
}

function query($op,$fechaTabla,$estado){
  /*
    Menu de opciones de Personajes
    1.- GOBERNADOR
    2.- MUNICIPIOS
    3.- SENADORES
    4.- DIPUTADOS FEDERALES
    5.- DIPUTADOS LOCALES
    6.- PRIMERAS PLANAS
    7.- COLUMNAS
    8.- CARTONES
  *///Comentarios sobre opciones
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
        case 1://Gobernador
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
                      ".ordenamientoEstados($estado)." o,
                      periodicos p,
                      seccionesPeriodicos s
                    WHERE
                      ".queryBuilderGobernador($estado)." AND
                      n.Periodico=o.periodico AND
                      n.Periodico=p.idPeriodico AND
                      s.idSeccion = n.Seccion AND
                      n.Fecha='".$fecha."' AND
                      p.Estado=$estado AND
                      p.tipo=1
                    GROUP BY n.Periodico, n.NumeroPagina
                    ORDER BY n.Periodico limit 0,50";
            return $query;
            break;
        case 6:// PRIMERAS PLANAS
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
                      ".ordenamientoEstados($estado)." o,
                      periodicos p,
                      seccionesPeriodicos s
                    WHERE 
                      n.Periodico=o.periodico AND
                      n.Periodico=p.idPeriodico AND
                      n.Categoria=3 AND
                      s.idSeccion = n.Seccion AND
                      p.Estado=$estado AND
                      n.Fecha='".$fecha."'
                      GROUP BY p.idPeriodico, n.NumeroPagina
                      ORDER BY o.posicion";
            return $query;
            break;
    }
}


function queryBuilderGobernador($estado){
    $where="";
    switch($estado){
    case '14':
        $where="(
                Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
                Texto like '%Jorge Aristoteles Sandoval%' OR
                Texto like '%Jorge Sandoval Diaz%' OR
                Texto like '%Aristoteles Sandoval Diaz%' OR
                Texto like '%Aristoteles Sandoval%' OR
                Texto like '%gobernador del estado de jalisco%' OR
                Texto like '%gobernador de jalisco%' OR
                Texto like '%gobernador del estado Aristoteles Sandoval Diaz%'OR
                
                Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
                Titulo like '%Jorge Aristoteles Sandoval%' OR
                Titulo like '%Jorge Sandoval Diaz%' OR
                Titulo like '%Aristoteles Sandoval Diaz%' OR
                Titulo like '%Aristoteles Sandoval%' OR
                Titulo like '%gobernador del estado de jalisco%' OR
                Titulo like '%gobernador de jalisco%' OR
                Titulo like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

                Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
                Encabezado like '%Jorge Aristoteles Sandoval%' OR
                Encabezado like '%Jorge Sandoval Diaz%' OR
                Encabezado like '%Aristoteles Sandoval Diaz%' OR
                Encabezado like '%Aristoteles Sandoval%' OR
                Encabezado like '%gobernador del estado de jalisco%' OR
                Encabezado like '%gobernador de jalisco%' OR
                Encabezado like '%gobernador del estado Aristoteles Sandoval Diaz%' OR
                  
                PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
                PieFoto like '%Jorge Aristoteles Sandoval%' OR
                PieFoto like '%Jorge Sandoval Diaz%' OR
                PieFoto like '%Aristoteles Sandoval Diaz%' OR
                PieFoto like '%Aristoteles Sandoval%' OR
                PieFoto like '%gobernador del estado de jalisco%' OR
                PieFoto like '%gobernador de jalisco%' OR
                PieFoto like '%gobernador del estado Aristoteles Sandoval Diaz%' OR
                 
                Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
                Autor like '%Jorge Aristoteles Sandoval%' OR
                Autor like '%Jorge Sandoval Diaz%' OR
                Autor like '%Aristoteles Sandoval Diaz%' OR
                Autor like '%Aristoteles Sandoval%' OR
                Autor like '%gobernador del estado de jalisco%' OR
                Autor like '%gobernador de jalisco%' OR
                Autor like '%gobernador del estado Aristoteles Sandoval Diaz %'
            )";
    }
    return $where;
}

function queryBuilderMunicipios($estado){
  $where="";
    switch($estado){
    case '14':
        $where="(
          Texto like '%Guadalajara%' OR
          Texto like '%Tonala%' OR
          Texto like '%Zapopan%' OR
          Texto like '%Tlaquepaque%' OR
          Texto like '%Tlajomulco%' OR
          Texto like '%El Salto%' OR
          Texto like '%Ocotlan%' OR
          Texto like '%Municipio de la barca%' OR
          Texto like '%El grullo Jalisco%' OR
          Texto like '%Chapala%' OR
          Texto like '%Ayotlan%' OR
          Texto like '%Zapotlanejo%' OR
          Texto like '%Juanacatlan%' OR

          Titulo like '%Guadalajara%' OR
          Titulo like '%Tonala%' OR
          Titulo like '%Zapopan%' OR
          Titulo like '%Tlaquepaque%' OR
          Titulo like '%Tlajomulco%' OR
          Titulo like '%El Salto%' OR
          Titulo like '%Ocotlan%' OR
          Titulo like '%Municipio de la barca%' OR
          Titulo like '%El grullo Jalisco%' OR
          Titulo like '%Chapala%' OR
          Titulo like '%Ayotlan%' OR
          Titulo like '%Zapotlanejo%' OR
          Titulo like '%Juanacatlan%' OR

          Encabezado like '%Guadalajara%' OR
          Encabezado like '%Tonala%' OR
          Encabezado like '%Zapopan%' OR
          Encabezado like '%Tlaquepaque%' OR
          Encabezado like '%Tlajomulco%' OR
          Encabezado like '%El Salto%' OR
          Encabezado like '%Ocotlan%' OR
          Encabezado like '%Municipio de la barca%' OR
          Encabezado like '%El grullo Jalisco%' OR
          Encabezado like '%Chapala%' OR
          Encabezado like '%Ayotlan%' OR
          Encabezado like '%Zapotlanejo%' OR
          Encabezado like '%Juanacatlan%' OR

          PieFoto like '%Guadalajara%' OR
          PieFoto like '%Tonala%' OR
          PieFoto like '%Zapopan%' OR
          PieFoto like '%Tlaquepaque%' OR
          PieFoto like '%Tlajomulco%' OR
          PieFoto like '%El Salto%' OR
          PieFoto like '%Ocotlan%' OR
          PieFoto like '%Municipio de la barca%' OR
          PieFoto like '%El grullo Jalisco%' OR
          PieFoto like '%Chapala%' OR
          PieFoto like '%Ayotlan%' OR
          PieFoto like '%Zapotlanejo%' OR
          PieFoto like '%Juanacatlan%' OR

          Autor like '%Guadalajara%' OR
          Autor like '%Tonala%' OR
          Autor like '%Zapopan%' OR
          Autor like '%Tlaquepaque%' OR
          Autor like '%Tlajomulco%' OR
          Autor like '%El Salto%' OR
          Autor like '%Ocotlan%' OR
          Autor like '%Municipio de la barca%' OR
          Autor like '%El grullo Jalisco%' OR
          Autor like '%Chapala%' OR
          Autor like '%Ayotlan%' OR
          Autor like '%Zapotlanejo%' OR
          Autor like '%Juanacatlan%'
        )";
    }
    return $where;
}

function queryBuilderSenadores($estado){
  $where="";
    switch($estado){
    case '14':
        $where="(
          Texto like '%Jesus Casillas Romero%' OR
          Texto like '%Jesus Casillas%' OR
          Texto like '%Chuy Casillas%' OR
          Texto like '%jose Maria Martinez Martinez%' OR
          Texto like '%Chema Martinez%' OR
          Texto like '%maria Veronica Martinez Espinoza%' OR

          Titulo like '%Jesus Casillas Romero%' OR
          Titulo like '%Jesus Casillas%' OR
          Titulo like '%Chuy Casillas%' OR
          Titulo like '%jose Maria Martinez Martinez%' OR
          Titulo like '%Chema Martinez%' OR
          Titulo like '%maria Veronica Martinez Espinoza%' OR

          Encabezado like '%Jesus Casillas Romero%' OR
          Encabezado like '%Jesus Casillas%' OR
          Encabezado like '%Chuy Casillas%' OR
          Encabezado like '%jose Maria Martinez Martinez%' OR
          Encabezado like '%Chema Martinez%' OR
          Encabezado like '%maria Veronica Martinez Espinoza%' OR

          PieFoto like '%Jesus Casillas Romero%' OR
          PieFoto like '%Jesus Casillas%' OR
          PieFoto like '%Chuy Casillas%' OR
          PieFoto like '%jose Maria Martinez Martinez%' OR
          PieFoto like '%Chema Martinez%' OR
          PieFoto like '%maria Veronica Martinez Espinoza%' OR

          Autor like '%Jesus Casillas Romero%' OR
          Autor like '%Jesus Casillas%' OR
          Autor like '%Chuy Casillas%' OR
          Autor like '%jose Maria Martinez Martinez%' OR
          Autor like '%Chema Martinez%' OR
          Autor like '%maria Veronica Martinez Espinoza%'
          )";
    }
    return $where;
}


function queryBuilderDipFederales($estado){
  $where="";
    switch($estado){
    case '14':
        $where="(
              Texto like '%Ramon Banales Arambula%' OR
              Texto like '%Ramon Banales%' OR
              Texto like '%Banales Arambula%' OR
              Texto like '%Martha Lorena Covarrubias Anaya%' OR
              Texto like '%Martha Lorena Covarrubias%' OR
              Texto like '%Martha Covarrubias Anaya%' OR
              Texto like '%Covarrubias Anaya%' OR
              Texto like '%Hugo Daniel Gaeta Esparza%' OR
              Texto like '%Hugo Daniel Gaeta%' OR
              Texto like '%Hugo Gaeta Esparza%' OR
              Texto like '%Hugo Gaeta%' OR
              Texto like '%Gaeta Esparza%' OR
              Texto like '%Laura Valeria Guzman Vazquez%' OR
              Texto like '%Laura Valeria Guzman%' OR
              Texto like '%Laura Guzman Vazquez%' OR
              Texto like '%Guzman Vazquez%' OR
              Texto like '%Jose luis orozco sanchez aldana%' OR
              Texto like '%Jose luis orozco%' OR
              Texto like '%Jose orozco sanchez aldana%' OR
              Texto like '%luis orozco sanchez aldana%' OR
              Texto like '%orozco sanchez aldana%' OR
              Texto like '%Laura Nereida Plascencia Pacheco%' OR
              Texto like '%Laura Nereida Plascencia%' OR
              Texto like '%Laura Plascencia Pacheco%' OR
              Texto like '%Plascencia Pacheco%' OR
              Texto like '%Francisco Javier Santillan Oceguera%' OR
              Texto like '%Francisco Javier Santillan%' OR
              Texto like '%Francisco Santillan Oceguera%' OR
              Texto like '%Santillan Oceguera%' OR
              Texto like '%Maria Esther de Jesus Scherman Leaño%' OR
              Texto like '%Scherman Leaño%' OR
              Texto like '%Rafael Yerena Zambrano%' OR
              Texto like '%Rafael Yerena%' OR
              Texto like '%Yerena Zambrano%' OR
              Texto like '%Jesus Zuniga Mendoza%' OR
              Texto like '%Jesus Zuniga%' OR
              Texto like '%Zuniga Mendoza%' OR
              #Fin Diputados PRI  
              Texto like '%Mariana Arambula Melendez%' OR 
              Texto like '%Jose hernan Cortez Berumen%' OR  
              Texto like '%Herman Cortez%' OR 
              Texto like '%Cortez Berumen%' OR  
              Texto like '%Elias Octavio Iniguez Mejia%' OR 
              Texto like '%Elias Octavio Iniguez%' OR 
              Texto like '%Elias Iniguez Mejia%' OR
              Texto like '%Iniguez Mejia%' OR 
              #Fin Diputados PAN 
              Texto like '%Evelyng Soraya Flores Carranza%' OR  
              Texto like '%Evelyng Soraya Flores%' OR 
              Texto like '%Evelyng Flores Carranza%' OR 
              Texto like '%Flores Carranza%' OR 
              Texto like '%Jesus Sesma Suarez%' OR
              Texto like '%Jesus Sesma%' OR
              Texto like '%Sesma Suarez%' OR  
              #Fin Diputados Verde Ecologista
              Texto like '%Jorge alvarez Maynez%' OR
              Texto like '%alvarez Maynez%' OR  
              Texto like '%jose Clemente Castaneda Hoeflich%' OR
              Texto like '%jose Clemente Castaneda%' OR
              Texto like '%Clemente Castaneda Hoeflich%' OR
              Texto like '%Clemente Castaneda%' OR  
              Texto like '%Veronica Delgadillo%' OR
              Texto like '%Mirza Flores%' OR  
              Texto like '%Jonadab Martinez%' OR  
              Texto like '%Victoria Mercado Sanchez%' OR
              Texto like '%Luis Ernesto Munguia%' OR  
              Texto like '%Maria Candelaria Ochoa Avalos%' OR 
              Texto like '%German Ralis%' OR
              Texto like '%Rosa Alba Ramirez Nachis%' OR  
              Texto like '%Victor Manuel Sanchez Orozco%' OR  
              Texto like '%Macedonio Tamez Guajardo%' OR  
              Texto like '%Tamez Guajardo%' OR
              Texto like '%Salvador Zamora%' OR
              #Fin Diputados MC 
              Texto like '%Norma Edith Martinez Guzman%' OR

              
              Titulo like '%Ramon Banales Arambula%' OR
              Titulo like '%Ramon Banales%' OR
              Titulo like '%Banales Arambula%' OR
              Titulo like '%Martha Lorena Covarrubias Anaya%' OR
              Titulo like '%Martha Lorena Covarrubias%' OR
              Titulo like '%Martha Covarrubias Anaya%' OR
              Titulo like '%Covarrubias Anaya%' OR
              Titulo like '%Hugo Daniel Gaeta Esparza%' OR
              Titulo like '%Hugo Daniel Gaeta%' OR
              Titulo like '%Hugo Gaeta Esparza%' OR
              Titulo like '%Hugo Gaeta%' OR
              Titulo like '%Gaeta Esparza%' OR
              Titulo like '%Laura Valeria Guzman Vazquez%' OR
              Titulo like '%Laura Valeria Guzman%' OR
              Titulo like '%Laura Guzman Vazquez%' OR
              Titulo like '%Guzman Vazquez%' OR
              Titulo like '%Jose luis orozco sanchez aldana%' OR
              Titulo like '%Jose luis orozco%' OR
              Titulo like '%Jose orozco sanchez aldana%' OR
              Titulo like '%luis orozco sanchez aldana%' OR
              Titulo like '%orozco sanchez aldana%' OR
              Titulo like '%Laura Nereida Plascencia Pacheco%' OR
              Titulo like '%Laura Nereida Plascencia%' OR
              Titulo like '%Laura Plascencia Pacheco%' OR
              Titulo like '%Plascencia Pacheco%' OR
              Titulo like '%Francisco Javier Santillan Oceguera%' OR
              Titulo like '%Francisco Javier Santillan%' OR
              Titulo like '%Francisco Santillan Oceguera%' OR
              Titulo like '%Santillan Oceguera%' OR
              Titulo like '%Maria Esther de Jesus Scherman Leaño%' OR
              Titulo like '%Scherman Leaño%' OR
              Titulo like '%Rafael Yerena Zambrano%' OR
              Titulo like '%Rafael Yerena%' OR
              Titulo like '%Yerena Zambrano%' OR
              Titulo like '%Jesus Zuniga Mendoza%' OR
              Titulo like '%Jesus Zuniga%' OR
              Titulo like '%Zuniga Mendoza%' OR
              #Fin Diputados PRI  
              Titulo like '%Mariana Arambula Melendez%' OR  
              Titulo like '%Jose hernan Cortez Berumen%' OR 
              Titulo like '%Herman Cortez%' OR  
              Titulo like '%Cortez Berumen%' OR 
              Titulo like '%Elias Octavio Iniguez Mejia%' OR  
              Titulo like '%Elias Octavio Iniguez%' OR  
              Titulo like '%Elias Iniguez Mejia%' OR
              Titulo like '%Iniguez Mejia%' OR  
              #Fin Diputados PAN 
              Titulo like '%Evelyng Soraya Flores Carranza%' OR 
              Titulo like '%Evelyng Soraya Flores%' OR  
              Titulo like '%Evelyng Flores Carranza%' OR  
              Titulo like '%Flores Carranza%' OR  
              Titulo like '%Jesus Sesma Suarez%' OR
              Titulo like '%Jesus Sesma%' OR
              Titulo like '%Sesma Suarez%' OR 
              #Fin Diputados Verde Ecologista
              Titulo like '%Jorge alvarez Maynez%' OR
              Titulo like '%alvarez Maynez%' OR 
              Titulo like '%jose Clemente Castaneda Hoeflich%' OR
              Titulo like '%jose Clemente Castaneda%' OR
              Titulo like '%Clemente Castaneda Hoeflich%' OR
              Titulo like '%Clemente Castaneda%' OR 
              Titulo like '%Veronica Delgadillo%' OR
              Titulo like '%Mirza Flores%' OR 
              Titulo like '%Jonadab Martinez%' OR 
              Titulo like '%Victoria Mercado Sanchez%' OR
              Titulo like '%Luis Ernesto Munguia%' OR 
              Titulo like '%Maria Candelaria Ochoa Avalos%' OR  
              Titulo like '%German Ralis%' OR
              Titulo like '%Rosa Alba Ramirez Nachis%' OR 
              Titulo like '%Victor Manuel Sanchez Orozco%' OR 
              Titulo like '%Macedonio Tamez Guajardo%' OR 
              Titulo like '%Tamez Guajardo%' OR
              Titulo like '%Salvador Zamora%' OR
              #Fin Diputados MC 
              Titulo like '%Norma Edith Martinez Guzman%' OR


              Encabezado like '%Ramon Banales Arambula%' OR
              Encabezado like '%Ramon Banales%' OR
              Encabezado like '%Banales Arambula%' OR
              Encabezado like '%Martha Lorena Covarrubias Anaya%' OR
              Encabezado like '%Martha Lorena Covarrubias%' OR
              Encabezado like '%Martha Covarrubias Anaya%' OR
              Encabezado like '%Covarrubias Anaya%' OR
              Encabezado like '%Hugo Daniel Gaeta Esparza%' OR
              Encabezado like '%Hugo Daniel Gaeta%' OR
              Encabezado like '%Hugo Gaeta Esparza%' OR
              Encabezado like '%Hugo Gaeta%' OR
              Encabezado like '%Gaeta Esparza%' OR
              Encabezado like '%Laura Valeria Guzman Vazquez%' OR
              Encabezado like '%Laura Valeria Guzman%' OR
              Encabezado like '%Laura Guzman Vazquez%' OR
              Encabezado like '%Guzman Vazquez%' OR
              Encabezado like '%Jose luis orozco sanchez aldana%' OR
              Encabezado like '%Jose luis orozco%' OR
              Encabezado like '%Jose orozco sanchez aldana%' OR
              Encabezado like '%luis orozco sanchez aldana%' OR
              Encabezado like '%orozco sanchez aldana%' OR
              Encabezado like '%Laura Nereida Plascencia Pacheco%' OR
              Encabezado like '%Laura Nereida Plascencia%' OR
              Encabezado like '%Laura Plascencia Pacheco%' OR
              Encabezado like '%Plascencia Pacheco%' OR
              Encabezado like '%Francisco Javier Santillan Oceguera%' OR
              Encabezado like '%Francisco Javier Santillan%' OR
              Encabezado like '%Francisco Santillan Oceguera%' OR
              Encabezado like '%Santillan Oceguera%' OR
              Encabezado like '%Maria Esther de Jesus Scherman Leaño%' OR
              Encabezado like '%Scherman Leaño%' OR
              Encabezado like '%Rafael Yerena Zambrano%' OR
              Encabezado like '%Rafael Yerena%' OR
              Encabezado like '%Yerena Zambrano%' OR
              Encabezado like '%Jesus Zuniga Mendoza%' OR
              Encabezado like '%Jesus Zuniga%' OR
              Encabezado like '%Zuniga Mendoza%' OR
              #Fin Diputados PRI  
              Encabezado like '%Mariana Arambula Melendez%' OR  
              Encabezado like '%Jose hernan Cortez Berumen%' OR 
              Encabezado like '%Herman Cortez%' OR  
              Encabezado like '%Cortez Berumen%' OR 
              Encabezado like '%Elias Octavio Iniguez Mejia%' OR  
              Encabezado like '%Elias Octavio Iniguez%' OR  
              Encabezado like '%Elias Iniguez Mejia%' OR
              Encabezado like '%Iniguez Mejia%' OR  
              #Fin Diputados PAN 
              Encabezado like '%Evelyng Soraya Flores Carranza%' OR 
              Encabezado like '%Evelyng Soraya Flores%' OR  
              Encabezado like '%Evelyng Flores Carranza%' OR  
              Encabezado like '%Flores Carranza%' OR  
              Encabezado like '%Jesus Sesma Suarez%' OR
              Encabezado like '%Jesus Sesma%' OR
              Encabezado like '%Sesma Suarez%' OR 
              #Fin Diputados Verde Ecologista
              Encabezado like '%Jorge alvarez Maynez%' OR
              Encabezado like '%alvarez Maynez%' OR 
              Encabezado like '%jose Clemente Castaneda Hoeflich%' OR
              Encabezado like '%jose Clemente Castaneda%' OR
              Encabezado like '%Clemente Castaneda Hoeflich%' OR
              Encabezado like '%Clemente Castaneda%' OR 
              Encabezado like '%Veronica Delgadillo%' OR
              Encabezado like '%Mirza Flores%' OR 
              Encabezado like '%Jonadab Martinez%' OR 
              Encabezado like '%Victoria Mercado Sanchez%' OR
              Encabezado like '%Luis Ernesto Munguia%' OR 
              Encabezado like '%Maria Candelaria Ochoa Avalos%' OR  
              Encabezado like '%German Ralis%' OR
              Encabezado like '%Rosa Alba Ramirez Nachis%' OR 
              Encabezado like '%Victor Manuel Sanchez Orozco%' OR 
              Encabezado like '%Macedonio Tamez Guajardo%' OR 
              Encabezado like '%Tamez Guajardo%' OR
              Encabezado like '%Salvador Zamora%' OR
              #Fin Diputados MC 
              Encabezado like '%Norma Edith Martinez Guzman%' OR


              PieFoto like '%Ramon Banales Arambula%' OR
              PieFoto like '%Ramon Banales%' OR
              PieFoto like '%Banales Arambula%' OR
              PieFoto like '%Martha Lorena Covarrubias Anaya%' OR
              PieFoto like '%Martha Lorena Covarrubias%' OR
              PieFoto like '%Martha Covarrubias Anaya%' OR
              PieFoto like '%Covarrubias Anaya%' OR
              PieFoto like '%Hugo Daniel Gaeta Esparza%' OR
              PieFoto like '%Hugo Daniel Gaeta%' OR
              PieFoto like '%Hugo Gaeta Esparza%' OR
              PieFoto like '%Hugo Gaeta%' OR
              PieFoto like '%Gaeta Esparza%' OR
              PieFoto like '%Laura Valeria Guzman Vazquez%' OR
              PieFoto like '%Laura Valeria Guzman%' OR
              PieFoto like '%Laura Guzman Vazquez%' OR
              PieFoto like '%Guzman Vazquez%' OR
              PieFoto like '%Jose luis orozco sanchez aldana%' OR
              PieFoto like '%Jose luis orozco%' OR
              PieFoto like '%Jose orozco sanchez aldana%' OR
              PieFoto like '%luis orozco sanchez aldana%' OR
              PieFoto like '%orozco sanchez aldana%' OR
              PieFoto like '%Laura Nereida Plascencia Pacheco%' OR
              PieFoto like '%Laura Nereida Plascencia%' OR
              PieFoto like '%Laura Plascencia Pacheco%' OR
              PieFoto like '%Plascencia Pacheco%' OR
              PieFoto like '%Francisco Javier Santillan Oceguera%' OR
              PieFoto like '%Francisco Javier Santillan%' OR
              PieFoto like '%Francisco Santillan Oceguera%' OR
              PieFoto like '%Santillan Oceguera%' OR
              PieFoto like '%Maria Esther de Jesus Scherman Leaño%' OR
              PieFoto like '%Scherman Leaño%' OR
              PieFoto like '%Rafael Yerena Zambrano%' OR
              PieFoto like '%Rafael Yerena%' OR
              PieFoto like '%Yerena Zambrano%' OR
              PieFoto like '%Jesus Zuniga Mendoza%' OR
              PieFoto like '%Jesus Zuniga%' OR
              PieFoto like '%Zuniga Mendoza%' OR
              #Fin Diputados PRI  
              PieFoto like '%Mariana Arambula Melendez%' OR 
              PieFoto like '%Jose hernan Cortez Berumen%' OR  
              PieFoto like '%Herman Cortez%' OR 
              PieFoto like '%Cortez Berumen%' OR  
              PieFoto like '%Elias Octavio Iniguez Mejia%' OR 
              PieFoto like '%Elias Octavio Iniguez%' OR 
              PieFoto like '%Elias Iniguez Mejia%' OR
              PieFoto like '%Iniguez Mejia%' OR 
              #Fin Diputados PAN 
              PieFoto like '%Evelyng Soraya Flores Carranza%' OR  
              PieFoto like '%Evelyng Soraya Flores%' OR 
              PieFoto like '%Evelyng Flores Carranza%' OR 
              PieFoto like '%Flores Carranza%' OR 
              PieFoto like '%Jesus Sesma Suarez%' OR
              PieFoto like '%Jesus Sesma%' OR
              PieFoto like '%Sesma Suarez%' OR  
              #Fin Diputados Verde Ecologista
              PieFoto like '%Jorge alvarez Maynez%' OR
              PieFoto like '%alvarez Maynez%' OR  
              PieFoto like '%jose Clemente Castaneda Hoeflich%' OR
              PieFoto like '%jose Clemente Castaneda%' OR
              PieFoto like '%Clemente Castaneda Hoeflich%' OR
              PieFoto like '%Clemente Castaneda%' OR  
              PieFoto like '%Veronica Delgadillo%' OR
              PieFoto like '%Mirza Flores%' OR  
              PieFoto like '%Jonadab Martinez%' OR  
              PieFoto like '%Victoria Mercado Sanchez%' OR
              PieFoto like '%Luis Ernesto Munguia%' OR  
              PieFoto like '%Maria Candelaria Ochoa Avalos%' OR 
              PieFoto like '%German Ralis%' OR
              PieFoto like '%Rosa Alba Ramirez Nachis%' OR  
              PieFoto like '%Victor Manuel Sanchez Orozco%' OR  
              PieFoto like '%Macedonio Tamez Guajardo%' OR  
              PieFoto like '%Tamez Guajardo%' OR
              PieFoto like '%Salvador Zamora%' OR
              #Fin Diputados MC 
              PieFoto like '%Norma Edith Martinez Guzman%' 
            )";
    }
    return $where;
}


function queryBuilderDipLocales($estado){
  $where="";
    switch($estado){
    case '14':
        $where="(
           Texto like '%Felipe de Jesús Romo Cuéllar%' OR
           Texto like '%Irma de Anda Licea%' OR
           Texto like '%Isaias Cortés Berumen%' OR
           Texto like '%Maria del Pilar Perez Chavira%' OR
           Texto like '%Miguel Ángel Monraz Ibarra%' OR
           Texto like '%Antonio Lopez Orozco%' OR
           Texto like '%Claudia Delgadillo González%' OR
           Texto like '%Claudia Delgadillo%' OR
           Texto like '%Edgar Oswaldo Banales Orozco%' OR
           Texto like '%Oswaldo Bañales%' OR
           Texto like '%Hugo Contreras Zepeda%' OR
           Texto like '%Hugo Contreras%' OR
           Texto like '%Hugo René Ruiz Esparza Hermosillo%' OR
           Texto like '%Hugo René Ruiz Esparza%' OR
           Texto like '%Jorge Arana Arana%' OR
           Texto like '%Juana Ceballos Guzman%' OR
           Texto like '%Liliana Guadalupe Morones Vargas%' OR
           Texto like '%Lili Morones %' OR
           Texto like '%Maria del Refugio Ruiz Moreno%' OR
           Texto like '%Maria del Rocío Corona Nakamura%' OR
           Texto like '%Martha Susana Barajas del Toro%' OR
           Texto like '%Salvador Arellano Guzman%' OR
           Texto like '%Victoria Anahí Olguín Rojas%' OR 
           Texto like '%Anahí Olguín%' OR 
           Texto like '%Mónica Almeida López%' OR
           Texto like '%Saúl Galindo Plazola%' OR
           Texto like '%Erika Lizbeth Ramírez Pérez%' OR
           Texto like '%Omar Hernández Hernández%' OR
           Texto like '%Sergio Martín Arceo García%' OR
           Texto like '%Adriana Gabriela Medina Ortíz%' OR
           Texto like '%Augusto Valencia López%' OR
           Texto like '%Augusto Valencia%' OR
           Texto like '%Fela Patricia Pelayo Lopez%' OR
           Texto like '%Fela Patricia Pelayo%' OR
           Texto like '%Héctor Alejandro Hermosillo González%' OR
           Texto like '%Alejandro Hermosillo%' OR
           Texto like '%Ismael del Toro Castro%' OR
           Texto like '%Ismael del Toro%' OR
           Texto like '%Juan Carlos Anguiano Orozco%' OR
           Texto like '%Carlos Anguiano%' OR
           Texto like '%Kehila Abigail Ku Escalante%' OR
           Texto like '%Maria de Lourdes Martínez Pizano%' OR
           Texto like '%Maria del Consuelo Robles Sierra%' OR
           Texto like '%Maria Elena de Anda Gutiérrez%' OR
           Texto like '%Mario Hugo Castellanos Ibarra%' OR
           Texto like '%Martha Villanueva Nuñez%' OR
           Texto like '%Ramón Demetrio Guerrero Martínez%' OR
           Texto like '%José García Mora%' OR
           Texto like '%Hugo Rodríguez Díaz%' OR
           Texto like '%Jose Pedro Kumamoto Aguilar%' OR
           Texto like '%Pedro Kumamoto%' OR

           Titulo like '%Felipe de Jesús Romo Cuéllar%' OR
           Titulo like '%Irma de Anda Licea%' OR
           Titulo like '%Isaias Cortés Berumen%' OR
           Titulo like '%Maria del Pilar Perez Chavira%' OR
           Titulo like '%Miguel Ángel Monraz Ibarra%' OR
           Titulo like '%Antonio Lopez Orozco%' OR
           Titulo like '%Claudia Delgadillo González%' OR
           Titulo like '%Claudia Delgadillo%' OR
           Titulo like '%Edgar Oswaldo Banales Orozco%' OR
           Titulo like '%Oswaldo Bañales%' OR
           Titulo like '%Hugo Contreras Zepeda%' OR
           Titulo like '%Hugo Contreras%' OR
           Titulo like '%Hugo René Ruiz Esparza Hermosillo%' OR
           Titulo like '%Hugo René Ruiz Esparza%' OR
           Titulo like '%Jorge Arana Arana%' OR
           Titulo like '%Juana Ceballos Guzman%' OR
           Titulo like '%Liliana Guadalupe Morones Vargas%' OR
           Titulo like '%Lili Morones %' OR
           Titulo like '%Maria del Refugio Ruiz Moreno%' OR
           Titulo like '%Maria del Rocío Corona Nakamura%' OR
           Titulo like '%Martha Susana Barajas del Toro%' OR
           Titulo like '%Salvador Arellano Guzman%' OR
           Titulo like '%Victoria Anahí Olguín Rojas%' OR 
           Titulo like '%Anahí Olguín%' OR 
           Titulo like '%Mónica Almeida López%' OR
           Titulo like '%Saúl Galindo Plazola%' OR
           Titulo like '%Erika Lizbeth Ramírez Pérez%' OR
           Titulo like '%Omar Hernández Hernández%' OR
           Titulo like '%Sergio Martín Arceo García%' OR
           Titulo like '%Adriana Gabriela Medina Ortíz%' OR
           Titulo like '%Augusto Valencia López%' OR
           Titulo like '%Augusto Valencia%' OR
           Titulo like '%Fela Patricia Pelayo Lopez%' OR
           Titulo like '%Fela Patricia Pelayo%' OR
           Titulo like '%Héctor Alejandro Hermosillo González%' OR
           Titulo like '%Alejandro Hermosillo%' OR
           Titulo like '%Ismael del Toro Castro%' OR
           Titulo like '%Ismael del Toro%' OR
           Titulo like '%Juan Carlos Anguiano Orozco%' OR
           Titulo like '%Carlos Anguiano%' OR
           Titulo like '%Kehila Abigail Ku Escalante%' OR
           Titulo like '%Maria de Lourdes Martínez Pizano%' OR
           Titulo like '%Maria del Consuelo Robles Sierra%' OR
           Titulo like '%Maria Elena de Anda Gutiérrez%' OR
           Titulo like '%Mario Hugo Castellanos Ibarra%' OR
           Titulo like '%Martha Villanueva Nuñez%' OR
           Titulo like '%Ramón Demetrio Guerrero Martínez%' OR
           Titulo like '%José García Mora%' OR
           Titulo like '%Hugo Rodríguez Díaz%' OR
           Titulo like '%Jose Pedro Kumamoto Aguilar%' OR
           Titulo like '%Pedro Kumamoto%' OR

           Encabezado like '%Felipe de Jesús Romo Cuéllar%' OR
           Encabezado like '%Irma de Anda Licea%' OR
           Encabezado like '%Isaias Cortés Berumen%' OR
           Encabezado like '%Maria del Pilar Perez Chavira%' OR
           Encabezado like '%Miguel Ángel Monraz Ibarra%' OR
           Encabezado like '%Antonio Lopez Orozco%' OR
           Encabezado like '%Claudia Delgadillo González%' OR
           Encabezado like '%Claudia Delgadillo%' OR
           Encabezado like '%Edgar Oswaldo Banales Orozco%' OR
           Encabezado like '%Oswaldo Bañales%' OR
           Encabezado like '%Hugo Contreras Zepeda%' OR
           Encabezado like '%Hugo Contreras%' OR
           Encabezado like '%Hugo René Ruiz Esparza Hermosillo%' OR
           Encabezado like '%Hugo René Ruiz Esparza%' OR
           Encabezado like '%Jorge Arana Arana%' OR
           Encabezado like '%Juana Ceballos Guzman%' OR
           Encabezado like '%Liliana Guadalupe Morones Vargas%' OR
           Encabezado like '%Lili Morones %' OR
           Encabezado like '%Maria del Refugio Ruiz Moreno%' OR
           Encabezado like '%Maria del Rocío Corona Nakamura%' OR
           Encabezado like '%Martha Susana Barajas del Toro%' OR
           Encabezado like '%Salvador Arellano Guzman%' OR
           Encabezado like '%Victoria Anahí Olguín Rojas%' OR 
           Encabezado like '%Anahí Olguín%' OR 
           Encabezado like '%Mónica Almeida López%' OR
           Encabezado like '%Saúl Galindo Plazola%' OR
           Encabezado like '%Erika Lizbeth Ramírez Pérez%' OR
           Encabezado like '%Omar Hernández Hernández%' OR
           Encabezado like '%Sergio Martín Arceo García%' OR
           Encabezado like '%Adriana Gabriela Medina Ortíz%' OR
           Encabezado like '%Augusto Valencia López%' OR
           Encabezado like '%Augusto Valencia%' OR
           Encabezado like '%Fela Patricia Pelayo Lopez%' OR
           Encabezado like '%Fela Patricia Pelayo%' OR
           Encabezado like '%Héctor Alejandro Hermosillo González%' OR
           Encabezado like '%Alejandro Hermosillo%' OR
           Encabezado like '%Ismael del Toro Castro%' OR
           Encabezado like '%Ismael del Toro%' OR
           Encabezado like '%Juan Carlos Anguiano Orozco%' OR
           Encabezado like '%Carlos Anguiano%' OR
           Encabezado like '%Kehila Abigail Ku Escalante%' OR
           Encabezado like '%Maria de Lourdes Martínez Pizano%' OR
           Encabezado like '%Maria del Consuelo Robles Sierra%' OR
           Encabezado like '%Maria Elena de Anda Gutiérrez%' OR
           Encabezado like '%Mario Hugo Castellanos Ibarra%' OR
           Encabezado like '%Martha Villanueva Nuñez%' OR
           Encabezado like '%Ramón Demetrio Guerrero Martínez%' OR
           Encabezado like '%José García Mora%' OR
           Encabezado like '%Hugo Rodríguez Díaz%' OR
           Encabezado like '%Jose Pedro Kumamoto Aguilar%' OR
           Encabezado like '%Pedro Kumamoto%' OR


           PieFoto like '%Felipe de Jesús Romo Cuéllar%' OR
           PieFoto like '%Irma de Anda Licea%' OR
           PieFoto like '%Isaias Cortés Berumen%' OR
           PieFoto like '%Maria del Pilar Perez Chavira%' OR
           PieFoto like '%Miguel Ángel Monraz Ibarra%' OR
           PieFoto like '%Antonio Lopez Orozco%' OR
           PieFoto like '%Claudia Delgadillo González%' OR
           PieFoto like '%Claudia Delgadillo%' OR
           PieFoto like '%Edgar Oswaldo Banales Orozco%' OR
           PieFoto like '%Oswaldo Bañales%' OR
           PieFoto like '%Hugo Contreras Zepeda%' OR
           PieFoto like '%Hugo Contreras%' OR
           PieFoto like '%Hugo René Ruiz Esparza Hermosillo%' OR
           PieFoto like '%Hugo René Ruiz Esparza%' OR
           PieFoto like '%Jorge Arana Arana%' OR
           PieFoto like '%Juana Ceballos Guzman%' OR
           PieFoto like '%Liliana Guadalupe Morones Vargas%' OR
           PieFoto like '%Lili Morones %' OR
           PieFoto like '%Maria del Refugio Ruiz Moreno%' OR
           PieFoto like '%Maria del Rocío Corona Nakamura%' OR
           PieFoto like '%Martha Susana Barajas del Toro%' OR
           PieFoto like '%Salvador Arellano Guzman%' OR
           PieFoto like '%Victoria Anahí Olguín Rojas%' OR 
           PieFoto like '%Anahí Olguín%' OR 
           PieFoto like '%Mónica Almeida López%' OR
           PieFoto like '%Saúl Galindo Plazola%' OR
           PieFoto like '%Erika Lizbeth Ramírez Pérez%' OR
           PieFoto like '%Omar Hernández Hernández%' OR
           PieFoto like '%Sergio Martín Arceo García%' OR
           PieFoto like '%Adriana Gabriela Medina Ortíz%' OR
           PieFoto like '%Augusto Valencia López%' OR
           PieFoto like '%Augusto Valencia%' OR
           PieFoto like '%Fela Patricia Pelayo Lopez%' OR
           PieFoto like '%Fela Patricia Pelayo%' OR
           PieFoto like '%Héctor Alejandro Hermosillo González%' OR
           PieFoto like '%Alejandro Hermosillo%' OR
           PieFoto like '%Ismael del Toro Castro%' OR
           PieFoto like '%Ismael del Toro%' OR
           PieFoto like '%Juan Carlos Anguiano Orozco%' OR
           PieFoto like '%Carlos Anguiano%' OR
           PieFoto like '%Kehila Abigail Ku Escalante%' OR
           PieFoto like '%Maria de Lourdes Martínez Pizano%' OR
           PieFoto like '%Maria del Consuelo Robles Sierra%' OR
           PieFoto like '%Maria Elena de Anda Gutiérrez%' OR
           PieFoto like '%Mario Hugo Castellanos Ibarra%' OR
           PieFoto like '%Martha Villanueva Nuñez%' OR
           PieFoto like '%Ramón Demetrio Guerrero Martínez%' OR
           PieFoto like '%José García Mora%' OR
           PieFoto like '%Hugo Rodríguez Díaz%' OR
           PieFoto like '%Jose Pedro Kumamoto Aguilar%' OR
           PieFoto like '%Pedro Kumamoto%'
         )";
    }
    return $where;
}

function cuentanotas($personaje,$estado){
  $where="";
  $sql="";
  switch ($personaje) {
    case '1': //GOBERNADORES
        $where=queryBuilderGobernador($estado);   
    break;

    case '2': //Municipios
        $where=queryBuilderMunicipios($estado);
    break; 

    case '3': //Senadores
        $where=queryBuilderSenadores($estado);
    break; 

    case '4': //Diputados Federales
        $where=queryBuilderDipFederales($estado);
    break; 

    case '5': //Diputados Locales
        $where=queryBuilderDipLocales($estado);
    break; 
  }

  if($personaje<'6'){
      $sql="SELECT
            COUNT(idEditorial) 
          FROM
            noticiasDia n,
            periodicos p
          WHERE
            ".$where."AND
            p.idPeriodico=n.Periodico AND
            Fecha=CURDATE() AND
            n.Activo =1 AND
            p.Tipo=1 AND
            n.Categoria!=80 AND 
            p.Estado=".$estado;
  } else if ($personaje=='6'){//Primeras Planas
    $sql="SELECT
          COUNT(idEditorial) 
        FROM
          noticiasDia n,
          periodicos p
        WHERE 
          p.idPeriodico=n.Periodico AND
          Fecha=CURDATE() AND
          n.Activo =1 AND 
          p.Estado=".$estado." AND
          n.Categoria = 3";
  } else if ($personaje=='7'){//Columnas u opinion
    $sql="SELECT
          COUNT(idEditorial) 
        FROM
          noticiasDia n,
          periodicos p
        WHERE 
          p.idPeriodico=n.Periodico AND
          Fecha=CURDATE() AND
          n.Activo =1 AND 
          p.Estado=".$estado." AND
          n.Categoria in (1,20)";
  } else if ($personaje=='8'){//Cartones
    $sql="SELECT
          COUNT(idEditorial) 
        FROM
          noticiasDia n,
          periodicos p
        WHERE 
          p.idPeriodico=n.Periodico AND
          Fecha=CURDATE() AND
          n.Activo =1 AND 
          p.Estado=".$estado." AND
          n.Categoria = 18";
  }

   $resultado = mysql_query($sql);
   $fila = mysql_fetch_row($resultado);

  if(mysql_num_rows($resultado) > 0)
    {
        return $fila[0];
    }else{
      return 0;
    }
}

function ordenamientoEstados($estado){
  $orden="";
  switch ($estado) {
      case '14':
          $orden="ordenGeneraljalisco";  
      break;
      
      default:
        
        break;
    }
    return $orden;  
}


?>
