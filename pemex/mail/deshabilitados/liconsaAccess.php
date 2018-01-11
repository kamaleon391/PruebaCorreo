<?php
echo $hoy = date("Y-m-d");  
 echo "<br> 1 PRIMERAS PLANAS - <a href='exportLiconsa.php?p=". base64_encode(base64_encode("1"))."&f=".$hoy."' target='_black'>PRIMERAS PLANAS </a>";
echo "<br> 2 COLUMNAS POLITICAS - <a href='exportLiconsa.php?p=". base64_encode(base64_encode("2"))."&f=".$hoy."' target='_black'>COLUMNAS POLITICAS</a>";
echo "<br> 3 COLUMNAS FINACIERAS - <a href='exportLiconsa.php?p=". base64_encode(base64_encode("3"))."&f=".$hoy."' target='_black'>COLUMNAS FINACIERAS</a>";
echo "<br> 4 COLUMNAS CARTOONES - <a href='exportLiconsa.php?p=". base64_encode(base64_encode("4"))."&f=". $hoy."' target='_black'>COLUMNAS CARTOONES</a>";
echo "<br> 5 DIRECTOR - Héctor Pablo Ramírez - <a href='exportLiconsa.php?p=". base64_encode(base64_encode('5'))."&f=". $hoy."' target='_black'> DIRECTOR - Héctor Pablo Ramírez</a>";
echo "<br> 6 GERENCIA LICONSA - <a href='exportLiconsa.php?p=". base64_encode(base64_encode('6'))."&f=". $hoy."' target='_black'> GERENCIA LICONSA</a>";
echo "<br> 7 LICONSA - <a href='exportLiconsa.php?p=". base64_encode(base64_encode('7'))."&f=". $hoy."' target='_black'>  LICONSA </a>";
echo "<br> 8 LECHE - <a href='exportLiconsa.php?p=". base64_encode(base64_encode('8'))."&f=". $hoy."' target='_black'> LECHE</a>";
echo "<br> 10 VARIOS TEMAS - <a href='exportLiconsa.php?p=". base64_encode(base64_encode('10'))."&f=". $hoy."' target='_black'> VARIOS TEMAS </a>";
?>