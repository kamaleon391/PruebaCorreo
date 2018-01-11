<?php
require '../dbconn/verbindung.php';
$query="Select marca ,count(1) as contador from comercialanual WHERE categoria LIKE 'Comunicacion y Tecnologia'  and DATE(fecha) BETWEEN '2012-12-01' AND '2012-12-31' group by marca limit 0,15";
$resul=  mysql_query($query);
$datos= array();
$count=0;
$cadena="";
while ($row = mysql_fetch_array($resul)) {
    //$datos[$count]=array('year'=>$row['marca'],'income'=>$row['contador'],'expenses'=>$row['contador']);
    
    
        //{year: 2005,income: 23.5,expenses: 18.1},
        $cadena=$cadena."{ year:'".$row['marca']."', income:'".$row['contador']."', expenses:'".$row['contador']."' },";
    
    $count++;
}
//echo json_encode($datos, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
mysql_free_result($resul);

//echo $cadena= substr($cadena, 0, -1);
?>
 
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>amCharts examples</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="../amcharts/amcharts.js" type="text/javascript"></script> 
        <script src="../amcharts/amcharts.js" type="text/javascript"></script>
        <script type="text/javascript">
            var chart;

            var chartData = [<?echo $cadena ?>];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "year";
                chart.startDuration = 1;
                chart.rotate = true;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.dashLength = 5;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.dashLength = 5;
                valueAxis.axisAlpha = 0.2;
                valueAxis.position = "top";
                valueAxis.title = "GRAFICA DE PUBLICACIONES";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // column graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Totales";
                graph1.valueField = "income";
                graph1.lineAlpha = 0;
                graph1.fillColors = "#ADD981";
                graph1.fillAlphas = 1;
                chart.addGraph(graph1);

                // line graph
                var graph2 = new AmCharts.AmGraph();
                graph2.type = "line";
                graph2.title = "Total Lineal";
                graph2.valueField = "expenses";
                graph2.lineThickness = 2;
                graph2.bullet = "round";
                graph2.fillAlphas = 0;
                chart.addGraph(graph2);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);

                // WRITE
                chart.write("chartdiv");
            });
        </script>
    </head>
    
    <body>
        <div id="chartdiv" style="width: 600px; height: 800px;"></div>
    </body>

</html>