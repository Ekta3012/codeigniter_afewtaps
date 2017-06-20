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
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
					  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Change Password</div>
                        <div class="ibox-content">
						     <?php
							    echo ($this->session->flashdata('updtpwd') != '') ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Your Account Information has been updated successfully.</div>' : '';
							 ?>
							<?php echo validation_errors(); ?>
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
							
							    <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10"><input type="email" name="email" value="" class="form-control" placeholder="Change Email Id" /></div>
                                </div>
								
                                <div class="form-group"><label class="col-sm-2 control-label">Old Password</label>
                                    <div class="col-sm-10"><input type="password" name="old_password" value="" class="form-control" placeholder="Old Password" /></div>
                                </div>
								
                                <div class="hr-line-dashed"></div>
								
                                <div class="form-group"><label class="col-sm-2 control-label">New Password</label>

                                    <div class="col-sm-10"><input type="password" placeholder="New Password" name="new_password" class="form-control" value="<?php echo set_value('tax_rate'); ?>" /></div>
                                </div>

                                <div class="hr-line-dashed"></div>
								
								
                                <div class="form-group"><label class="col-sm-2 control-label">Retype New Password</label>

                                    <div class="col-sm-10"><input type="password" placeholder="Retype New Password" name="retype_password" class="form-control" value="<?php echo set_value('tax_rate'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button type="submit" class="btn btn-white">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
							
							
							
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

    <!-- iCheck -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
    </script>
</body>

</html>
