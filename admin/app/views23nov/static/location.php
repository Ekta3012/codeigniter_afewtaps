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
		
        <div class="wrapper wrapper-content">
            <div class="row">
                 <!-- Table -->
				        <div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Add Location OR Delete location</h5>
									 <div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									 </div>
								</div>
								
								<div class="ibox-content">	
								   <p style="font-size:14px;line-height:26px">In case you wish to add more locations or delete an existing one, kindly send us a request at <a href="mailto:locations@afewtaps.com"><strong>locations@afewtaps.com</strong></a>. (clearly specify locations to be added or deleted in bold, with the subject "ADD LOCATION or DELETE LOCATION, as the case may be)</p>
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
			