<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authmodel extends CI_Model {

    private $_staff_member;
    private $_accounts;
	private $_sms_codes;
	
    public function __construct()
		{
              parent::__construct();
			 
			  $this->_staff_member     =      $this->db->dbprefix('staff_member');
			  $this->_accounts         =      $this->db->dbprefix('accounts');
			  $this->_sms_codes        =      $this->db->dbprefix('sms_codes'); 
		}
		
	public function signInModule()
		{
			$email_contact_no  =  $this->input->post('email_contact_no');
			$pwd               =  sha1($this->input->post('password'));
			$sql       		   =  "SELECT * FROM `".$this->_accounts."` WHERE (`email` = ? OR `contactno` = ?) AND `pwd` = ? AND `status` = ?";
			$query       	   =   $this->db->query($sql, array($email_contact_no, $email_contact_no, $pwd, 1));
			if ($query->num_rows() > 0)
				  return (int) $query->row()->{'id'};
			else
				  return 0;
		}
		
	public function createAccountModule()
		{				
			if (count($this->input->post()) == 3)
				 {
					 $data['name']       =   strtolower($this->input->post('name'));
					 $data['email']      =   strtolower($this->input->post('email'));
					 $data['pwd']        =   sha1($this->input->post('password'));
					 $data['regtime']    =   time();
					 $this->db->insert($this->_accounts, $data);
					 $insert_id          =   $this->db->insert_id();
					 return $insert_id;
				 }
			else 
				     return 0;
		}
		
	public function sendMobileNumberModule()
		{	
			if (count($this->input->post()) == 2)
				 {
					 $id                 =   $this->input->post('id');
					 $contactno          =   $this->input->post('contactno');
					 $data['contactno']  =   $contactno;
					 $this->db->where('id', $id);
					 $this->db->update($this->_accounts, $data);
					 return $this->saveSmsInfo($id, $contactno);
				 }		
		}
		
	public function saveSmsInfo($uid = '', $mobile = '')
		{
			$this->db->where('user_id', $uid);
			$this->db->delete($this->_sms_codes);
			
			$otp                 =   rand(100000, 999999);
			$data['user_id']     =   $uid;
			$data['code']        =   $otp;			
			$this->db->insert($this->_sms_codes, $data);
			return 1;
			//return $this->sendSmsDataToUser($otp, $mobile, 0);
		}
		
	public function sendSmsDataToUser($otp = '', $contactno = '', $message = '')
		{
		    //Your message to send, Add URL encoding here.

			if ($message == 1)
			$message        =  urlencode("Hello! Your New Fewtaps Password is : ".$otp);
                else
			$message        =  urlencode("Hello! Welcome to Fewtaps. Your OPT is : ".$otp);
		
			$response_type  =  'json';
			$route          =  "4";  //Define route 
			//Prepare you post parameters
			$postData = array('authkey' => MSG91_AUTH_KEY, 'mobiles' => $contactno, 'message' => $message, 'sender' => MSG91_SENDER_ID, 'route' => $route, 'response' => $response_type);

			$url = "https://control.msg91.com/sendhttp.php";

		    // init the resource
			$ch = curl_init();
			curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $postData));
			//Ignore SSL certificate verification
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			//get response
			$output = curl_exec($ch);

			//Send admin error if any
			if (curl_errno($ch)) {
				$this->load->library('email');
				$this->email->from(config_item('from_email'), config_item('from_name'));
				$this->email->to(config_item('admin_email_error'));
				$this->email->subject('Curl Error OTP');
				$this->email->message(curl_error($ch));
				$this->email->send();
			}

			curl_close($ch);
			return $output;
		}
		
	public function verifyOtpModule()
		{
			$otp = $this->input->get_post('otp');
			$this->db->where('code', $otp);
			$query = $this->db->get($this->_sms_codes);
			
			if ($query->num_rows() > 0)
				{
					$result = $query->row();
					$userid = $result->{'user_id'};
					
					$this->db->where('code', $otp);
					$this->db->update($this->_sms_codes, array('status' => 1));
					
					$this->db->where('id', $userid);
					$this->db->update($this->_accounts, array('status' => 1));
					
					return TRUE;
				}
			else
				    return FALSE;
		}
		
	public function userUpdatePasswordModule($id = '', $new_pwd = '')
		{
				$data['password']   =  $new_pwd;
				$this->db->where('id', $id);
				$this->db->update($this->_accounts, $data);
				return 1;
		}
		
	public function updatePasswordHereModule()
		{
			if ( (int) count($this->input->post()) == 2)
			  {
				    $userid             =  (int) $this->input->post('id');
					$data['password']   =  sha1($this->input->post('pwd'));
					$this->db->where('id', $userid);
					$this->db->update($this->_accounts, $data);
					return 1;
			  }
		}
		
	public function forgotPwdModule($mobileno = '')
		{
			$this->db->select('id');
			$userid = (int) $this->db->get_where($this->_accounts, array('contactno' => $mobileno))->row()->{'id'};
			return $this->saveSmsInfo($userid, $mobileno);
		}
		
}
