<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends CI_Controller {

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
            $type = $this->input->post('type');	
			
			if ($type == 1)
				{
					//$this->form_validation->set_rules('coupon_code', 'Coupon Code',  'trim|required');
					$this->form_validation->set_rules('off', 'Discount', 'trim|required');
					$this->form_validation->set_rules('valid_till_date', 'Valid Till Date',  'trim|required');
				}
			else
				{
					if (count($this->input->post('drinks')) == 0)
					$this->form_validation->set_rules('drinks', 'Drinks',  'trim|required');
				
				    $this->form_validation->set_rules('valid_till', 'Valid till',  'trim|required');
			
				}
					$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
					$data['info']  = array();
					
					if ($this->form_validation->run() == FALSE)
						{
							if ($id != '')
							$data['info'] = $this->couponmodel->getCouponInfo($id);

							$data['beverages'] = $this->couponmodel->getBeverages($this->_userid);
							
							$data['type'] = $type;
							
							$data['coupon'] = 1;
							
							if ($id != '')
							$data['offer']  = 0;
						else
							$data['offer']  = 1;
						
							$this->load->view('coupon/coupon', $data);
						}
					else
						{
							if ($type == 1)
							$this->couponmodel->addUpdateCoupon($this->_userid, $id);
								else
							$this->couponmodel->addUpdateDrinksCoupon($this->_userid, $id);
						}			
		}
		
	public function editCoupon($id = '')
		{	  
		      $data['coupon'] = 1;
		      $data['offer']  = 0;
			  $data['info']   = $this->couponmodel->getCouponInfo($id);
			  $this->load->view('coupon/coupon', $data);			
		}
		
	public function editOffer($id = '')
		{
			  $coupon       =  0;
			  $offer        =  1;
			  $type         =  2;
			  
			  $beverages   =  $this->couponmodel->getBeverages($this->_userid);
			  $info        =  $this->couponmodel->getOfferInfo($this->_userid, $id);
			  $this->load->view('coupon/coupon', compact('coupon', 'offer', 'beverages', 'info', 'type'));			
		}
		
		
	public function view()
		{
			$coupon = $this->couponmodel->all($this->_userid);
			$offer  = $this->couponmodel->viewOffer($this->_userid);
			$this->load->view('coupon/viewcoupon', compact('coupon', 'offer'));
		}
	
	
	public function offerdel($id = '')
		{
			$this->couponmodel->offerDelModule($id);
		}
		
	public function del($id = '')
		{
			$this->couponmodel->deleteCoupon($id);
		}
}