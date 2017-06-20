<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webmodel extends CI_Model {

	private $_account;
	
    public function __construct()
		{
              parent::__construct();
			 
			  $this->_account  =   $this->db->dbprefix('account');  
		}
		
	public function signUpModule($name = '', $email = '', $mobile = '', $address = '')
		{
			$random = substr(sha1(mt_rand()), 0, 25);
			$this->db->insert($this->_account, array('name' => $name, 'email' => $email, 'contactno' => $mobile, 'address' => $address, 'status' => 0, 'random_key' => $random, 'ttime' => time()));
			
			$id = $this->db->insert_id();

			$html = '<table width="50%" style="text-align:center;font-size:14px;font-family:Source Sans Pro,Helvetica Neue,Helvetica,Arial,sans-serif" border="0" cellspacing="0" cellpadding="0">
			
			          <tr>
								<td style="text-align:center;background:#000;color:#fff;font-size:16px;" height="42">afewtaps</td>
					  </tr>
					  
					  <tr>
							   <th scope="col" height="10"></th>
					  </tr>
						  
					  <tr>
						<th scope="col"><img src="'.base_url().'images/logomail.png" alt="" width="56" height="56" /></th>
					  </tr>
					  <tr>
						<th scope="col" height="30">Welcome to <strong>afewtaps</strong></th>
					  </tr>
					  <tr>
						<td height="30">Thank you for connecting with us.</td>
					  </tr>
					  <tr>
						<td style="text-align:center" height="30">We promise to offer you services that will make your establishment smarter
				and faster.</td>
					  </tr>
					  <tr>
						<td style="text-align:center" height="30">Your application is under review and we will call you once we’re ready to
				serve you.</td>
					  </tr>
					  <tr>
						<td style="text-align:left" height="30">Thanks</td>
					  </tr>
					   <tr>
						<td style="text-align:left">Team <strong>afewtaps</strong></td>
					  </tr>
					  
					    <tr>
								<td style="text-align:center;background:#000;color:#fff" height="30">Copyright &copy; '.date('Y').' Think Different Technologies (P) Ltd.</strong></td>
						</tr>
							 
					</table>';
					
	
	        /* Send Mail To User */
					
				$this->load->library('email');
				$this->email->from('no-reply@afewtaps.com', 'afewtaps');
				$this->email->to($email);
				$this->email->subject('ackowledgement');
				$this->email->set_mailtype("html");
				$this->email->message($html);
				$this->email->send();
			
			/* Send Mail To Owner */
			
			    $html = '<table width="50%" style="text-align:center;font-size:14px;font-family:Source Sans Pro,Helvetica Neue,Helvetica,Arial,sans-serif" border="0" cellspacing="0" cellpadding="0">
				
				
				          <tr>
								<td style="text-align:center;background:#000;color:#fff;font-size:16px;" height="42">afewtaps</td>
						  </tr>
						  
						  <tr>
							   <th scope="col" height="10"></th>
						  </tr>
							 
							 
					     <tr>
						   <th scope="col"><img src="'.base_url().'images/logomail.png" alt="" width="56" height="56" /></th>
					     </tr>
						  <tr>
							<td style="text-align:center" height="30">Name: '.$name.'</td>
						 </tr>
						  <tr>
							<td style="text-align:center" height="30">Email: '.$email.'</td>
						 </tr>
						 
						 <tr>
							<td style="text-align:center" height="30">Mobile: '.$mobile.'</td>
						 </tr>
						 
						 <tr>
							<td style="text-align:center" height="30">Address: '.$address.'</td>
						 </tr>
						 
						 <tr>
							<td style="text-align:center" height="30"><a title="Click here to activate" href="'.base_url().'index.php/activate/'.$random.'">Click here to activate account</a></td>
						 </tr>
						 
						 <tr>
								<td style="text-align:center;background:#000;color:#fff" height="30">Copyright &copy; '.date('Y').' Think Different Technologies (P) Ltd.</strong></td>
						 </tr>
							 
						</table>';
			
				$this->load->library('email');
				$this->email->from('no-reply@afewtaps.com', 'afewtaps');
				$this->email->to('afewtaps@gmail.com');
				$this->email->subject('afewtaps - account verify');
				$this->email->set_mailtype("html");
				$this->email->message($html);
				$this->email->send();
		}
	
}
