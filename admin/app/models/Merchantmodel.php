<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchantmodel extends CI_Model {

    private $_merchant_info;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_merchant_info   =   $this->db->dbprefix('merchant_info');
		}
		
	public function getMerchantInfo($id = '')
		{
			return $this->db->get_where($this->_merchant_info, array('id' => 1))->row();
		}
		
	public function addUpdateMerchantInfo($id = '')
		{
			$data['contact_person']    	  =  	$this->input->post('contact_person');
			$data['contact_no']    		  =  	$this->input->post('contact_no');
			$data['email']   	          =  	$this->input->post('emailid');
			$data['beneficiary_name']  	  =  	$this->input->post('beneficiary_name');
			$data['bank_name']  	      =  	$this->input->post('bank_name');
			$data['bank_ac_no']  	      =  	$this->input->post('bank_ac_no');
			$data['ifsc_swift_code']  	  =  	$this->input->post('ifsc_swift_code');
			$data['account_type']  	      =  	$this->input->post('acc_type');
			
			list($cmonth, $cdate, $cyear) =   explode ('/', $this->input->post('com_col_strt_dt'));
			
			$data['com_col_start_dt']     =  	mktime(0, 0, 0, $cmonth, $cdate, $cyear);
			
			$data['com_slab']  	          =  	$this->input->post('com_slab');
			$data['merchant_tan']  	      =  	$this->input->post('merchant_details');
			$data['tds_deducted']  	      =  	$this->input->post('tds_deducted');
			$data['payment_method']  	  =  	$this->input->post('payment_method');
			$data['rtime']  	          =  	time();
	
	        $num_rows  =  (int) $this->db->get_where($this->_merchant_info, array('userid' => $id))->num_rows();
			
			if ($num_rows > 0)
				{
					$this->db->where('userid', $id);
					$this->db->update($this->_merchant_info, $data);
					$this->session->set_flashdata('minfoupd', 'minfoupd');
				}
			else
			    {
					$data['userid']  	  =  	$id;
			        $this->db->insert($this->_merchant_info, $data);
					$this->session->set_flashdata('minfoadd', 'minfoadd');
			    }
				    
					
			        redirect('merchant/index');
		}
		
}
