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
									<h5>Set Threshold Limit</h5>
									 <div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									 </div>
								</div>
								
								<div class="ibox-content">	
								    <div id="msg"></div>
							    	<?php echo form_open('', array('class' => 'form-horizontal')); ?>
							
									<div class="form-group"><label class="col-sm-2 control-label">Threshold Limit</label>
										<div class="col-sm-10">
										     <select class="form-control" name="limit" style="width:auto" onchange="changeThreshold(this.value)">
											 <?php
												for ($i = 1; $i <= 59; $i++)
												echo "<option value='".$i."'>".$i." Min</option>";
											 ?>
											 </select>
									    </div>
									</div>
								
									<div class="hr-line-dashed"></div>
								
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
			