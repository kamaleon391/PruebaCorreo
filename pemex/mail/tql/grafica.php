<?php // content="text/plain; charset=utf-8"

/*
require_once ('/var/www/external/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/mail/conexion.php';
*/

require_once ('/var/www/external/services/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/services/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/services/mail/conexion.php';


//Query Contador de Notas Luis Cordova Diaz PRI
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Luis Armando Cordova Diaz %' OR
  Texto like '%Luis Cordova Diaz %' OR
  Texto like '%Cordova Diaz %' OR
  Titulo like '%Luis Armando Cordova Diaz %' OR
  Titulo like '%Luis Cordova Diaz %' OR
  Titulo like '%Cordova Diaz %' OR
  Encabezado like '%Luis Armando Cordova Diaz %' OR
  Encabezado like '%Luis Cordova Diaz %' OR
  Encabezado like '%Cordova Diaz %' OR
  Autor like '%Luis Armando Cordova Diaz %' OR
  Autor like '%Luis Cordova Diaz %' OR
  Autor like '%Cordova Diaz %' OR
  Piefoto like '%Luis Cordova Diaz %' OR
  Piefoto like '%Luis Armando Cordova Diaz %' Or
  Piefoto like '%Cordova Diaz %'
)";

$notasVillanueva = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Maria Elena Limon MC
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Maria Elena Limon Garcia%' OR
  Texto like '%Maria Limon Garcia%' OR
  Texto like '%Maria Elena Limon%' OR
  Texto like '%Limon Garcia%' OR

  Titulo like '%Maria Elena Limon Garcia%' OR
  Titulo like '%Maria Limon Garcia%' OR
  Titulo like '%Maria Elena Limon%' OR
  Titulo like '%Limon Garcia%' OR

  Encabezado like '%Maria Elena Limon Garcia%' OR
  Encabezado like '%Maria Limon Garcia%' OR
  Encabezado like '%Maria Elena Limon%' OR
  Encabezado like '%Limon Garcia%' OR

  Autor like '%Maria Elena Limon Garcia%' OR
  Autor like '%Maria Limon Garcia%' OR
  Autor like '%Maria Elena Limon%' OR
  Autor like '%Limon Garcia%' OR

  PieFoto like '%Maria Elena Limon Garcia%' OR
  PieFoto like '%Maria Limon Garcia%' OR
  PieFoto like '%Maria Elena Limon%' OR
  PieFoto like '%Limon Garcia%'
)";

$notasAlfaro = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Carmen Perez PAN-PRD
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Carmen Lucia Perez Camarena%' OR
  Texto like '%Carmen Perez Camarena%' OR
  Texto like '%Carmen Lucia Perez%' OR
  Texto like '%Perez Camarena%' OR

  Titulo like '%Carmen Lucia Perez Camarena%' OR
  Titulo like '%Carmen Perez Camarena%' OR
  Titulo like '%Carmen Lucia Perez%' OR
  Titulo like '%Perez Camarena%' OR

  Encabezado like '%Carmen Lucia Perez Camarena%' OR
  Encabezado like '%Carmen Perez Camarena%' OR
  Encabezado like '%Carmen Lucia Perez%' OR
  Encabezado like '%Perez Camarena%' OR

  Autor like '%Carmen Lucia Perez Camarena%' OR
  Autor like '%Carmen Perez Camarena%' OR
  Autor like '%Carmen Lucia Perez%' OR
  Autor like '%Perez Camarena%' OR

  PieFoto like '%Carmen Lucia Perez Camarena%' OR
  PieFoto like '%Carmen Perez Camarena%' OR
  PieFoto like '%Carmen Lucia Perez%' OR
  PieFoto like '%Perez Camarena%'

)";

$notasPetersen = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Julio Cesar Manzano Rios PT
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Julio Cesar Manzano Rios%' OR
  Texto like '%Julio Manzano Rios%' OR
  Texto like '%Julio Cesar Manzano%' OR
  Texto like '%Manzano Rios%' OR

  Titulo like '%Julio Cesar Manzano Rios%' OR
  Titulo like '%Julio Manzano Rios%' OR
  Titulo like '%Julio Cesar Manzano%' OR
  Titulo like '%Manzano Rios%' OR

  Encabezado like '%Julio Cesar Manzano Rios%' OR
  Encabezado like '%Julio Manzano Rios%' OR
  Encabezado like '%Julio Cesar Manzano%' OR
  Encabezado like '%Manzano Rios%' OR

  Autor like '%Julio Cesar Manzano Rios%' OR
  Autor like '%Julio Manzano Rios%' OR
  Autor like '%Julio Cesar Manzano%' OR
  Autor like '%Manzano Rios%' OR

  PieFoto like '%Julio Cesar Manzano Rios%' OR
  PieFoto like '%Julio Manzano Rios%' OR
  PieFoto like '%Julio Cesar Manzano%' OR
  PieFoto like '%Manzano Rios%'
)";

