<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 $id  = (int) $this->session->userdata('id');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function index()
		{
			$data['tax'] = [] ; //$this->taxmodel->all();
			$this->load->view('order/order', $data);
		}
		
	public function view()
		{
			$data['tax'] = [] ; //$this->taxmodel->all();
			$this->load->view('order/vieworder', $data);
		}
		
	public function history()
		{
			$this->load->view('order/history');
		}
			
	
		
}