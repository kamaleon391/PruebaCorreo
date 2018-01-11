<?php
echo $hoy = date("2014-03-03");
echo $hoy2 = date("2014-03-04");  
echo $hoy3 = date("2014-03-05");  
 echo "<br> 1 Marihuana - <a href='exportSalud.php?p=". base64_encode(base64_encode("1"))."&f=".$hoy."' target='_black'>03 Marzo DF </a>";
 echo "<br> 1 Marihuana - <a href='exportSalud.php?p=". base64_encode(base64_encode("1"))."&f=".$hoy2."' target='_black'>04 Marzo  DF</a>";
 echo "<br> 1 Marihuana - <a href='exportSalud.php?p=". base64_encode(base64_encode("1"))."&f=".$hoy3."' target='_black'>05 Marzo DF </a>";

   
?>