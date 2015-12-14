<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/ckeditor/ckeditor.js"></script>
<section id="main-content">
        <section class="wrapper"><?php /*print_r($results);*/ ?>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Updating <?php echo $results['s_name'];?>
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " method="post" action="<?php echo site_url("control").'/storesettings/update/'.$this->uri->segment(4) ; ?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Store Name:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" name="s_name" value="<?php echo $results['s_name']; ?>" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Store Address:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" name="s_address" value="<?php echo $results['s_add']; ?>" type="text" />
                                        </div>
                                    </div>
<div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/store';">Cancel</button>
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
