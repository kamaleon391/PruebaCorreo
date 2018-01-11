<?php
include "/var/www/external/services/mail/conexion.php";
require "/var/www/external/services/mail/library/Mailin.php";
require '/var/www/external/services/mail/conexion.php';

$fechaCompleta = mostrar_fecha_completa( $fecha );

$sql1="SELECT
	n.cutted,
	n.Periodico as idPeriodico,
	n.idEditorial,
	n.Titulo,
	p.Nombre as Periodico,
	p.String_Name as StringName,
	n.CREL as CREL,
	n.CostoNota,
	n.CREN as CREN,
	e.Nombre AS estado,
	CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
	n.PaginaPeriodico,
	s.seccion,
	c.Categoria as Categoria,
	n.Autor,
	n.Texto,
	CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
	CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
	n.Categoria as 'Num.Categoria',
	n.NumeroPagina,
	n.Fecha,
	n.Hora,
	n.Encabezado,
	n.Foto,
	n.PieFoto
FROM
	noticiasDia n,
	periodicos p,
	seccionesPeriodicos s,
	categoriasPeriodicos c,
	estados e
WHERE
	p.idPeriodico=n.Periodico 	AND
	s.idSeccion=n.Seccion 		AND
	c.idCategoria=n.Categoria 	AND
	n.Activo = 1 				AND
	p.Estado=e.idEstado 		AND
	n.Categoria=80 				AND
	fecha = CURDATE() 			AND (
		Texto like '%Sistema Nacional Anticorrupcion SNA%' OR
		Texto like '%Sistema Anticorrupcion%' OR
		Texto like '%Sistema Nacional Anticorrupcion%' OR
		Texto like '%Nacional Anticorrupcion%' OR

		Titulo like '%Sistema Nacional Anticorrupcion SNA%' OR
		Titulo like '%Sistema Anticorrupcion%' OR
		Titulo like '%Sistema Nacional Anticorrupcion%' OR
		Titulo like '%Nacional Anticorrupcion%' OR

		Encabezado like '%Sistema Nacional Anticorrupcion SNA%' OR
		Encabezado like '%Sistema Anticorrupcion%' OR
		Encabezado like '%Sistema Nacional Anticorrupcion%' OR
		Encabezado like '%Nacional Anticorrupcion%' OR
				
		PieFoto like '%Sistema Nacional Anticorrupcion SNA%' OR
		PieFoto like '%Sistema Anticorrupcion%' OR
		PieFoto like '%Sistema Nacional Anticorrupcion%' OR
		PieFoto like '%Nacional Anticorrupcion%'
	)
GROUP BY n.idEditorial
ORDER BY n.Hora";
verificaNotificadas($sql1);

function verificaNotificadas($sql1){
	$nuevas=array();
	$notificadas=array();
	$i=0;
	$data=  mysql_query($sql1);
	while ($row = mysql_fetch_array($data)){
		$nuevas[$i]=$row['idEditorial'];
		$i++;
	}
	$notificadas=Notasnotificadas();
	
	/*
	echo "<br>Nuevas <br>";
	foreach ($nuevas as $key) {
		echo $key."--".gettype($key)."<br>";
	}

	echo "<br>Notificadas <br>";
	foreach ($notificadas as $key) {
		echo $key."<br>";
	}*/
	comparaNotas($nuevas,$notificadas);//Comparando
}

function Notasnotificadas(){
	$sql="SELECT id, idEditorial, fecha FROM notificacionesWeb_SNA WHERE fecha=CURDATE()";
	$data=  mysql_query($sql);
	while ($row = mysql_fetch_array($data)){
		$notificadas[$i]=$row['idEditorial'];
		$i++;
	}
	return $notificadas;
}

