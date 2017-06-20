<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?>Login</title>
<link href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/custom.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<style>
.lnehght30{line-height:30px}
.lnehght40{line-height:40px}
.wdth100{width:100%}
.wdth80{width:80%}
.wdth20{width:20%}
.fdItem{margin-left:20px;margin-bottom:10px}
</style>
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
	   
	    <div class="sidebard-panel">
                <?php $this->load->view('include/inc_sidebar'); ?>
        </div>
		
        <div class="wrapper wrapper-content">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>View Orders</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									</div>
								</div>
								
								
								<div class="ibox-content">

									<!-- Tab -->
									
									<div class="tabs-container">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="false">All</a></li>
											<li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="true">New</a></li>
											<li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="true">Pending</a></li>
											<li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="true">Cancelled</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="tab-1">
												<div class="panel-body">
												
												
													<!--  Container -->
													
													
													<div class="row">
														<div class="col-lg-6">
															<div class="contact-box">
																<a href="profile.html">
																	<div class="col-sm-12">
																		<h3 class="pull-left"><strong>Customer Name: John Smith</strong></h3>
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Order no: 106</div><div class="pull-right text-right lnehght30">Order no: 106</div></div>
																		
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Location near table: #21</div><div class="pull-right text-right lnehght30">Cash on delivery</div></div>
																	
																		<div class="pull-left hr-line-dashed wdth100"></div>
																		
																		
																		<div class="pull-left wdth100 lnehght40">5 items in total</div>
																		
																		<div class="pull-left wdth100">
																		
																		   <div class="pull-left wdth80">
																			  <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon">Chicken Pasta * 1</div>
																				 <div class="vegIcon">Rs 300 * 1</div>
																			  </div>
																			  
																			   <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon">Chicken Pasta * 1</div>
																				 <div class="vegIcon">Rs 300 * 1</div>
																			  </div>
																				  
																		   </div>
																			   
																			   
																			   <div class="pull-left wdth20"><div class="i-checks text-center"><label><input type="checkbox" value="" checked=""><i></i></label></div><strong>12:09 PM</strong></div>
																		    
																		</div>
																		
																		
																	</div>
																	
																	<div class="pull-left hr-line-dashed wdth100"></div>
																	
																	
																	<div class="col-sm-12 text-center"><strong>Service Employee: Ajay</strong></div>
																	
																	
																	<div class="clearfix"></div>
															    </a>
															</div>
															fgggg
														</div>
														
														
														
														<div class="col-lg-6">
															<div class="contact-box">
																<a href="profile.html">
																	<div class="col-sm-12">
																		<h3 class="pull-left"><strong>Customer Name: John Smith</strong></h3>
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Order no: 106</div><div class="pull-right text-right lnehght30">Order no: 106</div></div>
																		
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Location near table: #21</div><div class="pull-right text-right lnehght30">Cash on delivery</div></div>
																	
																		<div class="pull-left hr-line-dashed wdth100"></div>
																		
																		
																		<div class="pull-left wdth100 lnehght40">5 items in total</div>
																		
																		<div class="pull-left wdth100">
																		
																		   <div class="pull-left wdth80">
																			  <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon">Chicken Pasta * 1</div>
																				 <div class="vegIcon">Rs 300 * 1</div>
																			  </div>
																			  
																			   <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon">Chicken Pasta * 1</div>
																				 <div class="vegIcon">Rs 300 * 1</div>
																			  </div>
																				  
																		   </div>
																			   
																			   
																			   <div class="pull-left wdth20"><div class="i-checks text-center"><label><input type="checkbox" value="" checked=""><i></i></label></div><strong>12:09 PM</strong></div>
																		    
																		</div>
																		
																		
																	</div>
																	
																	<div class="pull-left hr-line-dashed wdth100"></div>
																	
																	
																	<div class="col-sm-12 text-center"><strong>Service Employee: Ajay</strong></div>
																	
																	<div class="clearfix"></div>
															    </a>
															</div>
															
															sdf
														</div>
														
														
														
														
														
														
														
														
														
														
													</div>
		
		
													<!-- close -->
													
													
													
												</div>
											</div>
											<div class="tab-pane" id="tab-2">
												<div class="panel-body">
													<strong>Donec quam felis</strong>

													<p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
														and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

													<p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
														sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
												</div>
											</div>
											
											<div class="tab-pane" id="tab-3">
												<div class="panel-body">
													<strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

													<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
														existence in this spot, which was created for the bliss of souls like mine.</p>

													<p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
														the present moment; and yet I feel that I never was a greater artist than now. When.</p>
												</div>
											</div>
											
											
											<div class="tab-pane" id="tab-4">
												<div class="panel-body">
													<strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

													<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
														existence in this spot, which was created for the bliss of souls like mine.</p>

													<p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
														the present moment; and yet I feel that I never was a greater artist than now. When.</p>
												</div>
											</div>
											
											
											
											
										</div>

									</div>
					
									<!-- Close -->
								 
								</div>
								
								
								
							</div>
						</div>
				 <!-- Close -->
            </div>
     </div>
        <div class="footer">
             <?php $this->load->view('include/inc_footer'); ?>
        </div>

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.metisMenu.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery-ui.min.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/icheck.min.js"></script>
	
	<script>
        $(document).ready(function(){
			 $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
        });
    </script>
	
</body>

</html>
			