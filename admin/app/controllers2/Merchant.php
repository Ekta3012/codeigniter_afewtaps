<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {

    private $_userid;
    public function __construct()
		{
             parent::__construct();
			 
		     $this->_userid  = (int) $this->session->userdata('id');
			 
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function index()
		{
			$this->form_validation->set_rules('contact_person', 'Contact Person',  'trim|required');
			$this->form_validation->set_rules('contact_no', 'Contact Number',  'trim|required');
			$this->form_validation->set_rules('emailid', 'Email',  'trim|required|valid_email');
			$this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name Code',  'trim|required');
			$this->form_validation->set_rules('bank_name', 'Bank Name',  'trim|required');
			$this->form_validation->set_rules('bank_ac_no', 'Bank A/C no',  'trim|required');
			$this->form_validation->set_rules('ifsc_swift_code', 'IFSC/ SWIFT Code',  'trim|required');
			$this->form_validation->set_rules('acc_type', 'Account type',  'trim|required');
			$this->form_validation->set_rules('com_col_strt_dt', 'Commission Collection',  'trim|required');
			$this->form_validation->set_rules('com_slab', 'Commission Slab', 'trim|required');
			$this->form_validation->set_rules('merchant_details', 'Merchant Details',  'trim|required');
			$this->form_validation->set_rules('tds_deducted', 'TDS Deducted', 'trim|required');		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
            if ($this->form_validation->run() == FALSE)
                {
					$data['info'] = $this->merchantmodel->getMerchantInfo($this->_userid);
                    $this->load->view('merchant/information', $data);
                }
            else
                {
                    $this->merchantmodel->addUpdateMerchantInfo($this->_userid);
                }			
		}
}