<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Couponmodel extends CI_Model {

    private $_coupon;
    private $_category;
    private $_menu_category;
    private $_offer;
	
	const BEVERAGES = 2 ;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_coupon           =   $this->db->dbprefix('coupon');
			 $this->_category         =   $this->db->dbprefix('category');
			 $this->_menu_category    =   $this->db->dbprefix('menu_category');
			 $this->_offer            =   $this->db->dbprefix('offer');
		}
		
	public function getBeverages($userid = '')
		{
			$this->db->select($this->_category.'.id as cid, '. $this->_category.'.category_name');
			$this->db->where($this->_menu_category.'.user_id', $userid);
			$this->db->where($this->_menu_category.'.main_category', self::BEVERAGES);
			$this->db->from($this->_menu_category);
			$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
			return $this->db->get()->result();
		}
		
	public function all($userid = '')
		{
			$estabid  =   getEstablishmentIdByUserId($userid);
			return $this->db->get_where($this->_coupon, array('estabid' => $estabid))->result();
		}
		
	public function viewOffer($userid = '')
		{
			$estabid  =   getEstablishmentIdByUserId($userid);

			$this->db->select($this->_category.'.category_name as cname, '.$this->_offer.'.valid_till, '.$this->_offer.'.id, '.$this->_offer.'.ostatus');
			$this->db->where($this->_offer.'.estabid', $estabid);
			$this->db->from($this->_offer);
			$this->db->join($this->_category, "$this->_category.id = $this->_offer.category_id");
			return $this->db->get()->result();
		}
		
	public function getCouponInfo($id = '')
		{
			return $this->db->get_where($this->_coupon, array('id' => $id))->row();
		}
		
	public function  getOfferInfo($userid = '', $id = '')
		{
			$estabid  =   getEstablishmentIdByUserId($userid);
			$this->db->select($this->_category.'.category_name as cname, '.$this->_offer.'.valid_till, '.$this->_offer.'.ostatus, '.$this->_offer.'.id, '.$this->_offer.'.category_id');
			$this->db->where($this->_offer.'.estabid', $estabid);
			$this->db->where($this->_offer.'.id', $id);
			$this->db->from($this->_offer);
			$this->db->join($this->_category, "$this->_category.id = $this->_offer.category_id");
			return $this->db->get()->row();
		}
		
	public function addUpdateCoupon($userid = '', $id = '')
		{
			$data['estabid']                =   getEstablishmentIdByUserId($userid);
			//$data['code']           		= 	$this->input->post('coupon_code');
			
			$data['off']       	            =  	$this->input->post('off');
			$data['min_amt']       	        =  	$this->input->post('min_amt');
			list($sdate, $smonth, $syear)   =   explode ('/', $this->input->post('valid_till_date'));
			
			$data['valid_till']       		=  	mktime(23, 59, 59, $smonth, $sdate, $syear);
			
			$data['rtime']   	    		=  	time();
	
			$data['status']  	    		=  	$this->input->post('cstatus');
	
			if ($id != '')
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
		
	public function addUpdateDrinksCoupon($userid = '', $id = '')
		{
			$estabid      =   getEstablishmentIdByUserId($userid);
            $category     =   $this->input->post('drinks');
			foreach ($category as $cdata)
				{
					$data['estabid']      =  $estabid;
					$data['category_id']  =  $cdata;
					list($sdate, $smonth, $syear)   =   explode ('/', $this->input->post('valid_till'));
					$data['valid_till']   =  mktime (23, 59, 59, $smonth, $sdate, $syear);
					$data['ttime']        =  time();
					$data['ostatus']      =  $this->input->post('ostatus');
					if ($id != '')
						{
						    $this->db->where('id', $id)->update($this->_offer, $data);
						}
					else
					        $this->db->insert($this->_offer, $data);
				}
					redirect('coupon/view');
		}
	
	public function deleteCoupon($id = '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_coupon);
			redirect('coupon/view');
		}
		
	public function offerDelModule($id = '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_offer);
			redirect('coupon/view');
		}
		
		
		
}
