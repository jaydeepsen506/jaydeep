
<?php
$obj =&get_instance();
$obj->load->model('booking_model');
?>
<section id="main-content">
    <section class="wrapper"> 
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Booking Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                   <tr>
							<td><strong>Trainer Name</strong></td>
                                                        <td><strong>Client Name</strong></td>
							<td><strong>Booking By</strong></td>
                                                        <td><strong>Booked Date</strong></td>
                                                        <td><strong>Booked Time Start</strong></td>
							<td><strong>Booking Time End</strong></td>
							<td><strong>Booking Date</strong></td>
							<td><strong>Program Name</strong></td>
							
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if((!empty($all_data)) &&(count($all_data)>0)){
							
                    
                                                        foreach($all_data as $row)
                                                        {
							    
					
						     $id = $obj->booking_model->trainer_name($row['trainer_id']);
						    $id1 = $obj->booking_model->trainer_name1($row['client_id']);
						    $id2 = $obj->booking_model->trainer_name2($row['booked_by']);
						    $id3 = $obj->booking_model->trainer_name3($row['program_id']);
						     
                                                    ?>
                                                    <tr>
                                                        
							<td><?php echo $id[0]['name']; ?></td>
							<td><?php echo $id1[0]['name']; ?></td>
							<td><?php echo $id2[0]['name']; ?></td>
							<td><?php echo $row['booked_date']; ?></td>
							<td><?php echo $row['booking_time_start'];?></td>
							<td><?php echo $row['booking_time_end']; ?></td>
							<td><?php echo $row['booking_date']; ?></td>
							<td><?php echo $id3[0]['name']; ?></td>
							
							
						    </tr>    
                                            </div>
                                    </div>
                                </div>
                                <?php
                                      }
			     ?>
                             <?php }
                             else
                             {
                                echo "No Result Found";
                             }
                             ?>
                    </tbody>				
	    </div>  	
                </section>
	       </div>
        </section>
    </section>