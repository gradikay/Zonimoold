<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Dogs extends CI_Controller {
class Lostpet extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        }
    
    public function index(){
        $this->load->model('Lostpet_model');
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
       /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Lostpet/index';
            // This gets the total row from my cats' table
        $config['total_rows']  = $this->Lostpet_model->record_count_lost();
            // Show 40 elements per page
        $config['per_page']    = 10; 
            // Use the fourth segment to show the page number
        $config["uri_segment"] = 3;
            // the number of digit links after the one selected
        $config['num_links'] = 2;
        $config['full_tag_open']  = '<ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul>';
            //The opening tag for the "digit" link.
        $config['num_tag_open'] = '<li>';
            //The closing tag for the "digit" link.
        $config['num_tag_close'] = '</li>';
            //The text you would like shown in the "previous" page link. If you do not want this link rendered, you can set its value to FALSE.
        $config['prev_link'] = 'Previous';
            //The opening tag for the "previous" link.
        $config['prev_tag_open'] = '<li>';
            //The closing tag for the "previous" link.
        //The closing tag for the "digit" link.
        $config['prev_tag_close'] = '</li>';
            //The text you would like shown in the "previous" page link. If you do not want this link rendered, you can set its value to FALSE.
        $config['next_link'] = 'Next';
            //The opening tag for the "previous" link.
        $config['next_tag_open'] = '<li>';
            //The closing tag for the "previous" link.
        $config['next_tag_close'] = '</li>';
            //The opening tag for the "current" link.
        $config['cur_tag_open'] = '<li class="active"><span>';
            //The closing tag for the "current" link.
        $config['cur_tag_close'] = '</span> </li>';
            //The text you would like shown in the "last" link on the right. If you do not want this link rendered, you can set its value to FALSE.
        $config['last_link'] = 'Last';
            //The opening tag for the "last" link.
        $config['last_tag_open'] = '<li>';
            //The closing tag for the "last" link
        $config['last_tag_close'] = '</li>';
            //The text you would like shown in the "first" link on the left. If you do not want this link rendered, you can set its value to FALSE.
        $config['first_link'] = 'First';
            //The opening tag for the "first" link.
        $config['first_tag_open'] = '<li>';
            //The closing tag for the "first" link.
        $config['first_tag_close'] = '</li>';

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

            // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
            // This will take the 4 segment after facto to post the page number
        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            // This is the results from our table combined with the pagination reconization
        $data['results']      = $this->Lostpet_model->fetch_lost_pet($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'pagelostpet/index';
        $this->load->view('layouts/mainlostpet',$data);
    }
    
    public function foundpet(){
        $this->load->model('Lostpet_model');
        $this->load->model('Buyorsell_model');
        $this->load->helper('text'); 
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Lostpet/foundpet';
            // This gets the total row from my cats' table
        $config['total_rows']  = $this->Lostpet_model->record_count_found();
            // Show 40 elements per page
        $config['per_page']    = 10; 
            // Use the fourth segment to show the page number
        $config["uri_segment"] = 3;
            // the number of digit links after the one selected
        $config['num_links'] = 2;
        $config['full_tag_open']  = '<ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul>';
            //The opening tag for the "digit" link.
        $config['num_tag_open'] = '<li>';
            //The closing tag for the "digit" link.
        $config['num_tag_close'] = '</li>';
            //The text you would like shown in the "previous" page link. If you do not want this link rendered, you can set its value to FALSE.
        $config['prev_link'] = 'Previous';
            //The opening tag for the "previous" link.
        $config['prev_tag_open'] = '<li>';
            //The closing tag for the "previous" link.
        //The closing tag for the "digit" link.
        $config['prev_tag_close'] = '</li>';
            //The text you would like shown in the "previous" page link. If you do not want this link rendered, you can set its value to FALSE.
        $config['next_link'] = 'Next';
            //The opening tag for the "previous" link.
        $config['next_tag_open'] = '<li>';
            //The closing tag for the "previous" link.
        $config['next_tag_close'] = '</li>';
            //The opening tag for the "current" link.
        $config['cur_tag_open'] = '<li class="active"><span>';
            //The closing tag for the "current" link.
        $config['cur_tag_close'] = '</span> </li>';
            //The text you would like shown in the "last" link on the right. If you do not want this link rendered, you can set its value to FALSE.
        $config['last_link'] = 'Last';
            //The opening tag for the "last" link.
        $config['last_tag_open'] = '<li>';
            //The closing tag for the "last" link
        $config['last_tag_close'] = '</li>';
            //The text you would like shown in the "first" link on the left. If you do not want this link rendered, you can set its value to FALSE.
        $config['first_link'] = 'First';
            //The opening tag for the "first" link.
        $config['first_tag_open'] = '<li>';
            //The closing tag for the "first" link.
        $config['first_tag_close'] = '</li>';

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

            // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
            // This will take the 4 segment after facto to post the page number
        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Lostpet_model->fetch_found_pet($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in exotic's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'pagelostpet/foundpet';
        $this->load->view('layouts/mainlostpet',$data);
    }
}    