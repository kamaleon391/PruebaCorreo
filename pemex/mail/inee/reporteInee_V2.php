
<?php

error_reporting(E_ALL);

// Notificar todos los errores de PHP
error_reporting(-1);

//require '/var/www/external/mail/conexion.php';
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


function recuperaDatos($sql, $titulo, $buscar = array(),$tipo)
{
    $urlP = "http://187.247.253.5";
  //$urlP = "http://192.168.3.154";
    mysql_query("SET NAMES 'utf8'");
    $result =  mysql_query($sql);

    if(mysql_affected_rows() > 0)
    {
      if($titulo!="Web")
      {
        /*
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
          */
                $mensaje ='
                    <div style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 21px;text-transform: uppercase;font-weight:bold;">'.$titulo.'</div><br><br>';
      }
      while ( $row = mysql_fetch_array($result) ) 
      {
        static $idDuplicados = Array();
        if(!in_array($row['idEditorial'],$idDuplicados))
        {

            //$texto = ( !empty($buscar) )? highlight( utf8_encode($row['Texto']) , $buscar) : utf8_encode($row['Texto']); 
            $fecha = $row['Fecha'];
            $texto = correctorOrtografico($row['Texto']);
            $texto=  textMatchV2($texto, $buscar);
            
            
            
            //$texto = ( !empty($buscar) )? EncuentraArreglo($texto,$buscar) : $texto;
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

                case "Diario de Mexico":
                    $periodico = "Diario de México";
                    $autor="Diario de México";
                break;

                case "La Jornada De Mexico":
                    $periodico = "La Jornada De México";
                    $autor="La Jornada De México";
                break;

                default:
                  $autor = $row['Autor'];
                break;
              }


          $titulo = correctorOrtografico($row['Titulo'] );
          $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;
          $titulo = strtoupper($titulo);
          $titulo = convert_Mayus($titulo);

          $encabezado = "";

          if($tipo == 1)
          {
            $encabezado = correctorOrtografico($row['Encabezado'] );
            $encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;
          }
          else
          {
            $link = $row['Encabezado'];
          }
          
          /*
          $mensaje .='
                <tr>
                  <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">'.sanear_string2($titulo).'</td>
                </tr>
                <tr>
                  <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 14px;">
                    '.($texto).'
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 14px;">
                    Autor: '.(ucwords(strtolower($autor))).'
                  </td>
                </tr>
                <tr>
                  <td colspan="3">';
            if($tipo==1)
            {
              $mensaje .= '<a href="'.$urlP.$row['pdf'].'" target="_blank" style=" font-weight: bold;">"'.$periodico.'" '.$row['seccion'].' '.$fecha.' Pag.'.$row['PaginaPeriodico'].'</a></span>'; 
            }
            else
            {
              $mensaje .= '<a href="'.$link.'" target="_blank" style=" font-weight: bold;">'.$link.'</a></span>'; 
            } 
            
            
            $mensaje .='
                  </td>
                </tr>
                 <tr style="height: 10px;">
                 <td colspan="3"></td>
                  </tr>'; 
            */

            $mensaje .='
                  <div style="text-align:left; font-weight:bold;font-size: 16px;">'.sanear_string2($titulo).'</div><br>
                  <div style="text-align:justify;font-family: Arial Narrow;font-size: 13px;">
                    '.($texto).'
                  </div><br>
                
                  <div style="text-align:justify;font-family: Arial Narrow;font-size: 14.5px;">
                    Autor: '.(ucwords(strtolower($autor))).'
                  </div>';
            if($tipo==1)
            {
              $mensaje .= '<a href="'.$urlP.$row['pdf'].'" target="_blank" style=" font-weight: bold; font-size: 14.5px; font-family: Arial Narrow;">"'.$periodico.'" '.$row['seccion'].' '.$fecha.' Pag.'.$row['PaginaPeriodico'].'</a></span>'; 
            }
            else
            {
              $mensaje .= '<a href="'.$link.'" target="_blank" style=" font-weight: bold; font-size: 14.5px; font-family: Arial Narrow;">'.$link.'</a></span>'; 
            } 
            
            
            $mensaje .='
                  <br><br><br>'; 

            $idDuplicados[]=$row['idEditorial'];
        }        
      }
  }else{
//      $mensaje.='
//               <tr>
//                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
//                <th width=""></th>
//                <th width="">&nbsp;</th>
//              </tr>';
  } 
    return $mensaje;
}

