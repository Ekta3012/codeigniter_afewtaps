<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private $_accounts;
	private $_folder_root;
	
	public function __construct()
		{
			parent::__construct();
			
			$this->_accounts          =     $this->db->dbprefix('accounts');
			$this->_folder_root       =  	$_SERVER['DOCUMENT_ROOT'].'/fewtaps/uploads/';
		}
		
	public function createAccount()
		{		
		        header('Content-Type: application/json');
		      echo json_encode(array('error' => 'false', 'message' => 'Sign Up', 'id' => ''));
		
		
				/*$responseValue  =   (int) $this->isAccountExists();
				$response       =   array();
			
				switch ($responseValue)
					{
						case 1:
								  $response["error"]   =  "true";
								  $response["message"] =  "Email already existed!";
								  $response["id"]      =  "";
								  break;
								  
						case 0:
								   $id = (int) $this->authmodel->createAccountModule();
								   if ($id > 0)
								     {
									        $response["error"]    =   "false";
									        $response["message"]  =   "Sign Up";
									        $response["id"]       =   $id;
								     }
								   else
									  {
											$response["error"]    =   "true";
											$response["message"]  =   "Validation Error. Try Again!";
											$response["id"]       =    "";
									  }
								  break;
					}
					*/
					
				//header('Content-Type: application/json');
				//echo json_encode($response, JSON_PRETTY_PRINT);
		}
		
	public function isAccountExists()
		{
			$contactno   =   $this->input->post('contactno');
			$email       =   $this->input->post('email');
			
			$sql         =   "SELECT * FROM `".$this->_accounts."` WHERE `status` = ? AND `email` = ?";
			return (int) $this->db->query($sql, array(1, $email))->num_rows(); 
			
		}
		
	public function verifyOtp()
		{
				header('Content-Type: application/json');
				
				$responseid = (int) $this->authmodel->verifyOtpModule();
				if ($responseid > 0)
				echo json_encode(array('success' => $responseid));
				   else
				echo json_encode(array('success' => 0));
		}
		
	public function sendMobileNumber()
		{
				header('Content-Type: application/json');
				$response = (int) $this->authmodel->sendMobileNumberModule();
				if ($response != FALSE)
				echo json_encode(array('success' => 1));
				   else
				echo json_encode(array('success' => 0));
		}

	public function signIn()
		{
			header('Content-Type: application/json');
			
			$response = (int) $this->authmodel->signInModule();
			if ($response > 0)
				echo json_encode(array('success' =>  $response));
			else
				echo json_encode(array('success' =>  0));
		}
		
	
	
}