function comparaNotas($nuevas,$notificadas){

	$diferencia=array_diff($nuevas,$notificadas);
	
	if(sizeof($diferencia)==0){
		//Notificamos todas las nuevas
		//echo "Notificar todas las nuevas";
		notificadorTodas($nuevas);
	}else{
		//Notificamos las que se encuentren en el arreglo
		/*foreach ($diferencia as $key) {
			echo "<br>".$key."<br>";
		}*/
		//Comprobado que solo tenemos las notas no notificadas

		notificadorDiferentes($diferencia);
	}
}

function notificadorTodas($todas){
$ids="";$i=0;

	foreach ($todas as $key) {
		if($i!=0){
			$ids=$ids.",".$key;
		}else{
			$ids=$key;
		}
		$i++;
	}

	$sql1="SELECT
			n.cutted,
			n.Periodico as idPeriodico,
			n.idEditorial,
			n.Titulo,
			p.Nombre as Periodico,
			p.String_Name as StringName,
			n.CREL as CREL,
			n.CostoNota,
			n.CREN as CREN,
			e.Nombre AS estado,
			CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
			n.PaginaPeriodico,
			s.seccion,
			c.Categoria as Categoria,
			n.Autor,
			n.Texto,
			CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
			CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
			n.Categoria as 'Num.Categoria',
			n.NumeroPagina,
			n.Fecha,
			n.Hora,
			n.Encabezado,
			n.Foto,
			n.PieFoto
			FROM
				noticiasDia n,
				periodicos p,
				seccionesPeriodicos s,
				categoriasPeriodicos c,
				estados e
			WHERE
				p.idPeriodico=n.Periodico 	AND
				s.idSeccion=n.Seccion 		AND
				c.idCategoria=n.Categoria 	AND
				n.Activo = 1 				AND
				p.Estado=e.idEstado 		AND
				n.Categoria=80 				AND
				fecha = CURDATE() 			AND 
				idEditorial in ($ids)
			GROUP BY n.idEditorial
			ORDER BY n.Hora";

	$mensaje="<style>
    body{
        margin:0;
        padding:0;
        background-color:#F9F9F9;
        font-family: Century gothic;
        font-size: 10px;
    }
    tr{
        border-bottom: 1pt solid black;
    }
    img{
    	float:left;
    	clear:both;
    }
    p{
    	text-align: justify;
    	text-justify: inter-word;
    }
    .label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: bold;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
	}

    .label-medio{
    	background-color:#428bca;
    }

    .label-ciudad{
    	background-color:#5cb85c;
    }

    .label-gral{
    	background-color:#999;
    }

</style>
<table width='500px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td colspan='3'><img src='http://187.247.253.5/external/services/mail/sna/Logo.png'></td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>";

	$data=mysql_query($sql1);
	while ($row=mysql_fetch_array($data)){
		$idnoticia	=	$row['idEditorial'];
		$titulo		=	$row['Titulo'];
		$texto 		=	$row['Texto'];
		$medio 		=	$row['StringName'];
		$idmedio 	=	$row['idPeriodico'];
		$seccion 	=	$row['seccion'];
		$categoria 	=	$row['Categoria'];
		$estado 	=	$row['estado'];
		$fecha 		=	$row['Fecha'];
		$hora 		=	$row['Hora'];
		$link 		=	$row['Encabezado'];

		
		$mensaje.="<tr>";
		$mensaje.="<td><img src='http://187.247.253.5/siscap.la/public/img/portadas/thumbs/thumb-".$idmedio.".jpg' class='img-thumbnail' width='60px' height='60px' data-thumb-id='".$idnoticia."'>";
		$mensaje.="</td>";
		$mensaje.="<td colspan='2'><h3>".utf8_encode($titulo)."</h3>&nbsp;<span class='label label-gral'>Sección: ".utf8_encode($seccion)."</span>&nbsp;<span class='label label-gral'>Categoría:".utf8_decode($categoria)."</span></td>";
		$mensaje.="</tr>";
		$mensaje.="<tr>";
			$mensaje.="<td colspan='3'>".utf8_encode(marcaTexto($texto))."</td>";
		$mensaje.="</tr>";
		$mensaje.="</tr>";
		$mensaje.="<tr>";
			$mensaje.="<td colspan='3'>".utf8_encode(" <b> <span class='label label-medio'>".utf8_encode($medio)."</span> | <span class='label label-ciudad'>".utf8_encode($estado)."</span> | ".utf8_decode(mostrar_fecha_completa($fecha))." | ".$hora."</b>")."</td>";
		$mensaje.="</tr>";
		$mensaje.="<tr>";
			$mensaje.="<td colspan='3'>Link: <a href='$link' target='_blank'>".utf8_decode($link)."</a></td>";
		$mensaje.="</tr>";
		$mensaje.="<tr><td colspan='3'>&nbsp;</td></tr>";
	}

