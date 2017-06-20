<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabmodel extends CI_Model {

    private $_establishment;
    private $_merchant_estab;
    private $_estabinfo;
	
    private $_restaurants_location;
    private $_restaurants_floor;

    private $_cinema_audi;
    private $_cinema_rows;
    private $_cinema_seats;
    private $_estab_outlet_timing;
	
	private $_folder_root;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_establishment    			 =   $this->db->dbprefix('establishment');
			 $this->_merchant_estab   			 =   $this->db->dbprefix('merchant_estab');
			 $this->_estabinfo        			 =   $this->db->dbprefix('estabinfo');
			 
			 $this->_restaurants_location        =   $this->db->dbprefix('restaurants_location');
			 $this->_restaurants_floor           =   $this->db->dbprefix('restaurants_floor');
			
			 $this->_cinema_audi                 =   $this->db->dbprefix('cinema_audi');
			 $this->_cinema_rows                 =   $this->db->dbprefix('cinema_rows');
			 $this->_cinema_seats                =   $this->db->dbprefix('cinema_seats');
			 $this->_estab_outlet_timing         =   $this->db->dbprefix('estab_outlet_timing');
			 
			 $this->_folder_root      			 =   $_SERVER['DOCUMENT_ROOT'].'/uploads/';
		}
		
	public function estabLocationData($userid = '')
		{
			    $estabid        =  getEstablishmentIdByUserId($userid);  
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
								$data['restaurants'] = $rest_query->result();
							}
					}
				return $data;
		}
		
	public function getRowsSeatByAudiId($audi_id = '')
		{  
		    $res = array();
			$rows_query = $this->db->get_where($this->_cinema_rows, array('cinema_audi_id' => $audi_id));
			if ($rows_query->num_rows() > 0)
				{
				    foreach ($rows_query->result() as $row_data)
						{
							$rows             = array();
							$rows['row_name'] = $row_data->row_no;
							$seats_query      = $this->db->select('id, seats_no, status')->get_where($this->_cinema_seats, array('cinema_rows_id' => $row_data->id));
							if ($seats_query->num_rows() > 0)
								{
									$rows['seats'] = $seats_query->result();
									$res[] = $rows;
							    }			
						}						
				}
				
			return $res;
			
		}
		
		
	public function getSeatByRestId($rest_id = '')
		{
			return $this->db->get_where($this->_restaurants_location, array('restaurant_floor_id' => $rest_id))->result();
		}
		
		
	public function viewLocationModule()
		{
			$estabid   		=  $this->input->post('estabid');
			
			$data           =  array();
			$data['cinema'] =  '';
			$data['rest']   =  '';
			
			$cinema_query   =  $this->db->get_where($this->_cinema_audi, array('id' => $estabid));
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
	
	
	
	public function estabData($id = '')
		{
			  $this->db->where($this->_establishment.'.id', $id);
			  $this->db->from($this->_establishment);
			  $this->db->join($this->_estabinfo, "$this->_estabinfo.estabid = $this->_establishment.id", "left");
			  $this->db->join($this->_estab_outlet_timing, "$this->_estab_outlet_timing.estabid = $this->_establishment.id", "left");
			  return $this->db->get()->row();
		}
		
	public function updateLocationModule($userid = '')	
		{
			$estabid =  getEstablishmentIdByUserId($userid); 
			
			//print_r($_POST);
			
			$type    =  1; // $this->input->post('type');
		    if ($type == 1)
				{
				   //$this->db->where('cinema_id', $estabid)->delete($this->_cinema_audi);
				   
				   $audi = $this->input->post('audi');
				   if (is_array($audi) && count($audi) > 0)
					    {
						  foreach ($audi as $key => $value)
							  {
								  $audi_name =  $value['name'];
								  
								  $this->db->insert($this->_cinema_audi, array('cinema_id' => '', 'audi_id' => 'audi_id'));
								  $cinema_audi_id = $this->db->insert_id();
								  
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
		}
		
		
	public function addLocationModule($userid = '')
		{
			$estabid =  getEstablishmentIdByUserId($userid); 
			$type    =  0; //$this->input->post('type');
		    if ($type == 1)
				{
				   //$this->db->where('cinema_id', $estabid)->delete($this->_cinema_audi);
				   $audi = $this->input->post('audi');
				   if (is_array($audi) && count($audi) > 0)
					    {
						  foreach ($audi as $key => $value)
							  {
								  $audi_name =  $value['name'];
								  
								  $this->db->insert($this->_cinema_audi, array('cinema_id' => '', 'audi_id' => 'audi_id'));
								  $cinema_audi_id = $this->db->insert_id();
								  
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
		}
		
	public function estabFlag($userid = '')
		{ 
			return (int) $this->db->get_where($this->_merchant_estab, array('userid' => $userid))->num_rows();
		}
		
	public function establishment($userid = '', $estabid = '')
		{
			$config['upload_path']    =   $this->_folder_root; 
			$config['allowed_types']  =   'gif|jpg|png|bmp|jpeg'; 
			$config['encrypt_name']   =   true;
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('logo')) 
			   {
                  $ldata = $this->upload->data();  
                  $data['logo'] = $ldata['file_name'];
               }
			   
			if ($this->upload->do_upload('cover_image')) 
			   {
                  $cdata = $this->upload->data();  
                  $data['cover_image'] = $cdata['file_name'];
               }
			
			$ename                              =   $this->input->post('name');
			$data['name']  						=  	$ename;
			$data['address']  					=  	$this->input->post('address');
			$data['phoneno']  			        =  	$this->input->post('contact_number');
			$data['city']   					=   $this->input->post('locality');
			
			$latlng                             =   $this->input->post('latlng');
			
			$latlng                             =   substr($latlng, 1, -1);
			
			if ($latlng != '')
				{
					list($lat, $lng)            =   explode (',', $latlng);
					$data['lat']  				=  	number_format((float) $lat, 8, '.', ''); //ltrim(trim($lat), '(');
					$data['lng']  				=  	number_format((float) $lng, 8, '.', ''); //ltrim(trim($lng), ')');
				}

			$data['rtime']  				    =  	time();

			$edata                              =   array();
			
			
			
			$edata['primary_contact_name']  	=  	$this->input->post('primary_contact_name');
			$edata['owner']  					=  	$this->input->post('owner');
			$edata['primary_phone_no'] 			=  	$this->input->post('primary_phone_no');
			$edata['primary_email'] 			=  	$this->input->post('primary_email');
			$edata['outlet_timings']  			=  	$this->input->post('outlet_timings');
			$edata['secondary_contact_name'] 	=  	$this->input->post('secondary_contact_name');
			$edata['designation'] 				=  	$this->input->post('designation');
			$edata['secondary_phone_no']  		=  	$this->input->post('secondary_phone_no');
			$edata['secondary_email']  			=  	$this->input->post('secondary_email');
			$edata['fb_link']  					=  	$this->input->post('fb_link');
			$edata['twitter_link']  			=  	$this->input->post('twitter_link');
			$edata['linkedin_link'] 			=  	$this->input->post('linkedin_link');
			$edata['youtube_link'] 				=  	$this->input->post('youtube_link');
			$edata['instagram_link']  			=  	$this->input->post('instagram_link');
			$edata['web_link']  				=  	$this->input->post('web_link');
			$edata['other_details']  			=  	$this->input->post('other_details');
			
			foreach (array(1 => 'mon', 2 => 'tue', 3 => 'wed', 4 => 'thu', 5 => 'fri', 6 => 'sat', 7 => 'sun') as $key => $val)
			   {
				   $establishment_status   =    $this->input->post('open_'.$key);
				   if ($establishment_status == 1)
					   {
							$odata[$val]    	  =    '';
					   }
				   else
					  {
							$ohr                  =    $this->input->post('ohr_'.$key);
							$omin                 =    $this->input->post('omin_'.$key);
							
							$chr                  =    $this->input->post('chr_'.$key);
							$cmin                 =    $this->input->post('cmin_'.$key);
			
							$rdata                =    array();
							$rdata['otime']       =    $ohr . ':' . str_pad($omin, 2, "0", STR_PAD_LEFT);
							$rdata['ctime']       =    $chr . ':' . str_pad($cmin, 2, "0", STR_PAD_LEFT);
							
							$odata[$val]          =    json_encode($rdata);
					  }
			   }   

			/* Close */			
		
			if (empty($estabid))
				{
					/* Establishment Id */
					
					$filter_ename  =  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '', $ename));
					
					$ename_substr  =  substr($filter_ename, 0, 6);
					
					$this->db->select('estab_id');
					$this->db->like('estab_id', $ename_substr, 'after');
					$this->db->order_by('id', 'desc');
					$qry     =   $this->db->get($this->_establishment);
					
					if ($qry->num_rows() > 0)
						{
							$last_estab_id    =  $qry->row()->estab_id;
							
							$last_value       =  ltrim(substr($last_estab_id, 6), 0);
							$last_value       =  $last_value + 1;
							
							$estab_id_gen     =  $ename_substr.str_pad($last_value, 5, "0", STR_PAD_LEFT);
							$data['estab_id'] =  $estab_id_gen;
							
							$this->session->set_userdata('ecode', $estab_id_gen);
							
						}
					else
						{
							$estab_id_gen     =  $ename_substr.'00001';
							$data['estab_id'] =  $estab_id_gen;
							$this->session->set_userdata('ecode', $estab_id_gen);
						}
						
					/* Close */

					$this->db->insert($this->_establishment, $data);
					$id = $this->db->insert_id();
					
					$mdata['userid']   =   $userid;
					$mdata['estabid']  =   $id;
					$mdata['main']     =   1;
					$this->db->insert($this->_merchant_estab, $mdata);
					
					$edata['estabid']  =  	$id;
					$this->db->insert($this->_estabinfo, $edata);
					
					$odata['estabid']  =    $id;
					$this->db->insert($this->_estab_outlet_timing, $odata);
			
				}
			else
				{
					$this->db->where('id', $estabid)->update($this->_establishment, $data);
					
					$this->db->where('estabid', $estabid)->update($this->_estabinfo, $edata);
					
					$this->db->where('estabid', $estabid)->update($this->_estab_outlet_timing, $odata);
				}
			
					$this->session->set_userdata('ename', $ename);
					
			
					redirect('establishment/view');
		}
		
	public function branch($userid = '')
		{
			$data['name']  						=  	$this->input->post('name');
			$data['address']  					=  	$this->input->post('address');
			$data['phoneno']  			        =  	$this->input->post('contact_number');
			$data['opening_hours']  			=  	$this->input->post('opening_hours');
			$data['lat']  					    =  	$this->input->post('latlng');
			$data['lat']  					    =  	$this->input->post('latlng');
			$data['rtime']  				    =  	time();
			
			$this->db->insert($this->_establishment, $data);
			$id = $this->db->insert_id();
			
			$mdata['userid']   =   $userid;
			$mdata['estabid']  =   $id;
			$mdata['main']     =   0;
			$this->db->insert($this->_merchant_estab, $mdata);
			
			$data                               =   array();
			
			$data['estabid'] 	                =  	$id;
			$data['secondary_contact_name'] 	=  	$this->input->post('secondary_contact_name');
			$data['designation'] 				=  	$this->input->post('designation');
			$data['secondary_phone_no']  		=  	$this->input->post('secondary_phone_no');
			$data['secondary_email']  			=  	$this->input->post('secondary_email');

			$this->db->insert($this->_estabinfo, $data);
			
			redirect('establishment/view');
		}
		
	public function allEstab($userid = '')
		{
			  $this->db->select($this->_establishment.'.id, '.$this->_establishment.'.name, '.$this->_establishment.'.address, '.$this->_establishment.'.phoneno, '.$this->_estabinfo.'.secondary_contact_name, '.$this->_estabinfo.'.primary_email, '.$this->_estabinfo.'.primary_contact_name');
			  $this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_establishment);
			  $this->db->join($this->_merchant_estab, "$this->_merchant_estab.estabid = $this->_establishment.id");
			  $this->db->join($this->_estabinfo, "$this->_estabinfo.estabid = $this->_establishment.id");
			  return $this->db->get()->result();
		}
		
}
