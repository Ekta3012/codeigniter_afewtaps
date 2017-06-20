<?php

    date_default_timezone_set("Asia/Kolkata"); 
	
	$server_name  =  trim($_SERVER['SERVER_NAME']);
	
	if ($server_name != 'localhost')
		{
			$host         =  "localhost";
			$user         =  "afewtaps_main";
			$password     =  "0T;00xTsq@g1";
			$database     =  "afewtaps_fewtap";
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
									
	//$sql_query   =   "SELECT COUNT(`customer_id`) as count, `order_id`, `customer_id`, `order_time`, `establishment_id` FROM `ft_order` WHERE `order_time` >= $start_time && `order_time` <= $end_time GROUP BY `customer_id` HAVING count = 1";
	
	$sql_query   =   "SELECT max(`order_id`) as order_id , `customer_id`, `order_time`, `establishment_id` FROM `ft_order` WHERE `order_time` >= $start_time && `order_time` <= $end_time GROUP BY `customer_id`";
	
	$result      =    mysqli_query($con, $sql_query) or die(mysqli_error($con));
	
	if (mysqli_num_rows($result) > 0)
		{
            while ($res = mysqli_fetch_object($result))
				{
					$establishment_id 			     =  $res->establishment_id;

					$last_order_notification_hr      =  "SELECT `notifiy_hr_last_order`, `last_order_timing` FROM `ft_last_order_notification` WHERE `estabid` = $establishment_id AND `flag` = 1";
					
					$last_order_query                =  mysqli_query($con, $last_order_notification_hr) or die(mysqli_error($con));
					
					if (mysqli_num_rows($last_order_query) > 0)
						{
							$last_order_notification_obj     =  mysqli_fetch_object($last_order_query);
					
							$notifiy_hr_last_order           =  $last_order_notification_obj->notifiy_hr_last_order;
							
							$last_order_timing   	         =  $last_order_notification_obj->last_order_timing; // Last Order Timing //
							
							list ($closing_hr, $closing_min) =  explode (':', $last_order_timing);
							$mktime                          =  mktime($closing_hr, $closing_min, 0, date('m'), date('d'), date('Y'));
							
							$total_seconds                   =  $notifiy_hr_last_order * 3600;
							
							$time_diff                       =  $mktime - $total_seconds;
							
							$before_hr                       =  (int) date('H', $time_diff);
							$before_minutes                  =  (int) date('i', $time_diff);
							
							$current_hr                      =  (int) date('H');
							$current_min                     =  (int) date('i');
							
							if (($current_hr == $before_hr) && ($current_min == $before_minutes))
								{
									$customer_id      = $res->customer_id;
									$device_token_qry = mysqli_query($con, "SELECT `device_token` FROM `ft_accounts` WHERE `id` = $customer_id") or die(mysqli_error($con));
									$device_token_obj = mysqli_fetch_object($device_token_qry);
									$device_token     = $device_token_obj->device_token;
									if ( ! empty($device_token))
										{
											$send_time        =  $mktime - 1200;  // 20 MIN
											$insert_qry       =  mysqli_query($con, "INSERT INTO `ft_last_order_notify` SET `customer_id` = $customer_id, `send_time` = $send_time") or die(mysqli_error($con));
											
											$insert_id        =  mysqli_insert_id($con);
											
											$strtime          =  date('g:i a', strtotime($last_order_timing)); 
											
											$message = array('message' => "This outlet accepts last orders at $strtime. Notify Me!", 'title' => $insert_id);
											send_notification_ios(array($device_token), $message);
										}
										    mysqli_free_result($device_token_qry);
								}
						} 
						                    mysqli_free_result($last_order_query);
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
							
						$mainNoti    =  array('alert' => $message['message'], 'title' => $message['title'], 'badge' => '', 'type' => 'last_order', 'sound' => 'default');
									
						// $mainNoti  =  array_merge($mainNoti,$message);
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