<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta content="es"/>
        <meta lang="es"/>
        <meta http-equiv="Content-Language" content="es">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <style>
            body{
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body>
<?php
require '../../php/conexion.php';

$queryTotal="SELECT c.Periodico, COUNT(c.Periodico) as 'Total' 
FROM comercialdia c, periodicos p
WHERE
p.Nombre=c.Periodico AND
p.estado='Jalisco'
GROUP BY c.Periodico
ORDER BY Total DESC";
$TotalAnuncios=array();
$i=0;
$resultTotal=  mysql_query($queryTotal);
while ($row = mysql_fetch_array($resultTotal))
{
    $TotalAnuncios[$i]=array(
        'Periodico'=>$row['Periodico'],
        'total'=>$row['Total']
    );
    $i++;
}

/*Anuncios*/
$queryPeriodicoColor="SELECT c.Periodico,c.Color,COUNT(c.Periodico) as 'Total' 
FROM comercialdia c, periodicos p
WHERE 
p.Nombre=c.Periodico AND
p.estado='Jalisco' AND c.color like 'Color'
GROUP BY c.Periodico,c.Color
ORDER BY c.Periodico,c.Color,Total DESC";
$AnunciosPeriodico=array();
$j=0;
$resultAnunciosColor=  mysql_query($queryPeriodicoColor);
while($row = mysql_fetch_array($resultAnunciosColor))
{
    $AnunciosPeriodico[$j]=array(
        'Periodico'=>$row['Periodico'],
        'totalC'=>$row['Total'],
        'totalBN'=>''
    );
    $j++;
}

$queryPeriodicoByN="SELECT c.Periodico,c.Color,COUNT(c.Periodico) as 'Total' 
FROM comercialdia c, periodicos p
WHERE 
p.Nombre=c.Periodico AND
p.estado='Jalisco' AND c.color not like 'Color'
GROUP BY c.Periodico,c.Color
ORDER BY c.Periodico,c.Color,Total DESC";

$resultAnunciosBN= mysql_query($queryPeriodicoByN);
$k=0;
while($row1 = mysql_fetch_array($resultAnunciosBN))
{
    if($AnunciosPeriodico[$k]['Periodico']===$row1['Periodico'])
    {
        if($row1['Total']!='0')
        {
            $AnunciosPeriodico[$k]['totalBN']=$row1['Total'];
        }
        else{
            $AnunciosPeriodico[$k]['totalBN']=0;
        }
    }
    else{$AnunciosPeriodico[$k]['totalBN']=0;}
    $k++;
}
/*fin Evaluacio  Anuncios*/

$queryPeriodicoEsquelas="SELECT c.Periodico,c.Categoria,COUNT(c.Periodico) as 'Total' 
FROM comercialdia c, periodicos p
WHERE 
p.Nombre=c.Periodico AND
p.estado='Jalisco' AND c.Categoria like 'Esquelas y Condolencias'
GROUP BY c.Periodico,c.Color
ORDER BY c.Periodico,c.Color,Total DESC";
$resultEsquelas= mysql_query($queryPeriodicoEsquelas);
$x=0;
$EsquelasPeriodico=array();
while($row2=mysql_fetch_array($resultEsquelas))
{    
    $EsquelasPeriodico[$x]=array(
        'Periodico'=>$row2['Periodico'],
        'total'=>$row2['Total']
    );
    $x++;
}


$mensaje="<style>body{font-family: Century gothic;
font-size: 10px;}tr {
border-bottom: 1pt solid black;
}</style><table width='500px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td colspan='3'><img src='http://200.53.59.226/services/APP/lib/informador/logo.png' style='width:400px;'></td>
  </tr>
 <tr>
  <td colspan='3' align='right' style='font-weight: bold;'>".mostrar_fecha_completa(DATE('Y-m-d'))."</td>
</tr>
<tr>
<td colspan='3' align='center' style='font-weight: bold;'>TOTAL DE ANUNCIOS </td>
</tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>";
foreach ($TotalAnuncios as $value)
{
    $mensaje.="<tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode($value['Periodico'])."</td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'>".$value['total']."</td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'></td>
    </tr>";
}
$mensaje.="<tr>
    <td align='center' style='font-weight: bold;'>ANUNCIOS</td>
  <td colspan='1' align='center' style='font-weight: bold;'>COLOR </td>
  <td colspan='1' align='center' style='font-weight: bold;'>B&N </td>
</tr>";

foreach ($AnunciosPeriodico as $value)
{
    $mensaje.="<tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode($value['Periodico'])."</td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);text-align: center;'><a href='http://200.53.59.226/services/com.informador/?p=".remplazaespacio($value['Periodico'])."&tipo=1&f=".DATE('Y-m-d')."' target='_blank'>".$value['totalC']."</a></td>
    <td width='15%'  style='border-bottom: 1pt solid rgb(230, 230, 230);text-align: center;'><a href='http://200.53.59.226/services/com.informador/?p=".remplazaespacio($value['Periodico'])."&tipo=0&f=".DATE('Y-m-d')."' target='_blank'>".$value['totalBN']."</a></td>
    </tr>";
}

$mensaje.="<tr>
  <td colspan='3' align='center' style='font-weight: bold;'>ESQUELAS Y CONDOLENCIAS</td>
