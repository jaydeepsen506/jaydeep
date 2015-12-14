<?php
include('../database.php');

$loadId=$_REQUEST['country_id'];	
	
$sql="select * from `state` where `country_name`='".$loadId."'";
$res=mysql_query($sql) or die(mysql_error());
$check=mysql_num_rows($res);


if($check > 0)
{
?>
	
	<select  class="form-control valid" name="state_id" id="state_id">
		<option value="">Please Select</option>
		<?php
		
		while($row=mysql_fetch_array($res))
		{
		?>
			<option value="<?php echo $row['state_id']; ?>"  ><?php echo $row['state']; ?></option>
		<?php
		}
		?>
	</select>
<?php
}
else
{
?>
	
	<select class="form-control valid" name="state" id="state">
		<option value="0"  selected= "selected" >No States Availiable</option>
	</select>
	
<?php
}
?>