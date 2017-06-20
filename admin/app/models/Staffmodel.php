<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffmodel extends CI_Model {

    private $_staff;
	
	private $_folder_root;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_staff   		  =     $this->db->dbprefix('staff_member');
			 
			 $this->_folder_root      =  	$_SERVER['DOCUMENT_ROOT'].'/fewtaps/uploads/';
		}
		
	public function allMembers($branch_id = '')
		{
			if ($branch_id != '')
			$this->db->where('branch_id', $branch_id);




		
			return $this->db->get($this->_staff)->result();
		}
		
	public function getMember($id = '')
		{
			return $this->db->get_where($this->_staff, array('id' => $id))->row();
		}
		
	public function addUpdateStaffMember($id = '', $segment = '')
		{
			$data['branch_id']    	   =  	$this->input->post('branch');
			$data['name']    	       =  	$this->input->post('name');
			$data['contact_no']        =  	$this->input->post('phone_no');
			$data['email_id']          =  	$this->input->post('email');
			$data['password']  	       =  	sha1($this->input->post('password'));
			$data['address']  	       =  	$this->input->post('address');
			$data['status']  		   =  	$this->input->post('status');
			
			$data['regtime']  		   =    time();
			
			$config['upload_path']     = 	$this->_folder_root;
			$config['allowed_types']   = 	'gif|jpg|png|bmp|jpeg';
			$config['remove_spaces']   = 	TRUE;
			$config['max_size']        = 	'300000';
			$config['overwrite']       = 	FALSE;
			$config['encrypt_name']    = 	TRUE;
			
			$this->upload->initialize($config);
			if ($this->upload->do_upload('userfile'))
				{
					$img_arr           =    $this->upload->data();
					$data['pic']       =    $img_arr['file_name'];
				}
	
			if ($id != FALSE)
				{
					$this->db->where('id', $id);
					$this->db->update($this->_staff, $data);
				}
			else
			    {
			        $this->db->insert($this->_staff, $data);
			    }
			        redirect('staff/view/'.$segment);
		}
	
	public function delMember($id = '', $segment = '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_staff);
			redirect('staff/view/'.$segment);
		}
		
}
