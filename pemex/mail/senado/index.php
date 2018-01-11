<?php 

require "/var/www/external/services/mail/library/Mailin.php";
require '/var/www/external/services/mail/conexion.php';
require 'querysSenadoEstados.php';


$estado=$_GET['estado'];

$fecha=  date("Y-m-d");


$mensaje="
<!DOCTYPE html>
<html>
	<head> 
		<meta charset='utf-8' />
		<meta name='viewport' content='width=device-width'/>
		<title>Sintesis Estatal</title>
		<style>
			img{
				/*width:100%;*/
				box-shadow: 2px 2px 20px #888888;
			}
			.card{
				width: 600px;
				background-color: white;
				box-shadow: 3px 3px 10px #888888;
				font-family: 'Times New Roman', Times, serif;
			}
			.content{
				text-align: left;
				border-bottom: 1px solid #D3D7CF;
			}

			.item{
				display: inline-block;
				width: 50%;
				/*height: 75px;*/
				margin: 10px;
				padding:20px;
			}
			.button {
				background-color: #e7e7e7;
				color: black;
				border: none;
				padding: 15px 32px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
				cursor: pointer;
			}
		</style>
	</head>

	<body>
	<center>
		<div class='card'>
			<img src='http://187.247.253.5/external/services/mail/senado/logo.png' alt='' style='width: 300px;'/>
			<p style='line-height: 1px;'>SÍNTESIS INFORMATIVA MATUTINA ".strtoupper(strtolower(estadoStr($estado)))."</p>
			<p>".mostrar_fecha_completa(date('Y-m-d'))."</p>
			<p>Senado de la República, LXIII Legislatura</p>
			<!--p align='left'> <b>Senadoras y Senadores</b></p> 
			<p align='justify'>
				La Coordinación de Comunicación Social le envía la síntesis matutina, se adjuntan los enlaces a los bloques temáticos con la información del ".mostrar_fecha_completa(date('Y-m-d')).".
			</p>
			<p align='left'>	
				Le deseamos un excelente día.
			</p-->
			<p align='center'>
			<img src='http://187.247.253.5/external/services/mail/senado/comsoc.jpg' alt='' style='width: 160px;'/>
			</p>
						<div class='content'>
				<div class='item'>
					GOBERNADOR
				</div>
								<a class='button' href='http://187.247.253.5/external/testigos/sintesis/".strtolower(estadoStr($estado))."/".$fecha."/Gobernador.pdf'>Reporte&nbsp;".cuentanotas('1',$estado)."&nbsp;Notas</a>
							</div>
						<div class='content'>
				<div class='item'>
					MUNICIPIOS ".estadoStr($estado)."
				</div>
								<a class='button' href='http://187.247.253.5/external/testigos/sintesis/".strtolower(estadoStr($estado))."/".$fecha."/Municipios.pdf'>Reporte&nbsp;".cuentanotas('2',$estado)."&nbsp;&nbsp;Notas</a>
							</div>
						<div class='content'>
				<div class='item'>
					SENADORES ".estadoStr($estado)."
				</div>
								<a class='button' href='http://187.247.253.5/external/testigos/sintesis/".strtolower(estadoStr($estado))."/".$fecha."/Senadores.pdf'>Reporte&nbsp;".cuentanotas('3',$estado)."&nbsp;&nbsp;Notas</a>
							</div>
						<div class='content'>
				<div class='item'>
					DIPUTADOS FEDERALES ".estadoStr($estado)."
				</div>
								<a class='button' href='http://187.247.253.5/external/testigos/sintesis/".strtolower(estadoStr($estado))."/".$fecha."/Diputados.pdf'>Reporte&nbsp;".cuentanotas('4',$estado)."&nbsp;&nbsp;Notas</a>
							</div>
						<div class='content'>
				<div class='item'>
					DIPUTADOS LOCALES ".estadoStr($estado)."
				</div>
								<a class='button' href='http://187.247.253.5/external/testigos/sintesis/".strtolower(estadoStr($estado))."/".$fecha."/Dip.%20Locales.pdf'>Reporte&nbsp;".cuentanotas('5',$estado)."&nbsp;&nbsp;Notas</a>
							</div>
						<div class='content'>
				<div class='item'>
					PRIMERAS PLANAS ".estadoStr($estado)."
				</div>
								<a class='button' href='http://187.247.253.5/external/testigos/sintesis/".strtolower(estadoStr($estado))."/".$fecha."/Primeras%20Planas.pdf'>Reporte&nbsp;".cuentanotas('6',$estado)."&nbsp;&nbsp;Notas</a>
							</div>
						<div class='content'>
				<div class='item'>
					COLUMNAS ".estadoStr($estado)."
				</div>
								<a class='button' href='http://187.247.253.5/external/testigos/sintesis/".strtolower(estadoStr($estado))."/".$fecha."/Columnas.pdf'>Reporte&nbsp;".cuentanotas('7',$estado)."&nbsp;&nbsp;Notas</a>
							</div>
						<div class='content'>
				<div class='item'>
					CARTONES ".estadoStr($estado)."
				</div>
								<a class='button' href='http://187.247.253.5/external/testigos/sintesis/".strtolower(estadoStr($estado))."/".$fecha."/Cartones.pdf'>Reporte&nbsp;".cuentanotas('8',$estado)."&nbsp;&nbsp;Notas</a>
							</div>
						<div class='content'>
							</div>
					</div>
	</center>

	</body>
