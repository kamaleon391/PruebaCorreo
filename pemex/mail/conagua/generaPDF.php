<?php
include '/var/www/external/services/mail/conagua/querysConagua2.php';

/*
for ($a=12; $a <= 5; $a++) 
{ 
  
  $f = ( strlen($a) < 2 )?'0'.$a : $a;

  //echo "<br>" . $f;
  $fecha = '2014-11-'.$f;
*/
 
  $fecha = '2014-11-12';
    

  $estados = array(1,2,3,4,5,6,7,8,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32);
  //$estados = array(10);

  foreach($estados as $estado)
  {
      if( $estado == 14  )
      {

        for($opcion = 1; $opcion <= 4; $opcion++)
        { 
            
            $query = query(5,$fecha,$estado,$opcion);
            $tema="CONAGUA";
            ArmaPdfConagua($query,$tema,$fecha,$opcion);           
        } 

      }else{

        $query = query(5,$fecha,$estado,$opcion = '');
        $tema="CONAGUA";
        ArmaPdfConagua($query,$tema,$fecha);
      }  
  }


  $query = query(1,$fecha,$estado,$opcion = '');
  $tema="";$subtema="PRIMERAS PLANAS";   
  ArmaPdf($query,$tema,$subtema,$fecha);

  $query = query(2,$fecha,$estado,$opcion = '');
  $tema=" ";$subtema="COLUMNAS POLITICAS";
  ArmaPdfColumnas($query,$tema,$subtema,$fecha);
   
  $query = query(3,$fecha,$estado,$opcion = '');
  $tema="";$subtema="COLUMNAS FINANCIERAS";
  ArmaPdfColumnas($query,$tema,$subtema,$fecha);

  $query = query(4,$fecha,$estado,$opcion = '');
  $tema="";$subtema="CARTONES";
  ArmaPdfColumnas($query,$tema,$subtema,$fecha);


//}


function ArmaPdf($query,$tema,$subtema,$fecha){  
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
 
$pdf = new FPDI('P','mm','legal');
require "/var/www/external/services/mail/conexion.php";
    
    
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$j=0;
        while ($row = mysql_fetch_array($data)) {
             $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['periodico'];
              $seccion[$i] = $row['Seccion'];
            $i++;
        }
        $pdf->addPage();
        //Recuadro Gris Inferior
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 131, 250, 40, 'F');
          $pdf->setTextColor();
          $pdf->SetFont("arial", "B", 25);
          $pdf->Text(10,146,$subtema);
          $pdf->SetFont("arial", "B", 13);
          $pdf->setTextColor(255,255,255);
          //$pdf->Text(10,23,"test");

          $pdf->Image('/var/www/external/services/mail/conagua/coangua.jpg',5,100,100); 
          $pdf->SetFont("arial", "B",15);
          $pdf->setTextColor();
          $pdf->Text(130,177,mostrar_fecha_completa($fecha));
                      
        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j])){
                      $pageCount = $pdf->setSourceFile($variable[$j]);
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
                      $pdf->Text(10,18,strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$tema);
                       $pdf->Image('/var/www/external/services/mail/conagua/coangua.jpg',5,340,30); 
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);  
         */
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(182,13,$fecha);   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }
             }


        $antigua = umask(0);

        if(!is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
            mkdir("/var/www/external/testigos/Conagua/".$fecha,true,0777);
            chmod("/var/www/external/testigos/Conagua/".$fecha,0777);
            umask($antigua);
        }

        if(is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
          
          $nombre = "/var/www/external/testigos/Conagua/".$fecha."/".quita_acentos($subtema)."_".$fecha.".pdf";        
          $pdf->Output($nombre, 'F');       
        }

    }else{
       echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
    }
    

}

