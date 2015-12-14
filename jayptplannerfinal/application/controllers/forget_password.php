<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forget_password extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // loading models
        
        $this->load->model('sitesetting_model');
	$this->load->model('mod_user');
        // loading library
        $this->load->library('form_validation');
    
    }
    public function index()
    {
	if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
	    $email = $this->input->post('email');
	    
	    // for generating unique code
	    $user_info = $this->mod_user->get_user_by_email($email);
	    
	    //echo '<pre>';
	    //print_r($user_info);
	    //exit;
	    
	    if(count($user_info))
	    {
		$id = $user_info[0]['id'];
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$random_string_length =8;
		$unique_id = 'TG';
		for ($i = 0; $i < $random_string_length; $i++) {
		     $unique_id .= $characters[rand(0, strlen($characters) - 1)];
		}
		$unique_id.=$id;
		$name = $user_info[0]['email'];
		//print_r($user_info);
		//exit;
		$data_to_store['forget_id'] = $unique_id;
		if($this->mod_user->update_user_details_by_email($email,$data_to_store) == TRUE){
		    //send mail
		    $site_details = $this->sitesetting_model->get_settings();
		    $system_mail = $site_details[0]['system_email'];
		    $mail=$email;
		    $url=$this->config->item('base_url')."home/".$unique_id;
		    $message=
		    "<html>
			    <head>
			    <title>Forget Password</title>
			    </head>
			    
			    <body>
			    
			    <table cellspacing=\"4\" cellpadding=\"4\" border=\"0\" align=\"left\">
			    
			    <tr>
			    <td colspan=\"2\">Hello $name, </td>
			    </tr>
			    <tr><td></td></tr>
			    <tr>
			    <td colspan=\"2\">Please click on the link to reset your password. </td>
			    </tr>
			    <tr>
			    <td colspan=\"2\"> $url</td>
			    </tr>
			    <tr>
    
			    <tr><td></td></tr>
			    
			    <td>Email Id:- </td>
			    <td>$mail</td>
			    </tr>
			    <tr><td></td></tr>
			    <tr><td></td></tr>
			    
			    <tr>
			    <td colspan=\"2\">Thanks & Regards.<br>PT-Planner Team</td>
			    </tr>
			    <tr>
			    <td colspan=\"2\">Please do not reply to this message. It was sent from an unmonitored email address.</td>
			    </tr>
			    </table>
			    </body>
		    </html>";
    
		    $this->load->library('email');
	
		    $config['protocol'] = 'sendmail';
		    $config['charset'] = 'utf-8';
		    $config['wordwrap'] = TRUE;
		    $config['mailtype'] = 'html';
		    
		    $this->email->initialize($config);
	
		    $this->email->from($system_mail,'PT-Planner');
		    $this->email->to($mail);
		    
		    $this->email->subject('Forget Password Mail');
		    $this->email->message($message);	
		    
		    $result = $this->email->send();
		    //mail
		    if($result){
			//$this->session->set_flashdata('flash_message','forget_mail_send');
			echo 'forget_mail_send';
		    }
		    else{
			//$this->session->set_flashdata('flash_message','forget_mail_not_send');
			echo 'forget_mail_not_send';
		    }
		}
	    }
	    else{
		//$this->session->set_flashdata('flash_message','forget_mail_not_send');
		echo 'user_not_exist';
	    }
	    
	}
	exit;
    }
    
    
    public function reset_password()
    {
	
	if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
	    $code = $this->input->post('code');
	    $password = $this->input->post('password');
	    
	    // for generating unique code
	    $user_info = $this->mod_user->get_user_by_forget_code($code);
	    
	    if(count($user_info))
	    {
		$name = $user_info[0]['email'];
		$email = $user_info[0]['email'];
		$data_to_store['password'] = md5($password);
		$data_to_store['forget_id'] = '';
		if($this->mod_user->update_user_details_by_email($email,$data_to_store) == TRUE)
		{
		    //send mail
		    $site_details = $this->sitesetting_model->get_settings();
		    $system_mail = $site_details[0]['system_email'];
		    $mail=$email;
		    $message=
		    "<html>
			    <head>
			    <title>Reset Password</title>
			    </head>
			    
			    <body>
			    
			    <table cellspacing=\"4\" cellpadding=\"4\" border=\"0\" align=\"left\">
			    
			    <tr>
			    <td colspan=\"2\">Hello $name, </td>
			    </tr>
			    <tr><td></td></tr>
			    <tr>
			    <td colspan=\"2\">Your password has successfully changed. Details of your account given bellow. </td>
			    </tr>
			    
			    <tr><td></td></tr>
			    
			    <td>Email:- </td>
			    <td>$mail</td>
			    </tr>
			    <tr>
			    <td>Password:- </td>
			    <td>$password</td>
			    </tr>
			    <tr>
			    
			    <tr><td></td></tr>
			    <tr><td></td></tr>
			    
			    <tr>
			    <td colspan=\"2\">Thanks & Regards.<br>PT-Planner</td>
			    </tr>
			    <tr>
			    <td colspan=\"2\">Please do not reply to this message. It was sent from an unmonitored email address.</td>
			    </tr>
			    </table>
			    </body>
		    </html>";
    
		    $this->load->library('email');
	
		    $config['protocol'] = 'sendmail';
		    $config['charset'] = 'utf-8';
		    $config['wordwrap'] = TRUE;
		    $config['mailtype'] = 'html';
		    
		    $this->email->initialize($config);
	
		    $this->email->from($system_mail,'PT-Planner');
		    $this->email->to($mail);
		    
		    $this->email->subject('Reset Password Mail');
		    $this->email->message($message);	
		    
		    $result = $this->email->send();
		    //mail
		    
		    if($result){
			$this->session->set_flashdata('flash_message','password_reset_sucess');
			//echo 'password_reset_sucess';
		    }
		//    else{
		//	$this->session->set_flashdata('flash_message','password_reset_failed');
		//	echo 'password_reset_failed';
		//    }
		}
		else{
		    $this->session->set_flashdata('flash_message','password_reset_failed');
		    //echo 'password_reset_failed';
		}
	    }
	    else
	    {
		$this->session->set_flashdata('flash_message','wrong_link');
		//echo 'wrong_link';
	    }
	}
	//redirect('');
	exit;
    }


}
?>