<?php
class Toolbox extends CI_Controller {

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
	}
	function index()
	{
		$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		// load template
		$data['meals']=$this->toolbox_model->get_meals($this->session->userdata('site_user_id'));
		$data['meal_one_record']=$this->toolbox_model->get_meals_one_record($this->session->userdata('site_user_id'));
		$data['program_list']=$this->toolbox_model->get_programs($this->session->userdata('site_user_id'));
		$this->load->view('toolbox_training',$data);
		// load HTML footer file
		$this->load->view('footer');
		
		// load HTML footer file
		$this->load->view('HTML_footer');
	}
	public function get_more_div()
	{
	    $data['count']=$this->input->post('count');
	    $this->load->view('get_more_div',$data);
	}
	public function add_meal() /////// Function for adding meal and other meal informations
	{
	   if($this->input->server('REQUEST_METHOD') == 'POST')
	    {
	         $meal_title=$this->input->post('meal_title');
		 $meal_desc=$this->input->post('meal_desc');
		 $specifically=$this->input->post('specifically');
		 $meal_amount=$this->input->post('meal_amount');
		 $instruction=$this->input->post('instruction');
		 $meal_attachment=$this->input->post('uploaded_image_name');
		 $meal_arr=explode(",",$meal_attachment);
		 $meal_data=array(
			'trainer_id' => $this->session->userdata('site_user_id'),
			'title' => $meal_title,
			'description' => $meal_desc,
			'instruction' => $instruction
				  );
		 $add_meal_res=$this->common_model->add('meal',$meal_data);
		 if($add_meal_res != 0)
		 {
		      for($i=1;$i<sizeof($meal_arr);$i++)
		       {
			   $data_meal_attachment=array(
				'meal_id' => $add_meal_res,
				'filename' => $meal_arr[$i]
						       );
			   
			  $add_attach_res=$this->common_model->add('meal_images',$data_meal_attachment);
		       }
				for($i=0;$i<sizeof($specifically);$i++)
				{
				  $data_other_option=array(
					  'meal_id' => $add_meal_res,
					  'specifically' => $specifically[$i],
					  'amount' => $meal_amount[$i]
								 );
				  $add_other_res=$this->common_model->add('meal_other_options',$data_other_option);
				}
		     
		 }
	    }
	    $this->session->set_flashdata('flash_message', 'meal_tab');
	    redirect('tools');
	}
	public function image_upload()
	{
		$arr="";
                foreach ($_FILES["file"]["error"] as $key => $error){
			if ($error == UPLOAD_ERR_OK){
			  $time=time();  // time on creation
			  $random_num=rand(00,99);  // random number
			  $name = $time.$random_num.$_FILES["file"]["name"][$key]; // avoid same file name collision
			if(move_uploaded_file( $_FILES["file"]["tmp_name"][$key], getcwd()."/meal_images/" . $name))
			{
			//mysql_query("INSERT INTO images VALUES('','$name','$user_session_id','$time')");
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
	
	public function get_edit_popup()
	{
	        $meal_id=$this->input->post('meal_id');
		$where_meal=array(
		'id' => $meal_id
		     );
	        $data['meal_info']=$this->common_model->get('meal',array('*'),$where_meal);
		$where_meal_other=array(
		'meal_id' => $meal_id
		     );
		$data['meal_others']=$this->common_model->get('meal_other_options',array('*'),$where_meal_other,null,null,null,null,null,null,'id','asc');
		$where_meal_image=array(
		'meal_id' => $meal_id
		     );
		$data['meal_images']=$this->common_model->get('meal_images',array('*'),$where_meal_image);
		$this->load->view('edit_meal',$data);
	}
	
	public function remove_meal_others()
	{
		$field_id=$this->input->post('field_id');
		$where=array(
			'id' => $field_id
			     );
		$del_res=$this->common_model->delete('meal_other_options',$where);
		if($del_res)
		{
			echo "deleted";
		}
		else{
			echo "not_deleted";
		}
	}
	
	public function update_meals()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
			$meal_title=$this->input->post('meal_title_edit');
			$meal_desc=$this->input->post('meal_desc_edit');
			$instruction=$this->input->post('instruction_edit');
			$meal_id=$this->input->post('meal_id');
			$meal_other_id=$this->input->post('meal_other_id');
			$specifically=$this->input->post('specifically_edit');
		        $meal_amount=$this->input->post('meal_amount_edit');
			$meal_attachment=$this->input->post('uploaded_image_name_edit');
		        $meal_arr=explode(",",$meal_attachment);
			$data_meal_updt=array(
				'title' => $meal_title,
				'description' => $meal_desc,
				'instruction' => $instruction
					      );
			$where_meal=array(
				'id' =>  $meal_id
					  );
			$update_res=$this->common_model->update('meal',$data_meal_updt,$where_meal);
			if($update_res)
			{
				if(count($meal_arr) > 1)
				{
					for($i=1;$i<sizeof($meal_arr);$i++)
				       {
					   $data_meal_attachment=array(
						'meal_id' => $meal_id,
						'filename' => $meal_arr[$i]
								       );
					   
					  $add_attach_res=$this->common_model->add('meal_images',$data_meal_attachment);
				       }
				}
				if(count($meal_other_id) > 0)
				{
				   for($i=0;$i<sizeof($meal_other_id);$i++)
					{
						if($meal_other_id[$i]!='')
						{
							$data_other_update=array(
								'meal_id' => $meal_id,
								'specifically' => $specifically[$i],
								'amount' => $meal_amount[$i]
										 );
							$where_other=array(
								'id' => $meal_other_id[$i]
									   );
							$update_other_res=$this->common_model->update('meal_other_options',$data_other_update,$where_other);
						}
						elseif($meal_other_id[$i]=='')
						{
							$data_other_option=array(
								'meal_id' => $meal_id,
								'specifically' => $specifically[$i],
								'amount' => $meal_amount[$i]
										       );
							$add_other_res=$this->common_model->add('meal_other_options',$data_other_option);
						}
					}
				}
			}
			$this->session->set_flashdata('flash_message', 'meal_tab');
			redirect('tools');
		}
		
	}
	public function get_more_div_edit()
	{
	    $data['count']=$this->input->post('count');
	    $this->load->view('get_more_div_edit',$data);
	}
	public function get_meal_list_ajax()
	{
		$search_text=$this->input->post('search_text');
		$where=array(
			'trainer_id' => $this->session->userdata('site_user_id')
			     );
	        if($search_text=='')
		{
		    $data['all_meal']=$this->common_model->get('meal',array('*'),$where);
		}
		else
		{
		    $data['all_meal']=$this->common_model->get('meal',array('*'),$where,$search_text,'title');	
		}
		$this->load->view('get_meal_list_toolbox',$data);
	}
	public function edit_meal_right()
	{
		$meal_title=$this->input->post('meal_title_right');
		$meal_desc=$this->input->post('meal_desc_right');
		$meal_id=$this->input->post('meal_id_right');
		$meal_attachment=$this->input->post('uploaded_image_name_right');
		$meal_arr=explode(",",$meal_attachment);
		$data_meal_updt=array(
				'title' => $meal_title,
				'description' => $meal_desc,
					      );
		$where_meal=array(
				'id' =>  $meal_id
					  );
		$update_res=$this->common_model->update('meal',$data_meal_updt,$where_meal);
		if($update_res)
		{
				if(count($meal_arr) > 1)
				{
					for($i=1;$i<sizeof($meal_arr);$i++)
				       {
					   $data_meal_attachment=array(
						'meal_id' => $meal_id,
						'filename' => $meal_arr[$i]
								       );
					   
					  $add_attach_res=$this->common_model->add('meal_images',$data_meal_attachment);
				       }
				}
		}
		redirect('tools');
		
	}
	public function get_edit_right_section()
	{
		$meal_id=$this->input->post('meal_id');
		$where_meal=array(
			'id' => $meal_id
				  );
		$data['meal_one_record']=$this->common_model->get('meal',array('*'),$where_meal);
		$this->load->view('meal_right_section',$data);
	}
	
	public function remove_image()
	{
		$image_id=$this->input->post('image_id');
                $image_name=$this->input->post('image_name');
		$where=array(
			'id' => $image_id
			     );
		$del_res=$this->common_model->delete('meal_images',$where);
		if($del_res)
		{
			$file=getcwd().'/meal_images/'.$image_name;
	                unlink($file);
			echo "deleted";
		}
		else{
			echo "not_deleted";
		}
	}
	public function remove_uploaded_image() /////Delete Only uploaded but not saved images from edit pop -up
	{
		$image_name=$this->input->post('image_name');
		$string_val=$this->input->post('string_val');
		$new_list=array();
		$file=getcwd().'/meal_images/'.$image_name;
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
	
	
	public function get_exercise_list()
	{
	        $type_id=$this->input->post('type_id');
		$mode = $this->input->post('mode');
		 $search_text = $this->input->post('search_text');
		if($search_text == '')
		{
			$where_meal=array(
			'type_id' => $type_id
			     );
			$data['exer_info']=$this->common_model->get('exercise_list',array('*'),$where_meal);
		}
		else{
			$where_meal=array(
			'type_id' => $type_id
			     );
			$data['exer_info']=$this->common_model->get('exercise_list',array('*'),$where_meal,$search_text,'title');
		}
		
		$data['mode'] = $mode;
	        $data['type_id'] = $type_id;
		
		$this->load->view('get_exercise',$data);
	}
	
	public function get_exercise_list_client()
	{
	        $type_id=$this->input->post('type_id');
		$mode = $this->input->post('mode');
		 $search_text = $this->input->post('search_text');
		if($search_text == '')
		{
			$where_meal=array(
			'type_id' => $type_id
			     );
			$data['exer_info']=$this->common_model->get('exercise_list',array('*'),$where_meal);
		}
		else{
			$where_meal=array(
			'type_id' => $type_id
			     );
			$data['exer_info']=$this->common_model->get('exercise_list',array('*'),$where_meal,$search_text,'title');
		}
		
		$data['mode'] = $mode;
	        $data['type_id'] = $type_id;
		
		$this->load->view('get_exercise_client',$data);
	}
	
	public function customize_exercise_pop()
	{
	        $exer_id=$this->input->post('exer_id');
		
		$where_meal=array(
			'id' => $exer_id
			     );
		$data['exer_info']=$this->common_model->get('exercise_list',array('*'),$where_meal);
		 $client_id = $this->input->post('client_id');
		$data['client_id'] = $client_id;
		$data['date_val']= $this->input->post('date_val');
		$data['user_prgrm_id'] = $this->input->post('user_prgrm_id');
		$data['exer_id'] = $exer_id;
		$where_cleint=array(
			'id' => $client_id
			     );
		$data['user_info']=$this->common_model->get('user',array('*'),$where_cleint);
		
		$this->load->view('customize_exercise_frm',$data);
	}
	public function add_more_sets()
	{
	        $tot_cnt=$this->input->post('tot_cnt');
		
		$data['tot_val'] = $tot_cnt;
		$this->load->view('add_more_sets',$data);
	}
	public function get_program_list()
	{
	     
		$mode = $this->input->post('mode');
		 $search_text = $this->input->post('search_text');
		if($search_text == '')
		{
			
			$data['exer_info']=$this->common_model->get('program_list',array('*'));
		}
		else{
		
			$data['exer_info']=$this->common_model->get('program_list',array('*'),null,$search_text,'name');
		}
		
		$data['mode'] = $mode;
	       
		
		$this->load->view('get_program',$data);
	}
	public function get_programd_drop()
	{
	     
		$date_work = $this->input->post('date_work');
		$client_id = $this->input->post('client_id');
		$date_val = $this->input->post('date_val');
		$exer_id = $this->input->post('exer_id');
		$where_cleint=array(
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($date_work))
			     );
		$data['program_info']=$this->common_model->get('user_program_exercises',array('*'),$where_cleint);
		$data['exer_id'] = $exer_id;
		$data['date_val'] = $date_val;
		$data['client_id'] = $client_id;
		$this->load->view('get_assigned_program',$data);
	}
	public function delete_ex_val()
	{
	     
		
		$exer_id = $this->input->post('exer_id');
		$date_val = $this->input->post('date_val');
		$where_cleint_get=array(
			'id' => $exer_id
			     );
		$get_val = $this->common_model->get('user_program_ex_exercise',array('*'),$where_cleint_get);
		$user_prgram = $get_val[0]['user_program_id'];
		$exercise_id = $get_val[0]['exercise_id'];
		$where_cleint_get_prg=array(
			'id' => $user_prgram
			     );
		$get_val_main = $this->common_model->get('user_program_exercises',array('*'),$where_cleint_get_prg);
		
		$main_prgm_id = $get_val_main[0]['program_id'];
		
		$where_cleint_get_prg_main=array(
			'id' => $main_prgm_id
			     );
		$get_val_main_prg = $this->common_model->get('user_program',array('*'),$where_cleint_get_prg_main);
		
		if($get_val_main_prg[0]['repeat_status'] == 'N')
		{
			$where_cleint=array(
			'id' => $exer_id
			     );
			$del_val = $this->common_model->delete('user_program_ex_exercise',$where_cleint);
			if($del_val)
			{
				$where_cleint=array(
					'user_program_id' => $user_prgram,
					'exercise_id' => $exercise_id
					     );
				//print_r($where_cleint);
				$del_val = $this->common_model->delete('user_custom_exercise',$where_cleint);
				if($del_val)
				{
					echo "yes";
				}
			}
		}
		else{
			$where_program_exr=array(
				'program_id' => $main_prgm_id,
				'workout_date >=' => date("Y-m-d",strtotime($date_val))
				     );
			$get_prog_exr = $this->common_model->get('user_program_exercises',array('*'),$where_program_exr);
			foreach($get_prog_exr as $prgms)
			{
				$where_cleint=array(
				'user_program_id' => $prgms['id'],
				'exercise_id' => $exercise_id
				     );
				$del_val = $this->common_model->delete('user_program_ex_exercise',$where_cleint);
				if($del_val)
				{
					echo "yes";
				}
			}
		}
		
		
		
		
	}
	
	
	public function add_exer_to_program()
	{
	     
		$program_id = $this->input->post('program_id');
		$user_prog_id = $this->input->post('user_prog_id');
		$client_id = $this->input->post('client_id');
		$exer_id = $this->input->post('exer_id_pop');
		$user_prog_exer_id = $this->input->post('user_prog_exer_id');
		$date_val = $this->input->post('date_val');
		
		 $where_meal_main=array(
		'id' => $user_prog_id
		     );
		$program_info_main=$this->common_model->get('user_program',array('*'),$where_meal_main);
		
		
		if($program_info_main[0]['repeat_status'] == 'N')
		{
			$data_meal_updt=array(
			'user_program_id' => $user_prog_exer_id,
			'client_id' => $client_id,
			'program_id' => $program_id,
			'exercise_id' => $exer_id
				      );
		
			$update_res=$this->common_model->add('user_program_ex_exercise',$data_meal_updt);
			$where_cleint=array(
				'id' => $update_res
				     );
			$data['exer_info']=$this->common_model->get('user_program_ex_exercise',array('*'),$where_cleint);
		}
		else{
			$where_program_exr=array(
				'program_id' => $user_prog_id,
				'workout_date >=' => date("Y-m-d",strtotime($date_val))
				     );
			$get_prog_exr = $this->common_model->get('user_program_exercises',array('*'),$where_program_exr);
				
			foreach($get_prog_exr as $prgms)
			{
				$data_meal_updt=array(
				'user_program_id' => $prgms['id'],
				'client_id' => $client_id,
				'program_id' => $program_id,
				'exercise_id' => $exer_id
					      );
			
				$update_res=$this->common_model->add('user_program_ex_exercise',$data_meal_updt);
			}
			$where_program_exr=array(
				'program_id' => $user_prog_id,
				'workout_date' => date("Y-m-d",strtotime($date_val))
				     );
			$get_prog_exr_today = $this->common_model->get('user_program_exercises',array('*'),$where_program_exr);
			
			$where_cleint=array(
				'user_program_id' => $get_prog_exr_today[0]['id'],
				'exercise_id' => $exer_id
				     );
			$data['exer_info']=$this->common_model->get('user_program_ex_exercise',array('*'),$where_cleint);
			
		}
		
		
		
		$this->load->view('get_last_added_exer',$data);
	}
	
	
	public function add_program_list()
	{
	     
		$program_id = $this->input->post('program_id');
		$trainer_id = $this->input->post('trainer_id');
		$client_id = $this->input->post('client_id');
		$date_val = $this->input->post('date_val_training');
		
		$data_meal_updt=array(
			'default_program_id' => $program_id,
			'client_id' => $client_id,
			'trainer_id' => $trainer_id,
			'create_date' => date("Y-m-d",strtotime($date_val))
				      );
		
		$main_program_id=$this->common_model->add('user_program',$data_meal_updt);
		
		$data_meal_updt=array(
			'program_id' => $main_program_id,
			'client_id' => $client_id,
			'trainer_id' => $trainer_id,
			'workout_date' => date("Y-m-d",strtotime($date_val))
				      );
		
		$add_repeat_table=$this->common_model->add('user_program_exercises',$data_meal_updt);
		if($add_repeat_table)
		{
			$where_meal=array(
			'program_id' => $program_id
			     );
			$exercises = $this->common_model->get('default_program_exercises',array('*'),$where_meal);
			foreach($exercises as $exer)
			{
				$data_meal_updt=array(
				'user_program_id' => $add_repeat_table,
				'client_id' => $client_id,
				'program_id' => $main_program_id,
				'exercise_id' => $exer['exercise_id']
					      );
			
				$insert_exer=$this->common_model->add('user_program_ex_exercise',$data_meal_updt);
			}
			
			
			$where_meal=array(
			'id' => $add_repeat_table
			     );
			$data['last_info']=$this->common_model->get('user_program_exercises',array('*'),$where_meal);
		}
		$data['client_id'] = $client_id;
		
		$this->load->view('add_program_list',$data);
	}
	
	public function insert_program()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
			$title=$this->input->post('program_title');
			$user_id = $this->session->userdata('site_user_id');
			 $exercises = $this->input->post('all_program');
			
			$data_meal_updt=array(
				'name' => $title,
				'created_by' => $user_id,
				'created_date' => date("Y-m-d H:i:s")
					      );
			
			$update_res=$this->common_model->add('program_list',$data_meal_updt);
			if($update_res)
			{
				$exercises = $this->input->post('all_program');
				$exp_val = explode(",",$exercises);
				foreach($exp_val as $val)
				{
					$xp_val = explode("##",$val);
					$data_meal_insrt=array(
						'program_id' => $update_res,
						'exercise_id' => $xp_val[0],
						'type_id' => $xp_val[1]
							      );
					
					$update_res_val=$this->common_model->add('default_program_exercises',$data_meal_insrt);
				}
				redirect('tools');
			}
			
		}
	}
	
	public function get_program_info()
	{
	        $program_id=$this->input->post('program_id');
		
		$where_meal=array(
			'id' => $program_id
			     );
		$data['prog_info']=$this->common_model->get('program_list',array('*'),$where_meal);
		$where_meal=array(
		'program_id' => $program_id
		     );
		$data['exer_info']=$this->common_model->get('default_program_exercises',array('*'),$where_meal);
		
		$data['program_id'] = $program_id;
		
		$this->load->view('edit_program',$data);
	}
	
	public function get_exer_info()
	{
	        $exer_id=$this->input->post('exer_id');
		
		$where_meal=array(
			'id' => $exer_id
			     );
		$data['exer_info']=$this->common_model->get('exercise_list',array('*'),$where_meal);
		
		$this->load->view('view_exercise',$data);
	}
	
	public function get_program()
	{
	        $date_val=$this->input->post('date_val');
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		$trainer_id=$this->input->post('trainer_id');
		$client_id=$this->input->post('client_id');
		$new_date = $date_val."-".$month."-".$year;
		$where_meal=array(
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($new_date))
			     );
		$data['program_info']=$this->common_model->get('user_program_exercises',array('*'),$where_meal);
		$data['client_id'] = $client_id;
		$data['day_val'] = $date_val;
		$data['month_val'] = $month;
		$data['year_val'] = $year;
		$this->load->view('get_program_details',$data);
	}
	
	public function get_repeat_popup()
	{
	      
		$trainer_id=$this->input->post('trainer_id');
		$client_id=$this->input->post('client_id');
		$user_prgrm_id = $this->input->post('user_program_id');
		$date_val =  $this->input->post('date_val');
		$data['client_id'] = $client_id;
		$data['user_program_id'] = $user_prgrm_id;
		$data['trainer_id'] = $trainer_id;
		$data['date_val'] = $date_val;
		$this->load->view('get_repeat_program',$data);
	}
	
	public function add_repeat()
	{
	      
		$trainer_id=$this->input->post('trainer_id');
		$client_id=$this->input->post('client_id');
		$user_prgrm_id = $this->input->post('repeat_program_id');
		echo $date_start = $this->input->post('date_start');
		$repeat_status = $this->input->post('repeat_status');
		$end_date_val = $this->input->post('repeat_upto');
		if($repeat_status != 'N')
		{
			$where_meal=array(
			'program_id' => $user_prgrm_id,
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($date_start))
			     );
			$program_info=$this->common_model->get('user_program_exercises',array('*'),$where_meal);
			$user_program_exercises_id = $program_info[0]['id'];
			
			
		}
		if($repeat_status == 'D')
		{
			$date = date("Y-m-d",strtotime($date_start));
			// End date
			$end_date = date("Y-m-d",strtotime($end_date_val));
		
			while (strtotime($date) <= strtotime($end_date)) {
				if(strtotime($date) != strtotime($date_start))
				{
					$data_rep_insrt=array(
						'program_id' => $user_prgrm_id,
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'workout_date' => $date
							      );
					
					$insert_new_val=$this->common_model->add('user_program_exercises',$data_rep_insrt);
					if($insert_new_val)
					{
						$where_meal_exer=array(
						'user_program_id' => $user_program_exercises_id,
						'client_id' => $client_id
						     );
						$exer_info=$this->common_model->get('user_program_ex_exercise',array('*'),$where_meal_exer);
						if(count($exer_info) > 0)
						{
							foreach($exer_info as $exer)
							{
								$program_id = $exer['program_id'];
								$exer_id = $exer['exercise_id'];
								$data_exer_insrt=array(
									'user_program_id' => $insert_new_val,
									'client_id' => $client_id,
									'program_id' => $program_id,
									'exercise_id' => $exer_id
										      );
								
								$insert_new_val_exer=$this->common_model->add('user_program_ex_exercise',$data_exer_insrt);
							}
						}
						$where_meal_exer_cust=array(
						'user_program_id' => $user_program_exercises_id,
						'client_id' => $client_id
						     );
						$exer_info_custom=$this->common_model->get('user_custom_exercise',array('*'),$where_meal_exer_cust);
						if(count($exer_info_custom) > 0)
						{
							foreach($exer_info_custom as $exer_cus)
							{
								$program_id = $exer_cus['program_id'];
								$exer_id = $exer_cus['exercise_id'];
								$set_value = $exer_cus['set_value'];
								$instruction = $exer_cus['instruction'];
								$trainer_id = $exer_cus['trainer_id'];
								$data_exer_insrt_cus=array(
									'client_id' => $client_id,
									'trainer_id' => $trainer_id,
									'program_id' => $program_id,
									'user_program_id' => $insert_new_val,
									'exercise_id' => $exer_id,
									'set_value' => $set_value,
									'instruction' => $instruction,
										      );
								
								$insert_new_val_exer_cus=$this->common_model->add('user_custom_exercise',$data_exer_insrt_cus);
							}
						}
						
					}
				}
				$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
			      
			}
			$data_meal_updt=array(
				'repeat_status' => 'D'
					      );
			$where_meal=array(
			'id' => $user_prgrm_id
			     );
			$update_res=$this->common_model->update('user_program',$data_meal_updt,$where_meal);
		}
		if($repeat_status == 'EXD')
		{
			$repeat_val = $this->input->post('every_x_day');
			$date = date("Y-m-d",strtotime($date_start));
			// End date
			$end_date = date("Y-m-d",strtotime($end_date_val));
		
			while (strtotime($date) <= strtotime($end_date)) {
				if(strtotime($date) != strtotime($date_start))
				{
					$data_rep_insrt=array(
						'program_id' => $user_prgrm_id,
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'workout_date' => $date
							      );
					
					$insert_new_val=$this->common_model->add('user_program_exercises',$data_rep_insrt);
					if($insert_new_val)
					{
						$where_meal_exer=array(
						'user_program_id' => $user_program_exercises_id,
						'client_id' => $client_id
						     );
						$exer_info=$this->common_model->get('user_program_ex_exercise',array('*'),$where_meal_exer);
						if(count($exer_info) > 0)
						{
							foreach($exer_info as $exer)
							{
								$program_id = $exer['program_id'];
								$exer_id = $exer['exercise_id'];
								$data_exer_insrt=array(
									'user_program_id' => $insert_new_val,
									'client_id' => $client_id,
									'program_id' => $program_id,
									'exercise_id' => $exer_id
										      );
								
								$insert_new_val_exer=$this->common_model->add('user_program_ex_exercise',$data_exer_insrt);
							}
						}
						$where_meal_exer_cust=array(
						'user_program_id' => $user_program_exercises_id,
						'client_id' => $client_id
						     );
						$exer_info_custom=$this->common_model->get('user_custom_exercise',array('*'),$where_meal_exer_cust);
						if(count($exer_info_custom) > 0)
						{
							foreach($exer_info_custom as $exer_cus)
							{
								$program_id = $exer_cus['program_id'];
								$exer_id = $exer_cus['exercise_id'];
								$set_value = $exer_cus['set_value'];
								$instruction = $exer_cus['instruction'];
								$trainer_id = $exer_cus['trainer_id'];
								$data_exer_insrt_cus=array(
									'client_id' => $client_id,
									'trainer_id' => $trainer_id,
									'program_id' => $program_id,
									'user_program_id' => $insert_new_val,
									'exercise_id' => $exer_id,
									'set_value' => $set_value,
									'instruction' => $instruction,
										      );
								
								$insert_new_val_exer_cus=$this->common_model->add('user_custom_exercise',$data_exer_insrt_cus);
							}
						}
						
					}
				}
				$repeat_val_day = $repeat_val - 1;
				$date = date ("Y-m-d", strtotime("+".$repeat_val_day." days", strtotime($date)));
			      
			}
			$data_meal_updt=array(
				'repeat_status' => 'EXD',
				'every_x_day' => $repeat_val
					      );
			$where_meal=array(
			'id' => $user_prgrm_id
			     );
			$update_res=$this->common_model->update('user_program',$data_meal_updt,$where_meal);
		}
		if($repeat_status == 'EW')
		{
			
			
			$date = date("Y-m-d",strtotime($date_start));
			// End date
			$end_date = date("Y-m-d",strtotime($end_date_val));
		
			while (strtotime($date) <= strtotime($end_date)) {
				$i = $this->input->post('every_week');
				$ts = strtotime($date);
				// Find the year and the current week
				$year = date('o', $ts);
				$week = date('W', $ts);
				$ts = strtotime($year.'W'.$week.$i);
				$date = date("Y-m-d", $ts);
				
				
				if(strtotime($date) != strtotime($date_start))
				{
					$data_rep_insrt=array(
						'program_id' => $user_prgrm_id,
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'workout_date' => $date
							      );
					
					$insert_new_val=$this->common_model->add('user_program_exercises',$data_rep_insrt);
					if($insert_new_val)
					{
						$where_meal_exer=array(
						'user_program_id' => $user_program_exercises_id,
						'client_id' => $client_id
						     );
						$exer_info=$this->common_model->get('user_program_ex_exercise',array('*'),$where_meal_exer);
						if(count($exer_info) > 0)
						{
							foreach($exer_info as $exer)
							{
								$program_id = $exer['program_id'];
								$exer_id = $exer['exercise_id'];
								$data_exer_insrt=array(
									'user_program_id' => $insert_new_val,
									'client_id' => $client_id,
									'program_id' => $program_id,
									'exercise_id' => $exer_id
										      );
								
								$insert_new_val_exer=$this->common_model->add('user_program_ex_exercise',$data_exer_insrt);
							}
						}
						$where_meal_exer_cust=array(
						'user_program_id' => $user_program_exercises_id,
						'client_id' => $client_id
						     );
						$exer_info_custom=$this->common_model->get('user_custom_exercise',array('*'),$where_meal_exer_cust);
						if(count($exer_info_custom) > 0)
						{
							foreach($exer_info_custom as $exer_cus)
							{
								$program_id = $exer_cus['program_id'];
								$exer_id = $exer_cus['exercise_id'];
								$set_value = $exer_cus['set_value'];
								$instruction = $exer_cus['instruction'];
								$trainer_id = $exer_cus['trainer_id'];
								$data_exer_insrt_cus=array(
									'client_id' => $client_id,
									'trainer_id' => $trainer_id,
									'program_id' => $program_id,
									'user_program_id' => $insert_new_val,
									'exercise_id' => $exer_id,
									'set_value' => $set_value,
									'instruction' => $instruction,
										      );
								
								$insert_new_val_exer_cus=$this->common_model->add('user_custom_exercise',$data_exer_insrt_cus);
							}
						}
						
					}
				}
				
				$date = date ("Y-m-d", strtotime("+1 week", strtotime($date)));
			      
			}
			$data_meal_updt=array(
				'repeat_status' => 'EW',
				'every_week' => $i
					      );
			$where_meal=array(
			'id' => $user_prgrm_id
			     );
			$update_res=$this->common_model->update('user_program',$data_meal_updt,$where_meal);
		}
		if($repeat_status == 'EM')
		{
			
			
			$date = date("Y-m-d",strtotime($date_start));
			// End date
			$end_date = date("Y-m-d",strtotime($end_date_val));
		
			while (strtotime($date) <= strtotime($end_date)) {
				
				
				
				if(strtotime($date) != strtotime($date_start))
				{
					$data_rep_insrt=array(
						'program_id' => $user_prgrm_id,
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'workout_date' => $date
							      );
					
					$insert_new_val=$this->common_model->add('user_program_exercises',$data_rep_insrt);
					if($insert_new_val)
					{
						$where_meal_exer=array(
						'user_program_id' => $user_program_exercises_id,
						'client_id' => $client_id
						     );
						$exer_info=$this->common_model->get('user_program_ex_exercise',array('*'),$where_meal_exer);
						if(count($exer_info) > 0)
						{
							foreach($exer_info as $exer)
							{
								$program_id = $exer['program_id'];
								$exer_id = $exer['exercise_id'];
								$data_exer_insrt=array(
									'user_program_id' => $insert_new_val,
									'client_id' => $client_id,
									'program_id' => $program_id,
									'exercise_id' => $exer_id
										      );
								
								$insert_new_val_exer=$this->common_model->add('user_program_ex_exercise',$data_exer_insrt);
							}
						}
						$where_meal_exer_cust=array(
						'user_program_id' => $user_program_exercises_id,
						'client_id' => $client_id
						     );
						$exer_info_custom=$this->common_model->get('user_custom_exercise',array('*'),$where_meal_exer_cust);
						if(count($exer_info_custom) > 0)
						{
							foreach($exer_info_custom as $exer_cus)
							{
								$program_id = $exer_cus['program_id'];
								$exer_id = $exer_cus['exercise_id'];
								$set_value = $exer_cus['set_value'];
								$instruction = $exer_cus['instruction'];
								$trainer_id = $exer_cus['trainer_id'];
								$data_exer_insrt_cus=array(
									'client_id' => $client_id,
									'trainer_id' => $trainer_id,
									'program_id' => $program_id,
									'user_program_id' => $insert_new_val,
									'exercise_id' => $exer_id,
									'set_value' => $set_value,
									'instruction' => $instruction,
										      );
								
								$insert_new_val_exer_cus=$this->common_model->add('user_custom_exercise',$data_exer_insrt_cus);
							}
						}
						
					}
				}
				
				$date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
			      
			}
			$data_meal_updt=array(
				'repeat_status' => 'EM'
					      );
			$where_meal=array(
			'id' => $user_prgrm_id
			     );
			$update_res=$this->common_model->update('user_program',$data_meal_updt,$where_meal);
		}
		 $this->session->set_flashdata('flash_message', 'training_tab');
		redirect('client-profile/'.$client_id);
		
		//$this->load->view('get_repeat_program',$data);
	}
	
	public function delete_program()
	{
	        $program_id=$this->input->post('progran_edit_id');
		
		$where_meal=array(
			'id' => $program_id
			     );
		$this->common_model->delete('program_list',$where_meal);
		$where_meal=array(
		'program_id' => $program_id
		     );
		$this->common_model->delete('default_program_exercises',$where_meal);
		
		redirect('tools');
	}
	
	public function remove_programs()
	{
		$client_id =$this->input->post('client_id');
	         $program_id=$this->input->post('program_id');
		$date_val = $this->input->post('date_val');
		$where_meal=array(
			'id' => $program_id,
			'workout_date' => date("Y-m-d",strtotime($date_val))
			     );
		$prg_info=$this->common_model->get('user_program_exercises',array('*'),$where_meal);
		
		
		$where_prg_main=array(
			'id' => $prg_info[0]['program_id']
			     );
		$prg_info_main=$this->common_model->get('user_program',array('*'),$where_prg_main);
		
		if($prg_info_main[0]['repeat_status'] == 'N')
		{
			$where_meal=array(
			'program_id' => $prg_info_main[0]['id'],
			'client_id' => $client_id
			     );
			$prg_info=$this->common_model->get('user_program_exercises',array('*'),$where_meal);
			foreach($prg_info as $user_programs)
			{
				$where_meal=array(
				'user_program_id' => $user_programs['id']
				     );
				$this->common_model->delete('user_program_ex_exercise',$where_meal);
				
				$where_meal=array(
				'user_program_id' => $user_programs['id']
				     );
				$this->common_model->delete('user_custom_exercise',$where_meal);
				$where_meal=array(
					'id' => $user_programs['id']
					     );
				$this->common_model->delete('user_program_exercises',$where_meal);
			}
			$where_meal=array(
				'id' => $program_id
				     );
			$this->common_model->delete('user_program',$where_meal);
		}
		else{
			$where_meal=array(
			'program_id' => $prg_info_main[0]['id'],
			'client_id' => $client_id,
			'workout_date >=' => date("Y-m-d",strtotime($date_val))
			     );
			$prg_info=$this->common_model->get('user_program_exercises',array('*'),$where_meal);
			
			foreach($prg_info as $user_programs)
			{
				$where_meal=array(
				'user_program_id' => $user_programs['id']
				     );
				$this->common_model->delete('user_program_ex_exercise',$where_meal);
				
				$where_meal=array(
				'user_program_id' => $user_programs['id']
				     );
				$this->common_model->delete('user_custom_exercise',$where_meal);
				$where_meal=array(
					'id' => $user_programs['id']
					     );
				$this->common_model->delete('user_program_exercises',$where_meal);
			}
		}
		
		//redirect('client-profile/'.$client_id);
	}
	
	public function update_program()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
			$progran_edit_id = $this->input->post('progran_edit_id');
			$title=$this->input->post('program_title');
			$user_id = $this->session->userdata('site_user_id');
			 $exercises = $this->input->post('all_program');
			
			$data_meal_updt=array(
				'name' => $title
					      );
			$where_meal=array(
			'id' => $progran_edit_id
			     );
			$update_res=$this->common_model->update('program_list',$data_meal_updt,$where_meal);
			if($update_res)
			{
				$exercises = $this->input->post('all_program');
				$exp_val = explode(",",$exercises);
				$where_meal_edit=array(
					'program_id' => $progran_edit_id
					     );
				$get_exist = $this->common_model->get('default_program_exercises',array('*'),$where_meal_edit);
				
				$arr_exist = array();
				foreach($get_exist as $val)
				{
					$arr_exist[] = $val['exercise_id']."##".$val['type_id'];
				}
				
				$removed_val = array_diff($arr_exist, $exp_val);
				
				$added_val = array_diff($exp_val, $arr_exist);
				
				foreach($removed_val as $removed)
				{
					$xp_val = explode("##",$removed);
					$data_meal_del=array(
						'program_id' => $progran_edit_id,
						'exercise_id' => $xp_val[0],
						'type_id' => $xp_val[1]
							      );
					
					$del_val=$this->common_model->delete('default_program_exercises',$data_meal_del);
				}
				
				foreach($added_val as $add)
				{
					$xp_val = explode("##",$add);
					$data_meal_add=array(
						'program_id' => $progran_edit_id,
						'exercise_id' => $xp_val[0],
						'type_id' => $xp_val[1]
							      );
					
					$add_val=$this->common_model->add('default_program_exercises',$data_meal_add);
				}
				
				redirect('tools');
			}
			
		}
	}
	
	
	public function customize_exer_client()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
			$client_id = $this->input->post('client_id');
			$user_program_id=$this->input->post('user_program_id');
			$where_program_exr=array(
				'id' => $user_program_id
				     );
			$get_prog_exr = $this->common_model->get('user_program_exercises',array('*'),$where_program_exr);
			$main_program_id = $get_prog_exr[0]['program_id'];
			
			$where_program_exr=array(
				'id' => $main_program_id
				     );
			$get_main_prg = $this->common_model->get('user_program',array('*'),$where_program_exr);
			echo $get_main_prg[0]['repeat_status'];
			
			if($get_main_prg[0]['repeat_status'] == 'N')
			{
				$user_id = $this->session->userdata('site_user_id');
				$exer_id = $this->input->post('exer_id');
				$program_id = $this->input->post('program_id');
			       $sets_rep = $this->input->post('set_reps');
			       
			       $sets_kg = $this->input->post('set_kgs');
			       for($val = 0;$val<count($sets_rep);$val++)
			       {
				       $reps = $sets_rep[$val];
				       $kgs = $sets_kg[$val];
				       if($val == 0)
				       {
					       $tot_set = $reps."#@#@".$kgs;
					       
				       }
				       else
				       {
					       $tot_set .= $reps."#@#@".$kgs;
					       
				       }
				       if($val < (count($sets_rep) -1))
				       {
					       $tot_set .= ",";
				       }
				       
			       }
			       
			       $where_cleint=array(
				       'client_id' => $client_id,
				       'user_program_id' => $user_program_id,
				       'exercise_id' => $exer_id,
					    );
			       $custom_info=$this->common_model->get('user_custom_exercise',array('*'),$where_cleint);
			       
			       if(count($custom_info) > 0)
			       {
				       $data_meal_updt=array(
				       'set_value' => $tot_set,
				       'instruction' => $this->input->post('instruction_edit')
						     );
				       $where_meal=array(
				       'id' => $custom_info[0]['id']
					    );
				       $update_res=$this->common_model->update('user_custom_exercise',$data_meal_updt,$where_meal);
			       }
			       else{
				       $data_meal_add=array(
					       'client_id' => $client_id,
					       'trainer_id' => $user_id,
					       'user_program_id' => $user_program_id,
					       'program_id' => $program_id,
					       'exercise_id' => $exer_id,
					       'set_value' => $tot_set,
					       'instruction' => $this->input->post('instruction_edit')
							     );
				       
				       $add_val=$this->common_model->add('user_custom_exercise',$data_meal_add);
			       }
			}
			else{
				$date_check = $this->input->post('date_to_check');
				$where_program_exr=array(
					'program_id' => $main_program_id,
					'workout_date >=' => date("Y-m-d",strtotime($date_check))
					     );
				$get_prog_exr = $this->common_model->get('user_program_exercises',array('*'),$where_program_exr);
				
				foreach($get_prog_exr as $prgms)
				{
					$user_program_id = $prgms['id'];
					$user_id = $this->session->userdata('site_user_id');
					$exer_id = $this->input->post('exer_id');
					$program_id = $this->input->post('program_id');
				       $sets_rep = $this->input->post('set_reps');
				       
				       $sets_kg = $this->input->post('set_kgs');
				       for($val = 0;$val<count($sets_rep);$val++)
				       {
					       $reps = $sets_rep[$val];
					       $kgs = $sets_kg[$val];
					       if($val == 0)
					       {
						       $tot_set = $reps."#@#@".$kgs;
						       
					       }
					       else
					       {
						       $tot_set .= $reps."#@#@".$kgs;
						       
					       }
					       if($val < (count($sets_rep) -1))
					       {
						       $tot_set .= ",";
					       }
					       
				       }
				       
				       $where_cleint=array(
					       'client_id' => $client_id,
					       'user_program_id' => $user_program_id,
					       'exercise_id' => $exer_id,
						    );
				       $custom_info=$this->common_model->get('user_custom_exercise',array('*'),$where_cleint);
				       
				       if(count($custom_info) > 0)
				       {
					       $data_meal_updt=array(
					       'set_value' => $tot_set,
					       'instruction' => $this->input->post('instruction_edit')
							     );
					       $where_meal=array(
					       'id' => $custom_info[0]['id']
						    );
					       $update_res=$this->common_model->update('user_custom_exercise',$data_meal_updt,$where_meal);
				       }
				       else{
					       $data_meal_add=array(
						       'client_id' => $client_id,
						       'trainer_id' => $user_id,
						       'user_program_id' => $user_program_id,
						       'program_id' => $program_id,
						       'exercise_id' => $exer_id,
						       'set_value' => $tot_set,
						       'instruction' => $this->input->post('instruction_edit')
								     );
					       
					       $add_val=$this->common_model->add('user_custom_exercise',$data_meal_add);
				       }
				}
			}
			
			 $this->session->set_flashdata('flash_message', 'training_tab');
			redirect('client-profile/'.$client_id);
		}
	}
	
	
	public function get_meal_details()
	{
	        $date_val=$this->input->post('date_val');
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		$trainer_id=$this->input->post('trainer_id');
		$client_id=$this->input->post('client_id');
		$new_date = $date_val."-".$month."-".$year;
		$where_meal=array(
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($new_date))
			     );
		$data['meal_info']=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
		$data['client_id'] = $client_id;
		$data['day_val'] = $date_val;
		$data['month_val'] = $month;
		$data['year_val'] = $year;
		$data['date_val'] = $new_date;
		$this->load->view('get_meal_details',$data);
	}
	
	public function add_meal_to_day()
	{
	        $date_val=$this->input->post('date_work');
		
		$trainer_id=$this->input->post('trainer_id');
		$client_id=$this->input->post('client_id');
		$meal_id = $this->input->post('meal_id');
		
		$where_meal=array(
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($date_val))
			     );
		$exist_meal=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
		
		if(count($exist_meal) > 0)
		{
			$where_meal=array(
			'client_id' => $client_id,
			'meal_id' => $meal_id,
			'workout_date' => date("Y-m-d",strtotime($date_val))
			     );
			$exist_meal_id=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
			if(count($exist_meal_id) == 0)
			{
				$main_meal_id = $exist_meal[0]['main_meal_id'];
				$where_meal=array(
				'id' => $main_meal_id
				     );
				$main_meal=$this->common_model->get('user_meal',array('*'),$where_meal);
				if($main_meal[0]['repeat_status'] == 'N')
				{
					$data_meal_add=array(
					'main_meal_id' => $main_meal_id,
					'meal_id' => $meal_id,
					'client_id' => $client_id,
					'trainer_id' => $trainer_id,
					'workout_date' => date("Y-m-d",strtotime($date_val))
					);
				
					$add_val=$this->common_model->add('user_meal_dates',$data_meal_add);
				}
				else{
					$where_program_exr=array(
						'client_id' => $client_id,
						'workout_date >=' => date("Y-m-d",strtotime($date_val))
						     );
					$group_by = 'workout_date';
					$get_prog_exr = $this->common_model->get('user_meal_dates',array('*'),$where_program_exr,null,null,null,null,$group_by);
					
					foreach($get_prog_exr as $prgms)
					{
						$data_meal_updt=array(
						'main_meal_id' => $prgms['main_meal_id'],
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'meal_id' => $meal_id,
						'workout_date' => $prgms['workout_date']
							      );
					
						$update_res=$this->common_model->add('user_meal_dates',$data_meal_updt);
					}
					
					
				}
			}
			
			
		}
		else{
			$data_meal_add=array(
				'client_id' => $client_id,
				'trainer_id' => $trainer_id,
				'created_date' => date("Y-m-d",strtotime($date_val))
				);
			
			$add_val_new=$this->common_model->add('user_meal',$data_meal_add);
			
			$main_meal_id = $add_val_new;
			$where_meal=array(
			'id' => $main_meal_id
			     );
			$main_meal=$this->common_model->get('user_meal',array('*'),$where_meal);
			if($main_meal[0]['repeat_status'] == 'N')
			{
				$data_meal_add=array(
				'main_meal_id' => $main_meal_id,
				'meal_id' => $meal_id,
				'client_id' => $client_id,
				'trainer_id' => $trainer_id,
				'workout_date' => date("Y-m-d",strtotime($date_val))
				);
			
				$add_val=$this->common_model->add('user_meal_dates',$data_meal_add);
			}
			else{
				$where_program_exr=array(
					'client_id' => $client_id,
					'workout_date >=' => date("Y-m-d",strtotime($date_val))
					     );
				$group_by = 'workout_date';
				$get_prog_exr = $this->common_model->get('user_meal_dates',array('*'),$where_program_exr,null,null,null,null,$group_by);
				
				foreach($get_prog_exr as $prgms)
				{
					$data_meal_updt=array(
					'main_meal_id' => $prgms['main_meal_id'],
					'client_id' => $client_id,
					'trainer_id' => $trainer_id,
					'meal_id' => $meal_id,
					'workout_date' => $prgms['workout_date']
						      );
				
					$update_res=$this->common_model->add('user_meal_dates',$data_meal_updt);
				}
				
				
			}
			
			
		}
		$where_meal=array(
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($date_val))
			     );
		$data['meal_info']=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
		
		
		$data['client_id'] = $client_id;
		$data['date_val'] = $date_val;
		$data['trainer_id'] = $trainer_id;
		$this->load->view('get_all_meals',$data);
	}
	
	public function delete_meal_val(){
		$meal_id_dates = $this->input->post('meal_id');
		$date_val = $this->input->post('date_val');
		$where_cleint_get=array(
			'id' => $meal_id_dates
			     );
		$get_val = $this->common_model->get('user_meal_dates',array('*'),$where_cleint_get);
		$main_meal = $get_val[0]['main_meal_id'];
		$meal_id_val = $get_val[0]['meal_id'];
		$where_cleint_get_main_meal=array(
			'id' => $main_meal
			     );
		$get_val_main = $this->common_model->get('user_meal',array('*'),$where_cleint_get_main_meal);
		
		$main_meal_id = $get_val_main[0]['id'];
		
		
		
		if($get_val_main[0]['repeat_status'] == 'N')
		{
			$where_cleint=array(
			'id' => $meal_id_dates
			     );
			$del_val = $this->common_model->delete('user_meal_dates',$where_cleint);
			if($del_val)
			{
				
				$where_cleint=array(
					'meal_dates_id' => $meal_id_dates,
					'meal_id' => $meal_id_val
					     );
				//print_r($where_cleint);
				$del_val = $this->common_model->delete('user_custom_meal',$where_cleint);
				if($del_val)
				{
					echo "yes";
				}
			}
		}
		else{
			$where_program_exr=array(
				'meal_id' => $meal_id_val,
				'workout_date >=' => date("Y-m-d",strtotime($date_val))
				     );
			$get_prog_exr = $this->common_model->get('user_meal_dates',array('*'),$where_program_exr);
			foreach($get_prog_exr as $prgms)
			{
				$where_cleint=array(
				'id' => $prgms['id']
				     );
				$del_val = $this->common_model->delete('user_meal_dates',$where_cleint);
				if($del_val)
				{
					$where_cleint=array(
					'meal_dates_id' => $prgms['id'],
					'meal_id' => $meal_id_val
					     );
					$del_val = $this->common_model->delete('user_custom_meal',$where_cleint);
					if($del_val)
					{
						echo "yes";
					}
				
				}
				
				
			}
			
			
		}
	}
	
	public function get_repeat_popup_meal()
	{
	      
		$trainer_id=$this->input->post('trainer_id');
		$client_id=$this->input->post('client_id');
		$main_meal_id = $this->input->post('main_meal_id');
		$date_val =  $this->input->post('date_val');
		$data['client_id'] = $client_id;
		$data['main_meal_id'] = $main_meal_id;
		$data['trainer_id'] = $trainer_id;
		$data['date_val'] = $date_val;
		$this->load->view('get_repeat_meal',$data);
	}
	
	
	public function add_repeat_meal()
	{
	      
		$trainer_id=$this->input->post('trainer_id');
		$client_id=$this->input->post('client_id');
		$user_prgrm_id = $this->input->post('main_meal_id');
		echo $date_start = $this->input->post('date_start');
		$repeat_status = $this->input->post('repeat_status');
		$end_date_val = $this->input->post('repeat_upto');
		if($repeat_status != 'N')
		{
			$where_meal=array(
			'main_meal_id' => $user_prgrm_id,
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($date_start))
			     );
			$program_info=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
			$meal_id = $program_info[0]['meal_id'];
			$user_program_exercises_id = $program_info[0]['id'];
			
			
		}
		if($repeat_status == 'D')
		{
			$date = date("Y-m-d",strtotime($date_start));
			// End date
			$end_date = date("Y-m-d",strtotime($end_date_val));
		
			while (strtotime($date) <= strtotime($end_date)) {
				if(strtotime($date) != strtotime($date_start))
				{
					$where_meal=array(
					'main_meal_id' => $user_prgrm_id,
					'client_id' => $client_id,
					'workout_date' => date("Y-m-d",strtotime($date_start))
					     );
					$meal_info=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
					foreach($meal_info as $meals)
					{
						$meal_id = $meals['meal_id'];
						$user_prgrm_id = $meals['main_meal_id'];
						$data_rep_insrt=array(
						'main_meal_id' => $user_prgrm_id,
						'meal_id' =>$meal_id, 
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'workout_date' => $date
							      );
					
						$insert_new_val=$this->common_model->add('user_meal_dates',$data_rep_insrt);
						if($insert_new_val)
						{
							
							$where_meal_exer_cust=array(
							'meal_dates_id' => $user_program_exercises_id,
							'client_id' => $client_id
							     );
							$exer_info_custom=$this->common_model->get('user_custom_meal',array('*'),$where_meal_exer_cust);
							if(count($exer_info_custom) > 0)
							{
								foreach($exer_info_custom as $exer_cus)
								{
									$meal_id = $exer_cus['meal_id'];
									$client_id = $exer_cus['client_id'];
									$set_value = $exer_cus['set_value'];
									$instruction = $exer_cus['instruction'];
									$trainer_id = $exer_cus['trainer_id'];
									$data_exer_insrt_cus=array(
										'client_id' => $client_id,
										'trainer_id' => $trainer_id,
										'meal_dates_id' => $insert_new_val,
										'meal_id' => $meal_id,
										'set_value' => $set_value,
										'instruction' => $instruction,
											      );
									
									$insert_new_val_exer_cus=$this->common_model->add('user_custom_meal',$data_exer_insrt_cus);
								}
							}
							
						}
					}
					
				}
				$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
			      
			}
			$data_meal_updt=array(
				'repeat_status' => 'D'
					      );
			$where_meal=array(
			'id' => $user_prgrm_id
			     );
			$update_res=$this->common_model->update('user_meal',$data_meal_updt,$where_meal);
		}
		if($repeat_status == 'EXD')
		{
			$repeat_val = $this->input->post('every_x_day');
			$date = date("Y-m-d",strtotime($date_start));
			// End date
			$end_date = date("Y-m-d",strtotime($end_date_val));
		
			while (strtotime($date) <= strtotime($end_date)) {
				if(strtotime($date) != strtotime($date_start))
				{
					$where_meal=array(
					'main_meal_id' => $user_prgrm_id,
					'client_id' => $client_id,
					'workout_date' => date("Y-m-d",strtotime($date_start))
					     );
					$meal_info=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
					foreach($meal_info as $meals)
					{
						$meal_id = $meals['meal_id'];
						$user_prgrm_id = $meals['main_meal_id'];
						$data_rep_insrt=array(
						'main_meal_id' => $user_prgrm_id,
						'meal_id' =>$meal_id, 
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'workout_date' => $date
							      );
					
						$insert_new_val=$this->common_model->add('user_meal_dates',$data_rep_insrt);
						if($insert_new_val)
						{
							
							$where_meal_exer_cust=array(
							'meal_dates_id' => $user_program_exercises_id,
							'client_id' => $client_id
							     );
							$exer_info_custom=$this->common_model->get('user_custom_meal',array('*'),$where_meal_exer_cust);
							if(count($exer_info_custom) > 0)
							{
								foreach($exer_info_custom as $exer_cus)
								{
									$meal_id = $exer_cus['meal_id'];
									$client_id = $exer_cus['client_id'];
									$set_value = $exer_cus['set_value'];
									$instruction = $exer_cus['instruction'];
									$trainer_id = $exer_cus['trainer_id'];
									$data_exer_insrt_cus=array(
										'client_id' => $client_id,
										'trainer_id' => $trainer_id,
										'meal_dates_id' => $insert_new_val,
										'meal_id' => $meal_id,
										'set_value' => $set_value,
										'instruction' => $instruction,
											      );
									
									$insert_new_val_exer_cus=$this->common_model->add('user_custom_meal',$data_exer_insrt_cus);
								}
							}
							
						}
					}
					
				}
				$repeat_val_day = $repeat_val - 1;
				$date = date ("Y-m-d", strtotime("+".$repeat_val_day." days", strtotime($date)));
			      
			}
			$data_meal_updt=array(
				'repeat_status' => 'EXD',
				'every_x_day' => $repeat_val
					      );
			$where_meal=array(
			'id' => $user_prgrm_id
			     );
			$update_res=$this->common_model->update('user_meal',$data_meal_updt,$where_meal);
		}
		if($repeat_status == 'EW')
		{
			
			
			$date = date("Y-m-d",strtotime($date_start));
			// End date
			$end_date = date("Y-m-d",strtotime($end_date_val));
		
			while (strtotime($date) <= strtotime($end_date)) {
				$i = $this->input->post('every_week');
				$ts = strtotime($date);
				// Find the year and the current week
				$year = date('o', $ts);
				$week = date('W', $ts);
				$ts = strtotime($year.'W'.$week.$i);
				$date = date("Y-m-d", $ts);
				
				
				if(strtotime($date) != strtotime($date_start))
				{
					$where_meal=array(
					'main_meal_id' => $user_prgrm_id,
					'client_id' => $client_id,
					'workout_date' => date("Y-m-d",strtotime($date_start))
					     );
					$meal_info=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
					foreach($meal_info as $meals)
					{
						$meal_id = $meals['meal_id'];
						$user_prgrm_id = $meals['main_meal_id'];
						$data_rep_insrt=array(
						'main_meal_id' => $user_prgrm_id,
						'meal_id' =>$meal_id, 
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'workout_date' => $date
							      );
					
						$insert_new_val=$this->common_model->add('user_meal_dates',$data_rep_insrt);
						if($insert_new_val)
						{
							
							$where_meal_exer_cust=array(
							'meal_dates_id' => $user_program_exercises_id,
							'client_id' => $client_id
							     );
							$exer_info_custom=$this->common_model->get('user_custom_meal',array('*'),$where_meal_exer_cust);
							if(count($exer_info_custom) > 0)
							{
								foreach($exer_info_custom as $exer_cus)
								{
									$meal_id = $exer_cus['meal_id'];
									$client_id = $exer_cus['client_id'];
									$set_value = $exer_cus['set_value'];
									$instruction = $exer_cus['instruction'];
									$trainer_id = $exer_cus['trainer_id'];
									$data_exer_insrt_cus=array(
										'client_id' => $client_id,
										'trainer_id' => $trainer_id,
										'meal_dates_id' => $insert_new_val,
										'meal_id' => $meal_id,
										'set_value' => $set_value,
										'instruction' => $instruction,
											      );
									
									$insert_new_val_exer_cus=$this->common_model->add('user_custom_meal',$data_exer_insrt_cus);
								}
							}
							
						}
					}
					
				}
				
				$date = date ("Y-m-d", strtotime("+1 week", strtotime($date)));
			      
			}
			$data_meal_updt=array(
				'repeat_status' => 'EW',
				'every_week' => $i
					      );
			$where_meal=array(
			'id' => $user_prgrm_id
			     );
			$update_res=$this->common_model->update('user_meal',$data_meal_updt,$where_meal);
		}
		if($repeat_status == 'EM')
		{
			
			
			$date = date("Y-m-d",strtotime($date_start));
			// End date
			$end_date = date("Y-m-d",strtotime($end_date_val));
		
			while (strtotime($date) <= strtotime($end_date)) {
				
				
				
				if(strtotime($date) != strtotime($date_start))
				{
					$where_meal=array(
					'main_meal_id' => $user_prgrm_id,
					'client_id' => $client_id,
					'workout_date' => date("Y-m-d",strtotime($date_start))
					     );
					$meal_info=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
					foreach($meal_info as $meals)
					{
						$meal_id = $meals['meal_id'];
						$user_prgrm_id = $meals['main_meal_id'];
						$data_rep_insrt=array(
						'main_meal_id' => $user_prgrm_id,
						'meal_id' =>$meal_id, 
						'client_id' => $client_id,
						'trainer_id' => $trainer_id,
						'workout_date' => $date
							      );
					
						$insert_new_val=$this->common_model->add('user_meal_dates',$data_rep_insrt);
						if($insert_new_val)
						{
							
							$where_meal_exer_cust=array(
							'meal_dates_id' => $user_program_exercises_id,
							'client_id' => $client_id
							     );
							$exer_info_custom=$this->common_model->get('user_custom_meal',array('*'),$where_meal_exer_cust);
							if(count($exer_info_custom) > 0)
							{
								foreach($exer_info_custom as $exer_cus)
								{
									$meal_id = $exer_cus['meal_id'];
									$client_id = $exer_cus['client_id'];
									$set_value = $exer_cus['set_value'];
									$instruction = $exer_cus['instruction'];
									$trainer_id = $exer_cus['trainer_id'];
									$data_exer_insrt_cus=array(
										'client_id' => $client_id,
										'trainer_id' => $trainer_id,
										'meal_dates_id' => $insert_new_val,
										'meal_id' => $meal_id,
										'set_value' => $set_value,
										'instruction' => $instruction,
											      );
									
									$insert_new_val_exer_cus=$this->common_model->add('user_custom_meal',$data_exer_insrt_cus);
								}
							}
							
						}
					}
				}
				
				$date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
			      
			}
			$data_meal_updt=array(
				'repeat_status' => 'EM'
					      );
			$where_meal=array(
			'id' => $user_prgrm_id
			     );
			$update_res=$this->common_model->update('user_meal',$data_meal_updt,$where_meal);
		}
		 $this->session->set_flashdata('flash_message', 'meal_tab');
		redirect('client-profile/'.$client_id);
		
		//$this->load->view('get_repeat_program',$data);
	}
	
	public function remove_diet_for_day(){
		$main_meal_id = $this->input->post('main_meal_id');
		$date_val = $this->input->post('date_val');
		$client_id = $this->input->post('client_id');
		$trainer_id = $this->input->post('trainer_id');
		
		$where_cleint_get_main_meal=array(
			'id' => $main_meal_id
			     );
		$get_val_main = $this->common_model->get('user_meal',array('*'),$where_cleint_get_main_meal);
		
		
		if($get_val_main[0]['repeat_status'] == 'N')
		{
			$where_cleint=array(
			'id' => $main_meal_id
			     );
			$del_val = $this->common_model->delete('user_meal',$where_cleint);
			if($del_val)
			{
				$where_cleint_get_main_meal=array(
					'main_meal_id' => $main_meal_id,
					'workout_date' => date("Y-m-d",strtotime($date_val)),
					'client_id' => $client_id,
					     );
				$get_val_main = $this->common_model->get('user_meal_dates',array('*'),$where_cleint_get_main_meal);
				foreach($get_val_main as $meal_dates)
				{
					$where_cleint=array(
					'meal_dates_id' => $meal_dates['id']
					     );
					//print_r($where_cleint);
					$del_val = $this->common_model->delete('user_custom_meal',$where_cleint);
					$where_cleint=array(
					'id' => $meal_dates['id']
					     );
					//print_r($where_cleint);
					$del_val = $this->common_model->delete('user_meal_dates',$where_cleint);
					
					if($del_val)
					{
						echo "yes";
					}
				}
				
			}
		}
		else{
			$where_program_exr=array(
				'main_meal_id' => $main_meal_id,
				'workout_date >=' => date("Y-m-d",strtotime($date_val))
				     );
			$get_prog_exr = $this->common_model->get('user_meal_dates',array('*'),$where_program_exr);
			foreach($get_prog_exr as $prgms)
			{
				$where_cleint=array(
				'id' => $prgms['id']
				     );
				$del_val = $this->common_model->delete('user_meal_dates',$where_cleint);
				if($del_val)
				{
					$where_cleint=array(
					'meal_dates_id' => $prgms['id']
					     );
					$del_val = $this->common_model->delete('user_custom_meal',$where_cleint);
					
				
				}
				if($del_val)
				{
					echo "yes";
				}
				
			}
			
			
		}
	}
	public function get_diary_details(){
		$date_val=$this->input->post('date_val');
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		$trainer_id=$this->input->post('trainer_id');
		$client_id=$this->input->post('client_id');
		$new_date = $date_val."-".$month."-".$year;
		$where_meal=array(
			'client_id' => $client_id,
			'date_val' => date("Y-m-d",strtotime($new_date))
			     );
		$data['diary_info']=$this->common_model->get('user_diary',array('*'),$where_meal);
		$data['client_id'] = $client_id;
		$data['day_val'] = $date_val;
		$data['month_val'] = $month;
		$data['year_val'] = $year;
		$data['date_val'] = $new_date;
		$this->load->view('get_diary_details',$data);

	}
	public function get_meal_custom_pop(){
		$date_work = $this->input->post('date_work');
		$meal_org_id=$this->input->post('meal_org_id');
		$meal_dates_id = $this->input->post('meal_dates_id');
		$trainer_id = $this->input->post('trainer_id');
		$client_id = $this->input->post('client_id');
		
		$where_meal=array(
			'meal_dates_id' => $meal_dates_id,
			'meal_id' => $meal_org_id,
			'client_id' => $client_id
			     );
		$custom_meal=$this->common_model->get('user_custom_meal',array('*'),$where_meal);
		
		if(count($custom_meal) == 0)
		{
			$where_meal=array(
			'meal_id' => $meal_org_id
			     );
			$meal_options=$this->common_model->get('meal_other_options',array('*'),$where_meal);
			$data['exists_custom'] = '0';
		}
		else
		{
			$meal_options = array();
			$all_options = array();
			foreach($custom_meal as $custom)
			{
				$custom_set = $custom['set_value'];
				$exp_val_set = explode(",",$custom_set);
				foreach($exp_val_set as $sets)
				{
					$exp_val = explode("#@#@",$sets);
				
					$specificlly = $exp_val[0];
					$amount = $exp_val[1];
					$all_options['specifically'] = $specificlly;
					$all_options['amount'] = $amount;
					$meal_options[] = $all_options;
				}
				
				$data['instruction'] = $custom['instruction'];
			}
			$data['exists_custom'] = '1';
			
		}
		$data['meal_others'] = $meal_options;
		$data['client_id'] = $client_id;
		$data['date_val']= $this->input->post('date_work');
		$data['meal_org_id'] = $meal_org_id;
		$data['meal_dates_id'] = $meal_dates_id;
		$data['trainer_id'] = $trainer_id;
		$where_cleint=array(
			'id' => $client_id
			     );
		$data['user_info']=$this->common_model->get('user',array('*'),$where_cleint);
		
		$where_meal=array(
			'id' => $meal_org_id
			     );
		$data['meal_info']=$this->common_model->get('meal',array('*'),$where_meal);
		
		$where_meal_image=array(
		'meal_id' => $meal_org_id
		     );
		$data['meal_images']=$this->common_model->get('meal_images',array('*'),$where_meal_image);
		$this->load->view('customize_meal_user',$data);

	}
	
	public function update_customize_meal(){
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
			$date_work = $this->input->post('date_val');
			$meal_org_id=$this->input->post('meal_id');
			$meal_dates_id = $this->input->post('meal_dates_id');
			$trainer_id = $this->input->post('trainer_id');
			$client_id = $this->input->post('client_id');
			$exists_custom = $this->input->post('exists_custom');
			$specifically_edit = $this->input->post('specifically_edit');
			$meal_amount_edit = $this->input->post('meal_amount_edit');
			$instruction = $this->input->post('instruction_edit');
			if($exists_custom == 0)
			{
				$all_set = array();
				for($val = 0;$val<count($specifically_edit);$val++)
				{
					$all_set[] = $specifically_edit[$val]."#@#@".$meal_amount_edit[$val];
				}
				$all_set_str = implode(",",$all_set);
				$data_exer_insrt_cus=array(
					'client_id' => $client_id,
					'trainer_id' => $trainer_id,
					'meal_dates_id' => $meal_dates_id,
					'meal_id' => $meal_org_id,
					'set_value' => $all_set_str,
					'instruction' => $instruction,
						      );
				
				$insert_new_val_exer_cus=$this->common_model->add('user_custom_meal',$data_exer_insrt_cus);
			}
			else{
				$all_set = array();
				for($val = 0;$val<count($specifically_edit);$val++)
				{
					$all_set[] = $specifically_edit[$val]."#@#@".$meal_amount_edit[$val];
				}
				$all_set_str = implode(",",$all_set);
				$data_exer_insrt_cus=array(
					'set_value' => $all_set_str,
					'instruction' => $instruction,
						      );
				
				
				$where_meal=array(
				'client_id' => $client_id,
				'trainer_id' => $trainer_id,
				'meal_dates_id' => $meal_dates_id,
				'meal_id' => $meal_org_id,
				     );
			        $update_res=$this->common_model->update('user_custom_meal',$data_exer_insrt_cus,$where_meal);
			}
			 $this->session->set_flashdata('flash_message', 'meal_tab');
			redirect('client-profile/'.$client_id);
		}
	}
	
	public function get_meal_list()
	{
	       
		 $search_text = $this->input->post('search_text');
		if($search_text == '')
		{
			
			$data['all_meal']=$this->common_model->get('meal',array('*'));
		}
		else{
			
			$data['all_meal']=$this->common_model->get('meal',array('*'),null,$search_text,'title');
		}
	
		
		$this->load->view('get_meal_list',$data);
	}
	
	public function get_booking_details(){
		 $date_val=$this->input->post('date_val');
		$month=$this->input->post('month');
		 $year=$this->input->post('year');
		 $trainer_id=$this->input->post('trainer_id');
		$new_date = $date_val."-".$month."-".$year;
		$data_msg = array(
			'trainer_id' => $trainer_id
		       );
		$data['trainer_time']=$this->common_model->get('trainer_avail_time',array('*'),$data_msg);
		
		$data_msg = array(
			'trainer_id' => $trainer_id
		       );
		$data['trainer_settings']=$this->common_model->get('trainer_settings',array('*'),$data_msg);
		
		$data_book = array(
			'trainer_id' => $trainer_id,
			'booked_date' => date("Y-m-d",strtotime($new_date))
		       );
		$data['trainer_booking']=$this->common_model->get('user_booking',array('*'),$data_book);
		$data['trainer_id'] = $trainer_id;
		$data['day_val'] = $date_val;
		$data['month_val'] = $month;
		$data['year_val'] = $year;
		$data['date_val'] = date("Y-m-d",strtotime($new_date));
		$this->load->view('get_trainer_booking',$data);
	}
	public function get_booking_popup(){
		 $trainer_id=$this->input->post('trainer_id');
		 $date_val = $this->input->post('current_date');
		 $hourval =  $this->input->post('hourval');
		 $data['trainer_id'] = $trainer_id;
		 $data['date_val'] = date("Y-m-d",strtotime($date_val));
		 $data['hour_val'] = $hourval;
		 $this->load->view('get_appointment_popup',$data);
	}
	
	public function get_change_pt_value(){
		 $trainer_id=$this->input->post('trainer_id');
		 $date_val = $this->input->post('date_val');
		 $data['trainer_id'] = $trainer_id;
		 $data['date_val'] = date("Y-m-d",strtotime($date_val));
		 
		 $where_meal_avl_rep=array(
		'trainer_id' => $trainer_id,
		'repeat_date' => date("Y-m-d",strtotime($date_val))
		     );
		$user_avl_rep = $this->common_model->get('trainer_avl_time_repeat_val',array('*'),$where_meal_avl_rep);
		if(count($user_avl_rep) > 0)
		{
			$where_meal_avl=array(
		'trainer_id' => $trainer_id
			);
		   $get_time = $this->common_model->get('trainer_avail_time',array('*'),$where_meal_avl);
		   $time_arr = array();
		   if(count($get_time) > 0)
		   {
		       foreach($get_time as $time_avl)
		       {
			    $start_time = date("H",strtotime($time_avl['avl_time_from']));
			   $end_time = date("H",strtotime($time_avl['avl_time_to']));
			
			   for($time=$start_time;$time<$end_time;$time++)
			   {
			       $val_time = $time;
				$start_book = str_pad($time,2,'0',STR_PAD_LEFT).":00";
				$end_time_val = ($val_time + 1);
				$end_book = str_pad($end_time_val,2,'0',STR_PAD_LEFT).":00";
			       $time_arr[]= $start_book."-".$end_book;
			   }
		       }
		   }
		   
			   
		   
		   sort($time_arr);
		   $curr_time = date("Y-m-d H:i");
		   foreach($time_arr as $all_time)
		   {
		       $book_time = explode("-",$all_time);
		       $start_time_each = $book_time[0];
		       $end_time_each = $book_time[1];
		       $date_val_hour = date("Y-m-d H:i",strtotime($date_val." ".$start_time_each));
		       
			if(($date_val_hour > $curr_time))
		       {
			   
			   
			   $where_meal_book=array(
			       'trainer_id' => $this->session->userdata('site_user_id'),
			       'booked_date' => $date_val,
			       'booking_time_start' => $start_time_each,
			       'booking_time_end' => $end_time_each
				    );
			       $get_time = $this->common_model->get('user_booking',array('*'),$where_meal_book);
			       if(count($get_time) == 0)
			       {
				   $show_start = date("h a",strtotime($start_time_each));
				   $show_end = date("h a",strtotime($end_time_each));
				   ?>
				   <a href="javascript:void(0);" onclick="choose_slot(this,'<?php echo $start_time_each; ?>','<?php echo $end_time_each; ?>')"><?php echo $show_start; ?>-<?php echo $show_end; ?></a>
				   <?php
			       }
		       }
		       else{
			    
		       }
		      
		   }
		}
		else
		{
			echo "Not Available For This Day";
		}
		
		
		
	}
	
	public function do_booking(){
		if(($this->input->server('REQUEST_METHOD') == 'POST') && ($this->input->post('mode') == 'book_appointment'))
		{
			$date_val = $this->input->post('date_val');
			$slot_another = $this->input->post('slot_another');
			$book_time = explode("-",$slot_another);
			$start_time_each = $book_time[0];
			$end_time_each = $book_time[1];
			if($this->input->post('trainer_diff') == '')
			{
				$trainer = $this->input->post('current_trainer');
			}
			else
			{
				$trainer = $this->input->post('trainer_diff');
			}
			$client_name = $this->input->post('client_name');
			
			$where_meal_book=array(
			'client_id' => $client_name,
			'workout_date' => date("Y-m-d",strtotime($date_val))
			     );
			$get_progrm = $this->common_model->get('user_program_exercises',array('*'),$where_meal_book);
			$str_prg = '';
			$str_prg_name = '';
			if(count($get_progrm) > 0)
			{
				
			
			foreach($get_progrm as $program)
			{
				$main_prog_id = $program['program_id'];
				$where_main_prg=array(
				'id' => $main_prog_id
				     );
				$get_progrm_main = $this->common_model->get('user_program',array('*'),$where_main_prg);
				$default_id = $get_progrm_main[0]['default_program_id'];
				$where_main_prg_name=array(
				'id' => $default_id
				     );
				$get_progrm_main_name = $this->common_model->get('program_list',array('*'),$where_main_prg_name);
				$program_name[] = $get_progrm_main_name[0]['name'];
				$program_id[] = $get_progrm_main_name[0]['id'];
			}
			if(count($program_name) > 0)
			{
				$str_prg = implode(",",$program_id);
				$str_prg_name = implode(",",$program_name);
			}
			}
			$data_exer_insrt_cus=array(
					'client_id' => $client_name,
					'trainer_id' => $trainer,
					'booked_by' => $this->session->userdata('site_user_id'),
					'booked_date' => date("Y-m-d",strtotime($date_val)),
					'booking_time_start' => date("H:i",strtotime($start_time_each)),
					'booking_time_end' => date("H:i",strtotime($end_time_each)),
					'booking_date' => date("Y-m-d"),
					'program_id' => $str_prg
						      );
				
			$insert_new_val_exer_cus=$this->common_model->add('user_booking',$data_exer_insrt_cus);
			if($insert_new_val_exer_cus)
			{
				$data_to_store = array(
					'id' => 4
				    );
				$site_details = $this->sitesetting_model->get_settings();
				$get_email_template = $this->common_model->get('email_template',array('*'),$data_to_store);
				$system_mail = $site_details[0]['system_email'];
				$where_client=array(
				'id' => $client_name
				     );
				$get_progrm_client = $this->common_model->get('user',array('*'),$where_client);
				$mail =$get_progrm_client[0]['email'];
				$name_client = $get_progrm_client[0]['name'];
				$where_trainer=array(
				'id' => $trainer
				     );
				$get_progrm_trainer = $this->common_model->get('user',array('*'),$where_trainer);
				if($get_progrm_trainer[0]['name'] != '')
				$trainer_name = $get_progrm_trainer[0]['name'];
				else
				$trainer_name = $get_progrm_trainer[0]['email'];
				
				$trainer_email = $get_progrm_trainer[0]['email'];
				
				$date = date("jS, F Y",strtotime($date_val));
				$time_start = date("h:i a",strtotime($start_time_each));
				$time_end = date("h:i a",strtotime($end_time_each));
				
				
				
				$email_content= $this->common_model->get('email_template',array('*'),$data_to_store);
				$email_body = $email_content[0]['email_body'];
				$search_val= array("[TRAINER]","[DATE]","[TIME]","[PROGRAM]");
				$replace_val   = array($trainer_name,$date,$time_start."-".$time_end,$str_prg_name);
				$newbody = str_replace($search_val, $replace_val, $email_body);
				$message=$newbody;
				
				$this->load->library('email');
				     
				  $config['protocol'] = 'sendmail';
				  $config['charset'] = 'utf-8';
				  $config['wordwrap'] = TRUE;
				  $config['mailtype'] = 'html';
				  
				  $this->email->initialize($config);
				     
				  $this->email->from($system_mail,$site_details[0]['site_name']);
				  $this->email->to($mail);
				  
				  $this->email->subject($email_content[0]['subject']);
				  $this->email->message($message);	
				  
				  $this->email->send();
				  
				  
				  $data_to_store_new = array(
					'id' => 5
				    );
				$email_content= $this->common_model->get('email_template',array('*'),$data_to_store_new);
				$email_body = $email_content[0]['email_body'];
				$search_val= array("[CLIENT]","[DATE]","[TIME]","[PROGRAM]");
				$replace_val   = array($name_client,$date,$time_start."-".$time_end,$str_prg_name);
				$newbody = str_replace($search_val, $replace_val, $email_body);
				$message=$newbody;
				$this->load->library('email');
				     
				  $config['protocol'] = 'sendmail';
				  $config['charset'] = 'utf-8';
				  $config['wordwrap'] = TRUE;
				  $config['mailtype'] = 'html';
				  
				  $this->email->initialize($config);
				     
				  $this->email->from($system_mail,$site_details[0]['site_name']);
				  $this->email->to($trainer_email);
				  
				  $this->email->subject($email_content[0]['subject']);
				  $this->email->message($message);	
				  
				  $this->email->send();
				  
				  //$notification="Appoinment with ".$get_progrm_client[0]['name']." on ".date("jS, F Y",strtotime($date_val))." from ".$start_time_each." to ".$end_time_each." has been booked";
				  $notification="Booked 1 Appoinment";
				  $data_notification=array(
					'user_id' =>$trainer,
					'client_id' => $client_name,
					'notification' =>$notification,
					'notification_time' => date('Y-m-d H:i:s')
							   );
				  $add_notification=$this->common_model->add('notifications',$data_notification);
				
				
				$this->session->set_flashdata("flash_message",'app_booked');
				redirect("dashboard");
			}
		}
	}
	
	public function get_monthly(){
		$this->load->view('monthly_range');
	}
	public function get_yearly(){
		$this->load->view('yearly_range');
	}
	public function get_weekly(){
		$this->load->view('weekly_range');
	}
	
}
?>