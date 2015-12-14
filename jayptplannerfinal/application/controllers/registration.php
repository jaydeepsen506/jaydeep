<?php
class Registration extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// load models
		$this->load->model('sitesetting_model');
		$this->load->model('mod_user');
		$this->load->model('common_model');
		
		// load libraries
		$this->load->library('email');
	}
	function index()
	{
		redirect('home');
	}
	public function add()
	{
		     
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
			
			
			if ($this->form_validation->run())
			{
				$d['email'] = $this->input->post('email');
				$verify_email = $this->mod_user->email_verify($d);
				if($verify_email)
				{
					$this->session->set_flashdata('flash_message','user_exist'); 
					
					redirect('home');
				}
				else
				{
					$code=sha1(mt_rand(10000,99999).time());
					//$user = $this->mod_user->get_user_list();
					//foreach($user as $row){
					//    $id = $row['id'];
					//}
					//$id++;
					//$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnop0123456789';
					//$random_string_length =6;
					//$unique_id = '';
					//for ($i = 0; $i < $random_string_length; $i++) {
					//     $unique_id .= $characters[rand(0, strlen($characters) - 1)];
					//}
					//$unique_id .= $id;
					//$pass = $unique_id;
					$date = date('Y-m-d');
					 $expiry_date = date('Y-m-d',strtotime('+2 months'));
					
					$pass = $this->input->post('password');
					$data_to_store = array(
					    'email' => trim($this->input->post('email')),
					    'password' => md5($pass),
					    'activation_code' => $code,
					    'created_date' => date('Y-m-d'),
					    'expiry_date' =>$expiry_date
					);
					
					//print_r($data_to_store);
					//exit;
					$name = $data_to_store['email'];
					if($inserted_id = $this->common_model->add('user',$data_to_store))
					{
						//send mail
						$site_details = $this->sitesetting_model->get_settings();
						$system_mail = $site_details[0]['system_email'];
						$mail=$this->input->post('email');
						
						$url=$this->config->item('base_url')."registration/active_account/".$code;
						
						$title = "Successfully Registered";
						$content =
						    '<title>Successfully Registered</title>
						    <table align="\" border="0" cellpadding="\" cellspacing="\">
							    <tbody>
								    <tr>
									    <td colspan="\2">Hello {USERNAME} ,</td>
								    </tr>
								    <tr>
									    <td>&nbsp;</td>
								    </tr>
								    <tr>
									    <td colspan="\2">You have successfully registered in our site. Your details given bellow.</td>
								    </tr>
								    <tr>
									    <td>Email Id:- {EMAIL}</td>
								    </tr>
								    <tr>
									    <td>Password:- {PASSWORD}</td>
								    </tr>
								    <tr>
									    <td>&nbsp;</td>
								    </tr>
								    <tr>
									    <td>Please click on the following links to active your account.</td>
								    </tr>
								    <tr>
									    <td>{LINK}</td>
								    </tr>
								    <tr>
									    <td>&nbsp;</td>
								    </tr>
								    <tr>
									    <td>&nbsp;</td>
								    </tr>
								    <tr>
									    <td colspan="\2">Thanks &amp; Regards.<br />
									    PT-Planner Team</td>
								    </tr>
								    <tr>
									    <td colspan="\2">Please do not reply to this message. It was sent from an unmonitored email address.</td>
								    </tr>
							    </tbody>
						    </table>';
						$replace=array('{USERNAME}','{PASSWORD}','{EMAIL}','{LINK}');
						$replace_with=array($name,$pass,$mail,$url);
						$output=str_replace($replace,$replace_with,$content);
						$message= $output;
						
		    
			
						
				    
						$config['protocol'] = 'sendmail';
						$config['charset'] = 'utf-8';
						$config['wordwrap'] = TRUE;
						$config['mailtype'] = 'html';
						
						$this->email->initialize($config);
				    
						$this->email->from($system_mail,'PT-Planner');
						$this->email->to($mail);
						
						$this->email->subject($title);
						$this->email->message($message);	
						
						$this->email->send();
						//mail
						
						$this->session->set_flashdata('flash_message','user_add');
							
						redirect('home');
					}
					else{
					    
						$this->session->set_flashdata('flash_message','user_not_add'); 
						    
						redirect('home');
					}
				}
			}
			else
			{			
				$this->session->set_flashdata('flash_message','user_not_add');
				
				redirect('home');
			}
		}
		else
		{			
			$this->session->set_flashdata('flash_message','user_not_add');
			
			redirect('home');
		}
	}
	
	public function active_account()
	{
		$activation_code = $this->uri->segment(3);
		$details = $this->mod_user->get_user('activation_code',$activation_code);
		if(count($details))
		{
			$previous_status = $details[0]['status'];
			if($previous_status == 'N')
			{
				$user_id = $details[0]['id'];
				$data_to_store['status'] = 'Y';
				$data_to_store['activation_code'] = '';
				$result = $this->mod_user->update_user_details($user_id,$data_to_store);
				if($result)
				{
				    
				    $site_details = $this->sitesetting_model->get_settings();
				    $system_mail = $site_details[0]['system_email'];
				    
				    $mail = $details[0]['email'];
				    $name = $mail;
				    
				    //send mail
				    $title = 'Account Activeted';
				    $content =
					'<title></title>
					<table align="\" border="0" cellpadding="\" cellspacing="\">
						<tbody>
							<tr>
								<td colspan="\2">Hello {USERNAME} ,</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="\2">You account has successfully activated in our site. Your details given bellow.</td>
							</tr>
							<tr>
								<td>Email Id:- {EMAIL}</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="\2">Thanks &amp; Regards.<br />
								PT-Planner Team</td>
							</tr>
							<tr>
								<td colspan="\2">Please do not reply to this message. It was sent from an unmonitored email address.</td>
							</tr>
						</tbody>
					</table>
					';
				    $replace=array('{USERNAME}','{EMAIL}');
				    $replace_with=array($name,$mail);
				    $output=str_replace($replace,$replace_with,$content);
				    $message= $output;
		    
		    
				    $this->load->library('email');
			
				    $config['protocol'] = 'sendmail';
				    $config['charset'] = 'utf-8';
				    $config['wordwrap'] = TRUE;
				    $config['mailtype'] = 'html';
				    
				    $this->email->initialize($config);
			
				    $this->email->from($system_mail,'PT-Planner');
				    $this->email->to($mail);
				    
				    $this->email->subject($title);
				    $this->email->message($message);	
				    
				    $this->email->send();
				    //mail
				    
				    $this->session->set_flashdata('flash_message','user_active'); 
				}
				else{
				    $this->session->set_flashdata('flash_message','user_block'); 
				}
			}
			else
			{
				$this->session->set_flashdata('flash_message','user_already_active'); 
			}
		}
		else
		{
			$this->session->set_flashdata('flash_message','user_already_active'); 
		}
		redirect('home');
	    }
	    
	    function send_mail(){
		$data_to_store = array(
					'id' => 8
				    );
		$site_details = $this->sitesetting_model->get_settings();
		$system_mail = $site_details[0]['system_email'];
		
	        $get_before_1month=$this->common_model->get_before_1month();
		//print_r($get_before_1month);
		foreach($get_before_1month as $end_expiry)
		{
			 $mail = $end_expiry['email'];
			$email_content= $this->common_model->get('email_template',array('*'),$data_to_store);
			 $email_body = $email_content[0]['email_body'];
			
			$message=$email_body;
			
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
	function send_mail_expiry(){
		$data_to_store = array(
					'id' => 9
				    );
		$site_details = $this->sitesetting_model->get_settings();
		$system_mail = $site_details[0]['system_email'];
		
	        $get_before_1month=$this->common_model->get_on_expire();
		//print_r($get_before_1month);
		foreach($get_before_1month as $end_expiry)
		{
			if($end_expiry['name'] != '')
			{
				$trainer_name = $end_expiry['name'];
			}
			else{
				$trainer_name = $end_expiry['email'];
			}
			 $trainer_name;
			 $link = base_url()."control/managetrainer/edit/".$end_expiry['id'];
			$email_content= $this->common_model->get('email_template',array('*'),$data_to_store);
			$email_body = $email_content[0]['email_body'];
			$search_val= array("[LINK]","[TRAINER]");
			$replace_val   = array($link,$trainer_name);
			$newbody = str_replace($search_val, $replace_val, $email_body);
			 $message=$newbody;
			
			$this->load->library('email');
			     
			  $config['protocol'] = 'sendmail';
			  $config['charset'] = 'utf-8';
			  $config['wordwrap'] = TRUE;
			  $config['mailtype'] = 'html';
			  
			  $this->email->initialize($config);
			     
			  $this->email->from($system_mail,$site_details[0]['site_name']);
			  $this->email->to($system_mail);
			  
			  $this->email->subject($email_content[0]['subject']);
			  $this->email->message($message);	
			  
			  $this->email->send();		
		}
	}

}
?>