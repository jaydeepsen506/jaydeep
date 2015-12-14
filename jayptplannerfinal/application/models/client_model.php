<?php
class Client_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
  
       public function client_list()
    {
	$this->db->from('user');
	$this->db->where('type','C');
	$qry=$this->db->get();
	return $qry->result_array();
    }
            
    public function created_name($created_by)
    {
	$this->db->select("*");
	$this->db->from('user');
	$this->db->where('id',$created_by);
	$qry=$this->db->get();
	return $qry->result_array();
	
    }
        
    }
?>