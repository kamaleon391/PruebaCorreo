<?php
require '/var/www/external/services/mail/library/Mailin.php';
require '/var/www/external/services/mail/conexion.php';
require 'querysPres.php';

$fecha=  date("Y-m-d");

$mensaje = "<style>body{font-family: Century gothic;
font-size: 10px;}tr {
border-bottom: 1pt solid black;
}</style><table width='400px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;
'>
  <tr>
    <td colspan='3' align='center'><img src='http://187.247.253.5/external/services/mail/presidencia/Logo.png'></td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <th colspan='3' style='background:#D8D8D8; text-align: left; padding-left: 20px;'>Estados</th>
</tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Aguascalientes</td>";

    if(numberNotes(1, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('1'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Baja California</td>";

    if(numberNotes(2, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('2'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Baja California Sur</td>";

    if(numberNotes(3, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('3'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Campeche</td>";

    if(numberNotes(4, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('4'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
   <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Chiapas</td>";

    if(numberNotes(7, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('7'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Chihuahua</td>";

    if(numberNotes(8, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('8'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Coahuila</td>";

    if(numberNotes(5, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('5'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Colima</td>";

    if(numberNotes(6, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('6'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Durango</td>";

    if(numberNotes(10, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('10'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".htmlentities("Estado de México")."</td>";

    if(numberNotes(15, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('15'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
   <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Guanajuato</td>";

    if(numberNotes(11, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('11'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Guerrero</td>";

    if(numberNotes(12, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('12'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Hidalgo</td>";

    if(numberNotes(13, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('13'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Jalisco</td>";

    if(numberNotes(14, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('14'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".htmlentities("Michoacán")."</td>";

    if(numberNotes(16, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('16'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Morelos</td>";

    if(numberNotes(17, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('17'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Nayarit</td>";

    if(numberNotes(18, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('18'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".htmlentities("Nuevo León")."</td>";

    if(numberNotes(19, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('19'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Oaxaca</td>";

    if(numberNotes(20, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('20'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Puebla</td>";

    if(numberNotes(21, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('21'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".htmlentities("Querétaro")."</td>";

    if(numberNotes(22, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('22'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Quintana Roo</td>";

    if(numberNotes(23, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('23'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>".htmlentities("San Luis Potosí")."</td>";

    if(numberNotes(24, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('24'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Sinaloa</td>";

    if(numberNotes(25, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('25'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Sonora</td>";

    if(numberNotes(26, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('26'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Tabasco</td>";

    if(numberNotes(27, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('27'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Tamaulipas</td>";

    if(numberNotes(28, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('28'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Tlaxcala</td>";

    if(numberNotes(29, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('29'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Veracruz</td>";

    if(numberNotes(30, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('30'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Yucatán</td>";

    if(numberNotes(31, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('31'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td width='75%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>Zacatecas</td>";

    if(numberNotes(32, $fecha))
      $mensaje .= "<td width='20%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/presidencia/exportPres.php?e=".base64_encode(base64_encode('32'))."&f=$fecha'>PDF</a></td>";
    else
      $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
  
  $mensaje .= "
  </tr>
  <tr>  
      <td colspan='7' style='text-align: right;'><span style='text-align: right;font-size: 8px;color: rgb(139, 139, 139);'>  Grupo Arte y Comunicaci&oacute;n &copy; ".date("Y")."</span></td>
    </td>
  </tr>  
</table>
<br><br>
<div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://187.247.253.5/siscap.la/public/boards/presidencia'>Sistema de Información</a></div>
";


//enviaReporte($mensaje);
//echo($mensaje);     

sendinblue($mensaje);

function sendinblue($mensaje){
/*
 * PREPARACION DEL ENVIO
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data = array(
         //"cc" => array("raulbeyruti@gmail.com" => "raulbeyruti@gmail.com"),
        "bcc" => array(
           "gmocarmona@gacomunicacion.com"=>"gmocarmona@gacomunicacion.com",
           "fcocolina@gacomunicacion.com"=>"fcocolina@gacomunicacion.com",
           "jlga@gacomunicacion.com"=>"jlga@gacomunicacion.com",
           "oortiz@gacomunicacion.com"=>"oortiz@gacomunicacion.com",
           "alezama@gacomunicacion.com"=>"alezama@gacomunicacion.com",
           "rubend@gacomunicacion.com"=>"rubend@gacomunicacion.com",
           "edgarh@gacomunicacion.com"=>"edgarh@gacomunicacion.com",
           'ehb1703@icloud.com'=>"ehb1703@icloud.com",
           "danielmontiel.am@gmail.com"=>"danielmontiel.am@gmail.com",
           "merlos_dg@hotmail.com"=>"merlos_dg@hotmail.com",
           "paloma_sanchezr@hotmail.com"=>"paloma_sanchezr@hotmail.com",
           "jose.dominguez@presidencia.gob.mx"=>"jose.dominguez@presidencia.gob.mx",
           "carloshreyes@gmail.com"=>"carloshreyes@gmail.com",
           "alezamavaldez@gmail.com"=>"alezamavaldez@gmail.com",
            
           "mariob@gacomunicacion.com"=>"mariob@gacomunicacion.com",
           'julio.orquiz@gmail.com' => 'julio.orquiz@gmail.com'
          ),
        "from" => array("gaimpresos@gacomunicacion.com", "Presidencia de la Republica"),
        "subject" =>  "Presidencia de la Republica ",
        "html" => $mensaje,
        "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-Presidencia")
    );
/*
 * ENVIO...
 */
var_dump($mailin->send_email($data));

}
function enviaReporte($mensaje){
   
require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";  

$mail = new PHPMailer();
$mail->IsSMTP();

   
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "gaimpresos@gmail.com";  // GMAIL username
  $mail->Password   = "Gacomunicacion#@2014";   

/*
  $mail->Host     = "smtp.gacomunicacion.com";
  $mail->Port     = 587;
  $mail->SMTPAuth = true;
  $mail->Username = "prensa@gacomunicacion.com";
  $mail->Password = "periodico123";
*/
//GA
//
/*
$mail->AddBCC("gmocarmona@gacomunicacion.com");
$mail->AddBCC("fcocolina@gacomunicacion.com");
$mail->AddBCC("jlga@gacomunicacion.com");
$mail->AddBCC("oortiz@gacomunicacion.com");
$mail->AddBCC("alezama@gacomunicacion.com");
$mail->AddBCC("rubend@gacomunicacion.com");
$mail->AddBCC("edgarh@gacomunicacion.com");
$mail->AddBCC('ehb1703@icloud.com');
$mail->AddBCC("danielmontiel.am@gmail.com");
$mail->AddBCC("merlos_dg@hotmail.com");
$mail->AddBCC("paloma_sanchezr@hotmail.com");
$mail->AddBCC("jose.dominguez@presidencia.gob.mx");
$mail->AddBCC("carloshreyes@gmail.com");
$mail->AddBCC("alezamavaldez@gmail.com");

$mail->AddBCC("mariob@gacomunicacion.com");
*/
$mail->AddBCC("julio.orquiz@gmail.com");
$mail->From = 'gaimpresos@gacomunicacion.com';
$mail->FromName = utf8_decode("Presidencia de la República");
 
$mail->Subject  = utf8_decode("Presidencia de la República ".date("Y-m-d"));  
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


function mostrar_fecha_completa($fecha)
{
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
