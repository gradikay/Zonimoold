<?php 
class Plan_model extends CI_Model{
  
    public function mayfly_valid(){
        
        // Here we are setting the variable in order to reuse it
        $legal_full_name = $this->input->post('legal_full_name');
        $agreement       = $this->input->post('agreement');
        $username        = $this->session->userdata('username');
        // Here we are getting the username to compare with the uncoming username
        $this->db->where('username',$username);        
        
        // We are selecting the username from the mayfly database
        $query = $this->db->get('plan');
        
        // We check if the user has already be inserted 
        if($query->num_rows() === 1){
            
                      
            // Here we make it so that the user does not have to logout then login to 
            // see the change 
            $this->session->set_userdata('plan_name', 'mayfly');
            $this->session->set_userdata('legal_full_name', $legal_full_name);
        
                // If the user is there do this code
             $sqlu = "UPDATE plan            
                    SET  legal_full_name = " . $this->db->escape($legal_full_name) . ",
                         agreement       = " . $this->db->escape($agreement) . "
                    WHERE username       = " . $this->db->escape($username ) ." ";
                                 
            // Old code 
            //$sql = "UPDATE users            
                   // SET  plan_name       = 'mayfly '
                   // WHERE username       = " . $this->db->escape($username ) ." ";
                               
        // Return the result of this query
            $result = $this->db->query($sqlu);
            //$result = $this->db->query($sql);
            return $result;
            
        } else {
            
            // Here we make it so that the user does not have to logout then login to 
            // see the change 
            $this->session->set_userdata('plan_name', 'mayfly');
            $this->session->set_userdata('legal_full_name', $legal_full_name);
            
                // If the user is no there do this instead
            $sqlu = "INSERT INTO plan (legal_full_name, agreement, username)            
                VALUES (" . $this->db->escape($legal_full_name) . ",
                        " . $this->db->escape($agreement) . ",
                        " . $this->db->escape($username) . ")" ;
            
            
             //$sql = "UPDATE users            
             //       SET  plan_name       = 'mayfly '
             //       WHERE username       = " . $this->db->escape($username ) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sqlu);
            //$result = $this->db->query($sql);
            return $result;
            
        }
    }
    
    public function agama_valid(){
        
        // Here we are setting the variable in order to reuse it
        $legal_full_name = $this->input->post('legal_full_name');
        $agreement       = $this->input->post('agreement');
        $username        = $this->session->userdata('username');
        // Here we are getting the username to compare with the uncoming username
        $this->db->where('username',$username);        
        
        // We are selecting the username from the agama database
        $query = $this->db->get('plan');
        
        // We check if the user has already be inserted 
        if($query->num_rows() === 1){
            
                      
            // Here we make it so that the user does not have to logout then login to 
            // see the change 
            $this->session->set_userdata('plan_name', 'agama');
            $this->session->set_userdata('legal_full_name', $legal_full_name);
        
                // If the user is there do this code
             $sqlu = "UPDATE plan            
                    SET  legal_full_name = " . $this->db->escape($legal_full_name) . ",
                         agreement       = " . $this->db->escape($agreement) . "
                    WHERE username       = " . $this->db->escape($username ) ." ";
                                 
            
            //$sql = "UPDATE users            
            //        SET  plan_name       = 'agama '
            //        WHERE username       = " . $this->db->escape($username ) ." ";
                               
        // Return the result of this query
            $result = $this->db->query($sqlu);
            //$result = $this->db->query($sql);
            return $result;
            
        } else {
            
            // Here we make it so that the user does not have to logout then login to 
            // see the change 
            $this->session->set_userdata('plan_name', 'agama');
            $this->session->set_userdata('legal_full_name', $legal_full_name);
            
                // If the user is no there do this instead
            $sqlu = "INSERT INTO plan (legal_full_name, agreement, username)            
                VALUES (" . $this->db->escape($legal_full_name) . ",
                        " . $this->db->escape($agreement) . ",
                        " . $this->db->escape($username) . ")" ;
            
            
             //$sql = "UPDATE users            
             //       SET  plan_name       = 'agama '
             //       WHERE username       = " . $this->db->escape($username ) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sqlu);
            //$result = $this->db->query($sql);
            return $result;
            
        }
    }
    
