<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
$mysql_hostname = "192.168.1.80";
$mysql_user = "root";
$mysql_password = "monitoreo12";
$mysql_database = "monitoreo";
$con = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Error en la Conexion");
mysql_select_db($mysql_database, $con) or die("Error en la base de datos");


$pedroAspe="(
Texto like '%Pedro Carlos Aspe Armella%' OR
Texto like '%Pedro Carlos Aspe%' OR
Texto like '%Pedro Aspe Armella%' Or
Texto like '%Aspe Armella%' OR

Titulo like '%Pedro Carlos Aspe Armella%' OR
Titulo like '%Pedro Carlos Aspe%' OR
Titulo like '%Pedro Aspe Armella%' Or
Texto like '%Aspe Armella%' OR

Encabezado like '%Pedro Carlos Aspe Armella%' OR
Encabezado like '%Pedro Carlos Aspe%' OR
Encabezado like '%Pedro Aspe Armella%' Or
Encabezado like '%Aspe Armella%'
)";

$volaris="(
Texto like '%Volaris%' OR
Titulo like '%Volaris%' OR
Encabezado like '%Volaris%'
)";

$fibraUNO="(
Texto like '%Fibra UNO%' OR
Titulo like '%Fibra UNO%' OR
Encabezado like '%Fibra UNO%'
)";
$fibraDanhos="(
Texto like '%Fibra Danhos%' OR
Titulo like '%Fibra Danhos%' OR
Encabezado like '%Fibra Danhos%'
)";

$vercoreProtego="(
Texto like '%Evercore%' OR
Texto like '%protego%' OR
Titulo like '%Evercore%' OR
Titulo like '%protego%' OR
Encabezado like '%protego%' OR
Encabezado like '%Evercore%'
)";
if($_GET['f']==DATE('Y-m-d'))
{
   $queryTotal="Select 'Pedro Carlos Aspe Armella' as nombre,count(idEditorial) as contador from editorialdia where ($pedroAspe)
union (Select 'Volaris' as nombre,count(idEditorial) as contador from editorialdia where ($volaris))
union (Select 'Fibra UNO' as nombre,count(idEditorial) as contador from editorialdia where ($fibraUNO))
union (Select 'Fibra Danhos' as nombre,count(idEditorial) as contador from editorialdia where ($fibraDanhos))
union (Select 'Evercore/Protego' as nombre,count(idEditorial) as contador from editorialdia where ($vercoreProtego))
 ";  
}else{
    $fecha=$_GET['f'];
    $queryTotal="Select 'Pedro Carlos Aspe Armella' as nombre,count(idEditorial) as contador from editorialsemanal where ($pedroAspe) AND Fecha='$fecha'
union (Select 'Volaris' as nombre,count(idEditorial) as contador from editorialsemanal where ($volaris) AND Fecha='$fecha')
union (Select 'Fibra UNO' as nombre,count(idEditorial) as contador from editorialsemanal where ($fibraUNO) AND Fecha='$fecha')
union (Select 'Fibra Danhos' as nombre,count(idEditorial) as contador from editorialsemanal where ($fibraDanhos) AND Fecha='$fecha')
union (Select 'Evercore/Protego' as nombre,count(idEditorial) as contador from editorialsemanal where ($vercoreProtego) AND Fecha='$fecha')
 "; 
}    

 
 
$resp=  mysql_query($queryTotal);
//$data = array(40,60,21,33);
$data = array();
$i=0;
while ($row = mysql_fetch_array($resp))
{
    $data[$i]=$row['contador'];
    $i++;
}

$graph = new PieGraph(600,400);
$graph->SetShadow();

$graph->title->Set("Evercore");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new PiePlot($data);
$p1->value->SetFont(FF_FONT1,FS_BOLD);
$p1->value->SetColor("black");
$p1->SetTheme("sand");
$p1->SetSliceColors(array('red','green','blue','black'));
$p1->SetSize(0.3);
$p1->SetCenter(0.4);
$p1->SetLegends(array("Pedro Carlos Aspe Armella","Volaris","Fibra UNO","Fibra Danhos","Evercore-Protego"));
$graph->Add($p1);

$graph->Stroke();

?>


