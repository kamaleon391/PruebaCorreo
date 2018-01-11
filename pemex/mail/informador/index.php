<?php

$fecha=  date("Y-m-d");
$mensaje="<style>body{font-family: Century gothic;
font-size: 10px;}tr {
border-bottom: 1pt solid black;
}</style><table width='400px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;
'>
  <tr>
    <td colspan='3'><img src='http://200.53.59.226/services/APP/lib/informador/logo.png' style='width:400px;'></td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</td>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</td>
  <tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode("Portadas")."</td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226/services/APP/lib/exportInformador.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>Pagados</a></td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226/services/APP/lib/exportInformador.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>Gratuitos</a></td>
  </tr>
  <tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode("Portadas Jalisco")."</td>
    <td width='15%' style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226/services/APP/lib/exportInformador.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>Pagados</a></td>
    <td width='15%' style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226/services/APP/lib/exportInformador.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>Gratuitos</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Columnas Politicas</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226/services/APP/lib/exportInformador.php?p=".base64_encode(base64_encode('5'))."&f=$fecha'>Reporte</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Columnas Politicas Jalisco</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://200.53.59.226/services/APP/lib/exportInformador.php?p=".base64_encode(base64_encode('6'))."&f=$fecha'>Reporte 1</a></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://200.53.59.226/services/APP/lib/exportInformador.php?p=".base64_encode(base64_encode('7'))."&f=$fecha'>Reporte 2</a></td>
  </tr>
  
  <td colspan='7' style='text-align: right;'><span style='text-align: right;font-size: 8px;color: rgb(139, 139, 139);'>  Monitoreo de prensa 2014</span></td>
</td>
</table>";
//correo($mensaje);
//correo($mensaje);     
//echo  $mensaje;
writePDF($fecha);
correo($mensaje);

function correo($mensaje)
{   
    require '../../php/PHPMailer/class.phpmailer.php';

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host     = "ssl://smtp.gmail.com";
    $mail->Port     = 465;
    $mail->SMTPAuth = true;

    $mail->Username = "gaimpresos@gmail.com";
    $mail->Password = "gaimpresos01";

    //$mail->AddBCC('carlos.sandoval@informador.com.mx');

    $mail->AddBCC('carlos.sandoval@informador.com.mx');
    $mail->AddBCC('salomon.correa@informador.com.mx');

    $mail->AddBCC('tony@admedios.com');
    $mail->AddBCC('info@admedios.com');
    $mail->AddBCC("validacion.admonitor@gmail.com");
    $mail->AddBCC("editorial@admedios.com");
    $mail->AddBCC("sistemas@admedios.com");
    $mail->AddBCC("job.cg@icloud.com");

    $mail->FromName = "MONITOREO DE PRENSA ";

    $mail->Subject  = "INFORMADOR ".date("Y-m-d");  
    $mail->WordWrap = 50;
    
    $mail->IsHTML(TRUE);

     $mail->Body =($mensaje);
    if(!$mail->Send())
    {
        echo "Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Mensaje enviado";
    }
}


