<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sqltry extends CI_Controller {
    public function index(){
        $data['counts'] = $this->Sqltry_model->mydatabase(); 
        
        $this->load->view('sql_try', $data);
    }    
}    