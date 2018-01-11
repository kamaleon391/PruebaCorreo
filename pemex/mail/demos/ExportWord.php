<?php
include_once 'Header.php';
require "/var/www/external/services/mail/conexion.php";
    

Resumen("4424125,4424747,4423956,4423098,4423910,4424065,4424147,4427421,4427687,4427693,4420946,4421243,4425119,4425266,4421139,4421344,4421345,4421660,4419685,4419687,4420283,4421685,4421778,4420272,4424276,4421755,4420523,4420536,4420552,4422285",1);

function Resumen($ids,$pestaña)
{
    mysql_query("set names 'utf8'");
    require "/var/www/external/services/mail/conexion.php";
    include_once 'Header.php';

    
    
    \PhpOffice\PhpWord\Settings::setCompatibility(false);

  // Para declarar un nuevo documento
     
    $PHPWord = new \PhpOffice\PhpWord\PhpWord();
    // Para crear seccion para escribir en ella
    $section = $PHPWord->addSection();
    // Formatos para los textos 

    $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'italic'=>false, 'size'=>16, ));
    $PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>50));

    //$PHPWord->addParagraphStyle('pStyle2', array('align'=>'center', 'spaceAfter'=>100,'fgColor'=>PHPWord_Style_Font::FGCOLOR_DARKYELLOW ));
    $PHPWord->addFontStyle('estiloTexto', array('bold'=>false, 'arial'=>true, 'size'=>10,));
    $PHPWord->addFontStyle('estiloHead', array('bold'=>true, 'arial'=>true, 'size'=>10, 'align'=>'left'));
    $PHPWord->addFontStyle('estiloLink', array('bold'=>true, 'italic'=>false, 'size'=>12, 'color'=>'blue'));

    $PHPWord->addFontStyle('estiloLink2', array('bold'=>true, 'arial'=>false, 'size'=>10, 'color'=>'blue'));
    $PHPWord->addFontStyle('estiloTitle', array('bold'=>true, 'arial'=>true, 'size'=>11 ));
    $PHPWord->addFontStyle('estiloTitle2', array('bold'=>true, 'align'=>'center', 'arial'=>true, 'size'=>20, 'color'=>'#8F2424'));
    $PHPWord->addFontStyle('estiloTitle3', array('bold'=>true, 'arial'=>true, 'size'=>12, 'color'=>'blue'));//Formato para links Primeras Planas
    $PHPWord->addParagraphStyle('pJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0)); 
    
    $header=$section->addHeader();
    $footer = $section->addFooter();
        
    $fecha=Date('Y-m-d');
    
    
    $section->addTextBreak(1);
    $imageStyle = array('width'=>300, 'height'=>90, 'align'=>'center');
    $header->addImage('logo.png', $imageStyle);
    $header->addText('Resumen Ejecutivo'.'   '.mostrar_fecha_completa($fecha),'estiloHead');
    $footer->addPreserveText('Pagina {PAGE} de {NUMPAGES}.');
    
    
    
    
     $resultTitular =mysql_query(Query($ids,1));
     if($resultTitular)
     {

         while ($row1 = mysql_fetch_array($resultTitular))
         {
            $Periodico=$row1['Periodico'];
            $Fecha=$row1['Fecha'];
            $Titulo=correctorOrtografico(strtoupper($row1['Titulo']));
            $Seccion=  utf8_encode(correctorOrtografico($row1['Seccion']));
            $NumeroPagina=$row1['NumeroPagina'];
            $Texto=(string)$row1['Texto'];
            $pd=$row1['pdf'];
            $Estado=$row1['Estado'];
            
            $autor=$row1['Autor'];
                $autor=  ucwords(strtolower($autor));
                if ($autor==""){
                    $autor=$row1['Periodico'];
                }
                
            
            $Per = utf8_decode($Periodico);
              switch($Per)
              {
                case "El milenio Nacional":
                  $Per = "Milenio";
                    $autor="Milenio";
                break;

                case "El Reforma":
                  $Per = "Reforma";
                    $autor="Reforma";
                break;

                case "La Razon":
                  $Per = "La Razón";
                    $autor="La Razón";
                break;

                case "La Cronica":
                  $Per = "La Crónica";
                    $autor="La Crónica";
                break;
            
                case "el sol de mexico":
                  $Per = "El Sol de México";
                    $autor="El Sol de México";
                break;
              }
              
            $Texto = correctorOrtografico($Texto);
            $Titulo = convert_Mayus($Titulo);
            $section->addText(urls_amigables(wordlimit2($Titulo)), 'estiloTitle');
            $section->addText(urls_amigables(wordlimit(EncuentraArreglo($Texto,Array('Gerardo Ruiz Esparza','Ruiz Esparza')))),'estiloTexto','pStyle');
            $section->addText(urls_amigables(wordlimit2("Autor : ".  correctorOrtografico($autor))), 'estiloTexto','pStyle');
                


              $file1=$pd;
              //$section->addLink('http://187.247.253.5/siscap.la/public/Periodicos/'.$file1, "\"".utf8_decode($Periodico)."\" ".(utf8_decode($Seccion)=="Error"?"":utf8_decode($Seccion))." ".$Fecha." Pag." .$NumeroPagina, 'estiloLink2','pStyle');
              $section->addLink('http://187.247.253.5/external/testigos/visor.php?p='.  base64_encode($Periodico)."&f=".  base64_encode($row1['Fecha'])."&pag=".  base64_encode($row1['PaginaPDF']), "\"".utf8_decode($Per)."\" ".(utf8_decode($Seccion)=="Error"?"":utf8_decode($Seccion))." ".$Fecha." Pag." .$NumeroPagina,'estiloLink2', 'pStyle2');
              $section->addTextBreak(1);  
        }
        
     }

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007'); 
    try {
         $objWriter->save("Notas.docx");
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    return $objWriter; 
    
}

function muestra($pdf,$page)
{
    $pdf2=$pdf."[".$page."]";

    $path="/img.jpg";
    

    $im = new imagick($pdf2);
    $im->setCompression(Imagick::COMPRESSION_JPEG);
    $im->setCompressionQuality(70);
    $im->setImageFormat( "jpg" );
    $im->writeimage($path,true);
}

function wordlimit($string, $length = 70)
{
    $words = explode(' ', $string);
    if (count($words) > $length)
    {
            return implode(' ', array_slice($words, 0, $length));
    }
    else
    {
            return $string;
    }
}

function wordlimit2($string, $length = 35)
{
    $words = explode(' ', $string);
    if (count($words) > $length)
    {
            return implode(' ', array_slice($words, 0, $length));
    }
    else
    {
            return $string;
    }
}

function mostrar_fecha_completa($fecha)
{
    $subfecha = explode("-",$fecha); 

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
};

function mostrar_mes($mes2)
{

     switch($mes2) 
    { 
        case "01":   // Bloque 1 
            $mes3='Enero'; 
        break; 
    
        case "02":   // Bloque 1 
            $mes3='Febrero';
        break; 
    
        case "03":   // Bloque 1 
            $mes3='Marzo';
        break; 
    
        case "04":   // Bloque 1 
            $mes3='Abril'; 
        break;  
        
        case "05":   // Bloque 1 
            $mes3='Mayo';
        break;   
        
        case "06":   // Bloque 1 
            $mes3='Junio';    
        break; 
        
        case "07":   // Bloque 1 
            $mes3='Julio';
        break; 
    
        case "08":   // Bloque 1 
            $mes3='Agosto';
        break; 
    
        case "09":   // Bloque 1 
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
   
   
return $mes3;
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

function sanear_string($string)
{

    $string = trim(utf8_decode($string));

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    /*$string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "."),
        '',
        $string
    );*/

    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "<"),
        '',
        $string
    );
    return $string;
}

function urls_amigables($url) {
 
$find = array('/[^a-zA-Z0-9\-<>,.:;¿ÁÉÍÓÚáéíóúÑñ ]/', '/[\-]+/', '/<[^>]*>/');
 
$repl = array(' ','-','');
 
$url = preg_replace ($find, $repl, $url);

return $url;
 
}


function CorrigeOrtografica($cadena)
{
     session_start();  
      for($j=0;$j<=$_SESSION['contador'];$j++)
        {
         // "<br>".$j.$palabras1[$j]." - ".$palabras2[$j]."<br>";   
             $cadena=  str_ireplace($_SESSION['palabras1'][$j],$_SESSION['palabras2'][$j], $cadena);
        }

return $cadena;
}
  
function getRealIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $ip=substr($ip, 0, 2);
   
    
        if($ip==19)
        {
            $host="192.168.3.154";
        }else{
         $host="187.247.253.5";
        }
        
   return  $host;
 
}

