<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Model {

    private $_account;
	private $_newadmin;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_account  =   $this->db->dbprefix('account');
			 $this->_newadmin  =   $this->db->dbprefix('newadmin');
		}
		
	public function authenticateUser()
		{
			 $email       =   $this->input->post('email');
			 $password    =   sha1($this->input->post('password'));
			 $query       =   $this->db->get_where($this->_newadmin, array('email' => $email, 'password' => $password, 'status' => 1));
			 if ($query->num_rows() > 0)
				 {
					  $result         =   $query->row();
					  $session_array  =   array('adminid' => (int) $result->{'id'}, 'adminemail' => $result->{'email'}, 'aname' => $result->{'name'});
					  $this->session->set_userdata($session_array);
					  redirect('establishment/index');
				 }
			  else 
				  {
					  $this->session->set_flashdata('authfailed', 'authfailed');
					  redirect('auth/index');
				  }
		}
		
	public function forgotPasswordModule()
		{
			$email  = $this->input->post('email');
			
			$random = mt_rand();
			
			$this->db->where('email', $email)->update($this->_newadmin, array('password' => sha1($random)));
			
			$this->load->library('email');
			
			$this->email->from('no-reply@afewtaps.com', 'afewtaps');
			$this->email->to($email);
			$this->email->subject('afewtaps - admin reset password');
			$this->email->message('Hi, Your afewtaps admin new password is .'. $random);
			$this->email->send();
			
			$this->session->set_flashdata('send', 'send');
			redirect('auth/forgotPassword');
			
		}
		
}
