<?php // content="text/plain; charset=utf-8"

/*
require_once ('/var/www/external/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/mail/conexion.php';
*/


require_once ('/var/www/external/services/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/services/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/services/mail/conexion.php';


function tablaContador($contador,$contadorWeb,&$Duplicados,&$conteo)
{
  $notas = mysql_num_rows(mysql_query($contador));
  $notasWeb = mysql_num_rows(mysql_query($contadorWeb));

  $conteo[] = intval($notas);
  $conteo[] = intval($notasWeb);

  $addNotes = mysql_query($contador);
  while($row = mysql_fetch_row($addNotes))
  {
    $Duplicados[] = $row[0];
  }
  $addNotes = mysql_query($contadorWeb);
  while($row2 = mysql_fetch_row($addNotes))
  {
    $Duplicados[] = $row2[0];
  }
}

$conteo_Notas = array();
$idDuplicados = array(0);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
          Texto LIKE '% INEE%' OR
          Texto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Texto LIKE '%Margarita Maria zorrilla fierro%' OR
        Texto LIKE '%Margarita zorrilla fierro%' OR
        Texto LIKE '%zorrilla fierro%' OR
        Texto LIKE '%Eduardo Backhoff escudero%' OR
        Texto LIKE '%Backhoff escudero%' OR
        Texto like '%Sylvia Schmelkes%' OR
        Texto like '%Sylvia Schmelkes del valle%' OR
        Texto like '%Schmelkes del valle%' OR
        Texto like '%Gilberto Ramon Guevara Niebla%' OR
        Texto like '%Gilberto Guevara Niebla%' OR
        Texto like '%Guevara Niebla%' OR
        Texto like '%Teresa bracho gonzalez%' OR
        Texto like '%bracho gonzalez%' OR


          Titulo LIKE '% INEE%' OR
          Titulo LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Titulo LIKE '%Margarita Maria zorrilla fierro%' OR
        Titulo LIKE '%Margarita zorrilla fierro%' OR
        Titulo LIKE '%zorrilla fierro%' OR
        Titulo LIKE '%Eduardo Backhoff escudero%' OR
        Titulo LIKE '%Backhoff escudero%' OR
        Titulo like '%Sylvia Schmelkes%' OR
        Titulo like '%Sylvia Schmelkes del valle%' OR
        Titulo like '%Schmelkes del valle%' OR
        Titulo like '%Gilberto Ramon Guevara Niebla%' OR
        Titulo like '%Gilberto Guevara Niebla%' OR
        Titulo like '%Guevara Niebla%' OR
        Titulo like '%Teresa bracho gonzalez%' OR
        Titulo like '%bracho gonzalez%' OR

          Encabezado LIKE '% INEE%' OR
          Encabezado LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Encabezado LIKE '%Margarita Maria zorrilla fierro%' OR
        Encabezado LIKE '%Margarita zorrilla fierro%' OR
        Encabezado LIKE '%zorrilla fierro%' OR
        Encabezado LIKE '%Eduardo Backhoff escudero%' OR
        Encabezado LIKE '%Backhoff escudero%' OR
        Encabezado like '%Sylvia Schmelkes%' OR
        Encabezado like '%Sylvia Schmelkes del valle%' OR
        Encabezado like '%Schmelkes del valle%' OR
        Encabezado like '%Gilberto Ramon Guevara Niebla%' OR
        Encabezado like '%Gilberto Guevara Niebla%' OR
        Encabezado like '%Guevara Niebla%' OR
        Encabezado like '%Teresa bracho gonzalez%' OR
        Encabezado like '%bracho gonzalez%' OR
          
          PieFoto LIKE '%INEE%' OR
          PieFoto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          PieFoto LIKE '%Margarita Maria zorrilla fierro%' OR
        PieFoto LIKE '%Margarita zorrilla fierro%' OR
        PieFoto LIKE '%zorrilla fierro%' OR
        PieFoto LIKE '%Eduardo Backhoff escudero%' OR
        PieFoto LIKE '%Backhoff escudero%' OR
        PieFoto like '%Sylvia Schmelkes%' OR
        PieFoto like '%Sylvia Schmelkes del valle%' OR
        PieFoto like '%Schmelkes del valle%' OR
        PieFoto like '%Gilberto Ramon Guevara Niebla%' OR
        PieFoto like '%Gilberto Guevara Niebla%' OR
        PieFoto like '%Guevara Niebla%' OR
        PieFoto like '%Teresa bracho gonzalez%' OR
        PieFoto like '%bracho gonzalez%'
         )
  ORDER BY o.posicion";


  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
          Texto LIKE '% INEE%' OR
          Texto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Texto LIKE '%Margarita Maria zorrilla fierro%' OR
        Texto LIKE '%Margarita zorrilla fierro%' OR
        Texto LIKE '%zorrilla fierro%' OR
        Texto LIKE '%Eduardo Backhoff escudero%' OR
        Texto LIKE '%Backhoff escudero%' OR
        Texto like '%Sylvia Schmelkes%' OR
        Texto like '%Sylvia Schmelkes del valle%' OR
        Texto like '%Schmelkes del valle%' OR
        Texto like '%Gilberto Ramon Guevara Niebla%' OR
        Texto like '%Gilberto Guevara Niebla%' OR
        Texto like '%Guevara Niebla%' OR
        Texto like '%Teresa bracho gonzalez%' OR
        Texto like '%bracho gonzalez%' OR


          Titulo LIKE '% INEE%' OR
          Titulo LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Titulo LIKE '%Margarita Maria zorrilla fierro%' OR
        Titulo LIKE '%Margarita zorrilla fierro%' OR
        Titulo LIKE '%zorrilla fierro%' OR
        Titulo LIKE '%Eduardo Backhoff escudero%' OR
        Titulo LIKE '%Backhoff escudero%' OR
        Titulo like '%Sylvia Schmelkes%' OR
        Titulo like '%Sylvia Schmelkes del valle%' OR
        Titulo like '%Schmelkes del valle%' OR
        Titulo like '%Gilberto Ramon Guevara Niebla%' OR
        Titulo like '%Gilberto Guevara Niebla%' OR
        Titulo like '%Guevara Niebla%' OR
        Titulo like '%Teresa bracho gonzalez%' OR
        Titulo like '%bracho gonzalez%' OR

          Encabezado LIKE '% INEE%' OR
          Encabezado LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          Encabezado LIKE '%Margarita Maria zorrilla fierro%' OR
        Encabezado LIKE '%Margarita zorrilla fierro%' OR
        Encabezado LIKE '%zorrilla fierro%' OR
        Encabezado LIKE '%Eduardo Backhoff escudero%' OR
        Encabezado LIKE '%Backhoff escudero%' OR
        Encabezado like '%Sylvia Schmelkes%' OR
        Encabezado like '%Sylvia Schmelkes del valle%' OR
        Encabezado like '%Schmelkes del valle%' OR
        Encabezado like '%Gilberto Ramon Guevara Niebla%' OR
        Encabezado like '%Gilberto Guevara Niebla%' OR
        Encabezado like '%Guevara Niebla%' OR
        Encabezado like '%Teresa bracho gonzalez%' OR
        Encabezado like '%bracho gonzalez%' OR
          
          PieFoto LIKE '% INEE%' OR
          PieFoto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR
          PieFoto LIKE '%Margarita Maria zorrilla fierro%' OR
        PieFoto LIKE '%Margarita zorrilla fierro%' OR
        PieFoto LIKE '%zorrilla fierro%' OR
        PieFoto LIKE '%Eduardo Backhoff escudero%' OR
        PieFoto LIKE '%Backhoff escudero%' OR
        PieFoto like '%Sylvia Schmelkes%' OR
        PieFoto like '%Sylvia Schmelkes del valle%' OR
        PieFoto like '%Schmelkes del valle%' OR
        PieFoto like '%Gilberto Ramon Guevara Niebla%' OR
        PieFoto like '%Gilberto Guevara Niebla%' OR
        PieFoto like '%Guevara Niebla%' OR
        PieFoto like '%Teresa bracho gonzalez%' OR
        PieFoto like '%bracho gonzalez%'
         )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Texto LIKE '%Sylvia Schmelkes del Valle%' OR
      Titulo LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Titulo LIKE '%Sylvia Schmelkes del Valle%' OR
      Encabezado LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Encabezado LIKE '%Sylvia Schmelkes del Valle%' OR

      Texto LIKE '%Margarita María Zorrilla Fierro%' OR
      Texto LIKE '%Margarita Zorrilla Fierro%' OR
      Titulo LIKE '%Margarita María Zorrilla Fierro%' OR
      Titulo LIKE '%Margarita Zorrilla Fierro%' OR
      Encabezado LIKE '%Margarita María Zorrilla Fierro%' OR
      Encabezado LIKE '%Margarita Zorrilla Fierro%' OR

      Texto LIKE '%Teresa Bracho González%' OR
      Titulo LIKE '%Teresa Bracho González%' OR
      Encabezado LIKE '%Teresa Bracho González%' OR

      Texto LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Texto LIKE '%Gilberto Guevara Niebla%' OR
      Titulo LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Titulo LIKE '%Gilberto Guevara Niebla%' OR
      Encabezado LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Encabezado LIKE '%Gilberto Guevara Niebla%' OR

      Texto LIKE '%Eduardo Backhoff Escudero%' OR
      Titulo LIKE '%Eduardo Backhoff Escudero%' OR
      Encabezado LIKE '%Eduardo Backhoff Escudero%' OR

      Texto LIKE '%Francisco Miranda López%' OR
      Titulo LIKE '%Francisco Miranda López%' OR
      Encabezado LIKE '%Francisco Miranda López%'  OR

      Texto LIKE '%Jorge Antonio Hernández Uralde%' OR
      Texto LIKE '%Jorge Hernández Uralde%' OR
      Titulo LIKE '%Jorge Antonio Hernández Uralde%' OR
      Titulo LIKE '%Jorge Hernández Uralde%' OR
      Encabezado LIKE '%Jorge Antonio Hernández Uralde%' OR
      Encabezado LIKE '%Jorge Hernández Uralde%' OR

      Texto LIKE '%Agustín Caso Raphael%' OR
      Titulo LIKE '%Agustín Caso Raphael%' OR
      Encabezado LIKE '%Agustín Caso Raphael%' OR

      Texto LIKE '%Luis Castillo Montes%' OR
      Titulo LIKE '%Luis Castillo Montes%' OR
      Encabezado LIKE '%Luis Castillo Montes%'
    )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Texto LIKE '%Sylvia Schmelkes del Valle%' OR
      Titulo LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Titulo LIKE '%Sylvia Schmelkes del Valle%' OR
      Encabezado LIKE '%Sylvia Irene Schmelkes del Valle%' OR
      Encabezado LIKE '%Sylvia Schmelkes del Valle%' OR

      Texto LIKE '%Margarita María Zorrilla Fierro%' OR
      Texto LIKE '%Margarita Zorrilla Fierro%' OR
      Titulo LIKE '%Margarita María Zorrilla Fierro%' OR
      Titulo LIKE '%Margarita Zorrilla Fierro%' OR
      Encabezado LIKE '%Margarita María Zorrilla Fierro%' OR
      Encabezado LIKE '%Margarita Zorrilla Fierro%' OR

      Texto LIKE '%Teresa Bracho González%' OR
      Titulo LIKE '%Teresa Bracho González%' OR
      Encabezado LIKE '%Teresa Bracho González%' OR

      Texto LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Texto LIKE '%Gilberto Guevara Niebla%' OR
      Titulo LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Titulo LIKE '%Gilberto Guevara Niebla%' OR
      Encabezado LIKE '%Gilberto Ramón Guevara Niebla%' OR
      Encabezado LIKE '%Gilberto Guevara Niebla%' OR

      Texto LIKE '%Eduardo Backhoff Escudero%' OR
      Titulo LIKE '%Eduardo Backhoff Escudero%' OR
      Encabezado LIKE '%Eduardo Backhoff Escudero%' OR

      Texto LIKE '%Francisco Miranda López%' OR
      Titulo LIKE '%Francisco Miranda López%' OR
      Encabezado LIKE '%Francisco Miranda López%'  OR

      Texto LIKE '%Jorge Antonio Hernández Uralde%' OR
      Texto LIKE '%Jorge Hernández Uralde%' OR
      Titulo LIKE '%Jorge Antonio Hernández Uralde%' OR
      Titulo LIKE '%Jorge Hernández Uralde%' OR
      Encabezado LIKE '%Jorge Antonio Hernández Uralde%' OR
      Encabezado LIKE '%Jorge Hernández Uralde%' OR

      Texto LIKE '%Agustín Caso Raphael%' OR
      Titulo LIKE '%Agustín Caso Raphael%' OR
      Encabezado LIKE '%Agustín Caso Raphael%' OR

      Texto LIKE '%Luis Castillo Montes%' OR
      Titulo LIKE '%Luis Castillo Montes%' OR
      Encabezado LIKE '%Luis Castillo Montes%'
    )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE '%Reforma Educativa%' OR

      Titulo LIKE '%Reforma Educativa%' OR

      Encabezado LIKE '%Reforma Educativa%'
    )
  ORDER BY o.posicion";


  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE '%Reforma Educativa%' OR

      Titulo LIKE '%Reforma Educativa%' OR

      Encabezado LIKE '%Reforma Educativa%'
    )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE 'SEN' OR
      Texto LIKE '%Sistema Educativo Nacional%' OR
        
      Titulo LIKE 'SEN' OR
      Titulo LIKE '%Sistema Educativo Nacional%' OR
      
      Encabezado LIKE 'SEN' OR
      Encabezado LIKE '%Sistema Educativo Nacional%'
    )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE 'SEN' OR
      Texto LIKE '%Sistema Educativo Nacional%' OR
        
      Titulo LIKE 'SEN' OR
      Titulo LIKE '%Sistema Educativo Nacional%' OR
      
      Encabezado LIKE 'SEN' OR
      Encabezado LIKE '%Sistema Educativo Nacional%'
    )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE 'SNEE' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
      Titulo LIKE 'SNEE' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
      
      Encabezado LIKE 'SNEE' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
    )
  ORDER BY o.posicion";


  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE 'SNEE' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
      Titulo LIKE 'SNEE' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
      
      Encabezado LIKE 'SNEE' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
    )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Política Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Política Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Política Nacional de Evaluación Educativa%'
      )
  ORDER BY o.posicion";


  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Política Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Política Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Política Nacional de Evaluación Educativa%'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR
          
        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR
        
        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
      )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR
          
        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR
        
        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE '%prueba enlace%' OR
      Texto LIKE '%prueba excale%' OR
      Texto LIKE '%prueba pisa%' OR
      Texto LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Texto LIKE '%Programme for International Student Assessment%' OR
      Texto LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Texto LIKE '%Exámen de la Calidad y el Logro Educativo%' OR

      Titulo LIKE '%prueba enlace%' OR
      Titulo LIKE '%prueba excale%' OR
      Titulo LIKE '%prueba pisa%' OR
      Titulo LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Titulo LIKE '%Programme for International Student Assessment%' OR
      Titulo LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Titulo LIKE '%Exámen de la Calidad y el Logro Educativo%' OR

      Encabezado LIKE '%prueba enlace%' OR
      Encabezado LIKE '%prueba excale%' OR
      Encabezado LIKE '%prueba pisa%' OR
      Encabezado LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Encabezado LIKE '%Programme for International Student Assessment%' OR
      Encabezado LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Encabezado LIKE '%Exámen de la Calidad y el Logro Educativo%'

      )
  ORDER BY o.posicion";


  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE '%prueba enlace%' OR
      Texto LIKE '%prueba excale%' OR
      Texto LIKE '%prueba pisa%' OR
      Texto LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Texto LIKE '%Programme for International Student Assessment%' OR
      Texto LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Texto LIKE '%Exámen de la Calidad y el Logro Educativo%' OR

      Titulo LIKE '%prueba enlace%' OR
      Titulo LIKE '%prueba excale%' OR
      Titulo LIKE '%prueba pisa%' OR
      Titulo LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Titulo LIKE '%Programme for International Student Assessment%' OR
      Titulo LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Titulo LIKE '%Exámen de la Calidad y el Logro Educativo%' OR

      Encabezado LIKE '%prueba enlace%' OR
      Encabezado LIKE '%prueba excale%' OR
      Encabezado LIKE '%prueba pisa%' OR
      Encabezado LIKE '%Evaluación Nacional de Logro Académico en Centros Escolares%' OR
      Encabezado LIKE '%Programme for International Student Assessment%' OR
      Encabezado LIKE '%Programa para la Evaluación Internacional de los Estudiantes%' OR
      Encabezado LIKE '%Exámen de la Calidad y el Logro Educativo%'

      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Evaluación educativa%' OR
      Texto LIKE '%Evaluación de la educación%' OR
          
        Titulo LIKE '%Evaluación educativa%' OR
      Titulo LIKE '%Evaluación de la educación%' OR
        
        Encabezado LIKE '%Evaluación educativa%' OR
      Encabezado LIKE '%Evaluación de la educación%'
      )
  ORDER BY o.posicion";


  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Evaluación educativa%' OR
      Texto LIKE '%Evaluación de la educación%' OR
          
        Titulo LIKE '%Evaluación educativa%' OR
      Titulo LIKE '%Evaluación de la educación%' OR
        
        Encabezado LIKE '%Evaluación educativa%' OR
      Encabezado LIKE '%Evaluación de la educación%'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
      )
  ORDER BY o.posicion";


  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Texto LIKE '%CONSCEE%' OR
          
        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Titulo LIKE '%CONSCEE%' OR
        
        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Encabezado LIKE '%CONSCEE%'
      )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Texto LIKE '%CONSCEE%' OR
          
        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Titulo LIKE '%CONSCEE%' OR
        
        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Encabezado LIKE '%CONSCEE%'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Texto LIKE 'CONVIE' OR
        
      Titulo LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Titulo LIKE 'CONVIE' OR
      
      Encabezado LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Encabezado LIKE 'CONVIE'
    )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
      Texto LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Texto LIKE 'CONVIE' OR
        
      Titulo LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Titulo LIKE 'CONVIE' OR
      
      Encabezado LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Encabezado LIKE 'CONVIE'
    )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Texto LIKE 'CONPEE' OR
          
        Titulo LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Titulo LIKE 'CONPEE' OR
        
        Encabezado LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Encabezado LIKE 'CONPEE'
      )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Texto LIKE 'CONPEE' OR
          
        Titulo LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Titulo LIKE 'CONPEE' OR
        
        Encabezado LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Encabezado LIKE 'CONPEE'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Consejos Técnicos Especializados%' OR
      Texto LIKE 'CONTE' OR
          
        Titulo LIKE '%Consejos Técnicos Especializados%' OR
      Titulo LIKE 'CONTE' OR
        
        Encabezado LIKE '%Consejos Técnicos Especializados%' OR
      Encabezado LIKE 'CONTE'
      )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE '%Consejos Técnicos Especializados%' OR
      Texto LIKE 'CONTE' OR
          
        Titulo LIKE '%Consejos Técnicos Especializados%' OR
      Titulo LIKE 'CONTE' OR
        
        Encabezado LIKE '%Consejos Técnicos Especializados%' OR
      Encabezado LIKE 'CONTE'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE ' SEP ' OR
        Texto LIKE '%Secretaría de Educación Pública%' OR
          
        Titulo LIKE ' SEP ' OR
        Titulo LIKE '%Secretaría de Educación Pública%' OR
        
        Encabezado LIKE ' SEP ' OR
        Encabezado LIKE '%Secretaría de Educación Pública%'
      )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE ' SEP ' OR
        Texto LIKE '%Secretaría de Educación Pública%' OR
          
        Titulo LIKE ' SEP ' OR
        Titulo LIKE '%Secretaría de Educación Pública%' OR
        
        Encabezado LIKE ' SEP ' OR
        Encabezado LIKE '%Secretaría de Educación Pública%'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE 'SNTE' OR
        Texto LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
          
        Titulo LIKE 'SNTE' OR
        Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
        
        Encabezado LIKE 'SNTE' OR
        Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educación%'
      )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
        Texto LIKE 'SNTE' OR
        Texto LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
          
        Titulo LIKE 'SNTE' OR
        Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
        
        Encabezado LIKE 'SNTE' OR
        Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educación%'
      )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

