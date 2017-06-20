<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


    private $_newadmin;
	
    public function __construct()
		{
             parent::__construct();
			 
			 
			 $this->_newadmin  =  $this->db->dbprefix('newadmin');
			 
			 
			 //die('sdf');
			 
			 $id  = (int) $this->session->userdata('adminid');
			 //if ($id > 0)
			 //redirect('establishment');
			
		}
		
	public function index()
		{
			//die('sdf');
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
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_admincheck');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('account/forgot');
                }
            else
                {
                    $this->authenticate->forgotPasswordModule();
                }			
		}
		
		
	public function admincheck($email)
        {
			    $numrows = (int) $this->db->get_where($this->_newadmin, array('email' => $email, 'status' => 1))->num_rows();
                if ($numrows == 0)
					{
							$this->form_validation->set_message('admincheck', "The $email does not exist.");
							return FALSE;
					}
                else
					{
							return TRUE;
					}
        }
		
	
}
