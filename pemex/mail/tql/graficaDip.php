<?php // content="text/plain; charset=utf-8"

/*
require_once ('/var/www/external/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/mail/conexion.php';
*/

require_once ('/var/www/external/services/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/services/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/services/mail/conexion.php';


//Query Contador de Notas Alfredo Barba PRI
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
  Texto like '%Alfredo Barba Mariscal%' OR
  Texto like '%Alfredo Barba%' OR

  Titulo like '%Alfredo Barba Mariscal%' OR
  Titulo like '%Alfredo Barba%' OR

  Encabezado like '%Alfredo Barba Mariscal%' OR
  Encabezado like '%Alfredo Barba%' OR

  Autor like '%Alfredo Barba Mariscal%' OR
  Autor like '%Alfredo Barba%' OR

  PieFoto like '%Alfredo Barba Mariscal%' OR
  PieFoto like '%Alfredo Barba%'
)";

$notasVillanueva = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Liliana Gpe. Morones Vargas
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
  Texto like '%Liliana Guadalupe Morones Vargas%' OR
  Texto like '%Liliana Morones Vargas%' OR
  Texto like '%Liliana Guadalupe Morones%' OR
  Texto like '%Morones Vargas%' OR

  Titulo like '%Liliana Guadalupe Morones Vargas%' OR
  Titulo like '%Liliana Morones Vargas%' OR
  Titulo like '%Liliana Guadalupe Morones%' OR
  Titulo like '%Morones Vargas%' OR

  Encabezado like '%Liliana Guadalupe Morones Vargas%' OR
  Encabezado like '%Liliana Morones Vargas%' OR
  Encabezado like '%Liliana Guadalupe Morones%' OR
  Encabezado like '%Morones Vargas%' OR

  PieFoto like '%Liliana Guadalupe Morones Vargas%' OR
  PieFoto like '%Liliana Morones Vargas%' OR
  PieFoto like '%Liliana Guadalupe Morones%' OR
  PieFoto like '%Morones Vargas%' OR

  Autor like '%Liliana Guadalupe Morones Vargas%' OR
  Autor like '%Liliana Morones Vargas%' OR
  Autor like '%Liliana Guadalupe Morones%' OR
  Autor like '%Morones Vargas%'

)";

$notasAlfaro = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Blanca Estela Fajardo Duran PRI
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
  Texto like '%Blanca Estela Fajardo Duran%' OR
  Texto like '%Blanca Fajardo Duran%' OR
  Texto like '%Blanca Estela Fajardo%' OR
  Texto like '%Fajardo Duran%' OR

  Titulo like '%Blanca Estela Fajardo Duran%' OR
  Titulo like '%Blanca Fajardo Duran%' OR
  Titulo like '%Blanca Estela Fajardo%' OR
  Titulo like '%Fajardo Duran%' OR

  Encabezado like '%Blanca Estela Fajardo Duran%' OR
  Encabezado like '%Blanca Fajardo Duran%' OR
  Encabezado like '%Blanca Estela Fajardo%' OR
  Encabezado like '%Fajardo Duran%' OR

  Autor like '%Blanca Estela Fajardo Duran%' OR
  Autor like '%Blanca Fajardo Duran%' OR
  Autor like '%Blanca Estela Fajardo%' OR
  Autor like '%Fajardo Duran%' OR

  PieFoto like '%Blanca Estela Fajardo Duran%' OR
  PieFoto like '%Blanca Fajardo Duran%' OR
  PieFoto like '%Blanca Estela Fajardo%' OR
  PieFoto like '%Fajardo Duran%'
)";

$notasPetersen = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Felipe Reyes Rivas  PAN
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
  Texto like '%Felipe Reyes Rivas%' OR
  Texto like '%Reyes Rivas%' OR

  Titulo like '%Felipe Reyes Rivas%' OR
  Titulo like '%Reyes Rivas%' OR

  Encabezado like '%Felipe Reyes Rivas%' OR
  Encabezado like '%Reyes Rivas%' OR

  Autor like '%Felipe Reyes Rivas%' OR
  Autor like '%Reyes Rivas%' OR

  Piefoto like '%Felipe Reyes Rivas%' OR
  Piefoto like '%Reyes Rivas%'
)";

