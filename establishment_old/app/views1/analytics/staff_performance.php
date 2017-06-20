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
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
	
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>

		
        <div class="wrapper wrapper-content" id="leftWrapper">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Performance Section</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									</div>
								</div>
								
								
								<div class="ibox-content">
								    <div class="row">
										<div style="text-align:center" class="col-lg-12">
											<div class="contact-box">
											   <h3><strong>Basic Information</strong></h3><br />
												<a href="profile.html">
													<div style="text-align:right" class="col-sm-6">
														<div class="text-right pull-right" style="margin-right:10px">
															<img alt="image" class="img-circle m-t-xs img-responsive" src="http://webapplayers.com/inspinia_admin-v2.5/img/a1.jpg">
															<div class="m-t-xs font-bold">Service Employee</div>
														</div>
													</div>
													<div style="text-align:left" class="col-sm-6">
														<h3><strong>John Smith</strong></h3>
														<p><i class="fa fa-user"></i> Emp Id: 12345</p>
														<p><i class="fa fa-mobile"></i> 989898988</p>
														<p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
														<p><button class="btn btn-primary"><i class="fa fa-edit"></i> </button> <button class="btn btn-danger"><i class="fa fa-trash"></i> </button></p>
													</div>
												   <div class="clearfix"></div>
												</a>
											</div>
										</div>
									</div>

									<div class="row">
									  <div style="text-align:center" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%">
										   <h3><strong>Potential Business Generated</strong></h3><br />
										   <div style="font-size:15px" class="col-sm-3">
											  <p>March 2016 (Last month)</p>
											  <p><strong>Rs. 65,000 /-</strong></p>
										   </div>
										   
										   <div style="font-size:15px" class="col-sm-3">
											   <p>April 2016 (This month so far)</p>
											   <p><strong>Rs. 15,000 /-</strong></p>
										   </div>
										   
										   <div class="col-sm-6">
											   <div style="height:200px;width:400px;margin:0 auto" id="container"></div>
										   </div>
										   
										    <div class="row">
												<div class="col-md-12">

												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date1" class="form-control" placeholder="Start Date" id="start_date1">
												  </div>
												  
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date1" class="form-control" value="" placeholder="End Date" id="end_date1">
												  </div>
									
												  
												  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												   
											     </div>
										    </div>
											
											
											
										</div>
									  </div>
									</div>
									
									
									<div class="row">
									  <div style="text-align:center" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%">
										   <h3><strong>Numbers Of Orders Completed</strong></h3><br />
										   
										    <div class="row">
											   <div style="font-size:15px" class="col-sm-3">
												  <p>5<sup>th</sup> April 2016 (Yesterday)</p>
												  <p><strong>15</strong></p>
											   </div>
											   
											   <div style="font-size:15px" class="col-sm-3">
												   <p>6<sup>th</sup> April 2016 (Today so far)</p>
												   <p><strong>12</strong></p>
											   </div>
											   
											   <div class="col-sm-6">
												  <div style="height:200px;width:400px;margin:0 auto" id="container1"></div>
											   </div>
										    </div>
										   
										   
										    <div class="row">
												<div class="col-md-12">

												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date2" class="form-control" placeholder="Start Date" id="start_date2">
												  </div>
												  
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date2" class="form-control" value="" placeholder="End Date" id="end_date2">
												  </div>
									
												  
												  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												 
												   
												   
												   
												   
											     </div>
										    </div>
										   
										   
										   
										   
										   
										</div>
									  </div>
									</div>
									
									
									
									
									
									<div class="row">
									  <div style="text-align:center" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%">
										   <h3><strong>Average Order Completion Time</strong></h3><br />
										   <div style="font-size:15px" class="col-sm-3">
											  <p>17<sup>th</sup>-24<sup>th</sup> April 2016</p>
											  <p><strong>20m 12s</strong></p>
										   </div>
										   
										   <div style="font-size:15px" class="col-sm-3">
											   <p>24<sup>th</sup>-30<sup>th</sup> April 2016</p>
											   <p><strong>12</strong></p>
										   </div>
										   
										   <div class="col-sm-6">
												  <div style="height:200px;width:400px;margin:0 auto" id="container2"></div>
											</div>
										  
										   <!--<div class="col-sm-6">
											   <p><strong>View for:</strong></p>
											   
											   <div class="radio radio-success text-center">
												<input type="radio" name="status" value="1" id="radio1" />
												<label for="radio1">Entire Week</label>
										       </div>
											   
											   <div class="radio radio-success text-center">
												<input type="radio" name="status" value="1" id="radio1" />
												<label for="radio1">Last Month</label>
										       </div>
											   
											   <div class="radio radio-success text-center">
												<input type="radio" name="status" value="1" id="radio1" />
												<label for="radio1">Date Range</label>
										       </div>

											   <p><input type="submit" class="btn btn-info" value="Display Data" /></p>
										   </div> -->
										   
										    <div class="row">
												<div class="col-md-12">

												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date3" id="start_date3" class="form-control" placeholder="Start Date">
												  </div>
												  
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date3" class="form-control" value="" placeholder="End Date" id="end_date3">
												  </div>
									
												  
												  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												   
											     </div>
										    </div>
											
											
											
										   
										   
										   
										</div>
									  </div>
									</div>
									
									
									<div class="row">
										<div style="text-align:center" class="col-lg-12">
										   <div class="contact-box pull-left" style="width:100%">
											    <h3><strong>List of All Orders</strong></h3><br />
												  <div class="table-responsive">
													<table class="table table-striped table-bordered table-hover dataTables-example" >
														<thead>
														<tr>
															<th class="text-center">S No</th>
															<th class="text-center">Order Id</th>
															<th class="text-center">Time & Date</th>
															<th class="text-center">Delivery Status</th>
															<th class="text-center">Location</th>
															<th class="text-center">Order Completion Time</th>
															<th class="text-center">Amount</th>
														</tr>
														</thead>
														<tbody>
															<tr class="gradeX">
																<td style="color:#1BA301">1</td>
																<td style="color:#1BA301">543622</td>
																<td style="color:#1BA301">07:52, April 3, 2016 </td>
																<td style="color:#1BA301">Delivered</td>
																<td class="text-center">Table no. 5</td>
																<td class="text-center">10m 2 s</td>
																<td class="text-center">Rs. 1083 /-</td>
															</tr>
															

													
														</tbody>
														<tfoot>
															<tr>
																<th class="text-center">S No</th>
																<th class="text-center">Order Id</th>
																<th class="text-center">Time & Date</th>
																<th class="text-center">Delivery Status</th>
																<th class="text-center">Location</th>
																<th class="text-center">Order Completion Time</th>
																<th class="text-center">Amount</th>
															</tr>
														</tfoot>
													</table>
												 </div> 
												 
												 
												<!-- <div class="text-center">
											   
											       <div class="text-center radio-inline">
													<label for="radio1"><strong>View for:</strong></label>
												   </div>
												   
												   
												   <div class="radio radio-success text-center radio-inline">
													<input type="radio" name="status" value="1" id="radio1" />
													<label for="radio1">Entire Week</label>
												   </div>
												   
												   <div class="radio radio-success text-center radio-inline">
													<input type="radio" name="status" value="1" id="radio1" />
													<label for="radio1">Last Month</label>
												   </div>
												   
												   <div class="radio radio-success text-center radio-inline">
													<input type="radio" name="status" value="1" id="radio1" />
													<label for="radio1">Date Range</label>
												   </div>

												   &nbsp;&nbsp;<input type="submit" class="btn btn-info" value="Display Data" />
											    </div>-->
												
											<div class="row">
												<div class="col-md-12">

												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" class="form-control" placeholder="Start Date" id="start_date4">
												  </div>
												  
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" class="form-control" value="" placeholder="End Date" id="end_date4">
												  </div>
									
												  
												  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												   
											     </div>
										    </div>
											   
												 
											 
											</div>
										</div>
										
										
										
										
									</div>
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
										
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
	
	<script>
	$(document).ready(function(){
		
		
		   $('#start_date1, #end_date1, #start_date2, #end_date2, #start_date3, #end_date3, #start_date4, #end_date4').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			
			

						// Create the chart
						$('#container').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: 'Completed Orders'
							},
							xAxis: {
								type: 'category'
							},
							yAxis: {
								title: {
									text: '<strong>Orders No.</strong>'
								}

							},
							legend: {
								enabled: false
							},
							plotOptions: {
								series: {
									borderWidth: 0,
									dataLabels: {
										enabled: true,
										format: '{point.y}'
									}
								}
							},

							tooltip: {
								headerFormat: '<span style="font-size:11px">Completed Orders</span><br>',
								pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
							},

							series: [{
								name: 'Completed Orders',
								color: '#2A3F54',
								data: [{
									name: 'May',
									y: 15,
									drilldown: 'May'
								}, {
									name: 'Jun',
									y: 16,
									drilldown: 'Jun'
								}, {
									name: 'Jul',
									y: 19,
									drilldown: 'Jul'
								}, {
									name: 'Aug',
									y: 21,
									drilldown: 'Aug'
								}, {
									name: 'Sep',
									y: 22,
									drilldown: 'Sep'
								}]
							}],
							drilldown: {
								series: [{
									name: 'May',
									id: 'May',
									data: [
											[15]
										  ]
								}, {
									name: 'Jun',
									id: 'Jun',
									data: [
											[16]
										  ]
								}, {
									name: 'Jul',
									id: 'Jul',
									data: [
											[19]
										  ]
								}, {
									name: 'Aug',
									id: 'Aug',
									data: [
											[21]
										  ]
								}, {
									name: 'Sep',
									id: 'Sep',
									data: [
											[22]
										  ]
								}]
							}
						});
						
						
						
						$('#container1').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: 'Completed Orders'
							},
							xAxis: {
								type: 'category'
							},
							yAxis: {
								title: {
									text: '<strong>Orders No.</strong>'
								}

							},
							legend: {
								enabled: false
							},
							plotOptions: {
								series: {
									borderWidth: 0,
									dataLabels: {
										enabled: true,
										format: '{point.y}'
									}
								}
							},

							tooltip: {
								headerFormat: '<span style="font-size:11px">Completed Orders</span><br>',
								pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
							},

							series: [{
								name: 'Completed Orders',
								color: '#2A3F54',
								data: [{
									name: 'May',
									y: 15,
									drilldown: 'May'
								}, {
									name: 'Jun',
									y: 16,
									drilldown: 'Jun'
								}, {
									name: 'Jul',
									y: 19,
									drilldown: 'Jul'
								}, {
									name: 'Aug',
									y: 21,
									drilldown: 'Aug'
								}, {
									name: 'Sep',
									y: 22,
									drilldown: 'Sep'
								}]
							}],
							drilldown: {
								series: [{
									name: 'May',
									id: 'May',
									data: [
											[15]
										  ]
								}, {
									name: 'Jun',
									id: 'Jun',
									data: [
											[16]
										  ]
								}, {
									name: 'Jul',
									id: 'Jul',
									data: [
											[19]
										  ]
								}, {
									name: 'Aug',
									id: 'Aug',
									data: [
											[21]
										  ]
								}, {
									name: 'Sep',
									id: 'Sep',
									data: [
											[22]
										  ]
								}]
							}
						});
						
						
						$('#container2').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: 'Completed Orders'
							},
							xAxis: {
								type: 'category'
							},
							yAxis: {
								title: {
									text: '<strong>Orders No.</strong>'
								}

							},
							legend: {
								enabled: false
							},
							plotOptions: {
								series: {
									borderWidth: 0,
									dataLabels: {
										enabled: true,
										format: '{point.y}'
									}
								}
							},

							tooltip: {
								headerFormat: '<span style="font-size:11px">Completed Orders</span><br>',
								pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
							},

							series: [{
								name: 'Completed Orders',
								color: '#2A3F54',
								data: [{
									name: 'May',
									y: 15,
									drilldown: 'May'
								}, {
									name: 'Jun',
									y: 16,
									drilldown: 'Jun'
								}, {
									name: 'Jul',
									y: 19,
									drilldown: 'Jul'
								}, {
									name: 'Aug',
									y: 21,
									drilldown: 'Aug'
								}, {
									name: 'Sep',
									y: 22,
									drilldown: 'Sep'
								}]
							}],
							drilldown: {
								series: [{
									name: 'May',
									id: 'May',
									data: [
											[15]
										  ]
								}, {
									name: 'Jun',
									id: 'Jun',
									data: [
											[16]
										  ]
								}, {
									name: 'Jul',
									id: 'Jul',
									data: [
											[19]
										  ]
								}, {
									name: 'Aug',
									id: 'Aug',
									data: [
											[21]
										  ]
								}, {
									name: 'Sep',
									id: 'Sep',
									data: [
											[22]
										  ]
								}]
							}
						});
					
						
						
						

						});

    </script>
	
</body>

</html>
			