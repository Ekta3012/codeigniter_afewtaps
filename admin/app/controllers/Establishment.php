<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment extends CI_Controller {

    private $_userid;
	
    public function __construct()
		{
             parent::__construct();
			 
			 $this->_userid   =  (int) $this->session->userdata('adminid');
			 if ($this->_userid === 0)
			 redirect(base_url());

		}
		
	public function index()
		{
			$this->load->model('estabmodel');
			$this->form_validation->set_rules('res_name','Establishment Name','trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
            if ($this->form_validation->run() == FALSE)
                {
                     $data['order']        =  $this->estabmodel->estabFlag();
					 
					 $data['orders_box']   =  $this->estabmodel->getOrderHistoryDetails();
					 
				     $this->load->view('establishment/index', $data);
                }
            else
				{
					 $data['order']        =  $this->estabmodel->estabFlag();
					 
					 $data['orders_box']   =  $this->estabmodel->getOrderHistoryDetails();
					 
					 $this->load->view('establishment/index', $data);
				}
		}
		
	public function view($order_id='')
		{
			$this->load->model('estabmodel');
			$data['orderhistory'] = $this->estabmodel->orderhistorydetails($order_id);
			$this->load->view('establishment/view',$data);
		}
		
	public function registerd()
		{
			$data['establishment'] = $this->estabmodel->allEstab();
			$this->load->view('establishment/registerd', $data);
		}
		
	public function service()
		{
			$this->load->model('estabmodel');
			
			$this->form_validation->set_rules('establish', 'Establishment Name', 'required');
		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE)
                {
					$data['service'] = $this->estabmodel->getservicefilter();
					$this->load->view('establishment/service', $data);
                }
            else
                {
					$data['service'] = $this->estabmodel->getservicefilter();
					$this->load->view('establishment/service', $data);
                }
	
			
		}
		
		
	public function front()
		{
			$this->load->model('estabmodel');
			$data['front']    = $this->estabmodel->allFrontEndUser();
			$data['location'] = $this->estabmodel->allLocation();
			$this->load->view('establishment/front', $data);
		}
		
	public function frontDataUser()
			{
				$data = (array) $this->estabmodel->filterDataUserMdodule();
				echo json_encode(array('result' => $data));
			}
	
	public function del($id= '')
		{	
			//$this->load->model('estabmodel');
			$this->estabmodel->deleteEstab($id);
			//$this->front();
			//redirect('establishment/front');
		}
	
	public function delete($id = '', $eid = '')
		{

			//$this->load->model('estabmodel');
			$this->estabmodel->deleteServiceApp($id, $eid);
			//$this->front();
			//redirect('establishment/front');
		}
	
	public function delestab($id= '')
		{
			$this->estabmodel->deleteEstabRegistrd($id);
			
		}
			/*newadmin code start*/
	public function newadmin($id= '')
		{
			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
			/**/
			if ($this->form_validation->run() == FALSE)
                {
					if ($id != '')
					$data['admindetails'] = $this->estabmodel->getAdminInfo($id);
				
                    $this->load->view('establishment/newadmin',$data);
                }
            else
                {
                    $this->estabmodel->addUpdateadmin($id);
					$this->load->view('establishment/viewadmin',$data);
                }
				/**/
	
            		
		}
		
	public function viewadmin()
		{
			$this->load->model('estabmodel');
			$data['admindetails'] = $this->estabmodel->admindetails();
			$this->load->view('establishment/viewadmin',$data);
		}
		
	public function deladmin($id= '')
		{
			$this->estabmodel->deleteAdmin($id);
			
		}
		
		/*newadmin code end*/
		
	public function fuseredit($id = '')
		{
			$this->load->model('estabmodel');
			$numRows = $this->estabmodel->checkFrontEndUser($id);
			if ($numRows > 0)
				{
					$this->form_validation->set_rules('name', 'Name', 'required|trim');
					$this->form_validation->set_rules('email', 'Email', 'trim|required');	
					$this->form_validation->set_rules('contactno', 'Contact No', 'trim|required');
					$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
					$data['info']  = array();
					if ($this->form_validation->run() == FALSE)
						{
								if ($id != '')
								$data['info']     =   $this->estabmodel->getFrontEndUserById($id);
						
						
								$this->load->view('establishment/fuseredit', $data);
						}
					else
						{
								$this->estabmodel->updateFrontEndUser($id);
						}
				}
			else
				 echo "<h1>404, Page Not Found</h1>";
		}
	
	public function suseredit($id = '', $eid = '')
		{
			$this->load->model('estabmodel');
            //$this->load->model('categorymodel');
			//$userid = $this->estabmodel->checkServiceEndUser1($id);
			//if ($userid > 0)
				//{
					$this->form_validation->set_rules('name', 'Name', 'required|trim');
					$this->form_validation->set_rules('email_id', 'Email', 'trim|required');	
					$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
					$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
					$data['info']  = array();
					if ($this->form_validation->run() == FALSE)
						{
								if ($id != '')
								$data['info']     =   $this->estabmodel->getServiceEndUserById1($id);
								$this->load->view('establishment/suseredit', $data);
						}
					else
						{
								$this->estabmodel->updateServiceEndUser($id, $eid);
						}
				//}
			//else
				 //echo "<h1>404, Page Not Found</h1>";
		}
	
	public function estabedit($id = '')
		{
			$this->load->model('estabmodel');
            //$this->load->model('categorymodel');
			$numRows = $this->estabmodel->checkEstabRegUser($id);
			if ($numRows > 0)
				{
					$this->form_validation->set_rules('name', 'Name', 'required|trim');
				
					$this->form_validation->set_rules('email_id', 'Email', 'trim|required');	
					
					$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
					$data['info']  = array();
					if ($this->form_validation->run() == FALSE)
						{
								if ($id != '')
								$data['info']     =   $this->estabmodel->getEstabRegUserById($id);
						
								$this->load->view('establishment/estabedit', $data);
						}
					else
						{
								$this->estabmodel->updateEstabRegUser($id);
						}
				}
			else
			
			echo "<h1>404, Page Not Found</h1>";
		}
		
		
	public function notification()
		{
			header('Content-Type: application/json');
			$result  =  $this->estabmodel->getAllNotifications();
			echo json_encode(array("result" => $result), JSON_PRETTY_PRINT);
		}
		
 
}