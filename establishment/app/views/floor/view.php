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


        <div class="wrapper wrapper-content" id="leftWrapper">
		
			<div class="ibox-title">
				<h5>Floor Performance</h5>
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
													<th>Name</th>
													<th>No Of Orders Executed</th>
													<th>Business Generated</th>
													<th>Average Order Completion Time</th>
												</tr>
											</thead>
											<tbody>
												<tr class="gradeX">
													<td>1</td>
													<td>Aman</td>
													<td>10</td>
													<td class="center">17,000</td>
													<td class="center">30 mins</td>
												</tr>
												
												<tr class="gradeX">
													<td>2</td>
													<td>Jatin</td>
													<td>6</td>
													<td class="center">10,000</td>
													<td class="center">28 mins</td>
												</tr>
												
											</tbody>
											<tfoot>
												<tr>
													<th>S No</th>
													<th>Name</th>
													<th>No Of Orders Executed</th>
													<th>Business Generated</th>
													<th>Average Order Completion Time</th>
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
	
	<script>
        $(document).ready(function(){
		
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Floor Performance'},
                    {extend: 'pdf', title: 'Floor Performance'},

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
			