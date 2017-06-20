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

<body class="fixed-navigation">
    <div id="wrapper">
        <?php $this->load->view('include/inc_navigation'); ?>
        <div id="page-wrapper" class="gray-bg sidebar-content">
            <div class="row border-bottom">
                <?php $this->load->view('include/inc_topnav'); ?>
            </div>
            <div class="sidebard-panel">
                <?php $this->load->view('include/inc_sidebar'); ?>
            </div>
            <div class="wrapper wrapper-content">
                asfsdf
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

    <!-- Flot -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.flot.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.flot.spline.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.flot.resize.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.flot.pie.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.flot.symbol.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/curvedLines.js"></script>

    <!-- Peity -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.peity.min.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo config_item('base_url'); ?>assets/js/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo config_item('base_url'); ?>assets/js/chart.min.js"></script>

    <script>
        $(document).ready(function() {

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "Example dataset",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.7)",
                        pointColor: "rgba(26,179,148,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

        });
    </script>
</body>
</html>
