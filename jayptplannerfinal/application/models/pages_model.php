<?php
class Pages_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
	
	public function get_page_content($alias)
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('title_alias', $alias);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_page_title($alias)
	{
		$this->db->select('page_title');
		$this->db->from('pages');
		$this->db->where('title_alias', $alias);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret->page_title;
	}
 
}
?>