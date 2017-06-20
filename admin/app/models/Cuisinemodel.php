<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuisinemodel extends CI_Model {

    private $_category;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_cuisine   		  =     $this->db->dbprefix('cuisine');
		}
		
	public function allCuisine($userid = '')
		{	
			return $this->db->get_where($this->_cuisine, array('status' => '1'))->result();
		}
		
	public function getCuisineInfo($id = '', $userid = '')
		{
			$this->db->where(array('id' => $id, 'user_id' => $userid));
			$result =  $this->db->get($this->_cuisine);
			if ($result->num_rows() > 0)
				{
					return $result->row();
				}
		    else
				{
					die('<h1>404, Page Not Found !</h1>');
				}	
		}
		
	public function addUpdateCuisine($id = '', $userid = '')
		{
			$data['cuisine']           =  	$this->input->post('name');
			$data['status']            =  	$this->input->post('status');
			if ($id != FALSE)
				{
					$data['utime']     =    time();
					$this->db->where(array('id' => $id, 'user_id' => $userid));
					$this->db->update($this->_cuisine, $data);
				}
			else
			    {
					$data['user_id']   =  	$userid;
					$data['atime']     =    time();
			        $this->db->insert($this->_cuisine, $data);
			    }
				
				    $return_url        =    $this->input->get('return_url');
					
					if ($return_url != '')
						{
							$this->session->set_flashdata('add_cuisine', 'add');
							redirect($return_url);
						}
					else
							redirect('cuisine/view/');
		}
	
	public function deleteCuisine($id = '', $userid = '')
		{
			$this->db->where(array('id' => $id, 'user_id' => $userid));
			$this->db->delete($this->_cuisine);
			redirect('cuisine/view/');
		}
		
}
