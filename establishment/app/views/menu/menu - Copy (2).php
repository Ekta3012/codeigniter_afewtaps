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
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">
<style>
.mrgn10{margin:0 10px}
.mrgnbtm10{margin:0 0 10px 0}
.mrgntp8{margin-top:8px}
.mrgntp15{margin-top:15px}
.txtareadesc{margin:30px 0 0 45px;resize:vertical}
.mrgnlft85{margin-left:85px}
.mrgnlft92{margin-left:92px}
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
                            <h5>Menu Items</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
							<?php echo validation_errors(); ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
								
								<div class="form-group"><label class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10">
									   <?php
   									     $value =  tep_get_category_tree();
									     echo tep_draw_pull_down_menu('parent', $value, ((set_value('parent') != '') ? set_value('parent') : (isset($info->{'parent_id'}) ? $info->{'parent_id'} : ''))); 
									   ?>
									</div>
                                </div>
								
								 <div class="hr-line-dashed"></div>
								 
								 <div class="form-group"><label class="col-sm-2 control-label">Type</label>
									 <div class="col-sm-10">
										<div class="radio radio-success radio-inline">
												<input type="radio" checked="checked" name="veg_nonveg_cat" value="1" id="radio5" <?php echo isset($info->{'type'}) ? ($info->{'type'} == 1 ? "checked='checked'" : "") : ""; ?> />
												<label for="radio5">Veg</label>
										</div>
										
										<div class="radio radio-danger radio-inline">
												<input type="radio" value="2" id="radio6" name="veg_nonveg_cat" <?php echo isset($info->{'type'}) ? ($info->{'type'} == 2 ? "checked='checked'" : "") : ""; ?> />
												<label for="radio6">Non Veg</label>
										</div>
										
									 </div>
								 </div>

                                <div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-2 control-label">Cuisine Type</label>
                                    <div class="col-sm-10">
									   <select class="form-control" multiple="multiple" name="cuisine[]">
									     <?php
										  if (count($cuisine) > 0)
											  {
												  foreach ($cuisine as $cuisine_data)
												  echo "<option value=".$cuisine_data->id.">".$cuisine_data->cuisine."</option>";
											  }
										 ?>
									   </select>
									</div>
                                </div>
								
								<div class="hr-line-dashed"></div>
								 

								<div class="form-group" id="addMoreItem" style="border:1px dashed #e7eaec;border-radius:3px;padding:25px"><label class="col-sm-2 control-label">&nbsp;</label>
								   <div>
                                     <div class="col-sm-10 mrgnbtm10">
									     <div class="pull-left">
										    <img id="addMoreItemBtn" title="add more item" class="pull-left mrgn10 mrgntp8" src="<?php echo base_url(); ?>assets/img/more.png" alt="" /><input type="text" placeholder="Enter Item Name" class="form-control pull-left mrgn10" value="" name="item_name[]" style="width:41%" />&nbsp;&nbsp;<input type="text" placeholder="Enter Base Price" class="form-control pull-left mrgn10" value="" name="base_price[]" style="width:41%" />
											
											<textarea class="form-control txtareadesc" placeholder="Enter Item Description" name="description[]"></textarea>
										 </div>
									 </div>
									
									
									<div class="pull-left" id="addCustomOptContainer">
									 <label class="col-sm-2 control-label">&nbsp;</label>
									   <div class="col-sm-10 text-right">
									     <div class="pull-left mrgnlft85" style="width:88%">
										    <img class="pull-left mrgn10 mrgntp8" src="<?php echo base_url(); ?>assets/img/more.png" alt="" id="addCustomizationType" /><input type="text" placeholder="Add Customization Type" class="form-control pull-left mrgn10" value="" name="customization_type_1" style="width:62%" />
										 </div>
										 
										 
										 <div class="col-sm-10 text-right mrgntp8">
												<div class="radio radio-success radio-inline">
														<input type="radio" id="radio8" value="1" name="custom_type_1" checked="checked">
														<label for="radio8">Exclusive</label>
												</div>
												<div class="radio radio-success radio-inline">
														<input type="radio" name="custom_type_1" id="radio9" value="2">
														<label for="radio9">Multiple</label>
												</div>
										 </div>
											
									  </div>
									</div>
									
									<input type="hidden" name="custom_type_hidden" id="custom_type_hidden" value="2" />
									
									
									<div class="pull-left mrgntp15" id="addCustomOption">
									 <label class="col-sm-2 control-label">&nbsp;</label>
									   <div class="mrgnlft92 col-sm-10 text-right">
									     <div class="pull-left mrgnlft92" style="width:88%">
										    <img id="addCustomOpt" class="pull-left mrgn10 mrgntp8" src="<?php echo base_url(); ?>assets/img/more.png" alt="" /><input type="text" placeholder="Add Customization Option" class="form-control pull-left mrgn10" value="" name="add_custom_option[]" style="width:50%" />
											<input type="text" placeholder="Price" class="form-control pull-left mrgn10" value="" name="add_custom_price[]" style="width:25%" />
										 </div>
									  </div>
									</div>
								  </div>
                                </div>
								
								<div class="hr-line-dashed"></div>
								 
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button type="reset" class="btn btn-white">Cancel</button>
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
			
			$('#addMoreItemBtn').on('click', function() {
				
				var html = '<div class="form-group" id="addMoreContainer" style="border:1px dashed #e7eaec;border-radius:3px;padding:25px"><label class="col-sm-2 control-label">&nbsp;</label><div><div class="col-sm-10 mrgnbtm10"><div class="pull-left"><img id="closeMainDiv" title="add more item" class="pull-left mrgn10 mrgntp8" src="<?php echo base_url(); ?>assets/img/minus.png" alt="" /><input type="text" placeholder="Enter Item Name" class="form-control pull-left mrgn10" value="" name="" style="width:41%" />&nbsp;&nbsp;<input type="text" placeholder="Enter Base Price" class="form-control pull-left mrgn10" value="" name="" style="width:41%" /><textarea class="form-control txtareadesc" placeholder="Enter Item Description"></textarea></div></div><div class="pull-left"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 text-right"><div class="pull-left mrgnlft85" style="width:88%"><img class="pull-left mrgn10 mrgntp8" src="<?php echo base_url(); ?>assets/img/more.png" id="addCustomizationType" alt="" /><input type="text" placeholder="Add Customization Type" class="form-control pull-left mrgn10" value="" name="" style="width:62%" /></div><div class="col-sm-10 text-right mrgntp8"><div class="radio radio-success radio-inline"><input type="radio" id="radio8" value="1" name="custom_type[]" checked="checked"><label for="radio8">Exclusive</label></div><div class="radio radio-success radio-inline"><input type="radio" name="custom_type[]" id="radio9" value="2"><label for="radio9">Multiple</label></div></div></div></div><div class="pull-left mrgntp15"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 text-right"><div class="pull-left mrgnlft85" style="width:88%"><img class="pull-left mrgn10 mrgntp8" src="<?php echo base_url(); ?>assets/img/more.png" alt="" id="addCustomOpt" /><input type="text" placeholder="Add Customization Option" class="form-control pull-left mrgn10" value="0" name="" style="width:50%" /><input type="text" placeholder="Price" class="form-control pull-left mrgn10" value="1" name="" style="width:25%" /></div></div></div></div></div>';
  
				$("#addMoreItem").after(html);
				
			});
			
			$(document).on('click', '#closeMainDiv', function () {
				$(this).parents().eq(3).remove();
			});
			
			
			$(document).on('click', '#addCustomizationType', function () {
				
				var f = parseInt($('#custom_type_hidden').attr('value'));

				var html = '<div class="pull-left mrgntp8"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 text-right"><div style="width:88%" class="pull-left mrgnlft85"><img id="remCustomizationType" alt="" src="<?php echo base_url(); ?>assets/img/minus.png" class="pull-left mrgn10 mrgntp8"><input type="text" style="width:62%" name="customization_type[]" value="" class="form-control pull-left mrgn10" placeholder="Add Customization Type"></div><div class="col-sm-10 text-right mrgntp8"><div class="radio radio-success radio-inline"><input type="radio" checked="checked" name="custom_type_' + f + '" value="1" id="radio8"><label for="radio8">Exclusive</label></div><div class="radio radio-success radio-inline"><input type="radio" value="2" id="radio9" name="custom_type_' + f + '"><label for="radio9">Multiple</label></div></div></div></div>';
				$(html).insertBefore('#addCustomOption');
				var nf = f + 1;
				$('#custom_type_hidden').val(nf);
									
			});
			
			$(document).on('click', '#remCustomizationType', function () {	
				$(this).parents().eq(2).remove();
			});
			
			
			$(document).on('click', '#addCustomOpt', function () {
				
				var html = '<div style="width:88%" class="pull-left mrgnlft92 mrgntp8"><img alt="" src="<?php echo base_url(); ?>assets/img/minus.png" class="pull-left mrgn10 mrgntp8" id="remCustomOpt"><input type="text" style="width:50%" name="add_custom_option[]" value="" class="form-control pull-left mrgn10" placeholder="Add Customization Option"><input type="text" style="width:25%" name="add_custom_price[]" value="" class="form-control pull-left mrgn10" placeholder="Price"></div>';
				
				$(this).parents().eq(1).append(html);
				
				
			});
			
			
			$(document).on('click', '#remCustomOpt', function () {
				
				$(this).parents().eq(0).remove();
				
			});
			
    </script>
</body>

</html>
