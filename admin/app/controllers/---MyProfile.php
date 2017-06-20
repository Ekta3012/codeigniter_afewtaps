<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyProfile extends CI_Controller {

    private $_newadmin;
	
	private $_userid;
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_newadmin	 =		 $this->db->dbprefix('newadmin');
			 
			 $this->_userid      =      (int) $this->session->userdata('adminid');
			 
			 if ($this->_userid === 0)
			 redirect(base_url());
		 
		}
		
	public function myprofile()
		{
			$data['email'] = $this->myprofilemodel->getEmail($this->_userid);
			$this->load->view('settings/myprofile', $data);
		/*	$this->form_validation->set_rules('email', 'Email',  'required|valid_email|is_unique[ft_newadmin.email]');
		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('settings/myprofile');
                }
            else
                {
					$num_rows = (int) $this->db->get_where($this->_newadmin, array('id' => $this->_userid, 'email' =>  $email))->num_rows();
                    $this->myprofilemodel->updateEmail($this->_userid);
                }*/
			
		}
		
		

}