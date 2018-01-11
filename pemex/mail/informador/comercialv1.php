<?php
require '../../php/conexion.php';

$queryTotal="SELECT c.Periodico, COUNT(c.Periodico) as 'Total' 
FROM comercialdia c, periodicos p
WHERE
p.Nombre=c.Periodico AND
p.estado='Jalisco'
GROUP BY c.Periodico
ORDER BY Total DESC";

$queryPeriodicoColor="SELECT c.Periodico,c.Color,COUNT(c.Periodico) as 'Total' 
FROM comercialdia c, periodicos p
WHERE 
p.Nombre=c.Periodico AND
p.estado='Jalisco' AND c.color like 'Color'
GROUP BY c.Periodico,c.Color
ORDER BY c.Periodico,c.Color,Total DESC";

$queryPeriodicoByN="SELECT c.Periodico,c.Color,COUNT(c.Periodico) as 'Total' 
FROM comercialdia c, periodicos p
WHERE 
p.Nombre=c.Periodico AND
p.estado='Jalisco' AND c.color not like 'Color'
GROUP BY c.Periodico,c.Color
ORDER BY c.Periodico,c.Color,Total DESC";

$queryPeriodicoEsquelas="SELECT c.Periodico,c.Categoria,COUNT(c.Periodico) as 'Total' 
FROM comercialdia c, periodicos p
WHERE 
p.Nombre=c.Periodico AND
p.estado='Jalisco' AND c.Categoria like 'Esquelas y Condolencias'
GROUP BY c.Periodico,c.Color
ORDER BY c.Periodico,c.Color,Total DESC";


$result1=  mysql_query($queryTotal);
$result2=  mysql_query($queryPeriodicoColor);
$result3=  mysql_query($queryPeriodicoByN);
$result4=  mysql_query($queryPeriodicoEsquelas);

$mensaje="<style>body{font-family: Century gothic;
font-size: 10px;}tr {
border-bottom: 1pt solid black;
}</style><table width='500px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td colspan='3'><img src='http://200.53.59.226/services/APP/lib/informador/logo.png' style='width:400px;'></td>
  </tr>
 <tr>
  <td colspan='2' align='right' style='font-weight: bold;'>".mostrar_fecha_completa(DATE('Y-m-d'))."</td>
</tr>
<tr>
<td colspan='2' align='center' style='font-weight: bold;'>TOTAL DE ANUNCIOS </td>
</tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>";

while ($row = mysql_fetch_array($result1))
{
    $mensaje.="<tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode($row['Periodico'])."</td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'>".$row['Total']."</td>
    </tr>";
}
$mensaje.="<tr>
  <td colspan='2' align='center' style='font-weight: bold;'>ANUNCIOS DE COLOR </td>
</tr>";
while ($row = mysql_fetch_array($result2))
{
    $mensaje.="<tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode($row['Periodico'])."</td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'>".$row['Total']."</td>
    </tr>";
}

$mensaje.="<tr>
  <td colspan='2' align='center' style='font-weight: bold;'>ANUNCIOS BLANCO Y NEGRO</td>
</tr>";
while ($row = mysql_fetch_array($result3))
{
    $mensaje.="<tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode($row['Periodico'])."</td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'>".$row['Total']."</td>
    </tr>";
}
$mensaje.="<tr>
  <td colspan='2' align='center' style='font-weight: bold;'>ESQUELAS Y CONDOLENCIAS</td>
</tr>";
while ($row = mysql_fetch_array($result4))
{
    $mensaje.="<tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode($row['Periodico'])."</td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'>".$row['Total']."</td>
    </tr>";
}
//


