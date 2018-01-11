<?php // content="text/plain; charset=utf-8"
/*
require_once ('/var/www/external/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/mail/conexion.php';
*/

require_once ('/var/www/external/services/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/services/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/services/mail/conexion.php';

//Query Contador de Notas Chava Rizo
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
      Texto like '%salvador rizo castelo%' OR
      Texto like '%salvador rizo%' OR
      Texto like '%rizo castelo%' OR
      Texto like '%Chava Rizo%' OR

      Titulo like '%salvador rizo castelo%' OR
      Titulo like '%salvador rizo%' OR
      Titulo like '%rizo castelo%' OR
      Titulo like '%Chava Rizo%' OR

      Encabezado like '%salvador rizo castelo%' OR
      Encabezado like '%salvador rizo%' OR
      Encabezado like '%rizo castelo%' OR
      Encabezado like '%Chava Rizo%' OR

      PieFoto like '%salvador rizo castelo%' OR
      PieFoto like '%salvador rizo%' OR
      PieFoto like '%rizo castelo%' OR
      PieFoto like '%Chava Rizo%'
      )";

$notasChavarizo = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Pablo lemus Navarro
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
      Texto like '%Pablo lemus Navarro%' OR
      Texto like '%lemus Navarro%' OR
      Texto like '%Pablo lemus%' OR

      Titulo like '%Pablo lemus Navarro%' OR
      Titulo like '%lemus Navarro%' OR
      Titulo like '%Pablo lemus%' OR

      Encabezado like '%Pablo lemus Navarro%' OR
      Encabezado like '%lemus Navarro%' OR
      Encabezado like '%Pablo lemus%' OR

      PieFoto like '%Pablo lemus Navarro%' OR
      PieFoto like '%lemus Navarro%' OR
      PieFoto like '%Pablo lemus%'
      )";

$notasLemus = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Guillermo Martinez Mora
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
      Texto like '%Guillermo Martinez Mora%' OR
      Texto like '%Martinez Mora%' OR

      Titulo like '%Guillermo Martinez Mora%' OR
      Titulo like '%Martinez Mora%' OR

      Encabezado like '%Guillermo Martinez Mora%' OR
      Encabezado like '%Martinez Mora%' OR

      PieFoto like '%Guillermo Martinez Mora%' OR
      PieFoto like '%Martinez Mora%'
    )";

$notasMora = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Chavarizo - Pablo Lemus
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
      Texto like '%salvador rizo castelo%' OR
      Texto like '%salvador rizo%' OR
      Texto like '%rizo castelo%' OR
      Texto like '%Chava Rizo%' OR

      Titulo like '%salvador rizo castelo%' OR
      Titulo like '%salvador rizo%' OR
      Titulo like '%rizo castelo%' OR
      Titulo like '%Chava Rizo%' OR

      Encabezado like '%salvador rizo castelo%' OR
      Encabezado like '%salvador rizo%' OR
      Encabezado like '%rizo castelo%' OR
      Encabezado like '%Chava Rizo%' OR

      PieFoto like '%salvador rizo castelo%' OR
      PieFoto like '%salvador rizo%' OR
      PieFoto like '%rizo castelo%' OR
      PieFoto like '%Chava Rizo%'
      ) AND (
      Texto like '%Pablo lemus Navarro%' OR
      Texto like '%lemus Navarro%' OR
      Texto like '%Pablo lemus%' OR

      Titulo like '%Pablo lemus Navarro%' OR
      Titulo like '%lemus Navarro%' OR
      Titulo like '%Pablo lemus%' OR

      Encabezado like '%Pablo lemus Navarro%' OR
      Encabezado like '%lemus Navarro%' OR
      Encabezado like '%Pablo lemus%' OR

      PieFoto like '%Pablo lemus Navarro%' OR
      PieFoto like '%lemus Navarro%' OR
      PieFoto like '%Pablo lemus%'
      )";

$notasSRCPLN = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Chavarizo - Martinez Mora
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
      Texto like '%salvador rizo castelo%' OR
      Texto like '%salvador rizo%' OR
      Texto like '%rizo castelo%' OR
      Texto like '%Chava Rizo%' OR

      Titulo like '%salvador rizo castelo%' OR
      Titulo like '%salvador rizo%' OR
      Titulo like '%rizo castelo%' OR
      Titulo like '%Chava Rizo%' OR

      Encabezado like '%salvador rizo castelo%' OR
      Encabezado like '%salvador rizo%' OR
      Encabezado like '%rizo castelo%' OR
      Encabezado like '%Chava Rizo%' OR

      PieFoto like '%salvador rizo castelo%' OR
      PieFoto like '%salvador rizo%' OR
      PieFoto like '%rizo castelo%' OR
      PieFoto like '%Chava Rizo%'
      ) AND (
      Texto like '%Guillermo Martinez Mora%' OR
      Texto like '%Martinez Mora%' OR

      Titulo like '%Guillermo Martinez Mora%' OR
      Titulo like '%Martinez Mora%' OR

      Encabezado like '%Guillermo Martinez Mora%' OR
      Encabezado like '%Martinez Mora%' OR

      PieFoto like '%Guillermo Martinez Mora%' OR
      PieFoto like '%Martinez Mora%'
    )";

$notasSRCGMM = mysql_fetch_row(mysql_query($qryContador));


echo "Chava Rizo: ".$notasChavarizo[0]."<br>";
echo "Pablo Lemus: ".$notasLemus[0]."<br>";
echo "Martinez Mora: ".$notasMora[0]."<br>";
echo "SRC - PLN: ".$notasSRCPLN[0]."<br>";
echo "SRC - GMM: ".$notasSRCGMM[0]."<br>";

// Some data
$data = array($notasChavarizo[0], $notasLemus[0], $notasMora[0], $notasSRCPLN[0], $notasSRCGMM[0]);

// Create the Pie Graph.
$graph = new PieGraph(600,350);
$graph->SetShadow();

// Set A title for the plot
//$graph->title->Set("Notas Precandidatos Guadalajara");
 
$graph->title->SetColor("brown");

// Create pie plot
$p1 = new PiePlot($data);

//$p1->SetTheme("earth");
$p1->SetLabelPos(0.6);
$p1->SetSize(0.3);
$p1->SetLegends(array("Salvador Rizo Castelo", "Pablo Lemus Navarro", "Guillermo Martinez Mora", "SRC - PLN", "SRC - GMM"));

$graph->legend->Pos(0.07,0.8);

// Set how many pixels each slice should explode
$p1->Explode(array(15,15,15,15));


$graph->Add($p1);
$p1->SetSliceColors(array('#EC1B1D', '#F57921', '#017CC2', '#E8CB29', '#5800D3'));

$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
 
// Stroke image to a file and browser
 
// Default is PNG so use ".png" as suffix
$fileName = "/var/www/external/services/mail/chavarizo/graficaChavarizo.png";
$graph->img->Stream($fileName);
 
// Send it back to browser
//$graph->img->Headers();
//$graph->img->Stream();

?>


