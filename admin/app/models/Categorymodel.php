<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorymodel extends CI_Model {

    private $_category;
    private $_merchant_estab;
	
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_category         =     $this->db->dbprefix('category');
			 $this->_merchant_estab   =     $this->db->dbprefix('merchant_estab');
			 
		}
		
	public function getCategories($userid = '')
		{
			$this->db->select('id, category_name');
			return  $this->db->get_where($this->_category, array('status' => '1'))->result();
		}
		
		
	public function getCat()
		{
			$estabid = $this->uri->segment(3);
			
			$user_id  = $this->db->select('userid')->get_where($this->_merchant_estab, array('estabid' => $estabid))->row()->userid;
			
			$this->db->select('id, category_name');
			return  $this->db->get_where($this->_category, array('status' => '1', 'user_id' => $user_id))->result();
		}
		
		
	
	public function allCategory($userid = '')
		{		
			$this->db->where('user_id', $userid);
			return $this->db->get($this->_category)->result();
		}
		
	public function getCategoryInfo($id = '', $userid = '')
		{
			$this->db->where(array('id' => $id, 'user_id' => $userid));
			$result =  $this->db->get($this->_category);
			if ($result->num_rows() > 0)
				{
					return $result->row();
				}
		    else
				{
					die('<h1>404, Page Not Found !</h1>');
				}
		}
		
		
	public function addUpdateCategory($id = '', $userid = '')
		{
			$data['category_name']     =  	$this->input->post('category_name');
			$data['status']            =  	$this->input->post('status');
			if ($id != FALSE)
				{
					$data['utime']     =    time();
					$this->db->where(array('id' => $id, 'user_id' => $userid));
					$this->db->update($this->_category, $data);
				}
			else
			    {
					$data['user_id']   =  	$userid;
					$data['atime']     =    time();
			        $this->db->insert($this->_category, $data);
			    }
			        redirect('category/view/');
		}
	
	public function deleteCategory($id = '', $userid = '')
		{
			$this->db->where(array('id' => $id, 'user_id' => $userid));
			$this->db->delete($this->_category);
			redirect('category/view/');
		}
		
}
