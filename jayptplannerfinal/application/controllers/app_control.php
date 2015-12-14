<?php
class App_control extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// load models
		$this->load->model('sitesetting_model');
		$this->load->model('contactsetting_model');
		$this->load->model('common_model');
		$this->load->model('network_model');
		$this->load->model('trainer_model');
		$this->load->model('toolbox_model');
		$this->load->model('app_model');
		$this->load->model('progress_model');
	}
        public function get_total_unread_message()  /////Json for getting counter of total unread messages
        {
            if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
                   $sent_to=$this->input->get('logged_in_user');
                   $data_msg = array(
			'sent_to' => $sent_to,
			'read_status' => 'N'
			  );
                   $msg=$this->common_model->get('messages',array('*'),$data_msg);
                   $data['unread_message'] =  count($msg);
                   echo $jsonhtml=json_encode($data);
                }
		
        }
        
        /// json for fetching unread messages for a user when his respective chatbox is open and message status getting changed as read after that
        
        public function get_instant_message() 
        {
             if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
                     $sent_to=$this->input->get('logged_in_user');
                     $sent_by=$this->input->get('chat_user_id');
                     $data=array();
                      $data_msg = array(
			'sent_to' => $sent_to,
                        'sent_by' => $sent_by,
			'read_status' => 'N'
			  );
                       $unread_msg=$this->common_model->get('messages',array('*'),$data_msg);
                       foreach($unread_msg as $msg)
                       {
                                $where_sender=array(
				'id' => $msg['sent_by']
					  );
			        $sender_info= $this->common_model->get('user',array('*'),$where_sender);///Fetching sender information
				$where_receiver=array(
				'id' => $msg['sent_to']
					  );
			        $receiver_info= $this->common_model->get('user',array('*'),$where_receiver);///fetching receiver information
				$msg['id']=$msg['id'];
				$msg['message']=$msg['message'];
				$msg['sender']=$sender_info[0]['name'];
				$msg['receiver']=$receiver_info[0]['name'];
				$msg['sender_image'] =  base_url().'user_images/'.$sender_info[0]['image'];
			        $msg['receiver_image'] = base_url().'user_images/'.$receiver_info[0]['image'];
				$msg['send_time']=$msg['send_time'];
				$msg['status']=$msg['read_status'];
				$data['unread_message'][]=$msg;
                       }
                       $data_to_updt=array(
                          'read_status' =>'Y'
                                           );
                       $status=$this->network_model->update_message_read_status_app($sent_by,$sent_to,$data_to_updt);
                       echo $jsonhtml=json_encode($data); 
                }
        }
        public function user_details(){ ////Json fro fetching trainer details
            
             if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
                     $user_id=$this->input->get('pt_id');
                     $data=array();
                     $where=array(
			'id' => $user_id
			     );
                     $user_details= $this->common_model->get('user',array('*'),$where);
                     if(count($user_details) > 0)
                     {
                        if($user_details[0]['type']=='T')
                        {
                              //$where_trainer=array(
                              //   'id' => $user_details[0]['created_by']
                              //        );
                              //$trainer_details= $this->common_model->get('user',array('*'),$where_trainer);
                              $data['id']=$user_details[0]['id'];
                              $data['user_type']=$user_details[0]['type'];
                              //$data['created_by_id']=$user_details[0]['created_by'];
                              //$data['created_by_name']=$trainer_details[0]['name'];
                              $data['name']=$user_details[0]['name'];
                              //$data['image']=$user_details[0]['image'];
                              $data['image']=base_url().'user_images/'.$user_details[0]['image'];
                              $data['email']=$user_details[0]['email'];
                              $data['address']=$user_details[0]['address'];
                              $data['company']=$user_details[0]['company'];
                              $data['work_address']=$user_details[0]['work_address'];
                              $data['billing_address']=$user_details[0]['billing_address'];
                              $data['phone']=$user_details[0]['phone'];
                              $data['about']=$user_details[0]['about'];
                              //$data['deleted_status']=$user_details[0]['about'];
                        }
                     }
                      echo $jsonhtml=json_encode($data);
                }
        }
        
        public function get_pt_list(){  ///Json for getting list of trainers
            
             if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
                     $user_id=$this->input->get('logged_in_user');
                     $where_user=array(
			'id' => $user_id
			     );
                     $user_details= $this->common_model->get('user',array('*'),$where_user);
                     $trainer_array=array();
                     array_push($trainer_array,$user_details[0]['created_by']);
                     $where_network=array(
			'user_id' => $user_id
			     );
                     $network= $this->common_model->get('network_member',array('*'),$where_network);
                     foreach($network as $nt)
                     {
                        $member=$this->network_model->get_network_members($nt['network_id'],$user_id);
                        foreach($member as $mem)
                        {
                            if($mem['user_id'] != 0)
                            {
                                $where_trainer=array(
                                 'id' => $member['user_id']
                                      );
                                $trainer_details= $this->common_model->get('user',array('*'),$where_trainer);
                                if($trainer_details[0]['type']=='T'){
                                    if(!in_array($trainer_details[0]['id'], $trainer_array))
                                    {
                                        array_push($trainer_array,$trainer_details[0]['id']);
                                    }
                                }
                            }
                        }
                     }
                     print_r($trainer_array);
                     //$pt_list= $this->common_model->get('user',array('*'),$where);
                     foreach($pt_list as $pt)
                     {
                        $info['id']=$pt['id'];
                        $info['name']=$pt['name'];
                        $info['image']=base_url().'user_images/'.$pt['image'];
                        $info['email']=$pt['email'];
                        $info['company']=$pt['company'];
                        $info['address']=$pt['address'];
                        $info['work_address']=$pt['work_address'];
                        $info['billing_address']=$pt['billing_address'];
                        $info['phone']=$pt['phone'];
                        $info['about']=$pt['about'];
                        $data['pt_info'][]=$info;
                     }
                   
                    echo $jsonhtml=json_encode($data);
                }
        }
	
	public function get_date_respective_diary()/////Json for getting date respective diary details of a logged in client
	{
		 if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$client_id=$this->input->get('logged_in_user');
			$date_val=date('Y-m-d',strtotime($this->input->get('date_val')));
			$data=array();
			$where_user=array(
			'id' => $client_id
			     );
			$client_info=$this->common_model->get('user',array('*'),$where_user);
			$diary_details=$this->app_model->get_date_respective_client_diary_details($client_id,$date_val);
			if(count($diary_details) > 0){
				if($client_info[0]['deleted_status']!='Y')
				{
					$data['client_id']=$client_info[0]['id'];
					$data['client_name']=$client_info[0]['name'];
					$data['client_image']=base_url().'user_images/'.$client_info[0]['image'];
					$data['client_email']=$client_info[0]['email'];
					$data['client_about']=$client_info[0]['about'];
					$data['diary_id']=$diary_details[0]['id'];
					$data['diary_heading']=$diary_details[0]['diary_heading'];
					$data['dairy_text']=htmlspecialchars($diary_details[0]['dairy_text']);
					
					
				}
			}
			else
			{
				$data['client_id']=$client_info[0]['id'];
				$data['client_name']=$client_info[0]['name'];
				$data['client_image']=base_url().'user_images/'.$client_info[0]['image'];
				$data['client_email']=$client_info[0]['email'];
				$data['client_about']=$client_info[0]['about'];
				$data['diary_id']='';
				$data['diary_heading']='';
				$data['dairy_text']='';
					
			}
			 echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function add_date_respective_diary(){ //Json for adding date respective diary details
		
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$client_id=$this->input->get('logged_in_user');
			$date_val=date('Y-m-d',strtotime($this->input->get('date_val')));
			$diary_heading=$this->input->get('diary_heading');
			$diary_text=$this->input->get('diary_text');
			$data=array();
			$diary_details=$this->app_model->get_date_respective_client_diary_details($client_id,$date_val);
			if(count($diary_details) == 0){
				$data_to_add=array(
					'client_id' => $client_id,
					'date_val' => $date_val,
					'diary_heading' => $diary_heading,
					'dairy_text' => $diary_text
						   );
				$add_diary=$this->common_model->add('user_diary',$data_to_add);
				if($add_diary !=0)
				{
					$diary_where=array(
						'id' => $add_diary
							 );
					$diary_info = $this->common_model->get('user_diary',array('*'),$diary_where);
					$data['diary_id']=$diary_info[0]['id'];
					$data['diary_date']=$diary_info[0]['date_val'];
					$data['diary_heading']=$diary_info[0]['diary_heading'];
					$data['diary_text']=$diary_info[0]['dairy_text'];
				}
			}
			 echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function fetch_particular_diary_record(){ ////Json for getting info about a particular diary record
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$diary_id=$this->input->get('diary_id');
			$data=array();
			$where_diary=array(
			'id' => $diary_id
			     );
			$diary_info=$this->common_model->get('user_diary',array('*'),$where_diary);
			if(count($diary_info) > 0){
				$data['diary_id']=$diary_info[0]['id'];
                                $data['diary_date']=$diary_info[0]['date_val'];
				$data['diary_heading']=$diary_info[0]['diary_heading'];
				$data['dairy_text']=$diary_info[0]['dairy_text'];
			}
			 echo $jsonhtml=json_encode($data);
		  }
		
	}
	
	public function update_a_diary(){   ////Json for updating a particular diary details
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$diary_id=$this->input->get('diary_id');
			$new_heading=$this->input->get('diary_heading');
			$new_diary_text=$this->input->get('diary_text');
			$data_to_update=array(
				'diary_heading' => $new_heading,
				'dairy_text' => $new_diary_text	
			);
			$where_diary=array(
				'id' => $diary_id
					   );
			$update_diary=$this->common_model->update('user_diary',$data_to_update,$where_diary);
			if($update_diary)
			{
				$diary_where=array(
					'id' => $diary_id
						 );
				$diary_info = $this->common_model->get('user_diary',array('*'),$diary_where);
				$data['diary_id']=$diary_info[0]['id'];
				$data['diary_date']=$diary_info[0]['date_val'];
				$data['diary_heading']=$diary_info[0]['diary_heading'];
				$data['diary_text']=$diary_info[0]['dairy_text'];
			}
			 echo $jsonhtml=json_encode($data);
		  }
		
	}
	public function date_respective_client_meal(){ ////Json for getting date respective meal list and meal details of a client
		
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$client_id=$this->input->get('logged_in_user');
			$date_val=date('Y-m-d',strtotime($this->input->get('date_val')));
                        $meal_details=$this->app_model->get_date_respective_meal_details($client_id,$date_val);
			$data=array();
			foreach($meal_details as $meal){
				
				$where_meal=array(
				'id' => $meal['meal_id']
					   );
				$meal_info=$this->common_model->get('meal',array('*'),$where_meal);
				$meal_image=$this->toolbox_model->get_meal_images($meal_info[0]['id']);
				$meal_arr['meal_id']=$meal_info[0]['id'];
				$meal_arr['custom_meal_id']=$meal['id'];
				$meal_arr['meal_title']=$meal_info[0]['title'];
				$meal_arr['meal_description']=$meal_info[0]['description'];
				if(count($meal_image) > 0){
				        $meal_arr['meal_image']=base_url().'meal_images/'.$meal_image[0]['filename'];
				}
				else{
					$meal_arr['meal_image']=base_url().'assets/site/after_login/images/no-image.gif';
				}
				
				$data['meal'][]=$meal_arr;
			}
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function get_custom_meal_details(){
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$meal_date_id=$this->input->get('custom_meal_id');
			$client_id=$this->input->get('client_id');
			$meal_id=$this->input->get('meal_id');
			$data=array();
			$where_meal=array(
			'meal_dates_id' => $meal_date_id,
			'client_id' => $client_id
				   );
			$custom_meal_info=$this->common_model->get('user_custom_meal',array('*'),$where_meal);
			$where=array(
				'id' => $meal_id
				);
			$meal_info=$this->common_model->get('meal',array('*'),$where);
			$meal_image=$this->toolbox_model->get_meal_images($meal_id);
			if(count($custom_meal_info) > 0){
				$set_val=explode(',',$custom_meal_info[0]['set_value']);
				foreach($set_val as $set){
				  $option_arry=explode('#@#@',$set);
				  $specifically=$option_arry[0];
				  $amount=$option_arry[1];
				  $all_option['specifically']=$specifically;
				  $all_option['amount']=$amount;
				  $meal_set_option[]=$all_option;
				}
			}
			else
			{
				$where=array(
					'meal_id' => $meal_id
					);
				$custom_set=$this->common_model->get('meal_other_options',array('*'),$where);
				foreach($custom_set as $set)
				{
					$all_option['specifically']=$set['specifically'];
					$all_option['amount']=$set['amount'];
					$meal_set_option[]=$all_option;
				}
			}
				$data['meal_title']=$meal_info[0]['title'];
				$data['meal_image']=base_url().'meal_images/'.$meal_info[0]['description'];
				if(count($meal_image) > 0){
					$data['meal_image']=base_url().'meal_images/'.$meal_image[0]['filename'];
					}
				else{
					$data['meal_image']=base_url().'assets/site/after_login/images/no-image.gif';
				}
				$data['meal_description']=$meal_info[0]['description'];
				$data['set']=$meal_set_option;
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	
	public function get_all_events_for_date(){
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			
			$client_id=$this->input->get('client_id');
			$date_val=$this->input->get('date_val');
			$data=array();
			$where_meal=array(
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($date_val))
				   );
			$total_meal=$this->common_model->get('user_meal_dates',array('*'),$where_meal);
			$data['total_meal'] = count($total_meal);
			$data['total_appointment'] = 0;
			$where_meal=array(
			'client_id' => $client_id,
			'date_val' => date("Y-m-d",strtotime($date_val))
				   );
			$total_diary=$this->common_model->get('user_diary',array('*'),$where_meal);
			if(isset($total_diary[0]['dairy_text']))
			{
				$data['diary_text'] = $total_diary[0]['dairy_text'];
			}
			else{
				$data['diary_text'] = '';
			}
			
			
			$where_meal=array(
			'client_id' => $client_id,
			'workout_date' => date("Y-m-d",strtotime($date_val))
				   );
			$total_programs=$this->common_model->get('user_program_exercises',array('*'),$where_meal);
			$finished = 0;
			$finished_exer = 0;
			$tot_exer = 0;
			$all_exer = array();
			foreach($total_programs as $programs)
			{
				
				$where_meal_ex=array(
				'user_program_id' => $programs['id'],
				'client_id' => $client_id
					   );
				$total_exercise=$this->common_model->get('user_program_ex_exercise',array('*'),$where_meal_ex);
				$tot_exer += count($total_exercise);
				
				foreach($total_exercise as $exer)
				{
					$exer_detail = array();
					$exer_detail['user_program_id'] = $programs['id'];
					$where_meal_ex_each=array(
					'user_program_id' => $programs['id'],
					'client_id' => $client_id,
					'exercise_id' => $exer['exercise_id']
						   );
					$exer_custom=$this->common_model->get('user_custom_exercise',array('*'),$where_meal_ex_each);
					
					$where_fet_exer_det=array(
					'id' => $exer['exercise_id']
						   );
					$exer_details=$this->common_model->get('exercise_list',array('*'),$where_fet_exer_det);
					$exer_detail['exercise_id'] = $exer['exercise_id'];
					$exer_detail['exercise_title'] = $exer_details[0]['title'];
					if(count($exer_custom) > 0)
					{
						$set_val = $exer_custom[0]['set_value'];
						$exp_val = explode(",",$set_val);
						$each_set = array();
						$set = array();
						foreach($exp_val as $each_val)
						{
							$val_Set = explode("#@#@",$each_val);
							$reps =  $val_Set[0];
							$kg = $val_Set[1];
							$each_set['reps'] = $reps;
							$each_set['kg'] = $kg;
							$set[] = $each_set;
						}
						$exer_detail['exercise_sets'] = $set;
						$exer_detail['instruction'] = $exer_custom[0]['instruction'];
					}
					else{
						$each_set = array();
						$set = array();
						$each_set['reps'] = 0;
						$each_set['kg'] = 0;
						$set[] = $each_set;
						$exer_detail['exercise_sets'] = $set;
						$exer_detail['instruction'] = '';
					}
					
					if($exer['status'] == 'F')
					{
						$finished_exer++;
					}
					$all_exer[] = $exer_detail;
					
				}
				
				if($programs['status'] == 'F')
				{
					$finished++;
				}
			}
			$where_app=array(
				'client_id' => $client_id,
				'booked_date' => $date_val
					  );
			$appointment=$this->common_model->get('user_booking',array('*'),$where_app);
			$data['total_training_exercises'] = $tot_exer;
			$data['total_training_exercise_finished'] = $finished_exer;
			$data['total_training_programs'] = count($total_programs);
			$data['total_training_programs_finished'] = $finished;
			$data['total_appointment'] = count($appointment);
			$data['all_exercises'] = $all_exer;
			//echo "<pre>";
			//print_r($data);
			//echo "</pre>";
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function get_particular_exercise_details(){
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$user_program_id = $this->input->get('user_program_id');
			$client_id = $this->input->get('client_id');
			$exercise_id = $this->input->get('exercise_id');
			$where_meal_ex_each=array(
			'user_program_id' => $user_program_id,
			'client_id' => $client_id,
			'exercise_id' => $exercise_id
				   );
			$exer_custom=$this->common_model->get('user_custom_exercise',array('*'),$where_meal_ex_each);
			$exer_detail = array();		
			$where_fet_exer_det=array(
			'id' => $exercise_id
				   );
			$exer_details=$this->common_model->get('exercise_list',array('*'),$where_fet_exer_det);
			$data['exercise_id'] = $exercise_id;
			$data['exercise_title'] = $exer_details[0]['title'];
			$data['exercise_description'] = $exer_details[0]['description'];
			$media_image = 'https://exorlive.com/media_'.$exer_details[0]['image_id'].'@600.300.media';
			$media_video = 'https://exorlive.com/video/?ex='.$exer_details[0]['exercise_id'];
			$data['exercise_image'] = $media_image;
			$data['exercise_video'] = $media_video;
			if(count($exer_custom) > 0)
			{
				$set_val = $exer_custom[0]['set_value'];
				$exp_val = explode(",",$set_val);
				$each_set = array();
				$set = array();
				foreach($exp_val as $each_val)
				{
					$val_Set = explode("#@#@",$each_val);
					$reps =  $val_Set[0];
					$kg = $val_Set[1];
					$each_set['reps'] = $reps;
					$each_set['kg'] = $kg;
					$set[] = $each_set;
				}
				$data['exercise_sets'] = $set;
				$data['instruction'] = $exer_custom[0]['instruction'];
			}
			else{
				$each_set = array();
				$set = array();
				$each_set['reps'] = 0;
				$each_set['kg'] = 0;
				$set[] = $each_set;
				$data['exercise_sets'] = $set;
				$data['instruction'] = '';
			}
			$where_meal_ex=array(
				'user_program_id' => $user_program_id,
				'client_id' => $client_id,
				'exercise_id' => $exercise_id
					   );
			$exer=$this->common_model->get('user_program_ex_exercise',array('*'),$where_meal_ex);
			if($exer[0]['status'] == 'F')
			{
				$data['finished'] = 'TRUE';
			}
			else{
				$data['finished'] = 'FALSE';
			}
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function update_finish_status(){
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$user_program_id = $this->input->get('user_program_id');
			$client_id = $this->input->get('client_id');
			$exercise_id = $this->input->get('exercise_id');
			
			
			$where_meal_ex=array(
				'user_program_id' => $user_program_id,
				'client_id' => $client_id,
				'exercise_id' => $exercise_id
					   );
			$data_to_update=array(
				'status' => 'F'
			);
			$exer=$this->common_model->update('user_program_ex_exercise',$data_to_update,$where_meal_ex);
			
			$where_meal_ex_each=array(
			'user_program_id' => $user_program_id,
			'client_id' => $client_id,
			'status' => 'UF'
				);
			
			$check_rem=$this->common_model->get('user_program_ex_exercise',array('*'),$where_meal_ex_each);
			
			if(count($check_rem) == 0)
			{
				$where_meal_ex_val=array(
				'id' => $user_program_id,
				'client_id' => $client_id
					   );
				$data_to_update=array(
					'status' => 'F'
				);
				$exer_main=$this->common_model->update('user_program_exercises',$data_to_update,$where_meal_ex_val);
			}
			
			if($exer)
			{
				$data['finished'] = 'TRUE';
			}
			else{
				$data['finished'] = 'FALSE';
			}
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function mark_calender(){
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$client_id=$this->input->get('client_id');
			$data=array();
			$prog_res=$this->app_model->get_marked_calender_exercise($client_id);
			$meal_res=$this->app_model->get_marked_meal_dates($client_id);
			$diary_res=$this->app_model->get_marked_diary($client_id);
			$appointment_res=$this->app_model->get_marked_appoinment($client_id);
			foreach($prog_res as $prog)
			{
			   $data['program_date'][]=$prog['workout_date'];
			}
			foreach($meal_res as $meal){
				
			   $data['meal_date'][]=$meal['workout_date'];
			}
			foreach($diary_res as $diary){
				
			   $data['diary_date'][]=$diary['date_val'];
			}
			foreach($appointment_res as $appointment){
				
			 $data['appointment_date'][]=$appointment['booked_date'];
			}
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function get_client_images(){  ////Json for fetching current and goal images of a client
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$client_id=$this->input->get('client_id');
			$data=array();
			$where_img=array(
			   'client_id' => $client_id
					);
			$current_images=$this->common_model->get('client_current_images',array('*'),$where_img);
			
			foreach($current_images as $curr){
				
			$info['id']=$curr['id'];
                        $info['image']=base_url().'client_current_images/'.$curr['image_name'];
			$info['image_thumbnail']=base_url().'client_current_images/thumb/'.$curr['image_name'];
                        $info['uploaded_date']=$curr['upload_date'];
                        $data['current_images'][]=$info;
			
			}
			
			$client_goal_image=$this->progress_model->get_client_goal_image($client_id);
			$info['id']=$client_goal_image[0]['id'];
                        $info['image']=base_url().'client_goal_images/'.$client_goal_image[0]['image_name'];
			$info['image_thumbnail']=base_url().'client_goal_images/thumb/'.$client_goal_image[0]['image_name'];
                        $info['uploaded_date']=$client_goal_image[0]['upload_date'];
			$data['goal_image'][]=$info;
			
			echo $jsonhtml=json_encode($data);
		  }
		
	}
	
	public function all_graphs(){  ////Json for fetchis all the graphs values of a client
		
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$client_id=$this->input->get('client_id');
			$data=array();
			$where_graph=array(
			   'client_id' => $client_id
					);
			$all_graphs=$this->common_model->get('user_graph',array('*'),$where_graph);
			foreach($all_graphs as $graph){
				$graph_info['id']=$graph['id'];
				$graph_info['graph_type']=$graph['graph_type'];
				$graph_info['graph_for']=$graph['graph_for'];
				$graph_info['measure_unit']=$graph['measure_unit'];
				$where_points=array(
					'graph_id' => $graph['id']
						    );
				$graph_points=$this->common_model->get('user_graph_points',array('*'),$where_points,null,null,0,10,null,null,'id','ASC');
				$graph_info['points'] = array();
				for($i=0;$i<count($graph_points);$i++){
					$info=array();
					$info['x_axis_point']=$graph_points[$i]['x_axis_val'];
					$info['y_axis_point']=$graph_points[$i]['y_axis_val'];
					$graph_info['points'][]=$info;
				}
				if(count($graph_points) < 10){
					for($i=count($graph_points);$i<10;$i++){
				            $info['x_axis_point']="00";
					    $info['y_axis_point']="00";
					    $graph_info['points'][]=$info;
					}
				}
				$data['all_graphs'][]=$graph_info;
			}
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function add_measurement(){
		
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$graph_id=$this->input->get('graph_id');
			$date_val=$this->input->get('date');
			$measurement=$this->input->get('measurement');
			$data=array();
			$data_measure=array(
				'graph_id' => $graph_id,
				'x_axis_val' => date('Y-m-d',strtotime($date_val)),
				'y_axis_val' => $measurement,
					    );
			$add_measure_info=$this->common_model->add('user_graph_points',$data_measure);
			if($add_measure_info != 0){
				
				$where_points=array(
					'graph_id' => $graph_id
						    );
				$where_graph=array(
					'id' => $graph_id
						    );
                                $graph_det=$this->common_model->get('user_graph',array('*'),$where_graph);
				$graph_points=$this->common_model->get('user_graph_points',array('*'),$where_points,null,null,0,10,null,null,'id','DESC');
				$data['id']=$graph_det[0]['id'];
				$data['graph_type']=$graph_det[0]['graph_type'];
				$data['graph_for']=$graph_det[0]['graph_for'];
				$data['measure_unit']=$graph_det[0]['measure_unit'];
				$data['points'] = array();
				for($i=0;$i<count($graph_points);$i++){
					$info=array();
					$info['x_axis_point']=$graph_points[$i]['x_axis_val'];
					$info['y_axis_point']=$graph_points[$i]['y_axis_val'];
					$data['points'][]=$info;
				}
				if(count($graph_points) < 10){
					for($i=count($graph_points);$i<10;$i++){
				            $info['x_axis_point']="00";
					    $info['y_axis_point']="00";
					    $data['points'][]=$info;
					}
				}
			}
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function client_current_image_upload(){
		        $client_id=$this->input->get('client_id');
			$data=array();
			if(isset($_FILES['client_current_image']['name'])){
			if($_FILES['client_current_image']['name']!= '')
			    {
				$DIR_IMG_NORMAL = "client_current_images/";
			
	                        $uploaded_file=$_FILES['client_current_image']['name'];
		                $ext=explode(".",$uploaded_file);
		                $extension=end($ext);
				$filename = 'current_image'.substr($_FILES['client_current_image']['name'],strripos($_FILES['client_current_image']['name'],'.'));
				$s=time()."_".$filename;
		 
				$fileNormal = $DIR_IMG_NORMAL.$s;
			      
		 
				$file = $_FILES['client_current_image']['tmp_name'];
				list($width, $height) = getimagesize($file);
		 
			       
				$result = move_uploaded_file($file, $fileNormal);
			       if($result)
			       {
				$this->create_thumb($s);
				$data_to_store=array(
				    'client_id' => $client_id, 
				    'image_name' => $s,
				    'upload_date' => date('Y-m-d')
				  );
				$add_res=$this->common_model->add('client_current_images',$data_to_store);
				if($add_res !=0){
					$where_image=array(
						'id' => $add_res
							   );
				    $image_det=$this->common_model->get('client_current_images',array('*'),$where_image);
				    $data['image_id'] = $image_det[0]['id'];
				    $data['client_id'] = $image_det[0]['client_id'];
				    $data['image_name'] = $image_det[0]['image_name'];
				    $data['upload_date'] = $image_det[0]['upload_date']; 
				}
			       }
			    }
			}
			    echo $jsonhtml=json_encode($data);
	}
	
	public function load_image(){
	  $this->load->view('test_image');
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
	    $this->load->library('image_lib');
		$this->image_lib->resize();
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		 if ( ! $this->image_lib->resize()){
                         return array('errors' => $this->image_lib->display_errors());
                 }
            
         }
	 function client_goal_image_upload(){
		  $client_id=$this->input->get('client_id');
			$data=array();
			if(isset($_FILES['client_goal_image']['name'])){
			if($_FILES['client_goal_image']['name']!= '')
			    {
				$DIR_IMG_NORMAL = "client_goal_images/";
			
	                        $uploaded_file=$_FILES['client_goal_image']['name'];
		                $ext=explode(".",$uploaded_file);
		                $extension=end($ext);
				$filename = 'goal_image'.substr($_FILES['client_goal_image']['name'],strripos($_FILES['client_goal_image']['name'],'.'));
				$s=time()."_".$filename;
		 
				$fileNormal = $DIR_IMG_NORMAL.$s;
			      
		 
				$file = $_FILES['client_goal_image']['tmp_name'];
				list($width, $height) = getimagesize($file);
		 
			       
				$result = move_uploaded_file($file, $fileNormal);
			       if($result)
			       {
				$this->create_thumb_goal($s);
				$data_to_store=array(
				    'image_name' => $s,
				    'upload_date' => date('Y-m-d')
				  );
				$where=array(
					'client_id' => $client_id, 
					     );
				$add_res=$this->common_model->update('client_goal_images',$data_to_store,$where);
				if($add_res){
					$where_image=array(
						'client_id' => $client_id
							   );
				    $image_det=$this->common_model->get('client_goal_images',array('*'),$where_image);
				    $data['image_id'] = $image_det[0]['id'];
				    $data['client_id'] = $image_det[0]['client_id'];
				    $data['image_name'] = $image_det[0]['image_name'];
				    $data['upload_date'] = $image_det[0]['upload_date']; 
				}
			       }
			    }
			}
			    echo $jsonhtml=json_encode($data);
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
	 
	public function graph_details(){
	 
	   if ($this->input->server('REQUEST_METHOD') === 'GET')
		  {
			$graph_id=$this->input->get('graph_id');
			$where=array(
				'id' => $graph_id
				     );
			$graph=$this->common_model->get('user_graph',array('*'),$where);
			if(count($graph) > 0)
			{
				
			
			$where_user=array(
				'id' => $graph[0]['client_id']
					  );
			$client=$this->common_model->get('user',array('*'),$where_user);
			$where_points=array(
					'graph_id' => $graph_id
						    );
			$graph_points=$this->common_model->get('user_graph_points',array('*'),$where_points,null,null,0,10,null,null,'id','ASC');
			$data['client_name'] = $client[0]['name'];
			$data['graph_type'] = $graph[0]['graph_type'];
			$data['graph_for'] = $graph[0]['graph_for'];
			$data['measure_unit'] = $graph[0]['measure_unit'];
			$data['points'] = array();
			for($i=0;$i<count($graph_points);$i++){
				$info=array();
				$info['x_axis_point']=$graph_points[$i]['x_axis_val'];
				$info['y_axis_point']=$graph_points[$i]['y_axis_val'];
				$data['points'][]=$info;
			}
			}
			else
			{
				$graph_points = array();
			}
			if(count($graph_points) < 10){
				for($i=count($graph_points);$i<10;$i++){
				    $info['x_axis_point']="00";
				    $info['y_axis_point']="00";
				    $data['points'][]=$info;
				}
			}
			echo $jsonhtml=json_encode($data);
		  }
	}
	
	public function get_client_details(){///Json for fetching client informtions
		
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
                     $user_id=$this->input->get('client_id');
                     $data=array();
                     $where=array(
			'id' => $user_id
			     );
                     $user_details= $this->common_model->get('user',array('*'),$where);
                     if(count($user_details) > 0)
                     {
                              $data['id']=$user_details[0]['id'];
                              $data['user_type']=$user_details[0]['type'];
                              $data['name']=$user_details[0]['name'];
                              $data['image']=base_url().'user_images/'.$user_details[0]['image'];
                              $data['email']=$user_details[0]['email'];
                              $data['address']=$user_details[0]['address'];
                              $data['company']=$user_details[0]['company'];
                              $data['work_address']=$user_details[0]['work_address'];
                              $data['billing_address']=$user_details[0]['billing_address'];
                              $data['phone']=$user_details[0]['phone'];
                              $data['about']=$user_details[0]['about'];
			      $data['date_of_birth']=$user_details[0]['date_of_birth'];
                              $data['height']=$user_details[0]['height'];
			      $data['weight']=$user_details[0]['weight'];
                     
                     }
                      echo $jsonhtml=json_encode($data);
                }
	
	}
	
	public function trainer_by_date(){
	       if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			 $date_val=date('Y-m-d',strtotime($this->input->get('date_val')));
			 $client_id=$this->input->get('client_id');
			 $trainer_info=$this->app_model->get_trainer_by_date($date_val);
			 $user_arr=array();
			 $data=array();
			 $where_user=array(
				'id' => $client_id
					  );
			 $client=$this->common_model->get('user',array('*'),$where_user);
			 array_push($user_arr,$client[0]['created_by']);
			 $where_share=array(
				'client_id' => $client_id
					  );
			 $shared_trainer=$this->common_model->get('shared_clients',array('*'),$where_share);
			 foreach($shared_trainer as $share){
				 array_push($user_arr,$share['trainer_id']);
			 }
			 foreach($trainer_info as $pt){
			      if (in_array($pt['trainer_id'], $user_arr)){
				$info=array();
				$where_pt=array(
				'id' => $pt['trainer_id']
					  );
			        $pt_info=$this->common_model->get('user',array('*'),$where_pt);
				$info['pt_id']=$pt['trainer_id'];
				$info['pt_name']=$pt_info[0]['name'];
				$info['pt_image']=base_url().'user_images/'.$pt_info[0]['image'];
				$info['working_address']=$pt_info[0]['work_address'];
				$data['trainer'][]=$info;
			      }
			 }
			 echo $jsonhtml=json_encode($data);
		}
	}
	
	public function trainer_booking_details(){
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			$trainer_id=$this->input->get('trainer_id');
			$date_val=$this->input->get('date_val');
			$current_date=date('Y-m-d H:i:s');
			$data=array();
			$where_time=array(
				'trainer_id' => $trainer_id
					  );
			$avail_time=$this->common_model->get('trainer_avail_time',array('*'),$where_time,null,null,null,null,null,null,'id','ASC');
			$count=1;
			foreach($avail_time as $time){
				$start_hour = date('H', strtotime($time['avl_time_from']));
				$end_hour = date('H', strtotime($time['avl_time_to']));
				for($i = $start_hour;$i < $end_hour ;$i++){
				   $start=$i.":00:00";
				   $end=($i+1).":00:00";
				   $start_date_time=date('Y-m-d H:i:s',strtotime(date('Y-m-d',strtotime($date_val))." ".$i.":00:00"));
				   $end_date_time=date('Y-m-d H:i:s',strtotime(date('Y-m-d',strtotime($date_val))." ".($i+1).":00:00"));
				   $where_book=array(
					'trainer_id' => $trainer_id,
					'booked_date' => date('Y-m-d',strtotime($date_val)),
					'booking_time_start' => $start,
					'booking_time_end' => $end
				   	     );
				   $booking_status=$this->common_model->get('user_booking',array('*'),$where_book);
				   $info['slot_start']=$i.":00";
				   $info['slot_end']=($i+1).":00";
				   $info['counter']="App ".$count;
				   if(count($booking_status) > 0){
					
						$info['status']='B';
				   }
				   else
				   {
					if($start_date_time < $current_date){
						$info['status']='Ex';
					}
					else
					{
					$info['status']='NB';
					}
				   }
				   $count++;
				   $data['time_slots'][]=$info;
				}
			}
			$data['trainer_id']=$trainer_id;
			$data['booking_date']=$date_val;
			
			echo $jsonhtml=json_encode($data);
		}
	}
	
	public function add_booking(){ ///Json for do booking for an appoinment
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			$data=array();
			$trainer_id=$this->input->get('trainer_id');
			$client_id=$this->input->get('client_id');
			$booked_date=date('Y-m-d',strtotime($this->input->get('booking_date')));
			$start_time=date('H:i:s',strtotime($this->input->get('slot_start')));
			$end_time=date('H:i:s',strtotime($this->input->get('slot_end')));
			$check_date=date('Y-m-d H:i:s',strtotime($booked_date." ".$start_time));
			$curr_date=date('Y-m-d H:i:s');
			if($check_date > $curr_date){
			$where_date=array(
			    'booked_date' => $booked_date,
			    'booking_time_start' => $start_time,
			    'booking_time_end' => $end_time,
			    'trainer_id' => $trainer_id
					  );
			$check_app=$this->common_model->get('user_booking',array('*'),$where_date);
			if(count($check_app) == 0){
			$date_where=array(
				'trainer_id' => $trainer_id,
				'repeat_date' => $booked_date
					  );
			$date_checking=$this->common_model->get('trainer_avl_time_repeat_val',array('*'),$date_where);
			if(count($date_checking) > 0){
			$time_where=array(
				'trainer_id' => $trainer_id,
					  );
			$time_checking=$this->common_model->get('trainer_avail_time',array('*'),$time_where);
			$flag=0;
			if(count($time_checking) > 0){
				foreach($time_checking as $time_chk){
					$avial_start=date('H:i:s',strtotime($time_chk['avl_time_from']));
					$avial_end=date('H:i:s',strtotime($time_chk['avl_time_to']));
					if(($start_time >= $avial_start) && ($end_time <= $avial_end)){
						$flag=1;
					}
				}
			if($flag ==1){
			$where_ex=array(
					'client_id' => $client_id,
					'workout_date' => $booked_date
				   	     );
			$exercise=$this->common_model->get('user_program_exercises',array('*'),$where_ex);
			$program_arr=array();
			$program_name_arr=array();
			foreach($exercise as $ex){
			 $where_program=array(
					'id' => $ex['program_id']
				   	     );
			 $program=$this->common_model->get('user_program',array('*'),$where_program);
			 $where_main_prg_name=array(
				'id' => $program[0]['default_program_id']
				     );
			 $get_progrm_main_name = $this->common_model->get('program_list',array('*'),$where_main_prg_name);
			 array_push($program_arr,$program[0]['default_program_id']);
			 array_push($program_name_arr,$get_progrm_main_name[0]['name']);
			}
			$program_list=implode(",",$program_arr);
			$name_list=implode(",",$program_name_arr);
			$data_to_add=array(
				'trainer_id' => $trainer_id,
				'client_id' => $client_id,
				'booked_by' => $client_id,
				'booked_date' => $booked_date,
				'booking_time_start' => $start_time,
				'booking_time_end' => $end_time,
				'status' => 'B',
				'booking_date' => date('Y-m-d'),
				'program_id' => $program_list
					     );
			$add_booking=$this->common_model->add('user_booking',$data_to_add);
			if($add_booking != 0){
				$data_to_store = array(
					'id' => 4
				    );
				$site_details = $this->sitesetting_model->get_settings();
				$get_email_template = $this->common_model->get('email_template',array('*'),$data_to_store);
				$system_mail = $site_details[0]['system_email'];
				$where_client=array(
				'id' => $client_id
				     );
				$get_progrm_client = $this->common_model->get('user',array('*'),$where_client);
				$mail =$get_progrm_client[0]['email'];
				$name_client = $get_progrm_client[0]['name'];
				$where_trainer=array(
				'id' => $trainer_id
				     );
				$get_progrm_trainer = $this->common_model->get('user',array('*'),$where_trainer);
				if($get_progrm_trainer[0]['name'] != '')
				$trainer_name = $get_progrm_trainer[0]['name'];
				else
				$trainer_name = $get_progrm_trainer[0]['email'];
				
				$trainer_email = $get_progrm_trainer[0]['email'];
				
				$date = date("jS, F Y",strtotime($booked_date));
				$time_start = date("h:i a",strtotime($start_time));
				$time_end = date("h:i a",strtotime($end_time));
				
				
				
				$email_content= $this->common_model->get('email_template',array('*'),$data_to_store);
				$email_body = $email_content[0]['email_body'];
				$search_val= array("[TRAINER]","[DATE]","[TIME]","[PROGRAM]");
				$replace_val   = array($trainer_name,$date,$time_start."-".$time_end,$name_list);
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
				$replace_val   = array($name_client,$date,$time_start."-".$time_end,$name_list);
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
				  
				  $notification="Booked 1 Appoinment.";
				  $data_notification=array(
					'user_id' =>$trainer_id,
					'client_id' => $get_progrm_client[0]['id'],
					'notification' =>$notification,
					'notification_time' => date('Y-m-d H:i:s')
							   );
				  $add_notification=$this->common_model->add('notifications',$data_notification);
				  $data['response']='Success';
			}
			}
			else
			{
			  $data['response']='failed';
			}
			}
			else
			{
			  $data['response']='failed';
			}
			}
			else
			{
			  $data['response']='failed';
			}
			}
			else
			{
			  $data['response']='failed';
			}
			}
			else
			{
			  $data['response']='failed';
			}
			echo $jsonhtml=json_encode($data);
		}
		
	}
	
	public function cancel_booking(){ ///Json for canceling a booked appoinment
		
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			$booking_id = $this->input->get('booking_id');
			$data=array();
			$del_val_arr = array(
				'id' => $booking_id
			       );
			$trainer_all_booking=$this->common_model->get('user_booking',array('*'),$del_val_arr);
			if(count($trainer_all_booking) > 0){
			$time_start = date("h:i a",strtotime($trainer_all_booking[0]['booking_time_start']));
			$time_end = date("h:i a",strtotime($trainer_all_booking[0]['booking_time_end']));
			$del_row= $trainer_all_booking[0]['booked_date'];
			if(date('Y-m-d',strtotime($trainer_all_booking[0]['booked_date']." ".$trainer_all_booking[0]['booking_time_start'])) > date('Y-m-d H:i:s')){
			$trainer_detail_arr = array(
			'id' => $trainer_all_booking[0]['trainer_id']
		       );
			$trainer_details = $this->common_model->get('user',array('*'),$trainer_detail_arr);
			$trainer_name = $trainer_details[0]['name'];
			if($trainer_name == '')
			{
				$trainer_name = $trainer_details[0]['email'];
			}
			
			$client_detail_arr = array(
			'id' => $trainer_all_booking[0]['client_id']
		       );
			$client_details = $this->common_model->get('user',array('*'),$client_detail_arr);
			$client_name = $client_details[0]['name'];
			$client_email = $client_details[0]['email'];
			$site_details = $this->sitesetting_model->get_settings();
			$system_mail = $site_details[0]['system_email'];
			$data_to_store_new = array(
				'id' => 6
			    );
			$email_content= $this->common_model->get('email_template',array('*'),$data_to_store_new);
			$email_body = $email_content[0]['email_body'];
			$search_val= array("[TRAINER]","[DATE]","[TIME]");
			$replace_val   = array($trainer_name,$del_row,$time_start."-".$time_end);
			$newbody = str_replace($search_val, $replace_val, $email_body);
			$message=$newbody;
			$this->load->library('email');
			     
			  $config['protocol'] = 'sendmail';
			  $config['charset'] = 'utf-8';
			  $config['wordwrap'] = TRUE;
			  $config['mailtype'] = 'html';
			  
			  $this->email->initialize($config);
			     
			  $this->email->from($system_mail,$site_details[0]['site_name']);
			  $this->email->to($client_email);
			  
			  $this->email->subject($email_content[0]['subject']);
			  $this->email->message($message);	
			  
			  $this->email->send();
			  
			  $data_to_store_new = array(
				'id' => 7
			    );
			$email_content= $this->common_model->get('email_template',array('*'),$data_to_store_new);
			$email_body = $email_content[0]['email_body'];
			$search_val= array("[CLIENT]","[DATE]","[TIME]");
			$replace_val   = array($client_name,$del_row,$time_start."-".$time_end);
			$newbody = str_replace($search_val, $replace_val, $email_body);
			$message=$newbody;
			$this->load->library('email');
			     
			  $config['protocol'] = 'sendmail';
			  $config['charset'] = 'utf-8';
			  $config['wordwrap'] = TRUE;
			  $config['mailtype'] = 'html';
			  
			  $this->email->initialize($config);
			     
			  $this->email->from($system_mail,$site_details[0]['site_name']);
			  $this->email->to($trainer_details[0]['email']);
			  
			  $this->email->subject($email_content[0]['subject']);
			  $this->email->message($message);	
			  
			  $this->email->send();
			  $del_val_arr = array(
				'id' => $booking_id
			       );
			$del_booking=$this->common_model->delete('user_booking',$del_val_arr);
			if($del_booking)
			{
				$data['response']='success';
				$notification="Cancelled 1 Appoinment";
				  $data_notification=array(
					'user_id' =>$trainer_all_booking[0]['trainer_id'],
					'client_id' => $client_details[0]['id'],
					'notification' =>$notification,
					'notification_time' => date('Y-m-d H:i:s')
							   );
				  $add_notification=$this->common_model->add('notifications',$data_notification);
				
			}
			else
			{
				$data['response']='failed';
			}
			}
			else
			{
				$data['response']='cancel not possible';
			}
		
		}
		else
		{
			$data['response']='invalid';
		}
			echo $jsonhtml=json_encode($data);
		}
		
	}
	
	public function get_all_booking(){  ///Json for fetching all bookings list of a client on aparticular date
		
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			$client_id=$this->input->get('client_id');
			$date_val=date('Y-m-d',strtotime($this->input->get('date_val')));
			$data=array();
			$where_data=array(
				'client_id' => $client_id,
				'booked_date' => $date_val
					  );
			$bookings= $this->common_model->get('user_booking',array('*'),$where_data);
			foreach($bookings as $book){
			  $trainer_detail = array(
			           'id' => $book['trainer_id']
		            );
			  $trainer_details = $this->common_model->get('user',array('*'),$trainer_detail);
			  $booked_by = array(
			           'id' => $book['booked_by']
		            );
			  $booked_by_det = $this->common_model->get('user',array('*'),$booked_by);
                          $program_arr=array();
			  $program_name_arr=array();
			  $program_arr=explode(" ",$book['program_id']);
			  foreach($program_arr as $key=>$value){
			  $where_main_prg_name=array(
				'id' => $value
				     );
			  $get_progrm_main_name = $this->common_model->get('program_list',array('*'),$where_main_prg_name);
			  if(isset($get_progrm_main_name[0]['name'])){
			  array_push($program_name_arr,$get_progrm_main_name[0]['name']);
			  }
			  }
			  $name_list=implode(",",$program_name_arr);
				$info['id']=$book['id'];
				$info['trainer_name']=$trainer_details[0]['name'];
				$info['booked_by']=$booked_by_det[0]['name'];
				$info['booked_date']=$book['booked_date'];
				$info['booking_time_start']=$book['booking_time_start'];
				$info['booking_time_end']=$book['booking_time_end'];
				$info['status']=$book['status'];
				$info['booking_date']=$book['booking_date'];
				$info['program_name']=$name_list;
				$data['bookings'][]=$info;
			}
			echo $jsonhtml=json_encode($data);
		}
	}
	
	public function get_each_booking_details(){ //Json for getting information about a particular booke appoinment
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			$booking_id=$this->input->get('booking_id');
			$data=array();
			$where_data=array(
				'id' => $booking_id
					  );
			$booking_det= $this->common_model->get('user_booking',array('*'),$where_data);
			if(count($booking_det) > 0){
			$trainer_detail = array(
			           'id' => $booking_det[0]['trainer_id']
		            );
			$trainer_details = $this->common_model->get('user',array('*'),$trainer_detail);
			$booked_by = array(
			           'id' => $booking_det[0]['booked_by']
		            );
			$booked_by_det = $this->common_model->get('user',array('*'),$booked_by);
		        $program_arr=array();
			$program_name_arr=array();
			$program_arr=explode(" ",$booking_det[0]['program_id']);
			foreach($program_arr as $key=>$value){
			  $where_main_prg_name=array(
				'id' => $value
				     );
			  $get_progrm_main_name = $this->common_model->get('program_list',array('*'),$where_main_prg_name);
			  if(isset($get_progrm_main_name[0]['name'])){
			  array_push($program_name_arr,$get_progrm_main_name[0]['name']);
			  }
			  }
			  $curr_date=date('Y-m-d');
			  $curr_time=date('H:i:s');
			$name_list=implode(",",$program_name_arr);
			$data['trainer_name']=$trainer_details[0]['name'];
			$data['trainer_image']=base_url().'user_images/'.$trainer_details[0]['image'];
			$data['trainer_about']=$trainer_details[0]['about'];
			$data['trainer_address']=$trainer_details[0]['work_address'];
			$data['booked_by']=$booked_by_det[0]['name'];
			$data['booked_date']=$booking_det[0]['booked_date'];
			$data['booking_time_start']=$booking_det[0]['booking_time_start'];
			$data['booking_time_end']=$booking_det[0]['booking_time_end'];
			if(date('Y-m-d',strtotime($booking_det[0]['booked_date'])) < $curr_date){
			  if(date('H:i:s',strtotime($booking_det[0]['booking_time_start'])) < $curr_time){
			         $data['cancel_status']='CAN_NOT';
			  }
			  else
			  {
				 $data['cancel_status']='CAN';
			  }
			}
			else
			{
			   $data['cancel_status']='CAN';
			}
			$data['status']=$booking_det[0]['status'];
			$data['booking_date']=$booking_det[0]['booking_date'];
			$data['program_name']=$name_list;
		}else
		{
			$data['response']='invalid';
		}
			
			echo $jsonhtml=json_encode($data);
		}
	}
}
?>