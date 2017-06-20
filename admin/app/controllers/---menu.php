<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu extends CI_Controller {

    private $_userid;
	 private $_email;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid   =  (int) $this->session->userdata('adminid');
			 $this->_email =  $this->session->userdata('adminemail');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
public function index() {
    //$this->load->model('adminmenusmodel');
    $data['admenu'] = $this->adminmenusmodel->menus();
  
    $this->load->view('include/inc_navigation', $data);
}
}
?>