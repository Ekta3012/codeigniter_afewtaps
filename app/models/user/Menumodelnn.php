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
		}
		
		
	public function searchEstab()
		{
			 $result = array();
		     if (count($this->input->post()) > 0)
				{
					$name = $this->input->post('name');
					$this->db->like('name', $name, 'after');
					$query  =  $this->db->get($this->_establishment);
					
					if ($query->num_rows() > 0)
						{
							foreach ($query->result() as $result_data)
								{
									$code_qry = $this->db->get_where($this->_coupon, array('estabid' => $result_data->id, 'status' => 1));
									$code     = ($code_qry->num_rows() > 0) ? $code_qry->row()->off : ''; 
									$result[] = array('id' => $result_data->id, 'name' => $result_data->name, 'logo' => (string) $result_data->logo, 'cover_image' => (string) $result_data->cover_image, 'address' => $result_data->address, 'off' => (string) $code);
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
		
	public function getTaxModule()
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
		
	public function couponEstabModule()
		{
			$result = array();
			if (count($this->input->post()) > 0)
				{
					$estabid      =  3; // $this->input->post('estabid');
					
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
			if (count($this->input->post()) >= 0)
				{
					$estabid        =  1;  //$this->input->post('estabid');
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
			$this->db->select('locality');
			$locality =  $this->db->get($this->_locality);
			foreach ($locality->result() as $locality_data)
			$loc[] = $locality_data->locality;	
			return $loc;
		}
		
	public function filterEstablishmentModule()
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
			$info  =  array();
		    if (count($this->input->post()) >= 0)
			    {		
				   $customer_id    =  1;//(int) $this->input->post('customer_id');

				   $start_time     =   mktime (0, 0, 0, date('m'), date('d'), date('Y'));
					
				   $end_time       =   mktime (23, 59, 59, date('m'), date('d'), date('Y'));
			
				   $this->db->where(array('customer_id' => $customer_id, 'status' => 3));
				   
				   $this->db->order_by('order_time', 'desc');

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
														$options['name'] = $rdata->customization_name;
														$options['customization_type'] = $rdata->customization_type;

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
								 $this->db->order_by('ttime', 'desc');
								 $query_notification = $this->db->get_where($this->_order_notification, array('order_id' => $sdata->order_id));
								 if ($query_notification->num_rows() > 0)
									{
										foreach ($query_notification->result() as $res)
										$order_res[] = $res->notification;
									}
									
								 $info[]   =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array, 'notification' => $order_res);    												
							 }									
					    }
				}
                                return $info;
		}
		
		
	public function userOrderCancelModule()
		{
			if (count($this->input->post()) > 0)
				{
					$orderid    =    $this->input->post('orderid');
					$this->db->where(array('order_id' => $orderid, 'status !=' => 3));
					$query = $this->db->get($this->_order);
					if ($query->num_rows() > 0)
					   {
							$this->db->where('order_id', $orderid);
							$this->db->update($this->_order, array('status' => 4, 'cancel_time' => time()));
							
							/* order cancel summary */
							
							$flag  =  (int) $this->input->post('flag');
							switch ($flag)
								{
									case 1:
									         $reason = "I have left the venue";
											 break;
									case 2:
									         $reason = "I want to order something else";
											 break;
									case 3:
									         $reason = $this->input->post('reason');
											 break;
								}
							$data['reason']   =  $reason;
							$data['order_id'] =  $orderid;
							$data['ctime']    =  time();
							$this->db->insert($this->_order_cancel_reason, $data);

							/* close */
							 
							if ($this->db->affected_rows() > 0)
								$response = array('status' => 'true', 'msg' => 'Success');
							else
								$response = array('status' => 'false', 'msg' => 'Server Error');

							 /* Send Order Cancel Notification to Server */
							 
								 $this->db->select($this->_staff_member.".device_token");
								 $this->db->where($this->_order.'.order_id', $orderid);
								 $this->db->from($this->_order);
								 $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
								 $device_token = $this->db->get()->row()->device_token;
								 if ( ! empty($device_token))
									 {
										 require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Gcm.php');
										 $gcm  =  new Gcm();
										 $msg  =  "Order #$orderid has been cancelled due to following reason(s): $reason";
										 $gcm->sendNotification($device_token, $msg); 
									 }
							 /* Close */
							
							
							/* Send cancel order mail to user */
							
							 $this->db->select($this->_accounts.".email, ".$this->_accounts.".contactno");
							 $this->db->where($this->_order.'.order_id', $orderid);
							 $this->db->from($this->_order);
							 $this->db->join($this->_accounts, "$this->_accounts.id = $this->_order.customer_id");
							 $cqry = $this->db->get();
							 $email       =   $cqry->email;
							 $contactno   =   $cqry->contactno;
							 if ( ! empty($email))
								 {
									$this->email->from(config('from_email'), config('from_name'));
									$this->email->to($email);
									$this->email->subject('AFewTaps - Order Cancel');
									$this->email->message("Order #$orderid has been cancelled due to the following reason(s): $reason");
									$this->email->send(); 
								 }
							/* close email */
							
							/* Send SMS */
							
							if ( ! empty(contactno))
								{
									require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Sms.php');
									$msg = "Order #$orderid has been cancelled due to the following reason(s): $reason";
									Sms::sendMessage($contactno, $msg);
								}
								
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
	
	public function getMenuItemsModule($branchid = 1)
		{	
		    $arr    =  array();
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
												foreach ($res_query->result() as $rdata)
													{	
														$options         =  array();
														$options['name'] =  $rdata->customization_name;
														$options['customization_type'] = $rdata->customization_type;
														$this->db->select('id, customization_type_id, option_name, price');
														$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->id));
														if ($opt_query->num_rows() > 0)
															{
																foreach ($opt_query->result() as $odata)
																$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
															}
															 
														$menu_array = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => $options);
													}
											}
										else
											{
														$menu_array = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => "");
											}
														$main_category = ($result->main_category == 1) ? 'Food' : 'Drinks';
														$esab_items[$main_category][$result->category_name][]  = $menu_array;
									}
						}
														foreach (array('Food', 'Drinks') as $category_value)
															{
																foreach ($esab_items[$category_value] as $sub_cat => $item_arr)
																	 {
																		 $json_arr = array();
																		 $json_arr['subcat']     = $sub_cat;
																		 $json_arr['items']      = $item_arr;
																		 $arr[$category_value][] = $json_arr;
																	 }
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
			if (count($this->input->post()) >= 0)
				{
					$branch_id = 1;  //$this->input->post('branch_id');
					
					/*$location  = array();
					$this->db->select('location');
					$result = $this->db->get_where($this->_estab_location, array('branch_id' => $branch_id));
					if ($result->num_rows() > 0)
						{
							foreach ($result->result() as $res)
							$location[] = $res->location;
						}
					*/
					
					$location = array();
					$cinema_audi_qry  =  $this->db->get_where($this->_cinema_audi, array('cinema_id' => $branch_id));
					if ($cinema_audi_qry->num_rows() > 0)
						{
							foreach ($cinema_audi_qry->result() as $cinema_audi_data)
								{
									$arr = array();
									$cinema_rows_qry  =  $this->db->get_where($this->_cinema_rows, array('cinema_audi_id' => $cinema_audi_data->id));
									if ($cinema_rows_qry->num_rows() > 0)
										{
											foreach ($cinema_rows_qry->result() as $cinema_rows_data)
												{
													$result = [];	
													$result['data']['row_no'] =  $cinema_rows_data->row_no;
													
													$cinema_seats_qry  =  $this->db->get_where($this->_cinema_seats, array('cinema_rows_id' => $cinema_rows_data->id, 'status' => 1));
													$seats = array();
													if ($cinema_seats_qry->num_rows() > 0)
														{
															foreach ($cinema_seats_qry->result() as $cinema_seats)
																{
																	$seats[] = $cinema_seats->seats_no;
																}													
												        }
													
													$result['data']['seats'] =  $seats;
													$arr[] = $result;
													$location[$cinema_audi_data->audi_id] =  $arr;
								                }
						                }
								}						
						}
						
					$resp  =  array();
					$floor_qry = $this->db->get_where($this->_restaurants_floor, array('estab_id' => $branch_id));
					if ($floor_qry->num_rows() > 0)
						{
							 foreach ($floor_qry->result() as $res)
								 {
									$loc_array = array(); 
									$loc =  $this->db->get_where($this->_restaurants_location, array('restaurant_floor_id' => $res->id));
									if ($loc->num_rows() > 0)
										{
											$loc_arr = array();
											foreach ($loc->result() as $ldata)
												{
													$loc_arr[] = array('name' => $ldata->location_name, 'flag' => $ldata->form);
												}
										}
													$loc_array[$res->floor_id] = $loc_arr;
													$resp[] = $loc_array;
								 }
						}
					
					$data['data'] = $resp;
						
					$payment_method = '';	
					$this->db->select('payment_method, info');
					$result_qry = $this->db->get_where($this->_payment_method, array('branch_id' => $branch_id));
					if ($result_qry->num_rows() > 0)
						{
							$res             = $result_qry->row();
							$payment_method  = $res->payment_method;
							$info            = $res->info;
						}	
					return array('audi' => $location, 'floor' => $data, 'payment' => explode (',', $payment_method), 'delivery' => $info);
				}
				    return;
		}
		
		
	public function orderHistoryModule()
		{
			$info  =  array();
		    if (count($this->input->post()) > 0)
			    {		
				   $estab_id    =  (int) $this->input->post('estab_id');
				   $query   =  $this->db->get_where($this->_order, array('establishment_id' => $estab_id, 'status' => 3));
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
														$options['name'] = $rdata->customization_name;
														$options['customization_type'] = $rdata->customization_type;
														
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
								
								$info[]   =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array);    												
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
					
					$this->db->select('reply');
					$this->db->order_by('id', 'desc');
					$this->db->where('reply !=', '');
					return $this->db->get_where($this->_estab_rating, array('userid' => $userid, 'estabid' => $estabid))->row()->reply;
				}
			else
				    return '';
		}
		
		
		
	public function orderPlacedModule()
	    {
		    $info  =  array();
		    if (count($this->input->post()) > 0)
			    {		
				   $estab_id    =  (int) $this->input->post('estab_id');
				   $query   =  $this->db->get_where($this->_order, array('establishment_id' => $estab_id, 'status' => 3));
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

								 $query    =  $this->db->update($this->_order, array('establishment_id' => $estab_id, 'status' => 4));
								
								 $info[]   =   array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'menu' => $menu_item_array);    												
							 }									
					    }
				}
                                 return $info;
     	}
		
	public function orderServingModule()
		{
			$res  =  array();
		    if (count($this->input->post()) > 0)
			    {	
					 $orderid = $this->input->post('orderid');
				 
					 $this->db->select($this->_staff_member.'.name, '.$this->_staff_member.'.pic, '.$this->_staff_member.'.contact_no');
					 $this->db->where($this->_order.'.order_id', $orderid);
					 $this->db->from($this->_order);
					 $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id");
					 
					 $query = $this->db->get();
					 if ($query->num_rows() > 0)
						 {
							$result = $query->row();
							$res = array('name' => $result->name, 'pic' => $result->pic, 'contact_no' => $result->contact_no);
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
}