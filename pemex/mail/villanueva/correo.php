
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


function recuperaDatos($sql, $titulo, $buscar = array())
{
  $mensaje= "";
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
              }


        $titulo = correctorOrtografico($row['Titulo'] );
        $titulo =  ( !empty($buscar) )? highlight( $titulo, $buscar) : $titulo ;

        $encabezado = correctorOrtografico($row['Encabezado'] );
        $encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;

        $mensaje .='
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">'.sanear_string2($titulo).' - '.$periodico.' - '.$row['NumeroPagina'].' - '.ucwords(strtolower($row['Autor'])).' - '.$row['Categoria'].'</td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 14px;">
                  '.($texto).'
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

function tablaContador($contador,$medios,$actor)
{
  $mensaje = "<tr>";
  $mensaje .= "<td align='center'>".actor($actor)."</td>";

  $result = mysql_query($contador);
  while($row = mysql_fetch_array($result))
  {
    $mensaje .="<td align='center'>".$row['Total']."</td>";

  }

  $result = mysql_query($medios);
  while($row = mysql_fetch_array($result))
  {
    $mensaje .="<td align='center'>".$row['Total']."</td>";

  }

  $mensaje .="</tr>";

  return $mensaje;


}

function actor($numID)
{
    $actor = "";
    switch($numID)
    {
        case 1:
            $actor = "Ricardo Villanueva Lomeli";
        break;

        case 2:
            $actor = "Enrique Alfaro Ramirez";
        break;

        case 3:
            $actor = "Alfonso Petersen Farah";
        break;

        case 4:
            $actor = "Guillermo Cienfuegos Perez";
        break;

        case 5:
            $actor = "Celia Fausto Lizaola";
        break;

        case 6:
            $actor = "RVL-EAR";
        break;

        case 7:
            $actor = "RVL-APF";
        break;

        case 8:
            $actor = "RVL-GCP";
        break;

        case 9:
            $actor = "RVL-CFL";
        break;
    }
    return $actor;
}

$mensaje ='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<html lang="es">
  <head>
  <meta charset="utf-8"/>
        <meta content="es"/>
        <meta lang="es"/>
        <meta http-equiv="Content-Language" content="es">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
  </head>

  <body>
<table width="70%" align="center" cellspacing="0" border="0" style="font-size: 12px;border: solid 1px gray;">
 <tr>
    <td colspan="3" align="center"><img src="'.$urlP.'/external/services/mail/villanueva/LogoVillanueva.png"style="width: 280px;"></td>
 </tr>

  <tr style="background-color: red; color: white;">
      <td  align="center" >Candidatos</td>
      <td  align="center" >Notas</td>
      <td  align="center" >No. Medios</td>
  </tr>';


//Query Contador de Notas Ricardo Villanueva
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND  (
	Texto like '%Ricardo Villanueva Lomeli%' OR
	Texto like '%Villanueva Lomeli%' OR
	Texto like '%Ricardo Villanueva%' OR

	Titulo like '%Ricardo Villanueva Lomeli%' OR
	Titulo like '%Villanueva Lomeli%' OR
	Titulo like '%Ricardo Villanueva%' OR

	Encabezado like '%Ricardo Villanueva Lomeli%' OR
	Encabezado like '%Villanueva Lomeli%' OR
	Encabezado like '%Ricardo Villanueva%' OR

	PieFoto like '%Ricardo Villanueva Lomeli%' OR
	PieFoto like '%Villanueva Lomeli%' OR
	PieFoto like '%Ricardo Villanueva%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Ricardo Villanueva Lomeli%' OR
  Texto like '%Villanueva Lomeli%' OR
  Texto like '%Ricardo Villanueva%' OR

  Titulo like '%Ricardo Villanueva Lomeli%' OR
  Titulo like '%Villanueva Lomeli%' OR
  Titulo like '%Ricardo Villanueva%' OR

  Encabezado like '%Ricardo Villanueva Lomeli%' OR
  Encabezado like '%Villanueva Lomeli%' OR
  Encabezado like '%Ricardo Villanueva%' OR

  PieFoto like '%Ricardo Villanueva Lomeli%' OR
  PieFoto like '%Villanueva Lomeli%' OR
  PieFoto like '%Ricardo Villanueva%'
)";

$mensaje .= tablaContador($qryContador,$qryMedios,1);

//Query Contador de Notas Enrique Alfaro
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo  like '%Enrique Alfaro Ramirez%' OR
  Titulo  like '%Enrique Alfaro%' OR
  Titulo  like '%Alfaro Ramirez%' OR

  Encabezado  like '%Enrique Alfaro Ramirez%' OR
  Encabezado  like '%Enrique Alfaro%' OR
  Encabezado  like '%Alfaro Ramirez%' OR

  PieFoto  like '%Enrique Alfaro Ramirez%' OR
  PieFoto  like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND  (
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo  like '%Enrique Alfaro Ramirez%' OR
  Titulo  like '%Enrique Alfaro%' OR
  Titulo  like '%Alfaro Ramirez%' OR

  Encabezado  like '%Enrique Alfaro Ramirez%' OR
  Encabezado  like '%Enrique Alfaro%' OR
  Encabezado  like '%Alfaro Ramirez%' OR

  PieFoto  like '%Enrique Alfaro Ramirez%' OR
  PieFoto  like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)";

$mensaje .= tablaContador($qryContador,$qryMedios,2);

