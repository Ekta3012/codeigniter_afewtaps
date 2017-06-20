<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 
			 $id  = (int) $this->session->userdata('id');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function index($id = '')
		{
			$this->form_validation->set_rules('tax_name', 'Tax name', 'required');
			$this->form_validation->set_rules('tax_rate', 'Tax rate', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info'] = $this->taxmodel->getTaxInfo($id);
				
                    $this->load->view('tax/tax', $data);
                }
            else
                {
                    $this->taxmodel->addUpdateTax($id);
                }			
		}
		
		
	public function view()
		{
			$data['tax'] = $this->taxmodel->all();
			$this->load->view('tax/viewtax', $data);
		}
		
		
	public function del($id = '')
		{
			$this->taxmodel->deleteTax($id);
		}
}