<?php
include '../calendar_appointment.php';
include 'database.php';
 $year = $_REQUEST['year'];
 $month = $_REQUEST['month'];
 $trainer_id = $_REQUEST['trainer_id'];
 $month = sprintf("%02d", $month);
$calendar = new Calendar_appointment();

$sql_val = mysql_query("select * from `trainer_avail_time` where `trainer_id`='".$trainer_id."'");
 $tot_hours = 0;
while($avl_time = mysql_fetch_array($sql_val) )
{
    $time1 = new DateTime($avl_time['avl_time_from']);
    $time2 = new DateTime($avl_time['avl_time_to']);
    $interval = $time1->diff($time2);
    $hours = $interval->h;
    $tot_hours = $tot_hours + $hours;
}

$sql_val_dates = mysql_query("select * from `user_booking` where `trainer_id`='".$trainer_id."' and MONTH(`booked_date`) = '".$month."' and YEAR(`booked_date`) = '".$year."' group by `booked_date`");
$date_val = array();
$all_dates = array();

if(mysql_num_rows($sql_val_dates) > 0)
{
    
    while($programs = mysql_fetch_array($sql_val_dates))
    {
       
        $sql_val_dates_new = mysql_query("select * from `user_booking` where `trainer_id`='".$trainer_id."' and `booked_date` = '".$programs['booked_date']."'") or die(mysql_error());
         $date_val['date_work'] = $programs['booked_date'];
         if(mysql_num_rows($sql_val_dates_new) < $tot_hours )
         {
            $date_val['status'] = 'A';
         }
         else{
            $date_val['status'] = 'F';
        
        }
        
        $all_dates[] = $date_val;
    }
}
echo $calendar->show($year,$month,$all_dates);

?>