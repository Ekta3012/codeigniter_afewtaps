<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct()
		{
				parent::__construct();
		}
		
	public function menuItems()
		{
			header('Content-Type: application/json');
			$info = $this->menumodel->getMenuItems();
			echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
    public function myOrders()
		{
			$this->menumodel->getMyOrders();
		}

}