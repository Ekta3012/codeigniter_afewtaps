<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $_userid;
    public function __construct()
		{
             parent::__construct();
			 $this->_userid  = (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function thresholdView()
		{
			 $this->load->view('threshold/threshold');
		}
		
	public function updateThreshold()
		{
			 header('Content-Type: application/json');
			 $affected = $this->thresholdmodel->updateThreshold();
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
		
}