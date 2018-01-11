<?php
require '../dbconn/verbindung.php';
$query="Select marca ,count(1) as contador from comercialanual WHERE categoria LIKE 'Comunicacion y Tecnologia'  and DATE(fecha) BETWEEN '2012-12-01' AND '2012-12-31' group by marca limit 0,15";
$resul=  mysql_query($query);
$datos= array();
$count=0;
$cadena="";
while ($row = mysql_fetch_array($resul)) {
    $datos[$count]=array('year'=>$row['marca'],'income'=>$row['contador'],'expenses'=>$row['contador']);
    
    
        //{year: 2005,income: 23.5,expenses: 18.1},
        $cadena=$cadena."{ country:'".$row['marca']."', litres:'".$row['contador']."'},";
    
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
            var legend;

            var chartData =[<?echo $cadena ?>];

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "litres";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;

                // WRITE
                chart.write("chartdiv");
            });
        </script>
    </head>
    
    <body>
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
    </body>

</html>