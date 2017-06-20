<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Couponmodel extends CI_Model {

    private $_coupon;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_coupon   =   $this->db->dbprefix('coupon');
		}
		
	public function all()
		{
			return $this->db->get($this->_coupon)->result();
		}
		
	public function getCouponInfo($id = '')
		{
			return $this->db->get_where($this->_coupon, array('id' => $id))->row();
		}
		
	public function addUpdateCoupon($id = '')
		{
			$data['code']           		=	$this->input->post('coupon_code');
			$data['type']           		=  	$this->input->post('type');
			$data['discount']       		=  	$this->input->post('discount');
			list($smonth, $sdate, $syear)   =   explode ('/', $this->input->post('start_date'));
			
			$data['sdate']       			=  	mktime(0, 0, 0, $smonth, $sdate, $syear);
			
			list($emonth, $edate, $eyear)   =   explode ('/', $this->input->post('end_date'));
			
			$data['edate']   	    		=  	mktime(0, 0, 0, $emonth, $edate, $eyear);
			$data['rtime']   	    		=  	time();
			$data['status']  	    		=  	$this->input->post('status');
	
			if ($id != FALSE)
				{
					$this->db->where('id', $id);
					$this->db->update($this->_coupon, $data);
				}
			else
			    {
			        $this->db->insert($this->_coupon, $data);
			    }
			        redirect('coupon/view');
		}
	
	public function deleteCoupon($id = '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_coupon);
			redirect('coupon/view');
		}
		
}
