<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?>Payment</title>
<link href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">

<style>
ul {margin:0;padding:0}
ul li {margin-left:15px;list-style-type:none;line-height:30px}
</style>

</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg">
       <div class="row border-bottom">
	     <?php $this->load->view('include/inc_topnav'); ?>
       </div>


        <div class="wrapper wrapper-content" id="leftWrapper">
		
			<div class="ibox-title">
				<h5>Payment Method</h5>
			 </div>
			
            <div class="row">
                 <!-- Table -->
				 
				    <?php
					  $pay_arr = array();
					  if (isset($payment->payment_method))
						  {
							  $pay_arr = explode (',', $payment->payment_method);
						  }
					
					?>
					
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-content">
								    <div id="msg"></div>
									<ul style="margin:0;padding:0">
									  <li><input type="checkbox" <?php echo in_array(1, $pay_arr) ? "checked='checked'" : '' ; ?>  checked="checked" name="method[]" value="1" id="payment_method" />&nbsp;Include in the Final Bill (Credit Purchase)</li>
									  <li><input type="checkbox" <?php echo in_array(2, $pay_arr) ? "checked='checked'" : '' ; ?> name="method[]" value="2" id="payment_method" />&nbsp;Check Please! (Cash on Delivery)</li>
									  <li><input type="checkbox" name="method[]" <?php echo in_array(3, $pay_arr) ? "checked='checked'" : '' ; ?> value="3" id="payment_method" />&nbsp;Pay with Payu (Debit/Credit card/ Net banking)</li><br />
	
									  <li><input type="checkbox" name="info" value="1" id="info" <?php echo isset($payment->info) ? ($payment->info == 1 ? "checked='checked'" : "") : "" ; ?> />&nbsp;In Case the establishment does not support delivery & opts for only pay with Payu as a payment method, please include the following text<br /><strong>"This outlet does not support table delivery. Customers are requested to pick up their order from the counter. Thank you !"</strong></li>
									</ul><br />
									
									<button type="button" id="submit" class="btn btn-primary" onclick="submit()">Submit</button>
									
								</div>
							</div>
						</div>
				 <!-- Close -->
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
		});
			
		function submit()
			 {	
			 	$("#msg").css('display', 'block').html('<strong>Loading...</strong>');
				var arr = [];
				
				$("input#payment_method").each(function(e,f) {
					if ($(this).is(':checked'))
					arr.push($(this).val());
				});
			
				if (parseInt(arr.length) > 0)
					  {
						$.ajax({
								 url: '<?php echo base_url(); ?>index.php/payment/ajaxPayment',
								 type: "GET",
								 dataType: "json",
								 data: {'value':arr.join("-"), 'info': parseInt($('#info').val()), '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
								 success: function (L) 
									 {
										  if (L.status == 'success')
											  {
												  $("#msg").html('<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Payment method has been saved successfully.</div>');
											  }
										  else
											  {
												  $("#msg").html('<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Something went wrong.</div>');
											  }
												  setTimeout(function(){ $("#msg").slideUp()}, 3000);
									 }
						       });
					  }
			 }
    </script>
	
</body>

</html>
			