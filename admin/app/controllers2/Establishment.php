<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment extends CI_Controller {

    private $_userid;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid   =  (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function index()
		{			
			$this->form_validation->set_rules('primary_contact_name', 'Primary Contact Name', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']   =   array();
            if ($this->form_validation->run() == FALSE)
                {
					$data['estab_flag'] = $this->estabmodel->estabFlag($this->_userid);
                    $this->load->view('establishment/index', $data);
                }
            else
                {
                    $this->estabmodel->establishment($this->_userid);
                }	
		}
		
	public function view()
		{
			$data['establishment'] = $this->estabmodel->allEstab($this->_userid);
			$this->load->view('establishment/viewestablishment', $data);
		}
		
	public function branch()
		{
			$this->form_validation->set_rules('secondary_contact_name', 'Secondary Contact Name', 'trim|required');		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('establishment/branch');
                }
            else
                {
                    $this->estabmodel->branch($this->_userid);
                }	
		}
	
}