function recuperaDatosColumnas($sql, $titulo, $buscar = array())
{
  $urlP = "http://187.247.253.5";
  //$urlP = "http://192.168.3.154";
mysql_query("SET NAMES 'utf8'");
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
       

        //$texto = ( !empty($buscar) )? highlight( utf8_encode($row['Texto']) , $buscar) : utf8_encode($row['Texto']); 
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
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">'.sanear_string2($titulo).' - '.$periodico.' - '.$row['NumeroPagina'].' - '.ucwords(strtolower($row['Autor'])).' - '.$row['Categoria'].'</td>
              </tr>
              
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 14px;">
                  '.wordlimit($texto).'
                </td>
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
      
  }else{
//      $mensaje.='
//               <tr>
//                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
//                <th width=""></th>
//                <th width="">&nbsp;</th>
//              </tr>';
  } 
  return $mensaje;
}


function recuperaDatosWEB($sql, $titulo, $buscar = array())
{
  $urlP = "http://187.247.253.5";
 
mysql_query("SET NAMES 'utf8'");
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
       

        //$texto = ( !empty($buscar) )? highlight( utf8_encode($row['Texto']) , $buscar) : utf8_encode($row['Texto']); 
          
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

        $encabezado = $row['Encabezado'];

        $mensaje .='
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">'.sanear_string2($titulo).' - '.$periodico.'</td>
              </tr>
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 14px;">
                  '.wordlimit($texto).'
                </td>
              </tr>
              <tr>
                <td colspan="3" align="left"><strong>Secci&oacute;n : </strong>'.$row['seccion'].'&nbsp;  &nbsp; &nbsp;<strong>Autor: </strong>'.  ucwords(strtolower($row['Autor'])).'</td>
              </tr>
              <tr>
                <td colspan="3">
                  <a href="'.$encabezado.'" target="_blank">Ir a la Nota</a> &nbsp;  &nbsp; &nbsp; Link: <span style="color: blue;text-decoration: underline;">'.$encabezado.'</span>
                </td>
              </tr>
               <tr style="height: 10px;">
               <td colspan="3"></td>
                </tr>'; 
      }        
      
  }else{
//      $mensaje.='
//               <tr>
//                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
//                <th width=""></th>
//                <th width="">&nbsp;</th>
//              </tr>';
  } 
  return $mensaje;
}



function cintillos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";
mysql_query("SET NAMES 'utf8'");
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

/*
$mensaje ='
<html lang="es">
  <head>
  <meta charset="utf-8"/>
        <meta content="es"/>
        <meta lang="es"/>
        <meta http-equiv="Content-Language" content="es">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
  </head>
 
  <body style="font-family: Arial Narrow;">
<table width="70%" align="center" cellspacing="0" border="0" style="font-size: 12px;">
 <tr>
    <td colspan="3" align="center"><img src="'.$urlP.'/external/services/mail/inee/inee.jpg" style="width: 280px;"></td>
 </tr>';
 */

 $mensaje ='
<html lang="es">
  <head>
  <meta charset="utf-8"/>
        <meta content="es"/>
        <meta lang="es"/>
        <meta http-equiv="Content-Language" content="es">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
  </head>
 
  <body style="font-family: Arial Narrow;">';

/*******INICIO QUERYS INDICE TEMATICO*******/


//QUERY INEE
$qryINEE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
$qryINEEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
         )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    " INEE ",
    " (INEE)",
    "Instituto Nacional para la Evaluacion de la Educacion",
    "Instituto Naciónal para la Evaluación de la Educación",
    "Instituto Nacional para la Evaluación Educativa",
    "Instituto Nacional para la Evaluación de la Educación",
    "Margarita Zorrilla Fierro",
    "Margarita Zorrilla",
    "Zorrilla Fierro",
    "Eduardo Backhoff Escudero",
    "Backhoff Escudero",
    "Sylvia Schmelkes del Valle",
    "Sylvia Schmelkes Del Valle",
    "Schmelkes del Valle",
    "Schmelkes Del Valle",
    "Sylvia Schmelkes"
);

