<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuisine extends CI_Controller {

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
			$this->form_validation->set_rules('name', 'Cuisine Name',  'trim|required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info']  =    $this->cuisinemodel->getCuisineInfo($id, $this->_userid);
				
					$data['uid']   =    $this->_userid;
				
                    $this->load->view('cuisine/cuisine', $data);
                }
            else
                {
                    $this->cuisinemodel->addUpdateCuisine($id, $this->_userid);
                }			
		}
		
	public function view()
		{
			$data['cuisine'] = $this->cuisinemodel->allCuisine($this->_userid);
			$this->load->view('cuisine/viewcuisine', $data);
		}
		
	public function del($id = '')
		{
			$this->cuisinemodel->deleteCuisine($id, $this->_userid);
		}
}