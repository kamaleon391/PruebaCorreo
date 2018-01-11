<?php
$directorio=opendir("http://mival.mx/pulso/Pdfs/Interactiva/SeccA/FLASH/Files/"); 
echo "<b>Directorio actual:</b><br>$dir<br>"; 
echo "<b>Archivos:</b><br>"; 
while ($archivo = readdir($directorio))
  echo "$archivo<br>"; 
closedir($directorio); 
?>