//Query Contador de Notas Alfonso Petersen
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Alfonso Petersen Farah%' OR
  Texto like '%Alfonso Petersen%' OR

  Titulo like '%Alfonso Petersen Farah%' OR
  Titulo like '%Alfonso Petersen%' OR

  Encabezado like '%Alfonso Petersen Farah%' OR
  Encabezado like '%Alfonso Petersen%' OR

  PieFoto like '%Alfonso Petersen Farah%' OR
  PieFoto like '%Alfonso Petersen%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND   (
  Texto like '%Alfonso Petersen Farah%' OR
  Texto like '%Alfonso Petersen%' OR

  Titulo like '%Alfonso Petersen Farah%' OR
  Titulo like '%Alfonso Petersen%' OR

  Encabezado like '%Alfonso Petersen Farah%' OR
  Encabezado like '%Alfonso Petersen%' OR

  PieFoto like '%Alfonso Petersen Farah%' OR
  PieFoto like '%Alfonso Petersen%'
)";

$mensaje .= tablaContador($qryContador,$qryMedios,3);

//Query Contador de Notas Guillermo Cienfuegos
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Guillermo Cienfuegos Perez%' OR
  Texto  like '%Guillermo Cienfuegos%' OR
    Texto  like '%Cienfuegos Perez%' OR
    Texto  like '%lagrimita%' OR

  Titulo  like '%Guillermo Cienfuegos Perez%' OR
  Titulo  like '%Guillermo Cienfuegos%' OR
    Titulo  like '%Cienfuegos Perez%' OR
    Titulo  like '%lagrimita%' OR

  Encabezado  like '%Guillermo Cienfuegos Perez%' OR
  Encabezado  like '%Guillermo Cienfuegos%' OR
    Encabezado  like '%Cienfuegos Perez%' OR
    Encabezado  like '%lagrimita%' OR

  PieFoto  like '%Guillermo Cienfuegos Perez%' OR
  PieFoto  like '%Guillermo Cienfuegos%' OR
    PieFoto like '%Cienfuegos Perez%' OR
    PieFoto  like '%lagrimita%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND  (
  Texto like '%Guillermo Cienfuegos Perez%' OR
  Texto  like '%Guillermo Cienfuegos%' OR
    Texto  like '%Cienfuegos Perez%' OR
    Texto  like '%lagrimita%' OR

  Titulo  like '%Guillermo Cienfuegos Perez%' OR
  Titulo  like '%Guillermo Cienfuegos%' OR
    Titulo  like '%Cienfuegos Perez%' OR
    Titulo  like '%lagrimita%' OR

  Encabezado  like '%Guillermo Cienfuegos Perez%' OR
  Encabezado  like '%Guillermo Cienfuegos%' OR
    Encabezado  like '%Cienfuegos Perez%' OR
    Encabezado  like '%lagrimita%' OR

  PieFoto  like '%Guillermo Cienfuegos Perez%' OR
  PieFoto  like '%Guillermo Cienfuegos%' OR
    PieFoto like '%Cienfuegos Perez%' OR
    PieFoto  like '%lagrimita%'
)";


$mensaje .= tablaContador($qryContador,$qryMedios,4);

//Query Contador de Notas Celia Fausto
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Celia fausto Lizaola%' OR
  Texto like '%Celia fausto%' OR
  Texto like '%fausto Lizaola%' OR

  Titulo like '%Celia fausto Lizaola%' OR
  Titulo like '%Celia fausto%' OR
  Titulo like '%fausto Lizaola%' OR

  Encabezado like '%Celia fausto Lizaola%' OR
  Encabezado like '%Celia fausto%' OR
  Encabezado like '%fausto Lizaola%' OR

  PieFoto like '%Celia fausto Lizaola%' OR
  PieFoto like '%Celia fausto%' OR
  PieFoto like '%fausto Lizaola%' OR

  Autor like '%Celia fausto Lizaola%' OR
  Autor like '%Celia fausto%' OR
  Autor like '%fausto Lizaola%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND  (
  Texto like '%Celia fausto Lizaola%' OR
  Texto like '%Celia fausto%' OR
  Texto like '%fausto Lizaola%' OR

  Titulo like '%Celia fausto Lizaola%' OR
  Titulo like '%Celia fausto%' OR
  Titulo like '%fausto Lizaola%' OR

  Encabezado like '%Celia fausto Lizaola%' OR
  Encabezado like '%Celia fausto%' OR
  Encabezado like '%fausto Lizaola%' OR

  PieFoto like '%Celia fausto Lizaola%' OR
  PieFoto like '%Celia fausto%' OR
  PieFoto like '%fausto Lizaola%' OR

  Autor like '%Celia fausto Lizaola%' OR
  Autor like '%Celia fausto%' OR
  Autor like '%fausto Lizaola%'
)";

$mensaje .= tablaContador($qryContador,$qryMedios,5);


//Query Contador de Notas Ricardo Villanueva-Enrique Alfaro
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo  like '%Enrique Alfaro Ramirez%' OR
  Titulo  like '%Enrique Alfaro%' OR
  Titulo  like '%Alfaro Ramirez%' OR

  Encabezado  like '%Enrique Alfaro Ramirez%' OR
  Encabezado  like '%Enrique Alfaro%' OR
  Encabezado  like '%Alfaro Ramirez%' OR

  PieFoto  like '%Enrique Alfaro Ramirez%' OR
  PieFoto  like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo  like '%Enrique Alfaro Ramirez%' OR
  Titulo  like '%Enrique Alfaro%' OR
  Titulo  like '%Alfaro Ramirez%' OR

  Encabezado  like '%Enrique Alfaro Ramirez%' OR
  Encabezado  like '%Enrique Alfaro%' OR
  Encabezado  like '%Alfaro Ramirez%' OR

  PieFoto  like '%Enrique Alfaro Ramirez%' OR
  PieFoto  like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)";

