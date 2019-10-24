<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Success extends CI_Controller {
    public function __construct()
        {
                parent::__construct(); 
        }
    
    public function ad_success(){
        $this->load->model('Success_model');
         
        $this->Success_model->success_ad();
        
        // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
        
        /*
        // This is the amount of the item
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');
        */
        
        $this->session->set_flashdata('success_paid',"Your payment of $$amount $currency is complete and your Ad has been published. See 'My published Ad' ");
        
        redirect('user/ads/'. $this->session->userdata('username'));
    }
     
    public function ad_failed(){
        
         $this->session->set_flashdata('success_failed'," Oops! Your payment was not made ! ");
        
        redirect('user/ads/'. $this->session->userdata('username'));
    }
    
    public function lost_success(){
        $this->load->model('Success_model');
        
        $this->Success_model->success_lost();
        
        // Live code
        /*
        // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
        */
        
        // Test code
        // This is the amount of the item
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');
        
        $this->session->set_flashdata('success_paid',"Your payment of $$amount $currency is complete and your Alert has been published. See 'My Lost Report' ");
        
        redirect('user/lostfound/'. $this->session->userdata('username'));
    }
    
    public function lost_failed(){
        
         $this->session->set_flashdata('success_failed'," Oops! Your payment was not made ! ");
        
        redirect('user/lostfound/'. $this->session->userdata('username'));
    }
    
    public function planmayfly_success(){
        $this->load->model('Success_model');
        
        $this->Success_model->success_mayfly();
        
        // This is live code
        // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
        
        /*/ This is test code
            //This is the amount of the item
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');*/
        
        
        $this->session->set_flashdata('success_paid',"Your payment of $$amount USD is complete and your Mayfly Plan is up and running.");
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
    public function planmayfly_failed(){
        
        $this->session->set_flashdata('success_failed'," Oops! Your payment was not made ! ");
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
    public function planagama_success(){
        $this->load->model('Success_model');
        
        $this->Success_model->success_agama();
        
        // Live code 
        // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
        
        /*/Test code
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');*/
        
$this->session->set_flashdata('success_paid',"Your payment of $$amount USD is complete and your Agama Plan is up and running. ");
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
    public function planagama_failed(){
        
        $this->session->set_flashdata('success_failed'," Oops! Your payment was not made ! ");
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
    public function planokapi_success(){
        $this->load->model('Success_model');
        
        $this->Success_model->success_okapi();
        
        // This is the live code
        // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
        
        /*/ This is the test code
        $amount = $this->input->post('amt');
            // This is the currency default USD
        $currency = $this->input->post('cc');*/
        
        $this->session->set_flashdata('success_paid',"Your payment of $$amount USD is complete and your Okapi Plan is up and running. ");
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
    public function planokapi_failed(){
        
        $this->session->set_flashdata('success_failed'," Oops! Your payment was not made ! ");
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
    public function planeagle_success(){
        $this->load->model('Success_model');
        
        $this->Success_model->success_eagle();
        
        // This is the amount of the item
        $amount = $this->input->get('amt');
            // This is the currency default USD
        $currency = $this->input->get('cc');
        
        $this->session->set_flashdata('success_paid',"Your payment of $$amount USD is complete and your Eagle Plan is up and running. ");
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
    public function planeagle_failed(){
        
        $this->session->set_flashdata('success_failed'," Oops! Your payment was not made ! ");
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
}
