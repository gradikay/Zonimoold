<?php 
class Success_model extends CI_Model{
    
    public function success_ad(){
        
        $username = $this->session->userdata('username');
        
            // Transaction number
        $transaction_number = $this->input->get('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->get('st');
            // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $ad_id = $this->input->get('cm');
        /* Test 
            // This is the item number set in the paypal button
         // Transaction number
        $transaction_number = $this->input->post('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->post('st');
            // This is the amount of the item
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $ad_id = $this->input->post('cm');
        */
        
            // This is the item number set in the paypal button         
        $item_number = $this->input->post('item_number');
        
        if($amount == 2 || $amount == '2%2e99' || $amount == 2.99 || $amount == '2.99' ){
            
            $plan = '3 days';
            
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+3 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");
            
        } elseif($amount == 5 || $amount == '5%2e99' || $amount == 5.99 || $amount == '5.99'){
            
            $plan = '7 days';
            
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+7 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");            
            
        } elseif($amount == 9 || $amount == '9%2e99' || $amount == 9.99 || $amount == '9.99'){
            
            $plan = '14 days';
            
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+14 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");
            
        } elseif($amount == 20 || $amount == '20%2e99' || $amount == 20.99 || $amount == '20.99'){
            
            $plan = 'a month';
            
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+30 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");
            
        } else {
            
            $plan = 'A_A'; 
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
        
        $sql = "UPDATE ads
            
                SET trans_num   = "  . $this->db->escape($transaction_number) . ",
                    status      = "  . $this->db->escape($statment) . ",
                    amount      = "  . $this->db->escape($amount) . ",
                    currency    = "  . $this->db->escape($currency) . ",
                    item_number = "  . $this->db->escape($item_number) . ",
                    plan        = "  . $this->db->escape($plan) . ", 
                    time_created= '" . $time_created . "', 
                    time_expires= '" . $time_expires . "', 
                    paid        = 1  
            WHERE   username    = "  . $this->db->escape($username) . " AND
                    ad_id       = "  . $this->db->escape($ad_id) . " ";
                // Return the result of this query
                $result = $this->db->query($sql); 
        
        $paidfor = ' ads';
        
        $sql = "INSERT INTO plan_trans (username, trans_num, status, amount, currency, plan, paid, item_number)
            
            VALUES ("  . $this->db->escape($username) . ",
                    "  . $this->db->escape($transaction_number) . ",
                    "  . $this->db->escape($statment) . ",
                    "  . $this->db->escape($amount) . ",
                    "  . $this->db->escape($currency) . ",
                    "  . $this->db->escape($plan.$paidfor) ." ,
                    '1',
                    "  . $this->db->escape($item_number) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);
        
        
        
    }
    
    public function success_lost(){
        
        $username = $this->session->userdata('username');
            // Live code
            // Transaction number
        $transaction_number = $this->input->get('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->get('st');
            // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $lost_id = $this->input->get('cm');
            // This is the item number set in the paypal button
        $item_number = $this->input->get('item_number');
        
        /*
            // Test code
            // Transaction number
        $transaction_number = $this->input->post('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->post('st');
            // This is the amount of the item
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $lost_id = $this->input->post('cm');
            // This is the item number set in the paypal button
        $item_number = $this->input->post('item_number');
        */
        
        
        if($amount == 10 || $amount == '10%2e99' || $amount == 10.99 || $amount == '10.99' ){
            
            $plan = '3 days';
            
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+3 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");
            
        } elseif($amount == 20 || $amount == '20%2e99' || $amount == 20.99 || $amount == '20.99'){
            
            $plan = '7 days';
            
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+7 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");
            
        } elseif($amount == 30 || $amount == '30%2e99' || $amount == 30.99 || $amount == '30.99'){
            
            $plan = '14 days';
            
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+14 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");
            
        } elseif($amount == 49 || $amount == '49%2e99' || $amount == 49.99 || $amount == '49.99'){
            
            $plan = 'a month';
            
                // Here we are getting the current time ... This is not the user time it's the     
                // Webmaster date    
            $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
                // This will produce a different behavior if called after the variable $thirty at the bottom
            $time_created = date_format($date,"Y-m-d H:i:sP");

                // Here we  add 30 days to the time_created for the expiration of the suscription
            $thirty = date_modify($date,"+30 days");

                //Here we format the date so that it matches our database dateTime field
            $time_expires = date_format($thirty,"Y-m-d H:i:sP");
            
        } else {
            $plan = 'A_A';
            
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
        
        $sql = "UPDATE pet_lost
            
                SET trans_number= "  . $this->db->escape($transaction_number) . ",
                    status      = "  . $this->db->escape($statment) . ",
                    amount      = "  . $this->db->escape($amount) . ",
                    currency    = "  . $this->db->escape($currency) . ",
                    item_number = "  . $this->db->escape($item_number) . ",
                    plan        = "  . $this->db->escape($plan) . ", 
                    time_created= '" . $time_created . "', 
                    time_expires= '" . $time_expires . "', 
                    paid        = 1   
            WHERE   username    = "  . $this->db->escape($username) . " AND
                    lost_id     = "  . $this->db->escape($lost_id) . " ";
                // Return the result of this query
                $result = $this->db->query($sql);
        
        $paidfor =  ' lost pet';
        $sql = "INSERT INTO plan_trans (username, trans_num, status, amount, currency, plan, paid, item_number)
            
            VALUES ("  . $this->db->escape($username) . ",
                    "  . $this->db->escape($transaction_number) . ",
                    "  . $this->db->escape($statment) . ",
                    "  . $this->db->escape($amount) . ",
                    "  . $this->db->escape($currency) . ",
                    "  . $this->db->escape($plan.$paidfor) . ",
                    '1',
                    "  . $this->db->escape($item_number) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);
        
        
        
    }
    
    public function success_mayfly(){
        
        $username = $this->session->userdata('username');
        
            // Live code
            // Transaction number
        $transaction_number = $this->input->get('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->get('st');
            // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $signature = $this->input->get('sig');
            // This is the item number set in the paypal button
        $item_number = $this->input->get('item_number'); 
        
            // Here we are getting the current time ... This is not the user time it's the     
            // Webmaster date    
        $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
            // This will produce a different behavior if called after the variable $thirty at the bottom
        $time_created = date_format($date,"Y-m-d H:i:sP");

            // Here we  add 30 days to the time_created for the expiration of the suscription
        $thirty = date_modify($date,"+14 days");

            //Here we format the date so that it matches our database dateTime field
        $time_expires = date_format($thirty,"Y-m-d H:i:sP");
        
        /* 
            // This is the Test code
        $transaction_number = $this->input->post('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->post('st');
            // This is the amount of the item
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $signature = $this->input->post('sig');
            // This is the item number set in the paypal button
        $item_number = $this->input->post('item_number');
        */
        
        $sql = "UPDATE plan            
                   SET trans_num   = "  . $this->db->escape($transaction_number) . ",
                       status      = "  . $this->db->escape($statment) . ",
                       amount      = "  . $this->db->escape($amount) . ",
                       currency    = "  . $this->db->escape($currency) . ",
                       item_number = "  . $this->db->escape($item_number) . ",
                       signature   = "  . $this->db->escape($signature) . ",    
                       signature   = "  . $this->db->escape($time_created) . ",    
                       mayfly      = 1,  
                       agama       = 0,  
                       okapi       = 0,  
                       eagle       = 0,  
                       mayfly_offer_count = `mayfly_offer_count` + 1,  
                       active      = 1,  
                       paid        = 1  
                 WHERE username    = "  . $this->db->escape($username) . " ";
                    // Return the result of this query
                 $result = $this->db->query($sql);
        
        $plan = 'mayfly';
        
        $sql = "INSERT INTO plan_trans (username, trans_num, status, amount, currency, signature, plan, paid, item_number)
            
            VALUES ("  . $this->db->escape($username) . ",
                    "  . $this->db->escape($transaction_number) . ",
                    "  . $this->db->escape($statment) . ",
                    "  . $this->db->escape($amount) . ",
                    "  . $this->db->escape($currency) . ",
                    "  . $this->db->escape($signature) . ",
                    "  . $this->db->escape($plan) . ",
                    '1',
                    "  . $this->db->escape($item_number) . ")";
                // Return the result of this query
                $result = $this->db->query($sql); 
        
    }
    
    public function success_agama(){
        
            // Here we are getting the current time ... This is not the user time it's the     
            // Webmaster date    
        $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
            // This will produce a different behavior if called after the variable $thirty at the bottom
        $time_created = date_format($date,"Y-m-d H:i:sP");

            // Here we  add 30 days to the time_created for the expiration of the suscription
        $thirty = date_modify($date,"+30 days");

            //Here we format the date so that it matches our database dateTime field
        $time_expires = date_format($thirty,"Y-m-d H:i:sP");
        
        $username = $this->session->userdata('username');
        
            // Live code
            // Transaction number
        $transaction_number = $this->input->get('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->get('st');
            // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $signature = $this->input->get('sig');
            // This is the item number set in the paypal button
        
        /* Test code
        $transaction_number = $this->input->post('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->post('st');
            // This is the amount of the item
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $signature = $this->input->post('sig');
            // This is the item number set in the paypal button
        $item_number = $this->input->post('item_number');
        $item_number = $this->input->get('item_number');*/
        
        $sql = "UPDATE plan            
                   SET trans_num   = "  . $this->db->escape($transaction_number) . ",
                       status      = "  . $this->db->escape($statment) . ",
                       amount      = "  . $this->db->escape($amount) . ",
                       currency    = "  . $this->db->escape($currency) . ",
                       item_number = "  . $this->db->escape($item_number) . ",
                       signature   = "  . $this->db->escape($signature) . ",  
                       signature   = "  . $this->db->escape($time_created) . ",  
                       agama_offer_count = `agama_offer_count` + 3,
                       mayfly      = 0,  
                       agama       = 1,  
                       okapi       = 0,  
                       eagle       = 0,  
                       active      = 1,  
                       paid        = 1  
                 WHERE username    = "  . $this->db->escape($username) . " ";
                    // Return the result of this query
                 $result = $this->db->query($sql); 
        
        $plan = 'agama';
        
        $sql = "INSERT INTO plan_trans (username, trans_num, status, amount, currency, signature, plan, paid, item_number)
            
            VALUES ("  . $this->db->escape($username) . ",
                    "  . $this->db->escape($transaction_number) . ",
                    "  . $this->db->escape($statment) . ",
                    "  . $this->db->escape($amount) . ",
                    "  . $this->db->escape($currency) . ",
                    "  . $this->db->escape($signature) . ",
                    "  . $this->db->escape($plan) . ",
                    '1',
                    "  . $this->db->escape($item_number) . ")";
                // Return the result of this query
                $result = $this->db->query($sql); 
        
        
        
    }
    
    public function success_okapi(){
        
        $username = $this->session->userdata('username');
        // This is the live code
            // Transaction number
        $transaction_number = $this->input->get('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->get('st');
            // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $signature = $this->input->get('sig');
            // This is the item number set in the paypal button
        $item_number = $this->input->get('item_number');
        
        // Test code
            /*
        $transaction_number = $this->input->post('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->post('st');
            // This is the amount of the item
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $signature = $this->input->post('sig');
            // This is the item number set in the paypal button
        $item_number = $this->input->post('item_number');
        */
        
            // Here we are getting the current time ... This is not the user time it's the     
            // Webmaster date    
        $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
            // This will produce a different behavior if called after the variable $thirty at the bottom
        $time_created = date_format($date,"Y-m-d H:i:sP");

            // Here we  add 30 days to the time_created for the expiration of the suscription
        $thirty = date_modify($date,"+30 days");

            //Here we format the date so that it matches our database dateTime field
        $time_expires = date_format($thirty,"Y-m-d H:i:sP");
        
        $sql = "UPDATE plan            
                   SET trans_num   = "  . $this->db->escape($transaction_number) . ",
                       status      = "  . $this->db->escape($statment) . ",
                       amount      = "  . $this->db->escape($amount) . ",
                       currency    = "  . $this->db->escape($currency) . ",
                       item_number = "  . $this->db->escape($item_number) . ",
                       signature   = "  . $this->db->escape($signature) . ",
                       time_created= "  . $this->db->escape($time_created) . ",  
                       time_expires= "  . $this->db->escape($time_expires) . ",  
                       mayfly      = 0,  
                       agama       = 0,  
                       okapi       = 1,  
                       eagle       = 0,  
                       active      = 1,  
                       paid        = 1  
                 WHERE username    = "  . $this->db->escape($username) . " ";
                    // Return the result of this query
                 $result = $this->db->query($sql); 
        
        $plan = 'okapi';
        
        $sql = "INSERT INTO plan_trans (username, trans_num, status, amount, currency, signature, plan, paid, item_number)
            
            VALUES ("  . $this->db->escape($username) . ",
                    "  . $this->db->escape($transaction_number) . ",
                    "  . $this->db->escape($statment) . ",
                    "  . $this->db->escape($amount) . ",
                    "  . $this->db->escape($currency) . ",
                    "  . $this->db->escape($signature) . ",
                    "  . $this->db->escape($plan) . ",
                    '1',
                    "  . $this->db->escape($item_number) . ")";
                // Return the result of this query
                $result = $this->db->query($sql); 
        
        
        
    }
    
    public function success_eagle(){
        
        $username = $this->session->userdata('username');
            // Transaction number
        $transaction_number = $this->input->get('tx');
            // This is the state of the transaction 
            // Returns Completed on completion
        $statment = $this->input->get('st');
            // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
             // This returns a customer variable  
             // Returns the ad_id to check if it matches with the one in data 
        $signature = $this->input->get('sig');
            // This is the item number set in the paypal button
        $item_number = $this->input->get('item_number');
        
            // Here we are getting the current time ... This is not the user time it's the     
            // Webmaster date    
        $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
            // This will produce a different behavior if called after the variable $thirty at the bottom
        $time_created = date_format($date,"Y-m-d H:i:sP");

            // Here we  add 30 days to the time_created for the expiration of the suscription
        $thirty = date_modify($date,"+30 days");

            //Here we format the date so that it matches our database dateTime field
        $time_expires = date_format($thirty,"Y-m-d H:i:sP");
        
        $sql = "UPDATE plan            
                   SET trans_num   = "  . $this->db->escape($transaction_number) . ",
                       status      = "  . $this->db->escape($statment) . ",
                       amount      = "  . $this->db->escape($amount) . ",
                       currency    = "  . $this->db->escape($currency) . ",
                       item_number = "  . $this->db->escape($item_number) . ",
                       signature   = "  . $this->db->escape($signature) . ", 
                       time_created= "  . $this->db->escape($time_created) . ",  
                       time_expires= "  . $this->db->escape($time_expires) . ", 
                       mayfly      = 0,  
                       agama       = 0,  
                       okapi       = 0,  
                       eagle       = 1,  
                       active      = 1,  
                       paid        = 1  
                 WHERE username    = "  . $this->db->escape($username) . " ";
                    // Return the result of this query
                 $result = $this->db->query($sql);
        
        $plan = 'eagle';
        
        $sql = "INSERT INTO plan_trans (username, trans_num, status, amount, currency, signature, plan, paid, item_number)
            
            VALUES ("  . $this->db->escape($username) . ",
                    "  . $this->db->escape($transaction_number) . ",
                    "  . $this->db->escape($statment) . ",
                    "  . $this->db->escape($amount) . ",
                    "  . $this->db->escape($currency) . ",
                    "  . $this->db->escape($signature) . ",
                    "  . $this->db->escape($plan) . ",
                    '1',
                    "  . $this->db->escape($item_number) . ")";
                // Return the result of this query
                $result = $this->db->query($sql);
        
        
        
    }
            
}