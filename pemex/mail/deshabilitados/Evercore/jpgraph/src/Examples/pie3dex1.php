<?php // content="text/plain; charset=utf-8"

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
require_once ('jpgraph/jpgraph_flags.php');

// Some data
$datay1=array(140,110,50);
$datay2=array(35,90,190);
$datay3=array(20,60,70);

// Create the basic graph
$graph = new Graph(300,200);	
$graph->SetScale("textlin");
$graph->SetMargin(40,20,20,40);
$graph->SetMarginColor('white:0.9');
$graph->SetColor('white');
$graph->SetShadow();

// Apply a perspective transformation at the end 
$graph->Set3DPerspective(SKEW3D_UP,100,180);

// Adjust the position of the legend box
$graph->legend->Pos(0.03,0.10);

// Adjust the color for theshadow of the legend
$graph->legend->SetShadow('darkgray@0.5');
$graph->legend->SetFillColor('lightblu