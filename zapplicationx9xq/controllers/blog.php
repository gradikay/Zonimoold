<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Dogs extends CI_Controller {
class Blog extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        }
    
    public function index(){ 
        
            // REMOVE THE CATS'MODEL
            // Loads the model
        $this->load->model('Blog_model');
        // To simplify thing we are taking the ads or sponsorized items from the buyorsell model 
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        /*
         * ******************** Pagination setting
         */
        //%$config['base_url']    = base_url(). '/Cats/cats';
            // This gets the total row from my cats' table
        //%$config['total_rows']  = $this->Cats_model->record_count();
            // Show 40 elements per page
        //%$config['per_page']    = 40; 
            // Use the third segment to show the page number
        //%$config["uri_segment"] = 3;        

            // This initialize all our pagination $configs
        //%$this->pagination->initialize($config); 

        //%$data['results']      = $this->Cats_model->fetch_cats($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        //%$data['links']        = $this->pagination->create_links();        
        
       // %$data['getAll']       = $this->Cats_model->return_row_count();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
            // Here we are getting the user profile image
        $data['im_prof']      = $this->User_model->get_im_profile();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();    
        $data['topnews']      = $this->Blog_model->top_posts();
        $data['popular']      = $this->Blog_model->most_popular_post();
        $data['posts']        = $this->Blog_model->four_top_posts();
        $data['main_content'] = 'pageblog/index';
        $this->load->view('layouts/mainblog',$data);
        
    } 
    public function read($id){
        // To simplify thing we are taking the ads or sponsorized items from the buyorsell model 
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        $this->load->model('Blog_model');
        
            // Here we are getting the user profile image
        $data['im_prof']      = $this->User_model->get_im_profile();
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['popular']      = $this->Blog_model->more($id);
        $data['main_content'] = 'pageblog/read';
        $this->load->view('layouts/mainblog',$data);
        
        
    }
    
    public function comment(){
        
        $this->form_validation->set_rules('comment','','trim|xss_clean|alpha');      
        $this->form_validation->set_rules('blog_title','','trim|xss_clean|alpha');      
        
        
        if ($this->form_validation->run() == FALSE){            
            
            $this->Blog_model->comment();
            
        }
    }
}    