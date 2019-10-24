<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cancel extends CI_Controller {
    public function __construct()
        {
                parent::__construct();
        }

    public function cancel_ad(){
        
        $this->load->model('Cancel_model');
        
        $this->Cancel_model->cancel_ad();
        
        $this->session->set_flashdata('delete_ad',' Your ad has been canceled');
        
        redirect('user/ads/'. $this->session->userdata('username'));
    }
    public function cancel_lost(){
        
        $this->load->model('Cancel_model');
        
        $this->Cancel_model->cancel_lost();
        
        $this->session->set_flashdata('deletedLost',' Your post has been canceled');
        
        redirect('user/lostfound/'. $this->session->userdata('username'));
    }
    

    
}
