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
								
								<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">INDOOR LOCATION</div>
								
								<div class="ibox-content">	
								   <p style="font-size:14px;line-height:26px">In case you wish to add more locations or modify / delete an existing one, kindly send us a request at <a href="mailto:locations@afewtaps.com"><strong>locations@afewtaps.com.</strong></a><br /> Note: For addition/ deletion, modification, clearly mention location text & its corrosponding form of location identifier</p>
								   
								    <table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
										<tr>
											<th>S No</th>
											<th>Location Text</th>
											<th>Form of Location Identifier</th>
										</tr>
										</thead>
										<tbody>
												<tr class="">
													<td>1</td>
													<td>Table #1</td>
													<td class="text-left">Standee</td>
												</tr>
												<tr class="">
													<td>2</td>
													<td>Table #2</td>
													<td class="text-left">Standee</td>
												</tr>
												
												<tr class="">
													<td>3</td>
													<td>Table #3</td>
													<td class="text-left">Standee</td>
												</tr>
												
												<tr class="">
													<td>4</td>
													<td>Table #4</td>
													<td class="text-left">Sticker</td>
												</tr>

										</tbody>
										
								    </table>
								   
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
	
</body>

<script>

	function changeThreshold(value) 
	   {
		    $("#msg").html('<strong>Loading...</strong>');
			$.ajax({
						url: '<?php echo base_url(); ?>index.php/threshold/updateThreshold',
						type: "POST",
						dataType: "json",
						data: {'value':value},
						success: function (L) 
							 {
							   if (parseInt(L.status) > 0)
								  {
									  $("#msg").html('<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Threshold value has been updated successfully.</div>');
								  }
							   else
								  {
									  $("#msg").html('<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Something went wrong.</div>');
								  }
							 }
				   });
	  }

</script>

</html>
			