    public function okapi_valid(){
        
        // Here we are setting the variable in order to reuse it
        $legal_full_name = $this->input->post('legal_full_name');
        $agreement       = $this->input->post('agreement');
        $username        = $this->session->userdata('username');
        // Here we are getting the username to compare with the uncoming username
        $this->db->where('username',$username);        
        
        // We are selecting the username from the okapi database
        $query = $this->db->get('plan');
        
        // We check if the user has already be inserted 
        if($query->num_rows() === 1){
            
                      
            // Here we make it so that the user does not have to logout then login to 
            // see the change 
            $this->session->set_userdata('plan_name', 'okapi');
            $this->session->set_userdata('legal_full_name', $legal_full_name);
        
                // If the user is there do this code
             $sqlu = "UPDATE plan            
                    SET  legal_full_name = " . $this->db->escape($legal_full_name) . ",
                         agreement       = " . $this->db->escape($agreement) . "
                    WHERE username       = " . $this->db->escape($username ) ." ";
                                 
            
            //$sql = "UPDATE users            
            //        SET  plan_name       = 'okapi '
            //        WHERE username       = " . $this->db->escape($username ) ." ";
                               
        // Return the result of this query
            $result = $this->db->query($sqlu);
           // $result = $this->db->query($sql);
            return $result;
            
        } else {
            
            // Here we make it so that the user does not have to logout then login to 
            // see the change 
            $this->session->set_userdata('plan_name', 'okapi');
            $this->session->set_userdata('legal_full_name', $legal_full_name);
            
                // If the user is no there do this instead
            $sqlu = "INSERT INTO plan (legal_full_name, agreement, username)            
                VALUES (" . $this->db->escape($legal_full_name) . ",
                        " . $this->db->escape($agreement) . ",
                        " . $this->db->escape($username) . ")" ;
            
            
             //$sql = "UPDATE users            
            //        SET  plan_name       = 'okapi '
             //       WHERE username       = " . $this->db->escape($username ) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sqlu);
            //$result = $this->db->query($sql);
            return $result;
            
        }
    }
    
    public function eagle_valid(){
        
        // Here we are setting the variable in order to reuse it
        $legal_full_name = $this->input->post('legal_full_name');
        $agreement       = $this->input->post('agreement');
        $username        = $this->session->userdata('username');
        // Here we are getting the username to compare with the uncoming username
        $this->db->where('username',$username);        
        
        // We are selecting the username from the eagle database
        $query = $this->db->get('plan');
        
        // We check if the user has already be inserted 
        if($query->num_rows() === 1){
            
                      
            // Here we make it so that the user does not have to logout then login to 
            // see the change 
            $this->session->set_userdata('plan_name', 'eagle');
            $this->session->set_userdata('legal_full_name', $legal_full_name);
        
                // If the user is there do this code
             $sqlu = "UPDATE plan            
                    SET  legal_full_name = " . $this->db->escape($legal_full_name) . ",
                         agreement       = " . $this->db->escape($agreement) . "
                    WHERE username       = " . $this->db->escape($username ) ." ";
                                 
            
            //$sql = "UPDATE users            
            //        SET  plan_name       = 'eagle '
            //        WHERE username       = " . $this->db->escape($username ) ." ";
                              
        // Return the result of this query
            $result = $this->db->query($sqlu);
           // $result = $this->db->query($sql);
            return $result;
            
        } else {
            
            // Here we make it so that the user does not have to logout then login to 
            // see the change 
            // Plan_name located in the users table we can set it without calling the table
            $this->session->set_userdata('plan_name', 'eagle');
            $this->session->set_userdata('legal_full_name', $legal_full_name);
            
                // If the user is no there do this instead
            $sqlu = "INSERT INTO plan (legal_full_name, agreement, username)            
                VALUES (" . $this->db->escape($legal_full_name) . ",
                        " . $this->db->escape($agreement) . ",
                        " . $this->db->escape($username) . ")" ;
            
            
             //$sql = "UPDATE users            
             //       SET  plan_name       = 'eagle '
              //      WHERE username       = " . $this->db->escape($username ) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sqlu);
            //$result = $this->db->query($sql);
            return $result;
            
        }
    }
    
