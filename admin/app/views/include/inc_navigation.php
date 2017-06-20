<?php
							$abc = $this->session->userdata('adminemail');
						    $uId  = $this->session->userdata('adminid');
						 	$branches = getNewAdminFlag($uId);
							$permission_arr = explode (',', $branches->permission);
						 
						?>
<?php

switch ($this->uri->segment(1))
	{ 
		case 'establishment':
		                       $estab_active = 'active';
		                       switch ($this->uri->segment(2))
								   {
									   case 'front':
														$front_view = 'active';
														break;
									   case 'service':
														$service_view   = 'active';
														break;
									   case 'registerd':
														$establish_view   = 'active';
														break;
									   case 'newadmin':
														$newadmin   = 'active';
														break;
												 
								   }
		break;
		
		case 'profile':
								$settings_active = 'active';
		                        switch ($this->uri->segment(2))
								   {
									   case 'myprofile':
																	$myprofile  = 'active';
																	break;
									  case 'faq':
																	$faq  = 'active';
																	break;							
									   case 'guidelines':
																	$guidelines  = 'active';
																	break;	
									  case 'privacy':
																	$privacy  = 'active';
																	break;															
									   
								   }
		break;
		
			case 'establishmentdata':
								$establishmentdata_active = 'active';
		                        
		break;
		
		case 'locality':
								$locality_active = 'active';
		                        
		break;
		case 'tax':
		                       $tax_active = 'active';
		                       switch ($this->uri->segment(2))
								   {
									   case 'index':
														$tax_index  = 'active';
														break;
									   case 'view':
														$tax_view   = 'active';
														break;
												 
								   }
		break;
		
		case 'staff':
		                       $staff_active = 'active';
		                       switch ($this->uri->segment(2))
								   {
									   case 'index':
														$staff_index  = 'active';
														break;
									   case 'view':
														$staff_view   = 'active';
														break;
								   }
		break;
		
		case 'coupon':
		                       $coupon_active = 'active';
		                       switch ($this->uri->segment(2))
								   {
									   case 'index':
														$coupon_index  = 'active';
														break;
									   case 'view':
														$coupon_view   = 'active';
														break;
												 
								   }
		break;
		
		case 'payment':
		                       switch ($this->uri->segment(2))
								   {
									   case 'index':
														$payment_active  = 'active';
														break;
												 
								   }
		break;
		
		case 'merchant':
		                       switch ($this->uri->segment(2))
								   {
									   case 'index':
														$merchant_active  = 'active';
														break;
												 
								   }
		break;
		
		case 'profile':
		                       switch ($this->uri->segment(2))
								   {
									    case 'changePassword':
																$changepwd_active  = 'active';
																break;
								   }
		break;
		
		case 'analytics':
								$analytics_active = 'active';
		                        switch ($this->uri->segment(2))
								   {
									   case 'order':
																	$order_active  = 'active';
																	break;
																
									   case 'businessGenerated':
																	$business_active  = 'active';
																	break;
								   }
		break;
		
		
		case 'admin':
								$real_time_active = 'active';
		                        switch ($this->uri->segment(2))
								   {
									    case 'thresholdView':
															$threshold_active  = 'active';
															break;
															
										case 'location':
															$location_active  = 'active';
															break;
								   }
		break;
	}
	
	
	$order_history = '';
	if ($this->uri->segment(1) == 'establishment' && $this->uri->segment(2) == 'index')
     	{
		   $estab_active = '';
		   $order_history = 'active'; 
		}

?>

