<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

//class Dogs extends CI_Controller {
/*
 * You will find the ads or sponsor nav in the 'layouts' inside 'includes' and the name is 'asiderightads'
 *
 *
 */
class Buyorsell extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        } 
    
        // this is the report
    public function badbo(){
        
        // Loads the model
        $this->load->model('Buyorsell_model');
        
            // re009919 is the placeholder for reporting about was <=> name = 'report' <=> name = 're009919'
        $this->form_validation->set_rules('re009919','','trim|xss_clean|alpha|required');
            // f0098 is the placeholder for the $pet->id 
        $this->form_validation->set_rules('f0098','','trim|xss_clean|alpha|required');
            // x0098 is the placeholder for the $pet->username <=> posted by or pet owner 
        $this->form_validation->set_rules('x0098','','trim|xss_clean|alpha|required');
            // i0078 is the placeholder for the $pet->pet_name 
        $this->form_validation->set_rules('i0078','','trim|xss_clean|alpha|required');
            // o007 is the placeholder for the $pet->pet_kind 
        $this->form_validation->set_rules('o007','','trim|xss_clean|alpha|required');
            // d666 is the placeholder for the $pet->plan_name 
        $this->form_validation->set_rules('d666','','trim|xss_clean|alpha|required');
            // d666 is the placeholder for the report_message 
        $this->form_validation->set_rules('dfg34535345','','trim|xss_clean|alpha');
        
        $this->Buyorsell_model->report();
        $this->session->set_flashdata('report_success','Your report has been sent');
        
        redirect('Buyorsell/index');
    }
    
    
    public function index(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']        = $this->Buyorsell_model->pets_sponsordfoot();
            //main_content which will load the pagebuyorsell and find the index function
        $data['main_content'] = 'pagebuyorsell/index';
        $this->load->view('layouts/mainbuyorsell',$data);
    }

/*
 **
 **** See more details about the animals/pets
 **
 */
    public function more($id){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']        = $this->Buyorsell_model->pets_sponsordfoot();
        $data['pet'] = $this->Buyorsell_model->more($id);
        $data['main_content'] = 'pagebuyorsell/more';
        $this->load->view('layouts/mainbuyorsell',$data);
    }
    
/*
 **
 **** Dog section page settings
 **
 */
    public function dog(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/dog';
            // This gets the total row from my dogs' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_dog();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_dogs($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_dog();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
        $data['all']          = $this->Buyorsell_model->record_count_dog();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in dog's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']        = $this->Buyorsell_model->pets_sponsordfoot();
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets']         = $this->Buyorsell_model->pets_dogs();
        $data['main_content'] = 'pagebuyorsell/dog';
        $this->load->view('layouts/mainbuyorsell',$data);
    }
    
