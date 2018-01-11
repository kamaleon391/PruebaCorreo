
<?php

error_reporting(E_ALL);

// Notificar todos los errores de PHP
error_reporting(-1);

//require 'config.php';
require "/var/www/external/services/mail/conexion.php";

mysql_query("set names 'utf8'");

$urlP = "http://187.247.253.5";
//$urlP = "http://192.168.3.154";

function highlight($cadena, $arr_palabras) {
  if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
    return false;
  }
  $str_palabras = implode ('|', $arr_palabras);
  //return preg_replace ('/'.$str_palabras.'/si', '<strong style="background-color:yellow">$1</strong>', $cadena);
  return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
}


function recuperaDatos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";

    $result =  mysql_query($sql);

    if(mysql_affected_rows() > 0)
    {
        $mensaje ='
                <tr>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
                <tr>
                  <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.$titulo.'</th>
               </tr>
               <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {
            
            $texto = correctorOrtografico(sanear_string2($row['Texto']));
            $texto=  textMatchV2($texto, $buscar);
            $texto = ( !empty($buscar) )? highlight( $texto  , $buscar) :  $texto ; 


            $periodico = correctorOrtografico( $row['Periodico'] );
            $periodico = ( !empty($buscar) )? highlight( $periodico, $buscar) : $periodico;

            $autor = '';
            switch( ($periodico) )
            {
                case "Excelsior":
                    $periodico = "Excélsior";
                    $autor="Excélsior";
                break;
            
                case "El milenio Nacional":
                    $periodico = "Milenio";
                    $autor="Milenio";
                break;

                case "El Reforma":
                    $periodico = "Reforma";
                    $autor="Reforma";
                break;

                case "La Razon":
                    $periodico = "La Razón";
                    $autor="La Razón";
                break;

                case "La Cronica":
                    $periodico = "La Crónica";
                    $autor="La Crónica";
                break;
            
                case "el sol de mexico":
                    $periodico = "El Sol de México";
                    $autor="El Sol de México";
                break;
            
                case "Reporte Indigo Df":
                    $periodico = "Reporte Índigo";
                    $autor="Reporte Índigo";
                break;
            
                case "Punto critico":
                    $periodico = "Punto Crítico";
                    $autor="Punto Crítico";
                break;
            
                case "la prensa":
                    $periodico = "La Prensa";
                    $autor="La Prensa";
                break;
            
                case "Mundo expres":
                    $periodico = "Mundo Expres";
                    $autor="Mundo Expres";
                break;
            }


            $titulo = correctorOrtografico( $row['Titulo'] );
            $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;

            $encabezado = correctorOrtografico( $row['Encabezado'] );
            $encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;

            $mensaje .='
                  <tr>
                    <td colspan="3" align="left" style="font-weight:bold;FONT-SIZE: 14px;"><strong>Periodico: </strong>'.$periodico.' &nbsp;  &nbsp; &nbsp;<!--<strong>Estado :</strong> '.$row['estado'].'--> &nbsp;  &nbsp; &nbsp;<strong>Fecha: </strong>'.fecha_completa( $row['Fecha'] ).'</td>
                  </tr>
                  <tr>
                    <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">TITULO: '.sanear_string2($titulo).' &nbsp;  &nbsp; &nbsp;ENCABEZADO: '.sanear_string2($encabezado).'</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align:justify; background: #e6e7ed;font-family: Arial Narraow;font-size: 14px;">
                      '.wordlimit($texto).'
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" align="left"><!--<strong>Categoria: </strong>'.$row['Categoria'].'&nbsp;  &nbsp; &nbsp;--><strong>Secci&oacute;n : </strong>'.$row['seccion'].'&nbsp;  &nbsp; &nbsp;<strong>Autor: </strong>'.  ucwords(strtolower($row['Autor'])).'</td>
                  </tr>
                  <tr>
                    <td colspan="3">
                      <a href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a> &nbsp;  &nbsp; &nbsp;<a href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a> &nbsp;  &nbsp; &nbsp; Link: <span style="color: blue;text-decoration: underline;">'.$urlP.$row['pdf'].'</span>
                    </td>
                  </tr>
                   <tr style="height: 10px;">
                   <td colspan="3"></td>
                    </tr>'; 
        }
        
    }
    else{
            echo mysql_error();
        }
    return $mensaje;
}