</tr>";
foreach ($EsquelasPeriodico as $value)
{
    $mensaje.="<tr>
    <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".utf8_decode($value['Periodico'])."</td>
    <td width='15%' style='border-bottom: 1pt solid rgb(230, 230, 230);'></td>
    <td width='15%' colspan=2 style='border-bottom: 1pt solid rgb(230, 230, 230);'>".$value['total']."</td>
    </tr>";
}
//
$query="SELECT DISTINCT(marca) as marcasbase FROM comercialdia  Where periodico in('El informador')";
$data=  mysql_query($query);
if(mysql_affected_rows()>0){
$marcasbase="";     
    while ($row = mysql_fetch_array($data)) {
        $marcasbase.="'".$row['marcasbase']."',";
        
        $marcas.=" <a href='http://200.53.59.226/services/com.informador/?p=El%20informador&m=".base64_encode($row['marca'])."&f=".DATE('Y-m-d')."' target='_blank'> ".$row['marca']."</a>,";
        $marcasx.=" <a href='http://200.53.59.226/services/com.informador/?p=El%20informador&m=".base64_encode($row['marcasbase'])."&f=".DATE('Y-m-d')."' target='_blank'> ".$row['marcasbase']."</a>,";
    }
     $uno="El informador ";$a=mysql_affected_rows();
    $row['nombre']." - ".  mysql_affected_rows()." ".$marcas."<br>";
    $sub=$marcasbase = substr($marcasbase, 0, -1);  
 
        $query="";$data="";$row="";$marcas="";$dos="";$Dossub="";
        $query="SELECT 'el Occidental' as nombre,marca FROM comercialdia WHERE periodico ='el Occidental'  AND marca not in($marcasbase)";
        $data=  mysql_query($query); 
        if(mysql_affected_rows()>0){
            while ($row = mysql_fetch_array($data)) {
                $marcas.=" <a href='http://200.53.59.226/services/com.informador/?p=El%20Occidental&m=".base64_encode($row['marca'])."&f=".DATE('Y-m-d')."' target='_blank'>".$row['marca']."</a>,";
            }
            $b=mysql_affected_rows();
            $dos= "El Occidental ";
            $Dossub= " ".$marcas."<br>";
        }else{
            
        }
        
        $query="";$data="";$row=""; $tres=""; $subTres="";$marcas="";
        $query="SELECT 'El Mural' as nombre,marca,count(1) as veces FROM comercialdia WHERE periodico ='El Mural'  AND marca not in($marcasbase)";
        $data=  mysql_query($query); 
        if(mysql_affected_rows()>0){
            while ($row = mysql_fetch_array($data)) {
                //echo $row['nombre']." - ".$row['veces']."<br>";
                $marcas.=" <a href='http://200.53.59.226/services/com.informador/?p=El%20Mural&m=".base64_encode($row['marca'])."&f=".DATE('Y-m-d')."' target='_blank'>".$row['marca']."</a>,";
                
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
                 $marcas.=" <a href='http://200.53.59.226/services/com.informador/?p=El%20Milenio%20Guadalajara&m=".base64_encode($row['marca'])."&f=".DATE('Y-m-d')."' target='_blank'>".$row['marca']."</a>,";
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
                  $marcas.=" <a href='http://200.53.59.226/services/com.informador/?p=La%20Jornada%20Jalisco&m=".base64_encode($row['marca'])."&f=".DATE('Y-m-d')."' target='_blank'>".$row['marca']."</a>,";
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
                 $marcas.=" <a href='http://200.53.59.226/services/com.informador/?p=Publimetro%20Guadalajara&m=".base64_encode($row['marca'])."&f=".DATE('Y-m-d')."'>".$row['marca']."</a>,";
            }
            $seis= "Publimetro Guadalajara ";$f=mysql_affected_rows();
            $subseis=" ".$marcas."<br>";
        }else{
            
        }         
}else{
    
}

 
 $tabla="<tr>
            <td colspan='3' align='center' style='font-weight: bold;'>COMPARATIVA</td>
         </tr>
         <tr>
           <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);' >$uno</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>$a</td>
         </tr>
         <tr>
            <td colspan='3' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$marcasx </td>
         </tr>
            
            <tr>
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);' >$dos</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$b</td>
            </tr>
            <tr>
                <td colspan='3' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$Dossub </td>
            </tr>
            <tr>
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);' >$tres</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$c</td>
            </tr>
            <tr  >
                <td colspan='3' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$subTres </td>
            </tr>
            
            <tr>
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);' >$cuatro</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$d</td>
            </tr>
            <tr  >
                <td colspan='3' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$subcuatro </td>
            </tr>

            <tr>
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);' >$cinco</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$e</td>
            </tr>
            <tr  >
                <td colspan='3' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$subcinco </td>
            </tr>

            <tr>
                <td colspan='2' style='border-bottom: 1pt solid rgb(230, 230, 230);' >$seis</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);' >$f</td>
            </tr>
            <tr  >
                <td colspan='3' style='border-bottom: 1pt solid rgb(230, 230, 230);font-size: 11px;color: rgb(16, 0, 202);text-align: inherit;'>$subseis </td>
            </tr> ";


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

   $mail->AddBCC('tony@admedios.com');
   $mail->AddBCC('ruben.diaz@admedios.com');
   $mail->AddBCC('admedios@admedios.com');
   $mail->AddBCC('info@admedios.com');
   $mail->AddBCC("job.cg@icloud.com");
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

function remplazaespacio($periodico){
    return str_replace(' ', '%20', $periodico);
}
?>
</body>
</html>