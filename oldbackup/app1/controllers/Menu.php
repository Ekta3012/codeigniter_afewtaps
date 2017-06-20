<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct()
		{
				parent::__construct();
		}
		
	public function menuItems()
		{
			$this->menumodel->getMenuItems();
		}
		
    public function myOrders()
		{
			$this->menumodel->getMyOrders();
		}
		
		
}