function mostrar_fecha_completa($fecha)
{
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



function writePDF($fecha)
{
    $path="../../../../testigos/Informador/Portadas/";
    if(is_dir($path))
    {
        $antigua=umask(0);
        $dia=DATE('Y-m-d');
        if(!is_dir($path."/".$dia))
        {
            $antigua=umask(0);
            mkdir($path."/".$dia,true,0777);
            umask($antigua);
            chmod($path."/".$dia, 0777);
            if(is_dir($path."/".$dia))
            {
                if(!is_dir($path."/".$dia."/Nacionales")&&!is_dir($path."/".$dia."/Estatales"))
                {
                    $antigua=umask(0);
                    $nacionales=$path."/".$dia."/Nacionales";
                    $estatales=$path."/".$dia."/Estatales";

                    mkdir($nacionales,true,0777);
                    chmod($nacionales, 0777);
                    umask($antigua);
                    $antigua=umask(0);
                    mkdir($estatales,true,0777);
                    chmod($estatales, 0777);
                    umask($antigua);

                }    
                /*convertir*/
                require '../../php/conexion.php';
                $sqlNacionales="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                            CONCAT('../../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                            CONCAT('../../../../testigos/Informador/Portadas/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/Nacionales/',e.Periodico,'_',e.NumeroPagina,'.jpg') AS pdfimg,
                            p.estado,
                            p.gratuito,
                            o.posicion
                            FROM editorialdia e, ordenpersonalizado o, periodicos p
                            WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                            AND e.periodico IN (SELECT periodico FROM ordenpersonalizado op) AND e.fecha='$fecha' AND
                            p.gratuito=0
                            GROUP BY e.Periodico
                            ORDER BY 9,11";
                
                $result=  mysql_query($sqlNacionales);
                while ($row = mysql_fetch_array($result))
                {
                    if(is_file($row['pdf']))
                    {
                        if(!is_file($row['pdfimg']))
                        {
                            convierte($row['pdf'], $row['pdfimg']);
                        }
                    }else{
                        echo "Error <br> ".$row['pdf']."<br>";
                    }    
                }
            $sqlJalisco="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                            CONCAT('../../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                            CONCAT('../../../../testigos/Informador/Portadas/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/Estatales/',e.Periodico,'_',e.NumeroPagina,'.jpg') AS pdfimg,
                            p.estado,
                            p.gratuito,
                            o.posicion
                            FROM editorialdia e, ordenpersonalizadoJalisco o, periodicos p
                            WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                            AND e.periodico IN (SELECT periodico FROM ordenpersonalizadoJalisco op) AND e.fecha='$fecha' AND
                            p.gratuito=0
                            order by 9,11";
                
                $result=  mysql_query($sqlJalisco);
                while ($row = mysql_fetch_array($result))
                {
                    if(is_file($row['pdf']))
                    {
                       if(!is_file($row['pdfimg']))
                        {
                            convierte($row['pdf'], $row['pdfimg']);
                        }
                    }else{
                        echo "Error <br> ".$row['pdf']."<br>";
                    }    
                }
                
            }
        }else{
            echo "Ya Existe <br>";
            if(!is_dir($path."/".$dia."/Nacionales") && !is_dir($path."/".$dia."/Estatales"))
            {
                 $antigua=umask(0);
                $nacionales=$path."/".$dia."/Nacionales";
                $estatales=$path."/".$dia."/Estatales";
                mkdir($nacionales,true,0777);
                umask($antigua);
                $antigua=umask(0);
                mkdir($estatales,true,0777);
                umask($antigua);
            }        
            require '../../php/conexion.php';
            $sqlNacionales="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                            CONCAT('../../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                            CONCAT('../../../../testigos/Informador/Portadas/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/Nacionales/',e.Periodico,'_',e.NumeroPagina,'.jpg') AS pdfimg,
                            p.estado,
                            p.gratuito,
                            o.posicion
                            FROM editorialdia e, ordenpersonalizado o, periodicos p
                            WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                            AND e.periodico IN (SELECT periodico FROM ordenpersonalizado op) AND e.fecha='$fecha' AND
                            p.gratuito=0
                            GROUP BY e.Periodico
                            ORDER BY 9,11";
                
            $result=  mysql_query($sqlNacionales);
            while ($row = mysql_fetch_array($result))
            {
                if(is_file($row['pdf']))
                {
                    if(!is_file($row['pdfimg']))
                    {
                        convierte($row['pdf'], $row['pdfimg']);
                    }
                }else{
                    echo "Error <br> ".$row['pdf']."<br>";
                }    
            }
            $sqlJalisco="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                            CONCAT('../../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,
                            CONCAT('../../../../testigos/Informador/Portadas/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/Estatales/',e.Periodico,'_',e.NumeroPagina,'.jpg') AS pdfimg,
                            p.estado,
                            p.gratuito,
                            o.posicion
                            FROM editorialdia e, ordenpersonalizadoJalisco o, periodicos p
                            WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                            AND e.periodico IN (SELECT periodico FROM ordenpersonalizadoJalisco op) AND e.fecha='$fecha' AND
                            p.gratuito=0
                            order by 9,11";
                
            $result=  mysql_query($sqlJalisco);
            while ($row = mysql_fetch_array($result))
            {
                if(is_file($row['pdf']))
                {
                   if(!is_file($row['pdfimg']))
                    {
                        convierte($row['pdf'], $row['pdfimg']);
                    }
                }else{
                    echo "Error <br> ".$row['pdf']."<br>";
                }    
            }
            //makePDFNacionales();   
        }    
    }else{
        
    }    
}

function convierte($pdf,$pdfimg)
{
    $pathORiginal=$pdf;
    $im = new imagick($pathORiginal);
    $im->setImageFormat( "jpg" );
    $im->writeimage($pdfimg);
}
?>