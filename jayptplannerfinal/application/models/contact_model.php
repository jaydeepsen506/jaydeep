<?php
class Contact_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
	
    public function contact()
    {
	$this->db->select('*');
	$this->db->from('manage_contact');
	$query = $this->db->get();
	$fetch=$query->result();
	return $fetch;
    }
    public function edit1($id)
    {
	 $this->db->select('*');
	 $this->db->from('manage_contact');
         $this->db->where('id',$id);
                $query = $this->db->get();                
                $fetch=$query->result();
                  return $fetch;  
    }
    public function save_message($data)
    {
		$insert = $this->db->insert('contact_message', $data);
	    return $insert;
    }
    
    public function store_contact($data)
    {
	$insert = $this->db->insert('contact_us', $data);
			return true;
    }
    
    
    public function get_template()
    {
	    $this->db->select('*');
	    $this->db->from('email_template');
	    $this->db->where('temp_id', 1); 
	    $query = $this->db->get();
	    return $query->result();
    }
    public function admin_mailid($id)
    {
	    $this->db->select('*');
	    $this->db->from('contact_settings');
	    $this->db->where('id', $id); 
	    $query = $this->db->get();
	    return $query->result_array();
    }
    
 
}
?>