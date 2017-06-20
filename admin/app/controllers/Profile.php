<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    private $_account;
	 private $_newadmin;
	
	private $_userid;
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_account	 =		 $this->db->dbprefix('account');
			 
			 $this->_userid      =      (int) $this->session->userdata('adminid');
			 $this->_newadmin	 =	$this->db->dbprefix('newadmin');
			 
			 if ($this->_userid === 0)
			 redirect(base_url());
		 
		}
		
	/*public function changePassword()
		{
			
			$this->form_validation->set_rules('old_password', 'Old Password',  'trim|required|callback_checkOldPassword');
			$this->form_validation->set_rules('new_password', 'New Password',  'trim|required|matches[retype_password]');
			$this->form_validation->set_rules('retype_password', 'Re-type Password',  'trim|required');
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
		}*/
	/*for my profile page*/
		
		public function myprofile()
			{
				$this->form_validation->set_rules('name', 'Name',  'trim');
				$this->form_validation->set_rules('email', 'Email',  'required|valid_email|is_unique[ft_newadmin.email]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
				if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('profile/myprofile');
					}
				else
					{
					   $this->profilemodel->updateEmail($this->_userid);
					}
			}	
		
	/*public function index() {
    // $path = base_url().'js/ckfinder';
    $path = base_url().'assets/ckfinder/';
    $width = '850px';
    $this->privacy($path, $width);
    $this->form_validation->set_rules('description', 'Page Description', 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('profile/privacy');
    }
    else {
      // do your stuff with post data.
      echo $this->input->post('description');
    }
  }*/
		
		public function privacy() 
		{
			$this->load->model('profilemodel');
		    $data['privacy'] = $this->profilemodel->getPrivacydata();
			$this->load->view('profile/privacy', $data);
        }
		
		
	public function logout()
		{
			$this->session->unset_userdata(array('adminid' => ''));
			$this->session->sess_destroy();
			redirect(base_url());
		}
		
		public function privacyedit($id = '')
		{
		   $this->load->model('profilemodel');
            $numRows = $this->profilemodel->checkPrivacy($id);
			if ($numRows > 0)
				{
					$this->form_validation->set_rules('title', 'Title', 'required|trim');
				    $this->form_validation->set_rules('description', 'Description', 'trim|required');
				
					$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
					$data['info']  = array();
					if ($this->form_validation->run() == FALSE)
						{
								if ($id != '')
								$data['info']     =   $this->profilemodel->getPrivacyById($id);
						
						
								$this->load->view('profile/privacyedit', $data);
						}
					else
						{
								$this->profilemodel->updatePrivacy($id);
						}
				}
			else
				 echo "<h1>404, Page Not Found</h1>";
		}
		
		public function del($id= '')
		{
			  $this->load->model('profilemodel');
			$this->profilemodel->deletePrivacy($id);
		
		}
		
		public function guidelines()
		{
			$this->load->model('profilemodel');
		    $data['guidelines'] = $this->profilemodel->getMerchantguidelinesdata();
			$this->load->view('profile/guidelines', $data);
		
		}
		
		public function index()
		{ 
		$this->load->model('profilemodel');
		   $this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			//$data['guidelines']  = array();
			if ($this->form_validation->run() == FALSE)
                {
					//$this->profilemodel->updateMerchantguidelinesdata();
                    $this->load->view('profile/index');
                }
            else
                {
                  $this->profilemodel->addMerchantguidelinesdata();
				    //$this->load->view('profile/guidelines');
                }	
	
		
		}
		
		public function guidelinesedit($id='')
		{ 
		    $this->load->model('profilemodel');
		   /* $this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			//$data['guidelines']  = array();
			if ($this->form_validation->run() == FALSE)
                {
					//$this->profilemodel->updateMerchantguidelinesdata();
                    $this->load->view('profile/index');
                }
            else
                {
                  $data['guidelines'] =   $this->profilemodel->updateMerchantguidelinesdata();
				    //$this->load->view('profile/guidelines');
                }	*/
	/**/
	

			$numRows = $this->profilemodel->checkMerchantguidelines($id);
			if ($numRows > 0)
				{
					 $this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
					$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
					$data['guidelines']  = array();
					if ($this->form_validation->run() == FALSE)
						{
								if ($id != '')
								$data['guidelines']     =   $this->profilemodel->getMerchantguidelines($id);
						
						
								$this->load->view('profile/guidelinesedit', $data);
						}
					else
						{
								$this->profilemodel->updateMerchantguidelines($id);
						}
				}
			else
				 echo "<h1>404, Page Not Found</h1>";
	
		
		}
		public function delguidelines($id= '')
		{
			  $this->load->model('profilemodel');
			$this->profilemodel->deleteGuidelines($id);
		
		}
		
		/*faq page code start*/
		
		public function faq()
		{
			$this->load->model('profilemodel');
		    $data['result'] = $this->profilemodel->getAllFaqData();
			$this->load->view('profile/faq', $data);
		
		}
		
		public function addfaq($id = '')
		{
			$this->load->model('profilemodel');
			$this->form_validation->set_rules('que', 'Question', 'required');
			$this->form_validation->set_rules('ans', 'Answer', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info'] = $this->profilemodel->getFaqInfo($id);
				
                    $this->load->view('profile/addfaq', $data);
                }
            else
                {
                    $this->profilemodel->addUpdateFaq($id);
                }			
		}
		public function delfaq($id= '')
		{
			  $this->load->model('profilemodel');
			$this->profilemodel->deleteFaq($id);
		
		}
		
		/*faq page code end*/
		
}