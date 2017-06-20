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
<script src="<?php echo config_item('base_url'); ?>assets/js/jquery-2.1.1.js"></script>
<script src="<?php echo config_item('base_url'); ?>assets/js/bootstrap.min.js"></script>
	
<style>
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 20px 0 30px 0;
	background:#404040;
	color:#FFF;
	font-size:13px
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>
</head>
<body>



    <!-- POP UP -->
	
	<!-- <div id="myModal" class="modal fade in" role="dialog" style="display:block">
	  <div class="modal-dialog"  style="margin-top:65px">
	
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Modal Header</h4>
		  </div>
		  <div class="modal-body">
			<p>Some text in the modal.</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>-->

	<!-- Close -->
	
	
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
						
						<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;"><?php echo ($this->uri->segment(3) == '') ? "Add" : "Update"; ?> Staff Member</div>
						
                        <div class="ibox-content">
						  <div class="row">
							<?php
							   echo validation_errors();
							?>
							<?php echo form_open_multipart('', array('class' => 'form-horizontal' , 'novalidate' => 'novalidate')); ?>

							
							<div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-10"><input type="text" value="<?php echo isset($info->{'name'}) ? $info->{'name'} : set_value('name'); ?>" name="name" placeholder="Name" class="form-control" autocomplete="off" /></div>
                                </div>
								
                                <div class="hr-line-dashed"></div>
								
                                <div class="form-group">
                                    <div class="col-sm-10"><input type="text" name="phone_no" value="<?php echo isset($info->{'contact_no'}) ? $info->{'contact_no'} : set_value('phone_no'); ?>" placeholder="Phone no" class="form-control" autocomplete="off" /></div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
								<div class="form-group">
                                    <div class="col-sm-10"><input type="text" name="email" value="<?php echo isset($info->{'email_id'}) ? $info->{'email_id'} : set_value('email'); ?>" placeholder="Email Id" class="form-control" autocomplete="off" /></div>
                                </div>
                                
								 <div class="hr-line-dashed"></div>
								 
							<!-- <div class="form-group">
                                    <div class="col-sm-10">
									  <select class="form-control m-b" name="branch">
                                        <?php 
										    $branches = getBranches($uid);
										    if (count($branches) > 0)
											  {
												 echo "<option value=''>-- Select Branch --</option>";
										         foreach ($branches as $bdata)
												 echo "<option value='".$bdata->{'id'}."'>".$bdata->{'name'}."</option>";
											  }
											 else
												 echo "<option value=''>-- Select --</option>";
										?>
                                      </select>
									</div>
                                </div>-->
								
							</div>
							
							
							<div class="col-md-6">
							    <div class="col-md-12 text-center">
								   <img src="<?php echo base_url(); ?>assets/img/user_icon.png" alt="" width="70" height="70" />
								</div>
							
								<div class="col-md-12 text-center">
								  <div class="fileUpload btn" style="">
									<span >UPLOAD PHOTO</span>
									<input type="file" class="upload" name="userfile" accept="image/*" />
								  </div>
								</div>

								
								<div class="col-md-12 text-center" style="margin:15px 0 20px 0">
								   <button type="submit" class="btn btn-primary">Submit</button>
								</div>
						
							  
							</div>
							
							
                            <?php echo form_close(); ?>
							
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
            });
    </script>
</body>

</html>
