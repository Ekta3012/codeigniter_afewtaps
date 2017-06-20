<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends CI_Controller {

    public function __construct()
		{
             parent::__construct();
			 $id  = (int) $this->session->userdata('adminid');
			 if ($id === 0)
			 redirect(base_url());
		}
		
	public function index($id = '')
		{			
			$this->form_validation->set_rules('coupon_code', 'Coupon Code',  'trim|required');
			$this->form_validation->set_rules('discount', 'Discount', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start Date',  'trim|required');
			$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			$data['info']  = array();
			
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info'] = $this->couponmodel->getCouponInfo($id);
				
                    $this->load->view('coupon/coupon', $data);
                }
            else
                {
                    $this->couponmodel->addUpdateCoupon($id);
                }			
		}
		
	public function view()
		{
			$data['coupon'] = $this->couponmodel->all();
			$this->load->view('coupon/viewcoupon', $data);
		}
		
	public function del($id = '')
		{
			$this->couponmodel->deleteCoupon($id);
		}
}