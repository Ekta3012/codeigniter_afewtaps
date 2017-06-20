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
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
<!--<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">-->

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
 <script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

<style>
.row.text-center {
    background-color: rgb(199, 199, 199);
    border-radius: 14px;
	 margin-bottom: 20px;
}
.rows.text-center {
   
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
.row.text-center .nonactive{color:#000}
.rows.text-center .nonactive {
    background: #404040 none repeat scroll 0 0;
    color: #fff;  margin-bottom: 0 !important;
}
.rows.text-center .active {
background: rgb(199, 199, 199) none repeat scroll 0 0;
box-shadow: none !important;
color: #000;

    
}
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
		
        <div class="wrapper wrapper-content" id="leftWrapper">
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
										 echo '<select class="form-control m-b" name="estab" onchange="branchStaff(this.value)">';
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
								    /*$segment = $this->uri->segment(2);
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
										 */
										 $insideitem    = 'active';
										 
								  ?>
								  <div class="row text-center">
                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/order"><button class="btn btn-w-m <?php echo isset($orderitem) ? $orderitem : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
                                   
                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside"><button class="btn btn-w-m <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings"><button class="btn btn-w-m <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
                                    
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/1"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
                                              
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>

								  </div>
								 	
                                   <!--  <div class="row"><a href="<?php //echo base_url(); ?>index.php/establishmentdata/addmenu"><button class="addMenu btn btn-w-m" data-attr="1" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Menu Items</button></a></div>-->
								<?php

									 /* $segment =  $this->uri->segment(2);
									 switch ($segment)
										 {
											 case 0: 
											 case 1:
											            $food_active       = 'active';
														break;
											 case 2:
														$beverages_active  = 'active';
														break;
											 case 'customer':
											            $customer_active    = 'active';
														break;
										 }
									 */
										 $customer_active    = 'active';
								?>
								
                                  <div class="rows text-center">
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/1/<?php echo $this->uri->segment(4); ?>"><button class="btn btn-w-m <?php echo isset($food_active) ? $food_active : "nonactive" ; ?>" data-attr="1" type="button">Service Rating Table</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/2"><button class="btn btn-w-m <?php echo isset($beverages_active) ? $beverages_active : "nonactive" ; ?>" data-attr="2" type="button">Average Order Completion Time</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/favfood"><button class="btn btn-w-m <?php echo isset($favfood_active) ? $favfood_active : "nonactive" ; ?>" data-attr="favfood" type="button">Favorite Food</button></a>
                                      <a href="<?php echo base_url(); ?>index.php/establishmentdata/customer/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($customer_active) ? $customer_active : "nonactive" ; ?>" data-attr="customer" type="button">New & Returning Customers</button></a>

								  </div>
											 	
									<div class="table-responsive">
									     <table class="table table-striped table-bordered table-hover dataTables-example" >
											<thead>
												<tr>
													<th>S No</th>
													<th>User Name</th>  
													<th>Email Id</th>
													<th>Mobile No.</th>
													<th>Customers</th>
												 
												</tr>
											</thead>
								<tbody>
								
								<?php
								   if (count($result['cust_exit']) > 0)
									   {
										   $i = 0;
										   foreach ($result['cust_exit'] as $custm)
											   {
												   foreach ($custm as $data)
													   {
														   $i++;
														   
														  
															echo '<tr class="">
																	<td>'.$i.'</td>
																	<td><a href="'.base_url().'index.php/establishmentdata/customerdetails/'.$data->{'id'}.'">'.$data->{'name'}.'</a></td>
																	<td>'.$data->{'email'}.'</td>
																	<td>'.$data->{'mobile'}.'</td>';
															echo '<td>';		

																 foreach ($result['new_grph'] as $custm_status)
																   {
																	   foreach ($custm_status as $Cstatus)
																			   {
																				   if ($data->{'id'}==$Cstatus->{'customer_id'})	
																					   {
																							 if($Cstatus->{'customer'}>1)
																								 {
																									 echo "Returning";
																								 }
																							 else
																								 {
																									 echo "New";
																								 }
																					   }
																			   }
																   }
														
														   
																echo '</td>';			 	
																echo '</tr>';
														} 	
											   }	
										}
								   else
									   {
										           echo '<tr class="">
												            <td colspan=\'6\'>No Data.</td>
														 </tr>';
									   }
								?>
								
								</tbody>
								
								</table>
							</div>
								
                                	<div class="row">
									  <div style="text-align:left" class="col-lg-6">
									    <div class="contact-box pull-left" style="width:100%;border:0;padding: 0;">
										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Total Count of Customers</div><br />
										<hr>
                                      
                                        
                                          <div class="row">
												<div class="col-md-12">
												  <?php echo form_open('', array('class' => 'form-horizontal')); ?>
												  <div class="col-md-4 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date1" class="form-control" placeholder="Start Date" id="start_date1">
												  </div>
												  
												  <div class="col-md-4 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date1" class="form-control" value="" placeholder="End Date" id="end_date1">
												  </div>
									
												  
												  <div class="col-md-2 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												   <?php echo form_close();?> </div>   
												   
											     </div>
										    </div>
										   
										   <div class="col-sm-6">
                                        
											   <div style="height:200px;width:400px;margin:0 auto;margin:20px 0 0 0" id="container1"></div>
										   </div>
										   
										  
											
										</div>
									  </div>
                                      <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                                        <div style="text-align:left" class="col-lg-6">
									    <div class="contact-box pull-left" style="width:100%;border:0;padding: 0;">
										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Total Count of New Customers</div><br />
										<hr>
                                      
                                        
                                          <div class="row">
												<div class="col-md-12">

												  <div class="col-md-4 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date2" class="form-control" placeholder="Start Date" id="start_date2">
												  </div>
												  
												  <div class="col-md-4 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date2" class="form-control" value="" placeholder="End Date" id="end_date2">
												  </div>
									
												  
												  <div class="col-md-2 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												   
											     </div>
										    </div>
										   
										   <div class="col-sm-6">
                                        
											   <div style="height:200px;width:400px;margin:0 auto;margin:20px 0 0 0" id="container2"></div>
										   </div>
										   
										  
											
										</div>
									  </div>
                                         <?php echo form_close();?>
									</div>
                                
                             <div class="row">
                               <div style="text-align:left" class="col-lg-12">
                                   <?php echo form_open('', array('class' => 'form-horizontal')); ?>
									    <div class="contact-box pull-left" style="width:100%;border:0;padding: 0;">
										   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">No. of Times Visited on Returning Customers</div><br />
										<hr>
                                      
                                        
                                          <div class="row">
												<div class="col-md-12">

												  <div class="col-md-4 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date3" class="form-control" placeholder="Start Date" id="start_date3">
												  </div>
												  
												  <div class="col-md-4 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date3" class="form-control" value="" placeholder="End Date" id="end_date3">
												  </div>
									
												  
												  <div class="col-md-2 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												    <?php echo form_close();?> 
											     </div>
										    </div>
										   
										   <div class="col-sm-6">
                                        
											   <div style="height:200px;width:400px;margin:0 auto;margin:20px 0 0 0" id="container3"></div>
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

   <script>
	$(document).ready(function(){
           

var example = 'column-drilldown', 
theme = 'default';

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
            type: 'category',
			  title: {
                text: '<strong>Customers</strong>'
            }
        },
        yAxis: {
            title: {
                text: '<strong></strong>'
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
            name: '',
			color: '#349313',
            data: <?php echo $result['total_customers']; ?>
        }],
        drilldown: {
            series: <?php echo $result['total_customers']; ?>
        }
    });
});
})(jQuery);


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
            type: 'category',
			  title: {
                text: '<strong>New Customers</strong>'
            }
        },
        yAxis: {
            title: {
                text: '<strong></strong>'
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
            name: '',
			color: '#349313',
            data: <?php echo $result['new_customers']; ?>
        }],
        drilldown: {
            series: <?php echo $result['new_customers']; ?>
        }
    });
});
})(jQuery);

(function($){ // encapsulate jQuery
	$(function () {
    // Create the chart
    $('#container3').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            type: 'category',
			  title: {
                text: '<strong>Returning Customers</strong>'
            },
        },
        yAxis: {
            title: {
                text: '<strong></strong>'
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
            name: '',
			color: '#349313',
            data: <?php echo $result['returning_customers']; ?>
        }],
        drilldown: {
            series: <?php echo $result['returning_customers']; ?>
        }
    });
});
})(jQuery);
	});

    </script>
	
	<script>
     $(document).ready(function(){
			
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });			
			
            $('.dataTables-example').DataTable({
              
                buttons: [
                 
                    {
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
			
		$('.dataTables_filter input[type="search"]').attr('placeholder','Search by any field');		


        });
    </script>
    <script>
		function branchStaff(value)
			{
				 var userid=value;
				location.href = "<?php echo base_url(); ?>index.php/establishmentdata/customer/" + value;
				
				
				
			}
			</script>
    
   <script>
	$(document).ready(function(){
$('#start_date1').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#end_date1').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
		
			$(document).ready(function(){
$('#start_date2').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#end_date2').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
		
			$(document).ready(function(){
$('#start_date3').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#end_date3').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
	</script>
	
	
</body>

</html>
			