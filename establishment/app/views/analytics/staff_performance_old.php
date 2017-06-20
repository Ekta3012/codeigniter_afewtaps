<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?></title>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
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

	   <div id="toggle" style="display:none;position:absolute;right:230px;top:60px;text-align:right"><a href="javascript:void(0);" style="cursor:pointer"><strong>Hide</strong></a></div>
		 
		 <span id="notfiyCount" style="cursor:pointer" class="badge badge-info pull-right"></span>
		 
		 
	     <div class="sidebard-panel" style="display:none">
                <?php $this->load->view('include/inc_sidebar'); ?>
         </div>
		 
		
        <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
							
								<div class="ibox-content">
								
								<?php echo form_open('analytics/staffAnalytics', array('id' => 'frm')); ?>
								
								    <div class="row text-center">
									
									    <div class="col-lg-2">						
						                </div>
										  
										<div class="col-lg-2">
										</div>
										  
										  
									    <div class="col-lg-3">
											<select onchange="branchStaff(this.value)" name="employee" class="form-control m-b">
											    <option value="">-- Employee Name --</option>
												 <?php 
												    if (count($response['staff_members']) > 0)
												        {
													        foreach ($response['staff_members'] as $rdata)
															  {
																$selected = ($rdata->id == $sid) ? "selected='selected'" : "" ;
																echo '<option '.$selected.' value="'.$rdata->id.'">'.ucwords($rdata->name).'</option>';
															  }
														    
												        }
												 ?>
											</select>							
						                </div>
										  
										  <div class="col-lg-2">
											 					
						                  </div>
										  
									</div>
									
								<?php echo form_close(); ?>
									
									
								<?php
 								  if ( ! empty ($response['staff_member_data'])) { ?>
									
								    <div class="row">
										<div style="text-align:left" class="col-lg-12">
											<div class="contact-box" style="border:0">
											   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Staff Performance Section</div>
												<a href="#">
													<div style="text-align:right;margin:20px 0 0 0" class="col-sm-6">
														<div class="text-right pull-right" style="margin-right:10px">
														 
														 <?php
														   if (isset($response['staff_member_data']))
															   {
																   $pic = $response['staff_member_data']->pic;
																   if ( ! empty ($pic))
																    {
																	   echo '<img alt="image" class="img-circle m-t-xs img-responsive" src="'.base_url().'../uploads/'.$pic.'" width="100" />';
																	}
																   else
																	   
																	   {
																			echo '<img alt="image" class="img-circle m-t-xs img-responsive" src="'.base_url().'assets/img/user_icon.png" width="80" />';
																	   }
																   
															   }
														?>
															
														</div>
													</div>
													<div style="text-align:left;margin:25px 0 0 0" class="col-sm-6">
														<h3><strong><?php echo isset ($response['staff_member_data']) ? ucwords($response['staff_member_data']->name) : '' ; ?></strong></h3>
														<p><i class="fa fa-user"></i> Emp Id: <?php echo isset ($response['staff_member_data']) ? $response['staff_member_data']->employee_id : '' ; ?></p>
														<p><i class="fa fa-mobile"></i> <?php echo isset ($response['staff_member_data']) ? $response['staff_member_data']->contact_no : '' ; ?></p>
													</div>
												   <div class="clearfix"></div>
												</a>
											</div>
										</div>
									</div>

									<div class="row">
									  <div style="text-align:left" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%;border:0">
										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Potential Business Generated</div><br />
										   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
											  <p class="text-center"><?php echo $response['last_month_name']; ?> (Last month)</p>
											  <p class="text-center" style="font-size:20px"><strong>Rs. <?php echo $response['last_month_business']; ?> /-</strong></p>
										   </div>
										   
										   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
											   <p class="text-center"><?php echo date('F Y'); ?> (This month so far)</p>
											   <p class="text-center" style="font-size:20px"><strong>Rs. <?php echo $response['this_month_price']; ?> /-</strong></p>
										   </div>
										   
										   <div class="col-sm-6">
											   <div style="height:200px;width:400px;margin:0 auto;margin:20px 0 0 0" id="container"></div>
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
													 <input type="submit" class="btn btn-primary" value="Filter" id="filter1" />
												  </div>   
												   
											     </div>
										    </div>
											
										</div>
									  </div>
									</div>
									
									
									<div class="row">
									  <div style="text-align:left" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%;border:0">

										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Numbers Of Orders Completed</div><br />
										   
										    <div class="row">
											   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
												  <p class="text-center"><?php echo $response['last_month_name']; ?> (Last month)</p>
												  <p class="text-center" style="font-size:20px"><strong><?php echo $response['last_month_order']; ?></strong></p>
											   </div>
											   
											   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
												   <p class="text-center"><?php echo date('F Y'); ?> (Today so far)</p>
												   <p class="text-center" style="font-size:20px"><strong><?php echo $response['this_month_orders']; ?></strong></p>
											   </div>
											   
											   <div class="col-sm-6">
												  <div style="height:200px;width:400px;margin:20px 0 0 0" id="container1"></div>
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
													 <input type="submit" class="btn btn-primary" value="Filter" id="filter2" />
												  </div>   
												 
												   
											     </div>
										    </div>
										   
										</div>
									  </div>
									</div>
									
									<div class="row">
									  <div style="text-align:left" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%;border:0">

										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Average Order Completion Time</div><br />
										   
										   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
											  <p class="text-center"><?php echo $response['last_month_name']; ?> (Last month)</p>
											  <p class="text-center" style="font-size:20px"><strong><?php echo $response['last_month_average_time']; ?></strong></p>
										   </div>
										   
										   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
											   <p class="text-center"><?php echo date ('F Y'); ?></p>
											   <p class="text-center" style="font-size:20px"><strong><?php echo $response['this_month_average_time']; ?></strong></p>
										   </div>
										   
										   <div class="col-sm-6">
												  <div style="height:200px;width:400px;margin:20px 0 0 0" id="container2"></div>
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
													 <input type="submit" class="btn btn-primary" value="Filter" id="filter3" />
												  </div>   
												   
											     </div>
										    </div>
										   
										</div>
									  </div>
									</div>
									
									
									<div class="row">
										<div style="text-align:left" class="col-lg-12">
										
										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">List of All Orders</div>
										   
										    <div class="contact-box pull-left" style="width:100%;border:none">

												  <div class="table-responsive">
													<table class="table table-striped table-bordered table-hover dataTables-example" >
														<thead>
    <tr>
        <th class="text-center">S No</th>
        <th class="text-center">Order#</th>
        <th class="text-center">Time & Date</th>
        <th class="text-center">Delivery Status</th>
        <th class="text-center">Location</th>
        <th class="text-center">Order Completion Time</th>
        <th class="text-center">Amount</th>
    </tr>
														</thead>
														
														 <tbody id='orders'>
														 <?php
														   $i = 0;
														   if (count($response['orders']) > 0)
														   {
															   
															   foreach ($response['orders'] as $odata) 
																   {
																	   $i++;
																	   $order_completion_time = '';
																	   if ( ! empty ($odata->completion_time))
																		   {
																			   // $diff = floor ($odata->completion_time - $odata->order_time) / 60;
																			   
																			    $total_time = $odata->completion_time - $odata->order_time;     
																				$hours      = floor ($total_time /3600); 
																				$minutes    = intval (($total_time/60) % 60);        
																				$seconds    = intval ($total_time % 60);     

																				if ($hours > 0) 
																				$order_completion_time  .=  str_pad($hours, 2, 0, STR_PAD_LEFT)."h ";      

																			    if ($minutes > 0)
																				$order_completion_time  .=  str_pad($minutes, 2, 0, STR_PAD_LEFT)."m ";

																			    if ($seconds > 0)
																				$order_completion_time  .=  str_pad($seconds, 2, 0, STR_PAD_LEFT)."s";
										
																		   }
																	   else
																		   {
																			    $order_completion_time = '---'; 
																		   }
																		       
																	   
																	   switch ($odata->status)
																			{
																				case 1:
																						 $order_status = "In Preparation";
																						 break;
																				case 2:
																				case 5:
																						 $order_status = "In Priority";
																						 break;
																				case 3:
																						 $order_status = "Completed";
																						 break;
																				case 4:
																						 $order_status = "Cancelled";
																						 break;
																			}
																		
																	   
																	   echo '<tr class="gradeX">
																				<td class="text-center">'.$i.'</td>
																				<td class="text-center">'.$odata->order_id.'</td>
																				<td class="text-center">'.date('h:i A, F d Y', $odata->order_time).'</td>
																				<td class="text-center" style="color:#1BA301">'.$order_status.'</td>
																				<td class="text-center">'.$odata->location.'</td>
																				<td class="text-center">'.$order_completion_time.'</td>
																				<td class="text-center">Rs. '.$odata->total_amount.' /-</td>
																			 </tr>';
																   }
														   }
														 
														 
														 ?>
															
														 </tbody>
														
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
													 <input type="submit" class="btn btn-primary" value="Filter" id="filter4" />
												  </div>   
												  
												  
												  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="_token" />
							
												   
											     </div>
										    </div>
											   
												 
											 
											</div>
										</div>
										
										
									</div>
									
									
									
									
									<?php } ?>
									
									
									
									
										
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
	

	
	<script>
	$(document).ready(function(){
		
		
		   $('#start_date1, #end_date1, #start_date2, #end_date2, #start_date3, #end_date3, #start_date4, #end_date4').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			
                    <?php
                      if ($this->uri->segment(3))
					  {
					?>				  

						// Create the chart
						$('#container').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: ''
							},
							xAxis: {
								type: 'category'
							},
							yAxis: {
								title: {
									text: '<strong>Orders #</strong>'
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
								data: <?php echo $response['business']; ?>
							}],
							drilldown: {
								series: <?php echo $response['business']; ?>
							}
						});
						
						
						
						$('#container1').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: 'Total Orders'
							},
							xAxis: {
								type: 'category'
							},
							yAxis: {
								title: {
									text: '<strong>Orders #</strong>'
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
								headerFormat: '<span style="font-size:11px">Total Orders</span><br>',
								pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
							},

							series: [{
								name: 'Completed Orders',
								color: '#2A3F54',
								data: <?php echo $response['order']; ?>
							}],
							
							drilldown: {
								series: <?php echo $response['order']; ?>
							}
						});
						
						
						$('#container2').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: 'Average Time'
							},
							xAxis: {
								type: 'category'
							},
							yAxis: {
								title: {
									text: '<strong>Orders #</strong>'
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
								headerFormat: '<span style="font-size:11px">Average Time</span><br>',
								pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
							},

							series: [{
								name: 'Completed Orders',
								color: '#2A3F54',
								data: <?php echo $response['avg_time']; ?>,
							}],
							drilldown: {
								series: <?php echo $response['avg_time']; ?>,
							}
						});
						
						
					  <?php } ?>
						
						
					
					});
						
	
	
	$("#filter1").click(function() {
		
		$(this).addClass('icon-spinner icon-spin icon-large');
		
		      var sdate = $.trim($("#start_date1").val());
		      var edate = $.trim($("#end_date1").val());
			  
			  
		      var _tokenName = $.trim($("#_token").attr('name'));
		      var _tokenVal  = $.trim($("#_token").val());

			  var resp;
			  $.ajax({
						url: '<?php echo base_url(); ?>index.php/analytics/getStaffAnalyticsData',
						type: "POST",
						dataType: "json",
						data : { sdate : sdate, edate : edate, csrf_token : _tokenVal },
						success: function(rdata) {
							

							 $("#_token").attr('value', rdata.token);
							
							 resp = rdata.result;
							
							chart = new Highcharts.Chart({
								
								chart: {
									
						renderTo: 'container',			
						type: 'column'
					},
					title: {
						text: ''
					},
					xAxis: {
						type: 'category'
					},
					yAxis: {
						title: {
							text: '<strong>Orders #</strong>'
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
						headerFormat: '<span style="font-size:11px">Business Generated</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span> - Rs: <b>{point.y}</b><br/>'
					},

					series: [{
						name: '',
						color: '#349313',
						data: resp
					}],
					drilldown: {
						series: resp
					}
															
							});
							

						},
						cache: false
					});

	});
	
	
	$("#filter2").click(function() {
		
		$(this).addClass('icon-spinner icon-spin icon-large');
		
		      var sdate = $.trim($("#start_date2").val());
		      var edate = $.trim($("#end_date2").val());
			  
			  var _tokenName = $.trim($("#_token").attr('name'));
		      var _tokenVal  = $.trim($("#_token").val());
			  
			  var resp;
			  $.ajax({
						url: '<?php echo base_url(); ?>index.php/analytics/getTotalOrdersAnalyticsData',
						type: "POST",
						dataType: "json",
						data : { sdate : sdate, edate : edate, csrf_token : _tokenVal },
						success: function(rdata) {
							
							 
							 $("#_token").attr('value', rdata.token);
							 
							 
							 resp = rdata.result;
							
							chart = new Highcharts.Chart({
								
								chart: {
									
						renderTo: 'container1',			
						type: 'column'
					},
					title: {
						text: ''
					},
					xAxis: {
						type: 'category'
					},
					yAxis: {
						title: {
							text: '<strong>Orders #</strong>'
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
						headerFormat: '<span style="font-size:11px">Business Generated</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span> - Rs: <b>{point.y}</b><br/>'
					},

					series: [{
						name: '',
						color: '#349313',
						data: resp
					}],
					drilldown: {
						series: resp
					}
															
							});
							

						},
						cache: false
					});

	});
	
	
	$("#filter3").click(function() {
		
		$(this).addClass('icon-spinner icon-spin icon-large');
		
		      var sdate = $.trim($("#start_date3").val());
		      var edate = $.trim($("#end_date3").val());
			  
			  var _tokenName = $.trim($("#_token").attr('name'));
		      var _tokenVal  = $.trim($("#_token").val());

			  var resp;
			  $.ajax({
						url: '<?php echo base_url(); ?>index.php/analytics/getAvgTimeAnalyticsData',
						type: "POST",
						dataType: "json",
						data : { sdate : sdate, edate : edate, csrf_token : _tokenVal },
						success: function(rdata) {
							
							
							  $("#_token").attr('value', rdata.token);
							
							 resp = rdata.result;
							
							chart = new Highcharts.Chart({
								
								chart: {
									
						renderTo: 'container2',			
						type: 'column'
					},
					title: {
						text: ''
					},
					xAxis: {
						type: 'category'
					},
					yAxis: {
						title: {
							text: '<strong>Orders #</strong>'
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
						headerFormat: '<span style="font-size:11px">Business Generated</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span> - Rs: <b>{point.y}</b><br/>'
					},

					series: [{
						name: '',
						color: '#349313',
						data: resp
					}],
					drilldown: {
						series: resp
					}
															
							});
							

						},
						cache: false
					});

	});
	
	
	
	$("#filter4").click(function() {
		
		$(this).addClass('icon-spinner icon-spin icon-large');
		
		      var sdate         =   $.trim($("#start_date4").val());
		      var edate         =   $.trim($("#end_date4").val());

			  var tokenName     =   $.trim($("#_token").attr('name'));

		      var tokenVal      =   $.trim($("#_token").val());

			  var data          = 	{};
              data[tokenName]   = 	tokenVal
              data['sdate']     = 	sdate
              data['edate']     = 	edate

			  var resp;
			  $.ajax({
						url: '<?php echo base_url(); ?>index.php/analytics/getAjaxOrders',
						type: "POST",
						dataType: "json",
						data : data,
						success: function(rdata) {
							
							$("#_token").attr('value', rdata.token);
							
							var Html = '';
							if (parseInt(rdata.result.length) > 0)
								{
									$.each(rdata.result,function(E,F) 
									  {
								         Html += '<tr class="gradeX"><td class="text-center">1</td><td class="text-center">' + F.oid +'</td><td class="text-center">' + F.time +'</td><td class="text-center" style="color:#1BA301">' + F.status +'</td><td class="text-center">' + F.loc +'</td><td class="text-center">' + F.ctime + '</td><td class="text-center">Rs. ' + F.amt +' /-</td></tr>';
									  });
								}
							else
								{
										 Html += '<tr class="gradeX"><td class="text-center" colspan=\'7\'>Sorry No Data Found .!</td></tr>';
								}
										 $('#orders').html(Html);
							 
						}
					});

	});
	
	
	function branchStaff(id = '')
		{
			location.href = "<?php echo base_url(); ?>index.php/analytics/staffAnalytics/" + id;
		}
	
	

    </script>
	
</body>

</html>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
			