<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	var $original_path;
	var $resized_path;
	var $thumbs_path;
	
    public function __construct()
        {
                parent::__construct();
				$this->original_path = './images/';
				$this->resized_path = './images_large/';
				$this->thumbs_path ='./images/thumbs';
        }

    public function ad_report(){
        
        $this->User_model->report();
        $this->session->set_flashdata('report_success','Your report has been sent');
        
        redirect('Buyorsell/index');
    } 
     
    public function feedback(){ 
        
        $this->form_validation->set_rules('name'   ,'Name'   ,'trim|required|xss_clean');
        $this->form_validation->set_rules('message','Message','trim|required|xss_clean');
        $this->User_model->feedback();
        
        $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger"> <strong> Oh snap! </strong> ',' </div>'));
        
        redirect('facto/Dogs/dogs', 'refresh');
        
    }
    
    public function send_message(){
        
        $this->form_validation->set_rules('to'      ,'To'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('subject' ,'Subject' ,'trim|required|xss_clean');
        $this->form_validation->set_rules('message' ,'message' ,'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE){
            
            $this->session->set_flashdata('error_message', validation_errors('<div class="alert alert-danger"> <strong> Oh snap! </strong> ',' </div>'));
        
            redirect('user/messages/'. $this->session->userdata('username'));
            
        } else {
            
            $this->User_model->send_message();
            
            $this->session->set_flashdata('sent_message', 'Your message has been sent !');
        
            redirect('user/messages/'. $this->session->userdata('username'));
        }
        
        
    }
    
    public function settings($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        $data['user'] = $this->User_model->get_user($username);
        
        // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        // This is for the right content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot(); 
        $data['main_content'] = 'userpage/settings';
        $this->load->view('layouts/mainuserpage',$data);
        
    }
    
    
    public function update_settings(){
        
        $this->form_validation->set_rules('address'       ,'Address'       ,'trim|xss_clean');
        $this->form_validation->set_rules('address_line_2','Address Line 2','trim|xss_clean');
        $this->form_validation->set_rules('city'          ,'City'          ,'trim|xss_clean');
        $this->form_validation->set_rules('state'         ,'State'         ,'trim|xss_clean');
        $this->form_validation->set_rules('zip_code'      ,'Zip Code'      ,'trim|xss_clean');
        
        
        if ($this->form_validation->run() == TRUE){
            
            $username = $this->session->userdata('username');
                // Here we are matching the password from the register data 
                // With the one the user used to loggedin
            $password = md5($this->input->post('password'));
            

            $this_session = $this->User_model->login($username, $password);
                       
            //Validate User
            if($this_session){
                
                 $this->User_model->update_setting();
                
                 $this->session->set_flashdata('pass_login','Your address has been updated!');
                
                 redirect('user/settings/'. $this->session->userdata('username'));

            } else {
                
                $this->session->set_flashdata('fail_login','Your address has not successfuly updated');
                
                redirect('user/settings/'. $this->session->userdata('username'));
            }
            
		} else {
                //Set error               
                $this->session->set_flashdata('fail_login','Your address has not successfuly updated');
                
                redirect('user/settings/'. $this->session->userdata('username'));
        }
    }
    
    public function update_settings_bill(){
        
        $this->form_validation->set_rules('address_bill'       ,'Address'       ,'trim|xss_clean');
        $this->form_validation->set_rules('address_line_2_bill','Address Line 2','trim|xss_clean');
        $this->form_validation->set_rules('city_bill'          ,'City'          ,'trim|xss_clean');
        $this->form_validation->set_rules('state_bill'         ,'State'         ,'trim|xss_clean');
        $this->form_validation->set_rules('zip_code_bill'      ,'Zip Code'      ,'trim|xss_clean');
        
        
        if ($this->form_validation->run() == TRUE){
            
            $username = $this->session->userdata('username');
                // Here we are matching the password from the register data 
                // With the one the user used to loggedin
            $password = md5($this->input->post('password'));
            

            $this_session = $this->User_model->login($username, $password);
                       
            //Validate User
            if($this_session){
                
                 $this->User_model->update_setting_bill();
                
                 $this->session->set_flashdata('pass_login','Your address has been updated!');
                
                 redirect('user/settings/'. $this->session->userdata('username'));

            } else {
                
                $this->session->set_flashdata('fail_login','Your address has not successfuly updated');
                
                redirect('user/settings/'. $this->session->userdata('username'));
            }
            
		} else {
                //Set error               
                $this->session->set_flashdata('fail_login','Your address has not successfuly updated');
                
                redirect('user/settings/'. $this->session->userdata('username'));
        }
    }
    
    public function profile($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        $data['user'] = $this->User_model->get_user($username);
        
        
            // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
            // This help me display the time or the amount of offers a user has util it expires
            // This help me display the payment of the user 
            // this returns result
            // this display last activity
        $data['activity_records']= $this->User_model->get_user_records();
            // This help me display the time or the amount of offers a user has util it expires
            // this returns row
        $data['plan']= $this->User_model-> get_plan_facts();
            // This help us to know if the plan has expired
        $data['plan_expires']    = $this->User_model->get_plan_expration_date();
            // Get the total number of the user messages
        $data['allmessages']     = $this->User_model->get_total_user_messages();
            // Get the total number of the user messages sent
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
            // Get the total number of the user images uploaded in the factopedia page
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
            // Get the total number of the user images in the image page
        $data['allimages']       = $this->User_model->get_total_user_images();
            // Get the total number of the user ads 
        $data['allads']          = $this->User_model->get_total_user_ads();
            // Get the total number of the user offers
        $data['allOffers']       = $this->User_model->get_total_user_offers();
            // Get the total number of the user orders
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        $data['spons']           = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']          = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content']    = 'userpage/profile';
        $this->load->view('layouts/mainuserpage',$data);
    }
    public function messages($username){
        $this->load->model('Buyorsell_model'); 
        $this->load->helper('text');
        
        // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['user'] = $this->User_model->get_user($username);
        $data['messages'] = $this->User_model->get_usermessages($username);
        $data['smessages'] = $this->User_model->get_usersentmessages($username);
        $data['allmessages']     = $this->User_model->get_total_user_messages();
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
        $data['allimages']       = $this->User_model->get_total_user_images();
        $data['allads']          = $this->User_model->get_total_user_ads();
        $data['allOffers']       = $this->User_model->get_total_user_offers();
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        
        // This is for the right Ads content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'userpage/messages';
        $this->load->view('layouts/mainuserpage',$data);
    }
    public function videos($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['user'] = $this->User_model->get_user($username);
        $data['videos'] = $this->User_model->get_uservideos($username);
        $data['allmessages']     = $this->User_model->get_total_user_messages();
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
        $data['allimages']       = $this->User_model->get_total_user_images();
        $data['allads']          = $this->User_model->get_total_user_ads();
        $data['allOffers']       = $this->User_model->get_total_user_offers();
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        
        // This is for the right Ads content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'userpage/videos';
        $this->load->view('layouts/mainuserpage',$data);
    }
