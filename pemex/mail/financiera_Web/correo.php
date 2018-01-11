
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


function recuperaDatos2($sql, $titulo, $buscar = array())
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
                  <th colspan="3" style="text-align:center; background:#6B9334; color:#FFF; height: 30px; font-size: 14px;">'.$titulo.'</th>
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
       
        //$texto = ( !empty($buscar) )? highlight( utf8_encode($row['Texto']) , $buscar) : utf8_encode($row['Texto']); 
        $texto = ( !empty($buscar) )? highlight( $row['Texto'] , $buscar) : $row['Texto']; 
        $periodico = ( !empty($buscar) )? highlight( $row['Periodico'] , $buscar) : $row['Periodico'];
        $titulo =  ( !empty($buscar) )? highlight( $row['Titulo'] , $buscar) : $row['Titulo'];
        $encabezado =  ( !empty($buscar) )? highlight( $row['Encabezado'] , $buscar) : $row['Encabezado'];

        $mensaje .='
              <tr>
                <th align="left">Periodico: '.$periodico.'</th>
                <th align="left">'.$row['estado'].'</th>
                <th align="left">'.fecha_completa( $row['Fecha'] ).'</th>
              </tr>
              <tr>
                <th align="left">Categoia: '.$row['Categoria'].'</th>
                <th align="left">Secci&oacute;n '.$row['seccion'].'</th>
                <th align="left">Autor: '.$row['Autor'].'</th>
              </tr>
              <tr>
                <th colspan="2" style="text-align:left; font-weight:bold;">TITULO: '.$titulo.'</th>
                <th align="left"><a href='.$encabezado.'>Ir a la noticia:</a></th>
              </tr>
              <tr>
                <td colspan="3" style="text-align:justify; background: #e6e7ed;">
                  '.$texto.'
                </td>
              </tr>
               <tr>
              <tr>
                <th width="40%">&nbsp;</th>
                <th  width="20%"></th>
                <th width="40%">&nbsp;</th>
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

        //$encabezado = correctorOrtografico( $row['Encabezado'] );
        $encabezado = $row['Encabezado'];
        //$encabezado =  ( !empty($buscar) )? highlight( $encabezado , $buscar) : $encabezado;

        $mensaje .='
              <tr>
                <td colspan="3" align="left" style="font-weight:bold;FONT-SIZE: 14px;"><strong>Periodico: </strong>'.$periodico.' &nbsp;  &nbsp; &nbsp;<!--<strong>Estado :</strong> '.$row['estado'].'--> &nbsp;  &nbsp; &nbsp;<strong>Fecha: </strong>'.fecha_completa( $row['Fecha'] ).'</td>
              </tr>
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">TITULO: '.sanear_string2($titulo).' &nbsp;  &nbsp; &nbsp;ENCABEZADO: '.$encabezado.'</td>
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


$mensaje ='
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
  </head>
 
  <body>
<table width="70%" align="center" cellspacing="0" border="0" style="font-size: 12px;border: solid 1px gray;">
 <tr>
    <td colspan="3" align="center"><img src="'.$urlP .'/external/services/mail/financiera_Web/img/logo_fdn.png"></td>
 </tr>';

$sqlPlanas = "SELECT
        DISTINCT(n.idEditorial) AS 'idEditorial',
        n.Periodico as idPeriodico,
        n.Titulo,
        p.Nombre as Periodico,
        e.Nombre AS estado,
        n.Fecha,
        n.PaginaPeriodico,
        s.seccion,
        c.Categoria as Categoria,
        n.Autor,
        n.Texto,
        n.Categoria as 'Num.Categoria',
        n.NumeroPagina,
        n.Hora,
        n.Encabezado,
        n.Foto,
        n.PieFoto
      FROM 
      noticiasDia n, 
      periodicos p, 
      seccionesPeriodicos s,
      categoriasPeriodicos c,
      estados e
      WHERE 
      e.idEstado=p.Estado AND
      p.idPeriodico=n.Periodico AND
      s.idSeccion=n.Seccion AND
      c.idCategoria=n.Categoria AND
      n.Categoria=80 AND
      n.Seccion=1 AND
      n.Activo = 1 AND
      fecha =CURDATE()
      GROUP BY n.NumeroPagina,p.idPeriodico";

