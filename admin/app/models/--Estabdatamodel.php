<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabdatamodel extends CI_Model {


    private $_merchant_info;
	private $_accounts;
	private $_estab_rating;
	private $_order;
    private $_merchant_estab;
	private $_establishment;
	private $_category;
	private $_menu_category;
	private $_menu_items;
	private $_branch_menu;
	private $_menu_customization_type;
	private $_menu_customization_options;
	private $_users;
	private $_staff_member;
   
    public function __construct()
		{
			parent::__construct();
		 
			$this->_merchant_info               =	   $this->db->dbprefix('merchant_info');
			$this->_accounts               =	       $this->db->dbprefix('accounts');
			$this->_estab_rating               =	   $this->db->dbprefix('estab_rating');
			$this->_order               =	           $this->db->dbprefix('order');
			$this->_merchant_estab               =	   $this->db->dbprefix('merchant_estab');
			$this->_establishment               =	   $this->db->dbprefix('establishment');
			$this->_category                   =	   $this->db->dbprefix('category');
			$this->_menu_category                =	   $this->db->dbprefix('menu_category');
			$this->_menu_items                 =	   $this->db->dbprefix('menu_items');
			$this->_branch_menu                 =	   $this->db->dbprefix('branch_menu');
			$this->_menu_customization_type       =	   $this->db->dbprefix('menu_customization_type');
			$this->_menu_customization_options     =   $this->db->dbprefix('menu_customization_options');
			$this->_users                          =   $this->db->dbprefix('users');
			$this->_staff_member                          =   $this->db->dbprefix('staff_member');
			
		}
		
		public function getMerchantInfo()
		{
			 $this->db->select($this->_merchant_info.'.	contact_person,  '.$this->_merchant_info.'.contact_no,'.$this->_merchant_info.'.email, '.$this->_merchant_info.'.beneficiary_name,  '.$this->_merchant_info.'.bank_name,  '.$this->_merchant_info.'.bank_ac_no,  '.$this->_merchant_info.'.ifsc_swift_code,  '.$this->_merchant_info.'.account_type,  '.$this->_merchant_info.'.com_col_start_dt,  '.$this->_merchant_info.'.com_slab,  '.$this->_merchant_info.'.merchant_tan,  '.$this->_merchant_estab.'.estabid, '.$this->_establishment.'.name');
		
			  $this->db->from($this->_merchant_info);
			$this->db->join($this->_merchant_estab, "$this->_merchant_info.userid = $this->_merchant_estab.userid");
			$this->db->join($this->_establishment, "$this->_establishment.id = $this->_merchant_estab.estabid");
			
			$this->db->where($this->_merchant_estab.'.main', 1);
			  return $this->db->get()->result();
		}
		
		public function getServiceRatingTable()
		{
			 $this->db->select($this->_order.'.	order_id,  '.$this->_order.'.establishment_id,'.$this->_order.'.customer_id,'.$this->_users.'.name,'.$this->_order.'.staff_member_id');
		
			  $this->db->from($this->_order);
			$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id","left");
			//$this->db->join($this->_estab_rating, "$this->_estab_rating.estabid = $this->_order.establishment_id","left");
				$result 			=   $this->db->get()->result();
				//print_r($result); die();
				$data['order'] 	= 	$result;
				
				$data['ser_id']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select('name,id,employee_id');
								$data['ser_id'][$resul->staff_member_id] = $this->db->get_where($this->_staff_member, array('id' => $resul->staff_member_id))->result                                ();
							}
							//print_r($data['ser_id']); die();
					}
					return $data;
		}
		
		
			public function getMenuItems($categoryid = '')
			{
				
				
				$this->db->select($this->_category.'.id as cid, '. $this->_category.'.category_name');
				
				//$this->db->where($this->_menu_category.'.user_id', $userid);
				//$this->db->where($this->_menu_category.'.main_category', $categoryid);
				
				$this->db->from($this->_category);
				//$this->db->group_by($this->_menu_category.'.category_id');
				//$this->db->where($this->_menu_category.'.main_category', $categoryid);
				//$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
				$result 			=   $this->db->get()->result();
				$data['category'] 	= 	$result;
				
				$data['menu_cat']    	= 	array();
				$data['items']    	= 	array();
			
			if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select('menu_id');
								$data['menu_cat'][$resul->cid] = $this->db->get_where($this->_menu_category, array('category_id' => $resul->cid))->result                                ();
								//print_r($data['menu_cat']); die();
								
								foreach ($data['menu_cat'] as $menucat)
							{
								foreach ($menucat as $menucat_id)
							{
								
								$this->db->select('id as menu_d, item_name, price, item_type');
								$data['items'][$menucat_id->menu_id] = $this->db->get_where($this->_menu_items, array('id' => $menucat_id->menu_id))->result                                ();
									
							}
							//print_r($data['items']); die();
							}
							}
							//print_r($data['menu_cat']); 
							
							//print_r($data['items']);
							
					}
			
				return $data;

				
			}
			
			
			public function FavFood($categoryid = '')
			{
				
				
				$this->db->select($this->_category.'.id as cid, '. $this->_category.'.category_name, '.$this->_menu_category.'.menu_id');
				$this->db->group_by($this->_menu_category.'.category_id');
				//$this->db->where($this->_menu_category.'.user_id', $userid);
				$this->db->where($this->_menu_category.'.main_category', $categoryid);
				
				$this->db->from($this->_menu_category);
				
				
				$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
				
			
				$result 			=   $this->db->get()->result();
				$data['category'] 	= 	$result;
				$data['items']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $result_data)
							{
							
								$this->db->select('id as menu_id, item_name, price, item_type');
								$data['items'][$result_data->cid] = $this->db->get_where($this->_menu_items, array('id' => $result_data->menu_id))->result                                ();
								
							
							}
							//print_r($data); die();
					}
					
					
				return $data;

				
			}
		
		public function addMenuItems($id = '', $user_id = '')
		{
			$branch_id         		=  	$this->input->post('branch');
			//$cuisine           		=  	$this->input->post('cuisine');
			$maincategory      		=  	$this->input->post('cat');
			$category          		=  	(int) $this->input->post('category');
			$item_name         		=  	$this->input->post('item_name');
			$base_price        		=  	$this->input->post('base_price');
			$description       		=  	$this->input->post('description');
			$item_type         		=  	$this->input->post('veg_nonveg_cat');
			$customization_type     =  	$this->input->post('customization_type');
			
			$mdata['item_name']               =    $item_name;
			$mdata['user_id']         		  =    $user_id;			
			$mdata['price']                   =    $base_price;	
			$mdata['description']             =    $description;	
			$mdata['item_type']               =    $item_type;	
			$mdata['date_added']              =    time();
			$mdata['ip_address']              =    $this->input->ip_address();
			$this->db->insert($this->_menu_items, $mdata);
			$menu_id                          =    $this->db->insert_id();
			
			if ($category == 0)
				{
					$cdata['category_name']   =   $this->input->post('category');
					$cdata['user_id']         =   $user_id;
					$cdata['atime']           =   time();
					$cdata['status']          =   1;
					$this->db->insert($this->_category, $cdata);
					$category_id              =   $this->db->insert_id();
					$mcdata['category_id']    =   $category_id;
				}
			else
			    {
					$mcdata['category_id']    =   $category;
				}
				
			$mcdata['main_category']          =   $maincategory;
			$mcdata['menu_id']                =   $menu_id;
			$mcdata['user_id']                =   $user_id;
			$this->db->insert($this->_menu_category, $mcdata);
			
			$bmdata['branch_id']       		  =    $branch_id;
			$bmdata['menu_id']          	  =    $menu_id;
			$this->db->insert($this->_branch_menu, $bmdata);

			foreach ($customization_type as $customization_data)
				{
					if ( ! empty($customization_data['custom_type_name']))
						{
							$csdata                         =    array();
							$csdata['menu_id']        		=    $menu_id;
							$csdata['customization_name']   =    $customization_data['custom_type_name'];
							$csdata['customization_type']   =    $customization_data['type'];
							$this->db->insert($this->_menu_customization_type, $csdata);
							$customization_id               =    $this->db->insert_id();
							$cstdata                        =    array();
							
							foreach ($customization_data['custom_option'] as $custom_option_data)
								{
									$cstdata['customization_type_id']  =    $customization_id;
									$cstdata['option_name']            =    $custom_option_data['name'];
									$cstdata['price']                  =    $custom_option_data['price'];
									$this->db->insert($this->_menu_customization_options, $cstdata);
								}
						}
				}
							$this->session->set_flashdata('menu_add', 'menu_add');
							redirect('establishmentdata/addmenu');
		}
		
		public function checkMenuItemUser($menuid = '')
		{
			return  $this->db->get_where($this->_menu_items, array('id' => $menuid))->num_rows();
		}
		
		public function updateMenuItems($menu_id = '')
		{

			$branch_id         		=  	$this->input->post('branch');
			$maincategory      		=  	$this->input->post('cat');
			$category          		=  	(int) $this->input->post('category');
			
		     //$this->input->post('category');
			//die($category);
			$item_name         		=  	$this->input->post('item_name');
			$base_price        		=  	$this->input->post('base_price');
			$description       		=  	$this->input->post('description');
			$item_type         		=  	$this->input->post('veg_nonveg_cat');
			$customization_type     =  	$this->input->post('customization_type');
			
			$mdata['item_name']               =    $item_name;		
			$mdata['price']                   =    $base_price;	
			$mdata['description']             =    $description;	
			$mdata['item_type']               =    $item_type;	
			$mdata['date_modified']           =    time();
			
			//echo $customization_type;
			//die();
			$this->db->where('id', $menu_id);
			$this->db->update($this->_menu_items, $mdata);
			
			if ($category == 0)
				{
					$cdata['category_name']   =   $this->input->post('category');
					$cdata['user_id']         =   $user_id;
					$cdata['atime']           =   time();
					$cdata['status']          =   1;
					$this->db->insert($this->_category, $cdata);
					$category_id              =   $this->db->insert_id();
					$mcdata['category_id']    =   $category_id;
				}
			else
			    {
					$mcdata['category_id']    =   $category;
				}
				
				
			$mcdata['main_category']          =   $maincategory;
			
			$this->db->where('menu_id', $menu_id);
			$this->db->update($this->_menu_category, $mcdata);
			
			$bmdata['branch_id']       		  =    $branch_id;
			$this->db->where('menu_id', $menu_id);
			$this->db->update($this->_branch_menu, $bmdata);

			
			/*foreach ($cuisine as $cid)
				{
					$cmdata['menu_id']        =    $menu_id;
					$cmdata['cuisine_id']     =    $cid;
					$this->db->insert($this->_menu_cuisines, $cmdata);
				}
			*/
			$this->db->select('id');
			$customization_qry = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $menu_id))->result();
			
			if (count($customization_qry) > 0)
				{
					foreach ($customization_qry as $customization_data)
					$arr[] = $customization_data->id;
					
					
					$this->db->where_in('customization_type_id', $arr);
					$this->db->delete($this->_menu_customization_options);
					//echo $customization_data['customization_type'];
					//die();
					
				}

			$this->db->where('menu_id', $menu_id);
			$this->db->delete($this->_menu_customization_type);
			
			//print_r($customization_type);
			//die();
			if(is_array($customization_type)): 
			foreach ($customization_type as $customization_data)
				{
					$csdata                         =    array();
					$csdata['menu_id']        		=    $menu_id;
					$csdata['customization_name']   =    $customization_data['custom_type_name'];
					$csdata['customization_type']   =    $customization_data['type'];
					$this->db->insert($this->_menu_customization_type, $csdata);
					$customization_id               =    $this->db->insert_id();
					$cstdata                        =    array();
					
					foreach ($customization_data['custom_option'] as $custom_option_data)
						{
							$cstdata['customization_type_id']  =    $customization_id;
							$cstdata['option_name']            =    $custom_option_data['name'];
							$cstdata['price']                  =    $custom_option_data['price'];
							$this->db->insert($this->_menu_customization_options, $cstdata);
						}
				}
				endif;
							$this->session->set_flashdata('menu_add', 'menu_add');
							redirect('establishmentdata/menu/1');
			
		}
		
		
		public function getMenuItemsById($menuid = '')
		{
			$user_menu_exist  =  $this->db->get_where($this->_menu_items, array('id' => $menuid))->num_rows();
			if ($user_menu_exist > 0)
				{
					$this->db->select('branch_id');
					$data['branch_id']     =  $this->db->get_where($this->_branch_menu, array('menu_id' => $menuid))->row()->branch_id;
					
					$this->db->select('category_id, main_category');
					$data['category_data'] =  $this->db->get_where($this->_menu_category, array('menu_id' => $menuid))->row();
					
					$this->db->select('item_name, price, description, item_type');
					$data['items_data']    =  $this->db->get_where($this->_menu_items, array('id' => $menuid))->row();
					
					$this->db->select('id, menu_id, customization_name, customization_type');
					//$this->db->order_by($this->_menu_customization_type.'.id', 'asc');
					$customization_type_arr =  $this->db->get_where($this->_menu_customization_type, array('menu_id' => $menuid))->result();
//print_r($customization_type_arr);
//die();
					if (count($customization_type_arr) > 0)
						{
							foreach ($customization_type_arr as $key => $customization_type_data)
								{
									$this->db->select($this->_menu_customization_type.'.menu_id, '.$this->_menu_customization_options.'.option_name, '. $this->_menu_customization_options.'.price');
									$this->db->where($this->_menu_customization_type.'.id', $customization_type_data->id);
									$this->db->from($this->_menu_customization_type);
									$this->db->join($this->_menu_customization_options, "$this->_menu_customization_type.id = $this->_menu_customization_options.customization_type_id");
									$data['menu'] = $this->db->get()->result();
									//$data['menu'][$key]				  =	  (array) $customization_type_data;
									//$data['menu'][$key]['options']    =   $results;
								}
						}
					
					return $data;
					
				}
		}
		
		
		public function listofallorder()
		{
			
			  $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.location, '.$this->_order.'.status');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_order);
			
			  return $this->db->get()->result();
		

		}
		
		public function Filterlistofallorder()
		{
			
			$startdate  =  $this->input->post('start_date4');
			$enddate    =  $this->input->post('end_date4');
			list ($startmonth, $startday, $startyear)   =   explode ('/', $startdate);
			$startmktime = mktime (0, 0, 0, $startmonth, $startday, $startyear);
			list ($endmonth, $endday, $endyear) 		=    explode ('/', $enddate);
			$endmktime   = mktime (23, 59, 59, $endmonth, $endday, $endyear);
			$this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.location, '.$this->_order.'.status');
			$this->db->where(array($this->_order.'.order_time >=' => $startmktime, $this->_order.'.order_time <=' => $endmktime));
			$this->db->from($this->_order);
			
			return $this->db->get()->result();
		
		}
		
		public function listofrating()
		{	
			  $this->db->select($this->_estab_rating.'.userid, '.$this->_estab_rating.'.estabid, '.$this->_estab_rating.'.rating, '.$this->_estab_rating.'.review, '.$this->_estab_rating.'.reply, '.$this->_estab_rating.'.ttime, '.$this->_accounts.'.id, '.$this->_accounts.'.name, '.$this->_accounts.'.email, '.$this->_estab_rating.'.id as rating_id');
			
			  $this->db->from($this->_estab_rating);
			  $this->db->join($this->_accounts, "$this->_accounts.id = $this->_estab_rating.userid");
			  $this->db->where($this->_accounts.'.status', 1);
			  
			 return  $this->db->get()->result();
		}
		
		public function deleteEstabRating($id= '')
		{
			
			$this->db->where('id', $id);
			$this->db->delete($this->_estab_rating);
			redirect('establishmentdata/ratings');
			
			
		}
		/*Start Rating submodule code only for editing*/
		public function checkEstabRating($id = '')
		{
			return  $this->db->get_where($this->_estab_rating, array('id' => $id))->num_rows();
		}
		
		public function getEstabRatingById($id = '')
		{
			$user_menu_exist  =  $this->db->get_where($this->_estab_rating, array('id' => $id))->num_rows();
			if ($user_menu_exist > 0)
				{
			  $this->db->select('rating,id,review,reply');
		    $data['userdata']    =  $this->db->get_where($this->_estab_rating, array('id' => $id))->row();
		
			  }
			  return $data;
		}
		public function updateEstabRating($id = '')
		{

			$rating         		=  	$this->input->post('rating');
		    $review          		=  $this->input->post('review');
			$reply          		=  $this->input->post('reply');
			$time  		   =    time();
			
			$mdata['rating']                   =    $rating;		
			$mdata['review']                   =    $review;	
			$mdata['reply']                   =    $reply;	
			$mdata['ttime']                   =    $time;	
		
			$this->db->where('id', $id);
			$this->db->update($this->_estab_rating, $mdata);
			$this->session->set_flashdata('Estab_Rating_edit', 'Estab_Rating_edit');
			redirect('establishmentdata/ratingedit/'.$id);
			
		}
		/*End Rating submodule code only for editing*/
		/*------*/
		/*Start Code for Delete Menu Menu Items*/
		public function deleteMenuItem($id= '')
		{
			
			$this->db->where('id', $id);
			$this->db->delete($this->_menu_items);
			redirect('establishmentdata/menu/1');
			
			
		}
		 /*End Code for Delete Menu Menu Items*/
		 
		 /*Start Code for New & Returning Customers*/
		 public function getAllCustomers()
		{
			 $this->db->select($this->_users.'.name,  '.$this->_users.'.email,'.$this->_users.'.mobile,'.$this->_users.'.id');
		     $this->db->from($this->_users);
			 $result 			=   $this->db->get()->result();
			 $data['customer'] 	= 	$result;
			 $data['cust_exit']    	= 	array();
			 $data['new_grph']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select('count(order_id) as customer','customer_id');
								$data['cust_exits'][$resul->id] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->result                                ();
								
							}
						
							
							foreach ($result as $resul)
							{
								$this->db->select($this->_order.'.customer_id,  '.$this->_order.'.order_time');
								$data['new_grph'][$resul->id] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->result                                ();
								
							}
							print json_encode($data['new_grph'], JSON_NUMERIC_CHECK);
							//print_r($data['new_grph']); die();
						
						
					}
					
					/*
								$this->db->select($this->_order.'.customer_id,  '.$this->_order.'.order_time');
								$this->db->from($this->_order);
			       			 $result 			=   $this->db->get()->result();
			 $data['new_grph'] 	= 	$result;

					*/
								
							
					return $data;
		}
		/*End Code for New & Returning Customers*/
		
		/*Start Code for Order Hitsory*/
		 public function orderhistory()
		{
			
			  $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.establishment_id, '.$this->_order.'.customer_id');
			   //$this->db->group_by($this->_establishment.'.id');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_order);
			  //$this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");
			//$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id");
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			 $order =  $this->db->get()->result();
			 $data['orders'] 	= 	$order;
			// $data['estab']    	= 	array();
			 $data['cust_name']    	= 	array();
				if (count($data['orders']) > 0)
					{
						foreach ($data['orders'] as $order_data)
							{
							/*
							
								$this->db->select('order_id,order_time,location,payment_method,total_amount,status,establishment_id');
								$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('establishment_id' => $order_data->estabid))->result();*/
								$this->db->select('name');
								$data['cust_name'][$order_data->customer_id] = $this->db->get_where($this->_users, array('id' => $order_data->customer_id))->result();
								
							}
					}
					
					//print_r($data['cust_name']); die();
				return $data;

		}
		
		public function orderhistorydetails($order_id='')
		{
			  $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.establishment_id, '.$this->_order.'.customer_id');
			   //$this->db->group_by($this->_establishment.'.id');
			  //
			  $this->db->from($this->_order);
			 // $this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");
			  $this->db->where($this->_order.'.order_id', $order_id);
			
			  //$this->db->join($this->_order, "$this->_order.staff_member_id = $this->_staff_member.id",'left');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			 $order =  $this->db->get()->result();
			 $data['orders'] 	= 	$order;
			 $data['estab']    	= 	array();
			   $data['cust_name']    	= 	array();
				if (count($data['orders']) > 0)
					{
						foreach ($data['orders'] as $order_data)
							{
							
							    $this->db->select('id,name');
								$data['estab'] = $this->db->get_where($this->_establishment, array('id' => $order_data->establishment_id))->result();
								
							    $this->db->select('name');
								$data['cust_name'][$order_data->customer_id] = $this->db->get_where($this->_users, array('id' => $order_data->customer_id))->result();
							}
					}
					
					//print_r($data); die();
				return $data;

		}
		
		
		 public function filter()
		{
			
			$startdate  =  $this->input->post('start_date');
			$enddate    =  $this->input->post('end_date');
			$location    =  $this->input->post('location');
			list ($startmonth, $startday, $startyear)   =   explode ('/', $startdate);
			$startmktime = mktime (0, 0, 0, $startmonth, $startday, $startyear);
			list ($endmonth, $endday, $endyear) 		=    explode ('/', $enddate);
			$endmktime   = mktime (23, 59, 59, $endmonth, $endday, $endyear);
			  $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.establishment_id, '.$this->_order.'.customer_id');
			   //$this->db->group_by($this->_establishment.'.id');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_order);
			  $this->db->where(array($this->_order.'.order_time >=' => $startmktime, $this->_order.'.order_time <=' => $endmktime, $this->_order.'.location' => $location));
			  //$this->db->join($this->_order, "$this->_order.establishment_id = $this->_establishment.id");
			//$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id");
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			 $order =  $this->db->get()->result();
			 $data['orders'] 	= 	$order;
			
			$data['cust_name']    	= 	array();
				if (count($data['orders']) > 0)
					{
						foreach ($data['orders'] as $order_data)
							{
							/*
							
								$this->db->select('order_id,order_time,location,payment_method,total_amount,status,establishment_id');
								$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('establishment_id' => $order_data->estabid))->result();*/
								$this->db->select('name');
								$data['cust_name'][$order_data->customer_id] = $this->db->get_where($this->_users, array('id' => $order_data->customer_id))->result();
								
							}
					}
					
					//print_r($data['cust_name']); die();
				return $data;
			
		
		}
		
			/*End Code for Order Hitsory*/
		
		
		
		
}
		
		?>