/*
 * Image page settings
 */    
    public function images($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        // Here we are getting the user profile image
        $data['im_prof']         = $this->User_model->get_im_profile();
        $data['user']            = $this->User_model->get_user($username);
        $data['images']          = $this->User_model->get_userimages($username);
        $data['images2']         = $this->User_model->get_userimages2($username);
        $data['images3']         = $this->User_model->get_userimages3($username);
        $data['allmessages']     = $this->User_model->get_total_user_messages();
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
        $data['allimagesprofile']= $this->User_model->get_total_user_images_prof();
        $data['allimages']       = $this->User_model->get_total_user_images();
        $data['allads']          = $this->User_model->get_total_user_ads();
        $data['allOffers']       = $this->User_model->get_total_user_offers();
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        
        // This is for the right Ads content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'userpage/images';
        $this->load->view('layouts/mainuserpage',$data);
    }
    
    public function delete_image(){
        $this->User_model->delete_image();
        
        $this->session->set_flashdata('delete_imagefact','The image uploaded in factopedia has been deleted');
        
        redirect('user/images/'. $this->session->userdata('username'));
    }
    
    public function delete_image2(){
        $this->User_model->delete_image2();
        
        $this->session->set_flashdata('delete_image','Your image has been deleted');
        
        redirect('user/images/'. $this->session->userdata('username'));
    }
    
    /*public function upload_image(){ 
          
        //make sure to name your own field name if not its not going to work unless
        //you use do_upload 
        $field_name = "post_image";
        
        $config['upload_path']   = './images/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '30000'; // 30MB
		$this->upload->initialize($config);        
       
            // $this->upload->do_upload() is the default setting required
		if ( ! $this->upload->do_upload($field_name))
		{
            
            $this->session->set_flashdata('image_failed','Sorry, Your image could not been uploaded'. $this->upload->display_errors());
            
            redirect('user/images/'.$this->session->userdata('username'));
            
		} else {
            
            $this->form_validation->set_rules('image_title','Image Title','trim|xss_clean|alpha|required');
         
            
            
                //This two will be executed at the sametime we use this image_data to get the full_path
            $image_data = $this->upload->data();
            // This is where the image is located in the $image_data['full_path']
            $configu["watermarking"]['source_image']  = $image_data['full_path'];       
            $configu["watermarking"]['image_library'] = 'gd2';
    
            // If image is width is less than 2800 pixels put this on front 
            if(($image_data['image_width']) >= 2800 ){
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark3.gif';
                // If image is width is between 2800 and 900 pixels put this on front
            } elseif(($image_data['image_width']) <= 2800 and ($image_data['image_width']) >= 900) {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark.gif';
                // If image is width is greater than 2800 pixels put this on front
            } else {
                $configu["watermarking"]['wm_overlay_path']  ='./assets/image/animalgenuiswatermark1.gif';
            }
            
            // Setting the watermarking we can do overlay or text
            $configu["watermarking"]['wm_type']          = 'overlay';
            // This is the opacity of the applied watermarking
            $configu["watermarking"]['wm_opacity']       = '10';
            // This is the alignement
            $configu["watermarking"]['wm_vrt_alignment'] = 'middle';
            $configu["watermarking"]['wm_hor_alignment'] = 'center';
			//$configu["watermarking"]['file_permission']  = 0644;
			$image_sizes = array(
				'extrasmall' => array(480, 343),
				'small' => array(800, 572),
				'medium' => array(2049, 1463),
				'large' => array(2794, 1996),
				'extralarge' => array(3346, 2390)
			);
			$configu["watermarking"]['new_image']        = '_extrlarge';
			$configu["watermarking"]['thumb_marker']     = '_extrlarge';
			$configu["watermarking"]['create_thumb']     = TRUE;
			$configu["watermarking"]['maintain_ratio']   = TRUE;
			$configu["watermarking"]['width']            = 4980;
			$configu["watermarking"]['height']           = 2927;

            $this->image_lib->initialize($configu["watermarking"]);
            $this->image_lib->watermark();
			$this->image_lib->resize();
			$this->image_lib->clear();
			// Extrasmall thumb
			$configu["watermarking"]['thumb_marker']     = '_extrasmall';
			$configu["watermarking"]['width']            = 480;
			$configu["watermarking"]['height']           = 343;
			
			$this->image_lib->initialize($configu["watermarking"]);
            $this->image_lib->watermark();
			$this->image_lib->resize();
			$this->image_lib->clear();
            
            $this->User_model->upload_image();

            $this->session->set_flashdata('image_success','Your image has been uploaded');
            redirect('user/images/'.$this->session->userdata('username'));
		}
            
     }*/
	
	function upload_image(){
		
		$field_name = "post_image";
        
        $config['upload_path']   = './images/original'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '15000'; // 15MB
		$config['new_image']        = './images/original';
		$config['image_library'] = 'gd2';
		$config['wm_overlay_path']  ='./assets/image/animalgenuiswatermarkextralarge.gif';
		$config['wm_type']          = 'overlay';
		// This is the opacity of the applied watermarking
		$config['wm_opacity']       = '10';
		// This is the alignement
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$this->upload->initialize($config);
		$this->image_lib->watermark();
		
			// $this->upload->do_upload() is the default setting required
			if ( ! $this->upload->do_upload($field_name))
			{

				$this->session->set_flashdata('image_failed','Sorry, Your image could not been uploaded'. $this->upload->display_errors());

				redirect('user/images/'.$this->session->userdata('username'));

			} else {
				
			$image_data = $this->upload->data();

			//your desired config for the resize() function
			if(($image_data['image_width']) >= 480 ){	
				$config = array(
				'source_image'      => $image_data['full_path'], //path to the uploaded image
				'new_image'         => './images/extra_small', //path to
				'image_library'     => 'gd2',
				'wm_overlay_path'   => './assets/image/animalgenuiswatermarkextrasmall.gif',	
					// Setting the watermarking we can do overlay or text
                'wm_type'           => 'overlay',
					// This is the opacity of the applied watermarking
                'wm_opacity'        => '50',
					// This is the alignement
                'wm_vrt_alignment'  => 'middle',
                'wm_hor_alignment'  => 'center',	
				'maintain_ratio'    => true,
				'width'             => 480,
				'height'            => 343
				);

				//this is the magic line that enables you generate multiple thumbnails
				//you have to call the initialize() function each time you call the resize()
				//otherwise it will not work and only generate one thumbnail
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}	

			if(($image_data['image_width']) >= 800 ){	
				$config = array(
				'source_image'      => $image_data['full_path'],
				'new_image'         => './images/small',
				'image_library'     => 'gd2',
				'wm_overlay_path'   => './assets/image/animalgenuiswatermarksmaller.gif',	
					// Setting the watermarking we can do overlay or text
                'wm_type'           => 'overlay',
					// This is the opacity of the applied watermarking
                'wm_opacity'        => '50',
					// This is the alignement
                'wm_vrt_alignment'  => 'middle',
                'wm_hor_alignment'  => 'center',		
				'maintain_ratio'    => true,
				'width'             => 800,
				'height'            => 572
				);
				//here is the second thumbnail, notice the call for the initialize() function again
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}	
				
			if(($image_data['image_width']) >= 2049 ){	
				$config = array(
				'source_image'      => $image_data['full_path'],
				'new_image'         => './images/medium',
				'image_library'     => 'gd2',
				'wm_overlay_path'   => './assets/image/animalgenuiswatermarkmedium.gif',
					// Setting the watermarking we can do overlay or text
                'wm_type'           => 'overlay',
					// This is the opacity of the applied watermarking
                'wm_opacity'        => '50',
					// This is the alignement
                'wm_vrt_alignment'  => 'middle',
                'wm_hor_alignment'  => 'center',		
				'maintain_ratio'    => true,
				'width'             => 2049,
				'height'            => 1463
				);
			//here is the second thumbnail, notice the call for the initialize() function again
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			}	
				
			if(($image_data['image_width']) >= 2794 ){		
				$config = array(
				'source_image'      => $image_data['full_path'],
				'new_image'         => './images/large',
				'image_library'     => 'gd2',
				'wm_overlay_path'   => './assets/image/animalgenuiswatermarklarge.gif',	
					// Setting the watermarking we can do overlay or text
                'wm_type'           => 'overlay',
					// This is the opacity of the applied watermarking
                'wm_opacity'        => '50',
					// This is the alignement
                'wm_vrt_alignment'  => 'middle',
                'wm_hor_alignment'  => 'center',		
				'maintain_ratio'    => true,	
				'width'             => 2794,
				'height'            => 1996
				);
				//here is the second thumbnail, notice the call for the initialize() function again
				$this->image_lib->initialize($config);
				$this->image_lib->resize();	
			}	
						
			if(($image_data['image_width']) >= 3346 ){		
				$config = array(
				'source_image'      => $image_data['full_path'],
				'new_image'         => './images/extra_large',
				'image_library'     => 'gd2',
				'wm_overlay_path'   => './assets/image/animalgenuiswatermarkextralarge.gif',	
					// Setting the watermarking we can do overlay or text
                'wm_type'           => 'overlay',
					// This is the opacity of the applied watermarking
                'wm_opacity'        => '50',
					// This is the alignement
                'wm_vrt_alignment'  => 'middle',
                'wm_hor_alignment'  => 'center',		
				'maintain_ratio'    => true,	
				'width'             => 3346,
				'height'            => 2390
				);
				//here is the second thumbnail, notice the call for the initialize() function again
				$this->image_lib->initialize($config);
				$this->image_lib->resize();	
			}	
				
		 	$this->User_model->upload_image();

			$this->session->set_flashdata('image_success','Your image has been uploaded');
			redirect('user/images/'.$this->session->userdata('username'));
	  }
  }
    
    // Image profile
    public function upload_imp(){ 
          
        //$this->form_validation->set_rules('cr_im','cropped Image','trim|xss_clean|required');
        //make sure to name your own field name if not its not going to work unless
        //you use do_upload 
        $field_name = "post_image";
        
        //$cr_im = $this->input->post('cr_im');
        
        $config['upload_path']   = './improf/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '30000'; // 30MB
		$this->upload->initialize($config);        
       
            // $this->upload->do_upload() is the default setting required
		if ( ! $this->upload->do_upload($field_name))
		{
            
            $this->session->set_flashdata('image_failed','Sorry, Your image could not been uploaded'. $this->upload->display_errors());
            
            redirect('user/profile/'.$this->session->userdata('username'));
            
		} else {
            

            
            
            $this->User_model->upload_imp();

            $this->session->set_flashdata('image_success','Your image has been uploaded');
            redirect('user/profile/'.$this->session->userdata('username'));
		}
            
     }
    
