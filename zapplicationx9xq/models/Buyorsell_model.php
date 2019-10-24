<?php 
class Buyorsell_model extends CI_Model{
     
     public function report(){
        
        $username = $this->session->userdata('username');
        
        $report         = $this->input->post('re009919');
        $pet_id         = $this->input->post('f0098');
        $pet_owner      = $this->input->post('x0098');
        $pet_name       = $this->input->post('i0078'); 
        $pet_kind       = $this->input->post('o007');
        $plan_name      = $this->input->post('d666');
        $report_message = $this->input->post('dfg34535345');
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
        $sql = "INSERT INTO report_buyorsell (username , report, pet_id, pet_owner, pet_name, pet_kind, plan_name, report_message)            
                VALUES (" . $this->db->escape($username ) . ",
                        " . $this->db->escape($report) . ",
                        " . $this->db->escape($pet_id) . ",
                        " . $this->db->escape($pet_owner) . ",
                        " . $this->db->escape($pet_name) . ",
                        " . $this->db->escape($pet_kind) . ",
                        " . $this->db->escape($plan_name) . ",
                        " . $this->db->escape($report_message) . ")";
                    // Return the result of this query
                $result = $this->db->query($sql);
    }
/* 
 ** 
 *** This is for the sposored ads for animal breeder left side of the page
 ** 
 */
    public function pets_sponsord(){        
        
        // This will make so that it displays different content from different user
        $this->db->select('* , RAND() as rand') ;
        $this->db->from('offers') ;
        $this->db->where('plan_name = "eagle"') ;
        // Here we are calling the RAND() that we have change as rand
        $this->db->order_by('rand') ;
        $this->db->limit(6) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    } 
    
/* 
 **
 *** This is for the sposored ads for animal breeder left side of the page
 ** 
 */
    public function pets_sponsordfoot(){        
        
        // This will make so that it displays different content from different user
        $this->db->select('* , RAND() as rand') ;
        $this->db->from('offers') ;
        $this->db->where('plan_name = "eagle"') ;
        // Here we are calling the RAND() that we have change as rand
        $this->db->order_by('rand') ;
        $this->db->limit(4) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
/*
 ** 
 *** This is to see the full detail about the pet
 ** 
 */
    public function more($id){
        
        
        $this->db->select('*') ;
        $this->db->from('offers') ;
        $this->db->where('id', $id) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->row();
    }
    
/*
 ** 
 ************ Dog page settings ****************************
 ** 
 */
    public function record_count_dog(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "dog"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }    
    
    // This retrieves the list of all the recods from the offers' where pet kind = dog table
     public function fetch_dogs($limit, $start) {
        
         // From our dog page we check to see if the get function has been changed
         // In the dog page we are using the GET method 
         // If the value is null or empty return this else do those elseif statements 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "dog"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "dog"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "dog"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "dog"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "dog"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "dog"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "dog"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "dog"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 ******************* Dog page settings ends ****************
 ** 
 */
    
/*
 ** 
 ******************* Cat page settings  ****************
 ** 
 */
    
    public function record_count_cat(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "cat"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = cat table
     public function fetch_cats($limit, $start) {
         
         // From our cat page we check to see if the get function has been changed
         // In the cat page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "cat"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "cat"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "cat"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "cat"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "cat"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "cat"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "cat"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "cat"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 **************** Cat page settings ends ***************************
 ** 
 */

/*
 ** 
 **************** Birds page settings *************************** 
 ** 
 */
    
    public function record_count_bird(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "bird"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = bird table
     public function fetch_birds($limit, $start) {
        
         // From our bird page we check to see if the get function has been changed
         // In the bird page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "bird"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "bird"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "bird"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "bird"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "bird"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "bird"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "bird"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "bird"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 ********** Birds page settings ends *****************
 ** 
 */

/*
 ** 
 ********** Fish page settings  *****************
 ** 
 */
    
    public function record_count_fish(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "fish"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = fish table
     public function fetch_fishs($limit, $start) {
        
         // From our fish page we check to see if the get function has been changed
         // In the fish page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "fish"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "fish"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "fish"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "fish"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "fish"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "fish"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "fish"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "fish"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 ************ Fish page settings ends *************************
 ** 
 */

/*
 ** 
 ************ Small pet page settings  *************************
 ** 
 */
    
    public function record_count_smallpet(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "small pet"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = smallpet table
     public function fetch_smallpets($limit, $start) {
        
         // From our small pet page we check to see if the get function has been changed
         // In the small pet page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "small pet"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "small pet"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "small pet"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "small pet"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "small pet"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "small pet"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "small pet"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "small pet"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 ******************* Small pet page settings ends ********************
 ** 
 */

/*
 ** 
 ******************* Reptile pet page settings ******************** 
 ** 
 */
    
    public function record_count_reptile(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "reptile"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = reptile table
     public function fetch_reptiles($limit, $start) {
        
         // From our reptile page we check to see if the get function has been changed
         // In the reptile page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "reptile"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "reptile"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "reptile"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "reptile"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "reptile"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "reptile"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "reptile"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "reptile"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 ******************* Reptile pet page settings ends **********************
 ** 
 */ 

/*
 ** 
 ******************* Horse page settings  **********************
 ** 
 */
    
    public function record_count_horse(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "horse"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = horse table
     public function fetch_horses($limit, $start) {
        
         // From our horse page we check to see if the get function has been changed
         // In the horse page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "horse"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "horse"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "horse"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "horse"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "horse"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "horse"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "horse"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "horse"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 ********************* Horse page settings ends *******************
 ** 
 */

/*
 ** 
 ********************* Farm animals page settings  *******************
 ** 
 */
    
    public function record_count_farmanimal(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "farm animal"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = farmanimal table
     public function fetch_farmanimals($limit, $start) {
        
         // From our farm animal page we check to see if the get function has been changed
         // In the farm animal page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "farm animal"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "farm animal"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "farm animal"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "farm animal"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "farm animal"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "farm animal"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "farm animal"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "farm animal"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 ****************** Farm animals page settings ends *********************
 ** 
 */

/*
 ** 
 ****************** Exotics page settings *********************
 ** 
 */
    
    public function record_count_exotic(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "exotic"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = exotic table
     public function fetch_exotics($limit, $start) {
        
         // From our exotic page we check to see if the get function has been changed
         // In the exotic page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "exotic"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "exotic"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "exotic"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "exotic"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "exotic"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "exotic"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "exotic"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "exotic"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }
    
/*
 ** 
 **************** Exotics page settings ends *************************
 ** 
 */

/*
 ** 
 **************** Insects page settings ************************* 
 ** 
 */
    
    public function record_count_insect(){
        
        $this->db->from('offers') ;
        $this->db->where('pet_kind = "insect"');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
     }
    
    // This retrieves the list of all the recods from the offers' where pet kind = insects table
     public function fetch_insects($limit, $start) {
        
         // From our insect page we check to see if the get function has been changed
         // In the insect page we are using the GET method 
        if($this->input->get('select') == ' ' || $this->input->get('select') == NULL  ){ 
            
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('pet_kind = "insect"');
            $query = $this->db->get();
            
        }  elseif ($this->input->get('select') == 'price high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "insect"');
            $this->db->order_by('asking_price', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'price low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "insect"');
            $this->db->order_by('asking_price', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'femmal' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "insect"');
            $this->db->order_by('pet_sex', 'asc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'new' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "insect"');
            $this->db->order_by('id', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'male' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "insect"');
            $this->db->order_by('pet_sex', 'desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age high to low' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "insect"');
            $this->db->order_by('pet_ageperiod desc , pet_agenumber desc');

             $query = $this->db->get();
            
        } elseif ($this->input->get('select') == 'age low to high' ) {

            $this->db->limit($limit, $start);
            $this->db->from('offers') ;
            $this->db->where('pet_kind = "insect"');
            $this->db->order_by('pet_ageperiod asc , pet_agenumber asc');

             $query = $this->db->get();
            
        }  
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data; 
        }
        return false;
    }

/*
 *   ***********                                                ********
 ***             *** Inserting into the cart page settings ***** Basket *****
 *   ***********                                                ********
 */
    public function add_to_cart(){
        
        $id        = $this->input->post('ZVmDDfPNxf');
        $price     = $this->input->post('nmbHErBMPp');
        $image_path= $this->input->post('VsiMLxiPGl');
        $pet_name  = $this->input->post('FxuLILgfgT');
        $posted    = $this->input->post('IsnUHQOuHm');
        $pet_sex   = $this->input->post('JtIAIvuNhd');
        $pet_breed = $this->input->post('lkCqTkhoTP');
        $pet_color = $this->input->post('SaWJWLiitH');
        $pet_age   = $this->input->post('eDhibtuTnR');
        $seller    = $this->input->post('ByOjKsHQjw');
        //print_r($rowid);
        //die();
        
        $data = array(
            'id'               => $id,
            'qty'              => 1,
            //'rowid'     => $rowid,
            'image_path'       => $image_path,
            'price'            => $price,
            'name'             => $pet_name,
            'posted'           => $posted,
            'pet_sex'          => $pet_sex,
            'pet_breed'        => $pet_breed,
            'pet_color'        => $pet_color,
            'pet_age'          => $pet_age,
            'seller'           => $seller,
            'order_message'    => ' '
            //'options' => array('Size' => 'L', 'Color' => 'Red')
        );

        $this->cart->insert($data);

    }
    
    public function update_cart(){
        
        //Create the array variable
        $data = array();
        //Create a loop that runs as many times as items we have in the cart
        for($i = 1; $i <= $this->cart->total_items(); $i++){
                //add an array for each item, with the posted rowid
                //and the new quantity
            $data[] = array('rowid' => $_POST[$i.'rowid'], 
                            'qty' => $_POST[$i.'qty']);
                //execute the cart updata method
                //return to the show_cart function to show the user
                //chages we have made
        }
        //print_r($data);
        //die();
            $this->cart->update($data);
    }
    
    public function send_order(){
        
        $buyer = $this->session->userdata('username');
        
        $i = 1; 
           // We are just using foreach for the $i we are not using the $row variable and still work
        foreach ( $this->cart->contents() as $row){
            $rowid          = $this->input->post($i.'rowid');
            $id             = $this->input->post($i.'id');
            $seller         = $this->input->post($i.'seller');
            $pet_price      = $this->input->post($i.'price');
            $pet_name       = $this->input->post($i.'name');
            $posted         = $this->input->post($i.'posted');
            $pet_age        = $this->input->post($i.'pet_age');
            $pet_color      = $this->input->post($i.'pet_color');
            $pet_image_path = $this->input->post($i.'image_path');
            $pet_breed      = $this->input->post($i.'pet_breed');
            $order_message  = $this->input->post($i.'order_message');
            $qty            = $this->input->post($i.'qty');           

                //We are escaping from space and quotes
                // We are assigning the table row to some value
            $sql = "INSERT INTO orders (rowid, seller, buyer, pet_price, pet_name, posted_on, pet_age, pet_color, pet_image_path, pet_breed, order_message, qty)            
                    VALUES (" . $this->db->escape($rowid) . ",
                            " . $this->db->escape($seller) . ",
                            " . $this->db->escape($buyer) . ",
                            " . $this->db->escape($pet_price) . ",
                            " . $this->db->escape($pet_name) . ",
                            " . $this->db->escape($posted) . ",
                            " . $this->db->escape($pet_age) . ",
                            " . $this->db->escape($pet_color) . ",
                            " . $this->db->escape($pet_image_path) . ",
                            " . $this->db->escape($pet_breed) . ",
                            " . $this->db->escape($order_message) . ",
                            " . $this->db->escape($qty) . ")";
                        // Return the result of this query
                $result = $this->db->query($sql);
            $i++;


        //print_r($sql);
        //die();
        }        
    }
}