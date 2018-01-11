<?php
$server="localhost";
$username="root";
$password="Gaddp552014";
//$password="";
$database="monitoreoGa";

$conect=mysql_connect($server, $username, $password);

mysql_select_db($database,$conect);



$periodico=$_POST['periodico'];
$titulo=  utf8_decode($_POST['titulo']);
$Estado=$_POST['Estado'];
$seccion=$_POST['seccion'];
$categoria=$_POST['categoria'];
$autor=utf8_decode($_POST['autor']);
$texto= utf8_decode($_POST['texto']);
$encabezado= utf8_decode($_POST['encabezado']);
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$foto=$_POST['foto'];
$PFoto=utf8_decode($_POST['PFoto']);
$capturista=1;
$time=$fecha." ".$hora;
$sql="insert into noticiasDia(Periodico,Seccion,Categoria,NumeroPagina,Autor,Fecha,Hora,Titulo,Encabezado,Texto,PaginaPeriodico,Foto,PieFoto,idCapturista,calificacionSemantica,calificacionLexica,Activo,estatus,taked,analyzed_id,analyzed_name,updated_at,`order`,cutted) values($periodico,$seccion,$categoria,'5','$autor','$fecha','$hora','$titulo','$encabezado','$texto',1,0,'$PFoto',$capturista,0,0,1,'captured',0,1,'WEB','$time',0,0)";

$result=mysql_query($sql);

if(mysql_affected_rows()==1)
{
    echo "ok";
}else{
    echo "ERROR: ".mysql_error()."\n".$sql;
}    
?>