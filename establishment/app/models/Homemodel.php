<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homemodel extends CI_Model {
	
	private $_order;
	private $_menu_items;
	private $_order_menu_id;
	private $_order_menu_customization_type;
	private $_order_menu_customization_options;
	private $_menu_customization_type;
	private $_menu_customization_options;
	private $_payment_method;
	private $_order_notification;
	private $_staff_member;
	private $_accounts;
	private $_order_cancel_reason;
	
	private $_userid;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid 						   =   $this->session->userdata('id');
			
			 $this->_order                             =      $this->db->dbprefix('order');
			 $this->_menu_items                        =      $this->db->dbprefix('menu_items');
			 $this->_order_menu_id                     =      $this->db->dbprefix('order_menu_id');
			 $this->_order_menu_customization_type     =      $this->db->dbprefix('order_menu_customization_type');
			 $this->_order_menu_customization_options  =      $this->db->dbprefix('order_menu_customization_options');
			 $this->_menu_customization_type           =      $this->db->dbprefix('menu_customization_type');
			 $this->_menu_customization_options        =      $this->db->dbprefix('menu_customization_options');
			 $this->_payment_method                    =      $this->db->dbprefix('payment_method');
			 $this->_order_notification                =      $this->db->dbprefix('order_notification');
			 $this->_staff_member                      =      $this->db->dbprefix('staff_member');
			 $this->_accounts                          =      $this->db->dbprefix('accounts');
			 $this->_order_cancel_reason               =      $this->db->dbprefix('order_cancel_reason');
			 
		}
		
	public function getHomeAllOrders($establishment_id = '')
		{
			$this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
			$this->db->order_by('order_time', 'desc');
			$start_time  =   mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$end_time    =   mktime(23, 59, 59, date('m'), date('d'), date('Y'));
			$query       =   $this->db->get_where($this->_order, array('establishment_id' => $establishment_id, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time));
			
			$order  	 =  array();
			$sname  	 =  '';
			
			$new_order_count     = 0;
			$pending_order_count = 0;
			
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $sdata)
						{
							$customer_info = $this->db->select('name')->get_where($this->_accounts, array('id' => $sdata->customer_id))->row();
							
							$res_query = $this->db->select('menu_id, qty')->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
							
							$menu_item_array = array();
						
					        $arr	 =   array();	
							
							foreach ($res_query->result() as $mid)
								{ 
									$orders = array();
								
									$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row();
									
									$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id, '.$this->_order_menu_customization_type.'.id as cdid');
									$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
									$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									$this->db->from($this->_order_menu_customization_type);
									$this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.id  = $this->_order_menu_customization_type.customization_type_id");
	
									
									$rs = $this->db->get();
																
									$customization_count = (int) $rs->num_rows();
									
									if ($customization_count > 0)
										{
											$cust       = array();
											foreach ($rs->result() as $rdata)
												{			
													$options  =  array();
													$opt      =  array();
													
													$options['name'] = $rdata->customization_name;
													
													$opt_query = $this->db->get_where($this->_order_menu_customization_options, array('order_menu_cust_primary_id' => $rdata->cdid));
													
													if ($opt_query->num_rows() > 0)
														{
														    foreach ($opt_query->result() as $opt_data)	
																{
																	$opt_query2 = $this->db->get_where($this->_menu_customization_options, array('id' => $opt_data->customization_options))->row();
																	
																	$opt[] = $opt_query2->option_name;
																}
																    $options['options'] = implode (', ', $opt);
																	$cust[] = $options;
														}

													/*$options['name'] = $rdata->customization_name;
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
														 }*/
														 
														 
														 
												}
												
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $cust);
										}
									else
										   {
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
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
													
								        switch ((int) $sdata->status)
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
											 
										$hours      =   floor ($total_time /3600); 
										$minutes    =   intval (($total_time/60) % 60);        
										$seconds    =   intval ($total_time % 60);     
										
										if ($hours > 0) 
										$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

										$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

										$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);
										
										
										if ($sdata->new_order_flag == 0)
									    $new_order_count = $new_order_count + 1;
									
									    if ($sdata->pending_order_flag == 1)
									    $pending_order_count = $pending_order_count + 1;

										if ($sdata->staff_member_id != 0)
										$sname = $this->db->select('name')->get_where($this->_staff_member, array('id' => $sdata->staff_member_id))->row()->name;
									
									    $location = getOrderLocation($sdata->location);
											
										$order['allOrders'][] =  array('oid' => $sdata->order_id, 'pm' => $payment, 'nm' => $customer_info->name, 'loc' => $location, 'otm' => date('h:i:s a, d F Y', $sdata->order_time), 'prc' => $sdata->total_amount, 'cnt' => count($arr), 'ord' => $arr, 'tmr' => $time_diff, 'sts' => $sdata->status, 'nw_ord_flg' => $sdata->new_order_flag, 'snm' => $sname);
										
				        }
				}
				   else
                                        $order['allOrders']	 = array();
									
				
				$order_data_record['orders_info'] 		   =   $order;
				
				/* New Order Pending Order Count */
				
				$order_data_record['new_order_count']      =   $new_order_count;
				$order_data_record['pending_order_count']  =   $pending_order_count;
				
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
		
		
	public function getHomeNewOrders($establishment_id = '')
		{
			$this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
			$this->db->order_by('order_time', 'desc');
			$start_time  =   mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$end_time    =   mktime(23, 59, 59, date('m'), date('d'), date('Y'));
			
			
			$this->db->where(array('establishment_id' => $establishment_id, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time));
			$this->db->where('status', 1);
			
			$query       =   $this->db->get($this->_order);
			$order  	 =   array();
			$sname  	 =   '';
			
			$new_order_count     = 0;
			$pending_order_count = 0;
			
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $sdata)
						{
							$customer_info = $this->db->select('name')->get_where($this->_accounts, array('id' => $sdata->customer_id))->row();
							
							$res_query = $this->db->select('menu_id, qty')->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
							
							$menu_item_array = array();
						
					        $arr	 =   array();	
							
							foreach ($res_query->result() as $mid)
								{ 
									$orders = array();
								
									$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row();
									
									$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id, '.$this->_order_menu_customization_type.'.id as cdid');
									$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
									$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									$this->db->from($this->_order_menu_customization_type);
									$this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.id  = $this->_order_menu_customization_type.customization_type_id");	
									
									$rs = $this->db->get();
																
									$customization_count = (int) $rs->num_rows();
									
									if ($customization_count > 0)
										{
											
											$cust       = array();
											foreach ($rs->result() as $rdata)
												{			
													$options  =  array();
													$opt      =  array();
													
													$options['name'] = $rdata->customization_name;
													
													$opt_query = $this->db->get_where($this->_order_menu_customization_options, array('order_menu_cust_primary_id' => $rdata->cdid));
													
													if ($opt_query->num_rows() > 0)
														{
														    foreach ($opt_query->result() as $opt_data)	
																{
																	$opt_query2 = $this->db->get_where($this->_menu_customization_options, array('id' => $opt_data->customization_options))->row();
																	
																	$opt[] = $opt_query2->option_name;
																}
																    $options['options'] = implode (', ', $opt);
																	$cust[] = $options;
														}

													/*$options['name'] = $rdata->customization_name;
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
														 }*/

												}
												
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $cust);
												
												
												
										}
									else
										   {
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
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

											
										$time_diff    = '';			
								        $total_time   = time() - $sdata->order_time; 
											 
										$hours        =   floor ($total_time /3600); 
										$minutes      =   intval (($total_time/60) % 60);        
										$seconds      =   intval ($total_time % 60);     

										if ($hours > 0) 
										$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

										$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

										$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);
										
										if ($sdata->new_order_flag == 0)
									    $new_order_count = $new_order_count + 1;
									
									    if ($sdata->pending_order_flag == 1)
									    $pending_order_count = $pending_order_count + 1;

										if ($sdata->staff_member_id != 0)
										$sname = $this->db->select('name')->get_where($this->_staff_member, array('id' => $sdata->staff_member_id))->row()->name;
									
									    $location = getOrderLocation($sdata->location);
											
										$order['newOrders'][] =  array('oid' => $sdata->order_id, 'pm' => $payment, 'nm' => $customer_info->name, 'loc' => $location, 'otm' => date('h:i a, d F Y', $sdata->order_time), 'prc' => $sdata->total_amount, 'cnt' => count($arr), 'ord' => $arr, 'tmr' => $time_diff, 'sts' => $sdata->status, 'nw_ord_flg' => $sdata->new_order_flag, 'snm' => $sname);									 
				        }
				}
				   else
                                        $order['newOrders']	 = array();
									
				
				$order_data_record['orders_info'] 		   =   $order;
				
				/* New Order Pending Order Count */
				
				$order_data_record['new_order_count']      =   $new_order_count;
				$order_data_record['pending_order_count']  =   $pending_order_count;
				
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
		
		
	public function getHomePendingOrders($establishment_id = '')
		{
			//$this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
			//$this->db->order_by('order_time', 'desc');
			
			$start_time  =   mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$end_time    =   mktime(23, 59, 59, date('m'), date('d'), date('Y'));
			
			//$this->db->where(array('establishment_id' => $establishment_id, 'order_time >= ' => $start_time, 'order_time <= ' => $end_time));
			//$this->db->where('status', 2);
			//$this->db->or_where('status', 5);
			
			//$query       =   $this->db->get($this->_order);
			
			
			$query       =   $this->db->query("SELECT `order_id`, `customer_id`, `location`, `total_amount`, `order_time`, `payment_method`, `status`, `completion_time`, `cancel_time`, `staff_member_id`, `new_order_flag`, `pending_order_flag`, `user_nudge` FROM `$this->_order` WHERE `establishment_id` = $establishment_id AND `order_time` >= $start_time AND `order_time` <= $end_time AND ((`status` = 2 OR `status` = 5 OR `status` = 1) AND `staff_member_id` != 0) ORDER BY `order_time` DESC");
			
			$order  	 =   array();
			$sname  	 =   '';
			
			$new_order_count     = 0;
			$pending_order_count = 0;
			
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $sdata)
						{
							$customer_info =  $this->db->select('name')->get_where($this->_accounts, array('id' => $sdata->customer_id))->row();
							
							$res_query     =  $this->db->select('menu_id, qty')->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
							
							$menu_item_array = array();
						
					        $arr	 =   array();	
							
							foreach ($res_query->result() as $mid)
								{ 
									$orders = array();
								
									$result = $this->db->get_where($this->_menu_items, array('id' => $mid->menu_id))->row();
									
									$this->db->select($this->_menu_customization_type.'.id, '.$this->_menu_customization_type.'.customization_name, '. $this->_order_menu_customization_type.'.customization_type_id, '.$this->_order_menu_customization_type.'.id as cdid');
									$this->db->where($this->_order_menu_customization_type.'.order_menu_id', $mid->menu_id);
									$this->db->where($this->_order_menu_customization_type.'.order_id', $sdata->order_id);
									$this->db->from($this->_order_menu_customization_type);
									$this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.id  = $this->_order_menu_customization_type.customization_type_id");
									
									
									$rs = $this->db->get();
																
									$customization_count = (int) $rs->num_rows();
									
									if ($customization_count > 0)
										{
											$cust       = array();
											foreach ($rs->result() as $rdata)
												{			
													$options  =  array();
													$opt      =  array();
													
													$options['name'] = $rdata->customization_name;
													
													$opt_query = $this->db->get_where($this->_order_menu_customization_options, array('order_menu_cust_primary_id' => $rdata->cdid));
													
													if ($opt_query->num_rows() > 0)
														{
														    foreach ($opt_query->result() as $opt_data)	
																{
																	$opt_query2 = $this->db->get_where($this->_menu_customization_options, array('id' => $opt_data->customization_options))->row();
																	
																	$opt[] = $opt_query2->option_name;
																}
																    $options['options'] = implode (', ', $opt);
																	$cust[] = $options;
														}

													/*$options['name'] = $rdata->customization_name;
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
														 }*/
														 	 
												}
												
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => $cust);
										}
									else
										   {
												$arr[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'qty' => $mid->qty, 'type' => $result->item_type, 'customization' => array());
										   }
								}
								
										$payment_method = (int) $sdata->payment_method;
										
										$payment = (($payment_method == 1) ? "Credit Purchase" : (($payment_method == 2) ? "Cash On Delivery" : "Payu"));
													
								        $total_time = time() - $sdata->order_time;
										$time_diff	= '';									
											 
										$hours      =   floor ($total_time /3600); 
										$minutes    =   intval (($total_time/60) % 60);        
										$seconds    =   intval ($total_time % 60);     

										if ($hours > 0) 
										$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

										$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

										$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);
										
										if ($sdata->new_order_flag == 0)
									    $new_order_count = $new_order_count + 1;
									
									    if ($sdata->pending_order_flag == 1)
									    $pending_order_count = $pending_order_count + 1;

										if ($sdata->staff_member_id != 0)
										$sname = $this->db->select('name')->get_where($this->_staff_member, array('id' => $sdata->staff_member_id))->row()->name;
									
										$location = getOrderLocation($sdata->location);
											
										$order['pendingOrders'][] =  array('oid' => $sdata->order_id, 'pm' => $payment, 'nm' => $customer_info->name, 'loc' => $location, 'otm' => date('h:i a, d F Y', $sdata->order_time), 'prc' => $sdata->total_amount, 'cnt' => count($arr), 'ord' => $arr, 'tmr' => $time_diff, 'sts' => $sdata->status, 'nw_ord_flg' => $sdata->new_order_flag, 'snm' => $sname);									 
				        }
				}
				   else
                                        $order['pendingOrders']	 = array();
									
				
				$order_data_record['orders_info'] 		   =   $order;
				
				/* New Order Pending Order Count */
				
				$order_data_record['new_order_count']      =   $new_order_count;
				$order_data_record['pending_order_count']  =   $pending_order_count;
				
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
		
		
	public function getCancelledOrders($estabid = '')
		{
			
		    $start_date  =  $this->input->post('start_date');
		    $end_date    =  $this->input->post('end_date');

			$this->db->select($this->_accounts.'.name as sname, '. $this->_accounts.'.email, '.$this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order_cancel_reason.'.reason, '.$this->_accounts.'.contactno, '.$this->_order_cancel_reason.'.user_flag, '.$this->_order_cancel_reason.'.server_flag');

			$this->db->where(array($this->_order.'.status' => 4, $this->_order.'.establishment_id' => $estabid));
			
			if ( ! empty ($start_date) && ! empty ($end_date))
				{
					list ($smonth, $sdate, $syear) = explode ('/', $start_date);
					list ($emonth, $edate, $eyear) = explode ('/', $end_date);
					
					$stime    =  mktime(0, 0, 0, $smonth, $sdate, $syear);
					$etime    =  mktime(23, 59, 59, $emonth, $edate, $eyear);
					
					$this->db->where(array($this->_order.'.order_time >=' => $stime, $this->_order.'.order_time <=' => $etime));
				}
			else
				{
					$stime       =  mktime(0, 0, 0, date('m'), date('d'), date('Y'));
					$etime       =  mktime(23, 59, 59, date('m'), date('d'), date('Y'));
					$this->db->where(array($this->_order.'.order_time >=' => $stime, $this->_order.'.order_time <=' => $etime));
				}
				
					$this->db->from($this->_order);
					
					$this->db->join($this->_accounts, "$this->_accounts.id = $this->_order.customer_id");
					
					$this->db->join($this->_order_cancel_reason, "$this->_order_cancel_reason.order_id = $this->_order.order_id");
					
					$query =  $this->db->get();
					
					if ($query->num_rows() > 0)
						$orderinfo['res'] =  $query->result();
					else
						$orderinfo['res'] =  array();

					
			$this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
			$this->db->order_by('order_time', 'desc');
			
			$query       =   $this->db->get_where($this->_order, array('establishment_id' => $estabid, 'order_time >= ' => $stime, 'order_time <= ' => $etime, 'status' => 4));
			$order  	 =  array();
			$sname  	 =  '';
			
			$new_order_count     = 0;
			$pending_order_count = 0;
			
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $sdata)
						{
							$customer_info = $this->db->select('name')->get_where($this->_accounts, array('id' => $sdata->customer_id))->row();
							
							$res_query = $this->db->select('menu_id, qty')->get_where($this->_order_menu_id, array('order_id' => $sdata->order_id));
							
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
											//$options  =    array();
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
								}
								
										$payment_method = (int) $sdata->payment_method;
										$payment = (($payment_method == 1) ? "Credit Purchase" : (($payment_method == 2) ? "Cash On Delivery" : "Payu"));
																

										$order_time      = $sdata->order_time;
										$cancel_time     = $sdata->cancel_time;
										$time_diff       = "";
										$total_time      = $cancel_time - $order_time;											 
											 
										$hours      =   floor ($total_time /3600); 
										$minutes    =   intval (($total_time/60) % 60);        
										$seconds    =   intval ($total_time % 60);     

										if ($hours > 0) 
										$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

										$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

										$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);
										
										if ($sdata->new_order_flag == 0)
									    $new_order_count = $new_order_count + 1;
									
									    if ($sdata->pending_order_flag == 1)
									    $pending_order_count = $pending_order_count + 1;

										if ($sdata->staff_member_id != 0)
										$sname = $this->db->select('name')->get_where($this->_staff_member, array('id' => $sdata->staff_member_id))->row()->name;
									
										$location = getOrderLocation($sdata->location);
											
										$orderinfo['orders'][] =  array('oid' => $sdata->order_id, 'pm' => $payment, 'nm' => $customer_info->name, 'loc' => $location, 'otm' => date('h:i a, d F Y', $sdata->order_time), 'prc' => $sdata->total_amount, 'cnt' => count($arr), 'ord' => $arr, 'tmr' => $time_diff, 'sts' => $sdata->status, 'nw_ord_flg' => $sdata->new_order_flag, 'snm' => $sname);
										
				        }
				}
				   else
                                        $orderinfo['orders']	 = array();
					
					
					
					                    return $orderinfo;
					
		}
			
}