    /*public function address_sub(){
        
        // Here we are setting the variable in order to reuse it
        $address        = $this->input->post('address');
        $username       = $this->session->userdata('username');
        $address_line_2 = $this->input->post('address_line_2');
        $state          = $this->input->post('state');
        $city           = $this->input->post('city');
        $zip_code       = $this->input->post('zip_code');
        $country        = $this->input->post('country');
        $phone_number   = $this->input->post('phone_number');
        
        
        // Here we are getting the username from the table
        //to compare with the uncoming username from the userdata
        $this->db->where('username',$username);        
        
        // We are selecting the username from the users_address database
        // We are saying from the top select where the username to something
        // assign it to $username from the uses_address table
        $query = $this->db->get('users_address');
        
        // We check if the user has already be inserted 
        if($query->num_rows() === 1){
        
                // If the user is there do this code
             $sql = "UPDATE users_address            
                    SET  address        = " . $this->db->escape($address) . ",
                         address_line_2 = " . $this->db->escape($address_line_2) . ",
                         state          = " . $this->db->escape($state) . ",
                         city          = " . $this->db->escape($city) . ",
                         zip_code       = " . $this->db->escape($zip_code) . ",
                         country        = " . $this->db->escape($country) . ",
                         phone_number   = " . $this->db->escape($phone_number) . "
                    WHERE username      = " . $this->db->escape($username ) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sql);
            return $result;
            
        } else {
            
                // If the user is no there do this instead
            $sql = "INSERT INTO users_address (address, address_line_2, state, city, zip_code, country, phone_number, username)            
                VALUES (" . $this->db->escape($address) . ",
                        " . $this->db->escape($address_line_2) . ",
                        " . $this->db->escape($state) . ",
                        " . $this->db->escape($city) . ",
                        " . $this->db->escape($zip_code) . ",
                        " . $this->db->escape($country) . ",
                        " . $this->db->escape($phone_number) . ",
                        " . $this->db->escape($username) . ")" ;
            $result = $this->db->query($sql);
            return $result;
            
        }
    }*/
    
    /*public function credit_card_sub(){
        
        //Let set the variable for $price
        if($this->session->userdata('plan_name') == 'mayfly'){
            $price = 9.99;
        } elseif ($this->session->userdata('plan_name') == 'agama'){
            $price = 29.99;
        } elseif ($this->session->userdata('plan_name') == 'okapi'){
            $price = 59.99;
        } elseif ($this->session->userdata('plan_name') == 'eagle'){
            $price = 79.99;
        }
        
        // Here we are setting the variable in order to reuse it
        $credit_card_type   = $this->input->post('credit_card_type');
        $username           = $this->session->userdata('username');
        $credit_card_number = $this->input->post('credit_card_number');
        $exp_month          = $this->input->post('exp_month');
        $exp_year           = $this->input->post('exp_year');
        $cvv                = $this->input->post('cvv');
        $cardholder_name    = $this->input->post('cardholder_name');
        $your_order_total   = $price;
        
        // Here we are getting the username from the table
        //to compare with the uncoming username from the userdata
        $this->db->where('username',$username);        
        
        // We are selecting the username from the users_address database
        // We are saying from the top select where the username to something
        // assign it to $username from the users_credit_card table
        $query = $this->db->get('users_credit_card');
        
        // We check if the user has already be inserted 
        if($query->num_rows() === 1){
        
                // If the user is there do this code
             $sql = "UPDATE users_credit_card            
                    SET  credit_card_type   = " . $this->db->escape($credit_card_type) . ",
                         credit_card_number = " . $this->db->escape($credit_card_number) . ",
                         exp_month          = " . $this->db->escape($exp_month) . ",
                         exp_year           = " . $this->db->escape($exp_year) . ",
                         cvv                = " . $this->db->escape($cvv) . ",
                         cardholder_name    = " . $this->db->escape($cardholder_name) . ",
                         your_order_total   = " . $this->db->escape($your_order_total) . "
                    WHERE username          = " . $this->db->escape($username ) ." ";
                                 
        // Return the result of this query
            $result = $this->db->query($sql);
            return $result;
            
        } else {
            
                // If the user is no there do this instead
            $sql = "INSERT INTO users_credit_card (credit_card_type, credit_card_number, exp_month, exp_year, cvv, cardholder_name, your_order_total, username)            
                VALUES (" . $this->db->escape($credit_card_type) . ",
                        " . $this->db->escape($credit_card_number) . ",
                        " . $this->db->escape($exp_month) . ",
                        " . $this->db->escape($exp_year) . ",
                        " . $this->db->escape($cvv) . ",
                        " . $this->db->escape($cardholder_name) . ",
                        " . $this->db->escape($your_order_total) . ",
                        " . $this->db->escape($username) . ")" ;
            $result = $this->db->query($sql);
            return $result;
            
        }
    }*/
    
