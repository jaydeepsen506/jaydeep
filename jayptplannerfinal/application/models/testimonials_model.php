<?php
class Testimonials_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
	
    public function testimonials()
    {
	$this->db->select('*');
	$this->db->from('testimonials');
	$query = $this->db->get();
	$fetch=$query->result();
	return $fetch;
    }
    public function insert($data)
    {
        $this->db->insert('testimonials',$data);
    }
    public function edit($id)
    {
        $this->db->select('*');
        $this->db->from('testimonials');
        $this->db->where('id',$id);
        $query=$this->db->get();
        $fetch=$query->result();
        return $fetch;
    }
    public function update($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('testimonials',$data);
    }
    public function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('testimonials');
    }
}
?>