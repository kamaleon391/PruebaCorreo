<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_gantt.php');

$graph = new GanttGraph(0,0);
$graph->SetBox();
$graph->SetShadow();

// Add title and subtitle
$graph->title->Set("Example of captions");
$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
$graph->subtitle->Set("(ganttex17.php)");

// Show day, week and month scale
$graph->ShowHeaders(GANTT_HDAY | GANTT_HWEEK | GANTT_HMONTH);

// Set table title
$graph->scale->tableTitle->Set("(Rev: 1.22)");
$graph->scale->tableTitle->SetFont(FF_FONT1,FS_BOLD);
$graph->scale->SetTableTitleBackground("silver");

// Modify the appearance of the dividing lines
$graph->scale->divider->SetWeight(3);
$graph->scale->divider->SetColor("navy");
$graph->scale->dividerh->SetWeight(3);
$graph->scale->dividerh->SetColor("navy");

// Use the short name of the