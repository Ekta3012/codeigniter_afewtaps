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
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
<style>
.prce{border:1px solid #888;padding:3px 18px;border-radius:4px}

.total{border:1px solid #888;padding:3px 8px;border-radius:4px}

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #ddd;
}

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #ddd;
}

.table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th
{
	border:none
}
.dataTables_paginate{text-align:right !important}

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

			 
			<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Payment Settlement</div>
								
		     <div class="ibox-content m-b-sm border-bottom" style="min-height:60px">
			 
			 
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
												<tr class="text-center" style="font-size:11px">
													<th class="text-center">S No</th>
													<th class="text-center">Order #</th>
													<th class="text-center">Time &amp; Date</th>
													<th class="text-center">Payment Method</th>
													<th class="text-center">Amount</th>
													<th class="text-center">Commission Rate</th>
													<th class="text-center">Commission Amount</th>
													<th class="text-center">Service Tax</th>
													<th class="text-center">Amount Receivable</th>
												</tr>
											</thead>
											<tbody class="text-center">
												<tr class="gradeX">
													<td>1</td>
													<td><a href="#" style="text-decoration:underline">543622</a></td>
													<td>07:52, Apr 3' 16 </td>
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
													<th colspan="4" class="text-left"><span class="total">Total</span></th>
													<th class="text-left" colspan="2"><span class="prce">85485</span></th>
													<th class="text-left" colspan="2"><span class="prce" style="margin:0 0 0 40px">85485</span></th>
													<th class="text-center"><span class="prce">85485</span></th>
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
				
				"footerCallback": function ( row, data, start, end, display ) {
					var api = this.api(), data;
		 
					// Remove the formatting to get integer data for summation
					var intVal = function ( i ) {
						return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
								i : 0;
					};
		 
					// Total over all pages
					total = api
						.column( 4 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					// Total over this page
					pageTotal = api
						.column( 4, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
						
					comTotal = api
						.column( 6, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
						
					amtRcvd = api
						.column( 8, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					// Update footer
					$( api.column( 4 ).footer() ).html(pageTotal);
					
					$( api.column( 6 ).footer() ).html(comTotal.toFixed(2));
					
					$( api.column( 8 ).footer() ).html(amtRcvd.toFixed(2));
				},
				
				
				
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Payment Settlement'},
                    {extend: 'pdf', title: 'Payment Settlement'},

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
			