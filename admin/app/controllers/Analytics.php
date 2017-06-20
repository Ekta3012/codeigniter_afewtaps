<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 $id  = (int) $this->session->userdata('adminid');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function order()
		{
			$this->load->view('analytics/order');
		}
		
	public function businessGenerated()
		{
			$this->load->view('analytics/businessgenerated');
		}
		
	public function staffg()
		{
			$this->load->view('analytics/staff_performance');
		}
		
	public function negligentRatings()
		{
			
		}
		
	public function staffAnalytics()
		{
			
		}
		
}