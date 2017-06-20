<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localitymodel extends CI_Model {


     
    private $_establishment;
   
    private $_estabinfo;
	private $_order;
	private $_estab_rating;
	private $_users;
	private $_staff_member;
	private $_menu_items;
	private $_merchant_estab;
	private $_menu_category;

	private $_order_menu_id;
	private $_accounts;
	
   
    public function __construct()
		{
			parent::__construct();
		 
		
			$this->_establishment    =   $this->db->dbprefix('establishment');
			
			$this->_estabinfo         =   $this->db->dbprefix('estabinfo');
			$this->_order             =   $this->db->dbprefix('order');
			$this->_estab_rating      =   $this->db->dbprefix('estab_rating');
			$this->_users             =   $this->db->dbprefix('users');
			$this->_staff_member      =   $this->db->dbprefix('staff_member');
			$this->_menu_items        =   $this->db->dbprefix('menu_items');
			$this->_merchant_estab    =   $this->db->dbprefix('merchant_estab');
			$this->_order_menu_id     =   $this->db->dbprefix('order_menu_id');
			$this->_menu_category     =	   $this->db->dbprefix('menu_category');
			
			
			$this->_accounts          =	   $this->db->dbprefix('accounts');
		
			
			
		}
		
		
		public function getFullSummary()
			{
				$estabid = $this->uri->segment(4);
				
				$start_date = $this->input->post('start_date');
				$end_date   = $this->input->post('end_date');
				
				if ($start_date == '' && $end_date == '')
					{
						$start_date  =   date('m').'/1/'.date('Y');
						$end_date    =   date('m/t/Y');
						$total_days  =   date('t');
					}
					

				list ($fmonth, $fdate, $fyear) =   explode ('/', $start_date);
				list ($lmonth, $ldate, $lyear) =   explode ('/', $end_date);
				$fstime   					   =   mktime (0,0,0, $fmonth, $fdate, $fyear);
				$fetime   			           =   mktime (23,59,59, $lmonth, $ldate, $lyear);
				
				$datediff 			           =   $fetime - $fstime;
				
				
				if ($start_date  ==  $end_date)
				$total_days  = 1;
			     
				elseif ($start_date != '' && $end_date != '')
				$total_days                    =   floor($datediff / (60 * 60 * 24));

			
			    /*if ($start_date != '' && $end_date != '')
					{
						list ($fmonth, $fdate, $fyear) = explode ('/', $start_date);
						list ($lmonth, $ldate, $lyear) = explode ('/', $end_date);
						$fstime   			=   mktime (0,0,0, $fmonth, $fdate, $fyear);
						$fetime   			=   mktime (23,59,59, $lmonth, $ldate, $lyear);
						
						$datediff 			=   $fetime - $fstime;
						
						$total_days         =   floor($datediff / (60 * 60 * 24));
					}
				else
					{
						if ($this->uri->segment(5) == '' || $this->uri->segment(5) == 1)
							{
									list ($fdate, $fmonth, $fyear) = explode ('/', date("d/m/Y", strtotime("first day of previous month")));
									list ($ldate, $lmonth, $lyear) = explode ('/', date("d/m/Y", strtotime("last day of previous month")));
									$fstime   			=   mktime (0,0,0, $fmonth, $fdate, $fyear);
									$fetime   			=   mktime (23,59,59, $lmonth, $ldate, $lyear);
									$total_days         =   date('t', strtotime("last day of previous month"));
							}
						else
							{
								    list ($fdate, $fmonth, $fyear) = explode ('/', date("d/m/Y"));
									list ($ldate, $lmonth, $lyear) = explode ('/', date("t/m/Y"));
									$fstime   			=   mktime (0,0,0, $fmonth, $fdate, $fyear);
									$fetime   			=   mktime (23,59,59, $lmonth, $ldate, $lyear);
									$total_days         =   date('t');
							}
					}
				*/
				
				
				
				
				
				$this->db->select('order_id, total_amount, customer_id, (completion_time - order_time) as total_time');
				$qry = $this->db->get_where($this->_order, array('establishment_id' => $estabid, 'status' => '3', 'order_time >=' => $fstime, 'order_time <=' => $fetime));
				
				$numrows = $qry->num_rows();
				$data['prev_month'] = date('F, Y', $fstime);
				$business    = 0;
				$total_time  = 0;
				$results     = array(); 
				
				if ($numrows > 0)
					{
						$i = 0;
					    foreach($qry->result() as $odata)
							{
								$i = $i + 1;
								$business      =   $business + $odata->total_amount;
								$total_time    =   $total_time + $odata->total_time;
								$custumer_id[] =   $odata->customer_id;
								$order_id[]    =   $odata->order_id;
							}	
                                $data['total_orders']         = $numrows;			
                                $data['business']             = round($business);
								
								$count_customer               = count(array_unique($custumer_id));
                                $data['avg_amount_spend']     = round($business);	
                                $data['avg_user_spend']       = round($business/$count_customer);
								
                                $data['avg_order_completion_time'] =   gmdate('H:i:s',  $total_time/ $numrows); //$total_time / 60;

								$this->db->select('menu_id, sum(qty) as qty');
								$this->db->group_by('menu_id');
								$this->db->where_in('order_id', $order_id);
								$this->db->order_by('qty', 'desc');
								$this->db->limit(10);
								$result = $this->db->get($this->_order_menu_id);

								foreach ($result->result() as $res)
									{
										$item_name = $this->db->select('item_name')->get_where($this->_menu_items, array('id' => $res->menu_id))->row()->item_name;
										$qty       = $res->qty;
										$results[] = array('name' => $item_name, 'qty' => $qty);
									}
									    

									    $data['results'] = 	$results;
										
										/* Get New Customer and returning Customer */
										
										$this->db->where_in('id', array_unique($custumer_id));
										$this->db->where(array('regtime >=' => $fstime, 'regtime <=' => $fetime));
										$new_customer = (int) $this->db->get($this->_accounts)->num_rows();
										
										$data['new_customer'] = $new_customer;
										
										$returning_customer =  (int) (count($custumer_id) - $new_customer);
										
										$data['return_customer'] = $returning_customer;	
					}
										return $data;
			}
		
		/*index code strt*/
		
		 public function listofIndexData()
		{
			$userid = $this->uri->segment('3') ;
				$loclist = urldecode($userid);
		if($loclist!='')
		{
			
			$this->db->select($this->_establishment.'.id, '.$this->_establishment.'.name,'.$this->_estabinfo.'.owner, '.$this->_establishment.'.address, count('.$this->_order.'.order_id) as totalorder');
			$this->db->from($this->_establishment);
			$this->db->join($this->_estabinfo, "$this->_estabinfo.estabid = $this->_establishment.id");
			$this->db->join($this->_order, " $this->_establishment.id = $this->_order.establishment_id ",'left');
			$this->db->group_by($this->_establishment.'.id');
			$this->db->where($this->_establishment.'.city', $loclist);
		    return  $this->db->get()->result();
		}
		}
		
		
		/*index code end*/
		
	   public function listofRestaurant()
		{
			$cityname  = $this->uri->segment(3) ;
			$loclist   = urldecode($cityname);
			if($loclist!='')
				{
					$this->db->select($this->_establishment.'.id, '.$this->_establishment.'.name,'.$this->_estabinfo.'.owner, '.$this->_establishment.'.address, count('.$this->_order.'.order_id) as totalorder');
					$this->db->from($this->_establishment);
					$this->db->join($this->_estabinfo, "$this->_estabinfo.estabid = $this->_establishment.id");
					 
					$this->db->join($this->_order, " $this->_establishment.id = $this->_order.establishment_id ",'left');
					$this->db->group_by($this->_establishment.'.id');
					$this->db->where($this->_establishment.'.city', $loclist);
					// $this->db->get_where($this->_order, array('establishment_id' => $this->_establishment.id))->num_rows();
					return  $this->db->get()->result();
				}
		
		else
				{
					 $this->db->select($this->_establishment.'.id, '.$this->_establishment.'.name,'.$this->_estabinfo.'.owner, '.$this->_establishment.'.address, count('.$this->_order.'.order_id) as totalorder');
					  //$this->db->where($this->_merchant_estab.'.userid', $userid);
					  $this->db->from($this->_establishment);
					$this->db->join($this->_estabinfo, "$this->_estabinfo.estabid = $this->_establishment.id");
					 
					$this->db->join($this->_order, " $this->_establishment.id = $this->_order.establishment_id ",'left');
					$this->db->group_by($this->_establishment.'.id');
					//$this->db->order_by('totalorder', 'desc');
					// $this->db->get_where($this->_order, array('establishment_id' => $this->_establishment.id))->num_rows();
					return  $this->db->get()->result();
				}
		}
		
		
		 public function Filter_listofRestaurant()
			{
				  $estab  =  $this->input->post('estab');
				
				  $this->db->select($this->_establishment.'.id, '.$this->_establishment.'.name, '.$this->_establishment.'.address, count('.$this->_order.'.order_id) as totalorder');
				  
				  $this->db->from($this->_establishment);
				  
				  $this->db->join($this->_estabinfo, "$this->_estabinfo.estabid = $this->_establishment.id");
				 
				  $this->db->join($this->_order, " $this->_establishment.id = $this->_order.establishment_id ", 'left');
				  
				  //$this->db->group_by($this->_establishment.'.id');
				  
				  
				  $this->db->where($this->_establishment.'.id', $estab);
				  
				  // $this->db->get_where($this->_order, array('establishment_id' => $this->_establishment.id))->num_rows();
				  
				  return  $this->db->get()->result();
			
			}
		
		
		public function all()
		{
			
			 
			$startdate  =  $this->input->post('start_date');
			$enddate    =  $this->input->post('end_date');
			list ($startmonth, $startday, $startyear)   =   explode ('/', $startdate);
			$startmktime = mktime (0, 0, 0, $startmonth, $startday, $startyear);
			list ($endmonth, $endday, $endyear) 		=    explode ('/', $enddate);
			$endmktime   = mktime (23, 59, 59, $endmonth, $endday, $endyear);
			
			  $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.establishment_id, '.$this->_establishment.'.name as estabname, '.$this->_establishment.'.id as estabid');
			   $this->db->group_by($this->_establishment.'.id');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_establishment);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");
			
			  //$this->db->join($this->_order, "$this->_order.staff_member_id = $this->_staff_member.id",'left');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			 $order =  $this->db->get()->result();
			 $data['orders'] 	= 	$order;
			 $data['estab']    	= 	array();
				if (count($data['orders']) > 0)
					{
						foreach ($data['orders'] as $order_data)
							{
							  switch($order_data->{'payment_method'}){
													   case 1 :
													    $paymnt_method = "Credit Purchase";
														$paymnt = 1; 
														
													   break;
													   case 2 :
													    $paymnt_method = "COD";
														$paymnt = 2; 
													   break;
													   case 3 :
													   $paymnt_method = "Payu";
													   $paymnt = 3; 
													   break;
												   }
												   /*if($paymnt_method=='Credit Purchase') { $paymnt = 1;} 
												    else if($paymnt_method=='COD') { $paymnt = 2;}
													else if($paymnt_method=='Payu') { $paymnt = 3;}*/
													
							
								$this->db->select('order_id,order_time,location,payment_method,total_amount,status,establishment_id');
								$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('order_time >=' => $startmktime, 'order_time <=' => $endmktime, 'location' => $order_data->location, 'payment_method' => $paymnt))->result();
							}
					}
					
					//print_r($data); die();
				return $data;
		
		}
		
		 public function estab()
		 {
		
		$res_name  =  $this->input->post('res_name');
		 $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.establishment_id, '.$this->_establishment.'.name as estabname, '.$this->_establishment.'.id as estabid');
			   $this->db->group_by($this->_establishment.'.id');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_establishment);
			  $this->db->where($this->_establishment.'.name',$res_name);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");
			
			  //$this->db->join($this->_order, "$this->_order.staff_member_id = $this->_staff_member.id",'left');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			 $order =  $this->db->get()->result();
			 $data['orders'] 	= 	$order;
			 $data['estab']    	= 	array();
				if (count($data['orders']) > 0)
					{
						foreach ($data['orders'] as $order_data)
							{
							
							
								$this->db->select('order_id,order_time,location,payment_method,total_amount,status,establishment_id');
								$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('establishment_id' => $order_data->estabid))->result();
							}
					}
					
					//print_r($data); die();
				return $data;
		 }
		
    public function orderhistory()
		{
			  $userid = $this->uri->segment('3') ;
			  $loclist = urldecode($userid);
	
			
			  $this->db->select($this->_establishment.'.name as estabname, '.$this->_establishment.'.id as estabid');
			
			
			
			  $this->db->from($this->_establishment);
			
		      $this->db->where($this->_establishment.'.city', $loclist);
		
			 $getorder =  $this->db->get()->result();
			 $data['ordrestab'] 	= 	$getorder;
			
				return $data;
	
	
}
		 public function Filter_OrderByEstab()
			{
					$estab  =  $this->input->post('estab');
					$this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.establishment_id, '.$this->_establishment.'.name as estabname, '.$this->_establishment.'.id as estabid, '.$this->_order.'.customer_id');
					
					$this->db->order_by($this->_order.'.order_time', 'desc');
					
					$this->db->from($this->_establishment);
					$this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");
					$this->db->where($this->_establishment.'.id', $estab);
					$orderdta           =   $this->db->get()->result();
					/*$data['ordr'] 	    = 	$orderdta;
					$data['estab']  	= 	array();
					$data['cust_name']  = 	array();
					if (count($orderdta) > 0)
						{
							foreach ($orderdta as $order_data)
								{
									$this->db->select('order_id,order_time,location,payment_method,total_amount,status,establishment_id');
									$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('establishment_id' => $order_data->estabid))->result();
									$this->db->select('name');
									$data['cust_name'][$order_data->customer_id] = $this->db->get_where($this->_users, array('id' => $order_data->customer_id))->result();
								}
						}
						*/
						
					return $orderdta;
			}
		
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
			
				return $data;

		}
		
		public function getInsideInfo()
		{ 
				$res_name  =  $this->input->post('estab');
				
				$this->db->select($this->_order.'.	order_id,  '.$this->_order.'.establishment_id,'.$this->_order.'.customer_id,'.$this->_merchant_estab.'.userid,'.$this->_users.'.name,'.$this->_order.'.staff_member_id,'.$this->_order.'.completion_time, '.$this->_order.'.order_time');
		
			    $this->db->from($this->_order);
			    $this->db->join($this->_establishment, "$this->_establishment.id = $this->_order.establishment_id");
			    $this->db->where($this->_establishment.'.id',$res_name);
				$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id","left");
			    $this->db->join($this->_merchant_estab, "$this->_merchant_estab.estabid = $this->_order.establishment_id","left");
				$result 			=   $this->db->get()->result();
				$data['order'] 	    = 	$result;
				
				$data['ser_id']    	= 	array();
				$data['item_sold']	= 	array();
				$data['cust']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select('name,id,employee_id');
								$data['ser_id'][$resul->staff_member_id] = $this->db->get_where($this->_staff_member, array('id' => $resul->staff_member_id))->result();
								
								
								  $this->db->select($this->_menu_category.'.menu_id,'.$this->_order_menu_id.'.menu_id as menuid,'.$this->_menu_category.'.id,count('.$this->_order_menu_id.'.qty) as quantity,'.$this->_menu_items.'.item_name');
								  $this->db->from($this->_menu_category);
								  $this->db->join($this->_order_menu_id, "$this->_order_menu_id.menu_id = $this->_menu_category.menu_id");
								   $this->db->join($this->_menu_items, "$this->_menu_category.menu_id = $this->_menu_items.id");
								  $this->db->group_by($this->_order_menu_id.'.menu_id');
								  $this->db->where($this->_menu_category.'.user_id',$resul->userid);
								  $data['item_sold']   =   $this->db->get()->result();
								
								
								$this->db->select('customer_id,count('.$this->_order.'.customer_id) as customers');
								$this->db->group_by($this->_order.'.customer_id');
								$data['cust'][$resul->establishment_id] = $this->db->get_where($this->_order, array('establishment_id' => $resul->establishment_id))->result();
								
							}
						
					}
								return $data;
		}
		
		
		/*Start code for analytics*/
					 				  
									  
		public function getestabAnalytics() // old //
			{
				   $city      =   urldecode($this->uri->segment(3));
				   
				   $this->db->select($this->_order.'.establishment_id as estabid, '.$this->_establishment.'.name');
				  
				   $this->db->where(array($this->_establishment.'.city' => $city, $this->_order.'.status' => 3));
				   
				   $this->db->group_by($this->_order.'.establishment_id');
				  
				   $this->db->from($this->_order);

				   $this->db->join($this->_establishment, "$this->_establishment.id = $this->_order.establishment_id");

				   $analytics_data_qry =  $this->db->get();
				 
				   if ($analytics_data_qry->num_rows() > 0)
						{
							$analytics_data_result = $analytics_data_qry->result();
							
							foreach ($analytics_data_result as $order_data)
								{
									
									  $data[$order_data->estabid]['name'] = $order_data->name;
									  
									  $total_orders  =  $this->db->get_where($this->_order, array('status' => 3, 'establishment_id' => $order_data->estabid))->num_rows();
									  
									  $data[$order_data->estabid]['total_orders'] = $total_orders;
									  
								   	  $this->db->select('SUM(total_amount) as amount');
									  $business_generated  =  $this->db->get_where($this->_order, array('status' => 3, 'establishment_id' => $order_data->estabid))->row()->amount;
											  		  
									  $data[$order_data->estabid]['business_generated'] = round($business_generated);
									  
									  $total_orders  =  $this->db->get_where($this->_order, array('status' => 3, 'establishment_id' => $order_data->estabid))->num_rows();
									  $data[$order_data->estabid]['total_orders']      =  (int) $total_orders;
									  
											  		  
									  $data[$order_data->estabid]['avg_spent_per_day'] =  $total_orders / 30;
									  
									  
									  $data[$order_data->estabid]['avg_user_spent']    =  round($business_generated / $total_orders);
									  
									  $data[$order_data->estabid]['total_staff']       =  $this->db->get_where($this->_staff_member, array('branch_id' => $order_data->estabid))->num_rows();
									  							
								      			      
									  $this->db->select('staff_member_id');
									  $this->db->group_by('staff_member_id');
								  
									  $staff_members =  $this->db->get_where($this->_order, array('status' => 3, 'establishment_id' => $order_data->estabid))->result();
			  
									  foreach ($staff_members as $sdata)
										  {
											  
											  $i = 0;
											  $this->db->select('SUM(total_amount) as amount');
											  
											  $total_price    =  $this->db->get_where($this->_order, array('status' => 3, 'staff_member_id' => $sdata->staff_member_id))->row()->amount;
											  
											  $success_order  =  $this->db->get_where($this->_order, array('status' => 3, 'staff_member_id' => $sdata->staff_member_id))->num_rows();
											  
											  $this->db->select('SUM(completion_time - order_time) as total_time');
											  $month_total_time    =  $this->db->get_where($this->_order, array('status' => 3, 'staff_member_id' => $sdata->staff_member_id))->row()->total_time;
											 
											  $cmminutes = $month_total_time / 60;
											  
											  $staff_name = $this->db->select('name')->get_where($this->_staff_member, array('id' => $sdata->staff_member_id))->row()->name;
											  
											  
											  $data[$order_data->estabid]['analytic'][$i]['name']      =  $staff_name;
											  $data[$order_data->estabid]['analytic'][$i]['business']  =  round($total_price);
											  $data[$order_data->estabid]['analytic'][$i]['order']     =  $success_order;
											  $data[$order_data->estabid]['analytic'][$i]['avg_time']  =  $cmminutes;
											  $i++;
											
										  }
								}
						}
								
											   return $data;
			}
		
		
	public function estabAnalytics()
		{
			  $loclist  = urldecode($this->uri->segment(3));
			  $this->db->select($this->_establishment.'.name,'.$this->_establishment.'.id');
			  $this->db->from($this->_establishment);
			  $this->db->where($this->_establishment.'.city', $loclist);
		      return  $this->db->get()->result();
		}

		
		/*End code for analytics*/
		
}
		
		?>