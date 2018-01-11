<?php
require '/var/www/external/services/mail/library/Mailin.php';
require '/var/www/external/services/mail/funciones_export.php';
//require 'querysGIN2015.php';

// PREPARACION DE VARIABLES A UTILIZAR
$fecha   =  date("Y-m-d");
$fecha_completa = mostrar_fecha_completa(date("Y-m-d"));
$cadenaPrimerasPlanasDF = "";
$cadenaNotas = "";

// CONFIGURACION DE mysqli PARA CONEXION A BASE DE DATOS
$mysqli = new mysqli("127.0.0.1", "root", "Gaddp552014", "monitoreoGa");

if ($mysqli->connect_errno) {
    return "Fallo la conexion a la base de datos" . $mysqli->error;
}
if (!$mysqli->set_charset('utf8')) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
    exit;
}

$queryPrimerasPlanasDF = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
p.String_Name as StringName,
    n.CREL as CREL,
    n.CostoNota,
    n.CREN as CREN,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  n.Foto,
  n.PieFoto
FROM 
noticiasDia n, 
periodicos p, 
ordenGeneral o,
seccionesPeriodicos s,
categoriasPeriodicos c,
estados e
WHERE 
e.idEstado=p.Estado AND
p.idPeriodico=n.Periodico AND
p.idPeriodico=o.periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(3) AND
fecha =CURDATE()  AND n.Activo=1
GROUP BY n.NumeroPagina,p.idPeriodico
ORDER BY o.posicion";

$queryGobernador = "SELECT
n.cutted,
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  p.Nombre as Periodico,
p.String_Name as StringName,
    n.CREL as CREL,
    n.CostoNota,
    n.CREN as CREN,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  n.Autor,
  n.Texto,
  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  n.Fecha,
  n.Hora,
  n.Encabezado,
  n.Foto,
  n.PieFoto
FROM
  noticiasDia n,
  periodicos p,
  ordenGeneraljalisco o,
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE
  p.idPeriodico=n.Periodico AND
  p.idPeriodico=o.periodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
   n.Activo = 1 AND
    p.Tipo=1 AND
  p.Estado=e.idEstado AND
  fecha = CURDATE() AND (
    Texto like '%Jorge Aristoteles Sandoval Diaz%' OR
    Texto like '%Jorge Aristoteles Sandoval%' OR
    Texto like '%Jorge Sandoval Diaz%' OR
    Texto like '%Aristoteles Sandoval Diaz%' OR
    Texto like '%Aristoteles Sandoval%' OR
    Texto like '%gobernador del estado de jalisco%' OR
    Texto like '%gobernador de jalisco%' OR
    Texto like '%gobernador del estado Aristoteles Sandoval Diaz%'OR
        Texto like '%gobernador Aristóteles%'OR
    
    Titulo like '%Jorge Aristoteles Sandoval Diaz%' OR
    Titulo like '%Jorge Aristoteles Sandoval%' OR
    Titulo like '%Jorge Sandoval Diaz%' OR
    Titulo like '%Aristoteles Sandoval Diaz%' OR
    Titulo like '%Aristoteles Sandoval%' OR
    Titulo like '%gobernador del estado de jalisco%' OR
    Titulo like '%gobernador de jalisco%' OR
    Titulo like '%gobernador del estado Aristoteles Sandoval Diaz%' OR

    Encabezado like '%Jorge Aristoteles Sandoval Diaz%' OR
    Encabezado like '%Jorge Aristoteles Sandoval%' OR
    Encabezado like '%Jorge Sandoval Diaz%' OR
    Encabezado like '%Aristoteles Sandoval Diaz%' OR
    Encabezado like '%Aristoteles Sandoval%' OR
    Encabezado like '%gobernador del estado de jalisco%' OR
    Encabezado like '%gobernador de jalisco%' OR
    Encabezado like '%gobernador del estado Aristoteles Sandoval Diaz%' OR
      
    PieFoto like '%Jorge Aristoteles Sandoval Diaz%' OR
    PieFoto like '%Jorge Aristoteles Sandoval%' OR
    PieFoto like '%Jorge Sandoval Diaz%' OR
    PieFoto like '%Aristoteles Sandoval Diaz%' OR
    PieFoto like '%Aristoteles Sandoval%' OR
    PieFoto like '%gobernador del estado de jalisco%' OR
    PieFoto like '%gobernador de jalisco%' OR
    PieFoto like '%gobernador del estado Aristoteles Sandoval Diaz%' OR
     
    Autor like '%Jorge Aristoteles Sandoval Diaz%' OR
    Autor like '%Jorge Aristoteles Sandoval%' OR
    Autor like '%Jorge Sandoval Diaz%' OR
    Autor like '%Aristoteles Sandoval Diaz%' OR
    Autor like '%Aristoteles Sandoval%' OR
    Autor like '%gobernador del estado de jalisco%' OR
    Autor like '%gobernador de jalisco%' OR
    Autor like '%gobernador del estado Aristoteles Sandoval Diaz %'
    )
