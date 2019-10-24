<?php  
class Cancel_model extends CI_Model{
    
    public function cancel_ad(){
        $ad_id = $this->session->userdata('ad_id');
        
        $this->db->select('*');
        $this->db->where("ad_id = '$ad_id'");
        $this->db->limit(1);
        $this->db->delete('ads');
    }
    
    public function cancel_lost(){
        
        $lost_id = $this->session->userdata('lost_id');
        
        $this->db->select('*');
        $this->db->where("lost_id ='$lost_id'");
        $this->db->limit(1);
        $this->db->delete('pet_lost');
    }
    
}