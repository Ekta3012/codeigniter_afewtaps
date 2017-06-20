<?php

	/*$host         =  "localhost";
	$root         =  "root";
	$password     =  "";
	$database     =  "project";
										  
	//define('BASEUPLOADFILE', $docRoot . "files/");

	$con = mysqli_connect($host, $root, $password);
	
	if( ! $con)
	  {
		   die("Failed to connect:" . mysqli_connect_error());
	  } 
	 
	
	$open_db = mysqli_select_db($con, $database);
	
	//$current_date  =   date('d-m-Y');
	
	$current_date  =   date('Y-m-d');
	
	$current_date  =   "2016-06-23";
	
	$sql  		   =   "SELECT `user_id`, `email` FROM `tbl_users` WHERE `role_id` != 1"; 
	$resquery      =   mysqli_query($con, $sql) or die(mysqli_error($con));
	if (mysqli_num_rows($resquery) > 0)
		{
			while ($info  =  mysqli_fetch_object($resquery))
				{
					 $tasksql  		 =   "SELECT * FROM `tbl_task` WHERE `task_start_date` = '$current_date' AND `permission` REGEXP '{\"([^\"]*)$info->user_id([^\"]*)\"' AND `task_status` != 'completed'"; 
					 
					 $tasksqldata    =   mysqli_query($con, $tasksql) or die(mysqli_error($con));
					 
					 if (mysqli_num_rows($tasksqldata) > 0)
						 {
							 $filename     =   $_SERVER['DOCUMENT_ROOT'].'/project/'.'today_task.xls'; 
							 $fp           =   fopen($filename, "wb");

							 $insert_rows  = "S.no";							
							 $insert_rows .= "\t";							
							 $insert_rows .= "Task Name";
						     $insert_rows .= "\n";
						   
						     fwrite($fp, $insert_rows);	

                             $i = 1;							 
							 while ($resdata  =  mysqli_fetch_object($tasksqldata))
								 {
									$task_name   = $i;
									$task_name  .= "\t";
									$task_name  .= $resdata->task_name;
									$task_name  .= "\n";
									fwrite($fp, $task_name);
									$i++;
								 }

									$my_name    =  "xlim";
									$my_mail    =  "no-reply@xlim.org";
									$my_replyto =  "no-reply@xlim.org";
									$my_subject =  "Today Task";
									$my_message =  "PFA";
									$send_mail  =  $info->email;
									mail_attachment($filename, $send_mail, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
									
								    fclose($fp);	
						 }
				}							
		}	
	mysqli_close($con);

	
*/

//echo PHP_EOL; die();



									require 'PHPMailer/PHPMailerAutoload.php';

									$mail = new PHPMailer;

									//$mail->SMTPDebug = 3;                                   // Enable verbose debug output

									$mail->isSMTP();                                          // Set mailer to use SMTP
									$mail->Host         = 'smtp.googlemail.com';              // Specify main and backup SMTP servers
									$mail->SMTPAuth     = true;                               // Enable SMTP authentication
									$mail->Username     = 'tech1@xlim.org';                   // SMTP username
									$mail->Password     = 'Tech1!@#';                         // SMTP password
									$mail->SMTPSecure   = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
									$mail->Port 	    = 465;                                // TCP port to connect to

									$mail->setFrom('no-reply@xlim.org', 'Xlim');
									$mail->addAddress('tech1@xlim.org', 'Tech');              // Add a recipient

									$mail->addAttachment('/home/ourwebsite/public_html/fewtaps/test.php');         // Add attachments
									$mail->isHTML(true);                                      // Set email format to HTML

									$mail->Subject = 'Here is the subject';
									$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
									$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

									if(!$mail->send()) {
										echo 'Message could not be sent.';
										echo 'Mailer Error: ' . $mail->ErrorInfo;
									} else {
										echo 'Message has been sent';
									}

die();


    	                            $filename   = '/home/ourwebsite/public_html/fewtaps/test.php';
									$my_name    =  "xlim";
									$my_mail    =  "no-reply@xlim.org";
									$my_replyto =  "no-reply@xlim.org";
									$my_subject =  "Today Task";
									$my_message =  "PFA";
									$send_mail  =  'viju09singh@gmail.com';
									mail_attachment($filename, $send_mail, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
									
									
	function mail_attachment($filename = '', $mailto = '', $from_mail = '', $from_name = '', $replyto = '', $subject = '', $message = '') 
	   {
			 $file_size = filesize($filename);
			 $handle    = fopen($filename, "r");
			 $content   = fread($handle, $file_size);
			 fclose($handle);
			 $content   = chunk_split(base64_encode($content));
			 $uid       = md5(uniqid(time()));
			 $header    = "From: ".$from_name." <".$from_mail.">\r\n";
			 $header   .= "Reply-To: ".$replyto."\r\n";
			 $header   .= "MIME-Version: 1.0\r\n";
			 $header   .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n";
			 //$header   .= "This is a multi-part message in MIME format.\r\n";
			 $header   .= "--".$uid."\r\n";
			 $header   .= "Content-type:text/plain; charset=iso-8859-1\r\n";
			 $header   .= "Content-Transfer-Encoding: 7bit\r\n";
			 $header   .= $message."\r\n";
			 $header   .= "--".$uid."\r\n";
			 $header   .= "Content-Type: application/octet-stream; name=\"".basename($filename)."\"\r\n"; // use different content types here
			 $header   .= "Content-Transfer-Encoding: base64\r\n";
			 $header   .= "Content-Disposition: attachment; filename=\"".basename($filename)."\"\r\n";
			 $header   .= $content."\r\n";
			 $header   .= "--".$uid."--";
			 if (mail($mailto, $subject, "", $header))
				 {
					echo "Mail Sent Successfully to " . $mailto ."<br/>"; // or use booleans here
				} else {
					echo "Mail NOT Sent to " .$mailto ."<br/>";
				}
	  }
	  
	  
	  
	  function mail_attachment1($filename = '', $mailto = '', $from_mail = '', $from_name = '', $replyto = '', $subject = '', $message = '') 
	   {
		   
		     $eol = PHP_EOL;
			 $file_size = filesize($filename);
			 $handle    = fopen($filename, "r");
			 $content   = fread($handle, $file_size);
			 fclose($handle);
			 $content   = chunk_split(base64_encode($content));
			 $uid       = md5(uniqid(time()));
			 $header    = "From: ".$from_name." <".$from_mail.">".$eol;
			 $header   .= "Reply-To: ".$replyto.$eol;
			 $header   .= "MIME-Version: 1.0\r\n";
			 $header   .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";
			 //$header   .= "This is a multi-part message in MIME format.\r\n";
			 $header   .= "--".$uid.$eol;
			 $header   .= "Content-type:text/plain; charset=iso-8859-1".$eol;
			 $header   .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
			 $header   .= $message.$eol;
			 $header   .= "--".$uid.$eol;
			 $header   .= "Content-Type: application/octet-stream; name=\"".basename($filename)."\"".$eol; // use different content types here
			 $header   .= "Content-Transfer-Encoding: base64".$eol;
			 $header   .= "Content-Disposition: attachment; filename=\"".basename($filename)."\"".$eol;
			 $header   .= $content.$eol;
			 $header   .= "--".$uid."--";
			 if (mail($mailto, $subject, "", $header))
				 {
					echo "Mail Sent Successfully to " . $mailto ."<br/>"; // or use booleans here
				} else {
					echo "Mail NOT Sent to " .$mailto ."<br/>";
				}
	  }

?>