<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	public function __construct()
		{
			parent::__construct();
		}
		
	public function paymentSuccess()
		{
				header('Content-Type: application/json');
				$result = $this->paymodel->paymentSuccessModule();
				echo json_encode(array('response' => $result));
		}
	
}
