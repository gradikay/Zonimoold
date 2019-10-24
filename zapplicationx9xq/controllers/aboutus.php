<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Dogs extends CI_Controller {
class Aboutus extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        }
    
    public function index(){ 
        
        $this->load->view('about_us');
        
    } 
    
}    