<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyProfilemodel extends CI_Model {

    private $_newadmin;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_newadmin	 =	$this->db->dbprefix('newadmin');
		}
		
	public function getEmail($userid = '')
		{
			 $this->db->select($this->_newadmin.'.id, '.$this->_newadmin.'.email');
			  $this->db->where($this->_newadmin.'.userid', $userid);
			  $this->db->from($this->_newadmin);
			  return $this->db->get()->result();
			
		}
}
