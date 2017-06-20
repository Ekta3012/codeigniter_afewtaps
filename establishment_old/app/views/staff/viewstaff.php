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
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>

       <div id="page-wrapper" class="gray-bg sidebar-content">
        <div class="row border-bottom">
           <?php $this->load->view('include/inc_topnav'); ?>
        </div>
		
		<div id="toggle" style="display:none;position:absolute;right:230px;top:60px;text-align:right"><a href="javascript:void(0);" style="cursor:pointer"><strong>Hide</strong></a></div>
		 
		 <span id="notfiyCount" style="cursor:pointer" class="badge badge-info pull-right"></span>
		 
		 
	     <div class="sidebard-panel" style="display:none">
                <?php $this->load->view('include/inc_sidebar'); ?>
         </div>

        <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0">
		    <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:20px">View Staff Member</div>
                 <!-- Table -->
					<div class="row">
						<!-- <div class="col-lg-12">
							
								<?php 
									$branches = getBranches($uid);
									if (count($branches) > 0)
									  {
										 echo '<select class="form-control m-b" name="branch" onchange="branchStaff(this.value)">';
										 echo '<option value="">-- Select Branch --</option>';
										 foreach ($branches as $bdata)
										   {
											   $selected = ($this->uri->segment('3') == $bdata->{'id'}) ? "selected='selected'" : "" ;
											   echo "<option $selected value='".$bdata->{'id'}."'>".$bdata->{'name'}."</option>";
										   }
										   echo '</select>';
									  }
								?>
							
						</div> -->
					
					<?php
					   if (count($staff) > 0)
					     {
							foreach ($staff as $staff_data)
							  { 
							    $pic = $staff_data->{'pic'};
								if (empty ($pic))
									{
										$pic = 'user.png';
									}
									
								echo '<div class="col-lg-6">
										  <div class="contact-box">
												<div class="col-sm-4">
													<div class="text-center">
														<img width = \'125\' src="'.base_url().'../uploads/'.$pic.'" class="img-circle m-t-xs img-responsive" alt="image" />
														<div class="m-t-xs font-bold">Service Employee</div>
													</div>
												</div>
												<div class="col-sm-8">
													<h3><strong>'.ucwords($staff_data->{'name'}).'</strong></h3>
													<p><i class="fa fa-user"></i> Emp Id: '.$staff_data->{'employee_id'}.'</p>
													<p><i class="fa fa-mobile"></i> '.$staff_data->{'contact_no'}.'</p>
													<p><a href="'.base_url().'index.php/staff/index/'.$staff_data->{'id'}.'/'.$this->uri->segment(3).'"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a> <a href="'.base_url().'index.php/staff/del/'.$staff_data->{'id'}.'/'.$this->uri->segment(3).'" onclick="return confirm(\'Are you sure ?\')"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a></p>
												</div>
											    <div class="clearfix"></div>
										  </div>
									 </div>';
							  }
						  }
						  else
									 echo "No Staff Member Found .!";
					?>
						
					</div>
				 <!-- Close -->
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
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/staff/view/" + value;
			}
    </script>
	
</body>

</html>
			