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
.lnehght24{line-height:24px}
.wdth100{width:100%}
.wdth80{width:80%}
.wdth20{width:20%}
.fdItem{margin-left:20px;margin-bottom:10px}
.orderBx{border:1px solid #888;border-radius:5px;padding:10px;margin-bottom:8px !important}
.bold{font-weight:bold}
.fntsz{font-size:20px}
.extraseasoning {border:1px dashed #EAEAEA;line-height:24px;margin:10px 0}
.bordrseason{border:1px dashed #888}
.vg{background:url('../../assets/img/red_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
.nonvg{background:url('../../assets/img/green_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
.ordrtm{color:#c80000}
.mrgntp10_0{margin:10px 0}
.flrperformance{float:left;background:#2A3F54;color:#fff;height:44px;line-height:44px;width:100%;padding-left:10px;font-size:17px;font-weight:bold}
.brdrad5{border-radius:5px}
br {display:block;margin:0;line-height:12px}
.brdrlne{border-bottom:1px solid #DDD}
.pdbtm{padding-bottom:10px}
.qty{border:1px solid #888;border-radius: 3px;line-height:14px;padding:2px 6px}
.vegIcon, .nonVegIcon{width:100%}
.hr-line-dashed{margin:6px 0}
.padleft20{padding-left:20px}
.mrgn15{margin:15px 0}
.mrgn25{margin:25px 0}
.fntsze12{font-size:12px}
.fntsze10{font-size:10px}
.clr666{color:#666}
.fntsze13{font-size:13px;line-height:28px}
.flrbox{width:220px;float:left}
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
													<div class="row" style="margin:10px 0 40px 0">
														<div class="col-lg-6">
															<div class="contact-box orderBx">
																<a href="#">
																	<div class="col-sm-12">
																		<div class="pull-left wdth100">
																		  <div class="pull-left text-left lnehght30">Order Id: 106</div>
																		  <div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> 1060 /-</div>
																		</div>
																		
																		<div class="pull-left wdth100 brdrlne pdbtm">
																		   <div class="pull-left text-left lnehght24">11:30 PM, 22 January 2016 <br /><i class="fa fa-map-marker"></i> <strong>near</strong> table #21<br /><i class="fa fa-user"></i> Reena Gupta</div>
																		   
																		   
																		   <div class="pull-right text-right lnehght24">Cash on delivery<br /><i class="fa fa-clock-o"></i> <span class="ordrtm">14:08</span></div>
																		</div>
																		
																		
																		<div class="pull-left wdth100 lnehght40">Items (5)</div>
																		
																		<div class="pull-left wdth100">
																		
																		   <div class="pull-left wdth80">
																			  <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon"><i class="vg">&nbsp;</i>Chicken Pasta</div>
																				  <div class="vegIcon pull-left">
																				     <div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> 300 </div>
																					 <div class="qty text-center pull-right">2</div>
																				  </div>
																			  </div>
																			  
																			  <div class="pull-left hr-line-dashed wdth100"></div>
																			  
																			   <div class="pull-left wdth80 fdItem">
																				 <div class="nonVegIcon"><i class="nonvg">&nbsp;</i>Cron Pasta</div>
																				 <div class="nonVegIcon pull-left">
																				     <div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> 300 </div>
																					 <div class="qty text-center pull-right">2</div>
																				  </div>
																				  
																				  
																			  </div>
																				  
																		   </div>
																		    
																		</div>
																		
																	</div>
																	
																	<div class="clearfix"></div>
															    </a>
															</div>
														</div>
														
														<div class="col-lg-6">
															<div class="contact-box orderBx" style="background:#C80000;color:#FFF !important">
																<a href="#">
																	<div class="col-sm-12">
																		<h3 class="pull-left"><strong>Customer Name: John Smith</strong></h3>
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Order no: 106</div><div class="pull-right text-right lnehght30">Order no: 106</div></div>
																		
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Location near table: #21</div><div class="pull-right text-right lnehght30">Cash on delivery</div></div>
																	
																		<div class="pull-left hr-line-dashed wdth100"></div>
																		
																		
																		<div class="pull-left wdth100 lnehght40">Items (5)</div>
																		
																		<div class="pull-left wdth100">
																		
																		   <div class="pull-left wdth80">
																			  <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon"><i class="vg">&nbsp;</i>Chicken Pasta * 1</div>
																				 <div class="vegIcon">Rs 300 * 1</div>
																			  </div>
																			  
																			   <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon"><i class="nonvg">&nbsp;</i>Chicken Pasta * 1</div>
																				 <div class="vegIcon">Rs 300 * 1</div>
																			  </div>
																				  
																		   </div>
																			   
																			   
																		   <div class="pull-left wdth20 ordrtm"><strong>12:09 PM</strong></div>
																		    
																		</div>
																		
																		
																		<div class="pull-left wdth100 text-center extraseasoning">
																			   Extra Seasoning 	  
																		</div>

																		
																	</div>
																	
																	<div class="pull-left hr-line-dashed wdth100"></div>
																	
																	
																	<div class="col-sm-12 text-center fntsz">SERVICE EMPLOYEE: MANOJ</div>
																	
																	<div class="clearfix"></div>
															    </a>
															</div>
															
															<div class="text-right bold">Order Status: Pending</div>
															
														</div>
													</div>	
														
													<div class="row" style="margin:10px 0 40px 0">	
														<div class="col-lg-6">
															<div class="contact-box orderBx">
																<a href="#">
																	<div class="col-sm-12">
																		<h3 class="pull-left"><strong>Customer Name: John Smith</strong></h3>
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Order Id: 106</div><div class="pull-right text-right lnehght30">Rs: 1060 /-</div></div>
																		
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Location near table: #21</div><div class="pull-right text-right lnehght30">Cash on delivery</div></div>
																	
																		<div class="pull-left hr-line-dashed wdth100"></div>
																		
																		<div class="pull-left wdth100 lnehght40">Items (5)</div>
																		
																		<div class="pull-left wdth100">
																		
																		   <div class="pull-left wdth80">
																			  <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon"><i class="vg">&nbsp;</i>Chicken Pasta * 1</div>
																				 <div class="vegIcon">Rs 300 * 1</div>
																			  </div>
																			  
																			   <div class="pull-left wdth80 fdItem">
																				 <div class="nonVegIcon"><i class="nonvg">&nbsp;</i>Cron Pasta * 1</div>
																				 <div class="nonVegIcon">Rs 300 * 1</div>
																			  </div>
																				  
																		   </div>
																			   
																			   
																			   <div class="pull-left wdth20 ordrtm"><strong>12:09 PM</strong></div>
																		    
																		</div>
																		
																		<div class="bordrseason pull-left wdth100 text-center extraseasoning">
																			   Extra Seasoning 	  
																		</div>
																		
																		
																		
																	</div>
																	
																	<div class="pull-left hr-line-dashed wdth100"></div>
																	
																	
																	<div class="col-sm-12 text-center fntsz">SERVICE EMPLOYEE: AJAY</div>
																	
																	
																	<div class="clearfix"></div>
															    </a>
															</div>
															<div class="text-right bold">Order Status: Completed</div>
														</div>
														
														<div class="col-lg-6">
															<div class="contact-box orderBx">
																<a href="#">
																	<div class="col-sm-12">
																		<h3 class="pull-left"><strong>Customer Name: John Smith</strong></h3>
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Order Id: 106</div><div class="pull-right text-right lnehght30">Rs: 1060 /-</div></div>
																		<div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Location near table: #21</div><div class="pull-right text-right lnehght30">Cash on delivery</div></div>
																		<div class="pull-left hr-line-dashed wdth100"></div>
																		<div class="pull-left wdth100 lnehght40">Items (5)</div>
																		<div class="pull-left wdth100">
																		    <div class="pull-left wdth80">
																			  <div class="pull-left wdth80 fdItem">
																				 <div class="vegIcon"><i class="vg">&nbsp;</i>Chicken Pasta * 1</div>
																				 <div class="vegIcon">Rs 300 * 1</div>
																			  </div>
																			   <div class="pull-left wdth80 fdItem">
																				 <div class="nonVegIcon"><i class="nonvg">&nbsp;</i>Cron Pasta * 1</div>
																				 <div class="nonVegIcon">Rs 300 * 1</div>
																			  </div>
																		    </div>
																			<div class="pull-left wdth20 ordrtm"><strong>12:09 PM</strong></div>
																		</div>
																		<div class="bordrseason pull-left wdth100 text-center extraseasoning">
																			   Extra Seasoning 	  
																		</div>
																	</div>
																	<div class="pull-left hr-line-dashed wdth100"></div>
																	<div class="col-sm-12 text-center fntsz">SERVICE EMPLOYEE: AJAY</div>
																	<div class="clearfix"></div>
															    </a>
															</div>
															<div class="text-right bold">Order Status: Completed</div>
														</div>
													</div>

													
													
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
									
									
									<!-- tab close -->
									
									
									<!-- floor performace -->
									

									 <div class="row mrgntp10_0">
									    
									       <div class="flrperformance brdrad5">Floor Performance</div>
										   
										   
										     
										        <div class="row">
										        
													  <div class="col-lg-3">
															 <!-- Slider -->
															 <div class="pull-left text-center" style="width:100%;margin:0 15px">
																<div class="text-center" style="font-size:18px;margin-top:185px;">
																	<div class="fntsze13 text-center" style="background:#EDEDED;border:1px solid #888;">No of Orders</div>
																	 <div class="fntsze13 text-center" style="background:#f9f9f9;border-left:1px solid #888;border-right:1px solid #888;">Average time (m:s)</div>
																	 <div class="fntsze13 text-center" style="background:#EDEDED;border:1px solid #888;">Amount <i class="fa fa-inr"></i></div>
																</div>	
															 </div>
													  </div>
													  
													  <div class="col-lg-9">
														 <div class="row" style="overflow:hidden;overflow-x:scroll">
															  <!-- Slider -->
															  <div class="floorContainer" style="width:1325px;height:320px;margin-top:17px">
																 <div class="flrbox" style="">
																	<div class="text-center mrgn15"><img src="<?php echo base_url(); ?>assets/img/user.png" /></div>
																	<div class="text-center mrgn15 fntsze10" style=""><img src="<?php echo base_url(); ?>assets/img/green_icon.png" /> Online</div>
																	<div class="text-center mrgn25 clr666" style="font-size:18px">Suresh</div>
																	<div class="text-center mrgn25" style="font-size:18px">
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;">12</div>
																		 <div class="fntsze13" style="background:#f9f9f9;border-left:1px solid #888;border-right:1px solid #888;">12:15</div>
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;"><i class="fa fa-inr"></i> 9,566</div>
																		 
																		 <div class="fntsze13" style="margin-top:30px"><i class="fa fa-user"></i> View Profile</div>
																		 

																		 <div class="fntsze13" style="margin-top:10px;padding-left:10px"><i class="fa fa-bar-chart"></i> View Analytics</div>
																		 
																		 
																		 
																	</div>	
																 </div>
																 
																 <div class="flrbox">
																	<div class="text-center mrgn15"><img src="<?php echo base_url(); ?>assets/img/user.png" /></div>
																	<div class="text-center mrgn15 fntsze10" style=""><img src="<?php echo base_url(); ?>assets/img/green_icon.png" /> Online</div>
																	<div class="text-center mrgn25 clr666" style="font-size:18px">Suresh</div>
																	<div class="text-center mrgn25" style="font-size:18px">
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;">12</div>
																		 <div class="fntsze13" style="background:#f9f9f9;border-left:1px solid #888;border-right:1px solid #888;">12:15</div>
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;"><i class="fa fa-inr"></i> 9,566</div>
																		 
																		 <div class="fntsze13" style="margin-top:30px"><i class="fa fa-user"></i> View Profile</div>
																		 

																		 <div class="fntsze13" style="margin-top:10px;padding-left:10px"><i class="fa fa-bar-chart"></i> View Analytics</div>
																		 
																		 
																	</div>	
																 </div>
																 
																 
																 
																 <div class="flrbox">
																	<div class="text-center mrgn15"><img src="<?php echo base_url(); ?>assets/img/user.png" /></div>
																	<div class="text-center mrgn15 fntsze10" style=""><img src="<?php echo base_url(); ?>assets/img/green_icon.png" /> Online</div>
																	<div class="text-center mrgn25 clr666" style="font-size:18px">Suresh</div>
																	<div class="text-center mrgn25" style="font-size:18px">
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;">12</div>
																		 <div class="fntsze13" style="background:#f9f9f9;border-left:1px solid #888;border-right:1px solid #888;">12:15</div>
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;"><i class="fa fa-inr"></i> 9,566</div>
																		 
																		 <div class="fntsze13" style="margin-top:30px"><i class="fa fa-user"></i> View Profile</div>
																		 

																		 <div class="fntsze13" style="margin-top:10px;padding-left:10px"><i class="fa fa-bar-chart"></i> View Analytics</div>
																		 
																	</div>	
																 </div>
																 
																 
																 
																 <div class="flrbox">
																	<div class="text-center mrgn15"><img src="<?php echo base_url(); ?>assets/img/user.png" /></div>
																	<div class="text-center mrgn15 fntsze10" style=""><img src="<?php echo base_url(); ?>assets/img/green_icon.png" /> Online</div>
																	<div class="text-center mrgn25 clr666" style="font-size:18px">Suresh</div>
																	<div class="text-center mrgn25" style="font-size:18px">
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;">12</div>
																		 <div class="fntsze13" style="background:#f9f9f9;border-left:1px solid #888;border-right:1px solid #888;">12:15</div>
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;"><i class="fa fa-inr"></i> 9,566</div>
																		 
																		 <div class="fntsze13" style="margin-top:30px"><i class="fa fa-user"></i> View Profile</div>
																		 

																		 <div class="fntsze13" style="margin-top:10px;padding-left:10px"><i class="fa fa-bar-chart"></i> View Analytics</div>
																		 
																		 
																	</div>	
																 </div>
																 
																 
																 
																 <div class="flrbox">
																	<div class="text-center mrgn15"><img src="<?php echo base_url(); ?>assets/img/user.png" /></div>
																	<div class="text-center mrgn15 fntsze10" style=""><img src="<?php echo base_url(); ?>assets/img/green_icon.png" /> Online</div>
																	<div class="text-center mrgn25 clr666" style="font-size:18px">Suresh</div>
																	<div class="text-center mrgn25" style="font-size:18px">
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;">12</div>
																		 <div class="fntsze13" style="background:#f9f9f9;border-left:1px solid #888;border-right:1px solid #888;">12:15</div>
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;"><i class="fa fa-inr"></i> 9,566</div>
																		 
																		 <div class="fntsze13" style="margin-top:30px"><i class="fa fa-user"></i> View Profile</div>
																		 

																		 <div class="fntsze13" style="margin-top:10px;padding-left:10px"><i class="fa fa-bar-chart"></i> View Analytics</div>
																		 
																		 
																	</div>	
																 </div>
																 

																 <div class="flrbox">
																	<div class="text-center mrgn15"><img src="<?php echo base_url(); ?>assets/img/user.png" /></div>
																	<div class="text-center mrgn15 fntsze10" style=""><img src="<?php echo base_url(); ?>assets/img/green_icon.png" /> Online</div>
																	<div class="text-center mrgn25 clr666" style="font-size:18px">Suresh</div>
																	<div class="text-center mrgn25" style="font-size:18px">
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;">12</div>
																		 <div class="fntsze13" style="background:#f9f9f9;border-left:1px solid #888;border-right:1px solid #888;">12:15</div>
																		 <div class="fntsze13" style="background:#EDEDED;border:1px solid #888;"><i class="fa fa-inr"></i> 9,566</div>
																		 
																		 <div class="fntsze13" style="margin-top:30px"><i class="fa fa-user"></i> View Profile</div>
																		 

																		 <div class="fntsze13" style="margin-top:10px;padding-left:10px"><i class="fa fa-bar-chart"></i> View Analytics</div>
																		 
																		 
																	</div>	
																 </div>
																 
																 
																 
															 </div>
															  
															  <!-- Close slider-->
															  
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
			