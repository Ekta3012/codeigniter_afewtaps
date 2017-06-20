<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    private $_account;
	
	private $_userid;
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_account	 =		 $this->db->dbprefix('account');
			 
			 $this->_userid      =      (int) $this->session->userdata('id');
			 
			 if ($this->_userid === 0)
			 redirect(base_url());
		 
		}
		
	public function changePassword()
		{
			$this->form_validation->set_rules('email', 'Email',  'trim|valid_email|callback_checkEmail');
			
			$pwd               =  $this->input->post('old_password');
			$new_password      =  $this->input->post('new_password');
			$retype_password   =  $this->input->post('retype_password');
			
			if ( (! empty($pwd)) OR (! empty($new_password)) OR (! empty($retype_password)))
				{
					$this->form_validation->set_rules('old_password', 'Old Password',  'trim|required|callback_checkOldPassword');
					$this->form_validation->set_rules('new_password', 'New Password',  'trim|required|min_length[5]|matches[retype_password]');
					$this->form_validation->set_rules('retype_password', 'Re-type Password',  'trim|required');
				}
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('profile/changepassword');
                }
            else
                {
                    $this->profilemodel->updatePassword($this->_userid);
                }
			
		}
		
	public function checkEmail($email = '')
		{
			$num_rows = (int) $this->db->get_where($this->_account, array('email' => $email, 'status' =>  1))->num_rows();
			if ($num_rows > 0)
				{
					$this->form_validation->set_message('checkEmail', 'This Email already exists.');
					return FALSE;
				}
			else
				{
					return TRUE;
				}
		}
		
		
    function checkOldPassword($old_password = '')
		{
			$num_rows = (int) $this->db->get_where($this->_account, array('id' => $this->_userid, 'password' =>  sha1($old_password)))->num_rows();
			if ($num_rows === 0)
				{
					$this->form_validation->set_message('checkOldPassword', 'The old password you entered is incorrect.');
					return FALSE;
				}
			else
				{
					return TRUE;
				}
		}
		
		
	public function logout()
		{
			$this->session->unset_userdata(array('id' => ''));
			$this->session->sess_destroy();
			redirect(base_url());
		}
}