<?php
include '../calendar.php';
include 'database.php';
 $year = $_REQUEST['year'];
 $month = $_REQUEST['month'];
 $client_id = $_REQUEST['client_id'];
 $month = sprintf("%02d", $month);
$calendar = new Calendar();
$sql_val = mysql_query("select * from `user_program_exercises` where `client_id`='".$client_id."' and MONTH(`workout_date`) = '".$month."' and YEAR(`workout_date`) = '".$year."'");
$date_val = array();
$all_dates = array();
while($programs = mysql_fetch_array($sql_val))
{
     $date_val['date_work'] = $programs['workout_date'];
    $date_val['status'] = $programs['status'];
    $all_dates[] = $date_val;
}
echo $calendar->show($year,$month,$all_dates);

?>