<?php // content="text/plain; charset=utf-8"

/*
require_once ('/var/www/external/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/mail/conexion.php';
*/

require_once ('/var/www/external/services/mail/JPGraph/jpgraph.php');
require_once ('/var/www/external/services/mail/JPGraph/jpgraph_pie.php');
require '/var/www/external/services/mail/conexion.php';


//Query Contador de Notas Miguel Castro
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
          Texto like '%Miguel Castro Reynoso%' OR
         Texto like '%Miguel Castro%' OR
         Texto like '%Castro Reynoso%' OR

         Titulo like '%Miguel Castro Reynoso%' OR
         Titulo like '%Miguel Castro%' OR
         Titulo like '%Castro Reynoso%' OR

         Encabezado like '%Miguel Castro Reynoso%' OR
         Encabezado like '%Miguel Castro%' OR
         Encabezado like '%Castro Reynoso%' OR

         PieFoto like '%Miguel Castro Reynoso%' OR
         PieFoto like '%Miguel Castro%' OR
         PieFoto like '%Castro Reynoso%' OR

         Autor like '%Miguel Castro Reynoso%' OR
         Autor like '%Miguel Castro%' OR
         Autor like '%Castro Reynoso%'
)";

$notasReynoso = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Enrique Alfaro
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
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo  like '%Enrique Alfaro Ramirez%' OR
  Titulo  like '%Enrique Alfaro%' OR
  Titulo  like '%Alfaro Ramirez%' OR

  Encabezado  like '%Enrique Alfaro Ramirez%' OR
  Encabezado  like '%Enrique Alfaro%' OR
  Encabezado  like '%Alfaro Ramirez%' OR

  PieFoto  like '%Enrique Alfaro Ramirez%' OR
  PieFoto  like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)";

$notasAlfaro = mysql_fetch_row(mysql_query($qryContador));


//Query Contador de Notas Alfonso Petersen
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
          Texto like '%Carlos Lomeli Bolanos%' OR
          Texto like '%Lomeli Bolanos%' OR

          Titulo like '%Carlos Lomeli Bolanos%' OR
          Titulo like '%Lomeli Bolanos%' OR

          Encabezado like '%Carlos Lomeli Bolanos%' OR
          Encabezado like '%Lomeli Bolanos%' OR

          PieFoto like '%Carlos Lomeli Bolanos%' OR
          PieFoto like '%Lomeli Bolanos%'
)";

$notasLomelí = mysql_fetch_row(mysql_query($qryContador));

