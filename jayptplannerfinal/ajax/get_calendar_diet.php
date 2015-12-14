<?php
include '../calendar_diet.php';
include 'database.php';
 $year = $_REQUEST['year'];
 $month = $_REQUEST['month'];
 $client_id = $_REQUEST['client_id'];
 $month = sprintf("%02d", $month);
$calendar = new Calendar_diet();
$sql_val = mysql_query("select * from `user_meal_dates` where `client_id`='".$client_id."' and MONTH(`workout_date`) = '".$month."' and YEAR(`workout_date`) = '".$year."'");
$date_val = array();
while($programs = mysql_fetch_array($sql_val))
{
     $date_val[] = $programs['workout_date'];
}
echo $calendar->show($year,$month,$date_val);

?>