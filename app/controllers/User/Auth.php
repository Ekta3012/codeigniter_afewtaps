<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private $_accounts;
	private $_folder_root;
	
	public function __construct()
		{
				parent::__construct();
			
				$this->_accounts        =    $this->db->dbprefix('accounts');
				$this->_folder_root     =    $_SERVER['DOCUMENT_ROOT'].'/fewtaps/uploads/';
		}
		
	public function fbAccount()
		{
			    header('Content-Type: application/json');
				
				$responseid = (int) $this->authmodel->fbAccountModule();
				if ($responseid > 0)
				echo json_encode(array('userid' => "$responseid"));
				   else
				echo json_encode(array('userid' => "0"));
			
		}
		
	public function createAccount()
		{		
			$responseValue  =   (int) $this->isAccountExists();
			$response       =   array();
			
				switch ($responseValue)
					{
						case 1:
								   $response["error"]    =  "true";
								   $response["message"]  =  "Email already existed!";
								   $response["userid"]   =  "";
					    break;
								  
						case 0:
								   $id = (int) $this->authmodel->createAccountModule();
								   if ($id > 0)
								     {
									        $response["error"]    =   "false";
									        $response["message"]  =   "Sign Up";
									        $response["userid"]   =   $id;
								     }
								   else
									  {
											$response["error"]    =   "true";
											$response["message"]  =   "Validation Error. Try Again!";
											$response["userid"]   =   "";
									  }
						break;
					}
					
						header('Content-Type: application/json');
						echo json_encode($response, JSON_PRETTY_PRINT);
		}
		
	public function isAccountExists()
		{
			$email      =   $this->input->post('email');	
			return (int) $this->db->query("SELECT * FROM `".$this->_accounts."` WHERE `status` = ? AND `email` = ?", array(1, $email))->num_rows(); 
		}
		
	public function verifyOtp()
		{
				header('Content-Type: application/json');
				
				$responseid = (int) $this->authmodel->verifyOtpModule();
				if ($responseid > 0)
				echo json_encode(array('success' => "$responseid"));
				   else
				echo json_encode(array('success' => "0"));
		}
		
	public function resendOtp()
		{
			    header('Content-Type: application/json');
				
				$responseid = (int) $this->authmodel->resendOtpModule();
				if ($responseid > 0)
				echo json_encode(array('success' => "$responseid"));
				   else
				echo json_encode(array('success' => "0"));
		}
		
	public function sendMobileNumber()
		{	
			$response    = array();
			$responseval = (int) $this->isMobileExists();
			switch ($responseval)
				{
					case 1:
							   $response["error"]    =  'true';
							   $response["message"]  =  'Mobile number already existed!';
							   break;
					default:
							   $return               =   $this->authmodel->sendMobileNumberModule();
							   $response["error"]    =  'false';
							   $response["message"]  =   "$return";
							   break;
				}
				
			header('Content-Type: application/json');
			echo json_encode($response);
		}

		
	public function isMobileExists()
		{
			$contactno  =  $this->input->post('contactno');
			$return     =  (int) $this->db->query("SELECT * FROM `".$this->_accounts."` WHERE `status` = ? AND `contactno` = ?", array(1, $contactno))->num_rows(); 
			return $return > 0 ? 1 : 0 ;
		}
		
	public function signIn()
		{
			$response =  $this->authmodel->signInModule();
			header('Content-Type: application/json');
			echo json_encode(array('success' =>  $response));
		}
		
	
	public function changePwd()
		{
			if (count($this->input->post()) === 3)
			   {	
				    $id             =   (int) $this->input->post('id');
				    $oldpwd         =    sha1(trim($this->input->post('old_pwd')));
                	$responseValue  =   (int) $this->isValidPassword($id, $oldpwd);
					if ($responseValue > 0)
						 {
							  $new_pwd              =   sha1(trim($this->input->post('new_pwd')));
							  $this->authmodel->userUpdatePasswordModule($id, $new_pwd);
							  $response["error"]   	=  'false';
							  $response["message"] 	=  "Successfully Updated";
						 }
					else
						  {
							  $response["error"]   	=  'true';
							  $response["message"] 	=  "old password does not match";
						  }
		       }
			else
					      {
							  $response["error"]   	=  'true';
							  $response["message"] 	=  "Validation Error. Try Again!";
					      }
							  header('Content-Type: application/json');
							  echo json_encode($response);	
		}
		
	private function isValidPassword($id = '', $oldpwd = '')
		{
			return (int) $this->db->query("SELECT * FROM `".$this->_accounts."` WHERE `status` = ? AND `id` = ? AND `Password` = ?", array(1, $id, $oldpwd))->num_rows();
		}
		
	public function forgotPwd()
		{
			if (count($this->input->post()) > 0)
			   {
				    $contactno       =   $this->input->post('contactno');
					$responseValue   =   (int) $this->isValidMobileNumber($contactno);
					if ($responseValue > 0)
					  {
						  $returnval   =   $this->authmodel->forgotPwdModule($contactno);
						  if ($returnval != FALSE)
							   {
								    $response["error"]      =   'false';
								    $response["message"]    =   "SMS request is initiated! You will be receiving it shortly.";
									$response["id"]         =   $responseValue;
							   }
					     else
							  {
								    $response["error"]   	=  'true';
								    $response["message"] 	=  "Error. Try Again!";
									$response["id"]         =   "";
							  }  
					  }
					 else
					   {
						        $response["error"]   	=  'true';
                                $response["message"] 	=  "Mobile no does not belong to any account.";
								$response["id"]         =  "";
					   }
			   }
			 else
			    {
				        $response["error"]   	=  'true';
					    $response["message"] 	=   "Validation Error. Try Again!";
						$response["id"]         =   "";
				}
				
						header('Content-Type: application/json');
						echo json_encode($response);
		}	
	
	private function isValidMobileNumber($contactno = '')
		{
			//return (int) $this->db->query("SELECT * FROM `".$this->_accounts."` WHERE `status` = ? AND `contactno` = ?", array(1, $contactno))->num_rows();
			$res = $this->db->query("SELECT `id` FROM `".$this->_accounts."` WHERE `status` = ? AND `contactno` = ?", array(1, $contactno));
			if ($res->num_rows() > 0)
				return $res->row()->id;
			else
				return 0;
		}
		
	public function updatePasswordHere()
		{
			$id = (int) $this->authmodel->updatePasswordHereModule();
			header('Content-Type: application/json');
			if ($id > 0)
			echo json_encode(array('success' => $id));
		         else
			echo json_encode(array('success' => 0));
		}
		
	
	public function viewProfile()
		{
			$response = $this->authmodel->viewProfilePic();
			header('Content-Type: application/json');
			echo json_encode(array('success' =>  $response));
		}
		
		
	public function editProfile()
		{
				$response = (int) $this->authmodel->editProfileModule();
				header('Content-Type: application/json');
				if ($response > 0)
					echo json_encode(array('success' =>  $response));
				else
					echo json_encode(array('success' =>  0));
		}
		
	public function faq()
		{				 
				$response =  $this->authmodel->faqModule();
				header('Content-Type: application/json');
				echo json_encode(array('success' =>  $response));
		}
		
		
	public function userTermsCms()
		{				 
				$response =  $this->authmodel->userTermsCmsModule();
				header('Content-Type: application/json');
				echo json_encode(array('success' =>  $response));
		}
		
	public function userPolicyCms()
		{				 
				$response =  $this->authmodel->userPolicyCmsModule();
				header('Content-Type: application/json');
				echo json_encode(array('success' =>  $response));
		}
}
