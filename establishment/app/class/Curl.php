<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl
  { 
	private static $append_url          =  'https://api.instamojo.com/';
	private static $grant_type          =  'client_credentials';
	//private static $client_id           =  '0nCHJ0aPmVCtH9NeF9xWGHcM0hpVgjwefw1Hm5Kl';
	//private static $client_secret       =  'MYRqHxvPj19hR10jYVsjg4yhfhqb56I33helQOmISuTzBuXvbPVquVEITuK2MCOLEdWUINXlD54zlZcX4YW5ubt2gemJ8bfNo3DxSFvePAkq0w4UgLYM8ZCusrHOiwMN';
	//private static $referrer            =  'appsdev3';
	
	private static $client_id           =  '0eI7dZLlz31AqADhUb1fc7Z7UsjLMQzOKwgleWuV';
	private static $client_secret       =  'DQLc9u0XDYRo0L6kevOml4qdWjCMVnyATetu9Tqq0YSo4HKuRy3WfpPSgIuZEhZOnwtIWyu9CPE4TmLP6QFhNwz0jCRRqrRHPZLThoRu23qnNTDWphG3lDLFfvAKm8IT';
	private static $referrer            =  'thinkdifferent';
	
	
	private static $grant_type_auth     =  'password';
	private static $grant_type_refresh  =  'refresh';
	
	public function __construct()
        {
			
        }

	public static function callMethod($curl_url = '', $array_data = array(), $headers = '', $method = '', $call_method = '', $post_type = '')
		{
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, self::$append_url . $curl_url);
			
			if ( ! empty($headers))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			switch ($method) 
				{
					case 'token':
					                       $arr = array('grant_type' => self::$grant_type, 'client_id' => self::$client_id, 'client_secret' => self::$client_secret);
							               break;
									
					case 'auth':
					                       $arr = array('grant_type' => self::$grant_type_auth, 'client_id' => self::$client_id, 'client_secret' => self::$client_secret, 'username' => $array_data['username'], 'password' => $array_data['password']);
							               break;
									
					case 'refresh_token':
					                       $arr = array('grant_type' => self::$grant_type_refresh, 'client_id' => self::$client_id, 'client_secret' => self::$client_secret, 'refresh_token' => $array_data['refresh_token']);
							               break;
									
					case 'signup':
										   $arr = array('email' => $array_data['email'], 'password' => $array_data['password'], 'phone' => $array_data['phone'], 'referrer' => self::$referrer);
										   break;
										   
					case 'update_user':
										   $arr = array('first_name' => $array_data['first_name'], 'last_name' => $array_data['last_name'], 'location' => $array_data['location'], 'phone' => $array_data['phone']);
										   break;
										   
                    case 'update_bank_details':
                                           		    $arr = $array_data;
													break;						
				}
				
			if ( ! empty($call_method))
				{
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $call_method);
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arr));
				}
			else
				{
					curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);  // Post Fields //
				}
				
			$server_output  = curl_exec($ch);
		
			if(curl_errno($ch))
				{
					return;
				}

			curl_close($ch);
			
			$return = FALSE;
			
			switch ($method) 
				{
					case 'token':
					case 'auth':
					case 'refresh_token':
												 $response = json_decode($server_output);
												 if (! isset($response->error))
												 $return  = $response;
												 break;
												 
					case 'signup':
					case 'update_user':
												 $response = json_decode($server_output);
												 if (isset($response->id))
												 $return  = $response;
												 break;
											 
					case 'update_bank_details':
												 $response = json_decode($server_output);
												 if (isset($response->user))
												 $return  = $response;
												 break;	 
				}
				    return $return;
		}
}