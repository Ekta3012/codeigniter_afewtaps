<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menumodel extends CI_Model {

    private $_menu_cuisines;
    private $_menu_customization_options;
    private $_menu_customization_type;
    private $_menu_items;
    private $_branch_menu;
	private $_category;
	private $_menu_category;
	private $_cuisine;
	private $_document_root;
	
    public function __construct()
		{
			parent::__construct();
		 
			$this->_menu_cuisines               =	   $this->db->dbprefix('menu_cuisines');
			$this->_menu_customization_options  = 	   $this->db->dbprefix('menu_customization_options');
			$this->_menu_customization_type     =      $this->db->dbprefix('menu_customization_type');
			$this->_menu_items                  =      $this->db->dbprefix('menu_items');
			$this->_branch_menu                 =      $this->db->dbprefix('branch_menu');
			$this->_category                    =      $this->db->dbprefix('category');
			$this->_menu_category               =      $this->db->dbprefix('menu_category');
			$this->_cuisine                     =      $this->db->dbprefix('cuisine');
			
			$this->_document_root               =      $_SERVER['DOCUMENT_ROOT'].'/menu_excels/';
		}
		
	public function uploadExcelFiles($userid = '')
		{
			$branch_id         		        =      getEstablishmentIdByUserId($userid);
			
			$config['upload_path']          =      $this->_document_root;
			$config['allowed_types']        =      'xls';
			$config['encrypt_name']         =      TRUE;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('userfile'))
				{
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('menu/index#uploadExcel');
				}
			else
				{
					$data = $this->upload->data();
					$full_path = $data['full_path'];
					
					$excel = new Spreadsheet_Excel_Reader();
					$excel->read($full_path); // set the excel file name here   
					$x = 2;
					$customization_type_id    =   '';
					while ($x <= $excel->sheets[0]['numRows']) 
						{	   
							   $category_name 				= 	$excel->sheets[0]['cells'][$x][1];
							   $sub_category_name   		= 	$excel->sheets[0]['cells'][$x][2];
							   $item_name 		    		= 	$excel->sheets[0]['cells'][$x][3];
							   $item_price          		= 	$excel->sheets[0]['cells'][$x][4];
							   $description         		= 	$excel->sheets[0]['cells'][$x][5];
							   $item_type           		= 	$excel->sheets[0]['cells'][$x][6];
							   $customization_name          = 	$excel->sheets[0]['cells'][$x][7];
							   $customization_type          = 	$excel->sheets[0]['cells'][$x][8];
							 
							   if (! empty($category_name) && ! empty($sub_category_name) && ! empty($item_name) && ! empty($item_price) && ! empty($item_type))
								   {
									   $category_id         =   ($category_name == "Foods") ? 1 : 2;
									   
									   $sub_query           =   $this->db->select('id')->get_where($this->_category, array('category_name' => $sub_category_name, 'user_id' => $userid));
									   
									   if ($sub_query->num_rows() > 0)
										   {
											   $sub_category_id = $sub_query->row()->id;
										   }
									   else
										   {
											   $this->db->insert($this->_category, array('category_name' => $sub_category_name, 'user_id' => $userid, 'utime' => time(), 'status' => 1 ));
											   $sub_category_id = $this->db->insert_id();
										   }
											   
											   /* Insert Menu Items */
											   
											   $menu_array = array('user_id' => $userid, 'item_name' => $item_name, 'price' => $item_price, 'description' => $description, 'item_type' => $item_type, 'date_added' => time(), 'ip_address' => $this->input->ip_address());
											   
											   $this->db->insert($this->_menu_items, $menu_array);
											   $menu_id  = $this->db->insert_id();
											   
											   
											   $this->db->insert($this->_branch_menu, array('branch_id' => $branch_id, 'menu_id' => $menu_id));
											   
												/* Insert Menu Category */
												
											   $menu_category = array('menu_id' => $menu_id, 'main_category' => $category_id, 'category_id' => $sub_category_id, 'user_id' => $userid);
											   
											   $this->db->insert($this->_menu_category, $menu_category);
											  
										   
											   if (! empty($customization_name) && ! empty($customization_type))
												 {
													$this->db->insert($this->_menu_customization_type, array('menu_id' => $menu_id, 'customization_name' => $customization_name, 'customization_type' => $customization_type));
													$customization_type_id = $this->db->insert_id();
												   
													$customization_options          = 	$excel->sheets[0]['cells'][$x][9];
													$customization_value            = 	$excel->sheets[0]['cells'][$x][10];
												   
													$this->db->insert($this->_menu_customization_options, array('customization_type_id' => $customization_type_id, 'option_name' => $customization_options, 'price' => $customization_value));
												 } 
								   }
							  else
								  {
									    if (! empty($customization_name) && ! empty($customization_type)) // For Second Customization Type //
											 {
												$this->db->insert($this->_menu_customization_type, array('menu_id' => $menu_id, 'customization_name' => $customization_name, 'customization_type' => $customization_type));
												$customization_type_id = $this->db->insert_id();
											 } 
 
										$customization_options          = 	$excel->sheets[0]['cells'][$x][9];
										$customization_value            = 	$excel->sheets[0]['cells'][$x][10];
										
										if (! empty($customization_options) && ! empty($customization_value))
										$this->db->insert($this->_menu_customization_options, array('customization_type_id' => $customization_type_id, 'option_name' => $customization_options, 'price' => $customization_value));
								  }
										$x = $x + 1;
						}
				}
										$this->session->set_flashdata('menu_add1', 1);
				                        redirect('menu/index#uploadExcel');
		}
		
		
	public function addMenuItems($id = '', $user_id = '')
		{
			$branch_id         		=  	getEstablishmentIdByUserId($user_id);
			//$cuisine           		=  	$this->input->post('cuisine');
			$maincategory      		=  	$this->input->post('cat');
			$category          		=  	(int) $this->input->post('category');
			$item_name         		=  	$this->input->post('item_name');
			$base_price        		=  	$this->input->post('base_price');
			$description       		=  	$this->input->post('description');
			
			if ($maincategory == 1)
			$item_type         		=  	$this->input->post('veg_nonveg_cat');
		         else
			$item_type         		=  	$this->input->post('drinks_cat');
			
			
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

			/*foreach ($cuisine as $cid)
				{
					$cmdata['menu_id']        =    $menu_id;
					$cmdata['cuisine_id']     =    $cid;
					$this->db->insert($this->_menu_cuisines, $cmdata);
				}
			*/
			
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
							        redirect('menu/index');
		}
		
	public function viewMenuItems($user_id = '')
		{
			$this->db->where('user_id', $user_id);
			return $this->db->get($this->_menu_items)->result();
		}
		
	/* Get All Cuisine */
	
	/*public function getMenuItems($userid = '', $categoryid = '') // 13 oct 2016
			{
				/*$this->db->select($this->_cuisine.'.id as cid, '. $this->_cuisine.'.cuisine, '.$this->_menu_category.'.menu_id');
				$this->db->where($this->_menu_category.'.user_id', $userid);
				$this->db->where($this->_menu_category.'.main_category', $categoryid);
				$this->db->order_by($this->_cuisine.'.id', 'asc');
				$this->db->from($this->_menu_category);
				$this->db->join($this->_menu_cuisines, "$this->_menu_cuisines.menu_id = $this->_menu_category.menu_id");
				$this->db->join($this->_cuisine, "$this->_cuisine.id = $this->_menu_cuisines.cuisine_id");
				$result =  $this->db->get()->result();
				$data['cuisines'] = $result;
				$data['items']    = array();
				if (count($result) > 0)
					{
						foreach ($result as $result_data)
							{
								$this->db->select($this->_menu_cuisines.'.menu_id, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.item_type');
								$this->db->where($this->_menu_cuisines.'.cuisine_id', $result_data->cid);
								$this->db->order_by($this->_menu_cuisines.'.cuisine_id', 'asc');
								$this->db->from($this->_menu_cuisines);
								$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_cuisines.menu_id");
								$menu_results =  $this->db->get()->result();
								$data['items'][$result_data->cid] = $menu_results;
							}
					}
				return $data;	
				
				//$this->db->distinct($this->_menu_category.'.category_id');
				
				$this->db->select($this->_category.'.id as cid, '. $this->_category.'.category_name, '.$this->_menu_category.'.menu_id');
				$this->db->group_by($this->_menu_category.'.category_id');
				$this->db->where($this->_menu_category.'.user_id', $userid);
				$this->db->where($this->_menu_category.'.main_category', $categoryid);
				//$this->db->order_by($this->_menu_category.'.id', 'asc');
				$this->db->from($this->_menu_category);
				
				
				$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
				
				//$this->db->join($this->_menu_cuisines, "$this->_menu_cuisines.menu_id = $this->_menu_category.menu_id");
				//$this->db->join($this->_cuisine, "$this->_cuisine.id = $this->_menu_cuisines.cuisine_id");

				$result 			=   $this->db->get()->result();
				
				$data['category'] 	= 	$result;
				$data['items']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $result_data)
							{
								//$this->db->select($this->_menu_cuisines.'.menu_id, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.item_type');
								//$this->db->where($this->_menu_cuisines.'.cuisine_id', $result_data->cid);
								//$this->db->order_by($this->_menu_cuisines.'.cuisine_id', 'asc');
								//$this->db->from($this->_menu_cuisines);
								//$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_cuisines.menu_id");
								//$menu_results =  $this->db->get()->result();
								
								$this->db->select('id as menu_id, item_name, price, item_type');
								$data['items'][$result_data->cid] = $this->db->get_where($this->_menu_items, array('id' => $result_data->menu_id))->result();
							}
					}
					
					print_r($data);
				    return $data;
					
			}
	*/

	public function getMenuItems($userid = '', $categoryid = '')
			{
				$this->db->select($this->_category.'.id as cid, '. $this->_category.'.category_name');
				$this->db->group_by($this->_menu_category.'.category_id');
				$this->db->where($this->_menu_category.'.user_id', $userid);
				$this->db->where($this->_menu_category.'.main_category', $categoryid);
				$this->db->from($this->_menu_category);
				$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
				$category_query = $this->db->get();
				
			    if ($category_query->num_rows() > 0)
					{
						 $sub_cat_result    =   $category_query->result();
						 $data['category'] 	= 	$sub_cat_result;
						 
						 foreach ($sub_cat_result as $cdata)
							 {
								 $subcatid =  $cdata->cid;
								 
								 $this->db->select($this->_menu_items.'.id as menu_id, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.item_type');
								 
								 $this->db->distinct($this->_menu_category.'.category_id');
								 
								 $this->db->where($this->_menu_category.'.user_id', $userid);
								 $this->db->where($this->_menu_category.'.main_category', $categoryid);
								 $this->db->where($this->_menu_category.'.category_id', $subcatid);
								 $this->db->from($this->_menu_category);
								 $this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
								 $menu_items_qry =  $this->db->get();
								 $data['items'][$subcatid]   =  $menu_items_qry->result();
							 }
					}
				                 return $data;
			}			
			
			
			
	public function getMenuItemsById($menuid = '', $userid = '')
		{
			$user_menu_exist  =  $this->db->get_where($this->_menu_items, array('id' => $menuid, 'user_id' => $userid))->num_rows();
			if ($user_menu_exist > 0)
				{
					$this->db->select('branch_id');
					$data['branch_id']     =  $this->db->get_where($this->_branch_menu, array('menu_id' => $menuid))->row()->branch_id;
					
					$this->db->select('category_id, main_category');
					$data['category_data'] =  $this->db->get_where($this->_menu_category, array('menu_id' => $menuid))->row();
					
					$this->db->select('item_name, price, description, item_type');
					$data['items_data']    =  $this->db->get_where($this->_menu_items, array('id' => $menuid))->row();
					
					$this->db->select('id, menu_id, customization_name, customization_type');
					$this->db->order_by($this->_menu_customization_type.'.id', 'asc');
					$customization_type_arr =  $this->db->get_where($this->_menu_customization_type, array('menu_id' => $menuid))->result();

					$data['menu'] = array();
					if (count($customization_type_arr) > 0)
						{
							foreach ($customization_type_arr as $key => $customization_type_data)
								{
									$this->db->select($this->_menu_customization_type.'.menu_id, '.$this->_menu_customization_options.'.option_name, '. $this->_menu_customization_options.'.price');
									$this->db->where($this->_menu_customization_type.'.id', $customization_type_data->id);
									$this->db->from($this->_menu_customization_type);
									$this->db->join($this->_menu_customization_options, "$this->_menu_customization_type.id = $this->_menu_customization_options.customization_type_id");
									$results = $this->db->get()->result();
									$data['menu'][$key]				  =	  (array) $customization_type_data;
									$data['menu'][$key]['options']    =   $results;
								}
						}
					
					return $data;
					
				}
		}
		
	public function checkMenuItemUser($menuid = '', $userid = '')
		{
			return  $this->db->get_where($this->_menu_items, array('id' => $menuid, 'user_id' => $userid))->num_rows();
		}
		
	public function updateMenuItems($menu_id = '', $user_id = '')
		{

			$branch_id         		=  	$this->input->post('branch');
			$maincategory      		=  	$this->input->post('cat');
			$category          		=  	(int) $this->input->post('category');
			
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
					
				}

			$this->db->where('menu_id', $menu_id);
			$this->db->delete($this->_menu_customization_type);
			
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
							$this->session->set_flashdata('menu_add', 'menu_add');
							redirect('menu/view/');
		}
		
		
		
	public function delMenu($menu_id = '', $user_id = '')
		{
			  $this->db->where('id', $menu_id)->delete($this->_menu_items);
			  redirect('menu/view');
		}
		
}
