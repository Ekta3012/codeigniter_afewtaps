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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
	
<style>
.mrgntp25{margin-top:25px}
</style>
	
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg">
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
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								
								<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Business Generated</div>
								
								
								<div class="ibox-content">
									<div class="row">
									   <div class="col-sm-6 text-center" style="font-size:15px">
										  <p><?php echo $prev_month; ?> (Last month)</p>
										  <p><strong>Rs. <?php echo number_format((float)$prev_business, 2, '.', ''); ?> /-</strong></p>
									   </div>
									   
									   <div class="col-sm-6 text-center" style="font-size:15px">
										   <p><?php echo $current_month; ?> (This month so far)</p>
										   <p><strong>Rs. <?php echo number_format((float)$current_business, 2, '.', ''); ?> /-</strong></p>
									   </div>
									   
									   
									   <div class="col-sm-12">
									     <div class="mrgntp25"></div>
									   </div>
									   

									   <div class="col-sm-12">
										   <div id="container" style="height:300px;width:400px;margin:0 auto"></div>
									   </div>
									</div>
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

    
	
	<script>
        $(document).ready(function() {

		    var example = 'column-drilldown', 
			theme       = 'default';

			(function($){ // encapsulate jQuery
				$(function () {
				// Create the chart
				$('#container').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: ''
					},
					xAxis: {
						type: 'category'
					},
					yAxis: {
						title: {
							text: ''
						}

					},
					legend: {
						enabled: false
					},
					plotOptions: {
						series: {
							borderWidth: 0,
							dataLabels: {
								enabled: true,
								format: '{point.y:.1f}'
							}
						}
					},

					tooltip: {
						headerFormat: '<span style="font-size:11px">Business Generated</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span> - Rs: <b>{point.y:.2f}</b><br/>'
					},

					series: [{
						name: '',
						color: '#2E4054',
						data: <?php echo $business_generated; ?>
					}],
					drilldown: {
						series: <?php echo $business_generated; ?>
					}
				});
			});
			})(jQuery);
        });
    </script>
	
</body>

</html>
			