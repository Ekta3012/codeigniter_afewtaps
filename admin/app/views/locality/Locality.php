<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locality extends CI_Controller {
   private $_userid;
   
    public function __construct()
		{
             parent::__construct();
		    $this->_userid   =  (int) $this->session->userdata('adminid');
			if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function lists()
		{
			$this->load->model('localitymodel');
			/*$data['listofrestaurant'] = $this->localitymodel->listofRestaurant();
			$this->load->view('locality/list', $data);*/
			/**/
		
			$this->form_validation->set_rules('estab', 'Establishment Name', 'required');
			
			//$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			$data['listofrestaurant'] = $this->localitymodel->Filter_listofRestaurant();
            if ($this->form_validation->run() == FALSE)
                {
					
                  $data['listofrestaurant'] = $this->localitymodel->listofRestaurant();
				$this->load->view('locality/list', $data);
					
					
                }
				
            else
			{
					
				$this->load->view('locality/list', $data);
               
			}
			
		}
		
		public function summary()
		{
			$this->load->model('localitymodel');
			/*$data['listofrestaurant'] = $this->localitymodel->listofRestaurant();
			$this->load->view('locality/list', $data);*/
			/**/
		
			$this->form_validation->set_rules('estab', 'Establishment Name', 'required');
			
			//$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			$data['listofrestaurant'] = $this->localitymodel->Filter_listofRestaurant();
            if ($this->form_validation->run() == FALSE)
                {
					
                  $data['listofrestaurant'] = $this->localitymodel->listofRestaurant();
				$this->load->view('locality/summary', $data);
					
					
                }
				
            else
			{
					
				$this->load->view('locality/summary', $data);
               
			}
			
		}
		
		public function order()
		{
			$this->load->model('localitymodel');
			/*$this->form_validation->set_rules('start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('end_date', 'End Date', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			
            if ($this->form_validation->run() == FALSE)
                {
					
                  $data['order'] = $this->localitymodel->orderhistory();
					$this->load->view('locality/order',$data);
					
					
                }
				
            else
			{
					$data['order'] = $this->localitymodel->all();
					$this->load->view('locality/order',$data);
               
			}*/
			/**/
		
		
			$this->form_validation->set_rules('estab', 'Establishment Name', 'required');
			
			//$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			 $data['getorder'] = $this->localitymodel->orderhistory();
            if ($this->form_validation->run() == FALSE)
                {
					
                 
					$this->load->view('locality/order',$data);
					
					
                }
				
            else
			{
					$data['orderdta'] = $this->localitymodel->Filter_OrderByEstab();
				$this->load->view('locality/order',$data);
               
			}
			
		
			
			
		}
		public function history($order_id='')
		{
			$this->load->model('localitymodel');
			$data['orderhistory'] = $this->localitymodel->orderhistorydetails($order_id);
			$this->load->view('locality/history',$data);
		}
		
		
		public function estab()
		{
			$this->load->model('localitymodel');
			$this->form_validation->set_rules('res_name','Res Name','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			
            if ($this->form_validation->run() == FALSE)
                {
					
                  $data['order'] = $this->localitymodel->orderhistory();
					$this->load->view('locality/order',$data);
					
					
                }
				
            else
			{
					$data['order'] = $this->localitymodel->estab();
					$this->load->view('locality/order',$data);
               
			}
			
			
		}
		/*public function history($order_id='')
		{
			$this->load->model('localitymodel');
			$data['orderhistory'] = $this->localitymodel->orderhistorydetails($order_id);
			$this->load->view('locality/history',$data);
		}*/
		
		public function insideinfo()
		{
			$this->load->model('localitymodel');
			$this->form_validation->set_rules('estab', 'Establishment Name', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			$data['analytics'] = $this->localitymodel->estabAnalytics();
			$data['result'] = $this->localitymodel->getInsideInfo();
            if ($this->form_validation->run() == FALSE)
                {
					
                  
					$this->load->view('locality/insideinfo',$data);
					
					
                }
				
            else
			{
					
					$this->load->view('locality/insideinfo',$data);
               
			}
		}
			
	
		/*Start code for analytics*/
		/*public function analyticss()
		{
			$this->load->model('localitymodel');
			$this->form_validation->set_rules('start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('end_date', 'End Date', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			
            if ($this->form_validation->run() == FALSE)
                {
					
                 $data['analytics'] = $this->localitymodel->getestabAnalytics();
					$this->load->view('locality/analytics',$data);
					
					
                }
				
            else
			{
					$data['analytics'] = $this->localitymodel->all();
					$this->load->view('locality/analytics',$data);
               
			}
			
			
		}*/
		
		public function analytics()
		{
			$this->load->model('localitymodel');
		    $this->form_validation->set_rules('estab', 'Establishment Name', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			$data['loc_analytcs'] 		  = $this->localitymodel->estabAnalytics();
			
			
			$response                     =  $this->localitymodel->getestabAnalytics();
			$data['prev_month']           =  $response['month']['prev']['month_name'];
			$data['analytics_data']       =  $response['orders'];
			
			$data['current_month']        =  $response['month']['current']['month_name'];
			
            if ($this->form_validation->run() == FALSE)
                {
					
                 	
					$this->load->view('locality/analytics',$data);
					
					
                }
				
            else
			{
					
					$this->load->view('locality/analytics',$data);
               
			}
		}
		
		public function filteranalytics()
		{
			$this->load->model('localitymodel');
			$this->form_validation->set_rules('start_date1','Start date','required');
			$this->form_validation->set_rules('end_date1','End date','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			
            if ($this->form_validation->run() == FALSE)
                {
					
                  $data['analytics'] = $this->localitymodel->estabAnalytics();
					$this->load->view('locality/analytics',$data);
					
					
                }
				
            else
			{
					$data['analytics_data'] = $this->localitymodel->getfilterAnalytics();
					$this->load->view('locality/analytics',$data);
               
			}
		}
		/*End code for analytics*/
		
}