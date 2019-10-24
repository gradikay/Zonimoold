<?php
// ALWAYS LOAD YOUR MODELS
class Image extends CI_Controller {
     
    public function __construct()
        {
                parent::__construct();
        }
     
     //Load the image page
    public function image_page(){
        $this->load->model('Image_model');
        // To simplify thing we are taking the ads or sponsorized items from the buyorsell model 
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
         /*
         * ******************** Pagination setting
         */
        $config['base_url']   = base_url(). '/image/image_page';
        // NOTE: Load your model
        // This gets the total row from my dogs' table
        $config['total_rows'] = $this->Image_model->record_count();
        $data['total_rows'] = $this->Image_model->record_count();
        // Show 40 elements per page
        $cat = $this->Image_model->cta();
        $cat2 = $this->Image_model->ctu();
        
        $config['per_page']   = 40 ; 
         
        // Use the third segment to show the page number
        $config["uri_segment"]= 3;
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

        // Use the third segment of the url to display the page number
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$cta  = $this->Image_model->cta();
        //$ctu  = $this->Image_model->ctu();
        //$ctat = ($config['per_page'] - ($cta))/2;
        //$ctut = ( - ($ctu))/2;
        //$data['results']  = $this->Image_model->fetch_images($ctut, $page);
        $data['results'] = $this->Image_model->fetch_image($config['per_page'], $page);
        // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links'] = $this->pagination->create_links();
        
          // No need to use it we are already using resutls above
        //$data['image'] = $this->Image_model->get_animal_image();
        //$data['animals'] = $this->Main_model->get_animals();    
        //$data['lists'] = $this->Main_model->get_databases();  
        //$data['users'] = $this->Main_model->get_users();
        
       // $data['main_content'] = 'page/monotremes';
       // $this->load->view('layouts/main',$data);
        
            // Here we are getting the user profile image
        $data['im_prof']      = $this->User_model->get_im_profile();
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $this->load->view('layouts/includes/header'); 
        $this->load->view('layouts/includes/navigator',$data); 
        //Don't forget to load the data in order to use it
         $this->load->view('image',$data);
    }
	
}
