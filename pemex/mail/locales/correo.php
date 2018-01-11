<?php
$fecha=  date("Y-m-d");
/*
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
</style>
<table width='400px' align='center' cellspacing='0' border='0' style='font-size: 13px;border: solid 1px gray;'>
  <tr>
    <td width='3%'>&nbsp;</td>
    <td colspan='4'></td>
    <td width='2%'>&nbsp;</td>
    <td width='3%'>&nbsp;</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</td>
 <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</td>
    <tr>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        <td style='border-bottom: 1pt solid rgb(230, 230, 230);'></td>
        <td width='10%'  style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>PRENSA</b></td>
    </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >STPS</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportSCT.php?p=".base64_encode(base64_encode('3'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >PRIMERAS PLANAS</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportSCT.php?p=".base64_encode(base64_encode('1'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >".utf8_decode("COLUMNAS POLITÍCAS")."</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportSCT.php?p=".base64_encode(base64_encode('2'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >CARTONES</td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);' ><a href='http://187.247.253.5/external/services/mail/exportSCT.php?p=".base64_encode(base64_encode('4'))."&f=$fecha'>REPORTE</a></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</td>
</table>";
*/

$mensaje='<style>
@import "http://fonts.googleapis.com/css?family=Montserrat:300,400,700";
.rwd-table {
  margin: 1em 0;
  min-width: 300px;
  background-color:#ECECEC;
}
.rwd-table tr {
  border-top: 1px solid #46627f;
  border-bottom: 1px solid #46627f;
}
.rwd-table th {
  display: none;
}
.rwd-table td {
  display: block;
}
.rwd-table td:first-child {
  padding-top: .5em;
}
.rwd-table td:last-child {
  padding-bottom: .5em;
}
.rwd-table td:before {
  content: attr(data-th) ": ";
  font-weight: bold;
  width: 6.5em;
  display: inline-block;
}
@media (min-width: 480px) {
  .rwd-table td:before {
    display: none;
  }
}
.rwd-table th, .rwd-table td {
  text-align: left;
}
@media (min-width: 480px) {
  .rwd-table th, .rwd-table td {
    display: table-cell;
    padding: .25em .5em;
  }
  .rwd-table th:first-child, .rwd-table td:first-child {
    padding-left: 0;
  }
  .rwd-table th:last-child, .rwd-table td:last-child {
    padding-right: 0;
  }
}

body {
  padding: 0 2em;
  font-family: Montserrat, sans-serif;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  color: #444;
  background: #fff;
}

h1 {
  font-weight: normal;
  letter-spacing: -1px;
  color: #34495E;
}

.rwd-table {
  background: #ECECEC;
  color: #000;
  border-radius: .4em;
  overflow: hidden;
}
.rwd-table tr {
  border-color: #46627f;
}
.rwd-table th, .rwd-table td {
  margin: .5em 1em;
}
@media (min-width: 480px) {
  .rwd-table th, .rwd-table td {
    padding: 1em !important;
  }
}
.rwd-table th, .rwd-table td:before {
  color: #1E5A63;
}
a{
    color:#1E5A63;
    /*text-decoration:none;*/
}
</style>
   <h1><img src="http://187.247.253.5/external/services/mail/locales/logo2.jpg"></h1>
