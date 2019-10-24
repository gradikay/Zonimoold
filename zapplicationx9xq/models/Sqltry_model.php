<?php 
class Sqltry_model extends CI_Model{
    public function mydatabase(){ 
        
        $this->db->select('*');
        $this->db->from('dogs AS D');
        $this->db->join('image_update AS U','D.name = U.animal_name','left');
        $this->db->join('image_update2 AS V','D.name = V.animal_name','left');
        $query = $this->db->get();
        return $query->result();
        
    
    }
}