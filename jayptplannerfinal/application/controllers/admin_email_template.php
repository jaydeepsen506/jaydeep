<?php
class admin_email_template extends CI_Controller{
    
     public function __construct()
       {
        parent::__construct();
       
      // $this->load->model('admin_info');
       $this->load->library('session');
       $this->load->model('sitesetting_model');
       $this->load->model('mod_email_template');
       if(!$this->session->userdata('is_logged_in')){
            redirect('control/login');
        }
       
       }
       
       public function index()
       {
        //$this->load->model('mod_subjects');
	
	 $search_string = $this->input->post('search_text');        
        //$order = $this->input->post('order'); 
        //$order_type = $this->input->post('order_type');
	$order="";
	$order_type="";

	$admin_pagination = $this->sitesetting_model->get_admin_pagination();

        //pagination settings
        $config['per_page'] = $admin_pagination;

        $config['base_url'] = base_url().'control/email_template_management';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
	$config['prev_link'] = 'Prev';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = 'Next';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	
        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Desc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false  || $this->uri->segment(3) == true){ 
           
            
            //The comments here are the same for line 79 until 99
            //
            //if post is not null, we store it in session data array
            //if is null, we use the session data already stored
            //we save order into the the var to load the view with the param already selected       
            //
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
           // $data['data']['count_subjects']= $this->mod_subjects->count_subjects($search_string, $order);
	     $data['data']['count_subjects']= $this->mod_email_template->count_template($search_string,$order);
            $config['total_rows'] = $data['data']['count_subjects'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['data']['value'] = $this->mod_email_template->get_template($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['data']['value'] = $this->mod_email_template->get_template($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['data']['value'] = $this->mod_email_template->get_template('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['data']['value'] = $this->mod_email_template->get_template('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }
	else{
            

            //clean filter data inside section
            //$filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['data']['count_subjects']= $this->mod_email_template->count_template();
            $data['data']['value'] = $this->mod_email_template->get_template('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['data']['count_subjects'];
           

        }
         
	 
	 
        //initializate the panination helper 
        $this->pagination->initialize($config);
        
        //$data['sub_cat']=$this->mod_email_template->get_subject_category();
       // $data['subject']=$this->mod_email_template->get_subject();
        $data['view_link'] = 'admin/email_template/template_list';
        $this->load->view('includes/template', $data);
       }
       
       public function update()
        {
         $id = $this->uri->segment(4);
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
	  $this->form_validation->set_rules('email_subject', 'Emai Subject', 'required');

            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
	 // echo $x=$this->input->post('email_subject');
	  if ($this->form_validation->run())
                {
		     // echo "kk";die();
          $data_to_store = array(
            'subject' => $this->input->post('email_subject'),
            'email_body' => $this->input->post('email_content'),
            'status' => $this->input->post('status1')
            );
	
           if($this->mod_email_template->update_template($data_to_store,$id))
	   {
                 $this->session->set_flashdata('flash_message', 'subject_updated');
		 // print_r($data_to_store);
	   }
           else{
                  $this->session->set_flashdata('flash_message', 'subject_updated');
              }
               redirect('control/email_template_management');
          
        }
	}
	
        $data['template']=$this->mod_email_template->get_template_by_id($id);
      //  $data['all_template']=$this->mod_email_template->get_all_template();
	//echo $data['question'][0]['subject_category'];die();
	//$data['subject_cat']=$this->mod_question_answer->get_subject_category();
        //$data['subject']=$this->mod_question_answer->get_subject_by_category($data['question'][0]['subject_category']);
        $data['view_link'] = 'admin/email_template/edit_template';
        $this->load->view('includes/template', $data);  

        
        }
        
        
      


}
?>