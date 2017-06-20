<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment extends CI_Controller {

    private $_userid;
    private $_establishment;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid   =  (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		 
			$this->_establishment   =   $this->db->dbprefix('establishment');
		}
		
	public function index($id = '')
		{							
            // $flag = getUserEstab($this->_userid);
            // if ($flag > 0)
			// redirect('establishment/view');
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
			$this->form_validation->set_rules('primary_contact_name', 'Primary Contact Name', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']   =   array();
            if ($this->form_validation->run() == FALSE)
                {
					$data['estab_flag'] = 0; // $this->estabmodel->estabFlag($this->_userid);
					
					if ($id != '')
					$data['estab_info'] = $this->estabmodel->estabData($id);
					
                    $this->load->view('establishment/index', $data);
                }
            else
                {
                    $this->estabmodel->establishment($this->_userid, $id);
                }	
		}
		
	public function view()
		{
			$data['establishment'] = $this->estabmodel->allEstab($this->_userid);
			
			$this->load->view('establishment/viewestablishment', $data);
		}
		
	public function branch()
		{
			$this->form_validation->set_rules('secondary_contact_name', 'Secondary Contact Name', 'trim|required');		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('establishment/branch');
                }
            else
                {
                    $this->estabmodel->branch($this->_userid);
                }	
		}
		
	public function addLocation()
		{ 
            $this->estabmodel->addLocationModule($this->_userid);
			$this->load->view('establishment/addloc');
		} 
		
	public function updateLocation()
		{ 
            $data = $this->estabmodel->viewLocationModule($this->_userid);
			$this->load->view('establishment/updtloc', compact('data'));
		} 
		
		
	public function viewLocation()
		{
			$response  =  $this->estabmodel->viewLocationModule($this->_userid);
			
			print_r($response);
			
			//print_r($response); die();
			$this->load->view('establishment/viewloc', compact('response'));
		}
	
}