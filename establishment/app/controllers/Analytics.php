<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller {

    private $_id;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_id  = (int) $this->session->userdata('id');
			 if ($this->_id === 0)
			 redirect(base_url());
		 
		}
		
	public function order()
		{
			//$data['completed_orders'] =  array('May' => 7, 'Jun' => 23, 'Jul' => 25, 'Aug' => 34);
			
			$data['response']   =  $this->analyticmodel->noOfOrders();
			
//			 print_r($data); die();
			
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
			
			// $data['cancelled_orders']   =  json_encode($array);
			
			
			$array                      =  array();
			
			$array[]                    =  array('name' => 'May', 'y' => 23, 'drilldown' => 'May');
			$array[]                    =  array('name' => 'Jun', 'y' => 17, 'drilldown' => 'Jun');
			$array[]                    =  array('name' => 'Jul', 'y' => 32, 'drilldown' => 'Jul');
			$array[]                    =  array('name' => 'Aug', 'y' => 31, 'drilldown' => 'Aug');
			$array[]                    =  array('name' => 'Sep', 'y' => 19, 'drilldown' => 'Sep');
			
			// $data['nudged_orders']      =  json_encode($array);
			
			$array                      =  array();
			
			$array[]                    =  array('name' => 'May', 'y' => 14, 'drilldown' => 'May');
			$array[]                    =  array('name' => 'Jun', 'y' => 19, 'drilldown' => 'Jun');
			$array[]                    =  array('name' => 'Jul', 'y' => 21, 'drilldown' => 'Jul');
			$array[]                    =  array('name' => 'Aug', 'y' => 26, 'drilldown' => 'Aug');
			$array[]                    =  array('name' => 'Sep', 'y' => 27, 'drilldown' => 'Sep');
			
			//$data['threshold_orders']   =  json_encode($array);
//			echo '<pre>';
//                        print_r($data);
//                        die();
			$this->load->view('analytics/order', $data);
		}
	public function orders(){
                    $data['response']   =  $this->analyticmodel->noOfOrders_new();
//                    echo '<pre>';
//                    print_r($data);
//                    echo '</pre>';die();
                    $this->load->view('analytics/order', $data);
		}
		
	public function businessGeneratedn()
		{			
			$data                     =  	$this->analyticmodel->businessGeneratedModule_new();
//                        echo '<pre>';
//                        print_r($data);
//                        echo '</pre>';die();
			$this->load->view('analytics/businessgenerated_new', $data);	
		}
	public function businessGenerated()
		{
			$array                        = 	array();
			
			$response                     =  	$this->analyticmodel->businessGeneratedModule();
			
			$data['business_generated']   =  	json_encode($response['prev']);
			
			$data['prev_business']        =  	$response['month']['prev']['price'];
			$data['prev_month']           =  	$response['month']['prev']['month_name'];
			
			$data['current_business']     =  	$response['month']['current']['price'];
			$data['current_month']        =  	$response['month']['current']['month_name'];
//			echo '<pre>';
//                        print_r($response);
//                        die();
			$this->load->view('analytics/businessgenerated_new', $response);
			
		}
		
	public function staffAnalytics($sid = '')
		{
			$response = $this->analyticmodel->getStaffAnalyticStaff($sid, $this->_id);
//                        $result['orders_box']       =  $this->ordermodel->getOrderHistoryDetails($establid);
			$this->load->view('analytics/staff_performance', compact('response', 'sid'));
		}
	public function staffAnalytics_old($sid = '')
		{
			$response = $this->analyticmodel->getStaffAnalyticStaff_old($sid, $this->_id);
			$this->load->view('analytics/staff_performance_old', compact('response', 'sid'));
		}
		
	public function getStaffAnalyticsData()
		{ 
			header('Content-Type: application/json');
			$res = $this->analyticmodel->getPotentialBusinessAjax();
			echo json_encode(array('result' => $res, "token" => $this->security->get_csrf_hash()));
		}
		
	public function getNoOfOrdersData()
		{ 
			header('Content-Type: application/json');
			$res = $this->analyticmodel->getNoOfOrdersDataAjax();
			echo json_encode(array('result' => $res));
		}
		
	public function getTotalOrdersAnalyticsData()
		{ 
			header('Content-Type: application/json');
			$res = $this->analyticmodel->getTotalOrdersAnalyticsModule();
			echo json_encode(array('result' => $res, "token" => $this->security->get_csrf_hash()));
		}
		
	public function getAvgTimeAnalyticsData()
		{ 
			header('Content-Type: application/json');
			$res = $this->analyticmodel->getAvgTimeAnalyticsDataModule();
			echo json_encode(array('result' => $res, "token" => $this->security->get_csrf_hash()));
		}	
		
	public function getAjaxOrders()
		{ 
			header('Content-Type: application/json');
			$res = $this->analyticmodel->getAjaxOrdersModule();
			echo json_encode(array('result' => $res, "token" => $this->security->get_csrf_hash()));
		}		
		
		
	public function negligentRatings()
		{
			
		}
		
	public function staffAnalytics1()
		{
			
		}
		
}