function recuperaDatosColumnas($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";

    $result =  mysql_query($sql);

    if(mysql_affected_rows() > 0)
    {
        $mensaje ='
                <tr>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
                <tr>
                  <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.$titulo.'</th>
               </tr>
               <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {
            $texto = correctorOrtografico(sanear_string2($row['Texto']));
            $texto = ( !empty($buscar) )? highlight( $texto  , $buscar) :  $texto ; 
            $texto = ( !empty($buscar) )? EncuentraArreglo($texto,$buscar) : $texto;

            $periodico = correctorOrtografico( $row['Periodico'] );
            $periodico = ( !empty($buscar) )? highlight( $periodico, $buscar) : $periodico;

            $autor = '';
            $autor=$row['Autor'];
            switch( ($periodico) )
            {
                    case "Excelsior":
                        $periodico = "Excélsior";
                        $autor="Excélsior";
                    break;

                    case "El milenio Nacional":
                        $periodico = "Milenio";
                        $autor="Milenio";
                    break;

                    case "El Reforma":
                        $periodico = "Reforma";
                        $autor="Reforma";
                    break;

                    case "La Razon":
                        $periodico = "La Razón";
                        $autor="La Razón";
                    break;

                    case "La Cronica":
                        $periodico = "La Crónica";
                        $autor="La Crónica";
                    break;

                    case "el sol de mexico":
                        $periodico = "El Sol de México";
                        $autor="El Sol de México";
                    break;

                    case "Reporte Indigo Df":
                        $periodico = "Reporte Índigo";
                        $autor="Reporte Índigo";
                    break;

                    case "Punto critico":
                        $periodico = "Punto Crítico";
                        $autor="Punto Crítico";
                    break;

                    case "la prensa":
                        $periodico = "La Prensa";
                        $autor="La Prensa";
                    break;

                    case "Mundo expres":
                        $periodico = "Mundo Expres";
                        $autor="Mundo Expres";
                    break;
            }


            $titulo = correctorOrtografico( $row['Titulo'] );
            $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;

            $encabezado = correctorOrtografico( $row['Encabezado'] );
            $encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;

            $mensaje .='
                  <tr>
                    <td colspan="3" align="left" style="font-weight:bold;FONT-SIZE: 14px;"><strong>Periodico: </strong>'.$periodico.' &nbsp;  &nbsp; &nbsp;<!--<strong>Estado :</strong> '.$row['estado'].'--> &nbsp;  &nbsp; &nbsp;<strong>Fecha: </strong>'.fecha_completa( $row['Fecha'] ).'</td>
                  </tr>
                  <tr>
                    <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">TITULO: '.sanear_string2($titulo).' &nbsp;  &nbsp; &nbsp;ENCABEZADO: '.sanear_string2($encabezado).'</td>
                  </tr>
                  <!--<tr>
                    <td colspan="3" style="text-align:justify; background: #e6e7ed;font-family: Arial Narraow;font-size: 14px;">
                      '.($texto).'
                    </td>
                  </tr>-->
                  <tr>
                    <td colspan="3" align="left"><!--<strong>Categoria: </strong>'.$row['Categoria'].'&nbsp;  &nbsp; &nbsp;--><strong>Secci&oacute;n : </strong>'.$row['seccion'].'&nbsp;  &nbsp; &nbsp;<strong>Autor: </strong>'.  ucwords(strtolower($autor)).'</td>
                  </tr>
                  <tr>
                    <td colspan="3">
                      <a href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a> &nbsp;  &nbsp; &nbsp;<a href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a> &nbsp;  &nbsp; &nbsp; Link: <span style="color: blue;text-decoration: underline;">'.$urlP.$row['pdf'].'</span>
                    </td>
                  </tr>
                   <tr style="height: 10px;">
                   <td colspan="3"></td>
                </tr>'; 
        }
    }
    return $mensaje;
}


function recuperaDatosWEB($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
 

    $result =  mysql_query($sql);

    if(mysql_affected_rows() > 0)
    {
        $mensaje ='
                <tr>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
                <tr>
                  <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.$titulo.'</th>
               </tr>
               <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {


          $texto=  textMatchV2($row['Texto'], $buscar);

          $texto = correctorOrtografico(($texto));

          $texto = ( !empty($buscar) )? highlight( $texto  , $buscar) :  $texto ; 

          //$texto = ( !empty($buscar) )? EncuentraArreglo($texto,$buscar) : $texto;

          $periodico = correctorOrtografico( $row['Periodico'] );
          $periodico = ( !empty($buscar) )? highlight( $periodico, $buscar) : $periodico;

          $autor = '';
          switch( strtolower($periodico) )
          {
                  case "Excelsior":
                      $periodico = "Excélsior";
                      $autor="Excélsior";
                  break;

                  case "El milenio Nacional":
                      $periodico = "Milenio";
                      $autor="Milenio";
                  break;

                  case "El Reforma":
                      $periodico = "Reforma";
                      $autor="Reforma";
                  break;

                  case "La Razon":
                      $periodico = "La Razón";
                      $autor="La Razón";
                  break;

                  case "La Cronica":
                      $periodico = "La Crónica";
                      $autor="La Crónica";
                  break;

                  case "el sol de mexico":
                      $periodico = "El Sol de México";
                      $autor="El Sol de México";
                  break;

                  case "Reporte Indigo Df":
                      $periodico = "Reporte Índigo";
                      $autor="Reporte Índigo";
                  break;

                  case "Punto critico":
                      $periodico = "Punto Crítico";
                      $autor="Punto Crítico";
                  break;

                  case "la prensa":
                      $periodico = "La Prensa";
                      $autor="La Prensa";
                  break;

                  case "Mundo expres":
                      $periodico = "Mundo Expres";
                      $autor="Mundo Expres";
                  break;
                }


          $titulo = correctorOrtografico( $row['Titulo'] );
          $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;

          $encabezado = correctorOrtografico( $row['Encabezado'] );
          $encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;

          $mensaje .='
                <tr>
                  <td colspan="3" align="left" style="font-weight:bold;FONT-SIZE: 14px;"><strong>Periodico: </strong>'.$periodico.' &nbsp;  &nbsp; &nbsp;<!--<strong>Estado :</strong> '.$row['estado'].'--> &nbsp;  &nbsp; &nbsp;<strong>Fecha: </strong>'.fecha_completa( $row['Fecha'] ).'</td>
                </tr>
                <tr>
                  <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">TITULO: '.sanear_string2($titulo).' &nbsp;  &nbsp; &nbsp;ENCABEZADO: '.sanear_string2($encabezado).'</td>
                </tr>
                <tr>
                  <td colspan="3" style="text-align:justify; background: #e6e7ed;font-family: Arial Narraow;font-size: 14px;">
                    '.wordlimit($texto).'
                  </td>
                </tr>
                <tr>
                  <td colspan="3" align="left"><!--<strong>Categoria: </strong>'.$row['Categoria'].'&nbsp;  &nbsp; &nbsp;--><strong>Secci&oacute;n : </strong>'.$row['seccion'].'&nbsp;  &nbsp; &nbsp;<strong>Autor: </strong>'.  ucwords(strtolower($row['Autor'])).'</td>
                </tr>
                <tr>
                  <td colspan="3">
                    <a href="'.$row['LINK'].'" target="_blank">Ir a la Nota</a> &nbsp;  &nbsp; &nbsp; Link: <span style="color: blue;text-decoration: underline;">'.$row['LINK'].'</span>
                  </td>
                </tr>
                 <tr style="height: 10px;">
                 <td colspan="3"></td>
                  </tr>'; 
        }          
    }
  return $mensaje;
}



