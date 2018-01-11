    <?php

    include "/var/www/external/services/mail/querysJalisco_DF.php";
    include "/var/www/external/services/mail/conexion.php";
    

    Consulta();
    
function Consulta()
{
  require_once('/var/www/external/services/mail/fpdf17/fpdf.php');
  require_once('/var/www/external/services/mail/FPDI-1.4.4/fpdi.php');

  $pdf = new FPDI('P','mm','legal');

  $pdfs = array();

  $query = "SELECT DISTINCT
    (CONCAT('/var/www/Sistema-de-Captura/Periodicos/',
            p.Nombre,
            '/',
            n.Fecha,
            '/',
            NumeroPagina)) AS 'pdf',
    n.Periodico AS idPeriodico,
    n.idEditorial,
    n.Titulo,
    p.Nombre AS Periodico,
    e.Nombre AS estado,
    n.Fecha,
    n.PaginaPeriodico,
    n.Autor,
    n.Texto,
    CONCAT('/Periodicos/',
            p.Nombre,
            '/',
            n.Fecha,
            '/',
            NumeroPagina) AS 'jpg'
FROM
    (SELECT 
        Periodico,
            idEditorial,
            Titulo,
            Fecha,
            PaginaPeriodico,
            Seccion,
            Categoria,
            Autor,
            Texto,
            NumeroPagina,
            Encabezado,
            PieFoto,
            Activo
    FROM
        noticiasDia
    WHERE
        Fecha BETWEEN '2015-01-01' AND CURDATE() UNION ALL SELECT 
        Periodico,
            idEditorial,
            Titulo,
            Fecha,
            PaginaPeriodico,
            Seccion,
            Categoria,
            Autor,
            Texto,
            NumeroPagina,
            Encabezado,
            PieFoto,
            Activo
    FROM
        noticiasSemana
    WHERE
        Fecha BETWEEN '2015-01-01' AND CURDATE() UNION ALL SELECT 
        Periodico,
            idEditorial,
            Titulo,
            Fecha,
            PaginaPeriodico,
            Seccion,
            Categoria,
            Autor,
            Texto,
            NumeroPagina,
            Encabezado,
            PieFoto,
            Activo
    FROM
        noticiasMensual
    WHERE
        Fecha BETWEEN '2015-01-01' AND CURDATE() UNION ALL SELECT 
        Periodico,
            idEditorial,
            Titulo,
            Fecha,
            PaginaPeriodico,
            Seccion,
            Categoria,
            Autor,
            Texto,
            NumeroPagina,
            Encabezado,
            PieFoto,
            Activo
    FROM
        noticiasAnual
    WHERE
        Fecha BETWEEN '2015-01-01' AND CURDATE()) n,
    periodicos p,
    seccionesPeriodicos s,
    categoriasPeriodicos c,
    estados e
WHERE
    p.idPeriodico = n.Periodico
        AND s.idSeccion = n.Seccion
        AND p.idPeriodico = 57
        AND c.idCategoria = n.Categoria
        AND c.idCategoria IN (3)
        AND e.idEstado = p.Estado
        AND Fecha BETWEEN DATE('2015-01-01') AND CURDATE()
ORDER BY Fecha";

  $result = mysql_query($query);

  while($row = mysql_fetch_array($result))
  {
    if(!in_array($row['pdf'], $pdfs))
    {
      $pdfs[] = $row['pdf'];  
    }
    
  }

    /*

        $portada = '/var/www/external/testigos/Jalisco/'.mes($fecha).'/portada/portada.pdf';
        $sintesis = '/var/www/external/services/clientesPDF/jalisco/Gobernador.pdf';
        
      
        $pdfs[0]="/var/www/Sistema-de-Captura/Periodicos/Critica/2014-12-29/15_A.pdf";
        $pdfs[1]="/var/www/Sistema-de-Captura/Periodicos/El milenio Guadalajara/2015-01-02/14_A.pdf";
        $pdfs[2]="/var/www/Sistema-de-Captura/Periodicos/Pagina veinticuatro/2015-01-02/3_A.pdf";
        $pdfs[3]="/var/www/Sistema-de-Captura/Periodicos/El Informador/2015-01-05/A_4.pdf";
        $pdfs[4]="/var/www/Sistema-de-Captura/Periodicos/La Cronica Jalisco/2015-01-05/3_A.pdf";
        $pdfs[5]="/var/www/Sistema-de-Captura/Periodicos/El Mural/2015-01-07/A_6.pdf";
        $pdfs[6]="/var/www/Sistema-de-Captura/Periodicos/El Informador/2015-01-08/A_4.pdf";
        $pdfs[7]="/var/www/Sistema-de-Captura/Periodicos/El milenio Guadalajara/2015-01-08/16_A.pdf";
        $pdfs[8]="/var/www/Sistema-de-Captura/Periodicos/El Occidental/2015-01-08/11_A.pdf";
        $pdfs[9]="/var/www/Sistema-de-Captura/Periodicos/Conciencia Publica/2015-01-11/27_A.pdf";
        $pdfs[10]="/var/www/Sistema-de-Captura/Periodicos/Conciencia Publica/2015-01-11/26_A.pdf";
        $pdfs[11]="/var/www/Sistema-de-Captura/Periodicos/El Mural/2015-01-12/A_6.pdf";
        $pdfs[12]="/var/www/Sistema-de-Captura/Periodicos/El milenio Guadalajara/2015-01-12/3_A.pdf";
        $pdfs[13]="/var/www/Sistema-de-Captura/Periodicos/El milenio Guadalajara/2015-01-13/40_A.pdf";
        $pdfs[14]="/var/www/Sistema-de-Captura/Periodicos/El milenio Guadalajara/2015-01-13/3_A.pdf";
        $pdfs[15]="/var/www/Sistema-de-Captura/Periodicos/El milenio Guadalajara/2015-01-14/16_A.pdf";
        $pdfs[16]="/var/www/Sistema-de-Captura/Periodicos/Pagina veinticuatro/2015-01-14/2_A.pdf";
        $pdfs[17]="/var/www/Sistema-de-Captura/Periodicos/La Jornada Jalisco/2015-01-15/2_A.pdf";
        $pdfs[18]="/var/www/Sistema-de-Captura/Periodicos/El Mural/2015-01-15/A_6.pdf";
        $pdfs[19]="/var/www/Sistema-de-Captura/Periodicos/El milenio Guadalajara/2015-01-16/3_A.pdf";
        $pdfs[20]="/var/www/Sistema-de-Captura/Periodicos/Meridiano de Vallarta/2015-01-19/A_24.pdf";
        $pdfs[21]="/var/www/Sistema-de-Captura/Periodicos/Meridiano de Vallarta/2015-01-20/2_A.pdf";
        $pdfs[22]="/var/www/Sistema-de-Captura/Periodicos/Critica/2015-01-26/14_A.pdf";
        $pdfs[23]="/var/www/Sistema-de-Captura/Periodicos/El Mural/2015-01-26/A_7.pdf";
        $pdfs[24]="/var/www/Sistema-de-Captura/Periodicos/Pagina veinticuatro/2015-01-29/3_A.pdf";
        $pdfs[25]="/var/www/Sistema-de-Captura/Periodicos/Critica/2015-03-02/11_A.pdf";
        $pdfs[26]="/var/www/Sistema-de-Captura/Periodicos/El Mural/2015-02-17/COM_2.pdf";
        $pdfs[27]="/var/www/Sistema-de-Captura/Periodicos/El Mural/2015-02-24/COM_3.pdf";
        $pdfs[28]="/var/www/Sistema-de-Captura/Periodicos/El Occidental/2015-02-06/5_A.pdf";
        $pdfs[29]="/var/www/Sistema-de-Captura/Periodicos/El milenio Guadalajara/2015-02-28/13_A.pdf";
    */
        
      //  print_r( $pdfs ) ;
      if( !empty($pdfs) ){

        $pdf->setFiles( $pdfs );  
        $pdf->concat();

        /*$antigua = umask(0);
        if(is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha."/")){
        }
        else{
            mkdir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha,true,0777);
            chmod("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha,0777);
            umask($antigua);
        }
        $nombre="/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha."/MC.pdf";
        if(is_dir("/var/www/external/testigos/Jalisco/".strtolower(mes($fecha))."/".$fecha))
        {
            $pdf->Output($nombre, 'F');
        }else{
            
            echo "Error echo echo echo  Escritura<br>".__DIR__;
        } 
  */
        $pdf->Output("/var/www/external/testigos/Jalisco/PortadasMilenioGDL.pdf", 'F');
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
