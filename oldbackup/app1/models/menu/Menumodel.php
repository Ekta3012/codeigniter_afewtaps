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
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_category                      =      $this->db->dbprefix('category'); 
			 $this->_menu_category                 =      $this->db->dbprefix('menu_category');
			 $this->_menu_items                    =      $this->db->dbprefix('menu_items');
			 $this->_branch_menu                   =      $this->db->dbprefix('branch_menu');
			 $this->_menu_customization_type       =      $this->db->dbprefix('menu_customization_type');
			 $this->_menu_customization_options    =      $this->db->dbprefix('menu_customization_options');
		}
		
	public function getMyOrders()
		{
			 
		}
	
	public function getMenuItems($branchid = 1)
		{	
			$cateory = 1;
			
			$this->db->select($this->_category.'.category_name, '.$this->_menu_items.'.id, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.description, '.$this->_menu_items.'.item_type');
			
			$this->db->where($this->_menu_category.'.main_category', $cateory);
			$this->db->where($this->_branch_menu.'.branch_id', 1);
			$this->db->where($this->_menu_category.'.user_id', 1);
			
			$this->db->from($this->_menu_category);
			
			$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
			
			$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
			
			$this->db->join($this->_branch_menu, "$this->_branch_menu.menu_id = $this->_menu_items.id");
			
			$res = $this->db->get()->result();

			foreach ($res as $result)
				{
					echo "df";
					$menu['items'] = array('id' => $result->id, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type);
					
					$this->db->select('id, customization_name, customization_type');
					
					$res_query = $this->db->get_where($this->_menu_customization_type, array('menu_id' => $result->id));

                    if ($res_query->num_rows() > 0)
						{
							foreach ($res_query->result() as $rdata)
								{
									
									$options['name'] = $rdata->customization_name;
									
									//print_r($menu);
									
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
										 
									$menu['items']['customization'][] = $options;
						        }
								
						}
					
					
					
				//	$main_category['food'][$result->category_name][] = array('id' => $result->id, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type);
					
					
					$esab_items[] = $menu;
				}
				
				print_r($esab_items);
		
		}
		
	/*public function getMenuItems($branchid = 1)
		{	
			/*$branchid = 1;
		
			$this->db->select($this->_menu_items.'.id, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.description, '.$this->_menu_items.'.item_type');
			
			$this->db->where($this->_branch_menu.'.branch_id', $branchid);
			
			$this->db->from($this->_branch_menu);
			
			$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_branch_menu.menu_id");
			
			//$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_branch_menu.menu_id");
			
			
			//$this->db->join($this->_menu_customization_type, "$this->_menu_customization_type.menu_id = $this->_menu_items.id");
			
			
			
			//$this->db->join($this->_menu_customization_options, "$this->_menu_customization_options.customization_type_id = $this->_menu_customization_type.id");
			
			//$this->db->join($this->_consulting_rates, "$this->_consulting_rates.lawyerid = $this->_lawyer_area_practices.userid", "left outer");
		//	$this->db->join($this->_area_practices, "$this->_area_practices.id = $this->_lawyer_area_practices.area_practice_id", "left outer");
			
			
		    $f = $this->db->get()->result();
			
			print_r($f);
			
			$cateory = 3;
			
			$this->db->select($this->_category.'.category_name, '.$this->_menu_items.'.id, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.description, '.$this->_menu_items.'.item_type');
			
			$this->db->where($this->_menu_category.'.main_category', $cateory);
			$this->db->where($this->_branch_menu.'.branch_id', 1);
			$this->db->where($this->_menu_category.'.user_id', 1);
			
			$this->db->from($this->_menu_category);
			
			$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
			
			$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
			
			$this->db->join($this->_branch_menu, "$this->_branch_menu.menu_id = $this->_menu_items.id");
			
			$res = $this->db->get()->result(); 
			
			foreach ($res as $result)
				{
					//$main_category['food'][$result->category_name][] = array('id' => $result->id, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type);
					
					$arr['menu'] = array('id' => $result->id, 'item' => $result->item_name, 'price' => $result->price, 'type' => $result->item_type);
					
					$this->db->select($this->_menu_customization_type.'.id as ctid, '.$this->_menu_customization_type.'.menu_id, '.$this->_menu_customization_type.'.customization_name as cname, '.$this->_menu_customization_type.'.customization_type, '.$this->_menu_customization_options.'.id as coid, '.$this->_menu_customization_options.'.customization_type_id, '.$this->_menu_customization_options.'.option_name, '.$this->_menu_customization_options.'.price');
			
					$this->db->where($this->_menu_customization_type.'.menu_id', $result->id);
					
					
					//$this->db->group_by($this->_menu_customization_options.'.customization_type_id');
					
					
					$this->db->from($this->_menu_customization_type);
					
					$this->db->join($this->_menu_customization_options, "$this->_menu_customization_options.customization_type_id = $this->_menu_customization_type.id");
					
					$results = $this->db->get()->result(); 
					
					print_r($results); die();
					
					if (count($results) > 0)
						{
							foreach ($results as $res_data)
								{
									$custom[$res_data->menu_id]['custom_name']['name']       =  $res_data->cname;
									$custom[$res_data->menu_id]['custom_name']['name']       =  $res_data->customization_type;
									$custom[$res_data->menu_id]['custom_name']['options'][]  =  array('name' => $res_data->option_name, 'price' => $res_data->price);
									
								}
						}
						
						print_r($custom);
					
					
					
				}
				
				print_r($main_category);
		
		}
		*/
		
		
}