//QUERY INEE
$qryContador="SELECT
      n.idEditorial
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneral o
    WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
            Texto LIKE 'CNTE' OR
            Texto LIKE '%CNTE%' OR
            Texto LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%' OR

            Titulo LIKE 'CNTE' OR
            Titulo LIKE '%CNTE%' OR
            Titulo LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%' OR

            Encabezado LIKE 'CNTE' OR
            Encabezado LIKE '%CNTE%' OR
            Encabezado LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%'
        )
  ORDER BY o.posicion";

  //QUERY INEE
$qryContadorWeb="SELECT
    n.idEditorial
 FROM
        noticiasDia n
      WHERE
        n.Categoria=80 AND
        n.Activo = 1 AND
        n.idEditorial NOT IN(".implode(",", $idDuplicados).") AND
        fecha = CURDATE() AND (
            Texto LIKE 'CNTE' OR
            Texto LIKE '%CNTE%' OR
            Texto LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%' OR

            Titulo LIKE 'CNTE' OR
            Titulo LIKE '%CNTE%' OR
            Titulo LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%' OR

            Encabezado LIKE 'CNTE' OR
            Encabezado LIKE '%CNTE%' OR
            Encabezado LIKE '%Coordinadora Nacional de Trabajadores de la Educacion%'
        )";