<style>
.fa-angle-right:before{content:"\f105"}
.active > a > .fa-angle-right::before {
    content: "";
}
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
				
				    
                    <div class="dropdown profile-element"> 
					
				    	<h3 style="text-align:center;color:#FFF;margin-top:0;font-weight:normal;font-size:23px;margin-bottom:20px">afewtaps</h3>
					
					   <span style="float:left">
                            <img alt="image" class="img-circle" width="40" src="<?php echo base_url(); ?>../uploads/user.png" />
                       </span>
					   
					    
                       <a style="text-align:left"  href="#">
					       
                            <span class="clear" style="padding-left:15px"> 
							   <span class="block m-t-xs"> <strong class="font-bold">Welcome, </strong></span> 
							   <span class="text-muted text-xs block" style="color:#dfe4ed"><?php echo $this->session->userdata('aname'); ?></span> 
							</span> 
					   </a>
						<ul class="dropdown-menu animated fadeInRight m-t-xs">
							<li><a href="<?php echo site_url(); ?>/profile/logout">Logout</a></li>
						</ul>
                    </div>
                     <div class="logo-element" style="background:#FFF;border:1px solid #F5F5F5">
                       <p><img src="<?php echo base_url(); ?>../uploads/logo.png" alt="afewtaps" width="35" /></p>
                     </div>
                </li>
				
				<!-- <li class="<?php echo isset($estab_active) ? "active" : "" ; ?>">
                    <a href="<?php echo site_url(); ?>/establishment/index"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li> -->

				<?php
				   if (in_array('User Information', $permission_arr))
				    {
				?>		
						<li class="<?php echo $order_history ==  "active" ? "active" : "" ; ?>">
                          <a href="<?php echo site_url(); ?>/establishment/index"><i class="fa fa-th-large"></i> <span class="nav-label">Order History</span></a>
                        </li>
					
						
			   
				<li class="<?php echo $estab_active != '' ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">User Information</span><span class="fa fa-angle-right pull-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($front_view) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/establishment/front">Front End User</a></li>
						
						<li class="<?php echo isset($service_view) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/establishment/service">Service App User</a></li>
						
						<li class="<?php echo isset($establish_view) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/establishment/registerd">Establishment Registerd</a></li>
						
						<li class="<?php echo isset($newadmin) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/establishment/newadmin">Add New Admin</a></li>
						
						<!--<li class="<?php// echo isset($estab_view) ? "active" : "" ; ?>"><a href="#">My Profile</a></li>-->
						
                        
                    </ul>
                </li>
                
               <?php } ?> 
				
				<?php
				   if (in_array('Establishment Data', $permission_arr))
				    {
			   ?>
				<li class="<?php echo isset($establishmentdata_active) ? "active" : "" ; ?>">
                    <a href="<?php echo site_url(); ?>/establishmentdata/order/"><i class="fa fa-th-large"></i> <span class="nav-label">Establishment Data</span></a>
                </li>
				
				<?php } ?> 
                <?php
				   if (in_array('Payment Settlement', $permission_arr))
				    {
			   ?>
				<li class="<?php echo isset($payment_active) ? "active" : "" ; ?>">
                    <a href="<?php echo site_url(); ?>/payment/index"><i class="fa fa-th-large"></i> <span class="nav-label">Payment Settlement</span></a>
                </li>
				<?php } ?> 
				
                <?php
				   if (in_array('Locality Information', $permission_arr))
				    {
			   ?>
				<li class="<?php echo isset($locality_active) ? "active" : "" ; ?>">
                    <a href="<?php echo site_url(); ?>/locality/index"><i class="fa fa-th-large"></i> <span class="nav-label">Locality Information</span></a>
                </li>
				
				
				
				
		       <?php } ?> 
				
				
				<?php 
				 if (count($permission_arr) == 4)
				 {
					 
				 ?>
				<li class="<?php echo isset($settings_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">Settings</span><span class="fa fa-angle-right pull-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($faq) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/profile/faq">FAQ</a></li>
						
						<li class="<?php echo isset($guidelines) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/profile/guidelines">Merchant Guidelines</a></li>
					
						
						<li class="<?php echo isset($privacy) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/profile/privacy">Privacy</a></li>
                        <li class="<?php echo isset($myprofile) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/profile/myprofile">My Profile</a></li>
						
                        
                    </ul>
                </li>
				
				 <?php } ?>
				
				
				
				<li class="">
                    <a href="<?php echo site_url(); ?>/profile/logout"><i class="fa fa-power-off"></i> <span class="nav-label">Log Out</span></a>
                </li>
				
              
				
            </ul>

        </div>
		<?php 
				 if (count($permission_arr) == 4)
				 {
					 
				 ?>
      <ul class="nav metismenu viewadm" id="side-menu">
	     <li class=""><a href="<?php echo site_url(); ?>/establishment/newadmin"><i class="fa fa-user" aria-hidden="true"></i></a> 
		 <a href="<?php echo site_url(); ?>/establishment/viewadmin"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
         </a>
		</li>
	  </ul>  
	  <?php } ?>
	  
</nav>

 