function EncuentraCoincidencias($cadenaOriginal,$valorBuscado){

    preg_match_all("#(.*)\. #U",$cadenaOriginal,$match);

    if(count($match[1])<1) return false;

    for($i=0;$i<count($match[1]);$i++) {

        $posicion = strpos($match[1][$i], $valorBuscado);

        if( $posicion !== false ){
            if( $i == 0 ) return $match[1][$i] . "(...)";
            else if( $i > 0 && $i < count($match[1]) ) return $match[1][$i] . "(...)" ;
            else if( $i == count($match[1]) ) return $match[1][$i];
        }
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

function Query($ids,$pestaña)
{
    $sql="";
    switch ($pestaña)
    {
        case 1:
            $sql="SELECT DISTINCT(n.idEditorial), 
                    p.Nombre AS 'Periodico',
                    n.Fecha,
                    n.Titulo,
                    s.seccion AS 'Seccion',
                    n.PaginaPeriodico AS 'NumeroPagina',
                    n.NumeroPagina as 'PaginaPDF',
                    n.Texto,
                    CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
                    CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
                    e.Nombre AS 'Estado',
                    n.Autor
                FROM 
                    noticiasSemana n,
                    ordenGeneral o,
                    periodicos p,
                    seccionesPeriodicos s,
                    estados e
                WHERE 
                    n.idEditorial in ($ids) AND 
                    n.Periodico=p.idPeriodico AND 
                    n.Periodico=o.periodico AND 
                    p.Estado = e.idEstado AND 
                    s.idSeccion = n.Seccion AND 
                    Fecha=DATE('2014-11-07') AND 
                    n.Categoria<>80 AND 
                    n.Seccion NOT IN(63,21,765,533,22,201,1577,17,361,411,239,1611,626) AND
                    p.Estado=9 AND 
                    n.Activo=1
                ORDER BY o.posicion";
        break;//Distrito Federal
    
        default:
            $sql="SELECT DISTINCT(n.idEditorial), 
                    p.Nombre AS 'Periodico',
                    n.Fecha,
                    n.Titulo,
                    s.seccion AS 'Seccion',
                    n.PaginaPeriodico AS 'NumeroPagina',
                    n.NumeroPagina as 'PaginaPDF',
                    n.Texto,
                    CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf',
                    CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg',
                    e.Nombre AS 'Estado',
                    n.Autor
                FROM 
                    noticiasSemana n,
                    periodicos p,
                    seccionesPeriodicos s,
                    estados e
                WHERE 
                    n.idEditorial in ($ids) AND 
                    n.Periodico=p.idPeriodico AND
                    p.Estado = e.idEstado AND 
                    s.idSeccion = n.Seccion
                    ORDER BY p.Estado,p.Nombre";
        break;//Estados
    }
    return $sql;
}

?>
