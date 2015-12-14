<?php
include('../database.php');

$loadId=$_REQUEST['country_id'];	
	
$sql="select * from state where country_id='".$loadId."' order by state_name asc";
$res=mysql_query($sql);
$check=mysql_num_rows($res);


if($check > 0)
{
?>
	
	<select  class="form-control valid" style="width: 300px" name="state" id="state">
		<option value="">Please Select</option>
		<?php
		
		while($row=mysql_fetch_array($res))
		{
		?>
			<option value="<?php echo $row['id']; ?>"  ><?php echo $row['state_name']; ?></option>
		<?php
		}
		?>
	</select>
	
<?php
}
else
{
?>
	
	<select class="form-control valid" style="width: 300px" name="state" id="state">
		<option value="0"  selected= "selected" >No States Availiable</option>
	</select>
	
<?php
}
?>