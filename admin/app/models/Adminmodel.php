<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminmodel extends CI_Model {

    private $_threshold;
	
    public function __construct()
		{
             parent::__construct();
			 $this->_threshold   =   $this->db->dbprefix('threshold');
		}
		
	public function updateThreshold()
		{ 
			$data['value']  =   $this->input->post('value');
			$eid       		=   1;//$this->input->post('eid');
			$num_rows  		=   (int) $this->db->get_where($this->_threshold, array('eid' => $eid))->num_rows();
			
			if ($num_rows > 0)
				{
					$this->db->where('eid', $eid);
					$this->db->update($this->_threshold, $data);
				}
			else
				{
					$data['eid']   =   $eid;
					$this->db->insert($this->_threshold, $data);
				}
				    return $this->db->affected_rows();
		}
		
}