/*
//Query Contador de Notas Guillermo Cienfuegos
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
  Texto like '%Guillermo Cienfuegos Perez%' OR
  Texto  like '%Guillermo Cienfuegos%' OR
    Texto  like '%Cienfuegos Perez%' OR
    Texto  like '%lagrimita%' OR

  Titulo  like '%Guillermo Cienfuegos Perez%' OR
  Titulo  like '%Guillermo Cienfuegos%' OR
    Titulo  like '%Cienfuegos Perez%' OR
    Titulo  like '%lagrimita%' OR

  Encabezado  like '%Guillermo Cienfuegos Perez%' OR
  Encabezado  like '%Guillermo Cienfuegos%' OR
    Encabezado  like '%Cienfuegos Perez%' OR
    Encabezado  like '%lagrimita%' OR

  PieFoto  like '%Guillermo Cienfuegos Perez%' OR
  PieFoto  like '%Guillermo Cienfuegos%' OR
    PieFoto like '%Cienfuegos Perez%' OR
    PieFoto  like '%lagrimita%'
)";

$notasCienfuegos = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Celia Fausto
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
  Texto like '%Celia fausto Lizaola%' OR
  Texto like '%Celia fausto%' OR
  Texto like '%fausto Lizaola%' OR

  Titulo like '%Celia fausto Lizaola%' OR
  Titulo like '%Celia fausto%' OR
  Titulo like '%fausto Lizaola%' OR

  Encabezado like '%Celia fausto Lizaola%' OR
  Encabezado like '%Celia fausto%' OR
  Encabezado like '%fausto Lizaola%' OR

  PieFoto like '%Celia fausto Lizaola%' OR
  PieFoto like '%Celia fausto%' OR
  PieFoto like '%fausto Lizaola%' OR

  Autor like '%Celia fausto Lizaola%' OR
  Autor like '%Celia fausto%' OR
  Autor like '%fausto Lizaola%'
)";

$notasLizaola = mysql_fetch_row(mysql_query($qryContador));
*/
//Query Contador de Notas Miguel Cas-Enrique Alfaro
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
          Texto like '%Miguel Castro Reynoso%' OR
         Texto like '%Miguel Castro%' OR
         Texto like '%Castro Reynoso%' OR

         Titulo like '%Miguel Castro Reynoso%' OR
         Titulo like '%Miguel Castro%' OR
         Titulo like '%Castro Reynoso%' OR

         Encabezado like '%Miguel Castro Reynoso%' OR
         Encabezado like '%Miguel Castro%' OR
         Encabezado like '%Castro Reynoso%' OR

         PieFoto like '%Miguel Castro Reynoso%' OR
         PieFoto like '%Miguel Castro%' OR
         PieFoto like '%Castro Reynoso%' OR

         Autor like '%Miguel Castro Reynoso%' OR
         Autor like '%Miguel Castro%' OR
         Autor like '%Castro Reynoso%'
      ) AND (
  Texto like '%Enrique Alfaro Ramirez%' OR
  Texto like '%Enrique Alfaro%' OR
  Texto like '%Alfaro Ramirez%' OR

  Titulo  like '%Enrique Alfaro Ramirez%' OR
  Titulo  like '%Enrique Alfaro%' OR
  Titulo  like '%Alfaro Ramirez%' OR

  Encabezado  like '%Enrique Alfaro Ramirez%' OR
  Encabezado  like '%Enrique Alfaro%' OR
  Encabezado  like '%Alfaro Ramirez%' OR

  PieFoto  like '%Enrique Alfaro Ramirez%' OR
  PieFoto  like '%Enrique Alfaro%' OR
  PieFoto like '%Alfaro Ramirez%'
)";