$mensaje .= tablaContador($qryContador,$qryMedios,6);


//Query Contador de Notas Ricardo Villanueva-Alfonso Petersen
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Alfonso Petersen Farah%' OR
  Texto like '%Alfonso Petersen%' OR

  Titulo like '%Alfonso Petersen Farah%' OR
  Titulo like '%Alfonso Petersen%' OR

  Encabezado like '%Alfonso Petersen Farah%' OR
  Encabezado like '%Alfonso Petersen%' OR

  PieFoto like '%Alfonso Petersen Farah%' OR
  PieFoto like '%Alfonso Petersen%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND  (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Alfonso Petersen Farah%' OR
  Texto like '%Alfonso Petersen%' OR

  Titulo like '%Alfonso Petersen Farah%' OR
  Titulo like '%Alfonso Petersen%' OR

  Encabezado like '%Alfonso Petersen Farah%' OR
  Encabezado like '%Alfonso Petersen%' OR

  PieFoto like '%Alfonso Petersen Farah%' OR
  PieFoto like '%Alfonso Petersen%'
)";

$mensaje .= tablaContador($qryContador,$qryMedios,7);


//Query Contador de Notas Ricardo Villanueva-Guillermo Cienfuegos
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Guillermo Cienfuegos Perez%' OR
  Texto  like '%Guillermo Cienfuegos%' OR
    Texto  like '%Cienfuegos Perez%' OR
    Texto  like '%lagrimita%' OR

  Titulo  like '%Guillermo Cienfuegos Perez%' OR
  Titulo  like '%Guillermo Cienfuegos%' OR
    Titulo  like '%Cienfuegos Perez%' OR
    Titulo  like '%lagrimita%' OR

  Encabezado  like '%Guillermo Cienfuegos Perez%' OR
  Encabezado  like '%Guillermo Cienfuegos%' OR
    Encabezado  like '%Cienfuegos Perez%' OR
    Encabezado  like '%lagrimita%' OR

  PieFoto  like '%Guillermo Cienfuegos Perez%' OR
  PieFoto  like '%Guillermo Cienfuegos%' OR
    PieFoto  like '%Cienfuegos Perez%' OR
    PieFoto  like '%lagrimita%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND  (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Guillermo Cienfuegos Perez%' OR
  Texto  like '%Guillermo Cienfuegos%' OR
    Texto  like '%Cienfuegos Perez%' OR
    Texto  like '%lagrimita%' OR

  Titulo  like '%Guillermo Cienfuegos Perez%' OR
  Titulo  like '%Guillermo Cienfuegos%' OR
    Titulo  like '%Cienfuegos Perez%' OR
    Titulo  like '%lagrimita%' OR

  Encabezado  like '%Guillermo Cienfuegos Perez%' OR
  Encabezado  like '%Guillermo Cienfuegos%' OR
    Encabezado  like '%Cienfuegos Perez%' OR
    Encabezado  like '%lagrimita%' OR

  PieFoto  like '%Guillermo Cienfuegos Perez%' OR
  PieFoto  like '%Guillermo Cienfuegos%' OR
    PieFoto  like '%Cienfuegos Perez%' OR
    PieFoto  like '%lagrimita%'
)";

$mensaje .= tablaContador($qryContador,$qryMedios,8);


//Query Contador de Notas Ricardo Villanueva-Celia Fausto
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      )  AND  (
  Texto like '%Celia fausto Lizaola%' OR
  Texto like '%Celia fausto%' OR
  Texto like '%fausto Lizaola%' OR

  Titulo like '%Celia fausto Lizaola%' OR
  Titulo like '%Celia fausto%' OR
  Titulo like '%fausto Lizaola%' OR

  Encabezado like '%Celia fausto Lizaola%' OR
  Encabezado like '%Celia fausto%' OR
  Encabezado like '%fausto Lizaola%' OR

  PieFoto like '%Celia fausto Lizaola%' OR
  PieFoto like '%Celia fausto%' OR
  PieFoto like '%fausto Lizaola%' OR

  Autor like '%Celia fausto Lizaola%' OR
  Autor like '%Celia fausto%' OR
  Autor like '%fausto Lizaola%'
)";

$qryMedios = "SELECT
     COUNT(DISTINCT(n.Periodico)) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND  (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      )  AND  (
  Texto like '%Celia fausto Lizaola%' OR
  Texto like '%Celia fausto%' OR
  Texto like '%fausto Lizaola%' OR

  Titulo like '%Celia fausto Lizaola%' OR
  Titulo like '%Celia fausto%' OR
  Titulo like '%fausto Lizaola%' OR

  Encabezado like '%Celia fausto Lizaola%' OR
  Encabezado like '%Celia fausto%' OR
  Encabezado like '%fausto Lizaola%' OR

  PieFoto like '%Celia fausto Lizaola%' OR
  PieFoto like '%Celia fausto%' OR
  PieFoto like '%fausto Lizaola%' OR

  Autor like '%Celia fausto Lizaola%' OR
  Autor like '%Celia fausto%' OR
  Autor like '%fausto Lizaola%'
)";

$mensaje .= tablaContador($qryContador,$qryMedios,9);


//$mensaje .='</table><br><br>';
$mensaje .='<br>
<tr>
    <td colspan="3" align="center"><img src="'.$urlP.'/external/services/mail/villanueva/graficaVillanueva.png" style="width: 500px;"></td>
 </tr>';


