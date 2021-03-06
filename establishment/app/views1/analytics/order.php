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
	
	
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>

		
        <div class="wrapper wrapper-content" id="leftWrapper">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>View Orders Chart</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									</div>
								</div>
								
								
								<div class="ibox-content">
										<div class="row">
										   <div class="col-sm-12">
										       <div id="container1" style="height:300px;width:400px;margin:0 auto"></div>
										   </div>
										   
										   <div class="col-sm-12" style="height:50px"></div>
										   
										   <div class="col-sm-12">
										       <div id="container2" style="height:300px;width:400px;margin:0 auto"></div>
										   </div>
										</div>
										
										<div class="row" style="height:50px"></div>
										
										<div class="row">
										   <div class="col-sm-12">
										        <div id="container3" style="height:300px;width:400px;margin:0 auto"></div>
										   </div>
										   
										   <div class="col-sm-12" style="height:50px"></div>
											
											
										   <div class="col-sm-12">
										        <div id="container4" style="height:300px;width:400px;margin:0 auto"></div>
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
           

var example = 'column-drilldown', 
theme = 'default';

(function($){ // encapsulate jQuery
	$(function () {
    // Create the chart
    $('#container1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Completed Orders'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '<strong>Orders No.</strong>'
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
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">Completed Orders</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
        },

        series: [{
            name: 'Completed Orders',
			color: '#349313',
            data: <?php echo $response['completed_orders']; ?>
        }],
        drilldown: {
            series: <?php echo $response['completed_orders']; ?>
        }
    });
});
})(jQuery);


(function($){ // encapsulate jQuery
	$(function () {
    // Create the chart
    $('#container2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Cancelled Orders'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '<strong>Orders No.</strong>'
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
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">Cancelled Orders</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
        },

        series: [{
            name: 'Cancelled Orders',
			color: '#349313',
            data: <?php echo $response['cancelled_orders']; ?>
        }],
        drilldown: {
            series: <?php echo $response['cancelled_orders']; ?>
        }
    });
});
})(jQuery);




(function($){ // encapsulate jQuery
	$(function () {
    // Create the chart
    $('#container3').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Nudged Orders'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '<strong>Orders No.</strong>'
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
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">Nudged Orders</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
        },

        series: [{
            name: 'Nudged Orders',
			color: '#E60E0F',
            data: <?php echo $response['nudged_orders']; ?>
        }],
        drilldown: {
            series: <?php echo $response['nudged_orders']; ?>
        }
    });
});
})(jQuery);


(function($){ // encapsulate jQuery
	$(function () {
    // Create the chart
    $('#container4').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Threshold Orders'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '<strong>Orders No.</strong>'
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
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">Threshold Orders</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span> - <b>{point.y}</b><br/>'
        },

        series: [{
            name: 'Threshold Orders',
			color: '#E60E0F',
            data: <?php echo $response['threshold_orders']; ?>
        }],
        drilldown: {
            series: <?php echo $response['threshold_orders']; ?>
        }
    });
});
})(jQuery);

        });
	</script>
	
</body>

</html>
			