$mensaje .= recuperaDatosWEB($sqlPlanas, $titulo = "PRIMERAS PLANAS", $buscar = array() );

/*DIRECCION*/
$qryDireccion = "SELECT
DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
          Texto like '%juan carlos cortes garcia%' OR 
          Texto like '%juan cortes garcia%' OR 
          Texto like '%juan carlos cortes%' OR 
          
          Titulo like '%juan carlos cortes garcia%' OR 
          Titulo like '%juan cortes garcia%' OR 
          Titulo like '%juan carlos cortes%' OR 
          
          Encabezado like '%juan carlos cortes garcia%' OR 
          Encabezado like '%juan cortes garcia%' OR 
          Encabezado like '%juan carlos cortes%' OR
          
          PieFoto like '%juan carlos cortes garcia%' OR 
          PieFoto like '%juan cortes garcia%' OR 
          PieFoto like '%juan carlos cortes%'
          
        ) 
ORDER BY e.idEstado,p.Nombre";

$buscar = array(
    "Juan Carlos Cortés García",
    "Juan Carlos Cortés",
    "Financiera Nacional de Desarrollo"
);

$mensaje .= recuperaDatosWEB($qryDireccion, $titulo = "Dirección General - Juan Carlos Cortés García", $buscar );


/*FINANCIERA*/
$qryFinanciera = "SELECT
DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND (
          Texto like '%Financiamiento Rural%' OR 
          Texto like '%Financiera naciónal de Desarrollo Agropecuario%' OR
          Texto like '%Financiera nacional de Desarrollo%' OR
          Texto like '%Financiera nacional%' OR
          Texto like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
          Texto like '%financiera rural%' OR
          Texto like '%finrural%' OR

          Titulo like '%Financiamiento Rural%' OR 
          Titulo like '%Financiera naciónal de Desarrollo Agropecuario%' OR
          Titulo like '%Financiera nacional de Desarrollo%' OR
          Titulo like '%Financiera nacional%' OR
          Titulo like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
          Titulo like '%financiera rural%' OR
          Titulo like '%finrural%' OR

          Encabezado like '%Financiamiento Rural%' OR 
          Encabezado like '%Financiera naciónal de Desarrollo Agropecuario%' OR
          Encabezado like '%Financiera nacional de Desarrollo%' OR
          Encabezado like '%Financiera nacional%' OR
          Encabezado like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
          Encabezado like '%financiera rural%' OR
          Encabezado like '%finrural%' OR
          
          PieFoto like '%Financiamiento Rural%' OR 
          PieFoto like '%Financiera naciónal de Desarrollo Agropecuario%' OR
          PieFoto like '%Financiera nacional de Desarrollo%' OR
          PieFoto like '%Financiera nacional%' OR
          PieFoto like '%Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero%' OR 
          PieFoto like '%financiera rural%' OR
          PieFoto like '%finrural%' 
        )
ORDER BY e.idEstado,p.Nombre";
$buscar = array("finrural",
                "Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero",
                "financiera rural",
                "Financiera naciónal de Desarrollo Agropecuario",
                "Financiera nacional de Desarrollo",
                "Financiera nacional");

$mensaje .= recuperaDatosWEB($qryFinanciera, $titulo = "Financiera Nacional de Desarrollo Agropecuario, Rural, Forestal y Pesquero", $buscar );

