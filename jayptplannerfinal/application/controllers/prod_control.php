<?php

class prod_control extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
        function __construct()
	{	
		parent::__construct();
		$this->load->model("prod_model");
	}
    
    
    /*store related function*/

       function storesetting()
	{
		$data['data']['userdata']= $this->prod_model->view_store();
		$data['view_link']='storelistmap';
		$this->load->view('includes/template',$data);
	}
	 function viewprod($a)
	 {
		
		$data['data']['userdata']= $this->prod_model->viewprod($a);
		$data['view_link']='colorbox';
		$this->load->view('includes/template',$data);
	 }
	function instore()
	{
		//$data['data']['userdata']= $this->prod_model->view_store();
		$data['view_link']='addme';
		$this->load->view('includes/template',$data);
	}
	/*function insdata()
	{
	         $q= $this->prod_model->ins_store();
		     if($q)
                 {
                      redirect('prod_control/storesetting');       
                 }
	}*/
	function delete($a)
	
	{
		error_reporting(1);
		 $q=$this->prod_model->delete($a);
		 if($q)
		 {
			redirect('prod_control/productdis');
			
		 }
	}
	function multistoredel()
	{
		$r=$this->prod_model->multistoredel();
		if($r)
		{
			redirect('prod_control/storesetting');
		}
	}
    function updateshow($a)
	{
		//error_reporting(1);
		 $data['result']=$this->prod_model->updateshow($a);
		 $data['view_link']='modstore';
		 $this->load->view('includes/template',$data);
		
	}
	function update($a)
	{
		$q=$this->prod_model->update($a);
		 if($q)
		 {
			redirect('prod_control/storesetting');
			
		 }
	}
	public function map(){
			$this->load->library('googlemaps');
			//echo 'hello';
			//$id=$this->input->post('id');
			//echo $id;
			
			if(empty($id)){
				$id=$this->uri->segment(4);
			}
		
			/*echo "<script>alert($id);</script>";*/
		
			$query['result']=$this->prod_model->fetch_map($id);
			$lat=$query['result']['lat'];
			$long=$query['result']['long'];
			$sql=$lat.", ".$long;
			$config['center'] = $sql;
            $config['zoom'] = 'auto';
            $this->googlemaps->initialize($config);
            
            $marker = array();
            $marker['position'] = $sql;
            $this->googlemaps->add_marker($marker);/*????*/
			$data['view_link'] = 'map';
            $data['map'] = $this->googlemaps->create_map();/*?????*/
            //echo $data['map']['js']; 
            //echo $data['map']['html'];
            $this->load->view('includes/template', $data);
	}
	public function insdata(){
		
				//print_r($data);die;
				$query=$this->prod_model->store_insert();
				if($query){
					redirect('prod_control/storesetting');
				}
			//}
		//}
	}
	/*product realated function*/
	function productdis()
	{
		$data['data']['userdata']= $this->prod_model->view_prod();
		$data['view_link']='prolistfinal';
		$this->load->view('includes/template',$data);
		
	}
	function addpro()
	{
		$data['data']['userdata']= $this->prod_model->dis_store();
		$data['view_link']='addprodfinal';
		$this->load->view('includes/template',$data);
	}
	function insprod()
	{
		    $ar=count($_FILES['file']['name']);
			/*$nam=$_FILES['image']['name'];
			$val=time().rand(00,99).$nam;
			$path='uploads/'.$val;
			$tmp=$_FILES['image']['tmp_name'];
			move_uploaded_file($tmp,$path);*/
			$r=$this->prod_model->insprod($ar);
			if($r)
			{
			
				redirect('prod_control/productdis');
			}		
		
	}
	function proeditshow($a)
	{
		 $data['result']=$this->prod_model->proeditshow($a);
		 $data['view_link']='editproshow';
		 $this->load->view('includes/template',$data);
	}
	
	function prodel()
	
	{
		error_reporting(1);
		
		 $q=$this->prod_model->prodelete();
		 /*if($q)
		 {
			$data['userdata']= $this->prod_model->view_prod();
		  
		    $this->load->view('prolistfinal',$data);
			
		 }*/
	}
	function imgdel()
	{
		
		error_reporting(1);
		//$id=$this->input->post('data');
		//$q=$this->db->query("select pid from productimg where id='$id'");
		//$q=$q->result_array();
		//$pid= $q[0]['pid'];
	
		 $q=$this->prod_model->imgdelete();
		
		 
			//$data['userdata']= $this->prod_model->viewprod($pid);
		  
		    //$this->load->view('colorbox',$data);
			
		 
	}
	function produpdate($x)
	{
		
		$q=$this->prod_model->produpdate($x);
		 if($q)
		 {
			redirect('prod_control/productdis');
			
		 }
		 
	}
	function gallery()
	{ error_reporting(1);
		$d['data']=$this->prod_model->gallery();
		$this->load->view('includes/header');
		$this->load->view('imgslider',$d);
		
	}







}

