<?php
class Network_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct(){
        $this->load->database();
    }
    
    public function network_list(){
        $this->db->select('*');
	$this->db->from('network');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function get_user_information($user_id) /////Fetch User Details
    {
	$this->db->select('*');
	$this->db->from('user');
        $this->db->where('id',$user_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_total_members($network_id)////Get total Number of members of a network
    {
	$this->db->select('*');
	$this->db->from('network_member');
        $this->db->where('network_id',$network_id);
	$query = $this->db->get();
	$fetch=$query->num_rows();
	return $fetch;
    }
    
    public function get_all_trainers()/////Get All trainer's information
    {
        $this->db->select('*');
	$this->db->from('user');
        $this->db->where('type','T');
	$this->db->where('id !=',$this->session->userdata('site_user_id'));
	$this->db->where('status','Y');
	$query = $this->db->get();
	//echo $this->db->last_query();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function get_network_member_details($network_id)
    {
	$this->db->select('*');
        $this->db->from('network_member');
	$this->db->where('user_id !=',$this->session->userdata('site_user_id'));
        $this->db->where('network_id',$network_id);
	$this->db->where('status','Y');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function check_member_existance($network_id,$user_id)
    {
      	$this->db->select('*');
	$this->db->from('network_member');
        $this->db->where('network_id',$network_id);
        $this->db->where('user_id',$user_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function delete_network($network_id)
    {
	$this->db->where('id',$network_id);
	$this->db->delete('network');
	$this->db->where('network_id',$network_id);
	$this->db->delete('network_member');
        $report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0){
	    return true;
	}else{
	    return false;
	}
    }
    
    public function get_other_networks($user_id)
    {
	$this->db->select('network.id as net_id,network_member.id as member_id,network.*,network_member.*');
	$this->db->from('network');
	$this->db->join('network_member','network.id=network_member.network_id');
        $this->db->where('network.created_by !=',$user_id);
        $this->db->where('network_member.user_id',$user_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function get_network_members($network_id,$user_id)
    {
	$this->db->select('*');
	$this->db->from('network_member');
        $this->db->where('network_id',$network_id);
        $this->db->where('user_id !=',$user_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_all_msg_sender($search_text=null)
    {
	 if($search_text != null)
	 {
	    $query=$this->db->query("(SELECT * FROM `messages`,`user` WHERE messages.sent_to=user.id AND sent_by='".$this->session->userdata('site_user_id')."' AND user.name LIKE '%".$search_text."%') UNION (SELECT * FROM `messages`,`user` WHERE messages.sent_by=user.id AND sent_to='".$this->session->userdata('site_user_id')."' AND user.name LIKE '%".$search_text."%') order by send_time desc");
	 }
	 else{
         $query=$this->db->query("(SELECT * FROM `messages` WHERE sent_by='".$this->session->userdata('site_user_id')."') UNION (SELECT * FROM `messages` WHERE sent_to='".$this->session->userdata('site_user_id')."') order by send_time desc");
	 }
	 //echo $this->db->last_query();
	 $fetch=$query->result_array();
	 return $fetch;
    }
public function get_unread_msg_sender($search_text=null)
    {
	 if($search_text != null)
	 {
	    $query=$this->db->query("(SELECT user.id as userId,messages.id as msgId,user.*,messages.* FROM `messages`,`user` WHERE messages.sent_to=user.id AND sent_by='".$this->session->userdata('site_user_id')."' AND user.name LIKE '%".$search_text."%') UNION (SELECT user.id as userId,messages.id as msgId,user.*,messages.* FROM `messages`,`user` WHERE messages.sent_by=user.id AND sent_to='".$this->session->userdata('site_user_id')."' AND user.name LIKE '%".$search_text."%') order by send_time desc");
	 }
	 else{
         $query=$this->db->query("(SELECT * FROM `messages` WHERE sent_by='".$this->session->userdata('site_user_id')."' AND read_status='N') UNION (SELECT * FROM `messages` WHERE sent_to='".$this->session->userdata('site_user_id')."' AND read_status='N') order by send_time desc");
	 }
	 //echo $this->db->last_query();
	 $fetch=$query->result_array();
	 return $fetch;
    }
    public function get_all_msg_sender_app($search_text=null,$logged_in_user)
    {
	 if($search_text != null)
	 {
	    $query=$this->db->query("(SELECT * FROM `messages`,`user` WHERE messages.sent_to=user.id AND sent_by='".$logged_in_user."' AND user.name LIKE '%".$search_text."%') UNION (SELECT * FROM `messages`,`user` WHERE messages.sent_by=user.id AND sent_to='".$logged_in_user."' AND user.name LIKE '%".$search_text."%') order by send_time desc");
	 }
	 else{
         $query=$this->db->query("(SELECT * FROM `messages` WHERE sent_by='".$logged_in_user."') UNION (SELECT * FROM `messages` WHERE sent_to='".$logged_in_user."') order by send_time desc");
	 }
	 //echo $this->db->last_query();
	 $fetch=$query->result_array();
	 return $fetch;
    }
    public function get_last_chat($sender)
    {
	$this->db->select('*');
	$this->db->from('messages');
	$where="(`sent_by`='".$this->session->userdata('site_user_id')."' AND `sent_to`='".$sender."') OR (`sent_by`='".$sender."' AND `sent_to`='".$this->session->userdata('site_user_id')."')";
	$this->db->where($where);
	$this->db->order_by('send_time','DESC');
	$this->db->limit(1,0);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
     public function get_last_chat_app($sender,$logged_in_user)
    {
	$this->db->select('*');
	$this->db->from('messages');
	$where="(`sent_by`='".$logged_in_user."' AND `sent_to`='".$sender."') OR (`sent_by`='".$sender."' AND `sent_to`='".$logged_in_user."')";
	$this->db->where($where);
	$this->db->order_by('send_time','DESC');
	$this->db->limit(1,0);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function last_most_message_info()
    {
	$this->db->select('*');
	$this->db->from('messages');
        $this->db->where('sent_to',$this->session->userdata('site_user_id'));
	$this->db->or_where('sent_by',$this->session->userdata('site_user_id'));
        $this->db->group_by('sent_by');
	$this->db->order_by('send_time','ASC');
	$this->db->limit(1,0);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_latest_user_messages($sender)
    {
        $this->db->select('*');
	$this->db->from('messages');
	$where="(`sent_by`='".$this->session->userdata('site_user_id')."' AND `sent_to`='".$sender."') OR (`sent_by`='".$sender."' AND `sent_to`='".$this->session->userdata('site_user_id')."')";
	$this->db->where($where);
	$this->db->order_by('send_time','ASC');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_latest_user_messages_app($sender,$logged_in_user)
    {
        $this->db->select('*');
	$this->db->from('messages');
	$where="(`sent_by`='".$logged_in_user."' AND `sent_to`='".$sender."') OR (`sent_by`='".$sender."' AND `sent_to`='".$logged_in_user."')";
	$this->db->where($where);
	$this->db->order_by('send_time','ASC');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function update_message_read_status($sent_by,$data)
    {
	$sent_to=$this->session->userdata('site_user_id');
	$this->db->where('sent_to',$sent_to);
	$this->db->where('sent_by',$sent_by);
	$this->db->update('messages',$data);
	$report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0){
	    return true;
	}else{
	    return false;
	}
    }
    public function update_message_read_status_app($sent_by,$sent_to,$data)
    {
	$this->db->where('sent_to',$sent_to);
	$this->db->where('sent_by',$sent_by);
	$this->db->update('messages',$data);
	$report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0){
	    return true;
	}else{
	    return false;
	}
    }
    public function user_respective_total_number_of_unread_messages($sent_by){
	$this->db->select('*');
	$this->db->from('messages');
        $this->db->where('sent_to',$this->session->userdata('site_user_id'));
	$this->db->where('sent_by',$sent_by);
	$this->db->where('read_status','N');
	$query = $this->db->get();
	$fetch=$query->num_rows();
	return $fetch;
    }
    public function get_latest_user_chat($sender,$limit_start=null,$limit_end=null)
    {
       $sub= $this->db->query("SELECT * FROM (SELECT * FROM (`messages`) WHERE (`sent_by`='".$this->session->userdata('site_user_id')."' AND `sent_to`='".$sender."') OR (`sent_by`='".$sender."' AND `sent_to`='".$this->session->userdata('site_user_id')."') ORDER BY `send_time` DESC LIMIT ".$limit_end.",".$limit_start.") as a ORDER BY a.`id` ASC",FALSE);

	return $sub->result_array();
    }
     public function get_latest_notifications($limit_start=null,$limit_end=null)
    {
       $sub= $this->db->query("SELECT * FROM (SELECT * FROM (`notifications`) WHERE `user_id`='".$this->session->userdata('site_user_id')."' ORDER BY `notification_time` DESC LIMIT ".$limit_end.",".$limit_start.") as a ORDER BY a.`id` ASC",FALSE);

	return $sub->result_array();
    }
    
    public function check_member_existance_to_other_network($network_id,$member_id,$user_id){
        
	$this->db->select('network.id as net_id,network_member.id as net_mem_id, network.*,network_member.*');
        $this->db->from('network');
	$this->db->join('network_member', 'network.id = network_member.network_id');
	$this->db->where('network.created_by',$user_id);
	$this->db->where('network_member.user_id',$member_id);
	$this->db->where('network_member.network_id !=',$network_id);
	$res = $this->db->get();
	return $res->result_array();
    }
    
    public function delete_shared_clients($user_1,$user_2){
    
     	$this->db->where('client_created_by',$user_1);
	$this->db->where('trainer_id',$user_2);
	$this->db->delete('shared_clients');
        $report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0){
	    return true;
	}else{
	    return false;
	}
    }
    public function get_all_memebrs_of_network($network_id){
	$this->db->select('*');
	$this->db->from('network_member');
        $this->db->where('network_id',$network_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_all_memebrs_of_network_except($network_id,$user_id){
	
	$this->db->select('*');
	$this->db->from('network_member');
        $this->db->where('network_id',$network_id);
	$this->db->where('user_id !=',$user_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_other_networks1($network_id,$user_id){
	
	$this->db->select('*');
	$this->db->from('network_member');
        $this->db->where('user_id',$user_id);
	$this->db->where('network_id !=',$network_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function network_member_existance($user_id,$network_id){
	
	$this->db->select('*');
	$this->db->from('network_member');
        $this->db->where('user_id',$user_id);
	$this->db->where('network_id',$network_id);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_shared_clients($search_text=null)
    {
      $query= $this->db->query("SELECT `user`.id as uid,`shared_clients`.id as share_id,`user`.*,`shared_clients`.* FROM `user`,`shared_clients` WHERE shared_clients.client_id=user.id AND shared_clients.trainer_id='".$this->session->userdata('site_user_id')."' AND user.name LIKE '%".$search_text."%'");
	return $fetch=$query->result_array();
    }
    
    public function get_dates_within_week(){
	    $query= $this->db->query("select * from trainer_avl_time_repeat_val
where `repeat_date` between date_sub(now(),INTERVAL 1 WEEK) and now() and `trainer_id`='".$this->session->userdata('site_user_id')."'");
	    return $fetch=$query->result_array();
    }
    public function get_dates_within_month(){
	    $query= $this->db->query("select * from trainer_avl_time_repeat_val
where `repeat_date` between date_sub(now(),INTERVAL 1 MONTH) and now() and `trainer_id`='".$this->session->userdata('site_user_id')."'");
	    return $fetch=$query->result_array();
    }
    
    public function get_dates_within_year(){
	    $query= $this->db->query("select * from trainer_avl_time_repeat_val
where `repeat_date` between date_sub(now(),INTERVAL 1 YEAR) and now() and `trainer_id`='".$this->session->userdata('site_user_id')."'");
	    return $fetch=$query->result_array();
    }
}
?>