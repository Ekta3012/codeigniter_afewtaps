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

.btn-w-m{min-width:0}
</style>
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
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
											$establishments = getAllEstablishments();
											if (count($establishments) > 0)
											  {
												 echo '<select class="form-control m-b" name="branch" onchange="branchStaff(this.value)">';
												 echo '<option value="">Select Establishment</option>';
												 foreach ($establishments as $edata)
												   {
													   $selected = ($this->uri->segment('3') == $edata->id) ? "selected='selected'" : "" ;
													   echo "<option $selected value='".$edata->id."'>".$edata->{'name'}."</option>";
												   }
												  echo '</select>';
											  }
										?>
                                        </div>
                                           
										<div class="col-md-4"></div>		   
								    </div>
                                  
								 <!-- ESTAB MENU -->
									 <?php $this->load->view('include/establishment_menu'); ?>
								 <!-- CLOSE SUB MENU -->
								 
								 <!-- SUB MENU -->
									 <?php $this->load->view('include/establishment_sub_menu'); ?>
								 <!-- CLOSE SUB MENU -->

								  
							<br/>
                                        
                               <div class="row">
                                 <div class="col-sm-2"><b>Food</b></div>
                                 
                                 <!---->
                                 <div class="col-sm-10">
									<?php echo form_open('', array('class' => 'form-horizontal')); ?>
									  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date1" class="form-control" placeholder="Start Date" value="<?php echo set_value('start_date1'); ?>" id="start_date1">
									  </div>
									  
									  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date1" class="form-control" value="<?php echo set_value('end_date1'); ?>" placeholder="End Date" id="end_date1">
									  </div>
						
									  
									  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
										 <input type="submit" class="btn btn-primary" value="Filter" />
									  </div>   
									 <?php echo form_close(); ?>   
								 </div>
                               </div>
                                   <br>      
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
										 $food = array();
										 if (count ($result['foods']) > 0)
											  {
												    arsort($result['foods']);
												    $i = 1;
													foreach ($result['foods'] as $key => $item_data)
														{
															$menud =  $this->db->get_where($this->db->dbprefix('menu_items'), array('id' => $key))->row()->item_name;
															echo '<tr class="">
																		<td>'.$i.'</td>
																		<td>'.ucwords($menud).'</td>
																		<td>'.$item_data.'</td>
																  </tr>';
															$i++;
															
															$food[] = array('name' => ucwords($menud), 'y' => (int) $item_data, 'drilldown' => ucwords($menud));
														}
											 }
											 else
											   {
														   echo '<tr class="">
																	<td colspan=\'3\'>Sorry, No Menu Items Found !</td>
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
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date2" value="<?php echo set_value('start_date2'); ?>" class="form-control" placeholder="Start Date" id="start_date2">
												  </div>
												  
												  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date2" class="form-control" value="<?php echo set_value('end_date2'); ?>" placeholder="End Date" id="end_date2">
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
										 $drinks = array();
										 if (count ($result['drinks']) > 0)
											  {
												    arsort($result['drinks']);
												    $i = 1;
													foreach ($result['drinks'] as $key => $item_data)
														{
															$menud =  $this->db->get_where($this->db->dbprefix('menu_items'), array('id' => $key))->row()->item_name;
															echo '<tr class="">
																		<td>'.$i.'</td>
																		<td>'.ucwords($menud).'</td>
																		<td>'.$item_data.'</td>
																  </tr>';
															$i++;
															
															$drinks[] = array('name' => ucwords($menud), 'y' => (int) $item_data, 'drilldown' => ucwords($menud));
														}
											 }
											 else
											   {
														   echo '<tr class="">
																	<td colspan=\'3\'>Sorry, No Menu Items Found !</td>
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
            headerFormat: '<span style="font-size:11px">Favourite Items</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
        },

        series: [{
            name: '',
			color: '#349313',
            data: <?php echo json_encode($food); ?>
        }],
        drilldown: {
            series: <?php echo json_encode($food); ?>
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
            headerFormat: '<span style="font-size:11px">Favourite Beverages</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
        },

        series: [{
            name: '',
			color: '#349313',
            data: <?php echo json_encode($drinks); ?>
        }],
        drilldown: {
            series: <?php echo json_encode($drinks); ?>
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
			