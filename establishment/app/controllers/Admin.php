<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $_userid;
	private $_privacy;
	private $_faq;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_privacy  = $this->db->dbprefix('privacy');
			 $this->_faq      = $this->db->dbprefix('faq');
			 
			 $this->_userid   = (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function thresholdView()
		{
			 $data['val'] = $this->thresholdmodel->getThresholdValue($this->_userid);
			 $this->load->view('threshold/threshold', $data);
		}
		
	public function updateThreshold()
		{
			 header('Content-Type: application/json');
			 $affected = $this->thresholdmodel->updateThreshold($this->_userid);
			 echo json_encode(array('status' => $affected));
		}
		
	public function location()
		{
			  $data['locations'] = $this->estabmodel->estabLocationData($this->_userid);
			  
			  $audi_id           = $this->input->get('audi'); 
			  if ( !empty($audi_id))
		      $data['cinema_data'] = $this->estabmodel->getRowsSeatByAudiId($audi_id);
		  
		      $rest_id           = $this->input->get('rest'); 
			  if ( !empty($rest_id))
		      $data['rest_data'] = $this->estabmodel->getSeatByRestId($rest_id);
			  
			  $this->load->view('location/location', $data);
		}
		
	public function miscellaneous()
		{
			  $this->load->view('miscellaneous/page');
		}
		
	public function terms()
		{
			  $this->load->view('miscellaneous/terms');
		}	
	
	public function policy()
		{
			  $data['policy'] = $this->db->get_where($this->_privacy, array('id' => 1))->row();
			  $this->load->view('miscellaneous/policy', $data);
		}
		
	public function faq($id = 1)
		{
			  $data['faq'] = $this->db->get_where($this->_faq, array('apply_for' => $id))->result();
			  $this->load->view('miscellaneous/faq', $data);
		}	
		
}