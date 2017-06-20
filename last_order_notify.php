<?php
    date_default_timezone_set("Asia/Kolkata"); 
	
	$server_name  =  trim($_SERVER['SERVER_NAME']);
	if ($server_name != 'localhost')
		{
			$host         =  "localhost";
			$user         =  "ourwebsi_fewtapn";
			$password     =  "LtIlaxGh++gE";
			$database     =  "ourwebsi_fewtapnew";
		}
	else 
	    {
			$host         =  "localhost";
			$user         =  "root";
			$password     =  "";
			$database     =  "fewtapnew";
	    }

	$con = mysqli_connect($host, $user, $password, $database);
	
	if (mysqli_connect_errno()) 
	   {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
       }		
  
    $start_time  =   mktime (0, 0, 0, date('m'), date('d'), date('Y'));
	$end_time    =   mktime (23, 59, 59, date('m'), date('d'), date('Y'));
									
	$sql_query   =   "SELECT * FROM `ft_last_order_notify` WHERE `is_send` = 0 AND `notify` = 1";

	$result      =    mysqli_query($con, $sql_query) or die(mysqli_error($con));
	
	if (mysqli_num_rows($result) > 0)
		{
            while ($res = mysqli_fetch_object($result))
				{
					$customer_id 		=   $res->customer_id;
					$send_time   		=   $res->send_time;
					
					$before_hr          =  (int) date('H', $send_time);
					$before_minutes     =  (int) date('i', $send_time);

					$current_hr         =  (int) date('H');
					$current_min        =  (int) date('i');
					
					if (($current_hr == $before_hr) && ($current_min == $before_minutes))
						{
							$device_token_qry = mysqli_query($con, "SELECT `device_token` FROM `ft_accounts` WHERE `id` = $res->customer_id") or die(mysqli_error($con));
							$device_token_obj = mysqli_fetch_object($device_token_qry);
							$device_token     = $device_token_obj->device_token;
							
							if ( ! empty($device_token))
								{
									mysqli_query($con, "UPDATE `ft_last_order_notify` SET `is_send` = 1 WHERE `customer_id` = $customer_id") or die(mysqli_error($con));
									$message = array('message' => "last order notification");
									send_notification_ios(array($device_token), $message);
								}
								    mysqli_free_result($device_token_qry);
						}
				}
		}
		
	 mysqli_free_result($result);
	 

	 mysqli_close($con);
	
		
	function send_notification_ios($requestIds = array(), $message = array())
		{
			$registration_ids  = array_values($requestIds);
			// Put y$our private key's passphrase here:
			$passphrase = 'Certificates';
			// Put your alert message here:
			$ctx = stream_context_create();
			stream_context_set_option($ctx, 'ssl', 'local_cert', $_SERVER['DOCUMENT_ROOT'].'/fewtaps/files/notification/ck.pem');
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

			// Open a connection to the APNS server
			$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
			if ($fp)
				{ 
				  foreach ($registration_ids as $registration_id)
					 {           
						// Create the payload body								
							
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

?>