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
<style>
.sronly{float:left;}
</style>

<style>
    .multiselect {
        width: 200px;
    }
    .selectBox {
        position: relative;
    }
    .selectBox select {
        width: 100%;
    }
    .overSelect {
        position: absolute;
        left: 0; right: 0; top: 0; bottom: 0;
    }
    #checkboxes {
        display: none;
        border: 1px #dadada solid;
		margin-top:-16px;
		float:left
    }
    #checkboxes label {
        display: block;
		font-weight:normal;
		padding-left:5px;
		line-height:28px;
		color:#000;
		float:left;
		width:80%
    }
    #checkboxes label:hover {
        background-color: #1e90ff;
    }
	.taxContainer {border-radius:3px;background-color:#eee}
</style>


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
						<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Add Tax</div>
						
						<div class="ibox-content" style="min-height:0">

						       <?php echo form_error('service_charge'); ?>
							
							   <?php echo form_open('tax/serviceCharge', array('class' => 'form-horizontal')); ?>
							
							    <div class="row">
								
								    <div class="col-sm-2" style="line-height:34px;font-weight:bold">Service Charge</div>
								
									<div class="col-sm-2"><input type="text" placeholder="" name="service_charge" class="form-control" value="<?php echo isset($serviceCharge) ? $serviceCharge : set_value('service_charge'); ?>" autocomplete="off" /></div>
									
									<div class="col-sm-1">
                                        <button type="submit" class="btn btn-primary text-right">Submit</button>
                                    </div>
									
									
								</div>
								
								<?php echo form_close(); ?>
								
						</div>		
									
									
                        <div class="ibox-content">

						    <?php echo form_error('tax_name'); ?>
						    <?php echo form_error('tax_rate'); ?>
						    <?php echo form_error('tax_apply'); ?>
							
							<?php echo form_open('tax/index/'.$this->uri->segment(3), array('class' => 'form-horizontal')); ?>
							
							    <div class="row">
								
								    <!-- <div class="col-sm-3"><input type="text" name="tax_name" value="<?php echo isset($info->{'tax_name'}) ? $info->{'tax_name'} : set_value('tax_name'); ?>" class="form-control" autocomplete="off" placeholder="Tax name" /></div> -->
									

									<div class="col-sm-2" style="width:300px">
									    <select class="form-control" name="tax_index">
										  <option value="1" <?php echo isset($info->{'tax_index'}) ? (($info->{'tax_index'} == 1) == "selected='selected'") : ""; ?>>VAT (Alchoholic & Aerated Drinks)</option>
										  <option value="2" <?php echo isset($info->{'tax_index'}) ? (($info->{'tax_index'} == 2) ? "selected='selected'" : "") : ""; ?>>Service Tax (Bill Total + Service Charge)</option>
									
										  <option value="3" <?php echo isset($info->{'tax_index'}) ? (($info->{'tax_index'} == 3) ? "selected='selected'" : "") : ""; ?>>VAT (Food & Drinks)</option>
										</select>
									</div>
									
									<div class="col-sm-2"><input type="text" placeholder="Tax rate (%)" name="tax_rate" class="form-control" value="<?php echo isset($info->{'tax_rate'}) ? $info->{'tax_rate'} : set_value('tax_rate'); ?>" autocomplete="off" /></div>
									

									<div class="col-sm-2">
									    <select class="form-control" style="width:110px" name="status">
									      <option value="1" <?php echo isset($info->{'status'}) ? ($info->{'status'} == 1 ? "selected='selected'" : "") : ''; ?>>Active</option>
									      <option value="0" <?php echo isset($info->{'status'}) ? ($info->{'status'} == 0 ? "selected='selected'" : "") : ''; ?>>Inactive</option>
										</select>
									</div>
		
									
									<div class="col-sm-1">
                                        <button type="submit" class="btn btn-primary text-right">Submit</button>
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
				
				$(".allTotal").on("click", function() {
					
					if ($(".allTotal:checkbox:checked").length > 0)
					$(".chooseCat").attr('checked', false);
						else
					$(".chooseCat").attr('checked', true);
					
				});
				
				$(".chooseCat").on("click", function() {
					
					if ($(".chooseCat:checkbox:checked").length > 0)
					$(".allTotal").attr('checked', false);
						else
					$(".chooseCat").attr('checked', true);
					
				});
					
				
            });
			
    </script>
	
	<script>
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
	
	
</script>


</body>

</html>
