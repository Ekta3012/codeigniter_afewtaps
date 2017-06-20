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
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">
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
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Coupon</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
							<?php echo validation_errors(); ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
							
                                <div class="form-group"><label class="col-sm-2 control-label">Coupon Code</label>
                                    <div class="col-sm-10"><input type="text" name="coupon_code" value="<?php echo isset($info->{'code'}) ? $info->{'code'} : set_value('coupon_code'); ?>" class="form-control" placeholder="Coupon Code" /></div>
                                </div>
								
                                <div class="hr-line-dashed"></div>
								
                                <div class="form-group"><label class="col-sm-2 control-label">Coupon Type</label>

                                     <div class="col-sm-10">
										<div class="radio radio-success radio-inline">
												<input type="radio" checked="checked" name="type" value="1" id="radio1" <?php echo isset($info->{'type'}) ? ($info->{'type'} == 1 ? "checked='checked'" : "") : ""; ?> />
												<label for="radio1">Percent</label>
										</div>
										
										<div class="radio radio-success radio-inline">
												<input type="radio" value="2" id="radio2" name="type" <?php echo isset($info->{'type'}) ? ($info->{'type'} == 2 ? "checked='checked'" : "") : ""; ?> />
												<label for="radio2">Rupees</label>
										</div>
								   </div>	
								   
                                </div>
                                <div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-2 control-label">Discount</label>
                                    <div class="col-sm-10"><input type="text" name="discount" value="<?php echo isset($info->{'discount'}) ? $info->{'discount'} : set_value('discount'); ?>" class="form-control" placeholder="Discount" /></div>
                                </div>
								
								 <div class="hr-line-dashed"></div>
														
								<div class="form-group control-label"><label class="col-sm-2 control-label">Start Date</label>
									<div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?php echo isset($info->{'sdate'}) ? date('m/d/Y', $info->{'sdate'}) : date('m/d/Y'); ?>" class="form-control" name="start_date" />
                                    </div>					
                                </div>
                                <div class="hr-line-dashed"></div>
								
								<div class="form-group control-label"><label class="col-sm-2 control-label">End Date</label>
									<div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?php echo isset($info->{'edate'}) ? date('m/d/Y', $info->{'edate'}) : date('m/d/Y'); ?>" class="form-control" name="end_date" />
                                    </div>					
                                </div>
                                <div class="hr-line-dashed"></div>

								
								<div class="form-group"><label class="col-sm-2 control-label">Status</label>
								  <div class="col-sm-10">
										<div class="radio radio-success radio-inline">
											<input type="radio" <?php echo isset($info->{'status'}) ? (($info->{'status'} == 1) ? "checked='checked'" : "") : "checked='checked'" ; ?> name="status" value="1" id="radio1" />
											<label for="radio1">Active</label>
										</div>
										<div class="radio radio-danger radio-inline">
											<input type="radio" <?php echo isset($info->{'status'}) ? (($info->{'status'} == 0) ? "checked='checked'" : "") : "" ; ?> value="0" id="radio2" name="status" />
											<label for="radio2">Inactive</label>
										</div>
								   </div>
                                </div>
								
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button type="submit" class="btn btn-white">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	
	
    <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
				var date = new Date();
				$('.input-group.date').datepicker({
						todayBtn: "linked",
						keyboardNavigation: false,
						forceParse: false,
						calendarWeeks: true,
						autoclose: true,
						startDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
						endDate:0
				});
		
		
            });
    </script>
</body>

</html>
