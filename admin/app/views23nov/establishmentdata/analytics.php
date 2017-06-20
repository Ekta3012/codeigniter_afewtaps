<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?></title>
<link href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">

<!--script-->

	<style>
	.row.text-center {
    background-color: rgb(199, 199, 199);
    border-radius: 14px;
	 margin-bottom: 20px;
}
.row.text-center .active {
    background-color: rgb(42, 63, 84);
    border-radius: 7px;
    box-shadow: none !important;
    color: #fff;
    margin-top: 5px;
}
.nonactive{color:#000}
#slide{
border:1.5px solid black;
position:absolute;
top:0;
left:0;
width:150px;
height:100%;
background-color:#F2F2F2;
layer-background-color:#F2F2F2;
}

.slides {
    width: 65%;
    overflow: auto;
	margin-top:20px
}
.slides ul {
    display: inline-block;
    height: 28px;
    white-space: nowrap;
}
.slides ul li {
    height: 100%;
    width: auto;
    display: inline-block;
    /*float: left;*/
    margin: 2px;
	margin:5px 10px;
	text-align:center;
	cursor:pointer
}

.vg{background:url('../../../assets/img/red_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
.nonvg{background:url('../../../assets/img/green_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}


.addMenu{background:#2A3F54;color:#FFF}
.btn:focus, .btn:hover{color:#FFF}
.liactive {border-bottom:2px solid #404040;cursor:not-allowed !important}
.btn-w-m{min-width:0}
</style>
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
							 <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Establishment Data</div>
								<div class="ibox-content">
                                 
                                <div class="row">
                                  <div class="col-md-4"></div>
                                       <div class="col-md-4">

                             <?php 
									$branches = getAllBranches();
									if (count($branches) > 0)
									  {
										 echo '<select class="form-control m-b" name="branch" onchange="branchStaff(this.value)">';
										 echo '<option value="">Select Establishment</option>';
										 foreach ($branches as $bdata)
										   {
											 
											   $selected = ($this->uri->segment('3') == $bdata->{'userid'}) ? "selected='selected'" : "" ;
											   echo "<option $selected value='".$bdata->{'userid'}."'>".$bdata->{'name'}."</option>";
										   }
										   echo '</select>';
									  }
										   $userid = $this->uri->segment('3') ;
								?>
                                        </div>
                                           
										<div class="col-md-4"></div>		   
											     </div>
                                 <?php
								    $segment = $this->uri->segment(2);
									 switch ($segment)
										 {
											  case 'order':
											            $orderitem    = 'active';
														break;
											case 'inside':
											            $insideitem    = 'active';
														break;
											case 'analytics':
											            $analyticsitem    = 'active';
														break;
											case 'ratings':
											            $ratingsitem    = 'active';
														break;
											case 'menu/1':
											            $menuitem    = 'active';
														break;
											
											case 'merchant':
											            $merchantinfor    = 'active';
														break;
														
														
										 }
								  ?>
                                
								  <div class="row text-center">
                                  <a href="<?php echo base_url(); ?>index.php/establishmentdata/order/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($orderitem) ? $orderitem : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
                                    
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
									 
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/location"><button class="btn <?php echo isset($locationitem) ? $locationitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Location</button></a>
									  
                                              
                                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>

								  </div>
									<div class="row">
									  <div style="text-align:left" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%;border:0">
										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Potential Business Generated</div><br />
										   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
											  <p><?php echo $prev_month; ?> (Last month)</p>
											   <p><strong>Rs. <?php echo number_format((float)$prev_business, 2, '.', ''); ?> /-</strong></p>
										   </div>
										   
										   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
											   <p><?php echo $current_month; ?> (This month so far)</p>
											  <p><strong>Rs. <?php echo number_format((float)$current_business, 2, '.', ''); ?> /-</strong></p>
										   </div>
										
										   <div class="col-md-4">
											   <div id="container" style="height:300px;width:400px;margin:0 auto"></div>
										   </div>
										    <?php echo validation_errors(); ?>
								<?php echo form_open('', array('class' => 'form-horizontal')); ?>
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
										<?php echo form_close(); ?>	 	
										</div>
									  </div>
									</div>
									
									
									<div class="row">
									  <div style="text-align:left" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%;border:0">

										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Numbers Of Orders Completed</div><br />
										   
										    <div class="row">
											   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
												  <p class="text-center">5<sup>th</sup> April 2016 (Yesterday)</p>
												  <p class="text-center" style="font-size:20px"><strong>15</strong></p>
											   </div>
											   
											   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
												   <p class="text-center">6<sup>th</sup> April 2016 (Today so far)</p>
												   <p class="text-center" style="font-size:20px"><strong>12</strong></p>
											   </div>
											   
											   <div class="col-sm-6">
												  <div id="container1" style="height:300px;width:400px;margin:0 auto"></div>
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
									  <div style="text-align:left" class="col-lg-12">
									    <div class="contact-box pull-left" style="width:100%;border:0">

										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Average Order Completion Time</div><br />
										   
										   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
											  <p><?php echo $prev_month; ?> (Last month)</p>
										
										   </div>
										   
										   <div style="font-size:15px;margin:20px 0 0 0" class="col-sm-3">
											  <p><?php echo $current_month; ?> (This month so far)</p>
										   </div>
										   
										   <div class="col-sm-6">
												  <div style="height:200px;width:400px;margin:20px 0 0 0" id="container2"></div>
											</div>
									
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
										<div style="text-align:left" class="col-lg-12">
										
										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">List of All Orders</div>
										   
										    <div class="contact-box pull-left" style="width:100%;border:none">

												   <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
								<tr style="font-size:11px">
									<th>S No</th>
									<th>Order #</th>
									<th>Time &amp; Date</th>
                                    
                                    <th>Delivery Status</th>
                                    <th>Location</th>
									<th>Order Completion Time</th>
									<th>Amount</th>
									
                                   
								</tr>
								</thead>
								<tbody>
                                <?php
							
								   if (count($order) > 0)
									   {
										   $i = 0;
										   //$total_price_sum = 0; 
										   foreach ($order as $data)
											   {
												
												   $i++;
												   switch($data->{'status'}){
													   case 1 :
													    $status = "Preparation";
													   break;
													   case 2 :
													    $status = "Priority";
													   break;
													   case 3 :
													   $status = "Completed";
													   break;
													    case 4 :
													    $status = "Cancelled";
													   break;
													   case 5 :
													    $status = "Threshold";
													   break;
													   
												   }
												  
												  
												   echo '<tr class="">
												            <td>'.$i.'</td>
															
															<td><a href="'.base_url().'index.php/establishmentdata/view/'.$data->{'order_id'}.'">'.$data->{'order_id'}.'</a></td>
															
															<td>'.date('h:i A, M d Y', $data->order_time).'</td>
															
																<td>'.$status.'</td>
																<td>'.$data->{'location'}.'</td>
															<td>'.date('h:i', $data->completion_time).'</td>
															<td>'.$data->{'total_amount'}.'</td>
															sss
															
														
														 </tr>';
														 
														//$total_price_sum = $total_price_sum + $data->{'total_amount'};
														 
											   }
											 
								
												   }
								  else
									   {
										           echo '<tr class="">
												            <td colspan=\'12\'>No Data.</td>
												         
														 </tr>';
									   }
								?>
								</tbody></table>
                                <?php
									  ?>
								
									</div>
										
                                          <?php echo validation_errors(); ?>
								<?php echo form_open('establishmentdata/analytics', array('class' => 'form-horizontal')); ?>
											<div class="row">
												<div class="col-md-12">

												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date4" class="form-control" placeholder="Start Date" id="start_date4">
												  </div>
												  
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date4" class="form-control" value="" placeholder="End Date" id="end_date4">
												  </div>
									
												  
												  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												   
											     </div>
										    </div>
											   
											<?php echo form_close(); ?>	 
											 
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
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script>
$('#start_date1, #end_date1').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
		
        $(document).ready(function(){

		    var example = 'column-drilldown', 
			theme = 'default';

			(function($){ // encapsulate jQuery
				$(function () {
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
							text: ''
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
								format: '{point.y:.1f}'
							}
						}
					},

					tooltip: {
						headerFormat: '<span style="font-size:11px">Business Generated</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span> - Rs: <b>{point.y:.2f}</b><br/>'
					},

					series: [{
						name: '',
						color: '#2E4054',
						data: <?php echo $business_generated; ?>
					}],
					drilldown: {
						series: <?php echo $business_generated; ?>
					}
				});
			});
			})(jQuery);
			/*container1*/
			(function($){ // encapsulate jQuery
				$(function () {
				// Create the chart
				$('#container1').highcharts({
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
							text: ''
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
								format: '{point.y:.1f}'
							}
						}
					},

					tooltip: {
						headerFormat: '<span style="font-size:11px">Business Generated</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span> - Rs: <b>{point.y:.2f}</b><br/>'
					},

					series: [{
						name: '',
						color: '#2E4054',
						data: <?php echo $orders_completed; ?>
					}],
					drilldown: {
						series: <?php echo $orders_completed; ?>
					}
				});
			});
			})(jQuery);
			/*container2*/
			(function($){ // encapsulate jQuery
				$(function () {
				// Create the chart
				$('#container2').highcharts({
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
							text: ''
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
								format: '{point.y:.1f}'
							}
						}
					},

					tooltip: {
						headerFormat: '<span style="font-size:11px">Business Generated</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span> - Rs: <b>{point.y:.2f}</b><br/>'
					},

					series: [{
						name: '',
						color: '#2E4054',
						data: <?php echo $average_order_time; ?>
					}],
					drilldown: {
						series: <?php echo $average_order_time; ?>
					}
				});
			});
			})(jQuery);
			
        });
   
	

    </script>
	<script>
	
   /*     $(document).ready(function(){
			
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });			
			
            $('.dataTables-example').DataTable({
              "pagingType": "full_numbers",
    'iDisplayLength': 10,
                buttons: [
                 
                    {
                     customize: function (win){
                            /*$(win.document.body).addClass('white-bg');*/
                          /*  $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
			
			$('.dataTables_filter input[type="search"]').attr('placeholder','Search by any field');		


        });*/
		
    </script>
    <script>
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/establishmentdata/analytics/" + value;
			}
    </script>
	
    
</body>

</html>
			