tablaContador($qryContador,$qryContadorWeb,$idDuplicados,$conteo_Notas);

/***********Fin Querys Contadores***********/

echo "INEE: ".$conteo_Notas[0]."<br>";
echo "INEE Web: ".$conteo_Notas[1]."<br>";
echo "Funcionarios: ".$conteo_Notas[2]."<br>";
echo "Funcionarios Web: ".$conteo_Notas[3]."<br>";
echo "Reforma Educativa: ".$conteo_Notas[4]."<br>";
echo "Reforma Educativa Web: ".$conteo_Notas[5]."<br>";
echo "SEN: ".$conteo_Notas[6]."<br>";
echo "SEN Web: ".$conteo_Notas[7]."<br>";
echo "SNEE: ".$conteo_Notas[8]."<br>";
echo "SNEE Web: ".$conteo_Notas[9]."<br>";
echo "PNEE: ".$conteo_Notas[10]."<br>";
echo "PNEE Web: ".$conteo_Notas[11]."<br>";
echo "SPD: ".$conteo_Notas[12]."<br>";
echo "SPD Web: ".$conteo_Notas[13]."<br>";
echo "PRUEBA: ".$conteo_Notas[14]."<br>";
echo "PRUEBA Web: ".$conteo_Notas[15]."<br>";
echo "Conferencia: ".$conteo_Notas[16]."<br>";
echo "Conferencia Web: ".$conteo_Notas[17]."<br>";
echo "CONSCEE: ".$conteo_Notas[18]."<br>";
echo "CONSCEE Web: ".$conteo_Notas[19]."<br>";
echo "CONVIE: ".$conteo_Notas[20]."<br>";
echo "CONVIE Web: ".$conteo_Notas[21]."<br>";
echo "CONPEE: ".$conteo_Notas[22]."<br>";
echo "CONPEE Web: ".$conteo_Notas[23]."<br>";
echo "CONTE: ".$conteo_Notas[24]."<br>";
echo "CONTE Web: ".$conteo_Notas[25]."<br>";
echo "SEP: ".$conteo_Notas[26]."<br>";
echo "SEP Web: ".$conteo_Notas[27]."<br>";
echo "SNTE: ".$conteo_Notas[28]."<br>";
echo "SNTE Web: ".$conteo_Notas[29]."<br>";
echo "CNTE: ".$conteo_Notas[30]."<br>";
echo "CNTE Web: ".$conteo_Notas[31]."<br>";

