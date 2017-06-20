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
        left:0; right:0; top:0; bottom:0;
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
			
         <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0">
            <div class="row">
                     <div class="col-lg-12">
                    <div class="ibox float-e-margins">
						<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;"><?php echo ($this->uri->segment(3) != '') ? "Update" : "Add"; ?> Faq</div>
						
                        <div class="ibox-content">

						    <?php echo validation_errors(); ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
							
							    <div class="row">
								    <div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Question</label> <div class="col-sm-6"><input type="text" name="que" value="<?php echo isset($info->{'que'}) ? $info->{'que'} : set_value('que'); ?>" class="form-control" autocomplete="off"  /></div></div></div>
									
								<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Answer</label>	<div class="col-sm-6"><input type="text"  name="ans" class="form-control" value="<?php echo isset($info->{'ans'}) ? $info->{'ans'} : set_value('ans'); ?>" autocomplete="off" /></div></div></div>
									
									<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Applied On</label>		<div class="col-sm-6">
									  
									  <?php
									     $tax_apply_arr = @explode (',', $info->{'apply_for'});
										 echo '<div class="selectBox" onclick="showCheckboxes()">
													<select class=\'form-control m-b\'>
														<option>FAQ applied on</option>
													</select>
													<div class="overSelect"></div>
												</div>';
												
										 echo "<div class=\"taxContainer\" id=\"checkboxes\" style=\"width:395px\">";
										 $cate_arr   =   array (1 => 'Establishment', 2 => 'UserApp', 3 => 'ServiceApp');
										 foreach ($cate_arr as $key => $category_arr)
											 {
												$checked = in_array ($key, $tax_apply_arr) ? "checked = 'checked'" : "";
												$id = ($key == 0) ? "allTotal" : "chooseCat";
												echo '<p><label style="border-bottom:1px solid #888" for="cat_'.$key.'">'.$category_arr.'</label>&nbsp;&nbsp;&nbsp;<input style="margin:10px 10px 0 0" name="apply_for[]" class = "pull-right '.$id.'" type="radio" id="'.$id.'" value="'.$key.'" '.$checked.' /></p>';
											 }
									     echo "</div>";
										
										?>
		
                                    </div></div></div>
									

									 <div class="hr-line-dashed"></div>
								 
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-5">
                                        <button type="reset" class="btn btn-white">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
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