// $username is pass to the function to be reconize in the url it is comming from our table 
// we make it equal to the username in our database
    public function offers($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        $data['user'] = $this->User_model->get_user($username);
        $data['offers'] = $this->User_model->get_user_offers($username); 
        
        // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
            // This help me display the time or the amount of offers a user has util it expires
            // this returns row
        $data['plan']= $this->User_model-> get_plan_facts();
            // This help us to know if the plan has expired
        $data['plan_expires']    = $this->User_model->get_plan_expration_date();
        // This is for the right Ads content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['allmessages']     = $this->User_model->get_total_user_messages();
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
        $data['allimages']       = $this->User_model->get_total_user_images();
        $data['allads']          = $this->User_model->get_total_user_ads();
        $data['allOffers']       = $this->User_model->get_total_user_offers();
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        $data['orders']       = $this->User_model->offer_orders($username);
        $data['main_content'] = 'userpage/offers';
        $this->load->view('layouts/mainuserpage',$data);
    }
    
    public function reject_off(){
        $this->User_model->reject_off();
        
        $this->session->set_flashdata('reject',' The order has been successfully rejected'. $this->upload->display_errors());
        
        redirect('user/offers/'. $this->session->userdata('username'));
    }
    
    public function offer_delete(){
        
        $this->User_model->offer_delete();
        
        $this->session->set_flashdata('offer_deleted',' Your offer has been deleted'. $this->upload->display_errors());
        
        redirect('user/offers/'. $this->session->userdata('username'));
        
    }
    
    public function offer_update(){
        
        $this->form_validation->set_rules('asking_price' ,'Asking Price'  ,'trim|xss_clean');
        $this->form_validation->set_rules('regular_price','Regular Price' ,'trim|xss_clean');
        $this->form_validation->set_rules('pet_name'     ,'Pet Name'      ,'trim|xss_clean');
        $this->form_validation->set_rules('pet_breed'    ,'Pet Breed'     ,'trim|xss_clean');
        $this->form_validation->set_rules('pet_color'    ,'Pet Color'     ,'trim|xss_clean');
        $this->form_validation->set_rules('pet_agenumber','Pet Age'       ,'trim|xss_clean');
        $this->form_validation->set_rules('pet_ageperiod','Pet Age'       ,'trim|xss_clean');
        $this->form_validation->set_rules('pet_sex'      ,'Pet Gender'    ,'trim|xss_clean');
        $this->form_validation->set_rules('shipping_info','Shipping Info' ,'trim|xss_clean');
        $this->form_validation->set_rules('more_aboutpet','More About Pet','trim|xss_clean');
        
        if ($this->form_validation->run() == TRUE){
            
            $this->User_model->offer_update();
            
            $this->session->set_flashdata('update_offer_success','Congratulations, Your offer has successfully been updated'. $this->upload->display_errors());
            redirect('user/offers/'. $this->session->userdata('username'));
            
        } else {
            
            $this->session->set_flashdata('update_offer_failed','Sorry, Your offer has not been updated'. $this->upload->display_errors());
            
            redirect('user/offers/'. $this->session->userdata('username'));
        }  
        
        
        
    }
