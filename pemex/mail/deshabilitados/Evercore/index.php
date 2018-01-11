<?php
require '../../php/conexion.php';
$pedroAspe="(
Texto like '%Pedro Carlos Aspe Armella%' OR
Texto like '%Pedro Carlos Aspe%' OR
Texto like '%Pedro Aspe Armella%' Or
Texto like '%Aspe Armella%' OR

Titulo like '%Pedro Carlos Aspe Armella%' OR
Titulo like '%Pedro Carlos Aspe%' OR
Titulo like '%Pedro Aspe Armella%' Or
Texto like '%Aspe Armella%' OR

Encabezado like '%Pedro Carlos Aspe Armella%' OR
Encabezado like '%Pedro Carlos Aspe%' OR
Encabezado like '%Pedro Aspe Armella%' Or
Encabezado like '%Aspe Armella%'
)";

$volaris="(
Texto like '%Volaris%' OR
Titulo like '%Volaris%' OR
Encabezado like '%Volaris%'
)";

$fibraUNO="(
Texto like '%Fibra UNO%' OR
Titulo like '%Fibra UNO%' OR
Encabezado like '%Fibra UNO%'
)";
$fibraDanhos="(
Texto like '%Fibra Danhos%' OR
Titulo like '%Fibra Danhos%' OR
Encabezado like '%Fibra Danhos%'
)";

$vercoreProtego="(
Texto like '%Evercore%' OR
Texto like '%protego%' OR
Titulo like '%Evercore%' OR
Titulo like '%protego%' OR
Encabezado like '%protego%' OR
Encabezado like '%Evercore%'
)";


 $queryTotal="Select 'Pedro Carlos Aspe Armella' as nombre,count(idEditorial) as contador from editorialdia where ($pedroAspe)
union (Select 'Volaris' as nombre,count(idEditorial) as contador from editorialdia where ($volaris))
union (Select 'Fibra UNO' as nombre,count(idEditorial) as contador from editorialdia where ($fibraUNO))
union (Select 'Fibra Danhos Federales' as nombre,count(idEditorial) as contador from editorialdia where ($fibraDanhos))
union (Select 'Evercore/Protego' as nombre,count(idEditorial) as contador from editorialdia where ($vercoreProtego))
 "; 

