<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Floor extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 $id  = (int) $this->session->userdata('id');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function index()
		{
			$data['floor'] = [] ; //$this->taxmodel->all();
			$this->load->view('floor/view', $data);
		}
		
}