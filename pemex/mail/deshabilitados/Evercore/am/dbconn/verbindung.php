<?php
$mysql_hostname = "192.168.1.19";
$mysql_user = "adconmedios";
$mysql_password = "conadmediospassx";
$mysql_database = "monitoreo";
$con = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Error en la Conexion");
mysql_select_db($mysql_database, $con) or die("Error en la base de datos");
?>
