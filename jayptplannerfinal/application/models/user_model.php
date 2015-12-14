<?php
class User_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
	public function __construct()
	{
	    $this->load->database();
	}
	    
	public function get_user()
	{
	    $this->db->select('*');
	    $this->db->from('user');
	    
	    $query = $this->db->get();
	    $fetch=$query->result();
	    return $fetch;
	}
	
	public function edit($id)
	{
	    
	    $this->db->select('*');
	    $this->db->from('user');
	    $this->db->where('id',$id);
	    $query=$this->db->get();
	    $fetch=$query->result();
	    return $fetch;
	}
	public function update($id,$data)
	{
	    $this->db->where('id',$id);
	    $this->db->update('user',$data);
	}
       public function email_verify_except_own($id,$data)
    {
     $this->db->select('*');
     $this->db->from('user');
     $this->db->where('email',$data['email']);
     $this->db->where('id !=' ,$id);
     $query = $this->db->get();
     return $query->num_rows();
    }
}
?>