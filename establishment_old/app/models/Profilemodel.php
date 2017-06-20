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
			$data['password']   =       sha1($this->input->post('new_password'));
			$this->db->where('id', $id);
			$this->db->update($this->_account, $data);
			$this->session->set_flashdata('updtpwd', 'updtpwd');
			redirect('profile/changePassword');
		}
}
