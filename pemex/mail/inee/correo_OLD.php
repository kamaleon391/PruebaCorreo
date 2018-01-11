ico = ( !empty($buscar) )? highlight( $periodico, $buscar) : $periodico;

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
                      <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($encabezado))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                        <strong>'.utf8_decode($periodico).":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                    </td>
                    </tr>
                <tr>&nbsp;</tr>
                <tr>
                  <td colspan="3">
                     '.recorte($row['idEditorial']).'<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>
                 <tr style="height: 10px;">
                <td colspan="3"></td>
                  </tr>'; 
        }        
    }
    return $mensaje;
}

function recuperaDatosLINKS($sqlBase,$sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
     //$urlP = "http://192.168.3.154";
    
    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        
        $result =  mysql_query($sql);
        while ( $row = mysql_fetch_array($result) ) 
        {


           $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
          $texto = correctorOrtografico(($texto));
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
                  <td colspan="3">
                    <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>'; 
        }        

    }
    else{
  //      $mensaje.='
  //               <tr>
  //                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
  //                <th width=""></th>
  //                <th width="">&nbsp;</th>
  //              </tr>';
    } 
    return $mensaje;
}



function recorte($id)
{
    if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg"))
    {
        return '<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="http://187.247.253.5/external/services/mail/testigoCut.php?c=inee&f='.DATE('Y-m-d').'&id='.$id.'" target="_blank">Recorte </a></span> &nbsp; ';
    }else{
        
    }    
}

function highlight($cadena, $arr_palabras) {
  if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
    return false;
  }
  $str_palabras = implode ('|', $arr_palabras);
  //return preg_replace ('/'.$str_palabras.'/si', '<strong style="background-color:yellow">$1</strong>', $cadena);
  return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
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


?>            
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

        $encabezado =$row['LINK'];
        $mensaje .='
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                  <strong>'.$periodico.":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                </td>
              </tr>
              <tr>&nbsp;</tr>
              <tr>
                <td colspan="3">
                  <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$encabezado.'" target="_blank">Ir a la Nota</a></span>
                </td>
              </tr>'; 
        
        
      }        
      
  }
  else{
  } 
  return $mensaje;
}

function recuperaDatos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";

    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        $mensaje.='
                  <tr>
                    <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.utf8_decode($titulo).'</th>
                 </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {
            $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
            $texto = correctorOrtografico(($texto));
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
                      <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($encabezado))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                        <strong>'.utf8_decode($periodico).":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                    </td>
                    </tr>
                <tr>&nbsp;</tr>
                <tr>
                  <td colspan="3">
                     '.recorte($row['idEditorial']).'<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>
                 <tr style="height: 10px;">
                <td colspan="3"></td>
                  </tr>'; 
        }        
    }
    return $mensaje;
}

function recuperaDatosLINKS($sqlBase,$sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
     //$urlP = "http://192.168.3.154";
    
    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        
        $result =  mysql_query($sql);
        while ( $row = mysql_fetch_array($result) ) 
        {


           $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
          $texto = correctorOrtografico(($texto));
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
                  <td colspan="3">
                    <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>'; 
        }        

    }
    else{
  //      $mensaje.='
  //               <tr>
  //                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
  //                <th width=""></th>
  //                <th width="">&nbsp;</th>
  //              </tr>';
    } 
    return $mensaje;
}



function recorte($id)
{
    if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg"))
    {
        return '<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="http://187.247.253.5/external/services/mail/testigoCut.php?c=inee&f='.DATE('Y-m-d').'&id='.$id.'" target="_blank">Recorte </a></span> &nbsp; ';
    }else{
        
    }    
}

function highlight($cadena, $arr_palabras) {
  if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
    return false;
  }
  $str_palabras = implode ('|', $arr_palabras);
  //return preg_replace ('/'.$str_palabras.'/si', '<strong style="background-color:yellow">$1</strong>', $cadena);
  return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
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


?>            
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

        $encabezado =$row['LINK'];
        $mensaje .='
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                  <strong>'.$periodico.":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                </td>
              </tr>
              <tr>&nbsp;</tr>
              <tr>
                <td colspan="3">
                  <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$encabezado.'" target="_blank">Ir a la Nota</a></span>
                </td>
              </tr>'; 
        
        
      }        
      
  }
  else{
  } 
  return $mensaje;
}

function recuperaDatos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";

    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        $mensaje.='
                  <tr>
                    <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.utf8_decode($titulo).'</th>
                 </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {
            $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
            $texto = correctorOrtografico(($texto));
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
                      <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($encabezado))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                        <strong>'.utf8_decode($periodico).":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                    </td>
                    </tr>
                <tr>&nbsp;</tr>
                <tr>
                  <td colspan="3">
                     '.recorte($row['idEditorial']).'<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>
                 <tr style="height: 10px;">
                <td colspan="3"></td>
                  </tr>'; 
        }        
    }
    return $mensaje;
}

