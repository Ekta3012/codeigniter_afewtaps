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
		
		 <div id="toggle" style="display:none;position:absolute;right:230px;top:60px;text-align:right"><a href="javascript:void(0);" style="cursor:pointer"><strong>Hide</strong></a></div>
		 
		 <span id="notfiyCount" style="cursor:pointer" class="badge badge-info pull-right"></span>
		 
		 
	     <div class="sidebard-panel" style="display:none">
                <?php $this->load->view('include/inc_sidebar'); ?>
         </div>
			
        <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
						
					  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;"><?php echo ($this->uri->segment(3) == '') ? "Add" : "Update"; ?> Coupon</div>
						
	
                        <div class="ibox-content">
							
							<?php
							   echo form_error('off', '<div class="error">', '</div>');
							?>
							
							<?php echo form_open('coupon/index/'.$this->uri->segment(3), array('class' => 'form-horizontal')); ?>
							
							  <!-- <div class="form-group">
							          <label class="col-sm-2 control-label">&nbsp;</label>
								      <div class="col-sm-10"><input type="text" name="coupon_code" value="<?php echo isset($info->{'code'}) ? $info->{'code'} : set_value('coupon_code'); ?>" class="form-control" placeholder="Coupon Code" />
									  </div>
							  </div> -->
								
							  <div class="hr-line-dashed"></div>	

							  
							   <?php
 								if ($coupon == 1)
							    	{
							   ?>
								
                                <div class="form-group">
								      <label class="col-sm-4 control-label text-center">
									      <div class="radio radio-success radio-inline">
												<input type="radio" checked="checked" value="1" id="radio2" name="type" <?php echo isset($type) ? ($type == 1? "checked='checked'" : "checked='checked'") : "" ; ?><?php //echo isset($info->{'type'}) ? ($info->{'type'} == 2 ? "checked='checked'" : "") : ""; ?> />
												<label for="radio2"><strong>Coupon Code</strong></label>
										  </div>
									  </label>
									  
									 <!-- <label class="col-sm-8 control-label text-center">
									      <input type="text" name="coupon_code" value="<?php echo isset($info->{'code'}) ? $info->{'code'} : set_value('coupon_code'); ?>" class="form-control" placeholder="Coupon Code" style="font-weight:normal" autocomplete="off" />
									  
									  </label> -->
									  
							    </div>
								
									  
								<div class="form-group">	  
									  
								   <div class="col-sm-4"></div>
									
									
                                    <div class="col-sm-8">
									  <div style="col-sm-6 display:inline">
									     <input type="text" style="width:30%;float:left" name="off" value="<?php echo isset($info->{'off'}) ? $info->{'off'} : set_value('off'); ?>" class="form-control" placeholder="10%" />
										 <span style="display:inline;line-height:36px">&nbsp;(Enter percentage) </span>
									  </div>
									  off on
									  <div style="col-sm-6 display:inline">
									     <input type="text" style="width:30%;float:left" name="min_amt" value="<?php echo isset($info->{'min_amt'}) ? $info->{'min_amt'} : set_value('min_amt'); ?>" class="form-control" placeholder="Rs. 500" />
										 <span style="display:inline;line-height:36px">&nbsp;(Enter bill amount condition) </span>
									  </div>
									  
									  <br />Note: (if you leave the condition field blank, <br />then it will be applicable on all the orders)
									</div>
									
                                </div>
								
								<div class="form-group control-label"><label class="col-sm-4 control-label text-center">Valid till</label>
									<div class="col-sm-8 input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										  <input type="text" value="<?php echo isset($info->{'valid_till'}) ? date('d/m/Y', $info->{'valid_till'}) : date('d/m/Y'); ?>" class="form-control" name="valid_till_date" style="width:30%" />
                                    </div>					
                                </div>
								
								<div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-4 control-label">Status</label>
								  <div class="col-sm-8">
										<div class="radio radio-success radio-inline">
											<input type="radio" <?php echo isset($info->{'status'}) ? (($info->{'status'} == 1) ? "checked='checked'" : "") : "checked='checked'" ; ?> name="cstatus" value="1" id="radio1" />
											<label for="radio1">Active</label>
										</div>
										<div class="radio radio-danger radio-inline">
											<input type="radio" <?php echo isset($info->{'status'}) ? (($info->{'status'} == 0) ? "checked='checked'" : "") : "" ; ?> value="0" id="radio2" name="cstatus" />
											<label for="radio2">Inactive</label>
										</div>
								   </div>
                                </div>
								
								
								
							    <?php } ?>
								
								<div class="hr-line-dashed"></div>
								
								
								<?php
 								if ($offer == 1)
							    	{
										echo form_error('drinks', '<div class="error">', '</div>');
										//$type =2;
								?>
								<div class="form-group">
									 <label class="col-sm-4 control-label text-center">
									   <div class="radio radio-success radio-inline">
										 <input type="radio" value="2" id="radio3" name="type" <?php echo isset($type) ? (($type == 2) ? "checked='checked'" : "") : "" ; ?> <?php //echo isset($info->{'type'}) ? ($info->{'type'} == 2 ? "checked='checked'" : "") : ""; ?> />
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
														$checked = isset($info->category_id) ? (($info->category_id == $beverages_data->cid) ? "checked = 'checked'" : ""): "";
														$id = '';
														echo '<label for="cat_'.$key.'"><input '.$checked.' name="drinks[]" class = "'.$id.'" type="radio" id="'.$id.'" value="'.$beverages_data->cid.'" />&nbsp;&nbsp;&nbsp;'.$beverages_data->category_name.'</label>';
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
										<input type="text" value="<?php echo isset($info->{'valid_till'}) ? date('d/m/Y', $info->{'valid_till'}) : date('d/m/Y'); ?>" class="form-control" name="valid_till" style="width:30%" />
                                    </div>					
                                </div>
								
								<div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-4 control-label">Status</label>
								  <div class="col-sm-8">
										<div class="radio radio-success radio-inline">
											<input type="radio" <?php echo isset($info->{'ostatus'}) ? (($info->{'ostatus'} == 1) ? "checked='checked'" : "") : "checked='checked'" ; ?> name="ostatus" value="1" id="radio1" />
											<label for="radio1">Active</label>
										</div>
										<div class="radio radio-danger radio-inline">
											<input type="radio" <?php echo isset($info->{'ostatus'}) ? (($info->{'ostatus'} == 0) ? "checked='checked'" : "") : "" ; ?> value="0" id="radio2" name="ostatus" />
											<label for="radio2">Inactive</label>
										</div>
								   </div>
                                </div>
								
								
								
								<?php } ?>
								
								
						        <div class="hr-line-dashed"></div>
								
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-4">
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
						endDate:0,
						format: 'dd/mm/yyyy'
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