/*
 * Post or Blog settings and page
 */    
    public function posts($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['user'] = $this->User_model->get_user($username);
        $data['users']  = $this->User_model->get_users();
        $data['posts']  = $this->User_model->get_postdetails($username);
        $data['allposts']  = $this->User_model->get_total_user_posts();
        $data['allmessages']     = $this->User_model->get_total_user_messages();
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
        $data['allimages']       = $this->User_model->get_total_user_images();
        $data['allads']          = $this->User_model->get_total_user_ads();
        $data['allOffers']       = $this->User_model->get_total_user_offers();
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        
        // This is for the right Ads content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'userpage/posts';
        $this->load->view('layouts/mainuserpage',$data);
    }
    
    public function delete_post(){
        
        $this->User_model->delete_post();
        
        $this->session->set_flashdata('post_deleted',' Your post has been deleted');
        
        redirect('user/posts/'. $this->session->userdata('username'));
    }
    
    public function edit_post(){
        
        $this->form_validation->set_rules('post_text'  ,'Post text'     ,'trim|xss_clean|required');
        $this->form_validation->set_rules('post_title' ,'Address Line 2','trim|xss_clean|required');
        
        
        if ($this->form_validation->run() == FALSE){
            
            //Set error               
                $this->session->set_flashdata('post_edited_failed', validation_errors('<div class="alert alert-danger"> <strong> Oh snap! </strong> ',' </div>'));
                
                redirect('user/posts/'. $this->session->userdata('username'));
            
		} else {
            
                $this->User_model->edit_post();
                //Set error               
                $this->session->set_flashdata('post_edited','Your post has successfuly been edited');
                
                redirect('user/posts/'. $this->session->userdata('username'));
        }
    }
    