//QUERY Ricardo Villanueva Lomeli
$qryVillanueva="SELECT
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
        ordenGeneraljalisco o,
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
  Texto like '%Ricardo Villanueva Lomeli%' OR
  Texto like '%Villanueva Lomeli%' OR
  Texto like '%Ricardo Villanueva%' OR

  Titulo like '%Ricardo Villanueva Lomeli%' OR
  Titulo like '%Villanueva Lomeli%' OR
  Titulo like '%Ricardo Villanueva%' OR

  Encabezado like '%Ricardo Villanueva Lomeli%' OR
  Encabezado like '%Villanueva Lomeli%' OR
  Encabezado like '%Ricardo Villanueva%' OR

  PieFoto like '%Ricardo Villanueva Lomeli%' OR
  PieFoto like '%Villanueva Lomeli%' OR
  PieFoto like '%Ricardo Villanueva%'
)
ORDER BY o.posicion";

$buscar = array(
    " Ricardo Villanueva Lomeli ",
    "Ricardo Villanueva",
    "Villanueva Lomeli",
    "Villanueva"
);

$mensaje .= recuperaDatos($qryVillanueva, $titulo = "Ricardo Villanueva Lomeli", $buscar );



//QUERY Enrique Alfaro
$qryAlfaro="SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo  like '%Enrique Alfaro Ramirez%' OR
  Titulo  like '%Enrique Alfaro%' OR
  Titulo  like '%Alfaro Ramirez%' OR

  Encabezado  like '%Enrique Alfaro Ramirez%' OR
  Encabezado  like '%Enrique Alfaro%' OR
  Encabezado  like '%Alfaro Ramirez%' OR

  PieFoto  like '%Enrique Alfaro Ramirez%' OR
  PieFoto  like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)
ORDER BY o.posicion";
$buscar = array(
                "Enrique Alfaro Ramirez",
                "Enrique Alfaro",
                "Alfaro Ramirez",
        );


$mensaje .= recuperaDatos($qryAlfaro, $titulo = "Enrique Alfaro Ramirez", $buscar );




//QUERY Alfonso Petersen
$qryPetersen = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  Texto like '%Alfonso Petersen Farah%' OR
  Texto like '%Alfonso Petersen%' OR

  Titulo like '%Alfonso Petersen Farah%' OR
  Titulo like '%Alfonso Petersen%' OR

  Encabezado like '%Alfonso Petersen Farah%' OR
  Encabezado like '%Alfonso Petersen%' OR

  PieFoto like '%Alfonso Petersen Farah%' OR
  PieFoto like '%Alfonso Petersen%'
)
ORDER BY o.posicion";
$buscar = array(
        "Alfonso Petersen Farah",
        "Alfonso Petersen"
);


$mensaje .= recuperaDatos($qryPetersen, $titulo = "Alfonso Petersen Farah", $buscar );

//QUERY Guillermo Cienfuegos Perez
$qryCienfuegos = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  Texto like '%Guillermo Cienfuegos Perez%' OR
  Texto  like '%Guillermo Cienfuegos%' OR
    Texto  like '%Cienfuegos Perez%' OR
    Texto  like '%lagrimita%' OR

  Titulo  like '%Guillermo Cienfuegos Perez%' OR
  Titulo  like '%Guillermo Cienfuegos%' OR
    Titulo  like '%Cienfuegos Perez%' OR
    Titulo  like '%lagrimita%' OR

  Encabezado  like '%Guillermo Cienfuegos Perez%' OR
  Encabezado  like '%Guillermo Cienfuegos%' OR
    Encabezado  like '%Cienfuegos Perez%' OR
    Encabezado  like '%lagrimita%' OR

  PieFoto  like '%Guillermo Cienfuegos Perez%' OR
  PieFoto  like '%Guillermo Cienfuegos%' OR
    PieFoto like '%Cienfuegos Perez%' OR
    PieFoto  like '%lagrimita%'
)
ORDER BY o.posicion";
$buscar = array(
        "Guillermo Cienfuegos Perez",
        "Guillermo Cienfuegos",
        "Cienfuegos Perez",
        "Lagrimita"
);
$mensaje .= recuperaDatos($qryCienfuegos, $titulo = "Guillermo Cienfuegos Perez", $buscar );

//QUERY Celia fausto Lizaola
$qryCeliaFausto = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  fecha = CURDATE() AND  (
  Texto like '%Celia fausto Lizaola%' OR
  Texto like '%Celia fausto%' OR
  Texto like '%fausto Lizaola%' OR

  Titulo like '%Celia fausto Lizaola%' OR
  Titulo like '%Celia fausto%' OR
  Titulo like '%fausto Lizaola%' OR

  Encabezado like '%Celia fausto Lizaola%' OR
  Encabezado like '%Celia fausto%' OR
  Encabezado like '%fausto Lizaola%' OR

  PieFoto like '%Celia fausto Lizaola%' OR
  PieFoto like '%Celia fausto%' OR
  PieFoto like '%fausto Lizaola%' OR

  Autor like '%Celia fausto Lizaola%' OR
  Autor like '%Celia fausto%' OR
  Autor like '%fausto Lizaola%'
)
ORDER BY o.posicion";
$buscar = array(
        "Celia fausto Lizaola",
        "Celia fausto",
        "fausto Lizaola"
);
$mensaje .= recuperaDatos($qryCeliaFausto, $titulo = "Celia Fausto Lizaola", $buscar );


//QUERY Villanueva-Alfaro
$qryVillanuevaAlfaro = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  fecha = CURDATE() AND  (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo  like '%Enrique Alfaro Ramirez%' OR
  Titulo  like '%Enrique Alfaro%' OR
  Titulo  like '%Alfaro Ramirez%' OR

  Encabezado  like '%Enrique Alfaro Ramirez%' OR
  Encabezado  like '%Enrique Alfaro%' OR
  Encabezado  like '%Alfaro Ramirez%' OR

  PieFoto  like '%Enrique Alfaro Ramirez%' OR
  PieFoto  like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)
