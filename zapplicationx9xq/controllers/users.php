<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
     
    public function __construct()
        {
                parent::__construct();
        }
    
    public function signup(){
        $this->session->set_flashdata('signup','You have to register or signin in order to edit a content.');
                redirect('users/signin');
    }

	public function register(){
        
        //Validation Rules
        $this->form_validation->set_rules('first_name','lang:first_name','trim|required|xss_clean');
        $this->form_validation->set_rules('last_name','lang:last_name','trim|required|xss_clean');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users_maxy99zx99.email]');
        $this->form_validation->set_rules('email_again','Email','trim|required|matches[email]');
        $this->form_validation->set_rules('birthdate','Birthdate','required');
        $this->form_validation->set_rules('termsAndConditions','Terms and Conditions','required');        
        $this->form_validation->set_rules('username','lang:username','trim|required|min_length[4]|max_length[16]|is_unique[users_maxy99zx99.username]|xss_clean');
        // this sets the message custom for the field of your need
        // just add the %s to replace it with the name appropriete
        // everywhere where we call the is_unique the %s will equal to the seconde name 'not here', 'here'
        $this->form_validation->set_message('is_unique', 'This %s has already been used');
        //This will make the names translatable
        $lang['first_name'] = 'First Name';
        $lang['last_name'] = 'Last Name';
        $lang['username'] = 'Username';
        $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]|md5');
        $this->form_validation->set_rules('password_again','Confirm Password ','trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE){
            //Show view
            
            $this->load->view('register');
		} else {
            
            
                // Here we are sending the User the email
            $email  = $this->input->post('email');
            $name   = $this->input->post('first_name');
            
            $this->load->library('email');

            $this->email->from('webmaster@zonimo.com', 'zonimo.com');
            $this->email->to($email);
                //This will make sure that I receive a copy of emails emailed to my suscribers
                //With them seeing my email address
            //$this->email->cc('another@another-example.com');
                //This will make sure that I receive a copy of emails emailed to my suscribers
                //Without them seeing my email address
            $this->email->bcc('gradi_kayamba@yahoo.com');

            $this->email->subject('Welcome '. $name .' To Zonimo "Home Of The Cutest"');
           // $this->email->set_header('Your comfirmation is needed', $name .'click on the link below');
            $this->email->message('Hi '. $name . '. Welcome to Zonimo.com.' );

                // Here we are sending the message
            $this->email->send();
			
            
            $result = $this->User_model->register();
            
			if($result){
                 $this->session->set_flashdata('registered','You are now register and can Log In');
                
				// Activate this when you set up the email confirmation
				//$this->session->set_flashdata('registered','A confirmation email has been set to your email address make sure to check your Spam if you do not see our email.');
                redirect('users/signin','refresh');
            }
		}
        
        
    }
    
    /*
     * Log in users
     */
    public function signin(){
        // In user_model get the get_user() function so that I can use the Variable $users
            
        $this->load->view('signin');
    }
    
    public function login(){ 
        
        $this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[16]|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]|md5');
        
        $username = $this->input->post('username');
        // Here we are matching the password from the register data 
        // With the one the user used to loggedin
        $password = md5($this->input->post('password'));
        
        $this_session = $this->User_model->login($username, $password);
        
        //Validate User
        if($this_session){
            /* Old
            // Here we set our selection or the item we want to save in the session
            $this->db->select('plan_name, email, first_name, last_name, birthdate, join_date, profile_picture, address, address_line_2, city, state, zip_code, country, phone_number, credit_card_type, credit_card_number, exp_month, exp_year, cvv, cardholder_name ');
            $this->db->from('users as U');
            $this->db->join('users_address as A','U.username = A.username','INNER');
            $this->db->join('users_credit_card as C','U.username = C.username','INNER');
            $this->db->where('U.username',$username);
            
            //Here we get those items
            $query = $this->db->get();

            // Here we call a foreach loop to help us set the variables that we need
            foreach ($query->result() as $row)
            {            
            //Create array of user data
            $data = array( 
                
                // This will hold the value of the login in the User_model
                'this_session'       => $this_session,
                'username'           => $username,
                'plan_name'          => $row->plan_name,
                'email'              => $row->email,
                'first_name'         => $row->first_name,
                'last_name'          => $row->last_name,
                'birthdate'          => $row->birthdate,
                'join_date'          => $row->join_date,
                'profile_picture'    => $row->profile_picture,
                'address'            => $row->address,
                'address_line_2'     => $row->address_line_2,
                'city'               => $row->city,
                'state'              => $row->state,
                'zip_code'           => $row->zip_code,
                'country'            => $row->country,
                'phone_number'       => $row->phone_number,
                'credit_card_type'   => $row->credit_card_type,
                'credit_card_number' => $row->credit_card_number,
                'exp_month'          => $row->exp_month,
                'exp_year'           => $row->exp_year,
                'cvv'                => $row->cvv,
                'cardholder_name'    => $row->cardholder_name,
                // Logged_in we make it equal to true so that we know if the persone as signin
                'logged_in'      => true
            );
            
            }
            //Set session userdata
            $this->session->set_userdata($data);*/
            
            //$data = array(
            //    'this_session'       => $this_session,
            //    'username'           => $username,
            //    'logged_in'          => true
            //);
            
            // New users can't sign in with the code up there 
            // Here we set our selection or the item we want to save in the session to retreive later
            $this->db->select('plan_name, email, first_name, last_name, birthdate, join_date, profile_picture, address, address_line_2, city, state, zip_code, country, address_bill, address_line_2_bill, city_bill, state_bill, zip_code_bill, country_bill, A.phone_number, credit_card_type, credit_card_number, exp_month, exp_year, cvv, cardholder_name ');
            $this->db->from('users_maxy99zx99 as U');
            $this->db->join('users_address as A','U.username = A.username','INNER');
            $this->db->join('users_address_bill as B','U.username = B.username','INNER');
            $this->db->join('users_credit_card as C','U.username = C.username','INNER');
            $this->db->join('plan as P','U.username = P.username','INNER');
            $this->db->where('U.username',$username);
            
            //Here we get those items
            $query = $this->db->get();

            foreach ($query->result() as $row)
            {            
            $data2 = array(   
                'plan_name'          => $row->plan_name,
                'email'              => $row->email,
                'first_name'         => $row->first_name,
                'last_name'          => $row->last_name,
                'birthdate'          => $row->birthdate,
                'join_date'          => $row->join_date,
                'profile_picture'    => $row->profile_picture,
                'address'            => $row->address,
                'address_line_2'     => $row->address_line_2,
                'city'               => $row->city,
                'state'              => $row->state,
                'zip_code'           => $row->zip_code,
                'country'            => $row->country,
                'address_bill'       => $row->address_bill,
                'address_line_2_bill'=> $row->address_line_2_bill,
                'city_bill'          => $row->city_bill,
                'state_bill'         => $row->state_bill,
                'zip_code_bill'      => $row->zip_code_bill,
                'country_bill'       => $row->country_bill,
                'phone_number'       => $row->phone_number,
                'credit_card_type'   => $row->credit_card_type,
                'credit_card_number' => $row->credit_card_number,
                'exp_month'          => $row->exp_month,
                'exp_year'           => $row->exp_year,
                'cvv'                => $row->cvv,
                'cardholder_name'    => $row->cardholder_name,   
                
            );
            
            $data1 = array(  
            'this_session'       => $this_session,
            'username'           => $username,  
            'logged_in'          => true    
                
            );    
            }
            // Here we call a foreach loop to help us set the variables that we need
            
            //Create array of user data
            //$data = array( 
                
                // This will hold the value of the login in the User_model
                //'this_session'       => $this_session,
                //'username'           => $username,
                //'first_name'         => $first_name,
                //'logged_in'          => true
            //);
            //Set session userdata
            $data = array_merge($data1,$data2);
            $this->session->set_userdata($data);
            // Debugging
            //print_r(array_merge($data1,$data2));
            //die();
            
            //Set message
            $this->session->set_flashdata('pass_login','You are successfuly logged in');
            
            redirect('welcome/index'); 
            
        } else {
            
            //Set error
            $this->session->set_flashdata('fail_login','Password or username invalid');
            
            redirect('users/signin');
        }
    }
    
    
    
    // To logout we have to unset all the userdata
    public function logout(){
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        
        redirect('main/index');
    }
    
}
