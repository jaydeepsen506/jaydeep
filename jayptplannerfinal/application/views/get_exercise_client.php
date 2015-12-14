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
    
        $media = 'https://exorlive.com/media_'.$exer['image_id'].'@50.50.media'
        ?>
        <li id="<?php echo $exer['id']."##".$type_id; ?>">
         <div class="panel-body">
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
                <a class="butsblue" href="#" data-toggle="modal" data-target="#PROGRAM-INFORMATION" onclick="add_exer_to_program(<?php echo $exer['id']; ?>)">
                    Add
                </a>
            </div>
          </div>
         </div>
        </li>
        
        <?php
   
    
}
?>