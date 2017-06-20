<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {

    private $_userid;
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid  = (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
		
	public function serviceCharge($id = '')
		{
			$this->form_validation->set_rules('service_charge', 'Service Charge', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('tax/tax');
                }
            else
                {
                    $this->taxmodel->addUpdateServiceCharge($this->_userid);
                }			
		}
	
	/*public function index($id = '')
		{
			$this->form_validation->set_rules('tax_name', 'Tax name', 'required');
			$this->form_validation->set_rules('tax_rate', 'Tax rate', 'required');
			
			if (count($this->input->post('tax_apply')) == 0 && $this->uri->segment(3) == '')
			$this->form_validation->set_rules('tax_apply', 'Tax Category', 'required');
		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info'] = $this->taxmodel->getTaxInfo($id);
				
				    $data['serviceCharge'] = $this->taxmodel->getServiceCharge($this->_userid);
				
                    $this->load->view('tax/tax', $data);
                }
            else
                {
                    $this->taxmodel->addUpdateTax($this->_userid, $id);
                }			
		}
		*/
		
	public function index($id = '')
		{
			$this->form_validation->set_rules('tax_index', 'Tax name', 'required');
			$this->form_validation->set_rules('tax_rate', 'Tax rate', 'required');
		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info'] = $this->taxmodel->getTaxInfo($id);
				
				    //$data['serviceCharge'] = $this->taxmodel->getServiceCharge($this->_userid);
				
                    $this->load->view('tax/tax', $data);
                }
            else
                {
                    $this->taxmodel->addUpdateTax($this->_userid, $id);
                }			
		}
		
		
	public function view()
		{
			$data['tax']           = $this->taxmodel->all($this->_userid);
			$data['serviceCharge'] = $this->taxmodel->getServiceCharge($this->_userid);
			$this->load->view('tax/viewtax', $data);
		}
		
		
	public function del($id = '')
		{
			$this->taxmodel->deleteTax($id);
		}
}