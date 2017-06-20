<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?>Coupon</title>
<link href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">
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
		margin-top:-16px
    }
    #checkboxes label {
        display: block;
		font-weight:normal;
		padding-left:5px
    }
    #checkboxes label:hover {
        background-color: #1e90ff;
    }
</style>

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
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Coupon Data</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
							<?php echo validation_errors(); ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
							
                                <div class="form-group">
								      <label class="col-sm-4 control-label text-center">
									      <div class="radio radio-success radio-inline">
												<input type="radio" value="1" id="radio2" name="type" <?php echo isset($info->{'type'}) ? ($info->{'type'} == 2 ? "checked='checked'" : "") : ""; ?> />
												<label for="radio2"><strong>Coupon Code</strong></label>
										  </div>
									  </label>
									  
                                    <div class="col-sm-8">
									  <div style="col-sm-6 display:inline">
									     <input type="text" style="width:30%;float:left" name="coupon_code" value="" class="form-control" placeholder="10%" />
										 <span style="display:inline;line-height:36px">&nbsp;(Enter percentage) </span>
									  </div>
									  off on
									  <div style="col-sm-6 display:inline">
									     <input type="text" style="width:30%;float:left" name="coupon_code" value="" class="form-control" placeholder="Rs. 500" />
										 <span style="display:inline;line-height:36px">&nbsp;(Enter bill amount condition) </span>
									  </div>
									  
									  <br />Note: (if you leave the condition field blank, <br />then it will be applicable on all the orders)
									</div>
									
                                </div>
								
								
								<div class="form-group control-label"><label class="col-sm-4 control-label text-center">Valid till</label>
									<div class="col-sm-8 input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?php echo isset($info->{'sdate'}) ? date('m/d/Y', $info->{'sdate'}) : date('m/d/Y'); ?>" class="form-control" name="start_date" style="width:30%" />
                                    </div>					
                                </div>
								
								<div class="hr-line-dashed"></div>
								
								<div class="form-group">
									 <label class="col-sm-4 control-label text-center">
									   <div class="radio radio-success radio-inline">
										 <input type="radio" value="2" id="radio3" name="type" <?php echo isset($info->{'type'}) ? ($info->{'type'} == 2 ? "checked='checked'" : "") : ""; ?> />
										 <label for="radio3"><strong> One + One Offers (Beverages)</strong></label>
								       </div>
									 </label>

									 <div class="col-sm-8">
									  <?php
										 echo '<div class="selectBox" onclick="showCheckboxes()">
													<select class=\'form-control m-b\'>
														<option>Category</option>
													</select>
													<div class="overSelect"></div>
												</div>';
												
										 echo "<div id=\"checkboxes\">";

										 if (count($beverages) > 0)
											{											 
												 foreach ($beverages as $key => $beverages_data)
													 {
														$checked = '';//in_array ($key, $tax_apply_arr) ? "checked = 'checked'" : "";
														$id = ''; //($key == 0) ? "allTotal" : "chooseCat";
														echo '<label for="cat_'.$key.'"><input name="drinks[]" class = "'.$id.'" type="radio" id="'.$id.'" value="'.$beverages_data->cid.'" '.$checked.' />&nbsp;&nbsp;&nbsp;'.$beverages_data->category_name.'</label>';
													 }	
											}
											else
												echo "<label>Sorry. No Beverages Found.</label>";
										 echo "</div>";
										?>
									 </div>
                                </div>
								
								<div class="form-group control-label"><label class="col-sm-4 control-label text-center">Valid till</label>
									<div class="col-sm-8 input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										  <input type="text" value="<?php echo isset($info->{'sdate'}) ? date('m/d/Y', $info->{'sdate'}) : date('m/d/Y'); ?>" class="form-control" name="start_date" style="width:30%" />
                                    </div>					
                                </div>
								
						        <div class="hr-line-dashed"></div>
								
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button type="reset" class="btn btn-white">Cancel</button>
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
