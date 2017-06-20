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
<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">
<style>
.switchery{background-color:#ed5565 !important }
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
		
        <div class="wrapper wrapper-content">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>View Establishments</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									</div>
								</div>
								<div class="ibox-content">

							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<th>S No</th>
									<th>Name</th>
									<th>Address</th>
									<th>Contact Number</th>
								</tr>
								</thead>
								<tbody>
								
								<?php
								   if (count($establishment) > 0)
									   {
										   $i = 0;
										   foreach ($establishment as $data)
											   {
												   $i++;
												   echo '<tr class="">
												            <td>'.$i.'</td>
															<td>'.$data->{'name'}.'</td>
															<td>'.$data->{'address'}.'</td>
															<td class="center">'.($data->{'phoneno'} != '' ? $data->{'phoneno'} : '-------------------------').'</td>
														 </tr>';
											   }
									   }
								   else
									   {
										           echo '<tr class="">
												            <td colspan=\'6\'>No Data.</td>
												            <td><input type="checkbox" class="js-switch" checked /></td>
												            <td><button class="btn btn-primary"><i class="fa fa-edit"></i> </button> <button class="btn btn-danger"><i class="fa fa-trash"></i> </button></td>
														 </tr>';
									   }
								?>
								
								
								</tbody>
								
								
								<tfoot>
								<tr>
									<th>S No</th>
									<th>Name</th>
									<th>Address</th>
									<th>Contact Number</th>
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
	
	<script>
        $(document).ready(function(){
			
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });			
			
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
			