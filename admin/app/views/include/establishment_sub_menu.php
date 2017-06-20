<?php
 $segment = $this->uri->segment(2);
 switch ($segment)
	 {
		 case 'averagetime':
							$average_active     = 'active';
							break;
							
		 case 'favfood':
							$favfood_active     = 'active';
							break;
							
		 case 'customer':
							$customer_active    = 'active';
							break;
		 default:
							$service_rating    =  'active';
							break;
	 }
?>
										
<div class="rows text-center">
	  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($service_rating) ? $service_rating : "nonactive" ; ?>" data-attr="1" type="button">Service Rating Table</button></a>
	  
	  <a href="<?php echo base_url(); ?>index.php/establishmentdata/averagetime/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($average_active) ? $average_active : "nonactive" ; ?>" data-attr="2" type="button">Average Order Completion Time</button></a>
	  
	  <a href="<?php echo base_url(); ?>index.php/establishmentdata/favfood/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($favfood_active) ? $favfood_active : "nonactive" ; ?>" data-attr="favfood" type="button">Favourite Food</button></a>
	  
	  <a href="<?php echo base_url(); ?>index.php/establishmentdata/customer/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($customer_active) ? $customer_active : "nonactive" ; ?>" data-attr="customer" type="button">New & Returning Customers</button></a>
</div>