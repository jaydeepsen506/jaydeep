<?php
foreach($exer_info as $exer)
{
        ?>
        <li id="<?php echo $exer['id']; ?>">
            <div class="editblog">
              
                 <div class="workouttxt"><?php echo $exer['name'];?> </div>
                 
                 <div class="editright">
                        <a class="butsblue" href="javascript:void(0)" onclick="add_program(<?php echo $exer['id']; ?>);">Add</a>
                     </div>
                 
             </div>
            </li>
        <?php
   
}
?>