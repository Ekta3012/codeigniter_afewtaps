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
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_category                      =      $this->db->dbprefix('category'); 
			 $this->_menu_category                 =      $this->db->dbprefix('menu_category');
			 $this->_menu_items                    =      $this->db->dbprefix('menu_items');
			 $this->_branch_menu                   =      $this->db->dbprefix('branch_menu');
			 $this->_menu_customization_type       =      $this->db->dbprefix('menu_customization_type');
			 $this->_menu_customization_options    =      $this->db->dbprefix('menu_customization_options');
			 $this->_coupon                        =      $this->db->dbprefix('coupon');
			 $this->_order                         =      $this->db->dbprefix('order');
		}
		
	public function getMyOrders()
		{
			 
		}
		
		
	public function userOrderCancelModule($order_id = '')
		{
			$this->db->where(array('order_id' => $order_id, 'status !=' => 3));
			$query = $this->db->get($this->_order);
			if ($query->num_rows() > 0)
			   {
					 $this->db->where('order_id', $order_id);
					 $this->db->update($this->_order, array('status' => 4, 'cancel_time' => time()));

					 if ($this->db->affected_rows() > 0)
						$response = array('status' => 'true', 'msg' => 'Success');
					 else
						$response = array('status' => 'false', 'msg' => 'Server Error');
			   }
			  else  
				        $response = array('status' => 'false', 'msg' => 'Server Error');
						    
						return $response;
		}
		
		
	public function applyCouponCodeModule($code = '')
		{
			$code   =  'sdf'; //$this->input->post('code');
			$total  =  300; //$this->input->post('total');
			
			$time  =  time();
			
			$this->db->where(array('code' => $code, 'sdate >=' => $time, 'amount >=' => $total));
			$query = $this->db->get($this->_coupon);
			if ($query->num_rows() > 0)
				{
					$result  = $query->row();
					
					$flat_percentage = $result->percentage;
					
					$discount = $total * $flat_percentage / 100 ;
	
					$msg = array('status' => 'true', 'total' => $discount);
					
				}
			else
				    $msg = array('status' => 'false', 'total' => '');
				
				    return $msg;
			
		}
	
	public function getMenuItems($branchid = 1)
		{	
		    $esab_items  =  array();
			
			$cateory     =  1;

			$this->db->select($this->_menu_category.'.main_category, '.$this->_category.'.category_name, '.$this->_menu_items.'.id as mid, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.description, '.$this->_menu_items.'.item_type');
			
			$this->db->where($this->_menu_category.'.main_category', $cateory);
			
			$this->db->where($this->_branch_menu.'.branch_id', 1);
			
			$this->db->where($this->_menu_category.'.user_id', 1);
			
			$this->db->order_by(array($this->_menu_category.'.category_id' =>  'asc', $this->_menu_category.'.main_category' =>  'asc'));
			
			$this->db->from($this->_menu_category);
			
			$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
			
			$this->db->join($this->_branch_menu, "$this->_branch_menu.menu_id = $this->_menu_items.id");
			
			$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");

			$res = $this->db->get()->result();

			$carr = array();
			
			$d               = array();
			$esab_item11     = array();

			echo $res->num_rows(); die();
			
			foreach ($res as $result)
				{
				    $menu = array();

					$this->db->select('id, customization_name, customization_type');
					
					$res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $result->mid));

					$array1 = array();
					
                    if ($res_query->num_rows() > 0)
						{
							foreach ($res_query->result() as $rdata)
								{	
									$options['name'] = $rdata->customization_name;
									
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
										 
									$array1[] = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => $options);

						        }
						}
					else
						{
									$array1[] = array('id' => $result->mid, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => array());
						}
						     
									$main_category = ($result->main_category == 1) ? 'Food' : 'Drinks';
				}
				
				
				     $esab_items['address']        =  "S-2, 2nd floor, Crowne Interior Mall, Near Sector - 35, Faridabad";
				     $esab_items['opening_hours']  =  "12 Noon to 11 PM";
				     $esab_items['opening_hours']  =  "rating";
					 
					 
					 $esab_items['info']  		   =  $esab_item;
					 
				     return $d;
					 
		}
		
		
		
	public function getMenuItems1($branchid = 1)
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
											$array1[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => array());
								}
											
					  }
											$esab_items['subcat']['sc']     =   $sdata->category_name;
											$esab_items['subcat']['items']  =   $array1;
											$ddd[] = $esab_items;
			     }
											
				 
			                                echo json_encode(array('info' => $ddd), JSON_PRETTY_PRINT);
											die();
				
			
		}
		
		
	public function getMenuItems2($branchid = 1)
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
												$array1[] = array('id' => $result->id, 'desc' => $result->description, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type, 'customization' => array());
									}
												
						  }
												//$esab_items['subcat']['sc']     =   $sdata->category_name;
												//$esab_items['subcat']['items']  =   $array1;
												
												$esab_items[$sdata->category_name]  =   $array1;

												$ddd[] = $esab_items;
					 }
			                                echo json_encode(array('info' => $ddd), JSON_PRETTY_PRINT);
											die();
				
			
		}
		
		
}
