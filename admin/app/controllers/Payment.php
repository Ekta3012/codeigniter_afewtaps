<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 
			 $id  = (int) $this->session->userdata('adminid');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function index($establid = '')
		{
			$this->load->model('paymentmodel');
			$this->form_validation->set_rules('start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('end_date', 'End Date', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['estab']   = $this->paymentmodel->establishmentList();
            if ($this->form_validation->run() == FALSE)
                {
					$data['payment'] = $this->paymentmodel->all($establid);
					$this->load->view('payment/viewsettlement',$data);
                }
            else
                {
                    $data['payment']  = $this->paymentmodel->paymentsettlmnt($establid);
					$this->load->view('payment/viewsettlement',$data);
                }
				
			
		}
}