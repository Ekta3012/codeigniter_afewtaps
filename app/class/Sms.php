<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms
  {
	public function __construct()
        {
			
        }

	public static function sendMessage($contactno = '', $msg = '')
		{
			$message = rawurlencode($msg);
			$url  = "http://XLIM.msg4all.com/GatewayAPI/rest?method=SendMessage&send_to=91";
			$url .= $contactno;
			$url .= "&msg=$message&msg_type=TEXT&loginid=afew123&auth_scheme=plain&password=xlim2016fewtap&v=1.1&format=text";

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
		
		}
}