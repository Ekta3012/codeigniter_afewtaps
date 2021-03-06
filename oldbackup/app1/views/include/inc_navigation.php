<?php
switch ($this->uri->segment(1))
	{
		case 'establishment':
		                       $estab_active = 'active';
		                       switch ($this->uri->segment(2))
								   {
									   case 'index':
														$estab_index = 'active';
														break;
									   case 'view':
														$estab_view   = 'active';
														break;
									   case 'branch':
														$branch_view   = 'active';
														break;
												 
								   }
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
														$pay_active  = 'active';
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
								   
		case 'floor':
								$floor_active = 'active';
								break;
								
		case 'negligent':
								$negligent_active = 'active';
								switch ($this->uri->segment(2))
									{
										case 'index':
															$negligent_add_active  = 'active';
															break;
															
										case 'view':
															$negligent_view_active  = 'active';
															break;
									}
		break;
		
		
		
		case 'menu':
								$real_time_active = 'active';
								$menu_active      = 'active';
								switch ($this->uri->segment(2))
									{
										case 'index':
															$menu_add_active  = 'active';
															break;
															
										case 'view':
															$menu_view_active  = 'active';
															break;
									}
		break;
		
		
		
		
		
		case 'category':
		case 'cuisine':
		                        $main_cat_active = 'active';
								switch ($this->uri->segment(1))
									{
										case 'category':
										                    switch ($this->uri->segment(2))
																{
																	case 'index':
																						$category_add_active  = 'active';
																						break;
																						
																	case 'view':
																						$category_view_active  = 'active';
																						break;
																}
															break;
															
										case 'cuisine':
															switch ($this->uri->segment(2))
																{
																	case 'index':
																						$cuisine_add_active  = 'active';
																						break;
																						
																	case 'view':
																						$cuisine_view_active  = 'active';
																						break;
																}
															break;
									}
		
	}

?>

