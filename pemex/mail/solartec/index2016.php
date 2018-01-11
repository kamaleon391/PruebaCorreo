<?php
require '/var/www/external/services/mail/library/Mailin.php';
include '/var/www/external/services/mail/Classes/WebReport.php';

$report = new WebReport(date('Y-m-d'), 'http://187.247.253.5/external/services/mail/solartec/bannerSOLARTEC5.png', 'http://187.247.253.5/external/services/mail/solartec/bannerSOLARTEC5.png', ['3416','3403','3410','3411','3412','3413']);

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
  seccionesPeriodicos s,
  categoriasPeriodicos c,
  estados e
WHERE 
e.idEstado=p.Estado AND
p.idPeriodico=n.Periodico AND
s.idSeccion=n.Seccion AND
c.idCategoria=n.Categoria AND
c.idCategoria in(1,20) AND
p.Estado=9 AND
fecha =CURDATE() AND (
  Titulo like '%Capitanes%' OR
  Titulo like '%des balance%' OR
  Titulo like '%desbalance%' OR
  Titulo like '%Acciones y Reacciones%' OR
  Titulo like '%In versiones%' OR
  Titulo like '%El Contador%' OR
  Titulo like '%De Jefes%' OR
  Titulo like '%Tiempo de Negocios%' OR
  Titulo like '%Nombres%' OR
  Titulo like '%Con Estilo%' OR
  Titulo like '%Escritorio de Negocios%' OR
  Titulo like '%Tecno Empresa%' OR
  Titulo like '%TecnoEmpresa%' OR
  Titulo like '%Cuenta Corriente%' OR
  Titulo like '%desde el piso de remates%' OR
  Titulo like '%Riesgos y rendimientos %' OR
  Titulo like '%Momento Corporativo%' OR
  Titulo like '%Activo Empresarial%' OR
  Titulo like '%Punto y Aparte%' OR

  Autor like '%Alberto Aguilar%' OR
  Autor like '%Carlos Mota%' OR
  Autor like '%Julio Brita%' OR
  Autor like '%Claudia Olguin%' OR
  Autor like '%Jose Yuste%' OR
  Autor like '%Angeles Aguilar%'
)
GROUP BY n.idEditorial";

$report->createSidePlanas($queryPP);
$report->createSideColumn($queryBussiness);
$report->createCentralColumn();
$report->createMessage();
echo $report->message;

 /* PREPARA OBJETO DE ENVIO...*/
 /*
$mailin = new Mailin('https://api.sendinblue.com/v2.0', 'wjSbMAENLm2TGfpW');
$data   = array(
    "to" => array(
        'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com',
        'ehb1703@gmail.com' => 'ehb1703@gmail.com'
    ),
    "cc" => array(
  //'salmazan@fwd.com.mx' => 'salmazan@fwd.com.mx'
    ),
    "bcc" => array(
    /*  
      ga
      'jlga@gacomunicacion.com' => 'jlga@gacomunicacion.com',
      'gmocarmona@gacomunicacion.com' => 'gmocarmona@gacomunicacion.com',
      'fcocolina@gacomunicacion.com' => 'fcocolina@gacomunicacion.com',
      'oortiz@gacomunicacion.com' => 'oortiz@gacomunicacion.com',
     /* 'alezama@gacomunicacion.com' => 'alezama@gacomunicacion.com',
      'rubend@gacomunicacion.com' => 'rubend@gacomunicacion.com',
      'edgarh@gacomunicacion.com' => 'edgarh@gacomunicacion.com',
  /*    'aop@gacomunicacion.com' => 'aop@gacomunicacion.com',
      'sintesisga@gmail.com'=> 'sintesisga@gmail.com'     
      'mariob@gacomunicacion.com' => 'mariob@gacomunicacion.com'
      ),
    "from" => array("gaimpresos@gacomunicacion.com", "Monitoreo Impresos"),
    "subject" => "Solartec",
    "html" => utf8_encode($report->message),
    "headers" => array("Content-Type"=> "text/html; charset=UTF-8", "X-Mailin-Tag" => "Impresos-Solartec")
);*/

/*
 * ENVIANDO...
*/

//var_dump($mailin->send_email($data));

