<?php
include '../calendar_diary.php';
include 'database.php';
 $year = $_REQUEST['year'];
 $month = $_REQUEST['month'];
 $client_id = $_REQUEST['client_id'];
 $month = sprintf("%02d", $month);
$calendar = new Calendar_diary();
$sql_val = mysql_query("select * from `user_diary` where `client_id`='".$client_id."' and MONTH(`date_val`) = '".$month."' and YEAR(`date_val`) = '".$year."'");
$date_val = array();
while($programs = mysql_fetch_array($sql_val))
{
     $date_val[] = $programs['date_val'];
}
echo $calendar->show($year,$month,$date_val);

?>