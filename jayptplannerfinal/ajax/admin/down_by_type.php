<?php
 if(!isset($_SERVER['HTTP_REFERER'])) {
	exit;
 }
 include('../database.php');
 
 $type_id=$_REQUEST['type_id'];
 //$loadId=$_POST['country_id'];
 $sql="select * from faq_category where type_id='$type_id' order by id asc";
 $res=mysql_query($sql);
 $check=mysql_num_rows($res);
 if($check > 0)
 {
?>
      <select name="faq_cat_type">
	<option value="">-- Please Select --</option>
	<?php
	  while($row=mysql_fetch_array($res))
	  {
	?>
	      <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
	<?php	}	?>
     </select>
<?php
}
else
{
?>
      <select name="faq_cat_type">
	<option value="">-- Please Select --</option>
      </select>
<?php
}
?>