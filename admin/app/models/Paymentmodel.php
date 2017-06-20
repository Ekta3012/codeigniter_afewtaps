<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmodel extends CI_Model {
   
	private $_order;
	private $_merchant_estab;
	private $_merchant_info;
	private $_establishment;
	
    public function __construct()
		{
              parent::__construct();
			
			  $this->_order       		=      $this->db->dbprefix('order');
			  $this->_merchant_estab    =	   $this->db->dbprefix('merchant_estab');
			  $this->_merchant_info     =	   $this->db->dbprefix('merchant_info');
			  $this->_establishment     =	   $this->db->dbprefix('establishment');
		}
		
	public function establishmentList()
		{
			return $this->db->select('id, name')->get($this->_establishment)->result();
		}

    public function all($estabid = '')
		{
			 $start_date = $this->input->get_post('start_date');
			 $end_date   = $this->input->get_post('end_date');
			
			 $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.establishment_id, '.$this->_merchant_estab.'.userid');
			 
			 if (!empty($estabid))
			 $this->db->where(array($this->_order.'.establishment_id' => $estabid));
			
			 if ( ! empty ($start_date) && ! empty ($end_date))
				{
					list ($smonth, $sdate, $syear) = explode ('/', $start_date);
					list ($emonth, $edate, $eyear) = explode ('/', $end_date);
					$date1  	= 	 mktime(0, 0, 0, $smonth, $sdate, $syear);
					$date2  	=	 mktime(23, 59, 59, $emonth, $edate, $eyear);
					
					$this->db->where(array($this->_order.'.order_time >=' => $date1, $this->_order.'.order_time <=' => $date2));
				}
				  
			  //$this->db->where($this->_merchant_estab.'.userid', $userid);
			  $this->db->from($this->_order);
			  $this->db->join($this->_merchant_estab, "$this->_merchant_estab.estabid = $this->_order.establishment_id","left");
			  $payment 			=   $this->db->get()->result();
			  $data['payment_data'] 	= 	$payment;
				
			  $data['pay_tax']    	= 	array();
			  if (count($payment) > 0)
				{
					foreach ($payment as $resul)
						{
							$this->db->select('userid,commission_rate');
							$data['pay_tax'][$resul->userid] = $this->db->get_where($this->_merchant_info, array('userid' => $resul->userid))->result                                ();
						}
				}
							return $data;
			
		}
		
		
		 public function paymentsettlmnt($estabid = '')
		{
			
			$startdate  =  $this->input->post('start_date');
			$enddate    =  $this->input->post('end_date');
			list ($startmonth, $startday, $startyear)   =   explode ('/', $startdate);
			$startmktime = mktime (0, 0, 0, $startmonth, $startday, $startyear);
			list ($endmonth, $endday, $endyear) 		=    explode ('/', $enddate);
			$endmktime   = mktime (23, 59, 59, $endmonth, $endday, $endyear);
			 $this->db->select($this->_order.'.order_id, '.$this->_order.'.order_time, '.$this->_order.'.payment_method, '.$this->_order.'.total_amount, '.$this->_order.'.establishment_id, '.$this->_merchant_estab.'.userid');
			 
			 if (!empty($estabid))
			 $this->db->where(array($this->_order.'.establishment_id' => $estabid));
			 
			 
			$this->db->where(array($this->_order.'.order_time >=' => $startmktime, $this->_order.'.order_time <=' => $endmktime));
			$this->db->from($this->_order);
			$this->db->join($this->_merchant_estab, "$this->_merchant_estab.estabid = $this->_order.establishment_id","left");
			$payment 			=   $this->db->get()->result();
				$data['payment_data'] 	= 	$payment;
				
				$data['pay_tax']    	= 	array();
				if (count($payment) > 0)
					{
						foreach ($payment as $resul)
							{
								$this->db->select('userid,commission_rate');
								$data['pay_tax'][$resul->userid] = $this->db->get_where($this->_merchant_info, array('userid' => $resul->userid))->result                                ();
							}
					}
		return $data;
			
		
		}
		
		
		
			}

		