ORDER BY o.posicion";
$buscar = array(
        "Ricardo Villanueva Lomeli",
    "Ricardo Villanueva",
    "Villanueva Lomeli",
    "Villanueva",
    "Enrique Alfaro Ramirez",
    "Enrique Alfaro",
    "Alfaro Ramirez"
);
$mensaje .= recuperaDatos($qryVillanuevaAlfaro, $titulo = "RVL-EAR", $buscar );



//QUERY Villanueva-Petersen
$qryVillanuevaPetersen = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  fecha = CURDATE() AND  (
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Alfonso Petersen Farah%' OR
  Texto like '%Alfonso Petersen%' OR

  Titulo like '%Alfonso Petersen Farah%' OR
  Titulo like '%Alfonso Petersen%' OR

  Encabezado like '%Alfonso Petersen Farah%' OR
  Encabezado like '%Alfonso Petersen%' OR

  PieFoto like '%Alfonso Petersen Farah%' OR
  PieFoto like '%Alfonso Petersen%'
)
ORDER BY o.posicion";
$buscar = array(
        "Ricardo Villanueva Lomeli",
    "Ricardo Villanueva",
    "Villanueva Lomeli",
    "Villanueva",
    "Alfonso Petersen Farah",
        "Alfonso Petersen"
);
$mensaje .= recuperaDatos($qryVillanuevaPetersen, $titulo = "RVL-APF", $buscar );



//QUERY Villanueva-Cienfuegos
$qryVillanuevaCienfuegos = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Guillermo Cienfuegos Perez%' OR
  Texto  like '%Guillermo Cienfuegos%' OR
    Texto  like '%Cienfuegos Perez%' OR
    Texto  like '%lagrimita%' OR

  Titulo  like '%Guillermo Cienfuegos Perez%' OR
  Titulo  like '%Guillermo Cienfuegos%' OR
    Titulo  like '%Cienfuegos Perez%' OR
    Titulo  like '%lagrimita%' OR

  Encabezado  like '%Guillermo Cienfuegos Perez%' OR
  Encabezado  like '%Guillermo Cienfuegos%' OR
    Encabezado  like '%Cienfuegos Perez%' OR
    Encabezado  like '%lagrimita%' OR

  PieFoto  like '%Guillermo Cienfuegos Perez%' OR
  PieFoto  like '%Guillermo Cienfuegos%' OR
    PieFoto  like '%Cienfuegos Perez%' OR
    PieFoto  like '%lagrimita%'
)
ORDER BY o.posicion";
$buscar = array(
        "Ricardo Villanueva Lomeli",
    "Ricardo Villanueva",
    "Villanueva Lomeli",
    "Villanueva",
    "Guillermo Cienfuegos Perez",
    "Guillermo Cienfuegos",
    "Cienfuegos Perez",
    "Lagrimita"
);
$mensaje .= recuperaDatos($qryVillanuevaCienfuegos, $titulo = "RVL-GCP", $buscar );



//QUERY Villanueva-Fausto
$qryVillanuevaFausto = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      )  AND  (
  Texto like '%Celia fausto Lizaola%' OR
  Texto like '%Celia fausto%' OR
  Texto like '%fausto Lizaola%' OR

  Titulo like '%Celia fausto Lizaola%' OR
  Titulo like '%Celia fausto%' OR
  Titulo like '%fausto Lizaola%' OR

  Encabezado like '%Celia fausto Lizaola%' OR
  Encabezado like '%Celia fausto%' OR
  Encabezado like '%fausto Lizaola%' OR

  PieFoto like '%Celia fausto Lizaola%' OR
  PieFoto like '%Celia fausto%' OR
  PieFoto like '%fausto Lizaola%' OR

  Autor like '%Celia fausto Lizaola%' OR
  Autor like '%Celia fausto%' OR
  Autor like '%fausto Lizaola%'
)
ORDER BY o.posicion";
$buscar = array(
          "Ricardo Villanueva Lomeli",
    "Ricardo Villanueva",
    "Villanueva Lomeli",
    "Villanueva",
    "Celia fausto Lizaola",
    "Celia fausto",
    "fausto Lizaola"
);
$mensaje .= recuperaDatos($qryVillanuevaFausto, $titulo = "RVL-CFL", $buscar );

/*
//QUERY Guadalajara
$qryGDL = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  Texto like '%Guadalajara%' OR
  Texto like '% GDL %' OR

  Titulo like '%Guadalajara%' OR
  Titulo like '% GDL %' OR

  Encabezado like '%Guadalajara%' OR
  Encabezado like '% GDL %' OR

  PieFoto like '%Guadalajara%' OR
  PieFoto like '% GDL %'
)
ORDER BY o.posicion";
$buscar = array(
        "Guadalajara",
        " GDL "
);

$mensaje .= recuperaDatos($qryGDL, $titulo = "Guadalajara", $buscar );
*/

/*
//QUERY Zapopan
$qryZapopan = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  Texto like '%zapopan%' OR

  Titulo like '%zapopan%' OR

  Encabezado like '%zapopan%' OR

  PieFoto like '%zapopan%'
)
ORDER BY o.posicion";
$buscar = array("zapopan");

$mensaje .= recuperaDatos($qryZapopan, $titulo = "Zapopan", $buscar );
*/
/*
//QUERY Tlajomulco
$qryTlajomulco = "SELECT
n.cutted,
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria!=80 AND
  fecha = CURDATE() AND (
  Texto like '%tlajomulco%' OR

  Titulo like '%tlajomulco%' OR

  Encabezado like '%tlajomulco%' OR

  PieFoto like '%tlajomulco%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
        "tlajomulco"
);


$mensaje .= recuperaDatos($qryTlajomulco, $titulo = "Tlajomulco", $buscar );
*/