/***************************/
//QUERY PARA LA SECRETARIA DE HACIENDA Y CREDITO PUBLICO
//SHCP
$qrySHCP = "SELECT
DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
  n.Activo = 1 AND
  fecha = CURDATE() AND(
          Texto like '%shcp%' OR
          Texto like '%Luis Videgaray Caso%' OR
          Texto like '%Luis Videgaray%' OR
          Texto like '%secretario de hacienda%' OR
          Texto like '%servicio de administracion tributaria%' OR
          Texto like '% SAT %' OR
          Texto like '%secretaria de hacienda y credito publico%' OR
          Texto like '%hacienda y credito publico%' OR
          Texto like '%secretaria de hacienda%' OR
          
          Titulo like '%shcp%' OR
          Titulo like '%Luis Videgaray Caso%' OR
          Titulo like '%secretario de hacienda%' OR
          Titulo like '%servicio de administracion tributaria%' OR
          Titulo like '% SAT %' OR
          Titulo like '%Luis Videgaray%' OR
          Titulo like '%secretaria de hacienda y credito publico%' OR
          Titulo like '%hacienda y credito publico%' OR
          Titulo like '%secretaria de hacienda%' OR
          
          Encabezado like '%shcp%' OR
          Encabezado like '%Luis Videgaray Caso%' OR
          Encabezado like '%Luis Videgaray%' OR          
          Encabezado like '%servicio de administracion tributaria%' OR
          Encabezado like '% SAT %' OR
          Encabezado like '%secretario de hacienda%' OR
          Encabezado like '%secretaria de hacienda y credito publico%' OR
          Encabezado like '%hacienda y credito publico%' OR
          Encabezado like '%secretaria de hacienda%' OR
          
          PieFoto like '%shcp%' OR
          PieFoto like '%Luis Videgaray Caso%' OR
          PieFoto like '%Luis Videgaray%' OR          
          PieFoto like '%servicio de administracion tributaria%' OR
          PieFoto like '% SAT %' OR
          PieFoto like '%secretario de hacienda%' OR
          PieFoto like '%secretaria de hacienda y credito publico%' OR
          PieFoto like '%hacienda y credito publico%' OR
          PieFoto like '%secretaria de hacienda%' 
          
          ) AND Texto not like '%ex secretario de Hacienda%'
ORDER BY e.idEstado,p.Nombre";
$buscar = array("SHCP.","subsecretario de Hacienda","Servicio de Administración Tributaria","Secretaría de Hacienda y Crédito Público","Secretaría de Hacienda","SHCP","shcp","Luis Videgaray Caso","Luis Videgaray","servicio de administracion tributaria","SAT",
              "secretario de hacienda","secretaria de hacienda y credito publico","hacienda y credito publico","secretaria de hacienda","Secretaría de Haciendaa","Comisión de Hacienda y Crédito Público","Hacienda y Crédito Público",
              "Fernando Aportela","subsecretario de hacienda","Miguel Messmacher","subsecretario de ingresos");


$mensaje .= recuperaDatosWEB($qrySHCP, $titulo = "Secretar&iacute;a de Hacienda y Cr&eacute;dito P&uacute;blico", $buscar );


//QUERY PARA LA SAGARPA
$qrySAGARPA = "SELECT
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
  n.Periodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  p.Estado=e.idEstado AND
  n.Categoria<>80 AND 
  n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
          Texto like '%sagarpa%' OR 
          Texto like '%secretaria de agricultura, ganaderia, desarrollo rural, pesca y alimentacion%' OR 
          Texto like '%secretaria de agricultura ganaderia desarrollo rural pesca y alimentacion%' OR 
          Texto like '%secretaria de agricultura %' OR 
          Texto like '%enrique martinez y martinez%' OR 
          
          Titulo like '%sagarpa%' OR 
          Titulo like '%secretaria de agricultura, ganaderia, desarrollo rural, pesca y alimentacion%' OR 
          Titulo like '%secretaria de agricultura ganaderia desarrollo rural pesca y alimentacion%' OR 
          Titulo like '%secretaria de agricultura %' OR 
          Titulo like '%enrique martinez y martinez%' OR 
       
          Encabezado like '%sagarpa%' OR 
          Encabezado like '%secretaria de agricultura, ganaderia, desarrollo rural, pesca y alimentacion%' OR 
          Encabezado like '%secretaria de agricultura ganaderia desarrollo rural pesca y alimentacion%' OR 
          Encabezado like '%secretaria de agricultura %' OR
          Encabezado like '%enrique martinez y martinez%' OR
          
          PieFoto like '%sagarpa%' OR 
          PieFoto like '%secretaria de agricultura, ganaderia, desarrollo rural, pesca y alimentacion%' OR 
          PieFoto like '%secretaria de agricultura ganaderia desarrollo rural pesca y alimentacion%' OR 
          PieFoto like '%secretaria de agricultura %' OR
          PieFoto like '%enrique martinez y martinez%'

          )
