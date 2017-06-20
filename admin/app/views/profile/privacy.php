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
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">
<style>
.addMenu{background:#2A3F54;color:#FFF}
.btn:focus, .btn:hover{color:#FFF}
</style>
</head>
<body>

     <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
		
        <div class="wrapper wrapper-content" style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
							
                                 <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Privacy</div>
						
								
								<div class="ibox-content">
						     <div class="row">
                              <div class="col-md-9">
                              <?php
							 
							    if(count($privacy)>0)
															{
																 
															foreach ($privacy as $data)
															{
										 echo '<b style="text-decoration: underline;">'.$data->{'title'}.'</b>';
										 echo '<p>'.$data->{'description'}.'</p>';
												
												   
															}
															
							  
                              ?>
                             
                             </div>
                             <div class="col-md-3">
                            <?php echo '<a style="  border-right: 1px solid #ccc;
    padding-right: 7px;" title="Edit" href="'.base_url().'index.php/profile/privacyedit/'.$data->{'id'}.'"><img src="'.config_item('base_url').'assets/img/edit.png"></a>&nbsp;&nbsp;<a title="Delete" href="'.base_url().'index.php/profile/del/'.$data->{'id'}.'" onclick="return confirm(\'Are you sure ?\')"><img src="'.config_item('base_url').'assets/img/delete.png"></a>'; ?>
                             </div>
                          <?php   }
						  else
						  {
							
							echo  '<a href="'.base_url().'index.php/profile/privacyedit/1"><button class="addMenu btn btn-w-m" type="button" data-attr="1">
<i class="fa fa-plus"></i>
  Add New Privacy Policy
</button></a>';
							  
						  }
							
                              ?>
                          
                             </div>
							
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
	<script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/ckfinder/ckfinder.js"></script>
    
</body>

</html>
