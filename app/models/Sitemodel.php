<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemodel extends CI_Model {

	private $_account;
	
    public function __construct()
		{
              parent::__construct();
			 
			  $this->_account  =   $this->db->dbprefix('account');  
		}
		
	public function signUpModule($name = '', $email = '')
		{
			die('ssdfdfdddddddddddddf');
			
			$random = substr(sha1(mt_rand()), 0, 25);
			$this->db->insert($this->_account, array('name' => $name, 'email' => $email, 'status' => 0, 'random_key' => $random, 'ttime' => time()));
			
			$id = $this->db->insert_id();

			$html = '<table width="50%" style="text-align:center;font-size:15px;font-family:\'Myriad Set Pro\',\'Helvetica Neue\',\'Helvetica\',\'Arial\',sans-serif" border="0" cellspacing="10" cellpadding="10">
					  <tr>
						<th scope="col"><img src="'.base_url().'images/logomail.jpg" alt="" width="56" height="56" /></th>
					  </tr>
					  <tr>
						<th scope="col">Welcome to <strong>afewtaps</strong></th>
					  </tr>
					  <tr>
						<td>Thank you for connecting with us.</td>
					  </tr>
					  <tr>
						<td style="text-align:center">We promise to offer you services that will make your establishment smarter
				and faster.</td>
					  </tr>
					  <tr>
						<td style="text-align:center">Your application is under review and we will call you once we’re ready to
				serve you.</td>
					  </tr>
					  <tr>
						<td style="text-align:left">Thanks</td>
					  </tr>
					   <tr>
						<td style="text-align:left">Team <strong>afewtaps</strong></td>
					  </tr>
					</table>';
					
	
	        /* Send Mail To User */
					
				$this->load->library('email');
				$this->email->from('no-reply@afewtaps.com', 'afewtaps');
				$this->email->to($email);
				$this->email->subject('Welcome to afewtaps');
				$this->email->message($html);
				$this->email->send();
			
			/* Send Mail To Owner */
			
			    $html = '<table width="50%" style="text-align:center;font-size:15px;font-family:\'Myriad Set Pro\',\'Helvetica Neue\',\'Helvetica\',\'Arial\',sans-serif" border="0" cellspacing="10" cellpadding="10">
					     <tr>
						   <th scope="col"><img src="'.base_url().'images/logomail.jpg" alt="" width="56" height="56" /></th>
					     </tr>
						  <tr>
							<td style="text-align:center">Name: '.$name.'</td>
						 </tr>
						  <tr>
							<td style="text-align:center">Email: '.$email.'</td>
						 </tr>
						 <tr>
							<td style="text-align:center"><a href="'.base_url().'index.php/activate/'.$random.'">Click here to activate account</a></td>
						 </tr>
						</table>';
						
					//	echo base_url().'index.php/activate/'.$random;
						
						
			
				$this->load->library('email');
				$this->email->from('no-reply@afewtaps.com', 'afewtaps');
				$this->email->to('support@afewtaps.com');
				$this->email->subject('afewtaps - signup');
				$this->email->message($html);
				$this->email->send();
			
		}
	
}
