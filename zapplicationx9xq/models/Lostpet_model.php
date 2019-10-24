<?php 
class Lostpet_model extends CI_Model{
    
// Return all the row in the cats' table
// This will be use for pagination for the "total_rows"
     public function record_count_lost(){
         return $this->db->count_all('pet_lost');
     }
    
// This retrieves the list of all the recods from the cats' table
     public function fetch_lost_pet($limit, $start) { 
        $this->db->limit($limit, $start);
        $this->db->select('*') ;
        $this->db->from('pet_lost') ;
        //$this->db->order_by("name", "asc");
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
// Return all the row in the cats' table
// This will be use for pagination for the "total_rows"
     public function record_count_found(){
         return $this->db->count_all('pet_found');
     }
    
// This retrieves the list of all the recods from the cats' table
     public function fetch_found_pet($limit, $start) { 
        $this->db->limit($limit, $start);
        $this->db->select('*') ;
        $this->db->from('pet_found') ;
        //$this->db->order_by("name", "asc");
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
}