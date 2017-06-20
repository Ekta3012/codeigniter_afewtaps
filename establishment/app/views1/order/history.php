<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?>Order History</title>
<link href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">

<style>
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
.fnt12{font-size:11px}
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
								<div class="ibox-title">
									<h5>Order History</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									</div>
									<br />
									
									 
									 <div class="row">
										<div class="col-md-12">

										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" class="form-control fnt12" placeholder="Start Date" id="start_date">
										  </div>
										  
										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date1" class="form-control fnt12" value="" placeholder="End Date" id="end_date">
										  </div>
							
							
							              <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											</span><input type="text" name="end_date1" class="form-control fnt12" value="" placeholder="Location" id="end_date1"><span class="input-group-addon"><i class="fa fa-map-marker"></i>
										  </div>
										  
										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											</span><input type="text" name="end_date1" class="form-control fnt12" value="" placeholder="Customer Name" id="end_date1"><span class="input-group-addon"><i class="fa fa-user"></i>
										  </div>
										  
										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											</span><input type="text" name="end_date1" class="form-control fnt12" value="" placeholder="Payment Method" id="end_date1"><span class="input-group-addon"><i class="fa fa-inr"></i>
										  </div>
										  
										  
										  <div class="col-md-1 text-left" style="float:left;margin-right:3px">
											 <input type="submit" class="btn btn-primary" value="Filter" />
										  </div>   
										   
										   
										   
										 </div>
									 </div>

											
								</div>
								<div class="ibox-content">

									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
										<tr>
											<th>S No</th>
											<th>Order Id</th>
											<th>Time & Date</th>
											<th>Location</th>
											<th>Delivery Status</th>
											<th>Payment Method</th>
											<th>Amount</th>
											<th>Customer Name</th>
											<th>Receipt</th>
										</tr>
										</thead>
										<tbody>
										
										<?php
										   $tax = array();
										   if (count($tax) > 0)
											   {
												   $i = 0;
												   $cate_arr   =   array (0 => 'All (Bill Total)', 1 => 'Food', 2 => 'Beverage', 3 => 'Dessert');
												   foreach ($tax as $data)
													   {
														   $arr 		  =    array();
														   $category_arr  =   (array) @explode (',', $data->{'apply_for'});  
														  
														   foreach ($category_arr as $k => $v)
														   $arr[]         =    $cate_arr[$v];
														   
														   $i++;
														   echo '<tr class="">
																	<td>'.$i.'</td>
																	<td>'.$data->{'tax_name'}.'</td>
																	<td>'.$data->{'tax_rate'}.'</td>
																	<td class="center">'.implode(',', $arr).'</td>
																	<td class="center"><a href="'.base_url().'index.php/tax/index/'.$data->{'id'}.'"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>&nbsp;&nbsp;<a href="'.base_url().'index.php/tax/del/'.$data->{'id'}.'" onclick="return confirm(\'Are you sure ?\')"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a></td>
																 </tr>';
													   }
											   }
										   else
												   {
															   echo '<tr class="">
																		<td>1</td>
																		<td>542142</td>
																		<td>04:34 PM, Jan 24 2015</td>
																		<td>Table No. 5</td>
																		<td>Delivered</td>
																		<td>COD</td>
																		<td>1085</td>
																		<td>Manoj</td>
																		<td>View</td>
																	 </tr>';
												   }
										?>
										
										
										</tbody>
										
										
										<tfoot>
										<tr>
											<th>S No</th>
											<th>Order Id</th>
											<th>Time & Date</th>
											<th>Location</th>
											<th>Delivery Status</th>
											<th>Payment Method</th>
											<th>Amount</th>
											<th>Customer Name</th>
											<th>Receipt</th>
										</tr>
										</tfoot>
										
										
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	
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
        });
	
		var width = $('#slide').width() - 10;
		$('#slide').hover(function () {
			 $(this).stop().animate({left:"0px"},500);     
		   },function () {          
			 $(this).stop().animate({left: - width  },500);     
		});
		
		$('#start_date, #end_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });


    </script>
	
</body>

</html>
			