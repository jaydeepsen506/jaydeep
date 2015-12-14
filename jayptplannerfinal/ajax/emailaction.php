<?php
include "database.php";
 $r=$_REQUEST['b'];
$qry=mysql_query("select * from user where email='$r'");

$num=mysql_num_rows($qry);
//echo $num;
if($num==1)
{
echo "email already exist";
}
else
{
echo "ok";
}
?>
