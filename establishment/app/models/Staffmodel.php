<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffmodel extends CI_Model {

    private $_staff;
    private $_establishment;
	
	private $_folder_root;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_staff   		  =     $this->db->dbprefix('staff_member');
			 $this->_establishment    =     $this->db->dbprefix('establishment');
			 
			 $this->_folder_root      =  	$_SERVER['DOCUMENT_ROOT'].'/uploads/';
		}
		
	public function allMembers($userid = '')
		{
			$estabid  =   getEstablishmentIdByUserId($userid);
			return $this->db->get_where($this->_staff, array('branch_id' => $estabid))->result();
		}
		
	public function getMember($id = '')
		{
			return $this->db->get_where($this->_staff, array('id' => $id))->row();
		}
		
	public function addUpdateStaffMember($id = '', $userid = '')
		{
			$branch_id                 =    getEstablishmentIdByUserId($userid);
			$data['branch_id']    	   =  	$branch_id;
			$data['name']    	       =  	$this->input->post('name');
			$data['contact_no']        =  	$this->input->post('phone_no');
			
			$email                     =    $this->input->post('email');
			$data['email_id']          =  	$email;
			$data['password']  	       =  	sha1($this->input->post('password'));
			$data['address']  	       =  	$this->input->post('address');
			
			//$data['employee_id']  	   =  	generateEmpId(8);
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
					/* Generate Id */
					
					$estab_id = $this->db->select('estab_id')->where('id', $branch_id)->get($this->_establishment)->row()->estab_id;
					
					$count   = (int) $this->db->where('branch_id', $branch_id)->get($this->_staff)->num_rows();
					$tcount  =  $count + 1;
					
					$data['employee_id'] = $estab_id . '-' .  str_pad($tcount, 2, "0", STR_PAD_LEFT);
					
					$data['status'] = 0;
					
			        $this->db->insert($this->_staff, $data);
					
					$this->load->library('email');
					$this->email->from('no-reply@afewtaps.com', 'afewtaps');
					$this->email->to($email);
					$this->email->subject('AFewTaps - Account Created');
					$this->email->message("Your Account has beens successfully created.");
					$this->email->send();
					
					
			    }
				
			        redirect('staff/view');
					
		}
	
	public function delMember($id = '', $segment = '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_staff);
			redirect('staff/view/'.$segment);
		}
		
}
