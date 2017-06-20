<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    private $_user_id;
	
    public function __construct()
		{
             parent::__construct();
			 $this->_user_id  = (int) $this->session->userdata('id');
			 
			 if ($this->_user_id === 0)
			 redirect(base_url());
		}
		
	public function index()
		{
			$data['tax'] = [] ; //$this->taxmodel->all();
			$this->load->view('order/order', $data);
		}
		
	public function view()
		{
			$establid         		  =  getEstablishmentIdByUserId($this->_user_id);
			$data['estabid']   		  =  $establid;
			
			$this->load->model('homemodel');
			$data['cancelled_orders'] =  $this->homemodel->getCancelledOrders($establid);

			$this->load->view('order/vieworder', $data);
		}
		
	public function history()
		{	
		    $establid         		    =  getEstablishmentIdByUserId($this->_user_id);
			
			$result['cancel_list']      =  $this->ordermodel->getOrders($establid);
			
			$result['orders_box']       =  $this->ordermodel->getOrderHistoryDetails($establid);
			$result['active_tab']  = 'orders';
			$result['active_li']  = 'all_orders';
                        $result['tabel_heading']  = 'All Order History';
//                        echo '<pre>';
//                        print_r($result);
//                        echo '</pre>';
//                        die();
			$this->load->view('order/history', compact('result'));
		}
                public function staff_order_history()
		{	
		    $establid         		    =  getEstablishmentIdByUserId($this->_user_id);
			
			$result['cancel_list']      =  $this->ordermodel->getOrders($establid);
			
			$result['orders_box']       =  $this->ordermodel->getOrderHistoryDetails_staff($establid);
			$result['active_tab']  = 'orders';
			$result['active_li']  = 'staff_order_history';
                        $result['tabel_heading']  = 'Staff Order History';
//                        echo '<pre>';
//                        print_r($result);
//                        echo '</pre>';
//                        die();
			$this->load->view('order/history', compact('result'));
		}
	public function customer_order_history()
		{	
		    $establid         		    =  getEstablishmentIdByUserId($this->_user_id);
			
			$result['cancel_list']      =  $this->ordermodel->getOrders($establid);
			
			$result['orders_box']       =  $this->ordermodel->getOrderHistoryDetails_customer($establid);
			$result['active_tab']  = 'orders';
			$result['active_li']  = 'customer_order_history';
			$result['tabel_heading']  = 'Customer Order History';
//                        echo '<pre>';
//                        print_r($result);
//                        echo '</pre>';
//                        die();
			$this->load->view('order/history', compact('result'));
		}
	
		
	public function cancel($id = '')
		{
			$result  =  $this->ordermodel->getCancelSummary($id);
			$this->load->view('order/cancelorder', compact('result'));
		}
		
		
	public function homePageOrder($establishment_id = '')
		{
			header('Content-Type: application/json');
			$result  =  $this->ordermodel->getAllOrders($establishment_id);
			$orders = $result['orders_info'];
			$staff  = $result['staff_info'];
			
			$new_order_count     =  $result['new_order_count'];
			$pending_order_count =  $result['pending_order_count'];
				
			echo json_encode(array("result" => $orders, 'staff' => $staff, 'new_order_count' => $new_order_count, 'pending_order_count' => $pending_order_count), JSON_PRETTY_PRINT);
		}
		
	public function notification($flag = '')
		{
			header('Content-Type: application/json');
			$result  =  $this->ordermodel->getAllNotifications($this->_user_id, $flag);
			echo json_encode(array("result" => $result), JSON_PRETTY_PRINT);
		}
		
	public function newOrderBadge()
		{
			header('Content-Type: application/json');
			$this->ordermodel->newOrderBadgeCount($this->_user_id);
			echo json_encode(array("result" => "success"), JSON_PRETTY_PRINT);
		}
		
	public function pendingBadge()
		{
			header('Content-Type: application/json');
			$this->ordermodel->pendingBadgeCount($this->_user_id);
			echo json_encode(array("result" => "success"), JSON_PRETTY_PRINT);
		}
		
		
	/* Home Page Order */
	
	
	public function homePageAllOrder($establishment_id = '')
		{
			$this->load->model('homemodel');
			header('Content-Type: application/json');
			$result  =  $this->homemodel->getHomeAllOrders($establishment_id);
			$orders = $result['orders_info'];
			$staff  = $result['staff_info'];

			
			$new_order_count     =  $result['new_order_count'];
			$pending_order_count =  $result['pending_order_count'];
				
			echo json_encode(array("result" => $orders, 'staff' => $staff, 'new_order_count' => $new_order_count, 'pending_order_count' => $pending_order_count), JSON_PRETTY_PRINT);
		}
		
		
	public function homePageNewOrder($establishment_id = '')
		{
			$this->load->model('homemodel');
			header('Content-Type: application/json');
			$result  =  $this->homemodel->getHomeNewOrders($establishment_id);
			$orders = $result['orders_info'];
			$staff  = $result['staff_info'];
			
			$new_order_count     =  $result['new_order_count'];
			$pending_order_count =  $result['pending_order_count'];
				
			echo json_encode(array("result" => $orders, 'staff' => $staff, 'new_order_count' => $new_order_count, 'pending_order_count' => $pending_order_count), JSON_PRETTY_PRINT);
		}
		
	public function homePagePendingOrder($establishment_id = '')
		{
			$this->load->model('homemodel');
			header('Content-Type: application/json');
			$result  =  $this->homemodel->getHomePendingOrders($establishment_id);
			$orders = $result['orders_info'];
			$staff  = $result['staff_info'];
			
			$new_order_count     =  $result['new_order_count'];
			$pending_order_count =  $result['pending_order_count'];
				
			echo json_encode(array("result" => $orders, 'staff' => $staff, 'new_order_count' => $new_order_count, 'pending_order_count' => $pending_order_count), JSON_PRETTY_PRINT);
		}
		
		
		
}