ORDER BY o.posicion";
$buscar = array(
    "sagarpa",
    "SAGARPA",
    "secretaria de agricultura, ganaderia, desarrollo rural, pesca y alimentacion",
    "Secretaria de Agricultura, Ganaderia, Desarrollo Rural, Pesca y Alimentacion",
    "Secretaria de Agricultura Ganaderia Desarrollo Rural Pesca y Alimentacion",
    "secretaria de agricultura",
    "Enrique Martinez y Martinez"
);

$mensaje .= recuperaDatosWEB($qrySAGARPA, $titulo = " Secretaría de Agricultura, Ganadería, Desarrollo Rural, Pesca y Alimentación", $buscar );



//QUERY PARA Secretaria de Desarrollo Agrario Territorial y Urbano
//SDATU
$qrySDATU = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
n.Activo = 1 AND
  fecha = CURDATE() AND(
         Texto like '%Secretaria de la reforma agraria%' OR 
          Texto like '% SRA %' OR 
          Texto like '%SEDATU%' OR 

          Titulo like '%Secretaria de la reforma agraria%' OR 
          Titulo like '% SRA %' OR 
          Titulo like '%SEDATU%' OR 

          Encabezado like '%Secretaria de la reforma agraria%' OR 
          Encabezado like '% SRA %' OR
          Encabezado like '%SEDATU%' OR
          
          PieFoto like '%Secretaria de la reforma agraria%' OR 
          PieFoto like '% SRA %' OR
          PieFoto like '%SEDATU%'
          
          
          )
ORDER BY e.idEstado,p.Nombre";
$buscar = array("SRA","SEDATU","Secretaria de la reforma agraria");

$mensaje .= recuperaDatosWEB($qrySDATU, $titulo = "Secretaria de Desarrollo Agrario Territorial y Urbano", $buscar );




//QUERY PARA Comisión Nacional Bancaria y de Valores
$qry3 = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  n.Encabezado,
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
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  Texto like '% CNBV %' OR 
  Texto like '%comision nacional bancaria y de valores%' OR 
  Texto like '%comision nacional bancaria%' OR 

  Titulo like '% CNBV %' OR 
  Titulo like '%comision nacional bancaria y de valores%' OR 
  Titulo like '%comision nacional bancaria%' OR 

  Encabezado like '% CNBV %' OR 
  Encabezado like '%comision nacional bancaria y de valores%' OR
  Encabezado like '%comision nacional bancaria%'
          
)
ORDER BY e.idEstado,p.Nombre";
$buscar = array("CNBV","comision nacional bancaria y de valores","comision nacional bancaria","Comisión Nacional Bancaria y de Valores");

$mensaje .= recuperaDatosWEB($qry3, $titulo = "Comisión Nacional Bancaria y de Valores", $buscar );