function cintillos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";

    $result =  mysql_query($sql);

    $mensaje ='
            <tr>
                <th width="40%">&nbsp;</th>
                <th  width="20%"></th>
                <th width="40%">&nbsp;</th>
            </tr>
            <tr>
                <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.$titulo.'</th>
            </tr>
            <tr>
                <th width="40%">&nbsp;</th>
                <th  width="20%"></th>
                <th width="40%">&nbsp;</th>
            </tr>';
    if(mysql_affected_rows() > 0)
    {
        while ( $row = mysql_fetch_array($result) ) 
        {
            $idPeriodico=$row['idPeriodico'];
            //$texto = ( !empty($buscar) )? highlight( utf8_encode($row['Texto']) , $buscar) : utf8_encode($row['Texto']); 
            $texto = correctorOrtografico($row['Texto']);
            $texto = ( !empty($buscar) )? highlight( $texto  , $buscar) :  $texto ; 

            $texto = ( !empty($buscar) )? EncuentraArreglo($texto,$buscar) : $texto;

            $periodico = correctorOrtografico( $row['Periodico'] );
            $periodico = ( !empty($buscar) )? highlight( $periodico, $buscar) : $periodico;

            $autor = '';
            switch( strtolower($periodico) )
            {
              case "el milenio nacional":
                $periodico = "Milenio";
                  $autor="Milenio";
              break;

              case "el reforma":
                $periodico = "Reforma";
                  $autor="Reforma";
              break;

              case "la razon":
                $periodico = "La Razón";
                  $autor="La Razón";
              break;

              case "la cronica":
                $periodico = "La Crónica";
                  $autor="La Crónica";
              break;

              case "el sol de mexico":
                $periodico = "El Sol de México";
                  $autor="El Sol de México";
              break;
            }


            $titulo = correctorOrtografico( $row['Titulo'] );
            $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;

            $encabezado = correctorOrtografico( $row['Encabezado'] );
            $encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;

            $mensaje .='
                  <tr>
                    <th align="left" width="100%" style="border-bottom: solid rgb(219, 210, 210) thin;"><img src="'.$urlP.'/Imagenes/periodicos/portadas2/'.($row['idPeriodico']).'.png" style="font-family: Arial Narrow;width:190px;clear: both;float: left;margin-bottom: 10px;">
                    <a href="'.$urlP.'/'.$row['pdf'].'" target="_blank" style="color:blue;"><span style="font-family: Arial Narrow;line-height: 35px;margin-left: 10px;font-family: Arial Narrow;font-size: 15px;font-weight: bold;text-transform: uppercase;font-family: Arial Narrow;">'.$titulo.'</span></a></th>
                    <th align="left"style="border-bottom: solid rgb(219, 210, 210) thin;"></th>
                    <th align="left"style="border-bottom: solid rgb(219, 210, 210) thin;"><a href="'.$urlP.'/'.$row['jpg'].'.jpg" target="_blank" style="font-size: 11px;"><span style="text-align="rigth;font-family: Arial Narrow;font-size: 11px;">JPG</span></a></th>
                  </tr>'; 
          }        
      
    } 
    return "<tr></tr>".$mensaje;
}

$mensaje ='
<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8"/>
        <meta content="es"/>
        <meta lang="es"/>
        <meta http-equiv="Content-Language" content="es">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
    <meta charset="utf-8"/>
  </head>
 
  <body>
<table width="70%" align="center" cellspacing="0" border="0" style="font-size: 12px;border: solid 1px gray;">
 <tr>
    <td colspan="3" align="center"><img src="'.$urlP.'/external/services/mail/sct/logo.png"style="width: 280px;"></td>
 </tr>';

//QUERY INEE
$qryRuiz="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
      Texto like'%Gerardo Ruiz Esparza%' OR
      Texto like '%Ruiz Esparza Gerardo%' OR
      Texto like '%Ruiz Esparza%' OR

      Titulo like'%Gerardo Ruiz Esparza%' OR
      Titulo like '%Ruiz Esparza Gerardo%' OR
      Titulo like '%Ruiz Esparza%' OR

      Encabezado like'%Gerardo Ruiz Esparza%' OR
      Encabezado like '%Ruiz Esparza Gerardo%' OR
      Encabezado like '%Ruiz Esparza%' 
    ) 
ORDER BY o.posicion";
$buscar = array(
    'Gerardo Ruíz Esparza','Ruíz Esparza','Gerardo Ruiz Esparza','Ruiz Esparza'
);

$mensaje .= recuperaDatos($qryRuiz, $titulo = "SECRETARIO - Gerardo Ruíz Esparza", $buscar );



//QUERY Funcionarios
$qryFuncionarios="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND
  n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Sylvia Irene Schmelkes del Valle%' OR
        Texto LIKE '%Sylvia Schmelkes del Valle%' OR
        Titulo LIKE '%Sylvia Irene Schmelkes del Valle%' OR
        Titulo LIKE '%Sylvia Schmelkes del Valle%' OR
        Encabezado LIKE '%Sylvia Irene Schmelkes del Valle%' OR
        Encabezado LIKE '%Sylvia Schmelkes del Valle%' OR

        Texto LIKE '%Margarita Maria Zorrilla Fierro%' OR
        Texto LIKE '%Margarita Zorrilla Fierro%' OR
        Titulo LIKE '%Margarita Maria Zorrilla Fierro%' OR
        Titulo LIKE '%Margarita Zorrilla Fierro%' OR
        Encabezado LIKE '%Margarita Maria Zorrilla Fierro%' OR
        Encabezado LIKE '%Margarita Zorrilla Fierro%' OR

        Texto LIKE '%Teresa Bracho González%' OR
        Titulo LIKE '%Teresa Bracho González%' OR
        Encabezado LIKE '%Teresa Bracho González%' OR

        Texto LIKE '%Gilberto Ramon Guevara Niebla%' OR
        Texto LIKE '%Gilberto Guevara Niebla%' OR
        Titulo LIKE '%Gilberto Ramon Guevara Niebla%' OR
        Titulo LIKE '%Gilberto Guevara Niebla%' OR
        Encabezado LIKE '%Gilberto Ramon Guevara Niebla%' OR
        Encabezado LIKE '%Gilberto Guevara Niebla%' OR

        Texto LIKE '%Eduardo Backhoff Escudero%' OR
        Titulo LIKE '%Eduardo Backhoff Escudero%' OR
        Encabezado LIKE '%Eduardo Backhoff Escudero%' OR

        Texto LIKE '%Francisco Miranda Lopez%' OR
        Titulo LIKE '%Francisco Miranda Lopez%' OR
        Encabezado LIKE '%Francisco Miranda Lopez%'  OR

        Texto LIKE '%Jorge Antonio Hernández Uralde%' OR
        Texto LIKE '%Jorge Hernández Uralde%' OR
        Titulo LIKE '%Jorge Antonio Hernández Uralde%' OR
        Titulo LIKE '%Jorge Hernández Uralde%' OR
        Encabezado LIKE '%Jorge Antonio Hernández Uralde%' OR
        Encabezado LIKE '%Jorge Hernández Uralde%' OR

        Texto LIKE '%Agustin Caso Raphael%' OR
        Titulo LIKE '%Agustin Caso Raphael%' OR
        Encabezado LIKE '%Agustin Caso Raphael%' OR

        Texto LIKE '%Luis Castillo Montes%' OR
        Titulo LIKE '%Luis Castillo Montes%' OR
        Encabezado LIKE '%Luis Castillo Montes%'
                    )
