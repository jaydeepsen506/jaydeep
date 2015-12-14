<?php
    if(!isset($_SERVER['HTTP_REFERER'])) {
        exit;
    }
    include('../database.php');
    $sql='';
    if(isset($_REQUEST['cat'])){
        $cat_name=$_REQUEST['cat'];
        $sql="select * from faq_category where category_name='$cat_name'";
    }
    $res=mysql_query($sql);
    $check=mysql_num_rows($res);
    if($check > 0)
    {
        //echo "<div>User name alerady exist..</div>";
        echo 'false';
    }
?>