$notasCienfuegos = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Antonio de Loza Íñiguez
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
  Texto like '%Antonio de Loza Iniguez%' OR
  Texto like '%de Loza Iniguez%' OR

  Titulo like '%Antonio de Loza Iniguez%' OR
  Titulo like '%de Loza Iniguez%' OR

  Encabezado like '%Antonio de Loza Iniguez%' OR
  Encabezado like '%de Loza Iniguez%' OR

  Autor like '%Antonio de Loza Iniguez%' OR
  Autor like '%de Loza Iniguez%' OR

  PieFoto like '%Antonio de Loza Iniguez%' OR
  PieFoto like '%de Loza Iniguez%'
)";

$notasLizaola = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Germán Ernesto Ralis Cumplido 
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
  Texto like '%German Ernesto Ralis Cumplido%' OR
  Texto like '%German Ralis Cumplido%' OR
  Texto like '%German Ernesto Ralis%' OR
  Texto like '%Ralis Cumplido%' OR

  Titulo like '%German Ernesto Ralis Cumplido%' OR
  Titulo like '%German Ralis Cumplido%' OR
  Titulo like '%German Ernesto Ralis%' OR
  Titulo like '%Ralis Cumplido%' OR

  Encabezado like '%German Ernesto Ralis Cumplido%' OR
  Encabezado like '%German Ralis Cumplido%' OR
  Encabezado like '%German Ernesto Ralis%' OR
  Encabezado like '%Ralis Cumplido%' OR

  Autor like '%German Ernesto Ralis Cumplido%' OR
  Autor like '%German Ralis Cumplido%' OR
  Autor like '%German Ernesto Ralis%' OR
  Autor like '%Ralis Cumplido%' OR

  PieFoto like '%German Ernesto Ralis Cumplido%' OR
  PieFoto like '%German Ralis Cumplido%' OR
  PieFoto like '%German Ernesto Ralis%' OR
  PieFoto like '%Ralis Cumplido%'
)";

$notasPH = mysql_fetch_row(mysql_query($qryContador));


echo utf8_decode("Alfredo Barba Mariscal: ").$notasVillanueva[0]."<br>";
echo utf8_decode("Liliana Gpe. Morones Vargas: ").$notasAlfaro[0]."<br>";
echo utf8_decode("Blanca Estela Fajardo Durán: ").$notasPetersen[0]."<br>";
echo utf8_decode("Felipe Reyes Rivas: ").$notasCienfuegos[0]."<br>";
echo utf8_decode("Antonio de Loza Íñiguez: ").$notasLizaola[0]."<br>";
echo utf8_decode("Germán Ernesto Ralis Cumplido: ").$notasPH[0]."<br>";

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
$p1->SetLegends(array("Alfredo Barba Mariscal","Liliana Gpe. Morones Vargas","Blanca Fajardo Durán","Felipe Reyes Rivas","Antonio de Loza Íñiguez","Germán Ralis Cumplido "));

$graph->legend->Pos(0.07,0.8);

// Set how many pixels each slice should explode
$p1->Explode(array(15,15,15,15));


$graph->Add($p1);
$p1->SetSliceColors(array('#8E0000','#F57921','#017CC2','#A3A3A3','#FFFF00',"#F4B609","#0043FF","#2B2525","#C4BA05","#C4BA09"));

$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
 
// Stroke image to a file and browser
 
// Default is PNG so use ".png" as suffix
//$fileName = "/var/www/external/mail/villanueva/graficaVillanueva.png";
$fileName = "/var/www/external/services/mail/tql/graficaTQLDiputados.png";
$graph->img->Stream($fileName);
 
// Send it back to browser
//$graph->img->Headers();
//$graph->img->Stream();

?>


