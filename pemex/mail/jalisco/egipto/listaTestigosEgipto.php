<?php
$directorio = "";

$mensaje="<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'><style type='text/css'>
		a:link { color: rgb(33, 194, 65);
		margin-left: 36px;
		font-size: 13px; font-weight: bold;}
		.especial:link { color: green; font-weight: bold;}
		#logoC{
		background-repeat: no-repeat;
		border: white solid thin;
		}
		#logoC [alt]{
		    font-family: Verdana, 'Lucida Grande';
		    color: blue;
		    font-size: 16px;
		}
		</style>
		<table width= '500px;' border='0' cellspacing='0' style='border: #CCC solid;font-family: century gothic;font-size: 15px;-moz-border-radius: 7px;-webkit-border-radius: 7px;border-radius: 7px; text-align: center;' align='center' >
		  <tr>
		    <td colspan='8' style='background-color: rgb(252, 252, 252);' align='center'><img id='logoC' src='http://187.247.253.5/external/services/mail/jalisco/logoGA2.png'  ></td>
		  </tr>
		  <tr>
		    <td colspan='8' align='center'><span style='font-weight: bold; font-size: 20px;'>MONITOREO DE PRENSA</span></td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		     <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		  </tr>
		  <tr></tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><h5>Testigos Incidente en Egipto</h5></td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		  </tr>";

$mensaje .= "<tr> <td>&nbsp;</td>
                  <td>Medios del D.F.</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
             </tr>";

$directorio = opendir("/var/www/external/testigos/Jalisco/Egipto/df"); //ruta actual

while(  $archivo = readdir(  $directorio  )  ) { //obtenemos un archivo y luego otro sucesivamente
  if( !is_dir( $archivo )   &&  $archivo[0]  !=  "."  ) { //verificamos si es o no un directorio
      $mensaje.="<tr> <td>&nbsp;</td>
                      <td colspan='5'><a href='http://187.247.253.5/external/testigos/Jalisco/Egipto/df/".$archivo."'><img src='icon.png' width='25' height='25'>".$archivo."</a><br><br></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                 </tr>";
   }
}

$mensaje .= "<tr> <td>&nbsp;</td>
                  <td>Medios de Jalisco</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
             </tr>";
$directorio = opendir("/var/www/external/testigos/Jalisco/Egipto/jal"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
  if (!is_dir($archivo) && $archivo[0]!=".")//verificamos si es o no un directorio
  {
    $mensaje.="<tr> <td>&nbsp;</td>
                    <td colspan='5'><a href='http://187.247.253.5/external/testigos/Jalisco/Egipto/jal/".$archivo."'><img src='icon.png' width='25' height='25'>".$archivo."</a><br><br></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
              </tr>";
  }
} 

$mensaje.="<tr bgcolor='#CCCCCC'>
	   			    <td>&nbsp;</td>
	 	   		    <td colspan='2'>&nbsp;</td>
			   	    <td colspan='6'> ".mostrar_fecha_completa(Date('Y-m-d'))."</td>
				     </tr>
				    </table>";
echo $mensaje;


function mes(  $fecha  ){
  list( $a , $m, $d ) = explode( "-", $fecha  );
  return $m;
}

function mostrar_fecha_completa(  $fecha  ) {
    $subfecha = explode( "-" , $fecha ); 
 
    $año=$subfecha[0];
    $mes=$subfecha[1];
    $dia=$subfecha[2];

    $dia2=date( "d", mktime(0,0,0,$mes,$dia,$año));
    $mes2=date( "m", mktime(0,0,0,$mes,$dia,$año));
    $año2=date( "Y", mktime(0,0,0,$mes,$dia,$año));
    $dia_sem=date( "w", mktime(0,0,0,$mes,$dia,$año));

    switch(  $dia_sem  ) { 
       case "0":  $dia_sem3  = 'Domingo'; 
                  break; 
       case "1":  $dia_sem3  = 'Lunes'; 
                  break; 
       case "2":  $dia_sem3  = 'Martes'; 
                  break; 
       case "3":  $dia_sem3  = 'Miercoles'; 
                  break; 
       case "4":  $dia_sem3  = 'Jueves'; 
                  break;
       case "5":  $dia_sem3  = 'Viernes'; 
                  break; 
       case "6":  $dia_sem3  = 'Sabado'; 
                  break; 
       default: 
    };

    switch(  $mes2  )  { 
        case "1": $mes3   = 'Enero'; 
                  break; 
        case "2": $mes3   = 'Febrero';
                  break; 
        case "3": $mes3   = 'Marzo';
                  break; 
        case "4": $mes3   = 'Abril'; 
                  break;  
        case "5": $mes3   = 'Mayo';
                  break;   
        case "6": $mes3   = 'Junio';    
                  break; 
        case "7": $mes3   = 'Julio';
                  break;
        case "8": $mes3   = 'Agosto';
                  break; 
        case "9": $mes3   = 'Septiembre';
                  break; 
        case "10": $mes3  = 'Octubre';
                   break; 
        case "11": $mes3  = 'Noviembre';
                   break;           
        case "12": $mes3  = 'Diciembre';  
                   break; 
        default:   break; 
  }; 

  $fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;
  return $fecha_texto;
};

exit(0);
?>