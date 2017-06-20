<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

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
			//print_r($_POST);  die();
			
			$this->form_validation->set_rules('branch', 'Branch', 'required|integer');
			//$this->form_validation->set_rules('cuisine[]', 'Cuisine', 'required');
			$this->form_validation->set_rules('category', 'Category', 'trim|required');		
			$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');	
			$this->form_validation->set_rules('base_price', 'Price', 'trim|required');	
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['info']  = array();
            if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['info']     =   $this->menumodel->getMenuItems($id);
				
					$data['uid']      =   $this->_userid;
				    $data['cuisine']  =   $this->cuisinemodel->allCuisine($this->_userid);
					$data['category'] =   $this->categorymodel->getCategories($this->_userid);
				
                    $this->load->view('menu/menu', $data);
                }
            else
                {
                    $this->menumodel->addMenuItems($id, $this->_userid);
                }			
			
		}
		
	public function view($categoryid = 1)
		{
			$data['result'] = $this->menumodel->getMenuItems($this->_userid, $categoryid);
			$this->load->view('menu/viewmenu', $data);
		}
		
	public function edit($menuid = '')
		{
			$numRows = $this->menumodel->checkMenuItemUser($menuid, $this->_userid);
			if ($numRows > 0)
				{
					$this->form_validation->set_rules('branch', 'Branch', 'required|integer');
					$this->form_validation->set_rules('category', 'Category', 'trim|required');		
					$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');	
					$this->form_validation->set_rules('base_price', 'Price', 'trim|required');
					$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
					$data['info']  = array();
					if ($this->form_validation->run() == FALSE)
						{
								if ($menuid != '')
								$data['info']     =   $this->menumodel->getMenuItemsById($menuid, $this->_userid);
						
								$data['uid']      =   $this->_userid;
								$data['category'] =   $this->categorymodel->getCategories($this->_userid);
						
								$this->load->view('menu/editmenu', $data);
						}
					else
						{
								$this->menumodel->updateMenuItems($menuid, $this->_userid);
						}
				}
			else
				 echo "<h1>404, Page Not Found</h1>";
		}
		
}