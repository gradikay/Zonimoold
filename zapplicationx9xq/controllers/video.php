<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Dogs extends CI_Controller {
class Video extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        }
    
    public function index(){
        
        $this->load->model('Video_model');
        
            // REMOVE THE CATS'MODEL
            // Loads the model
        //%$this->load->model('Cats_model');
        
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

        //%$page                 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //%$data['results']      = $this->Cats_model->fetch_cats($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        //%$data['links']        = $this->pagination->create_links();        
        
       // %$data['getAll']       = $this->Cats_model->return_row_count();
            //This will find mainbuyorsell in the layouts file and we will declare the variable 
            //main_content which will load the pagebuyorsell and find the index function
        $data['topFour'] = $this->Video_model->four_top_videos();
        $data['main_content'] = 'pagevideo/index';
        $this->load->view('layouts/mainvideo',$data);
    } 
    public function search(){
        $data['main_content'] = 'pagevideo/search';
        $this->load->view('layouts/mainvideo',$data);
    }
    public function watch(){
        $data['main_content'] = 'pagevideo/watch';
        $this->load->view('layouts/mainvideo',$data);
    }
}    