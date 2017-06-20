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
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">


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

.rows.text-center .active{margin-top:6px}

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
								    /*$segment = (int) $this->uri->segment(3);
									 switch ($segment)
										 {
												case 'inside':
															$insideitem    = 'active';
															break;
												case 'analytics':
															$analyticsitem    = 'active';
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
									
									 <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
									 
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/1"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
                                              
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>

								   </div>
								 	
                                   <!--  <div class="row"><a href="<?php //echo base_url(); ?>index.php/establishmentdata/addmenu"><button class="addMenu btn btn-w-m" data-attr="1" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Menu Items</button></a></div>-->
							        	<?php

										/* $segment = (int) $this->uri->segment(3);
										 switch ($segment)
											 {
												 case 0: 
												 case 1:
															$food_active       = 'active';
															break;
												 case 2:
															$beverages_active  = 'active';
															break;
															
												 case 'favfood':
															$favfood_active    = 'active';
															break;
											 }
											 
											*/

											$favfood_active    = 'active';
											 
											
										
										?>
                                          <!-- <div class="row text-center">
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/1"><button class="btn btn-w-m <?php echo isset($food_active) ? $food_active : "nonactive" ; ?>" data-attr="1" type="button">Service Rating Table</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/2"><button class="btn btn-w-m <?php echo isset($beverages_active) ? $beverages_active : "nonactive" ; ?>" data-attr="2" type="button">Average Order Completion Time</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/favfood"><button class="btn btn-w-m <?php echo isset($favfood_active) ? $favfood_active : "nonactive" ; ?>" data-attr="favfood" type="button">Favorite Food</button></a>
                                      <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/4"><button class="btn btn-w-m <?php echo isset($dessert_active) ? $dessert_active : "nonactive" ; ?>" data-attr="4" type="button">New & Returning Customers</button></a>

								  </div> -->
								  
								  <div class="rows text-center">
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3, 0); ?>/1"><button class="btn btn-w-m <?php echo isset($food_active) ? $food_active : "nonactive" ; ?>" data-attr="1" type="button">Service Rating Table</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3, 0); ?>/2"><button class="btn btn-w-m <?php echo isset($beverages_active) ? $beverages_active : "nonactive" ; ?>" data-attr="2" type="button">Average Order Completion Time</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/favfood/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($favfood_active) ? $favfood_active : "nonactive" ; ?>" data-attr="favfood" type="button">Favourite Food</button></a>
                                      <a href="<?php echo base_url(); ?>index.php/establishmentdata/customer/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($customer) ? $customer : "nonactive" ; ?>" data-attr="customer" type="button">New & Returning Customers</button></a>

								  </div>
								  
								  
								  
								  
									<br/>
                                        
                               <div class="row">
                                 <div class="col-sm-2"><b>Food</b></div>
                                 
                                 <!---->
                                 <div class="col-sm-10">
<?php echo form_open('', array('class' => 'form-horizontal')); ?>
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date1" class="form-control" placeholder="Start Date" id="start_date1">
												  </div>
												  
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date1" class="form-control" value="" placeholder="End Date" id="end_date1">
												  </div>
									
												  
												  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												<?php echo form_close(); ?>   
											     </div>
                                                 </div>
                                           <br>      
								  <!---->
                                   
										   <div class="row">
										       <div id="container1" style="height:300px;width:400px;margin:0 auto"></div>
										   </div>
                                           
                                  
                                     <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<th>S No</th>
									<th>Item Name</th>
                                    <th>Sales Unit</th>
                                 
									
								</tr>
								</thead>
								<tbody>
								
								<?php
								  
								 if (count ($result['items_food']) > 0)
									  {
										 $i = 0;
								    foreach ($result['items_food'] as $key => $item_data)
										{
											 $i++;
											 foreach ($item_data as $item_result)
												{  
												 echo '<tr class="">
												            <td>'.$i.'</td>
															
															<td>'.ucwords($item_result->item_name).'</td>';
															
													
															
											
									     echo '<td>';
										 foreach ($result['category'] as $item_data)
										{	
										if($item_result->menu_id == $item_data->menu_id)	
										{
											echo $item_data->quantity;
										}
										}
										echo '</td></tr>';
										}
									  }
									}
									 else
									   {
										           echo '<tr class="">
												            <td >Sorry, No Menu Items Found !</td>
												          
														 </tr>';
									   }
								
								
								?>
								
								
								</tbody>
								
								</table>
                               
									</div>
                                     
                                   <!--for bevevrages-->     
                                     <div class="row">
                                 <div class="col-sm-2"><b>Beverages</b></div>
                                   <!---->
                                 <div class="col-md-10">
<?php echo form_open('', array('class' => 'form-horizontal')); ?>
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date2" class="form-control" placeholder="Start Date" id="start_date2">
												  </div>
												  
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date2" class="form-control" value="" placeholder="End Date" id="end_date2">
												  </div>
									
												  
												  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												<?php echo form_close(); ?>      
											     </div>
                                                 </div>
                                           <br>      
								  <!---->
                                    <div class="row">
                                 
                                 
                                 
                                 
                                 
										   <div class="col-sm-10">
										       <div id="container2" style="height:300px;width:400px;margin:0 auto"></div>
										   </div>
                                           </div>
                                         
                                  
                                     <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<th>S No</th>
									<th>Item Name</th>
                                    <th>Sales Unit</th>
                                 
									
								</tr>
								</thead>
								<tbody>
								
								<?php
								  
								 if (count ($result['items_beverage']) > 0)
									  {
										 $i = 0;
								    foreach ($result['items_beverage'] as $key => $item_data)
										{
											 $i++;
											 foreach ($item_data as $item_result)
												{  
												 echo '<tr class="">
												            <td>'.$i.'</td>
															
															<td>'.ucwords($item_result->item_name).'</td>';
															
													
															
											
									     echo '<td>';
										 foreach ($result['category'] as $item_data)
										{	
										if($item_result->menu_id == $item_data->menu_id)	
										{
											echo $item_data->quantity;
										}
										}
										echo '</td></tr>';
										}
									  }
									}
									 else
									   {
										           echo '<tr class="">
												            <td >Sorry, No Menu Items Found !</td>
												          
														 </tr>';
									   }
								
								
								?>
								
								
								</tbody>
								
								</table>
                               
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
            type: 'category'
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
            data: <?php echo $result['favorite_foods']; ?>
        }],
        drilldown: {
            series: <?php echo $result['favorite_foods']; ?>
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
            type: 'category'
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
            data: <?php echo $result['favorite_beverages']; ?>
        }],
        drilldown: {
            series: <?php echo $result['favorite_beverages']; ?>
        }
    });
});
})(jQuery);



	});
	
	</script>
    
    
    
	
    
   
	<script>
		function branchStaff(value)
			{
				 var userid=value;
				location.href = "<?php echo base_url(); ?>index.php/establishmentdata/favfood/" + value;
			}
			
			$('#start_date1, #end_date1').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			
			$('#start_date2, #end_date2').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			</script>
</body>

</html>
			