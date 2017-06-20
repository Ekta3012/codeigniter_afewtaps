<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 $id  = (int) $this->session->userdata('id');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function order()
		{
			//$data['completed_orders'] =  array('May' => 7, 'Jun' => 23, 'Jul' => 25, 'Aug' => 34);
			
			$data['response']   =  $this->analyticmodel->noOfOrders();
			
			//print_r($data); die();
			
			
			$array[]                    =  array('name' => 'May', 'y' => 15, 'drilldown' => 'May');
			$array[]                    =  array('name' => 'Jun', 'y' => 26, 'drilldown' => 'Jun');
			$array[]                    =  array('name' => 'Jul', 'y' => 35, 'drilldown' => 'Jul');
			$array[]                    =  array('name' => 'Aug', 'y' => 25, 'drilldown' => 'Aug');
			$array[]                    =  array('name' => 'Sep', 'y' => 45, 'drilldown' => 'Sep');
			//$data['completed_orders']   =  json_encode($array);
			
			$array                      =  array();
			
			$array[]                    =  array('name' => 'May', 'y' => 21, 'drilldown' => 'May');
			$array[]                    =  array('name' => 'Jun', 'y' => 15, 'drilldown' => 'Jun');
			$array[]                    =  array('name' => 'Jul', 'y' => 32, 'drilldown' => 'Jul');
			$array[]                    =  array('name' => 'Aug', 'y' => 21, 'drilldown' => 'Aug');
			$array[]                    =  array('name' => 'Sep', 'y' => 12, 'drilldown' => 'Sep');
			//$data['cancelled_orders']   =  json_encode($array);
			
			
			$array                      =  array();
			
			$array[]                    =  array('name' => 'May', 'y' => 23, 'drilldown' => 'May');
			$array[]                    =  array('name' => 'Jun', 'y' => 17, 'drilldown' => 'Jun');
			$array[]                    =  array('name' => 'Jul', 'y' => 32, 'drilldown' => 'Jul');
			$array[]                    =  array('name' => 'Aug', 'y' => 31, 'drilldown' => 'Aug');
			$array[]                    =  array('name' => 'Sep', 'y' => 19, 'drilldown' => 'Sep');
			//$data['nudged_orders']      =  json_encode($array);
			
			
			$array                      =  array();
			
			$array[]                    =  array('name' => 'May', 'y' => 14, 'drilldown' => 'May');
			$array[]                    =  array('name' => 'Jun', 'y' => 19, 'drilldown' => 'Jun');
			$array[]                    =  array('name' => 'Jul', 'y' => 21, 'drilldown' => 'Jul');
			$array[]                    =  array('name' => 'Aug', 'y' => 26, 'drilldown' => 'Aug');
			$array[]                    =  array('name' => 'Sep', 'y' => 27, 'drilldown' => 'Sep');
			//$data['threshold_orders']   =  json_encode($array);
			
		
			$this->load->view('analytics/order', $data);
		}
		
	public function businessGenerated()
		{
			$array                        =  array();
			
			$response                     =  $this->analyticmodel->businessGeneratedModule();
			
			$data['business_generated']   =  json_encode($response['prev']);
			
			$data['prev_business']        =  $response['month']['prev']['price'];
			$data['prev_month']           =  $response['month']['prev']['month_name'];
			
			$data['current_business']     =  $response['month']['current']['price'];
			$data['current_month']        =  $response['month']['current']['month_name'];
			
			$this->load->view('analytics/businessgenerated', $data);
		}
		
	public function staffAnalytics()
		{
			$this->load->view('analytics/staff_performance');
		}
		
	public function negligentRatings()
		{
			
		}
		
	public function staffAnalytics1()
		{
			
		}
		
}