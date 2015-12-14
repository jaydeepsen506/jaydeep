<?php
include('database.php');


 $new_user_name=$_REQUEST['new_user_name'];
 $h_user_name=$_REQUEST['h_user_name'];


if($new_user_name && $h_user_name){
$query="select id from trainer where email='".$new_user_name."' and email!='".$h_user_name."'";
$result=mysql_query($query);
 $chk=mysql_num_rows($result);


if($chk > 0){
    echo 'yes';
}
else{
    echo 'no';
}
}
?>