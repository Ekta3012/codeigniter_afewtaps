<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gcm {
  
    private $_CI;
	
    public function __construct()
      {
	        $this->_CI = &get_instance();
      }  
	
	public function sendNotification($reg_id = '', $message = '')
		  {
				$registatoin_ids  =  array($reg_id);
				
				$message          =  array('message' => $message, 'title' => 'Fewtaps', 'vibrate' => 1,	'sound'	=> 1);
			
				// Set POST variables
				$url = ANDROID_GCM_SEND_URL;
				
				$fields = array(
					'registration_ids' => $registatoin_ids,
					'data' => $message,
				);
		 
				$headers = array(
									'Authorization: key=' . GOOGLE_API_KEY,
									'Content-Type: application/json'
				);
				
				// Open connection
				
				$ch = curl_init();
		 
				// Set the url, number of POST vars, POST data
				curl_setopt($ch, CURLOPT_URL, $url);
		 
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 
				// Disabling SSL Certificate support temporarly
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		 
				// Execute post
				$result = curl_exec($ch);
				// Close connection
				curl_close($ch);
		 }
}