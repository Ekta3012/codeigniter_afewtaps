<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    private $_userid;
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid  = (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function index()
		{
			$this->load->view('payment/viewsettlement');
		}
		
	public function method()
		{
			$data['payment'] = $this->thresholdmodel->getPaymentMethod($this->_userid);
			$this->load->view('payment/payment_method', $data);
		}
		
	public function lastordernotification()
		{
			$this->load->view('payment/lastordernotification');
		}
		
	public function ajaxPayment()
		{
			echo $this->thresholdmodel->savePaymentMethod($this->_userid);
		}
}