<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thresholdmodel extends CI_Model {

    private $_threshold;
    private $_payment_method;
    private $_establishment;
	
    public function __construct()
		{
             parent::__construct();
			 $this->_threshold        			=   $this->db->dbprefix('threshold');
			 $this->_payment_method   			=   $this->db->dbprefix('payment_method');
			 $this->_last_order_notification    =   $this->db->dbprefix('last_order_notification');
			 $this->_establishment              =   $this->db->dbprefix('establishment');
		}
		
	public function updateNotificationData($userid = '')
		{
			$estabid  				          =   getEstablishmentIdByUserId($userid);
			
			$data['notifiy_hr_last_order'] 	  =   $this->input->post('notification_before_hr');	
			
			
			$flag                             =   $this->input->post('method');	
			
			if ($flag == 1)
			$data['notifiy_hr_last_order'] 	  =   $this->input->post('notification_before_hr');
				else
			$data['notifiy_hr_last_order'] 	  =   '';
		
			
			$data['flag']                     =   $this->input->post('method');	
			
			$last_order_hr                    =   $this->input->post('last_order_hr');	
			$last_order_min                   =   $this->input->post('last_order_min');	
			
			$data['last_order_timing']        =   $last_order_hr . ':' . $last_order_min;
			$data['ttime']                    =   time();
			
			$num_rows = (int) $this->db->get_where($this->_last_order_notification, array('estabid' => $estabid))->num_rows();
			if ($num_rows > 0)
				{
					$this->db->where('estabid', $estabid)->update($this->_last_order_notification, $data);
				}
		    else
				{
					$data['estabid'] 	      =   $estabid;
					$this->db->insert($this->_last_order_notification, $data);
				}
				    $this->session->set_flashdata('updt', 'updt');
				    redirect('payment/lastordernotification');
		}
		
		
		
		
	public function	getNotificationData($userid = '')
		{
			$estabid  =   getEstablishmentIdByUserId($userid);
			return $this->db->get_where($this->_last_order_notification, array('estabid' => $estabid))->row();
		}
		
		
		
	public function updateThreshold()
		{ 
			$data['value']  =   $this->input->get('value');
			$eid       		=   1;//$this->input->post('eid');
			$num_rows  		=   (int) $this->db->get_where($this->_threshold, array('eid' => $eid))->num_rows();
			
			if ($num_rows > 0)
				{
					$this->db->where('eid', $eid);
					$this->db->update($this->_threshold, $data);
				}
			else
				{
					$data['eid']   =   $eid;
					$this->db->insert($this->_threshold, $data);
				}
				    return $this->db->affected_rows();
		}
		
		
		
	public function savePaymentMethod($userid = '')
		{
			$this->db->where(array('userid' => $userid));
			$this->db->delete($this->_payment_method);
			
			$estabid    =   getEstablishmentIdByUserId($userid);
			
			$values 	=   $this->input->get('value');
			$exparr     =   explode('-', $values);
			$arr    	=   implode (',', $exparr);
			
			$data['branch_id']         = 	$estabid;
			$data['userid']            = 	$userid;
			$data['payment_method']    = 	$arr;
			$data['info']              = 	$this->input->get('info');
			
			$this->db->insert($this->_payment_method, $data);
			
			if (in_array(3, $exparr)) {
				
				
				$name     =   $this->db->select('name')->where('id', $estabid)->get($this->_establishment)->row()->name;
				
				$this->load->library('email');
				$this->email->from('no-reply@xlimtest1.com', 'xlimtest');
				$this->email->to('info@afewtaps.com');
				$this->email->subject('Payment');
				$this->email->message("$name select a online payment method in dashobard");
				$this->email->send();
				
            }
			
				return  json_encode(array('status' => 'success'));
				
		}
		
	public function getPaymentMethod($userid = '')
		{
			return $this->db->get_where($this->_payment_method, array('userid' => $userid))->row();
		}
		
}
