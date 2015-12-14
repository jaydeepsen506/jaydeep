<?php
include('../database.php');

$loadId=$_REQUEST['state_id'];	
	
$sql="select * from `city` where `state_id`='".$loadId."'";
$res=mysql_query($sql) or die(mysql_error());
$check=mysql_num_rows($res);


if($check > 0)
{
?>
	
	<select  class="form-control valid" name="city_id" id="city_id">
		<option value="">Please Select</option>
		<?php
		
		while($row=mysql_fetch_array($res))
		{
		?>
			<option value="<?php echo $row['id']; ?>"  ><?php echo $row['name']; ?></option>
		<?php
		}
		?>
	</select>
<?php
}
else
{
?>
	
	<select class="form-control valid" name="city_id" id="city_id">
		<option value="0"  selected= "selected" >No City Availiable</option>
	</select>
	
<?php
}
?>