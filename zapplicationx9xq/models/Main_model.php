<?php 
class Main_model extends CI_Model{
    
    public function get_animals(){
        
        $this->db->select('*');
        $this->db->from('monotremes');
        
        $query = $this->db->get();
        return $query->result();
    }
    public function get_animal_details($id){
        $this->db->select('*');
        $this->db->from('monotremes');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_databases(){
        $this->db->select('*');
        $this->db->from('section AS S');
        $this->db->join('monotremes AS M', 'S.section_id = M.section_id', 'INNER');
        $this->db->join('sub_species AS B', 'B.id = M.sub_specie_id', 'INNER');
        $this->db->join('specie AS C', 'C.specie_id = M.specie_id', 'INNER');
        $query = $this->db->get();
        /*
         * Row will return the result
         */
        return $query->row();
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