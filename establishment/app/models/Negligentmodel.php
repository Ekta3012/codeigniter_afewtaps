<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Negligentmodel extends CI_Model {

    private $_order;
    private $_negligent_order;
    private $_accounts;
    private $_order_cancel_reason;
	
    public function __construct()
		{
             parent::__construct();
			 $this->_order   		   		=   $this->db->dbprefix('order');
			 $this->_negligent_order   		=   $this->db->dbprefix('negligent_order');
			 $this->_accounts             		=   $this->db->dbprefix('accounts');
			 $this->_order_cancel_reason    =   $this->db->dbprefix('order_cancel_reason');
		}
		
	public function all()
		{
			$this->db->select($this->_negligent_order.'.message, '.$this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_accounts.'.name, '.$this->_accounts.'.email, '.$this->_accounts.'.contactno, '.$this->_order.'.staff_member_id');
			
			$this->db->from($this->_negligent_order);
			$this->db->join($this->_order, "$this->_order.order_id = $this->_negligent_order.order_id");
			$this->db->join($this->_accounts, "$this->_accounts.id = $this->_order.customer_id");
			
			return $this->db->get()->result();
			
		}
		
	public function addNegligent()
		{
			$order_id   =  	$this->input->post('order_id');
			$result     =   $this->db->get_where($this->_order, array('order_id' => $order_id, 'status !=' => 4));
			if ($result->num_rows() > 0)
				{
					$customer_id  	   =   $result->row()->customer_id;
					$data['order_id']  =   $order_id;
					$data['message']   =   $this->input->post('reason');
					$data['ctime']     =   time();
					$this->db->insert($this->_negligent_order, $data);
					
					$this->session->set_flashdata('negligent_order', 'negligent_order');
				}
			else
				{
					$this->session->set_flashdata('negligent_order_fail', 'negligent_order_fail');
				}
			
					redirect('negligent/index');
		}
		
	public function filterNegligentMethod()
		{
			$startdate  	=  $this->input->post('start_date');
			$enddate    	=  $this->input->post('end_date');
			list ($startmonth, $startday, $startyear)   =   explode ('/', $startdate);
			$startmktime 	=  mktime (0, 0, 0, $startmonth, $startday, $startyear);
			list ($endmonth, $endday, $endyear) 		=    explode ('/', $enddate);
			$endmktime   	=  mktime (23, 59, 59, $endmonth, $endday, $endyear);
			
			$this->db->select($this->_negligent_order.'.message, '.$this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_accounts.'.name, '.$this->_accounts.'.email, '.$this->_accounts.'.contactno, '.$this->_order.'.staff_member_id');
			$this->db->where(array($this->_order.'.order_time >=' => $startmktime, $this->_order.'.order_time <=' => $endmktime));
			$this->db->from($this->_negligent_order);
			$this->db->join($this->_order, "$this->_order.order_id = $this->_negligent_order.order_id");
			$this->db->join($this->_accounts, "$this->_accounts.id = $this->_order.customer_id");
			return $this->db->get()->result();
			
		}	
		
		
}
