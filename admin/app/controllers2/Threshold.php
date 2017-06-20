<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Threshold extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 
			 $id  = (int) $this->session->userdata('id');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function view()
		{
			$this->load->view('threshold/threshold');
		}
		
	public function updateThreshold()
		{
			header('Content-Type: application/json');
			$affected = $this->thresholdmodel->updateThreshold();
			echo json_encode(array('status' => $affected));
		}
		
}