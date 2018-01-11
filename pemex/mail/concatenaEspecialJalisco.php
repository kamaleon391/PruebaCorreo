<?php
//echo "Inicio<br>";
include "/var/www/external/services/mail/querysJalisco_DF.php";
include "/var/www/external/services/mail/conexion.php";
    
$fecha = DATE('Y-m-d');

//portada($fecha);

//$valor=1;
$query=query(3,$fecha);

//echo $query."<br><br><hr>";

Consulta( 3 ); // LLAMAR CON QUERY DF
//echo "DF<br>";
Consulta( 4 ); // LLAMAR CON QUERY JALISCO

function Cuenta($consulta,$fecha)
{
    $query = mysql_query($consulta);
    $paginas = mysql_fetch_row($query);
    for($i=1;$i<=$paginas[0];$i++)
    {
        Consulta($i,$fecha);
    }
}

function Consulta( $query_number )
{
    $fecha = DATE('Y-m-d');
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  //$pdf = new FPDI('P','mm','legal');
    $pdf = new FPDI('P','mm','A4');

    $portada = '/var/www/external/testigos/Jalisco/05/portada/portada.pdf';
    $sintesis = '/var/www/external/services/clientesPDF/jalisco/Gobernador.pdf';
    $pdfs = array();
        

    $i=1;
    $query1 =  mysql_query( query( $query_number, $fecha ) );
    //echo "<br><br>".$query1."<br><br><br><hr>";
    while ( $row = mysql_fetch_array( $query1 )  ) {
        $variable[$i] = $row['pdf'];
        $periodico[$i] = $row['Periodico'];
        $secciones[$i] = $row['Seccion'];
        $titulos[$i]= $row['Titulo'];
        $textos[$i]= $row['Texto'];
        $secciones[$i]= $row['seccion'];
           
        if( file_exists( $row['pdf'] )  ) {
            if( $i == 1 ) {
                $pdfs[] = $portada;
                $pdfs[] = $sintesis;
            } 
            $pdfs[] = $row['pdf']; 
            $i++;
        }
    }

    if( !empty($pdfs) ) {
        $pdf->setFiles( $pdfs );  
        $pdf->concat();
        $antigua = umask(0);

        if(is_dir("/var/www/external/testigos/Jalisco/Especial/".$fecha."/")){
               echo "IF Carpeta Existente<br>";
        }
        else{
            echo "Generando Carpeta<br>";
            mkdir("/var/www/external/testigos/Jalisco/Especial/".$fecha."/",true,0777);
            chmod("/var/www/external/testigos/Jalisco/Especial/".$fecha."/",0777);
            umask($antigua);
        }
        
        if ( $query_number === 3 ){
            echo "DF<br>";
            $nombre="/var/www/external/testigos/Jalisco/Especial/".$fecha."/DF.pdf";
        }
        
        if( $query_number === 4 ) {
            echo "Jalisco<br>";
            $nombre="/var/www/external/testigos/Jalisco/Especial/".$fecha."/Jalisco.pdf";
        }
        
        
        if(is_dir("/var/www/external/testigos/Jalisco/Especial/".$fecha))
        {
            echo "Escribiendo:.....<br>";
            $pdf->Output($nombre, 'F');
        }else{
            
            echo "Error echo echo echo  Escritura<br>".__DIR__;
        } 
  
      }else{
          echo "Array Vacio <br>";
          
      }

}


function portada($fecha)
{
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  $pdf = new FPDI('P','mm','legal');

  $pdf->addPage();
  $pdf->SetFillColor(245,245,245);
  $pdf->Rect(0, 131, 250, 40, 'F');

  $pdf->setTextColor();
  $pdf->SetFont("arial", "B", 30);
  $pdf->Text(10,156,strtoupper('JALISCO'));
  $pdf->SetFont("arial", "B", 13);
  $pdf->setTextColor(255,255,255);
  $pdf->Text(10,23,"test");

  $pdf->Image('/var/www/external/services/mail/jalisco/Logo.jpg',5,90,100); 
  $pdf->SetFont("arial", "B",15);
  $pdf->setTextColor();
  $pdf->Text(110,177,mostrar_fecha_completa($fecha));   
         
 
   $antigua = umask(0);

    if( ! is_dir("/var/www/external/testigos/Jalisco/Especial/".$fecha."/portada/")){
    
      mkdir("/var/www/external/testigos/Jalisco/Especial/".$fecha."/portada",true,0777);
      chmod("/var/www/external/testigos/Jalisco/Especial/".$fecha."/portada",0777);
      umask($antigua);
    }

    $nombre = "/var/www/external/testigos/Jalisco/Especial/".$fecha."/portada/portada.pdf";

    if(is_dir("/var/www/external/testigos/Jalisco/Especial/".$fecha."/portada"))
    {
        $pdf->Output($nombre, 'F');
    }else{
        echo "Error echo echo echo  Escritura<br>".__DIR__;
    }    

}

function mes($fecha){
  list($a,$m,$d) = explode("-", $fecha);
  return $m;
}

function mostrar_fecha_completa($fecha){
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
         $dia_sem3='Miercoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='Sabado'; 
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