ORDER BY o.posicion";
$buscar = array(
                "Sylvia Irene Schmelkes del Valle",
                "Sylvia Schmelkes del Valle",
                "Margarita Maria Zorrilla Fierro",
                "Margarita Zorrilla Fierro",
                "Teresa Bracho González",
                "Gilberto Ramon Guevara Niebla",
                "Eduardo Backhoff Escudero",
                "Francisco Miranda Lopez",
                "Jorge Antonio Hernández Uralde",
                "Jorge Hernández Uralde",
                "Agustin Caso Raphael",
                "Luis Castillo Montes"
        );


$mensaje .= recuperaDatos($qryFinanciera, $titulo = "INEE - Funcionarios", $buscar );




//QUERY PARA Reforma Educativa
$qryReformaEducativa = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Reforma Educativa%' OR
        Titulo LIKE '%Reforma Educativa%' OR
        Encabezado LIKE '%Reforma Educativa%'
    )
ORDER BY o.posicion";
$buscar = array(
        "Reforma Educativa"
);


$mensaje .= recuperaDatos($qryReformaEducativa, $titulo = "Reforma Educativa", $buscar );



//QUERY SEN
$qrySEN = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE 'SEN' OR
        Texto LIKE '%Sistema Educativo Nacional%' OR
        Titulo LIKE 'SEN' OR
        Titulo LIKE '%Sistema Educativo Nacional%' OR
        Encabezado LIKE 'SEN' OR
        Encabezado LIKE '%Sistema Educativo Nacional%'
    )
ORDER BY o.posicion";
$buscar = array(
        "Sistema Educativo Nacional",
        " SEN "
);

$mensaje .= recuperaDatos($qrySDATU, $titulo = "SEN - Sistema Educativo Nacional", $buscar );


//QUERY PARA   SNEE  
$qry3 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SNEE' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE 'SNEE' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE 'SNEE' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    )
ORDER BY o.posicion";
$buscar = array(" SNEE ","Sistema Nacional de Evaluacion Educativa");

$mensaje .= recuperaDatos($qry3, $titulo = "SNEE - Sistema Nacional de Evaluación Educativa", $buscar );


//QUERY PARA PNEE
$qry4 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Politica Nacional de Evaluacion Educativa%'
     )
ORDER BY o.posicion";
$buscar = array(
        " PNEE ",
        " Politica Nacional de Evaluacion Educativa ",
);


$mensaje .= recuperaDatos($qry4, $titulo = "PNEE - Política Naciónal de Evaluación Educativa", $buscar );


//QUERY PARA SPD
$qry5 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR

        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR

        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
    )
ORDER BY o.posicion";
$buscar = array(
    "Servicio Profesional Docente",
    " SPD "
    );

$mensaje .= recuperaDatos($qry5, $titulo = "SPD - Servicio Profesional Docente", $buscar );


// Query para PRUEBA
$qry6 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
  n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%prueba enlace%' OR
        Texto LIKE '%prueba excale%' OR
        Texto LIKE '%prueba pisa%' OR
        Texto LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Texto LIKE '%Programme for International Student Assessment%' OR
        Texto LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Texto LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Titulo LIKE '%prueba enlace%' OR
        Titulo LIKE '%prueba excale%' OR
        Titulo LIKE '%prueba pisa%' OR
        Titulo LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Titulo LIKE '%Programme for International Student Assessment%' OR
        Titulo LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Titulo LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Encabezado LIKE '%prueba enlace%' OR
        Encabezado LIKE '%prueba excale%' OR
        Encabezado LIKE '%prueba pisa%' OR
        Encabezado LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Encabezado LIKE '%Programme for International Student Assessment%' OR
        Encabezado LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Encabezado LIKE '%Examen de la Calidad y el Logro Educativo%'
    )
ORDER BY o.posicion";
$buscar = array(
        "prueba enlace",
        "prueba excale",
        "prueba pisa",
        "Evaluacion Nacional de Logro Academico en Centros Escolares",
        "Programme for International Student Assessment",
        "Programa para la Evaluacion Internacional de los Estudiantes",
        "Examen de la Calidad y el Logro Educativo",
    );
$mensaje .= recuperaDatos($qry6, $titulo = "INEE - PRUEBA", $buscar );


//QUERY para Evaluacion Educativa/ evaluacion para la educacion
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Evaluacion educativa%' OR
        Texto LIKE '%Evaluacion de la educacion%' OR

        Titulo LIKE '%Evaluacion educativa%' OR
        Titulo LIKE '%Evaluacion de la educacion%' OR

        Encabezado LIKE '%Evaluacion educativa%' OR
        Encabezado LIKE '%Evaluacion de la educacion%'
    )
ORDER BY o.posicion";
$buscar = array(
        "Evaluacion Educativa",
        "Evaluacion de la Educacion"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "Evaluación de la Educación", $buscar );



//QUERY para CONFERENCIA DEL SISTEMA NACIONAL DE EVALUACIÓN EDUCATIVA      
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    ) 
ORDER BY o.posicion";
$buscar = array(
        "Conferencia del Sistema Nacional de Evaluacion Educativa",
        "Sistema Nacional de Evaluacion Educativa"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "Conferencia del Sistema Nacional de Evaluación Educativa", $buscar );


