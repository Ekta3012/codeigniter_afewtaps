<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemodel extends CI_Model {

    private $_payment_method;
    private $_estab_location;
	
    public function __construct()
		{
            parent::__construct();
			 
			$this->_payment_method   =   $this->db->dbprefix('payment_method');
			$this->_estab_location   =   $this->db->dbprefix('estab_location');
			
		}
		
	public function getPaymentAndLocationsData($branchid = '')
		{
			$this->db->select('payment_method, info');
			$this->db->where('branch_id', $branchid);
			$query = $this->db->get($this->_payment_method);
			if ($query->num_rows() > 0)
				{
					$result  			= 	$query->row();
					$data['payment'] 	= 	$result->payment_method;
				}
			else
				{
					$data['payment']    =   '';						
				}
				
			$this->db->select('id, location');
			$this->db->where('branch_id', $branchid);
			$data['location'] = $this->db->get($this->_estab_location)->result();
			return $data;
		}
		
	public function getMenuItemTaxes($category_id = '')
		{
			    
		}
		
}
