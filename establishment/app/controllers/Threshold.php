<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Threshold extends CI_Controller {

    private $_userid;
	
    public function __construct()
		{
             parent::__construct();
			
			 $this->_userid  = (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url()); 
		}
		
	public function view()
		{
			$this->load->view('threshold/threshold');
		}
		
	public function updateThreshold()
		{
			header('Content-Type: application/json');
			$affected = $this->thresholdmodel->updateThreshold($this->_userid);
			echo json_encode(array('status' => $affected));
		}
		
}