//QUERY para Consejo Social Consultivo de Evaluacion de la Educacion    
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Texto LIKE '%CONSCEE%' OR

        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Titulo LIKE '%CONSCEE%' OR

        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Encabezado LIKE '%CONSCEE%'
    ) 
ORDER BY o.posicion";
$buscar = array(
        "CONSCEE",
        "Consejo Social Consultivo de Evaluacion de la Educacion"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "CONSCEE - Consejo Social Consultivo de Evaluacion de la Educacion", $buscar );

//QUERY para Consejo de Vinculacion con las Entidades Federativas      
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Texto LIKE 'CONVIE' OR

        Titulo LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Titulo LIKE 'CONVIE' OR

        Encabezado LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Encabezado LIKE 'CONVIE'
    )
ORDER BY o.posicion";
$buscar = array(
        "CONVIE",
        "Consejo de Vinculacion con las Entidades Federativas"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "CONVIE - Consejo de Vinculacion con las Entidades Federativas", $buscar );


//QUERY para  Consejo Pedagogico de Evaluacion Educativa
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Texto LIKE 'CONPEE' OR

        Titulo LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Titulo LIKE 'CONPEE' OR

        Encabezado LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Encabezado LIKE 'CONPEE'
    )
ORDER BY o.posicion";
$buscar = array(
        "CONPEE",
        "Consejo Pedagogico de Evaluacion Educativa"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "CONPEE - Consejo Pedagogico de Evaluacion Educativa", $buscar );



//QUERY para Consejos Tecnicos Especializados
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Consejos Tecnicos Especializados%' OR
        Texto LIKE 'CONTE' OR

        Titulo LIKE '%Consejos Tecnicos Especializados%' OR
        Titulo LIKE 'CONTE' OR

        Encabezado LIKE '%Consejos Tecnicos Especializados%' OR
        Encabezado LIKE 'Consejos Tecnicos Especializados'
    )
ORDER BY o.posicion";
$buscar = array(
        "CONTE",
        "Consejos Tecnicos Especializados"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "CONTE - Consejos Tecnicos Especializados", $buscar );

//QUERY para Secretaria de Educacion Publica
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE 'SEP' OR
        Texto LIKE '%Secretaria de Educacion Publica%' OR

        Titulo LIKE 'SEP' OR
        Titulo LIKE '%Secretaria de Educacion Publica%' OR

        Encabezado LIKE 'SEP' OR
        Encabezado LIKE '%Secretaria de Educacion Publica%'
        )
ORDER BY o.posicion";
$buscar = array(
        "Secretaria de Educacion Publica",
        "Secretaria de Educacion Pública",
        "Secretaría de Educación Pública",
        "SEP"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "SEP - Secretaria de Educación Pública", $buscar );


//QUERY para SNTE
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
	Texto LIKE 'SNTE' OR
	Texto LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
		
	Titulo LIKE 'SNTE' OR
	Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
	
	Encabezado LIKE 'SNTE' OR
	Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educacion%'
)
ORDER BY o.posicion";
$buscar = array(
        "SNTE",
        "Sindicato Nacional de Trabajadores de la Educacion"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "SNTE - Sindicato Naciónal de Trabajadores de la Educación", $buscar );


//QUERY para CNTE
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
  n.Categoria<>80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
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
$buscar = array(
        "CNTE",
        "Coordinadora Nacional de Trabajadores de la Educacion"
    );
$mensaje .= recuperaDatos($qryV, $titulo = "CNTE - Coordinadora Naciónal de Trabajadores de la Educación", $buscar );


$sqlPlanas = "SELECT
        n.Periodico as idPeriodico,
        n.idEditorial,
        n.Titulo,
        p.Nombre as Periodico,
        e.Nombre AS estado,
        n.Fecha,
        n.PaginaPeriodico,
        s.seccion,
        c.Categoria as Categoria,
        n.Autor,
        n.Texto,
        CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
        CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
        n.Categoria as 'Num.Categoria',
        n.NumeroPagina,
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
      e.idEstado=p.Estado AND
      p.idPeriodico=n.Periodico AND
      p.idPeriodico=o.periodico AND
      s.idSeccion=n.Seccion AND
      c.idCategoria=n.Categoria AND
      c.idCategoria in(3) AND
      n.Activo = 1 AND
      fecha =CURDATE()
      GROUP BY n.NumeroPagina,p.idPeriodico
      ORDER BY o.posicion";

$mensaje .= cintillos($sqlPlanas, $titulo = "Ocho Columnas", $buscar = array() );

//QUERY PARA Columnas Politicas
$qryPol = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
n.Periodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(19) AND
n.Activo = 1 AND
fecha =CURDATE()AND
p.estado=9 AND
p.Estado=e.idEstado
GROUP BY n.idEditorial
ORDER BY o.id";
$buscar = array();
$mensaje .= recuperaDatosColumnas($qryPol, $titulo = "Columnas Políticas", $buscar );

//QUERY PARA Columnas Financieras
$qryF = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
e.idEstado=p.Estado AND
p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(20) AND
n.Activo = 1 AND
fecha =CURDATE()AND
p.estado=9
GROUP BY n.idEditorial";
$buscar = array();
$mensaje .= recuperaDatosColumnas($qryF, $titulo = "Columnas Financieras", $buscar );


//QUERY PARA Cartones
$qryF = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
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
e.idEstado=p.Estado AND
p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(18) AND
p.estado=9 AND
n.Activo = 1 AND
fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY o.posicion";
$buscar = array();
$mensaje .= cintillos($qryF, $titulo = "Cartones", $buscar );


$mensaje=  utf8_decode($mensaje);

$mensaje.='<tr> <td colspan="3" style="font-family: Arial Narrow;text-align: center;background: #FFFFFF;color: #B30000;height: 40px;font-size: 45px;text-transform: uppercase;background-color: #F3F3F3;">PORTALES WEB</td></tr>';

