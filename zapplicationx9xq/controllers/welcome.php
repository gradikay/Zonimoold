<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        }
    
    //Load the monotrema's page
    public function index(){
        //$data['animals'] = $this->Main_model->get_animals();    
        //$data['lists'] = $this->Main_model->get_databases();  
        //$data['users'] = $this->Main_model->get_users();
        
        //$data['main_content'] = 'page/monotremes';
        $this->load->view('welcome');
    }    
}    