//QUERY PARA Banco Nacional de Credito Agricola
$qry4 = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  n.Encabezado,
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
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  (Texto like '%Banco Nacional de credito agricola%' OR 
  Texto like '%banco nacional agropecuario%' OR
  Texto like '%banrural%' OR
  Texto like '%financiera rural%' OR
  Texto like '%bancos%' OR
  Texto like '%banco%' OR
  
  Titulo like '%Banco Nacional de credito agricola%' OR 
  Titulo like '%banco nacional agropecuario%' OR
  Titulo like '%banrural%' OR
  Titulo like '%financiera rural%' OR
  Titulo like '%bancos%' OR
  Titulo like '%banco%' OR
  
  Encabezado like '%Banco Nacional de credito agricola%' OR 
  Encabezado like '%banco nacional agropecuario%' OR
  Encabezado like '%banrural%' OR
  Encabezado like '%financiera rural%' OR
  Encabezado like '%bancos%' OR
  Encabezado like '%banco%' )
  AND 
  (
    Texto NOT like '%Desbancó%' AND 
    Titulo NOT like '%Desbancó%' AND
    Encabezado NOT like '%Desbancó%'
  ) 
  AND
  (
    Texto like '%financiera rural%' OR 
    Texto like '%financiera nacional de desarrollo agropecuario, rural, forestal y pesquero%' OR 

    Titulo like '%financiera rural%' OR
    Titulo like '%financiera nacional de desarrollo agropecuario, rural, forestal y pesquero%' OR

    Encabezado like '%financiera rural%' OR
    Encabezado like '%financiera nacional de desarrollo agropecuario, rural, forestal y pesquero%'
  ) 
          
)
ORDER BY e.idEstado,p.Nombre";
$buscar = array("Banco Nacional de credito agricola","banco nacional agropecuario","banrural","financiera rural","banco de financiera rural","banco y financiera rural"
              ,"bancos","banco","Bancomer","Bancomext");


$mensaje .= recuperaDatosWEB($qry4, $titulo = "Banco Nacional de Credito Agricola", $buscar );


//QUERY PARA Seguros Financieros
$qry5 = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  n.Encabezado,
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
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  Texto like '%Seguros financiera rural%' OR 
  Texto like '%seguros y financiera rural%' OR
  Texto like '%seguros con financiera rural%' OR
  Texto like '%seguros%' OR

  Titulo like '%Seguros financiera rural%' OR 
  Titulo like '%seguros y financiera rural%' OR
  Titulo like '%seguros con financiera rural%' OR
  Titulo like '%seguros%' OR

  Encabezado like '%Seguros financiera rural%' OR 
  Encabezado like '%seguros y financiera rural%' OR
  Encabezado like '%seguros con financiera rural%' OR
  Encabezado like '%seguros%' 

  AND
  (
  Texto like '%financiera rural%' OR
  Texto like '%seguro agrícola%' OR
  Texto like '%seguro para el campo%' OR

  Titulo like '%financiera rural%' OR
  Titulo like '%seguro agrícola%' OR
  Titulo like '%seguro para el campo%' OR

  Encabezado like '%financiera rural%' OR
  Encabezado like '%seguro agrícola%' OR
  Encabezado like '%seguro para el campo%'
  ) 
          
)
ORDER BY e.idEstado,p.Nombre";
$buscar = array("Seguros financiera rural","seguros y financiera rural",
  "seguros con financiera rural","seguros","financiera rural");

$mensaje .= recuperaDatosWEB($qry5, $titulo = "Seguros Financieros", $buscar );


// Query para Mercados Internacionales
$qry6 = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  n.Encabezado,
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
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  Texto like '%Mercados Internacionales%' OR 

  Titulo like '%Mercados Internacionales%' OR 

  Encabezado like '%Mercados Internacionales%'
          
)
ORDER BY e.idEstado,p.Nombre";
$buscar = array("Mercados Internacionales");
$mensaje .= recuperaDatosWEB($qry6, $titulo = "Mercados Internacionales", $buscar );


//QUERY para VARIOS
$qryV = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
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
  n.Encabezado,
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
  n.Categoria=80 AND
  p.Estado=e.idEstado AND
n.Activo = 1 AND
  fecha = CURDATE() AND
