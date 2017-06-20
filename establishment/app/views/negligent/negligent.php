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

					  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Add Negligent Marking</div>
                        <div class="ibox-content">
							<?php
							   echo validation_errors();
							   
							   if ($this->session->flashdata('negligent_order'))
							   echo '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Add Negligent successfully.</div>';
						   
							   if ($this->session->flashdata('negligent_order_fail'))
							   echo '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Order Id does not exist.</div>';
							?>

							<?php echo form_open_multipart('', array('class' => 'form-horizontal' , 'novalidate' => 'novalidate')); ?>
								
                                <div class="form-group"><label class="col-sm-2 control-label">Customer Name</label>
                                    <div class="col-sm-10"><input type="text" value="<?php echo set_value('customer_name'); ?>" name="customer_name" placeholder="Name" class="form-control" autocomplete="off" /></div>
                                </div>
								
                                <div class="hr-line-dashed"></div>
								
                                <div class="form-group"><label class="col-sm-2 control-label">Order #</label>
                                    <div class="col-sm-10"><input type="text" name="order_id" value="<?php echo set_value('order_id'); ?>" placeholder="Order #" class="form-control" autocomplete="off" /></div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
								
								 <div class="form-group"><label class="col-sm-2 control-label">Reason</label>
                                    <div class="col-sm-10"><textarea name="reason" value="<?php echo set_value('reason'); ?>" placeholder="Reason" class="form-control" autocomplete="off"></textarea></div>
                                </div>
                                <div class="hr-line-dashed"></div>
								

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
	
</body>

</html>