function recuperaDatosLINKS($sqlBase,$sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
     //$urlP = "http://192.168.3.154";
    
    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        
        $result =  mysql_query($sql);
        while ( $row = mysql_fetch_array($result) ) 
        {


           $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
          $texto = correctorOrtografico(($texto));
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
                  <td colspan="3">
                    <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>'; 
        }        

    }
    else{
  //      $mensaje.='
  //               <tr>
  //                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
  //                <th width=""></th>
  //                <th width="">&nbsp;</th>
  //              </tr>';
    } 
    return $mensaje;
}



function recorte($id)
{
    if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg"))
    {
        return '<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="http://187.247.253.5/external/services/mail/testigoCut.php?c=inee&f='.DATE('Y-m-d').'&id='.$id.'" target="_blank">Recorte </a></span> &nbsp; ';
    }else{
        
    }    
}

function highlight($cadena, $arr_palabras) {
  if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
    return false;
  }
  $str_palabras = implode ('|', $arr_palabras);
  //return preg_replace ('/'.$str_palabras.'/si', '<strong style="background-color:yellow">$1</strong>', $cadena);
  return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
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


?>            
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

        $encabezado =$row['LINK'];
        $mensaje .='
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                  <strong>'.$periodico.":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                </td>
              </tr>
              <tr>&nbsp;</tr>
              <tr>
                <td colspan="3">
                  <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$encabezado.'" target="_blank">Ir a la Nota</a></span>
                </td>
              </tr>'; 
        
        
      }        
      
  }
  else{
  } 
  return $mensaje;
}

function recuperaDatos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";

    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        $mensaje.='
                  <tr>
                    <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.utf8_decode($titulo).'</th>
                 </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {
            $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
            $texto = correctorOrtografico(($texto));
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
                      <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($encabezado))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                        <strong>'.utf8_decode($periodico).":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                    </td>
                    </tr>
                <tr>&nbsp;</tr>
                <tr>
                  <td colspan="3">
                     '.recorte($row['idEditorial']).'<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>
                 <tr style="height: 10px;">
                <td colspan="3"></td>
                  </tr>'; 
        }        
    }
    return $mensaje;
}

function recuperaDatosLINKS($sqlBase,$sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
     //$urlP = "http://192.168.3.154";
    
    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        
        $result =  mysql_query($sql);
        while ( $row = mysql_fetch_array($result) ) 
        {


           $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
          $texto = correctorOrtografico(($texto));
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
                  <td colspan="3">
                    <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>'; 
        }        

    }
    else{
  //      $mensaje.='
  //               <tr>
  //                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
  //                <th width=""></th>
  //                <th width="">&nbsp;</th>
  //              </tr>';
    } 
    return $mensaje;
}



function recorte($id)
{
    if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg"))
    {
        return '<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="http://187.247.253.5/external/services/mail/testigoCut.php?c=inee&f='.DATE('Y-m-d').'&id='.$id.'" target="_blank">Recorte </a></span> &nbsp; ';
    }else{
        
    }    
}

function highlight($cadena, $arr_palabras) {
  if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
    return false;
  }
  $str_palabras = implode ('|', $arr_palabras);
  //return preg_replace ('/'.$str_palabras.'/si', '<strong style="background-color:yellow">$1</strong>', $cadena);
  return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
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


?>            
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

        $encabezado =$row['LINK'];
        $mensaje .='
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                  <strong>'.$periodico.":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                </td>
              </tr>
              <tr>&nbsp;</tr>
              <tr>
                <td colspan="3">
                  <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$encabezado.'" target="_blank">Ir a la Nota</a></span>
                </td>
              </tr>'; 
        
        
      }        
      
  }
  else{
  } 
  return $mensaje;
}

function recuperaDatos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";

    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        $mensaje.='
                  <tr>
                    <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.utf8_decode($titulo).'</th>
                 </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {
            $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
            $texto = correctorOrtografico(($texto));
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
                      <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($encabezado))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                        <strong>'.utf8_decode($periodico).":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                    </td>
                    </tr>
                <tr>&nbsp;</tr>
                <tr>
                  <td colspan="3">
                     '.recorte($row['idEditorial']).'<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>
                 <tr style="height: 10px;">
                <td colspan="3"></td>
                  </tr>'; 
        }        
    }
    return $mensaje;
}

