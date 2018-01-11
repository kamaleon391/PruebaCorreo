<?php
echo $hoy = date("Y-m-d");  
 echo "<br> 1 PRIMERAS PLANAS - <a href='exportTamaulipas.php?p=". base64_encode(base64_encode("1"))."&f=".$hoy."' target='_black'>PRIMERAS PLANAS </a>";
echo "<br> 2 COLUMNAS POLITICAS - <a href='exportTamaulipas.php?p=". base64_encode(base64_encode("2"))."&f=".$hoy."' target='_black'>COLUMNAS POLITICAS</a>";
echo "<br> 3 COLUMNAS FINACIERAS - <a href='exportTamaulipas.php?p=". base64_encode(base64_encode("3"))."&f=".$hoy."' target='_black'>COLUMNAS FINACIERAS</a>";
echo "<br> 4 COLUMNAS CARTOONES - <a href='exportTamaulipas.php?p=". base64_encode(base64_encode("4"))."&f=". $hoy."' target='_black'>COLUMNAS CARTOONES</a>";
echo "<br> 5 EGIDIO TORRE CANTU- <a href='exportTamaulipas.php?p=". base64_encode(base64_encode('5'))."&f=". $hoy."' target='_black'>EGIDIO TORRE CANTU-</a>";
echo "<br> 6 ADMINISTRACION ESTATAL: - <a href='exportTamaulipas.php?p=". base64_encode(base64_encode('6'))."&f=". $hoy."' target='_black'> ADMINISTRACION ESTATAL:</a>";

echo "<br> 7 TAMAULIPAS - <a href='exportTamaulipas.php?p=". base64_encode(base64_encode('7'))."&f=". $hoy."' target='_black'> TAMAULIPAS</a>";

 
?>