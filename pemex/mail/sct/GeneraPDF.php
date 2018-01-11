<?php
error_reporting(E_ALL);

// Notificar todos los errores de PHP
error_reporting(-1);

//require "/var/www/external/services/mail/conexion.php";
require "../conexion.php";

mysql_query("set names 'utf8'");

function EncuentraCoincidencias3($cad){
   //patron para enter
  //$patron = '/\n/';

  //patron para punto .
  $patron = '/\./';

  preg_match_all($patron, $cad, $coincidencias, PREG_OFFSET_CAPTURE);

  $parrafos = $coincidencias[0];

  //DEFINIMOS QUE SEA HASTA EL SEGUNDO PARRAFO
  $parrafo = ( !empty( $parrafos[2] ) )? $parrafos[2] :''; 
  
  if( !empty( $parrafo ) ){

      $nvaCad =  substr($cad, 0, $parrafo[1] + 1);

      preg_match_all("/\./", $nvaCad, $co, PREG_OFFSET_CAPTURE);

      $puntos = ( !empty( $co[0] ) )? $co[0] : '';

      //punto definimos que sea hasta el segundo punto
      if( !empty($puntos[2]) ){

          $punto = $puntos[2];  
          $nuevaCadena =  substr($nvaCad, 0, $punto[1] + 1 )."..";
       
      }else{

        $nuevaCadena = $nvaCad;
      } 
      


  }else{

    $nuevaCadena = $cad; 
  }

  return  $nuevaCadena ;
}

