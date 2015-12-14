<?php
function exists($uri)
{
    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $code == 200;
}
foreach($exer_info as $exer)
{
    if($mode == 'list')
    {
      $media = 'https://exorlive.com/media_'.$exer['image_id'].'@50.50.media'
        ?>
        <div class="editblog">
            <div class="workimg"><img alt="image view" src="<?php echo $media; ?>"></div>
            <div class="workouttxt"><?php
            if(strlen($exer['title']) > 25)
            {
                echo substr($exer['title'],0,25)."..";
            }
            else{
                echo $exer['title'];
            }
            
            
            ?> </div>
            <div class="editright"> <a href="javascript:void(0)" onclick="fetch_exer_detail(<?php echo $exer['id']; ?>)">View</a> </div>
        </div>
        <?php
    }
    else{
        $media = 'https://exorlive.com/media_'.$exer['image_id'].'@50.50.media'
        ?>
        <li class="ui-state-default-val" id="<?php echo $exer['id']."##".$type_id; ?>">
            <div class="editblog">
            <div class="workimg"><img alt="" src="<?php echo $media; ?>"></div>
            <div class="workouttxt"><?php
            
            if(strlen($exer['title']) > 15)
            {
                echo substr($exer['title'],0,15)."..";
            }
            else{
                echo $exer['title'];
            }
            ?> </div>
            <div class="editright">
                <a class="butsblue" href="javascript:void(0)" onclick="add_to_program($(this))">
                    Add
                </a>
                <!--<a href="javascript:void(0)"><img src="<?php echo base_url();?>assets/site/after_login/images/strapicon.png" alt=""></a>-->
            </div>
          </div>
        </li>
        
        <?php
    }
    
}
?>