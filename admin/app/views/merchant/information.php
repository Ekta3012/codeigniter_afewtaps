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
                            <h5>Merchant Information for Real Time Orders</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
							
							<?php
							    echo ($this->session->flashdata('minfoadd') != '') ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Your Information has been added successfully.</div>' : '';
							    echo ($this->session->flashdata('minfoupd') != '') ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Your Information has been updated successfully.</div>' : '';
							 ?>
							<?php echo validation_errors(); ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
							
                                <div class="form-group"><label class="col-sm-4 control-label">Contact Person</label>
                                    <div class="col-sm-8"><input type="text" name="contact_person" value="<?php echo isset($info->{'contact_person'}) ? $info->{'contact_person'} : set_value('contact_person'); ?>" class="form-control" placeholder="Contact Person" /></div>
                                </div>
								
                                <div class="hr-line-dashed"></div>
								
                                <div class="form-group"><label class="col-sm-4 control-label">Contact Number</label>

                                    <div class="col-sm-8"><input type="text" placeholder="Contact Number" name="contact_no" class="form-control" value="<?php echo isset($info->{'contact_no'}) ? $info->{'contact_no'} : set_value('contact_no'); ?>" /></div>
                                </div>

                                <div class="hr-line-dashed"></div>
								
								
                                <div class="form-group"><label class="col-sm-4 control-label">Email Id</label>

                                    <div class="col-sm-8"><input type="text" placeholder="Email Id" name="emailid" class="form-control" value="<?php echo isset($info->{'email'}) ? $info->{'email'} : set_value('emailid'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-4 control-label">Beneficiary Name</label>

                                    <div class="col-sm-8"><input type="text" placeholder="Beneficiary Name" name="beneficiary_name" class="form-control" value="<?php echo isset($info->{'beneficiary_name'}) ? $info->{'beneficiary_name'} : set_value('beneficiary_name'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								
								
								<div class="form-group"><label class="col-sm-4 control-label">Bank Name</label>

                                    <div class="col-sm-8"><input type="text" placeholder="Bank Name" name="bank_name" class="form-control" value="<?php echo isset($info->{'bank_name'}) ? $info->{'bank_name'} : set_value('bank_name'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-4 control-label">Bank Account No</label>

                                    <div class="col-sm-8"><input type="text" placeholder="Bank Account No" name="bank_ac_no" class="form-control" value="<?php echo isset($info->{'bank_ac_no'}) ? $info->{'bank_ac_no'} : set_value('bank_ac_no'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-4 control-label">IFSC/ SWIFT Code</label>

                                    <div class="col-sm-8"><input type="text" placeholder="IFSC/ SWIFT Code" name="ifsc_swift_code" class="form-control" value="<?php echo isset($info->{'ifsc_swift_code'}) ? $info->{'ifsc_swift_code'} : set_value('ifsc_swift_code'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-4 control-label">Account Type</label>

                                    <div class="col-sm-8">
										
										<select name="acc_type" class="form-control m-b">
												<option value="1" <?php echo (isset($info->{'account_type'}) ? ($info->{'account_type'} == 1 ? "selected='selected'" : "") : ""); ?> >Current Account</option>
												<option value="2" <?php echo (isset($info->{'account_type'}) ? ($info->{'account_type'} == 2 ? "selected='selected'" : "") : ""); ?>>Saving Account</option>
                                        </select>
										 
									</div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-4 control-label">Commission Collection Start Date</label>

                                    <div class="col-sm-8 input-group date">
									  <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="com_col_strt_dt" value="<?php echo isset($info->{'com_col_start_dt'}) ? date('m/d/Y', $info->{'com_col_start_dt'}) : date('m/d/Y'); ?>" class="form-control" />
									</div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-4 control-label">Commission Slab (Based on Ratings)</label>

                                    <div class="col-sm-8"><input type="text" placeholder="Commission Slab (Based on Ratings)" name="com_slab" class="form-control" value="<?php echo isset($info->{'com_slab'}) ? $info->{'com_slab'} : set_value('com_slab'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-4 control-label">Merchant TAN Details</label>

                                    <div class="col-sm-8"><input type="text" placeholder="Merchant TAN Details" name="merchant_details" class="form-control" value="<?php echo isset($info->{'merchant_tan'}) ? $info->{'merchant_tan'} : set_value('merchant_details'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
				
								<div class="form-group"><label class="col-sm-4 control-label">TDS Deducted</label>

                                    <div class="col-sm-8"><input type="text" placeholder="TDS Deducted" name="tds_deducted" class="form-control" value="<?php echo isset($info->{'tds_deducted'}) ? $info->{'tds_deducted'} : set_value('tds_deducted'); ?>" /></div>
                                </div>
								

                                <div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-4 control-label">Payment Method</label>
                                    <div class="col-sm-8">
									     <select name="payment_method" class="form-control m-b">
												<option value="1" <?php echo (isset($info->{'payment_method'}) ? ($info->{'payment_method'} == 1 ? "selected='selected'" : "") : ""); ?> >COD</option>
												<option value="2" <?php echo (isset($info->{'payment_method'}) ? ($info->{'payment_method'} == 2 ? "selected='selected'" : "") : ""); ?>>COD + Online</option>
												<option value="3" <?php echo (isset($info->{'payment_method'}) ? ($info->{'payment_method'} == 3 ? "selected='selected'" : "") : ""); ?>>Online</option>
                                         </select>
									</div>
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
