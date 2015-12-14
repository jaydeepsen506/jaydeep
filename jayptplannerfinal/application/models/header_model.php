<?php
class Header_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
	
	public function get_settings()
	{
		$id = '1';
		$this->db->select('*');
		$this->db->from('settings');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function get_contact_email()
	{
		$id = '1';
		$this->db->select('contact_email');
		$this->db->from('settings');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret->contact_email;
	}

	public function get_social_links($id)
	{
		$this->db->select('*');
		$this->db->from('social_link');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
 
}
?>