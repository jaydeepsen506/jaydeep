<?php
$CI =& get_instance();
$CI->load->model('trainer_model');
$result = $CI->trainer_model->trainers();

$result1 = count($result);
echo $result1;
?>
<section id="main-content">
    <section class="wrapper">
        
        <?php
	        //echo "<pre>";print_r($langs);exit;
	
		//flash messages
		$flash_message=$this->session->flashdata('flash_message');
		if(isset($flash_message)){
	
		    if($flash_message == 'pages_updated')
		    {
			echo '<div class="alert alert-success">';
			echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Changes have been successfully updated.';
			echo '</div>';
		    }
		    if($flash_message == 'pages_not_updated'){
			echo'<div class="alert alert-error">';
			echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in updation. Please try again.';        
			echo'</div>';
		    }
		    
		     if($flash_message == 'pages_inserted')
		    {
			echo '<div class="alert alert-success">';
			echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Data has been successfully inserted.';
			echo '</div>';
		    }
		    if($flash_message == 'pages_not_inserted'){
			echo'<div class="alert alert-error">';
			echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in insertion. Please try again.';        
			echo'</div>';
	    
		    }
	
		    if($flash_message == 'error'){
			echo'<div class="alert alert-error">';
			echo'<i class="icon-remove-sign"></i><strong>Error!</strong> . Please try again.';        
			echo'</div>';
		    }
			    
		}
	?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Manage Trainer
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
								
                                                   <tr>
                                                       <td><strong>Name</strong></td>
                                                        <td><strong>Email</strong></td>
                                                        <td><strong>Company</strong></td>
                                                        <td><strong>Phone</strong></td>
                                                        <td><strong>Billing Address</strong></td>
                                                        <td><strong>No of Active Clients</strong></td>
                                                        <td><strong>No of Inactive Clients</strong></td>
							<td><strong>Registred Date</strong></td>
							<td><strong>Exp Date</strong></td>
							<td><strong>User Mode</strong></td>
                                                        <td><strong>Status</strong></td>
                                                        
                                                        <td><strong>Edit</strong></td>
                                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if((!empty($userdata)) &&(count($userdata)>0)){
                    
                                                        foreach($userdata as $row)
                                                        {
                                                            
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['name']; ?></a></td>
                                                        <td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['email'];?></a></td>
                                                        <td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['company'];?></a> </td>
                                                        <td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['phone'];?></a> </td>
                                                        <td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['billing_address'];?></a> </td>
                                                        <td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['active_client'];?></a> </td>
                                                        <td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['inactive_client'];?></a> </td>
							<td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['created_date'];?></a> </td>
							<td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"><?php echo $row['expiry_date'];?></a> </td>
							<td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>"></a> 
							  <?php if($row['user_mode']=='T')
                                                                     {
                                                                        echo "Trial";
                                                                     }elseif ($row['user_mode']=='P'){
                                                                        echo "Paid";
                                                                     }
                                                             ?>
							</td>
                                                        <td><a href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>">
                                                            
							     <?php if($row['status']=='Y')
                                                                     {
                                                                        echo "Active";
                                                                     }else {
                                                                        echo "Inactive";
                                                                     }
                                                             ?>
                                                            </a>
                                                        </td>
							
							
                                                        
                                                        <td>
                                                            <a class="fa fa-edit" href="<?php echo site_url("control").'/managetrainer/edit/'.$row['id']; ?>" > </a>
                                                        </td>
                                                    </tr>
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
					 </table>
					</div>
                                    </div>
                                </div>
	   <!-- </div>-->  	
                </section>
	       </div>
	    </div>
        </section>
    </section>