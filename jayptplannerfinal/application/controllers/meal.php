<?php
class Meal extends CI_Controller
{
    const VIEW_FOLDER = 'admin/meal_management/';
    
 public function __construct()
	{
           
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->model('meal_model');
		$this->load->database();
		
		
	}
    public function index()
        {	
	   $data['all_data']=$this->meal_model->meal_list();
           //print_r($data['all_data']);die;
	    $data['view_link'] = 'admin/meal_management/meal_list';
	    $this->load->view('includes/template', $data);
	    
        }
  
      public function edit()
   {
        $id= $this->uri->segment(4);
        $r=$this->meal_model->edit($id);
        return $r;
    }
    
   
public function meal_options()
    {
        $id = $this->uri->segment(3); 
        $data['meal_options'] = $this->meal_model->getbyid($id);
        $data['view_link'] = 'admin/meal_management/meal_options';
	$this->load->view('includes/template', $data);
	
    }
    
public function img_options($id)
    {
        $id = $this->uri->segment(3);
        $data['data'] = $this->meal_model->getby($id);
        $data['view_link'] = 'admin/meal_management/img_options';
	$this->load->view('includes/template', $data);
	
    }
    
 
}

?>