$notasReynosoAlfaro = mysql_fetch_row(mysql_query($qryContador));
/*

//Query Contador de Notas Ricardo Villanueva-Alfonso Petersen
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
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Alfonso Petersen Farah%' OR
  Texto like '%Alfonso Petersen%' OR

  Titulo like '%Alfonso Petersen Farah%' OR
  Titulo like '%Alfonso Petersen%' OR

  Encabezado like '%Alfonso Petersen Farah%' OR
  Encabezado like '%Alfonso Petersen%' OR

  PieFoto like '%Alfonso Petersen Farah%' OR
  PieFoto like '%Alfonso Petersen%'
)";

$notasVillanuevaPetersen = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Ricardo Villanueva-Guillermo Cienfuegos
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
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      ) AND (
  Texto like '%Guillermo Cienfuegos Perez%' OR
  Texto  like '%Guillermo Cienfuegos%' OR
    Texto  like '%Cienfuegos Perez%' OR
    Texto  like '%lagrimita%' OR

  Titulo  like '%Guillermo Cienfuegos Perez%' OR
  Titulo  like '%Guillermo Cienfuegos%' OR
    Titulo  like '%Cienfuegos Perez%' OR
    Titulo  like '%lagrimita%' OR

  Encabezado  like '%Guillermo Cienfuegos Perez%' OR
  Encabezado  like '%Guillermo Cienfuegos%' OR
    Encabezado  like '%Cienfuegos Perez%' OR
    Encabezado  like '%lagrimita%' OR

  PieFoto  like '%Guillermo Cienfuegos Perez%' OR
  PieFoto  like '%Guillermo Cienfuegos%' OR
    PieFoto  like '%Cienfuegos Perez%' OR
    PieFoto  like '%lagrimita%'
)";

$notasVillanuevaCienfuegos = mysql_fetch_row(mysql_query($qryContador));

//Query Contador de Notas Ricardo Villanueva-Celia Fausto
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
        Texto like '%Ricardo Villanueva Lomeli%' OR
        Texto like '%Villanueva Lomeli%' OR
        Texto like '%Ricardo Villanueva%' OR

        Titulo like '%Ricardo Villanueva Lomeli%' OR
        Titulo like '%Villanueva Lomeli%' OR
        Titulo like '%Ricardo Villanueva%' OR

        Encabezado like '%Ricardo Villanueva Lomeli%' OR
        Encabezado like '%Villanueva Lomeli%' OR
        Encabezado like '%Ricardo Villanueva%' OR

        PieFoto like '%Ricardo Villanueva Lomeli%' OR
        PieFoto like '%Villanueva Lomeli%' OR
        PieFoto like '%Ricardo Villanueva%'
      )  AND  (
  Texto like '%Celia fausto Lizaola%' OR
  Texto like '%Celia fausto%' OR
  Texto like '%fausto Lizaola%' OR

  Titulo like '%Celia fausto Lizaola%' OR
  Titulo like '%Celia fausto%' OR
  Titulo like '%fausto Lizaola%' OR

  Encabezado like '%Celia fausto Lizaola%' OR
  Encabezado like '%Celia fausto%' OR
  Encabezado like '%fausto Lizaola%' OR

  PieFoto like '%Celia fausto Lizaola%' OR
  PieFoto like '%Celia fausto%' OR
  PieFoto like '%fausto Lizaola%' OR

  Autor like '%Celia fausto Lizaola%' OR
  Autor like '%Celia fausto%' OR
  Autor like '%fausto Lizaola%'
)";

$notasVillanuevaFausto = mysql_fetch_row(mysql_query($qryContador));
*/
echo "Reynoso: ".$notasReynoso[0]."<br>";
echo "Alfaro: ".$notasAlfaro[0]."<br>";
echo "Lomelí: ".$notasLomelí[0]."<br>";
//echo "Cienfuegos: ".$notasCienfuegos[0]."<br>";
//echo "Lizaola: ".$notasLizaola[0]."<br>";
echo "Reynoso-Alfaro: ".$notasReynosoAlfaro[0]."<br>";
//echo "Villanueva-Petersen: ".$notasVillanuevaPetersen[0]."<br>";
//echo "Villanueva-Cienfuegos: ".$notasVillanuevaCienfuegos[0]."<br>";
//echo "Villanueva-Fausto: ".$notasVillanuevaFausto[0]."<br>";
// Some data
$data = array($notasReynoso[0],$notasAlfaro[0],$notasLomelí[0],$notasReynosoAlfaro[0]);

$graph->SetShadow();

// Set A title for the plot
//$graph->title->Set("Notas Precandidatos Guadalajara");

$graph->title->SetColor("brown");

// Create pie plot
$p1 = new PiePlot($data);

//$p1->SetTheme("sand");
$p1->SetLabelPos(0.6);
$p1->SetSize(0.3);
$p1->SetLegends(array("Miguel Castro Reynoso","Enrique Alfaro Ramirez","Carlos Lomelí Bolaños","MCR-EAR"));

$graph->legend->Pos(0.07,0.8);

// Set how many pixels each slice should explode
$p1->Explode(array(15,15,15,15));


$graph->Add($p1);
//$p1->SetSliceColors(array('#8E0000','#F57921','#017CC2','#A3A3A3','#FFFF00',"#F4B609","#0043FF","#2B2525","#C4BA05"));
$p1->SetSliceColors(array('#ff0000','#F57921','#017CC2','#FFFF00'));

$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

// Stroke image to a file and browser

// Default is PNG so use ".png" as suffix
//$fileName = "/var/www/external/mail/villanueva/graficaVillanueva.png";
$fileName = "/var/www/external/services/mail/candidatos2018/graficaMCR3.png";
$graph->img->Stream($fileName);

// Send it back to browser
//$graph->img->Headers();
//$graph->img->Stream();

?>
