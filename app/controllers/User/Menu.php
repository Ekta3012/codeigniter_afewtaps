<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    private $_order;
	private $_staff_member;
	private $_order_notification;
	private $_webhook_payment;
	
    public function __construct()
		{
				parent::__construct();
				
				$this->_order               =      $this->db->dbprefix('order');
			    $this->_staff_member        =      $this->db->dbprefix('staff_member');
			    $this->_order_notification  =      $this->db->dbprefix('order_notification');
			    $this->_webhook_payment     =      $this->db->dbprefix('webhook_payment');
				
		}
		
	public function dontAskNudge()
		{	
			    header('Content-Type: application/json');
				$info = $this->menumodel->dontAskNudgeModule();
				echo json_encode(array('response' => $info), JSON_PRETTY_PRINT);
		}	
		
	public function lastOrderNotify()
		{	
			    header('Content-Type: application/json');
				$info = $this->menumodel->lastOrderNotifyModule();
				echo json_encode(array('response' => $info), JSON_PRETTY_PRINT);
		}	
		
	public function repeatOrder()
		{	
			    header('Content-Type: application/json');
				$info = $this->menumodel->repeatOrderModule();
				echo json_encode(array('response' => $info), JSON_PRETTY_PRINT);
		}	
		
		
	public function codPaymentMethod()
		{						 								 
			    header('Content-Type: application/json');
				$info = $this->menumodel->codPaymentModule();
				echo json_encode(array('response' => $info), JSON_PRETTY_PRINT);
		}
		
	public function getEstabMenuItems()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->getMenuItemsModule();
			echo json_encode(array('result' => $info));
		}
		
	public function takeOrder()
		{
			header('Content-Type: application/json');
			$info = $this->servicemodel->takeOrderModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function nudgeOrder()
		{
			header('Content-Type: application/json');
			$info = $this->servicemodel->nudgeOrderModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
		
	public function nudgeOrderDemo($orderid = '') // demo url  for testing //
		{
			 $this->db->select($this->_staff_member.'.name, '.$this->_staff_member.'.device_token, '.$this->_order.'.status, '.$this->_order.'.staff_member_id');				
			 $this->db->where(array($this->_order.'.order_id' => $orderid, $this->_order.'.status !=' => 3));
			 $this->db->from($this->_order);
			 $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
			 $staff_info = $this->db->get();
			 if ($staff_info->num_rows() > 0)
				{
					 $data                   =   $staff_info->row();
					 $staff_member_name      =   $data->name;
					 $staff_member_token     =   $data->device_token;
					 $order_status           =   $data->status;
					 if ($order_status != 5)
					  {
						  $this->db->where('order_id', $orderid)->update($this->_order, array('status' => 2));
						  require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
						  $gcm  =  new Gcm();
						  $msg  =  "This is a reminder from the customer for Order #$orderid. Please keep it under priority.&orderid=$orderid";
						  
						  $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'serverid' => $data->staff_member_id, 'notification' => "This is a reminder from the customer for Order #$orderid. Please keep it under priority.", 'ttime' => time(), 'notify_status' => 1, 'flag' => 2));
						  
						  $gcm->sendNotification($staff_member_token, $msg);
					  }
				}
		}
		
	
	public function userOrderCancel()
		{
				header('Content-Type: application/json');
				$info =  $this->menumodel->userOrderCancelModule();
				echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
		
	public function filterEstablishment()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->filterEstablishmentModule1();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function foodItems()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->getFoodItems();
			echo json_encode(array('response' => 'success', 'result' => $info), JSON_PRETTY_PRINT);
		}
		
		
	public function drinkItems()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->getDrinksItems();
			echo json_encode(array('response' => 'success', 'result' => $info), JSON_PRETTY_PRINT);
		}
		
    public function myOrders()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->getMyOrders1();
			echo json_encode(array('result' => array("response" => $info)), JSON_PRETTY_PRINT);
		}
		
	public function locality()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->saveLocality();
			echo json_encode(array('locality' => $info), JSON_PRETTY_PRINT);
		}
		
	public function viewLocality()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->viewLocalityModule();
			echo json_encode(array('locality' => $info), JSON_PRETTY_PRINT);
		}
		
	public function estabMenuItems()
		{
			header('Content-Type: application/json');
			$menu = $this->menumodel->estabMenuItemModule();
			echo json_encode(array('menu' => $menu), JSON_PRETTY_PRINT);
		}
		
		
	public function d()
	    {
			require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
			$gcm  =  new Gcm();
			$msg  =  'Order Cancel';
			Gcm::sendNotification(); 
			
			// die();
		
			$order_id = 1;
		
		    $this->db->where(array('order_id' => $order_id, 'status !=' => 3));
			$query = $this->db->get($this->_order);
			if ($query->num_rows() > 0)
				   {
						 $this->db->where('order_id', $order_id);
						 $this->db->update($this->_order, array('status' => 4, 'cancel_time' => time()));
					 
						 /* Send Order Cancel Notification to Server */
						 
						 $this->db->select($this->_staff_member.".device_token");
						 $this->db->where($this->_order.'.order_id', $order_id);
						 $this->db->from($this->_order);
						 $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
						 $result = $this->db->get()->row();
						 
						 //echo $result->device_token; die();
						 
						 require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
						 $gcm  =  new Gcm();
						 $msg  =  'Message1';
						 $gcm->sendNotification($rdata->gcm_reg_id, $msg);	
					 
					     /* Close */

						 if ($this->db->affected_rows() > 0)
							$response = array('status' => 'true', 'msg' => 'Success');
						 else
							$response = array('status' => 'false', 'msg' => 'Server Error');
				   }
	}
	
	public function orderHistory()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->orderHistoryModule();
			echo json_encode(array('result' => array("response" => $info)), JSON_PRETTY_PRINT);
		}
		
	public function userRating()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->userRatingModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function estabReply()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->estabReplyModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function userRatingAnswer()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->userRatingAnswerModule();
			echo json_encode(array('result' => (string) $info), JSON_PRETTY_PRINT);
		}
		
	public function getTax()
		{						
			header('Content-Type: application/json');
			$info = $this->menumodel->getTaxModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function orderServingDetail()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->orderServingModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
		
	public function orderReviewComment()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->orderReviewCommentModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function regularOrderCustomization()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->regularOrderCustomizationModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function couponEstab()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->couponEstabModule();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function payment()
		{
			    require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Instamojo.php');
				
				$insta_object = new instamojo('6995a705d0daccfa5ba676ab5d97726e', '6ce8843c6f0b9f35f378fe554b0e26cd');
				
				$payload['amount']  	              =   '10';
				$payload['purpose'] 	              =   'Fewtp';
				
				$payload['buyer_name']                =   'tech1';
				$payload['email']  		              =   'tech1@xlim.org';
				$payload['phone']  		              =   '9999999999';
				$payload['redirect_url']              =   'http://xlimtest1.com/fewtaps/index.php/payredirect';
				
				$payload['webhook']       			  =   'http://xlimtest1.com/fewtaps/index.php/paywebhook';
				$payload['allow_repeated_payments']   =    false;
				
				$payload['partner_fee_type']          =    'fixed';
				$payload['partner_fee']               =    1.00;
				
				$payload['send_email']                =    true;
				$payload['send_sms']                  =    true;
				
			    //	$payload  = array('purpose' => 'FIFA 16', 'amount' => '2500', 'buyer_name' => 'John Doe', 'email' => 'foo@example.com', 'phone' => '9999999999', 'direct_url' => 'http://www.example.com/redirect/', 'send_email' => 'True', 'send_sms' => 'True', 'webhook' => 'http://www.example.com/webhook/', 'allow_repeated_payments' => 'False');
				
				$response = $insta_object->api_call('POST', 'payment-requests', $payload); 
				
				print_r($response);
				
				$data['long_url'] = $response['payment_request']['longurl'];
				
				//print_r($data); die();
				
				$this->load->view('insta_mojo', $data);
				
		}
		
	public function payredirect()
		{
				$this->load->library('email');
				$this->email->from('no-reply@xlimtest1.com', 'xlimtest');
				$this->email->to('tech1@xlim.org, appsdev3@xlim.org');
				$this->email->subject('direct:');
				$this->email->message(json_encode($_REQUEST));
				$this->email->send();
		}
		
	public function paywebhook()
		{
				if (count($this->input->post()) > 0)
					{
						$data = array();
						foreach ($_POST as $key => $value)
							{
								$data[$key] = $value;
							}
							    $data['ttime'] = time();
								
						$this->db->insert($this->_webhook_payment, $data);
					}
					
					
					$this->load->library('email');
				$this->email->from('no-reply@xlimtest1.com', 'xlimtest');
				$this->email->to('tech1@xlim.org, appsdev3@xlim.org');
				$this->email->subject('direct:');
				$this->email->message(json_encode($_REQUEST));
				$this->email->send();
				
				
		}
		
		

}