/*
 **
 **** Cat section page settings
 **
 */
    public function cat(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/cat';
            // This gets the total row from my cats' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_cat();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
            // This will return the number rather that the total number of item in the page
            // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            // Use this variable if you want to set the pagination if not nothing will happen
        $data['results']      = $this->Buyorsell_model->fetch_cats($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_cat();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_cat();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in cat's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
            // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets'] = $this->Buyorsell_model->pets_cats();
        $data['main_content'] = 'pagebuyorsell/cat';
        $this->load->view('layouts/mainbuyorsell',$data);
    }
    
/*
 **
 **** Bird section page settings
 **
 */    
    public function bird(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/bird';
            // This gets the total row from my birds' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_bird();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // This will return the number rather that the total number of item in the page
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_birds($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_bird();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
            // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_bird();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in bird's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets'] = $this->Buyorsell_model->pets_birds();
        $data['main_content'] = 'pagebuyorsell/bird';
        $this->load->view('layouts/mainbuyorsell',$data);
    }
    
/*
 **
 **** Fish section page settings
 **
 */    
    public function fish(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
         
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/fish';
            // This gets the total row from my fishs' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_fish();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // This will return the number rather that the total number of item in the page
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_fishs($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_fish();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_fish();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in fish's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets'] = $this->Buyorsell_model->pets_fishs();
        $data['main_content'] = 'pagebuyorsell/fish';
        $this->load->view('layouts/mainbuyorsell',$data);
    }

/*
 **
 **** Small pet section page settings
 **
 */    
    public function smallpet(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/smallpet';
            // This gets the total row from my smallpets' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_smallpet();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // This will return the number rather that the total number of item in the page
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_smallpets($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_smallpet();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_smallpet();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in smallpet's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets'] = $this->Buyorsell_model->pets_smallpets();
        $data['main_content'] = 'pagebuyorsell/smallpet';
        $this->load->view('layouts/mainbuyorsell',$data);
    }

/*
 **
 **** Reptile section page settings
 **
 */    
    public function reptile(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/reptile';
            // This gets the total row from my reptiles' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_reptile();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // This will return the number rather that the total number of item in the page
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_reptiles($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_reptile();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_reptile();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot(); 
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets'] = $this->Buyorsell_model->pets_reptiles();
        $data['main_content'] = 'pagebuyorsell/reptile';
        $this->load->view('layouts/mainbuyorsell',$data);
    }

/*
 **
 **** Horse section page settings
 **
 */    
    public function horse(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/horse';
            // This gets the total row from my horses' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_horse();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // This will return the number rather that the total number of item in the page
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_horses($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_horse();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_horse();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in horse's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets']         = $this->Buyorsell_model->pets_horses();
        $data['main_content'] = 'pagebuyorsell/horse';
        $this->load->view('layouts/mainbuyorsell',$data);
    }
    
/*
 **
 **** Farm animals section page settings
 **
 */    
    public function farmanimals(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/farmanimals';
            // This gets the total row from my farmanimals' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_farmanimal();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // This will return the number rather that the total number of item in the page
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_farmanimals($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_farmanimal();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_farmanimal();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in farmanimal's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets']         = $this->Buyorsell_model->pets_farmanimals();
        $data['main_content'] = 'pagebuyorsell/farmanimals';
        $this->load->view('layouts/mainbuyorsell',$data);
    }
    
/*
 **
 **** Exotic section page settings
 **
 */    
    public function exotic(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/exotic';
            // This gets the total row from my exotics' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_exotic();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // This will return the number rather that the total number of item in the page
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_exotics($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_exotic();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_exotic();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in exotic's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets'] = $this->Buyorsell_model->pets_exotics();
        $data['main_content'] = 'pagebuyorsell/exotic';
        $this->load->view('layouts/mainbuyorsell',$data);
    }
    
/*
 **
 **** Insect section page settings
 **
 */    
    public function insect(){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/Buyorsell/insect';
            // This gets the total row from my insects' table
        $config['total_rows']  = $this->Buyorsell_model->record_count_insect();
            // Show 40 elements per page
        $config['per_page']    = 24; 
            // Use the third segment to show the page number
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
        // This will return the number rather that the total number of item in the page
        // Something bizard happen when you call this 
        //$config['use_page_numbers'] = TRUE;

            // This initialize all our pagination $configs
        $this->pagination->initialize($config); 

        $page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results']      = $this->Buyorsell_model->fetch_insects($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        
        $data['getAll']       = $this->Buyorsell_model->record_count_insect();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['all']          = $this->Buyorsell_model->record_count_insect();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in insect's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        // Instead of returning this variable will should return the result above
            // Because it returns the pagination
        //$data['pets'] = $this->Buyorsell_model->pets_insects();
        $data['main_content'] = 'pagebuyorsell/insect';
        $this->load->view('layouts/mainbuyorsell',$data);
    }
    
/*
 **
 **** Basket section page settings
 **
 */    
    public function basket(){
        $this->load->model('Buyorsell_model'); 
        $this->load->helper('text');
        
         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'pagebuyorsell/basket';
        $this->load->view('layouts/mainbuyorsell',$data);
    } 
    
        // here we are adding to the cart 'atc' is use only for protection purposes
    public function atc(){
        $this->load->model('Buyorsell_model');
        
        $this->form_validation->set_rules('nmbHErBMPp','Price','trim|xss_clean');
        $this->form_validation->set_rules('FxuLILgfgT','','trim|xss_clean');
        $this->form_validation->set_rules('IsnUHQOuHm','','trim|xss_clean');
        $this->form_validation->set_rules('JtIAIvuNhd','','trim|xss_clean');
        $this->form_validation->set_rules('lkCqTkhoTP','','trim|xss_clean');
        $this->form_validation->set_rules('SaWJWLiitH','','trim|xss_clean');
        $this->form_validation->set_rules('eDhibtuTnR','','trim|xss_clean');
        $this->form_validation->set_rules('ByOjKsHQjw','','trim|xss_clean');
        
        $this->Buyorsell_model->add_to_cart();
        
        redirect('Buyorsell/basket');
    }
    
    public function update_cart(){
        $this->load->model('Buyorsell_model');
        
        $this->Buyorsell_model->update_cart();
        
        redirect('Buyorsell/basket', 'refresh');
    }
    
    public function send_order(){
        
        $this->load->model('Buyorsell_model');
        $this->Buyorsell_model->send_order();
        $this->cart->destroy();
        redirect('Buyorsell/basket', 'refresh');
    }
}    