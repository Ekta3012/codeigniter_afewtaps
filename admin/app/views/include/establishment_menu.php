<?php
	 $segment = $this->uri->segment(2);
	 switch ($segment)
		 {
			case 'order':
								$orderitem    = 'active';
								break;
			case 'inside':
			case 'averagetime':
			case 'favfood':
			case 'customer':
								$insideitem        = 'active';
								break;
			case 'analytics':
								$analyticsitem     = 'active';
								break;
			case 'ratings':
								$ratingsitem       = 'active';
								break;
			case 'menu':
								$menuitem          = 'active';
								break;
			
			case 'merchant':
							    $merchantinfor      = 'active';
							    break;
		 }
?>

<div class="row text-center">
	 <a href="<?php echo base_url(); ?>index.php/establishmentdata/order/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($orderitem) ? $orderitem : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
	 <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
	 <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
	 <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
	 <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
	 <a href="<?php echo base_url(); ?>index.php/establishmentdata/viewLocation/<?php echo $this->uri->segment(3); ?>"><button class="btn <?php echo isset($locationitem) ? $locationitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Location</button></a>	  
	 <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>
</div>