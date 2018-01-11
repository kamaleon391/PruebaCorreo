<?php
$fecha=  date("Y-m-d");
$mensaje="<style type='text/css'>
tr td{
	border:none;
	text-align:center;
}
table{
	border:#CCC solid thin;
	border-radius:5px;
}
.zona{
	background-color:white;
	color:#000;dc
	font-size:26px;
	font-weight:bold;
	text-align:center;
}
.estate{
	background-color:rgba(204, 204, 204, 0.33);
	color:#000;
	font-size:16px;
	font-weight:bold;
	text-align:center;
}

#logoC [alt]{
    font-family: Verdana, 'Lucida Grande';
    color: blue;
    font-size: 16px;
}
.linea{
	border-bottom: 1pt solid rgb(230, 230, 230);
	}

</style>


<table  width='80%' border='0'>
  <tr>
      <td colspan='4'><img src='http://200.53.59.226/services/CNS/other/img/cns.png' /></td>
  </tr>
  <tr>
    <td class='zona' colspan='4'><span class='zonaText'>ZONA NOROESTE</span></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Baja California</td>
    <td class='estate' colspan='2'>Baja California Sur</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California Sur'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California Sur'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California Sur'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California Sur'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California Sur'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California Sur'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Baja California Sur'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Chihuahua</td>
    <td class='estate' colspan='2'>Sinaloa</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chihuahua'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chihuahua'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sinaloa'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sinaloa'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chihuahua'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chihuahua'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sinaloa'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sinaloa'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chihuahua'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chihuahua'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sinaloa'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sinaloa'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chihuahua'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sinaloa'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Sonora</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sonora'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sonora'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sonora'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sonora'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sonora'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sonora'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Sonora'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <!--INICIO ZONA SIGUIENTE-->
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td class='zona' colspan='4'>ZONA NORESTE</td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Coahuila</td>
    <td class='estate'colspan='2'>Durango</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Coahuila'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Coahuila'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Durango'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Durango'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Coahuila'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Coahuila'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Durango'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Durango'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Coahuila'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Coahuila'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Durango'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Durango'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Coahuila'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Durango'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>".utf8_decode("Nuevo León")."</td>
    <td class='estate'colspan='2' >".utf8_decode("San Luis Potosí")."</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nuevo Leon'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nuevo Leon'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('San Luis Potosi'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('San Luis Potosi'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nuevo Leon'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nuevo Leon'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('San Luis Potosi'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('San Luis Potosi'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nuevo Leon'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nuevo Leon'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('San Luis Potosi'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('San Luis Potosi'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nuevo Leon'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('San Luis Potosi'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Tamaulipas</td>

  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tamaulipas'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tamaulipas'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tamaulipas'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tamaulipas'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tamaulipas'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tamaulipas'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tamaulipas'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  
  <tr>
    <td class='zona' colspan='4'>ZONA OCCIDENTE</td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Aguascalientes</td>
    <td class='estate'colspan='2'>Colima</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Aguascalientes'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Aguascalientes'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Colima'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Colima'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Aguascalientes'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Aguascalientes'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Colima'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Colima'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Aguascalientes'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Aguascalientes'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Colima'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Colima'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Aguascalientes'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Colima'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Guanajuato</td>
    <td class='estate'colspan='2'>Jalisco</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guanajuato'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guanajuato'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Jalisco'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Jalisco'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guanajuato'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guanajuato'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Jalisco'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Jalisco'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guanajuato'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guanajuato'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Jalisco'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Jalisco'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guanajuato'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Jalisco'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
 <tr>
    <td class='estate' colspan='2'>".utf8_decode("Michoacán")."</td>
    <td class='estate'colspan='2'>Nayarit</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Michoacan'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Michoacan'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nayarit'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nayarit'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Michoacan'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Michoacan'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nayarit'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nayarit'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Michoacan'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Michoacan'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nayarit'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nayarit'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Michoacan'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Nayarit'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
 
  <tr>
    <td class='estate' colspan='2'>".utf8_decode("Querétaro")."</td>
    <td class='estate'colspan='2'>Zacatecas</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Queretaro'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Queretaro'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Zacatecas'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Zacatecas'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Queretaro'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Queretaro'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Zacatecas'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Zacatecas'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Queretaro'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Queretaro'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Zacatecas'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Zacatecas'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Queretaro'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Zacatecas'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
 
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  
  
  <tr>
    <td class='zona' colspan='4'>ZONA SURESTE</td>
  </tr>
   <tr>
    <td class='estate' colspan='2'>Chiapas</td>
    <td class='estate'colspan='2'>Oaxaca</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chiapas'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chiapas'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Oaxaca'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Oaxaca'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chiapas'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chiapas'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Oaxaca'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Oaxaca'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chiapas'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chiapas'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Oaxaca'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Oaxaca'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Chiapas'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Oaxaca'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Quintana Roo</td>
    <td class='estate'colspan='2'>Tabasco</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Quintana Roo'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Quintana Roo'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tabasco'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tabasco'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Quintana Roo'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Quintana Roo'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tabasco'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tabasco'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Quintana Roo'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Quintana Roo'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tabasco'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tabasco'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Quintana Roo'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tabasco'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
 <tr>
    <td class='estate' colspan='2'>Veracruz</td>
    <td class='estate'colspan='2'>".utf8_decode("Yucatán")."</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Veracruz'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Veracruz'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Yucatan'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Yucatan'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Veracruz'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Veracruz'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Yucatan'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Yucatan'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Veracruz'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Veracruz'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Yucatan'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Yucatan'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Veracruz'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Yucatan'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td class='zona' colspan='4'>ZONA CENTRO</td>
  </tr>
   <tr>
    <td class='estate' colspan='2'>Distrito Federal</td>
    <td class='estate'colspan='2'>".utf8_decode("Estado de México")."</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Distrito Federal'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Distrito Federal'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Estado de Mexico'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Estado de Mexico'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Distrito Federal'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Distrito Federal'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Estado de Mexico'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Estado de Mexico'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Distrito Federal'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Distrito Federal'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Estado de Mexico'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Estado de Mexico'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Distrito Federal'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Estado de Mexico'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Guerrero</td>
    <td class='estate'colspan='2'>Hidalgo</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guerrero'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guerrero'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Hidalgo'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Hidalgo'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guerrero'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guerrero'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Hidalgo'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Hidalgo'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guerrero'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guerrero'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Hidalgo'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Hidalgo'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Guerrero'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Hidalgo'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
 <tr>
    <td class='estate' colspan='2'>Morelos</td>
    <td class='estate'colspan='2'>Puebla</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Morelos'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Morelos'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Puebla'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Puebla'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Morelos'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Morelos'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Puebla'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Puebla'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Morelos'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Morelos'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Puebla'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Puebla'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Morelos'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Puebla'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
  <tr>
    <td class='estate' colspan='2'>Tlaxcala</td>
  </tr>
  <tr>
    <td class='linea'>Primeras Planas</td>
    <td class='linea'>Menciones al Titular</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tlaxcala'))."&p=".base64_encode(base64_encode('1'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tlaxcala'))."&p=".base64_encode(base64_encode('5'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Seguridad y Justicia</td>
    <td class='linea'>Gobierno Federal</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tlaxcala'))."&p=".base64_encode(base64_encode('7'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tlaxcala'))."&p=".base64_encode(base64_encode('6'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Gobierno Estatal</td>
    <td class='linea'>Columnas</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tlaxcala'))."&p=".base64_encode(base64_encode('8'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tlaxcala'))."&p=".base64_encode(base64_encode('2'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
  </tr>
  <tr>
    <td class='linea'>Cartones</td>
    <td class='linea'>&nbsp;</td>
  </tr>
  <tr>
    <td class='linea'><a href='http://200.53.59.226/services/APP/lib/exportCns.php?e=".base64_encode(base64_encode('Tlaxcala'))."&p=".base64_encode(base64_encode('4'))."&f=".base64_encode(base64_encode($fecha))."'>PDF</a></td>
    <td class='linea'></td>
  </tr>
</table>";
correo($mensaje);     
//echo $mensaje;
function correo($mensaje){
   
require '../../php/PHPMailer/class.phpmailer.php';
            
     

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host     = "ssl://smtp.gmail.com";
$mail->Port     = 465;
$mail->SMTPAuth = true;
 
$mail->Username = "gaimpresos@gmail.com";
$mail->Password = "gaimpresos01";


//validacion------------------------------------------------>
$mail->AddBCC("validacion.admonitor@gmail.com");
$mail->AddBCC("editorial@admedios.com");
$mail->AddBCC("sistemas@admedios.com");

//GA
$mail->AddBCC('jlga@gacomunicacion.com');
$mail->AddBCC('gmocarmona@gacomunicacion.com');
$mail->AddBCC('fcocolina@gacomunicacion.com');
$mail->AddBCC('jlga@gacomunicacion.com');
$mail->AddBCC('oortiz@gacomunicacion.com');


//Clientes
$mail->AddCC("alezama@gacomunicacion.com");
$mail->AddCC("ocruzj@gmail.com");
$mail->AddCC("sintesiscns@gmail.com");

$mail->FromName = "MONITOREO DE PRENSA ";
 
$mail->Subject  = utf8_decode('Comisión Nacional de Seguridad- CNS ');  
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
