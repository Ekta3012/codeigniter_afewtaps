<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo config_item('admin_page_title'); ?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon">
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
            #chart {
                height: 300px;
                margin: 30px auto 0;
                display: block;
                position: relative;
            }
            #chart #numbers {
                width: 50px;
                height: 100%;
                margin: 0;
                padding: 0;
                display: inline-block;
                position: absolute;left: 0;
            }
            #chart #numbers li {
                text-align: right;
                padding-right: 1em;
                list-style: none;
                height: 20%;
                border-bottom: 1px solid #c3c3c3;
                position: relative;
                bottom: 60px;
            }
            /*            #chart #numbers li:last-child {
                            height: 30px;
                        }*/
            #chart #numbers li span {
                color: #aaaaaa;
                position: absolute;
                bottom: 0;
                right: 10px;
            }
            #chart #bars {
                display: inline-block;
                background: #ffffff;
                width: 100%;
                height: 300px;
                padding: 0;
                margin: 0;
                box-shadow: 0 0 0 1px #c3c3c3;
                padding-left: 60px;
            }
            #chart #bars li {
                display: table-cell;
                width: 65px;
                height: 300px;
                margin: 0;
                text-align: center;
                position: relative;
            }
            #chart #bars li .bar {
                display: block;
                width: 20px;
                margin-left: 15px;
                background: #49E;
                position: absolute;
                bottom: 0;
                -webkit-border-radius: 20px 20px 0 0;
                -moz-border-radius: 20px 20px 0 0;
                -ms-border-radius: 20px 20px 0 0;
                -o-border-radius: 20px 20px 0 0;
                border-radius: 20px 20px 0 0;
            }

            #chart #bars li .bar:hover {
                background: #5AE;
                cursor: pointer;
            }
            #chart #bars li .bar:hover:before {
                color: #444444;
                content: attr(data-percentage);
                position: relative;
                bottom: 35px;
                right: 6px;
            }
            #chart #bars li>span samp{display: block;}
            #chart #bars li>span {
                color: #000000;
                width: 100%;
                position: absolute;
                top: 105%;
                bottom: -2em;
                left: 0;
                text-align: center;
                font-size: 12px;
            }
            .wrapper-content .col-selector .box{
                margin-top: 30px;
            }
            .wrapper-content>div>div{
                margin:25px 0;
            }
            .total_header{width: 150px;}
            .second_last_month{width: 150px;}
            .last_month{width: 300px;}
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
                        <div class="col-lg-12">
                            <div class="col-selector" style="background-color: #ffffff;padding-bottom: 100px;">
                                <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Business Generated</div>
                                <div class="clearfix">
                                    <div class="col-md-6 col-md-offset-3" style="margin-bottom:10%;">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Total Business Generated</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body no-padding">
                                                <table class="table table-condensed">
                                                    <tbody>
                                                        <tr>
                                                            <th class="total_header">Total Orders</th>
                                                        <?php if(isset($total_monthly_generated_business)){
                                                            $tmgb = $total_monthly_generated_business;
                                                            ?>
                                                            <th class="second_last_month"><?php echo $tmgb[4]['month_year']."<br>".$tmgb[4]['amount'];?></th>
                                                            <th class="last_month"><?php echo $tmgb[5]['month_year']."(this month so far)<br>".$tmgb[5]['amount'];?></th>
                                                        
                                                            <?php }?>
                                                        </tr>
                                                    </tbody></table>
                                                <table class="table table-condensed">
                                                    <tbody>
                                                        <tr>
                                                            <th class="total_header">Staff Orders</th>
                                                        <?php if(isset($staff_monthly_generated_business)){
                                                            $tmgb = $staff_monthly_generated_business;
                                                            ?>
                                                            <th class="second_last_month"><?php echo $tmgb[4]['month_year']."<br>".$tmgb[4]['amount'];?></th>
                                                            <th class="last_month"><?php echo $tmgb[5]['month_year']."(this month so far)<br>".$tmgb[5]['amount'];?></th>
                                                        
                                                            <?php }?>
                                                        </tr>
                                                    </tbody></table>
                                                <table class="table table-condensed">
                                                    <tbody>
                                                        <tr>
                                                            <th class="total_header">Customer Orders</th>
                                                        <?php if(isset($customer_monthly_generated_business)){
                                                            $tmgb = $customer_monthly_generated_business;
                                                            ?>
                                                            <th class="second_last_month"><?php echo $tmgb[4]['month_year']."<br>".$tmgb[4]['amount'];?></th>
                                                            <th class="last_month"><?php echo $tmgb[5]['month_year']."(this month so far)<br>".$tmgb[5]['amount'];?></th>
                                                        
                                                            <?php }?>
                                                        </tr>
                                                    </tbody></table>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php
                                            if (isset($staff_monthly_generated_business)) {
                                                $hit = array();
                                                foreach ($staff_monthly_generated_business as $sco) {
                                                    $hit[] = $sco['amount'];
                                                }
                                                $ori_hight = max($hit);
                                                $hight = max($hit);
                                                $multiplier = 1;
                                                do {
                                                    if ($ori_hight > 10000 * $multiplier) {
                                                        $hight = 10000 * ($multiplier + 1);
                                                        ++$multiplier;
                                                    } else {
                                                        $hight = 10000 * $multiplier;
                                                    }
                                                } while ($hight < $ori_hight);

                                                $level = $hight / 5;
                                                ?>
                                                <div class="box-header">
                                                    <h3 class="box-title">Staff Orders</h3>
                                                </div>
                                                <div id="chart"> 
                                                    <ul id="numbers">
                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                            <li><span><?php echo $level * $j; ?></span></li>
                                                        <?php } ?>
                                                        <li><span>0</span></li>

                                                    </ul>
                                                    <ul id="bars">
                                                        <?php foreach ($staff_monthly_generated_business as $sco) { ?>
                                                            <li>
                                                                <?php $data_percentage = $sco['amount'] / ($multiplier * 100); ?>
                                                                <div data-percentage="<?php echo $sco['amount']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar"></div>
                                                                <span>
                                                                    <samp><?php echo $sco['month_name']; ?></samp>
                                                                    <samp><?php echo $sco['year']; ?></samp>
                                                                </span>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box">
                                            <?php
                                            if (isset($customer_monthly_generated_business)) {
                                                $hit = array();
                                                foreach ($customer_monthly_generated_business as $sco) {
                                                    $hit[] = $sco['amount'];
                                                }
                                                $ori_hight = max($hit);
                                                $hight = max($hit);
                                                $multiplier = 1;
                                                do {
                                                    if ($ori_hight > 10000 * $multiplier) {
                                                        $hight = 10000 * ($multiplier + 1);
                                                        ++$multiplier;
                                                    } else {
                                                        $hight = 10000 * $multiplier;
                                                    }
                                                } while ($hight < $ori_hight);
                                                $level = $hight / 5;
                                                ?>
                                                <div class="box-header">
                                                    <h3 class="box-title">Customer Orders</h3>
                                                </div>
                                                <div id="chart"> 
                                                    <ul id="numbers">
                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                            <li><span><?php echo $level * $j; ?></span></li>
                                                        <?php } ?>
                                                        <li><span>0</span></li>

                                                    </ul>
                                                    <ul id="bars">
                                                        <?php foreach ($customer_monthly_generated_business as $sco) { ?>
                                                            <li>
                                                                <?php $data_percentage = $sco['amount'] / ($multiplier * 100); ?>
                                                                <div data-percentage="<?php echo $sco['amount']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
                                                                <span>
                                                                    <samp><?php echo $sco['month_name']; ?></samp>
                                                                    <samp><?php echo $sco['year']; ?></samp>
                                                                </span>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </div>
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
        <script type="text/javascript">
            $(function () {
                $("#bars li .bar").each(function (key, bar) {
                    var percentage = $(this).data('percentage1');
                    $(this).animate({
                        'height': percentage + '%'
                    }, 1000);
                });
            });
        </script>
    </body>
</html>