<table class="rwd-table">
    <tr>
        <th colspan="3" style="background-color:#ccc;text-align:center;" data-th="Movie Title">STPS</th>
    </tr>
  <tr>
    <th>Tema</th>
    <th>Recorte</th>
    <!--<!--th>Original</th>-->
  </tr>
  <tr>  
  </tr>
  <tr>
    <td data-th="Secretario del Trabajo">Alfonso Navarrete Prida</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=1&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
    <td data-th="Secretaria">STPS</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=2&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
    <th colspan="3" style="background-color:#ccc;text-align:center;" data-th="Cliente">SEGOB</th>
  </tr>
  <tr>
    <th>Tema</th>
    <th>Recorte</th>
    <!--th>Original</th>-->
  </tr>
  <tr>
  </tr>
  <tr>
    <td data-th="'.  utf8_decode('Secretario de Gobernación').'">'.  utf8_decode('Miguel Ángel Osorio Chong').'</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=3&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
    <td data-th="Secretaria">SEGOB</td>
    <td data-th="Recorte"><a href=http://187.247.253.5/external/services/mail/locales/recortes.php?opc=4&f='.DATE('Y-m-d').'>Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
    <th colspan="3" style="background-color:#ccc;text-align:center;" data-th="Cliente">TAMAULIPAS</th>
  </tr>
  <tr>
    <th>Tema</th>
    <th>Recorte</th>
    <!--th>Original</th>-->
  </tr>
  <tr>
  </tr>
  <tr>
    <td data-th="'.  utf8_decode('Gobernador').'">'.  utf8_decode('Egidio Torre Cantú').'</td>
    <td data-th="Recorte"><a href=""http://187.247.253.5/external/services/mail/locales/recortes.php?opc=5&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
    <td data-th="Estado">Tamaulipas</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=6&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
    <th colspan="3" style="background-color:#ccc;text-align:center;" data-th="Cliente">SCT</th>
  </tr>
  <tr>
    <th>Tema</th>
    <th>Recorte</th>
    <!--th>Original</th>-->
  </tr>
  <tr>
  </tr>
  <tr>
    <td data-th="'.  utf8_decode('Secretario de Comunicaciones').'">'.  utf8_decode('Gerardo Ruiz esparza').'</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=7&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
    <td data-th="Secretaria">SCT</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=8&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
  
    <th colspan="3" style="background-color:#ccc;text-align:center;" data-th="Cliente">LICONSA</th>
  </tr>
  <tr>
    <th>Tema</th>
    <th>Recorte</th>
    <!--th>Original</th>-->
  </tr>
  <tr>
  </tr>
  <tr>
    <td data-th="'.  utf8_decode('Director').'">'.  utf8_decode('Hector Haro Ramírez Puga Leyva').'</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=9&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td> -->
  </tr>
  <tr>
    <td data-th="Secretaria">LICONSA</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=10&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <!--td data-th="Original"><a href="#">Reporte</a></td-->
  </tr>
 
</table> 


<p>'.  utf8_decode('GRUPO ARTE Y COMUNICACIÓN 2014').'</p>';
//correo($mensaje);
echo $mensaje;  


function correo($mensaje){
   
    
require "/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php";  

$mail = new PHPMailer();
$mail->IsSMTP();

/*
$mail->Host     = "pro.turbo-smtp.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "VBHYxToX";
*/

$mail->Host     = "smtp.gacomunicacion.com";
$mail->Port     = 587;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gacomunicacion.com";
$mail->Password = "Gagdl1";

// $mail->addAddress('edgarh@gacomunicacion.com', 'Edgar Oswaldo Hernánde Barajas');
// $mail->addAddress('ricardom@gacomunicacion.com', 'Ricardo Madrigal Rodriguez (Sauron)');
// $mail->addAddress('mariob@gacomunicacion.com', 'Mario Alberto Badillo (Hobbit)');


$mail->AddBCC("jlga@gacomunicacion.com");
$mail->AddBCC("gmocarmona@gacomunicacion.com");
$mail->AddBCC("fcocolina@gacomunicacion.com");
$mail->AddBCC("alezama@gacomunicacion.com");
 
$mail->AddBCC("oortiz@gacomunicacion.com");
//Ga Guadalajara
$mail->AddBCC("rubend@gacomunicacion.com");
$mail->AddBCC("edgarh@gacomunicacion.com");
$mail->AddBCC("jesush@gacomunicacion.com");
$mail->AddBCC("ricardom@gacomunicacion.com");
$mail->AddBCC("mariob@gacomunicacion.com");

// $mail->AddBCC("ehb1703@me.com");

  $mail->From = 'gaimpresos@gacomunicacion.com';
  $mail->FromName = "MONITOREO DE PRENSA ".date("Y-m-d");
 
$mail->Subject  = "Reporte Recortes";
$mail->WordWrap = 50;
 
// Correo destino

$mail->IsHTML(TRUE);
 
$mail->Body = $mensaje;
 
if(!$mail->Send()) {
    echo "Error: " . $mail->ErrorInfo;
} else {
    echo "Mensaje enviado";
}
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

 <!--
  <tr>
    <th colspan="3" style="background-color:#ccc;text-align:center;" data-th="Cliente">SEDESOL</th>
  </tr>
  <tr>
    <th>Tema</th>
    <th>Recorte</th>
    <th>Original</th>
  </tr>
  <tr>
  </tr>
  <tr>
    <td data-th="'.  utf8_decode('Secratria ').'">'.  utf8_decode('Rosario Robles Berlanga').'</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=11&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <td data-th="Original"><a href="#">Reporte</a></td>
  </tr>
  <tr>
    <td data-th="SEDESOL">SEDESOL</td>
    <td data-th="Recorte"><a href="http://187.247.253.5/external/services/mail/locales/recortes.php?opc=12&f='.DATE('Y-m-d').'" target="_blank">Reporte</a></td>
    <td data-th="Original"><a href="#">Reporte</a></td>
  </tr>-->
 
 