$mensaje .= recuperaDatos($qryINEE, $titulo = "INEE", $buscar,1 );
$mensaje .= recuperaDatos($qryINEEWeb, $titulo = "Web", $buscar,2 );


//QUERY Funcionarios
$qryFuncionarios="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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

    //QUERY Funcionarios
$qryFuncionariosWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
      fecha = CURDATE() AND
    (
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
    ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    "Sylvia Irene Schmelkes del Valle",
    "Sylvia Schmelkes del Valle",
    "Margarita Maria zorrilla fierro",
    "Margarita zorrilla fierro",
    "Teresa Bracho González",
    "Gilberto Ramón Guevara Niebla",
    "Gilberto Guevara Niebla",
    "Eduardo Backhoff Escudero",
    "Francisco Miranda López",
    "Jorge Antonio Hernández Uralde",
    "Jorge Hernández Uralde",
    "Agustín Caso Raphael",
    "Luis Castillo Montes"
);

$mensaje .= recuperaDatos($qryFuncionarios, $titulo = "Funcionarios", $buscar,1 );
$mensaje .= recuperaDatos($qryFuncionariosWeb, $titulo = "Web", $buscar,2 );


//QUERY Reforma Educativa
$qryRE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
           n.Categoria!=80 AND
      fecha = CURDATE() AND
    (
      Texto LIKE '%Reforma Educativa%' OR

      Titulo LIKE '%Reforma Educativa%' OR

      Encabezado LIKE '%Reforma Educativa%'
    )
    GROUP BY idEditorial
    ORDER BY o.posicion";

    //QUERY Reforma Educativa
$qryREWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
      fecha = CURDATE() AND
    (
      Texto LIKE '%Reforma Educativa%' OR

      Titulo LIKE '%Reforma Educativa%' OR

      Encabezado LIKE '%Reforma Educativa%'
    )
    ORDER BY e.idEstado,p.Nombre";

$buscar = array(
        "Reforma Educativa",
        "reforma educativa",
        "Reforma educativa",
        "reformas educativas",
        "Reformas educativas",
        "Reformas Educativas"
);

$mensaje .= recuperaDatos($qryRE, $titulo = "Reforma Educativa", $buscar,1 );
$mensaje .= recuperaDatos($qryREWeb, $titulo = "Web", $buscar,2 );


//QUERY SEN
$qrySEN="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
      fecha = CURDATE() AND
    (
      Texto LIKE 'SEN' OR
      Texto LIKE '%Sistema Educativo Nacional%' OR
        
      Titulo LIKE 'SEN' OR
      Titulo LIKE '%Sistema Educativo Nacional%' OR
      
      Encabezado LIKE 'SEN' OR
      Encabezado LIKE '%Sistema Educativo Nacional%'
    )
    ORDER BY o.posicion";

    //QUERY SEN
$qrySENWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
      fecha = CURDATE() AND
    (
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

$mensaje .= recuperaDatos($qrySEN, $titulo = "Sistema Educativo Nacional", $buscar,1 );
$mensaje .= recuperaDatos($qrySENWeb, $titulo = "Web", $buscar,2 );


//QUERY SNEE
$qrySNEE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
      fecha = CURDATE() AND
    (
      Texto LIKE 'SNEE' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
      Titulo LIKE 'SNEE' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
      
      Encabezado LIKE 'SNEE' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
    )
    ORDER BY o.posicion";

    //QUERY SNEE
$qrySNEEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
      fecha = CURDATE() AND
    (
      Texto LIKE 'SNEE' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
      Titulo LIKE 'SNEE' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
      
      Encabezado LIKE 'SNEE' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
    )
    ORDER BY e.idEstado,p.Nombre";

$buscar = array(
  " SNEE ",
  "Sistema Nacional de Evaluacion Educativa"
);

$mensaje .= recuperaDatos($qrySNEE, $titulo = "SNEE", $buscar,1 );
$mensaje .= recuperaDatos($qrySNEEWeb, $titulo = "Web", $buscar,2 );


//QUERY PNEE
$qryPNEE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE 'PNEE' OR
        Texto LIKE '%Política Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE 'PNEE' OR
        Titulo LIKE '%Política Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE 'PNEE' OR
        Encabezado LIKE '%Política Nacional de Evaluación Educativa%'
      )
      ORDER BY o.posicion";

      //QUERY PNEE
$qryPNEEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
      fecha = CURDATE() AND
    (
      Texto LIKE 'PNEE' OR
      Texto LIKE '%Política Nacional de Evaluación Educativa%' OR
        
      Titulo LIKE 'PNEE' OR
      Titulo LIKE '%Política Nacional de Evaluación Educativa%' OR
      
      Encabezado LIKE 'PNEE' OR
      Encabezado LIKE '%Política Nacional de Evaluación Educativa%'
    )
    ORDER BY e.idEstado,p.Nombre";

$buscar = array(
      " PNEE ",
      " Politica Nacional de Evaluacion Educativa "
);

$mensaje .= recuperaDatos($qryPNEE, $titulo = "PNEE", $buscar ,1);
$mensaje .= recuperaDatos($qryPNEEWeb, $titulo = "Web", $buscar ,2);


//QUERY SPD
$qrySPD="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE 'SPD' OR
        Texto LIKE '%Servicio Profesional Docente%' OR
          
        Titulo LIKE 'SPD' OR
        Titulo LIKE '%Servicio Profesional Docente%' OR
        
        Encabezado LIKE 'SPD' OR
        Encabezado LIKE '%Servicio Profesional Docente%'
      )
      ORDER BY o.posicion";

      //QUERY SPD
$qrySPDWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
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

$mensaje .= recuperaDatos($qrySPD, $titulo = "Servicio Profesional Docente", $buscar ,1);
$mensaje .= recuperaDatos($qrySPDWeb, $titulo = "Web", $buscar ,2);


//QUERY PRUEBA
$qryPRUEBA="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND 
      (
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

      //QUERY PRUEBA
$qryPRUEBAWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
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
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
        "prueba enlace",
        "prueba excale",
        "prueba pisa",
        "Evaluacion Nacional de Logro Academico en Centros Escolares",
        "Programme for International Student Assessment",
        "Programa para la Evaluacion Internacional de los Estudiantes",
        "Examen de la Calidad y el Logro Educativo"
);

$mensaje .= recuperaDatos($qryPRUEBA, $titulo = "PRUEBA", $buscar ,1);
$mensaje .= recuperaDatos($qryPRUEBAWeb, $titulo = "Web", $buscar ,2);


//QUERY Evaluación educativa / Evaluación de la educación
$qryEE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Evaluación educativa%' OR
      Texto LIKE '%Evaluación de la educación%' OR
          
        Titulo LIKE '%Evaluación educativa%' OR
      Titulo LIKE '%Evaluación de la educación%' OR
        
        Encabezado LIKE '%Evaluación educativa%' OR
      Encabezado LIKE '%Evaluación de la educación%'
      )
      ORDER BY o.posicion";

      //QUERY Evaluación educativa / Evaluación de la educación
$qryEEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Evaluación educativa%' OR
      Texto LIKE '%Evaluación de la educación%' OR
          
        Titulo LIKE '%Evaluación educativa%' OR
      Titulo LIKE '%Evaluación de la educación%' OR
        
        Encabezado LIKE '%Evaluación educativa%' OR
      Encabezado LIKE '%Evaluación de la educación%'
      )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    "Evaluacion Educativa",
    "Evaluacion de la Educacion",
    "Evaluación de la Educación"
);

$mensaje .= recuperaDatos($qryEE, $titulo = "Evaluación educativa / Evaluación de la educación", $buscar ,1);
$mensaje .= recuperaDatos($qryEEWeb, $titulo = "Web", $buscar ,2);


//QUERY Conferencia del Sistema Nacional de Evaluación Educativa
$qryCSN="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
      )
      ORDER BY o.posicion";

      //QUERY Conferencia del Sistema Nacional de Evaluación Educativa
$qryCSNWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Texto LIKE '%Sistema Nacional de Evaluación Educativa%' OR
          
        Titulo LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Titulo LIKE '%Sistema Nacional de Evaluación Educativa%' OR
        
        Encabezado LIKE '%Conferencia del Sistema Nacional de Evaluación Educativa%' OR
      Encabezado LIKE '%Sistema Nacional de Evaluación Educativa%'
      )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    "Conferencia del Sistema Nacional de Evaluacion Educativa",
    "Sistema Nacional de Evaluacion Educativa"
);

