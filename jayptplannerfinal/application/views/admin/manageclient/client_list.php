
<?php
$obj =&get_instance();
$obj->load->model('client_model');
?>
<section id="main-content">
    <section class="wrapper"> 
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Client Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                   <tr>
							<td><strong>Client Name</strong></td>
							<td><strong>Created By Name</strong></td>
                                                        <td><strong>Client Email</strong></td>
							<td><strong>Client Age</strong></td>
                                                        <td><strong>Client Height</strong></td>
                                                        <td><strong>Client Weight</strong></td>
						    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if((!empty($all_data)) &&(count($all_data)>0)){
							
							foreach($all_data as $row)
                                                        {
						    $id = $obj->client_model->created_name($row['created_by']);
						    $dateOfBirth= $row['date_of_birth'];
						    
						if($dateOfBirth!="0000-00-00")
						{
						    $sortDateOfBirth = date('Y-m-d', strtotime($dateOfBirth));
						    $dateNow = date('Y-m-d');
						    $sortDateOfBirthArray = explode('-',$sortDateOfBirth);
						    $dateNowArray = explode('-',$dateNow);
						    $sortDateOfBirthYear = date('Y',strtotime($sortDateOfBirth));
						    $dateNowYear = date('Y',strtotime($dateNow));
						    $years = $dateNowYear - $sortDateOfBirthYear;
						    if($dateNowArray[1] < $sortDateOfBirthArray[1])
						    {
							$years--;
							}
							else if (($dateNowArray[1] == $sortDateOfBirthArray[1])&&($dateNowArray[2] < $sortDateOfBirthArray[2]))
							{
							    $years--;
							}
							//echo $years;
						}
						else{
						 //echo '$sortDateOfBirth is either 0, empty, or not set at all';
						
						}
						

                                                    ?>
                                                    <tr>
                                                        
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $id[0]['name']; ?></td>
							<td><?php echo $row['email'];?></td>
							<td><?php echo $years; ?> Yrs.</td>
							<td><?php echo $row['height']; ?> Cm.</td>
							<td><?php echo $row['weight']; ?> Kg.</td>
							
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