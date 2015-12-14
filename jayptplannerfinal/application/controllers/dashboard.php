<?php
class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// load models
		$this->load->model('sitesetting_model');
		$this->load->model('contactsetting_model');
		$this->load->model('common_model');
		$this->load->model('network_model');
		$this->load->model('trainer_model');
	}
	function index()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
		}
		$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		// load template
		$this->load->view('dashboard');
		// load HTML footer file
		$this->load->view('footer');
		
		// load HTML footer file
		$this->load->view('HTML_footer');
	}
	function add_client()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		//	if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//        }
			$data_to_store = array(
			'email' => trim($this->input->post('email'))
		    );
		   $user_id = $this->session->userdata('site_user_id');
		    // getting user info
		    $user_info = $this->common_model->get('user',array('*'),$data_to_store);
		     $password=random_string('alnum',10);
		    if(count($user_info) == 0)
		    {
			$data_to_store = array(
				'name' => trim($this->input->post('name_val')),
				'type' => 'C',
				'created_by' => $user_id,
				'email' => trim($this->input->post('email')),
				'password' => md5($password),
				'created_date' => date("Y-m-d"),
				'status' => 'Y'
				
			    );
	
			    // getting user info
			    $user_insrt = $this->common_model->add('user',$data_to_store);
			    if($user_insrt)
			    {
				$data_to_store = array(
					'id' => 1
				    );
				$site_details = $this->sitesetting_model->get_settings();
				//$get_email_template = $this->common_model->get('email_template',array('*'),$data_to_store);
				//$system_mail = $site_details[0]['system_email'];
				//$mail =$this->input->post('email');
				//$email_content= $this->common_model->get('email_template',array('*'),$data_to_store);
				//$email_body = $email_content[0]['email_body'];
				//$search_val= array("[EMAIL]","[PASSWORD]");
				//$replace_val   = array($this->input->post('email'),$password);
				//$newbody = str_replace($search_val, $replace_val, $email_body);
				//$message=$newbody;
				//
				//$this->load->library('email');
				//     
				//  $config['protocol'] = 'sendmail';
				//  $config['charset'] = 'utf-8';
				//  $config['wordwrap'] = TRUE;
				//  $config['mailtype'] = 'html';
				//  
				//  $this->email->initialize($config);
				//     
				//  $this->email->from($system_mail,$site_details[0]['site_name']);
				//  $this->email->to($mail);
				//  
				//  $this->email->subject($email_content[0]['subject']);
				//  $this->email->message($message);	
				//  
				//  $this->email->send();
				
				//$this->session->set_flashdata("flash_message",'client_created');
				redirect('client-profile/'.$user_insrt);
			    }
			  
		    }
		    else{
			$this->session->set_flashdata("flash_message",'email_exits');
		    }
		      redirect("dashboard");
		}
		
	}
	
	public function my_account_page()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
	          {
		//	if(!$this->session->userdata('is_site_logged_in')){
		//	 redirect('home');
		//         }
			$name=$this->input->post('fullname');
			$phn_num=$this->input->post('phn_num');
			$working_add=$this->input->post('working_add');
			$billing_add=$this->input->post('billing_add');
			$about=$this->input->post('about');
			if($_FILES['user_image']['name']!= '')
			    {
				$DIR_IMG_NORMAL = "user_images/";
			
	                        $uploaded_file=$_FILES['user_image']['name'];
		                $ext=explode(".",$uploaded_file);
		                $extension=end($ext);
				$filename = 'profile'.substr($_FILES['user_image']['name'],strripos($_FILES['user_image']['name'],'.'));
				$s=time()."_".$filename;
		 
				$fileNormal = $DIR_IMG_NORMAL.$s;
			      
		 
				$file = $_FILES['user_image']['tmp_name'];
				list($width, $height) = getimagesize($file);
		 
			       
				$result = move_uploaded_file($file, $fileNormal);
			       if($result)
			       {
				$this->create_thumb($s);
					$data_to_dpdt=array(
					   'name'=>$name,
					   'phone' =>$phn_num,
					   'work_address' =>$working_add,
					   'billing_address' =>$billing_add,
					   'about' =>$about,
					   'image' => $s
						       );
			       }
			    }
			    else
			    {
					$data_to_dpdt=array(
					   'name'=>$name,
					   'phone' =>$phn_num,
					   'work_address' =>$working_add,
					   'billing_address' =>$billing_add,
					   'about' =>$about
						        );
			    }
			$where_profile=array(
				'id' => $this->session->userdata('site_user_id')
					     );
			$update_res=$this->common_model->update('user',$data_to_dpdt,$where_profile);
			if($update_res)
			{
			  $this->session->set_flashdata('flash_message', 'acc_updated');
			}
			redirect('my-account');
		  }
		$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		$where=array(
			'id' => $this->session->userdata('site_user_id')
			     );
		$data['user_details']= $this->common_model->get('user',array('*'),$where);
		// load template
		$this->load->view('my_account',$data);
		// load HTML footer file
		$this->load->view('footer');
		
		// load HTML footer file
		$this->load->view('HTML_footer');
	}
	function create_thumb($imagename)
        {
            $config['image_library'] = 'gd2';
            $config['source_image']	= 'user_images/'.$imagename;
            $config['new_image'] = 'user_images/';
            //$config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']	 = 190;
            $config['height']	= 225;
            
            //$this->image_lib->initialize($config);
            $this->load->library('image_lib', $config); 
            $result=$this->image_lib->resize();
            $this->image_lib->clear();
            
         }
	 public function change_password()
	 {
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
             $new_pass=$this->input->post('new_pass');
	      $data_to_dpdt=array(
                        'password' => md5($new_pass)
				);
	      $where=array(
		'id' => $this->session->userdata('site_user_id')
			   );
	      $update_res=$this->common_model->update('user',$data_to_dpdt,$where);
	      if($update_res)
	      {
		$this->session->set_flashdata('flash_message', 'password_changed');
	      }
	      redirect('my-account');
	 }
	 
	 public function client_profile()
	 {
		
		 $client_id=$this->uri->segment(2);
		if($this->input->server('REQUEST_METHOD') == 'POST')
	          {
			 $name=$this->input->post('fullname');
			 $email=$this->input->post('email');
			 $phn_num=$this->input->post('phn_num');
			 $working_add=$this->input->post('working_add');
			 $about=$this->input->post('about');
			 $date_of_birth=date('Y-m-d',strtotime($this->input->post('date_of_birth')));
                         $height=$this->input->post('height');
                         $weight=$this->input->post('weight');
			 $email_check=$this->trainer_model->check_email_exists_or_not($email,$client_id);
			 if($_FILES['user_image']['name']!= '')
			    {
				$DIR_IMG_NORMAL = "user_images/";
			
	                        $uploaded_file=$_FILES['user_image']['name'];
		                $ext=explode(".",$uploaded_file);
		                $extension=end($ext);
				$filename = 'profile'.substr($_FILES['user_image']['name'],strripos($_FILES['user_image']['name'],'.'));
				$s=time()."_".$filename;
		 
				$fileNormal = $DIR_IMG_NORMAL.$s;
			      
		 
				$file = $_FILES['user_image']['tmp_name'];
				list($width, $height) = getimagesize($file);
		 
			       
				$result = move_uploaded_file($file, $fileNormal);
			       if($result)
			       {
				$this->create_thumb($s);
				
				  if(count($email_check)==0)
				  {
					$data_to_dpdt=array(
					   'name'=>$name,
					   'email'=>$email,
					   'phone' =>$phn_num,
					   'work_address' =>$working_add,
					   'about' =>$about,
					   'image' => $s,
					   'date_of_birth' => $date_of_birth,
                                          'height' => $height,
                                          'weight' => $weight
						       );
				  }
				  else
				  {
				       	$data_to_dpdt=array(
					   'name'=>$name,
					   'phone' =>$phn_num,
					   'work_address' =>$working_add,
					   'about' =>$about,
					   'image' => $s,
					   'date_of_birth' => $date_of_birth,
                                          'height' => $height,
                                          'weight' => $weight
						       );
				  }
			       }
			    }
			    else
			    {
				 if(count($email_check)==0)
				  {
					$data_to_dpdt=array(
					   'name'=>$name,
					   'email'=>$email,
					   'phone' =>$phn_num,
					   'work_address' =>$working_add,
					   'about' =>$about,
					   'date_of_birth' => $date_of_birth,
                                          'height' => $height,
                                          'weight' => $weight
						        );
				  }
				  else{
					$data_to_dpdt=array(
					   'name'=>$name,
					   'phone' =>$phn_num,
					   'work_address' =>$working_add,
					   'about' =>$about,
					   'date_of_birth' => $date_of_birth,
                                          'height' => $height,
                                          'weight' => $weight
						        );
				  }
			    }
			    $where_profile=array(
				'id' => $client_id
					     );
			    $update_res=$this->common_model->update('user',$data_to_dpdt,$where_profile);
			if($update_res)
			{
			  $this->session->set_flashdata('flash_message', '');
			}
			redirect('client-profile/'.$client_id);
		  }
		$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		$where=array(
			'id' => $client_id
			     );
		$data['user_details']= $this->common_model->get('user',array('*'),$where);
		// load template
		$this->load->view('client_profile',$data);
		// load HTML footer file
		$this->load->view('footer');
		
		// load HTML footer file
		$this->load->view('HTML_footer');
	 }
	 public function delete_client_account()
	 {
		$client_id=$this->uri->segment(2);
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		$data_to_dpdt=array(
			'deleted_status' => 'Y'
				    );
		  $where_profile=array(
				'id' => $client_id
					     );
		  $update_res=$this->common_model->update('user',$data_to_dpdt,$where_profile);
		  if($update_res)
		  {
		     $this->session->set_flashdata('flash_message', 'client_deleted');
		  }
		  redirect('client-profile/'.$client_id);
	 }
	 public function client_password_change()
	 {
		$client_id=$this->uri->segment(2);
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		$password=random_string('alnum',10);
                $data_to_dpdt=array(
			'password' => md5($password)
				    );
		$where_profile=array(
				'id' => $client_id
				 );
		 $details= $this->common_model->get('user',array('*'),$where_profile);
		 $update_res=$this->common_model->update('user',$data_to_dpdt,$where_profile);
		  if($update_res)
		  {
				$data_to_store = array(
					'id' => 1
				    );
		                $site_details = $this->sitesetting_model->get_settings();
				//$get_email_template = $this->common_model->get('email_template',array('*'),$data_to_store);
				$system_mail = $site_details[0]['system_email'];
				$mail =$details[0]['email'];
				$email_content= $this->common_model->get('email_template',array('*'),$data_to_store);
				$email_body = $email_content[0]['email_body'];
				$search_val= array("[EMAIL]","[PASSWORD]");
				$replace_val   = array($details[0]['email'],$password);
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
		                  $this->session->set_flashdata('flash_message', '');
		  }
		  redirect('client-profile/'.$client_id);
	 }
	 public function change_client_status()
	 {
		///Account Activation / Deactivation
		 $client_id=$this->input->post('client_id');
		 $current_status=$this->input->post('acc_status');
		// if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		 if($current_status==0)
		 {
			$dataChange=array(
				'status' =>'N'
					    );
		 }
		 elseif($current_status==1)
		 {
			$dataChange=array(
				'status' =>'Y'
					    );
		 }
		 $where=array(
			'id' => $client_id
			     );
		 $update_res=$this->common_model->update('user',$dataChange,$where);
		 if($update_res)
		 {
		    $this->session->set_flashdata('flash_message', '');
		 }
		 redirect('client-profile/'.$client_id);
	 }
	 
	 public function network_page()
	 {
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		// load template
		$where_profile=array(
		'created_by' => $this->session->userdata('site_user_id')
		 );
		$data['network_list']=$this->common_model->get('network',array('*'),$where_profile);
		$data['other_networks']=$this->network_model->get_other_networks($this->session->userdata('site_user_id'));
		$data['trainer_list']=$this->network_model->get_all_trainers();
		$this->load->view('network',$data);
		// load HTML footer file
		$this->load->view('footer');
		// load HTML footer file
		$this->load->view('HTML_footer');
	 }
	 
	 public function create_network()
	 {
	    $network_name=$this->input->post('network_name');
	    $members=$this->input->post('member');
	    $member_email=$this->input->post('member_email');
	    $email_array=explode(",",$member_email);
	    $data_to_store=array(
		'created_by' => $this->session->userdata('site_user_id'),
		'network_name' => $network_name,
		'created_date' => date('Y-m-d H:i:s'),
		'status' => 'Y'
				 );
	    $add_res=$this->common_model->add('network',$data_to_store);
	    if($add_res!=0)
	    {
		$where_nt=array(
				'id' => $add_res
			);
		$get_net_info=$this->common_model->get('network',array('*'),$where_nt);
		$where_profile=array(
		'id' => $this->session->userdata('site_user_id')
		 );
                $user_info=$this->common_model->get('user',array('*'),$where_profile);
		$data_add_member=array(
			'network_id' => $add_res,
			'user_id' => $this->session->userdata('site_user_id'),
			'user_email' => $user_info[0]['email'],
			'status' =>'Y'
				       );
		$add_member_res=$this->common_model->add('network_member',$data_add_member);
		if(count($members) > 0)
		{
		 foreach($members as $key=>$value)
		 {
			$where_profile=array(
			'id' => $value
			 );
			$user_info1=$this->common_model->get('user',array('*'),$where_profile);
			$data_member=array(
				'network_id' => $add_res,
				'user_id' => $value,
				'user_email' => $user_info1[0]['email'],
				'status' =>'Y'
					       );
			$add_member_res=$this->common_model->add('network_member',$data_member);
			if($add_member_res !=0){
			
				$where_data=array(
				'created_by' => $value
				 );
				$get_clients=$this->common_model->get('user',array('*'),$where_data);
				if(count($get_clients) > 0){
					
					foreach($get_clients as $client)
					{
						$where_exist=array(
							'client_id' => $client['id'],
							'trainer_id' => $this->session->userdata('site_user_id')
								   );
						$exist=$this->common_model->get('shared_clients',array('*'),$where_exist);
						if(count($exist) == 0){
						$data_shared_client=array(
							'trainer_id' => $this->session->userdata('site_user_id'),
							'client_id' => $client['id'],
							'client_created_by' => $value
									  );
						$add_shared_client=$this->common_model->add('shared_clients',$data_shared_client);
						}
					}
				}
				
				
				$where_data_own=array(
				'created_by' => $this->session->userdata('site_user_id')
				 );
				$get_clients_own=$this->common_model->get('user',array('*'),$where_data_own);
				if(count($get_clients_own) > 0){
					
					foreach($get_clients_own as $client)
					{
						$where_exist=array(
							'client_id' => $client['id'],
							'trainer_id' => $value
								   );
						$exist1=$this->common_model->get('shared_clients',array('*'),$where_exist);
							if(count($exist1) == 0){
							$data_shared_client=array(
								'trainer_id' => $value,
								'client_id' => $client['id'],
								'client_created_by' => $this->session->userdata('site_user_id')
										  );
							$add_shared_client=$this->common_model->add('shared_clients',$data_shared_client);
						}
					}
				}
				$member_trainers=$this->network_model->get_network_member_details($add_res);
				if(count($member_trainers) > 0){
				foreach($member_trainers as $trainer){
					if($trainer['user_id'] != $value){
					
					$where_data_train=array(
					'created_by' => $trainer['user_id']
					 );
				$get_clients_train=$this->common_model->get('user',array('*'),$where_data_train);
				if(count($get_clients_train) > 0){
					foreach($get_clients_train as $client)
						{
							$where_exist=array(
								'client_id' => $client['id'],
								'trainer_id' => $value
									   );
							$exist_train=$this->common_model->get('shared_clients',array('*'),$where_exist);
								if(count($exist_train) == 0){
								$data_shared_client=array(
									'trainer_id' => $value,
									'client_id' => $client['id'],
									'client_created_by' =>$trainer['user_id']
											  );
								$add_shared_client=$this->common_model->add('shared_clients',$data_shared_client);
							}
						}
				        }
					
					
				if(count($get_clients) > 0){
					
					foreach($get_clients as $client)
					{
						$where_exist=array(
							'client_id' => $client['id'],
							'trainer_id' =>$trainer['user_id']
								   );
						$exist=$this->common_model->get('shared_clients',array('*'),$where_exist);
						if(count($exist) == 0){
						$data_shared_client=array(
							'trainer_id' => $trainer['user_id'],
							'client_id' => $client['id'],
							'client_created_by' => $value
									  );
						$add_shared_client=$this->common_model->add('shared_clients',$data_shared_client);
						}
					}
				}
				}	
				}
			}
			}
		 }
		}
		if($member_email!='')
		{
			foreach($email_array as $key=>$value)
			{
				$data_member_email=array(
					'network_id' => $add_res,
					'user_id' => 0,
					'user_email' => $value,
					'status' =>'Y'
					 );
				$add_member_res=$this->common_model->add('network_member',$data_member_email);
			}
		}
	    }
	    redirect('network');
	 }
	 
	 public function add_member_to_network() //// ajax caLL for add more member pop-up
	 {
		$network_id=$this->input->post('network_id');
		$data['total_member']=$this->network_model->get_network_member_details($network_id);
		$data['trainer_list']=$this->network_model->get_all_trainers();
		$where=array(
			'id' => $network_id
			 );
		$data['network_info']=$this->common_model->get('network',array('*'),$where);
		$this->load->view('add_member_to_network',$data);
	 }
	 
	 public function add_extra_member(){  /////Adding more members
		$network_id=$this->input->post('network_id');
		$members=$this->input->post('member');
		$where_nt=array(
				'id' => $network_id
				 );
		$get_net_info=$this->common_model->get('network',array('*'),$where_nt);
		foreach($members as $key=>$value)
		{
			$where_profile=array(
				'id' => $value
				 );
			$user_info=$this->common_model->get('user',array('*'),$where_profile);
			$data_member=array(
				'network_id' => $network_id,
				'user_id' => $value,
				'user_email' => $user_info[0]['email'],
				'status' =>'Y'
					       );
			$add_member_res=$this->common_model->add('network_member',$data_member);
			if($add_member_res != 0){
				$where_data=array(
				'created_by' => $value
				 );
				$get_clients=$this->common_model->get('user',array('*'),$where_data);
				if(count($get_clients) > 0){
					
					foreach($get_clients as $client)
					{
						$where_exist=array(
							'client_id' => $client['id'],
							'trainer_id' => $this->session->userdata('site_user_id')
								   );
						$exist=$this->common_model->get('shared_clients',array('*'),$where_exist);
						if(count($exist) == 0){
						$data_shared_client=array(
							'trainer_id' => $this->session->userdata('site_user_id'),
							'client_id' => $client['id'],
							'client_created_by' => $value
									  );
						$add_shared_client=$this->common_model->add('shared_clients',$data_shared_client);
						}
					}
				}
				
				$where_data_own=array(
				'created_by' => $this->session->userdata('site_user_id')
				 );
				$get_clients_own=$this->common_model->get('user',array('*'),$where_data_own);
				if(count($get_clients_own) > 0){
					
					foreach($get_clients_own as $client)
					{
						$where_exist=array(
							'client_id' => $client['id'],
							'trainer_id' => $value
								   );
						$exist1=$this->common_model->get('shared_clients',array('*'),$where_exist);
							if(count($exist1) == 0){
							$data_shared_client=array(
								'trainer_id' => $value,
								'client_id' => $client['id'],
								'client_created_by' => $this->session->userdata('site_user_id')
										  );
							$add_shared_client=$this->common_model->add('shared_clients',$data_shared_client);
						}
					}
				}
				$member_trainers=$this->network_model->get_network_member_details($network_id);
				if(count($member_trainers) > 0){
				foreach($member_trainers as $trainer){
					if($trainer['user_id'] != $value){
					
					$where_data_train=array(
					'created_by' => $trainer['user_id']
					 );
				$get_clients_train=$this->common_model->get('user',array('*'),$where_data_train);
				if(count($get_clients_train) > 0){
					foreach($get_clients_train as $client)
						{
							$where_exist=array(
								'client_id' => $client['id'],
								'trainer_id' => $value
									   );
							$exist_train=$this->common_model->get('shared_clients',array('*'),$where_exist);
								if(count($exist_train) == 0){
								$data_shared_client=array(
									'trainer_id' => $value,
									'client_id' => $client['id'],
									'client_created_by' =>$trainer['user_id']
											  );
								$add_shared_client=$this->common_model->add('shared_clients',$data_shared_client);
							}
						}
				        }
					
					
				if(count($get_clients) > 0){
					
					foreach($get_clients as $client)
					{
						$where_exist=array(
							'client_id' => $client['id'],
							'trainer_id' =>$trainer['user_id']
								   );
						$exist=$this->common_model->get('shared_clients',array('*'),$where_exist);
						if(count($exist) == 0){
						$data_shared_client=array(
							'trainer_id' => $trainer['user_id'],
							'client_id' => $client['id'],
							'client_created_by' => $value
									  );
						$add_shared_client=$this->common_model->add('shared_clients',$data_shared_client);
						}
					}
				}
				}	
				}
			}

			}
		}
		redirect('network');
	 }
	 
	 public function change_network_name() ///Editing A Network name
	 {
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
	   $network_name=$this->input->post('network_name');
	   $network_id=$this->input->post('network_id');
	   $where=array(
               'id' => $network_id
		 );
	   $data_to_update=array(
		'network_name' => $network_name
				 );
           $update_res=$this->common_model->update('network',$data_to_update,$where);
	   redirect('network');
	 }
	 public function delete_network() //// Network Deletion
	 {
		
	     $network_id=$this->input->post('net_id');
	     $network_members=$this->network_model->get_all_memebrs_of_network($network_id);
	     foreach($network_members as $member){
		      $other_members=$this->network_model->get_all_memebrs_of_network_except($network_id,$member['user_id']);
		      foreach($other_members as $other){
			
			$net_res=$this->network_model->get_other_networks1($network_id,$other['user_id']);
			if(count($net_res) > 0){
			foreach($net_res as $net){
			      
			     $exist_res= $this->network_model->network_member_existance($member['user_id'],$net['network_id']);
			     if(count($exist_res) == 0){
			         $delete_share_other=$this->network_model->delete_shared_clients($other['user_id'],$member['user_id']);
				 $delete_share_other1=$this->network_model->delete_shared_clients($member['user_id'],$other['user_id']);
			     }
			}
			}
			else
			{
				$delete_share_other=$this->network_model->delete_shared_clients($other['user_id'],$member['user_id']);
				$delete_share_other1=$this->network_model->delete_shared_clients($member['user_id'],$other['user_id']);
			}
			
		      }
		}
	     $del_res=$this->network_model->delete_network($network_id);
	     redirect('network');
	 }
	 public function add_more_email(){  ////// Adding more member using email id
		
	    $user_info=$this->network_model->get_user_information($this->session->userdata('site_user_id'));
	    $member_email=$this->input->post('member_email');
	    $network_name=$this->input->post('network_name');
	    $email_array=explode(",",$member_email);
	    $network_id=$this->input->post('network_id');
	    if($member_email != ''){
		foreach($email_array as $key=>$value)
		    {
			    $check_data=array(
				'network_id' => $network_id,
				'user_email' => $value
					      );
			    $get_existance=$this->common_model->get('network_member',array('*'),$check_data);
			    if(count($get_existance) == 0)
			    {
				$data_member_email=array(
					'network_id' => $network_id,
					'user_id' => 0,
					'user_email' => $value,
					'status' =>'Y'
					 );
				$add_member_res=$this->common_model->add('network_member',$data_member_email);
				if($add_member_res !=0)
				{
				    $data_to_store = array(
					    'id' => 3
					);
				    $site_details = $this->sitesetting_model->get_settings();
				    //$get_email_template = $this->common_model->get('email_template',array('*'),$data_to_store);
				    $system_mail = $site_details[0]['system_email'];
				    $mail =$value;
				    $email_content= $this->common_model->get('email_template',array('*'),$data_to_store);
				    $email_body = $email_content[0]['email_body'];
				    $search_val= array("[NETWORK]","[BYUSER]");
				    $replace_val   = array($network_name,$user_info[0]['name']);
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
				}
			    }
		    }
		    redirect('network');
	    }
	 }
	 
	public function add_member_to_other_network() //// ajax caLL for add more member pop-up in other network tab
	 {
		
		$network_id=$this->input->post('network_id');
		$data['total_member']=$this->network_model->get_network_member_details($network_id);
		$data['trainer_list']=$this->network_model->get_all_trainers();
		$where=array(
			'id' => $network_id
			 );
		$data['network_info']=$this->common_model->get('network',array('*'),$where);
		$this->load->view('add_more_other',$data);
	 }
	public function compose_new_message()  ///////// Composing new message 
	{
		$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		$where=array(
			'id' => $this->session->userdata('site_user_id')
			     );
		$data['user_details']= $this->common_model->get('user',array('*'),$where);
		$where_user=array(
			'user_id' => $this->session->userdata('site_user_id')
			     );
		$data['all_networks']= $this->common_model->get('network_member',array('*'),$where_user);
		$where_new=array(
			'created_by' => $this->session->userdata('site_user_id'),
			'type' => 'C',
			'status' => 'Y'
				 );
		$data['all_clients']= $this->common_model->get('user',array('*'),$where_new);
		$data['all_sender']=$this->network_model->get_all_msg_sender();
		$data['latest_sender']=$this->network_model->last_most_message_info();
		// load template
		$this->load->view('compose_message',$data);
		// load HTML footer file
		$this->load->view('footer');
		
		// load HTML footer file
		$this->load->view('HTML_footer');
	}
	
	public function network_member_delete()///Deleting member from a netowrk 
	{
		$row_id=$this->input->post('net_mem_id');
		$where=array(
			'id' => $row_id
			     );
		 $net_mem_info= $this->common_model->get('network_member',array('*'),$where);
		 $existing_info=$this->network_model->check_member_existance_to_other_network($net_mem_info[0]['network_id'],$net_mem_info[0]['user_id'],$this->session->userdata('site_user_id'));
                if(count($existing_info)==0){
		      $delete_share=$this->network_model->delete_shared_clients($net_mem_info[0]['user_id'],$this->session->userdata('site_user_id'));
		      $delete_share1=$this->network_model->delete_shared_clients($this->session->userdata('site_user_id'),$net_mem_info[0]['user_id']);
		 }
		 $member_trainers=$this->network_model->get_all_memebrs_of_network($net_mem_info[0]['network_id']);
		 if(count($member_trainers) > 0){
				foreach($member_trainers as $trainer){
					if($trainer['user_id'] != $net_mem_info[0]['user_id']){
							$net_res=$this->network_model->get_other_networks1($net_mem_info[0]['network_id'],$trainer['user_id']);
							if(count($net_res) > 0){
								foreach($net_res as $net){
								      
								     $exist_res= $this->network_model->network_member_existance($net_mem_info[0]['user_id'],$net['network_id']);
								     if(count($exist_res) == 0){
									 $delete_share_other=$this->network_model->delete_shared_clients($trainer['user_id'],$net_mem_info[0]['user_id']);
									 $delete_share_other1=$this->network_model->delete_shared_clients($net_mem_info[0]['user_id'],$trainer['user_id']);
								     }
								}
							}
							else
							{
							$delete_share_other=$this->network_model->delete_shared_clients($trainer['user_id'],$net_mem_info[0]['user_id']);
							$delete_share_other1=$this->network_model->delete_shared_clients($net_mem_info[0]['user_id'],$trainer['user_id']);
							
							}
						
		//				 $existing_info1=$this->network_model->check_member_existance_to_other_network($net_mem_info[0]['network_id'],$net_mem_info[0]['user_id'],$trainer['user_id']);
		//				  if(count($existing_info1)==0){
		//      $delete_share_other=$this->network_model->delete_shared_clients($net_mem_info[0]['user_id'],$trainer['user_id']);
		//      $delete_share1_other=$this->network_model->delete_shared_clients($trainer['user_id'],$net_mem_info[0]['user_id']);
		// }
					}
				}
			}
		 $del_res=$this->common_model->delete('network_member',$where);
		 redirect('network');
	}
	public function send_message(){ /////// Code for Sending message 
		if($this->input->server('REQUEST_METHOD') == 'POST')
	          {
			$sender_id=$this->input->post('sender_id');
			$receiver_id=$this->input->post('receiver_id');
			$receiver_arr=explode(",",$receiver_id);
			$message=$this->input->post('message_text');
			foreach($receiver_arr as $key=>$value)
			{
				$msg_to_store=array(
					'sent_to' => $value,
					'sent_by' => $sender_id,
					'message' => $message,
					'read_status' => 'N',
					'send_time' => date('Y-m-d H:i:s')
						    );
				$add_res=$this->common_model->add('messages',$msg_to_store);
			}
			 $this->session->set_flashdata('flash_message', 'message_sent');
		  }
		  redirect('compose-message');
	}
	
	///Using ajax Displaying list of messages on clicking over any username in compose-message Page
	public function get_dynamic_message_list(){
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		$sender_id=$this->input->post('user_id');
		$data['sender_id']=$sender_id;
		$this->load->view('message_list_div',$data);
	}
	
       /// Getting Sender List with search value without page refresh using AJAX CALL
       public function get_dynamic_sender_list()
       {
	//if(!$this->session->userdata('is_site_logged_in')){
	//		redirect('home');
	//	}
	  $search_text=$this->input->post('search_text');
	  if($search_text != '')
	  {
		$data['all_sender']=$this->network_model->get_all_msg_sender($search_text);
	  }
	  else{
		$data['all_sender']=$this->network_model->get_all_msg_sender();
	  }
	  $this->load->view('sender_list_div',$data);
       }

        public function send_message_to_user()
	{
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
	    	if($this->input->server('REQUEST_METHOD') == 'POST')
	          {
			$sender_id=$this->session->userdata('site_user_id');
			$receiver_id=$this->input->post('to_id');
			$message=$this->input->post('message');
			$msg_to_store=array(
				'sent_to' => $receiver_id,
				'sent_by' => $sender_id,
				'message' => $message,
				'read_status' => 'N',
				'send_time' => date('Y-m-d H:i:s')
					    );
			$add_res=$this->common_model->add('messages',$msg_to_store);
			$this->session->set_flashdata('flash_message', 'message_sent');
		  }
		  redirect('compose-message');
	}
	
	public function send_message_through_app()
	{
	     if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			$data_to_store = array(
				    'sent_to' => $this->input->get('sent_to'),
				    'sent_by' => $this->input->get('sent_by'),
				    'message' => $this->input->get('message'),
				    'read_status' => 'N',
				    'send_time' => date('Y-m-d H:i:s')
				);
			$add_res=$this->common_model->add('messages',$data_to_store);/////Inserting messages 
			
			$msg_where=array(
				'id' => $add_res
					 );
			$msg_info = $this->common_model->get('messages',array('*'),$msg_where);
			$where_sender=array(
				'id' => $msg_info[0]['sent_by']
					  );
			$sender_info= $this->common_model->get('user',array('*'),$where_sender);///Fetching sender information
			
			$where_receiver=array(
				'id' => $msg_info[0]['sent_to']
					  );
			$receiver_info= $this->common_model->get('user',array('*'),$where_receiver);///fetching receiver information
			$data['id'] =  $msg_info[0]['id'];
			$data['sender'] =  $sender_info[0]['name'];
			$data['receiver'] = $receiver_info[0]['name'];
			$data['sender_image'] =  base_url().'user_images/'.$sender_info[0]['image'];
			$data['receiver_image'] = base_url().'user_images/'.$receiver_info[0]['image'];
			$data['message'] =  $msg_info[0]['message'];
			$data['send_time'] = $msg_info[0]['send_time'];
			$data['status'] = $msg_info[0]['read_status'];
			
			echo $jsonhtml=json_encode($data);
		}
	}
	
        public function get_user_respective_messages()
	{
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			$user_id=$this->input->get('user_id');
			$logged_in_user=$this->input->get('logged_in_user');
			$latest_msg_list=$this->network_model->get_latest_user_messages_app($user_id,$logged_in_user);
			$data=array();
			foreach($latest_msg_list as $msg)
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
				$data['all_message'][]=$msg;
			}
			echo $jsonhtml=json_encode($data);
		}
	}
	
	public function get_sender_list_app()
	{
	   if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			$user_id=$this->input->get('logged_in_user');
			$all_sender=$this->network_model->get_all_msg_sender_app('',$user_id);
			$user_arr=array();
			foreach($all_sender as $sender)
			{
			    if($sender['sent_by']!=$user_id)
			    {
			      if(!in_array($sender['sent_by'], $user_arr))
			      {
				 array_push($user_arr,$sender['sent_by']);
			      }
			    }
			    if($sender['sent_to']!=$user_id)
			    {
			      if(!in_array($sender['sent_to'], $user_arr))
			      {
				 array_push($user_arr,$sender['sent_to']);
			      }
			    }
			}
			//print_r($user_arr);
			foreach($user_arr as $key=>$value)
			{
			    $user_info=$this->network_model->get_user_information($value);
			    $msg_last=$this->network_model->get_last_chat_app($value,$user_id);
			    $info['user_id']=$user_info[0]['id'];
			    $info['last_send_time']=$msg_last[0]['send_time'];
			    $info['user_name']=$user_info[0]['name'];
			    $info['user_image']=base_url().'user_images/'.$user_info[0]['image'];
			    $info['last_message']=$msg_last[0]['message'];
			    $data['all_user'][]=$info;
			}
			echo $jsonhtml=json_encode($data);
		}
	}
	
	public function get_left_panel()
	{
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		$search_text=$this->input->post('search_text');
		$data_to_store = array(
		'created_by' => $this->session->userdata('site_user_id'),
		'type' => 'C',
		'status' => 'Y'
		);
		if($search_text=='')
		{
		    $data['active_clients']=$this->common_model->get('user',array('*'),$data_to_store);
		}
		else
		{
		    $data['active_clients']=$this->common_model->get('user',array('*'),$data_to_store,$search_text,'name');	
		}
		$this->load->view('active_client',$data);
		echo "^^";
		$data_to_store_in = array(
                'created_by' => $this->session->userdata('site_user_id'),
                'type' => 'C',
                'status' => 'N'
                 );
		if($search_text=='')
		{
		    $data['inactive_clients']=$this->common_model->get('user',array('*'),$data_to_store_in);
		}
		else
		{
		    $data['inactive_clients']=$this->common_model->get('user',array('*'),$data_to_store_in,$search_text,'name');
		}
		
		$this->load->view('inactive_client',$data);
		echo "^^";
		if($search_text=='')
		{
		    $data['shared_clients']=$this->network_model->get_shared_clients();
		}
		else
		{
		    $data['shared_clients']=$this->network_model->get_shared_clients($search_text);
		}
		$this->load->view('shared_client',$data);
	}
	
	public function count_unread_messages()
	{
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		$data_msg = array(
			'sent_to' => $this->session->userdata('site_user_id'),
			'read_status' => 'N'
			  );
		$msg=$this->common_model->get('messages',array('*'),$data_msg);
		if(count($msg) > 0)
		{
			echo count($msg);
		}
	}
	
	public function get_unread_sender_list()
	{
		$data_msg = array(
			'sent_to' => $this->session->userdata('site_user_id'),
			'read_status' => 'N'
			  );
		$unread_message=$this->common_model->get('messages',array('*'),$data_msg);
		if(count($unread_message) > 0)
		{
                  $data['all_sender']=$this->network_model->get_all_msg_sender();
		  $this->load->view('sender_list_div',$data);
		}
		else
		{
		  echo "no_new_message";
		}
		
	}
	
	public function enter_message_from_client_profile_page(){ ///Ajax function while entering message from client-profile page
		
		 if ($this->input->server('REQUEST_METHOD') === 'POST')
		  {
			$sent_to=$this->input->post('sent_to');
			$message=$this->input->post('msg_text');
			$data_message=array(
				'sent_to' => $sent_to,
				'sent_by' => $this->session->userdata('site_user_id'),
				'message' => $message,
				'read_status' => 'N',
				'send_time' => date('Y-m-d H:i:s'),
					    );
			$last_inserted_msg = $this->common_model->add('messages',$data_message);
			if($last_inserted_msg != 0){
			$data_msg = array(
			       'id' => $last_inserted_msg
			      );
			$data['msg']=$this->common_model->get('messages',array('*'),$data_msg);
			    $this->load->view('single_message',$data);
			}
			else{
				echo "error";
			}
		  }
	}
	
	public function get_more_messages(){  ///Function for loading earlier messages
	          if ($this->input->server('REQUEST_METHOD') === 'POST')
		  {
			$user_id=$this->input->post('user_id');
			$start=$this->input->post('start');
			$per_load=$this->input->post('per_load');
			$data['all_messages']=$this->network_model->get_latest_user_chat($user_id,$per_load,$start);
			$this->load->view('get_message_list',$data);
		  }
	}
	public function get_settings_pop(){  ///Function for loading earlier messages
	          if ($this->input->server('REQUEST_METHOD') === 'POST')
		  {
			$user_id=$this->input->post('trainer_id');
			$data_msg = array(
			       'trainer_id' => $user_id
			      );
			$data['trainer_avail_time']=$this->common_model->get('trainer_avail_time',array('*'),$data_msg,null,null,null,null,null,null,'id','ASC');
			$data_msg = array(
			       'trainer_id' => $user_id
			      );
			$data['trainer_settings']=$this->common_model->get('trainer_settings',array('*'),$data_msg);
			$this->load->view('get_trainer_settings',$data);
		  }
	}
	public function get_more_time(){  ///
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		  {
			$count_time=$this->input->post('count_time');
			//$this->load->view('get_more_time');
			 ?>
				<div class="add_row">
					<div class="add_cols">
						Available
					</div>
					<div class="add_cols">
						<span class="hour_input">
						    <select name="avl_time_from[]" id="from<?php echo $count_time;?>">
							<?php
							    for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
							    {
								for($mins=0; $mins<60; $mins+=60) // the interval for mins is '30'
								{
								     echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
									   .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
								}
							   
							    }
							
							    ?>
						    </select>
						</span> <span>hrs</span>
					</div>
					<div class="add_cols">
						to
					</div>
					<div class="add_cols">
						<span class="hour_input">
						     <select name="avl_time_to[]" id="to<?php echo $count_time;?>">
							<?php
							    for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
							    {
								for($mins=0; $mins<60; $mins+=60) // the interval for mins is '30'
								{
								     echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
									   .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
								}
							   
							    }
							
							    ?>
						    </select>
						</span> <span>hrs</span>
						<input type="hidden" name="existing_time_arr[]" id="existing_time_arr" value="new">
					</div>
					<div class="add_cols">
						<a href="javascript:void(0)" onclick="remove_time(this)"><span><img src="<?php echo base_url(); ?>assets/site/after_login/images/close_icon.png" alt="" /></span><span>Remove</span></a>
					</div>
					
				</div>
				<?php
		  }
	}
	
	public function add_settings(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		  {
			$available_time_from=$this->input->post('avl_time_from');
			$available_time_to=$this->input->post('avl_time_to');
			$repeat_status=$this->input->post('repeat_status');
			echo $end_date_val = $this->input->post('repeat_upto_date');
			
			$trainer_id= $this->session->userdata('site_user_id');
			$existing_time_arr=$this->input->post('existing_time_arr');
			if($repeat_status=='EXD'){
			 $every_x_day=$this->input->post('every_x_day');
			}
			else
			{
			 $every_x_day='';
			}
			if($repeat_status=='EW'){
			 $every_weak_val=$this->input->post('every_week');
			}
			else
			{
			 $every_weak_val='';
			}
			$data_msg = array(
			       'trainer_id' => $trainer_id
			      );
			$trainer_settings=$this->common_model->get('trainer_settings',array('*'),$data_msg);
			if(count($trainer_settings) > 0)
			{
				$where_time=array(
					 'trainer_id' => $trainer_id
						  );
				$data_to_store=array(
				'repeat_status' => $repeat_status,
				'every_x_day' => $every_x_day,
				'every_week' => $every_weak_val,
				'repeat_upto_date' => date("Y-m-d",strtotime($end_date_val))
					     );
				$update_res=$this->common_model->update('trainer_settings',$data_to_store,$where_time);
			}
			else{
				$data_to_store=array(
				'trainer_id' => $trainer_id,
				'repeat_status' => $repeat_status,
				'every_x_day' => $every_x_day,
				'every_week' => $every_weak_val,
				'repeat_upto_date' => date("Y-m-d",strtotime($end_date_val))
					     );
				$add_setting=$this->common_model->add('trainer_settings',$data_to_store);
			}
			
			for($i=0;$i<count($available_time_from);$i++){
			if ($existing_time_arr[$i] != 'new')
			{
				$where_time_id=array(
					'id' => $existing_time_arr[$i]
						     );
				$data_available=array(
				'trainer_id' => $trainer_id,
				'avl_time_from' => $available_time_from[$i],
				'avl_time_to' => $available_time_to[$i]
						    );
				$update_available=$this->common_model->update('trainer_avail_time',$data_available,$where_time_id);
			}
			else if($existing_time_arr[$i] == 'new'){
			      $data_available=array(
				'trainer_id' => $trainer_id,
				'avl_time_from' => $available_time_from[$i],
				'avl_time_to' => $available_time_to[$i]
						    );
			     $add_available=$this->common_model->add('trainer_avail_time',$data_available);
			}
			}
			
			if($repeat_status == 'D')
			{
				$date_start = date("Y-m-d");
				// End date
				 $end_date = date("Y-m-d",strtotime($end_date_val));
			
				while (strtotime($date_start) <= strtotime($end_date)) {
					
					$date_exits = array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $date_start
					       );
					 $trainer_date_exists=$this->common_model->get('trainer_avl_time_repeat_val',array('*'),$date_exits);
					 if(count($trainer_date_exists) == 0)
					 {
						$data_available=array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $date_start
								    );
						//print_r($data_available);
					     $add_repeat=$this->common_model->add('trainer_avl_time_repeat_val',$data_available);
					 }
					
					$date_start = date ("Y-m-d", strtotime("+1 day", strtotime($date_start)));
				      
				}
				
			}
			if($repeat_status == 'EXD')
			{
				$date_exits_avl = array(
					'trainer_id' => $trainer_id,
					'repeat_date >' => date("Y-m-d")
				       );
				 $trainer_date_exists_avl=$this->common_model->get('trainer_avl_time_repeat_val',array('*'),$date_exits_avl);
				 $avl_date_prev = array();
				 foreach($trainer_date_exists_avl as $date_avl)
				 {
					$avl_date_prev[] = $date_avl['repeat_date'];
				 }
				$repeat_val = $this->input->post('every_x_day');
				$date = date("Y-m-d");
				// End date
				$end_date = date("Y-m-d",strtotime($end_date_val));
				$date_exits_book = array(
					'trainer_id' => $trainer_id,
					'booked_date >' =>$date
				       );
				$trainer_date_exists=$this->common_model->get('user_booking',array('*'),$date_exits_book,null,null,null,null,'booked_date');
				$date_booking = array();
				foreach($trainer_date_exists as $date_val_exits)
				{
					$date_booking[] = $date_val_exits['booked_date'];
				}
				
				
				while (strtotime($date) <= strtotime($end_date)) {
					$date_exits = array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $date
					       );
					 $trainer_date_exists=$this->common_model->get('trainer_avl_time_repeat_val',array('*'),$date_exits);
					 if(count($trainer_date_exists) == 0)
					 {
						$data_available=array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $date
								    );
					     $add_repeat=$this->common_model->add('trainer_avl_time_repeat_val',$data_available);
					 }
					 if($date != date("Y-m-d"))
					 {
						$date_new[] = $date;
					 }
					
					$repeat_val_day = $repeat_val - 1;
					$date = date ("Y-m-d", strtotime("+".$repeat_val_day." days", strtotime($date)));
				}
				
				$diff_val = array_diff($date_booking,$date_new);
				
				$diff_val_avl_date = array_diff($avl_date_prev,$date_new);
				
				foreach($diff_val as $del_row)
				{
					$del_val_arr = array(
						'trainer_id' => $trainer_id,
						'booked_date' => $del_row
					       );
					$trainer_all_booking=$this->common_model->get('user_booking',array('*'),$del_val_arr,null,null,null,null,'client_id');
					
					foreach($trainer_all_booking as $del_client)
					{
						$time_start = date("h:i a",strtotime($del_client['booking_time_start']));
						$time_end = date("h:i a",strtotime($del_client['booking_time_end']));
						
						$trainer_detail_arr = array(
						'id' => $trainer_id
					       );
						$trainer_details = $this->common_model->get('user',array('*'),$trainer_detail_arr);
						$trainer_name = $trainer_details[0]['name'];
						if($trainer_name == '')
						{
							$trainer_name = $trainer_details[0]['email'];
						}
						
						$client_detail_arr = array(
						'id' => $del_client['client_id']
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
						
					}
					$del_val_arr = array(
						'trainer_id' => $trainer_id,
						'booked_date' => $del_row
					       );
					$del_booking=$this->common_model->delete('user_booking',$del_val_arr);
					
				}
				foreach($diff_val_avl_date as $avl_prev)
				{
					$del_val_avl = array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $avl_prev
					       );
					$del_booking_avl=$this->common_model->delete('trainer_avl_time_repeat_val',$del_val_avl);
				}
			}
			
			if($repeat_status == 'EW')
			{
				
				$date_exits_avl = array(
					'trainer_id' => $trainer_id,
					'repeat_date >' => date("Y-m-d")
				       );
				 $trainer_date_exists_avl=$this->common_model->get('trainer_avl_time_repeat_val',array('*'),$date_exits_avl);
				 $avl_date_prev = array();
				 foreach($trainer_date_exists_avl as $date_avl)
				 {
					$avl_date_prev[] = $date_avl['repeat_date'];
				 }
				$date = date("Y-m-d");
				// End date
				$end_date = date("Y-m-d",strtotime($end_date_val));
				$date_exits_book = array(
					'trainer_id' => $trainer_id,
					'booked_date >' =>$date
				       );
				$trainer_date_exists=$this->common_model->get('user_booking',array('*'),$date_exits_book,null,null,null,null,'booked_date');
				$date_booking = array();
				foreach($trainer_date_exists as $date_val_exits)
				{
					$date_booking[] = $date_val_exits['booked_date'];
				}
					
				while (strtotime($date) <= strtotime($end_date)) {
					$i = $this->input->post('every_week');
					$ts = strtotime($date);
					// Find the year and the current week
					$year = date('o', $ts);
					$week = date('W', $ts);
					$ts = strtotime($year.'W'.$week.$i);
					$date = date("Y-m-d", $ts);
					
					$date_exits = array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $date
					       );
					 $trainer_date_exists=$this->common_model->get('trainer_avl_time_repeat',array('*'),$date_exits);
					 if(count($trainer_date_exists) == 0)
					 {
						$data_available=array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $date
								    );
					     $add_repeat=$this->common_model->add('trainer_avl_time_repeat',$data_available);
					 }
					 if($date != date("Y-m-d"))
					 {
						$date_new[] = $date;
					 }
					
					
					$date = date ("Y-m-d", strtotime("+1 week", strtotime($date)));
				}
				
				$diff_val = array_diff($date_booking,$date_new);
				$diff_val_avl_date = array_diff($avl_date_prev,$date_new);
				foreach($diff_val as $del_row)
				{
					$del_val_arr = array(
						'trainer_id' => $trainer_id,
						'booked_date' => $del_row
					       );
					$trainer_all_booking=$this->common_model->get('user_booking',array('*'),$del_val_arr,null,null,null,null,'client_id');
					foreach($trainer_all_booking as $del_client)
					{
						$time_start = date("h:i a",strtotime($del_client['booking_time_start']));
						$time_end = date("h:i a",strtotime($del_client['booking_time_end']));
						
						$trainer_detail_arr = array(
						'id' => $trainer_id
					       );
						$trainer_details = $this->common_model->get('user',array('*'),$trainer_detail_arr);
						$trainer_name = $trainer_details[0]['name'];
						if($trainer_name == '')
						{
							$trainer_name = $trainer_details[0]['email'];
						}
						
						$client_detail_arr = array(
						'id' => $del_client['client_id']
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
						
					}
					$del_val_arr = array(
						'trainer_id' => $trainer_id,
						'booked_date' => $del_row
					       );
					$del_booking=$this->common_model->delete('user_booking',$del_val_arr);
				}
				foreach($diff_val_avl_date as $avl_prev)
				{
					$del_val_avl = array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $avl_prev
					       );
					$del_booking_avl=$this->common_model->delete('trainer_avl_time_repeat_val',$del_val_avl);
				}
			}
			if($repeat_status == 'EM')
			{
				
				$date_exits_avl = array(
					'trainer_id' => $trainer_id,
					'repeat_date >' => date("Y-m-d")
				       );
				 $trainer_date_exists_avl=$this->common_model->get('trainer_avl_time_repeat_val',array('*'),$date_exits_avl);
				 $avl_date_prev = array();
				 foreach($trainer_date_exists_avl as $date_avl)
				 {
					$avl_date_prev[] = $date_avl['repeat_date'];
				 }
				$date = date("Y-m-d");
				// End date
				$end_date = date("Y-m-d",strtotime($end_date_val));
				
				$date_exits_book = array(
					'trainer_id' => $trainer_id,
					'booked_date >' =>$date
				       );
				$trainer_date_exists=$this->common_model->get('user_booking',array('*'),$date_exits_book,null,null,null,null,'booked_date');
				$date_booking = array();
				foreach($trainer_date_exists as $date_val_exits)
				{
					$date_booking[] = $date_val_exits['booked_date'];
				}
				
				while (strtotime($date) <= strtotime($end_date)) {
					
					$date_exits = array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $date
					       );
					 $trainer_date_exists=$this->common_model->get('trainer_avl_time_repeat',array('*'),$date_exits);
					 if(count($trainer_date_exists) == 0)
					 {
						$data_available=array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $date
								    );
					     $add_repeat=$this->common_model->add('trainer_avl_time_repeat',$data_available);
					 }
					 if($date != date("Y-m-d"))
					 {
						$date_new[] = $date;
					 }
					
					
					
					$date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
				}
				$diff_val = array_diff($date_booking,$date_new);
				$diff_val_avl_date = array_diff($avl_date_prev,$date_new);
				foreach($diff_val as $del_row)
				{
					$del_val_arr = array(
						'trainer_id' => $trainer_id,
						'booked_date' => $del_row
					       );
					$trainer_all_booking=$this->common_model->get('user_booking',array('*'),$del_val_arr,null,null,null,null,'client_id');
					foreach($trainer_all_booking as $del_client)
					{
						$time_start = date("h:i a",strtotime($del_client['booking_time_start']));
						$time_end = date("h:i a",strtotime($del_client['booking_time_end']));
						
						$trainer_detail_arr = array(
						'id' => $trainer_id
					       );
						$trainer_details = $this->common_model->get('user',array('*'),$trainer_detail_arr);
						$trainer_name = $trainer_details[0]['name'];
						if($trainer_name == '')
						{
							$trainer_name = $trainer_details[0]['email'];
						}
						
						$client_detail_arr = array(
						'id' => $del_client['client_id']
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
						
					}
					$del_val_arr = array(
						'trainer_id' => $trainer_id,
						'booked_date' => $del_row
					       );
					$del_booking=$this->common_model->delete('user_booking',$del_val_arr);
				}
				foreach($diff_val_avl_date as $avl_prev)
				{
					$del_val_avl = array(
						'trainer_id' => $trainer_id,
						'repeat_date' => $avl_prev
					       );
					$del_booking_avl=$this->common_model->delete('trainer_avl_time_repeat_val',$del_val_avl);
				}
			}
			
			
			
		  }
		redirect('dashboard');
	}
	
	public function remove_time(){
	
		$field_id=$this->input->post('field_id');
		$where=array(
			'id' => $field_id
			     );
		$del_res=$this->common_model->delete('trainer_avail_time',$where);
		if($del_res)
		{
			echo "deleted";
		}
		else{
			echo "not_deleted";
		}
	
	}
	
	public function get_client_more_messages(){
	
	    if ($this->input->server('REQUEST_METHOD') === 'POST')
		  {
			$user_id=$this->input->post('user_id');
			$start=$this->input->post('start');
			$per_load=$this->input->post('per_load');
			$data['sender_info']=$this->network_model->get_user_information($user_id);
			$data['all_messages']=$this->network_model->get_latest_user_chat($user_id,$per_load,$start);
			$this->load->view('get_client_more_message',$data);
		  }
	}
	public function cancel_booking(){
	
	    if (($this->input->server('REQUEST_METHOD') === 'POST') && ($this->input->post('mode') =='booking_cancel'))
		  {
			 $booking_id = $this->input->post('booking_id');
			
			$del_val_arr = array(
				'id' => $booking_id
			       );
			$trainer_all_booking=$this->common_model->get('user_booking',array('*'),$del_val_arr);
			
			$time_start = date("h:i a",strtotime($trainer_all_booking[0]['booking_time_start']));
			$time_end = date("h:i a",strtotime($trainer_all_booking[0]['booking_time_end']));
			$del_row= $trainer_all_booking[0]['booked_date'];
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
			if($del_booking){
				//$notification="Appointment with ".$client_details[0]['name']." on ".date("jS, F Y",strtotime($trainer_all_booking[0]['booked_date']))." from ".$time_start." to ".$time_end." has been cancelled.";
				  $notification="Cancelled 1 Appointment";
				  $data_notification=array(
					'user_id' =>$trainer_all_booking[0]['trainer_id'],
					'client_id' =>$client_details[0]['id'],
					'notification' =>$notification,
					'notification_time' => date('Y-m-d H:i:s')
							   );
				  $add_notification=$this->common_model->add('notifications',$data_notification);
			}
			  redirect('dashboard');
		  }
	}
	
	public function get_edit_popup(){
		$booking_id=$this->input->post('booking_id');
		$trainer_id=$this->input->post('trainer_id');
		 $date_val = $this->input->post('current_date');
		 $hourval =  $this->input->post('hourval');
		 $data['trainer_id'] = $trainer_id;
		 $data['date_val'] = date("Y-m-d",strtotime($date_val));
		 $data['hour_val'] = $hourval;
		$data['booking_id']=$booking_id;
		$this->load->view('get_appointment_popup_edit',$data);
	}
	
	public function edit_booking(){
		if(($this->input->server('REQUEST_METHOD') == 'POST') && ($this->input->post('mode') == 'edit_appointment'))
		{
			$booking_id = $this->input->post('booking_id');
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
				$trainer = $this->input->post('current_trainer');
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
			$where_val = array(
				'id'=>$booking_id
				
			);
				
			$insert_new_val_exer_cus=$this->common_model->update('user_booking',$data_exer_insrt_cus,$where_val);
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
				  
				  
				
				
				$this->session->set_flashdata("flash_message",'app_changed');
				redirect("dashboard");
			}
		}
	}
	public function get_new_book_appointment(){
		$trainer_id=$this->input->post('trainer_id');
		 $date_val = $this->input->post('current_date');
		 $data['trainer_id'] = $trainer_id;
		 $data['date_val'] = date("Y-m-d",strtotime($date_val));
		$this->load->view('add_new_appointment',$data);
	}
	
	public function get_avl_trainers(){
		
		 $date_val = $this->input->post('date_val');
		 $where_main_prg_name=array(
		'repeat_date' => date("Y-m-d",strtotime($date_val))
		     );
		$avl_trainer_list = $this->common_model->get('trainer_avl_time_repeat_val',array('*'),$where_main_prg_name);
	         if(count($avl_trainer_list) > 0)
		 {
			?>
			<option value="">none</option>
			<?php
			foreach($avl_trainer_list as $each_mem)
			{
			    $where_mem_det=array(
			    'id' => $each_mem['trainer_id'],
			    'status' => 'Y',
			    'deleted_status'=>'N'
				 );
			    $get_member_detail = $this->common_model->get('user',array('*'),$where_mem_det);
			    if($get_member_detail[0]['name'] == '')
			    {
				$name = $get_member_detail[0]['email'];
			    }
			    else{
				 $name = $get_member_detail[0]['name'];
			    }
			    
			    ?>
			    <option value="<?php echo $each_mem['trainer_id']; ?>"><?php echo $name; ?></option>
			    <?php
			}
		 }
	}
	
	public function get_more_notifications(){
		
		 if ($this->input->server('REQUEST_METHOD') === 'POST')
		  {
			$start=$this->input->post('start');
			$per_load=$this->input->post('per_load');
			$where_noti=array(
	                       'user_id' => $this->session->userdata('site_user_id')
		        );
			$data['all_notification']=$this->network_model->get_latest_notifications($per_load,$start);
			$this->load->view('get_notification_list',$data);
		  }
	}
	
}
?>