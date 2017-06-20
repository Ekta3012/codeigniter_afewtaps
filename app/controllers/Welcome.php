<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	private $_account;
	private $_captcha_path;
	private $_captcha;
	
    public function __construct()
		{
              parent::__construct();
			 
			  $this->_account       =   $this->db->dbprefix('account'); 
			  $this->_captcha       =   $this->db->dbprefix('captcha'); 
              $this->_captcha_path	=   $_SERVER['DOCUMENT_ROOT'].'/captcha/';		  
		}
		
	public function index()
		{
			$this->load->helper('captcha');
			$vals = array(
							'img_path'      => $this->_captcha_path,
							'img_url'       => base_url().'captcha/',
							'font_path'     => $this->_captcha_path.'/unicode.optima.ttf',
							'img_width'     => '150',
							'img_height'    => 30,
							'expiration'    => 7200,
							'word_length'   => 6,
							'font_size'     => 16,
							'pool'          => '0123456789',

							// White background and border, black text and red grid
							'colors'        => array(
														'background' => array(255, 255, 255),
														'border' => array(229, 230, 231),
														'text' => array(0, 0, 0),
														'grid' => array(250, 197, 223)
													)
					     );
				
			$cap  = create_captcha($vals);

			$data = array(
							'captcha_time'  => $cap['time'],
							'ip_address'    => $this->input->ip_address(),
							'word'          => $cap['word']
						  );

			$query = $this->db->insert_string($this->_captcha, $data);
			$this->db->query($query);
			
            $cdata['cap'] = $cap;
			
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			if ($this->form_validation->run() == FALSE)
				{
						$this->load->view('index', $cdata);
				}
			else
				{
						$this->load->view('formsuccess');
				}
	    }
		
		
	public function userapp()
		{
				$this->load->view('userapp');
		}
	
	public function servapp()
		{
			    $this->load->view('servapp');
		}
		
	public function management()
		{
				$this->load->view('management');
		}
	
	public function career()
		{
				$this->load->view('career');
		}
	    
	public function terms()
		{
				$this->load->view('terms');
		}
	
	public function privacypolicy()
		{
				$this->load->view('privacypolicy');
		}
	
	public function faq()
		{
				$this->load->view('faq');
		}
		
	public function blog()
		{
				$this->load->view('blog');
		}
		
  	public function feedback()
		{
				$this->load->view('feedback');
		}	
		
	
	public function submit()
		{
			$name       =   $this->input->post('name');
			$email      =   $this->input->post('email');
			$mobile     =   $this->input->post('mobile');
			$address    =   $this->input->post('address');
			$captcha    =   $this->input->post('captcha');
			
			if ((empty($this->checkExist($email))))
				{
					if (($this->checkCaptcha($captcha)) > 0)
						{
							if ((! empty($name)) && ((bool) filter_var($email, FILTER_VALIDATE_EMAIL)))
								{
									$this->load->model('webmodel');
									$this->webmodel->signUpModule($name, $email, $mobile, $address);
									$arr = array('msg' => 'success', 'token' => "");
								}
							else
								{
									$arr = array('msg' => 'failure', 'token' => "");
								}
						}
					else
						{
									$arr = array('msg' => 'captcha_error', 'token' => "");
						}
				}
			else
				            $arr = array('msg' => 'validation', 'token' => "");
						
							echo json_encode($arr);
		}
		
	public function captcha()
		{
			$this->load->helper('captcha');
			$vals = array(
							'img_path'      => $this->_captcha_path,
							'img_url'       => base_url().'captcha/',
							'font_path'     => $this->_captcha_path.'/unicode.optima.ttf',
							'img_width'     => '150',
							'img_height'    => 30,
							'expiration'    => 7200,
							'word_length'   => 6,
							'font_size'     => 16,
							'pool'          => '0123456789',

							// White background and border, black text and red grid
							'colors'        => array(
														'background' => array(255, 255, 255),
														'border' => array(229, 230, 231),
														'text' => array(0, 0, 0),
														'grid' => array(250, 197, 223)
													)
					     );
				
			$cap  = create_captcha($vals);
			
			$data = array(
							'captcha_time'  => $cap['time'],
							'ip_address'    => $this->input->ip_address(),
							'word'          => $cap['word']
						  );

			$query = $this->db->insert_string($this->_captcha, $data);
			$this->db->query($query);
			
            echo json_encode(array('file' => $cap['filename']));
			
		}
		
	private function checkCaptcha($captcha = '')
		{
			// First, delete old captchas
			$expiration = time() - 7200; // Two hour limit
			$this->db->where('captcha_time < ', $expiration)->delete($this->_captcha);

			// Then see if a captcha exists:
			$sql = 'SELECT `captcha_id` FROM `'.$this->_captcha.'` WHERE word = ? AND ip_address = ? AND captcha_time > ? AND status = ?';
			
			$binds = array($captcha, $this->input->ip_address(), $expiration, 0);
			
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0)
				{
					$captcha_id = $query->row()->captcha_id;
					$this->db->where('captcha_id', $captcha_id)->update($this->_captcha, array('status' => 1));
					return 1;
				}
			else
				    return 0;
		}

		
	private function checkExist($email = '')
		{
			return (int) $this->db->get_where($this->_account, array("email" => $email, 'status' => 1))->num_rows();
		}
		
	public function activate($random_key = '')
		{
			$query = $this->db->get_where($this->_account, array("random_key" => $random_key, 'status' => 0));
			if ($query->num_rows() > 0)
				{
					$result   =  $query->row();
					$email    =  $result->email;
					$password =  mt_rand();
					$enc_pwd  =  sha1($password);
					
					$this->db->where('random_key', $random_key)->update($this->_account, array('status' => 1, 'password' => $enc_pwd));
					
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
								<td style="text-align:center" height="40">afewtaps</td>
							 </tr>
							  <tr>
								<td style="text-align:left" height="40">Welcome to afewtaps.</td>
							 </tr>
							 
							 <tr>
								<td style="text-align:left" height="40">We are happy to have you on-board and look forward to serving you.</td>
							 </tr>
							 
							 <tr>
								<td style="text-align:left" height="40">Your Email ID is '.$email.' and your Password is '.$password.'. Hold onto this email

	as you might require it in future.</td>
							 </tr>
							 
							 <tr>
								<td style="text-align:left" height="40">You can change your Password and view your details by logging in to your account through our website <a href="http://afewtaps.com/" target="_blank">www.afewtaps.com.</a></td>
							 </tr>
							 
							 <tr>
								<td style="text-align:left" height="40">To get a better understanding, take a look at some <a href="http://afewtaps.com/index.php/welcome/faq" target="_blank">Frequently Asked Questions (FAQs)</a> available on our website. Should you require any more information, let us know.</td>
							 </tr>
							 
							 <tr>
								<td style="text-align:left" height="40">We hope you enjoy using afewtaps.</td>
							 </tr> 
							 
							 <tr>
								<td style="text-align:left">Convenience Matters.</td>
							 </tr>
							 
							  <tr>
								<td style="text-align:left"><a href="https://itunes.apple.com/us/app/afewtaps/id1183721598?ls=1&mt=8"><img width="140" src="'.base_url().'/images/appstore.png" alt="" /></a>&nbsp;&nbsp;&nbsp;<a href="https://play.google.com/store/apps/details?id=com.afewtaps.afewtaps&hl=en"><img src="'.base_url().'/images/googlestore.png" width="140" alt="" /></a></td>
							 </tr>
							 
							 <tr>
								<td style="text-align:left" height="20">Thanks,</td>
							 </tr>
							 
							 <tr>
								<td style="text-align:left" height="20">Team <strong>afewtaps.</strong></td>
							 </tr>
							 
							 <tr>
								<td style="text-align:center;background:#000;color:#fff" height="30">Copyright &copy; '.date('Y').' Think Different Technologies (P) Ltd.</strong></td>
							 </tr>
						 
						  </table>';
			
					$this->load->library('email');
					$this->email->from('no-reply@afewtaps.com', 'afewtaps');
					$this->email->to($email );
					$this->email->subject('Account Activation');
					$this->email->message($html);
					$this->email->set_mailtype("html");
					$this->email->send();
					
					$this->load->library('session');
					$this->session->set_flashdata('success', 'Your account has been successfully activated.');
							
				}
			else
				{
					$query = $this->db->get_where($this->_account, array("random_key" => $random_key, 'status' => 1));
					if ($query->num_rows() > 0)
						{
							$this->load->library('session');
							$this->session->set_flashdata('success', 'Your account is already activated.');
						}
				}
							redirect(base_url());
		}
	
}