GROUP BY n.idEditorial
ORDER BY o.posicion";

// EJECUCION DE QUERIES Y RECOLECCION DE DATOS
try {
    $query_result = $mysqli->query($queryPrimerasPlanasDF, MYSQLI_STORE_RESULT) or die($mysqli->error);
    $query_result->data_seek(0);
    
    while ($row = $query_result->fetch_assoc()) {
        $cadenaPrimerasPlanasDF .= "<tr>
            <td width='1%' class='links'>&nbsp;&nbsp;&nbsp;</td>
            <td width='75%'>
                <br>
                <font color='#4F4F4F' size='1' face='verdana'>
                    <a href='http://www.gaimpresos.com" . $row['pdf'] . "' target='_blank' style='text-decoration:none'>
                        <font color='#4F4F4F' size='1' face='verdana'><b>" . $row['StringName'] . "</b></font>
                    </a>
                </font>
                <font color='#4F4F4F' size='1' face='verdana'>
                    <br>" . $row['Titulo'] . "<br>
                </font>
            </td>
        </tr>";
    }
    
    $query_result->close();

    $query_result = $mysqli->query($queryGobernador, MYSQLI_STORE_RESULT) or die($mysqli->error);
    $query_result->data_seek(0);
    
    while ($row = $query_result->fetch_assoc()) {
        $cadenaNotas .= "<table width='800'>
                            <tr>
                                <td>
                                    <font color='#000000' size='2' face='arial'><b>" . $row['Titulo'] . "</b></font>
                                    <font color='#000000' size='1' face='arial'>
                                        <br>" . $row['Fecha'] . ", &nbsp; " . $row['StringName'] . ($row['Autor'] == '' ? "" : ", &nbsp;" . $row['Autor']) . "
                                        <br>
                                    </font>
                                    <font color='#000000' size='1' face='verdana' align='justify'>
                                        <br>" . $row['Texto'] . "
                                    </font>
                                    <br>
                                    <a href='http://www.gaimpresos.com" . $row['pdf'] . "' target='_blank'>
                                        <font color='#0033FF' size='1' face='verdana'><b>PDF</b></font>
                                    </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <a href='http://www.gaimpresos.com" . $row['pdf'] . ".jpg' target='_blank'>
                                        <font color='#0033FF' size='1' face='verdana'><b>Imagen</b></font>
                                    </a>
                                    <hr>
                                </td>
                            </tr>
                        </table>";
    }
    
    $query_result->close();
} catch (Exception $e) {
    return 'Excepción capturada: ' . $e->getMessage() . "\n";
} 

/*
 * PREPARA CREACION DEL MENSAJE
 */
