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
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>Welcome to A Few Taps</h3>
            <p>Login in. To see it in action.</p>
			 <?php echo validation_errors(); ?>
			 <?php echo $this->session->flashdata('authfailed') != '' ? "<div class=\"error\">The email or password you entered is incorrect .!</div>" : "" ; ?>
             <?php echo form_open('auth/index', array('class' => 'm-t', 'role' => 'form')); ?>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="" name="email" autocomplete="off" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="" name="password" autocomplete="off" />
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <a href="<?php echo site_url(); ?>/auth/forgotPassword"><small>Forgot password?</small></a>
             <?php echo form_close(); ?>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/bootstrap.min.js"></script>
</body>

</html>
