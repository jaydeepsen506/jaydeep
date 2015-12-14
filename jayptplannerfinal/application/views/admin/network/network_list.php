<!--|
| Copyright @ 2015 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for listing of all trainer.
|-->
<?php
$ci=&get_instance();
$ci->load->model('network_model');
?>
<section id="main-content">
    <section class="wrapper"> 
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Network
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                   <tr>
                                                        <td><strong>Name</strong></td>
                                                        <td><strong>Created By</strong></td>
                                                        <td><strong>Creation Date</strong></td>
                                                        <td><strong>Number of members</strong></td>
                                                        <td><strong>Status</strong></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if((!empty($network_data)) &&(count($network_data)>0)){
                    
                                                        foreach($network_data as $row)
                                                        {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['network_name']; ?></td>
							<?php
							   $user_det=$ci->network_model->get_user_information($row['created_by']);
							?>
                                                        <td><?php echo $user_det[0]['name'];?></td>
                                                        <td><?php echo date('Y-m-d',strtotime($row['created_date']));?></td>
							<?php
							$total_member=$ci->network_model->get_total_members($row['id']);
							?>
                                                        <td><?php echo $total_member;?></td> 
                                                        <td>
                                                             <?php if($row['status']=='Y')
                                                                     {
                                                                        echo "Active";
                                                                     }else {
                                                                          echo "Inactive";
                                                                     }
                                                             ?>
                                                        </td>
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