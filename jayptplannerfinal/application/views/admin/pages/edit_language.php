<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  static pages language.
|-->
<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/ckeditor/ckeditor.js"></script>
<?php // echo "<pre>";print_r($page);exit;  ?>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Updating Page
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="editPage" method="post" action="<?php echo site_url("control").'/pages/updatelang/'.$this->uri->segment(4).'/'.$this->uri->segment(5) ; ?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Page Title:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="page_title" name="page_title" value="<?php if(isset($page[0]['value'])) { echo $page[0]['value']; } ?>" type="text" />
                                        </div>
                                    </div>
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Content:</label>
                                        <div class="col-lg-6">
						<textarea class="" rows="9" name="page_content" id="page_content"><?php if(isset($page[1]['value'])) { echo $page[1]['value']; } ?></textarea>
						<script>
							CKEDITOR.replace('page_content');
						</script>
                                         </div>
                                    </div>
                                    <input type="hidden" name="title_id"  id="title_id" value="<?php if(isset($page[0]['id'])) { echo $page[0]['id']; } ?>"  >
                                    <input type="hidden" name="content_id"  id="content_id" value="<?php if(isset($page[1]['id'])) { echo $page[1]['id']; } ?>"  >
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