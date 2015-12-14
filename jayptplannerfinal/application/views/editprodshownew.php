<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
		$(document).ready(function(){
				//alert('hello');
				
				$('#store').change(function(){
						//alert('hello');
						var id =$("#store").val();
						//alert(id);
						$.ajax({
								url : "<?php echo site_url('control');?>/product/aja",
							   type : 'POST',
							   data : {'id' : id},
							   success : function(data){
								//alert(data);
									   $('#ajax').html(data);
							   }
						});
				});
				
				$('#remov').click(function(){
						alert('hello');
						var id =$("#hyper").val();
						alert(id);
						$.ajax({
								url : "<?php echo site_url('control');?>/product/aja_dele",
							   type : 'POST',
							   data : {'p_id' : id},
							   success : function(){
								//alert(data);
									   //$('#ajax').html(data);
							   }
						});
				});
		});
</script>
<script>
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
			var b='blah'+id;
            //alert(id);
            reader.onload = function (e) {
                $('#'+b).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function(){
      $(".imgInp").change(function(){
		var id=$(this).attr('id');
        readURL(this, id);
      });
    });
    
</script>

<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Updating <?php echo $results['p_name'];?>
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " method="post" action="<?php echo site_url("control").'/product/update/'.$this->uri->segment(4) ; ?>" enctype="multipart/form-data">
                                    <div class="form-group ">
                                        <label for="status" class="control-label col-lg-3">Select Store:</label>
                                        <div class="col-lg-6">
                                            	<select class="form-control" style="width: 100px" id="store" name="s_id">
														<?php foreach($query as $row){?>
														<option value="<?php echo $row['s_id'];?>" <?php if($row['s_id']==$results['s_id']){
																												echo "selected";
																										}?>><?php echo $row['s_name'];?></option>
														<?php } ?>							
												</select>
                                        </div>
									</div>
									<div class="form-group">
                                        <label for="status" class="control-label col-lg-3">Select brand:</label>
                                        <div class="col-lg-6">
                                            	<select class="form-control" style="width: 100px"  id="ajax" name="b_id">
														<?php //foreach($query as $row){?>
														<option value="<?php echo $results['b_id'];?>"><?php echo $results['b_name'];?></option>
																			
												</select>
                                        </div>
									</div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Product Name:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" name="p_name" value="<?php echo $results['p_name']; ?>" type="text" />
                                        </div>
                                    </div>
                                    	<div class="form-group">
                                        <label for="desc" class="control-label col-lg-3">Description</label>
                                        <div class="col-lg-6">
                                           <textarea class="form-control" name="descrip" value=""><?php echo $results['descrip'];?></textarea>
										</div>
									</div>
                                     <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Price:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" name="price" value="<?php echo $results['price'];?>" type="text" />
                                        </div>
                                    </div>
								<!--<div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3"></label>
                                        <div class="col-lg-6">
                                            <img src="<?php //echo base_url();?>uploads/<?php //echo $results['pic'];?>" width="200px" height="200px">
                                        </div>
                                </div>-->
								<?php $c=1;
										foreach($results2 as $t){?>
										<input type="hidden" name="abcd[]" value="<?php echo $results['p_id'];?>">
										<input type="hidden" name="xyz[]" value="<?php echo $t['pro_pic_id'];?>">
										<?php //print_r($results2);?>
										<div class="form-group ">
												<label for="p" class="control-label col-lg-3"></label>
												<div class="col-lg-6">
												<img class="bi" id="blah<?php echo $c;?>" src="<?php echo base_url();?>uploads/<?php echo $t['pic'];?>" width="200px" height="200px">
												&nbsp;
												<input type="hidden" id="hyper" value="<?php echo  $t['pro_pic_id'];?>">
												<button class="btn btn-default" id="remov">Remove</button>
												
												</div>
										</div>		
								
								<div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Picture <?php echo $c;?>:</label>
                                        <div class="col-lg-6">
                                            <input type="file" name="pic1[]" class="imgInp" id="<?php echo $c; $c++;?>"/>
                                        </div>
                                </div>
								<?php }?> 
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/product';">Cancel</button>
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
