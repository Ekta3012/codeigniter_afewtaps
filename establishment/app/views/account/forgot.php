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
	<style>
	.suc{color:#008d4c}
	</style>
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <p><img src="<?php echo base_url(); ?>../uploads/logo.png" alt="afewtaps" width="100" /></p>
            <p>Recover Your Password Here</p>
			
			 <?php echo validation_errors(); ?>
			 
			 <?php 
			   echo ($this->session->flashdata('send')) != '' ? '<p class=\'suc\'>Your new password has been send to your emailId</p>' : ''; 
			  ?>
			  
			 <?php echo form_open('auth/forgotPassword', array('class' => 'm-t', 'role' => 'form')); ?>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="" autocomplete="off" name="email" value="<?php echo set_value('email'); ?>" />
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Forgot Password</button>
                <a href="<?php echo site_url(); ?>/auth/index"><small>Login</small></a>
             <?php echo form_close(); ?>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/bootstrap.min.js"></script>
</body>

</html>