function recuperaDatosLINKS($sqlBase,$sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
     //$urlP = "http://192.168.3.154";
    
    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        
        $result =  mysql_query($sql);
        while ( $row = mysql_fetch_array($result) ) 
        {


           $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
          $texto = correctorOrtografico(($texto));
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
                  <td colspan="3">
                    <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>'; 
        }        

    }
    else{
  //      $mensaje.='
  //               <tr>
  //                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
  //                <th width=""></th>
  //                <th width="">&nbsp;</th>
  //              </tr>';
    } 
    return $mensaje;
}



function recorte($id)
{
    if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg"))
    {
        return '<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="http://187.247.253.5/external/services/mail/testigoCut.php?c=inee&f='.DATE('Y-m-d').'&id='.$id.'" target="_blank">Recorte </a></span> &nbsp; ';
    }else{
        
    }    
}

function highlight($cadena, $arr_palabras) {
  if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
    return false;
  }
  $str_palabras = implode ('|', $arr_palabras);
  //return preg_replace ('/'.$str_palabras.'/si', '<strong style="background-color:yellow">$1</strong>', $cadena);
  return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
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


?>            
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

        $encabezado =$row['LINK'];
        $mensaje .='
              <tr>
                <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                  <strong>'.$periodico.":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                </td>
              </tr>
              <tr>&nbsp;</tr>
              <tr>
                <td colspan="3">
                  <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$encabezado.'" target="_blank">Ir a la Nota</a></span>
                </td>
              </tr>'; 
        
        
      }        
      
  }
  else{
  } 
  return $mensaje;
}

function recuperaDatos($sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
    //$urlP = "http://192.168.3.154";

    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        $mensaje.='
                  <tr>
                    <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.utf8_decode($titulo).'</th>
                 </tr>';
        while ( $row = mysql_fetch_array($result) ) 
        {
            $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
            $texto = correctorOrtografico(($texto));
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
                      <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($titulo))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 16px;">'. utf8_decode(wordlimit(strtoupper(sanear_string2(strtolower($encabezado))))).'</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 16px;">
                        <strong>'.utf8_decode($periodico).":</strong>&nbsp;".  utf8_decode(wordlimit($texto)).'
                    </td>
                    </tr>
                <tr>&nbsp;</tr>
                <tr>
                  <td colspan="3">
                     '.recorte($row['idEditorial']).'<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>
                 <tr style="height: 10px;">
                <td colspan="3"></td>
                  </tr>'; 
        }        
    }
    return $mensaje;
}

function recuperaDatosLINKS($sqlBase,$sql, $titulo, $buscar = array())
{
    $urlP = "http://187.247.253.5";
     //$urlP = "http://192.168.3.154";
    
    $result =  mysql_query($sql);
    if(mysql_affected_rows() > 0)
    {
        
        $result =  mysql_query($sql);
        while ( $row = mysql_fetch_array($result) ) 
        {


           $texto=  textMatchV2($row['Texto'], $buscar);
            //$texto=$row['Texto'];
          $texto = correctorOrtografico(($texto));
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
                  <td colspan="3">
                    <span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['pdf'].'" target="_blank">Ir al PDF</a></span> &nbsp;  &nbsp; &nbsp;<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="'.$urlP.$row['jpg'].'.jpg" target="_blank">Ir a la Imagen</a></span> &nbsp;  &nbsp; &nbsp; Link: <span style="font-size:16px;color: blue;text-decoration: underline;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href='.$urlP.$row['pdf'].' target="_blank">'.$urlP.$row['pdf'].'</a></span>
                  </td>
                </tr>'; 
        }        

    }
    else{
  //      $mensaje.='
  //               <tr>
  //                <th width="" style="font-family: Arial Narrow;font-size: 14px;">No Se Encontraron Resultados</th>
  //                <th width=""></th>
  //                <th width="">&nbsp;</th>
  //              </tr>';
    } 
    return $mensaje;
}



function recorte($id)
{
    if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg"))
    {
        return '<span style="font-size:16px;"><a style="font-family: Arial Narrow;font-weight: bold;color: rgb(0, 110, 207);" href="http://187.247.253.5/external/services/mail/testigoCut.php?c=inee&f='.DATE('Y-m-d').'&id='.$id.'" target="_blank">Recorte </a></span> &nbsp; ';
    }else{
        
    }    
}

function highlight($cadena, $arr_palabras) {
  if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
    return false;
  }
  $str_palabras = implode ('|', $arr_palabras);
  //return preg_replace ('/'.$str_palabras.'/si', '<strong style="background-color:yellow">$1</strong>', $cadena);
  return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
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
            $mes3='Dic