$notasCienfuegos = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Alfredo Fierros Castellanos MORENA
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND  (
  Texto like '%Alfredo Fierros Castellanos%' OR
  Texto like '%Alfredo Fierros%' OR
  Texto like '%Fierros Castellanos%' OR

  Titulo like '%Alfredo Fierros Castellanos%' OR
  Titulo like '%Alfredo Fierros%' OR
  Titulo like '%Fierros Castellanos%' OR

  Encabezado like '%Alfredo Fierros Castellanos%' OR
  Encabezado like '%Alfredo Fierros%' OR
  Encabezado like '%Fierros Castellanos%' OR

  Autor like '%Alfredo Fierros Castellanos%' OR
  Autor like '%Alfredo Fierros%' OR
  Autor like '%Fierros Castellanos%' OR

  PieFoto like '%Alfredo Fierros Castellanos%' OR
  PieFoto like '%Alfredo Fierros%' OR
  PieFoto like '%Fierros Castellanos%'
)";

$notasLizaola = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Norma Rosas Martinez Humanista
 $qryContador = "SELECT
     COUNT(*) AS 'Total'
      FROM
        noticiasDia n,
        periodicos p,
        ordenGeneraljalisco o
      WHERE
        p.idPeriodico=n.Periodico AND
        p.idPeriodico=o.periodico AND
      n.Activo = 1 AND
        fecha = CURDATE() AND (
  Texto like '%Norma Rosas Martinez%' OR
  Texto like '%Norma Rosas%' OR
  Texto like '%Rosas Martinez%' OR

  Titulo like '%Norma Rosas Martinez%' OR
  Titulo like '%Norma Rosas%' OR
  Titulo like '%Rosas Martinez%' OR

  Encabezado like '%Norma Rosas Martinez%' OR
  Encabezado like '%Norma Rosas%' OR
  Encabezado like '%Rosas Martinez%' OR

  Autor like '%Norma Rosas Martinez%' OR
  Autor like '%Norma Rosas%' OR
  Autor like '%Rosas Martinez%' OR

  PieFoto like '%Norma Rosas Martinez%' OR
  PieFoto like '%Norma Rosas%' OR
  PieFoto like '%Rosas Martinez%'
)";

$notasPH = mysql_fetch_row(mysql_query($qryContador));


echo utf8_decode("Luis Córdova Díaz: ").$notasVillanueva[0]."<br>";
echo utf8_decode("María Limón García: ").$notasAlfaro[0]."<br>";
echo utf8_decode("Carmen Lucía Camarena: ").$notasPetersen[0]."<br>";
echo utf8_decode("Julio Manzano Ríos: ").$notasCienfuegos[0]."<br>";
echo utf8_decode("Alfredo Fierros Castellanos: ").$notasLizaola[0]."<br>";
echo utf8_decode("Norma Rosas Martínez: ").$notasPH[0]."<br>";

// Some data
$data = array($notasVillanueva[0],$notasAlfaro[0],$notasPetersen[0],$notasCienfuegos[0],$notasLizaola[0],$notasPH[0]);

// Create the Pie Graph.
$graph = new PieGraph(700,450);
$graph->SetShadow();

// Set A title for the plot
//$graph->title->Set("Notas Precandidatos Guadalajara");
 
$graph->title->SetColor("brown");

// Create pie plot
$p1 = new PiePlot($data);

//$p1->SetTheme("sand");
$p1->SetLabelPos(0.6);
$p1->SetSize(0.3);
$p1->SetLegends(array(utf8_decode("Luis Córdova Díaz"),"María Limón García","Carmen Lucía Camarena","Julio Manzano Ríos","Alfredo Fierros Castellanos","Norma Rosas Martínez"));

$graph->legend->Pos(0.07,0.8);

// Set how many pixels each slice should explode
$p1->Explode(array(15,15,15,15));


$graph->Add($p1);
$p1->SetSliceColors(array('#8E0000','#F57921','#017CC2','#A3A3A3','#FFFF00',"#F4B609","#0043FF","#2B2525","#C4BA05","#C4BA09"));

$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
 
// Stroke image to a file and browser
 
// Default is PNG so use ".png" as suffix
//$fileName = "/var/www/external/mail/villanueva/graficaVillanueva.png";
$fileName = "/var/www/external/services/mail/tql/graficaTQL.png";
$graph->img->Stream($fileName);
 
// Send it back to browser
//$graph->img->Headers();
//$graph->img->Stream();

?>


