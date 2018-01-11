<?php
 $fecha= "2010/02/15"; 
 $i = strtotime($fecha); 
 echo jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m",$i),date("d",$i), date("Y",$i)) , 0 ); 
 ?>


<?php

echo"------------<br>";
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");;
echo $fecha = $dias[date('N', strtotime('2008-02-25'))]; 
?> 

<?php
/*
echo"<br>------------<br>";
echo $f=date("Y-m-d");
echo"<br>------------<br>";
//echo  "<br>".$date=date("Y-m-d H:i:s", strtotime ("-12hours"));
//echo  "<br>".$date2=date("Y-m-d H:i:s", strtotime ("-2days"));
//echo  "<br>".$date3=date("Y-m-d H:i:s", strtotime ("-1years"));
//echo  "<br>".$date4=date("Y-m-d H:i:s", strtotime ("next Thursday"));
  $date5=date("Y-m-d", strtotime ("next Saturday"));
echo $date5;
echo "<br>----<br>";
echo date($date5, strtotime ("+7days"));
*/
  ?>

<?php
/*
Author: Daniel Kassner
Website: http://www.danielkassner.com

function getMondays($year) {
  $newyear = $year;
  $week = 0;
  $day = 0;
  $mo = 2;
  $mondays = array();
  $i = 1;
  while ($week != 1) {
   $day++;
   $week = date("w", mktime(0, 0, 0, $mo,$day, $year));
  }
  array_push($mondays,date("r", mktime(0, 0, 0, $mo,$day, $year)));
  while ($newyear == $year) {
   $test =  strtotime(date("r", mktime(0, 0, 0, $mo,$day, $year)) . "+" . $i . " week");
   $i++;
   if ($year == date("Y",$test)) {
     array_push($mondays,date("r", $test));
   }
   $newyear = date("Y",$test);
  }
  return $mondays;
}
echo '<pre>';
print_r(getMondays('2015'));
echo '</pre>';
*/
?>
<?php
function getDays($year, $startMonth=1, $startDay=1, $dayOfWeek='monday') {
    $start = new DateTime(
        sprintf('%04d-%02d-%02d', $year, $startMonth, $startDay)
    );
    $start->modify($dayOfWeek);
    $end   = new DateTime(
        sprintf('%04d-12-31', $year)
    );
    $end->modify( '+1 day' );
    $interval = new DateInterval('P1W');
    $period   = new DatePeriod($start, $interval, $end);

    foreach ($period as $dt) {
        echo $dt->format("Y-m-d") . '<br />';
    }
}

getDays(2014, 5, 26, 'monday');

?>