/*********************************************************************************************************************************************************************************************************************************************/    
/*********************************************************************************************************************************************************************************************************************************************/    
/*********************************************************************************************************************************************************************************************************************************************/    
/*********************************************************************************************************************************************************************************************************************************************/    
/*********************************************************************************************************************************************************************************************************************************************/    
/*********************************************************************************************************************************************************************************************************************************************/    
/*********************************************************************************************************************************************************************************************************************************************/    
/*********************************************************************************************************************************************************************************************************************************************/    



//QUERY INEE
$qryINEE="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
    Texto LIKE 'INEE' OR
    Texto LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR

    Titulo LIKE 'INEE' OR
    Titulo LIKE '%Instituto Nacional para la Evaluacion de la Educacion%' OR

    Encabezado LIKE 'INEE' OR
    Encabezado LIKE '%Instituto Nacional para la Evaluacion de la Educacion%'
     )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
    " INEE ",
    "Instituto Nacional para la Evaluacion de la Educacion",
    "Instituto Naciónal para la Evaluación de la Educación"
);

$mensaje .= recuperaDatosWEB($qryDireccion, $titulo = "INEE - Instituto Nacional para la Evaluación de la Educación", $buscar );



//QUERY Funcionarios
$qryFuncionarios="SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
  n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Sylvia Irene Schmelkes del Valle%' OR
        Texto LIKE '%Sylvia Schmelkes del Valle%' OR
        Titulo LIKE '%Sylvia Irene Schmelkes del Valle%' OR
        Titulo LIKE '%Sylvia Schmelkes del Valle%' OR
        Encabezado LIKE '%Sylvia Irene Schmelkes del Valle%' OR
        Encabezado LIKE '%Sylvia Schmelkes del Valle%' OR

        Texto LIKE '%Margarita Maria Zorrilla Fierro%' OR
        Texto LIKE '%Margarita Zorrilla Fierro%' OR
        Titulo LIKE '%Margarita Maria Zorrilla Fierro%' OR
        Titulo LIKE '%Margarita Zorrilla Fierro%' OR
        Encabezado LIKE '%Margarita Maria Zorrilla Fierro%' OR
        Encabezado LIKE '%Margarita Zorrilla Fierro%' OR

        Texto LIKE '%Teresa Bracho González%' OR
        Titulo LIKE '%Teresa Bracho González%' OR
        Encabezado LIKE '%Teresa Bracho González%' OR

        Texto LIKE '%Gilberto Ramon Guevara Niebla%' OR
        Texto LIKE '%Gilberto Guevara Niebla%' OR
        Titulo LIKE '%Gilberto Ramon Guevara Niebla%' OR
        Titulo LIKE '%Gilberto Guevara Niebla%' OR
        Encabezado LIKE '%Gilberto Ramon Guevara Niebla%' OR
        Encabezado LIKE '%Gilberto Guevara Niebla%' OR

        Texto LIKE '%Eduardo Backhoff Escudero%' OR
        Titulo LIKE '%Eduardo Backhoff Escudero%' OR
        Encabezado LIKE '%Eduardo Backhoff Escudero%' OR

        Texto LIKE '%Francisco Miranda Lopez%' OR
        Titulo LIKE '%Francisco Miranda Lopez%' OR
        Encabezado LIKE '%Francisco Miranda Lopez%'  OR

        Texto LIKE '%Jorge Antonio Hernández Uralde%' OR
        Texto LIKE '%Jorge Hernández Uralde%' OR
        Titulo LIKE '%Jorge Antonio Hernández Uralde%' OR
        Titulo LIKE '%Jorge Hernández Uralde%' OR
        Encabezado LIKE '%Jorge Antonio Hernández Uralde%' OR
        Encabezado LIKE '%Jorge Hernández Uralde%' OR

        Texto LIKE '%Agustin Caso Raphael%' OR
        Titulo LIKE '%Agustin Caso Raphael%' OR
        Encabezado LIKE '%Agustin Caso Raphael%' OR

        Texto LIKE '%Luis Castillo Montes%' OR
        Titulo LIKE '%Luis Castillo Montes%' OR
        Encabezado LIKE '%Luis Castillo Montes%'
                    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
                "Sylvia Irene Schmelkes del Valle",
                "Sylvia Schmelkes del Valle",
                "Margarita Maria Zorrilla Fierro",
                "Margarita Zorrilla Fierro",
                "Teresa Bracho González",
                "Gilberto Ramon Guevara Niebla",
                "Eduardo Backhoff Escudero",
                "Francisco Miranda Lopez",
                "Jorge Antonio Hernández Uralde",
                "Jorge Hernández Uralde",
                "Agustin Caso Raphael",
                "Luis Castillo Montes"
        );


$mensaje .= recuperaDatosWEB($qryFinanciera, $titulo = "INEE - Funcionarios", $buscar );




//QUERY PARA Reforma Educativa
$qryReformaEducativa = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Reforma Educativa%' OR
        Titulo LIKE '%Reforma Educativa%' OR
        Encabezado LIKE '%Reforma Educativa%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Reforma Educativa"
);


$mensaje .= recuperaDatosWEB($qryReformaEducativa, $titulo = "Reforma Educativa", $buscar );



//QUERY SEN
$qrySEN = "SELECT
 n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE 'SEN' OR
        Texto LIKE '%Sistema Educativo Nacional%' OR
        Titulo LIKE 'SEN' OR
        Titulo LIKE '%Sistema Educativo Nacional%' OR
        Encabezado LIKE 'SEN' OR
        Encabezado LIKE '%Sistema Educativo Nacional%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Sistema Educativo Nacional",
        " SEN "
);

$mensaje .= recuperaDatosWEB($qrySDATU, $titulo = "SEN - Sistema Educativo Nacional", $buscar );


//QUERY PARA   SNEE  
$qry3 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SNEE' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE 'SNEE' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE 'SNEE' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(" SNEE ","Sistema Nacional de Evaluacion Educativa");

$mensaje .= recuperaDatosWEB($qry3, $titulo = "SNEE - Sistema Nacional de Evaluación Educativa", $buscar );


//QUERY PARA PNEE
$qry4 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Politica Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Politica Nacional de Evaluacion Educativa%'
     )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        " PNEE ",
        " Politica Nacional de Evaluacion Educativa ",
);


