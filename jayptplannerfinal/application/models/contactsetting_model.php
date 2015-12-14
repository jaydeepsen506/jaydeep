<?php
class Contactsetting_model extends CI_Model {
 
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
	    $this->db->from('contact_settings');
	    $this->db->where('id', $id);
	    $query = $this->db->get();
	    return $query->result_array(); 
	}


    /**
    * Update password
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_settings($data)
    {
	$id =1;
	$d['contact_email'] = $data['contact_email'];
	// update contact_settings table
	
	$this->db->where('id', $id);
	$this->db->update('contact_settings', $data);
	
	// update settings table's contact email
	//echo $this->db->last_query();
	//die;
	$this->db->where('id', $id);
	$this->db->update('settings', $d);
	
	$report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0){
		return true;
	}else{
		return false;
	}
    }
 
}
?>