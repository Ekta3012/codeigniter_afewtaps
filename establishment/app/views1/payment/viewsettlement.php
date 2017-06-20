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
		
			<div class="ibox-title">
				<h5>Payment Settlement</h5>
			 </div>
								
		     <div class="ibox-content m-b-sm border-bottom">
			 
			 
                <!--<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label for="date_added" class="control-label">Date Start</label>
								<div class="input-group date">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="03/04/2014" class="form-control" id="date_added">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="date_modified" class="control-label">Date End</label>
								<div class="input-group date">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="03/06/2014" class="form-control" id="date_modified">
								</div>
							</div>
						</div>
					</div> -->
				
				
				
									<div class="row">
										<div class="col-md-12">

										  <div class="col-md-3 input-group date" style="float:left;margin-right:3px">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" class="form-control fnt12" placeholder="Start Date" id="start_date">
										  </div>
										  
										  <div class="col-md-3 input-group date" style="float:left;margin-right:3px">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" class="form-control fnt12" value="" placeholder="End Date" id="end_date">
										  </div>
					
										  
										  <div class="col-md-2 text-left" style="float:left;margin-right:3px">
											 <input type="submit" class="btn btn-primary" value="Filter" />
										  </div>   
										   
										   
										   
										 </div>
									 </div>
									 
									 
									 
				
				
             </div>
		
			
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dataTables-example" >
											<thead>
												<tr>
													<th>S No</th>
													<th>Order Id</th>
													<th>Time &amp; Date</th>
													<th>Payment Method</th>
													<th>Amount</th>
													<th>Commission Rate</th>
													<th>Commission Amount</th>
													<th>Service Tax</th>
													<th>Amount Receivable</th>
												</tr>
											</thead>
											<tbody>
												<tr class="gradeX">
													<td>1</td>
													<td>543622</td>
													<td>07:52, April 3, 2016 </td>
													<td>Online</td>
													<td>1085</td>
													<td>2%</td>
													<td>27.00</td>
													<td>3.78</td>
													<td>1052</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<th>S No</th>
													<th>Order Id</th>
													<th>Time &amp; Date</th>
													<th>Payment Method</th>
													<th>Amount</th>
													<th>Commission Rate</th>
													<th>Commission Amount</th>
													<th>Service Tax</th>
													<th>Amount Receivable</th>
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	<script>
        $(document).ready(function(){
			
			$('#start_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#end_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			
			
			
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
    </script>
	
</body>

</html>
			