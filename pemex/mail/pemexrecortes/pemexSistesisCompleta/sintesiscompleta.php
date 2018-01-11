<?php
$fecha = date('Y-m-d');

$columnasPoliticas="/var/www/external/testigos/pemex/columnaspoliticas/$fecha/compendio/$fecha.pdf";

$columnasFinancieras="/var/www/external/testigos/pemex/columnasfinancieras/$fecha/compendio/$fecha.pdf";;

$dirgeneral="/var/www/external/testigos/pemex/dirgeneral/$fecha/compendio/$fecha.pdf";

$pemex="/var/www/external/testigos/pemex/pemex/$fecha/compendio/$fecha.pdf";;

$portadas="/var/www/external/testigos/pemex/portadas/portadas-$fecha.pdf";

$portadasLocales="/var/www/external/testigos/pemex/portadasLocales/portadasLocales-$fecha.pdf";

$cartones="/var/www/external/testigos/pemex/cartones/$fecha/compendio/$fecha.pdf";

$tracendidos = "/var/www/external/testigos/pemex/trascendidos/$fecha/compendio/$fecha.pdf";

exec("gs -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=/var/www/external/testigos/pemex/compendiocompleta/sistesis-$fecha.pdf $portadas $dirgeneral $pemex $tracendidos $columnasPoliticas $columnasFinancieras $cartones");
