<?php
if (! function_exists('getOrderLocation'))
	{	
	  function getOrderLocation($location_id = '') {
		  
		      if (empty($location_id) OR $location_id == "(null),(null)")
			  return "Not Applicable";
		  
              $CI = &get_instance();
			  
			  $explode_arr  =   explode(',', $location_id);
			  
			  if (count($explode_arr) == 1)
					{
						/*$audi_id  = $explode_arr[0];
						$rows_id  = $explode_arr[1];
						$seats_id = $explode_arr[2];
						
						$audi_name = $CI->db->select('audi_id')->get_where($CI->db->dbprefix('cinema_audi'), array('id' => $audi_id))->row()->audi_id;
						$rows_name = $CI->db->select('row_no')->get_where($CI->db->dbprefix('cinema_rows'), array('id' => $rows_id))->row()->row_no;
						$seat_no   = $CI->db->select('seats_no')->get_where($CI->db->dbprefix('cinema_seats'), array('id' => $seats_id))->row()->seats_no;
						$location_data = $audi_name. ' &raquo; '. $rows_name.' &raquo; '.$seat_no;
						*/
						
						$data = $CI->db->select('seats_no, cinema_rows_id')->get_where($CI->db->dbprefix('cinema_seats'), array('id' => $location_id))->row();
						
						$seat_no          =  $data->seats_no;
						
						$cinema_rows_id   =  $data->cinema_rows_id;
					
						
						$info             =  $CI->db->select('row_no, cinema_audi_id')->get_where($CI->db->dbprefix('cinema_rows'), array('id' => $cinema_rows_id))->row();
						
						$row_no           =  $info->row_no;
						
						$cinema_audi_id   =  $info->cinema_audi_id;
						
						$audi_name        =  $CI->db->select('audi_id')->get_where($CI->db->dbprefix('cinema_audi'), array('id' => $cinema_audi_id))->row()->audi_id;
						
						$location_data    =  'Audi #'.$audi_name. ' &raquo; Row #'. $row_no. ' &raquo; Seat #'.$seat_no;
						
					}
			   elseif(count($explode_arr) == 2)
					{
						$floor_id = $explode_arr[0];
						$table_id = $explode_arr[1];
						
						$floor_name = $CI->db->select('floor_id')->get_where($CI->db->dbprefix('restaurants_floor'), array('id' => $floor_id))->row()->floor_id;
						$table_no = $CI->db->select('location_name')->get_where($CI->db->dbprefix('restaurants_location'), array('id' => $table_id))->row()->location_name;
						$location_data = $floor_name. ' &raquo;  '. $table_no;
					}
				else
					    $location_data = $location_id;
					
                        return $location_data;					
		}
	}
	
if (! function_exists('getEstablishmentIdByUserId'))
	{	
	  function getEstablishmentIdByUserId($userid = '') {
		  
              $CI = &get_instance();
			  $merchant_estab  =	$CI->db->dbprefix('merchant_estab');
			  
			  $CI->db->select('estabid');
			  return (int) $CI->db->get_where($merchant_estab, array('userid' => $userid))->row()->estabid;
		}
	}
	
	
