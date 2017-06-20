<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profilemodel extends CI_Model {

    private $_account;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_account	 =	$this->db->dbprefix('account');
		}
		
	public function updatePassword($id = '')
		{
			$email                   =     $this->input->post('email');
			
			$pwd                     =     $this->input->post('new_password');
			if ( ! empty($email))
				{
					$data['email']   =     $email;
					$this->db->where('id', $id)->update($this->_account, $data);
					
					$this->session->unset_userdata('email');
					$this->session->set_userdata('email', $email);
					$this->session->set_flashdata('updtpwd', 'updtpwd');
				}
				
			if ( ! empty($pwd))
				{
					$data['password']   =       sha1($this->input->post('new_password'));
					$this->db->where('id', $id)->update($this->_account, $data);
					$this->session->set_flashdata('updtpwd', 'updtpwd');
				}	

			redirect('profile/changePassword');
		}
}
