<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Model {

    private $_account;
    private $_merchant_estab;
    private $_establishment;
    private $_instamojo;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_account         =   $this->db->dbprefix('account');
			 $this->_merchant_estab  =   $this->db->dbprefix('merchant_estab');
			 $this->_establishment   =   $this->db->dbprefix('establishment');
			 $this->_instamojo       =   $this->db->dbprefix('instamojo');

		}
		
	public function authenticateUser()
		{
			 $email        =   $this->input->post('email');
			 $password     =   $this->input->post('password');
			 
			 $encpassword  =   sha1($password);
			 $query        =   $this->db->get_where($this->_account, array('email' => $email, 'password' => $encpassword, 'status' => 1));
			 if ($query->num_rows() > 0)
				 {
					  $result   =   $query->row();
					  
					  /* Get Establishment Name */
					  $ename = '';
					  $estab_qry = $this->db->select('estabid')->get_where($this->_merchant_estab, array('userid' => $result->{'id'}));
					  if ($estab_qry->num_rows() > 0)
						  {
							  $equery = $this->db->select('name, estab_id')->get_where($this->_establishment, array('id' => $estab_qry->row()->estabid))->row();
							  $ename  = $equery->name;
							  $ecode  = $equery->estab_id;
						  }
			
					  /* Instamojo Configuration */
					  
					    $check_email_exist_insta_qry = $this->db->get_where($this->_instamojo, array('email' => $email));
						if ($check_email_exist_insta_qry->num_rows() == 0)
							{
									$curl_array = array();
									require_once (APPPATH . 'class' . DIRECTORY_SEPARATOR . 'Curl.php');
									$response = Curl::callMethod('oauth2/token/', '', '', 'token');
									
									
									if (is_object($response))
										{
											$token_type      =    $response->token_type;
											$access_token    =    $response->access_token;
											
											$authorization   =    ['Authorization: '.$token_type.' '.$access_token];

											/* Sign Up */
											
											$password =  substr($email, 0, strrpos($email, '@'));
											
											$array    =  array('email' => $email, 'password' => $password, 'phone' => $result->contactno);
											
											$response =  Curl::callMethod('v2/users/', $array, $authorization, 'signup');
											
											if (is_object($response))
												{
													if (isset($response->id))
														{
															 $userid        =  $response->id;
															 $username      =  $response->username;
															 $phone         =  $response->phone;
															 $resource_uri  =  $response->resource_uri;
															 $serialize     =  serialize($response);

															 $this->db->insert($this->_instamojo, array('userid' => $userid, 'username' => $username, 'email' => $email, 'password' => $password, 'phone' => $phone, 'resource_uri' => $resource_uri, 'serialize' => $serialize, 'ttime' => time()));
														}
												}
										}
								  
								  /* Close */
							}

					  $session_array  =   array('id' => (int) $result->{'id'}, 'email' => $result->{'email'}, 'name' => $result->{'name'}, 'ename' => $ename, 'ecode' => $ecode);
					  $this->session->set_userdata($session_array);
					  

					  redirect('order/view');
				 }
			  else 
				  {
					  $this->session->set_flashdata('authfailed', 'authfailed');
					  redirect('auth/index');
				  }
		}
		
}
