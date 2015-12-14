<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
foreach($all_meal as $meals)
{
    $where_meal_exer=array(
    'meal_id' => $meals['id']
         );
    $meal_info_image=$ci->common_model->get('meal_images',array('*'),$where_meal_exer);
     if(isset($meal_info_image[0]['filename']))
    {
        $media = base_url().'meal_images/'.$meal_info_image[0]['filename'];
    }
    else
    {
        $media = base_url().'assets/site/after_login/images/no-image.gif';
    }
   // $media = base_url().'meal_images/'.$meal_info_image[0]['filename'];
   ?>
   <div class="editblog">
        <div class="workimg"><img alt="" src="<?php echo $media; ?>" style="height: 50px;width: 50px;"></div>
        <div class="workouttxt">
            <?php
            if(strlen($meals['title']) > 15)
            {
                echo substr($meals['title'],0,15)."..";
            }
            else{
                echo $meals['title'];
            }
            ?>
        </div>
         <div class="editright fc"> <a href="javascript:void(0)" onclick="get_edit_popup(<?php echo $meals['id'];?>)">Edit</a> </div>
    </div>
   <?php
}
?>