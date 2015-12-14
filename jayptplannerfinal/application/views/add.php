<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  static pages.
|-->

<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Store
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="editPage" method="post" action="<?php echo site_url("control").'/pages/addstore/' ; ?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Store Name:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" name="s_name" value="" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Store Address:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" name="s_address" value="" type="text" />
                                        </div>
                                    </div>
                                    
                                   
				    
				    
				    

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Add</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>index.php/control/store';">Cancel</button>
                                        </div>
                                    </div>
                                </form>

				
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>