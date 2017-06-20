<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Negligentmodel extends CI_Model {

    private $_tax;
	
    public function __construct()
		{
             parent::__construct();
			 $this->_orders   =   $this->db->dbprefix('orders');
		}
		
	public function all()
		{
			return $this->db->get($this->_orders)->result();
		}
		
	public function addNegligent()
		{
			$data['id']    			=  	$this->input->post('orderid');
			$data['status']  	    =  	$this->input->post('status');
			$this->db->insert($this->_orders, $data);
		}
		
}
