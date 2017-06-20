<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push
  {
	
	public $_document_root = '';
	
	public function __construct()
        {	

        }

	public static function send_notification_ios($requestIds = array(), $message = array())
		{
			$registration_ids  = array_values($requestIds);
			// Put y$our private key's passphrase here:
			$passphrase = 'Certificates';
			// Put your alert message here:
			$ctx = stream_context_create();
			stream_context_set_option($ctx, 'ssl', 'local_cert', $_SERVER['DOCUMENT_ROOT'].'/files/notification/ck.pem');
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

			// Open a connection to the APNS server
			$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
			if ($fp)
				{ 
				  foreach ($registration_ids as $registration_id)
					 {           
						// Create the payload body								
						/* if($message['sound'] == 1)
							    {
									$mainNoti   =  array(
										'alert'	    => $message['message'],
										'title'	    => '',
										'badge'  	=> '',
										'type'		=> '',
										'sound'		=> 'default'
								    );
							}
						else
							{
									$mainNoti= array(
										'alert'	    => $message['message'],
										'title'	    => $message['title'],
										'badge'  	=> $message['badge'],
										'type'		=> $message['type']
									);
							}
							*/
							
						if (isset($message['orderid']))
							
						  $mainNoti    =  array('alert' => $message['message'], 'title' => '', 'badge' => '', 'type' => '', 'sound' => 'default', 'orderid' => $message['orderid']);
						else
						
						  $mainNoti    =  array('alert' => $message['message'], 'title' => '', 'badge' => '', 'type' => '', 'sound' => 'default');
									
						//$mainNoti  =  array_merge($mainNoti,$message);
						$body['aps'] =  $mainNoti;
						
						// Encode the payload as JSON
						$payload     =  json_encode($body);
						//echo "<pre>";print_r($payload);
						// Build the binary notification
						$msg = chr(0) . pack('n', 32) . pack('H*', trim($registration_id)) . pack('n', strlen($payload)) . $payload;
			 
						// Send it to the server
						$result = fwrite($fp, $msg, strlen($msg)); 						
					}
						// Close the connection to the server
						fclose($fp);
				}
		
		}
}