if (! function_exists('getBranches'))
	{	
	  function getBranches($userid = '') {
		  
              $CI = &get_instance();
			  
			  $establishment   =    $CI->db->dbprefix('establishment');
			  $merchant_estab  =	$CI->db->dbprefix('merchant_estab');
			  
			  $CI->db->select($establishment.'.id, '.$establishment.'.name');
			  //$CI->db->where($merchant_estab.'.userid', $userid);
			  $CI->db->from($establishment);
			  $CI->db->join($merchant_estab, "$merchant_estab.estabid = $establishment.id");
			
			  return $CI->db->get()->result();
		}
	}
	
	
	if (! function_exists('checkCustomization'))
		{	
		  function checkCustomization($menu_id = '') {
			  
				  $CI = &get_instance();
				  $menu_customization_type  =	$CI->db->dbprefix('menu_customization_type');
				  return  ($CI->db->get_where($menu_customization_type, array('menu_id' => $menu_id))->num_rows() > 0) ? "Customization Available"  : "" ;
			}
		}

   if (! function_exists('getAllEstablishment'))
	{	
	  function getAllEstablishment() {		  
              $CI = &get_instance();
			  return $CI->db->select('id, name')->get($CI->db->dbprefix('establishment'))->result();
	  }
		
	}
	
	
	if (! function_exists('getAllBranches'))
	{
	 function getAllBranches() {
		  
              $CI = &get_instance();
			  
			  $establishment   =    $CI->db->dbprefix('establishment');
			 /* $merchant_estab  =	$CI->db->dbprefix('merchant_estab');
			  
			  $CI->db->select($establishment.'.id, '.$establishment.'.name');
			  $CI->db->from($establishment);
			  $CI->db->join($merchant_estab, "$merchant_estab.estabid = $establishment.id");
			  $CI->db->where($merchant_estab.'.main', '1');
			  */
			  
			  return $CI->db->select('id, name')->get($establishment)->result();
		}
	}
	
	
	if (! function_exists('getAllEstablishments'))
		{
			 function getAllEstablishments() {
				  
					  $CI = &get_instance();
					  $establishment   =    $CI->db->dbprefix('establishment');
					  return $CI->db->select('id, name')->get($establishment)->result();
				}
		}
	
	
	
	if (! function_exists('getAllAddress'))
	{
	 function getAllAddress() {
		  
              $CI = &get_instance();
			  
			  $establishment   =    $CI->db->dbprefix('establishment');
			  $merchant_estab  =	$CI->db->dbprefix('merchant_estab');
			   $user_locality   =    $CI->db->dbprefix('user_locality');
			  $locality  =	$CI->db->dbprefix('locality');
			  
			  $CI->db->select($establishment.'.id, '.$establishment.'.name, '.$establishment.'.address, '.$merchant_estab.'.userid, '.$locality.'.locality, '.$user_locality.'.locality_id');
			 // $CI->db->where($merchant_estab.'.userid', $userid);
			  $CI->db->from($establishment);
			  $CI->db->join($merchant_estab, "$merchant_estab.estabid = $establishment.id");
			  $CI->db->join($user_locality, "$user_locality.userid = $merchant_estab.userid");
			   $CI->db->join($locality, "$locality.id = $user_locality.locality_id");
			  $CI->db->where($merchant_estab.'.main', '1');
			 // return $CI->db->get_where($merchant_estab, array('main' => '0'))->result();
			  return $CI->db->get()->result();
		}
	}
	
if (! function_exists('getEstabFlag'))
	{	
	  function getEstabFlag($userid = '') {
		  
              $CI = &get_instance();
			  $merchant_estab  =	$CI->db->dbprefix('merchant_estab');
			  return (int) $CI->db->get_where($merchant_estab, array('userid' => $userid))->num_rows();
		}
	}
	
	/*For navigation sidebar--- add new admin*/
	if (! function_exists('getNewAdminFlag'))
	{	
	  function getNewAdminFlag($adminid) {
		  
              $CI = &get_instance();
			  $newadmin  =	$CI->db->dbprefix('newadmin');
			//  return (int) $CI->db->get_where($newadmin, array('userid' => $adminid))->num_rows();
			
			 $CI->db->select($newadmin.'.id, '.$newadmin.'.name, '.$newadmin.'.permission');
			 // $CI->db->where($merchant_estab.'.userid', $userid);
			  $CI->db->from($newadmin);
			  $CI->db->where($newadmin.'.id', $adminid);
			 // return $CI->db->get_where($merchant_estab, array('main' => '0'))->result();
			  return $CI->db->get()->row();
			
		}
	}
	
	/*For get Establishment Location*/
	if (! function_exists('getEstabLocation'))
	{	
	  function getEstabLocation() {
		  
             $CI = &get_instance();
			 $establishment  =	$CI->db->dbprefix('establishment');
			 $CI->db->select($establishment.'.id, '.$establishment.'.name, '.$establishment.'.city');
			  $CI->db->group_by('city');
			 $CI->db->from($establishment);
			
			
		     return $CI->db->get()->result();
			
		}
	}
	
	
	if (! function_exists('getUserLocality'))
	{
	 function getUserLocality($userid = '') {
		  
              $CI = &get_instance();
			  
			  $user_locality   =    $CI->db->dbprefix('user_locality');
			  $locality        =	$CI->db->dbprefix('locality');
			   
			  $CI->db->order_by('id', 'desc');
			  $locality_qry    =    $CI->db->select('locality_id')->get_where($user_locality, array('userid' => $userid));


			  if ($locality_qry->num_rows() > 0)
				  {
					  $locality_id = $locality_qry->row()->locality_id;
					  
					  return $CI->db->select('locality')->get_where($locality, array('id' => $locality_id))->row()->locality;
				  }
				      return '-------------------------';
		}
	}
	
	
	