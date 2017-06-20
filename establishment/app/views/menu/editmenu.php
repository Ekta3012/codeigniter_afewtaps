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
<link href="<?php echo config_item('base_url'); ?>assets/css/chosen.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/select2.min.css" rel="stylesheet">

<style>
.mrgn10{margin:0 10px}
.mrgnbtm10{margin:0 0 10px 0}
.mrgntp8{margin-top:8px}
.mrgntp15{margin-top:15px}
.txtareadesc{margin:30px 0 0 20px;resize:vertical}
.mrgnlft85{margin-left:85px}
.mrgnlft92{margin-left:92px}
.mrgnlft55{margin-left:55px}
.chosen-container {width:100% !important }
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
							
							<?php echo $this->session->flashdata('menu_add') != '' ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs msgsuc\'><i class="fa fa-check"></i> Menu item added successfully.</div>' : ''; ?>
							
							<?php echo $this->session->flashdata('add_cuisine') != '' ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs msgsuc\'><i class="fa fa-check"></i> Cuisine added successfully.</div>' : ''; ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
								
								
							<?php
							  $category_data = $info['category_data'];
							?>
								
								<div class="form-group"><label class="col-sm-2 control-label">&nbsp;</label>
									 <div class="col-sm-10">
										<div class="radio radio-success radio-inline">
												<input type="radio" name="cat" value="1" <?php echo isset ($category_data->main_category) ? (($category_data->main_category == 1) ? "checked='checked'" : "") : ""; ?>  id="radio9" checked="checked" />
												<label for="radio9">Food</label>
										</div>
										
										<div class="radio radio-success radio-inline">
												<input type="radio" value="2" id="radio10" name="cat" <?php echo isset ($category_data->main_category) ? (($category_data->main_category == 2) ? "checked='checked'" : "") : ""; ?> />
												<label for="radio10">Drinks</label>
										</div>
										
									 </div>
								 </div>

                                <div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10">
									   <?php
   									    // $value =  tep_get_category_tree();
									     //echo tep_draw_pull_down_menu('parent', $value, ((set_value('parent') != '') ? set_value('parent') : (isset($info->{'parent_id'}) ? $info->{'parent_id'} : ''))); 
									   ?>
									   
									   <select tabindex="-1" style="width:350px;display:none;" class="categoryData form-control" data-placeholder="Enter Or Choose a Category..." name="category">
										 <?php
										  if (count($category) > 0)
											  {
												  foreach ($category as $cdata)
												    {
													   $selected = isset ($category_data->category_id) ? (($category_data->category_id == $cdata->id) ? "selected='selected'" : "") : "";
												       echo "<option ".$selected." value=".$cdata->id.">".$cdata->category_name."</option>";
													}
											   }
										 ?>
										</select>
										
										
									</div>
                                </div>


								<div class="form-group" id="addMoreItem" style="border:1px dashed #888;border-radius:3px;padding:25px"><label class="col-sm-2 control-label">&nbsp;</label>
								   <div>
                                     <div class="col-sm-8 mrgnbtm10">
									     <div class="pull-left">
										    <!-- <img id="addMoreItemBtn" title="add more item" class="pull-left mrgn10 mrgntp8" src="<?php echo base_url(); ?>assets/img/more.png" alt="" />-->
											<input type="text" placeholder="Enter Item Name" class="form-control pull-left mrgn10" value="<?php echo $info['items_data']->item_name; ?>" name="item_name" style="width:41%" />&nbsp;&nbsp;
											<input type="text" placeholder="Enter Base Price" class="form-control pull-left mrgn10" value="<?php echo $info['items_data']->price; ?>" name="base_price" style="width:41%" />
								        	<textarea class="form-control txtareadesc" placeholder="Enter Item Description" name="description"><?php echo stripslashes($info['items_data']->{'description'}); ?></textarea>
											
										 </div>
									 </div>
											
											
											
										<?php 
										  if ($category_data->main_category == 1) 
										  {
										?>
											<div class="col-sm-2"  style="margin:25px 0">
												<div class="radio radio-success radio-inline">
													<input type="radio" name="veg_nonveg_cat" value="1" id="radio1" <?php echo isset($info['items_data']->{'item_type'}) ? ($info['items_data']->{'item_type'} == 1 ? "checked='checked'" : "") : ""; ?> />
													<label for="radio1">Veg</label>
												</div>
												
												<div class="radio radio-danger radio-inline">
														<input type="radio" value="2" id="radio2" name="veg_nonveg_cat" <?php echo isset($info['items_data']->{'item_type'}) ? ($info['items_data']->{'item_type'} == 2 ? "checked='checked'" : "") : ""; ?> />
														<label for="radio2">Non Veg</label>
												</div>
										    </div>
										<?php } ?>	
										

										<?php 
										  if ($category_data->main_category == 2) 
										    {
										?>
											 <div class="col-sm-2"  id="drinksContainer">
												<div class="row">
													<div class="radio radio-danger radio-inline col-sm-12">
														<input type="radio" name="drinks_cat" value="3" id="radio6" <?php echo isset($info['items_data']->{'item_type'}) ? ($info['items_data']->{'item_type'} == 3 ? "checked='checked'" : "") : ""; ?> />
														<label for="radio1">Alcoholic</label>
													</div>
													
													<div class="radio radio-danger radio-inline col-sm-12" style="margin:0">
														<input type="radio" name="drinks_cat" value="4" id="radio7" <?php echo isset($info['items_data']->{'item_type'}) ? ($info['items_data']->{'item_type'} == 4 ? "checked='checked'" : "") : ""; ?> />
														<label for="radio1">Non Alcoholic</label>
													</div>
													
													<div class="radio radio-danger radio-inline col-sm-12" style="margin:0">
														<input type="radio" name="drinks_cat" value="5" id="radio8" <?php echo isset($info['items_data']->{'item_type'}) ? ($info['items_data']->{'item_type'} == 5 ? "checked='checked'" : "") : ""; ?> />
														<label for="radio1">Aerated</label>
													</div>
													
												</div>
											</div>
										 
										<?php } ?>
										
											
									
									
								  <div class="pull-left" id="addCustomOptContainer">
								  
								  <?php
								   $menu = $info['menu'];
								   $i    = 0;
								   if (count($menu) > 0)
								     {
								       foreach ($menu as $menu_data)
										  {
											echo '<label class="col-sm-2 control-label">&nbsp;</label>
													<div class="col-sm-10 text-right mrgntp15">
													  <div class="pull-left mrgnlft85" style="width:88%">
														<img data-attr="1" class="pull-left mrgn10 mrgntp8" src="'.base_url().'assets/img/more.png" alt="" id="addCustomizationType" />
														
														<input type="text" placeholder="Add Customization Type" class="form-control pull-left mrgn10" value="'.$menu_data['customization_name'].'" name="customization_type['.$i.'][custom_type_name]" style="width:62%" />
													  </div>
													 
													  <div class="col-sm-6 text-right mrgntp8">
															<div class="radio radio-success radio-inline">
																	<input type="radio" id="radio15" value="1" name="customization_type['.$i.'][type]" '.(($menu_data['customization_type'] == 1) ? "checked='checked'" : "").'>
																	<label for="radio15">Exclusive</label>
															</div>
															<div class="radio radio-success radio-inline">
																	<input type="radio" name="customization_type['.$i.'][type]" id="radio16" value="2" '.(($menu_data['customization_type'] == 2) ? "checked='checked'" : "").'>
																	<label for="radio16">Multiple</label>
															</div>
													   </div>';	
													 
													   if (count($menu_data['options']) > 0)
														   {
															   $j = 0;
															   echo '<div class="pull-left mrgntp15" id="addCustomOption">
																		 <label class="col-sm-2 control-label">&nbsp;</label>
																		   <div class="col-sm-10 text-right">';
															   foreach ($menu_data['options'] as $option_data)
																   {
																	   $mid  = ($j == 0) ? "addCustomOpt" : "remCustomOpt";
																	   $icon = ($j == 0) ? "more" : "minus";
																	   $dataattr = ($j == 0) ? "data-attr='".count($menu_data['options'])."'" : "";

																	   echo '<div class="pull-left mrgntp8" style="margin-left:15px">
																				<img id="'.$mid.'" class="pull-left mrgn10 mrgntp8" src="'.base_url().'assets/img/'.$icon.'.png" alt="" attr="0" '.$dataattr.' />
																				<input type="text" placeholder="Add Customization Option" class="form-control pull-left mrgn10" value="'.$option_data->option_name.'" name="customization_type['.$i.'][custom_option]['.$j.'][name]" style="width:50%" />
																				<input type="text" placeholder="Price" class="form-control pull-left mrgn10" value="'.$option_data->price.'" name="customization_type['.$i.'][custom_option]['.$j.'][price]" style="width:25%" />
																			 </div>';
																		$j++;
																    }
																  echo '</div>
																       </div>';
														   }		
												 echo '</div>';
												  
												 $i++;
										 }
									}
									else
										{
											echo '<div class="pull-left" id="addCustomOptContainer">
									 <label class="col-sm-2 control-label">&nbsp;</label>
									   <div class="col-sm-10 text-right">
									     <div class="pull-left mrgnlft85" style="width:88%">
										    <img data-attr="1" class="pull-left mrgn10 mrgntp8" src="'.base_url().'assets/img/more.png" alt="" id="addCustomizationType" />
											
											<input type="text" placeholder="Add Customization Type" class="form-control pull-left mrgn10" value="" name="customization_type[0][custom_type_name]" style="width:62%" />
										 </div>
										 
										 <div class="col-sm-6 text-right mrgntp8">
												<div class="radio radio-success radio-inline">
														<input type="radio" id="radio15" value="1" name="customization_type[0][type]" checked="checked">
														<label for="radio15">Exclusive</label>
												</div>
												<div class="radio radio-success radio-inline">
														<input type="radio" name="customization_type[0][type]" id="radio16" value="2">
														<label for="radio16">Multiple</label>
												</div>
										 </div>	
										 
										   <div class="pull-left mrgntp15" id="addCustomOption">
											 <label class="col-sm-2 control-label">&nbsp;</label>
											   <div class="col-sm-10 text-right">
												 <div class="pull-left" style="margin-left:15px">
													<img id="addCustomOpt" class="pull-left mrgn10 mrgntp8" src="'.base_url().'assets/img/more.png" alt="" attr="0" data-attr="1" />
													
													<input type="text" placeholder="Add Customization Option" class="form-control pull-left mrgn10" value="" name="customization_type[0][custom_option][0][name]" style="width:50%" />
													
													<input type="text" placeholder="Price" class="form-control pull-left mrgn10" value="" name="customization_type[0][custom_option][0][price]" style="width:25%" />
													
													
												 </div>
											  </div>
											</div>
									
									  </div>
									</div>
									
									<input type="hidden" name="custom_type_hidden" id="custom_type_hidden" value="2" />
									<input type="hidden" name="custom_type_value" id="custom_type_hidden" value="2" />';
										}
										?>
									 
									  <!-- second  box -->
									  
									  <!-- 

											<div style="float:left;margin-top:25px" id="addMoreCont">
											   <label class="col-sm-2 control-label">&nbsp;</label>
											   <div class="col-sm-10 text-right">
												  <div class="pull-left mrgnlft85" style="width:88%"><img data-attr="1" class="pull-left mrgn10 mrgntp8" src="http://localhost/fewtaps/establishment/assets/img/more.png" alt="" id="addCustomizationType"><input type="text" placeholder="Add Customization Type" class="form-control pull-left mrgn10" value="size" name="customization_type[1][custom_type_name]" style="width:62%"></div>
												  <div class="col-sm-6 text-right mrgntp8">
													 <div class="radio radio-success radio-inline"><input type="radio" id="radio15" value="1" name="customization_type[1][type]" checked="checked"><label for="radio15">Exclusive</label></div>
													 <div class="radio radio-success radio-inline"><input type="radio" name="customization_type[1][type]" id="radio16" value="2"><label for="radio16">Multiple</label></div>
												  </div>
												  <div class="pull-left mrgntp15" id="addCustomOption">
													 <label class="col-sm-2 control-label">&nbsp;</label>
													 <div class="col-sm-10 text-right">
														<div class="pull-left" style="margin-left:15px"><img id="addCustomOpt" class="pull-left mrgn10 mrgntp8" data-attr="1" attr="1" src="http://localhost/fewtaps/establishment/assets/img/more.png" alt=""><input type="text" placeholder="Add Customization Option" class="form-control pull-left mrgn10" value="toppings" name="customization_type[1][custom_option][0][name]" style="width:50%"><input type="text" placeholder="Price" class="form-control pull-left mrgn10" value="500" name="customization_type[1][custom_option][0][price]" style="width:25%"></div>
													 </div>
												  </div>
											   </div>
											</div>

 -->
									  
									  
									  
									  
									  <!-- close second box -->
									  
									  
									  <!--
									  
									  <div style="float:left;margin-top:25px" id="addMoreCont">
									   <label class="col-sm-2 control-label">&nbsp;</label>
									   <div class="col-sm-10 text-right">
										  <div class="pull-left mrgnlft85" style="width:88%"><img data-attr="1" class="pull-left mrgn10 mrgntp8" src="http://localhost/fewtaps/establishment/assets/img/more.png" alt="" id="addCustomizationType"><input type="text" placeholder="Add Customization Type" class="form-control pull-left mrgn10" value="size" name="customization_type[1][custom_type_name]" style="width:62%"></div>
										  <div class="col-sm-6 text-right mrgntp8">
											 <div class="radio radio-success radio-inline"><input type="radio" id="radio15" value="1" name="customization_type[1][type]" checked="checked"><label for="radio15">Exclusive</label></div>
											 <div class="radio radio-success radio-inline"><input type="radio" name="customization_type[1][type]" id="radio16" value="2"><label for="radio16">Multiple</label></div>
										  </div>
										  <div class="pull-left mrgntp15" id="addCustomOption">
											 <label class="col-sm-2 control-label">&nbsp;</label>
											 <div class="col-sm-10 text-right">
												<div class="pull-left" style="margin-left:15px"><img id="addCustomOpt" class="pull-left mrgn10 mrgntp8" data-attr="1" attr="1" src="http://localhost/fewtaps/establishment/assets/img/more.png" alt=""><input type="text" placeholder="Add Customization Option" class="form-control pull-left mrgn10" value="toppings" name="customization_type[1][custom_option][0][name]" style="width:50%"><input type="text" placeholder="Price" class="form-control pull-left mrgn10" value="500" name="customization_type[1][custom_option][0][price]" style="width:25%"></div>
											 </div>
										  </div>
									   </div>
									</div> -->
									  
									</div>

									
									<input type="hidden" name="custom_type_hidden" id="custom_type_hidden" value="2" />
									<input type="hidden" name="custom_type_value" id="custom_type_hidden" value="2" />
									
									<!--<div class="pull-left mrgntp15" id="addCustomOption">
									 <label class="col-sm-2 control-label">&nbsp;</label>
									   <div class="mrgnlft92 col-sm-10 text-right">
									     <div class="pull-left mrgnlft92" style="width:88%">
										    <img id="addCustomOpt" class="pull-left mrgn10 mrgntp8" src="<?php echo base_url(); ?>assets/img/more.png" alt="" /><input type="text" placeholder="Add Customization Option" class="form-control pull-left mrgn10" value="" name="add_custom_option[]" style="width:50%" />
											<input type="text" placeholder="Price" class="form-control pull-left mrgn10" value="" name="add_custom_price[]" style="width:25%" />
										 </div>
									  </div>
									</div>-->
									
									
									
									
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
    <script src="<?php echo config_item('base_url'); ?>assets/js/chosen.jquery.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/select2.full.min.js"></script>
	
    <script>
            $(document).ready(function () {
				
				setTimeout(function() { $(".msgsuc").slideUp() }, 3000);
				
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
		
				var config = {
								'.chosen-select'           : {},
								'.chosen-select-deselect'  : {allow_single_deselect:true},
								'.chosen-select-no-single' : {disable_search_threshold:10},
								'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
								'.chosen-select-width'     : {width:"95%"}
							 }
							 
				for (var selector in config) {
					$(selector).chosen(config[selector]);
				}
		
        });
			
			
			$(".categoryData").select2({
			  tags: "false",
			  placeholder: "Enter Or Choose a Category...",
			  allowClear: true
			});
			
			
			$('#addMoreItemBtn').on('click', function() {
				
				var html = '<div style="margin-top:10px"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 mrgnbtm10"><div class="pull-left"><img alt="" src="<?php echo base_url(); ?>assets/img/more.png" class="pull-left mrgn10 mrgntp8" title="add more item" id="addMoreItemBtn"><input type="text" style="width:41%" name="item_name[]" value="" class="form-control pull-left mrgn10" placeholder="Enter Item Name">&nbsp;&nbsp;<input type="text" style="width:41%" name="base_price[]" value="" class="form-control pull-left mrgn10" placeholder="Enter Base Price"><div style="margin:25px 0" class="col-sm-10"><div class="radio radio-success radio-inline"><input type="radio" id="radio1" value="1" name="veg_nonveg_cat" checked="checked"><label for="radio1">Veg</label></div><div class="radio radio-danger radio-inline"><input type="radio" name="veg_nonveg_cat" id="radio2" value="2"><label for="radio2">Non Veg</label></div></div><textarea name="description[]" placeholder="Enter Item Description" class="form-control txtareadesc"></textarea></div></div><div id="addCustomOptContainer" class="pull-left"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 text-right"><div style="width:88%" class="pull-left mrgnlft85"><img id="addCustomizationType" alt="" src="<?php echo base_url(); ?>assets/img/more.png" class="pull-left mrgn10 mrgntp8"><input type="text" style="width:62%" name="customization_type_1" value="" class="form-control pull-left mrgn10" placeholder="Add Customization Type"></div><div class="col-sm-6 text-right mrgntp8"><div class="radio radio-success radio-inline"><input type="radio" checked="checked" name="custom_type_1" value="1" id="radio15"><label for="radio15">Exclusive</label></div><div class="radio radio-success radio-inline"><input type="radio" value="2" id="radio16" name="custom_type_1"><label for="radio16">Multiple</label></div></div>	<div id="addCustomOption" class="pull-left mrgntp15"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 text-right"><div style="margin-left:15px" class="pull-left"><img alt="" src="<?php echo base_url(); ?>assets/img/more.png" class="pull-left mrgn10 mrgntp8" id="addCustomOpt"><input type="text" style="width:50%" name="add_custom_option[]" value="" class="form-control pull-left mrgn10" placeholder="Add Customization Option"><input type="text" style="width:25%" name="add_custom_price[]" value="" class="form-control pull-left mrgn10" placeholder="Price"></div></div></div></div></div><input type="hidden" value="2" id="custom_type_hidden" name="custom_type_hidden"></div>';
  
				$("#addCustomOptContainer").append(html);
				
			});
			
			$(document).on('click', '#closeMainDiv', function () {
				$(this).parents().eq(3).remove();
			});
			
			
			$(document).on('click', '#addCustomizationType', function () {
				
				var f = parseInt($(this).attr('data-attr'));
				//var f = parseInt($('#custom_type_hidden').attr('value'));
				
				var nf = f + 1;
				
				$(this).attr('data-attr', nf);

				//var html = '<div class="pull-left mrgntp8"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 text-right"><div class="pull-left mrgnlft85"><img id="remCustomizationType" alt="" src="<?php echo base_url(); ?>assets/img/minus.png" class="pull-left mrgn10 mrgntp8"><input type="text" style="width:62%" name="customization_type[]" value="" class="form-control pull-left mrgn10" placeholder="Add Customization Type"></div><div class="col-sm-10 text-right mrgntp8"><div class="radio radio-success radio-inline"><input type="radio" checked="checked" name="custom_type_' + f + '" value="1" id="radio8"><label for="radio8">Exclusive</label></div><div class="radio radio-success radio-inline"><input type="radio" value="2" id="radio9" name="custom_type_' + f + '"><label for="radio9">Multiple</label></div></div></div></div>';
				

				var html = '<div id="addMoreCont" style="float:left;margin-top:25px"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 text-right"><div style="width:88%" class="pull-left mrgnlft85"><img id="addCustomizationType" alt="" src="<?php echo base_url(); ?>assets/img/more.png" class="pull-left mrgn10 mrgntp8" data-attr="' + f + '"><input type="text" style="width:62%" name="customization_type[' + f + '][custom_type_name]" value="" class="form-control pull-left mrgn10" placeholder="Add Customization Type"></div><div class="col-sm-6 text-right mrgntp8"><div class="radio radio-success radio-inline"><input type="radio" checked="checked" name="customization_type[' + f + '][type]" value="1" id="radio15"><label for="radio15">Exclusive</label></div><div class="radio radio-success radio-inline"><input type="radio" value="2" id="radio16" name="customization_type[' + f + '][type]"><label for="radio16">Multiple</label></div></div><div id="addCustomOption" class="pull-left mrgntp15"><label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-10 text-right"><div style="margin-left:15px" class="pull-left"><img alt="" src="<?php echo base_url(); ?>assets/img/more.png" attr=' + f + ' data-attr=\'1\' class="pull-left mrgn10 mrgntp8" id="addCustomOpt"><input type="text" style="width:50%" name="customization_type[' + f + '][custom_option][0][name]" value="" class="form-control pull-left mrgn10" placeholder="Add Customization Option"><input type="text" style="width:25%" name="customization_type[' + f + '][custom_option][0][price]" value="" class="form-control pull-left mrgn10" placeholder="Price"></div></div></div></div></div>';
				
				//$(html).insertBefore('#addCustomOption');
				
				$('#addCustomOptContainer').append(html);
				
									
			});
			
			
			
			$(document).on('click', '#remCustomizationType', function () {	
				$(this).parents().eq(2).remove();
			});
			
			
			$(document).on('click', '#addCustomOpt', function () {
				
				var n = parseInt($(this).attr('attr'));
				
				var f = parseInt($(this).attr('data-attr'));
				
				var nf = f + 1;
				
				$(this).attr('data-attr', nf);
			
				var html = '<div class="pull-left mrgntp8" style="margin-left:15px"><img alt="" src="<?php echo base_url(); ?>assets/img/minus.png" class="pull-left mrgn10 mrgntp8" id="remCustomOpt"><input type="text" style="width:50%" name="customization_type[' + n + '][custom_option][' + f + '][name]" value="" class="form-control pull-left mrgn10" placeholder="Add Customization Option" /><input type="text" style="width:25%" name="customization_type[' + n + '][custom_option][' + f + '][price]" value="" class="form-control pull-left mrgn10" placeholder="Price" /></div>';
				
				$(this).parents().eq(1).append(html);
				
			});
			
			
			$(document).on('click', '#remCustomOpt', function () {
				
				$(this).parents().eq(0).remove();
				
			});
			
			
			$(document).on('click', '#removeCustomizationType', function () {
				
				$(this).parents().eq(2).remove();
			});
			
			
			
			
			
    </script>
</body>

</html>
