<?php
class Client_progress extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		// load models
		$this->load->model('sitesetting_model');
		$this->load->model('contactsetting_model');
		$this->load->model('common_model');
		$this->load->model('network_model');
                $this->load->model('toolbox_model');
                $this->load->model('progress_model');
	}
        
       	public function client_curr_image_upload()
	{
		$client_id=$this->input->post('client_id');
		$arr="";
                foreach ($_FILES["file"]["error"] as $key => $error){
			if ($error == UPLOAD_ERR_OK){
			  $time=time();  // time on creation
			  $random_num=rand(00,99);  // random number
			  $name = $time.$random_num.$_FILES["file"]["name"][$key]; // avoid same file name collision
			if(move_uploaded_file( $_FILES["file"]["tmp_name"][$key], getcwd()."/client_current_images/" . $name))
			{
			  $this->create_thumb($name);
			    $data_iamge=array(
				'client_id' => $client_id,
				'image_name' => $name,
				'upload_date' => date('Y-m-d')
						);
			  $add_image=$this->common_model->add('client_current_images',$data_iamge);
			  $arr=$arr.$name.",";
			}
			else
			 {
			   echo "0";
			   exit;
			 }
	                 }
                }
                echo $arr;
	}
	
	public function add_client_current_image(){
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
		     echo $client_id=$this->input->post('client_id');
		     echo $uploaded_image=$this->input->post('uploaded_curr_image_name');die();
		     $image_arr=explode(",",$uploaded_image);
		     for($i=1;$i<sizeof($image_arr);$i++)
		       {
			   $data_iamge=array(
				'client_id' => $client_id,
				'image_name' => $image_arr[$i],
				'upload_date' => date('Y-m-d')
						       );
			   
			  $add_image=$this->common_model->add('client_current_images',$data_iamge);
		       }
		        $this->session->set_flashdata('flash_message', 'progress_tab');
		}
		 redirect('client-profile/'.$client_id);
	}
	function create_thumb($imagename)
        {
            $config['image_library'] = 'gd2';
            $config['source_image']= 'client_current_images/'.$imagename;
            $config['new_image'] = 'client_current_images/thumb/';
            //$config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width']	 = 169;
            $config['height']	= 236;
            
            //$this->image_lib->initialize($config);
            //$this->load->library('image_lib', $config); 
            //$result=$this->image_lib->resize();
            //$this->image_lib->clear();
	    $this->load->library('image_lib');
		$this->image_lib->resize();
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		 if ( ! $this->image_lib->resize()){
                         return array('errors' => $this->image_lib->display_errors());
                 }
            
         }
	public function remove_uploaded_image() /////Delete Only uploaded but not saved images from edit pop -up
	{
		$image_name=$this->input->post('image_name');
		$string_val=$this->input->post('string_val');
		$new_list=array();
		$file=getcwd().'/client_current_images/'.$image_name;
		if(unlink($file))
		{
		        $str_arr=explode(",",$string_val);
			foreach($str_arr as $key=>$value)
			{
			    if($value!=$image_name)
			    {
				array_push($new_list,$value);
			    }
			}
			$new_string=implode(",",$new_list);
			echo $new_string;
		}
		else
		{
		 echo "error";
		}
	}
	public function client_goal_image_upload()
	{
		$client_id=$this->input->post('client_id');
		$get_info=$this->progress_model->get_client_goal_image($client_id);
		$arr="";
                foreach ($_FILES["file"]["error"] as $key => $error){
			if ($error == UPLOAD_ERR_OK){
			  $time=time();  // time on creation
			  $random_num=rand(00,99);  // random number
			  $name = $time.$random_num.$_FILES["file"]["name"][$key]; // avoid same file name collision
			if(move_uploaded_file( $_FILES["file"]["tmp_name"][$key], getcwd()."/client_goal_images/" . $name))
			{
			        $error= $this->create_thumb_goal($name);
			        if(count($get_info)==0)
					{
					    $data_iamge=array(
						   'client_id' => $client_id,
						   'image_name' => $name,
						   'upload_date' => date('Y-m-d')
									  );
					    $add_image=$this->common_model->add('client_goal_images',$data_iamge);
					}
				else{
					      $data_iamge=array(
						   'image_name' => $name,
						   'upload_date' => date('Y-m-d')
									  );
					      $where=array(
						   'client_id' => $client_id
							   );
					     $add_image=$this->common_model->update('client_goal_images',$data_iamge,$where);
					}
			        $arr=$arr.$name.",";
			}
			else
			 {
			   echo "0";
			   exit;
			 }
	                 }
                }
                echo $arr;
	}
	function create_thumb_goal($imagename)
        {
		$config['image_library'] = 'gd2';
		$config['source_image']= 'client_goal_images/'.$imagename;
		$config['new_image'] = 'client_goal_images/thumb/';
		//$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['width']	 = 169;
		$config['height']	= 236;
	        $this->load->library('image_lib');
		$this->image_lib->resize();
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		 if ( ! $this->image_lib->resize()){
                         return array('errors' => $this->image_lib->display_errors());
                 }
            
         }
	public function add_client_goal_image(){
				
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
		     $client_id=$this->input->post('client_id');
		     $uploaded_image=$this->input->post('uploaded_goal_image_name');
		     $image_arr=explode(",",$uploaded_image);
		     $get_info=$this->progress_model->get_client_goal_image($client_id);
		     if(count($get_info)==0)
		     {
			 $data_iamge=array(
				'client_id' => $client_id,
				'image_name' => $image_arr[1],
				'upload_date' => date('Y-m-d')
						       );
			 $add_image=$this->common_model->add('client_goal_images',$data_iamge);
		     }
		     else{
			   $data_iamge=array(
				'image_name' => $image_arr[1],
				'upload_date' => date('Y-m-d')
						       );
			   $where=array(
				'client_id' => $client_id
					);
			  $add_image=$this->common_model->update('client_goal_images',$data_iamge,$where);
		     }
		        $this->session->set_flashdata('flash_message', 'progress_tab');
		}
		 redirect('client-profile/'.$client_id);
	}
	
	public function remove_uploaded_goal_image(){
		$image_name=$this->input->post('image_name');
		$string_val=$this->input->post('string_val');
		$new_list=array();
		$file=getcwd().'/client_goal_images/'.$image_name;
		$file1=getcwd().'/client_goal_images/thumb/'.$image_name;
		if(unlink($file) && (unlink($file1)))
		{
		        $str_arr=explode(",",$string_val);
			foreach($str_arr as $key=>$value)
			{
			    if($value!=$image_name)
			    {
				array_push($new_list,$value);
			    }
			}
			$new_string=implode(",",$new_list);
			echo $new_string;
		}
		else
		{
		 echo "error";
		}
	}
	public function color_box(){
		$this->load->view('check_color_box');
	}
	
	public function get_more_graph_div(){ ///Function for fetching graphn measure ment div
		
	    $data['count']=$this->input->post('count');
	    $this->load->view('graph_val',$data);
	}
	
	public function add_graph_information(){ ////Function for adding graph information
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
			$graph_type=$this->input->post('graph_type');
			$graph_for=$this->input->post('graph_for');
			$measure_unit=$this->input->post('measure_unit');
			$x_axis_val=$this->input->post('xval');
			$y_axis_val=$this->input->post('yval');
			$client_id=$this->input->post('client_id');
			$data_graph=array(
				'client_id' => $client_id,
				'graph_type' => $graph_type,
				'graph_for' => $graph_for,
				'measure_unit' => $measure_unit
					  );
			$add_graph_info=$this->common_model->add('user_graph',$data_graph);
			if($add_graph_info != 0){
				for($i=0;$i<count($x_axis_val);$i++)
				{
					$data_measure=array(
						'graph_id' => $add_graph_info,
						'x_axis_val' => date('Y-m-d',strtotime($x_axis_val[$i])),
						'y_axis_val' => $y_axis_val[$i],
							    );
					$add_measure_info=$this->common_model->add('user_graph_points',$data_measure);
				}
			}
			 $this->session->set_flashdata('flash_message', 'progress_tab');
			redirect('client-profile/'.$client_id);
		}
		else{
			redirect('home');
		}
	}
	public function load_chart(){
		$data['client_id']=$this->input->post('client_id');
		$this->load->view('load_chart',$data);
	}
	
	public function edit_graph(){
		$data['client_id']=$this->input->post('client_id');
		$data['graph_id']=$this->input->post('graph_id');
		$where_graph=array(
			'id' => $this->input->post('graph_id')
				   );
		$data['graph']=$this->common_model->get('user_graph',array('*'),$where_graph);
		$where_val=array(
			'graph_id' => $this->input->post('graph_id')
				 );
		$data['axis_val']=$this->common_model->get('user_graph_points',array('*'),$where_val,null,null,null,null,null,null,'id','ASC');
		$data['first_graph_val']=$this->progress_model->get_first_axis_vals($this->input->post('graph_id'));
		$this->load->view('edit_graph_popup',$data);
		
	}
	
	public function save_graph_information(){
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
			$graph_type=$this->input->post('graph_type');
			$graph_for=$this->input->post('graph_for');
			$measure_unit=$this->input->post('measure_unit');
			$x_axis_val=$this->input->post('xval');
			$y_axis_val=$this->input->post('yval');
			$axis_values=$this->input->post('axis_values');
			$client_id=$this->input->post('client_id');
			$graph_id=$this->input->post('graph_id');
			$data_graph=array(
				'client_id' => $client_id,
				'graph_type' => $graph_type,
				'graph_for' => $graph_for,
				'measure_unit' => $measure_unit
					  );
			$where_graph=array(
				'id' => $graph_id
					   );
			$update_res=$this->common_model->update('user_graph',$data_graph,$where_graph);
			for($i=0;$i<count($x_axis_val);$i++)
				{
					$data_measure=array(
						'graph_id' => $graph_id,
						'x_axis_val' => date('Y-m-d',strtotime($x_axis_val[$i])),
						'y_axis_val' => $y_axis_val[$i],
							    );
					$where_axis=array(
						'id' => $axis_values[$i]
							  );
					$update_measure_info=$this->common_model->update('user_graph_points',$data_measure,$where_axis);
				}
			$this->session->set_flashdata('flash_message', 'progress_tab');
			redirect('client-profile/'.$client_id);
		}
		else{
		redirect('home');
		}
	}
	
	
	public function remove_measurement(){
		$field_id=$this->input->post('field_id');
		$where=array(
			'id' => $field_id
			     );
		$del_res=$this->common_model->delete('user_graph_points',$where);
		if($del_res)
		{
			echo "deleted";
		}
		else{
			echo "not_deleted";
		}
	}
	
	public function measure_popup(){
		$data['client_id']=$this->input->post('client_id');
		$data['graph_id']=$this->input->post('graph_id');
		$this->load->view('add_measurement_popup',$data);
	}
	
	public function add_measurement(){ ////Function for adding more measurement to an already existing graph
		$x_axis_val=$this->input->post('x_val');
		$y_axis_val=$this->input->post('y_val');
		$client_id=$this->input->post('client_id');
		$graph_id=$this->input->post('graph_id');
		for($i=0;$i<count($x_axis_val);$i++)
		{
			$data_measure=array(
				'graph_id' => $graph_id,
				'x_axis_val' => date('Y-m-d',strtotime($x_axis_val[$i])),
				'y_axis_val' => $y_axis_val[$i],
					    );print_r($data_measure);
			$add_measure_info=$this->common_model->add('user_graph_points',$data_measure);
		}
		$this->session->set_flashdata('flash_message', 'progress_tab');
		redirect('client-profile/'.$client_id);
	}
	public function get_more_measure_div(){
	     $data['count']=$this->input->post('count');
	     $data['date_val']=$this->input->post('date_val');
	     echo $next_date = date('Y-m-d', strtotime($data['date_val'].' +1 day'));
	     echo "^^";
	     $this->load->view('measurement_div',$data);
	}
	public function add_graph_popup()
	{
	        $data['client_id']=$this->input->post('client_id');
		$this->load->view('add_graph_popup',$data);
	}  
}
?>