     // Do not forget to load the username into the url
    /*public function verification($username){
        
        $this->db->select('*');
        $this->db->from('users_address as A');
        $this->db->join('users_credit_card as C','A.username = C.username','INNER');
        $this->db->join('plan as P','A.username = P.username','INNER');
        $this->db->where('A.username',$username);
        
        $query = $this->db->get();
        // You have to return row() if you want to each item in you database
        return $query->row();
    }*/
    
    /*public function plan_choice_accepted(){
        
        $username = $this->session->userdata('username');
        
        if($this->session->userdata('plan_name') == 'mayfly'){
            // If the user is there do this code
             $sql = "UPDATE plan            
                    SET  mayfly = 1,
                         agama  = 0,
                         okapi  = 0,
                         eagle  = 0,
                         active = 1
                    WHERE username       = " . $this->db->escape($username ) ." ";
            $data = array(
                'plan_name' => 'mayfly'
                );

                $this->db->where('username', $username);
                $this->db->update('users', $data);
                               
        // Return the result of this query
            $result = $this->db->query($sql);
            return $result;
            
        } elseif ($this->session->userdata('plan_name') == 'agama'){
            // If the user is there do this code
             $sql = "UPDATE plan            
                    SET  mayfly = 0,
                         agama  = 1,
                         okapi  = 0,
                         eagle  = 0,
                         active = 1
                    WHERE username       = " . $this->db->escape($username ) ." ";
            $data = array(
                'plan_name' => 'agama'
                );

                $this->db->where('username', $username);
                $this->db->update('users', $data);
                               
        // Return the result of this query
            $result = $this->db->query($sql);
            return $result;
            
        } elseif ($this->session->userdata('plan_name') == 'okapi'){
            // If the user is there do this code
             $sql = "UPDATE plan            
                    SET  mayfly = 0,
                         agama  = 0,
                         okapi  = 1,
                         eagle  = 0,
                         active = 1
                    WHERE username       = " . $this->db->escape($username ) ." ";
            $data = array(
                'plan_name' => 'okapi'
                );

                $this->db->where('username', $username);
                $this->db->update('users', $data);
                               
        // Return the result of this query
            $result = $this->db->query($sql);
            return $result;
            
        } elseif ($this->session->userdata('plan_name') == 'eagle'){
            // If the user is there do this code
             $sql = "UPDATE plan            
                    SET  mayfly = 0,
                         agama  = 0,
                         okapi  = 0,
                         eagle  = 1,
                         active = 1
                    WHERE username       = " . $this->db->escape($username ) ." ";
             $data = array(
                'plan_name' => 'eagle'
                );

                $this->db->where('username', $username);
                $this->db->update('users', $data);
                               
        // Return the result of this query
            $result = $this->db->query($sql);
            return $result;
            
        }
    }*/
    
}