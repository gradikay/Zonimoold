<?php 
// WHEN YOU GET THE NONE OBJECT PROBLEM USE RESULT() RATHER THAN ROW()
//class Factopedia_model extends CI_Model{
    class Ducks_model extends CI_Model{
     
     // Return all the row in the ducks' table
     // This will be use for pagination for the "total_rows"
     public function record_count(){
         
         return $this->db->count_all('ducks');
         
     }
    
     // This retrieves the list of all the recods from the ducks' table
     public function fetch_ducks($limit, $start) {
         
        $this->db->limit($limit, $start);
        $this->db->select('*') ;
        $this->db->from('ducks AS D') ;
        $this->db->order_by("name", "asc");
        $this->db->join('ducks_first_image  AS F', 'D.name = F.animal_name','left') ;
        $this->db->join('ducks_second_image AS S', 'D.name = S.animal_name','left') ;
        $this->db->join('ducks_third_image  AS T', 'D.name = T.animal_name','left') ;
        $this->db->join('ducks_fourth_image AS R', 'D.name = R.animal_name','left') ;
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
    public function get_my_images($id){
        
        $this->db->select('*') ;
        $this->db->from('ducks AS D') ;
        $this->db->join('ducks_first_image  AS F', 'D.name = F.animal_name','left') ;
        $this->db->join('ducks_second_image AS S', 'D.name = S.animal_name','left') ;
        $this->db->join('ducks_third_image  AS T', 'D.name = T.animal_name','left') ;
        $this->db->join('ducks_fourth_image AS R', 'D.name = R.animal_name','left') ;
        $this->db->where('D.id', $id);
        $query = $this->db->get();
        return $query->row();
        
    }
/*
 ********************* Ducks' table settings
 */
    public function get_duck_details($id){
        $this->db->select('*');
        $this->db->from('ducks');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_duck_databases(){
        $this->db->select('*');
        $this->db->from('section AS S');
        $this->db->join('ducks AS D', 'S.section_id = D.section_id', 'INNER');
        $this->db->join('sub_species AS B', 'B.id = D.sub_specie_id', 'INNER');
        $this->db->join('specie AS C', 'C.specie_id = D.specie_id', 'INNER');
        $query = $this->db->get();
        /*
         * Row will return the result
         */
        return $query->row();
    }
    
    
//Update the animal data selected here we have the ducks' table
    
     public function update(){
          // This is the setting for the editing part of ducks' page
          // OLD CODE
        /* $data = array(
            'other_name'  => $this->input->post('other_name'),
            'weight_1'    => $this->input->post('weight_1'),
            'weight_2'    => $this->input->post('weight_2'),
            'height_1'    => $this->input->post('height_1'),
            'height_2'    => $this->input->post('height_2'),
            'duck_function'=> $this->input->post('duck_function'),
            'color'       => $this->input->post('color'),
            'location'    => $this->input->post('location'),
            'offsprings'  => $this->input->post('offspring'),
            'life_span'   => $this->input->post('life_span'),
            'description' => $this->input->post('description'),
            'source'      => $this->input->post('links')
        ); */
            $id   = $this->input->post('congo');
            $other_name   = $this->input->post('VCPKiFHUvI');
            $weight_1     = $this->input->post('LwXEqlRRBd');
            $weight_2     = $this->input->post('DoUoxQfTkL');
            $height_1     = $this->input->post('COmnyQOkSy');
            $height_2     = $this->input->post('yaZoFKzEio');
            $duck_function = $this->input->post('nkTdZQcYAo');
            $color        = $this->input->post('CSwyfmDBpu');
            $group        = $this->input->post('SdWKxdEFSr');
            $location     = $this->input->post('clXhXvHgnp');
            $offsprings   = $this->input->post('jFNaKUfhuf');
            $life_span    = $this->input->post('mdATzSMbgl');
            $description  = $this->input->post('description');
            $source       = $this->input->post('links');
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
            $sql = "UPDATE ducks            
                    SET other_name   = " . $this->db->escape($other_name) . ",
                        weight_1     = " . $this->db->escape($weight_1) . ",
                        weight_2     = " . $this->db->escape($weight_2) . ",
                        height_1     = " . $this->db->escape($height_1) . ",
                        height_2     = " . $this->db->escape($height_2) . ",
                        duck_function = " . $this->db->escape($duck_function) . ",
                        color        = " . $this->db->escape($color) . ",                    
                        animal_group = " . $this->db->escape($group) . ",                    
                        location     = " . $this->db->escape($location) . ",                    
                        offsprings   = " . $this->db->escape($offsprings) . ",                    
                        life_span    = " . $this->db->escape($life_span) . ",                    
                        description  = " . $this->db->escape($description) . ",                    
                        source       = " . $this->db->escape($source) . "
                     WHERE id        = " . $id . " ";             
        // Return the result of this query
		 	//die($sql);
            $result = $this->db->query($sql);         
    }
    
    public function ducks_do_upload(){
        $username = $this->session->userdata('username');
        // You can call any of this items using the cariable 
            // $upload_data
			$data = array('upload_data' => $this->upload->data());
           
        /*
            // OLD COLD
            // This is the setting for the image to be uploaded
            $data = array(
                
            'image'          => $data['upload_data']['file_size'],
            'file_type'      => $data['upload_data']['file_type'],
            'file_path'      => $data['upload_data']['file_path'],
            'raw_name'       => $data['upload_data']['raw_name'],
            'orig_name'      => $data['upload_data']['orig_name'],
            'client_name'    => $data['upload_data']['client_name'],
            'image_title'    => $this->input->post('image_title'),
            'z_place'        => $this->input->post('z_place'), // image number
            'username'       => $this->input->post('username'),
            'animal_name'    => $this->input->post('animal_name'),
            'section_name'   => $this->input->post('section_name'),
            'specie_name'    => $this->input->post('specie_name'),
            'sub_specie_name'=> $this->input->post('sub_specie_name'),
            'tags'           => $this->input->post('tags'),    
            'image_path'     => $data['upload_data']['file_name']
            );
            $insert = $this->db->insert('animal_image', $data);
        */
            $image_title     = $this->input->post('pwSTtJDdkm');
            $image_number    = $this->input->post('JSjOgkgBQL');
            $animal_name     = $this->input->post('MqeoMLLNyX');
            $section_name    = $this->input->post('DGAJGPQohm');
            $specie_name     = $this->input->post('ZMlGvucObH');
            $sub_specie_name = $this->input->post('BzeEIMfcwm');
            $tags            = $this->input->post('tags');
            $image           = $data['upload_data']['file_size'];
            $file_type       = $data['upload_data']['file_type'];
            $file_path       = $data['upload_data']['file_path'];
            $raw_name        = $data['upload_data']['raw_name'];
            $orig_name       = $data['upload_data']['orig_name'];
            $client_name     = $data['upload_data']['client_name'];
            $image_path      = $data['upload_data']['file_name'];
            $image_width     = $data['upload_data']['image_width'];
            $image_height    = $data['upload_data']['image_height'];
            $image_is_image  = $data['upload_data']['is_image'];
            $image_size_str  = $data['upload_data']['image_size_str'];
            $image_size      = $data['upload_data']['file_size'];
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
            $sql = "INSERT INTO animal_image (image_title, image_number, username, animal_name, section_name, specie_name, sub_specie_name, tags, image, file_type, file_path, raw_name, orig_name, client_name, image_path, image_width, image_height, image_is_image, image_size_str, image_size)
            
            VALUES (" . $this->db->escape($image_title) . ",
                    " . $this->db->escape($image_number) . ",
                    " . $this->db->escape($username) . ",
                    " . $this->db->escape($animal_name) . ",
                    " . $this->db->escape($section_name) . ",
                    " . $this->db->escape($specie_name) . ",
                    " . $this->db->escape($sub_specie_name) . ",
                    " . $this->db->escape($tags) . ",
                    " . $this->db->escape($image) . ",
                    " . $this->db->escape($file_type) . ",
                    " . $this->db->escape($file_path) . ",
                    " . $this->db->escape($raw_name) . ",
                    " . $this->db->escape($orig_name) . ",
                    " . $this->db->escape($client_name) . ",
                    " . $this->db->escape($image_path) . ",
                    " . $this->db->escape($image_width) . ",
                    " . $this->db->escape($image_height) . ",
                    " . $this->db->escape($image_is_image) . ",
                    " . $this->db->escape($image_size_str) . ",
                    " . $this->db->escape($image_size) . ")";
        // Return the result of this query
            $result = $this->db->query($sql);
    }
        
    public function ducks_do_upload_first(){
        $username = $this->session->userdata('username');
        
        // You can call any of this items using the cariable 
            // $upload_data
			$data = array('upload_data' => $this->upload->data());
        
            $image_title     = $this->input->post('pwSTtJDdkm');
            $animal_name     = $this->input->post('MqeoMLLNyX');
            $file_type       = $data['upload_data']['file_type'];
            $file_path       = $data['upload_data']['file_path'];
            $raw_name        = $data['upload_data']['raw_name'];
            $orig_name       = $data['upload_data']['orig_name'];
            $client_name     = $data['upload_data']['client_name'];
            $image_path      = $data['upload_data']['file_name'];
            $image_width     = $data['upload_data']['image_width'];
            $image_height    = $data['upload_data']['image_height'];
            $image_is_image  = $data['upload_data']['is_image'];
            $image_size_str  = $data['upload_data']['image_size_str'];
            $image_size      = $data['upload_data']['file_size'];
        //We are escaping from space and quotes
        // We are assigning the table row to some value
            $sql = "UPDATE ducks_first_image            
                    SET image_title1    = " . $this->db->escape($image_title) . ",
                        username1       = " . $this->db->escape($username) . ",
                        animal_name     = " . $this->db->escape($animal_name) . ",
                        file_type1      = " . $this->db->escape($file_type) . ",
                        image_path1     = " . $this->db->escape($file_path) . ",
                        raw_name1       = " . $this->db->escape($raw_name) . ",
                        orig_name1      = " . $this->db->escape($orig_name) . ",      
                        client_name1    = " . $this->db->escape($client_name) . ",
                        file_name1      = " . $this->db->escape($image_path) . ",
                        image_width1    = " . $this->db->escape($image_width) . ",
                        image_height1   = " . $this->db->escape($image_height) . ",
                        image_is_image1 = " . $this->db->escape($image_is_image) . ",
                        image_size_str1 = " . $this->db->escape($image_size_str) . ",
                        image_size1     = " . $this->db->escape($image_size) . "
                    WHERE animal_name   = " . $this->db->escape($animal_name) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sql);
    }
        
    public function ducks_do_upload_second(){
        $username = $this->session->userdata('username');
        // You can call any of this items using the cariable 
            // $upload_data
			$data = array('upload_data' => $this->upload->data());
        
            $image_title     = $this->input->post('pwSTtJDdkm');
            $animal_name     = $this->input->post('MqeoMLLNyX');
            $file_type   = $data['upload_data']['file_type'];
            $file_path   = $data['upload_data']['file_path'];
            $raw_name    = $data['upload_data']['raw_name'];
            $orig_name   = $data['upload_data']['orig_name'];
            $client_name = $data['upload_data']['client_name'];
            $image_path  = $data['upload_data']['file_name'];
            $image_width     = $data['upload_data']['image_width'];
            $image_height    = $data['upload_data']['image_height'];
            $image_is_image  = $data['upload_data']['is_image'];
            $image_size_str  = $data['upload_data']['image_size_str'];
            $image_size      = $data['upload_data']['file_size'];
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
            $sql = "UPDATE ducks_second_image            
                    SET image_title2    = " . $this->db->escape($image_title) . ",
                        username2       = " . $this->db->escape($username) . ",
                        animal_name     = " . $this->db->escape($animal_name) . ",
                        file_type2      = " . $this->db->escape($file_type) . ",
                        image_path2     = " . $this->db->escape($file_path) . ",
                        raw_name2       = " . $this->db->escape($raw_name) . ",
                        orig_name2      = " . $this->db->escape($orig_name) . ",       
                        client_name2    = " . $this->db->escape($client_name) . ",
                        file_name2      = " . $this->db->escape($image_path) . ",
                        image_width2    = " . $this->db->escape($image_width) . ",
                        image_height2   = " . $this->db->escape($image_height) . ",
                        image_is_image2 = " . $this->db->escape($image_is_image) . ",
                        image_size_str2 = " . $this->db->escape($image_size_str) . ",
                        image_size2     = " . $this->db->escape($image_size) . "
                    WHERE animal_name   = " . $this->db->escape($animal_name) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sql);
    }
        
    public function ducks_do_upload_third(){
        $username = $this->session->userdata('username');
        // You can call any of this items using the cariable 
            // $upload_data
			$data = array('upload_data' => $this->upload->data());
        
			$image_title     = $this->input->post('pwSTtJDdkm');
            $animal_name     = $this->input->post('MqeoMLLNyX');
            $file_type   = $data['upload_data']['file_type'];
            $file_path   = $data['upload_data']['file_path'];
            $raw_name    = $data['upload_data']['raw_name'];
            $orig_name   = $data['upload_data']['orig_name'];
            $client_name = $data['upload_data']['client_name'];
            $image_path  = $data['upload_data']['file_name'];
            $image_width     = $data['upload_data']['image_width'];
            $image_height    = $data['upload_data']['image_height'];
            $image_is_image  = $data['upload_data']['is_image'];
            $image_size_str  = $data['upload_data']['image_size_str'];
            $image_size      = $data['upload_data']['file_size'];
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
            $sql = "UPDATE ducks_third_image            
                    SET image_title3    = " . $this->db->escape($image_title) . ",
                        username3       = " . $this->db->escape($username) . ",
                        animal_name     = " . $this->db->escape($animal_name) . ",
                        file_type3      = " . $this->db->escape($file_type) . ",
                        image_path3     = " . $this->db->escape($file_path) . ",
                        raw_name3       = " . $this->db->escape($raw_name) . ",
                        orig_name3      = " . $this->db->escape($orig_name) . ",       
                        client_name3    = " . $this->db->escape($client_name) . ",
                        file_name3      = " . $this->db->escape($image_path) . ",
                        image_width3    = " . $this->db->escape($image_width) . ",
                        image_height3   = " . $this->db->escape($image_height) . ",
                        image_is_image3 = " . $this->db->escape($image_is_image) . ",
                        image_size_str3 = " . $this->db->escape($image_size_str) . ",
                        image_size3     = " . $this->db->escape($image_size) . "
                    WHERE animal_name   = " . $this->db->escape($animal_name) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sql);
    }
        
    public function ducks_do_upload_fourth(){
        $username = $this->session->userdata('username');
        // You can call any of this items using the Variable 
            // $upload_data
			$data = array('upload_data' => $this->upload->data());
        
            $image_title     = $this->input->post('pwSTtJDdkm');
            $animal_name     = $this->input->post('MqeoMLLNyX');
            $file_type   = $data['upload_data']['file_type'];
            $file_path   = $data['upload_data']['file_path'];
            $raw_name    = $data['upload_data']['raw_name'];
            $orig_name   = $data['upload_data']['orig_name'];
            $client_name = $data['upload_data']['client_name'];
            $image_path  = $data['upload_data']['file_name'];
            $image_width     = $data['upload_data']['image_width'];
            $image_height    = $data['upload_data']['image_height'];
            $image_is_image  = $data['upload_data']['is_image'];
            $image_size_str  = $data['upload_data']['image_size_str'];
            $image_size      = $data['upload_data']['file_size'];
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
            $sql = "UPDATE ducks_fourth_image            
                    SET image_title4    = " . $this->db->escape($image_title) . ",
                        username4       = " . $this->db->escape($username) . ",
                        animal_name     = " . $this->db->escape($animal_name) . ",
                        file_type4      = " . $this->db->escape($file_type) . ",
                        image_path4     = " . $this->db->escape($file_path) . ",
                        raw_name4       = " . $this->db->escape($raw_name) . ",
                        orig_name4      = " . $this->db->escape($orig_name) . ",       
                        client_name4    = " . $this->db->escape($client_name) . ",
                        file_name4      = " . $this->db->escape($image_path) . ",
                        image_width4    = " . $this->db->escape($image_width) . ",
                        image_height4   = " . $this->db->escape($image_height) . ",
                        image_is_image4 = " . $this->db->escape($image_is_image) . ",
                        image_size_str4 = " . $this->db->escape($image_size_str) . ",
                        image_size4     = " . $this->db->escape($image_size) . "
                    WHERE animal_name   = " . $this->db->escape($animal_name) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sql);
    }
    
    //Get all users table
    public function get_users(){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99');
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->row();
    }
        
     //Get all the row count
    public function return_row_count(){
        $this->db->from('ducks');
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }    
    
}