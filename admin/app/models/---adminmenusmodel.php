<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminmenusmodel extends CI_Model {

    private $_newadmin;
	 private $_email;
	
	
    public function __construct()
		{
             parent::__construct();
			 $this->_newadmin   =   $this->db->dbprefix('newadmin');
			  $this->_email =  $this->session->userdata('adminemail');
		}
function menus() {
   $this->db->select($this->_newadmin.'.name');
  $this->db->from($this->_newadmin);
  //$this->db->where($this->newadmin.'.email','tech2@xlim.org');
   return $this->db->get()->result();

}
}
?>