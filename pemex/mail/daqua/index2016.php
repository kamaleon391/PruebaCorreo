<?php
/* Establecer la codificación de caracteres interna a UTF-8 */
//mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=UTF-8');



require '/var/www/external/services/mail/library/Mailin.php';
include '/var/www/external/services/mail/Classes/WebReport.php';



$report = new WebReport(date('Y-m-d'), 'http://187.247.253.5/external/services/mail/daqua/daqua.png', 'http://187.247.253.5/external/services/mail/daqua/daqua.png', ['4467','4468','4469','4470','4471','4472','4473','4474']);


$queryPP = "SELECT
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
  ORDER BY o.posicion LIMIT 0, 10";

$queryBussiness = "SELECT
  n.Periodico as idPeriodico,
  n.idEditorial,
  n.Titulo,
  n.Encabezado as Encabezado,
  p.Nombre as Periodico,
  p.String_Name as StringName,
  p.Tiraje as Tiraje,
  n.CostoNota,
  n.CREL as CREL,
  n.CostoNota,
  n.CREN as CREN,
  e.Nombre AS estado,
  CONCAT(DATE_FORMAT(n.Fecha, '%Y-%m-%d'),' ',n.Hora) as Fecha,
  n.PaginaPeriodico,
  s.seccion,
  c.Categoria as Categoria,
  if(n.Autor like p.String_Name, CONCAT('Redacción ',p.String_Name),if(n.Autor like p.Nombre, CONCAT('Redacción ',p.String_Name),n.Autor)) as Autor,
  n.Texto,
  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
  CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg',
  n.Categoria as 'Num.Categoria',
  n.NumeroPagina,
  DATE_FORMAT(n.Fecha, '%d/%m/%Y') as Fecha2,
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
  o.periodico=p.idPeriodico AND
  s.idSeccion=n.Seccion AND
  c.idCategoria=n.Categoria AND
  c.idCategoria in(20) AND
  p.Estado=9 AND
  fecha =CURDATE() 
GROUP BY n.idEditorial
ORDER BY o.posicion";

$report->createSidePlanas($queryPP);
//$report->createSideColumn($queryBussiness);
$report->createCentralColumn();
$report->createFinancialColumn($queryBussiness,"Columnas Económicas");
$report->createMessage();

echo $report->message;


 /* PREPARA OBJETO DE ENVIO...*/


  $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
  $data   = array(
    "to" => array(
        'paola.galvan@prexperience.com.mx'    => 'paola.galvan@prexperience.com.mx',
        'laura.gonzalez@prexperience.com.mx'  => 'laura.gonzalez@prexperience.com.mx',
        'paola.carrera@prexperience.com.mx'   => 'paola.carrera@prexperience.com.mx',
        'paola.carrera@prexperience.com.mx'   => 'paola.carrera@prexperience.com.mx',
        'ale.prexperience@gmail.com'          => 'ale.prexperience@gmail.com',
        'viridiana.cruz@prexperience.com.mx'  => 'viridiana.cruz@prexperience.com.mx'
      ),
    "cc" => array(
        'oortiz@gacomunicacion.com'           => 'oortiz@gacomunicacion.com'
    ),
    "bcc" => array(
        'ehb1703@gmail.com'                   => 'ehb1703@gmail.com'
      ),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
    "subject" => "D´AQUA Monitoreo de Medios",
    "html" => utf8_encode($report->message),
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-DAQUA")
);

var_dump($mailin->send_email($data));


?>