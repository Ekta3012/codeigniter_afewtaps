<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menumodel extends CI_Model {

    private $_category;
	private $_menu_category;
	private $_menu_items;
	private $_staff_member;
	private $_branch_menu;
	private $_menu_customization_type;
	private $_menu_customization_options;
	private $_coupon;
	private $_order;
	private $_estab_location;
	private $_payment_method;
	
	private $_order_menu_id;
	private $_order_menu_customization_type;
	private $_order_menu_customization_options;
	private $_order_notification;
	
	private $_establishment;
	private $_locality;
	private $_estab_rating;
	private $_order_cancel_reason;
	private $_tax;
	
	private $_order_comment;
	
	private $_restaurants_floor;
	private $_restaurants_location;
	
	private $_offer;
	private $_merchant_estab;
	private $_accounts;
	private $_feedback;
	
	private $_last_order_notify;
	private $_estab_outlet_timing;
	
	private $_dont_ask_nudge;
	private $_merchant_info;
	private $_account;
	
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_category                      		=      $this->db->dbprefix('category'); 
			 $this->_menu_category                 		=      $this->db->dbprefix('menu_category');
			 $this->_menu_items                    		=      $this->db->dbprefix('menu_items');
			 $this->_branch_menu                   		=      $this->db->dbprefix('branch_menu');
			 $this->_menu_customization_type       		=      $this->db->dbprefix('menu_customization_type');
			 $this->_menu_customization_options    		=      $this->db->dbprefix('menu_customization_options');
			 $this->_coupon                        		=      $this->db->dbprefix('coupon');
			 $this->_order                        		=      $this->db->dbprefix('order');
			 $this->_estab_location                		=      $this->db->dbprefix('estab_location');
			 $this->_payment_method                		=      $this->db->dbprefix('payment_method');
			 $this->_staff_member                  		=      $this->db->dbprefix('staff_member');
			 $this->_order_menu_id                      =      $this->db->dbprefix('order_menu_id');
			 $this->_order_menu_customization_type      =      $this->db->dbprefix('order_menu_customization_type');
			 $this->_order_menu_customization_options   =      $this->db->dbprefix('order_menu_customization_options');
			 $this->_order_notification                 =      $this->db->dbprefix('order_notification');
			 $this->_establishment                      =      $this->db->dbprefix('establishment');
			 $this->_locality                           =      $this->db->dbprefix('locality');
			 $this->_user_locality                      =      $this->db->dbprefix('user_locality');
			 $this->_estab_rating                       =      $this->db->dbprefix('estab_rating');
			 $this->_order_cancel_reason                =      $this->db->dbprefix('order_cancel_reason');
			 $this->_tax                                =      $this->db->dbprefix('tax');
			 
			 $this->_cinema_audi                        =      $this->db->dbprefix('cinema_audi');
			 $this->_cinema_rows                        =      $this->db->dbprefix('cinema_rows');
			 $this->_cinema_seats                       =      $this->db->dbprefix('cinema_seats');
			 $this->_order_comment                      =      $this->db->dbprefix('order_comment');
			 
			 $this->_restaurants_floor                  =      $this->db->dbprefix('restaurants_floor');
			 $this->_restaurants_location               =      $this->db->dbprefix('restaurants_location');
			 $this->_offer                              =      $this->db->dbprefix('offer');
			 $this->_merchant_estab                     =      $this->db->dbprefix('merchant_estab');
			 $this->_accounts                           =      $this->db->dbprefix('accounts');
			 $this->_feedback                           =      $this->db->dbprefix('feedback');
			 
			 $this->_last_order_notify                  =      $this->db->dbprefix('last_order_notify');
			 $this->_negligent_order                    =      $this->db->dbprefix('negligent_order');
			 
			 $this->_estab_outlet_timing                =      $this->db->dbprefix('estab_outlet_timing');
			 
			 $this->_dont_ask_nudge                     =      $this->db->dbprefix('dont_ask_nudge');
			 $this->_merchant_info                      =      $this->db->dbprefix('merchant_info');
			 $this->_account                            =      $this->db->dbprefix('account');
		}
		
	public function dontAskNudgeModule()
		{
			if (count($this->input->post()) > 0)
			    {		
				      $id    =  (int) $this->input->post('userid');
					  $this->db->insert($this->_dont_ask_nudge, array('userid' => $id));
					  return 1;
				}
				      return 0;
		}
			
	
	public function lastOrderNotifyModule()
		{
			 if (count($this->input->post()) > 0)
			    {		
				      $id    =  (int) $this->input->post('notify_id');
					  $this->db->where('id', $id)->update($this->_last_order_notify, array('notify' => 1));
					  return $this->db->affected_rows();
				}
				      return 0;
		}
		
		
	public function repeatOrderModule()
		{
			$info  =  "";
		    if (count($this->input->post()) > 0)
			    {		
				   $order_id    =  (int) $this->input->post('orderid');
				   $query       =  $this->db->get_where($this->_order, array('order_id' => $order_id));
				   if ($query->num_rows() > 0)
				    	{
							/* Coupon and Offer */
							
							$code = '';
							$time = time();
							$code_qry = $this->db->get_where($this->_coupon, array('estabid' => $result_data->id, 'status' => 1, 'valid_till >=' => $time));
							$code     = ($code_qry->num_rows() > 0) ? $code_qry->row()->off : '';
							if (empty($code))
								{
									$code_qry = $this->db->get_where($this->_offer, array('estabid' => $result_data->id, 'ostatus' => 1, 'valid_till >=' => $time));
									if ($code_qry->num_rows() > 0)
										{
											$result_obj = $code_qry->row();
											$category_name = $this->db->select('category_name')->get_where($this->_category, array('id' => $result_obj->category_id))->row()->category_name;
											$code = "1+1 on $category_name";
										}
								}		
			
										
							$sdata = $query->row();
							
							$this->db->select('menu_id, qty');
							$res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $order_id));
							$menu_item_array = array();
							foreach ($res_query->result() as $mid)
								{   
									$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
									
									$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id, '.$this->_menu_customization_type.'.customization_type');
								
									$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
									
									$this->db->where($this->_order_menu_customization_type.'.order_id', $order_id);
								
								    $this->db->from($this->_order_menu_customization_type);
								
								    $this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.id = $this->_order_menu_customization_type.customization_type_id");
									
									//$this->db->from($this->_menu_customization_type);
									//$this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");	
									
									$res = $this->db->get();
									
									$customization_count = (int) $res->num_rows();
									
									if ($customization_count > 0)
										{
											$options  = array();
											foreach ($res->result() as $rdata)
												{	
													$options['name']                 =  $rdata->customization_name;
													$options['customization_type']   =  $rdata->customization_type;

													$this->db->select('id, customization_type_id, option_name, price');
													$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
													if ($opt_query->num_rows() > 0)
														{
															foreach ($opt_query->result() as $odata)
																{
																	$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
																}
														 }
												}
												
												$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $options, 'offer' => $code);
										}
									else
										   {
												$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array(),'offer' => $code);
										   }
								}
												$info =  array('orderid' => $order_id, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'menu' => $menu_item_array);    												
						}									
				}
												return $info;
		}
		
		
		
	public function getTaxModule()
		{
			$result   = array();
			if (count($this->input->post()) > 0)
				{
					$estabid    =  $this->input->post('estabid');
					$result_qry =  $this->db->get_where($this->_tax, array('establishment_id' => $estabid, 'status' => 1));
					if ($result_qry->num_rows() > 0)
						{ 
							 foreach ($result_qry->result() as $res)
								 {
									  $result['tax'][$res->tax_applied_on] = array('name' => $res->tax_name, 'rate' => $res->tax_rate);
								 }
								 
								 $start_time   =  mktime (0, 0, 0, date('m'), date('d'), date('Y'));
								 $end_time     =  mktime (23, 59, 59, date('m'), date('d'), date('Y'));
								 
								 //$coupon_qry = $this->db->get_where($this->_coupon, array('estabid' => $estabid, 'status' => 1, 'valid_till >=' => $start_time, 'valid_till <=' => $end_time));
								 
								 $time = time();
								 $coupon_qry = $this->db->get_where($this->_coupon, array('estabid' => $estabid, 'status' => 1, 'valid_till >=' => $time));
								 
								 if ($coupon_qry->num_rows() > 0)
								    {
									    $coupon_data      =  $coupon_qry->row();
										$result['coupon'] =  array('off' => $coupon_data->off, 'min_amt' => $coupon_data->min_amt, 'valid_till' => date('d/m/y', $coupon_data->valid_till));
								    }
								else
									{
										$result['coupon'] = array();
									}
									
								$offer_qry = $this->db->get_where($this->_offer, array('estabid' => $estabid, 'valid_till >=' => $time));
								
								if ($offer_qry->num_rows() > 0)
								    {
										$res = array();
										foreach ($offer_qry->result() as $offer_data)
										$res[] =  array('cid' => $offer_data->category_id, 'valid_till' => date('d/m/y', $offer_data->valid_till));
										$result['offer'] = $res;
								    }
								else
									{
										$result['offer'] = array();
									}
						}
				}
										return $result;
		}
		
	public function codPaymentModule()
		{			
			if (count($this->input->post()) >= 0)
				    {
				        if ( empty($this->input->get('type')))
							{
								    $establishment_id  =  $this->input->post('establishment_id');
									$customer_id       =  $this->input->post('customer_id');
									$location          =  $this->input->post('location');
									$menu_items        =  json_decode($this->input->post('selectedItemList'));
									$order_time        =  time();
									$total_amount      =  $this->input->post('total_amount');
									
									$pay_method        =   $this->input->post('payment_method');
									
									$payment_method    =  ( ! empty($pay_method)) ? $pay_method : 2;
									$status            =  1;
									$randomid          =  $this->input->post('randomid');
									
									$pay_random_id     =  $this->input->post('pay_random_id');
									
							}
						else
							{
									$establishment_id  =  11; //$this->input->post('establishment_id');
									$customer_id       =  196;//$this->input->post('customer_id');
									$location          =  '7,7'; //$this->input->post('location');
									$menu_items        =  json_decode('[{"id":"33","count":"1","name":"Paratha","price":"50","type":"1"},{"id":"35","count":"1","name":"Aalo poori","price":"50","type":"1"}]');//json_decode($this->input->post('selectedItemList'));
									$order_time        =  time();
									$total_amount      =  '196';//$this->input->post('total_amount');
									$payment_method    =  1;
									$status            =  1;
									$randomid          =  1989;//$this->input->post('randomid');
							}
						
						/* Save Order */
						
						$this->db->insert($this->_order, array('establishment_id' => $establishment_id, 'customer_id' => $customer_id, 'location' => $location, 'order_time' => $order_time, 'total_amount' => $total_amount, 'payment_method' => $payment_method, 'status' => $status, 'randomid' => $randomid, 'pay_random_id' => $pay_random_id));
						
						$order_id = $this->db->insert_id();
						
						/* close */
						
						/* Menu Items */
						
						//$menu_items ='[{"customization":[{"id":"2","options":"Medium","customization_type":"1","name":"Size","options_id":"4"},{"id":"1","options":[{"name":"Mayonnaise","id":"2","rate":"30"},{"name":"Cheese","id":"1","rate":"50"}],"customization_type":"2","name":"Extra"}],"id":"8","count":"1","name":"Uttapam","price":"329","type":"1"},{"id":"7","count":"4","name":"Capcisum Pizza","price":"420"}]';
						
						//$menu_items_decode = json_decode($menu_items);
						
						foreach ($menu_items as $menu_item_data)
							{
								$id       =   $menu_item_data->id;
								$quantity =   $menu_item_data->count;
								
								$this->db->insert($this->_order_menu_id, array('order_id' => $order_id, 'menu_id' => $id, 'qty' => $quantity));
								
								$order_menu_id = $this->db->insert_id();
								
								if (isset($menu_item_data->customization))
									{
										foreach ($menu_item_data->customization as $cdata)
											{
												$this->db->insert($this->_order_menu_customization_type, array('order_id' => $order_id, 'order_menu_id' => $order_menu_id, 'customization_type_id' => $cdata->id));
												
												if (is_array($cdata->options))
													{
														  foreach ($cdata->options as $odata)
															  {
																  $this->db->insert($this->_order_menu_customization_options, array('order_id' => $order_id, 'order_menu_id' => $order_menu_id, 'customization_options' => $odata->id));
															  }
													}	
											}
									}
							}
						
						/* Save Order Notification */
						
						$this->db->insert($this->_order_notification, array('order_id' => $order_id, 'notification' => "New Order #$order_id! Waiting for acceptance", 'ttime' => time(), 'flag' => 0, 'notify_status' => 1));
						
						/* close */
						
						$establishment_name = $this->db->select('name')->get_where($this->_establishment, array('id' => $establishment_id))->row()->name;
						
						/* Append */
						
						$start_time     =   mktime (0, 0, 0, date('m'), date('d'), date('Y'));
					    $end_time       =   mktime (23, 59, 59, date('m'), date('d'), date('Y'));
						
						$qry = $this->db->get_where($this->_order, array('establishment_id' => $establishment_id, 'order_time >=' => $start_time, 'order_time <=' => $end_time, 'customer_id' => $customer_id));
						
						if ($qry->num_rows() == 1)
							{
								$device_token = $this->db->select('device_token')->get_where($this->_accounts, array('id' => $customer_id))->row()->device_token;
                                if ( ! empty($device_token))
								  {
									 require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Push.php');
									 Push::send_notification_ios(array($device_token), array('message' => "Your order for Rs. $total_amount, has been successfully communicated to $establishment_name. Go to \"My Orders\" for more information"));
								  }
								  
								  $contactno = $this->db->select('contactno')->get_where($this->_accounts, array('id' => $customer_id))->row()->contactno;
								  require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Sms.php');
								  $msg = "You%20have%20placed%20your%20first%20order%20today%20at%20$establishment_name%20amounting%20to%20Rs.%20$total_amount.%20Kindly%20check%20%22My%20Orders%22%20for%20more%20information.";
								  //Sms::sendMessage($contactno, $msg);
							}
							
							$this->db->select('device_token');
							$staff_qry = $this->db->get_where($this->_staff_member, array('branch_id' => $establishment_id, 'status' => 1));
							if ($staff_qry->num_rows() > 0)
								 {
									 require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
									 $gcm  =  new Gcm();
									 foreach ($staff_qry->result() as $sdata)
										 {
											 $sdevice_token = $sdata->device_token;
											 if ( ! empty($sdevice_token))
												{
													$msg  =  "New Order #$order_id! Waiting for acceptance...&orderid=$order_id";
													$gcm->sendNotification($sdevice_token, $msg);
												}
										 }
								 } 
						
						/* close */		
						
						$query_locality =  $this->db->get_where($this->_order, array('establishment_id' => $establishment_id, 'customer_id' => $customer_id, 'order_time >=', $start_time, 'order_time <=' => $end_time));
						if ($query_locality->num_rows() == 1)
						$locality = 1;
							else					
					    $locality = 0;

						return array('order_id' => $order_id, 'locality' => $locality);
					}
					    return 0;
		}
		
		
	public function offerModule()
		{
			if (count($this->input->post()) > 0)
				{ 
				     $estab_id       =   $this->input->post('esab_id');
					 
					 $start_time     =   mktime (0, 0, 0, date('m'), date('d'), date('Y'));
					 $end_time       =   mktime (23, 59, 59, date('m'), date('d'), date('Y')); 
					 
					 $result         =   $this->db->select('category_id')->get_where($this->_offer, array('estabid' => $estab_id, 'valid_till >=' => $start_time, 'valid_till <=' => $end_time));
					
					 if ($result->num_rows() > 0)
						 {
							  $category_id = $result->row()->category_id;
							  $res = $this->db->select('category_name')->get_where($this->_category, array('id' => $category_id));
							  return $res->row()->category_name;
						 } 
				}
				              return "";
					
		}
		
	public function orderStatusModule()
		{
			$order_status = "";
			if (count($this->input->post()) > 0)
			    { 
					$orderid    =  $this->input->post('orderid');
					$result     =  $this->db->select('staff_member_id, status')->get_where($this->_order, array('order_id' => $orderid))->row();
					
					$staff_member_id   =  (int) $result->staff_member_id;
					
					if ($staff_member_id == 0)
						{
							$order_status      = "Waiting for acceptance";
						}
					else
						{
							$status            =  $result->status;
							switch ($status)
								{
									case 1:
											 $order_status = "In Preparation";
											 break;
									case 2:
									case 5:
											 $order_status = "In Priority";
											 break;
									case 3:
											 $order_status = "Completed";
											 break;
									case 4:
											 $order_status = "Cancelled";
											 break;
								}
						}
				}
							return $order_status;
		}
	
		
	public function feedbackModule()
		{
			if (count($this->input->post()) > 0)
			    { 
					$name         =  $this->input->post('name');
					$email        =  $this->input->post('email');
					$convenient   =  $this->input->post('convenient');
					$feedback     =  $this->input->post('feedback');
					$ftime        =  time();
					
					$this->db->insert($this->_feedback, array('name' => $name, 'email' => $email, 'convenient' => $convenient, 'feedback' => $feedback, 'ftime' => $ftime));
					
					$insert_id = (int) $this->db->insert_id();
					if ($insert_id > 0)
						{
							$html = "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
										  <tr>
											<td height=\"20\">Name</td>
											<td height=\"20\">".$name."</td>
										  </tr>
										  <tr>
											<td height=\"20\">Email</td>
											<td height=\"20\">".$email."</td>
										  </tr>
										  <tr>
											<td height=\"20\">Convenient</td>
											<td height=\"20\">".$convenient."</td>
										  </tr>
										  <tr>
											<td height=\"20\">Feedback</td>
											<td height=\"20\">".$feedback."</td>
										  </tr>
										  
										  <tr>
											<td height=\"20\">DateTime;</td>
											<td height=\"20\">".date('D, d M Y h:i A', $ftime)."</td>
										  </tr>
										  
									</table>";
										
							$this->email->from(config_item('from_email'), config_item('from_name'));
							$this->email->to(config_item('admin_email'));
							$this->email->subject('Afewtaps - Feedback');
							$this->email->set_mailtype('html');
							$this->email->message($html);
							$this->email->send();
							
							return 1;
						}
				}
				            return 0;
			
		}
		
		
	public function badgeCountModule()
		{
			$count = 0;
			if (count($this->input->post()) >= 0)
			    {
					$customer_id  = (int) 1;// $this->input->post('customer_id');
					
					$this->db->where(array("$this->_order.customer_id" => $customer_id, "$this->_order_notification.delivery_info" => 0));
					$this->db->from($this->_order);
					$this->db->join($this->_order_notification, "$this->_order_notification.order_id = $this->_order.order_id");
					$count = (int) $this->db->get()->num_rows();
					
				}
				    return $count;
		}
		
		
	public function badgeReadModule()
		{
			$count = 0;
			if (count($this->input->post()) >= 0)
			    {
					$customer_id    =  (int) 1; //$this->input->post('customer_id');
					
					$qry = $this->db->select('GROUP_CONCAT(`order_id`) as order_id')->get_where($this->_order, array('customer_id' => $customer_id));
					$order_id = $qry->row()->order_id;

					if ( ! empty($order_id))
					$this->db->where_in('order_id', explode(',', $order_id))->update($this->_order_notification, array('delivery_info' => '1'));
					
				}
				    return 1;
		}
		
	public function badgeModule()
		{
			$info  =  "";
		    if (count($this->input->post()) > 0)
			    {
					$customer_id    =  (int) $this->input->post('customer_id');
					$start_time     =   mktime (0, 0, 0, date('m'), date('d'), date('Y'));
					$end_time       =   mktime (23, 59, 59, date('m'), date('d'), date('Y'));
					$this->db->select('GROUP_CONCAT(`order_id`) as orderid');
					$this->db->where(array('customer_id' => $customer_id, 'ttime >= ' => $start_time, 'ttime <= ' => $end_time));
					$query_notification  =  $this->db->get($this->_order);
					if ($query_notification->num_rows() > 0)
						  {
							 foreach ($query_notification->result() as $sdata)
								 {
										$customer_info = $this->db->select('name')->get_where($this->_accounts, array('id' => $sdata->customer_id))->row();
										
										$res_query = $this->db->select('menu_id, qty, complete')->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
										
										$menu_item_array = array();
										
										foreach ($res_query->result() as $mid)
											{   
												$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
												
												$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id');
											
												$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
												
												$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
											
												$this->db->from($this->_menu_customization_type);

												$this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");	
												
												$rs = $this->db->get();
												
												$customization_count = (int) $rs->num_rows();
												
												if ($customization_count > 0)
													{
														$options  = array();
														foreach ($rs->result() as $rdata)
															{	
																$options['name'] = $rdata->customization_name;
																$this->db->select('id, customization_type_id, option_name, price');
																$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
																if ($opt_query->num_rows() > 0)
																	{
																		foreach ($opt_query->result() as $odata)
																			{
																				$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
																			}
																	 }
															}
															
															$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'complete' => $mid->complete, 'customization' => $options);
													}
												else
													   {
															$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'complete' => $mid->complete, 'type' => $result->item_type, 'customization' => array());
													   }
											}
											
										$payment_method = (int) $sdata->payment_method;
										
										switch ($payment_method)
											{
												case 1:
														   $payment  = "Credit Purchase";
														   break;
												case 2:
														   $payment  = "Cash On Delivery";
														   break;
												case 3:
														   $payment  = "Payu";
														   break;	   
											}
											
										$order_res = array();

										$this->db->select('notification');
										$this->db->order_by('ttime', 'asc');
										$query_notification = $this->db->get_where($this->_order_notification, array('order_id' => $sdata->order_id));
										if ($query_notification->num_rows() > 0)
											{
												foreach ($query_notification->result() as $res)
												$order_res[] = $res->notification;
											}
											
										$info[]   =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'status' => $sdata->status, 'notification' => $order_res);    												
									}									
				             }
				}
										return $info;
			
					
		}
		
	public function searchEstab()
		{
			 $result = array();
		     if (count($this->input->post()) > 0)
				{
					$userid     =   (int) $this->input->post('userid');
					
					$name = $this->input->post('name');
					$this->db->like('name', $name, 'after');
					$query  =  $this->db->get($this->_establishment);
					
					$today      =   strtolower(date('D'));
					$timing_today = "";
					
					if ($query->num_rows() > 0)
						{
							foreach ($query->result() as $result_data)
								{
									$timing = $this->db->select($today)->get_where($this->_estab_outlet_timing, array('estabid' => $result_data->id));
									if ($timing->num_rows() > 0)
										{
											$today_timing = $timing->row()->$today;
											if (! empty($today_timing))
												{
													//$timing_today_json = json_decode($today_timing);
													//$timing_today      = $timing_today_json->otime. ' to ' .$timing_today_json->ctime;
													
													$timing_today_json =  json_decode($today_timing);
													
													$timing_exp        =  explode (':', $timing_today_json->otime);
													$timing_open_hr    = (int) $timing_exp[0];
													$timing_open_min   = (int) $timing_exp[1];
													
													$omeridian         = '';
													
													if ($timing_open_hr == 12 && $timing_open_min == 0)
													$omeridian = " Noon";
												    elseif ($timing_open_hr < 12)
													$omeridian = " AM";
													else
													$omeridian = " PM";
												

												    if ($timing_open_hr > 12)
													$timing_open_hr = $timing_open_hr - 12;
												
												    $open_hr             =   str_pad($timing_open_hr, 2, '0', STR_PAD_LEFT);
												    $open_min            =   str_pad($timing_open_min, 2, '0', STR_PAD_LEFT);
													
													$open_format         =   $open_hr . ':' . $open_min . $omeridian;
													

													$timing_exp          =   explode (':', $timing_today_json->ctime);
													$timing_close_hr     =  (int) $timing_exp[0];
													$timing_close_min    =  (int) $timing_exp[1];

													/*if ($timing_close_hr == 24 && $timing_close_min == 0)
													$cmeridian = "Midnight";
												    elseif (($timing_close_hr > 12) || ($timing_close_hr == 12 && $timing_close_min > 0))
													$cmeridian = " PM";
													else
													$cmeridian = " AM";*/
												

												    if (($timing_close_hr == 12) && ($timing_close_min == 0))
													$cmeridian = " Noon";
												    elseif (($timing_close_hr > 12) || ($timing_close_hr == 12 && $timing_close_min > 0))
													$cmeridian = " PM";
													else
													$cmeridian = " AM";
												
												
												    if ($timing_close_hr > 12)
													$close_hr            = 	str_pad(($timing_close_hr - 12), 2, '0', STR_PAD_LEFT);
												     else
												    $close_hr            =   str_pad($timing_close_hr, 2, '0', STR_PAD_LEFT);
												
												
												    $close_min           =   str_pad($timing_close_min, 2, '0', STR_PAD_LEFT);
													
													
												
													$close_format        =   $close_hr . ':' . $close_min . $cmeridian;
													
													$timing_today        =   $open_format. ' to ' .$close_format;
												}
										}
										
										
									//$code_qry = $this->db->get_where($this->_coupon, array('estabid' => $result_data->id, 'status' => 1));
									//$code     = ($code_qry->num_rows() > 0) ? $code_qry->row()->off : '';


									$code = '';
									$time = time();
									$code_qry = $this->db->get_where($this->_coupon, array('estabid' => $result_data->id, 'status' => 1, 'valid_till >=' => $time));
									$code     = ($code_qry->num_rows() > 0) ? $code_qry->row()->off : '';
									if (empty($code))
										{
											$code_qry = $this->db->get_where($this->_offer, array('estabid' => $result_data->id, 'ostatus' => 1, 'valid_till >=' => $time));
											if ($code_qry->num_rows() > 0)
												{
													$result_obj = $code_qry->row();
													
													$category_name = $this->db->select('category_name')->get_where($this->_category, array('id' => $result_obj->category_id))->row()->category_name;
													$code = "1+1 on $category_name";
												}
										}
										
										
									 $this->db->where(array('estabid' => $result_data->id, 'is_read' => 0, 'userid' => $userid, 'reply !=' => ''));
									 $this->db->order_by('id', 'desc');
									 $this->db->limit(1);
									 $rating_notify_count = (int) $this->db->get($this->_estab_rating)->num_rows();	
										
									 $result[] = array('id' => $result_data->id, 'name' => $result_data->name, 'logo' => (string) $result_data->logo, 'cover_image' => (string) $result_data->cover_image, 'address' => $result_data->address, 'off' => (string) $code, 'notify_count' => "$rating_notify_count", 'timing' => $timing_today);
								}
						}		    
				}
							return $result;
		}
	
	public function userRatingAnswerModule()
		{
			if (count($this->input->post()) > 0)
				{
					$estabid   =  $this->input->post('estabid');
					$userid    =  $this->input->post('userid');
					
					$this->db->select('reply');
					$this->db->order_by('id', 'desc');
					$this->db->where(array('estabid' => $estabid, 'userid' => $userid));
					$result_qry = $this->db->get($this->_estab_rating);
					if ($result_qry->num_rows() > 0)
						{ 
							 return $result->row()->reply;
						}
				}
							 return;
		}
		
	/*public function getTaxModuleOld()
		{
			$menu_arr = array();
			$result   = array();
			if (count($this->input->post()) >= 0)
				{
					$estabid   =  3; // $this->input->post('estabid');
					$this->db->where('establishment_id', $estabid);
					$result_qry = $this->db->get_where($this->_tax, array('establishment_id' => $estabid, 'status' => 1));
					if ($result_qry->num_rows() > 0)
						{ 
							 foreach ($result_qry->result() as $res)
								 {
									 switch ($res->apply_for)
										 {
											case 1:
														$tax_name  = 'Service Charge';
														break;
														
											case 2:
														$tax_name  = 'Service Tax';
														break;
														
											case 3:
														$tax_name  = 'VAT on Food';
														break;
														
											case 4:
														$tax_name  = 'VAT on Drinks';
														break;
										 }
												        $result['tax'][$res->apply_for] = array('name' => $tax_name, 'rate' => $res->tax_rate);
								 }
								 
								 $start_time   =  mktime (0, 0, 0, date('m'), date('d'), date('Y'));
								 $end_time     =  mktime (23, 59, 59, date('m'), date('d'), date('Y'));
								 
								 $coupon_qry = $this->db->get_where($this->_coupon, array('estabid' => $estabid, 'status' => 1, 'valid_till >=' => $start_time, 'valid_till <=' => $end_time));
								 
								 if ($coupon_qry->num_rows() > 0)
								    {
									    $coupon_data      =  $coupon_qry->row();
										$result['coupon'] =  array('code' => $coupon_data->code, 'off' => $coupon_data->off, 'min_amt' => $coupon_data->min_amt, 'valid_till' => date('d/m/y', $coupon_data->valid_till));
								    }
								else
									{
										$result['coupon'] = array();
									}
									
								$offer_qry = $this->db->get_where($this->_offer, array('estabid' => $estabid, 'valid_till >=' => $start_time, 'valid_till <=' => $end_time));
								
								if ($offer_qry->num_rows() > 0)
								    {
										$res = array();
										foreach ($offer_qry->result() as $offer_data)
										$res[] =  array('cid' => $offer_data->category_id, 'valid_till' => date('d/m/y', $offer_data->valid_till));
										$result['offer'] = $res;
								    }
								else
									{
										$result['offer'] = array();
									}
						}
				}
										return $result;
		}
	*/
	
		
	public function couponEstabModule()
		{
			$result = array();
			if (count($this->input->post()) > 0)
				{
					$estabid      =  $this->input->post('estabid');
					
					$start_time   =  mktime (0, 0, 0, date('m'), date('d'), date('Y'));
					$end_time     =  mktime (23, 59, 59, date('m'), date('d'), date('Y'));
					 
					$coupon_qry = $this->db->get_where($this->_coupon, array('estabid' => $estabid, 'status' => 1, 'valid_till >=' => $start_time, 'valid_till <=' => $end_time));
					 if ($coupon_qry->num_rows() > 0)
						{
							$coupon_data      =  $coupon_qry->row();
							$result           =  array('code' => $coupon_data->code, 'off' => $coupon_data->off, 'min_amt' => $coupon_data->min_amt, 'valid_till' => date('d/m/y', $coupon_data->valid_till));
						}
				}
				return $result;
		}
		
	public function estabMenuItemModule()
		{
			$menu_arr = array();
			if (count($this->input->post()) > 0)
				{
					$estabid        =  $this->input->post('estabid');
					$this->db->select($this->_menu_items.'.item_name, '.$this->_menu_items.'.id, '.$this->_menu_items.'.price');
					$this->db->where($this->_branch_menu.'.branch_id', $estabid);
					$this->db->from($this->_branch_menu);
					$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_branch_menu.menu_id");
					$result = $this->db->get();
					if ($result->num_rows() > 0)
					 {
					      foreach ($result->result() as $data)
						  $menu_arr[] = array('id' => $data->id, 'name' => $data->item_name, 'price' => $data->price);
					 }
				}
						  return $menu_arr;
		}
		
	public function saveLocality()
		{
			if (count($this->input->post()) > 0)
				{
					$id        =  $this->input->post('userid');
					$locality  =  $this->input->post('locality');
					if (is_int($locality))
						{
							$this->db->insert($this->_user_locality, array('userid' => $id, 'locality' => $locality, 'ttime' => time()));
							$insert_id =  (int) $this->db->insert_id();
						}
					else
						{
							$this->db->insert($this->_locality, array('locality' => $locality, 'ttime' => time()));
							$insert_id =  (int) $this->db->insert_id();
						}
							return ($insert_id > 0) ? 1 : 0;
				}
							return 0;	
		}
		
	public function viewLocalityModule()
		{
			$loc = array();
			$this->db->distinct();
			$this->db->select('locality');
			$locality =  $this->db->get($this->_locality);
			foreach ($locality->result() as $locality_data)
			$loc[] = $locality_data->locality;	
			return $loc;
		}
		
	public function filterEstablishmentModule_OLD() // OlD
		{
			$estab    =    array();
			if (count($this->input->post()) > 0)
				{
					$search_text  =   $this->input->post('search_text');
					
					$this->db->select('name, address');
					$this->db->like('name', $search_text, 'both');
					$result = $this->db->get($this->_establishment);
					if ($result->num_rows() > 0)
						{
							 foreach ($result->result() as $data)
							 $estab[] = array('name' => $data->name, 'address' => $data->address, 'logo' => ''); 
						}
				}
							 return $estab;	
		}
		
		
	public function filterEstablishmentModule($branchid = 1)
		{	
		    $arr_items  =  "";
		    if (count($this->input->post()) >= 0)
			    {
					$branch_id   =  1; //$this->input->post('branch_id');
					$user_id     =  1; //$this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $branch_id))->row()->userid;
					foreach (array(1, 2) as $category)
						{
								$this->db->select($this->_menu_category.'.main_category, '.$this->_category.'.category_name, '.$this->_menu_items.'.id as mid, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.description, '.$this->_menu_items.'.item_type');
								$this->db->where($this->_menu_category.'.main_category', $category);
								$this->db->where($this->_branch_menu.'.branch_id', $branch_id);
								$this->db->where($this->_menu_category.'.user_id', $user_id);
								$this->db->order_by($this->_menu_category.'.category_id',  'asc');
								$this->db->from($this->_menu_category);
								$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
								$this->db->join($this->_branch_menu, "$this->_branch_menu.menu_id = $this->_menu_items.id");
								$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
								$res = $this->db->get();
								$menu_array   = array();
								foreach ($res->result() as $result)
									{
										$this->db->select('id, customization_name, customization_type');
										$res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $result->mid));
										if ($res_query->num_rows() > 0)
											{
												$opt = array();
												foreach ($res_query->result() as $rdata)
													{	 
													    $options         =  array();
														$options['id']   =  $rdata->id;
														$options['name'] =  $rdata->customization_name;
														$options['customization_type'] = $rdata->customization_type;
														$this->db->select('id, customization_type_id, option_name, price');
														$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->id));
														if ($opt_query->num_rows() > 0)
															{
																foreach ($opt_query->result() as $odata)
																$options['options'][]  =  array('id' => $odata->id, 'option_name' => $odata->option_name, 'price' => $odata->price);
															}
																$opt[] = $options;
													}
													
													$menu_array = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => $opt);
											}
										else
											{
														$menu_array = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => "");
											}														
														$arr_items[] = $menu_array;
									}
						}					 
				}
												        return array('data' => $arr_items);
		}
	
	public function locationChangeModule()
		{
			if (count($this->input->post()) > 0)
				{
					$location_id   =   $this->input->post('location_id');
					$order_id      =   $this->input->post('order_id');
					
					$this->db->where('order_id', $order_id);
					$this->db->update($this->_order, array('location' => $location_id));
					
					/* Get Location Name */
					 $this->db->select('location');
					 $location_name = $this->db->get_where($this->_estab_location, array('id' => $location_id))->row()->location;
					/* Close */
					
					/* Send Order Cancel Notification to Server */
					 
					     $this->db->select($this->_staff_member.".device_token");
						 $this->db->where($this->_order.'.order_id', $order_id);
					     $this->db->from($this->_order);
					     $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
					     $device_token = $this->db->get()->row()->device_token;
						 if ( ! empty($device_token))
							 {
								require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
								$gcm  =  new Gcm();
								$msg  =  'User has change the location. New location is $location_name';
								$gcm->sendNotification($device_token, $msg); 
							 }
						
				    /* Close */
				}	 
		}

	public function getMyOrders()
		{
			$info  =  "";
		    if (count($this->input->post()) >= 0)
			    {		
				   $customer_id    =  1;  // (int) $this->input->post('customer_id');

				   $start_time     =   mktime (0, 0, 0, date('m'), date('d'), date('Y'));
					
				   $end_time       =   mktime (23, 59, 59, date('m'), date('d'), date('Y'));
			
				   $this->db->where(array('customer_id' => $customer_id));
				   
				   $this->db->order_by('order_id', 'desc');
				   
				   $this->db->limit(1);

				   $query   =  $this->db->get($this->_order);
			
				   if ($query->num_rows() > 0)
				    	{
						  foreach ($query->result() as $sdata)
							 {
								$this->db->select('menu_id, qty');
								$res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
								$menu_item_array = array();
								foreach ($res_query->result() as $mid)
									{   
										$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
										
										$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id, '.$this->_menu_customization_type.'.customization_type');
									
										$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
										
										$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									
										$this->db->from($this->_menu_customization_type);

										$this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");	
										
										$res = $this->db->get();
										
										$customization_count = (int) $res->num_rows();
										
										if ($customization_count > 0)
											{
												$options  = array();
												foreach ($res->result() as $rdata)
													{	
														$options['name']                 =  $rdata->customization_name;
														$options['customization_type']   =  $rdata->customization_type;

														$this->db->select('id, customization_type_id, option_name, price');
														
														$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));

														
														if ($opt_query->num_rows() > 0)
															{
																foreach ($opt_query->result() as $odata)
																	{
																		$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
																	}
															 }
													}
													
													$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $options);
											}
										else
											   {
													$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
											   }
									}
									
								$payment_method = (int) $sdata->payment_method;
								
								switch ($payment_method)
									{
										case 1:
												   $payment  = "Credit Purchase";
												   break;
										case 2:
												   $payment  = "Cash On Delivery";
												   break;
										case 3:
												   $payment  = "Payu";
												   break;	   
									}
									
								 $order_res = array();

								 $this->db->select('notification');
								 $this->db->order_by('ttime', 'asc');
								 $query_notification = $this->db->get_where($this->_order_notification, array('order_id' => $sdata->order_id));
								 if ($query_notification->num_rows() > 0)
									{
										foreach ($query_notification->result() as $res)
										$order_res[] = array('data' => $res->notification);
									}
									
								 $info   =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'notification' => $order_res);    												
							 }									
					    }
				}
                                return $info;
		}
		
		
	public function getMyOrders1() // New   20 oct
		{
			$info  =  "";
		    if (count($this->input->post()) > 0)
			    {		
				   $customer_id    =  (int) $this->input->post('customer_id');
				   $estab_id       =  (int) $this->input->post('estab_id');
				   $start_time     =   mktime (0, 0, 0, date('m'), date('d'), date('Y'));
				   $end_time       =   mktime (23, 59, 59, date('m'), date('d'), date('Y'));
			
			       if( $estab_id != 0)
				   $this->db->where('establishment_id', $estab_id);
			   
				   $this->db->where(array('order_time >=' => $start_time, 'order_time <=' => $end_time, 'customer_id' => $customer_id));
				   $this->db->order_by('order_id', 'desc');
				   $query   =  $this->db->get($this->_order);
				   
				   if ($query->num_rows() > 0)
				    	{
						  foreach ($query->result() as $sdata)
							 {
								$comments   = '';
								$random_qry = $this->db->select('comment')->get_where($this->_order_comment, array('randomid' => $sdata->randomid));
								if ($random_qry->num_rows() > 0)
								$comments   = $random_qry->row()->comment;
									
								$sname = '';
								$staff_member_id = $sdata->staff_member_id;
								if ($staff_member_id > 0)
									{
										$sname = ucwords($this->db->select('name')->get_where($this->_staff_member, array('id' => $staff_member_id))->row()->name);
									}
								 
								$this->db->select('menu_id, qty');
								$res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
								$menu_item_array = array();
								foreach ($res_query->result() as $mid)
									{   
										$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
										
										$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id, '.$this->_menu_customization_type.'.customization_type');
									
										$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
										
										$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
										
										$this->db->from($this->_order_menu_customization_type);

										$this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.id = $this->_order_menu_customization_type.customization_type_id");

										$res = $this->db->get();
										
										$customization_count = (int) $res->num_rows();
										
										if ($customization_count > 0)
											{
												$options  = array();
												foreach ($res->result() as $rdata)
													{	
														$options['name']                 =  $rdata->customization_name;
														$options['customization_type']   =  $rdata->customization_type;

														$this->db->select('id, customization_type_id, option_name, price');
														
														$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));

														if ($opt_query->num_rows() > 0)
															{
																foreach ($opt_query->result() as $odata)
																	{
																		$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
																	}
															 }
													}
													
													$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $options);
											}
										else
											   {
													$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
											   }
									}
									
								$payment_method = (int) $sdata->payment_method;
								
								switch ($payment_method)
									{
										case 1:
												   $payment  = "Credit Purchase";
												   break;
										case 2:
												   $payment  = "Cash On Delivery";
												   break;
										case 3:
												   $payment  = "Payu";
												   break;	   
									}
									
								$staff_member_id  = (int) $sdata->staff_member_id;
								
								$ostatus          =  $sdata->status;
								
								if ($staff_member_id == 0 && $ostatus != 4)
									{
										$status   =  "Waiting for acceptance";
									}
								else
									{
										switch ($ostatus)
											{
												case 1:
														 $status   = "In Preparation";
														 break;
												case 2:
														 $status   = "In Priority";
														 break;
												case 3:
														 $status   = "Completed";
														 break;
												case 4:
														 $status   = "Cancelled";
														 break;
												case 5:
														 $status   = "Threshold";
														 break;	  
											}
									}
									
									
								 $order_res = array();
								 
								 $query_notification = $this->db->query("SELECT `notification` FROM `$this->_order_notification` WHERE `order_id` =  $sdata->order_id AND `flag` = 1 AND (`notify_status` = 2 OR `notify_status` = 7 OR `notify_status` = 8 OR `notify_status` = 6 OR `notify_status` = 9) ORDER BY ttime DESC");
								 
								 if ($query_notification->num_rows() > 0)
									{
										foreach ($query_notification->result() as $res)
										$order_res[] = array('data' => $res->notification);
									}
									
								 /* Check Dont ask Nudge */
								 
								 $ask_nudge_query  =   $this->db->get_where($this->_dont_ask_nudge, array('userid' => $customer_id));
								 $dont_ask_nudge   =  ($ask_nudge_query->num_rows() > 0) ? 1 : 0;
									
								 $info[]   =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'location' => getOrderLocation($sdata->location), 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'notification' => $order_res, 'sname' => $sname, 'status' => $status, 'comments' => $comments, 'del_intimation' => $sdata->delivery_intimation, 'ask_nudge' => "$dont_ask_nudge");    												
							 }									
					    }
				}
                                return $info;
		}

		
	public function userOrderCancelModule()
		{
			if (count($this->input->post()) > 0)
				{
					$orderid    =   (int) $this->input->post('orderid');
					$this->db->where(array('order_id' => $orderid, 'status !=' => 4, 'status !=' => 3));
					$query      =   $this->db->get($this->_order);
					
					// Check Intimation before cancel //
					$check_intimation = (int) $this->db->get_where($this->_order_notification, array('order_id' => $orderid, 'notify_status' => 6))->num_rows();

					if ($query->num_rows() > 0 && $check_intimation == 0)
					   {
							$this->db->where('order_id', $orderid)->update($this->_order, array('status' => 4, 'cancel_time' => time()));
							
							/* Order Cancel Summary */
							
							$flag     =  (int) $this->input->post('flag');
							$reason   =  '';
							switch ($flag)
								{
									case 1:
									         $reason  = "I have left the venue";
											 break;
									case 2:
									         $reason  = "I want to order something else";
											 break;
									case 3:
									         $reason  = $this->input->post('reason');
											 break;
								}
								
							$data['reason']     =  $reason;
							$data['order_id']   =  $orderid;
							$data['ctime']      =  time();
							$data['user_flag']  =  1;
							
							$this->db->insert($this->_order_cancel_reason, $data);

							/* close */
							 
							//if ($this->db->affected_rows() > 0)
								//$response = array('status' => 'true', 'msg' => 'Success');
							//else
								//$response = array('status' => 'false', 'msg' => 'Server Error');

							 /* Send Order Cancel Notification to Server */
							 
							     $msg   =  "Order #$orderid has been cancelled due to following reason(s): $reason&orderid=$orderid";
								 
								 $dbmsg =  "Order #$orderid has been cancelled due to following reason(s): $reason";
							  
							     $this->db->insert($this->_order_notification, array('order_id' => $orderid, 'notification' => $dbmsg, 'ttime' => time(), 'flag' => 0, 'notify_status' => 5));
							 
								 $this->db->select($this->_staff_member.".device_token");
								 $this->db->where($this->_order.'.order_id', $orderid);
								 $this->db->from($this->_order);
								 $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
								 $qry = $this->db->get();
								 if ($qry->num_rows() > 0)
									 {
										$device_token =  $qry ->row()->device_token;
										if ( ! empty($device_token))
											 {
												 require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
												 $gcm  =  new Gcm();
												 $gcm->sendNotification($device_token, $msg); 
											 }
									 }
								else
									{
										 $this->db->select($this->_staff_member.".device_token");
										 $this->db->where($this->_order.'.order_id', $orderid);
										 $this->db->from($this->_order);
										 $this->db->join($this->_staff_member, "$this->_staff_member.branch_id = $this->_order.establishment_id");
										 $qry = $this->db->get();
										 if ($qry->num_rows() > 0)
											 {
												foreach ($qry->result() as $sdata)
													{
														$device_token =  $sdata->device_token;
														if ( ! empty($device_token))
															 {
																 require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
																 $gcm  =  new Gcm();
																 $gcm->sendNotification($device_token, $msg); 
															 }
													}

											 }
									}
									 
							 /* Close */
							
							
							/* Send cancel order mail to user */
							
							 $this->db->select($this->_accounts.".email, ".$this->_accounts.".contactno");
							 $this->db->where($this->_order.'.order_id', $orderid);
							 $this->db->from($this->_order);
							 $this->db->join($this->_accounts, "$this->_accounts.id = $this->_order.customer_id");
							 $cqry = $this->db->get()->row();
							 $email       =   $cqry->email;
							 $contactno   =   $cqry->contactno;
							 if ( ! empty($email))
								 {
									//$this->email->from(config_item('from_email'), config_item('from_name'));
									//$this->email->to($email);
									//$this->email->subject('AFewTaps - Order Cancel');
									//$this->email->message("Order #$orderid has been cancelled due to the following reason(s): $reason");
									//$this->email->send(); 
								 }
								 
							/* Close email */
							
							/* Send SMS */
							
							if ( ! empty($contactno) && ! empty($reason))
								{
									require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Sms.php');
									$msg = "Order #$orderid has been cancelled due to the following reason(s): $reason";
									//Sms::sendMessage($contactno, $msg);
								}
								
							    $response = array('status' => 'true', 'msg' => 'Success');	
					   }
					  else  
								$response = array('status' => 'false', 'msg' => 'Server Error');
				}
				else  
								$response = array('status' => 'false', 'msg' => 'Server Error');
						    
								return $response;
		}
		
		
	public function applyCouponCodeModule($code = '')
		{
			$code   =  'sdf'; // $this->input->post('code');
			$total  =  300;   // $this->input->post('total');
			
			$time   =  time();
			
			$this->db->where(array('code' => $code, 'sdate >=' => $time, 'amount >=' => $total));
			$query = $this->db->get($this->_coupon);
			if ($query->num_rows() > 0)
				{
					$result  = $query->row();
					
					$flat_percentage = $result->percentage;
					
					$discount = $total * $flat_percentage / 100 ;
	
					$msg  = array('status' => 'true', 'total' => $discount);
					
				}
			else
				    $msg  = array('status' => 'false', 'total' => '');
				
				    return $msg;
		}
	
	public function getMenuItemsModule($branchid = '')
		{				
		    $arr    =  "";
		    if (count($this->input->post()) > 0)
			    {
					$branch_id   =  $this->input->post('estabid');
					$user_id     =  $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $branch_id))->row()->userid;
					foreach (array(1, 2) as $category)
						{
								$this->db->select($this->_menu_category.'.main_category, '.$this->_category.'.category_name, '.$this->_menu_items.'.id as mid, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.description, '.$this->_menu_items.'.item_type');
								$this->db->where($this->_menu_category.'.main_category', $category);
								$this->db->where($this->_branch_menu.'.branch_id', $branch_id);
								$this->db->where($this->_menu_category.'.user_id', $user_id);
								$this->db->order_by($this->_menu_category.'.category_id',  'asc');
								$this->db->order_by($this->_menu_items.'.item_type',  'asc');
								$this->db->from($this->_menu_category);
								$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
								$this->db->join($this->_branch_menu, "$this->_branch_menu.menu_id = $this->_menu_items.id");
								$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
								$res = $this->db->get();
								$menu_array   = array();

								if ($res->num_rows() > 0)
								    {								
										foreach ($res->result() as $result)
											{
												$this->db->select('id, customization_name, customization_type');
												$this->db->order_by('customization_type', 'asc');
												$res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $result->mid));
												if ($res_query->num_rows() > 0)
													{
														$opt = array();
														foreach ($res_query->result() as $rdata)
															{	 
																$options         =  array();
																$options['id']   =  $rdata->id;
																$options['name'] =  $rdata->customization_name;
																$options['customization_type'] = $rdata->customization_type;
																$options['flag'] =  0;
																$this->db->select('id, customization_type_id, option_name, price');
																
																$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->id));
																if ($opt_query->num_rows() > 0)
																	{
																		foreach ($opt_query->result() as $odata)
																		$options['options'][]  =  array('id' => $odata->id, 'option_name' => $odata->option_name, 'price' => $odata->price);
																	}
																		$opt[] = $options;
															}
															
															$menu_array = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => $opt);
													}
												else
													{
																$menu_array = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => "");
													}
																$main_category = ($result->main_category == 1) ? 'Food' : 'Drinks';
																$esab_items[$main_category][$result->category_name][]  = $menu_array;
											}
						            }		
						}
														foreach (array('Food', 'Drinks') as $category_value)
															{
																if (count($esab_items[$category_value]) > 0)
																	{
																		foreach ($esab_items[$category_value] as $sub_cat => $item_arr)
																			 {
																				 $json_arr = array();
																				 $json_arr['subcat']      =  $sub_cat;
																				 $json_arr['items']       =  $item_arr;
																				 $arr[$category_value][]  =  $json_arr;
																			 }
																	}
																else
																	             $arr[$category_value]    =  [];
																
															}						 
				}
												        return $arr;
		}
		
	public function getFoodItems($branchid = 1)
		{	
		   
		    $esab_items  =  array();
			
			$cateory     =  1;
			$branch_id   =  1;
			$user_id     =  1;

			$this->db->distinct();
			
			$this->db->select($this->_menu_category.'.category_id, '.$this->_category.'.category_name, '.$this->_menu_category.'.main_category');
			
			$this->db->where($this->_menu_category.'.main_category', $cateory);
			
			$this->db->where($this->_branch_menu.'.branch_id', $branch_id);
			
			$this->db->where($this->_menu_category.'.user_id', $user_id);
			
			$this->db->order_by($this->_menu_category.'.category_id',  'asc');
			
			$this->db->from($this->_menu_category);
			
			$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
			
			$this->db->join($this->_branch_menu, "$this->_branch_menu.menu_id = $this->_menu_items.id");
			
			$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");

			$res = $this->db->get();
			
			
			$main_category = ($cateory == 1) ? 'Food' : 'Drinks';
			
			foreach ($res->result() as $sdata)
			    {
			        $this->db->select('menu_id');
					
					$res_query = $this->db->get_where($this->_menu_category, array('main_category' => $sdata->main_category, 'category_id' => $sdata->category_id));
					
					$esab_items = [];
					
					$array1     = array();
					
					foreach ($res_query->result() as $mid)
					  {
						    // $res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $result->mid));
						   
						    $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row();
						   
						    $res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $mid->menu_id));
							
							if ($res_query->num_rows() > 0)
								{
									foreach ($res_query->result() as $rdata)
										{	
											$options['name'] = $rdata->customization_name;
											$options['customization_type'] = $rdata->customization_type;
											
											$this->db->select('id, customization_type_id, option_name, price');
							
											$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->id));

											if ($opt_query->num_rows() > 0)
												{
													$options = array();
													foreach ($opt_query->result() as $odata)
														{
															$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
														}
												 }
												 
											$array1[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => $options);

										}
								}
							else
								{
											$array1[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => array('options' => array()));
								}
											
					  }
											$esab_items['subcat']['sc']     =   $sdata->category_name;
											$esab_items['subcat']['items']  =   $array1;
											$ddd[] = $esab_items;
			     }
											return $ddd;
		}
		
		
	public function getDrinksItems($branchid = 1)
		{	
		    $esab_items  =  array();
			
			$cateory     =  2;
			$branch_id   =  1;
			$user_id     =  1;

			$this->db->distinct();
			
			$this->db->select($this->_menu_category.'.category_id, '.$this->_category.'.category_name, '.$this->_menu_category.'.main_category');
			
			$this->db->where($this->_menu_category.'.main_category', $cateory);
			
			$this->db->where($this->_branch_menu.'.branch_id', $branch_id);
			
			$this->db->where($this->_menu_category.'.user_id', $user_id);
			
			$this->db->order_by($this->_menu_category.'.category_id',  'asc');
			
			$this->db->from($this->_menu_category);
			
			$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
			
			$this->db->join($this->_branch_menu, "$this->_branch_menu.menu_id = $this->_menu_items.id");
			
			$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");

			$res = $this->db->get();
			
			
			$main_category = ($cateory == 1) ? 'Food' : 'Drinks';
			
			$ddd = array();
			
			foreach ($res->result() as $sdata)
			    {
			        $this->db->select('menu_id');
					
					$res_query = $this->db->get_where($this->_menu_category, array('main_category' => $sdata->main_category, 'category_id' => $sdata->category_id));
					
					$esab_items = [];
					
					$array1 = array();
					
					
					
					foreach ($res_query->result() as $mid)
					  {
						    // $res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $result->mid));
						   
						    $result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row();
						   
						    $res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $mid->menu_id));
							
							if ($res_query->num_rows() > 0)
								{
									foreach ($res_query->result() as $rdata)
										{	
											$options['name'] = $rdata->customization_name;
											$options['customization_type'] = $rdata->customization_type;
											
											$this->db->select('id, customization_type_id, option_name, price');
							
											$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->id));

											if ($opt_query->num_rows() > 0)
												{
													$options = array();
													foreach ($opt_query->result() as $odata)
														{
															$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
														}
												 }
												 
											$array1[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => $options);

										}
								}
							else
								{
											$array1[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => array('options' => array()));
								}
											
					  }
											$esab_items['subcat']['sc']     =   $sdata->category_name;
											$esab_items['subcat']['sid']    =   $sdata->category_id;
											$esab_items['subcat']['items']  =   $array1;
											$ddd[] = $esab_items;
			     }
			                                return $ddd;
		}
		
	public function estabLocationModule()
		{
			if (count($this->input->post()) > 0)
				{
					$estabid          =  $this->input->post('estabid');

					$location 		  =  array();
					$cinema_audi_qry  =  $this->db->get_where($this->_cinema_audi, array('cinema_id' => $estabid));
					if ($cinema_audi_qry->num_rows() > 0)
						{
							foreach ($cinema_audi_qry->result() as $cinema_audi_data)
								{
									$data['no']       =  $cinema_audi_data->audi_id;
									$data['id']       =  $cinema_audi_data->id;
									$res_arr          =	 [];
									$cinema_rows_qry  =  $this->db->get_where($this->_cinema_rows, array('cinema_audi_id' => $cinema_audi_data->id));
									if ($cinema_rows_qry->num_rows() > 0)
										{
											$i = 0 ;
											$arr = [];
											foreach ($cinema_rows_qry->result() as $cinema_rows_data)
												{
													$result = [];	

													$result['row_no'] =  $cinema_rows_data->row_no;
													$result['row_id'] =  $cinema_rows_data->id;
													
													$cinema_seats_qry  =  $this->db->get_where($this->_cinema_seats, array('cinema_rows_id' => $cinema_rows_data->id, 'status' => 1));
													$seats = array();
													if ($cinema_seats_qry->num_rows() > 0)
														{
															foreach ($cinema_seats_qry->result() as $cinema_seats)
																{
																	$seats[] = array('id' => $cinema_seats->id, 'no' => $cinema_seats->seats_no);
																}													
												        }
													
													$result['seats']     =  $seats;
										
													$res_arr[]			 =  $result;
													
								                }
												  $data['res'] =  $res_arr;
												  $location[]  =  $data;
										          $data  =  [] ;
						                }
										 								
								}	
										 
						}
						
					$resp  =  array();
					$floor_qry = $this->db->get_where($this->_restaurants_floor, array('estab_id' => $estabid));
					if ($floor_qry->num_rows() > 0)
						{
							 foreach ($floor_qry->result() as $res)
								 {
									$loc_array = array(); 
									$loc =  $this->db->get_where($this->_restaurants_location, array('restaurant_floor_id' => $res->id));
									$loc_arr = array();
									if ($loc->num_rows() > 0)
										{
											foreach ($loc->result() as $ldata)
												{
													$loc_arr[] = array('id' => $ldata->id, 'name' => $ldata->location_name, 'flag' => $ldata->form);
												}
										}
									else 
										    $loc_arr = "";
											
											$loc_array['id']  = $res->id;
											$loc_array['key'] = $res->floor_id;
											$loc_array['val'] = $loc_arr;
											$resp[] = $loc_array;
								 }
								 $data['data'] = $resp;
						}
					else
						         $data['data'] = array();
						
					$payment_method = '';	
					$this->db->select('payment_method, info');
					$result_qry = $this->db->get_where($this->_payment_method, array('branch_id' => $estabid));
					$info = "";
					if ($result_qry->num_rows() > 0)
						{
							$res             = 	$result_qry->row();
							$payment_method  =	$res->payment_method;
							$info            = 	$res->info;
						}
						
							$customer_id     =  (int) $this->input->post('customer_id');
						
							$this->db->select('COUNT(*) as count_negligent');
							$this->db->where($this->_order.'.customer_id', $customer_id);
							$this->db->from($this->_order);
							$this->db->join($this->_negligent_order, "$this->_negligent_order.order_id = $this->_order.order_id");
							$count_negligent = $this->db->get()->row()->count_negligent;
							if ($count_negligent > 3)
								{
									$payment_method_data = explode (',', $payment_method);
									unset($payment_method_data[array_search(2, $payment_method_data)]);
								}
							else
								    $payment_method_data  = explode(',', $payment_method);
								
								    sort($payment_method_data);

									/* instamojo headers */
									
									$this->db->select($this->_account.'.email');
									$this->db->where($this->_merchant_estab.'.estabid', $estabid);
									$this->db->from($this->_account);
									$this->db->join($this->_merchant_estab, "$this->_merchant_estab.userid = $this->_account.id");
									$query = $this->db->get();
									
									if ($query->num_rows() > 0)
										{
											$email         =   $query->row()->email;
											$pwd           =   substr($email, 0, strrpos($email, '@'));
											
											$user_auth     =   array('username' => $email, 'password' => $pwd);	
											
											$curl_array    =   array();
											require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Curl.php');
											
											$response      =   Curl::callMethod('oauth2/token/', $user_auth, '', 'auth');
											
											$token_type    =   '';
											$access_token  =   '';
											if (is_object($response))
												{
													$token_type      =    $response->token_type;
													$access_token    =    $response->access_token;
												}
											$headers = array('token_type' => $token_type, 'access_token' => $access_token);
										}
								
								    return array('audi' => $location, 'floor' => $data, 'payment' => array_values($payment_method_data), 'delivery' => $info, 'headers' => $headers);
				}
							     	return;
		}  
		
		
	public function orderHistoryModule()
		{
			$info  =  array();
		    if (count($this->input->post()) > 0)
			    {		
				   $estab_id    =  (int) $this->input->post('estab_id');
				   $userid      =  (int) $this->input->post('userid');
				   
				   /*$this->db->where('customer_id', $userid);
				   $this->db->where('establishment_id', $estab_id);
				   $this->db->where('status', 3);
				   $this->db->or_where('status', 4);
				   $this->db->limit(25);
				   $this->db->order_by('order_time', 'desc');
				   $query   =  $this->db->get($this->_order);*/
				   
				   $query = $this->db->query("SELECT * FROM `$this->_order` WHERE `customer_id` = $userid AND `establishment_id` =  $estab_id AND (`status` = 3 OR `status` = 4) ORDER BY `order_time` DESC LIMIT 25");
				   
				   if ($query->num_rows() > 0)
				    	{
						  foreach ($query->result() as $sdata)
							 {
								$this->db->select('menu_id, qty');
								$res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
								$menu_item_array = array();
								
								foreach ($res_query->result() as $mid)
									{   
										$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
										
										$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id, '.$this->_menu_customization_type.'.customization_type');
									
										$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
										
										$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									
										$this->db->from($this->_menu_customization_type);

										$this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id  = $this->_menu_customization_type.id");	
										
										$res = $this->db->get();
										
										$customization_count = (int) $res->num_rows();
										
										if ($customization_count > 0)
											{
												$options  = array();
												foreach ($res->result() as $rdata)
													{	
														$options['name']               =  $rdata->customization_name;
														$options['customization_type'] =  $rdata->customization_type;
														
														$this->db->select('id, customization_type_id, option_name, price');
														$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
														if ($opt_query->num_rows() > 0)
															{
																foreach ($opt_query->result() as $odata)
																	{
																		$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
																	}
															 }
													}
													
													$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'name' => $result->item_name, 'price' => $result->price, 'count' => $mid->qty, 'type' => $result->item_type, 'customization' => $options);
											}
										else
											   {
													$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'name' => $result->item_name, 'price' => $result->price, 'count' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
											   }
									}
									
								$payment_method = (int) $sdata->payment_method;
								
								switch ($payment_method)
									{
										case 1:
												   $payment  = "Credit Purchase";
												   break;
										case 2:
												   $payment  = "Cash On Delivery";
												   break;
										case 3:
												   $payment  = "Payu";
												   break;	   
									}
									
								switch ($sdata->status)
									{
										 case 3:
										            $diff_time =  time() - $sdata->completion_time;
													$ostatus   =  "Completed";
													$comp      =  date('h:i a, d M Y', $sdata->completion_time);
													break;
												   
										 case 4:
													$diff_time =  time() - $sdata->cancel_time;
													$ostatus   = "Cancelled";
													$comp      =  date('h:i a, d M Y', $sdata->cancel_time);
													break;
									}
    
								$hours      =   floor ($diff_time /3600); 
								$minutes    =   intval (($diff_time/60) % 60);        
								$seconds    =   intval ($diff_time % 60);     

								$time_diff  =   '';
								if ($hours > 0) 
								$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

								$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT). ":";

								$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);
								
								/* Get Coupon Here */
								
								$code_qry    = $this->db->select('off')->get_where($this->_coupon, array('estabid' => $estab_id, 'status' => 1));
								$code        = ($code_qry->num_rows() > 0) ? $code_qry->row()->off : '';
								
								/* Get Location */
								$location    =   getOrderLocation($sdata->location);

								//$info[]      =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'pay_key' => "$payment_method", 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'otime' => $comp, 'status' => $ostatus, 'off' => $code, 'location' => $location, 'location_id' => $sdata->location); 

								$info[]      =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'pay_key' => "$payment_method", 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'otime' => $comp, 'status' => $ostatus, 'off' => $code, 'location' => $location['location_data'], 'location_id' => $location['location_id']);  															
							 }									
					    }
				}
                                return $info;
		}
		
	public function userRatingModule()
		{
			if (count($this->input->post()) > 0)
				{
					$userid     =   $this->input->post('userid');
					$review     =   $this->input->post('review');
					$estabid    =   $this->input->post('establishmentiD');
					$rating     =   $this->input->post('rating');
					
					$data['rating']  	 = 	 $rating;
					$data['userid']  	 = 	 $userid;
					$data['estabid'] 	 = 	 $estabid;
					$data['review'] 	 =   $review;
					$data['ttime']  	 =   time();
					
					$this->db->insert($this->_estab_rating, $data);
					$insert_id =  (int) $this->db->insert_id();
					return ($insert_id > 0) ? 1 : 0; 
				}
			else
				    return 0;
		}
		
	public function estabReplyModule()
		{
			if (count($this->input->post()) > 0)
				{
					$userid     =   $this->input->post('userid');
					$estabid    =   $this->input->post('estabid');
					
					$this->db->where('estabid', $estabid)->update($this->_estab_rating, array('is_read' => 1));
					
					$this->db->select('reply');
					$this->db->order_by('id', 'desc');
					$this->db->where('reply !=', '');
					$qry = $this->db->get_where($this->_estab_rating, array('userid' => $userid, 'estabid' => $estabid));
					if ($qry->num_rows() > 0)
						return $qry->row()->reply;
					else
						return '';
				}
			else
				        return '';
		}
		
		
		
	public function orderPlacedModule()
	    {
		    $info  =  array();
		    if (count($this->input->post()) >= 0)
			    {		
				   //$estab_id    =  (int) $this->input->post('estab_id');
				   $order_id    =  (int) 1; //$this->input->post('order_id');
				   $query       =  $this->db->get_where($this->_order, array('order_id' => $order_id));
				   if ($query->num_rows() > 0)
				    	{
						  foreach ($query->result() as $sdata)
							 {
								$this->db->select('menu_id, qty');
								$res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
								$menu_item_array = array();
								foreach ($res_query->result() as $mid)
									{   
										$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row(); // get menu data
										
										$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id, '.$this->_menu_customization_type.'.customization_type');
									
										$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
										
										$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									
										$this->db->from($this->_menu_customization_type);

										$this->db->join($this->_order_menu_customization_type, "$this->_order_menu_customization_type.customization_type_id = $this->_menu_customization_type.id");	
										
										$res = $this->db->get();
										
										$customization_count = (int) $res->num_rows();
										
										if ($customization_count > 0)
											{
												$options  = array();
												foreach ($res->result() as $rdata)
													{	
														$options['name']                =   $rdata->customization_name;
														$options['customization_type']  =   $rdata->customization_type;
														
														$this->db->select('id, customization_type_id, option_name, price');
														$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
														if ($opt_query->num_rows() > 0)
															{
																foreach ($opt_query->result() as $odata)
																	{
																		$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
																	}
															 }
													}
													
													$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $options);
											}
										else
											{
													$menu_item_array[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
											}
									}
									
								$payment_method = (int) $sdata->payment_method;
								
								switch ($payment_method)
									{
										case 1:
												   $payment  = "Credit Purchase";
												   break;
										case 2:
												   $payment  = "Cash On Delivery";
												   break;
										case 3:
												   $payment  = "Payu";
												   break;	   
									}
									
								 $order_notification = array();

								 $this->db->select('notification');
								 $this->db->order_by('ttime', 'desc');
								 $query_notification = $this->db->get_where($this->_order_notification, array('order_id' => $order_id));
								 if ($query_notification->num_rows() > 0)
									{
										foreach ($query_notification->result() as $res)
										$order_notification[] = $res->notification;
									}
								
								 $info[]   =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'notification' => $order_notification);    												
							 }									
					    }
				}
                                 return $info;
     	}
		
	public function orderServingModule()
		{
			$res  =  "";
		    if (count($this->input->post()) > 0)
			    {	
					 $orderid  =  $this->input->post('orderid');
					 
					 $this->db->select($this->_staff_member.'.name, '.$this->_staff_member.'.pic, '.$this->_staff_member.'.contact_no');
					 $this->db->where($this->_order.'.order_id', $orderid);
					 $this->db->from($this->_order);
					 $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
					 $query = $this->db->get();
					 if ($query->num_rows() > 0)
						 {
							$result = $query->row();
							$res = array('name' => $result->name, 'pic' => (string) $result->pic, 'contact_no' => $result->contact_no, 'orderid' => $orderid);
						 } 
			    }
							return $res;	
		}
		
	public function orderReviewCommentModule()
		{
			if (count($this->input->post()) > 0)
			    {	
					 $comments  =  $this->input->post('comments');
					 $randomid  =  $this->input->post('randomid');
				     $qry       =  $this->db->get_where($this->_order_comment, array('randomid' => $randomid));
					 
					 if ($qry->num_rows() > 0)
						 $this->db->where('randomid', $randomid)->update($this->_order_comment, array('comment' => $comments));
					 else
						 $this->db->insert($this->_order_comment, array('comment' => $comments, 'randomid' => $randomid, 'ttime' => time()));
					 
					     return 1;
			    }
				         return 0;
		}
		
	public function regularOrderCustomizationModule()
		{
			$menu_item_array = array();
			
			if (count($this->input->post()) >= 0)
				{
					$menuid    =  8; //$this->input->post('menuid');
				
					$this->db->select('id, customization_name, customization_type');
					
					$res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $menuid));

					$menu_item_array = array();
							
					if ($res_query->num_rows() > 0)
							{
								foreach ($res_query->result() as $rdata)
									{	
										$this->db->select('id, customization_type_id, option_name, price');
						
										$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->id));

										if ($opt_query->num_rows() > 0)
											{
												$options = array();
												
												$options['name']               		= 	$rdata->customization_name;
												$options['customization_type'] 		= 	$rdata->customization_type;
												
												foreach ($opt_query->result() as $odata)
													{
														$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
													}
											 }
										                $menu_item_array[]     =  array('customization' => $options);
									}
							}				
		        }
			        return $menu_item_array;
		}
		
		
	
	public function filterEstablishmentModule1()
		{	
		    $arr_items  =  array();
		    if (count($this->input->post()) > 0)
			    {
					$branch_id   =  $this->input->post('estabid');
					$user_id     =  $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $branch_id))->row()->userid;
					foreach (array(1, 2) as $category)
						{
								$this->db->select($this->_menu_category.'.main_category, '.$this->_category.'.category_name, '.$this->_menu_items.'.id as mid, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.description, '.$this->_menu_items.'.item_type');
								$this->db->where($this->_menu_category.'.main_category', $category);
								$this->db->where($this->_branch_menu.'.branch_id', $branch_id);
								$this->db->where($this->_menu_category.'.user_id', $user_id);
								$this->db->order_by($this->_menu_category.'.category_id',  'asc');
								$this->db->from($this->_menu_category);
								$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
								$this->db->join($this->_branch_menu, "$this->_branch_menu.menu_id = $this->_menu_items.id");
								$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
								$res = $this->db->get();
								$menu_array   = array();
								foreach ($res->result() as $result)
									{
										$this->db->select('id, customization_name, customization_type');
										$res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $result->mid));
										if ($res_query->num_rows() > 0)
											{
												$opt = array();
												foreach ($res_query->result() as $rdata)
													{	 
													    $options         =  array();
														$options['id']   =  $rdata->id;
														$options['name'] =  $rdata->customization_name;
														$options['customization_type'] = $rdata->customization_type;
														$this->db->select('id, customization_type_id, option_name, price');
														$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->id));
														if ($opt_query->num_rows() > 0)
															{
																foreach ($opt_query->result() as $odata)
																$options['options'][]  =  array('id' => $odata->id, 'option_name' => $odata->option_name, 'price' => $odata->price);
															}
																$opt[] = $options;
													}
													
													$menu_array = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => $opt);
											}
										else
											{
												    $menu_array = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => "");
											}														
													$arr_items[] = $menu_array;
									}
						}					 
				}
												    return $arr_items;
		}
		
		
		
}