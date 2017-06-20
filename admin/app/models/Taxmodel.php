<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taxmodel extends CI_Model {

    private $_tax;
	
    public function __construct()
		{
             parent::__construct();
			 $this->_tax   =   $this->db->dbprefix('tax');
		}
		
	public function all()
		{
			return $this->db->get($this->_tax)->result();
		}
		
	public function getTaxInfo($id = '')
		{
			return $this->db->get_where($this->_tax, array('id' => $id))->row();
		}
		
	public function addUpdateTax($id = '')
		{
			
			$data['tax_name']    	=  	$this->input->post('tax_name');
			$data['tax_rate']    	=  	$this->input->post('tax_rate');
			$data['apply_for']   	=  	implode (',', $this->input->post('tax_apply'));
			$data['status']  	    =  	$this->input->post('status');
	
			if ($id != FALSE)
				{
					$this->db->where('id', $id);
					$this->db->update($this->_tax, $data);
				}
			else
			    {
			        $this->db->insert($this->_tax, $data);
			    }
			        redirect('tax/view');
		}
	
	public function deleteTax($id = '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_tax);
			redirect('tax/view');
		}
		
}
