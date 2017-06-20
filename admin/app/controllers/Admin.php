<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 $id  = (int) $this->session->userdata('adminid');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function thresholdView()
		{
			$this->load->view('threshold/threshold');
		}
		
	public function updateThreshold()
		{
			header('Content-Type: application/json');
			$affected = $this->thresholdmodel->updateThreshold();
			echo json_encode(array('status' => $affected));
		}
		
	public function location()
		{
			$this->load->view('static/location');
		}
		
}