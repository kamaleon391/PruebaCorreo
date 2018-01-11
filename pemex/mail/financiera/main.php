<?php

//mandamos ejecutar el correo
require "/var/www/external/services/mail/financiera/enviaPDF.php";

//30 SEGUNDOS DESPUES EJECUTAMOS EL ENVIO
sleep(30);

//mandamos ejecutar el correo
require "/var/www/external/services/mail/financiera/correo.php";