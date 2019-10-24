<?php 
class Video_model extends CI_Model{
    
    public function four_top_videos(){
        
        
        $this->db->select('*') ;
        $this->db->from('videos') ;
        $this->db->limit(4) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
    public function most_popular_video(){
        
        
        $this->db->select('*') ;
        $this->db->from('videos') ;
        $this->db->limit(1) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
    public function more($id){
        
        
        $this->db->select('*') ;
        $this->db->from('videos') ;
        $this->db->where('id', $id) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->row();
    }
    public function top_videos(){
        
        
        $this->db->select('*') ;
        $this->db->from('videos') ;
        $this->db->limit(10) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    //Get all users table
    public function get_user(){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99');
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->row();
    }
    
}