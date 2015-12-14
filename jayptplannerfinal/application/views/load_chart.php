<?php
  $ci=&get_instance();
  $ci->load->model('common_model');
  $graph_where=array(
	'client_id' => $client_id
  );
  $all_graphs=$ci->common_model->get('user_graph',array('*'),$graph_where);
  foreach($all_graphs as $graph){
	$where_points=array(
		'graph_id' => $graph['id']
			    );
	$graph_points=$ci->common_model->get('user_graph_points',array('*'),$where_points,null,null,null,null,null,null,'x_axis_val','ASC');
	$x_val_arr=array();
	$y_val_arr=array();
	foreach($graph_points as $point)
	{
		$x_val_arr[] = '"'.date("d/m/Y",strtotime($point['x_axis_val'])).'"';
		$y_val_arr[] = $point['y_axis_val'];
	   
	}
	$str_val_x = implode(",",$x_val_arr);
	$str_val_y = implode(",",$y_val_arr);
	if($graph['graph_type']=='B')
	{	
?>
<div class="Graphouter" id="graph_each_<?php echo $graph['id'];?>">
 <div class="datehead"><?php echo $graph['graph_for']." ( ".$graph['measure_unit']." )";?><a href="javascript:void(0)" style="float: right;
" onclick="get_measurement_popup(<?php echo $graph['id'];?>)"><i class="fa fa-plus"></i>Add Measurement</a><a href="javascript:void(0)" style="float: right;
padding-right: 21px;" onclick="get_edit_graph_popup(<?php echo $graph['id'];?>)"><i class="fa fa-pencil"></i>Edit Graph</a></div>
       <canvas id="canvas_va<?php echo $graph['id'];?>" height="450" width="600"></canvas>
	<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : [<?php echo $str_val_x;?>],
		datasets : [
			{
				fillColor : "rgba(34, 167, 240, 1)",
				strokeColor : "rgba(255, 255, 255, 1)",
				highlightFill : "rgba(34, 167, 240, 1)",
				highlightStroke : "rgba(255, 255, 255, 1)",
				data : [<?php echo $str_val_y;?>]
			}
		]

	}
	
		var ctx = document.getElementById("canvas_va<?php echo $graph['id'];?>").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	

	</script>
	</div>
	<?php
	}
	elseif($graph['graph_type']=='L')
	{
	?>
<div class="Graphouter" id="graph_each_<?php echo $graph['id'];?>">
 <div class="datehead"><?php echo $graph['graph_for']." ( ".$graph['measure_unit']." )";?><a href="javascript:void(0)" style="float: right;
" onclick="get_measurement_popup(<?php echo $graph['id'];?>)"><i class="fa fa-plus"></i>Add Measurement</a><a href="javascript:void(0)" style="float: right;
padding-right: 21px;" onclick="get_edit_graph_popup(<?php echo $graph['id'];?>)"><i class="fa fa-pencil"></i>Edit Graph</a></div>
	<canvas id="canvas_line<?php echo $graph['id'];?>" height="450" width="600"></canvas>
	<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : [<?php echo $str_val_x;?>],
		datasets : [
			{
				fillColor : "#C6E9FC",
				strokeColor : "rgba(34, 167, 240, 1)",
				highlightFill : "rgba(34, 167, 240, 1)",
				highlightStroke : "rgba(255, 255, 255, 1)",
				pointColor: "#fff",
				pointStrokeColor: "rgba(34, 167, 240, 1)",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data : [<?php echo $str_val_y;?>]
			}
		]

	}
	
		var ctx = document.getElementById("canvas_line<?php echo $graph['id'];?>").getContext("2d");
		window.myBar = new Chart(ctx).Line(barChartData, {
			responsive : true,
			pointDotRadius : 6,
			pointDotStrokeWidth : 2,
			datasetStrokeWidth : 3,

		});
	

	</script>
	</div>
<?php
	}
  }
?>