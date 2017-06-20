<?php
if (! function_exists('getBranches'))
	{	
	  function getBranches($userid = '') {
		  
              $CI = &get_instance();
			  
			  $establishment   =    $CI->db->dbprefix('establishment');
			  $merchant_estab  =	$CI->db->dbprefix('merchant_estab');
			  
			  $CI->db->select($establishment.'.id, '.$establishment.'.name');
			  $CI->db->where($merchant_estab.'.userid', $userid);
			  $CI->db->from($establishment);
			  $CI->db->join($merchant_estab, "$merchant_estab.estabid = $establishment.id");
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
	
	
	
if (! function_exists('tep_get_category_tree'))
	{	
		function tep_get_category_tree($parent_id = '0', $spacing = '', $exclude = '', $category_tree_array = '', $include_itself = false) 
			  {
				    $CI = &get_instance();
					if (!is_array($category_tree_array)) $category_tree_array = array();
					//if ( (sizeof($category_tree_array) < 1) && ($exclude != '0') ) $category_tree_array[] = array('id' => '', 'text' => '--- Select Parent Category ---');

					if ($include_itself) 
					  {
						    $CI->db->where('parent_id', $parent_id);
							$category_query = $CI->db->get($CI->db->dbprefix('category'))->row(); // DB::table('category')->where('c_id', $parent_id)->first();					
							$category_tree_array[] = array('id' => $parent_id, 'text' => $category->category_name);
					  }
							//DB::setFetchMode(PDO::FETCH_ASSOC);
							//$categories_query = DB::table('category')->where('parent_id', $parent_id)->orderBy('category_name', 'asc')->get();
							
							$CI->db->where('parent_id', $parent_id);
							$CI->db->order_by('category_name', 'asc');
							$categories_query = $CI->db->get($CI->db->dbprefix('category'))->result_array(); //DB::table('category')->where('parent_id', $parent_id)->orderBy('category_name', 'asc')->get();
							
							//DB::setFetchMode(PDO::FETCH_CLASS);
							foreach ($categories_query as $categories)
							  {
								 if ($exclude != $categories['id']) $category_tree_array[] = array('id' => $categories['id'], 'text' => $spacing .  ucwords($categories['category_name']));
								 $category_tree_array = tep_get_category_tree($categories['id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude,  $category_tree_array);
							  }

								 return $category_tree_array;
			  }
	}
	  
if (! function_exists('tep_draw_pull_down_menu'))
	{	 
		function tep_draw_pull_down_menu($name = '', $values = '', $id = '') 
			{
				$field  = '<select  id="showtopic" class="form-control" name="' . $name . '"';
				$field .= '>';
				for ($i = 0, $n = sizeof($values); $i < $n; $i++) 
				   {
						$selected = ($id ==  $values[$i]['id']) ? 'selected' : '';
						$field   .= '<option value="' . $values[$i]['id'].'" '.$selected.'';
						$field   .= '>' . ucwords($values[$i]['text']) . '</option>';
					}
						$field .= '</select>';
						return $field;
			}
	}
	
if (! function_exists('generateRandomString'))
	{
		function generateRandomString($length = 10, $string = 1) {
			
			        if ($string == 1)
					$characters  = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
						else
					$characters  = '123456789';
				
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return $randomString;
			}
	}