<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Factopedia extends CI_Controller {
class Geeses extends CI_Controller {
    
			// We are setting our global variable calling the model
		private $model = '';	
			// We are setting our global variable for redirecting to this page
		private $redirecteur = '';	
		// We are setting our global variable calling the Count model for the total number of 
			// animals in out entire database
 		private $c_model = '';
			// We are setting our global variable for buyorsell model
		private $buyorsell_model = '';	
	
    public function __construct()
        {
                parent::__construct();
				
					// Set the variable for $model above
				$this->model = 'factopedia/Geeses_model';
					// Set the variable for $redirecteur above
				$this->redirecteur = 'facto/Geeses/geeses';
					// Set the variable for $c_model above
				$this->c_model = 'factopedia/Count_model';
					// Set the variable for $Buyorsell_model above
				$this->buyorsell_model = 'Buyorsell_model';
        } 
    
        // Geese report
    public function youport(){
        
        // Loads the model
        $this->load->model($this->model);
        // We use the cat_model for the report(); this simplify life
        $this->load->model('factopedia/Cats_model');
        
            // re009919 is the placeholder for reporting about was <=> name = 'report' <=> name = 're009919'
        $this->form_validation->set_rules('re009919','','trim|xss_clean|alpha|required');
            // f0098 is the placeholder for the $animal->id 
        $this->form_validation->set_rules('f0098','','trim|xss_clean|alpha|required');
            // x0098 is the placeholder for the $animal->name 
        $this->form_validation->set_rules('x0098','','trim|xss_clean|alpha|required');
            // i0078 is the placeholder for the $animal->section_id 
        $this->form_validation->set_rules('i0078','','trim|xss_clean|alpha|required');
            // o007 is the placeholder for the $animal->specie_id 
        $this->form_validation->set_rules('o007','','trim|xss_clean|alpha|required');
            // d666 is the placeholder for the $animal->sub_specie_id 
        $this->form_validation->set_rules('d666','','trim|xss_clean|alpha|required');
            // d666 is the placeholder for the report_message 
        $this->form_validation->set_rules('dfg34535345','','trim|xss_clean|alpha');
        
        $this->Cats_model->report();
        $this->session->set_flashdata('report_success','Your report has been sent');
        
        redirect($this->redirecteur);
    }
/*
 *
 * ************* This is the main page geese' settings 
 *
 */     
    public function geeses(){
        // To simplify thing we are taking the ads or sponsorized items from the buyorsell model 
        $this->load->model($this->buyorsell_model);
        $this->load->helper('text');
		$this->load->model($this->c_model);
        
            // Loads the model
        $this->load->model($this->model);
        
        /*
         * ******************** Pagination setting
         */
        $config['base_url']    = base_url(). '/facto/Geeses/geeses';
            // This gets the total row from my geeses' table
        $config['total_rows']  = $this->Geeses_model->record_count();
            // Show 40 elements per page
        $config['per_page']    = 40; 
            // Use the third segment to show the page number
        $config["uri_segment"] = 4;
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
        $page                 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['results']      = $this->Geeses_model->fetch_geeses($config['per_page'], $page);
            // this creates the " Next 1 2 3 4.. 12 Prev "
        $data['links']        = $this->pagination->create_links();        
        // This out puts the ad
        $data['ads']          = $this->User_model->get_ads();
        // This is for the right Ads content in geese's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['getAll']       = $this->Geeses_model->return_row_count();
		$data['getEverything']= $this->Count_model->return_all_database_count();
        $data['main_content'] = 'pagefactopedia/geeses';
        $this->load->view('layouts/main',$data);
    }
    
/*
 *
 * ************* This is the edit page geese' settings 
 * ************* This id is returning all the data with id request
 */
    public function geese_e($id){
        // To simplify thing we are taking the ads or sponsorized items from the buyorsell model 
        $this->load->model($this->buyorsell_model);
        $this->load->helper('text');
        
            // Loads the model
        $this->load->model($this->model);
        
            /*
             * This will make it usable every where with the variable $lists
             */
        $data['lists']        = $this->Geeses_model->get_geese_databases(); 
            // Call the users variable and the table name to output the result
            // Call it everywhere you want to use it 
        $data['users']        = $this->Geeses_model->get_users();
        $data['image']        = $this->Geeses_model->get_my_images($id);

         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['animal']       = $this->Geeses_model->get_geese_details($id);
        $data['main_content'] = 'pagefactopedia/editorial/geese_e';
            /*
             * this will iclude the main.php inside layouts
             */
        $this->load->view('layouts/main',$data);
	}
    
/*
 *
 * ************* This is the more page geese' settings 
 * ************* This id is returning all the data with id request
 */
    public function geese_m($id){
        // To simplify thing we are taking the ads or sponsorized items from the buyorsell model 
        $this->load->model($this->buyorsell_model);
        $this->load->helper('text');
        
            // Loads the model
        $this->load->model($this->model);
        
            //now I joined all my databases and can use it using $lists
        $data['lists']        = $this->Geeses_model->get_geese_databases();
        $data['users']        = $this->Geeses_model->get_users();
        $data['image']        = $this->Geeses_model->get_my_images($id);

         // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['animal']       = $this->Geeses_model->get_geese_details($id);
        $data['main_content'] = 'pagefactopedia/learn/geese_m';
            /*
             * this will iclude the main.php inside layouts
             */
        $this->load->view('layouts/main',$data);
	} 
    
/*
 *
 * ************* This is the first image model for the geese's page 
 * ************* This id is returning all the data with id request
 */
    public function geese_i($id){
            // Loads the model
        $this->load->model($this->model);
        
        $data           = array('error' => $this->upload->display_errors());
        $data['lists']  = $this->Geeses_model->get_geese_databases();
        $data['users']  = $this->Geeses_model->get_users();
        $data['animal'] = $this->Geeses_model->get_geese_details($id);
        $data['image']  = $this->Geeses_model->get_my_images($id);
        
        $this->load->view('pagefactopedia/modelsimage/geese_i',$data);
	}
    
/*
 *
 * ************* This is the second image model for the geese's page 
 * ************* This id is returning all the data with id request
 */
    public function geese_i2($id){
            // Loads the model
        $this->load->model($this->model);
        
        $data           = array('error' => $this->upload->display_errors());
        $data['lists']  = $this->Geeses_model->get_geese_databases();
        $data['users']  = $this->Geeses_model->get_users();
        $data['animal'] = $this->Geeses_model->get_geese_details($id);
        $data['image']  = $this->Geeses_model->get_my_images($id);
        
        $this->load->view('pagefactopedia/modelsimage/geese_i2',$data);
	}
    
/*
 *
 * ************* This is the third image model for the geese's page 
 * ************* This id is returning all the data with id request
 */
    public function geese_i3($id){
        
            // Loads the model
        $this->load->model($this->model);
        
        $data           = array('error' => $this->upload->display_errors());
        $data['lists']  = $this->Geeses_model->get_geese_databases();
        $data['users']  = $this->Geeses_model->get_users();
        $data['animal'] = $this->Geeses_model->get_geese_details($id);
        $data['image']  = $this->Geeses_model->get_my_images($id);
        
        $this->load->view('pagefactopedia/modelsimage/geese_i3',$data);
	}
    
/*
 *
 * ************* This is the fourth image model for the geese's page 
 * ************* This id is returning all the data with id request
 */
    public function geese_i4($id){
        
            // Loads the model
        $this->load->model($this->model);
        
        $data           = array('error' => $this->upload->display_errors());
        $data['lists']  = $this->Geeses_model->get_geese_databases();
        $data['users']  = $this->Geeses_model->get_users();
        $data['animal'] = $this->Geeses_model->get_geese_details($id); 
        $data['image']  = $this->Geeses_model->get_my_images($id);
        
        $this->load->view('pagefactopedia/modelsimage/geese_i4',$data);
	} 
    
/*
 *
 * ************* This is the Update the information in the more page for geese 
 * ************* This id is returning all the data with id request
 */
        // Update the geese factopedia page
     public function fastmha(){          
          
             // Loads the model
        $this->load->model($this->model); 
         
            //Validation Rules 
            // Animal name
        $this->form_validation->set_rules('name','Name','trim|xss_clean');
            // Weight 1
        $this->form_validation->set_rules('LwXEqlRRBd','Weight','trim|xss_clean|max_length[2]');
            // Weight 2
        $this->form_validation->set_rules('DoUoxQfTkL','Weight','trim|xss_clean|max_length[2]');
            // Height 1
        $this->form_validation->set_rules('COmnyQOkSy','Height','trim|xss_clean|max_length[2]');
            // Height 2
        $this->form_validation->set_rules('yaZoFKzEio','Height','trim|xss_clean|max_length[2]');
            // geese_function
        $this->form_validation->set_rules('nkTdZQcYAo','function','trim|xss_clean');
            // other name
        $this->form_validation->set_rules('VCPKiFHUvI','Other name','trim|xss_clean');
            // color
        $this->form_validation->set_rules('CSwyfmDBpu','Color','trim|xss_clean');
            // animal_group
        $this->form_validation->set_rules('SdWKxdEFSr','Groupe','trim|xss_clean');
            // location
        $this->form_validation->set_rules('clXhXvHgnp','Location','trim|xss_clean');
            // offspring
        $this->form_validation->set_rules('jFNaKUfhuf','Offsprings','trim|xss_clean|max_length[2]');
            // life span
        $this->form_validation->set_rules('mdATzSMbgl','Life span','trim|xss_clean');  
		 	// references/links span
        $this->form_validation->set_rules('links','Links','trim|xss_clean');         
        
		 if ($this->form_validation->run() == FALSE){
			
                        $this->session->set_flashdata('failed_failed',validation_errors('<div class="alert alert-danger"> <strong> Oh snap! </strong> ',' </div>'));

						// If success redirect to Geeses/geeses.php
					redirect($this->redirecteur);
			
                } else {
                       
						// Upload it the right place by inserting the data in the right id
					$this->Geeses_model->update();

					 $this->session->set_flashdata('failed_success','Thank you for updating factopedia. Your contribution is highly appreciate');

						// If success redirect to Geeses/geeses.php
					redirect($this->redirecteur);
                }
            
     }
/*
 *
 * ************* This is the upload the first image in the flexslider on the geese's page 
 * ************* This id is returning all the data with id request
 */   
    public function geeses_do_upload(){ 
        
            // Loads the model
        $this->load->model($this->model);
          
        $config['upload_path']   = './images/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '30000'; // 30MB
		$this->upload->initialize($config);        
       
            // $this->upload->do_upload() is the default setting required
		if ( ! $this->upload->do_upload())
		{
			//$error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('failed_post','Sorry, Your image could not been uploaded'. $this->upload->display_errors());
            redirect($this->redirecteur);
            
		} else {
            
            // Image Title
            $this->form_validation->set_rules('pwSTtJDdkm','Image Title','trim|xss_clean|alpha');
                // Image number - placeholder
            $this->form_validation->set_rules('JSjOgkgBQL','Place holder','trim|xss_clean|exact_length[1]|is_natural');
                // Animal name
            $this->form_validation->set_rules('MqeoMLLNyX','Animal Name','trim|xss_clean|alpha');
                // section name
            $this->form_validation->set_rules('DGAJGPQohm','Section Name','trim|xss_clean|alpha');
                // Specie name
            $this->form_validation->set_rules('ZMlGvucObH','Specie Name','trim|xss_clean|alpha');
                // Sub-specie name
            $this->form_validation->set_rules('BzeEIMfcwm','Sub Specie Name','trim|xss_clean|alpha');
                // tags name - i don't think this is in use
            $this->form_validation->set_rules('tags','Tags','trim|xss_clean|alpha');
         
                //This two will be executed at the sametime
            $image_data = $this->upload->data();
            $configu["watermarking"]['source_image']  = $image_data['full_path'];       
            $configu["watermarking"]['image_library'] = 'gd2';
    
            if(($image_data['image_width']) >= 2800 ){
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark3.gif';
            } elseif(($image_data['image_width']) <= 2800 and ($image_data['image_width']) >= 900) {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark.gif';
            } else {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark1.gif';
            }
            
            $configu["watermarking"]['wm_type']          = 'overlay';
            $configu["watermarking"]['wm_opacity']       = '10';
            $configu["watermarking"]['wm_vrt_alignment'] = 'middle';
            $configu["watermarking"]['wm_hor_alignment'] = 'center';

            $this->image_lib->initialize($configu["watermarking"]);
            $this->image_lib->watermark();
            $this->image_lib->clear();
            
            $this->Geeses_model->geeses_do_upload();
            $this->Geeses_model->geeses_do_upload_first();

            $this->session->set_flashdata('failed_success','Your image has been uploaded');
            
            redirect($this->redirecteur);
		}
            
     }
/*
 *
 * ************* This is the upload the second image in the flexslider on the geese's page 
 * ************* This id is returning all the data with id request
 */ 
    public function geeses_do_upload2(){  
        
            // Loads the model
        $this->load->model($this->model);
          
        $config['upload_path']   = './images/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '30000'; // 30MB
		$this->upload->initialize($config);

        if(!$this->image_lib->watermark()){
            echo $this->image_lib->display_errors();
        }

            // $this->upload->do_upload() is the default setting required
		if ( ! $this->upload->do_upload())
		{
			//$error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('failed_post','Sorry, Your image could not been uploaded'. $this->upload->display_errors());

            redirect($this->redirecteur);
            
		} else {
            
            // Image Title
            $this->form_validation->set_rules('pwSTtJDdkm','Image Title','trim|xss_clean|alpha');
                // Image number - placeholder
            $this->form_validation->set_rules('JSjOgkgBQL','Place holder','trim|xss_clean|exact_length[1]|is_natural');
                // Animal name
            $this->form_validation->set_rules('MqeoMLLNyX','Animal Name','trim|xss_clean|alpha');
                // section name
            $this->form_validation->set_rules('DGAJGPQohm','Section Name','trim|xss_clean|alpha');
                // Specie name
            $this->form_validation->set_rules('ZMlGvucObH','Specie Name','trim|xss_clean|alpha');
                // Sub-specie name
            $this->form_validation->set_rules('BzeEIMfcwm','Sub Specie Name','trim|xss_clean|alpha');
                // tags name - i don't think this is in use
            $this->form_validation->set_rules('tags','Tags','trim|xss_clean|alpha');
         
            //This two will be executed at the sametime
            $image_data = $this->upload->data();
            $configu["watermarking"]['source_image']  = $image_data['full_path'];       
            $configu["watermarking"]['image_library'] = 'gd2';
    
            if(($image_data['image_width']) >= 2800 ){
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark3.gif';
            } elseif(($image_data['image_width']) <= 2800 and ($image_data['image_width']) >= 900) {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark.gif';
            } else {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark1.gif';
            }
            
            $configu["watermarking"]['wm_type']          = 'overlay';
            $configu["watermarking"]['wm_opacity']       = '10';
            $configu["watermarking"]['wm_vrt_alignment'] = 'middle';
            $configu["watermarking"]['wm_hor_alignment'] = 'center';

            $this->image_lib->initialize($configu["watermarking"]);
            $this->image_lib->watermark();
            $this->image_lib->clear();
            
                //This two will be executed at the sametime
            $this->Geeses_model->geeses_do_upload();
            $this->Geeses_model->geeses_do_upload_second();
            
            $this->session->set_flashdata('failed_success','Your image has been uploaded');
            
            redirect($this->redirecteur);
		}
            
     }
/*
 *
 * ************* This is the upload the third image in the flexslider on the geese's page 
 * ************* This id is returning all the data with id request
 */    
    public function geeses_do_upload3(){      
        
            // Loads the model
        $this->load->model($this->model);
          
        $config['upload_path']   = './images/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '30000'; // 30MB
		$this->upload->initialize($config);

        // $this->upload->do_upload() is the default setting required
		if ( ! $this->upload->do_upload())
		{
			//$error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('failed_post','Sorry, Your image could not been uploaded'. $this->upload->display_errors());

			//$this->load->view('upload_form', $error);
            //redirect('Geeses/geese_i',$error);
            // PLEASE SET THE REDIRECTION FOR ERROR HANDLING
            redirect($this->redirecteur);
            
		} else { 
            
            // Image Title
            $this->form_validation->set_rules('pwSTtJDdkm','Image Title','trim|xss_clean|alpha');
                // Image number - placeholder
            $this->form_validation->set_rules('JSjOgkgBQL','Place holder','trim|xss_clean|exact_length[1]|is_natural');
                // Animal name
            $this->form_validation->set_rules('MqeoMLLNyX','Animal Name','trim|xss_clean|alpha');
                // section name
            $this->form_validation->set_rules('DGAJGPQohm','Section Name','trim|xss_clean|alpha');
                // Specie name
            $this->form_validation->set_rules('ZMlGvucObH','Specie Name','trim|xss_clean|alpha');
                // Sub-specie name
            $this->form_validation->set_rules('BzeEIMfcwm','Sub Specie Name','trim|xss_clean|alpha');
                // tags name - i don't think this is in use
            $this->form_validation->set_rules('tags','Tags','trim|xss_clean|alpha');
         
                //This two will be executed at the sametime
            $image_data = $this->upload->data();
            $configu["watermarking"]['source_image']  = $image_data['full_path'];       
            $configu["watermarking"]['image_library'] = 'gd2';
    
            if(($image_data['image_width']) >= 2800 ){
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark3.gif';
            } elseif(($image_data['image_width']) <= 2800 and ($image_data['image_width']) >= 900) {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark.gif';
            } else {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark1.gif';
            }
            
            $configu["watermarking"]['wm_type']          = 'overlay';
            $configu["watermarking"]['wm_opacity']       = '10';
            $configu["watermarking"]['wm_vrt_alignment'] = 'middle';
            $configu["watermarking"]['wm_hor_alignment'] = 'center';

            $this->image_lib->initialize($configu["watermarking"]);
            $this->image_lib->watermark();
            $this->image_lib->clear();
            
                //This two will be executed at the sametime
            $this->Geeses_model->geeses_do_upload();
            $this->Geeses_model->geeses_do_upload_third();
            
            $this->session->set_flashdata('failed_success','Your image has been uploaded');
            
            redirect($this->redirecteur);
		}
            
     }
/*
 *
 * ************* This is the upload the fourth image in the flexslider on the geese's page 
 * ************* This id is returning all the data with id request
 */ 
    public function geeses_do_upload4(){  
        
            // Loads the model
        $this->load->model($this->model);
          
        $config['upload_path']   = './images/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '30000'; // 30MB
		$this->upload->initialize($config);

            // $this->upload->do_upload() is the default setting required
		if ( ! $this->upload->do_upload())
		{
			//$error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('failed_post','Sorry, Your image could not been uploaded'. $this->upload->display_errors());

                //$this->load->view('upload_form', $error);
                //redirect('Geeses/geese_i',$error);
                // PLEASE SET THE REDIRECTION FOR ERROR HANDLING
            redirect($this->redirecteur);
            
		} else {
            
            // Image Title
            $this->form_validation->set_rules('pwSTtJDdkm','Image Title','trim|xss_clean|alpha');
                // Image number - placeholder
            $this->form_validation->set_rules('JSjOgkgBQL','Place holder','trim|xss_clean|exact_length[1]|is_natural');
                // Animal name
            $this->form_validation->set_rules('MqeoMLLNyX','Animal Name','trim|xss_clean|alpha');
                // section name
            $this->form_validation->set_rules('DGAJGPQohm','Section Name','trim|xss_clean|alpha');
                // Specie name
            $this->form_validation->set_rules('ZMlGvucObH','Specie Name','trim|xss_clean|alpha');
                // Sub-specie name
            $this->form_validation->set_rules('BzeEIMfcwm','Sub Specie Name','trim|xss_clean|alpha');
                // tags name - i don't think this is in use
            $this->form_validation->set_rules('tags','Tags','trim|xss_clean|alpha');
            
                //This two will be executed at the sametime
            $image_data = $this->upload->data();
            $configu["watermarking"]['source_image']  = $image_data['full_path'];       
            $configu["watermarking"]['image_library'] = 'gd2';
    
            if(($image_data['image_width']) >= 2800 ){
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark3.gif';
            } elseif(($image_data['image_width']) <= 2800 and ($image_data['image_width']) >= 900) {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark.gif';
            } else {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark1.gif';
            }
            
            $configu["watermarking"]['wm_type']          = 'overlay';
            $configu["watermarking"]['wm_opacity']       = '10';
            $configu["watermarking"]['wm_vrt_alignment'] = 'middle';
            $configu["watermarking"]['wm_hor_alignment'] = 'center';

            $this->image_lib->initialize($configu["watermarking"]);
            $this->image_lib->watermark();
            $this->image_lib->clear();
         
                //This two will be executed at the sametime
            $this->Geeses_model->geeses_do_upload();
            $this->Geeses_model->geeses_do_upload_fourth();
            
            $this->session->set_flashdata('failed_success','Your image has been uploaded');
            
            redirect($this->redirecteur);
		}
            
     }    
}    