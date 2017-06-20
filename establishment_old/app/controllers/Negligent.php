<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Negligent extends CI_Controller {

    private $_negligent_order;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_negligent_order = $this->db->dbprefix('negligent_order');
			 
			 $id  = (int) $this->session->userdata('id');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function index()
		{
			$this->form_validation->set_rules('customer_name', 'Customer name', 'required');
			$this->form_validation->set_rules('order_id', 'Order id', 'required|callback_order_id_check');
			$this->form_validation->set_rules('reason', 'Reason', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('negligent/negligent');
                }
            else
                {
                    $this->negligentmodel->addNegligent();
                }			
		}
		
	public function order_id_check($order_id = '')
		{
			$numrows = (int) $this->db->get_where($this->_negligent_order, array('order_id' => $order_id))->num_rows();
			if ($numrows > 0)
                {
                        $this->form_validation->set_message('order_id_check', 'This order has been already negligent marked.');
                        return FALSE;
                }
            else
                {
                        return TRUE;
                }
		}

	public function view()
		{
			$data['negligent'] = $this->negligentmodel->all();
			$this->load->view('negligent/viewnegligent', $data);
		}
		
	public function filterNegligent()
		{
			$this->form_validation->set_rules('start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('end_date', 'End Date', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
					$data['negligent'] = $this->negligentmodel->all();
					$this->load->view('negligent/viewnegligent', $data);
                }
            else
                {
                    $data['negligent']  = $this->negligentmodel->filterNegligentMethod();
					$this->load->view('negligent/viewnegligent', $data);
                }
				
				
			
		}
}