require '../../php/conexion.php';$marcas="";$uno="";$sub="";
$query="SELECT DISTINCT(marca) as marcasbase FROM comercialdia  Where periodico in('El informador')";
$data=  mysql_query($query);
if(mysql_affected_rows()>0){
$marcasbase="";     
    while ($row = mysql_fetch_array($data)) {
        $marcasbase.="'".$row['marcasbase']."',";
        $marcas.=" ".$row['marcasbase'].",";
    }
     $uno="El informador ";$a=mysql_affected_rows();
    $row['nombre']." - ".  mysql_affected_rows()." ".$marcas."<br>";
    $sub=$marcasbase = substr($marcasbase, 0, -1);  
 
        $query="";$data="";$row="";$marcas="";$dos="";$Dossub="";
        $query="SELECT 'el Occidental' as nombre,marca FROM comercialdia   Where periodico ='el Occidental'  AND marca not in($marcasbase)";
        $data=  mysql_query($query); 
        if(mysql_affected_rows()>0){
            while ($row = mysql_fetch_array($data)) {
                $marcas.=" ".$row['marca'].",";
            }
            $b=mysql_affected_rows();
            $dos= "El Occidental ";
            $Dossub= " ".$marcas."<br>";
        }else{
            
        }
        
        $query="";$data="";$row=""; $tres=""; $subTres="";$marcas="";
        $query="SELECT 'El Mural' as nombre,marca,count(1) as veces FROM comercialdia   Where periodico ='El Mural'  AND marca not in($marcasbase)";
        $data=  mysql_query($query); 
        if(mysql_affected_rows()>0){
            while ($row = mysql_fetch_array($data)) {
                //echo $row['nombre']." - ".$row['veces']."<br>";
                $marcas.=" ".$row['marca'].",";
                
            }
            $tres= "El Mural "; $c=mysql_affected_rows();
            $subTres=" ".$marcas."<br>";
        }else{
            
        }

        $query="";$data="";$row="";$cuatro=""; $subcuatro="";$marcas="";
        $query="SELECT 'El Milenio Guadalajara' as nombre,marca,count(1) as veces FROM comercialdia   Where periodico ='El Milenio Guadalajara'  AND marca not in($marcasbase)";
        $data=  mysql_query($query); 
        if(mysql_affected_rows()>0){
            while ($row = mysql_fetch_array($data)) {
                //echo $row['nombre']." - ".$row['veces']."<br>";
                 $marcas.=" ".$row['marca'].",";
            }
            $cuatro= "El Milenio Guadalajara ";$d=mysql_affected_rows();
            $subcuatro=" ".$marcas."<br>";
        }else{
            
        }  
        
        $query="";$data="";$row="";$cinco=""; $subcinco="";$marcas="";
        $query="SELECT 'La Jornada Jalisco' as nombre,marca,count(1) as veces FROM comercialdia   Where periodico ='La Jornada Jalisco'  AND marca not in($marcasbase)";
        $data=  mysql_query($query); 
        if(mysql_affected_rows()>0){
            while ($row = mysql_fetch_array($data)) {
                //echo $row['nombre']." - ".$row['veces']."<br>";
                  $marcas.=" ".$row['marca'].",";
            }
            $cinco= "La Jornada Jalisco ";$e=mysql_affected_rows();
            $subcinco=" ".$marcas."<br>";
        }else{
            
        }    
        
        $query="";$data="";$row="";$seis=""; $subseis="";$marcas="";
         $query="SELECT 'Publimetro Guadalajara' as nombre,marca,count(1) as veces FROM comercialdia   Where periodico ='Publimetro Guadalajara'  AND marca not in($marcasbase)";
        $data=  mysql_query($query); 
        if(mysql_affected_rows()>0){
            while ($row = mysql_fetch_array($data)) {
                //echo $row['nombre']." - ".$row['veces']."<br>";
                 $marcas.=" ".$row['marca'].",";
            }
            $seis= "Publimetro Guadalajara ";$f=mysql_affected_rows();
            $subseis=" ".$marcas."<br>";
        }else{
            
        }         
}else{
    
}

 
 $tabla="<tr>
        <td colspan='2' align='center' style='font-weight: bold;'>COMPARATIVA</td>
      </tr>
      <tr  >"
                . "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$uno</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$a</td>
            </tr>
            <tr  >
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$sub </td>
            </tr>
            
            <tr>
                <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$dos</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$b</td>
            </tr>
            <tr  >
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$Dossub </td>
            </tr>
            <tr>
                <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$tres</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$c</td>
            </tr>
            <tr  >
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$subTres </td>
            </tr>
            
            <tr>
                <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$cuatro</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$d</td>
            </tr>
            <tr  >
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$subcuatro </td>
            </tr>

            <tr>
                <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$cinco</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$e</td>
            </tr>
            <tr  >
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$subcinco </td>
            </tr>

            <tr>
                <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$seis</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$f</td>
            </tr>
            <tr  >
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$subseis </td>
            </tr> ";


//
       
//echo $mensaje.$tabla;
correo($mensaje.$tabla);

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

    $mail->AddBCC('salomon.correa@informador.com.mx');

    //$mail->AddBCC('tony@admedios.com');
    $mail->AddBCC('ruben.diaz@admedios.com');
    $mail->AddBCC('admedios@admedios.com');
    //$mail->AddBCC('info@admedios.com');
    $mail->AddBCC('dan.padilla@admedios.com');
    $mail->AddBCC('editorial@admonitor.mx');
    $mail->AddBCC('validacion@admonitor.mx');
    $mail->AddBCC('validacion.admonitor@gmail.com');
    $mail->AddBCC('comercial@admonitor.mx');
    $mail->AddBCC('jetsuken@gmail.com');
    $mail->AddBCC('ehb1703@admedios.com');

    $mail->FromName = "ANALISIS DE PRENSA ";

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

?>
