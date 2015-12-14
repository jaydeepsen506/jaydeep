<?php
include('database.php');
$email_id=$_REQUEST['email_id'];
$select="select * from user where email='".$email_id."'";
$select_query=mysql_query($select) or mysql_error();
$count=mysql_num_rows($select_query);
if($count>0)
{
    echo "false";
   
}
else{
     echo "";
    
    
}
?>