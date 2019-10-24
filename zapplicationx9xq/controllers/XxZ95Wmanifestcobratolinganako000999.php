<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Dogs extends CI_Controller {
class XxZ95Wmanifestcobratolinganako000999 extends CI_Controller {
    
    public function __construct()
        {
                parent::__construct();
        }
    
    public function index($username){
        $this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        $data['user'] = $this->User_model->get_user($username);
        $data['users'] = $this->User_model->get_user_for_admin();
        $data['allUsers'] = $this->User_model->get_total_user_for_admin();
        $data['allVisit'] = $this->User_model->get_total_visitors_for_admin();
        $data['top_ten'] = $this->User_model->get_ten_user_for_admin();
        $data['top_ten_vis'] = $this->User_model->get_ten_visiters_for_admin();
        $data['visitors'] = $this->User_model->get_visiters_for_admin();
		
        $data['feedbacks'] = $this->User_model->get_feedback_for_admin();
        $data['top_ten_feed'] = $this->User_model->get_ten_feedbacks_for_admin();
        $data['allFeedbacks'] = $this->User_model->get_total_feedbacks_for_admin();
		
        
        
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
        $data['main_content']    = 'userpage/administration';
        $this->load->view('layouts/mainuserpage',$data);
    }
	
	public function ad_report($username){
		$this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        $data['user'] = $this->User_model->get_user($username);
        $data['users'] = $this->User_model->get_user_for_admin();
        $data['visitors'] = $this->User_model->get_visiters_for_admin();
        
        
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
            // Used for the left side panel "allsomething"
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
        $data['main_content']    = 'userpage/report_ad';
        $this->load->view('layouts/mainuserpage',$data);
		
	}
	
	public function facto_report($username){
		
	}
	
	public function visitors($username){
		
		
		$this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        $data['user'] = $this->User_model->get_user($username);
        $data['users'] = $this->User_model->get_user_for_admin();
        $data['visitors'] = $this->User_model->get_visiters_for_admin();
        
        
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
            // Used for the left side panel "allsomething"
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
        $data['main_content']    = 'userpage/report_visitors';
        $this->load->view('layouts/mainuserpage',$data);
	
		
	}
	
	// Returns all the users to the admin
	public function users($username){
	
		$this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
        $data['user'] = $this->User_model->get_user($username);
        $data['users'] = $this->User_model->get_user_for_admin();
        $data['visitors'] = $this->User_model->get_visiters_for_admin();
        
        
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
            // Used for the left side panel "allsomething"
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
        $data['main_content']    = 'userpage/report_users';
        $this->load->view('layouts/mainuserpage',$data);
		
	}
	
	public function feedback($username){
	
		$this->load->model('Buyorsell_model');
        $this->load->helper('text');
        
         $data['feedbacks'] = $this->User_model->get_feedback_for_admin();
        $data['top_ten_feed'] = $this->User_model->get_ten_feedbacks_for_admin();
        $data['allFeedbacks'] = $this->User_model->get_total_feedbacks_for_admin();
        
        
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
            // Used for the left side panel "allsomething"
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
        $data['main_content']    = 'userpage/report_feedbacks';
        $this->load->view('layouts/mainuserpage',$data);
		
	}
}    