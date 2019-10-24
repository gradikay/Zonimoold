<?php 
class User_model extends CI_Model{
    
//////////////////Get plan expiration date////////////////////
    
    public function get_plan_expration_date(){
        
        $username = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->from('plan');
        $this->db->where("username ='$username'");
        
        $query = $this->db->get();
        
         return $query->row() ;
    }
    
    public function get_user_records(){
        
        $username = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->from('plan as P');
        $this->db->order_by("T.id", "desc");
        $this->db->join('plan_trans as T','P.username = T.username','INNER');
        $this->db->where("P.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->result() ;
    }
    
    public function get_plan_facts(){
        
        $username = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->from('plan as P');
        $this->db->join('plan_trans as T','P.username = T.username','INNER');
        $this->db->where("P.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->row() ;
    }
    
////////////////////////////////////////////////////////////
    public function feedback(){
        
        $data = $this->session->all_userdata();
        $ip_address    = $data['ip_address'];
        $user_agent    = $data['user_agent'];
        $last_activity = $data['last_activity'];
        $session_id    = $data['session_id'];
        //print_r($ip_address);
        //die();
        // Dont' forget to get the API address, the computer they use and everything else
		$username = $this->session->userdata('username');
        $name    = $this->input->post('name');
        $message = $this->input->post('message');
            
        $sql = "INSERT INTO feedback (name, username, ip_address, user_agent, last_activity, session_id, message)
            
            VALUES ("  . $this->db->escape($name) . ",
                    "  . $this->db->escape($username) . ",
                    "  . $this->db->escape($ip_address) . ",
                    "  . $this->db->escape($user_agent) . ",
                    "  . $this->db->escape($last_activity) . ",
                    "  . $this->db->escape($session_id) . ",
                    "  . $this->db->escape($message) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);    
    }
    
    public function send_message(){
        
        $from    = $this->session->userdata('username');
        $to      = $this->input->post('to');
        $message = $this->input->post('message');
        $subject = $this->input->post('subject');
            
        $sql = "INSERT INTO messages (from_user, to_user, user_message, subject)
            
            VALUES ("  . $this->db->escape($from) . ",
                    "  . $this->db->escape($to) . ",
                    "  . $this->db->escape($message) . ",
                    "  . $this->db->escape($subject) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);   
    }
    /*
     * Register the user
     */
    public function register(){
        
        /*
         * This is the old code use to insert my data into the database
        $data = array(
            'first_name'         => $this->input->post('first_name'),
            'last_name'          => $this->input->post('last_name'),
            'email'              => $this->input->post('email'),
            'username'           => $this->input->post('username'),
            'password'           => $this->input->post('password'),
            'gender'             => $this->input->post('sex'),
            'birthdate'          => $this->input->post('birthdate'),
            'termsAndConditions' => $this->input->post('termsAndConditions')
        );
        $insert = $this->db->insert('users', $data);
        return $insert;*/
        /*
         * This is my new code
         * Here we store our value into variables to make them easier to work with
         */
        
        
            $first_name         = $this->input->post('first_name');
            $last_name          = $this->input->post('last_name');
            $email              = $this->input->post('email');
            $username           = $this->input->post('username');
            // To salt the password $password = sha1($this->config->item('salt')
            // . $this->input->post('password') ); 
            // add some code into your config config.php file
            // reference check https://www.youtube.com/watch?v=2tQAmNdbp2w 4:11
            $password           = $this->input->post('password');
            $gender             = $this->input->post('sex');
            $birthdate          = $this->input->post('birthdate');
            $termsAndConditions = $this->input->post('termsAndConditions');
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
                $sql = "INSERT INTO users_maxy99zx99 (first_name, last_name, email, username, password, gender, birthdate, termsAndConditions)
            
                        VALUES ("  . $this->db->escape($first_name) . ",
                                "  . $this->db->escape($last_name) . ",
                                '" . $email . "',
                                "  . $this->db->escape($username) . ",
                                '" . $password . "',
                                "  . $this->db->escape($gender) . ",
                                "  .$this->db->escape($birthdate) . ",
                                "  .$this->db->escape($termsAndConditions) . ")";
                    // Return the result of this query
                $result = $this->db->query($sql);
        
                // This will help create the session so that it load all the set_userdata
                $sql = "INSERT INTO users_address (username)            
                        VALUES ("  .$this->db->escape($username) . ")";
                    // Return the result of this query
                $result = $this->db->query($sql);
        
               // This will help create the session so that it load all the set_userdata
                $sql = "INSERT INTO users_address_bill (username)            
                        VALUES ("  .$this->db->escape($username) . ")";
                    // Return the result of this query
                $result = $this->db->query($sql);
        
                // This will help create the session so that it load all the set_userdata
                $sql = "INSERT INTO users_credit_card (username)            
                        VALUES ("  .$this->db->escape($username) . ")";        
                    // Return the result of this query
                $result = $this->db->query($sql);
        
                    // This will help create the session so that it load all the set_userdata
                $sql = "INSERT INTO plan (username)            
                        VALUES ("  .$this->db->escape($username) . ")";        
                    // Return the result of this query
                $result = $this->db->query($sql);

             // This will help create the session so that it load all the set_userdata
                $sql = "INSERT INTO users_pp99_img (username)            
                        VALUES ("  .$this->db->escape($username) . ")";        
                    // Return the result of this query
                $result = $this->db->query($sql);

            
                if($this->db->affected_rows() === 1){
                    // We are taking this from our set_session( ) function
                   // $this->set_session($first_name, $last_name, $email, $username, $gender);

                    return $result;
                }
            }
/*
 * Posts or blog settings page
 
 */
    public function delete_post(){
        
        $id = $this->input->post('id');
         // This is the orig_name in our image1 page in the user controller
        $orig_name = $this->input->post('bogoter009');
        unlink("images/$orig_name");
        
        $this->db->select('*');
        $this->db->where("id ='$id' AND orig_name = '$orig_name'");
        $this->db->limit(1);
        $this->db->delete('blog');
    }
    
    public function edit_post(){
        
        
        $username   = $this->session->userdata('username');
        $id         = $this->input->post('id');
        $post_text  = $this->input->post('post_text');
        $post_title = $this->input->post('post_title');
        
         $sql = "UPDATE blog            
                    SET  post_text     = " . $this->db->escape($post_text) . ",
                         post_title    = " . $this->db->escape($post_title) . "
                  WHERE  id            = " . $this->db->escape($id) . " AND
                         username      = " . $this->db->escape($username) ." ";
        
        $result = $this->db->query($sql);
            //$result = $this->db->query($sql);
        return $result;
    }
    
    public function get_total_user_posts(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('blog AS B','B.username = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    
    
    public function post(){
        
        /*
         * This is the old code use to insert my data into the database
        $data = array(
            'post_title'         => $this->input->post('post_title'),
            'post_image'         => $this->input->post('post_image'),
            'post_text'          => $this->input->post('post_text'),
            'username'           => $this->input->post('username')
        );
        $insert = $this->db->insert('post', $data);
        return $insert;*/
        /*
         * This is my new code
         * Here we store our value into variables to make them easier to work with
         */
        
            // You can call any of this items using the Variable 
            // $upload_data
			$data = array('upload_data' => $this->upload->data());
        
            $post_title      = $this->input->post('post_title');
            $post_text       = $this->input->post('post_text');
            $username        = $this->input->post('username');
            $post_image      = $this->input->post('post_image');
            $file_ext        = $data['upload_data']['file_ext'];
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
                $sql = "INSERT INTO blog (post_title, post_text, username, post_image, file_ext, file_type, file_path, raw_name, orig_name, client_name, image_path, image_width, image_height, image_is_image, image_size_str, image_size)
            
            VALUES ("  . $this->db->escape($post_title) . ",
                    "  . $this->db->escape($post_text) . ",
                    "  . $this->db->escape($username) . ",
                    "  . $this->db->escape($post_image) . ",
                    " . $this->db->escape($file_ext) . ",
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
    
    
    public function video(){
        
        /*
         * This is the old code use to insert my data into the database
        $data = array(
            'post_title'         => $this->input->post('post_title'),
            'post_image'         => $this->input->post('post_image'),
            'post_text'          => $this->input->post('post_text'),
            'username'           => $this->input->post('username')
        );
        $insert = $this->db->insert('post', $data);
        return $insert;*/
        /*
         * This is my new code
         * Here we store our value into variables to make them easier to work with
         */
        
            // You can call any of this items using the Variable 
            // $upload_data
            $username =$this->session->userdata('username') ;
			$data = array('upload_data' => $this->upload->data());
        
            $video_title        = $this->input->post('video_title');
            $video_duration     = $this->input->post('video_duration');
            $video_description  = $this->input->post('video_description');
            $username           = $this->input->post('username');          
            $file_ext           = $data['upload_data']['file_ext'];
            $file_type          = $data['upload_data']['file_type'];
            $file_path          = $data['upload_data']['file_path'];
            $raw_name           = $data['upload_data']['raw_name']; 
            $orig_name          = $data['upload_data']['orig_name'];
            $client_name        = $data['upload_data']['client_name'];
            $file_name          = $data['upload_data']['file_name'];
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
                $sql = "INSERT INTO videos (video_title, video_duration, video_description, username, file_ext, file_type, file_path, raw_name, orig_name, client_name, file_name)
            
            VALUES (" . $this->db->escape($video_title) . ",
                    " . $this->db->escape($video_duration) . ",
                    " . $this->db->escape($video_description) . ",
                    " . $this->db->escape($username) . ",
                    " . $this->db->escape($file_ext) . ",
                    " . $this->db->escape($file_type) . ",
                    " . $this->db->escape($file_path) . ",
                    " . $this->db->escape($raw_name) . ",
                    " . $this->db->escape($orig_name) . ",
                    " . $this->db->escape($client_name) . ",
                    " . $this->db->escape($file_name) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);
            
    }
    
    public function get_postdetails($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('blog AS B','B.username = U.username','INNER');
        $this->db->Where('U.username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
        
        //$this->db->select('*') ;
        //$this->db->from('blog') ;
        
        //$query = $this->db->get();
            // You have to return row() if you want to each item in you database
        //return $query->result();
    }
/*
 * Images settings
 */    
    public function get_userimages($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('animal_image AS A','A.username = U.username','INNER');
		$this->db->order_by("A.id", "desc");
        $this->db->Where('U.username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
        
        //$this->db->select('*') ;
        //$this->db->from('blog') ;
        
        //$query = $this->db->get();
            // You have to return row() if you want to each item in you database
        //return $query->result();
    }
    
    public function delete_image(){
        
        $id = $this->input->post('id');
            // This is the orig_name in our image1 page in the user controller
        $orig_name = $this->input->post('bogota009');
        		
        unlink("images/small/$orig_name");
        unlink("images/extra_small/$orig_name");
        unlink("images/medium/$orig_name");
        unlink("images/large/$orig_name");
        unlink("images/extra_large/$orig_name");
        unlink("images/original/$orig_name");
		
        $this->db->select('*');
        $this->db->where("id ='$id' AND orig_name = '$orig_name'");
        $this->db->limit(1);
        $this->db->delete('animal_image');
    }
    
    public function delete_image2(){
        
        $id = $this->input->post('id');
            // This is the orig_name in our image2 page in the user controller
        $orig_name = $this->input->post('006878k0k');
        unlink("images/$orig_name");
        
        $this->db->select('*');
        $this->db->where("id ='$id' AND orig_name = '$orig_name'");
        $this->db->limit(1);
        $this->db->delete('animal_image_user');
    }
    
    public function get_total_user_imagesfact(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('animal_image AS A','A.username = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    public function get_total_user_images(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('animal_image_user AS A','A.username = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    
    public function get_total_user_images_prof(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_pp99_img');
        $this->db->where("username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    
    public function get_userimages2($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('animal_image_user AS A','A.username = U.username','INNER');
		$this->db->order_by("A.id", "desc");
        $this->db->Where('U.username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
        
        //$this->db->select('*') ;
        //$this->db->from('blog') ;
        
        //$query = $this->db->get();
            // You have to return row() if you want to each item in you database
        //return $query->result();
    }
    
    public function get_userimages3($username){
        
        $this->db->select('*');
        $this->db->from('users_pp99_img');
		$this->db->order_by("id", "desc");
        $this->db->Where('username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
        
        //$this->db->select('*') ;
        //$this->db->from('blog') ;
        
        //$query = $this->db->get();
            // You have to return row() if you want to each item in you database
        //return $query->result();
    }
    
    public function upload_image(){
        // You can call any of this items using the cariable 
            // $upload_data
			$data = array('upload_data' => $this->upload->data());
        
            $image_title     = $this->input->post('image_title');
        
            $username        = $this->session->userdata('username');
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
        
            $cr_im            = $this->input->post('cr_im');
            $im = $cr_im;

            list($type, $im) = explode("]", $im);
            $im = base64_decode($im);
            
            $cropped_name =  'cropped_' . $raw_name .'.png';
            file_put_contents("./images/cropped/$cropped_name", $im);
        
            $conf["watermarking"]['source_image']  = "./images/cropped/$cropped_name";      
            $conf["watermarking"]['image_library'] = 'gd2';
            $conf["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermarksmall.gif';
            $conf["watermarking"]['wm_type']          = 'overlay';
            // This is the opacity of the applied watermarking
            $conf["watermarking"]['wm_opacity']       = '10';
            // This is the alignement
            $conf["watermarking"]['new_image']        = './images/cropped';
            $conf["watermarking"]['wm_vrt_alignment'] = 'middle';
            $conf["watermarking"]['wm_hor_alignment'] = 'center';
			$conf["watermarking"]['create_thumb']     = FALSE;

            $this->image_lib->initialize($conf["watermarking"]);
            $this->image_lib->watermark();
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
            $sql = "INSERT INTO animal_image_user (image_title, image, username, file_type, file_path, raw_name, orig_name, client_name, image_path, image_width, image_height, cropped_name, cropped_data, image_is_image, image_size_str, image_size)
            
            VALUES (" . $this->db->escape($image_title) . ",
                    " . $this->db->escape($image) . ",
                    " . $this->db->escape($username) . ",
                    " . $this->db->escape($file_type) . ",
                    " . $this->db->escape($file_path) . ",
                    " . $this->db->escape($raw_name) . ",
                    " . $this->db->escape($orig_name) . ",
                    " . $this->db->escape($client_name) . ",
                    " . $this->db->escape($image_path) . ",
                    " . $this->db->escape($image_width) . ",
                    " . $this->db->escape($image_height) . ",
                    " . $this->db->escape($cropped_name) . ",
                    " . $this->db->escape($im) . ",
                    " . $this->db->escape($image_is_image) . ",
                    " . $this->db->escape($image_size_str) . ",
                    " . $this->db->escape($image_size) . ")";
        // Return the result of this query
            $result = $this->db->query($sql);
    }
    
    public function get_uservideos($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('videos AS V','V.username = U.username','INNER');
        $this->db->Where('U.username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
        
        //$this->db->select('*') ;
        //$this->db->from('blog') ;
        
        //$query = $this->db->get();
            // You have to return row() if you want to each item in you database
        //return $query->result();
    }
    
    public function get_usermessages($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('messages AS M','M.to_user = U.username','INNER');
        $this->db->order_by("id", "desc");
        $this->db->Where('U.username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    public function get_total_user_messages(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('messages AS M','M.to_user = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    
    public function get_usersentmessages($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('messages AS M','M.from_user = U.username','INNER');
        $this->db->order_by("id", "desc");
        $this->db->Where('U.username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    public function get_total_user_messagessent(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('messages AS M','M.from_user = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    
    public function offer(){
        
        /*
         * This is the old code use to insert my data into the database
        $data = array(
            'post_title'         => $this->input->post('post_title'),
            'post_image'         => $this->input->post('post_image'),
            'post_text'          => $this->input->post('post_text'),
            'username'           => $this->input->post('username')
        );
        $insert = $this->db->insert('post', $data);
        return $insert;*/
        /*
         * This is my new code
         * Here we store our value into variables to make them easier to work with
         */
        
            // You can call any of this items using the Variable 
            // $upload_data
            $username = $this->session->userdata('username');
            $plan     = $this->session->userdata('plan_name');
			$data     = array('upload_data' => $this->upload->data());
        
            $pet_kind        = $this->input->post('pet_kind');
            $regular_price   = $this->input->post('regular_price');
            $asking_price    = $this->input->post('asking_price');
            $pet_name        = $this->input->post('pet_name');
            $pet_breed       = $this->input->post('pet_breed');
            $pet_color       = $this->input->post('pet_color');
            $pet_agenumber   = $this->input->post('pet_agenumber');
            $pet_ageperiod   = $this->input->post('pet_ageperiod');
            $pet_sex         = $this->input->post('pet_sex');
            $shipping_info   = $this->input->post('shipping_info');
            $more_aboutpet   = $this->input->post('more_aboutpet');          
            //=$username        = $this->input->post('username');          
            $file_ext        = $data['upload_data']['file_ext'];
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
        
            if($this->session->userdata('plan_name') == 'mayfly'){
                
                    // Here we are getting the current time ... This is not the user time it's the     
                    // Webmaster date    
                $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                    // This will produce a different behavior if called after the variable $thirty at the bottom
                $time_created = date_format($date,"Y-m-d H:i:sP");

                    // Here we  add 30 days to the time_created for the expiration of the suscription
                $thirty = date_modify($date,"+62 hours");

                    //Here we format the date so that it matches our database dateTime field
                $time_expires = date_format($thirty,"Y-m-d H:i:sP");
                
                $sql = "UPDATE plan            
                   SET mayfly_offer_count = `mayfly_offer_count` - 1 
                 WHERE username    = "  . $this->db->escape($username) . " ";
                    // Return the result of this query
                 $result = $this->db->query($sql);
                
            } elseif($this->session->userdata('plan_name') == 'agama'){

                    // Here we are getting the current time ... This is not the user time it's the     
                    // Webmaster date    
                $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                    // This will produce a different behavior if called after the variable $thirty at the bottom
                $time_created = date_format($date,"Y-m-d H:i:sP");

                    // Here we  add 30 days to the time_created for the expiration of the suscription
                $thirty = date_modify($date,"+30 days");
 
                    //Here we format the date so that it matches our database dateTime field
                $time_expires = date_format($thirty,"Y-m-d H:i:sP");
                
            } elseif($this->session->userdata('plan_name') == 'okapi'){
                
                    // Here we are getting the current time ... This is not the user time it's the     
                    // Webmaster date    
                $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                    // This will produce a different behavior if called after the variable $thirty at the bottom
                $time_created = date_format($date,"Y-m-d H:i:sP");

                    // Here we  add 30 days to the time_created for the expiration of the suscription
                $thirty = date_modify($date,"+30 days");

                    //Here we format the date so that it matches our database dateTime field
                $time_expires = date_format($thirty,"Y-m-d H:i:sP");
                
            } elseif($this->session->userdata('plan_name') == 'eagle'){
                
                    // Here we are getting the current time ... This is not the user time it's the     
                    // Webmaster date    
                $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                    // This will produce a different behavior if called after the variable $thirty at the bottom
                $time_created = date_format($date,"Y-m-d H:i:sP");

                    // Here we  add 30 days to the time_created for the expiration of the suscription
                $thirty = date_modify($date,"+30 days");

                    //Here we format the date so that it matches our database dateTime field
                $time_expires = date_format($thirty,"Y-m-d H:i:sP");
                
            }
        
            $cr_im            = $this->input->post('cr_im');
            $im = $cr_im;

            list($type, $im) = explode("]", $im);
            $im = base64_decode($im);
            
            $cropped_name =  'cropped' . $raw_name .'.png';
            file_put_contents("./offimages/$cropped_name", $im);
            
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
                $sql = "INSERT INTO offers (pet_kind, regular_price, asking_price, pet_name, pet_breed, pet_color, pet_agenumber, pet_ageperiod, pet_sex, shipping_info, more_aboutpet, plan_name, username, file_ext, file_type, file_path, raw_name, orig_name, client_name, image_path, image_width, image_height, image_is_image, image_size_str, cropped_data, cropped_name, time_created, time_expires, image_size)
            
            VALUES (" . $this->db->escape($pet_kind) . ",
                    " . $this->db->escape($regular_price) . ",
                    " . $this->db->escape($asking_price) . ",
                    " . $this->db->escape($pet_name) . ",
                    " . $this->db->escape($pet_breed) . ",
                    " . $this->db->escape($pet_color) . ",
                    " . $this->db->escape($pet_agenumber) . ",
                    " . $this->db->escape($pet_ageperiod) . ",
                    " . $this->db->escape($pet_sex) . ",
                    " . $this->db->escape($shipping_info) . ",
                    " . $this->db->escape($more_aboutpet) . ",
                    " . $this->db->escape($plan) . ",
                    " . $this->db->escape($username) . ",
                    " . $this->db->escape($file_ext) . ",
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
                    " . $this->db->escape($im) . ",
                    " . $this->db->escape($cropped_name) . ",
                    '" . $time_created . "',
                    '" . $time_expires . "',
                    " . $this->db->escape($image_size) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);
            
    }
// We are retreiving the $username from the table and throwing it to the url    
    public function get_user_offers($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('offers AS O','O.username = U.username','INNER');
        $this->db->order_by("id", "desc");
        $this->db->Where('U.username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    public function get_total_user_offers(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('offers AS O','O.username = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    
    public function get_total_user_orders(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('orders AS O','O.seller = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    
    public function offer_orders($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('orders AS O','O.seller = U.username','INNER');
        $this->db->Where('U.username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    public function reject_off(){
        
        $id = $this->input->post('id');
        
        $this->db->select('*');
        $this->db->where('id ='. $id);
        $this->db->limit(1);
        $this->db->delete('orders');
    }
    
    public function offer_delete(){
                
            $id = $this->input->post('id');
        
            $this->db->select('*');
            $this->db->from('offers');
            $this->db->where('id ='. $id);
        
            //Here we get those items
            $query = $this->db->get();

            foreach ($query->result() as $row)
            {            
                $data = array(   
                    'username'       => $row->username,
                    'plan_name'      => $row->plan_name,
                    'pet_kind'       => $row->pet_kind,
                    'regular_price'  => $row->regular_price,
                    'asking_price'   => $row->asking_price,
                    'pet_name'       => $row->pet_name,
                    'pet_breed'      => $row->pet_breed,
                    'pet_color'      => $row->pet_color,
                    'pet_ageperiod'  => $row->pet_ageperiod,
                    'pet_agenumber'  => $row->pet_agenumber,
                    'pet_sex'        => $row->pet_sex,
                    'shipping_info'  => $row->shipping_info,
                    'more_aboutpet'  => $row->more_aboutpet,
                    'post_image'     => $row->post_image,
                    'image_path'     => $row->image_path,
                    'file_path'      => $row->file_path,
                    'file_type'      => $row->file_type,
                    'file_ext'       => $row->file_ext,
                    'raw_name'       => $row->raw_name,
                    'orig_name'      => $row->orig_name,
                    'client_name'    => $row->client_name,
                    'file_name'      => $row->file_name,
                    'image_width'    => $row->image_width,
                    'image_height'   => $row->image_height,
                    'image_is_image' => $row->image_is_image,
                    'image_size_str' => $row->image_size_str,   
                    'image_size'     => $row->image_size,   
                    'posted_day'     => $row->posted_day,   

                );
                $username       = $data['username'];
                $plan_name      = $data['plan_name'];
                $pet_kind       = $data['pet_kind'];
                $regular_price  = $data['regular_price'];
                $asking_price   = $data['asking_price'];
                $pet_name       = $data['pet_name'];
                $pet_breed      = $data['pet_breed'];
                $pet_color      = $data['pet_color'];
                $pet_ageperiod  = $data['pet_ageperiod'];
                $pet_agenumber  = $data['pet_agenumber'];
                $pet_sex        = $data['pet_sex'];
                $shipping_info  = $data['shipping_info'];
                $more_aboutpet  = $data['more_aboutpet'];
                $post_image     = $data['post_image'];
                $image_path     = $data['image_path'];
                $file_path      = $data['file_path'];
                $file_type      = $data['file_type'];
                $file_ext       = $data['file_ext'];
                $raw_name       = $data['raw_name'];
                $orig_name      = $data['orig_name'];
                $client_name    = $data['client_name'];
                $file_name      = $data['file_name'];
                $image_width    = $data['image_width'];
                $image_height   = $data['image_height'];
                $image_is_image = $data['image_is_image'];
                $image_size_str = $data['image_size_str'];
                $image_size     = $data['image_size'];
                $posted_day     = $data['posted_day'];
                //print_r($username);
                //print_r($data);
                //die();
            //We are escaping from space and quotes
            // We are assigning the table row to some value
                    $sql = "INSERT INTO offers_deleted (username, plan_name, pet_kind, regular_price, asking_price, pet_name, pet_breed, pet_color, pet_ageperiod, pet_agenumber, pet_sex, shipping_info, more_aboutpet, post_image, image_path, file_path, file_type, file_ext, raw_name, orig_name, client_name, file_name, image_width, image_height, image_is_image, image_size_str, image_size, posted_day)

                            VALUES ("  . $this->db->escape($username) . ",
                                    '" . $plan_name . "',
                                    "  . $this->db->escape($pet_kind) . ",
                                    "  . $this->db->escape($regular_price) . ",
                                    "  . $this->db->escape($asking_price) . ",
                                    "  . $this->db->escape($pet_name) . ",
                                    "  . $this->db->escape($pet_breed) . ",
                                    "  . $this->db->escape($pet_color) . ",
                                    "  . $this->db->escape($pet_ageperiod) . ",
                                    "  . $this->db->escape($pet_agenumber) . ",
                                    "  . $this->db->escape($pet_sex) . ",
                                    "  . $this->db->escape($shipping_info) . ",
                                    "  . $this->db->escape($more_aboutpet) . ",
                                    "  . $this->db->escape($post_image) . ",
                                    '" . $image_path . "',
                                    '" . $file_path . "',
                                    '" . $file_type . "',
                                    '" . $file_ext . "',
                                    '" . $raw_name . "',
                                    '" . $orig_name . "',
                                    '" . $client_name . "',
                                    '" . $file_name . "',
                                    '" . $image_width . "',
                                    '" . $image_height . "',
                                    '" . $image_is_image . "',
                                    '" . $image_size_str . "',
                                    '" . $image_size . "',
                                    "  . $this->db->escape($posted_day) . ")";
                        // Return the result of this query
                    $result = $this->db->query($sql);

            // We get the post directly from the submited data rather that from our controller

            $this->db->where('id', $id);
            $this->db->limit(1);
            $this->db->delete('offers');
        }
    }
    
    public function offer_update(){
        
        
        $username      = $this->session->userdata('username');
        $id            = $this->input->post('id');
        $asking_price  = $this->input->post('asking_price');
        $regular_price = $this->input->post('regular_price');
        $pet_name      = $this->input->post('pet_name');
        $pet_breed     = $this->input->post('pet_breed');
        $pet_color     = $this->input->post('pet_color');
        $pet_agenumber = $this->input->post('pet_agenumber');
        $pet_ageperiod = $this->input->post('pet_ageperiod');
        $pet_sex       = $this->input->post('pet_sex');
        $shipping_info = $this->input->post('shipping_info');
        $more_aboutpet = $this->input->post('more_aboutpet');
        
         $sql = "UPDATE offers            
                    SET  asking_price  = " . $this->db->escape($asking_price) . ",
                         regular_price = " . $this->db->escape($regular_price) . ",
                         pet_name      = " . $this->db->escape($pet_name) . ",
                         pet_breed     = " . $this->db->escape($pet_breed) . ",
                         pet_color     = " . $this->db->escape($pet_color) . ",
                         pet_agenumber = " . $this->db->escape($pet_agenumber) . ",
                         pet_ageperiod = " . $this->db->escape($pet_ageperiod) . ",
                         pet_sex       = " . $this->db->escape($pet_sex) . ",
                         shipping_info = " . $this->db->escape($shipping_info) . ",
                         more_aboutpet = " . $this->db->escape($more_aboutpet) . "
                  WHERE  id            = " . $this->db->escape($id) . " AND
                         username      = " . $this->db->escape($username) ." ";
        
        $result = $this->db->query($sql);
            //$result = $this->db->query($sql);
        return $result;
    }
    
    
    
/*
 * Logging in the user
 */
    
    public function login($username, $password){
        
        //validate
        $this->db->where('username',$username);
        $this->db->where('password',$password);  
        
        $query = $this->db->get('users_maxy99zx99');
        // Here we check if the user matche with the one 
        // in our database
        if($query->num_rows() === 1){
            
            return true;
            
        } else {
            
            return false;
        }
        
    }
    
    public function get_users(){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99');
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->row();
    }
    
        /**
         * When you define a variable like the example below make sure that its not the index page 
         * Because the variable will get it value from the url 
         * 
         */
    public function get_user($username){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99');
        $this->db->where('username',$username);
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->row();
    }
	
	public function get_user_for_admin(){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99');
		$this->db->order_by('join_date desc') ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
	public function get_ten_user_for_admin(){
        
        $this->db->select('*');
        $this->db->from('users_maxy99zx99');
		$this->db->order_by('join_date desc') ;
        $this->db->limit(10) ;
        
        $query = $this->db->get();
		
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
	public function get_total_user_for_admin(){
        
        $this->db->from('users_maxy99zx99');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
	public function get_visiters_for_admin(){
        
        $this->db->select('*');
        $this->db->from('ci_sessions');
		$this->db->order_by("last_activity desc");
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
	
	public function get_ten_visiters_for_admin(){
        
        $this->db->select('*');
        $this->db->from('ci_sessions');
		$this->db->order_by("last_activity desc");
        $this->db->limit(10) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
	public function get_total_visitors_for_admin(){
        
        $this->db->from('ci_sessions');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
	public function get_feedback_for_admin(){
        
        $this->db->select('*');
        $this->db->from('feedback');
		$this->db->order_by("send_on desc");
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
	public function get_ten_feedbacks_for_admin(){
        
        $this->db->select('*');
        $this->db->from('feedback');
		$this->db->order_by("send_on desc");
        $this->db->limit(10) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
	public function get_total_feedbacks_for_admin(){
        
        $this->db->from('feedback');
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
    
    /*
     * Here we are setting up our session customes
     * Then we pass it up in register()
    public function set_session($first_name, $last_name, $email, $username, $gender){
        // Here we select the email because apart from the id
        // it also is unique
        $sql = "SELECT user_id FROM users WHERE email = '" . $email ."' LIMIT 1";
        $result = $this->db->query($sql);
        // The $row takes/and/or returns a single item
        $row = $result->row();
        
        $sess_data = array(
            'user_id'    => $row->user_id,
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'username'   => $username,
            'gender'     => $gender,
            'logged_in'  => TRUE //Change this to 'logged_in' => 0 when in production for the user comfirmations
        );
        $this->session->set_userdata($sess_data);      
    }   
     */
/*
 * Update settings
 */ 
    public function update_setting(){
        
        $username       = $this->session->userdata('username');
        $address        = $this->input->post('address');
        $address_line_2 = $this->input->post('address_line_2');
        $city           = $this->input->post('city');
        $state          = $this->input->post('state');
        $zip_code       = $this->input->post('zip_code');
        
        $this->session->set_userdata('address', $address);
        $this->session->set_userdata('address_line_2', $address_line_2);
        $this->session->set_userdata('city', $city);
        $this->session->set_userdata('state', $state);
        $this->session->set_userdata('zip_code', $zip_code);
        
        $sql = "UPDATE users_address            
                    SET  address        = " . $this->db->escape($address) . ",
                         address_line_2 = " . $this->db->escape($address_line_2) . ",
                         city           = " . $this->db->escape($city) . ",
                         state          = " . $this->db->escape($state) . ",
                         zip_code       = " . $this->db->escape($zip_code) . "
                    WHERE username      = " . $this->db->escape($username ) ." ";
                               
        // Return the result of this query
            $result = $this->db->query($sql);
            //$result = $this->db->query($sql);
            return $result;
        
        
    }
    
    public function update_setting_bill(){
        
        $username       = $this->session->userdata('username_bill');
        $address        = $this->input->post('address_bill');
        $address_line_2 = $this->input->post('address_line_2_bill');
        $city           = $this->input->post('city_bill');
        $state          = $this->input->post('state_bill');
        $zip_code       = $this->input->post('zip_code_bill');
        
        $this->session->set_userdata('address_bill', $address);
        $this->session->set_userdata('address_line_2_bill', $address_line_2);
        $this->session->set_userdata('city_bill', $city);
        $this->session->set_userdata('state_bill', $state);
        $this->session->set_userdata('zip_code_bill', $zip_code);
        
        $sql = "UPDATE users_address_bill            
                    SET  address_bill        = " . $this->db->escape($address) . ",
                         address_line_2_bill = " . $this->db->escape($address_line_2) . ",
                         city_bill           = " . $this->db->escape($city) . ",
                         state_bill          = " . $this->db->escape($state) . ",
                         zip_code_bill       = " . $this->db->escape($zip_code) . "
                    WHERE username           = " . $this->db->escape($username ) ." ";
                               
        // Return the result of this query
            $result = $this->db->query($sql);
            //$result = $this->db->query($sql);
            return $result;
        
        
    }
/*
 * Ads settings 
 */    
     public function report(){
        
        $username = $this->session->userdata('username');
        
         $i = 1; 
           // We are just using foreach for the $i we are not using the $row variable and still work
        foreach ($this->User_model->get_ad() as $row){
            
        $report          = $this->input->post($i.'re009919');
        $ad_id           = $this->input->post($i.'f0098');
        $ad_username     = $this->input->post($i.'x0098');
        $ad_company_name = $this->input->post($i.'i0078');
        $ad_url          = $this->input->post($i.'o007');
        $report_message  = $this->input->post('dfg34535345K'.$i);
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
        $sql = "INSERT INTO report_ad (username , report, ad_id, ad_username, ad_company_name, ad_url, report_message)            
                VALUES (" . $this->db->escape($username ) . ",
                        " . $this->db->escape($report) . ",
                        " . $this->db->escape($ad_id) . ",
                        " . $this->db->escape($ad_username) . ",
                        " . $this->db->escape($ad_company_name) . ",
                        " . $this->db->escape($ad_url) . ",
                        " . $this->db->escape($report_message) . ")";
                    // Return the result of this query
                $result = $this->db->query($sql);
           
        }
    }
    
    public function upload_ad(){
        
            // You can call any of this items using the Variable 
            // $upload_data
            // This variable data is set to retreive the array for the picture file_ext ect...
			$data     = array('upload_data' => $this->upload->data());
        
            $username        = $this->session->userdata('username');
            $company_name    = $this->input->post('company_name');
            $target_gender   = $this->input->post('target_gender');
            $target_age_from = $this->input->post('target_age_from');
            $target_age_to   = $this->input->post('target_age_to');
            $ad_id            = $this->input->post('ad_id');
            $catchy_word     = $this->input->post('catchy_word');
            $description     = $this->input->post('description');
            $url             = $this->input->post('url');
            $call_to_action  = $this->input->post('call_to_action');          
            $file_ext        = $data['upload_data']['file_ext'];
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
        
            $this->session->set_userdata('ad_id', $ad_id);
            $this->session->set_userdata('ad_company_name', $company_name);
            $this->session->set_userdata('ad_target_gender', $target_gender);
            $this->session->set_userdata('ad_target_age_from', $target_age_from);
            $this->session->set_userdata('ad_target_age_to', $target_age_to);
            $this->session->set_userdata('ad_catchy_word', $catchy_word);
            $this->session->set_userdata('ad_description', $description);
            $this->session->set_userdata('ad_url', $url);
            $this->session->set_userdata('ad_call_to_action', $call_to_action);
            $this->session->set_userdata('ad_client_name', $client_name);
        //We are escaping from space and quotes
        // We are assigning the table row to some value
               // $sql = "INSERT INTO ads (company_name, target_gender, target_age_from, target_age_to, plan, catchy_word, description, url, call_to_action, username, file_ext, file_type, file_path, raw_name, orig_name, client_name, image_path, image_width, image_height, image_is_image, image_size_str, image_size)
                
            $cr_im            = $this->input->post('cr_im');
            $im = $cr_im;

            list($type, $im) = explode("]", $im);
            $im = base64_decode($im);
            
            $cropped_name =  'cropped' . $raw_name .'.png';
            file_put_contents("./adsimages/$cropped_name", $im);
        
                $sql = "INSERT INTO ads (company_name, ad_id, target_gender, target_age_from, target_age_to, catchy_word, description, url, call_to_action, username, file_ext, file_type, cropped_data, cropped_name, file_path, raw_name, orig_name, client_name, image_path, image_width, image_height, image_is_image, image_size_str, image_size)
            
            VALUES (" . $this->db->escape($company_name) . ",
                    " . $this->db->escape($ad_id) . ",
                    " . $this->db->escape($target_gender) . ",
                    " . $this->db->escape($target_age_from) . ",
                    " . $this->db->escape($target_age_to) . ",
                    " . $this->db->escape($catchy_word) . ",
                    " . $this->db->escape($description) . ",
                    " . $this->db->escape($url) . ",
                    " . $this->db->escape($call_to_action) . ",
                    " . $this->db->escape($username) . ",
                    " . $this->db->escape($file_ext) . ",
                    " . $this->db->escape($file_type) . ",
                    " . $this->db->escape($im) . ",
                    " . $this->db->escape($cropped_name) . ",
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
    
    // Upload profile image
    public function upload_imp(){
        
            // You can call any of this items using the Variable 
            // $upload_data
            // This variable data is set to retreive the array for the picture file_ext ect...
			$data     = array('upload_data' => $this->upload->data());
        
            $file_ext        = $data['upload_data']['file_ext'];
            $file_type       = $data['upload_data']['file_type'];
            $file_path       = $data['upload_data']['file_path'];
            $raw_name        = $data['upload_data']['raw_name'];
            $orig_name       = $data['upload_data']['orig_name'];
            $client_name     = $data['upload_data']['client_name'];
            $file_name       = $data['upload_data']['file_name'];
            $image_width     = $data['upload_data']['image_width'];
            $image_height    = $data['upload_data']['image_height'];
            $is_image        = $data['upload_data']['is_image'];
            $image_size_str  = $data['upload_data']['image_size_str'];
            $file_size       = $data['upload_data']['file_size'];
                  
            $cr_im            = $this->input->post('cr_im');
            $im = $cr_im;

            list($type, $im) = explode("]", $im);
            $im = base64_decode($im);
            
            $cropped_name = $raw_name . 'cropped.png';
            file_put_contents("./improf/$cropped_name", $im);
            
        
            $username = $this->session->userdata('username');
        
        
        $sql = "INSERT INTO users_pp99_img (username, file_ext, file_type, file_path, raw_name, orig_name, client_name, file_name, imag_width, imag_height, is_image, cropped_name, cropped_data, image_size_str, file_size)
            
            VALUES (" . $this->db->escape($username) . ",
                    " . $this->db->escape($file_ext) . ",
                    " . $this->db->escape($file_type) . ",
                    " . $this->db->escape($file_path) . ",
                    " . $this->db->escape($raw_name) . ",
                    " . $this->db->escape($orig_name) . ",
                    " . $this->db->escape($client_name) . ",
                    " . $this->db->escape($file_name) . ",
                    " . $this->db->escape($image_width) . ",
                    " . $this->db->escape($image_height) . ",
                    " . $this->db->escape($is_image) . ",
                    " . $this->db->escape($cropped_name) . ",
                    " . $this->db->escape($im) . ",
                    " . $this->db->escape($image_size_str) . ",
                    " . $this->db->escape($file_size) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);
            
    }
    
    public function get_im_profile(){
        
        $username = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->from('users_pp99_img');
        $this->db->order_by("id", "desc");
        $this->db->where("username ='$username'");
        
        $query = $this->db->get();
        
         return $query->row() ;
    }
    
    public function get_ads(){ 
        
        // This will make so that it displays different content from different user
        $this->db->select('* , RAND() as rand') ;
        $this->db->from('ads') ;
        // Here we are calling the RAND() that we have change as rand
        $this->db->order_by('rand') ;
        $this->db->limit(4) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    public function get_ad(){ 
        $this->db->from('ads') ;
        $this->db->limit(1) ;
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    // Get user ads
    public function get_my_ads($username){
        $this->db->select('*');
        $this->db->from('ads');
        $this->db->order_by("id", "desc");
        $this->db->Where('username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    public function delete_ad(){
        
        $id = $this->input->post('id');
        // This is the orig_name in our lostfound page in the user controller
        $orig_name = $this->input->post('00778kochk');
        unlink("adsimages/$orig_name");
        
        $this->db->select('*');
        $this->db->where("id ='$id' AND orig_name = '$orig_name'");
        $this->db->limit(1);
        $this->db->delete('ads');
    }
    
    public function get_total_user_ads(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('ads AS A','A.username = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
/*
 * Insert lost pet datas
 */    
    public function upload_lpet(){
        
            // You can call any of this items using the Variable 
            // $upload_data
            // This variable data is set to retreive the array for the picture file_ext ect...
			$data     = array('upload_data' => $this->upload->data());
        
            $username        = $this->session->userdata('username');
            $pet_name        = $this->input->post('pet_name');
            $pet_breed       = $this->input->post('pet_breed');
            $pet_color       = $this->input->post('pet_color');
            $pet_gender      = $this->input->post('pet_gender');
            $pet_agenumber   = $this->input->post('pet_agenumber');
            $pet_ageperiod   = $this->input->post('pet_ageperiod');
            $lost_id         = $this->input->post('lost_id');
            $pet_micro       = $this->input->post('pet_micro');
            $missing_since   = $this->input->post('missing_since');
            $pet_location    = $this->input->post('pet_location');          
            $description     = $this->input->post('description');          
            $file_ext        = $data['upload_data']['file_ext'];
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
        
            $this->session->set_userdata('lost_id', $lost_id);
            $this->session->set_userdata('lost_pet_name', $pet_name);
            $this->session->set_userdata('lost_pet_breed', $pet_breed);
            $this->session->set_userdata('lost_pet_color', $pet_color);
            $this->session->set_userdata('lost_pet_gender', $pet_gender);
            $this->session->set_userdata('lost_pet_agenumber', $pet_agenumber);
            $this->session->set_userdata('lost_pet_ageperiod', $pet_ageperiod);
            $this->session->set_userdata('lost_pet_micro', $pet_micro);
            $this->session->set_userdata('lost_missing_since', $missing_since);
            $this->session->set_userdata('lost_pet_location', $pet_location);
            $this->session->set_userdata('lost_description', $description);
            $this->session->set_userdata('lost_client_name', $client_name);
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
                $sql = "INSERT INTO pet_lost (pet_name, pet_breed, pet_color, pet_gender, pet_agenumber, pet_ageperiod, lost_id, pet_micro, missing_since, pet_location, description, username, file_ext, file_type, file_path, raw_name, orig_name, client_name, image_path, image_width, image_height, image_is_image, image_size_str, image_size)
            VALUES (" . $this->db->escape($pet_name) . ",
                    " . $this->db->escape($pet_breed) . ",
                    " . $this->db->escape($pet_color) . ",
                    " . $this->db->escape($pet_gender) . ",
                    " . $this->db->escape($pet_agenumber) . ",
                    " . $this->db->escape($pet_ageperiod) . ",
                    " . $this->db->escape($lost_id) . ",
                    " . $this->db->escape($pet_micro) . ",
                    " . $this->db->escape($missing_since) . ",
                    " . $this->db->escape($pet_location) . ",
                    " . $this->db->escape($description) . ",
                    " . $this->db->escape($username) . ",
                    " . $this->db->escape($file_ext) . ",
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
    
/* 
 * Insert Found pet datas
 */    
    public function upload_fpet(){
        
            // You can call any of this items using the Variable 
            // $upload_data
            // This variable data is set to retreive the array for the picture file_ext ect...
			$data     = array('upload_data' => $this->upload->data());
        
            $username        = $this->session->userdata('username');
            $pet_name        = $this->input->post('pet_name');
            $pet_breed       = $this->input->post('pet_breed');
            $pet_color       = $this->input->post('pet_color');
            $pet_gender      = $this->input->post('pet_gender');
            $pet_agenumber   = $this->input->post('pet_agenumber');
            $pet_ageperiod   = $this->input->post('pet_ageperiod');
            $missing_since   = $this->input->post('missing_since');
            $pet_micro       = $this->input->post('pet_micro');
            $pet_location    = $this->input->post('pet_location');          
            $description     = $this->input->post('description');          
            $file_ext        = $data['upload_data']['file_ext'];
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
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+30 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");
        
        //We are escaping from space and quotes
        // We are assigning the table row to some value
                $sql = "INSERT INTO pet_found (pet_name, pet_breed, pet_color, pet_gender, pet_agenumber, pet_ageperiod, pet_micro,missing_since, pet_location, description, username, file_ext, file_type, file_path, raw_name, orig_name, client_name, image_path, image_width, image_height, image_is_image, image_size_str, time_created, time_expires, image_size)
            
            VALUES (" . $this->db->escape($pet_name) . ",
                    " . $this->db->escape($pet_breed) . ",
                    " . $this->db->escape($pet_color) . ",
                    " . $this->db->escape($pet_gender) . ",
                    " . $this->db->escape($pet_agenumber) . ",
                    " . $this->db->escape($pet_ageperiod) . ",
                    " . $this->db->escape($pet_micro) . ",
                    " . $this->db->escape($missing_since) . ",
                    " . $this->db->escape($pet_location) . ",
                    " . $this->db->escape($description) . ",
                    " . $this->db->escape($username) . ",
                    " . $this->db->escape($file_ext) . ",
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
                    " . $this->db->escape($time_created) . ",
                    " . $this->db->escape($time_expires) . ",
                    " . $this->db->escape($image_size) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);
            
    }
    
    public function get_lostpets($username){
        
        $this->db->select('*');
        $this->db->from('pet_lost');
        $this->db->order_by("id", "desc");
        $this->db->Where('username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    public function get_total_user_lostpets(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('pet_lost AS P','P.username = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
        return $query->num_rows() ;
    }
    
    public function deleteLost(){
        
        $id = $this->input->post('id');
            // This is the orig_name in our lostfound page in the user controller
        $orig_name = $this->input->post('00678k0k');
        unlink("lostfoundimages/$orig_name");
        
        $this->db->select('*');
        $this->db->where("id ='$id' AND orig_name = '$orig_name'");
        $this->db->limit(1);
        $this->db->delete('pet_lost');
    }
    
    public function deleteFound(){
        
        $id = $this->input->post('id');
            // This is the orig_name in our lostfound page in the user controller
        $orig_name = $this->input->post('00678kak');
        unlink("lostfoundimages/$orig_name");
        
        $this->db->select('*');
        $this->db->where("id ='$id' AND orig_name = '$orig_name'");
        $this->db->limit(1);
        $this->db->delete('pet_found');
    }
    
    public function get_foundpets($username){
        
        
        $this->db->select('*');
        $this->db->from('pet_found');
        $this->db->order_by("id", "desc");
        $this->db->Where('username',$username);
        
        $query = $this->db->get();
            // You have to return row() if you want to each item in you database
        return $query->result();
    }
    
    public function get_total_user_foundpets(){
        
        $username = $this->session->userdata('username');
        $this->db->from('users_maxy99zx99 AS U');
        $this->db->join('pet_found AS P','P.username = U.username','INNER');
        $this->db->where("U.username ='$username'");
        
        $query = $this->db->get();
        
         return $query->num_rows() ;
    }
   
}