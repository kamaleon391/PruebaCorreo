<?php
include '../../php/Conecta20.php';
$q="DELETE FROM rastreo WHere ip like'192.168%'";
$data=  mysql_query($q);
/*
while ($row = mysql_fetch_array($data)) {
    echo "<br>".$row['fecha']." - ".$row['ip'];
}
 */
?>