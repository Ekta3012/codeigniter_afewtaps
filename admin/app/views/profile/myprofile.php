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
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">
<style>
.addAdmin{background:#2A3F54;color:#FFF}
</style>
</head>
<body>

     <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
	   
        <div class="wrapper wrapper-content" style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
                            <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">My Profile</div>
							
								<div class="ibox-content">
						
						     <?php
							   echo ($this->session->flashdata('updtemail') != '') ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Your Email Id has been updated successfully.</div>' : '';
							  
							   
							 ?>
							 
							 
							<?php echo validation_errors(); ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal'));
							/* if (count($email) > 0)
									   {
										  
										   foreach ($email as $data)
											   {*/
								 ?>
							
							
							    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10"><input type="text" name="name" value="<?php//echo $data->{'name'}; ?>" class="form-control" placeholder="Name" /></div>
                                </div>
								
								
								 <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10"><input type="text" name="email" value="<?php //echo $data->{'email'}; ?>" class="form-control" placeholder="Email" /></div>
                                </div>
								
								
                                <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10"><input type="password" name="pwd" value="" class="form-control" placeholder="Password" /></div>
                                </div>
								
                                
								
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                      
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            <?php 
							
							echo form_close(); ?>
							
							
							
                        </div>
						
						
						      <div class="row">
								<div class="col-md-10 text-right">
								   <a href="<?php echo base_url(); ?>index.php/establishment/newadmin"><button class="addAdmin btn btn-w-m" data-attr="1" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Admin</button></a>
								</div>
								
								<div class="col-md-2"></div>
							  </div>
							  
							  
										
                    </div>
                </div>
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
	
    
</body>

</html>
