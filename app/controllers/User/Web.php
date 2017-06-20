<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	
	public function __construct()
		{
				parent::__construct();
		}
		
	public function getPaymentAndLocations($branchid = '')
		{
				header('Content-Type: application/json');
				$info =  $this->sitemodel->getPaymentAndLocationsData($branchid);
				echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function getMenuItemTax($category_id = '')
		{
				header('Content-Type: application/json');
				$info =  $this->sitemodel->getMenuItemTaxes($category_id);
				echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	public function applyCouponCode()
		{
				header('Content-Type: application/json');
				$info =  $this->menumodel->applyCouponCodeModule();
				echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		

		
	public function estabLocation()
		{
			    header('Content-Type: application/json');
				$info = (array) $this->menumodel->estabLocationModule();
				echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
		
	public function locationChange()
		{
			    header('Content-Type: application/json');
				$info = (array) $this->menumodel->locationChangeModule();
				echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
	 /* public function orderPlace()
			{
					header('Content-Type: application/json');
					$info = (array) $this->menumodel->orderPlaceModule();
					echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
			}	
	 */
	 
	 
	 public function orderPlace()
		{
			    header('Content-Type: application/json');
				$info = (array) $this->menumodel->orderPlacedModule();
				echo json_encode(array('result' => $info), JSON_PRETTY_PRINT);
		}
		
		

}
