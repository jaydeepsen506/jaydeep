<section id="main-content">
    <section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Contact Details
            </header>
                <div class="panel-body">
                    <div class="form">
	       
              <form class="cmxform form-horizontal" id="user_form" name="user_form" align="center" method="post" enctype="multipart/form-data" action="<?php echo site_url("control").'/subadmin/insert' ; ?>">

                	
                          <div class="form-group ">
                                     <label for="firstname" class="control-label col-lg-3">First name:</label>
                                        <div class="col-lg-5">
                                         <p class="form-control-static pull-left"> 
					  <?php echo $userdata[0]->first_name ?>
					 </p> 
                                         </div>
			  </div>     
                               
                          <div class="form-group ">
                                     <label for="lastname" class="control-label col-lg-3">Last Name:</label>
                                        <div class="col-lg-5">
					     <p class="form-control-static pull-left"> 
                                           <?php echo $userdata[0]->last_name ?>
					   </p>
                                         </div>
			  </div>
                                              
                           <div class="form-group ">
                                     <label for="email" class="control-label col-lg-3">Email:</label>
                                        <div class="col-lg-5">
					     <p class="form-control-static pull-left"> 
                                            <?php echo $userdata[0]->contact_email ?>
					     </p>
                                        </div>
			  </div>
                                                                                       
                          
                          <div class="form-group ">
                                     <label for="subject" class="control-label col-lg-3">Subject:</label>
                                        <div class="col-lg-5">
					      <p class="form-control-static pull-left"> 
                                                <?php echo $userdata[0]->subject ?>
					      </p>
                                        </div>
			  </div>
                            
                          <div class="form-group ">
                                     <label for="message" class="control-label col-lg-3">Message:</label>
                                        <div class="col-lg-5">
					    <p class="form-control-static pull-left"> 
                                            <?php echo $userdata[0]->message ?>
					    </p>
                                        </div>
			  </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6">
                                <button class="btn btn-default pull-left" type="button" onclick="location.href='<?php echo base_url();?>control/managecontact';">Back</button>
                                </div>
                            </div>
                        </form>
                </div>
             </div>       

	</section>
   </div>
    </div>    
    </section>
</section>
