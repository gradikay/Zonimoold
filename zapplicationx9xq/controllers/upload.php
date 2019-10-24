<?php
// Not in use
class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
        $field_name = "userfile2";
        $field_name2 = "userfile";
        $field_name3 = "userfile3";
        
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'mp4|wmv|mov|ogg';
		$config['max_size']	= '100000000';

		$this->upload->initialize($config);

		if (!$this->upload->do_upload($field_name,$field_name2,$field_name3))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
           // $ffprobe = FFMpeg\FFProbe::create();
           // $ffprobe
           //         ->format('./upload/') // extracts file informations
           //         ->get('duration'); 

			$this->load->view('upload_success', $data);
		}
	}
}
?>