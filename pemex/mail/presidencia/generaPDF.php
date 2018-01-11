<?php

error_reporting(-1);

// Lo mismo que error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

set_time_limit(0);



include '/var/www/external/services/mail/presidencia/querysPres2.php';

  $fecha = date('Y-m-d');

  for($a = 1; $a <= 32; $a++)
  {

      $query = query($a, $fecha);

      $tema = utf8_decode("Enrique Peña Nieto");
      $subtema = "";

      switch ( $a ) 
        {

            case 1 : $subtema = "Aguascalientes"; break;
            case 2 : $subtema = "Baja California"; break;
            case 3 : $subtema = "Baja California Sur"; break;
            case 4 : $subtema = "Campeche"; break;            
            case 7 : $subtema = "Chiapas"; break;   
            case 8 : $subtema = "Chihuahua"; break;
            case 5 : $subtema = "Coahuila"; break;    
            case 6 : $subtema = "Colima"; break;
            case 10 : $subtema = "Durango"; break;
            case 15 : $subtema = utf8_decode("Estado de México"); break;
            case 11 : $subtema = "Guanajuato"; break;
            case 12 : $subtema = "Guerrero"; break;
            case 13 : $subtema = "Hidalgo"; break;
            case 14 : $subtema = "Jalisco"; break;
            case 16 : $subtema = utf8_decode( "Michoacán"); break;
            case 17 : $subtema = "Morelos"; break;
            case 18 : $subtema = "Nayarit"; break;
            case 19 : $subtema = utf8_decode("Nuevo León"); break;
            case 20 : $subtema = "Oaxaca"; break;
            case 21 : $subtema = "Puebla"; break;
            case 22 : $subtema = utf8_decode("Querétaro"); break;
            case 23 : $subtema = "Quintana Roo"; break;
            case 24 : $subtema = utf8_decode("San Luis Potosí"); break;
            case 25 : $subtema = "Sinaloa"; break;
            case 26 : $subtema = "Sonora"; break;
            case 27 : $subtema = "Tabasco"; break;
            case 28 : $subtema = "Tamaulipas"; break;
            case 29 : $subtema = "Tlaxcala"; break;
            case 30 : $subtema = "Veracruz"; break;
            case 31 : $subtema = utf8_decode( "Yucatán" ); break;
            case 32 : $subtema = "Zacatecas"; break;
            
        }

      if( !empty($subtema) )
      {
        
        /*
        echo "********************";
        print_r( $query );
        echo "**********FIN**********";
        */    

        ArmaPdf($query,$tema,$subtema, $fecha);

        sleep(2);  
      }
  }



function ArmaPdf($query,$tema,$subtema, $fecha){  

    require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
    require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
     
    $pdf = new FPDI('P','mm','legal');

    require "/var/www/external/services/mail/conexion.php";
        
    
    $antigua = umask(0);
    if(is_dir("/var/www/external/testigos/Presidencia/".$fecha."/")){
    }
    else{
        mkdir("/var/www/external/testigos/Presidencia/".$fecha,0777,true);
        chmod("/var/www/external/testigos/Presidencia/".$fecha,0777);
        umask($antigua);
    }     


    $data =  mysql_query($query);

    if(mysql_affected_rows()>0)
    {
        $i=0;//Contador de Paginas
        $periodico=array();
        $seccion=array();
        $estados=array();
        $j=0;
        while ($row = mysql_fetch_array($data)){
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['Periodico'];
              $seccion[$i] = $row['seccion'];
              $estados[$i] = $row['Estado'];
            $i++;
        }


        
      
        $pdf->addPage();
                    //Recuadro Gris Inferior
                    $pdf->SetFillColor(245,245,245);
                    $pdf->Rect(0, 131, 250, 40, 'F');
                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,146,$tema);
                      $pdf->Text(10,160,$subtema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");

                      $pdf->Image('/var/www/external/services/mail/presidencia/Logo.png',5,100,100); 

                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa( $fecha ) );  

        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j]))
                {
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                      $pdf->Rect(0, 0, 250, 18, 'F');


                      //rentangulo Azul
                      $pdf->SetFillColor(0, 191, 255);
                      $pdf->Rect(0, 10, 155, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 18);
                      $pdf->Text(10,18,$estados[$j]." | ".strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->Text(181,8,$tema);
                       $pdf->Image('/var/www/external/services/mail/presidencia/Logo.png',5,340,30); 
                      $pdf->SetFont("arial", "B",11);
                      $pdf->setTextColor();
                      $pdf->Text(154,13,mostrar_fecha_completa( $fecha ));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }
                else{
                  /*
                    $pdf->addPage();
                    $pdf->setTextColor();
                    $pdf->SetFont("arial", "B", 10);
                    $pdf->Text(10,156,"No se Encontro : ".$variable[$j]);
                    */
                }  
          }
        

        $nombre = "/var/www/external/testigos/Presidencia/".$fecha."/".quita_acentos( $subtema)."_Reporte_Presidencia.pdf";
        $pdf->Output($nombre, 'F'); 

        //echo "tema ".$subtema." ". $i;

    }else{
        
        echo "<script>alert('No se encuentran Resultados de ".quita_acentos($tema)."$subtema');</script>";
        
        echo  "<br><br>" .mysql_error();
    }
    $periodico=array();
    $seccion=array();
    $estados=array();
    //mysql_close();

}


function quita_acentos($string)
{
  $string = utf8_encode($string);

    $string = str_replace(
        array('á','é','í','ó','ú'),
        array('a','e','i','o','u'),
        $string
    );
    return $string;
 
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
};

?>