//QUERY PRI Jalisco
$qryPRIJalisco = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  fecha = CURDATE() AND  (
  Texto like '%PRI Jalisco%' OR
  Texto like '%Hugo Contreras%' OR

  Titulo like '%PRI Jalisco%' OR
  Titulo like '%Hugo Contreras%' OR

  Encabezado like '%PRI Jalisco%' OR
  Encabezado like '%Hugo Contreras%' OR

  PieFoto like '%PRI Jalisco%' OR
  PieFoto like '%Hugo Contreras%'
)
ORDER BY o.posicion";
$buscar = array(
    "PRI Jalisco",
    "Hugo Contreras"
    );

$mensaje .= recuperaDatos($qryPRIJalisco, $titulo = "PRI Jalisco", $buscar );


// Query PAN Jalisco
$qryPANJalisco = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  fecha = CURDATE() AND   (
  Texto like '% PAN Jalisco%' OR
  Texto like '%Gustavo Macias Zambrano%' OR

  Titulo like '% PAN Jalisco%' OR
  Titulo like '%Gustavo Macias Zambrano%' OR

  Encabezado like '% PAN Jalisco%' OR
  Encabezado like '%Gustavo Macias Zambrano%' OR

  PieFoto like '% PAN Jalisco%' OR
  PieFoto like '%Gustavo Macias Zambrano%'
)
ORDER BY o.posicion";
$buscar = array(
        "PAN Jalisco",
        "Gustavo Macias Zambrano"
    );
$mensaje .= recuperaDatos($qryPANJalisco, $titulo = "PAN Jalisco", $buscar );


//QUERY PRD Jalisco
$qryPRDJalisco = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  fecha = CURDATE() AND   (
  Texto like '%PRD Jalisco%' OR
  Texto like '%Raul Vargas Lopez%' OR

  Titulo like '%PRD Jalisco%' OR
  Titulo like '%Raul Vargas Lopez%' OR

  Encabezado like '%PRD Jalisco%' OR
  Encabezado like '%Raul Vargas Lopez%' OR

  PieFoto like '%PRD Jalisco%' OR
  PieFoto like '%Raul Vargas Lopez%'
)
ORDER BY o.posicion";
$buscar = array(
        "PRD Jalisco",
        "Raul Vargas Lopez"
    );
$mensaje .= recuperaDatos($qryPRDJalisco, $titulo = "PRD Jalisco", $buscar );



//QUERY MC Jalisco
$qryMCJalisco = "SELECT
n.cutted,
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
n.Cutted
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
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
  fecha = CURDATE() AND   (
  Texto like '%Movimiento Ciudadano%' OR
  Texto like '%MC Jalisco%' OR
  Texto like '% MC %' OR
  Texto like '%Hugo Luna Vazquez%' OR
  Texto like '%Hugo Luna%' OR

  Titulo like '%Movimiento Ciudadano%' OR
  Titulo like '%MC Jalisco%' OR
  Titulo like '% MC %' OR
  Titulo like '%Hugo Luna Vazquez%' OR
  Titulo like '%Hugo Luna%' OR

  Encabezado like '%Movimiento Ciudadano%' OR
  Encabezado like '%MC Jalisco%' OR
  Encabezado like '% MC %' OR
  Encabezado like '%Hugo Luna Vazquez%' OR
  Encabezado like '%Hugo Luna%' OR

  PieFoto like '%Movimiento Ciudadano %' OR
  PieFoto like '%MC Jalisco%' OR
  PieFoto like '% MC %' OR
  PieFoto like '%Hugo Luna Vazquez%' OR
  PieFoto like '%Hugo Luna%'
)
ORDER BY o.posicion";
$buscar = array(
        "Movimiento Ciudadano",
        "MC Jalisco",
        " MC ",
        "Hugo Luna Vazquez",
        "Hugo Luna"
    );
$mensaje .= recuperaDatos($qryMCJalisco, $titulo = "MC Jalisco", $buscar );

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


//$mensaje=  utf8_decode($mensaje);

//$mensaje.='<tr> <td colspan="3" style="font-family: Arial Narrow;text-align: center;background: #FFFFFF;color: #B30000;height: 40px;font-size: 45px;text-transform: uppercase;background-color: #F3F3F3;">PORTALES WEB</td></tr>';

/*********************************************************************************************************************************************************************************************************************************************/
/*********************************************************************************************************************************************************************************************************************************************/
/*********************************************************************************************************************************************************************************************************************************************/
/*********************************************************************************************************************************************************************************************************************************************/
/*********************************************************************************************************************************************************************************************************************************************/
/*********************************************************************************************************************************************************************************************************************************************/
/*********************************************************************************************************************************************************************************************************************************************/
/*********************************************************************************************************************************************************************************************************************************************/

