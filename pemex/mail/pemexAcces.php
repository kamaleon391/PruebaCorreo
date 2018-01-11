<?php
echo $hoy = date("Y-m-d");  
 echo "<br> 1 PEMEX DIA - <a href='exportPemex.php?p=". base64_encode(base64_encode("1"))."&f=".$hoy."' target='_black'>PEMEX DIA </a>";
echo "<br> 2 PEMEX MENSUAL - <a href='exportPemex.php?p=". base64_encode(base64_encode("2"))."&f=".$hoy."' target='_black'>PEMEX MENSUAL</a>";

   
?>