$queryPedro="SELECT 
idEditorial,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as 'Fecha',e.Periodico,Titulo,Texto,Seccion,NumeroPagina,autor,calificacion,p.Estado,
CONCAT('/2014/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
FROM
editorialdia e,periodicos p
WHERE(
Texto like '%Pedro Carlos Aspe Armella%' OR
Texto like '%Pedro Carlos Aspe%' OR
Texto like '%Pedro Aspe Armella%' Or
Texto like '%Aspe Armella%' OR

Titulo like '%Pedro Carlos Aspe Armella%' OR
Titulo like '%Pedro Carlos Aspe%' OR
Titulo like '%Pedro Aspe Armella%' Or
Texto like '%Aspe Armella%' OR

Encabezado like '%Pedro Carlos Aspe Armella%' OR
Encabezado like '%Pedro Carlos Aspe%' OR
Encabezado like '%Pedro Aspe Armella%' Or
Encabezado like '%Aspe Armella%'
) AND
p.Nombre=e.Periodico

ORDER BY p.Estado,e.Periodico";

$queryVolaris="SELECT 
idEditorial,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as 'Fecha',e.Periodico,Titulo,Texto,Seccion,NumeroPagina,autor,calificacion,p.Estado,
CONCAT('/2014/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
FROM
editorialdia e,periodicos p
WHERE $volaris  AND
p.Nombre=e.Periodico

ORDER BY p.Estado,e.Periodico";

$queryFibraUno="SELECT 
idEditorial,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as 'Fecha',e.Periodico,Titulo,Texto,Seccion,NumeroPagina,autor,calificacion,p.Estado,
CONCAT('/2014/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
FROM
editorialdia e,periodicos p
WHERE $fibraUNO  AND
p.Nombre=e.Periodico
ORDER BY p.Estado,e.Periodico";

$queryfibraDanhos="SELECT 
idEditorial,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as 'Fecha',e.Periodico,Titulo,Texto,Seccion,NumeroPagina,autor,calificacion,p.Estado,
CONCAT('/2014/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
FROM
editorialdia e,periodicos p
WHERE $fibraDanhos  AND
p.Nombre=e.Periodico
ORDER BY p.Estado,e.Periodico";

$queryvercoreProtego="SELECT 
idEditorial,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as 'Fecha',e.Periodico,Titulo,Texto,Seccion,NumeroPagina,autor,calificacion,p.Estado,
CONCAT('/2014/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
FROM
editorialdia e,periodicos p
WHERE $vercoreProtego  AND
p.Nombre=e.Periodico
ORDER BY p.Estado,e.Periodico";


$result1=  mysql_query($queryTotal);
$result2=  mysql_query($queryPedro);
$result3=  mysql_query($queryVolaris);
$result4=  mysql_query($queryFibraUno);
$result5=  mysql_query($queryfibraDanhos);
$result6=  mysql_query($queryvercoreProtego);
//200.53.59.226
$mensaje="<style>body{font-family: Century gothic;
font-size: 10px;}tr {
border-bottom: 2pt solid black;
}</style>
<table width='900px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td colspan='8' style='background-color: rgba(204, 204, 204, 0.52);'><img src='http://200.53.59.226/services/APP/lib/Evercore/logo.jpg' style='width:400px;'></td>
  </tr>
 <tr>
  <td colspan='7' align='right' style='font-weight: bold;'>".mostrar_fecha_completa(DATE('Y-m-d'))."</td>
  <td></td>
  <td></td>
</tr>
<tr>
<td colspan='8' align='center' style='font-weight: bold;font-size: 21px;'>TOTAL DE NOTAS </td>
</tr>
 <tr>
  <td colspan='8' >&nbsp;</td>
</tr>";

while ($row = mysql_fetch_array($result1))
{
    $mensaje.="<tr>
    <td colspan='5' width='49%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode($row['nombre'])."</td>
    <td colspan='3' width='15%'  align='left' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".$row['contador']."</td>
    </tr>";
}
$mensaje.="<tr>
  <td colspan='8' align='center' style='background-color: #ccc;font-weight: bold;font-size: 21px;'>Pedro Carlos Aspe Armella </td>
</tr>
<tr>
  <td align='center' style='font-weight: bold;'>Titulo</td>
  <td align='center' style='font-weight: bold;'>Nota</td>
  <td align='center' style='font-weight: bold;'>Fecha</td>
  <td align='center' style='font-weight: bold;'>Periodico</td>
  <td align='center' style='font-weight: bold;'>Seccion</td>
  <td align='center' style='font-weight: bold;'>Pagina</td>
  <td align='center' style='font-weight: bold;'>Testigo</td>
  <td align='center' style='font-weight: bold;'>".utf8_decode('Calificación')."</td>
</tr>";
while ($row = mysql_fetch_array($result2))
{
    $mensaje.="<tr>
    <td align='left' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Titulo'],0,100)))."</td>
    <td align='justify' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Texto'],0,150)))."</td>
    <td align='center' width='14%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Fecha']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Periodico']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Seccion']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> #".utf8_decode($row['NumeroPagina'])."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226".$row['pdf']."' target='_blank'>PDF</a></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> ".calificacion($row['calificacion'])."</td>    
    </tr>";
}
$mensaje.="<tr>
  <td colspan='8' align='center' style='background-color: #ccc;font-weight: bold;font-size: 21px;'>Volaris </td>
</tr>
<tr>
  <td align='center' style='font-weight: bold;'>Titulo</td>
  <td align='center' style='font-weight: bold;'>Nota</td>
  <td align='center' style='font-weight: bold;'>Fecha</td>
  <td align='center' style='font-weight: bold;'>Periodico</td>
  <td align='center' style='font-weight: bold;'>Seccion</td>
  <td align='center' style='font-weight: bold;'>Pagina</td>
  <td align='center' style='font-weight: bold;'>Testigo</td>
  <td align='center' style='font-weight: bold;'>".utf8_decode('Calificación')."</td>
</tr>";       
while ($row = mysql_fetch_array($result3))
{
    $mensaje.="<tr>
    <td align='left' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Titulo'],0,100)))."</td>
    <td align='justify' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Texto'],0,150)))."</td>
    <td align='center' width='14%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Fecha']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Periodico']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Seccion']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> #".utf8_decode($row['NumeroPagina'])."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226".$row['pdf']."' target='_blank'>PDF</a></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> ".calificacion($row['calificacion'])."</td>    
    </tr>";
}

$mensaje.="<tr>
  <td colspan='8' align='center' style='background-color: #ccc;font-weight: bold;font-size: 21px;'>Fibra UNO </td>
</tr>
<tr>
  <td align='center' style='font-weight: bold;'>Titulo</td>
  <td align='center' style='font-weight: bold;'>Nota</td>
  <td align='center' style='font-weight: bold;'>Fecha</td>
  <td align='center' style='font-weight: bold;'>Periodico</td>
  <td align='center' style='font-weight: bold;'>Seccion</td>
  <td align='center' style='font-weight: bold;'>Pagina</td>
  <td align='center' style='font-weight: bold;'>Testigo</td>
  <td align='center' style='font-weight: bold;'>".utf8_decode('Calificación')."</td>
  
</tr>";

