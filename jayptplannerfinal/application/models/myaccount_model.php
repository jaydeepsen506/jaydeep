<?php
class Myaccount_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Update password
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_account($data)
    {
		$id = $this->session->userdata('user_id');
		$this->db->where('id', $id);
		$this->db->update('membership', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	
	public function get_account_data()
    {
		$id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('membership');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
 
}
?>