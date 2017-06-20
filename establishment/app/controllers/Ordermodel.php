<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordermodel extends CI_Model {

    private $_order;
	private $_menu_items;
	private $_order_menu_id;
	private $_order_menu_customization_type;
	private $_order_menu_customization_options;
	private $_users;
	private $_menu_customization_type;
	private $_menu_customization_options;
	private $_payment_method;
	private $_order_notification;
	private $_staff_member;
	private $_accounts;
	private $_order_cancel_reason;

    public function __construct()
		{
             parent::__construct();
			 
			 $this->_order                             =      $this->db->dbprefix('order');
			 $this->_menu_items                        =      $this->db->dbprefix('menu_items');
			 $this->_order_menu_id                     =      $this->db->dbprefix('order_menu_id');
			 $this->_order_menu_customization_type     =      $this->db->dbprefix('order_menu_customization_type');
			 $this->_order_menu_customization_options  =      $this->db->dbprefix('order_menu_customization_options');
			 $this->_users                             =      $this->db->dbprefix('users');
			 $this->_menu_customization_type           =      $this->db->dbprefix('menu_customization_type');
			 $this->_menu_customization_options        =      $this->db->dbprefix('menu_customization_options');
			 $this->_payment_method                    =      $this->db->dbprefix('payment_method');
			 $this->_order_notification                =      $this->db->dbprefix('order_notification');
			 $this->_staff_member                      =      $this->db->dbprefix('staff_member');
			 $this->_accounts                          =      $this->db->dbprefix('accounts');
			 $this->_order_cancel_reason               =      $this->db->dbprefix('order_cancel_reason');
			
		}
		
		
	public function getOrderHistoryDetails($establid = '')
		{
			$stime   =  mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$etime   =  mktime(23, 59, 59, date('m'), date('d'), date('Y'));
			
			$sttime   =  $this->input->post('start_date');
			$eetime   =  $this->input->post('end_date');
			
			if ($sttime != '' && $eetime != '')
				{
					list ($month, $date, $year) = explode ('/', $sttime);
					$stime   =  mktime(0, 0, 0, $month, $date, $year);
					
					list ($month, $date, $year) = explode ('/', $eetime);
					$etime   =  mktime(23, 59, 59, $month, $date, $year);
				}
				
			
		    $this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
			$this->db->order_by('order_time', 'desc');
			
			$query       =   $this->db->get_where($this->_order, array('establishment_id' => $establid, 'order_time >=' => $stime, 'order_time <=' => $etime));
			$order = array();
			
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $sdata)
						{
							$this->db->select('name');
							$customer_info = $this->db->get_where($this->_accounts, array('id' => $sdata->customer_id))->row();
							
							$this->db->select('menu_id, qty');
							$res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
							$menu_item_array = array();
						
					        $arr	 =   array();	
							foreach ($res_query->result() as $mid)
								{ 
									$orders = array();
								
									$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row();
									
									$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id');
									$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
									$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									$this->db->from($this->_order_menu_customization_type);
									$this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.id  = $this->_order_menu_customization_type.customization_type_id");	
									
									$rs = $this->db->get();
																
									$customization_count = (int) $rs->num_rows();
									
									if ($customization_count > 0)
										{
											//$options  = array();
											$cust       =    array();
											foreach ($rs->result() as $rdata)
												{		

													$options  =  array();
													$opt      =  array();
													
													$options['name'] = $rdata->customization_name;
													$this->db->select('id, customization_type_id, option_name, price');
													$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
													if ($opt_query->num_rows() > 0)
														{
															foreach ($opt_query->result() as $odata)
																{
																	//$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
																	$opt[] = $odata->option_name;
																}
																
																	$options['options'] = implode (', ', $opt);
																	$cust[] = $options;
														 }
												}
												
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $cust);
										}
									else
										   {
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
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
																	$order_time      = $sdata->order_time;
																	$completion_time = $sdata->completion_time;
																	$time_diff       = "";
																	$total_time      = $completion_time - $order_time;
																	break;

														 case 4:
														 
																	$order_time      = $sdata->order_time;
																	$cancel_time     = $sdata->cancel_time;
																	$time_diff       = "";
																	$total_time      = $cancel_time - $order_time;
																	break;
														default:
														
														            $time_diff       = "";
																	$total_time      = time() - $sdata->order_time;   
																	break;
													 }					
																											
											$hours      = floor ($total_time /3600); 
											$minutes    = intval (($total_time/60) % 60);        
											$seconds    = intval ($total_time % 60);     
											
											if ($hours > 0) 
											$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

											$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

											$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);								
								}	

											$order[]   =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d F Y', $sdata->order_time), 'price' => $sdata->total_amount, 'count' => count($arr), 'orders' => $arr, 'time_diff' => $time_diff, 'new_order_flag' => 2, 'sname' => '', 'user_nudge' => 0, 'cid' => $sdata->customer_id, 'stfid' => $sdata->staff_member_id);								
					       }
				}
										   return $order;
		}
		
	public function getCancelSummary($id = '')
		{
		    $this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
			$this->db->order_by('order_time', 'desc');
			$query       =   $this->db->get_where($this->_order, array('order_id' => $id));
			
			$order = array();

			if ($query->num_rows() > 0)
				{
					        $sdata  = $query->row();
							
							$this->db->select('name');
							$customer_info = $this->db->get_where($this->_accounts, array('id' => $sdata->customer_id))->row();
							
							$this->db->select('menu_id, qty');
							$res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
							$menu_item_array = array();
						
					        $arr	 =   array();	
							
							foreach ($res_query->result() as $mid)
								{ 
									$orders = array();
								
									$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row();
									
									$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id');
									$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
									$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									$this->db->from($this->_order_menu_customization_type);
									$this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.id  = $this->_order_menu_customization_type.customization_type_id");	
									
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
												
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $options);
										}
									else
										   {
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
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
											
											
											$order_time      = $sdata->order_time;
											$cancel_time     = $sdata->cancel_time;
						
											$time_diff = "";
											
											$total_time = $cancel_time - $order_time;															
											$hours      = floor ($total_time /3600); 
											$minutes    = intval (($total_time/60) % 60);        
											$seconds    = intval ($total_time % 60);     

											if ($hours > 0) 
											$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

											$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

											$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);
																	
								}
								
										   $order   =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d F Y', $sdata->order_time), 'price' => $sdata->total_amount, 'count' => count($arr), 'orders' => $arr, 'time_diff' => $time_diff, 'new_order_flag' => 2, 'sname' => '', 'user_nudge' => 0, 'cid' => $sdata->customer_id, 'stfid' => $sdata->staff_member_id);
														 
				}
				
										   return $order;
		}
		
		
	public function newOrderBadgeCount($user_id = '')
		{
			$estabid     =  getEstablishmentIdByUserId($user_id);
			$stime       =  mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$etime       =  mktime(23, 59, 59, date('m'), date('d'), date('Y'));
			
			$this->db->where(array('establishment_id' => $estabid, 'order_time >=' => $stime, 'order_time <=' => $etime))->update($this->_order, array('new_order_flag' => 1));
		}	
		
	public function pendingBadgeCount($user_id = '')
		{
			$estabid     =  getEstablishmentIdByUserId($user_id);
			$stime       =  mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$etime       =  mktime(23, 59, 59, date('m'), date('d'), date('Y'));
			
			$this->db->where(array('establishment_id' => $estabid, 'order_time >=' => $stime, 'order_time <=' => $etime))->update($this->_order, array('pending_order_flag' => 2, 'user_nudge' => 2));
		}
			
		
	public function getAllNotifications($user_id = '', $flag = '')
		{
			$estabid     =  getEstablishmentIdByUserId($user_id);
			
			$arr         =  array();
			
			$start_time  =  mktime (0, 0, 0, date('m'), date('d'), date('Y'));
			$end_time    =  mktime (23, 59, 59, date('m'), date('d'), date('Y'));
			
			$this->db->select($this->_order_notification.'.id, '.$this->_order_notification.'.notification, '.$this->_order_notification.'.ttime, '.$this->_order_notification.'.estab_read');
			$this->db->where(array($this->_order.'.establishment_id' => $estabid, $this->_order.'.order_time >=' => $start_time, $this->_order.'.order_time <=' => $end_time, $this->_order_notification.'.estab_read' => 0));
			$this->db->order_by($this->_order_notification.'.ttime', 'desc');
			$this->db->from($this->_order);
			$this->db->join($this->_order_notification, "$this->_order_notification.order_id  = $this->_order.order_id");
			$query = $this->db->get();
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $data)
						{
							$id[]  = $data->id;
							$arr[] = array('notification' => $data->notification, 'time' => date('h:i a', $data->ttime), 'is_read' => $data->estab_read);
						}
						    if ($flag == 1)
							$this->db->where_in('id', $id)->update($this->_order_notification, array('estab_read' => 1));
				}
							return $arr;
		}
		
		
	public function getOrders($estabid = '')
		{	
			$start_date         =  $this->input->post('start_date');
			
			if ($start_date != '')
				{
					list ($month, $date, $year) = explode ('/', $start_date);
					$stime = mktime(0,0,0, $month, $date, $year);
				}
				

			$end_date           =  $this->input->post('end_date');
			
			$data['start_date'] =  $start_date;
			$data['end_date']   =  $end_date;
			
			if ($end_date != '')
				{
					list ($month, $date, $year) = explode ('/', $end_date);
					$etime = mktime(23,59,59, $month, $date, $year);
				}

			$customer_name         =  $this->input->post('customer_name');
			$data['customer_name'] =  $customer_name;
			
			$payment_method         =  $this->input->post('payment_method');
			$data['payment_method'] =  $payment_method;
			
			
			$location          =  $this->input->post('location');
			$data['location']  =  $location;
		    
			$this->db->select($this->_accounts.'.name as sname, '. $this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.status, '.$this->_order.'.total_amount, '.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.location');
			
			$this->db->where($this->_order.'.establishment_id', $estabid);
			
			
			
			if ( $start_date != '' && $end_date != '')
				{
					$this->db->where(array($this->_order.'.order_time >=' => $stime, $this->_order.'.order_time <=' => $etime));
				}
			else
				{
					$stime = mktime(0,0,0, date('m'), date('d'), date('Y'));
					$etime = mktime(23,59,59, date('m'), date('d'), date('Y'));
					$this->db->where(array($this->_order.'.order_time >=' => $stime, $this->_order.'.order_time <=' => $etime));
				}
				
			/*if ( ! empty ($payment_method))
				{
					$this->db->where(array($this->_order.'.payment_method' => $payment_method));
				}
				
			if ( ! empty ($customer_name))
				{
					$this->db->like($this->_accounts.'.name',  $customer_name, 'both');
				}
				
			if ( ! empty ($location))
				{
					$this->db->where(array($this->_order.'.location' => $location));
				}
				*/
				
			
			$this->db->from($this->_order);
			$this->db->join($this->_accounts, "$this->_accounts.id = $this->_order.customer_id");
			$data['result'] =  $this->db->get()->result();
			return $data;
		}
			
		
	public function getAllOrders($establishment_id = '')
		{	
			$this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
			$this->db->order_by('order_time', 'desc');
			$start_time  =   mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$end_time    =   mktime(23, 59, 59, date('m'), date('d'), date('Y'));
			$query       =   $this->db->get_where($this->_order, array('establishment_id' => $establishment_id, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time));

			$order = array();
			$sname = '';
			
			$new_order_count     = 0;
			$pending_order_count = 0;
			
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $sdata)
						{
							$this->db->select('name');
							$customer_info = $this->db->get_where($this->_accounts, array('id' => $sdata->customer_id))->row();
							
							$this->db->select('menu_id, qty');
							$res_query = $this->db->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
							$menu_item_array = array();
						
					        $arr	 =   array();	
							
							foreach ($res_query->result() as $mid)
								{ 
									$orders = array();
								
									$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row();
									
									$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id');
									$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
									$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									$this->db->from($this->_order_menu_customization_type);
									$this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.id  = $this->_order_menu_customization_type.customization_type_id");	
									
									$rs = $this->db->get();
																
									$customization_count = (int) $rs->num_rows();
									
									if ($customization_count > 0)
										{
											//$options  = array();
											$cust       = array();
											
											foreach ($rs->result() as $rdata)
												{
													$options  =  array();
													$opt      =  array();
													
													$options['name'] = $rdata->customization_name;
													$this->db->select('id, customization_type_id, option_name, price');
													$opt_query = $this->db->get_where($this->_menu_customization_options, array('customization_type_id' => $rdata->customization_type_id));
													if ($opt_query->num_rows() > 0)
														{
															foreach ($opt_query->result() as $odata)
																{
																	//$options['options'][]  =  array('option_name' => $odata->option_name, 'price' => $odata->price);
																	$opt[] = $odata->option_name;
																}
																    $options['options'] = implode (', ', $opt);
																	$cust[] = $options;
														 }
												}
												
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $cust);
										}
									else
										   {
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
										   }
										   
										   
										$order_time = $sdata->order_time;
										
										$time_diff = "";

										$total_time = time() - $order_time;     
										$hours      = floor ($total_time /3600); 
										$minutes    = intval (($total_time/60) % 60);        
										$seconds    = intval ($total_time % 60);     

										if ($hours > 0) 
										$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

										$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

										$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);										
									    
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
								}
							
							            if ($sdata->new_order_flag == 0)
									    $new_order_count = $new_order_count + 1;
									
									    if ($sdata->pending_order_flag == 1)
									    $pending_order_count = $pending_order_count + 1;
										
								        if ($sdata->staff_member_id != 0 AND ($sdata->status == 1 OR $sdata->status == 2 OR $sdata->status == 5))
											{
												$sname = $this->db->select('name')->get_where($this->_staff_member, array('id' => $sdata->staff_member_id))->row()->name;
												
												$order['priority'][]    =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d F Y', $sdata->order_time), 'price' => $sdata->total_amount, 'count' => count($arr), 'orders' => $arr, 'time_diff' => $time_diff, 'new_order_flag' => 2, 'sname' => ucwords($sname), 'ostatus' => $sdata->status, 'user_nudge' => $sdata->user_nudge);
											}
										else
											{
												switch ($sdata->status)
													 {
														 case 1:
																	$order['preparation'][] =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d F Y', $sdata->order_time), 'price' => $sdata->total_amount, 'count' => count($arr), 'orders' => $arr, 'time_diff' => $time_diff, 'new_order_flag' => $sdata->new_order_flag, 'sname' => '', 'user_nudge' => 0);
																	break;
																	
														 //case 2:
																	//$order['priority'][]    =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d F Y', $sdata->order_time), 'price' => $sdata->total_amount, 'count' => count($arr), 'orders' => $arr, 'time_diff' => $time_diff);
																	//break;
																	
														 case 3:
																	$order_time      = $sdata->order_time;
																	$completion_time = $sdata->completion_time;
												
																	$time_diff  = "";

																	$total_time = $completion_time - $order_time;     
																	$hours      = floor ($total_time /3600); 
																	$minutes    = intval (($total_time/60) % 60);        
																	$seconds    = intval ($total_time % 60);     

																	if ($hours > 0) 
																	$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

																	$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

																	$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);
																	
																	$order['completed'][]   =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d F Y', $sdata->order_time), 'price' => $sdata->total_amount, 'count' => count($arr), 'orders' => $arr, 'time_diff' => $time_diff, 'new_order_flag' => 2, 'sname' => '', 'user_nudge' => 0);
																	break;
														
														 case 4:
														 
																	$order_time      = $sdata->order_time;
																	$cancel_time     = $sdata->cancel_time;
																	
																	//$order_time = $sdata->cancel_time;
												
																	$time_diff = "";

																	//$total_time = time() - $order_time;  
																	
																	$total_time = $cancel_time - $order_time;															
																	$hours      = floor ($total_time /3600); 
																	$minutes    = intval (($total_time/60) % 60);        
																	$seconds    = intval ($total_time % 60);     

																	if ($hours > 0) 
																	$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

																	$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

																	$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);
																	
																	$order['cancelled'][]   =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d F Y', $sdata->order_time), 'price' => $sdata->total_amount, 'count' => count($arr), 'orders' => $arr, 'time_diff' => $time_diff, 'new_order_flag' => 2, 'sname' => '', 'user_nudge' => 0, 'cid' => $sdata->customer_id, 'stfid' => $sdata->staff_member_id);
																	break;
															
																	/* case 5:
																				$order['threshold'][]   =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d M Y', $sdata->order_time), 'price' => $sdata->total_amount, 'orders' => $arr);
																				break;   
																	*/		
													 } 	 
											}

											
											
									$order['allOrders'][] =  array('orderid' => $sdata->order_id, 'payment_method' => $payment, 'name' => $customer_info->name, 'location' => $sdata->location, 'otime' => date('h:i a, d F Y', $sdata->order_time), 'price' => $sdata->total_amount, 'count' => count($arr), 'orders' => $arr, 'time_diff' => $time_diff, 'status' => $sdata->status, 'new_order_flag' => $sdata->new_order_flag, 'sname' => $sname);											
						}
														 
				}
				
				$order_data_record['orders_info'] = $order;
				
				
				/* New Order Pending Order Count */
				
				$order_data_record['new_order_count']     = $new_order_count;
				$order_data_record['pending_order_count'] = $pending_order_count;
				
			
			    $staff_performance_arr = array();
				$this->db->select('id, name, contact_no, pic, onlinestatus');
				$member_qry  =   $this->db->get_where($this->_staff_member, array('branch_id' => $establishment_id, 'status' => 1));

				foreach ($member_qry->result() as $member_data)
					{
						$order_qry = $this->db->get_where($this->_order, array('staff_member_id' => $member_data->id, 'order_time >=' => $start_time, 'order_time <=' => $end_time, 'completion_time >' => 0));
						$no_of_orders = $order_qry->num_rows();
						$avg_time = 0;
						$price = 0;
						if ($no_of_orders > 0)
							{
								 $total_sec = 0 ;
								 $price     = 0 ;
								 foreach ($order_qry->result() as $order_data)
									 {
										  $diff       =  $order_data->completion_time - $order_data->order_time;
										  $total_sec  =  $total_sec + $diff;
										  $price      =  $price + $order_data->total_amount; 
									 }
									 
									 
								 if ($total_sec <= 59)
								 $avg_time = "00:$total_sec";
                                 
								 if ($total_sec > 59)
									 {
										 $min = intval($total_sec / 60);
										 $sec = $total_sec % 60;
										 $avg_time = "$min:$sec";
									 }
							}
							
						$staff_performance_arr[] =  array('id' => $member_data->id, 'pic' => (string) $member_data->pic, 'online' => (int) $member_data->onlinestatus, 'name' => ucwords($member_data->name), 'nooforders' => $no_of_orders, 'avg_time' => $avg_time, 'price' => $price);
					}

				$order_data_record['staff_info'] = $staff_performance_arr;
				
				return $order_data_record;
		}
	
}