$mensaje .= recuperaDatos($qryCSN, $titulo = "Conferencia del Sistema Nacional de Evaluación Educativa", $buscar ,1);
$mensaje .= recuperaDatos($qryCSNWeb, $titulo = "Web", $buscar ,2);


//QUERY CONSCEE
$qryCONSCEE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Texto LIKE '%CONSCEE%' OR
          
        Titulo LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Titulo LIKE '%CONSCEE%' OR
        
        Encabezado LIKE '%Consejo Social Consultivo de Evaluacion de la Educación%' OR
      Encabezado LIKE '%CONSCEE%'
      )
      ORDER BY o.posicion";

      //QUERY CONSCEE
$qryCONSCEEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejo Social Consultivo de Evaluación de la Educaciónx%' OR
      Texto LIKE '%CONSCEE%' OR
          
        Titulo LIKE '%Consejo Social Consultivo de Evaluación de la Educaciónx%' OR
      Titulo LIKE '%CONSCEE%' OR
        
        Encabezado LIKE '%Consejo Social Consultivo de Evaluación de la Educaciónx%' OR
      Encabezado LIKE '%CONSCEE%'
      )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    "CONSCEE",
    "Consejo Social Consultivo de Evaluacion de la Educacion"
);

$mensaje .= recuperaDatos($qryCONSCEE, $titulo = "Consejo Social Consultivo de Evaluacion de la Educación", $buscar ,1);
$mensaje .= recuperaDatos($qryCONSCEEWeb, $titulo = "Web", $buscar ,2);


//QUERY CONVIE
$qryCONVIE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
      fecha = CURDATE() AND
    (
      Texto LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Texto LIKE 'CONVIE' OR
        
      Titulo LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Titulo LIKE 'CONVIE' OR
      
      Encabezado LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
    Encabezado LIKE 'CONVIE'
    )
    ORDER BY o.posicion";

    //QUERY CONVIE
$qryCONVIEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
      Texto LIKE 'CONVIE' OR
          
        Titulo LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
      Titulo LIKE 'CONVIE' OR
        
        Encabezado LIKE '%Consejo de Vinculación con las Entidades Federativas%' OR
      Encabezado LIKE 'CONVIE'
      )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    "CONVIE",
    "Consejo de Vinculacion con las Entidades Federativas"
);

$mensaje .= recuperaDatos($qryCONVIE, $titulo = "Consejo de Vinculación con las Entidades Federativas", $buscar ,1);
$mensaje .= recuperaDatos($qryCONVIEWeb, $titulo = "Web", $buscar ,2);


//QUERY CONPEE
$qryCONPEE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Texto LIKE 'CONPEE' OR
          
        Titulo LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Titulo LIKE 'CONPEE' OR
        
        Encabezado LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Encabezado LIKE 'CONPEE'
      )
      ORDER BY o.posicion";

      //QUERY CONPEE
$qryCONPEEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Texto LIKE 'CONPEE' OR
          
        Titulo LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Titulo LIKE 'CONPEE' OR
        
        Encabezado LIKE '%Consejo Pedagógico de Evaluación Educativa%' OR
      Encabezado LIKE 'CONPEE'
      )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
      "CONPEE",
      "Consejo Pedagogico de Evaluacion Educativa"
);

$mensaje .= recuperaDatos($qryCONPEE, $titulo = "Consejo Pedagógico de Evaluación Educativa", $buscar ,1);
$mensaje .= recuperaDatos($qryCONPEEWeb, $titulo = "Web", $buscar ,2);


//QUERY CONTE
$qryCONTE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejos Técnicos Especializados%' OR
      Texto LIKE 'CONTE' OR
          
        Titulo LIKE '%Consejos Técnicos Especializados%' OR
      Titulo LIKE 'CONTE' OR
        
        Encabezado LIKE '%Consejos Técnicos Especializados%' OR
      Encabezado LIKE 'CONTE'
      )
      ORDER BY o.posicion";

      //QUERY CONTE
$qryCONTEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE '%Consejos Técnicos Especializados%' OR
      Texto LIKE 'CONTE' OR
          
        Titulo LIKE '%Consejos Técnicos Especializados%' OR
      Titulo LIKE 'CONTE' OR
        
        Encabezado LIKE '%Consejos Técnicos Especializados%' OR
      Encabezado LIKE 'CONTE'
      )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
      "CONTE",
      "Consejos Tecnicos Especializados"
);

$mensaje .= recuperaDatos($qryCONTE, $titulo = "Consejos Técnicos Especializados", $buscar ,1);
$mensaje .= recuperaDatos($qryCONTEWeb, $titulo = "Web", $buscar ,2);


//QUERY SEP
$qrySEP="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE ' SEP ' OR
        Texto LIKE '%Secretaría de Educación Pública%' OR
          
        Titulo LIKE ' SEP ' OR
        Titulo LIKE '%Secretaría de Educación Pública%' OR
        
        Encabezado LIKE ' SEP ' OR
        Encabezado LIKE '%Secretaría de Educación Pública%'
      )
      ORDER BY o.posicion";

      //QUERY SEP
$qrySEPWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE 'SEP' OR
        Texto LIKE '%Secretaría de Educación Pública%' OR
          
        Titulo LIKE 'SEP' OR
        Titulo LIKE '%Secretaría de Educación Pública%' OR
        
        Encabezado LIKE 'SEP' OR
        Encabezado LIKE '%Secretaría de Educación Pública%'
      )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    "Secretaria de Educacion Publica",
    "Secretaria de Educacion Pública",
    "Secretaría de Educación Pública",
    "SEP",
    "(SEP)"
);

$mensaje .= recuperaDatos($qrySEP, $titulo = "Secretaría de Educación Pública", $buscar ,1);
$mensaje .= recuperaDatos($qrySEPWeb, $titulo = "Web", $buscar ,2);


//QUERY SNTE
$qrySNTE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE 'SNTE' OR
        Texto LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
          
        Titulo LIKE 'SNTE' OR
        Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
        
        Encabezado LIKE 'SNTE' OR
        Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educación%'
      )
      ORDER BY o.posicion";

      //QUERY SNTE
$qrySNTEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
        fecha = CURDATE() AND
      (
        Texto LIKE 'SNTE' OR
        Texto LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
          
        Titulo LIKE 'SNTE' OR
        Titulo LIKE '%Sindicato Nacional de Trabajadores de la Educación%' OR
        
        Encabezado LIKE 'SNTE' OR
        Encabezado LIKE '%Sindicato Nacional de Trabajadores de la Educación%'
      )
      ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    "SNTE",
    "Sindicato Nacional de Trabajadores de la Educación"
);

$mensaje .= recuperaDatos($qrySNTE, $titulo = "Sindicato Nacional de Trabajadores de la Educación", $buscar ,1);
$mensaje .= recuperaDatos($qrySNTEWeb, $titulo = "Web", $buscar ,2);


//QUERY CNTE
$qryCNTE="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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

      //QUERY CNTE
$qryCNTEWeb="SELECT
      n.Cutted,
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
        n.PieFoto,
      n.cutted
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
    "Coordinadora Nacional de Trabajadores de la Educación"
);

$mensaje .= recuperaDatos($qryCNTE, $titulo = "Coordinadora Nacional de Trabajadores de la Educacion", $buscar ,1);
$mensaje .= recuperaDatos($qryCNTEWeb, $titulo = "Web", $buscar ,2);

/*******FIN QUERYS INDICE TEMATICO*******/

/*
$mensaje.='
</table>
</body>
</html>';
*/
$mensaje.='
</body>
</html>';
/*
require_once '/var/www/external/mail/phpdocx/classes/CreateDocx.inc';
 
$docx = new CreateDocx();
 

$docx->embedHTML($mensaje);
 
$docx->createDocx('simpleHTML'); 
*/
echo $mensaje;

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

function convert_Mayus($string)
{
  $string = trim($string);

    $string = str_replace(
        array('á', 'é', 'í', 'ó', 'ú', 'ñ'),
        array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'),
        $string
    );

  return $string;
}

function sanear_string2($url) {
 

  $url = str_replace(
        array("\x1F","\x16","&"),
        array(" ", " ","Y"),
        $url
    );
 
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