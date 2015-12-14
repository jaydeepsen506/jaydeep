<?php
class Trainer_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
	
    public function trainer_list()
    {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('type','T');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
     public function trainers()
    {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('type','T');
	$this->db->where('status','Y');
	$query = $this->db->get();
	
	$fetch=$query->result_array();
	//print_r($fetch);die;
	return $fetch;
    }
    
    function trainer_info($id)
    {
        $this->db->select('*');
	$this->db->from('user');
        $this->db->where('id',$id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
      function trainer_info1($id)
    {
        $this->db->select('*');
	$this->db->from('user');
        $this->db->where('id',$id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    function update_trainer($id,$data)
    {
        $this->db->where('id', $id);
	
	$this->db->update('user', $data);
        
        return true;
        
    }
        function update_date($id,$data)
    {
        $this->db->where('id', $id);
	
	$this->db->update('user', $data);
        
        return true;
        
    }
    public function get_network_list($id)
    {
	$this->db->select('*');
	$this->db->from('network_member');
        $this->db->where('user_id',$id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function check_email_exists_or_not($email_id,$client_id)
    {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('email',$email_id);
        $this->db->where('id !=',$client_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    
}
?>