// Leyendas Grafica
$legends = array("INEE","Funcionarios","Reforma Educativa","SEN","SNEE","PNEE","SPD","PRUEBA","Conferencia","CONSCEE","CONVIE","CONPEE","CONTE","SEP","SNTE","CNTE");
// Create the Pie Graph.
$graph = new PieGraph(600,350);
$graph->SetShadow();

// Set A title for the plot
//$graph->title->Set("Notas Precandidatos Guadalajara");
 
$graph->title->SetColor("brown");

// Create pie plot
$p1 = new PiePlot($conteo_Notas);

//$p1->SetTheme("sand");
$p1->SetLabelPos(0.6);
$p1->SetSize(0.3);
$p1->SetLegends($legends);

$graph->legend->Pos(0.07,0.8);

// Set how many pixels each slice should explode
$p1->ExplodeAll(30);


$graph->Add($p1);
$p1->SetSliceColors(array('#F21D24','#C300FF','#6600FF','#0043FF','#0094FF','#00D0FF','#00EDFF','#00FFD4','#00FF87','#00FF04','#F2FF00','#FFAE00','#FF8300','#A80808','#08A80B','#08A898'));

$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
 
// Stroke image to a file and browser
 
// Default is PNG so use ".png" as suffix
//$fileName = "/var/www/external/mail/inee/graficaINEE.png";
$fileName = "/var/www/external/services/mail/inee/graficaINEE.png";
$graph->img->Stream($fileName);
 
// Send it back to browser
//$graph->img->Headers();
//$graph->img->Stream();

?>


