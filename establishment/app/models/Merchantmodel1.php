<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchantmodel extends CI_Model {

    private $_merchant_info;
    private $_instamojo;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_merchant_info   =   $this->db->dbprefix('merchant_info');
			 $this->_instamojo       =   $this->db->dbprefix('instamojo');
		}
		
	public function getMerchantInfo($id = '')
		{
			return $this->db->get_where($this->_merchant_info, array('id' => $id))->row();
		}
		
	public function addUpdateMerchantInfo($id = '')
		{
			$contact_person        	      =  	$this->input->post('contact_person');
			
			$data['contact_person']    	  =  	$contact_person;
			
			$data['contact_no']    		  =  	$this->input->post('contact_no');
			$data['email']   	          =  	$this->input->post('emailid');
			
			
			$beneficiary_name     	      =  	$this->input->post('beneficiary_name');
			
			$data['beneficiary_name']  	  =  	$beneficiary_name;

			
			$bank_name          	      =  	$this->input->post('bank_name');
			
			$data['bank_name']  	      =  	$bank_name;
			
			$bank_ac_no         	      =  	$this->input->post('bank_ac_no');
			
			$data['bank_ac_no']  	      =  	$bank_ac_no;
			
			$ifsc_swift_code         	  =  	$this->input->post('ifsc_swift_code');
			
			$data['ifsc_swift_code']  	  =  	$ifsc_swift_code;
			
			
			$data['account_type']  	      =  	$this->input->post('acc_type');
			
			//list($cmonth, $cdate, $cyear) =     explode ('/', $this->input->post('com_col_strt_dt'));
			
			$data['com_col_start_dt']     =  	123;//mktime(0, 0, 0, $cmonth, $cdate, $cyear);
			
			$data['com_slab']  	          =  	$this->input->post('com_slab');
			$data['merchant_tan']  	      =  	$this->input->post('merchant_details');
			$data['tds_deducted']  	      =  	$this->input->post('tds_deducted');
			$data['payment_method']  	  =  	$this->input->post('payment_method');
			$data['rtime']  	          =  	time();
	
	        $num_rows                     =    (int) $this->db->get_where($this->_merchant_info, array('userid' => $id))->num_rows();
			
			if ($num_rows > 0)
				{
					$this->db->where('userid', $id);
					$this->db->update($this->_merchant_info, $data);
					$this->session->set_flashdata('minfoupd', 'minfoupd');
				}
			else
			    {
					$data['userid']  	  =  	$id;
			        $this->db->insert($this->_merchant_info, $data);
					$this->session->set_flashdata('minfoadd', 'minfoadd');
			    }
				
				    /* Update bank details on instamojo */
					
					$email = $this->session->userdata('email');
					$query = $this->db->get_where($this->_instamojo, array('email' => $email));
					
					if ($query->num_rows() > 0)
						{
							$user_obj   = 	$query->row();
							$email      = 	$user_obj->email;
							$pwd        = 	$user_obj->password;
									
							$user_auth  =   array('username' => $email, 'password' => $pwd);						
							
							$curl_array = array();
							require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Curl.php');
							
							$response   = Curl::callMethod('oauth2/token/', $user_auth, '', 'auth');
							
							if (is_object($response))
								{
									$token_type      =    $response->token_type;
									$access_token    =    $response->access_token;
									
									$authorization   =    ['Authorization: '.$token_type.' '.$access_token];

									/* Update Info */
								
									$userid          =    $user_obj->userid;
									$array           =    array('account_holder_name' => $beneficiary_name, 'account_number' => $bank_ac_no, 'ifsc_code' => $ifsc_swift_code);
									$response        =    Curl::callMethod("v2/users/$userid/inrbankaccount/", $array, $authorization, 'update_bank_details', 'PUT');
									
									if (is_object($response))
									$this->db->where('email', $email)->update($this->_instamojo, array('account_info' => serialize($response)));
								
							    }
						}
						
					/* close */
			        redirect('merchant/index');
		}
		
}