/*
//QUERY Ricardo Villanueva Lomeli
$qryVillanueva="SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%Ricardo Villanueva Lomeli%' OR
  Texto like '%Villanueva Lomeli%' OR
        Texto like '%Villanueva%' OR

  Titulo like '%Ricardo Villanueva Lomeli%' OR
  Titulo like '%Villanueva Lomeli%' OR
  Titulo like '%Villanueva%' OR

  Encabezado like '%Ricardo Villanueva Lomeli%' OR
  Encabezado like '%Villanueva Lomeli%' OR
  Encabezado like '%Villanueva%' OR

  PieFoto like '%Ricardo Villanueva Lomeli%' OR
  PieFoto like '%Villanueva Lomeli%' OR
  PieFoto like '%Villanueva%'
)
ORDER BY p.Estado,p.Nombre";

$buscar = array(
    " Ricardo Villanueva Lomeli ",
    "Ricardo Villanueva",
    "Villanueva Lomeli"
);

$mensaje .= recuperaDatosWEB($qryVillanueva, $titulo = "Ricardo Villanueva Lomeli", $buscar );



//QUERY Enrique Alfaro
$qryAlfaro="SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo like '%Enrique Alfaro Ramirez%' OR
  Titulo like '%Enrique Alfaro%' OR
  Titulo like '%Alfaro Ramirez%' OR

  Encabezado like '%Enrique Alfaro Ramirez%' OR
  Encabezado like '%Enrique Alfaro%' OR
  Encabezado like '%Alfaro Ramirez%' OR

  PieFoto like '%Enrique Alfaro Ramirez%' OR
  PieFoto like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
                "Enrique Alfaro Ramirez",
                "Enrique Alfaro",
                "Alfaro Ramirez",
        );


$mensaje .= recuperaDatosWEB($qryAlfaro, $titulo = "Enrique Alfaro Ramirez", $buscar );




//QUERY Alfonso Petersen
$qryPetersen = "SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%Alfonso Petersen Farah%' OR
  Texto like '%Alfonso Petersen%' OR

  Titulo like '%Alfonso Petersen Farah%' OR
  Titulo like '%Alfonso Petersen%' OR

  Encabezado like '%Alfonso Petersen Farah%' OR
  Encabezado like '%Alfonso Petersen%' OR

  PieFoto like '%Alfonso Petersen Farah%' OR
  PieFoto like '%Alfonso Petersen%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
        "Alfonso Petersen Farah",
        "Alfonso Petersen"
);


$mensaje .= recuperaDatosWEB($qryPetersen, $titulo = "Alfonso Petersen Farah", $buscar );



//QUERY Guadalajara
$qryGDL = "SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%Guadalajara%' OR
  Texto like '% GDL %' OR

  Titulo like '%Guadalajara%' OR
  Titulo like '% GDL %' OR

  Encabezado like '%Guadalajara%' OR
  Encabezado like '% GDL %' OR

  PieFoto like '%Guadalajara%' OR
  PieFoto like '% GDL %'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
        "Guadalajara",
        " GDL "
);

$mensaje .= recuperaDatosWEB($qryGDL, $titulo = "Guadalajara", $buscar );


//QUERY Zapopan
$qryZapopan = "SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%zapopan%' OR

  Titulo like '%zapopan%' OR

  Encabezado like '%zapopan%' OR

  PieFoto like '%zapopan%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array("zapopan");

$mensaje .= recuperaDatosWEB($qryZapopan, $titulo = "Zapopan", $buscar );


//QUERY Tlajomulco
$qryTlajomulco = "SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%tlajomulco%' OR

  Titulo like '%tlajomulco%' OR

  Encabezado like '%tlajomulco%' OR

  PieFoto like '%tlajomulco%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
        "tlajomulco"
);


$mensaje .= recuperaDatosWEB($qryTlajomulco, $titulo = "Tlajomulco", $buscar );


//QUERY PRI Jalisco
$qryPRIJalisco = "SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%PRI Jalisco%' OR
  Texto like '%Hugo Contreras%' OR

  Titulo like '%PRI Jalisco%' OR
  Titulo like '%Hugo Contreras%' OR

  Encabezado like '%PRI Jalisco%' OR
  Encabezado like '%Hugo Contreras%' OR

  PieFoto like '%PRI Jalisco%' OR
  PieFoto like '%Hugo Contreras%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
    "PRI Jalisco",
    "Hugo Contreras"
    );

$mensaje .= recuperaDatosWEB($qryPRIJalisco, $titulo = "PRI Jalisco", $buscar );


// Query PAN Jalisco
$qryPANJalisco = "SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '% PAN Jalisco%' OR
  Texto like '%Gustavo Macias Zambrano%' OR

  Titulo like '% PAN Jalisco%' OR
  Titulo like '%Gustavo Macias Zambrano%' OR

  Encabezado like '% PAN Jalisco%' OR
  Encabezado like '%Gustavo Macias Zambrano%' OR

  PieFoto like '% PAN Jalisco%' OR
  PieFoto like '%Gustavo Macias Zambrano%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
        "PAN Jalisco",
        "Gustavo Macias Zambrano"
    );
$mensaje .= recuperaDatosWEB($qryPANJalisco, $titulo = "PAN Jalisco", $buscar );


//QUERY PRD Jalisco
$qryPRDJalisco = "SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%PRD Jalisco%' OR
  Texto like '%Raul Vargas Lopez%' OR

  Titulo like '%PRD Jalisco%' OR
  Titulo like '%Raul Vargas Lopez%' OR

  Encabezado like '%PRD Jalisco%' OR
  Encabezado like '%Raul Vargas Lopez%' OR

  PieFoto like '%PRD Jalisco%' OR
  PieFoto like '%Raul Vargas Lopez%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
        "PRD Jalisco",
        "Raul Vargas Lopez"
    );
$mensaje .= recuperaDatosWEB($qryPRDJalisco, $titulo = "PRD Jalisco", $buscar );



//QUERY MC Jalisco
$qryMCJalisco = "SELECT
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
  n.PieFoto,
n.Cutted
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
n.Activo = 1 AND
n.Categoria=80 AND
  fecha = CURDATE() AND (
  Texto like '%Movimiento Ciudadano%' OR
  Texto like '%MC Jalisco%' OR
  Texto like '% MC %' OR
  Texto like '%Hugo Luna Vazquez%' OR
  Texto like '%Hugo Luna%' OR

  Titulo like '%Movimiento Ciudadano%' OR
  Titulo like '%MC Jalisco%' OR
  Titulo like '% MC %' OR
  Titulo like '%Hugo Luna Vazquez%' OR
  Titulo like '%Hugo Luna%' OR

  Encabezado like '%Movimiento Ciudadano%' OR
  Encabezado like '%MC Jalisco%' OR
  Encabezado like '% MC %' OR
  Encabezado like '%Hugo Luna Vazquez%' OR
  Encabezado like '%Hugo Luna%' OR

  PieFoto like '%Movimiento Ciudadano %' OR
  PieFoto like '%MC Jalisco%' OR
  PieFoto like '% MC %' OR
  PieFoto like '%Hugo Luna Vazquez%' OR
  PieFoto like '%Hugo Luna%'
)
ORDER BY p.Estado,p.Nombre";
$buscar = array(
        "Movimiento Ciudadano",
        "MC Jalisco",
        " MC ",
        "Hugo Luna Vazquez",
        "Hugo Luna"
    );
$mensaje .= recuperaDatosWEB($qryMCJalisco, $titulo = "MC Jalisco", $buscar );

//$mensaje=  utf8_decode($mensaje);
*/
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

    //$mail->AddBCC('d3v1an.tux@gmail.com');

    $mail->AddBCC('laura_murillo@hotmail.com');
    $mail->AddBCC('lauramurillozuniga@gmail.com');
    $mail->AddBCC('oscar.monitoreojalisco@gmail.com');
    $mail->AddBCC('huesomonitoreo2012@gmail.com');
    $mail->AddBCC('roberto@publicumestrategias.com');
    $mail->AddBCC('ivans@euristicacom.com');

    //nuevo
    $mail->AddBCC('corozita@hushmail.com');

    //Clientes Solicitados por Laura
    $mail->AddBCC('ivans@euristicacom.com');
    $mail->AddBCC('ricardomancilla@hotmail.com');
    $mail->AddBCC('roberto@publicumestrategias.com');
    $mail->AddBCC('adryanasantillan@gmail.com');
    $mail->AddBCC('alfredo@heuristicacom.com');
    $mail->AddBCC('alonsotorresvazquez@gmail.com');
    $mail->AddBCC('cesar.alvarezgdl@gmail.com');
    $mail->AddBCC('cinthya.navarrop@gmail.com');
    $mail->AddBCC('cuauhtemoc.cisneros.madrid@gmail.com,');
    $mail->AddBCC('cesar_ruv@hotmail.com');
    $mail->AddBCC('david.silva.nd@gmail.com');
    $mail->AddBCC('murillo.laura7@gmail.com');
    $mail->AddBCC('ericsepulveda25@gmail.com');
    $mail->AddBCC('fabiolalivier@gmail.com');
    $mail->AddBCC('gaxel_axgel@hotmail.com');
    $mail->AddBCC('gonzalo.gdl@gmail.com');
    $mail->AddBCC('navarro.israel@gmail.com');
    $mail->AddBCC('yanomejalisco@gmail.com');
    $mail->AddBCC('jordi.grasa@gmail.com,');
    $mail->AddBCC('jl.duran20@gmail.com');
    $mail->AddBCC('juancarlos.magallanes@gmail.com');
    $mail->AddBCC('juanjoramos7@gmail.com');
    $mail->AddBCC('lauramurillozuniga@gmail.com');
    $mail->AddBCC('huesomonitoreo2012@gmail.com');
    $mail->AddBCC('marthisthis@gmail.com');
    $mail->AddBCC('miguelcastroreynoso@hotmail.com');
    $mail->AddBCC('oscar.monitoreojalisco@gmail.com');
    $mail->AddBCC('prensaprijalisco@gmail.com');
    $mail->AddBCC('ricardovillanuevalomeli@gmail.com');
    $mail->AddBCC('RVLMONITOREO@gmail.com');
    $mail->AddBCC('scarrillogarcia@hotmail.com');

    $mail->AddBCC('angeles.arredondo2012@hotmail.com');
    $mail->AddBCC('karlagardunom@gmail.com');
    $mail->AddBCC('ratome.1120@gmail.com');
    $mail->AddBCC('grislomeligil@gmail.com');

    //CLIENTE

    $mail->AddBCC("jlga@gacomunicacion.com");
    $mail->AddBCC("gmocarmona@gacomunicacion.com");
    $mail->AddBCC("fcocolina@gacomunicacion.com");
    $mail->AddBCC("oortiz@gacomunicacion.com");
    $mail->AddBCC("alezama@gacomunicacion.com");

    $mail->AddBCC('rubend@gacomunicacion.com');
    $mail->AddBCC('edgarh@gacomunicacion.com');
    $mail->AddBCC('mariob@gacomunicacion.com');
    $mail->AddBCC('jesush@gacomunicacion.com');
    $mail->AddBCC('carloshreyes@gmail.com');

    $mail->AddBCC('ehb1703@icloud.com');

    $mail->AddBCC('ehb1703@me.com');


    $mail->From = 'gaimpresos@gacomunicacion.com';
    $mail->FromName = "MONITOREO RVL Segmentos de Notas ".date("Y-m-d");

    $mail->Subject  = "MONITOREO RVL ".fecha_completa(date("Y-m-d"));
    $mail->WordWrap = 50;

    // Correo destino

    $mail->IsHTML(TRUE);

    //$mail->Body = utf8_decode(utf8_encode($mensaje));
    $mail->Body = $mensaje;
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
