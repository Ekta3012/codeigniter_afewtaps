<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishmentdata extends CI_Controller {
   private $_userid;
   
    public function __construct()
		{
             parent::__construct();
		     $this->_userid   =  (int) $this->session->userdata('adminid');
			 if ($this->_userid === 0)
			 redirect(base_url());
		 
			 //error_reporting(-1);
		}
		
	public function order()
		{
			$this->load->model('estabdatamodel');
			$this->form_validation->set_rules('start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('end_date', 'End Date', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data['order_box'] = $this->estabdatamodel->orderPopUpData();
			
			if ($this->form_validation->run() == FALSE)
				{
					$data['order']     = $this->estabdatamodel->orderhistory();
					$this->load->view('establishmentdata/order',$data);
				}
			else
				{
					//$data['order'] = $this->estabdatamodel->filter();
					$data['order'] = $this->estabdatamodel->orderhistory();
					$this->load->view('establishmentdata/order',$data);
				}
		}
		
	public function inside()
		{
			$this->load->model('estabdatamodel');
			$data['result'] = $this->estabdatamodel->getServiceRatingTable();
			$this->load->view('establishmentdata/inside', $data);
		}
		
		
	public function menu($estabid = '', $category = 1)
		{
			$this->load->model('estabdatamodel');
			$userid         = $this->uri->segment('3');
	     	$data['result'] = $this->estabdatamodel->getMenuItems($estabid, $category);
			$this->load->view('establishmentdata/viewestab', $data);
			/**/
			
			/*$this->form_validation->set_rules('res_name','Res Name','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			
            if ($this->form_validation->run() == FALSE)
                {
					
                    $data['result'] = $this->estabdatamodel->filterMenus($categoryid);
					$this->load->view('establishmentdata/viewestab', $data);
					
					
                }
				
            else
			{
				$data['result'] = $this->estabdatamodel->getMenuItems($categoryid);
					$this->load->view('establishmentdata/viewestab', $data);
               
			}*/
			
			
		}
		
		
		public function location()
			{
			    
				$this->form_validation->set_rules('estabid','Establishment','required');
			    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				$this->load->model('estabdatamodel');
				$data['audis'] = $this->estabdatamodel->getAudis();
			
				if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('establishmentdata/addlocation', $data);
					}
				else
					{
						
						$data['result'] = $this->estabdatamodel->addLocationModule();
						$this->load->view('establishmentdata/addlocation', $data);
					}
			}
			
			
			
		public function viewLocation()
			{
				$this->load->model('estabdatamodel');
				$response  =  $this->estabdatamodel->viewLocationModule(); 

				$this->load->view('establishmentdata/viewlocation', compact('response'));
			}	
			
			
		public function delAudi($rid = '', $id = '')
			{
				$this->load->model('estabdatamodel');
				$this->estabdatamodel->delAudiModule($id); 
				redirect('establishmentdata/viewLocation/'.$rid);
			}
			
		public function delRest($rid = '', $id = '')
			{
				$this->load->model('estabdatamodel');
				$this->estabdatamodel->delRestModule($id); 
				redirect('establishmentdata/viewLocation/'.$rid);
			}	

		public function editFlr($estabid = '', $id = '')
			{ 
				$this->form_validation->set_rules('rest','Floor','required');
			    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
				$this->load->model('estabdatamodel');
				if ($this->form_validation->run() == FALSE)
					{
						$data = $this->estabdatamodel->getFlrInfo($id);
						$this->load->view('establishmentdata/edit_flr', compact('data'));
					}
				else
					{
						 $this->estabdatamodel->updateFlrInfo($id);
						 redirect('establishmentdata/viewlocation/'.$estabid);
					}
			} 			
			
			
		public function editAudi($id = '')
			{ 
				$this->form_validation->set_rules('estabid','Establishment','required');
			    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
				$this->load->model('estabdatamodel');
				if ($this->form_validation->run() == FALSE)
					{
						$data = $this->estabdatamodel->getEstabLocInfo($id);
						$this->load->view('establishmentdata/update_location', compact('data'));
					}
				else
					{
						 $this->estabdatamodel->updateLocationModule($id);
					}
			} 			

		public function averagetime()
		{
			$this->load->model('estabdatamodel');
			
			$data['response']   =  $this->estabdatamodel->averageCompletionTime();
			
			$data['resp']       =  $this->estabdatamodel->LastTwomonthCompletionTime();
			
			
			/*$data['business_generated']   =  json_encode($response['prev']);
			
			$data['prev_business']        =  $response['month']['prev']['price'];
			$data['prev_month']           =  $response['month']['prev']['month_name'];
			
			$data['current_business']     =  $response['month']['current']['price'];
			$data['current_month']        =  $response['month']['current']['month_name'];*/
			
			$this->load->view('establishmentdata/averagetime', $data);
			
		}
		
		
		public function favfood()
		{
			/*$this->load->model('estabdatamodel');
			
			$data['result'] = $this->estabdatamodel->FavFood();
			$this->load->view('establishmentdata/favfood', $data);*/
			/**/
			
			$this->load->model('estabdatamodel');
			$this->form_validation->set_rules('start_date1', 'Start Date', 'required');
			$this->form_validation->set_rules('end_date1', 'End Date', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
					$data['result']  = $this->estabdatamodel->FavFood();
					$this->load->view('establishmentdata/favfood', $data);
                }
            else
                {
                    $data['result']   = $this->estabdatamodel->FavFood();
					$this->load->view('establishmentdata/favfood', $data);
                }
			
		}
		
		public function merchant()
		{
			$this->load->model('estabdatamodel');
			
			/*$data['merchnt'] = $this->estabdatamodel->getMerchantInfo();
			$this->load->view('establishmentdata/merchant', $data);
			*/
			/**/
		
			$this->form_validation->set_rules('com_col_strt_dt', 'Commission Collection Start Date', 'required');
			$this->form_validation->set_rules('com_slab', 'Commission Slab', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			
            if ($this->form_validation->run() == FALSE)
                {
					
                  $data['merchnt'] = $this->estabdatamodel->getMerchantInfo();
				$this->load->view('establishmentdata/merchant', $data);
					
					
                }
				
            else
				{
						$data['merchnt'] = $this->estabdatamodel->UpdateMerchantSlab();
						$this->load->view('establishmentdata/merchant', $data);
				}
			
		}
		
		
		
		public function edit($menuid = '')
		{
			$this->load->model('estabdatamodel');
            $this->load->model('categorymodel');
			$numRows = $this->estabdatamodel->checkMenuItemUser($menuid);
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
								$data['info']     =   $this->estabdatamodel->getMenuItemsById($menuid);
						
								//$data['uid']      =   $this->_userid;
								$data['category'] =   $this->categorymodel->getCategories();
						
								$this->load->view('establishmentdata/editmenu', $data);
						}
					else
						{
								$this->estabdatamodel->updateMenuItems($menuid);
						}
				}
			else
				 echo "<h1>404, Page Not Found</h1>";
		}
		
		public function addmenu($id = '')
			{
				$this->form_validation->set_rules('branch', 'Branch', 'required|integer');
				//$this->form_validation->set_rules('cuisine[]', 'Cuisine', 'required');
				$this->form_validation->set_rules('category', 'Category', 'trim|required');		
				$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');	
				$this->form_validation->set_rules('base_price', 'Price', 'trim|required');	
				
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				$data['info']  = array();
				if ($this->form_validation->run() == FALSE)
					{
						//if ($id != '')
						//$data['info']     =   $this->estabdatamodel->getMenuItems($id);
					
						$data['uid']      =   $this->_userid;
						//$data['cuisine']  =   $this->cuisinemodel->allCuisine($this->_userid);
						
						$this->load->model('categorymodel');
						$data['category'] =   $this->categorymodel->getCat();
					
						$this->load->view('establishmentdata/addmenu', $data);
					}
				else
					{
						$this->load->model('estabdatamodel');
						$this->estabdatamodel->addMenuItems($id, $this->_userid);
					}			
				
			}
		
		public function analytics()
		{
			$this->load->model('estabdatamodel');
			
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			$data['order_box']            =  $this->estabdatamodel->orderPopUpData();
			
			$response                     =  $this->estabdatamodel->listofallorder();
			
			$data['business_generated']   =  json_encode($response['prev']);
			$data['orders_completed']     =  json_encode($response['completed_order']);
			$data['average_order_time']   =  json_encode($response['averageordertime']);
			
			$data['prev_business']        =  $response['month']['prev']['price'];
			$data['prev_month']           =  $response['month']['prev']['month_name'];
			
			$data['current_business']     =  $response['month']['current']['price'];
			$data['current_month']        =  $response['month']['current']['month_name'];
			
			$data['order']                =  $response['allorder'];
			
			$data['todays_order']         =  $response['date']['current']['price'];
			
			
			$data['yes_order']            =  $response['yes_order'];
			
			$data['tod_order']            =  $response['today_order'];
			
			
			
			$data['las_avg']              =  $response['month']['prev']['avg'];
			$data['cur_avg']              =  $response['month']['current']['avg'];
			
			
			$this->load->view('establishmentdata/analytics',$data);
			
		}
		
		public function ratings()
		{
			$this->load->model('estabdatamodel');
			
			$data['rating'] = $this->estabdatamodel->listofrating();
			$this->load->view('establishmentdata/ratings', $data);
			
		}
		
		public function delete($id= '')
		{
			$this->load->model('estabdatamodel');
			$this->estabdatamodel->deleteEstabRating($id);
		
		}
		
		public function ratingedit($id = '')
		{
			$this->load->model('estabdatamodel');
            $numRows = $this->estabdatamodel->checkEstabRating($id);
			if ($numRows > 0)
				{
				    $this->form_validation->set_rules('review', 'Customer Review', 'trim|required');
					 $this->form_validation->set_rules('reply', 'Mgt. Reply', 'trim|required');	
					
					$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
					$data['info']  = array();
					if ($this->form_validation->run() == FALSE)
						{
								if ($id != '')
								$data['info']     =   $this->estabdatamodel->getEstabRatingById($id);
						
						
								$this->load->view('establishmentdata/ratingedit', $data);
						}
					else
						{
								$this->estabdatamodel->updateEstabRating($id);
						}
				}
			else
				 echo "<h1>404, Page Not Found</h1>";
		}
		
		/*Start Code for Delete Menu Menu Items*/
		public function del($id= '')
		{
			$this->load->model('estabdatamodel');
			$this->estabdatamodel->deleteMenuItem($id);
		
		}

       /*End Code for Delete Menu Menu Items*/
	   
	   	/*Start Code for New & Returning Customers*/
	   public function customer()
		{
			$this->load->model('estabdatamodel');
			
			$data['result'] = $this->estabdatamodel->getAllCustomers();
			$this->load->view('establishmentdata/customer', $data);
			
		}
		
		
		public function customerdetails($order_id='')
		{
			$this->load->model('estabdatamodel');
			$data['orderhistory'] = $this->estabdatamodel->CustomerOrderdetails($order_id);
			$this->load->view('establishmentdata/customerdetails',$data);
		}
		
		/*End Code for New & Returning Customers*/
		
		
		public function history($order_id='')
		{
			$this->load->model('estabdatamodel');
			$data['orderhistory'] = $this->estabdatamodel->orderhistorydetails($order_id);
			$this->load->view('establishmentdata/history',$data);
		}
		
		public function view($order_id='')
		{
			$this->load->model('estabdatamodel');
			$data['orderhistory'] = $this->estabdatamodel->orderdetailsforanalytics($order_id);
			$this->load->view('establishmentdata/view',$data);
		}
		
		/*End Code for Order Hitsory*/
		
}