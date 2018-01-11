<?php
require '../../../../APP/php/conexion.php';


$query="SELECT e.idEditorial,e.Periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
        CONCAT('/Periodicos/',e.Periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf, p.estado
        FROM editorialdia e, periodicos p 
        WHERE( 
        Texto like '%Jose Irabien Medina%' OR
        Titulo like '%Jose Irabien Medina%' OR 
        Encabezado like '%Jose Irabien Medina%' OR
        Texto like '%Jose Neyif Irabien%' OR
        Titulo like '%Jose Neyif Irabien%' OR 
        Encabezado like '%Jose Neyif Irabien%' 
        ) and p.estado like'%Puebla%'
        AND e.periodico=p.nombre 
        ORDER BY e.Periodico";
$data=  mysql_query($query);
if(mysql_affected_rows()>0){
    $tabla="<table border=0 align='center' style='font-family: arial;font-size: 14px;width:90%;' cellspacing='0'>"
            . "<tr>"
            . "<td colspan=4 align='center'  ><span style='-moz-border-radius: 0px 0px 7px 7px;
-webkit-border-radius: 0px 0px 7px 7px;
border-radius: 0px 0px 7px 7px;
background-image: -moz-linear-gradient(top, #6e6d6c, #000000);
background-image: -ms-linear-gradient(top, #6e6d6c, #000000);
background-image: -o-linear-gradient(top, #6e6d6c, #000000);
background-image: -webkit-gradient(linear, center top, center bottom, from(#6e6d6c), to(#000000));
background-image: -webkit-linear-gradient(top, #6e6d6c, #000000);
background-image: linear-gradient(top, #6e6d6c, #000000);
padding: 11px;
color: white;
margin-bottom: 8px;'><strong style='font-size: 19px;'>REPORTE DE NOTAS  | JOSE NEYIT IRABIEN</strong></span><br><br></td>"
            . "</tr>"
            . "<tr>"
            . "<td  colspan=4 align='center'> </td>"
            . "</tr>"
            . "<tr>"
            . "<td  colspan=4 align='center'> </td>"
            . "</tr>";
    while ($row = mysql_fetch_array($data)) {
        $Palabras = array('José'," José ","Irabien","José Irabién Medina"," José","José ","Irabién","Medina");
        //$nota=substr($row['Texto'], 0, 5000);
        $nota=($row['Texto']);
        $nota=highlight(utf8_encode($nota), $Palabras);
        $tabla.= "<tr>"
                . " <td style='background-color: rgb(240, 255, 190);'><strong>Periodico:".$row['Periodico']."</strong> </td>"
                . "<td>".$row['estado']."<td>"
                . "<td><strong>".mostrar_fecha_completa($row['Fecha'])."</strong></td>"
            . "</tr>".
              "<tr>"
                . " <td style='background-color: rgb(231, 247, 255);'><strong>Categoria: </strong>".$row['categoria']." </td>"
                . "<td style='background-color: rgb(231, 247, 255);'><strong>Seccion: </strong>".$row['Seccion']."<td>"
                . "<td style='background-color: rgb(231, 247, 255);'> <strong>Autor: </strong>".$row['autor']."</td>"
            . "</tr>"
            . "<tr>"
                . "<td colspan='4' style='background-color: rgb(231, 247, 255);text-align: justify;'><strong>TITULO:</strong>".$row['Titulo']."..."."</td>"
            . "</tr>"
            . "<tr>"
                . "<td colspan='4' style='background-color: rgb(248, 248, 248);text-align: justify;'>".utf8_decode($nota)."..."."</td>"
            . "</tr>"
            . "<tr>"
                . "<td colspan='4'><a href='http://200.53.59.226/2014/Intranet".$row['pdf']."' target='_black'>Ir a la nota</a><br></td>"
            . "</tr>"
            . "<tr>"
                . "<td colspan='4'> <br></td>"
            . "</tr>";
    }
    correo ($tabla.="</table>");
}else{
    correo($tabla="<table border=0 align='center' style='font-family: arial;font-size: 14px;width:90%;'>"
            . "<tr>"
            . "<td colspan=4 align='center' style='background-color: rgb(223, 247, 255);'><strong style='font-size: 19px;'>NO SE ENCONTRARON NOTAS JOSE NEYIT IRABIEN</strong></td>"
            . "</tr>"
            . "<tr>"
            . "<td  colspan=4 align='center'> </td>"
            . "</tr>"
            . "<tr>"
            . "<td  colspan=4 align='center'> </td>"
            . "</tr>"
            ."<tr>"
                . " <td colspan='3'><strong></strong> </td>"
            . "</tr>");
       
}
       

function correo($mensaje){
   
require '../PHPMailer/class.phpmailer.php';
            
     

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host     = "ssl://smtp.gmail.com";
$mail->Port     = 465;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gmail.com";
$mail->Password = "gaimpresos01";
       


$mail->FromName = "MONITOREO DE PRENSA ";
 
$mail->Subject  = "JOSE NEYIT ".date("Y-m-d");  
$mail->WordWrap = 50;
 
// Correo destino

$mail->IsHTML(TRUE);
 
$mail->Body = $mensaje;
 
if(!$mail->Send()) {
    echo "Error: " . $mail->ErrorInfo;
} else {
    echo "Mensaje enviado";
}
            //
}

       

       
       


function highlight($cadena, $arr_palabras) {
	if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) {
		return false;
	}
	$str_palabras = implode ('|', $arr_palabras);
 	return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color: rgb(197, 250, 183);">$1</strong>', $cadena);
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