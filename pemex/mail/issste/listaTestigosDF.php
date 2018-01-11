<?php

require_once '/var/www/external/services/mail/library/Mailin.php';
require_once '/var/www/external/services/mail/funciones_export.php';

/*
 * FUNCION PARA EXTRAER EL MES DE UNA FECHA
 */
function mes($fecha){
  list($a,$m,$d) = explode("-", $fecha);
  return $m;
}

/*
 * INICIA LA PREPARACION DEL MENSAJE A ENVIAR
 */
$mensaje    = file_get_contents('/var/www/external/services/mail/issste/cdmx.html'); // OBTENER LA PRIMERA PARTE DEL MENSAJE
$mensaje    = str_replace( '[[[--MIN--]]]', 'issste' , $mensaje );
$mensaje    = str_replace( '[[[--MAY--]]]', 'ISSSTE' , $mensaje );
$directorio = opendir('/var/www/external/testigos/issste/df/'.date('m').'/'.date('Y-m-d') ); //RUTA ACTUAL

while ( $archivo = readdir( $directorio ) ) {    // BUCLE PARA CONSTRUIR PARTE DINAMICA DEL MENSAJE
    if (!is_dir($archivo) && $archivo[0]!=".") {  //  VERIFICA NO ES DIRECTORIO
      $mensaje .= "<tr>
        <td>&nbsp;</td>
          <td colspan='5'><a href='http://187.247.253.5/external/testigos/issste/df/".date('m')."/".date('Y-m-d')."/".$archivo."'><img src='http://187.247.253.5/external/services/mail/issste/icon.png' width='25' height='25'>".$archivo."</a><br><br></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>";
    }
} 
$mensaje.="<tr bgcolor='#CCCCCC'>
		    <td>&nbsp;</td>
		    <td colspan='2'>&nbsp;</td>
		    <td colspan='6'> ".mostrar_fecha_completa(Date('Y-m-d'))."</td></tr></table>"; // FINALIZA CREACION DEL MENSAJE 

/*
 * PREPARACION DEL ENVIO
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
        "to" => array(
            "sintesisissste@issste.gob.mx" => "sintesisissste@issste.gob.mx",
            "judithross883@gmail.com" => "judithross883@gmail.com",
            "leonardo_rosasramirez@yahoo.com.mx" => "leonardo_rosasramirez@yahoo.com.mx"
         ),
        //"cc" => array("raulbeyruti@gmail.com" => "raulbeyruti@gmail.com"),
        "bcc" => array(
          'jlga@gacomunicacion.com' => 'jlga@gacomunicacion.com',
          'gmocarmona@gacomunicacion.com' => 'gmocarmona@gacomunicacion.com',
          'fcocolina@gacomunicacion.com' => 'fcocolina@gacomunicacion.com',
          'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com',
          'rubend@gacomunicacion.com' => 'rubend@gacomunicacion.com',
          'rubendiazramirez@gmail.com' => 'rubendiazramirez@gmail.com',
          'ehb1703@icloud.com' => 'ehb1703@icloud.com',
          'edgarh@gacomunicacion.com' => 'edgarh@gacomunicacion.com',
          'paulina@gacomunicacion.com' => 'paulina@gacomunicacion.com',
          'mariob@gacomunicacion.com' => 'mariob@gacomunicacion.com',
          'vazquezoliver@gmail.com' => 'vazquezoliver@gmail.com',
          'carloshreyes@gmail.com' => 'carloshreyes@gmail.com'
          ),
        "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
        "subject" => "ISSSTE - Testigos CDMX",
        "html" => $mensaje,
        "headers" => array("Content-Type"=> "text/html; charset=UTF-8")
    );
/*
 * ENVIO...
 */
var_dump($mailin->send_email($data));
