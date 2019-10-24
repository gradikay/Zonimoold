<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Dogs extends CI_Controller {
class Agreement extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        }
    
    public function index(){ 
        // To simplify thing we are taking the ads or sponsorized items from the buyorsell model 
        $this->load->model('Buyorsell_model');
        
        // This is for the right Ads content in dog's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']        = $this->Buyorsell_model->pets_sponsordfoot();
        $this->load->view('agreement',$data);
        
        
    } 
    
}    