while ($row = mysql_fetch_array($result4))
{
    $mensaje.="<tr>
    <td align='left' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Titulo'],0,100)))."</td>
    <td align='justify' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Texto'],0,150)))."</td>
    <td align='center' width='14%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Fecha']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Periodico']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Seccion']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> #".utf8_decode($row['NumeroPagina'])."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226".$row['pdf']."' target='_blank'>PDF</a></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> ".calificacion($row['calificacion'])."</td>    
    </tr>";
}
$mensaje.="<tr>
  <td colspan='8' align='center' style='background-color: #ccc;font-weight: bold;font-size: 21px;'>Fibra Danhos </td>
</tr>
<tr>
  <td align='center' style='font-weight: bold;'>Titulo</td>
  <td align='center' style='font-weight: bold;'>Nota</td>
  <td align='center' style='font-weight: bold;'>Fecha</td>
  <td align='center' style='font-weight: bold;'>Periodico</td>
  <td align='center' style='font-weight: bold;'>Seccion</td>
  <td align='center' style='font-weight: bold;'>Pagina</td>
  <td align='center' style='font-weight: bold;'>Testigo</td>
  <td align='center' style='font-weight: bold;'>".utf8_decode('Calificación')."</td>
</tr>";  
if(mysql_num_rows($result5)!=0)
{
    while ($row = mysql_fetch_array($result5))
    {
        $mensaje.="<tr>
    <td align='left' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Titulo'],0,100)))."</td>
    <td align='justify' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Texto'],0,150)))."</td>
    <td align='center' width='14%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Fecha']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Periodico']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Seccion']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> #".utf8_decode($row['NumeroPagina'])."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226".$row['pdf']."' target='_blank'>PDF</a></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> ".calificacion($row['calificacion'])."</td>    
    </tr>";
    }
}else{
    $mensaje.="<tr>
    <td align='center' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'></td>
    <td align='center' width='14%' style='border-bottom: 2pt solid rgb(230, 230, 230);'></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'></td>
    </tr>";
}    
       
$mensaje.="<tr> 
  <td colspan='8' align='center' style='background-color: #ccc;font-weight: bold;font-size: 21px;'>Evercore / Protego </td>
</tr>
<tr>
  <td align='center' style='font-weight: bold;'>Titulo</td>
  <td align='center' style='font-weight: bold;'>Nota</td>
  <td align='center' style='font-weight: bold;'>Fecha</td>
  <td align='center' style='font-weight: bold;'>Periodico</td>
  <td align='center' style='font-weight: bold;'>Seccion</td>
  <td align='center' style='font-weight: bold;'>Pagina</td>
  <td align='center' style='font-weight: bold;'>Testigo</td>
  <td align='center' style='font-weight: bold;'>".utf8_decode('Calificación')."</td>
</tr>";  

while ($row = mysql_fetch_array($result6))
{
    $mensaje.="<tr>
    <td align='left' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Titulo'],0,100)))."</td>
    <td align='justify' width='30%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode(substr($row['Texto'],0,150)))."</td>
    <td align='center' width='14%' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Fecha']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Periodico']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'>".utf8_decode(utf8_encode($row['Seccion']))."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> #".utf8_decode($row['NumeroPagina'])."</td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'><a href='http://200.53.59.226".$row['pdf']."' target='_blank'>PDF</a></td>
    <td align='center' style='border-bottom: 2pt solid rgb(230, 230, 230);'> ".calificacion($row['calificacion'])."</td>    
    </tr>";
}
  $mensaje.="<tr>"
          . "<td colspan='8' align='center'><img src='http://200.53.59.226/services/APP/lib/Evercore/jpgraph/src/Examples/Evercore.php?f=".DATE('Y-m-d')."'></td>"
          . "</tr>";     
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


    $mail->AddBCC("validacion.admonitor@gmail.com");
    $mail->AddBCC("editorial@admedios.com");
    $mail->AddBCC("sistemas@admedios.com");
    $mail->AddBCC('jlga@gacomunicacion.com');
    $mail->AddBCC('oortiz@gacomunicacion.com');
    $mail->AddBCC('gmocarmona@gacomunicacion.com');
    $mail->AddBCC('fcocolina@gacomunicacion.com');
    $mail->AddBCC('jelias@evercore.com.mx');
    

    $mail->FromName = "ANALISIS DE PRENSA ";

    $mail->Subject  = "EVERCORE ".date("Y-m-d");  
    $mail->WordWrap = 50;
    
    $mail->IsHTML(TRUE);

     $mail->Body =($mensaje);
    if(!$mail->Send())
    {
        echo "Error: " . $mail->ErrorInfo;
    }else
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

function calificacion($cadena){
    switch($cadena){
        case 1:
            return '<span style = "color: green; font-weight:bold">Positiva</span>';
            break;
        case 2:
            return '<span style = "color: grey; font-weight:bold">Neutra</span>';
            break;
        case 3:
            return '<span style = "color: red; font-weight:bold">Negativa</span>';
            break;
        case 4:
            return '<span style = "color: green; font-weight:bold">Sin Calificar</span>';
            break;
    }
}

?>