$mensaje .= recuperaDatosWEB($qry4, $titulo = "PNEE - Política Naciónal de Evaluación Educativa", $buscar );


//QUERY PARA SPD
$qry5 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR

        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR

        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
    "Servicio Profesional Docente",
    " SPD "
    );

$mensaje .= recuperaDatosWEB($qry5, $titulo = "SPD - Servicio Profesional Docente", $buscar );


// Query para PRUEBA
$qry6 = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
   n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
  n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%prueba enlace%' OR
        Texto LIKE '%prueba excale%' OR
        Texto LIKE '%prueba pisa%' OR
        Texto LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Texto LIKE '%Programme for International Student Assessment%' OR
        Texto LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Texto LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Titulo LIKE '%prueba enlace%' OR
        Titulo LIKE '%prueba excale%' OR
        Titulo LIKE '%prueba pisa%' OR
        Titulo LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Titulo LIKE '%Programme for International Student Assessment%' OR
        Titulo LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Titulo LIKE '%Examen de la Calidad y el Logro Educativo%' OR

        Encabezado LIKE '%prueba enlace%' OR
        Encabezado LIKE '%prueba excale%' OR
        Encabezado LIKE '%prueba pisa%' OR
        Encabezado LIKE '%Evaluacion Nacional de Logro Academico en Centros Escolares%' OR
        Encabezado LIKE '%Programme for International Student Assessment%' OR
        Encabezado LIKE '%Programa para la Evaluacion Internacional de los Estudiantes%' OR
        Encabezado LIKE '%Examen de la Calidad y el Logro Educativo%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "prueba enlace",
        "prueba excale",
        "prueba pisa",
        "Evaluacion Nacional de Logro Academico en Centros Escolares",
        "Programme for International Student Assessment",
        "Programa para la Evaluacion Internacional de los Estudiantes",
        "Examen de la Calidad y el Logro Educativo",
    );
$mensaje .= recuperaDatosWEB($qry6, $titulo = "INEE - PRUEBA", $buscar );


//QUERY para Evaluacion Educativa/ evaluacion para la educacion
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Evaluacion educativa%' OR
        Texto LIKE '%Evaluacion de la educacion%' OR

        Titulo LIKE '%Evaluacion educativa%' OR
        Titulo LIKE '%Evaluacion de la educacion%' OR

        Encabezado LIKE '%Evaluacion educativa%' OR
        Encabezado LIKE '%Evaluacion de la educacion%'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Evaluacion Educativa",
        "Evaluacion de la Educacion"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "Evaluacion de la Educación", $buscar );



//QUERY para CONFERENCIA DEL SISTEMA NACIONAL DE EVALUACIÓN EDUCATIVA      
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Texto LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Titulo LIKE '%Sistema Nacional de Evaluacion Educativa%' OR

        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluacion Educativa%' OR
        Encabezado LIKE '%Sistema Nacional de Evaluacion Educativa%'
    ) 
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Conferencia del Sistema Nacional de Evaluacion Educativa",
        "Sistema Nacional de Evaluacion Educativa"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "Conferencia del Sistema Nacional de Evaluación Educativa", $buscar );


//QUERY para Consejo Social Consultivo de Evaluacion de la Educacion    
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
    n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Texto LIKE '%CONSCEE%' OR

        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Titulo LIKE '%CONSCEE%' OR

        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educacion%' OR
        Encabezado LIKE '%CONSCEE%'
    ) 
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CONSCEE",
        "Consejo Social Consultivo de Evaluacion de la Educacion"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "CONSCEE - Consejo Social Consultivo de Evaluacion de la Educacion", $buscar );

//QUERY para Consejo de Vinculacion con las Entidades Federativas      
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
    n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Texto LIKE 'CONVIE' OR

        Titulo LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Titulo LIKE 'CONVIE' OR

        Encabezado LIKE '%Consejo de Vinculacion con las Entidades Federativas%' OR
        Encabezado LIKE 'CONVIE'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CONVIE",
        "Consejo de Vinculacion con las Entidades Federativas"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "CONVIE - Consejo de Vinculacion con las Entidades Federativas", $buscar );


//QUERY para  Consejo Pedagogico de Evaluacion Educativa
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND (
        Texto LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Texto LIKE 'CONPEE' OR

        Titulo LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Titulo LIKE 'CONPEE' OR

        Encabezado LIKE '%Consejo Pedagogico de Evaluacion Educativa%' OR
        Encabezado LIKE 'CONPEE'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CONPEE",
        "Consejo Pedagogico de Evaluacion Educativa"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "CONPEE - Consejo Pedagogico de Evaluacion Educativa", $buscar );



//QUERY para Consejos Tecnicos Especializados
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE '%Consejos Tecnicos Especializados%' OR
        Texto LIKE 'CONTE' OR

        Titulo LIKE '%Consejos Tecnicos Especializados%' OR
        Titulo LIKE 'CONTE' OR

        Encabezado LIKE '%Consejos Tecnicos Especializados%' OR
        Encabezado LIKE 'Consejos Tecnicos Especializados'
    )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CONTE",
        "Consejos Tecnicos Especializados"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "CONTE - Consejos Tecnicos Especializados", $buscar );

//QUERY para Secretaria de Educacion Publica
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
        Texto LIKE 'SEP' OR
        Texto LIKE '%Secretaria de Educacion Publica%' OR

        Titulo LIKE 'SEP' OR
        Titulo LIKE '%Secretaria de Educacion Publica%' OR

        Encabezado LIKE 'SEP' OR
        Encabezado LIKE '%Secretaria de Educacion Publica%'
        )
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "Secretaria de Educacion Publica",
        "Secretaria de Educacion Pública",
        "Secretaría de Educación Pública",
        "SEP"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "SEP - Secretaria de Educación Pública", $buscar );


//QUERY para SNTE
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
	Texto LIKE 'SNTE' OR
	Texto LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
		
	Titulo LIKE 'SNTE' OR
	Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educacion%' OR
	
	Encabezado LIKE 'SNTE' OR
	Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educacion%'
)
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "SNTE",
        "Sindicato Nacional de Trabajadores de la Educacion"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "SNTE - Sindicato Naciónal de Trabajadores de la Educación", $buscar );


