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
                border-bottom: 1px solid #c3c3c3;
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
                background: #718fb5;
                position: absolute;
                bottom: 0;
                -webkit-border-radius: 20px 20px 0 0;
                -moz-border-radius: 20px 20px 0 0;
                -ms-border-radius: 20px 20px 0 0;
                -o-border-radius: 20px 20px 0 0;
                border-radius: 20px 20px 0 0;
            }

            #chart #bars li .bar:before {
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
            .graph_footer_head{    
                padding: 15px 15px;
                border-top: 1px solid #c3c3c3;
                border-bottom: 1px solid #c3c3c3;
            }
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
                                <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Total Orders</div>
                                <div class="clearfix">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Total Orders</h3>
                                            </div>
                                             <!--/.box-header--> 
                                            <div class="box-body no-padding">
                                                <table class="table table-condensed">
                                                    <tbody>       
                                                        <?php if(isset($response['total_orders'])){
                                                            $t_o = $response['total_orders'];
                                                            $s_t_o = $response['staff_total_orders'];
                                                            $c_t_o = $response['customer_total_orders'];
                                                        ?>
                                                        <tr>
                                                            <th class="total_header"></th>
                                                            <th class="second_last_month"><?php echo $t_o[4]['month_year'];?></th>
                                                            <th class="last_month"><?php echo $t_o[5]['month_year']."(this month so far)";?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Total Orders</th>
                                                            <th class="second_last_month"><?php echo $t_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $t_o[5]['total_order'];?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Staff Orders</th>
                                                            <th class="second_last_month"><?php echo $s_t_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $s_t_o[5]['total_order'];?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Customer Orders</th>
                                                            <th class="second_last_month"><?php echo $c_t_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $c_t_o[5]['total_order'];?></th>
                                                        </tr>
                                                            <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                             <!--/.box-body--> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php if(isset($response['staff_total_orders'])){
                                            $hit = array();
                                            foreach ($response['staff_total_orders'] as $sco){ 
                                               $hit[] = $sco['total_order'];
                                            }
                                            $ori_hight = max($hit);
                                            $hight = max($hit);
                                            $multiplier = 1;
                                            do{
                                                if($ori_hight > 100*$multiplier){
                                                    $hight = 100*($multiplier+1);
                                                    ++$multiplier;
                                                }else{
                                                    $hight = 100*$multiplier;
                                                }
                                            }while ($hight < $ori_hight);
                                            
                                            $level = $hight/5;
                                            ?>
                                            
                                            <div id="chart"> 
<!--                                                <ul id="numbers">
                                                    <?php for($j=5;$j>=1;$j--){ ?>
                                                            <li><span><?php echo $level*$j;?></span></li>
                                                    <?php } ?>
   <li><span>0</span></li>
   
 </ul>-->
                                                <ul id="bars">
                                                    <?php 
                                                    foreach ($response['staff_total_orders'] as $sco){ ?>
                                                    <li>
                                                        <?php $data_percentage = $sco['total_order']/$multiplier; ?>
                                                        <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar"></div>
                                                        <span>
                                                            <samp><?php echo $sco['month_name'];?></samp>
                                                            <samp><?php echo $sco['year'];?></samp>
                                                        </span>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="box-header text-center" style="margin-top: 75px;">
                                            <h3 class="graph_footer_head">Staff Orders</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php if(isset($response['customer_total_orders'])){
                                            $hit = array();
                                            foreach ($response['customer_total_orders'] as $sco){ 
                                               $hit[] = $sco['total_order'];
                                            }
                                            $ori_hight = max($hit);
                                            $hight = max($hit);
                                            $multiplier = 1;
                                            do{
                                                if($ori_hight > 100*$multiplier){
                                                    $hight = 100*($multiplier+1);
                                                    ++$multiplier;
                                                }else{
                                                    $hight = 100*$multiplier;
                                                }
                                            }while ($hight < $ori_hight);
                                            
                                            $level = $hight/5;
                                            ?>
                                            
                                            <div id="chart"> 
<!--                                                <ul id="numbers">
                                                    <?php for($j=5;$j>=1;$j--){ ?>
                                                            <li><span><?php echo $level*$j;?></span></li>
                                                    <?php } ?>
   <li><span>0</span></li>
   
 </ul>-->
                                                <ul id="bars">
                                                    <?php 
                                                    foreach ($response['customer_total_orders'] as $sco){ ?>
                                                    <li>
                                                        <?php $data_percentage = $sco['total_order']/$multiplier; ?>
                                                        <div data-percentage="<?php if($sco['month_numeric'] == date('m')){echo $sco['total_order'];}else{echo $sco['total_order'];} ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
                                                        <span>
                                                            <samp><?php echo $sco['month_name'];?></samp>
                                                            <samp><?php echo $sco['year'];?></samp>
                                                        </span>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="box-header text-center" style="margin-top: 75px;">
                                            <h3 class="graph_footer_head">Customer Orders</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-selector" style="background-color: #ffffff;padding-bottom: 100px;">
                                <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Completed Orders</div>
                                <div class="clearfix">
                                    <div class="col-md-6 col-md-offset-3" style="margin-bottom:10%;">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Total Completed Orders</h3>
                                            </div>
                                             <!--/.box-header--> 
                                            <div class="box-body no-padding">
                                                <table class="table table-condensed">
                                                    <tbody>       
                                                        <?php if(isset($response['total_completed_orders'])){
                                                            $tmgb = $response['total_completed_orders'];
                                                            $s_tmgb = $response['staff_completed_orders'];
                                                            $c_tmgb = $response['customer_completed_orders'];
                                                        ?>
                                                        <tr>
                                                            <th class="total_header"></th>
                                                            <th class="second_last_month"><?php echo $tmgb[4]['month_year'];?></th>
                                                            <th class="last_month"><?php echo $tmgb[5]['month_year']."(this month so far)";?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Total Orders</th>
                                                            <th class="second_last_month"><?php echo $tmgb[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $tmgb[5]['total_order'];?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Staff Orders</th>
                                                            <th class="second_last_month"><?php echo $s_tmgb[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $s_tmgb[5]['total_order'];?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Customer Orders</th>
                                                            <th class="second_last_month"><?php echo $c_tmgb[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $c_tmgb[5]['total_order'];?></th>
                                                        </tr>
                                                            <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                             <!--/.box-body--> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php if(isset($response['staff_completed_orders'])){
                                            $hit = array();
                                            foreach ($response['staff_completed_orders'] as $sco){ 
                                               $hit[] = $sco['total_order'];
                                            }
                                            $ori_hight = max($hit);
                                            $hight = max($hit);
                                            $multiplier = 1;
                                            do{
                                                if($ori_hight > 100*$multiplier){
                                                    $hight = 100*($multiplier+1);
                                                    ++$multiplier;
                                                }else{
                                                    $hight = 100*$multiplier;
                                                }
                                            }while ($hight < $ori_hight);
                                            
                                            $level = $hight/5;
                                            ?>
                                            
                                            <div id="chart"> 
<!--                                                <ul id="numbers">
                                                    <?php for($j=5;$j>=1;$j--){ ?>
                                                            <li><span><?php echo $level*$j;?></span></li>
                                                    <?php } ?>
   <li><span>0</span></li>
   
 </ul>-->
                                                <ul id="bars">
                                                    <?php 
                                                    foreach ($response['staff_completed_orders'] as $sco){ ?>
                                                    <li>
                                                        <?php $data_percentage = $sco['total_order']/$multiplier; ?>
                                                        <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
                                                        <span>
                                                            <samp><?php echo $sco['month_name'];?></samp>
                                                            <samp><?php echo $sco['year'];?></samp>
                                                        </span>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="box-header text-center" style="margin-top: 75px;">
                                            <h3 class="graph_footer_head">Staff Orders</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php if(isset($response['customer_completed_orders'])){
                                            $hit = array();
                                            foreach ($response['customer_completed_orders'] as $sco){ 
                                               $hit[] = $sco['total_order'];
                                            }
                                            $ori_hight = max($hit);
                                            $hight = max($hit);
                                            $multiplier = 1;
                                            do{
                                                if($ori_hight > 100*$multiplier){
                                                    $hight = 100*($multiplier+1);
                                                    ++$multiplier;
                                                }else{
                                                    $hight = 100*$multiplier;
                                                }
                                            }while ($hight < $ori_hight);
                                            
                                            $level = $hight/5;
                                            ?>
                                            
                                            <div id="chart"> 
<!--                                                <ul id="numbers">
                                                    <?php for($j=5;$j>=1;$j--){ ?>
                                                            <li><span><?php echo $level*$j;?></span></li>
                                                    <?php } ?>
   <li><span>0</span></li>
   
 </ul>-->
                                                <ul id="bars">
                                                    <?php 
                                                    foreach ($response['customer_completed_orders'] as $sco){ ?>
                                                    <li>
                                                        <?php $data_percentage = $sco['total_order']/$multiplier; ?>
                                                        <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
                                                        <span>
                                                            <samp><?php echo $sco['month_name'];?></samp>
                                                            <samp><?php echo $sco['year'];?></samp>
                                                        </span>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="box-header text-center" style="margin-top: 75px;">
                                            <h3 class="graph_footer_head">Customer Orders</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-selector" style="background-color: #ffffff;padding-bottom: 100px;">
                                <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Canceled Orders</div>
                                <div class="clearfix">
                                    <div class="col-md-6 col-md-offset-3" style="margin-bottom:10%;">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Total Cancelled Orders</h3>
                                            </div>
                                             <!--/.box-header--> 
                                            <div class="box-body no-padding">
                                                
                                                <table class="table table-condensed">
                                                    <tbody>       
                                                        <?php if(isset($response['total_cancelled_orders'])){
                                                            $t_c_o = $response['total_cancelled_orders'];
                                                            $s_t_c_o = $response['staff_cancelled_orders'];
                                                            $c_t_c_o = $response['customer_cancelled_orders'];
                                                        ?>
                                                        <tr>
                                                            <th class="total_header"></th>
                                                            <th class="second_last_month"><?php echo $t_c_o[4]['month_year'];?></th>
                                                            <th class="last_month"><?php echo $t_c_o[5]['month_year']."(this month so far)";?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Total Orders</th>
                                                            <th class="second_last_month"><?php echo $t_c_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $t_c_o[5]['total_order'];?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Staff Orders</th>
                                                            <th class="second_last_month"><?php echo $s_t_c_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $s_t_c_o[5]['total_order'];?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Customer Orders</th>
                                                            <th class="second_last_month"><?php echo $c_t_c_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $c_t_c_o[5]['total_order'];?></th>
                                                        </tr>
                                                            <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                             <!--/.box-body--> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php if(isset($response['staff_cancelled_orders'])){
                                            $hit = array();
                                            foreach ($response['staff_cancelled_orders'] as $sco){ 
                                               $hit[] = $sco['total_order'];
                                            }
                                            $ori_hight = max($hit);
                                            $hight = max($hit);
                                            $multiplier = 1;
                                            do{
                                                if($ori_hight > 100*$multiplier){
                                                    $hight = 100*($multiplier+1);
                                                    ++$multiplier;
                                                }else{
                                                    $hight = 100*$multiplier;
                                                }
                                            }while ($hight < $ori_hight);
                                            
                                            $level = $hight/5;
                                            ?>
                                            
                                            <div id="chart"> 
<!--                                                <ul id="numbers">
                                                    <?php for($j=5;$j>=1;$j--){ ?>
                                                            <li><span><?php echo $level*$j;?></span></li>
                                                    <?php } ?>
   <li><span>0</span></li>
   
 </ul>-->
                                                <ul id="bars">
                                                    <?php 
                                                    foreach ($response['staff_cancelled_orders'] as $sco){ ?>
                                                    <li>
                                                        <?php $data_percentage = $sco['total_order']/$multiplier; ?>
                                                        <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
                                                        <span>
                                                            <samp><?php echo $sco['month_name'];?></samp>
                                                            <samp><?php echo $sco['year'];?></samp>
                                                        </span>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="box-header text-center" style="margin-top: 75px;">
                                            <h3 class="graph_footer_head">Staff Orders</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php if(isset($response['customer_cancelled_orders'])){
                                            $hit = array();
                                            foreach ($response['customer_cancelled_orders'] as $sco){ 
                                               $hit[] = $sco['total_order'];
                                            }
                                            $ori_hight = max($hit);
                                            $hight = max($hit);
                                            $multiplier = 1;
                                            do{
                                                if($ori_hight > 100*$multiplier){
                                                    $hight = 100*($multiplier+1);
                                                    ++$multiplier;
                                                }else{
                                                    $hight = 100*$multiplier;
                                                }
                                            }while ($hight < $ori_hight);
                                            
                                            $level = $hight/5;
                                            ?>
                                            
                                            <div id="chart"> 
<!--                                                <ul id="numbers">
                                                    <?php for($j=5;$j>=1;$j--){ ?>
                                                            <li><span><?php echo $level*$j;?></span></li>
                                                    <?php } ?>
   <li><span>0</span></li>
   
 </ul>-->
                                                <ul id="bars">
                                                    <?php 
                                                    foreach ($response['customer_cancelled_orders'] as $sco){ ?>
                                                    <li>
                                                        <?php $data_percentage = $sco['total_order']/$multiplier; ?>
                                                        <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
                                                        <span>
                                                            <samp><?php echo $sco['month_name'];?></samp>
                                                            <samp><?php echo $sco['year'];?></samp>
                                                        </span>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="box-header text-center" style="margin-top: 75px;">
                                            <h3 class="graph_footer_head">Customer Orders</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-selector" style="background-color: #ffffff;padding-bottom: 100px;">
                                <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Threshold Orders</div>
                                <div class="clearfix">
                                    <div class="col-md-6 col-md-offset-3" style="margin-bottom:10%;">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Total Threshold Orders</h3>
                                            </div>
                                             <!--/.box-header--> 
                                            <div class="box-body no-padding">
                                                                                               
                                                <table class="table table-condensed">
                                                    <tbody>       
                                                        <?php if(isset($response['total_threshold_orders'])){
                                                            $t_t_o = $response['total_threshold_orders'];
                                                            $s_t_t_o = $response['staff_threshold_orders'];
                                                            $c_t_t_o = $response['customer_threshold_orders'];
                                                        ?>
                                                        <tr>
                                                            <th class="total_header"></th>
                                                            <th class="second_last_month"><?php echo $t_t_o[4]['month_year'];?></th>
                                                            <th class="last_month"><?php echo $t_t_o[5]['month_year']."(this month so far)";?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Total Orders</th>
                                                            <th class="second_last_month"><?php echo $t_t_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $t_t_o[5]['total_order'];?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Staff Orders</th>
                                                            <th class="second_last_month"><?php echo $s_t_t_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $s_t_t_o[5]['total_order'];?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="total_header">Customer Orders</th>
                                                            <th class="second_last_month"><?php echo $c_t_t_o[4]['total_order'];?></th>
                                                            <th class="last_month"><?php echo $c_t_t_o[5]['total_order'];?></th>
                                                        </tr>
                                                            <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                             <!--/.box-body--> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php if(isset($response['staff_threshold_orders'])){
                                            $hit = array();
                                            foreach ($response['staff_threshold_orders'] as $sco){ 
                                               $hit[] = $sco['total_order'];
                                            }
                                            $ori_hight = max($hit);
                                            $hight = max($hit);
                                            $multiplier = 1;
                                            do{
                                                if($ori_hight > 100*$multiplier){
                                                    $hight = 100*($multiplier+1);
                                                    ++$multiplier;
                                                }else{
                                                    $hight = 100*$multiplier;
                                                }
                                            }while ($hight < $ori_hight);
                                            
                                            $level = $hight/5;
                                            ?>
                                            
                                            <div id="chart"> 
<!--                                                <ul id="numbers">
                                                    <?php for($j=5;$j>=1;$j--){ ?>
                                                            <li><span><?php echo $level*$j;?></span></li>
                                                    <?php } ?>
   <li><span>0</span></li>
   
 </ul>-->
                                                <ul id="bars">
                                                    <?php 
                                                    foreach ($response['staff_threshold_orders'] as $sco){ ?>
                                                    <li>
                                                        <?php $data_percentage = $sco['total_order']/$multiplier; ?>
                                                        <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
                                                        <span>
                                                            <samp><?php echo $sco['month_name'];?></samp>
                                                            <samp><?php echo $sco['year'];?></samp>
                                                        </span>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="box-header text-center" style="margin-top: 75px;">
                                            <h3 class="graph_footer_head">Staff Orders</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-solid bg-teal-gradient">
                                            <?php if(isset($response['customer_threshold_orders'])){
                                            $hit = array();
                                            foreach ($response['customer_threshold_orders'] as $sco){ 
                                               $hit[] = $sco['total_order'];
                                            }
                                            $ori_hight = max($hit);
                                            $hight = max($hit);
                                            $multiplier = 1;
                                            do{
                                                if($ori_hight > 100*$multiplier){
                                                    $hight = 100*($multiplier+1);
                                                    ++$multiplier;
                                                }else{
                                                    $hight = 100*$multiplier;
                                                }
                                            }while ($hight < $ori_hight);
                                            
                                            $level = $hight/5;
                                            ?>

                                            <div id="chart"> 
<!--                                                <ul id="numbers">
                                                    <?php for($j=5;$j>=1;$j--){ ?>
                                                            <li><span><?php echo $level*$j;?></span></li>
                                                    <?php } ?>
   <li><span>0</span></li>
   
 </ul>-->
                                                <ul id="bars">
                                                    <?php 
                                                    foreach ($response['customer_threshold_orders'] as $sco){ ?>
                                                    <li>
                                                        <?php $data_percentage = $sco['total_order']/$multiplier; ?>
                                                        <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
                                                        <span>
                                                            <samp><?php echo $sco['month_name'];?></samp>
                                                            <samp><?php echo $sco['year'];?></samp>
                                                        </span>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="box-header text-center" style="margin-top: 75px;">
                                            <h3 class="graph_footer_head">Customer Orders</h3>
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
