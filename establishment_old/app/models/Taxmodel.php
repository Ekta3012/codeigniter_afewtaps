<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taxmodel extends CI_Model {

    private $_tax;
	
	private $_userid;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_tax     =   $this->db->dbprefix('tax');
			 
			 $this->_userid  =   $this->session->userdata('id');
		}
		
	public function all($userid = '')
		{
			//$estabid  =   getEstablishmentIdByUserId($userid);
			//return $this->db->get_where($this->_tax, array('tax_applied_on !=' => '0', 'establishment_id' => $estabid ))->result();
			
			$estabid  =   getEstablishmentIdByUserId($userid);
			return $this->db->get_where($this->_tax, array('establishment_id' => $estabid, 'tax_index !=' => 0))->result();
		}
		
	public function getTaxInfo($id = '')
		{
			return $this->db->get_where($this->_tax, array('id' => $id))->row();
		}
		
	public function getServiceCharge($userid = '')
		{
			/*$establishment_id  =   getEstablishmentIdByUserId($userid);
			
			$query =  $this->db->select('tax_rate')->get_where($this->_tax, array('establishment_id' => $establishment_id, 'tax_applied_on' => '0'));
			if ($query->num_rows() > 0)
				return $query->row()->tax_rate;
			else
				return '';
			*/
			
			$establishment_id  =   getEstablishmentIdByUserId($userid);
			$query =  $this->db->select('tax_rate')->get_where($this->_tax, array('establishment_id' => $establishment_id, 'tax_index' => 0));
			if ($query->num_rows() > 0)
				return $query->row()->tax_rate;
			else
				return '';
		}	
		
		
	public function addUpdateServiceCharge($userid = '')
		{
			$establishment_id           =   getEstablishmentIdByUserId($userid);
			
			$data['tax_rate']    		=  	$this->input->post('service_charge');
			
			$num_rows  = (int) $this->db->where('establishment_id', $establishment_id)->get_where($this->_tax, array('tax_index' => 0))->num_rows();
			
			if ($num_rows > 0)
				{
					$this->db->where(array('establishment_id' => $establishment_id, 'tax_index' => 0))->update($this->_tax, $data);
					$this->session->set_flashdata('updtsc', 'updtsc');
				}
			else
				{
					$data['establishment_id']  = $establishment_id;
					$data['tax_index']         = 0;
					$data['ttime']             = time();
					$this->db->insert($this->_tax, $data);
				}
				    redirect('tax/view');		
		}
		
		
	/*public function addUpdateTax($userid = '', $id = '') // 20 jan 17
		{
			$establishment_id           =   getEstablishmentIdByUserId($userid);
			$data['establishment_id']   =  	$establishment_id;
			
			$data['tax_name']    		=  	$this->input->post('tax_name');
			$data['tax_rate']    		=  	$this->input->post('tax_rate');
			$tax_apply                  =   $this->input->post('tax_apply');
			$data['status']  	    	=  	$this->input->post('status');
			
			if ($id != '')
				{
					$this->db->where('id', $id)->update($this->_tax, $data);
				}
			else
				{
					$data['ctime'] = time();
					foreach ($tax_apply as $tdata)
						{
							$data['tax_applied_on'] = $tdata;
							$this->db->insert($this->_tax, $data);
						}
				}

			//if ($id == '')
			//$data['apply_for']   		=  	$tax_apply;
			
			/*$this->db->select('id');
			$qry                        =   $this->db->get_where($this->_tax, array('establishment_id' => $establishment_id, 'apply_for' => $tax_apply));
			
			if ($qry->num_rows() > 0)
				{
					$uid                =   $qry->row()->id;
					$this->db->where('id', $uid);
					$this->db->update($this->_tax, $data);
				}
	
			else if ($id != '')
				{
					$this->db->where('id', $id);
					$this->db->update($this->_tax, $data);
				}
			else
			    {
			        $this->db->insert($this->_tax, $data);
			    }
				
				
			        //redirect('tax/view');
		//}
	*/
	
	public function addUpdateTax($userid = '', $id = '')
		{
			$establishment_id           =   getEstablishmentIdByUserId($userid);
			$data['establishment_id']   =  	$establishment_id;
			
			$tax_index        		    =  	$this->input->post('tax_index');

			$data['tax_rate']    	    =  	$this->input->post('tax_rate');
			$data['status']  	    	=  	$this->input->post('status');
			$data['ttime']  	    	=  	time();
			
			$num_rows  = (int) $this->db->where(array('establishment_id' => $establishment_id, 'tax_index' => $tax_index))->get($this->_tax)->num_rows();
			
			if ($num_rows > 0)
				{
					$this->db->where(array('establishment_id' => $establishment_id, 'tax_index' => $tax_index))->update($this->_tax, $data);
				}
			else
				{
					$data['tax_index']  =  	$tax_index;
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
