<?php
class Homepage_model extends CI_Model {
 
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
		$this->db->from('home_page_management');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function get_admin_pagination()
	{
		$id = '1';
		$this->db->select('admin_pagination');
		$this->db->from('settings');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret->admin_pagination;
	}

    /**
    * Update password
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_settings($data)
    {
		$id = '1';
		$this->db->where('id', $id);
		$this->db->update('home_page_management', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	public function get_site_pagination()
	{
		$id = '1';
		$this->db->select('site_pagination');
		$this->db->from('settings');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret->site_pagination;
	}
 
}
?>