$mensaje = "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>GAComunicación</title>
</head>
<body>
    <table width='200' border='0' align='left'>
        <tr>
            <td>
                <br>
                <a>
                    <font color='#606060' size='2' face='arial'><b>Reporte de notas:</b></font>
                </a>
            </td>
        </tr>
        <tr>
            <td colspan='3'><img src='http://187.247.253.5/external/services/mail/solartec/logoGA2.png' height='100' align='absmiddle' /></td>
        </tr>
        <tr>
            <td>
                <font color='#646464' size='1' face='verdana'><b>$fecha_completa</b></font>
            </td>
        </tr>
    </table>
    <br clear=left>
    <table width='1000' border=0 cellpadding=0 cellspacing=0 class=MsoTableGrid>
        <tr>
            <td WIDTH='20%' height='42' align='center' valign='top'>
                <table width='200' border='0'>
                    <tr>
                        <td height='56'>&nbsp;</td>
                    </tr>
                </table>
                <table width='100%' height='1' border=0 cellspacing=0 cellpadding=0 align='up'>
                    <tr>
                        <td><font color='#4F4F4F' size='2' face='verdana'><b>Primeras Planas</b></font></td>
                    </tr>
                </table>
                <table width='100%' height='1' border=0 cellpadding=0 cellspacing=0 align='up'>$cadenaPrimerasPlanasDF</table>
            </td>
            <td width='99%' rowspan='1' valign='top'>
                <table BORDER='0' align='up'>
                </table>
                <table width='810' align='up' border='0'>
                    <tr>
                        <td>
                            <!-- SECCIONES PRINCIPALES CON LINK A LA SECCION -->
                            <table width='806' border='0'> 
                                <tr>
                                    <!-- TITULO DE SECCIÓN -->
                                    <td width='112'>
                                        <a style='text-decoration:none' href='#Dos'>
                                            <font color='#969696' size='1' face='arial'>
                                                <center><b>Gobernador</b></center>
                                            </font>
                                        </a>
                                        <font color='#969696' size='1' face='arial'>
                                            <center><b>(30)</b></center>
                                        </font>
                                    </td>
                                    <!-- FIN - TITULO DE SECCIÓN -->
                                </tr>
                            </table>
                            <!-- FIN - SECCIONES PRINCIPALES CON LINK A LA SECCION -->
                            <a name='Uno'>
                            <!-- SECCIÓN DE CÓDIGO QUE SE DUPLICA PARA CADA TEMA -->
                            <a name='Dos'>
                                <table width='800' border='0'>
                                    <tr>
                                        <td width='790' bgcolor='#41C3F6'><font color='#F7F7F7' size='2' face='arial'><b>Gobernador</b></font></td>
                                        <td width='10' bgcolor='#41C3F6'>
                                            <div align='center'>
                                                <a title='Subir' style='text-decoration:none' href='#Top'>
                                                    <font face='arial' size='2' color='#FFFFFF'><b>^</b></font>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- TABLA QUE SE DUPLICA PARA CADA NOTA -->
                                $cadenaNotas
                                <!-- FIN - TABLA QUE SE DUPLICA PARA CADA NOTA -->
                            <!-- FIN - SECCIÓN DE CÓDIGO QUE SE DUPLICA PARA CADA TEMA -->
                        </td>          
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>";

echo $mensaje;

 /* PREPARA OBJETO DE ENVIO...*/
 
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data   = array(
    "to" => array(
        'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com',
        'ehb1703@gmail.com' => 'ehb1703@gmail.com'
    ),
    //"cc" => array(),
    /*"bcc" => array(
      
      ga
      'jlga@gacomunicacion.com' => 'jlga@gacomunicacion.com',
      'gmocarmona@gacomunicacion.com' => 'gmocarmona@gacomunicacion.com',
      'fcocolina@gacomunicacion.com' => 'fcocolina@gacomunicacion.com',
      'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com',
      'alezama@gacomunicacion.com' => 'alezama@gacomunicacion.com',
      'rubend@gacomunicacion.com' => 'rubend@gacomunicacion.com',
      'edgarh@gacomunicacion.com' => 'edgarh@gacomunicacion.com',
      'aop@gacomunicacion.com' => 'aop@gacomunicacion.com',
      'mariob@gacomunicacion.com' => 'mariob@gacomunicacion.com'
      'ehb1703@icloud.com' => 'ehb1703@icloud.com',
      'sintesisga@gmail.com'=> 'sintesisga@gmail.com'
      */
     /*
      ),*/
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
    "subject" => "DEMO",
    "html" => $mensaje,
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-DEMO")
);

/*
 * ENVIANDO...
 */

var_dump($mailin->send_email($data));
