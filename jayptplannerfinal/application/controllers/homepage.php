<?php
class Homepage extends CI_Controller {

    const VIEW_FOLDER = 'admin/homepage';
 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
	//$this->load->model('sitesetting_model');
	$this->load->helper(array('html','form','url'));
	$this->load->database();
	$this->load->library('form_validation');
		
}
 
  
    public function index()
        {
	    $page = $this->uri->segment(3);
	   $data['all_data']=$this->home_model->find();
	    $data['view_link'] = 'admin/homepage/list';
	    $this->load->view('includes/template', $data);
	    
        }

    public function add()
    {

	if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

                //$title_alias = str_replace(" ","-",$this->input->post('page_title'));
		//$title_alias = strtolower($title_alias);
                $data_to_store = array(
                    'app_booking_text' => $this->input->post('app_booking_text'),
		    'app_trainaway_text' => $this->input->post('app_trainaway_text'),
		    'app_diets_text' => $this->input->post('app_diets_text'),
		    'diary_text' => $this->input->post('diary_text'),
		    'program_text' => $this->input->post('program_text'),
		    'messages_text' => $this->input->post('messages_text'),
		    'app_booking_content' => $this->input->post('app_booking_content'),
		    'app_trainaway_content' => $this->input->post('app_trainaway_content'),
		    'app_diets_content' => $this->input->post('app_diets_content'),
		    'diary_content' => $this->input->post('diary_content'),
		    'program_content' => $this->input->post('program_content'),
		    'messages_content' => $this->input->post('messages_content'),
		    'web_content' => $this->input->post('web_content'),
		    
		    //'status' => $this->input->post('status')
		    
                );
               
		$last_insert=$this->home_model->add_homepage($data_to_store);
		//$this->mod_user_management->add($data_to_store);
		
		
		
		
                if($last_insert){
                    $this->session->set_flashdata('flash_message', 'pages_inserted');
                }else{
                    $this->session->set_flashdata('flash_message', 'pages_not_inserted');
                }
		redirect('control/homepage');

            //}

        }
        //load the view
        $data['view_link'] = 'admin/homepage/add';
        $this->load->view('includes/template', $data);  
    }


    public function update()
    {
        
        $id = $this->uri->segment(4);
  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
           
            $this->form_validation->set_rules('app_booking_text', 'App booking text', 'required|trim');
	    $this->form_validation->set_rules('app_trainaway_text', 'App trainaway text', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
            if ($this->form_validation->run())
            {
    		
                $data_to_store = array(
                    'app_booking_text' => $this->input->post('app_booking_text'),
		    //'title_alias' => $title_alias,
		    'app_trainaway_text' => $this->input->post('app_trainaway_text'),
		    
		    'web_content' => $this->input->post('web_content')
		    
                );
                
                if($this->home_model->update_page($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'pages_updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'pages_not_updated');
                }
              
		redirect('control/homepage');
            }

        }


       
      
        
	 $data['view_link'] = 'admin/homepage/list';
        $this->load->view('includes/template', $data); 
	


    }
    
    
    
    
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $add = $this->page_model->delete_page($id);
	if($add == TRUE){
	    $this->session->set_flashdata('flash_message', 'page_deleted');
	}else{
	    $this->session->set_flashdata('flash_message', 'page-not_deleted');
	}
        redirect('control/pages');
    }//edit


}