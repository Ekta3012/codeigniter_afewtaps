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
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
	
	
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>

		
        <div class="wrapper wrapper-content">
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
											   <div style="height:300px;width:400px;margin:0 auto" id="container"></div>
										   </div>
										</div>
									  </div>
									</div>
									
									
									<div class="row">
									  <div style="text-align:center" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%">
										   <h3><strong>Numbers Of Orders Completed</strong></h3><br />
										   <div style="font-size:15px" class="col-sm-3">
											  <p>5<sup>th</sup> April 2016 (Yesterday)</p>
											  <p><strong>15</strong></p>
										   </div>
										   
										   <div style="font-size:15px" class="col-sm-3">
											   <p>6<sup>th</sup> April 2016 (Today so far)</p>
											   <p><strong>12</strong></p>
										   </div>
										   
										   <div class="col-sm-6">
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
															<th>S No</th>
															<th>Coupon Code</th>
															<th>Coupon Type</th>
															<th>Description</th>
															<th>Start Date</th>
															<th>End Date</th>
															<th>Action</th>
														</tr>
														</thead>
														<tbody>
															<tr class="gradeX">
																<td>1</td>
																<td>Internet
																	Explorer 4.0
																</td>
																<td>Win 95+</td>
																<td>Win 95+</td>
																<td class="text-center">4</td>
																<td class="text-center">X</td>
																<td class="text-center"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button> <button class="btn btn-danger"><i class="fa fa-trash"></i> </button></td>
															</tr>
															

													
														</tbody>
														<tfoot>
															<tr>
																<th>S No</th>
																<th>Coupon Code</th>
																<th>Coupon Type</th>
																<th>Description</th>
																<th>Start Date</th>
																<th>End Date</th>
																<th>Action</th>
															</tr>
														</tfoot>
													</table>
												 </div> 
												 
												 
												<div class="text-center">
											   
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

	
	
	
	
	
	<script>
        $(document).ready(function(){
			
			
			$('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'TaxFile'},
                    {extend: 'pdf', title: 'TaxFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
			
			
			
           

		   $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Completed Orders'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Orders'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px;font-weight:bold">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:11px">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.1,
                borderWidth: 0
            }
        },
        series: [{
			color: '#1ab394',
            name: 'Completed Orders',
            data: [49.9, 71.5, 100.4, 129.2, 144.0, 176.0, 135.6, 148.5, 116.4, 194.1, 95.6, 54.4]

        }]
    });
	
	
	
	
	
        });
    </script>
	
</body>

</html>
			