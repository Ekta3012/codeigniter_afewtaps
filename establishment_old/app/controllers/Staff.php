<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

    private $_userid;
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid  = (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function index($id = '')
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('phone_no', 'Phone', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info'] = $this->staffmodel->getMember($id);
				
				    $data['uid']  = $this->_userid;
				
                    $this->load->view('staff/staff', $data);
                }
            else
                {
                    $this->staffmodel->addUpdateStaffMember($id, $this->_userid);
                }			
		}
		
		
	public function view()
		{
			$data['staff'] =  $this->staffmodel->allMembers($this->_userid);
			$data['uid']   =  $this->_userid;
			$this->load->view('staff/viewstaff', $data);
		}
		
	public function del($id = '', $segment = '')
		{
			$this->staffmodel->delMember($id, $segment, $this->_userid);
		}
		
	
}