<?php 
//ALWAYS LOAD YOUR MODELS
class Image_model extends CI_Model{ 
    
    public function get_animal_image(){
        $this->db->select('*');
        $this->db->from('animal_image');
        $query = $this->db->get();
        return $query->row();
    }
     // Return all the row in the dogs' table
     // This will be use for pagination for the "total_rows"
     public function record_count(){
         
         //$table1 = $this->db->count_all('animal_image');
         $table2 = $this->db->count_all('animal_image_user');
         $addingTable = $table2;
         return $addingTable ;
     }
    public function cta(){
         
         return $this->db->count_all('animal_image');
          
     }
    public function ctu(){
         
         return $this->db->count_all('animal_image_user');
     }
    
     // This retrieves the list of all the recods from the animal image's table
     public function fetch_images($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->from("animal_image");
        $this->db->order_by("id", "desc"); 
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) {
            // Return each row 
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
        // This retrieves the list of all the recods from the animal image's table
     public function fetch_image($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->from("animal_image_user");
        $this->db->order_by("id", "desc"); 
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) {
            // Return each row 
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
}