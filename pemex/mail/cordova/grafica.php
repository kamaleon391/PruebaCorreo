<?php // content="text/plain; charset=utf-8"

/*
require_once ('/var/www/external/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/mail/conexion.php';
*/

require_once ('/var/www/external/services/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/services/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/services/mail/conexion.php';


//Query Contador de Notas Liuis Cordova
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
  Texto like '%luis cordova diaz%' OR
    Texto like '%luis armando cordova diaz%' OR
    Texto like '%luis armando cordova%' OR
  Texto like '%luis cordova%' OR
  Texto like '%cordova diaz%' OR

  Titulo like '%luis cordova diaz%' OR
  Titulo like '%luis armando cordova diaz%' OR
    Titulo like '%luis armando cordova%' OR
  Titulo like '%luis cordova%' OR
  Titulo like '%cordova diaz%' OR

  Encabezado like '%luis cordova diaz%' OR
  Encabezado like '%luis armando cordova diaz%' OR
    Encabezado like '%luis armando cordova%' OR
  Encabezado like '%luis cordova%' OR
  Encabezado like '%cordova diaz%' OR

  PieFoto like '%luis cordova diaz%' OR
    PieFoto like '%luis armando cordova diaz%' OR
    PieFoto like '%luis armando cordova%' OR
  PieFoto like '%luis cordova%' OR
  PieFoto like '%cordova diaz%'
)";

$notasCordova = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Maria Limon
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
  Texto like '%Maria Elena Limon%' OR
  Texto like '%Maria Limon%' OR
  Texto like '%Elena Limon%' OR

  Titulo like '%Maria Elena Limon%' OR
  Titulo like '%Maria Limon%' OR
  Titulo like '%Elena Limon%' OR

  Encabezado like '%Maria Elena Limon%' OR
  Encabezado like '%Maria Limon%' OR
  Encabezado like '%Elena Limon%' OR

  PieFoto like '%Maria Elena Limon%' OR
  PieFoto like '%Maria Limon%' OR
  PieFoto like '%Elena Limon%'
)";

$notasLimon = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Luis Cordova-Maria Limon
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
            Texto like '%luis cordova diaz%' OR
              Texto like '%luis armando cordova diaz%' OR
              Texto like '%luis armando cordova%' OR
            Texto like '%luis cordova%' OR
            Texto like '%cordova diaz%' OR

            Titulo like '%luis cordova diaz%' OR
            Titulo like '%luis armando cordova diaz%' OR
              Titulo like '%luis armando cordova%' OR
            Titulo like '%luis cordova%' OR
            Titulo like '%cordova diaz%' OR

            Encabezado like '%luis cordova diaz%' OR
            Encabezado like '%luis armando cordova diaz%' OR
              Encabezado like '%luis armando cordova%' OR
            Encabezado like '%luis cordova%' OR
            Encabezado like '%cordova diaz%' OR

            PieFoto like '%luis cordova diaz%' OR
              PieFoto like '%luis armando cordova diaz%' OR
              PieFoto like '%luis armando cordova%' OR
            PieFoto like '%luis cordova%' OR
            PieFoto like '%cordova diaz%'
          ) AND  (
            Texto like '%Maria Elena Limon%' OR
            Texto like '%Maria Limon%' OR
            Texto like '%Elena Limon%' OR

            Titulo like '%Maria Elena Limon%' OR
            Titulo like '%Maria Limon%' OR
            Titulo like '%Elena Limon%' OR

            Encabezado like '%Maria Elena Limon%' OR
            Encabezado like '%Maria Limon%' OR
            Encabezado like '%Elena Limon%' OR

            PieFoto like '%Maria Elena Limon%' OR
            PieFoto like '%Maria Limon%' OR
            PieFoto like '%Elena Limon%'
          )";

$notasCordovaLimon = mysql_fetch_row(mysql_query($qryContador));


echo "Cordova: ".$notasCordova[0]."<br>";
echo "Limon: ".$notasLimon[0]."<br>";
echo "Cordova-Limon: ".$notasCordovaLimon[0]."<br>";

// Some data
$data = array($notasCordova[0],$notasLimon[0],$notasCordovaLimon[0]);

// Create the Pie Graph.
$graph = new PieGraph(600,350);
$graph->SetShadow();

// Set A title for the plot
//$graph->title->Set("Notas Precandidatos Guadalajara");
 
$graph->title->SetColor("brown");

// Create pie plot
$p1 = new PiePlot($data);

//$p1->SetTheme("sand");
$p1->SetLabelPos(0.6);
$p1->SetSize(0.3);
$p1->SetLegends(array("Luis Cordova","Maria Limon","LCD-MEL"));

$graph->legend->Pos(0.07,0.8);

// Set how many pixels each slice should explode
$p1->Explode(array(15,15,15,15));


$graph->Add($p1);
$p1->SetSliceColors(array('#8E0000','#F57921',"#FF803E"));

$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
 
// Stroke image to a file and browser
 
// Default is PNG so use ".png" as suffix
//$fileName = "/var/www/external/mail/villanueva/graficaVillanueva.png";
$fileName = "/var/www/external/services/mail/cordova/graficaCordova.png";
$graph->img->Stream($fileName);
 
// Send it back to browser
//$graph->img->Headers();
//$graph->img->Stream();

?>


