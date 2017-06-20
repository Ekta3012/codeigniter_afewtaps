<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends CI_Controller {

	private $_estab_rating;
	
    public function __construct()
		{
             parent::__construct();
			 
			 
			 $this->_estab_rating   =   $this->db->dbprefix('estab_rating');
			 
			 
			 $this->_userid   =  (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function index()
		{			
		     $data['ratings'] = $this->analyticmodel->viewRatingsModule($this->_userid);
		     $this->load->view('analytics/viewratings', $data);
		}
		
		
	public function review($id = '')
		{
			$this->form_validation->set_rules('reply', 'Reply',  'trim|required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
			
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
						{
						    $rdata                 =   $this->analyticmodel->getReply($id);
						    $data['review']        =   $rdata->review;
						    $data['reply']         =   $rdata->reply;
						}
							$this->load->view('analytics/reply_rating', $data);
                }
            else
                {
                            $this->analyticmodel->addUpdateReply($id);
                }			
		}
		
		
	public function del($id = '')
		{
			$this->db->where('id', $id);
			$this->db->delete($this->_estab_rating);
			redirect('rating/index');
		}
	
}