/*
 * connected page
 */        
    public function connected($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['user'] = $this->User_model->get_user($username);
        $data['allmessages']     = $this->User_model->get_total_user_messages();
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
        $data['allimages']       = $this->User_model->get_total_user_images();
        $data['allads']          = $this->User_model->get_total_user_ads();
        $data['allOffers']       = $this->User_model->get_total_user_offers();
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        
        // This is for the right Ads content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'userpage/connected';
        $this->load->view('layouts/mainuserpage',$data);
    }
    
    public function upload_postimage() {
        
        //make sure to name your own field name if not its not going to work unless
        //you use do_upload 
        $field_name = "post_image";
        
        $config['upload_path']   = './images/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '30000'; // 30MB
		$this->upload->initialize($config);
        
        // After defining Your variable make sure to refere to it in the do_upload
        if ( ! $this->upload->do_upload($field_name))
        {
            //$error = array('error' => $this->upload->display_errors());
            //This is how you pass your errors directly to the flash data
            $this->session->set_flashdata('failed_post','Sorry, Your post was not published because'. $this->upload->display_errors());
            
            // FIND A WAY TO INCLUDE THE ERROR HANDLING 
            redirect('user/posts/'. $this->session->userdata('username')); 
            //$this->load->view('userpage/posts', $error);
        }
        else
        {
            
        $this->form_validation->set_rules('post_title','Post title','trim|required|xss_clean');
        $this->form_validation->set_rules('post_image','Post Image','trim|required|xss_clean');
        $this->form_validation->set_rules('post_text' ,'Context'   ,'trim|required|xss_clean');
        $this->form_validation->set_rules('username'  ,'username'  ,'trim|required|xss_clean');
        
        $this->User_model->post();
            
        $data = array('upload_data' => $this->upload->data());
        $this->session->set_flashdata('success_post','Your post has successfuly been published');    
          
        // THE SUCCESS DOES NOT NEED THE SUCCESS HANDLING    
        redirect('user/posts/'. $this->session->userdata('username'));
            
        }
    }
    
    public function upload_aoff(){
        
        //make sure to name your own field name if not its not going to work unless
        //you use do_upload 
        $field_name = "post_image";
        
        $config['upload_path']   = './offimages/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '1000000'; // 30MB
		$this->upload->initialize($config);
        
        // After defining Your variable make sure to refere to it in the do_upload
        if ( !$this->upload->do_upload($field_name))
        {
            //$error = array('error' => $this->upload->display_errors());
            //This is how you pass your errors directly to the flash data
            $this->session->set_flashdata('failed_post','Sorry, Your offer was not published because'. $this->upload->display_errors());
            
            // FIND A WAY TO INCLUDE THE ERROR HANDLING 
            redirect('user/offers/'. $this->session->userdata('username')); 
            //$this->load->view('userpage/posts', $error);
        }
        else
        {
            
        $this->form_validation->set_rules('pet_kind'     ,'Pet kind'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('regular_price','Regular Price' ,'trim|required|xss_clean');
        $this->form_validation->set_rules('asking_price' ,'Asking Price'  ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_name'     ,'Pet Name'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_breed'    ,'Pet Breed'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_color'    ,'Pet Color'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_agenumber','Pet Age'       ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_ageperiod','Pet Age'       ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_sex'      ,'Pet Gender'    ,'trim|required|xss_clean');
        $this->form_validation->set_rules('shipping_info','Shipping Info' ,'trim|required|xss_clean');
        $this->form_validation->set_rules('more_aboutpet','More About Pet','trim|required|xss_clean');
        
        $this->User_model->offer();
            
        $data = array('upload_data' => $this->upload->data());
        $this->session->set_flashdata('success_post','Your offer has successfuly been published');    
          
        // THE SUCCESS DOES NOT NEED THE SUCCESS HANDLING    
        redirect('user/offers/'. $this->session->userdata('username'));
            
        }
    }
    
    public function upload_video() {
        
        
        //make sure to name your own field name if not its not going to work unless
        //you use do_upload 
        $field_name = "uploaded_video";
        
        $config['upload_path']   = './video/'; // Goes to the root in the video folder
		$config['allowed_types'] = 'mp4|mov|mpeg|mp3|avi';
		$config['max_size']	     = '3000000'; // 3GB
		$config['max_width']	     = ''; 
		$config['max_height']	     = ''; 
        
		$this->upload->initialize($config);
        
        // After defining Your variable make sure to refere to it in the do_upload
        if ( ! $this->upload->do_upload($field_name))
        {
            //$error = array('error' => $this->upload->display_errors());
            //This is how you pass your errors directly to the flash data
            $this->session->set_flashdata('failed_post','Sorry, Your Video was not uploaded because'. $this->upload->display_errors());
            
            // FIND A WAY TO INCLUDE THE ERROR HANDLING 
            redirect('user/videos/'. $this->session->userdata('username')); 
            //$this->load->view('userpage/posts', $error);
        }
        else
        {
        $data = array('upload_data' => $this->upload->data()); 
            
        $this->form_validation->set_rules('video_title'      ,'Video title'   ,'trim|required|xss_clean');
        $this->form_validation->set_rules('video_duration'   ,'Video duration','trim|required|xss_clean');
        $this->form_validation->set_rules('video_description','Video description','trim|required|xss_clean');
               
        
        $this->User_model->video();
            
        $this->session->set_flashdata('success_post','Your videos has successfuly been uploaded');    
          
        // THE SUCCESS DOES NOT NEED THE SUCCESS HANDLING    
        redirect('user/videos/'. $this->session->userdata('username'));
            
        }
    }
    
/*
 * Lost and found pet setting and uploading
 */ 
    public function lostfound($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        $data['user'] = $this->User_model->get_user($username);
        $data['lostpets']  = $this->User_model->get_lostpets($username);
        $data['foundpets'] = $this->User_model->get_foundpets($username);
        $data['allmessages']     = $this->User_model->get_total_user_messages();
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
        $data['allimages']       = $this->User_model->get_total_user_images();
        $data['allads']          = $this->User_model->get_total_user_ads();
        $data['allOffers']       = $this->User_model->get_total_user_offers();
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        $data['allLosts']  = $this->User_model->get_total_user_lostpets(); 
        $data['allFounds'] = $this->User_model->get_total_user_foundpets();
        
        // This is for the right Ads content in reptile's page
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'userpage/lostfound';
        $this->load->view('layouts/mainuserpage',$data);
    }
    
    public function deleteFound(){
        $this->User_model->deleteFound();
        
        $this->session->set_flashdata('deletedFound',' Your post has been deleted');
        
        redirect('user/lostfound/'. $this->session->userdata('username'));
    }
    
    public function deleteLost(){
        $this->User_model->deleteLost();
        
        $this->session->set_flashdata('deletedLost',' Your post has been deleted');
        
        redirect('user/lostfound/'. $this->session->userdata('username'));
    }
    
    public function upload_lpet(){
        
        //make sure to name your own field name if not its not going to work unless
        //you use do_upload 
        // Make the field_name = to the name of your <input type"file" name="post_image">
        $field_name = "post_image";
        
        $config['upload_path']   = './lostfoundimages/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '1000000'; // 30MB
		$this->upload->initialize($config);
        
        // After defining Your variable make sure to refere to it in the do_upload
        if ( !$this->upload->do_upload($field_name))
        {
            //$error = array('error' => $this->upload->display_errors());
            //This is how you pass your errors directly to the flash data
            $this->session->set_flashdata('failed_post','Sorry, Your post could not been published'. $this->upload->display_errors());
            
            redirect('user/lostfound/'. $this->session->userdata('username')); 
            //$this->load->view('userpage/posts', $error);
        }
        else
        {
            
        $this->form_validation->set_rules('pet_name'      ,'Pet name '      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_breed'     ,'pet_breed'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_color'     ,'Pet color'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_gender'    ,'Pet gender'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_agenumber' ,'Age number'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('missing_since' ,'Missing since'  ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_ageperiod' ,'Age period'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('lost_id'       ,'Whoow!'         ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_micro'     ,'Microship #'    ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_location'  ,'Locatioin'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('description'   ,'More about pet' ,'trim|required|xss_clean|max_length[95]');
        
            if ($this->form_validation->run() == FALSE){
                
                $this->session->set_flashdata('failed_post','Sorry, Your post could not been published'. $this->upload->display_errors()); 
                // this is how you se the validation_errors to the page with redirect killing everything
                $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger"> <strong> Oh snap! </strong> ',' </div>'));
                
                redirect('user/lostfound/'. $this->session->userdata('username'));
                
            } else {
                
                $this->User_model->upload_lpet();

                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('success_post','congratulations, Your post has successfuly been posted');    

                // THE SUCCESS DOES NOT NEED THE SUCCESS HANDLING    
                redirect('user/lostfound/'. $this->session->userdata('username'), 'refresh');
                
            }
            
        }
    }
    
    public function upload_fpet(){
        
        //make sure to name your own field name if not its not going to work unless
        //you use do_upload 
        // Make the field_name = to the name of your <input type"file" name="post_image2">
        $field_name = "post_image2";
        
        $config['upload_path']   = './lostfoundimages/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '1000000'; // 30MB
		$this->upload->initialize($config);
        
        // After defining Your variable make sure to refere to it in the do_upload
        if ( !$this->upload->do_upload($field_name))
        {
            //$error = array('error' => $this->upload->display_errors());
            //This is how you pass your errors directly to the flash data
            $this->session->set_flashdata('failed_post','Sorry, Your post could not been published'. $this->upload->display_errors());
            
            redirect('user/lostfound/'. $this->session->userdata('username')); 
            //$this->load->view('userpage/posts', $error);
        }
        else
        {
            
        $this->form_validation->set_rules('pet_name'      ,'Pet name '      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_breed'     ,'pet_breed'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_color'     ,'Pet color'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_gender'    ,'Pet gender'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_agenumber' ,'Age number'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('missing_since' ,'Missing since'  ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_ageperiod' ,'Age period'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_micro'     ,'Microship #'    ,'trim|required|xss_clean');
        $this->form_validation->set_rules('pet_location'  ,'Locatioin'      ,'trim|required|xss_clean');
        $this->form_validation->set_rules('description'   ,'More about pet' ,'trim|required|xss_clean|max_length[95]');
        
            if ($this->form_validation->run() == FALSE){
                
                $this->session->set_flashdata('failed_post','Sorry, Your post could not been published'. $this->upload->display_errors()); 
                // this is how you se the validation_errors to the page with redirect killing everything
                $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger"> <strong> Oh snap! </strong> ',' </div>'));
                
                redirect('user/lostfound/'. $this->session->userdata('username'));
                
            } else {
                
                $this->User_model->upload_fpet();

                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('success_postfound','congratulations, Your post has successfuly been posted');    

                // THE SUCCESS DOES NOT NEED THE SUCCESS HANDLING    
                redirect('user/lostfound/'. $this->session->userdata('username'), 'refresh');
                
            }
            
        }
    }

/*
 * Ads setting and uploading
 */    
    public function ads($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        $data['user'] = $this->User_model->get_user($username);
        
        // Here we are getting the user profile image
        $data['im_prof'] = $this->User_model->get_im_profile();
        // This is for the right Ads content in reptile's page
        $data['allmessages']     = $this->User_model->get_total_user_messages();
        $data['allmessagessent'] = $this->User_model->get_total_user_messagessent();
        $data['allimagesfact']   = $this->User_model->get_total_user_imagesfact();
        $data['allimages']       = $this->User_model->get_total_user_images();
        $data['allads']          = $this->User_model->get_total_user_ads();
        $data['allOffers']       = $this->User_model->get_total_user_offers();
        $data['allOrders']       = $this->User_model->get_total_user_orders();
        $data['ads']          = $this->User_model->get_ads();
        $data['myads']        = $this->User_model->get_my_ads($username);
        $data['spons']        = $this->Buyorsell_model->pets_sponsord();
        $data['sponsf']       = $this->Buyorsell_model->pets_sponsordfoot();
        $data['main_content'] = 'userpage/ads';
        $this->load->view('layouts/mainuserpage',$data);
    }
    
    public function delete_ad(){
        
        $this->User_model->delete_ad();
        
        $this->session->set_flashdata('delete_ad',' Your ad has been deleted');
        
        redirect('user/ads/'. $this->session->userdata('username'));
        
    }
    
    public function upload_ad(){
        
        //make sure to name your own field name if not its not going to work unless
        //you use do_upload 
        // Make the field_name = to the name of your <input type"file" name="post_image">
        $field_name = "post_image";
        
        $config['upload_path']   = './adsimages/'; // Goes to the root in the images folder
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '1000000'; // 30MB
		$this->upload->initialize($config);
        
        // After defining Your variable make sure to refere to it in the do_upload
        if ( !$this->upload->do_upload($field_name))
        {
            //$error = array('error' => $this->upload->display_errors());
            //This is how you pass your errors directly to the flash data
            $this->session->set_flashdata('failed_post','Sorry, Your ad could not been published'. $this->upload->display_errors());
            
            redirect('user/ads/'. $this->session->userdata('username')); 
            //$this->load->view('userpage/posts', $error);
        }
        else
        {
            
        $this->form_validation->set_rules('company_name' ,'Company_name','trim|required|xss_clean');
        $this->form_validation->set_rules('target_gender' ,'Gender'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('target_age_from','Age From'  ,'trim|required|xss_clean');
        $this->form_validation->set_rules('target_age_to' ,'Age to'     ,'trim|required|xss_clean');
        $this->form_validation->set_rules('ad_id'         ,'Some Problem occured','trim|required|xss_clean');
        $this->form_validation->set_rules('catchy_word'   ,'Catchy Word','trim|required|xss_clean');
        $this->form_validation->set_rules('description'   ,'Description','trim|required|xss_clean|max_length[90]');
        $this->form_validation->set_rules('url'           ,'Url'        ,'trim|required|xss_clean');
        $this->form_validation->set_rules('call_to_action','Call To Action'      ,'trim|xss_clean');
        
            if ($this->form_validation->run() == FALSE){
                
                $this->session->set_flashdata('failed_post','Sorry, Your ad could not been published'. $this->upload->display_errors()); 
                // this is how you se the validation_errors to the page with redirect killing everything
                $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger"> <strong> Oh snap! </strong> ',' </div>'));
                
                redirect('user/ads/'. $this->session->userdata('username'),'refresh');
                
            } else {
                
                $this->User_model->upload_ad();

                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('success_post','congratulations, Your ad has successfuly been posted');    

                // THE SUCCESS DOES NOT NEED THE SUCCESS HANDLING    
                redirect('user/ads/'. $this->session->userdata('username'), 'refresh');
                
            }
            
        }
    }
    
}
