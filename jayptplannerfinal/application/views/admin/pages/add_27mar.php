<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  static pages.
|-->
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            ADD PAGE
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="editPage" method="post" action="<?php echo site_url("control").'/pages/add/'.$this->uri->segment(4) ; ?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Page Title:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="page_title" name="page_title" value="" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Meta Tag:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="page_tag" name="page_tag" value="" type="text" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Meta Keywords:</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="page_key" name="page_key" value="" type="text" />
                                        </div>
                                    </div>
				     <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Meta Description:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="meta_description" name="meta_description"></textarea>
                                                <script>
							CKEDITOR.replace('meta_description');
						</script>
					
					</div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Alias:</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="page_alias" name="page_alias" value="" type="text" />
                                        </div>
                                    </div>
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="page_content" name="page_content"></textarea>
                                                <script>
							CKEDITOR.replace('page_content');
						</script>
					
					</div>
                                    </div>
				    
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Status:</label>
                                        <div class="col-lg-6">
                                            	<select class="form-control" style="width: 300px" id="source" name="status">
							<optgroup label="<?php echo $page[0]['page_title'];?> Page Status">
								<option value="Y"  >Active</option>
								<option value="N"  >Block</option>
							</optgroup>
                                        	</select>
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