<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
					   <span>
                            <img alt="image" class="img-circle" width="40" src="<?php echo base_url(); ?>../uploads/user.png" />
                       </span>
                       <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> 
							   <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('email'); ?></strong></span> 
							   <span class="text-muted text-xs block">Owner <b class="caret"></b></span> 
							</span> 
					   </a>
						<ul class="dropdown-menu animated fadeInRight m-t-xs">
							<li><a href="<?php echo site_url(); ?>/profile/logout">Logout</a></li>
						</ul>
                    </div>
                    <div class="logo-element">
                       A Few Taps
                    </div>
                </li>
				
				<li class="">
                    <a href="<?php echo config_item('base_url'); ?>"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                </li>
				
				<li class="<?php echo isset($estab_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">Establishments</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($estab_index) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/establishment/index">Add Establishments</a></li>
						
						<li class="<?php echo isset($estab_view) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/establishment/view">View Establishments</a></li>
						
						<?php
						   $uId  = $this->session->userdata('id');
						   $flag = getEstabFlag($uId);
						   if ($flag > 0)
						     {
								  $brnch_actv  = isset($branch_view) ? "active" : "";
								  echo '<li class="'.$brnch_actv.'"><a href="'.site_url().'/establishment/branch">Add More Branch</a></li>';
							 }
						?>
                        
                    </ul>
                </li>
				
				<li class="<?php echo isset($main_cat_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Category</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($category_add_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/category/index">Add Category</a></li>
						<li class="<?php echo isset($category_view_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/category/view">View Category</a></li>
						
						<!-- <li class="<?php echo isset($cuisine_add_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/cuisine/index">Add Cuisine</a></li>
						<li class="<?php echo isset($cuisine_view_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/cuisine/view">View Cuisine</a></li> -->
						
                    </ul>
                </li>
				
				<li class="<?php echo isset($analytics_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-area-chart"></i> <span class="nav-label">Analytics</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($order_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/analytics/order">No Of Orders</a></li>
						
						<li class="<?php echo isset($business_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/analytics/businessGenerated">Business Generated</a></li>
						
                        <li class=""><a href="#">Negligent Ratings</a></li>
						
						<li class=""><a href="<?php echo site_url(); ?>/analytics/staffAnalytics">Staff Analytics</a></li>
						
                    </ul>
                </li>
				
				
				<li class="<?php echo isset($real_time_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Real Time Orders</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
					
					
                       <!-- <li class="<?php echo isset($order_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/menu/index">Menu</a></li> -->
						
						
						
						<li class="<?php echo isset($menu_active) ? "active" : "" ; ?>">
							<a href="#"><i class="fa fa-list"></i> <span class="nav-label">Menu</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li class="<?php echo isset($menu_add_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/menu/index">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Menu</a></li>
								<li class="<?php echo isset($menu_view_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/menu/view">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Menu</a></li>
							</ul>
						</li>
				

						
						<li class="<?php echo isset($location_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/admin/location">Location</a></li>
						
                        <li class="<?php echo isset($threshold_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/admin/thresholdView">Threshold limit</a></li>
						
						<li class="<?php echo isset($order_active) ? "active" : "" ; ?>"><a href="#">Invoice Sample</a></li>
						
						<li class="<?php echo isset($order_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/payment/method">Payment</a></li>
						
						
						
                    </ul>
                </li>
				
				<li class="<?php echo isset($negligent_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-scissors"></i> <span class="nav-label">Negligent Marking</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($negligent_add_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/negligent/index">Add Negligent Marking</a></li>
						<li class="<?php echo isset($negligent_view_active) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/negligent/view">View Negligent Marking</a></li>
                    </ul>
                </li>
				
				
				<li class="<?php echo isset($floor_active) ? "active" : "" ; ?>">
                    <a href="<?php echo site_url(); ?>/floor/performance"><i class="fa fa-bar-chart"></i> <span class="nav-label">Floor Performance</span></a>
                </li>
				
				<li class="<?php echo isset($tax_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-inr"></i> <span class="nav-label">Tax</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($tax_index) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/tax/index">Add Tax</a></li>
                        <li class="<?php echo isset($tax_view) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/tax/view">View Tax</a></li>
                    </ul>
                </li>
				
				<li class="<?php echo isset($staff_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Staff Member</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($staff_index) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/staff/index">Add Staff Member</a></li>
                        <li class="<?php echo isset($staff_view) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/staff/view">View Staff Member</a></li>
                    </ul>
                </li>
				
				<li class="<?php echo isset($coupon_active) ? "active" : "" ; ?>">
                    <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Coupon</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo isset($coupon_index) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/coupon/index">Add Coupon</a></li>
                        <li class="<?php echo isset($coupon_view) ? "active" : "" ; ?>"><a href="<?php echo site_url(); ?>/coupon/view">View Coupon</a></li>
                    </ul>
                </li>
				
				
				<li class="<?php echo isset($pay_active) ? "active" : "" ; ?>">
                    <a href="<?php echo site_url(); ?>/payment/index"><i class="fa fa-gear"></i> <span class="nav-label">Payment Settlement</span></a>
                </li>
				
				
				<li class="<?php echo isset($merchant_active) ? "active" : "" ; ?>">
                    <a href="<?php echo site_url(); ?>/merchant/index"><i class="fa fa-info"></i> <span class="nav-label">Merchant Information</span></a>
                </li>
				
				
				<li class="<?php echo isset($changepwd_active) ? "active" : "" ; ?>">
                    <a href="<?php echo site_url(); ?>/profile/changePassword"><i class="fa fa-key"></i> <span class="nav-label">Change Password</span></a>
                </li>
				
				<li class="">
                    <a href="<?php echo site_url(); ?>/profile/logout"><i class="fa fa-power-off"></i> <span class="nav-label">Log Out</span></a>
                </li>
				
                <!--<li class="active">
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="index.html">Dashboard v.1</a></li>
                        <li><a href="dashboard_2.html">Dashboard v.2</a></li>
                        <li class="active"><a href="dashboard_3.html">Dashboard v.3</a></li>
                        <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                        <li><a href="dashboard_5.html">Dashboard v.5 <span class="label label-primary pull-right">NEW</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graphs</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="graph_flot.html">Flot Charts</a></li>
                        <li><a href="graph_morris.html">Morris.js Charts</a></li>
                        <li><a href="graph_rickshaw.html">Rickshaw Charts</a></li>
                        <li><a href="graph_chartjs.html">Chart.js</a></li>
                        <li><a href="graph_chartist.html">Chartist</a></li>
                        <li><a href="c3.html">c3 charts</a></li>
                        <li><a href="graph_peity.html">Peity Charts</a></li>
                        <li><a href="graph_sparkline.html">Sparkline Charts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox </span><span class="label label-warning pull-right">16/24</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="mailbox.html">Inbox</a></li>
                        <li><a href="mail_detail.html">Email view</a></li>
                        <li><a href="mail_compose.html">Compose email</a></li>
                        <li><a href="email_template.html">Email templates</a></li>
                    </ul>
                </li>
                <li>
                    <a href="metrics.html"><i class="fa fa-pie-chart"></i> <span class="nav-label">Metrics</span>  </a>
                </li>
                <li>
                    <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">Widgets</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Forms</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="form_basic.html">Basic form</a></li>
                        <li><a href="form_advanced.html">Advanced Plugins</a></li>
                        <li><a href="form_wizard.html">Wizard</a></li>
                        <li><a href="form_file_upload.html">File Upload</a></li>
                        <li><a href="form_editors.html">Text Editor</a></li>
                        <li><a href="form_markdown.html">Markdown</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">App Views</span>  <span class="pull-right label label-primary">SPECIAL</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="profile_2.html">Profile v.2</a></li>
                        <li><a href="contacts_2.html">Contacts v.2</a></li>
                        <li><a href="projects.html">Projects</a></li>
                        <li><a href="project_detail.html">Project detail</a></li>
                        <li><a href="teams_board.html">Teams board</a></li>
                        <li><a href="social_feed.html">Social feed</a></li>
                        <li><a href="clients.html">Clients</a></li>
                        <li><a href="full_height.html">Outlook view</a></li>
                        <li><a href="vote_list.html">Vote list</a></li>
                        <li><a href="file_manager.html">File manager</a></li>
                        <li><a href="calendar.html">Calendar</a></li>
                        <li><a href="issue_tracker.html">Issue tracker</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="article.html">Article</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="timeline.html">Timeline</a></li>
                        <li><a href="pin_board.html">Pin board</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Other Pages</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="search_results.html">Search results</a></li>
                        <li><a href="lockscreen.html">Lockscreen</a></li>
                        <li><a href="invoice.html">Invoice</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="login_two_columns.html">Login v.2</a></li>
                        <li><a href="forgot_password.html">Forget password</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="404.html">404 Page</a></li>
                        <li><a href="500.html">500 Page</a></li>
                        <li><a href="empty_page.html">Empty page</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Miscellaneous</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="toastr_notifications.html">Notification</a></li>
                        <li><a href="nestable_list.html">Nestable list</a></li>
                        <li><a href="agile_board.html">Agile board</a></li>
                        <li><a href="timeline_2.html">Timeline v.2</a></li>
                        <li><a href="diff.html">Diff</a></li>
                        <li><a href="i18support.html">i18 support</a></li>
                        <li><a href="sweetalert.html">Sweet alert</a></li>
                        <li><a href="idle_timer.html">Idle timer</a></li>
                        <li><a href="truncate.html">Truncate</a></li>
                        <li><a href="spinners.html">Spinners</a></li>
                        <li><a href="tinycon.html">Live favicon</a></li>
                        <li><a href="google_maps.html">Google maps</a></li>
                        <li><a href="code_editor.html">Code editor</a></li>
                        <li><a href="modal_window.html">Modal window</a></li>
                        <li><a href="clipboard.html">Clipboard</a></li>
                        <li><a href="forum_main.html">Forum view</a></li>
                        <li><a href="validation.html">Validation</a></li>
                        <li><a href="tree_view.html">Tree view</a></li>
                        <li><a href="loading_buttons.html">Loading buttons</a></li>
                        <li><a href="chat_view.html">Chat view</a></li>
                        <li><a href="masonry.html">Masonry</a></li>
                        <li><a href="tour.html">Tour</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">UI Elements</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="typography.html">Typography</a></li>
                        <li><a href="icons.html">Icons</a></li>
                        <li><a href="draggable_panels.html">Draggable Panels</a></li> <li><a href="resizeable_panels.html">Resizeable Panels</a></li>
                        <li><a href="buttons.html">Buttons</a></li>
                        <li><a href="video.html">Video</a></li>
                        <li><a href="tabs_panels.html">Panels</a></li>
                        <li><a href="tabs.html">Tabs</a></li>
                        <li><a href="notifications.html">Notifications & Tooltips</a></li>
                        <li><a href="badges_labels.html">Badges, Labels, Progress</a></li>
                    </ul>
                </li>

                <li>
                    <a href="grid_options.html"><i class="fa fa-laptop"></i> <span class="nav-label">Grid options</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Tables</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="table_basic.html">Static Tables</a></li>
                        <li><a href="table_data_tables.html">Data Tables</a></li>
                        <li><a href="table_foo_table.html">Foo Tables</a></li>
                        <li><a href="jq_grid.html">jqGrid</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">E-commerce</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="ecommerce_products_grid.html">Products grid</a></li>
                        <li><a href="ecommerce_product_list.html">Products list</a></li>
                        <li><a href="ecommerce_product.html">Product edit</a></li>
                        <li><a href="ecommerce_product_detail.html">Product detail</a></li>
                        <li><a href="ecommerce-cart.html">Cart</a></li>
                        <li><a href="ecommerce-orders.html">Orders</a></li>
                        <li><a href="ecommerce_payments.html">Credit Card form</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="basic_gallery.html">Lightbox Gallery</a></li>
                        <li><a href="slick_carousel.html">Slick Carousel</a></li>
                        <li><a href="carousel.html">Bootstrap Carousel</a></li>

                    </ul>
                </li>
				
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">Third Level <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>

                            </ul>
                        </li>
                        <li><a href="#">Second Level Item</a></li>
                        <li>
                            <a href="#">Second Level Item</a></li>
                        <li>
                            <a href="#">Second Level Item</a></li>
                    </ul>
                </li>
                <li>
                    <a href="css_animation.html"><i class="fa fa-magic"></i> <span class="nav-label">CSS Animations </span><span class="label label-info pull-right">62</span></a>
                </li>
                <li class="landing_link">
                    <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Landing Page</span> <span class="label label-warning pull-right">NEW</span></a>
                </li>
                <li class="special_link">
                    <a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a>
                </li>-->
				
				
            </ul>

        </div>
</nav>