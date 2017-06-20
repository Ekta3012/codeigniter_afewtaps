<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    private $_userid;
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid  = (int) $this->session->userdata('id');
			 if ($this->_userid === 0)
			 redirect(base_url());
		}
		
	public function index($id = '')
		{			
			$this->form_validation->set_rules('category_name', 'Category Name',  'trim|required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
			
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info']        =   $this->categorymodel->getCategoryInfo($id, $this->_userid);
				
					$data['uid']         =   $this->_userid;

                    $this->load->view('category/category', $data);
                }
            else
                {
                    $this->categorymodel->addUpdateCategory($id, $this->_userid);
                }			
		}
		
	public function view()
		{
			$data['category'] = $this->categorymodel->allCategory($this->_userid);
			$this->load->view('category/viewcategory', $data);
		}
		
	public function del($id = '')
		{
			$this->categorymodel->deleteCategory($id, $this->_userid);
		}
}