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
	private $_order_menu_id;
	
	
	private $_restaurants_location;
    private $_restaurants_floor;

    private $_cinema_audi;
    private $_cinema_rows;
    private $_cinema_seats;
    private $_order_menu_customization_type;
    private $_order_menu_customization_options;
   
    public function __construct()
		{
			parent::__construct();
		 
			$this->_merchant_info               =	   $this->db->dbprefix('merchant_info');
			$this->_accounts                    =	   $this->db->dbprefix('accounts');
			$this->_estab_rating                =	   $this->db->dbprefix('estab_rating');
			$this->_order                       =	   $this->db->dbprefix('order');
			$this->_merchant_estab              =	   $this->db->dbprefix('merchant_estab');
			$this->_establishment               =	   $this->db->dbprefix('establishment');
			$this->_category                    =	   $this->db->dbprefix('category');
			$this->_menu_category               =	   $this->db->dbprefix('menu_category');
			$this->_menu_items                  =	   $this->db->dbprefix('menu_items');
			$this->_branch_menu                 =	   $this->db->dbprefix('branch_menu');
			$this->_menu_customization_type     =	   $this->db->dbprefix('menu_customization_type');
			$this->_menu_customization_options  =      $this->db->dbprefix('menu_customization_options');
			$this->_users                       =      $this->db->dbprefix('accounts');
			$this->_staff_member                =      $this->db->dbprefix('staff_member');
			$this->_order_menu_id               =      $this->db->dbprefix('order_menu_id');
			
			$this->_restaurants_location        =      $this->db->dbprefix('restaurants_location');
			$this->_restaurants_floor           =      $this->db->dbprefix('restaurants_floor');
			
			$this->_cinema_audi                 =      $this->db->dbprefix('cinema_audi');
			$this->_cinema_rows                 =      $this->db->dbprefix('cinema_rows');
			$this->_cinema_seats                =      $this->db->dbprefix('cinema_seats');
			

			$this->_order_menu_customization_type     =      $this->db->dbprefix('order_menu_customization_type');
			$this->_order_menu_customization_options  =      $this->db->dbprefix('order_menu_customization_options');
			
		}
		
	public function getAudis()
		{
			$establid = $this->uri->segment(3);
			return $this->db->get_where($this->_cinema_audi, array('cinema_id' => $establid))->result();
		}
		
		
	public function getServiceRatingTable()
		{
			$establid = $this->uri->segment(3);
			if (! empty($establid))
				{
					$this->db->select($this->_order.'.order_id, '.$this->_order.'.establishment_id, '.$this->_order.'.customer_id, '.$this->_users.'.id, '.$this->_users.'.name, '.$this->_staff_member.'.name as staff_name, '.$this->_staff_member.'.name, '.$this->_staff_member.'.employee_id');
					$this->db->where($this->_order.'.establishment_id', $establid);
					$this->db->order_by($this->_order.'.order_id', 'asc');
					
					$this->db->from($this->_order);
					$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id");
					$this->db->join($this->_staff_member, "$this->_staff_member.id = $this->_order.staff_member_id", "left outer");
					return $this->db->get()->result();
			    }
				
			
			
			/*$userid = $this->uri->segment(3);
			$segment = $this->uri->segment(4,1);
			
			if ( ! empty($userid))
			$estabid = getEstablishmentIdByUserId($userid);
			
			if ($segment == 1 &&  ! empty($userid))
				{
					/* $this->db->select($this->_order.'.	order_id,  '.$this->_order.'.establishment_id,'.$this->_order.'.customer_id,'.$this->_users.'.id,'.$this->_users.'.name,'.$this->_order.'.staff_member_id, '.$this->_merchant_estab.'.estabid');
					
					// $this->db->group_by($this->_establishment.'.id');
					// $this->db->where($this->_merchant_estab.'.userid', $userid);
					
					$this->db->from($this->_merchant_estab);
					$this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
					$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id","left");
					
					// $this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id");
					
					$this->db->where($this->_merchant_estab.'.userid', $userid);
				  
					$result 			=   $this->db->get()->result();

					$data['order'] 	    = 	$result;
					
					$data['ser_id']    	= 	array();

					if (count($result) > 0)
						{
							foreach ($result as $resul)
								{
									$this->db->select('name,id,employee_id');
									$data['ser_id'][$resul->staff_member_id] = $this->db->get_where($this->_staff_member, array('id' => $resul->staff_member_id))->result();
									
									$this->db->select_max('id');
									$data['est_rating'] = $this->db->get_where($this->_estab_rating, array('estabid' => $resul->establishment_id))->result();
								}
								
								foreach ($data['est_rating'] as $est_rating)
									{
										$this->db->select('rating');
										$data['rating'] = $this->db->get_where($this->_estab_rating, array('id' => $est_rating->id))->result();
									}
										//print_r($data['rating']); die();
						}
						
					

					$this->db->select($this->_order.'.	order_id,  '.$this->_order.'.establishment_id,'.$this->_order.'.customer_id,'.$this->_users.'.id,'.$this->_users.'.name,'.$this->_order.'.staff_member_id, '.$this->_merchant_estab.'.estabid');
					$this->db->where($this->_merchant_estab.'.userid', $userid);
					$this->db->from($this->_merchant_estab);
					
					$this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
					$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id","left");

					$result 			=   $this->db->get()->result();

					$data['order'] 	    = 	$result;
					
					$data['ser_id']    	= 	array();

					if (count($result) > 0)
						{
							foreach ($result as $resul)
								{
									$this->db->select('name,id,employee_id');
									$data['ser_id'][$resul->staff_member_id] = $this->db->get_where($this->_staff_member, array('id' => $resul->staff_member_id))->result();
									
									$this->db->select_max('id');
									$data['est_rating'] = $this->db->get_where($this->_estab_rating, array('estabid' => $resul->establishment_id))->result();
								}
								
								foreach ($data['est_rating'] as $est_rating)
									{
										$this->db->select('rating');
										$data['rating'] = $this->db->get_where($this->_estab_rating, array('id' => $est_rating->id))->result();
									}
						}
										return $data;					
				}
		elseif ($segment == 2 &&  ! empty($userid))
			{
					$this->db->select($this->_order.'.order_id,  '.$this->_order.'.establishment_id,'.$this->_order.'.customer_id,'.$this->_users.'.id,'.$this->_users.'.name,'.$this->_order.'.staff_member_id');
					$this->db->from($this->_order);
					$this->db->where($this->_order.'.establishment_id', $estabid);
					$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id","left");
					$result 			=   $this->db->get()->result();
					$data['order'] 	    = 	$result;
					if (count($result) > 0)
						{
							foreach ($result as $resul)
								{
									if ($resul->staff_member_id != 0)
										{
											$this->db->select('name,id,employee_id');
											$data['staff'][$resul->order_id] = $this->db->select('name, employee_id')->get_where($this->_staff_member, array('id' => $resul->staff_member_id))->row();
										}
								}
						}
									return $data;
			}*/
			
	}
	
	
	
		
		public function addLocationModule1() // old
			{
				$estabid  =  $this->input->post('estabid'); 
				$type     =  $this->input->post('type'); 
				if ($type == 1)
					{
					   $audi = $this->input->post('audi');

					   if (is_array($audi) && count($audi) > 0)
							{
							  foreach ($audi as $key => $value)
								  {
									  if (isset($value['name']))
										  {
											  $audi_name =  $value['name'];
									  
											  $this->db->insert($this->_cinema_audi, array('cinema_id' => $estabid, 'audi_id' => $audi_name));
											  $cinema_audi_id = $this->db->insert_id();
										  }
									  
									  
									  $row_no    =  $value['row_no'][$key]['no'];
									  
									  $this->db->insert($this->_cinema_rows, array('cinema_audi_id' => $cinema_audi_id, 'row_no' => $row_no));
									  $cinema_rows_id = $this->db->insert_id();
									  
									  foreach ($value['row_no'][$key]['seat_no'] as $seat_no)
										  {
											  $this->db->insert($this->_cinema_seats, array('cinema_rows_id' => $cinema_rows_id, 'seats_no' => $seat_no, 'ttime' =>  time()));
										  }
								  }
							}
					}
				else
					{	 
						 $rest    =  $this->input->post('rest');
						 
						 foreach ($rest as $key => $rdata)
							{
								$res =  $this->db->get_where($this->_restaurants_floor, array('estab_id' => $estabid, 'floor_id' => $rdata['floor_id']));
								if ($res->num_rows() > 0)
								$restaurants_floor_id = $res->row()->id;
								else
									{
										$this->db->insert($this->_restaurants_floor, array('estab_id' => $estabid, 'floor_id' => $rdata['floor_id'], 'ftime' => time()));
										$restaurants_floor_id = $this->db->insert_id();
									}
									
								$this->db->insert($this->_restaurants_location, array('restaurant_floor_id' => $restaurants_floor_id, 'location_name' => $rdata['location_name'], 'form' => $rdata['form'], 'ttime' => time()));
							}
					}
					            redirect('establishmentdata/location');
			}
			
			
			
		public function addLocationModule() // New
			{
				$estabid  =  $this->input->post('estabid'); 
				$type     =  $this->input->post('type'); 
				if ($type == 1)
					{
					         $audi_name = $this->input->post('audi');
							 
							 $exp_id  = explode('_', $audi_name);
							 if (count($exp_id) == 2)
								{
									$cinema_audi_id = $exp_id[1];
								}
							 else
								{
									$this->db->insert($this->_cinema_audi, array('cinema_id' => $estabid, 'audi_id' => $audi_name));
									$cinema_audi_id = $this->db->insert_id();
								}
							 
											  
							 $row_no    =  $this->input->post('rowno');
									  
							 $this->db->insert($this->_cinema_rows, array('cinema_audi_id' => $cinema_audi_id, 'row_no' => $row_no));
							 $cinema_rows_id = $this->db->insert_id();
							 
			                 $seats_no    =  $this->input->post('audi_seats');
							 foreach ($seats_no as $seat_no)
								  {
									  $this->db->insert($this->_cinema_seats, array('cinema_rows_id' => $cinema_rows_id, 'seats_no' => $seat_no, 'ttime' =>  time()));
								  }
					}
				else
					{	 
						 $rest    =  $this->input->post('rest');
						 
						 foreach ($rest as $key => $rdata)
							{
								$res =  $this->db->get_where($this->_restaurants_floor, array('estab_id' => $estabid, 'floor_id' => $rdata['floor_id']));
								if ($res->num_rows() > 0)
								$restaurants_floor_id = $res->row()->id;
								else
									{
										$this->db->insert($this->_restaurants_floor, array('estab_id' => $estabid, 'floor_id' => $rdata['floor_id'], 'ftime' => time()));
										$restaurants_floor_id = $this->db->insert_id();
									}
									
								$this->db->insert($this->_restaurants_location, array('restaurant_floor_id' => $restaurants_floor_id, 'location_name' => $rdata['location_name'], 'form' => $rdata['form'], 'ttime' => time()));
							}
					}
					            redirect('establishmentdata/location');
			}
			
			
		public function delRestModule($id = '')
			{
				$this->db->where('restaurant_floor_id', $id)->delete($this->_restaurants_location);	
			}
			
		
		public function getFlrInfo($id = '')
			{
			    $this->db->select($this->_restaurants_location.'.id, '.$this->_restaurants_floor.'.floor_id, '.$this->_restaurants_location.'.location_name, '.$this->_restaurants_location.'.form');
				$this->db->where($this->_restaurants_floor.'.estab_id', $id);
				$this->db->from($this->_restaurants_floor);
				$this->db->join($this->_restaurants_location, "$this->_restaurants_location.restaurant_floor_id = $this->_restaurants_floor.id");
				$res = $this->db->get()->row();
				return $res;
			}

			
		public function updateFlrInfo($id = '')
			{
			    $fdata['location_name']  =  $this->input->post('rest');
			    $fdata['form']           =  $this->input->post('form');
				$this->db->where('id', $id)->update($this->_restaurants_location, $fdata);
			}

		public function viewLocationModule($userid = '')
			{
				$estabid   		=  $this->uri->segment(3); 
				
				$data           =  array();
				$data['cinema'] =  '';
				$data['rest']   =  '';
				
				$cinema_query   =  $this->db->get_where($this->_cinema_audi, array('cinema_id' => $estabid));
				if ($cinema_query->num_rows()> 0) 
					{
						$data['cinema'] = $cinema_query->result();
					}
				else
					{
						$rest_query     =  $this->db->get_where($this->_restaurants_floor, array('estab_id' => $estabid));
						if ($rest_query->num_rows() > 0)
							{
								$this->db->select($this->_restaurants_location.'.id, '.$this->_restaurants_floor.'.floor_id, '.$this->_restaurants_location.'.location_name, '.$this->_restaurants_location.'.form');
								$this->db->where($this->_restaurants_floor.'.estab_id', $estabid);
								$this->db->order_by($this->_restaurants_floor.'.floor_id');
								$this->db->from($this->_restaurants_floor);
								$this->db->join($this->_restaurants_location, "$this->_restaurants_location.restaurant_floor_id = $this->_restaurants_floor.id");
								$data['rest'] =  $this->db->get()->result();
							}
					}
								return $data;
			}
			
			
		public function getEstabLocInfo($id = '')
			{	
				$data           =  array();
				$data['cinema'] =  '';
				$data['rest']   =  '';
				
				$cinema_query   =  $this->db->get_where($this->_cinema_audi, array('id' => $id));
				if ($cinema_query->num_rows()> 0) 
					{
						$data['cinema'] = $cinema_query->row();
					}
				else
					{
						$rest_query     =  $this->db->get_where($this->_restaurants_floor, array('estab_id' => $estabid));
						if ($rest_query->num_rows() > 0)
							{
								$this->db->select($this->_restaurants_floor.'.floor_id, '.$this->_restaurants_location.'.location_name, '.$this->_restaurants_location.'.form');
								$this->db->where($this->_restaurants_floor.'.estab_id', $estabid);
								$this->db->order_by($this->_restaurants_floor.'.floor_id');
								$this->db->from($this->_restaurants_floor);
								$this->db->join($this->_restaurants_location, "$this->_restaurants_location.restaurant_floor_id = $this->_restaurants_floor.id");
								$data['rest'] =  $this->db->get()->result();
							}
					}
					
					
								return $data;
			}
			
		public function delAudiModule($id = '')
			{
				  
				$cinema_id = $this->db->select('cinema_id')->get_where($this->_cinema_audi, array('id' => $id))->row()->cinema_id;
		  
				$this->db->where('id', $id)->delete($this->_cinema_audi);
		  
				$qry = $this->db->select('id')->get_where($this->_cinema_rows, array('cinema_audi_id' => $id));
				foreach ($qry->result() as $qresult)
					{
						$cid[] = $qresult->id;
					}
		  
				$this->db->where_in('id', implode(',', $cid))->delete($this->_cinema_rows);

				$seat_qry = $this->db->select('GROUP_CONCAT(id) as id', false)->where_in('cinema_rows_id', $cinema_rows_id)->get($this->_cinema_seats);
		  
				foreach ($seat_qry->result() as $sresult)
					{
						$sid[] = $sresult->id;
					}
					
				$this->db->where_in('id', implode(',', $sid))->delete($this->_cinema_seats);
				  
			}		
		
		
		public function updateLocationModule1($id = '')	// old
			{
				$estabid  =  $this->input->post('estabid'); 
				$type     =  $this->input->post('type');
				if ($type == 1)
					{
						
					   /* before delete after update */
					   
					    $cinema_id = $this->db->select('cinema_id')->get_where($this->_cinema_audi, array('id' => $id))->row()->cinema_id;
				  
						$this->db->where('id', $id)->delete($this->_cinema_audi);
				  
				        $qry = $this->db->select('id')->get_where($this->_cinema_rows, array('cinema_audi_id' => $id));
						foreach ($qry->result() as $qresult)
							{
								$cid[] = $qresult->id;
							}
				  
				        $this->db->where_in('id', implode(',', $cid))->delete($this->_cinema_rows);
 
				        $seat_qry = $this->db->select('GROUP_CONCAT(id) as id', false)->where_in('cinema_rows_id', $cinema_rows_id)->get($this->_cinema_seats);
				  
						foreach ($seat_qry->result() as $sresult)
							{
								$sid[] = $sresult->id;
							}
							
				        $this->db->where_in('id', implode(',', $sid))->delete($this->_cinema_seats);
					  /* close */
					  
					  
					   $audi = $this->input->post('audi');
		
					   if (is_array($audi) && count($audi) > 0)
							{
							  foreach ($audi as $key => $value)
								  {
									  $audi_name =  $value['name'];
									  
									  if (isset($value['name']))
										  {
											  $audi_name =  $value['name'];
									  
											  $this->db->insert($this->_cinema_audi, array('cinema_id' => $estabid, 'audi_id' => $audi_name));
											  $cinema_audi_id = $this->db->insert_id();
										  }
									  
									  $row_no    =  $value['row_no'][$key]['no'];
									  
									  $this->db->insert($this->_cinema_rows, array('cinema_audi_id' => $cinema_audi_id, 'row_no' => $row_no));
									  $cinema_rows_id = $this->db->insert_id();
									  
									  foreach ($value['row_no'][$key]['seat_no'] as $seat_no)
										  {
											  $this->db->insert($this->_cinema_seats, array('cinema_rows_id' => $cinema_rows_id, 'seats_no' => $seat_no, 'ttime' =>  time()));
										  }
								  }
							}
					}
				else
					{	 
						 $sep_ids = $this->db->select('GROUP_CONCAT(id) as id')->get_where($this->_restaurants_floor, array('estab_id' => $estabid))->row()->id;
		 
						 $this->db->where('estab_id', $estabid)->delete($this->_restaurants_floor);
						 $this->db->where('restaurant_floor_id', $sep_ids)->delete($this->_restaurants_location);
						
						 $rest    =  $this->input->post('rest');
						 foreach ($rest as $key => $rdata)
							{
								$res =  $this->db->get_where($this->_restaurants_floor, array('estab_id' => $estabid, 'floor_id' => $rdata['floor_id']));
								if ($res->num_rows() > 0)
								$restaurants_floor_id = $res->row()->id;
								else
									{
										$this->db->insert($this->_restaurants_floor, array('estab_id' => $estabid, 'floor_id' => $rdata['floor_id'], 'ftime' => time()));
										$restaurants_floor_id = $this->db->insert_id();
									}
									
								$this->db->insert($this->_restaurants_location, array('restaurant_floor_id' => $restaurants_floor_id, 'location_name' => $rdata['location_name'], 'form' => $rdata['form'], 'ttime' => time()));
							}
					}
					
					redirect('establishmentdata/viewlocation/'.$estabid);
			}	




		public function updateLocationModule($id = '')
			{
				$type     =  $this->input->post('type');
				if ($type == 1)
					{
						 $audi_name = $this->input->post('audi');
							 
						 $this->db->where('id', $id)->update($this->_cinema_audi, array('audi_id' => $audi_name));
						 
						 $row_no    =  $this->input->post('rowno');
								  
						 $this->db->update($this->_cinema_rows, array('cinema_audi_id' => $id, 'row_no' => $row_no));

						 
						 $seats_no     =  $this->input->post('audi_seats');
						 
						 foreach ($seats_no[1] as $k => $seat_no)
							  {
								  $this->db->where('id', $k)->update($this->_cinema_seats, array('seats_no' => $seat_no));
							  }
							  
						 foreach ($seats_no[0] as $seat_number)
							  {
								  $this->db->insert($this->_cinema_seats, array('cinema_rows_id' => $id, 'seats_no' => $seat_number));
							  }
					}
				else
					{	 
						 $sep_ids = $this->db->select('GROUP_CONCAT(id) as id')->get_where($this->_restaurants_floor, array('estab_id' => $estabid))->row()->id;
		 
						 $this->db->where('estab_id', $estabid)->delete($this->_restaurants_floor);
						 $this->db->where('restaurant_floor_id', $sep_ids)->delete($this->_restaurants_location);
						
						 $rest    =  $this->input->post('rest');
						 foreach ($rest as $key => $rdata)
							{
								$res =  $this->db->get_where($this->_restaurants_floor, array('estab_id' => $estabid, 'floor_id' => $rdata['floor_id']));
								if ($res->num_rows() > 0)
								$restaurants_floor_id = $res->row()->id;
								else
									{
										$this->db->insert($this->_restaurants_floor, array('estab_id' => $estabid, 'floor_id' => $rdata['floor_id'], 'ftime' => time()));
										$restaurants_floor_id = $this->db->insert_id();
									}
									
								$this->db->insert($this->_restaurants_location, array('restaurant_floor_id' => $restaurants_floor_id, 'location_name' => $rdata['location_name'], 'form' => $rdata['form'], 'ttime' => time()));
							}
					}
					
					redirect('establishmentdata/viewlocation/'.$estabid);
			}			
		
		
		public function getMerchantInfo()
			{
				$userid = $this->uri->segment('3');
				 $this->db->select($this->_merchant_info.'.	contact_person,  '.$this->_merchant_info.'.contact_no,'.$this->_merchant_info.'.email, '.$this->_merchant_info.'.beneficiary_name,  '.$this->_merchant_info.'.bank_name,  '.$this->_merchant_info.'.bank_ac_no,  '.$this->_merchant_info.'.ifsc_swift_code,  '.$this->_merchant_info.'.account_type,  '.$this->_merchant_info.'.com_col_start_dt,  '.$this->_merchant_info.'.com_slab,  '.$this->_merchant_info.'.merchant_tan');
			
				  $this->db->from($this->_merchant_info);
				//$this->db->join($this->_merchant_estab, "$this->_merchant_info.userid = $this->_merchant_estab.userid");
				//$this->db->join($this->_establishment, "$this->_establishment.id = $this->_merchant_estab.estabid");
				
				$this->db->where($this->_merchant_info.'.userid', $userid);
				//echo $this->uri->segment('3'); die();
				  return $this->db->get()->result();
			}
		
		public function UpdateMerchantSlab()
			{
				$userid = $this->uri->segment('3');
				list($cmonth, $cdate, $cyear) =   explode ('/', $this->input->post('com_col_strt_dt'));
				
				$data['com_col_start_dt']     =  	mktime(0, 0, 0, $cmonth, $cdate, $cyear);
				
				$data['com_slab']  	          =  	$this->input->post('com_slab');
				
				$data['rtime']  	          =  	time();
		
				$num_rows  =  (int) $this->db->get_where($this->_merchant_info, array('userid' => $userid))->num_rows();
				
				if ($num_rows > 0)
					{
						$this->db->where('userid', $userid);
						$this->db->update($this->_merchant_info, $data);
						$this->session->set_flashdata('minfoupd', 'minfoupd');
					}
						
						redirect('establishmentdata/merchant/'.$userid);
			}
		
		
		
		
		
		
		//	public function getMenuItems($categoryid = '',$userid = '')
		
	public function getMenuItems($estabid = '', $categoryid = 1)
		{
			if ($estabid != '')
				{

					/*$userid  = $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->userid;
					
					$this->db->select('GROUP_CONCAT('.$this->_menu_category.'.menu_id) as menuid,'.$this->_category.'.category_name,'.$this->_category.'.id as cid');
					$this->db->from($this->_menu_category);
					$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
					$this->db->group_by($this->_menu_category.'.category_id');
					$this->db->where($this->_menu_category.'.user_id', $userid);
					$this->db->where($this->_menu_category.'.category_id', $categoryid);
					
					$result 			=   $this->db->get()->result();
					
					*/
					

					$userid  = $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->userid;
						
						
					/*$this->db->select($this->_category.'.id as cid, '. $this->_category.'.category_name, '.$this->_menu_category.'.menu_id as menuid');
					$this->db->group_by($this->_menu_category.'.category_id');
					$this->db->where($this->_menu_category.'.user_id', $userid);
					$this->db->where($this->_menu_category.'.main_category', $categoryid);
					$this->db->from($this->_menu_category);
					$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
					$result = $this->db->get()->result();
					*/
					
					/*$this->db->select($this->_menu_category.'.main_category, '.$this->_category.'.category_name, '.$this->_menu_items.'.id as mid, '.$this->_menu_items.'.item_name, '.$this->_menu_items.'.price, '.$this->_menu_items.'.description, '.$this->_menu_items.'.item_type');
					$this->db->where($this->_menu_category.'.main_category', $categoryid);
					$this->db->where($this->_menu_category.'.user_id', $userid);
					$this->db->order_by($this->_menu_category.'.category_id',  'asc');
					$this->db->order_by($this->_menu_items.'.item_type',  'asc');
					$this->db->from($this->_menu_category);
					$this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
					$this->db->join($this->_category, "$this->_category.id = $this->_menu_category.category_id");
					return $this->db->get()->result();	*/
					
					
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
					return ;
		}
	
			
	public function FavFood()
		{
			//$userid        =  $this->uri->segment('3');

			$estabid        =  $this->uri->segment('3');
			
			$userid         = $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->estabid;
			
			
			$startdate     =  $this->input->post('start_date1');
			$enddate       =  $this->input->post('end_date1');
			
			$start_date2   =  $this->input->post('start_date2');
			$end_date2     =  $this->input->post('end_date2');
			
			if($startdate != '' && $enddate != '')
			{
			list ($startmonth, $startday, $startyear)   =    explode ('/', $startdate);
			$startmktime								=    mktime (0, 0, 0, $startmonth, $startday, $startyear);
			list ($endmonth, $endday, $endyear) 		=    explode ('/', $enddate);
			$endmktime                                  =    mktime (23, 59, 59, $endmonth, $endday, $endyear);
			
			    $this->db->select($this->_merchant_estab.'.estabid');
			    //$this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
				//$this->db->group_by($this->_order_menu_id.'.menu_id');
			    //$this->db->join($this->_order, "$this->_order.customer_id = $this->_menu_category.user_id");
				$this->db->where(array('userid' =>$userid));
				
				$this->db->from($this->_merchant_estab);
				$result 			=   $this->db->get()->result();
				$data['estab_id'] 	= 	$result;
				
				if (count($result) > 0)
					{
						foreach ($result as $result_data)
							{
								
								$this->db->select('count('.$this->_order_menu_id.'.qty) as quantity,'.$this->_order.'.order_id,'.$this->_order_menu_id.'.menu_id,'.$this->_menu_category.'.main_category');
			    $this->db->join($this->_order_menu_id, "$this->_order_menu_id.order_id = $this->_order.order_id");
				$this->db->group_by($this->_order_menu_id.'.menu_id');
			    $this->db->join($this->_menu_category, "$this->_menu_category.menu_id = $this->_order_menu_id.menu_id");
				
				$this->db->where(array($this->_order.'.establishment_id' =>$result_data->estabid,$this->_order.'.status' =>'3',$this->_order.'.order_time >=' => $startmktime, $this->_order.'.order_time <=' => $endmktime));
				
				$this->db->from($this->_order);
				$results 			=   $this->db->get()->result();
				$data['category'] 	= 	$results;
				
				
				if (count($data['category']) > 0)
					{
						foreach ($data['category'] as $result_data)
							{
								
							if($result_data->quantity>1 && $result_data->main_category==1)
							  {
							 	
								/**/
								$this->db->select('id as menu_id, item_name');
								
								$data['items_food'][$result_data->menu_id] = $this->db->get_where($this->_menu_items, array('id' => $result_data->menu_id))->result                                ();
								
								
								
								  foreach ($data['items_food'] as $key => $item_data)
										{ foreach ($item_data as $item_result)
												{  
								
												}
										}
								 $fav_foods[] = array('name' => $item_result->item_name, 'y' => (int) $result_data->quantity, 'drilldown' => $item_result->item_name);
							}
							
							else if($result_data->quantity>1 && $result_data->main_category==2)
							{
								
								$this->db->select('id as menu_id, item_name');
								
								$data['items_beverage'][$result_data->menu_id] = $this->db->get_where($this->_menu_items, array('id' => $result_data->menu_id))->result                                ();
								  foreach ($data['items_beverage'] as $key => $item_data)
										{ foreach ($item_data as $item_result)
												{  
								
												}
										}
								 $fav_beverages[] = array('name' => $item_result->item_name, 'y' => (int) $result_data->quantity, 'drilldown' => $item_result->item_name);
							}
							//print_r($data['menuid']);
							
							}
							//print_r($fav_foods);
						//print_r($fav_beverages); die();	
					}
				
							}
							
					}
					
					 $data['favorite_foods'] = json_encode($fav_foods);
					 $data['favorite_beverages'] = json_encode($fav_beverages);
					 return $data;
			
			}
				
				
				else if($start_date2!='' && $end_date2!='')
			{
			list ($startmonth, $startday, $startyear)   =   explode ('/', $start_date2);
			$startmktime = mktime (0, 0, 0, $startmonth, $startday, $startyear);
			list ($endmonth, $endday, $endyear) 		=    explode ('/', $end_date2);
			$endmktime   = mktime (23, 59, 59, $endmonth, $endday, $endyear);
			
			    $this->db->select($this->_merchant_estab.'.estabid');
			    //$this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
				//$this->db->group_by($this->_order_menu_id.'.menu_id');
			    //$this->db->join($this->_order, "$this->_order.customer_id = $this->_menu_category.user_id");
				$this->db->where(array('userid' =>$userid));
				
				$this->db->from($this->_merchant_estab);
				$result 			=   $this->db->get()->result();
				$data['estab_id'] 	= 	$result;
				
				if (count($result) > 0)
					{
						foreach ($result as $result_data)
							{
								
								$this->db->select('count('.$this->_order_menu_id.'.qty) as quantity,'.$this->_order.'.order_id,'.$this->_order_menu_id.'.menu_id,'.$this->_menu_category.'.main_category');
			    $this->db->join($this->_order_menu_id, "$this->_order_menu_id.order_id = $this->_order.order_id");
				$this->db->group_by($this->_order_menu_id.'.menu_id');
			    $this->db->join($this->_menu_category, "$this->_menu_category.menu_id = $this->_order_menu_id.menu_id");
				
				$this->db->where(array($this->_order.'.establishment_id' =>$result_data->estabid,$this->_order.'.status' =>'3',$this->_order.'.order_time >=' => $startmktime, $this->_order.'.order_time <=' => $endmktime));
				
				$this->db->from($this->_order);
				$results 			=   $this->db->get()->result();
				$data['category'] 	= 	$results;
				
				
					if (count($data['category']) > 0)
					{
						
						foreach ($data['category'] as $result_data)
							{
								
							if($result_data->quantity>1 && $result_data->main_category==1)
							{
								
								
								
								/**/
								$this->db->select('id as menu_id, item_name');
								
								$data['items_food'][$result_data->menu_id] = $this->db->get_where($this->_menu_items, array('id' => $result_data->menu_id))->result();
								
								
								
								  foreach ($data['items_food'] as $key => $item_data)
										{ foreach ($item_data as $item_result)
												{  
								
												}
										}
								 $fav_foods[] = array('name' => $item_result->item_name, 'y' => (int) $result_data->quantity, 'drilldown' => $item_result->item_name);
							}
							
							else if($result_data->quantity>1 && $result_data->main_category==2)
							{
								
								$this->db->select('id as menu_id, item_name');
								
								$data['items_beverage'][$result_data->menu_id] = $this->db->get_where($this->_menu_items, array('id' => $result_data->menu_id))->result                                ();
								  foreach ($data['items_beverage'] as $key => $item_data)
										{ foreach ($item_data as $item_result)
												{  
								
												}
										}
								 $fav_beverages[] = array('name' => $item_result->item_name, 'y' => (int) $result_data->quantity, 'drilldown' => $item_result->item_name);
							}
							//print_r($data['menuid']);
							
							}
							//print_r($fav_foods);
						//print_r($fav_beverages); die();	
					}
				
				
				
								
							}
							
					}
					
					 $data['favorite_foods'] = json_encode($fav_foods);
					 $data['favorite_beverages'] = json_encode($fav_beverages);
					 return $data;
				
				
			
			
			
			}
				
				
				else
				{
				
				
				
				//$userid = $this->uri->segment('3');	
				
				$estabid        =  $this->uri->segment('3');
			
				$userid         =  $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->estabid;
			
			
				/*13/8 above*/
			
				$this->db->select('count('.$this->_order_menu_id.'.qty) as quantity,'.$this->_menu_category.'.main_category,'.$this->_order_menu_id.'.menu_id');
			    $this->db->join($this->_order_menu_id, "$this->_order_menu_id.menu_id = $this->_menu_category.menu_id");
				$this->db->group_by($this->_order_menu_id.'.menu_id');
			    //$this->db->join($this->_order, "$this->_order.customer_id = $this->_menu_category.user_id");
				$this->db->where(array('user_id' =>$userid));
				
				$this->db->from($this->_menu_category);
			
				$result 			=   $this->db->get()->result();
				$data['category'] 	= 	$result;
			
				$data['items_food']    	= 	array();
				$data['items_beverage']    	= 	array();
				$data['item_sold']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $result_data)
							{
							if($result_data->quantity>1 && $result_data->main_category==1)
							{
								
								
								
								/**/
								$this->db->select('id as menu_id, item_name');
								
								$data['items_food'][$result_data->menu_id] = $this->db->get_where($this->_menu_items, array('id' => $result_data->menu_id))->result                                ();
								  foreach ($data['items_food'] as $key => $item_data)
										{ foreach ($item_data as $item_result)
												{  
								
												}
										}
								 $fav_foods[] = array('name' => $item_result->item_name, 'y' => (int) $result_data->quantity, 'drilldown' => $item_result->item_name);
							}
							
							else if($result_data->quantity>1 && $result_data->main_category==2)
							{
								$this->db->select('id as menu_id, item_name');
								
								$data['items_beverage'][$result_data->menu_id] = $this->db->get_where($this->_menu_items, array('id' => $result_data->menu_id))->result                                ();
								  foreach ($data['items_beverage'] as $key => $item_data)
										{ foreach ($item_data as $item_result)
												{  
								
												}
										}
								 $fav_beverages[] = array('name' => $item_result->item_name, 'y' => (int) $result_data->quantity, 'drilldown' => $item_result->item_name);
							}
							
							
							}
							
					}
					 $data['favorite_foods'] = json_encode($fav_foods);
					 $data['favorite_beverages'] = json_encode($fav_beverages);
					//print_r( $data['favorite_foods']);
					//print_r( $data['favorite_beverages']);
					//die();
					
				return $data;
				}
				
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
		$userid = $this->uri->segment('3');
		
		if($userid!='')
		{
		
			
			$this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.location, '.$this->_order.'.status, '.$this->_order.'.completion_time, '.$this->_merchant_estab.'.estabid, '.$this->_order.'.establishment_id');
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_merchant_estab);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
			   $this->db->where($this->_merchant_estab.'.userid', $userid);
				$order = 	 $this->db->get()->result();
				$month_orders['allorder'] = $order ;
				if (count($order) > 0)
						{
							foreach ($order as  $estbaid)
								{
		
		/*25_8_2016*/
		
		$first_day_month    =  strtotime('first day this month');
		//$start_date1         		=  	$this->input->post('start_date1');
		//$end_date1      		=  	$this->input->post('end_date1');
			
			for ($i = 7; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
			  {
				  
				  $month_name     	  =  date('M', strtotime("-$i month", $first_day_month));
				  
				  $month_numeric      =  date('m', strtotime("-$i month", $first_day_month));
				  
				  $year               =  date('Y', strtotime("-$i month", $first_day_month));
				  
				  $yr                 =  date('y', strtotime("-$i month", $first_day_month));
				  
				  
				  $total_days         =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
				  
				  $start_time         =  mktime (0, 0, 0, $month_numeric, 1, $year);
				  $end_time           =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
				  
				 
				  $mname              =  $month_name." '".$yr;
			
				  $this->db->select('SUM(total_amount) as amount');
				  $total_price  =  $this->db->get_where($this->_order, array('status' => 3,'establishment_id' => $estbaid->estabid ,'order_time >=' => $start_time, 'order_time <=' => $end_time))->row()->amount;
				  
				  
				    $this->db->select('COUNT(*) as total');
				  $completed =  $this->db->get_where($this->_order, array('status' => 3, 'establishment_id' => $estbaid->estabid , 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
				  
				   $this->db->select('completion_time, order_time');
				  $averagetime =  $this->db->get_where($this->_order, array('status' => 3, 'establishment_id' => $estbaid->estabid , 'order_time >=' => $start_time, 'order_time <=' => $end_time))->result();
			
			 foreach($averagetime as $data)
				  {
					    $order = $data->{'order_time'};
				      $complete = $data->{'completion_time'};
					  $totaltime = $complete - $order;
					
					$avtimes[] =  date('i:s',$totaltime);
					
				  }
				//echo count($times);
				 if(is_array($avtimes)): 
			 foreach($avtimes as $t) {          
    $unixtime += strtotime($t);      
}  
endif;     
if(count($avtimes)!=0)
{
$unixtime = $unixtime / count($avtimes);  

$average_time =  date("i.s",$unixtime);
}

			  if ($i <= 0)
					{
					  $key = ($i == 0) ? "current" : "prev";
					  $month_orders['month'][$key]['price']       =  $total_price;
					  $month_orders['month'][$key]['month_name']  =  $month_name. ' '.$year;
					 
					  
				    }
				  else
					  
				    $month_orders['prev'][] = array('name' => $mname, 'y' => $total_price, 'drilldown' => $mname);
					
					$month_orders['completed_order'][] = array('name' => $mname, 'y' => (int) $completed->total, 'drilldown' => $mname);
					
					$month_orders['averageordertime'][] = array('name' => $mname, 'y' => (float)$average_time, 'drilldown' => $mname);
			  }
			  
			
			        return $month_orders;
		}
						}
						//print_r($order); die();
					
		}
		/*else
		{
			 $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.location, '.$this->_order.'.status, '.$this->_order.'.completion_time, '.$this->_merchant_estab.'.estabid, '.$this->_order.'.establishment_id');
			  $this->db->from($this->_merchant_estab);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
			  return $this->db->get()->result();
		}*/

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
		$userid = $this->uri->segment('3');
		if($userid!='')
		{
			  $this->db->select($this->_estab_rating.'.userid, '.$this->_estab_rating.'.estabid, '.$this->_merchant_estab.'.estabid as estabhmnt_id, '.$this->_estab_rating.'.rating, '.$this->_estab_rating.'.review, '.$this->_estab_rating.'.reply, '.$this->_estab_rating.'.ttime, '.$this->_accounts.'.id, '.$this->_accounts.'.name, '.$this->_accounts.'.email, '.$this->_estab_rating.'.id as rating_id');
			
			  $this->db->from($this->_merchant_estab);
			  $this->db->where($this->_merchant_estab.'.userid', $userid);
			   $this->db->join($this->_estab_rating, "$this->_merchant_estab.estabid = $this->_estab_rating.estabid");
			  $this->db->join($this->_accounts, "$this->_accounts.id = $this->_estab_rating.userid");
			  $this->db->where($this->_accounts.'.status', 1);
			  
			 return  $this->db->get()->result();
		}
		else
		{
			 $this->db->select($this->_estab_rating.'.userid, '.$this->_estab_rating.'.estabid, '.$this->_estab_rating.'.rating, '.$this->_estab_rating.'.review, '.$this->_estab_rating.'.reply, '.$this->_estab_rating.'.ttime, '.$this->_accounts.'.id, '.$this->_accounts.'.name, '.$this->_accounts.'.email, '.$this->_estab_rating.'.id as rating_id');
			
			  $this->db->from($this->_estab_rating);
			  $this->db->join($this->_accounts, "$this->_accounts.id = $this->_estab_rating.userid");
			  $this->db->where($this->_accounts.'.status', 1);
			  
			 return  $this->db->get()->result();
		}
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
			
				$start_time1         		=  	$this->input->post('start_date1');
				$end_time1          		=  $this->input->post('end_date1');
				$start_time2         		=  	$this->input->post('start_date2');
				$end_time2          		=  $this->input->post('end_date2');
				$start_time3         		=  	$this->input->post('start_date3');
				$end_time3          		=  $this->input->post('end_date3');
			
					
				/*13_8 below*/
					$customr  =  strtotime($end_time1);
					$newcustomr  =  strtotime($end_time2);
					$returningcustomr  =  strtotime($end_time3);
				$first_day_month   =  strtotime('first day this month');
				
			
			//$userid = $this->uri->segment('3');
			
			$estabid        =  $this->uri->segment('3');
			
			$userid         =  $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->estabid;
			
			
			
			$months = array();
			$years  = array();

			
			  if($start_time1!='' && $end_time1!='')
			{
			  	//echo $first; die();
			  
			  for ($i = 5; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
			  {
				  
				  $month_name     =  date('M', strtotime("-$i month", $customr));
				//echo $month_name; die();
				  $month_numeric  =  date('m', strtotime("-$i month", $customr));
				  $year           =  date('Y', strtotime("-$i month", $customr));
				  
				  $yr             =  date('y', strtotime("-$i month", $customr));
				  
				  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
				  
				  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
				  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
				  

				  $mname          =  $month_name." '".$yr; 
				  
				
			 $this->db->select($this->_order.'.customer_id,'.$this->_merchant_estab.'.estabid');
			 
			 $this->db->where('userid', $userid);
		     $this->db->from($this->_merchant_estab);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
			$this->db->group_by($this->_order.'.customer_id');
			 $result 			=   $this->db->get()->result();
			 $data['customer'] 	= 	$result;
			 $data['cust_exit']    	= 	array();
			 $data['new_grph']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select($this->_users.'.name,  '.$this->_users.'.email,'.$this->_users.'.contactno,'.$this->_users.'.id');
								//$data['cust_exits'] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->row();
								 $data['cust_exit'][$resul->customer_id]=  $this->db->get_where($this->_users, array('id' =>$resul->customer_id))->result();
								 
								  $this->db->select('count(order_id) as customer,customer_id');
								$data['new_grph'][$resul->customer_id] = $this->db->get_where($this->_order, array('customer_id' => $resul->customer_id))->result();
							}
					}
			
				   $this->db->select('COUNT(*) as total');
				   //$this->db->group_by($this->_order.'.customer_id');
				   $total_cust =  $this->db->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
								 
				   $completed_order[] = array('name' => $mname, 'y' => (int) $total_cust->total, 'drilldown' => $mname);
			
			
				  
			  }
			}
			 elseif($start_time1=='' && $end_time1=='')
			{
			  	for ($i = 5; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
			  {
				  
				  $month_name     =  date('M', strtotime("-$i month", $first_day_month));
				  //echo $month_name; die();
				  $month_numeric  =  date('m', strtotime("-$i month", $first_day_month));
				  $year           =  date('Y', strtotime("-$i month", $first_day_month));
				  
				  $yr             =  date('y', strtotime("-$i month", $first_day_month));
				  
				  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
				  
				  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
				  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
				  

				  $mname          =  $month_name." '".$yr; 
				  
				
			 $this->db->select($this->_order.'.customer_id,'.$this->_merchant_estab.'.estabid');
			 
			 $this->db->where('userid', $userid);
		     $this->db->from($this->_merchant_estab);
			 $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
			 $this->db->group_by($this->_order.'.customer_id');
			 $result 			    =   $this->db->get()->result();
			 $data['customer'] 	    = 	$result;
			 $data['cust_exit']    	= 	array();
			 $data['new_grph']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select($this->_users.'.name,  '.$this->_users.'.email,'.$this->_users.'.contactno,'.$this->_users.'.id');
								//$data['cust_exits'] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->row();
								 $data['cust_exit'][$resul->customer_id]=  $this->db->get_where($this->_users, array('id' =>$resul->customer_id))->result();
								 
								  $this->db->select('count(order_id) as customer,customer_id');
								$data['new_grph'][$resul->customer_id] = $this->db->get_where($this->_order, array('customer_id' => $resul->customer_id))->result                                ();
							}
						
					
						
					}
			
				
			
			
			
				   $this->db->select('count(*) as total');
					$this->db->group_by($this->_order.'.customer_id');
					//$this->db->having('count(*) > 1');
								 $total_cust =  $this->db->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
								 
					$completed_order[] = array('name' => $mname, 'y' => (int) $total_cust->total, 'drilldown' => $mname);
			
				
			  }
			}
			
			
			/**/
			 if($start_time2!='' && $end_time2!='')
			{
			  	//echo $first; die();
			  
			  for ($i = 5; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
			  {
				  
				  $month_name     =  date('M', strtotime("-$i month", $newcustomr));
				//echo $month_name; die();
				  $month_numeric  =  date('m', strtotime("-$i month", $newcustomr));
				  $year           =  date('Y', strtotime("-$i month", $newcustomr));
				  
				  $yr             =  date('y', strtotime("-$i month", $newcustomr));
				  
				  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
				  
				  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
				  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
				  

				  $mname          =  $month_name." '".$yr; 
				  
				
			 $this->db->select($this->_order.'.customer_id,'.$this->_merchant_estab.'.estabid');
			 
			 $this->db->where('userid', $userid);
		     $this->db->from($this->_merchant_estab);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
			$this->db->group_by($this->_order.'.customer_id');
			 $result 			=   $this->db->get()->result();
			 $data['customer'] 	= 	$result;
			 $data['cust_exit']    	= 	array();
			 $data['new_grph']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select($this->_users.'.name,  '.$this->_users.'.email,'.$this->_users.'.contactno,'.$this->_users.'.id');
								//$data['cust_exits'] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->row();
								 $data['cust_exit'][$resul->customer_id]=  $this->db->get_where($this->_users, array('id' =>$resul->customer_id))->result();
								 
								  $this->db->select('count(order_id) as customer,customer_id');
								$data['new_grph'][$resul->customer_id] = $this->db->get_where($this->_order, array('customer_id' => $resul->customer_id))->result                                ();
							}
						
					
						
					}
			
				
				$this->db->select('count(DISTINCT(customer_id)) as customer');  
				
				$newcust = $this->db->group_by('customer_id')->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
				
				
				  $new_cust[] = array('name' => $mname, 'y' => (int) $newcust->customer, 'drilldown' => $mname); 
				  
			  }
			}
			 elseif($start_time2=='' && $end_time2=='')
			{
			  	for ($i = 5; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
			  {
				  
				  $month_name     =  date('M', strtotime("-$i month", $first_day_month));
				  //echo $month_name; die();
				  $month_numeric  =  date('m', strtotime("-$i month", $first_day_month));
				  $year           =  date('Y', strtotime("-$i month", $first_day_month));
				  
				  $yr             =  date('y', strtotime("-$i month", $first_day_month));
				  
				  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
				  
				  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
				  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
				  

				  $mname          =  $month_name." '".$yr; 
				  
				
			 $this->db->select($this->_order.'.customer_id,'.$this->_merchant_estab.'.estabid');
			 
			 $this->db->where('userid', $userid);
		     $this->db->from($this->_merchant_estab);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
			$this->db->group_by($this->_order.'.customer_id');
			 $result 			=   $this->db->get()->result();
			 $data['customer'] 	= 	$result;
			 $data['cust_exit']    	= 	array();
			 $data['new_grph']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select($this->_users.'.name,  '.$this->_users.'.email,'.$this->_users.'.contactno,'.$this->_users.'.id');
								//$data['cust_exits'] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->row();
								 $data['cust_exit'][$resul->customer_id]=  $this->db->get_where($this->_users, array('id' =>$resul->customer_id))->result();
								 
								  $this->db->select('count(order_id) as customer,customer_id');
								$data['new_grph'][$resul->customer_id] = $this->db->get_where($this->_order, array('customer_id' => $resul->customer_id))->result                                ();
							}
						
					
						
					}
			
				$this->db->select('count(DISTINCT(customer_id)) as customer');  
				
				$newcust = $this->db->group_by('customer_id')->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
				
				
				  $new_cust[] = array('name' => $mname, 'y' => (int) $newcust->customer, 'drilldown' => $mname); 
			
				
			  }
			}
			
			if($start_time3!='' && $end_time3!='')
			{
			  	//echo $first; die();
			  
			  for ($i = 5; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
			  {
				  
				  $month_name     =  date('M', strtotime("-$i month", $returningcustomr));
				//echo $month_name; die();
				  $month_numeric  =  date('m', strtotime("-$i month", $returningcustomr));
				  $year           =  date('Y', strtotime("-$i month", $returningcustomr));
				  
				  $yr             =  date('y', strtotime("-$i month", $returningcustomr));
				  
				  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
				  
				  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
				  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
				  

				  $mname          =  $month_name." '".$yr; 
				  
				
			 $this->db->select($this->_order.'.customer_id,'.$this->_merchant_estab.'.estabid');
			 
			 $this->db->where('userid', $userid);
		     $this->db->from($this->_merchant_estab);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
			$this->db->group_by($this->_order.'.customer_id');
			 $result 			=   $this->db->get()->result();
			 $data['customer'] 	= 	$result;
			 $data['cust_exit']    	= 	array();
			 $data['new_grph']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select($this->_users.'.name,  '.$this->_users.'.email,'.$this->_users.'.contactno,'.$this->_users.'.id');
								//$data['cust_exits'] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->row();
								 $data['cust_exit'][$resul->customer_id]=  $this->db->get_where($this->_users, array('id' =>$resul->customer_id))->result();
								 
								  $this->db->select('count(order_id) as customer,customer_id');
								$data['new_grph'][$resul->customer_id] = $this->db->get_where($this->_order, array('customer_id' => $resul->customer_id))->result                                ();
							}
						
					
						
					}
			
				 
				$this->db->select('customer_id,count('.$this->_order.'.customer_id) as customers');
				
				$query = $this->db->group_by('customer_id')->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
				
				
				 $returning_cust[] = array('name' => $mname, 'y' => (int) $query->customers, 'drilldown' => $mname); 
							
			
			  }
			}
			 elseif($start_time3=='' && $end_time3=='')
			{
			  	for ($i = 5; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
			  {
				  
				  $month_name     =  date('M', strtotime("-$i month", $first_day_month));
				  //echo $month_name; die();
				  $month_numeric  =  date('m', strtotime("-$i month", $first_day_month));
				  $year           =  date('Y', strtotime("-$i month", $first_day_month));
				  
				  $yr             =  date('y', strtotime("-$i month", $first_day_month));
				  
				  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
				  
				  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
				  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
				  

				  $mname          =  $month_name." '".$yr; 
				  
				
			 $this->db->select($this->_order.'.customer_id,'.$this->_merchant_estab.'.estabid');
			 
			 $this->db->where('userid', $userid);
		     $this->db->from($this->_merchant_estab);
			 $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
		  	 $this->db->group_by($this->_order.'.customer_id');
			 $result 			=   $this->db->get()->result();
			 $data['customer'] 	= 	$result;
			 $data['cust_exit']    	= 	array();
			 $data['new_grph']    	= 	array();
			
			 if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select($this->_users.'.name,  '.$this->_users.'.email,'.$this->_users.'.contactno,'.$this->_users.'.id');
								//$data['cust_exits'] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->row();
								 $data['cust_exit'][$resul->customer_id]=  $this->db->get_where($this->_users, array('id' =>$resul->customer_id))->result();
								 
								  $this->db->select('count(order_id) as customer,customer_id');
								$data['new_grph'][$resul->customer_id] = $this->db->get_where($this->_order, array('customer_id' => $resul->customer_id))->result                                ();
							}
					}
			
				$this->db->select('customer_id,count('.$this->_order.'.customer_id) as customers');
				
				$query = $this->db->group_by('customer_id')->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
				
				
				 $returning_cust[] = array('name' => $mname, 'y' => (int) $query->customers, 'drilldown' => $mname); 
				
			  }
			}
			
			else
			{
				for ($i = 5; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
			  {
				  
				  $month_name     =  date('M', strtotime("-$i month", $first_day_month));
				  //echo $month_name; die();
				  $month_numeric  =  date('m', strtotime("-$i month", $first_day_month));
				  $year           =  date('Y', strtotime("-$i month", $first_day_month));
				  
				  $yr             =  date('y', strtotime("-$i month", $first_day_month));
				  
				  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
				  
				  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
				  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
				  

				  $mname          =  $month_name." '".$yr; 
				  
				
					
			 $this->db->select($this->_order.'.customer_id,'.$this->_merchant_estab.'.estabid');
			 
			 $this->db->where('userid', $userid);
		     $this->db->from($this->_merchant_estab);
			  $this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
			$this->db->group_by($this->_order.'.customer_id');
			 $result 			=   $this->db->get()->result();
			 $data['customer'] 	= 	$result;
			 $data['cust_exit']    	= 	array();
			 $data['new_grph']    	= 	array();
				if (count($result) > 0)
					{
						foreach ($result as $resul)
							{
								$this->db->select($this->_users.'.name,  '.$this->_users.'.email,'.$this->_users.'.contactno,'.$this->_users.'.id');
								//$data['cust_exits'] = $this->db->get_where($this->_order, array('customer_id' => $resul->id))->row();
								 $data['cust_exit'][$resul->customer_id]=  $this->db->get_where($this->_users, array('id' =>$resul->customer_id))->result();
								 
								 $this->db->select('count(order_id) as customer,customer_id');
								$data['new_grph'][$resul->customer_id] = $this->db->get_where($this->_order, array('customer_id' => $resul->customer_id))->result                                ();
								 
						}
						
					
						
					}
			
				
			
			
			
				   $this->db->select('COUNT(*) as total');
						// $this->db->group_by($this->_order.'.customer_id');
								 $total_cust =  $this->db->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
								 
							
								 
					$completed_order[] = array('name' => $mname, 'y' => (int) $total_cust->total, 'drilldown' => $mname);
			
				  /**/
				  //echo $resul->estabid; die();
				$this->db->select('customer_id,count(customer_id) as customers');
				
				$query = $this->db->group_by('customer_id')->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
				
				
				  $returning_cust[] = array('name' => $mname, 'y' => (int) $query->customers, 'drilldown' => $mname); 
								//$this->db->group_by($this->_order.'.customer_id');
								//$asdf = $this->db->get_where($this->_order, array('establishment_id' =>3, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();    
				  
				  
				$this->db->select('count(DISTINCT(customer_id)) as customer');  
				
				$newcust = $this->db->group_by('customer_id')->get_where($this->_order, array('establishment_id' =>$resul->estabid, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->row();
				
				
				  $new_cust[] = array('name' => $mname, 'y' => (int) $newcust->customer, 'drilldown' => $mname); 
				  
				
				  /**/ 
				  
				  
			  }
			}
			  
					$data['total_customers']     = json_encode($completed_order);
					$data['new_customers']       = json_encode($new_cust);
					$data['returning_customers'] = json_encode($returning_cust);
					
					//$this->db->num_rows($data['customer']);
					//var_dump($data['customer']); 
					echo count($result); 
			
					return $data;
		}
		/*End Code for New & Returning Customers*/
		
		/*Start Code for Order Hitsory*/
		 public function orderhistory()
		    {
				$estab_id   = $this->uri->segment('3');
				
				$this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location, '.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.establishment_id, '.$this->_users.'.name');

				$this->db->from($this->_order);
				$this->db->join($this->_users, "$this->_users.id = $this->_order.order_id");
				return $this->db->get()->result();
				
				
				
				/*$userid = $this->uri->segment('3');
				
				if ($userid != '')
					{
						$this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.location,'.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.status, '.$this->_order.'.establishment_id, '.$this->_order.'.customer_id, '.$this->_merchant_estab.'.estabid');
						//$this->db->group_by($this->_establishment.'.id');
						//$this->db->where($this->_merchant_estab.'.userid', $userid);
						$this->db->from($this->_merchant_estab);
						$this->db->join($this->_order, "$this->_order.establishment_id = $this->_merchant_estab.estabid");
						//$this->db->join($this->_users, "$this->_users.id = $this->_order.customer_id");
						$this->db->where($this->_merchant_estab.'.userid', $userid);
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
										$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('establishment_id' => $order_data->estabid))->result();
										$this->db->select('name,id');
										$data['cust_name'][$order_data->customer_id] = $this->db->get_where($this->_users, array('id' => $order_data->customer_id))->result();
									}
							}
								
								//print_r($data['cust_name']); die();
							return $data;
					}
				else
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
											$data['estab'][$order_data->estabid] = $this->db->get_where($this->_order, array('establishment_id' => $order_data->estabid))->result();
											
											$this->db->select('name');
											$data['cust_name'][$order_data->customer_id] = $this->db->get_where($this->_users, array('id' => $order_data->customer_id))->result();
											
										}
								}
								
								//print_r($data['cust_name']); die();
								return $data;
					}
					*/
		   }
		   
		   
		public function orderPopUpData()
			{
				$estab_id   = $this->uri->segment('3');
				
				$this->db->select('order_id, customer_id, location, total_amount, order_time, payment_method, status, completion_time, cancel_time, staff_member_id, new_order_flag, pending_order_flag, user_nudge');
				$this->db->order_by('order_time', 'desc');
				
				if ( ! empty($estab_id))
				$query  =  $this->db->get_where($this->_order, array('establishment_id' => $estab_id));
			       else
				$query  =  $this->db->get($this->_order);
				
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
		
		public function CustomerOrderdetails($order_id='')
		{
			  $this->db->select($this->_order_menu_id.'.menu_id, '.$this->_order_menu_id.'.qty, '.$this->_menu_items.'.item_name, '.$this->_order.'.order_id, '.$this->_menu_items.'.price, '.$this->_menu_category.'.menu_id as menuid, '.$this->_menu_items.'.item_type');
			  
			  $this->db->from($this->_order_menu_id);
			 $this->db->join($this->_order, "$this->_order.order_id = $this->_order_menu_id.order_id");
			  $this->db->join($this->_menu_category, "$this->_menu_category.menu_id = $this->_order_menu_id.menu_id");
			   $this->db->join($this->_menu_items, "$this->_menu_items.id = $this->_menu_category.menu_id");
			  $this->db->where($this->_order.'.customer_id', $order_id);
			
			 $order =  $this->db->get()->result();
			 $data['orders'] 	= 	$order;
			
				return $data;

		}
		
		
		public function orderdetailsforanalytics($order_id='')
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
					
				
				return $data;
			
		
		}
		
			/*End Code for Order Hitsory*/
		
		public function filterMenus()
		{
			 $this->db->select($this->_establishment.'.name as estabname,'.$this->_establishment.'.id,'.$this->_merchant_estab.'.userid');
			 $this->db->from($this->_establishment);
			 $this->db->join($this->_merchant_estab, "$this->_merchant_estab.estabid = $this->_establishment.id");
			 $this->db->where($this->_merchant_estab.'.main', 1);
		      $result =  $this->db->get()->result();
			 $data['estab'] 	= 	$result;
			
				return $data;
				
				/**/
	   }
	   /*average Order Completion Time*/
	   public function averageCompletionTime()
		{
			$arr = "";
			$estabid = $this->uri->segment(3);
			
			$uid = $this->db->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->estabid;
			
			if ($uid != '')
		     	{
					//$estabid = getEstablishmentIdByUserId($uid);
					$first_day_month   =  strtotime('first day this month');
					
					$months = array();
					$years  = array();
					$times  = array();

					for ($i = 6; $i >= 0; $i--) // for ($i = 6; $i >= 1; $i--)
					  {
						  
						  $month_name     =  date('M', strtotime("-$i month", $first_day_month));
						  $month_numeric  =  date('m', strtotime("-$i month", $first_day_month));
						  $year           =  date('Y', strtotime("-$i month", $first_day_month));
						  
						  $yr             =  date('y', strtotime("-$i month", $first_day_month));
						  
						  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
						  
						  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
						  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
						 
						  $mname          =  $month_name." '".$yr; 
						
						  $this->db->select('completion_time, order_time');
						  $completed =  $this->db->get_where($this->_order, array('establishment_id' => $estabid, 'status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->result();
					
					       $times           =   array();
						   $average_time    =   "";
						   
						   foreach($completed as $data)
							  {
									$order = $data->{'order_time'};
									$complete = $data->{'completion_time'};
									$totaltime = $complete - $order;
									$times[] =  date('i:s',$totaltime);
							  }
						  
							 /*foreach($times as $t) 
								{          
									$unixtime += strtotime($t);      
								}      
							 if(count($times)!= 0)
							   {
									$unixtime     =  $unixtime / count($times);  
									$average_time =  date("i.s",$unixtime);
							   }*/
							   
							   
							    $total_time =   array_sum($times);
										
								$minutes    =   intval (($total_time/60) % 60);        
								$seconds    =   intval ($total_time % 60);     
								   

								$average_time  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

								$average_time  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);

							    $completed_order[] = array('name' => $mname, 'y' => (float) $average_time, 'drilldown' => $mname);

								if ($i <= 1)
									{
										$key = ($i == 0) ? "current" : "prev";
										$arr['month'][$key]['month_name']  =  $month_name. ' '.$year;
									}
					  }
						
						//echo date('h:i A, M d Y',$start_time);
						// echo date('h:i A, M d Y',$end_time);
						  $arr['completed_orders']     =  json_encode($completed_order);
						  $arr['prev_month']           =  json_encode($arr['month']['prev']['month_name']);
						  $arr['current_month']        =  json_encode($arr['month']['current']['month_name']);
						//print_r($completed_order); die();
				}
						
						  return $arr;
		}
		
		  public function LastTwomonthCompletionTime()
			{
				$arr = "";
				$estabid = $this->uri->segment(3);
				
				$uid = $this->db->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->estabid;
				
				if ($uid != '')
					{
							//$estabid = getEstablishmentIdByUserId($uid);
							
							$first_day_month   =  strtotime('first day this month');
							
							$months 		   =  array();
							$years             =  array();
							$times             =  array();
							$sec               =  array();
							for ($i = 1; $i >= 0; $i--) // for ($i = 1; $i >= 1; $i--)
							  {
								  $month_name     =  date('M', strtotime("-$i month", $first_day_month));
								  $month_numeric  =  date('m', strtotime("-$i month", $first_day_month));
								  $year           =  date('Y', strtotime("-$i month", $first_day_month));
								  
								  $yr             =  date('y', strtotime("-$i month", $first_day_month));
								  
								  $total_days     =  cal_days_in_month(CAL_GREGORIAN, $month_numeric, $year);
								  
								  $start_time     =  mktime (0, 0, 0, $month_numeric, 1, $year);
								  $end_time       =  mktime (23, 59, 59, $month_numeric, $total_days, $year);
								
								  $mname          =  $month_name." '".$yr; 
								
								  $this->db->select('completion_time, order_time');
								  $completed =  $this->db->get_where($this->_order, array('establishment_id' => $estabid, 'status' => 3, 'order_time >=' => $start_time, 'order_time <=' => $end_time))->result();
							
							     
								 foreach($completed as $data)
									  {
											$order      =  $data->{'order_time'};
											$complete   =  $data->{'completion_time'};
											$totaltime  =  $complete - $order;
											$sec[]      =  $totaltime;
									  }
						
								    /* if(is_array($last)):					
									   foreach($last as $tme) 
											{          
												$unixtime += strtotime($tme);      
											}      
										if(count($last)!= 0)
											{
												$unixtime = $unixtime / count($last);  
												$average_time_last =  date("i.s",$unixtime);
											}
									*/
										
								   //endif;		
								  
							  }
										$total_time =   array_sum($sec);
										
										$hours      =   floor ($total_time /3600); 
										$minutes    =   intval (($total_time/60) % 60);        
										$seconds    =   intval ($total_time % 60);     
										
										if ($hours > 0) 
										$time_diff  .=  str_pad($hours, 2, 0, STR_PAD_LEFT). ":";      

										$time_diff  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT).":";

										$time_diff  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT);

										$arr['average_time_last'] =  $time_diff;
										
										
					
							   //echo date('h:i A, M d Y',$start_time);
								// echo date('h:i A, M d Y',$end_time);

								  return $arr;
						}
						
			}
			
		
}
		
		?>