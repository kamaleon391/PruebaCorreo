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
$mensaje    = file_get_contents('/var/www/external/services/mail/tianguis/cdmx.html'); // OBTENER LA PRIMERA PARTE DEL MENSAJE
$mensaje    = str_replace( '[[[--MIN--]]]', 'tianguis' , $mensaje );
$mensaje    = str_replace( '[[[--MAY--]]]', 'Tianguis Turístico' , $mensaje );
$directorio = opendir('/var/www/external/testigos/tianguis/df/'.date('m').'/'.date('Y-m-d') ); //RUTA ACTUAL

while ( $archivo = readdir( $directorio ) ) {    // BUCLE PARA CONSTRUIR PARTE DINAMICA DEL MENSAJE
    if (!is_dir($archivo) && $archivo[0]!=".") {  //  VERIFICA NO ES DIRECTORIO
      $mensaje .= "<tr>
        <td>&nbsp;</td>
          <td colspan='5'><a href='http://187.247.253.5/external/testigos/tianguis/df/".date('m')."/".date('Y-m-d')."/".$archivo."'><img src='http://187.247.253.5/external/services/mail/issste/icon.png' width='25' height='25'>".$archivo."</a><br><br></td>
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
         ),
        //"cc" => array("raulbeyruti@gmail.com" => "raulbeyruti@gmail.com"),
        "bcc" => array(
          'gerencia@laspalomashotel.com.mx' => 'gerencia@laspalomashotel.com.mx',
          'doninoangel@hotmail.com' => 'doninoangel@hotmail.com',
          'presidencia@ahmemac.org' => 'presidencia@ahmemac.org',
          'logistica@amhm.org' => 'logistica@amhm.org',
          'dechoco@live.com.mx' => 'dechoco@live.com.mx',
          'roduma@prodigy.net.mx' => 'roduma@prodigy.net.mx',
          'mansioniturbe@prodigy.net.mx' => 'mansioniturbe@prodigy.net.mx',
          'fcomtzdl@hotmail.com' => 'fcomtzdl@hotmail.com',
          'socios@amhm.org' => 'socios@amhm.org',
          'administrativo@amhm.org' => 'administrativo@amhm.org',
          'gfhigareda@yahoo.com.mx' => 'gfhigareda@yahoo.com.mx',
          'direccion@stanzahotel.com' => 'direccion@stanzahotel.com',
          'presidenciaamhags@prodigy.net.mx' => 'presidenciaamhags@prodigy.net.mx',
          'jjfernandezc@yahoo.com' => 'jjfernandezc@yahoo.com',
          'angeles00_6@hotmail.com' => 'angeles00_6@hotmail.com',
          'villarbrisom@yahoo.com.mx' => 'villarbrisom@yahoo.com.mx',
          'elcoraldelodemarcos@outlook.com' => 'elcoraldelodemarcos@outlook.com',
          'rafael.gago52@yahoo.com.mx' => 'rafael.gago52@yahoo.com.mx',
          'hotel_imperia43@hotmail.com' => 'hotel_imperia43@hotmail.com',
          'hotelplazavizcaya@prodigy.net.mx' => 'hotelplazavizcaya@prodigy.net.mx',
          'luis_hs@terra.com.mx' => 'luis_hs@terra.com.mx',
          'goka@enmediodelanada.com' => 'goka@enmediodelanada.com',
          'jtorres@hoteldelrio.com.mx' => 'jtorres@hoteldelrio.com.mx',
          'dircomercial@sogoeee.com' => 'dircomercial@sogoeee.com',
          'subpromocion@gmail.com' => 'subpromocion@gmail.com',
          'atencioninversiones@gmail.com' => 'atencioninversiones@gmail.com',
          'ecsecturedomex@gmail.com' => 'ecsecturedomex@gmail.com',
          'santiago.gonzalez@yucatan.gob.mx' => 'santiago.gonzalez@yucatan.gob.mx',
          'cgonzalez.sefotur@gmail.com' => 'cgonzalez.sefotur@gmail.com',
          'edna.gutierrez@sinaloa.gob.mx' => 'edna.gutierrez@sinaloa.gob.mx',
          'jcvalle@turismoslp.com.mx' => 'jcvalle@turismoslp.com.mx',
          'mauriciorg@mexicocity.gob.mx' => 'mauriciorg@mexicocity.gob.mx',
          'fbaeza@queretaro.gob.mx' => 'fbaeza@queretaro.gob.mx',
          'jortegon@hotmail.com.mx' => 'jortegon@hotmail.com.mx',
          'mary.xolo@hotmail.com' => 'mary.xolo@hotmail.com',
          'rmarrufo@caribemexicano.travel' => 'rmarrufo@caribemexicano.travel',
          'sergioglez75@gmail.com' => 'sergioglez75@gmail.com',
          'turismohidalgorp@hotmail.com' => 'turismohidalgorp@hotmail.com',
          'msantisteban@visitbajasur.travel' => 'msantisteban@visitbajasur.travel',
          'jlortizzz15@hotmail.com' => 'jlortizzz15@hotmail.com',
          'rvazquezl@guanajuato.gob.mx' => 'rvazquezl@guanajuato.gob.mx',
          'turismo@edomex.gob.mx' => 'turismo@edomex.gob.mx',
          'lucero.grm@gmail.com' => 'lucero.grm@gmail.com',
          'miguel.lopez@coahuila.gob.mx' => 'miguel.lopez@coahuila.gob.mx',
          'promo.nac.oax@gmail.com' => 'promo.nac.oax@gmail.com',
          'agrajales@caribemexicano.travel' => 'agrajales@caribemexicano.travel',

          'alinam@gacomunicacion.com' => 'alinam@gacomunicacion.com',
          'jlga@gacomunicacion.com' => 'jlga@gacomunicacion.com',
          'alezama@gacomunicacion.com' => 'alezama@gacomunicacion.com',
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
          'carloshreyes@gmail.com' => 'carloshreyes@gmail.com',
	  'secturcolima2016@gmail.com'=>'secturcolima2016@gmail.com'
          ),
        "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
        "subject" => "Tianguis Turístico - Testigos CDMX",
        "html" => $mensaje,
        "headers" => array("Content-Type"=> "text/html; charset=UTF-8")
    );
/*
 * ENVIO...
 */
var_dump($mailin->send_email($data));
