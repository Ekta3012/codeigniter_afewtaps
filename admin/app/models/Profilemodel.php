<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profilemodel extends CI_Model {

    private $_account;
	private $_newadmin;
	private $_privacy;
	private $_merchant_guidelines;
	private $_faq;
	
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_account	 =	$this->db->dbprefix('account');
			 $this->_newadmin	 =	$this->db->dbprefix('newadmin');
			 $this->_privacy	 =	$this->db->dbprefix('privacy');
			 $this->_merchant_guidelines	 =	$this->db->dbprefix('merchant_guidelines');
			  $this->_faq	     =	$this->db->dbprefix('faq');
		}

		
		public function updateEmail($userid = '')
			{
				if ($this->input->post('name'))
				$data['name']    =      $this->input->post('name');
			
			
				$data['email']   =      $this->input->post('email');
				
				$pwd             =      $this->input->post('pwd');
				
				if ($pwd != '')
					{
						$data['password']    =    sha1($pwd);
					}
				
				
				$this->db->where('id', $userid);
				$this->db->update($this->_newadmin, $data);
				$this->session->set_flashdata('updtemail', 'updtemail');
				redirect('profile/myprofile');
			}
		
		public function getPrivacydata()
		{	
			  $this->db->select($this->_privacy.'.title, '.$this->_privacy.'.description, '.$this->_privacy.'.id');
			
			  $this->db->from($this->_privacy);
			  //$this->db->join($this->_accounts, "$this->_accounts.id = $this->_estab_rating.userid");
			 $this->db->where($this->_privacy.'.status', '1');
			  
			 return  $this->db->get()->result();
		}
		
		/*Start Privacy submodule code only for editing*/
		public function checkPrivacy($id = '')
		{
			return  $this->db->get_where($this->_privacy, array('id' => $id))->num_rows();
		}
		public function getPrivacyById($id = '')
		{
			$user_menu_exist  =  $this->db->get_where($this->_privacy, array('id' => $id))->num_rows();
			if ($user_menu_exist > 0)
				{
			  $this->db->select('title,id,description');
		    $data['userdata']    =  $this->db->get_where($this->_privacy, array('id' => $id))->row();
		
			  }
			  return $data;
		}
		public function updatePrivacy($id = '')
		{

			$title         		=  	$this->input->post('title');
		    $description        =  $this->input->post('description');
		
			$mdata['title']                   =    $title;		
			$mdata['description']                   =    $description;	
			$mdata['status']                   =    '1';	
			
			$this->db->where('id', $id);
			$this->db->update($this->_privacy, $mdata);
			$this->session->set_flashdata('Privacy_edit', 'Privacy_edit');
			redirect('profile/privacy');
			
		}
		/*End Rating submodule code only for editing*/
		
		public function deletePrivacy($id= '')
		{
			
			$data['title']  =  "";
			$data['description']  =  "";
			$data['status']  =  "0";
			$num_rows  		=   (int) $this->db->get_where($this->_privacy, array('id' => $id))->num_rows();
			if ($num_rows > 0)
				{
					$this->db->where('id', $id);
					$this->db->update($this->_privacy, $data);
					redirect('profile/privacy');
				}
				else
				{
				
				redirect('profile/privacy');
				}
			/*	
			
			$this->db->where('id', $id);
			$this->db->delete($this->_accounts);
			redirect('establishment/front');*/
			
			
		}
		
		public function getMerchantguidelinesdata()
		{	
			  $this->db->select($this->_merchant_guidelines.'.title, '.$this->_merchant_guidelines.'.description, '.$this->_merchant_guidelines.'.id');
			
			  $this->db->from($this->_merchant_guidelines);
			  //$this->db->join($this->_accounts, "$this->_accounts.id = $this->_estab_rating.userid");
			 $this->db->where($this->_merchant_guidelines.'.status', '1');
			  
			 return  $this->db->get()->result();
		}
		public function addMerchantguidelinesdata()
		{	
			$data['title']  =   $this->input->post('title');
			$data['description']  =   $this->input->post('description');
			
			$this->db->insert($this->_merchant_guidelines, $data);
			//$this->session->set_flashdata('front_user_edit', 'front_user_edit');
			redirect('profile/guidelines');
			
			
		
			
			
		}
		
			public function deleteGuidelines($id= '')
		{
			
			
			$this->db->where('id', $id);
			$this->db->delete($this->_merchant_guidelines);
			redirect('profile/guidelines');
			
			
		}
		public function checkMerchantguidelines($id = '')
		{
			return  $this->db->get_where($this->_merchant_guidelines, array('id' => $id))->num_rows();
		}
		
		public function getMerchantguidelines($id = '')
		{
			$user_menu_exist  =  $this->db->get_where($this->_merchant_guidelines, array('id' => $id))->num_rows();
			if ($user_menu_exist > 0)
				{
			  $this->db->select('title,id,description');
		    $data['guidelines']    =  $this->db->get_where($this->_merchant_guidelines, array('id' => $id))->row();
		
			  }
			  return $data;
		}
		public function updateMerchantguidelines($id = '')
		{

			$title         		=  	$this->input->post('title');
			//$locality      		=  	$this->input->post('locality');
			$description          		=  $this->input->post('description');
			
		   
			$mdata['title']               =    $title;		
			$mdata['description']                   =    $description;	
			
			//echo $customization_type;
			//die();
			$this->db->where('id', $id);
			$this->db->update($this->_merchant_guidelines, $mdata);
				$this->session->set_flashdata('mer_guideline', 'mer_guideline');
			redirect('profile/guidelines');
			
		}
		
		public function getFaqInfo($id = '')
		{
			return $this->db->get_where($this->_faq, array('id' => $id))->row();
		}
		
	public function addUpdateFaq($id = '')
		{
			
			$data['que']    	=  	$this->input->post('que');
			$data['ans']    	=  	$this->input->post('ans');
			$data['apply_for']   	=  	implode (',', $this->input->post('apply_for'));
			$data['status']  	    =  	"1";
	
			if ($id != FALSE)
				{
					$this->db->where('id', $id);
					$this->db->update($this->_faq, $data);
				}
			else
			    {
			        $this->db->insert($this->_faq, $data);
			    }
				
				    $segment = $this->uri->segment(4);
				    if ($segment == 1)
			        redirect('profile/faq');
				    else if ($segment == 2)
			        redirect('profile/faq/2');
					else
					redirect('profile/faq/3');
						
		}
		
		public function getAllFaqData()
		{	
			  $this->db->select($this->_faq.'.que, '.$this->_faq.'.ans, '.$this->_faq.'.id, '.$this->_faq.'.apply_for');
			
			  $this->db->from($this->_faq);
			  //$this->db->join($this->_accounts, "$this->_accounts.id = $this->_estab_rating.userid");
			 $this->db->where($this->_faq.'.status', '1');
			  
			$result 			=  $this->db->get()->result();
			$data['info'] 	= 	$result;
				
				$data['faq']    	= 	array();
				$data['estab']    	= 	array();
				$data['user']    	= 	array();
				$data['service']    	= 	array();
				if (count($result) > 0)
					{
						// $cate_arr   =   array (1 => '1', 2 => '2', 3 => '3');
						foreach ($result as $resul)
							{
							//$tax_apply_arr =  explode (',', $resul->{'apply_for'});
							
							//print_r($tax_apply_arr);
								
							
							if($resul->{'apply_for'}==1)
							{
								
								 $this->db->select($this->_faq.'.que, '.$this->_faq.'.ans, '.$this->_faq.'.id');
			                     $data['estab'][$resul->{'apply_for'}] = $this->db->get_where($this->_faq, array('apply_for' =>$resul->{'apply_for'}))->result                                ();
			                 }
													
											
							else if($resul->{'apply_for'}==2)
							{
								
								
								 $this->db->select($this->_faq.'.que, '.$this->_faq.'.ans, '.$this->_faq.'.id');
			                     $data['user'][$resul->{'apply_for'}] = $this->db->get_where($this->_faq, array('apply_for' =>$resul->{'apply_for'}))->result                                ();
			                 }
								else if($resul->{'apply_for'}==3)
							{
								
								
								 $this->db->select($this->_faq.'.que, '.$this->_faq.'.ans, '.$this->_faq.'.id');
			                     $data['service'][$resul->{'apply_for'}] = $this->db->get_where($this->_faq, array('apply_for' =>$resul->{'apply_for'}))->result                                ();
			                 }				
												
										
							}
							
					}
					//print_r($data['user']); die();	
					return $data;
		}
		
		public function deleteFaq($id= '')
		{
			
			
			$this->db->where('id', $id);
			$this->db->delete($this->_faq);
			redirect('profile/faq');
			
			
		}
		
}
