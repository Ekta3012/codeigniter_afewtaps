<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?></title>
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
		
		<div class="sidebard-panel">
                <?php $this->load->view('include/inc_sidebar'); ?>
        </div>
			
         <div class="wrapper wrapper-content" id="leftWrapper">
            <div class="row">
                     <div class="col-lg-12">
                    <div class="ibox float-e-margins">
					<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Merchant Guidelines</div>
						
                        <div class="ibox-content">
						  
						  
						    <?php echo validation_errors();  ?>
                            	<?php echo $this->session->flashdata('mer_guideline') != '' ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs msgsuc\'><i class="fa fa-check"></i> Merchant Guidelines Updated successfully.</div>' : ''; ?>
							
							
							<?php echo form_open('', array('class' => 'form-horizontal'));
						 if (count($guidelines) > 0)
											  {
												  foreach ($guidelines as $cdata)
												    {
							
							 ?>
							
                            <div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Title</label><div class="col-sm-6"><input class="form-control crsntalwd" type="text"  id="title" name="title" value="<?php echo $cdata->{'title'}; ?>"/></div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Description</label><div class="col-sm-6"><input class="form-control crsntalwd" type="text"  name="description" id="description"  value="<?php echo $cdata->{'description'}; ?>"/></div>
									</div>
								</div>
                                
                              
                                
                                
							<?php 	}
											  }
							 ?>
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
