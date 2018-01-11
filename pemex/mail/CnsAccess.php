<?php
echo $hoy = date("Y-m-d");


 //echo "<br> 1 Primeras Planas - <a href='exportCns.php?p=". base64_encode(base64_encode("1"))."&f=".$hoy."&e=".base64_encode(base64_encode('jalisco'))."' target='_black'>Primeras Planas DF</a>";
 echo "<br> 1 Primeras Planas - <a href='exportCns.php?p=".base64_encode("1")."&f=".$hoy."&e=".base64_encode('jalisco')."' target='_black'>Primeras Planas DF</a>";




 echo "<br> 5 Monte Alejandro Rubido - <a href='exportCns.php?p=". base64_encode(base64_encode("5"))."&f=".$hoy."&e=".base64_encode(base64_encode('jalisco'))."' target='_black'> Monte Alejandro Rubido</a>";
 echo "<br> 6 Gobierno Federal - <a href='exportCns.php?p=". base64_encode(base64_encode("6"))."&f=".$hoy."' target='_black'> Gobierno Federal</a>";
 echo "<br> 7 Seguridad y Justicia - <a href='exportCns.php?p=". base64_encode(base64_encode("7"))."&f=".$hoy."' target='_black'> Seguridad y Justicia</a>";
 echo "<br> 8 Gobierno Estatal - <a href='exportCns.php?p=". base64_encode(base64_encode("8"))."&f=".$hoy."' target='_black'> Gobierno Estatal</a>";

   
?>