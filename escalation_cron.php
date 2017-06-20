<?php

    date_default_timezone_set('Asia/Kolkata');
	
    $host         =  "localhost";
	$root         =  "afewtaps_main";
	$password     =  "0T;00xTsq@g1";
	$database     =  "afewtaps_fewtap";
	
	const ANDROID_GCM_SEND_URL   =   "https://android.googleapis.com/gcm/send";
	const GOOGLE_API_KEY       	 =   "AIzaSyDc_DZ6W_aX3ugET3YC7NCmJ1EqYi1U_oU";

	$con = mysqli_connect($host, $root, $password);
	
	if( ! $con)
	  {
		   die("Failed to connect:" . mysqli_connect_error());
	  } 
	  
	$open_db = mysqli_select_db($con, $database);
	
	if( ! $open_db)
	   {
		   die("Cannot connect to database" . mysqli_error());
	   }
	
	$time         =    time();
	$diff         =    $time - 240;
	$sql_query    =    "SELECT `order_id`,`establishment_id` FROM `ft_order` WHERE `order_time` <= $diff AND `staff_member_id` = 0 AND `escalation_notification` = 0 AND `status` != 4";
	
	$result       =    mysqli_query($con, $sql_query) or die(mysqli_error($con));
	
	if (mysqli_num_rows($result) > 0)
		{
			while ($res_obj     =   mysqli_fetch_object($result))
				{
					$staff_qry        =    "SELECT `id`, `device_token` FROM `ft_staff_member` WHERE `branch_id` = ".$res_obj->establishment_id;
					$staff_sql_qry    =    mysqli_query($con, $staff_qry) or die(mysqli_error($con));
					
					$order_id         =   $res_obj->order_id;
					
					$message          =   "Please book order #$order_id. Check New Orders for more information";
				
					$insert_query     =   "INSERT INTO `ft_order_notification` SET `notification` = '".$message."', `order_id` = $order_id, `flag` = 0, `notify_status` = 3, `ttime` = ".time()."";
					
					mysqli_query($con, $insert_query) or die(mysqli_error($con));
					
					$update_query   =    "UPDATE `ft_order` SET `escalation_notification` = 1, `escalation_flag_service_app` = 1 WHERE `order_id` = $order_id";
					mysqli_query($con, $update_query) or die(mysqli_error($con));
			 
					while ($staff_result      =   mysqli_fetch_object($staff_sql_qry))
						{
							$reg_id           =   $staff_result->device_token;
							if (  ! empty ($reg_id))
							sendNotification($reg_id, $message);						
						}
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
		        

?>