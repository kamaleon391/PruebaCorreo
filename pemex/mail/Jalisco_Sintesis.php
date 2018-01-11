    <?php

    include "/var/www/external/services/mail/querysJalisco_Sintesis.php";
    include "/var/www/external/services/mail/conexion.php";

    $fecha = DATE('Y-m-d');

    portada($fecha);

    $valor=1;
    $query=query(1,$fecha);

    Cuenta($query,$fecha);


function Cuenta($consulta,$fecha)
{
  //echo "Entro a Cuenta : ".$consulta."<br>";
    $query = mysql_query($consulta);
    $paginas = mysql_fetch_row($query);
    //echo "PAginas : ".$paginas;

    for($i=1;$i<=$paginas[0];$i++)
    {
        //echo "<br>".$i;
        Consulta($i,$fecha);
    }
}

function Consulta($seccion,$fecha)
{
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  //echo "<br>Entro a Consulta<br>";
  //$pdf = new FPDI('P','mm','legal');
  $pdf = new FPDI('P','mm','A4');

    if($seccion==1)
    {
        $limit1=0;
        $limit2=20;
    }    
    else if($seccion==2)
    {
        $limit1=21;
        $limit2=20;
    }    
    else if($seccion==3)
    {
        $limit1=42;
        $limit2=20;
    }
    else if($seccion==4)
    {
        $limit1=62;
        $limit2=20;
        
    }
    else if($seccion==5)
    {
        $limit1=82;
        $limit2=20;
        
    }
    else if($seccion==6)
    {
        $limit1=102;
        $limit2=20;
        
    }
    else if($seccion==7)
    {
        $limit1=122;
        $limit2=20;
    }
    else if($seccion==8)
    {
        $limit1=142;
        $limit2=20;
    }
    else if($seccion==9)
    {
        $limit1=162;
        $limit2=20;
    }
    else if($seccion==10)
    {
        $limit1=182;
        $limit2=20;
    }
    else if($seccion==11)
    {
        $limit1=210;
        $limit2=20;
    }
        if( isset($limit1) && isset($limit2) )
        {
            $consu = query(2,$limit1,$limit2);
        }
        else{
            echo "No definidas las variables limites";
        }
        
        //print_r( $consu );

        $portada = '/var/www/external/testigos/Jalisco/'.mes($fecha).'/portada/portada.pdf';
        $sintesis = '/var/www/external/services/clientesPDF/jalisco/Gobernador.pdf';
        $pdfs = array();
        

        $i=1;
        $query1 =  mysql_query($consu);

        //echo "Consulta : <br> ".$consu;
        while ($row = mysql_fetch_array($query1)) 
        {

            $variable[$i] = $row['pdf'];
            $periodico[$i] = $row['Periodico'];
            $secciones[$i] = $row['Seccion'];
            $titulos[$i]= $row['Titulo'];
            $textos[$i]= $row['Texto'];
            $secciones[$i]= $row['seccion'];
           

            if(file_exists( $row['pdf'])){
              // echo "Encontrado : ".$row['pdf'];
                if($i==1){
                  $pdfs[] = $portada;
                  $pdfs[] = $sintesis;
                } 

                $pdfs[$i] = $row['pdf']; 
                $i++;
            }
             //echo "Valor de la i : ".$i;

        }
        
       //print_r( $pdfs ) ;
        if( !empty($pdfs) ){

        $pdf->setFiles( $pdfs );  
        $pdf->concat();

        $antigua = umask(0);
        if(is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."_SintesisEstatal/".$fecha."/")){
        }
        else{
            mkdir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/_SintesisEstatal".$fecha,true,0777);
            chmod("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/_SintesisEstatal".$fecha,0777);
            umask($antigua);
        }
        $nombre="/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/_SintesisEstatal".$fecha."/".$fecha." Sintesis_Estatal_SECCION ".$seccion.".pdf";
        if(is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha))
        {
            $pdf->Output($nombre, 'F');
        }else{
            
            echo "Error echo echo echo  Escritura<br>".__DIR__;
        }
  
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

    if( ! is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada/")){
    
      mkdir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada",true,0777);
      chmod("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada",0777);
      umask($antigua);
    }

    $nombre = "/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada/portada.pdf";

    if(is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/portada"))
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
