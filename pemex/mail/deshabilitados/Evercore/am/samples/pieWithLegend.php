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

            var chartData = [<?echo $cadena ?>];

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "litres";

                // LEGEND
                legend = new AmCharts.AmLegend();
                legend.align = "center";
                legend.markerType = "circle";
                chart.addLegend(legend);

                // WRITE
                chart.write("chartdiv");
            });

            // changes label position (labelRadius)
            function setLabelPosition() {
                if (document.getElementById("rb1").checked) {
                    chart.labelRadius = 30;
                    chart.labelText = "[[title]]: [[value]]";
                } else {
                    chart.labelRadius = -30;
                    chart.labelText = "[[percents]]%";
                }
                chart.validateNow();
            }


            // makes chart 2D/3D                   
            function set3D() {
                if (document.getElementById("rb3").checked) {
                    chart.depth3D = 10;
                    chart.angle = 10;
                } else {
                    chart.depth3D = 0;
                    chart.angle = 0;
                }
                chart.validateNow();
            }

            // changes switch of the legend (x or v)
            function setSwitch() {
                if (document.getElementById("rb5").checked) {
                    legend.switchType = "x";
                } else {
                    legend.switchType = "v";
                }
                legend.validateNow();
            }
        </script>
    </head>
    
    <body>
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
        <table align="center" cellspacing="20">
            <tr>
                <td>
                    <input type="radio" checked="true" name="group" id="rb1" onclick="setLabelPosition()">labels outside
                    <input type="radio" name="group" id="rb2" onclick="setLabelPosition()">labels inside</td>
                <td>
                    <input type="radio" name="group2" id="rb3" onclick="set3D()">3D
                    <input type="radio" checked="true" name="group2" id="rb4" onclick="set3D()">2D</td>
                <td>Legend switch type:
                    <input type="radio" checked="true" name="group3" id="rb5"
                    onclick="setSwitch()">x
                    <input type="radio" name="group3" id="rb6" onclick="setSwitch()">v</td>
            </tr>
        </table>
    </body>

</html>