sendinblue($mensaje);

}

function notificadorDiferentes($diferencia){
	$ids=explode(',', $diferencia);
	$sql1="SELECT
			n.cutted,
			n.Periodico as idPeriodico,
			n.idEditorial,
			n.Titulo,
			p.Nombre as Periodico,
			p.String_Name as StringName,
			n.CREL as CREL,
			n.CostoNota,
			n.CREN as CREN,
			e.Nombre AS estado,
			CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
			n.PaginaPeriodico,
			s.seccion,
			c.Categoria as Categoria,
			n.Autor,
			n.Texto,
			CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
			CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
			n.Categoria as 'Num.Categoria',
			n.NumeroPagina,
			n.Fecha,
			n.Hora,
			n.Encabezado,
			n.Foto,
			n.PieFoto
			FROM
				noticiasDia n,
				periodicos p,
				seccionesPeriodicos s,
				categoriasPeriodicos c,
				estados e
			WHERE
				p.idPeriodico=n.Periodico 	AND
				s.idSeccion=n.Seccion 		AND
				c.idCategoria=n.Categoria 	AND
				n.Activo = 1 				AND
				p.Estado=e.idEstado 		AND
				n.Categoria=80 				AND
				fecha = CURDATE() 			AND 
				idEditorial in ($ids)
			GROUP BY n.idEditorial
			ORDER BY n.Hora";

echo "<br>".$sql1."<br>";
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
         $dia_sem3=('Miércoles');
       break;

       case "4":   // Bloque 1
         $dia_sem3='Jueves';
       break;

       case "5":   // Bloque 1
         $dia_sem3='Viernes';
       break;

       case "6":   // Bloque 1
         $dia_sem3=('Sábado');
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
  }
$fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;
return $fecha_texto;
};

function sendinblue($message){

    $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
    $data   = array(
        "to" => array(
              'impresos@info-gacomunicacion.com' => 'impresos@info-gacomunicacion.com'
        ),
        "bcc" => array(
            'ehb1703@gmail.com' => 'ehb1703@gmail.com',
            'edgarh@gacomunicacion.com'=>'edgarh@gacomunicacion.com'
	),
        "from" => array("gaimpresos@gacomunicacion.com", "SNA"),
        "subject" => "SNA Corte WEB".date("Y-m-d"),
        "html" => $message,
        "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "CorteWEB-Portales")
    );

    /*
     * ENVIANDO EMAIL...
     */
   var_dump($mailin->send_email($data));
}


function marcaTexto($cadenaOriginal){
	$cadenaMarcada="";

	$cadenaMarcada=str_replace('Sistema Nacional Anticorrupción', '<mark style="background-color:#fff1a5;color:#000000;">Sistema Nacional Anticorrupción</mark>', $cadenaOriginal);
	$cadenaMarcada=str_replace(' SNA ', '<mark style="background-color:#fff1a5;color:#000000;">SNA</mark>', $cadenaOriginal);
	$cadenaMarcada=str_replace('Nacional Anticorrupción', '<mark style="background-color:#fff1a5;color:#000000;">Nacional Anticorrupción</mark>', $cadenaOriginal);
	return $cadenaMarcada;
}
?>