//QUERY para CNTE
$qryV = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado as 'LINK' ,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria=80 AND 
n.Activo = 1 AND
  fecha = CURDATE() AND(
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
ORDER BY e.idEstado,p.Nombre";
$buscar = array(
        "CNTE",
        "Coordinadora Nacional de Trabajadores de la Educacion"
    );
$mensaje .= recuperaDatosWEB($qryV, $titulo = "CNTE - Coordinadora Naciónal de Trabajadores de la Educación", $buscar );



$mensaje.='
</table>
</body>
</html>';

//correo($mensaje);
 

echo $mensaje;

function correo($mensaje)
{
    require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";  

    
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host     = "pro.turbo-smtp.com";
    $mail->Port     = 587;
    $mail->SMTPAuth = true;
    $mail->CharSet = 'UTF-8';

    $mail->Username = "gaimpresos@gacomunicacion.com";
    $mail->Password = "VBHYxToX";
    
    
    $mail->AddBCC("edgarh@gacomunicacion.com");
    $mail->AddBCC("ehb1703@me.com");
    
    $mail->AddBCC("validacion_Gacomunicacion@hotmail.com");
    
    $mail->AddBCC("ricardom@gacomunicacion.com");
    $mail->AddBCC("jesush@gacomunicacion.com");
    $mail->AddBCC("gaimpresos@gacomunicacion.com");
    
    $mail->AddBCC("mariob@gacomunicacion.com");
    
    $mail->AddBCC("rubend@gacomunicacion.com");
    

    $mail->AddBCC("jlga@gacomunicacion.com");
    $mail->AddBCC("fcocolina@gacomunicacion.com");
    $mail->AddBCC("gmocarmona@gacomunicacion.com");
    $mail->AddBCC("oortiz@gacomunicacion.com");
    $mail->AddBCC("alezama@gacomunicacion.com");
    


    $mail->AddBCC("pperezcue@gmail.com");
    $mail->AddBCC("pperezcue@inee.edu.mx");
    $mail->AddBCC("prangel@inee.edu.mx");
    $mail->AddBCC("pedrorangel2020@gmail.com");



    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "MONITOREO DE PRENSA ";

    $mail->Subject  = " INNE ".date("Y-m-d");  
    $mail->WordWrap = 50;

    // Correo destino

    $mail->IsHTML(TRUE);

    $mail->Body = utf8_decode(utf8_encode($mensaje));
    //$mail->AddAttachment("/var/www/external/testigos/Financiera/".DATE('Y-m-d')."Reporte Financiera.pdf");

      if(!$mail->Send()) {
          echo "Error: " . $mail->ErrorInfo;
      } else {
          echo "Mensaje enviado";
      }
}


function EncuentraCoincidencias($cadenaOriginal,$valorBuscado){
    $posicion=  strpos($cadenaOriginal, $valorBuscado);
    if($posicion!==false){
        if($posicion>0){
             $nuevaCadena=  substr($cadenaOriginal, $posicion-95,$posicion+100);
            return $nuevaCadena." ... ";      
        }else{
             $nuevaCadena=  substr($cadenaOriginal, $posicion,$posicion+100);
            return $nuevaCadena."...";      
        }
    }else if($posicion===false){
        return false;
    }
}


function EncuentraArreglo($cadenaOriginal,$array){
    $cadena=false;
    foreach ($array as $value)
    {
        $cadena=EncuentraCoincidencias($cadenaOriginal,$value);
        if($cadena!==false){
            break;
        }
    }
    if($cadena!==false)
    {
      return wordlimit($cadena)." ... ";
    }
    else
    {
      return wordlimit($cadenaOriginal)." ... ";
    } 
}

function wordlimit($string, $length = 70)
{
    $words = explode(' ', $string);
    if (count($words) > $length)
    {
            return implode(' ', array_slice($words, 0, $length+5))." ... ";
    }
    else
    {
            return $string;
    }
}


function textMatchV2($cadena,$criterio) {
    // Salida
    $output = array();

    // Separacion de parrafos
    preg_match_all("#(.*)\.#U",$cadena,$multiMatch);

    if(count($multiMatch[0])>0) {
        for ($i=0; $i < count($multiMatch[0]); $i++) {
            for ($y=0; $y < count($criterio); $y++) {
                if(preg_match("/".$criterio[$y]."/i",preg_quote($multiMatch[0][$i]))===1) {
                    $output[] = $multiMatch[0][$i];
                    break;
                }
            }
        }
    }

    if(count($output)<1) $output = $cadena;

    return (is_array($output) ? implode("(...) ", $output) : $output);
}

function sanear_string2($url) {
 
 
/*Rememplazamos caracteres especiales latinos
 
$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ','');
 
$repl = array('a', 'e', 'i', 'o', 'u', 'n');
 
$url = str_replace ($find, $repl, $url);

$url = ucfirst($url);
 
/ Eliminamos y Reemplazamos demás caracteres especiales
*/
$find = array('/[^a-zA-Z0-9\-<>,.:;¿ÁÉÍÓÚáéíóúÑñ ]/', '/[\-]+/', '/<[^>]*>/');
 
$repl = array(' ','-','');
 
$url = preg_replace ($find, $repl, $url);

return $url;
 
}

function correctorOrtografico($cadena)
{
    $words = "SELECT * FROM diccionarioCorrector WHERE Validado=1";

    $correctas = array();
    $incorrectas = array();

    mysql_query("SET NAMES 'utf8'");
    $palabras = mysql_query($words);

    $i = 0;
    while($rows = mysql_fetch_array($palabras))
    {
        $correctas[$i]=utf8_decode($rows['Correcto']);
        $incorrectas[$i]=utf8_decode($rows['Incorrecto']);
        $i++;
    }

    $newcadena = str_replace($incorrectas, $correctas, $cadena);

    return $newcadena;
}

function fecha_completa($fecha)
{
    $subfecha=explode("-",$fecha); 
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
         $dia_sem3='Miércoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='Sábado'; 
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