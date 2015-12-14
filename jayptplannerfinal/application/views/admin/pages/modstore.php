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
                            UPDATE STORE
                        </header>
                        <div class="panel-body">
                            <div class="form">
								
                                <form class="cmxform form-horizontal " id="editPage" method="post" action="<?php echo site_url("control").'/pages/addstore/'.$this->uri->segment(4) ;;?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3"> STORE NAME:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="page_title" name="page_nm" value="<?php echo $result['s_name']; ?>" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">STORE ADDRESS</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="page_title" name="page_add" value="<?php echo $result['s_add'];  ?>" type="text" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/pages';">Cancel</button>
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
