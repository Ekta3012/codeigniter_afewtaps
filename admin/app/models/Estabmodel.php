<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabmodel extends CI_Model {
    private $_staff_member;
    private $_establishment;
    private $_merchant_estab;
    private $_estabinfo;
	private $_order;
	private $_accounts;
	private $_newadmin;
	private $_merchant_info;
	private $_users;
	private $_order_menu_id;
	private $_menu_category;
	private $_menu_items;
	private $_locality;
	private $_user_locality;
	private $_order_notification;
	


	private $_order_menu_customization_type;
	private $_order_menu_customization_options;
	private $_menu_customization_type;
	private $_menu_customization_options;
	
    public function __construct()
		{
            parent::__construct();
			$this->_staff_member        =   	$this->db->dbprefix('staff_member');
			$this->_establishment       =   	$this->db->dbprefix('establishment');
			$this->_merchant_estab      =   	$this->db->dbprefix('merchant_estab');
			$this->_estabinfo           =   	$this->db->dbprefix('estabinfo');
			$this->_order               =   	$this->db->dbprefix('order');
			$this->_accounts            =   	$this->db->dbprefix('accounts');
			$this->_newadmin            =       $this->db->dbprefix('newadmin');
			$this->_merchant_info       =	    $this->db->dbprefix('merchant_info');
			$this->_users               =	    $this->db->dbprefix('accounts');
			$this->_order_menu_id       =	    $this->db->dbprefix('order_menu_id');
			$this->_menu_category       =	    $this->db->dbprefix('menu_category');
			$this->_menu_items          =	    $this->db->dbprefix('menu_items');
			$this->_locality            = 	    $this->db->dbprefix('locality');
			$this->_user_locality       = 	    $this->db->dbprefix('user_locality');
			$this->_order_notification  =       $this->db->dbprefix('order_notification');

			$this->_order_menu_customization_type     =      $this->db->dbprefix('order_menu_customization_type');
			$this->_order_menu_customization_options  =      $this->db->dbprefix('order_menu_customization_options');
			$this->_menu_customization_type           =      $this->db->dbprefix('menu_customization_type');
			$this->_menu_customization_options        =      $this->db->dbprefix('menu_customization_options');
			 
			
			/*$this->_userid   =  (int) $this->session->userdata('adminid');
			 if ($this->_userid === 0)
			 redirect(base_url());*/
			
		}
		
		
	public function getOrderHistoryDetails()
		{
			$name          =   $this->input->post('res_name');
			$ids           =   "";

			if (! empty($name))
				{
					$this->db->select("GROUP_CONCAT(id SEPARATOR ',') as ids");
					$this->db->like('name', $name);
					$search_query =  $this->db->get($this->_establishment);
					$ids = $search_query->row()->ids;
				}
				
			//$this->db->like('');
			
			
			$stime    =  mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$etime    =  mktime(23, 59, 59, date('m'), date('d'), date('Y'));
			
		    $this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
			$this->db->order_by('order_time', 'desc');
			
			if (! empty($name))
				{
					$ids_arr = explode (',', $ids);
					if (count($ids_arr) > 0)
						$this->db->where_in('establishment_id', $ids_arr);
					else
						$this->db->where_in('establishment_id', array());
				}	
			
			$query         =   $this->db->get($this->_order);		
			$order         =   array();
		
		
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
		
	public function getAllNotifications($user_id = '')
		{
			$arr         =  array();
			$start_time  =  mktime (0, 0, 0, date('m'), date('d'), date('Y'));
			$end_time    =  mktime (23, 59, 59, date('m'), date('d'), date('Y'));
			
			$this->db->select($this->_order_notification.'.id, '.$this->_order_notification.'.notification, '.$this->_order_notification.'.ttime, '.$this->_order_notification.'.estab_read');
			$this->db->where(array($this->_order.'.order_time >=' => $start_time, $this->_order.'.order_time <=' => $end_time));
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
						    //$this->db->where_in('id', $id)->update($this->_order_notification, array('estab_read' => 1));
				}
							return $arr;
		}
		
		
	public function filterDataUserMdodule()
		{
			 $locality_id = $this->input->get('locality_id');
			 
			 if ( ! empty ($locality_id))
				 {
					 $this->db->select($this->_accounts.'.id, '.$this->_accounts.'.name, '.$this->_accounts.'.email, '.$this->_accounts.'.contactno');
 
					 $this->db->where($this->_user_locality.'.locality_id', $locality_id);
					 $this->db->from($this->_user_locality);
					 $this->db->join($this->_accounts, "$this->_accounts.id = $this->_user_locality.userid");
					 $data  = $this->db->get();
					 if ($data->num_rows() > 0)
						 {
							 foreach ($data->result() as $cdata)
								 {
									 $locality = getUserLocality($cdata->id);
									 $arr = array('id' => $cdata->id, 'name' => $cdata->name, 'locality' => $locality, 'email' => $cdata->email, 'contactno' => $cdata->contactno);
									 $array[] = $arr;
								 }
						 }
						             return $array;
				 }
		}
		
		
	public function allLocation()
		{
			return $this->db->select('id, locality')->get($this->_locality)->result();
		}
		
		
		/*home screen code start*/
	public function estabFlag()
		{ 
				/*$this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.customer_id, '.$this->_order.'.establishment_id, '.$this->_establishment.'.name as estabname,'.$this->_establishment.'.address as estabaddress, '.$this->_establishment.'.id as estabid');
				$this->db->group_by($this->_establishment.'.id');
				$this->db->from($this->_establishment);

				$this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");

				$order           =  $this->db->get()->result();
				$data['orders']  = 	$order;
				$data['estab']   = 	array();
				if (count($data['orders']) > 0)
					{
						foreach ($data['orders'] as $order_data)
							{
								$this->db->select('order_id,order_time,location,payment_method,total_amount,status,establishment_id,customer_id');
								$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('establishment_id' => $order_data->estabid))->result();
								$this->db->select('name');
								$data['cust_name'][$order_data->customer_id] = $this->db->get_where($this->_users, array('id' => $order_data->customer_id))->result();
							}
					}
				*/
				
				$this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.customer_id, '.$this->_order.'.establishment_id, '.$this->_establishment.'.name as estabname,'.$this->_establishment.'.address as estabaddress, '.$this->_establishment.'.id as estabid, '.$this->_accounts.'.name as customer_name');
				
				//$this->db->group_by($this->_establishment.'.id');
				
				//$this->db->from($this->_establishment);

				$this->db->from($this->_establishment); 
				
				$this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");
				
				$this->db->join($this->_accounts, "$this->_accounts.id = $this->_order.customer_id");
				
				return $this->db->get()->result();
		}
		
		public function searchestabFlag()
		{ 
		
		       /*$search =  	$this->input->post('res_name');
			 $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.customer_id, '.$this->_order.'.establishment_id, '.$this->_establishment.'.name as estabname,'.$this->_establishment.'.address as estabaddress, '.$this->_establishment.'.id as estabid');
			   $this->db->group_by($this->_establishment.'.id');
			  $this->db->from($this->_establishment); 
			  $this->db->like($this->_establishment.'.name',$search);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");
			 $order =  $this->db->get()->result();
			 $data['orders'] 	= 	$order;
			 $data['estab']    	= 	array();
				if (count($data['orders']) > 0)
					{
						foreach ($data['orders'] as $order_data)
							{
							
							
								$this->db->select('order_id,order_time,location,payment_method,total_amount,status,establishment_id');
								$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('establishment_id' => $order_data->estabid))->result();
								
								$this->db->select('name');
								$data['cust_name'][$order_data->customer_id] = $this->db->get_where($this->_users, array('id' => $order_data->customer_id))->result();
							}
					}
					
				return $data;*/
				
		}
		/*home screen code end*/
		public function orderhistorydetails($order_id='')
		{
			  $this->db->select($this->_order_menu_id.'.menu_id, '.$this->_order_menu_id.'.qty, '.$this->_menu_items.'.item_name, '.$this->_order.'.order_id, '.$this->_menu_items.'.price, '.$this->_menu_category.'.menu_id as menuid, '.$this->_menu_items.'.item_type');
			  
			  $this->db->from($this->_order_menu_id);
			  $this->db->join($this->_order, "$this->_order.order_id = $this->_order_menu_id.order_id");
			  $this->db->join($this->_menu_category, "$this->_menu_category.menu_id = $this->_order_menu_id.menu_id");
			  $this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
			  $this->db->where($this->_order.'.order_id', $order_id);
			
			 $order =  $this->db->get()->result();
			 
			 $data['orders'] 	= 	$order;
			  /* $data['estab']    	= 	array();
				 if (count($data['orders']) > 0)
					{
						foreach ($data['orders'] as $order_data)
							{
								$this->db->select('id,name');
								$data['estab'] = $this->db->get_where($this->_establishment, array('id' => $order_data->establishment_id))->result();
							}
					}
			  */
					
			  //print_r($data['orders']); die();
					
				return $data;

		}
	
		
    public function allEstab()
		{
			 $this->db->select($this->_establishment.'.name as estab_name, '.$this->_establishment.'.address as estab_address, '.$this->_merchant_estab.'.estabid as est, '.$this->_establishment.'.estab_id, '.$this->_merchant_estab.'.userid, '.$this->_users.'.id as user_id, '.$this->_establishment.'.id as eid,'.$this->_establishment.'.address, '.$this->_establishment.'.phoneno, '.$this->_users.'.name, '.$this->_estabinfo.'.primary_email as email');
			
			 $this->db->from($this->_merchant_estab);
			 $this->db->join($this->_establishment, "$this->_establishment.id = $this->_merchant_estab.estabid");
			 $this->db->join($this->_estabinfo, "$this->_estabinfo.estabid    = $this->_merchant_estab.estabid");
			 $this->db->join($this->_users, "$this->_users.id = $this->_merchant_estab.userid");
			 return $this->db->get()->result();
			 
		}
		
		/*Service end user start*/
		public function allServiceEndUser()
		{
			 $this->db->select($this->_establishment.'.name as estabname,'.$this->_establishment.'.estab_id,'.$this->_merchant_estab.'.userid,'.$this->_establishment.'.address,'.$this->_establishment.'.id,'.$this->_users.'.name,'.$this->_users.'.email,'.$this->_users.'.mobile');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_establishment);
			$this->db->join($this->_merchant_estab, "$this->_merchant_estab.estabid = $this->_establishment.id");
			 $this->db->join($this->_users, "$this->_users.id = $this->_merchant_estab.userid");
			 $this->db->where($this->_merchant_estab.'.main', 1);
			  $service =  $this->db->get()->result();
			  $data['services'] = $service;
			
			 return $data; 
			 // print_r($data['services']);
			  
		}
		
		
		 public function getservicefilter()
			{
			
				$estabid = $this->uri->segment('3');
			
				if ( ! empty($estabid))
					{
						  /*$this->db->select($this->_establishment.'.name as estabname,'.$this->_establishment.'.estab_id,'.$this->_merchant_estab.'.userid,'. $this->_merchant_estab.'.estabid,'.$this->_establishment.'.address,'.$this->_establishment.'.id,'.$this->_staff_member.'.name,'.$this->_staff_member.'.email_id,'.$this->_staff_member.'.contact_no');
						  //$this->db->where($this->_merchant_estab.'.userid', $userid);
						  $this->db->where($this->_merchant_estab.'.estabid', $estabid);
						  $this->db->from($this->_merchant_estab);
						  $this->db->join($this->_establishment, "$this->_establishment.id = $this->_merchant_estab.estabid");
						  $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_establishment.staff_member_id");
						  
						  //$this->db->join($this->_users, "$this->_users.id = $this->_merchant_estab.userid");
						  
						  $service =  $this->db->get()->result();
						  $data['services'] = $service;*/
						  
						  
						  $this->db->select($this->_establishment.'.name as estabname,'.$this->_establishment.'.estab_id,'.$this->_establishment.'.address,'.$this->_establishment.'.id, '.$this->_staff_member.'.name,'.$this->_staff_member.'.email_id,'.$this->_staff_member.'.contact_no, '.$this->_staff_member.'.id as sid, '.$this->_staff_member.'.employee_id');
						  $this->db->where($this->_establishment.'.id', $estabid);
						  $this->db->from($this->_establishment);
						  $this->db->join($this->_staff_member, "$this->_staff_member.branch_id = $this->_establishment.id");
						  $service =  $this->db->get()->result();
						  $data['services'] = $service;
						  
					}
				else
					{
						  /*$this->db->select($this->_establishment.'.name as estabname,'.$this->_establishment.'.estab_id,'.$this->_merchant_estab.'.userid,'.$this->_establishment.'.address,'.$this->_establishment.'.id,'.$this->_staff_member.'.name,'.$this->_staff_member.'.email_id,'.$this->_staff_member.'.contact_no');
						  //$this->db->where($this->_merchant_estab.'.userid', $userid);
						  $this->db->from($this->_establishment);
						  $this->db->join($this->_merchant_estab, "$this->_merchant_estab.estabid = $this->_establishment.id");
						  $this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_establishment.staff_member_id");
						  //$this->db->join($this->_users, "$this->_users.id = $this->_merchant_estab.userid");
						  //$this->db->where($this->_merchant_estab.'.main', 1);
						  $service =  $this->db->get()->result();
						  $data['services'] = $service;*/
						  
						  $this->db->select($this->_establishment.'.name as estabname,'.$this->_establishment.'.estab_id,'.$this->_establishment.'.address,'.$this->_establishment.'.id, '.$this->_staff_member.'.name,'.$this->_staff_member.'.email_id,'.$this->_staff_member.'.contact_no, '.$this->_staff_member.'.id as sid, '.$this->_staff_member.'.employee_id');
						  $this->db->from($this->_establishment);
						  $this->db->join($this->_staff_member, "$this->_staff_member.branch_id = $this->_establishment.id");
						  $service =  $this->db->get()->result();
						  $data['services'] = $service;
						  
					}
					  
						   return $data; 
			}
		
	/*Service end user end*/	
		public function allFrontEndUser()
		{
			  $this->db->select($this->_accounts.'.name,  '.$this->_accounts.'.id,'.$this->_accounts.'.email, '.$this->_accounts.'.contactno, '.$this->_accounts.'.location');
		
			  $this->db->from($this->_accounts);
			  $this->db->where($this->_accounts.'.status', 1);
			  return $this->db->get()->result();
		}
		public function deleteEstab($id= '')
		{
			
			$this->db->where('id', $id);
			$this->db->delete($this->_accounts);
			redirect('establishment/front');
			
			
		}
		public function deleteServiceApp($id = '', $eid = '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_staff_member);
			redirect('establishment/service/'.$eid);
			
		}
		public function deleteEstabRegistrd($id= '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_establishment, array('id' => $id));
			$this->db->delete($this->_estabinfo, array('estabid' => $id));
			$this->db->delete($this->_merchant_estab, array('estabid' => $id));
		
			redirect('establishment/registerd');
			
			
		}
		/*newadmin code start*/
		public function addUpdateadmin($id = '')
			{
				$this->load->helper('string');
				$data['name']  						=  	$this->input->post('name');
				$data['email']  					=  	$this->input->post('email');
				$data['permission']  		        =  	implode (',', $this->input->post('user_perm'));
				$pass['password']                   =   random_string('alnum', 7);
				$data['password']  		            =   sha1($pass['password']);
		
				if ($id != FALSE)
					{
						$this->db->where('id', $id);
						$this->db->update($this->_newadmin, $data);
					}
				else
					{
							$result = $this->db->insert($this->_newadmin, $data);
							if ( $result )
								{
									$this->load->library('email');
									$this->email->from('info@afewtaps.com', 'Your Name');
									$this->email->to($data['email']); 
									$this->email->subject('Thanks for regstering');
									$this->email->message('Thank you!  Your password Will be - '.$pass['password'].'.... If you want to your password then login your account for change password...');   
									$this->email->send();
								}
									$this->session->set_flashdata('New_admin', 'New_admin');
					}
									redirect('establishment/viewadmin');
	     	}
		
		public function getAdminInfo($id = '')
			{
				return $this->db->get_where($this->_newadmin, array('id' => $id))->row();
			}
		
		
		public function admindetails()
			{
				 $this->db->select($this->_newadmin.'.name,  '.$this->_newadmin.'.id,'.$this->_newadmin.'.email, '.$this->_newadmin.'.permission');
			
				  $this->db->from($this->_newadmin);
				  $this->db->where($this->_newadmin.'.status', 1);
				  return $this->db->get()->result();
			}
			
			
		public function deleteAdmin($id= '')
			{
				$this->db->where('id', $id);
				$this->db->delete($this->_newadmin);
				redirect('establishment/viewadmin');
			}
		
		public function editadmin($id= '')
		{
			 $this->db->select($this->_newadmin.'.name,  '.$this->_newadmin.'.id,'.$this->_newadmin.'.email, '.$this->_newadmin.'.permission');
		
			  $this->db->from($this->_newadmin);
			  $this->db->where($this->_newadmin.'.id', $id);
			  return $this->db->get()->result();
		}
		/*newadmin code end*/
		
		public function checkFrontEndUser($id = '')
		{
			return  $this->db->get_where($this->_accounts, array('id' => $id))->num_rows();
		}
		
		public function checkServiceEndUser($id = '')
			{
				return  $this->db->get_where($this->_users, array('id' => $id))->num_rows();
			}
			
		public function checkServiceEndUser1($id = '')
			{
				return (int) $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $id))->row()->userid;
			}
		
		public function checkEstabRegUser($id = '')
		{
			return  $this->db->get_where($this->_users, array('id' => $id))->num_rows();
		}
		
		public function getFrontEndUserById($id = '')
		{
			$user_menu_exist  =  $this->db->get_where($this->_accounts, array('id' => $id))->num_rows();
			if ($user_menu_exist > 0)
				{
			  $this->db->select('name,id,email,contactno,location');
		    $data['userdata']    =  $this->db->get_where($this->_accounts, array('id' => $id))->row();
		
			  }
			  return $data;
		}
		
	public function getServiceEndUserById($id = '')
		{
			$user_menu_exist  =  $this->db->get_where($this->_users, array('id' => $id))->num_rows();
			if ($user_menu_exist > 0)
				{
					$this->db->select('name,id,email,contactno');
					$data['userdata']    =  $this->db->get_where($this->_users, array('id' => $id))->row();
				}
			return $data;
		}
		
	
	public function getServiceEndUserById1($id = '')
		{
			$data   =  '';
			$query  =  $this->db->select('id, name, email_id, contact_no')->get_where($this->_staff_member, array('id' => $id));
			if ($query->num_rows() > 0)
				{
					$data['userdata']    =  $query->row();
				}
			return $data;
		}
		
		
		public function getEstabRegUserById($id = '')
		{
			$user_menu_exist  =  $this->db->get_where($this->_users, array('id' => $id))->num_rows();
			if ($user_menu_exist > 0)
				{
			  $this->db->select('name,id,email');
		    $data['userdata']    =  $this->db->get_where($this->_users, array('id' => $id))->row();
		
			  }
			  return $data;
		}
		
		public function updateFrontEndUser($id = '')
		{

			$name         		=  	$this->input->post('name');
			//$locality      		=  	$this->input->post('locality');
			$email          		=  $this->input->post('email');
			
		     //$this->input->post('category');
			//die($category);
			$contactno         		=  	$this->input->post('contactno');
			$locality         		=  	$this->input->post('locality');
			
			$mdata['name']               =    $name;		
			$mdata['email']                   =    $email;	
			$mdata['contactno']             =    $contactno;	
			$mdata['location']             =    $locality;	
			
			$mdata['date']           =    time();
			
			//echo $customization_type;
			//die();
			$this->db->where('id', $id);
			$this->db->update($this->_accounts, $mdata);
				$this->session->set_flashdata('front_user_edit', 'front_user_edit');
			redirect('establishment/front');
			
		}
		public function updateServiceEndUser($id = '', $eid = '')
		{

			$name         		=  	$this->input->post('name');
			//$locality      		=  	$this->input->post('locality');
			$email          		=  $this->input->post('email_id');
			
		     //$this->input->post('category');
			//die($category);
			$contactno         		=  	$this->input->post('contact_no');
			
			$mdata['name']               =    $name;		
			$mdata['email']                   =    $email;	
			$mdata['contactno']             =    $contactno;	
			
			//$mdata['date']           =    time();
			
			//echo $customization_type;
			//die();
			$this->db->where('id', $id);
			$this->db->update($this->_users, $mdata);
			$this->session->set_flashdata('service_user_edit', 'service_user_edit');
			redirect('establishment/service/'.$eid);
			
		}
		
		
		public function updateServiceEndUser1($id = '', $eid = '')
		{

			$name         		=  	$this->input->post('name');
			//$locality      		=  	$this->input->post('locality');
			$email          		=  $this->input->post('email_id');
			
		     //$this->input->post('category');
			//die($category);
			$contactno         		=  	$this->input->post('contact_no');
			
			$mdata['name']               =    $name;		
			$mdata['email_id']                   =    $email;	
			$mdata['contact_no']             =    $contactno;	
			
			//$mdata['date']           =    time();
			
			//echo $customization_type;
			//die();
			$this->db->where('id', $id);
			$this->db->update($this->_staff_member, $mdata);
			$this->session->set_flashdata('service_user_edit', 'service_user_edit');
			redirect('establishment/service/'.$eid);
			
		}
		
		
		public function updateEstabRegUser($id = '')
		{

			$name         		=  	$this->input->post('name');
		
			$email          		=  $this->input->post('email_id');
			
			$mdata['name']               =    $name;		
			$mdata['email']                   =    $email;	
		
			$this->db->where('id', $id);
			$this->db->update($this->_users, $mdata);
			$this->session->set_flashdata('Estab_Reg_edit', 'Estab_Reg_edit');
			redirect('establishment/registerd');
			
		}
		
		
		
}

		

