<?php 

$fecha1 = "2016-12-27";
$fecha2 = '2016-12-31';

for($i = $fecha1; $i <= $fecha2; $i = date("Y-m-d", strtotime($i ."+ 1 days"))) {

    $url  = 'http://192.168.3.154/external/services/mail/conagua/exportCONAGUA2015.php?p='.base64_encode(base64_encode('4')).'&f='.$i;
    $path = '/home/badillo/CONAGUA_ReportesMail/'.$i.'_ConaguaEstados.pdf';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_REFERER, $url);

    $data = curl_exec($ch);

    curl_close($ch);

    $result = file_put_contents($path, $data);

    if(!$result) {
            echo "Error - " . $i . "\n";
    }else{
            echo "Success - " . $i . "\n";
    }
}