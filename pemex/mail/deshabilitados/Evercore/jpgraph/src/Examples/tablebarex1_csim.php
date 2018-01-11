<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_log.php');
require_once ('jpgraph/jpgraph_line.php');


$ydata = array(11,3,8,42,5,1,9,13,5,7);
$datax = array("Jan","Feb","Mar","Apr","Maj","Jun","Jul","aug","Sep","Oct");

// Create the graph. These two calls are always required
$graph = new Graph(350,200);
$graph->SetScale("textlog");

$graph->img->SetMargin(40,110,20,40);
$graph->SetShadow();

$graph->ygrid->Show(true,true);
$graph->xgrid->Show(true,false);

// Specify the tick labels
$a = $gDateLocale->GetShortMonth();
$graph->xaxis->SetTickLabels($a);

// Create the linear plot
$lineplot=new LinePlot($ydata);

// Add the plot to the graph
$graph->Add($lineplot);

$graph->title->Set("Examples 9");
$graph->xaxis->title->Set("X-title");
$graph->yaxis->title->Set("Y-title");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$graph->yaxis->SetColor("blue");

$lineplot->SetLegend("Plot 1");

$graph->legend->Pos(0.05,0.5,"right","center");

// Display the graph
$graph->Stroke();
?>

// Turn the tickmarks
$graph->xaxis->SetTickSide(SIDE_DOWN);
$graph->yaxis->SetTickSide(SIDE_LEFT);

$graph->y2axis->SetTickSide(SIDE_RIGHT);
$graph->y2axis->SetColor('black','blue');
$graph->y2axis->SetLabelFormat('%3d.0%%');

// Create a bar pot
$bplot = new BarPlot($data_freq);

// Create accumulative graph
$lplot = new LinePlot($data_accfreq);

// We want the line plot data point in the middle of the bars
$lplot->SetBarCenter();

// Use transperancy
$lplot->SetFillColor('lightblue@0.6');
$lplot->SetColor('blue@0.6');
$graph->AddY2($lplot);

// Setup the bars
$bplot->SetFillColor("orange@0.2");
$bplot->SetValuePos('center');
$bplot->value->SetF