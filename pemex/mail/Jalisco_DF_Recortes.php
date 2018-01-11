    <?php

    include "/var/www/external/services/mail/querysJalisco_DF.php";
    include "/var/www/external/services/mail/conexion.php";
    
   $fecha = DATE('Y-m-d');

  portada($fecha);
  //sleep(1);

    $valor=1;
    $query=query(1,$fecha);

    
     /*
    switch ($valor) {
        case 1: // PRIMERAS PLANAS
             Cuenta($query,$fecha);
            break;
                }
                
                */
    Cuenta($query,$fecha);


function Cuenta($consulta,$fecha)
{
    $query = mysql_query($consulta);
    $paginas = mysql_fetch_row($query);
    for($i=1;$i<=$paginas[0];$i++)
    {
        Consulta($i,$fecha);
    }
}

function Consulta($seccion,$fecha)
{
    require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
    require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

    $pdf = new FPDI('P','mm','legal');

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
    
    if( isset($limit1) && isset($limit2) )
    {
        $consu = query(2,$fecha,$limit1,$limit2);
    }
    else{
        echo "No definidas las variables limites";
    }
        
    $portada = '/var/www/external/testigos/Jalisco/'.mes($fecha).'/portada/portada.pdf';
    $sintesis = '/var/www/external/services/clientesPDF/jalisco/Gobernador.pdf';
    $pdfs = array();
        

    $i=1;
    $query1 =  mysql_query($consu);
    while ($row = mysql_fetch_array($query1)) 
    {
        $id=$row['idEditorial'];
        $pagina[$i]=$row['PaginaPeriodico'];
        $variable[$i] = $row['pdf'];
        $periodico[$i] = $row['Periodico'];
        $secciones[$i] = $row['Seccion'];
        $titulos[$i]= $row['Titulo'];
        $textos[$i]= $row['Texto'];
        $thumb[$i]=$row['jpg'];
        $pdf->addPage();
        $pdf->Ln();
        $pdf->SetFont("arial", "B", 11);
        
        $pdf->setTextColor(0);
        if(file_exists('/var/www/Imagenes/periodicos/portadas/'.ucwords($periodico[$i]).".png")){
            $pdf->Image('/var/www/Imagenes/periodicos/portadas/'.ucwords($periodico[$i]).".png",70,10,60); 
        }else{
            $pdf->Text(60, 10, $periodico[$i]);
        }
        
        $pdf->Ln(2);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->Cell(200, 5,"",0, 1, 'L', false);
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(200, 5,"Fecha : ". utf8_decode(mostrar_fecha_completa($fecha))." |     Seccion : ".$secciones[$i]."     |      Pagina : ".$pagina[$i],1, 1, 'L', true);
        //$pdf->Cell(200, 5,"Periodico : ".$periodico[0],0, 1, 'L', true);
        $pdf->SetFillColor(255);
        
        if(file_exists('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg")){
            
            $pathImg='/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg";
            $tam=  getimagesize($pathImg);
            $ancho=$tam[0];
            $alto=$tam[1];
            
            if($ancho>$alto){
                $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg",25,65,170,100);      
            }else if($ancho<$alto){
                $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg",50,45,110,300);
            }
            else{
                $pdf->Image('/var/www/siscap.la/public/img/cuts/'.$id."_cut.jpg",6,45,$ancho,$alto);      
            }
        }else{
            $pdf->Text(5, 65, "Error: ".$id." ".$periodico." ".$titulos[$i]);
        }
        if(file_exists($thumb[$i]))
        {
            $pdf->Image($thumb[$i],170,270,30);
        }else{
            $pdf->Text(5, 65, "Error: ".$thumb[$i]);
        }    
        $pdf->Image('jalisco/Logo.jpg',5,330,45);
        //$pdf->Image('jalisco/Logo.jpg',150,330,50);
        
        $i++;
    }
    
    $pdf->Output("JALISCO.pdf", 'I');   
    /*
     
     
        $antigua = umask(0);
        if(is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha."/")){
        }
        else{
            mkdir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha,true,0777);
            chmod("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha,0777);
            umask($antigua);
        }
        $nombre="/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha."/".$fecha." DF_SECCION ".$seccion.".pdf";
        if(is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha))
        {
            $pdf->Output($nombre, 'F');
        }else{
            
            echo "Error echo echo echo  Escritura<br>".__DIR__;
        } 
   
     
     
     
     */

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