function ArmaPdfColumnas($query,$tema,$subtema,$fecha){  
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
 
    $pdf = new FPDI('P','mm','legal');
    
    require "/var/www/external/services/mail/conexion.php";
    
    $data=  mysql_query($query);
    if(mysql_affected_rows()>0){
         $i=0; $periodico=array();  $seccion=array(); $j=0;
            while ($row = mysql_fetch_array($data)) {
                 $variable[$i] = $row['pdf'];
                  $periodico[$i] = $row['periodico'];
                  $seccion[$i] = substr($row['Titulo'], 0, 45);
                $i++;
            }
            $pdf->addPage();
                    //Recuadro Gris Inferior
                    $pdf->SetFillColor(245,245,245);
                    $pdf->Rect(0, 131, 250, 40, 'F');
                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,146,$subtema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");

                      $pdf->Image('/var/www/external/services/mail/conagua/coangua.jpg',5,100,100); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa($fecha));
                      
            for($j=0;$j<sizeof($periodico);$j++){
               if(file_exists($variable[$j])){
                     $pageCount = $pdf->setSourceFile($variable[$j]);
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
                     $pdf->Text(10,18,strtoupper($periodico[$j]));
                     $pdf->SetFont("arial", "B", 13);
                     $pdf->setTextColor(255,255,255);
                     $pdf->Text(10,23,strtoupper($seccion[$j]));
                     $pdf->SetFont("arial", "B", 9);
                     $pdf->setTextColor(128);
                     $pdf->Text(150,8,$tema);
                     $pdf->SetFont("arial", "", 9);
                     $pdf->setTextColor();
                     $pdf->Text(170,8,$subtema);  
                     $pdf->SetFont("arial", "B",12);
                     $pdf->setTextColor();
                     $pdf->Text(182,13,$fecha);  
                     $pdf->Image('/var/www/external/services/mail/conagua/coangua.jpg',5,340,30); 
                     
                     $pdf->useTemplate($tplIdx, 20,30,160);
                 }
                }

        $antigua = umask(0);

        if(!is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
            mkdir("/var/www/external/testigos/Conagua/".$fecha,true,0777);
            chmod("/var/www/external/testigos/Conagua/".$fecha,0777);
            umask($antigua);
        }

        if(is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
          
          $nombre = "/var/www/external/testigos/Conagua/".$fecha."/".quita_acentos($subtema)."_".$fecha.".pdf";        
          $pdf->Output($nombre, 'F');       
        }  


    }else{
      /* 
       $pdf->addPage();
                      //rectangulo GRis
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 0, 250, 50, 'F'); 
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 30);
        $pdf->Text(10,180,strtoupper("NO SE ENCONTRARON RESULTADOS"));
        $pdf->Image('salud/logopdf.png',5,10,80);
        $pdf->Output(utf8_decode($tema).$subtema.".pdf", 'D');   */
        
        echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."$subtema');</script>";
    }
    

}

function ArmaPdfConagua($query,$tema,$fecha,$opcion=''){  
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');
 
  $pdf = new FPDI('P','mm','legal');
  require "/var/www/external/services/mail/conexion.php";
    
    $subtema = '';
     $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0; $periodico=array();  $seccion=array();$Estado=array();$j=0;
        while ($row = mysql_fetch_array($data)) {
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['Periodico'];
              $seccion[$i] = $row['Seccion'];
              $tem[$i]=$row['Tema'];
              $Estado[$i]=$row['estado'];
            $i++;
        } 

        $subtema = $Estado[0];

        $pdf->addPage();
                    //Recuadro Gris Inferior
                    $pdf->SetFillColor(245,245,245);
                    $pdf->Rect(0, 131, 250, 40, 'F');
                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,146,$tema);
                      $pdf->Text(10,160,$Estado[0]);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      //$pdf->Text(10,23,"test");

                      $pdf->Image('/var/www/external/services/mail/conagua/coangua.jpg',5,100,100); 
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa($fecha));
        
        for($j=0;$j<sizeof($periodico);$j++){
                if(file_exists($variable[$j])){
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 0, 250, 18, 'F');


                      //rentangulo Azul
                      $pdf->SetFillColor(0, 191, 255);
                      $pdf->Rect(0, 10, 145, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 20);
                      $pdf->Text(5,18,$Estado[0]."|");
                      $pdf->SetFont("arial", "B", 18);
                      $pdf->Text(60,18,strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(5,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->Text(150,7,"Tema : ".$tem[$j]);
                      $pdf->Text(150,12,"Estado : ".$Estado[0]);
                       $pdf->Image('/var/www/external/services/mail/conagua/coangua.jpg',5,340,30);
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(150,17,mostrar_fecha_completa($fecha));   
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }
             }

        $antigua = umask(0);

        if(!is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
            mkdir("/var/www/external/testigos/Conagua/".$fecha,true,0777);
            chmod("/var/www/external/testigos/Conagua/".$fecha,0777);
            umask($antigua);
        }

        if(is_dir("/var/www/external/testigos/Conagua/".$fecha."/")){
          
          $opc = ( !empty($opcion) )? "_".$opcion : ''; 
          $nombre = "/var/www/external/testigos/Conagua/".$fecha."/".quita_acentos($subtema)."_".date('Y-m-d').".pdf";        
          $pdf->Output($nombre, 'F');       
        }    


    }else{
        
        //echo "Sin Resultados:  ".$query;
        echo "<script>alert('No se encuentran Resultados de ".utf8_decode($tema)."');</script>";
    }
    

}

function quita_acentos($string)
{
  $string = utf8_encode(trim($string));

  $string = strtolower( $string );

    $string = str_replace(
        array('á','é','í','ó','ú','Á','É','Í','Ó','Ú',' '),
        array('a','e','i','o','u','a','e','i','o','u','_'),
        $string
    );
    return str_replace( array(" ","."),array("_",""), $string );
 
}

function mostrar_fecha_completa($fecha){
    $subfecha=split("-",$fecha); 
   for($i=0;$subfecha[$i];$i++); 
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