<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffauth extends CI_Controller {

    public function __construct()
		{
            parent::__construct();
		}
		
	public function staffSignUpModule()
		{
			if ($this->checkEstabIdServerId())
				{	
					$this->authmodel->staffSignUp();
					echo json_encode(array('status' => 'true'));
				}
		}
		
	private function checkEstabIdServerId()
		{
			return TRUE;
		}
		
	public function verifyOtp()
		{
			$status = $this->authmodel->verifyOtpModule();
			
			header('Content-Type: application/json');
			if ($status == TRUE)
			echo json_encode(array('status' => 'true'));
			   else
			echo json_encode(array('status' => 'false'));
		}

}