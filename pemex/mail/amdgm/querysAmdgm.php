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

function query($op,$Tabla){
       $fecha=$Tabla;
       $FechaCliente = strtotime($Tabla);
        
        $fecha_actual1 = date('Y-m-d');
        $fecha_actual = strtotime($fecha_actual1);
            
        if ($fecha == date('Y-m-d'))
        {
            $Tabla="noticiasDia";
        }
        else
        {
            $Tabla="noticiasSemana";
        }
        switch ($op){
          case 1:
            $query="SELECT
                      n.cutted,
                        n.Periodico as idPeriodico,
                        n.idEditorial,
                        n.Titulo,
                        p.Nombre as Periodico,
                      p.String_Name as StringName,
                        e.Nombre AS estado,
                        CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                        n.PaginaPeriodico,
                        s.seccion,
                        c.Categoria as Categoria,
                        n.Autor,
                        n.Texto,
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                        p.Estado=e.idEstado AND
                      n.Activo = 1 AND
                        fecha = CURDATE() AND(
                                      Texto like '%Asociacion Mexicana de Distribuidores General Motors%' OR 
                                      Texto like '%AMDGM%' OR
                                      
                                      Titulo like '%Asociacion Mexicana de Distribuidores General Motors%' OR 
                                      Titulo like '%AMDGM%' OR
                                      
                                      Encabezado like '%Asociacion Mexicana de Distribuidores General Motors%' OR 
                                      Encabezado like '%AMDGM%' OR
                                      
                                      PieFoto like '%Asociacion Mexicana de Distribuidores General Motors%' OR 
                                      PieFoto like '%AMDGM%' OR
                                      
                                      Autor like '%Asociacion Mexicana de Distribuidores General Motors%' OR 
                                      Autor like '%AMDGM%' 
                                      
                             )
                          ORDER BY o.posicion";
            return $query;  
        break;  

        case 2:
          $query="SELECT
                n.cutted,
                  n.Periodico as idPeriodico,
                  n.idEditorial,
                  n.Titulo,
                  p.Nombre as Periodico,
                p.String_Name as StringName,
                  e.Nombre AS estado,
                  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                  n.PaginaPeriodico,
                  s.seccion,
                  c.Categoria as Categoria,
                  n.Autor,
                  n.Texto,
                  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                  p.Estado=e.idEstado AND
                n.Activo = 1 AND
                  fecha = CURDATE() AND(
                                Texto like '%Raul Castillo Arteaga%' OR 
                                Texto like '%Castillo Arteaga%' OR
                                Texto like '%Presidente de AMDGM%' OR
                                
                                Titulo like '%Raul Castillo Arteaga%' OR 
                                Titulo like '%Castillo Arteaga%' OR
                                Titulo like '%Presidente de AMDGM%' OR
                                
                                Encabezado like '%Raul Castillo Arteaga%' OR 
                                Encabezado like '%Castillo Arteaga%' OR
                                Encabezado like '%Presidente de AMDGM%' OR
                                
                                PieFoto like '%Raul Castillo Arteaga%' OR 
                                PieFoto like '%Castillo Arteaga%' OR
                                PieFoto like '%Presidente de AMDGM%' OR
                                
                                Autor like '%Raul Castillo Arteaga%' OR 
                                Autor like '%Castillo Arteaga%' OR
                                Autor like '%Presidente de AMDGM%'         
                                
                       )
                ORDER BY o.posicion";
            return $query; 
        break;   

        case 3:
            $query="SELECT
                        n.cutted,
                          n.Periodico as idPeriodico,
                          n.idEditorial,
                          n.Titulo,
                          p.Nombre as Periodico,
                        p.String_Name as StringName,
                          e.Nombre AS estado,
                          CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                          n.PaginaPeriodico,
                          s.seccion,
                          c.Categoria as Categoria,
                          n.Autor,
                          n.Texto,
                          CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                          CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                          p.Estado=e.idEstado AND
                        n.Activo = 1 AND
                          fecha = CURDATE() AND(
                                        Texto like '%Chevrolet%' OR 

                                        Titulo like '%Chevrolet%' OR 

                                        Encabezado like '%Chevrolet%' OR 

                                        Autor like '%Chevrolet%' OR 

                                        PieFoto like '%Chevrolet%'
                                                
                        )
                        ORDER BY o.posicion";
            return $query;  
        break;  

        case 4:
          $query="SELECT
                  n.cutted,
                    n.Periodico as idPeriodico,
                    n.idEditorial,
                    n.Titulo,
                    p.Nombre as Periodico,
                  p.String_Name as StringName,
                    e.Nombre AS estado,
                    CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                    n.PaginaPeriodico,
                    s.seccion,
                    c.Categoria as Categoria,
                    n.Autor,
                    n.Texto,
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                    p.Estado=e.idEstado AND
                  n.Activo = 1 AND
                    fecha = CURDATE() AND(
                                  Texto like '%Cadillac%' OR 

                                  Titulo like '%Cadillac%' OR 

                                  Encabezado like '%Cadillac%' OR 

                                  Autor like '%Cadillac%' OR 

                                  PieFoto like '%Cadillac%'
                                          
                  )
                  ORDER BY o.posicion";
            return $query; 
        break; 

        case 5://CUTZAMALA - DF 
            $query="SELECT
                        n.cutted,
                          n.Periodico as idPeriodico,
                          n.idEditorial,
                          n.Titulo,
                          p.Nombre as Periodico,
                        p.String_Name as StringName,
                          e.Nombre AS estado,
                          CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                          n.PaginaPeriodico,
                          s.seccion,
                          c.Categoria as Categoria,
                          n.Autor,
                          n.Texto,
                          CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                          CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                          p.Estado=e.idEstado AND
                        n.Activo = 1 AND
                          fecha = CURDATE() AND(
                            Texto like '% GMC %' OR
                            Texto like '%General motors Company%' OR
                            Texto like '%General motors%' OR

                            Titulo like '% GMC %' OR
                            Titulo like '%General motors Company%' OR
                            Titulo like '%General motors%' OR

                            Encabezado like '% GMC %' OR
                            Encabezado like '%General motors Company%' OR
                            Encabezado like '%General motors%' OR

                            PieFoto like '% GMC %' OR
                            PieFoto like '%General motors Company%' OR
                            PieFoto like '%General motors%' OR

                            Autor like '% GMC %' OR
                            Autor like '%General motors Company%' OR
                            Autor like '%General motors%' 
                          )
                        ORDER BY o.posicion";
            return $query;  
        break;  

        case 6://CUTZAMALA - Estados
          $query="SELECT
                n.cutted,
                  n.Periodico as idPeriodico,
                  n.idEditorial,
                  n.Titulo,
                  p.Nombre as Periodico,
                p.String_Name as StringName,
                  e.Nombre AS estado,
                  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                  n.PaginaPeriodico,
                  s.seccion,
                  c.Categoria as Categoria,
                  n.Autor,
                  n.Texto,
                  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                  p.Estado=e.idEstado AND
                n.Activo = 1 AND
                  fecha = CURDATE() AND(
                                Texto like '%Buick%' OR 

                                Titulo like '%Buick%' OR 

                                Encabezado like '%Buick%' OR 

                                Autor like '%Buick%' OR 

                                PieFoto like '%Buick%'
                                        
                )
                ORDER BY o.posicion";
            return $query; 
        break; 


        case 7:
            $query="SELECT
                      n.cutted,
                        n.Periodico as idPeriodico,
                        n.idEditorial,
                        n.Titulo,
                        p.Nombre as Periodico,
                      p.String_Name as StringName,
                        e.Nombre AS estado,
                        CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                        n.PaginaPeriodico,
                        s.seccion,
                        c.Categoria as Categoria,
                        n.Autor,
                        n.Texto,
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                        p.Estado=e.idEstado AND
                      n.Activo = 1 AND
                        fecha = CURDATE() AND (
                          Texto like '%Industria automotriz%' OR 
                          Texto like '%avances automotrices%' OR
                          Texto like '%Venta de Autos%' OR
                          Texto like '%Mercado para autos%' OR
                          Texto like '%Unidades chocolate%' OR
                          Texto like '%Automoviles Chocolate%' OR
                          Texto like '%Autos Chocolate%' OR
                          Texto like '%Asociacion Mexicana de Distribuidores Automotores%' OR

                          Titulo like '%Industria automotriz%' OR 
                          Titulo like '%avances automotrices%' OR 
                          Titulo like '%Venta de Autos%' OR
                          Titulo like '%Mercado para autos%' OR
                          Titulo like '%Unidades chocolate%' OR
                          Titulo like '%Automoviles Chocolate%' OR
                          Titulo like '%Autos Chocolate%' OR
                          Titulo like '%Asociacion Mexicana de Distribuidores Automotores%' OR

                          Encabezado like '%avances automotrices%' OR 
                          Encabezado like '%Industria automotriz%' OR 
                          Encabezado like '%Venta de Autos%' OR
                          Encabezado like '%Mercado para autos%' OR
                          Encabezado like '%Unidades chocolate%' OR
                          Encabezado like '%Automoviles Chocolate%' OR
                          Encabezado like '%Autos Chocolate%' OR
                          Encabezado like '%Asociacion Mexicana de Distribuidores Automotores%' OR

                          Autor like '%Industria automotriz%' OR 
                          Autor like '%avances automotrices%' OR 
                          Autor like '%Venta de Autos%' OR
                          Autor like '%Mercado para autos%' OR
                          Autor like '%Unidades chocolate%' OR
                          Autor like '%Automoviles Chocolate%' OR
                          Autor like '%Autos Chocolate%' OR
                          Autor like '%Asociacion Mexicana de Distribuidores Automotores%' OR

                          PieFoto like '%Industria automotriz%' OR 
                          PieFoto like '%avances automotrices%' OR
                          PieFoto like '%Venta de Autos%' OR
                          PieFoto like '%Mercado para autos%' OR
                          PieFoto like '%Unidades chocolate%' OR
                          PieFoto like '%Automoviles Chocolate%' OR
                          PieFoto like '%Autos Chocolate%' OR
                          PieFoto like '%Asociacion Mexicana de Distribuidores Automotores%'

                        )
                      ORDER BY o.posicion";
            return $query;  
        break;  

        case 8:
          $query="SELECT
                  n.cutted,
                    n.Periodico as idPeriodico,
                    n.idEditorial,
                    n.Titulo,
                    p.Nombre as Periodico,
                  p.String_Name as StringName,
                    e.Nombre AS estado,
                    CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                    n.PaginaPeriodico,
                    s.seccion,
                    c.Categoria as Categoria,
                    n.Autor,
                    n.Texto,
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                    p.Estado=e.idEstado AND
                  n.Activo = 1 AND
                    fecha = CURDATE() AND(
                                  Texto like '%CHRYSLER%' OR 
                                  Texto like '%FIAT%' OR 
                                  Texto like 'FORD' OR 
                                  Texto like 'HONDA' OR 
                                  Texto like '%HYUNDAI%' OR 
                                  Texto like 'KIA' OR 
                                  Texto like '%MERCEDES BENZ%' OR
                                  Texto like '%MITSUBISHI%' OR
                                  Texto like '%NISSAN%' OR
                                  Texto like '%PEUGEOT%' OR
                                  Texto like '%RENAULT%' OR
                                  Texto like '%SUZUKI%' OR
                                  Texto like '%TOYOTA%' OR
                                  Texto like '%VOLVO%' OR
                                  Texto like '%VOLKSWAGEN%' OR

                                  Titulo like '%CHRYSLER%' OR 
                                  Titulo like '%FIAT%' OR 
                                  Titulo like 'FORD' OR 
                                  Titulo like 'HONDA' OR 
                                  Titulo like '%HYUNDAI%' OR 
                                  Titulo like 'KIA' OR 
                                  Titulo like '%MERCEDES BENZ%' OR
                                  Titulo like '%MITSUBISHI%' OR
                                  Titulo like '%NISSAN%' OR
                                  Titulo like '%PEUGEOT%' OR
                                  Titulo like '%RENAULT%' OR
                                  Titulo like '%SUZUKI%' OR
                                  Titulo like '%TOYOTA%' OR
                                  Titulo like '%VOLVO%' OR
                                  Titulo like '%VOLKSWAGEN%' OR

                                  Encabezado like '%CHRYSLER%' OR 
                                  Encabezado like '%FIAT%' OR 
                                  Encabezado like 'FORD' OR 
                                  Encabezado like 'HONDA' OR 
                                  Encabezado like '%HYUNDAI%' OR 
                                  Encabezado like 'KIA' OR 
                                  Encabezado like '%MERCEDES BENZ%' OR
                                  Encabezado like '%MITSUBISHI%' OR
                                  Encabezado like '%NISSAN%' OR
                                  Encabezado like '%PEUGEOT%' OR
                                  Encabezado like '%RENAULT%' OR
                                  Encabezado like '%SUZUKI%' OR
                                  Encabezado like '%TOYOTA%' OR
                                  Encabezado like '%VOLVO%' OR
                                  Encabezado like '%VOLKSWAGEN%' OR

                                  Autor like '%CHRYSLER%' OR 
                                  Autor like '%FIAT%' OR 
                                  Autor like 'FORD' OR 
                                  Autor like 'HONDA' OR 
                                  Autor like '%HYUNDAI%' OR 
                                  Autor like 'KIA' OR 
                                  Autor like '%MERCEDES BENZ%' OR
                                  Autor like '%MITSUBISHI%' OR
                                  Autor like '%NISSAN%' OR
                                  Autor like '%PEUGEOT%' OR
                                  Autor like '%RENAULT%' OR
                                  Autor like '%SUZUKI%' OR
                                  Autor like '%TOYOTA%' OR
                                  Autor like '%VOLVO%' OR
                                  Autor like '%VOLKSWAGEN%' OR

                                  PieFoto like '%CHRYSLER%' OR 
                                  PieFoto like '%FIAT%' OR 
                                  PieFoto like 'FORD' OR 
                                  PieFoto like 'HONDA' OR 
                                  PieFoto like '%HYUNDAI%' OR 
                                  PieFoto like 'KIA' OR 
                                  PieFoto like '%MERCEDES BENZ%' OR
                                  PieFoto like '%MITSUBISHI%' OR
                                  PieFoto like '%NISSAN%' OR
                                  PieFoto like '%PEUGEOT%' OR
                                  PieFoto like '%RENAULT%' OR
                                  PieFoto like '%SUZUKI%' OR
                                  PieFoto like '%TOYOTA%' OR
                                  PieFoto like '%VOLVO%' OR
                                  PieFoto like '%VOLKSWAGEN%'


                                  
                                          
                  )
                  ORDER BY o.posicion";
            return $query; 
        break;   

        case 9:
            $query="SELECT
                n.cutted,
                  n.Periodico as idPeriodico,
                  n.idEditorial,
                  n.Titulo,
                  p.Nombre as Periodico,
                p.String_Name as StringName,
                  e.Nombre AS estado,
                  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                  n.PaginaPeriodico,
                  s.seccion,
                  c.Categoria as Categoria,
                  n.Autor,
                  n.Texto,
                  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                    p.Estado=e.idEstado AND
                  n.Activo = 1 AND
                    fecha = CURDATE() AND(
                      Texto like '%CHRYSLER%' OR
                      Texto like '%Shire y Daimler Chrysler%' OR
                      Texto like '%planta de la automotriz Chrysler%' OR

                      Titulo like '%CHRYSLER%' OR
                      Titulo like '%Shire y Daimler Chrysler%' OR
                      Titulo like '%planta de la automotriz Chrysler%' OR
                      
                      Encabezado like '%CHRYSLER%' OR
                      Encabezado like '%Shire y Daimler Chrysler%' OR
                      Encabezado like '%planta de la automotriz Chrysler%' OR
                      
                      PieFoto like '%CHRYSLER%' OR
                      PieFoto like '%Shire y Daimler Chrysler%' OR
                      PieFoto like '%planta de la automotriz Chrysler%' OR
                      
                      Autor like '%CHRYSLER%' OR
                      Autor like '%Shire y Daimler Chrysler%' OR
                      Autor like '%planta de la automotriz Chrysler%'
                    )
                ORDER BY o.posicion";
            return $query;  
        break;  

        case 10:
          $query="SELECT
                    n.cutted,
                      n.Periodico as idPeriodico,
                      n.idEditorial,
                      n.Titulo,
                      p.Nombre as Periodico,
                    p.String_Name as StringName,
                      e.Nombre AS estado,
                      CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                      n.PaginaPeriodico,
                      s.seccion,
                      c.Categoria as Categoria,
                      n.Autor,
                      n.Texto,
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                        p.Estado=e.idEstado AND
                      n.Activo = 1 AND
                        fecha = CURDATE() AND (
                          Texto like '%fiat%' OR

                          Titulo like '%fiat%' OR
                          
                          Encabezado like '%fiat%' OR
                          
                          PieFoto like '%fiat%' OR
                          
                          Autor like '%fiat%'
                        )
                    ORDER BY o.posicion";
            return $query; 
        break; 

        case 11:
            $query="SELECT
                    n.cutted,
                      n.Periodico as idPeriodico,
                      n.idEditorial,
                      n.Titulo,
                      p.Nombre as Periodico,
                    p.String_Name as StringName,
                      e.Nombre AS estado,
                      CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                      n.PaginaPeriodico,
                      s.seccion,
                      c.Categoria as Categoria,
                      n.Autor,
                      n.Texto,
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                        p.Estado=e.idEstado AND
                      n.Activo = 1 AND
                        fecha = CURDATE() AND (
                          Texto like '% ford %' OR

                          Titulo like '% ford %' OR
                          
                          Encabezado like '% ford %' OR
                          
                          PieFoto like '% ford %' OR
                          
                          Autor like '% ford %'
                        )
                    ORDER BY o.posicion";
            return $query;  
        break;  

        case 12:
          $query="SELECT
                    n.cutted,
                      n.Periodico as idPeriodico,
                      n.idEditorial,
                      n.Titulo,
                      p.Nombre as Periodico,
                    p.String_Name as StringName,
                      e.Nombre AS estado,
                      CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                      n.PaginaPeriodico,
                      s.seccion,
                      c.Categoria as Categoria,
                      n.Autor,
                      n.Texto,
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                        p.Estado=e.idEstado AND
                      n.Activo = 1 AND
                        fecha = CURDATE() AND (
                          Texto like '% honda %' OR

                          Titulo like '% honda %' OR
                          
                          Encabezado like '% honda %' OR
                          
                          PieFoto like '% honda %' OR
                          
                          Autor like '% honda %'
                        )
                    ORDER BY o.posicion";
            return $query; 
        break; 

        case 13:
            $query="SELECT
                  n.cutted,
                    n.Periodico as idPeriodico,
                    n.idEditorial,
                    n.Titulo,
                    p.Nombre as Periodico,
                  p.String_Name as StringName,
                    e.Nombre AS estado,
                    CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                    n.PaginaPeriodico,
                    s.seccion,
                    c.Categoria as Categoria,
                    n.Autor,
                    n.Texto,
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                      fecha = CURDATE() AND (
                        Texto like '% Hyundai %' OR

                        Titulo like '% Hyundai %' OR
                        
                        Encabezado like '% Hyundai %' OR
                        
                        PieFoto like '% Hyundai %' OR
                        
                        Autor like '% Hyundai %'
                      )";
            return $query;  
        break;  

        case 14:
          $query="SELECT
                n.cutted,
                  n.Periodico as idPeriodico,
                  n.idEditorial,
                  n.Titulo,
                  p.Nombre as Periodico,
                p.String_Name as StringName,
                  e.Nombre AS estado,
                  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                  n.PaginaPeriodico,
                  s.seccion,
                  c.Categoria as Categoria,
                  n.Autor,
                  n.Texto,
                  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                    p.Estado=e.idEstado AND
                  n.Activo = 1 AND
                    fecha = CURDATE() AND (
                      Texto like '% kia %' OR

                      Titulo like '% kia %' OR
                      
                      Encabezado like '% kia %' OR
                      
                      PieFoto like '% kia %' OR
                      
                      Autor like '% kia %'
                    )
                ORDER BY o.posicion";
            return $query; 
        break;   

        case 15:
            $query="SELECT
                      n.cutted,
                        n.Periodico as idPeriodico,
                        n.idEditorial,
                        n.Titulo,
                        p.Nombre as Periodico,
                      p.String_Name as StringName,
                        e.Nombre AS estado,
                        CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                        n.PaginaPeriodico,
                        s.seccion,
                        c.Categoria as Categoria,
                        n.Autor,
                        n.Texto,
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                          p.Estado=e.idEstado AND
                        n.Activo = 1 AND
                          fecha = CURDATE() AND (
                            Texto like '%Mercedes Benz%' OR
                            Texto like '%Mercedes-Benz%' OR
                            Texto like '%Mercedes - Benz%' OR

                            Titulo like '%Mercedes Benz%' OR
                            Titulo like '%Mercedes-Benz%' OR
                            Titulo like '%Mercedes - Benz%' OR
                            
                            Encabezado like '%Mercedes Benz%' OR
                            Encabezado like '%Mercedes-Benz%' OR
                            Encabezado like '%Mercedes - Benz%' OR
                            
                            PieFoto like '%Mercedes Benz%' OR
                            PieFoto like '%Mercedes-Benz%' OR
                            PieFoto like '%Mercedes - Benz%' OR
                            
                            Autor like '%Mercedes Benz%' OR
                            Autor like '%Mercedes-Benz%' OR
                            Autor like '%Mercedes - Benz%'
                          )
                      ORDER BY o.posicion";
            return $query;  
        break;  

        case 16:
          $query="SELECT
                    n.cutted,
                      n.Periodico as idPeriodico,
                      n.idEditorial,
                      n.Titulo,
                      p.Nombre as Periodico,
                    p.String_Name as StringName,
                      e.Nombre AS estado,
                      CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                      n.PaginaPeriodico,
                      s.seccion,
                      c.Categoria as Categoria,
                      n.Autor,
                      n.Texto,
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                        p.Estado=e.idEstado AND
                      n.Activo = 1 AND
                        fecha = CURDATE() AND (
                          Texto like '%Mitsubishi%' OR
                          
                          Titulo like '%Mitsubishi%' OR
                          
                          Encabezado like '%Mitsubishi%' OR
                          
                          PieFoto like '%Mitsubishi%' OR
                                
                          Autor like '%Mitsubishi%'
                        )
                    ORDER BY o.posicion";
            return $query; 
        break; 

        case 17://CUTZAMALA - DF 
            $query="SELECT
                    n.cutted,
                      n.Periodico as idPeriodico,
                      n.idEditorial,
                      n.Titulo,
                      p.Nombre as Periodico,
                    p.String_Name as StringName,
                      e.Nombre AS estado,
                      CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                      n.PaginaPeriodico,
                      s.seccion,
                      c.Categoria as Categoria,
                      n.Autor,
                      n.Texto,
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                      CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                        p.Estado=e.idEstado AND
                      n.Activo = 1 AND
                        fecha = CURDATE() AND (
                          Texto like '%Nissan%' OR
                          
                          Titulo like '%Nissan%' OR
                          
                          Encabezado like '%Nissan%' OR
                          
                          PieFoto like '%Nissan%' OR
                                
                          Autor like '%Nissan%'
                        )
                    ORDER BY o.posicion";
            return $query;  
        break;  

        case 18://CUTZAMALA - Estados
          $query="SELECT
                  n.cutted,
                    n.Periodico as idPeriodico,
                    n.idEditorial,
                    n.Titulo,
                    p.Nombre as Periodico,
                  p.String_Name as StringName,
                    e.Nombre AS estado,
                    CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                    n.PaginaPeriodico,
                    s.seccion,
                    c.Categoria as Categoria,
                    n.Autor,
                    n.Texto,
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                      fecha = CURDATE() AND (
                        Texto like '%Peugeot%' OR
                        
                        Titulo like '%Peugeot%' OR
                        
                        Encabezado like '%Peugeot%' OR
                        
                        PieFoto like '%Peugeot%' OR
                              
                        Autor like '%Peugeot%'
                      )
                  ORDER BY o.posicion";
            return $query; 
        break; 
        case 19:
          $query="SELECT
                  n.cutted,
                    n.Periodico as idPeriodico,
                    n.idEditorial,
                    n.Titulo,
                    p.Nombre as Periodico,
                  p.String_Name as StringName,
                    e.Nombre AS estado,
                    CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                    n.PaginaPeriodico,
                    s.seccion,
                    c.Categoria as Categoria,
                    n.Autor,
                    n.Texto,
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                      fecha = CURDATE() AND (
                        Texto like '%Renault%' OR
                        
                        Titulo like '%Renault%' OR
                        
                        Encabezado like '%Renault%' OR
                        
                        PieFoto like '%Renault%' OR
                              
                        Autor like '%Renault%'
                      )
                  ORDER BY o.posicion";
            return $query; 
        break; 
        case 20:
          $query="SELECT
                  n.cutted,
                    n.Periodico as idPeriodico,
                    n.idEditorial,
                    n.Titulo,
                    p.Nombre as Periodico,
                  p.String_Name as StringName,
                    e.Nombre AS estado,
                    CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                    n.PaginaPeriodico,
                    s.seccion,
                    c.Categoria as Categoria,
                    n.Autor,
                    n.Texto,
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                      p.Estado=e.idEstado AND
                    n.Activo = 1 AND
                      fecha = CURDATE() AND (
                        Texto like '%Suzuki%' OR
                        
                        Titulo like '%Suzuki%' OR
                        
                        Encabezado like '%Suzuki%' OR
                        
                        PieFoto like '%Suzuki%' OR
                              
                        Autor like '%Suzuki%'
                      )
                  ORDER BY o.posicion";
            return $query; 
        break; 

         case 21://CUTZAMALA - DF 
            $query="SELECT
                      n.cutted,
                        n.Periodico as idPeriodico,
                        n.idEditorial,
                        n.Titulo,
                        p.Nombre as Periodico,
                      p.String_Name as StringName,
                        e.Nombre AS estado,
                        CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                        n.PaginaPeriodico,
                        s.seccion,
                        c.Categoria as Categoria,
                        n.Autor,
                        n.Texto,
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                          p.Estado=e.idEstado AND
                        n.Activo = 1 AND
                          fecha = CURDATE() AND (
                            Texto like '%Toyota%' OR
                            
                            Titulo like '%Toyota%' OR
                            
                            Encabezado like '%Toyota%' OR
                            
                            PieFoto like '%Toyota%' OR
                                  
                            Autor like '%Toyota%'
                          )
                      ORDER BY o.posicion";
            return $query;  
        break;  

         case 22://CUTZAMALA - DF 
            $query="SELECT
                      n.cutted,
                        n.Periodico as idPeriodico,
                        n.idEditorial,
                        n.Titulo,
                        p.Nombre as Periodico,
                      p.String_Name as StringName,
                        e.Nombre AS estado,
                        CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                        n.PaginaPeriodico,
                        s.seccion,
                        c.Categoria as Categoria,
                        n.Autor,
                        n.Texto,
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                          p.Estado=e.idEstado AND
                        n.Activo = 1 AND
                          fecha = CURDATE() AND (
                            Texto like '%Volvo%' OR
                            
                            Titulo like '%Volvo%' OR
                            
                            Encabezado like '%Volvo%' OR
                            
                            PieFoto like '%Volvo%' OR
                                  
                            Autor like '%Volvo%'
                          )
                      ORDER BY o.posicion";
            return $query;  
        break;  

         case 23://CUTZAMALA - DF 
            $query="SELECT
                      n.cutted,
                        n.Periodico as idPeriodico,
                        n.idEditorial,
                        n.Titulo,
                        p.Nombre as Periodico,
                      p.String_Name as StringName,
                        e.Nombre AS estado,
                        CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
                        n.PaginaPeriodico,
                        s.seccion,
                        c.Categoria as Categoria,
                        n.Autor,
                        n.Texto,
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
                          p.Estado=e.idEstado AND
                        n.Activo = 1 AND
                          fecha = CURDATE() AND (
                            Texto like '%Volkswagen%' OR
                            
                            Titulo like '%Volkswagen%' OR
                            
                            Encabezado like '%Volkswagen%' OR
                            
                            PieFoto like '%Volkswagen%' OR
                                  
                            Autor like '%Volkswagen%'
                          )
                      ORDER BY o.posicion";
            return $query;  
        break;  

    }
}

?>
