<?php
$ci=&get_instance();
$ci->load->model('network_model');
$ci->load->model('common_model');

?>

<script src="<?php echo base_url(); ?>assets/site/after_login/js/circles.min.js"></script>
<?php
$trainer_id = $this->session->userdata('site_user_id');

$where_meal_book=array(
'trainer_id' => $this->session->userdata('site_user_id')
     );
$get_time = $this->common_model->get('trainer_avail_time',array('*'),$where_meal_book);

$monthly_dates=$ci->network_model->get_dates_within_week();
$book_counter = 0;
$avail_counter = 0;
$total_counter = 0;
foreach($monthly_dates as $dates)
{
    
    if(count($get_time) > 0)
    {
        foreach($get_time as $time_avl)
        {
             $start_time = date("H",strtotime($time_avl['avl_time_from']));
            $end_time = date("H",strtotime($time_avl['avl_time_to']));
         
            for($time=$start_time;$time<$end_time;$time++)
            {
                $val_time = $time;
                 $start_book = str_pad($time,2,'0',STR_PAD_LEFT).":00";
                 $end_time_val = ($val_time + 1);
                 $end_book = str_pad($end_time_val,2,'0',STR_PAD_LEFT).":00";
                 
                 $where_exists=array(
                'trainer_id' => $this->session->userdata('site_user_id'),
                'booked_date' => date("Y-m-d",strtotime($dates['repeat_date'])),
                'booking_time_start' => date("H:i:s",strtotime($start_book)),
                'booking_time_end' => date("H:i:s",strtotime($end_book))
                     );
                $get_check = $this->common_model->get('user_booking',array('*'),$where_exists);
                if(count($get_check) > 0)
                {
                   
                    $book_counter++;
                 
                }
                else{
                    $avail_counter++;
                }
                $total_counter++;
               
            }
        }
    }
}


 $avl_per = number_format((($avail_counter/$total_counter) * 100),2);
 $avl_book = number_format((($book_counter/$total_counter) * 100),2);
?>

<div class="col-sm-6 time-part">
<div class="circle" id="circles-1"></div>
    <!--<img src="assets/site/after_login/images/time-1.png" alt="" />-->
    <h3>available for appoinment</h3>
    <span><?php echo $avail_counter; ?>hrs</span>
</div>

<div class="col-sm-6 time-part">
<div class="circle" id="circles-2"></div>
    <!--<img src="assets/site/after_login/images/time-1.png" alt="" />-->
    <h3>booked appoinment</h3>
    <span><?php echo $book_counter; ?>hrs</span>
</div>


<style>
		#canvas .circle {
			display: inline-block;
			margin: 1em;
		}

		.circles-decimals {
			font-size: .4em;
		}
                .circles-text{
                    font-size: 25px !important;
                }
	</style>
<script>
    var percentage = '<?php echo $avl_per; ?>';
    Circles.create({
    id:         'circles-1',
    value: percentage,
    radius:     70,
    width:      20,
    text:       '<?php echo $avail_counter; ?>Hrs',
    colors:     ['#BEE3F7', '#45AEEA']
})
    Circles.create({
    id:         'circles-2',
    value: <?php echo $avl_book; ?>,
    radius:     70,
    width:      20,
    text:       '<?php echo $book_counter; ?>Hrs',
    colors:     ['#BEE3F7', '#45AEEA']
})
</script>