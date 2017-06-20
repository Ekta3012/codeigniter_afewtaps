<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 
			 $id  = (int) $this->session->userdata('id');
			 if ($id > 0)
			 redirect('establishment');
			 
		}
		
	public function index()
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('account/login');
                }
            else
                {
                    $this->authenticate->authenticateUser();
                }			
		}
		
	public function forgotPassword()
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('account/forgot');
                }
            else
                {
                    $this->authenticate->authenticateUser();
                }			
		}
		
	
}
