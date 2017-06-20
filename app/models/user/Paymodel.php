<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymodel extends CI_Model {

    private $_order;
    private $_accounts;
    private $_establishment;
	
    public function __construct()
		{
            parent::__construct();	
			
			$this->_order         				  =      $this->db->dbprefix('order');
			$this->_accounts      				  =      $this->db->dbprefix('accounts');
			$this->_staff_member      		      =      $this->db->dbprefix('staff_member');
			$this->_establishment      		      =      $this->db->dbprefix('establishment');
			$this->_folder_root	   			      =      $_SERVER['DOCUMENT_ROOT'].'/fewtaps/uploads/';	
		}
	
	public function paymentSuccessModule()
		{
			
			$this->load->library('email');
			$this->email->from('no-reply@xlimtest1.com', 'xlimtest');
			$this->email->to('tech1@xlim.org');
			$this->email->subject('data');
			$this->email->message(json_encode($_POST));
			$this->email->send();


			if (count($this->input->post()) > 0)
				{
					$customer_id       =  1;  //$this->input->post('customer_id');
					$establishment_id  =  3;  //$this->input->post('establishment_id');
					$amount            =  12; //$this->input->post('total_amount');
					//$orderid         =  $this->input->post('orderid');
					$contactno         =  1;  //$this->input->post('contactno');
					
					/* Save Order */
					$data['establishment_id'] 	= 	$establishment_id;
					$data['customer_id'] 		= 	$customer_id;
					$data['total_amount'] 		= 	$amount;
					$data['location'] 			= 	'f';//$this->input->post('location');
					$data['payment_method'] 	= 	1;//$this->input->post('payment_method');
					$data['status'] 			= 	1;
					$data['order_time'] 		= 	time();
					
					$this->db->insert($this->_order, $data);
					$orderid = $this->db->insert_id();
					
					/* New Orders Waiting for Acceptance STAFF APP */
					
					$start_time    =  	mktime(0,0,0, date('m'), date('d'), date('Y'));
					$end_time      =  	mktime(23,59,59, date('m'), date('d'), date('Y'));
					
					$this->db->limit(1);
					
					$this->db->order_by('order_id', 'desc');
					$qry = $this->db->select('staff_member_id')->get_where($this->_order, array('customer_id' => $customer_id, 'staff_member_id !=' => 0, 'order_time >=' => $start_time, 'order_time <=' => $end_time));
					
					$establishment_name = $this->db->select('name')->get_where($this->_establishment, array('id' => $establishment_id))->row()->name;
					
					if ($qry->num_rows() > 0)
						{
							$staff_member_id = $qry->row()->staff_member_id;
						
							$this->db->where('order_id', $orderid)->update($this->_order, array('staff_member_id' => $staff_member_id));
							
							//$device_token = $this->db->select('device_token')->get_where($this->_accounts, array('id' => $customer_id))->row()->device_token;
							
							$device_token = 'd5b0496d6f6e50c3bd29d87ca3ba2bd6c3c54e4ae9ba8f2db16d662ab4b1274b';
							require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Push.php');
						    Push::send_notification_ios(array($device_token), array('message' => "Your order for Rs. $amount, has been successfully communicated to your service employee at $establishment_name"));
							
							
							//$staff_device_token = $this->db->select('device_token')->get_where($this->_staff_member, array('id' => $staff_member_id))->row()->device_token; // Staff Member Token //
							
							$staff_device_token = 'APA91bEp8tYVI-A2GT_Xb81vF77WfIfPtNTQHbhhEd3ge-u0uvKs3MNWp2zgH98-cN_LCeMPXmzho_Sduhw6BOMgHLnyiHhUX0PrBMLPkBPiXQQlHPGZBrCfSSguwz-UVU7cTQFLKbvu'; //$this->db->select('device_token')->get_where($this->_staff_member, array('id' => $staff_member_id))->row()->device_token;
							
							require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
							$gcm  =  new Gcm();
							$gcm->sendNotification($staff_device_token, "New Order Accepted! Upon delivery, please mark the order as \"Complete\"&5&trail");
							
						}
					else
						{
							require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Sms.php');
							$msg = "You%20have%20placed%20your%20first%20order%20today%20at%20$establishment_name%20amounting%20to%20Rs.%20$amount.%20Kindly%20check%20%22My%20Orders%22%20for%20more%20information.";
							Sms::sendMessage($contactno, $msg);
							
							$this->db->select('device_token');
							$staff_qry = $this->db->get_where($this->_staff_member, array('branch_id' => $establishment_id, 'status' => 1));
							if ($staff_qry->num_rows() > 0)
								 {
									 require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
									 $gcm  =  new Gcm();
									 foreach ($staff_qry->result() as $sdata)
										 {
											 $sdevice_token = 'APA91bEp8tYVI-A2GT_Xb81vF77WfIfPtNTQHbhhEd3ge-u0uvKs3MNWp2zgH98-cN_LCeMPXmzho_Sduhw6BOMgHLnyiHhUX0PrBMLPkBPiXQQlHPGZBrCfSSguwz-UVU7cTQFLKbvu'; //$sdata->device_token;
											 $msg  =  "New Order! Waiting for acceptance...&orderid=$orderid";
											 $gcm->sendNotification($sdevice_token, $msg);
										 }
								 } 
						}
						
				}
				     return 1;
		}
}
