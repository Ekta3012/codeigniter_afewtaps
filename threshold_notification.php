<?php
		
	error_reporting(-1);
		
	$host         =  "localhost";
	$root         =  "afewtaps_main";
	$password     =  "0T;00xTsq@g1";
	$database     =  "afewtaps_fewtap";
	
	const ANDROID_GCM_SEND_URL   =   "https://android.googleapis.com/gcm/send";
	const GOOGLE_API_KEY       	 =   "AIzaSyDc_DZ6W_aX3ugET3YC7NCmJ1EqYi1U_oU";

	$con          =   mysqli_connect($host, $root, $password);

	if ( ! $con)
	  {
		    die("Failed to connect:" . mysqli_connect_error());
	  }

	$open_db   =   mysqli_select_db($con, $database);
	
	if ( ! $open_db)
	   {
			die("Cannot connect to database" . mysqli_error());
	   }
	  
	date_default_timezone_set('Asia/Kolkata');  

	$start_time   =    mktime (0, 0, 0, date('m'), date('d'), date('Y'));
	$end_time     =    mktime (23, 59, 59, date('m'), date('d'), date('Y'));
	$time         =    time();
					
	$sql_query    =    "SELECT `order_id`, `customer_id`, `establishment_id`, `staff_member_id`, `order_time` FROM `ft_order` WHERE `status` = '1' AND `order_time` >= $start_time AND `order_time` <= $end_time AND `threshold_notification` = 0 AND `staff_member_id` != 0";
	
	$result       =    mysqli_query($con, $sql_query) or die(mysqli_error($con));
	if (mysqli_num_rows($result) > 0)
		{
			while ($info  =  mysqli_fetch_object($result))
		    	{
			 		$seconds    =   $time - ($info->order_time);
					$minutes    =   floor($seconds / 60); // min
					
					$threshold_query    =    "SELECT `value` FROM `ft_threshold` WHERE `eid` = $info->establishment_id";
					$threshold_result   =    mysqli_query($con, $threshold_query) or die(mysqli_error($con));
					
					if (mysqli_num_rows($threshold_result) > 0)
						{
							$threshold_data     =    mysqli_fetch_object($threshold_result);
							$threshold_limit    =    $threshold_data->value;
							
							if ($minutes >= $threshold_limit)
								{	
						            $staff_query       =    "SELECT `device_token` FROM `ft_staff_member` WHERE `id` = $info->staff_member_id";
									$staff_res         =     mysqli_query($con, $staff_query) or die(mysqli_error($con));
									$staff_obj         =     mysqli_fetch_object($staff_res);
									$staff_token       =     $staff_obj->device_token;
									
									//$amsg              =     "Order #$info->order_id is still pending for delivery. Its been more than $minutes minutes.Please keep it under priority&orderid=$info->order_id";
									
									$server_msg        =     "Order #$info->order_id has exceeded restaurant Threshold limit.&orderid=$info->order_id";
									
									$update_query      =     "UPDATE `ft_order` SET `status` = '5', `threshold_notification` = 1 WHERE `order_id` = $info->order_id";
									mysqli_query($con, $update_query) or die(mysqli_error($con));
									
									if ( ! empty($staff_token))
									sendNotification($staff_token, $server_msg);
									
									$customer_query    =    "SELECT `device_token` FROM `ft_accounts` WHERE `id` = $info->customer_id";
									$customer_res      =     mysqli_query($con, $customer_query) or die(mysqli_error($con));
									
									$customer_data     =     mysqli_fetch_object($customer_res);
									$device_token      =     $customer_data->device_token;
									
									if ( ! empty($device_token))
										{											
											$message   =     "The Service Staff has already been notified and your order #$info->order_id is under priority";

											send_notification_ios(array($device_token), array('message' => $message));
											
											$insert_query     =    "INSERT INTO `ft_order_notification` SET `notification` = '".$message."', `order_id` = $info->order_id, `flag` = 0, `notify_status` = 4, `ttime` = ".time()."";
											mysqli_query($con, $insert_query) or die(mysqli_error($con));
											
										}
								}
						}
				}
		}
		
		
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


		
	function sendNotification($reg_id = '', $message = '')
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
				
				// Open connection //
				
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