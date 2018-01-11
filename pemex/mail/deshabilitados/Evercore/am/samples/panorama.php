<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
require '../../../../php/conexion.php';
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


 $queryTotal="Select 'Pedro Carlos Aspe Armella' as nombre,count(idEditorial) as contador from editorialdia where ($pedroAspe)
union (Select 'Volaris' as nombre,count(idEditorial) as contador from editorialdia where ($volaris))
union (Select 'Fibra UNO' as nombre,count(idEditorial) as contador from editorialdia where ($fibraUNO))
union (Select 'Fibra Danhos Federales' as nombre,count(idEditorial) as contador from editorialdia where ($fibraDanhos))
union (Select 'Evercore/Protego' as nombre,count(idEditorial) as contador from editorialdia where ($vercoreProtego))
 "; 

 
 //echo utf8_encode($sql);
    //$sql = "Select count(idEditorial) as contador from editorialdia where (Texto like'%manlio fabio%' OR  Texto like'%beltrones%'  OR Titulo like'%manlio fabio beltrones%' OR Encabezado like'%manlio fabio beltrones%') ";
    $data = mysql_query($queryTotal);
    $i=0;
    while($campos= mysql_fetch_array($data))
    {
        $datosNombres[$i]=$campos['nombre'];
        $datoscontador[$i]= $campos['contador'];
        $i++;
    }
        
    mysql_free_result($data);
    mysql_real_escape_string($sql);
    mysql_close($con);
  
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>..:ADMONITOR | STPS:..</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="../amcharts/amcharts.js" type="text/javascript"></script>
          <script type="text/javascript">
            var chart;

            var chartData = [
                {
                    country: "<?php echo $datosNombres[0]; ?>",
                    visits: <?php echo $datoscontador[0]; ?>
                },
                {
                    country: "<?php echo $datosNombres[1]; ?>",
                    visits: <?php echo $datoscontador[1]; ?>
                },
                {
                    country: "<?php echo $datosNombres[2]; ?>",
                    visits: <?php echo $datoscontador[2]; ?>
                }, 
                {
                country: "<?php echo $datosNombres[3]; ?>",
                visits: <?php echo $datoscontador[3]; ?>
            },
                {
                country: "<?php echo $datosNombres[4]; ?>",
                visits: <?php echo $datoscontador[4]; ?>
            }
            
            ];


            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();

                // title of the chart
                chart.addTitle("Grafica Resumen ", 16);

                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 15;

                // the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE                                 
                chart.write("chartdiv");
            });
        </script>
        <style>
            #ocultar{
       position: fixed;
    top: 0px;
    left: 6px;
    height: 30px;
    width: 149px;
    /*border: red solid thin;*/
    background-color: #F3F3F3;
    }
        </style>
    </head>
    
    <body>
        <div id="chartdiv" style="margin: 0;width: 100%;height: 450px;overflow: hidden;text-align: left;"></div>
        <div id="ocultar"></div>
    </body>
    <style>
        #chartdiv{
            /*top:100px;*/
            position:relative;
        }
    </style>
    <!--
                ADMEDIOS
 Departamento de Investigacion & Desarrollo
            Guadalajara, Jalisco
    -->
</html>