(

  Texto like '% SASA % ' OR 
  Texto like '%Sector Agricultor%' OR
  Texto like '%Sector Pecuario%' OR
  Texto like '%Sector Pesquero%' OR
  Texto like '%Sector Forestal%' OR
  Texto like '%Medio Ambiente%' OR
  Texto like '%Campesinos%' OR
  Texto like '%Cañeros%' OR
  Texto like '%Ejidatarios%' OR
  Texto like '%Reforma al campo%' OR
  Texto like '%Inapesca%' OR
  Texto like '%Conapesaca%' OR
  Texto like '%UNTA%' OR
  Texto like '%CNC%' OR
  Texto like '%CNOG%' OR
  Texto like '%UGR%' OR
  Texto like '%Ganadería%' OR
  
  Titulo like '% SASA % ' OR 
  Titulo like '%Sector Agricultor%' OR
  Titulo like '%Sector Pecuario%' OR
  Titulo like '%Sector Pesquero%' OR
  Titulo like '%Sector Forestal%' OR
  Titulo like '%Medio Ambiente%' OR
  Titulo like '%Campesinos%' OR
  Titulo like '%Cañeros%' OR
  Titulo like '%Ejidatarios%' OR
  Titulo like '%Reforma al campo%' OR
  Titulo like '%Inapesca%' OR
  Titulo like '%Conapesaca%' OR
  Titulo like '%UNTA%' OR
  Titulo like '%CNC%' OR
  Titulo like '%CNOG%' OR
  Titulo like '%UGR%' OR
  Titulo like '%Ganadería%' OR
  
  Encabezado like '% SASA % ' OR 
  Encabezado like '%Sector Agricultor%' OR
  Encabezado like '%Sector Pecuario%' OR
  Encabezado like '%Sector Pesquero%' OR
  Encabezado like '%Sector Forestal%' OR
  Encabezado like '%Medio Ambiente%' OR
  Encabezado like '%Campesinos%' OR
  Encabezado like '%Cañeros%' OR
  Encabezado like '%Ejidatarios%' OR
  Encabezado like '%Reforma al campo%' OR
  Encabezado like '%Inapesca%' OR
  Encabezado like '%Conapesaca%' OR
  Encabezado like '%UNTA%' OR
  Encabezado like '%CNC%' OR
  Encabezado like '%CNOG%' OR
  Encabezado like '%UGR%' OR
  Encabezado like '%Ganadería%'    
)
ORDER BY e.idEstado,p.Nombre";
$buscar = array("SASA","Sector Agricultor","Sector Pecuario",
  "Sector Pesquero","Sector Forestal","Medio Ambiente");
$mensaje .= recuperaDatosWEB($qryV, $titulo = "VARIOS", $buscar );


//QUERY PARA Columnas Politicas

$qryPol = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
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
n.Periodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
n.Categoria=80 AND
n.Seccion = 1704 AND
n.Activo = 1 AND
fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY e.idEstado,p.Nombre";
$buscar = array();
$mensaje .= recuperaDatosWEB($qryPol, $titulo = "Columnas Politicas", $buscar );


//QUERY PARA Columnas Financieras
$qryF = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
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
n.Categoria=80 AND
n.Seccion = 1733 AND
n.Activo = 1 AND
fecha =CURDATE()
GROUP BY n.idEditorial";
$buscar = array();
$mensaje .= recuperaDatosWEB($qryF, $titulo = "Columnas Financieras", $buscar );

//QUERY PARA Cartones
$qryF = "SELECT
  DISTINCT(n.idEditorial) AS 'idEditorial',
  n.Periodico as idPeriodico,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
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
n.Categoria=80 AND
n.Seccion=670 AND
n.Activo = 1 AND
fecha =CURDATE()
GROUP BY n.idEditorial
ORDER BY e.idEstado,p.Nombre";
$buscar = array();
$mensaje .= recuperaDatosWEB($qryF, $titulo = "Cartones", $buscar );


$mensaje .='

</table>
</body>
</html>';


//enviaReporte($mensaje);
 
//echo $mensaje;

function enviaReporte($mensaje)
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

