<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');

$day_name = date('l', strtotime($date_val));
if(count($diary_info) > 0)
{
    foreach($diary_info as $diary)
    {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading panel-border">
               <h4><?php echo $diary['diary_heading']; ?></h4>
                <?php echo $diary['dairy_text']; ?>
             </div>
         </div>
        <?php
    }
}
echo "@@##@@";
//$monthNum = sprintf("%02d", $month_val);
echo $monthName = date("F", mktime(0, 0, 0, sprintf('%02d',$month_val), 10));
?>