function EncuentraCoincidencias2($cadenaOriginal,$valorBuscado){
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


function EncuentraArreglo2($cadenaOriginal,$array){
    $cadena=false;
    foreach ($array as $value)
    {
        $cadena=EncuentraCoincidencias2($cadenaOriginal,$value);
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


function sanear_string($string)
{
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

function correctorOrtografico2($cadena)
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

function fecha_completa2($fecha)
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

function texto($pdf,$sql,$titulo)
{
  $urlP = "http://187.247.253.5";
  mysql_query("set names 'utf8'");
  $data =  mysql_query($sql);
  $total=  mysql_affected_rows();

  if(mysql_affected_rows()>0)
  {
      $contadorPages=0;
      $pdf->Ln();
      $pdf->SetFont("arial", "B", 14);
      $pdf->SetFillColor(106,188,60);
      $pdf->setTextColor(255);
      $pdf->Cell(200, 5, $titulo,0, 1, 'C', true);
    
      $pdf->SetFillColor(255);

      while ($row = mysql_fetch_array($data)) 
      {
          $contadorPages++;
          if( !empty( trim($row['Texto']))){
                $periodico = utf8_decode( $row['Periodico'] );
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
                    $periodico = utf8_decode("La Razón");
                      $autor="La Razón";
                  break;

                  case "la cronica":
                    $periodico = utf8_decode("La Crónica");
                      $autor="La Crónica";
                  break;

                  case "el sol de mexico":
                    $periodico = utf8_decode("El Sol de México");
                      $autor="El Sol de México";
                  break;
                }
                $pdf->Ln(15);
                $pdf->SetFont("arial", "B", 10);
                $pdf->setTextColor(0);
                $pdf->SetFillColor(224);
                $pdf->Ln(1);
                $pdf->Cell(200, 5, "Titulo : ".sanear_string(utf8_decode( $row['Titulo'])) ,0, 1, 'L', true);
                $pdf->SetFont("arial", "B", 10);
                $pdf->setTextColor(0);
                $pdf->SetFillColor(224);
                $pdf->Ln(1);
                $pdf->Cell(200, 5, "Periodico : ".$periodico ,0, 1, 'L', true);
                $pdf->SetFont("arial", "B", 10);
                $pdf->setTextColor(0);
                $pdf->SetFillColor(224);
                $pdf->Ln(1);
                $pdf->Cell(200, 5, utf8_decode("Sección : ".$row['seccion']) ,0, 1, 'L', true);
                $pdf->SetFont("arial", "B", 10);
                $pdf->setTextColor(0);
                $pdf->SetFillColor(224);
                $pdf->Ln(1);
                $pdf->Cell(200, 5, "Pagina : ".$row['PaginaPeriodico'] ,0, 1, 'L', true);
                $pdf->SetFont("arial", "B", 10);
                $pdf->setTextColor(0);
                $pdf->SetFillColor(224);
                $pdf->Ln(1);
                $pdf->Cell(200, 5, "Autor : ".utf8_decode($row['Autor']) ,0, 1, 'L', true);

                $pdf->Ln();
                $pdf->setTextColor(0);
                $pdf->SetFont("arial", "", 9);
                $texto = sanear_string(utf8_decode(  $row['Texto']));
                $texto = correctorOrtografico2($texto);
                
                
                $pdf->MultiCell(200,4, $texto ,0,'J');
                $pdf->Ln();
                $pdf->SetFont("arial", "", 8);
                $pdf->SetTextColor(86, 104, 239);
                $pdf->Cell(200,4, $periodico." ".utf8_decode(  $row['Estado'])." ".date("Y-m-d")." Pag. ".utf8_decode(  $row['PaginaPeriodico']) ,0,0,'L',false, $urlP . $row['pdf'] );
                $pdf->Ln();
                $pdf->SetFont("arial", "", 7.5);
                $pdf->SetTextColor(0);
                $pdf->Cell( 150,4, $urlP . $row['pdf'],0,0,'L',false, $urlP."/". $row['pdf']);
                $pdf->Ln(10);
                if($contadorPages<$total)
                {
                    $pdf->addPage();
                }
          }
      }
      
  }
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


function cintillos($pdf,$fecha) //PORTADAS OK
{
    $FechaCliente = strtotime($fecha);
    $fecha_actual1 = date('Y-m-d');
    $fecha_actual = strtotime($fecha_actual1);
            
    if ($FechaCliente == $fecha_actual){
        $Tabla="noticiasDia";
    }
    else{
        $Tabla="noticiasSemana";
    }  
    
    $sql="SELECT
	DISTINCT(n.idEditorial),
	p.Nombre AS 'Periodico',
	p.idPeriodico as 'idPeriodico',
	n.Fecha,
	n.Titulo,
	s.seccion AS 'Seccion',
	n.PaginaPeriodico,
	n.NumeroPagina as 'PaginaPDF',
	REPLACE(n.Texto,'\n',' ') Texto,
	CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' ,
	CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' ,
	e.Nombre AS 'Estado',
	n.Autor
    FROM 
        $Tabla n,
        periodicos p,
        ordenGeneral o,
        estados e,
        seccionesPeriodicos s
    WHERE 
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Categoria in(3) AND
        e.idEstado=p.Estado AND
        n.Activo = 1 AND
        Fecha=DATE('$fecha')
    GROUP BY p.Nombre
    ORDER BY o.posicion";
    $y = 45;
    $i = 0;
    $temp=0;
    $resp=  mysql_query($sql);
    while($row= mysql_fetch_array($resp))
    {

        $i++;
        $periodico = utf8_encode($row['Periodico']);
        $idperiodico = utf8_encode($row['idPeriodico']);
        $periodico =  ucwords($periodico);
        $titulito = strtoupper($row['Titulo']);
       

        $titulito = correctorOrtografico2($titulito);

        $titulito = convert_Mayus($titulito);

        if(is_file("/var/www/external/services/mail/sct/Word2/thumb-".$idperiodico.".jpg"))
        {
          $pdf->Image("/var/www/external/services/mail/sct/Word2/thumb-".ucwords(strtolower($idperiodico).".jpg"),20,$y,30,30);

            if($titulito!="")
            {
              $pdf->setY( $y + 15 );
              $pdf->setX( 60 );
              $pdf->SetTextColor(86, 104, 239);
              $pdf->Cell(200, 3, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'L', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              
            }
          $y += 20;
        }
      
        
        if($i == 14){
            $temp=$temp+$i;
          $i = 0;
          if($temp<28)
          {
              $pdf->AddPage();
          }    
          $y = 45; 
        }
    }
}

function cintillosPoliticas($pdf,$fecha) //PORTADAS OK
{
    $FechaCliente = strtotime($fecha);
    $fecha_actual1 = date('Y-m-d');
    $fecha_actual = strtotime($fecha_actual1);
            
    if ($FechaCliente == $fecha_actual){
        $Tabla="noticiasDia";
    }
    else{
        $Tabla="noticiasSemana";
    }  
    
    $sql="SELECT
	DISTINCT(n.idEditorial),
	p.Nombre AS 'Periodico',
	p.idPeriodico as 'idPeriodico',
	n.Fecha,
	n.Titulo,
	s.seccion AS 'Seccion',
	n.PaginaPeriodico,
	n.NumeroPagina as 'PaginaPDF',
	REPLACE(n.Texto,'\n',' ') Texto,
	CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' ,
	CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' ,
	e.Nombre AS 'Estado',
	n.Autor
    FROM 
        $Tabla n,
        periodicos p,
        ordenGeneral o,
        estados e,
        seccionesPeriodicos s
    WHERE 
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Categoria in(19) AND
        e.idEstado=p.Estado AND
        n.Activo = 1 AND
        Fecha=DATE('$fecha')
    GROUP BY p.Nombre
    ORDER BY o.posicion";
    $y = 45;
    $i = 0;
    $temp=0;
    $resp=  mysql_query($sql);
    while($row= mysql_fetch_array($resp))
    {

        $i++;
        $periodico = utf8_encode($row['Periodico']);
        $idperiodico = utf8_encode($row['idPeriodico']);
        $periodico =  ucwords($periodico);
        $titulito = strtoupper($row['Titulo']);
       

        $titulito = correctorOrtografico2($titulito);

        $titulito = convert_Mayus($titulito);

        if(is_file("/var/www/external/services/mail/sct/Word2/thumb-".$idperiodico.".jpg"))
        {
          $pdf->Image("/var/www/external/services/mail/sct/Word2/thumb-".ucwords(strtolower($idperiodico).".jpg"),20,$y,30,30);

            if($titulito!="")
            {
              $pdf->setY( $y + 15 );
              $pdf->setX( 60 );
              $pdf->SetTextColor(86, 104, 239);
              $pdf->Cell(200, 3, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'L', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              
            }
          $y += 20;
        }
      
        
        if($i == 14){
            $temp=$temp+$i;
          $i = 0;
          if($temp<28)
          {
              $pdf->AddPage();
          }    
          $y = 45; 
        }
    }
}

function cintillosFinancieras($pdf,$fecha) //PORTADAS OK
{
    $FechaCliente = strtotime($fecha);
    $fecha_actual1 = date('Y-m-d');
    $fecha_actual = strtotime($fecha_actual1);
            
    if ($FechaCliente == $fecha_actual){
        $Tabla="noticiasDia";
    }
    else{
        $Tabla="noticiasSemana";
    }  
    
    $sql="SELECT
	DISTINCT(n.idEditorial),
	p.Nombre AS 'Periodico',
	p.idPeriodico as 'idPeriodico',
	n.Fecha,
	n.Titulo,
	s.seccion AS 'Seccion',
	n.PaginaPeriodico,
	n.NumeroPagina as 'PaginaPDF',
	REPLACE(n.Texto,'\n',' ') Texto,
	CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' ,
	CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' ,
	e.Nombre AS 'Estado',
	n.Autor
    FROM 
        $Tabla n,
        periodicos p,
        ordenGeneral o,
        estados e,
        seccionesPeriodicos s
    WHERE 
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Categoria in(20) AND
        e.idEstado=p.Estado AND
        n.Activo = 1 AND
        Fecha=DATE('$fecha')
    GROUP BY p.Nombre
    ORDER BY o.posicion";
    $y = 45;
    $i = 0;
    $temp=0;
    $resp=  mysql_query($sql);
    while($row= mysql_fetch_array($resp))
    {

        $i++;
        $periodico = utf8_encode($row['Periodico']);
        $idperiodico = utf8_encode($row['idPeriodico']);
        $periodico =  ucwords($periodico);
        $titulito = strtoupper($row['Titulo']);
       

        $titulito = correctorOrtografico2($titulito);

        $titulito = convert_Mayus($titulito);

        if(is_file("/var/www/external/services/mail/sct/Word2/thumb-".$idperiodico.".jpg"))
        {
          $pdf->Image("/var/www/external/services/mail/sct/Word2/thumb-".ucwords(strtolower($idperiodico).".jpg"),20,$y,30,30);

            if($titulito!="")
            {
              $pdf->setY( $y + 15 );
              $pdf->setX( 60 );
              $pdf->SetTextColor(86, 104, 239);
              $pdf->Cell(200, 3, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'L', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              
            }
          $y += 20;
        }
      
        
        if($i == 14){
            $temp=$temp+$i;
          $i = 0;
          if($temp<28)
          {
              $pdf->AddPage();
          }    
          $y = 45; 
        }
    }
}

function cintillosCartones($pdf,$fecha) //PORTADAS OK
{
    $FechaCliente = strtotime($fecha);
    $fecha_actual1 = date('Y-m-d');
    $fecha_actual = strtotime($fecha_actual1);
            
    if ($FechaCliente == $fecha_actual){
        $Tabla="noticiasDia";
    }
    else{
        $Tabla="noticiasSemana";
    }  
    
    $sql="SELECT
	DISTINCT(n.idEditorial),
	p.Nombre AS 'Periodico',
	p.idPeriodico as 'idPeriodico',
	n.Fecha,
	n.Titulo,
	s.seccion AS 'Seccion',
	n.PaginaPeriodico,
	n.NumeroPagina as 'PaginaPDF',
	REPLACE(n.Texto,'\n',' ') Texto,
	CONCAT(REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',n.NumeroPagina) AS 'pdf' ,
	CONCAT(p.Nombre,'/',n.Fecha,'/',n.NumeroPagina) AS 'jpg' ,
	e.Nombre AS 'Estado',
	n.Autor
    FROM 
        $Tabla n,
        periodicos p,
        ordenGeneral o,
        estados e,
        seccionesPeriodicos s
    WHERE 
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
        n.Categoria in(18) AND
        e.idEstado=p.Estado AND
        n.Activo = 1 AND
        Fecha=DATE('$fecha')
    GROUP BY p.Nombre
    ORDER BY o.posicion";
    $y = 45;
    $i = 0;
    $temp=0;
    $resp=  mysql_query($sql);
    while($row= mysql_fetch_array($resp))
    {

        $i++;
        $periodico = utf8_encode($row['Periodico']);
        $idperiodico = utf8_encode($row['idPeriodico']);
        $periodico =  ucwords($periodico);
        $titulito = strtoupper($row['Titulo']);
       

        $titulito = correctorOrtografico2($titulito);

        $titulito = convert_Mayus($titulito);

        if(is_file("/var/www/external/services/mail/sct/Word2/thumb-".$idperiodico.".jpg"))
        {
          $pdf->Image("/var/www/external/services/mail/sct/Word2/thumb-".ucwords(strtolower($idperiodico).".jpg"),20,$y,30,30);

            if($titulito!="")
            {
              $pdf->setY( $y + 15 );
              $pdf->setX( 60 );
              $pdf->SetTextColor(86, 104, 239);
              $pdf->Cell(200, 3, correctorOrtografico2( utf8_decode($titulito) ) ,0, 0, 'L', FALSE, 'http://187.247.253.5/external/testigos/visor.php?p='.base64_encode(utf8_encode($row['Periodico']))."&f=".base64_encode($row['Fecha'])."&pag=".base64_encode($row['PaginaPDF']) );
              
            }
          $y += 20;
        }
      
        
        if($i == 14){
            $temp=$temp+$i;
          $i = 0;
          if($temp<28)
          {
              $pdf->AddPage();
          }    
          $y = 45; 
        }
    }
}

require_once ('../fpdf17/fpdf.php');
require_once ('../FPDI-1.4.4/fpdi.php');
 
class PDF extends FPDI
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('/var/www/external/services/mail/sct/logo.png',80,10);
        //color negro
        $this->SetTextColor(0);
        // Arial bold 15
        $this->SetFont('Arial','',11);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->SetXY(150,30);
        $this->Cell(50,30, "Resumen Ejecutivo / ".utf8_decode( fecha_completa2(date('Y-m-d')) ) ,0,0,'R');
        // Salto de línea
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        //color negro
        $this->SetTextColor(0);
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().' / {nb}',0,0,'C');
    }
}


function portadaDocumento($opc,$fecha)
{
    require_once ('../fpdf17/fpdf.php');
    require_once ('../FPDI-1.4.4/fpdi.php');
    
    try {
        $pdf = new PDF('P','mm','legal');
        
        $pdf->AliasNbPages();
        $pdf->addPage();
                    //Recuadro Gris Inferior
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 131, 250, 40, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 25);
        $pdf->Text(10,146,"Resumen Ejecutivo");
        switch ($opc){
            case 1:
                $pdf->SetFont("arial", "B", 18);
                $pdf->Text(10,160,"8 Columnas");
            break;
        
            case 2:
                $pdf->SetFont("arial", "B", 18);
                $pdf->Text(10,160,  utf8_decode("Columnas Políticas"));
            break; 
        
            case 3:
                $pdf->SetFont("arial", "B", 18);
                $pdf->Text(10,160,"Columnas Financieras");
            break; 
        
            case 4:
                $pdf->SetFont("arial", "B", 18);
                $pdf->Text(10,160,"Cartones");
            break;  
        
            default:
                $pdf->SetFont("arial", "B", 18);
                $pdf->Text(10,160,titulos($opc));
        }
        $pdf->setTextColor(255,255,255);

        $pdf->Image('logo.png',5,100,100); 
        $pdf->SetFont("arial", "B",15);
        $pdf->setTextColor();
        //$pdf->Text(130,177,mostrar_fecha_completa2(date('Y-m-d')));

        $pdf->addPage();
        $pdf->SetX(10);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial','B',11);
        switch ($opc){
            case 1:
                cintillos($pdf, $fecha);
                $pdf->Output("SCT 8 Columnas ".  fecha_completa2($fecha).".pdf", 'D');
            break;   
        
            case 2:
                cintillosPoliticas($pdf, $fecha);
                $pdf->Output("SCT Columnas Politicas ".  fecha_completa2($fecha).".pdf", 'D');
            break;    
        
            case 3:
                cintillosFinancieras($pdf, $fecha);
                $pdf->Output("SCT Columnas Politicas ".  fecha_completa2($fecha).".pdf", 'D');
            break;    
        
            case 4:
                cintillosCartones($pdf, $fecha);
                $pdf->Output("SCT Columnas Politicas ".  fecha_completa2($fecha).".pdf", 'D');
            break;
        
            default :
                $pdf->SetY(20);
                texto($pdf,querys($opc), titulos($opc));
                $pdf->Output("SCT ".titulos($opc)." ".fecha_completa2($fecha).".pdf", 'D');
                
        }
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}


/*
//QUERY PARA LA SECRETARIA DE HACIENDA Y CREDITO PUBLICO
$qrySHCP = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
  e.Nombre AS Estado,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  REPLACE(n.Texto,'\n',' ') Texto,
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
          Encabezado like '%secretaria de hacienda%' 
          
          ) AND Texto not like '%ex secretario de Hacienda%' 
ORDER BY o.posicion";
$buscar = array("SHCP.","subsecretario de Hacienda","Servicio de Administración Tributaria","Secretaría de Hacienda y Crédito Público","Secretaría de Hacienda","SHCP","shcp","Luis Videgaray Caso","Luis Videgaray","servicio de administracion tributaria","SAT",
              "secretario de hacienda","secretaria de hacienda y credito publico","hacienda y credito publico","secretaria de hacienda","Secretaría de Haciendaa","Comisión de Hacienda y Crédito Público","Hacienda y Crédito Público");

texto($pdf, $qrySHCP, $titulo = "SECRETARIA DE HACIENDA Y CREDITO PUBLICO", $buscar);
*/


function principal($opc,$fecha)
{
    switch ($opc)
    {
       case 1:
           portadaDocumento(1,$fecha);
       break;//Primeras Planas    
   
       case 2:
           portadaDocumento(2,$fecha);
       break; //Politicas 
   
       case 3:
           portadaDocumento(3,$fecha);
       break; //Financieras  
   
       case 4:
           portadaDocumento(4,$fecha);
       break; //Cartones   
   
       default: 
           portadaDocumento($opc,$fecha);
    }
}


function querys($opc){
    $sql="";
    switch ($opc)
    {
        case 5:
            $sql="SELECT
                   n.Periodico as idPeriodico,
                   n.idEditorial,
                   n.Titulo,
                   p.Nombre as Periodico,
                   e.Nombre AS Estado,
                   n.PaginaPeriodico,
                   s.seccion,
                   c.Categoria as Categoria,
                   n.Autor,
                   REPLACE(n.Texto,'\n',' ') Texto,
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
                  p.Estado=9 AND
                    fecha = CURDATE() AND(
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
        break;//Secretario
        
    }
    
    return $sql;
}
function titulos($opc){
    $label="";
    switch ($opc)
    {
        case 5:
            $label="Gerardo Ruiz Esparza";
        break;
    
        case 6:
            $label="Subsecretaria de Infraestructura";
        break;
    
        case 7:
            $label="Subsecretaria de Transporte";
        break;
    
        case 8:
            $label="Subsecretaria de Comunicaciones";
        break;
    
        case 9:
            $label="Funcionarios";
        break;
    
        case 10:
            $label="Delegaciones";
        break;
    
        case 11:
            $label="Puertos";
        break;
    
        case 12:
            $label="Servicio Postal";
        break;
    
        case 13:
            $label="Tren Suburbano";
        break;
    
        case 14:
            $label="Transporte Público Federal";
        break;
    
        case 15:
            $label="Carreteras y Autopistas";
        break;
    
        case 16:
            $label="CAPUFE";
        break;
    
        case 17:
            $label="Transporte Ferroviario";
        break;
    
        case 18:
            $label="TV. Digital Terrestre";
        break;
    
        case 19:
            $label="Plan Nuevo Guerrero";
        break;
    
        case 20:
            $label="Sec. Aereo";
        break;
    
        case 21:
            $label="Telecomunicaciones";
        break;
    
        case 22:
            $label="Varios";
        break;

        default:
            break;
    }
    return $label;
}


function negrita($texto)
{
    
}
principal(base64_decode(base64_decode($_GET['o'])),$_GET['f']);    