</html>";


//echo $mensaje;

sendinblue($mensaje,estadoStr($estado));

function estadoStr($estado){
  $est="";
  switch ($estado) {
  	case '1':
  		$est="AGUASCALIENTES";
  	break;

  	case '2':
  		$est="BAJA CALIFORNIA";
  	break;

  	case '3':
  		$est="BAJA CALIFORNIA SUR";
  	break;

  	case '4':
  		$est="CAMPECHE";
  	break;

  	case '5':
  		$est="COAHUILA";
  	break;

  	case '6':
  		$est="COLIMA";
  	break;

  	case '7':
  		$est="CHIAPAS";
  	break;

  	case '8':
  		$est="CHIHUAHUA";
  	break;

  	case '9':
  		$est="CDMX";
  	break;

  	case '10':
  		$est="DURANGO";
  	break;

  	case '11':
  		$est="GUANAJUATO";
  	break;

  	case '12':
  		$est="GUERRERO";
  	break;

  	case '13':
  		$est="HIDALGO";
  	break;

    case '14':
      	$est="JALISCO";
    break;

  	case '15':
  		$est="EDO. MEX";
  	break;

  	case '16':
  		$est="MICHOACAN";
  	break;

  	case '17':
  		$est="MORELOS";
  	break;

  	case '18':
  		$est="NAYARIT";
  	break;

  	case '19':
  		$est="NUEVO LEÓN";
  	break;

  	case '20':
  		$est="OAXACA";
  	break;

  	case '21':
  		$est="PUEBLA";
  	break;

  	case '22':
  		$est="QUERETARO";
  	break;

  	case '23':
  		$est="QUINTANA ROO";
  	break;

  	case '24':
  		$est="SAN LUIS POTOSI";
  	break;

  	case '25':
  		$est="SINALOA";
  	break;

  	case '26':
  		$est="SONORA";
  	break;

  	case '27':
  		$est="TABASCO";
  	break;

  	case '28':
  		$est="TAMAULIPAS";
  	break;

  	case '29':
  		$est="TLAXCALA";
  	break;

  	case '30':
  		$est="VERACRUZ";
  	break;

  	case '31':
  		$est="YUCATAN";
  	break;

  	case '32':
  		$est="ZACATECAS";
  	break;


  }
  return $est;
}


function sendinblue($message,$estado){
    $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
    $etiqueta="Impresos-Sintesis Estatal-".ucwords(strtolower($estado));
    $data   = array(
        "to" => array(
        	"impresos@info-gacomunicacion.com" 	=> "impresos@info-gacomunicacion.com",
          	"jlga@gacomunicacion.com" 			=> "jlga@gacomunicacion.com",
        ),
        "cc" => array(
            "oortiz@gacomunicacion.com" 	=> "oortiz@gacomunicacion.com",
            "gmocarmona@gacomunicacion.com" => "gmocarmona@gacomunicacion.com",
            "rubend@gacomunicacion.com" 	=> "rubend@gacomunicacion.com",
            "creyes@gacomunicacion.com" 	=> "creyes@gacomunicacion.com",
            "fcocolina@gacomunicacion.com" 	=> "fcocolina@gacomunicacion.com",
            "paulina@gacomunicacion.com" 	=> "paulina@gacomunicacion.com",
            "alezama@gacomunicacion.com" 	=> "alezama@gacomunicacion.com",
            "ehb1703@gmail.com" 			=> "ehb1703@gmail.com",
        ),
        "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo de Medios"),
        "subject" => "Síntesis Estatal ".ucwords(strtolower($estado))." ".date("Y-m-d"),
        "html" => $message,
        "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => $etiqueta)
    );

    /*
     * ENVIANDO EMAIL...
     */
    var_dump($mailin->send_email($data));
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
};
?>