<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Dogs extends CI_Controller {
class Plan extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        }
    
    public function index(){ 
        $this->load->model('Buyorsell_model');
        
        
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in exotic's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        
            // This help me display the time or the amount of offers a user has util it expires
            // this returns row
            // We are not using this now 
        $data['plan']= $this->User_model-> get_plan_facts();
			// Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile(); 
            // This help me display the time or the amount of offers a user has util it expires
            // this returns result 
        $data['plan_expires']    = $this->User_model->get_plan_expration_date();
        
        $this->load->view('layouts/includes/header'); 
        $this->load->view('layouts/includes/navigator',$data);
        $this->load->view('pageplan/index',$data);
        $this->load->view('layouts/includes/footerbuyorsell'); 
        
    }
    
    public function mayfly(){ 
        $this->load->model('Buyorsell_model');
        
            // This help me display the time or the amount of offers a user has util it expires
            // this returns row
            // We are not using this now 
        $data['plan']= $this->User_model->get_plan_facts();
            // This help me display the time or the amount of offers a user has util it expires
            // this returns result
        $data['plan_expires']    = $this->User_model->get_plan_expration_date();
			// Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile(); 
        
            // Here we  are getting the current time and the expiration time from the data base 
            // to help us determine if the plan has expired
        $time_expires = date('Y-m-d H:i:sP',strtotime($data['plan_expires']->time_expires));

        $te_hour   = date('H',strtotime($data['plan_expires']->time_expires));
        $te_minute = date('i',strtotime($data['plan_expires']->time_expires));
        $te_second = date('s',strtotime($data['plan_expires']->time_expires));
        $te_month  = date('m',strtotime($data['plan_expires']->time_expires));
        $te_day    = date('d',strtotime($data['plan_expires']->time_expires));
        $te_year   = date('Y',strtotime($data['plan_expires']->time_expires));

        $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
            // This will produce a different behavior if called after the variable $thirty at the bottom
        $t_now = date_format($date,"Y-m-d H:i:sP");

        $t_exp = date($data['plan_expires']->time_expires);
        $now = time();

        $event = mktime($te_hour,$te_minute,$te_second,$te_month,$te_day,$te_year);


        $difference = ($event - $now);
        $min   = date('i',$difference);
        $days  = date('d',$difference);
        $hours = date('H',$difference);
        $sec   = date('s',$difference);
        
            // Getting the time ends here     
        
            // Here we say if the plan is okapi or eagle we don't want the user 
            // the direct link of mayfly ... because then the will just buy everything
            // We are taking the time from the above codes
        if($this->session->userdata('plan_name') == 'okapi' && ($t_now >= $t_exp) ||
           $this->session->userdata('plan_name') == 'eagle' && ($t_now >= $t_exp) ||
           $this->session->userdata('plan_name') == 'mayfly' ||
           $this->session->userdata('plan_name') == NULL ||
           $this->session->userdata('plan_name') == 'agama' && ($data['plan']->agama_offer_count == 0)):
        
            // This out puts the ad
            $data['ads']          = $this->User_model->get_ads();
            // This is for the right Ads content in exotic's page
            $data['spons']        = $this->Buyorsell_model->pets_sponsord();
            $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        
                // Loading our views
            $this->load->view('layouts/includes/header'); 
            $this->load->view('layouts/includes/navigator',$data);
            $this->load->view('pageplan/mayfly',$data);
            $this->load->view('layouts/includes/footerbuyorsell');
                   
        else:
            redirect('plan/index') ;
        endif;
        
    }
    
    public function okapi(){ 
        $this->load->model('Buyorsell_model');
        
            // This help me display the time or the amount of offers a user has util it expires
            // this returns row
            // We are not using this now 
        $data['plan']= $this->User_model->get_plan_facts();
            // This help me display the time or the amount of offers a user has util it expires
            // this returns result
        $data['plan_expires']    = $this->User_model->get_plan_expration_date();
			// Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile(); 
        
            // Here we  are getting the current time and the expiration time from the data base 
            // to help us determine if the plan has expired
        $time_expires = date('Y-m-d H:i:sP',strtotime($data['plan_expires']->time_expires));

        $te_hour   = date('H',strtotime($data['plan_expires']->time_expires));
        $te_minute = date('i',strtotime($data['plan_expires']->time_expires));
        $te_second = date('s',strtotime($data['plan_expires']->time_expires));
        $te_month  = date('m',strtotime($data['plan_expires']->time_expires));
        $te_day    = date('d',strtotime($data['plan_expires']->time_expires));
        $te_year   = date('Y',strtotime($data['plan_expires']->time_expires));

        $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
            // This will produce a different behavior if called after the variable $thirty at the bottom
        $t_now = date_format($date,"Y-m-d H:i:sP");

        $t_exp = date($data['plan_expires']->time_expires);
        $now = time();

        $event = mktime($te_hour,$te_minute,$te_second,$te_month,$te_day,$te_year);


        $difference = ($event - $now);
        $min   = date('i',$difference);
        $days  = date('d',$difference);
        $hours = date('H',$difference);
        $sec   = date('s',$difference);
        
            // Getting the time ends here
        
            // Here we say if the plan is okapi or eagle we don't want the user 
            // the direct link of okapi... because then the will just buy everything
            // We are taking the time from the above codes
        if($this->session->userdata('plan_name') == 'eagle' && ($t_now >= $t_exp) ||
           $this->session->userdata('plan_name') == NULL ||
           $this->session->userdata('plan_name') == 'agama' && ($data['plan']->agama_offer_count == 0) ||
           $this->session->userdata('plan_name') == 'mayfly'&& ($data['plan']->mayfly_offer_count == 0)):
        
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in exotic's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        
        $this->load->view('layouts/includes/header'); 
        $this->load->view('layouts/includes/navigator',$data);
        $this->load->view('pageplan/okapi',$data);
        $this->load->view('layouts/includes/footerbuyorsell'); 
        
        else:
            redirect('plan/index') ;
        endif;
        
    }
    
    public function agama(){ 
        $this->load->model('Buyorsell_model');
        
            // This help me display the time or the amount of offers a user has util it expires
            // this returns row
            // We are not using this now 
        $data['plan']= $this->User_model->get_plan_facts();
            // This help me display the time or the amount of offers a user has util it expires
            // this returns result
        $data['plan_expires']    = $this->User_model->get_plan_expration_date();
			// Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile(); 
        
            // Here we  are getting the current time and the expiration time from the data base 
            // to help us determine if the plan has expired
        $time_expires = date('Y-m-d H:i:sP',strtotime($data['plan_expires']->time_expires));

        $te_hour   = date('H',strtotime($data['plan_expires']->time_expires));
        $te_minute = date('i',strtotime($data['plan_expires']->time_expires));
        $te_second = date('s',strtotime($data['plan_expires']->time_expires));
        $te_month  = date('m',strtotime($data['plan_expires']->time_expires));
        $te_day    = date('d',strtotime($data['plan_expires']->time_expires));
        $te_year   = date('Y',strtotime($data['plan_expires']->time_expires));

        $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
            // This will produce a different behavior if called after the variable $thirty at the bottom
        $t_now = date_format($date,"Y-m-d H:i:sP");

        $t_exp = date($data['plan_expires']->time_expires);
        $now = time();

        $event = mktime($te_hour,$te_minute,$te_second,$te_month,$te_day,$te_year);


        $difference = ($event - $now);
        $min   = date('i',$difference);
        $days  = date('d',$difference);
        $hours = date('H',$difference);
        $sec   = date('s',$difference);
        
            // Getting the time ends here     
        
            // Here we say if the plan is okapi or eagle we don't want the user 
            // the direct link of agama ... because then the will just buy everything
            // We are taking the time from the above codes
        if($this->session->userdata('plan_name') == 'okapi' && ($t_now >= $t_exp) ||
           $this->session->userdata('plan_name') == 'agama' ||
           $this->session->userdata('plan_name') == NULL ||
           $this->session->userdata('plan_name') == 'eagle' && ($t_now >= $t_exp) ||
           $this->session->userdata('plan_name') == 'mayfly' && ($data['plan']->mayfly_offer_count == 0)):
        
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in exotic's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        
        $this->load->view('layouts/includes/header'); 
        $this->load->view('layouts/includes/navigator',$data);
        $this->load->view('pageplan/agama',$data);
        $this->load->view('layouts/includes/footerbuyorsell');
        
        else:
            redirect('plan/index') ;
        endif;
        
    }
    
    public function eagle(){ 
        $this->load->model('Buyorsell_model');
        
            // This help me display the time or the amount of offers a user has util it expires
            // this returns row
            // We are not using this now 
        $data['plan']= $this->User_model->get_plan_facts();
            // This help me display the time or the amount of offers a user has util it expires
            // this returns result
        $data['plan_expires']    = $this->User_model->get_plan_expration_date();
        
            // Here we  are getting the current time and the expiration time from the data base 
            // to help us determine if the plan has expired
        $time_expires = date('Y-m-d H:i:sP',strtotime($data['plan_expires']->time_expires));
			// Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile(); 

        $te_hour   = date('H',strtotime($data['plan_expires']->time_expires));
        $te_minute = date('i',strtotime($data['plan_expires']->time_expires));
        $te_second = date('s',strtotime($data['plan_expires']->time_expires));
        $te_month  = date('m',strtotime($data['plan_expires']->time_expires));
        $te_day    = date('d',strtotime($data['plan_expires']->time_expires));
        $te_year   = date('Y',strtotime($data['plan_expires']->time_expires));

        $date = new DateTime("now", new DateTimeZone('America/New_York') ); 
            // This will produce a different behavior if called after the variable $thirty at the bottom
        $t_now = date_format($date,"Y-m-d H:i:sP");

        $t_exp = date($data['plan_expires']->time_expires);
        $now = time();

        $event = mktime($te_hour,$te_minute,$te_second,$te_month,$te_day,$te_year);


        $difference = ($event - $now);
        $min   = date('i',$difference);
        $days  = date('d',$difference);
        $hours = date('H',$difference);
        $sec   = date('s',$difference);
        
            // Getting the time ends here
        
            // Here we say if the plan is okapi or eagle we don't want the user 
            // the direct link of eagle... because then the will just buy everything
            // We are taking the time from the above codes
        if($this->session->userdata('plan_name') == 'okapi' && ($t_now >= $t_exp) ||
           $this->session->userdata('plan_name') == NULL ||
           $this->session->userdata('plan_name') == 'agama' && ($data['plan']->agama_offer_count == 0) ||
           $this->session->userdata('plan_name') == 'mayfly'&& ($data['plan']->mayfly_offer_count == 0)):
        
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in exotic's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        
        $this->load->view('layouts/includes/header'); 
        $this->load->view('layouts/includes/navigator',$data);
        $this->load->view('pageplan/eagle',$data);
        $this->load->view('layouts/includes/footerbuyorsell'); 
        
        else:
            redirect('plan/index') ;
        endif;
        
    }
    
    public function registration(){ 
        $this->load->model('Buyorsell_model');
        
        if($this->session->userdata('plan_name') == 'mayfly'){
            $data['price'] = '$9.99';
        } elseif($this->session->userdata('plan_name') == 'okapi'){
            $data['price'] = '$59.99' ;
        }elseif($this->session->userdata('plan_name') == 'agama'){
            $data['price'] = '$29.99' ;
        }elseif($this->session->userdata('plan_name') == 'eagle'){
            $data['price'] = '$79.99' ;
        }
        
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
			// Here we are getting the user profile image
        $data['im_prof']      = $this->User_model->get_im_profile(); 
        // This is for the right Ads content in exotic's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
		
        $this->load->view('layouts/includes/header'); 
        $this->load->view('layouts/includes/navigator',$data);
        $this->load->view('pageplan/registration',$data);
        $this->load->view('layouts/includes/footerbuyorsell'); 
        
    }
    
    // This is the mayfly plan funtion it uses also address_sub
    public function mayfly_valid(){ 
        
        // We have to load the view first
        $this->load->model('Plan_model');
        $price = 9.99;
        
        $this->form_validation->set_rules('legal_full_name','Full name or Business name','trim|required|xss_clean');
        $this->form_validation->set_rules('agreement','Agreement','trim|required|xss_clean|exact_length[1]');
        
        /*
         * If you want your messages to appeare you have to implement this if statement
         * Reload the original page don't redirect
         */
        if ($this->form_validation->run() == FALSE){
            $this->load->model('Buyorsell_model');
            
                // This out puts the ad
            $data['ads']          = $this->User_model->get_ads();
            // This is for the right Ads content in exotic's page
            $data['spons']        = $this->Buyorsell_model->pets_sponsord();
			
				// Here we are getting the user profile image
        	$data['im_prof'] = $this->User_model->get_im_profile(); 
            $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
            $this->load->view('layouts/includes/header'); 
            $this->load->view('layouts/includes/navigator',$data);
            $this->load->view('pageplan/mayfly',$data);
            $this->load->view('layouts/includes/footerbuyorsell'); 
            
        } else { 
        
            $this->Plan_model->mayfly_valid();
        
            redirect('plan/registration', $data); 
        }
        
    }
    
    // This is the agama plan funtion it uses also address_sub
    public function agama_valid(){ 
        
        // We have to load the view first
        $this->load->model('Plan_model');
        
        $price = 29.99;
        
        $this->form_validation->set_rules('legal_full_name','Full name or Business name','trim|required|xss_clean');
        $this->form_validation->set_rules('agreement','Agreement','trim|required|xss_clean|exact_length[1]');
        
        /*
         * If you want your messages to appeare you have to implement this if statement
         * Reload the original page don't redirect
         */
        if ($this->form_validation->run() == FALSE){
            $this->load->model('Buyorsell_model');
            
                // This out puts the ad
            $data['ads']          = $this->User_model->get_ads();
            // This is for the right Ads content in exotic's page
            $data['spons']        = $this->Buyorsell_model->pets_sponsord();
				// Here we are getting the user profile image
        	$data['im_prof'] = $this->User_model->get_im_profile(); 
            $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
			
            $this->load->view('layouts/includes/header'); 
            $this->load->view('layouts/includes/navigator',$data);
            $this->load->view('pageplan/agama',$data);
            $this->load->view('layouts/includes/footerbuyorsell'); 
            
        } else {
        
            $this->Plan_model->agama_valid();
        
            redirect('plan/registration');
        }
        
    }
    
    // This is the okapi plan funtion it uses also address_sub
    public function okapi_valid(){ 
        
        // We have to load the view first
        $this->load->model('Plan_model');
        
        $price = 59.99;
        
        $this->form_validation->set_rules('legal_full_name','Full name or Business name','trim|required|xss_clean');
        $this->form_validation->set_rules('agreement','Agreement','trim|required|xss_clean|exact_length[1]');
        
        /*
         * If you want your messages to appeare you have to implement this if statement
         * Reload the original page don't redirect
         */
        if ($this->form_validation->run() == FALSE){
            $this->load->model('Buyorsell_model');
            
				// Here we are getting the user profile image
        	$data['im_prof'] = $this->User_model->get_im_profile(); 
                // This out puts the ad
            $data['ads']          = $this->User_model->get_ads();
            // This is for the right Ads content in exotic's page
            $data['spons']        = $this->Buyorsell_model->pets_sponsord();
            $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
			
            $this->load->view('layouts/includes/header'); 
            $this->load->view('layouts/includes/navigator',$data);
            $this->load->view('pageplan/okapi',$data);
            $this->load->view('layouts/includes/footerbuyorsell'); 
            
        } else {
        
            $this->Plan_model->okapi_valid();
        
            redirect('plan/registration');
        }
        
    }
    
    // This is the eagle plan funtion it uses also address_sub
    public function eagle_valid(){ 
        
        // We have to load the view first
        $this->load->model('Plan_model');
        
        $price = 79.99;
        
        $this->form_validation->set_rules('legal_full_name','Full name or Business name','trim|required|xss_clean');
        $this->form_validation->set_rules('agreement','Agreement','trim|required|xss_clean|exact_length[1]');
        
        /*
         * If you want your messages to appeare you have to implement this if statement
         * Reload the original page don't redirect
         */
        if ($this->form_validation->run() == FALSE){
            $this->load->model('Buyorsell_model');
            	// Here we are getting the user profile image
        	$data['im_prof'] = $this->User_model->get_im_profile(); 
                // This out puts the ad
            $data['ads']          = $this->User_model->get_ads();
            // This is for the right Ads content in exotic's page
            $data['spons']        = $this->Buyorsell_model->pets_sponsord();
            $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
			
            $this->load->view('layouts/includes/header'); 
            $this->load->view('layouts/includes/navigator',$data);
            $this->load->view('pageplan/eagle',$data);
            $this->load->view('layouts/includes/footerbuyorsell'); 
            
        } else {
        
            $this->Plan_model->eagle_valid();
        
            redirect('plan/registration');
        }
        
    }
    
    /*public function address_sub(){
        
        // We are loading the view first
        $this->load->model('Plan_model');
        
        $this->form_validation->set_rules('address','Address','trim|required|xss_clean');
        $this->form_validation->set_rules('city','City','trim|required|xss_clean');
        $this->form_validation->set_rules('address_line_2','Address line 2','trim|required|xss_clean');
        $this->form_validation->set_rules('state','State','trim|required|xss_clean');
        $this->form_validation->set_rules('zip_code','Zip code','numeric');
        $this->form_validation->set_rules('country','Country','trim|required|xss_clean');
        $this->form_validation->set_rules('phone_number','Phone number','trim|required|xss_clean');
        $this->form_validation->set_rules('credit_card_type','Credit Card Type','trim|required|xss_clean');
        $this->form_validation->set_rules('credit_card_number','Credit Card Number','numeric');
        $this->form_validation->set_rules('exp_month','Expiration month','trim|required|xss_clean');
        $this->form_validation->set_rules('exp_year','Expiration year','trim|required|xss_clean');
        $this->form_validation->set_rules('cvv','CVV','trim|required|xss_clean');
        $this->form_validation->set_rules('cardholder_name','Cardholder name','trim|required|xss_clean');
        $this->form_validation->set_rules('your_order_total','Order total','trim|xss_clean');
        
        if ($this->form_validation->run() == FALSE){
            
            if($this->session->userdata('plan_name') == 'mayfly'){
            $data['price'] = '$9.99';
            } elseif($this->session->userdata('plan_name') == 'okapi'){
                $data['price'] = '$59.99' ;
            }elseif($this->session->userdata('plan_name') == 'agama'){
                $data['price'] = '$29.99' ;
            }elseif($this->session->userdata('plan_name') == 'eagle'){
                $data['price'] = '$79.99' ;
            }
            
            $this->load->model('Buyorsell_model');
            
            $this->load->view('layouts/includes/header'); 
            $this->load->view('layouts/includes/navigator');
                // This out puts the ad
            $data['ads']          = $this->User_model->get_ads();
            // This is for the right Ads content in exotic's page
            $data['spons']        = $this->Buyorsell_model->pets_sponsord();
            $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
            $this->load->view('pageplan/registration',$data);
            $this->load->view('layouts/includes/footerbuyorsell'); 
            
        } else {
            
        
            $this->Plan_model->address_sub();
            $this->Plan_model->credit_card_sub();
        
            redirect('plan/verification/'.$this->session->userdata('username'));
        }
    }*/
    
    // Do not forget to load you variable to the page
    /*public function verification($username){ 
        
        //We are going to load the model first
        $this->load->model('Plan_model');
        
        // If one of this plans are true display there price
        if($this->session->userdata('plan_name') == 'mayfly'){
            $data['price'] = '$9.99';
        } elseif($this->session->userdata('plan_name') == 'okapi'){
            $data['price'] = '$59.99' ;
        }elseif($this->session->userdata('plan_name') == 'agama'){
            $data['price'] = '$29.99' ;
        }elseif($this->session->userdata('plan_name') == 'eagle'){
            $data['price'] = '$79.99' ;
        }
        
        $data['verification'] = $this->Plan_model->verification($username);
        
        $this->load->model('Buyorsell_model');
        
        $this->load->view('layouts/includes/header'); 
        $this->load->view('layouts/includes/navigator');
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in exotic's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $this->load->view('pageplan/verification', $data);
        $this->load->view('layouts/includes/footerbuyorsell'); 
        
    }*/ 
    
    /*public function plan_choice(){
        
         // We are loading the view first
        $this->load->model('Plan_model');           
        
            $this->Plan_model->plan_choice_accepted();
        
            redirect('user/offers/'.$this->session->userdata('username'));
        
    }*/
        
}    