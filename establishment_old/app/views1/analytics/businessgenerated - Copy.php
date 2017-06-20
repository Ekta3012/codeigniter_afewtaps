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

		
        <div class="wrapper wrapper-content">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Business Generated</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									</div>
								</div>
								
								<div class="ibox-content">
									<div class="row">
									   <div class="col-sm-6 text-center" style="font-size:15px">
										  <p>March 2016 (Last month)</p>
										  <p><strong>Rs. 65,000 /-</strong></p>
									   </div>
									   
									   <div class="col-sm-6 text-center" style="font-size:15px">
										   <p>April 2016 (This month so far)</p>
										   <p><strong>Rs. 15,000 /-</strong></p>
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
        $(document).ready(function(){
           

		   $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Completed Orders'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Orders'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px;font-weight:bold">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:11px">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.1,
                borderWidth: 0
            }
        },
        series: [{
			color: '#1ab394',
            name: 'Completed Orders',
            data: [49.9, 71.5, 100.4, 129.2, 144.0]

        }]
    });
	
	
	
        });
    </script>
	
</body>

</html>
			