/*
$mail->Host     = "smtp.gacomunicacion.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "Gagdl1";
*/

// $mail->addAddress('edgarh@gacomunicacion.com', 'Edgar Oswaldo Hernánde Barajas');
// $mail->addAddress('ricardom@gacomunicacion.com', 'Ricardo Madrigal Rodriguez (Sauron)');
// $mail->addAddress('mariob@gacomunicacion.com', 'Mario Alberto Badillo (Hobbit)');

$mail->AddAddress("gcornejop@financierarural.gob.mx"); 
$mail->AddAddress("dgonzalez@financierarural.gob.mx");    

$mail->AddCC("fgonzalez@financierarural.gob.mx");
$mail->AddCC("danacanul@gmail.com");
$mail->AddCC("regalindo@financierarural.gob.mx");
$mail->AddCC("agmargain@financierarural.gob.mx");
$mail->AddCC("jalmonte@financierarural.gob.mx");
$mail->AddCC("fcueto@financierarural.gob.mx");
$mail->AddCC("agomez@financierarural.gob.mx");
$mail->AddCC("ytoledo@financierarural.gob.mx");
$mail->AddCC("mzamora@financierarural.gob.mx");
$mail->AddCC("rslopez@financierarural.gob.mx");
$mail->AddCC("hjdelapena@financierarural.gob.mx");
$mail->AddCC("sramirez@financierarural.gob.mx");
$mail->AddCC("sdelamora@financierarural.gob.mx");
$mail->AddCC("jamunoz@financierarural.gob.mx");
$mail->AddCC("nrodriguez@financierarural.gob.mx");
$mail->AddCC("apina@financierarural.gob.mx");
$mail->AddCC("mdiazd@financierarural.gob.mx");
$mail->AddCC("isoberanes@financierarural.gob.mx");
$mail->AddCC("atellez@financierarural.gob.mx");
$mail->AddCC("jmartinezs@financierarural.gob.mx");
$mail->AddCC("jleon@financierarural.gob.mx");
$mail->AddCC("aballesteros@financierarural.gob.mx");
$mail->AddCC("danacanul@hotmail.com");
$mail->AddCC("dana_canul26@hotmail.com");

$mail->AddBCC("edgarh@gacomunicacion.com");
$mail->AddBCC("ricardom@gacomunicacion.com");
$mail->AddBCC("mariob@gacomunicacion.com");

$mail->AddBCC("jlga@gacomunicacion.com");
$mail->AddBCC("fcocolina@gacomunicacion.com");
$mail->AddBCC("gmocarmona@gacomunicacion.com");
$mail->AddBCC("oortiz@gacomunicacion.com");
$mail->AddBCC("rubend@gacomunicacion.com");
$mail->AddBCC("alezama@gacomunicacion.com");
$mail->AddBCC("validacion_Gacomunicacion@hotmail.com");
$mail->AddBCC("ehb1703@me.com");

$mail->From = 'gaimpresos@gacomunicacion.com';
$mail->FromName = "MONITOREO DE PRENSA ";
 
$mail->Subject  = "FINANCIERA RURAL PORTALES ".date("Y-m-d H:i:s");  
$mail->WordWrap = 50;
 
// Correo destino

$mail->IsHTML(TRUE);
 
$mail->Body = ($mensaje);
 
if(!$mail->Send()) {
    echo "Error: " . $mail->ErrorInfo;
} else {
    echo "Mensaje enviado";
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

function EncuentraCoincidencias($cadenaOriginal,$valorBuscado){
    $posicion=  strpos($cadenaOriginal, $valorBuscado);
    if($posicion!==false){
        if($posicion>0){
             $nuevaCadena=  substr($cadenaOriginal, $posicion-5,$posicion+400);
            return $nuevaCadena."...";      
        }else{
             $nuevaCadena=  substr($cadenaOriginal, $posicion,$posicion+400);
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
      return $cadena;
    }
    else
    {
      return $cadenaOriginal;
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
