    <?php

    //include "/var/www/external/services/mail/querysJalisco_gira.php";
    include "/var/www/external/services/mail/querysJalisco_gira2.php";
    include "/var/www/external/services/mail/conexion.php";

  //$fecha = date('Y-m-d');
  $fecha = '2014-11-12';

    $valor = 1;
  
  $query1 = query(1,$fecha);
    creaPDF( $query1 , 1, $fecha);

    //$query2 = query(2,$fecha);
    //creaPDF( $query2 , 2, $fecha);


      
function creaPDF( $query , $tipo, $fecha){

  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
  
  $pdf = new FPDI('P','mm','legal');

  

  $est = ($tipo == 1) ?'DF':'Jalisco';  

  $fechaCompleta = mostrar_fecha_completa( $fecha );
        
  //CODIGO DE LA PORTADA
  $pdf->addPage();
  $pdf->SetFillColor(245,245,245);
  $pdf->Rect(0, 131, 250, 40, 'F');

  $pdf->setTextColor();
  $pdf->SetFont("arial", "B", 30);
  $pdf->Text(10,156,strtoupper($est));
  $pdf->SetFont("arial", "B", 13);
  $pdf->setTextColor(255,255,255);
  $pdf->Text(10,23,"test");

  $pdf->Image('/var/www/external/services/mail/jalisco/Logo.jpg',5,90,100); 
  $pdf->SetFont("arial", "B",15);
  $pdf->setTextColor();
  $pdf->Text(110,177,$fechaCompleta);  
    
    $pdfs = array();

    $query1 =  mysql_query($query);
    $filas = mysql_affected_rows();

    if($filas > 0)
    {
      while( $row = mysql_fetch_array($query1) ) 
      {
          $variable = $row['pdf'];

          if(file_exists($variable)) array_push($pdfs, $variable);
      }
      //$pdfs[]= "/var/www/Sistema-de-Captura/Periodicos/El Mural/2014-11-08/A_9.pdf";
      //$pdfs[]= "/var/www/Sistema-de-Captura/Periodicos/La Cronica Jalisco/2014-11-08/3_A.pdf";
      

      if( !empty($pdfs) )
      {

        //print_r( $pdfs );
      
        $pdf->setFiles( $pdfs );  
        $pdf->concat();

        $lugar = ($tipo == 1) ?'df':'jalisco';       

        $nombre="/var/www/external/testigos/Jalisco/gira/".$lugar."/".$fecha."_jalisco_gira.pdf";
        //if(is_dir("/var/www/external/testigos/Jalisco/gira/".$lugar."/".$fecha ))
        if(is_dir("/var/www/external/testigos/Jalisco/gira/".$lugar))
        {
          $pdf->Output($nombre, 'F');
        }else{
          
          echo "Error echo echo echo  Escritura<br>".__DIR__;
        }

      }  

    }   

  
        
  

    /*    
      $pdf->addPage();
      $pdf->SetFillColor(245,245,245);
      $pdf->Rect(0, 131, 250, 40, 'F');

      $pdf->setTextColor();
      $pdf->SetFont("arial", "B", 30);
      $pdf->Text(10,156,strtoupper($est));
      $pdf->SetFont("arial", "B", 13);
      $pdf->setTextColor(255,255,255);
      $pdf->Text(10,23,"test");

      $pdf->Image('/var/www/external/services/mail/jalisco/Logo.jpg',5,90,100); 
      $pdf->SetFont("arial", "B",15);
      $pdf->setTextColor();
      $pdf->Text(110,177,$fechaCompleta);   

        $i=0;
        $query1 =  mysql_query($query);
        $filas = mysql_affected_rows();

        if($filas > 0)
        {
          while( $row = mysql_fetch_array($query1) ) 
          {
                $variable = $row['pdf'];
                $periodico = $row['Periodico'];
                $secciones = $row['seccion'];
                $titulos =  $row['Titulo'];
                $textos = $row['Texto'];
                $secciones = $row['seccion'];

                if(file_exists($variable))
                {
                  $pageCount = $pdf->setSourceFile($variable);
                  $tplIdx = $pdf->importPage(1);
                  $pdf->addPage();
                  //rectangulo GRis
                  $pdf->SetFillColor(245,245,245);
                  $pdf->Rect(0, 0, 250, 18, 'F');


                  //rentangulo Azul
                  $pdf->SetFillColor(0, 191, 255);
                  $pdf->Rect(0, 10, 140, 15, 'F');


                  $pdf->setTextColor();
                  $pdf->SetFont("arial", "B", 20);
                  $pdf->Text(10,18,strtoupper($periodico));
                  $pdf->SetFont("arial", "B", 13);
                  $pdf->setTextColor(255,255,255);
                  $pdf->Text(10,23,strtoupper($secciones));
                  $pdf->SetFont("arial", "B", 9);
                  $pdf->setTextColor();
                  $pdf->SetY(8);
                  $pdf->Cell(0,0,  'Gobierno del Estado',0,'','R');
                  $pdf->Image('/var/www/external/services/mail/jalisco/Logo.jpg',5,340,30); 
                  $pdf->SetFont("arial", "B",12);
                  $pdf->setTextColor();
                  $pdf->Text(182,13,$fecha);
                  $pdf->SetFont("arial", "B", 15);
                 
                  $pdf->useTemplate($tplIdx, 20,26,170);

                  }


            $i++;
          }

      

            $lugar = ($tipo == 1) ?'df':'jalisco';       

        
            $nombre="/var/www/external/testigos/Jalisco/gira/".$lugar."/".$fecha."_jalisco_gira.pdf";
            //if(is_dir("/var/www/external/testigos/Jalisco/gira/".$lugar."/".$fecha ))
            if(is_dir("/var/www/external/testigos/Jalisco/gira/".$lugar))
            {
              $pdf->Output($nombre, 'F');
            }else{
              
              echo "Error echo echo echo  Escritura<br>".__DIR__;
            }
         */   

    //}
       
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

function sanear_string($url) {
 
 
//Rememplazamos caracteres especiales latinos
 
$find = array('?');
 
$repl = array('');
 
$url = str_replace ($find, $repl, $url);

//$url = ucfirst($url);
 /*
/ Eliminamos y Reemplazamos demás caracteres especiales

$find = array('/[^a-zA-Z0-9\-<>,.:;¿ÁÉÍÓÚáéíóúÑñ ]/', '/[\-]+/', '/<[^>]*>/');
 
$repl = array(' ','-','');
 
$url = preg_replace ($find, $repl, $url);
*/
return $url;
 
}