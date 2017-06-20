<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authmodel extends CI_Model {

    private $_staff_member;
    private $_accounts;
	private $_sms_codes;
	private $_faq;
	private $_user_cms;
	private $_folder_root;
	
    public function __construct()
		{
              parent::__construct();
			 
			  $this->_staff_member     =      $this->db->dbprefix('staff_member');
			  $this->_accounts         =      $this->db->dbprefix('accounts');
			  $this->_sms_codes        =      $this->db->dbprefix('sms_codes');
			  $this->_faq              =      $this->db->dbprefix('faq');
			  $this->_user_cms         =      $this->db->dbprefix('user_cms');

			  $this->_folder_root	   =      $_SERVER['DOCUMENT_ROOT'].'/uploads/';	  
		}
		
	public function fbAccountModule()
		{
			$id = 0 ;
			if (count($this->input->post()) > 0)
				 { 
					 $email  =   strtolower(trim($this->input->post('email')));
					 $id     =   $this->checkAccount($email);
					 if ($id == 0)
						 {
							 $data['name']         =   strtolower(trim($this->input->post('name')));
							 $data['email']        =   $email;
						     $data['pic']          =   $this->input->post('pic');
						     $data['device_token'] =   $this->input->post('device_token');
							 
							 $data['regtime']      =   time();
							 $data['status']       =   1;
							 $this->db->insert($this->_accounts, $data);
							 
							 return $this->db->insert_id();
						 }
				 } 
				             return $id;
		}
		

	private function checkAccount($email = '')
		{
			$res =  $this->db->select('id')->get_where($this->_accounts, array('email' => $email, 'status' => 1));
			if ($res->num_rows() > 0)
				return $res->row()->id;
			else
				return 0;
		}
	
	public function signInModule()
		{
			$arr = "";
			$id  = 0 ;
			if (count($this->input->post()) > 0)
			    {
					$email_contact_no  =  trim($this->input->post('email_contact_no'));
					$pwd               =  sha1(trim($this->input->post('password')));
					$sql       		   =  "SELECT `id`, `name` FROM `".$this->_accounts."` WHERE (`email` = ? OR `contactno` = ?) AND `pwd` = ? AND `status` = ?";
					$query       	   =  $this->db->query($sql, array($email_contact_no, $email_contact_no, $pwd, 1));
					if ($query->num_rows() > 0)
						{
							$row   			=   $query->row();
							$id    			=   $row->id;
							$arr   			=   array('id' => $id);
							$device_token   =   $this->input->post('device_token');
							$this->db->where(array('id' => $id))->update($this->_accounts, array('device_token' => $device_token));
						}
				}
				            return $id;
		}
		
	public function createAccountModule()
		{				
			if (count($this->input->post()) > 0)
				 {
					 $data['name']         =   strtolower(trim($this->input->post('name')));
					 $data['email']        =   strtolower(trim($this->input->post('email')));
					 $data['pwd']          =   sha1(trim($this->input->post('password')));
					 $data['device_token'] =   $this->input->post('device_token');
					 $data['regtime']      =   time();
					 $this->db->insert($this->_accounts, $data);
					 $insert_id          =   $this->db->insert_id();
					 return $insert_id;
				 }
			else 
				     return 0;
		}
		
	public function sendMobileNumberModule()
		{	
			if (count($this->input->post()) > 0)
				 { 
					 $id                 =   $this->input->post('userid');
					 $contactno          =   $this->input->post('contactno');
					 $data['contactno']  =   $contactno;
					 $this->db->where('id', $id);
					 $this->db->update($this->_accounts, $data);
					 return $this->saveSmsInfo($id, $contactno);
				 }
                     return 0;				 
		}
		
    
	public function saveSmsInfo($uid = '', $mobile = '')
		{
			$this->db->where('user_id', $uid);
			$this->db->delete($this->_sms_codes);
			
			$otp                 =   rand(100000, 999999);
			$data['user_id']     =   $uid;
			$data['code']        =   $otp;			
			$this->db->insert($this->_sms_codes, $data);
			$this->sendSmsDataToUser($otp, $mobile, 0);
			return 1;
		}
		
	public function resendOtpModule()
		{
			 if (count($this->input->post()) > 0)
				 {
					 $userid      =  $this->input->post('id');
					 $mobile      =  $this->input->post('mobile');
					
					 $this->db->order_by('id', 'desc');
					 $result      =  $this->db->get_where($this->_sms_codes, array('user_id' => $userid))->row();
					 $otp         =  $result->code; 
					 
					 return $this->sendSmsDataToUser($otp, $mobile, 0);
					
				 }
                     return 0;
		}
		
	public function sendSmsDataToUser($otp = '', $contactno = '', $message = '')
		{
		    $url = "http://XLIM.msg4all.com/GatewayAPI/rest?method=SendMessage&send_to=91".$contactno."&msg=Welcome%20to%20afewtaps.%20Your%20OTP%20is%20$otp&msg_type=TEXT&loginid=afew123&auth_scheme=plain&password=xlim2016fewtap&v=1.1&format=text";

			// Get cURL resource
			$curl = curl_init();
			// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => $url,
				CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			));
			// Send the request & save response to $resp
			$resp = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);
			
			return 1;
		}
		
		
	public function verifyOtpModule()
		{
			$otp = $this->input->get_post('otp');
			$this->db->where('code', $otp);
			$query = $this->db->get($this->_sms_codes);
			
			if ($query->num_rows() > 0)
				{
					$userid = $query->row()->user_id;
					
					$this->db->where('code', $otp)->update($this->_sms_codes, array('status' => 1));
					
					$this->db->where('id', $userid)->update($this->_accounts, array('status' => 1));
					
					return TRUE;
				}
			else
				    return FALSE;
		}
		
	public function userUpdatePasswordModule($id = '', $new_pwd = '')
		{
				$this->db->where('id', $id)->update($this->_accounts, array('pwd' => $new_pwd));
				return 1;
		}
		
	public function updatePasswordHereModule()
		{
			if (count($this->input->post()) > 0)
			  {
				    $userid          =  (int) $this->input->post('id');
					$data['pwd']     =  sha1(trim($this->input->post('pwd')));
					$this->db->where('id', $userid)->update($this->_accounts, $data);
					return 1;
			  }
			 else
				    return 0;
		}
		
	public function forgotPwdModule($mobileno = '')
		{
			$userid = (int) $this->db->select('id')->get_where($this->_accounts, array('contactno' => $mobileno))->row()->id;
			return $this->saveSmsInfo($userid, $mobileno);
		}
		
		
	public function viewProfilePic()
		{
			if (count($this->input->post()) > 0)
			  {
				    $userid          =  (int) $this->input->post('id');
				    $rec =  $this->db->select('name, pic')->get_where($this->_accounts, array('id' => $userid))->row();
					return array('name' => (string) $rec->name, 'pic' => (string) $rec->pic);
			  }
			 else
				    return 0;
		}	
		
		
	public function editProfileModule()
			{
				if (count($this->input->post()) > 0)
			       {
						 $this->load->library('upload');
						 $userid                   =    $this->input->post('userid');
						 $config['upload_path']    =    $this->_folder_root;
						 $config['allowed_types']  =    'gif|jpg|png|jpeg';
						 $config['encrypt_name']   =    TRUE;
						 $this->upload->initialize($config);
						 if ($this->upload->do_upload())
							  {
									$fdata           =   $this->upload->data();
									$data['pic']     =   $fdata['file_name'];	
							  }
							  
							        $name            =   $this->input->post('name');
									
									if (! empty($name))
							        $data['name']    =   $name;
									
									
									$this->db->where('id', $userid)->update($this->_accounts, $data);
									
									return (int) $this->db->affected_rows();
				   }
					else
									return 0;	     
			}
			
	public function faqModule()
		{
			$res    =   array();
			$query  =   $this->db->get_where($this->_faq, array('status' => '1'));
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $data)
					$res[] = array('que' => $data->que, 'ans' => $data->ans);
				}
			return $res;
		}
		
	public function userTermsCmsModule()
		{
				$content  = '';
				$this->db->select('description');
				$query    =   $this->db->get_where($this->_user_cms, array('page_id' => 1));
				if ($query->num_rows() > 0)
					{
						$content = $query->row()->description;
					}
				return $content;
		}
		
	public function userPolicyCmsModule()
		{
				$content = '';
				$query    =   $this->db->select('description')->get_where($this->_user_cms, array('page_id' => 2));
				if ($query->num_rows() > 0)
					{
						$content = $query->row()->description;
					}
				return $content;
		}
	
}
